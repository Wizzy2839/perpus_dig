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
        $this->call(BookSeeder::class);

        // Settings
        $settings = [
            ['key' => 'loan_duration_days', 'value' => '7'],
            ['key' => 'fine_per_day',        'value' => '1000'],
            ['key' => 'max_loan_per_user',   'value' => '3'],
            ['key' => 'school_name',         'value' => 'SMK PGRI 2 Ponorogo'],
            ['key' => 'library_name',        'value' => 'Perpustakaan Digital'],
            ['key' => 'address',             'value' => 'Jl. Pendidikan No. 1, Jakarta'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
