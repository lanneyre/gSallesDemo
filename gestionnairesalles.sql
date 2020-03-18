-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 04 mars 2020 à 12:41
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestionnairesalles`
--

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE IF NOT EXISTS `formation` (
  `Formation_id` int(11) NOT NULL AUTO_INCREMENT,
  `Formation_nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Formation_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Formation_nomCourt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`Formation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`Formation_id`, `Formation_nom`, `Formation_description`, `Formation_nomCourt`) VALUES
(1, 'Dev Web et Web Mobile', 'Dev Web et Web Mobile', 'DWWM2'),
(2, 'JAVA', 'JAVA', 'JAVA1'),
(3, 'Technicien Assistance Informatique', 'Technicien Assistance Informatique', 'TAI1'),
(4, 'Technicien Assistance Informatique', 'Technicien Assistance Informatique', 'TAI2'),
(5, 'Concepteur Développeur d\'Application', 'Concepteur Développeur d\'Application', 'CDA1');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `Reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `Salle_id` int(11) NOT NULL,
  `Formation_id` int(11) NOT NULL,
  `Reservation_date` date NOT NULL,
  `Reservation_heure` time NOT NULL,
  `User_id` int(11) NOT NULL,
  `Reservation_motif` text COLLATE utf8mb4_unicode_ci,
  `Reservation_creation` datetime NOT NULL,
  `Reservation_update` datetime DEFAULT NULL,
  PRIMARY KEY (`Reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`Reservation_id`, `Salle_id`, `Formation_id`, `Reservation_date`, `Reservation_heure`, `User_id`, `Reservation_motif`, `Reservation_creation`, `Reservation_update`) VALUES
(1, 1, 1, '2020-03-03', '08:00:00', 1, NULL, '2020-03-03 12:57:25', NULL),
(2, 1, 1, '2020-03-03', '08:30:00', 1, NULL, '2020-03-03 12:57:28', NULL),
(3, 1, 1, '2020-03-03', '09:00:00', 1, NULL, '2020-03-03 12:57:29', NULL),
(5, 2, 1, '2020-03-03', '08:00:00', 1, NULL, '2020-03-03 12:58:00', NULL),
(7, 4, 1, '2020-03-03', '07:30:00', 1, NULL, '2020-03-03 12:57:32', NULL),
(8, 4, 1, '2020-03-03', '08:00:00', 1, NULL, '2020-03-03 12:57:33', NULL),
(9, 4, 1, '2020-03-03', '08:30:00', 1, NULL, '2020-03-03 12:57:34', NULL),
(39, 2, 1, '2020-03-03', '08:30:00', 1, NULL, '2020-03-04 09:45:42', NULL),
(55, 5, 5, '2020-03-03', '08:30:00', 1, NULL, '2020-03-04 11:15:54', NULL),
(56, 5, 5, '2020-03-03', '08:00:00', 1, NULL, '2020-03-04 11:15:55', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
  `Salle_id` int(11) NOT NULL AUTO_INCREMENT,
  `Salle_nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Salle_capacite` int(11) NOT NULL,
  `Salle_couleur` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Salle_emplacement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Numerique',
  PRIMARY KEY (`Salle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`Salle_id`, `Salle_nom`, `Salle_capacite`, `Salle_couleur`, `Salle_emplacement`) VALUES
(1, 'Open Space', 50, '#266a0b', 'Numerique'),
(2, 'Theo', 20, '#1d2d86', 'Numerique'),
(3, 'Plato', 15, '#f0e501', 'Numerique'),
(4, 'Buro', 10, '#bc0b05', 'Numerique');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `User_prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `User_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `User_mdp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `User_statut` tinyint(4) NOT NULL,
  PRIMARY KEY (`User_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`User_id`, `User_nom`, `User_prenom`, `User_email`, `User_mdp`, `User_statut`) VALUES
(1, 'LANNEY', 'Rémi', 'remi.lanney@cote-azur.cci.fr', '$2y$10$nBDZZ9cawvtq2zMKPPsXcOoQp22vqN4rmQiSWaCijnQO0npcEVF3K', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
