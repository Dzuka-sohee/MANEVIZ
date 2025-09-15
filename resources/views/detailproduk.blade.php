<?php
use App\Models\Product;
?>
@extends('layouts.app2')

@section('content')
    <!-- CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* ... (keeping all existing styles) ... */
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
            margin-top: 50px;
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
            transition: opacity 0.3s ease;
        }

        /* 🔥 NEW: Slideshow Thumbnail Container */
        .thumbnail-slideshow {
            position: relative;
            overflow: hidden;
        }

        .thumbnail-container {
            display: flex;
            transition: transform 0.3s ease;
            gap: 15px;
        }

        .thumbnail {
            flex: 0 0 calc(25% - 11.25px); /* 4 thumbnails per view */
            height: 100px;
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
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

        /* 🔥 NEW: Slideshow Navigation */
        .slideshow-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .nav-button {
            background: white;
            border: 2px solid #e9ecef;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nav-button:hover:not(:disabled) {
            border-color: #212529;
            background: #f8f9fa;
        }

        .nav-button:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .nav-button svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
        }

        .slideshow-dots {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #e9ecef;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background: #212529;
            transform: scale(1.2);
        }

        /* Hide navigation when there are 4 or fewer images */
        .thumbnail-slideshow.no-navigation .slideshow-nav {
            display: none;
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

        /* Color & Size Selection */
        .color-section, .size-section {
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
        }

        .color-option.active {
            border-color: #212529;
            transform: scale(1.1);
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

        .add-to-cart-btn:hover:not(:disabled) {
            background: #343a40;
            transform: translateY(-2px);
        }

        .add-to-cart-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
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
        }

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
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        /* Reviews Section */
        .reviews-section {
            margin-top: 80px;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #212529;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Review Summary */
        .review-summary {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 60px;
            padding-bottom: 40px;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 40px;
        }

        .overall-rating {
            text-align: center;
        }

        .rating-number {
            font-size: 3rem;
            font-weight: bold;
            color: #212529;
            display: block;
            margin-bottom: 15px;
        }

        .rating-stars-large {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-bottom: 15px;
        }

        .star-large {
            width: 28px;
            height: 28px;
            color: #ffc107;
            fill: currentColor;
        }

        .review-count {
            color: #6c757d;
            font-size: 14px;
            margin: 0;
        }

        .rating-distribution {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .rating-row {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .rating-label {
            width: 60px;
            font-size: 14px;
            color: #6c757d;
            text-align: right;
        }

        .rating-bar {
            flex: 1;
            height: 8px;
            background: #f8f9fa;
            border-radius: 4px;
            overflow: hidden;
        }

        .rating-fill {
            height: 100%;
            background: #ffc107;
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .rating-count-small {
            width: 30px;
            font-size: 14px;
            color: #6c757d;
            text-align: center;
        }

        .recommendation-rate {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #f8f9fa;
            text-align: center;
        }

        .recommendation-percentage {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
            display: block;
            margin-bottom: 5px;
        }

        .recommendation-text {
            color: #6c757d;
            font-size: 14px;
        }

        /* Reviews List */
        .reviews-list {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .review-item {
            padding: 25px 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .review-item:last-child {
            border-bottom: none;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .reviewer-avatar {
            width: 50px;
            height: 50px;
            background: #6c757d;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
        }

        .reviewer-details {
            flex: 1;
        }

        .reviewer-name {
            font-size: 16px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 8px 0;
        }

        .review-meta {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .review-rating {
            display: flex;
            gap: 2px;
        }

        .star-small {
            width: 16px;
            height: 16px;
            color: #ffc107;
            fill: currentColor;
        }

        .review-date {
            color: #6c757d;
            font-size: 13px;
        }

        .verified-badge {
            background: #28a745;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }

        .recommended-badge {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #28a745;
            font-size: 13px;
            font-weight: 500;
        }

        .recommended-badge svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
        }

        .review-content {
            margin-bottom: 15px;
        }

        .review-content p {
            color: #495057;
            line-height: 1.6;
            margin: 0;
        }

        .review-images {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .review-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .review-image:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .review-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-reviews {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .no-reviews svg {
            width: 64px;
            height: 64px;
            color: #dee2e6;
            margin-bottom: 20px;
        }

        .no-reviews h4 {
            font-size: 1.25rem;
            color: #495057;
            margin-bottom: 10px;
        }

        .no-reviews p {
            font-size: 14px;
            margin: 0;
        }

        /* Image Modal */
        .image-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            cursor: pointer;
        }

        .image-modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 8px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .image-modal.active {
            display: flex;
        }

        /* Related Products */
        .related-section {
            margin-top: 80px;
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

        /* Spinning animation */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .container {
                padding: 0 15px;
            }

            .product-detail-card, .reviews-section {
                padding: 30px;
            }

            .product-main {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .review-summary {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .related-products {
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }

            .thumbnail {
                flex: 0 0 calc(33.333% - 10px); /* 3 thumbnails per view on tablet */
            }
        }

        @media (max-width: 768px) {
            .product-detail-container {
                padding: 30px 0;
            }

            .product-detail-card, .reviews-section {
                padding: 20px;
            }

            .main-image {
                height: 350px;
            }

            .related-products {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .review-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .thumbnail {
                flex: 0 0 calc(50% - 7.5px); /* 2 thumbnails per view on mobile */
            }
        }

        @media (max-width: 576px) {
            .product-detail-card, .reviews-section {
                padding: 15px;
            }

            .main-image {
                height: 280px;
            }

            .related-products {
                grid-template-columns: 1fr;
            }

            .reviewer-info {
                gap: 12px;
            }

            .reviewer-avatar {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .thumbnail {
                flex: 0 0 100%; /* 1 thumbnail per view on small mobile */
            }
        }
    </style>

    <div class="product-detail-container">
        <div class="container">
            <!-- Main Product Detail -->
            <div class="product-detail-card">
                <div class="product-main">
                    <!-- Product Images -->
                    <div class="product-images">
                        <div class="main-image">
                            @if (isset($product) && $product instanceof \App\Models\Product && $product->images->isNotEmpty())
                                <img id="mainProductImage"
                                    src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                    alt="{{ $product->name }}">
                            @else
                                <img id="mainProductImage" src="{{ asset('images/no-image.png') }}" alt="No Image">
                            @endif
                        </div>

                        @if ($product->images && $product->images->count() > 1)
                            <!-- 🔥 NEW: Slideshow Thumbnail Container -->
                            <div class="thumbnail-slideshow {{ $product->images->count() <= 4 ? 'no-navigation' : '' }}">
                                <div class="thumbnail-container" id="thumbnailContainer">
                                    @foreach ($product->images as $index => $image)
                                        <div class="thumbnail {{ $index == 0 ? 'active' : '' }}" 
                                             data-index="{{ $index }}"
                                             onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}', this, {{ $index }})">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image {{ $index + 1 }}">
                                        </div>
                                    @endforeach
                                </div>
                                
                                <!-- Navigation Controls -->
                                @if ($product->images->count() > 4)
                                    <div class="slideshow-nav">
                                        <button class="nav-button" id="prevBtn" onclick="previousSlide()">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="15,18 9,12 15,6"></polyline>
                                            </svg>
                                        </button>
                                        
                                        <div class="slideshow-dots" id="slideshowDots">
                                            <!-- Dots will be generated by JavaScript -->
                                        </div>
                                        
                                        <button class="nav-button" id="nextBtn" onclick="nextSlide()">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="9,18 15,12 9,6"></polyline>
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="product-info">
                        <h1 class="product-title">{{ $product->name }}</h1>

                        @if ($product->deskripsi_singkat)
                            <p class="product-description">{{ $product->deskripsi_singkat }}</p>
                        @endif

                        <!-- Dynamic Rating Display in Product Header -->
                        <div class="product-rating">
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="star" viewBox="0 0 24 24"
                                        fill="{{ $i <= round($reviewStats['average_rating']) ? 'currentColor' : 'none' }}"
                                        stroke="currentColor" stroke-width="2">
                                        <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26" />
                                    </svg>
                                @endfor
                            </div>
                            <span class="rating-text">{{ $reviewStats['total_reviews'] }} reviews</span>
                        </div>

                        <!-- Price -->
                        <div class="product-price">
                            IDR {{ number_format($product->harga_jual ?? $product->harga, 0, ',', '.') }}
                        </div>

                        <!-- Color Selection -->
                        <div class="color-section">
                            <label class="section-label">Color: <span id="selectedColor">Black</span></label>
                            <div class="color-options">
                                <div class="color-option active" style="background-color: #000000" data-color="Black"
                                    onclick="selectColor(this, 'Black')"></div>
                                <div class="color-option" style="background-color: #ffffff; border: 2px solid #e9ecef;"
                                    data-color="White" onclick="selectColor(this, 'White')"></div>
                                <div class="color-option" style="background-color: #6c757d" data-color="Gray"
                                    onclick="selectColor(this, 'Gray')"></div>
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
                                @foreach ($sizes as $size)
                                    <div class="size-option {{ $size === 'M' ? 'active' : '' }}"
                                        data-size="{{ $size }}" onclick="selectSize(this, '{{ $size }}')">
                                        {{ $size }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Stock Info -->
                        @if($product->stock_kuantitas <= 10 && $product->stock_kuantitas > 0)
                            <div class="stock-warning" style="color: #dc3545; font-size: 14px; font-weight: 500;">
                                Stok tinggal {{ $product->stock_kuantitas }} item
                            </div>
                        @elseif($product->stock_kuantitas <= 0)
                            <div class="stock-warning" style="color: #dc3545; font-size: 14px; font-weight: 500;">
                                Stok habis
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="product-actions">
                            <button class="add-to-cart-btn" onclick="addToCart()" {{ $product->stock_kuantitas <= 0 ? 'disabled' : '' }}>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    style="width: 20px; height: 20px;">
                                    <circle cx="8" cy="21" r="1"></circle>
                                    <circle cx="19" cy="21" r="1"></circle>
                                    <path d="m2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                                </svg>
                                {{ $product->stock_kuantitas <= 0 ? 'Stok Habis' : 'Add to Cart' }}
                            </button>
                            <button class="wishlist-btn" onclick="toggleWishlist()">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Delivery Info -->
                        <div class="delivery-info">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 3h5v5M4 20L21 3m0 16v-5h-5M8 20l-5-5" />
                            </svg>
                            Free delivery on orders over IDR 300,000
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="reviews-section">
                <h3 class="section-title">Customer Reviews</h3>
                
                <!-- Review Summary with Dynamic Data -->
                <div class="review-summary">
                    <div class="review-summary-left">
                        <div class="overall-rating">
                            <span class="rating-number">{{ $reviewStats['average_rating'] }}</span>
                            <div class="rating-stars-large">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="star-large" viewBox="0 0 24 24"
                                        fill="{{ $i <= round($reviewStats['average_rating']) ? 'currentColor' : 'none' }}"
                                        stroke="currentColor" stroke-width="2">
                                        <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="review-count">Based on {{ $reviewStats['total_reviews'] }} reviews</p>
                        </div>
                    </div>
                    
                    <div class="review-summary-right">
                        <!-- Rating Distribution with Dynamic Data -->
                        <div class="rating-distribution">
                            @for ($rating = 5; $rating >= 1; $rating--)
                                @php
                                    $count = $reviewStats['rating_distribution'][$rating] ?? 0;
                                    $percentage = $reviewStats['total_reviews'] > 0 ? ($count / $reviewStats['total_reviews']) * 100 : 0;
                                @endphp
                                <div class="rating-row">
                                    <span class="rating-label">{{ $rating }} star</span>
                                    <div class="rating-bar">
                                        <div class="rating-fill" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="rating-count-small">{{ $count }}</span>
                                </div>
                            @endfor
                        </div>
                        
                        <!-- Recommendation Rate -->
                        @if($reviewStats['total_reviews'] > 0)
                            <div class="recommendation-rate">
                                <span class="recommendation-percentage">{{ $reviewStats['recommendation_percentage'] }}%</span>
                                <span class="recommendation-text">of customers recommend this product</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Reviews List -->
                @if($reviews->count() > 0)
                    <div class="reviews-list">
                        @foreach($reviews as $review)
                            <div class="review-item">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <div class="reviewer-avatar">
                                            {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                        </div>
                                        <div class="reviewer-details">
                                            <h4 class="reviewer-name">{{ $review->user->name }}</h4>
                                            <div class="review-meta">
                                                <!-- Individual Review Stars -->
                                                <div class="review-rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="star-small" viewBox="0 0 24 24"
                                                            fill="{{ $i <= $review->rating ? 'currentColor' : 'none' }}"
                                                            stroke="currentColor" stroke-width="2">
                                                            <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <span class="review-date">{{ $review->created_at->format('M d, Y') }}</span>
                                                @if($review->is_verified)
                                                    <span class="verified-badge">Verified Purchase</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if($review->is_recommended)
                                        <div class="recommended-badge">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                                            </svg>
                                            Recommended
                                        </div>
                                    @endif
                                </div>
                                
                                @if($review->review)
                                    <div class="review-content">
                                        <p>{{ $review->review }}</p>
                                    </div>
                                @endif
                                
                                <!-- Review Images -->
                                @if($review->images && count($review->images) > 0)
                                    <div class="review-images">
                                        @foreach($review->images as $image)
                                            <div class="review-image" onclick="openImageModal('{{ asset('storage/' . $image) }}')">
                                                <img src="{{ asset('storage/' . $image) }}" alt="Review Image">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    @if($reviews->hasPages())
                        <div class="reviews-pagination">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                @else
                    <div class="no-reviews">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 12l2 2 4-4M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <h4>No reviews yet</h4>
                        <p>Be the first to review this product!</p>
                    </div>
                @endif
            </div>

            <!-- Related Products -->
            @if (isset($relatedProducts) && $relatedProducts->count() > 0)
                <div class="related-section">
                    <h3 class="section-title">You might also like</h3>
                    <div class="related-products">
                        @foreach ($relatedProducts as $relatedProduct)
                            <a href="{{ route('products.show', $relatedProduct->slug) }}" class="related-product">
                                <div class="related-image">
                                    @if ($relatedProduct->images && $relatedProduct->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $relatedProduct->images->first()->image_path) }}"
                                            alt="{{ $relatedProduct->name }}">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                                    @endif
                                </div>
                                <div class="related-info">
                                    <h4 class="related-name">{{ $relatedProduct->name }}</h4>
                                    <p class="related-price">IDR
                                        {{ number_format($relatedProduct->harga_jual ?? $relatedProduct->harga, 0, ',', '.') }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Image Modal -->
    <div class="image-modal" id="imageModal" onclick="closeImageModal()">
        <img id="modalImage" src="" alt="Review Image">
    </div>

    <script>
        // Slideshow variables
        let currentSlide = 0;
        let totalImages = 0;
        let imagesPerSlide = 4; // Default for desktop

        // Initialize slideshow
        document.addEventListener('DOMContentLoaded', function() {
            initializeSlideshow();
            updateResponsiveSettings();
        });

        // Update settings based on screen size
        function updateResponsiveSettings() {
            const screenWidth = window.innerWidth;
            if (screenWidth <= 576) {
                imagesPerSlide = 1;
            } else if (screenWidth <= 768) {
                imagesPerSlide = 2;
            } else if (screenWidth <= 992) {
                imagesPerSlide = 3;
            } else {
                imagesPerSlide = 4;
            }
            
            // Recalculate total slides needed
            if (totalImages > 0) {
                const totalSlides = Math.ceil(totalImages / imagesPerSlide);
                generateDots(totalSlides);
                updateSlidePosition();
            }
        }

        function initializeSlideshow() {
            const thumbnails = document.querySelectorAll('.thumbnail');
            totalImages = thumbnails.length;
            
            if (totalImages <= imagesPerSlide) {
                // Hide navigation if all images fit in one view
                const slideshow = document.querySelector('.thumbnail-slideshow');
                if (slideshow) {
                    slideshow.classList.add('no-navigation');
                }
                return;
            }
            
            const totalSlides = Math.ceil(totalImages / imagesPerSlide);
            generateDots(totalSlides);
            updateNavigationButtons();
        }

        function generateDots(totalSlides) {
            const dotsContainer = document.getElementById('slideshowDots');
            if (!dotsContainer) return;
            
            dotsContainer.innerHTML = '';
            
            for (let i = 0; i < totalSlides; i++) {
                const dot = document.createElement('div');
                dot.className = `dot ${i === 0 ? 'active' : ''}`;
                dot.onclick = () => goToSlide(i);
                dotsContainer.appendChild(dot);
            }
        }

        function updateSlidePosition() {
            const container = document.getElementById('thumbnailContainer');
            if (!container) return;
            
            const slideWidth = 100 / imagesPerSlide;
            const translateX = -currentSlide * slideWidth;
            container.style.transform = `translateX(${translateX}%)`;
            
            updateDots();
            updateNavigationButtons();
        }

        function updateDots() {
            const dots = document.querySelectorAll('.dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        function updateNavigationButtons() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const totalSlides = Math.ceil(totalImages / imagesPerSlide);
            
            if (prevBtn) {
                prevBtn.disabled = currentSlide === 0;
            }
            
            if (nextBtn) {
                nextBtn.disabled = currentSlide === totalSlides - 1;
            }
        }

        function previousSlide() {
            if (currentSlide > 0) {
                currentSlide--;
                updateSlidePosition();
            }
        }

        function nextSlide() {
            const totalSlides = Math.ceil(totalImages / imagesPerSlide);
            if (currentSlide < totalSlides - 1) {
                currentSlide++;
                updateSlidePosition();
            }
        }

        function goToSlide(slideIndex) {
            currentSlide = slideIndex;
            updateSlidePosition();
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            updateResponsiveSettings();
        });

        // Existing functions
        let selectedColor = 'Black';
        let selectedSize = 'M';

        function changeMainImage(imageSrc, thumbnailElement, imageIndex) {
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
            // Check if user is authenticated
            @guest
                showNotification('error', 'Silakan login terlebih dahulu untuk menambahkan produk ke keranjang');
                setTimeout(() => {
                    window.location.href = '{{ route("login") }}';
                }, 2000);
                return;
            @endguest

            // Disable button to prevent double submission
            const button = document.querySelector('.add-to-cart-btn');
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = `
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; animation: spin 1s linear infinite;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M16 12l-4-4-4 4M12 16V8"></path>
                </svg>
                Adding...
            `;

            // Prepare data
            const data = {
                product_id: {{ $product->id }},
                kuantitas: 1,
                color: selectedColor,
                size: selectedSize
            };

            // AJAX request
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    showNotification('success', result.message);
                    updateCartCount(result.cart_count);
                } else {
                    showNotification('error', result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', 'Terjadi kesalahan. Silakan coba lagi.');
            })
            .finally(() => {
                button.disabled = false;
                button.innerHTML = originalText;
            });
        }

        function showNotification(type, message) {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 8px;
                color: white;
                z-index: 10000;
                font-weight: 500;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transform: translateX(400px);
                transition: transform 0.3s ease;
                max-width: 350px;
                ${type === 'success' ? 'background: #28a745;' : 'background: #dc3545;'}
            `;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);

            setTimeout(() => {
                notification.style.transform = 'translateX(400px)';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        function updateCartCount(count) {
            const cartCountElements = document.querySelectorAll('.cart-count, #cart-count, .navbar-cart-count');
            cartCountElements.forEach(element => {
                element.textContent = count;
                element.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    element.style.transform = 'scale(1)';
                }, 200);
            });
        }

        function toggleWishlist() {
            const wishlistBtn = document.querySelector('.wishlist-btn svg');
            const isInWishlist = wishlistBtn.getAttribute('fill') === 'currentColor';

            if (isInWishlist) {
                wishlistBtn.setAttribute('fill', 'none');
                showNotification('success', 'Removed from wishlist');
            } else {
                wishlistBtn.setAttribute('fill', 'currentColor');
                showNotification('success', 'Added to wishlist');
            }
        }

        // Image Modal Functions
        function openImageModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            
            modalImage.src = imageSrc;
            modal.classList.add('active');
            
            // Prevent body scroll when modal is open
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('active');
            
            // Restore body scroll
            document.body.style.overflow = 'auto';
        }

        // Close modal with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
@endsection