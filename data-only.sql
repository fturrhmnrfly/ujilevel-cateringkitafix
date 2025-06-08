-- Data Only SQL - Ujilevel Catering Kita (COMPLETE BACKUP)
-- Generated from ujilevel-cateringkita.sql

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Disable foreign key checks untuk import yang aman
SET FOREIGN_KEY_CHECKS=0;

-- Data untuk tabel admin_profiles
INSERT IGNORE INTO `admin_profiles` (`id`, `user_id`, `phone`, `bio`, `created_at`, `updated_at`) VALUES
(1, 1, '', 'Hello guys', '2025-04-29 00:17:07', '2025-04-29 00:17:07');

-- Data untuk tabel users
INSERT IGNORE INTO `users` (`id`, `name`, `first_name`, `last_name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `usertype`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin cateringkita', NULL, NULL, 'budisosial1@gmail.com', NULL, NULL, NULL, '$2y$12$EngY7DbJRTs6KcorA3ZimuYY3pLUAT4lhBKGGp8nBd.wMYZbQJorS', 'admin', NULL, '2025-04-27 08:40:19', '2025-04-28 09:21:54'),
(2, 'user ganteng', NULL, NULL, 'user@gmail.com', NULL, NULL, NULL, '$2y$12$CGaq86otXiAWuI6hRBjexu4P.Na2yYasE2z5WgAz.BZwv563r2SRC', 'user', NULL, '2025-04-27 21:10:52', '2025-04-27 21:10:52'),
(3, 'budi user', NULL, NULL, 'budiuser@gmail.com', NULL, NULL, NULL, '$2y$12$rfZ6Jj0v88rhy/8BlEZDUuI5LI.2ZucDhyvWo2P1BVB2Aq/e.Kk0G', 'user', 'bOj9hMhOvsyZQeLCiRpdim6fYfluENPqaYpQWCjIKvzgsqTHvheYqx49upIc', '2025-04-29 17:49:23', '2025-04-29 17:49:23'),
(4, 'anton pratama', NULL, NULL, 'antonpratama1@gmail.com', NULL, NULL, NULL, '$2y$12$2oJwjzWC/E/a/HXPDujoquezHqK5Y9j0p7vcuuyBCNbeYLc10PFG6', 'user', 'yvJ1ePkSo4J5y7D5ReVNraaACtraTi1MkODaQ3EdKCVe4LOBSpsl70fvB1UN', '2025-04-29 20:11:08', '2025-04-29 20:11:08'),
(5, 'anton manatap', NULL, NULL, 'antonpratama@gmail.com', NULL, NULL, NULL, '$2y$12$lpVtYlwES.VIxsREBeIM2.4NWv9xCNGLR2bEv5de8qHGJElyezLne', 'user', NULL, '2025-04-29 21:02:39', '2025-04-29 21:02:39'),
(6, 'admin admina', NULL, NULL, 'admincateringkita@gmail.com', NULL, NULL, NULL, '$2y$12$1AwxaLYcNURjtKIGV5Zl3.WwcErKa7prpkuVDSskhCli74L4Ez0c2', 'user', NULL, '2025-05-27 07:02:59', '2025-05-27 07:02:59'),
(7, 'Gibran Tes', NULL, NULL, 'ban@gmail.com', NULL, NULL, NULL, '$2y$12$VQkwtGwd0wySLXrDc9sUaegHBPzr3KbV/dSrZ0OkFexsgVYsp2NHa', 'admin', 'YcunWiPAffDUuL6WPVunp09pphpuY2VittVO3iooH4bWa0PKTO8k5HE5424t', '2025-06-03 09:20:50', '2025-06-03 09:20:50'),
(8, 'ban user', NULL, NULL, 'banuser@gmail.com', NULL, NULL, NULL, '$2y$12$m1vBXGmLrkv.3GNbYK1ugubyW.Gdxw4w8cYlLlTJuq8obinNvIvTe', 'user', 'OfuktDzWteaUrT7rqNWE0cZOVMMi6nLnG2hDWsBcp0ImO5LyBcCXI2tEgnrx', '2025-06-03 09:23:20', '2025-06-03 09:23:20');

-- Data untuk tabel daftar_pesanans
INSERT IGNORE INTO `daftar_pesanans` (`id`, `order_id`, `nama_pelanggan`, `user_id`, `kategori_pesanan`, `kelola_makanan_id`, `tanggal_pesanan`, `jumlah_pesanan`, `tanggal_pengiriman`, `waktu_pengiriman`, `lokasi_pengiriman`, `nomor_telepon`, `pesan`, `opsi_pengiriman`, `total_harga`, `status_pengiriman`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(99, 'ORD1745981486436920', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-04-29 19:51:26', 20, '2025-05-01', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang wjnk', 'regular', 250000.00, 'diproses', 'pending', '2025-04-29 19:51:27', '2025-04-29 19:51:27'),
(100, 'ORD1745981679193113', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-04-29 19:54:39', 20, '2025-05-01', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang enaka', 'instant', 260000.00, 'diproses', 'pending', '2025-04-29 19:54:39', '2025-04-29 19:54:39'),
(101, 'ORD1745983154093751', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-04-29 20:19:14', 30, '2025-05-12', '12:00:00', 'ciomas bogor kota', '+62 898 8049 488', 'yang banyak yaa', 'instant', 380000.00, 'diproses', 'pending', '2025-04-29 20:19:15', '2025-04-29 20:19:15'),
(102, 'ORD1746151342333408', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-05-01 19:02:22', 30, '2025-05-03', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang enak', 'instant', 380000.00, 'diproses', 'pending', '2025-05-01 19:02:23', '2025-05-01 19:02:23'),
(103, 'ORD1746151520036715', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-05-01 19:05:20', 30, '2025-05-03', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang enak', 'instant', 370000.00, 'diproses', 'pending', '2025-05-01 19:05:20', '2025-05-01 19:05:20'),
(104, 'ORD1746163623394934', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-05-01 22:27:03', 100, '2025-05-03', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang enak', 'instant', 3510000.00, 'diproses', 'pending', '2025-05-01 22:27:03', '2025-05-01 22:27:03'),
(110, 'ORD174897122950664', 'ban user', 8, 'Lainnya', NULL, '2025-06-03 10:20:29', 1, '2025-06-05', '11:22:00', 'lsahKskldhfalkdjshfldkasjhflsdfdsfd', '+62 895 4949 94999', 'vgfgagagggggggggggggggggggggggggga', 'instant', 22000.00, 'diterima', 'pending', '2025-06-03 10:20:29', '2025-06-04 04:50:44'),
(121, 'ORD1749240164741910', 'ban user', 8, 'Lainnya', NULL, '2025-06-05 17:00:00', 1, '2025-06-25', '11:02:00', 'MDTV', '087652552114', 'TRANS TV', 'instant', 22000.00, 'diterima', 'pending', '2025-06-06 13:02:50', '2025-06-06 13:08:24'),
(122, 'ORD1749318558846508', 'ban user', 8, 'Lainnya', NULL, '2025-06-07 00:00:00', 1, '2025-06-18', '13:48:00', 'sdadasds', '0895392982328', 'termal', 'instant', 25000.00, 'diproses', 'pending', '2025-06-07 10:49:23', '2025-06-07 10:49:23'),
(123, 'ORD1749349264636344', 'ban user', 8, 'Lainnya', NULL, '2025-06-08 00:00:00', 1, '2025-06-11', '09:20:00', 'bandung', '089539298232', 'dasdasasda', 'regular', 15000.00, 'diproses', 'pending', '2025-06-07 19:21:08', '2025-06-07 19:21:08'),
(124, 'ORD1749349518621169', 'ban user', 8, 'Lainnya', NULL, '2025-06-08 00:00:00', 1, '2025-06-16', '09:24:00', 'babduds', '0895392982329', 'bohemian rhapsody', 'instant', 20000.00, 'diproses', 'pending', '2025-06-07 19:25:22', '2025-06-07 19:25:22'),
(125, 'ORD1749350475919673', 'ban user', 8, 'Lainnya', 7, '2025-06-08 00:00:00', 1, '2025-06-19', '09:40:00', 'dkhashdksahkaj', '089539298232', 'adah', 'instant', 15000.00, 'dibatalkan', 'pending', '2025-06-07 19:41:19', '2025-06-08 02:20:04'),
(126, 'ORD1749365807705777', 'ban user', 8, 'Lainnya', 13, '2025-06-08 00:00:00', 1, '2025-06-10', '13:56:00', 'adlkfasdlkjlk', '0876525521175', 'Weekend', 'instant', 45000.00, 'diterima', 'pending', '2025-06-07 23:56:51', '2025-06-08 00:31:22'),
(127, 'ORD174937387055449', 'ban user', 8, 'Lainnya', 2, '2025-06-08 00:00:00', 1, '2025-06-16', '16:10:00', 'ju wenjun', '0876525521177', 'lero', 'instant', 19000.00, 'dikirim', 'pending', '2025-06-08 02:11:22', '2025-06-08 02:19:33');

-- Data untuk tabel karyawan
INSERT IGNORE INTO `karyawan` (`id`, `nama_karyawan`, `username_karyawan`, `posisi`, `kontak`, `tanggal_bergabung`, `status`, `keahlian`, `created_at`, `updated_at`) VALUES
(1, 'wildan', 'wildansyah23', 'office boy', '08981323242321', '2025-04-02', 'Cuti', 'membersihkan ruangan dengan cepat', '2025-04-27 09:01:59', '2025-04-29 02:16:50');

-- Data untuk tabel kategoris
INSERT IGNORE INTO `kategoris` (`id`, `nama_kategori`, `deskripsi`, `jumlah_item`, `created_at`, `updated_at`) VALUES
(3, 'Prasmanan', 'Hidangan lengkap dengan berbagai prasmanan untuk berbagai acara', 9, '2025-04-29 02:14:45', '2025-04-29 02:14:45'),
(4, 'Nasi Box', 'Paket nasi lengkap dalam kotak untuk berbagai praktis', 6, '2025-04-29 02:15:15', '2025-04-29 02:15:15');

-- Data untuk tabel kelola_makanans
INSERT IGNORE INTO `kelola_makanans` (`id`, `nama_makanan`, `kategori`, `harga`, `status`, `deskripsi`, `image`, `created_at`, `updated_at`) VALUES
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

-- Data untuk tabel keranjangs
INSERT IGNORE INTO `keranjangs` (`id`, `user_id`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3548000.00, 'active', '2025-04-27 08:40:57', '2025-05-27 01:12:04'),
(2, 2, 25000.00, 'active', '2025-04-27 21:11:21', '2025-04-29 17:35:32'),
(3, 3, 1296000.00, 'active', '2025-04-29 17:49:47', '2025-04-29 17:50:00'),
(4, 4, 81000.00, 'active', '2025-04-29 21:06:35', '2025-05-29 23:27:52'),
(5, 8, 9000.00, 'active', '2025-06-03 09:24:52', '2025-06-08 00:50:08');

-- Data untuk tabel keranjang_items
INSERT IGNORE INTO `keranjang_items` (`id`, `keranjang_id`, `kelola_makanan_id`, `nama_produk`, `price`, `quantity`, `image`, `created_at`, `updated_at`) VALUES
(4, 2, NULL, 'Paket Nasi Kotak Premium A', 25000.00, 1, 'http://127.0.0.1:8000/assets/paketassets1.png', '2025-04-27 21:11:21', '2025-04-27 21:11:21'),
(14, 3, NULL, 'Ayam Geprek', 12000.00, 108, '/storage/images/F4pQodn3T2Bb97IfMWbj2NzU9SwKHdzwMOTJkIVP.jpg', '2025-04-29 17:49:47', '2025-04-29 17:49:59'),
(16, 1, NULL, 'Paket Nasi Ayam Bakar Spesial', 35000.00, 100, '/storage/images/htSf1ctWYeXUkNcD9099YhrttUatFJO0I9knpLWk.png', '2025-05-01 22:26:31', '2025-05-01 22:26:31'),
(17, 1, NULL, 'Ayam Geprek', 12000.00, 4, '/storage/images/5fSVaTecLpJTXCwjZqPkyRLLm1Sbd2lCuM4n8QzM.png', '2025-05-02 00:22:16', '2025-05-27 01:12:04'),
(18, 4, NULL, 'Ayam Kecap', 9000.00, 9, '/storage/images/2U1Gn90AgLNdcljVLgqGjq5xfrZSGNLK4BzrTHqU.jpg', '2025-05-26 00:44:23', '2025-05-28 00:34:18'),
(26, 5, 2, 'Ayam Kecap', 9000.00, 1, '/storage/images/I8NovMGPK8rmTEZpZ0zgkkU1n7j9jSyJ4wM9CyPb.jpg', '2025-06-08 00:50:00', '2025-06-08 00:50:00');

-- Data untuk tabel laporans
INSERT IGNORE INTO `laporans` (`id`, `tanggal`, `jenis_laporan`, `laporan`, `deskripsi`, `total`, `admin`, `status`, `created_at`, `updated_at`) VALUES
(1, '2025-04-29', 'Harian', 'Pendapatan Harian', 'Pendapatan dari pesanan catering', 0.00, 'admin cateringkita', 'males', '2025-04-28 22:33:08', '2025-04-29 02:27:07');

-- Data untuk tabel metode_pembayarans
INSERT IGNORE INTO `metode_pembayarans` (`id`, `metode_pembayaran`, `deskripsi`, `status`, `admin`, `created_at`, `updated_at`) VALUES
(3, 'BCA', 'Pembayaran via Transfer Bank', 'Aktif', 'Admin 1', '2025-04-29 02:32:44', '2025-04-29 02:32:44'),
(4, 'Dana', 'Pembayaran via E-wallet', 'Aktif', 'admin 1', '2025-04-29 02:33:15', '2025-04-29 02:33:15'),
(5, 'Gopay', 'Pembayaran via Gopay', 'Aktif', 'admin 1', '2025-04-29 02:33:39', '2025-04-29 02:33:39'),
(6, 'COD', 'Pembayaran dilakukan di tempat saat pesanan diterima(wajib membayar dp 35% saat memesan)', 'Aktif', 'admin 1', '2025-04-29 02:34:25', '2025-04-29 02:35:31');

-- Data untuk tabel migrations
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
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

-- Data untuk tabel notifications
INSERT IGNORE INTO `notifications` (`id`, `user_id`, `title`, `message`, `type`, `icon_type`, `order_id`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 8, 'Pesanan baru', 'Pesanan #ORD1749318558846508 sedang dalam Proses', 'order', 'box', 122, 1, '2025-06-07 21:36:09', '2025-06-07 10:49:23', '2025-06-07 21:36:09'),
(2, 8, 'Pesanan Telah Dikirim', 'Pesanan #ORD1749365807705777 sedang dalam perjalanan dan akan tiba dalam waktu 30 menit.', 'delivery', 'truck', 126, 1, '2025-06-08 00:22:00', '2025-06-08 00:21:21', '2025-06-08 00:22:00'),
(3, 8, 'Beri Rating untuk Pesanan Sebelumnya', 'Bagaimana pengalaman Anda dengan pesanan #ORD1749365807705777? Beri rating dan ulasan untuk membantu kami meningkatkan layanan.', 'delivery', 'star', 126, 1, '2025-06-08 00:45:12', '2025-06-08 00:31:22', '2025-06-08 00:45:12'),
(4, 8, 'Pesanan Telah Dikirim', 'Pesanan #ORD174937387055449 sedang dalam perjalanan dan akan tiba dalam waktu 30 menit.', 'delivery', 'truck', 127, 0, NULL, '2025-06-08 02:19:33', '2025-06-08 02:19:33');

-- Data untuk tabel profiles
INSERT IGNORE INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `phone`, `address`, `bio`, `created_at`, `updated_at`) VALUES
(1, 1, 'budi', 'sosial', '0881011562638', 'ciomas bogor kota', 'hello guys', '2025-04-27 08:40:19', '2025-04-28 09:27:16'),
(2, 2, 'user', 'catering', '0881011562638', 'ciomas bogor kota', NULL, '2025-04-27 21:10:52', '2025-04-29 07:52:23'),
(3, 3, 'budi', 'user', '0881011562638', 'ciomas bogor kota', NULL, '2025-04-29 17:49:23', '2025-04-29 17:49:23'),
(4, 4, 'anton', 'pratama', '08988049488', 'ciomas bogor kota', NULL, '2025-04-29 20:11:08', '2025-04-29 20:11:08'),
(5, 5, 'anton', 'manatap', '0881011562638', 'ciomas bogor', NULL, '2025-04-29 21:02:39', '2025-04-29 21:02:39'),
(6, 6, 'admin', 'admina', '0881011562638', 'adakdakdmad', NULL, '2025-05-27 07:02:59', '2025-05-27 07:02:59'),
(7, 7, 'Gibran', 'Tes', '0895392982328', 'Di daerah bogor raya', NULL, '2025-06-03 09:20:51', '2025-06-03 09:20:51'),
(8, 8, 'dan', 'user', '0895387455678', 'fsdaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', NULL, '2025-06-03 09:23:20', '2025-06-03 09:23:20');

-- Data untuk tabel sessions
INSERT IGNORE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('KJ1fpwc47P2hs7yFJxUPchBPrl0RyzytL5gMqHSA', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQk1XeHB1aUQxTDJ4azNqSkFBT3pvbFplWFdaeEpZUjJMT0lZT3I0YSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ub3RpZmljYXRpb25zL2NvdW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1749379165),
('KOMLVAOQX9GWozx2xeNPmPWsAUj3WIosZOfEDU36', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTVhOVDZtMWJYYTJ1QVM0UHN2WHhPUVlmR2lVS1VSRURkS0tLNUFwMiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2RhZnRhcnBlc2FuYW4iO319', 1749374404);

-- Data untuk tabel status_pengirimen
INSERT IGNORE INTO `status_pengirimen` (`id`, `nama_pembeli`, `nama_produk`, `tanggal_transaksi`, `status_pengiriman`, `created_at`, `updated_at`) VALUES
(1, 'wabak', 'ayam', '2025-04-28', 'Dikirim', '2025-04-27 21:04:11', '2025-04-27 21:04:11');

-- Data untuk tabel tentang_kami
INSERT IGNORE INTO `tentang_kamis` (`id`, `foto`, `deskripsi`, `created_at`, `updated_at`) VALUES
(4, 'tentangkami/zSl3A9yWQxc00b3nbcyu0F64kLMDGSv1uPU0UxVp.png', 'Catering Nikmat Rasa menyediakan nasi box dan snack box untuk berbagai acara seperti ulang tahun, arisan, syukuran, hingga acara kantor. Menu utama kami mencakup nasi bakar, nasi liwet, nasi ayam geprek, nasi kebuli, nasi tumpeng, dan banyak lagi, lengkap dengan sayur dan sambal khas. Dengan pengalaman lebih dari 10 tahun melayani area Jabodetabek, kami siap menerima pesanan besar maupun kecil dengan rasa lezat, porsi pas, dan harga terjangkau. Hubungi kami sekarang untuk hidangan terbaik di acara Anda!', '2025-05-29 08:02:06', '2025-06-07 10:47:48');

-- Data untuk tabel transaksis
INSERT IGNORE INTO `transaksis` (`id`, `nama_admin`, `nama_pelanggan`, `tanggal_transaksi`, `id_transaksi`, `jenis_tindakan`, `deskripsi_tindakan`, `total_harga`, `status_transaksi`, `bukti_pembayaran`, `created_at`, `updated_at`) VALUES
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
(143, 'System', 'ban user', '2025-06-08 09:11:36', 'DANA-1749373896', 'Pembayaran DANA', 'Pembayaran via DANA', 19000.00, 'Menunggu Konfirmasi', 'payment_proofs/psGs7JiLNxplETQUAaaKEs7GF4WQwi7Z2fiTExM4.jpg', '2025-06-08 02:11:36', '2025-06-08 02:11:36');

-- Enable foreign key checks kembali
SET FOREIGN_KEY_CHECKS=1;

COMMIT;