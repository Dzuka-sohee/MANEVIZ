<?php
use App\Models\Product;
?>
@extends('layouts.app2')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .product-detail-container {
        background-color: #f8f9fa;
        min-height: 100vh;
        font-family: 'Arial', sans-serif;
        padding: 60px 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Back Button */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: #6c757d;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 40px;
        border: 1px solid #e9ecef;
    }

    .back-button:hover {
        background: #f8f9fa;
        color: #495057;
        transform: translateX(-2px);
        text-decoration: none;
    }

    .back-button svg {
        width: 16px;
        height: 16px;
    }

    /* Main Product Section */
    .product-detail-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
    }

    .product-main {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: start;
    }

    /* Product Images */
    .product-images {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .main-image {
        width: 100%;
        height: 500px;
        background: #f8f9fa;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        border: 1px solid #e9ecef;
    }

    .main-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .thumbnail-images {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
    }

    .thumbnail {
        width: 100%;
        height: 100px;
        background: #f8f9fa;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        position: relative;
    }

    .thumbnail:hover,
    .thumbnail.active {
        border-color: #000;
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Product Info */
    .product-info {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .product-title {
        font-size: 2rem;
        font-weight: bold;
        color: #212529;
        line-height: 1.2;
    }

    .product-description {
        color: #6c757d;
        font-size: 16px;
        line-height: 1.6;
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .stars {
        display: flex;
        gap: 2px;
    }

    .star {
        width: 20px;
        height: 20px;
        color: #ffc107;
        fill: currentColor;
    }

    .rating-text {
        color: #6c757d;
        font-size: 14px;
    }

    .product-price {
        font-size: 2rem;
        font-weight: bold;
        color: #212529;
    }

    /* Color Selection */
    .color-section {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .section-label {
        font-weight: 600;
        color: #212529;
        font-size: 16px;
    }

    .color-options {
        display: flex;
        gap: 10px;
    }

    .color-option {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        position: relative;
    }

    .color-option.active {
        border-color: #212529;
        transform: scale(1.1);
    }

    .color-option:hover {
        transform: scale(1.05);
    }

    /* Size Selection */
    .size-section {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .size-options {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .size-option {
        padding: 12px 20px;
        border: 2px solid #e9ecef;
        background: white;
        color: #6c757d;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease;
        min-width: 50px;
        text-align: center;
    }

    .size-option:hover {
        border-color: #212529;
        color: #212529;
    }

    .size-option.active {
        background: #212529;
        color: white;
        border-color: #212529;
    }

    .size-guide {
        color: #6c757d;
        font-size: 13px;
        text-decoration: underline;
        cursor: pointer;
    }

    /* Actions */
    .product-actions {
        display: flex;
        gap: 15px;
        align-items: center;
        margin-top: 20px;
    }

    .add-to-cart-btn {
        flex: 1;
        background: #212529;
        color: white;
        border: none;
        padding: 16px 24px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .add-to-cart-btn:hover {
        background: #343a40;
        transform: translateY(-2px);
    }

    .wishlist-btn {
        width: 56px;
        height: 56px;
        border: 2px solid #e9ecef;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .wishlist-btn:hover {
        border-color: #212529;
        background: #f8f9fa;
    }

    .wishlist-btn svg {
        width: 20px;
        height: 20px;
        color: #6c757d;
    }

    .wishlist-btn:hover svg {
        color: #212529;
    }

    /* Delivery Info */
    .delivery-info {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 16px 0;
        color: #6c757d;
        font-size: 14px;
        border-top: 1px solid #e9ecef;
        margin-top: 20px;
    }

    .delivery-info svg {
        width: 20px;
        height: 20px;
        color: #28a745;
    }

    /* Related Products */
    .related-section {
        margin-top: 80px;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #212529;
        margin-bottom: 30px;
        text-align: center;
    }

    .related-products {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .related-product {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        border: 1px solid #e9ecef;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .related-product:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        text-decoration: none;
        color: inherit;
    }

    .related-image {
        width: 100%;
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .related-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .related-product:hover .related-image img {
        transform: scale(1.05);
    }

    .related-info {
        padding: 20px;
    }

    .related-name {
        font-weight: 600;
        color: #212529;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .related-price {
        color: #6c757d;
        font-size: 14px;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .container {
            padding: 0 15px;
        }

        .product-detail-card {
            padding: 30px;
        }

        .product-main {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .main-image {
            height: 400px;
        }

        .product-title {
            font-size: 1.75rem;
        }

        .related-products {
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .product-detail-container {
            padding: 30px 0;
        }

        .product-detail-card {
            padding: 20px;
            border-radius: 16px;
        }

        .main-image {
            height: 350px;
        }

        .thumbnail-images {
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .thumbnail {
            height: 80px;
        }

        .product-title {
            font-size: 1.5rem;
        }

        .product-price {
            font-size: 1.75rem;
        }

        .product-actions {
            flex-direction: column;
            gap: 12px;
        }

        .wishlist-btn {
            width: 100%;
            height: 50px;
        }

        .related-products {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .related-image {
            height: 180px;
        }

        .related-info {
            padding: 15px;
        }
    }

    @media (max-width: 576px) {
        .back-button {
            padding: 10px 16px;
            font-size: 13px;
        }

        .product-detail-card {
            padding: 15px;
        }

        .main-image {
            height: 280px;
        }

        .thumbnail {
            height: 70px;
        }

        .product-title {
            font-size: 1.25rem;
        }

        .product-price {
            font-size: 1.5rem;
        }

        .color-option {
            width: 35px;
            height: 35px;
        }

        .size-option {
            padding: 10px 16px;
            font-size: 13px;
        }

        .add-to-cart-btn {
            padding: 14px 20px;
            font-size: 14px;
        }

        .related-products {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="product-detail-container">
    <div class="container">
        <!-- Back Button -->
        <a href="{{ route('products.index') }}" class="back-button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5m7 7-7-7 7-7"/>
            </svg>
            Back To All Product
        </a>

        <!-- Main Product Detail -->
        <div class="product-detail-card">
            <div class="product-main">
                <!-- Product Images -->
                <div class="product-images">
                    <div class="main-image">
                        @if($product->images->isNotEmpty())
                            <img id="mainProductImage" src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}">
                        @else
                            <img id="mainProductImage" src="{{ asset('images/no-image.png') }}" alt="No Image">
                        @endif
                    </div>

                    @if($product->images->count() > 1)
                    <div class="thumbnail-images">
                        @foreach($product->images->take(4) as $index => $image)
                        <div class="thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}', this)">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="product-info">
                    <h1 class="product-title">{{ $product->name }}</h1>

                    @if($product->deskripsi_singkat)
                    <p class="product-description">{{ $product->deskripsi_singkat }}</p>
                    @endif

                    <!-- Rating -->
                    <div class="product-rating">
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="star" viewBox="0 0 24 24" fill="{{ $i <= ($product->rating_rata ?? 5) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2">
                                    <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="rating-text">{{ $product->total_reviews ?? 42 }} reviews</span>
                    </div>

                    <!-- Price -->
                    <div class="product-price">
                        IDR {{ number_format($product->harga_jual ?? $product->harga, 0, ',', '.') }}
                    </div>

                    <!-- Color Selection -->
                    <div class="color-section">
                        <label class="section-label">Color: <span id="selectedColor">Black</span></label>
                        <div class="color-options">
                            <div class="color-option active" style="background-color: #000000" data-color="Black" onclick="selectColor(this, 'Black')"></div>
                            <div class="color-option" style="background-color: #ffffff; border: 2px solid #e9ecef;" data-color="White" onclick="selectColor(this, 'White')"></div>
                            <div class="color-option" style="background-color: #6c757d" data-color="Gray" onclick="selectColor(this, 'Gray')"></div>
                        </div>
                    </div>

                    <!-- Size Selection -->
                    <div class="size-section">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <label class="section-label">Size</label>
                            <span class="size-guide">Size guides</span>
                        </div>
                        <div class="size-options">
                            @php
                                $sizes = ['S', 'M', 'L', 'XL'];
                            @endphp
                            @foreach($sizes as $size)
                            <div class="size-option {{ $size === 'M' ? 'active' : '' }}" data-size="{{ $size }}" onclick="selectSize(this, '{{ $size }}')">
                                {{ $size }}
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="product-actions">
                        <button class="add-to-cart-btn" onclick="addToCart()">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px;">
                                <circle cx="8" cy="21" r="1"></circle>
                                <circle cx="19" cy="21" r="1"></circle>
                                <path d="m2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                            </svg>
                            Add to Cart
                        </button>
                        <button class="wishlist-btn" onclick="toggleWishlist()">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Delivery Info -->
                    <div class="delivery-info">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 3h5v5M4 20L21 3m0 16v-5h-5M8 20l-5-5"/>
                        </svg>
                        Free delivery on orders over IDR 300,000
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <div class="related-section">
            <h3 class="section-title">You might also like</h3>
            <div class="related-products">
                @foreach($relatedProducts as $relatedProduct)
                <a href="{{ route('products.show', $relatedProduct->slug) }}" class="related-product">
                    <div class="related-image">
                        @if($relatedProduct->productImages && $relatedProduct->productImages->isNotEmpty())
                            <img src="{{ asset('storage/' . $relatedProduct->productImages->first()->image_path) }}" alt="{{ $relatedProduct->name }}">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                        @endif
                    </div>
                    <div class="related-info">
                        <h4 class="related-name">{{ $relatedProduct->name }}</h4>
                        <p class="related-price">IDR {{ number_format($relatedProduct->harga_jual ?? $relatedProduct->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    let selectedColor = 'Black';
    let selectedSize = 'M';

    function changeMainImage(imageSrc, thumbnailElement) {
        document.getElementById('mainProductImage').src = imageSrc;

        // Remove active class from all thumbnails
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });

        // Add active class to clicked thumbnail
        thumbnailElement.classList.add('active');
    }

    function selectColor(element, color) {
        // Remove active class from all color options
        document.querySelectorAll('.color-option').forEach(option => {
            option.classList.remove('active');
        });

        // Add active class to selected color
        element.classList.add('active');

        // Update selected color display
        document.getElementById('selectedColor').textContent = color;
        selectedColor = color;
    }

    function selectSize(element, size) {
        // Remove active class from all size options
        document.querySelectorAll('.size-option').forEach(option => {
            option.classList.remove('active');
        });

        // Add active class to selected size
        element.classList.add('active');
        selectedSize = size;
    }

    function addToCart() {
        // Add to cart functionality
        console.log('Adding to cart:', {
            product: '{{ $product->name }}',
            color: selectedColor,
            size: selectedSize,
            price: '{{ $product->harga_jual ?? $product->harga }}'
        });

        // You can add AJAX call here to add to cart
        alert('Product added to cart!\nProduct: {{ $product->name }}\nColor: ' + selectedColor + '\nSize: ' + selectedSize);
    }

    function toggleWishlist() {
        // Toggle wishlist functionality
        const wishlistBtn = document.querySelector('.wishlist-btn svg');
        const isInWishlist = wishlistBtn.getAttribute('fill') === 'currentColor';

        if (isInWishlist) {
            wishlistBtn.setAttribute('fill', 'none');
            alert('Removed from wishlist');
        } else {
            wishlistBtn.setAttribute('fill', 'currentColor');
            alert('Added to wishlist');
        }
    }
</script>
@endsection
