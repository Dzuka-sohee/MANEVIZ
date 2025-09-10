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
<<<<<<< HEAD

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
=======
>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c

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
        
        .register-container {
            display: flex;
            max-width: 1200px;
            width: 100%;
            min-height: 500px;
            height: auto;
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }
        
        /* Left Side - Form (berkebalikan dari login) */
        .form-section {
            flex: 1;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 40px;
            border-radius: 24px 0 0 24px;
            min-height: 500px;
        }
        
        .form-container {
            width: 100%;
            max-width: 400px;
        }
        
        /* Logo Container - Wadah untuk logo Anda */
        .logo-container {
            text-align: center;
            padding: 10px 0;
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
        
        
        
        /* Placeholder untuk logo */
        .logo-placeholder {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #6b7280;
            font-size: 14px;
        }
        
        .logo-image {
            max-height: 150px;
            max-width: 250px;
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
        
        /* Untuk logo image + text */
        .logo-with-image {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        /* Untuk logo hanya image */
        .logo-image-only {
            display: block;
        }
        
        /* Untuk logo hanya text */
        .logo-text-only {
            font-size: 28px;
            font-weight: 800;
            color: #000;
            letter-spacing: -1px;
        }
        
        .welcome-title {
            font-size: 28px;
            font-weight: 700;
            color: #000;
            margin-bottom: 6px;
            text-align: left;
        }
        
        .welcome-subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: left;
        }
        
        .form-group {
            margin-bottom: 12px;
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
            padding: 12px;
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
        
        .btn-signup {
            width: 100%;
            background-color: #000;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 12px;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        
        .btn-signup:hover {
            background-color: #1f2937;
            transform: translateY(-1px);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 10px 0;
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
            height: 42px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
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
        
        .strength-weak { color: #ef4444; }
        .strength-medium { color: #f59e0b; }
        .strength-strong { color: #10b981; }

        /* Terms checkbox */
        .form-check {
            margin-bottom: 15px;
        }
        
        .form-check-input {
            margin-right: 8px;
        }
        
        .form-check-label {
            font-size: 13px;
            color: #666;
        }
        
        .form-check-label a {
            color: #ef4444;
            text-decoration: none;
        }
        
        .form-check-label a:hover {
            text-decoration: underline;
        }

        /* Right Side - Image (berkebalikan dari login) */
        .image-section {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 0 24px 24px 0;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 600"><rect width="400" height="600" fill="%23f8f9fa"/><text x="200" y="300" text-anchor="middle" fill="%23666" font-size="16" font-family="Arial">Tempatkan foto Anda di sini</text></svg>') center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
                align-items: flex-start;
                padding-top: 30px;
            }
            
            .register-container {
                flex-direction: column;
                height: auto;
                min-height: auto;
                max-width: 400px;
            }
            
            .image-section {
                display: none;
            }
            
            .form-section {
                padding: 40px 30px;
                border-radius: 24px;
                min-height: auto;
            }
            
            .welcome-title {
                font-size: 28px;
                text-align: center;
            }
            
            .welcome-subtitle {
                text-align: center;
            }

            .logo-wrapper {
                min-width: 180px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 15px 5px;
                padding-top: 20px;
            }
            
            .register-container {
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

            .logo-wrapper {
                min-width: 160px;
                min-height: 50px;
            }
        }

        @media (max-height: 700px) {
            body {
                align-items: flex-start;
                padding-top: 20px;
                padding-bottom: 20px;
            }
            
            .register-container {
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
    <div class="register-container">
        <!-- Left Side - Form Section -->
        <div class="form-section">
            <div class="form-container">
<<<<<<< HEAD
                <!-- Logo Container -->
                <div class="logo-container">
                    <div class="logo-wrapper">
                        <img src="image/maneviz.png" alt="MANEVIZ Logo" class="logo-image logo-image-only">
=======
                <!-- Logo Container - Siap untuk logo Anda -->
                <div class="logo-container">
                    <div class="logo-wrapper">
                        <!-- OPSI 1: Logo Image + Text -->
                        <!-- Uncomment dan sesuaikan untuk logo image + text -->
                        <!--
                        <div class="logo-with-image">
                            <img src="path/to/your/logo.png" alt="MANEVIZ Logo" class="logo-image">
                            <span class="logo-text">MANEVIZ</span>
                        </div>
                        -->
                        
                        <!-- OPSI 2: Logo Image Only -->
                        <!-- Uncomment dan sesuaikan untuk logo hanya image -->
                        
                        <img src="storage/image/maneviz.png" alt="MANEVIZ Logo" class="logo-image logo-image-only">
                       
                        
                        <!-- OPSI 3: Logo Text Only (sementara/default) -->
                        <!-- <div class="logo-text-only">MANEVIZ</div> -->
                        
                        <!-- PLACEHOLDER (akan dihapus setelah logo ditambahkan) -->
                        <!-- 
                        <div class="logo-placeholder">
                            <i class="bi bi-image"></i>
                            <span>Logo MANEVIZ</span>
                        </div>
                        -->
>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c
                    </div>
                </div>
                
                <!-- Welcome Text -->
                <h1 class="welcome-title">Create Account</h1>
                <p class="welcome-subtitle">Join us today! Please fill in your information</p>

<<<<<<< HEAD
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
=======
                <!-- Alerts -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <ul class="mb-0 list-unstyled">
                        <li>Please fill out all required fields.</li>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>

                <!-- Register Form -->
                <form method="POST" action="#" onsubmit="return validateForm(event);">
                    <!-- Nama Lengkap Field -->
                    <div class="form-group">
                        <label for="full_name" class="form-label">Nama Lengkap</label>
                        <input type="text"
                               class="form-control"
                               id="full_name"
                               name="full_name"
                               placeholder="Masukkan nama lengkap Anda"
                               required autofocus>
                        <small class="text-danger" id="full_name_error" style="display: none;">Nama lengkap harus diisi.</small>
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email Aktif</label>
                        <input type="email"
                               class="form-control"
                               id="email"
                               name="email"
                               placeholder="Masukkan email aktif Anda"
                               required>
                        <small class="text-danger" id="email_error" style="display: none;">Email harus valid.</small>
                    </div>

                    <!-- Nomor Handphone Field -->
                    <div class="form-group">
                        <label for="phone" class="form-label">Nomor Handphone</label>
                        <input type="tel"
                               class="form-control"
                               id="phone"
                               name="phone"
                               placeholder="Contoh: 08123456789"
                               required>
                        <small class="text-danger" id="phone_error" style="display: none;">Nomor handphone harus valid.</small>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                               class="form-control"
                               id="password"
                               name="password"
                               placeholder="Minimal 8 karakter"
                               required>
                        <div class="password-strength" id="password_strength"></div>
                        <small class="text-danger" id="password_error" style="display: none;">Password minimal 8 karakter.</small>
                    </div>

                    <!-- Ulangi Password Field -->
                    <div class="form-group">
                        <label for="confirm_password" class="form-label">Ulangi Password</label>
                        <input type="password"
                               class="form-control"
                               id="confirm_password"
                               name="confirm_password"
                               placeholder="Ulangi password yang sama"
                               required>
>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c
                        <small class="text-danger" id="confirm_password_error" style="display: none;">Password tidak cocok.</small>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="form-check">
<<<<<<< HEAD
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
=======
                        <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">
                            Saya setuju dengan <a href="#" target="_blank">Syarat & Ketentuan</a> dan <a href="#" target="_blank">Kebijakan Privasi</a>
                        </label>
                        <small class="text-danger" id="terms_error" style="display: none;">Anda harus menyetujui syarat dan ketentuan.</small>
>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c
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
<<<<<<< HEAD
                <a href="{{ route('register.google') }}" class="btn-google">
=======
                <a href="#" class="btn-google">
>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="20" height="20">
                    Google
                </a>

                <!-- Sign In Link -->
                <p class="signin-link">
<<<<<<< HEAD
                    Already have an account? <a href="{{ route('signIn') }}">Sign In</a>
=======
                    Already have an account? <a href="#">Sign In</a>
>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c
                </p>
            </div>
        </div>

        <!-- Right Side - Image Section -->
        <div class="image-section">
            <div class="image-container">
                <div class="image-placeholder">
<<<<<<< HEAD
                    <img src="image/login-banner.jpg" alt="MANEVIZ" style="width: 100%; height: 100%; object-fit: cover;">
=======
                    <!-- Ganti dengan foto Anda -->
                    <img src="storage/image/login-banner.jpg" alt="MANEVIZ" style="width: 100%; height: 100%; object-fit: cover;">
>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<<<<<<< HEAD

=======
    
>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c
    <!-- Custom JavaScript -->
    <script>
        // Password strength checker
        function checkPasswordStrength(password) {
            const strengthIndicator = document.getElementById('password_strength');
            let strength = 0;
            let message = '';
<<<<<<< HEAD

=======
            
>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
<<<<<<< HEAD

=======
            
>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c
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
<<<<<<< HEAD

=======
            
>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c
            strengthIndicator.innerHTML = message;
        }

        // Phone number formatter
        function formatPhoneNumber(input) {
            let value = input.value.replace(/\D/g, '');
<<<<<<< HEAD

=======
            
>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c
            // Jika dimulai dengan 0, biarkan
            // Jika dimulai dengan 62, biarkan
            // Jika dimulai dengan 8, tambah 0 di depan
            if (value.startsWith('8') && value.length > 1) {
                value = '0' + value;
            }
<<<<<<< HEAD

            input.value = value;
        }

=======
            
            input.value = value;
        }

        // Form validation
        function validateForm(event) {
            event.preventDefault();
            
            let isValid = true;
            
            // Reset error messages
            document.querySelectorAll('.text-danger').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid'));
            
            // Validate full name
            const fullName = document.getElementById('full_name').value.trim();
            if (fullName.length < 2) {
                showError('full_name', 'Nama lengkap minimal 2 karakter.');
                isValid = false;
            }
            
            // Validate email
            const email = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showError('email', 'Format email tidak valid.');
                isValid = false;
            }
            
            // Validate phone
            const phone = document.getElementById('phone').value.trim();
            const phoneRegex = /^(0|62)[0-9]{9,12}$/;
            if (!phoneRegex.test(phone)) {
                showError('phone', 'Nomor handphone tidak valid (contoh: 08123456789).');
                isValid = false;
            }
            
            // Validate password
            const password = document.getElementById('password').value;
            if (password.length < 8) {
                showError('password', 'Password minimal 8 karakter.');
                isValid = false;
            }
            
            // Validate confirm password
            const confirmPassword = document.getElementById('confirm_password').value;
            if (password !== confirmPassword) {
                showError('confirm_password', 'Password tidak cocok.');
                isValid = false;
            }
            
            // Validate terms
            const terms = document.getElementById('terms').checked;
            if (!terms) {
                showError('terms', 'Anda harus menyetujui syarat dan ketentuan.');
                isValid = false;
            }
            
            if (isValid) {
                // Here you would normally submit the form
                alert('Form berhasil divalidasi! Data siap dikirim.');
                // document.forms[0].submit();
            } else {
                // Show general error alert
                const alertDiv = document.querySelector('.alert-danger');
                alertDiv.style.display = 'block';
            }
            
            return isValid;
        }
        
        function showError(fieldId, message) {
            const field = document.getElementById(fieldId);
            const error = document.getElementById(fieldId + '_error');
            
            field.classList.add('is-invalid');
            error.textContent = message;
            error.style.display = 'block';
        }

>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c
        // Event listeners
        document.getElementById('password').addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });
<<<<<<< HEAD

        document.getElementById('phone').addEventListener('input', function() {
            formatPhoneNumber(this);
        });

        // Real-time validation untuk konfirmasi password
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            const errorDiv = document.getElementById('confirm_password_error');

=======
        
        document.getElementById('phone').addEventListener('input', function() {
            formatPhoneNumber(this);
        });
        
        // Real-time validation
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            const errorDiv = document.getElementById('confirm_password_error');
            
>>>>>>> e8edcfba74441875a6c4a30efdb1ee55df5e141c
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