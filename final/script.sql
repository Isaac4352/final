-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 20, 2023 at 02:39 AM
-- Server version: 10.10.2-MariaDB
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `id_auteur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `date_naissance` datetime NOT NULL,
  `nb_livres_cree` int(11) NOT NULL,
  `travail_courant_bd` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `auteur`
--

INSERT INTO `auteur` (`id_auteur`, `nom`, `prenom`, `date_naissance`, `nb_livres_cree`, `travail_courant_bd`) VALUES
(1, 'Gaiman', 'Neil', '1974-05-15 22:20:40', 14, 1),
(2, 'Moore', 'Alan', '2023-05-20 02:21:54', 12, 0),
(3, 'Millar', 'Mark', '2023-05-20 02:22:38', 17, 0),
(4, 'Morrison', 'Grant', '2023-05-20 02:23:00', 7, 1),
(5, 'Miller', 'Frank', '2023-05-20 02:23:21', 20, 0),
(6, 'Lee', 'Stan', '2023-05-20 02:23:38', 45, 0),
(7, 'Simone', 'Gail', '2023-05-20 02:23:55', 12, 1),
(8, 'Brubaker', 'Ed', '2023-05-20 02:24:27', 18, 1),
(9, 'Snyder', 'Scott', '2023-05-20 02:24:44', 11, 1),
(10, 'Eisner', 'Will', '2023-05-20 02:25:09', 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bds`
--

DROP TABLE IF EXISTS `bds`;
CREATE TABLE IF NOT EXISTS `bds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `auteur_nom` varchar(100) NOT NULL,
  `date_publie` datetime NOT NULL,
  `nom_edition` varchar(100) NOT NULL,
  `encore_en_impression` tinyint(1) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id_auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bds`
--

INSERT INTO `bds` (`id`, `nom`, `auteur_nom`, `date_publie`, `nom_edition`, `encore_en_impression`, `id_auteur`) VALUES
(1, 'sandman', 'neil gaiman', '2023-05-20 02:33:44', 'dc', 1, 1),
(2, 'test2', 'Grant Morrison', '2023-05-20 02:34:17', 'image', 1, 4),
(3, '100 bullets', 'Frank Miller', '2023-05-20 02:34:51', 'image', 1, 5),
(4, 'hellboy', 'Ed Brubaker', '2023-05-20 02:35:27', 'dark horse', 1, 8),
(5, 'dr cataclysm', 'millar', '2023-05-20 02:36:55', 'image', 0, 3),
(6, 'american gods', 'neil gaiman', '2023-05-20 02:37:30', 'dc', 0, 1),
(7, 'sparks', 'Lee', '2023-05-20 02:37:54', 'image', 1, 6),
(8, 'test4', 'test123', '2023-05-20 02:38:37', 'test567', 0, 3),
(9, 'testert', 'testert', '2023-05-20 02:39:05', 'test123', 0, 9),
(10, 'snyder collection', 'snyder', '2023-05-20 02:39:22', 'image', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `type`) VALUES
(1, 'test123', 'shawi', 1),
(2, 'test345', 'shawi', 1),
(3, 'shawi', 'shawi', 1),
(4, 'user', 'shawi', 1),
(5, 'shawi123', 'shawi', 1),
(6, 'isaac', 'shawi', 0),
(7, 'username', 'shawi', 0),
(8, 'shawi345', 'shawi', 0),
(9, 'shawi456', 'shawi', 0),
(10, 'final', 'shawi', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bds`
--
ALTER TABLE `bds`
  ADD CONSTRAINT `id` FOREIGN KEY (`id_auteur`) REFERENCES `auteur` (`id_auteur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
