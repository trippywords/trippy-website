-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2018 at 09:09 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trippywords`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_heading` varchar(255) NOT NULL,
  `blog_image` varchar(255) DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `blog_status` tinyint(1) NOT NULL COMMENT '1-published 2-draft',
  `blog_description` text NOT NULL,
  `blog_meta_description` text NOT NULL,
  `blog_keywords` text NOT NULL,
  `is_delete` enum('0','1') DEFAULT '0',
  `blog_slug` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `blog_title`, `blog_heading`, `blog_image`, `created_by`, `blog_status`, `blog_description`, `blog_meta_description`, `blog_keywords`, `is_delete`, `blog_slug`, `created_at`, `updated_at`) VALUES
(20, 'test', 'Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc', '1526898704.jpg', 1, 1, 'This is Photoshop\'s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean Sollicitudin.lorem quis bibendum auctor. nisi elit consequat ipsum. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra. per inceptos himenaeos.', 'test', 'test', '0', 'test', '2018-05-29 13:21:47', '2018-05-21 05:18:00'),
(21, 'latest', 'Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc', '1526039408.jpg', 1, 1, 'This is Photoshop\'s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean Sollicitudin.lorem quis bibendum auctor. nisi elit consequat ipsum. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra. per inceptos himenaeos. ', 'test', 'test', '0', 'latest', '2018-05-29 13:21:47', '2018-05-11 06:20:08'),
(22, 'This is Photoshop\'s version of Lorem Ipsum. Proin ...', 'test', '1526039443.jpg', 1, 2, 'test', 'test', 'test', '0', 'this-is-photoshops-version-of-lorem-ipsum-proin', '2018-05-29 13:23:00', '2018-05-21 07:06:12'),
(23, '2', 'test', '1526039458.jpg', 1, 2, 'test', 'test', 'test', '0', '2', '2018-05-29 13:21:47', '2018-05-11 06:20:58'),
(24, 'test two test', 'test', '1526039458.jpg', 1, 2, '<p>test</p>', 'test', 'test', '1', 'test-two-test', '2018-05-29 14:12:10', '2018-05-29 08:42:10'),
(25, 'test333333', 'test', '1526043958.jpg', 1, 2, '<p>test</p>', 'test', 'test', '0', 'test333333', '2018-05-30 04:52:31', '2018-05-29 23:22:31'),
(26, 'blog 26', 'Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc', '1526650351.jpg', 1, 1, 'This is Photoshop\'s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean Sollicitudin.lorem quis bibendum auctor. nisi elit consequat ipsum. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra. per inceptos himenaeos. ', '26', '26', '0', 'blog-26', '2018-05-29 13:23:00', '2018-05-21 05:02:45'),
(27, 'Blog update checking', 'Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc', '1526898498.jpg', 1, 1, 'This is Photoshop\'s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean Sollicitudin.lorem quis bibendum auctor. nisi elit consequat ipsum. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra. per inceptos himenaeos. ', 'test', 'test', '0', 'blog-update-checking', '2018-05-29 13:23:00', '2018-05-21 05:06:33'),
(28, 'test', 'Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc', '1526899824.jpg', 1, 1, 'This is Photoshop\'s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean Sollicitudin.lorem quis bibendum auctor. nisi elit consequat ipsum. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra. per inceptos himenaeos. ', 'test', 'test', '0', 'test', '2018-05-29 13:23:33', '2018-05-21 05:20:24'),
(32, 'blog 10', 'test', '1527232493.jpg', 1, 1, '<p>test</p>', 'test', 'test', '0', 'blog-10', '2018-05-29 13:23:00', '2018-05-25 01:44:53'),
(29, 'Blog 7', 'this is test blog', '1527232366.jpg', 1, 1, '<p>this is test blog</p>', 'test', 'test', '0', 'blog-7', '2018-05-29 13:23:00', '2018-05-25 01:42:46'),
(30, 'blog 8', 'test', '1527232403.jpg', 1, 1, '<p>test</p>', 'test', 'test', '0', 'blog-8', '2018-05-29 13:23:00', '2018-05-25 01:43:23'),
(31, 'Blog 9', 'test', '1527232472.jpg', 1, 1, '<p>test</p>', 'test', 'test', '0', 'blog-9', '2018-05-29 13:23:00', '2018-05-25 01:44:32'),
(37, 'test mayur blog24', 'test', NULL, 1, 1, '<p>test</p>', 'test', 'test', '0', 'test-mayur-blog24', '2018-05-29 14:25:53', '2018-05-29 08:55:53'),
(39, 'test three test', 'test three test', NULL, 1, 2, '<p>test three test</p>', 'test three test', 'test three test', '1', 'test-three-test', '2018-05-29 14:46:38', '2018-05-29 09:16:38'),
(40, 'test four 4', 'test four 4', NULL, 1, 1, '<p>test four 4</p>', 'test four 4', 'test four 4', '1', 'test-four-4', '2018-05-29 14:46:32', '2018-05-29 09:16:32'),
(41, 'test marmik blog', 'test marmik blog', NULL, 151, 1, '<p>test marmik blog</p>', 'test marmik blog', 'test marmik blog', '1', 'test-marmik-blog', '2018-05-30 09:13:46', '2018-05-30 03:43:46'),
(42, 'test blog one', 'test', NULL, 154, 1, '<p>test</p>', 'test', 'test', '0', 'test-blog-one', '2018-06-05 08:38:39', '2018-06-05 08:38:39'),
(43, 'test two', 'test two', NULL, 154, 1, '<p>test two</p>', 'test two', 'test two', '0', 'test-two', '2018-06-05 08:38:58', '2018-06-05 08:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` text,
  `comments` text NOT NULL,
  `blog_id` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-exist 1-deleted',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `website`, `comments`, `blog_id`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'test', 'support@cosmonautgroup.com', 'www.cosmonautgroup.com', 'test', 28, '0', '2018-05-24 11:44:43', '2018-05-24 11:44:43'),
(2, 'test', 'admin@gmail.com', 'www.cosmonautgroup.com', 'test', 28, '0', '2018-05-24 12:11:55', '2018-05-24 12:11:55'),
(3, 'test', 'admin@gmail.com', 'test', 'test', 37, '0', '2018-05-29 14:27:33', '2018-05-29 14:27:33'),
(4, 'test', 'admin@gmail.com', 'www.cosmonautgroup.com', 'test', 25, '0', '2018-05-29 14:38:50', '2018-05-29 14:38:50'),
(5, 'u', 'support@cosmonautgroup.com', 'www.cosmonautgroup.com', 'yrdt', 25, '0', '2018-05-29 14:39:20', '2018-05-29 14:39:20'),
(6, 'test', 'mayur.cosmonautgroup@gmail.com', 'www.cosmonautgroup.com', 'test', 39, '0', '2018-05-29 14:41:59', '2018-05-29 14:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_genre_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `genre_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `is_published` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `detail`, `parent_genre_id`, `genre_image`, `is_deleted`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'Business', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(2, 'Health & Fitness', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(3, 'Parenting', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(4, 'Writers', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(5, 'News', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(6, 'Illustration', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-30 08:20:08'),
(7, 'Musics', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(8, 'Cute', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(9, 'Technology', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(10, 'Gaming', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(17, 'Business2', '', 1, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(18, 'Health & Fitness 2', '', 2, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(19, 'Parenting 2', '', 3, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(20, 'Writers 2', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(21, 'News 2', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(22, 'Illustration 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-30 08:20:08'),
(23, 'Musics 2', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(24, 'Cute 2', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(25, 'Technology 2', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(26, 'Gaming 2', '', 0, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(27, 'Business 3', '', 1, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(28, 'Health & Fitness 3', '', 2, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(29, 'Parenting 3', '', 3, NULL, 'N', 'Y', '2018-04-12 03:45:58', '2018-04-12 03:45:58'),
(30, 'genere11', 'test', 1, '', 'N', 'Y', '2018-05-18 08:06:21', '2018-05-29 06:55:07'),
(31, 'test', 'test', 0, '', 'N', 'Y', '2018-05-29 06:56:32', '2018-05-29 06:57:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_04_19_120922_create_permission_tables', 1),
(4, '2018_04_19_121027_create_products_table', 1),
(5, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(6, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(7, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(8, '2016_06_01_000004_create_oauth_clients_table', 2),
(9, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(12, '2018_04_19_121027_create_genres_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\User', 2),
(2, 'App\\User', 4),
(2, 'App\\User', 5),
(2, 'App\\User', 10),
(2, 'App\\User', 11),
(2, 'App\\User', 12),
(2, 'App\\User', 13),
(2, 'App\\User', 14),
(2, 'App\\User', 15),
(2, 'App\\User', 17),
(2, 'App\\User', 18),
(2, 'App\\User', 19),
(2, 'App\\User', 20),
(2, 'App\\User', 21),
(2, 'App\\User', 28),
(2, 'App\\User', 100),
(2, 'App\\User', 102),
(2, 'App\\User', 103),
(2, 'App\\User', 106),
(2, 'App\\User', 107),
(2, 'App\\User', 108),
(2, 'App\\User', 109),
(2, 'App\\User', 110),
(2, 'App\\User', 112),
(2, 'App\\User', 113),
(2, 'App\\User', 114),
(2, 'App\\User', 115),
(2, 'App\\User', 116),
(2, 'App\\User', 117),
(2, 'App\\User', 118),
(2, 'App\\User', 119),
(2, 'App\\User', 120),
(2, 'App\\User', 121),
(2, 'App\\User', 122),
(2, 'App\\User', 123),
(2, 'App\\User', 124),
(2, 'App\\User', 126),
(2, 'App\\User', 128),
(2, 'App\\User', 129),
(2, 'App\\User', 130),
(2, 'App\\User', 131),
(2, 'App\\User', 132),
(2, 'App\\User', 133),
(2, 'App\\User', 134),
(2, 'App\\User', 135),
(2, 'App\\User', 136),
(2, 'App\\User', 137),
(2, 'App\\User', 138),
(2, 'App\\User', 139),
(2, 'App\\User', 140),
(2, 'App\\User', 141),
(2, 'App\\User', 142),
(2, 'App\\User', 143),
(2, 'App\\User', 144),
(2, 'App\\User', 145),
(2, 'App\\User', 146),
(2, 'App\\User', 147),
(2, 'App\\User', 148),
(2, 'App\\User', 149),
(2, 'App\\User', 150),
(2, 'App\\User', 151),
(2, 'App\\User', 152),
(2, 'App\\User', 153),
(2, 'App\\User', 154),
(4, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `newsletter_email` text NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `newsletter_email`, `is_delete`, `created_at`, `updated_at`) VALUES
(37, 'mayur.cosmonautgroup@gmail.com', '1', '2018-06-01 09:59:22', '2018-06-01 11:00:37'),
(39, 'nilesh.cosmonautgroup@gmail.com', '1', '2018-06-01 10:07:42', '2018-06-01 11:01:18'),
(45, 'chirag.daxini@cosmonautgroup.com', '0', '2018-06-04 12:46:34', '2018-06-04 12:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notification_title` varchar(255) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-not delete 1-delted',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notification_title`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Notification on your content', '0', '2018-05-21 11:22:14', '2018-05-21 11:22:14'),
(2, 'Social Notifications', '0', '2018-05-21 11:22:14', '2018-05-21 11:22:14'),
(3, 'Mention Notifications', '0', '2018-05-21 11:22:14', '2018-05-21 11:22:14'),
(4, 'Readers follows you', '0', '2018-05-21 11:22:14', '2018-05-21 11:22:14'),
(5, 'Recommended Stories', '0', '2018-05-21 11:22:14', '2018-05-21 11:22:14'),
(6, 'Writing Opportunities', '0', '2018-05-21 11:22:14', '2018-05-21 11:22:14'),
(7, 'Email Notifications For Comment', '0', '2018-05-21 11:22:14', '2018-05-21 11:22:14'),
(8, 'Email Notifications For Recommonded stories', '0', '2018-05-21 11:22:14', '2018-05-21 11:22:14'),
(9, 'Allow messages from readers', '0', '2018-05-21 11:22:14', '2018-05-21 11:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
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
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2018-04-19 06:47:26', '2018-04-19 06:47:26'),
(2, 'role-create', 'web', '2018-04-19 06:47:26', '2018-04-19 06:47:26'),
(3, 'role-edit', 'web', '2018-04-19 06:47:26', '2018-04-19 06:47:26'),
(4, 'role-delete', 'web', '2018-04-19 06:47:26', '2018-04-19 06:47:26'),
(5, 'product-list', 'web', '2018-04-19 06:47:26', '2018-04-19 06:47:26'),
(6, 'product-create', 'web', '2018-04-19 06:47:26', '2018-04-19 06:47:26'),
(7, 'product-edit', 'web', '2018-04-19 06:47:26', '2018-04-19 06:47:26'),
(8, 'product-delete', 'web', '2018-04-19 06:47:26', '2018-04-19 06:47:26'),
(9, 'edit articles', 'web', '2018-04-19 07:21:47', '2018-04-19 07:21:47'),
(10, 'delete articles', 'web', '2018-04-19 07:21:48', '2018-04-19 07:21:48'),
(11, 'publish articles', 'web', '2018-04-19 07:21:48', '2018-04-19 07:21:48'),
(12, 'unpublish articles', 'web', '2018-04-19 07:21:48', '2018-04-19 07:21:48'),
(13, 'genre-list', 'web', '2018-04-19 07:21:48', '2018-04-19 07:21:48'),
(14, 'genre-create', 'web', '2018-04-19 07:21:48', '2018-04-19 07:21:48'),
(15, 'genre-edit', 'web', '2018-04-19 07:21:48', '2018-04-19 07:21:48'),
(16, 'genre-delete', 'web', '2018-04-19 07:21:48', '2018-04-19 07:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'writer', 'web', '2018-04-19 07:21:48', '2018-04-19 07:21:48'),
(3, 'moderator', 'web', '2018-04-19 07:21:48', '2018-04-19 07:21:48'),
(4, 'super-admin', 'web', '2018-04-19 07:21:48', '2018-04-19 07:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 2),
(5, 4),
(6, 2),
(6, 4),
(7, 4),
(8, 4),
(9, 2),
(9, 4),
(10, 4),
(11, 3),
(11, 4),
(12, 3),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `site_fevicon` varchar(255) DEFAULT NULL,
  `site_tagline` text,
  `site_phonenumber` varchar(25) DEFAULT NULL,
  `site_email` varchar(255) DEFAULT NULL,
  `site_copyright` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_logo`, `site_fevicon`, `site_tagline`, `site_phonenumber`, `site_email`, `site_copyright`, `created_at`, `updated_at`) VALUES
(1, 'site_logo_1525866613.png', 'site_fevicon_1525866613.png', 'Trippy WOrds2', '+911234657980', 'admin@trippywords.com', 'Copyright @2018', '2018-05-09 11:40:48', '2018-05-12 02:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `smtp`
--

CREATE TABLE `smtp` (
  `id` int(11) NOT NULL,
  `smtp_host` text,
  `smtp_username` text,
  `smtp_password` text,
  `smtp_port` text,
  `smtp_security` text,
  `from_name` varchar(255) DEFAULT NULL,
  `from_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smtp`
--

INSERT INTO `smtp` (`id`, `smtp_host`, `smtp_username`, `smtp_password`, `smtp_port`, `smtp_security`, `from_name`, `from_email`, `created_at`, `updated_at`) VALUES
(1, '192.168.1.15', 'admin1', '123123', '465', 'TLS', 'Admin', 'support.cosmonautgroup@gmail.com', '2018-05-09 13:14:08', '2018-05-18 08:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `role_id` int(10) NOT NULL DEFAULT '0',
  `is_delete` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_verified` tinyint(4) NOT NULL DEFAULT '0',
  `facebook_id` text COLLATE utf8mb4_unicode_ci,
  `twitter_id` text COLLATE utf8mb4_unicode_ci,
  `social_icon_status` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0-hide 1-show',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `email`, `password`, `remember_token`, `profile_image`, `description`, `role_id`, `is_delete`, `is_verified`, `facebook_id`, `twitter_id`, `social_icon_status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'chiragparmar', 'Chirag', 'Parmar', 'support@cosmonautgroup.com', '$2y$10$PUISwvspx.oaoA5oAApTFeVzyhHTTGdH148lafio6OUEGE/ILJT7.', 'nBvRybY4XzqBoQ9H7FSCWuLjcE8em7fGVqYN9eJkXyzzk88mNCsnklEbF7eA', '1524830158.jpg', 'Testigng Testigng Testigng Testigng Testigng Testigng Testigng Testigng Testigng Testigng Testigng Testigng Testigng Testigng Testigng test', 4, '0', 1, '', '', '1', '2018-06-06 10:46:25', '2018-04-19 07:05:55', '2018-06-06 05:16:25'),
(2, 'Satya-Prakash', 'Satya', 'Prakash', 'test.cosmonautgroup@gmail.com', '$2y$10$s1wzi/TuFY4x8REGZnUvV.1IB7N3P9OMa.NKOTZv8/mDjybBQJR1y', 'M5Wj9KtXPAl75jYQhIKVeWpE4Xyb7GPBuWDEufYfTgWa3sKoVUCXQpNOqy7Y', NULL, NULL, 0, '0', 1, NULL, NULL, '0', NULL, '2018-04-19 08:31:57', '2018-06-05 04:12:55'),
(4, 'Support-Team', 'Support', 'Team', 'test2.cosmonautgroup@gmail.com', '$2y$10$72JR0p7f.TBRqMcfVx0ZguBF4xyMnPHgyLYORGrCrVFAZag5QL5GO', 'aw9xMyOTEzFW12njm9iGhnBiYYCzl4Op3T1O72ZW0vsau8FHAnHq6aDeM65T', NULL, NULL, 0, '0', 1, NULL, NULL, '0', NULL, '2018-04-20 04:40:33', '2018-06-05 04:12:55'),
(5, 'Satya-Prasad', 'Satya', 'Prashad', 'satya@test.com', '$2y$10$6XYguS/gBCVFiZqo7w/8curtlVLrlwo4jIv1m9VvMgC1aL11XbRUS', 'GVzwL6Yeh39F0lamyFrCYyylgLyebQzFIsHSKW2DaoGI0itPIwE2yHL2kdDw', NULL, NULL, 0, '0', 1, NULL, NULL, '0', NULL, '2018-04-20 10:56:01', '2018-06-05 04:12:55'),
(151, 'test_marmik', 'marmik', 'test', 'marmik.cosmonautgroup@gmail.com', '$2y$10$oT/bfET7vWZ/BGYD8TbN3.nYabY8OwVd1XgblVoMvfVcagqcAV9YW', 'rkP90pOMzeE0y5bQO2A7HNisLVS3gMHOTg44G8YflkstorTm24XmWhaySAAY', NULL, NULL, 4, '0', 1, NULL, NULL, '0', '2018-05-31 19:05:49', '2018-05-18 00:08:05', '2018-06-05 04:12:55'),
(152, 'user11', 'User', 'eleven', 'user11@gmail.com', '$2y$10$6bNNoQSmjH4T0Ojgh121yeWJS9xyXEXBLIzeYl6dsCI5plfQAfld2', NULL, '1526650506.jpg', 'test', 0, '1', 0, NULL, NULL, '0', NULL, '2018-05-18 08:05:06', '2018-06-05 04:12:55'),
(153, 'mayurone', 'a', 'cosmoone', 'mayur.cosmonautgroup123@gmail.com', '$2y$10$eb078zC.lntv2E3qx.ynqOw6w4H807g1cWT.wbJ8nL9.UyBGeO7Ku', 'uU7WsEKRoUV4nrSkGR6omfKDoaoG8KYVTeHyZBTV4Zd6HGnULbQQAnXf74Sz', '1527851792.jpg', 'test', 0, '0', 1, NULL, NULL, '0', '2018-06-05 15:05:27', '2018-06-01 05:46:32', '2018-06-05 04:12:55'),
(154, 'mayurtwo', 'b', 'cosmotwo', 'mayur.cosmonautgroup2@gmail.com', '$2y$10$zDAxtUdWjYmdR1o99EXvXON4kmEVczVBQpbIqB0nEvhQCfQC9VmIO', 'UxUmwsT46cImN7JMIbmkLrVAVJ3Cf9SuDYzuknNL1T6omiSRa5m8mIXl9LSu', '1527854030.jpg', 'test', 0, '0', 1, NULL, NULL, '0', '2018-06-05 19:38:06', '2018-06-01 06:23:50', '2018-06-05 14:08:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_connection`
--

CREATE TABLE `user_connection` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `connect_user_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-no 1-yes',
  `is_request` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-no request 1-request',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_connection`
--

INSERT INTO `user_connection` (`id`, `user_id`, `connect_user_id`, `is_delete`, `is_request`, `created_at`, `updated_at`) VALUES
(21, 153, 1, 1, 0, '2018-06-05 09:33:18', '2018-06-05 09:35:35'),
(22, 1, 153, 1, 0, '2018-06-05 09:33:35', '2018-06-05 09:35:35'),
(23, 153, 154, 1, 0, '2018-06-05 09:36:25', '2018-06-05 09:36:45'),
(24, 154, 153, 1, 0, '2018-06-05 09:36:45', '2018-06-05 09:36:45'),
(25, 154, 1, 1, 0, '2018-06-05 09:40:07', '2018-06-05 10:13:45'),
(26, 1, 154, 1, 0, '2018-06-05 10:13:03', '2018-06-05 10:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_following`
--

CREATE TABLE `user_following` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL COMMENT '1 : Yes, 0 : No',
  `is_request` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_following`
--

INSERT INTO `user_following` (`id`, `user_id`, `follower_id`, `is_delete`, `is_request`, `created_at`, `updated_at`) VALUES
(10, 1, 154, 0, 0, '2018-06-06 06:47:56', '2018-06-06 01:17:56'),
(9, 1, 153, 0, 0, '2018-06-06 06:47:53', '2018-06-06 01:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_notification_status`
--

CREATE TABLE `user_notification_status` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `notification_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-off 1-on',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_notification_status`
--

INSERT INTO `user_notification_status` (`id`, `user_id`, `notification_id`, `notification_status`, `created_at`, `updated_at`) VALUES
(37, 1, 1, '0', '2018-05-21 09:19:38', '2018-05-21 09:29:22'),
(38, 1, 2, '0', '2018-05-21 09:19:55', '2018-05-21 09:29:23'),
(39, 1, 3, '0', '2018-05-21 09:29:08', '2018-05-21 09:29:08'),
(40, 1, 4, '0', '2018-05-21 09:29:10', '2018-05-21 09:29:12'),
(41, 1, 5, '0', '2018-05-21 09:29:12', '2018-05-21 09:29:13'),
(42, 1, 6, '0', '2018-05-21 09:29:14', '2018-05-21 09:29:14'),
(43, 1, 7, '0', '2018-05-21 09:29:15', '2018-05-21 09:29:16'),
(44, 1, 8, '0', '2018-05-21 09:29:17', '2018-05-21 09:29:17'),
(45, 1, 9, '0', '2018-05-21 09:29:18', '2018-05-21 09:29:19'),
(46, 151, 1, '0', '2018-05-21 11:50:58', '2018-05-21 11:53:21'),
(47, 151, 3, '0', '2018-05-21 11:51:15', '2018-05-21 11:51:36'),
(48, 151, 4, '1', '2018-05-21 11:51:16', '2018-05-21 11:53:24'),
(49, 151, 5, '0', '2018-05-21 11:51:18', '2018-05-21 11:53:16'),
(50, 151, 6, '0', '2018-05-21 11:51:19', '2018-05-21 11:52:18'),
(51, 151, 7, '0', '2018-05-21 11:51:21', '2018-05-21 11:51:42'),
(52, 151, 8, '0', '2018-05-21 11:51:22', '2018-05-21 11:52:07'),
(53, 151, 9, '0', '2018-05-21 11:51:24', '2018-05-21 11:51:54'),
(54, 151, 2, '1', '2018-05-21 11:51:26', '2018-05-21 11:53:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_preferences`
--

CREATE TABLE `user_preferences` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `preference_id` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL COMMENT '1 : Yes, 0 : No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_preferences`
--

INSERT INTO `user_preferences` (`id`, `user_id`, `preference_id`, `is_delete`, `created_at`, `updated_at`) VALUES
(534, 153, 3, 0, '2018-06-05 03:43:00', '2018-06-05 03:43:00'),
(533, 153, 2, 0, '2018-06-05 03:43:00', '2018-06-05 03:43:00'),
(532, 153, 1, 0, '2018-06-05 03:43:00', '2018-06-05 03:43:00'),
(531, 154, 3, 0, '2018-06-05 03:29:09', '2018-06-05 03:29:09'),
(530, 154, 2, 0, '2018-06-05 03:29:09', '2018-06-05 03:29:09'),
(529, 154, 1, 0, '2018-06-05 03:29:09', '2018-06-05 03:29:09'),
(528, 1, 4, 0, '2018-06-05 03:24:05', '2018-06-05 03:24:05'),
(527, 1, 3, 0, '2018-06-05 03:24:05', '2018-06-05 03:24:05'),
(526, 1, 2, 0, '2018-06-05 03:24:05', '2018-06-05 03:24:05'),
(525, 1, 1, 0, '2018-06-05 03:24:05', '2018-06-05 03:24:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp`
--
ALTER TABLE `smtp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_connection`
--
ALTER TABLE `user_connection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_following`
--
ALTER TABLE `user_following`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notification_status`
--
ALTER TABLE `user_notification_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_preferences`
--
ALTER TABLE `user_preferences`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smtp`
--
ALTER TABLE `smtp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `user_connection`
--
ALTER TABLE `user_connection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_following`
--
ALTER TABLE `user_following`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_notification_status`
--
ALTER TABLE `user_notification_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user_preferences`
--
ALTER TABLE `user_preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=535;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
