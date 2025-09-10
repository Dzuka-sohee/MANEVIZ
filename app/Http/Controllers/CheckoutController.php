<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
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
            return ($item->product->harga_jual ?? $item->product->harga) * $item->kuantitas * 1000;
        });

        $tax = $subtotal * 0.025; // 2.5%
        $shipping = 15000; // IDR 15,000 flat shipping
        $total = $subtotal + $tax + $shipping;

        return view('checkout', compact('selectedItems', 'subtotal', 'tax', 'shipping', 'total'));
    }

    // Process checkout
    public function store(Request $request)
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
            'payment_method' => 'required|string|in:bank_transfer,credit_card,ewallet,cod',
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

        DB::beginTransaction();

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
            $shippingCost = 15000;
            $grandTotal = $subtotal + $tax + $shippingCost;

            // Create order - DISESUAIKAN DENGAN DATABASE EXISTING
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => Auth::id(),
                'status' => 'pending',
                'subtotal' => $subtotal,            // Tambah ini - required
                'tax' => $tax,                      // Tambah ini jika ada kolom tax
                'total' => $grandTotal,             // Tambah ini jika ada kolom total
                'total_amount' => $subtotal,        
                'shipping_cost' => $shippingCost,     
                'grand_total' => $grandTotal,       
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_postal_code' => $request->shipping_postal_code,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'notes' => $request->notes,
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
                    'subtotal' => $productPrice * $item->kuantitas,  // Gunakan subtotal bukan total
                ]);

                // Update product stock
                $item->product->decrement('stock_kuantitas', $item->kuantitas);
            }

            // Remove items from cart
            $cartItems->each->delete();

            DB::commit();

            return redirect()->route('checkout.success', ['order' => $order->order_number])
                ->with('success', 'Order berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    // Show order success page
    public function success($orderNumber)
    {
        $order = Order::with('orderItems.product')  // Gunakan orderItems bukan items
            ->where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('checkout.success', compact('order'));
    }
}