-- Data Only SQL - Ujilevel Catering Kita (SAFE MODE)
-- Menggunakan INSERT IGNORE untuk menghindari duplicate entry

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Disable foreign key checks untuk import yang aman
SET FOREIGN_KEY_CHECKS=0;

-- Data untuk tabel admin_profiles (menggunakan INSERT IGNORE)
INSERT IGNORE INTO `admin_profiles` (`id`, `user_id`, `phone`, `bio`, `created_at`, `updated_at`) VALUES
(1, 1, '', 'Hello guys', '2025-04-29 00:17:07', '2025-04-29 00:17:07');

-- Data untuk tabel users (menggunakan INSERT IGNORE)
INSERT IGNORE INTO `users` (`id`, `name`, `first_name`, `last_name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `usertype`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin cateringkita', NULL, NULL, 'budisosial1@gmail.com', NULL, NULL, NULL, '$2y$12$EngY7DbJRTs6KcorA3ZimuYY3pLUAT4lhBKGGp8nBd.wMYZbQJorS', 'admin', NULL, '2025-04-27 08:40:19', '2025-04-28 09:21:54'),
(2, 'user ganteng', NULL, NULL, 'user@gmail.com', NULL, NULL, NULL, '$2y$12$CGaq86otXiAWuI6hRBjexu4P.Na2yYasE2z5WgAz.BZwv563r2SRC', 'user', NULL, '2025-04-27 21:10:52', '2025-04-27 21:10:52'),
(3, 'budi user', NULL, NULL, 'budiuser@gmail.com', NULL, NULL, NULL, '$2y$12$rfZ6Jj0v88rhy/8BlEZDUuI5LI.2ZucDhyvWo2P1BVB2Aq/e.Kk0G', 'user', 'bOj9hMhOvsyZQeLCiRpdim6fYfluENPqaYpQWCjIKvzgsqTHvheYqx49upIc', '2025-04-29 17:49:23', '2025-04-29 17:49:23'),
(4, 'anton pratama', NULL, NULL, 'antonpratama1@gmail.com', NULL, NULL, NULL, '$2y$12$2oJwjzWC/E/a/HXPDujoquezHqK5Y9j0p7vcuuyBCNbeYLc10PFG6', 'user', 'yvJ1ePkSo4J5y7D5ReVNraaACtraTi1MkODaQ3EdKCVe4LOBSpsl70fvB1UN', '2025-04-29 20:11:08', '2025-04-29 20:11:08'),
(5, 'anton manatap', NULL, NULL, 'antonpratama@gmail.com', NULL, NULL, NULL, '$2y$12$lpVtYlwES.VIxsREBeIM2.4NWv9xCNGLR2bEv5de8qHGJElyezLne', 'user', NULL, '2025-04-29 21:02:39', '2025-04-29 21:02:39'),
(6, 'admin admina', NULL, NULL, 'admincateringkita@gmail.com', NULL, NULL, NULL, '$2y$12$1AwxaLYcNURjtKIGV5Zl3.WwcErKa7prpkuVDSskhCli74L4Ez0c2', 'user', NULL, '2025-05-27 07:02:59', '2025-05-27 07:02:59'),
(7, 'Gibran Tes', NULL, NULL, 'ban@gmail.com', NULL, NULL, NULL, '$2y$12$VQkwtGwd0wySLXrDc9sUaegHBPzr3KbV/dSrZ0OkFexsgVYsp2NHa', 'admin', 'YcunWiPAffDUuL6WPVunp09pphpuY2VittVO3iooH4bWa0PKTO8k5HE5424t', '2025-06-03 09:20:50', '2025-06-03 09:20:50'),
(8, 'ban user', NULL, NULL, 'banuser@gmail.com', NULL, NULL, NULL, '$2y$12$m1vBXGmLrkv.3GNbYK1ugubyW.Gdxw4w8cYlLlTJuq8obinNvIvTe', 'user', NULL, '2025-06-03 09:23:20', '2025-06-03 09:23:20');

-- Data untuk tabel daftar_pesanans (menggunakan INSERT IGNORE)
INSERT IGNORE INTO `daftar_pesanans` (`id`, `order_id`, `nama_pelanggan`, `user_id`, `kategori_pesanan`, `kelola_makanan_id`, `tanggal_pesanan`, `jumlah_pesanan`, `tanggal_pengiriman`, `waktu_pengiriman`, `lokasi_pengiriman`, `nomor_telepon`, `pesan`, `opsi_pengiriman`, `total_harga`, `status_pengiriman`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(99, 'ORD1745981486436920', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-04-29 19:51:26', 20, '2025-05-01', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang wjnk', 'regular', 250000.00, 'diproses', 'pending', '2025-04-29 19:51:27', '2025-04-29 19:51:27'),
(100, 'ORD1745981679193113', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-04-29 19:54:39', 20, '2025-05-01', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang enaka', 'instant', 260000.00, 'diproses', 'pending', '2025-04-29 19:54:39', '2025-04-29 19:54:39'),
(101, 'ORD1745983154093751', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-04-29 20:19:14', 30, '2025-05-12', '12:00:00', 'ciomas bogor kota', '+62 898 8049 488', 'yang banyak yaa', 'instant', 380000.00, 'diproses', 'pending', '2025-04-29 20:19:15', '2025-04-29 20:19:15'),
(102, 'ORD1746151342333408', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-05-01 19:02:22', 30, '2025-05-03', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang enak', 'instant', 380000.00, 'diproses', 'pending', '2025-05-01 19:02:23', '2025-05-01 19:02:23'),
(103, 'ORD1746151520036715', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-05-01 19:05:20', 30, '2025-05-03', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang enak', 'instant', 370000.00, 'diproses', 'pending', '2025-05-01 19:05:20', '2025-05-01 19:05:20'),
(104, 'ORD1746163623394934', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-05-01 22:27:03', 100, '2025-05-03', '15:00:00', 'ciomas', '+62 881 0115 62638', 'yang enak', 'instant', 3510000.00, 'diproses', 'pending', '2025-05-01 22:27:03', '2025-05-01 22:27:03'),
(105, 'ORD1746169557480519', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-05-02 00:05:57', 100, '2025-05-03', '15:00:00', 'ciomas', '+62 881 0115 62638', 'adjand', 'instant', 3510000.00, 'diproses', 'pending', '2025-05-02 00:05:57', '2025-05-02 00:05:57'),
(106, 'ORD1746169918635861', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-05-02 00:11:58', 100, '2025-05-03', '15:00:00', 'ciomas', '+62 881 0115 62638', 'diknaakdnadakdnakdk', 'instant', 3510000.00, 'diproses', 'pending', '2025-05-02 00:11:59', '2025-05-02 00:11:59'),
(107, 'ORD1746170666650851', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-05-02 00:24:26', 101, '2025-05-05', '16:23:00', 'egregefe', '+62 881 0115 62638', 'dfdgg', 'instant', 3522000.00, 'dikirim', 'pending', '2025-05-02 00:24:27', '2025-06-04 09:24:18'),
(108, 'ORD1746420653473520', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-05-04 21:50:53', 101, '2025-05-07', '15:00:00', 'sokdlsamdkasjkasd', '+62 837 7362 7232', 'wilkkahsmamaj', 'instant', 3522000.00, 'dikirim', 'pending', '2025-05-04 21:50:53', '2025-06-04 08:30:48'),
(109, 'ORD174832049884497', 'admin cateringkita', 1, 'Lainnya', NULL, '2025-05-26 21:34:58', 102, '2025-05-28', '15:00:00', 'adaidmadn', '+62 898 2632 367', 'adnkadnad', 'instant', 3534000.00, 'diterima', 'pending', '2025-05-26 21:34:59', '2025-06-04 08:28:15'),
(110, 'ORD174897122950664', 'ban user', 8, 'Lainnya', NULL, '2025-06-03 10:20:29', 1, '2025-06-05', '11:22:00', 'lsahKskldhfalkdjshfldkasjhflsdfdsfd', '+62 895 4949 94999', 'vgfgagagggggggggggggggggggggggggga', 'instant', 22000.00, 'diterima', 'pending', '2025-06-03 10:20:29', '2025-06-04 04:50:44'),
(115, 'ORD1749051106434239', 'ban user', 8, 'Lainnya', NULL, '2025-06-03 17:00:00', 2, '2025-06-13', '15:32:00', 'rwererrwerwewerwerwerewrwerewewewewerwrewr', '089539298232', 'fsfasaffgsahfgfbfbsbfd', 'instant', 34000.00, 'diterima', 'pending', '2025-06-04 08:31:51', '2025-06-04 09:24:39'),
(116, 'ORD1749052811367896', 'ban user', 8, 'Lainnya', NULL, '2025-06-03 17:00:00', 2, '2025-06-05', '14:01:00', 'lalalalalalalalalalalalalalalallaal', '089539298232', 'kokoookokokokokokokokokokookokkookkokookookkookkokokokp', 'economy', 26000.00, 'diterima', 'pending', '2025-06-04 09:00:17', '2025-06-04 09:17:23'),
(117, 'ORD1749053890012128', 'ban user', 8, 'Lainnya', NULL, '2025-06-03 17:00:00', 2, '2025-06-16', '15:17:00', 'Bogor', '089539298232', 'leci', 'instant', 34000.00, 'diterima', 'pending', '2025-06-04 09:18:14', '2025-06-04 09:24:34'),
(119, 'ORD1749144441258577', 'ban user', 8, 'Lainnya', NULL, '2025-06-04 17:00:00', 2, '2025-06-11', '16:27:00', 'dasdasdasdsa', '0895494994999', 'opsional', 'regular', 29000.00, 'diterima', 'pending', '2025-06-05 10:27:25', '2025-06-05 10:29:19'),
(120, 'ORD1749155597714981', 'ban user', 8, 'Lainnya', NULL, '2025-06-04 17:00:00', 1, '2025-06-14', '08:33:00', 'jkk', '0895392982328', 'jkghj', 'instant', 22000.00, 'diterima', 'pending', '2025-06-05 13:33:22', '2025-06-06 12:48:18'),
(121, 'ORD1749240164741910', 'ban user', 8, 'Lainnya', NULL, '2025-06-05 17:00:00', 1, '2025-06-25', '11:02:00', 'MDTV', '087652552114', 'TRANS TV', 'instant', 22000.00, 'diterima', 'pending', '2025-06-06 13:02:50', '2025-06-06 13:08:24');

-- Data untuk tabel karyawan (menggunakan INSERT IGNORE)
INSERT IGNORE INTO `karyawan` (`id`, `nama_karyawan`, `username_karyawan`, `posisi`, `kontak`, `tanggal_bergabung`, `status`, `keahlian`, `created_at`, `updated_at`) VALUES
(1, 'wildan', 'wildansyah23', 'office boy', '08981323242321', '2025-04-02', 'Cuti', 'membersihkan ruangan dengan cepat', '2025-04-27 09:01:59', '2025-04-29 02:16:50');

-- Data untuk tabel kategoris
INSERT INTO `kategoris` (`id`, `nama_kategori`, `deskripsi`, `jumlah_item`, `created_at`, `updated_at`) VALUES
(3, 'Prasmanan', 'Hidangan lengkap dengan berbagai prasmanan untuk berbagai acara', 9, '2025-04-29 02:14:45', '2025-04-29 02:14:45'),
(4, 'Nasi Box', 'Paket nasi lengkap dalam kotak untuk berbagai praktis', 6, '2025-04-29 02:15:15', '2025-04-29 02:15:15');

-- Data untuk tabel kelola_makanans
INSERT INTO `kelola_makanans` (`id`, `nama_makanan`, `kategori`, `harga`, `status`, `deskripsi`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Ayam Geprek', 'Prasmanan', 12000.00, 'Tersedia', 'Nikmati sensasi pedas dan gurih dari Ayam Geprek Sambal Bawang, perpaduan ayam crispy yang digeprek dengan sambal bawang khas, memberikan cita rasa pedas yang menggoda. Disajikan dengan nasi putih hangat dan irisan mentimun segar, menjadikannya pilihan sempurna untuk pecinta makanan pedas.', 'images/5fSVaTecLpJTXCwjZqPkyRLLm1Sbd2lCuM4n8QzM.png', '2025-04-29 11:24:44', '2025-05-01 20:09:13'),
(2, 'Ayam Kecap', 'Prasmanan', 9000.00, 'Tersedia', 'Lezatnya Ayam Kecap Spesial, ayam empuk yang dimasak dengan saus kecap khas, menciptakan cita rasa manis, gurih, dan kaya rempah. Potongan ayam yang meresap sempurna dalam bumbu kecap ini siap menemani santapanmu dengan nasi putih hangat.', 'images/2U1Gn90AgLNdcljVLgqGjq5xfrZSGNLK4BzrTHqU.jpg', '2025-04-29 11:27:12', '2025-05-01 20:10:19'),
(3, 'Ikan Bunjaer Gulai', 'Prasmanan', 15000.00, 'Tersedia', 'Nikmati kelezatan Gulai Ikan Bunjair, perpaduan ikan segar dengan kuah kuning khas yang kaya rempah. Ditambah dengan potongan nanas yang memberikan sensasi segar dan sedikit asam, menciptakan rasa yang unik dan menggugah selera. Cocok disantap dengan nasi putih hangat untuk pengalaman kuliner yang lebih sempurna.', 'images/CDDpthDSPmtwhgPfRsibihW9NNXWYQGkOxA2sSnC.png', '2025-04-29 11:28:06', '2025-05-01 20:31:10'),
(4, 'Cumi Balado', 'Prasmanan', 12000.00, 'Tersedia', 'Rasakan sensasi pedas dan gurih dari Cumi Sambal Balado, hidangan khas dengan cumi segar yang dimasak dengan sambal balado merah menggugah selera. Perpaduan rasa pedas, manis, dan gurih membuat hidangan ini cocok dinikmati dengan nasi putih hangat.', 'images/Mcg4Pys6Uji8d7QxKkzSPIRnwIMgxvcy3kiHpTjT.png', '2025-04-29 11:28:51', '2025-05-01 20:36:28'),
(5, 'Ikan Bunjaer Goreng', 'Prasmanan', 10000.00, 'Tersedia', 'Nikmati kelezatan Ikan  Bunjaer Goreng, ikan segar yang digoreng hingga keemasan dengan tekstur luar yang renyah dan daging yang lembut di dalam. Disajikan dengan irisan tomat, daun selada, dan jeruk nipis untuk menambah kesegaran rasa. Cocok disantap dengan nasi putih hangat dan sambal favoritmu!', 'images/4TEDoJtXdMcmzQaop6vohr8NrjnqzgIRqbttt5U4.jpg', '2025-04-29 11:30:11', '2025-05-01 20:36:51'),
(6, 'Kentang Balado', 'Prasmanan', 5000.00, 'Tersedia', 'Kombinasi sempurna dari Kentang Balado, hidangan khas dengan kentang yang dipotong dadu dan digoreng hingga renyah, dipadukan dengan teri goreng yang gurih, serta dibalut dalam sambal merah pedas manis yang menggugah selera. Cocok sebagai lauk pendamping atau camilan pedas favorit!', 'images/SuIqcViIbmL0yZiScXvis2Cd5GyyBtBlb0ziri76.png', '2025-04-29 11:31:16', '2025-05-01 20:37:04'),
(7, 'Tempe Orek', 'Prasmanan', 5000.00, 'Tersedia', 'Gurih dan manisnya Tempe Orek Kering, hidangan tradisional yang dibuat dari tempe yang dipotong tipis dan digoreng hingga renyah, kemudian dimasak dengan bumbu kecap manis, cabai merah, dan daun jeruk yang memberikan aroma khas. Cocok sebagai lauk pendamping atau camilan gurih yang nikmat!', 'images/o86q3EoQQZ0MCNW1WwP6td1GblUBjWTFfaBhrRdd.png', '2025-04-29 11:32:04', '2025-05-01 20:37:18'),
(8, 'Ayam Goreng', 'Prasmanan', 8000.00, 'Tersedia', 'Nikmati kelezatan Ayam Goreng , ayam pilihan yang dimarinasi dengan bumbu khas, kemudian digoreng hingga kulitnya renyah dengan daging yang tetap juicy. Aroma rempah yang kuat membuat hidangan ini semakin menggugah selera. Cocok disantap dengan nasi hangat dan sambal favorit!', 'images/37ZWwLWseO3X4ymLeJtQbm03WKYJE05iRrUV4nAO.png', '2025-04-29 11:32:44', '2025-05-01 20:37:33'),
(9, 'Telur Balado', 'Prasmanan', 5000.00, 'Tersedia', 'Pedas, gurih, dan nikmat! Telur Balado adalah hidangan khas Nusantara yang terbuat dari telur rebus yang digoreng sebentar untuk tekstur yang lebih lezat, lalu dibalut dengan sambal balado yang kaya rasa. Perpaduan sempurna antara pedas, manis, dan sedikit asam dari cabai merah segar membuat hidangan ini cocok sebagai lauk utama atau pelengkap makanan favoritmu!', 'images/JhpUVUVkzDEjVeJI5wduDXvGVSNcNQ0r318QcecM.jpg', '2025-04-29 11:33:26', '2025-05-01 20:11:07'),
(10, 'Capcay Goreng', 'Prasmanan', 9000.00, 'Tersedia', 'Sehat, segar, dan penuh gizi! Capcay Goreng adalah hidangan khas oriental yang berisi beragam sayuran segar yang ditumis dengan bumbu gurih khas. Dilengkapi dengan bakso dan jamur untuk menambah cita rasa yang lezat dan tekstur yang kaya. Cocok untuk dinikmati sendiri atau sebagai pendamping menu favoritmu!', 'images/iqC18zI7UGBMADNQII06WTijFiAjYDFXmaK8X8TJ.png', '2025-04-29 11:33:59', '2025-05-01 20:37:44'),
(11, 'Bihun Goreng', 'Prasmanan', 9000.00, 'Tersedia', 'Nikmati kelezatan Bihun Goreng Spesial, bihun yang ditumis dengan bumbu gurih khas dan dipadukan dengan berbagai bahan pilihan. Teksturnya yang lembut berpadu sempurna dengan rasa yang kaya, menciptakan sajian yang menggugah selera!', 'images/48E66lDKhZCAbvEcv13GK9Yfs3nQqrhennCo3ORi.png', '2025-04-29 11:34:32', '2025-05-01 20:37:56'),
(13, 'Paket Nasi Ayam Bakar Spesial', 'Nasi Box', 35000.00, 'Tersedia', 'Nikmati hidangan lezat dengan kombinasi sempurna antara nasi hangat berbumbu, ayam bakar yang empuk dengan cita rasa gurih dan sedikit manis, serta pelengkap yang menyegarkan!', 'images/htSf1ctWYeXUkNcD9099YhrttUatFJO0I9knpLWk.png', '2025-04-29 11:46:55', '2025-05-01 20:55:21'),
(14, 'Paket Nasi Kuning Ayam Spesial', 'Nasi Box', 35000.00, 'Tersedia', 'Nikmati hidangan spesial dengan perpaduan sempurna antara nasi kuning gurih dan lauk pendamping yang menggugah selera. Sajian lezat ini menghadirkan cita rasa autentik khas Indonesia!', 'images/2ZTJQUMMkKzsdtYLPp7Rbqty6FKGxa3swJDLuBvw.png', '2025-04-29 11:47:57', '2025-05-01 21:07:58'),
(15, 'Paket Nasi Ayam & Rendang Spesial', 'Nasi Box', 30000.00, 'Tersedia', 'Nikmati perpaduan sempurna antara ayam goreng kremes yang gurih dan rendang daging sapi yang kaya rempah. Disajikan dengan nasi putih pulen dan aneka lauk pendamping yang menggugah selera, hidangan ini menghadirkan cita rasa autentik khas Nusantara!', 'images/GLQGW8znMlpDzmU0ixZp2EAC0OOc9twNVLVv3rU2.png', '2025-04-29 11:48:57', '2025-05-01 21:08:21'),
(16, 'Paket Nasi Ikan Premium', 'Nasi Box', 35000.00, 'Tersedia', 'Nikmati sensasi gurih dan pedas dari Ikan Bakar Sambal Pedas, sajian lezat dengan ikan bakar yang dipanggang sempurna dan dilumuri sambal khas yang menggugah selera. Dilengkapi dengan nasi putih hangat, tahu dan tempe goreng, lalapan segar, serta sambal tambahan, menciptakan perpaduan rasa yang nikmat di setiap suapan.', 'images/vBCmcNF2DnNB0bynqC23p7ZNoZsy5NSCqHUi599P.png', '2025-04-29 11:49:34', '2025-05-01 21:08:46'),
(17, 'Paket Nasi Kotak Spesial', 'Nasi Box', 30000.00, 'Tersedia', 'Nikmati hidangan lezat dengan kombinasi sempurna antara nasi hangat berbumbu, ayam bakar yang empuk dengan cita rasa gurih dan sedikit manis, serta pelengkap yang menyegarkan!', 'images/AkemP3OmaRC0ryRu3d7WrOsg08uQb4VIog5bpIjh.png', '2025-04-29 11:50:40', '2025-05-01 21:09:00'),
(18, 'Paket Nasi Ayam Bakar Spesial', 'Nasi Box', 40000.00, 'Tersedia', 'Nikmati hidangan lezat dengan kombinasi sempurna antara nasi hangat berbumbu, ayam bakar yang empuk dengan cita rasa gurih dan sedikit manis, serta pelengkap yang menyegarkan!', 'images/B0xdd9w7P7r7qI0ScwcqVQztYZDKagH7F2avUiqh.png', '2025-04-29 11:51:23', '2025-05-01 21:09:43');

-- Data untuk tabel keranjangs
INSERT INTO `keranjangs` (`id`, `user_id`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3548000.00, 'active', '2025-04-27 08:40:57', '2025-05-27 01:12:04'),
(2, 2, 25000.00, 'active', '2025-04-27 21:11:21', '2025-04-29 17:35:32'),
(3, 3, 1296000.00, 'active', '2025-04-29 17:49:47', '2025-04-29 17:50:00'),
(4, 4, 81000.00, 'active', '2025-04-29 21:06:35', '2025-05-29 23:27:52'),
(5, 8, 12000.00, 'active', '2025-06-03 09:24:52', '2025-06-05 10:40:40');

-- Data untuk tabel keranjang_items
INSERT INTO `keranjang_items` (`id`, `keranjang_id`, `nama_produk`, `price`, `quantity`, `image`, `created_at`, `updated_at`) VALUES
(4, 2, 'Paket Nasi Kotak Premium A', 25000.00, 1, 'http://127.0.0.1:8000/assets/paketassets1.png', '2025-04-27 21:11:21', '2025-04-27 21:11:21'),
(14, 3, 'Ayam Geprek', 12000.00, 108, '/storage/images/F4pQodn3T2Bb97IfMWbj2NzU9SwKHdzwMOTJkIVP.jpg', '2025-04-29 17:49:47', '2025-04-29 17:49:59'),
(16, 1, 'Paket Nasi Ayam Bakar Spesial', 35000.00, 100, '/storage/images/htSf1ctWYeXUkNcD9099YhrttUatFJO0I9knpLWk.png', '2025-05-01 22:26:31', '2025-05-01 22:26:31'),
(17, 1, 'Ayam Geprek', 12000.00, 4, '/storage/images/5fSVaTecLpJTXCwjZqPkyRLLm1Sbd2lCuM4n8QzM.png', '2025-05-02 00:22:16', '2025-05-27 01:12:04'),
(18, 4, 'Ayam Kecap', 9000.00, 9, '/storage/images/2U1Gn90AgLNdcljVLgqGjq5xfrZSGNLK4BzrTHqU.jpg', '2025-05-26 00:44:23', '2025-05-28 00:34:18'),
(20, 5, 'Ayam Geprek', 12000.00, 1, '/storage/images/5fSVaTecLpJTXCwjZqPkyRLLm1Sbd2lCuM4n8QzM.png', '2025-06-03 09:24:52', '2025-06-05 10:40:40');

-- Data untuk tabel laporans
INSERT INTO `laporans` (`id`, `tanggal`, `jenis_laporan`, `laporan`, `deskripsi`, `total`, `admin`, `status`, `created_at`, `updated_at`) VALUES
(1, '2025-04-29', 'Harian', 'Pendapatan Harian', 'Pendapatan dari pesanan catering', 0.00, 'admin cateringkita', 'males', '2025-04-28 22:33:08', '2025-04-29 02:27:07');

-- Data untuk tabel metode_pembayarans
INSERT INTO `metode_pembayarans` (`id`, `metode_pembayaran`, `deskripsi`, `status`, `admin`, `created_at`, `updated_at`) VALUES
(3, 'BCA', 'Pembayaran via Transfer Bank', 'Aktif', 'Admin 1', '2025-04-29 02:32:44', '2025-04-29 02:32:44'),
(4, 'Dana', 'Pembayaran via E-wallet', 'Aktif', 'admin 1', '2025-04-29 02:33:15', '2025-04-29 02:33:15'),
(5, 'Gopay', 'Pembayaran via Gopay', 'Aktif', 'admin 1', '2025-04-29 02:33:39', '2025-04-29 02:33:39'),
(6, 'COD', 'Pembayaran dilakukan di tempat saat pesanan diterima(wajib membayar dp 35% saat memesan)', 'Aktif', 'admin 1', '2025-04-29 02:34:25', '2025-04-29 02:35:31');

-- JANGAN IMPORT DATA MIGRATIONS - Laravel akan mengelola sendiri

-- Data untuk tabel profiles
INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `phone`, `address`, `bio`, `created_at`, `updated_at`) VALUES
(1, 1, 'budi', 'sosial', '0881011562638', 'ciomas bogor kota', 'hello guys', '2025-04-27 08:40:19', '2025-04-28 09:27:16'),
(2, 2, 'user', 'catering', '0881011562638', 'ciomas bogor kota', NULL, '2025-04-27 21:10:52', '2025-04-29 07:52:23'),
(3, 3, 'budi', 'user', '0881011562638', 'ciomas bogor kota', NULL, '2025-04-29 17:49:23', '2025-04-29 17:49:23'),
(4, 4, 'anton', 'pratama', '08988049488', 'ciomas bogor kota', NULL, '2025-04-29 20:11:08', '2025-04-29 20:11:08'),
(5, 5, 'anton', 'manatap', '0881011562638', 'ciomas bogor', NULL, '2025-04-29 21:02:39', '2025-04-29 21:02:39'),
(6, 6, 'admin', 'admina', '0881011562638', 'adakdakdmad', NULL, '2025-05-27 07:02:59', '2025-05-27 07:02:59'),
(7, 7, 'Gibran', 'Tes', '0895392982328', 'Di daerah bogor raya', NULL, '2025-06-03 09:20:51', '2025-06-03 09:20:51'),
(8, 8, 'dan', 'user', '0895387455678', 'fsdaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', NULL, '2025-06-03 09:23:20', '2025-06-03 09:23:20');

-- Data untuk tabel reviews
INSERT INTO `reviews` (`id`, `user_id`, `order_id`, `order_number`, `quality_rating`, `delivery_rating`, `service_rating`, `average_rating`, `review_text`, `photos`, `status`, `is_verified`, `reviewed_at`, `created_at`, `updated_at`) VALUES
(2, 8, 119, 'ORD1749144441258577', 5, 5, 5, 5.0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id elit tellus. Donec rutrum a quam pulvinar dignissim. Nam ultricies nibh ut arcu dignissim aliquam. Aliquam consequat condimentum odio sed auctor. Maecenas eu sagittis risus, ac consequat arcu. Maecenas vehicula dignissim lectus, et luctus ipsum blandit quis. Maecenas vestibulum non mauris a congue. Nulla ut imperdiet ante, et facilisis sapien. Sed sed egestas diam, sit amet molestie nunc. Aenean ornare auctor est, vel faucibus elit molestie et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec venenatis lectus dui, nec imperdiet purus luctus quis.', '[]', 'active', 0, '2025-06-05 12:56:23', '2025-06-05 12:56:23', '2025-06-05 12:56:23'),
(3, 8, 117, 'ORD1749053890012128', 5, 5, 5, 5.0, 'Woi Jala Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id elit tellus. Donec rutrum a quam pulvinar dignissim. Nam ultricies nibh ut arcu dignissim aliquam. Aliquam consequat condimentum odio sed auctor. Maecenas eu sagittis risus, ac consequat arcu. Maecenas vehicula dignissim lectus, et luctus ipsum blandit quis. Maecenas vestibulum non mauris a congue. Nulla ut imperdiet ante, et facilisis sapien. Sed sed egestas diam, sit amet molestie nunc. Aenean ornare auctor est, vel faucibus elit molestie et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec venenatis lectus dui, nec imperdiet purus luctus quis.', '[\"reviews/rf4sLqKNDOdhEd4X8SgihhL7FU33GDrxII1tgsgy.png\", \"reviews/x6zZGwAHYcEcxFC8tLeQtC2oS4FFIIw4IdHo6v1b.png\"]', 'active', 0, '2025-06-05 12:59:55', '2025-06-05 12:59:55', '2025-06-05 12:59:55'),
(4, 8, 116, 'ORD1749052811367896', 5, 5, 5, 5.0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id elit tellus. Donec rutrum a quam pulvinar dignissim. Nam ultricies nibh ut arcu dignissim aliquam. Aliquam consequat condimentum odio sed auctor. Maecenas eu sagittis risus, ac consequat arcu. Maecenas vehicula dignissim lectus, et luctus ipsum blandit quis. Maecenas vestibulum non mauris a congue. Nulla ut imperdiet ante, et facilisis sapien. Sed sed egestas diam, sit amet molestie nunc. Aenean ornare auctor est, vel faucibus', '[\"reviews/tkP6Gn3T4r1y8vwJFFj17ix4pGVJYJdukdIRzF1g.png\"]', 'active', 0, '2025-06-06 10:28:21', '2025-06-06 10:28:21', '2025-06-06 10:28:21');

-- Data untuk tabel status_pengirimen
INSERT INTO `status_pengirimen` (`id`, `nama_pembeli`, `nama_produk`, `tanggal_transaksi`, `status_pengiriman`, `created_at`, `updated_at`) VALUES
(1, 'wabak', 'ayam', '2025-04-28', 'Dikirim', '2025-04-27 21:04:11', '2025-04-27 21:04:11');

-- Data untuk tabel tentang_kami
INSERT INTO `tentang_kamis` (`id`, `foto`, `deskripsi`, `created_at`, `updated_at`) VALUES
(4, 'tentangkami/GpbyZZJ1ZxFEJbcTPqGyZVSEiCZoRtoi5gtmNtqA.png', 'mantap', '2025-05-29 08:02:06', '2025-05-29 08:02:06');

-- Data untuk tabel transaksis
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
(136, 'System', 'ban user', '2025-06-06 20:03:04', 'BCA-1749240184', 'Pembayaran BCA', 'Pembayaran via BCA', 22000.00, 'Menunggu Konfirmasi', 'payment_proofs/7jg6TD2ra5CH0C5rLNxqU3jcoeqB3hrGZxRrDh2r.png', '2025-06-06 13:03:04', '2025-06-06 13:03:04');

-- Enable foreign key checks kembali
SET FOREIGN_KEY_CHECKS=1;

COMMIT;