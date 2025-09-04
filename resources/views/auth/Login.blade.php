<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - MANEVIZ</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 15px;
        }

        .login-container {
            display: flex;
            max-width: 1200px;
            width: 100%;
            min-height: 500px;
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        /* Left Side - Image */
        .image-section {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 24px 0 0 24px;
            min-height: 500px;
        }

        .image-container {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .image-placeholder {
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 600"><rect width="400" height="600" fill="%23667eea"/><text x="200" y="280" text-anchor="middle" fill="%23fff" font-size="24" font-family="Arial" font-weight="bold">MANEVIZ</text><text x="200" y="320" text-anchor="middle" fill="%23fff" font-size="16" font-family="Arial">Management Visualization</text></svg>') center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Right Side - Form */
        .form-section {
            flex: 1;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            border-radius: 0 24px 24px 0;
            min-height: 500px;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            font-size: 28px;
            font-weight: 800;
            color: #000;
            letter-spacing: -1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        .welcome-title {
            font-size: 28px;
            font-weight: 700;
            color: #000;
            margin-bottom: 8px;
            text-align: left;
        }

        .welcome-subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.2s ease;
            background-color: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: #000;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .btn-signin {
            width: 100%;
            background-color: #000;
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            margin-top: 8px;
            margin-bottom: 16px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-signin:hover {
            background-color: #1f2937;
            transform: translateY(-1px);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 16px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider-text {
            padding: 0 16px;
            color: #9ca3af;
            font-size: 14px;
            font-weight: 500;
        }

        .btn-google {
            width: 100%;
            height: 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            transition: all 0.2s ease;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            gap: 12px;
            cursor: pointer;
        }

        .btn-google:hover {
            border-color: #d1d5db;
            background-color: #f9fafb;
            color: #374151;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .signup-link {
            color: #6b7280;
            font-size: 14px;
            text-align: center;
            margin-top: 8px;
        }

        .signup-link a {
            color: #ef4444;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .alert {
            margin-bottom: 24px;
            border-radius: 12px;
            border: none;
            padding: 16px;
        }

        .alert-success {
            background-color: #f0fdf4;
            color: #166534;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #dc2626;
        }

        .invalid-feedback {
            font-size: 12px;
            margin-top: 6px;
            color: #ef4444;
            display: block;
        }

        /* RESPONSIVE BREAKPOINTS */

        /* Extra Large Screens - 1400px and up */
        @media (min-width: 1400px) {
            .login-container {
                max-width: 1300px;
            }
            
            .form-section {
                padding: 60px;
            }

            .welcome-title {
                font-size: 32px;
            }

            .logo {
                font-size: 32px;
            }

            .logo-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }
        }

        /* Large Screens - 1200px to 1399px */
        @media (min-width: 1200px) and (max-width: 1399px) {
            .login-container {
                max-width: 1200px;
            }
            
            .form-section {
                padding: 50px;
            }

            .welcome-title {
                font-size: 30px;
            }

            .logo {
                font-size: 30px;
            }
        }

        /* Desktop - 992px to 1199px */
        @media (min-width: 992px) and (max-width: 1199px) {
            .login-container {
                max-width: 1000px;
            }

            .form-section {
                padding: 40px;
            }

            .welcome-title {
                font-size: 28px;
            }

            .logo {
                font-size: 28px;
            }
        }

        /* Tablet Landscape - 768px to 991px */
        @media (min-width: 768px) and (max-width: 991px) {
            body {
                padding: 20px;
            }

            .login-container {
                max-width: 800px;
                min-height: 450px;
            }

            .image-section,
            .form-section {
                min-height: 450px;
            }

            .image-section {
                flex: 0.8;
            }

            .form-section {
                flex: 1;
                padding: 35px 30px;
            }

            .welcome-title {
                font-size: 26px;
            }

            .logo {
                font-size: 26px;
            }

            .logo-icon {
                width: 34px;
                height: 34px;
                font-size: 17px;
            }

            .form-control {
                padding: 12px 15px;
            }
        }

        /* Tablet Portrait - 576px to 767px */
        @media (min-width: 576px) and (max-width: 767px) {
            body {
                padding: 20px;
                align-items: flex-start;
                padding-top: 40px;
            }

            .login-container {
                flex-direction: column;
                max-width: 520px;
                min-height: auto;
            }

            .image-section {
                display: none;
            }

            .form-section {
                padding: 40px 35px;
                border-radius: 24px;
                min-height: auto;
            }

            .welcome-title {
                font-size: 26px;
                text-align: center;
            }

            .welcome-subtitle {
                text-align: center;
                margin-bottom: 24px;
            }

            .form-group {
                margin-bottom: 18px;
            }

            .logo {
                font-size: 26px;
            }

            .logo-icon {
                width: 34px;
                height: 34px;
                font-size: 17px;
            }
        }

        /* Mobile Large - 480px to 575px */
        @media (min-width: 480px) and (max-width: 575px) {
            body {
                padding: 15px;
                align-items: flex-start;
                padding-top: 30px;
            }

            .login-container {
                flex-direction: column;
                max-width: 480px;
                border-radius: 20px;
                min-height: auto;
            }

            .image-section {
                display: none;
            }

            .form-section {
                padding: 35px 30px;
                border-radius: 20px;
                min-height: auto;
            }

            .welcome-title {
                font-size: 24px;
                text-align: center;
            }

            .welcome-subtitle {
                text-align: center;
                margin-bottom: 22px;
            }

            .logo {
                font-size: 24px;
            }

            .logo-icon {
                width: 32px;
                height: 32px;
                font-size: 16px;
            }

            .form-control {
                padding: 12px 14px;
                font-size: 16px;
            }

            .btn-signin {
                padding: 13px;
                font-size: 15px;
            }

            .btn-google {
                height: 46px;
                font-size: 14px;
            }

            .form-group {
                margin-bottom: 16px;
            }
        }

        /* Mobile Medium - 360px to 479px */
        @media (min-width: 360px) and (max-width: 479px) {
            body {
                padding: 15px 10px;
                align-items: flex-start;
                padding-top: 25px;
            }

            .login-container {
                flex-direction: column;
                border-radius: 18px;
                min-height: auto;
                width: 100%;
                max-width: 100%;
            }

            .image-section {
                display: none;
            }

            .form-section {
                padding: 30px 25px;
                border-radius: 18px;
                min-height: auto;
            }

            .form-container {
                max-width: 100%;
            }

            .welcome-title {
                font-size: 22px;
                text-align: center;
                margin-bottom: 6px;
            }

            .welcome-subtitle {
                text-align: center;
                margin-bottom: 20px;
                font-size: 13px;
            }

            .logo {
                font-size: 22px;
            }

            .logo-icon {
                width: 30px;
                height: 30px;
                font-size: 15px;
            }

            .logo-container {
                margin-bottom: 18px;
            }

            .form-group {
                margin-bottom: 14px;
            }

            .form-label {
                font-size: 13px;
                margin-bottom: 6px;
            }

            .form-control {
                padding: 11px 12px;
                font-size: 16px; /* Keep 16px to prevent zoom on iOS */
                border-radius: 10px;
            }

            .btn-signin {
                padding: 12px;
                font-size: 15px;
                border-radius: 10px;
                margin-top: 6px;
                margin-bottom: 14px;
            }

            .divider {
                margin: 14px 0;
            }

            .divider-text {
                font-size: 13px;
                padding: 0 12px;
            }

            .btn-google {
                height: 44px;
                font-size: 13px;
                border-radius: 10px;
                gap: 10px;
                margin-bottom: 14px;
            }

            .signup-link {
                font-size: 13px;
                margin-top: 6px;
            }

            .alert {
                padding: 14px;
                margin-bottom: 20px;
                border-radius: 10px;
                font-size: 13px;
            }

            .invalid-feedback {
                font-size: 11px;
                margin-top: 4px;
            }
        }

        /* Mobile Small - up to 359px */
        @media (max-width: 359px) {
            body {
                padding: 10px 8px;
                align-items: flex-start;
                padding-top: 20px;
            }

            .login-container {
                flex-direction: column;
                border-radius: 16px;
                min-height: auto;
                width: 100%;
                max-width: 100%;
            }

            .image-section {
                display: none;
            }

            .form-section {
                padding: 25px 18px;
                border-radius: 16px;
                min-height: auto;
            }

            .form-container {
                max-width: 100%;
            }

            .welcome-title {
                font-size: 20px;
                text-align: center;
                margin-bottom: 5px;
            }

            .welcome-subtitle {
                text-align: center;
                margin-bottom: 18px;
                font-size: 12px;
            }

            .logo {
                font-size: 20px;
            }

            .logo-icon {
                width: 28px;
                height: 28px;
                font-size: 14px;
            }

            .logo-container {
                margin-bottom: 16px;
            }

            .form-group {
                margin-bottom: 12px;
            }

            .form-label {
                font-size: 12px;
                margin-bottom: 5px;
            }

            .form-control {
                padding: 10px 11px;
                font-size: 16px; /* Keep 16px to prevent zoom on iOS */
                border-radius: 8px;
            }

            .btn-signin {
                padding: 11px;
                font-size: 14px;
                border-radius: 8px;
                margin-top: 5px;
                margin-bottom: 12px;
            }

            .divider {
                margin: 12px 0;
            }

            .divider-text {
                font-size: 12px;
                padding: 0 10px;
            }

            .btn-google {
                height: 42px;
                font-size: 12px;
                border-radius: 8px;
                gap: 8px;
                margin-bottom: 12px;
            }

            .signup-link {
                font-size: 12px;
                margin-top: 5px;
            }

            .alert {
                padding: 12px;
                margin-bottom: 18px;
                border-radius: 8px;
                font-size: 12px;
            }

            .invalid-feedback {
                font-size: 10px;
                margin-top: 3px;
            }
        }

        /* Very Short Screens */
        @media (max-height: 600px) {
            body {
                align-items: flex-start;
                padding-top: 15px;
                padding-bottom: 15px;
            }

            .login-container {
                min-height: auto;
            }

            .image-section,
            .form-section {
                min-height: auto;
            }

            .form-section {
                padding: 25px 30px;
            }

            .logo-container {
                margin-bottom: 15px;
            }

            .welcome-title {
                margin-bottom: 5px;
            }

            .welcome-subtitle {
                margin-bottom: 15px;
            }

            .form-group {
                margin-bottom: 12px;
            }
        }

        /* Landscape orientation on mobile devices */
        @media (max-height: 500px) and (orientation: landscape) and (max-width: 900px) {
            body {
                padding: 10px;
            }

            .login-container {
                flex-direction: row;
                max-width: 750px;
                min-height: auto;
                max-height: 90vh;
            }

            .image-section {
                display: flex;
                flex: 0.6;
                min-height: 320px;
                max-height: 400px;
            }

            .form-section {
                flex: 1;
                padding: 20px 25px;
                min-height: 320px;
                max-height: 400px;
                overflow-y: auto;
            }

            .logo-container {
                margin-bottom: 10px;
            }

            .welcome-title {
                font-size: 18px;
                margin-bottom: 4px;
            }

            .welcome-subtitle {
                margin-bottom: 12px;
                font-size: 12px;
            }

            .form-group {
                margin-bottom: 8px;
            }

            .form-control {
                padding: 8px 12px;
                font-size: 14px;
            }

            .btn-signin {
                padding: 10px;
                font-size: 14px;
                margin-top: 4px;
                margin-bottom: 8px;
            }

            .divider {
                margin: 8px 0;
            }

            .btn-google {
                height: 36px;
                font-size: 12px;
                margin-bottom: 8px;
            }

            .signup-link {
                font-size: 12px;
            }

            .logo {
                font-size: 18px;
            }

            .logo-icon {
                width: 26px;
                height: 26px;
                font-size: 13px;
            }
        }

        /* Ultra-wide screens */
        @media (min-width: 1600px) {
            body {
                padding: 30px 20px;
            }

            .login-container {
                max-width: 1400px;
            }

            .form-section {
                padding: 70px;
            }

            .welcome-title {
                font-size: 34px;
            }

            .logo {
                font-size: 34px;
            }

            .logo-icon {
                width: 42px;
                height: 42px;
                font-size: 22px;
            }
        }

        /* Accessibility improvements */
        @media (prefers-reduced-motion: reduce) {
            .form-control,
            .btn-signin,
            .btn-google {
                transition: none;
            }

            .btn-signin:hover,
            .btn-google:hover {
                transform: none;
            }
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .form-control {
                border-width: 3px;
            }

            .btn-signin {
                border: 2px solid transparent;
            }

            .btn-google {
                border-width: 3px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Side - Image Section -->
        <div class="image-section">
            <div class="image-container">
                <!-- Ganti dengan foto Anda -->
                <div class="image-placeholder">
                    <!-- Uncomment jika ada gambar -->
                    <img src="{{ asset('image/login-banner.jpg') }}" alt="MANEVIZ" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>

        <!-- Right Side - Form Section -->
        <div class="form-section">
            <div class="form-container">
                <!-- Logo -->
                <div class="logo-container">
                    <div class="logo">
                        <div class="logo-icon">🦁</div>
                        MANEVIZ
                    </div>
                </div>

                <!-- Welcome Text -->
                <h1 class="welcome-title">Welcome Back!</h1>
                <p class="welcome-subtitle">Enter your data</p>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Error Messages -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0 list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('signIn') }}">
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Enter your email address"
                               required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               placeholder="Enter your password"
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember" style="font-size: 14px; color: #666;">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-signin">
                        Sign In
                    </button>
                </form>

                <!-- Divider -->
                <div class="divider">
                    <span class="divider-text">atau login dengan</span>
                </div>

                <!-- Google Login -->
                <a href="{{ route('login.google') }}" class="btn-google">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="20" height="20">
                    Google
                </a>

                <!-- Sign Up Link -->
                <p class="signup-link">
                    Don't have an account? <a href="{{ route('signUp') }}">Sign Up</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>