@extends('layouts.app2')

@section('content')
<style>
    /* Reset dan Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .allproduk-container {
        background-color: #ffffff;
        color: #fff;
        min-height: 100vh;
        font-family: 'Arial', sans-serif;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Hero Section */
    .hero-section {
        padding: 80px 0;
        text-align: center;
    }

    .hero-title {
        font-size: 3.5rem;
        color: #000000;
        font-weight: bold;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 3rem;
        color: #000000;
        font-weight: bold;
        margin-bottom: 40px;
        line-height: 1.2;
    }

    .btn-primary {
        background-color: #000000;
        color: #ffffff;
        padding: 15px 40px;
        border: none;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #333333;
        transform: translateY(-2px);
    }

    /* Section Styles */
    .section {
        padding: 60px 0;
    }

    .section-title {
        font-size: 2rem;
        color: #000000;
        font-weight: bold;
        margin-bottom: 40px;
    }

    /* Best Seller Product Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
        margin-bottom: 40px;
    }

    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .product-card {
        background-color: transparent;
        border-radius: 20px;
        overflow: visible;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-image {
        width: 100%;
        height: 350px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        border-radius: 20px;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
        border-radius: 20px;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .product-info {
        position: absolute;
        bottom: 20px;
        left: 20px;
        right: 20px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transform: translateY(0);
        transition: all 0.3s ease;
    }

    .product-card:hover .product-info {
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .product-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-details {
        flex: 1;
    }

    .product-name {
        color: #000;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
        line-height: 1.3;
    }

    .product-price {
        color: #666;
        font-size: 14px;
        font-weight: 500;
    }

    .product-arrow {
        background: rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-left: 15px;
    }

    .product-arrow:hover {
        background: rgba(0, 0, 0, 0.1);
        transform: translateX(3px);
    }

    .product-arrow svg {
        width: 16px;
        height: 16px;
        color: #333;
    }

    /* Outfit Grid */
    /* Outfit Grid - Perbaikan */
    .outfit-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
        margin-top: 40px;
    }

    @media (max-width: 768px) {
        .outfit-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
    }

    .outfit-card {
        background-color: #ffffff;
        overflow: hidden;
        /* Menghilangkan hover effect untuk card */
        /* transition: all 0.3s ease; */
        /* Menghilangkan box-shadow/border */
        /* box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); */
    }

    /* Menghilangkan hover effect untuk card */
    /* .outfit-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
} */

    .outfit-content {
        display: flex;
        align-items: center;
        gap: 0;
        height: 200px;
    }

    .outfit-left .outfit-content {
        flex-direction: row;
    }

    .outfit-right .outfit-content {
        flex-direction: row-reverse;
    }

    .outfit-image {
        flex: 0 0 40%;
        height: 100%;
        overflow: hidden;
        position: relative;
    }

    .outfit-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Menghilangkan zoom effect pada hover */
        /* transition: transform 0.3s ease; */
    }

    /* Menghilangkan zoom effect pada hover */
    /* .outfit-card:hover .outfit-image img {
    transform: scale(1.05);
} */

    .outfit-text {
        flex: 1;
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding-bottom: 28px;
    }

    .outfit-title {
        font-size: 18px;
        font-weight: bold;
        color: #000000;
        margin-bottom: 130px;
        line-height: 1.4;
    }

    .outfit-date {
        font-size: 14px;
        color: #6c757d;
        margin: 0;
    }

    @media (max-width: 768px) {
        .outfit-content {
            flex-direction: column !important;
            height: auto;
        }

        .outfit-image {
            flex: none;
            width: 100%;
            height: 200px;
        }

        .outfit-text {
            padding: 20px;
        }

        .outfit-title {
            font-size: 16px;
        }
    }

    /* Filter Buttons */
    .filter-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 50px;
    }

    .filter-btn {
        padding: 12px 30px;
        border: 2px solid #000000;
        background-color: transparent;
        color: #000000;
        border-radius: 50px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background-color: #000000;
        color: #ffffff;
    }

    /* Products Grid (Collections) */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
        margin-bottom: 40px;
    }

    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Collections Product Card Styles - Same as Best Seller */
    .products-grid .product-card {
        background-color: transparent;
        border-radius: 20px;
        overflow: visible;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        position: relative;
    }

    .products-grid .product-card:hover {
        transform: translateY(-5px);
    }

    .products-grid .product-image {
        width: 100%;
        height: 350px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        border-radius: 20px;
    }

    .products-grid .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
        border-radius: 20px;
    }

    .products-grid .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .products-grid .product-info {
        position: absolute;
        bottom: 20px;
        left: 20px;
        right: 20px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transform: translateY(0);
        transition: all 0.3s ease;
    }

    .products-grid .product-card:hover .product-info {
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .products-grid .product-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .products-grid .product-details {
        flex: 1;
    }

    .products-grid .product-name {
        color: #000;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
        line-height: 1.3;
    }

    .products-grid .product-price {
        color: #666;
        font-size: 14px;
        font-weight: 500;
    }

    .products-grid .product-arrow {
        background: rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-left: 15px;
    }

    .products-grid .product-arrow:hover {
        background: rgba(0, 0, 0, 0.1);
        transform: translateX(3px);
    }

    .products-grid .product-arrow svg {
        width: 16px;
        height: 16px;
        color: #333;
    }

    /* See All Button */
    .see-all-container {
        text-align: center;
        margin-top: 40px;
    }

    .see-all-btn {
        color: #000000;
        font-size: 16px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .see-all-btn:hover {
        color: #6c757d;
    }

    /* Featured Section */
    .featured-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }

    @media (max-width: 768px) {
        .featured-grid {
            grid-template-columns: 1fr;
        }
    }

    .featured-card {
        border-radius: 12px;
        overflow: hidden;
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .featured-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .featured-universe {
        background-color: #343a40;
        color: #ffffff;
    }

    .featured-minimalist {
        background-color: #f8f9fa;
        color: #000000;
        border: 1px solid #e9ecef;
    }

    .featured-marvel {
        background: linear-gradient(135deg, #7c3aed, #2563eb);
        color: #ffffff;
    }

    .featured-future {
        background-color: #212529;
        color: #ffffff;
    }

    .featured-content {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .featured-content h4 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .featured-content p {
        opacity: 0.7;
    }

    /* Specific styling for featured images - NO ZOOM EFFECT */
    .featured-content img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0;
        /* Remove border radius since parent has it */
        display: block;
        /* Completely disable any transitions or transforms */
        transition: none !important;
        transform: none !important;
    }

    /* Override any inherited hover effects for featured images */
    .featured-card:hover .featured-content img,
    .featured-card .featured-content img:hover {
        transform: none !important;
        scale: none !important;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 1.5rem;
        }

        .filter-container {
            flex-wrap: wrap;
            gap: 10px;
        }

        .filter-btn {
            padding: 10px 20px;
            font-size: 14px;
        }
    }

    /* Loading Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-card,
    .outfit-card,
    .featured-card {
        animation: fadeInUp 0.6s ease forwards;
    }
</style>

<div class="allproduk-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="hero-title">
                The New Innovation:
            </h1>
            <h2 class="hero-subtitle">
                Form Chaos To Cosmos
            </h2>
            <button class="btn-primary">
                Get Started
            </button>
        </div>
    </div>

    <!-- Best Seller Section -->
    <div class="section">
        <div class="container">
            <h3 class="section-title">Best Seller</h3>
            <div class="product-grid">
                <!-- Product 1 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="storage/image/produk1.jpg" alt="Muzan T-Shirt">
                    </div>
                    <div class="product-info">
                        <div class="product-content">
                            <div class="product-details">
                                <h4 class="product-name">Muzan T-Shirt</h4>
                                <p class="product-price">IDR 50,000.00</p>
                            </div>
                            <button class="product-arrow">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14m-7-7 7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="storage/image/produk2.jpg" alt="Douma T-Shirt">
                    </div>
                    <div class="product-info">
                        <div class="product-content">
                            <div class="product-details">
                                <h4 class="product-name">Douma T-Shirt</h4>
                                <p class="product-price">IDR 50,000.00</p>
                            </div>
                            <button class="product-arrow">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14m-7-7 7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="storage/image/produk2.jpg" alt="MT-Shirt">
                    </div>
                    <div class="product-info">
                        <div class="product-content">
                            <div class="product-details">
                                <h4 class="product-name">MT-Shirt</h4>
                                <p class="product-price">IDR 50,000.00</p>
                            </div>
                            <button class="product-arrow">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14m-7-7 7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="storage/image/produk3.jpg" alt="Muzan T-Shirt">
                    </div>
                    <div class="product-info">
                        <div class="product-content">
                            <div class="product-details">
                                <h4 class="product-name">Muzan T-Shirt</h4>
                                <p class="product-price">IDR 50,000.00</p>
                            </div>
                            <button class="product-arrow">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14m-7-7 7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inspirational Outfits Section -->
    <div class="section">
        <div class="container">
            <h3 class="section-title">Inspirational Outfits</h3>
            <div class="outfit-grid">
                <!-- Outfit 1 -->
                <div class="outfit-card outfit-left">
                    <div class="outfit-content">
                        <div class="outfit-image">
                            <img src="storage/image/inspirasi1.jpg" alt="Build For The Grind Outfit">
                        </div>
                        <div class="outfit-text">
                            <h4 class="outfit-title">"Dare To Win" For The Dedicated Individuals</h4>
                            <p class="outfit-date">June 5, 2025</p>
                        </div>
                    </div>
                </div>

                <!-- Outfit 2 -->
                <div class="outfit-card outfit-right">
                    <div class="outfit-content">
                        <div class="outfit-text">
                            <h4 class="outfit-title">Made For Those Who Are Silent But Resilient</h4>
                            <p class="outfit-date">July 10, 2025</p>
                        </div>
                        <div class="outfit-image">
                            <img src="storage/image/inspirasi2.jpg" alt="Silent But Resilient Outfit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Collections Section -->
    <div class="section">
        <div class="container">
            <h3 class="section-title">Our Collections</h3>

            <!-- Filter Buttons -->
            <div class="filter-container">
                <button class="filter-btn active" data-filter="all">T-Shirt</button>
                <button class="filter-btn" data-filter="hoodie">Hoodie</button>
                <button class="filter-btn" data-filter="shoes">Shoes</button>
            </div>

            <!-- Products Grid -->
            <div class="products-grid">
                @for($i = 1; $i <= 16; $i++)
                    <div class="product-card">
                    <div class="product-image">
                        <img src="storage/image/produk2.jpg" alt="Product {{ $i }}">
                    </div>
                    <div class="product-info">
                        <div class="product-content">
                            <div class="product-details">
                                <h4 class="product-name">
                                    @if($i % 4 == 1) Cosmos Tshirt
                                    @elseif($i % 4 == 2) Hoodie
                                    @elseif($i % 4 == 3) Hoodie
                                    @else White Tshirt
                                    @endif
                                </h4>
                                <p class="product-price">
                                    @if($i % 4 == 1) IDR 150,000.00
                                    @elseif($i % 4 == 2) IDR 350,000.00
                                    @elseif($i % 4 == 3) IDR 350,000.00
                                    @else IDR 125,000.00
                                    @endif
                                </p>
                            </div>
                            <button class="product-arrow">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14m-7-7 7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
            </div>
            @endfor
        </div>

        <!-- See All Button -->
        <div class="see-all-container">
            <a href="#" class="see-all-btn">See All →</a>
        </div>
    </div>
</div>

<!-- Featured Section -->
<div class="section">
    <div class="container">
        <h3 class="section-title">Featured</h3>
        <div class="featured-grid">
            <!-- Featured Item 1 -->
            <div class="featured-card featured-universe">
                <div class="featured-content">
                    <img src="storage/image/banner2.jpg">
                </div>
            </div>

            <!-- Featured Item 2 -->
            <div class="featured-card featured-minimalist">
                <div class="featured-content">
                    <img src="storage/image/banner-sepatu.jpg">
                </div>
            </div>

            <!-- Featured Item 3 -->
            <div class="featured-card featured-marvel">
                <div class="featured-content">
                    <img src="storage/image/banner-sepatu2.jpg">
                </div>
            </div>

            <!-- Featured Item 4 -->
            <div class="featured-card featured-future">
                <div class="featured-content">
                    <img src="storage/image/banner-hoodie.jpg">
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));

                // Add active class to clicked button
                this.classList.add('active');

                // Filter logic here
                const filterType = this.getAttribute('data-filter');
                console.log('Filter by:', filterType);
            });
        });

        // Add click events to product cards
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
            card.addEventListener('click', function() {
                const productName = this.querySelector('.product-name');
                if (productName) {
                    console.log('Product clicked:', productName.textContent);
                }
            });
        });
    });
</script>
@endsection
