<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css">
    <title>@yield('title', 'MANEVIZ')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: white;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 15px 0;
            transition: all 0.3s ease;
            background: transparent;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            flex: 1;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
            position: relative;
        }

        .navbar.scrolled .nav-menu a {
            color: #333;
        }

        .nav-menu a:hover {
            color: #ff6b6b;
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #ff6b6b;
            transition: width 0.3s ease;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        /* Logo Container Styles */
        .logo-container {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            height: 93px;
            width: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo {
            height: 93px;
            width: auto;
            object-fit: contain;
            transition: opacity 0.3s ease;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .logo-white {
            opacity: 1;
        }

        .logo-black {
            opacity: 0;
        }

        .navbar.scrolled .logo-white {
            opacity: 0;
        }

        .navbar.scrolled .logo-black {
            opacity: 1;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
            justify-content: flex-end;
        }

        .search-container {
            position: relative;
        }

        .search-bar {
            padding: 8px 40px 8px 15px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 0.9rem;
            width: 200px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .search-bar::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-bar:focus {
            outline: none;
            border-color: #ffff;
            background: rgba(255, 255, 255, 0.2);
            width: 220px;
        }

        .navbar.scrolled .search-bar {
            border-color: rgba(51, 51, 51, 0.3);
            background: rgba(255, 255, 255, 0.8);
            color: #333;
        }

        .navbar.scrolled .search-bar::placeholder {
            color: rgba(51, 51, 51, 0.7);
        }

        .navbar.scrolled .search-bar:focus {
            border-color: black;
            background: rgba(255, 255, 255, 0.9);
        }

        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 1rem;
            pointer-events: none;
        }

        .navbar.scrolled .search-icon {
            color: #333;
        }

        .nav-icons {
            display: flex;
            gap: 1rem;
            align-items: center;
            margin-left: 1rem;
        }

        .nav-icon {
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.3s ease;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .navbar.scrolled .nav-icon {
            color: #333;
        }

        .nav-icon:hover {
            color: #ff6b6b;
        }

        .cart-icon {
            position: relative;
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: block;
            padding: 12px 20px;
            color: #333;
            text-decoration: none;
            font-size: 0.9rem;
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.3s ease;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            color: #ff6b6b;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item.logout {
            color: #dc3545;
        }

        .dropdown-item.logout:hover {
            background: #dc3545;
            color: white;
        }

        /* Footer Styles */
        .footer {
            background: #000;
            color: white;
            position: relative;
            border-top: 1px solid #333;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 25px 20px;
            position: relative;
        }

        .footer-main {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
        }

        .footer-left {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            margin-left: -8px;
            gap: 10px;
            margin-bottom: 1px;
        }

        .footer-logo img {
            height: 80px;
            width: auto;
        }

        .footer-social-section h4 {
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 12px;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-social {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .social-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-icon:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        .auth-buttons {
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-width: 200px;
        }

        .auth-btn {
            padding: 10px 20px;
            border: 2px solid white;
            border-radius: 25px;
            background: transparent;
            color: white;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .auth-btn.sign-in {
            background: transparent;
            color: white;
        }

        .auth-btn.sign-up {
            background: white;
            color: black;
        }

        .auth-btn.sign-in:hover {
            background: white;
            color: black;
        }

        .auth-btn.sign-up:hover {
            background: transparent;
            color: white;
        }

        .footer-right {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: flex-end;
            text-align: right;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .copy {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 6px 0;
            border-bottom: 1px solid transparent;
        }

        .footer-links li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 6px 0;
            border-bottom: 1px solid transparent;
        }

        .footer-links li a:hover {
            color: white;
            border-bottom-color: rgba(255, 255, 255, 0.3);
        }

        hr {
            width: 580px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-main {
                grid-template-columns: 1fr;
                gap: 30px;
                text-align: center;
            }

            .footer-right {
                align-items: center;
                text-align: center;
            }

            .footer-social {
                justify-content: center;
            }

            .auth-buttons {
                max-width: 100%;
                align-self: center;
            }

            .nav-menu {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-content">
            <ul class="nav-menu">
                <li><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                <li><a class="nav-link" href="{{ url('/allProduct') }}">Products</a></li>
                <li><a class="nav-link" href="{{ url('/about') }}">About</a></li>
                <li><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
            </ul>

            <div class="logo-container">
                <img src="{{ asset('storage/image/maneviz-white.png') }}" alt="MANEVIZ Logo" class="logo logo-white">
                <img src="{{ asset('storage/image/maneviz.png') }}" alt="MANEVIZ Logo" class="logo logo-black">
            </div>

            <div class="nav-right">
                <div class="search-container">
                    <input type="text" class="search-bar" placeholder="Search products...">
                    <span class="search-icon">⌕</span>
                </div>

                @auth
                <div class="nav-icons">
                    <a href="{{ url('/cart') }}" class="nav-icon cart-icon">
                        <i class="bi bi-cart3"></i>
                    </a>
                    <a href="{{ url('/wishlist') }}" class="nav-icon">
                        <i class="bi bi-heart"></i>
                    </a>
                    <div class="nav-icon user-dropdown" onclick="toggleUserDropdown()">
                        <i class="bi bi-person-circle"></i>
                        <div class="dropdown-menu" id="userDropdown">
                            <a href="{{ url('/profile') }}" class="dropdown-item">
                                <i class="bi bi-person me-2"></i>Profile
                            </a>
                            <a href="{{ url('/orders') }}" class="dropdown-item">
                                <i class="bi bi-bag me-2"></i>My Orders
                            </a>
                            <a href="{{ url('/settings') }}" class="dropdown-item">
                                <i class="bi bi-gear me-2"></i>Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item logout" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth
            </div>

        </div>
    </nav>

    <main id="konten">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-main">
                <!-- Left Section -->
                <div class="footer-left">
                    <div class="footer-logo">
                        <img src="{{ asset('storage/image/maneviz-white.png') }}" alt="MANEVIZ">
                    </div>

                    <div class="footer-social-section">
                        <h4>Find Us On</h4>
                        <div class="footer-social">
                            <a href="#" class="social-icon" title="WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="#" class="social-icon" title="Shopee">
                                <i class="bi bi-shop"></i>
                            </a>
                            <a href="#" class="social-icon" title="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" class="social-icon" title="Discord">
                                <i class="bi bi-discord"></i>
                            </a>
                            <a href="#" class="social-icon" title="TikTok">
                                <i class="bi bi-tiktok"></i>
                            </a>
                            <a href="#" class="social-icon" title="Twitter">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <a href="#" class="social-icon" title="YouTube">
                                <i class="bi bi-youtube"></i>
                            </a>
                        </div>
                    </div>

                    @guest
                    <div class="auth-buttons">
                        <a href="{{ route('signIn') }}" class="auth-btn sign-in">Sign In</a>
                        <a href="{{ route('signUp') }}" class="auth-btn sign-up">Sign Up</a>
                    </div>
                    @else
                    <div class="auth-buttons">
                        <div style="text-align: left; color: rgba(255, 255, 255, 0.8); font-size: 0.9rem;">
                            Selamat datang, <strong>{{ Auth::user()->name }}</strong>!
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="auth-btn sign-in">Logout</button>
                        </form>
                    </div>
                    @endguest
                </div>

                <!-- Right Section -->
                <div class="footer-right">
                    <ul class="footer-links">
                        <li><a href="{{ url('/refundPolicy') }}">Refund Policy</a></li>
                        <hr>
                        <li><a href="{{ url('/howToOrder') }}">How To Order</a></li>
                        <hr>
                        <li><a href="{{ url('/about') }}">About</a></li>
                        <hr>
                        <li><a href="{{ url('/paymentConfirmation') }}">Payment Confirmation</a></li>
                        <hr>
                        <li class="copy">Copyright © 2025 MANEVIZ</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // User dropdown toggle
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const userIcon = document.querySelector('.user-dropdown');

            if (dropdown && !userIcon.contains(event.target)) {
                dropdown.classList.remove('show');
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

        // Add smooth scrolling and interaction effects
        document.addEventListener('DOMContentLoaded', function() {
            // Animate footer elements on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -30px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe footer elements
            document.querySelectorAll('.footer-main > *').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'all 0.6s ease';
                observer.observe(el);
            });

            // Add click handlers for social icons
            document.querySelectorAll('.social-icon').forEach(icon => {
                icon.addEventListener('click', function(e) {
                    e.preventDefault();
                    const platform = this.getAttribute('title');
                    console.log(`${platform} social icon clicked`);
                    // Add your social media redirect logic here
                });
            });
        });
    </script>

</body>

</html>
