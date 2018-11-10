-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: mysql-tomus.alwaysdata.net
-- Generation Time: Nov 04, 2018 at 08:26 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tomus_cookburn`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `parametre` varchar(25) NOT NULL,
  `value` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`parametre`, `value`) VALUES
('featured_ingredient', '33'),
('maintenance', '0'),
('pagination', '3'),
('theme', '2');

-- --------------------------------------------------------

--
-- Table structure for table `favoris`
--

CREATE TABLE `favoris` (
  `id_user` int(11) NOT NULL,
  `id_recette` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favoris`
--

INSERT INTO `favoris` (`id_user`, `id_recette`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 14),
(1, 17),
(1, 20),
(1, 40),
(1, 47),
(2, 1),
(2, 5),
(2, 16),
(2, 19),
(2, 20),
(2, 47),
(3, 19),
(4, 20);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id_ingredient` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id_ingredient`, `nom`) VALUES
(1, 'Pilon de poulet'),
(2, 'Sel'),
(3, 'Magret de canard'),
(4, 'Huile d\'olive'),
(5, 'Poivre'),
(6, 'Steak de boeuf'),
(7, 'Maquereau'),
(8, 'Côtelette de porc'),
(9, 'Sardine'),
(10, 'Côtelette d\'agneau'),
(11, 'Travers de porc'),
(12, 'Oignon'),
(13, 'Aubergines'),
(14, 'Escargots'),
(15, 'Piment'),
(16, 'Poulet'),
(17, 'Maïs'),
(18, 'Beurre'),
(19, 'Sirop d\'érable'),
(20, 'Tranche de lard'),
(21, 'Banane'),
(22, 'Miel'),
(23, 'Chapelure'),
(24, 'Ail'),
(25, 'Moutarde'),
(26, 'Romarin'),
(27, 'Poivron rouge'),
(28, 'Oignon rouge'),
(29, 'Filet de saumon'),
(33, 'Courge'),
(34, 'Canne a sucre'),
(35, 'Dinde'),
(36, 'Riz noir'),
(37, 'Poivron rouge'),
(38, 'Poivre'),
(39, 'Thym'),
(40, 'Crevette'),
(41, 'Sucre');

-- --------------------------------------------------------

--
-- Table structure for table `recettes`
--

CREATE TABLE `recettes` (
  `id_recette` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `burns` int(11) DEFAULT '0',
  `nb_convives` int(11) DEFAULT NULL,
  `desc_courte` varchar(50) DEFAULT NULL,
  `desc_longue` varchar(250) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='La table des recettes';

--
-- Dumping data for table `recettes`
--

INSERT INTO `recettes` (`id_recette`, `id_auteur`, `titre`, `burns`, `nb_convives`, `desc_courte`, `desc_longue`, `img`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Pilons de poulets grillés', 15, 4, 'Ce sont des pilons de poulets grillés', 'Ce sont de très très bons pilons de poulet grillés', 'brochette.jpg', 2, '2018-10-11 08:04:54', '2018-10-31 20:44:53'),
(3, 1, 'Maquereau grillé', 3, 4, 'Ceci est un maquereau grillé', 'Ceci est un maquereau grillé vraiment très bon ', 'maquereau.jpg', 2, '2018-10-11 08:05:05', '2018-10-26 09:49:03'),
(4, 2, 'Côtelette de porc grillé', 0, 5, 'Ceci est une côtelette de porc', 'Ceci est une très bonne côtelette de proc', 'cotelette.jpg', 2, '2018-10-11 08:05:24', '2018-10-26 09:43:24'),
(5, 4, 'Sardines grillés', 4, 4, 'Ce sont des sardines grillées', 'Ce sont des sardines grillées vraiment très bonne', 'sardine.jpg', 2, '2018-10-11 08:05:31', '2018-10-26 09:57:09'),
(6, 3, 'Côtelette d\'agneau grillé', 9, 5, 'Trop bon les côtelette d\'agneau', 'Ce sont des côtelettes d\'agneau vraiment très bonne', 'agneau.jpg', 2, '2018-10-11 08:05:43', '2018-10-31 20:25:00'),
(7, 3, 'Escargots grillés', 4, 3, 'Des escargots grillés', 'Ce sont de beau escargots grillés', 'escargot.jpg', 2, '2018-10-11 08:05:56', '2018-10-26 09:56:17'),
(8, 3, 'Travers de porc grillé', 1, 6, 'C\'est un travers de porc', 'C\'est un joli travers de porc', 'porc.jpg', 2, '2018-10-11 08:06:00', '2018-10-31 21:20:31'),
(9, 2, 'Poulet grillé épicé', 1, 5, 'Bon poulet grillé épicé', 'C\'est un vraiment très bon poulet épicé', 'pouletEpice.jpg', 2, '2018-10-11 08:06:41', '2018-10-31 20:48:17'),
(10, 4, 'Aubergines grillés', 1, 3, 'Ce sont des aubergines grillés', 'Ce sont de bonnes aubergines grillés au barbecue', 'aubergine.jpg', 2, '2018-10-11 08:06:48', '2018-10-31 21:20:38'),
(12, 4, 'Magret de canard', 1, 5, 'Bon magret de canard', 'C\'est un vraiment très bon magret de canard', 'canard.jpeg', 2, '2018-10-11 08:07:00', '2018-10-31 21:20:44'),
(13, 1, 'Bananes au lard', 0, 4, 'Ce sont des bananes au lard', 'Ce sont d\'excellentes bananes au lard', 'banane.jpg', 2, '2018-10-16 18:52:01', '2018-10-31 21:17:33'),
(14, 2, 'Filet de saumon au barbecue', 3, 4, 'C\'est un filet de saumon au barbecue', 'C\'est un excellent filet de saumon au barbecue.', 'saumon.jpg', 2, '2018-10-16 18:52:12', '2018-10-26 09:48:14'),
(15, 2, 'truites grillés au barbecue', 1, 4, 'Ce sont des truites grillées au barbecue', 'Ce sont de très bonnes truites grillées au barbecue', 'truite.jpg', 2, '2018-10-16 18:52:20', '2018-10-31 21:20:52'),
(16, 4, 'Brochette de poulet au romarin', 9, 4, 'Ce sont des brochettes de poulet au romarin', 'Ce sont de très bonnes brochettes de poulet au romarin', 'pouletRom.jpg', 2, '2018-10-16 18:52:29', '2018-10-31 20:25:18'),
(17, 3, 'Saumon au sirop d\'érable', 15, 4, 'C\'est du saumon grillé au sirop d\'érable', 'C\'est un excellent saumon grillé accompagné d\'un bon sirop d\'érable', 'saumonErable.jpg', 2, '2018-10-16 18:53:11', '2018-10-31 20:45:15'),
(18, 3, 'Ribs de porc grillés ', 1, 5, 'Ribs de porc grillés au barbecue', 'Ce sont de très bon ribs de porc grillés au barbecue.', 'RibsPorc.jpg', 2, '2018-10-16 18:53:24', '2018-10-31 21:21:05'),
(20, 4, 'Burger d\'agneau au bbq', 1, 4, 'C\'est un burger d\'agneau au barbecue', 'C\'est un très bon burger d\'agneau au barbecue', 'burger.jpg', 0, '2018-10-16 18:53:52', '2018-10-24 12:40:58'),
(40, 5, 'Riz noir à la courge rotie', 4, 4, 'c\'est un riz noir à la courge rotie', 'c\'est un excellent riz noir à la courge rotie', '3-1540387205.jpg', 2, '2018-10-24 13:20:05', '2018-10-28 16:42:24'),
(42, 12, 'Tarte à la citrouille', 10, 4, 'c\'est une tarte à la courge', 'c\'est une excellente tarte à la citrouille', '3-1540388375.jpg', 2, '2018-10-24 13:39:35', '2018-10-28 17:30:19'),
(45, 9, 'Escalopes de dinde au boursin', 10, 4, 'Escalopes de dinde au boursin', 'Ce sont de très bonnes ecalopes de dinde au boursin\r\n', '3-1540389875.jpg', 2, '2018-10-24 14:04:35', '2018-10-30 10:08:27'),
(55, 10, 'Gratin de pâtes et de courge Butternut', 1, 3, 'Ceci est un gratin de pâtes et de courge Butternut', 'Ceci est un excellent  gratin de pâtes et de courge Butternut', '3-1541020334.jpg', 2, '2018-10-31 21:12:14', '2018-10-31 21:21:16'),
(56, 15, 'Courge musquée farcie aux petits légumes ', 1, 3, 'ceci est une courge musquée farcie aux petits légu', 'ceci est une très bonne courge musquée farcie aux petits légumes ', '3-1541020580.jpg', 2, '2018-10-31 21:16:20', '2018-10-31 21:20:00'),
(57, 2, 'Tarte végétarienne aux légumes', 0, 5, 'Ceci est une tarte végétarienne aux légumes', 'Ceci est une très bonne tarte végétarienne aux légumes', '3-1541021358.jpg', 1, '2018-10-31 21:29:18', '2018-10-31 21:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `recettes_burns`
--

CREATE TABLE `recettes_burns` (
  `id_user` int(11) NOT NULL,
  `id_recette` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recettes_burns`
--

INSERT INTO `recettes_burns` (`id_user`, `id_recette`) VALUES
(5, 1),
(6, 1),
(14, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(29, 2),
(5, 3),
(6, 3),
(14, 3),
(1, 5),
(6, 5),
(14, 5),
(15, 5),
(1, 6),
(3, 6),
(4, 6),
(5, 6),
(6, 6),
(8, 6),
(13, 6),
(14, 6),
(15, 6),
(5, 7),
(6, 7),
(13, 7),
(14, 7),
(3, 8),
(5, 9),
(3, 10),
(3, 12),
(5, 14),
(6, 14),
(14, 14),
(3, 15),
(1, 16),
(2, 16),
(3, 16),
(5, 16),
(6, 16),
(8, 16),
(13, 16),
(14, 16),
(15, 16),
(1, 17),
(2, 17),
(3, 17),
(4, 17),
(5, 17),
(6, 17),
(7, 17),
(8, 17),
(9, 17),
(10, 17),
(12, 17),
(13, 17),
(14, 17),
(15, 17),
(29, 17),
(3, 18),
(1, 20),
(1, 40),
(5, 40),
(6, 40),
(14, 40),
(5, 41),
(6, 41),
(13, 41),
(14, 41),
(1, 42),
(2, 42),
(3, 42),
(4, 42),
(5, 42),
(6, 42),
(7, 42),
(13, 42),
(14, 42),
(15, 42),
(5, 43),
(6, 43),
(7, 43),
(14, 43),
(2, 45),
(5, 45),
(6, 45),
(7, 45),
(8, 45),
(9, 45),
(10, 45),
(12, 45),
(13, 45),
(14, 45),
(1, 47),
(3, 55),
(3, 56);

-- --------------------------------------------------------

--
-- Table structure for table `recettes_etapes`
--

CREATE TABLE `recettes_etapes` (
  `id_recette` int(11) NOT NULL,
  `nb_etape` int(11) NOT NULL,
  `etape` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recettes_etapes`
--

INSERT INTO `recettes_etapes` (`id_recette`, `nb_etape`, `etape`) VALUES
(1, 1, 'Préchauffer le barbecue. '),
(1, 2, 'Poser les pilons sur la grille du barbecue bien chaud.'),
(1, 3, 'Griller jusqu’à obtenir une couleur bien dorée en retournant toutes les 6-7 minutes d\'un quart de tour.'),
(2, 1, 'Coupez la viande en gros cubes et déposez-la dans un plat creux et salez.\r'),
(2, 2, 'Répartissez la viande sur des piques à brochettes et faites-les dorer au barbecue environ 1 min par face, selon la cuisson désirée.'),
(3, 1, 'Vider les maquereaux et les faire griller au barbecue(environ 10-15 minutes).'),
(4, 1, 'Cuire les côtes de porc au barbecue 15 bonnes minutes.'),
(5, 1, 'Ecaillez les sardines, lavez-les et videz-les en gardant les têtes et en retirant l\'arête principale.'),
(5, 2, 'Faites griller les sardines 1 min par côté au barbecue.'),
(6, 1, 'Mettez les côtelettes sur le barbecue, salez préalablement,pendant environ 10 min.'),
(7, 1, 'Placez les escargots, la coquille en l\'air sur le barbecue.'),
(7, 2, 'Servez dès qu’ils commencent à bouillir à l’intérieur des coquilles.\r\n'),
(8, 1, 'Émincez les oignons.\r'),
(8, 2, 'Mettre le travers de porc à cuire au barbecue pendant environ 10min(changer de côté au bout de 5min).\r'),
(8, 3, 'Servir avec les oignons.\r'),
(9, 1, 'Badigeonnez le poulet d\'huile d\'olive, salez et ajoutez du piment.'),
(9, 2, 'Faire grillé au barbecue pendant environ 15 minutes (jusqu\'à que les 2 côtés du poulet soient dorés)'),
(9, 3, 'Ajoutez un peu de miel pour adoucir le tout et servez chaud!'),
(10, 1, 'Laver les aubergines et les tailler en tranches de 1 cm environ.\r'),
(10, 2, 'Faire grillé les aubergines au grill pendant environ 5 minutes de chaque côté.\r'),
(10, 3, 'Pendant ce temps, préparer l\'ail et les oignons, et les rajoutez aux aubergines une fois ces-dernières cuites.\r'),
(11, 1, 'Ôtez les feuilles des épis de maïs.'),
(11, 2, 'Déposez les épis sur les grilles du barbecue et les retourner de temps en temps pour qu\'ils soient dorés de tous les côtés.'),
(12, 1, 'Faire mariner le magret de canard dans de l\'huile de l\'olive et des épices désirées.\r'),
(12, 2, 'Ceci-fait, faites grillé le magret de canard jusqu\'à qu\'il soit doré (comme julien) et servir chaud.\r'),
(13, 1, 'Moutarder très légèrement la courbe intérieure de la banane et enrober la banane de 3/4 tranches de lard.\r'),
(13, 2, 'Déposer sur la grille du barbecue jusqu\'à ce que le lard soit grillé (compter 7 mn environ).\r'),
(14, 1, 'Déposer les filets côté peau sur une braise très chaude.'),
(14, 2, 'Disposer sur les assiettes. Faire un tour de moulin à poivre et de sel. Puis servir chaud.'),
(15, 1, 'Après avoir bien nettoyé les truites, leur emplir le ventre avec le beurre.\r'),
(15, 2, 'Recouvrir chacune des faces des truites avec les tranches de lard et les maintenir avec une ficelle de cuisine \r'),
(15, 3, 'Les faire cuire 6 minutes par côté au barbecue et servir chaud.\r'),
(16, 1, 'Couper les poivrons rouges en gros dés. Tailler 1 oignon rouge en quartiers.'),
(16, 2, 'Taillez le poulet en carré.'),
(16, 3, 'Effeuiller les branches de romarin en conservant les tiges avec quelques feuilles au bout afin de les utiliser comme pics à brochettes.'),
(16, 4, 'Déposez les brochettes sur le grill pendant environ 5 minutes de chaque côtés.'),
(17, 1, 'Faites chauffer votre barbecue et déposez-y les pavés de saumon \"avec la peau en bas\" car celle-ci permet à la chair de se maintenir pendant la cuisson.'),
(17, 2, 'Au bout de 5 min, retournez les pavés, et enduisez-lez de sirop avec le dos d\'une cuillère.'),
(17, 3, 'Salez à votre convenance et servez chaud! '),
(18, 1, 'Pelez et hachez la gousse d\'ail, et faites cuire la viande de chaque côté au barbecue durant 25 min. \r'),
(18, 2, 'Ajoutez l\'ail à la viande et servez chaud!\r'),
(19, 1, 'Faire tiédir le miel dans une casserole.'),
(19, 2, 'Hors du feu, ajoutez l’huile et les épices, et enduire la viande de ce mélange à l\'aide d\'un pinceau.'),
(19, 3, 'Faire cuire la viande pendant environ 10 minutes de chaque côtés (selon la puissance de votre barbecue). Une fois cuites, ajoutez un peu de marinade restante dans le plat et servez chaud ! '),
(20, 1, 'Préchauffer le barbecue à feu moyen-vif et huiler légèrement la grille.'),
(20, 2, 'Cuire jusqu’à ce que la viande soit encore un peu rosée, ou non, en son centre. Cela devrait prendre 4 minutes de chaque côté pour une cuisson « médium-saignant ». Griller ou non les pains et servir chaud! '),
(21, 1, 'ouiouiouioui'),
(21, 2, 'nnonon'),
(21, 3, 'onnqfiohzd'),
(22, 1, 'ouiouiouiouiv'),
(22, 2, 'ouiouiouiouiouiouiouioui'),
(22, 3, 'ouioui'),
(22, 4, 'ouiouiqehvdu'),
(23, 1, 'esfesfesfef\r'),
(23, 2, 'esfeesfsefesf'),
(24, 1, 'qzdqzdqzd\r'),
(24, 2, 'qzdqzdqzd\r'),
(24, 3, 'qzdqzdqzdqzd\r'),
(24, 4, 'dqz'),
(25, 1, 'qzdqzdqzdqzd'),
(28, 1, 'iuouoiiuooui\r'),
(28, 2, 'uifesiouuio\r'),
(28, 3, 'uifsiousfeoiu\r'),
(29, 1, 'iuouoiiuooui\r'),
(29, 2, 'uifesiouuio\r'),
(29, 3, 'uifsiousfeoiu\r'),
(30, 1, 'iuouoiiuooui\r'),
(30, 2, 'uifesiouuio\r'),
(30, 3, 'uifsiousfeoiu\r'),
(34, 1, 'iuouoiiuooui\r'),
(34, 2, 'uifesiouuio\r'),
(34, 3, 'uifsiousfeoiu\r'),
(35, 1, 'qzdqzdqzdqzd'),
(36, 1, 'qzdqzdqzd'),
(36, 2, 'qzdqzd'),
(36, 3, 'qzdqzd'),
(36, 4, 'qzd'),
(36, 5, 'qzd'),
(36, 6, 'qzdqzdqzd'),
(37, 1, 'uyguyguyg'),
(38, 1, 'uyguyguyg'),
(39, 1, 'hiqdqzqd\r'),
(39, 2, 'qzddqq\r'),
(39, 3, 'qdzqzddqz\r'),
(39, 4, 'qzdqdzdq'),
(40, 1, 'Plongez le riz dans l\'eau pendant 10 minutes.\r'),
(40, 2, 'Découpez puis mélangez la courge au riz.\r'),
(40, 3, 'Servir chaud !\r'),
(41, 1, 'Éplucher la citrouille, puis la couper en morceaux de 1 cm d\'épaisseur environ.\r'),
(41, 2, 'Dans un saladier, casser les œufs, rajouter le sucre, le sucre vanillé, la cannelle, la fleur d\'oranger, bien mélanger et ajouter la purée de citrouille. Mélanger à nouveau.\r'),
(41, 3, 'Beurrez et fariner un moule de 30 cm de diamètre sur 8 cm de haut environ.'),
(42, 1, 'Déroulez la pâte sablée (ou étalez-la sur un plan de travail fariné) et découpez des ronds de pâte légèrement plus grands que vos moules à tartelettes. Foncez les moules à tartelettes.\r'),
(42, 2, 'Versez cette préparation dans une casserole. Chauffez pour porter le mélange à ébullition et laissez cuire 2 min à petit frémissement.\r'),
(42, 3, 'Pendant ce temps, faites fondre le chocolat noir au bain-marie. Versez-le dans un cône de papier sulfurisé ou dans un sac congélation dont vous aurez coupé la pointe et dessinez des toiles d’araignée sur une feuille de papier sulfurisé. Placez-les au réfrigérateur au moins 1h.'),
(43, 1, 'Farcir une volaille sous la peau permet de la parfumer et de nourrir sa chair (et notamment les blancs) durant la cuisson : beurre parfumé, lamelles de truffes ou hachis de champignons... la dinde de Noël n\'en sera donc que meilleure\r'),
(43, 2, 'Une foie cuite, découpez-la facilement grâce à notre technique culinaire en vidéo spéciale découpe des volailles.\r'),
(44, 1, 'Pelez et hachez l\'oignon et l\'ail. \r'),
(44, 2, 'Coupez les poivrons et éliminez leurs cœurs, leurs petites graines et toutes les parties blanches. \r'),
(44, 3, 'Coupez-les ensuite en fines lanières et réservez.\r'),
(44, 4, 'Coupez les blancs de dinde en lanières également, de la taille et de l\'épaisseur d\'un index. \r'),
(44, 5, 'Éliminez les graines du petit piment rouge et hachez-le finement.\r'),
(44, 6, 'Faites chauffer le beurre dans une grande sauteuse sur feu vif.\r'),
(44, 7, 'Faites-y dorer l\'oignon et l\'ail, puis ajoutez les morceaux de dinde et laissez-les colorer quelques instants en mélangeant. \r'),
(44, 8, 'Ajoutez les lanières de poivron et le piment. \r'),
(44, 9, 'Faites sauter le tout quelques instants, puis versez le lait de coco, la sauce soja et le paprika, et baissez le feu. \r'),
(44, 10, 'Couvrez et laissez mijoter 10 min à petits bouillons, avant de servir, par exemple avec un riz rouge.'),
(45, 1, 'Coupez vos escalopes en dés de 2 cm environ.\r'),
(45, 2, 'Dans une cocotte, versez les tomates pelées, les dés d\'escalopes, les petites pommes de terre (cuites au préalable), le pot de crème fraîche, le thym, poivre, sel, et l\'ail pressé.\r'),
(45, 3, 'Laissez mijoter environ 30 min.\r'),
(45, 4, '5 min avant la fin, rajoutez le boursin entier, puis saupoudrez d\'un peu de farine afin d\'épaissir la sauce.\r'),
(45, 5, 'Servir chaud.\r'),
(46, 1, 'Chauffer l\'huile de la friteuse à 350f. \r'),
(46, 2, 'Apporter à bouillir le lait, le sucre, le beurre, et le sel. \r'),
(46, 3, 'Ajouter la farine d\'un seul coup et brasser jusqu\'à ce qu\'une boule se forme. \r'),
(46, 4, 'Retirer du feu et ajouter les oeufs 1 à la fois en brassant énergiquement entre chaque addition. \r'),
(46, 5, 'La pâte doit se détacher des parroies du chaudron. \r'),
(46, 6, 'Déposer la pâte dans une poche à pâtisseries et laisser tomber des petits bouts d\'environ 3 pouces de long. \r'),
(46, 7, 'Cuire 2 minutes de chaque côtés, jusqu\'à l\'obtention d\'un beau doré.\r'),
(46, 8, 'Déposer les churros sur des essuis-tout pour égoutter l\'huile et ensuite rouler dans le sucre de canne doré. \r'),
(46, 9, 'Vous pouvez les servir nature ou encore dans une préparation de votre choix. (crème glacé - coulis -sirop - sucre glace) à vous de choisir, ils sont aussi bon avec n\'importe quelle garniture.\r'),
(47, 1, 'Laver plusieurs fois l’équivalent de 3 cuillères à soupe de riz gluant et le faire tremper dans beaucoup d’eau. \r'),
(47, 2, 'Laisser reposer au minimum 4h. Puis rincer.\r'),
(47, 3, 'Dans une toute petite casserole, mettre le riz gluant dans 4 à 5 fois son volume en eau. \r'),
(47, 4, 'Faire bouillir, puis cuire à petits bouillons pendant environ 20 minutes en remuant de temps en temps pour que cela n’attache pas au fond de la casserole, jusqu’à obtenir une sorte de potage de riz. \r'),
(47, 5, 'Laisser tiédir, réserver. (Il en restera après utilisation, mais c’est difficile d’en cuire moins pour avoir la bonne texture). Filtrer au chinois.\r'),
(47, 6, 'Mixer les cacahuètes et réserver un peu de cacahuètes pilées pour mettre sur la sauce. \r'),
(47, 7, 'Dans un grand bol, mélanger la sauce hoisin, le potage de riz gluant, l’eau chaude, les cacahuètes mixées, l’eau chaude, le vinaigre de riz et le piment ciselé (ou sans piment selon goût). \r'),
(47, 8, 'La sauce doit avoir une consistance épaisse. Goûter, rectifier si nécessaire avec un peu de hoisin ou de potage de riz ou d’eau. \r'),
(47, 9, 'Conserver bien couvert au réfrigérateur. \r'),
(47, 10, 'Réserver quelques cacahuètes pilées pour le lendemain, à parsemer sur la sauce.Décortiquer et déveiner les crevettes en incisant légèrement le long du dos des crevettes. \r'),
(47, 11, 'À l’aide de la pointe du couteau, enlever le fil noir. (opération longue - environ 40 minutes pour obtenir 600 g de crevettes décortiquées).\r'),
(47, 12, 'Peler les gousses d’ail, laver et hacher les oignons verts. Sortir 3 bâtons de cannes à sucre de leur boîte et égoutter. Réserver.\r'),
(47, 13, 'Traditionnellement, on pile les crevettes crues au mortier pour conserver leur élasticité. La préparation étant déjà très longue, il m’arrive d’utiliser aussi le robot mixeur. \r'),
(47, 14, 'Hacher finement les crevettes et le gras de porc coupé en petits dés, avec l’ail, les oignons verts (partie blanche), la sauce de poisson en saumure nuoc mam pur, le sel, le poivre blanc, le blanc d’œuf (facultatif) et la farine Maïzena. Une fois haché, ajouter en dernier l’huile. Mixer rapidement. Sortir la pâte et la réserver dans un récipient. Mettre au frais 30 minutes. \r'),
(47, 15, 'Ne soyez pas surpris par la couleur bleu gris de la pâte, c’est la couleur des crevettes crues Black Tiger qui rosissent naturellement à la cuisson.\r'),
(47, 16, 'Pendant le temps de repos, faire bouillir l’eau de la marmite à vapeur. Couper et partager chaque bâton de canne à sucre en 4 dans le sens de la longueur. Ce qui vous donnera 12 bâtons fins de 1,5 cm d’épaisseur environ, et de 12 à 15 cm de long.\r'),
(47, 17, 'Laver la salade, les herbes aromatiques, trancher le concombre en lamelles ou en bâtonnets. Essorer et dresser sur le plat de service.\r'),
(47, 18, 'Faire cuire les vermicelles fins de riz pour bún (le même calibre que pour les bò bún, bœuf sauté aux vermicelles de riz) selon les indications du paquet. \r'),
(47, 19, 'Rincer à l’eau froide pour éviter que les vermicelles collent. Bien égoutter et dresser sur le plat de service avec la salade, les herbes et les tranches de concombre.\r'),
(47, 20, 'Sortir la pâte de crevettes. \r'),
(47, 21, 'Préparer un peu d’huile dans un bol. À d’une cuillère à soupe, prélever une grosse cuillère bombée de pâte et la déposer dans la main préalablement huilée. Former une boule, puis l’aplatir pour former un disque épais. \r'),
(47, 22, 'Déposer le bâton de canne à sucre au centre de la pâte. Refermer le disque de pâte sur lui-même autour du bâton de canne à sucre. Reformer joliment la brochette, puis passer à la suivante, jusqu’au bout.\r'),
(47, 23, 'L’eau de la marmite à vapeur bout. Huiler les étages de cuisson de la marmite, déposer les brochettes de crevettes à la canne à sucre en espaçant un peu entre chaque brochette (la pâte gonflera un peu). Au bout de 10 minutes, sortir les brochettes. À ce stade, vous pouvez soit conserver les brochettes au frais avant de les passer au grill avant de manger, OU les passer immédiatement au grill pour servir aussitôt. Les brochettes cuites à la vapeur se conservent environ 2 jours au réfrigérateur.\r'),
(47, 24, 'Sans plaquettes en plastique (dans les magasins chinois) pour séparer les galettes de riz il est quasi impossible de pré-tremper les galettes de riz sans que cela colle entre elles. Il faut donc mettre à disposition un grand récipient d’eau chaude à table pour tremper directement les galettes de riz avant de faire les rouleaux.\r'),
(47, 25, 'Préchauffer le four sur grill. Sur une plaque de cuisson, graisser la plaque puis déposer les brochettes de crevettes. À l’aide d’un pinceau, huiler la surface de la pâte de crevettes avant d’enfourner à mi-hauteur et de faire dorer environ 3 minutes de chaque côté suivant la puissance de votre four. À surveiller la cuisson, les sortir quand les brochettes de crevettes sont dorés. Les présenter sur le plat avec les herbes et salade. Servir aussitôt.'),
(48, 1, 'Dans le robot culinaire, mettre les crevettes, le gras de porc, l’ail, l’oignon vert et le sucre. \r'),
(48, 2, 'Mixer jusqu’à l’obtention d’une purée grossière. Mixer ensuite par petits coups, puis ajouter la sauce de poisson, l’huile d’arachide, la sauce piquante, le sel et le poivre.\r'),
(48, 3, 'Cuire une petite portion de mousse de crevettes dans une poêle antiadhésive jusqu’à ce que le tout soit bien cuit. \r'),
(48, 4, 'Goûter et rectifier l’assaisonnement si besoin (la préparation doit être relevée).\r'),
(48, 5, 'Verser la mousse dans un grand bol, couvrir et laisser au réfrigérateur environ 2 h, jusqu’à ce qu’elle soit bien froide.\r'),
(48, 6, 'À l’aide d’un couteau bien aiguisé, peler la canne à sucre et couper chaque morceau en quatre sur la longueur. Huiler légèrement les doigts d’une main.\r'),
(48, 7, 'Prendre 45 ml (3 c. à soupe) de mousse de crevettes et la façonner autour de l’extrémité de chaque morceau de canne à sucre. \r'),
(48, 8, 'Répéter l’opération avec chacun des morceaux de canne à sucre. Disposer les brochettes dans une assiette légèrement huilée, couvrir de pellicule plastique et réfrigérer jusqu’au moment de la cuisson.\r'),
(48, 9, 'Préparer le gril pour cuisson directe et préchauffer à température élevée. Quand il est prêt, brosser et huiler la grille. Disposer les brochettes sur la grille chaude, laisser griller de 2 à 3 min par côté.\r'),
(48, 10, 'Lorsque la mousse est légèrement grillée, ferme et cuite en profondeur, servir les brochettes aussitôt et grignoter la mousse directement sur la canne à sucre. Bien mâcher celle-ci pour extraire le jus sucré.'),
(49, 1, 'oiuoiuoiuoiuoiuoiuoiu\r'),
(49, 2, 'dzq'),
(50, 1, 'qdzzdqqzdzdqzdqzdq'),
(50, 2, 'qz'),
(50, 3, 'zdzd'),
(50, 4, 'zdqz'),
(50, 5, 'd'),
(50, 6, 'zd'),
(50, 7, 'zzdzdqdzqdzq'),
(50, 8, 'd'),
(51, 1, 'dqzdqzdqzdqzdqzd'),
(52, 1, 'qzdqzdqzdqzdqdz'),
(53, 1, 'Dans une casserole d’eau bouillante salée, cuire les cubes de courge jusqu’à ce qu’ils soient très tendres. Égoutter et réduire en purée. \r'),
(53, 2, 'Préchauffer le four à 205 °C (400 °F). \r'),
(53, 3, 'Beurrer un moule en pyrex.\r'),
(53, 4, 'Dans une poêle, chauffer l’huile à feu doux. Cuire l’oignon 5 minutes, jusqu’à ce qu’il soit très tendre et légèrement coloré. Ajouter le romarin et réserver. \r'),
(53, 5, 'Dans une casserole d’eau bouillante salée, cuire les pâtes al dente. Égoutter en réservant 250 ml (1 tasse) d’eau de cuisson. Remettre les pâtes dans la casserole. \r'),
(53, 6, 'Dans un bol, mélanger la purée de courge et les oignons avec l’eau des pâtes réservée. Saler et poivrer. Transvider ce mélange dans la casserole contenant les pâtes. Incorporer la moitié des fromages râpés. Déposer dans le moule. \r'),
(53, 7, 'Dans un petit bol, mélanger le reste des fromages avec la chapelure, puis en parsemer les pâtes. \r'),
(53, 8, 'Cuire 15 minutes, jusqu’à ce que le dessus soit bien doré. \r'),
(53, 9, 'Ingrédients : courge, huile, oignon, pâtes, sel, chapelure, fromage rapé\r'),
(54, 1, 'Dans une casserole d’eau bouillante salée, cuire les cubes de courge jusqu’à ce qu’ils soient très tendres. Égoutter et réduire en purée. \r'),
(54, 2, 'Préchauffer le four à 205 °C (400 °F). \r'),
(54, 3, 'Beurrer un moule en pyrex.\r'),
(54, 4, 'Dans une poêle, chauffer l’huile à feu doux. Cuire l’oignon 5 minutes, jusqu’à ce qu’il soit très tendre et légèrement coloré. Ajouter le romarin et réserver. \r'),
(54, 5, 'Dans une casserole d’eau bouillante salée, cuire les pâtes al dente. Égoutter en réservant 250 ml (1 tasse) d’eau de cuisson. Remettre les pâtes dans la casserole. \r'),
(54, 6, 'Dans un bol, mélanger la purée de courge et les oignons avec l’eau des pâtes réservée. Saler et poivrer. Transvider ce mélange dans la casserole contenant les pâtes. Incorporer la moitié des fromages râpés. Déposer dans le moule. \r'),
(54, 7, 'Dans un petit bol, mélanger le reste des fromages avec la chapelure, puis en parsemer les pâtes. \r'),
(54, 8, 'Cuire 15 minutes, jusqu’à ce que le dessus soit bien doré. \r'),
(54, 9, 'Ingrédients : courge, huile, oignon, pâtes, sel, chapelure, fromage rapé'),
(55, 1, 'Dans une casserole d’eau bouillante salée, cuire les cubes de courge jusqu’à ce qu’ils soient très tendres. Égoutter et réduire en purée. \r'),
(55, 2, 'Préchauffer le four à 205 °C (400 °F). \r'),
(55, 3, 'Beurrer un moule en pyrex. \r'),
(55, 4, 'Dans une poêle, chauffer l’huile à feu doux. Cuire l’oignon 5 minutes, jusqu’à ce qu’il soit très tendre et légèrement coloré. Ajouter le romarin et réserver. \r'),
(55, 5, 'Dans une casserole d’eau bouillante salée, cuire les pâtes al dente. Égoutter en réservant 250 ml (1 tasse) d’eau de cuisson. Remettre les pâtes dans la casserole. \r'),
(55, 6, 'Dans un bol, mélanger la purée de courge et les oignons avec l’eau des pâtes réservée. Saler et poivrer. Transvider ce mélange dans la casserole contenant les pâtes. Incorporer la moitié des fromages râpés. Déposer dans le moule. \r'),
(55, 7, 'Dans un petit bol, mélanger le reste des fromages avec la chapelure, puis en parsemer les pâtes. \r'),
(55, 8, 'Cuire 15 minutes, jusqu’à ce que le dessus soit bien doré. \r'),
(55, 9, 'Ingrédients : pâtes, courge, sel, poivre, chapelure, oignons, fromage rapé\r'),
(56, 1, ' Préchauffez le four à 230°C. Coupez dans le sens de la longueur la courge, retirez les graines, videz-la en réservant la chaire.\r'),
(56, 2, 'Déposez dans chacune une noix de beurre. Enfournez pendant 40 minutes.\r'),
(56, 3, 'Hachez l’ail et l’oignon. Coupez la courgette et la courge en dés. Tranchez les champignons.\r'),
(56, 4, 'Dans une poêle huilée, faites revenir l’ail, l’oignon, la courge, la courgette et les champignons en remuant régulièrement.\r'),
(56, 5, 'Ajoutez la moutarde et le lait de soja. Mélangez. Salez, poivrez.\r'),
(56, 6, 'Coupez l’emmental en lamelles. Remplir les ½ courges de cette préparation. Déposez les lamelles d’emmenthal sur le dessus et parsemez de paprika.\r'),
(56, 7, 'Enfournez 10 minutes en mode gril.\r'),
(56, 8, 'Ingrédients : sel, poivre, courge, beurre, soja, fromage, ail, oignon, paprika, champignons'),
(57, 1, 'Réalisation de la pâte brisée : mettez la farine dans un grand bol avec le sel et les graines\r'),
(57, 2, 'Ajoutez l\'huile au milieu, mélangez pour bien absorber l\'huile avec la farine, puis ajoutez l\'eau en mélangeant jusqu\'à obtenir une boule. Filmez-la et mettez-la au frigo 20 minutes\r'),
(57, 3, 'Etalez la pâte, disposez-la dans un moule à tarte ou un cercle à pâtisserie huilé. Recouvrez de papier cuisson et remplissez avec des billes d\'argile ou des gros haricots secs. On fait cuire la pâte \"à blanc\", c\'est à dire sans garniture, 15 min à 180°C puis encore 15 min sans les billes. Elle sera bien croustillante !\r'),
(57, 4, 'Réalisation de la tarte: émincez les légumes (blettes, champignons, oignon) et faites-les revenir dans de l\'huile d\'olive pendant 10 minutes\r'),
(57, 5, 'Dans un bol, mélangez les oeufs, la crème de soja, les herbes de Provence et le piment, le sel et le poivre et la moutarde\r'),
(57, 6, 'Remplissez le fond de tarte pré-cuit avec les légumes, versez le mélange d\'oeufs dessus, puis parsemez de fromage râpé\r'),
(57, 7, 'Enfournez pour 40-45 minutes à 180°C.\r'),
(57, 8, 'Ingrédients : farine, sel, blettes, champignons, soja, oignon, œufs, fromage'),
(58, 1, 'eazeazeaze\r'),
(58, 2, 'azeazeaz\r'),
(58, 3, 'eazezae\r'),
(58, 4, 'azeazezae');

-- --------------------------------------------------------

--
-- Table structure for table `recettes_ingredients`
--

CREATE TABLE `recettes_ingredients` (
  `id_ingredient` int(11) NOT NULL,
  `id_recette` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recettes_ingredients`
--

INSERT INTO `recettes_ingredients` (`id_ingredient`, `id_recette`) VALUES
(1, 1),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 12),
(2, 14),
(2, 44),
(2, 45),
(2, 46),
(2, 47),
(2, 52),
(3, 12),
(3, 34),
(3, 37),
(3, 38),
(4, 34),
(4, 37),
(4, 38),
(4, 47),
(5, 14),
(5, 34),
(5, 37),
(5, 38),
(5, 39),
(6, 2),
(6, 35),
(6, 36),
(6, 39),
(6, 49),
(7, 3),
(7, 35),
(7, 36),
(7, 39),
(7, 49),
(7, 50),
(7, 58),
(8, 4),
(8, 36),
(8, 39),
(8, 49),
(8, 50),
(8, 58),
(9, 5),
(9, 39),
(9, 49),
(9, 50),
(10, 6),
(10, 39),
(10, 50),
(11, 8),
(11, 39),
(12, 2),
(12, 8),
(12, 39),
(12, 48),
(13, 10),
(13, 39),
(14, 7),
(14, 39),
(15, 9),
(15, 39),
(16, 9),
(16, 39),
(17, 11),
(17, 39),
(18, 39),
(18, 41),
(18, 42),
(18, 46),
(19, 39),
(20, 13),
(20, 39),
(21, 13),
(24, 48),
(29, 14),
(33, 40),
(33, 41),
(33, 42),
(33, 55),
(33, 56),
(34, 46),
(34, 47),
(34, 48),
(35, 43),
(35, 44),
(35, 45),
(36, 40),
(37, 44),
(40, 47),
(40, 48),
(41, 48);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id_theme` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `page` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id_theme`, `nom`, `page`) VALUES
(1, 'Normal', 'accueil'),
(2, 'Halloween', 'halloween'),
(3, 'Noël', 'noel');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(16) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `role` int(1) DEFAULT '1',
  `actif` int(11) NOT NULL DEFAULT '1',
  `token` varchar(200) DEFAULT NULL,
  `insc` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `showNom` int(11) NOT NULL DEFAULT '0',
  `showMail` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table des membres';

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `pseudo`, `mail`, `mdp`, `prenom`, `nom`, `avatar`, `role`, `actif`, `token`, `insc`, `showNom`, `showMail`) VALUES
(1, 'Tomus', 'tomus.mic@gmail.com', '3a3468fa89b2ab7cbfe5400858a8ec0066e9e8defa9a64c993b5f24210244df8', 'Thomas', 'Miceli', '1.jpg', 3, 1, NULL, '2018-10-11 10:25:18', 1, 1),
(2, 'Andrechat', 'andyy.garcia13@gmail.com', 'bcee72e6df5d56319125920f6c69d8001e938e122cd14597e547d49cc9126e42', 'Andrea', 'Garcia', '2.jpg', 3, 1, NULL, '2018-10-21 01:17:12', 0, 1),
(3, 'Botlan', 'dylanmarch13620@gmail.com', '3a3468fa89b2ab7cbfe5400858a8ec0066e9e8defa9a64c993b5f24210244df8', 'Dylan', 'March', '3.jpg', 3, 1, NULL, '2018-10-21 01:17:12', 1, 0),
(4, 'Weazza', 'weazza@gmail.com', 'bcee72e6df5d56319125920f6c69d8001e938e122cd14597e547d49cc9126e42', 'Ugo', 'Orlando', '4.jpg', 3, 1, NULL, '2018-10-21 01:17:12', 0, 0),
(5, 'Ouais', 'ouais@ouais.fr', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797', 'Ouais', 'daccord', 'default.jpg', 1, 1, NULL, '2018-10-24 15:00:11', 1, 1),
(6, 'JbDu13', 'jbDu13@bot.fr', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797', 'Jean', 'Bernard', 'default.jpg', 1, 1, NULL, '2018-10-24 14:45:34', 0, 0),
(7, 'xXGamerXx', 'Jd@bot.fr', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797', 'Jean ', 'Dupont', 'default.jpg', 2, 1, NULL, '2018-10-24 14:46:45', 0, 0),
(8, 'yep', 'yep@yep.com', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797', 'yep', 'yep', 'default.jpg', 1, 1, NULL, '2018-10-24 14:47:13', 0, 0),
(9, 'Jean12', 'jH12@free.fr', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797', 'Jean ', 'Hector', 'default.jpg', 2, 1, NULL, '2018-10-24 14:49:02', 0, 0),
(10, 'Jx13', 'Jk13@bot.com', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797', 'Jean', 'Kevin', 'default.jpg', 1, 0, NULL, '2018-10-24 14:50:01', 0, 0),
(12, 'Gamer2', 'JeanGamer@gros.com', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797', 'Gamer', 'Bot', 'default.jpg', 1, 0, NULL, '2018-10-24 14:52:20', 0, 0),
(13, 'TheBot', 'TheBot@bot.com', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797', 'The', 'Bot', 'default.jpg', 1, 1, NULL, '2018-10-24 14:52:51', 0, 0),
(14, 'Kikoo13', 'Kk13@kikoo.com', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797', 'Jean', 'Gamer', 'default.jpg', 1, 1, NULL, '2018-10-24 14:53:30', 0, 0),
(15, 'Malaisent', 'malaise@gros.com', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797', 'Leu', 'Malaisent', 'default.jpg', 1, 1, NULL, '2018-10-24 14:54:58', 0, 0),
(29, 'TheGamer', 'Gamer@free.fr', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797', 'The', 'Gamer', 'default.jpg', 1, 1, NULL, '2018-10-31 21:34:47', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`parametre`,`value`);

--
-- Indexes for table `favoris`
--
ALTER TABLE `favoris`
  ADD UNIQUE KEY `id_user` (`id_user`,`id_recette`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id_ingredient`);

--
-- Indexes for table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`id_recette`);

--
-- Indexes for table `recettes_burns`
--
ALTER TABLE `recettes_burns`
  ADD UNIQUE KEY `id_recette` (`id_recette`,`id_user`);

--
-- Indexes for table `recettes_etapes`
--
ALTER TABLE `recettes_etapes`
  ADD UNIQUE KEY `index` (`id_recette`,`nb_etape`);

--
-- Indexes for table `recettes_ingredients`
--
ALTER TABLE `recettes_ingredients`
  ADD UNIQUE KEY `id_ingredient` (`id_ingredient`,`id_recette`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id_theme`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id_ingredient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id_recette` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id_theme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
