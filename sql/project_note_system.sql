-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2021 at 06:41 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_note_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_details` text COLLATE utf8mb4_unicode_ci,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `action_name`, `action_details`, `create_at`) VALUES
(1, 3, 'login', 'login to account', '2021-03-28 10:03:59'),
(2, 3, 'login', 'login to account', '2021-03-28 10:03:59'),
(3, 3, 'login', 'login to account', '2021-03-28 10:32:45'),
(4, 3, 'login', 'login to account', '2021-03-28 10:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `old_data` text COLLATE utf8mb4_unicode_ci,
  `change_count` int(11) DEFAULT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `user_id`, `old_data`, `change_count`, `reg_time`) VALUES
(1, '1', 0, '', 0, '2021-03-19 17:13:20'),
(2, 'first', 0, '', 0, '2021-03-19 17:14:29'),
(3, '200', 0, '', 0, '2021-03-25 18:47:25'),
(4, 'other', 0, '', 0, '2021-03-27 19:10:18'),
(5, 'other', 0, '', 0, '2021-03-27 19:13:30'),
(6, 'asdfasdf', 0, '', 0, '2021-03-27 19:13:52'),
(7, 'add cat', 0, '', 0, '2021-03-27 19:16:27'),
(8, 'system', 0, '', 0, '2021-03-27 19:17:30'),
(9, 'another', 0, '', 0, '2021-03-27 19:17:36'),
(10, 'shaiful', 0, '', 0, '2021-03-27 19:22:07'),
(11, 'asdf', 0, '', 0, '2021-03-27 19:22:30'),
(12, 'try more', 0, '', 0, '2021-03-28 11:05:39'),
(13, 'and more', 0, '', 0, '2021-03-28 11:05:47'),
(14, 'also more', 0, '', 0, '2021-03-28 11:05:54'),
(15, 'too more', 0, '', 0, '2021-03-28 11:06:01'),
(16, 'last one', 0, '', 0, '2021-03-28 11:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `category_permission`
--

CREATE TABLE `category_permission` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `label` int(11) DEFAULT '0',
  `note_data` text COLLATE utf8mb4_unicode_ci,
  `old_data` text COLLATE utf8mb4_unicode_ci,
  `change_count` int(11) DEFAULT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `user_id`, `category_id`, `label`, `note_data`, `old_data`, `change_count`, `reg_time`) VALUES
(1, 9, 1, 0, 'this is note data', NULL, 0, '2021-03-26 06:12:52'),
(2, 9, 1, 0, 'this is note data', NULL, 0, '2021-03-26 06:54:43'),
(3, 3, 2, 0, 'fixing ', NULL, 0, '2021-03-26 07:53:59'),
(4, 3, 2, 0, 'note update', NULL, 0, '2021-03-26 08:03:50'),
(5, 3, 2, 0, 'my update', NULL, 0, '2021-03-26 08:04:24'),
(6, 3, 2, 0, 'system update', NULL, 0, '2021-03-26 08:04:28'),
(7, 3, 2, 0, 'system test', NULL, 0, '2021-03-26 08:04:31'),
(9, 3, 2, 0, 'আমার সোনার বাংলা', NULL, 0, '2021-03-26 08:44:39'),
(10, 3, 1, 0, 'test', NULL, 0, '2021-03-26 09:24:56'),
(11, 3, 1, 0, 'try out', NULL, 0, '2021-03-26 09:28:16'),
(12, 3, 2, 0, 'try out', NULL, 0, '2021-03-26 09:28:30'),
(13, 3, 1, 0, 'category one', NULL, 0, '2021-03-26 09:33:55'),
(14, 3, 1, 0, 'category one wnd time', NULL, 0, '2021-03-26 09:34:04'),
(15, 3, 1, 0, 'third time', NULL, 0, '2021-03-26 09:34:09'),
(16, 3, 1, 0, 'roure a;lsdjf j;asdf', NULL, 0, '2021-03-26 09:34:15'),
(17, 3, 1, 0, 'system', NULL, 0, '2021-03-27 10:55:04'),
(18, 3, 1, 0, 'update test', NULL, 0, '2021-03-27 10:57:50'),
(19, 3, 3, 0, 'start', NULL, 0, '2021-03-27 17:27:38'),
(20, 3, 3, 0, 'work with five', NULL, 0, '2021-03-27 17:27:45'),
(21, 3, 3, 0, 'working working working working working working working working working working working working working working working working working working working working working working working working working working working working working working working working working working working working working working working working working working ', NULL, 0, '2021-03-27 17:28:25'),
(22, 3, 3, 0, 'working working working working working working working working working working working working working ', NULL, 0, '2021-03-27 17:28:32'),
(23, 3, 3, 0, 'working working working working working working working working ', NULL, 0, '2021-03-27 17:28:35'),
(24, 3, 3, 0, 'working working working working working working working working ', NULL, 0, '2021-03-27 17:28:36'),
(25, 3, 3, 0, 'working working working working working working working working ', NULL, 0, '2021-03-27 17:28:38'),
(26, 3, 3, 0, 'working working working working working working working working ', NULL, 0, '2021-03-27 17:28:40'),
(27, 3, 3, 0, 'working ', NULL, 0, '2021-03-27 17:28:42'),
(28, 3, 3, 0, 'working working working working working working working working working working working working working working ', NULL, 0, '2021-03-27 17:30:45'),
(29, 3, 3, 0, 'amar system', NULL, 0, '2021-03-27 17:30:55'),
(30, 3, 3, 0, 'ojj', NULL, 0, '2021-03-27 18:31:11'),
(31, 3, 3, 0, 'system update', NULL, 0, '2021-03-27 18:31:25'),
(32, 3, 3, 0, 'test update', NULL, 0, '2021-03-27 18:33:06'),
(33, 3, 3, 0, 'hmm', NULL, 0, '2021-03-27 18:39:32'),
(34, 3, 3, 0, 'ok', NULL, 0, '2021-03-27 18:39:39'),
(35, 3, 3, 0, 'hhhh', NULL, 0, '2021-03-27 18:39:45'),
(36, 3, 3, 0, 'sys', NULL, 0, '2021-03-27 18:40:05'),
(37, 3, 3, 0, 'ok', NULL, 0, '2021-03-27 18:40:12'),
(38, 3, 3, 0, 'ok', NULL, 0, '2021-03-27 18:40:15'),
(39, 3, 3, 0, 'xhjfvb', NULL, 0, '2021-03-27 18:40:19'),
(40, 3, 3, 0, 'ok', NULL, 0, '2021-03-27 18:42:19'),
(41, 3, 3, 0, 'syste m', NULL, 0, '2021-03-27 18:42:26'),
(42, 3, 3, 0, 'ok', NULL, 0, '2021-03-27 18:42:54'),
(43, 3, 3, 0, 'ok', NULL, 0, '2021-03-27 18:44:08'),
(44, 3, 3, 0, 'system', NULL, 0, '2021-03-27 18:44:15'),
(45, 3, 3, 0, '20', NULL, 0, '2021-03-27 18:45:11'),
(46, 3, 3, 0, 'ok', NULL, 0, '2021-03-27 18:46:41'),
(47, 3, 3, 0, 'asdf', NULL, 0, '2021-03-27 18:46:55'),
(48, 3, 3, 0, 'asdf', NULL, 0, '2021-03-27 18:46:58'),
(49, 3, 3, 0, 'update', NULL, 0, '2021-03-27 18:51:44'),
(50, 3, 3, 0, 'system', NULL, 0, '2021-03-27 18:51:46'),
(51, 3, 3, 0, 'accha kaj kore', NULL, 0, '2021-03-27 18:51:51'),
(52, 3, 3, 0, 'taile ok', NULL, 0, '2021-03-27 18:51:54'),
(53, 3, 3, 0, 'thik ase', NULL, 0, '2021-03-27 18:51:56'),
(54, 3, 3, 0, 'ami skh', NULL, 0, '2021-03-27 18:51:59'),
(55, 3, 3, 0, 'adfasdf', NULL, 0, '2021-03-27 18:52:00'),
(56, 3, 3, 0, 'system update', NULL, 0, '2021-03-27 18:53:40'),
(57, 3, 3, 0, 'done', NULL, 0, '2021-03-27 18:53:42'),
(58, 3, 3, 0, 'ok', NULL, 0, '2021-03-27 18:53:44'),
(59, 3, 3, 0, 'fixed', NULL, 0, '2021-03-27 18:53:46'),
(60, 3, 3, 0, '00 cat', NULL, 0, '2021-03-27 18:53:58'),
(61, 3, 3, 0, 'ok', NULL, 0, '2021-03-27 18:54:00'),
(62, 3, 3, 0, ' asdf', NULL, 0, '2021-03-27 18:54:03'),
(63, 3, 3, 0, '   asdf', NULL, 0, '2021-03-27 18:54:05'),
(64, 3, 3, 0, 'owo', NULL, 0, '2021-03-27 18:54:11'),
(65, 3, 3, 0, '   lsadkf asdf    ', NULL, 0, '2021-03-27 18:54:15'),
(66, 3, 3, 0, 'last update', NULL, 0, '2021-03-27 19:01:32'),
(67, 3, 3, 0, 'system update', NULL, 0, '2021-03-27 19:01:42'),
(68, 3, 3, 0, 'ok', NULL, 0, '2021-03-27 19:01:44'),
(69, 3, 3, 0, 'we are happy', NULL, 0, '2021-03-27 19:01:50'),
(70, 3, 3, 0, 'cool ', NULL, 0, '2021-03-27 19:01:54'),
(71, 3, 3, 0, 'upjaja', NULL, 0, '2021-03-27 19:02:11'),
(72, 3, 3, 0, 'habab', NULL, 0, '2021-03-27 19:02:20'),
(73, 3, 3, 0, 'bannna', NULL, 0, '2021-03-27 19:02:24'),
(74, 3, 3, 0, 'ok', NULL, 0, '2021-03-27 19:02:30'),
(75, 3, 3, 0, 'ajjaa', NULL, 0, '2021-03-27 19:02:35'),
(76, 3, 3, 0, 'hHzbz', NULL, 0, '2021-03-27 19:02:38'),
(77, 3, 2, 0, 'ok', NULL, 0, '2021-03-27 19:03:14'),
(78, 3, 2, 0, 'hahaba', NULL, 0, '2021-03-27 19:03:17'),
(79, 3, 2, 0, 'বৃকৃককিি', NULL, 0, '2021-03-27 19:03:22'),
(80, 3, 2, 0, 'ok', NULL, 0, '2021-03-27 19:08:33'),
(81, 3, 9, 0, 'start', NULL, 0, '2021-03-27 19:17:44'),
(82, 3, 9, 0, 'system start success', NULL, 0, '2021-03-27 19:17:55'),
(83, 3, 9, 0, 'test', NULL, 0, '2021-03-27 19:20:21'),
(84, 3, 9, 0, 'okk', NULL, 0, '2021-03-27 19:20:27'),
(85, 3, 9, 0, 'working', NULL, 0, '2021-03-27 19:20:48'),
(86, 3, 9, 0, 'system', NULL, 0, '2021-03-27 19:20:51'),
(87, 3, 9, 0, 'a;lskdf', NULL, 0, '2021-03-27 19:20:52'),
(88, 3, 9, 0, 'asldkfj', NULL, 0, '2021-03-27 19:20:53'),
(89, 3, 9, 0, 'asdf asdf ', NULL, 0, '2021-03-27 19:20:55'),
(90, 3, 9, 0, 'asdflkaf ', NULL, 0, '2021-03-27 19:20:57'),
(91, 3, 9, 0, 'asldfk a', NULL, 0, '2021-03-27 19:20:58'),
(92, 3, 9, 0, 'df', NULL, 0, '2021-03-27 19:20:59'),
(93, 3, 9, 0, ' yslasf ', NULL, 0, '2021-03-27 19:21:09'),
(94, 3, 9, 0, 'afklas;djf  afklas;djf afklas;djf afklas;djf ', NULL, 0, '2021-03-27 19:21:15'),
(95, 3, 9, 0, 'afklas;djf afklas;djf afklas;djf afklas;djf afklas;djf afklas;djf afklas;djf afklas;djf afklas;djf afklas;djf afklas;djf afklas;djf afklas;djf afklas;djf afklas;djf afklas;djf ', NULL, 0, '2021-03-27 19:21:18'),
(96, 3, 9, 0, 'asdf', NULL, 0, '2021-03-27 19:21:21'),
(97, 3, 9, 0, 'ok', NULL, 0, '2021-03-27 19:21:24'),
(98, 3, 9, 0, 'update', NULL, 0, '2021-03-27 19:21:25'),
(99, 3, 9, 0, 'system\\', NULL, 0, '2021-03-27 19:21:27'),
(100, 3, 9, 0, 'আমার সোনার বাংলা', NULL, 0, '2021-03-27 19:21:35'),
(101, 3, 9, 0, 'আমি তোমায়', NULL, 0, '2021-03-27 19:21:40'),
(102, 3, 9, 0, 'ভালোবাসি', NULL, 0, '2021-03-27 19:21:43'),
(103, 3, 15, 0, 'system', NULL, 0, '2021-03-28 12:03:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pass` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pass_change` int(11) DEFAULT '0',
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`, `pass_change`, `reg_time`) VALUES
(3, '111', '$2y$10$d0i.LPsfMyo4LlPR1ZVIvu/muvTaDKkHVdAAUqJ7uFW97Z8./hwZO', 'shaiful@gmail.com', 0, '2021-03-09 07:40:36'),
(7, '1111', '$2y$10$Gxd9Af/URei1jeU/bMwTK.KZMVBGpkfUkqOmK40XXhJX86JNHQl0G', 'shaifula@gmail.com', 0, '2021-03-19 08:49:49'),
(8, '222', '$2y$10$Ef3zYN4sk8Zv2Hwsg3pKre9ZU4JaHRHYQYqMU6kk4pLxdyAadA4w.', '222@gmail.com', 0, '2021-03-19 09:01:03'),
(9, '333', '$2y$10$UyQpiHLkwSqYjknByqQMPeitDP47iZojHl1iwp24mS7XloZnMIiyO', '333@gmail.com', 0, '2021-03-19 09:09:46'),
(10, '111', '$2y$10$AimN7kXq3TB3rwx8C5Mm2uYwKeH27dW6pm/3ZrG.IHMfktVyp5Js6', NULL, 0, '2021-03-28 02:46:06'),
(11, '111', '$2y$10$hU6oQO1pLNf4fn4o8DicXeCdqwx3ZCNDiAQcMPZZfFWx0.cC8mj3G', NULL, 0, '2021-03-28 02:46:06'),
(12, '222', '$2y$10$1KVlW33MnZfCX4wO8ME5YOYdcW9pzvBNrJ8YwgbpA/LL2RvauHeNG', 'email@gmail.com', 0, '2021-03-28 02:50:38'),
(13, '222', '$2y$10$BhTFElyTU0IOCGPTL7zGl.qlIk2Fusux3lSoePz.ooGRyg5lerVp6', 'email@gmail.com', 0, '2021-03-28 02:50:38'),
(14, '3313', '$2y$10$vFOEiOLU2Pt1hRcN72HoWeYYjL0vbw6WjFVKgDd3ZA7N/jy9GfOyy', '3133@gmail.com', 0, '2021-03-29 04:13:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_permission`
--
ALTER TABLE `category_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `category_permission`
--
ALTER TABLE `category_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
