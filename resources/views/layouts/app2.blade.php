<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css">
    <title>MANEVIZ</title>
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
            color: black;
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

        .logo {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            height: 93px;
            width: auto;
            object-fit: contain;
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
            background: black;
            color: white;
            font-size: 0.9rem;
            width: 200px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .search-bar::placeholder {
            color: white;
        }

        .search-bar:focus {
            outline: none;
            border-color: #ffff;
            background: black;
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
            color: black; /* Changed from white to black */
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.3s ease;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
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

        /* Footer Styles */
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
            /* Reduced from 40px */
            position: relative;
        }

        .footer-main {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            /* Reduced from 60px */
            align-items: start;
        }

        /* Left Section - Brand and Social */
        .footer-left {
            display: flex;
            flex-direction: column;
            gap: 20px;
            /* Reduced from 30px */
        }

        .footer-logo {
            display: flex;
            align-items: center;
            margin-left: -8px;
            gap: 10px;
            margin-bottom: 1px;
            /* Reduced from 20px */
        }


        .footer-logo h2 {
            font-size: 1.6rem;
            /* Reduced from 1.8rem */
            font-weight: 700;
            color: white;
            letter-spacing: 2px;
        }

        .footer-social-section h4 {
            font-size: 0.85rem;
            /* Reduced from 0.9rem */
            font-weight: 600;
            margin-bottom: 12px;
            /* Reduced from 15px */
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-social {
            display: flex;
            gap: 10px;
            /* Reduced from 12px */
            flex-wrap: wrap;
        }

        .social-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            /* Reduced from 40px */
            height: 36px;
            /* Reduced from 40px */
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            /* Reduced from 1.1rem */
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
            /* Reduced from 10px */
            max-width: 200px;
        }

        .auth-btn {
            padding: 10px 20px;
            /* Reduced from 12px 24px */
            border: 2px solid white;
            border-radius: 25px;
            background: transparent;
            color: white;
            font-size: 0.85rem;
            /* Reduced from 0.9rem */
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

        /* Right Section - Links */
        .footer-right {
            display: flex;
            flex-direction: column;
            gap: 15px;
            /* Reduced from 20px */
            align-items: flex-end;
            text-align: right;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 20px;
            /* Reduced from 30px */
        }

        .footer-links li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.95rem;
            /* Reduced from 1rem */
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 6px 0;
            /* Reduced from 8px */
            border-bottom: 1px solid transparent;
        }

        .copy{
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.95rem;
            /* Reduced from 1rem */
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 6px 0;
            /* Reduced from 8px */
            border-bottom: 1px solid transparent;
        }

        .footer-links li a:hover {
            color: white;
            border-bottom-color: rgba(255, 255, 255, 0.3);
        }

        /* Footer Bottom */
        .footer-bottom {
            margin-top: 25px;
            /* Reduced from 40px */
            padding-top: 15px;
            /* Reduced from 20px */
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: right;
        }

        .footer-copyright {
            font-size: 0.8rem;
            /* Reduced from 0.85rem */
            color: rgba(255, 255, 255, 0.6);
            font-weight: 400;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-main {
                grid-template-columns: 1fr;
                gap: 30px;
                /* Reduced from 40px */
                text-align: center;
            }

            .footer-right {
                align-items: center;
                text-align: center;
            }

            .footer-bottom {
                text-align: center;
            }

            .footer-social {
                justify-content: center;
            }

            .auth-buttons {
                max-width: 100%;
                align-self: center;
            }
        }

        @media (max-width: 480px) {
            .footer-content {
                padding: 20px 15px;
                /* Reduced from 30px */
            }

            .footer-logo h2 {
                font-size: 1.4rem;
                /* Reduced from 1.5rem */
            }

            .social-icon {
                width: 32px;
                /* Reduced from 35px */
                height: 32px;
                /* Reduced from 35px */
                font-size: 0.9rem;
                /* Reduced from 1rem */
            }

            .auth-btn {
                padding: 8px 18px;
                /* Reduced from 10px 20px */
                font-size: 0.8rem;
                /* Reduced from 0.85rem */
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer-main>* {
            animation: fadeInUp 0.6s ease forwards;
        }

        .footer-left {
            animation-delay: 0.1s;
        }

        .footer-right {
            animation-delay: 0.2s;
        }

        hr {
            width: 580px;
        }

        .footer-logo img {
            height: 80px;
            width: auto;
        }

        /* Demo content for testing scroll effect */
        .demo-content {
            height: 200vh;
            padding: 150px 20px 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .demo-text {
            font-size: 2rem;
            font-weight: 300;
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

            <img src="storage/image/maneviz.png" alt="MANEVIZ Logo" class="logo">

            <div class="nav-right">
                <div class="search-container">
                    <input type="text" class="search-bar" placeholder="Search products...">
                    <span class="search-icon">⌕</span>
                </div>

                <div class="nav-icons">
                    <span class="nav-icon cart-icon" onclick="toggleCart()">
                        <i class="bi bi-cart3"></i>
                    </span>
                    <span class="nav-icon">
                        <i class="bi bi-heart"></i>
                    </span>
                    <span class="nav-icon">
                        <i class="bi bi-person-circle"></i>
                    </span>
                </div>
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
                        <img src="storage/image/maneviz-white.png" alt="MANEVIZ Logo">
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

        // Cart toggle function
        function toggleCart() {
            console.log('Cart clicked');
            // Add your cart functionality here
        }

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

            // Add click handlers for auth buttons
            document.querySelectorAll('.auth-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const action = this.classList.contains('sign-in') ? 'Sign In' : 'Sign Up';
                    console.log(`${action} clicked`);
                    // Add your authentication logic here
                });
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
