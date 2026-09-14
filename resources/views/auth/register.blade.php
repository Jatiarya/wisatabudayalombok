<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Wisata Budaya Lombok</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
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
                margin: 30px 0;
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
            margin-bottom: 16px;
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

        .btn-google {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 46px;
            padding: 10px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            background: #ffffff;
            color: #333;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-google:active {
            background: #f0f0f0;
            transform: scale(0.99);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 14px 0;
            color: #999;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e5e5;
        }

        .divider span {
            padding: 0 10px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #444;
            margin-bottom: 4px;
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
            min-height: 44px;
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
            margin-top: 6px;
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
            margin-bottom: 12px;
        }

        .alert-error ul {
            margin-left: 16px;
        }

        .captcha-container {
            display: flex;
            justify-content: center;
            margin-top: 8px;
            margin-bottom: 8px;
            max-width: 100%;
            overflow-x: auto;
        }

        .auth-footer {
            text-align: center;
            margin-top: 16px;
            padding-top: 12px;
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
    </style>
</head>

<body>

    <div class="auth-container">
        <!-- Banner Visual -->
        <div class="auth-banner">
            <a href="{{ route('home') }}" class="back-link">
                <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
                <span>Beranda</span>
            </a>

            <div class="auth-banner-content">
                <span class="auth-badge">
                    <i data-lucide="user-plus" style="width: 13px; height: 13px;"></i> Komunitas Sasak
                </span>
                <h1 class="auth-banner-title">Mulai Petualangan Budayamu</h1>
                <p class="auth-banner-desc">Buat akun gratis untuk menjelajahi situs bersejarah dan destinasi Lombok.
                </p>
            </div>

            <div class="auth-features">
                <div class="feature-item">
                    <i data-lucide="shield-check" style="width: 16px; height: 16px; color: #d9a441;"></i>
                    <span>Pendaftaran 100% gratis</span>
                </div>
                <div class="feature-item">
                    <i data-lucide="compass" style="width: 16px; height: 16px; color: #d9a441;"></i>
                    <span>Akses rekomendasi lokal</span>
                </div>
            </div>
        </div>

        <!-- Formulir Pendaftaran -->
        <div class="auth-form-section">
            <div class="form-header">
                <h2>Buat Akun Baru</h2>
                <p>Isi formulir atau gunakan akun Google</p>
            </div>

            <!-- SSO Google -->
            <a href="{{ route('auth.google') }}" class="btn-google">
                <svg style="width: 20px; height: 20px;" viewBox="0 0 24 24">
                    <path fill="#4285F4"
                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                    <path fill="#34A853"
                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                    <path fill="#FBBC05"
                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                    <path fill="#EA4335"
                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                </svg>
                <span>Daftar dengan Google</span>
            </a>

            <div class="divider">
                <span>atau formulir</span>
            </div>

            <!-- Notifikasi Error -->
            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <i data-lucide="user" style="width: 16px; height: 16px;"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            placeholder="Nama lengkap Anda" class="custom-input">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <i data-lucide="mail" style="width: 16px; height: 16px;"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="nama@email.com" class="custom-input">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <i data-lucide="lock" style="width: 16px; height: 16px;"></i>
                        </span>
                        <input type="password" name="password" required placeholder="Minimal 8 karakter"
                            class="custom-input">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <i data-lucide="shield-check" style="width: 16px; height: 16px;"></i>
                        </span>
                        <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi"
                            class="custom-input">
                    </div>
                </div>

                <div class="captcha-container">
                    <div class="cf-turnstile" data-sitekey="{{ config('turnstile.site_key') }}" data-theme="light">
                    </div>
                </div>
                @error('cf-turnstile-response')
                    <p style="color: #e53e3e; font-size: 12px; text-align: center; margin-bottom: 8px;">{{ $message }}
                    </p>
                @enderror

                <button type="submit" class="btn-submit">
                    <span>Daftar Akun</span>
                    <i data-lucide="user-check" style="width: 16px; height: 16px;"></i>
                </button>
            </form>

            <div class="auth-footer">
                Sudah punya akun?
                <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
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
