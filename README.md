# 📚 E-Pustaka: Sistem Perpustakaan Digital Modern
#### 🚀 Web by Muhammad Andy

[![Laravel Version](https://img.shields.io/badge/Laravel-v11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-v8.2+-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![Inter Font](https://img.shields.io/badge/Font-Inter-111111?style=for-the-badge&logo=googlefonts)](https://rsms.me/inter/)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

**E-Pustaka** adalah solusi perpustakaan digital "all-in-one" yang menggabungkan kemudahan akses siswa dengan kontrol penuh delegasi admin. Dirancang khusus untuk institusi pendidikan yang menginginkan transformasi digital yang elegan, cepat, dan handal.

---

## 🛠️ Tech Stack & Kelebihannya

Sistem ini dibangun menggunakan teknologi mutakhir untuk memastikan stabilitas dan pengalaman pengguna terbaik:

- **Laravel 11 (Framework):**
  - *Kelebihan:* Keamanan tingkat tinggi (perlindungan terhadap SQL Injection, XSS, dan CSRF) serta sistem routing yang sangat rapi.
- **PHP 8.2+:**
  - *Kelebihan:* Peningkatan performa signifikan dan fitur *type safety* yang membuat kode lebih stabil dan minim bug.
- **MySQL (Database):**
  - *Kelebihan:* Standar industri untuk penyimpanan data yang cepat, aman, dan mudah di-*scale*.
- **Feather Icons:**
  - *Kelebihan:* Ikon berbasis SVG yang sangat ringan, tajam di semua ukuran layar, dan memberikan kesan minimalis profesional.
- **Inter Font Family:**
  - *Kelebihan:* Tipografi yang dioptimalkan khusus untuk layar komputer, meningkatkan keterbacaan (*readability*) teks secara luar biasa.
- **Vanilla CSS (Custom Premium):**
  - *Kelebihan:* Tidak terikat framework berat, sehingga loading halaman sangat instan dan desain sepenuhnya unik (*pixel-perfect*).

---

## 🌟 Kenapa Memilih E-Pustaka?

1. **Efisiensi Tanpa Batas:** Automasi perhitungan denda dan status keterlambatan menghemat waktu petugas pustaka hingga 80%.
2. **Desain Ultra-Modern:** Menggunakan konsep *Slim Navbar & Footer* serta *Glassmorphism* ringan untuk kesan aplikasi masa depan.
3. **Sistem Kuota Cerdas:** Fitur pembatasan 3 buku memastikan ketersediaan buku bagi seluruh siswa secara adil.
4. **Keamanan Data Siswa:** Enkripsi password standar industri dan sistem otentikasi yang sangat ketat.

---

## ✨ Fitur Utama

### 👨‍🎓 Portal Siswa (Student Module)
- **Katalog E-Commerce Style:** Penampilan buku yang modern dengan filter kategori dan pencarian instan.
- **Sistem Pinjam Mandiri:** Pengajuan peminjaman langsung dari gadget masing-masing.
- **Kartu Identitas Digital:** ID member digital yang elegan untuk keperluan offline.
- **Monitoring Riwayat:** Pantau status buku yang dipinjam dan informasi denda secara real-time.

### 👨‍💼 Portal Admin (Management Module)
- **Dashboard Statistik:** Visualisasi data total buku, anggota aktif, dan buku terlambat.
- **Manajemen Inventori:** Kelola koleksi buku dan stok secara efisien.
- **Otomasi Denda:** Kalkulasi denda otomatis berdasarkan kebijakan sekolah.
- **Panel Persetujuan:** Kelola permintaan pinjam siswa dengan sistem sekali klik.

---

## 🚀 Jalankan Project Sekarang

```bash
# 1. Clone & Setup
git clone https://github.com/Wizzy2839/perpus_dig.git
cd perpus_dig
composer install

# 2. Config
cp .env.example .env
php artisan key:generate

# 3. Database
php artisan migrate --seed

# 4. Ready!
php artisan serve
```

---

<p align="center">
  <strong>Web by Muhammad Andy</strong><br>
  Built with dedication for the future of digital literacy.
</p>

