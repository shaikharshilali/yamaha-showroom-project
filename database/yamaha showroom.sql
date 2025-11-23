-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2025 at 11:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yamaha showroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `submission` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `submission`) VALUES
(1, 'shaikh arshil ali', 'shaikharshilali@gmail.com', 'hi arshil', '2025-03-24 01:57:34'),
(2, 'shaikh arshil ali', 'shaikharshilali@gmail.com', 'hi arshil', '2025-03-24 01:57:39'),
(3, 'shaikh arshil ali', 'shaikharshilali@gmail.com', 'hi arshil', '2025-03-24 01:59:06'),
(4, 'shaikh arshil ali', 'shaikharshilali@gmail.com', 'hi arshil', '2025-03-24 02:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `buying` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `customer_name`, `customer_email`, `quantity`, `order_date`) VALUES
(1, 1, 'shaikharshil', 'shaikharshilali@gmail.com', 1, '2025-03-26 04:24:36'),
(7, 22, 'shaikh arshil ali', 'shaikharshilali@gmail.com', 1, '2025-03-26 04:27:56'),
(8, 22, 'shaikh arshil ali', 'shaikharshilali@gmail.com', 1, '2025-03-26 04:30:40'),
(9, 22, 'shaikh arshil ali', 'shaikharshilali@gmail.com', 1, '2025-03-26 04:32:30'),
(10, 22, 'shaikh arshil ali', 'shaikharshilali@gmail.com', 1, '2025-03-26 04:40:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`) VALUES
(22, 'Yamaha MT-15', 'image/mt15.png', 2000.00),
(23, 'Yamaha R15', 'image/r15.png', 2500.00),
(24, 'Yamaha FZ', 'image/fz.png', 1800.00),
(52, 'Yamaha YZF', 'image/yzf.png', 1500.00),
(53, 'Yamaha RD350', 'image/rd.png', 2500.00),
(54, 'Yamaha RX100', 'image/rx.png', 1800.00),
(55, 'Yamaha MT-09', 'image/mt09.png', 1030.00),
(56, 'Yamaha R25', 'image/r25.png', 2500.00),
(57, 'Yamaha RXS155', 'image/rxs.png', 2500.00),
(58, 'Yamaha R15S', 'image/r15s.png', 1800.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creates_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `creates_at`) VALUES
(1, 'shaikh arshil ali', 'shaikharshilali@gmail.com', '$2y$10$Hph67rTS77lGkYhriMPKQex5ZzsxzwxQJPyy/J/sf.s8C4ZQO.yI6', '2025-03-03 21:30:19'),
(3, 'arshil', 'shaikharshil@gmail.com', '$2y$10$T/jPjQtxUuVZ9ovSg/sh0u7/DrdUhAuu8rgPRpBbk93XHhLBwhoCe', '2025-03-23 04:15:51'),
(4, 'Admin', 'admin@yamaha.com', '$2y$10$Hph67rTS77lGkYhriMPKQex5ZzsxzwxQJPyy/J/sf.s8C4ZQO.yI6', '2025-03-25 05:45:00'),
(8, 'arshil ali', 'shaikharshilali2002@gmail.com', '$2y$10$NWrZYpNNJl2MifbsILAl6.JadfBNcA9wpSvwgE8fjvsH0c90mVF5e', '2025-03-26 06:14:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
