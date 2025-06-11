-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2025 at 12:37 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujilevel-cateringkita`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_profiles`
--

CREATE TABLE `admin_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('banuserz@gmail.com|127.0.0.1', 'i:1;', 1749444987),
('banuserz@gmail.com|127.0.0.1:timer', 'i:1749444987;', 1749444987),
('ran@gmail.com|127.0.0.1', 'i:1;', 1749444719),
('ran@gmail.com|127.0.0.1:timer', 'i:1749444719;', 1749444719);

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
-- Table structure for table `caterings`
--

CREATE TABLE `caterings` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `check_outs`
--

CREATE TABLE `check_outs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_time` time NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_pesanans`
--

CREATE TABLE `daftar_pesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `kategori_pesanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelola_makanan_id` bigint UNSIGNED DEFAULT NULL,
  `tanggal_pesanan` datetime NOT NULL,
  `jumlah_pesanan` int NOT NULL,
  `tanggal_pengiriman` date NOT NULL,
  `waktu_pengiriman` time NOT NULL,
  `lokasi_pengiriman` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci,
  `opsi_pengiriman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status_pengiriman` enum('diproses','dikirim','diterima','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pembayaran` enum('pending','paid','failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan_pembatalan` text COLLATE utf8mb4_unicode_ci COMMENT 'Alasan pembatalan pesanan (dari admin atau user)',
  `cancelled_at` timestamp NULL DEFAULT NULL COMMENT 'Tanggal dan waktu pembatalan',
  `cancelled_by` bigint UNSIGNED DEFAULT NULL COMMENT 'ID user yang membatalkan (admin atau user)',
  `cancelled_by_type` enum('admin','user') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Jenis pembatal: admin atau user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_pesanans`
--

INSERT INTO `daftar_pesanans` (`id`, `order_id`, `nama_pelanggan`, `user_id`, `kategori_pesanan`, `kelola_makanan_id`, `tanggal_pesanan`, `jumlah_pesanan`, `tanggal_pengiriman`, `waktu_pengiriman`, `lokasi_pengiriman`, `nomor_telepon`, `pesan`, `opsi_pengiriman`, `total_harga`, `status_pengiriman`, `status_pembayaran`, `catatan_pembatalan`, `cancelled_at`, `cancelled_by`, `cancelled_by_type`, `created_at`, `updated_at`) VALUES
(129, 'ORD1749409424000951', 'ban user', 8, 'Lainnya', 2, '2025-06-08 00:00:00', 2, '2025-06-10', '12:03:00', 'kljblvdf', '087652552114', NULL, 'regular', 23000.00, 'diproses', 'pending', NULL, NULL, NULL, NULL, '2025-06-08 12:03:50', '2025-06-08 12:03:50'),
(130, 'ORD1749409775122193', 'ban user', 8, 'Lainnya', 2, '2025-06-08 00:00:00', 2, '2025-06-25', '10:08:00', 'Ciomas Lorem Ipsum Dolor Sit Amet', '0895494994999', NULL, 'instant', 28000.00, 'diproses', 'pending', NULL, NULL, NULL, NULL, '2025-06-08 12:09:41', '2025-06-08 12:09:41'),
(131, 'ORD1749466068236196', 'ban user', 8, 'Lainnya', 2, '2025-06-09 00:00:00', 2, '2025-06-10', '12:00:00', 'Alamat', '089539298232', NULL, 'instant', 28000.00, 'diproses', 'pending', NULL, NULL, NULL, NULL, '2025-06-09 03:48:16', '2025-06-09 03:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `detail_acaras`
--

CREATE TABLE `detail_acaras` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `formulir_pesanans`
--

CREATE TABLE `formulir_pesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bergabung` date NOT NULL,
  `status` enum('Aktif','Cuti','Nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keahlian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama_karyawan`, `username_karyawan`, `posisi`, `kontak`, `tanggal_bergabung`, `status`, `keahlian`, `created_at`, `updated_at`) VALUES
(1, 'wildan', 'wildansyah23', 'office boy', '08981323242321', '2025-04-02', 'Cuti', 'membersihkan ruangan dengan cepat', '2025-04-27 09:01:59', '2025-04-29 02:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_item` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `deskripsi`, `jumlah_item`, `created_at`, `updated_at`) VALUES
(3, 'Prasmanan', 'Hidangan lengkap dengan berbagai prasmanan untuk berbagai acara', 9, '2025-04-29 02:14:45', '2025-04-29 02:14:45'),
(4, 'Nasi Box', 'Paket nasi lengkap dalam kotak untuk berbagai praktis', 6, '2025-04-29 02:15:15', '2025-04-29 02:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `kelola_makanans`
--

CREATE TABLE `kelola_makanans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_makanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelola_makanans`
--

INSERT INTO `kelola_makanans` (`id`, `nama_makanan`, `kategori`, `harga`, `status`, `deskripsi`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Ayam Geprek', 'Prasmanan', 12000.00, 'Tersedia', 'Nikmati sensasi pedas dan gurih dari Ayam Geprek Sambal Bawang, perpaduan ayam crispy yang digeprek dengan sambal bawang khas, memberikan cita rasa pedas yang menggoda. Disajikan dengan nasi putih hangat dan irisan mentimun segar, menjadikannya pilihan sempurna untuk pecinta makanan pedas.', 'images/QuNFuVTrGfbONw3sKrv2yIMhGsFy8UzJbnjMohDr.jpg', '2025-04-29 11:24:44', '2025-06-07 10:41:16'),
(2, 'Ayam Kecap', 'Prasmanan', 9000.00, 'Tersedia', 'Lezatnya Ayam Kecap Spesial, ayam empuk yang dimasak dengan saus kecap khas, menciptakan cita rasa manis, gurih, dan kaya rempah. Potongan ayam yang meresap sempurna dalam bumbu kecap ini siap menemani santapanmu dengan nasi putih hangat.', 'images/I8NovMGPK8rmTEZpZ0zgkkU1n7j9jSyJ4wM9CyPb.jpg', '2025-04-29 11:27:12', '2025-06-07 10:41:34'),
(3, 'Ikan Bunjaer Gulai', 'Prasmanan', 15000.00, 'Tersedia', 'Nikmati kelezatan Gulai Ikan Bunjair, perpaduan ikan segar dengan kuah kuning khas yang kaya rempah. Ditambah dengan potongan nanas yang memberikan sensasi segar dan sedikit asam, menciptakan rasa yang unik dan menggugah selera. Cocok disantap dengan nasi putih hangat untuk pengalaman kuliner yang lebih sempurna.', 'images/K2BTa56LW7Bf4tmq6vaOqe9jBI5qzMrDAKG6L6TH.png', '2025-04-29 11:28:06', '2025-06-07 10:41:52'),
(4, 'Cumi Balado', 'Prasmanan', 12000.00, 'Tersedia', 'Rasakan sensasi pedas dan gurih dari Cumi Sambal Balado, hidangan khas dengan cumi segar yang dimasak dengan sambal balado merah menggugah selera. Perpaduan rasa pedas, manis, dan gurih membuat hidangan ini cocok dinikmati dengan nasi putih hangat.', 'images/l0u6VcF2fJThxM3rzFxUuII08hFEDAoUZPSoKq44.png', '2025-04-29 11:28:51', '2025-06-07 10:42:03'),
(5, 'Ikan Bunjaer Goreng', 'Prasmanan', 10000.00, 'Tersedia', 'Nikmati kelezatan Ikan  Bunjaer Goreng, ikan segar yang digoreng hingga keemasan dengan tekstur luar yang renyah dan daging yang lembut di dalam. Disajikan dengan irisan tomat, daun selada, dan jeruk nipis untuk menambah kesegaran rasa. Cocok disantap dengan nasi putih hangat dan sambal favoritmu!', 'images/k1uqDKhnqjuV72KgLaD5QjbRHlXPHOxBLwvmOZMp.jpg', '2025-04-29 11:30:11', '2025-06-07 10:42:16'),
(6, 'Kentang Balado', 'Prasmanan', 5000.00, 'Tersedia', 'Kombinasi sempurna dari Kentang Balado, hidangan khas dengan kentang yang dipotong dadu dan digoreng hingga renyah, dipadukan dengan teri goreng yang gurih, serta dibalut dalam sambal merah pedas manis yang menggugah selera. Cocok sebagai lauk pendamping atau camilan pedas favorit!', 'images/1e8okEP9e0VTGuGmQqHZW0668Ik23RzNa2lr7Kzo.png', '2025-04-29 11:31:16', '2025-06-07 10:42:30'),
(7, 'Tempe Orek', 'Prasmanan', 5000.00, 'Tersedia', 'Gurih dan manisnya Tempe Orek Kering, hidangan tradisional yang dibuat dari tempe yang dipotong tipis dan digoreng hingga renyah, kemudian dimasak dengan bumbu kecap manis, cabai merah, dan daun jeruk yang memberikan aroma khas. Cocok sebagai lauk pendamping atau camilan gurih yang nikmat!', 'images/3CDvFkSGZ72djOvEkvPV2SOVVZAoEuIbID6bpIzj.png', '2025-04-29 11:32:04', '2025-06-07 10:42:42'),
(8, 'Ayam Goreng', 'Prasmanan', 8000.00, 'Tersedia', 'Nikmati kelezatan Ayam Goreng , ayam pilihan yang dimarinasi dengan bumbu khas, kemudian digoreng hingga kulitnya renyah dengan daging yang tetap juicy. Aroma rempah yang kuat membuat hidangan ini semakin menggugah selera. Cocok disantap dengan nasi hangat dan sambal favorit!', 'images/CwkJjn1GElEdnT7r5MylwfxdWxDx3xq6pEWVlVMW.png', '2025-04-29 11:32:44', '2025-06-07 10:42:52'),
(9, 'Telur Balado', 'Prasmanan', 5000.00, 'Tersedia', 'Pedas, gurih, dan nikmat! Telur Balado adalah hidangan khas Nusantara yang terbuat dari telur rebus yang digoreng sebentar untuk tekstur yang lebih lezat, lalu dibalut dengan sambal balado yang kaya rasa. Perpaduan sempurna antara pedas, manis, dan sedikit asam dari cabai merah segar membuat hidangan ini cocok sebagai lauk utama atau pelengkap makanan favoritmu!', 'images/QDFyy1fp2NFFjnYfcaVUE66Y156VVbBa1OewepKx.jpg', '2025-04-29 11:33:26', '2025-06-07 10:43:06'),
(10, 'Capcay Goreng', 'Prasmanan', 9000.00, 'Tersedia', 'Sehat, segar, dan penuh gizi! Capcay Goreng adalah hidangan khas oriental yang berisi beragam sayuran segar yang ditumis dengan bumbu gurih khas. Dilengkapi dengan bakso dan jamur untuk menambah cita rasa yang lezat dan tekstur yang kaya. Cocok untuk dinikmati sendiri atau sebagai pendamping menu favoritmu!', 'images/wbdMDxVI4NGjD785zXKb1Cw48x7nmv72N6F5k5oy.png', '2025-04-29 11:33:59', '2025-06-07 10:43:20'),
(11, 'Bihun Goreng', 'Prasmanan', 9000.00, 'Tersedia', 'Nikmati kelezatan Bihun Goreng Spesial, bihun yang ditumis dengan bumbu gurih khas dan dipadukan dengan berbagai bahan pilihan. Teksturnya yang lembut berpadu sempurna dengan rasa yang kaya, menciptakan sajian yang menggugah selera!', 'images/aOiupsjnus3UzkHTjWGoq7KcmwAIP4cWoj7ejBks.png', '2025-04-29 11:34:32', '2025-06-07 10:43:32'),
(13, 'Paket Nasi Ayam Bakar Spesial', 'Nasi Box', 35000.00, 'Tersedia', 'Nikmati hidangan lezat dengan kombinasi sempurna antara nasi hangat berbumbu, ayam bakar yang empuk dengan cita rasa gurih dan sedikit manis, serta pelengkap yang menyegarkan!', 'images/sQDynhwRL8f6ezZBAF6FtlbsnpQCjIjml6FADyMW.png', '2025-04-29 11:46:55', '2025-06-07 10:43:50'),
(14, 'Paket Nasi Kuning Ayam Spesial', 'Nasi Box', 35000.00, 'Tersedia', 'Nikmati hidangan spesial dengan perpaduan sempurna antara nasi kuning gurih dan lauk pendamping yang menggugah selera. Sajian lezat ini menghadirkan cita rasa autentik khas Indonesia!', 'images/YMsZuWXc5Kx2Qi0GHNiN4Y0FlqRUpcinEMhqNjYc.png', '2025-04-29 11:47:57', '2025-06-07 10:44:03'),
(15, 'Paket Nasi Ayam & Rendang Spesial', 'Nasi Box', 30000.00, 'Tersedia', 'Nikmati perpaduan sempurna antara ayam goreng kremes yang gurih dan rendang daging sapi yang kaya rempah. Disajikan dengan nasi putih pulen dan aneka lauk pendamping yang menggugah selera, hidangan ini menghadirkan cita rasa autentik khas Nusantara!', 'images/6LTc6xlmBmACuuWLy8j8QVrAGljTTpUcAiARRNVi.png', '2025-04-29 11:48:57', '2025-06-07 10:44:17'),
(16, 'Paket Nasi Ikan Premium', 'Nasi Box', 35000.00, 'Tersedia', 'Nikmati sensasi gurih dan pedas dari Ikan Bakar Sambal Pedas, sajian lezat dengan ikan bakar yang dipanggang sempurna dan dilumuri sambal khas yang menggugah selera. Dilengkapi dengan nasi putih hangat, tahu dan tempe goreng, lalapan segar, serta sambal tambahan, menciptakan perpaduan rasa yang nikmat di setiap suapan.', 'images/QugIgJjGVCqGNvCJhHo9mkUl5nfG53xJb1L4NRs9.png', '2025-04-29 11:49:34', '2025-06-07 10:44:30'),
(17, 'Paket Nasi Kotak Spesial', 'Nasi Box', 30000.00, 'Tersedia', 'Nikmati hidangan lezat dengan kombinasi sempurna antara nasi hangat berbumbu, ayam bakar yang empuk dengan cita rasa gurih dan sedikit manis, serta pelengkap yang menyegarkan!', 'images/DoGAb3JTaFYxrpFrD7GOFSBEAYra52I82oo8wX5f.png', '2025-04-29 11:50:40', '2025-06-07 10:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `keranjangs`
--

CREATE TABLE `keranjangs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keranjangs`
--

INSERT INTO `keranjangs` (`id`, `user_id`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3548000.00, 'active', '2025-04-27 08:40:57', '2025-05-27 01:12:04'),
(2, 2, 25000.00, 'active', '2025-04-27 21:11:21', '2025-04-29 17:35:32'),
(3, 3, 1296000.00, 'active', '2025-04-29 17:49:47', '2025-04-29 17:50:00'),
(4, 4, 81000.00, 'active', '2025-04-29 21:06:35', '2025-05-29 23:27:52'),
(5, 8, 0.00, 'active', '2025-06-03 09:24:52', '2025-06-09 06:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_items`
--

CREATE TABLE `keranjang_items` (
  `id` bigint UNSIGNED NOT NULL,
  `keranjang_id` bigint UNSIGNED NOT NULL,
  `kelola_makanan_id` bigint UNSIGNED DEFAULT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keranjang_items`
--

INSERT INTO `keranjang_items` (`id`, `keranjang_id`, `kelola_makanan_id`, `nama_produk`, `price`, `quantity`, `image`, `created_at`, `updated_at`) VALUES
(4, 2, NULL, 'Paket Nasi Kotak Premium A', 25000.00, 1, 'http://127.0.0.1:8000/assets/paketassets1.png', '2025-04-27 21:11:21', '2025-04-27 21:11:21'),
(14, 3, NULL, 'Ayam Geprek', 12000.00, 108, '/storage/images/F4pQodn3T2Bb97IfMWbj2NzU9SwKHdzwMOTJkIVP.jpg', '2025-04-29 17:49:47', '2025-04-29 17:49:59'),
(16, 1, NULL, 'Paket Nasi Ayam Bakar Spesial', 35000.00, 100, '/storage/images/htSf1ctWYeXUkNcD9099YhrttUatFJO0I9knpLWk.png', '2025-05-01 22:26:31', '2025-05-01 22:26:31'),
(17, 1, NULL, 'Ayam Geprek', 12000.00, 4, '/storage/images/5fSVaTecLpJTXCwjZqPkyRLLm1Sbd2lCuM4n8QzM.png', '2025-05-02 00:22:16', '2025-05-27 01:12:04'),
(18, 4, NULL, 'Ayam Kecap', 9000.00, 9, '/storage/images/2U1Gn90AgLNdcljVLgqGjq5xfrZSGNLK4BzrTHqU.jpg', '2025-05-26 00:44:23', '2025-05-28 00:34:18'),
(32, 5, 1, 'Ayam Geprek', 12000.00, 1, '/storage/images/QuNFuVTrGfbONw3sKrv2yIMhGsFy8UzJbnjMohDr.jpg', '2025-06-10 17:29:58', '2025-06-10 17:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_pesanans`
--

CREATE TABLE `konfirmasi_pesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporans`
--

CREATE TABLE `laporans` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporans`
--

INSERT INTO `laporans` (`id`, `tanggal`, `jenis_laporan`, `laporan`, `deskripsi`, `total`, `admin`, `status`, `created_at`, `updated_at`) VALUES
(1, '2025-04-29', 'Harian', 'Pendapatan Harian', 'Pendapatan dari pesanan catering', 0.00, 'admin cateringkita', 'males', '2025-04-28 22:33:08', '2025-04-29 02:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_prasmanans`
--

CREATE TABLE `menu_prasmanans` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayarans`
--

CREATE TABLE `metode_pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `status` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metode_pembayarans`
--

INSERT INTO `metode_pembayarans` (`id`, `metode_pembayaran`, `deskripsi`, `status`, `admin`, `created_at`, `updated_at`) VALUES
(3, 'BCA', 'Pembayaran via Transfer Bank', 'Aktif', 'Admin 1', '2025-04-29 02:32:44', '2025-04-29 02:32:44'),
(4, 'Dana', 'Pembayaran via E-wallet', 'Aktif', 'admin 1', '2025-04-29 02:33:15', '2025-04-29 02:33:15'),
(5, 'Gopay', 'Pembayaran via Gopay', 'Aktif', 'admin 1', '2025-04-29 02:33:39', '2025-04-29 02:33:39'),
(6, 'COD', 'Pembayaran dilakukan di tempat saat pesanan diterima(wajib membayar dp 35% saat memesan)', 'Aktif', 'admin 1', '2025-04-29 02:34:25', '2025-04-29 02:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran_users`
--

CREATE TABLE `metode_pembayaran_users` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_03_10_000000_create_profiles_table', 1),
(5, '2025_01_13_172729_create_products_table', 1),
(6, '2025_01_13_180436_create_kelola_makanans_table', 1),
(7, '2025_01_14_062503_create_stok_bahans_table', 1),
(8, '2025_01_15_174637_create_daftar_pesanans_table', 1),
(9, '2025_01_15_180740_create_laporans_table', 1),
(10, '2025_01_22_015651_create_metode_pembayarans_table', 1),
(11, '2025_02_13_020333_create_caterings_table', 1),
(12, '2025_02_13_020914_create_pesanans_table', 1),
(13, '2025_02_13_021514_create_contacts_table', 1),
(14, '2025_02_13_022217_create_menu_prasmanans_table', 1),
(15, '2025_02_13_022849_create_menu_nasi_boxes_table', 1),
(16, '2025_02_13_054143_create_keranjangs_table', 1),
(17, '2025_02_14_022536_create_status_pembayarans_table', 1),
(18, '2025_02_18_024754_create_abouts_table', 1),
(19, '2025_02_18_033135_create_formulir_pesanans_table', 1),
(20, '2025_02_18_033802_create_detail_acaras_table', 1),
(21, '2025_02_18_035502_create_konfirmasi_pesanans_table', 1),
(22, '2025_02_18_061653_create_check_outs_table', 1),
(23, '2025_02_19_053407_create_metode_pembayaran_users_table', 1),
(24, '2025_02_26_053746_create_status_pengirimen_table', 1),
(25, '2025_02_26_085650_create_orders_table', 1),
(26, '2025_02_26_140408_create_penilaians_table', 1),
(27, '2025_03_10_030200_add_profile_fields_to_users_table', 1),
(28, '2025_03_10_051825_create_registers_table', 1),
(29, '2025_03_24_050746_create_payments_table', 1),
(30, '2025_04_19_071120_create_tentang_kamis_table', 1),
(31, '2025_04_19_075136_create_kategoris_table', 1),
(32, '2025_04_19_084830_create_keranjang_items_table', 1),
(33, '2025_04_26_171658_create_notification_admins_table', 1),
(34, '2025_04_26_191457_transaksi', 1),
(35, '2025_04_28_044940_create_karyawans_table', 1),
(36, '2025_04_28_090707_create_admin_profiles_table', 1),
(37, '2025_04_29_095452_create_notifications_table', 1),
(38, '2025_06_07_053631_reviews', 1),
(44, '2025_04_28_090707_create_admin_profiles_table', 14),
(47, '2025_01_15_174637_create_daftar_pesanans_table', 15),
(48, '2025_01_15_180740_create_laporans_table', 16),
(49, '2025_02_26_140408_create_penilaians_table', 17),
(50, '2025_04_29_095452_create_notifications_table', 18),
(54, '2025_02_26_085650_create_orders_table', 19),
(55, '2025_06_05_072117_create_reviews_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info',
  `icon_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bell',
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `type`, `icon_type`, `order_id`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(13, 8, 'Pesanan baru', 'Pesanan #ORD1749466068236196 sedang dalam Proses', 'order', 'box', 131, 0, NULL, '2025-06-09 03:48:16', '2025-06-09 03:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `notification_admins`
--

CREATE TABLE `notification_admins` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `data` json DEFAULT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `shipping_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proof_of_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilaians`
--

CREATE TABLE `penilaians` (
  `id` bigint UNSIGNED NOT NULL,
  `pesanan_id` bigint UNSIGNED NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanans`
--

CREATE TABLE `pesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rasa` enum('manis','gurih','pedas','pedas manis') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `harga` decimal(10,2) NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `phone`, `address`, `bio`, `created_at`, `updated_at`) VALUES
(1, 1, 'budi', 'sosial', '0881011562638', 'ciomas bogor kota', 'hello guys', '2025-04-27 08:40:19', '2025-04-28 09:27:16'),
(2, 2, 'user', 'catering', '0881011562638', 'ciomas bogor kota', NULL, '2025-04-27 21:10:52', '2025-04-29 07:52:23'),
(3, 3, 'budi', 'user', '0881011562638', 'ciomas bogor kota', NULL, '2025-04-29 17:49:23', '2025-04-29 17:49:23'),
(4, 4, 'anton', 'pratama', '08988049488', 'ciomas bogor kota', NULL, '2025-04-29 20:11:08', '2025-04-29 20:11:08'),
(5, 5, 'anton', 'manatap', '0881011562638', 'ciomas bogor', NULL, '2025-04-29 21:02:39', '2025-04-29 21:02:39'),
(6, 6, 'admin', 'admina', '0881011562638', 'adakdakdmad', NULL, '2025-05-27 07:02:59', '2025-05-27 07:02:59'),
(7, 7, 'Gibran', 'Tes', '0895392982328', 'Di daerah bogor raya', NULL, '2025-06-03 09:20:51', '2025-06-03 09:20:51'),
(8, 8, 'dan', 'user', '0895387455678', 'fsdaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', NULL, '2025-06-03 09:23:20', '2025-06-03 09:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `registers`
--

CREATE TABLE `registers` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quality_rating` tinyint UNSIGNED NOT NULL COMMENT 'Rating kualitas produk (1-5)',
  `delivery_rating` tinyint UNSIGNED NOT NULL COMMENT 'Rating kecepatan pengiriman (1-5)',
  `service_rating` tinyint UNSIGNED NOT NULL COMMENT 'Rating pelayanan (1-5)',
  `average_rating` decimal(2,1) NOT NULL COMMENT 'Rating rata-rata',
  `review_text` text COLLATE utf8mb4_unicode_ci COMMENT 'Ulasan tekstual (maksimal 500 karakter)',
  `photos` json DEFAULT NULL COMMENT 'Array path foto review',
  `status` enum('active','hidden','reported') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Apakah review sudah diverifikasi admin',
  `reviewed_at` timestamp NULL DEFAULT NULL COMMENT 'Waktu review dibuat',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
('60NcIHepaGW4dfR4HigfZtOlBjvtOve5HELoj5aC', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoia0tKNHJtOEVTWmxhUXdubHkxbVJmM09tdHFQRXpkajM1VTVxUUJRYyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL25vdGlmaWNhdGlvbnMvY291bnQiO319', 1749602201),
('m2zplyFd27kHFzDvThQayx4c9GO9DXYP3HnqfTWD', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiT0toQXAxYWJtQXpwWFVNSXNhcGc3amZIN3JPQ2U2TlNneEtVSjNHZSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ub3RpZmljYXRpb25zL2NvdW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1749482359);

-- --------------------------------------------------------

--
-- Table structure for table `status_pembayarans`
--

CREATE TABLE `status_pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_pembeli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `status_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_pengirimen`
--

CREATE TABLE `status_pengirimen` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_pembeli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `status_pengiriman` enum('Dikirim','Selesai','Batal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_pengirimen`
--

INSERT INTO `status_pengirimen` (`id`, `nama_pembeli`, `nama_produk`, `tanggal_transaksi`, `status_pengiriman`, `created_at`, `updated_at`) VALUES
(1, 'wabak', 'ayam', '2025-04-28', 'Dikirim', '2025-04-27 21:04:11', '2025-04-27 21:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `stok_bahans`
--

CREATE TABLE `stok_bahans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_bahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_tersedia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_ditambahkan` date NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `status` enum('tersedia','kosong') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tentang_kamis`
--

CREATE TABLE `tentang_kamis` (
  `id` bigint UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tentang_kamis`
--

INSERT INTO `tentang_kamis` (`id`, `foto`, `deskripsi`, `created_at`, `updated_at`) VALUES
(4, 'tentangkami/zSl3A9yWQxc00b3nbcyu0F64kLMDGSv1uPU0UxVp.png', 'Catering Nikmat Rasa menyediakan nasi box dan snack box untuk berbagai acara seperti ulang tahun, arisan, syukuran, hingga acara kantor. Menu utama kami mencakup nasi bakar, nasi liwet, nasi ayam geprek, nasi kebuli, nasi tumpeng, dan banyak lagi, lengkap dengan sayur dan sambal khas. Dengan pengalaman lebih dari 10 tahun melayani area Jabodetabek, kami siap menerima pesanan besar maupun kecil dengan rasa lezat, porsi pas, dan harga terjangkau. Hubungi kami sekarang untuk hidangan terbaik di acara Anda!', '2025-05-29 08:02:06', '2025-06-07 10:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_admin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `id_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_tindakan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_tindakan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `status_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `nama_admin`, `nama_pelanggan`, `tanggal_transaksi`, `id_transaksi`, `jenis_tindakan`, `deskripsi_tindakan`, `total_harga`, `status_transaksi`, `bukti_pembayaran`, `created_at`, `updated_at`) VALUES
(123, 'System', 'admin cateringkita', '2025-05-02 05:27:12', 'BCA-1746163632', 'Pembayaran BCA', 'Pembayaran via BCA', 3510000.00, 'Menunggu Konfirmasi', 'payment_proofs/7LESLU2YAkMA2EvvPYHRbQtjdZDeRSVDXTdAq7j8.jpg', '2025-05-01 22:27:12', '2025-05-01 22:27:12'),
(124, 'System', 'admin cateringkita', '2025-05-02 07:12:07', 'BCA-1746169927', 'Pembayaran BCA', 'Pembayaran via BCA', 3510000.00, 'Menunggu Konfirmasi', 'payment_proofs/bnQTOcAnSdnmvRfnrMNmOilv3r4MgmsWbSJ3lWUU.png', '2025-05-02 00:12:07', '2025-05-02 00:12:07'),
(125, 'System', 'admin cateringkita', '2025-05-05 04:51:03', 'BCA-1746420663', 'Pembayaran BCA', 'Pembayaran via BCA', 3522000.00, 'Menunggu Konfirmasi', 'payment_proofs/ZOUw2diwHUP2gNRRwuSfTdYYONUpK7v5Ck3rzI2u.png', '2025-05-04 21:51:03', '2025-05-04 21:51:03'),
(126, 'System', 'admin cateringkita', '2025-05-27 04:35:43', 'BCA-1748320543', 'Pembayaran BCA', 'Pembayaran via BCA', 3534000.00, 'Menunggu Konfirmasi', 'payment_proofs/xNtoVSPeHVU2f6jmhH1dAoIQHdVMGm6ctQtq22vR.png', '2025-05-26 21:35:43', '2025-05-26 21:35:43'),
(127, 'System', 'ban user', '2025-06-03 17:20:53', 'DANA-1748971253', 'Pembayaran DANA', 'Pembayaran via DANA', 22000.00, 'Menunggu Konfirmasi', 'payment_proofs/vIh81Xuc3gVutezaeXKDVRVmcq6EgO0vA99TPduM.png', '2025-06-03 10:20:53', '2025-06-03 10:20:53'),
(128, 'System', 'ban user', '2025-06-04 09:15:33', 'BCA-1749028533', 'Pembayaran BCA', 'Pembayaran via BCA', 22000.00, 'Menunggu Konfirmasi', 'payment_proofs/GQhqaWp5tPTsHYRMMaYh12697ffGKSXB9ohVVBUJ.png', '2025-06-04 02:15:33', '2025-06-04 02:15:33'),
(129, 'System', 'ban user', '2025-06-04 10:37:30', 'GOPAY-1749033450', 'Pembayaran GOPAY', 'Pembayaran via GOPAY', 24000.00, 'Menunggu Konfirmasi', 'payment_proofs/IGNO6mm7zUR0UW300DFD7H2Fj7NSlJrU8cW9kSpI.png', '2025-06-04 03:37:30', '2025-06-04 03:37:30'),
(130, 'System', 'ban user', '2025-06-04 15:32:04', 'DANA-1749051124', 'Pembayaran DANA', 'Pembayaran via DANA', 24000.00, 'Menunggu Konfirmasi', 'payment_proofs/eTgq47LH7mZMGaYhweV178kuEppTB0DyK6mVl5FX.png', '2025-06-04 08:32:04', '2025-06-04 08:32:04'),
(131, 'System', 'ban user', '2025-06-04 16:00:27', 'BCA-1749052827', 'Pembayaran BCA', 'Pembayaran via BCA', 24000.00, 'Menunggu Konfirmasi', 'payment_proofs/mP5gFmNObxSsNhhDAHSFdQYH4PsBCgsVKFvQDkdK.png', '2025-06-04 09:00:27', '2025-06-04 09:00:27'),
(132, 'System', 'ban user', '2025-06-04 16:18:25', 'BCA-1749053905', 'Pembayaran BCA', 'Pembayaran via BCA', 24000.00, 'Menunggu Konfirmasi', 'payment_proofs/vES3U06ONAJEFJy30oSkEkqajlcPLsRSyaPoxOUT.png', '2025-06-04 09:18:25', '2025-06-04 09:18:25'),
(133, 'System', 'ban user', '2025-06-05 16:42:05', 'DANA-1749141725', 'Pembayaran DANA', 'Pembayaran via DANA', 24000.00, 'Menunggu Konfirmasi', 'payment_proofs/tq9CCHWWGwzGOwr0YGAHJQFtSHDJPcxIDIvqTx6d.png', '2025-06-05 09:42:05', '2025-06-05 09:42:05'),
(134, 'System', 'ban user', '2025-06-05 17:27:34', 'DANA-1749144454', 'Pembayaran DANA', 'Pembayaran via DANA', 29000.00, 'Menunggu Konfirmasi', 'payment_proofs/DLKiLD4w8WBHQ0Q9BPlmAi2RTtqG1i6WsNZnVAnz.png', '2025-06-05 10:27:34', '2025-06-05 10:27:34'),
(135, 'System', 'ban user', '2025-06-05 20:33:35', 'GOPAY-1749155615', 'Pembayaran GOPAY', 'Pembayaran via GOPAY', 22000.00, 'Menunggu Konfirmasi', 'payment_proofs/CuNnbw53bxyaa0PicDQNMoGLBosdt6DAJcC6imdL.jpg', '2025-06-05 13:33:35', '2025-06-05 13:33:35'),
(136, 'System', 'ban user', '2025-06-06 20:03:04', 'BCA-1749240184', 'Pembayaran BCA', 'Pembayaran via BCA', 22000.00, 'Menunggu Konfirmasi', 'payment_proofs/7jg6TD2ra5CH0C5rLNxqU3jcoeqB3hrGZxRrDh2r.png', '2025-06-06 13:03:04', '2025-06-06 13:03:04'),
(137, 'System', 'ban user', '2025-06-07 17:49:58', 'COD-DP-1749318598', 'Down Payment COD', 'Pembayaran DP untuk pesanan COD', 8750.00, 'Menunggu Konfirmasi', 'payment_proofs/rGvMx7869K9iT1V22JrgDOC7G09NI9rKnixaYgVx.png', '2025-06-07 10:49:58', '2025-06-07 10:49:58'),
(138, 'System', 'ban user', '2025-06-07 17:49:58', 'COD-1749318598', 'Sisa Pembayaran COD', 'Sisa pembayaran COD yang harus dibayar saat pengiriman', 16250.00, 'Menunggu Pembayaran', NULL, '2025-06-07 10:49:58', '2025-06-07 10:49:58'),
(139, 'System', 'ban user', '2025-06-08 02:21:22', 'GOPAY-1749349282', 'Pembayaran GOPAY', 'Pembayaran via GOPAY', 15000.00, 'Menunggu Konfirmasi', 'payment_proofs/nO6VmM5LchoIx01EXKc7fH0NH2QOOxq2qRDtrV1b.png', '2025-06-07 19:21:22', '2025-06-07 19:21:22'),
(140, 'System', 'ban user', '2025-06-08 02:25:33', 'GOPAY-1749349533', 'Pembayaran GOPAY', 'Pembayaran via GOPAY', 20000.00, 'Menunggu Konfirmasi', 'payment_proofs/TguGdmCsVKuyoGGpLHUQLKR6crk4RfQnRNhiORyo.png', '2025-06-07 19:25:33', '2025-06-07 19:25:33'),
(141, 'System', 'ban user', '2025-06-08 02:41:27', 'GOPAY-1749350487', 'Pembayaran GOPAY', 'Pembayaran via GOPAY', 15000.00, 'Menunggu Konfirmasi', 'payment_proofs/c5vuU3GTMcTVQIcNcB13yyDX8MxO4LqIDg9fer3X.png', '2025-06-07 19:41:27', '2025-06-07 19:41:27'),
(142, 'System', 'ban user', '2025-06-08 06:57:05', 'GOPAY-1749365825', 'Pembayaran GOPAY', 'Pembayaran via GOPAY', 45000.00, 'Menunggu Konfirmasi', 'payment_proofs/OfvWxgyXHqrVuEaAS9HzIWYvFvv5pNIBDmJLB252.jpg', '2025-06-07 23:57:05', '2025-06-07 23:57:05'),
(143, 'System', 'ban user', '2025-06-08 09:11:36', 'DANA-1749373896', 'Pembayaran DANA', 'Pembayaran via DANA', 19000.00, 'Menunggu Konfirmasi', 'payment_proofs/psGs7JiLNxplETQUAaaKEs7GF4WQwi7Z2fiTExM4.jpg', '2025-06-08 02:11:36', '2025-06-08 02:11:36'),
(144, 'System', 'ban user', '2025-06-08 11:18:54', 'GOPAY-1749381534', 'Pembayaran GOPAY', 'Pembayaran via GOPAY', 40000.00, 'Menunggu Konfirmasi', 'payment_proofs/w3V90Df4UlEWisgEc1o0l9s8h2ujZTpDvkhHDvfi.jpg', '2025-06-08 04:18:54', '2025-06-08 04:18:54'),
(145, 'System', 'ban user', '2025-06-08 17:59:35', 'DANA-1749405575', 'Pembayaran DANA', 'Pembayaran via DANA', 60000.00, 'Menunggu Konfirmasi', 'payment_proofs/vE5DrQUIQZWuW2ZzR1E1b8b17kdgq1NOroZX2pjV.jpg', '2025-06-08 10:59:35', '2025-06-08 10:59:35'),
(146, 'System', 'ban user', '2025-06-08 18:58:55', 'GOPAY-1749409135', 'Pembayaran GOPAY', 'Pembayaran via GOPAY', 28000.00, 'Menunggu Konfirmasi', 'payment_proofs/hlNcYDXEYson6ctsZ28p5Z4wHbGsAulikXTyOCru.png', '2025-06-08 11:58:55', '2025-06-08 11:58:55'),
(147, 'System', 'ban user', '2025-06-08 19:03:58', 'GOPAY-1749409438', 'Pembayaran GOPAY', 'Pembayaran via GOPAY', 23000.00, 'Menunggu Konfirmasi', 'payment_proofs/LqZBq5zgNhCYSmJN8KDhyK4CLi4gvt3c4rEvPRVI.jpg', '2025-06-08 12:03:58', '2025-06-08 12:03:58'),
(148, 'System', 'ban user', '2025-06-08 19:09:54', 'COD-DP-1749409794', 'Down Payment COD', 'Pembayaran DP untuk pesanan COD', 9800.00, 'Menunggu Konfirmasi', 'payment_proofs/FlE1zugunTdi6sqToKzFORacmZ0SORXoeIz3Vqxo.jpg', '2025-06-08 12:09:54', '2025-06-08 12:09:54'),
(149, 'System', 'ban user', '2025-06-08 19:09:54', 'COD-1749409794', 'Sisa Pembayaran COD', 'Sisa pembayaran COD yang harus dibayar saat pengiriman', 18200.00, 'Menunggu Pembayaran', NULL, '2025-06-08 12:09:54', '2025-06-08 12:09:54'),
(150, 'System', 'ban user', '2025-06-09 10:48:28', 'GOPAY-1749466108', 'Pembayaran GOPAY', 'Pembayaran via GOPAY', 28000.00, 'Menunggu Konfirmasi', 'payment_proofs/mdOcmfLtqqgVrS5zV4IUDjgRRAN3BlP1LWLKbxVm.png', '2025-06-09 03:48:28', '2025-06-09 03:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `email`, `phone`, `address`, `profile_picture`, `email_verified_at`, `password`, `usertype`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin cateringkita', NULL, NULL, 'budisosial1@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$EngY7DbJRTs6KcorA3ZimuYY3pLUAT4lhBKGGp8nBd.wMYZbQJorS', 'admin', NULL, '2025-04-27 08:40:19', '2025-04-28 09:21:54'),
(2, 'user ganteng', NULL, NULL, 'user@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$CGaq86otXiAWuI6hRBjexu4P.Na2yYasE2z5WgAz.BZwv563r2SRC', 'user', NULL, '2025-04-27 21:10:52', '2025-04-27 21:10:52'),
(3, 'budi user', NULL, NULL, 'budiuser@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$rfZ6Jj0v88rhy/8BlEZDUuI5LI.2ZucDhyvWo2P1BVB2Aq/e.Kk0G', 'user', 'bOj9hMhOvsyZQeLCiRpdim6fYfluENPqaYpQWCjIKvzgsqTHvheYqx49upIc', '2025-04-29 17:49:23', '2025-04-29 17:49:23'),
(4, 'anton pratama', NULL, NULL, 'antonpratama1@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$2oJwjzWC/E/a/HXPDujoquezHqK5Y9j0p7vcuuyBCNbeYLc10PFG6', 'user', 'yvJ1ePkSo4J5y7D5ReVNraaACtraTi1MkODaQ3EdKCVe4LOBSpsl70fvB1UN', '2025-04-29 20:11:08', '2025-04-29 20:11:08'),
(5, 'anton manatap', NULL, NULL, 'antonpratama@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$lpVtYlwES.VIxsREBeIM2.4NWv9xCNGLR2bEv5de8qHGJElyezLne', 'user', NULL, '2025-04-29 21:02:39', '2025-04-29 21:02:39'),
(6, 'admin admina', NULL, NULL, 'admincateringkita@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$1AwxaLYcNURjtKIGV5Zl3.WwcErKa7prpkuVDSskhCli74L4Ez0c2', 'user', NULL, '2025-05-27 07:02:59', '2025-05-27 07:02:59'),
(7, 'Gibran Tahu', NULL, NULL, 'ban@gmail.com', '0894589432929', NULL, 'profile_pictures/goeR2DFIwmjwWaPnAhpuudaARVxBQA40iP8iwYYC.png', NULL, '$2y$12$VQkwtGwd0wySLXrDc9sUaegHBPzr3KbV/dSrZ0OkFexsgVYsp2NHa', 'admin', 'YcunWiPAffDUuL6WPVunp09pphpuY2VittVO3iooH4bWa0PKTO8k5HE5424t', '2025-06-03 09:20:50', '2025-06-08 10:41:57'),
(8, 'ban user', NULL, NULL, 'banuser@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$m1vBXGmLrkv.3GNbYK1ugubyW.Gdxw4w8cYlLlTJuq8obinNvIvTe', 'user', 'fAB96ZUOGfJTccLIucWbTTfZ9oib00rraluuuvMFLwmUJ6hOivEyuAiyTvge', '2025-06-03 09:23:20', '2025-06-03 09:23:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_profiles`
--
ALTER TABLE `admin_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_profiles_user_id_foreign` (`user_id`);

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
-- Indexes for table `caterings`
--
ALTER TABLE `caterings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_outs`
--
ALTER TABLE `check_outs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `check_outs_user_id_foreign` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_pesanans`
--
ALTER TABLE `daftar_pesanans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `daftar_pesanans_order_id_unique` (`order_id`),
  ADD KEY `daftar_pesanans_user_id_foreign` (`user_id`),
  ADD KEY `idx_kelola_makanan_id` (`kelola_makanan_id`),
  ADD KEY `idx_status_cancelled` (`status_pengiriman`,`cancelled_at`),
  ADD KEY `idx_cancelled_by` (`cancelled_by`);

--
-- Indexes for table `detail_acaras`
--
ALTER TABLE `detail_acaras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `formulir_pesanans`
--
ALTER TABLE `formulir_pesanans`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `karyawan_username_karyawan_unique` (`username_karyawan`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelola_makanans`
--
ALTER TABLE `kelola_makanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keranjangs_user_id_foreign` (`user_id`);

--
-- Indexes for table `keranjang_items`
--
ALTER TABLE `keranjang_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keranjang_items_keranjang_id_foreign` (`keranjang_id`),
  ADD KEY `idx_kelola_makanan_id` (`kelola_makanan_id`);

--
-- Indexes for table `konfirmasi_pesanans`
--
ALTER TABLE `konfirmasi_pesanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_prasmanans`
--
ALTER TABLE `menu_prasmanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metode_pembayarans`
--
ALTER TABLE `metode_pembayarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metode_pembayaran_users`
--
ALTER TABLE `metode_pembayaran_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_order_id_foreign` (`order_id`),
  ADD KEY `notifications_user_id_is_read_index` (`user_id`,`is_read`),
  ADD KEY `notifications_user_id_created_at_index` (`user_id`,`created_at`);

--
-- Indexes for table `notification_admins`
--
ALTER TABLE `notification_admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_admins_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaians_pesanan_id_foreign` (`pesanan_id`);

--
-- Indexes for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_order_review` (`user_id`,`order_id`),
  ADD KEY `reviews_order_id_foreign` (`order_id`),
  ADD KEY `reviews_average_rating_index` (`average_rating`),
  ADD KEY `reviews_status_index` (`status`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `status_pembayarans`
--
ALTER TABLE `status_pembayarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_pengirimen`
--
ALTER TABLE `status_pengirimen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_bahans`
--
ALTER TABLE `stok_bahans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tentang_kamis`
--
ALTER TABLE `tentang_kamis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksis_id_transaksi_unique` (`id_transaksi`);

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
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_profiles`
--
ALTER TABLE `admin_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `caterings`
--
ALTER TABLE `caterings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `check_outs`
--
ALTER TABLE `check_outs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daftar_pesanans`
--
ALTER TABLE `daftar_pesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `detail_acaras`
--
ALTER TABLE `detail_acaras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formulir_pesanans`
--
ALTER TABLE `formulir_pesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelola_makanans`
--
ALTER TABLE `kelola_makanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `keranjangs`
--
ALTER TABLE `keranjangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keranjang_items`
--
ALTER TABLE `keranjang_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `konfirmasi_pesanans`
--
ALTER TABLE `konfirmasi_pesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_prasmanans`
--
ALTER TABLE `menu_prasmanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metode_pembayarans`
--
ALTER TABLE `metode_pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `metode_pembayaran_users`
--
ALTER TABLE `metode_pembayaran_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notification_admins`
--
ALTER TABLE `notification_admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penilaians`
--
ALTER TABLE `penilaians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanans`
--
ALTER TABLE `pesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registers`
--
ALTER TABLE `registers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `status_pembayarans`
--
ALTER TABLE `status_pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_pengirimen`
--
ALTER TABLE `status_pengirimen`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stok_bahans`
--
ALTER TABLE `stok_bahans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tentang_kamis`
--
ALTER TABLE `tentang_kamis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_profiles`
--
ALTER TABLE `admin_profiles`
  ADD CONSTRAINT `admin_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `check_outs`
--
ALTER TABLE `check_outs`
  ADD CONSTRAINT `check_outs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `daftar_pesanans`
--
ALTER TABLE `daftar_pesanans`
  ADD CONSTRAINT `daftar_pesanans_cancelled_by_foreign` FOREIGN KEY (`cancelled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `daftar_pesanans_kelola_makanan_id_foreign` FOREIGN KEY (`kelola_makanan_id`) REFERENCES `kelola_makanans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `daftar_pesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD CONSTRAINT `keranjangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `keranjang_items`
--
ALTER TABLE `keranjang_items`
  ADD CONSTRAINT `keranjang_items_kelola_makanan_id_foreign` FOREIGN KEY (`kelola_makanan_id`) REFERENCES `kelola_makanans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `keranjang_items_keranjang_id_foreign` FOREIGN KEY (`keranjang_id`) REFERENCES `keranjangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `daftar_pesanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_admins`
--
ALTER TABLE `notification_admins`
  ADD CONSTRAINT `notification_admins_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD CONSTRAINT `penilaians_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `daftar_pesanans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `daftar_pesanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
