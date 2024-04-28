-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 10:06 PM
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
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`) VALUES
(49, 'shaongit@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_items`
--

CREATE TABLE `ordered_items` (
  `order_items_id` int(11) NOT NULL,
  `product_id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordered_items`
--

INSERT INTO `ordered_items` (`order_items_id`, `product_id`, `order_id`, `quantity`, `price`) VALUES
(3, 1, 13, 1, 120),
(4, 1, 14, 1, 120),
(5, 1, 15, 1, 120),
(6, 1, 16, 3, 120),
(7, 1, 19, 2, 240),
(8, 1, 20, 2, 240);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `order_status` enum('pending','delivered','rejected','cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_email`, `order_date`, `address`, `city`, `country`, `payment_method`, `order_status`) VALUES
(1, 'shaongit@gmail.com', '2024-04-28', 'dhaka', 'NG', 'bangladeesh', 'cod', 'pending'),
(2, 'shaongit@gmail.com', '2024-04-28', 'Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(3, 'shaongit@gmail.com', '2024-04-28', 'Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(4, 'shaongit@gmail.com', '2024-04-28', 'Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(5, 'shaongit@gmail.com', '2024-04-28', 'Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(6, 'shaongit@gmail.com', '2024-04-28', 'Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(7, 'shaongit@gmail.com', '2024-04-28', 'Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(8, 'shaongit@gmail.com', '2024-04-28', 'Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(9, 'shaongit@gmail.com', '2024-04-28', 'Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(10, 'shaongit@gmail.com', '2024-04-28', 'Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(11, 'shaongit@gmail.com', '2024-04-28', 'Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(12, 'shaongit@gmail.com', '2024-04-28', 'Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(13, 'shaongit@gmail.com', '2024-04-28', 'Dhanmondi 27 Dhaka', ' Dhaka ', 'Bangladesh', 'bkash', 'pending'),
(14, 'shaongit@gmail.com', '2024-04-28', 'Dhanmondi 27 Dhaka', ' Dhaka ', 'Bangladesh', 'bkash', 'pending'),
(15, 'shaongit@gmail.com', '2024-04-28', 'Dhanmondi 27 Dhaka', ' Dhaka ', 'Bangladesh', 'bkash', 'pending'),
(16, 'shaongit@gmail.com', '2024-04-28', 'Dhanmondi 27 Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(17, 'shaongit@gmail.com', '2024-04-28', 'Dhanmondi 27 Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(18, 'shaongit@gmail.com', '2024-04-28', 'Dhanmondi 27 Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(19, 'shaongit@gmail.com', '2024-04-28', 'Dhanmondi 27 Dhaka', ' Dhaka', 'Bangladesh', 'bkash', 'pending'),
(20, 'shaongit@gmail.com', '2024-04-28', 'Dhanmondi 27 Dhaka', ' Dhaka 1204', 'Bangladesh', 'bkash', 'pending'),
(21, '662eabb05a212', '2024-04-28', 'Gabtoli,Savar', ' Dhaka', 'Bangladesh', 'bkash', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `prev_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_image`, `price`, `prev_price`) VALUES
(1, 'Nike Air MaX', 'We looked into the future and it\'s gonna be comfy. Featuring a \"point-loaded\" Air unit (cushioning that forms to your every step), the Air Max Scorpion Flyknit delivers a futuristic sensation. And because looks count, we\'ve crafted the upper from incredibly soft chenille-like fabric.\n\n', 'airmax.png', 120, 299);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `registered_at` datetime NOT NULL DEFAULT current_timestamp(),
  `token` varchar(255) NOT NULL,
  `token_expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`full_name`, `username`, `email`, `password`, `phone`, `registered_at`, `token`, `token_expire`) VALUES
('adad', 'shaongit13@gmail.com', 'shaongit13a@gmail.com', 'd722dbcb93d6ca952b49928b37cac8e1', '231', '2024-04-17 07:31:09', '', '0000-00-00 00:00:00'),
('Garbage Truck', 'rabbi12', 'shaongit14@gmail.com', '4eae35f1b35977a00ebd8086c259d4c9', '8678583', '2024-04-18 11:54:49', '', '0000-00-00 00:00:00'),
('Siam', 'shaongit', 'shaongit@gmail.com', 'bcedc450f8481e89b1445069acdc3dd9', '01783473344', '2024-04-17 07:31:09', '28f722078aef914368297385b233eb2ecac28177', '2024-04-18 12:19:08'),
('siam', 'wtf', 'shha@gmail.com', 'f1290186a5d0b1ceab27f4e77c0c5d68', '01', '2024-04-17 07:31:09', '', '0000-00-00 00:00:00'),
('Siam', 'siam', 'siamsiamsiam@gmail.com', 'wow123', '0178732211', '2024-04-17 07:31:09', '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_cart_foreign` (`product_id`);

--
-- Indexes for table `ordered_items`
--
ALTER TABLE `ordered_items`
  ADD PRIMARY KEY (`order_items_id`),
  ADD KEY `order_id_foreign` (`order_id`),
  ADD KEY `product_id_foreign` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `ordered_items`
--
ALTER TABLE `ordered_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `product_cart_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `ordered_items`
--
ALTER TABLE `ordered_items`
  ADD CONSTRAINT `order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
