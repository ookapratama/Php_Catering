-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 08:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_konsentrasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paket_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id` int(11) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `harga` int(11) NOT NULL,
  `menu` varchar(80) NOT NULL,
  `gambar` varchar(60) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `nama`, `harga`, `menu`, `gambar`, `status`) VALUES
(1, 'paket a', 25000, 'Nasi ', '2023-12-22560927719', 'belum'),
(2, 'paket 1', 25000, 'Nasi sayur', '2023-12-22381299423', 'selesai'),
(3, 'paket 2', 25000, 'Nasi + sayur + ayam', '2023-12-221398371376', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `tgl_pesanan` date NOT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status_pembayaran` varchar(50) NOT NULL,
  `status_proses` varchar(50) NOT NULL,
  `bukti` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_users`, `id_paket`, `tgl_pesanan`, `tgl_kirim`, `jumlah`, `total_harga`, `status_pembayaran`, `status_proses`, `bukti`) VALUES
(1, 3, 2, '2023-12-22', '2023-12-22', 5, 125000, 'Selesai', 'Telah Dikirimkan', '2023-12-22609720845'),
(2, 3, 2, '2023-12-22', '2023-12-22', 8, 200000, 'Selesai', 'Telah Dikirimkan', '2023-12-22609720845'),
(3, 3, 2, '2023-12-22', '2023-12-22', 5, 125000, 'Selesai', 'Telah Dikirimkan', '2023-12-22609720845'),
(4, 3, 2, '2023-12-22', '2023-12-22', 8, 200000, 'Selesai', 'Telah Dikirimkan', '2023-12-22609720845'),
(5, 3, 2, '2023-12-22', '2023-12-22', 4, 100000, 'Selesai', 'Telah Dikirimkan', '2023-12-22609720845'),
(6, 3, 2, '2023-12-22', '2023-12-22', 8, 200000, 'Selesai', 'Telah Dikirimkan', '2023-12-22609720845');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pass`, `email`, `role`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '1'),
(2, 'putri', 'admin', '', '2'),
(3, 'asriani', 'asriani', '', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
