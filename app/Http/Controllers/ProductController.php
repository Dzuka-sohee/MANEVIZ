<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()->with(['category', 'images']);

        // Filter kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter badge_type
        if ($request->filled('badge')) {
            $query->where('badge_type', $request->badge);
        }

        // Pencarian nama / deskripsi
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        switch ($request->get('sort', 'newest')) {
            case 'price_low':
                $query->orderBy('harga', 'asc');
                break;
            case 'price_high':
                $query->orderBy('harga', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'popular':
                $query->orderBy('total_penjualan', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('allProduk', compact('products', 'categories'));
    }

    // 🔥 FIXED METHOD - Dynamic star rating calculation
    public function show($slug)
    {
        // Get product with images and reviews
        $product = Product::active()
            ->with(['category', 'images', 'reviews.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Get reviews with pagination
        $reviews = $product->reviews()
            ->verified()
            ->with(['user', 'orderItem.order'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // 🔥 FIXED: Calculate review statistics properly
        $totalReviews = $product->reviews()->count();
        $averageRating = $totalReviews > 0 ? $product->reviews()->avg('rating') : 0;
        
        // Calculate rating distribution (1-5 stars)
        $ratingDistribution = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingDistribution[$i] = $product->reviews()->where('rating', $i)->count();
        }

        // Calculate recommendation percentage
        $recommendationPercentage = $totalReviews > 0 
            ? ($product->reviews()->where('is_recommended', true)->count() / $totalReviews) * 100 
            : 0;

        $reviewStats = [
            'average_rating' => round($averageRating, 1), // Round to 1 decimal
            'total_reviews' => $totalReviews,
            'rating_distribution' => $ratingDistribution,
            'recommendation_percentage' => round($recommendationPercentage, 1)
        ];

        // Related products
        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['images'])
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('detailproduk', compact('product', 'relatedProducts', 'reviews', 'reviewStats'));
    }

    public function featured()
    {
        $featuredProducts = Product::active()
            ->featured()
            ->with(['category', 'images'])
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('products.featured', compact('featuredProducts'));
    }

    public function timelessChoice()
    {
        $timelessProducts = Product::active()
            ->with(['category', 'images'])
            ->where('badge_type', '!=', 'just-in')
            ->where('created_at', '<', now()->subMonths(3))
            ->orderBy('rating_rata', 'desc')
            ->limit(6)
            ->get();

        return view('products.timeless', compact('timelessProducts'));
    }

    public function latest()
    {
        $latestProducts = Product::active()
            ->with(['category', 'images'])
            ->where(function ($q) {
                $q->where('badge_type', 'just-in')
                  ->orWhere('created_at', '>=', now()->subDays(30));
            })
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('products.latest', compact('latestProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return redirect()->route('products.index');
        }

        $products = Product::active()
            ->with(['category', 'images'])
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('deskripsi', 'like', '%' . $query . '%');
            })
            ->orderBy('total_penjualan', 'desc')
            ->paginate(12);

        return view('products.search', compact('products', 'query'));
    }

    // 🔹 API
    public function api_index(Request $request)
    {
        $query = Product::active()->with(['category', 'images']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('featured')) {
            $query->featured();
        }

        $products = $request->has('limit')
            ? $query->limit($request->limit)->get()
            : $query->paginate(12);

        return response()->json([
            'products' => $products->map(function ($product) {
                $primaryImage = $product->images()->where('is_primary', true)->first();

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'category' => $product->category?->name,
                    'price' => $product->formatted_price ?? number_format($product->harga, 0, ',', '.'),
                    'final_price' => number_format($product->final_price ?? $product->harga_jual, 0, ',', '.'),
                    'image' => $primaryImage ? asset('storage/' . $primaryImage->image_path) : null,
                    'badge' => $product->badge_type ?? null,
                    'is_on_sale' => $product->harga_jual < $product->harga,
                    'stock_status' => $product->stock_kuantitas > 0 ? 'In Stock' : 'Out of Stock',
                    'rating' => $product->rating_rata,
                    'url' => route('products.show', $product->slug),
                ];
            }),
            'pagination' => $products instanceof \Illuminate\Pagination\AbstractPaginator ? [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'total' => $products->total(),
            ] : null
        ]);
    }
}