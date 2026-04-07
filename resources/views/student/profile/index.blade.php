@extends('layouts.app')

@section('title', 'Profil Saya')
@section('page-title', 'Pengaturan Profil')

@push('styles')
<style>
    .profile-grid { display: grid; grid-template-columns: minmax(0, 1.3fr) minmax(0, 0.9fr); gap: 24px; align-items: start; }
    @media (max-width: 992px) { .profile-grid { grid-template-columns: 1fr; } }
    
    .avatar-upload-area { display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 32px 24px; background: #f8fafc; border: 1px dashed var(--color-border); border-radius: var(--radius); margin-bottom: 24px; text-align: center; }
    .avatar-preview-wrap { position: relative; margin-bottom: 16px; }
    .avatar-preview-wrap img { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: var(--shadow-sm); }
    .avatar-placeholder { width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, var(--color-primary-light) 0%, var(--color-primary) 100%); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: 700; border: 4px solid #fff; box-shadow: var(--shadow-sm); }
    
    .input-with-icon { position: relative; }
    .input-with-icon svg { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--color-muted); pointer-events: none; }
    .input-with-icon .form-control { padding-left: 42px; }
</style>
@endpush

@section('content')
<div class="profile-grid">
    
    <!-- Update Profile Info Form -->
    <div class="card">
        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="card-header">
                <h2>Informasi Pribadi</h2>
            </div>
            <div class="card-body">
                <div class="avatar-upload-area">
                    <div class="avatar-preview-wrap">
                        @if(auth()->user()->photo)
                            <img id="avatarPreview" src="{{ Storage::url(auth()->user()->photo) }}" alt="Avatar">
                        @else
                            <div id="avatarPlaceholder" class="avatar-placeholder">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <img id="avatarPreview" style="display: none;" alt="Avatar">
                        @endif
                    </div>
                    <label for="photo" class="btn btn-outline btn-sm" style="display: inline-flex; cursor: pointer; margin-bottom: 8px;">
                        <i data-feather="upload" style="width: 16px; height: 16px;"></i>
                        Pilih Foto Profil Baru
                    </label>
                    <input type="file" id="photo" name="photo" accept="image/jpeg,image/png,image/webp" style="display: none;" onchange="previewImage(this)">
                    <div class="form-hint" style="margin-top: 0;">Maks. 1MB. Format: JPG, PNG. Boleh dikosongkan.</div>
                    @error('photo') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                </div>

                <div class="form-row" style="margin-bottom: 18px;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="name">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="phone">No. Handphone / WhatsApp</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->phone) }}">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group mb-0">
                        <label class="form-label">NIS (Nomor Induk Siswa)</label>
                        <div class="input-with-icon">
                            <i data-feather="calendar" style="width: 18px; height: 18px;"></i>
                            <input type="text" class="form-control" value="{{ auth()->user()->nis }}" disabled style="background: var(--color-bg); opacity: 0.8; color: var(--color-muted);">
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label class="form-label">Kelas</label>
                        <div class="input-with-icon">
                            <i data-feather="users" style="width: 18px; height: 18px;"></i>
                            <input type="text" class="form-control" value="{{ auth()->user()->kelas }}" disabled style="background: var(--color-bg); opacity: 0.8; color: var(--color-muted);">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="padding: 16px 24px; border-top: 1px solid var(--color-border); background: #f8fafc; text-align: right;">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <!-- Change Password Form -->
    <div class="card">
        <form action="{{ route('student.profile.password') }}" method="POST">
            @csrf @method('PUT')
            <div class="card-header">
                <h2>Keamanan Akun</h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Email Pendaftaran</label>
                    <div class="input-with-icon">
                        <i data-feather="mail" style="width: 18px; height: 18px;"></i>
                        <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled style="background: var(--color-bg); opacity: 0.8; color: var(--color-muted);">
                    </div>
                </div>

                <hr style="border: 0; border-top: 1px dashed var(--color-border); margin: 24px 0;">

                <div class="form-group">
                    <label class="form-label" for="current_password">Password Saat Ini <span class="text-danger">*</span></label>
                    <div class="input-with-icon">
                        <i data-feather="lock" style="width: 18px; height: 18px;"></i>
                        <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                    </div>
                    @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password">Password Baru <span class="text-danger">*</span></label>
                    <div class="input-with-icon">
                        <i data-feather="lock" style="width: 18px; height: 18px;"></i>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                    </div>
                    <div class="form-hint">Minimal 6 karakter.</div>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group mb-0">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                    <div class="input-with-icon">
                        <i data-feather="lock" style="width: 18px; height: 18px;"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="padding: 16px 24px; border-top: 1px solid var(--color-border); background: #f8fafc; text-align: right;">
                <button type="submit" class="btn btn-primary">Simpan Password</button>
            </div>
        </form>
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
                if(pla) pla.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
