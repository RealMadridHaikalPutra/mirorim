-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2022 at 05:43 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mirorim`
--

-- --------------------------------------------------------

--
-- Table structure for table `dstable`
--

CREATE TABLE `dstable` (
  `idstok` int(11) NOT NULL,
  `skutoko` varchar(10) NOT NULL,
  `toko` int(11) NOT NULL,
  `gudang` int(11) NOT NULL,
  `tokped` int(11) NOT NULL,
  `shopee` int(11) NOT NULL,
  `dropshipper` int(11) NOT NULL,
  `selisih` int(11) NOT NULL,
  `adjust` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exititem`
--

CREATE TABLE `exititem` (
  `idstok` int(11) NOT NULL,
  `skutoko` varchar(6) NOT NULL,
  `picker` varchar(200) NOT NULL,
  `quantityx` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `readmsg` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exititem`
--

INSERT INTO `exititem` (`idstok`, `skutoko`, `picker`, `quantityx`, `status`, `readmsg`) VALUES
(2, '7j2', 'Fadil', 200, 'Preparation', 1),
(3, '7j2', 'Pak OGI', 200, 'Request', 1),
(4, '6j7', 'Fadil', 50, 'Refill', 1),
(5, '6j7', 'Fadil', 200, 'Refill', 1),
(6, '7j2', 'Fadil', 500, '--', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `idstok` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `skutoko` varchar(200) NOT NULL,
  `skugudang` varchar(200) NOT NULL,
  `gudang` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`idstok`, `nama`, `skutoko`, `skugudang`, `gudang`, `quantity`, `image`) VALUES
(1, 'Adaptor', '7j2', '2j28', 8, 800, '12a6acbc28e8232b618e0cfd991322a5.webp'),
(2, 'Kabel4', '22k2', '2j21', 3, 900, 'dbfa2bb42acad644c95a4f08bb91d862.png'),
(3, 'Kabel6', '', 'k2b3', 4, 900, 'bf87892171a8eefc4e91620564b7c7b8.jpg'),
(4, 'Tang Potong', '8j3', 'k5b3', 5, 9000, '406765a21a8181c3ad99a24f50502d72.png');

-- --------------------------------------------------------

--
-- Table structure for table `updateitem`
--

CREATE TABLE `updateitem` (
  `idstok` int(11) NOT NULL,
  `skutoko` varchar(6) NOT NULL,
  `skugudang` varchar(200) NOT NULL,
  `quantityup` int(11) NOT NULL,
  `fromitem` varchar(200) NOT NULL,
  `gudang` int(7) NOT NULL,
  `readmsg` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `updateitem`
--

INSERT INTO `updateitem` (`idstok`, `skutoko`, `skugudang`, `quantityup`, `fromitem`, `gudang`, `readmsg`) VALUES
(3, '7j2', 'k2b3', 500, 'China', 3, 1),
(4, '7j2', '-', 400, 'China', 1, 1),
(5, '1t1', '-', 700, 'Lokal', 5, 1),
(6, '6j7', 'k2b3', 200, 'China', 3, 1),
(7, '7b11', '-', 10, 'China', 1, 1),
(8, '6j7', '-', 100, 'Lokal', 1, 1),
(9, '6j7', '-', 10, 'Lokal', 3, 1),
(10, '1t1', '-', 10, 'Lokal', 1, 1),
(11, '6j7', '-', 40, 'Lokal', 3, 1),
(12, '6J7', '-', 700, 'China', 3, 1),
(13, '6j7', '--', 900, 'China', 3, 1),
(14, '6j7', '---', 300, 'Lokal', 1, 1),
(15, '6j7', '--', 800, 'China', 1, 1),
(16, '7j2', '-', 800, 'Lokal', 3, 1),
(17, '7j2', '--', 200, 'Lokal', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dstable`
--
ALTER TABLE `dstable`
  ADD PRIMARY KEY (`idstok`);

--
-- Indexes for table `exititem`
--
ALTER TABLE `exititem`
  ADD PRIMARY KEY (`idstok`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`idstok`);

--
-- Indexes for table `updateitem`
--
ALTER TABLE `updateitem`
  ADD PRIMARY KEY (`idstok`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dstable`
--
ALTER TABLE `dstable`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exititem`
--
ALTER TABLE `exititem`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `updateitem`
--
ALTER TABLE `updateitem`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
