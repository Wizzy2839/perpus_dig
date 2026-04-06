-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2026 at 04:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_dig`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `cover` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `category_id`, `title`, `author`, `publisher`, `isbn`, `year`, `description`, `stock`, `cover`, `created_at`, `updated_at`) VALUES
(1, 1, 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '9789793062792', '2005', 'Novel tentang perjuangan anak-anak Belitung mengejar impian.', 3, NULL, '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(2, 1, 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', '9789799731227', '1980', 'Kisah Minke yang berjuang di era kolonial Belanda.', 2, NULL, '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(3, 1, 'Negeri 5 Menara', 'A. Fuadi', 'Gramedia', '9789792272314', '2009', 'Kisah inspiratif enam santri dengan impian besar.', 4, NULL, '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(4, 3, 'Fisika Dasar', 'Halliday & Resnick', 'Erlangga', '9786022411111', '2020', 'Buku fisika tingkat menengah dan universitas.', 5, NULL, '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(5, 3, 'Biologi Kelas X', 'Tim Erlangga', 'Erlangga', '9786022419999', '2021', 'Buku pelajaran biologi untuk kelas X SMA/MA.', 6, NULL, '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(6, 5, 'Matematika Wajib Kelas XI', 'Tim Kemendikbud', 'Kemdikbud', '9786024276523', '2019', 'Buku matematika wajib kurikulum 2013.', 8, NULL, '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(7, 4, 'Sejarah Indonesia Modern', 'M.C. Ricklefs', 'Serambi', '9789796245432', '2008', 'Sejarah Indonesia dari abad ke-18 hingga reformasi.', 3, NULL, '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(8, 6, 'Kamus Besar Bahasa Indonesia', 'Tim Penyusun KBBI', 'Balai Pustaka', '9789796940105', '2016', 'Kamus resmi bahasa Indonesia edisi kelima.', 2, NULL, '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(9, 2, 'Atomic Habits', 'James Clear', 'Gramedia', '9786020633510', '2020', 'Cara mudah membangun kebiasaan baik dan meninggalkan kebiasaan buruk.', 3, NULL, '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(10, 7, 'Pendidikan Agama Islam', 'Tim Kemendikbud', 'Kemdikbud', '9786024277001', '2021', 'Buku PAI dan Budi Pekerti untuk SMA.', 10, NULL, '2026-04-07 01:11:15', '2026-04-07 01:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Fiksi', 'fiksi', 'Novel dan cerita fiksi', '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(2, 'Non-Fiksi', 'non-fiksi', 'Buku pengetahuan umum', '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(3, 'Sains & Teknologi', 'sains-teknologi', 'Buku ilmu pengetahuan alam dan teknologi', '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(4, 'Sejarah', 'sejarah', 'Buku sejarah dan sosial', '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(5, 'Matematika', 'matematika', 'Buku matematika dan logika', '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(6, 'Bahasa & Sastra', 'bahasa-sastra', 'Buku bahasa Indonesia dan sastra', '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(7, 'Agama', 'agama', 'Buku pendidikan agama', '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(8, 'Referensi', 'referensi', 'Kamus, ensiklopedia, atlas', '2026-04-07 01:11:15', '2026-04-07 01:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `loan_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('pending','approved','returned','rejected','overdue') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `fine_amount` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `book_id`, `loan_date`, `due_date`, `return_date`, `status`, `notes`, `fine_amount`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2026-04-06', '2026-04-13', '2026-04-06', 'returned', NULL, 0, '2026-04-07 01:24:23', '2026-04-07 01:26:33'),
(2, 2, 5, '2026-04-07', '2026-04-14', NULL, 'pending', NULL, 0, '2026-04-07 04:53:18', '2026-04-07 04:53:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_01_000003_create_categories_table', 1),
(5, '2026_01_01_000004_create_books_table', 1),
(6, '2026_01_01_000005_create_loans_table', 1),
(7, '2026_01_01_000006_create_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'loan_duration_days', '7', '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(2, 'fine_per_day', '1000', '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(3, 'max_loan_per_user', '3', '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(4, 'school_name', 'SMA Negeri 1 Contoh', '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(5, 'library_name', 'Perpustakaan Digital', '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(6, 'address', 'Jl. Pendidikan No. 1, Jakarta', '2026-04-07 01:11:15', '2026-04-07 01:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','murid') NOT NULL DEFAULT 'murid',
  `nis` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `nis`, `kelas`, `phone`, `photo`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@perpus.sch.id', NULL, '$2y$12$T4LYyq.1HAM1WxQDVCRRdeLRItnZXg0d6RjiZ5QG8l9U24mTP9UeK', 'admin', NULL, NULL, NULL, NULL, 1, NULL, '2026-04-07 01:11:13', '2026-04-07 01:11:13'),
(2, 'Ahmad Fauzi', 'murid1@perpus.sch.id', NULL, '$2y$12$TWY0bGwrHVVCTRyXOStTwOZoHc1YPs0HkgMejfMOEvapdLyWziTgC', 'murid', '2024001', 'X IPA 1', NULL, NULL, 1, NULL, '2026-04-07 01:11:13', '2026-04-07 01:11:13'),
(3, 'Siti Nurhaliza', 'murid2@perpus.sch.id', NULL, '$2y$12$rIfOWQZVQAoKv/9dm1F2s.xavRfmpTFo95KYSL4pR7b54AURQbDXK', 'murid', '2024002', 'X IPA 2', NULL, NULL, 1, NULL, '2026-04-07 01:11:14', '2026-04-07 01:11:14'),
(4, 'Budi Santoso', 'murid3@perpus.sch.id', NULL, '$2y$12$eqiJUp7UkXmnXZ2wI2.5guL3ClKQKxe1/2olNvCAO4MLQl1eykWO2', 'murid', '2024003', 'XI IPS 1', NULL, NULL, 1, NULL, '2026-04-07 01:11:14', '2026-04-07 01:11:14'),
(5, 'Dewi Rahayu', 'murid4@perpus.sch.id', NULL, '$2y$12$cX/C8ie6X0vMu2Y80ctSTOREnoNGPolRHecmcNjkznTCA8OHWxhK2', 'murid', '2024004', 'XII IPA 3', NULL, NULL, 1, NULL, '2026-04-07 01:11:15', '2026-04-07 01:11:15'),
(6, 'Rizky Firmansyah', 'murid5@perpus.sch.id', NULL, '$2y$12$OMvu5sEV2RIfXB1wlVdWyeystbGKTVe/MqnzPtzPYRpkccgxLdthi', 'murid', '2024005', 'XI IPA 2', NULL, NULL, 1, NULL, '2026-04-07 01:11:15', '2026-04-07 01:11:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_isbn_unique` (`isbn`),
  ADD KEY `books_category_id_foreign` (`category_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_user_id_foreign` (`user_id`),
  ADD KEY `loans_book_id_foreign` (`book_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nis_unique` (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
