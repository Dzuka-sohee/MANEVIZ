<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
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
            width: 100%;
            padding: 12px 20px;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0));
            transition: all 0.3s ease;
            z-index: 1000;
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
            margin: 0;
            padding: 0;
        }

        .nav-menu a {
            color: black;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-menu .nav-link {
            text-decoration: none;
            font-weight: 500;
            color: white;
            transition: color 0.3s ease;
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

        .logo img {
            height: 93px;
            width: auto;
            transition: opacity 0.3s ease;
        }

        .logo-white {
            display: block;
        }

        .logo-black {
            display: none;
        }

        .navbar.scrolled .logo-white {
            display: none;
        }

        .navbar.scrolled .logo-black {
            display: block;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
            justify-content: flex-end;
            color: white;
            font-size: 20px;
            transition: color 0.3s ease;
            cursor: pointer;
        }

        .search-container {
            display: flex;
            align-items: center;
            background: transparent;
            border: 1px solid #999;
            border-radius: 20px;
            padding: 5px 10px;
            transition: background 0.3s ease;
            position: relative;
            box-shadow: none;
            color: black;
        }

        .search-container input {
            border: none;
            background: transparent;
            outline: none;
            color: black;
            padding: 5px;
            font-size: 14px;
            width: 150px;
            color: black;
        }

        .search-bar {
            padding: 8px 40px 8px 15px;
            border: 1px solid white;
            border-radius: 25px;
            background: transparent;
            color: white;
            font-size: 0.9rem;
            width: 200px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            /* Fix for mobile input issues */
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            outline: none;
            font-family: inherit;
        }

        .search-bar::placeholder {
            color: white;
        }

        .search-bar:focus {
            outline: none;
            border-color: #ffff;
            background: transparent;
            width: 220px;
        }

        .navbar.scrolled .search-bar {
            border-color: #999;
            background: rgba(255, 255, 255, 0.8);
            color: black;
        }

        .navbar.scrolled .search-bar::placeholder {
            color: #666;
        }

        .navbar.scrolled .search-bar:focus {
            border-color: #999;
            background: transparent !important;
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
            color: black;
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
            transition: all 0.3s ease;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border-radius: 50%;
        }

        .navbar.scrolled .nav-icon {
            color: black;
        }

        .nav-icon:hover {
            color: #ff6b6b;
            background: rgba(255, 107, 107, 0.1);
            transform: scale(1.1);
        }

        .cart-icon {
            position: relative;
        }

        /* Cart badge for item count */
        .cart-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: #ff6b6b;
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 50%;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Mobile Search Icon */
        .mobile-search-icon {
            display: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .navbar.scrolled .mobile-search-icon {
            color: black;
        }

        .mobile-search-icon:hover {
            color: #ff6b6b;
            background: rgba(255, 107, 107, 0.1);
        }

        /* Mobile Profile Icon */
        .mobile-profile-icon {
            display: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .navbar.scrolled .mobile-profile-icon {
            color: black;
        }

        .mobile-profile-icon:hover {
            color: #ff6b6b;
            background: rgba(255, 107, 107, 0.1);
        }

        /* Mobile Search Bar */
        .mobile-search-bar {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            padding: 15px 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid #eee;
            z-index: 999;
        }

        .mobile-search-bar.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        .mobile-search-bar .search-container {
            position: relative;
        }

        .mobile-search-bar .search-bar {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border: 2px solid #ddd;
            border-radius: 25px;
            background: white;
            color: #333;
            font-size: 1rem;
            /* Critical fixes for mobile input */
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            outline: none;
            font-family: inherit;
            /* Prevent zoom on focus in iOS Safari */
            font-size: 16px;
            /* Ensure proper touch handling */
            touch-action: manipulation;
            -webkit-user-select: text;
            -moz-user-select: text;
            -ms-user-select: text;
            user-select: text;
            /* Fix for Android Chrome input issues */
            -webkit-tap-highlight-color: transparent;
        }

        .mobile-search-bar .search-bar:focus {
            outline: none;
            border-color: #ff6b6b;
            width: 100%;
            /* Ensure focus state works on mobile */
            -webkit-appearance: none;
        }

        .mobile-search-bar .search-bar::placeholder {
            color: #999;
        }

        .mobile-search-bar .search-icon {
            color: #666;
            right: 15px;
            cursor: pointer;
            /* Ensure icon doesn't interfere with input */
            pointer-events: none;
        }

        .mobile-search-bar .close-search {
            position: absolute;
            right: 45px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 5px;
            transition: all 0.3s ease;
            /* Allow interaction with close button */
            pointer-events: auto;
        }

        .mobile-search-bar .close-search:hover {
            color: #ff6b6b;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile Search Overlay */
        .mobile-search-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            z-index: 2000;
            transform: translateY(-100%);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .mobile-search-overlay.open {
            transform: translateY(0);
        }

        .mobile-search-overlay-close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            padding: 10px;
            transition: all 0.3s ease;
        }

        .mobile-search-overlay-close:hover {
            color: #ff6b6b;
            transform: scale(1.1);
        }

        .mobile-search-overlay .search-container {
            padding: 0 2rem;
            width: 100%;
            max-width: 400px;
            position: relative;
        }

        .mobile-search-overlay .search-bar {
            width: 100%;
            padding: 15px 50px 15px 20px;
            font-size: 1.1rem;
            border-radius: 30px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            /* Mobile input fixes for overlay */
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            outline: none;
            font-family: inherit;
            font-size: 16px;
            touch-action: manipulation;
            -webkit-user-select: text;
            -moz-user-select: text;
            -ms-user-select: text;
            user-select: text;
            -webkit-tap-highlight-color: transparent;
        }

        .mobile-search-overlay .search-bar::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .mobile-search-overlay .search-icon {
            position: absolute;
            right: 2.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 1.2rem;
            pointer-events: none;
        }

        /* Mobile Menu Overlay */
        .mobile-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            z-index: 2000;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .mobile-menu.open {
            transform: translateX(0);
        }

        .mobile-menu-close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            padding: 10px;
            transition: all 0.3s ease;
        }

        .mobile-menu-close:hover {
            color: #ff6b6b;
            transform: scale(1.1);
        }

        .mobile-nav-menu {
            list-style: none;
            text-align: center;
            margin-bottom: 2rem;
        }

        .mobile-nav-menu li {
            margin: 1rem 0;
        }

        .mobile-nav-menu a {
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 10px 20px;
            border-radius: 10px;
            display: block;
        }

        .mobile-nav-menu a:hover {
            color: #ff6b6b;
            background: rgba(255, 107, 107, 0.1);
        }

        .mobile-search {
            margin: 2rem 0;
            padding: 0 2rem;
            width: 100%;
            max-width: 300px;
        }

        .mobile-search .search-bar {
            width: 100%;
            padding: 12px 15px;
            font-size: 1rem;
            border-radius: 25px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            /* Mobile input fixes for menu search */
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            outline: none;
            font-family: inherit;
            font-size: 16px;
            touch-action: manipulation;
            -webkit-user-select: text;
            -moz-user-select: text;
            -ms-user-select: text;
            user-select: text;
            -webkit-tap-highlight-color: transparent;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .navbar.scrolled .mobile-menu-toggle {
            color: #333;
        }

        .mobile-menu-toggle:hover {
            color: #ff6b6b;
            background: rgba(255, 107, 107, 0.1);
        }

        .mobile-nav-icons {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
        }

        .mobile-nav-icons .nav-icon {
            color: white;
            font-size: 1.5rem;
            padding: 15px;
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

        /* Responsive Design */

        /* Large tablets and small desktops */
        @media (max-width: 1024px) {
            .nav-content {
                padding: 0 15px;
            }

            .nav-menu {
                gap: 1.5rem;
            }

            .logo {
                height: 80px;
            }

            .search-bar {
                width: 180px;
            }

            .search-bar:focus {
                width: 200px;
            }
        }

        /* Tablets */
        @media (max-width: 768px) {
            .navbar {
                padding: 12px 0;
            }

            .nav-content {
                padding: 0 15px;
                justify-content: space-between;
            }

            .nav-menu {
                display: none;
            }

            .logo {
                position: static;
                transform: none;
                height: 70px;
                order: 2;
            }

            .mobile-menu-toggle {
                display: block;
                order: 1;
            }

            .mobile-search-icon {
                display: block;
                order: 3;
            }

            .mobile-profile-icon {
                display: block;
                order: 4;
            }

            .nav-right {
                order: 5;
                flex: 0;
                gap: 0.5rem;
            }

            .search-container {
                display: none;
            }

            .nav-icons {
                display: none;
            }
        }

        /* Mobile phones */
        @media (max-width: 480px) {
            .navbar {
                padding: 10px 0;
            }

            .nav-content {
                padding: 0 10px;
                gap: 8px;
            }

            .logo img {
                height: 70px;
                padding-left: 53px;
            }

            .mobile-menu-toggle {
                font-size: 1.3rem;
                order: 1;
                flex: 0;
            }

            .mobile-search-icon {
                font-size: 1.2rem;
                order: 3;
                flex: 0;
            }

            .mobile-profile-icon {
                font-size: 1.2rem;
                order: 4;
                flex: 0;
            }

            .nav-right {
                order: 5;
                flex: 0;
            }

            .nav-right .nav-icon {
                font-size: 1.2rem;
                padding: 8px;
            }

            .mobile-nav-menu a {
                font-size: 1.3rem;
            }

            .mobile-search {
                padding: 0 1rem;
                max-width: 280px;
            }

            .mobile-search-bar {
                padding: 10px 15px;
            }

            /* Additional mobile-specific input fixes */
            .mobile-search-bar .search-bar {
                /* Ensure minimum font size to prevent zoom on iOS */
                font-size: 16px !important;
                /* Better touch handling on small screens */
                min-height: 44px;
                /* Ensure proper focus behavior */
                -webkit-touch-callout: none;
                -webkit-user-select: text;
                -khtml-user-select: text;
                -moz-user-select: text;
                -ms-user-select: text;
                user-select: text;
            }
        }

        /* Extra small phones */
        @media (max-width: 360px) {
            .nav-content {
                padding: 0 8px;
                gap: 6px;
            }

            .nav-menu {
                display: none;
                /* hide menu di mobile */
            }

            .logo img {
                height: 28px;
            }

            .mobile-menu-toggle,
            .mobile-search-icon,
            .mobile-profile-icon {
                padding: 6px;
                font-size: 1.1rem;
                display: inline-block;
            }

            .mobile-search-bar {
                padding: 8px 12px;
            }

            .search-container {
                display: none;
                /* hide search desktop di mobile */
            }

            /* Extra fixes for very small screens */
            .mobile-search-bar .search-bar {
                font-size: 16px !important;
                min-height: 44px;
                padding: 14px 45px 14px 15px;
            }

            .mobile-search {
                max-width: 250px;
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

        .footer-divider {
            width: 100%;
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
            margin: 0;
            border: none;
        }

        /* Tablet Responsive */
        @media (max-width: 1024px) {
            .footer-content {
                padding: 20px 15px;
            }

            .footer-main {
                gap: 30px;
            }
        }

        /* Mobile Portrait */
        @media (max-width: 768px) {

            /* Footer Mobile */
            .footer-main {
                grid-template-columns: 1fr;
                gap: 30px;
                text-align: center;
            }

            .footer-left {
                align-items: center;
            }

            .footer-logo {
                justify-content: center;
                margin-left: 0;
            }

            .footer-logo img {
                height: 60px;
            }

            .footer-social {
                justify-content: center;
            }

            .auth-buttons {
                max-width: 100%;
                align-self: center;
                width: 100%;
                max-width: 250px;
            }

            .footer-right {
                align-items: center;
                text-align: center;
            }

            .footer-links {
                gap: 15px;
                width: 100%;
            }

            .footer-links li a,
            .copy {
                font-size: 0.9rem;
            }

            .footer-divider {
                width: 100%;
            }
        }

        /* Small Mobile */
        @media (max-width: 480px) {
            .footer-content {
                padding: 20px 10px;
            }

            .footer-logo img {
                height: 50px;
            }

            .footer-social {
                gap: 8px;
            }

            .social-icon {
                width: 32px;
                height: 32px;
                font-size: 0.9rem;
            }

            .auth-btn {
                padding: 8px 16px;
                font-size: 0.8rem;
            }

            .footer-links {
                gap: 12px;
            }

            .footer-links li a,
            .copy {
                font-size: 0.85rem;
            }
        }

        /* Extra Small Mobile */
        @media (max-width: 360px) {
            .footer-content {
                padding: 15px 8px;
            }

            .footer-main {
                gap: 25px;
            }

            .footer-social {
                gap: 6px;
            }

            .social-icon {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>

    <!-- Mobile Search Overlay -->
    <div class="mobile-search-overlay" id="mobileSearchOverlay">
        <div class="mobile-search-overlay-close" onclick="toggleMobileSearch()">
            <i class="bi bi-x"></i>
        </div>

        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Search products...">
            <span class="search-icon">⌕</span>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-close" onclick="toggleMobileMenu()">
            <i class="bi bi-x"></i>
        </div>

        <ul class="mobile-nav-menu">
            <li><a href="/" onclick="toggleMobileMenu()">Home</a></li>
            <li><a href="/allProduct" onclick="toggleMobileMenu()">Products</a></li>
            <li><a href="/about" onclick="toggleMobileMenu()">About</a></li>
            <li><a href="/contact" onclick="toggleMobileMenu()">Contact</a></li>
        </ul>

        @auth
        <div class="mobile-nav-icons">
            <a href="/orders" class="nav-icon">
                <i class="bi bi-bag-check"></i>
            </a>
            <a href="/cart" class="nav-icon cart-icon">
                <i class="bi bi-cart3"></i>
            </a>
            <a href="/wishlist" class="nav-icon">
                <i class="bi bi-heart"></i>
            </a>

            <a href="/order-history" class="nav-icon">
                <i class="bi bi-clock-history"></i>
            </a>
        </div>
        @endauth
    </div>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-content">
            <div class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <i class="bi bi-list"></i>
            </div>

            <ul class="nav-menu">
                <li><a class="nav-link" href="/">Home</a></li>
                <li><a class="nav-link" href="/allProduct">Products</a></li>
                <li><a class="nav-link" href="/about">About</a></li>
                <li><a class="nav-link" href="/contact">Contact</a></li>
            </ul>

            <div class="logo">
                <!-- Logo putih -->
                <img src="image/maneviz-white.png" alt="MANEVIZ Logo White" class="logo-white">
                <!-- Logo hitam -->
                <img src="image/maneviz.png" alt="MANEVIZ Logo Black" class="logo-black">
            </div>


            <div class="mobile-search-icon" onclick="toggleMobileSearchBar()">
                <i class="bi bi-search"></i>
            </div>

            <a href="{{ url('/profil') }}" class="mobile-profile-icon">
                <i class="bi bi-person-circle"></i>
            </a>

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
                            <a href="{{ url('/profil') }}" class="dropdown-item">
                                <i class="bi bi-person me-2"></i> Profile
                            </a>
                            <a href="{{ url('/orders') }}" class="dropdown-item">
                                <i class="bi bi-bag-check"></i> Pesanan
                            </a>
                            <a href="{{ url('/order-history.index') }}" class="dropdown-item">
                                <i class="bi bi-clock-history"></i> Riwayat Pesanan
                            </a>
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item logout" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </div>

        <!-- Mobile Search Bar (appears below navbar on mobile) -->
        <div class="mobile-search-bar" id="mobileSearchBar">
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Search products..." id="mobileSearchInput">
                <span class="search-icon">⌕</span>
                <div class="close-search" onclick="closeMobileSearchBar()">
                    <i class="bi bi-x"></i>
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
                        <img src="{{ asset('image/maneviz-white.png') }}" alt="MANEVIZ">
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
                        <hr class="footer-divider">
                        <li><a href="{{ url('/howToOrder') }}">How To Order</a></li>
                        <hr class="footer-divider">
                        <li><a href="{{ url('/about') }}">About</a></li>
                        <hr class="footer-divider">
                        <li><a href="{{ url('/paymentConfirmation') }}">Payment Confirmation</a></li>
                        <hr class="footer-divider">
                        <li class="copy">Copyright © 2025 MANEVIZ</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>


    <script>
        // Mobile search bar toggle (for mobile phones)
        function toggleMobileSearchBar() {
            const mobileSearchBar = document.getElementById('mobileSearchBar');
            const mobileSearchInput = document.getElementById('mobileSearchInput');

            if (mobileSearchBar.classList.contains('show')) {
                mobileSearchBar.classList.remove('show');
            } else {
                mobileSearchBar.classList.add('show');
                // Focus on search input after animation with delay for better mobile experience
                setTimeout(() => {
                    mobileSearchInput.focus();
                    // Additional mobile-specific focus handling
                    mobileSearchInput.click();
                }, 350);
            }
        }

        // Close mobile search bar
        function closeMobileSearchBar() {
            const mobileSearchBar = document.getElementById('mobileSearchBar');
            mobileSearchBar.classList.remove('show');
        }

        // Mobile search overlay toggle (legacy function - kept for compatibility)
        function toggleMobileSearch() {
            const mobileSearchOverlay = document.getElementById('mobileSearchOverlay');
            mobileSearchOverlay.classList.toggle('open');

            // Prevent body scroll when search overlay is open
            if (mobileSearchOverlay.classList.contains('open')) {
                document.body.style.overflow = 'hidden';
                // Focus on search input with better mobile handling
                setTimeout(() => {
                    const searchInput = mobileSearchOverlay.querySelector('.search-bar');
                    if (searchInput) {
                        searchInput.focus();
                        searchInput.click();
                    }
                }, 350);
            } else {
                document.body.style.overflow = '';
            }
        }

        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('open');

            // Prevent body scroll when menu is open
            if (mobileMenu.classList.contains('open')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        // User dropdown toggle
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const userDropdown = document.querySelector('.user-dropdown');

            if (userDropdown && !userDropdown.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });

        // Enhanced mobile search handling
        document.addEventListener('click', function(event) {
            const mobileSearchBar = document.getElementById('mobileSearchBar');
            const mobileSearchIcon = document.querySelector('.mobile-search-icon');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const mobileSearchOverlay = document.getElementById('mobileSearchOverlay');

            // Close mobile search bar - but not when clicking inside it
            if (mobileSearchBar && !mobileSearchBar.contains(event.target) &&
                mobileSearchIcon && !mobileSearchIcon.contains(event.target)) {
                mobileSearchBar.classList.remove('show');
            }

            // Close mobile menu
            if (mobileMenu && !mobileMenu.contains(event.target) &&
                mobileMenuToggle && !mobileMenuToggle.contains(event.target)) {
                mobileMenu.classList.remove('open');
                document.body.style.overflow = '';
            }

            // Close mobile search overlay
            if (mobileSearchOverlay && !mobileSearchOverlay.contains(event.target)) {
                mobileSearchOverlay.classList.remove('open');
                document.body.style.overflow = '';
            }
        });

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

        // Dynamic cart count update function
        function updateCartCount(count) {
            const cartBadge = document.getElementById('cartCount');
            if (cartBadge) {
                cartBadge.textContent = count;
                if (count === 0) {
                    cartBadge.style.display = 'none';
                } else {
                    cartBadge.style.display = 'flex';
                }
            }
        }

        // Profile icon link update based on authentication
        function updateProfileLink(isAuthenticated, profileUrl = '/profil', loginUrl = '/signin') {
            const profileIcon = document.getElementById('profileIcon');
            const mobileProfileIcon = document.querySelector('.mobile-profile-icon');

            if (profileIcon) {
                profileIcon.href = isAuthenticated ? profileUrl : loginUrl;
                profileIcon.title = isAuthenticated ? 'Profile' : 'Sign In';
            }

            if (mobileProfileIcon) {
                mobileProfileIcon.href = isAuthenticated ? profileUrl : loginUrl;
                mobileProfileIcon.title = isAuthenticated ? 'Profile' : 'Sign In';
            }
        }

        // Enhanced search functionality with better mobile support
        document.querySelectorAll('.search-bar').forEach(searchBar => {
            // Handle Enter key press
            searchBar.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const searchTerm = this.value.trim();
                    if (searchTerm) {
                        // Close mobile search bar if it's open
                        const mobileSearchBar = document.getElementById('mobileSearchBar');
                        if (mobileSearchBar && mobileSearchBar.classList.contains('show')) {
                            mobileSearchBar.classList.remove('show');
                        }

                        // Close mobile search overlay if it's open
                        const mobileSearchOverlay = document.getElementById('mobileSearchOverlay');
                        if (mobileSearchOverlay && mobileSearchOverlay.classList.contains('open')) {
                            mobileSearchOverlay.classList.remove('open');
                            document.body.style.overflow = '';
                        }

                        // Redirect to search results page
                        window.location.href = `/search?q=${encodeURIComponent(searchTerm)}`;
                    }
                }
            });

            // Better mobile focus handling
            searchBar.addEventListener('focus', function() {
                // Prevent zoom on iOS by ensuring font-size is at least 16px
                if (window.innerWidth <= 768) {
                    this.style.fontSize = '16px';
                }
            });

            // Handle touch events for better mobile experience
            searchBar.addEventListener('touchstart', function(e) {
                // Ensure the input is focusable on touch devices
                this.focus();
            });

            // Input event for real-time search suggestions (optional)
            searchBar.addEventListener('input', function() {
                const searchTerm = this.value.trim();
                // You can add real-time search suggestions here
                console.log('Search term:', searchTerm);
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileSearchOverlay = document.getElementById('mobileSearchOverlay');
            const mobileSearchBar = document.getElementById('mobileSearchBar');
            const dropdown = document.getElementById('userDropdown');

            // Close mobile elements on resize
            if (window.innerWidth > 768) {
                if (mobileMenu) mobileMenu.classList.remove('open');
                if (mobileSearchOverlay) mobileSearchOverlay.classList.remove('open');
                if (mobileSearchBar) mobileSearchBar.classList.remove('show');
                document.body.style.overflow = '';
            }

            if (dropdown) dropdown.classList.remove('show');
        });

        // Handle escape key press
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Close mobile search bar
                const mobileSearchBar = document.getElementById('mobileSearchBar');
                if (mobileSearchBar) mobileSearchBar.classList.remove('show');

                // Close mobile menu
                const mobileMenu = document.getElementById('mobileMenu');
                if (mobileMenu) mobileMenu.classList.remove('open');

                // Close mobile search overlay
                const mobileSearchOverlay = document.getElementById('mobileSearchOverlay');
                if (mobileSearchOverlay) mobileSearchOverlay.classList.remove('open');

                // Close dropdown
                const dropdown = document.getElementById('userDropdown');
                if (dropdown) dropdown.classList.remove('show');

                document.body.style.overflow = '';
            }
        });

        // Add smooth scrolling and interaction effects
        document.addEventListener('DOMContentLoaded', function() {
            // Additional mobile-specific initialization
            if (window.innerWidth <= 768) {
                // Ensure all search inputs have proper mobile settings
                document.querySelectorAll('.search-bar').forEach(input => {
                    input.setAttribute('autocomplete', 'off');
                    input.setAttribute('autocorrect', 'off');
                    input.setAttribute('autocapitalize', 'off');
                    input.setAttribute('spellcheck', 'false');
                });
            }
        });

        // Logout function
        function logout() {
            // Add your logout logic here
            console.log('Logout clicked');
        }

        // Additional mobile keyboard handling
        document.addEventListener('focusin', function(e) {
            if (e.target.classList.contains('search-bar') && window.innerWidth <= 768) {
                // Small delay to ensure the keyboard is fully shown
                setTimeout(() => {
                    e.target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 300);
            }
        });

        // Handle virtual keyboard on mobile
        window.addEventListener('resize', function() {
            // Detect if virtual keyboard is open (viewport height change on mobile)
            if (window.innerWidth <= 768) {
                const activeElement = document.activeElement;
                if (activeElement && activeElement.classList.contains('search-bar')) {
                    // Adjust layout when virtual keyboard appears
                    setTimeout(() => {
                        activeElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }, 100);
                }
            }
        });

        // Animate footer elements on scroll
        document.addEventListener('DOMContentLoaded', function() {
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

                    // Example redirect logic (uncomment and modify as needed):
                    // const socialUrls = {
                    //     'WhatsApp': 'https://wa.me/your-number',
                    //     'Instagram': 'https://instagram.com/your-account',
                    //     'YouTube': 'https://youtube.com/your-channel',
                    //     // Add other social media URLs
                    // };
                    // if (socialUrls[platform]) {
                    //     window.open(socialUrls[platform], '_blank');
                    // }
                });
            });
        });

        // Demo function to toggle between guest and logged in state
        function toggleAuthState() {
            const guestButtons = document.getElementById('guestButtons');
            const loggedInButtons = document.getElementById('loggedInButtons');
            const userName = document.getElementById('userName');

            if (guestButtons.style.display !== 'none') {
                // Switch to logged in state
                guestButtons.style.display = 'none';
                loggedInButtons.style.display = 'flex';
                userName.textContent = 'John Doe'; // Replace with actual user name
            } else {
                // Switch to guest state
                guestButtons.style.display = 'flex';
                loggedInButtons.style.display = 'none';
            }
        }
    </script>

</body>

</html>

{{-- zjkfbkz --}}