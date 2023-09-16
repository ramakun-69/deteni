-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2023 at 02:04 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjagaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `deteni`
--

CREATE TABLE `deteni` (
  `id_deteni` int(3) NOT NULL,
  `nama_deteni` varchar(50) CHARACTER SET latin1 NOT NULL,
  `foto` varchar(100) CHARACTER SET latin1 NOT NULL,
  `status` enum('Sehat','Sakit','','') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `catatan` varchar(200) CHARACTER SET latin1 NOT NULL,
  `blok` varchar(5) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deteni`
--

INSERT INTO `deteni` (`id_deteni`, `nama_deteni`, `foto`, `status`, `updated_at`, `catatan`, `blok`) VALUES
(4, 'Emeka Francis Okpara', 'Emeka.jpg', 'Sehat', '2023-07-31 04:03:18', 'Sehat', 'B1'),
(5, 'Tan Law Lin', 'Tan.jpg', 'Sehat', '2023-07-31 04:06:11', 'Sehat', 'B2'),
(6, 'Ogbu Sunday Daberechi', 'Sunday.jpg', 'Sehat', '2023-07-31 04:06:19', 'Sehat', 'B2'),
(7, 'Kosisochuku Peter Okeke', 'Peter.jpg', 'Sehat', '2023-07-31 04:06:26', 'Sehat', 'B1'),
(8, 'Mohan Essardas Moorjani', 'Mohan.jpg', 'Sehat', '2023-07-31 04:06:35', 'Sehat', 'B3');

-- --------------------------------------------------------

--
-- Table structure for table `is_deteni`
--

CREATE TABLE `is_deteni` (
  `kode_deteni` varchar(7) NOT NULL,
  `nama_deteni` varchar(100) NOT NULL,
  `blok_deteni` varchar(11) NOT NULL,
  `asal` varchar(50) NOT NULL,
  `created_user` int(3) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_user` int(3) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `wn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_deteni`
--

INSERT INTO `is_deteni` (`kode_deteni`, `nama_deteni`, `blok_deteni`, `asal`, `created_user`, `created_date`, `updated_user`, `updated_date`, `wn`) VALUES
('B000001', 'Tan Law Lin', 'B2', 'Rumah Detensi Imigrasi Jakarta', 8, '2023-07-30 11:11:55', 8, '2023-08-03 09:30:42', 'Taiwan'),
('B000002', 'Emeka Francis Okpara', 'B1', 'Kantor Imigrasi Kelas I Khusus Non TPI Jakarta Bar', 8, '2023-07-30 11:13:20', 8, '2023-08-03 09:27:27', 'Nigeria'),
('B000003', 'Ogbu Sunday Daberechi', 'B2', 'Kantor Imigrasi Kelas I Non TPI Bogor', 8, '2023-07-30 11:13:59', 8, '2023-08-03 09:28:02', 'Nigeria'),
('B000004', 'Kosisochuku Peter Okeke', 'B1', 'Kantor Imigrasi Kelas I Non TPI Bogor', 8, '2023-07-30 11:14:43', 8, '2023-08-03 09:28:34', 'Nigeria'),
('B000005', 'Todo Solomon Chinwendu', 'B4', 'Kantor Imigrasi Kelas I TPI Jakarta Timur', 8, '2023-07-30 11:15:10', 8, '2023-08-03 09:31:19', 'Nigeria'),
('B000006', 'Mohan Essardas  Moorjani', 'B3', 'Kantor Imigrasi Kelas II Non TPI Blitar', 8, '2023-07-30 11:15:39', 8, '2023-08-03 09:29:26', 'India');

-- --------------------------------------------------------

--
-- Table structure for table `is_obat_masuk`
--

CREATE TABLE `is_obat_masuk` (
  `kode_transaksi` varchar(15) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `kode_deteni` varchar(7) NOT NULL,
  `progress` varchar(100) NOT NULL,
  `created_user` int(3) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_obat_masuk`
--

INSERT INTO `is_obat_masuk` (`kode_transaksi`, `tanggal_masuk`, `kode_deteni`, `progress`, `created_user`, `created_date`, `data`) VALUES
('TM-2023-0000001', '2023-08-03', 'B000004', 'Berita Acara Serah Terima (BAST)', 8, '2023-08-03 09:52:49', 'B000004-1. Berita Acara Serah Terima Deteni.pdf'),
('TM-2023-0000002', '2023-08-03', 'B000002', 'Berita Acara Serah Terima (BAST)', 8, '2023-08-03 09:58:52', 'B000002-1. Berita Acara Serah Terima Deteni.pdf'),
('TM-2023-0000003', '2023-08-03', 'B000006', 'Berita Acara Serah Terima (BAST)', 8, '2023-08-03 10:21:34', 'B000006-BERITA ACARA SERAH TERIMA DETENI.pdf'),
('TM-2023-0000004', '2023-08-03', 'B000001', 'Berita Acara Serah Terima (BAST)', 8, '2023-08-03 10:40:43', 'B000001-1. Berita Acara Serah Terima Deteni.pdf'),
('TM-2023-0000005', '2023-08-03', 'B000005', 'Berita Acara Serah Terima (BAST)', 8, '2023-08-03 10:41:01', 'B000005-1. BAST.pdf'),
('TM-2023-0000006', '2023-08-03', 'B000003', 'Berita Acara Serah Terima (BAST)', 8, '2023-08-03 10:41:38', 'B000003-1. Berita Acara Serah Terima Deteni.pdf'),
('TM-2023-0000007', '2023-08-03', 'B000003', 'Tindakan Adminitrasi Keimigrasian', 8, '2023-08-03 10:43:07', 'B000003-TAK Pendetensian.pdf'),
('TM-2023-0000008', '2023-08-03', 'B000004', 'Tindakan Adminitrasi Keimigrasian', 8, '2023-08-03 10:43:54', 'B000004-TAK Pendetensian.pdf'),
('TM-2023-0000009', '2023-09-08', 'B000002', 'wwwwcr', 8, '2023-09-08 10:22:54', 'B000002-PENGUNGSI MANCANEGARA SURABAYA.doc'),
('TM-2023-0000010', '2023-09-08', 'B000001', 'tessssss', 8, '2023-09-08 10:23:29', 'B000001-Proposal Mas Sakur.docx');

-- --------------------------------------------------------

--
-- Table structure for table `is_regu`
--

CREATE TABLE `is_regu` (
  `kode_regu` varchar(7) NOT NULL,
  `komandan` varchar(100) NOT NULL,
  `anggota` varchar(500) NOT NULL,
  `nama_regu` varchar(20) NOT NULL,
  `created_user` int(3) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_user` int(3) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `is_regu`
--

INSERT INTO `is_regu` (`kode_regu`, `komandan`, `anggota`, `nama_regu`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
('R000001', 'Nur Akhmad Rusli', 'Muhammad Amin, Sebastian Soekardi', 'A (Alpha)', 8, '2023-09-05 00:53:28', 8, '2023-09-05 00:53:28'),
('R000002', 'Rapy Kurniawan', 'Yusuf Lomi, Rohri Sapdo Syahputera', 'B (Bravo)', 8, '2023-09-05 00:53:41', 8, '2023-09-05 00:53:41'),
('R000003', 'Andi Ramanda', 'Bisma Harun, Akhmad Zakiyyul', 'C (Charlie)', 8, '2023-09-05 00:53:54', 8, '2023-09-05 00:53:54'),
('R000004', 'Yusril Wira Budi A', 'Mohammad Farid, Maulana Adib', 'D (Delta)', 8, '2023-09-05 00:54:07', 8, '2023-09-05 00:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `is_regu_masuk`
--

CREATE TABLE `is_regu_masuk` (
  `kode_transaksi` varchar(15) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `kode_regu` varchar(7) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `created_user` int(3) NOT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `data` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `is_regu_masuk`
--

INSERT INTO `is_regu_masuk` (`kode_transaksi`, `tanggal_masuk`, `jam_masuk`, `kode_regu`, `kegiatan`, `created_user`, `created_date`, `data`) VALUES
('J-2023-0000001', '2023-09-09', '13:51:00', 'R000002', 'menutup blok', 8, '2023-09-09 06:51:41', 'R000002-cak_lang2.png'),
('J-2023-0000002', '2023-09-09', '13:53:00', 'R000002', 'tes hp', 8, '2023-09-09 06:54:06', 'R000002-16942424365312090892145127433066.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `is_staff`
--

CREATE TABLE `is_staff` (
  `kode_staff` varchar(7) NOT NULL,
  `seksi` varchar(300) NOT NULL,
  `nama_staff` varchar(300) NOT NULL,
  `created_user` int(3) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_user` int(3) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `is_staff_masuk`
--

CREATE TABLE `is_staff_masuk` (
  `kode_transaksi` varchar(15) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `kode_staff` varchar(7) NOT NULL,
  `kegiatan` varchar(300) NOT NULL,
  `data` varchar(200) NOT NULL,
  `created_user` int(3) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `is_users`
--

CREATE TABLE `is_users` (
  `id_user` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `hak_akses` enum('Super Admin','Kepala','Staff') NOT NULL,
  `status` enum('aktif','blokir') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_users`
--

INSERT INTO `is_users` (`id_user`, `username`, `nama_user`, `password`, `email`, `telepon`, `foto`, `hak_akses`, `status`, `created_at`, `updated_at`) VALUES
(8, 'sapdo', 'Sapdo', '18e754dc99c40f73806c9d54140adbcf', '', '', 'Pas Foto - CPNS.jpg', 'Super Admin', 'aktif', '2023-07-26 08:33:56', '2023-07-28 12:07:44'),
(9, 'rapy', 'rapy', 'fb8e4bb386dced2069dcb288cdfbed84', NULL, NULL, NULL, 'Kepala', 'aktif', '2023-07-27 08:53:43', '2023-07-27 08:53:43'),
(10, 'farid', 'farid', 'a1d12da42d4302e53d510954344ad164', NULL, NULL, NULL, 'Staff', 'aktif', '2023-07-27 09:01:41', '2023-07-27 09:01:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deteni`
--
ALTER TABLE `deteni`
  ADD PRIMARY KEY (`id_deteni`);

--
-- Indexes for table `is_deteni`
--
ALTER TABLE `is_deteni`
  ADD PRIMARY KEY (`kode_deteni`),
  ADD KEY `created_user` (`created_user`),
  ADD KEY `updated_user` (`updated_user`);

--
-- Indexes for table `is_obat_masuk`
--
ALTER TABLE `is_obat_masuk`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `id_barang` (`kode_deteni`),
  ADD KEY `created_user` (`created_user`);

--
-- Indexes for table `is_regu`
--
ALTER TABLE `is_regu`
  ADD PRIMARY KEY (`kode_regu`),
  ADD KEY `created_user` (`created_user`,`updated_user`);

--
-- Indexes for table `is_regu_masuk`
--
ALTER TABLE `is_regu_masuk`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- Indexes for table `is_staff`
--
ALTER TABLE `is_staff`
  ADD PRIMARY KEY (`kode_staff`),
  ADD UNIQUE KEY `created_user` (`created_user`),
  ADD UNIQUE KEY `updated_user` (`updated_user`);

--
-- Indexes for table `is_staff_masuk`
--
ALTER TABLE `is_staff_masuk`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- Indexes for table `is_users`
--
ALTER TABLE `is_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `level` (`hak_akses`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deteni`
--
ALTER TABLE `deteni`
  MODIFY `id_deteni` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `is_users`
--
ALTER TABLE `is_users`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `is_deteni`
--
ALTER TABLE `is_deteni`
  ADD CONSTRAINT `is_deteni_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_deteni_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `is_obat_masuk`
--
ALTER TABLE `is_obat_masuk`
  ADD CONSTRAINT `is_obat_masuk_ibfk_1` FOREIGN KEY (`kode_deteni`) REFERENCES `is_deteni` (`kode_deteni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_obat_masuk_ibfk_2` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
