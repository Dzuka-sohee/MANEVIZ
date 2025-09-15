<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
        $this->middleware('auth');
    }

    // Menampilkan halaman checkout
    public function index(Request $request)
    {
        $selectedItems = [];
        
        if ($request->has('items')) {
            // Jika ada items yang dipilih dari cart
            $itemIds = explode(',', $request->get('items'));
            $selectedItems = Cart::with('product.images')
                ->whereIn('id', $itemIds)
                ->where('user_id', Auth::id())
                ->get();
        } else {
            // Jika tidak ada, ambil semua item di cart
            $selectedItems = Cart::with('product.images')
                ->where('user_id', Auth::id())
                ->get();
        }

        if ($selectedItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item yang dipilih untuk checkout');
        }

        // Calculate totals
        $subtotal = $selectedItems->sum(function ($item) {
            return ($item->product->harga_jual ?? $item->product->harga) * $item->kuantitas;
        });

        $tax = $subtotal * 0.025; // 2.5%
        $shipping = 15; // IDR 15,000 flat shipping
        $total = $subtotal + $tax + $shipping;

        return view('checkout', compact('selectedItems', 'subtotal', 'tax', 'shipping', 'total'));
    }

    // Create Midtrans payment token
    public function createPayment(Request $request)
    {
        $request->validate([
            'items' => 'required|string',
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string|max:255',
            'shipping_province' => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:10',
            'notes' => 'nullable|string|max:500',
            'same_as_shipping' => 'nullable|boolean',
        ]);

        // Validate billing address if different from shipping
        if (!$request->same_as_shipping) {
            $request->validate([
                'billing_name' => 'required|string|max:255',
                'billing_email' => 'required|email|max:255',
                'billing_phone' => 'required|string|max:20',
                'billing_address' => 'required|string',
                'billing_city' => 'required|string|max:255',
                'billing_province' => 'required|string|max:255',
                'billing_postal_code' => 'required|string|max:10',
            ]);
        }

        try {
            // Get selected cart items
            $itemIds = explode(',', $request->items);
            $cartItems = Cart::with('product')
                ->whereIn('id', $itemIds)
                ->where('user_id', Auth::id())
                ->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Tidak ada item yang valid untuk checkout');
            }

            // Check stock availability
            foreach ($cartItems as $item) {
                if ($item->product->stock_kuantitas < $item->kuantitas) {
                    throw new \Exception("Stok {$item->product->name} tidak mencukupi");
                }
            }

            // Calculate totals
            $subtotal = $cartItems->sum(function ($item) {
                return ($item->product->harga_jual ?? $item->product->harga) * $item->kuantitas;
            });

            $tax = $subtotal * 0.025;
            $shippingCost = 15;
            $grandTotal = $subtotal + $tax + $shippingCost;

            // Create temporary order data for Midtrans
            $orderNumber = 'TEMP-' . time() . '-' . Auth::id();
            
            // Create order data for payment
            $orderData = [
                'order_number' => $orderNumber,
                'user_id' => Auth::id(),
                'total' => $grandTotal,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping_cost' => $shippingCost,
                'items' => $cartItems,
                'customer' => [
                    'name' => $request->shipping_name,
                    'email' => $request->shipping_email,
                    'phone' => $request->shipping_phone,
                ],
                'shipping' => [
                    'name' => $request->shipping_name,
                    'email' => $request->shipping_email,
                    'phone' => $request->shipping_phone,
                    'address' => $request->shipping_address,
                    'city' => $request->shipping_city,
                    'province' => $request->shipping_province,
                    'postal_code' => $request->shipping_postal_code,
                ],
                'billing' => !$request->same_as_shipping ? [
                    'name' => $request->billing_name,
                    'email' => $request->billing_email,
                    'phone' => $request->billing_phone,
                    'address' => $request->billing_address,
                    'city' => $request->billing_city,
                    'province' => $request->billing_province,
                    'postal_code' => $request->billing_postal_code,
                ] : [
                    'name' => $request->shipping_name,
                    'email' => $request->shipping_email,
                    'phone' => $request->shipping_phone,
                    'address' => $request->shipping_address,
                    'city' => $request->shipping_city,
                    'province' => $request->shipping_province,
                    'postal_code' => $request->shipping_postal_code,
                ],
                'notes' => $request->notes,
            ];

            // Create Midtrans Snap Token
            $snapToken = $this->midtransService->createSnapTokenFromData($orderData);

            // Store order data in session for later use
            session(['pending_order_data' => $orderData]);

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_number' => $orderNumber
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    // Handle successful payment and create order
    public function handlePaymentSuccess(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string',
            'transaction_id' => 'required|string',
        ]);

        try {
            // Get order data from session
            $orderData = session('pending_order_data');
            if (!$orderData) {
                throw new \Exception('Order data not found');
            }

            // Verify payment status with Midtrans
            $transactionStatus = $this->midtransService->getTransactionStatus($request->transaction_id);
            
            $status = is_object($transactionStatus) ? $transactionStatus->transaction_status : $transactionStatus['transaction_status'];
            
            if (!in_array($status, ['capture', 'settlement'])) {
                throw new \Exception('Payment not completed');
            }

            DB::beginTransaction();

            // Get cart items again to ensure they still exist
            $itemIds = $orderData['items']->pluck('id');
            $cartItems = Cart::with('product')
                ->whereIn('id', $itemIds)
                ->where('user_id', Auth::id())
                ->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Cart items no longer available');
            }

            // Create real order number
            $realOrderNumber = Order::generateOrderNumber();

            // Create order
            $order = Order::create([
                'order_number' => $realOrderNumber,
                'user_id' => Auth::id(),
                'status' => 'processing',
                'subtotal' => $orderData['subtotal'],
                'tax' => $orderData['tax'],
                'total' => $orderData['total'],
                'total_amount' => $orderData['subtotal'],        
                'shipping_cost' => $orderData['shipping_cost'],     
                'grand_total' => $orderData['total'],       
                'shipping_name' => $orderData['shipping']['name'],
                'shipping_email' => $orderData['shipping']['email'],
                'shipping_phone' => $orderData['shipping']['phone'],
                'shipping_address' => $orderData['shipping']['address'],
                'shipping_city' => $orderData['shipping']['city'],
                'shipping_province' => $orderData['shipping']['province'],
                'shipping_postal_code' => $orderData['shipping']['postal_code'],
                'billing_name' => $orderData['billing']['name'],
                'billing_email' => $orderData['billing']['email'],
                'billing_phone' => $orderData['billing']['phone'],
                'billing_address' => $orderData['billing']['address'],
                'billing_city' => $orderData['billing']['city'],
                'billing_province' => $orderData['billing']['province'],
                'billing_postal_code' => $orderData['billing']['postal_code'],
                'payment_method' => 'midtrans',
                'payment_status' => 'paid',
                'payment_type' => 'midtrans',
                'transaction_id' => $request->transaction_id,
                'notes' => $orderData['notes'],
                'order_date' => now(),
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                $productPrice = $item->product->harga_jual ?? $item->product->harga;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'product_price' => $productPrice,
                    'kuantitas' => $item->kuantitas,
                    'size' => $item->size,
                    'subtotal' => $productPrice * $item->kuantitas,
                ]);

                // Update product stock
                $item->product->decrement('stock_kuantitas', $item->kuantitas);
            }

            // Remove items from cart
            $cartItems->each->delete();

            // Clear session data
            session()->forget('pending_order_data');

            DB::commit();

            return response()->json([
                'success' => true,
                'order_number' => $order->order_number,
                'redirect_url' => route('orders.show', ['orderNumber' => $order->order_number])
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    // Show order success page
    public function success($orderNumber)
    {
        $order = Order::with('orderItems.product')
            ->where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('checkout.success', compact('order'));
    }
}