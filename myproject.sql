-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 29, 2024 at 04:21 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kegiatan`
--

CREATE TABLE `laporan_kegiatan` (
  `id_kegiatan` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_lokasi` bigint UNSIGNED NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `jenis_kegiatan` enum('Harian','Mingguan','Bulanan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_kegiatan`
--

INSERT INTO `laporan_kegiatan` (`id_kegiatan`, `id_user`, `id_lokasi`, `tanggal_kegiatan`, `jenis_kegiatan`, `deskripsi`, `created_at`, `updated_at`) VALUES
(2, 3, 2, '2024-12-26', 'Harian', 'Totalitas Tanpa batas bersih bersih boss', '2024-12-26 09:47:34', '2024-12-26 10:35:09'),
(3, 3, 3, '2024-12-27', 'Mingguan', 'Membersihkan semua Boomgate', '2024-12-26 10:20:51', '2024-12-29 02:25:53'),
(4, 9, 4, '2024-12-28', 'Bulanan', 'Kegiatan apa nih uhuy', '2024-12-26 11:06:36', '2024-12-26 11:06:36'),
(5, 8, 3, '2024-12-28', 'Harian', 'Tolong dibantu biar cepat selesai', '2024-12-28 00:55:48', '2024-12-28 00:55:48'),
(6, 3, 4, '2024-12-30', 'Mingguan', 'tolong dong kawan hehehe', '2024-12-28 01:11:33', '2024-12-28 01:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` bigint UNSIGNED NOT NULL,
  `nama_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `nama_lokasi`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Pusat', 'Jl. Suryakencana No.1, Pamulang Bar., Kec. Pamulang, Kota Tangerang Selatan, Banten 15417', NULL, NULL),
(2, 'Viktor', 'Jl. Raya Puspitek, Buaran, Kec. Pamulang, Kota Tangerang Selatan, Banten 15310', NULL, NULL),
(3, 'Witana', 'Jl. Witana Harja No.18b, Pamulang Bar., Kec. Pamulang, Kota Tangerang Selatan, Banten 15417', NULL, NULL),
(4, 'Stikes', 'Jl. Pajajaran No.1, Pamulang Bar., Kec. Pamulang, Kota Tangerang Selatan, Banten 15417', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '0001_01_01_000000_create_users_table', 1),
(5, '0001_01_01_000001_create_cache_table', 1),
(6, '0001_01_01_000002_create_jobs_table', 1),
(7, '2024_12_22_072515_create_lokasi_table', 2),
(8, '2024_12_22_081847_create_lokasis_table', 3),
(9, '2024_12_22_083648_create_lokasis_table', 4),
(10, '2024_12_22_090259_create_lokasis_table', 5),
(11, '2024_12_22_093108_create_lokasis_table', 6),
(12, '2024_12_22_140223_create_lokasis_table', 7),
(14, '2024_12_22_143250_create_lokasis_table', 8),
(15, '2024_12_24_004446_update_users_table', 9),
(16, '2024_12_26_040527_create_setoran_table', 9),
(17, '2024_12_26_161109_create_laporan_kegiatan_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5eVPha3a0X233VkINWMovpCjcXaBmRwxptx2PxB7', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiSFFTcDBGbFJIaWt0Vmk3SFBmS3phN09tTFY4WVNPZUg2R2JxN2ZVcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1735486769),
('CzU0r2I5Iz7aHW2GB4ZXMeDKTo2TC4Cj2gL1lvBf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiVnZ5N0FwMjVSVHZxb0NKTmJ3bnVZbm5GRzRhbzJNbWhjV0NJcEM0aCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9teXByb2plY3QudGVzdC9sb2dpbiI7fX0=', 1735487003);

-- --------------------------------------------------------

--
-- Table structure for table `setoran`
--

CREATE TABLE `setoran` (
  `id_setoran` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_lokasi` bigint UNSIGNED NOT NULL,
  `jenis_setoran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendapatan_awal` double NOT NULL,
  `pengeluaran` double NOT NULL,
  `pendapatan_akhir` double NOT NULL,
  `pendapatan_sistem` double NOT NULL,
  `selisih_setoran` double NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `tanggal_transaksi` datetime NOT NULL,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setoran`
--

INSERT INTO `setoran` (`id_setoran`, `id_user`, `id_lokasi`, `jenis_setoran`, `shift`, `pendapatan_awal`, `pengeluaran`, `pendapatan_akhir`, `pendapatan_sistem`, `selisih_setoran`, `keterangan`, `tanggal_transaksi`, `nomor_hp`, `created_at`, `updated_at`) VALUES
(4, 9, 3, 'Parkir', 'Shift 1', 400000, 60000, 340000, 330000, 70000, 'Uang Harian Petugas Rp.30.000 + Security Rp.30.000', '2024-12-26 16:09:00', '081314991404', '2024-12-26 02:09:31', '2024-12-28 02:00:47'),
(6, 8, 2, 'Parkir', 'Shift 1', 532000, 201000, 331000, 550000, -18000, 'uang harian petugas dan security Rp.60.0000', '2024-12-27 01:11:00', '081457922287', '2024-12-26 11:11:49', '2024-12-26 11:12:30'),
(7, 8, 3, 'Parkir', 'Shift 1', 1000000, 50000, 950000, 1000000, 0, 'Uang bensin ambulan', '2024-12-29 13:57:00', '081314778921', '2024-12-28 23:58:06', '2024-12-28 23:58:37'),
(9, 3, 4, 'Parkir', 'Shift 2', 778000, 31000, 747000, 31000, 747000, 'Uang bensin ambulan', '2024-12-30 14:36:00', '081314778921', '2024-12-29 00:36:41', '2024-12-29 00:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','pengawas','petugas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_lokasi` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `fullname`, `email`, `email_verified_at`, `password`, `role`, `foto`, `nomor_hp`, `is_active`, `remember_token`, `created_at`, `updated_at`, `id_lokasi`) VALUES
(1, 'Mas Desta', 'Desta Dwi Hartanto', 'admin@gmail.com', NULL, '$2y$12$8ExArq5JTuPKNRm9fTIOCuSxvk8Evd/OVbR4coGWWdY/1d2yDw6CG', 'admin', NULL, '081467827742', 0, NULL, '2024-11-29 06:46:43', '2024-12-25 22:15:48', 1),
(2, 'Mas Pran', 'Pranoto', 'pengawas@gmail.com', NULL, '$2y$12$ytQIrusx.3uVyk6hIjOWuON/SOIKIvRrwUTjaK1FqpwhoRcB/2vLS', 'pengawas', NULL, '081726586371', 0, NULL, '2024-11-29 06:46:54', '2024-12-24 07:03:01', 2),
(3, 'Anik', 'Muhammad Anik Baehaqi', 'petugas@gmail.com', NULL, '$2y$12$iq9PwUvnfUm7ghLiQn4WeOV7jmvupb6Tf.24zkPQ7WNsAAoSlXi0q', 'petugas', NULL, '081929371167', 0, NULL, '2024-11-29 06:47:07', '2024-12-24 07:03:57', 3),
(4, 'Petugas User', 'opal', 'irgiyo@gmail.com', NULL, '$2y$12$vmNZxeA3Vm0OUO1zIBmWRefygtmC7qgFD39k4QpgG/0eYxpFLpI3a', 'petugas', NULL, '081314991404', 0, NULL, '2024-12-23 19:56:15', '2024-12-24 06:41:08', 4),
(8, 'irgi', 'Irgi Winarno', 'irgiaja@gmail.com', NULL, '$2y$12$z8ZF1UPzmkzLwlZKsS3/nef.ei9/iqN.hkY0JbTQjClRtASXh/0SW', 'petugas', NULL, '081314991404', 0, NULL, '2024-12-25 22:16:42', '2024-12-25 22:16:42', 3),
(9, 'nia', 'Nia Ramadhani', 'nia@gmail.com', NULL, '$2y$12$OtgTgPg13ewoOtse8Xh.4OqMMlhRWoMbeyZCzGJwf1jMOTxEf5ZXG', 'petugas', NULL, '081314776782', 0, NULL, '2024-12-25 22:49:10', '2024-12-25 22:49:10', 3),
(10, 'Naufal', 'Muhammad Naufal Musthofa', 'naufal@gmail.com', NULL, '$2y$12$0XTKnRJrPy3jCkT2mjjCyOzmLnX95.IipTlxK3KW/4ORWIVeGoBLS', 'petugas', NULL, '082178445692', 0, NULL, '2024-12-29 01:05:03', '2024-12-29 01:05:03', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

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
-- Indexes for table `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD KEY `laporan_kegiatan_id_user_foreign` (`id_user`),
  ADD KEY `laporan_kegiatan_id_lokasi_foreign` (`id_lokasi`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

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
-- Indexes for table `setoran`
--
ALTER TABLE `setoran`
  ADD PRIMARY KEY (`id_setoran`),
  ADD KEY `setoran_id_user_foreign` (`id_user`),
  ADD KEY `setoran_id_lokasi_foreign` (`id_lokasi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_users_id_lokasi` (`id_lokasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  MODIFY `id_kegiatan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `setoran`
--
ALTER TABLE `setoran`
  MODIFY `id_setoran` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  ADD CONSTRAINT `laporan_kegiatan_id_lokasi_foreign` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_kegiatan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `setoran`
--
ALTER TABLE `setoran`
  ADD CONSTRAINT `setoran_id_lokasi_foreign` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`) ON DELETE CASCADE,
  ADD CONSTRAINT `setoran_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_id_lokasi` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
