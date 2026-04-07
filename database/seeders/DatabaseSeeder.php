<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Book;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@perpus.sch.id',
            'password'  => Hash::make('admin123'),
            'role'      => 'admin',
            'is_active' => true,
        ]);

        // Sample students
        $students = [
            ['name' => 'Ahmad Fauzi',      'nis' => '2024001', 'kelas' => 'X IPA 1'],
            ['name' => 'Siti Nurhaliza',   'nis' => '2024002', 'kelas' => 'X IPA 2'],
            ['name' => 'Budi Santoso',     'nis' => '2024003', 'kelas' => 'XI IPS 1'],
            ['name' => 'Dewi Rahayu',      'nis' => '2024004', 'kelas' => 'XII IPA 3'],
            ['name' => 'Rizky Firmansyah', 'nis' => '2024005', 'kelas' => 'XI IPA 2'],
        ];

        foreach ($students as $i => $student) {
            User::create(array_merge($student, [
                'email'    => 'murid' . ($i + 1) . '@perpus.sch.id',
                'password' => Hash::make('murid123'),
                'role'     => 'murid',
                'is_active' => true,
            ]));
        }

        // Categories
        $categories = [
            ['name' => 'Fiksi',              'description' => 'Novel dan cerita fiksi'],
            ['name' => 'Non-Fiksi',          'description' => 'Buku pengetahuan umum'],
            ['name' => 'Sains & Teknologi',  'description' => 'Buku ilmu pengetahuan alam dan teknologi'],
            ['name' => 'Sejarah',            'description' => 'Buku sejarah dan sosial'],
            ['name' => 'Matematika',         'description' => 'Buku matematika dan logika'],
            ['name' => 'Bahasa & Sastra',    'description' => 'Buku bahasa Indonesia dan sastra'],
            ['name' => 'Agama',              'description' => 'Buku pendidikan agama'],
            ['name' => 'Referensi',          'description' => 'Kamus, ensiklopedia, atlas'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Sample books
        $books = [
            ['category_id' => 1, 'title' => 'Laskar Pelangi',         'author' => 'Andrea Hirata',      'publisher' => 'Bentang Pustaka', 'isbn' => '9789793062792', 'year' => 2005, 'stock' => 3, 'description' => 'Novel tentang perjuangan anak-anak Belitung mengejar impian.'],
            ['category_id' => 1, 'title' => 'Bumi Manusia',           'author' => 'Pramoedya Ananta Toer','publisher' => 'Hasta Mitra',    'isbn' => '9789799731227', 'year' => 1980, 'stock' => 2, 'description' => 'Kisah Minke yang berjuang di era kolonial Belanda.'],
            ['category_id' => 1, 'title' => 'Negeri 5 Menara',       'author' => 'A. Fuadi',            'publisher' => 'Gramedia',        'isbn' => '9789792272314', 'year' => 2009, 'stock' => 4, 'description' => 'Kisah inspiratif enam santri dengan impian besar.'],
            ['category_id' => 3, 'title' => 'Fisika Dasar',           'author' => 'Halliday & Resnick',  'publisher' => 'Erlangga',        'isbn' => '9786022411111', 'year' => 2020, 'stock' => 5, 'description' => 'Buku fisika tingkat menengah dan universitas.'],
            ['category_id' => 3, 'title' => 'Biologi Kelas X',        'author' => 'Tim Erlangga',        'publisher' => 'Erlangga',        'isbn' => '9786022419999', 'year' => 2021, 'stock' => 6, 'description' => 'Buku pelajaran biologi untuk kelas X SMA/MA.'],
            ['category_id' => 5, 'title' => 'Matematika Wajib Kelas XI','author' => 'Tim Kemendikbud',  'publisher' => 'Kemdikbud',       'isbn' => '9786024276523', 'year' => 2019, 'stock' => 8, 'description' => 'Buku matematika wajib kurikulum 2013.'],
            ['category_id' => 4, 'title' => 'Sejarah Indonesia Modern','author' => 'M.C. Ricklefs',      'publisher' => 'Serambi',         'isbn' => '9789796245432', 'year' => 2008, 'stock' => 3, 'description' => 'Sejarah Indonesia dari abad ke-18 hingga reformasi.'],
            ['category_id' => 6, 'title' => 'Kamus Besar Bahasa Indonesia','author' => 'Tim Penyusun KBBI','publisher' => 'Balai Pustaka', 'isbn' => '9789796940105', 'year' => 2016, 'stock' => 2, 'description' => 'Kamus resmi bahasa Indonesia edisi kelima.'],
            ['category_id' => 2, 'title' => 'Atomic Habits',          'author' => 'James Clear',         'publisher' => 'Gramedia',        'isbn' => '9786020633510', 'year' => 2020, 'stock' => 3, 'description' => 'Cara mudah membangun kebiasaan baik dan meninggalkan kebiasaan buruk.'],
            ['category_id' => 7, 'title' => 'Pendidikan Agama Islam', 'author' => 'Tim Kemendikbud',     'publisher' => 'Kemdikbud',       'isbn' => '9786024277001', 'year' => 2021, 'stock' => 10,'description' => 'Buku PAI dan Budi Pekerti untuk SMA.'],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // Settings
        $settings = [
            ['key' => 'loan_duration_days', 'value' => '7'],
            ['key' => 'fine_per_day',        'value' => '1000'],
            ['key' => 'max_loan_per_user',   'value' => '3'],
            ['key' => 'school_name',         'value' => 'SMA Negeri 1 Contoh'],
            ['key' => 'library_name',        'value' => 'Perpustakaan Digital'],
            ['key' => 'address',             'value' => 'Jl. Pendidikan No. 1, Jakarta'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
