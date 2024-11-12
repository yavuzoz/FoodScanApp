-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2024 at 07:37 PM
-- Server version: 10.11.9-MariaDB
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yavuz_foodscan`
--

-- --------------------------------------------------------

--
-- Table structure for table `prod`
--

CREATE TABLE `prod` (
  `prod_id` int(11) NOT NULL,
  `prod_user_id` int(11) NOT NULL,
  `prod_barcode` varchar(100) NOT NULL,
  `prod_name` varchar(200) NOT NULL,
  `prod_img_url` text DEFAULT NULL,
  `prod_date` date NOT NULL,
  `prod_noti` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `prod`
--

INSERT INTO `prod` (`prod_id`, `prod_user_id`, `prod_barcode`, `prod_name`, `prod_img_url`, `prod_date`, `prod_noti`) VALUES
(1, 1, '8690632031521', 'Prod', 'https://images.openfoodfacts.org/images/products/869/063/203/1521/front_en.3.400.jpg', '2024-09-07', 'y'),
(2, 2, '90446528', 'Red Bull Wassermelone', 'https://images.openfoodfacts.org/images/products/90446528/front_fr.9.400.jpg', '2024-09-15', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_uname` text NOT NULL,
  `user_password` text NOT NULL,
  `user_status` enum('a','p') NOT NULL DEFAULT 'a'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_uname`, `user_password`, `user_status`) VALUES
(1, 'test123', 'test123', 'a'),
(2, 'Yavuz', 'sml12345', 'a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prod`
--
ALTER TABLE `prod`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prod`
--
ALTER TABLE `prod`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
