-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 30 Juin 2017 à 16:23
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `aen`
--

-- --------------------------------------------------------

--
-- Structure de la table `meteo`
--

CREATE TABLE `meteo` (
  `iDMeteo` int(5) NOT NULL,
  `weather` varchar(200) COLLATE utf8_bin NOT NULL,
  `tempnow` varchar(200) COLLATE utf8_bin NOT NULL,
  `pressure` varchar(200) COLLATE utf8_bin NOT NULL,
  `humidity` varchar(200) COLLATE utf8_bin NOT NULL,
  `tempsmin` varchar(200) COLLATE utf8_bin NOT NULL,
  `tempsmax` varchar(200) COLLATE utf8_bin NOT NULL,
  `visibility` varchar(200) COLLATE utf8_bin NOT NULL,
  `windspeed` varchar(150) COLLATE utf8_bin NOT NULL,
  `winddegree` varchar(200) COLLATE utf8_bin NOT NULL,
  `sunrise` varchar(200) COLLATE utf8_bin NOT NULL,
  `sunset` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `meteo`
--

INSERT INTO `meteo` (`iDMeteo`, `weather`, `tempnow`, `pressure`, `humidity`, `tempsmin`, `tempsmax`, `visibility`, `windspeed`, `winddegree`, `sunrise`, `sunset`) VALUES
(1, '500', '289.09', '1003', '67', '288.15', '290.15', '10000', '2.6', '170', '1498794895', '1498852992');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `meteo`
--
ALTER TABLE `meteo`
  ADD PRIMARY KEY (`iDMeteo`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `meteo`
--
ALTER TABLE `meteo`
  MODIFY `iDMeteo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
