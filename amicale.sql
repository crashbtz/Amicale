-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 30 Septembre 2013 à 08:08
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `amicale`
--
CREATE DATABASE IF NOT EXISTS `amicale` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `amicale`;

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `rue` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `complements` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `amicale_user`
--

CREATE TABLE IF NOT EXISTS `amicale_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_584E6FE92FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_584E6FEA0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `amicale_user`
--

INSERT INTO `amicale_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(4, '028038', '028038', 'cmoncade@ch-perrens.fr', 'cmoncade@ch-perrens.fr', 1, 'bws22ofatzwws400gkcww4gkc0c0wok', '', '2013-09-17 16:27:56', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `titre`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Alimentation', 'Viandes, Légumes, Fruits, Boissons', '2013-07-22 10:53:40', '2013-08-04 19:27:56'),
(2, 'Produits de beauté', 'Parfums, Maquillage', '2013-07-25 17:38:34', '2013-08-04 19:28:47'),
(3, 'Divertissement', 'Cinéma, Spectacles, Théâtre', '2013-08-04 19:29:33', '2013-08-04 19:29:33');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `close` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `valide` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6EEAA67DA76ED395` (`user_id`),
  KEY `IDX_6EEAA67DF347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commercant`
--

CREATE TABLE IF NOT EXISTS `commercant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) DEFAULT NULL,
  `adresse_id` int(11) DEFAULT NULL,
  `libelle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail` longtext COLLATE utf8_unicode_ci,
  `tel` int(11) DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_ECB4268F7E9E4C8C` (`photo_id`),
  UNIQUE KEY `UNIQ_ECB4268F4DE7DC5C` (`adresse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `commercant`
--

INSERT INTO `commercant` (`id`, `photo_id`, `adresse_id`, `libelle`, `nom`, `prenom`, `detail`, `tel`, `email`, `created_at`, `updated_at`) VALUES
(3, NULL, NULL, 'commercant1', NULL, NULL, NULL, NULL, NULL, '2013-07-26 14:29:48', '2013-07-26 14:29:48'),
(4, NULL, NULL, 'commercant2', NULL, NULL, NULL, NULL, NULL, '2013-07-26 14:30:01', '2013-07-26 14:30:01'),
(5, NULL, NULL, 'commercant3', NULL, NULL, NULL, NULL, NULL, '2013-07-26 14:30:14', '2013-07-26 14:30:14');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `detail` longtext COLLATE utf8_unicode_ci,
  `date` datetime NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`id`, `titre`, `detail`, `date`, `createdAt`, `updatedAt`) VALUES
(7, 'Vide de grenier', 'marché', '2013-08-15 17:28:55', '2013-08-04 16:27:34', '2013-08-15 17:28:55');

-- --------------------------------------------------------

--
-- Structure de la table `evenement_commercant`
--

CREATE TABLE IF NOT EXISTS `evenement_commercant` (
  `evenement_id` int(11) NOT NULL,
  `commercant_id` int(11) NOT NULL,
  PRIMARY KEY (`evenement_id`,`commercant_id`),
  KEY `IDX_1DCE9AC1FD02F13` (`evenement_id`),
  KEY `IDX_1DCE9AC183FA6DD0` (`commercant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `evenement_commercant`
--

INSERT INTO `evenement_commercant` (`evenement_id`, `commercant_id`) VALUES
(7, 4),
(7, 5);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `photo`
--

INSERT INTO `photo` (`id`, `url`, `alt`) VALUES
(5, 'jpeg', 'Steak.jpg'),
(6, 'jpeg', 'Steak.jpg'),
(7, 'jpeg', 'channel5.jpeg'),
(8, 'jpeg', 'cinema.jpeg'),
(9, 'jpeg', 'salade.jpeg'),
(10, 'jpeg', 'bijou.jpeg'),
(11, 'jpeg', 'carottes.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marque` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci,
  `prix` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `typeProduit_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_29A5EC277E9E4C8C` (`photo_id`),
  KEY `IDX_29A5EC27B9339D26` (`typeProduit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id`, `photo_id`, `titre`, `marque`, `contenu`, `prix`, `createdAt`, `updatedAt`, `typeProduit_id`) VALUES
(20, 6, 'Steak', NULL, NULL, 50, '2013-08-13 17:44:54', '2013-08-13 17:44:54', 6),
(21, 7, 'Channel 5', 'Channel', NULL, 70, '2013-08-13 17:47:44', '2013-08-13 17:47:44', 7),
(22, 8, 'Ticket cinéma', NULL, NULL, 5, '2013-08-13 17:49:25', '2013-08-13 17:49:25', 8),
(23, 9, 'Salade', NULL, NULL, 5, '2013-08-13 17:50:48', '2013-08-13 17:50:48', 9),
(24, 10, 'Gateaux Bijou', NULL, NULL, 15, '2013-08-13 17:54:37', '2013-08-13 17:54:37', 10),
(25, 11, 'Carottes', NULL, NULL, 50, '2013-08-15 15:56:13', '2013-08-15 15:56:13', 9);

-- --------------------------------------------------------

--
-- Structure de la table `typeproduit`
--

CREATE TABLE IF NOT EXISTS `typeproduit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F341609CBCF5E72D` (`categorie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Contenu de la table `typeproduit`
--

INSERT INTO `typeproduit` (`id`, `nom`, `createdAt`, `updatedAt`, `categorie_id`) VALUES
(6, 'Viande', '2013-08-13 17:29:29', '2013-08-13 17:29:29', 1),
(7, 'Parfum', '2013-08-13 17:29:46', '2013-08-13 17:29:46', 2),
(8, 'Cinéma', '2013-08-13 17:30:10', '2013-08-13 17:30:10', 3),
(9, 'Fruits et Légumes', '2013-08-13 17:30:51', '2013-08-13 17:30:51', 1),
(10, 'Gateaux', '2013-08-13 17:34:59', '2013-08-13 17:34:59', 1),
(11, 'Spectacle', '2013-08-13 17:35:13', '2013-08-13 17:35:13', 3),
(12, 'Maquillage', '2013-08-13 17:35:24', '2013-08-13 17:35:24', 2),
(13, 'Bijoux', '2013-08-13 17:35:42', '2013-08-13 17:35:42', 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `amicale_user` (`id`),
  ADD CONSTRAINT `FK_6EEAA67DF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `commercant`
--
ALTER TABLE `commercant`
  ADD CONSTRAINT `FK_ECB4268F4DE7DC5C` FOREIGN KEY (`adresse_id`) REFERENCES `adresse` (`id`),
  ADD CONSTRAINT `FK_ECB4268F7E9E4C8C` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`);

--
-- Contraintes pour la table `evenement_commercant`
--
ALTER TABLE `evenement_commercant`
  ADD CONSTRAINT `FK_1DCE9AC183FA6DD0` FOREIGN KEY (`commercant_id`) REFERENCES `commercant` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1DCE9AC1FD02F13` FOREIGN KEY (`evenement_id`) REFERENCES `evenement` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC277E9E4C8C` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`),
  ADD CONSTRAINT `FK_29A5EC27B9339D26` FOREIGN KEY (`typeProduit_id`) REFERENCES `typeproduit` (`id`);

--
-- Contraintes pour la table `typeproduit`
--
ALTER TABLE `typeproduit`
  ADD CONSTRAINT `FK_F341609CBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
