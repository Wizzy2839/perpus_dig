<footer style="background: var(--color-primary-dark); color: #94a3b8; margin-top: auto;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 36px 28px 0;">

        {{-- Top Row --}}
        <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 36px; margin-bottom: 32px;">

            {{-- Brand --}}
            <div>
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                    <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('assets/image/logo.png') }}" alt="Logo" style="width: 24px; height: 24px; object-fit: contain;">
                    </div>
                    <div>
                        <div style="font-size: 15px; font-weight: 800; color: #fff; line-height: 1.2;">{{ \App\Models\Setting::get('library_name', 'Simbok') }}</div>
                        <div style="font-size: 11px; color: rgba(255,255,255,0.45); font-weight: 500;">{{ \App\Models\Setting::get('school_name', 'SMK PGRI 2 Ponorogo') }}</div>
                    </div>
                </div>
                <p style="font-size: 13.5px; line-height: 1.7; opacity: 0.7; max-width: 280px;">Platform buku digital resmi perpustakaan sekolah. Pinjam buku dengan mudah, gratis tanpa biaya layanan.</p>
            </div>

            {{-- Navigation --}}
            <div>
                <h4 style="color: #fff; font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 16px;">Navigasi</h4>
                <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 10px; font-size: 13.5px;">
                    <li><a href="{{ route('student.dashboard') }}" style="color: #94a3b8; text-decoration: none; transition: color .2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">Beranda</a></li>
                    <li><a href="{{ route('student.catalog.index') }}" style="color: #94a3b8; text-decoration: none; transition: color .2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">Katalog Buku</a></li>
                    <li><a href="{{ route('student.loans.index') }}" style="color: #94a3b8; text-decoration: none; transition: color .2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">Riwayat Pinjaman</a></li>
                </ul>
            </div>

            {{-- Akun --}}
            <div>
                <h4 style="color: #fff; font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 16px;">Akun</h4>
                <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 10px; font-size: 13.5px;">
                    <li><a href="{{ route('student.profile.index') }}" style="color: #94a3b8; text-decoration: none; transition: color .2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">Pengaturan Profil</a></li>
                    <li><a href="javascript:void(0)" style="color: #94a3b8; text-decoration: none;">Syarat & Ketentuan</a></li>
                    <li><a href="javascript:void(0)" style="color: #94a3b8; text-decoration: none;">Tata Tertib</a></li>
                </ul>
            </div>

            {{-- Jam Operasional --}}
            <div>
                <h4 style="color: #fff; font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 16px;">Jam Layanan</h4>
                <div style="display: flex; flex-direction: column; gap: 8px; font-size: 13px;">
                    <div style="display: flex; align-items: center; gap: 9px;">
                        <i data-feather="clock" style="width: 14px; height: 14px; flex-shrink: 0; color: rgba(255,255,255,0.4);"></i>
                        Senin – Jumat
                    </div>
                    <div style="font-size: 14px; font-weight: 700; color: #fff; padding-left: 23px;">07.00 – 15.00</div>
                    <div style="display: flex; align-items: center; gap: 9px; margin-top: 4px;">
                        <i data-feather="map-pin" style="width: 14px; height: 14px; flex-shrink: 0; color: rgba(255,255,255,0.4);"></i>
                        Gedung Perpustakaan
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div style="border-top: 1px solid rgba(255,255,255,0.08); padding: 16px 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; font-size: 12.5px;">
            <span>&copy; {{ date('Y') }} {{ \App\Models\Setting::get('library_name', 'Simbok') }}. Hak Cipta Dilindungi.</span>
            <span style="opacity: .5;">v1.0.0 &bull; Powered by Laravel</span>
        </div>
    </div>
</footer>
