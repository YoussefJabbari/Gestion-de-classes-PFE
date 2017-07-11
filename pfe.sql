-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 16 Juin 2016 à 17:59
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `pfe`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE IF NOT EXISTS `absence` (
  `CNE` int(11) NOT NULL,
  `ID_CLASSE` int(11) NOT NULL,
  `DATE_SEANCE` date DEFAULT NULL,
  KEY `FK_ABSENCE` (`CNE`),
  KEY `FK_ABSENCE2` (`ID_CLASSE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `absence`
--

INSERT INTO `absence` (`CNE`, `ID_CLASSE`, `DATE_SEANCE`) VALUES
(66789, 55, '2016-06-02'),
(66789, 55, '2016-06-12'),
(6666666, 55, '2016-06-12'),
(66789, 55, '2016-06-15'),
(66789, 55, '2016-06-10'),
(6666666, 55, '2016-06-10'),
(66789, 55, '2016-06-09'),
(6666666, 55, '2016-06-09'),
(7878, 55, '2016-06-10'),
(3456789, 65, '2015-10-30'),
(3456789, 65, '2015-11-21'),
(66789, 65, '2016-06-08');

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE IF NOT EXISTS `annonce` (
  `ID_ANNONCE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ENSEIGNANT` int(11) NOT NULL,
  `TITRE_ANNONCE` varchar(200) DEFAULT NULL,
  `ANNONCE` varchar(1024) DEFAULT NULL,
  `DATE_ANNONCE` date NOT NULL,
  PRIMARY KEY (`ID_ANNONCE`),
  KEY `FK_PUBLIER_ANNONCE` (`ID_ENSEIGNANT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `annonce`
--

INSERT INTO `annonce` (`ID_ANNONCE`, `ID_ENSEIGNANT`, `TITRE_ANNONCE`, `ANNONCE`, `DATE_ANNONCE`) VALUES
(1, 1, 'Reunion SMI SID 2', 'MAJ de la maquette\nMAJ du Diagramme de cas d''utilisation\nRealisation des diagrammes de sequence\nQuand:    lundi 11 avril 2016 03:00PM -03:30PM\nEmplacement:FSAC', '2016-05-01'),
(2, 1, 'Cour SMI PHP5', 'Rattrapage de la seance de PHP5\nRamenez votre machine s''il vous plait\nQuand:    lundi 23mai 2016 03:00PM -03:30PM\n', '2016-05-02'),
(3, 1, 'Reunion SMI SID 12', 'MAJ de la maquette\r\nMAJ du Diagramme de cas d''utilisation\r\nRealisation des diagrammes de sequence\r\nQuand:    lundi 11 avril 2016 03:00PM -03:30PM\r\nEmplacement:FSAC', '2016-06-05'),
(4, 1, 'Reunion', 'Rattrapage de la seance de PHP5\r\nRamenez votre machine s''il vous plait\r\nQuand:    lundi 23mai 2016 03:00PM -03:30PM\r\n', '2016-06-05'),
(7, 17, 'Rattrapage d''une sÃ©ance', 'On aura le 10-11-2015 Ã  13.45h un rattrapage de la sÃ©ance de la semaine derniÃ¨re.\r\nMerci de diffuser.', '2016-06-12');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_CATEGORIE` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID_CATEGORIE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`ID_CATEGORIE`, `NOM_CATEGORIE`) VALUES
(1, 'Cours'),
(2, 'Exercice'),
(3, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE IF NOT EXISTS `classe` (
  `ID_CLASSE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ENSEIGNANT` int(11) DEFAULT NULL,
  `NOM_COURS` varchar(200) DEFAULT NULL,
  `SEMESTRE` int(11) DEFAULT NULL,
  `ANNEE_UNIV` varchar(80) DEFAULT NULL,
  `NOM_FORMATION` varchar(200) DEFAULT NULL,
  `POURCENT_DEVOIR` float DEFAULT NULL,
  `POURCENT_EXAM` float DEFAULT NULL,
  `POURCENT_ASSDUITE` float DEFAULT NULL,
  `POURCENT_CONTROLE` float DEFAULT NULL,
  `NOTE_REFERENCE` float DEFAULT NULL,
  `NBR_SEANCE` int(11) NOT NULL,
  PRIMARY KEY (`ID_CLASSE`),
  KEY `FK_GERER` (`ID_ENSEIGNANT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Contenu de la table `classe`
--

INSERT INTO `classe` (`ID_CLASSE`, `ID_ENSEIGNANT`, `NOM_COURS`, `SEMESTRE`, `ANNEE_UNIV`, `NOM_FORMATION`, `POURCENT_DEVOIR`, `POURCENT_EXAM`, `POURCENT_ASSDUITE`, `POURCENT_CONTROLE`, `NOTE_REFERENCE`, `NBR_SEANCE`) VALUES
(8, 7, 'informatique decisionelle', 3, '2012/2013', 'SSIS', NULL, NULL, NULL, 0, NULL, 0),
(55, 1, 'OLAP', 6, '2016/2017', 'CUBE OLAP', 1, -1, 1, 1, 1, 0),
(63, 15, 'informatique decisionelle', 5, '2012/2013', 'SSIS', NULL, NULL, NULL, NULL, NULL, 0),
(65, 17, 'C++', 5, '2015/2016', 'JY-7', 50, 20, 10, 10, 20, 10);

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE IF NOT EXISTS `demande` (
  `CNE` int(11) NOT NULL,
  `ID_CLASSE` int(11) NOT NULL,
  `DATE_DEMANDE` date DEFAULT NULL,
  PRIMARY KEY (`CNE`,`ID_CLASSE`),
  KEY `FK_DEMANDE2` (`ID_CLASSE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `demande`
--

INSERT INTO `demande` (`CNE`, `ID_CLASSE`, `DATE_DEMANDE`) VALUES
(667897, 55, '2016-06-15');

-- --------------------------------------------------------

--
-- Structure de la table `devoir`
--

CREATE TABLE IF NOT EXISTS `devoir` (
  `ID_DEVOIR` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLASSE` int(11) DEFAULT NULL,
  `TITRE_DEVOIR` varchar(200) DEFAULT NULL,
  `ENONCE` varchar(1000) DEFAULT NULL,
  `DEADLINE` date DEFAULT NULL,
  `DATE_DEVOIR` date NOT NULL,
  PRIMARY KEY (`ID_DEVOIR`),
  KEY `FK_CONTIENT_DEVOIR` (`ID_CLASSE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Contenu de la table `devoir`
--

INSERT INTO `devoir` (`ID_DEVOIR`, `ID_CLASSE`, `TITRE_DEVOIR`, `ENONCE`, `DEADLINE`, `DATE_DEVOIR`) VALUES
(42, 55, 'Exel OLAP ', 'youssef', '2016-06-01', '2016-06-10'),
(43, 65, 'Mini calculatrice', 'Vous devez programmer une petite application Ã  l''aide de C++ qui permet de calculer les opÃ©rations arithmÃ©tiques basiques.', '2017-12-11', '2016-06-12');

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `ID_DOCUMENT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CATEGORIE` int(11) NOT NULL,
  `ID_CLASSE` int(11) NOT NULL,
  `TITRE_DOCUMENT` varchar(200) DEFAULT NULL,
  `DESCRIPTION` varchar(300) DEFAULT NULL,
  `URL_DOCUMENT` varchar(200) DEFAULT NULL,
  `DATE_DOCUMENT` date NOT NULL,
  PRIMARY KEY (`ID_DOCUMENT`),
  KEY `FK_CONTIENT_DOCUMENT` (`ID_CLASSE`),
  KEY `FK_POSSEDE` (`ID_CATEGORIE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `document`
--

INSERT INTO `document` (`ID_DOCUMENT`, `ID_CATEGORIE`, `ID_CLASSE`, `TITRE_DOCUMENT`, `DESCRIPTION`, `URL_DOCUMENT`, `DATE_DOCUMENT`) VALUES
(20, 1, 55, 'PHP', 'q3w2ed', 'Telechargement/Document/20Version14.jpg', '2016-06-10'),
(22, 1, 65, 'Partie 1', 'Ce document contient:\r\n-Quelques diffÃ©rences entre C et C++.\r\n-La dÃ©finition de POO(Programmation OrientÃ©e Objet).\r\n-La notion des classes.', 'Telechargement/Document/22Version22.png', '2016-06-12');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE IF NOT EXISTS `enseignant` (
  `ID_ENSEIGNANT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_ENSEIGNANT` varchar(200) DEFAULT NULL,
  `PRENOM_ENSEIGNANT` varchar(200) DEFAULT NULL,
  `MDP_ENSEIGNANT` varchar(200) DEFAULT NULL,
  `EMAIL_ENSEIGNANT` varchar(200) DEFAULT NULL,
  `DATE_ENSEIGNANT` date DEFAULT NULL,
  `DATE_INSCRIPTION` date DEFAULT NULL,
  `PHOTO_ENSEIGNANT` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID_ENSEIGNANT`),
  UNIQUE KEY `unique_email` (`EMAIL_ENSEIGNANT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `enseignant`
--

INSERT INTO `enseignant` (`ID_ENSEIGNANT`, `NOM_ENSEIGNANT`, `PRENOM_ENSEIGNANT`, `MDP_ENSEIGNANT`, `EMAIL_ENSEIGNANT`, `DATE_ENSEIGNANT`, `DATE_INSCRIPTION`, `PHOTO_ENSEIGNANT`) VALUES
(1, 'faraby', 'youssef', 'youssef', 'youssef@email.com', '2016-05-07', '2016-05-12', 'Telechargement/ImageEnseignant/14.png'),
(5, 'farhat', 'amine', 'amine', 'amin@gmail.com', '0012-12-15', '2016-05-14', 'League_of_Legends_brushed_logo_www.FullHDWpp.com_.jpg'),
(6, 'manar', 'manar@email.com', 'youssef', 'm@email.com', '2016-05-08', '2016-05-14', 'Logo-fsac.png'),
(7, 'oumaima', 'allaoui', 'allaoui', 'allaoui@gmail.com', '2016-05-08', '2016-05-14', 'Logo-fsac.png'),
(13, 'manar', 'Bouhaddoui', 'youssef', 'manar@email.com', '2016-05-14', '2016-05-17', 'Telechargement/ImageEnseignant/13.jpg'),
(15, 'Faraby', 'Youssef', 'youssef', 'youssef@Gmail.com', '1994-12-25', '2016-06-07', 'Telechargement/ImageEnseignant/15.jpg'),
(16, 'dadsi', 'haitam', '123456789', 'Jerf@email.com', '2016-06-25', '2016-06-09', 'Telechargement/ImageEnseignant/16.jpg'),
(17, 'nom enseignant', 'prenom enseignant', 'youssef', 'enseignant@user.fr', '1980-01-01', '2016-06-12', 'Telechargement/ImageEnseignant/17.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE IF NOT EXISTS `etudiant` (
  `CNE` int(11) NOT NULL,
  `NOM_ETUDIANT` varchar(200) DEFAULT NULL,
  `PRENOM_ETUDIANT` varchar(200) DEFAULT NULL,
  `MDP_ETUDIANT` varchar(200) DEFAULT NULL,
  `EMAIL_ETUDIANT` varchar(200) NOT NULL,
  `DATE_ETUDIANT` date DEFAULT NULL,
  `DATE_INSCRIPTION` date DEFAULT NULL,
  `PHOTO_ETUDIANT` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`CNE`),
  UNIQUE KEY `unique_email` (`EMAIL_ETUDIANT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`CNE`, `NOM_ETUDIANT`, `PRENOM_ETUDIANT`, `MDP_ETUDIANT`, `EMAIL_ETUDIANT`, `DATE_ETUDIANT`, `DATE_INSCRIPTION`, `PHOTO_ETUDIANT`) VALUES
(7878, 'faraby', 'youssef', 'youssef', 'Jalil_Jerf@email.com', '2016-05-07', '2016-05-12', 'Telechargement/ImageEtudiant/667897.jpg'),
(66789, 'manar', 'Bouhaddoui', 'oiuiouiouio', 'manar@email.com', '2016-05-14', '2016-05-17', 'Telechargement/ImageEtudiant/66789.jpg'),
(667897, 'manar', 'Bouhaddoui', 'uukjkjghjk', 'r@email.com', '2016-05-14', '2016-05-17', 'Telechargement/ImageEtudiant/667897.jpg'),
(3456789, 'nom etudiant', 'prenom etudiant', 'youssef', 'etudiant@user.fr', '2016-05-04', '2016-05-12', 'Telechargement/ImageEtudiant/3456789.jpg'),
(6666666, 'manar', 'Bouhaddoui', 'youssef', 'n@email.com', '2016-05-14', '2016-05-17', 'Telechargement/ImageEtudiant/6666666.jpg'),
(6767676, 'manar', 'bouhaddioui', 'manar', 'm@gmail.com', '2016-05-05', '2016-05-15', 'fdfsfsfsf');

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

CREATE TABLE IF NOT EXISTS `evaluation` (
  `ID_CLASSE` int(11) NOT NULL,
  `NBRE_ABSENCE` int(11) NOT NULL,
  `CNE` int(11) NOT NULL,
  `NOTE_NORMAL` float DEFAULT '0',
  `NOTE_RATTRAPAGE` float NOT NULL DEFAULT '0',
  `PRESENCE` float NOT NULL DEFAULT '0',
  `NOTE_DEVOIR` float NOT NULL DEFAULT '0',
  `NOTE_CONTROLE` float NOT NULL DEFAULT '0',
  `NOTE_GLOBALE` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_CLASSE`,`CNE`),
  KEY `FK_EVALUATION2` (`CNE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `evaluation`
--

INSERT INTO `evaluation` (`ID_CLASSE`, `NBRE_ABSENCE`, `CNE`, `NOTE_NORMAL`, `NOTE_RATTRAPAGE`, `PRESENCE`, `NOTE_DEVOIR`, `NOTE_CONTROLE`, `NOTE_GLOBALE`) VALUES
(55, 1, 7878, 0, 0, 0, 0, 0, 0),
(55, 5, 66789, 0, 0, 0, 0, 0, 0),
(55, 0, 3456789, 0, 0, 0, 0, 0, 0),
(55, 3, 6666666, 0, 0, 0, 0, 0, 0),
(65, 1, 66789, 7, 13, 18, 15, 6, 11),
(65, 2, 3456789, 15, 0, 16, 18, 16, 14.1);

-- --------------------------------------------------------

--
-- Structure de la table `format`
--

CREATE TABLE IF NOT EXISTS `format` (
  `ID_FORMAT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DEVOIR` int(11) NOT NULL,
  `TYPE_FORMAT` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID_FORMAT`),
  KEY `FK_AVOIR_FORMAT` (`ID_DEVOIR`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `format`
--

INSERT INTO `format` (`ID_FORMAT`, `ID_DEVOIR`, `TYPE_FORMAT`) VALUES
(39, 42, 'doc'),
(40, 43, 'pdf');

-- --------------------------------------------------------

--
-- Structure de la table `publier_annonce`
--

CREATE TABLE IF NOT EXISTS `publier_annonce` (
  `ID_ANNONCE` int(11) NOT NULL,
  `ID_CLASSE` int(11) NOT NULL,
  PRIMARY KEY (`ID_ANNONCE`,`ID_CLASSE`),
  KEY `FK_PUBLIEE_SUR2` (`ID_CLASSE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `publier_annonce`
--

INSERT INTO `publier_annonce` (`ID_ANNONCE`, `ID_CLASSE`) VALUES
(3, 55),
(4, 55),
(7, 65);

-- --------------------------------------------------------

--
-- Structure de la table `travail`
--

CREATE TABLE IF NOT EXISTS `travail` (
  `ID_TRAVAIL` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DEVOIR` int(11) NOT NULL,
  `CNE` int(11) NOT NULL,
  `URL_TRAVAIL` varchar(200) DEFAULT NULL,
  `Note_Devoir` float DEFAULT NULL,
  PRIMARY KEY (`ID_TRAVAIL`),
  KEY `FK_CONCERNE` (`ID_DEVOIR`),
  KEY `FK_RENDRE` (`CNE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `travail`
--

INSERT INTO `travail` (`ID_TRAVAIL`, `ID_DEVOIR`, `CNE`, `URL_TRAVAIL`, `Note_Devoir`) VALUES
(3, 42, 7878, 'Telechargement/Travail/Travail3.doc', NULL),
(5, 43, 3456789, 'Telechargement/Travail/Travail7.pdf', 18),
(6, 43, 66789, 'lbbbalbabjalfsasdfafzsdffd', 15);

-- --------------------------------------------------------

--
-- Structure de la table `versiondocument`
--

CREATE TABLE IF NOT EXISTS `versiondocument` (
  `ID_VERSION` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DOCUMENT` int(11) NOT NULL,
  `DATE_MISE` date DEFAULT NULL,
  `TYPE` varchar(200) DEFAULT NULL,
  `URL_VERSION` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`ID_VERSION`),
  KEY `FK_AVOIR` (`ID_DOCUMENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `versiondocument`
--

INSERT INTO `versiondocument` (`ID_VERSION`, `ID_DOCUMENT`, `DATE_MISE`, `TYPE`, `URL_VERSION`) VALUES
(13, 20, '2016-06-10', NULL, 'Telechargement/Document/20Version13.doc'),
(14, 20, '2016-06-10', NULL, 'Telechargement/Document/20Version14.jpg'),
(21, 22, '2016-06-12', NULL, 'Telechargement/Document/22Version21.png'),
(22, 22, '2016-06-13', NULL, 'Telechargement/Document/22Version22.png');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `FK_ABSENCE` FOREIGN KEY (`CNE`) REFERENCES `etudiant` (`CNE`),
  ADD CONSTRAINT `FK_ABSENCE2` FOREIGN KEY (`ID_CLASSE`) REFERENCES `classe` (`ID_CLASSE`);

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `FK_PUBLIER_ANNONCE` FOREIGN KEY (`ID_ENSEIGNANT`) REFERENCES `enseignant` (`ID_ENSEIGNANT`);

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `FK_GERER` FOREIGN KEY (`ID_ENSEIGNANT`) REFERENCES `enseignant` (`ID_ENSEIGNANT`);

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `FK_DEMANDE` FOREIGN KEY (`CNE`) REFERENCES `etudiant` (`CNE`),
  ADD CONSTRAINT `FK_DEMANDE_k` FOREIGN KEY (`ID_CLASSE`) REFERENCES `classe` (`ID_CLASSE`);

--
-- Contraintes pour la table `devoir`
--
ALTER TABLE `devoir`
  ADD CONSTRAINT `FK_CONTIENT_DEVOIR` FOREIGN KEY (`ID_CLASSE`) REFERENCES `classe` (`ID_CLASSE`);

--
-- Contraintes pour la table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `FK_CONTIENT_DOCUMENT` FOREIGN KEY (`ID_CLASSE`) REFERENCES `classe` (`ID_CLASSE`),
  ADD CONSTRAINT `FK_POSSEDE` FOREIGN KEY (`ID_CATEGORIE`) REFERENCES `categorie` (`ID_CATEGORIE`);

--
-- Contraintes pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `FK_EVALUATION` FOREIGN KEY (`ID_CLASSE`) REFERENCES `classe` (`ID_CLASSE`),
  ADD CONSTRAINT `FK_EVALUATION2` FOREIGN KEY (`CNE`) REFERENCES `etudiant` (`CNE`);

--
-- Contraintes pour la table `format`
--
ALTER TABLE `format`
  ADD CONSTRAINT `FK_AVOIR_FORMAT` FOREIGN KEY (`ID_DEVOIR`) REFERENCES `devoir` (`ID_DEVOIR`);

--
-- Contraintes pour la table `publier_annonce`
--
ALTER TABLE `publier_annonce`
  ADD CONSTRAINT `FK_PUBLIEE_SUR` FOREIGN KEY (`ID_ANNONCE`) REFERENCES `annonce` (`ID_ANNONCE`),
  ADD CONSTRAINT `FK_PUBLIEE_SUR2` FOREIGN KEY (`ID_CLASSE`) REFERENCES `classe` (`ID_CLASSE`);

--
-- Contraintes pour la table `travail`
--
ALTER TABLE `travail`
  ADD CONSTRAINT `FK_CONCERNE` FOREIGN KEY (`ID_DEVOIR`) REFERENCES `devoir` (`ID_DEVOIR`),
  ADD CONSTRAINT `FK_RENDRE` FOREIGN KEY (`CNE`) REFERENCES `etudiant` (`CNE`);

--
-- Contraintes pour la table `versiondocument`
--
ALTER TABLE `versiondocument`
  ADD CONSTRAINT `FK_AVOIR` FOREIGN KEY (`ID_DOCUMENT`) REFERENCES `document` (`ID_DOCUMENT`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
