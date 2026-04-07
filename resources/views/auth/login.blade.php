<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login &mdash; {{ \App\Models\Setting::get('library_name', 'Simbok') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/image/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="{{ asset('assets/feather.min.js') }}"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --primary: #1a3c5e;
            --primary-dark: #122840;
            --primary-light: #2563a8;
            --accent: #2e7d32;
            --bg: #f8fafc;
            --border: #e2e8f0;
            --radius: 12px;
        }
        html, body {
            height: 100%;
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 14px;
            background: var(--bg);
            color: #1e293b;
        }

        /* Layout */
        .auth-page {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* Left panel — decorative */
        .auth-panel {
            background: var(--primary);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .auth-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 80%, rgba(37,99,168,0.6) 0%, transparent 50%),
                radial-gradient(circle at 80% 10%, rgba(18,40,64,0.8) 0%, transparent 40%);
        }
        .auth-panel::after {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 320px; height: 320px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
        }
        .panel-deco-circle {
            position: absolute;
            bottom: -100px; left: -60px;
            width: 380px; height: 380px;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.05);
        }

        /* Panel top nav */
        .panel-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 10;
        }
        .panel-brand img {
            width: 40px; height: 40px;
            object-fit: contain;
            background: #fff;
            border-radius: 10px;
            padding: 4px;
        }
        .panel-brand-text h2 {
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }
        .panel-brand-text span {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.55);
            font-weight: 500;
        }

        /* Panel center content */
        .panel-content {
            position: relative;
            z-index: 10;
        }
        .panel-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 100px;
            padding: 6px 14px;
            font-size: 0.72rem;
            font-weight: 700;
            color: rgba(255,255,255,0.85);
            letter-spacing: .06em;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
        }
        .badge-dot { width: 6px; height: 6px; border-radius: 50%; background: #4ade80; animation: pulse 2s infinite; }
        @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(1.3)} }
        .panel-content h1 {
            font-size: clamp(1.8rem, 2.8vw, 2.5rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 1rem;
            letter-spacing: -0.5px;
        }
        .panel-content h1 em { font-style: italic; color: rgba(255,255,255,0.7); }
        .panel-content p {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.6);
            line-height: 1.7;
            max-width: 380px;
        }

        /* Feature chips */
        .panel-features {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 2rem;
        }
        .panel-feature {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .panel-feature-icon {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.12);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            color: rgba(255,255,255,0.9);
        }
        .panel-feature-icon i { width: 16px; height: 16px; }
        .panel-feature-text {
            font-size: 0.875rem;
            color: rgba(255,255,255,0.75);
            font-weight: 500;
        }

        /* Panel footer */
        .panel-footer {
            position: relative;
            z-index: 10;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.35);
        }

        /* Right Panel — Form */
        .auth-form-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem;
            background: var(--bg);
        }
        .auth-form-wrap {
            width: 100%;
            max-width: 440px;
        }

        /* Form header */
        .form-header {
            margin-bottom: 2rem;
        }
        .form-header-sub {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
        }
        .form-header-sub a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
            text-decoration: none;
            opacity: 0.7;
            transition: opacity .2s;
        }
        .form-header-sub a:hover { opacity: 1; }
        .form-header-sub i { width: 14px; height: 14px; }
        .form-header h2 {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }
        .form-header p { color: #64748b; font-size: 0.9rem; line-height: 1.5; }

        /* Form elements */
        .form-group { margin-bottom: 1.1rem; }
        .form-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 7px;
            color: #475569;
            letter-spacing: .04em;
            text-transform: uppercase;
        }
        .input-wrap { position: relative; }
        .input-wrap .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            width: 17px; height: 17px;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .input-wrap .input-icon i,
        .input-wrap .input-icon svg {
            width: 100% !important;
            height: 100% !important;
            display: block;
        }
        .form-control {
            width: 100%;
            padding: 11px 14px 11px 42px;
            font-size: 0.9rem;
            font-family: inherit;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            background: #fff;
            outline: none;
            transition: all .2s;
            color: #1e293b;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 60, 94, 0.08);
        }
        .form-control::placeholder { color: #c1c9d9; }
        .is-invalid .form-control { border-color: #dc2626; }
        .invalid-feedback { font-size: 0.78rem; color: #dc2626; margin-top: 5px; font-weight: 500; display: flex; align-items: center; gap: 5px; }

        /* Divider */
        .form-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 1.2rem 0;
            color: #cbd5e1;
            font-size: 0.78rem;
        }
        .form-divider::before, .form-divider::after {
            content: ''; flex: 1; height: 1px; background: var(--border);
        }

        /* Options row */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.2rem;
        }
        .form-check { display: flex; align-items: center; gap: 8px; }
        .form-check input {
            width: 16px; height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
            border-radius: 4px;
        }
        .form-check label { font-size: 0.85rem; color: #475569; cursor: pointer; font-weight: 500; }

        /* Submit button */
        .btn-submit {
            width: 100%;
            padding: 13px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(26, 60, 94, 0.2);
            letter-spacing: .01em;
        }
        .btn-submit:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(26, 60, 94, 0.3);
        }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit i,
        .btn-submit svg {
            width: 18px; height: 18px;
            display: block;
        }

        /* Alerts */
        .alert {
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.85rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 1.2rem;
        }
        .alert i { width: 17px; height: 17px; flex-shrink: 0; margin-top: 1px; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
        .alert-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }

        /* Footer link */
        .auth-footer-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #64748b;
        }
        .auth-footer-link a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }
        .auth-footer-link a:hover { text-decoration: underline; }

        /* Responsive */
        @media (max-width: 960px) {
            .auth-page { grid-template-columns: 1fr; }
            .auth-panel { display: none; }
            .auth-form-panel { padding: 2rem 1.5rem; }
        }
        @media (max-width: 480px) {
            .auth-form-panel { padding: 1.5rem 1rem; }
        }
    </style>
</head>
<body>
<div class="auth-page">

    <!-- LEFT: Decorative Panel -->
    <div class="auth-panel">
        <div class="panel-deco-circle"></div>

        <div class="panel-brand">
            <img src="{{ asset('assets/image/logo.png') }}" alt="Logo">
            <div class="panel-brand-text">
                <h2>{{ \App\Models\Setting::get('library_name', 'Simbok') }}</h2>
                <span>{{ \App\Models\Setting::get('school_name', 'SMK PGRI 2 Ponorogo') }}</span>
            </div>
        </div>

        <div class="panel-content">
            <div class="panel-badge">
                <span class="badge-dot"></span>
                Sistem Aktif
            </div>
            <h1>Selamat Datang<br>di <em>Perpustakaan<br>Digital</em></h1>
            <p>Akses ribuan koleksi buku, kelola peminjaman, dan pantau riwayat bacaan Anda dengan mudah.</p>
            <div class="panel-features">
                <div class="panel-feature">
                    <div class="panel-feature-icon"><i data-feather="book-open"></i></div>
                    <span class="panel-feature-text">Ribuan koleksi buku tersedia</span>
                </div>
                <div class="panel-feature">
                    <div class="panel-feature-icon"><i data-feather="clock"></i></div>
                    <span class="panel-feature-text">Akses 24 jam tanpa batas</span>
                </div>
                <div class="panel-feature">
                    <div class="panel-feature-icon"><i data-feather="shield"></i></div>
                    <span class="panel-feature-text">Data aman & terlindungi</span>
                </div>
            </div>
        </div>

        <div class="panel-footer">
            &copy; {{ date('Y') }} {{ \App\Models\Setting::get('school_name', 'SMK PGRI 2 Ponorogo') }}
        </div>
    </div>

    <!-- RIGHT: Form Panel -->
    <div class="auth-form-panel">
        <div class="auth-form-wrap">

            <div class="form-header">
                <div class="form-header-sub">
                    <a href="/"><i data-feather="arrow-left"></i> Kembali ke Beranda</a>
                </div>
                <h2>Masuk ke Akun</h2>
                <p>Masukkan email dan password untuk melanjutkan.</p>
            </div>

            @if(session('error'))
                <div class="alert alert-error">
                    <i data-feather="alert-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i data-feather="check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" novalidate>
                @csrf

                <div class="form-group {{ $errors->has('email') ? 'is-invalid' : '' }}">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-wrap">
                        <span class="input-icon"><i data-feather="mail"></i></span>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="akun@sekolah.sch.id"
                            value="{{ old('email') }}" autofocus required>
                    </div>
                    @error('email')
                        <div class="invalid-feedback"><i data-feather="alert-circle"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrap">
                        <span class="input-icon"><i data-feather="lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Kata sandi Anda" required>
                    </div>
                </div>

                <div class="form-options">
                    <div class="form-check">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i data-feather="log-in"></i>
                    Masuk Sekarang
                </button>
            </form>

            <div class="auth-footer-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
            </div>

        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', () => feather && feather.replace && feather.replace());
</script>
</body>
</html>
