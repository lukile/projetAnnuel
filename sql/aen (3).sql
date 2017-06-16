-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 16 Juin 2017 à 19:59
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `aen`
--

-- --------------------------------------------------------

--
-- Structure de la table `coefficient`
--

CREATE TABLE IF NOT EXISTS `coefficient` (
  `acoustic_group` varchar(255) COLLATE utf8_bin NOT NULL,
  `day_period` double DEFAULT NULL,
  `night_period` double DEFAULT NULL,
  PRIMARY KEY (`acoustic_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `coefficient`
--

INSERT INTO `coefficient` (`acoustic_group`, `day_period`, `night_period`) VALUES
('ga1', 1.3, 4),
('ga2', 1.2, 1.8),
('ga3', 1.15, 1.725),
('ga4', 1, 1.5),
('ga5a', 0.85, 1.275),
('ga5b', 0.7, 1.05);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` tinyint(1) NOT NULL DEFAULT '0',
  `userMessage` varchar(100) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `statut`, `userMessage`, `mail`, `content`) VALUES
(1, 1, 'scha', 'sachabellaiche@hotmail.fr', 'content'),
(2, 0, 'zerty', 'sacha0007@msn.Com', 'a&quot;z''e(-Ã¨-_Ã¨Ã§Ã ');

-- --------------------------------------------------------

--
-- Structure de la table `order_form`
--

CREATE TABLE IF NOT EXISTS `order_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` double DEFAULT NULL,
  `validation` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `acoustic_group` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `royalties_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`),
  KEY `fk_royalties_id` (`royalties_id`),
  KEY `acoustic_group` (`acoustic_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=277 ;

--
-- Contenu de la table `order_form`
--

INSERT INTO `order_form` (`id`, `invoice`, `validation`, `user_id`, `acoustic_group`, `royalties_id`) VALUES
(274, NULL, NULL, NULL, 'ga2', NULL),
(275, NULL, NULL, NULL, 'ga2', NULL),
(276, NULL, NULL, NULL, 'ga2', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_form_service`
--

CREATE TABLE IF NOT EXISTS `order_form_service` (
  `booking_start_date` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `booking_end_date` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `booking_start_hour` time DEFAULT NULL,
  `booking_end_hour` time DEFAULT NULL,
  `order_form_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  PRIMARY KEY (`order_form_id`,`service_id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `order_form_service`
--

INSERT INTO `order_form_service` (`booking_start_date`, `booking_end_date`, `booking_start_hour`, `booking_end_hour`, `order_form_id`, `service_id`) VALUES
('16-06-2017', '23-06-2017', '20:00:00', '20:00:00', 274, 3),
('18-06-2017', NULL, '21:00:00', NULL, 274, 5);

-- --------------------------------------------------------

--
-- Structure de la table `royalties`
--

CREATE TABLE IF NOT EXISTS `royalties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `petroleum_type` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fuel_quantity` double DEFAULT NULL,
  `plane_length` double DEFAULT NULL,
  `plane_weight` double DEFAULT NULL,
  `shelter_feature` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `landing_type` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `landing_period` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `time_unit` time DEFAULT NULL,
  `parking_surface` double DEFAULT NULL,
  `parking_week` date DEFAULT NULL,
  `rate` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `rate_type` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `HT_price` double DEFAULT NULL,
  `TVA_price` double DEFAULT NULL,
  `TTC_price` double DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `acoustic_group` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `fk_acoustic_group` (`acoustic_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `royalties`
--

INSERT INTO `royalties` (`id`, `petroleum_type`, `fuel_quantity`, `plane_length`, `plane_weight`, `shelter_feature`, `landing_type`, `landing_period`, `time_unit`, `parking_surface`, `parking_week`, `rate`, `rate_type`, `HT_price`, `TVA_price`, `TTC_price`, `service_id`, `acoustic_group`) VALUES
(2, 'JAT', NULL, 1029929, 199191, NULL, 'monoBiTur', NULL, NULL, NULL, NULL, NULL, 'cat1', NULL, NULL, NULL, 5, 'ga2');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Contenu de la table `services`
--

INSERT INTO `services` (`id`, `type`) VALUES
(3, 'parking'),
(4, 'refueling'),
(5, 'landing'),
(6, 'inside_cleaning'),
(7, 'parachuting'),
(8, 'ulm'),
(9, 'first_flying'),
(10, 'flying_lesson');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` tinyint(1) DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `pseudo` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `pass` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `activation_key` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `application_fee` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `admin`, `firstname`, `lastname`, `pseudo`, `pass`, `mail`, `phone`, `activation_key`, `active`, `comments`, `registration_date`, `application_fee`) VALUES
(1, 0, 'POUET', 'Pouet', 'pouet', 'b9d10f268fdc769283fb585b34c93901', 'pouet@ggg.com', '11111111111111111', '2b897c7a1378d48d923f8bf895e54e59', NULL, 'commentaires', '2017-05-22', NULL),
(2, NULL, 'prÃ©nom', 'nom', 'user', 'ab4f63f9ac65152575886860dde480a1', 'lucile.1988@hotmail.fr', '020201020120', NULL, NULL, '', '2017-05-22', NULL),
(3, NULL, 'prÃ©nom', 'nom', 'user', 'ab4f63f9ac65152575886860dde480a1', 'mail@gmail.com', '020201020120', '1dd6a1dd2239dfee91a7013b3569270f', NULL, '', '2017-06-10', NULL),
(4, 0, 'prÃ©nom', 'nom', 'user', 'ab4f63f9ac65152575886860dde480a1', 'piou@gmail.com', '020201020120', '6c08a65f5f934b96292afeeadfbcd0fd', NULL, '', '2017-06-10', NULL),
(6, 1, 'Lucile', 'nom', 'Admin', 'ab4f63f9ac65152575886860dde480a1', 'admin@aen.com', '020201020120', '9803d3198424f006723e4027a80e68cb', NULL, '', '2017-06-10', NULL),
(7, 0, 'lukile', 'ofjof', 'lukiles', '6901639aa79c571d66b2763e60bea510', 'lukile@gmail.com', '099293929', '921b2155bea8a6b600c3587eac3e5ecf', NULL, '', '2017-06-11', 0),
(8, 0, 'fofkoko', 'okooko', 'okokok', '6901639aa79c571d66b2763e60bea510', 'ojeofje@ggll.com', '03039393939', '5a8b537f436b7ceb0a3fec309146ccd4', 1, '', '2017-06-11', 132.33),
(9, 0, 'd', 'd', 'd', '6901639aa79c571d66b2763e60bea510', 'lucile.1988.ls@gmail.com', '020201020120', '6c2581a3e1bde24658d6ce76ab7a9ed8', 0, '', '2017-06-11', 0),
(10, 0, 'prÃ©nom', 'nom', 'user', '8ce4b16b22b58894aa86c421e8759df3', 'ldldld@gc.com', '0111111111111', '79aa9567e7d44658b5921251aa1a7776', 0, '', '2017-06-11', 0),
(11, 1, 'Sacha', 'Bellaiche', 'sachaB96', '85a5211f62feaeb0bbfd9918ab4a4d37', 'sacha0007@msn.com', '0646121573', '6bba92fa19ac9b1a4ef041c9ac7bedbf', 1, '', '2017-06-15', 0),
(12, 0, 'Sacha', 'Bellaiche', 'sachasacha', '85a5211f62feaeb0bbfd9918ab4a4d37', 'sacha.bellaiche96@gmail.com', '0646121573', '0d9a8e202199871235ccc563ea99d1a6', 1, '', '2017-06-16', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_historic`
--

CREATE TABLE IF NOT EXISTS `user_historic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `archiving_date` date DEFAULT NULL,
  `pseudo` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `pass` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `application_fee` double DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usr_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `order_form`
--
ALTER TABLE `order_form`
  ADD CONSTRAINT `fk_acousticGroup` FOREIGN KEY (`acoustic_group`) REFERENCES `coefficient` (`acoustic_group`),
  ADD CONSTRAINT `fk_royalties_id` FOREIGN KEY (`royalties_id`) REFERENCES `order_form` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `order_form_service`
--
ALTER TABLE `order_form_service`
  ADD CONSTRAINT `order_form_service_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Contraintes pour la table `royalties`
--
ALTER TABLE `royalties`
  ADD CONSTRAINT `fk_acoustic_group` FOREIGN KEY (`acoustic_group`) REFERENCES `coefficient` (`acoustic_group`),
  ADD CONSTRAINT `royalties_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Contraintes pour la table `user_historic`
--
ALTER TABLE `user_historic`
  ADD CONSTRAINT `fk_usr_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
