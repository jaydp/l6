-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 30, 2019 at 04:59 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_6`
--

-- --------------------------------------------------------

--
-- Table structure for table `rf_categories`
--

DROP TABLE IF EXISTS `rf_categories`;
CREATE TABLE IF NOT EXISTS `rf_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rf_categories`
--

INSERT INTO `rf_categories` (`id`, `name`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Cat 11', 'Cat 1 Desc1', 1, '2019-09-24 16:31:08', '2019-09-24 16:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `rf_countries`
--

DROP TABLE IF EXISTS `rf_countries`;
CREATE TABLE IF NOT EXISTS `rf_countries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rf_migrations`
--

DROP TABLE IF EXISTS `rf_migrations`;
CREATE TABLE IF NOT EXISTS `rf_migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rf_migrations`
--

INSERT INTO `rf_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_09_24_232755_create_states_table', 2),
(4, '2019_09_24_232852_create_countries_table', 2),
(5, '2019_09_24_232910_create_categories_table', 2),
(6, '2019_09_25_000933_add_country_to_states_table', 3),
(11, '2019_09_25_062539_create_roles_table', 4),
(12, '2019_09_25_062615_create_permissions_table', 4),
(13, '2019_09_25_062628_create_role_permissions_table', 4),
(14, '2019_09_25_065156_add_role_to_user_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `rf_password_resets`
--

DROP TABLE IF EXISTS `rf_password_resets`;
CREATE TABLE IF NOT EXISTS `rf_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `rf_password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rf_permissions`
--

DROP TABLE IF EXISTS `rf_permissions`;
CREATE TABLE IF NOT EXISTS `rf_permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ident` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rf_permissions_ident_unique` (`ident`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rf_permissions`
--

INSERT INTO `rf_permissions` (`id`, `name`, `ident`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Categories', 'categories.index', '', 1, '2019-09-24 14:30:00', '2019-09-24 14:30:00'),
(2, 'Categories Create', 'categories.create', '', 1, '2019-09-24 14:30:00', '2019-09-24 14:30:00'),
(3, 'Categories Edit', 'categories.edit', '', 1, '2019-09-24 14:30:00', '2019-09-24 14:30:00'),
(4, 'Categories Delete', 'categories.delete', '', 1, '2019-09-24 14:30:00', '2019-09-24 14:30:00'),
(5, 'Countries', 'countries.index', '', 1, '2019-09-24 14:30:00', '2019-09-24 14:30:00'),
(6, 'Countries Create', 'countries.create', '', 1, '2019-09-24 14:30:00', '2019-09-24 14:30:00'),
(7, 'Countries Edit', 'countries.edit', '', 1, '2019-09-24 14:30:00', '2019-09-24 14:30:00'),
(8, 'Countries Delete', 'countries.delete', '', 1, '2019-09-24 14:30:00', '2019-09-24 14:30:00'),
(9, 'States', 'states.index', '', 0, NULL, NULL),
(10, 'State Create', 'states.create', '', 0, NULL, NULL),
(11, 'State edit', 'states.edit', '', 0, NULL, NULL),
(12, 'State Delete', 'states.delete', '', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rf_roles`
--

DROP TABLE IF EXISTS `rf_roles`;
CREATE TABLE IF NOT EXISTS `rf_roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ident` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '99',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rf_roles_ident_unique` (`ident`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rf_roles`
--

INSERT INTO `rf_roles` (`id`, `name`, `ident`, `description`, `active`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Role 1', 'role1', '', 1, 99, '2019-09-24 14:30:00', '2019-09-24 14:30:00'),
(2, 'Role 2', 'role2', '', 1, 90, '2019-09-24 14:30:00', '2019-09-24 14:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `rf_role_permissions`
--

DROP TABLE IF EXISTS `rf_role_permissions`;
CREATE TABLE IF NOT EXISTS `rf_role_permissions` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  UNIQUE KEY `rf_role_permissions_role_id_permission_id_unique` (`role_id`,`permission_id`),
  KEY `rf_role_permissions_permission_id_foreign` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rf_role_permissions`
--

INSERT INTO `rf_role_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 5),
(2, 5),
(2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `rf_states`
--

DROP TABLE IF EXISTS `rf_states`;
CREATE TABLE IF NOT EXISTS `rf_states` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rf_states_country_id_foreign` (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rf_users`
--

DROP TABLE IF EXISTS `rf_users`;
CREATE TABLE IF NOT EXISTS `rf_users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rf_users_email_unique` (`email`),
  KEY `rf_users_role_id_foreign` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rf_users`
--

INSERT INTO `rf_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Jaydeep', 'jaydeepp@op2ma.com.au', NULL, '$2y$10$GyNMdwZM4dit8lHdq/Kz9.0qB5lMJLaBPEADNK6c0vgq5fadAAn/K', NULL, '2019-09-24 21:14:54', '2019-09-24 21:14:54', 1),
(2, 'jd', 'jaydeepp@fusion-solutions.com.au', NULL, '$2y$10$VBJ1IMfiAFvJfXzU7akUgemji6nPMkSpD5.zb9vmQ9VmDIhzMLJeK', NULL, '2019-09-24 21:23:01', '2019-09-24 21:23:01', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
