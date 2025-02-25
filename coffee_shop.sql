-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 25, 2025 at 03:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee_shop`
--
CREATE DATABASE IF NOT EXISTS `coffee_shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `coffee_shop`;

-- --------------------------------------------------------

--
-- Table structure for table `coffeebeans`
--

DROP TABLE IF EXISTS `coffeebeans`;
CREATE TABLE `coffeebeans` (
  `coffeeBeans_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coffeebeans`
--

INSERT INTO `coffeebeans` (`coffeeBeans_id`, `name`, `description`, `price`, `quantity`, `img`) VALUES
(3, 'Espresso', 'Bold, rich dark roast with deep chocolate and caramel notes, ideal for intense espresso shots and beverages.', '300.00', 100, ''),
(4, 'Maple Pecan ', 'Flavored coffee blending sweet maple and nutty pecan, offering a warm, inviting aroma and comforting medium roast.\r\n\r\n', '300.00', 100, ''),
(5, 'Pike Place Roast', 'Classic medium roast with balanced flavors of chocolate and toasted nuts, perfect for any time of day.', '300.00', 100, ''),
(6, 'Caramel', 'Concentrated, bold coffee shot brewed under pressure, delivering intense flavor and rich crema—perfect as a base drink.\r\n\r\n', '300.00', 100, '');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Coffee` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mugs`
--

DROP TABLE IF EXISTS `mugs`;
CREATE TABLE `mugs` (
  `mugs_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `role` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `firstname`, `lastname`, `role`) VALUES
(1, 'william', '1234', 'William', 'Carter', 'users'),
(2, 'eliza007', '1234', 'Elizabeth', 'Bennett', 'users'),
(3, 'jamessy', '1234', 'James', 'Harrison', 'admin'),
(4, 'charty', '1234', 'Charlotte', 'Graham', 'admin'),
(5, 'henryeiei', '1234', 'Henry', 'Fletcher', 'users');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coffeebeans`
--
ALTER TABLE `coffeebeans`
  ADD PRIMARY KEY (`coffeeBeans_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `mugs`
--
ALTER TABLE `mugs`
  ADD PRIMARY KEY (`mugs_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coffeebeans`
--
ALTER TABLE `coffeebeans`
  MODIFY `coffeeBeans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mugs`
--
ALTER TABLE `mugs`
  MODIFY `mugs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
