-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 03:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cusorcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unique_identifier` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `activated` int(1) NOT NULL DEFAULT 1,
  `image` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `set_default` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `currency_format` char(10) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `google_plus` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `name`, `logo`, `currency_id`, `currency_format`, `facebook`, `twitter`, `instagram`, `youtube`, `google_plus`, `created_at`, `updated_at`) VALUES
(1, 'Active eCommerce', 'uploads/logo/matggar.png', 1, 'symbol', 'https://facebook.com', 'https://twitter.com', 'https://instagram.com', 'https://youtube.com', 'https://google.com', '2019-08-04 16:39:15', '2019-08-04 16:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Size', '2020-02-24 05:55:07', '2020-02-24 05:55:07'),
(2, 'Fabric Sizes', '2020-02-24 05:55:13', '2023-05-28 19:37:28'),
(3, 'Gender', '2023-05-28 13:07:29', '2023-05-28 13:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_translations`
--

CREATE TABLE `attribute_translations` (
  `id` bigint(20) NOT NULL,
  `attribute_id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lang` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attribute_translations`
--

INSERT INTO `attribute_translations` (`id`, `attribute_id`, `name`, `lang`, `created_at`, `updated_at`) VALUES
(1, 3, 'Gender', 'en', '2023-05-28 13:07:29', '2023-05-28 13:07:29'),
(2, 2, 'Fabric Sizes', 'en', '2023-05-28 19:37:28', '2023-05-28 19:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `color_code` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `color_code`, `created_at`, `updated_at`) VALUES
(1, 3, 'Male', NULL, '2023-05-28 19:35:49', '2023-05-28 19:35:49'),
(2, 3, 'Female', NULL, '2023-05-28 19:36:00', '2023-05-28 19:36:00'),
(3, 2, 'Small', NULL, '2023-05-28 19:38:04', '2023-05-28 19:38:04'),
(4, 2, 'Medium', NULL, '2023-05-28 19:38:22', '2023-05-28 19:38:22'),
(5, 2, 'Large', NULL, '2023-05-28 19:38:31', '2023-05-28 19:38:31'),
(6, 2, 'X-Large', NULL, '2023-05-28 19:38:44', '2023-05-28 19:38:44'),
(7, 2, 'XX-Large', NULL, '2023-05-28 19:38:56', '2023-05-28 19:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bankname` varchar(255) NOT NULL,
  `acount_no` int(30) NOT NULL,
  `acount_title` varchar(255) NOT NULL,
  `branch_code` int(15) NOT NULL,
  `branch_address` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `user_id`, `bankname`, `acount_no`, `acount_title`, `branch_code`, `branch_address`, `updated_at`) VALUES
(1, 6, 'United Bank For Africa', 2078455836, 'Nnadi Ifechukwu Paschal', 20784, 'Onitsha Bridge Head, Anambra State', '2023-05-30 16:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 1,
  `published` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `photo`, `url`, `position`, `published`, `created_at`, `updated_at`) VALUES
(4, 'uploads/banners/banner.jpg', '#', 1, 1, '2019-03-12 05:58:23', '2019-06-11 04:56:50'),
(5, 'uploads/banners/banner.jpg', '#', 1, 1, '2019-03-12 05:58:41', '2019-03-12 05:58:57'),
(6, 'uploads/banners/banner.jpg', '#', 2, 1, '2019-03-12 05:58:52', '2019-03-12 05:58:57'),
(7, 'uploads/banners/banner.jpg', '#', 2, 1, '2019-05-26 05:16:38', '2019-05-26 05:17:34'),
(8, 'uploads/banners/banner.jpg', '#', 2, 1, '2019-06-11 05:00:06', '2019-06-11 05:00:27'),
(9, 'uploads/banners/banner.jpg', '#', 1, 1, '2019-06-11 05:00:15', '2019-06-11 05:00:29'),
(10, 'uploads/banners/banner.jpg', '#', 1, 0, '2019-06-11 05:00:24', '2019-06-11 05:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `banner` int(11) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_img` int(11) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `top` int(1) NOT NULL DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `logo`, `top`, `slug`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Chevrolet', '53', 1, 'demo-brand-12', 'Chevrolet', 'Chevrolet brand', '2019-03-12 06:05:56', '2023-05-25 03:35:38'),
(2, 'JLO', '52', 1, 'jlo', 'JLO', 'JLO', '2019-03-12 06:06:13', '2023-05-25 03:37:22'),
(3, 'LOR', '51', 0, 'LOR-fSYxo', 'LOR', NULL, '2023-05-25 03:38:16', '2023-05-25 03:38:16'),
(4, 'Apple', '50', 0, 'Apple-1A1Hy', 'Apple', NULL, '2023-05-25 03:38:47', '2023-05-25 03:38:47'),
(5, 'Samsung', '49', 0, 'Samsung-h6Uj8', 'Samsung', NULL, '2023-05-25 03:39:23', '2023-05-25 03:39:23'),
(6, 'Sony', '48', 0, 'Sony-U3m0C', 'Sony', NULL, '2023-05-25 03:39:48', '2023-05-25 03:39:48'),
(7, 'Nokia', '47', 0, 'Nokia-T1kHk', 'Nokia', NULL, '2023-05-25 03:40:19', '2023-05-25 03:40:19'),
(8, 'HP', '54', 0, 'HP-NV9Ka', 'HP', NULL, '2023-05-25 03:41:27', '2023-05-25 03:41:27'),
(9, 'Dell', '46', 0, 'Dell-9goi8', 'Dell', NULL, '2023-05-25 03:42:01', '2023-05-25 03:42:01'),
(10, 'Lenovo', '45', 0, 'Lenovo-mqDib', 'Lenovo', NULL, '2023-05-25 03:42:29', '2023-05-25 03:42:29'),
(11, 'Acer', '44', 0, 'Acer-Jd71Z', 'Acer', NULL, '2023-05-25 03:42:53', '2023-05-25 03:42:53'),
(12, 'Under Armour', '43', 0, 'Under-Armour-Dx9SB', 'Under Armour', NULL, '2023-05-25 03:43:41', '2023-05-25 03:43:41'),
(13, 'Golden Penny', '42', 0, 'Golden-Penny-bKfHb', 'Golden Penny', NULL, '2023-05-25 03:44:10', '2023-05-25 03:44:10'),
(14, 'Balenciaga', '41', 0, 'Balenciaga-Tb50J', 'Balenciaga', NULL, '2023-05-25 03:44:45', '2023-05-25 03:44:45'),
(15, 'Givenchy', '40', 0, 'Givenchy-pNuJd', 'Givenchy', NULL, '2023-05-25 03:45:20', '2023-05-25 03:45:20'),
(16, 'Jordan', '39', 0, 'Jordan-vtDya', 'Jordan', NULL, '2023-05-25 03:45:54', '2023-05-25 03:45:54'),
(17, 'UGG', '38', 0, 'UGG-61gk6', 'UGG', NULL, '2023-05-25 03:46:25', '2023-05-25 03:46:25'),
(18, 'Reebok', '37', 0, 'Reebok-a8cqD', 'Reebok', NULL, '2023-05-25 03:47:05', '2023-05-25 03:47:05'),
(19, 'CC', '36', 0, 'CC-mLlc9', 'CC', NULL, '2023-05-25 03:47:38', '2023-05-25 03:47:38'),
(20, 'Innoson', '35', 0, 'Innoson-DkkKf', 'Innoson', NULL, '2023-05-25 03:48:09', '2023-05-25 03:48:09'),
(21, 'Nike', '34', 0, 'Nike-V2uag', 'Nike', NULL, '2023-05-25 03:48:43', '2023-05-25 03:48:43'),
(22, 'Puma', '33', 0, 'Puma-6iKAI', 'Puma', NULL, '2023-05-25 03:49:06', '2023-05-25 03:49:06'),
(23, 'Canon', '32', 0, 'Canon-Vh3h7', 'Canon', NULL, '2023-05-25 03:49:40', '2023-05-25 03:49:40'),
(24, 'Bose', '31', 0, 'Bose-047mB', 'Bose', NULL, '2023-05-25 03:50:15', '2023-05-25 03:50:15'),
(25, 'Epson', '30', 0, 'Epson-uIhcZ', 'Epson', NULL, '2023-05-25 03:50:50', '2023-05-25 03:50:50'),
(26, 'Gopro', '28', 0, 'Gopro-gAuPw', 'Gopro', NULL, '2023-05-25 03:51:23', '2023-05-25 03:51:23'),
(27, 'Sharp', '29', 0, 'Sharp-1DZPx', 'Sharp', NULL, '2023-05-25 03:51:56', '2023-05-25 03:51:56'),
(28, 'Amazon', '27', 0, 'Amazon-KI7im', 'Amazon', NULL, '2023-05-25 03:52:30', '2023-05-25 03:52:30');

-- --------------------------------------------------------

--
-- Table structure for table `brand_translations`
--

CREATE TABLE `brand_translations` (
  `id` bigint(20) NOT NULL,
  `brand_id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lang` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand_translations`
--

INSERT INTO `brand_translations` (`id`, `brand_id`, `name`, `lang`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chevrolet', 'en', '2023-05-25 03:35:38', '2023-05-25 03:35:38'),
(2, 2, 'JLO', 'en', '2023-05-25 03:37:22', '2023-05-25 03:37:22'),
(3, 3, 'LOR', 'en', '2023-05-25 03:38:17', '2023-05-25 03:38:17'),
(4, 4, 'Apple', 'en', '2023-05-25 03:38:47', '2023-05-25 03:38:47'),
(5, 5, 'Samsung', 'en', '2023-05-25 03:39:23', '2023-05-25 03:39:23'),
(6, 6, 'Sony', 'en', '2023-05-25 03:39:48', '2023-05-25 03:39:48'),
(7, 7, 'Nokia', 'en', '2023-05-25 03:40:19', '2023-05-25 03:40:19'),
(8, 8, 'HP', 'en', '2023-05-25 03:41:27', '2023-05-25 03:41:27'),
(9, 9, 'Dell', 'en', '2023-05-25 03:42:01', '2023-05-25 03:42:01'),
(10, 10, 'Lenovo', 'en', '2023-05-25 03:42:29', '2023-05-25 03:42:29'),
(11, 11, 'Acer', 'en', '2023-05-25 03:42:53', '2023-05-25 03:42:53'),
(12, 12, 'Under Armour', 'en', '2023-05-25 03:43:42', '2023-05-25 03:43:42'),
(13, 13, 'Golden Penny', 'en', '2023-05-25 03:44:10', '2023-05-25 03:44:10'),
(14, 14, 'Balenciaga', 'en', '2023-05-25 03:44:45', '2023-05-25 03:44:45'),
(15, 15, 'Givenchy', 'en', '2023-05-25 03:45:20', '2023-05-25 03:45:20'),
(16, 16, 'Jordan', 'en', '2023-05-25 03:45:54', '2023-05-25 03:45:54'),
(17, 17, 'UGG', 'en', '2023-05-25 03:46:25', '2023-05-25 03:46:25'),
(18, 18, 'Reebok', 'en', '2023-05-25 03:47:05', '2023-05-25 03:47:05'),
(19, 19, 'CC', 'en', '2023-05-25 03:47:38', '2023-05-25 03:47:38'),
(20, 20, 'Innoson', 'en', '2023-05-25 03:48:09', '2023-05-25 03:48:09'),
(21, 21, 'Nike', 'en', '2023-05-25 03:48:43', '2023-05-25 03:48:43'),
(22, 22, 'Puma', 'en', '2023-05-25 03:49:06', '2023-05-25 03:49:06'),
(23, 23, 'Canon', 'en', '2023-05-25 03:49:40', '2023-05-25 03:49:40'),
(24, 24, 'Bose', 'en', '2023-05-25 03:50:15', '2023-05-25 03:50:15'),
(25, 25, 'Epson', 'en', '2023-05-25 03:50:50', '2023-05-25 03:50:50'),
(26, 26, 'Gopro', 'en', '2023-05-25 03:51:24', '2023-05-25 03:51:24'),
(27, 27, 'Sharp', 'en', '2023-05-25 03:51:56', '2023-05-25 03:51:56'),
(28, 28, 'Amazon', 'en', '2023-05-25 03:52:30', '2023-05-25 03:52:30');

-- --------------------------------------------------------

--
-- Table structure for table `business_settings`
--

CREATE TABLE `business_settings` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `value` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_settings`
--

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'home_default_currency', '1', '2018-10-16 01:35:52', '2019-01-28 01:26:53'),
(2, 'system_default_currency', '1', '2018-10-16 01:36:58', '2023-06-09 01:24:57'),
(3, 'currency_format', '1', '2018-10-17 03:01:59', '2018-10-17 03:01:59'),
(4, 'symbol_format', '1', '2018-10-17 03:01:59', '2019-01-20 02:10:55'),
(5, 'no_of_decimals', '3', '2018-10-17 03:01:59', '2020-03-04 00:57:16'),
(6, 'product_activation', '1', '2018-10-28 01:38:37', '2019-02-04 01:11:41'),
(7, 'vendor_system_activation', '1', '2018-10-28 07:44:16', '2019-02-04 01:11:38'),
(8, 'show_vendors', '1', '2018-10-28 07:44:47', '2019-02-04 01:11:13'),
(9, 'paypal_payment', '1', '2018-10-28 07:45:16', '2023-05-28 21:38:04'),
(10, 'stripe_payment', '1', '2018-10-28 07:45:47', '2023-05-28 21:38:06'),
(11, 'cash_payment', '1', '2018-10-28 07:46:05', '2019-01-24 03:40:18'),
(12, 'payumoney_payment', '1', '2018-10-28 07:46:27', '2019-03-05 05:41:36'),
(13, 'best_selling', '1', '2018-12-24 08:13:44', '2019-02-14 05:29:13'),
(14, 'paypal_sandbox', '1', '2019-01-16 12:44:18', '2023-05-28 21:33:51'),
(15, 'sslcommerz_sandbox', '1', '2019-01-16 12:44:18', '2019-03-14 00:07:26'),
(16, 'sslcommerz_payment', '1', '2019-01-24 09:39:07', '2023-05-28 21:38:09'),
(17, 'vendor_commission', '20', '2019-01-31 06:18:04', '2019-04-13 06:49:26'),
(18, 'verification_form', '[{\"type\":\"text\",\"label\":\"Your name\"},{\"type\":\"text\",\"label\":\"Shop name\"},{\"type\":\"text\",\"label\":\"Email\"},{\"type\":\"text\",\"label\":\"License No\"},{\"type\":\"text\",\"label\":\"Full Address\"},{\"type\":\"text\",\"label\":\"Phone Number\"},{\"type\":\"file\",\"label\":\"Tax Papers\"}]', '2019-02-03 11:36:58', '2019-02-16 06:14:42'),
(19, 'google_analytics', '1', '2019-02-06 12:22:35', '2019-02-06 12:22:35'),
(20, 'facebook_login', '1', '2019-02-07 12:51:59', '2023-05-28 21:38:31'),
(21, 'google_login', '1', '2019-02-07 12:52:10', '2023-05-28 21:38:32'),
(22, 'twitter_login', '1', '2019-02-07 12:52:20', '2023-05-28 21:38:34'),
(23, 'payumoney_payment', '1', '2019-03-05 11:38:17', '2019-03-05 11:38:17'),
(24, 'payumoney_sandbox', '1', '2019-03-05 11:38:17', '2019-03-05 05:39:18'),
(36, 'facebook_chat', '0', '2019-04-15 11:45:04', '2023-05-28 21:24:40'),
(37, 'email_verification', '1', '2019-04-30 07:30:07', '2023-05-25 03:17:15'),
(38, 'wallet_system', '1', '2019-05-19 08:05:44', '2023-05-25 03:17:13'),
(39, 'coupon_system', '1', '2019-06-11 09:46:18', '2023-05-28 21:38:39'),
(40, 'current_version', '4.8', '2019-06-11 09:46:18', '2019-06-11 09:46:18'),
(41, 'instamojo_payment', '1', '2019-07-06 09:58:03', '2023-05-28 21:38:13'),
(42, 'instamojo_sandbox', '1', '2019-07-06 09:58:43', '2019-07-06 09:58:43'),
(43, 'razorpay', '1', '2019-07-06 09:58:43', '2023-05-28 21:38:15'),
(44, 'paystack', '1', '2019-07-21 13:00:38', '2023-05-28 21:38:16'),
(45, 'pickup_point', '1', '2019-10-17 11:50:39', '2023-05-28 21:37:52'),
(46, 'maintenance_mode', '0', '2019-10-17 11:51:04', '2019-10-17 11:51:04'),
(47, 'voguepay', '1', '2019-10-17 11:51:24', '2023-05-28 21:38:20'),
(48, 'voguepay_sandbox', '0', '2019-10-17 11:51:38', '2019-10-17 11:51:38'),
(50, 'category_wise_commission', '1', '2020-01-21 07:22:47', '2020-01-21 07:22:47'),
(51, 'conversation_system', '1', '2020-01-21 07:23:21', '2020-01-21 07:23:21'),
(52, 'guest_checkout_active', '1', '2020-01-22 07:36:38', '2020-01-22 07:36:38'),
(53, 'facebook_pixel', '1', '2020-01-22 11:43:58', '2020-01-22 11:43:58'),
(55, 'classified_product', '1', '2020-05-13 13:01:05', '2023-05-28 21:38:41'),
(56, 'pos_activation_for_seller', '1', '2020-06-11 09:45:02', '2020-06-11 09:45:02'),
(57, 'shipping_type', 'product_wise_shipping', '2020-07-01 13:49:56', '2020-07-01 13:49:56'),
(58, 'flat_rate_shipping_cost', '0', '2020-07-01 13:49:56', '2020-07-01 13:49:56'),
(59, 'shipping_cost_admin', '0', '2020-07-01 13:49:56', '2020-07-01 13:49:56'),
(60, 'payhere_sandbox', '0', '2020-07-30 18:23:53', '2020-07-30 18:23:53'),
(61, 'payhere', '1', '2020-07-30 18:23:53', '2023-05-28 21:38:21'),
(62, 'google_recaptcha', '0', '2020-08-17 07:13:37', '2023-06-09 10:13:51'),
(63, 'ngenius', '1', '2020-09-22 10:58:21', '2023-05-28 21:38:23'),
(64, 'header_logo', '8', '2020-11-16 07:26:36', '2023-05-25 20:50:48'),
(65, 'show_language_switcher', 'on', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(66, 'show_currency_switcher', 'on', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(67, 'header_stikcy', 'on', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(68, 'footer_logo', '2', '2020-11-16 07:26:36', '2023-05-25 02:21:57'),
(69, 'about_us_description', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(70, 'contact_address', 'Lagos, Nigeria', '2020-11-16 07:26:36', '2023-05-25 02:31:53'),
(71, 'contact_phone', '07032281281', '2020-11-16 07:26:36', '2023-05-25 02:31:53'),
(72, 'contact_email', 'nnadichime04@gmail.com', '2020-11-16 07:26:36', '2023-05-25 02:31:54'),
(73, 'widget_one_labels', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(74, 'widget_one_links', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(75, 'widget_one', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(76, 'frontend_copyright_text', 'cusorcart.com', '2020-11-16 07:26:36', '2023-05-25 02:33:51'),
(77, 'show_social_links', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(78, 'facebook_link', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(79, 'twitter_link', 'https://twitter.com/beekyhe', '2020-11-16 07:26:36', '2023-05-25 02:33:51'),
(80, 'instagram_link', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(81, 'youtube_link', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(82, 'linkedin_link', 'https://www.linkedin.com/in/nnadi-charles/', '2020-11-16 07:26:36', '2023-05-25 02:33:51'),
(83, 'payment_method_images', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(84, 'home_slider_images', '[17,19,24,25]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(85, 'home_slider_links', '[17,19,24,25]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(86, 'home_banner1_images', '[6,18]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(87, 'home_banner1_links', '[6,18]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(88, 'home_banner2_images', '[15,62]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(89, 'home_banner2_links', '[15,62]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(90, 'home_categories', '[]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(91, 'top10_categories', '[32, 7, 4, 6, 14, 17, 16]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(92, 'top10_brands', '[50]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(93, 'website_name', 'Cusorcart', '2020-11-16 07:26:36', '2023-05-25 04:45:38'),
(94, 'site_motto', 'Shop Anywhere & Ships Everywhere', '2020-11-16 07:26:36', '2023-05-25 04:45:38'),
(95, 'site_icon', '56', '2020-11-16 07:26:36', '2023-05-25 04:45:38'),
(96, 'base_color', '#e62e04', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(97, 'base_hov_color', '#e62e04', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(98, 'meta_title', 'Cusorcart | Shop Anywhere & Ships Everywhere', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(99, 'meta_description', 'Shop Anywhere & Ships Everywhere', '2020-11-16 07:26:36', '2023-05-28 21:45:33'),
(100, 'meta_keywords', 'Shop Anywhere & Ships Everywhere', '2020-11-16 07:26:36', '2023-05-28 21:45:33'),
(101, 'meta_image', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(102, 'site_name', 'Cusorcart', '2020-11-16 07:26:36', '2023-05-25 03:15:35'),
(103, 'system_logo_white', '10', '2020-11-16 07:26:36', '2023-05-25 03:15:35'),
(104, 'system_logo_black', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(105, 'timezone', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(106, 'admin_login_background', NULL, '2020-11-16 07:26:36', '2023-05-29 05:56:39'),
(107, 'iyzico_sandbox', '1', '2020-12-30 16:45:56', '2020-12-30 16:45:56'),
(108, 'iyzico', '1', '2020-12-30 16:45:56', '2020-12-30 16:45:56'),
(109, 'decimal_separator', '1', '2020-12-30 16:45:56', '2020-12-30 16:45:56'),
(110, 'nagad', '1', '2021-01-22 10:30:03', '2023-05-28 21:38:26'),
(111, 'bkash', '1', '2021-01-22 10:30:03', '2023-05-28 21:38:25'),
(112, 'bkash_sandbox', '1', '2021-01-22 10:30:03', '2021-01-22 10:30:03'),
(113, 'header_menu_labels', '[\"Home\",\"Flash Sale\",\"All Brands\",\"All Categories\",\"Fashions\",\"Seasonal Deals\",\"Gift Cards\",\"Electronics\",\"Phones & Tablets\",\"Beauty & Personal Care\"]', '2021-02-16 02:43:11', '2023-06-09 01:21:15'),
(114, 'header_menu_links', '[\"http:\\/\\/127.0.0.1:8000\",\"http:\\/\\/127.0.0.1:8000\\/flash-deals\",\"http:\\/\\/127.0.0.1:8000\\/brands\",\"http:\\/\\/127.0.0.1:8000\\/categories\",\"http:\\/\\/127.0.0.1:8000\\/category\\/Clothing--Shoes-rTDY8\",\"http:\\/\\/127.0.0.1:8000\\/flash-deals\",\"http:\\/\\/127.0.0.1:8000\\/gift-cards\",\"http:\\/\\/127.0.0.1:8000\\/electronics\",\"http:\\/\\/127.0.0.1:8000\\/phones-and-tablets\",\"http:\\/\\/127.0.0.1:8000\\/beauty-and-personal-care\"]', '2021-02-16 02:43:11', '2023-06-09 01:21:15'),
(115, 'proxypay', '1', '2021-06-20 11:25:42', '2021-06-20 11:25:42'),
(116, 'proxypay_sandbox', '1', '2021-06-20 11:25:42', '2021-06-20 11:25:42'),
(117, 'play_store_link', NULL, '2023-05-25 02:28:32', '2023-05-25 02:28:32'),
(118, 'app_store_link', NULL, '2023-05-25 02:28:32', '2023-05-25 02:28:32'),
(120, 'topbar_banner', NULL, '2023-05-25 04:40:04', '2023-05-25 14:59:42'),
(121, 'topbar_banner_link', 'http://127.0.0.1:8000/', '2023-05-25 04:40:04', '2023-05-25 04:40:04'),
(123, 'product_manage_by_admin', '1', '2023-05-28 21:37:59', '2023-05-28 21:37:59'),
(124, 'show_website_popup', 'on', '2023-05-28 21:44:45', '2023-05-28 21:44:45'),
(125, 'website_popup_content', '<p><br></p>', '2023-05-28 21:44:45', '2023-05-28 21:44:45'),
(126, 'show_subscribe_form', 'on', '2023-05-28 21:44:45', '2023-05-28 21:44:45'),
(127, 'cookies_agreement_text', '<p>Nah weh deh run this town, accept cokies joor?</p>', '2023-05-28 21:46:16', '2023-05-28 21:46:16'),
(128, 'show_cookies_agreement', NULL, '2023-05-28 21:46:16', '2023-05-28 21:49:06'),
(129, 'disable_image_optimization', '0', '2023-06-07 02:45:12', '2023-06-07 02:45:12'),
(130, 'delivery_boy_payment_type', 'commission', '2023-06-07 02:50:27', '2023-06-07 02:50:27'),
(131, 'delivery_boy_mail_notification', '1', '2023-06-07 02:51:04', '2023-06-07 02:51:04'),
(132, 'delivery_boy_otp_notification', '1', '2023-06-07 02:51:32', '2023-06-07 02:51:32');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) UNSIGNED NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `neck` int(20) DEFAULT NULL,
  `chest` int(20) DEFAULT NULL,
  `size` int(20) DEFAULT NULL,
  `waist` int(11) DEFAULT NULL,
  `qty` int(20) DEFAULT NULL,
  `size_type` varchar(255) DEFAULT NULL,
  `gender` char(115) DEFAULT NULL,
  `sleeves` int(20) DEFAULT NULL,
  `temp_user_id` varchar(255) DEFAULT NULL,
  `address_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) DEFAULT NULL,
  `variation` text DEFAULT NULL,
  `price` double(8,2) DEFAULT 0.00,
  `tax` double(8,2) DEFAULT 0.00,
  `shipping_cost` double(8,2) DEFAULT 0.00,
  `shipping_type` varchar(30) NOT NULL DEFAULT '',
  `pickup_point` int(11) DEFAULT NULL,
  `discount` double(10,2) NOT NULL DEFAULT 0.00,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_applied` tinyint(4) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `level` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) NOT NULL,
  `tax` int(11) DEFAULT NULL,
  `order_level` int(11) NOT NULL DEFAULT 0,
  `commision_rate` double(8,2) NOT NULL DEFAULT 0.00,
  `banner` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `featured` int(1) NOT NULL DEFAULT 0,
  `top` int(1) NOT NULL DEFAULT 0,
  `digital` int(1) NOT NULL DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `level`, `name`, `tax`, `order_level`, `commision_rate`, `banner`, `icon`, `featured`, `top`, `digital`, `slug`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 15, 1, 'Automotive Parts & Accessories', NULL, 2, 0.00, NULL, NULL, 1, 1, 0, 'automotive parts & accessories', 'Automotive Parts & Accessories', NULL, '2023-05-25 16:30:35', '2023-05-25 15:30:35'),
(4, 0, 0, 'Books', 1, 5, 2.00, '118', '117', 1, 1, 0, 'books-4jt62', 'books', 'books', '2023-06-07 03:28:01', '2023-06-07 02:28:01'),
(5, 0, 0, 'Digital Educational Resources', NULL, 0, 0.00, NULL, NULL, 1, 0, 0, 'Digital-Educational-Resources-CHZOq', NULL, NULL, '2023-05-25 04:09:03', '2023-05-25 03:09:03'),
(6, 0, 0, 'Electronics & Gadgets', 1, 6, 3.00, '120', '119', 1, 0, 0, 'electronics--gadgets-dcvn8', 'Electronics', 'Electronics', '2023-06-07 03:32:39', '2023-06-07 02:32:39'),
(7, 0, 0, 'Computers', 1, 4, 2.00, '115', '116', 1, 0, 0, 'computers-qzk1i', 'computers', 'computers', '2023-06-07 03:23:33', '2023-06-07 02:23:33'),
(8, 0, 0, 'Smart Home', NULL, 0, 0.00, NULL, NULL, 1, 0, 0, 'Smart-Home-KNQ1y', NULL, NULL, '2023-05-25 04:11:09', '2023-05-25 03:11:09'),
(9, 0, 0, 'Home, Garden & Tools', NULL, 0, 0.00, NULL, NULL, 1, 0, 0, 'Home-Garden--Tools-UGAEa', NULL, NULL, '2023-05-25 04:11:44', '2023-05-25 03:11:44'),
(10, 0, 0, 'Pet Supplies', NULL, 0, 0.00, NULL, NULL, 1, 0, 0, 'Pet-Supplies-CVg5E', NULL, NULL, '2023-05-25 04:21:52', '2023-05-25 03:21:52'),
(11, 0, 0, 'Beauty & Health', NULL, 0, 0.00, NULL, NULL, 1, 0, 0, 'Beauty--Health-roWrF', NULL, NULL, '2023-05-25 04:22:20', '2023-05-25 03:22:20'),
(12, 0, 0, 'Toys, Kids & Baby', NULL, 0, 0.00, NULL, NULL, 1, 0, 0, 'Toys-Kids--Baby-GFfo5', NULL, NULL, '2023-05-25 16:26:43', '2023-05-25 15:26:43'),
(13, 0, 0, 'Handmade', NULL, 0, 0.00, NULL, NULL, 1, 0, 0, 'Handmade-DSHEy', NULL, NULL, '2023-05-25 16:26:44', '2023-05-25 15:26:44'),
(14, 0, 0, 'Sports', 1, 11, 2.00, '128', '127', 1, 0, 0, 'sports-yneju', 'Sports', 'Sports', '2023-06-09 01:36:31', '2023-06-09 00:36:31'),
(15, 0, 0, 'Automotive & Industrial', NULL, 0, 0.00, NULL, NULL, 1, 0, 0, 'Automotive--Industrial-Zm0WE', NULL, NULL, '2023-05-25 16:26:47', '2023-05-25 15:26:47'),
(16, 0, 0, 'Office Supplies', 1, 3, 2.00, '126', '125', 1, 0, 0, 'office-supplies-sihmo', 'Office Supplies', 'Office Supplies', '2023-06-09 01:27:31', '2023-06-09 00:27:31'),
(17, 0, 0, 'Gift Cards', 1, 3, 2.00, '122', '121', 1, 0, 0, 'gift-cards-wwizl', 'Gift Card', 'Gift Card', '2023-06-09 01:04:06', '2023-06-09 00:04:06'),
(18, 0, 0, 'Jewelry & Watches', NULL, 0, 0.00, NULL, NULL, 1, 0, 0, 'Jewelry--Watches-HU4u3', NULL, NULL, '2023-05-25 16:26:32', '2023-05-25 15:26:32'),
(20, 15, 1, 'Automotive Tools & Equipment', NULL, 0, 0.00, NULL, NULL, 0, 0, 0, 'automotive tools & equipment', 'Automotive Tools & Equipment', NULL, '2023-05-25 16:34:54', '2023-05-25 15:34:54'),
(21, 15, 1, 'Car/Vehicle Electronics & GPS', NULL, 0, 0.00, NULL, NULL, 0, 0, 0, 'CarVehicle-Electronics--GPS-IOGsC', 'Car/Vehicle Electronics & GPS', NULL, '2023-05-25 15:37:32', '2023-05-25 15:37:32'),
(22, 15, 1, 'Tires & Wheels', NULL, 0, 0.00, NULL, NULL, 0, 0, 0, 'Tires--Wheels-6xya4', 'Tires & Wheels', NULL, '2023-05-25 15:38:19', '2023-05-25 15:38:19'),
(23, 15, 1, 'Motorcycle & Powersports', NULL, 0, 0.00, NULL, NULL, 0, 0, 0, 'Motorcycle--Powersports-moP5r', 'Motorcycle & Powersports', NULL, '2023-05-25 15:39:38', '2023-05-25 15:39:38'),
(24, 15, 1, 'RV Parts & Accessories', NULL, 0, 0.00, NULL, NULL, 0, 0, 0, 'RV-Parts--Accessories-9RBEm', 'RV Parts & Accessories', NULL, '2023-05-25 15:40:34', '2023-05-25 15:40:34'),
(25, 15, 1, 'Vehicles (Brand New)', NULL, 0, 0.00, NULL, NULL, 0, 0, 0, 'Vehicles-Brand-New-JzzpS', 'Vehicles (Brand New)', NULL, '2023-05-25 15:41:14', '2023-05-25 15:41:14'),
(26, 15, 1, 'Vehicles (Pre-Owned)', NULL, 0, 0.00, NULL, NULL, 0, 0, 0, 'Vehicles-Pre-Owned-4qlsV', 'Vehicles (Pre-Owned)', NULL, '2023-05-25 15:42:06', '2023-05-25 15:42:06'),
(27, 15, 1, 'Industrial Supplies', NULL, 0, 0.00, NULL, NULL, 0, 0, 0, 'Industrial-Supplies-MwuXg', 'Industrial Supplies', 'Industrial Supplies', '2023-05-25 15:43:17', '2023-05-25 15:43:17'),
(28, 15, 1, 'Lab & Scientific', NULL, 0, 0.00, NULL, NULL, 0, 0, 0, 'Lab--Scientific-gaBvO', 'Lab & Scientific', 'Lab & Scientific', '2023-05-25 15:44:01', '2023-05-25 15:44:01'),
(29, 15, 1, 'Janitorial', NULL, 0, 0.00, NULL, NULL, 0, 0, 0, 'Janitorial-28e3E', 'Janitorial', 'Janitorial', '2023-05-25 15:44:39', '2023-05-25 15:44:39'),
(30, 15, 1, 'Safety', NULL, 0, 0.00, NULL, NULL, 0, 0, 0, 'Safety-xsmS0', 'Safety', 'Safety', '2023-05-25 15:45:26', '2023-05-25 15:45:26'),
(31, 15, 1, 'Material Handling', NULL, 0, 0.00, NULL, NULL, 0, 0, 0, 'Material-Handling-QDkPp', 'Material Handling', 'Material Handling', '2023-05-25 15:46:08', '2023-05-25 15:46:08'),
(32, 0, 0, 'Clothing & Shoes', 1, 11, 3.00, '123', '124', 1, 0, 0, 'clothing--shoes-rtdy8', 'Clothing & Shoes', 'Clothing & Shoes', '2023-06-09 01:14:31', '2023-06-09 00:14:31'),
(33, 32, 1, 'Men', NULL, 1, 0.00, NULL, NULL, 1, 0, 0, 'men-lhfre', 'Men', 'men', '2023-05-26 05:22:27', '2023-05-26 04:22:27'),
(34, 32, 1, 'Women', 1, 1, 3.00, NULL, NULL, 1, 0, 0, 'women-sztow', 'Women', 'Women', '2023-06-09 01:15:13', '2023-06-09 00:15:13'),
(35, 32, 1, 'Boys', NULL, 1, 0.00, NULL, NULL, 1, 0, 0, 'boys-iumrv', 'Boys', 'Boys', '2023-06-09 01:15:56', '2023-06-09 00:15:56'),
(36, 32, 1, 'Girls', NULL, 1, 0.00, NULL, NULL, 1, 0, 0, 'girls-uqmsy', 'Girls', 'Girls', '2023-06-09 01:16:33', '2023-06-09 00:16:33'),
(37, 32, 1, 'Baby', NULL, 1, 0.00, NULL, NULL, 1, 0, 0, 'baby-mydqg', 'Baby', 'Baby', '2023-06-09 01:17:15', '2023-06-09 00:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

CREATE TABLE `category_translations` (
  `id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lang` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `name`, `lang`, `created_at`, `updated_at`) VALUES
(1, 1, 'Automotive Parts & Accessories', 'en', '2023-05-25 02:53:45', '2023-05-25 15:30:35'),
(2, 4, 'Books', 'en', '2023-05-25 03:08:28', '2023-05-25 03:08:28'),
(3, 5, 'Digital Educational Resources', 'en', '2023-05-25 03:08:55', '2023-05-25 03:08:55'),
(4, 6, 'Electronics & Gadgets', 'en', '2023-05-25 03:10:10', '2023-05-25 03:10:10'),
(5, 7, 'Computers', 'en', '2023-05-25 03:10:29', '2023-05-25 03:10:29'),
(6, 8, 'Smart Home', 'en', '2023-05-25 03:10:53', '2023-05-25 03:10:53'),
(7, 9, 'Home, Garden & Tools', 'en', '2023-05-25 03:11:36', '2023-05-25 03:11:36'),
(8, 10, 'Pet Supplies', 'en', '2023-05-25 03:21:40', '2023-05-25 03:21:40'),
(9, 11, 'Beauty & Health', 'en', '2023-05-25 03:22:09', '2023-05-25 03:22:09'),
(10, 12, 'Toys, Kids & Baby', 'en', '2023-05-25 03:22:36', '2023-05-25 03:22:36'),
(11, 13, 'Handmade', 'en', '2023-05-25 03:22:58', '2023-05-25 03:22:58'),
(12, 14, 'Sports', 'en', '2023-05-25 03:23:15', '2023-05-25 03:23:15'),
(13, 15, 'Automotive & Industrial', 'en', '2023-05-25 03:24:58', '2023-05-25 03:24:58'),
(14, 16, 'Office Supplies', 'en', '2023-05-25 03:25:28', '2023-05-25 03:25:28'),
(15, 17, 'Gift Cards', 'en', '2023-05-25 03:25:46', '2023-05-25 03:25:46'),
(16, 18, 'Jewelry & Watches', 'en', '2023-05-25 03:26:03', '2023-05-25 03:26:03'),
(18, 20, 'Automotive Tools & Equipment', 'en', '2023-05-25 15:32:51', '2023-05-25 15:34:54'),
(19, 21, 'Car/Vehicle Electronics & GPS', 'en', '2023-05-25 15:37:32', '2023-05-25 15:37:32'),
(20, 22, 'Tires & Wheels', 'en', '2023-05-25 15:38:19', '2023-05-25 15:38:19'),
(21, 23, 'Motorcycle & Powersports', 'en', '2023-05-25 15:39:38', '2023-05-25 15:39:38'),
(22, 24, 'RV Parts & Accessories', 'en', '2023-05-25 15:40:34', '2023-05-25 15:40:34'),
(23, 25, 'Vehicles (Brand New)', 'en', '2023-05-25 15:41:14', '2023-05-25 15:41:14'),
(24, 26, 'Vehicles (Pre-Owned)', 'en', '2023-05-25 15:42:06', '2023-05-25 15:42:06'),
(25, 27, 'Industrial Supplies', 'en', '2023-05-25 15:43:17', '2023-05-25 15:43:17'),
(26, 28, 'Lab & Scientific', 'en', '2023-05-25 15:44:01', '2023-05-25 15:44:01'),
(27, 29, 'Janitorial', 'en', '2023-05-25 15:44:39', '2023-05-25 15:44:39'),
(28, 30, 'Safety', 'en', '2023-05-25 15:45:26', '2023-05-25 15:45:26'),
(29, 31, 'Material Handling', 'en', '2023-05-25 15:46:08', '2023-05-25 15:46:08'),
(30, 32, 'Clothing & Shoes', 'en', '2023-05-25 15:55:28', '2023-05-25 15:55:28'),
(31, 33, 'Men', 'en', '2023-05-25 15:56:30', '2023-05-25 15:56:30'),
(32, 34, 'Women', 'en', '2023-05-26 18:44:18', '2023-05-26 18:44:18'),
(33, 35, 'Boys', 'en', '2023-05-26 18:45:02', '2023-05-26 18:45:02'),
(34, 36, 'Girls', 'en', '2023-05-26 18:45:56', '2023-05-26 18:45:56'),
(35, 37, 'Baby', 'en', '2023-05-26 18:46:39', '2023-05-26 18:46:39');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `state_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 161,
  `cost` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci COMMENT='Cities in Nigeria.';

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`, `country_id`, `cost`) VALUES
(1, 1, 'Aba North', 161, 0),
(2, 1, 'Aba South', 161, 0),
(3, 1, 'Arochukwu', 161, 0),
(4, 1, 'Bende', 161, 0),
(5, 1, 'Ikwuano', 161, 0),
(6, 1, 'Isiala Ngwa North', 161, 0),
(7, 1, 'Isiala Ngwa South', 161, 0),
(8, 1, 'Isuikwuato', 161, 0),
(9, 1, 'Obi Ngwa', 161, 0),
(10, 1, 'Ohafia', 161, 0),
(11, 1, 'Osisioma', 161, 0),
(12, 1, 'Ugwunagbo', 161, 0),
(13, 1, 'Ukwa East', 161, 0),
(14, 1, 'Ukwa West', 161, 0),
(15, 1, 'Umuahia North', 161, 0),
(16, 1, 'Umuahia South', 161, 0),
(17, 1, 'Umu Nneochi', 161, 0),
(18, 2, 'Demsa', 161, 0),
(19, 2, 'Fufure', 161, 0),
(20, 2, 'Ganye', 161, 0),
(21, 2, 'Gayuk', 161, 0),
(22, 2, 'Gombi', 161, 0),
(23, 2, 'Grie', 161, 0),
(24, 2, 'Hong', 161, 0),
(25, 2, 'Jada', 161, 0),
(26, 2, 'Larmurde', 161, 0),
(27, 2, 'Madagali', 161, 0),
(28, 2, 'Maiha', 161, 0),
(29, 2, 'Mayo Belwa', 161, 0),
(30, 2, 'Michika', 161, 0),
(31, 2, 'Mubi North', 161, 0),
(32, 2, 'Mubi South', 161, 0),
(33, 2, 'Numan', 161, 0),
(34, 2, 'Shelleng', 161, 0),
(35, 2, 'Song', 161, 0),
(36, 2, 'Toungo', 161, 0),
(37, 2, 'Yola North', 161, 0),
(38, 2, 'Yola South', 161, 0),
(39, 3, 'Abak', 161, 0),
(40, 3, 'Eastern Obolo', 161, 0),
(41, 3, 'Eket', 161, 0),
(42, 3, 'Esit Eket', 161, 0),
(43, 3, 'Essien Udim', 161, 0),
(44, 3, 'Etim Ekpo', 161, 0),
(45, 3, 'Etinan', 161, 0),
(46, 3, 'Ibeno', 161, 0),
(47, 3, 'Ibesikpo Asutan', 161, 0),
(48, 3, 'Ibiono-Ibom', 161, 0),
(49, 3, 'Ika', 161, 0),
(50, 3, 'Ikono', 161, 0),
(51, 3, 'Ikot Abasi', 161, 0),
(52, 3, 'Ikot Ekpene', 161, 0),
(53, 3, 'Ini', 161, 0),
(54, 3, 'Itu', 161, 0),
(55, 3, 'Mbo', 161, 0),
(56, 3, 'Mkpat-Enin', 161, 0),
(57, 3, 'Nsit-Atai', 161, 0),
(58, 3, 'Nsit-Ibom', 161, 0),
(59, 3, 'Nsit-Ubium', 161, 0),
(60, 3, 'Obot Akara', 161, 0),
(61, 3, 'Okobo', 161, 0),
(62, 3, 'Onna', 161, 0),
(63, 3, 'Oron', 161, 0),
(64, 3, 'Oruk Anam', 161, 0),
(65, 3, 'Udung-Uko', 161, 0),
(66, 3, 'Ukanafun', 161, 0),
(67, 3, 'Uruan', 161, 0),
(68, 3, 'Urue-Offong/Oruko', 161, 0),
(69, 3, 'Uyo', 161, 0),
(70, 4, 'Aguata', 161, 0),
(71, 4, 'Anambra East', 161, 0),
(72, 4, 'Anambra West', 161, 0),
(73, 4, 'Anaocha', 161, 0),
(74, 4, 'Awka North', 161, 0),
(75, 4, 'Awka South', 161, 0),
(76, 4, 'Ayamelum', 161, 0),
(77, 4, 'Dunukofia', 161, 0),
(78, 4, 'Ekwusigo', 161, 0),
(79, 4, 'Idemili North', 161, 0),
(80, 4, 'Idemili South', 161, 0),
(81, 4, 'Ihiala', 161, 0),
(82, 4, 'Njikoka', 161, 0),
(83, 4, 'Nnewi North', 161, 0),
(84, 4, 'Nnewi South', 161, 0),
(85, 4, 'Ogbaru', 161, 0),
(86, 4, 'Onitsha North', 161, 0),
(87, 4, 'Onitsha South', 161, 0),
(88, 4, 'Orumba North', 161, 0),
(89, 4, 'Orumba South', 161, 0),
(90, 4, 'Oyi', 161, 0),
(91, 5, 'Alkaleri', 161, 0),
(92, 5, 'Bauchi', 161, 0),
(93, 5, 'Bogoro', 161, 0),
(94, 5, 'Damban', 161, 0),
(95, 5, 'Darazo', 161, 0),
(96, 5, 'Dass', 161, 0),
(97, 5, 'Gamawa', 161, 0),
(98, 5, 'Ganjuwa', 161, 0),
(99, 5, 'Giade', 161, 0),
(100, 5, 'Itas/Gadau', 161, 0),
(101, 5, 'Jama\'are', 161, 0),
(102, 5, 'Katagum', 161, 0),
(103, 5, 'Kirfi', 161, 0),
(104, 5, 'Misau', 161, 0),
(105, 5, 'Ningi', 161, 0),
(106, 5, 'Shira', 161, 0),
(107, 5, 'Tafawa Balewa', 161, 0),
(108, 5, 'Toro', 161, 0),
(109, 5, 'Warji', 161, 0),
(110, 5, 'Zaki', 161, 0),
(111, 6, 'Brass', 161, 0),
(112, 6, 'Ekeremor', 161, 0),
(113, 6, 'Kolokuma/Opokuma', 161, 0),
(114, 6, 'Nembe', 161, 0),
(115, 6, 'Ogbia', 161, 0),
(116, 6, 'Sagbama', 161, 0),
(117, 6, 'Southern Ijaw', 161, 0),
(118, 6, 'Yenagoa', 161, 0),
(119, 7, 'Agatu', 161, 0),
(120, 7, 'Apa', 161, 0),
(121, 7, 'Ado', 161, 0),
(122, 7, 'Buruku', 161, 0),
(123, 7, 'Gboko', 161, 0),
(124, 7, 'Guma', 161, 0),
(125, 7, 'Gwer East', 161, 0),
(126, 7, 'Gwer West', 161, 0),
(127, 7, 'Katsina-Ala', 161, 0),
(128, 7, 'Konshisha', 161, 0),
(129, 7, 'Kwande', 161, 0),
(130, 7, 'Logo', 161, 0),
(131, 7, 'Makurdi', 161, 0),
(132, 7, 'Obi', 161, 0),
(133, 7, 'Ogbadibo', 161, 0),
(134, 7, 'Ohimini', 161, 0),
(135, 7, 'Oju', 161, 0),
(136, 7, 'Okpokwu', 161, 0),
(137, 7, 'Oturkpo', 161, 0),
(138, 7, 'Tarka', 161, 0),
(139, 7, 'Ukum', 161, 0),
(140, 7, 'Ushongo', 161, 0),
(141, 7, 'Vandeikya', 161, 0),
(142, 8, 'Abadam', 161, 0),
(143, 8, 'Askira/Uba', 161, 0),
(144, 8, 'Bama', 161, 0),
(145, 8, 'Bayo', 161, 0),
(146, 8, 'Biu', 161, 0),
(147, 8, 'Chibok', 161, 0),
(148, 8, 'Damboa', 161, 0),
(149, 8, 'Dikwa', 161, 0),
(150, 8, 'Gubio', 161, 0),
(151, 8, 'Guzamala', 161, 0),
(152, 8, 'Gwoza', 161, 0),
(153, 8, 'Hawul', 161, 0),
(154, 8, 'Jere', 161, 0),
(155, 8, 'Kaga', 161, 0),
(156, 8, 'Kala/Balge', 161, 0),
(157, 8, 'Konduga', 161, 0),
(158, 8, 'Kukawa', 161, 0),
(159, 8, 'Kwaya Kusar', 161, 0),
(160, 8, 'Mafa', 161, 0),
(161, 8, 'Magumeri', 161, 0),
(162, 8, 'Maiduguri', 161, 0),
(163, 8, 'Marte', 161, 0),
(164, 8, 'Mobbar', 161, 0),
(165, 8, 'Monguno', 161, 0),
(166, 8, 'Ngala', 161, 0),
(167, 8, 'Nganzai', 161, 0),
(168, 8, 'Shani', 161, 0),
(169, 9, 'Abi', 161, 0),
(170, 9, 'Akamkpa', 161, 0),
(171, 9, 'Akpabuyo', 161, 0),
(172, 9, 'Bakassi', 161, 0),
(173, 9, 'Bekwarra', 161, 0),
(174, 9, 'Biase', 161, 0),
(175, 9, 'Boki', 161, 0),
(176, 9, 'Calabar Municipal', 161, 0),
(177, 9, 'Calabar South', 161, 0),
(178, 9, 'Etung', 161, 0),
(179, 9, 'Ikom', 161, 0),
(180, 9, 'Obanliku', 161, 0),
(181, 9, 'Obubra', 161, 0),
(182, 9, 'Obudu', 161, 0),
(183, 9, 'Odukpani', 161, 0),
(184, 9, 'Ogoja', 161, 0),
(185, 9, 'Yakuur', 161, 0),
(186, 9, 'Yala', 161, 0),
(187, 10, 'Aniocha North', 161, 0),
(188, 10, 'Aniocha South', 161, 0),
(189, 10, 'Bomadi', 161, 0),
(190, 10, 'Burutu', 161, 0),
(191, 10, 'Ethiope East', 161, 0),
(192, 10, 'Ethiope West', 161, 0),
(193, 10, 'Ika North East', 161, 0),
(194, 10, 'Ika South', 161, 0),
(195, 10, 'Isoko North', 161, 0),
(196, 10, 'Isoko South', 161, 0),
(197, 10, 'Ndokwa East', 161, 0),
(198, 10, 'Ndokwa West', 161, 0),
(199, 10, 'Okpe', 161, 0),
(200, 10, 'Oshimili North', 161, 0),
(201, 10, 'Oshimili South', 161, 0),
(202, 10, 'Patani', 161, 0),
(203, 10, 'Sapele, Delta', 161, 0),
(204, 10, 'Udu', 161, 0),
(205, 10, 'Ughelli North', 161, 0),
(206, 10, 'Ughelli South', 161, 0),
(207, 10, 'Ukwuani', 161, 0),
(208, 10, 'Uvwie', 161, 0),
(209, 10, 'Warri North', 161, 0),
(210, 10, 'Warri South', 161, 0),
(211, 10, 'Warri South West', 161, 0),
(212, 11, 'Abakaliki', 161, 0),
(213, 11, 'Afikpo North', 161, 0),
(214, 11, 'Afikpo South', 161, 0),
(215, 11, 'Ebonyi', 161, 0),
(216, 11, 'Ezza North', 161, 0),
(217, 11, 'Ezza South', 161, 0),
(218, 11, 'Ikwo', 161, 0),
(219, 11, 'Ishielu', 161, 0),
(220, 11, 'Ivo', 161, 0),
(221, 11, 'Izzi', 161, 0),
(222, 11, 'Ohaozara', 161, 0),
(223, 11, 'Ohaukwu', 161, 0),
(224, 11, 'Onicha', 161, 0),
(225, 12, 'Akoko-Edo', 161, 0),
(226, 12, 'Egor', 161, 0),
(227, 12, 'Esan Central', 161, 0),
(228, 12, 'Esan North-East', 161, 0),
(229, 12, 'Esan South-East', 161, 0),
(230, 12, 'Esan West', 161, 0),
(231, 12, 'Etsako Central', 161, 0),
(232, 12, 'Etsako East', 161, 0),
(233, 12, 'Etsako West', 161, 0),
(234, 12, 'Igueben', 161, 0),
(235, 12, 'Ikpoba Okha', 161, 0),
(236, 12, 'Orhionmwon', 161, 0),
(237, 12, 'Oredo', 161, 0),
(238, 12, 'Ovia North-East', 161, 0),
(239, 12, 'Ovia South-West', 161, 0),
(240, 12, 'Owan East', 161, 0),
(241, 12, 'Owan West', 161, 0),
(242, 12, 'Uhunmwonde', 161, 0),
(243, 13, 'Ado Ekiti', 161, 0),
(244, 13, 'Efon', 161, 0),
(245, 13, 'Ekiti East', 161, 0),
(246, 13, 'Ekiti South-West', 161, 0),
(247, 13, 'Ekiti West', 161, 0),
(248, 13, 'Emure', 161, 0),
(249, 13, 'Gbonyin', 161, 0),
(250, 13, 'Ido Osi', 161, 0),
(251, 13, 'Ijero', 161, 0),
(252, 13, 'Ikere', 161, 0),
(253, 13, 'Ikole', 161, 0),
(254, 13, 'Ilejemeje', 161, 0),
(255, 13, 'Irepodun/Ifelodun', 161, 0),
(256, 13, 'Ise/Orun', 161, 0),
(257, 13, 'Moba', 161, 0),
(258, 13, 'Oye', 161, 0),
(259, 14, 'Aninri', 161, 0),
(260, 14, 'Awgu', 161, 0),
(261, 14, 'Enugu East', 161, 0),
(262, 14, 'Enugu North', 161, 0),
(263, 14, 'Enugu South', 161, 0),
(264, 14, 'Ezeagu', 161, 0),
(265, 14, 'Igbo Etiti', 161, 0),
(266, 14, 'Igbo Eze North', 161, 0),
(267, 14, 'Igbo Eze South', 161, 0),
(268, 14, 'Isi Uzo', 161, 0),
(269, 14, 'Nkanu East', 161, 0),
(270, 14, 'Nkanu West', 161, 0),
(271, 14, 'Nsukka', 161, 0),
(272, 14, 'Oji River', 161, 0),
(273, 14, 'Udenu', 161, 0),
(274, 14, 'Udi', 161, 0),
(275, 14, 'Uzo Uwani', 161, 0),
(276, 15, 'Abaji', 161, 0),
(277, 15, 'Bwari', 161, 0),
(278, 15, 'Gwagwalada', 161, 0),
(279, 15, 'Kuje', 161, 0),
(280, 15, 'Kwali', 161, 0),
(281, 15, 'Municipal Area Council', 161, 0),
(282, 16, 'Akko', 161, 0),
(283, 16, 'Balanga', 161, 0),
(284, 16, 'Billiri', 161, 0),
(285, 16, 'Dukku', 161, 0),
(286, 16, 'Funakaye', 161, 0),
(287, 16, 'Gombe', 161, 0),
(288, 16, 'Kaltungo', 161, 0),
(289, 16, 'Kwami', 161, 0),
(290, 16, 'Nafada', 161, 0),
(291, 16, 'Shongom', 161, 0),
(292, 16, 'Yamaltu/Deba', 161, 0),
(293, 17, 'Aboh Mbaise', 161, 0),
(294, 17, 'Ahiazu Mbaise', 161, 0),
(295, 17, 'Ehime Mbano', 161, 0),
(296, 17, 'Ezinihitte', 161, 0),
(297, 17, 'Ideato North', 161, 0),
(298, 17, 'Ideato South', 161, 0),
(299, 17, 'Ihitte/Uboma', 161, 0),
(300, 17, 'Ikeduru', 161, 0),
(301, 17, 'Isiala Mbano', 161, 0),
(302, 17, 'Isu', 161, 0),
(303, 17, 'Mbaitoli', 161, 0),
(304, 17, 'Ngor Okpala', 161, 0),
(305, 17, 'Njaba', 161, 0),
(306, 17, 'Nkwerre', 161, 0),
(307, 17, 'Nwangele', 161, 0),
(308, 17, 'Obowo', 161, 0),
(309, 17, 'Oguta', 161, 0),
(310, 17, 'Ohaji/Egbema', 161, 0),
(311, 17, 'Okigwe', 161, 0),
(312, 17, 'Orlu', 161, 0),
(313, 17, 'Orsu', 161, 0),
(314, 17, 'Oru East', 161, 0),
(315, 17, 'Oru West', 161, 0),
(316, 17, 'Owerri Municipal', 161, 0),
(317, 17, 'Owerri North', 161, 0),
(318, 17, 'Owerri West', 161, 0),
(319, 17, 'Unuimo', 161, 0),
(320, 18, 'Auyo', 161, 0),
(321, 18, 'Babura', 161, 0),
(322, 18, 'Biriniwa', 161, 0),
(323, 18, 'Birnin Kudu', 161, 0),
(324, 18, 'Buji', 161, 0),
(325, 18, 'Dutse', 161, 0),
(326, 18, 'Gagarawa', 161, 0),
(327, 18, 'Garki', 161, 0),
(328, 18, 'Gumel', 161, 0),
(329, 18, 'Guri', 161, 0),
(330, 18, 'Gwaram', 161, 0),
(331, 18, 'Gwiwa', 161, 0),
(332, 18, 'Hadejia', 161, 0),
(333, 18, 'Jahun', 161, 0),
(334, 18, 'Kafin Hausa', 161, 0),
(335, 18, 'Kazaure', 161, 0),
(336, 18, 'Kiri Kasama', 161, 0),
(337, 18, 'Kiyawa', 161, 0),
(338, 18, 'Kaugama', 161, 0),
(339, 18, 'Maigatari', 161, 0),
(340, 18, 'Malam Madori', 161, 0),
(341, 18, 'Miga', 161, 0),
(342, 18, 'Ringim', 161, 0),
(343, 18, 'Roni', 161, 0),
(344, 18, 'Sule Tankarkar', 161, 0),
(345, 18, 'Taura', 161, 0),
(346, 18, 'Yankwashi', 161, 0),
(347, 19, 'Birnin Gwari', 161, 0),
(348, 19, 'Chikun', 161, 0),
(349, 19, 'Giwa', 161, 0),
(350, 19, 'Igabi', 161, 0),
(351, 19, 'Ikara', 161, 0),
(352, 19, 'Jaba', 161, 0),
(353, 19, 'Jema\'a', 161, 0),
(354, 19, 'Kachia', 161, 0),
(355, 19, 'Kaduna North', 161, 0),
(356, 19, 'Kaduna South', 161, 0),
(357, 19, 'Kagarko', 161, 0),
(358, 19, 'Kajuru', 161, 0),
(359, 19, 'Kaura', 161, 0),
(360, 19, 'Kauru', 161, 0),
(361, 19, 'Kubau', 161, 0),
(362, 19, 'Kudan', 161, 0),
(363, 19, 'Lere', 161, 0),
(364, 19, 'Makarfi', 161, 0),
(365, 19, 'Sabon Gari', 161, 0),
(366, 19, 'Sanga', 161, 0),
(367, 19, 'Soba', 161, 0),
(368, 19, 'Zangon Kataf', 161, 0),
(369, 19, 'Zaria', 161, 0),
(370, 20, 'Ajingi', 161, 0),
(371, 20, 'Albasu', 161, 0),
(372, 20, 'Bagwai', 161, 0),
(373, 20, 'Bebeji', 161, 0),
(374, 20, 'Bichi', 161, 0),
(375, 20, 'Bunkure', 161, 0),
(376, 20, 'Dala', 161, 0),
(377, 20, 'Dambatta', 161, 0),
(378, 20, 'Dawakin Kudu', 161, 0),
(379, 20, 'Dawakin Tofa', 161, 0),
(380, 20, 'Doguwa', 161, 0),
(381, 20, 'Fagge', 161, 0),
(382, 20, 'Gabasawa', 161, 0),
(383, 20, 'Garko', 161, 0),
(384, 20, 'Garun Mallam', 161, 0),
(385, 20, 'Gaya', 161, 0),
(386, 20, 'Gezawa', 161, 0),
(387, 20, 'Gwale', 161, 0),
(388, 20, 'Gwarzo', 161, 0),
(389, 20, 'Kabo', 161, 0),
(390, 20, 'Kano Municipal', 161, 0),
(391, 20, 'Karaye', 161, 0),
(392, 20, 'Kibiya', 161, 0),
(393, 20, 'Kiru', 161, 0),
(394, 20, 'Kumbotso', 161, 0),
(395, 20, 'Kunchi', 161, 0),
(396, 20, 'Kura', 161, 0),
(397, 20, 'Madobi', 161, 0),
(398, 20, 'Makoda', 161, 0),
(399, 20, 'Minjibir', 161, 0),
(400, 20, 'Nasarawa', 161, 0),
(401, 20, 'Rano', 161, 0),
(402, 20, 'Rimin Gado', 161, 0),
(403, 20, 'Rogo', 161, 0),
(404, 20, 'Shanono', 161, 0),
(405, 20, 'Sumaila', 161, 0),
(406, 20, 'Takai', 161, 0),
(407, 20, 'Tarauni', 161, 0),
(408, 20, 'Tofa', 161, 0),
(409, 20, 'Tsanyawa', 161, 0),
(410, 20, 'Tudun Wada', 161, 0),
(411, 20, 'Ungogo', 161, 0),
(412, 20, 'Warawa', 161, 0),
(413, 20, 'Wudil', 161, 0),
(414, 21, 'Bakori', 161, 0),
(415, 21, 'Batagarawa', 161, 0),
(416, 21, 'Batsari', 161, 0),
(417, 21, 'Baure', 161, 0),
(418, 21, 'Bindawa', 161, 0),
(419, 21, 'Charanchi', 161, 0),
(420, 21, 'Dandume', 161, 0),
(421, 21, 'Danja', 161, 0),
(422, 21, 'Dan Musa', 161, 0),
(423, 21, 'Daura', 161, 0),
(424, 21, 'Dutsi', 161, 0),
(425, 21, 'Dutsin Ma', 161, 0),
(426, 21, 'Faskari', 161, 0),
(427, 21, 'Funtua', 161, 0),
(428, 21, 'Ingawa', 161, 0),
(429, 21, 'Jibia', 161, 0),
(430, 21, 'Kafur', 161, 0),
(431, 21, 'Kaita', 161, 0),
(432, 21, 'Kankara', 161, 0),
(433, 21, 'Kankia', 161, 0),
(434, 21, 'Katsina', 161, 0),
(435, 21, 'Kurfi', 161, 0),
(436, 21, 'Kusada', 161, 0),
(437, 21, 'Mai\'Adua', 161, 0),
(438, 21, 'Malumfashi', 161, 0),
(439, 21, 'Mani', 161, 0),
(440, 21, 'Mashi', 161, 0),
(441, 21, 'Matazu', 161, 0),
(442, 21, 'Musawa', 161, 0),
(443, 21, 'Rimi', 161, 0),
(444, 21, 'Sabuwa', 161, 0),
(445, 21, 'Safana', 161, 0),
(446, 21, 'Sandamu', 161, 0),
(447, 21, 'Zango', 161, 0),
(448, 22, 'Aleiro', 161, 0),
(449, 22, 'Arewa Dandi', 161, 0),
(450, 22, 'Argungu', 161, 0),
(451, 22, 'Augie', 161, 0),
(452, 22, 'Bagudo', 161, 0),
(453, 22, 'Birnin Kebbi', 161, 0),
(454, 22, 'Bunza', 161, 0),
(455, 22, 'Dandi', 161, 0),
(456, 22, 'Fakai', 161, 0),
(457, 22, 'Gwandu', 161, 0),
(458, 22, 'Jega', 161, 0),
(459, 22, 'Kalgo', 161, 0),
(460, 22, 'Koko/Besse', 161, 0),
(461, 22, 'Maiyama', 161, 0),
(462, 22, 'Ngaski', 161, 0),
(463, 22, 'Sakaba', 161, 0),
(464, 22, 'Shanga', 161, 0),
(465, 22, 'Suru', 161, 0),
(466, 22, 'Wasagu/Danko', 161, 0),
(467, 22, 'Yauri', 161, 0),
(468, 22, 'Zuru', 161, 0),
(469, 23, 'Adavi', 161, 0),
(470, 23, 'Ajaokuta', 161, 0),
(471, 23, 'Ankpa', 161, 0),
(472, 23, 'Bassa', 161, 0),
(473, 23, 'Dekina', 161, 0),
(474, 23, 'Ibaji', 161, 0),
(475, 23, 'Idah', 161, 0),
(476, 23, 'Igalamela Odolu', 161, 0),
(477, 23, 'Ijumu', 161, 0),
(478, 23, 'Kabba/Bunu', 161, 0),
(479, 23, 'Kogi', 161, 0),
(480, 23, 'Lokoja', 161, 0),
(481, 23, 'Mopa Muro', 161, 0),
(482, 23, 'Ofu', 161, 0),
(483, 23, 'Ogori/Magongo', 161, 0),
(484, 23, 'Okehi', 161, 0),
(485, 23, 'Okene', 161, 0),
(486, 23, 'Olamaboro', 161, 0),
(487, 23, 'Omala', 161, 0),
(488, 23, 'Yagba East', 161, 0),
(489, 23, 'Yagba West', 161, 0),
(490, 24, 'Asa', 161, 0),
(491, 24, 'Baruten', 161, 0),
(492, 24, 'Edu', 161, 0),
(493, 24, 'Ekiti, Kwara State', 161, 0),
(494, 24, 'Ifelodun', 161, 0),
(495, 24, 'Ilorin East', 161, 0),
(496, 24, 'Ilorin South', 161, 0),
(497, 24, 'Ilorin West', 161, 0),
(498, 24, 'Irepodun', 161, 0),
(499, 24, 'Isin', 161, 0),
(500, 24, 'Kaiama', 161, 0),
(501, 24, 'Moro', 161, 0),
(502, 24, 'Offa', 161, 0),
(503, 24, 'Oke Ero', 161, 0),
(504, 24, 'Oyun', 161, 0),
(505, 24, 'Pategi', 161, 0),
(506, 25, 'Agege', 161, 0),
(507, 25, 'Ajeromi-Ifelodun', 161, 0),
(508, 25, 'Alimosho', 161, 0),
(509, 25, 'Amuwo-Odofin', 161, 0),
(510, 25, 'Apapa', 161, 0),
(511, 25, 'Badagry', 161, 0),
(512, 25, 'Epe', 161, 0),
(513, 25, 'Eti Osa', 161, 0),
(514, 25, 'Ibeju-Lekki', 161, 0),
(515, 25, 'Ifako-Ijaiye', 161, 0),
(516, 25, 'Ikeja', 161, 0),
(517, 25, 'Ikorodu', 161, 0),
(518, 25, 'Kosofe', 161, 0),
(519, 25, 'Lagos Island', 161, 0),
(520, 25, 'Lagos Mainland', 161, 0),
(521, 25, 'Mushin', 161, 0),
(522, 25, 'Ojo', 161, 0),
(523, 25, 'Oshodi-Isolo', 161, 0),
(524, 25, 'Shomolu', 161, 0),
(525, 25, 'Surulere, Lagos State', 161, 0),
(526, 26, 'Akwanga', 161, 0),
(527, 26, 'Awe', 161, 0),
(528, 26, 'Doma', 161, 0),
(529, 26, 'Karu', 161, 0),
(530, 26, 'Keana', 161, 0),
(531, 26, 'Keffi', 161, 0),
(532, 26, 'Kokona', 161, 0),
(533, 26, 'Lafia', 161, 0),
(534, 26, 'Nasarawa', 161, 0),
(535, 26, 'Nasarawa Egon', 161, 0),
(536, 26, 'Obi', 161, 0),
(537, 26, 'Toto', 161, 0),
(538, 26, 'Wamba', 161, 0),
(539, 27, 'Agaie', 161, 0),
(540, 27, 'Agwara', 161, 0),
(541, 27, 'Bida', 161, 0),
(542, 27, 'Borgu', 161, 0),
(543, 27, 'Bosso', 161, 0),
(544, 27, 'Chanchaga', 161, 0),
(545, 27, 'Edati', 161, 0),
(546, 27, 'Gbako', 161, 0),
(547, 27, 'Gurara', 161, 0),
(548, 27, 'Katcha', 161, 0),
(549, 27, 'Kontagora', 161, 0),
(550, 27, 'Lapai', 161, 0),
(551, 27, 'Lavun', 161, 0),
(552, 27, 'Magama', 161, 0),
(553, 27, 'Mariga', 161, 0),
(554, 27, 'Mashegu', 161, 0),
(555, 27, 'Mokwa', 161, 0),
(556, 27, 'Moya', 161, 0),
(557, 27, 'Paikoro', 161, 0),
(558, 27, 'Rafi', 161, 0),
(559, 27, 'Rijau', 161, 0),
(560, 27, 'Shiroro', 161, 0),
(561, 27, 'Suleja', 161, 0),
(562, 27, 'Tafa', 161, 0),
(563, 27, 'Wushishi', 161, 0),
(564, 28, 'Abeokuta North', 161, 0),
(565, 28, 'Abeokuta South', 161, 0),
(566, 28, 'Ado-Odo/Ota', 161, 0),
(567, 28, 'Egbado North', 161, 0),
(568, 28, 'Egbado South', 161, 0),
(569, 28, 'Ewekoro', 161, 0),
(570, 28, 'Ifo', 161, 0),
(571, 28, 'Ijebu East', 161, 0),
(572, 28, 'Ijebu North', 161, 0),
(573, 28, 'Ijebu North East', 161, 0),
(574, 28, 'Ijebu Ode', 161, 0),
(575, 28, 'Ikenne', 161, 0),
(576, 28, 'Imeko Afon', 161, 0),
(577, 28, 'Ipokia', 161, 0),
(578, 28, 'Obafemi Owode', 161, 0),
(579, 28, 'Odeda', 161, 0),
(580, 28, 'Odogbolu', 161, 0),
(581, 28, 'Ogun Waterside', 161, 0),
(582, 28, 'Remo North', 161, 0),
(583, 28, 'Shagamu', 161, 0),
(584, 29, 'Akoko North-East', 161, 0),
(585, 29, 'Akoko North-West', 161, 0),
(586, 29, 'Akoko South-West', 161, 0),
(587, 29, 'Akoko South-East', 161, 0),
(588, 29, 'Akure North', 161, 0),
(589, 29, 'Akure South', 161, 0),
(590, 29, 'Ese Odo', 161, 0),
(591, 29, 'Idanre', 161, 0),
(592, 29, 'Ifedore', 161, 0),
(593, 29, 'Ilaje', 161, 0),
(594, 29, 'Ile Oluji/Okeigbo', 161, 0),
(595, 29, 'Irele', 161, 0),
(596, 29, 'Odigbo', 161, 0),
(597, 29, 'Okitipupa', 161, 0),
(598, 29, 'Ondo East', 161, 0),
(599, 29, 'Ondo West', 161, 0),
(600, 29, 'Ose', 161, 0),
(601, 29, 'Owo', 161, 0),
(602, 30, 'Atakunmosa East', 161, 0),
(603, 30, 'Atakunmosa West', 161, 0),
(604, 30, 'Aiyedaade', 161, 0),
(605, 30, 'Aiyedire', 161, 0),
(606, 30, 'Boluwaduro', 161, 0),
(607, 30, 'Boripe', 161, 0),
(608, 30, 'Ede North', 161, 0),
(609, 30, 'Ede South', 161, 0),
(610, 30, 'Ife Central', 161, 0),
(611, 30, 'Ife East', 161, 0),
(612, 30, 'Ife North', 161, 0),
(613, 30, 'Ife South', 161, 0),
(614, 30, 'Egbedore', 161, 0),
(615, 30, 'Ejigbo', 161, 0),
(616, 30, 'Ifedayo', 161, 0),
(617, 30, 'Ifelodun', 161, 0),
(618, 30, 'Ila', 161, 0),
(619, 30, 'Ilesa East', 161, 0),
(620, 30, 'Ilesa West', 161, 0),
(621, 30, 'Irepodun', 161, 0),
(622, 30, 'Irewole', 161, 0),
(623, 30, 'Isokan', 161, 0),
(624, 30, 'Iwo', 161, 0),
(625, 30, 'Obokun', 161, 0),
(626, 30, 'Odo Otin', 161, 0),
(627, 30, 'Ola Oluwa', 161, 0),
(628, 30, 'Olorunda', 161, 0),
(629, 30, 'Oriade', 161, 0),
(630, 30, 'Orolu', 161, 0),
(631, 30, 'Osogbo', 161, 0),
(632, 31, 'Afijio', 161, 0),
(633, 31, 'Akinyele', 161, 0),
(634, 31, 'Atiba', 161, 0),
(635, 31, 'Atisbo', 161, 0),
(636, 31, 'Egbeda', 161, 0),
(637, 31, 'Ibadan North', 161, 0),
(638, 31, 'Ibadan North-East', 161, 0),
(639, 31, 'Ibadan North-West', 161, 0),
(640, 31, 'Ibadan South-East', 161, 0),
(641, 31, 'Ibadan South-West', 161, 0),
(642, 31, 'Ibarapa Central', 161, 0),
(643, 31, 'Ibarapa East', 161, 0),
(644, 31, 'Ibarapa North', 161, 0),
(645, 31, 'Ido', 161, 0),
(646, 31, 'Irepo', 161, 0),
(647, 31, 'Iseyin', 161, 0),
(648, 31, 'Itesiwaju', 161, 0),
(649, 31, 'Iwajowa', 161, 0),
(650, 31, 'Kajola', 161, 0),
(651, 31, 'Lagelu', 161, 0),
(652, 31, 'Ogbomosho North', 161, 0),
(653, 31, 'Ogbomosho South', 161, 0),
(654, 31, 'Ogo Oluwa', 161, 0),
(655, 31, 'Olorunsogo', 161, 0),
(656, 31, 'Oluyole', 161, 0),
(657, 31, 'Ona Ara', 161, 0),
(658, 31, 'Orelope', 161, 0),
(659, 31, 'Ori Ire', 161, 0),
(660, 31, 'Oyo', 161, 0),
(661, 31, 'Oyo East', 161, 0),
(662, 31, 'Saki East', 161, 0),
(663, 31, 'Saki West', 161, 0),
(664, 31, 'Surulere, Oyo State', 161, 0),
(665, 32, 'Bokkos', 161, 0),
(666, 32, 'Barkin Ladi', 161, 0),
(667, 32, 'Bassa', 161, 0),
(668, 32, 'Jos East', 161, 0),
(669, 32, 'Jos North', 161, 0),
(670, 32, 'Jos South', 161, 0),
(671, 32, 'Kanam', 161, 0),
(672, 32, 'Kanke', 161, 0),
(673, 32, 'Langtang South', 161, 0),
(674, 32, 'Langtang North', 161, 0),
(675, 32, 'Mangu', 161, 0),
(676, 32, 'Mikang', 161, 0),
(677, 32, 'Pankshin', 161, 0),
(678, 32, 'Qua\'an Pan', 161, 0),
(679, 32, 'Riyom', 161, 0),
(680, 32, 'Shendam', 161, 0),
(681, 32, 'Wase', 161, 0),
(682, 33, 'Abua/Odual', 161, 0),
(683, 33, 'Ahoada East', 161, 0),
(684, 33, 'Ahoada West', 161, 0),
(685, 33, 'Akuku-Toru', 161, 0),
(686, 33, 'Andoni', 161, 0),
(687, 33, 'Asari-Toru', 161, 0),
(688, 33, 'Bonny', 161, 0),
(689, 33, 'Degema', 161, 0),
(690, 33, 'Eleme', 161, 0),
(691, 33, 'Emuoha', 161, 0),
(692, 33, 'Etche', 161, 0),
(693, 33, 'Gokana', 161, 0),
(694, 33, 'Ikwerre', 161, 0),
(695, 33, 'Khana', 161, 0),
(696, 33, 'Obio/Akpor', 161, 0),
(697, 33, 'Ogba/Egbema/Ndoni', 161, 0),
(698, 33, 'Ogu/Bolo', 161, 0),
(699, 33, 'Okrika', 161, 0),
(700, 33, 'Omuma', 161, 0),
(701, 33, 'Opobo/Nkoro', 161, 0),
(702, 33, 'Oyigbo', 161, 0),
(703, 33, 'Port Harcourt', 161, 0),
(704, 33, 'Tai', 161, 0),
(705, 34, 'Binji', 161, 0),
(706, 34, 'Bodinga', 161, 0),
(707, 34, 'Dange Shuni', 161, 0),
(708, 34, 'Gada', 161, 0),
(709, 34, 'Goronyo', 161, 0),
(710, 34, 'Gudu', 161, 0),
(711, 34, 'Gwadabawa', 161, 0),
(712, 34, 'Illela', 161, 0),
(713, 34, 'Isa', 161, 0),
(714, 34, 'Kebbe', 161, 0),
(715, 34, 'Kware', 161, 0),
(716, 34, 'Rabah', 161, 0),
(717, 34, 'Sabon Birni', 161, 0),
(718, 34, 'Shagari', 161, 0),
(719, 34, 'Silame', 161, 0),
(720, 34, 'Sokoto North', 161, 0),
(721, 34, 'Sokoto South', 161, 0),
(722, 34, 'Tambuwal', 161, 0),
(723, 34, 'Tangaza', 161, 0),
(724, 34, 'Tureta', 161, 0),
(725, 34, 'Wamako', 161, 0),
(726, 34, 'Wurno', 161, 0),
(727, 34, 'Yabo', 161, 0),
(728, 35, 'Ardo Kola', 161, 0),
(729, 35, 'Bali', 161, 0),
(730, 35, 'Donga', 161, 0),
(731, 35, 'Gashaka', 161, 0),
(732, 35, 'Gassol', 161, 0),
(733, 35, 'Ibi', 161, 0),
(734, 35, 'Jalingo', 161, 0),
(735, 35, 'Karim Lamido', 161, 0),
(736, 35, 'Kumi', 161, 0),
(737, 35, 'Lau', 161, 0),
(738, 35, 'Sardauna', 161, 0),
(739, 35, 'Takum', 161, 0),
(740, 35, 'Ussa', 161, 0),
(741, 35, 'Wukari', 161, 0),
(742, 35, 'Yorro', 161, 0),
(743, 35, 'Zing', 161, 0),
(744, 36, 'Bade', 161, 0),
(745, 36, 'Bursari', 161, 0),
(746, 36, 'Damaturu', 161, 0),
(747, 36, 'Fika', 161, 0),
(748, 36, 'Fune', 161, 0),
(749, 36, 'Geidam', 161, 0),
(750, 36, 'Gujba', 161, 0),
(751, 36, 'Gulani', 161, 0),
(752, 36, 'Jakusko', 161, 0),
(753, 36, 'Karasuwa', 161, 0),
(754, 36, 'Machina', 161, 0),
(755, 36, 'Nangere', 161, 0),
(756, 36, 'Nguru', 161, 0),
(757, 36, 'Potiskum', 161, 0),
(758, 36, 'Tarmuwa', 161, 0),
(759, 36, 'Yunusari', 161, 0),
(760, 36, 'Yusufari', 161, 0),
(761, 37, 'Anka', 161, 0),
(762, 37, 'Bakura', 161, 0),
(763, 37, 'Birnin Magaji/Kiyaw', 161, 0),
(764, 37, 'Bukkuyum', 161, 0),
(765, 37, 'Bungudu', 161, 0),
(766, 37, 'Gummi', 161, 0),
(767, 37, 'Gusau', 161, 0),
(768, 37, 'Kaura Namoda', 161, 0),
(769, 37, 'Maradun', 161, 0),
(770, 37, 'Maru', 161, 0),
(771, 37, 'Shinkafi', 161, 0),
(772, 37, 'Talata Mafara', 161, 0),
(773, 37, 'Chafe', 161, 0),
(774, 37, 'Zurmi', 161, 0);

-- --------------------------------------------------------

--
-- Table structure for table `city_translations`
--

CREATE TABLE `city_translations` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lang` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'IndianRed', '#CD5C5C', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(2, 'LightCoral', '#F08080', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(3, 'Salmon', '#FA8072', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(4, 'DarkSalmon', '#E9967A', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(5, 'LightSalmon', '#FFA07A', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(6, 'Crimson', '#DC143C', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(7, 'Red', '#FF0000', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(8, 'FireBrick', '#B22222', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(9, 'DarkRed', '#8B0000', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(10, 'Pink', '#FFC0CB', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(11, 'LightPink', '#FFB6C1', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(12, 'HotPink', '#FF69B4', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(13, 'DeepPink', '#FF1493', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(14, 'MediumVioletRed', '#C71585', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(15, 'PaleVioletRed', '#DB7093', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(16, 'LightSalmon', '#FFA07A', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(17, 'Coral', '#FF7F50', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(18, 'Tomato', '#FF6347', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(19, 'OrangeRed', '#FF4500', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(20, 'DarkOrange', '#FF8C00', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(21, 'Orange', '#FFA500', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(22, 'Gold', '#FFD700', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(23, 'Yellow', '#FFFF00', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(24, 'LightYellow', '#FFFFE0', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(25, 'LemonChiffon', '#FFFACD', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(26, 'LightGoldenrodYellow', '#FAFAD2', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(27, 'PapayaWhip', '#FFEFD5', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(28, 'Moccasin', '#FFE4B5', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(29, 'PeachPuff', '#FFDAB9', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(30, 'PaleGoldenrod', '#EEE8AA', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(31, 'Khaki', '#F0E68C', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(32, 'DarkKhaki', '#BDB76B', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(33, 'Lavender', '#E6E6FA', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(34, 'Thistle', '#D8BFD8', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(35, 'Plum', '#DDA0DD', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(36, 'Violet', '#EE82EE', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(37, 'Orchid', '#DA70D6', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(38, 'Fuchsia', '#FF00FF', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(39, 'Magenta', '#FF00FF', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(40, 'MediumOrchid', '#BA55D3', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(41, 'MediumPurple', '#9370DB', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(42, 'Amethyst', '#9966CC', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(43, 'BlueViolet', '#8A2BE2', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(44, 'DarkViolet', '#9400D3', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(45, 'DarkOrchid', '#9932CC', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(46, 'DarkMagenta', '#8B008B', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(47, 'Purple', '#800080', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(48, 'Indigo', '#4B0082', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(49, 'SlateBlue', '#6A5ACD', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(50, 'DarkSlateBlue', '#483D8B', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(51, 'MediumSlateBlue', '#7B68EE', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(52, 'GreenYellow', '#ADFF2F', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(53, 'Chartreuse', '#7FFF00', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(54, 'LawnGreen', '#7CFC00', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(55, 'Lime', '#00FF00', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(56, 'LimeGreen', '#32CD32', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(57, 'PaleGreen', '#98FB98', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(58, 'LightGreen', '#90EE90', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(59, 'MediumSpringGreen', '#00FA9A', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(60, 'SpringGreen', '#00FF7F', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(61, 'MediumSeaGreen', '#3CB371', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(62, 'SeaGreen', '#2E8B57', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(63, 'ForestGreen', '#228B22', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(64, 'Green', '#008000', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(65, 'DarkGreen', '#006400', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(66, 'YellowGreen', '#9ACD32', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(67, 'OliveDrab', '#6B8E23', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(68, 'Olive', '#808000', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(69, 'DarkOliveGreen', '#556B2F', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(70, 'MediumAquamarine', '#66CDAA', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(71, 'DarkSeaGreen', '#8FBC8F', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(72, 'LightSeaGreen', '#20B2AA', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(73, 'DarkCyan', '#008B8B', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(74, 'Teal', '#008080', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(75, 'Aqua', '#00FFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(76, 'Cyan', '#00FFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(77, 'LightCyan', '#E0FFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(78, 'PaleTurquoise', '#AFEEEE', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(79, 'Aquamarine', '#7FFFD4', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(80, 'Turquoise', '#40E0D0', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(81, 'MediumTurquoise', '#48D1CC', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(82, 'DarkTurquoise', '#00CED1', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(83, 'CadetBlue', '#5F9EA0', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(84, 'SteelBlue', '#4682B4', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(85, 'LightSteelBlue', '#B0C4DE', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(86, 'PowderBlue', '#B0E0E6', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(87, 'LightBlue', '#ADD8E6', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(88, 'SkyBlue', '#87CEEB', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(89, 'LightSkyBlue', '#87CEFA', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(90, 'DeepSkyBlue', '#00BFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(91, 'DodgerBlue', '#1E90FF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(92, 'CornflowerBlue', '#6495ED', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(93, 'MediumSlateBlue', '#7B68EE', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(94, 'RoyalBlue', '#4169E1', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(95, 'Blue', '#0000FF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(96, 'MediumBlue', '#0000CD', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(97, 'DarkBlue', '#00008B', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(98, 'Navy', '#000080', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(99, 'MidnightBlue', '#191970', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(100, 'Cornsilk', '#FFF8DC', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(101, 'BlanchedAlmond', '#FFEBCD', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(102, 'Bisque', '#FFE4C4', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(103, 'NavajoWhite', '#FFDEAD', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(104, 'Wheat', '#F5DEB3', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(105, 'BurlyWood', '#DEB887', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(106, 'Tan', '#D2B48C', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(107, 'RosyBrown', '#BC8F8F', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(108, 'SandyBrown', '#F4A460', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(109, 'Goldenrod', '#DAA520', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(110, 'DarkGoldenrod', '#B8860B', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(111, 'Peru', '#CD853F', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(112, 'Chocolate', '#D2691E', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(113, 'SaddleBrown', '#8B4513', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(114, 'Sienna', '#A0522D', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(115, 'Brown', '#A52A2A', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(116, 'Maroon', '#800000', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(117, 'White', '#FFFFFF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(118, 'Snow', '#FFFAFA', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(119, 'Honeydew', '#F0FFF0', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(120, 'MintCream', '#F5FFFA', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(121, 'Azure', '#F0FFFF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(122, 'AliceBlue', '#F0F8FF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(123, 'GhostWhite', '#F8F8FF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(124, 'WhiteSmoke', '#F5F5F5', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(125, 'Seashell', '#FFF5EE', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(126, 'Beige', '#F5F5DC', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(127, 'OldLace', '#FDF5E6', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(128, 'FloralWhite', '#FFFAF0', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(129, 'Ivory', '#FFFFF0', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(130, 'AntiqueWhite', '#FAEBD7', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(131, 'Linen', '#FAF0E6', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(132, 'LavenderBlush', '#FFF0F5', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(133, 'MistyRose', '#FFE4E1', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(134, 'Gainsboro', '#DCDCDC', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(135, 'LightGrey', '#D3D3D3', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(136, 'Silver', '#C0C0C0', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(137, 'DarkGray', '#A9A9A9', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(138, 'Gray', '#808080', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(139, 'DimGray', '#696969', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(140, 'LightSlateGray', '#778899', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(141, 'SlateGray', '#708090', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(142, 'DarkSlateGray', '#2F4F4F', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(143, 'Black', '#000000', '2018-11-05 02:12:30', '2018-11-05 02:12:30');

-- --------------------------------------------------------

--
-- Table structure for table `commission_histories`
--

CREATE TABLE `commission_histories` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_detail_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `admin_commission` double(25,2) NOT NULL,
  `seller_earning` double(25,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `sender_viewed` int(1) NOT NULL DEFAULT 1,
  `receiver_viewed` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `code` varchar(2) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 1, NULL, NULL),
(2, 'AL', 'Albania', 1, NULL, NULL),
(3, 'DZ', 'Algeria', 1, NULL, NULL),
(4, 'DS', 'American Samoa', 1, NULL, NULL),
(5, 'AD', 'Andorra', 1, NULL, NULL),
(6, 'AO', 'Angola', 1, NULL, NULL),
(7, 'AI', 'Anguilla', 1, NULL, NULL),
(8, 'AQ', 'Antarctica', 1, NULL, NULL),
(9, 'AG', 'Antigua and Barbuda', 1, NULL, NULL),
(10, 'AR', 'Argentina', 1, NULL, NULL),
(11, 'AM', 'Armenia', 1, NULL, NULL),
(12, 'AW', 'Aruba', 1, NULL, NULL),
(13, 'AU', 'Australia', 1, NULL, NULL),
(14, 'AT', 'Austria', 1, NULL, NULL),
(15, 'AZ', 'Azerbaijan', 1, NULL, NULL),
(16, 'BS', 'Bahamas', 1, NULL, NULL),
(17, 'BH', 'Bahrain', 1, NULL, NULL),
(18, 'BD', 'Bangladesh', 1, NULL, NULL),
(19, 'BB', 'Barbados', 1, NULL, NULL),
(20, 'BY', 'Belarus', 1, NULL, NULL),
(21, 'BE', 'Belgium', 1, NULL, NULL),
(22, 'BZ', 'Belize', 1, NULL, NULL),
(23, 'BJ', 'Benin', 1, NULL, NULL),
(24, 'BM', 'Bermuda', 1, NULL, NULL),
(25, 'BT', 'Bhutan', 1, NULL, NULL),
(26, 'BO', 'Bolivia', 1, NULL, NULL),
(27, 'BA', 'Bosnia and Herzegovina', 1, NULL, NULL),
(28, 'BW', 'Botswana', 1, NULL, NULL),
(29, 'BV', 'Bouvet Island', 1, NULL, NULL),
(30, 'BR', 'Brazil', 1, NULL, NULL),
(31, 'IO', 'British Indian Ocean Territory', 1, NULL, NULL),
(32, 'BN', 'Brunei Darussalam', 1, NULL, NULL),
(33, 'BG', 'Bulgaria', 1, NULL, NULL),
(34, 'BF', 'Burkina Faso', 1, NULL, NULL),
(35, 'BI', 'Burundi', 1, NULL, NULL),
(36, 'KH', 'Cambodia', 1, NULL, NULL),
(37, 'CM', 'Cameroon', 1, NULL, NULL),
(38, 'CA', 'Canada', 1, NULL, NULL),
(39, 'CV', 'Cape Verde', 1, NULL, NULL),
(40, 'KY', 'Cayman Islands', 1, NULL, NULL),
(41, 'CF', 'Central African Republic', 1, NULL, NULL),
(42, 'TD', 'Chad', 1, NULL, NULL),
(43, 'CL', 'Chile', 1, NULL, NULL),
(44, 'CN', 'China', 1, NULL, NULL),
(45, 'CX', 'Christmas Island', 1, NULL, NULL),
(46, 'CC', 'Cocos (Keeling) Islands', 1, NULL, NULL),
(47, 'CO', 'Colombia', 1, NULL, NULL),
(48, 'KM', 'Comoros', 1, NULL, NULL),
(49, 'CG', 'Congo', 1, NULL, NULL),
(50, 'CK', 'Cook Islands', 1, NULL, NULL),
(51, 'CR', 'Costa Rica', 1, NULL, NULL),
(52, 'HR', 'Croatia (Hrvatska)', 1, NULL, NULL),
(53, 'CU', 'Cuba', 1, NULL, NULL),
(54, 'CY', 'Cyprus', 1, NULL, NULL),
(55, 'CZ', 'Czech Republic', 1, NULL, NULL),
(56, 'DK', 'Denmark', 1, NULL, NULL),
(57, 'DJ', 'Djibouti', 1, NULL, NULL),
(58, 'DM', 'Dominica', 1, NULL, NULL),
(59, 'DO', 'Dominican Republic', 1, NULL, NULL),
(60, 'TP', 'East Timor', 1, NULL, NULL),
(61, 'EC', 'Ecuador', 1, NULL, NULL),
(62, 'EG', 'Egypt', 1, NULL, NULL),
(63, 'SV', 'El Salvador', 1, NULL, NULL),
(64, 'GQ', 'Equatorial Guinea', 1, NULL, NULL),
(65, 'ER', 'Eritrea', 1, NULL, NULL),
(66, 'EE', 'Estonia', 1, NULL, NULL),
(67, 'ET', 'Ethiopia', 1, NULL, NULL),
(68, 'FK', 'Falkland Islands (Malvinas)', 1, NULL, NULL),
(69, 'FO', 'Faroe Islands', 1, NULL, NULL),
(70, 'FJ', 'Fiji', 1, NULL, NULL),
(71, 'FI', 'Finland', 1, NULL, NULL),
(72, 'FR', 'France', 1, NULL, NULL),
(73, 'FX', 'France, Metropolitan', 1, NULL, NULL),
(74, 'GF', 'French Guiana', 1, NULL, NULL),
(75, 'PF', 'French Polynesia', 1, NULL, NULL),
(76, 'TF', 'French Southern Territories', 1, NULL, NULL),
(77, 'GA', 'Gabon', 1, NULL, NULL),
(78, 'GM', 'Gambia', 1, NULL, NULL),
(79, 'GE', 'Georgia', 1, NULL, NULL),
(80, 'DE', 'Germany', 1, NULL, NULL),
(81, 'GH', 'Ghana', 1, NULL, NULL),
(82, 'GI', 'Gibraltar', 1, NULL, NULL),
(83, 'GK', 'Guernsey', 1, NULL, NULL),
(84, 'GR', 'Greece', 1, NULL, NULL),
(85, 'GL', 'Greenland', 1, NULL, NULL),
(86, 'GD', 'Grenada', 1, NULL, NULL),
(87, 'GP', 'Guadeloupe', 1, NULL, NULL),
(88, 'GU', 'Guam', 1, NULL, NULL),
(89, 'GT', 'Guatemala', 1, NULL, NULL),
(90, 'GN', 'Guinea', 1, NULL, NULL),
(91, 'GW', 'Guinea-Bissau', 1, NULL, NULL),
(92, 'GY', 'Guyana', 1, NULL, NULL),
(93, 'HT', 'Haiti', 1, NULL, NULL),
(94, 'HM', 'Heard and Mc Donald Islands', 1, NULL, NULL),
(95, 'HN', 'Honduras', 1, NULL, NULL),
(96, 'HK', 'Hong Kong', 1, NULL, NULL),
(97, 'HU', 'Hungary', 1, NULL, NULL),
(98, 'IS', 'Iceland', 1, NULL, NULL),
(99, 'IN', 'India', 1, NULL, NULL),
(100, 'IM', 'Isle of Man', 1, NULL, NULL),
(101, 'ID', 'Indonesia', 1, NULL, NULL),
(102, 'IR', 'Iran (Islamic Republic of)', 1, NULL, NULL),
(103, 'IQ', 'Iraq', 1, NULL, NULL),
(104, 'IE', 'Ireland', 1, NULL, NULL),
(105, 'IL', 'Israel', 1, NULL, NULL),
(106, 'IT', 'Italy', 1, NULL, NULL),
(107, 'CI', 'Ivory Coast', 1, NULL, NULL),
(108, 'JE', 'Jersey', 1, NULL, NULL),
(109, 'JM', 'Jamaica', 1, NULL, NULL),
(110, 'JP', 'Japan', 1, NULL, NULL),
(111, 'JO', 'Jordan', 1, NULL, NULL),
(112, 'KZ', 'Kazakhstan', 1, NULL, NULL),
(113, 'KE', 'Kenya', 1, NULL, NULL),
(114, 'KI', 'Kiribati', 1, NULL, NULL),
(115, 'KP', 'Korea, Democratic People\'s Republic of', 1, NULL, NULL),
(116, 'KR', 'Korea, Republic of', 1, NULL, NULL),
(117, 'XK', 'Kosovo', 1, NULL, NULL),
(118, 'KW', 'Kuwait', 1, NULL, NULL),
(119, 'KG', 'Kyrgyzstan', 1, NULL, NULL),
(120, 'LA', 'Lao People\'s Democratic Republic', 1, NULL, NULL),
(121, 'LV', 'Latvia', 1, NULL, NULL),
(122, 'LB', 'Lebanon', 1, NULL, NULL),
(123, 'LS', 'Lesotho', 1, NULL, NULL),
(124, 'LR', 'Liberia', 1, NULL, NULL),
(125, 'LY', 'Libyan Arab Jamahiriya', 1, NULL, NULL),
(126, 'LI', 'Liechtenstein', 1, NULL, NULL),
(127, 'LT', 'Lithuania', 1, NULL, NULL),
(128, 'LU', 'Luxembourg', 1, NULL, NULL),
(129, 'MO', 'Macau', 1, NULL, NULL),
(130, 'MK', 'Macedonia', 1, NULL, NULL),
(131, 'MG', 'Madagascar', 1, NULL, NULL),
(132, 'MW', 'Malawi', 1, NULL, NULL),
(133, 'MY', 'Malaysia', 1, NULL, NULL),
(134, 'MV', 'Maldives', 1, NULL, NULL),
(135, 'ML', 'Mali', 1, NULL, NULL),
(136, 'MT', 'Malta', 1, NULL, NULL),
(137, 'MH', 'Marshall Islands', 1, NULL, NULL),
(138, 'MQ', 'Martinique', 1, NULL, NULL),
(139, 'MR', 'Mauritania', 1, NULL, NULL),
(140, 'MU', 'Mauritius', 1, NULL, NULL),
(141, 'TY', 'Mayotte', 1, NULL, NULL),
(142, 'MX', 'Mexico', 1, NULL, NULL),
(143, 'FM', 'Micronesia, Federated States of', 1, NULL, NULL),
(144, 'MD', 'Moldova, Republic of', 1, NULL, NULL),
(145, 'MC', 'Monaco', 1, NULL, NULL),
(146, 'MN', 'Mongolia', 1, NULL, NULL),
(147, 'ME', 'Montenegro', 1, NULL, NULL),
(148, 'MS', 'Montserrat', 1, NULL, NULL),
(149, 'MA', 'Morocco', 1, NULL, NULL),
(150, 'MZ', 'Mozambique', 1, NULL, NULL),
(151, 'MM', 'Myanmar', 1, NULL, NULL),
(152, 'NA', 'Namibia', 1, NULL, NULL),
(153, 'NR', 'Nauru', 1, NULL, NULL),
(154, 'NP', 'Nepal', 1, NULL, NULL),
(155, 'NL', 'Netherlands', 1, NULL, NULL),
(156, 'AN', 'Netherlands Antilles', 1, NULL, NULL),
(157, 'NC', 'New Caledonia', 1, NULL, NULL),
(158, 'NZ', 'New Zealand', 1, NULL, NULL),
(159, 'NI', 'Nicaragua', 1, NULL, NULL),
(160, 'NE', 'Niger', 1, NULL, NULL),
(161, 'NG', 'Nigeria', 1, NULL, NULL),
(162, 'NU', 'Niue', 1, NULL, NULL),
(163, 'NF', 'Norfolk Island', 1, NULL, NULL),
(164, 'MP', 'Northern Mariana Islands', 1, NULL, NULL),
(165, 'NO', 'Norway', 1, NULL, NULL),
(166, 'OM', 'Oman', 1, NULL, NULL),
(167, 'PK', 'Pakistan', 1, NULL, NULL),
(168, 'PW', 'Palau', 1, NULL, NULL),
(169, 'PS', 'Palestine', 1, NULL, NULL),
(170, 'PA', 'Panama', 1, NULL, NULL),
(171, 'PG', 'Papua New Guinea', 1, NULL, NULL),
(172, 'PY', 'Paraguay', 1, NULL, NULL),
(173, 'PE', 'Peru', 1, NULL, NULL),
(174, 'PH', 'Philippines', 1, NULL, NULL),
(175, 'PN', 'Pitcairn', 1, NULL, NULL),
(176, 'PL', 'Poland', 1, NULL, NULL),
(177, 'PT', 'Portugal', 1, NULL, NULL),
(178, 'PR', 'Puerto Rico', 1, NULL, NULL),
(179, 'QA', 'Qatar', 1, NULL, NULL),
(180, 'RE', 'Reunion', 1, NULL, NULL),
(181, 'RO', 'Romania', 1, NULL, NULL),
(182, 'RU', 'Russian Federation', 1, NULL, NULL),
(183, 'RW', 'Rwanda', 1, NULL, NULL),
(184, 'KN', 'Saint Kitts and Nevis', 1, NULL, NULL),
(185, 'LC', 'Saint Lucia', 1, NULL, NULL),
(186, 'VC', 'Saint Vincent and the Grenadines', 1, NULL, NULL),
(187, 'WS', 'Samoa', 1, NULL, NULL),
(188, 'SM', 'San Marino', 1, NULL, NULL),
(189, 'ST', 'Sao Tome and Principe', 1, NULL, NULL),
(190, 'SA', 'Saudi Arabia', 1, NULL, NULL),
(191, 'SN', 'Senegal', 1, NULL, NULL),
(192, 'RS', 'Serbia', 1, NULL, NULL),
(193, 'SC', 'Seychelles', 1, NULL, NULL),
(194, 'SL', 'Sierra Leone', 1, NULL, NULL),
(195, 'SG', 'Singapore', 1, NULL, NULL),
(196, 'SK', 'Slovakia', 1, NULL, NULL),
(197, 'SI', 'Slovenia', 1, NULL, NULL),
(198, 'SB', 'Solomon Islands', 1, NULL, NULL),
(199, 'SO', 'Somalia', 1, NULL, NULL),
(200, 'ZA', 'South Africa', 1, NULL, NULL),
(201, 'GS', 'South Georgia South Sandwich Islands', 1, NULL, NULL),
(202, 'SS', 'South Sudan', 1, NULL, NULL),
(203, 'ES', 'Spain', 1, NULL, NULL),
(204, 'LK', 'Sri Lanka', 1, NULL, NULL),
(205, 'SH', 'St. Helena', 1, NULL, NULL),
(206, 'PM', 'St. Pierre and Miquelon', 1, NULL, NULL),
(207, 'SD', 'Sudan', 1, NULL, NULL),
(208, 'SR', 'Suriname', 1, NULL, NULL),
(209, 'SJ', 'Svalbard and Jan Mayen Islands', 1, NULL, NULL),
(210, 'SZ', 'Swaziland', 1, NULL, NULL),
(211, 'SE', 'Sweden', 1, NULL, NULL),
(212, 'CH', 'Switzerland', 1, NULL, NULL),
(213, 'SY', 'Syrian Arab Republic', 1, NULL, NULL),
(214, 'TW', 'Taiwan', 1, NULL, NULL),
(215, 'TJ', 'Tajikistan', 1, NULL, NULL),
(216, 'TZ', 'Tanzania, United Republic of', 1, NULL, NULL),
(217, 'TH', 'Thailand', 1, NULL, NULL),
(218, 'TG', 'Togo', 1, NULL, NULL),
(219, 'TK', 'Tokelau', 1, NULL, NULL),
(220, 'TO', 'Tonga', 1, NULL, NULL),
(221, 'TT', 'Trinidad and Tobago', 1, NULL, NULL),
(222, 'TN', 'Tunisia', 1, NULL, NULL),
(223, 'TR', 'Turkey', 1, NULL, NULL),
(224, 'TM', 'Turkmenistan', 1, NULL, NULL),
(225, 'TC', 'Turks and Caicos Islands', 1, NULL, NULL),
(226, 'TV', 'Tuvalu', 1, NULL, NULL),
(227, 'UG', 'Uganda', 1, NULL, NULL),
(228, 'UA', 'Ukraine', 1, NULL, NULL),
(229, 'AE', 'United Arab Emirates', 1, NULL, NULL),
(230, 'GB', 'United Kingdom', 1, NULL, NULL),
(231, 'US', 'United States', 1, NULL, NULL),
(232, 'UM', 'United States minor outlying islands', 1, NULL, NULL),
(233, 'UY', 'Uruguay', 1, NULL, NULL),
(234, 'UZ', 'Uzbekistan', 1, NULL, NULL),
(235, 'VU', 'Vanuatu', 1, NULL, NULL),
(236, 'VA', 'Vatican City State', 1, NULL, NULL),
(237, 'VE', 'Venezuela', 1, NULL, NULL),
(238, 'VN', 'Vietnam', 1, NULL, NULL),
(239, 'VG', 'Virgin Islands (British)', 1, NULL, NULL),
(240, 'VI', 'Virgin Islands (U.S.)', 1, NULL, NULL),
(241, 'WF', 'Wallis and Futuna Islands', 1, NULL, NULL),
(242, 'EH', 'Western Sahara', 1, NULL, NULL),
(243, 'YE', 'Yemen', 1, NULL, NULL),
(244, 'ZR', 'Zaire', 1, NULL, NULL),
(245, 'ZM', 'Zambia', 1, NULL, NULL),
(246, 'ZW', 'Zimbabwe', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `details` longtext NOT NULL,
  `discount` double(20,2) NOT NULL,
  `discount_type` varchar(100) NOT NULL,
  `start_date` int(15) NOT NULL,
  `end_date` int(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_usages`
--

CREATE TABLE `coupon_usages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `exchange_rate` double(10,5) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0,
  `code` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `exchange_rate`, `status`, `code`, `created_at`, `updated_at`) VALUES
(1, 'U.S. Dollar', '$', 1.00000, 0, 'USD', '2018-10-09 11:35:08', '2018-10-17 05:50:52'),
(2, 'Australian Dollar', '$', 1.28000, 0, 'AUD', '2018-10-09 11:35:08', '2019-02-04 05:51:55'),
(5, 'Brazilian Real', 'R$', 3.25000, 0, 'BRL', '2018-10-09 11:35:08', '2018-10-17 05:51:00'),
(6, 'Canadian Dollar', '$', 1.27000, 0, 'CAD', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(7, 'Czech Koruna', 'Kč', 20.65000, 0, 'CZK', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(8, 'Danish Krone', 'kr', 6.05000, 0, 'DKK', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(9, 'Euro', '€', 0.85000, 0, 'EUR', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(10, 'Hong Kong Dollar', '$', 7.83000, 0, 'HKD', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(11, 'Hungarian Forint', 'Ft', 255.24000, 0, 'HUF', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(12, 'Israeli New Sheqel', '₪', 3.48000, 0, 'ILS', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(13, 'Japanese Yen', '¥', 107.12000, 0, 'JPY', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(14, 'Malaysian Ringgit', 'RM', 3.91000, 0, 'MYR', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(15, 'Mexican Peso', '$', 18.72000, 0, 'MXN', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(16, 'Norwegian Krone', 'kr', 7.83000, 0, 'NOK', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(17, 'New Zealand Dollar', '$', 1.38000, 0, 'NZD', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(18, 'Philippine Peso', '₱', 52.26000, 0, 'PHP', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(19, 'Polish Zloty', 'zł', 3.39000, 0, 'PLN', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(20, 'Pound Sterling', '£', 0.72000, 0, 'GBP', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(21, 'Russian Ruble', 'руб', 55.93000, 0, 'RUB', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(22, 'Singapore Dollar', '$', 1.32000, 0, 'SGD', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(23, 'Swedish Krona', 'kr', 8.19000, 0, 'SEK', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(24, 'Swiss Franc', 'CHF', 0.94000, 0, 'CHF', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(26, 'Thai Baht', '฿', 31.39000, 0, 'THB', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(27, 'Taka', '৳', 84.00000, 0, 'BDT', '2018-10-09 11:35:08', '2018-12-02 05:16:13'),
(28, 'Indian Rupee', 'Rs', 68.45000, 0, 'Rupee', '2019-07-07 10:33:46', '2019-07-07 10:33:46'),
(29, 'Nigerian Naira', '₦', 750.00000, 0, 'NGN', '2023-05-28 20:22:35', '2023-06-02 22:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2023-05-29 22:29:24', '2023-05-29 22:29:24'),
(2, 3, '2023-05-29 22:31:48', '2023-05-29 22:31:48'),
(3, 4, '2023-05-29 22:35:44', '2023-05-29 22:35:44'),
(4, 5, '2023-05-29 23:11:10', '2023-05-29 23:11:10'),
(5, 6, '2023-05-30 07:30:51', '2023-05-30 07:30:51'),
(6, 7, '2023-06-09 22:05:06', '2023-06-09 22:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `customer_packages`
--

CREATE TABLE `customer_packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` double(20,2) DEFAULT NULL,
  `product_upload` int(11) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_package_payments`
--

CREATE TABLE `customer_package_payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_package_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_details` longtext NOT NULL,
  `approval` int(1) NOT NULL,
  `offline_payment` int(1) NOT NULL COMMENT '1=offline payment\r\n2=online paymnet',
  `reciept` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_package_translations`
--

CREATE TABLE `customer_package_translations` (
  `id` bigint(20) NOT NULL,
  `customer_package_id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lang` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_products`
--

CREATE TABLE `customer_products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `published` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0,
  `added_by` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `subsubcategory_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `photos` varchar(255) DEFAULT NULL,
  `thumbnail_img` varchar(150) DEFAULT NULL,
  `conditon` varchar(50) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `video_provider` varchar(100) DEFAULT NULL,
  `video_link` varchar(200) DEFAULT NULL,
  `unit` varchar(200) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `unit_price` double(20,2) DEFAULT 0.00,
  `meta_title` varchar(200) DEFAULT NULL,
  `meta_description` varchar(500) DEFAULT NULL,
  `meta_img` varchar(150) DEFAULT NULL,
  `pdf` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_product_translations`
--

CREATE TABLE `customer_product_translations` (
  `id` bigint(20) NOT NULL,
  `customer_product_id` bigint(20) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `lang` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boys`
--

CREATE TABLE `delivery_boys` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_boys`
--

INSERT INTO `delivery_boys` (`id`, `user_id`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flash_deals`
--

CREATE TABLE `flash_deals` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start_date` int(20) DEFAULT NULL,
  `end_date` int(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `featured` int(1) NOT NULL DEFAULT 0,
  `background_color` varchar(255) DEFAULT NULL,
  `text_color` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `flash_deals`
--

INSERT INTO `flash_deals` (`id`, `title`, `start_date`, `end_date`, `status`, `featured`, `background_color`, `text_color`, `banner`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Clothing & Shoes', 1685404800, 1686095940, 1, 1, '#FFF', 'white', '110', 'clothing-&-shoes-jomu3', '2023-05-29 06:13:06', '2023-05-29 06:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `flash_deal_products`
--

CREATE TABLE `flash_deal_products` (
  `id` int(11) NOT NULL,
  `flash_deal_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount` double(20,2) DEFAULT 0.00,
  `discount_type` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `flash_deal_products`
--

INSERT INTO `flash_deal_products` (`id`, `flash_deal_id`, `product_id`, `discount`, `discount_type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0.00, NULL, '2023-05-29 06:13:06', '2023-05-29 06:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `flash_deal_translations`
--

CREATE TABLE `flash_deal_translations` (
  `id` bigint(20) NOT NULL,
  `flash_deal_id` bigint(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `lang` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `flash_deal_translations`
--

INSERT INTO `flash_deal_translations` (`id`, `flash_deal_id`, `title`, `lang`, `created_at`, `updated_at`) VALUES
(1, 1, 'Clothing & Shoes', 'en', '2023-05-29 06:13:06', '2023-05-29 06:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `frontend_color` varchar(255) NOT NULL DEFAULT 'default',
  `logo` varchar(255) DEFAULT NULL,
  `footer_logo` varchar(255) DEFAULT NULL,
  `admin_logo` varchar(255) DEFAULT NULL,
  `admin_login_background` varchar(255) DEFAULT NULL,
  `admin_login_sidebar` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `description` mediumtext NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(1000) DEFAULT NULL,
  `instagram` varchar(1000) DEFAULT NULL,
  `twitter` varchar(1000) DEFAULT NULL,
  `youtube` varchar(1000) DEFAULT NULL,
  `google_plus` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `frontend_color`, `logo`, `footer_logo`, `admin_logo`, `admin_login_background`, `admin_login_sidebar`, `favicon`, `site_name`, `address`, `description`, `phone`, `tax`, `email`, `facebook`, `instagram`, `twitter`, `youtube`, `google_plus`, `created_at`, `updated_at`) VALUES
(1, 'default', 'uploads/logo/pfdIuiMeXGkDAIpPEUrvUCbQrOHu484nbGfz77zB.png', NULL, 'uploads/admin_logo/wCgHrz0Q5QoL1yu4vdrNnQIr4uGuNL48CXfcxOuS.png', NULL, NULL, 'uploads/favicon/uHdGidSaRVzvPgDj6JFtntMqzJkwDk9659233jrb.png', 'Active Ecommerce CMS', 'Demo Address', 'Active eCommerce CMS is a Multi vendor system is such a platform to build a border less marketplace.', '1234567890', NULL, 'admin@example.com', 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.twitter.com', 'https://www.youtube.com', 'https://www.googleplus.com', '2023-05-25 03:28:32', '2023-05-25 02:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `home_categories`
--

CREATE TABLE `home_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subsubcategories` varchar(1000) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `home_categories`
--

INSERT INTO `home_categories` (`id`, `category_id`, `subsubcategories`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '[\"1\"]', 1, '2019-03-12 06:38:23', '2019-03-12 06:38:23'),
(2, 2, '[\"10\"]', 1, '2019-03-12 06:44:54', '2019-03-12 06:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `rtl` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `rtl`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 0, '2019-01-20 12:13:20', '2023-05-25 04:46:24'),
(3, 'Nigerian', 'ng', 0, '2019-02-17 06:35:37', '2023-05-28 21:35:38'),
(4, 'Arabic', 'sa', 1, '2019-04-28 18:34:12', '2019-04-28 18:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logistics`
--

CREATE TABLE `logistics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `verification_status` int(1) NOT NULL DEFAULT 1,
  `verification_info` longtext DEFAULT NULL,
  `cash_on_delivery_status` int(1) DEFAULT NULL,
  `admin_to_pay` double(20,2) NOT NULL DEFAULT 0.00,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_acc_name` varchar(200) DEFAULT NULL,
  `bank_acc_no` varchar(50) DEFAULT NULL,
  `bank_routing_no` int(50) DEFAULT NULL,
  `bank_payment_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logistic_sales`
--

CREATE TABLE `logistic_sales` (
  `id` int(20) NOT NULL,
  `request` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('125ce8289850f80d9fea100325bf892fbd0deba1f87dbfc2ab81fb43d57377ec24ed65f7dc560e46', 1, 1, 'Personal Access Token', '[]', 0, '2019-07-30 04:51:13', '2019-07-30 04:51:13', '2020-07-30 10:51:13'),
('293d2bb534220c070c4e90d25b5509965d23d3ddbc05b1e29fb4899ae09420ff112dbccab1c6f504', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 06:00:04', '2019-08-04 06:00:04', '2020-08-04 12:00:04'),
('5363e91c7892acdd6417aa9c7d4987d83568e229befbd75be64282dbe8a88147c6c705e06c1fb2bf', 1, 1, 'Personal Access Token', '[]', 0, '2019-07-13 06:44:28', '2019-07-13 06:44:28', '2020-07-13 12:44:28'),
('681b4a4099fac5e12517307b4027b54df94cbaf0cbf6b4bf496534c94f0ccd8a79dd6af9742d076b', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 07:23:06', '2019-08-04 07:23:06', '2020-08-04 13:23:06'),
('6d229e3559e568df086c706a1056f760abc1370abe74033c773490581a042442154afa1260c4b6f0', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 07:32:12', '2019-08-04 07:32:12', '2020-08-04 13:32:12'),
('6efc0f1fc3843027ea1ea7cd35acf9c74282f0271c31d45a164e7b27025a315d31022efe7bb94aaa', 1, 1, 'Personal Access Token', '[]', 0, '2019-08-08 02:35:26', '2019-08-08 02:35:26', '2020-08-08 08:35:26'),
('7745b763da15a06eaded371330072361b0524c41651cf48bf76fc1b521a475ece78703646e06d3b0', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 07:29:44', '2019-08-04 07:29:44', '2020-08-04 13:29:44'),
('815b625e239934be293cd34479b0f766bbc1da7cc10d464a2944ddce3a0142e943ae48be018ccbd0', 1, 1, 'Personal Access Token', '[]', 1, '2019-07-22 02:07:47', '2019-07-22 02:07:47', '2020-07-22 08:07:47'),
('8921a4c96a6d674ac002e216f98855c69de2568003f9b4136f6e66f4cb9545442fb3e37e91a27cad', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 06:05:05', '2019-08-04 06:05:05', '2020-08-04 12:05:05'),
('8d8b85720304e2f161a66564cec0ecd50d70e611cc0efbf04e409330086e6009f72a39ce2191f33a', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 06:44:35', '2019-08-04 06:44:35', '2020-08-04 12:44:35'),
('bcaaebdead4c0ef15f3ea6d196fd80749d309e6db8603b235e818cb626a5cea034ff2a55b66e3e1a', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 07:14:32', '2019-08-04 07:14:32', '2020-08-04 13:14:32'),
('c25417a5c728073ca8ba57058ded43d496a9d2619b434d2a004dd490a64478c08bc3e06ffc1be65d', 1, 1, 'Personal Access Token', '[]', 1, '2019-07-30 01:45:31', '2019-07-30 01:45:31', '2020-07-30 07:45:31'),
('c7423d85b2b5bdc5027cb283be57fa22f5943cae43f60b0ed27e6dd198e46f25e3501b3081ed0777', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-05 05:02:59', '2019-08-05 05:02:59', '2020-08-05 11:02:59'),
('e76f19dbd5c2c4060719fb1006ac56116fd86f7838b4bf74e2c0a0ac9696e724df1e517dbdb357f4', 1, 1, 'Personal Access Token', '[]', 1, '2019-07-15 02:53:40', '2019-07-15 02:53:40', '2020-07-15 08:53:40'),
('ed7c269dd6f9a97750a982f62e0de54749be6950e323cdfef892a1ec93f8ddbacf9fe26e6a42180e', 1, 1, 'Personal Access Token', '[]', 1, '2019-07-13 06:36:45', '2019-07-13 06:36:45', '2020-07-13 12:36:45'),
('f6d1475bc17a27e389000d3df4da5c5004ce7610158b0dd414226700c0f6db48914637b4c76e1948', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 07:22:01', '2019-08-04 07:22:01', '2020-08-04 13:22:01'),
('f85e4e444fc954430170c41779a4238f84cd6fed905f682795cd4d7b6a291ec5204a10ac0480eb30', 1, 1, 'Personal Access Token', '[]', 1, '2019-07-30 06:38:49', '2019-07-30 06:38:49', '2020-07-30 12:38:49'),
('f8bf983a42c543b99128296e4bc7c2d17a52b5b9ef69670c629b93a653c6a4af27be452e0c331f79', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 07:28:55', '2019-08-04 07:28:55', '2020-08-04 13:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) NOT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'eR2y7WUuem28ugHKppFpmss7jPyOHZsMkQwBo1Jj', 'http://localhost', 1, 0, 0, '2019-07-13 06:17:34', '2019-07-13 06:17:34'),
(2, NULL, 'Laravel Password Grant Client', 'WLW2Ol0GozbaXEnx1NtXoweYPuKEbjWdviaUgw77', 'http://localhost', 0, 1, 0, '2019-07-13 06:17:34', '2019-07-13 06:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-07-13 06:17:34', '2019-07-13 06:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `shipping_address` longtext DEFAULT NULL,
  `assign_delivery_boy` int(20) DEFAULT NULL,
  `delivery_status` varchar(20) DEFAULT 'pending',
  `payment_type` varchar(20) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT 'unpaid',
  `payment_details` longtext DEFAULT NULL,
  `grand_total` double(20,2) DEFAULT NULL,
  `coupon_discount` double(20,2) NOT NULL DEFAULT 0.00,
  `code` mediumtext DEFAULT NULL,
  `date` int(20) NOT NULL,
  `viewed` int(1) NOT NULL DEFAULT 0,
  `delivery_viewed` int(1) NOT NULL DEFAULT 1,
  `payment_status_viewed` int(1) DEFAULT 1,
  `commission_calculated` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `guest_id`, `seller_id`, `shipping_address`, `assign_delivery_boy`, `delivery_status`, `payment_type`, `payment_status`, `payment_details`, `grand_total`, `coupon_discount`, `code`, `date`, `viewed`, `delivery_viewed`, `payment_status_viewed`, `commission_calculated`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, 4, 'picked up', NULL, 'unpaid', NULL, NULL, 0.00, NULL, 26, 0, 1, 1, 0, '2023-05-29 23:53:33', '2023-06-05 23:51:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `variation` longtext DEFAULT NULL,
  `price` double(20,2) DEFAULT NULL,
  `tax` double(20,2) NOT NULL DEFAULT 0.00,
  `shipping_cost` double(20,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) DEFAULT NULL,
  `payment_status` varchar(10) NOT NULL DEFAULT 'unpaid',
  `delivery_status` varchar(20) DEFAULT 'pending',
  `shipping_type` varchar(255) DEFAULT NULL,
  `pickup_point_id` int(11) DEFAULT NULL,
  `product_referral_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` varchar(1000) DEFAULT NULL,
  `keywords` varchar(1000) DEFAULT NULL,
  `meta_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `type`, `title`, `slug`, `content`, `meta_title`, `meta_description`, `keywords`, `meta_image`, `created_at`, `updated_at`) VALUES
(1, 'home_page', 'Home Page', 'home', NULL, NULL, NULL, NULL, NULL, '2020-11-04 10:13:20', '2020-11-04 10:13:20'),
(2, 'seller_policy_page', 'Seller Policy Pages', 'sellerpolicy', NULL, NULL, NULL, NULL, NULL, '2020-11-04 10:14:41', '2020-11-04 12:19:30'),
(3, 'return_policy_page', 'Return Policy Page', 'returnpolicy', NULL, NULL, NULL, NULL, NULL, '2020-11-04 10:14:41', '2020-11-04 10:14:41'),
(4, 'support_policy_page', 'Support Policy Page', 'supportpolicy', NULL, NULL, NULL, NULL, NULL, '2020-11-04 10:14:59', '2020-11-04 10:14:59'),
(5, 'terms_conditions_page', 'Term Conditions Page', 'terms', NULL, NULL, NULL, NULL, NULL, '2020-11-04 10:15:29', '2020-11-04 10:15:29'),
(6, 'privacy_policy_page', 'Privacy Policy Page', 'privacypolicy', NULL, NULL, NULL, NULL, NULL, '2020-11-04 10:15:55', '2020-11-04 10:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `page_translations`
--

CREATE TABLE `page_translations` (
  `id` bigint(20) NOT NULL,
  `page_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `lang` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `amount` double(20,2) NOT NULL DEFAULT 0.00,
  `payment_details` longtext DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `txn_code` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickup_points`
--

CREATE TABLE `pickup_points` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `pick_up_status` int(1) DEFAULT NULL,
  `cash_on_pickup_status` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickup_point_translations`
--

CREATE TABLE `pickup_point_translations` (
  `id` bigint(20) NOT NULL,
  `pickup_point_id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `lang` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `name`, `content`, `created_at`, `updated_at`) VALUES
(1, 'support_policy', NULL, '2019-10-29 12:54:45', '2019-01-22 05:13:15'),
(2, 'return_policy', NULL, '2019-10-29 12:54:47', '2019-01-24 05:40:11'),
(4, 'seller_policy', NULL, '2019-10-29 12:54:49', '2019-02-04 17:50:15'),
(5, 'terms', NULL, '2019-10-29 12:54:51', '2019-10-28 18:00:00'),
(6, 'privacy_policy', NULL, '2019-10-29 12:54:54', '2019-10-28 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `added_by` varchar(6) NOT NULL DEFAULT 'admin',
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `photos` varchar(2000) DEFAULT NULL,
  `thumbnail_img` varchar(100) DEFAULT NULL,
  `video_provider` varchar(20) DEFAULT NULL,
  `video_link` varchar(100) DEFAULT NULL,
  `tags` varchar(1000) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `unit_price` double(20,2) NOT NULL,
  `price_currecny` varchar(255) DEFAULT NULL,
  `purchase_price` double(20,2) DEFAULT NULL,
  `variant_product` int(1) NOT NULL DEFAULT 0,
  `attributes` varchar(1000) NOT NULL DEFAULT '[]',
  `choice_options` mediumtext DEFAULT NULL,
  `choice_no` int(11) DEFAULT NULL,
  `colors` mediumtext DEFAULT NULL,
  `variations` text DEFAULT NULL,
  `todays_deal` int(11) NOT NULL DEFAULT 0,
  `published` int(11) NOT NULL DEFAULT 1,
  `approved` int(20) NOT NULL DEFAULT 1,
  `approval_status` varchar(255) DEFAULT NULL,
  `stock_visibility_state` varchar(10) NOT NULL DEFAULT 'quantity',
  `cash_on_delivery` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = On, 0 = Off',
  `featured` int(11) NOT NULL DEFAULT 0,
  `seller_featured` int(11) NOT NULL DEFAULT 0,
  `current_stock` int(10) NOT NULL DEFAULT 0,
  `unit` varchar(20) DEFAULT NULL,
  `price` int(15) DEFAULT NULL,
  `kg` int(20) DEFAULT NULL,
  `min_qty` int(11) NOT NULL DEFAULT 1,
  `low_stock_quantity` int(11) DEFAULT NULL,
  `discount` double(20,2) DEFAULT NULL,
  `discount_type` varchar(10) DEFAULT NULL,
  `discount_start_date` int(11) DEFAULT NULL,
  `discount_end_date` int(11) DEFAULT NULL,
  `tax` double(20,2) DEFAULT NULL,
  `qty` int(20) DEFAULT NULL,
  `tax_type` varchar(10) DEFAULT NULL,
  `shipping_type` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'flat_rate',
  `shipping_cost` text DEFAULT NULL,
  `is_quantity_multiplied` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = Mutiplied with shipping cost',
  `est_shipping_days` int(11) DEFAULT NULL,
  `num_of_sale` int(11) NOT NULL DEFAULT 0,
  `meta_title` mediumtext DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `meta_img` varchar(255) DEFAULT NULL,
  `pdf` varchar(255) DEFAULT NULL,
  `slug` mediumtext NOT NULL,
  `rating` double(8,2) NOT NULL DEFAULT 0.00,
  `barcode` varchar(255) DEFAULT NULL,
  `digital` int(1) NOT NULL DEFAULT 0,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `added_by`, `user_id`, `category_id`, `brand_id`, `photos`, `thumbnail_img`, `video_provider`, `video_link`, `tags`, `description`, `unit_price`, `price_currecny`, `purchase_price`, `variant_product`, `attributes`, `choice_options`, `choice_no`, `colors`, `variations`, `todays_deal`, `published`, `approved`, `approval_status`, `stock_visibility_state`, `cash_on_delivery`, `featured`, `seller_featured`, `current_stock`, `unit`, `price`, `kg`, `min_qty`, `low_stock_quantity`, `discount`, `discount_type`, `discount_start_date`, `discount_end_date`, `tax`, `qty`, `tax_type`, `shipping_type`, `shipping_cost`, `is_quantity_multiplied`, `est_shipping_days`, `num_of_sale`, `meta_title`, `meta_description`, `meta_img`, `pdf`, `slug`, `rating`, `barcode`, `digital`, `file_name`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 'Men Letter Graphic Colorblock Tee', 'admin', 1, 33, 28, '85,84,83', '85,84,83', 'youtube', NULL, 'men', '<p><strong>Men Letter Graphic Colorblock Tee is perfect for you.</strong></p>', 3.02, '1', NULL, 0, '[]', '[]', NULL, '[]', NULL, 1, 1, 1, 'Approved', 'quantity', 1, 1, 0, 0, 'lb', NULL, 11, 1, 4, 1.00, 'percent', 1685404800, 1686095940, NULL, NULL, NULL, 'free', '0', 0, 7, 0, 'Men Letter Graphic Colorblock Tee', 'Men Letter Graphic Colorblock Tee', '85,84,83', NULL, 'Men-Letter-Graphic-Colorblock-Tee-u5iGY', 0.00, NULL, 0, NULL, NULL, '2023-05-29 05:33:13', '2023-05-29 06:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `price` double(20,2) NOT NULL DEFAULT 0.00,
  `qty` int(11) NOT NULL DEFAULT 0,
  `image` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_stocks`
--

INSERT INTO `product_stocks` (`id`, `product_id`, `variant`, `sku`, `price`, `qty`, `image`, `created_at`, `updated_at`) VALUES
(6, 1, '', 'MLGCT001', 3.02, 24, NULL, '2023-05-29 05:33:13', '2023-05-29 05:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_taxes`
--

CREATE TABLE `product_taxes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `tax` double(20,2) NOT NULL,
  `tax_type` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product_taxes`
--

INSERT INTO `product_taxes` (`id`, `product_id`, `tax_id`, `tax`, `tax_type`, `created_at`, `updated_at`) VALUES
(9, 3, 3, 0.00, 'amount', '2023-05-25 20:25:28', '2023-05-25 20:25:28'),
(13, 4, 3, 0.00, 'amount', '2023-05-25 21:04:00', '2023-05-25 21:04:00'),
(14, 6, 3, 0.00, 'amount', '2023-05-26 08:07:39', '2023-05-26 08:07:39'),
(15, 7, 3, 0.00, 'amount', '2023-05-26 08:08:50', '2023-05-26 08:08:50'),
(16, 8, 3, 0.00, 'amount', '2023-05-26 08:10:26', '2023-05-26 08:10:26'),
(17, 9, 3, 0.00, 'amount', '2023-05-26 18:53:28', '2023-05-26 18:53:28'),
(18, 10, 3, 0.00, 'amount', '2023-05-26 18:53:38', '2023-05-26 18:53:38'),
(26, 3, 3, 1.00, 'percent', '2023-05-26 19:47:54', '2023-05-26 19:47:54'),
(34, 2, 3, 0.20, 'percent', '2023-05-28 13:41:15', '2023-05-28 13:41:15'),
(36, 1, 3, 1.00, 'percent', '2023-05-28 13:58:22', '2023-05-28 13:58:22'),
(37, 4, 3, 2.00, 'amount', '2023-05-28 19:27:32', '2023-05-28 19:27:32'),
(39, 6, 3, 1.00, 'percent', '2023-05-28 19:52:58', '2023-05-28 19:52:58'),
(40, 7, 3, 1.00, 'percent', '2023-05-28 19:53:14', '2023-05-28 19:53:14'),
(41, 8, 3, 1.00, 'percent', '2023-05-28 19:54:40', '2023-05-28 19:54:40'),
(42, 9, 3, 1.00, 'percent', '2023-05-28 19:55:45', '2023-05-28 19:55:45'),
(43, 10, 3, 1.00, 'percent', '2023-05-28 19:57:06', '2023-05-28 19:57:06'),
(44, 11, 3, 1.00, 'percent', '2023-05-28 19:57:39', '2023-05-28 19:57:39'),
(45, 12, 3, 1.00, 'percent', '2023-05-28 19:58:20', '2023-05-28 19:58:20'),
(46, 13, 3, 1.00, 'percent', '2023-05-28 19:58:33', '2023-05-28 19:58:33'),
(47, 14, 3, 1.00, 'percent', '2023-05-28 19:58:42', '2023-05-28 19:58:42'),
(48, 15, 3, 1.00, 'percent', '2023-05-28 19:58:54', '2023-05-28 19:58:54'),
(49, 16, 3, 1.00, 'percent', '2023-05-28 19:59:04', '2023-05-28 19:59:04'),
(50, 17, 3, 1.00, 'percent', '2023-05-28 19:59:15', '2023-05-28 19:59:15'),
(51, 18, 3, 1.00, 'percent', '2023-05-28 19:59:27', '2023-05-28 19:59:27'),
(52, 19, 3, 1.00, 'percent', '2023-05-28 20:02:57', '2023-05-28 20:02:57'),
(60, 5, 3, 1.00, 'percent', '2023-05-28 20:52:13', '2023-05-28 20:52:13'),
(64, 20, 3, 0.50, 'percent', '2023-05-28 21:13:56', '2023-05-28 21:13:56'),
(65, 21, 3, 2.00, 'percent', '2023-05-29 05:27:21', '2023-05-29 05:27:21'),
(66, 1, 3, 1.00, 'amount', '2023-05-29 05:33:13', '2023-05-29 05:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_translations`
--

CREATE TABLE `product_translations` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `lang` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_translations`
--

INSERT INTO `product_translations` (`id`, `product_id`, `name`, `unit`, `description`, `lang`, `created_at`, `updated_at`) VALUES
(29, 1, 'Men Letter Graphic Colorblock Tee', 'lb', '<p><strong>Men Letter Graphic Colorblock Tee is perfect for you.</strong></p>', 'en', '2023-05-29 05:33:13', '2023-05-29 05:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `proxypay_payments`
--

CREATE TABLE `proxypay_payments` (
  `id` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `reference_id` varchar(20) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double(25,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `comment` mediumtext NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `viewed` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `permissions` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Manager', '[\"1\",\"2\",\"4\"]', '2018-10-10 04:39:47', '2018-10-10 04:51:37'),
(2, 'Accountant', '[\"2\",\"3\"]', '2018-10-10 04:52:09', '2018-10-10 04:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `role_translations`
--

CREATE TABLE `role_translations` (
  `id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lang` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `searches`
--

CREATE TABLE `searches` (
  `id` int(11) NOT NULL,
  `query` varchar(1000) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `searches`
--

INSERT INTO `searches` (`id`, `query`, `count`, `created_at`, `updated_at`) VALUES
(2, 'dcs', 1, '2020-03-08 00:29:09', '2020-03-08 00:29:09'),
(3, 'das', 3, '2020-03-08 00:29:15', '2020-03-08 00:29:50'),
(4, 'men', 5, '2023-05-26 03:46:32', '2023-05-28 13:39:40'),
(5, 'kks', 1, '2023-05-28 21:49:54', '2023-05-28 21:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `verification_status` int(1) NOT NULL DEFAULT 1,
  `verification_info` longtext DEFAULT NULL,
  `cash_on_delivery_status` int(1) NOT NULL DEFAULT 0,
  `admin_to_pay` double(20,2) NOT NULL DEFAULT 0.00,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_acc_name` varchar(200) DEFAULT NULL,
  `bank_acc_no` varchar(50) DEFAULT NULL,
  `bank_routing_no` int(50) DEFAULT NULL,
  `bank_payment_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `user_id`, `verification_status`, `verification_info`, `cash_on_delivery_status`, `admin_to_pay`, `bank_name`, `bank_acc_name`, `bank_acc_no`, `bank_routing_no`, `bank_payment_status`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '[{\"type\":\"text\",\"label\":\"Name\",\"value\":\"Nnadi\"},{\"type\":\"select\",\"label\":\"Marital Status\",\"value\":\"Married\"},{\"type\":\"multi_select\",\"label\":\"Company\",\"value\":\"[\\\"AvTech\\\"]\"},{\"type\":\"select\",\"label\":\"Gender\",\"value\":\"Male\"},{\"type\":\"file\",\"label\":\"Image\",\"value\":\"uploads\\/verification_form\\/CRWqFifcbKqibNzllBhEyUSkV6m1viknGXMEhtiW.png\"}]', 1, 78.40, 'Access Bank', 'Nnadi Adaeze Precious', '0613743801', NULL, 1, '2018-10-07 04:42:57', '2023-05-29 23:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `seller_withdraw_requests`
--

CREATE TABLE `seller_withdraw_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` double(20,2) DEFAULT NULL,
  `message` longtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `viewed` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `revisit` int(11) NOT NULL,
  `sitemap_link` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `keyword`, `author`, `revisit`, `sitemap_link`, `description`, `created_at`, `updated_at`) VALUES
(1, 'bootstrap,responsive,template,developer', 'Active IT Zone', 11, 'https://www.activeitzone.com', 'Active E-commerce CMS Multi vendor system is such a platform to build a border less marketplace both for physical and digital goods.', '2019-08-08 08:56:11', '2019-08-08 02:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_details`
--

CREATE TABLE `shipping_details` (
  `id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_charges` int(11) DEFAULT NULL,
  `gst_rate` int(11) DEFAULT NULL,
  `kg` int(11) DEFAULT NULL,
  `price_currecny` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `ship_country` varchar(255) NOT NULL,
  `ship_state` varchar(255) NOT NULL,
  `ship_city` varchar(255) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `transit_day` int(10) DEFAULT NULL,
  `shipping_tax` int(11) DEFAULT NULL,
  `pickup_date` int(15) DEFAULT NULL,
  `pickup_time` int(15) DEFAULT NULL,
  `arrival_date` int(15) DEFAULT NULL,
  `arrival_time` int(15) DEFAULT NULL,
  `delivery_time_frame` int(15) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `sliders` longtext DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `google` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `pick_up_point_id` text DEFAULT NULL,
  `shipping_cost` double(20,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `user_id`, `name`, `logo`, `sliders`, `phone`, `address`, `facebook`, `google`, `twitter`, `youtube`, `slug`, `meta_title`, `meta_description`, `pick_up_point_id`, `shipping_cost`, `created_at`, `updated_at`) VALUES
(1, 3, 'Demo Seller Shop', NULL, '69', NULL, 'House : Demo, Road : Demo, Section : Demo', 'www.facebook.com', 'www.google.com', 'www.twitter.com', 'www.youtube.com', 'Demo-Seller-Shop-1', 'Demo Seller Shop Title', 'Demo description', NULL, 0.00, '2018-11-27 10:23:13', '2023-05-25 21:11:08'),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'demo-shop-2', NULL, NULL, NULL, 0.00, '2023-05-26 18:19:43', '2023-05-26 18:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `published` int(1) NOT NULL DEFAULT 1,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `photo`, `published`, `link`, `created_at`, `updated_at`) VALUES
(7, 'uploads/sliders/slider-image.jpg', 1, NULL, '2019-03-12 05:58:05', '2019-03-12 05:58:05'),
(8, 'uploads/sliders/slider-image.jpg', 1, NULL, '2019-03-12 05:58:12', '2019-03-12 05:58:12');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2023-05-29 23:03:32', '2023-05-29 23:03:32'),
(2, 6, 2, '2023-05-30 17:34:48', '2023-05-30 17:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost` int(20) DEFAULT NULL,
  `country_id` int(20) NOT NULL DEFAULT 161
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci COMMENT='States in Nigeria.';

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `cost`, `country_id`) VALUES
(1, 'Abia', NULL, 161),
(2, 'Adamawa', NULL, 161),
(3, 'Akwa Ibom', NULL, 161),
(4, 'Anambra', NULL, 161),
(5, 'Bauchi', NULL, 161),
(6, 'Bayelsa', NULL, 161),
(7, 'Benue', NULL, 161),
(8, 'Borno', NULL, 161),
(9, 'Cross River', NULL, 161),
(10, 'Delta', NULL, 161),
(11, 'Ebonyi', NULL, 161),
(12, 'Edo', NULL, 161),
(13, 'Ekiti', NULL, 161),
(14, 'Enugu', NULL, 161),
(15, 'FCT', NULL, 161),
(16, 'Gombe', NULL, 161),
(17, 'Imo', NULL, 161),
(18, 'Jigawa', NULL, 161),
(19, 'Kaduna', NULL, 161),
(20, 'Kano', NULL, 161),
(21, 'Katsina', NULL, 161),
(22, 'Kebbi', NULL, 161),
(23, 'Kogi', NULL, 161),
(24, 'Kwara', NULL, 161),
(25, 'Lagos', NULL, 161),
(26, 'Nasarawa', NULL, 161),
(27, 'Niger', NULL, 161),
(28, 'Ogun', NULL, 161),
(29, 'Ondo', NULL, 161),
(30, 'Osun', NULL, 161),
(31, 'Oyo', NULL, 161),
(32, 'Plateau', NULL, 161),
(33, 'Rivers', NULL, 161),
(34, 'Sokoto', NULL, 161),
(35, 'Taraba', NULL, 161),
(36, 'Yobe', NULL, 161),
(37, 'Zamfara', NULL, 161);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tax_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = Inactive, 1 = Active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `tax_status`, `created_at`, `updated_at`) VALUES
(3, 'Tax', 1, '2021-03-07 11:45:33', '2021-03-07 11:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `code` int(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `details` longtext DEFAULT NULL,
  `files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `viewed` int(1) NOT NULL DEFAULT 0,
  `client_viewed` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `code`, `user_id`, `subject`, `details`, `files`, `status`, `viewed`, `client_viewed`, `created_at`, `updated_at`) VALUES
(1, 230603, 6, 'Men T-Shirt', 'This is a ticket t-shirt', '114', 'pending', 1, 1, '2023-06-04 00:05:52', '2023-06-03 23:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_replies`
--

CREATE TABLE `ticket_replies` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply` longtext NOT NULL,
  `files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(11) NOT NULL,
  `lang` varchar(10) DEFAULT NULL,
  `lang_key` text DEFAULT NULL,
  `lang_value` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(3, 'en', 'All Category', 'All Category', '2020-11-02 07:40:38', '2020-11-02 07:40:38'),
(4, 'en', 'All', 'All', '2020-11-02 07:40:38', '2020-11-02 07:40:38'),
(5, 'en', 'Flash Sale', 'Flash Sale', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(6, 'en', 'View More', 'View More', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(7, 'en', 'Add to wishlist', 'Add to wishlist', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(8, 'en', 'Add to compare', 'Add to compare', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(9, 'en', 'Add to cart', 'Add to cart', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(10, 'en', 'Club Point', 'Club Point', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(11, 'en', 'Classified Ads', 'Classified Ads', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(13, 'en', 'Used', 'Used', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(14, 'en', 'Top 10 Categories', 'Top 10 Categories', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(15, 'en', 'View All Categories', 'View All Categories', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(16, 'en', 'Top 10 Brands', 'Top 10 Brands', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(17, 'en', 'View All Brands', 'View All Brands', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(43, 'en', 'Terms & conditions', 'Terms & conditions', '2020-11-02 07:40:41', '2020-11-02 07:40:41'),
(51, 'en', 'Best Selling', 'Best Selling', '2020-11-02 07:40:42', '2020-11-02 07:40:42'),
(53, 'en', 'Top 20', 'Top 20', '2020-11-02 07:40:42', '2020-11-02 07:40:42'),
(55, 'en', 'Featured Products', 'Featured Products', '2020-11-02 07:40:42', '2020-11-02 07:40:42'),
(56, 'en', 'Best Sellers', 'Best Sellers', '2020-11-02 07:40:43', '2020-11-02 07:40:43'),
(57, 'en', 'Visit Store', 'Visit Store', '2020-11-02 07:40:43', '2020-11-02 07:40:43'),
(58, 'en', 'Popular Suggestions', 'Popular Suggestions', '2020-11-02 07:46:59', '2020-11-02 07:46:59'),
(59, 'en', 'Category Suggestions', 'Category Suggestions', '2020-11-02 07:46:59', '2020-11-02 07:46:59'),
(62, 'en', 'Automobile & Motorcycle', 'Automobile & Motorcycle', '2020-11-02 07:47:01', '2020-11-02 07:47:01'),
(63, 'en', 'Price range', 'Price range', '2020-11-02 07:47:01', '2020-11-02 07:47:01'),
(64, 'en', 'Filter by color', 'Filter by color', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(65, 'en', 'Home', 'Home', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(67, 'en', 'Newest', 'Newest', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(68, 'en', 'Oldest', 'Oldest', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(69, 'en', 'Price low to high', 'Price low to high', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(70, 'en', 'Price high to low', 'Price high to low', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(71, 'en', 'Brands', 'Brands', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(72, 'en', 'All Brands', 'All Brands', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(74, 'en', 'All Sellers', 'All Sellers', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(78, 'en', 'Inhouse product', 'Inhouse product', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(79, 'en', 'Message Seller', 'Message Seller', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(80, 'en', 'Price', 'Price', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(81, 'en', 'Discount Price', 'Discount Price', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(82, 'en', 'Color', 'Color', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(83, 'en', 'Quantity', 'Quantity', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(84, 'en', 'available', 'available', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(85, 'en', 'Total Price', 'Total Price', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(86, 'en', 'Out of Stock', 'Out of Stock', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(87, 'en', 'Refund', 'Refund', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(88, 'en', 'Share', 'Share', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(89, 'en', 'Sold By', 'Sold By', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(90, 'en', 'customer reviews', 'customer reviews', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(91, 'en', 'Top Selling Products', 'Top Selling Products', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(92, 'en', 'Description', 'Description', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(93, 'en', 'Video', 'Video', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(94, 'en', 'Reviews', 'Reviews', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(95, 'en', 'Download', 'Download', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(96, 'en', 'There have been no reviews for this product yet.', 'There have been no reviews for this product yet.', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(97, 'en', 'Related products', 'Related products', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(98, 'en', 'Any query about this product', 'Any query about this product', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(99, 'en', 'Product Name', 'Product Name', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(100, 'en', 'Your Question', 'Your Question', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(101, 'en', 'Send', 'Send', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(103, 'en', 'Use country code before number', 'Use country code before number', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(105, 'en', 'Remember Me', 'Remember Me', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(107, 'en', 'Dont have an account?', 'Dont have an account?', '2020-11-02 08:18:04', '2020-11-02 08:18:04'),
(108, 'en', 'Register Now', 'Register Now', '2020-11-02 08:18:04', '2020-11-02 08:18:04'),
(109, 'en', 'Or Login With', 'Or Login With', '2020-11-02 08:18:04', '2020-11-02 08:18:04'),
(110, 'en', 'oops..', 'oops..', '2020-11-02 10:29:04', '2020-11-02 10:29:04'),
(111, 'en', 'This item is out of stock!', 'This item is out of stock!', '2020-11-02 10:29:04', '2020-11-02 10:29:04'),
(112, 'en', 'Back to shopping', 'Back to shopping', '2020-11-02 10:29:04', '2020-11-02 10:29:04'),
(113, 'en', 'Login to your account.', 'Login to your account.', '2020-11-02 11:27:41', '2020-11-02 11:27:41'),
(115, 'en', 'Purchase History', 'Purchase History', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(116, 'en', 'New', 'New', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(117, 'en', 'Downloads', 'Downloads', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(118, 'en', 'Sent Refund Request', 'Sent Refund Request', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(119, 'en', 'Product Bulk Upload', 'Product Bulk Upload', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(123, 'en', 'Orders', 'Orders', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(124, 'en', 'Recieved Refund Request', 'Recieved Refund Request', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(126, 'en', 'Shop Setting', 'Shop Setting', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(127, 'en', 'Payment History', 'Payment History', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(128, 'en', 'Money Withdraw', 'Money Withdraw', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(129, 'en', 'Conversations', 'Conversations', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(130, 'en', 'My Wallet', 'My Wallet', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(131, 'en', 'Earning Points', 'Earning Points', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(132, 'en', 'Support Ticket', 'Support Ticket', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(133, 'en', 'Manage Profile', 'Manage Profile', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(134, 'en', 'Sold Amount', 'Sold Amount', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(135, 'en', 'Your sold amount (current month)', 'Your sold amount (current month)', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(136, 'en', 'Total Sold', 'Total Sold', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(137, 'en', 'Last Month Sold', 'Last Month Sold', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(138, 'en', 'Total sale', 'Total sale', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(139, 'en', 'Total earnings', 'Total earnings', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(140, 'en', 'Successful orders', 'Successful orders', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(141, 'en', 'Total orders', 'Total orders', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(142, 'en', 'Pending orders', 'Pending orders', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(143, 'en', 'Cancelled orders', 'Cancelled orders', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(145, 'en', 'Product', 'Product', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(147, 'en', 'Purchased Package', 'Purchased Package', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(148, 'en', 'Package Not Found', 'Package Not Found', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(149, 'en', 'Upgrade Package', 'Upgrade Package', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(150, 'en', 'Shop', 'Shop', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(151, 'en', 'Manage & organize your shop', 'Manage & organize your shop', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(152, 'en', 'Go to setting', 'Go to setting', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(153, 'en', 'Payment', 'Payment', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(154, 'en', 'Configure your payment method', 'Configure your payment method', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(156, 'en', 'My Panel', 'My Panel', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(158, 'en', 'Item has been added to wishlist', 'Item has been added to wishlist', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(159, 'en', 'My Points', 'My Points', '2020-11-02 11:28:15', '2020-11-02 11:28:15'),
(160, 'en', ' Points', ' Points', '2020-11-02 11:28:15', '2020-11-02 11:28:15'),
(161, 'en', 'Wallet Money', 'Wallet Money', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(162, 'en', 'Exchange Rate', 'Exchange Rate', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(163, 'en', 'Point Earning history', 'Point Earning history', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(164, 'en', 'Date', 'Date', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(165, 'en', 'Points', 'Points', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(166, 'en', 'Converted', 'Converted', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(167, 'en', 'Action', 'Action', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(168, 'en', 'No history found.', 'No history found.', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(169, 'en', 'Convert has been done successfully Check your Wallets', 'Convert has been done successfully Check your Wallets', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(170, 'en', 'Something went wrong', 'Something went wrong', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(171, 'en', 'Remaining Uploads', 'Remaining Uploads', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(172, 'en', 'No Package Found', 'No Package Found', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(173, 'en', 'Search product', 'Search product', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(174, 'en', 'Name', 'Name', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(176, 'en', 'Current Qty', 'Current Qty', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(177, 'en', 'Base Price', 'Base Price', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(178, 'en', 'Published', 'Published', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(179, 'en', 'Featured', 'Featured', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(180, 'en', 'Options', 'Options', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(181, 'en', 'Edit', 'Edit', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(182, 'en', 'Duplicate', 'Duplicate', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(184, 'en', '1. Download the skeleton file and fill it with data.', '1. Download the skeleton file and fill it with data.', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(185, 'en', '2. You can download the example file to understand how the data must be filled.', '2. You can download the example file to understand how the data must be filled.', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(186, 'en', '3. Once you have downloaded and filled the skeleton file, upload it in the form below and submit.', '3. Once you have downloaded and filled the skeleton file, upload it in the form below and submit.', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(187, 'en', '4. After uploading products you need to edit them and set products images and choices.', '4. After uploading products you need to edit them and set products images and choices.', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(188, 'en', 'Download CSV', 'Download CSV', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(189, 'en', '1. Category,Sub category,Sub Sub category and Brand should be in numerical ids.', '1. Category,Sub category,Sub Sub category and Brand should be in numerical ids.', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(190, 'en', '2. You can download the pdf to get Category,Sub category,Sub Sub category and Brand id.', '2. You can download the pdf to get Category,Sub category,Sub Sub category and Brand id.', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(191, 'en', 'Download Category', 'Download Category', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(192, 'en', 'Download Sub category', 'Download Sub category', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(193, 'en', 'Download Sub Sub category', 'Download Sub Sub category', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(194, 'en', 'Download Brand', 'Download Brand', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(195, 'en', 'Upload CSV File', 'Upload CSV File', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(196, 'en', 'CSV', 'CSV', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(197, 'en', 'Choose CSV File', 'Choose CSV File', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(198, 'en', 'Upload', 'Upload', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(199, 'en', 'Add New Digital Product', 'Add New Digital Product', '2020-11-02 11:37:25', '2020-11-02 11:37:25'),
(200, 'en', 'Available Status', 'Available Status', '2020-11-02 11:37:29', '2020-11-02 11:37:29'),
(201, 'en', 'Admin Status', 'Admin Status', '2020-11-02 11:37:29', '2020-11-02 11:37:29'),
(202, 'en', 'Pending Balance', 'Pending Balance', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(203, 'en', 'Send Withdraw Request', 'Send Withdraw Request', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(204, 'en', 'Withdraw Request history', 'Withdraw Request history', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(205, 'en', 'Amount', 'Amount', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(206, 'en', 'Status', 'Status', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(207, 'en', 'Message', 'Message', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(208, 'en', 'Send A Withdraw Request', 'Send A Withdraw Request', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(209, 'en', 'Basic Info', 'Basic Info', '2020-11-02 11:38:13', '2020-11-02 11:38:13'),
(211, 'en', 'Your Phone', 'Your Phone', '2020-11-02 11:38:13', '2020-11-02 11:38:13'),
(212, 'en', 'Photo', 'Photo', '2020-11-02 11:38:13', '2020-11-02 11:38:13'),
(213, 'en', 'Browse', 'Browse', '2020-11-02 11:38:13', '2020-11-02 11:38:13'),
(215, 'en', 'Your Password', 'Your Password', '2020-11-02 11:38:13', '2020-11-02 11:38:13'),
(216, 'en', 'New Password', 'New Password', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(217, 'en', 'Confirm Password', 'Confirm Password', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(218, 'en', 'Add New Address', 'Add New Address', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(219, 'en', 'Payment Setting', 'Payment Setting', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(220, 'en', 'Cash Payment', 'Cash Payment', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(221, 'en', 'Bank Payment', 'Bank Payment', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(222, 'en', 'Bank Name', 'Bank Name', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(223, 'en', 'Bank Account Name', 'Bank Account Name', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(224, 'en', 'Bank Account Number', 'Bank Account Number', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(225, 'en', 'Bank Routing Number', 'Bank Routing Number', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(226, 'en', 'Update Profile', 'Update Profile', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(227, 'en', 'Change your email', 'Change your email', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(228, 'en', 'Your Email', 'Your Email', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(229, 'en', 'Sending Email...', 'Sending Email...', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(230, 'en', 'Verify', 'Verify', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(231, 'en', 'Update Email', 'Update Email', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(232, 'en', 'New Address', 'New Address', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(233, 'en', 'Your Address', 'Your Address', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(234, 'en', 'Country', 'Country', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(235, 'en', 'Select your country', 'Select your country', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(236, 'en', 'City', 'City', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(237, 'en', 'Your City', 'Your City', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(239, 'en', 'Your Postal Code', 'Your Postal Code', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(240, 'en', '+880', '+880', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(241, 'en', 'Save', 'Save', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(242, 'en', 'Received Refund Request', 'Received Refund Request', '2020-11-02 11:56:20', '2020-11-02 11:56:20'),
(244, 'en', 'Delete Confirmation', 'Delete Confirmation', '2020-11-02 11:56:20', '2020-11-02 11:56:20'),
(245, 'en', 'Are you sure to delete this?', 'Are you sure to delete this?', '2020-11-02 11:56:21', '2020-11-02 11:56:21'),
(246, 'en', 'Premium Packages for Sellers', 'Premium Packages for Sellers', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(247, 'en', 'Product Upload', 'Product Upload', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(248, 'en', 'Digital Product Upload', 'Digital Product Upload', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(250, 'en', 'Purchase Package', 'Purchase Package', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(251, 'en', 'Select Payment Type', 'Select Payment Type', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(252, 'en', 'Payment Type', 'Payment Type', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(253, 'en', 'Select One', 'Select One', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(254, 'en', 'Online payment', 'Online payment', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(255, 'en', 'Offline payment', 'Offline payment', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(256, 'en', 'Purchase Your Package', 'Purchase Your Package', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(258, 'en', 'Paypal', 'Paypal', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(259, 'en', 'Stripe', 'Stripe', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(260, 'en', 'sslcommerz', 'sslcommerz', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(265, 'en', 'Confirm', 'Confirm', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(266, 'en', 'Offline Package Payment', 'Offline Package Payment', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(267, 'en', 'Transaction ID', 'Transaction ID', '2020-11-02 12:30:12', '2020-11-02 12:30:12'),
(268, 'en', 'Choose image', 'Choose image', '2020-11-02 12:30:12', '2020-11-02 12:30:12'),
(269, 'en', 'Code', 'Code', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(270, 'en', 'Delivery Status', 'Delivery Status', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(271, 'en', 'Payment Status', 'Payment Status', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(272, 'en', 'Paid', 'Paid', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(273, 'en', 'Order Details', 'Order Details', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(274, 'en', 'Download Invoice', 'Download Invoice', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(275, 'en', 'Unpaid', 'Unpaid', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(277, 'en', 'Order placed', 'Order placed', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(278, 'en', 'Confirmed', 'Confirmed', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(279, 'en', 'On delivery', 'On delivery', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(280, 'en', 'Delivered', 'Delivered', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(281, 'en', 'Order Summary', 'Order Summary', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(282, 'en', 'Order Code', 'Order Code', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(283, 'en', 'Customer', 'Customer', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(287, 'en', 'Total order amount', 'Total order amount', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(288, 'en', 'Shipping metdod', 'Shipping metdod', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(289, 'en', 'Flat shipping rate', 'Flat shipping rate', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(290, 'en', 'Payment metdod', 'Payment metdod', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(291, 'en', 'Variation', 'Variation', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(292, 'en', 'Delivery Type', 'Delivery Type', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(293, 'en', 'Home Delivery', 'Home Delivery', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(294, 'en', 'Order Ammount', 'Order Ammount', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(295, 'en', 'Subtotal', 'Subtotal', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(296, 'en', 'Shipping', 'Shipping', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(298, 'en', 'Coupon Discount', 'Coupon Discount', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(300, 'en', 'N/A', 'N/A', '2020-11-02 12:44:20', '2020-11-02 12:44:20'),
(301, 'en', 'In stock', 'In stock', '2020-11-02 12:54:52', '2020-11-02 12:54:52'),
(302, 'en', 'Buy Now', 'Buy Now', '2020-11-02 12:54:52', '2020-11-02 12:54:52'),
(303, 'en', 'Item added to your cart!', 'Item added to your cart!', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(304, 'en', 'Proceed to Checkout', 'Proceed to Checkout', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(305, 'en', 'Cart Items', 'Cart Items', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(306, 'en', '1. My Cart', '1. My Cart', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(307, 'en', 'View cart', 'View cart', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(308, 'en', '2. Shipping info', '2. Shipping info', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(309, 'en', 'Checkout', 'Checkout', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(310, 'en', '3. Delivery info', '3. Delivery info', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(311, 'en', '4. Payment', '4. Payment', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(312, 'en', '5. Confirmation', '5. Confirmation', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(313, 'en', 'Remove', 'Remove', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(314, 'en', 'Return to shop', 'Return to shop', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(315, 'en', 'Continue to Shipping', 'Continue to Shipping', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(316, 'en', 'Or', 'Or', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(317, 'en', 'Guest Checkout', 'Guest Checkout', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(318, 'en', 'Continue to Delivery Info', 'Continue to Delivery Info', '2020-11-02 12:57:44', '2020-11-02 12:57:44'),
(319, 'en', 'Postal Code', 'Postal Code', '2020-11-02 13:01:01', '2020-11-02 13:01:01'),
(320, 'en', 'Choose Delivery Type', 'Choose Delivery Type', '2020-11-02 13:01:04', '2020-11-02 13:01:04'),
(321, 'en', 'Local Pickup', 'Local Pickup', '2020-11-02 13:01:04', '2020-11-02 13:01:04'),
(322, 'en', 'Select your nearest pickup point', 'Select your nearest pickup point', '2020-11-02 13:01:04', '2020-11-02 13:01:04'),
(323, 'en', 'Continue to Payment', 'Continue to Payment', '2020-11-02 13:01:04', '2020-11-02 13:01:04'),
(324, 'en', 'Select a payment option', 'Select a payment option', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(325, 'en', 'Razorpay', 'Razorpay', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(326, 'en', 'Paystack', 'Paystack', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(327, 'en', 'VoguePay', 'VoguePay', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(328, 'en', 'payhere', 'payhere', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(329, 'en', 'ngenius', 'ngenius', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(330, 'en', 'Paytm', 'Paytm', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(331, 'en', 'Cash on Delivery', 'Cash on Delivery', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(332, 'en', 'Your wallet balance :', 'Your wallet balance :', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(333, 'en', 'Insufficient balance', 'Insufficient balance', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(334, 'en', 'I agree to the', 'I agree to the', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(338, 'en', 'Complete Order', 'Complete Order', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(339, 'en', 'Summary', 'Summary', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(340, 'en', 'Items', 'Items', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(341, 'en', 'Total Club point', 'Total Club point', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(342, 'en', 'Total Shipping', 'Total Shipping', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(343, 'en', 'Have coupon code? Enter here', 'Have coupon code? Enter here', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(344, 'en', 'Apply', 'Apply', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(345, 'en', 'You need to agree with our policies', 'You need to agree with our policies', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(346, 'en', 'Forgot password', 'Forgot password', '2020-11-02 13:01:25', '2020-11-02 13:01:25'),
(469, 'en', 'SEO Setting', 'SEO Setting', '2020-11-02 13:01:33', '2020-11-02 13:01:33'),
(474, 'en', 'System Update', 'System Update', '2020-11-02 13:01:34', '2020-11-02 13:01:34'),
(480, 'en', 'Add New Payment Method', 'Add New Payment Method', '2020-11-02 13:01:38', '2020-11-02 13:01:38'),
(481, 'en', 'Manual Payment Method', 'Manual Payment Method', '2020-11-02 13:01:38', '2020-11-02 13:01:38'),
(482, 'en', 'Heading', 'Heading', '2020-11-02 13:01:38', '2020-11-02 13:01:38'),
(483, 'en', 'Logo', 'Logo', '2020-11-02 13:01:38', '2020-11-02 13:01:38'),
(484, 'en', 'Manual Payment Information', 'Manual Payment Information', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(485, 'en', 'Type', 'Type', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(486, 'en', 'Custom Payment', 'Custom Payment', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(487, 'en', 'Check Payment', 'Check Payment', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(488, 'en', 'Checkout Thumbnail', 'Checkout Thumbnail', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(489, 'en', 'Payment Instruction', 'Payment Instruction', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(490, 'en', 'Bank Information', 'Bank Information', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(491, 'en', 'Select File', 'Select File', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(492, 'en', 'Upload New', 'Upload New', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(493, 'en', 'Sort by newest', 'Sort by newest', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(494, 'en', 'Sort by oldest', 'Sort by oldest', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(495, 'en', 'Sort by smallest', 'Sort by smallest', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(496, 'en', 'Sort by largest', 'Sort by largest', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(497, 'en', 'Selected Only', 'Selected Only', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(498, 'en', 'No files found', 'No files found', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(499, 'en', '0 File selected', '0 File selected', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(500, 'en', 'Clear', 'Clear', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(501, 'en', 'Prev', 'Prev', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(502, 'en', 'Next', 'Next', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(503, 'en', 'Add Files', 'Add Files', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(504, 'en', 'Method has been inserted successfully', 'Method has been inserted successfully', '2020-11-02 13:02:03', '2020-11-02 13:02:03'),
(506, 'en', 'Order Date', 'Order Date', '2020-11-02 13:02:42', '2020-11-02 13:02:42'),
(507, 'en', 'Bill to', 'Bill to', '2020-11-02 13:02:42', '2020-11-02 13:02:42'),
(510, 'en', 'Sub Total', 'Sub Total', '2020-11-02 13:02:42', '2020-11-02 13:02:42'),
(512, 'en', 'Total Tax', 'Total Tax', '2020-11-02 13:02:42', '2020-11-02 13:02:42'),
(513, 'en', 'Grand Total', 'Grand Total', '2020-11-02 13:02:42', '2020-11-02 13:02:42'),
(514, 'en', 'Your order has been placed successfully. Please submit payment information from purchase history', 'Your order has been placed successfully. Please submit payment information from purchase history', '2020-11-02 13:02:47', '2020-11-02 13:02:47'),
(515, 'en', 'Thank You for Your Order!', 'Thank You for Your Order!', '2020-11-02 13:02:48', '2020-11-02 13:02:48'),
(516, 'en', 'Order Code:', 'Order Code:', '2020-11-02 13:02:48', '2020-11-02 13:02:48'),
(517, 'en', 'A copy or your order summary has been sent to', 'A copy or your order summary has been sent to', '2020-11-02 13:02:48', '2020-11-02 13:02:48'),
(518, 'en', 'Make Payment', 'Make Payment', '2020-11-02 13:03:26', '2020-11-02 13:03:26'),
(519, 'en', 'Payment screenshot', 'Payment screenshot', '2020-11-02 13:03:29', '2020-11-02 13:03:29'),
(520, 'en', 'Paypal Credential', 'Paypal Credential', '2020-11-02 13:12:20', '2020-11-02 13:12:20'),
(522, 'en', 'Paypal Client ID', 'Paypal Client ID', '2020-11-02 13:12:20', '2020-11-02 13:12:20'),
(523, 'en', 'Paypal Client Secret', 'Paypal Client Secret', '2020-11-02 13:12:20', '2020-11-02 13:12:20'),
(524, 'en', 'Paypal Sandbox Mode', 'Paypal Sandbox Mode', '2020-11-02 13:12:20', '2020-11-02 13:12:20'),
(525, 'en', 'Sslcommerz Credential', 'Sslcommerz Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(526, 'en', 'Sslcz Store Id', 'Sslcz Store Id', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(527, 'en', 'Sslcz store password', 'Sslcz store password', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(528, 'en', 'Sslcommerz Sandbox Mode', 'Sslcommerz Sandbox Mode', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(529, 'en', 'Stripe Credential', 'Stripe Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(531, 'en', 'STRIPE KEY', 'STRIPE KEY', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(533, 'en', 'STRIPE SECRET', 'STRIPE SECRET', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(534, 'en', 'RazorPay Credential', 'RazorPay Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(535, 'en', 'RAZOR KEY', 'RAZOR KEY', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(536, 'en', 'RAZOR SECRET', 'RAZOR SECRET', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(537, 'en', 'Instamojo Credential', 'Instamojo Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(538, 'en', 'API KEY', 'API KEY', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(539, 'en', 'IM API KEY', 'IM API KEY', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(540, 'en', 'AUTH TOKEN', 'AUTH TOKEN', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(541, 'en', 'IM AUTH TOKEN', 'IM AUTH TOKEN', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(542, 'en', 'Instamojo Sandbox Mode', 'Instamojo Sandbox Mode', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(543, 'en', 'PayStack Credential', 'PayStack Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(544, 'en', 'PUBLIC KEY', 'PUBLIC KEY', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(545, 'en', 'SECRET KEY', 'SECRET KEY', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(546, 'en', 'MERCHANT EMAIL', 'MERCHANT EMAIL', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(547, 'en', 'VoguePay Credential', 'VoguePay Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(548, 'en', 'MERCHANT ID', 'MERCHANT ID', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(549, 'en', 'Sandbox Mode', 'Sandbox Mode', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(550, 'en', 'Payhere Credential', 'Payhere Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(551, 'en', 'PAYHERE MERCHANT ID', 'PAYHERE MERCHANT ID', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(552, 'en', 'PAYHERE SECRET', 'PAYHERE SECRET', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(553, 'en', 'PAYHERE CURRENCY', 'PAYHERE CURRENCY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(554, 'en', 'Payhere Sandbox Mode', 'Payhere Sandbox Mode', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(555, 'en', 'Ngenius Credential', 'Ngenius Credential', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(556, 'en', 'NGENIUS OUTLET ID', 'NGENIUS OUTLET ID', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(557, 'en', 'NGENIUS API KEY', 'NGENIUS API KEY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(558, 'en', 'NGENIUS CURRENCY', 'NGENIUS CURRENCY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(559, 'en', 'Mpesa Credential', 'Mpesa Credential', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(560, 'en', 'MPESA CONSUMER KEY', 'MPESA CONSUMER KEY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(561, 'en', 'MPESA_CONSUMER_KEY', 'MPESA_CONSUMER_KEY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(562, 'en', 'MPESA CONSUMER SECRET', 'MPESA CONSUMER SECRET', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(563, 'en', 'MPESA_CONSUMER_SECRET', 'MPESA_CONSUMER_SECRET', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(564, 'en', 'MPESA SHORT CODE', 'MPESA SHORT CODE', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(565, 'en', 'MPESA_SHORT_CODE', 'MPESA_SHORT_CODE', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(566, 'en', 'MPESA SANDBOX ACTIVATION', 'MPESA SANDBOX ACTIVATION', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(567, 'en', 'Flutterwave Credential', 'Flutterwave Credential', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(568, 'en', 'RAVE_PUBLIC_KEY', 'RAVE_PUBLIC_KEY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(569, 'en', 'RAVE_SECRET_KEY', 'RAVE_SECRET_KEY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(570, 'en', 'RAVE_TITLE', 'RAVE_TITLE', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(571, 'en', 'STAGIN ACTIVATION', 'STAGIN ACTIVATION', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(573, 'en', 'All Product', 'All Product', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(574, 'en', 'Sort By', 'Sort By', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(575, 'en', 'Rating (High > Low)', 'Rating (High > Low)', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(576, 'en', 'Rating (Low > High)', 'Rating (Low > High)', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(577, 'en', 'Num of Sale (High > Low)', 'Num of Sale (High > Low)', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(578, 'en', 'Num of Sale (Low > High)', 'Num of Sale (Low > High)', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(579, 'en', 'Base Price (High > Low)', 'Base Price (High > Low)', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(580, 'en', 'Base Price (Low > High)', 'Base Price (Low > High)', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(581, 'en', 'Type & Enter', 'Type & Enter', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(582, 'en', 'Added By', 'Added By', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(583, 'en', 'Num of Sale', 'Num of Sale', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(584, 'en', 'Total Stock', 'Total Stock', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(585, 'en', 'Todays Deal', 'Todays Deal', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(586, 'en', 'Rating', 'Rating', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(587, 'en', 'times', 'times', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(588, 'en', 'Add Nerw Product', 'Add Nerw Product', '2020-11-02 13:15:02', '2020-11-02 13:15:02'),
(589, 'en', 'Product Information', 'Product Information', '2020-11-02 13:15:02', '2020-11-02 13:15:02'),
(590, 'en', 'Unit', 'Unit', '2020-11-02 13:15:02', '2020-11-02 13:15:02'),
(591, 'en', 'Unit (e.g. KG, Pc etc)', 'Unit (e.g. KG, Pc etc)', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(592, 'en', 'Minimum Qty', 'Minimum Qty', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(593, 'en', 'Tags', 'Tags', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(594, 'en', 'Type and hit enter to add a tag', 'Type and hit enter to add a tag', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(595, 'en', 'Barcode', 'Barcode', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(596, 'en', 'Refundable', 'Refundable', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(597, 'en', 'Product Images', 'Product Images', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(598, 'en', 'Gallery Images', 'Gallery Images', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(599, 'en', 'Todays Deal updated successfully', 'Todays Deal updated successfully', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(600, 'en', 'Published products updated successfully', 'Published products updated successfully', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(601, 'en', 'Thumbnail Image', 'Thumbnail Image', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(602, 'en', 'Featured products updated successfully', 'Featured products updated successfully', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(603, 'en', 'Product Videos', 'Product Videos', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(604, 'en', 'Video Provider', 'Video Provider', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(605, 'en', 'Youtube', 'Youtube', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(606, 'en', 'Dailymotion', 'Dailymotion', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(607, 'en', 'Vimeo', 'Vimeo', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(608, 'en', 'Video Link', 'Video Link', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(609, 'en', 'Product Variation', 'Product Variation', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(610, 'en', 'Colors', 'Colors', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(611, 'en', 'Attributes', 'Attributes', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(612, 'en', 'Choose Attributes', 'Choose Attributes', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(613, 'en', 'Choose the attributes of this product and then input values of each attribute', 'Choose the attributes of this product and then input values of each attribute', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(614, 'en', 'Product price + stock', 'Product price + stock', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(616, 'en', 'Unit price', 'Unit price', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(617, 'en', 'Purchase price', 'Purchase price', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(618, 'en', 'Flat', 'Flat', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(619, 'en', 'Percent', 'Percent', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(620, 'en', 'Discount', 'Discount', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(621, 'en', 'Product Description', 'Product Description', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(622, 'en', 'Product Shipping Cost', 'Product Shipping Cost', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(623, 'en', 'Free Shipping', 'Free Shipping', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(624, 'en', 'Flat Rate', 'Flat Rate', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(625, 'en', 'Shipping cost', 'Shipping cost', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(626, 'en', 'PDF Specification', 'PDF Specification', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(627, 'en', 'SEO Meta Tags', 'SEO Meta Tags', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(628, 'en', 'Meta Title', 'Meta Title', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(629, 'en', 'Meta Image', 'Meta Image', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(630, 'en', 'Choice Title', 'Choice Title', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(631, 'en', 'Enter choice values', 'Enter choice values', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(632, 'en', 'All categories', 'All categories', '2020-11-03 07:12:19', '2020-11-03 07:12:19'),
(633, 'en', 'Add New category', 'Add New category', '2020-11-03 07:12:19', '2020-11-03 07:12:19'),
(634, 'en', 'Type name & Enter', 'Type name & Enter', '2020-11-03 07:12:19', '2020-11-03 07:12:19'),
(635, 'en', 'Banner', 'Banner', '2020-11-03 07:12:19', '2020-11-03 07:12:19'),
(637, 'en', 'Commission', 'Commission', '2020-11-03 07:12:19', '2020-11-03 07:12:19'),
(638, 'en', 'icon', 'icon', '2020-11-03 07:12:19', '2020-11-03 07:12:19'),
(639, 'en', 'Featured categories updated successfully', 'Featured categories updated successfully', '2020-11-03 07:12:20', '2020-11-03 07:12:20'),
(640, 'en', 'Hot', 'Hot', '2020-11-03 07:13:12', '2020-11-03 07:13:12'),
(641, 'en', 'Filter by Payment Status', 'Filter by Payment Status', '2020-11-03 07:15:15', '2020-11-03 07:15:15'),
(642, 'en', 'Un-Paid', 'Un-Paid', '2020-11-03 07:15:15', '2020-11-03 07:15:15'),
(643, 'en', 'Filter by Deliver Status', 'Filter by Deliver Status', '2020-11-03 07:15:15', '2020-11-03 07:15:15'),
(644, 'en', 'Pending', 'Pending', '2020-11-03 07:15:15', '2020-11-03 07:15:15'),
(645, 'en', 'Type Order code & hit Enter', 'Type Order code & hit Enter', '2020-11-03 07:15:15', '2020-11-03 07:15:15'),
(646, 'en', 'Num. of Products', 'Num. of Products', '2020-11-03 07:15:15', '2020-11-03 07:15:15'),
(647, 'en', 'Walk In Customer', 'Walk In Customer', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(648, 'en', 'QTY', 'QTY', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(649, 'en', 'Without Shipping Charge', 'Without Shipping Charge', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(650, 'en', 'With Shipping Charge', 'With Shipping Charge', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(651, 'en', 'Pay With Cash', 'Pay With Cash', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(652, 'en', 'Shipping Address', 'Shipping Address', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(653, 'en', 'Close', 'Close', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(654, 'en', 'Select country', 'Select country', '2020-11-03 10:03:21', '2020-11-03 10:03:21'),
(655, 'en', 'Order Confirmation', 'Order Confirmation', '2020-11-03 10:03:21', '2020-11-03 10:03:21'),
(656, 'en', 'Are you sure to confirm this order?', 'Are you sure to confirm this order?', '2020-11-03 10:03:21', '2020-11-03 10:03:21'),
(657, 'en', 'Comfirm Order', 'Comfirm Order', '2020-11-03 10:03:21', '2020-11-03 10:03:21'),
(659, 'en', 'Personal Info', 'Personal Info', '2020-11-03 11:38:15', '2020-11-03 11:38:15'),
(660, 'en', 'Repeat Password', 'Repeat Password', '2020-11-03 11:38:15', '2020-11-03 11:38:15'),
(661, 'en', 'Shop Name', 'Shop Name', '2020-11-03 11:38:15', '2020-11-03 11:38:15'),
(662, 'en', 'Register Your Shop', 'Register Your Shop', '2020-11-03 11:38:15', '2020-11-03 11:38:15'),
(663, 'en', 'Affiliate Informations', 'Affiliate Informations', '2020-11-03 11:39:06', '2020-11-03 11:39:06'),
(664, 'en', 'Affiliate', 'Affiliate', '2020-11-03 11:39:06', '2020-11-03 11:39:06'),
(665, 'en', 'User Info', 'User Info', '2020-11-03 11:39:06', '2020-11-03 11:39:06'),
(667, 'en', 'Installed Addon', 'Installed Addon', '2020-11-03 11:48:13', '2020-11-03 11:48:13'),
(668, 'en', 'Available Addon', 'Available Addon', '2020-11-03 11:48:13', '2020-11-03 11:48:13'),
(669, 'en', 'Install New Addon', 'Install New Addon', '2020-11-03 11:48:13', '2020-11-03 11:48:13'),
(670, 'en', 'Version', 'Version', '2020-11-03 11:48:13', '2020-11-03 11:48:13'),
(671, 'en', 'Activated', 'Activated', '2020-11-03 11:48:13', '2020-11-03 11:48:13'),
(672, 'en', 'Deactivated', 'Deactivated', '2020-11-03 11:48:13', '2020-11-03 11:48:13'),
(673, 'en', 'Activate OTP', 'Activate OTP', '2020-11-03 11:48:20', '2020-11-03 11:48:20'),
(674, 'en', 'OTP will be Used For', 'OTP will be Used For', '2020-11-03 11:48:20', '2020-11-03 11:48:20'),
(675, 'en', 'Settings updated successfully', 'Settings updated successfully', '2020-11-03 11:48:20', '2020-11-03 11:48:20'),
(676, 'en', 'Product Owner', 'Product Owner', '2020-11-03 11:48:46', '2020-11-03 11:48:46'),
(677, 'en', 'Point', 'Point', '2020-11-03 11:48:46', '2020-11-03 11:48:46'),
(678, 'en', 'Set Point for Product Within a Range', 'Set Point for Product Within a Range', '2020-11-03 11:48:47', '2020-11-03 11:48:47'),
(679, 'en', 'Set Point for multiple products', 'Set Point for multiple products', '2020-11-03 11:48:47', '2020-11-03 11:48:47'),
(680, 'en', 'Min Price', 'Min Price', '2020-11-03 11:48:47', '2020-11-03 11:48:47'),
(681, 'en', 'Max Price', 'Max Price', '2020-11-03 11:48:47', '2020-11-03 11:48:47'),
(682, 'en', 'Set Point for all Products', 'Set Point for all Products', '2020-11-03 11:48:47', '2020-11-03 11:48:47'),
(683, 'en', 'Set Point For ', 'Set Point For ', '2020-11-03 11:48:47', '2020-11-03 11:48:47'),
(684, 'en', 'Convert Status', 'Convert Status', '2020-11-03 11:48:58', '2020-11-03 11:48:58'),
(685, 'en', 'Earned At', 'Earned At', '2020-11-03 11:48:59', '2020-11-03 11:48:59'),
(686, 'en', 'Seller Based Selling Report', 'Seller Based Selling Report', '2020-11-03 11:49:35', '2020-11-03 11:49:35'),
(687, 'en', 'Sort by verificarion status', 'Sort by verificarion status', '2020-11-03 11:49:35', '2020-11-03 11:49:35'),
(688, 'en', 'Approved', 'Approved', '2020-11-03 11:49:35', '2020-11-03 11:49:35'),
(689, 'en', 'Non Approved', 'Non Approved', '2020-11-03 11:49:35', '2020-11-03 11:49:35'),
(690, 'en', 'Filter', 'Filter', '2020-11-03 11:49:35', '2020-11-03 11:49:35'),
(691, 'en', 'Seller Name', 'Seller Name', '2020-11-03 11:49:35', '2020-11-03 11:49:35'),
(692, 'en', 'Number of Product Sale', 'Number of Product Sale', '2020-11-03 11:49:36', '2020-11-03 11:49:36'),
(693, 'en', 'Order Amount', 'Order Amount', '2020-11-03 11:49:36', '2020-11-03 11:49:36'),
(694, 'en', 'Facebook Chat Setting', 'Facebook Chat Setting', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(695, 'en', 'Facebook Page ID', 'Facebook Page ID', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(696, 'en', 'Please be carefull when you are configuring Facebook chat. For incorrect configuration you will not get messenger icon on your user-end site.', 'Please be carefull when you are configuring Facebook chat. For incorrect configuration you will not get messenger icon on your user-end site.', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(697, 'en', 'Login into your facebook page', 'Login into your facebook page', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(698, 'en', 'Find the About option of your facebook page', 'Find the About option of your facebook page', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(699, 'en', 'At the very bottom, you can find the \\“Facebook Page ID\\”', 'At the very bottom, you can find the \\“Facebook Page ID\\”', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(700, 'en', 'Go to Settings of your page and find the option of \\\"Advance Messaging\\\"', 'Go to Settings of your page and find the option of \\\"Advance Messaging\\\"', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(701, 'en', 'Scroll down that page and you will get \\\"white listed domain\\\"', 'Scroll down that page and you will get \\\"white listed domain\\\"', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(702, 'en', 'Set your website domain name', 'Set your website domain name', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(703, 'en', 'Google reCAPTCHA Setting', 'Google reCAPTCHA Setting', '2020-11-03 11:51:25', '2020-11-03 11:51:25'),
(704, 'en', 'Site KEY', 'Site KEY', '2020-11-03 11:51:25', '2020-11-03 11:51:25'),
(705, 'en', 'Select Shipping Method', 'Select Shipping Method', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(706, 'en', 'Product Wise Shipping Cost', 'Product Wise Shipping Cost', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(707, 'en', 'Flat Rate Shipping Cost', 'Flat Rate Shipping Cost', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(708, 'en', 'Seller Wise Flat Shipping Cost', 'Seller Wise Flat Shipping Cost', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(709, 'en', 'Note', 'Note', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(710, 'en', 'Product Wise Shipping Cost calulation: Shipping cost is calculate by addition of each product shipping cost', 'Product Wise Shipping Cost calulation: Shipping cost is calculate by addition of each product shipping cost', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(711, 'en', 'Flat Rate Shipping Cost calulation: How many products a customer purchase, doesn\'t matter. Shipping cost is fixed', 'Flat Rate Shipping Cost calulation: How many products a customer purchase, doesn\'t matter. Shipping cost is fixed', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(712, 'en', 'Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If a customer purchase 2 product from two seller shipping cost is calculate by addition of each seller flat shipping cost', 'Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If a customer purchase 2 product from two seller shipping cost is calculate by addition of each seller flat shipping cost', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(713, 'en', 'Flat Rate Cost', 'Flat Rate Cost', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(714, 'en', 'Shipping Cost for Admin Products', 'Shipping Cost for Admin Products', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(715, 'en', 'Countries', 'Countries', '2020-11-03 11:52:02', '2020-11-03 11:52:02'),
(716, 'en', 'Show/Hide', 'Show/Hide', '2020-11-03 11:52:02', '2020-11-03 11:52:02'),
(717, 'en', 'Country status updated successfully', 'Country status updated successfully', '2020-11-03 11:52:02', '2020-11-03 11:52:02'),
(718, 'en', 'All Subcategories', 'All Subcategories', '2020-11-03 12:27:55', '2020-11-03 12:27:55'),
(719, 'en', 'Add New Subcategory', 'Add New Subcategory', '2020-11-03 12:27:55', '2020-11-03 12:27:55'),
(720, 'en', 'Sub-Categories', 'Sub-Categories', '2020-11-03 12:27:55', '2020-11-03 12:27:55'),
(721, 'en', 'Sub Category Information', 'Sub Category Information', '2020-11-03 12:28:07', '2020-11-03 12:28:07'),
(723, 'en', 'Slug', 'Slug', '2020-11-03 12:28:07', '2020-11-03 12:28:07'),
(724, 'en', 'All Sub Subcategories', 'All Sub Subcategories', '2020-11-03 12:29:12', '2020-11-03 12:29:12'),
(725, 'en', 'Add New Sub Subcategory', 'Add New Sub Subcategory', '2020-11-03 12:29:12', '2020-11-03 12:29:12'),
(726, 'en', 'Sub-Sub-categories', 'Sub-Sub-categories', '2020-11-03 12:29:12', '2020-11-03 12:29:12'),
(727, 'en', 'Make This Default', 'Make This Default', '2020-11-04 08:24:24', '2020-11-04 08:24:24');
INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(728, 'en', 'Shops', 'Shops', '2020-11-04 11:17:10', '2020-11-04 11:17:10'),
(729, 'en', 'Women Clothing & Fashion', 'Women Clothing & Fashion', '2020-11-04 11:23:12', '2020-11-04 11:23:12'),
(730, 'en', 'Cellphones & Tabs', 'Cellphones & Tabs', '2020-11-04 12:10:41', '2020-11-04 12:10:41'),
(731, 'en', 'Welcome to', 'Welcome to', '2020-11-07 07:14:43', '2020-11-07 07:14:43'),
(732, 'en', 'Create a New Account', 'Create a New Account', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(733, 'en', 'Full Name', 'Full Name', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(734, 'en', 'password', 'password', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(735, 'en', 'Confrim Password', 'Confrim Password', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(736, 'en', 'I agree with the', 'I agree with the', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(737, 'en', 'Terms and Conditions', 'Terms and Conditions', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(738, 'en', 'Register', 'Register', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(739, 'en', 'Already have an account', 'Already have an account', '2020-11-07 07:32:16', '2020-11-07 07:32:16'),
(741, 'en', 'Sign Up with', 'Sign Up with', '2020-11-07 07:32:16', '2020-11-07 07:32:16'),
(742, 'en', 'I agree with the Terms and Conditions', 'I agree with the Terms and Conditions', '2020-11-07 07:34:49', '2020-11-07 07:34:49'),
(745, 'en', 'All Role', 'All Role', '2020-11-07 07:44:28', '2020-11-07 07:44:28'),
(746, 'en', 'Add New Role', 'Add New Role', '2020-11-07 07:44:28', '2020-11-07 07:44:28'),
(747, 'en', 'Roles', 'Roles', '2020-11-07 07:44:28', '2020-11-07 07:44:28'),
(749, 'en', 'Add New Staffs', 'Add New Staffs', '2020-11-07 07:44:36', '2020-11-07 07:44:36'),
(750, 'en', 'Role', 'Role', '2020-11-07 07:44:36', '2020-11-07 07:44:36'),
(751, 'en', 'Frontend Website Name', 'Frontend Website Name', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(752, 'en', 'Website Name', 'Website Name', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(753, 'en', 'Site Motto', 'Site Motto', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(754, 'en', 'Best eCommerce Website', 'Best eCommerce Website', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(755, 'en', 'Site Icon', 'Site Icon', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(756, 'en', 'Website favicon. 32x32 .png', 'Website favicon. 32x32 .png', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(757, 'en', 'Website Base Color', 'Website Base Color', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(758, 'en', 'Hex Color Code', 'Hex Color Code', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(759, 'en', 'Website Base Hover Color', 'Website Base Hover Color', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(760, 'en', 'Update', 'Update', '2020-11-07 07:45:00', '2020-11-07 07:45:00'),
(761, 'en', 'Global Seo', 'Global Seo', '2020-11-07 07:45:00', '2020-11-07 07:45:00'),
(762, 'en', 'Meta description', 'Meta description', '2020-11-07 07:45:00', '2020-11-07 07:45:00'),
(763, 'en', 'Keywords', 'Keywords', '2020-11-07 07:45:00', '2020-11-07 07:45:00'),
(764, 'en', 'Separate with coma', 'Separate with coma', '2020-11-07 07:45:00', '2020-11-07 07:45:00'),
(765, 'en', 'Website Pages', 'Website Pages', '2020-11-07 07:49:04', '2020-11-07 07:49:04'),
(766, 'en', 'All Pages', 'All Pages', '2020-11-07 07:49:04', '2020-11-07 07:49:04'),
(767, 'en', 'Add New Page', 'Add New Page', '2020-11-07 07:49:04', '2020-11-07 07:49:04'),
(768, 'en', 'URL', 'URL', '2020-11-07 07:49:04', '2020-11-07 07:49:04'),
(769, 'en', 'Actions', 'Actions', '2020-11-07 07:49:04', '2020-11-07 07:49:04'),
(770, 'en', 'Edit Page Information', 'Edit Page Information', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(771, 'en', 'Page Content', 'Page Content', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(772, 'en', 'Title', 'Title', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(773, 'en', 'Link', 'Link', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(774, 'en', 'Use character, number, hypen only', 'Use character, number, hypen only', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(775, 'en', 'Add Content', 'Add Content', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(776, 'en', 'Seo Fields', 'Seo Fields', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(777, 'en', 'Update Page', 'Update Page', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(778, 'en', 'Default Language', 'Default Language', '2020-11-07 07:50:09', '2020-11-07 07:50:09'),
(779, 'en', 'Add New Language', 'Add New Language', '2020-11-07 07:50:09', '2020-11-07 07:50:09'),
(780, 'en', 'RTL', 'RTL', '2020-11-07 07:50:09', '2020-11-07 07:50:09'),
(781, 'en', 'Translation', 'Translation', '2020-11-07 07:50:09', '2020-11-07 07:50:09'),
(782, 'en', 'Language Information', 'Language Information', '2020-11-07 07:50:23', '2020-11-07 07:50:23'),
(783, 'en', 'Save Page', 'Save Page', '2020-11-07 07:51:27', '2020-11-07 07:51:27'),
(784, 'en', 'Home Page Settings', 'Home Page Settings', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(785, 'en', 'Home Slider', 'Home Slider', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(786, 'en', 'Photos & Links', 'Photos & Links', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(787, 'en', 'Add New', 'Add New', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(788, 'en', 'Home Categories', 'Home Categories', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(789, 'en', 'Home Banner 1 (Max 3)', 'Home Banner 1 (Max 3)', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(790, 'en', 'Banner & Links', 'Banner & Links', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(791, 'en', 'Home Banner 2 (Max 3)', 'Home Banner 2 (Max 3)', '2020-11-07 07:51:36', '2020-11-07 07:51:36'),
(792, 'en', 'Top 10', 'Top 10', '2020-11-07 07:51:36', '2020-11-07 07:51:36'),
(793, 'en', 'Top Categories (Max 10)', 'Top Categories (Max 10)', '2020-11-07 07:51:36', '2020-11-07 07:51:36'),
(794, 'en', 'Top Brands (Max 10)', 'Top Brands (Max 10)', '2020-11-07 07:51:36', '2020-11-07 07:51:36'),
(795, 'en', 'System Name', 'System Name', '2020-11-07 07:54:22', '2020-11-07 07:54:22'),
(796, 'en', 'System Logo - White', 'System Logo - White', '2020-11-07 07:54:22', '2020-11-07 07:54:22'),
(797, 'en', 'Choose Files', 'Choose Files', '2020-11-07 07:54:22', '2020-11-07 07:54:22'),
(798, 'en', 'Will be used in admin panel side menu', 'Will be used in admin panel side menu', '2020-11-07 07:54:23', '2020-11-07 07:54:23'),
(799, 'en', 'System Logo - Black', 'System Logo - Black', '2020-11-07 07:54:23', '2020-11-07 07:54:23'),
(800, 'en', 'Will be used in admin panel topbar in mobile + Admin login page', 'Will be used in admin panel topbar in mobile + Admin login page', '2020-11-07 07:54:23', '2020-11-07 07:54:23'),
(801, 'en', 'System Timezone', 'System Timezone', '2020-11-07 07:54:23', '2020-11-07 07:54:23'),
(802, 'en', 'Admin login page background', 'Admin login page background', '2020-11-07 07:54:23', '2020-11-07 07:54:23'),
(803, 'en', 'Website Header', 'Website Header', '2020-11-07 08:21:36', '2020-11-07 08:21:36'),
(804, 'en', 'Header Setting', 'Header Setting', '2020-11-07 08:21:36', '2020-11-07 08:21:36'),
(805, 'en', 'Header Logo', 'Header Logo', '2020-11-07 08:21:36', '2020-11-07 08:21:36'),
(806, 'en', 'Show Language Switcher?', 'Show Language Switcher?', '2020-11-07 08:21:36', '2020-11-07 08:21:36'),
(807, 'en', 'Show Currency Switcher?', 'Show Currency Switcher?', '2020-11-07 08:21:36', '2020-11-07 08:21:36'),
(808, 'en', 'Enable stikcy header?', 'Enable stikcy header?', '2020-11-07 08:21:36', '2020-11-07 08:21:36'),
(809, 'en', 'Website Footer', 'Website Footer', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(810, 'en', 'Footer Widget', 'Footer Widget', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(811, 'en', 'About Widget', 'About Widget', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(812, 'en', 'Footer Logo', 'Footer Logo', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(813, 'en', 'About description', 'About description', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(814, 'en', 'Contact Info Widget', 'Contact Info Widget', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(815, 'en', 'Footer contact address', 'Footer contact address', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(816, 'en', 'Footer contact phone', 'Footer contact phone', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(817, 'en', 'Footer contact email', 'Footer contact email', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(818, 'en', 'Link Widget One', 'Link Widget One', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(819, 'en', 'Links', 'Links', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(820, 'en', 'Footer Bottom', 'Footer Bottom', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(821, 'en', 'Copyright Widget ', 'Copyright Widget ', '2020-11-07 08:21:57', '2020-11-07 08:21:57'),
(822, 'en', 'Copyright Text', 'Copyright Text', '2020-11-07 08:21:57', '2020-11-07 08:21:57'),
(823, 'en', 'Social Link Widget ', 'Social Link Widget ', '2020-11-07 08:21:57', '2020-11-07 08:21:57'),
(824, 'en', 'Show Social Links?', 'Show Social Links?', '2020-11-07 08:21:57', '2020-11-07 08:21:57'),
(825, 'en', 'Social Links', 'Social Links', '2020-11-07 08:21:57', '2020-11-07 08:21:57'),
(826, 'en', 'Payment Methods Widget ', 'Payment Methods Widget ', '2020-11-07 08:21:57', '2020-11-07 08:21:57'),
(827, 'en', 'RTL status updated successfully', 'RTL status updated successfully', '2020-11-07 08:36:11', '2020-11-07 08:36:11'),
(828, 'en', 'Language changed to ', 'Language changed to ', '2020-11-07 08:36:27', '2020-11-07 08:36:27'),
(829, 'en', 'Inhouse Product sale report', 'Inhouse Product sale report', '2020-11-07 09:30:25', '2020-11-07 09:30:25'),
(830, 'en', 'Sort by Category', 'Sort by Category', '2020-11-07 09:30:25', '2020-11-07 09:30:25'),
(831, 'en', 'Product wise stock report', 'Product wise stock report', '2020-11-07 09:31:02', '2020-11-07 09:31:02'),
(832, 'en', 'Currency changed to ', 'Currency changed to ', '2020-11-07 12:36:28', '2020-11-07 12:36:28'),
(833, 'en', 'Avatar', 'Avatar', '2020-11-08 09:32:35', '2020-11-08 09:32:35'),
(834, 'en', 'Copy', 'Copy', '2020-11-08 10:03:42', '2020-11-08 10:03:42'),
(835, 'en', 'Variant', 'Variant', '2020-11-08 10:43:02', '2020-11-08 10:43:02'),
(836, 'en', 'Variant Price', 'Variant Price', '2020-11-08 10:43:03', '2020-11-08 10:43:03'),
(837, 'en', 'SKU', 'SKU', '2020-11-08 10:43:03', '2020-11-08 10:43:03'),
(838, 'en', 'Key', 'Key', '2020-11-08 12:35:09', '2020-11-08 12:35:09'),
(839, 'en', 'Value', 'Value', '2020-11-08 12:35:09', '2020-11-08 12:35:09'),
(840, 'en', 'Copy Translations', 'Copy Translations', '2020-11-08 12:35:10', '2020-11-08 12:35:10'),
(841, 'en', 'All Pick-up Points', 'All Pick-up Points', '2020-11-08 12:35:43', '2020-11-08 12:35:43'),
(842, 'en', 'Add New Pick-up Point', 'Add New Pick-up Point', '2020-11-08 12:35:43', '2020-11-08 12:35:43'),
(843, 'en', 'Manager', 'Manager', '2020-11-08 12:35:43', '2020-11-08 12:35:43'),
(844, 'en', 'Location', 'Location', '2020-11-08 12:35:43', '2020-11-08 12:35:43'),
(845, 'en', 'Pickup Station Contact', 'Pickup Station Contact', '2020-11-08 12:35:43', '2020-11-08 12:35:43'),
(846, 'en', 'Open', 'Open', '2020-11-08 12:35:43', '2020-11-08 12:35:43'),
(847, 'en', 'POS Activation for Seller', 'POS Activation for Seller', '2020-11-08 12:35:55', '2020-11-08 12:35:55'),
(848, 'en', 'Order Completed Successfully.', 'Order Completed Successfully.', '2020-11-08 12:36:02', '2020-11-08 12:36:02'),
(849, 'en', 'Text Input', 'Text Input', '2020-11-08 12:38:40', '2020-11-08 12:38:40'),
(850, 'en', 'Select', 'Select', '2020-11-08 12:38:40', '2020-11-08 12:38:40'),
(851, 'en', 'Multiple Select', 'Multiple Select', '2020-11-08 12:38:40', '2020-11-08 12:38:40'),
(852, 'en', 'Radio', 'Radio', '2020-11-08 12:38:40', '2020-11-08 12:38:40'),
(853, 'en', 'File', 'File', '2020-11-08 12:38:40', '2020-11-08 12:38:40'),
(854, 'en', 'Email Address', 'Email Address', '2020-11-08 12:39:32', '2020-11-08 12:39:32'),
(855, 'en', 'Verification Info', 'Verification Info', '2020-11-08 12:39:32', '2020-11-08 12:39:32'),
(856, 'en', 'Approval', 'Approval', '2020-11-08 12:39:32', '2020-11-08 12:39:32'),
(857, 'en', 'Due Amount', 'Due Amount', '2020-11-08 12:39:32', '2020-11-08 12:39:32'),
(858, 'en', 'Show', 'Show', '2020-11-08 12:39:32', '2020-11-08 12:39:32'),
(859, 'en', 'Pay Now', 'Pay Now', '2020-11-08 12:39:32', '2020-11-08 12:39:32'),
(860, 'en', 'Affiliate User Verification', 'Affiliate User Verification', '2020-11-08 12:40:01', '2020-11-08 12:40:01'),
(861, 'en', 'Reject', 'Reject', '2020-11-08 12:40:01', '2020-11-08 12:40:01'),
(862, 'en', 'Accept', 'Accept', '2020-11-08 12:40:01', '2020-11-08 12:40:01'),
(863, 'en', 'Beauty, Health & Hair', 'Beauty, Health & Hair', '2020-11-08 12:54:17', '2020-11-08 12:54:17'),
(864, 'en', 'Comparison', 'Comparison', '2020-11-08 12:54:33', '2020-11-08 12:54:33'),
(865, 'en', 'Reset Compare List', 'Reset Compare List', '2020-11-08 12:54:33', '2020-11-08 12:54:33'),
(866, 'en', 'Your comparison list is empty', 'Your comparison list is empty', '2020-11-08 12:54:33', '2020-11-08 12:54:33'),
(867, 'en', 'Convert Point To Wallet', 'Convert Point To Wallet', '2020-11-08 13:04:42', '2020-11-08 13:04:42'),
(868, 'en', 'Note: You need to activate wallet option first before using club point addon.', 'Note: You need to activate wallet option first before using club point addon.', '2020-11-08 13:04:43', '2020-11-08 13:04:43'),
(869, 'en', 'Create an account.', 'Create an account.', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(870, 'en', 'Use Email Instead', 'Use Email Instead', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(871, 'en', 'By signing up you agree to our terms and conditions.', 'By signing up you agree to our terms and conditions.', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(872, 'en', 'Create Account', 'Create Account', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(873, 'en', 'Or Join With', 'Or Join With', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(874, 'en', 'Already have an account?', 'Already have an account?', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(875, 'en', 'Log In', 'Log In', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(876, 'en', 'Computer & Accessories', 'Computer & Accessories', '2020-11-09 07:52:05', '2020-11-09 07:52:05'),
(878, 'en', 'Product(s)', 'Product(s)', '2020-11-09 07:52:23', '2020-11-09 07:52:23'),
(879, 'en', 'in your cart', 'in your cart', '2020-11-09 07:52:23', '2020-11-09 07:52:23'),
(880, 'en', 'in your wishlist', 'in your wishlist', '2020-11-09 07:52:23', '2020-11-09 07:52:23'),
(881, 'en', 'you ordered', 'you ordered', '2020-11-09 07:52:24', '2020-11-09 07:52:24'),
(882, 'en', 'Default Shipping Address', 'Default Shipping Address', '2020-11-09 07:52:24', '2020-11-09 07:52:24'),
(883, 'en', 'Sports & outdoor', 'Sports & outdoor', '2020-11-09 07:53:32', '2020-11-09 07:53:32'),
(884, 'en', 'Copied', 'Copied', '2020-11-09 07:54:19', '2020-11-09 07:54:19'),
(885, 'en', 'Copy the Promote Link', 'Copy the Promote Link', '2020-11-09 07:54:19', '2020-11-09 07:54:19'),
(886, 'en', 'Write a review', 'Write a review', '2020-11-09 07:54:20', '2020-11-09 07:54:20'),
(887, 'en', 'Your name', 'Your name', '2020-11-09 07:54:20', '2020-11-09 07:54:20'),
(888, 'en', 'Comment', 'Comment', '2020-11-09 07:54:20', '2020-11-09 07:54:20'),
(889, 'en', 'Your review', 'Your review', '2020-11-09 07:54:20', '2020-11-09 07:54:20'),
(890, 'en', 'Submit review', 'Submit review', '2020-11-09 07:54:20', '2020-11-09 07:54:20'),
(891, 'en', 'Claire Willis', 'Claire Willis', '2020-11-09 08:05:00', '2020-11-09 08:05:00'),
(892, 'en', 'Germaine Greene', 'Germaine Greene', '2020-11-09 08:05:00', '2020-11-09 08:05:00'),
(893, 'en', 'Product File', 'Product File', '2020-11-09 08:07:08', '2020-11-09 08:07:08'),
(894, 'en', 'Choose file', 'Choose file', '2020-11-09 08:07:08', '2020-11-09 08:07:08'),
(895, 'en', 'Type to add a tag', 'Type to add a tag', '2020-11-09 08:07:08', '2020-11-09 08:07:08'),
(896, 'en', 'Images', 'Images', '2020-11-09 08:07:08', '2020-11-09 08:07:08'),
(897, 'en', 'Main Images', 'Main Images', '2020-11-09 08:07:08', '2020-11-09 08:07:08'),
(898, 'en', 'Meta Tags', 'Meta Tags', '2020-11-09 08:07:08', '2020-11-09 08:07:08'),
(899, 'en', 'Digital Product has been inserted successfully', 'Digital Product has been inserted successfully', '2020-11-09 08:14:25', '2020-11-09 08:14:25'),
(900, 'en', 'Edit Digital Product', 'Edit Digital Product', '2020-11-09 08:14:34', '2020-11-09 08:14:34'),
(901, 'en', 'Select an option', 'Select an option', '2020-11-09 08:14:34', '2020-11-09 08:14:34'),
(902, 'en', 'tax', 'tax', '2020-11-09 08:14:35', '2020-11-09 08:14:35'),
(903, 'en', 'Any question about this product?', 'Any question about this product?', '2020-11-09 08:15:11', '2020-11-09 08:15:11'),
(904, 'en', 'Sign in', 'Sign in', '2020-11-09 08:15:11', '2020-11-09 08:15:11'),
(905, 'en', 'Login with Google', 'Login with Google', '2020-11-09 08:15:11', '2020-11-09 08:15:11'),
(906, 'en', 'Login with Facebook', 'Login with Facebook', '2020-11-09 08:15:11', '2020-11-09 08:15:11'),
(907, 'en', 'Login with Twitter', 'Login with Twitter', '2020-11-09 08:15:11', '2020-11-09 08:15:11'),
(908, 'en', 'Click to show phone number', 'Click to show phone number', '2020-11-09 08:15:51', '2020-11-09 08:15:51'),
(909, 'en', 'Other Ads of', 'Other Ads of', '2020-11-09 08:15:52', '2020-11-09 08:15:52'),
(910, 'en', 'Store Home', 'Store Home', '2020-11-09 08:54:23', '2020-11-09 08:54:23'),
(911, 'en', 'Top Selling', 'Top Selling', '2020-11-09 08:54:23', '2020-11-09 08:54:23'),
(912, 'en', 'Shop Settings', 'Shop Settings', '2020-11-09 08:55:38', '2020-11-09 08:55:38'),
(913, 'en', 'Visit Shop', 'Visit Shop', '2020-11-09 08:55:38', '2020-11-09 08:55:38'),
(914, 'en', 'Pickup Points', 'Pickup Points', '2020-11-09 08:55:38', '2020-11-09 08:55:38'),
(915, 'en', 'Select Pickup Point', 'Select Pickup Point', '2020-11-09 08:55:38', '2020-11-09 08:55:38'),
(916, 'en', 'Slider Settings', 'Slider Settings', '2020-11-09 08:55:39', '2020-11-09 08:55:39'),
(917, 'en', 'Social Media Link', 'Social Media Link', '2020-11-09 08:55:39', '2020-11-09 08:55:39'),
(918, 'en', 'Facebook', 'Facebook', '2020-11-09 08:55:39', '2020-11-09 08:55:39'),
(919, 'en', 'Twitter', 'Twitter', '2020-11-09 08:55:39', '2020-11-09 08:55:39'),
(920, 'en', 'Google', 'Google', '2020-11-09 08:55:39', '2020-11-09 08:55:39'),
(921, 'en', 'New Arrival Products', 'New Arrival Products', '2020-11-09 08:56:26', '2020-11-09 08:56:26'),
(922, 'en', 'Check Your Order Status', 'Check Your Order Status', '2020-11-09 09:23:32', '2020-11-09 09:23:32'),
(923, 'en', 'Shipping method', 'Shipping method', '2020-11-09 09:27:40', '2020-11-09 09:27:40'),
(924, 'en', 'Shipped By', 'Shipped By', '2020-11-09 09:27:41', '2020-11-09 09:27:41'),
(925, 'en', 'Image', 'Image', '2020-11-09 09:29:37', '2020-11-09 09:29:37'),
(926, 'en', 'Sub Sub Category', 'Sub Sub Category', '2020-11-09 09:29:37', '2020-11-09 09:29:37'),
(927, 'en', 'Inhouse Products', 'Inhouse Products', '2020-11-09 10:22:32', '2020-11-09 10:22:32'),
(928, 'en', 'Forgot Password?', 'Forgot Password?', '2020-11-09 10:33:21', '2020-11-09 10:33:21'),
(929, 'en', 'Enter your email address to recover your password.', 'Enter your email address to recover your password.', '2020-11-09 10:33:21', '2020-11-09 10:33:21'),
(930, 'en', 'Email or Phone', 'Email or Phone', '2020-11-09 10:33:21', '2020-11-09 10:33:21'),
(931, 'en', 'Send Password Reset Link', 'Send Password Reset Link', '2020-11-09 10:33:21', '2020-11-09 10:33:21'),
(932, 'en', 'Back to Login', 'Back to Login', '2020-11-09 10:33:21', '2020-11-09 10:33:21'),
(933, 'en', 'index', 'index', '2020-11-09 10:35:29', '2020-11-09 10:35:29'),
(934, 'en', 'Download Your Product', 'Download Your Product', '2020-11-09 10:35:30', '2020-11-09 10:35:30'),
(935, 'en', 'Option', 'Option', '2020-11-09 10:35:30', '2020-11-09 10:35:30'),
(936, 'en', 'Applied Refund Request', 'Applied Refund Request', '2020-11-09 10:35:39', '2020-11-09 10:35:39'),
(937, 'en', 'Item has been renoved from wishlist', 'Item has been renoved from wishlist', '2020-11-09 10:36:04', '2020-11-09 10:36:04'),
(938, 'en', 'Bulk Products Upload', 'Bulk Products Upload', '2020-11-09 10:39:24', '2020-11-09 10:39:24'),
(939, 'en', 'Upload CSV', 'Upload CSV', '2020-11-09 10:39:25', '2020-11-09 10:39:25'),
(940, 'en', 'Create a Ticket', 'Create a Ticket', '2020-11-09 10:40:25', '2020-11-09 10:40:25'),
(941, 'en', 'Tickets', 'Tickets', '2020-11-09 10:40:25', '2020-11-09 10:40:25'),
(942, 'en', 'Ticket ID', 'Ticket ID', '2020-11-09 10:40:25', '2020-11-09 10:40:25'),
(943, 'en', 'Sending Date', 'Sending Date', '2020-11-09 10:40:25', '2020-11-09 10:40:25'),
(944, 'en', 'Subject', 'Subject', '2020-11-09 10:40:25', '2020-11-09 10:40:25'),
(945, 'en', 'View Details', 'View Details', '2020-11-09 10:40:25', '2020-11-09 10:40:25'),
(946, 'en', 'Provide a detailed description', 'Provide a detailed description', '2020-11-09 10:40:26', '2020-11-09 10:40:26'),
(947, 'en', 'Type your reply', 'Type your reply', '2020-11-09 10:40:26', '2020-11-09 10:40:26'),
(948, 'en', 'Send Ticket', 'Send Ticket', '2020-11-09 10:40:26', '2020-11-09 10:40:26'),
(949, 'en', 'Load More', 'Load More', '2020-11-09 10:40:57', '2020-11-09 10:40:57'),
(950, 'en', 'Jewelry & Watches', 'Jewelry & Watches', '2020-11-09 10:47:38', '2020-11-09 10:47:38'),
(951, 'en', 'Filters', 'Filters', '2020-11-09 10:53:54', '2020-11-09 10:53:54'),
(952, 'en', 'Contact address', 'Contact address', '2020-11-09 10:58:46', '2020-11-09 10:58:46'),
(953, 'en', 'Contact phone', 'Contact phone', '2020-11-09 10:58:47', '2020-11-09 10:58:47'),
(954, 'en', 'Contact email', 'Contact email', '2020-11-09 10:58:47', '2020-11-09 10:58:47'),
(955, 'en', 'Filter by', 'Filter by', '2020-11-09 11:00:03', '2020-11-09 11:00:03'),
(956, 'en', 'Condition', 'Condition', '2020-11-09 11:56:13', '2020-11-09 11:56:13'),
(957, 'en', 'All Type', 'All Type', '2020-11-09 11:56:13', '2020-11-09 11:56:13'),
(960, 'en', 'Pay with wallet', 'Pay with wallet', '2020-11-09 12:56:34', '2020-11-09 12:56:34'),
(961, 'en', 'Select variation', 'Select variation', '2020-11-10 07:54:29', '2020-11-10 07:54:29'),
(962, 'en', 'No Product Added', 'No Product Added', '2020-11-10 08:07:53', '2020-11-10 08:07:53'),
(963, 'en', 'Status has been updated successfully', 'Status has been updated successfully', '2020-11-10 08:41:23', '2020-11-10 08:41:23'),
(964, 'en', 'All Seller Packages', 'All Seller Packages', '2020-11-10 09:14:10', '2020-11-10 09:14:10'),
(965, 'en', 'Add New Package', 'Add New Package', '2020-11-10 09:14:10', '2020-11-10 09:14:10'),
(966, 'en', 'Package Logo', 'Package Logo', '2020-11-10 09:14:10', '2020-11-10 09:14:10'),
(967, 'en', 'days', 'days', '2020-11-10 09:14:10', '2020-11-10 09:14:10'),
(968, 'en', 'Create New Seller Package', 'Create New Seller Package', '2020-11-10 09:14:31', '2020-11-10 09:14:31'),
(969, 'en', 'Package Name', 'Package Name', '2020-11-10 09:14:31', '2020-11-10 09:14:31'),
(970, 'en', 'Duration', 'Duration', '2020-11-10 09:14:31', '2020-11-10 09:14:31'),
(971, 'en', 'Validity in number of days', 'Validity in number of days', '2020-11-10 09:14:31', '2020-11-10 09:14:31'),
(972, 'en', 'Update Package Information', 'Update Package Information', '2020-11-10 09:14:59', '2020-11-10 09:14:59'),
(973, 'en', 'Package has been inserted successfully', 'Package has been inserted successfully', '2020-11-10 09:15:14', '2020-11-10 09:15:14'),
(974, 'en', 'Refund Request', 'Refund Request', '2020-11-10 09:17:25', '2020-11-10 09:17:25'),
(975, 'en', 'Reason', 'Reason', '2020-11-10 09:17:25', '2020-11-10 09:17:25'),
(976, 'en', 'Label', 'Label', '2020-11-10 09:20:13', '2020-11-10 09:20:13'),
(977, 'en', 'Select Label', 'Select Label', '2020-11-10 09:20:13', '2020-11-10 09:20:13'),
(978, 'en', 'Multiple Select Label', 'Multiple Select Label', '2020-11-10 09:20:13', '2020-11-10 09:20:13'),
(979, 'en', 'Radio Label', 'Radio Label', '2020-11-10 09:20:13', '2020-11-10 09:20:13'),
(980, 'en', 'Pickup Point Orders', 'Pickup Point Orders', '2020-11-10 09:25:40', '2020-11-10 09:25:40'),
(981, 'en', 'View', 'View', '2020-11-10 09:25:40', '2020-11-10 09:25:40'),
(982, 'en', 'Order #', 'Order #', '2020-11-10 09:25:48', '2020-11-10 09:25:48'),
(983, 'en', 'Order Status', 'Order Status', '2020-11-10 09:25:48', '2020-11-10 09:25:48'),
(984, 'en', 'Total amount', 'Total amount', '2020-11-10 09:25:48', '2020-11-10 09:25:48'),
(986, 'en', 'TOTAL', 'TOTAL', '2020-11-10 09:25:49', '2020-11-10 09:25:49'),
(987, 'en', 'Delivery status has been updated', 'Delivery status has been updated', '2020-11-10 09:25:49', '2020-11-10 09:25:49'),
(988, 'en', 'Payment status has been updated', 'Payment status has been updated', '2020-11-10 09:25:49', '2020-11-10 09:25:49'),
(989, 'en', 'INVOICE', 'INVOICE', '2020-11-10 09:25:58', '2020-11-10 09:25:58'),
(990, 'en', 'Set Refund Time', 'Set Refund Time', '2020-11-10 09:34:04', '2020-11-10 09:34:04'),
(991, 'en', 'Set Time for sending Refund Request', 'Set Time for sending Refund Request', '2020-11-10 09:34:04', '2020-11-10 09:34:04'),
(992, 'en', 'Set Refund Sticker', 'Set Refund Sticker', '2020-11-10 09:34:05', '2020-11-10 09:34:05'),
(993, 'en', 'Sticker', 'Sticker', '2020-11-10 09:34:05', '2020-11-10 09:34:05'),
(994, 'en', 'Refund Request All', 'Refund Request All', '2020-11-10 09:34:12', '2020-11-10 09:34:12'),
(995, 'en', 'Order Id', 'Order Id', '2020-11-10 09:34:12', '2020-11-10 09:34:12'),
(996, 'en', 'Seller Approval', 'Seller Approval', '2020-11-10 09:34:12', '2020-11-10 09:34:12'),
(997, 'en', 'Admin Approval', 'Admin Approval', '2020-11-10 09:34:12', '2020-11-10 09:34:12'),
(998, 'en', 'Refund Status', 'Refund Status', '2020-11-10 09:34:12', '2020-11-10 09:34:12'),
(1000, 'en', 'No Refund', 'No Refund', '2020-11-10 09:35:27', '2020-11-10 09:35:27'),
(1001, 'en', 'Status updated successfully', 'Status updated successfully', '2020-11-10 09:54:20', '2020-11-10 09:54:20'),
(1002, 'en', 'User Search Report', 'User Search Report', '2020-11-11 06:43:24', '2020-11-11 06:43:24'),
(1003, 'en', 'Search By', 'Search By', '2020-11-11 06:43:24', '2020-11-11 06:43:24'),
(1004, 'en', 'Number searches', 'Number searches', '2020-11-11 06:43:24', '2020-11-11 06:43:24'),
(1005, 'en', 'Sender', 'Sender', '2020-11-11 06:51:49', '2020-11-11 06:51:49'),
(1006, 'en', 'Receiver', 'Receiver', '2020-11-11 06:51:49', '2020-11-11 06:51:49'),
(1007, 'en', 'Verification form updated successfully', 'Verification form updated successfully', '2020-11-11 06:53:29', '2020-11-11 06:53:29'),
(1008, 'en', 'Invalid email or password', 'Invalid email or password', '2020-11-11 07:07:49', '2020-11-11 07:07:49'),
(1009, 'en', 'All Coupons', 'All Coupons', '2020-11-11 07:14:04', '2020-11-11 07:14:04'),
(1010, 'en', 'Add New Coupon', 'Add New Coupon', '2020-11-11 07:14:04', '2020-11-11 07:14:04'),
(1011, 'en', 'Coupon Information', 'Coupon Information', '2020-11-11 07:14:04', '2020-11-11 07:14:04'),
(1012, 'en', 'Start Date', 'Start Date', '2020-11-11 07:14:04', '2020-11-11 07:14:04'),
(1013, 'en', 'End Date', 'End Date', '2020-11-11 07:14:05', '2020-11-11 07:14:05'),
(1014, 'en', 'Product Base', 'Product Base', '2020-11-11 07:14:05', '2020-11-11 07:14:05'),
(1015, 'en', 'Send Newsletter', 'Send Newsletter', '2020-11-11 07:14:10', '2020-11-11 07:14:10'),
(1016, 'en', 'Mobile Users', 'Mobile Users', '2020-11-11 07:14:10', '2020-11-11 07:14:10'),
(1017, 'en', 'SMS subject', 'SMS subject', '2020-11-11 07:14:10', '2020-11-11 07:14:10'),
(1018, 'en', 'SMS content', 'SMS content', '2020-11-11 07:14:10', '2020-11-11 07:14:10'),
(1019, 'en', 'All Flash Delas', 'All Flash Delas', '2020-11-11 07:16:06', '2020-11-11 07:16:06'),
(1020, 'en', 'Create New Flash Dela', 'Create New Flash Dela', '2020-11-11 07:16:06', '2020-11-11 07:16:06'),
(1022, 'en', 'Page Link', 'Page Link', '2020-11-11 07:16:06', '2020-11-11 07:16:06'),
(1023, 'en', 'Flash Deal Information', 'Flash Deal Information', '2020-11-11 07:16:14', '2020-11-11 07:16:14'),
(1024, 'en', 'Background Color', 'Background Color', '2020-11-11 07:16:14', '2020-11-11 07:16:14'),
(1026, 'en', 'Text Color', 'Text Color', '2020-11-11 07:16:14', '2020-11-11 07:16:14'),
(1027, 'en', 'White', 'White', '2020-11-11 07:16:14', '2020-11-11 07:16:14'),
(1028, 'en', 'Dark', 'Dark', '2020-11-11 07:16:15', '2020-11-11 07:16:15'),
(1029, 'en', 'Choose Products', 'Choose Products', '2020-11-11 07:16:15', '2020-11-11 07:16:15'),
(1030, 'en', 'Discounts', 'Discounts', '2020-11-11 07:16:20', '2020-11-11 07:16:20'),
(1031, 'en', 'Discount Type', 'Discount Type', '2020-11-11 07:16:20', '2020-11-11 07:16:20'),
(1032, 'en', 'Twillo Credential', 'Twillo Credential', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1033, 'en', 'TWILIO SID', 'TWILIO SID', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1034, 'en', 'TWILIO AUTH TOKEN', 'TWILIO AUTH TOKEN', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1035, 'en', 'TWILIO VERIFY SID', 'TWILIO VERIFY SID', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1036, 'en', 'VALID TWILLO NUMBER', 'VALID TWILLO NUMBER', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1037, 'en', 'Nexmo Credential', 'Nexmo Credential', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1038, 'en', 'NEXMO KEY', 'NEXMO KEY', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1039, 'en', 'NEXMO SECRET', 'NEXMO SECRET', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1040, 'en', 'SSL Wireless Credential', 'SSL Wireless Credential', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1041, 'en', 'SSL SMS API TOKEN', 'SSL SMS API TOKEN', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1042, 'en', 'SSL SMS SID', 'SSL SMS SID', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1043, 'en', 'SSL SMS URL', 'SSL SMS URL', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1044, 'en', 'Fast2SMS Credential', 'Fast2SMS Credential', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1045, 'en', 'AUTH KEY', 'AUTH KEY', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1046, 'en', 'ROUTE', 'ROUTE', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1047, 'en', 'Promotional Use', 'Promotional Use', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1048, 'en', 'Transactional Use', 'Transactional Use', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1050, 'en', 'SENDER ID', 'SENDER ID', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1051, 'en', 'Nexmo OTP', 'Nexmo OTP', '2020-11-11 07:17:42', '2020-11-11 07:17:42'),
(1052, 'en', 'Twillo OTP', 'Twillo OTP', '2020-11-11 07:17:43', '2020-11-11 07:17:43'),
(1053, 'en', 'SSL Wireless OTP', 'SSL Wireless OTP', '2020-11-11 07:17:43', '2020-11-11 07:17:43'),
(1054, 'en', 'Fast2SMS OTP', 'Fast2SMS OTP', '2020-11-11 07:17:43', '2020-11-11 07:17:43'),
(1055, 'en', 'Order Placement', 'Order Placement', '2020-11-11 07:17:43', '2020-11-11 07:17:43'),
(1056, 'en', 'Delivery Status Changing Time', 'Delivery Status Changing Time', '2020-11-11 07:17:43', '2020-11-11 07:17:43'),
(1057, 'en', 'Paid Status Changing Time', 'Paid Status Changing Time', '2020-11-11 07:17:43', '2020-11-11 07:17:43'),
(1058, 'en', 'Send Bulk SMS', 'Send Bulk SMS', '2020-11-11 07:19:14', '2020-11-11 07:19:14'),
(1059, 'en', 'All Subscribers', 'All Subscribers', '2020-11-11 07:21:51', '2020-11-11 07:21:51'),
(1060, 'en', 'Coupon Information Adding', 'Coupon Information Adding', '2020-11-11 07:22:25', '2020-11-11 07:22:25'),
(1061, 'en', 'Coupon Type', 'Coupon Type', '2020-11-11 07:22:25', '2020-11-11 07:22:25'),
(1062, 'en', 'For Products', 'For Products', '2020-11-11 07:22:25', '2020-11-11 07:22:25'),
(1063, 'en', 'For Total Orders', 'For Total Orders', '2020-11-11 07:22:25', '2020-11-11 07:22:25'),
(1064, 'en', 'Add Your Product Base Coupon', 'Add Your Product Base Coupon', '2020-11-11 07:22:42', '2020-11-11 07:22:42'),
(1065, 'en', 'Coupon code', 'Coupon code', '2020-11-11 07:22:42', '2020-11-11 07:22:42'),
(1066, 'en', 'Sub Category', 'Sub Category', '2020-11-11 07:22:42', '2020-11-11 07:22:42'),
(1067, 'en', 'Add More', 'Add More', '2020-11-11 07:22:43', '2020-11-11 07:22:43'),
(1068, 'en', 'Add Your Cart Base Coupon', 'Add Your Cart Base Coupon', '2020-11-11 07:29:40', '2020-11-11 07:29:40'),
(1069, 'en', 'Minimum Shopping', 'Minimum Shopping', '2020-11-11 07:29:40', '2020-11-11 07:29:40'),
(1070, 'en', 'Maximum Discount Amount', 'Maximum Discount Amount', '2020-11-11 07:29:41', '2020-11-11 07:29:41'),
(1071, 'en', 'Coupon Information Update', 'Coupon Information Update', '2020-11-11 08:18:34', '2020-11-11 08:18:34'),
(1073, 'en', 'Please Configure SMTP Setting to work all email sending funtionality', 'Please Configure SMTP Setting to work all email sending funtionality', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1074, 'en', 'Configure Now', 'Configure Now', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1076, 'en', 'Total published products', 'Total published products', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1077, 'en', 'Total sellers products', 'Total sellers products', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1078, 'en', 'Total admin products', 'Total admin products', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1079, 'en', 'Manage Products', 'Manage Products', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1080, 'en', 'Total product category', 'Total product category', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1081, 'en', 'Create Category', 'Create Category', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1082, 'en', 'Total product sub sub category', 'Total product sub sub category', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1083, 'en', 'Create Sub Sub Category', 'Create Sub Sub Category', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1084, 'en', 'Total product sub category', 'Total product sub category', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1085, 'en', 'Create Sub Category', 'Create Sub Category', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1086, 'en', 'Total product brand', 'Total product brand', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1087, 'en', 'Create Brand', 'Create Brand', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1089, 'en', 'Total sellers', 'Total sellers', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1091, 'en', 'Total approved sellers', 'Total approved sellers', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1093, 'en', 'Total pending sellers', 'Total pending sellers', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1094, 'en', 'Manage Sellers', 'Manage Sellers', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1095, 'en', 'Category wise product sale', 'Category wise product sale', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1097, 'en', 'Sale', 'Sale', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1098, 'en', 'Category wise product stock', 'Category wise product stock', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1099, 'en', 'Category Name', 'Category Name', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1100, 'en', 'Stock', 'Stock', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1101, 'en', 'Frontend', 'Frontend', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1103, 'en', 'Home page', 'Home page', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1104, 'en', 'setting', 'setting', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1106, 'en', 'Policy page', 'Policy page', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1107, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1109, 'en', 'General', 'General', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1110, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1111, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1112, 'en', 'Useful link', 'Useful link', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1113, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1114, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1115, 'en', 'Activation', 'Activation', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1116, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1117, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1118, 'en', 'SMTP', 'SMTP', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1119, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1120, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1121, 'en', 'Payment method', 'Payment method', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1122, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1123, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1124, 'en', 'Social media', 'Social media', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1125, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1126, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1127, 'en', 'Business', 'Business', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1128, 'en', 'setting', 'setting', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1130, 'en', 'setting', 'setting', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1131, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1132, 'en', 'Seller verification', 'Seller verification', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1133, 'en', 'form setting', 'form setting', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1134, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1135, 'en', 'Language', 'Language', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1136, 'en', 'setting', 'setting', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1137, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1139, 'en', 'setting', 'setting', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1140, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1141, 'en', 'Dashboard', 'Dashboard', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1142, 'en', 'POS System', 'POS System', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1143, 'en', 'POS Manager', 'POS Manager', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1144, 'en', 'POS Configuration', 'POS Configuration', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1145, 'en', 'Products', 'Products', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1146, 'en', 'Add New product', 'Add New product', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1147, 'en', 'All Products', 'All Products', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1148, 'en', 'In House Products', 'In House Products', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1149, 'en', 'Seller Products', 'Seller Products', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1150, 'en', 'Digital Products', 'Digital Products', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1151, 'en', 'Bulk Import', 'Bulk Import', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1152, 'en', 'Bulk Export', 'Bulk Export', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1153, 'en', 'Category', 'Category', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1154, 'en', 'Subcategory', 'Subcategory', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1155, 'en', 'Sub Subcategory', 'Sub Subcategory', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1156, 'en', 'Brand', 'Brand', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1157, 'en', 'Attribute', 'Attribute', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1158, 'en', 'Product Reviews', 'Product Reviews', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1159, 'en', 'Sales', 'Sales', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1160, 'en', 'All Orders', 'All Orders', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1161, 'en', 'Inhouse orders', 'Inhouse orders', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1162, 'en', 'Seller Orders', 'Seller Orders', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1163, 'en', 'Pick-up Point Order', 'Pick-up Point Order', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1164, 'en', 'Refunds', 'Refunds', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1165, 'en', 'Refund Requests', 'Refund Requests', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1166, 'en', 'Approved Refund', 'Approved Refund', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1167, 'en', 'Refund Configuration', 'Refund Configuration', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1168, 'en', 'Customers', 'Customers', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1169, 'en', 'Customer list', 'Customer list', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1170, 'en', 'Classified Products', 'Classified Products', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1171, 'en', 'Classified Packages', 'Classified Packages', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1172, 'en', 'Sellers', 'Sellers', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1173, 'en', 'All Seller', 'All Seller', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1174, 'en', 'Payouts', 'Payouts', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1175, 'en', 'Payout Requests', 'Payout Requests', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1176, 'en', 'Seller Commission', 'Seller Commission', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1177, 'en', 'Seller Packages', 'Seller Packages', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1178, 'en', 'Seller Verification Form', 'Seller Verification Form', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1179, 'en', 'Reports', 'Reports', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1180, 'en', 'In House Product Sale', 'In House Product Sale', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1181, 'en', 'Seller Products Sale', 'Seller Products Sale', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1182, 'en', 'Products Stock', 'Products Stock', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1183, 'en', 'Products wishlist', 'Products wishlist', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1184, 'en', 'User Searches', 'User Searches', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1185, 'en', 'Marketing', 'Marketing', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1186, 'en', 'Flash deals', 'Flash deals', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1187, 'en', 'Newsletters', 'Newsletters', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1188, 'en', 'Bulk SMS', 'Bulk SMS', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1189, 'en', 'Subscribers', 'Subscribers', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1190, 'en', 'Coupon', 'Coupon', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1191, 'en', 'Support', 'Support', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1192, 'en', 'Ticket', 'Ticket', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1193, 'en', 'Product Queries', 'Product Queries', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1194, 'en', 'Website Setup', 'Website Setup', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1195, 'en', 'Header', 'Header', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1196, 'en', 'Footer', 'Footer', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1197, 'en', 'Pages', 'Pages', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1198, 'en', 'Appearance', 'Appearance', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1199, 'en', 'Setup & Configurations', 'Setup & Configurations', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1200, 'en', 'General Settings', 'General Settings', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1201, 'en', 'Features activation', 'Features activation', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1202, 'en', 'Languages', 'Languages', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1203, 'en', 'Currency', 'Currency', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1204, 'en', 'Pickup point', 'Pickup point', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1205, 'en', 'SMTP Settings', 'SMTP Settings', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1206, 'en', 'Payment Methods', 'Payment Methods', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1207, 'en', 'File System Configuration', 'File System Configuration', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1208, 'en', 'Social media Logins', 'Social media Logins', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1209, 'en', 'Analytics Tools', 'Analytics Tools', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1210, 'en', 'Facebook Chat', 'Facebook Chat', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1211, 'en', 'Google reCAPTCHA', 'Google reCAPTCHA', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1212, 'en', 'Shipping Configuration', 'Shipping Configuration', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1213, 'en', 'Shipping Countries', 'Shipping Countries', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1214, 'en', 'Affiliate System', 'Affiliate System', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1215, 'en', 'Affiliate Registration Form', 'Affiliate Registration Form', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1216, 'en', 'Affiliate Configurations', 'Affiliate Configurations', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1217, 'en', 'Affiliate Users', 'Affiliate Users', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1218, 'en', 'Referral Users', 'Referral Users', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1219, 'en', 'Affiliate Withdraw Requests', 'Affiliate Withdraw Requests', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1220, 'en', 'Offline Payment System', 'Offline Payment System', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1221, 'en', 'Manual Payment Methods', 'Manual Payment Methods', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1222, 'en', 'Offline Wallet Recharge', 'Offline Wallet Recharge', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1223, 'en', 'Offline Customer Package Payments', 'Offline Customer Package Payments', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1224, 'en', 'Offline Seller Package Payments', 'Offline Seller Package Payments', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1225, 'en', 'Paytm Payment Gateway', 'Paytm Payment Gateway', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1226, 'en', 'Set Paytm Credentials', 'Set Paytm Credentials', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1227, 'en', 'Club Point System', 'Club Point System', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1228, 'en', 'Club Point Configurations', 'Club Point Configurations', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1229, 'en', 'Set Product Point', 'Set Product Point', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1230, 'en', 'User Points', 'User Points', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1231, 'en', 'OTP System', 'OTP System', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1232, 'en', 'OTP Configurations', 'OTP Configurations', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1233, 'en', 'Set OTP Credentials', 'Set OTP Credentials', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1234, 'en', 'Staffs', 'Staffs', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1235, 'en', 'All staffs', 'All staffs', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1236, 'en', 'Staff permissions', 'Staff permissions', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1237, 'en', 'Addon Manager', 'Addon Manager', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1238, 'en', 'Browse Website', 'Browse Website', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1239, 'en', 'POS', 'POS', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1240, 'en', 'Notifications', 'Notifications', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1241, 'en', 'new orders', 'new orders', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1242, 'en', 'user-image', 'user-image', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1243, 'en', 'Profile', 'Profile', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1244, 'en', 'Logout', 'Logout', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1247, 'en', 'Page Not Found!', 'Page Not Found!', '2020-11-11 13:10:28', '2020-11-11 13:10:28'),
(1249, 'en', 'The page you are looking for has not been found on our server.', 'The page you are looking for has not been found on our server.', '2020-11-11 13:10:28', '2020-11-11 13:10:28'),
(1253, 'en', 'Registration', 'Registration', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1255, 'en', 'I am shopping for...', 'I am shopping for...', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1257, 'en', 'Compare', 'Compare', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1259, 'en', 'Wishlist', 'Wishlist', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1261, 'en', 'Cart', 'Cart', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1263, 'en', 'Your Cart is empty', 'Your Cart is empty', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1265, 'en', 'Categories', 'Categories', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1267, 'en', 'See All', 'See All', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1269, 'en', 'Seller Policy', 'Seller Policy', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1271, 'en', 'Return Policy', 'Return Policy', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1273, 'en', 'Support Policy', 'Support Policy', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1275, 'en', 'Privacy Policy', 'Privacy Policy', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1277, 'en', 'Your Email Address', 'Your Email Address', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1279, 'en', 'Subscribe', 'Subscribe', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1281, 'en', 'Contact Info', 'Contact Info', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1283, 'en', 'Address', 'Address', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1285, 'en', 'Phone', 'Phone', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1287, 'en', 'Email', 'Email', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1288, 'en', 'Login', 'Login', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1289, 'en', 'My Account', 'My Account', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1291, 'en', 'Login', 'Login', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1293, 'en', 'Order History', 'Order History', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1295, 'en', 'My Wishlist', 'My Wishlist', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1297, 'en', 'Track Order', 'Track Order', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1299, 'en', 'Be an affiliate partner', 'Be an affiliate partner', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1301, 'en', 'Be a Seller', 'Be a Seller', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1303, 'en', 'Apply Now', 'Apply Now', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1305, 'en', 'Confirmation', 'Confirmation', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1307, 'en', 'Delete confirmation message', 'Delete confirmation message', '2020-11-11 13:10:30', '2020-11-11 13:10:30');
INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(1309, 'en', 'Cancel', 'Cancel', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1312, 'en', 'Delete', 'Delete', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1313, 'en', 'Item has been added to compare list', 'Item has been added to compare list', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1314, 'en', 'Please login first', 'Please login first', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1315, 'en', 'Total Earnings From', 'Total Earnings From', '2020-11-12 08:01:11', '2020-11-12 08:01:11'),
(1316, 'en', 'Client Subscription', 'Client Subscription', '2020-11-12 08:01:12', '2020-11-12 08:01:12'),
(1317, 'en', 'Product category', 'Product category', '2020-11-12 08:03:46', '2020-11-12 08:03:46'),
(1318, 'en', 'Product sub sub category', 'Product sub sub category', '2020-11-12 08:03:46', '2020-11-12 08:03:46'),
(1319, 'en', 'Product sub category', 'Product sub category', '2020-11-12 08:03:46', '2020-11-12 08:03:46'),
(1320, 'en', 'Product brand', 'Product brand', '2020-11-12 08:03:46', '2020-11-12 08:03:46'),
(1321, 'en', 'Top Client Packages', 'Top Client Packages', '2020-11-12 08:05:21', '2020-11-12 08:05:21'),
(1322, 'en', 'Top Freelancer Packages', 'Top Freelancer Packages', '2020-11-12 08:05:21', '2020-11-12 08:05:21'),
(1323, 'en', 'Number of sale', 'Number of sale', '2020-11-12 09:13:09', '2020-11-12 09:13:09'),
(1324, 'en', 'Number of Stock', 'Number of Stock', '2020-11-12 09:16:02', '2020-11-12 09:16:02'),
(1325, 'en', 'Top 10 Products', 'Top 10 Products', '2020-11-12 10:02:29', '2020-11-12 10:02:29'),
(1326, 'en', 'Top 12 Products', 'Top 12 Products', '2020-11-12 10:02:39', '2020-11-12 10:02:39'),
(1327, 'en', 'Admin can not be a seller', 'Admin can not be a seller', '2020-11-12 11:30:19', '2020-11-12 11:30:19'),
(1328, 'en', 'Filter by Rating', 'Filter by Rating', '2020-11-15 08:01:15', '2020-11-15 08:01:15'),
(1329, 'en', 'Published reviews updated successfully', 'Published reviews updated successfully', '2020-11-15 08:01:15', '2020-11-15 08:01:15'),
(1330, 'en', 'Refund Sticker has been updated successfully', 'Refund Sticker has been updated successfully', '2020-11-15 08:17:12', '2020-11-15 08:17:12'),
(1331, 'en', 'Edit Product', 'Edit Product', '2020-11-15 10:31:54', '2020-11-15 10:31:54'),
(1332, 'en', 'Meta Images', 'Meta Images', '2020-11-15 10:32:12', '2020-11-15 10:32:12'),
(1333, 'en', 'Update Product', 'Update Product', '2020-11-15 10:32:12', '2020-11-15 10:32:12'),
(1334, 'en', 'Product has been deleted successfully', 'Product has been deleted successfully', '2020-11-15 10:32:57', '2020-11-15 10:32:57'),
(1335, 'en', 'Your Profile has been updated successfully!', 'Your Profile has been updated successfully!', '2020-11-15 11:10:42', '2020-11-15 11:10:42'),
(1336, 'en', 'Upload limit has been reached. Please upgrade your package.', 'Upload limit has been reached. Please upgrade your package.', '2020-11-15 11:13:45', '2020-11-15 11:13:45'),
(1337, 'en', 'Add Your Product', 'Add Your Product', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1338, 'en', 'Select a category', 'Select a category', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1339, 'en', 'Select a brand', 'Select a brand', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1340, 'en', 'Product Unit', 'Product Unit', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1341, 'en', 'Minimum Qty.', 'Minimum Qty.', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1342, 'en', 'Product Tag', 'Product Tag', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1343, 'en', 'Type & hit enter', 'Type & hit enter', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1344, 'en', 'Videos', 'Videos', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1345, 'en', 'Video From', 'Video From', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1346, 'en', 'Video URL', 'Video URL', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1347, 'en', 'Customer Choice', 'Customer Choice', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1348, 'en', 'PDF', 'PDF', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1349, 'en', 'Choose PDF', 'Choose PDF', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1350, 'en', 'Select Category', 'Select Category', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1351, 'en', 'Target Category', 'Target Category', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1352, 'en', 'subsubcategory', 'subsubcategory', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1353, 'en', 'Search Category', 'Search Category', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1354, 'en', 'Search SubCategory', 'Search SubCategory', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1355, 'en', 'Search SubSubCategory', 'Search SubSubCategory', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1356, 'en', 'Update your product', 'Update your product', '2020-11-15 11:39:14', '2020-11-15 11:39:14'),
(1357, 'en', 'Product has been updated successfully', 'Product has been updated successfully', '2020-11-15 11:51:36', '2020-11-15 11:51:36'),
(1358, 'en', 'Add Your Digital Product', 'Add Your Digital Product', '2020-11-15 12:24:21', '2020-11-15 12:24:21'),
(1359, 'en', 'Active eCommerce CMS Update Process', 'Active eCommerce CMS Update Process', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1361, 'en', 'Codecanyon purchase code', 'Codecanyon purchase code', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1362, 'en', 'Database Name', 'Database Name', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1363, 'en', 'Database Username', 'Database Username', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1364, 'en', 'Database Password', 'Database Password', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1365, 'en', 'Database Hostname', 'Database Hostname', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1366, 'en', 'Update Now', 'Update Now', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1368, 'en', 'Congratulations', 'Congratulations', '2020-11-16 07:55:14', '2020-11-16 07:55:14'),
(1369, 'en', 'You have successfully completed the updating process. Please Login to continue', 'You have successfully completed the updating process. Please Login to continue', '2020-11-16 07:55:14', '2020-11-16 07:55:14'),
(1370, 'en', 'Go to Home', 'Go to Home', '2020-11-16 07:55:14', '2020-11-16 07:55:14'),
(1371, 'en', 'Login to Admin panel', 'Login to Admin panel', '2020-11-16 07:55:14', '2020-11-16 07:55:14'),
(1372, 'en', 'S3 File System Credentials', 'S3 File System Credentials', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1373, 'en', 'AWS_ACCESS_KEY_ID', 'AWS_ACCESS_KEY_ID', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1374, 'en', 'AWS_SECRET_ACCESS_KEY', 'AWS_SECRET_ACCESS_KEY', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1375, 'en', 'AWS_DEFAULT_REGION', 'AWS_DEFAULT_REGION', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1376, 'en', 'AWS_BUCKET', 'AWS_BUCKET', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1377, 'en', 'AWS_URL', 'AWS_URL', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1378, 'en', 'S3 File System Activation', 'S3 File System Activation', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1379, 'en', 'Your phone number', 'Your phone number', '2020-11-17 05:50:10', '2020-11-17 05:50:10'),
(1380, 'en', 'Zip File', 'Zip File', '2020-11-17 06:58:45', '2020-11-17 06:58:45'),
(1381, 'en', 'Install', 'Install', '2020-11-17 06:58:45', '2020-11-17 06:58:45'),
(1382, 'en', 'This version is not capable of installing Addons, Please update.', 'This version is not capable of installing Addons, Please update.', '2020-11-17 06:59:11', '2020-11-17 06:59:11'),
(1383, 'en', 'Browse All Categories', 'Browse All Categories', '2021-02-09 09:01:58', '2021-02-09 09:01:58'),
(1384, 'en', 'Find Our Locations', 'Find Our Locations', '2021-02-09 09:01:58', '2021-02-09 09:01:58'),
(1385, 'en', 'To Get More Emersive', 'To Get More Emersive', '2021-02-09 09:01:58', '2021-02-09 09:01:58'),
(1386, 'en', 'Nothing found', 'Nothing found', '2023-05-24 18:56:02', '2023-05-24 18:56:02'),
(1387, 'en', 'File selected', 'File selected', '2023-05-24 18:56:02', '2023-05-24 18:56:02'),
(1388, 'en', 'Files selected', 'Files selected', '2023-05-24 18:56:02', '2023-05-24 18:56:02'),
(1389, 'en', 'Add more files', 'Add more files', '2023-05-24 18:56:02', '2023-05-24 18:56:02'),
(1390, 'en', 'Adding more files', 'Adding more files', '2023-05-24 18:56:02', '2023-05-24 18:56:02'),
(1391, 'en', 'Drop files here, paste or', 'Drop files here, paste or', '2023-05-24 18:56:02', '2023-05-24 18:56:02'),
(1392, 'en', 'Upload complete', 'Upload complete', '2023-05-24 18:56:02', '2023-05-24 18:56:02'),
(1393, 'en', 'Upload paused', 'Upload paused', '2023-05-24 18:56:02', '2023-05-24 18:56:02'),
(1394, 'en', 'Resume upload', 'Resume upload', '2023-05-24 18:56:02', '2023-05-24 18:56:02'),
(1395, 'en', 'Pause upload', 'Pause upload', '2023-05-24 18:56:02', '2023-05-24 18:56:02'),
(1396, 'en', 'Retry upload', 'Retry upload', '2023-05-24 18:56:02', '2023-05-24 18:56:02'),
(1397, 'en', 'Cancel upload', 'Cancel upload', '2023-05-24 18:56:02', '2023-05-24 18:56:02'),
(1398, 'en', 'Uploading', 'Uploading', '2023-05-24 18:56:03', '2023-05-24 18:56:03'),
(1399, 'en', 'Processing', 'Processing', '2023-05-24 18:56:03', '2023-05-24 18:56:03'),
(1400, 'en', 'Complete', 'Complete', '2023-05-24 18:56:03', '2023-05-24 18:56:03'),
(1401, 'en', 'Files', 'Files', '2023-05-24 18:56:03', '2023-05-24 18:56:03'),
(1402, 'en', 'Blogs', 'Blogs', '2023-05-24 18:56:03', '2023-05-24 18:56:03'),
(1403, 'en', 'View All Sellers', 'View All Sellers', '2023-05-24 18:56:09', '2023-05-24 18:56:09'),
(1404, 'en', 'Use Phone Instead', 'Use Phone Instead', '2023-05-24 18:57:11', '2023-05-24 18:57:11'),
(1405, 'en', 'Registration successfull.', 'Registration successfull.', '2023-05-24 18:57:29', '2023-05-24 18:57:29'),
(1406, 'en', 'Order', 'Order', '2023-05-24 18:59:13', '2023-05-24 18:59:13'),
(1407, 'en', 'Nothing selected', 'Nothing selected', '2023-05-24 18:59:13', '2023-05-24 18:59:13'),
(1408, 'en', 'Search in menu', 'Search in menu', '2023-05-24 18:59:13', '2023-05-24 18:59:13'),
(1409, 'en', 'Earnings', 'Earnings', '2023-05-24 18:59:13', '2023-05-24 18:59:13'),
(1410, 'en', 'Wallet', 'Wallet', '2023-05-24 18:59:13', '2023-05-24 18:59:13'),
(1411, 'en', 'Withdrawal Funds', 'Withdrawal Funds', '2023-05-24 18:59:13', '2023-05-24 18:59:13'),
(1412, 'en', 'Total Earning', 'Total Earning', '2023-05-24 18:59:13', '2023-05-24 18:59:13'),
(1413, 'en', 'Overall Sales', 'Overall Sales', '2023-05-24 18:59:13', '2023-05-24 18:59:13'),
(1414, 'en', 'Open Ticket', 'Open Ticket', '2023-05-24 18:59:13', '2023-05-24 18:59:13'),
(1415, 'en', 'Collaborate with Team', 'Collaborate with Team', '2023-05-24 18:59:13', '2023-05-24 18:59:13'),
(1416, 'en', 'Settings', 'Settings', '2023-05-24 18:59:13', '2023-05-24 18:59:13'),
(1417, 'en', 'Shipping Setting', 'Shipping Setting', '2023-05-24 18:59:13', '2023-05-24 18:59:13'),
(1418, 'en', 'Admin Setting', 'Admin Setting', '2023-05-24 18:59:13', '2023-05-24 18:59:13'),
(1419, 'en', 'Pickup Manager', 'Pickup Manager', '2023-05-24 18:59:14', '2023-05-24 18:59:14'),
(1420, 'en', 'Partner Registration Form', 'Partner Registration Form', '2023-05-24 18:59:14', '2023-05-24 18:59:14'),
(1421, 'en', 'Tracking', 'Tracking', '2023-05-24 18:59:14', '2023-05-24 18:59:14'),
(1422, 'en', 'Report', 'Report', '2023-05-24 18:59:14', '2023-05-24 18:59:14'),
(1423, 'en', 'Feedback', 'Feedback', '2023-05-24 18:59:14', '2023-05-24 18:59:14'),
(1424, 'en', 'Score', 'Score', '2023-05-24 18:59:14', '2023-05-24 18:59:14'),
(1425, 'en', 'Complains', 'Complains', '2023-05-24 18:59:14', '2023-05-24 18:59:14'),
(1426, 'en', 'Uploaded Files', 'Uploaded Files', '2023-05-24 18:59:14', '2023-05-24 18:59:14'),
(1427, 'en', 'Commission History', 'Commission History', '2023-05-24 18:59:14', '2023-05-24 18:59:14'),
(1428, 'en', 'Wallet Recharge History', 'Wallet Recharge History', '2023-05-24 18:59:14', '2023-05-24 18:59:14'),
(1429, 'en', 'Blog System', 'Blog System', '2023-05-24 18:59:14', '2023-05-24 18:59:14'),
(1430, 'en', 'All Posts', 'All Posts', '2023-05-24 18:59:14', '2023-05-24 18:59:14'),
(1431, 'en', 'Custom Email', 'Custom Email', '2023-05-24 18:59:14', '2023-05-24 18:59:14'),
(1432, 'en', 'Vat & TAX', 'Vat & TAX', '2023-05-24 18:59:15', '2023-05-24 18:59:15'),
(1433, 'en', 'Facebook Comment', 'Facebook Comment', '2023-05-24 18:59:15', '2023-05-24 18:59:15'),
(1434, 'en', 'Shipping Settings', 'Shipping Settings', '2023-05-24 18:59:15', '2023-05-24 18:59:15'),
(1435, 'en', 'Shipping Cities', 'Shipping Cities', '2023-05-24 18:59:15', '2023-05-24 18:59:15'),
(1436, 'en', 'Shipping States', 'Shipping States', '2023-05-24 18:59:15', '2023-05-24 18:59:15'),
(1437, 'en', 'System', 'System', '2023-05-24 18:59:15', '2023-05-24 18:59:15'),
(1438, 'en', 'Server status', 'Server status', '2023-05-24 18:59:15', '2023-05-24 18:59:15'),
(1439, 'en', 'Minimum Purchase Qty', 'Minimum Purchase Qty', '2023-05-24 18:59:54', '2023-05-24 18:59:54'),
(1440, 'en', 'This is used for search. Input those words by which cutomer can find this product.', 'This is used for search. Input those words by which cutomer can find this product.', '2023-05-24 18:59:54', '2023-05-24 18:59:54'),
(1441, 'en', 'These images are visible in product details page gallery. Use 600x600 sizes images.', 'These images are visible in product details page gallery. Use 600x600 sizes images.', '2023-05-24 18:59:54', '2023-05-24 18:59:54'),
(1442, 'en', 'This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.', 'This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.', '2023-05-24 18:59:55', '2023-05-24 18:59:55'),
(1443, 'en', 'Use proper link without extra parameter. Don\'t use short share link/embeded iframe code.', 'Use proper link without extra parameter. Don\'t use short share link/embeded iframe code.', '2023-05-24 18:59:55', '2023-05-24 18:59:55'),
(1444, 'en', 'Unit Price Currency', 'Unit Price Currency', '2023-05-24 18:59:55', '2023-05-24 18:59:55'),
(1445, 'en', 'Discount Date Range', 'Discount Date Range', '2023-05-24 18:59:55', '2023-05-24 18:59:55'),
(1446, 'en', 'Is Product Quantity Mulitiply', 'Is Product Quantity Mulitiply', '2023-05-24 18:59:55', '2023-05-24 18:59:55'),
(1447, 'en', 'Low Stock Quantity Warning', 'Low Stock Quantity Warning', '2023-05-24 18:59:55', '2023-05-24 18:59:55'),
(1448, 'en', 'Stock Visibility State', 'Stock Visibility State', '2023-05-24 18:59:55', '2023-05-24 18:59:55'),
(1449, 'en', 'Show Stock Quantity', 'Show Stock Quantity', '2023-05-24 18:59:55', '2023-05-24 18:59:55'),
(1450, 'en', 'Show Stock With Text Only', 'Show Stock With Text Only', '2023-05-24 18:59:55', '2023-05-24 18:59:55'),
(1451, 'en', 'Hide Stock', 'Hide Stock', '2023-05-24 18:59:55', '2023-05-24 18:59:55'),
(1452, 'en', 'Flash Deal', 'Flash Deal', '2023-05-24 18:59:55', '2023-05-24 18:59:55'),
(1453, 'en', 'Add To Flash', 'Add To Flash', '2023-05-24 18:59:55', '2023-05-24 18:59:55'),
(1454, 'en', 'Estimate Shipping Time', 'Estimate Shipping Time', '2023-05-24 18:59:56', '2023-05-24 18:59:56'),
(1455, 'en', 'Shipping Days', 'Shipping Days', '2023-05-24 18:59:56', '2023-05-24 18:59:56'),
(1456, 'en', 'Save As Draft', 'Save As Draft', '2023-05-24 18:59:56', '2023-05-24 18:59:56'),
(1457, 'en', 'Save & Unpublish', 'Save & Unpublish', '2023-05-24 18:59:56', '2023-05-24 18:59:56'),
(1458, 'en', 'Save & Publish', 'Save & Publish', '2023-05-24 18:59:56', '2023-05-24 18:59:56'),
(1459, 'en', 'Topbar Banner', 'Topbar Banner', '2023-05-24 19:01:13', '2023-05-24 19:01:13'),
(1460, 'en', 'Topbar Banner Link', 'Topbar Banner Link', '2023-05-24 19:01:13', '2023-05-24 19:01:13'),
(1461, 'en', 'Link with', 'Link with', '2023-05-24 19:01:13', '2023-05-24 19:01:13'),
(1462, 'en', 'Header Nav Menu', 'Header Nav Menu', '2023-05-24 19:01:13', '2023-05-24 19:01:13'),
(1463, 'en', 'Search your files', 'Search your files', '2023-05-24 19:01:24', '2023-05-24 19:01:24'),
(1464, 'en', 'System Tax', 'System Tax', '2023-05-24 19:02:12', '2023-05-24 19:02:12'),
(1465, 'en', 'HTTPS Activation', 'HTTPS Activation', '2023-05-24 19:02:49', '2023-05-24 19:02:49'),
(1466, 'en', 'Maintenance Mode Activation', 'Maintenance Mode Activation', '2023-05-24 19:02:49', '2023-05-24 19:02:49'),
(1467, 'en', 'Disable image optimization?', 'Disable image optimization?', '2023-05-24 19:02:49', '2023-05-24 19:02:49'),
(1468, 'en', 'Business Related', 'Business Related', '2023-05-24 19:02:49', '2023-05-24 19:02:49'),
(1469, 'en', 'Vendor System Activation', 'Vendor System Activation', '2023-05-24 19:02:49', '2023-05-24 19:02:49'),
(1470, 'en', 'Classified Product', 'Classified Product', '2023-05-24 19:02:49', '2023-05-24 19:02:49'),
(1471, 'en', 'Wallet System Activation', 'Wallet System Activation', '2023-05-24 19:02:49', '2023-05-24 19:02:49'),
(1472, 'en', 'Coupon System Activation', 'Coupon System Activation', '2023-05-24 19:02:49', '2023-05-24 19:02:49'),
(1473, 'en', 'Pickup Point Activation', 'Pickup Point Activation', '2023-05-24 19:02:49', '2023-05-24 19:02:49'),
(1474, 'en', 'Conversation Activation', 'Conversation Activation', '2023-05-24 19:02:49', '2023-05-24 19:02:49'),
(1475, 'en', 'Seller Product Manage By Admin', 'Seller Product Manage By Admin', '2023-05-24 19:02:50', '2023-05-24 19:02:50'),
(1476, 'en', 'After activate this option Cash On Delivery of Seller product will be managed by Admin', 'After activate this option Cash On Delivery of Seller product will be managed by Admin', '2023-05-24 19:02:50', '2023-05-24 19:02:50'),
(1477, 'en', 'Category-based Commission', 'Category-based Commission', '2023-05-24 19:02:50', '2023-05-24 19:02:50'),
(1478, 'en', 'After activate this option Seller commision will be disabled and You need to set commission on each category otherwise Admin will not get any commision', 'After activate this option Seller commision will be disabled and You need to set commission on each category otherwise Admin will not get any commision', '2023-05-24 19:02:50', '2023-05-24 19:02:50'),
(1479, 'en', 'Set Commisssion Now', 'Set Commisssion Now', '2023-05-24 19:02:50', '2023-05-24 19:02:50'),
(1480, 'en', 'Email Verification', 'Email Verification', '2023-05-24 19:02:50', '2023-05-24 19:02:50'),
(1481, 'en', 'Payment Related', 'Payment Related', '2023-05-24 19:02:50', '2023-05-24 19:02:50'),
(1482, 'en', 'Paypal Payment Activation', 'Paypal Payment Activation', '2023-05-24 19:02:50', '2023-05-24 19:02:50'),
(1483, 'en', 'You need to configure Paypal correctly to enable this feature', 'You need to configure Paypal correctly to enable this feature', '2023-05-24 19:02:50', '2023-05-24 19:02:50'),
(1484, 'en', 'Stripe Payment Activation', 'Stripe Payment Activation', '2023-05-24 19:02:50', '2023-05-24 19:02:50'),
(1485, 'en', 'SSlCommerz Activation', 'SSlCommerz Activation', '2023-05-24 19:02:50', '2023-05-24 19:02:50'),
(1486, 'en', 'Instamojo Payment Activation', 'Instamojo Payment Activation', '2023-05-24 19:02:50', '2023-05-24 19:02:50'),
(1487, 'en', 'You need to configure Instamojo Payment correctly to enable this feature', 'You need to configure Instamojo Payment correctly to enable this feature', '2023-05-24 19:02:50', '2023-05-24 19:02:50'),
(1488, 'en', 'Razor Pay Activation', 'Razor Pay Activation', '2023-05-24 19:02:51', '2023-05-24 19:02:51'),
(1489, 'en', 'You need to configure Razor correctly to enable this feature', 'You need to configure Razor correctly to enable this feature', '2023-05-24 19:02:51', '2023-05-24 19:02:51'),
(1490, 'en', 'PayStack Activation', 'PayStack Activation', '2023-05-24 19:02:52', '2023-05-24 19:02:52'),
(1491, 'en', 'You need to configure PayStack correctly to enable this feature', 'You need to configure PayStack correctly to enable this feature', '2023-05-24 19:02:52', '2023-05-24 19:02:52'),
(1492, 'en', 'VoguePay Activation', 'VoguePay Activation', '2023-05-24 19:02:52', '2023-05-24 19:02:52'),
(1493, 'en', 'You need to configure VoguePay correctly to enable this feature', 'You need to configure VoguePay correctly to enable this feature', '2023-05-24 19:02:53', '2023-05-24 19:02:53'),
(1494, 'en', 'Payhere Activation', 'Payhere Activation', '2023-05-24 19:02:53', '2023-05-24 19:02:53'),
(1495, 'en', 'Ngenius Activation', 'Ngenius Activation', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1496, 'en', 'You need to configure Ngenius correctly to enable this feature', 'You need to configure Ngenius correctly to enable this feature', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1497, 'en', 'Iyzico Activation', 'Iyzico Activation', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1498, 'en', 'You need to configure iyzico correctly to enable this feature', 'You need to configure iyzico correctly to enable this feature', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1499, 'en', 'Bkash Activation', 'Bkash Activation', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1500, 'en', 'You need to configure bkash correctly to enable this feature', 'You need to configure bkash correctly to enable this feature', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1501, 'en', 'Nagad Activation', 'Nagad Activation', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1502, 'en', 'You need to configure nagad correctly to enable this feature', 'You need to configure nagad correctly to enable this feature', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1503, 'en', 'Proxy Pay Activation', 'Proxy Pay Activation', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1504, 'en', 'Cash Payment Activation', 'Cash Payment Activation', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1505, 'en', 'Social Media Login', 'Social Media Login', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1506, 'en', 'Facebook login', 'Facebook login', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1507, 'en', 'You need to configure Facebook Client correctly to enable this feature', 'You need to configure Facebook Client correctly to enable this feature', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1508, 'en', 'Google login', 'Google login', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1509, 'en', 'You need to configure Google Client correctly to enable this feature', 'You need to configure Google Client correctly to enable this feature', '2023-05-24 19:02:54', '2023-05-24 19:02:54'),
(1510, 'en', 'Twitter login', 'Twitter login', '2023-05-24 19:02:55', '2023-05-24 19:02:55'),
(1511, 'en', 'You need to configure Twitter Client correctly to enable this feature', 'You need to configure Twitter Client correctly to enable this feature', '2023-05-24 19:02:55', '2023-05-24 19:02:55'),
(1512, 'en', 'Bulk Action', 'Bulk Action', '2023-05-24 20:14:08', '2023-05-24 20:14:08'),
(1513, 'en', 'Delete selection', 'Delete selection', '2023-05-24 20:14:08', '2023-05-24 20:14:08'),
(1514, 'en', 'Info', 'Info', '2023-05-24 20:14:08', '2023-05-24 20:14:08'),
(1515, 'en', 'Approved Status', 'Approved Status', '2023-05-24 20:14:08', '2023-05-24 20:14:08'),
(1516, 'en', 'Approved products updated successfully', 'Approved products updated successfully', '2023-05-24 20:14:08', '2023-05-24 20:14:08'),
(1517, 'en', 'Play Store Link', 'Play Store Link', '2023-05-25 02:18:45', '2023-05-25 02:18:45'),
(1518, 'en', 'App Store Link', 'App Store Link', '2023-05-25 02:18:45', '2023-05-25 02:18:45'),
(1519, 'en', 'Parent Category', 'Parent Category', '2023-05-25 02:49:01', '2023-05-25 02:49:01'),
(1520, 'en', 'Order Level', 'Order Level', '2023-05-25 02:49:01', '2023-05-25 02:49:01'),
(1521, 'en', 'Level', 'Level', '2023-05-25 02:49:01', '2023-05-25 02:49:01'),
(1522, 'en', 'Category Information', 'Category Information', '2023-05-25 02:49:13', '2023-05-25 02:49:13'),
(1523, 'en', 'Translatable', 'Translatable', '2023-05-25 02:49:13', '2023-05-25 02:49:13'),
(1524, 'en', 'No Parent', 'No Parent', '2023-05-25 02:49:13', '2023-05-25 02:49:13'),
(1525, 'en', 'Ordering Number', 'Ordering Number', '2023-05-25 02:49:13', '2023-05-25 02:49:13'),
(1526, 'en', 'Higher number has high priority', 'Higher number has high priority', '2023-05-25 02:49:13', '2023-05-25 02:49:13'),
(1527, 'en', 'Physical', 'Physical', '2023-05-25 02:49:13', '2023-05-25 02:49:13'),
(1528, 'en', 'Digital', 'Digital', '2023-05-25 02:49:13', '2023-05-25 02:49:13'),
(1529, 'en', '200x200', '200x200', '2023-05-25 02:49:13', '2023-05-25 02:49:13'),
(1530, 'en', '32x32', '32x32', '2023-05-25 02:49:13', '2023-05-25 02:49:13'),
(1531, 'en', 'Category has been updated successfully', 'Category has been updated successfully', '2023-05-25 02:53:45', '2023-05-25 02:53:45'),
(1532, 'en', 'Category has been deleted successfully', 'Category has been deleted successfully', '2023-05-25 03:06:55', '2023-05-25 03:06:55'),
(1533, 'en', 'Category has been inserted successfully', 'Category has been inserted successfully', '2023-05-25 03:08:28', '2023-05-25 03:08:28'),
(1534, 'en', 'Add New Brand', 'Add New Brand', '2023-05-25 03:09:33', '2023-05-25 03:09:33'),
(1535, 'en', '120x80', '120x80', '2023-05-25 03:09:33', '2023-05-25 03:09:33'),
(1536, 'en', 'All Colors', 'All Colors', '2023-05-25 03:11:59', '2023-05-25 03:11:59'),
(1537, 'en', 'Add New Color', 'Add New Color', '2023-05-25 03:11:59', '2023-05-25 03:11:59'),
(1538, 'en', 'Color Code', 'Color Code', '2023-05-25 03:11:59', '2023-05-25 03:11:59'),
(1539, 'en', 'All uploaded files', 'All uploaded files', '2023-05-25 03:12:19', '2023-05-25 03:12:19'),
(1540, 'en', 'Upload New File', 'Upload New File', '2023-05-25 03:12:19', '2023-05-25 03:12:19'),
(1541, 'en', 'All files', 'All files', '2023-05-25 03:12:19', '2023-05-25 03:12:19'),
(1542, 'en', 'Search', 'Search', '2023-05-25 03:12:19', '2023-05-25 03:12:19'),
(1543, 'en', 'Details Info', 'Details Info', '2023-05-25 03:12:19', '2023-05-25 03:12:19'),
(1544, 'en', 'Copy Link', 'Copy Link', '2023-05-25 03:12:20', '2023-05-25 03:12:20'),
(1545, 'en', 'Are you sure to delete this file?', 'Are you sure to delete this file?', '2023-05-25 03:12:20', '2023-05-25 03:12:20'),
(1546, 'en', 'File Info', 'File Info', '2023-05-25 03:12:20', '2023-05-25 03:12:20'),
(1547, 'en', 'Link copied to clipboard', 'Link copied to clipboard', '2023-05-25 03:12:20', '2023-05-25 03:12:20'),
(1548, 'en', 'Oops, unable to copy', 'Oops, unable to copy', '2023-05-25 03:12:20', '2023-05-25 03:12:20'),
(1549, 'en', 'Back to uploaded files', 'Back to uploaded files', '2023-05-25 03:12:39', '2023-05-25 03:12:39'),
(1550, 'en', 'Drag & drop your files', 'Drag & drop your files', '2023-05-25 03:12:39', '2023-05-25 03:12:39'),
(1551, 'en', 'Sendmail', 'Sendmail', '2023-05-25 03:17:50', '2023-05-25 03:17:50'),
(1552, 'en', 'Mailgun', 'Mailgun', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1553, 'en', 'MAIL HOST', 'MAIL HOST', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1554, 'en', 'MAIL PORT', 'MAIL PORT', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1555, 'en', 'MAIL USERNAME', 'MAIL USERNAME', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1556, 'en', 'MAIL PASSWORD', 'MAIL PASSWORD', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1557, 'en', 'MAIL ENCRYPTION', 'MAIL ENCRYPTION', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1558, 'en', 'MAIL FROM ADDRESS', 'MAIL FROM ADDRESS', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1559, 'en', 'MAIL FROM NAME', 'MAIL FROM NAME', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1560, 'en', 'MAILGUN DOMAIN', 'MAILGUN DOMAIN', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1561, 'en', 'MAILGUN SECRET', 'MAILGUN SECRET', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1562, 'en', 'Save Configuration', 'Save Configuration', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1563, 'en', 'Test SMTP configuration', 'Test SMTP configuration', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1564, 'en', 'Enter your email address', 'Enter your email address', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1565, 'en', 'Send test email', 'Send test email', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1566, 'en', 'Instruction', 'Instruction', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1567, 'en', 'Please be carefull when you are configuring SMTP. For incorrect configuration you will get error at the time of order place, new registration, sending newsletter.', 'Please be carefull when you are configuring SMTP. For incorrect configuration you will get error at the time of order place, new registration, sending newsletter.', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1568, 'en', 'For Non-SSL', 'For Non-SSL', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1569, 'en', 'Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver ', 'Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver ', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1570, 'en', 'Set Mail Host according to your server Mail Client Manual Settings', 'Set Mail Host according to your server Mail Client Manual Settings', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1571, 'en', 'Set Mail port as 587', 'Set Mail port as 587', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1572, 'en', 'Set Mail Encryption as ssl if you face issue with tls', 'Set Mail Encryption as ssl if you face issue with tls', '2023-05-25 03:17:51', '2023-05-25 03:17:51'),
(1573, 'en', 'For SSL', 'For SSL', '2023-05-25 03:17:52', '2023-05-25 03:17:52'),
(1574, 'en', 'Set Mail port as 465', 'Set Mail port as 465', '2023-05-25 03:17:52', '2023-05-25 03:17:52'),
(1575, 'en', 'Set Mail Encryption as ssl', 'Set Mail Encryption as ssl', '2023-05-25 03:17:52', '2023-05-25 03:17:52'),
(1576, 'en', 'All Customers', 'All Customers', '2023-05-25 03:18:31', '2023-05-25 03:18:31'),
(1577, 'en', 'Type email or name & Enter', 'Type email or name & Enter', '2023-05-25 03:18:31', '2023-05-25 03:18:31'),
(1578, 'en', 'Package', 'Package', '2023-05-25 03:18:31', '2023-05-25 03:18:31'),
(1579, 'en', 'Wallet Balance', 'Wallet Balance', '2023-05-25 03:18:32', '2023-05-25 03:18:32'),
(1580, 'en', 'Log in as this Customer', 'Log in as this Customer', '2023-05-25 03:18:32', '2023-05-25 03:18:32'),
(1581, 'en', 'Ban this Customer', 'Ban this Customer', '2023-05-25 03:18:32', '2023-05-25 03:18:32'),
(1582, 'en', 'Do you really want to ban this Customer?', 'Do you really want to ban this Customer?', '2023-05-25 03:18:32', '2023-05-25 03:18:32'),
(1583, 'en', 'Proceed!', 'Proceed!', '2023-05-25 03:18:32', '2023-05-25 03:18:32'),
(1584, 'en', 'Do you really want to unban this Customer?', 'Do you really want to unban this Customer?', '2023-05-25 03:18:32', '2023-05-25 03:18:32'),
(1585, 'en', 'Brand Information', 'Brand Information', '2023-05-25 03:31:26', '2023-05-25 03:31:26'),
(1586, 'en', 'Brand has been updated successfully', 'Brand has been updated successfully', '2023-05-25 03:35:38', '2023-05-25 03:35:38'),
(1587, 'en', 'Brand has been inserted successfully', 'Brand has been inserted successfully', '2023-05-25 03:38:17', '2023-05-25 03:38:17'),
(1588, 'en', 'Cookies Agreement', 'Cookies Agreement', '2023-05-25 04:42:48', '2023-05-25 04:42:48'),
(1589, 'en', 'Cookies Agreement Text', 'Cookies Agreement Text', '2023-05-25 04:42:48', '2023-05-25 04:42:48'),
(1590, 'en', 'Show Cookies Agreement?', 'Show Cookies Agreement?', '2023-05-25 04:42:48', '2023-05-25 04:42:48'),
(1591, 'en', 'Website Popup', 'Website Popup', '2023-05-25 04:42:48', '2023-05-25 04:42:48'),
(1592, 'en', 'Show website popup?', 'Show website popup?', '2023-05-25 04:42:48', '2023-05-25 04:42:48'),
(1593, 'en', 'Popup content', 'Popup content', '2023-05-25 04:42:48', '2023-05-25 04:42:48'),
(1594, 'en', 'Show Subscriber form?', 'Show Subscriber form?', '2023-05-25 04:42:48', '2023-05-25 04:42:48'),
(1595, 'en', 'Custom Script', 'Custom Script', '2023-05-25 04:42:48', '2023-05-25 04:42:48'),
(1596, 'en', 'Header custom script - before </head>', 'Header custom script - before </head>', '2023-05-25 04:42:48', '2023-05-25 04:42:48'),
(1597, 'en', 'Write script with <script> tag', 'Write script with <script> tag', '2023-05-25 04:42:48', '2023-05-25 04:42:48'),
(1598, 'en', 'Footer custom script - before </body>', 'Footer custom script - before </body>', '2023-05-25 04:42:48', '2023-05-25 04:42:48'),
(1599, 'en', 'Update your system', 'Update your system', '2023-05-25 04:46:58', '2023-05-25 04:46:58'),
(1600, 'en', 'Current verion', 'Current verion', '2023-05-25 04:46:58', '2023-05-25 04:46:58'),
(1601, 'en', 'Make sure your server has matched with all requirements.', 'Make sure your server has matched with all requirements.', '2023-05-25 04:46:58', '2023-05-25 04:46:58'),
(1602, 'en', 'Check Here', 'Check Here', '2023-05-25 04:46:58', '2023-05-25 04:46:58'),
(1603, 'en', 'Download latest version from codecanyon.', 'Download latest version from codecanyon.', '2023-05-25 04:46:58', '2023-05-25 04:46:58'),
(1604, 'en', 'Extract downloaded zip. You will find updates.zip file in those extraced files.', 'Extract downloaded zip. You will find updates.zip file in those extraced files.', '2023-05-25 04:46:58', '2023-05-25 04:46:58'),
(1605, 'en', 'Upload that zip file here and click update now.', 'Upload that zip file here and click update now.', '2023-05-25 04:46:58', '2023-05-25 04:46:58'),
(1606, 'en', 'If you are using any addon make sure to update those addons after updating.', 'If you are using any addon make sure to update those addons after updating.', '2023-05-25 04:46:58', '2023-05-25 04:46:58'),
(1607, 'en', 'Fashions', 'Fashions', '2023-05-25 04:50:10', '2023-05-25 04:50:10'),
(1608, 'en', 'Seasonal Deals', 'Seasonal Deals', '2023-05-25 04:52:55', '2023-05-25 04:52:55'),
(1609, 'en', 'Gift Cards', 'Gift Cards', '2023-05-25 04:52:55', '2023-05-25 04:52:55'),
(1610, 'en', 'Electronics', 'Electronics', '2023-05-25 04:52:55', '2023-05-25 04:52:55'),
(1611, 'en', 'Phones & Tablets', 'Phones & Tablets', '2023-05-25 04:52:55', '2023-05-25 04:52:55'),
(1612, 'en', 'Beauty & Personal Care', 'Beauty & Personal Care', '2023-05-25 04:52:55', '2023-05-25 04:52:55'),
(1613, 'en', 'Blog', 'Blog', '2023-05-25 05:00:19', '2023-05-25 05:00:19'),
(1614, 'en', 'System Default Currency', 'System Default Currency', '2023-05-25 05:05:41', '2023-05-25 05:05:41'),
(1615, 'en', 'Set Currency Formats', 'Set Currency Formats', '2023-05-25 05:05:41', '2023-05-25 05:05:41'),
(1616, 'en', 'Symbol Format', 'Symbol Format', '2023-05-25 05:05:41', '2023-05-25 05:05:41'),
(1617, 'en', 'Decimal Separator', 'Decimal Separator', '2023-05-25 05:05:41', '2023-05-25 05:05:41'),
(1618, 'en', 'No of decimals', 'No of decimals', '2023-05-25 05:05:41', '2023-05-25 05:05:41'),
(1619, 'en', 'All Currencies', 'All Currencies', '2023-05-25 05:05:41', '2023-05-25 05:05:41'),
(1620, 'en', 'Add New Currency', 'Add New Currency', '2023-05-25 05:05:42', '2023-05-25 05:05:42'),
(1621, 'en', 'Currency name', 'Currency name', '2023-05-25 05:05:42', '2023-05-25 05:05:42'),
(1622, 'en', 'Currency symbol', 'Currency symbol', '2023-05-25 05:05:42', '2023-05-25 05:05:42'),
(1623, 'en', 'Currency code', 'Currency code', '2023-05-25 05:05:42', '2023-05-25 05:05:42'),
(1624, 'en', 'Currency Status updated successfully', 'Currency Status updated successfully', '2023-05-25 05:05:42', '2023-05-25 05:05:42'),
(1625, 'en', 'Symbol', 'Symbol', '2023-05-25 05:06:02', '2023-05-25 05:06:02'),
(1626, 'en', 'All Taxes', 'All Taxes', '2023-05-25 05:06:25', '2023-05-25 05:06:25'),
(1627, 'en', 'Add New Tax', 'Add New Tax', '2023-05-25 05:06:25', '2023-05-25 05:06:25'),
(1628, 'en', 'Tax Type', 'Tax Type', '2023-05-25 05:06:25', '2023-05-25 05:06:25'),
(1629, 'en', 'Tax Name', 'Tax Name', '2023-05-25 05:06:25', '2023-05-25 05:06:25'),
(1630, 'en', 'Tax status updated successfully', 'Tax status updated successfully', '2023-05-25 05:06:25', '2023-05-25 05:06:25'),
(1631, 'en', 'Product has been inserted successfully', 'Product has been inserted successfully', '2023-05-25 07:05:09', '2023-05-25 07:05:09'),
(1632, 'en', 'Select Brand', 'Select Brand', '2023-05-25 07:14:02', '2023-05-25 07:14:02'),
(1633, 'en', 'Product has been updated successfully and in approval state. You will get and email after live your product.', 'Product has been updated successfully and in approval state. You will get and email after live your product.', '2023-05-25 07:21:51', '2023-05-25 07:21:51'),
(1634, 'en', 'Cusorcart', 'Cusorcart', '2023-05-25 07:35:21', '2023-05-25 07:35:21'),
(1635, 'en', 'Forgot password ?', 'Forgot password ?', '2023-05-25 14:49:40', '2023-05-25 14:49:40'),
(1636, 'en', 'All Attributes', 'All Attributes', '2023-05-25 15:21:11', '2023-05-25 15:21:11'),
(1637, 'en', 'Attribute values', 'Attribute values', '2023-05-25 15:21:11', '2023-05-25 15:21:11'),
(1638, 'en', 'Add New Attribute', 'Add New Attribute', '2023-05-25 15:21:11', '2023-05-25 15:21:11'),
(1639, 'en', 'Product has been duplicated successfully', 'Product has been duplicated successfully', '2023-05-25 20:20:03', '2023-05-25 20:20:03'),
(1640, 'en', 'Add New Seller', 'Add New Seller', '2023-05-25 20:51:24', '2023-05-25 20:51:24'),
(1641, 'en', 'Filter by Approval', 'Filter by Approval', '2023-05-25 20:51:24', '2023-05-25 20:51:24'),
(1642, 'en', 'Non-Approved', 'Non-Approved', '2023-05-25 20:51:24', '2023-05-25 20:51:24'),
(1643, 'en', 'Type name or email & Enter', 'Type name or email & Enter', '2023-05-25 20:51:24', '2023-05-25 20:51:24'),
(1644, 'en', 'Due to seller', 'Due to seller', '2023-05-25 20:51:24', '2023-05-25 20:51:24'),
(1645, 'en', 'Log in as this Seller', 'Log in as this Seller', '2023-05-25 20:51:24', '2023-05-25 20:51:24'),
(1646, 'en', 'Go to Payment', 'Go to Payment', '2023-05-25 20:51:24', '2023-05-25 20:51:24'),
(1647, 'en', 'Ban this seller', 'Ban this seller', '2023-05-25 20:51:24', '2023-05-25 20:51:24'),
(1648, 'en', 'Do you really want to ban this seller?', 'Do you really want to ban this seller?', '2023-05-25 20:51:24', '2023-05-25 20:51:24'),
(1649, 'en', 'Approved sellers updated successfully', 'Approved sellers updated successfully', '2023-05-25 20:51:24', '2023-05-25 20:51:24'),
(1650, 'en', 'About', 'About', '2023-05-25 20:51:49', '2023-05-25 20:51:49'),
(1651, 'en', 'Payout Info', 'Payout Info', '2023-05-25 20:51:49', '2023-05-25 20:51:49'),
(1652, 'en', 'Bank Acc Name', 'Bank Acc Name', '2023-05-25 20:51:49', '2023-05-25 20:51:49'),
(1653, 'en', 'Bank Acc Number', 'Bank Acc Number', '2023-05-25 20:51:49', '2023-05-25 20:51:49'),
(1654, 'en', 'Total Products', 'Total Products', '2023-05-25 20:51:49', '2023-05-25 20:51:49'),
(1655, 'en', 'Total Sold Amount', 'Total Sold Amount', '2023-05-25 20:51:49', '2023-05-25 20:51:49'),
(1656, 'en', 'Edit Seller Information', 'Edit Seller Information', '2023-05-25 20:52:24', '2023-05-25 20:52:24'),
(1657, 'en', 'Seller Information', 'Seller Information', '2023-05-25 20:52:24', '2023-05-25 20:52:24'),
(1658, 'en', 'Seller has been updated successfully', 'Seller has been updated successfully', '2023-05-25 20:52:55', '2023-05-25 20:52:55'),
(1659, 'en', 'Upload Product', 'Upload Product', '2023-05-25 20:53:54', '2023-05-25 20:53:54'),
(1660, 'en', 'Weight in Kg', 'Weight in Kg', '2023-05-25 21:01:41', '2023-05-25 21:01:41'),
(1661, 'en', 'Change my email', 'Change my email', '2023-05-25 21:04:46', '2023-05-25 21:04:46'),
(1662, 'en', 'My Email', 'My Email', '2023-05-25 21:04:46', '2023-05-25 21:04:46'),
(1663, 'en', 'State', 'State', '2023-05-25 21:04:46', '2023-05-25 21:04:46'),
(1664, 'en', 'Shop Logo', 'Shop Logo', '2023-05-25 21:06:15', '2023-05-25 21:06:15'),
(1665, 'en', 'Shop Phone', 'Shop Phone', '2023-05-25 21:06:15', '2023-05-25 21:06:15'),
(1666, 'en', 'Shop Country', 'Shop Country', '2023-05-25 21:06:15', '2023-05-25 21:06:15'),
(1667, 'en', 'Shop State', 'Shop State', '2023-05-25 21:06:16', '2023-05-25 21:06:16'),
(1668, 'en', 'Shop City', 'Shop City', '2023-05-25 21:06:16', '2023-05-25 21:06:16'),
(1669, 'en', 'Shop Address', 'Shop Address', '2023-05-25 21:06:16', '2023-05-25 21:06:16'),
(1670, 'en', 'Banner Settings', 'Banner Settings', '2023-05-25 21:06:16', '2023-05-25 21:06:16'),
(1671, 'en', 'Banners', 'Banners', '2023-05-25 21:06:16', '2023-05-25 21:06:16'),
(1672, 'en', 'We had to limit height to maintian consistancy. In some device both side of the banner might be cropped for height limitation.', 'We had to limit height to maintian consistancy. In some device both side of the banner might be cropped for height limitation.', '2023-05-25 21:06:16', '2023-05-25 21:06:16'),
(1673, 'en', 'Insert link with https ', 'Insert link with https ', '2023-05-25 21:06:16', '2023-05-25 21:06:16'),
(1674, 'en', 'Your Shop has been updated successfully!', 'Your Shop has been updated successfully!', '2023-05-25 21:09:43', '2023-05-25 21:09:43'),
(1675, 'en', 'update Language Info', 'update Language Info', '2023-05-26 03:42:43', '2023-05-26 03:42:43'),
(1676, 'en', 'Language has been updated successfully', 'Language has been updated successfully', '2023-05-26 03:43:18', '2023-05-26 03:43:18'),
(1677, 'en', 'Search result for ', 'Search result for ', '2023-05-26 03:46:33', '2023-05-26 03:46:33'),
(1678, 'en', 'Please click the button below to verify your email address.', 'Please click the button below to verify your email address.', '2023-05-26 08:23:32', '2023-05-26 08:23:32'),
(1679, 'en', 'Email Verification - ', 'Email Verification - ', '2023-05-26 08:23:32', '2023-05-26 08:23:32'),
(1680, 'en', 'Verify Your Email Here', 'Verify Your Email Here', '2023-05-26 08:23:33', '2023-05-26 08:23:33'),
(1681, 'en', 'Verify Your Email Address', 'Verify Your Email Address', '2023-05-26 08:24:11', '2023-05-26 08:24:11'),
(1682, 'en', 'Before proceeding, please check your email for a verification link.', 'Before proceeding, please check your email for a verification link.', '2023-05-26 08:24:11', '2023-05-26 08:24:11'),
(1683, 'en', 'If you did not receive the email.', 'If you did not receive the email.', '2023-05-26 08:24:11', '2023-05-26 08:24:11'),
(1684, 'en', 'Click here to request another', 'Click here to request another', '2023-05-26 08:24:11', '2023-05-26 08:24:11'),
(1685, 'en', 'Email or Phone already exists.', 'Email or Phone already exists.', '2023-05-26 08:59:00', '2023-05-26 08:59:00'),
(1686, 'en', 'A fresh verification link has been sent to your email address.', 'A fresh verification link has been sent to your email address.', '2023-05-26 09:20:49', '2023-05-26 09:20:49'),
(1687, 'en', 'Registration successfull. Please verify your email.', 'Registration successfull. Please verify your email.', '2023-05-26 10:07:32', '2023-05-26 10:07:32'),
(1688, 'en', 'Country Upload', 'Country Upload', '2023-05-26 18:02:01', '2023-05-26 18:02:01'),
(1689, 'en', 'Country File Upload Csv', 'Country File Upload Csv', '2023-05-26 18:02:01', '2023-05-26 18:02:01'),
(1690, 'en', 'Brand has been deleted successfully', 'Brand has been deleted successfully', '2023-05-26 18:06:20', '2023-05-26 18:06:20'),
(1691, 'en', 'Change Order Status', 'Change Order Status', '2023-05-26 18:07:05', '2023-05-26 18:07:05'),
(1692, 'en', 'Choose an order status', 'Choose an order status', '2023-05-26 18:07:05', '2023-05-26 18:07:05'),
(1693, 'en', 'Picked Up', 'Picked Up', '2023-05-26 18:07:05', '2023-05-26 18:07:05'),
(1694, 'en', 'On The Way', 'On The Way', '2023-05-26 18:07:05', '2023-05-26 18:07:05'),
(1695, 'en', 'Filter by date', 'Filter by date', '2023-05-26 18:07:05', '2023-05-26 18:07:05'),
(1696, 'en', 'Manage Delivery', 'Manage Delivery', '2023-05-26 18:07:05', '2023-05-26 18:07:05'),
(1697, 'en', 'Customer Banned Successfully', 'Customer Banned Successfully', '2023-05-26 18:11:50', '2023-05-26 18:11:50'),
(1698, 'en', 'Unban this Customer', 'Unban this Customer', '2023-05-26 18:11:51', '2023-05-26 18:11:51'),
(1699, 'en', 'Customer UnBanned Successfully', 'Customer UnBanned Successfully', '2023-05-26 18:12:00', '2023-05-26 18:12:00'),
(1700, 'en', 'Email already exists!', 'Email already exists!', '2023-05-26 18:12:59', '2023-05-26 18:12:59'),
(1701, 'en', 'Seller has been inserted successfully', 'Seller has been inserted successfully', '2023-05-26 18:19:43', '2023-05-26 18:19:43'),
(1702, 'en', 'File deleted successfully', 'File deleted successfully', '2023-05-27 10:25:37', '2023-05-27 10:25:37'),
(1703, 'en', 'Please add shipping address', 'Please add shipping address', '2023-05-28 12:55:29', '2023-05-28 12:55:29'),
(1704, 'en', 'Attribute has been inserted successfully', 'Attribute has been inserted successfully', '2023-05-28 13:07:29', '2023-05-28 13:07:29'),
(1705, 'en', 'Attribute Detail', 'Attribute Detail', '2023-05-28 19:35:25', '2023-05-28 19:35:25'),
(1706, 'en', 'Add New Attribute Value', 'Add New Attribute Value', '2023-05-28 19:35:25', '2023-05-28 19:35:25'),
(1707, 'en', 'Attribute Name', 'Attribute Name', '2023-05-28 19:35:25', '2023-05-28 19:35:25'),
(1708, 'en', 'Attribute Value', 'Attribute Value', '2023-05-28 19:35:25', '2023-05-28 19:35:25'),
(1709, 'en', 'Attribute value has been inserted successfully', 'Attribute value has been inserted successfully', '2023-05-28 19:35:49', '2023-05-28 19:35:49'),
(1710, 'en', 'Attribute Information', 'Attribute Information', '2023-05-28 19:37:15', '2023-05-28 19:37:15'),
(1711, 'en', 'Attribute has been updated successfully', 'Attribute has been updated successfully', '2023-05-28 19:37:28', '2023-05-28 19:37:28'),
(1712, 'en', 'Currency updated successfully', 'Currency updated successfully', '2023-05-28 20:22:35', '2023-05-28 20:22:35'),
(1713, 'en', 'Update Currency', 'Update Currency', '2023-05-28 20:54:12', '2023-05-28 20:54:12'),
(1714, 'en', 'At the very bottom, you can find the “Facebook Page ID”', 'At the very bottom, you can find the “Facebook Page ID”', '2023-05-28 21:23:23', '2023-05-28 21:23:23'),
(1715, 'en', 'Go to Settings of your page and find the option of \"Advance Messaging\"', 'Go to Settings of your page and find the option of \"Advance Messaging\"', '2023-05-28 21:23:23', '2023-05-28 21:23:23'),
(1716, 'en', 'Scroll down that page and you will get \"white listed domain\"', 'Scroll down that page and you will get \"white listed domain\"', '2023-05-28 21:23:24', '2023-05-28 21:23:24'),
(1717, 'en', 'Hide/Show', 'Hide/Show', '2023-05-28 21:25:22', '2023-05-28 21:25:22'),
(1718, 'en', 'All States', 'All States', '2023-05-28 21:30:01', '2023-05-28 21:30:01'),
(1719, 'en', 'States', 'States', '2023-05-28 21:30:01', '2023-05-28 21:30:01'),
(1720, 'en', 'Cost', 'Cost', '2023-05-28 21:30:01', '2023-05-28 21:30:01'),
(1721, 'en', 'Add New State', 'Add New State', '2023-05-28 21:30:01', '2023-05-28 21:30:01'),
(1722, 'en', 'All cities', 'All cities', '2023-05-28 21:30:19', '2023-05-28 21:30:19'),
(1723, 'en', 'Cities', 'Cities', '2023-05-28 21:30:19', '2023-05-28 21:30:19'),
(1724, 'en', 'Add New city', 'Add New city', '2023-05-28 21:30:19', '2023-05-28 21:30:19'),
(1725, 'en', 'Area Wise Flat Shipping Cost', 'Area Wise Flat Shipping Cost', '2023-05-28 21:30:33', '2023-05-28 21:30:33'),
(1726, 'en', 'Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If customers purchase 2 product from two seller shipping cost is calculated by addition of each seller flat shipping cost', 'Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If customers purchase 2 product from two seller shipping cost is calculated by addition of each seller flat shipping cost', '2023-05-28 21:30:33', '2023-05-28 21:30:33'),
(1727, 'en', 'Area Wise Flat Shipping Cost calulation: Fixed rate for each area. If customers purchase multiple products from one seller shipping cost is calculated by the customer shipping area. To configure area wise shipping cost go to ', 'Area Wise Flat Shipping Cost calulation: Fixed rate for each area. If customers purchase multiple products from one seller shipping cost is calculated by the customer shipping area. To configure area wise shipping cost go to ', '2023-05-28 21:30:33', '2023-05-28 21:30:33'),
(1728, 'en', '1. Flat rate shipping cost is applicable if Flat rate shipping is enabled.', '1. Flat rate shipping cost is applicable if Flat rate shipping is enabled.', '2023-05-28 21:30:33', '2023-05-28 21:30:33'),
(1729, 'en', '1. Shipping cost for admin is applicable if Seller wise shipping cost is enabled.', '1. Shipping cost for admin is applicable if Seller wise shipping cost is enabled.', '2023-05-28 21:30:33', '2023-05-28 21:30:33'),
(1730, 'en', 'Google Login Credential', 'Google Login Credential', '2023-05-28 21:32:01', '2023-05-28 21:32:01'),
(1731, 'en', 'Client ID', 'Client ID', '2023-05-28 21:32:01', '2023-05-28 21:32:01'),
(1732, 'en', 'Google Client ID', 'Google Client ID', '2023-05-28 21:32:01', '2023-05-28 21:32:01'),
(1733, 'en', 'Client Secret', 'Client Secret', '2023-05-28 21:32:01', '2023-05-28 21:32:01'),
(1734, 'en', 'Google Client Secret', 'Google Client Secret', '2023-05-28 21:32:01', '2023-05-28 21:32:01'),
(1735, 'en', 'Facebook Login Credential', 'Facebook Login Credential', '2023-05-28 21:32:01', '2023-05-28 21:32:01'),
(1736, 'en', 'App ID', 'App ID', '2023-05-28 21:32:01', '2023-05-28 21:32:01'),
(1737, 'en', 'Facebook Client ID', 'Facebook Client ID', '2023-05-28 21:32:01', '2023-05-28 21:32:01'),
(1738, 'en', 'App Secret', 'App Secret', '2023-05-28 21:32:01', '2023-05-28 21:32:01'),
(1739, 'en', 'Facebook Client Secret', 'Facebook Client Secret', '2023-05-28 21:32:01', '2023-05-28 21:32:01'),
(1740, 'en', 'Twitter Login Credential', 'Twitter Login Credential', '2023-05-28 21:32:01', '2023-05-28 21:32:01'),
(1741, 'en', 'Twitter Client ID', 'Twitter Client ID', '2023-05-28 21:32:01', '2023-05-28 21:32:01'),
(1742, 'en', 'Twitter Client Secret', 'Twitter Client Secret', '2023-05-28 21:32:01', '2023-05-28 21:32:01'),
(1743, 'en', 'Bkash Credential', 'Bkash Credential', '2023-05-28 21:33:36', '2023-05-28 21:33:36'),
(1744, 'en', 'BKASH CHECKOUT APP KEY', 'BKASH CHECKOUT APP KEY', '2023-05-28 21:33:36', '2023-05-28 21:33:36'),
(1745, 'en', 'BKASH CHECKOUT APP SECRET', 'BKASH CHECKOUT APP SECRET', '2023-05-28 21:33:36', '2023-05-28 21:33:36'),
(1746, 'en', 'BKASH CHECKOUT USER NAME', 'BKASH CHECKOUT USER NAME', '2023-05-28 21:33:36', '2023-05-28 21:33:36'),
(1747, 'en', 'BKASH CHECKOUT PASSWORD', 'BKASH CHECKOUT PASSWORD', '2023-05-28 21:33:36', '2023-05-28 21:33:36'),
(1748, 'en', 'Bkash Sandbox Mode', 'Bkash Sandbox Mode', '2023-05-28 21:33:36', '2023-05-28 21:33:36'),
(1749, 'en', 'Nagad Credential', 'Nagad Credential', '2023-05-28 21:33:36', '2023-05-28 21:33:36'),
(1750, 'en', 'NAGAD MODE', 'NAGAD MODE', '2023-05-28 21:33:36', '2023-05-28 21:33:36'),
(1751, 'en', 'NAGAD MERCHANT ID', 'NAGAD MERCHANT ID', '2023-05-28 21:33:36', '2023-05-28 21:33:36');
INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(1752, 'en', 'NAGAD MERCHANT NUMBER', 'NAGAD MERCHANT NUMBER', '2023-05-28 21:33:36', '2023-05-28 21:33:36'),
(1753, 'en', 'NAGAD PG PUBLIC KEY', 'NAGAD PG PUBLIC KEY', '2023-05-28 21:33:37', '2023-05-28 21:33:37'),
(1754, 'en', 'NAGAD MERCHANT PRIVATE KEY', 'NAGAD MERCHANT PRIVATE KEY', '2023-05-28 21:33:37', '2023-05-28 21:33:37'),
(1755, 'en', 'PAYSTACK CURRENCY CODE', 'PAYSTACK CURRENCY CODE', '2023-05-28 21:33:37', '2023-05-28 21:33:37'),
(1756, 'en', 'Iyzico Credential', 'Iyzico Credential', '2023-05-28 21:33:37', '2023-05-28 21:33:37'),
(1757, 'en', 'IYZICO_API_KEY', 'IYZICO_API_KEY', '2023-05-28 21:33:37', '2023-05-28 21:33:37'),
(1758, 'en', 'IYZICO API KEY', 'IYZICO API KEY', '2023-05-28 21:33:37', '2023-05-28 21:33:37'),
(1759, 'en', 'IYZICO_SECRET_KEY', 'IYZICO_SECRET_KEY', '2023-05-28 21:33:37', '2023-05-28 21:33:37'),
(1760, 'en', 'IYZICO SECRET KEY', 'IYZICO SECRET KEY', '2023-05-28 21:33:37', '2023-05-28 21:33:37'),
(1761, 'en', 'IYZICO Sandbox Mode', 'IYZICO Sandbox Mode', '2023-05-28 21:33:37', '2023-05-28 21:33:37'),
(1762, 'en', 'ProxyPay Credential', 'ProxyPay Credential', '2023-05-28 21:33:37', '2023-05-28 21:33:37'),
(1763, 'en', 'PROXYPAY_TOKEN', 'PROXYPAY_TOKEN', '2023-05-28 21:33:37', '2023-05-28 21:33:37'),
(1764, 'en', 'PROXYPAY TOKEN', 'PROXYPAY TOKEN', '2023-05-28 21:33:37', '2023-05-28 21:33:37'),
(1765, 'en', 'PROXYPAY_ENTITY', 'PROXYPAY_ENTITY', '2023-05-28 21:33:38', '2023-05-28 21:33:38'),
(1766, 'en', 'PROXYPAY_END_TIME', 'PROXYPAY_END_TIME', '2023-05-28 21:33:38', '2023-05-28 21:33:38'),
(1767, 'en', 'Type key & Enter', 'Type key & Enter', '2023-05-28 21:35:49', '2023-05-28 21:35:49'),
(1768, 'en', 'Ok. I Understood', 'Ok. I Understood', '2023-05-28 21:46:50', '2023-05-28 21:46:50'),
(1769, 'en', 'Support Desk', 'Support Desk', '2023-05-29 06:07:45', '2023-05-29 06:07:45'),
(1770, 'en', 'Type ticket code & Enter', 'Type ticket code & Enter', '2023-05-29 06:07:45', '2023-05-29 06:07:45'),
(1771, 'en', 'User', 'User', '2023-05-29 06:07:45', '2023-05-29 06:07:45'),
(1772, 'en', 'Last reply', 'Last reply', '2023-05-29 06:07:45', '2023-05-29 06:07:45'),
(1773, 'en', 'All Flash Deals', 'All Flash Deals', '2023-05-29 06:08:25', '2023-05-29 06:08:25'),
(1774, 'en', 'Create New Flash Deal', 'Create New Flash Deal', '2023-05-29 06:08:25', '2023-05-29 06:08:25'),
(1775, 'en', '#FFFFFF', '#FFFFFF', '2023-05-29 06:08:37', '2023-05-29 06:08:37'),
(1776, 'en', 'This image is shown as cover banner in flash deal details page.', 'This image is shown as cover banner in flash deal details page.', '2023-05-29 06:08:37', '2023-05-29 06:08:37'),
(1777, 'en', 'If any product has discount or exists in another flash deal, the discount will be replaced by this discount & time limit.', 'If any product has discount or exists in another flash deal, the discount will be replaced by this discount & time limit.', '2023-05-29 06:08:37', '2023-05-29 06:08:37'),
(1778, 'en', 'Flash Deal has been inserted successfully', 'Flash Deal has been inserted successfully', '2023-05-29 06:13:06', '2023-05-29 06:13:06'),
(1779, 'en', 'Flash deal status updated successfully', 'Flash deal status updated successfully', '2023-05-29 06:14:01', '2023-05-29 06:14:01'),
(1780, 'en', 'Emails', 'Emails', '2023-05-29 06:15:44', '2023-05-29 06:15:44'),
(1781, 'en', 'Users', 'Users', '2023-05-29 06:15:44', '2023-05-29 06:15:44'),
(1782, 'en', 'Newsletter subject', 'Newsletter subject', '2023-05-29 06:15:44', '2023-05-29 06:15:44'),
(1783, 'en', 'Newsletter content', 'Newsletter content', '2023-05-29 06:15:44', '2023-05-29 06:15:44'),
(1784, 'en', 'Wallet Transaction', 'Wallet Transaction', '2023-05-29 15:48:45', '2023-05-29 15:48:45'),
(1785, 'en', 'Choose User', 'Choose User', '2023-05-29 15:48:45', '2023-05-29 15:48:45'),
(1786, 'en', 'Daterange', 'Daterange', '2023-05-29 15:48:45', '2023-05-29 15:48:45'),
(1787, 'en', 'Sorry, we could not verifiy you. Please try again', 'Sorry, we could not verifiy you. Please try again', '2023-05-29 17:11:25', '2023-05-29 17:11:25'),
(1788, 'en', 'logistics services', 'logistics services', '2023-05-29 22:38:54', '2023-05-29 22:38:54'),
(1789, 'en', 'add logistics service', 'add logistics service', '2023-05-29 22:38:54', '2023-05-29 22:38:54'),
(1790, 'en', 'Assigned Delivery', 'Assigned Delivery', '2023-05-29 22:38:54', '2023-05-29 22:38:54'),
(1791, 'en', 'Pickup Delivery', 'Pickup Delivery', '2023-05-29 22:38:54', '2023-05-29 22:38:54'),
(1792, 'en', 'On The Way Delivery', 'On The Way Delivery', '2023-05-29 22:38:54', '2023-05-29 22:38:54'),
(1793, 'en', 'Completed Delivery', 'Completed Delivery', '2023-05-29 22:38:54', '2023-05-29 22:38:54'),
(1794, 'en', 'Pending Delivery', 'Pending Delivery', '2023-05-29 22:38:54', '2023-05-29 22:38:54'),
(1795, 'en', 'Cancelled Delivery', 'Cancelled Delivery', '2023-05-29 22:38:54', '2023-05-29 22:38:54'),
(1796, 'en', 'Request Cancelled Delivery', 'Request Cancelled Delivery', '2023-05-29 22:38:54', '2023-05-29 22:38:54'),
(1797, 'en', 'Total Collections', 'Total Collections', '2023-05-29 22:38:54', '2023-05-29 22:38:54'),
(1798, 'en', 'Total Collected', 'Total Collected', '2023-05-29 22:53:40', '2023-05-29 22:53:40'),
(1799, 'en', 'Name on Bank Account', 'Name on Bank Account', '2023-05-29 23:08:39', '2023-05-29 23:08:39'),
(1800, 'en', 'Account No/ IBAN', 'Account No/ IBAN', '2023-05-29 23:08:39', '2023-05-29 23:08:39'),
(1801, 'en', 'Bank Country', 'Bank Country', '2023-05-29 23:08:39', '2023-05-29 23:08:39'),
(1802, 'en', 'Bank State', 'Bank State', '2023-05-29 23:08:39', '2023-05-29 23:08:39'),
(1803, 'en', 'Bank City', 'Bank City', '2023-05-29 23:08:39', '2023-05-29 23:08:39'),
(1804, 'en', 'Bank Zip Code', 'Bank Zip Code', '2023-05-29 23:08:39', '2023-05-29 23:08:39'),
(1805, 'en', 'Bank Swift Code', 'Bank Swift Code', '2023-05-29 23:08:39', '2023-05-29 23:08:39'),
(1806, 'en', 'Payment Reason', 'Payment Reason', '2023-05-29 23:08:39', '2023-05-29 23:08:39'),
(1807, 'en', 'Verify Now', 'Verify Now', '2023-05-29 23:15:44', '2023-05-29 23:15:44'),
(1808, 'en', 'Please Verify Now', 'Please Verify Now', '2023-05-29 23:15:44', '2023-05-29 23:15:44'),
(1809, 'en', 'Your verification mail has been Sent to your email.', 'Your verification mail has been Sent to your email.', '2023-05-29 23:30:01', '2023-05-29 23:30:01'),
(1810, 'en', 'A verification mail has been sent to the mail you provided us with.', 'A verification mail has been sent to the mail you provided us with.', '2023-05-29 23:30:01', '2023-05-29 23:30:01'),
(1811, 'en', 'Shipping Detail', 'Shipping Detail', '2023-05-30 15:34:24', '2023-05-30 15:34:24'),
(1812, 'en', 'Withdraw Request', 'Withdraw Request', '2023-05-30 15:57:41', '2023-05-30 15:57:41'),
(1813, 'en', 'Service', 'Service', '2023-05-30 15:57:41', '2023-05-30 15:57:41'),
(1814, 'en', 'Service Charge', 'Service Charge', '2023-05-30 15:57:41', '2023-05-30 15:57:41'),
(1815, 'en', 'Order Number', 'Order Number', '2023-05-30 15:57:41', '2023-05-30 15:57:41'),
(1816, 'en', 'Seller', 'Seller', '2023-05-30 15:57:59', '2023-05-30 15:57:59'),
(1817, 'en', 'Payment Details', 'Payment Details', '2023-05-30 15:57:59', '2023-05-30 15:57:59'),
(1818, 'en', 'In Route', 'In Route', '2023-05-30 15:58:10', '2023-05-30 15:58:10'),
(1819, 'en', 'Shipping Details', 'Shipping Details', '2023-05-30 16:16:30', '2023-05-30 16:16:30'),
(1820, 'en', 'Add New Service', 'Add New Service', '2023-05-30 16:16:31', '2023-05-30 16:16:31'),
(1821, 'en', 'Transit Days', 'Transit Days', '2023-05-30 16:16:31', '2023-05-30 16:16:31'),
(1822, 'en', 'Shipping Tax', 'Shipping Tax', '2023-05-30 16:16:31', '2023-05-30 16:16:31'),
(1823, 'en', 'Approval status', 'Approval status', '2023-05-30 16:16:31', '2023-05-30 16:16:31'),
(1824, 'en', 'Enter Code Number', 'Enter Code Number', '2023-05-30 16:17:32', '2023-05-30 16:17:32'),
(1825, 'en', 'Complaints', 'Complaints', '2023-05-30 16:43:00', '2023-05-30 16:43:00'),
(1826, 'en', 'There isn\'t anything added yet', 'There isn\'t anything added yet', '2023-05-31 04:17:20', '2023-05-31 04:17:20'),
(1827, 'en', 'Item has been removed from wishlist', 'Item has been removed from wishlist', '2023-05-31 04:17:20', '2023-05-31 04:17:20'),
(1828, 'en', 'Recharge Wallet', 'Recharge Wallet', '2023-06-02 20:41:49', '2023-06-02 20:41:49'),
(1829, 'en', 'Instamojo', 'Instamojo', '2023-06-02 20:41:49', '2023-06-02 20:41:49'),
(1830, 'en', 'Iyzico', 'Iyzico', '2023-06-02 20:41:49', '2023-06-02 20:41:49'),
(1831, 'en', 'Proxypay', 'Proxypay', '2023-06-02 20:41:49', '2023-06-02 20:41:49'),
(1832, 'en', 'Bkash', 'Bkash', '2023-06-02 20:41:49', '2023-06-02 20:41:49'),
(1833, 'en', 'Nagad', 'Nagad', '2023-06-02 20:41:50', '2023-06-02 20:41:50'),
(1834, 'en', 'Offline Recharge Wallet', 'Offline Recharge Wallet', '2023-06-02 20:41:50', '2023-06-02 20:41:50'),
(1835, 'en', 'Details', 'Details', '2023-06-02 23:17:07', '2023-06-02 23:17:07'),
(1836, 'en', 'See ticket', 'See ticket', '2023-06-02 23:17:07', '2023-06-02 23:17:07'),
(1837, 'en', 'Ticket has been sent successfully', 'Ticket has been sent successfully', '2023-06-02 23:17:07', '2023-06-02 23:17:07'),
(1838, 'en', 'Manage Profiles', 'Manage Profiles', '2023-06-02 23:27:27', '2023-06-02 23:27:27'),
(1839, 'en', 'Send Reply', 'Send Reply', '2023-06-03 23:03:34', '2023-06-03 23:03:34'),
(1840, 'en', 'Submit as', 'Submit as', '2023-06-03 23:05:52', '2023-06-03 23:05:52'),
(1841, 'en', 'Solved', 'Solved', '2023-06-03 23:05:52', '2023-06-03 23:05:52'),
(1842, 'en', 'Service Charges', 'Service Charges', '2023-06-04 11:49:18', '2023-06-04 11:49:18'),
(1843, 'en', 'Gst Rate', 'Gst Rate', '2023-06-04 11:49:18', '2023-06-04 11:49:18'),
(1844, 'en', 'Per Kg Price', 'Per Kg Price', '2023-06-04 11:49:18', '2023-06-04 11:49:18'),
(1845, 'en', 'Pickup Country', 'Pickup Country', '2023-06-04 11:49:18', '2023-06-04 11:49:18'),
(1846, 'en', 'Pickup State', 'Pickup State', '2023-06-04 11:49:18', '2023-06-04 11:49:18'),
(1847, 'en', 'Pickup City', 'Pickup City', '2023-06-04 11:49:18', '2023-06-04 11:49:18'),
(1848, 'en', 'Arrival Country', 'Arrival Country', '2023-06-04 11:49:18', '2023-06-04 11:49:18'),
(1849, 'en', 'Arrival State', 'Arrival State', '2023-06-04 11:49:19', '2023-06-04 11:49:19'),
(1850, 'en', 'Arrival City', 'Arrival City', '2023-06-04 11:49:19', '2023-06-04 11:49:19'),
(1851, 'en', 'Unit in KG', 'Unit in KG', '2023-06-04 12:38:13', '2023-06-04 12:38:13'),
(1852, 'en', 'Tracking Order', 'Tracking Order', '2023-06-05 23:53:02', '2023-06-05 23:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `file_original_name` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `file_original_name`, `file_name`, `user_id`, `file_size`, `extension`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1631340770', 'uploads/all/ZGy9fEfbrgB0pmSR0jSbUm0P9puATlNmW7pK9YiF.png', 9, 27037, 'png', 'image', '2023-05-24 20:17:01', '2023-05-24 20:17:01', NULL),
(2, 'footer_logo', 'uploads/all/tGjE6Z0ItLxPNj6fCR857tbCnZaNXMJy4eRDi6bt.png', 9, 6873, 'png', 'image', '2023-05-25 02:19:45', '2023-05-25 02:19:45', NULL),
(3, 'zj5LfU5PJB0oub5Lke3tVNak7lqkQ1PqbQX7SIHN', 'uploads/all/Vw4h4YCFhmOVaOg0HFot8jXfzSKlI3lbZpFfwwsw.png', 9, 146071, 'png', 'image', '2023-05-25 02:51:14', '2023-05-25 02:51:14', NULL),
(4, 'eeWPRTc9zrFO14FHxkRffyo8bIQQBFSbvKd5KvKm', 'uploads/all/oYH3iHNanJNcoENXleSm9pY7XQGQMol3d2SYMbjQ.png', 9, 154033, 'png', 'image', '2023-05-25 02:52:37', '2023-05-25 02:52:37', NULL),
(5, 'zCvrCiNljbcxuNU4eTNXRpwpPNaYxLiBULJ58phQ', 'uploads/all/ZaqA24IXANOKH5P9b6LBtnOCzD6AfRoiB1b4p6a9.png', 9, 25441, 'png', 'image', '2023-05-25 03:12:55', '2023-05-25 03:12:55', NULL),
(6, '2GR0kTEUibOYYWn3vKWoe6cmeUyD8Z1sJO8T7onj', 'uploads/all/vkGVQuR7S4u1YSDNldOt8zYBfCt9CkB8YazXANrq.png', 9, 331705, 'png', 'image', '2023-05-25 03:13:41', '2023-05-25 03:13:41', NULL),
(7, 'hJIhpkcJt98uiQFc2Vtg9KI3Gu2fxPw4w2nWA3YI', 'uploads/all/3Nutbqa0xVtWl0cmB135rpToN2c2hbg18KQ22ctQ.jpg', 9, 15667, 'jpg', 'image', '2023-05-25 03:13:41', '2023-05-25 03:13:41', NULL),
(8, 'jZekgIxkQqFs84SSOeXsdFXz8JfoSNVu5CuBEjTD', 'uploads/all/HJFXm2zzID7qFZ831FW2liz7VkHMY4KFl3xNsPwJ.png', 9, 31863, 'png', 'image', '2023-05-25 03:13:43', '2023-05-25 03:13:43', NULL),
(9, 'footer_logo', 'uploads/all/NsAz7x0aMyIdHRAOVE2KZeVqoOuHJ3WstyF0vhZe.png', 9, 6873, 'png', 'image', '2023-05-25 03:13:43', '2023-05-25 03:13:43', NULL),
(10, 'fg02RUZTggvmtwJ3798sX7gRP1brvSjxQ1TWqmXb', 'uploads/all/ed3XyxFsppKGIWXCwiQ5blevs8zV3S8wKjCHsZFS.png', 9, 3436, 'png', 'image', '2023-05-25 03:13:44', '2023-05-25 03:13:44', NULL),
(11, 'frqzKGwRT631A3d7kKqEbBQOc8LQ9Ty2iA2YnDcC', 'uploads/all/9GpKoaKy5WtZXPnHiUTnEEeBhtJI8ibnZS8eOKet.png', 9, 51766, 'png', 'image', '2023-05-25 03:13:44', '2023-05-25 03:13:44', NULL),
(12, 'Z53wVOdykyMQWSFlSxSTh7CRIOBIjexglvkEcGOg', 'uploads/all/M7CIKIqyfbla7NDySGMxuQXAYnuSWtwdOeDUOviW.png', 9, 5950, 'png', 'image', '2023-05-25 03:13:45', '2023-05-25 03:13:45', NULL),
(13, 'fQS0kz227gURSzidCSGFy1a1WhHjVqzKcNI489gv', 'uploads/all/AJPfzNcy1cBFu2UZBjfqonQAq5h2cbQqFOD82Hox.png', 9, 95579, 'png', 'image', '2023-05-25 03:13:45', '2023-05-25 03:13:45', NULL),
(14, 'WRHk1CJWpeSDumeMKwasyHxCbxfUWt0B5y4oVZN3', 'uploads/all/Wyi3XlOPymYNx2hGinL4zmVHl6tCuQncbcss1ls8.png', 9, 62761, 'png', 'image', '2023-05-25 03:13:46', '2023-05-25 03:13:46', NULL),
(15, 'cpNHS0RwYJw1giBIbfd5yGSkUepuFrZL3cpYdjpj', 'uploads/all/f9oyW4b2hX6xZiDT0eqljwi5uwh5oF1cXMHzRdZi.png', 9, 144189, 'png', 'image', '2023-05-25 03:13:46', '2023-05-25 03:13:46', NULL),
(16, 'Tpc4vPqYvg7JvefqvJ3Ul92UUZdjfcvFHMgtWXfZ', 'uploads/all/cOs3Pbfwsu7whrnfXxkiC7YFVSOadzmck7TtJFkb.png', 9, 97754, 'png', 'image', '2023-05-25 03:13:47', '2023-05-25 03:13:47', NULL),
(17, 'ML1Mo0cTf7SpZCKxx9XJfjZuaf1TfMtCJRbXpO8e', 'uploads/all/2A0Euu9xi6LMVLH5rk1BzrashYAHurugTPszumWO.png', 9, 170570, 'png', 'image', '2023-05-25 03:13:48', '2023-05-25 03:13:48', NULL),
(18, 'ZqhrzojwUmOosBhI97ztqf2IbXEWIWJKJG54DioM', 'uploads/all/YsYAagiEnq6WIa5gqHBNWCwqiHusFjQsd5yIOvad.png', 9, 375429, 'png', 'image', '2023-05-25 03:13:49', '2023-05-25 03:13:49', NULL),
(19, 'UcsFq48T1fNrXssxVAebruyLLv1xeamIB186YUo7', 'uploads/all/EofSQqj1BwyDIfoFe66WulZ284N1ffB3K3KREKsV.png', 9, 348889, 'png', 'image', '2023-05-25 03:13:49', '2023-05-25 03:13:49', NULL),
(20, '4m4PqGhKjB1GKGQlnbuN3aYur1UETr20H3ukcxu7', 'uploads/all/0JSifEkqHJeOfWQNDqShigg85TuaITOvW4MwaaOF.png', 9, 8919, 'png', 'image', '2023-05-25 03:13:50', '2023-05-25 03:13:50', NULL),
(21, 'OCIhtkJkr7udPk8lyJ174yuo9QEvAIZMocxPIcgn', 'uploads/all/S2ciWVyZAf78eNoZ0QniDxQ1HdF4Fa3ekrG7x9Kj.png', 9, 352339, 'png', 'image', '2023-05-25 03:13:51', '2023-05-25 03:13:51', NULL),
(22, '9o1YtFuDFNhrvIYs5a1rGfLQBwSoATbiEvrgpTsb', 'uploads/all/JTi68GfNLbVNZwbTrjQwSJlQ29KKCofzUQit2TSN.png', 9, 79580, 'png', 'image', '2023-05-25 03:13:51', '2023-05-25 03:13:51', NULL),
(23, 'J1SeaPT6672bSOuBIwL4UxYMmRwnTiElLpwdMBXb', 'uploads/all/S78z0ZK2yPDhkZjXSEpa04BRnLMHW4g830ViacuH.png', 9, 145604, 'png', 'image', '2023-05-25 03:13:52', '2023-05-25 03:13:52', NULL),
(24, 'P4uoC8VYbVQHgrGmItsw04wIY49MB9mvkzPrDwIy', 'uploads/all/zR8pRwTxr232Q5mziLvZzHJKcVZHuIzsW6hSffiU.png', 9, 497580, 'png', 'image', '2023-05-25 03:13:54', '2023-05-25 03:13:54', NULL),
(25, 'HxoiH80GqQw0ly4GqnjrB4PBkusWKhjpqjirjR1u', 'uploads/all/i3lYiCr3MsCkAKHetczUz71M0gDB2aevlEfbQ3bP.png', 9, 678563, 'png', 'image', '2023-05-25 03:14:00', '2023-05-25 03:14:00', NULL),
(26, 'eeWPRTc9zrFO14FHxkRffyo8bIQQBFSbvKd5KvKm', 'uploads/all/9HsPZkZj40BA9eKewX8Y5v9If6ajwS0kbkYqDxDk.png', 9, 154033, 'png', 'image', '2023-05-25 03:34:25', '2023-05-25 03:34:25', NULL),
(27, '2mM3lkZk8qsLvCSHMh7NjMRIVKzohuUwuzfnJwVQ', 'uploads/all/adhNpuIucb0gvZXB0bAkdCquPC0NyxGIkiMsNWgd.png', 9, 9539, 'png', 'image', '2023-05-25 03:34:25', '2023-05-25 03:34:25', NULL),
(28, 'CBwnIC6FtdnziDBoxnry5lRKILgth0tUe0ChXhFs', 'uploads/all/rmXVlcFJ7AIcS1aKr3xxHusN52iAymA8cXTbEbbO.png', 9, 6781, 'png', 'image', '2023-05-25 03:34:26', '2023-05-25 03:34:26', NULL),
(29, 'xMBS1SH8qPrmxa05pli3PitI9tBImiNh2cIPIxE2', 'uploads/all/0EE9ethfQBpsJgjhy0kUJQ2V7iarucEjUV3OQD1N.png', 9, 5438, 'png', 'image', '2023-05-25 03:34:26', '2023-05-25 03:34:26', NULL),
(30, 'QNHaqg1mPfLiKWzOssx9RDRYA1iVdOfAnfi6ohz3', 'uploads/all/qc6RDCSYWP3cEdcPw0F0lhLSKTUkMevofmZW8kb7.png', 9, 11854, 'png', 'image', '2023-05-25 03:34:27', '2023-05-25 03:34:27', NULL),
(31, 'lVHXtOecr8eoH4jjMin2KlhmocOc9jcYqLKb4psq', 'uploads/all/KVoff74S8XUulQJ3dKcEtHcjKuUeIGwMx1oSRLi4.png', 9, 3156, 'png', 'image', '2023-05-25 03:34:27', '2023-05-25 03:34:27', NULL),
(32, 'oCJtWXAflpO6DI4tilqQFISqn9VuL5rL15hUCrNb', 'uploads/all/IvOzKjbRSoAplI7LtCNULBqQ5Em5dixKEesl7BRd.png', 9, 7807, 'png', 'image', '2023-05-25 03:34:28', '2023-05-25 03:34:28', NULL),
(33, 'pTwhSDz73TkAOsjCnKEu4Ou734UbrYYnhUD1yPMo', 'uploads/all/iM179motsfVk0dHrhQse17Me8Xrxp1gEeWinW0ei.png', 9, 4801, 'png', 'image', '2023-05-25 03:34:28', '2023-05-25 03:34:28', NULL),
(34, '3Fs4oHz6S4YtbH6PrNbC11CUW8taapI5CTdF6qOl', 'uploads/all/PEfbxNP8mKW6wLxEo6C43HJv8WgFbR5HBqLdCt8t.png', 9, 6338, 'png', 'image', '2023-05-25 03:34:29', '2023-05-25 03:34:29', NULL),
(35, 'DFtWXLhPnlpXaUX1cu1gx0VwUu9vtskvtKZYJmkg', 'uploads/all/FrqSFJi904nt5E5fKW4ed5T2HGSMW9Ttqr5Zag4C.png', 9, 11325, 'png', 'image', '2023-05-25 03:34:29', '2023-05-25 03:34:29', NULL),
(36, 'AkDFcB62ytvuf0O9oTgMrrqRngM3eOd89A01hWbr', 'uploads/all/f8h963nlRvhSrZdSM3b7v6R6Ff6cRwpFmmbQx4E5.png', 9, 6022, 'png', 'image', '2023-05-25 03:34:30', '2023-05-25 03:34:30', NULL),
(37, 'QcQyKySt1OeONEqvwxAxMmxWbLL0Bu7BPeeFrypl', 'uploads/all/BruVb9KKiWnzNpfnS4bPsl1VHtXHwwzqblaVqSbO.png', 9, 6176, 'png', 'image', '2023-05-25 03:34:30', '2023-05-25 03:34:30', NULL),
(38, 'KYGQkCwlmC2qiQsYCdtg4fKgrgOCzFNht4kClPqZ', 'uploads/all/GYbWgXTqX7LokiQHpypvob4wbeW0hZtPA7tSw9Jg.png', 9, 7004, 'png', 'image', '2023-05-25 03:34:31', '2023-05-25 03:34:31', NULL),
(39, '8WhWp697sSUqYVn5WCAe9cdktnCBJN90DxCmcttb', 'uploads/all/wALTkDa2owvy2omYcf2fMF9YOnJiXhGzfD9vFDgg.png', 9, 4845, 'png', 'image', '2023-05-25 03:34:31', '2023-05-25 03:34:31', NULL),
(40, 'PogoT2zIDM1bujhekeeNuP7mt8RULdXcgHRQcA0n', 'uploads/all/Mu5FCWofHNvJb7XOYBLkkm4NmzBTgnRH905a9UJX.png', 9, 4488, 'png', 'image', '2023-05-25 03:34:32', '2023-05-25 03:34:32', NULL),
(41, '1C0sFpzhbhTwaLCMIKENFBNFuRKddtyVPKQYej0K', 'uploads/all/1uxEtsG9wDOmnx5p7rMV53Htg6hNqII3BAzIQTOt.png', 9, 4842, 'png', 'image', '2023-05-25 03:34:32', '2023-05-25 03:34:32', NULL),
(42, '3KwTF4KbGxYj8z26E0o6arIWA9OP5ib0XQ2Dr7Tx', 'uploads/all/BFYHGgpAeIuJzrDBIdGEpRf3Y4e1zrZBy6pNiZQK.png', 9, 12147, 'png', 'image', '2023-05-25 03:34:33', '2023-05-25 03:34:33', NULL),
(43, 'nBESLPmUbLHHSJJOk7N6Twex5ZecHmtyA0xlpPCC', 'uploads/all/Jsn8yqEKpzftvRiAO39eQkLioIEwKJUOgRn4xOib.png', 9, 7355, 'png', 'image', '2023-05-25 03:34:33', '2023-05-25 03:34:33', NULL),
(44, 'l2XD7LlIMnZJG2h47S2u4OFUDli4FfTkgrmLPHqU', 'uploads/all/968qy4AFGRUDO5xyClIyEQcVJ2Z7jZyZJ01ec4bf.png', 9, 8034, 'png', 'image', '2023-05-25 03:34:34', '2023-05-25 03:34:34', NULL),
(45, 'MkjPvUzo5hVMFHjZN7muKFuPjdXJt61QVeVhe0tj', 'uploads/all/L1xurULBqKsARaU48iT4zYtwh39hsqHb1XfHoSgO.png', 9, 9082, 'png', 'image', '2023-05-25 03:34:34', '2023-05-25 03:34:34', NULL),
(46, 'qCRqV1EGJuiVe6OtdXiWrIHHATW3gEOJq93dGkiy', 'uploads/all/QmbMrHcEVDentkIrHCFkxkuKoumeT5vxzWmzti8m.png', 9, 10939, 'png', 'image', '2023-05-25 03:34:35', '2023-05-25 03:34:35', NULL),
(47, 'zYUl1sEjdJQvgqxi3XMghoj4s8IwEOBPlY4l8dSJ', 'uploads/all/U9OywhMZ3tIKTRJbwuuEPwcugtANe9rQaculYLkb.png', 9, 8245, 'png', 'image', '2023-05-25 03:34:35', '2023-05-25 03:34:35', NULL),
(48, 'vDAtTPyNT7ndAVO0azss067xJg1CcA7BXnG69ioU', 'uploads/all/IA7DExmK6XkkWfKSiZwS8QoJzkOlMEhuOW2J7pZM.png', 9, 3121, 'png', 'image', '2023-05-25 03:34:36', '2023-05-25 03:34:36', NULL),
(49, '4SVs4cmJhKlgg2VngyBmVk4fPVi81HoVOSsuZKLU', 'uploads/all/X6reK3TEJskbc4JhfvwsiSryrE45420MaDUS8Spk.png', 9, 9943, 'png', 'image', '2023-05-25 03:34:36', '2023-05-25 03:34:36', NULL),
(50, '6xalYblEcshqt3UIViX8UacRfLLuTDbdDXJSElgp', 'uploads/all/1U4uTRbGZZrc75ZTqzSqE721jvDPF0Os42Rm169m.png', 9, 2073, 'png', 'image', '2023-05-25 03:34:36', '2023-05-25 03:34:36', NULL),
(51, 's7CHUbQHpKiLuwRkcDD3DlPDRwNz90asDIgGR5QF', 'uploads/all/Cvlo1rTEl240f2lHVCXKDHFvg888JnAcdZ3OnLvV.jpg', 9, 2932, 'jpg', 'image', '2023-05-25 03:34:37', '2023-05-25 03:34:37', NULL),
(52, '3Rt1NHyjiCtuE4PpjUcFpVoM39QxIScjJ8Va7FfU', 'uploads/all/BR6Wx2du3PrihRKkGWhAZxUuwloSzWsuCWtNtqpF.jpg', 9, 2713, 'jpg', 'image', '2023-05-25 03:34:37', '2023-05-25 03:34:37', NULL),
(53, '3SWRddZ8dZjYfDEKb1y5lKTMqNQLL2KMLTTQAMdZ', 'uploads/all/E5eEvxwC3ocmmr142OQ9VA03vX6nQwHDHeH86tNX.jpg', 9, 2654, 'jpg', 'image', '2023-05-25 03:34:38', '2023-05-25 03:34:38', NULL),
(54, 'XE65L3zrpa0SgQ5mUCCEpLjTTYs8gNHKQk9OYNiN', 'uploads/all/KTfTApcvo4vymzwDPWOf5coSXca5DGliekxocpk6.png', 9, 12042, 'png', 'image', '2023-05-25 03:41:07', '2023-05-25 03:41:07', NULL),
(55, 'jZekgIxkQqFs84SSOeXsdFXz8JfoSNVu5CuBEjTD (1)', 'uploads/all/wuWbLJT1cklDnrnSibr6qFzlpu2r1sGorVUZc7hs.png', 9, 31863, 'png', 'image', '2023-05-25 04:38:54', '2023-05-25 04:38:54', NULL),
(56, 'site-icon', 'uploads/all/ZvIYUHDuFjBIe4VB6LohtFBZrzRGbD2hxThjcDiH.png', 9, 3436, 'png', 'image', '2023-05-25 04:44:34', '2023-05-25 04:44:34', NULL),
(57, 'tqshfRF7CasuFqiCTuj7BeRZc50keUIWcUa2TSn0', 'uploads/all/ogdZz4II59yh7dRveZcOcQnxdpxddYRJPDnqPvnA.png', 9, 44945, 'png', 'image', '2023-05-25 06:35:07', '2023-05-25 06:35:07', NULL),
(58, '0yuIktHhf7IunTtGwi5XqTm0RPrduvRJa28ufqos', 'uploads/all/YXcjlGxMVY69yAuULNpPikfmJ3jlZjfIuBnBEseX.png', 9, 94344, 'png', 'image', '2023-05-25 06:36:18', '2023-05-25 06:36:18', NULL),
(59, 'eKKCp8sclU7Q8aURfq6w3ph1fKnnSzXZPRPe2CW9', 'uploads/all/xJYg0GCZjM0xfDJmqRUm9GRJT28eXeqcGOAzIIaT.jpg', 9, 63823, 'jpg', 'image', '2023-05-25 16:01:30', '2023-05-25 16:01:30', NULL),
(60, 'fHY6lOBi5ej0FCkVquIEERoouVDb1LL4ZaVbI7MD', 'uploads/all/7opbnUEwjtRDWSrAiAJyiHYJZO8qnC8o7auJvPba.jpg', 9, 92742, 'jpg', 'image', '2023-05-25 16:01:31', '2023-05-25 16:01:31', NULL),
(61, 'H5Z5mJzuYstqKZsc5DLQ4wQ5LZHkoFrNu3DL3iDq', 'uploads/all/4OenZcfwP6Ca6St3I9TGKLtzelLh1GjIzJ74Pk4I.jpg', 9, 191318, 'jpg', 'image', '2023-05-25 16:01:32', '2023-05-25 16:01:32', NULL),
(62, 'OCIhtkJkr7udPk8lyJ174yuo9QEvAIZMocxPIcgn', 'uploads/all/najHo03t8nXw0aUNaIIqSw7TX1pvjjZK5bIEW21G.png', 9, 353525, 'png', 'image', '2023-05-25 20:39:50', '2023-05-25 20:39:50', NULL),
(63, 'eKKCp8sclU7Q8aURfq6w3ph1fKnnSzXZPRPe2CW9', 'uploads/all/gwpJQ1SP398udRaIpE0Mm4Ks07MOAoWqnHR9iyFC.jpg', 3, 63823, 'jpg', 'image', '2023-05-25 20:56:34', '2023-05-25 20:56:34', NULL),
(64, 'fHY6lOBi5ej0FCkVquIEERoouVDb1LL4ZaVbI7MD', 'uploads/all/NDEtUbJzO3tcH410ovueZUaty7MLFagY5KeqVggK.jpg', 3, 92742, 'jpg', 'image', '2023-05-25 20:56:35', '2023-05-25 20:56:35', NULL),
(65, 'H5Z5mJzuYstqKZsc5DLQ4wQ5LZHkoFrNu3DL3iDq', 'uploads/all/IuTAK2Owua28pvEbqaXrN7BwCKA0nagYJZlKNTRr.jpg', 3, 191318, 'jpg', 'image', '2023-05-25 20:56:36', '2023-05-27 10:28:27', '2023-05-27 10:28:27'),
(66, '4SVs4cmJhKlgg2VngyBmVk4fPVi81HoVOSsuZKLU', 'uploads/all/6XNTUHpUSPdBCG1l49WCDUokHo02DGlW0AHLhgmH.png', 3, 10879, 'png', 'image', '2023-05-25 21:07:25', '2023-05-25 21:07:25', NULL),
(67, '6xalYblEcshqt3UIViX8UacRfLLuTDbdDXJSElgp', 'uploads/all/mUMrh58VFWNjHXmxdtpBMjsLuxQ9bEJ2HEoOTFy0.png', 3, 2952, 'png', 'image', '2023-05-25 21:07:25', '2023-05-25 21:07:25', NULL),
(68, 'Tpc4vPqYvg7JvefqvJ3Ul92UUZdjfcvFHMgtWXfZ', 'uploads/all/MagfGZbwalqoUAWucQ3OzseDJSmWQnM6oxRBOrBy.png', 3, 98936, 'png', 'image', '2023-05-25 21:09:20', '2023-05-25 21:09:20', NULL),
(69, 'P4uoC8VYbVQHgrGmItsw04wIY49MB9mvkzPrDwIy', 'uploads/all/fhJu9DWOm1UxtNQfb9RW3AQzYEG2lHzbQYIe5uQG.png', 3, 498755, 'png', 'image', '2023-05-25 21:10:57', '2023-05-25 21:10:57', NULL),
(70, 'team-2', 'uploads/all/59Nf8zlfOVdWKrb659zfFLEuNbZQ1sZtcbbwIihS.jpg', 1, 63380, 'jpg', 'image', '2023-05-26 18:37:00', '2023-05-26 18:37:00', NULL),
(71, 'avatar-place', 'uploads/all/yRetqygX6loZxd9X0Q5ljsqfLirCOQRthtpjin0l.png', 1, 2193, 'png', 'image', '2023-05-26 18:37:01', '2023-05-26 18:37:01', NULL),
(72, 'image-2', 'uploads/all/y5Ca4UF2ELKKGtdc08jQf8vqv1yI3uzNAO3WZBZm.png', 1, 1001, 'png', 'image', '2023-05-26 18:37:01', '2023-05-26 18:37:01', NULL),
(73, 'image-3', 'uploads/all/nkOLiUyhs61whjVleC4aTa6nl2jqeYkSAypFCDb5.png', 1, 2367, 'png', 'image', '2023-05-26 18:37:02', '2023-05-26 18:37:02', NULL),
(74, 'image-4', 'uploads/all/bmCsx4sFSnOZtSGm0X8zodis5MgHvRQUUFpSxAcO.png', 1, 1602, 'png', 'image', '2023-05-26 18:37:02', '2023-05-26 18:37:02', NULL),
(75, 'welcome', 'uploads/all/X0NBAUvR5b6vQFumGVzoCfTmtzHK0ou3Wh3T9MMz.jpg', 1, 103492, 'jpg', 'image', '2023-05-26 18:37:03', '2023-05-26 18:37:03', NULL),
(76, 'verified', 'uploads/all/FoB75RjFa97gAitzmkhGxCywQaCYOoEVUDEodbFu.png', 1, 150422, 'png', 'image', '2023-05-26 18:37:04', '2023-05-26 18:37:04', NULL),
(77, 'play', 'uploads/all/wr8sRn7adD3jAt35886CPclHnFpWQLlnqMOknU3J.png', 1, 13567, 'png', 'image', '2023-05-26 18:37:04', '2023-05-26 18:37:04', NULL),
(78, 'logo_app', 'uploads/all/XKjhHfq1sXUuPAemgYYHO102xr5C6weLbsilIIvR.png', 1, 58976, 'png', 'image', '2023-05-26 18:37:05', '2023-05-26 18:37:05', NULL),
(79, 'team-1', 'uploads/all/B5KfVcxZ86mp80zglDvcDzijhyXN9urWHIgU2buj.jpg', 1, 51306, 'jpg', 'image', '2023-05-26 18:37:06', '2023-05-26 18:37:06', NULL),
(80, 'non_verified', 'uploads/all/CAk7QA0fNYo8z0ynBvx34S7RZqc2wJT1yS8vEcyX.png', 1, 149796, 'png', 'image', '2023-05-26 18:37:07', '2023-05-26 18:37:07', NULL),
(81, 'bg', 'uploads/all/GR32mJ3tBgvS5j34go6kEyAtv1kp3qwqf9k5u4UP.jpg', 1, 322134, 'jpg', 'image', '2023-05-26 18:37:08', '2023-05-26 18:37:08', NULL),
(82, '20221219_101221', 'uploads/all/DxM1CNm58FasoSHfZclL4oWHsx7FTIIYTquLrIAp.jpg', 1, 24875, 'jpg', 'image', '2023-05-26 18:37:45', '2023-05-26 18:37:45', NULL),
(83, 'colorblock-tee-back', 'uploads/all/CrQL1mogFMu0HDZS2nHn7oKseiKBtSMlZp3KzCvt.jpg', 1, 63823, 'jpg', 'image', '2023-05-26 18:50:33', '2023-05-26 18:50:33', NULL),
(84, 'colorblock-tee-front', 'uploads/all/gRaUDMl7nzVdarTey40vMnWsn8MKlM697BrRBGkB.jpg', 1, 92742, 'jpg', 'image', '2023-05-26 18:50:34', '2023-05-26 18:50:34', NULL),
(85, 'colorblock-tee', 'uploads/all/1ShKZMKzAVXZEyzrO5q0l2HcgU6DfUFbOAw9UC3B.jpg', 1, 191318, 'jpg', 'image', '2023-05-26 18:50:35', '2023-05-26 18:50:35', NULL),
(86, 'YpB3py3hu85f2OnBEG2H9ZnI2KdxQhXUy7ClRzeZ', 'uploads/all/G9m1juvLabVpaQUmgjTsGuVR4mOvaWGxjrH3ffBn.jpg', 1, 30910, 'jpg', 'image', '2023-05-27 10:23:26', '2023-05-27 10:23:26', NULL),
(87, '3N1qNBrfErFFahqN4Ufw0s1p5LzfCkgaMR6oGnt7', 'uploads/all/cWYZrnWuzgQ6Cpkfve6QGW2ohAf3d4AfRrlgEbUU.jpg', 1, 29562, 'jpg', 'image', '2023-05-27 10:23:27', '2023-05-27 10:23:27', NULL),
(88, 'm4KSGALAgNlJDWe5AHSgr5mFD62jpOOZV7kMTtRx', 'uploads/all/wlhaVlmUJwC32ZBHHw2nxukLJE6S4hpCZu1a6x3w.jpg', 1, 30406, 'jpg', 'image', '2023-05-27 10:23:28', '2023-05-27 10:23:28', NULL),
(89, 'C4CH7akWJ3olNi8hPNxVk35jcByLNqsLZIId7C7m', 'uploads/all/9OXoLTEJraAfYkowXW9AfRt3VEpGWVNQfrwgo47R.jpg', 1, 26611, 'jpg', 'image', '2023-05-27 10:23:28', '2023-05-27 10:23:28', NULL),
(90, '24vbkOYo8LvCM0Bc4GFVW5o4TQkPExc1n1AQyF4I', 'uploads/all/4GICPGYctlBpQ6GNRYa38vKRCwipfD1l4A3KZikn.jpg', 1, 22947, 'jpg', 'image', '2023-05-27 10:23:29', '2023-05-27 10:23:29', NULL),
(91, 'zNuicaIlnFqAg1xvGy2bZfUPgwG0g772aSyhcioY (1)', 'uploads/all/394rym4w62YcYSTBmL2KnjU6RosLEvBjPAIvL3DS.jpg', 1, 45062, 'jpg', 'image', '2023-05-27 10:23:30', '2023-05-27 10:23:30', NULL),
(92, 'DqtmZllkqdXTapwr79SQFl1tKKOCiJEpcNEl9e9u', 'uploads/all/0OEUohVgxPyoitcLr4ojFuqdDeRy3ZFYsegM0Bbd.jpg', 1, 37111, 'jpg', 'image', '2023-05-27 10:23:30', '2023-05-27 10:23:30', NULL),
(93, 'MMv2BVSr7YzLikvNK151r9Y3ywjmip9GkoorJaP1', 'uploads/all/4Em2sZCceukhp4olQOKvtEUPrxBGjPs4Z7HEfqLD.jpg', 1, 29080, 'jpg', 'image', '2023-05-27 10:23:31', '2023-05-27 10:23:31', NULL),
(94, 'e1Kl8PZO307zEiXglPSPRjBvLHhpvJfMQpmdSuBg', 'uploads/all/cVtgiOd6ZAan0OBUZLqXJxyJcyHqIhdGDc2lAH9a.jpg', 1, 48857, 'jpg', 'image', '2023-05-27 10:23:32', '2023-05-27 10:23:32', NULL),
(95, '7Q8rHEraOEHHQgXZyj77zpYvE1Knbra4xDnjsbz1', 'uploads/all/S8cg4UOLUtsolWRSkBqLCLt1Fa86r5V5MpLOLCGv.jpg', 1, 45062, 'jpg', 'image', '2023-05-27 10:23:32', '2023-05-27 10:23:32', NULL),
(96, '5OHRMuH6ht9xU9kDqvrMcIrRzbptLUGT1r2iWr36', 'uploads/all/rPvFSf3voyRbrtu2x3smuzRUlQJgHlwRu3O8eV9Y.jpg', 1, 25848, 'jpg', 'image', '2023-05-27 10:23:33', '2023-05-27 10:23:33', NULL),
(97, 'rIggj9XqTC28KXaDBAhNAQhtpWakw2GHQyPxzmPM (1)', 'uploads/all/8P3GBQpJnPgG9zUSDAkZDnlOz4dVJR0RZ5rLMN4y.jpg', 1, 50012, 'jpg', 'image', '2023-05-27 10:23:34', '2023-05-27 10:23:34', NULL),
(98, '1t76a9xuMWUpH377ponNFr9xijwVJZZ1qYPfzvma', 'uploads/all/b3K2dYC6DmXlTTufwoQ0ul2iWVc5CfWiuK0FzTqs.jpg', 1, 71259, 'jpg', 'image', '2023-05-27 10:23:35', '2023-05-27 10:23:35', NULL),
(99, 'NMxIREeBekQzlATbbBbD1ZiXc32KCDuSbcFPhHfy', 'uploads/all/ftKT7i128uzbDn4X4tu8i72PIDrUAjKLnZfcyLSy.jpg', 1, 58894, 'jpg', 'image', '2023-05-27 10:24:15', '2023-05-27 10:24:15', NULL),
(100, 'q3hALymcHP2nsmn0IhVtJ9RpuVohb8dXJJIdZN6C', 'uploads/all/QX1hcwKpjdXRiSL42TnkBbZXfyrG89zcoDi7rF7O.jpg', 1, 50012, 'jpg', 'image', '2023-05-27 10:24:16', '2023-05-27 10:27:36', '2023-05-27 10:27:36'),
(101, 'ash-color-4', 'uploads/all/CjBt9xTcQCA6Nl4WBAwEA75Vbun8cqKmzE1XeqGm.jpg', 1, 41868, 'jpg', 'image', '2023-05-27 10:24:16', '2023-05-27 10:24:16', NULL),
(102, 'ash-color-3', 'uploads/all/faKFsxrinFPjHwLCJlBvF9sYr1hAD5Ppbcmyq68E.jpg', 1, 41868, 'jpg', 'image', '2023-05-27 10:24:17', '2023-05-27 10:24:17', NULL),
(103, 'ash-color', 'uploads/all/yFLQxEmWJmorBryZidBC1mTVBPCYElJcVrZqsJsF.jpg', 1, 26688, 'jpg', 'image', '2023-05-27 10:24:18', '2023-05-27 10:24:18', NULL),
(104, 'ash-color-2', 'uploads/all/kCTcorzzffhnUgRQe7qfFH6yau6tJP7iFY3LcVIe.jpg', 1, 35299, 'jpg', 'image', '2023-05-27 10:24:18', '2023-05-27 10:24:18', NULL),
(105, 'idnCIZSkF7aAlJ6HURp28hF0Bel8G0PedNJp6khN', 'uploads/all/N0i51lOtaxoR7ZUJeKSBC8Uh8KFgYc3La7euBWvB.jpg', 1, 30406, 'jpg', 'image', '2023-05-27 10:24:19', '2023-05-27 10:27:12', '2023-05-27 10:27:12'),
(106, 'rIggj9XqTC28KXaDBAhNAQhtpWakw2GHQyPxzmPM', 'uploads/all/N1DBYEDeRgpp6pYbQVN5ER0K3xYN1rfON5sZIFLK.jpg', 1, 50012, 'jpg', 'image', '2023-05-27 10:24:20', '2023-05-27 10:26:43', '2023-05-27 10:26:43'),
(107, 'zNuicaIlnFqAg1xvGy2bZfUPgwG0g772aSyhcioY', 'uploads/all/3DX0uc9PmIwRKFWhV8FmfuTJQ3RK456C3mROqlSk.jpg', 1, 45062, 'jpg', 'image', '2023-05-27 10:24:20', '2023-05-27 10:25:37', '2023-05-27 10:25:37'),
(108, 'okwqTQ9yBmlpzbPKFZWQSAKHwyCvVoUvbvgPNHvl', 'uploads/all/bkFvX1Ee0mSD8vXy6jMZuwASRhCiv2emUsUll7Gi.jpg', 1, 41868, 'jpg', 'image', '2023-05-27 10:24:21', '2023-05-27 10:26:06', '2023-05-27 10:26:06'),
(109, 'image_f51f2057-4104-4de5-990d-a30e5558b73c20230321_115703', 'uploads/all/z9t80FipdaToR6g5L6TVoPLhwFOnzsBXPWb2hxFj.jpg', 1, 137762, 'jpg', 'image', '2023-05-28 21:40:25', '2023-05-28 21:40:25', NULL),
(110, 'Tpc4vPqYvg7JvefqvJ3Ul92UUZdjfcvFHMgtWXfZ', 'uploads/all/YmcsrESnEuIsvdRPCq5zf68XGtIB5UBdywnc5Ntq.png', 1, 98936, 'png', 'image', '2023-05-29 06:10:20', '2023-05-29 06:10:20', NULL),
(111, '20221226_001233', 'uploads/all/BbVeT6Pe6okOmWahxAfRLX9m7iSbZsqo6CUi35cp.jpg', 5, 90465, 'jpg', 'image', '2023-05-29 23:36:47', '2023-05-29 23:36:47', NULL),
(112, 'Tpc4vPqYvg7JvefqvJ3Ul92UUZdjfcvFHMgtWXfZ', 'uploads/all/da60ZxH7bbcyIvdWzjJjZc0xbWn9hxUVyGGeE3cT.png', 6, 98936, 'png', 'image', '2023-06-02 22:40:09', '2023-06-02 22:40:09', NULL),
(113, '20221219_094625', 'uploads/all/LySEj5q5tZgkEEQ5Oesb4BNUOgvwmYYaBXaIyYzA.jpg', 6, 182625, 'jpg', 'image', '2023-06-02 22:41:37', '2023-06-02 22:41:37', NULL),
(114, 'fi', 'uploads/all/c9vDhMHg0h4BxP4yiHvvSuP0acsyjRYepDqpuVyv.jpg', 6, 71212, 'jpg', 'image', '2023-06-02 22:44:26', '2023-06-02 22:44:26', NULL),
(115, 'computers', 'uploads/all/j4S6foyzrYY1ExK0DnrK3qtTpWRZMrZNJHGFW3tJ.png', 1, 80762, 'png', 'image', '2023-06-07 02:19:27', '2023-06-07 02:19:27', NULL),
(116, 'computer_icon', 'uploads/all/J9b8vTq52x1rp9IUBG4YsvyRuO26nexMWtgC3p11.png', 1, 4825, 'png', 'image', '2023-06-07 02:23:05', '2023-06-07 02:23:05', NULL),
(117, 'book_icon', 'uploads/all/6OrRhHfnmaWA4y0eUs8IrkqkcdRJ2ZKdD5pFbkhy.png', 1, 1600, 'png', 'image', '2023-06-07 02:27:27', '2023-06-07 02:27:27', NULL),
(118, 'books', 'uploads/all/wzcK16gfcObsS1jfSzpkBTJc50EuzHboVkRD2BIk.png', 1, 146786, 'png', 'image', '2023-06-07 02:27:28', '2023-06-07 02:27:28', NULL),
(119, 'electronics_icon', 'uploads/all/z1V20NopudmrIx9OiDx49JWb3upOPrpVIPOnWx92.png', 1, 4181, 'png', 'image', '2023-06-07 02:31:52', '2023-06-07 02:31:52', NULL),
(120, 'electronics', 'uploads/all/mlArnVLGLqcEW5F3gylpEki6JB3nJfLmzjKYNpSj.png', 1, 63943, 'png', 'image', '2023-06-07 02:31:53', '2023-06-07 02:31:53', NULL),
(121, 'gift_card icon', 'uploads/all/6WorOMMuNJw14if09Oqn9Iif09PlgrB8ScaDjI31.png', 1, 16427, 'png', 'image', '2023-06-09 00:03:25', '2023-06-09 00:03:25', NULL),
(122, 'gift', 'uploads/all/ZkMsvrGOf6gYe2XjiL3HE0Ml38WsLPTp1srlpobU.png', 1, 6888, 'png', 'image', '2023-06-09 00:03:25', '2023-06-09 00:03:25', NULL),
(123, 'clothing', 'uploads/all/f3T8av5k0oY2cwNnBjDYPTnrKwvbLFi2KNfJeZOB.png', 1, 98936, 'png', 'image', '2023-06-09 00:12:29', '2023-06-09 00:12:29', NULL),
(124, 'clothing_icon', 'uploads/all/Owd7Uxk1qz40OAe4mX56KWxZZLHdrPUtpcgeGxvj.png', 1, 4147, 'png', 'image', '2023-06-09 00:12:30', '2023-06-09 00:12:30', NULL),
(125, 'office_icon', 'uploads/all/kOmZrmRXanQwwCRlZkpTcp7vq1kabuC1tBGfixcW.png', 1, 9533, 'png', 'image', '2023-06-09 00:26:44', '2023-06-09 00:26:44', NULL),
(126, 'office', 'uploads/all/NLqzNMrcV4iW0oArHmV6Zf4x34WNsDtmxWzED2qO.png', 1, 9857, 'png', 'image', '2023-06-09 00:26:44', '2023-06-09 00:26:44', NULL),
(127, 'sport_icon', 'uploads/all/9jwAU0I7GCaBHbgMk0vd8l0LqOlHn0omvcUDQb4F.png', 1, 4877, 'png', 'image', '2023-06-09 00:35:54', '2023-06-09 00:35:54', NULL),
(128, 'sport', 'uploads/all/Zs8lWO4DhGGCsbCNH313jMM7FWqgZjUWjueX3SPo.webp', 1, 34448, 'jpg', 'image', '2023-06-09 00:35:55', '2023-06-09 00:35:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `referred_by` int(11) DEFAULT NULL,
  `provider_id` varchar(50) DEFAULT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'customer',
  `name` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_code` text DEFAULT NULL,
  `new_email_verificiation_code` text DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `avatar` varchar(256) DEFAULT NULL,
  `avatar_original` varchar(256) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `balance` double(20,2) NOT NULL DEFAULT 0.00,
  `banned` tinyint(4) NOT NULL DEFAULT 0,
  `referral_code` varchar(255) DEFAULT NULL,
  `customer_package_id` int(11) DEFAULT NULL,
  `remaining_uploads` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `referred_by`, `provider_id`, `user_type`, `name`, `email`, `email_verified_at`, `verification_code`, `new_email_verificiation_code`, `password`, `remember_token`, `avatar`, `avatar_original`, `address`, `country`, `city`, `postal_code`, `phone`, `balance`, `banned`, `referral_code`, `customer_package_id`, `remaining_uploads`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'admin', 'Nnadi', 'admin@admin.com', NULL, 'eyJpdiI6IjVlYWNPYy9MM2VqQ2orUkE3RmlKakE9PSIsInZhbHVlIjoiSTI0bjZrd1htREk2TFBCU3lidGd1Zz09IiwibWFjIjoiMWZkNjhkNmE5MGJjNTEyZDIxOTcxMGM5NTlhMTg3OWE3YzYyYTU5MTcyMTUzM2JhYjQ2NzI4NzRhZGRiZjA2NSIsInRhZyI6IiJ9', NULL, '$2y$10$GW32NfSKwQwhij./pbosCOsAnl0Qe2X7dLm3nVzCM6PxKoKIVJPFi', 'rR8g3pVqVA5KJ8iEBeS7Cqxyqel7i4QMNRKrBD7Xqa6Zw2VqUV8stitq5MuV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, NULL, NULL, 0, '2023-05-29 22:26:14', '2023-05-29 22:26:14'),
(2, NULL, NULL, 'staff', 'Chime', 'beekyhe@gmail.com', NULL, 'eyJpdiI6IkpVNUt6VEtJcWpIT0ZWQXAvTzhjWmc9PSIsInZhbHVlIjoiQ1lDOG80Sjc1L05HVVE5eXYwYk5zUT09IiwibWFjIjoiNmU1MjdmYjMzM2FmY2FkZThlYzBjYWExMGMyNjVjZDVjMGM5OGUwZTUzMDdlYTQzZTYzNmUyOTRiOTY5MjIzMCIsInRhZyI6IiJ9', NULL, '$2y$10$9cuqD0CjC9dOwfKFUtZucubpti2ErHr3Ug8NSCGPNFdB1uc4fMot.', 'kiZUXoJri8hKrmDBgeXZqgqMs1YRAgjoS2Ccyvp9jv9uNWcw1ZIKbUWTBPX2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, NULL, NULL, 0, '2023-05-29 22:29:24', '2023-05-29 22:29:24'),
(3, NULL, NULL, 'customer', 'Ugo', 'chimennadi66@gmail.com', NULL, 'eyJpdiI6InJuUHl0OEQzOUNIOW5xb1AxVDZXWkE9PSIsInZhbHVlIjoibHdiMVBVQ2IvdHNTVVJNSlpzZjcxUT09IiwibWFjIjoiOGRiMWUxOTQ0NDkyYjI4OTVkMjc0ODY5ZTBlMTMzYzJhZTI3M2I3ZmI1ZDE2ZGQzNTA2N2MwNmRkNjk5N2VhYiIsInRhZyI6IiJ9', NULL, '$2y$10$BYohnu5mXhad86/1P0ymsuN/uRMfOa3O2.iNDVs78mDqLqzstwO9y', 'Zpy6Hk1KiYiDP9H0O3SMzKk7zA71iLxBbPa6BlBL2S9A3kkwexBO1pCx1bUi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, NULL, NULL, 0, '2023-05-29 22:31:48', '2023-05-29 22:31:49'),
(4, NULL, NULL, 'delivery_boy', 'Oly', 'olynnadi@gmail.com', NULL, 'eyJpdiI6InpLVk16NG1EbVIwK25MTncyU2liOEE9PSIsInZhbHVlIjoiR1RxK0tsQTc3Q1NqV0Z1K296ZjVtQT09IiwibWFjIjoiMjc5ZjM3OThmMmE5OWMwYzJiMWZhZTc0MWMzMjQ0ODM0OTA0YmEzNTU0OThmZjZhOGI3Nzg4NzgzYmE0YTJlOCIsInRhZyI6IiJ9', NULL, '$2y$10$0E1XjDg.BjqozasaPHoCXuo3c34kj/9s9FQ9uOKDUj.LXaBsl56LS', 'BIeAzN1vU7ss4FxwyddL2hHdcCMkhjT9mCmyaBCTBpsBVUpkPEZYn0kRPW1J', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, NULL, NULL, 0, '2023-05-29 22:35:44', '2023-05-29 22:35:44'),
(5, NULL, NULL, 'seller', 'Ada', 'ada@gmail.com', NULL, 'eyJpdiI6ImlBWWZ5emNtUTRPb3BRWmJHWUV2K0E9PSIsInZhbHVlIjoicE5wMGF6emNDYXVzb0x5Smh3TFJOZz09IiwibWFjIjoiYTkyNDE5Y2NkMjMxOTdjY2QwZGYxZWU3NmQxOTlmMDQ0MGMyYTU5MWY2MTZlZTkyY2EwMjZjZjgwYTJjZTU1OCIsInRhZyI6IiJ9', 'SmsQ9iBFcklg9JjN5lGAYWxF5W4IDtNh', '$2y$10$u1bBhvcbn/H3xRDXqMd9u.eNd2C0G4JcyBy2GV.HkXYymLhhPnQIG', 'tqXwA4mKXgSTv4o8lTrKHdJZ9DAgXvFqXPO4HsNJaQENqnoxYnzSHPv6hKVE', NULL, '111', NULL, NULL, NULL, NULL, '09033688922', 0.00, 0, NULL, NULL, 0, '2023-05-29 23:11:10', '2023-05-29 23:37:54'),
(6, NULL, NULL, 'logistic', 'Ife', 'ife@gmail.com', NULL, 'eyJpdiI6IlJiQ2lqUFliQ1orMGI0MythcVE3ZEE9PSIsInZhbHVlIjoid1dldmU2L3JFWmxRcnZzZ2xVdzVEUT09IiwibWFjIjoiOWFmODg3M2VjYTY2MTA0NmQ2NmYxMjUzYjhkNGEwYmVhN2VmNDJmOWI1NjgxYjVlZWNmYmI4ZmE1NTYxOTY4OCIsInRhZyI6IiJ9', NULL, '$2y$10$Nth4iUpKN9Rvi.UcQMGBYuoflInddp62YThN2CUJtE1iu1G3Xlt1.', 'RrxHp1ROmX4ZadZKfg0nZXPHk1Zax8xVDWpnq2WDFl4NuaG37ajCGzGlCjNf', NULL, '113', '234-CFSD Mall', NULL, NULL, NULL, '09033688922', 0.00, 0, NULL, NULL, 0, '2023-05-30 07:30:51', '2023-06-03 23:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_details` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_translations`
--
ALTER TABLE `attribute_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_translations`
--
ALTER TABLE `brand_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `city_translations`
--
ALTER TABLE `city_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_histories`
--
ALTER TABLE `commission_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_packages`
--
ALTER TABLE `customer_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_package_payments`
--
ALTER TABLE `customer_package_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_package_translations`
--
ALTER TABLE `customer_package_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_products`
--
ALTER TABLE `customer_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_product_translations`
--
ALTER TABLE `customer_product_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_boys`
--
ALTER TABLE `delivery_boys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_deals`
--
ALTER TABLE `flash_deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_deal_products`
--
ALTER TABLE `flash_deal_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_deal_translations`
--
ALTER TABLE `flash_deal_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_categories`
--
ALTER TABLE `home_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logistics`
--
ALTER TABLE `logistics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `logistic_sales`
--
ALTER TABLE `logistic_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickup_points`
--
ALTER TABLE `pickup_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickup_point_translations`
--
ALTER TABLE `pickup_point_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `tags` (`tags`(255));

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_taxes`
--
ALTER TABLE `product_taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_translations`
--
ALTER TABLE `product_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proxypay_payments`
--
ALTER TABLE `proxypay_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_translations`
--
ALTER TABLE `role_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `searches`
--
ALTER TABLE `searches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `seller_withdraw_requests`
--
ALTER TABLE `seller_withdraw_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_details`
--
ALTER TABLE `shipping_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attribute_translations`
--
ALTER TABLE `attribute_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `brand_translations`
--
ALTER TABLE `brand_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=775;

--
-- AUTO_INCREMENT for table `city_translations`
--
ALTER TABLE `city_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `commission_histories`
--
ALTER TABLE `commission_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_packages`
--
ALTER TABLE `customer_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_package_payments`
--
ALTER TABLE `customer_package_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_package_translations`
--
ALTER TABLE `customer_package_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_products`
--
ALTER TABLE `customer_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_product_translations`
--
ALTER TABLE `customer_product_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_boys`
--
ALTER TABLE `delivery_boys`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flash_deals`
--
ALTER TABLE `flash_deals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `flash_deal_products`
--
ALTER TABLE `flash_deal_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `flash_deal_translations`
--
ALTER TABLE `flash_deal_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_categories`
--
ALTER TABLE `home_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logistics`
--
ALTER TABLE `logistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logistic_sales`
--
ALTER TABLE `logistic_sales`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `page_translations`
--
ALTER TABLE `page_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickup_points`
--
ALTER TABLE `pickup_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickup_point_translations`
--
ALTER TABLE `pickup_point_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_taxes`
--
ALTER TABLE `product_taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `product_translations`
--
ALTER TABLE `product_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `proxypay_payments`
--
ALTER TABLE `proxypay_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_translations`
--
ALTER TABLE `role_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `searches`
--
ALTER TABLE `searches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seller_withdraw_requests`
--
ALTER TABLE `seller_withdraw_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_details`
--
ALTER TABLE `shipping_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1853;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `FK` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
