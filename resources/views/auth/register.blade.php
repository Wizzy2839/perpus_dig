<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota &mdash; {{ \App\Models\Setting::get('library_name', 'Simbok') }}</title>
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
            grid-template-columns: 1fr 1.5fr;
            min-height: 100vh;
        }

        /* Left — decorative */
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
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
        }
        .panel-deco-circle {
            position: absolute;
            bottom: -100px; left: -60px;
            width: 360px; height: 360px;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.05);
        }

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
        .panel-brand-text h2 { font-size: 1rem; font-weight: 700; color: #fff; line-height: 1.2; }
        .panel-brand-text span { font-size: 0.75rem; color: rgba(255,255,255,0.55); font-weight: 500; }

        .panel-content { position: relative; z-index: 10; }
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
            font-size: clamp(1.6rem, 2.5vw, 2.2rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.25;
            margin-bottom: 1rem;
            letter-spacing: -0.5px;
        }
        .panel-content h1 em { font-style: italic; color: rgba(255,255,255,0.7); }
        .panel-content p { font-size: 0.9rem; color: rgba(255,255,255,0.6); line-height: 1.7; max-width: 340px; }

        .panel-steps {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-top: 2rem;
        }
        .panel-step {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .step-num {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.78rem;
            font-weight: 700;
            color: rgba(255,255,255,0.9);
            flex-shrink: 0;
        }
        .step-text { font-size: 0.875rem; color: rgba(255,255,255,0.7); font-weight: 500; }

        .panel-footer { position: relative; z-index: 10; font-size: 0.78rem; color: rgba(255,255,255,0.35); }

        /* Right — Form */
        .auth-form-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem;
            background: var(--bg);
        }
        .auth-form-wrap { width: 100%; max-width: 520px; }

        .form-header { margin-bottom: 1.6rem; }
        .form-header-sub { display: flex; align-items: center; gap: 10px; margin-bottom: 1rem; }
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
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }
        .form-header p { color: #64748b; font-size: 0.875rem; }

        /* Progress Steps */
        .reg-steps {
            display: flex;
            align-items: center;
            gap: 0;
            margin-bottom: 1.5rem;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 10px 16px;
            justify-content: space-between;
        }
        .reg-step { display: flex; align-items: center; gap: 8px; flex: 1; }
        .reg-step-num {
            width: 24px; height: 24px;
            border-radius: 50%;
            background: var(--primary);
            color: #fff;
            font-size: 0.7rem;
            font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .reg-step-label { font-size: 0.78rem; font-weight: 600; color: var(--primary); }
        .reg-step-divider { flex: 1; height: 1px; background: var(--border); margin: 0 8px; }

        /* Form grid */
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .form-group { margin-bottom: 1rem; }
        .form-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.72rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: #475569;
            letter-spacing: .04em;
            text-transform: uppercase;
        }
        .input-wrap { position: relative; }
        .input-wrap .input-icon {
            position: absolute;
            left: 13px;
            top: 50%; transform: translateY(-50%);
            color: #94a3b8;
            width: 16px; height: 16px;
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
            padding: 10px 12px 10px 38px;
            font-size: 0.875rem;
            font-family: inherit;
            border: 1.5px solid var(--border);
            border-radius: 9px;
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
        .invalid-feedback { font-size: 0.75rem; color: #dc2626; margin-top: 4px; font-weight: 500; display: flex; align-items: center; gap: 4px; }
        .invalid-feedback i { width: 13px; height: 13px; }

        .form-section-label {
            font-size: 0.72rem;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: 0.6rem 0 0.5rem;
            border-top: 1px solid var(--border);
            margin-bottom: 0.8rem;
            margin-top: 0.4rem;
        }

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
            box-shadow: 0 4px 14px rgba(26, 60, 94, 0.22);
            margin-top: 1rem;
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

        .auth-footer-link { text-align: center; margin-top: 1.2rem; font-size: 0.875rem; color: #64748b; }
        .auth-footer-link a { color: var(--primary); font-weight: 700; text-decoration: none; }
        .auth-footer-link a:hover { text-decoration: underline; }

        /* Responsive */
        @media (max-width: 960px) {
            .auth-page { grid-template-columns: 1fr; }
            .auth-panel { display: none; }
            .auth-form-panel { padding: 2rem 1.5rem; }
        }
        @media (max-width: 640px) {
            .form-row { grid-template-columns: 1fr; }
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
                Pendaftaran Terbuka
            </div>
            <h1>Bergabung &amp;<br>Mulai <em>Menjelajahi<br>Pengetahuan</em></h1>
            <p>Daftarkan diri Anda untuk mengakses seluruh koleksi perpustakaan digital sekolah kami.</p>
            <div class="panel-steps">
                <div class="panel-step">
                    <div class="step-num">1</div>
                    <span class="step-text">Isi data diri dan akun Anda</span>
                </div>
                <div class="panel-step">
                    <div class="step-num">2</div>
                    <span class="step-text">Akun diaktifkan oleh pustakawan</span>
                </div>
                <div class="panel-step">
                    <div class="step-num">3</div>
                    <span class="step-text">Nikmati ribuan koleksi buku</span>
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
                <h2>Daftar sebagai Anggota</h2>
                <p>Lengkapi data di bawah ini untuk membuat akun perpustakaan.</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST" novalidate>
                @csrf

                {{-- Personal Info --}}
                <div class="form-section-label">Informasi Pribadi</div>

                <div class="form-group {{ $errors->has('name') ? 'is-invalid' : '' }}">
                    <label class="form-label" for="name">Nama Lengkap</label>
                    <div class="input-wrap">
                        <span class="input-icon"><i data-feather="user"></i></span>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Nama lengkap sesuai identitas"
                            value="{{ old('name') }}" autofocus required>
                    </div>
                    @error('name')<div class="invalid-feedback"><i data-feather="alert-circle"></i>{{ $message }}</div>@enderror
                </div>

                <div class="form-row">
                    <div class="form-group {{ $errors->has('nis') ? 'is-invalid' : '' }}">
                        <label class="form-label" for="nis">NIS</label>
                        <div class="input-wrap">
                            <span class="input-icon"><i data-feather="credit-card"></i></span>
                            <input type="text" name="nis" id="nis" class="form-control"
                                placeholder="Nomor Induk Siswa"
                                value="{{ old('nis') }}" required>
                        </div>
                        @error('nis')<div class="invalid-feedback"><i data-feather="alert-circle"></i>{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group {{ $errors->has('kelas') ? 'is-invalid' : '' }}">
                        <label class="form-label" for="kelas">Kelas</label>
                        <div class="input-wrap">
                            <span class="input-icon"><i data-feather="layers"></i></span>
                            <input type="text" name="kelas" id="kelas" class="form-control"
                                placeholder="Contoh: XII RPL 1"
                                value="{{ old('kelas') }}" required>
                        </div>
                        @error('kelas')<div class="invalid-feedback"><i data-feather="alert-circle"></i>{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Account Info --}}
                <div class="form-section-label">Informasi Akun</div>

                <div class="form-group {{ $errors->has('email') ? 'is-invalid' : '' }}">
                    <label class="form-label" for="email">Alamat Email</label>
                    <div class="input-wrap">
                        <span class="input-icon"><i data-feather="mail"></i></span>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Email aktif yang bisa dihubungi"
                            value="{{ old('email') }}" required>
                    </div>
                    @error('email')<div class="invalid-feedback"><i data-feather="alert-circle"></i>{{ $message }}</div>@enderror
                </div>

                <div class="form-row">
                    <div class="form-group {{ $errors->has('password') ? 'is-invalid' : '' }}">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-wrap">
                            <span class="input-icon"><i data-feather="lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Min. 6 karakter" required>
                        </div>
                        @error('password')<div class="invalid-feedback"><i data-feather="alert-circle"></i>{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-wrap">
                            <span class="input-icon"><i data-feather="shield"></i></span>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" placeholder="Ulangi password">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i data-feather="user-plus"></i>
                    Buat Akun Sekarang
                </button>
            </form>

            <div class="auth-footer-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>

        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', () => feather && feather.replace && feather.replace());
</script>
</body>
</html>
