-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 14, 2026 at 06:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sertif`
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
(7, '0001_01_01_000000_create_users_table', 1),
(8, '0001_01_01_000001_create_cache_table', 1),
(9, '0001_01_01_000002_create_jobs_table', 1),
(10, '2026_09_30_060906_create_skemas_table', 1),
(11, '2026_09_30_060939_create_pesertas_table', 1),
(12, '2026_10_13_032534_add_role_to_users_table', 1),
(13, '2026_10_14_051904_add_profile_columns_to_users_table', 2);

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
-- Table structure for table `pesertas`
--

CREATE TABLE `pesertas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `skema_id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_sertifikasi` enum('Kompeten','Belum Kompeten','Pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesertas`
--

INSERT INTO `pesertas` (`id`, `user_id`, `skema_id`, `nama_lengkap`, `email`, `no_hp`, `alamat`, `status_sertifikasi`, `created_at`, `updated_at`) VALUES
(4, 6, 1, 'Neiska Zia', 'nza@gmail.com', '081932670732', 'Jl. Purwanina', 'Kompeten', '2026-10-13 20:43:15', '2026-10-13 22:29:12'),
(5, 7, 3, 'Ihsan', 'ihsan@gmail.com', '085611447785', 'Jl. Edit', 'Pending', '2026-10-13 20:51:47', '2026-10-13 20:52:11'),
(6, 8, 5, 'Nouval', 'nvl@gmail.com', '08556122958', 'Jl. UKI', 'Kompeten', '2026-10-13 22:12:54', '2026-10-13 22:28:59'),
(9, 12, 2, 'Supri', 'supri@gmail.com', '087810025054', 'Jl. Kukusan', 'Belum Kompeten', '2026-10-13 22:46:44', '2026-10-13 22:46:44'),
(10, 9, 2, 'Ucup', 'cup@gmail.com', '-', '-', 'Belum Kompeten', '2026-10-13 23:08:37', '2026-10-13 23:08:37'),
(11, 13, 3, 'SADMIN', 'admin@gmail.com', '-', '-', 'Kompeten', '2026-10-13 23:08:53', '2026-10-13 23:08:53');

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
('Dyv3QQfBA2ojfxsPYxYOSYIf1nwvAiOI54SBSn76', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTEZxTzhRYWx1SHVwcjN4U1ZYOW1LNEU0czFnakVIamRXNXpYcGVqZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9za2VtYXMiO3M6NToicm91dGUiO3M6MTI6InNrZW1hcy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjU4MjY1YzhjODQzNGMyNDQ0YTdiNmIwYzcwODQyZDZiZThiMjdiMDQ3N2I4NWFjMGEyNjQ5MTA5ZWQ5N2VkNDMiO30=', 1791958140);

-- --------------------------------------------------------

--
-- Table structure for table `skemas`
--

CREATE TABLE `skemas` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_skema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_skema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_skema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skemas`
--

INSERT INTO `skemas` (`id`, `kode_skema`, `nama_skema`, `jenis_skema`, `created_at`, `updated_at`) VALUES
(1, 'SKM-001', 'Junior Web Developer', 'Klaster', '2026-10-13 19:03:57', '2026-10-13 22:35:11'),
(2, 'SKM-002', 'Data Analyst', 'Klaster', '2026-10-13 19:04:21', '2026-10-13 19:04:21'),
(3, 'SKM-003', 'IT Support', 'KKNI', '2026-10-13 19:04:31', '2026-10-13 19:04:31'),
(4, 'SKM-004', 'Network Engineer', 'Klaster', '2026-10-13 19:18:14', '2026-10-13 19:18:14'),
(5, 'SKM-005', 'Cloud Consultant', 'Okupasi', '2026-10-13 19:20:46', '2026-10-13 19:20:46'),
(6, 'SKM-006', 'System Analyst', 'Klaster', '2026-10-13 19:21:23', '2026-10-13 19:21:23'),
(7, 'SKM-007', 'System Designer', 'Okupasi', '2026-10-13 19:23:25', '2026-10-13 19:23:25'),
(8, 'SKM-008', 'Java Developer', 'Klaster', '2026-10-13 19:24:45', '2026-10-13 19:29:31'),
(9, 'SKM-009', 'Fullstack Developer', 'Klaster', '2026-10-13 19:25:19', '2026-10-13 19:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `skema_id` bigint UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `no_hp`, `alamat`, `skema_id`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'adm@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$G.E8mvU9v7nToz3M1cD1EucmKLYBfTmQfoS1sci/wOgMn88NPKTye', 'admin', NULL, '2026-10-13 19:02:01', '2026-10-13 19:02:01'),
(2, 'Test User', 'test@example.com', NULL, NULL, NULL, '2026-10-13 19:02:01', '$2y$12$8HEMCKeBZgRrU0H2DGf32OnZK070TtnGWTbkLaCggjQ50.wq2cL2K', 'user', 'GHEEHj8AMP', '2026-10-13 19:02:01', '2026-10-13 19:02:01'),
(6, 'Neiska Zia', 'nza@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$whDpe8HnQJcGRzVjRjmouuqc2gaGf.m4spYt2.lzWkRqJAnRM0Dfe', 'user', NULL, '2026-10-13 20:42:34', '2026-10-13 20:42:34'),
(7, 'Ihsan', 'ihsan@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$QZRMF/7oaFrIXf4FQ2pH0eyDHdtpCf1frBq4TY4KQ5zGM72X0GoB.', 'user', NULL, '2026-10-13 20:46:48', '2026-10-13 20:46:48'),
(8, 'Nouval', 'nvl@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$3lnyWfFXd2IasX/NRdnf/uWjb5qNFJtxux3eFMRDWAwTwPXDQP.0m', 'user', NULL, '2026-10-13 22:12:12', '2026-10-13 22:12:12'),
(9, 'Ucup', 'cup@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$dp/i5.1r26KuaVwwSVtjtupWHzWYji3Xa9cTBfu70idD2bvTTJDva', 'user', NULL, '2026-10-13 22:20:43', '2026-10-13 22:20:43'),
(10, 'Iis', 'iis@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$ORtm3eu5F9D41g3deU7Ube2.5wv0ke9X7kfCGYe8ObVYIlAmGXaGa', 'user', NULL, '2026-10-13 22:27:51', '2026-10-13 22:27:51'),
(11, 'Budi', 'bud@gmail.com', '087810025036', 'Cluster Jaya', 2, NULL, '$2y$12$0cHvJfzpGtcnVrPQH7by/O83pen062IlaRAGMLBHchfpfDiAO6Tf2', 'user', NULL, '2026-10-13 22:37:37', '2026-10-13 22:42:30'),
(12, 'Supri', 'supri@gmail.com', '087810025054', 'Jl. Kukusan', 3, NULL, '$2y$12$6hPE2m920ICbLT26WTbzT.GQsX0ViP5S9daAQihHrC68Tbtx2gboG', 'user', NULL, '2026-10-13 22:45:22', '2026-10-13 22:45:44'),
(13, 'SADMIN', 'admin@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$333eTIVvUoYgMHs1WYO6m.qo7SzUhy735tbpe9xkvrIY7klzr9zhW', 'user', NULL, '2026-10-13 23:07:40', '2026-10-13 23:07:40');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `pesertas`
--
ALTER TABLE `pesertas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pesertas_email_unique` (`email`),
  ADD KEY `pesertas_user_id_foreign` (`user_id`),
  ADD KEY `pesertas_skema_id_foreign` (`skema_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `skemas`
--
ALTER TABLE `skemas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skemas_kode_skema_unique` (`kode_skema`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pesertas`
--
ALTER TABLE `pesertas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `skemas`
--
ALTER TABLE `skemas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesertas`
--
ALTER TABLE `pesertas`
  ADD CONSTRAINT `pesertas_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesertas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
