-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 17 fév. 2024 à 19:23
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionbanque`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(5) NOT NULL,
  `nomAdmin` varchar(30) NOT NULL,
  `prenomAdmin` varchar(30) NOT NULL,
  `numCniAdmin` varchar(20) NOT NULL,
  `telAdmin` varchar(10) NOT NULL,
  `emailAdmin` varchar(32) NOT NULL,
  `loginAdmin` varchar(30) NOT NULL,
  `passwordAdmin` varchar(64) NOT NULL,
  `profilAdmin` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`idAdmin`, `nomAdmin`, `prenomAdmin`, `numCniAdmin`, `telAdmin`, `emailAdmin`, `loginAdmin`, `passwordAdmin`, `profilAdmin`) VALUES
(1, 'Coulibaly', 'Drissa', '1023547896', '776903893', 'dc377303@gmail.com', 'Nymosdt', '03528fd510a20613c293f905906c7d62', 'caissierNymosdt_1707510081_pexels-anete-lusina-4792732.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `beneficiaire`
--

CREATE TABLE `beneficiaire` (
  `idBeneficiaire_FK` int(5) NOT NULL,
  `numCompte_FK` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `beneficiaire`
--

INSERT INTO `beneficiaire` (`idBeneficiaire_FK`, `numCompte_FK`) VALUES
(4, '7947-5400-7987-0017'),
(8, '8127-9919-7265-4159'),
(4, '1099-6532-0486-4963'),
(9, '8127-9919-7265-4159'),
(9, '5001-3080-5641-0784'),
(12, '1099-6532-0486-4963'),
(4, '8666-6953-3489-8465'),
(13, '8127-9919-7265-4159'),
(4, '5548-9632-9316-5028'),
(14, '8127-9919-7265-4159'),
(4, '5228-7353-4287-7052'),
(18, '8127-9919-7265-4159');

-- --------------------------------------------------------

--
-- Structure de la table `caissier`
--

CREATE TABLE `caissier` (
  `idCaissier` int(5) NOT NULL,
  `nomCaissier` varchar(30) NOT NULL,
  `prenomCaissier` varchar(30) NOT NULL,
  `emailCaissier` varchar(30) DEFAULT NULL,
  `dateNaissCaissier` date DEFAULT NULL,
  `profilCaissier` varchar(200) DEFAULT NULL,
  `telCaissier` varchar(10) DEFAULT NULL,
  `numCniCaissier` varchar(20) NOT NULL,
  `passwordCaissier` varchar(64) NOT NULL,
  `loginCaissier` varchar(30) NOT NULL,
  `idStatutCaissier_FK` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `caissier`
--

INSERT INTO `caissier` (`idCaissier`, `nomCaissier`, `prenomCaissier`, `emailCaissier`, `dateNaissCaissier`, `profilCaissier`, `telCaissier`, `numCniCaissier`, `passwordCaissier`, `loginCaissier`, `idStatutCaissier_FK`) VALUES
(2, 'MBaye', 'Mama', 'afambaye00@gmail.com', '2000-02-15', 'caissierMamaM_1707509625_pexels-anete-lusina-4792732.jpg', '785999108', '1234567893', '03528fd510a20613c293f905906c7d62', 'MamaM', 1),
(9, 'Coulibaly', 'Drissa', 'dc377303@gmail.com', '2004-03-11', 'caissierNymosdt_1707510081_pexels-anete-lusina-4792732.jpg', '776641002', '1234567891', '03528fd510a20613c293f905906c7d62', 'Nymosdt', 22);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idClient` int(5) NOT NULL,
  `nomClient` varchar(30) NOT NULL,
  `prenomClient` varchar(30) NOT NULL,
  `emailClient` varchar(32) NOT NULL,
  `loginClient` varchar(30) NOT NULL,
  `passwordClient` varchar(64) NOT NULL,
  `telClient` varchar(10) NOT NULL,
  `numCniClient` varchar(15) DEFAULT NULL,
  `dateNaissClient` date DEFAULT NULL,
  `nationnaliteClient` enum('mali','mauritanie','senegal','congo') DEFAULT NULL,
  `adresseClient` varchar(64) DEFAULT NULL,
  `codePostalClient` varchar(10) DEFAULT NULL,
  `villeClient` varchar(32) DEFAULT NULL,
  `rectoCniClient` varchar(200) DEFAULT NULL,
  `versoCniClient` varchar(200) DEFAULT NULL,
  `profilClient` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idClient`, `nomClient`, `prenomClient`, `emailClient`, `loginClient`, `passwordClient`, `telClient`, `numCniClient`, `dateNaissClient`, `nationnaliteClient`, `adresseClient`, `codePostalClient`, `villeClient`, `rectoCniClient`, `versoCniClient`, `profilClient`) VALUES
(11, 'Coulibaly', 'Drissa', 'dc377303@gmail.com', 'Nymosdt', '03528fd510a20613c293f905906c7d62', '776641001', '1234567890', '2004-03-11', 'mali', 'Colobane, Dakar', '12000', 'Dakar', 'client_11_1705607401_drissa.jpg', 'client_11_1705607401_eade24d129744165c0e84207aa6bcf82.jpg', 'client_11_1705607401_WhatsApp Image 2023-11-11 à 10.38.19_f4d18873.jpg'),
(13, 'NDiaye', 'Adja', 'irera@gmail.com', 'AdjaN', '03528fd510a20613c293f905906c7d62', '777870829', '1234567891', '2004-04-08', 'senegal', 'Rufisque, Dakar', '11000', 'Dakar', 'client_13_1705571180_artworks-LLQm4z8XzUd3jO3C-dekT6A-t500x500.jpg', 'client_13_1705571180_ataque-dos-titas-1080x569.jpg', 'client_13_1705571180_Demon slayer.jpg'),
(14, 'Dione', 'Seynabou', 'seynaboudjone@gmail.com', 'NabouS', '03528fd510a20613c293f905906c7d62', '771794521', '1234567892', '1990-05-10', 'senegal', 'Colobane, Dakar', '12000', 'Dakar', 'client_14_1705614311_WhatsApp Image 2023-11-27 à 22.10.24_80126564.jpg', 'client_14_1705614311_WhatsApp Image 2023-11-27 à 22.13.37_5b8cbf81.jpg', 'client_14_1705614311_defabe2096f52d4c2fe510f4adc9f7e7.jpg'),
(15, 'Gueye', 'Samba', 'samba12@gmail.com', 'SambaG', '03528fd510a20613c293f905906c7d62', '776831460', '1475284682', '2005-06-08', 'senegal', 'Sipres,Dakar', '15000', 'Dakar', 'client_15_1705914358_artworks-LLQm4z8XzUd3jO3C-dekT6A-t500x500.jpg', 'client_15_1705914358_eade24d129744165c0e84207aa6bcf82.jpg', 'client_15_1705914358_eade24d129744165c0e84207aa6bcf82.jpg'),
(16, 'Coulibaly', 'Chacka', 'chape@gmail.com', 'Chape', '03528fd510a20613c293f905906c7d62', '777141196', '1425639872', '1998-03-02', 'mali', 'Cite Douane, Colobane', '11000', 'Dakar', 'client_16_1705961495_287470-katana-anime_girls-Vocaloid-Hatsune_Miku.jpg', 'client_16_1705961495_ataque-dos-titas-1080x569.jpg', 'client_16_1705961495_WhatsApp Image 2024-01-22 à 22.09.32_dadc9aa7.jpg'),
(18, 'Tandia', 'Kissima', 'kismatandia0@gmail.com', 'Kismart', '03528fd510a20613c293f905906c7d62', '784413314', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Malotita', 'Princess', 'princessmalotita@gmail.com', 'Lotita', '03528fd510a20613c293f905906c7d62', '772502967', '1478523692', '2004-02-19', 'congo', 'Ouakam, Dakar', '14578', 'Dakar', 'client_19_1706093533_287470-katana-anime_girls-Vocaloid-Hatsune_Miku.jpg', 'client_19_1706093533_Emploie_du_Temps.png', 'client_19_1706093533_Demon slayer.jpg'),
(20, 'Sene', 'Talla', 'senemortala@gmail.com', 'TallaM', '03528fd510a20613c293f905906c7d62', '784834667', '1452879622', '2004-01-05', 'senegal', 'Yoff, Dakar', '12452', 'Dakar', 'client_20_1706094935_css-2.jpg', 'client_20_1706094935_defabe2096f52d4c2fe510f4adc9f7e7.jpg', 'client_20_1706094935_artworks-LLQm4z8XzUd3jO3C-dekT6A-t500x500.jpg'),
(21, 'Toure', 'Ayib', 'papaayib@gmail.com', 'AyibT', '03528fd510a20613c293f905906c7d62', '777125413', '1478523698', '2003-12-26', 'senegal', 'Mariste, Dakar', '14875', 'Dakar', 'client_21_1706179058_425199.jpg', 'client_21_1706179058_IMG-20230111-WA0034.jpg', 'client_21_1706179058_artworks-LLQm4z8XzUd3jO3C-dekT6A-t500x500.jpg'),
(22, 'Sene', 'Saliou', 'saluisitosene@gmail.com', 'SaliouS', '03528fd510a20613c293f905906c7d62', '778493448', '1475236984', '2003-05-08', 'senegal', 'Ouakam, Dakar', '14525', 'Dakar', 'client_22_1706349143_code asci.jpeg', 'client_22_1706349143_defabe2096f52d4c2fe510f4adc9f7e7.jpg', 'client_22_1706349143_R (1).jpg'),
(23, 'Diop', 'Babacar', 'pababacar0@gmail.com', 'PapaD', '03528fd510a20613c293f905906c7d62', '773451258', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Togola', 'Drissa', 'drissatogola494@gmail.com', 'DBTOT', '03528fd510a20613c293f905906c7d62', '771147485', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Aidara', 'Chams', 'chaidara4@gmail.com', 'ChamsA', '03528fd510a20613c293f905906c7d62', '778039289', '1452368975', '2005-05-01', 'senegal', 'Dakar, Dakar', '15230', 'zz', 'client_25_1708173688_WhatsApp Image 2024-02-01 à 19.34.24_1040efd4.jpg', 'client_25_1708173688_WhatsApp Image 2024-02-05 à 23.04.50_59155d64.jpg', 'client_25_1708173688_WhatsApp Image 2024-02-01 à 17.52.45_95665e0c.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `idCompte` int(5) NOT NULL,
  `numCompte` varchar(20) NOT NULL,
  `dateOuverture` datetime DEFAULT current_timestamp(),
  `Solde` decimal(10,2) DEFAULT NULL,
  `idClient_FK` int(5) NOT NULL,
  `idTypeCompte_FK` int(5) NOT NULL,
  `idStatutCompte_FK` int(5) NOT NULL,
  `idGestionnaire_FK` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`idCompte`, `numCompte`, `dateOuverture`, `Solde`, `idClient_FK`, `idTypeCompte_FK`, `idStatutCompte_FK`, `idGestionnaire_FK`) VALUES
(4, '8127-9919-7265-4159', '2024-01-12 21:20:40', 800.00, 11, 1, 19, 1),
(7, '6724-5272-7901-0980', '2024-01-17 17:33:46', 0.00, 13, 4, 22, 1),
(8, '7947-5400-7987-0017', '2024-01-18 21:42:54', 150.00, 14, 3, 23, 1),
(9, '1099-6532-0486-4963', '2024-01-22 09:03:03', 100.00, 15, 4, 24, 1),
(10, '3461-9543-6528-6264', '2024-01-22 22:05:51', 0.00, 16, 4, 25, 1),
(11, '2844-0244-9982-8173', '2024-01-23 13:52:50', 0.00, 18, 3, 26, 3),
(12, '5001-3080-5641-0784', '2024-01-24 10:40:15', 100.00, 19, 3, 27, 1),
(13, '8666-6953-3489-8465', '2024-01-24 11:13:37', 150.00, 20, 2, 28, 1),
(14, '5548-9632-9316-5028', '2024-01-25 10:30:11', 200.00, 21, 3, 29, 1),
(15, '6484-2006-8262-5051', '2024-01-27 09:49:43', 0.00, 22, 3, 30, 1),
(16, '8609-0167-1479-9184', '2024-01-27 09:54:52', 0.00, 23, 4, 31, 3),
(17, '2466-1924-3904-5581', '2024-02-16 22:48:20', 0.00, 24, 4, 32, NULL),
(18, '5228-7353-4287-7052', '2024-02-17 12:38:35', 0.00, 25, 3, 33, 1);

-- --------------------------------------------------------

--
-- Structure de la table `gestionnaire`
--

CREATE TABLE `gestionnaire` (
  `idGestionnaire` int(5) NOT NULL,
  `nomGestionnaire` varchar(30) NOT NULL,
  `prenomGestionnaire` varchar(30) NOT NULL,
  `emailGestionnaire` varchar(30) DEFAULT NULL,
  `dateNaissGestionnaire` date DEFAULT NULL,
  `profilGestionnaire` varchar(200) DEFAULT NULL,
  `TelGestionnaire` varchar(10) NOT NULL,
  `numCniGestionnaire` varchar(20) NOT NULL,
  `loginGestionnaire` varchar(30) NOT NULL,
  `passwordGestionnaire` varchar(64) NOT NULL,
  `idStatutGestionnaire_FK` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gestionnaire`
--

INSERT INTO `gestionnaire` (`idGestionnaire`, `nomGestionnaire`, `prenomGestionnaire`, `emailGestionnaire`, `dateNaissGestionnaire`, `profilGestionnaire`, `TelGestionnaire`, `numCniGestionnaire`, `loginGestionnaire`, `passwordGestionnaire`, `idStatutGestionnaire_FK`) VALUES
(1, 'Togola', 'Drissa', 'drissatogola494@gmail.com', '2004-03-11', 'gestionnaireDBTOT_1707514698_pexels-anete-lusina-4792732.jpg', '771147485', '1234567877', 'DBTOT', '03528fd510a20613c293f905906c7d62', 1),
(3, 'Coulibaly', 'Drissa', 'dc377303@gmail.com', '2004-03-11', 'gestionnaireNymosdt_1707515927_pexels-anete-lusina-4792732.jpg', '776641002', '1234567891', 'Nymosdt', '03528fd510a20613c293f905906c7d62', 3);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `idMessage` int(5) NOT NULL,
  `message` text NOT NULL,
  `statutMessage` enum('lue','non lue') NOT NULL DEFAULT 'non lue',
  `dateHeureMessage` datetime NOT NULL DEFAULT current_timestamp(),
  `idDestinateurMessage_FK` int(5) NOT NULL,
  `idExpediteurMessage_FK` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`idMessage`, `message`, `statutMessage`, `dateHeureMessage`, `idDestinateurMessage_FK`, `idExpediteurMessage_FK`) VALUES
(17, 'salut', 'lue', '2024-01-19 21:00:16', 4, 8),
(18, 'Salut', 'lue', '2024-01-20 12:55:23', 8, 4),
(19, 'oui ça va', 'lue', '2024-01-20 12:59:52', 4, 8),
(20, 'yo bro', 'lue', '2024-01-20 13:00:22', 8, 4),
(21, 'oui cc??', 'lue', '2024-01-21 12:14:20', 4, 8),
(22, 'bien et toi ?', 'lue', '2024-01-21 12:17:57', 8, 4),
(23, 'la famille elle se porte bien j\'espere ?', 'lue', '2024-01-21 12:21:36', 4, 8),
(24, 'la famille elle se porte bien j\'espere ?', 'lue', '2024-01-21 12:29:24', 4, 8),
(25, 'oui oui tous le monde se porte bien et la tienne', 'lue', '2024-01-21 12:32:58', 8, 4),
(26, 'oui oui tous le monde se porte bien et la tienne', 'lue', '2024-01-21 12:34:05', 8, 4),
(27, 'bien aussi', 'lue', '2024-01-21 12:45:45', 4, 8),
(28, '☺', 'lue', '2024-01-21 12:49:58', 8, 4),
(29, 'salut bro', 'lue', '2024-01-22 09:13:02', 9, 4),
(30, 'votre code est : CODE_65ae315589302', 'lue', '2024-01-22 09:13:15', 9, 4),
(31, 'j\'ai reçu l\'argent Merci', 'lue', '2024-01-22 10:01:27', 4, 9),
(32, 'c\'est normal', 'lue', '2024-01-22 12:39:57', 9, 4),
(33, 'c\'est normal', 'lue', '2024-01-22 12:44:09', 9, 4),
(34, 'c\'est normal', 'lue', '2024-01-22 12:45:05', 9, 4),
(35, '☻', 'lue', '2024-01-22 12:47:12', 4, 9),
(36, 'CODE_65b0ed676a69b', 'lue', '2024-01-24 10:59:47', 12, 9),
(37, 'est ce que tu as reçu l\'argent??', 'lue', '2024-01-24 11:07:00', 12, 9),
(38, 'oui j\'ai reçu Merci??', 'lue', '2024-01-24 11:08:31', 9, 12),
(39, 'CODE_65b0f325c98ed', 'lue', '2024-01-24 11:25:53', 13, 4),
(40, 'CODE_65b15308e6558', 'lue', '2024-01-24 18:15:47', 13, 4),
(41, 'salut', 'lue', '2024-01-24 18:45:28', 13, 4),
(42, 'Salut', 'lue', '2024-01-24 18:45:51', 13, 4),
(43, 'CODE_65b15aa323004', 'lue', '2024-01-24 18:46:47', 12, 9),
(44, 'CODE_65b15aa323004', 'lue', '2024-01-24 19:11:25', 4, 9),
(45, 'CODE_65b23e080a430	', 'lue', '2024-01-25 11:15:54', 14, 4),
(46, 'voici votre code', 'lue', '2024-01-25 11:16:16', 14, 4),
(47, 'CODE_65bd49f343e86', 'lue', '2024-02-02 20:04:01', 9, 4),
(50, 'CODE_65d0aace9d2f3', 'lue', '2024-02-17 12:51:47', 18, 4);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `idNotification` int(5) NOT NULL,
  `messageNotification` varchar(200) NOT NULL,
  `statutNotification` enum('lue','non lue') NOT NULL DEFAULT 'non lue',
  `dateHeureNotification` datetime NOT NULL DEFAULT current_timestamp(),
  `idCompte_FK` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `idOperation` int(5) NOT NULL,
  `dateOperation` datetime NOT NULL,
  `montantOperation` decimal(10,2) NOT NULL,
  `typeOperation` enum('depot','retrait','','') NOT NULL,
  `numCompteBeneficiaire_FK` varchar(20) NOT NULL,
  `acceptationOperation` enum('vrai','faux','rejeter','') NOT NULL DEFAULT 'faux',
  `codeValidation` varchar(32) NOT NULL,
  `idCompte_FK` int(5) NOT NULL,
  `idCaissier_FK` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `operation`
--

INSERT INTO `operation` (`idOperation`, `dateOperation`, `montantOperation`, `typeOperation`, `numCompteBeneficiaire_FK`, `acceptationOperation`, `codeValidation`, `idCompte_FK`, `idCaissier_FK`) VALUES
(8, '2024-01-19 12:09:14', 150.00, 'retrait', '7947-5400-7987-0017', 'vrai', 'CODE_65aa44ddbd7a2', 4, 2),
(11, '2024-01-19 12:09:14', 150.00, 'depot', '8127-9919-7265-4159', 'vrai', 'CODE_65aa44ddbd7a2', 8, 2),
(12, '2024-01-22 09:53:49', 350.00, 'retrait', '1099-6532-0486-4963', 'vrai', 'CODE_65ae315589302', 4, 2),
(13, '2024-01-22 09:53:49', 350.00, 'depot', '8127-9919-7265-4159', 'vrai', 'CODE_65ae315589302', 9, 2),
(14, '2024-01-24 11:04:15', 100.00, 'retrait', '5001-3080-5641-0784', 'vrai', 'CODE_65b0ed676a69b', 9, 2),
(15, '2024-01-24 11:04:15', 100.00, 'depot', '1099-6532-0486-4963', 'vrai', 'CODE_65b0ed676a69b', 12, 2),
(16, '2024-01-24 11:26:40', 100.00, 'retrait', '8666-6953-3489-8465', 'rejeter', 'CODE_65b0f325c98ed', 4, 2),
(17, '2024-01-24 11:26:40', 1005.00, 'depot', '8127-9919-7265-4159', 'rejeter', 'CODE_65b0f325c98ed', 13, 2),
(18, '2024-01-24 18:18:33', 150.00, 'retrait', '8666-6953-3489-8465', 'vrai', 'CODE_65b15308e6558', 4, 2),
(19, '2024-01-24 18:18:33', 150.00, 'depot', '8127-9919-7265-4159', 'vrai', 'CODE_65b15308e6558', 13, 2),
(20, '2024-01-24 18:47:45', 150.00, 'retrait', '8127-9919-7265-4159', 'vrai', 'CODE_65b15aa323004', 9, 2),
(21, '2024-01-24 18:47:45', 150.00, 'depot', '1099-6532-0486-4963', 'vrai', 'CODE_65b15aa323004', 4, 2),
(22, '2024-01-25 11:22:08', 200.00, 'retrait', '5548-9632-9316-5028', 'vrai', 'CODE_65b23e080a430', 4, 2),
(23, '2024-01-25 11:22:08', 200.00, 'depot', '8127-9919-7265-4159', 'vrai', 'CODE_65b23e080a430', 14, 2),
(24, '2024-02-02 20:06:30', 200.00, 'retrait', '1099-6532-0486-4963', 'rejeter', 'CODE_65bd49f343e86', 4, 2),
(25, '2024-02-02 20:06:30', 200.00, 'depot', '8127-9919-7265-4159', 'rejeter', 'CODE_65bd49f343e86', 9, 2),
(26, '2024-02-02 20:13:03', 200.00, 'retrait', '1099-6532-0486-4963', 'rejeter', 'CODE_65bd4bdaa1408', 4, 2),
(27, '2024-02-02 20:13:01', 200.00, 'retrait', '1099-6532-0486-4963', 'rejeter', 'CODE_65bd4c1c4ed5f', 4, 2),
(28, '2024-02-02 20:12:53', 200.00, 'retrait', '1099-6532-0486-4963', 'rejeter', 'CODE_65bd4ca79af2a', 4, 2),
(29, '2024-02-02 20:18:57', 200.00, 'retrait', '1099-6532-0486-4963', 'rejeter', 'CODE_65bd4e097ce42', 4, 2),
(30, '2024-02-17 12:49:08', 200.00, 'retrait', '5228-7353-4287-7052', 'faux', 'CODE_65d0aace9d2f3', 4, NULL),
(31, '2024-02-17 12:52:20', 200.00, 'depot', '8127-9919-7265-4159', 'faux', 'CODE_65d0aace9d2f3', 18, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `statut_caissier`
--

CREATE TABLE `statut_caissier` (
  `idStatutCaissier` int(5) NOT NULL,
  `statutCaissier` enum('bloquer','actif') NOT NULL DEFAULT 'actif',
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statut_caissier`
--

INSERT INTO `statut_caissier` (`idStatutCaissier`, `statutCaissier`, `dateTime`) VALUES
(1, 'actif', '2024-02-09 15:32:32'),
(22, 'actif', '2024-02-09 20:21:21');

-- --------------------------------------------------------

--
-- Structure de la table `statut_compte`
--

CREATE TABLE `statut_compte` (
  `idStatutCompte` int(5) NOT NULL,
  `statutCompte` enum('verifier','non verifier','bloquer','verification en cours') NOT NULL DEFAULT 'non verifier',
  `DateTime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statut_compte`
--

INSERT INTO `statut_compte` (`idStatutCompte`, `statutCompte`, `DateTime`) VALUES
(19, 'verifier', '2024-02-10 15:20:50'),
(22, 'verifier', '2024-01-18 09:54:16'),
(23, 'verifier', '2024-01-18 21:47:28'),
(24, 'verifier', '2024-01-22 09:10:36'),
(25, 'verifier', '2024-01-25 09:53:22'),
(26, 'verification en cours', '2024-02-10 22:17:50'),
(27, 'verifier', '2024-01-24 10:54:44'),
(28, 'verifier', '2024-01-24 11:45:14'),
(29, 'verifier', '2024-01-25 10:52:37'),
(30, 'verifier', '2024-01-27 22:50:21'),
(31, 'non verifier', '2024-02-10 22:22:21'),
(32, 'non verifier', '2024-02-16 22:48:20'),
(33, 'verifier', '2024-02-17 12:43:30');

-- --------------------------------------------------------

--
-- Structure de la table `statut_gestionnaire`
--

CREATE TABLE `statut_gestionnaire` (
  `idStatutGestionnaire` int(5) NOT NULL,
  `statutGestionnaire` enum('bloquer','actif') NOT NULL DEFAULT 'actif',
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statut_gestionnaire`
--

INSERT INTO `statut_gestionnaire` (`idStatutGestionnaire`, `statutGestionnaire`, `dateTime`) VALUES
(1, 'actif', '2024-02-09 21:03:40'),
(3, 'actif', '2024-02-09 21:58:47');

-- --------------------------------------------------------

--
-- Structure de la table `typecompte`
--

CREATE TABLE `typecompte` (
  `idTypeCompte` int(5) NOT NULL,
  `nomTypeCompte` varchar(30) NOT NULL,
  `codeTypeCompte` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `typecompte`
--

INSERT INTO `typecompte` (`idTypeCompte`, `nomTypeCompte`, `codeTypeCompte`) VALUES
(1, 'Courant', 'CCOU'),
(2, 'Epargne', 'CEPA'),
(3, 'Business', 'CBUS'),
(4, 'Commercial', 'CCOM');

-- --------------------------------------------------------

--
-- Structure de la table `verification`
--

CREATE TABLE `verification` (
  `idVerif` int(5) NOT NULL,
  `dateNaissVerif` date NOT NULL,
  `nationnaliterVerif` enum('mali','mauritanie','senegal','congo') NOT NULL,
  `numCniVerif` varchar(15) NOT NULL,
  `adresseResidenceVerif` varchar(64) NOT NULL,
  `codePostalVerif` varchar(10) NOT NULL,
  `villeVerif` varchar(32) NOT NULL,
  `rectoCniVerif` varchar(200) NOT NULL,
  `versoCniVerif` varchar(200) NOT NULL,
  `profilVerif` varchar(200) NOT NULL,
  `acceptationVerif` enum('vrai','faux','rejeter','bloquer') NOT NULL DEFAULT 'faux',
  `idCompte_FK` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `verification`
--

INSERT INTO `verification` (`idVerif`, `dateNaissVerif`, `nationnaliterVerif`, `numCniVerif`, `adresseResidenceVerif`, `codePostalVerif`, `villeVerif`, `rectoCniVerif`, `versoCniVerif`, `profilVerif`, `acceptationVerif`, `idCompte_FK`) VALUES
(19, '2004-04-08', 'senegal', '1234567891', 'Rufisque, Dakar', '11000', 'Dakar', 'client_13_1705571180_artworks-LLQm4z8XzUd3jO3C-dekT6A-t500x500.jpg', 'client_13_1705571180_ataque-dos-titas-1080x569.jpg', 'client_13_1705571180_Demon slayer.jpg', 'vrai', 7),
(21, '2004-03-11', 'mali', '1234567890', 'Colobane, Dakar', '12000', 'Dakar', 'client_11_1705572011_drissa.jpg', 'client_11_1705572011_defabe2096f52d4c2fe510f4adc9f7e7.jpg', 'client_11_1705572011_WhatsApp Image 2023-11-11 à 10.38.19_f4d18873.jpg', 'rejeter', 4),
(23, '1990-05-10', 'senegal', '1234567892', 'Colobane, Dakar', '12000', 'Dakar', 'client_14_1705614311_WhatsApp Image 2023-11-27 à 22.10.24_80126564.jpg', 'client_14_1705614311_WhatsApp Image 2023-11-27 à 22.13.37_5b8cbf81.jpg', 'client_14_1705614311_defabe2096f52d4c2fe510f4adc9f7e7.jpg', 'vrai', 8),
(24, '2005-06-08', 'senegal', '1475284682', 'Sipres,Dakar', '15000', 'Dakar', 'client_15_1705914358_artworks-LLQm4z8XzUd3jO3C-dekT6A-t500x500.jpg', 'client_15_1705914358_eade24d129744165c0e84207aa6bcf82.jpg', 'client_15_1705914358_eade24d129744165c0e84207aa6bcf82.jpg', 'vrai', 9),
(25, '1998-03-02', 'mali', '1425639872', 'Cite Douane, Colobane', '11000', 'Dakar', 'client_16_1705961495_287470-katana-anime_girls-Vocaloid-Hatsune_Miku.jpg', 'client_16_1705961495_ataque-dos-titas-1080x569.jpg', 'client_16_1705961495_WhatsApp Image 2024-01-22 à 22.09.32_dadc9aa7.jpg', 'vrai', 10),
(26, '2000-12-04', 'mauritanie', '1758945621', 'Wakam, Dakar', '14578', 'Dakar', 'client_18_1706018796_WhatsApp Image 2024-01-23 à 14.05.10_0870d337.jpg', 'client_18_1706018796_WhatsApp Image 2024-01-23 à 14.05.11_d931ddf2.jpg', 'client_18_1706018796_WhatsApp Image 2024-01-23 à 14.05.12_e3e8d6e7.jpg', 'bloquer', 11),
(27, '2004-02-19', 'congo', '1478523692', 'Ouakam, Dakar', '14578', 'Dakar', 'client_19_1706093533_287470-katana-anime_girls-Vocaloid-Hatsune_Miku.jpg', 'client_19_1706093533_Emploie_du_Temps.png', 'client_19_1706093533_Demon slayer.jpg', 'vrai', 12),
(28, '2004-01-05', 'senegal', '1452879622', 'Yoff, Dakar', '12452', 'Dakar', 'client_20_1706094935_css-2.jpg', 'client_20_1706094935_defabe2096f52d4c2fe510f4adc9f7e7.jpg', 'client_20_1706094935_artworks-LLQm4z8XzUd3jO3C-dekT6A-t500x500.jpg', 'vrai', 13),
(29, '2003-12-26', 'senegal', '1478523698', 'Mariste, Dakar', '14875', 'Dakar', 'client_21_1706179058_425199.jpg', 'client_21_1706179058_IMG-20230111-WA0034.jpg', 'client_21_1706179058_artworks-LLQm4z8XzUd3jO3C-dekT6A-t500x500.jpg', 'vrai', 14),
(30, '2003-05-08', 'senegal', '1475236984', 'Ouakam, Dakar', '14525', 'Dakar', 'client_22_1706349143_code asci.jpeg', 'client_22_1706349143_defabe2096f52d4c2fe510f4adc9f7e7.jpg', 'client_22_1706349143_R (1).jpg', 'vrai', 15),
(31, '2001-09-16', 'senegal', '1422369478', 'Sipres,Dakar', '17000', 'Dakar', 'client_23_1706349441_Emploie_du_Temps.png', 'client_23_1706349441_IMG-20230111-WA0021.jpg', 'client_23_1706349441_Demon slayer.jpg', 'rejeter', 16),
(32, '2000-12-04', 'mauritanie', '1425787536', 'Ouakam, Dakar', '12000', 'Dakar', 'client_18_1707602761_WhatsApp Image 2024-01-23 à 14.05.10_0870d337.jpg', 'client_18_1707602761_WhatsApp Image 2024-01-23 à 14.05.11_d931ddf2.jpg', 'client_18_1707602761_WhatsApp Image 2024-01-23 à 14.05.12_e3e8d6e7.jpg', 'faux', 11),
(33, '2005-05-01', 'senegal', '1452368975', 'Dakar, Dakar', '15230', 'zz', 'client_25_1708173688_WhatsApp Image 2024-02-01 à 19.34.24_1040efd4.jpg', 'client_25_1708173688_WhatsApp Image 2024-02-05 à 23.04.50_59155d64.jpg', 'client_25_1708173688_WhatsApp Image 2024-02-01 à 17.52.45_95665e0c.jpg', 'vrai', 18);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Index pour la table `beneficiaire`
--
ALTER TABLE `beneficiaire`
  ADD KEY `Compte_BeneficiaireFK` (`numCompte_FK`),
  ADD KEY `Compte_Beneficiaire` (`idBeneficiaire_FK`);

--
-- Index pour la table `caissier`
--
ALTER TABLE `caissier`
  ADD PRIMARY KEY (`idCaissier`),
  ADD UNIQUE KEY `loginCaissier` (`loginCaissier`),
  ADD UNIQUE KEY `numCniCaissier` (`numCniCaissier`),
  ADD KEY `StatutCaissier_Caissier` (`idStatutCaissier_FK`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`),
  ADD UNIQUE KEY `loginClient` (`loginClient`),
  ADD UNIQUE KEY `telClient` (`telClient`),
  ADD UNIQUE KEY `emailClient` (`emailClient`),
  ADD UNIQUE KEY `numCniClient` (`numCniClient`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`idCompte`),
  ADD UNIQUE KEY `numCompte` (`numCompte`),
  ADD KEY `Client_Compte` (`idClient_FK`),
  ADD KEY `TypeCompte_Compte` (`idTypeCompte_FK`),
  ADD KEY `Statut_Compte` (`idStatutCompte_FK`),
  ADD KEY `Gestionnaire_Compte` (`idGestionnaire_FK`);

--
-- Index pour la table `gestionnaire`
--
ALTER TABLE `gestionnaire`
  ADD PRIMARY KEY (`idGestionnaire`),
  ADD KEY `StatutGestionnaire_Gestionnaire` (`idStatutGestionnaire_FK`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idMessage`),
  ADD KEY `Message_Destinateur` (`idDestinateurMessage_FK`),
  ADD KEY `Message_Expediteur` (`idExpediteurMessage_FK`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`idNotification`),
  ADD KEY `compte_notification` (`idCompte_FK`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`idOperation`),
  ADD KEY `Beneficiaire_Operation` (`numCompteBeneficiaire_FK`),
  ADD KEY `Compte_Operation` (`idCompte_FK`),
  ADD KEY `Caissier_Operation` (`idCaissier_FK`);

--
-- Index pour la table `statut_caissier`
--
ALTER TABLE `statut_caissier`
  ADD PRIMARY KEY (`idStatutCaissier`);

--
-- Index pour la table `statut_compte`
--
ALTER TABLE `statut_compte`
  ADD PRIMARY KEY (`idStatutCompte`);

--
-- Index pour la table `statut_gestionnaire`
--
ALTER TABLE `statut_gestionnaire`
  ADD PRIMARY KEY (`idStatutGestionnaire`);

--
-- Index pour la table `typecompte`
--
ALTER TABLE `typecompte`
  ADD PRIMARY KEY (`idTypeCompte`);

--
-- Index pour la table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`idVerif`),
  ADD KEY `Compte_Verification` (`idCompte_FK`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `caissier`
--
ALTER TABLE `caissier`
  MODIFY `idCaissier` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `idCompte` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `gestionnaire`
--
ALTER TABLE `gestionnaire`
  MODIFY `idGestionnaire` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `idMessage` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `idNotification` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `idOperation` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `statut_caissier`
--
ALTER TABLE `statut_caissier`
  MODIFY `idStatutCaissier` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `statut_compte`
--
ALTER TABLE `statut_compte`
  MODIFY `idStatutCompte` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `statut_gestionnaire`
--
ALTER TABLE `statut_gestionnaire`
  MODIFY `idStatutGestionnaire` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `typecompte`
--
ALTER TABLE `typecompte`
  MODIFY `idTypeCompte` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `verification`
--
ALTER TABLE `verification`
  MODIFY `idVerif` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `beneficiaire`
--
ALTER TABLE `beneficiaire`
  ADD CONSTRAINT `Compte_Beneficiaire` FOREIGN KEY (`idBeneficiaire_FK`) REFERENCES `compte` (`idCompte`),
  ADD CONSTRAINT `Compte_BeneficiaireFK` FOREIGN KEY (`numCompte_FK`) REFERENCES `compte` (`numCompte`);

--
-- Contraintes pour la table `caissier`
--
ALTER TABLE `caissier`
  ADD CONSTRAINT `StatutCaissier_Caissier` FOREIGN KEY (`idStatutCaissier_FK`) REFERENCES `statut_caissier` (`idStatutCaissier`);

--
-- Contraintes pour la table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `Client_Compte` FOREIGN KEY (`idClient_FK`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `Gestionnaire_Compte` FOREIGN KEY (`idGestionnaire_FK`) REFERENCES `gestionnaire` (`idGestionnaire`),
  ADD CONSTRAINT `Statut_Compte` FOREIGN KEY (`idStatutCompte_FK`) REFERENCES `statut_compte` (`idStatutCompte`),
  ADD CONSTRAINT `TypeCompte_Compte` FOREIGN KEY (`idTypeCompte_FK`) REFERENCES `typecompte` (`idTypeCompte`);

--
-- Contraintes pour la table `gestionnaire`
--
ALTER TABLE `gestionnaire`
  ADD CONSTRAINT `StatutGestionnaire_Gestionnaire` FOREIGN KEY (`idStatutGestionnaire_FK`) REFERENCES `statut_gestionnaire` (`idStatutGestionnaire`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `Message_Destinateur` FOREIGN KEY (`idDestinateurMessage_FK`) REFERENCES `compte` (`idCompte`),
  ADD CONSTRAINT `Message_Expediteur` FOREIGN KEY (`idExpediteurMessage_FK`) REFERENCES `compte` (`idCompte`);

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `compte_notification` FOREIGN KEY (`idCompte_FK`) REFERENCES `compte` (`idCompte`);

--
-- Contraintes pour la table `operation`
--
ALTER TABLE `operation`
  ADD CONSTRAINT `Beneficiaire_Operation` FOREIGN KEY (`numCompteBeneficiaire_FK`) REFERENCES `beneficiaire` (`numCompte_FK`),
  ADD CONSTRAINT `Caissier_Operation` FOREIGN KEY (`idCaissier_FK`) REFERENCES `caissier` (`idCaissier`),
  ADD CONSTRAINT `Compte_Operation` FOREIGN KEY (`idCompte_FK`) REFERENCES `compte` (`idCompte`);

--
-- Contraintes pour la table `verification`
--
ALTER TABLE `verification`
  ADD CONSTRAINT `Compte_Verification` FOREIGN KEY (`idCompte_FK`) REFERENCES `compte` (`idCompte`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
