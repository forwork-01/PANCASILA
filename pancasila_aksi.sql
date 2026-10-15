-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2026 at 04:38 PM
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
-- Database: `pancasila_aksi`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kegiatan` text NOT NULL,
  `sila` tinyint(4) NOT NULL,
  `pengalaman` text DEFAULT NULL,
  `perasaan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `user_id`, `tanggal`, `kegiatan`, `sila`, `pengalaman`, `perasaan`, `foto`, `created_at`) VALUES
(6, 3, '2026-10-11', 'Menolong teman yang kesulitan', 2, 'Teman berterima kasih.', 'Senang bisa berguna.', NULL, '2026-10-14 16:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('siswa','guru') NOT NULL,
  `kelas` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `kelas`, `created_at`) VALUES
(1, 'Intan Purnama Sari,S.Pd', 'guru', '$2y$10$viRkJzFE.FF2HYSm04pb9e6CDlkciYRh9UEqLiHZwVdaZweygvYZK', 'guru', 'X MPLB 3', '2026-10-14 16:25:34'),
(3, 'Budi Santoso', 'budi', 'siswa123', 'siswa', 'X IPA 1', '2026-10-14 16:25:34'),
(4, 'Siti Aisyah', 'siti', 'siswa123', 'siswa', 'X IPA 1', '2026-10-14 16:25:34'),
(6, 'AIRYN PRICILIYA NDRAHA', 'AIRYN', '$2y$10$vgN4oZyNiutkgi6E26b8sOvYTrpFR8fLxUbkabbVH68onkPQQdLXu', 'siswa', 'X MPLB 3', '2026-10-14 17:50:07'),
(7, 'ALFIKRI RAHMADAN', 'FIKRI', '$2y$10$YtYXOfQAaxP5yYjQLSbwouVFEl6.RfATaQ3hr3ZNb4l1XpyT.duDW', 'siswa', 'X MPLB 3', '2026-10-14 17:50:56'),
(8, 'ALITA SAYUTI', 'ALITA', '$2y$10$55.2641fFIk1ZEvdgk0og.7wFzc6ED2FHq7n6iKl9cG7I9iP1Vq/.', 'siswa', 'X MPLB 3', '2026-10-14 17:51:29'),
(9, 'ANNISA AL MAGHFIROH', 'ANNISA', '$2y$10$PvGKC3Cl4YTNvF.nXx/P8O66.iPdB8kWzr.CH6vdTwY40MWsfU.G2', 'siswa', 'X MPLB 3', '2026-10-14 17:52:09'),
(10, 'CINTIA MARISKA', 'CINTIA', '$2y$10$6PE2Rnh6vse5XbBG46Wdle0X50TP6whXdx832jaALbxOqzo.OoHEO', 'siswa', 'X MPLB 3', '2026-10-14 17:52:47'),
(11, 'FAIZAH ALMIRA', 'FAIZAH', '$2y$10$Z8rsWtIau5KdzD15kbfn0O1KOnQlSglULKJIxu6ffSBWAYsogeKD2', 'siswa', 'X MPLB 3', '2026-10-14 17:53:55'),
(12, 'FARIZ WERY HANAFI', 'FARIZ', '$2y$10$aYAkOymJ7DJjzMWNbyZDieiCjfUK0zwLJgzjQ./0z8tvP1X6i7fkK', 'siswa', 'X MPLB 3', '2026-10-14 17:54:29'),
(13, 'FELISA OKTAVIANI', 'FELISA', '$2y$10$uQSjk.Bft9y1BlHnu1SHsuKX/arPqWAKsWDGGeMTpw8WjN/tIeDu2', 'siswa', 'X MPLB 3', '2026-10-14 17:55:18'),
(14, 'FERDYADITIAFIRMANSYAH', 'FERDY', '$2y$10$C6rB.sBDFN9y07i9B/51seE8ODgTbbR4bYrFCyQizZQZYy5HayQBi', 'siswa', 'X MPLB 3', '2026-10-14 17:56:23'),
(15, 'INDIRA SAHRI', 'INDIRA', '$2y$10$ZNx7HeiC3CTGvjmSW63RcObf30wPpwjF6EPFlaoybk4CfOYDNFJwy', 'siswa', 'X MPLB 3', '2026-10-14 17:56:53'),
(16, 'JIHANDA QHOMAIROH BENDANY', 'JIHANDA', '$2y$10$bEUvXV0.SeGKguFkWbdtuOlM/LvGgTKitTBu0aiQF6.UO4NoAi7bC', 'siswa', 'X MPLB 3', '2026-10-14 18:01:55'),
(18, 'KEISYA SALSABILA', 'KEISYA', '$2y$10$E7BFNA/zGFIPin2.VrS75.Zkz1VVzu8xsjY3R.T2VtuCjKvgdCWzW', 'siswa', 'X MPLB 3', '2026-10-15 14:10:43'),
(19, 'KHANZA JANNATUL FITRI', 'KHANZA', '$2y$10$LaD80jBpjLx1Sz195y/FMunSfa4XFHgXuF6/QnHlSHVkE2dtHa4yC', 'siswa', 'X MPLB 3', '2026-10-15 14:11:39'),
(20, 'KIRANI YULIA VERA', 'KIRANI', '$2y$10$/8CO2P2QH1GFspYeWtZjv.9OhznPByNriS.3zwzyNtRGqV9kceJvm', 'siswa', 'X MPLB 3', '2026-10-15 14:12:14'),
(21, 'MARSHA RINDIANI', 'MARSHA', '$2y$10$pEY9cYQSCC88orOLVdfbWe7EwyX8cTk9xlDpENuV2F2fugo/NHZPi', 'siswa', 'X MPLB 3', '2026-10-15 14:13:11'),
(22, 'MELATI RANJANI PUTRI', 'MELATI', '$2y$10$EZLNuJMMoXR0KTHPquG3Wufw.mfrFP3hBvm/gpLvBM9hxpNwl8/Me', 'siswa', 'X MPLB 3', '2026-10-15 14:14:14'),
(23, 'MHIFTAHUL QHAIRA', 'QHAIRA', '$2y$10$Fryd64TFFZe0FkDeoez8xuV0BUNPQ6i9.1fOtPFcaynWuy8OUdIS6', 'siswa', 'X MPLB 3', '2026-10-15 14:15:41'),
(24, 'MUHAMMAD IKHSAN', 'IKHSAN', '$2y$10$0.5pc79KeCbs34ffjkWrYOGeqsvyAuNENSW3RD6ocr7yfd7R6lHv.', 'siswa', 'X MPLB 3', '2026-10-15 14:18:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
