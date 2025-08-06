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
            padding: 40px 20px;
        }

        .login-container {
            display: flex;
            max-width: 1200px;
            width: 100%;
            min-height: 400px; /* Kurangi lagi tinggi minimum */
            height: auto; /* Biarkan tinggi menyesuaikan konten */
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
            min-height: 400px; /* Kurangi lagi tinggi minimum */
        }

        .image-container {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        /* Placeholder untuk foto yang akan Anda masukkan */
        .image-placeholder {
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 600"><rect width="400" height="600" fill="%23f8f9fa"/><text x="200" y="300" text-anchor="middle" fill="%23666" font-size="16" font-family="Arial">Tempatkan foto Anda di sini</text></svg>') center/cover;
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
            padding: 25px 40px; /* Kurangi lagi padding atas-bawah */
            border-radius: 0 24px 24px 0;
            min-height: 400px; /* Kurangi lagi tinggi minimum */
        }

        .form-container {
            width: 100%;
            max-width: 400px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 15px; /* Kurangi lagi margin */
        }

        .logo {
            font-size: 28px; /* Kecilkan logo */
            font-weight: 800;
            color: #000;
            letter-spacing: -1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logo-icon {
            width: 36px; /* Kecilkan icon */
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
            font-size: 28px; /* Kecilkan title */
            font-weight: 700;
            color: #000;
            margin-bottom: 6px; /* Kurangi margin */
            text-align: left;
        }

        .welcome-subtitle {
            color: #666;
            font-size: 14px; /* Kecilkan font */
            margin-bottom: 16px; /* Kurangi lagi margin */
            text-align: left;
        }

        .form-group {
            margin-bottom: 12px; /* Kurangi lagi spacing antar field */
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
            padding: 12px; /* Kurangi padding input */
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
            padding: 12px; /* Kurangi padding button */
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            margin-top: 6px;
            margin-bottom: 12px; /* Kurangi lagi margin */
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
            margin: 10px 0; /* Kurangi lagi margin */
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
            height: 42px; /* Kurangi tinggi button */
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px; /* Kurangi lagi margin */
            transition: all 0.2s ease;
            text-decoration: none;
            font-size: 14px; /* Kecilkan font */
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
            font-size: 14px; /* Kecilkan font */
            text-align: center;
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

        .text-danger {
            font-size: 12px;
            margin-top: 4px;
            color: #ef4444;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
                align-items: flex-start; /* Ubah dari center ke flex-start */
                padding-top: 30px; /* Tambah padding atas */
            }

            .login-container {
                flex-direction: column;
                height: auto;
                min-height: auto; /* Hilangkan min-height di mobile */
                max-width: 400px;
            }

            .image-section {
                display: none;
            }

            .form-section {
                padding: 40px 30px;
                border-radius: 24px;
                min-height: auto; /* Hilangkan min-height di mobile */
            }

            .welcome-title {
                font-size: 28px;
                text-align: center;
            }

            .welcome-subtitle {
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 15px 5px;
                padding-top: 20px; /* Kurangi padding atas di layar kecil */
            }

            .login-container {
                margin: 0;
                border-radius: 16px;
            }

            .form-section {
                padding: 30px 20px;
                border-radius: 16px;
            }

            .form-container {
                max-width: 100%;
            }
        }

        /* Tambahan untuk memastikan tidak ada overflow */
        @media (max-height: 700px) {
            body {
                align-items: flex-start;
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .login-container {
                min-height: auto;
            }

            .image-section,
            .form-section {
                min-height: auto;
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
                    <!-- Tempatkan <img> tag Anda di sini -->
                    <img src="storage/image/login-banner.jpg" alt="MANEVIZ" style="width: 100%; height: 100%; object-fit: cover;">
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

                <!-- Alerts -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <ul class="mb-0 list-unstyled">
                        <li>Please fill out this field.</li>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>

                <!-- Login Form -->
                <form method="POST" action="#" onsubmit="return false;">
                    <!-- Username Field -->
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text"
                               class="form-control"
                               id="username"
                               name="username"
                               value="firman7@gmail.com"
                               placeholder="Enter your username"
                               required autofocus>
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email"
                               class="form-control"
                               id="email"
                               name="email"
                               value=""
                               placeholder="Enter your email address"
                               required>
                        <small class="text-danger">Please fill out this field.</small>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                               class="form-control"
                               id="password"
                               name="password"
                               value="••••••"
                               placeholder="Enter your password"
                               required>
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
                <a href="{{ route('register.google') }}" class="btn-google">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="20" height="20">
                    Google
                </a>

                <!-- Sign Up Link -->
                <p class="signup-link">
                    Don't have an account? <a href={{ url('signUp') }}>Sign Up</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
