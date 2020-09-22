-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 22 sep. 2020 à 04:01
-- Version du serveur :  10.1.40-MariaDB
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `magasinscolaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `code` varchar(10) NOT NULL,
  `noserie` varchar(10) NOT NULL,
  `datelocation` date NOT NULL,
  `dateretour` date DEFAULT NULL,
  `prixlocation` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`code`, `noserie`, `datelocation`, `dateretour`, `prixlocation`) VALUES
('1', 'no1', '2019-09-24', '2019-10-05', '6.00'),
('1', 'no1', '2019-10-02', '2019-10-05', '12.00'),
('1', 'no3', '2019-09-19', '2019-10-01', '54.00'),
('1', 'no3', '2019-09-26', '2019-10-01', '6.00'),
('2', 'no1', '2019-10-05', '2019-09-27', '89.00'),
('2', 'no4', '2020-09-02', '0000-00-00', '9.00'),
('3', 'no4', '2019-09-26', '2019-10-03', '6.00'),
('4', 'no5', '2019-09-25', '0000-00-00', '4.00');

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE `materiel` (
  `noserie` varchar(10) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `disponibilite` tinyint(1) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`noserie`, `nom`, `description`, `prix`, `disponibilite`, `photo`) VALUES
('no1', 'materiel1', 'mat1', '6.00', 0, 'materiel1.JPG'),
('no2', 'materiel2', 'mat2', '8.00', 0, 'materiel2.JPG'),
('no3', 'materiel3', 'mat3', '239.00', 0, 'materiel3.JPG'),
('no4', 'materiel4', 'mat4', '78.00', 1, 'materiel4.JPG'),
('no5', 'materiel5', 'mat5', '56.00', 1, 'materiel5.JPG'),
('no6', 'materiel6', 'mat6', '6.00', 0, 'materiel6.JPG'),
('no7', 'materiel7', 'mat7', '78.00', 0, 'materiel7.JPG');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `code` varchar(10) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `statut` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`code`, `nom`, `prenom`, `statut`, `password`) VALUES
('1', 'Jadon', 'Sancho', 'membre', 'mdp01'),
('2', 'Kilian', 'Mbappe', 'membre', 'mdp02'),
('3', 'Paul', 'Georges', 'admin', 'mdp03'),
('4', 'Mohamed', 'Ali', 'admin', 'mdp04'),
('5', 'Burna', 'Boy', 'membre', 'mdp05');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`code`,`noserie`,`datelocation`),
  ADD KEY `location_ibfk_1` (`code`),
  ADD KEY `location_ibfk_2` (`noserie`);

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`noserie`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`code`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`code`) REFERENCES `membre` (`code`) ON DELETE CASCADE,
  ADD CONSTRAINT `location_ibfk_2` FOREIGN KEY (`noserie`) REFERENCES `materiel` (`noserie`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
