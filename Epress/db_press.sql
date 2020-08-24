-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 01 fév. 2020 à 14:34
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_press`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Prenom` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `NomPrenom` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `Adresse` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `Telephone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `Nom`, `Prenom`, `NomPrenom`, `Adresse`, `Telephone`) VALUES
(1, 'emmanuel', 'tsakpo', 'emmanuel tsakpo', 'lome', '90909090');

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

DROP TABLE IF EXISTS `couleur`;
CREATE TABLE IF NOT EXISTS `couleur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Libelle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `couleur`
--

INSERT INTO `couleur` (`id`, `Libelle`) VALUES
(1, 'blanc');

-- --------------------------------------------------------

--
-- Structure de la table `depot`
--

DROP TABLE IF EXISTS `depot`;
CREATE TABLE IF NOT EXISTS `depot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `linge_id` int(11) NOT NULL,
  `couleur_id` int(11) NOT NULL,
  `tissu_id` int(11) NOT NULL,
  `DateDepot` date NOT NULL,
  `Prix` decimal(10,2) NOT NULL,
  `avance` decimal(10,2) NOT NULL,
  `remise` decimal(10,2) NOT NULL,
  `Quantite` int(11) NOT NULL,
  `Statut` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_47948BBC19EB6921` (`client_id`),
  KEY `IDX_47948BBC705CBDCF` (`linge_id`),
  KEY `IDX_47948BBCC31BA576` (`couleur_id`),
  KEY `IDX_47948BBCA533E0C9` (`tissu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `depot`
--

INSERT INTO `depot` (`id`, `client_id`, `linge_id`, `couleur_id`, `tissu_id`, `DateDepot`, `Prix`, `avance`, `remise`, `Quantite`, `Statut`) VALUES
(1, 1, 1, 1, 1, '2020-02-01', '1000.00', '1000.00', '0.00', 2, 'Solde');

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'pressing', 'pressing', 'emmanueltsakpo5@gmail.com', 'emmanueltsakpo5@gmail.com', 1, NULL, '$2y$13$9SRgR7JVh/u6bAIhyW5R3u2Dkiqnt4fU0dQD9qDljSVG2IDcX5q0m', '2020-02-01 14:28:58', 'F5f9UsMk1sswoboQJgVSQ6n1N7rsdvUFQwVoJPyYvao', '2019-05-10 09:16:04', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}');

-- --------------------------------------------------------

--
-- Structure de la table `kilo`
--

DROP TABLE IF EXISTS `kilo`;
CREATE TABLE IF NOT EXISTS `kilo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poid_id` int(11) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9E2007D331C0DB90` (`poid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `linge`
--

DROP TABLE IF EXISTS `linge`;
CREATE TABLE IF NOT EXISTS `linge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Libelle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `linge`
--

INSERT INTO `linge` (`id`, `Libelle`) VALUES
(1, 'manche longue');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `depot_id` int(11) NOT NULL,
  `Montant` decimal(10,2) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B1DC7A1E19EB6921` (`client_id`),
  KEY `IDX_B1DC7A1E8510D4DE` (`depot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id`, `client_id`, `depot_id`, `Montant`, `Date`) VALUES
(1, 1, 1, '1000.00', '2020-02-01');

-- --------------------------------------------------------

--
-- Structure de la table `pan`
--

DROP TABLE IF EXISTS `pan`;
CREATE TABLE IF NOT EXISTS `pan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `soin_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `etat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7D5CA7FB6F952169` (`soin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Quantite` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_24CC0DF2F347EFB` (`produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `produit_id`, `Date`, `Quantite`, `etat`) VALUES
(1, 1, '2018-04-20', 1, 1),
(2, 1, '2018-05-08', 1, 1),
(3, 1, '2018-06-22', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `poids`
--

DROP TABLE IF EXISTS `poids`;
CREATE TABLE IF NOT EXISTS `poids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `Prix` decimal(10,2) NOT NULL,
  `espace` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `Prix`) VALUES
(1, 'Casque', '15000.00');

-- --------------------------------------------------------

--
-- Structure de la table `soin`
--

DROP TABLE IF EXISTS `soin`;
CREATE TABLE IF NOT EXISTS `soin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statistique`
--

DROP TABLE IF EXISTS `statistique`;
CREATE TABLE IF NOT EXISTS `statistique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `Montant` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `statistique`
--

INSERT INTO `statistique` (`id`, `date`, `Montant`) VALUES
(1, '2020-02-01', '1000.00');

-- --------------------------------------------------------

--
-- Structure de la table `statistique2`
--

DROP TABLE IF EXISTS `statistique2`;
CREATE TABLE IF NOT EXISTS `statistique2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Montant` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statistique3`
--

DROP TABLE IF EXISTS `statistique3`;
CREATE TABLE IF NOT EXISTS `statistique3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `statistique3`
--

INSERT INTO `statistique3` (`id`, `date`, `montant`) VALUES
(1, '2018-04-20', '15000.00'),
(2, '2018-05-08', '15000.00'),
(3, '2018-06-22', '15000.00');

-- --------------------------------------------------------

--
-- Structure de la table `statistique4`
--

DROP TABLE IF EXISTS `statistique4`;
CREATE TABLE IF NOT EXISTS `statistique4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Montant` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_tissu`
--

DROP TABLE IF EXISTS `type_tissu`;
CREATE TABLE IF NOT EXISTS `type_tissu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Libelle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `type_tissu`
--

INSERT INTO `type_tissu` (`id`, `Libelle`) VALUES
(1, 'coton');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `depot`
--
ALTER TABLE `depot`
  ADD CONSTRAINT `FK_47948BBC19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_47948BBC705CBDCF` FOREIGN KEY (`linge_id`) REFERENCES `linge` (`id`),
  ADD CONSTRAINT `FK_47948BBCA533E0C9` FOREIGN KEY (`tissu_id`) REFERENCES `type_tissu` (`id`),
  ADD CONSTRAINT `FK_47948BBCC31BA576` FOREIGN KEY (`couleur_id`) REFERENCES `couleur` (`id`);

--
-- Contraintes pour la table `kilo`
--
ALTER TABLE `kilo`
  ADD CONSTRAINT `FK_9E2007D331C0DB90` FOREIGN KEY (`poid_id`) REFERENCES `poids` (`id`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `FK_B1DC7A1E19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_B1DC7A1E8510D4DE` FOREIGN KEY (`depot_id`) REFERENCES `depot` (`id`);

--
-- Contraintes pour la table `pan`
--
ALTER TABLE `pan`
  ADD CONSTRAINT `FK_7D5CA7FB6F952169` FOREIGN KEY (`soin_id`) REFERENCES `soin` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `FK_24CC0DF2F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
