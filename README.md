# 📚 PerpusDig: Perpustakaan Digital Sekolah Modern
#### 🚀 Web by Muhammad Andy

[![Laravel Version](https://img.shields.io/badge/Laravel-v11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-v8.2+-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

**PerpusDig** adalah platform perpustakaan digital terintegrasi yang dirancang khusus untuk meningkatkan literasi di lingkungan sekolah. Sistem ini tidak hanya mempermudah sirkulasi buku secara offline, tetapi juga menyediakan manajemen inventaris yang akurat dengan antarmuka (UI) yang memukau dan pengalaman pengguna (UX) masa kini.

---

## 💎 Keunggulan PerpusDig

Berbeda dengan sistem perpustakaan konvensional, PerpusDig difokuskan pada kecepatan, kemudahan penggunaan, dan fungsionalitas yang menjawab masalah nyata di lapangan:

1. **Dashboard Cerdas & Analitik:** Menyediakan ringkasan eksekutif secara *real-time* tentang jumlah buku tersedia, buku yang sedang dipinjam, siswa aktif, hingga persentase buku yang melebihi batas waktu (overdue).
2. **Peringatan Stok Otomatis:** Sistem memberikan peringatan visual saat stok buku **menipis (≤ 2)** atau **habis (0)**, baik di sisi Admin maupun Siswa, meminimalisir kebingungan ketersediaan fisik di rak.
3. **E-Commerce Style Catalog:** Siswa mencari dan memilih buku layaknya berbelanja cerdas—lengkap dengan sampul buku, spesifikasi detail, ketersediaan *real-time*, dan fitur "Ajukan Peminjaman" sekali klik.
4. **Keamanan & Otorisasi Ketat:** Mencegah siswa mengajukan peminjaman buku yang sama jika status sebelumnya masih dalam proses persetujuan atau belum dikembalikan.
5. **Estetika Premium (Light/Dark Mode Ready):** Menggunakan desain *landing page* yang mempesona (Light Mode Edition) dengan pendekatan kaca (*glassmorphism*) yang bersih dan tipografi yang dirancang khusus untuk keterbacaan tinggi.

---

## 🛠️ Stack Teknologi (Tech Stack)

PerpusDig dikembangkan tanpa mengorbankan performa, menggunakan ekosistem terpercaya standar industri:

### Backend & Core
- **Laravel 11.x:** Kerangka kerja utama yang menangani *Routing*, *Middleware*, otentikasi (Breeze), dan ORM (Eloquent). Memastikan koneksi *database* yang aman dari ancaman siber (SQL Injection, CSRF, XSS).
- **PHP 8.2+:** Mesin komputasi dengan fitur tipe data ketat (*strict typing*) yang membuat proses kalkulasi denda dan *query* menjadi sangat cepat.
- **MySQL / MariaDB:** Basis data relasional yang kokoh untuk menampung data anggota, katalog ribuan buku, serta log transaksi peminjaman.

### Frontend & Desain Visual
- **Blade Templating Engine:** Sistem tata letak *native* Laravel yang memungkinkan pemisahan komponen (partials) seperti navigasi, tata letak, dan peringatan *alert* secara sangat rapi.
- **Vanilla CSS (Custom):** Alih-alih bergantung penuh pada kerangka kerja besar seperti Bootstrap/Tailwind yang berpotensi memperlambat *loading*, seluruh komponen *landing page*, *dashboard*, dan UX katalog dibangun dari awal (*from scratch*) agar 100% responsif dan ringan (Ultra-Fast Load).
- **Google Fonts (Nunito Sans & Cormorant Garamond):** Pilihan tipografi yang menawarkan kontras sempurna antara elemen bacaan informal dan struktur judul yang mendalam.
- **Feather Icons:** Pustaka ikon SVG minimalis yang memanjakan mata, dirender tanpa penundaan *loading*.

---

## 🎯 Modul Aplikasi

### 👨‍🎓 Portal Siswa (Sisi Pengunjung)
- **Halaman Beranda Eksklusif:** Pengalaman *onboarding* yang memotivasi siswa untuk membaca.
- **Detail Buku (E-Commerce View):** Menampilkan sinopsis, detail penerbit, ISBN, rekomendasi buku dalam kategori sama, serta tombol pengajuan.
- **Indikator Stok Cerdas:** Siswa tahu persis kapan mereka harus bergegas meminjam sebelum kehabisan.
- **Rak Peminjaman Saya:** Melacak sejauh mana proses peminjaman disetujui pustakawan, serta kalkulasi denda harian jika telat mengembalikan.

### 👨‍💼 Portal Admin (Pustakawan)
- **Manajemen Katalog Buku:** Operasi *Create, Read, Update, Delete* (CRUD) buku dengan kemudahan *upload* pasfoto sampul, beserta visualisasi jumlah total stok vs. stok tersedia di rak.
- **Sirkulasi Terpadu:** Modul persetujuan atau penolakan pengajuan pinjaman dari siswa dengan 1 klik.
- **Pengelolaan Pengguna:** Mengatur daftar siswa yang terdaftar maupun memblokir siswa bermasalah.

---

## 🚀 Panduan Instalasi (Quick Start)

Jalankan perintah berikut di terminal Anda untuk menjalankan PerpusDig di mesin lokal (sebaiknya gunakan terminal Bash atau PowerShell):

```bash
# 1. Kloning Repositori
git clone https://github.com/Wizzy2839/perpus_dig.git
cd perpus_dig

# 2. Instalasi Dependensi PHP
composer install

# 3. Konfigurasi Lingkungan (Database)
cp .env.example .env
# Buka file .env dan atur kredensial database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# 4. Generate Application Key
php artisan key:generate

# 5. Siapkan Database dan Data Dummy (Opsional)
php artisan migrate --seed
# Jika ada symlink error pada gambar:
php artisan storage:link

# 6. Jalankan Server Lokal
php artisan serve
```

Aplikasi kini dapat diakses melalui `http://localhost:8000`.

---

<p align="center">
  <strong>Membangun Generasi Cerdas Melalui Literasi Digital</strong><br>
  Dibuat oleh <b>Muhammad Andy</b>
</p>
