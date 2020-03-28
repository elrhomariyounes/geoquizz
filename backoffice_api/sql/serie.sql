-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : sam. 28 mars 2020 à 03:50
-- Version du serveur :  10.4.12-MariaDB-1:10.4.12+maria~bionic
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `geoquizz`
--

-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

CREATE TABLE `serie` (
  `id` int(11) NOT NULL,
  `city` varchar(128) NOT NULL,
  `map_refs` varchar(128) DEFAULT NULL,
  `difficulty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `serie`
--

INSERT INTO `serie` (`id`, `city`, `map_refs`, `difficulty_id`) VALUES
(19, 'Nancy, France', '[48.695678168747285 , 6.183008840267177]', 3),
(20, 'Paris, France', '[48.87265956466878 , 2.342951209100921]', 1),
(21, 'Berlin, Allemagne', '[52.52439178615086 , 13.402172549251556]', 2),
(22, 'New York, État de New York, États-Unis', '[40.72760500106086 , -73.99433469508438]', 1),
(23, 'Oujda, Maroc', '[34.69706265866465 , -1.8881735723304671]', 3),
(24, 'Casablanca, Maroc', '[33.584406398983326 , -7.5898782687171895]', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `serie`
--
ALTER TABLE `serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
