@extends('layouts.app')

@section('title', 'Pengaturan Profil')
@section('page-title', 'Pengaturan Profil')

@push('styles')
<style>
    .profile-page { max-width: 960px; margin: 0 auto; padding: 24px 24px 56px; }

    /* Page Header */
    .pp-header { display: flex; align-items: center; gap: 14px; margin-bottom: 28px; }
    .pp-header-icon { width: 48px; height: 48px; border-radius: 13px; background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light)); display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 14px rgba(26,60,94,0.2); color: #fff; flex-shrink: 0; }
    .pp-header-icon i { width: 22px; height: 22px; }
    .pp-header h1 { font-size: 20px; font-weight: 800; color: var(--color-text); letter-spacing: -0.3px; margin-bottom: 2px; }
    .pp-header p { font-size: 13px; color: var(--color-muted); }

    /* Grid */
    .pp-grid { display: grid; grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr); gap: 20px; align-items: start; }
    @media (max-width: 860px) { .pp-grid { grid-template-columns: 1fr; } }

    /* Cards */
    .pp-card {
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }
    .pp-card-head {
        display: flex; align-items: center; gap: 10px;
        padding: 16px 22px;
        border-bottom: 1px solid var(--color-border);
        background: var(--color-bg);
    }
    .pp-card-head-icon {
        width: 34px; height: 34px;
        border-radius: 9px;
        background: #EFF6FF;
        color: var(--color-primary);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .pp-card-head-icon i { width: 16px; height: 16px; }
    .pp-card-head-title { font-size: 14.5px; font-weight: 800; color: var(--color-text); }
    .pp-card-head-sub { font-size: 11.5px; color: var(--color-muted); font-weight: 500; }
    .pp-card-body { padding: 24px 22px; }
    .pp-card-foot {
        padding: 14px 22px;
        border-top: 1px solid var(--color-border);
        background: var(--color-bg);
        display: flex; justify-content: flex-end; align-items: center; gap: 10px;
    }

    /* Avatar Upload */
    .avatar-zone {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        background: var(--color-bg);
        border: 1.5px dashed var(--color-border);
        border-radius: 12px;
        margin-bottom: 22px;
        transition: border-color .2s;
    }
    .avatar-zone:hover { border-color: var(--color-primary-light); }
    .avatar-frame {
        width: 88px; height: 88px;
        border-radius: 50%;
        flex-shrink: 0;
        position: relative;
    }
    .avatar-frame img {
        width: 88px; height: 88px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: var(--shadow-md);
    }
    .avatar-initials {
        width: 88px; height: 88px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--color-primary-light), var(--color-primary-dark));
        color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 32px; font-weight: 800;
        border: 3px solid #fff;
        box-shadow: var(--shadow-md);
    }
    .avatar-info h3 { font-size: 14px; font-weight: 700; margin-bottom: 4px; }
    .avatar-info p { font-size: 12px; color: var(--color-muted); margin-bottom: 10px; line-height: 1.5; }
    .avatar-upload-btn {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 7px 14px;
        border: 1.5px solid var(--color-border);
        border-radius: 8px;
        font-size: 12.5px; font-weight: 700;
        color: var(--color-primary);
        background: #fff;
        cursor: pointer;
        transition: all .2s;
    }
    .avatar-upload-btn:hover { border-color: var(--color-primary); background: #EFF6FF; }
    .avatar-upload-btn i { width: 14px; height: 14px; }

    /* Form fields */
    .pp-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px; }
    @media (max-width: 640px) { .pp-form-row { grid-template-columns: 1fr; } }
    .pp-form-group { margin-bottom: 14px; }
    .pp-form-group:last-child { margin-bottom: 0; }
    .pp-label { font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--color-muted); margin-bottom: 6px; display: block; }
    .pp-input-wrap { position: relative; }
    .pp-input-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--color-muted); width: 16px; height: 16px; pointer-events: none; }
    .pp-input {
        width: 100%; padding: 10px 12px 10px 38px;
        font-size: 13.5px; font-family: inherit;
        border: 1.5px solid var(--color-border);
        border-radius: 9px; background: #fff;
        outline: none; color: var(--color-text);
        transition: border-color .2s, box-shadow .2s;
    }
    .pp-input:focus { border-color: var(--color-primary); box-shadow: 0 0 0 3px rgba(26,60,94,0.08); }
    .pp-input:disabled { background: var(--color-bg); color: var(--color-muted); cursor: not-allowed; opacity: .85; }
    .pp-input.is-invalid { border-color: var(--color-danger); }
    .pp-invalid { font-size: 11.5px; color: var(--color-danger); margin-top: 4px; font-weight: 600; }
    .pp-hint { font-size: 11.5px; color: var(--color-muted); margin-top: 4px; }

    /* Divider */
    .pp-divider { border: 0; border-top: 1px dashed var(--color-border); margin: 20px 0; }

    /* Disabled field badge */
    .pp-readonly-badge {
        position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
        font-size: 10px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .04em;
        color: var(--color-muted);
        background: var(--color-border);
        padding: 2px 7px; border-radius: 4px;
    }

    /* Save button */
    .pp-save-btn {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 10px 22px;
        background: var(--color-primary); color: #fff;
        border: none; border-radius: 9px;
        font-size: 13.5px; font-weight: 700;
        cursor: pointer; transition: all .2s;
        box-shadow: 0 3px 10px rgba(26,60,94,0.18);
    }
    .pp-save-btn:hover { background: var(--color-primary-dark); transform: translateY(-1px); }
    .pp-save-btn i { width: 15px; height: 15px; }

    @media (max-width: 600px) {
        .profile-page { padding: 12px 12px 40px; }
    }
</style>
@endpush

@section('content')
<div class="profile-page">

    {{-- Page Header --}}
    <div class="pp-header">
        <div class="pp-header-icon"><i data-feather="user"></i></div>
        <div>
            <h1>Pengaturan Profil</h1>
            <p>Kelola informasi pribadi dan keamanan akun Anda.</p>
        </div>
    </div>

    <div class="pp-grid">

        {{-- ── PERSONAL INFO CARD ── --}}
        <div class="pp-card">
            <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="pp-card-head">
                    <div class="pp-card-head-icon"><i data-feather="user"></i></div>
                    <div>
                        <div class="pp-card-head-title">Informasi Pribadi</div>
                        <div class="pp-card-head-sub">Nama tampilan dan foto profil</div>
                    </div>
                </div>

                <div class="pp-card-body">
                    {{-- Avatar Zone --}}
                    <div class="avatar-zone">
                        <div class="avatar-frame">
                            @if(auth()->user()->photo)
                                <img id="avatarPreview" src="{{ Storage::url(auth()->user()->photo) }}" alt="Avatar">
                            @else
                                <div id="avatarPlaceholder" class="avatar-initials">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <img id="avatarPreview" style="display:none;" alt="Avatar">
                            @endif
                        </div>
                        <div class="avatar-info">
                            <h3>Foto Profil</h3>
                            <p>Maks. 1MB. Format JPG, PNG, atau WebP.<br>Boleh dikosongkan.</p>
                            <label for="photo" class="avatar-upload-btn">
                                <i data-feather="upload"></i>
                                Ganti Foto
                            </label>
                            <input type="file" id="photo" name="photo" accept="image/jpeg,image/png,image/webp" style="display:none;" onchange="previewImage(this)">
                            @error('photo')<div class="pp-invalid" style="margin-top:6px;">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Name + Phone --}}
                    <div class="pp-form-row">
                        <div class="pp-form-group" style="margin-bottom:0;">
                            <label class="pp-label" for="name">Nama Lengkap</label>
                            <div class="pp-input-wrap">
                                <i data-feather="user"></i>
                                <input type="text" name="name" id="name" class="pp-input @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required>
                            </div>
                            @error('name')<div class="pp-invalid">{{ $message }}</div>@enderror
                        </div>
                        <div class="pp-form-group" style="margin-bottom:0;">
                            <label class="pp-label" for="phone">No. WhatsApp</label>
                            <div class="pp-input-wrap">
                                <i data-feather="phone"></i>
                                <input type="text" name="phone" id="phone" class="pp-input @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->phone) }}" placeholder="08xx...">
                            </div>
                            @error('phone')<div class="pp-invalid">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr class="pp-divider">

                    {{-- NIS + Kelas (readonly) --}}
                    <div class="pp-form-row" style="margin-bottom:0;">
                        <div class="pp-form-group" style="margin-bottom:0;">
                            <label class="pp-label">NIS</label>
                            <div class="pp-input-wrap">
                                <i data-feather="credit-card"></i>
                                <input type="text" class="pp-input" value="{{ auth()->user()->nis }}" disabled>
                                <span class="pp-readonly-badge">Terkunci</span>
                            </div>
                        </div>
                        <div class="pp-form-group" style="margin-bottom:0;">
                            <label class="pp-label">Kelas</label>
                            <div class="pp-input-wrap">
                                <i data-feather="layers"></i>
                                <input type="text" class="pp-input" value="{{ auth()->user()->kelas }}" disabled>
                                <span class="pp-readonly-badge">Terkunci</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pp-card-foot">
                    <button type="submit" class="pp-save-btn">
                        <i data-feather="save"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- ── SECURITY CARD ── --}}
        <div class="pp-card">
            <form action="{{ route('student.profile.password') }}" method="POST">
                @csrf @method('PUT')

                <div class="pp-card-head">
                    <div class="pp-card-head-icon"><i data-feather="shield"></i></div>
                    <div>
                        <div class="pp-card-head-title">Keamanan Akun</div>
                        <div class="pp-card-head-sub">Email & ganti password</div>
                    </div>
                </div>

                <div class="pp-card-body">
                    {{-- Email readonly --}}
                    <div class="pp-form-group">
                        <label class="pp-label">Email Terdaftar</label>
                        <div class="pp-input-wrap">
                            <i data-feather="mail"></i>
                            <input type="email" class="pp-input" value="{{ auth()->user()->email }}" disabled>
                        </div>
                    </div>

                    <hr class="pp-divider">

                    {{-- Passwords --}}
                    <div class="pp-form-group">
                        <label class="pp-label" for="current_password">Password Saat Ini <span style="color:var(--color-danger);">*</span></label>
                        <div class="pp-input-wrap">
                            <i data-feather="lock"></i>
                            <input type="password" name="current_password" id="current_password" class="pp-input @error('current_password') is-invalid @enderror" required>
                        </div>
                        @error('current_password')<div class="pp-invalid">{{ $message }}</div>@enderror
                    </div>

                    <div class="pp-form-group">
                        <label class="pp-label" for="password">Password Baru <span style="color:var(--color-danger);">*</span></label>
                        <div class="pp-input-wrap">
                            <i data-feather="key"></i>
                            <input type="password" name="password" id="password" class="pp-input @error('password') is-invalid @enderror" required>
                        </div>
                        <div class="pp-hint">Minimal 6 karakter.</div>
                        @error('password')<div class="pp-invalid">{{ $message }}</div>@enderror
                    </div>

                    <div class="pp-form-group">
                        <label class="pp-label" for="password_confirmation">Konfirmasi Password <span style="color:var(--color-danger);">*</span></label>
                        <div class="pp-input-wrap">
                            <i data-feather="shield"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="pp-input" required>
                        </div>
                    </div>
                </div>

                <div class="pp-card-foot">
                    <button type="submit" class="pp-save-btn">
                        <i data-feather="lock"></i>
                        Simpan Password
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        var pre = document.getElementById('avatarPreview');
        var pla = document.getElementById('avatarPlaceholder');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                pre.src = e.target.result;
                pre.style.display = 'block';
                if (pla) pla.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
