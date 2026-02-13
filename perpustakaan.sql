-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 13, 2026 at 06:39 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `stok` int DEFAULT '0',
  `penulis` varchar(100) DEFAULT NULL,
  `tahun_terbit` year DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `pengarang`, `penerbit`, `tahun`, `stok`, `penulis`, `tahun_terbit`, `created_at`) VALUES
(2, 'gonggong', 'arip', 'pt gokgok', 2000, 11, NULL, NULL, '2026-02-13 03:23:30'),
(3, 'weqeq', 'kiki', 'pt ancur', 1995, 12, NULL, NULL, '2026-02-13 03:23:51'),
(4, 'kwioawk', 'sdaad', 'asdad', 11, 110, NULL, NULL, '2026-02-13 05:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int NOT NULL,
  `id_user` int NOT NULL,
  `id_buku` int NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status` enum('pinjam','kembali') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `id_user` int NOT NULL,
  `id_buku` int NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') DEFAULT 'dipinjam',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_buku`, `tgl_pinjam`, `tgl_kembali`, `status`, `created_at`) VALUES
(4, 7, 3, '2026-02-13', '2026-02-13', 'dikembalikan', '2026-02-13 03:58:22'),
(5, 7, 2, '2026-02-13', '2026-02-13', 'dikembalikan', '2026-02-13 03:58:31'),
(6, 7, 3, '2026-02-13', '2026-02-13', 'dikembalikan', '2026-02-13 04:00:37'),
(7, 7, 2, '2026-02-13', '2026-02-13', 'dikembalikan', '2026-02-13 04:00:44'),
(8, 7, 3, '2026-02-13', '2026-02-13', 'dikembalikan', '2026-02-13 04:00:57'),
(9, 7, 3, '2026-02-13', '2026-02-13', 'dikembalikan', '2026-02-13 04:58:45'),
(10, 7, 4, '2026-02-13', '2026-02-13', 'dikembalikan', '2026-02-13 05:07:23'),
(11, 7, 4, '2026-02-13', '2026-02-13', 'dikembalikan', '2026-02-13 05:39:15'),
(12, 7, 4, '2026-02-13', NULL, 'dipinjam', '2026-02-13 05:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('admin','siswa') NOT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `role`, `kelas`, `created_at`) VALUES
(1, 'admin1', '$2y$10$abcd1234EfGh5678ijkl9012MNop345678qrstuvWxYzABcDEFghi', 'Administrator 1', 'admin', NULL, '2026-02-13 02:31:09'),
(2, 'Admin', '$2y$10$3.gEyDQ1jTqQDHbaEW7P8O8aPQ900LubwVM.8T6fTD6jDFaehnfVO', 'jaya', 'admin', NULL, '2026-02-13 02:34:30'),
(3, 'gokgok', '$2y$10$6bTW00QFZRN.DkPxhktPwO8uXAgWe0K2ToOigIZkzZwcOzWNt6pnC', 'awawow', 'siswa', '12 rpl', '2026-02-13 02:38:26'),
(6, 'raka', '$2y$10$/stZBYOFtACwDM3a5xB00eYPq0wJDScER7z7b8JVwVESMeTjhUOiW', 'raka', 'admin', NULL, '2026-02-13 02:55:45'),
(7, 'jaya', '$2y$10$67PGmBi9U4vZMJZaIXXUeuyiFlzYbe2BsJdVuxIQ1zgHW9o0tBgdO', 'jaya', 'siswa', '12 rpl', '2026-02-13 03:48:11'),
(8, 'kingkong', '$2y$10$ck.xD3X4bEZO8V3DUmtgE.XrvHo5/.HB.MN3QfDcFXVUWl4EKkqe2', 'kingkong badan nya besar', 'siswa', '12 RPL', '2026-02-13 06:14:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD CONSTRAINT `riwayat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `riwayat_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
