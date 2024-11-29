-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 12:21 PM
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
-- Database: `dberp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1732871074),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1732871074;', 1732871074),
('a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1732863512),
('a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1732863512;', 1732863512);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_code` varchar(255) NOT NULL,
  `customer_code` varchar(255) NOT NULL,
  `total_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_code`, `customer_code`, `total_price`, `date`, `created_at`, `updated_at`) VALUES
('CA001', 'CU006', 1450000.00, '2024-11-29', '2024-11-28 23:57:32', '2024-11-28 23:59:26'),
('CA002', 'CU002', 600000.00, '2024-11-28', '2024-11-29 00:00:00', '2024-11-29 00:01:15');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `cartdetail_code` varchar(255) NOT NULL,
  `cart_code` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`cartdetail_code`, `cart_code`, `product_code`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
('CD001', 'CA001', 'PR001', 5, 500000.00, '2024-11-28 23:58:39', '2024-11-28 23:58:39'),
('CD002', 'CA001', 'PR002', 3, 900000.00, '2024-11-28 23:58:59', '2024-11-28 23:58:59'),
('CD003', 'CA001', 'PR003', 1, 50000.00, '2024-11-28 23:59:26', '2024-11-28 23:59:26'),
('CD004', 'CA002', 'PR004', 2, 300000.00, '2024-11-29 00:00:31', '2024-11-29 00:00:31'),
('CD005', 'CA002', 'PR005', 1, 300000.00, '2024-11-29 00:01:15', '2024-11-29 00:01:15');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_code` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_code`, `customer_name`, `email`, `address`, `phone_number`, `password`, `created_at`, `updated_at`) VALUES
('CU001', 'Delores', 'osporer@example.com', '71763 Collier Route Apt. 835\nPort Monserrate, ME 95851', '+1 (458) 219-4320', '$2y$12$u5xnvIkJ78TuAAI8mtm9m.vOIwaYPo3B6PSjkjjpr0oWMBWma6u6C', '2024-10-10 04:09:43', '2024-11-28 03:54:33'),
('CU002', 'Antonetta Abbott', 'amiya.gislason@example.org', '1548 Bert Valleys\nMelyssahaven, WV 43775-3211', '+1.920.839.6532', '$2y$12$fWTJh7F5VbLsXWiXEi2oIeHaK5LYVgJaYyw4cvA0DL3H9HWZTf19W', '2024-10-10 04:09:44', '2024-10-10 04:09:44'),
('CU003', 'Dr. Camden Littel', 'quigley.beatrice@example.com', '857 Christiansen Radial\nLake Clairfurt, TX 38179', '848-985-5357', '$2y$12$teooj.Kzqz5lg8k7Pul./eMPEe9qUW14cVkkwpK4wybNXB1J2AAP2', '2024-10-10 04:09:44', '2024-10-10 04:09:44'),
('CU004', 'Guadalupe Hyatt', 'wolf.teresa@example.net', '2233 Kade Pines\nNorth Sophiaton, AR 70100-2220', '(864) 355-8756', '$2y$12$O81T4GNj3bFEb49drLZpEuqKhFZPlVm831jqi4tKM3yqp4BbVk9sq', '2024-10-10 04:09:45', '2024-10-10 04:09:45'),
('CU005', 'Verna Schamberger', 'alvena03@example.org', '308 Abby Divide Apt. 973\nEffertzland, VT 12915', '(715) 524-3212', '$2y$12$bfLYRMHak6xtIBSoB0jQ5e4hEOXmQRlKgIOOLW0EooaWlGZL9e/6K', '2024-10-10 04:09:45', '2024-10-10 04:09:45'),
('CU006', 'Alberto Schamberger', 'matt80@example.org', '32535 Wiegand Plaza Suite 287\nPort Roselyn, HI 35794', '+1-361-806-4693', '$2y$12$hVDiGfAztKrIFbVGTCdxnOfI8VhaP8vNdGWiKLE0bzmLJB930OMZy', '2024-10-10 04:09:46', '2024-10-10 04:09:46'),
('CU007', 'Kendra Turner I', 'bernardo20@example.com', '1606 Audra Hollow Suite 268\nOnieton, CA 23769-5277', '843-215-7798', '$2y$12$ZvTrxSHILqoEzXNrDuH5Pe/jgUguyR/FdnefQNWeJvzcnSGkJC4ju', '2024-10-10 04:09:46', '2024-10-10 04:09:46'),
('CU008', 'Ms. Shawna Wolff III', 'sprosacco@example.net', '65628 Waters Parks Suite 530\nPort Amyview, MI 73748-5040', '(575) 803-2263', '$2y$12$peLoLRTqRSKvJQtA7QaLpeEbquDXk38efkz90yC9tLHA6oAc1MlgK', '2024-10-10 04:09:47', '2024-10-10 04:09:47'),
('CU009', 'Jaunita Krajcik', 'taryn16@example.org', '98148 Blanca Prairie Suite 675\nJacobifurt, MO 66987', '1-708-910-8688', '$2y$12$2prMLVN8eV1zJfBccAxbg.d05LZeyYMYPY/N.6VKMWWESwtfhhPi2', '2024-10-10 04:09:47', '2024-10-10 04:09:47'),
('CU010', 'Celia Kihn', 'schiller.maria@example.com', '437 Beier Lock\nNew Allison, AZ 65809', '(563) 884-3384', '$2y$12$n86MgS9dUbLStmMC.uzmluSBiuT9pRUtwGYzgHZo2Urpoof66UlPe', '2024-10-10 04:09:48', '2024-10-10 04:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(18, '0001_01_01_000000_create_users_table', 1),
(19, '0001_01_01_000001_create_cache_table', 1),
(20, '0001_01_01_000002_create_jobs_table', 1),
(21, '2024_10_10_110720_create_products_table', 1),
(22, '2024_10_10_110724_create_orders_table', 1),
(23, '2024_10_10_110734_create_customers_table', 1),
(24, '2024_10_10_110740_create_order_details_table', 1),
(25, '2024_10_10_110749_create_cart_details_table', 1),
(26, '2024_10_10_110806_create_carts_table', 1),
(27, '2024_10_14_134717_update_cart_details_table', 2),
(28, '2024_10_27_143353_add_quantity_to_products_table', 3),
(29, '2024_10_27_152557_add_foreign_keys_to_tables', 4),
(30, '2024_10_27_153648_add_default_value_to_total_price_in_carts_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_code` varchar(255) NOT NULL,
  `cart_code` varchar(255) NOT NULL,
  `customer_code` varchar(255) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_code`, `cart_code`, `customer_code`, `total_price`, `status`, `date`, `created_at`, `updated_at`) VALUES
('OR001', 'CA001', 'CU006', 1450000.00, 'Pending', '2024-11-29', '2024-11-29 00:01:40', '2024-11-29 00:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `orderdetail_code` varchar(255) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`orderdetail_code`, `order_code`, `product_code`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
('OD001', 'OR001', 'PR001', 5, 500000.00, '2024-11-29 00:01:40', '2024-11-29 00:01:40'),
('OD002', 'OR001', 'PR002', 3, 900000.00, '2024-11-29 00:01:40', '2024-11-29 00:01:40'),
('OD003', 'OR001', 'PR003', 1, 50000.00, '2024-11-29 00:01:40', '2024-11-29 00:01:40');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_code`, `product_name`, `unit`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
('PR001', 'Mouse', 'pieces', 100000.00, 50, '2024-10-10 04:08:31', '2024-11-28 23:51:45'),
('PR002', 'Keyboard', 'pieces', 300000.00, 50, '2024-10-10 04:08:31', '2024-11-28 23:52:41'),
('PR003', 'Mouse Pad', 'pieces', 50000.00, 50, '2024-10-10 04:08:31', '2024-11-28 23:53:23'),
('PR004', 'Headphone', 'pieces', 150000.00, 50, '2024-10-10 04:08:31', '2024-11-28 23:53:42'),
('PR005', 'Speaker', 'pieces', 300000.00, 50, '2024-10-10 04:08:31', '2024-11-28 23:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('wKKbjTClodtCt6RGxjwSP2AZfzlm4JCCDNAZB9yt', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiVnV2OUcyZGpHRmlSOXRWQnRWSUt1dGZzcTkyWklRZFpJM3pOajh6dyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkWU1NQUVFbjVhOWpzcC9VYnp5c3F2ZVBpTU8ueGZpR21YUVAxeVRXR0ZnTGdHUm41V1V6Lk8iO3M6ODoiZmlsYW1lbnQiO2E6MDp7fX0=', 1732878975);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$YMMAEEn5a9jsp/UbzysqvePiMO.xfiGmXQP1yTWGFgLgGRn5WUz.O', NULL, '2024-10-10 04:31:15', '2024-10-10 04:31:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_code`),
  ADD KEY `carts_customer_code_foreign` (`customer_code`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`cartdetail_code`),
  ADD KEY `cart_details_cart_code_foreign` (`cart_code`),
  ADD KEY `cart_details_product_code_foreign` (`product_code`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_code`),
  ADD UNIQUE KEY `customers_customer_name_unique` (`customer_name`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_code`),
  ADD KEY `orders_cart_code_foreign` (`cart_code`),
  ADD KEY `orders_customer_code_foreign` (`customer_code`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`orderdetail_code`),
  ADD KEY `order_details_order_code_foreign` (`order_code`),
  ADD KEY `order_details_product_code_foreign` (`product_code`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_code`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_customer_code_foreign` FOREIGN KEY (`customer_code`) REFERENCES `customers` (`customer_code`) ON DELETE CASCADE;

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_cart_code_foreign` FOREIGN KEY (`cart_code`) REFERENCES `carts` (`cart_code`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_details_product_code_foreign` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_cart_code_foreign` FOREIGN KEY (`cart_code`) REFERENCES `carts` (`cart_code`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_customer_code_foreign` FOREIGN KEY (`customer_code`) REFERENCES `customers` (`customer_code`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_code_foreign` FOREIGN KEY (`order_code`) REFERENCES `orders` (`order_code`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_code_foreign` FOREIGN KEY (`product_code`) REFERENCES `products` (`product_code`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
