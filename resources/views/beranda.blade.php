@extends('layouts.app')

@section('content')

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* style back */
    .styleback {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding-left: 20px;
        padding-right: 20px;
    }

    .styleback img {
        max-width: 100%;
        height: auto;
        margin-top: 63px;
        padding: 0 20px;
    }

    .styleback h4 {
        margin-top: 25px;
        color: black;
        text-align: left;
        padding-left: 20px;
        font-weight: 500;
    }

    .styleback h3 {
        color: black;
        text-align: left;
        padding-left: 20px;
        font-weight: 600;
    }

    .styleback hr {
        width: 97%;
        height: 2px;
        background-color: #B9ACAA;
        margin: 20px auto;
    }

    /* timeless */
    .timeless {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding-left: 20px;
        padding-right: 20px;
    }

    .styleback h2 {
        color: black;
        text-align: left;
        padding-left: 20px;
        font-weight: 600;
    }

    /* Container */
    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Product Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 120px;
        padding: 30px 20px;
        max-width: 1100px;
        margin: 0 auto;
    }

    .product-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        transition: all 0.3s ease;
        cursor: pointer;
        border: 1px solid #f0f0f0;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.2);
    }

    .product-image {
        position: relative;
        width: 100%;
        height: 220px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin: 12px;
        border-radius: 12px;
        width: calc(100% - 24px);
        height: 200px;
    }

    .product-image img {
        width: 85%;
        height: 85%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.08);
    }

    .product-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 10;
    }

    .product-badge.bestseller {
        background: #ff6b35;
        color: white;
    }

    .product-badge.sustainable {
        background: #2ecc71;
        color: white;
    }

    .product-badge.just-in {
        background: #3498db;
        color: white;
    }

    .product-info {
        padding: 18px 20px 22px 20px;
        text-align: left;
    }

    .product-info h4 {
        font-size: 16px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 6px;
        line-height: 1.3;
    }

    .product-info p {
        color: #7f8c8d;
        font-size: 13px;
        margin-bottom: 3px;
        line-height: 1.4;
    }

    .color-info {
        font-size: 14px !important;
        color: #95a5a6 !important;
        margin-bottom: 12px !important;
        font-weight: 400 !important;
    }

    .price {
        color: #27ae60 !important;
        font-weight: 700 !important;
        font-size: 15px !important;
        margin-top: 8px !important;
        letter-spacing: -0.5px;
    }

    /* Placeholder untuk gambar */
    .placeholder-image {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #adb5bd;
        font-size: 14px;
        text-align: center;
        border-radius: 10px;
        font-weight: 500;
    }

    /* Hero Section */
    .hero {
        height: 100vh;
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('image/bannerfiks.jpeg');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
         display: flex;
        align-items: center;
        justify-content: flex-start;
        position: relative;
        padding-left: 80px;
    }

    .hero-content {
        max-width: 600px;
        color: white;
        z-index: 2;
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        letter-spacing: -2px;
        margin-left: -30px;
    }

    .hero-content .highlight {
        color: #ffffff;
        font-weight: 900;
    }

    /* Banner */
    .banner2 {
        margin-bottom: 80px;
    }

    /* Animations */
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

    /* RESPONSIVE STYLES */
    
    /* Large Desktop (1200px+) */
    @media (min-width: 1200px) {
        .product-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Tablet & Desktop (768px - 1199px) */
    @media (max-width: 1199px) and (min-width: 768px) {
        .hero {
            padding-left: 40px;
            padding-right: 40px;
            background-position: center center;
            background-attachment: scroll;
        }

        .hero-content h1 {
            font-size: 3rem;
            letter-spacing: -1px;
        }

        .product-grid {
            gap: 80px;
        }
    }

    /* Tablet (768px - 991px) */
    @media (max-width: 991px) and (min-width: 768px) {
        .hero {
            background-position: 60% center;
        }

        .product-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 60px;
        }

        .nav-menu {
            display: none;
        }

        .mobile-menu-toggle {
            display: block;
        }

        .logo {
            position: static;
            transform: none;
            height: 35px;
        }

        .nav-content {
            justify-content: space-between;
        }

        .nav-right {
            justify-content: flex-end;
        }

        .search-bar {
            width: 150px;
        }

        .search-bar:focus {
            width: 170px;
        }
    }

    /* Mobile Large (481px - 767px) */
    @media (max-width: 767px) {
        .hero {
            padding-left: 20px;
            padding-right: 20px;
            background-position: 70% center;
            background-attachment: scroll;
            min-height: 60vh;
        }

        .hero-content h1 {
            font-size: 2.5rem;
            letter-spacing: -0.5px;
            margin-left: 0;
        }

        .styleback {
            padding-left: 15px;
            padding-right: 15px;
        }

        .styleback img {
            padding: 0 10px;
            margin-top: 40px;
        }

        .styleback h4 {
            padding-left: 15px;
            margin-top: 20px;
        }

        .styleback h3 {
            padding-left: 15px;
        }

        .styleback h2 {
            padding-left: 15px;
        }

        .product-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 20px 10px;
        }

        .product-image {
            height: 160px;
        }

        .product-info {
            padding: 15px 16px 18px;
        }

        .product-info h4 {
            font-size: 15px;
        }

        .product-info p {
            font-size: 12px;
        }

        .color-info {
            font-size: 12px !important;
        }

        .price {
            font-size: 14px !important;
        }

        .banner2 {
            margin-bottom: 40px;
        }

        .search-bar {
            width: 120px;
        }

        .search-bar:focus {
            width: 140px;
        }
    }

    /* Mobile Small (320px - 480px) - ANDROID PHONES 2 COLUMNS */
    @media (max-width: 480px) {
        .hero {
            padding-left: 15px;
            padding-right: 15px;
            background-position: 75% center;
            background-attachment: scroll;
            min-height: 50vh;
        }

        .hero-content h1 {
            font-size: 2.2rem;
            letter-spacing: 0;
        }

        .styleback {
            padding-left: 10px;
            padding-right: 10px;
        }

        .styleback img {
            padding: 0 5px;
            margin-top: 30px;
        }

        .styleback h4 {
            padding-left: 10px;
            font-size: 14px;
        }

        .styleback h3 {
            padding-left: 10px;
            font-size: 18px;
        }

        .styleback h2 {
            padding-left: 10px;
            font-size: 22px;
        }

        /* TETAP 2 KOLOM untuk Android phones */
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            padding: 20px 5px;
        }

        .product-card {
            border-radius: 16px;
            margin: 0 2px;
        }

        .product-image {
            height: 140px;
            margin: 8px;
            width: calc(100% - 16px);
            border-radius: 10px;
        }

        .product-info {
            padding: 12px 14px 16px;
        }

        .product-info h4 {
            font-size: 14px;
        }

        .product-info p {
            font-size: 11px;
        }

        .color-info {
            font-size: 11px !important;
        }

        .price {
            font-size: 13px !important;
        }

        .product-badge {
            padding: 4px 8px;
            font-size: 9px;
            top: 10px;
            left: 10px;
        }

        .banner2 {
            margin-bottom: 30px;
        }
    }

    /* Extra Small Mobile (below 320px) */
    @media (max-width: 319px) {
        .hero {
            background-position: 80% center;
            min-height: 45vh;
        }

        .hero-content h1 {
            font-size: 1.8rem;
        }

        .product-grid {
            padding: 15px 2px;
        }

        .styleback {
            padding-left: 5px;
            padding-right: 5px;
        }
    }

    /* Landscape Mobile */
    @media (max-height: 500px) and (orientation: landscape) {
        .hero {
            min-height: 70vh;
            background-position: center center;
        }

        .hero-content h1 {
            font-size: 2.5rem;
        }
    }

    /* High DPI/Retina Displays */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
        .hero {
            background-size: cover;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="hero-content">
        <h1>
            Built For The<br>
            <span class="highlight">Grind</span>, Styled By<br>
            <span class="highlight">Chaos</span>
        </h1>
    </div>
</section>

<!-- styleback -->
<section class="styleback">
    <img src="image/styleback.png">
    <h4>Fashion</h4>
    <h3>Built for The Grind, Styled by Chaos</h3>
    <hr>

    <h2>Timeless Choice</h2>

    <!-- Product Grid -->
    <div class="container">
        <div class="product-grid">
            <!-- Product 1 -->
            <div class="product-card">
                <div class="product-image">
                    <div class="placeholder-image">
                        <div>Product Image<br>280x280</div>
                    </div>
                    <div class="product-badge bestseller">Bestseller</div>
                </div>
                <div class="product-info">
                    <h4>Nike Club</h4>
                    <p>Men's Shorts</p>
                    <p class="color-info">1 Colour</p>
                    <p class="price">Rp 529.000</p>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card">
                <div class="product-image">
                    <div class="placeholder-image">
                        <div>Product Image<br>280x280</div>
                    </div>
                </div>
                <div class="product-info">
                    <h4>Nike Gato</h4>
                    <p>Men's Shoes</p>
                    <p class="color-info">1 Colour</p>
                    <p class="price">Rp 1.729.000</p>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card">
                <div class="product-image">
                    <div class="placeholder-image">
                        <div>Product Image<br>280x280</div>
                    </div>
                </div>
                <div class="product-info">
                    <h4>Nike Total 90</h4>
                    <p>Men's Shoes</p>
                    <p class="color-info">1 Colour</p>
                    <p class="price">Rp 1.729.000</p>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card">
                <div class="product-image">
                    <div class="placeholder-image">
                        <div>Product Image<br>280x280</div>
                    </div>
                    <div class="product-badge sustainable">Sustainable Materials</div>
                </div>
                <div class="product-info">
                    <h4>Nike 24-7 PerfectStretch</h4>
                    <p>Men's Dri-FIT 15cm (approx.) Shorts</p>
                    <p class="color-info">1 Colour</p>
                    <p class="price">Rp 1.099.000</p>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="product-card">
                <div class="product-image">
                    <div class="placeholder-image">
                        <div>Product Image<br>280x280</div>
                    </div>
                    <div class="product-badge just-in">Just In</div>
                </div>
                <div class="product-info">
                    <h4>Nike Total 90</h4>
                    <p>Men's Dri-FIT Football Shirt</p>
                    <p class="color-info">1 Colour</p>
                    <p class="price">Rp 809.000</p>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="product-card">
                <div class="product-image">
                    <div class="placeholder-image">
                        <div>Product Image<br>280x280</div>
                    </div>
                    <div class="product-badge sustainable">Sustainable Materials</div>
                </div>
                <div class="product-info">
                    <h4>Nike Sportswear</h4>
                    <p>Women's V-Neck Jersey Top</p>
                    <p class="color-info">1 Colour</p>
                    <p class="price">Rp 599.000</p>
                </div>
            </div>
        </div>
    </div>

    <h2>The Latest</h2>
    <img src="image/banner.png" class="banner2">
</section>

<!-- Timeless Choice -->
<section class="timeless">

</section>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (navbar && window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else if (navbar) {
            navbar.classList.remove('scrolled');
        }
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Product card click handler
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('click', function() {
            const productName = this.querySelector('h4').textContent;
            console.log('Product clicked:', productName);
            // Add your product click logic here
        });
    });
</script>
@endsection