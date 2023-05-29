-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 01:36 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_akhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `tambah_oleh` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `tambah_oleh`) VALUES
(1, 'denisha', '123', NULL),
(3, 'jihan', '123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konser`
--

CREATE TABLE `konser` (
  `id_konser` int(11) NOT NULL,
  `konser` varchar(50) NOT NULL,
  `artis` text NOT NULL,
  `tempat` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `seatplan` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konser`
--

INSERT INTO `konser` (`id_konser`, `konser`, `artis`, `tempat`, `deskripsi`, `gambar`, `seatplan`, `tanggal`, `waktu`) VALUES
(17, 'HITC - Music and Arts Festival', 'Rich Brian, NIKI, Joji, Jackson Wang, (g)I-DLE, EAJ, Yoasobi, BIBI', 'Community Park PIK2', 'Konser musik yang diselenggarakan oleh 88RISING dengan banyak bintang tamu spesial.', 'hitc.jpg', 'seatplan_hitc.jpeg', '2022-12-04', '18:30:00'),
(18, 'Westlife The Wild Dreams Tour 2023 Jakarta', 'Westlife', 'Stadion Gelora Bung Karno', 'The Wild Dreams Tour akan melihat Westlife lebih dekat dengan penggemar mereka daripada sebelumnya, saat mereka menyanyikan semua hits terbesar mereka Swear It Again, Flying Without Wings, dan World of our Own serta lagu-lagu pop baru dari album baru mereka Wild Dreams.', 'westlife.png', 'seatplan_westlife.png', '2023-02-11', '17:00:00'),
(30, 'Cigarettes After Sex Live In Jakarta', 'Cigarettes After Sex', 'Ecovention Hall Ancol', 'Cigarettes After Sex, band yang dikenal dengan gaya musik yang halus dan lembut, akan hadir di Indonesia!', 'cas.jpg', 'seatplan_cas.png', '2023-02-03', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `konser_17`
--

CREATE TABLE `konser_17` (
  `id_section` int(11) NOT NULL,
  `section` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `terisi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konser_17`
--

INSERT INTO `konser_17` (`id_section`, `section`, `harga`, `kapasitas`, `terisi`) VALUES
(1, 'CLUB', 10875000, 2500, 0),
(2, 'GA', 2088000, 5000, 4),
(4, 'VIP', 4263000, 5000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `konser_18`
--

CREATE TABLE `konser_18` (
  `id_section` int(11) NOT NULL,
  `section` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `terisi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konser_18`
--

INSERT INTO `konser_18` (`id_section`, `section`, `harga`, `kapasitas`, `terisi`) VALUES
(1, 'CAT 1', 3500000, 3000, 3),
(2, 'CAT 2', 2750000, 7500, 0),
(3, 'CAT 3A', 2450000, 750, 0),
(4, 'CAT 3B', 2450000, 750, 2),
(5, 'CAT 4', 1750000, 7000, 0),
(6, 'CAT 5A', 1450000, 500, 0),
(7, 'CAT 5B', 1450000, 500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `konser_30`
--

CREATE TABLE `konser_30` (
  `id_section` int(11) NOT NULL,
  `section` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `terisi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konser_30`
--

INSERT INTO `konser_30` (`id_section`, `section`, `harga`, `kapasitas`, `terisi`) VALUES
(1, 'Festival A', 1250000, 4000, 3),
(2, 'Festival B', 1100000, 6000, 0),
(3, 'Tribune A', 950000, 1500, 1),
(4, 'Tribune B', 850000, 1500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'denisha', '123'),
(2, 'jihan', '123'),
(4, 'userbaru', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_konser` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `kdpesanan` varchar(7) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `payment` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`id`, `id_user`, `id_konser`, `id_section`, `kdpesanan`, `nama`, `email`, `nohp`, `alamat`, `jumlah`, `payment`) VALUES
(3, 2, 18, 4, 'BOK0001', 'Jihan Putri Ratu Sasongko', 'jihan@gmail.com', '6289618604018', 'Yogyakarta', 2, 'Go-pay'),
(4, 2, 17, 2, 'BOK0002', 'Sapu Terbang', 'saputerbang@gmail.com', '6281804669412', 'Yogyakarta', 4, 'BCA'),
(5, 1, 17, 4, 'BOK0003', 'Denisha Kyla Azzahra', 'denisha@gmail.com', '6282215641700', 'Kuningan', 2, 'Mandiri'),
(8, 1, 18, 1, 'BOK0004', 'Stella Jeruk', 'stellajeruk@gmail.com', '6287705409412', 'Bandung', 3, 'BCA'),
(11, 4, 30, 3, 'BOK0005', 'User Baru', 'userbaru@gmail.com', '6281256785678', 'Sleman', 1, 'Go-pay'),
(12, 4, 30, 1, 'BOK0006', 'User Baru', 'userbaru@gmail.com', '6281212341234', 'Sleman', 3, 'Mandiri');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `konser`
--
ALTER TABLE `konser`
  ADD PRIMARY KEY (`id_konser`),
  ADD UNIQUE KEY `konser` (`konser`);

--
-- Indexes for table `konser_17`
--
ALTER TABLE `konser_17`
  ADD PRIMARY KEY (`id_section`);

--
-- Indexes for table `konser_18`
--
ALTER TABLE `konser_18`
  ADD PRIMARY KEY (`id_section`);

--
-- Indexes for table `konser_30`
--
ALTER TABLE `konser_30`
  ADD PRIMARY KEY (`id_section`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `konser`
--
ALTER TABLE `konser`
  MODIFY `id_konser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `konser_17`
--
ALTER TABLE `konser_17`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `konser_18`
--
ALTER TABLE `konser_18`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `konser_30`
--
ALTER TABLE `konser_30`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
