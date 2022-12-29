-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2022 at 05:15 AM
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
-- Table structure for table `dsstok`
--

CREATE TABLE `dsstok` (
  `idstok` int(11) NOT NULL,
  `image` mediumtext NOT NULL,
  `nama` varchar(200) NOT NULL,
  `skutoko` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exitds`
--

CREATE TABLE `exitds` (
  `idstok` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `skuds` varchar(20) NOT NULL,
  `quantityds` int(11) NOT NULL
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
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `readmsg` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exititem5`
--

CREATE TABLE `exititem5` (
  `idstok` int(11) NOT NULL,
  `skutoko` varchar(200) NOT NULL,
  `quantityx` int(11) NOT NULL,
  `picker` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `readmsg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exititem5`
--

INSERT INTO `exititem5` (`idstok`, `skutoko`, `quantityx`, `picker`, `status`, `tanggal`, `readmsg`) VALUES
(1, '7b11', 100, 'd', 'Refill', '2022-12-27 06:45:55', 0);

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
(26, 'Adaptor', '7p2', 'j1b1', 3, 2100, 'c8be05eb1c2c5ed4894d0ecca2a0405b.jpg'),
(27, 'kabel5', '6j7', 'k2b3', 1, 400, '77518ca1255808d495f2bdd4715c4373.png');

-- --------------------------------------------------------

--
-- Table structure for table `stok5`
--

CREATE TABLE `stok5` (
  `idstok` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `skutoko` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` mediumtext DEFAULT NULL,
  `gudang` int(11) NOT NULL DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok5`
--

INSERT INTO `stok5` (`idstok`, `nama`, `skutoko`, `quantity`, `image`, `gudang`) VALUES
(4, 'Adaptor', '7p2', 990, '12178dc919e658f24e0a232fe923a130.jpg', 5),
(5, 'Adaptor 3', '7b11', 1900, '24e56f284e83d30d3c07798b4f643821.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `updateitem`
--

CREATE TABLE `updateitem` (
  `idstok` int(11) NOT NULL,
  `skutoko` varchar(6) NOT NULL,
  `quantityup` int(11) NOT NULL,
  `fromitem` varchar(200) NOT NULL,
  `gudang` int(7) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `readmsg` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `updateitem5`
--

CREATE TABLE `updateitem5` (
  `idstok` int(11) NOT NULL,
  `skutoko` varchar(200) NOT NULL,
  `quantityup` int(11) NOT NULL,
  `worker` varchar(200) NOT NULL,
  `gudang` int(11) NOT NULL DEFAULT 5,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `updateitem5`
--

INSERT INTO `updateitem5` (`idstok`, `skutoko`, `quantityup`, `worker`, `gudang`, `tanggal`) VALUES
(1, '7p2', 100, 'Ilham', 5, '2022-12-27 06:48:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dsstok`
--
ALTER TABLE `dsstok`
  ADD PRIMARY KEY (`idstok`);

--
-- Indexes for table `exitds`
--
ALTER TABLE `exitds`
  ADD PRIMARY KEY (`idstok`);

--
-- Indexes for table `exititem`
--
ALTER TABLE `exititem`
  ADD PRIMARY KEY (`idstok`);

--
-- Indexes for table `exititem5`
--
ALTER TABLE `exititem5`
  ADD PRIMARY KEY (`idstok`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`idstok`);

--
-- Indexes for table `stok5`
--
ALTER TABLE `stok5`
  ADD PRIMARY KEY (`idstok`);

--
-- Indexes for table `updateitem`
--
ALTER TABLE `updateitem`
  ADD PRIMARY KEY (`idstok`);

--
-- Indexes for table `updateitem5`
--
ALTER TABLE `updateitem5`
  ADD PRIMARY KEY (`idstok`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exitds`
--
ALTER TABLE `exitds`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exititem`
--
ALTER TABLE `exititem`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `exititem5`
--
ALTER TABLE `exititem5`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `stok5`
--
ALTER TABLE `stok5`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `updateitem`
--
ALTER TABLE `updateitem`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `updateitem5`
--
ALTER TABLE `updateitem5`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
