-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 07 juil. 2022 à 13:28
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion-patient`
--

-- --------------------------------------------------------

--
-- Structure de la table `allergie`
--

DROP TABLE IF EXISTS `allergie`;
CREATE TABLE IF NOT EXISTS `allergie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numdossier` int(11) NOT NULL,
  `nummed` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `numdossier` (`numdossier`),
  KEY `nummed` (`nummed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `diagnostiquer`
--

DROP TABLE IF EXISTS `diagnostiquer`;
CREATE TABLE IF NOT EXISTS `diagnostiquer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nummal` int(11) NOT NULL,
  `numtrait` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nummal` (`nummal`),
  KEY `numtrait` (`numtrait`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dose`
--

DROP TABLE IF EXISTS `dose`;
CREATE TABLE IF NOT EXISTS `dose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nummed` int(11) NOT NULL,
  `numord` int(11) NOT NULL,
  `posologie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nummed` (`nummed`),
  KEY `numord` (`numord`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `maladie`
--

DROP TABLE IF EXISTS `maladie`;
CREATE TABLE IF NOT EXISTS `maladie` (
  `nummal` int(11) NOT NULL AUTO_INCREMENT,
  `nommal` varchar(255) NOT NULL,
  PRIMARY KEY (`nummal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `matmed` int(11) NOT NULL AUTO_INCREMENT,
  `nommedecin` varchar(255) NOT NULL,
  PRIMARY KEY (`matmed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `medecin_traitant`
--

DROP TABLE IF EXISTS `medecin_traitant`;
CREATE TABLE IF NOT EXISTS `medecin_traitant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numtrait` int(11) NOT NULL,
  `matmed` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `numtrait` (`numtrait`),
  KEY `matmed` (`matmed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

DROP TABLE IF EXISTS `medicament`;
CREATE TABLE IF NOT EXISTS `medicament` (
  `nummed` int(11) NOT NULL AUTO_INCREMENT,
  `nommed` varchar(255) NOT NULL,
  PRIMARY KEY (`nummed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ordonnance`
--

DROP TABLE IF EXISTS `ordonnance`;
CREATE TABLE IF NOT EXISTS `ordonnance` (
  `numord` int(11) NOT NULL AUTO_INCREMENT,
  `datord` date NOT NULL,
  `matmed` int(11) NOT NULL,
  `numtrait` int(11) NOT NULL,
  `numrdv` int(11) NOT NULL,
  `numdossier` int(11) NOT NULL,
  PRIMARY KEY (`numord`),
  KEY `matmed` (`matmed`),
  KEY `numtrait` (`numtrait`),
  KEY `numrdv` (`numrdv`),
  KEY `numdossier` (`numdossier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `numdossier` int(11) NOT NULL AUTO_INCREMENT,
  `nompatient` varchar(255) NOT NULL,
  `sexepatient` varchar(255) NOT NULL,
  PRIMARY KEY (`numdossier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `programmer`
--

DROP TABLE IF EXISTS `programmer`;
CREATE TABLE IF NOT EXISTS `programmer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codsoin` int(11) NOT NULL,
  `numrdv` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codsoin` (`codsoin`),
  KEY `numrdv` (`numrdv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `numrdv` int(11) NOT NULL AUTO_INCREMENT,
  `datrdv` datetime NOT NULL,
  `numtrait` int(11) NOT NULL,
  PRIMARY KEY (`numrdv`),
  KEY `numtrait` (`numtrait`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `soin`
--

DROP TABLE IF EXISTS `soin`;
CREATE TABLE IF NOT EXISTS `soin` (
  `codsoin` int(11) NOT NULL AUTO_INCREMENT,
  `libsoin` varchar(255) NOT NULL,
  `coutsoin` int(11) NOT NULL,
  PRIMARY KEY (`codsoin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `traitement`
--

DROP TABLE IF EXISTS `traitement`;
CREATE TABLE IF NOT EXISTS `traitement` (
  `numtrait` int(11) NOT NULL AUTO_INCREMENT,
  `dattrait` date NOT NULL,
  `numdossier` int(11) NOT NULL,
  PRIMARY KEY (`numtrait`),
  KEY `numdossier` (`numdossier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` char(1) NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `nom_utilisateur` varchar(255) NOT NULL,
  `est_actif` tinyint(1) NOT NULL DEFAULT '0',
  `mot_de_passe` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `est_supprime` tinyint(1) NOT NULL DEFAULT '0',
  `creer_le` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `maj_le` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `allergie`
--
ALTER TABLE `allergie`
  ADD CONSTRAINT `allergie_medicament_nummed` FOREIGN KEY (`nummed`) REFERENCES `medicament` (`nummed`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allergie_patient_numdossier` FOREIGN KEY (`numdossier`) REFERENCES `patient` (`numdossier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `diagnostiquer`
--
ALTER TABLE `diagnostiquer`
  ADD CONSTRAINT `diagnostiquer_maladie_nummal` FOREIGN KEY (`nummal`) REFERENCES `maladie` (`nummal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diagnostiquer_traitement_numtrait` FOREIGN KEY (`numtrait`) REFERENCES `traitement` (`numtrait`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `dose`
--
ALTER TABLE `dose`
  ADD CONSTRAINT `dose_medicament_nummed` FOREIGN KEY (`nummed`) REFERENCES `medicament` (`nummed`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dose_ordonnance_numord` FOREIGN KEY (`numord`) REFERENCES `ordonnance` (`numord`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `medecin_traitant`
--
ALTER TABLE `medecin_traitant`
  ADD CONSTRAINT `medecin_traitant_medecin_matmed` FOREIGN KEY (`matmed`) REFERENCES `medecin` (`matmed`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medecin_traitant_traitement_numtrait` FOREIGN KEY (`numtrait`) REFERENCES `traitement` (`numtrait`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ordonnance`
--
ALTER TABLE `ordonnance`
  ADD CONSTRAINT `ordonnance_medecin_matmed` FOREIGN KEY (`matmed`) REFERENCES `medecin` (`matmed`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordonnance_patient_numdossier` FOREIGN KEY (`numdossier`) REFERENCES `patient` (`numdossier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordonnance_rdv_numrdv` FOREIGN KEY (`numrdv`) REFERENCES `rdv` (`numrdv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordonnance_traitement_numtrait` FOREIGN KEY (`numtrait`) REFERENCES `traitement` (`numtrait`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `programmer`
--
ALTER TABLE `programmer`
  ADD CONSTRAINT `programmer_rdv_numrdv` FOREIGN KEY (`numrdv`) REFERENCES `rdv` (`numrdv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `programmer_soin_codsoin` FOREIGN KEY (`codsoin`) REFERENCES `soin` (`codsoin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `rdv_traitement_numtrait` FOREIGN KEY (`numtrait`) REFERENCES `traitement` (`numtrait`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `traitement`
--
ALTER TABLE `traitement`
  ADD CONSTRAINT `traitement_patient_numdossier` FOREIGN KEY (`numdossier`) REFERENCES `patient` (`numdossier`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
