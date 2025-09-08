<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ====================
// Halaman Umum (Public)
// ====================
Route::view('/', 'beranda')->name('home');
Route::get('/allProduct', [ProductController::class, 'index'])->name('products.index');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/refundPolicy', 'refundPolicy')->name('refund.policy');
Route::view('/howToOrder', 'howToOrder')->name('how.to.order');
Route::view('/paymentConfirmation', 'paymentConfirmation')->name('payment.confirmation');

// ✅ Detail Produk (ambil dari database lewat ProductController)
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');

// =====================
// Guest (Belum Login)
// =====================
Route::middleware('guest')->group(function () {
    // Sign Up
    Route::get('/signUp', [RegisterController::class, 'showsignUpForm'])->name('signUp');
    Route::post('/signUp', [RegisterController::class, 'signUp']);

    // Sign In
    Route::get('/signIn', [AuthController::class, 'showsignInForm'])->name('signIn');
    Route::get('/login', [AuthController::class, 'showsignInForm'])->name('login');
    Route::post('/signIn', [AuthController::class, 'signIn']);
});

// =====================
// Authenticated (Sudah Login)
// =====================
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::view('/profil', 'profil.profil')->name('profil');
    Route::view('/wishlist', 'wishlist')->name('wishlist');
    Route::view('/orders', 'orders')->name('orders');
    Route::view('/settings', 'settings')->name('settings');
    
    // ✅ Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');

    // ✅ Checkout Routes (BARU DITAMBAHKAN)
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

// =====================
// Login/Register dengan Google
// =====================
Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/auth/google', [RegisterController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [RegisterController::class, 'handleGoogleCallback']);

Route::get('/register/google', [RegisterController::class, 'redirectToGoogle'])->name('register.google');
Route::get('/register/google/callback', [RegisterController::class, 'handleGoogleCallback']);