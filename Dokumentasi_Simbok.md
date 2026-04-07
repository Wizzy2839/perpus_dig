# Dokumentasi Proyek: Simbok (Sistem Informasi Membaca Buku)

## 1. Latar Belakang
Aplikasi perpustakaan konvensional di sekolah seringkali menghadapi tantangan dalam hal manajemen inventaris buku, pemantauan stok secara *real-time*, dan rekapitulasi data peminjaman yang masih manual. Hal ini memperlambat proses administrasi dan menyulitkan siswa untuk mengetahui ketersediaan buku pengetahuan yang mereka butuhkan.

Berangkat dari masalah tersebut, **Simbok** (Sistem Informasi Membaca Buku) dibangun. Aplikasi ini dirancang khusus untuk memenuhi kebutuhan perpustakaan sekolah modern (awalnya dikembangkan untuk kebutuhan SMK PGRI 2 Ponorogo). Simbok bertujuan untuk mendigitalkan ekosistem perpustakaan, menyediakan antarmuka pengguna yang responsif, *premium*, intuitif, dan memudahkan pustakawan maupun siswa untuk mengelola koleksi bacaan secara efisien, serta difokuskan berjalan baik dalam skenario *offline* / Jaringan Lokal (Intranet) di sekolah.

## 2. Tech Stack (Teknologi yang Digunakan)
Aplikasi ini dibangun menggunakan arsitektur monolitik ringan demi menghindari kompleksitas berlebih untuk instalasi *on-premise* yang biasa diterapkan di sekolah-sekolah:

**Backend & Framework utama:**
*   **PHP (>= 8.2)**
*   **Laravel Framework (versi 11.x)**: MVC *pattern*, *Routing*, ORM (Eloquent), *Middleware* otentikasi.

**Database:**
*   **MySQL / MariaDB**: Penyimpanan data relasional sentralisasi.

**Frontend & Styling:**
*   **Laravel Blade Templating Engine**: Templating dinamis yang menyatu dengan backend.
*   **Vanilla / Custom CSS3**: Didesain dari awal (*from scratch*) tanpa *framework* berat seperti Bootstrap / Tailwind untuk menghasilkan *UI Glassmorphism* dan *layouting SaaS* (*Software as a Service*) yang modern dan ringan.
*   **JavaScript (Vanilla)**: Mengelola DOM dasar, validasi form *frontend*, efek gulir (skrol), dan AJAX asinkron ringan jika diperlukan.
*   **Typography**: Google Web Fonts (Nunito Sans & Cormorant Garamond).
*   **Icons**: *Feather Icons* (ringan, bersih, berformat SVG murni).

## 3. Topologi Integrasi & Penempatan
Simbok menerapkan topologi **Lokal/Server-Klien Sederhana (Monolith)**:

*   **Lingkungan Operasi**: Karena target utamanya adalah ketersediaan secara luring/intranet sekolah, aplikasi ini diposisikan di dalam *Local Web Server Stack* seperti **XAMPP / Laragon** di server komputer sekolah.
*   **Akses Klien**: Klien (Siswa dan Pustakawan/Admin) mengakses aplikasi melalui '*Web Browser*' perangkat masing-masing yang terhubung dalam satu Local Area Network (LAN) / Wi-Fi sekolah melalui IP Address lokal (contoh: `http://192.168.1.100/perpus_dig/public`).
*   **Storage Setup**: Seluruh berkas *upload* seperti *Cover Buku* dan *Foto Profil Siswa* disimpan secara lokal melalui tautan sistem `storage/app/public` melalui antarmuka *symlink* (`php artisan storage:link`).
*   **Integrasi Branding Dinamis**: Informasi sentral organisasi seperti "Nama Perpustakaan" dan "Instansi Sekolah" disimpan pada tabel `settings` sehingga UI (Navbar, Landing Page, Auth UI, Footer) merender nama instansi secara dinamis berdasarkan data database, terpisah dari *hardcode view*.

## 4. Fitur Utama

Sistem ini terbagi dalam dua akses peran (Role): **Admin (Pustakawan)** dan **Siswa (Anggota)**.

### A. Fitur Umum (Public)
*   **Modern Landing Page**: Menampilkan deskripsi sekolah/perpustakaan, keuntungan sistem, dan *showcase* daftar 5 buku rilis terbaru secara *real-time* langsung dari database.
*   **Peringatan Ketersediaan Otomatis (*Fallback*)**: Label berwarna indikator ketersediaan stok buku (tersedia / penuh / habis) di halaman depan sebelum login.
*   **Sistem Branding Otomatis**: Integrasi Setting Tabel untuk merefleksikan identitas sekolah (*Logo custom, nama sekolah, nama perpustakaan*).

### B. Fitur Admin (Pustakawan)
*   **Manajemen Buku (CRUD)**: Input lengkap data literatur, kategori, penerbit, nomor ISBN, sinopsis, manajemen kuantitas/stok, hingga unggah *cover*.
*   **Sistem Peringatan Stok (Inventory Warning)**: Indikator peringatan visual di *Dashboard Admin* ketika suatu judul buku sedang berada di zona **MENIPIS** (Stok <= 2) atau **HABIS** (Stok 0).
*   **Approval & Manajemen Peminjaman (Loans)**: Melihat daftar persetujuan pinjaman, menyetujui, mencatat pengembalian, dan riwayat tenggat waktu yang mengkalkulasi kemungkinan terjadinya denda keterlambatan.
*   **Fitur Laporan & Rekapitulasi (Reports)**: Generator laporan aktivitas perpustakaan dalam rentang waktu tertentu, mencakup total peminjaman, jumlah buku kembali, serta rekapitulasi total denda yang terkumpul secara otomatis.
*   **Manajemen Anggota (Siswa)**: Akses CRUD identitas anggota aktif.

### C. Fitur Spesifik Siswa (Anggota Perpus)
*   **Katalog Digital Interaktif**: Tampilan katalog bergaya SaaS dan penyaringan buku intuitif untuk mempermudah temuan referensi.
*   **Fungsi *Loan Management***: Saat memesan buku, sistem membaca limit batas stok (jika buku HABIS, siswa dicekal meminjam dengan notifikasi yang jelas).
*   **Pengaturan Profil Mandiri**: Siswa dapat mengunggah / memanipulasi *avatar* profil interaktif mereka sendiri, merubah sandi, dan menyesuaikan preferensi informasi kontak.

## 5. Troubleshooting & Debugging
Bagian ini merangkum solusi untuk kendala teknis umum yang mungkin dihadapi saat instalasi atau pengembangan:

*   **Masalah Gambar/Cover tidak muncul**: Pastikan *Symbolic Link* sudah dibuat dengan menjalankan perintah `php artisan storage:link` di terminal.
*   **Perubahan UI tidak langsung terlihat**: Jalankan `php artisan view:clear` untuk menghapus *cache* tampilan Blade yang lama.
*   **Error "Migration not found" / Database**: Jika struktur tabel bermasalah, gunakan `php artisan migrate:fresh --seed` (Hapus & buat ulang semua data).
*   **Log Kesalahan**: Jika aplikasi mengalami *crash* atau menampilkan pesan error, periksa rincian teknisnya di berkas `storage/logs/laravel.log`.
*   **Konfigurasi Environment**: Pastikan berkas `.env` sudah dikonfigurasikan dengan benar, terutama `DB_DATABASE`, `DB_USERNAME`, dan `APP_URL` sesuai alamat IP server lokal.
