-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 11:26 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `created_at`) VALUES
(1, 'sungsm', '12345', '2024-11-01 15:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `content`, `image`, `created_at`) VALUES
(14, 'Kraven the Hunter', 'In Marvel Comics, Kraven is depicted as a Russian nobleman whose family was compelled to immigrate to America in 1917 due to the February Revolution. Kraven became an obsessive big game hunter and, after mastering the sport, made Spider-Man his target in an effort to establish himself as the world\'s best hunter.', './blog images/images.jpg', '2024-11-01 20:26:27'),
(15, 'The iPhone 16 ', 'The iPhone 16 was officially announced on September 9, 2024, and began shipping shortly after on September 20. It starts at a price of $799 for the 128GB model, with the prices scaling up to $899 for 256GB and $1,099 for 512GB​\r\n\r\nKey Features and Specifications:\r\nDisplay: 6.1-inch OLED with a resolution of 2556 x 1179 pixels, featuring a refresh rate of 60Hz.\r\nProcessor: Powered by the new A18 chipset, which offers enhanced performance and improved privacy features​\r\nTECHRADAR\r\n\r\nCamera: The rear setup includes a 48MP main camera and a 12MP ultrawide camera, with a vertically aligned design for improved spatial video capture. The front camera is 12MP as well​\r\n\r\n', './blog images/Apple-iPhone-16-Pro-hero-240909-lp.jpg.news_app_ed.jpg', '2024-11-01 20:35:20'),
(16, 'Call of Duty- Black Ops 6 ', 'Call of Duty: Black Ops 6 is set against the backdrop of the early 1990, particularly around the time of Operation Desert Storm. Players will step into the roles of CIA operatives Troy Marshall and William \"Case\" Calderon, who are tasked with missions that lead them into a web of conspiracy involving a rogue paramilitary group called \"Pantheon.\" \r\n\r\nKey features include -\r\nCampaign: The story unfolds as Marshall and Calderon seek to uncover the truth behind Pantheon and a secret CIA project called \"Cradle.\" Players can expect a mix of espionage, tactical gameplay, and psychological twists​\r\n\r\nPre-Purchase Benefits: Players who opt for the Vault Edition will unlock exclusive content such as unique weapon blueprints and a pack of GobbleGums, enhancing the gameplay experience​\r\n\r\nGame Editions: The game will be available in different editions, including a Standard and a Vault Edition, each offering a range of benefits including early access to an open beta', './blog images/call-of-duty-black-ops-6-tag-page-cover-art.avif', '2024-11-01 20:39:41');

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
(7, 'PC'),
(11, 'SAMSUNG'),
(12, 'APPLE'),
(13, 'HUWAVEI'),
(14, 'DELL'),
(15, 'HP'),
(16, 'ASUS'),
(17, 'DVD'),
(18, 'JBL');

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
(7, 'PHONE'),
(14, 'LAPTOP'),
(15, 'ACCESSORIES '),
(16, 'GAMES');

-- --------------------------------------------------------

--
-- Table structure for table `customer_feedback`
--

CREATE TABLE `customer_feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_feedback`
--

INSERT INTO `customer_feedback` (`id`, `name`, `email`, `feedback`, `created_at`) VALUES
(1, 'ssdsdsds', 'mali45@gmail.com', 'qqwqwqw', '2024-11-01 21:26:49'),
(2, 'buddika', 'mali45@gmail.com', 'qqsqsqs', '2024-11-01 21:30:56');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email_sent` tinyint(1) DEFAULT 0,
  `tracking_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_details`
--

INSERT INTO `delivery_details` (`delivery_id`, `user_id`, `order_id`, `delivery_address`, `contact_number`, `delivery_status`, `delivery_date`, `shipping_method`, `delivery_partner`, `created_at`, `email_sent`, `tracking_no`) VALUES
(3, 6, 3, '193', '0717796266', 'Delivered', '2024-11-09', 'Standard', 'Prompt Express', '2024-11-02 15:41:51', 1, '1212wq11111'),
(4, 6, 4, '193', '0717796266', 'Delivered', '2024-11-09', 'Standard', 'Prompt Express', '2024-11-02 15:48:05', 1, 'Delivered'),
(5, 6, 5, '193', '0717796266', 'Delivered', '2024-11-10', 'Standard', 'Prompt Express', '2024-11-02 16:04:20', 1, 'werrrttt'),
(6, 6, 6, '193', '0717796266', 'Shipped', '2024-11-10', 'Standard', 'Prompt Express', '2024-11-07 18:48:15', 1, '1212wq11567'),
(7, 6, 9, '193', '0717796266', 'Pending', NULL, 'Standard', 'Prompt Express', '2024-11-09 09:35:22', 0, NULL);

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
  `order_status` varchar(255) NOT NULL,
  `email_sent` tinyint(1) DEFAULT 0,
  `sms_sent` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`, `email_sent`, `sms_sent`) VALUES
(1, 6, 60000, 868134813, 1, '2024-11-02 13:47:57', 'Complete', 1, 0),
(2, 6, 300, 900199838, 1, '2024-11-02 15:41:12', 'Complete', 1, 0),
(3, 6, 60000, 1806626306, 1, '2024-11-02 15:42:02', 'Complete', 1, 0),
(4, 6, 60000, 146470748, 1, '2024-11-02 15:49:53', 'Complete', 1, 0),
(5, 6, 155000, 1733804316, 1, '2024-11-02 16:04:31', 'Complete', 1, 0),
(6, 6, 155000, 15582117, 1, '2024-11-07 18:40:18', 'Pending', 0, 0),
(7, 6, 0, 533241104, 0, '2024-11-07 22:33:19', 'Cancelled', 0, 0),
(8, 6, 0, 1598760462, 0, '2024-11-07 22:35:37', 'Cancelled', 0, 0),
(9, 6, 300, 1479816708, 1, '2024-11-09 09:35:52', 'Complete', 1, 0);

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
(1, 6, 868134813, 12, 1, 'Pending'),
(2, 6, 900199838, 2, 1, 'Pending'),
(3, 6, 1806626306, 12, 1, 'Pending'),
(4, 6, 146470748, 12, 1, 'Pending'),
(5, 6, 1733804316, 8, 1, 'Pending'),
(6, 6, 15582117, 8, 1, 'Pending'),
(7, 6, 533241104, 8, 0, 'Pending'),
(8, 6, 1598760462, 12, 0, 'Pending'),
(9, 6, 1479816708, 2, 1, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `owner_username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `owner_username`, `password`, `created_at`) VALUES
(1, 'sanjaya', '12345', '2024-11-02 07:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_tittle` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
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
(3, 'God of War Ragnarok', 'God of War Ragnarök is a 2022 action-adventure game developed by Santa Monica Studio and published by Sony Interactive Entertainment. It is the ninth installment in the God of War series, the ninth chronologically, and the sequel to 2018\'s God of War. Set', 'God of War Ragnarok', 16, 7, 'god-of-war-ragnarok-2_1.jpeg', 'god-of-war-2018-featured-image.jpg', 'god-of-war-pc-screenshot-03-en-12oct21.jfif', 700, '2024-11-02 08:32:24', 'true'),
(6, 'Resident Evil 7: Biohazard', 'Resident Evil 7: Biohazard is a 2017 survival horror game developed and published by Capcom. The player controls Ethan Winters as he searches for his long-missing wife in a derelict plantation occupied by an infected family, solving puzzles and fighting e', 'Resident Evil 7: Biohazard', 16, 7, 'cxd9vkFOAHVwwYG7lQKENGkrfyoAChNh.avif', 'RESIDENT-EVIL-7-biohazard_3840├u2160.jpg', 'topic2.jpg', 700, '2024-11-02 09:00:42', 'true'),
(7, 'Dell 3511 MX350 ', 'Core i5 Processor, 8GB Ram, 512GB SSD NVMe, Nvidia Geforce MX350 Graphics, 15.6″ inch FHD Display, Office Home Silver, Windows 10', 'Dell 3511 MX350 ', 14, 15, 'Untitled-2.jpg', '7.jpg', '6.jpg', 175000, '2024-11-02 09:19:31', 'true'),
(8, 'Asus Vivobook 15 X1504VA – i3', 'Intel Core i3 1315U Processor, 512GB NVME M.2 SSD, 8GB DDR4 3200MHZ Onboard RAM, 15.6″, FHD, (1920×1080) IPS Display, Intel UHD Graphics, Backlit keyboard, Windows 11 Home, Microsoft Office Home & Studen', 'Asus Vivobook 15 X1504VA – i3', 14, 16, 'download (6).png', '550x360.jpg', 'ASUS-Vivobook-15-X1502-16.jpg', 155000, '2024-11-02 09:13:53', 'true'),
(9, 'HP 15 fd0203TU – i3', 'Intel Core i3 – 1315U Processor, 512GB PCIe NVMe SSD, 8GB DDR4-3200 MHz RAM,15.6″, FHD (1920 x 1080) LED Display, Intel UHD Graphics, Windows 11 Home, MS Office 2021', 'HP 15 fd0203TU – i3', 14, 15, 'LAPHP00204.png', 'new-03-17.jpg', 'new-011-16.jpg', 155000, '2024-11-02 09:17:43', 'true'),
(10, 'Samsung Galaxy A05 - 64GB', 'Samsung Galaxy A05 - 64GB ROM + 4GB RAM - 50M Rear/8 MP Front - 6.7\" - 5000 mAh - Black ', 'Samsung Galaxy A05 - 64GB', 7, 17, '1.jpg', '4.jpg', '2.jpg', 30000, '2024-11-02 09:31:55', 'true'),
(11, 'Huawei Nova Y71 6/128GB ', 'Huawei Nova Y71 8/128GB Dual Sim features a 6000 mAh Battery, 22.5 W HUAWEI SuperCharge, 6.7 Inch HUAWEI FullView Display. 48 MP High-Res Camera, Ultra-Wide Angle Camera and Depth Camera. 6GB Memory and 128GB Storage.', 'Huawei Nova Y71 ', 7, 17, '6ceda6e60ce8ab4a87c3a0d00f804ada-hi.jpg', 'jpeg-optimizer_WEB-2024-06-03T061518.666.webp', 'Huaweinovay71.webp', 55000, '2024-11-02 09:41:08', 'true'),
(12, 'Apple iPhone X', 'iPhone X - 64GB ROM + 3GB RAM - 12MP Rear/7MP Front - 5.8\" - 2716 mAh - Various Colors Color Options: Silver, Space Gray Display: 5.8-inch Super Retina display', 'Apple iPhone X ', 7, 17, 'images (2).jfif', 'Apple-iPhone-X.webp', 'iphone-x-silver.jpg', 60000, '2024-11-02 09:50:59', 'true'),
(13, 'SPEAKER BT JBL BOOM MINI G02', 'Connectivity: Bluetooth Power Output: 5W Battery Life: Up to 10 hours Charging Time: Approximately 2.5 hours Water Resistance: IPX7 (waterproof) Dimensions: 3.74 x 3.74 x 5.51 inches (95 x 95 x 140 mm) Weight: 1.09 pounds (495 grams)', 'SPEAKER BT JBL BOOM MINI G02', 15, 18, 'images (4).jfif', 'O051130.jpg', 'images (3).jfif', 5000, '2024-11-02 10:21:19', 'true'),
(14, 'Samsung MJ-6699', 'Samsung MJ-6699 - Microwave Oven Type: Solo Microwave Oven Capacity: 23 Liters Power Levels: 6 power levels Microwave Power: 800 Watts Control Type: Mechanical knobs Turntable: Yes, for even cooking Dimensions: 18.5 x 12.2 x 14.5 inches (W x H x D) Weight', 'Samsung MJ-6699', 15, 11, '16826149391280378990-samsung-mj-6699-level-on-pro-bluetooth-wireless-noise-cancelling-headphones.jpg', '1682614939241707569-samsung-mj-6699-level-on-pro-bluetooth-wireless-noise-cancelling-headphones.jpg', '16826149391134037749-samsung-mj-6699-level-on-pro-bluetooth-wireless-noise-cancelling-headphones.jpg', 3000, '2024-11-02 10:25:17', 'true'),
(15, 'FANTECH X9 THOR', 'Type: Wired Gaming Mouse Sensor: Optical sensor with high-precision tracking DPI: Adjustable DPI up to 4800 for accurate responsiveness Buttons: 6 programmable buttons for custom controls Lighting: RGB LED backlighting with multiple color options Polling ', 'FANTECH X9 THOR', 15, 7, '0c296c6e2a3caf93df247e32dc624f8d.jpg', '459-20231128032738-X16v2_black_icon_758x455.png', '4-11.png', 2800, '2024-11-02 10:31:57', 'true'),
(16, 'Call of Duty 4 Modern Warfare', 'Call of Duty 4: Modern Warfare is a 2007 first-person shooter video game developed by Infinity Ward and published by Activision. It is the fourth main installment in the Call of Duty series. The game breaks away from the World War II setting of previous e', 'COD Call of Duty 4: Modern Warfare Call of Duty 4', 16, 7, 'game1.jpg', 'game1_2.jpg', 'game1_3.jpg', 300, '2024-11-09 10:04:14', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_mobile` varchar(100) NOT NULL,
  `registration_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `user_email`, `password`, `user_image`, `user_ip`, `user_address`, `user_mobile`, `registration_at`) VALUES
(6, 'malitha', 'malithamalshan7@gmail.com', '$2y$10$57vig2z39dg31PP2sh24e.XSYXts17SkoFCOoPK/IxKxZCkjZNUYq', 'rgistration.jpg', '::1', '193', '0717796266', '2024-11-02 15:32:36'),
(8, 'irshad', 'mbmirshad@gmail.com', '$2y$10$u30eKAm4vYF0JsyuIQ5vTe/weJlMQHiOf5LVkKqg9rEzQ7HW6Ax3.', 'about.png', '::1', '217C Hanifa Road ', '0777489030', '2024-10-30 07:08:36'),
(9, 'Pamoda', 'vijayanayakap97@gmail.com', '$2y$10$.QSqn9gJhdMEKlj6NwQrWuTZHAmlhIT/VIRtJsdnbul2fsAJouTVq', 'game1.jpg', '::1', '123/2', '0777489030', '2024-10-30 07:43:05'),
(10, 'buddika', 'buddi5@gmail.com', '$2y$10$YrdufyyvTBDnRwMjK5Rb6exrUZ3D39Xu07cMOB0NRRjXpksMI.Et.', 'සුහද දියවර  20231211_233830.jpg', '::1', '123/2', '0777489030', '2024-11-09 06:50:55');

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
(1, 1, 868134813, 60000, 'Cash On Delivery', '2024-11-02 13:47:51'),
(2, 2, 900199838, 300, 'Cash On Delivery', '2024-11-02 15:41:06'),
(3, 3, 1806626306, 60000, 'Cash On Delivery', '2024-11-02 15:41:57'),
(4, 4, 146470748, 60000, 'Cash On Delivery', '2024-11-02 15:49:48'),
(5, 5, 1733804316, 155000, 'Cash On Delivery', '2024-11-02 16:04:25'),
(6, 9, 1479816708, 300, 'Cash On Delivery', '2024-11-09 09:35:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `customer_feedback`
--
ALTER TABLE `customer_feedback`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `owner_username` (`owner_username`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categorie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customer_feedback`
--
ALTER TABLE `customer_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_details`
--
ALTER TABLE `delivery_details`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_payements`
--
ALTER TABLE `user_payements`
  MODIFY `payement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
