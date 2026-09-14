<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Wisata Budaya Lombok</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background: linear-gradient(135deg, #1f1209 0%, #3d2413 50%, #5c3f22 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            color: #333;
        }

        .auth-container {
            width: 100%;
            max-width: 880px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        @media (min-width: 768px) {
            .auth-container {
                flex-direction: row;
                border-radius: 24px;
            }
        }

        .auth-banner {
            background: linear-gradient(135deg, #8b5e34 0%, #c1440e 100%);
            color: #ffffff;
            padding: 24px 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        @media (min-width: 768px) {
            .auth-banner {
                flex: 1;
                min-width: 300px;
                padding: 40px;
            }
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #fbf3e7;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 14px;
            border-radius: 30px;
            align-self: flex-start;
            transition: background 0.2s ease;
        }

        .back-link:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .auth-banner-content {
            margin: 16px 0 0 0;
        }

        @media (min-width: 768px) {
            .auth-banner-content {
                margin: 40px 0;
            }
        }

        .auth-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(217, 164, 65, 0.25);
            border: 1px solid rgba(217, 164, 65, 0.4);
            color: #fbf3e7;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .auth-banner-title {
            font-size: 20px;
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 6px;
        }

        @media (min-width: 768px) {
            .auth-banner-title {
                font-size: 28px;
                margin-bottom: 12px;
            }
        }

        .auth-banner-desc {
            font-size: 13px;
            opacity: 0.9;
            line-height: 1.5;
        }

        @media (min-width: 768px) {
            .auth-banner-desc {
                font-size: 14px;
            }
        }

        .auth-features {
            display: none;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 20px;
            flex-direction: column;
            gap: 12px;
            font-size: 13px;
        }

        @media (min-width: 768px) {
            .auth-features {
                display: flex;
            }
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            opacity: 0.95;
        }

        .auth-form-section {
            padding: 24px 20px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .auth-form-section {
                flex: 1.2;
                min-width: 320px;
                padding: 40px;
            }
        }

        .form-header {
            margin-bottom: 24px;
        }

        .form-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        @media (min-width: 768px) {
            .form-header h2 {
                font-size: 24px;
            }
        }

        .form-header p {
            font-size: 13px;
            color: #666;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #444;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        /* PERBAIKAN BUG AUTO-ZOOM: font-size minimal 16px */
        .custom-input {
            width: 100%;
            min-height: 46px;
            padding: 10px 14px 10px 42px;
            border: 1px solid #dcdcdc;
            border-radius: 12px;
            font-size: 16px;
            color: #222;
            outline: none;
            background: #fafafa;
            transition: all 0.2s ease;
        }

        .custom-input:focus {
            background: #ffffff;
            border-color: #c1440e;
            box-shadow: 0 0 0 3px rgba(193, 68, 14, 0.15);
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #555;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-label input {
            width: 16px;
            height: 16px;
        }

        .btn-submit {
            width: 100%;
            min-height: 46px;
            padding: 12px;
            background: #c1440e;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s ease, transform 0.1s ease;
            box-shadow: 0 4px 12px rgba(193, 68, 14, 0.25);
        }

        .btn-submit:active {
            transform: scale(0.98);
            background: #a6370a;
        }

        .alert-error {
            background: #fde8e8;
            border: 1px solid #f8b4b4;
            color: #9b1c1c;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 12px;
            margin-bottom: 16px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .auth-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #f0f0f0;
            font-size: 13px;
            color: #666;
        }

        .auth-footer a {
            color: #c1440e;
            font-weight: 700;
            text-decoration: none;
            margin-left: 4px;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="auth-container">
        <!-- Banner Visual Kiri -->
        <div class="auth-banner">
            <a href="{{ route('home') }}" class="back-link">
                <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
                <span>Beranda Utama</span>
            </a>

            <div class="auth-banner-content">
                <span class="auth-badge">
                    <i data-lucide="shield-check" style="width: 13px; height: 13px;"></i> Panel Pengelola
                </span>
                <h1 class="auth-banner-title">Administrator Portal</h1>
                <p class="auth-banner-desc">Masuk untuk mengelola destinasi, memantau transaksi pesanan, dan mengatur
                    ulasan pengguna.</p>
            </div>

            <div class="auth-features">
                <div class="feature-item">
                    <i data-lucide="check-circle" style="width: 16px; height: 16px; color: #d9a441;"></i>
                    <span>Kelola Destinasi & Paket Trip</span>
                </div>
                <div class="feature-item">
                    <i data-lucide="check-circle" style="width: 16px; height: 16px; color: #d9a441;"></i>
                    <span>Tinjau Pesanan & Laporan Keuangan</span>
                </div>
            </div>
        </div>

        <!-- Formulir Login Admin Kanan -->
        <div class="auth-form-section">
            <div class="form-header">
                <h2>Masuk Admin</h2>
                <p>Masukkan kredensial akun administrator Anda</p>
            </div>

            <!-- Notifikasi Error -->
            @if ($errors->any())
                <div class="alert-error">
                    <i data-lucide="alert-circle" style="width: 16px; height: 16px; flex-shrink: 0;"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Form Login -->
            <form method="POST" action="{{ route('admin.login.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email Administrator</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <i data-lucide="mail" style="width: 16px; height: 16px;"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="admin@lombokbudaya.com" class="custom-input">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <i data-lucide="lock" style="width: 16px; height: 16px;"></i>
                        </span>
                        <input type="password" name="password" required placeholder="••••••••" class="custom-input">
                    </div>
                </div>

                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" style="accent-color: #c1440e;">
                        <span>Ingat akun ini</span>
                    </label>
                </div>

                <button type="submit" class="btn-submit">
                    <span>Masuk ke Dashboard</span>
                    <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
                </button>
            </form>

            {{-- <div class="auth-footer">
                Belum punya akun admin?
                <br>
                <a href="{{ route('register') }}">Daftar sebagai Administrator</a>
            </div> --}}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</body>

</html>
