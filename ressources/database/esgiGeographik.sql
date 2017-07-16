-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2017 at 12:55 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esgiGeographik`
--

-- --------------------------------------------------------

--
-- Table structure for table `hbv_categories`
--

CREATE TABLE `hbv_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hbv_comments`
--

CREATE TABLE `hbv_comments` (
  `id` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  `contents_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hbv_configs`
--

CREATE TABLE `hbv_configs` (
  `id` int(11) NOT NULL,
  `variable` varchar(45) NOT NULL,
  `data` varchar(45) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hbv_contents`
--

CREATE TABLE `hbv_contents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `type` enum('page','article','news') NOT NULL,
  `isCommentable` tinyint(1) NOT NULL DEFAULT '1',
  `isLikeable` tinyint(1) NOT NULL DEFAULT '1',
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  `categories_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hbv_contents`
--

INSERT INTO `hbv_contents` (`id`, `title`, `content`, `status`, `type`, `isCommentable`, `isLikeable`, `date_inserted`, `date_updated`, `categories_id`, `users_id`, `deleted`) VALUES
(1, 'lorem Ipsum', '\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pellentesque ac arcu ac fringilla. Etiam sit amet sollicitudin massa. Pellentesque eleifend tortor a purus ultricies, vel sollicitudin orci euismod. Morbi sollicitudin purus eu turpis dictum blandit. Aenean a feugiat nisi. Nam tortor lorem, interdum eu nulla et, ultricies egestas metus. Cras eu risus nunc.\r\n\r\nEtiam sollicitudin aliquam nibh quis hendrerit. Integer mollis auctor suscipit. Sed non mi a nibh ultricies maximus ut sed mauris. Integer ut blandit ante. Praesent odio elit, pulvinar ut leo et, mattis laoreet velit. Nam maximus nisi metus, vitae pharetra dolor facilisis non. Vestibulum fermentum odio sit amet risus mollis, sed pellentesque leo ultricies.\r\n\r\nInteger vel nisl est. Aliquam scelerisque tellus ac velit tristique, vel egestas eros aliquam. In quam diam, luctus nec ex et, ultricies fringilla enim. Cras varius semper dictum. Pellentesque vitae fringilla velit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam pellentesque gravida turpis, nec semper purus vehicula vitae. Suspendisse vestibulum fermentum mi, in consectetur eros luctus non. In a volutpat urna. Phasellus pulvinar at leo vitae convallis.\r\n\r\nVivamus varius sapien nunc, a placerat mi feugiat vitae. Proin hendrerit at metus eget euismod. Donec lacinia rhoncus diam, vel accumsan erat lacinia sit amet. Cras ornare sit amet lorem in facilisis. Morbi est ipsum, pellentesque et malesuada sit amet, ornare sed erat. Proin vulputate sem ut ullamcorper dictum. Nam dolor turpis, lacinia at ex sed, aliquet sagittis enim. Morbi tristique non leo vel fringilla.\r\n\r\nPellentesque vulputate augue vel commodo eleifend. Mauris vel odio porta, dignissim est at, congue nisl. Vestibulum in velit metus. Cras non lectus eget elit imperdiet blandit tincidunt ac lectus. Sed at tincidunt erat, nec hendrerit ex. Donec felis enim, porta in nunc at, pulvinar congue massa. Donec vulputate neque et nulla accumsan mollis quis non tellus. Nam fermentum massa non gravida maximus. Nunc commodo massa ac ligula ultricies, non consequat dui molestie. ', 0, 'article', 1, 1, '2017-05-02 15:10:24', NULL, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hbv_likes`
--

CREATE TABLE `hbv_likes` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `contents_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hbv_menus`
--

CREATE TABLE `hbv_menus` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  `menus_id` int(11) NOT NULL,
  `contents_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hbv_messages`
--

CREATE TABLE `hbv_messages` (
  `id` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  `threads_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hbv_multimedias`
--

CREATE TABLE `hbv_multimedias` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `path` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hbv_multimedias`
--

INSERT INTO `hbv_multimedias` (`id`, `name`, `path`, `date_inserted`, `users_id`, `deleted`) VALUES
(3, 'test', '85ee989b2c2b0512c889dae53b4769e1eff3825c.jpg', '2017-06-11 11:46:39', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hbv_newsletters`
--

CREATE TABLE `hbv_newsletters` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hbv_roles`
--

CREATE TABLE `hbv_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `rights` int(11) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hbv_threads`
--

CREATE TABLE `hbv_threads` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  `topics_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hbv_topics`
--

CREATE TABLE `hbv_topics` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hbv_users`
--

CREATE TABLE `hbv_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` char(60) NOT NULL,
  `img` tinytext,
  `status` tinyint(1) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  `rights` int(11) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hbv_users`
--

INSERT INTO `hbv_users` (`id`, `email`, `firstname`, `lastname`, `username`, `password`, `img`, `status`, `date_inserted`, `date_updated`, `rights`, `deleted`) VALUES
(1, 'thomas.dudoux@gmail.com', 'Dudoux', 'Th', 'PtitDoudoux', '$2y$10$FwOfZbn4G7rAWGWELR/k8.Jh4xarvK2jOjC1zE9DrBzKbp5XmaIa6', NULL, 1, '2017-03-10 14:51:59', NULL, 2, 0),
(2, 'test@te.st', 'test', 'teest', 'test', '$2y$10$AEqaQ9G3U2Lu8Dsgv9uNfetscBiQL2LLjTz3/raCyA.qerPbRp5Du', NULL, 1, '2017-04-26 18:14:39', NULL, 3, 0),
(3, 'lolo@gmail.com', 'Laura', 'DUDOUX', 'Tayga', '$2y$10$7wwwkqexrs/eMY1TorfHyuIw9uQAag1R5jhGBZ7oC7t/uO5Cb6Eee', '85ee989b2c2b0512c889dae53b4769e1eff3825c.jpg', 1, '2017-06-11 12:53:26', NULL, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hbv_categories`
--
ALTER TABLE `hbv_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hbv_comments`
--
ALTER TABLE `hbv_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hbv_configs`
--
ALTER TABLE `hbv_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hbv_contents`
--
ALTER TABLE `hbv_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hbv_likes`
--
ALTER TABLE `hbv_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hbv_menus`
--
ALTER TABLE `hbv_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hbv_messages`
--
ALTER TABLE `hbv_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hbv_multimedias`
--
ALTER TABLE `hbv_multimedias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hbv_newsletters`
--
ALTER TABLE `hbv_newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hbv_roles`
--
ALTER TABLE `hbv_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hbv_threads`
--
ALTER TABLE `hbv_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hbv_topics`
--
ALTER TABLE `hbv_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hbv_users`
--
ALTER TABLE `hbv_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hbv_categories`
--
ALTER TABLE `hbv_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hbv_comments`
--
ALTER TABLE `hbv_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hbv_configs`
--
ALTER TABLE `hbv_configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hbv_contents`
--
ALTER TABLE `hbv_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hbv_likes`
--
ALTER TABLE `hbv_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hbv_menus`
--
ALTER TABLE `hbv_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hbv_messages`
--
ALTER TABLE `hbv_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hbv_multimedias`
--
ALTER TABLE `hbv_multimedias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hbv_newsletters`
--
ALTER TABLE `hbv_newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hbv_roles`
--
ALTER TABLE `hbv_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hbv_threads`
--
ALTER TABLE `hbv_threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hbv_topics`
--
ALTER TABLE `hbv_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hbv_users`
--
ALTER TABLE `hbv_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
