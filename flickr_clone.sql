-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2018 at 11:41 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flickr clone`
--

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `user_id`, `follower_id`, `date`) VALUES
(22, 2, 4, '2018-09-24 21:35:25'),
(21, 2, 1, '2018-09-24 18:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(15) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `url`, `date`, `title`, `description`, `user_id`) VALUES
(59, 'Uploads\\img3.jpg', '2018-09-24 18:57:29', 'Image1', 'This is the first image', 1),
(57, 'Uploads\\img1.jpeg', '2018-09-24 18:04:52', 'Image1', 'This is the first image', 2),
(58, 'Uploads\\img2.jpeg', '2018-09-24 18:51:05', 'Image 2', 'This is the second image', 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts_tags`
--

CREATE TABLE `posts_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts_tags`
--

INSERT INTO `posts_tags` (`id`, `post_id`, `tag_id`) VALUES
(18, 57, 40),
(17, 57, 39),
(16, 57, 38),
(15, 57, 37),
(14, 57, 36),
(19, 58, 36),
(20, 58, 37),
(21, 58, 38),
(22, 58, 39),
(23, 58, 40),
(24, 59, 36),
(25, 59, 37),
(26, 59, 38),
(27, 59, 39),
(28, 59, 40);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_slovenian_ci DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`, `created_time`) VALUES
(40, 'xD', '2018-09-24 17:15:40'),
(39, 'Yee', '2018-09-24 17:15:40'),
(38, 'LOL', '2018-09-24 17:15:40'),
(37, 'Lmao', '2018-09-24 17:15:40'),
(36, 'Image', '2018-09-24 17:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `auth_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `name` varchar(15) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `surname` varchar(15) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `birthday` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `auth_token`, `username`, `name`, `surname`, `email`, `password`, `birthday`) VALUES
(1, NULL, 'girman', 'Gašper', 'Irman', 'gasper.irman@gmail.com', 'test', '2000-10-02 00:00:00'),
(2, NULL, 'lčopar', 'Luka', 'Copar', 'luka.copar@gmail.com', 'test', '2000-08-02 00:00:00'),
(4, '100581263562684882617', 'Gasper Irman', 'Gasper', 'Irman', 'gasper.irman@gmail.com', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `follower_id` (`follower_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `posts_tags`
--
ALTER TABLE `posts_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
