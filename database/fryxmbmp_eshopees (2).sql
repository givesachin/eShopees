-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 12, 2023 at 09:47 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fryxmbmp_eshopees`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `address_text` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `address_text`, `address1`, `address2`, `city`, `pincode`, `state`, `country`, `created_at`, `updated_at`) VALUES
(1, 'bjkbmkjbjm389350GujaratIndia', 'bjkbm', 'kjbjm', 'halol', '389350', 'Gujarat', 'India', '2023-02-27 19:15:11', '2023-02-27 19:15:11'),
(2, 'bjkbm, kjbjm, 389350, Gujarat, India', 'bjkbm', 'kjbjm', 'halol', '389350', 'Gujarat', 'India', '2023-03-06 23:30:20', '2023-03-06 23:30:20'),
(3, 'vjhm, bjhm, 34535, Gujarat, India', 'vjhm', 'bjhm', 'hiujk', '34535', 'Gujarat', 'India', '2023-03-06 23:41:01', '2023-03-06 23:41:01'),
(4, 'jkbsjd,fn,ms,d, nkjksnd,g, 643545, Gujarat, India', 'jkbsjd,fn,ms,d', 'nkjksnd,g', 'halol', '643545', 'Gujarat', 'India', '2023-03-07 00:53:09', '2023-03-07 00:53:09'),
(5, 'jiygmjb, jhbjnbm, 6845435, Gujarat, India', 'jiygmjb', 'jhbjnbm', 'halol', '6845435', 'Gujarat', 'India', '2023-03-07 00:55:05', '2023-03-07 00:55:05'),
(6, 'kjs,nfmd, sjkndmvdf, 564532, Gujarat, India', 'kjs,nfmd', 'sjkndmvdf', 'kjsn,df', '564532', 'Gujarat', 'India', '2023-03-07 01:00:50', '2023-03-07 01:00:50'),
(7, 'kjsbnf, sm, kjns,ndf, 846453, Gujarat, India', 'kjsbnf, sm', 'kjns,ndf', 'halol', '846453', 'Gujarat', 'India', '2023-03-07 01:01:53', '2023-03-07 01:01:53'),
(8, 'nlksnfd, lkm.k, 35352, Gujarat, India', 'nlksnfd', 'lkm.k', 'lksmdglk,', '35352', 'Gujarat', 'India', '2023-03-12 04:14:18', '2023-03-12 04:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `filename` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `filename`, `size`, `extension`, `path`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2022-12-23_1-57_AM_41.576683.webp', '14186', 'webp', '/public/uploads/carousels/2022-12-23_1-57_AM_41.576683.webp', NULL, '2022-12-22 20:27:41', '2022-12-22 20:27:41'),
(2, '2022-12-23_1-59_AM_59.751784.webp', '30394', 'webp', '/public/uploads/carousels/2022-12-23_1-59_AM_59.751784.webp', NULL, '2022-12-22 20:29:59', '2022-12-22 20:29:59'),
(3, '2022-12-23_2-00_AM_03.638183.webp', '28434', 'webp', '/public/uploads/carousels/2022-12-23_2-00_AM_03.638183.webp', NULL, '2022-12-22 20:30:03', '2022-12-22 20:30:03'),
(4, '2022-12-23_2-00_AM_34.791235.webp', '8264', 'webp', '/public/uploads/categories/2022-12-23_2-00_AM_34.791235.webp', NULL, '2022-12-22 20:30:34', '2022-12-22 20:30:34'),
(5, '2022-12-23_2-00_AM_37.707872.webp', '11154', 'webp', '/public/uploads/categories/2022-12-23_2-00_AM_37.707872.webp', NULL, '2022-12-22 20:30:37', '2022-12-22 20:30:37'),
(6, '2022-12-23_2-00_AM_40.502370.webp', '14850', 'webp', '/public/uploads/categories/2022-12-23_2-00_AM_40.502370.webp', NULL, '2022-12-22 20:30:40', '2022-12-22 20:30:40'),
(7, '2022-12-23_2-00_AM_44.027464.webp', '8414', 'webp', '/public/uploads/categories/2022-12-23_2-00_AM_44.027464.webp', NULL, '2022-12-22 20:30:44', '2022-12-22 20:30:44'),
(8, '2022-12-23_2-00_AM_47.113534.webp', '7610', 'webp', '/public/uploads/categories/2022-12-23_2-00_AM_47.113534.webp', NULL, '2022-12-22 20:30:47', '2022-12-22 20:30:47'),
(9, '2022-12-23_2-00_AM_49.586119.webp', '9680', 'webp', '/public/uploads/categories/2022-12-23_2-00_AM_49.586119.webp', NULL, '2022-12-22 20:30:49', '2022-12-22 20:30:49'),
(10, '2022-12-23_2-22_AM_33.721922.webp', '2196', 'webp', '/public/uploads/products/2022-12-23_2-22_AM_33.721922.webp', NULL, '2022-12-22 20:52:33', '2022-12-22 20:52:33'),
(11, '2022-12-23_2-22_AM_36.963676.webp', '2542', 'webp', '/public/uploads/products/2022-12-23_2-22_AM_36.963676.webp', NULL, '2022-12-22 20:52:36', '2022-12-22 20:52:36'),
(12, '2022-12-23_2-22_AM_40.394329.webp', '1762', 'webp', '/public/uploads/products/2022-12-23_2-22_AM_40.394329.webp', NULL, '2022-12-22 20:52:40', '2022-12-22 20:52:40'),
(13, '2022-12-23_2-22_AM_43.053512.webp', '2000', 'webp', '/public/uploads/products/2022-12-23_2-22_AM_43.053512.webp', NULL, '2022-12-22 20:52:43', '2022-12-22 20:52:43'),
(14, '2022-12-23_2-22_AM_46.932448.webp', '2648', 'webp', '/public/uploads/products/2022-12-23_2-22_AM_46.932448.webp', NULL, '2022-12-22 20:52:46', '2022-12-22 20:52:46'),
(15, '2022-12-23_2-22_AM_50.221172.webp', '1292', 'webp', '/public/uploads/products/2022-12-23_2-22_AM_50.221172.webp', NULL, '2022-12-22 20:52:50', '2022-12-22 20:52:50'),
(16, '2022-12-23_2-22_AM_54.211317.webp', '4080', 'webp', '/public/uploads/products/2022-12-23_2-22_AM_54.211317.webp', NULL, '2022-12-22 20:52:54', '2022-12-22 20:52:54'),
(17, '2022-12-23_2-22_AM_58.010856.webp', '1766', 'webp', '/public/uploads/products/2022-12-23_2-22_AM_58.010856.webp', NULL, '2022-12-22 20:52:58', '2022-12-22 20:52:58'),
(18, '2022-12-23_2-23_AM_01.505214.webp', '1216', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_01.505214.webp', NULL, '2022-12-22 20:53:01', '2022-12-22 20:53:01'),
(19, '2022-12-23_2-23_AM_04.578436.webp', '2318', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_04.578436.webp', NULL, '2022-12-22 20:53:04', '2022-12-22 20:53:04'),
(20, '2022-12-23_2-23_AM_07.557729.webp', '4436', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_07.557729.webp', NULL, '2022-12-22 20:53:07', '2022-12-22 20:53:07'),
(22, '2022-12-23_2-23_AM_13.690583.webp', '3472', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_13.690583.webp', NULL, '2022-12-22 20:53:13', '2022-12-22 20:53:13'),
(23, '2022-12-23_2-23_AM_18.138508.webp', '3678', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_18.138508.webp', NULL, '2022-12-22 20:53:18', '2022-12-22 20:53:18'),
(24, '2022-12-23_2-23_AM_25.669043.webp', '2000', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_25.669043.webp', NULL, '2022-12-22 20:53:25', '2022-12-22 20:53:25'),
(25, '2022-12-23_2-23_AM_29.035523.webp', '2804', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_29.035523.webp', NULL, '2022-12-22 20:53:29', '2022-12-22 20:53:29'),
(26, '2022-12-23_2-23_AM_31.878013.webp', '778', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_31.878013.webp', NULL, '2022-12-22 20:53:31', '2022-12-22 20:53:31'),
(27, '2022-12-23_2-23_AM_35.491933.webp', '1860', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_35.491933.webp', NULL, '2022-12-22 20:53:35', '2022-12-22 20:53:35'),
(28, '2022-12-23_2-23_AM_38.951147.webp', '1286', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_38.951147.webp', NULL, '2022-12-22 20:53:38', '2022-12-22 20:53:38'),
(29, '2022-12-23_2-23_AM_41.736491.webp', '1284', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_41.736491.webp', NULL, '2022-12-22 20:53:41', '2022-12-22 20:53:41'),
(30, '2022-12-23_2-23_AM_44.861337.webp', '1096', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_44.861337.webp', NULL, '2022-12-22 20:53:44', '2022-12-22 20:53:44'),
(31, '2022-12-23_2-23_AM_47.847576.webp', '1546', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_47.847576.webp', NULL, '2022-12-22 20:53:47', '2022-12-22 20:53:47'),
(32, '2022-12-23_2-23_AM_51.191325.webp', '1542', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_51.191325.webp', NULL, '2022-12-22 20:53:51', '2022-12-22 20:53:51'),
(33, '2022-12-23_2-23_AM_55.382274.webp', '2196', 'webp', '/public/uploads/products/2022-12-23_2-23_AM_55.382274.webp', NULL, '2022-12-22 20:53:55', '2022-12-22 20:53:55'),
(35, '2022-12-23_2-24_AM_01.228767.webp', '5668', 'webp', '/public/uploads/products/2022-12-23_2-24_AM_01.228767.webp', NULL, '2022-12-22 20:54:01', '2022-12-22 20:54:01'),
(36, '2022-12-23_2-24_AM_04.600175.webp', '1656', 'webp', '/public/uploads/products/2022-12-23_2-24_AM_04.600175.webp', NULL, '2022-12-22 20:54:04', '2022-12-22 20:54:04'),
(37, '2022-12-23_2-24_AM_07.366085.webp', '2542', 'webp', '/public/uploads/products/2022-12-23_2-24_AM_07.366085.webp', NULL, '2022-12-22 20:54:07', '2022-12-22 20:54:07'),
(38, '2022-12-23_2-24_AM_10.268397.webp', '1610', 'webp', '/public/uploads/products/2022-12-23_2-24_AM_10.268397.webp', NULL, '2022-12-22 20:54:10', '2022-12-22 20:54:10'),
(39, '2022-12-23_2-24_AM_13.250741.webp', '1476', 'webp', '/public/uploads/products/2022-12-23_2-24_AM_13.250741.webp', NULL, '2022-12-22 20:54:13', '2022-12-22 20:54:13'),
(40, '2022-12-23_2-24_AM_16.051615.webp', '1820', 'webp', '/public/uploads/products/2022-12-23_2-24_AM_16.051615.webp', NULL, '2022-12-22 20:54:16', '2022-12-22 20:54:16'),
(41, '2022-12-23_2-24_AM_19.121155.webp', '1300', 'webp', '/public/uploads/products/2022-12-23_2-24_AM_19.121155.webp', NULL, '2022-12-22 20:54:19', '2022-12-22 20:54:19'),
(42, '2022-12-23_2-24_AM_22.295992.webp', '1160', 'webp', '/public/uploads/products/2022-12-23_2-24_AM_22.295992.webp', NULL, '2022-12-22 20:54:22', '2022-12-22 20:54:22'),
(43, '2022-12-23_2-24_AM_25.208350.webp', '1116', 'webp', '/public/uploads/products/2022-12-23_2-24_AM_25.208350.webp', NULL, '2022-12-22 20:54:25', '2022-12-22 20:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(121) NOT NULL,
  `attachment_id` int DEFAULT NULL,
  `tier_id` tinyint DEFAULT NULL,
  `link` tinytext,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `title`, `attachment_id`, `tier_id`, `link`, `created_at`, `updated_at`) VALUES
(1, '1', 4, 3, NULL, '2022-11-14 04:58:15', '2023-03-05 01:45:00'),
(2, '2', 5, 3, NULL, '2022-11-14 05:52:36', '2023-03-05 01:45:00'),
(3, '3', 6, 3, NULL, '2022-11-14 05:52:36', '2023-03-05 01:45:00'),
(4, '4', 7, 6, NULL, '2022-11-14 05:52:36', '2023-03-05 01:45:00'),
(5, '5', 8, 6, NULL, '2022-11-14 05:52:36', '2023-03-05 01:45:00'),
(6, '6', 9, 6, NULL, '2022-11-14 05:52:36', '2023-03-05 01:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

DROP TABLE IF EXISTS `carousel`;
CREATE TABLE IF NOT EXISTS `carousel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(121) NOT NULL,
  `attachment_id` int DEFAULT NULL,
  `tier_id` tinyint DEFAULT NULL,
  `link` tinytext,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `title`, `attachment_id`, `tier_id`, `link`, `created_at`, `updated_at`) VALUES
(1, 'First', 1, 1, NULL, '2022-11-14 06:17:03', '2023-03-05 01:41:37'),
(2, '2nd', 2, 1, NULL, '2022-11-14 06:20:17', '2023-03-05 01:41:37'),
(3, 'Third', 3, 1, NULL, '2022-11-14 06:20:30', '2023-03-05 01:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(121) NOT NULL,
  `attachment_id` int DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `attachment_id`, `updated_at`, `created_at`) VALUES
(3, 'mobile', NULL, '2022-12-23 02:01:30', '2022-12-23 02:01:30'),
(4, 'cloths', NULL, '2022-12-23 02:01:25', '2022-12-23 02:01:25'),
(5, 'shoes', NULL, '2022-11-14 01:40:59', '2022-11-14 01:37:14'),
(6, 'laptop', NULL, '2022-11-14 01:40:59', '2022-11-14 01:37:14'),
(7, 'tv', NULL, '2022-11-14 01:40:59', '2022-11-14 01:37:14'),
(8, 'sarees', NULL, '2022-11-14 01:40:59', '2022-11-14 01:37:14'),
(9, 'electronics', NULL, '2022-11-14 01:40:59', '2022-11-14 01:40:59'),
(10, 'furniture', NULL, '2022-11-14 01:40:59', '2022-11-14 01:40:59'),
(11, 'home appliances', NULL, '2022-11-14 01:40:59', '2022-11-14 01:40:59'),
(12, 'jwellery', NULL, '2022-11-14 01:40:59', '2022-11-14 01:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_id` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

DROP TABLE IF EXISTS `customer_orders`;
CREATE TABLE IF NOT EXISTS `customer_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_user_id` int NOT NULL,
  `creator_user_id` int NOT NULL,
  `shipping_user_address_id` int DEFAULT NULL,
  `price` float NOT NULL,
  `discounted_price` float NOT NULL DEFAULT '0',
  `delivery_charge` int NOT NULL DEFAULT '0',
  `delivery_otp` int DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  `payment_status` tinyint(1) NOT NULL DEFAULT '0',
  `references` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `invoice_link` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`id`, `customer_user_id`, `creator_user_id`, `shipping_user_address_id`, `price`, `discounted_price`, `delivery_charge`, `delivery_otp`, `status_id`, `payment_status`, `references`, `invoice_link`, `created_at`, `updated_at`) VALUES
(55, 14, 14, 16, 10000.5, 0, 0, NULL, 1, 0, NULL, NULL, '2023-03-12 04:13:45', '2023-03-12 04:16:15'),
(54, 2, 2, 14, 22450, 0, 0, NULL, 1, 1, NULL, NULL, '2023-03-12 03:40:31', '2023-03-12 03:48:38'),
(53, 2, 2, 14, 22450, 0, 0, NULL, 1, 0, NULL, NULL, '2023-03-12 03:40:28', '2023-03-12 03:40:28'),
(51, 2, 2, 14, 37900.5, 0, 0, NULL, 6, 0, NULL, NULL, '2023-03-11 06:09:56', '2023-03-11 06:32:33'),
(52, 2, 2, 14, 1570, 0, 0, NULL, 1, 0, NULL, NULL, '2023-03-11 10:38:43', '2023-03-11 10:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order_items`
--

DROP TABLE IF EXISTS `customer_order_items`;
CREATE TABLE IF NOT EXISTS `customer_order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `price` float NOT NULL,
  `discounted_percentage` int NOT NULL DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_order_items`
--

INSERT INTO `customer_order_items` (`id`, `order_id`, `product_id`, `price`, `discounted_percentage`, `quantity`, `created_at`, `updated_at`) VALUES
(39, 55, 4, 10000.5, 1, 1, '2023-03-12 04:13:45', '2023-03-12 04:13:45'),
(38, 54, 13, 22450, 4, 1, '2023-03-12 03:40:31', '2023-03-12 03:40:31'),
(37, 53, 13, 22450, 4, 1, '2023-03-12 03:40:28', '2023-03-12 03:40:28'),
(33, 51, 4, 10000.5, 1, 1, '2023-03-11 06:09:56', '2023-03-11 06:09:56'),
(35, 51, 10, 18900, 1, 1, '2023-03-11 06:09:56', '2023-03-11 06:09:56'),
(34, 51, 6, 4500, 3, 2, '2023-03-11 06:09:56', '2023-03-11 06:09:56'),
(36, 52, 7, 1570, 4, 1, '2023-03-11 10:38:43', '2023-03-11 10:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order_status`
--

DROP TABLE IF EXISTS `customer_order_status`;
CREATE TABLE IF NOT EXISTS `customer_order_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `creator_user_id` int NOT NULL,
  `status_id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_order_status`
--

INSERT INTO `customer_order_status` (`id`, `order_id`, `creator_user_id`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2023-02-27 04:59:41', '2023-02-27 04:59:41'),
(2, 2, 2, 1, '2023-02-27 05:03:01', '2023-02-27 05:03:01'),
(3, 3, 2, 1, '2023-02-27 05:03:22', '2023-02-27 05:03:22'),
(4, 1, 2, 1, '2023-02-27 18:50:10', '2023-02-27 18:50:10'),
(5, 2, 2, 1, '2023-02-27 18:53:17', '2023-02-27 18:53:17'),
(6, 3, 2, 1, '2023-02-27 19:00:47', '2023-02-27 19:00:47'),
(7, 4, 2, 1, '2023-02-27 19:02:52', '2023-02-27 19:02:52'),
(8, 4, 2, 2, '2023-02-27 19:17:00', '2023-02-27 19:17:00'),
(9, 4, 2, 3, '2023-02-27 19:17:04', '2023-02-27 19:17:04'),
(10, 4, 2, 4, '2023-02-27 19:17:08', '2023-02-27 19:17:08'),
(11, 4, 2, 5, '2023-02-27 19:17:14', '2023-02-27 19:17:14'),
(12, 4, 2, 6, '2023-02-27 19:17:55', '2023-02-27 19:17:55'),
(13, 5, 2, 1, '2023-03-05 00:21:53', '2023-03-05 00:21:53'),
(14, 6, 2, 1, '2023-03-05 01:12:34', '2023-03-05 01:12:34'),
(15, 1, 2, 2, '2023-03-05 02:01:19', '2023-03-05 02:01:19'),
(16, 1, 2, 3, '2023-03-05 02:01:23', '2023-03-05 02:01:23'),
(17, 1, 2, 4, '2023-03-05 02:01:26', '2023-03-05 02:01:26'),
(18, 1, 2, 5, '2023-03-05 02:01:28', '2023-03-05 02:01:28'),
(19, 7, 2, 1, '2023-03-07 03:23:28', '2023-03-07 03:23:28'),
(20, 8, 2, 1, '2023-03-10 10:56:05', '2023-03-10 10:56:05'),
(21, 9, 2, 1, '2023-03-10 11:22:15', '2023-03-10 11:22:15'),
(22, 10, 2, 1, '2023-03-10 12:49:33', '2023-03-10 12:49:33'),
(23, 11, 2, 1, '2023-03-10 12:49:53', '2023-03-10 12:49:53'),
(24, 12, 2, 1, '2023-03-11 00:17:41', '2023-03-11 00:17:41'),
(25, 13, 2, 1, '2023-03-11 00:19:26', '2023-03-11 00:19:26'),
(26, 14, 2, 1, '2023-03-11 00:31:18', '2023-03-11 00:31:18'),
(27, 15, 2, 1, '2023-03-11 00:32:40', '2023-03-11 00:32:40'),
(28, 16, 2, 1, '2023-03-11 00:36:18', '2023-03-11 00:36:18'),
(29, 17, 2, 1, '2023-03-11 00:40:34', '2023-03-11 00:40:34'),
(30, 18, 2, 1, '2023-03-11 00:40:53', '2023-03-11 00:40:53'),
(31, 19, 2, 1, '2023-03-11 00:41:39', '2023-03-11 00:41:39'),
(32, 20, 2, 1, '2023-03-11 00:43:21', '2023-03-11 00:43:21'),
(33, 21, 2, 1, '2023-03-11 00:45:58', '2023-03-11 00:45:58'),
(34, 22, 2, 1, '2023-03-11 00:47:50', '2023-03-11 00:47:50'),
(35, 23, 2, 1, '2023-03-11 00:49:33', '2023-03-11 00:49:33'),
(36, 24, 2, 1, '2023-03-11 01:05:54', '2023-03-11 01:05:54'),
(37, 25, 2, 1, '2023-03-11 01:05:56', '2023-03-11 01:05:56'),
(38, 26, 2, 1, '2023-03-11 01:06:46', '2023-03-11 01:06:46'),
(39, 27, 2, 1, '2023-03-11 01:07:30', '2023-03-11 01:07:30'),
(40, 28, 2, 1, '2023-03-11 01:07:43', '2023-03-11 01:07:43'),
(41, 29, 2, 1, '2023-03-11 01:08:19', '2023-03-11 01:08:19'),
(42, 30, 2, 1, '2023-03-11 01:09:27', '2023-03-11 01:09:27'),
(43, 31, 2, 1, '2023-03-11 01:10:16', '2023-03-11 01:10:16'),
(44, 32, 2, 1, '2023-03-11 01:11:37', '2023-03-11 01:11:37'),
(45, 33, 2, 1, '2023-03-11 01:12:49', '2023-03-11 01:12:49'),
(46, 34, 2, 1, '2023-03-11 01:13:37', '2023-03-11 01:13:37'),
(47, 35, 2, 1, '2023-03-11 01:15:38', '2023-03-11 01:15:38'),
(48, 36, 2, 1, '2023-03-11 01:18:33', '2023-03-11 01:18:33'),
(49, 37, 2, 1, '2023-03-11 01:18:56', '2023-03-11 01:18:56'),
(50, 38, 2, 1, '2023-03-11 01:19:11', '2023-03-11 01:19:11'),
(51, 39, 2, 1, '2023-03-11 01:21:56', '2023-03-11 01:21:56'),
(52, 40, 2, 1, '2023-03-11 01:26:03', '2023-03-11 01:26:03'),
(53, 41, 2, 1, '2023-03-11 01:26:37', '2023-03-11 01:26:37'),
(54, 42, 2, 1, '2023-03-11 01:32:36', '2023-03-11 01:32:36'),
(55, 43, 2, 1, '2023-03-11 01:33:06', '2023-03-11 01:33:06'),
(56, 44, 2, 1, '2023-03-11 01:33:47', '2023-03-11 01:33:47'),
(57, 45, 2, 1, '2023-03-11 01:37:42', '2023-03-11 01:37:42'),
(58, 46, 2, 1, '2023-03-11 01:38:10', '2023-03-11 01:38:10'),
(59, 47, 2, 1, '2023-03-11 01:41:33', '2023-03-11 01:41:33'),
(60, 48, 2, 1, '2023-03-11 01:41:51', '2023-03-11 01:41:51'),
(61, 49, 2, 1, '2023-03-11 01:41:59', '2023-03-11 01:41:59'),
(62, 50, 2, 1, '2023-03-11 01:45:37', '2023-03-11 01:45:37'),
(63, 50, 2, 2, '2023-03-11 05:55:42', '2023-03-11 05:55:42'),
(64, 50, 2, 2, '2023-03-11 05:57:38', '2023-03-11 05:57:38'),
(65, 50, 2, 2, '2023-03-11 06:00:21', '2023-03-11 06:00:21'),
(66, 50, 2, 2, '2023-03-11 06:01:16', '2023-03-11 06:01:16'),
(67, 50, 2, 2, '2023-03-11 06:06:44', '2023-03-11 06:06:44'),
(68, 50, 2, 3, '2023-03-11 06:07:19', '2023-03-11 06:07:19'),
(69, 50, 2, 4, '2023-03-11 06:07:29', '2023-03-11 06:07:29'),
(70, 50, 2, 5, '2023-03-11 06:08:22', '2023-03-11 06:08:22'),
(71, 50, 2, 6, '2023-03-11 06:08:56', '2023-03-11 06:08:56'),
(72, 51, 2, 1, '2023-03-11 06:09:56', '2023-03-11 06:09:56'),
(73, 51, 2, 2, '2023-03-11 06:10:32', '2023-03-11 06:10:32'),
(74, 51, 2, 3, '2023-03-11 06:11:05', '2023-03-11 06:11:05'),
(75, 51, 2, 4, '2023-03-11 06:11:26', '2023-03-11 06:11:26'),
(76, 51, 2, 5, '2023-03-11 06:12:42', '2023-03-11 06:12:42'),
(77, 51, 2, 5, '2023-03-11 06:28:28', '2023-03-11 06:28:28'),
(78, 51, 2, 5, '2023-03-11 06:31:46', '2023-03-11 06:31:46'),
(79, 51, 2, 6, '2023-03-11 06:32:33', '2023-03-11 06:32:33'),
(80, 52, 2, 1, '2023-03-11 10:38:43', '2023-03-11 10:38:43'),
(81, 53, 2, 1, '2023-03-12 03:40:28', '2023-03-12 03:40:28'),
(82, 54, 2, 1, '2023-03-12 03:40:31', '2023-03-12 03:40:31'),
(83, 55, 14, 1, '2023-03-12 04:13:45', '2023-03-12 04:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `integration`
--

DROP TABLE IF EXISTS `integration`;
CREATE TABLE IF NOT EXISTS `integration` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `integration_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `test` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `integration`
--

INSERT INTO `integration` (`id`, `integration_name`, `code`, `value`, `sort_order`, `test`, `created_at`, `updated_at`) VALUES
(1, 'SMS', 'SENDER ID 1', 'ESHPHL', 1, 0, '2023-01-11 12:41:57', '2023-02-26 04:28:11'),
(2, 'SMS', 'AUTHORIZATION', 'BGypCWJzQ9iKDcVA2m1RkxX0sSeFv6lfMhn7wuUa4YZITborgPZ4jgC96arkBY7coNz13sd2UbEeMSHl', 2, 0, '2023-01-11 12:50:01', '2023-02-26 04:28:11'),
(3, 'SMS', 'URL', 'https://www.fast2sms.com/dev/bulkV2', 3, 0, '2023-01-11 12:50:01', '2023-02-26 04:28:11'),
(4, 'SMS', 'ROUTE', 'dlt', 4, 0, '2023-01-11 12:50:01', '2023-02-26 04:28:11'),
(5, 'SMS', 'MESSAGE OTP FOR LOGIN', '150333', 5, 1, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(6, 'SMS', 'MESSAGE OTP FOR LOGIN WEIGHT', '1', 6, 0, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(7, 'SMS', 'MESSAGE OTP FOR SIGNUP', '150334', 7, 1, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(8, 'SMS', 'MESSAGE OTP FOR SIGNUP WEIGHT', '1', 8, 0, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(9, 'SMS', 'MESSAGE OTP FOR ACCEPT DELIVERY', '150332', 9, 1, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(10, 'SMS', 'MESSAGE OTP FOR ACCEPT DELIVERY WEIGHT', '1', 10, 0, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(11, 'SMS', 'MESSAGE ORDER OUT FOR DELIVERY', '150324', 11, 1, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(12, 'SMS', 'MESSAGE ORDER OUT FOR DELIVERY WEIGHT', '2', 12, 0, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(13, 'SMS', 'MESSAGE ORDER DELIVERED', '150326', 13, 1, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(14, 'SMS', 'MESSAGE ORDER DELIVERED WEIGHT', '1', 14, 0, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(15, 'SMS', 'MESSAGE ORDER CONFIRMED', '150323', 15, 1, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(16, 'SMS', 'MESSAGE ORDER CONFIRMED WEIGHT', '2', 16, 0, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(17, 'SMS', 'MESSAGE ORDER DISPATCHED', '150325', 17, 1, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(18, 'SMS', 'MESSAGE ORDER DISPATCHED WEIGHT', '2', 18, 0, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(19, 'SMS', 'MESSAGE ORDER CANCELLED', '150322', 19, 1, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(20, 'SMS', 'MESSAGE ORDER CANCELLED WEIGHT', '2', 20, 0, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(21, 'SMS', 'MESSAGE BALANCE ZERO', NULL, 21, 1, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(22, 'SMS', 'MESSAGE BALANCE ZERO WEIGHT', NULL, 22, 0, '2023-01-11 13:05:11', '2023-02-26 04:28:11'),
(23, 'Razorpay', 'KEY', 'rzp_test_nlliD3NTbaakLD', 1, 0, '2023-01-11 13:08:48', '2023-02-26 04:28:11'),
(24, 'Razorpay', 'SECRET KEY', 'dQ3HAq56DZoDHYg6GzSQLGOK', 2, 0, '2023-01-11 13:08:48', '2023-02-26 04:28:11'),
(25, 'Mailer', 'HOST', 'smtp.mailtrap.io', 1, 0, '2023-01-15 02:57:15', '2023-02-26 04:28:11'),
(26, 'Mailer', 'PORT', '2525', 2, 0, '2023-01-15 02:57:15', '2023-02-26 04:28:11'),
(27, 'Mailer', 'USERNAME', 'facb0c855820ca', 3, 0, '2023-01-15 02:57:15', '2023-02-26 04:28:11'),
(28, 'Mailer', 'PASSWORD', '913a6fb8f0b770', 4, 0, '2023-01-15 02:57:15', '2023-02-26 04:28:11'),
(29, 'Mailer', 'ENCRYPTION', 'tls', 5, 0, '2023-01-15 02:57:15', '2023-02-26 04:28:11'),
(30, 'SMS', 'SENDER ID 2', 'ESHPES', 1, 0, '2023-01-11 12:41:57', '2023-02-26 04:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_11_12_083556_create_eshopees_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_description` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `title`, `status_description`, `created_at`, `updated_at`) VALUES
(1, 'Processing', NULL, '2023-02-23 16:48:37', '2023-02-23 16:48:37'),
(2, 'Approved', NULL, '2022-12-25 05:48:54', '2022-12-25 05:48:54'),
(3, 'Dispatched', NULL, '2022-12-25 05:49:07', '2022-12-25 05:49:07'),
(4, 'In Transit', NULL, '2022-12-25 05:51:13', '2022-12-25 05:51:13'),
(5, 'Out for Delivery', NULL, '2022-12-25 05:51:41', '2022-12-25 05:51:41'),
(6, 'Delivered', NULL, '2022-12-25 05:51:58', '2022-12-25 05:51:58'),
(7, 'Cancelled', NULL, '2022-12-25 05:52:36', '2022-12-25 05:52:36'),
(8, 'Failed', NULL, '2023-02-23 16:49:10', '2023-02-23 16:49:10'),
(9, 'Returned', NULL, '2023-02-23 17:06:55', '2023-02-23 17:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_status_options`
--

DROP TABLE IF EXISTS `order_status_options`;
CREATE TABLE IF NOT EXISTS `order_status_options` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_order_status_id` int NOT NULL,
  `child_order_status_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_status_options`
--

INSERT INTO `order_status_options` (`id`, `parent_order_status_id`, `child_order_status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(19, 5, 9, NULL, NULL),
(18, 5, 6, NULL, NULL),
(17, 4, 9, NULL, NULL),
(16, 4, 5, NULL, NULL),
(6, 1, 7, NULL, NULL),
(7, 1, 8, NULL, NULL),
(9, 2, 3, NULL, NULL),
(15, 3, 9, NULL, NULL),
(14, 3, 4, NULL, NULL),
(13, 2, 7, NULL, NULL),
(20, 6, 9, NULL, NULL),
(21, 1, 1, NULL, NULL),
(22, 2, 2, NULL, NULL),
(23, 3, 3, NULL, NULL),
(24, 4, 4, NULL, NULL),
(25, 5, 5, NULL, NULL),
(26, 6, 6, NULL, NULL),
(27, 7, 7, NULL, NULL),
(28, 8, 8, NULL, NULL),
(29, 9, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
CREATE TABLE IF NOT EXISTS `organization` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `org_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_whatsapp_phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_whatsapp_message` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_logo_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_logo2_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_facebook_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_instagram_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_twitter_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_location_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_location_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_image_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_image_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `developed_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `developer_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_queue` tinyint(1) NOT NULL DEFAULT '1',
  `sms_queue` tinyint(1) NOT NULL DEFAULT '1',
  `sms_balance` bigint NOT NULL DEFAULT '0',
  `sms_used` bigint NOT NULL DEFAULT '0',
  `delivery_charge_thresold_amount` int UNSIGNED NOT NULL DEFAULT '0',
  `delivery_charge_amount` int NOT NULL DEFAULT '0',
  `order_id_prefix` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id_padding` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `org_name`, `org_phone`, `org_email`, `org_whatsapp_phone`, `org_whatsapp_message`, `org_logo_path`, `org_logo2_path`, `org_facebook_link`, `org_instagram_link`, `org_twitter_link`, `org_location_address`, `org_location_link`, `default_image_id`, `default_image_path`, `version`, `developed_by`, `developer_link`, `email_queue`, `sms_queue`, `sms_balance`, `sms_used`, `delivery_charge_thresold_amount`, `delivery_charge_amount`, `order_id_prefix`, `order_id_padding`, `created_at`, `updated_at`) VALUES
(1, 'Eshopees', '8140996031', 'givesachin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.5', NULL, NULL, 1, 0, 63, 7, 499, 100, 'ES', '00000', NULL, '2023-03-12 04:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eshopees_order_id` int NOT NULL,
  `razorpay_order_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `razorpay_payment_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double UNSIGNED NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `refund_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name`, `phone`, `email`, `eshopees_order_id`, `razorpay_order_id`, `razorpay_payment_id`, `method`, `amount`, `status`, `refund_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Ruchit Patel', '8980452491', 'support@cryptical.in', 4, 'order_LLfgBYm29acilA', 'pay_LLfgajcbpSJitI', 'upi', 900, 'captured', NULL, NULL, '2023-02-27 19:15:41', '2023-02-27 19:16:10'),
(2, 'Ruchit Patel 10', '8140996031', 'support@cryptical.in', 54, 'order_LQYnXXdehmTQ3Y', NULL, NULL, 22450, 'draft', NULL, NULL, '2023-03-12 03:46:49', '2023-03-12 03:46:49'),
(3, 'Ruchit Patel 10', '8140996031', 'support@cryptical.in', 54, 'order_LQYovVHXitNKu8', 'pay_LQYpFJ9UQAbFmY', 'upi', 22450, 'captured', NULL, NULL, '2023-03-12 03:48:07', '2023-03-12 03:48:37'),
(4, 'Lol Bhoi', NULL, '3M9kBJdZYhYo2KaKpBGfKVQC6', 55, 'order_LQZIkFW4Mdx6ZG', NULL, NULL, 10000.5, 'draft', NULL, NULL, '2023-03-12 04:16:21', '2023-03-12 04:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `attachment_id` int DEFAULT NULL,
  `tier_id` tinyint DEFAULT NULL,
  `name` varchar(121) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `qty_limit` int DEFAULT NULL,
  `price` float NOT NULL DEFAULT '0',
  `discounted_percentage` int DEFAULT NULL,
  `short_description` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` mediumtext CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `highlights` mediumtext CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `specifications` mediumtext CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `vendor_id` int DEFAULT NULL,
  `vendor_references` text COLLATE utf8mb4_unicode_ci,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `attachment_id`, `tier_id`, `name`, `qty`, `qty_limit`, `price`, `discounted_percentage`, `short_description`, `description`, `highlights`, `specifications`, `vendor_id`, `vendor_references`, `updated_at`, `created_at`) VALUES
(4, 3, 10, 2, 'SAMSUNG Galaxy M11', 9, NULL, 10000.5, 1, NULL, NULL, NULL, '<div class=\"_3k-BhJ\" style=\"box-sizing: border-box; margin: 0px; padding: 24px 24px 34px; border-top: 1px solid rgb(240, 240, 240); font-size: 14px; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"flxcaE\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4;\">General</div><table class=\"_14cfVK\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 747.672px; border-collapse: collapse;\"><tbody style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">In The Box</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Handset (Non-removable Battery Included), Travel Adapter, USB Cable, User Manual</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Model Number</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">SM-M115FMBEINS</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Model Name</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Galaxy M11</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Color</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Metallic Blue</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Browse Type</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Smartphones</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">SIM Type</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Dual Sim</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Hybrid Sim Slot</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">No</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Touchscreen</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">OTG Compatible</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr></tbody></table></div><div class=\"_3k-BhJ\" style=\"box-sizing: border-box; margin: 0px; padding: 24px 24px 34px; border-top: 1px solid rgb(240, 240, 240); font-size: 14px; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"flxcaE\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4;\">Display Features</div><table class=\"_14cfVK\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 747.672px; border-collapse: collapse;\"><tbody style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Display Size</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">16.26 cm (6.4 inch)</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Resolution</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">1560 x 720 Pixels</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Resolution Type</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">HD+</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">GPU</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Adreno 506</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Display Type</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">PLS TFT LCD Infinity-O Display</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Display Colors</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">16M</li></ul></td></tr></tbody></table></div><div class=\"_3k-BhJ\" style=\"box-sizing: border-box; margin: 0px; padding: 24px 24px 34px; border-top: 1px solid rgb(240, 240, 240); font-size: 14px; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"flxcaE\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4;\">Os &amp; Processor Features</div><table class=\"_14cfVK\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 747.672px; border-collapse: collapse;\"><tbody style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Operating System</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Android 10</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Processor Type</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Qualcomm Snapdragon (SDM450-F01) Octa Core</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Processor Core</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Octa Core</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Primary Clock Speed</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">1.8 GHz</li></ul></td></tr></tbody></table></div><div class=\"_3k-BhJ\" style=\"box-sizing: border-box; margin: 0px; padding: 24px 24px 34px; border-top: 1px solid rgb(240, 240, 240); font-size: 14px; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"flxcaE\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4;\">Memory &amp; Storage Features</div><table class=\"_14cfVK\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 747.672px; border-collapse: collapse;\"><tbody style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Internal Storage</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">64 GB</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">RAM</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">4 GB</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Expandable Storage</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">512 GB</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Supported Memory Card Type</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">microSD</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Memory Card Slot Type</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Dedicated Slot</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Call Log Memory</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr></tbody></table></div><div class=\"_3k-BhJ\" style=\"box-sizing: border-box; margin: 0px; padding: 24px 24px 34px; border-top: 1px solid rgb(240, 240, 240); font-size: 14px; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"flxcaE\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4;\">Camera Features</div><table class=\"_14cfVK\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 747.672px; border-collapse: collapse;\"><tbody style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Primary Camera Available</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Primary Camera</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">13MP + 5MP + 2MP</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Primary Camera Features</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Triple Camera Setup: 13 MP (f/1.8) Main Camera + 5 MP (f/2.2) Ultra Wide Camera + 2 MP (f/2.4) Depth Camera</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Secondary Camera Available</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Secondary Camera</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">8MP Front Camera</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Secondary Camera Features</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">8 MP (f/2.0)</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Flash</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Full HD Recording</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Video Recording</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Video Recording Resolution</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">1080p</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Image Editor</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Dual Camera Lens</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Primary Camera</li></ul></td></tr></tbody></table></div><div class=\"_3k-BhJ\" style=\"box-sizing: border-box; margin: 0px; padding: 24px 24px 34px; border-top: 1px solid rgb(240, 240, 240); font-size: 14px; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"flxcaE\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4;\">Call Features</div><table class=\"_14cfVK\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 747.672px; border-collapse: collapse;\"><tbody style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Call Wait/Hold</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Conference Call</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Hands Free</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Video Call Support</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Call Divert</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Phone Book</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Call Timer</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Speaker Phone</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Speed Dialing</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Logs</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Received, Missed, Dial</li></ul></td></tr></tbody></table></div><div class=\"_3k-BhJ\" style=\"box-sizing: border-box; margin: 0px; padding: 24px 24px 34px; border-top: 1px solid rgb(240, 240, 240); font-size: 14px; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"flxcaE\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4;\">Connectivity Features</div><table class=\"_14cfVK\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 747.672px; border-collapse: collapse;\"><tbody style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Network Type</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">4G, 3G, 2G</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Supported Networks</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">4G LTE, WCDMA, GSM</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">GPRS</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Bluetooth Support</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Bluetooth Version</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">v4.2</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Wi-Fi</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Wi-Fi Hotspot</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">USB Connectivity</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Map Support</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Google Maps</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">GPS Support</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr></tbody></table></div><div class=\"_3k-BhJ\" style=\"box-sizing: border-box; margin: 0px; padding: 24px 24px 34px; border-top: 1px solid rgb(240, 240, 240); font-size: 14px; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"flxcaE\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4;\">Other Details</div><table class=\"_14cfVK\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 747.672px; border-collapse: collapse;\"><tbody style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Smartphone</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">SIM Size</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Nano SIM</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Social Networking Phone</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Removable Battery</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">No</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">MMS</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">SMS</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Predictive Text Input</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Yes</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Series</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Galaxy M</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Browser</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Google Chrome, Samsung (S-Browser 11.0)</li></ul></td></tr></tbody></table></div><div class=\"_3k-BhJ\" style=\"box-sizing: border-box; margin: 0px; padding: 24px 24px 34px; border-top: 1px solid rgb(240, 240, 240); font-size: 14px; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"flxcaE\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4;\">Battery &amp; Power Features</div><table class=\"_14cfVK\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 747.672px; border-collapse: collapse;\"><tbody style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Battery Capacity</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">5000 mAh</li></ul></td></tr></tbody></table></div><div class=\"_3k-BhJ\" style=\"box-sizing: border-box; margin: 0px; padding: 24px 24px 34px; border-top: 1px solid rgb(240, 240, 240); font-size: 14px; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"flxcaE\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4;\">Dimensions</div><table class=\"_14cfVK\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 747.672px; border-collapse: collapse;\"><tbody style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Width</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">76.3 mm</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Height</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">161.4 mm</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Depth</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">9 mm</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Weight</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">197 g</li></ul></td></tr></tbody></table></div><div class=\"_3k-BhJ\" style=\"box-sizing: border-box; margin: 0px; padding: 24px 24px 34px; border-top: 1px solid rgb(240, 240, 240); font-size: 14px; color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"flxcaE\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; font-size: 18px; white-space: nowrap; line-height: 1.4;\">Warranty</div><table class=\"_14cfVK\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 747.672px; border-collapse: collapse;\"><tbody style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Warranty Summary</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">1 Year Manufacturer Warranty for Phone and 6 Months Warranty for in the Box Accessories</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Warranty Service Type</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Visit Service Center</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Covered in Warranty</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Any Manufacturing Defect</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 16px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Not Covered in Warranty</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">Any Kind of Damage Not Covered Under Warranty</li></ul></td></tr><tr class=\"_1s_Smc row\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; display: flex; flex-flow: row wrap; width: 747.672px;\"><td class=\"_1hKmbr col col-3-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 8px 0px 0px; width: 186.906px; display: inline-block; vertical-align: top; color: rgb(135, 135, 135);\">Domestic Warranty</td><td class=\"URwL2w col col-9-12\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; width: 560.75px; display: inline-block; vertical-align: top; line-height: 1.4; word-break: break-word; color: rgb(33, 33, 33);\"><ul style=\"box-sizing: border-box; margin: 0px; padding: 0px;\"><li class=\"_21lJbe\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; list-style: none;\">1 Year</li></ul></td></tr></tbody></table></div>', 1, NULL, '2023-02-14 05:13:06', '2022-11-27 17:35:03');
INSERT INTO `products` (`id`, `category_id`, `attachment_id`, `tier_id`, `name`, `qty`, `qty_limit`, `price`, `discounted_percentage`, `short_description`, `description`, `highlights`, `specifications`, `vendor_id`, `vendor_references`, `updated_at`, `created_at`) VALUES
(5, 4, 11, 2, 'Party Blazers for men', 0, 3, 12000, 2, NULL, NULL, NULL, '', 2, NULL, '2023-03-07 09:04:54', '2023-03-07 09:04:54'),
(6, 9, 12, 2, 'Webcam', 25, NULL, 4500, 3, NULL, NULL, NULL, '', NULL, NULL, '2023-02-14 05:13:06', '2022-11-27 17:35:14'),
(7, 10, 13, 2, 'Sofa', 1, NULL, 1570, 4, NULL, NULL, NULL, '', NULL, NULL, '2023-02-14 05:13:06', '2022-11-27 17:35:20'),
(8, 9, 14, 4, 'sewing machine', 9, NULL, 750, 5, NULL, NULL, NULL, '', NULL, NULL, '2023-02-14 05:13:06', '2022-11-27 17:35:26'),
(9, 9, 15, 4, 'inverter', 0, NULL, 1445, 6, NULL, NULL, NULL, '', NULL, NULL, '2023-02-14 05:13:06', '2022-11-27 17:35:33'),
(10, 7, 16, 4, 'power packed tv', 2, NULL, 18900, 1, NULL, NULL, NULL, '', NULL, NULL, '2023-02-14 05:13:06', '2022-11-27 17:35:38'),
(11, 9, 17, 4, 'vacuum cleaner', 7, NULL, 1890, 2, NULL, NULL, NULL, '', NULL, NULL, '2023-02-14 05:13:06', '2022-11-27 17:35:43'),
(12, 9, 18, 4, 'kaff microwave owen', 102, NULL, 2140, 3, NULL, NULL, NULL, '', NULL, NULL, '2023-02-14 05:13:06', '2022-11-27 17:35:47'),
(13, 7, 19, 4, 'Best tvs are here', 13, NULL, 22450, 4, NULL, NULL, NULL, '', NULL, NULL, '2023-02-14 05:13:06', '2022-11-27 17:35:54'),
(14, 10, 20, 5, 'swings', 5, NULL, 450, 5, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:36:00'),
(15, 10, NULL, 5, 'bean bag', 4, NULL, 600, 6, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-12-23 02:26:54'),
(16, 10, 22, 5, 'wardrobes', 3, NULL, 1210, 1, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:36:12'),
(17, 10, 23, 5, 'furniture accessories', 150, NULL, 690, 2, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:36:17'),
(18, 10, 24, 5, 'home temples', 22, NULL, 1600, 3, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:36:24'),
(19, 3, 25, 7, 'Galaxy A71', 11, NULL, 33540, 4, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:36:29'),
(20, 9, 26, 7, 'data cards', 31, NULL, 504, 5, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:36:33'),
(21, 9, 27, 7, 'gaming headesets', 0, NULL, 1350, 6, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:36:39'),
(22, 3, 28, 7, 'for vivo', 67, NULL, 18900, 1, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:36:45'),
(23, 3, 29, 8, 'realme narzo 10a', 17, NULL, 15470, 2, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:36:51'),
(24, 3, 30, 8, 'poco x2', 19, NULL, 19570, 3, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:36:56'),
(25, 3, 31, 8, 'moto edge+', 0, NULL, 41590, 4, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:37:01'),
(26, 3, 32, 8, 'oppo a9', 0, NULL, 27830, 4, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:37:07'),
(27, 3, 33, 8, 'Samsung M11', 7, NULL, 23560, 5, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:37:13'),
(28, 3, NULL, 8, 'Samsung M01', 3, NULL, 13250, 6, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-12-23 02:26:21'),
(29, 12, 35, 9, 'grand pearl jewellery', 53, NULL, 8542, 1, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:37:24'),
(30, 4, 36, 9, 'dress', 29, NULL, 256, 2, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:37:30'),
(31, 4, 37, 9, 'lehenga cholis', 21, NULL, 9999, 3, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:37:37'),
(32, 5, 38, 9, 'puma', 26, NULL, 1125, 5, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:37:45'),
(33, 4, 39, 10, 'tshirts', 0, NULL, 107, 6, NULL, NULL, NULL, '', NULL, NULL, '2023-02-10 14:32:02', '2022-11-27 17:37:50'),
(34, 4, 40, 10, 'denim shirts', 54, NULL, 250, 1, NULL, NULL, NULL, '', NULL, NULL, '2023-02-14 05:15:35', '2022-11-27 17:37:56'),
(35, 4, 41, 10, 'popular cargos', 9, NULL, 780, 2, NULL, NULL, NULL, '', NULL, NULL, '2023-02-14 05:15:35', '2022-11-27 17:38:01'),
(36, 4, 42, 10, 'lungi', 62, NULL, 250, 3, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-14 05:15:35', '2022-11-27 17:38:06'),
(37, 4, 43, 10, 'cargos', 21, NULL, 125, 4, NULL, '\"<h6 font-size=\\\"20px\\\" font-weight=\\\"bold\\\" color=\\\"greyBase\\\" class=\\\"sc-dkPtyc etASfP\\\" style=\\\"padding: 0px; margin: 0px; box-sizing: border-box; color: rgb(51, 51, 51); font-style: normal; font-weight: 700; font-size: 20px; line-height: 28px; font-family: &quot;Mier bold&quot;; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\\\">Product Details<\\/h6><div class=\\\"sc-bdvvaa gUONYg ProductDescription__DetailsCardStyled-sc-1l1jg0i-0 bSoDEg ProductDescription__DetailsCardStyled-sc-1l1jg0i-0 bSoDEg\\\" color=\\\"white\\\" style=\\\"padding: 0px; margin: 16px 0px 0px; box-sizing: border-box; background-color: rgb(255, 255, 255); border-radius: 8px; overflow: auto; color: rgb(0, 0, 0); font-family: -apple-system, &quot;Helvetica Neue&quot;, sans-serif, &quot;Mier Book&quot;; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\\\"><p color=\\\"greyT1\\\" class=\\\"sc-dkPtyc dcoKRt pre pre\\\" font-size=\\\"16px\\\" font-weight=\\\"book\\\" style=\\\"padding: 0px; margin: 0px; box-sizing: border-box; color: rgb(102, 102, 102); font-style: normal; font-weight: 400; font-size: 16px; line-height: 20px; font-family: &quot;Mier book&quot;;\\\">Name&nbsp;:&nbsp;Cargo pants man black<\\/p><p color=\\\"greyT1\\\" class=\\\"sc-dkPtyc dcoKRt pre pre\\\" font-size=\\\"16px\\\" font-weight=\\\"book\\\" style=\\\"padding: 0px; margin: 0px; box-sizing: border-box; color: rgb(102, 102, 102); font-style: normal; font-weight: 400; font-size: 16px; line-height: 20px; font-family: &quot;Mier book&quot;;\\\">Fabric&nbsp;:&nbsp;Lycra<\\/p><p color=\\\"greyT1\\\" class=\\\"sc-dkPtyc dcoKRt pre pre\\\" font-size=\\\"16px\\\" font-weight=\\\"book\\\" style=\\\"padding: 0px; margin: 0px; box-sizing: border-box; color: rgb(102, 102, 102); font-style: normal; font-weight: 400; font-size: 16px; line-height: 20px; font-family: &quot;Mier book&quot;;\\\">Pattern&nbsp;:&nbsp;Self-Design<\\/p><p color=\\\"greyT1\\\" class=\\\"sc-dkPtyc dcoKRt pre pre\\\" font-size=\\\"16px\\\" font-weight=\\\"book\\\" style=\\\"padding: 0px; margin: 0px; box-sizing: border-box; color: rgb(102, 102, 102); font-style: normal; font-weight: 400; font-size: 16px; line-height: 20px; font-family: &quot;Mier book&quot;;\\\">Net Quantity (N)&nbsp;:&nbsp;1<\\/p><p color=\\\"greyT1\\\" class=\\\"sc-dkPtyc dcoKRt pre pre\\\" font-size=\\\"16px\\\" font-weight=\\\"book\\\" style=\\\"padding: 0px; margin: 0px; box-sizing: border-box; color: rgb(102, 102, 102); font-style: normal; font-weight: 400; font-size: 16px; line-height: 20px; font-family: &quot;Mier book&quot;;\\\">Ultra fashionable, durable, stretchable cargo style lower.high quality stylish ankle slim fit track.it is made up of polyester based lycra fabric which is used for making lycra lower or track pent.<\\/p><p color=\\\"greyT1\\\" class=\\\"sc-dkPtyc dcoKRt pre pre\\\" font-size=\\\"16px\\\" font-weight=\\\"book\\\" style=\\\"padding: 0px; margin: 0px; box-sizing: border-box; color: rgb(102, 102, 102); font-style: normal; font-weight: 400; font-size: 16px; line-height: 20px; font-family: &quot;Mier book&quot;;\\\">Sizes&nbsp;:&nbsp;<\\/p><p color=\\\"greyT1\\\" class=\\\"sc-dkPtyc dcoKRt pre pre\\\" font-size=\\\"16px\\\" font-weight=\\\"book\\\" style=\\\"padding: 0px; margin: 0px; box-sizing: border-box; color: rgb(102, 102, 102); font-style: normal; font-weight: 400; font-size: 16px; line-height: 20px; font-family: &quot;Mier book&quot;;\\\">28 (Waist Size&nbsp;:&nbsp;28 in, Length Size: 38 in)<\\/p><p color=\\\"greyT1\\\" class=\\\"sc-dkPtyc dcoKRt pre pre\\\" font-size=\\\"16px\\\" font-weight=\\\"book\\\" style=\\\"padding: 0px; margin: 0px; box-sizing: border-box; color: rgb(102, 102, 102); font-style: normal; font-weight: 400; font-size: 16px; line-height: 20px; font-family: &quot;Mier book&quot;;\\\">30, 32<\\/p><p color=\\\"greyT1\\\" class=\\\"sc-dkPtyc dcoKRt pre pre\\\" font-size=\\\"16px\\\" font-weight=\\\"book\\\" style=\\\"padding: 0px; margin: 0px; box-sizing: border-box; color: rgb(102, 102, 102); font-style: normal; font-weight: 400; font-size: 16px; line-height: 20px; font-family: &quot;Mier book&quot;;\\\">Country of Origin&nbsp;:&nbsp;India<\\/p><\\/div>\"', '\"<p><span style=\\\"color: rgb(153, 153, 153); font-family: &quot;Mier demi&quot;; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 600; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">Cargo pants man black<\\/span><\\/p>\"', NULL, NULL, NULL, '2023-02-14 05:15:35', '2022-11-27 17:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `signup_otp`
--

DROP TABLE IF EXISTS `signup_otp`;
CREATE TABLE IF NOT EXISTS `signup_otp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` mediumint NOT NULL,
  `otp_expire_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_log`
--

DROP TABLE IF EXISTS `sms_log`;
CREATE TABLE IF NOT EXISTS `sms_log` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `to` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_cost` tinyint NOT NULL,
  `message_balance` int NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_log`
--

INSERT INTO `sms_log` (`id`, `to`, `message_id`, `message_cost`, `message_balance`, `type`, `status`, `created_at`, `updated_at`) VALUES
(2, '8140996031', '150333', 1, 5, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-20 22:14:06', '2023-01-20 22:14:06'),
(3, '+918140996031', '150334', 1, 4, 'MESSAGE OTP FOR SIGNUP', 1, '2023-01-20 22:14:37', '2023-01-20 22:14:37'),
(4, '8140996031', '150333', 1, 3, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-22 06:18:00', '2023-01-22 06:18:00'),
(5, '8140996031', '150333', 1, 7, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-22 06:23:52', '2023-01-22 06:23:52'),
(6, '8140996031', '150333', 1, 6, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-22 06:27:27', '2023-01-22 06:27:27'),
(7, '8140996031', '150333', 1, 5, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-22 06:29:15', '2023-01-22 06:29:15'),
(8, '8140996031', '150333', 1, 4, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-22 06:32:40', '2023-01-22 06:32:40'),
(9, '8140996031', '150333', 1, 100, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-22 06:33:49', '2023-01-22 06:33:49'),
(10, '8140996031', '150333', 1, 99, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-22 06:35:21', '2023-01-22 06:35:21'),
(11, '8140996031', '150333', 1, 98, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-22 19:57:56', '2023-01-22 19:57:56'),
(12, '8140996033', '150333', 1, 97, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-23 02:06:45', '2023-01-23 02:06:45'),
(13, '8140996034', '150333', 1, 96, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-23 02:14:38', '2023-01-23 02:14:38'),
(14, '8140996035', '150333', 1, 95, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-23 02:15:25', '2023-01-23 02:15:25'),
(15, '8140996036', '150333', 1, 94, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-23 02:16:58', '2023-01-23 02:16:58'),
(16, '8140996037', '150333', 1, 93, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-23 02:17:53', '2023-01-23 02:17:53'),
(17, '8140996031', '150333', 1, 92, 'MESSAGE OTP FOR LOGIN', 1, '2023-01-23 02:19:34', '2023-01-23 02:19:34'),
(18, '8140996031', '150334', 1, 91, 'MESSAGE OTP FOR SIGNUP', 1, '2023-01-23 09:31:59', '2023-01-23 09:31:59'),
(19, '9428368811', '150334', 1, 90, 'MESSAGE OTP FOR SIGNUP', 1, '2023-01-23 09:38:15', '2023-01-23 09:38:15'),
(20, '9428368811', '150334', 1, 89, 'MESSAGE OTP FOR SIGNUP', 1, '2023-01-23 09:40:31', '2023-01-23 09:40:31'),
(21, '8140996040', '150334', 1, 88, 'MESSAGE OTP FOR SIGNUP', 1, '2023-01-23 09:51:13', '2023-01-23 09:51:13'),
(22, '8140996031', '150332', 1, 87, 'MESSAGE OTP FOR ACCEPT DELIVERY', 1, '2023-01-23 14:33:00', '2023-01-23 14:33:00'),
(23, '8140996031', '150333', 1, 86, 'MESSAGE OTP FOR LOGIN', 1, '2023-02-23 12:33:26', '2023-02-23 12:33:26'),
(24, '8140996031', '150323', 2, 85, 'MESSAGE ORDER CONFIRMED', 1, '2023-03-11 06:01:17', '2023-03-11 06:01:17'),
(25, '8140996031', '150323', 2, 83, 'MESSAGE ORDER CONFIRMED', 1, '2023-03-11 06:06:45', '2023-03-11 06:06:45'),
(26, '8140996031', '150323', 2, 81, 'MESSAGE ORDER CONFIRMED', 1, '2023-03-11 06:10:33', '2023-03-11 06:10:33'),
(27, '8140996031', '150325', 2, 79, 'MESSAGE ORDER DISPATCHED', 1, '2023-03-11 06:11:06', '2023-03-11 06:11:06'),
(28, '8140996031', '150324', 2, 77, 'MESSAGE ORDER OUT FOR DELIVERY', 1, '2023-03-11 06:12:43', '2023-03-11 06:12:43'),
(29, '8140996031', '150324', 2, 75, 'MESSAGE ORDER OUT FOR DELIVERY', 1, '2023-03-11 06:28:29', '2023-03-11 06:28:29'),
(30, '8140996031', '150332', 1, 73, 'MESSAGE OTP FOR ACCEPT DELIVERY', 1, '2023-03-11 06:28:29', '2023-03-11 06:28:29'),
(31, '8140996031', '150324', 2, 72, 'MESSAGE ORDER OUT FOR DELIVERY', 1, '2023-03-11 06:31:47', '2023-03-11 06:31:47'),
(32, '8140996031', '150332', 1, 70, 'MESSAGE OTP FOR ACCEPT DELIVERY', 1, '2023-03-11 06:31:48', '2023-03-11 06:31:48'),
(33, '8140996031', '150326', 1, 69, 'MESSAGE ORDER DELIVERED', 1, '2023-03-11 06:32:34', '2023-03-11 06:32:34'),
(34, '8140996031', '150333', 1, 68, 'MESSAGE OTP FOR LOGIN', 1, '2023-03-11 21:58:57', '2023-03-11 21:58:57'),
(35, '8140996031', '150334', 1, 67, 'MESSAGE OTP FOR SIGNUP', 1, '2023-03-12 03:58:11', '2023-03-12 03:58:11'),
(36, '8140996031', '150334', 1, 66, 'MESSAGE OTP FOR SIGNUP', 1, '2023-03-12 03:59:16', '2023-03-12 03:59:16'),
(37, '8140996031', '150334', 1, 65, 'MESSAGE OTP FOR SIGNUP', 1, '2023-03-12 03:59:50', '2023-03-12 03:59:50'),
(38, '8140996031', '150334', 1, 64, 'MESSAGE OTP FOR SIGNUP', 1, '2023-03-12 04:04:32', '2023-03-12 04:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `tier`
--

DROP TABLE IF EXISTS `tier`;
CREATE TABLE IF NOT EXISTS `tier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(121) NOT NULL,
  `sort_order` tinyint NOT NULL,
  `type_id` tinyint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tier`
--

INSERT INTO `tier` (`id`, `title`, `sort_order`, `type_id`, `created_at`, `updated_at`) VALUES
(1, 'Carousel Slider', 1, 0, '2022-11-14 10:35:30', '2022-12-10 13:40:08'),
(2, 'Deals of the day', 2, 1, '2022-11-14 05:07:14', '2022-12-10 13:40:08'),
(3, 'banner group 1', 3, 2, '2022-11-14 05:07:14', '2022-12-10 13:40:08'),
(4, 'Ease your daily chores', 4, 1, '2022-11-14 05:11:22', '2022-12-10 13:40:08'),
(5, 'Furniture Bestsellers', 5, 1, '2022-11-14 05:11:22', '2022-12-10 13:40:08'),
(6, 'banner group 2', 6, 2, '2022-11-14 05:11:22', '2022-12-10 13:40:08'),
(7, 'Best of Electronics', 7, 1, '2022-11-14 05:11:22', '2022-12-10 13:40:08'),
(8, 'Best battery phones', 8, 1, '2022-11-14 05:11:22', '2022-12-10 13:40:08'),
(9, 'Top deals on fashion', 9, 1, '2022-11-14 05:11:22', '2022-12-10 13:40:08'),
(10, 'Top picks on men\'s clothing', 10, 1, '2022-11-14 05:11:22', '2022-12-10 13:40:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` mediumint DEFAULT NULL,
  `shipping_user_address_id` int DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_sa` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expire_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `email`, `email_verified_at`, `password`, `otp`, `shipping_user_address_id`, `is_admin`, `is_sa`, `remember_token`, `otp_expire_at`, `created_at`, `updated_at`) VALUES
(1, 'Sachin Bhoi', '8140996030', 'givesachin@gmail.com', NULL, '$2a$12$p49pIbtQSAFVjlk0JvdioeqcwJ9BVJOA83ixKV9TVeEcRiXEKK76i', 209057, NULL, 1, 1, NULL, '2023-03-11 22:03:56', NULL, '2023-03-11 21:58:56'),
(2, 'Ruchit Patel 10', '8980452491', 'support@cryptical.in', NULL, '$2y$10$Cc49UrBVkXtyfoh31mXLhupj7akeclicoxUdSCtcafIc0C.B0P./y', 455930, 14, 1, 0, NULL, '2023-01-23 02:00:47', '2022-12-10 13:17:58', '2023-03-07 01:00:50'),
(14, 'Lol Bhoi', '8140996031', '3M9kBJdZYhYo2KaKpBGfKVQC6', NULL, '$2y$10$Q5riIJ5aMbPwDiLTMFu7Aun/cyx97BZzo1SyDD9R9dydAeoss0ijm', NULL, 16, 0, 0, NULL, NULL, '2023-03-12 04:08:41', '2023-03-12 04:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

DROP TABLE IF EXISTS `user_addresses`;
CREATE TABLE IF NOT EXISTS `user_addresses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `address_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `mobile` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `address_id`, `title`, `type`, `mobile`, `alt_mobile`, `created_at`, `updated_at`) VALUES
(13, 2, 5, 'new lol', 0, '68435', NULL, '2023-03-07 00:55:05', '2023-03-07 00:55:05'),
(10, 2, 2, 'Office', 0, '12345678', NULL, '2023-03-06 23:36:42', '2023-03-07 00:27:39'),
(9, 2, 2, 'Home', 0, '456', NULL, '2023-03-06 23:36:21', '2023-03-06 23:36:21'),
(12, 2, 4, 'lol', 0, '65431', NULL, '2023-03-07 00:53:09', '2023-03-07 00:53:09'),
(14, 2, 6, 'kjs,f', 0, '8140996031', NULL, '2023-03-11 11:25:13', '2023-03-11 11:25:13'),
(15, 2, 7, 'kjsbj,df', 0, '68432', NULL, '2023-03-07 01:01:53', '2023-03-07 01:01:53'),
(16, 14, 8, 'alknsf', 0, NULL, NULL, '2023-03-12 04:16:15', '2023-03-12 04:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `website`, `created_at`, `updated_at`) VALUES
(1, 'Flipkart', 'https://www.flipkart.com/', NULL, NULL),
(2, 'Amazon', 'https://www.amazon.in/', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
