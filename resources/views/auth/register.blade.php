<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota &mdash; Perpustakaan Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="{{ asset('assets/feather.min.js') }}"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --primary: #1a3c5e; --primary-dark: #122840; --primary-light: #2563a8;
            --accent: #2e7d32; --bg: #f8fafc; --border: #e2e8f0; --radius: 12px;
        }
        html, body { height: 100%; font-family: 'Inter', system-ui, sans-serif; font-size: 14px; background: var(--bg); color: #1e293b; }
        
        .auth-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .auth-right {
            flex: 1;
            background: var(--primary);
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }
        
        /* Decorative Background Pattern */
        .auth-right::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: repeating-linear-gradient(-45deg, rgba(255,255,255,0.03) 0, rgba(255,255,255,0.03) 2px, transparent 2px, transparent 10px);
            opacity: 0.5;
        }

        .auth-left {
            flex: 1.2;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .auth-form-container {
            width: 100%;
            max-width: 480px;
        }

        .auth-branding {
            text-align: center;
            position: relative;
            z-index: 10;
        }

        .auth-icon {
            width: 80px; height: 80px;
            background: rgba(255,255,255,0.1);
            border-radius: var(--radius);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 24px;
        }
        
        .auth-icon i { width: 40px; height: 40px; color: #fff; }

        .auth-branding h1 { font-size: 32px; font-weight: 700; margin-bottom: 12px; letter-spacing: -0.5px; }
        .auth-branding p { font-size: 16px; color: #cbd5e1; line-height: 1.6; max-width: 360px; margin: 0 auto; }

        .form-header { margin-bottom: 28px; }
        .form-header h2 { font-size: 24px; font-weight: 700; color: var(--primary); margin-bottom: 8px; }
        .form-header p { color: #64748b; font-size: 14.5px; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 12.5px; font-weight: 600; margin-bottom: 8px; color: #475569; }
        
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; width: 16px; height: 16px; pointer-events: none; }
        
        .form-control {
            width: 100%; padding: 11px 14px 11px 40px;
            font-size: 14px; font-family: inherit;
            border: 2px solid var(--border); border-radius: 8px;
            background: #fff; outline: none; transition: all .2s;
            color: #1e293b;
        }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 4px 12px rgba(26, 60, 94, 0.08); }
        .is-invalid .form-control { border-color: #dc2626; }
        .invalid-feedback { font-size: 12px; color: #dc2626; margin-top: 6px; font-weight: 500; }

        .btn-submit {
            width: 100%; padding: 13px; background: var(--primary); color: #fff;
            border: none; border-radius: 8px; font-size: 15px; font-weight: 600;
            cursor: pointer; transition: background .2s; display: flex; align-items: center; justify-content: center; gap: 8px;
            box-shadow: 0 4px 6px rgba(26,60,94,.15);
            margin-top: 24px;
        }
        .btn-submit:hover { background: var(--primary-dark); }
        .btn-submit i { width: 18px; height: 18px; }

        .auth-footer-link { text-align: center; margin-top: 24px; font-size: 14px; color: #64748b; }
        .auth-footer-link a { color: var(--primary); font-weight: 600; text-decoration: none; }
        .auth-footer-link a:hover { text-decoration: underline; }

        @media (max-width: 900px) {
            .auth-right { display: none; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-right">
            <div class="auth-branding">
                <div class="auth-icon">
                    <i data-feather="user-plus"></i>
                </div>
                <h1>Akses Ribuan Koleksi</h1>
                <p>Bergabung dan jadi anggota perpustakaan untuk mengeksplorasi pengetahuan tak terbatas.</p>
            </div>
        </div>

        <div class="auth-left">
            <div class="auth-form-container">
                <div class="form-header">
                    <h2>Daftar Anggota</h2>
                    <p>Lengkapi profil siswa di bawah ini untuk mendaftar.</p>
                </div>

                <form action="{{ route('register.post') }}" method="POST" novalidate>
                    @csrf
                    
                    <div class="form-group {{ $errors->has('name') ? 'is-invalid' : '' }}">
                        <label class="form-label" for="name">NAMA LENGKAP</label>
                        <div class="input-wrap">
                            <i data-feather="user"></i>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Lengkap Siswa" value="{{ old('name') }}" autofocus required>
                        </div>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'is-invalid' : '' }}">
                        <label class="form-label" for="email">ALAMAT EMAIL</label>
                        <div class="input-wrap">
                            <i data-feather="mail"></i>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email aktif" value="{{ old('email') }}" required>
                        </div>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group {{ $errors->has('nis') ? 'is-invalid' : '' }}">
                            <label class="form-label" for="nis">NIS</label>
                            <div class="input-wrap">
                                <i data-feather="credit-card"></i>
                                <input type="text" name="nis" id="nis" class="form-control" placeholder="Nomor Induk Siswa" value="{{ old('nis') }}" required>
                            </div>
                            @error('nis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group {{ $errors->has('kelas') ? 'is-invalid' : '' }}">
                            <label class="form-label" for="kelas">KELAS</label>
                            <div class="input-wrap">
                                <i data-feather="layers"></i>
                                <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Contoh: XII IPA 1" value="{{ old('kelas') }}" required>
                            </div>
                            @error('kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group {{ $errors->has('password') ? 'is-invalid' : '' }}">
                            <label class="form-label" for="password">PASSWORD</label>
                            <div class="input-wrap">
                                <i data-feather="lock"></i>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 6 karakter" required>
                            </div>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="password_confirmation">KONFIRMASI PASSWORD</label>
                            <div class="input-wrap">
                                <i data-feather="shield"></i>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i data-feather="user-plus"></i>
                        Daftar Anggota
                    </button>
                </form>

                <div class="auth-footer-link">
                    Sudah memiliki akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => feather && feather.replace && feather.replace());
    </script>
</body>
</html>
