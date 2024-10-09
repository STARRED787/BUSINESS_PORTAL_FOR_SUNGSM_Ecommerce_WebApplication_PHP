-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 01:55 PM
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
-- Database: `sungsm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_tittle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_tittle`) VALUES
(4, 'Asus');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(256) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categorie_id` int(11) NOT NULL,
  `categorie_tittle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categorie_id`, `categorie_tittle`) VALUES
(7, 'Phones');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details`
--

CREATE TABLE `delivery_details` (
  `delivery_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `delivery_status` varchar(50) DEFAULT 'Pending',
  `delivery_date` date DEFAULT NULL,
  `shipping_method` varchar(100) DEFAULT 'Standard',
  `delivery_partner` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_details`
--

INSERT INTO `delivery_details` (`delivery_id`, `user_id`, `order_id`, `delivery_address`, `contact_number`, `delivery_status`, `delivery_date`, `shipping_method`, `delivery_partner`, `created_at`) VALUES
(2, 6, 7, '123', '0987654321', 'Pending', NULL, 'Standard', NULL, '2024-10-09 08:25:56'),
(3, 6, 9, '212', '0987654321', 'Pending', NULL, 'Standard', NULL, '2024-10-09 09:30:57'),
(6, 6, 8, '212', '0987654321', 'Pending', NULL, 'Standard', NULL, '2024-10-09 10:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(1, 1, 500, 877400724, 1, '2024-09-19 17:48:58', 'Complete'),
(2, 1, 500, 1239271143, 1, '2024-09-19 17:58:08', 'Complete'),
(3, 1, 300, 1900198643, 1, '2024-09-19 17:58:38', 'Pending'),
(4, 6, 600, 653967161, 1, '2024-09-26 20:08:14', 'Complete'),
(5, 6, 600, 1830425035, 1, '2024-09-30 19:34:09', 'Complete'),
(6, 6, 600, 585313617, 1, '2024-10-08 17:46:11', 'Complete'),
(7, 6, 4500, 986546924, 1, '2024-10-09 08:36:15', 'Complete'),
(8, 6, 4500, 19571414, 1, '2024-10-09 10:45:03', 'Complete'),
(9, 6, 4500, 2028979133, 1, '2024-10-09 09:31:05', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES
(1, 1, 877400724, 7, 1, 'Pending'),
(2, 1, 1239271143, 8, 1, 'Pending'),
(3, 1, 1900198643, 6, 1, 'Pending'),
(4, 6, 653967161, 7, 1, 'Pending'),
(5, 6, 1830425035, 7, 1, 'Pending'),
(6, 6, 585313617, 7, 1, 'Pending'),
(7, 6, 986546924, 1, 1, 'Pending'),
(8, 6, 19571414, 1, 1, 'Pending'),
(9, 6, 2028979133, 1, 1, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_tittle` varchar(100) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_keyword` varchar(100) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_image1` varchar(100) NOT NULL,
  `product_image2` varchar(100) NOT NULL,
  `product_image3` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_tittle`, `product_description`, `product_keyword`, `categorie_id`, `brand_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `date`, `status`) VALUES
(1, 'rrttt', 'uuyu', 'rttyy', 7, 4, 'about.png', 'background.svg', 'about.png', 4500, '2024-10-01 09:46:13', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `user_email` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_mobile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `user_email`, `password`, `user_image`, `user_ip`, `user_address`, `user_mobile`) VALUES
(6, 'malitha', 'mal@gmail.com', '$2y$10$57vig2z39dg31PP2sh24e.XSYXts17SkoFCOoPK/IxKxZCkjZNUYq', 'rgistration.jpg', '::1', '193', '0717798678'),
(7, 'sdsds', 'we@gmai.com', '12345', 'qwer.jpg', '1', '', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `user_payements`
--

CREATE TABLE `user_payements` (
  `payement_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payement_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payements`
--

INSERT INTO `user_payements` (`payement_id`, `order_id`, `invoice_number`, `amount`, `payement_mode`, `date`) VALUES
(3, 4, 653967161, 1, 'Paypal', '2024-09-26 20:08:14'),
(4, 5, 1830425035, 600, 'Paypal', '2024-09-30 19:34:09'),
(5, 6, 585313617, 600, 'Cash On Delivery', '2024-10-08 17:46:11'),
(18, 9, 2028979133, 4500, 'Cash On Delivery', '2024-10-09 09:31:05'),
(19, 8, 19571414, 4500, 'Cash On Delivery', '2024-10-09 10:45:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categorie_id`);

--
-- Indexes for table `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_payements`
--
ALTER TABLE `user_payements`
  ADD PRIMARY KEY (`payement_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categorie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `delivery_details`
--
ALTER TABLE `delivery_details`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_payements`
--
ALTER TABLE `user_payements`
  MODIFY `payement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
