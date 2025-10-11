-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2025 at 01:20 PM
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
-- Database: `global_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `brand_name` varchar(191) NOT NULL,
  `is_mega_menu` int(11) NOT NULL DEFAULT 1,
  `image` varchar(191) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `user_id`, `brand_name`, `is_mega_menu`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'NS8', 1, 'uploads/brands/175974336211.png', 'Active', '2025-10-06 03:36:02', '2025-10-06 03:36:02'),
(2, 1, 'Elegant Auto Group', 1, 'uploads/brands/175974338312.png', 'Active', '2025-10-06 03:36:23', '2025-10-06 03:36:23'),
(3, 1, 'Sky Suite', 1, 'uploads/brands/175974339813.png', 'Active', '2025-10-06 03:36:38', '2025-10-06 03:36:38'),
(4, 1, 'RED', 1, 'uploads/brands/175974340714.png', 'Active', '2025-10-06 03:36:47', '2025-10-06 03:36:47'),
(5, 1, 'Green Grass', 1, 'uploads/brands/175974376615.png', 'Active', '2025-10-06 03:37:02', '2025-10-06 03:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `brand_category`
--

CREATE TABLE `brand_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_session_id` varchar(191) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `productvariant_id` int(11) DEFAULT NULL,
  `productvariant_ids` varchar(191) DEFAULT NULL,
  `cart_qty` int(11) NOT NULL,
  `unit_total` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `cart_session_id`, `product_id`, `productvariant_id`, `productvariant_ids`, `cart_qty`, `unit_total`, `created_at`, `updated_at`) VALUES
(3, '49321', 6, NULL, '[\"1\",\"1\",\"4\"]', 3, '2840.04', '2025-10-11 01:01:00', '2025-10-11 01:01:00'),
(4, '49321', 4, NULL, 'null', 2, '703.50', '2025-10-11 03:08:35', '2025-10-11 03:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `is_top` tinyint(4) NOT NULL DEFAULT 0,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `is_homepage` tinyint(4) NOT NULL DEFAULT 0,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `category_name`, `image`, `is_top`, `is_featured`, `is_homepage`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sports', 'uploads/categories/17597338591category-4.jpg', 1, 1, 1, 'Active', '2025-10-06 00:57:39', '2025-10-09 01:46:22'),
(2, 1, 'Cloths', 'uploads/categories/17597338881category-1.jpg', 1, 0, 0, 'Active', '2025-10-06 00:58:08', '2025-10-06 00:58:08'),
(3, 1, 'Cameras', 'uploads/categories/17597339491category-7.jpg', 1, 1, 0, 'Active', '2025-10-06 00:59:09', '2025-10-06 00:59:09'),
(4, 1, 'Sneakers', 'uploads/categories/17597340081category-12.jpg', 1, 1, 0, 'Active', '2025-10-06 01:00:08', '2025-10-06 01:00:08'),
(5, 1, 'Watches', 'uploads/categories/17597340331category-20.jpg', 0, 1, 1, 'Active', '2025-10-06 01:00:33', '2025-10-09 01:41:44'),
(6, 1, 'Games', 'uploads/categories/17597340501category-8.jpg', 0, 1, 0, 'Active', '2025-10-06 01:00:50', '2025-10-09 01:46:14'),
(7, 1, 'Kitchen', 'uploads/categories/17597340861category-9.jpg', 1, 1, 1, 'Active', '2025-10-06 01:01:26', '2025-10-09 01:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_10_06_044805_create_categories_table', 2),
(6, '2025_10_06_045047_create_brands_table', 2),
(7, '2025_10_06_050616_create_subcategories_table', 2),
(8, '2025_10_06_052117_create_brand_category_table', 2),
(9, '2025_10_06_052853_create_units_table', 3),
(10, '2025_10_06_053049_create_variants_table', 3),
(11, '2025_10_06_053150_create_products_table', 3),
(12, '2025_10_06_053955_create_productvariants_table', 3),
(13, '2025_10_07_085046_create_orders_table', 4),
(14, '2025_10_07_085450_create_orderdetails_table', 4),
(15, '2025_10_07_085949_create_paymentmethods_table', 4),
(16, '2025_10_07_092154_create_sliders_table', 5),
(17, '2025_10_09_081518_create_carts_table', 5),
(18, '2025_10_11_082810_create_whishlists_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `paymentmethod_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `zip_code` varchar(191) DEFAULT NULL,
  `full_address` text NOT NULL,
  `screen_shot` varchar(191) DEFAULT NULL,
  `sub_total` varchar(191) NOT NULL,
  `delivery_charge` varchar(191) DEFAULT '0',
  `vat_tax` varchar(191) DEFAULT '0',
  `total` varchar(191) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(191) NOT NULL,
  `timestamp` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `user_id`, `paymentmethod_id`, `name`, `email`, `phone`, `zip_code`, `full_address`, `screen_shot`, `sub_total`, `delivery_charge`, `vat_tax`, `total`, `date`, `time`, `timestamp`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'Md. Ekram Hossain', 'ekramhossainekram28@gmail.com', '01799327845', NULL, 'East Boxanagr, Sarulia, Demra, Dhaka', NULL, '3543.54', '0', '0', '3543.54', '2025-10-11', '11:15: am', '1760181335', 'Pending', '2025-10-11 05:15:35', '2025-10-11 05:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderdetail_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `varaint_id` int(11) DEFAULT NULL,
  `price` varchar(191) NOT NULL,
  `discount` varchar(191) DEFAULT '0',
  `qty` varchar(191) NOT NULL,
  `unit_total` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderdetail_id`, `product_id`, `varaint_id`, `price`, `discount`, `qty`, `unit_total`, `created_at`, `updated_at`) VALUES
(1, 1, 6, NULL, '946.68', '0', '3', '2840.04', '2025-10-11 05:15:35', '2025-10-11 05:15:35'),
(2, 1, 4, NULL, '351.75', '0', '2', '703.50', '2025-10-11 05:15:35', '2025-10-11 05:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethods`
--

CREATE TABLE `paymentmethods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `api_key` varchar(191) DEFAULT NULL,
  `secret_key` varchar(191) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paymentmethods`
--

INSERT INTO `paymentmethods` (`id`, `user_id`, `name`, `api_key`, `secret_key`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cash On Delivery', NULL, NULL, 'Active', NULL, NULL),
(2, 1, 'Bank', NULL, NULL, 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `unit_id` int(11) NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `product_price` varchar(191) NOT NULL,
  `discount` varchar(191) DEFAULT NULL,
  `stock_qty` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `brand_id`, `subcategory_id`, `unit_id`, `product_name`, `product_price`, `discount`, `stock_qty`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 4, NULL, 5, 'Ray Cruz', '983', '3', '946', 'uploads/products/175974958316-800x900.jpg', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis risus ante, id cursus arcu varius quis. In diam orci, consequat sed venenatis ut, bibendum et justo. Nulla vestibulum, ante sed lobortis tincidunt, eros mauris ornare turpis, non ultrices nibh leo nec libero. Cras porttitor faucibus felis nec vestibulum. Integer eu ligula vitae magna interdum facilisis sit amet vitae velit. Nunc interdum eros ornare, mollis turpis vitae, commodo est. Donec a dictum orci. Aliquam turpis urna, sodales sed aliquet sit amet, egestas non risus. Quisque sit amet hendrerit sem, in ornare purus. Vestibulum sed erat luctus, sagittis eros non, porta odio. Nunc molestie id odio quis sodales.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Aliquam lectus turpis, sagittis et sapien vitae, feugiat pulvinar neque. Mauris suscipit ut augue iaculis tincidunt. Vivamus sagittis, mauris ac consequat lacinia, felis risus lobortis ipsum, eget vehicula risus nisl eu dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus mollis auctor est, auctor pellentesque tortor faucibus eget. Nulla facilisi. Nullam ornare dictum magna. Donec aliquam, est nec maximus convallis, justo est vehicula orci, ac malesuada sem quam a diam. Vestibulum in mauris urna. In ultricies sodales orci sed lobortis. Maecenas auctor arcu a nulla fringilla, non consequat metus mollis.</p>', 'Active', '2025-10-06 05:19:43', '2025-10-06 05:51:12'),
(2, 1, 1, 3, 2, 5, 'Aiko Freeman', '141', '2', '798', 'uploads/products/17597496331review-img-1.jpg', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis risus ante, id cursus arcu varius quis. In diam orci, consequat sed venenatis ut, bibendum et justo. Nulla vestibulum, ante sed lobortis tincidunt, eros mauris ornare turpis, non ultrices nibh leo nec libero. Cras porttitor faucibus felis nec vestibulum. Integer eu ligula vitae magna interdum facilisis sit amet vitae velit. Nunc interdum eros ornare, mollis turpis vitae, commodo est. Donec a dictum orci. Aliquam turpis urna, sodales sed aliquet sit amet, egestas non risus. Quisque sit amet hendrerit sem, in ornare purus. Vestibulum sed erat luctus, sagittis eros non, porta odio. Nunc molestie id odio quis sodales.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">Aliquam lectus turpis, sagittis et sapien vitae, feugiat pulvinar neque. Mauris suscipit ut augue iaculis tincidunt. Vivamus sagittis, mauris ac consequat lacinia, felis risus lobortis ipsum, eget vehicula risus nisl eu dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus mollis auctor est, auctor pellentesque tortor faucibus eget. Nulla facilisi. Nullam ornare dictum magna. Donec aliquam, est nec maximus convallis, justo est vehicula orci, ac malesuada sem quam a diam. Vestibulum in mauris urna. In ultricies sodales orci sed lobortis. Maecenas auctor arcu a nulla fringilla, non consequat metus mollis.</p>', 'Active', '2025-10-06 05:20:33', '2025-10-06 05:51:10'),
(3, 1, 7, NULL, NULL, 4, 'Elaine Morin', '652', NULL, '283', 'uploads/products/175974971512.jpg', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis risus ante, id cursus arcu varius quis. In diam orci, consequat sed venenatis ut, bibendum et justo. Nulla vestibulum, ante sed lobortis tincidunt, eros mauris ornare turpis, non ultrices nibh leo nec libero. Cras porttitor faucibus felis nec vestibulum. Integer eu ligula vitae magna interdum facilisis sit amet vitae velit. Nunc interdum eros ornare, mollis turpis vitae, commodo est. Donec a dictum orci. Aliquam turpis urna, sodales sed aliquet sit amet, egestas non risus. Quisque sit amet hendrerit sem, in ornare purus. Vestibulum sed erat luctus, sagittis eros non, porta odio. Nunc molestie id odio quis sodales.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">Aliquam lectus turpis, sagittis et sapien vitae, feugiat pulvinar neque. Mauris suscipit ut augue iaculis tincidunt. Vivamus sagittis, mauris ac consequat lacinia, felis risus lobortis ipsum, eget vehicula risus nisl eu dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus mollis auctor est, auctor pellentesque tortor faucibus eget. Nulla facilisi. Nullam ornare dictum magna. Donec aliquam, est nec maximus convallis, justo est vehicula orci, ac malesuada sem quam a diam. Vestibulum in mauris urna. In ultricies sodales orci sed lobortis. Maecenas auctor arcu a nulla fringilla, non consequat metus mollis.</p>', 'Active', '2025-10-06 05:21:55', '2025-10-07 00:03:54'),
(4, 1, 7, 3, NULL, 2, 'Iliana Prince', '469', '25', '378', 'uploads/products/175975037714-1.jpg', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis risus ante, id cursus arcu varius quis. In diam orci, consequat sed venenatis ut, bibendum et justo. Nulla vestibulum, ante sed lobortis tincidunt, eros mauris ornare turpis, non ultrices nibh leo nec libero. Cras porttitor faucibus felis nec vestibulum. Integer eu ligula vitae magna interdum facilisis sit amet vitae velit. Nunc interdum eros ornare, mollis turpis vitae, commodo est. Donec a dictum orci. Aliquam turpis urna, sodales sed aliquet sit amet, egestas non risus. Quisque sit amet hendrerit sem, in ornare purus. Vestibulum sed erat luctus, sagittis eros non, porta odio. Nunc molestie id odio quis sodales.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Aliquam lectus turpis, sagittis et sapien vitae, feugiat pulvinar neque. Mauris suscipit ut augue iaculis tincidunt. Vivamus sagittis, mauris ac consequat lacinia, felis risus lobortis ipsum, eget vehicula risus nisl eu dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus mollis auctor est, auctor pellentesque tortor faucibus eget. Nulla facilisi. Nullam ornare dictum magna. Donec aliquam, est nec maximus convallis, justo est vehicula orci, ac malesuada sem quam a diam. Vestibulum in mauris urna. In ultricies sodales orci sed lobortis. Maecenas auctor arcu a nulla fringilla, non consequat metus mollis.</p>', 'Active', '2025-10-06 05:32:57', '2025-10-09 01:57:28'),
(5, 1, 7, 3, 3, 2, 'Walker Knowles', '111', NULL, '619', 'uploads/products/175975045318.jpg', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis risus ante, id cursus arcu varius quis. In diam orci, consequat sed venenatis ut, bibendum et justo. Nulla vestibulum, ante sed lobortis tincidunt, eros mauris ornare turpis, non ultrices nibh leo nec libero. Cras porttitor faucibus felis nec vestibulum. Integer eu ligula vitae magna interdum facilisis sit amet vitae velit. Nunc interdum eros ornare, mollis turpis vitae, commodo est. Donec a dictum orci. Aliquam turpis urna, sodales sed aliquet sit amet, egestas non risus. Quisque sit amet hendrerit sem, in ornare purus. Vestibulum sed erat luctus, sagittis eros non, porta odio. Nunc molestie id odio quis sodales.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Aliquam lectus turpis, sagittis et sapien vitae, feugiat pulvinar neque. Mauris suscipit ut augue iaculis tincidunt. Vivamus sagittis, mauris ac consequat lacinia, felis risus lobortis ipsum, eget vehicula risus nisl eu dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus mollis auctor est, auctor pellentesque tortor faucibus eget. Nulla facilisi. Nullam ornare dictum magna. Donec aliquam, est nec maximus convallis, justo est vehicula orci, ac malesuada sem quam a diam. Vestibulum in mauris urna. In ultricies sodales orci sed lobortis. Maecenas auctor arcu a nulla fringilla, non consequat metus mollis.</p>', 'Active', '2025-10-06 05:34:13', '2025-10-07 04:26:23'),
(6, 1, 7, 1, 3, 5, 'Tamekah Marquez', '966', '2', '995', 'uploads/products/175975133913.jpg', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis risus ante, id cursus arcu varius quis. In diam orci, consequat sed venenatis ut, bibendum et justo. Nulla vestibulum, ante sed lobortis tincidunt, eros mauris ornare turpis, non ultrices nibh leo nec libero. Cras porttitor faucibus felis nec vestibulum. Integer eu ligula vitae magna interdum facilisis sit amet vitae velit. Nunc interdum eros ornare, mollis turpis vitae, commodo est. Donec a dictum orci. Aliquam turpis urna, sodales sed aliquet sit amet, egestas non risus. Quisque sit amet hendrerit sem, in ornare purus. Vestibulum sed erat luctus, sagittis eros non, porta odio. Nunc molestie id odio quis sodales.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Aliquam lectus turpis, sagittis et sapien vitae, feugiat pulvinar neque. Mauris suscipit ut augue iaculis tincidunt. Vivamus sagittis, mauris ac consequat lacinia, felis risus lobortis ipsum, eget vehicula risus nisl eu dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus mollis auctor est, auctor pellentesque tortor faucibus eget. Nulla facilisi. Nullam ornare dictum magna. Donec aliquam, est nec maximus convallis, justo est vehicula orci, ac malesuada sem quam a diam. Vestibulum in mauris urna. In ultricies sodales orci sed lobortis. Maecenas auctor arcu a nulla fringilla, non consequat metus mollis.</p>', 'Active', '2025-10-06 05:35:11', '2025-10-07 04:26:13'),
(7, 1, 7, NULL, 9, 5, 'Stephanie Webster', '840', NULL, '930', 'uploads/products/17598323131bought-2.jpg', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas a commodo quam, sit amet dignissim velit. Mauris in massa nec metus varius condimentum eu et tortor. In hac habitasse platea dictumst. Vivamus tristique, lectus non pharetra vestibulum, sapien nisl faucibus orci, ut semper quam ex feugiat tortor. Nulla at urna ut ipsum luctus vestibulum sit amet vel arcu. Nullam sed lacus odio. Proin a ex lectus. Vestibulum ac finibus felis. Vivamus porta porttitor tempor. Etiam facilisis, nisi volutpat convallis dictum, ante ante mollis lectus, sed euismod nunc lorem et nisi. Nullam sed porttitor ligula.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Etiam id lacus vel eros cursus mattis eu eget turpis. Quisque quis pretium magna. Sed laoreet, nisi id gravida tincidunt, lacus ipsum luctus arcu, non venenatis nulla mauris non arcu. Praesent vel ipsum justo. Phasellus tempor diam sed varius sollicitudin. Pellentesque vel urna risus. Duis fermentum, nunc vel gravida hendrerit, ante nunc semper sem, quis dapibus nibh augue vel erat. Nullam pulvinar velit quis nisl viverra, at cursus odio fringilla.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Mauris auctor ipsum eros, quis interdum est mollis nec. Vestibulum dignissim tellus interdum, suscipit mi vel, sollicitudin elit. Mauris luctus ex in ex sodales mattis. Aliquam porttitor ipsum in purus varius, quis sollicitudin nisl sagittis. Cras elementum ligula nisl, porttitor pretium leo sodales non. Ut facilisis varius interdum. In ac vulputate orci.</p>', 'Active', '2025-10-07 04:18:33', '2025-10-07 04:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `productvariants`
--

CREATE TABLE `productvariants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `variant_value` varchar(191) NOT NULL,
  `variant_price` varchar(191) DEFAULT NULL,
  `stock_qty` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productvariants`
--

INSERT INTO `productvariants` (`id`, `product_id`, `variant_id`, `variant_value`, `variant_price`, `stock_qty`, `image`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 'Red', '23', '300', 'uploads/variants/1759826819_68e4d38308299_1-1.jpg', '2025-10-07 02:46:59', '2025-10-09 00:59:17'),
(2, 6, 1, 'Yellow', '24', '350', 'uploads/variants/1759826819_68e4d38372503_1-2.jpg', '2025-10-07 02:46:59', '2025-10-07 02:47:46'),
(4, 6, 2, 'S', NULL, '23', NULL, '2025-10-07 02:46:59', '2025-10-07 02:46:59'),
(5, 6, 2, 'M', NULL, '24', NULL, '2025-10-07 02:46:59', '2025-10-07 02:46:59'),
(6, 6, 2, 'L', NULL, '25', NULL, '2025-10-07 02:46:59', '2025-10-07 02:46:59'),
(7, 6, 1, 'Black', '25', '65', 'uploads/variants/1759826878_68e4d3bef1250_7-2.jpg', '2025-10-07 02:47:46', '2025-10-07 02:47:58'),
(10, 6, 2, 'XL', NULL, '30', NULL, '2025-10-09 01:00:48', '2025-10-09 01:00:48'),
(11, 6, 2, 'XXL', NULL, '40', NULL, '2025-10-09 01:00:49', '2025-10-09 01:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `sub_title` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `user_id`, `category_id`, `title`, `sub_title`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 'Slider One', 'Slide One SubTitle', 'uploads/sliders/17601574281men.png', '2025-10-10 22:37:08', '2025-10-10 22:37:08'),
(2, 1, 5, 'Slider Two', 'Slider Two Sub Title', 'uploads/sliders/17601574851skate.png', '2025-10-10 22:38:05', '2025-10-10 22:38:05'),
(3, 1, 1, 'Slider Three', 'Slider Three SubTitle', 'uploads/sliders/17601575281skate.png', '2025-10-10 22:38:48', '2025-10-10 22:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(191) NOT NULL,
  `is_mega_menu` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(191) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `user_id`, `category_id`, `subcategory_name`, `is_mega_menu`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Ross Burke', 1, NULL, 'Active', '2025-10-06 02:46:16', '2025-10-06 02:46:16'),
(2, 1, 1, 'Desirae Morin', 1, NULL, 'Active', '2025-10-06 02:46:22', '2025-10-06 02:46:22'),
(3, 1, 7, 'Clayton Bishop', 1, NULL, 'Active', '2025-10-06 02:46:28', '2025-10-06 02:46:28'),
(4, 1, 7, 'Desiree Randall', 1, NULL, 'Active', '2025-10-06 02:46:34', '2025-10-06 03:06:40'),
(5, 1, 4, 'Leilani Welch', 1, NULL, 'Active', '2025-10-06 02:46:41', '2025-10-06 02:46:41'),
(6, 1, 6, 'Derek Warner', 1, NULL, 'Active', '2025-10-06 02:46:45', '2025-10-06 03:02:41'),
(8, 1, 6, 'Emmanuel Lindsay', 1, NULL, 'Active', '2025-10-07 04:05:36', '2025-10-07 04:05:36'),
(9, 1, 7, 'Kristen Hebert', 1, NULL, 'Active', '2025-10-07 04:19:01', '2025-10-07 04:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `unit_name` varchar(191) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `user_id`, `unit_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'KG', 'Active', '2025-10-06 04:02:44', '2025-10-06 04:02:44'),
(2, 1, 'Pairs', 'Active', '2025-10-06 04:02:51', '2025-10-06 04:05:02'),
(4, 1, 'gm', 'Active', '2025-10-06 04:04:52', '2025-10-06 04:04:52'),
(5, 1, 'PCS', 'Active', '2025-10-06 05:13:23', '2025-10-06 05:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `role` varchar(191) NOT NULL DEFAULT 'user',
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT 'defaults/profile.png',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `phone`, `email_verified_at`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', NULL, NULL, '$2y$10$70lTVHwKQZV/KBz70dZC3e25m5/SrpksjlD04ChPWjCXncIvLtjn2', 'defaults/profile.png', 'Active', NULL, NULL, NULL),
(2, 'Md. Ekram Hossain', 'user', 'ekramhossainekram28@gmail.com', '01799327845', NULL, '$2y$10$6IFfknWwu3OAFFyXQo9/fOUovjBhLPs3JNAX9LzIn34lkhasCY59e', 'defaults/profile.png', 'Active', NULL, '2025-10-11 02:10:31', '2025-10-11 02:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `variant_name` varchar(191) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `user_id`, `variant_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Color', 'Active', '2025-10-07 02:45:39', '2025-10-07 02:45:39'),
(2, 1, 'Size', 'Active', '2025-10-07 02:45:49', '2025-10-07 02:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `whishlists`
--

CREATE TABLE `whishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `whishlists`
--

INSERT INTO `whishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2025-10-11 02:54:33', '2025-10-11 02:54:33'),
(3, 2, 5, '2025-10-11 03:09:51', '2025-10-11 03:09:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_brand_name_unique` (`brand_name`);

--
-- Indexes for table `brand_category`
--
ALTER TABLE `brand_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_category_brand_id_foreign` (`brand_id`),
  ADD KEY `brand_category_category_id_foreign` (`category_id`);

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
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paymentmethods_name_unique` (`name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_name_unique` (`product_name`);

--
-- Indexes for table `productvariants`
--
ALTER TABLE `productvariants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategories_subcategory_name_unique` (`subcategory_name`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_unit_name_unique` (`unit_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `variants_variant_name_unique` (`variant_name`);

--
-- Indexes for table `whishlists`
--
ALTER TABLE `whishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brand_category`
--
ALTER TABLE `brand_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `productvariants`
--
ALTER TABLE `productvariants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `whishlists`
--
ALTER TABLE `whishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand_category`
--
ALTER TABLE `brand_category`
  ADD CONSTRAINT `brand_category_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brand_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
