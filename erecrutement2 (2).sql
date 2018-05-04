-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 05 mai 2018 à 00:16
-- Version du serveur :  10.1.29-MariaDB
-- Version de PHP :  7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `erecrutement2`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `id` int(11) NOT NULL,
  `cin` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `mots_de_passe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_naissance` datetime NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_telephone` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gouvernorat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `document_necessaire` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_cv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`id`, `cin`, `mots_de_passe`, `roles`, `nom`, `prenom`, `date_naissance`, `email`, `num_telephone`, `adresse`, `ville`, `gouvernorat`, `document_necessaire`, `id_cv`) VALUES
(1, '07214587', '$2y$13$W5keB37h1C.WniZiV8MsLemy9b4FJa5oF2zMNSg09Cu8DpCFTpQ2W', '[]', 'usernom', 'userprenom', '2018-11-04 00:15:32', 'user@user.com', '20000000', 'user_adresse', 'user_ville', 'user_gov', NULL, NULL),
(2, '07214588', '$2y$13$g01kZ91XO7K2b1nKIWC9u.Yg4yHFSOPjPfkd5vpAzdHRPBQ13v8pK', '[\"ROLE_CANDIDAT\"]', 'usernom', 'userprenom', '2019-07-04 00:34:21', 'user2@user.com', '55777777', 'user_adresse', 'mourouj', 'ben arous', NULL, 23),
(3, '02222222', '$2y$13$UUICksiglIR/4SgzqI7uCetEwvSS8x/fzzhlDLKTm/a4LTo/jLmgG', '[\"ROLE_CANDIDAT\"]', 'no', 'mdq', '2018-03-04 14:55:26', 'dsfdsfdsf@sqdfsqdsq.com', '21566880', 'fsgdsfdsfsdf', 'fssdfdsfdsf', 'fds', NULL, 24),
(4, '01010101', '$2y$13$t6ofWLR8ytfBy8cybk2p2OILLcnV9Fha.BaQCnQ7o4K9yG1FXgyu6', '[\"ROLE_CANDIDAT\"]', 'majdi', 'hannachi', '2019-06-04 12:21:20', 'maggy@gmail.com', '21566880', '24 rue 24', 'ddfdf', 'qdfdqf', NULL, 25),
(5, '03333333', '$2y$13$S7SRCnATpF1noG4i7FF37OlTG6CzLAPsD0KKSpHwCz/w10RnGWDJO', '[\"ROLE_CANDIDAT\"]', 'alia', 'alia', '1993-05-05 11:54:26', '03@gmail.com', '03030303', 'tataouine', 'gendouba', 'jendouba', NULL, 26);

-- --------------------------------------------------------

--
-- Structure de la table `concour`
--

CREATE TABLE `concour` (
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin` int(11) DEFAULT NULL,
  `annee` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_debut` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_fin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `documents_necessaire` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `introduction` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `maniere` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `mots_cle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `concour`
--

INSERT INTO `concour` (`reference`, `admin`, `annee`, `titre`, `lieu`, `date_debut`, `date_fin`, `documents_necessaire`, `introduction`, `maniere`, `observation`, `statut`, `mots_cle`) VALUES
('1256k', 1, '2018', 'title', 'place', '04-12-2018', '04-05-2018', 'CV', 'intro', 'comment', 'hello', 0, NULL),
('test3', 1, '2015', 'hello', 'good place', '04-04-2018', '04-06-2018', 'sdqsqdsqd', 'ontrairement à une opinion répandue, le Lorem Ipsum n\'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s\'est intéressé à un des mots latins les plus obscurs, consectetur, extrait d\'un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du', 'ontrairement à une opinion répandue, le Lorem Ipsum n\'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney Col', 'ontrairement à une opinion répandue, le Lorem Ipsum n\'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney Col', 1, 'kdfsldsf kaka'),
('tt2', 1, '2018', 'test2', 'jendouba', '04-03-2018', '04-11-2018', 'cv', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.', 'qsfqsd', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `concour_poste`
--

CREATE TABLE `concour_poste` (
  `id_poste` int(11) NOT NULL,
  `id_concour` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `concour_poste`
--

INSERT INTO `concour_poste` (`id_poste`, `id_concour`) VALUES
(1, 'test3'),
(1, 'tt2'),
(2, '1256k'),
(2, 'test3'),
(2, 'tt2');

-- --------------------------------------------------------

--
-- Structure de la table `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `Documentsnecessaire` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_candidat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cv`
--

INSERT INTO `cv` (`id`, `Documentsnecessaire`, `id_candidat`) VALUES
(23, '961bc9863409fa39b6def020b3801f5a.pdf', 2),
(24, 'c88aa6082b33ce8699176a3d558619c3.pdf', 3),
(25, '2da8ffc9f3ddaa1111c96f4c8430a6ec.pdf', 4),
(26, '36569470ce85a91e226f292fd57420ca.pdf', 5);

-- --------------------------------------------------------

--
-- Structure de la table `education`
--

CREATE TABLE `education` (
  `cv_id` int(11) NOT NULL,
  `specialite_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `education`
--

INSERT INTO `education` (`cv_id`, `specialite_id`) VALUES
(23, 1),
(24, 1),
(24, 2),
(25, 1),
(26, 1),
(26, 2);

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

CREATE TABLE `examen` (
  `id` int(11) NOT NULL,
  `concour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coefficient` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `observation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_candidat` int(11) DEFAULT NULL,
  `verification` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `examen`
--

INSERT INTO `examen` (`id`, `concour`, `coefficient`, `date`, `observation`, `note`, `type`, `id_candidat`, `verification`) VALUES
(16, '1256k', 3, NULL, NULL, '10', 'o', 4, 1),
(17, '1256k', 4, NULL, NULL, '20', 'p', 4, 1),
(18, '1256k', 2, NULL, NULL, '16', 'e', 4, 1),
(19, 'tt2', 3, NULL, NULL, NULL, 'o', 4, NULL),
(20, 'tt2', 4, NULL, NULL, NULL, 'p', 4, NULL),
(21, 'tt2', 2, NULL, NULL, NULL, 'e', 4, NULL),
(22, 'tt2', 3, NULL, NULL, NULL, 'o', 4, NULL),
(23, 'tt2', 4, NULL, NULL, NULL, 'p', 4, NULL),
(24, 'tt2', 2, NULL, NULL, NULL, 'e', 4, NULL),
(25, 'tt2', 3, NULL, NULL, NULL, 'o', 4, NULL),
(26, 'tt2', 4, NULL, NULL, NULL, 'p', 4, NULL),
(27, 'tt2', 2, NULL, NULL, NULL, 'e', 4, NULL),
(28, 'test3', 4, NULL, NULL, '12', 'o', 5, 1),
(29, 'test3', 1, NULL, NULL, '15', 'p', 5, 1),
(30, 'test3', 6, NULL, NULL, '15', 'e', 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `societe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `poste` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datedebut` date NOT NULL,
  `datefin` date NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cv_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `experience`
--

INSERT INTO `experience` (`id`, `societe`, `poste`, `datedebut`, `datefin`, `description`, `cv_id`) VALUES
(16, 'jijijij', ',ljlkjlkj', '2018-04-13', '2018-04-17', 'kjlkjlkj', 25),
(17, 'sagem', 'stage', '2018-04-01', '2018-04-30', 'poste', 26);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id` int(11) NOT NULL,
  `id_grh` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statut` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `id_grh`, `libelle`, `date_debut`, `date_fin`, `module`, `lieu`, `statut`) VALUES
(1, 3, 'kaka', '2018-05-02', '2018-05-19', 'kaka', 'kaka', 1);

-- --------------------------------------------------------

--
-- Structure de la table `formation_specialite`
--

CREATE TABLE `formation_specialite` (
  `formation_id` int(11) NOT NULL,
  `specialite_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `formation_specialite`
--

INSERT INTO `formation_specialite` (`formation_id`, `specialite_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `id` int(11) NOT NULL,
  `id_concour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_candidat` int(11) NOT NULL,
  `mot_cle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `situation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `moyenne` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`id`, `id_concour`, `id_candidat`, `mot_cle`, `situation`, `moyenne`) VALUES
(15, '1256k', 4, '1256k-4', 'a', 15.777777777778),
(16, 'tt2', 4, 'tt2-4', 'a', 3.9444444444444),
(18, 'test3', 5, 'test3-5', 'a', 13.909090909091);

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL,
  `matricule` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mots_de_passe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  `statut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id`, `matricule`, `email`, `mots_de_passe`, `roles`, `statut`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$13$Gueh4O3PJQZjwr3zCOxMROKBKlNPPOvaLt9i/zbPGOLYDbLiEQXtC', '[\"ROLE_ADMIN\"]', 1),
(2, 'agent', 'agent@gmail.com', '$2y$13$Gueh4O3PJQZjwr3zCOxMROKBKlNPPOvaLt9i/zbPGOLYDbLiEQXtC', '[\"ROLE_AGENT\"]', 0),
(3, 'rh', 'rh@mail.com', '$2y$13$KJnnIA2/dQZdJrJYma3sLu/xoOcy0v/J3v76GockhHPaWOym1wbKO', '[\"ROLE_RESPONSABLE\"]', 1);

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE `poste` (
  `id` int(11) NOT NULL,
  `observation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diplome` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `poste`
--

INSERT INTO `poste` (`id`, `observation`, `diplome`) VALUES
(1, 'Gestionnaire', 'gestion'),
(2, 'gestionnaire_2', 'marketing');

-- --------------------------------------------------------

--
-- Structure de la table `post_specialite`
--

CREATE TABLE `post_specialite` (
  `poste_id` int(11) NOT NULL,
  `specialite_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `post_specialite`
--

INSERT INTO `post_specialite` (`poste_id`, `specialite_id`) VALUES
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `id` int(11) NOT NULL,
  `observation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`id`, `observation`, `libelle`) VALUES
(1, 'esen', 'info de gestion'),
(2, 'esc', 'gestion');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6AB5B471ABE530DA` (`cin`),
  ADD UNIQUE KEY `UNIQ_6AB5B471E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_6AB5B47176120795` (`id_cv`);

--
-- Index pour la table `concour`
--
ALTER TABLE `concour`
  ADD PRIMARY KEY (`reference`),
  ADD KEY `IDX_7EC9B4F6880E0D76` (`admin`);

--
-- Index pour la table `concour_poste`
--
ALTER TABLE `concour_poste`
  ADD PRIMARY KEY (`id_poste`,`id_concour`),
  ADD KEY `IDX_85175331920C4E9B` (`id_poste`),
  ADD KEY `IDX_85175331A0541D86` (`id_concour`);

--
-- Index pour la table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B66FFE923A6E58E4` (`id_candidat`);

--
-- Index pour la table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`cv_id`,`specialite_id`),
  ADD KEY `IDX_DB0A5ED2CFE419E2` (`cv_id`),
  ADD KEY `IDX_DB0A5ED22195E0F0` (`specialite_id`);

--
-- Index pour la table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_514C8FEC7EC9B4F6` (`concour`),
  ADD KEY `IDX_514C8FEC3A6E58E4` (`id_candidat`);

--
-- Index pour la table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_590C103CFE419E2` (`cv_id`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_404021BF721D1EF3` (`id_grh`);

--
-- Index pour la table `formation_specialite`
--
ALTER TABLE `formation_specialite`
  ADD PRIMARY KEY (`formation_id`,`specialite_id`),
  ADD KEY `IDX_1F7E2FF85200282E` (`formation_id`),
  ADD KEY `IDX_1F7E2FF82195E0F0` (`specialite_id`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5E90F6D6AF92D22A` (`mot_cle`),
  ADD KEY `IDX_5E90F6D6A0541D86` (`id_concour`),
  ADD KEY `IDX_5E90F6D63A6E58E4` (`id_candidat`);

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A6BCF3DE12B2DC9C` (`matricule`),
  ADD UNIQUE KEY `UNIQ_A6BCF3DEE7927C74` (`email`);

--
-- Index pour la table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `post_specialite`
--
ALTER TABLE `post_specialite`
  ADD PRIMARY KEY (`poste_id`,`specialite_id`),
  ADD KEY `IDX_C4AEF500A0905086` (`poste_id`),
  ADD KEY `IDX_C4AEF5002195E0F0` (`specialite_id`);

--
-- Index pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `poste`
--
ALTER TABLE `poste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `FK_6AB5B47176120795` FOREIGN KEY (`id_cv`) REFERENCES `cv` (`id`);

--
-- Contraintes pour la table `concour`
--
ALTER TABLE `concour`
  ADD CONSTRAINT `FK_7EC9B4F6880E0D76` FOREIGN KEY (`admin`) REFERENCES `personnel` (`id`);

--
-- Contraintes pour la table `concour_poste`
--
ALTER TABLE `concour_poste`
  ADD CONSTRAINT `FK_85175331920C4E9B` FOREIGN KEY (`id_poste`) REFERENCES `poste` (`id`),
  ADD CONSTRAINT `FK_85175331A0541D86` FOREIGN KEY (`id_concour`) REFERENCES `concour` (`reference`);

--
-- Contraintes pour la table `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `FK_B66FFE923A6E58E4` FOREIGN KEY (`id_candidat`) REFERENCES `candidat` (`id`);

--
-- Contraintes pour la table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `FK_DB0A5ED22195E0F0` FOREIGN KEY (`specialite_id`) REFERENCES `specialite` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DB0A5ED2CFE419E2` FOREIGN KEY (`cv_id`) REFERENCES `cv` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `FK_514C8FEC3A6E58E4` FOREIGN KEY (`id_candidat`) REFERENCES `candidat` (`id`),
  ADD CONSTRAINT `FK_514C8FEC7EC9B4F6` FOREIGN KEY (`concour`) REFERENCES `concour` (`reference`);

--
-- Contraintes pour la table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `FK_590C103CFE419E2` FOREIGN KEY (`cv_id`) REFERENCES `cv` (`id`);

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `FK_404021BF721D1EF3` FOREIGN KEY (`id_grh`) REFERENCES `personnel` (`id`);

--
-- Contraintes pour la table `formation_specialite`
--
ALTER TABLE `formation_specialite`
  ADD CONSTRAINT `FK_1F7E2FF82195E0F0` FOREIGN KEY (`specialite_id`) REFERENCES `specialite` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1F7E2FF85200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `FK_EDBFD5EC3A6E58E4` FOREIGN KEY (`id_candidat`) REFERENCES `candidat` (`id`),
  ADD CONSTRAINT `FK_EDBFD5ECA0541D86` FOREIGN KEY (`id_concour`) REFERENCES `concour` (`reference`);

--
-- Contraintes pour la table `post_specialite`
--
ALTER TABLE `post_specialite`
  ADD CONSTRAINT `FK_C4AEF5002195E0F0` FOREIGN KEY (`specialite_id`) REFERENCES `specialite` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C4AEF500A0905086` FOREIGN KEY (`poste_id`) REFERENCES `poste` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
