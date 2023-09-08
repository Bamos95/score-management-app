-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 08 sep. 2023 à 17:33
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sportscores`
--

-- --------------------------------------------------------

--
-- Structure de la table `goal`
--

CREATE TABLE `goal` (
  `goalId` int(11) NOT NULL,
  `matchesId` int(11) NOT NULL,
  `teamId` int(11) NOT NULL,
  `scorer` varchar(255) NOT NULL,
  `goalMinute` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `goal`
--

INSERT INTO `goal` (`goalId`, `matchesId`, `teamId`, `scorer`, `goalMinute`) VALUES
(8, 16, 21, 'Jodel DOSSOU', 22),
(9, 17, 20, 'Michael POTE', 56);

-- --------------------------------------------------------

--
-- Structure de la table `matches`
--

CREATE TABLE `matches` (
  `matchesId` int(11) NOT NULL,
  `team1Id` int(11) NOT NULL,
  `team2Id` int(11) NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime DEFAULT NULL,
  `matchesStadium` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'scheduled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matches`
--

INSERT INTO `matches` (`matchesId`, `team1Id`, `team2Id`, `startTime`, `endTime`, `matchesStadium`, `status`) VALUES
(16, 19, 21, '2023-09-10 17:00:00', NULL, 'Stade Ominisport de Dogbo', 'completed'),
(17, 21, 20, '2023-09-10 11:00:00', NULL, 'Stade Ominisport de Parakou', 'completed'),
(18, 18, 19, '2023-09-11 19:00:00', NULL, 'Stade de l\'amitier GMK', 'scheduled');

-- --------------------------------------------------------

--
-- Structure de la table `statistics`
--

CREATE TABLE `statistics` (
  `statisticsId` int(11) NOT NULL,
  `matchesId` int(11) NOT NULL,
  `teamId` int(11) NOT NULL,
  `corner` int(2) NOT NULL DEFAULT 0,
  `redCard` int(2) NOT NULL DEFAULT 0,
  `yellowCard` int(2) NOT NULL DEFAULT 0,
  `foul` int(2) NOT NULL DEFAULT 0,
  `possession` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statistics`
--

INSERT INTO `statistics` (`statisticsId`, `matchesId`, `teamId`, `corner`, `redCard`, `yellowCard`, `foul`, `possession`) VALUES
(19, 16, 19, 6, 0, 3, 4, 45),
(20, 16, 21, 7, 0, 1, 5, 55),
(21, 17, 21, 6, 1, 4, 5, 47),
(22, 17, 20, 6, 0, 2, 4, 53);

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE `team` (
  `teamId` int(11) NOT NULL,
  `teamName` varchar(255) NOT NULL,
  `teamLogo` varchar(255) NOT NULL,
  `teamPoints` int(255) NOT NULL DEFAULT 0,
  `teamStory` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `team`
--

INSERT INTO `team` (`teamId`, `teamName`, `teamLogo`, `teamPoints`, `teamStory`) VALUES
(18, 'Alpha', '64facb7464b61_alpha.png', 0, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores illo molestiae sequi tempora in, quo vel vitae hic voluptatem aperiam quaerat commodi harum dolor ipsa odit assumenda corrupti iste ut.'),
(19, 'Beta', '64facbeb61ba3_beta.png', 0, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores illo molestiae sequi tempora in, quo vel vitae hic voluptatem aperiam quaerat commodi harum dolor ipsa odit assumenda corrupti iste ut.'),
(20, 'Gamma', '64facc13983cd_gamma.png', 3, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores illo molestiae sequi tempora in, quo vel vitae hic voluptatem aperiam quaerat commodi harum dolor ipsa odit assumenda corrupti iste ut.'),
(21, 'Omega', '64facc4f9bdc7_omega.png', 3, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores illo molestiae sequi tempora in, quo vel vitae hic voluptatem aperiam quaerat commodi harum dolor ipsa odit assumenda corrupti iste ut.');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userMail` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userCountry` varchar(255) NOT NULL,
  `userGroup` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`userId`, `userName`, `userMail`, `userPassword`, `userCountry`, `userGroup`) VALUES
(2, 'AMOUZOUN JEAN-BAPTISTE', 'admin@gmail.com', '$2y$10$lvkvT/..i69l2lFw1SJIbOuWkifga3x25BihDO203HwrVkJNd5mtW', 'Benin', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `goal`
--
ALTER TABLE `goal`
  ADD PRIMARY KEY (`goalId`),
  ADD KEY `idx_matchesId` (`matchesId`),
  ADD KEY `idx_teamId` (`teamId`);

--
-- Index pour la table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`matchesId`),
  ADD KEY `idx_team1Id` (`team1Id`),
  ADD KEY `idx_team2Id` (`team2Id`);

--
-- Index pour la table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`statisticsId`),
  ADD KEY `idx_matchesId` (`matchesId`),
  ADD KEY `idx_teamId` (`teamId`);

--
-- Index pour la table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`teamId`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `goal`
--
ALTER TABLE `goal`
  MODIFY `goalId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `matches`
--
ALTER TABLE `matches`
  MODIFY `matchesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `statisticsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
  MODIFY `teamId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `goal`
--
ALTER TABLE `goal`
  ADD CONSTRAINT `goal_ibfk_1` FOREIGN KEY (`matchesId`) REFERENCES `matches` (`matchesId`),
  ADD CONSTRAINT `goal_ibfk_2` FOREIGN KEY (`teamId`) REFERENCES `team` (`teamId`);

--
-- Contraintes pour la table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`team1Id`) REFERENCES `team` (`teamId`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`team2Id`) REFERENCES `team` (`teamId`);

--
-- Contraintes pour la table `statistics`
--
ALTER TABLE `statistics`
  ADD CONSTRAINT `statistics_ibfk_1` FOREIGN KEY (`teamId`) REFERENCES `team` (`teamId`),
  ADD CONSTRAINT `statistics_ibfk_2` FOREIGN KEY (`matchesId`) REFERENCES `matches` (`matchesId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
