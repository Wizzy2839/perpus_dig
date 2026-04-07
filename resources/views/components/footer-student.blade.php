<footer style="background: #0f172a; color: #cbd5e1; padding: 40px 0 24px; margin-top: auto;">
    <div class="container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 32px; margin-bottom: 32px;">
        
        <!-- Brand Info -->
        <div style="grid-column: span 1; @media(min-width: 992px){ grid-column: span 2; }">
            <div style="display: flex; align-items: center; gap: 12px; font-size: 24px; font-weight: 800; color: #fff; margin-bottom: 16px; letter-spacing: -0.5px;">
                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--color-primary-light) 0%, var(--color-primary) 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(37,99,168,0.4);">
                    <i data-feather="book-open" style="color: #fff; width: 22px; height: 22px;"></i>
                </div>
                <span>E-Pustaka</span>
            </div>
            <p style="font-size: 14px; line-height: 1.6; margin-bottom: 16px; opacity: 0.8; max-width: 320px;">Platform buku digital resmi perpustakaan sekolah. Pinjam buku dengan mudah, gratis tanpa biaya layanan.</p>
        </div>

        <!-- Links -->
        <div>
            <h4 style="color: #fff; font-size: 14px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px;">Layanan Kami</h4>
            <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 14px; font-size: 14px;">
                <li><a href="{{ route('student.dashboard') }}" style="color: #cbd5e1; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#cbd5e1'">Beranda Utama</a></li>
                <li><a href="{{ route('student.catalog.index') }}" style="color: #cbd5e1; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#cbd5e1'">Katalog Buku Digital</a></li>
                <li><a href="{{ route('student.loans.index') }}" style="color: #cbd5e1; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#cbd5e1'">Lacak Peminjaman</a></li>
            </ul>
        </div>
        
        <!-- Support Links -->
        <div>
            <h4 style="color: #fff; font-size: 14px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px;">Dukungan</h4>
            <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 14px; font-size: 14px;">
                <li><a href="{{ route('student.profile.index') }}" style="color: #cbd5e1; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#cbd5e1'">Pengaturan Akun</a></li>
                <li><a href="javascript:void(0)" style="color: #cbd5e1; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#cbd5e1'">Syarat & Ketentuan</a></li>
                <li><a href="javascript:void(0)" style="color: #cbd5e1; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#cbd5e1'">Tata Tertib Perpustakaan</a></li>
            </ul>
        </div>

        <!-- Contact Info -->
        <div>
            <h4 style="color: #fff; font-size: 14px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px;">Hubungi Admin</h4>
            <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 14px; font-size: 14px;">
                <li style="display: flex; gap: 10px; align-items: flex-start; opacity: 0.9;">
                    <i data-feather="map-pin" style="width: 18px; height: 18px; flex-shrink: 0; margin-top: 2px;"></i>
                    <span style="line-height: 1.5;">Gedung Perpustakaan Utama<br>Jam Operasional:<br>Senin - Jumat (07.00 - 15.00)</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Copyright -->
    <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 16px; font-size: 13.5px; opacity: 0.8;">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>&copy; {{ date('Y') }} E-Pustaka Digital System. Seluruh Hak Cipta Dilindungi Undang-Undang.</div>
            <div style="display: flex; gap: 24px; align-items: center;">
                <span>v1.0.0</span>
            </div>
        </div>
    </div>
</footer>
