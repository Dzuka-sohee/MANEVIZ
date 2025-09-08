<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman cart
    public function index()
    {
        $cartItems = Cart::with('product.images')
            ->forUser(Auth::id())
            ->get();

        return view('cart', compact('cartItems'));
    }

    // Menambah item ke cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'kuantitas' => 'integer|min:1',
            'color' => 'nullable|string',
            'size' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Cek stok produk
        if ($product->stock_kuantitas < ($request->kuantitas ?? 1)) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi'
            ]);
        }

        // Cek apakah item sudah ada di cart dengan color dan size yang sama
        $existingCartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->where('color', $request->color)
            ->where('size', $request->size)
            ->first();

        if ($existingCartItem) {
            // Update kuantitas jika item sudah ada
            $newQuantity = $existingCartItem->kuantitas + ($request->kuantitas ?? 1);
            
            // Cek stok lagi setelah penambahan
            if ($product->stock_kuantitas < $newQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi untuk kuantitas yang diminta'
                ]);
            }

            $existingCartItem->update(['kuantitas' => $newQuantity]);
            $cartItem = $existingCartItem;
        } else {
            // Buat item cart baru
            $cartItem = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'kuantitas' => $request->kuantitas ?? 1,
                'color' => $request->color,
                'size' => $request->size,
            ]);
        }

        // Hitung total item di cart
        $cartCount = Cart::forUser(Auth::id())->sum('kuantitas');

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cart_count' => $cartCount,
            'cart_item' => [
                'id' => $cartItem->id,
                'product_name' => $product->name,
                'color' => $cartItem->color,
                'size' => $cartItem->size,
                'quantity' => $cartItem->kuantitas,
                'price' => $product->harga_jual ?? $product->harga,
                'total' => ($product->harga_jual ?? $product->harga) * $cartItem->kuantitas
            ]
        ]);
    }

    // Update kuantitas item di cart
    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'kuantitas' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Cek stok
        if ($cartItem->product->stock_kuantitas < $request->kuantitas) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi'
            ]);
        }

        $cartItem->update(['kuantitas' => $request->kuantitas]);

        return response()->json([
            'success' => true,
            'message' => 'Kuantitas berhasil diupdate',
            'new_total' => ($cartItem->product->harga_jual ?? $cartItem->product->harga) * $cartItem->kuantitas
        ]);
    }

    // Hapus item dari cart
    public function removeItem($id)
    {
        $cartItem = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->delete();

        $cartCount = Cart::forUser(Auth::id())->sum('kuantitas');

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil dihapus dari keranjang',
            'cart_count' => $cartCount
        ]);
    }

    // Clear semua cart
    public function clearCart()
    {
        Cart::forUser(Auth::id())->delete();

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan'
        ]);
    }

    // Get cart count untuk navbar
    public function getCartCount()
    {
        $cartCount = Cart::forUser(Auth::id())->sum('kuantitas');
        
        return response()->json([
            'cart_count' => $cartCount
        ]);
    }
}