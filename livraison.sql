-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 26 Juin 2020 à 10:37
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `livraison`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8_bin NOT NULL,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `email`, `mot_de_passe`, `nom`, `prenom`) VALUES
(1, 'admin@admin.com', '123456', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client_source` int(11) NOT NULL,
  `note` int(1) NOT NULL,
  `texte` varchar(512) COLLATE utf8_bin NOT NULL,
  `id_client_destinataire` int(11) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_client_source` (`id_client_source`,`id_client_destinataire`),
  KEY `id_client_destinataire` (`id_client_destinataire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Contenu de la table `avis`
--

INSERT INTO `avis` (`id`, `id_client_source`, `note`, `texte`, `id_client_destinataire`, `date_creation`) VALUES
(1, 3, 5, 'qsdkmqlsk', 3, '2016-04-09 15:38:23'),
(2, 3, 1, 'qsdqsd', 3, '2016-04-09 15:38:42'),
(3, 3, 1, 'ksdk jlksdjlk', 3, '2016-04-09 16:47:54'),
(4, 3, 3, 'dssddssddsds', 3, '2016-04-09 16:47:58'),
(5, 3, 2, 'qsd qsd qs', 3, '2016-04-09 17:16:27'),
(6, 3, 3, 'qsd qsd qs', 3, '2016-04-09 17:16:33'),
(7, 3, 5, 'qsdsqdqsdqsd', 6, '2020-06-26 09:31:18');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8_bin NOT NULL,
  `photo` varchar(512) COLLATE utf8_bin NOT NULL DEFAULT '',
  `cin` varchar(512) COLLATE utf8_bin NOT NULL,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(255) COLLATE utf8_bin NOT NULL,
  `naissance` date NOT NULL,
  `sexe` int(1) NOT NULL,
  `telephone` varchar(20) COLLATE utf8_bin NOT NULL,
  `adresse` text COLLATE utf8_bin NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id`, `email`, `mot_de_passe`, `photo`, `cin`, `nom`, `prenom`, `naissance`, `sexe`, `telephone`, `adresse`, `active`, `date_creation`) VALUES
(3, 'aa@aa.com', '123456', 'images/img2.jpg', '', 'Saidi', 'Ahmed', '0000-00-00', 0, '24816880', 'qksjdlkqsjldkqjsldkjm\r\n\r\nqsldqmlsdkmqslkdmqlksm', 1, '2016-03-29 19:57:47'),
(6, 'test@test.com', '123456', 'images/phpuU95rg.jpg', '', 'test', 'test', '0000-00-00', 0, '24816880', 'sdlqskdmlqk mlskdmlqks', 1, '2016-04-04 17:55:36'),
(7, 'ee@ee.com', '123456', 'images/phprDniXR.jpg', 'images/phpDr05c8.jpg', 'Saidi', 'Ahmed', '0000-00-00', 0, '24816880', 'dqsdqsm qsjd lkqsjd lkqjsl kj  kj lksdjl fksld', 1, '2016-04-04 18:54:53'),
(8, 'azerty@gmail.com', 'azerty', 'images/php31F.tmp.jpg', 'images/php34F.tmp.jpg', 'azerty', 'azerty', '2020-06-24', 0, '31512121', 'Redayef', 1, '2020-06-23 18:59:56');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE IF NOT EXISTS `demande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `source` varchar(255) COLLATE utf8_bin NOT NULL,
  `destination` varchar(255) COLLATE utf8_bin NOT NULL,
  `date_livraison` datetime NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_client` (`id_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `demande`
--

INSERT INTO `demande` (`id`, `id_client`, `titre`, `description`, `source`, `destination`, `date_livraison`, `date_creation`) VALUES
(2, 3, 'hhhhhhhhhhhhh', 'qsdsqdsqdqsd', 'Ariana', 'Ariana', '2020-07-01 00:00:00', '2020-06-23 19:10:06'),
(3, 6, 'kkkkkkkkkkkkkkkk', 'qsdqsdqsdqsd', 'Sfax', 'Sidi Bouzid', '2020-06-18 00:00:00', '2020-06-25 23:52:28');

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE IF NOT EXISTS `offre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `id_demande` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `source` varchar(255) COLLATE utf8_bin NOT NULL,
  `destination` varchar(255) COLLATE utf8_bin NOT NULL,
  `date_livraison` datetime NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_client` (`id_client`),
  KEY `id_demande` (`id_demande`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Contenu de la table `offre`
--

INSERT INTO `offre` (`id`, `id_client`, `id_demande`, `titre`, `description`, `source`, `destination`, `date_livraison`, `date_creation`) VALUES
(3, 6, 2, 'iiiiiiiiii', 'qsdsqqqqqqqqqqqqqdqs', 'Gafsa', 'MÃ©denine', '2020-06-27 00:00:00', '2020-06-25 23:54:26'),
(4, 3, 3, 'hhhhhhhhhhhhh', 'szdqsdqsdq', 'Bizerte', 'Bizerte', '2020-06-17 00:00:00', '2020-06-26 01:52:17');

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE IF NOT EXISTS `reclamation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `reclamation`
--

INSERT INTO `reclamation` (`id`, `id_client`, `titre`, `description`, `date_creation`) VALUES
(2, 3, 'qsdqs', 'qsdqsdqs', '2016-04-08 00:00:00'),
(3, 3, 'hhhhhhhhhhhhh', 'bvnbbbbbbbbbbbbbbbbbbbbbbbbb', '2020-06-22 22:18:40'),
(4, 3, 'hhhhhhhhhhhhh', 'sqdqsdqsd', '2020-06-23 19:11:01');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_client_source`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_client_destinataire`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `offre_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offre_ibfk_2` FOREIGN KEY (`id_demande`) REFERENCES `demande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
