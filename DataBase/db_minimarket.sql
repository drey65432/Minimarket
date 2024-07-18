-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 09:02 PM
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
-- Database: `db_minimarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kd_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `jenis_barang` varchar(50) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`kd_barang`, `nama_barang`, `jenis_barang`, `harga`, `jumlah`, `keterangan`, `gambar`) VALUES
('1', 'Aqua', 'Minuman', 5000.00, 100, 'Air Mineral Dari Pegunungan', 'barang_6686bae38d64f.jpg'),
('10', 'Blue Band', 'Bahan Masak', 23000.00, 87, 'Mentega Serbaguna', 'barang_668c356bdff7d.jpg'),
('11', 'Beras', 'Bahan Masak', 77000.00, 7, 'Nasi Premium', 'barang_668c3592cb5f8.jpg'),
('12', 'Bimoli', 'Bahan Masak', 15000.00, 45, 'Minyak Goreng', 'barang_668c35c850ff7.jpg'),
('13', 'Lifebuoy', 'Sabun', 36000.00, 78, 'Sabun Mandi', 'barang_668c361ec7cd9.jpg'),
('14', 'Rinso', 'Sabun', 18000.00, 80, 'Deterjen ', 'barang_668c3660819ea.jpg'),
('15', 'Pepsodent', 'Sabun', 8000.00, 56, 'Odol', 'barang_668c36826b993.jpg'),
('16', 'Faber Castell', 'Alat Tulis', 24000.00, 76, 'Pensil Warna', 'barang_668c37272a1e9.jpg'),
('17', 'Campus', 'Alat Tulis', 12000.00, 8, 'Buku Tulis', 'barang_668c375272fe3.jpg'),
('18', 'Pena', 'Alat Tulis', 5000.00, 34, 'Pulpen', 'barang_668c377827acf.jpg'),
('2', 'Le Mineral', 'Minuman', 6000.00, 80, 'Air Mineral Ada Manis Manisnya', 'barang_668abe7b02fbe.jpg'),
('3', 'Sari Roti', 'Makanan', 7400.00, 90, 'Roti Bergizi', 'barang_668c165d21931.jpg'),
('4', 'Oreo', 'Makanan', 6700.00, 89, 'Coklat', 'barang_668c17b014c87.jpg'),
('5', 'Coca Cola', 'Minuman', 5000.00, 68, 'Minuman Soda Segar', 'barang_668c31ea2f33e.jpg'),
('6', 'Tango', 'Makanan', 8000.00, 65, 'Waper Tipis Manis', 'barang_6.jpg'),
('7', 'Wardah Seaweed Primary Skin ', 'Skincare', 54000.00, 56, 'Mencerahkan Kulit', 'barang_7.jpg'),
('8', 'Emina Bright Stuff', 'Skincare', 46000.00, 54, 'Cerahkan Kulit', 'barang_668c3401c576e.jpg'),
('9', 'Vaseline', 'Skincare', 40000.00, 45, 'Cerah Kulit ', 'barang_668c34ba8b6b9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `kd_order` int(11) NOT NULL,
  `kd_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tgl_order` date DEFAULT NULL,
  `kd_suplayer` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`kd_order`, `kd_barang`, `nama_barang`, `harga`, `jumlah`, `tgl_order`, `kd_suplayer`) VALUES
(3, '1', 'Aqua', 5000.00, 12, '2024-07-03', '1'),
(4, '1', 'Aqua', 5000.00, 12, '2024-07-03', '1'),
(5, '1', 'Aqua', 5000.00, 1, '2024-07-03', '1'),
(6, '1', 'Aqua', 5000.00, 33, '2024-07-03', '1');

--
-- Triggers `tb_order`
--
DELIMITER $$
CREATE TRIGGER `trg_add_order` AFTER INSERT ON `tb_order` FOR EACH ROW BEGIN
    UPDATE tb_barang
    SET jumlah = jumlah + NEW.jumlah
    WHERE kd_barang = NEW.kd_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_return`
--

CREATE TABLE `tb_return` (
  `kd_return` int(11) NOT NULL,
  `tgl_return` date DEFAULT NULL,
  `kd_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_return`
--

INSERT INTO `tb_return` (`kd_return`, `tgl_return`, `kd_barang`, `nama_barang`, `jumlah`, `keterangan`) VALUES
(2, '2024-07-05', '1', 'Aqua', 24, 'Barang Rusak'),
(3, '2024-07-05', '1', 'Aqua', 24, 'Barang Rusak'),
(4, '2024-07-06', '1', 'Aqua', 10, 'Rusak'),
(5, '2024-07-07', '2', 'Le Mineral', 9, 'Kelebihan'),
(6, '2024-07-09', '1', 'Aqua', 0, 'Rusak'),
(7, '2024-07-09', '1', 'Aqua', 0, 'Rusak'),
(8, '2024-07-09', '1', 'Aqua', 0, 'Rusak');

--
-- Triggers `tb_return`
--
DELIMITER $$
CREATE TRIGGER `trg_reduce_return` AFTER INSERT ON `tb_return` FOR EACH ROW BEGIN
    UPDATE tb_barang
    SET jumlah = jumlah - NEW.jumlah
    WHERE kd_barang = NEW.kd_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_suplayer`
--

CREATE TABLE `tb_suplayer` (
  `kd_suplayer` varchar(10) NOT NULL,
  `nm_suplayer` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_suplayer`
--

INSERT INTO `tb_suplayer` (`kd_suplayer`, `nm_suplayer`, `alamat`, `hp`) VALUES
('1', 'Sby Sepdianto Manalu', 'Medan Polonia', '086234563456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`kd_order`),
  ADD KEY `kd_barang` (`kd_barang`),
  ADD KEY `kd_suplayer` (`kd_suplayer`);

--
-- Indexes for table `tb_return`
--
ALTER TABLE `tb_return`
  ADD PRIMARY KEY (`kd_return`),
  ADD KEY `kd_barang` (`kd_barang`);

--
-- Indexes for table `tb_suplayer`
--
ALTER TABLE `tb_suplayer`
  ADD PRIMARY KEY (`kd_suplayer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `kd_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_return`
--
ALTER TABLE `tb_return`
  MODIFY `kd_return` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `tb_order_ibfk_1` FOREIGN KEY (`kd_barang`) REFERENCES `tb_barang` (`kd_barang`),
  ADD CONSTRAINT `tb_order_ibfk_2` FOREIGN KEY (`kd_suplayer`) REFERENCES `tb_suplayer` (`kd_suplayer`);

--
-- Constraints for table `tb_return`
--
ALTER TABLE `tb_return`
  ADD CONSTRAINT `tb_return_ibfk_1` FOREIGN KEY (`kd_barang`) REFERENCES `tb_barang` (`kd_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
