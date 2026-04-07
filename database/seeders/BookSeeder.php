<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan kategori ada sebelum mengisi buku
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->call(DatabaseSeeder::class);
            $categories = Category::all();
        }

        $fiksi = $categories->where('name', 'Fiksi')->first()->id ?? 1;
        $nonFiksi = $categories->where('name', 'Non-Fiksi')->first()->id ?? 2;
        $sains = $categories->where('name', 'Sains & Teknologi')->first()->id ?? 3;
        $sejarah = $categories->where('name', 'Sejarah')->first()->id ?? 4;
        $mtk = $categories->where('name', 'Matematika')->first()->id ?? 5;
        $bahasa = $categories->where('name', 'Bahasa & Sastra')->first()->id ?? 6;
        $agama = $categories->where('name', 'Agama')->first()->id ?? 7;
        $referensi = $categories->where('name', 'Referensi')->first()->id ?? 8;

        $books = [
            // Fiksi
            ['category_id' => $fiksi, 'title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'isbn' => '9789793062792', 'year' => 2005, 'stock' => 5, 'description' => 'Novel tentang perjuangan anak-anak Belitung mengejar impian.'],
            ['category_id' => $fiksi, 'title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'publisher' => 'Hasta Mitra', 'isbn' => '9789799731227', 'year' => 1980, 'stock' => 3, 'description' => 'Kisah Minke yang berjuang di era kolonial Belanda.'],
            ['category_id' => $fiksi, 'title' => 'Negeri 5 Menara', 'author' => 'A. Fuadi', 'publisher' => 'Gramedia', 'isbn' => '9789792272314', 'year' => 2009, 'stock' => 7, 'description' => 'Kisah inspiratif enam santri dengan impian besar.'],
            ['category_id' => $fiksi, 'title' => 'Pulang', 'author' => 'Leila S. Chudori', 'publisher' => 'Kepustakaan Populer Gramedia', 'isbn' => '9789799105158', 'year' => 2012, 'stock' => 4, 'description' => 'Eksplorasi identitas dan sejarah Indonesia.'],
            ['category_id' => $fiksi, 'title' => 'Sang Pemimpi', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'isbn' => '9789793062921', 'year' => 2006, 'stock' => 6, 'description' => 'Sekuel dari Laskar Pelangi.'],

            // Sains & Teknologi
            ['category_id' => $sains, 'title' => 'Fisika Dasar', 'author' => 'Halliday & Resnick', 'publisher' => 'Erlangga', 'isbn' => '9786022411111', 'year' => 2020, 'stock' => 8, 'description' => 'Buku fisika tingkat menengah dan universitas.'],
            ['category_id' => $sains, 'title' => 'Biologi Kelas X', 'author' => 'Tim Erlangga', 'publisher' => 'Erlangga', 'isbn' => '9786022419999', 'year' => 2021, 'stock' => 10, 'description' => 'Buku pelajaran biologi untuk kelas X SMA/MA.'],
            ['category_id' => $sains, 'title' => 'Kimia Dasar', 'author' => 'Raymond Chang', 'publisher' => 'Erlangga', 'isbn' => '9789790753020', 'year' => 2018, 'stock' => 5, 'description' => 'Eksplorasi ilmu kimia dasar.'],
            ['category_id' => $sains, 'title' => 'Algoritma Pemrograman', 'author' => 'Rinaldi Munir', 'publisher' => 'Informatika', 'isbn' => '9786021514917', 'year' => 2016, 'stock' => 12, 'description' => 'Dasar-dasar logika pemrograman komputer.'],

            // Matematika
            ['category_id' => $mtk, 'title' => 'Matematika Wajib Kelas XI', 'author' => 'Tim Kemendikbud', 'publisher' => 'Kemdikbud', 'isbn' => '9786024276523', 'year' => 2019, 'stock' => 15, 'description' => 'Buku matematika wajib kurikulum 2013.'],
            ['category_id' => $mtk, 'title' => 'Kalkulus Purcell', 'author' => 'Edwin J. Purcell', 'publisher' => 'Erlangga', 'isbn' => '9789797410117', 'year' => 2015, 'stock' => 4, 'description' => 'Buku pegangan kalkulus standar internasional.'],

            // Sejarah
            ['category_id' => $sejarah, 'title' => 'Sejarah Indonesia Modern', 'author' => 'M.C. Ricklefs', 'publisher' => 'Serambi', 'isbn' => '9789796245432', 'year' => 2008, 'stock' => 3, 'description' => 'Sejarah Indonesia dari abad ke-18 hingga reformasi.'],
            ['category_id' => $sejarah, 'title' => 'Revolusi Pemuida', 'author' => 'Benedict Anderson', 'publisher' => 'Pustaka Sinar Harapan', 'isbn' => '9789794160275', 'year' => 1988, 'stock' => 2, 'description' => 'Analisis peran pemuda dalam revolusi Indonesia.'],

            // Non-Fiksi / Self Improvement
            ['category_id' => $nonFiksi, 'title' => 'Atomic Habits', 'author' => 'James Clear', 'publisher' => 'Gramedia', 'isbn' => '9786020633510', 'year' => 2020, 'stock' => 20, 'description' => 'Cara mudah membangun kebiasaan baik.'],
            ['category_id' => $nonFiksi, 'title' => 'Filosofi Teras', 'author' => 'Henry Manampiring', 'publisher' => 'Buku Kompas', 'isbn' => '9786024125189', 'year' => 2018, 'stock' => 25, 'description' => 'Filsafat Yunani-Romawi Kuno untuk mental tangguh masa kini.'],
            ['category_id' => $nonFiksi, 'title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'publisher' => 'KPG', 'isbn' => '9786024248260', 'year' => 2017, 'stock' => 10, 'description' => 'Riwayat singkat umat manusia.'],

            // Agama
            ['category_id' => $agama, 'title' => 'Pendidikan Agama Islam', 'author' => 'Tim Kemendikbud', 'publisher' => 'Kemdikbud', 'isbn' => '9786024277001', 'year' => 2021, 'stock' => 30, 'description' => 'Buku PAI dan Budi Pekerti untuk SMA.'],
            ['category_id' => $agama, 'title' => 'Fiqh Prioritas', 'author' => 'Yusuf Al-Qaradhawi', 'publisher' => 'Gema Insani', 'isbn' => '9789795613381', 'year' => 2010, 'stock' => 5, 'description' => 'Pedoman beragama yang cerdas di era modern.'],

            // Referensi
            ['category_id' => $referensi, 'title' => 'KBBI V', 'author' => 'Badan Bahasa', 'publisher' => 'Balai Pustaka', 'isbn' => '9789796940105', 'year' => 2016, 'stock' => 2, 'description' => 'Kamus resmi bahasa Indonesia.'],
            ['category_id' => $referensi, 'title' => 'Atlas Dunia Terbaru', 'author' => 'Tim Geografi', 'publisher' => 'Penerbit Erlangga', 'isbn' => '9786024345678', 'year' => 2022, 'stock' => 3, 'description' => 'Kumpulan peta dunia terlengkap dan terbaru.'],
        ];

        foreach ($books as $book) {
            Book::updateOrCreate(
                ['isbn' => $book['isbn']],
                $book
            );
        }
    }
}
