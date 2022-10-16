-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 16 oct. 2022 à 23:36
-- Version du serveur : 8.0.30-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `game`
--

-- --------------------------------------------------------

--
-- Structure de la table `connexion3`
--

CREATE DATABASE game;


CREATE TABLE game.connexion3 (
  `id` int NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `PL1` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `connexion3`
--

INSERT INTO game.connexion3 (`id`, `identifiant`, `password`, `PL1`) VALUES
(1, 'user', 'test', 0x4f3a363a22506c61796572223a31343a7b733a323a226964223b693a313b733a313a2278223b693a3232363b733a313a2279223b693a36393b733a373a226e616d65746167223b733a343a2275736572223b733a353a22636f6c6f72223b733a353a227768697465223b733a383a22696e647573747279223b693a31353b733a363a22656e65726779223b693a323430343b733a353a2273636f7265223b693a3630303b733a353a22696e647074223b693a3130353b733a353a22656e657074223b693a32383b733a31303a22726573736f7572636573223b613a353a7b693a303b4f3a393a22526573736f75726365223a353a7b733a333a226c766c223b693a353b733a31353a2275706772616465436f73745f496e64223b693a363430303b733a31353a2275706772616465436f73745f456e65223b693a3332303b733a31303a2270726f64756374696f6e223b693a38303b733a363a22696e64616c65223b693a303b7d693a313b4f3a393a22526573736f75726365223a353a7b733a333a226c766c223b693a323b733a31353a2275706772616465436f73745f496e64223b693a38303b733a31353a2275706772616465436f73745f456e65223b693a3830303b733a31303a2270726f64756374696f6e223b693a31343b733a363a22696e64616c65223b693a313b7d693a323b4f3a393a22526573736f75726365223a353a7b733a333a226c766c223b693a333b733a31353a2275706772616465436f73745f496e64223b693a313630303b733a31353a2275706772616465436f73745f456e65223b693a38303b733a31303a2270726f64756374696f6e223b693a32303b733a363a22696e64616c65223b693a303b7d693a333b4f3a393a22526573736f75726365223a353a7b733a333a226c766c223b693a313b733a31353a2275706772616465436f73745f496e64223b693a3430303b733a31353a2275706772616465436f73745f456e65223b693a32303b733a31303a2270726f64756374696f6e223b693a353b733a363a22696e64616c65223b693a303b7d693a343b4f3a393a22526573736f75726365223a353a7b733a333a226c766c223b693a323b733a31353a2275706772616465436f73745f496e64223b693a38303b733a31353a2275706772616465436f73745f456e65223b693a3830303b733a31303a2270726f64756374696f6e223b693a31343b733a363a22696e64616c65223b693a313b7d7d733a31323a226e62526573736f7572636573223b693a353b733a393a226275696c64696e6773223b613a31313a7b693a303b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a303b733a323a226964223b733a393a224f6666656e73697665223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a353b733a383a226361706163697479223b693a303b733a393a2261747461636b696e67223b693a303b7d693a313b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a303b733a323a226964223b733a393a224f6666656e73697665223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a353b733a383a226361706163697479223b693a303b733a393a2261747461636b696e67223b693a303b7d693a323b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a303b733a323a226964223b733a393a224f6666656e73697665223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a353b733a383a226361706163697479223b693a303b733a393a2261747461636b696e67223b693a303b7d693a333b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a333b733a323a226964223b733a31303a224c6f6769737469717565223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a303b733a383a226361706163697479223b693a35303b733a393a2261747461636b696e67223b693a303b7d693a343b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a353b733a323a226964223b733a393a224f6666656e73697665223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a353b733a383a226361706163697479223b693a303b733a393a2261747461636b696e67223b693a303b7d693a353b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a353b733a323a226964223b733a31303a224c6f6769737469717565223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a303b733a383a226361706163697479223b693a35303b733a393a2261747461636b696e67223b693a303b7d693a363b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a373b733a323a226964223b733a353a2243616e6f6e223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a373b733a383a226361706163697479223b693a303b733a393a2261747461636b696e67223b693a303b7d693a373b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a353b733a323a226964223b733a393a224f6666656e73697665223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a353b733a383a226361706163697479223b693a303b733a393a2261747461636b696e67223b693a303b7d693a383b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a353b733a323a226964223b733a393a224f6666656e73697665223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a353b733a383a226361706163697479223b693a303b733a393a2261747461636b696e67223b693a303b7d693a393b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a373b733a323a226964223b733a353a2243616e6f6e223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a373b733a383a226361706163697479223b693a303b733a393a2261747461636b696e67223b693a303b7d693a31303b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a373b733a323a226964223b733a353a2243616e6f6e223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a373b733a383a226361706163697479223b693a303b733a393a2261747461636b696e67223b693a303b7d7d733a31313a226e624275696c64696e6773223b693a31313b7d),
(2, 'user2', 'test', 0x4f3a363a22506c61796572223a31343a7b733a323a226964223b693a323b733a313a2278223b693a3239353b733a313a2279223b693a3339363b733a373a226e616d65746167223b733a353a227573657232223b733a353a22636f6c6f72223b733a343a2270696e6b223b733a383a22696e647573747279223b693a373732303b733a363a22656e65726779223b693a333738363b733a353a2273636f7265223b693a3230303b733a353a22696e647074223b693a353b733a353a22656e657074223b693a373b733a31303a22726573736f7572636573223b613a323a7b693a303b4f3a393a22526573736f75726365223a353a7b733a333a226c766c223b693a313b733a31353a2275706772616465436f73745f496e64223b693a3430303b733a31353a2275706772616465436f73745f456e65223b693a32303b733a31303a2270726f64756374696f6e223b693a353b733a363a22696e64616c65223b693a303b7d693a313b4f3a393a22526573736f75726365223a353a7b733a333a226c766c223b693a313b733a31353a2275706772616465436f73745f496e64223b693a34303b733a31353a2275706772616465436f73745f456e65223b693a3430303b733a31303a2270726f64756374696f6e223b693a373b733a363a22696e64616c65223b693a313b7d7d733a31323a226e62526573736f7572636573223b693a323b733a393a226275696c64696e6773223b613a353a7b693a303b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a353b733a323a226964223b733a31303a224c6f6769737469717565223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a303b733a383a226361706163697479223b693a35303b733a393a2261747461636b696e67223b693a303b7d693a313b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a303b733a323a226964223b733a393a224f6666656e73697665223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a353b733a383a226361706163697479223b693a303b733a393a2261747461636b696e67223b693a303b7d693a323b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a303b733a323a226964223b733a393a224f6666656e73697665223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a353b733a383a226361706163697479223b693a303b733a393a2261747461636b696e67223b693a303b7d693a333b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a303b733a323a226964223b733a353a2243616e6f6e223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a373b733a383a226361706163697479223b693a303b733a393a2261747461636b696e67223b693a303b7d693a343b4f3a383a224275696c64696e67223a363a7b733a363a226865616c7468223b693a373b733a323a226964223b733a353a2243616e6f6e223b733a363a22737461747573223b693a313b733a353a22666f726365223b693a373b733a383a226361706163697479223b693a303b733a393a2261747461636b696e67223b693a303b7d7d733a31313a226e624275696c64696e6773223b693a353b7d),
(3, 'user3', 'test', 0x4f3a363a22506c61796572223a31343a7b733a323a226964223b693a333b733a313a2278223b693a34313b733a313a2279223b693a3138393b733a373a226e616d65746167223b733a353a227573657233223b733a353a22636f6c6f72223b733a363a226f72616e6765223b733a383a22696e647573747279223b693a3530303b733a363a22656e65726779223b693a303b733a353a2273636f7265223b693a303b733a353a22696e647074223b693a303b733a353a22656e657074223b693a303b733a31303a22726573736f7572636573223b613a303a7b7d733a31323a226e62526573736f7572636573223b693a303b733a393a226275696c64696e6773223b613a303a7b7d733a31313a226e624275696c64696e6773223b693a303b7d);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `connexion3`
--
ALTER TABLE game.connexion3
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `connexion3`
--
ALTER TABLE game.connexion3
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;