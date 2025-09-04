<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - MANEVIZ</title>

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
            padding: 20px;
        }

        .register-container {
            display: flex;
            max-width: 1200px;
            width: 100%;
            min-height: 600px;
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        /* Left Side - Form */
        .form-section {
            flex: 1;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            border-radius: 24px 0 0 24px;
            min-height: 600px;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
        }

        /* Logo Container */
        .logo-container {
            text-align: center;
            padding: 10px 0 20px 0;
        }

        .logo-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 8px 16px;
            min-height: 60px;
            min-width: 200px;
            transition: all 0.3s ease;
        }

        .logo-placeholder {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #6b7280;
            font-size: 14px;
        }

        .logo-image {
            max-height: 120px;
            max-width: 220px;
            height: auto;
            width: auto;
            object-fit: contain;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 800;
            color: #000;
            letter-spacing: -0.5px;
        }

        .logo-with-image {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-image-only {
            display: block;
        }

        .logo-text-only {
            font-size: 28px;
            font-weight: 800;
            color: #000;
            letter-spacing: -1px;
        }

        .welcome-title {
            font-size: 32px;
            font-weight: 700;
            color: #000;
            margin-bottom: 8px;
            text-align: left;
        }

        .welcome-subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 25px;
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
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.2s ease;
            background-color: #fff;
            line-height: 1.4;
        }

        .form-control:focus {
            outline: none;
            border-color: #000;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .btn-signup {
            width: 100%;
            background-color: #000;
            color: #fff;
            border: none;
            padding: 14px 16px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            margin-top: 15px;
            margin-bottom: 15px;
            transition: all 0.2s ease;
            cursor: pointer;
            min-height: 50px;
        }

        .btn-signup:hover {
            background-color: #1f2937;
            transform: translateY(-1px);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 15px 0;
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
            height: 50px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
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

        .signin-link {
            color: #6b7280;
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }

        .signin-link a {
            color: #ef4444;
            text-decoration: none;
            font-weight: 600;
        }

        .signin-link a:hover {
            text-decoration: underline;
        }

        .alert {
            margin-bottom: 20px;
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

        .text-danger {
            font-size: 12px;
            margin-top: 4px;
            color: #ef4444;
        }

        /* Password strength indicator */
        .password-strength {
            margin-top: 5px;
            font-size: 12px;
        }

        .strength-weak {
            color: #ef4444;
        }

        .strength-medium {
            color: #f59e0b;
        }

        .strength-strong {
            color: #10b981;
        }

        /* Terms checkbox */
        .form-check {
            margin-bottom: 20px;
        }

        .form-check-input {
            margin-right: 8px;
        }

        .form-check-label {
            font-size: 13px;
            color: #666;
            line-height: 1.4;
        }

        .form-check-label a {
            color: #ef4444;
            text-decoration: none;
        }

        .form-check-label a:hover {
            text-decoration: underline;
        }

        /* Right Side - Image */
        .image-section {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 0 24px 24px 0;
            min-height: 600px;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 600"><rect width="400" height="600" fill="%23f8f9fa"/><text x="200" y="300" text-anchor="middle" fill="%23666" font-size="16" font-family="Arial">Tempatkan foto Anda di sini</text></svg>') center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Mobile First - Perbaikan Responsivitas */
        @media (max-width: 768px) {
            body {
                padding: 15px;
                align-items: flex-start;
                padding-top: 30px;
            }

            .register-container {
                flex-direction: column;
                height: auto;
                min-height: auto;
                max-width: 500px;
                border-radius: 20px;
            }

            .image-section {
                order: -1;
                flex: none;
                height: 200px;
                min-height: 200px;
                border-radius: 20px 20px 0 0;
            }

            .form-section {
                padding: 30px 25px;
                border-radius: 0 0 20px 20px;
                min-height: auto;
            }

            .logo-container {
                padding: 5px 0 15px 0;
            }

            .logo-image {
                max-height: 80px;
                max-width: 150px;
            }

            .welcome-title {
                font-size: 26px;
                text-align: center;
                margin-bottom: 6px;
            }

            .welcome-subtitle {
                text-align: center;
                font-size: 15px;
                margin-bottom: 20px;
            }

            .form-group {
                margin-bottom: 14px;
            }

            .form-control {
                padding: 12px 14px;
                font-size: 16px;
            }

            .btn-signup {
                padding: 12px 16px;
                font-size: 15px;
                min-height: 48px;
            }

            .btn-google {
                height: 48px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
                padding-top: 20px;
            }

            .register-container {
                margin: 0;
                border-radius: 16px;
                max-width: 100%;
            }

            .image-section {
                height: 180px;
                min-height: 180px;
                border-radius: 16px 16px 0 0;
            }

            .form-section {
                padding: 25px 20px;
                border-radius: 0 0 16px 16px;
            }

            .form-container {
                max-width: 100%;
            }

            .logo-container {
                padding: 0 0 12px 0;
            }

            .logo-wrapper {
                min-width: 140px;
                min-height: 50px;
            }

            .logo-image {
                max-height: 70px;
                max-width: 130px;
            }

            .welcome-title {
                font-size: 24px;
                margin-bottom: 5px;
            }

            .welcome-subtitle {
                font-size: 14px;
                margin-bottom: 18px;
            }

            .form-group {
                margin-bottom: 12px;
            }

            .form-label {
                font-size: 13px;
                margin-bottom: 6px;
            }

            .form-control {
                padding: 11px 12px;
                font-size: 15px;
                border-radius: 10px;
            }

            .btn-signup {
                padding: 11px 14px;
                font-size: 15px;
                min-height: 46px;
                border-radius: 10px;
                margin-top: 12px;
                margin-bottom: 12px;
            }

            .btn-google {
                height: 46px;
                font-size: 13px;
                border-radius: 10px;
                gap: 10px;
            }

            .divider {
                margin: 12px 0;
            }

            .divider-text {
                font-size: 13px;
                padding: 0 12px;
            }

            .form-check {
                margin-bottom: 15px;
            }

            .form-check-label {
                font-size: 12px;
                line-height: 1.3;
            }

            .signin-link {
                font-size: 13px;
                margin-top: 8px;
            }
        }

        @media (max-width: 360px) {
            body {
                padding: 8px;
                padding-top: 15px;
            }

            .form-section {
                padding: 20px 15px;
            }

            .logo-image {
                max-height: 60px;
                max-width: 120px;
            }

            .welcome-title {
                font-size: 22px;
            }

            .welcome-subtitle {
                font-size: 13px;
            }

            .form-control {
                padding: 10px 12px;
                font-size: 14px;
            }

            .btn-signup {
                padding: 10px 12px;
                font-size: 14px;
                min-height: 44px;
            }

            .btn-google {
                height: 44px;
                font-size: 12px;
            }

            .form-check-label {
                font-size: 11px;
            }
        }

        /* Tablet Portrait */
        @media (min-width: 769px) and (max-width: 1024px) {
            .register-container {
                max-width: 900px;
            }
            
            .form-section {
                padding: 35px;
            }
            
            .logo-image {
                max-height: 100px;
                max-width: 180px;
            }
            
            .welcome-title {
                font-size: 28px;
            }
        }

        /* Medium screens */
        @media (min-width: 901px) and (max-width: 1200px) {
            .register-container {
                max-width: 800px;
            }
            
            .form-section {
                padding: 30px;
            }
            
            .form-container {
                max-width: 350px;
            }
        }

        /* Landscape phones - Perbaikan khusus */
        @media (max-width: 768px) and (orientation: landscape) and (max-height: 600px) {
            body {
                align-items: flex-start;
                padding: 10px;
            }

            .register-container {
                flex-direction: row;
                max-width: 100%;
                min-height: auto;
                height: auto;
            }

            .image-section {
                display: flex;
                order: 0;
                flex: 0.6;
                height: auto;
                min-height: 400px;
                border-radius: 24px 0 0 24px;
            }

            .form-section {
                flex: 1;
                padding: 20px 25px;
                border-radius: 0 24px 24px 0;
                min-height: 400px;
            }

            .logo-container {
                padding: 0 0 10px 0;
            }

            .logo-image {
                max-height: 60px;
                max-width: 120px;
            }

            .welcome-title {
                font-size: 22px;
                margin-bottom: 4px;
            }

            .welcome-subtitle {
                font-size: 13px;
                margin-bottom: 15px;
            }

            .form-group {
                margin-bottom: 10px;
            }

            .form-control {
                padding: 8px 12px;
                font-size: 14px;
            }

            .btn-signup {
                padding: 8px 12px;
                font-size: 14px;
                min-height: 40px;
                margin-top: 8px;
                margin-bottom: 8px;
            }

            .btn-google {
                height: 40px;
                font-size: 12px;
            }

            .divider {
                margin: 8px 0;
            }

            .form-check {
                margin-bottom: 10px;
            }

            .form-check-label {
                font-size: 11px;
            }
        }

        /* Very short screens - Khusus untuk perangkat dengan tinggi terbatas */
        @media (max-height: 500px) {
            body {
                align-items: flex-start;
                padding: 5px;
                padding-top: 10px;
            }

            .register-container {
                min-height: auto;
            }

            .image-section,
            .form-section {
                min-height: auto;
            }

            .form-section {
                padding: 15px 20px;
            }

            .logo-container {
                padding: 0 0 8px 0;
            }

            .welcome-title {
                font-size: 20px;
                margin-bottom: 3px;
            }

            .welcome-subtitle {
                font-size: 12px;
                margin-bottom: 12px;
            }

            .form-group {
                margin-bottom: 8px;
            }

            .form-control {
                padding: 6px 10px;
                font-size: 13px;
            }

            .btn-signup {
                padding: 6px 10px;
                font-size: 13px;
                min-height: 36px;
                margin-top: 6px;
                margin-bottom: 6px;
            }

            .btn-google {
                height: 36px;
                font-size: 11px;
            }
        }

        /* Large desktop screens */
        @media (min-width: 1400px) {
            .register-container {
                max-width: 1400px;
            }

            .form-section {
                padding: 50px;
            }

            .logo-image {
                max-height: 140px;
                max-width: 240px;
            }

            .welcome-title {
                font-size: 36px;
            }

            .welcome-subtitle {
                font-size: 18px;
            }

            .form-control {
                padding: 16px 18px;
                font-size: 17px;
            }

            .btn-signup {
                padding: 16px 18px;
                font-size: 17px;
                min-height: 54px;
            }

            .btn-google {
                height: 54px;
                font-size: 15px;
            }
        }

        /* Print styles */
        @media print {
            body {
                background: #fff;
                padding: 0;
            }

            .register-container {
                box-shadow: none;
                border: 1px solid #ddd;
            }

            .image-section {
                display: none;
            }

            .form-section {
                border-radius: 0;
            }
        }

        /* High contrast mode */
        @media (prefers-contrast: high) {
            .form-control {
                border-color: #000;
            }

            .btn-google {
                border-color: #000;
            }
        }

        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            * {
                transition: none !important;
                animation: none !important;
            }

            .btn-signup:hover,
            .btn-google:hover {
                transform: none;
            }
        }
    </style>
</head>

<body>
    <div class="register-container">
        <!-- Left Side - Form Section -->
        <div class="form-section">
            <div class="form-container">
                <!-- Logo Container -->
                <div class="logo-container">
                    <div class="logo-wrapper">
                        <img src="image/maneviz.png" alt="MANEVIZ Logo" class="logo-image logo-image-only">
                    </div>
                </div>

                <!-- Welcome Text -->
                <h1 class="welcome-title">Create Account</h1>
                <p class="welcome-subtitle">Join us today! Please fill in your information</p>

                <!-- Laravel Validation Errors -->
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
                @endif

                <!-- Success Message -->
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
                @endif

                <!-- Register Form -->
                <form method="POST" action="{{ route('signUp') }}">
                    @csrf

                    <!-- Nama Lengkap Field -->
                    <div class="form-group">
                        <label for="full_name" class="form-label">Nama Lengkap</label>
                        <input type="text"
                            class="form-control @error('full_name') is-invalid @enderror"
                            id="full_name"
                            name="full_name"
                            value="{{ old('full_name') }}"
                            placeholder="Masukkan nama lengkap Anda"
                            required autofocus>
                        @error('full_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email Aktif</label>
                        <input type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email aktif Anda"
                            required>
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Nomor Handphone Field -->
                    <div class="form-group">
                        <label for="phone" class="form-label">Nomor Handphone</label>
                        <input type="tel"
                            class="form-control @error('phone') is-invalid @enderror"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="Contoh: 08123456789"
                            required>
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="Minimal 8 karakter"
                            required>
                        <div class="password-strength" id="password_strength"></div>
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Ulangi Password Field -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Ulangi Password</label>
                        <input type="password"
                            class="form-control"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ulangi password yang sama"
                            required>
                        <small class="text-danger" id="confirm_password_error" style="display: none;">Password tidak cocok.</small>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="form-check">
                        <input class="form-check-input @error('terms') is-invalid @enderror"
                               type="checkbox"
                               id="terms"
                               name="terms"
                               value="1"
                               {{ old('terms') ? 'checked' : '' }}
                               required>
                        <label class="form-check-label" for="terms">
                            Saya setuju dengan <a href="#" target="_blank">Syarat & Ketentuan</a> dan <a href="#" target="_blank">Kebijakan Privasi</a>
                        </label>
                        @error('terms')
                        <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-signup">
                        Create Account
                    </button>
                </form>

                <!-- Divider -->
                <div class="divider">
                    <span class="divider-text">atau daftar dengan</span>
                </div>

                <!-- Google Register -->
                <a href="{{ route('register.google') }}" class="btn-google">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="20" height="20">
                    Google
                </a>

                <!-- Sign In Link -->
                <p class="signin-link">
                    Already have an account? <a href="{{ route('signIn') }}">Sign In</a>
                </p>
            </div>
        </div>

        <!-- Right Side - Image Section -->
        <div class="image-section">
            <div class="image-container">
                <div class="image-placeholder">
                    <img src="image/login-banner.jpg" alt="MANEVIZ" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Password strength checker
        function checkPasswordStrength(password) {
            const strengthIndicator = document.getElementById('password_strength');
            let strength = 0;
            let message = '';

            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            switch (strength) {
                case 0:
                case 1:
                case 2:
                    message = '<span class="strength-weak">Password lemah</span>';
                    break;
                case 3:
                case 4:
                    message = '<span class="strength-medium">Password sedang</span>';
                    break;
                case 5:
                    message = '<span class="strength-strong">Password kuat</span>';
                    break;
            }

            strengthIndicator.innerHTML = message;
        }

        // Phone number formatter
        function formatPhoneNumber(input) {
            let value = input.value.replace(/\D/g, '');

            // Jika dimulai dengan 0, biarkan
            // Jika dimulai dengan 62, biarkan
            // Jika dimulai dengan 8, tambah 0 di depan
            if (value.startsWith('8') && value.length > 1) {
                value = '0' + value;
            }

            input.value = value;
        }

        // Event listeners
        document.getElementById('password').addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });

        document.getElementById('phone').addEventListener('input', function() {
            formatPhoneNumber(this);
        });

        // Real-time validation untuk konfirmasi password
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            const errorDiv = document.getElementById('confirm_password_error');

            if (confirmPassword && password !== confirmPassword) {
                this.classList.add('is-invalid');
                errorDiv.style.display = 'block';
                errorDiv.textContent = 'Password tidak cocok.';
            } else {
                this.classList.remove('is-invalid');
                errorDiv.style.display = 'none';
            }
        });
    </script>
</body>

</html>