CREATE USER IF NOT EXISTS 'panicuser'@'%' IDENTIFIED BY 'panicbully2025';
GRANT ALL PRIVILEGES ON panicbully.* TO 'panicuser'@'%';
FLUSH PRIVILEGES;


-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 10:37 AM
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
-- Database: `panicbully`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$IApdQjudqxMBN8gIcG8xOe35EBPmlRmg84VsDrHBy./MV6qA51YyW');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `lokasi` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tingkat` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `nama`, `lokasi`, `deskripsi`, `tingkat`, `created_at`) VALUES
(3, 'Ikhsan, S.Kom,', 'gg', 'rr', 'sedang', '2025-05-10 22:23:48'),
(5, 'Ikhsan, S.Kom,', 'gg', 'aa', 'sedang', '2025-05-10 22:58:42'),
(6, 'maulana malik ibrahim', 'SMKN 2 PINRANG', 'csdcsd', 'rendah', '2025-05-11 07:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_bully`
--

CREATE TABLE `laporan_bully` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tingkat` enum('rendah','sedang','tinggi') DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_bully`
--

INSERT INTO `laporan_bully` (`id`, `nama`, `lokasi`, `deskripsi`, `tingkat`, `tanggal`) VALUES
(1, 'Userr', 'gg', 'test', 'sedang', '2025-05-11 19:46:38'),
(2, 'Ikhsan, S.Kom,', 'SMKN 2 PINRANG', 'test', 'rendah', '2025-05-11 19:54:26'),
(3, 'Airil', 'SMKN 2 PINRANG', 'tst', 'rendah', '2025-05-12 16:32:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_bully`
--
ALTER TABLE `laporan_bully`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `laporan_bully`
--
ALTER TABLE `laporan_bully`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
