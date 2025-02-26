-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 26, 2025 at 07:55 AM
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
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `goods_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Coffee` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`goods_id`, `name`, `description`, `price`, `quantity`, `Coffee`, `img`) VALUES
(16, 'Espresso', 'Concentrated, bold coffee shot brewed under pressure, delivering intense flavor and rich crema—perfect as a base drink. 65', '65.00', 100, 'yes', '3.jpg'),
(17, 'Coffee Latte', 'Smooth chilled espresso combined with milk, creating a creamy, refreshing drink ideal for warm days.', '85.00', 100, 'yes', '2.jpg'),
(18, 'Caramel Macchiato', 'Sweet cold drink layering milk, espresso, and caramel sauce for a delightful blend of flavors and textures.', '85.00', 100, 'yes', '1.jpg'),
(19, 'Iced Americano', 'Refreshing beverage made from diluted espresso and cold water over ice, offering bold flavor without heaviness.', '85.00', 100, 'yes', '4.jpg'),
(20, 'Green Tea Frappe', 'Chilled green tea blend with ice and milk, offering a refreshing, light flavor for tea lovers.', '85.00', 100, 'no', '5.jpg'),
(21, 'Panda Cocoa', 'Iced cocoa topped with fluffy milk foam and cocoa powder panda face, combining fun presentation with rich chocolate flavor.', '75.00', 100, 'no', '6.jpg'),
(22, 'White Malt Ship', 'Creamy malt beverage combining white chocolate and malt flavors for a sweet, comforting drink experience.', '75.00', 100, 'no', '8.jpg'),
(23, 'Iced Chocolate', 'Rich iced chocolate drink made from syrup, cold milk, and ice, providing a decadent treat for chocolate lovers.', '75.00', 100, 'no', '7.jpg'),
(24, 'Muffin', 'Soft, fluffy muffin available in various flavors, perfect for a quick snack or breakfast alongside your coffee.', '60.00', 100, 'des', '11.jpg'),
(25, 'Bacon Omelet Puff', 'Savory pastry filled with fluffy eggs and crispy bacon, offering a hearty and satisfying snack option.', '120.00', 100, 'des', '21.jpg'),
(26, 'Brownie', 'Rich, fudgy brownie with deep chocolate flavor, providing a deliciously sweet indulgence for dessert lovers.', '120.00', 100, 'des', '10.jpg'),
(27, 'Bagel', 'Freshly baked bagel with a chewy texture, available in various flavors—perfect for breakfast or a quick snack.', '120.00', 100, 'des', '9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `item_id`, `qty`) VALUES
(1, 4, 17, 2),
(3, 4, 21, 5);

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
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`goods_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `goods_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
