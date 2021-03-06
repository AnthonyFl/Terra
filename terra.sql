-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 18 juin 2018 à 10:40
-- Version du serveur :  10.1.26-MariaDB
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
-- Base de données :  `terra`
--

-- --------------------------------------------------------

--
-- Structure de la table `poi`
--

CREATE TABLE `poi` (
  `id_POI` int(3) NOT NULL,
  `POI` varchar(25) NOT NULL,
  `Lieu` varchar(25) NOT NULL,
  `Description` text NOT NULL,
  `categorie` varchar(25) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `adresse` text NOT NULL,
  `Ville` varchar(20) NOT NULL,
  `Région` varchar(20) NOT NULL,
  `Pays` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `poi`
--
ALTER TABLE `poi`
  ADD PRIMARY KEY (`id_POI`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `poi`
--
ALTER TABLE `poi`
  MODIFY `id_POI` int(3) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
