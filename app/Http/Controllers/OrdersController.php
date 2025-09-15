<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan daftar pesanan user (EXCLUDE delivered orders)
    public function index(Request $request)
    {
        $query = Order::with(['orderItems.product'])
            ->where('user_id', Auth::id())
            ->where('status', '!=', 'delivered') // Exclude delivered orders
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan status jika ada
        if ($request->has('status') && $request->status && $request->status !== 'delivered') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan payment status jika ada
        if ($request->has('payment_status') && $request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->paginate(10);

        // Get counts for different statuses (excluding delivered)
        $statusCounts = [
            'all' => Order::where('user_id', Auth::id())->where('status', '!=', 'delivered')->count(),
            'pending' => Order::where('user_id', Auth::id())->where('status', 'pending')->count(),
            'processing' => Order::where('user_id', Auth::id())->where('status', 'processing')->count(),
            'shipped' => Order::where('user_id', Auth::id())->where('status', 'shipped')->count(),
            'cancelled' => Order::where('user_id', Auth::id())->where('status', 'cancelled')->count(),
        ];

        return view('orders.index', compact('orders', 'statusCounts'));
    }

    // Menampilkan detail pesanan spesifik
    public function show($orderNumber)
    {
        $order = Order::with(['orderItems.product.images'])
            ->where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }

    // Update status pesanan (untuk admin atau sistem otomatis)
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update([
            'status' => $request->status,
            'shipped_date' => $request->status === 'shipped' ? now() : $order->shipped_date,
            'delivered_date' => $request->status === 'delivered' ? now() : $order->delivered_date,
        ]);

        // If order is marked as delivered, redirect to order history with a message
        if ($request->status === 'delivered') {
            return response()->json([
                'success' => true,
                'message' => 'Order delivered successfully! You can now leave reviews for your items.',
                'redirect_url' => route('order-history.index'),
                'new_status' => $order->getStatusLabelAttribute()
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
            'new_status' => $order->getStatusLabelAttribute()
        ]);
    }

    // Batalkan pesanan (hanya jika masih pending)
    public function cancel(Order $order)
    {
        // Pastikan order milik user yang sedang login
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Hanya bisa dibatalkan jika status masih pending atau processing
        if (!in_array($order->status, ['pending', 'processing'])) {
            return back()->with('error', 'Order cannot be cancelled at this stage');
        }

        // Update status dan kembalikan stock
        $order->update([
            'status' => 'cancelled',
            'payment_status' => 'failed'
        ]);

        // Kembalikan stock produk
        foreach ($order->orderItems as $item) {
            if ($item->product) {
                $item->product->increment('stock_kuantitas', $item->kuantitas);
            }
        }

        return back()->with('success', 'Order has been cancelled successfully');
    }

    // Get order status untuk AJAX
    public function getStatus($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json([
            'status' => $order->status,
            'status_label' => $order->getStatusLabelAttribute(),
            'payment_status' => $order->payment_status,
            'payment_status_label' => $order->getPaymentStatusLabelAttribute(),
            'shipped_date' => $order->shipped_date?->format('d M Y H:i'),
            'delivered_date' => $order->delivered_date?->format('d M Y H:i'),
            'is_delivered' => $order->status === 'delivered'
        ]);
    }
}