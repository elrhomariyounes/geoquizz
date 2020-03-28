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
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `description` varchar(128) NOT NULL,
  `position` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `serie_id` int(11) DEFAULT NULL,
  `game_id` varchar(128) DEFAULT NULL,
  `user_id` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `description`, `position`, `url`, `serie_id`, `game_id`, `user_id`) VALUES
(32, 'CHRU Nancy', '[6.1923998943226,48.685635907875]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585181225/ywfb757m7wshk1e3fpnt.jpg', 19, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(33, 'Stade Marcel-Picot', '[6.2107174168409,48.695247403198]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585181370/zegvmictjwe4vkt2zcco.jpg', 19, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(34, 'Place Stanislas', '[6.1833046729752,48.693574535929]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585181435/zduepyvk8cl1gao95mha.jpg', 19, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(35, 'Parc de l&#39;embanie', '[6.2007006080529,48.649318951449]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585181737/kxrkjjce0nf1rmfz0dor.jpg', 19, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(36, 'Place de la carrière ', '[6.1819572530597,48.695459345517]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585181752/vi7gbfftwgp6midykmbs.jpg', 19, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(37, 'Palais de gouvernement ', '[6.1809049149513,48.697057020023]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585181873/gypcytab8iyi88j5pd8v.jpg', 19, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(38, 'Gare de train ', '[6.1746540212703,48.689895533633]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585181936/mctk0yioza4ctk2s6iyc.jpg', 19, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(39, 'Place de la république ', '[6.1761737002787,48.688764129211]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585182018/pw0qntapr1xeneidfkjh.jpg', 19, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(40, 'IUT Nancy Charlemagne', '[6.1611482440714,48.682834906124]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585182302/bhvvvfakorenrppghulp.jpg', 19, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(41, 'Parc de la Pépinière de Nancy', '[6.1838537361069,48.69776321191]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585182379/brav5aw1iektyuqiekqj.jpg', 19, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(42, 'Villa Majorelle', '[6.1639839317245,48.68555960765]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585182436/dk42ovqbalt74qkalauy.jpg', 19, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(43, 'Parc et Château de Montaigu', '[6.2110090758693,48.665963045572]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585182625/vpwahzswouxmtob4j8hr.jpg', 19, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(44, 'Tour Eiffel', '[2.2930097579956,48.856103445359]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585323932/qb93lmwempmpovo67mfr.webp', 20, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(45, 'sacré cœur ', '[2.3430257553613,48.886836103895]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585324029/aclysevytrfyxy6axzxf.jpg', 20, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(46, 'Arc de Triomphe', '[2.2948658731377,48.873787493619]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585324161/q8nujrfckwzxskjzsw5x.jpg', 20, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(47, 'Grand Palais', '[2.3122317545614,48.866083235729]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585324277/varp41rubwjszm32eygl.jpg', 20, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(48, 'Hôtel des Invalides', '[2.312307349118,48.857155683361]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585324421/ybe5yemhvkyutn3usb6f.jpg', 20, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(49, 'Musée du Louvre', '[2.3373977936192,48.860778074071]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585324524/cyg8cccv5nap7s4j9bql.jpg', 20, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(50, 'Place de la Concorde', '[2.3210243180422,48.865461845606]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585324615/ekcnfubrg8kzvjguu5xr.jpg', 20, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(51, 'Palais du Luxembourg', '[2.3372200473062,48.848047258843]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585324956/vtp5tpdjquxhqau4by4d.jpg', 20, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(52, 'Panthéon', '[2.3462122975665,48.84623200392]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585325077/mukbifwdxqvzk8zagjhm.jpg', 20, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(53, 'CENTQUATRE', '[2.370518953356,48.8901734964]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585325169/z2kez9sbhwimcxupae3v.jpg', 20, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(54, 'Porte de Brandebourg', '[13.377615153409,52.516295870933]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585325485/fzgd0m7oag2erytouep8.jpg', 21, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(55, 'Alexanderplatz', '[13.41323129702,52.521818173954]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585326015/bhrwwjsuvulgvjzr5dbm.jpg', 21, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(56, 'Alte Kommandantur', '[13.397897289922,52.517225758485]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585326103/kt5ufcwl3pucbavf6z1u.jpg', 21, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(57, 'Berliner Dom', '[13.401043339256,52.519213400863]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585326186/vktdjb2r27ine8bfrjb9.jpg', 21, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(58, 'chateau de charlottenburg', '[13.295703854601,52.520924361685]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585326251/doukg9rgz8j2ohn950pm.jpg', 21, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(59, 'Checkpoint Charlie', '[13.390384076609,52.507499472151]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585326387/nu3qdeomkyxdzc3my2ex.jpg', 21, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(60, 'colonne de la victoire', '[13.350151105408,52.514545313358]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585326523/hd8d97hwf6lclu4jersf.jpg', 21, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(61, 'Église du Souvenir de Berlin', '[13.335116833374,52.504981663514]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585326583/xoa3gmkno28bpbciknxw.jpg', 21, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(62, 'Mémorial aux Juifs assassinés d&#39;Europe', '[13.378355336862,52.513929148812]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585326700/rxdn4xurnevikt59ktzu.jpg', 21, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(63, 'Mur de Berlin ', '[13.376162135874,52.509890214823]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585326773/u5du5pmawnvguzpyfdyj.jpg', 21, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(64, 'Musée de Pergame', '[13.396887086327,52.52117277867]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585326910/lklohfzt4ffzgj8hujyk.jpg', 21, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(65, 'Fernsehturm de Berlin', '[13.409401102547,52.520897707875]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585327008/sbofyl1xggy84vdjjtfc.jpg', 21, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(66, 'Statue Liberté', '[-73.994334695084,40.727605001061]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585327183/gbzbrat8vkys4up7jh5q.webp', 22, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(67, 'Mosquée Hassan II', '[-7.6327560620293,33.608583993013]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585327255/pniw7ggthhoks2tosf4p.jpg', 24, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(68, 'Bab Sidi Abdelwahab ', '[-1.9106129329491,34.679690156271]', 'https://res.cloudinary.com/kelmoua1u/image/upload/v1585327345/zayydrpinaeqotvvmpnv.jpg', 23, NULL, '90dbe233-0d62-4420-ba04-1dce1ce2f525'),
(69, 'test', '[42.9,-15.5]', 'http://www.cloudinare.com/upload/images/nancy.jpeg', NULL, NULL, '18776e31-faee-42cf-94cc-3e91b0e415ac');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
