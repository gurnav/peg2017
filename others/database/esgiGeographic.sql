-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 30 Mars 2017 à 16:43
-- Version du serveur :  5.7.17-0ubuntu0.16.04.1
-- Version de PHP :  7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `esgiGeographik`
--

-- --------------------------------------------------------

--
-- Structure de la table `hbv_categories`
--

CREATE TABLE `hbv_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hbv_comments`
--

CREATE TABLE `hbv_comments` (
  `id` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  `contents_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hbv_configs`
--

CREATE TABLE `hbv_configs` (
  `id` int(11) NOT NULL,
  `variable` varchar(45) NOT NULL,
  `data` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hbv_contents`
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
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hbv_likes`
--

CREATE TABLE `hbv_likes` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `contents_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hbv_menus`
--

CREATE TABLE `hbv_menus` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  `menus_id` int(11) NOT NULL,
  `contents_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hbv_messages`
--

CREATE TABLE `hbv_messages` (
  `id` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  `threads_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hbv_multimedias`
--

CREATE TABLE `hbv_multimedias` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `path` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hbv_newsletters`
--

CREATE TABLE `hbv_newsletters` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hbv_roles`
--

CREATE TABLE `hbv_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `rights` int(11) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hbv_threads`
--

CREATE TABLE `hbv_threads` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  `topics_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hbv_topics`
--

CREATE TABLE `hbv_topics` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hbv_users`
--

CREATE TABLE `hbv_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` char(60) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  `roles_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `hbv_users`
--

INSERT INTO `hbv_users` (`id`, `email`, `firstname`, `lastname`, `username`, `password`, `status`, `date_inserted`, `date_updated`, `roles_id`) VALUES
(1, 'thomas.dudoux@gmail.com', 'Dudoux', 'Thomas', 'PtitDoudoux', '$2y$10$FwOfZbn4G7rAWGWELR/k8.Jh4xarvK2jOjC1zE9DrBzKbp5XmaIa6', 0, '2017-03-10 14:51:59', NULL, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `hbv_categories`
--
ALTER TABLE `hbv_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hbv_comments`
--
ALTER TABLE `hbv_comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hbv_configs`
--
ALTER TABLE `hbv_configs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hbv_contents`
--
ALTER TABLE `hbv_contents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hbv_likes`
--
ALTER TABLE `hbv_likes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hbv_menus`
--
ALTER TABLE `hbv_menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hbv_messages`
--
ALTER TABLE `hbv_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hbv_multimedias`
--
ALTER TABLE `hbv_multimedias`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hbv_newsletters`
--
ALTER TABLE `hbv_newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hbv_roles`
--
ALTER TABLE `hbv_roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hbv_threads`
--
ALTER TABLE `hbv_threads`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hbv_topics`
--
ALTER TABLE `hbv_topics`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hbv_users`
--
ALTER TABLE `hbv_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `hbv_categories`
--
ALTER TABLE `hbv_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hbv_comments`
--
ALTER TABLE `hbv_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hbv_configs`
--
ALTER TABLE `hbv_configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hbv_contents`
--
ALTER TABLE `hbv_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hbv_likes`
--
ALTER TABLE `hbv_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hbv_menus`
--
ALTER TABLE `hbv_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hbv_messages`
--
ALTER TABLE `hbv_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hbv_multimedias`
--
ALTER TABLE `hbv_multimedias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hbv_newsletters`
--
ALTER TABLE `hbv_newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hbv_roles`
--
ALTER TABLE `hbv_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hbv_threads`
--
ALTER TABLE `hbv_threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hbv_topics`
--
ALTER TABLE `hbv_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hbv_users`
--
ALTER TABLE `hbv_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
