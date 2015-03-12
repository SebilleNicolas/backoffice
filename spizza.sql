-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 09 Décembre 2014 à 16:00
-- Version du serveur :  5.00.15
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `spizza`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(10) NOT NULL,
  `mdp` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `login`, `mdp`) VALUES
(1, 'nico', 'nico'),
(2, 'erwan', 'erwan');

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `CodeAdresse` int(11) NOT NULL auto_increment,
  `Rue` varchar(20) NOT NULL,
  `Complement` varchar(100) default NULL,
  `CodeVille` int(11) NOT NULL,
  PRIMARY KEY  (`CodeAdresse`),
  KEY `CodeVille` (`CodeVille`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `boisson`
--

CREATE TABLE IF NOT EXISTS `boisson` (
  ` CodeBoisson` int(11) NOT NULL auto_increment,
  `NomBoisson` varchar(30) NOT NULL,
  `PrixBoisson` double NOT NULL,
  PRIMARY KEY  (` CodeBoisson`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `NumClient` int(11) NOT NULL auto_increment,
  `NomClient` varchar(30) NOT NULL,
  `PrenomClient` varchar(30) NOT NULL,
  `Tel` int(10) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  `NbCommandes` int(5) NOT NULL,
  `idAdresse` int(11) NOT NULL,
  PRIMARY KEY  (`NumClient`),
  KEY `idAdresse` (`idAdresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` int(11) NOT NULL auto_increment,
  `NumCommande` int(11) NOT NULL,
  `DateCommande` date NOT NULL,
  `PrixCommande` float NOT NULL,
  `NumClient` int(11) NOT NULL,
  `CodePizza` int(11) NOT NULL,
  `CodeLivreur` int(11) NOT NULL,
  `CodeTarification` int(11) NOT NULL,
  PRIMARY KEY  (`idCommande`),
  KEY `NumClient` (`NumClient`,`CodePizza`,`CodeLivreur`,`CodeTarification`),
  KEY `NumClient_2` (`NumClient`),
  KEY `CodePizza` (`CodePizza`),
  KEY `CodeLivreur` (`CodeLivreur`),
  KEY `CodeTarification` (`CodeTarification`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `compose_panini`
--

CREATE TABLE IF NOT EXISTS `compose_panini` (
  `CodePanini` int(11) NOT NULL,
  `NumIngredient` int(11) NOT NULL,
  KEY `NomPanini` (`CodePanini`,`NumIngredient`),
  KEY `NumIngredient` (`NumIngredient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `compose_pizza`
--

CREATE TABLE IF NOT EXISTS `compose_pizza` (
  `CodePizza` int(11) NOT NULL,
  `NumIngredient` int(10) NOT NULL,
  KEY `NomPizza` (`CodePizza`,`NumIngredient`),
  KEY `NumIngredient` (`NumIngredient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `compose_salade`
--

CREATE TABLE IF NOT EXISTS `compose_salade` (
  `CodeSalade` int(11) NOT NULL,
  `NumIngredient` int(11) NOT NULL,
  KEY `NomSalade` (`CodeSalade`,`NumIngredient`),
  KEY `NumIngredient` (`NumIngredient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dessert`
--

CREATE TABLE IF NOT EXISTS `dessert` (
  `CodeDessert` int(11) NOT NULL auto_increment,
  `NomDessert` varchar(30) NOT NULL,
  `PrixDessert` double NOT NULL,
  PRIMARY KEY  (`CodeDessert`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE IF NOT EXISTS `ingredient` (
  `CodeIngredient` int(11) NOT NULL auto_increment,
  `NomIngredient` varchar(30) default NULL,
  PRIMARY KEY  (`CodeIngredient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `livreur`
--

CREATE TABLE IF NOT EXISTS `livreur` (
  `CodeLivreur` int(11) NOT NULL auto_increment,
  `NomLivreur` varchar(30) NOT NULL,
  `TelLivreur` int(10) NOT NULL,
  PRIMARY KEY  (`CodeLivreur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `CodeMenu` int(11) NOT NULL auto_increment,
  `NomMenu` varchar(30) NOT NULL,
  `PrixMenu` float NOT NULL,
  `NbPizza` int(11) default NULL,
  `NbPanini` int(11) default NULL,
  `NbTexMex` int(11) default NULL,
  `NbDessert` int(11) default NULL,
  `NbSalade` int(11) default NULL,
  `NbBoisson` int(11) default NULL,
  `CodeTarification` int(11) NOT NULL,
  PRIMARY KEY  (`CodeMenu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `panini`
--

CREATE TABLE IF NOT EXISTS `panini` (
  `CodePanini` int(11) NOT NULL auto_increment,
  `NomPanini` varchar(30) NOT NULL,
  `PrixPanini` double NOT NULL,
  PRIMARY KEY  (`CodePanini`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pizza`
--

CREATE TABLE IF NOT EXISTS `pizza` (
  `CodePizza` int(11) NOT NULL auto_increment,
  `NomPizza` varchar(30) NOT NULL,
  `Prix` float NOT NULL,
  PRIMARY KEY  (`CodePizza`),
  KEY `NomPizza` (`NomPizza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `salade`
--

CREATE TABLE IF NOT EXISTS `salade` (
  `CodeSalade` int(11) NOT NULL auto_increment,
  `NomSalade` varchar(30) NOT NULL,
  `PrixPanini` double NOT NULL,
  PRIMARY KEY  (`CodeSalade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tarification`
--

CREATE TABLE IF NOT EXISTS `tarification` (
  `CodeTarification` int(11) NOT NULL auto_increment,
  `Taille` varchar(30) NOT NULL,
  `Coefficient` float NOT NULL,
  PRIMARY KEY  (`CodeTarification`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `texmex`
--

CREATE TABLE IF NOT EXISTS `texmex` (
  `CodeTexmex` int(11) NOT NULL auto_increment,
  `NomTexmex` varchar(30) NOT NULL,
  `PrixTexmex` float NOT NULL,
  PRIMARY KEY  (`CodeTexmex`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE IF NOT EXISTS `ville` (
  `CodeVille` int(11) NOT NULL auto_increment,
  `NomVille` varchar(30) NOT NULL,
  `CodePostal` int(5) NOT NULL,
  PRIMARY KEY  (`CodeVille`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`CodeVille`, `NomVille`, `CodePostal`) VALUES
(1, 'Butry-sur-Oise', 95430),
(2, 'Mériel', 95630);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`CodeVille`) REFERENCES `ville` (`CodeVille`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`CodeAdresse`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_5` FOREIGN KEY (`NumClient`) REFERENCES `client` (`NumClient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`CodePizza`) REFERENCES `pizza` (`CodePizza`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_3` FOREIGN KEY (`CodeLivreur`) REFERENCES `livreur` (`CodeLivreur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_4` FOREIGN KEY (`CodeTarification`) REFERENCES `tarification` (`CodeTarification`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `compose_panini`
--
ALTER TABLE `compose_panini`
  ADD CONSTRAINT `compose_panini_ibfk_2` FOREIGN KEY (`NumIngredient`) REFERENCES `ingredient` (`CodeIngredient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compose_panini_ibfk_1` FOREIGN KEY (`CodePanini`) REFERENCES `panini` (`CodePanini`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `compose_pizza`
--
ALTER TABLE `compose_pizza`
  ADD CONSTRAINT `compose_pizza_ibfk_2` FOREIGN KEY (`CodePizza`) REFERENCES `pizza` (`CodePizza`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compose_pizza_ibfk_1` FOREIGN KEY (`NumIngredient`) REFERENCES `ingredient` (`CodeIngredient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `compose_salade`
--
ALTER TABLE `compose_salade`
  ADD CONSTRAINT `compose_salade_ibfk_2` FOREIGN KEY (`NumIngredient`) REFERENCES `ingredient` (`CodeIngredient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compose_salade_ibfk_1` FOREIGN KEY (`CodeSalade`) REFERENCES `salade` (`CodeSalade`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
