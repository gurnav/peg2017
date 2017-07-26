-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2017 at 03:54 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31-1~dotdeb+7.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `esgiGeographik`
--

-- --------------------------------------------------------

--
-- Table structure for table `hbv_categories`
--

CREATE TABLE IF NOT EXISTS `hbv_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `hbv_categories`
--

INSERT INTO `hbv_categories` (`id`, `name`, `description`, `date_inserted`, `users_id`, `deleted`) VALUES
(1, 'Biodiversite', 'Retrouvez ici tous la biodiversité que vous aimez!', '2017-07-24 15:59:00', 1, 0),
(2, 'Nature & Homme', '', '2017-07-24 15:59:00', 2, 0),
(3, 'Environnement', 'Sauvez la nature tant qu''il en est encore temps!!', '2017-07-24 15:59:00', 3, 0),
(4, 'Univers', 'apprenez en plus sur notre univers', '2017-07-24 15:59:00', 4, 0),
(5, 'Phénomène Physique', 'Ici vous trouverez tout genre de phénomènes lié à la nature.', '2017-07-24 15:59:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hbv_comments`
--

CREATE TABLE IF NOT EXISTS `hbv_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `contents_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `hbv_comments`
--

INSERT INTO `hbv_comments` (`id`, `content`, `date_inserted`, `date_updated`, `contents_id`, `users_id`, `deleted`) VALUES
(1, 'dkdkd', '2017-06-27 20:36:45', '2017-07-24 16:44:26', 1, 3, 1),
(2, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAATFSYVDGUFBHGNIJO,K,HJNHDBSGDVSFCDQCFYVGHBNJK,JNHIBUGVYCFYGVUHBIJNKO,LP', '2017-06-27 23:13:19', NULL, 1, 1, 1),
(3, '<p>sfsfd</p>', '2017-07-15 16:07:45', '2017-07-24 16:44:29', 1, 2, 1),
(4, '<p>La biodiversitÃ© c&#39;est vraiment quelque chose de trÃ¨s interÃ©ssant :)</p>', '2017-07-24 16:45:29', NULL, 9, 1, 0),
(5, '<p>La nature est quelque chose dont l&#39;homme ne comprend toujours pas l&#39;importance...c&#39;est vraiment Ã§a le problÃ¨me :(</p>', '2017-07-24 16:50:04', NULL, 10, 1, 0),
(6, '<p>L&#39;environnement est quelque chose de merveilleux quelque soit les saisons et les annÃ©es :D !!</p>', '2017-07-24 16:50:46', NULL, 11, 1, 0),
(7, '<p>L&#39;univers est trÃ¨s grand et vaste sa fait vraiment rÃªver !!</p>', '2017-07-24 16:51:21', NULL, 12, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hbv_contents`
--

CREATE TABLE IF NOT EXISTS `hbv_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `type` enum('page','article','news') NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `categories_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `thumbnails_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `hbv_contents`
--

INSERT INTO `hbv_contents` (`id`, `title`, `content`, `status`, `type`, `date_inserted`, `date_updated`, `categories_id`, `users_id`, `thumbnails_id`, `deleted`) VALUES
(1, 'La biodiversité', 'La biodiversité, c’est l''ensemble des êtres vivants, micro-organismes, plantes, champignons ou animaux. Ce sont aussi les interactions qui les relient entre eux et avec le milieu où ils vivent. Nous, les êtres humains, faisons partie des êtres vivants, et nous interagissons dans le temps et dans l''espace avec les autres composantes de la biodiversité. C''est pourquoi on a pu en dire que c''est "le tissu vivant de la planète"  ou « la vie, dans ce qu’elle a de divers ».\r\n\r\nLa biodiversité est donc un concept beaucoup plus vaste que la simple collection d’espèces animales et végétales à laquelle on la réduit souvent : c''est la diversité de la vie à tous ses niveaux d’organisation, du gène aux espèces et aux écosystèmes. Ces niveaux sont en dynamique et interactions permanentes et sont le cadre de l''évolution du vivant. ', 1, 'article', '2017-07-24 16:19:51', '2017-07-24 16:37:54', 1, 1, 1, 1),
(2, 'La nature et l''homme', 'La nature et l''homme'', ''L’être humain n’est pas différent de la Nature. Il en fait partie. L''existence même des êtres humains sur la terre dépend de la Nature. En fait, nous ne protégeons pas la Nature — c’est la Nature qui nous protège. Les arbres et les plantes, par exemple, sont indispensables à la purification de l''énergie vitale. Chacun sait qu’il est impossible à l’homme de vivre dans le désert car il n’y a pas d’arbres pour y purifier l’énergie vitale. Si la purification de l''atmosphère ne peut se faire, la santé se détériore.\r\nAlors s’ensuivent la maladie, la diminution de la durée moyenne de vie, l’affaiblissement voire la perte de la vue. Notre existence est liée à la Nature. Un changement, même minime, dans la Nature se répercute dans notre vie sur cette planète. Nos pensées et nos actions ont également un effet sur la Nature.', 1, 'article', '2017-07-24 16:20:23', '2017-07-24 16:38:00', 2, 2, 2, 1),
(3, 'L''environnement', 'L''environnement recouvre l''ensemble des éléments (biotiques ou abiotiques) qui entourent une espèce et qui lui permettent de vivre. Notre environnement, c''est notre support de vie et toutes ses composantes : l''air, l''eau, l''atmosphère, les roches, les végétaux, les animaux...\r\nOr, notre environnement, élément clé de notre survie, est dangereusement affecté par nos activités. En effet, les milieux (air, sols, eau) sont massivement pollués. ', 1, 'article', '2017-07-24 16:22:20', '2017-07-24 16:41:02', 3, 3, 3, 1),
(4, 'L''univers', 'Les astronomes ont longtemps cherché à déterminer le nombre de galaxies dans l’Univers observable, la partie du cosmos où la lumière des objets lointains a eu le temps de nous rejoindre. Les images capturées par Hubble Deep Field prises au milieu des années 90 permirent de donner une première idée de la question. On estima alors que l’Univers observable contenait entre 100 et 200 milliards de galaxies, chacune contenant plusieurs centaines de milliards d’étoiles. Des estimations qui nous donnaient déjà le vertige à l’époque. Mais selon une étude récente (fruit d’un travail de fouilles archéologiques intergalactiques long de 15 ans) menée par Christopher Conselice de l’Université de Nottingham, au Royaume-Uni, ce chiffre serait au moins dix fois trop bas.\r\n\r\nUtilisant les données du télescope spatial Hubble développé par la NASA avec l’Agence spatiale européenne, mais aussi d’autres télescopes, des images ont été modelées en 3D. Les chercheurs ont ensuite extrapolé le nombre de galaxies présentes à différentes époques de l’histoire de l’univers. Ils se sont alors rendu compte que nos télescopes actuels ne permettent d’étudier que 10 % des galaxies. Ainsi, 90 % des galaxies de l’Univers observable sont actuellement d’une lumière trop faible et trop loin pour être perçues par nos propres moyens. Les chercheurs se sont également aperçus que lorsque l’univers n’était âgé que de seulement quelques milliards d’années, il y avait environ dix fois plus de galaxies dans un volume donné de l’espace par rapport à un volume similaire aujourd’hui. La plupart de ces galaxies auraient été des systèmes de faible masse semblables à celles des galaxies satellites autour de la Voie lactée. ', 1, 'article', '2017-07-24 16:23:31', '2017-07-24 16:46:07', 4, 4, 4, 1),
(9, 'La biodiversitÃ©', '<p>La biodiversitï¿½, cï¿½est l&#39;ensemble des ï¿½tres vivants, micro-organismes, plantes, champignons ou animaux. Ce sont aussi les interactions qui les relient entre eux et avec le milieu oï¿½ ils vivent. Nous, les ï¿½tres humains, faisons partie des ï¿½tres vivants, et nous interagissons dans le temps et dans l&#39;espace avec les autres composantes de la biodiversitï¿½. C&#39;est pourquoi on a pu en dire que c&#39;est &quot;le tissu vivant de la planï¿½te&quot; ou ï¿½ la vie, dans ce quï¿½elle a de divers ï¿½. La biodiversitï¿½ est donc un concept beaucoup plus vaste que la simple collection dï¿½espï¿½ces animales et vï¿½gï¿½tales ï¿½ laquelle on la rï¿½duit souvent : c&#39;est la diversitï¿½ de la vie ï¿½ tous ses niveaux dï¿½organisation, du gï¿½ne aux espï¿½ces et aux ï¿½cosystï¿½mes. Ces niveaux sont en dynamique et interactions permanentes et sont le cadre de l&#39;ï¿½volution du vivant.</p>', 1, 'article', '2017-07-24 16:35:13', '2017-07-24 16:40:23', 1, 1, 7, 0),
(10, 'La nature et l''homme', '<p>La nature et l&#39;homme&#39;, &#39;Lï¿½ï¿½tre humain nï¿½est pas diffï¿½rent de la Nature. Il en fait partie. L&#39;existence mï¿½me des ï¿½tres humains sur la terre dï¿½pend de la Nature. En fait, nous ne protï¿½geons pas la Nature ï¿½ cï¿½est la Nature qui nous protï¿½ge. Les arbres et les plantes, par exemple, sont indispensables ï¿½ la purification de l&#39;ï¿½nergie vitale. Chacun sait quï¿½il est impossible ï¿½ lï¿½homme de vivre dans le dï¿½sert car il nï¿½y a pas dï¿½arbres pour y purifier lï¿½ï¿½nergie vitale. Si la purification de l&#39;atmosphï¿½re ne peut se faire, la santï¿½ se dï¿½tï¿½riore. Alors sï¿½ensuivent la maladie, la diminution de la durï¿½e moyenne de vie, lï¿½affaiblissement voire la perte de la vue. Notre existence est liï¿½e ï¿½ la Nature. Un changement, mï¿½me minime, dans la Nature se rï¿½percute dans notre vie sur cette planï¿½te. Nos pensï¿½es et nos actions ont ï¿½galement un effet sur la Nature.&nbsp;</p>', 1, 'article', '2017-07-24 16:37:50', '2017-07-24 16:40:43', 2, 1, 8, 0),
(11, 'L''environnement', '<p>L&#39;environnement recouvre l&#39;ensemble des ï¿½lï¿½ments (biotiques ou abiotiques) qui entourent une espï¿½ce et qui lui permettent de vivre. Notre environnement, c&#39;est notre support de vie et toutes ses composantes : l&#39;air, l&#39;eau, l&#39;atmosphï¿½re, les roches, les vï¿½gï¿½taux, les animaux... Or, notre environnement, ï¿½lï¿½ment clï¿½ de notre survie, est dangereusement affectï¿½ par nos activitï¿½s. En effet, les milieux (air, sols, eau) sont massivement polluï¿½s.&nbsp;</p>', 1, 'news', '2017-07-24 16:38:41', '2017-07-24 16:40:54', 3, 1, 9, 0),
(12, 'L''univers', '<p>Les astronomes ont longtemps cherchï¿½ ï¿½ dï¿½terminer le nombre de galaxies dans lï¿½Univers observable, la partie du cosmos oï¿½ la lumiï¿½re des objets lointains a eu le temps de nous rejoindre. Les images capturï¿½es par Hubble Deep Field prises au milieu des annï¿½es 90 permirent de donner une premiï¿½re idï¿½e de la question. On estima alors que lï¿½Univers observable contenait entre 100 et 200 milliards de galaxies, chacune contenant plusieurs centaines de milliards dï¿½ï¿½toiles. Des estimations qui nous donnaient dï¿½jï¿½ le vertige ï¿½ lï¿½ï¿½poque. Mais selon une ï¿½tude rï¿½cente (fruit dï¿½un travail de fouilles archï¿½ologiques intergalactiques long de 15 ans) menï¿½e par Christopher Conselice de lï¿½Universitï¿½ de Nottingham, au Royaume-Uni, ce chiffre serait au moins dix fois trop bas. Utilisant les donnï¿½es du tï¿½lescope spatial Hubble dï¿½veloppï¿½ par la NASA avec lï¿½Agence spatiale europï¿½enne, mais aussi dï¿½autres tï¿½lescopes, des images ont ï¿½tï¿½ modelï¿½es en 3D. Les chercheurs ont ensuite extrapolï¿½ le nombre de galaxies prï¿½sentes ï¿½ diffï¿½rentes ï¿½poques de lï¿½histoire de lï¿½univers. Ils se sont alors rendu compte que nos tï¿½lescopes actuels ne permettent dï¿½ï¿½tudier que 10 % des galaxies. Ainsi, 90 % des galaxies de lï¿½Univers observable sont actuellement dï¿½une lumiï¿½re trop faible et trop loin pour ï¿½tre perï¿½ues par nos propres moyens. Les chercheurs se sont ï¿½galement aperï¿½us que lorsque lï¿½univers nï¿½ï¿½tait ï¿½gï¿½ que de seulement quelques milliards dï¿½annï¿½es, il y avait environ dix fois plus de galaxies dans un volume donnï¿½ de lï¿½espace par rapport ï¿½ un volume similaire aujourdï¿½hui. La plupart de ces galaxies auraient ï¿½tï¿½ des systï¿½mes de faible masse semblables ï¿½ celles des galaxies satellites autour de la Voie lactï¿½e.&nbsp;</p>', 1, 'page', '2017-07-24 16:43:07', '2017-07-24 16:46:26', 4, 1, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hbv_messages`
--

CREATE TABLE IF NOT EXISTS `hbv_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `threads_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `signaled` tinyint(4) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `hbv_messages`
--

INSERT INTO `hbv_messages` (`id`, `content`, `date_inserted`, `date_updated`, `threads_id`, `users_id`, `signaled`, `deleted`) VALUES
(1, 'Paul le popol', '2017-07-22 14:35:16', NULL, 1, 2, 0, 0),
(2, 'un truc vrai', '2017-07-22 16:45:05', NULL, 1, 1, 0, 0),
(3, 'On s''en bats les couilles', '2017-07-22 16:47:06', NULL, 3, 8, 0, 1),
(4, '<p>test final</p>', '2017-07-22 18:14:38', NULL, 1, 2, 0, 1),
(5, '<p>testfdp</p>', '2017-07-22 18:21:24', NULL, 1, 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hbv_multimedias`
--

CREATE TABLE IF NOT EXISTS `hbv_multimedias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `path` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `hbv_multimedias`
--

INSERT INTO `hbv_multimedias` (`id`, `name`, `path`, `date_inserted`, `users_id`, `deleted`) VALUES
(7, 'biodiversite', '298a70cb46434f19022262982626776d18cf0f48.jpg', '2017-07-24 16:28:45', 1, 0),
(8, 'nature', '44ce188bd77378ed4b4c471010daa8ae61950804.jpg', '2017-07-24 16:30:17', 1, 0),
(9, 'environment', '6648f581664e5848a8c7ad41de59a6a9847ce537.jpg', '2017-07-24 16:31:30', 1, 0),
(10, 'universe', '2ea6b322a10144e8a298e554397865b8c3dd7611.jpg', '2017-07-24 16:42:34', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hbv_threads`
--

CREATE TABLE IF NOT EXISTS `hbv_threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  `topics_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `hbv_threads`
--

INSERT INTO `hbv_threads` (`id`, `title`, `description`, `date_inserted`, `date_updated`, `users_id`, `topics_id`, `deleted`) VALUES
(1, 'Presentation of esgi-geographic', 'Tageule gurnav', '2017-07-22 14:34:43', NULL, 2, 2, 0),
(2, 'MORTAL KOMBAT', '<p>DUUDUUUUUDUUDUDUUUUUUUUDUUDUDUDUDUDUDUUD! MORTAAAL KOMBAAATTTT !</p>', '2017-07-24 10:38:17', '2017-07-24 13:18:28', 2, 2, 1),
(3, 'teste111', '<p>BGSXDFENH</p>', '2017-07-24 14:30:17', NULL, 2, 1, 0),
(4, 'test1233455', '<p>gjfdj;chvrhejbvkj:erkjv lierhvilerh v!lih erilvh erlihv!lierhvlirvierh vier oeri viÂ </p>', '2017-07-24 14:42:49', NULL, 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hbv_topics`
--

CREATE TABLE IF NOT EXISTS `hbv_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hbv_topics`
--

INSERT INTO `hbv_topics` (`id`, `name`, `description`, `date_inserted`, `date_updated`, `users_id`, `deleted`) VALUES
(1, 'test', 'a test to show to paul', '2017-07-11 14:56:10', NULL, 2, 0),
(2, 'esgi-geograhpic topic', 'Topic about esgi geographic', '2017-07-22 14:33:49', NULL, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hbv_users`
--

CREATE TABLE IF NOT EXISTS `hbv_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` char(60) NOT NULL,
  `img` tinytext,
  `status` tinyint(1) NOT NULL,
  `date_inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `newsletters` tinyint(1) NOT NULL,
  `rights` int(11) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `hbv_users`
--

INSERT INTO `hbv_users` (`id`, `email`, `firstname`, `lastname`, `username`, `password`, `img`, `status`, `date_inserted`, `date_updated`, `newsletters`, `rights`, `deleted`) VALUES
(1, 'singh.g@outlook.fr', 'gurnavdeep', 'singh', 'gurnav', '$2y$10$AEqaQ9G3U2Lu8Dsgv9uNfetscBiQL2LLjTz3/raCyA.qerPbRp5Du', 'avatar.png', 1, '2017-07-24 15:43:30', '2017-07-24 15:44:39', 0, 3, 0),
(2, 'reload@yopmail.com', 'jeremy', 'louis', 'oqomiz', '$2y$10$AEqaQ9G3U2Lu8Dsgv9uNfetscBiQL2LLjTz3/raCyA.qerPbRp5Du', 'avatar.png', 1, '2017-07-24 15:46:59', NULL, 0, 2, 0),
(3, 'ptitDoudoux@yopmail.com', 'thomas', 'dudoux', 'ThomasD', '$2y$10$AEqaQ9G3U2Lu8Dsgv9uNfetscBiQL2LLjTz3/raCyA.qerPbRp5Du', 'avatar.png', 1, '2017-07-24 15:48:12', NULL, 0, 3, 0),
(4, 'paulo@yopmail.com', 'paul', 'negrerie', 'paulo', '$2y$10$AEqaQ9G3U2Lu8Dsgv9uNfetscBiQL2LLjTz3/raCyA.qerPbRp5Du', 'avatar.png', 1, '2017-07-24 15:48:54', NULL, 0, 1, 0),
(5, 'thomas.dudoux@gmail.com', 'user', 'invited', 'test', '$2y$10$AEqaQ9G3U2Lu8Dsgv9uNfetscBiQL2LLjTz3/raCyA.qerPbRp5Du', 'avatar.png', 1, '2017-03-10 14:51:59', '2017-07-24 15:49:57', 1, 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
