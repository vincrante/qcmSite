-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 10 Janvier 2017 à 10:42
-- Version du serveur: 5.5.53-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `siteQcm`
--

-- --------------------------------------------------------

--
-- Structure de la table `assoQcmQuest`
--

CREATE TABLE IF NOT EXISTS `assoQcmQuest` (
  `idQcm` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  PRIMARY KEY (`idQcm`,`idQuestion`),
  KEY `idQuestion` (`idQuestion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `assoQuestReponse`
--

CREATE TABLE IF NOT EXISTS `assoQuestReponse` (
  `idQuestion` int(11) NOT NULL,
  `idReponse` int(11) NOT NULL,
  PRIMARY KEY (`idQuestion`,`idReponse`),
  KEY `idReponse` (`idReponse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE IF NOT EXISTS `compte` (
  `idCompte` int(11) NOT NULL AUTO_INCREMENT,
  `login` text NOT NULL,
  `mdp` text NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `role` text NOT NULL,
  PRIMARY KEY (`idCompte`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`idCompte`, `login`, `mdp`, `nom`, `prenom`, `role`) VALUES
(3, 'vp31', 'd7e0bad294333ec298558d85ec6c58ff', 'Pereira', 'vincent', 'Etudiant'),
(4, 'sayko', 'b69466b536f8ce43b6356ec1332e05a4', 'banquet', 'coco', 'prof');

-- --------------------------------------------------------

--
-- Structure de la table `qcm`
--

CREATE TABLE IF NOT EXISTS `qcm` (
  `idQcm` int(11) NOT NULL AUTO_INCREMENT,
  `idCrea` int(11) NOT NULL,
  `dateFin` date NOT NULL,
  `dateCrea` date NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '0',
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`idQcm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `idQuestion` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `theme` varchar(255) NOT NULL,
  PRIMARY KEY (`idQuestion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `idReponse` int(11) NOT NULL AUTO_INCREMENT,
  `reponse` text NOT NULL,
  `juste` tinyint(1) NOT NULL,
  `feedBack` text NOT NULL,
  PRIMARY KEY (`idReponse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

CREATE TABLE IF NOT EXISTS `resultat` (
  `idCompte` int(11) NOT NULL,
  `idReponse` int(11) NOT NULL,
  PRIMARY KEY (`idCompte`,`idReponse`),
  KEY `idReponse` (`idReponse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `assoQcmQuest`
--
ALTER TABLE `assoQcmQuest`
  ADD CONSTRAINT `assoQcmQuest_ibfk_2` FOREIGN KEY (`idQcm`) REFERENCES `qcm` (`idQcm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assoQcmQuest_ibfk_1` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`idQuestion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `assoQuestReponse`
--
ALTER TABLE `assoQuestReponse`
  ADD CONSTRAINT `assoQuestReponse_ibfk_2` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`idQuestion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assoQuestReponse_ibfk_1` FOREIGN KEY (`idReponse`) REFERENCES `reponse` (`idReponse`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resultat`
--
ALTER TABLE `resultat`
  ADD CONSTRAINT `resultat_ibfk_1` FOREIGN KEY (`idReponse`) REFERENCES `reponse` (`idReponse`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
