-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2025 at 08:23 PM
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
-- Table structure for table `daftar_pesanans`
--

CREATE TABLE `daftar_pesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelanggan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `kategori_pesanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pesanan` timestamp NOT NULL,
  `jumlah_pesanan` int NOT NULL,
  `tanggal_pengiriman` date NOT NULL,
  `waktu_pengiriman` time NOT NULL,
  `lokasi_pengiriman` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `opsi_pengiriman` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `status_pengiriman` enum('diproses','dikirim','diterima','dibatalkan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pembayaran` enum('pending','paid','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_pesanans`
--

INSERT INTO `daftar_pesanans` (`id`, `order_id`, `nama_pelanggan`, `user_id`, `kategori_pesanan`, `tanggal_pesanan`, `jumlah_pesanan`, `tanggal_pengiriman`, `waktu_pengiriman`, `lokasi_pengiriman`, `nomor_telepon`, `pesan`, `opsi_pengiriman`, `total_harga`, `status_pengiriman`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(99, 'ORD1745981486436920', 'admin cateringkita', 1, 'Lainnya', '2025-04-29 19:51:26', 20, '2025-05-01', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang wjnk', 'regular', 250000.00, 'diproses', 'pending', '2025-04-29 19:51:27', '2025-04-29 19:51:27'),
(100, 'ORD1745981679193113', 'admin cateringkita', 1, 'Lainnya', '2025-04-29 19:54:39', 20, '2025-05-01', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang enaka', 'instant', 260000.00, 'diproses', 'pending', '2025-04-29 19:54:39', '2025-04-29 19:54:39'),
(101, 'ORD1745983154093751', 'admin cateringkita', 1, 'Lainnya', '2025-04-29 20:19:14', 30, '2025-05-12', '12:00:00', 'ciomas bogor kota', '+62 898 8049 488', 'yang banyak yaa', 'instant', 380000.00, 'diproses', 'pending', '2025-04-29 20:19:15', '2025-04-29 20:19:15'),
(102, 'ORD1746151342333408', 'admin cateringkita', 1, 'Lainnya', '2025-05-01 19:02:22', 30, '2025-05-03', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang enak', 'instant', 380000.00, 'diproses', 'pending', '2025-05-01 19:02:23', '2025-05-01 19:02:23'),
(103, 'ORD1746151520036715', 'admin cateringkita', 1, 'Lainnya', '2025-05-01 19:05:20', 30, '2025-05-03', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang enak', 'instant', 370000.00, 'diproses', 'pending', '2025-05-01 19:05:20', '2025-05-01 19:05:20'),
(104, 'ORD1746163623394934', 'admin cateringkita', 1, 'Lainnya', '2025-05-01 22:27:03', 100, '2025-05-03', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang enak', 'instant', 3510000.00, 'diproses', 'pending', '2025-05-01 22:27:03', '2025-05-01 22:27:03'),
(105, 'ORD1746169557480519', 'admin cateringkita', 1, 'Lainnya', '2025-05-02 00:05:57', 100, '2025-05-03', '15:00:00', 'ciomas', '+62 881 0115 62638', 'adjand', 'instant', 3510000.00, 'diproses', 'pending', '2025-05-02 00:05:57', '2025-05-02 00:05:57'),
(106, 'ORD1746169918635861', 'admin cateringkita', 1, 'Lainnya', '2025-05-02 00:11:58', 100, '2025-05-03', '15:00:00', 'ciomas', '+62 881 0115 62638', 'diknaakdnadakdnakdk', 'instant', 3510000.00, 'diproses', 'pending', '2025-05-02 00:11:59', '2025-05-02 00:11:59'),
(107, 'ORD1746170666650851', 'admin cateringkita', 1, 'Lainnya', '2025-05-02 00:24:26', 101, '2025-05-05', '16:23:00', 'egregefe', '+62 881 0115 62638', 'dfdgg', 'instant', 3522000.00, 'dikirim', 'pending', '2025-05-02 00:24:27', '2025-06-04 09:24:18'),
(108, 'ORD1746420653473520', 'admin cateringkita', 1, 'Lainnya', '2025-05-04 21:50:53', 101, '2025-05-07', '15:00:00', 'sokdlsamdkasjkasd', '+62 837 7362 7232', 'wilkkahsmamaj', 'instant', 3522000.00, 'dikirim', 'pending', '2025-05-04 21:50:53', '2025-06-04 08:30:48'),
(109, 'ORD174832049884497', 'admin cateringkita', 1, 'Lainnya', '2025-05-26 21:34:58', 102, '2025-05-28', '15:00:00', 'adaidmadn', '+62 898 2632 367', 'adnkadnad', 'instant', 3534000.00, 'diterima', 'pending', '2025-05-26 21:34:59', '2025-06-04 08:28:15'),
(110, 'ORD174897122950664', 'ban user', 8, 'Lainnya', '2025-06-03 10:20:29', 1, '2025-06-05', '11:22:00', 'lsahKskldhfalkdjshfldkasjhflsdfdsfd', '+62 895 4949 94999', 'vgfgagagggggggggggggggggggggggggga', 'instant', 22000.00, 'diterima', 'pending', '2025-06-03 10:20:29', '2025-06-04 04:50:44'),
(115, 'ORD1749051106434239', 'ban user', 8, 'Lainnya', '2025-06-03 17:00:00', 2, '2025-06-13', '15:32:00', 'rwererrwerwewerwerwerewrwerewewewewerwrewr', '089539298232', 'fsfasaffgsahfgfbfbsbfd', 'instant', 34000.00, 'diterima', 'pending', '2025-06-04 08:31:51', '2025-06-04 09:24:39'),
(116, 'ORD1749052811367896', 'ban user', 8, 'Lainnya', '2025-06-03 17:00:00', 2, '2025-06-05', '14:01:00', 'lalalalalalalalalalalalalalalallaal', '089539298232', 'kokoookokokokokokokokokokookokkookkokookookkookkokokokp', 'economy', 26000.00, 'diterima', 'pending', '2025-06-04 09:00:17', '2025-06-04 09:17:23'),
(117, 'ORD1749053890012128', 'ban user', 8, 'Lainnya', '2025-06-03 17:00:00', 2, '2025-06-16', '15:17:00', 'Bogor', '089539298232', 'leci', 'instant', 34000.00, 'diterima', 'pending', '2025-06-04 09:18:14', '2025-06-04 09:24:34'),
(119, 'ORD1749144441258577', 'ban user', 8, 'Lainnya', '2025-06-04 17:00:00', 2, '2025-06-11', '16:27:00', 'dasdasdasdsa', '0895494994999', 'opsional', 'regular', 29000.00, 'diterima', 'pending', '2025-06-05 10:27:25', '2025-06-05 10:29:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_pesanans`
--
ALTER TABLE `daftar_pesanans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `daftar_pesanans_order_id_unique` (`order_id`),
  ADD KEY `daftar_pesanans_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_pesanans`
--
ALTER TABLE `daftar_pesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_pesanans`
--
ALTER TABLE `daftar_pesanans`
  ADD CONSTRAINT `daftar_pesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
