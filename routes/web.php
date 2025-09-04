<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;


// ====================
// Halaman Umum (Public)
// ====================
Route::view('/', 'beranda')->name('home');
Route::view('/allProduct', 'allProduk')->name('products.all');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/refundPolicy', 'refundPolicy')->name('refund.policy');
Route::view('/howToOrder', 'howToOrder')->name('how.to.order');
Route::view('/paymentConfirmation', 'paymentConfirmation')->name('payment.confirmation');
Route::view('/profil', 'profil.profil')->name('profil');


// Detail Produk - Route baru untuk halaman detail produk dinamis
Route::get('/produk/{slug}', function($slug, Request $request) {
    // Get product data from query parameter atau dari database
    $productData = $request->get('data');

    if ($productData) {
        $product = json_decode($productData, true);
    } else {
        // Data produk berdasarkan slug - bisa disesuaikan dengan database Anda
        $products = [
            'muzan-t-shirt' => [
                'name' => 'Muzan T-Shirt',
                'price' => 'IDR 150,000',
                'main_image' => 'storage/image/produk1.jpg',
                'images' => [
                    'storage/image/produk1.jpg',
                    'storage/image/produk2.jpg',
                    'storage/image/produk3.jpg'
                ],
                'category' => 'T-Shirt',
                'brand' => 'Demon Slayer Collection',
                'rating' => 5,
                'review_count' => 128,
                'colors' => [
                    ['name' => 'Black', 'hex' => '#000000'],
                    ['name' => 'White', 'hex' => '#ffffff'],
                    ['name' => 'Red', 'hex' => '#dc3545']
                ],
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'default_color' => 'Black'
            ],
            'douma-t-shirt' => [
                'name' => 'Douma T-Shirt',
                'price' => 'IDR 150,000',
                'main_image' => 'storage/image/produk2.jpg',
                'images' => [
                    'storage/image/produk2.jpg',
                    'storage/image/produk1.jpg',
                    'storage/image/produk3.jpg'
                ],
                'category' => 'T-Shirt',
                'brand' => 'Demon Slayer Collection',
                'rating' => 4,
                'review_count' => 86,
                'colors' => [
                    ['name' => 'Blue', 'hex' => '#007bff'],
                    ['name' => 'White', 'hex' => '#ffffff'],
                    ['name' => 'Black', 'hex' => '#000000']
                ],
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'default_color' => 'Blue'
            ],
            'mt-shirt' => [
                'name' => 'MT-Shirt',
                'price' => 'IDR 125,000',
                'main_image' => 'storage/image/produk2.jpg',
                'images' => [
                    'storage/image/produk2.jpg',
                    'storage/image/produk1.jpg',
                    'storage/image/produk3.jpg'
                ],
                'category' => 'T-Shirt',
                'brand' => 'Minimal Collection',
                'rating' => 4,
                'review_count' => 64,
                'colors' => [
                    ['name' => 'White', 'hex' => '#ffffff'],
                    ['name' => 'Gray', 'hex' => '#6c757d'],
                    ['name' => 'Black', 'hex' => '#000000']
                ],
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'default_color' => 'White'
            ],
            'cosmos-tshirt' => [
                'name' => 'Cosmos Tshirt',
                'price' => 'IDR 150,000',
                'main_image' => 'storage/image/produk2.jpg',
                'images' => [
                    'storage/image/produk2.jpg',
                    'storage/image/produk1.jpg',
                    'storage/image/produk3.jpg'
                ],
                'category' => 'T-Shirt',
                'brand' => 'Cosmos Collection',
                'rating' => 5,
                'review_count' => 156,
                'colors' => [
                    ['name' => 'Navy', 'hex' => '#001f3f'],
                    ['name' => 'Black', 'hex' => '#000000'],
                    ['name' => 'White', 'hex' => '#ffffff']
                ],
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'default_color' => 'Navy'
            ],
            'hoodie' => [
                'name' => 'Hoodie',
                'price' => 'IDR 350,000',
                'main_image' => 'storage/image/produk2.jpg',
                'images' => [
                    'storage/image/produk2.jpg',
                    'storage/image/produk1.jpg',
                    'storage/image/produk3.jpg'
                ],
                'category' => 'Hoodie',
                'brand' => 'Urban Collection',
                'rating' => 5,
                'review_count' => 234,
                'colors' => [
                    ['name' => 'Black', 'hex' => '#000000'],
                    ['name' => 'Gray', 'hex' => '#6c757d'],
                    ['name' => 'Navy', 'hex' => '#001f3f']
                ],
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'default_color' => 'Black'
            ],
            'white-tshirt' => [
                'name' => 'White Tshirt',
                'price' => 'IDR 125,000',
                'main_image' => 'storage/image/produk2.jpg',
                'images' => [
                    'storage/image/produk2.jpg',
                    'storage/image/produk1.jpg',
                    'storage/image/produk3.jpg'
                ],
                'category' => 'T-Shirt',
                'brand' => 'Basic Collection',
                'rating' => 4,
                'review_count' => 92,
                'colors' => [
                    ['name' => 'White', 'hex' => '#ffffff'],
                    ['name' => 'Gray', 'hex' => '#6c757d'],
                    ['name' => 'Black', 'hex' => '#000000']
                ],
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'default_color' => 'White'
            ]
        ];

        // Return product data atau default jika tidak ditemukan
        $product = $products[$slug] ?? [
            'name' => ucwords(str_replace('-', ' ', $slug)),
            'price' => 'IDR 199,000',
            'main_image' => 'storage/image/produk1.jpg',
            'images' => [
                'storage/image/produk1.jpg',
                'storage/image/produk2.jpg',
                'storage/image/produk3.jpg'
            ],
            'category' => 'Fashion',
            'brand' => 'Your Brand',
            'rating' => 4,
            'review_count' => 42,
            'colors' => [
                ['name' => 'White', 'hex' => '#ffffff'],
                ['name' => 'Gray', 'hex' => '#6c757d'],
                ['name' => 'Black', 'hex' => '#000000']
            ],
            'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
            'default_color' => 'White'
        ];
    }

    return view('detailproduk', compact('product'));
})->name('product.detail');

// Route yang sudah ada sebelumnya (keep this if you still need it)

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
    Route::view('/cart', 'cart')->name('cart');
    Route::view('/wishlist', 'wishlist')->name('wishlist');
    Route::view('/orders', 'orders')->name('orders');
    Route::view('/settings', 'settings')->name('settings');
});

//login dengan google
Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('/auth/google', [RegisterController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [RegisterController::class, 'handleGoogleCallback']);

// ✅ Route untuk Register/Login via Google
Route::get('/register/google', [RegisterController::class, 'redirectToGoogle'])->name('register.google');
Route::get('/register/google/callback', [RegisterController::class, 'handleGoogleCallback']);



Route::get('/allProduct', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

