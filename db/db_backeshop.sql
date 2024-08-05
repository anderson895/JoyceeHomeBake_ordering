-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2024 at 04:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_backeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `checkout_id` int(255) NOT NULL,
  `checkout_name` varchar(50) NOT NULL,
  `checkout_address` varchar(250) NOT NULL,
  `checkout_product_id` int(11) NOT NULL,
  `checkout_quantity` int(11) NOT NULL,
  `checkout_img` varchar(250) NOT NULL,
  `checkout_united_id` varchar(250) NOT NULL,
  `checkout_date` date NOT NULL DEFAULT current_timestamp(),
  `checkout_status` int(11) NOT NULL,
  `checkout_mode` varchar(20) NOT NULL,
  `checkout_user_id` int(11) NOT NULL,
  `checkout_addons` varchar(20) NOT NULL,
  `checkout_time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`checkout_id`, `checkout_name`, `checkout_address`, `checkout_product_id`, `checkout_quantity`, `checkout_img`, `checkout_united_id`, `checkout_date`, `checkout_status`, `checkout_mode`, `checkout_user_id`, `checkout_addons`, `checkout_time`) VALUES
(62, 'Joycee Home Bake Shop', 'San Pablo Laguna', 64, 1, 'all_images/26e5169605375aeebd7a3b82b8418310git_command.png', 'bdecfb073c038e7b10ddbe288fbc554f', '2024-08-05', 4, 'Gcash', 49, '0', '22:29:27'),
(63, 'Joycee Home Bake Shop', 'San Pablo Laguna', 65, 1, 'all_images/26e5169605375aeebd7a3b82b8418310git_command.png', 'bdecfb073c038e7b10ddbe288fbc554f', '2024-08-05', 4, 'Gcash', 49, '0', '22:29:27'),
(64, 'Joycee Home Bake Shop', 'San Pablo Laguna', 66, 1, 'all_images/26e5169605375aeebd7a3b82b8418310git_command.png', 'bdecfb073c038e7b10ddbe288fbc554f', '2024-08-05', 4, 'Gcash', 49, '0', '22:29:27'),
(65, 'Joycee Home Bake Shop', 'San Pablo Laguna', 64, 1, 'all_images/adbe95b92e6b951ab70c7474e95b82f4Untitled.png', 'b53f8faa7c3417f7999c4102f525d5db', '2024-08-05', 1, 'Gcash', 49, '0', '22:32:16'),
(66, 'Joycee Home Bake Shop', 'San Pablo Laguna', 64, 1, 'all_images/ae57ff4c10f1dde750c8cc4a1243b82bgit_command.png', '50fc90ec903dc24516d6c989348abc16', '2024-08-05', 3, 'Gcash', 49, '0', '22:35:31'),
(67, 'Joycee Home Bake Shop', 'San Pablo Laguna', 65, 1, 'all_images/ae57ff4c10f1dde750c8cc4a1243b82bgit_command.png', '50fc90ec903dc24516d6c989348abc16', '2024-08-05', 3, 'Gcash', 49, '0', '22:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(255) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Steeve Moore', 'steeve', 'E10ADC3949BA59ABBE56E057F20F883E'),
(9, 'Liam Johnson', 'liam', 'E10ADC3949BA59ABBE56E057F20F883E'),
(10, 'Ramsey', 'ramsey', 'E10ADC3949BA59ABBE56E057F20F883E'),
(12, 'Administrator', 'admin', 'E10ADC3949BA59ABBE56E057F20F883E');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(255) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checker` varchar(20) NOT NULL,
  `add_ons` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(255) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(12, 'Customized Cake', '', 'Yes', 'Yes'),
(13, 'Chiffon Cake', '', 'Yes', 'Yes'),
(14, 'Jam', '', 'Yes', 'Yes'),
(15, 'Pastil', '', 'Yes', 'Yes'),
(16, 'Pulvoron', '', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(255) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(255) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL DEFAULT 'Yes',
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`, `quantity`) VALUES
(64, 'Ube Cake', 'masarap', 120.00, 'all_images/5a5d428184f72d644f7a84feb9f1c7a3441173042_404259459189761_1029939288063754216_n.jpg', 13, 'Yes', 'Yes', 97),
(65, 'Ube Jam', 'gawa sa ube', 120.00, 'all_images/0dc42366e213fef67a0e823b748b4ef9440475289_422295483882809_3843781474631408040_n.jpg', 14, 'Yes', 'Yes', 87);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `create_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `user` tinyint(4) NOT NULL,
  `contact_name` text NOT NULL,
  `contact_address` text NOT NULL,
  `contact_number` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `create_datetime`, `user`, `contact_name`, `contact_address`, `contact_number`) VALUES
(6, 'admin', 'admin@admin', '3d955f56d9545f905231e7544e6fc6fd', '2022-10-13 05:01:55', 1, '', '', ''),
(13, 'admin@admin', 'admin@admin', 'a3175a452c7a8fea80c62a198a40f6c9', '2022-10-14 08:39:48', 1, '', '', ''),
(49, 'joyceeHomeBake', 'ririhtzxi@gmail.com', 'f1df46d2c0e8c31cb1556b040048a841', '2024-08-05 16:21:38', 0, 'joycee Home Bake Shop', 'San pablo laguna', '+639345678910');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `checker` (`checker`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `description` (`description`) USING HASH;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `checkout_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
