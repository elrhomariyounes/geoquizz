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
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `mail`, `password`, `created_at`, `updated_at`) VALUES
('18776e31-faee-42cf-94cc-3e91b0e415ac', 'Manon', 'manon@gmail.com', '$2y$10$o2j0kDU2D0UzmSxxv5kg3evYL.r3wFwutowDh9YsbQbk7/xIPplPG', '2020-03-18 17:32:11', '2020-03-18 17:32:11'),
('4277c852-e337-4fd3-a5be-2b364cd3d7ca', 'oualid', 'oualid@gmail.com', '$2y$10$PqPMckVK5XtqrOHZGMANsOTYAiv92/AxyGqHsUnxG46DsPJcDjQ1G', '2020-03-25 01:47:51', '2020-03-25 01:47:51'),
('54fa2ffc-24de-4221-9123-a669a710d10f', 'test1', 'test1@gmail.com', '$2y$10$c25fdzxAYdJH1K6McOF2h.4dh8f/lG1FHJyKXI3MGmMv9hGGRK6Ni', '2020-03-25 02:04:57', '2020-03-25 02:04:57'),
('90dbe233-0d62-4420-ba04-1dce1ce2f525', 'hicham kelmoua', 'hicham@gmail.com', '$2y$10$i3zGR3tAFZ9fZJ858ciPSu6LE3ubz25YfK1mR0wRgk7Qr.gkFU3tG', '2020-03-24 15:22:08', '2020-03-24 15:22:08'),
('c743e3ab-7a9e-4ab6-8e7a-70536b6f2694', 'Marine', 'marine@gmail.com', '$2y$10$tuI3BTi8MzRS7iIu0AAhBeMShujPL/N48kHObVIVHzf5qO6UwsINa', '2020-03-23 19:47:17', '2020-03-23 19:47:17'),
('d0b8c741-00f4-48d9-a99d-3fc9c362603d', 'youness', 'youness@gmail.com', '$2y$10$f7AGkkNLMJ2.RUqftJipe.ntvE8oEIO0D/Fyj2B4kLQn4NhX3OKOu', '2020-03-25 02:01:02', '2020-03-25 02:01:02');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
