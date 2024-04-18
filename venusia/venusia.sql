-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 08 avr. 2024 à 14:33
-- Version du serveur : 8.0.30
-- Version de PHP : 8.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `venusia`
--
CREATE DATABASE IF NOT EXISTS `venusia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `venusia`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int NOT NULL,
  `nom_categorie` enum('Soutiens-gorges','Bas','Intima','Nuit','Maillot de bain') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`, `image`, `description`) VALUES
(1, 'Soutiens-gorges', 'https://cdn.savagex.com/media/images/products/BA2457665-8776/MOD-POPPY-UNLINED-LACE-BALCONETTE-BRA-BA2457665-8776-1-1200x1600.jpg', 'Les soutiens-gorges à armature sont des pièces essentielles de la garde-robe féminine, conçus avec précision pour offrir à la fois confort et maintien. Leur structure intègre des armatures délicatement intégrées qui épousent subtilement la courbe naturelle de la poitrine, procurant un soutien optimal tout en valorisant la silhouette.'),
(2, 'Bas', 'https://cdn.savagex.com/media/images/products/UD2147011-0687/FLORAL-LACE-THONG-UD2147011-0687-1-1200x1600.jpg', 'Plongez dans le monde du confort et de l\'élégance avec notre culotte exquise, une pièce de lingerie qui allie parfaitement fonctionnalité et glamour. Fabriquée avec des matériaux de première qualité, cette culotte offre une sensation de douceur et de légèreté au toucher, enveloppant délicatement votre corps dans un cocon de confort.'),
(3, 'Intima', 'https://cdn.savagex.com/media/images/products/LI2042833-0275/LIVING-IN-THE-CLOUDS-IRIDESCENT-LACE-CORSET-LI2042833-0275-1-1200x1600.jpg', 'Découvrez notre collection intima, une gamme exquise de lingerie conçue pour capturer l\'essence même de la féminité et de la confiance en soi. Chaque pièce de cette collection incarne l\'élégance, le confort et le raffinement, offrant à chaque femme la possibilité de se sentir belle et spéciale au quotidien.\r\n\r\nDe la dentelle délicate aux tissus luxueux, chaque détail est soigneusement sélectionné pour offrir une expérience sensorielle incomparable. Que ce soit pour une journée active ou une soirée romantique, la lingerie de la collection intima allie parfaitement style et fonctionnalité, soulignant les courbes avec grâce et délicatesse.'),
(4, 'Nuit', 'https://cdn.savagex.com/media/images/products/SQ2038118-8311/SAVAGE-X-COTTON-CROP-TOP-SQ2038118-8311-1-1200x1600.jpg', 'Plongez dans un monde de raffinement et de douceur avec notre catégorie \"Nuit\" de lingerie. Conçue pour vous envelopper dans un confort luxueux, cette collection allie élégance et sensualité pour des nuits aussi élégantes que reposantes.\r\n\r\nDes nuisettes délicatement fluides aux ensembles pyjama cosy, chaque pièce est minutieusement sélectionnée pour vous offrir une sensation de bien-être incomparable. Fabriqués à partir de tissus doux et luxueux, nos articles de nuit vous garantissent une nuit de sommeil réparateur dans un style chic et sophistiqué.'),
(5, 'Maillot de bain', 'https://www.marjolaine.fr/19950-large_default/maillot-de-bain-drap%C3%A9-une-pi%C3%A8ce-th%C3%A9a-noir.jpg', 'Découvrez notre catégorie \"Bain\" de lingerie, une collection exquise qui vous transporte dans un monde de luxe et de raffinement, même au bord de l\'eau. Chaque pièce de cette gamme incarne l\'élégance et la sophistication, offrant une fusion parfaite entre style, confort et fonctionnalité.\r\n\r\nDes maillots de bain sophistiqués aux paréos élégants, notre collection \"Bain\" est conçue pour sublimer votre silhouette tout en vous assurant un maintien parfait. Les tissus de haute qualité, associés à des coupes flatteuses et des détails élégants, garantissent une sensation de confort et de confiance, que vous vous prélassiez au bord de la piscine ou que vous profitiez d\'une journée à la plage.');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id_commande` int NOT NULL,
  `id_membre` int NOT NULL,
  `date_commande` date NOT NULL,
  `statut_commande` varchar(250) NOT NULL,
  `total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` int NOT NULL,
  `id_produit` int NOT NULL,
  `id_membre` int NOT NULL,
  `commentaire` text COLLATE utf8mb4_general_ci NOT NULL,
  `contenu_com` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `id_produit`, `id_membre`, `commentaire`, `contenu_com`) VALUES
(4, 8, 3, 'jadore', 'trop bo'),
(5, 8, 3, 'jadore', 'trop bo'),
(6, 8, 3, 'jadore', 'trop bo'),
(7, 16, 3, 'Cliente satisfaite ', 'Omg !! le produit essentiel est magnifique il me va trop bien.'),
(22, 16, 3, 'Cliente satisfaite ', 'Omg !! le produit essentiel est magnifique il me va trop bien.'),
(24, 23, 1, 'jadore', 'ppp'),
(25, 23, 1, 'jadore', 'lomp'),
(26, 23, 1, 'jadore', 'lomp'),
(27, 23, 1, 'jadore', 'lomp'),
(28, 23, 1, 'jadore', 'lomp'),
(29, 23, 1, 'jadore', 'lomp'),
(31, 15, 3, 'jadore', 'Je suis tres contente de cette article '),
(32, 16, 16, 'j&#039;adore', 'blabla'),
(33, 45, 1, 'test', '&lt;script&gt;alert(&quot;oh no&quot;)&lt;/script&gt;'),
(34, 45, 1, 'Cliente satisfaite ', 'uyftf gy uyf yfuyf jf'),
(35, 45, 1, '1231321321', ''),
(36, 45, 1, '', ''),
(37, 45, 1, '', ''),
(38, 45, 1, '', ''),
(39, 45, 1, '', ''),
(40, 24, 1, '1231321321', 'BBBBBBBBBBBB'),
(41, 24, 1, '1231321321', 'BBBBBBBBBBBB'),
(42, 24, 1, '1231321321', 'BBBBBBBBBBBB'),
(43, 24, 1, '1231321321', 'BBBBBBBBBBBB'),
(44, 24, 1, '1231321321', 'BBBBBBBBBBBB');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int DEFAULT NULL,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id_contact`, `nom`, `prenom`, `email`, `message`) VALUES
(NULL, 'nerline', 'Mélissa', 'lilidupond@gmail.com', 'Helllo honey'),
(NULL, 'Morain', 'carotttt', 'carocaro@gmail.com', 'AAAAAAaaaaled'),
(NULL, 'Morain', 'carotttt', 'carocaro@gmail.com', 'AAAAAAaaaaled'),
(NULL, 'Morain', 'carot', 'melimeli@coco.org', 'blabla');

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id_details_commande` int NOT NULL,
  `id_commande` int NOT NULL,
  `id_produit` int NOT NULL,
  `quantite` int NOT NULL,
  `total_produit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id_membre` int NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `civilite` enum('Homme','Femme') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mdp` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `statue` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id_membre`, `nom`, `prenom`, `civilite`, `email`, `mdp`, `statue`) VALUES
(1, 'nerline', 'martinet', 'Homme', 'nerlinedu82@gmail.com', '1234', '1'),
(3, 'Dupond', 'Mélissa', 'Femme', 'carocaro@gmail.com', '$2y$10$keNnHwa69LHC25Odx55qUuswcfHuaR3KUgbvPcBqaoh8kB5MFQC/y', '0'),
(4, 'Laurence', 'Samson', 'Homme', 'laurencesamson@gmail.com', '123456', '1'),
(5, 'Kermit', 'La grenouille', 'Homme', 'Kermitlagrenouille@lol.com', '$2y$10$29ZDy65ktEvrLzKLfrw97O/.DgFfe0keKpdx1VN5aKE95tW2ijidq', '0'),
(8, 'Snoop', 'Dog', 'Homme', 'Snoopdogswag@doggy.com', '$2y$10$FHWn0ifi0A72gUnekg66RO56gAp9trWhIbh1fFqmfK4Noz6XGbNc6', '1'),
(9, 'Keita', 'Lili', 'Homme', 'lilikeita@gmail.com', '$2y$10$DlPB83i2ciK1Oa4w.YKg2.at0BAiS5WTtQzhH3QUOw9uSAxVMynsm', '0'),
(11, 'Morain', 'carotttt', 'Homme', 'carotcarot@gmail.com', '$2y$10$KCllV3ZHaSwuuFXi7DO0T.7QYMRxJKxBtTK8SgIKb80OaivfqUVm2', '0'),
(14, 'Dupond', 'Lili', 'Homme', 'lilidupond@gmail.com', '$2y$10$ojwEdnTJ7Ozx1nNhuqZBw.eqmFr8UFDIH3O3.oFk8IMz/jQ47TCAG', '0'),
(15, 'Morgan', 'Terrasse', 'Homme', 'morganterrasseestsurfb@gmail.com', '$2y$10$4K4aABWDcqYs9/557WmO9ecqTrJ8lwdhC1nXkx4j8SrWXrDcj4ftO', '1'),
(16, 'Morain', 'carot', 'Femme', 'melimeli@coco.org', '$2y$10$tHKK66nn8dx5rlaec2WoIOxDMP2XnW.Qc.mC9P7qyBFkFLhpjdSje', '0'),
(18, 'nerline', 'carotttt', 'Homme', 'carocarot@gmail.com', '$2y$10$gc9H7BeazcgCzc8zj8Zl.OXtPntoIokqJ.jWWCuv4wju1IjJy5J36', '0');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id_newsletter` int DEFAULT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `newsletter`
--

INSERT INTO `newsletter` (`id_newsletter`, `email`) VALUES
(NULL, 'nerlinedu82@gmail.com'),
(NULL, 'carocaro@gmail.com'),
(NULL, 'lilidupond@gmail.com'),
(NULL, 'zoeboussard@outlook.com'),
(NULL, 'melimeli@coco.org');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_panier` int NOT NULL,
  `id_membre` int NOT NULL,
  `id_produit` int NOT NULL,
  `quantite` int NOT NULL,
  `prix` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_produit` int NOT NULL,
  `nom_produit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `image1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image2` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ref_produit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `couleur` enum('Blanc','Noir','Nude','Bordeaux','Rose Vif','Bleu','Rouge','Menthe','Rose','Myrtille','Lilas','Jaune Citron','Aqua','Pêche','Rouge Foncé','Olive','Brune','Prune','Mauve','Champagne','Café','Vert Sapin','Rose poudré','Beige','Corail') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `taille` enum('XS','S','M','L','XL','XXL','3XL','80','85','90','95','100','105','110','115','120','125','130') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `taille_bonnet` enum('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O') COLLATE utf8mb4_general_ci NOT NULL,
  `stock` int NOT NULL,
  `prix` int NOT NULL,
  `id_categorie` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom_produit`, `description`, `image1`, `image2`, `ref_produit`, `couleur`, `taille`, `taille_bonnet`, `stock`, `prix`, `id_categorie`) VALUES
(6, 'Culotte', '100% Polyamide\r\nLaver à la main à froid, ne pas tordre, ne pas sécher en machine, sécher sur la corde.\r\nImporté', 'https://cdn.savagex.com/media/images/products/UD2145732-3176/PUFF-DAISY-STRING-BIKINI-UD2145732-3176-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/UD2145730-3176/PUFF-DAISY-STRING-BIKINI-UD2145730-3176-LAYDOWN-600x800.jpg', 'CC910', 'Menthe', 'XXL', 'O', 19, 25, 2),
(8, 'Culotte', 'Couvrance minimale\r\nConçu avec des fibres recyclées REPREVE\r\nLes fibres REPREVE sont certifiées matières recyclées par le Scientific \r\nDentelle: 47 % nylon, 40 % Recycled nylon, 13 % spandex; Gousset: 100 % coton\r\nLavage à froid et à la main, ne pas essorer, ne pas utiliser de sèche-linge, séchage sur fil\r\nImporté(e)', 'https://cdn.savagex.com/media/images/products/UD2147012-0687/FLORAL-LACE-CHEEKY-UD2147012-0687-2-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/UD2147012-0687/FLORAL-LACE-CHEEKY-UD2147012-0687-LAYDOWN-600x800.jpg', 'CC910', 'Noir', 'XS', 'A', 57, 20, 2),
(9, 'Culotte', 'Couvrance minimale\r\nConçu avec des fibres recyclées REPREVE\r\nLes fibres REPREVE sont certifiées matières recyclées par le Scientific \r\nDentelle: 47 % nylon, 40 % Recycled nylon, 13 % spandex; Gousset: 100 % coton\r\nLavage à froid et à la main, ne pas essorer, ne pas utiliser de sèche-linge, séchage sur fil\r\nImporté(e)', 'https://cdn.savagex.com/media/images/products/UD2044214-3156/SAVAGE-NOT-SORRY-LACE-THONG-UD2044214-3156-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/UD2044214-3156/SAVAGE-NOT-SORRY-LACE-THONG-UD2044214-3156-LAYDOWN-1200x1600.jpg', 'CC910', 'Vert Sapin', 'S', 'A', 50, 20, 2),
(10, 'Culotte', 'Couvrance minimale\r\nConçu avec des fibres recyclées REPREVE\r\nLes fibres REPREVE sont certifiées matières recyclées par le Scientific \r\nDentelle: 47 % nylon, 40 % Recycled nylon, 13 % spandex; Gousset: 100 % coton\r\nLavage à froid et à la main, ne pas essorer, ne pas utiliser de sèche-linge, séchage sur fil\r\nImporté(e)', 'https://cdn.savagex.com/media/images/products/UD2042957-0687/SAVAGE-NOT-SORRY-OPEN-BACK-STRAPPY-BRAZILIAN-UD2042957-0687-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/UD2042957-0687/SAVAGE-NOT-SORRY-OPEN-BACK-STRAPPY-BRAZILIAN-UD2042957-0687-LAYDOWN-1200x1600.jpg', 'CC910', 'Noir', 'M', 'A', 45, 20, 2),
(11, 'Culotte', 'Couvrance minimale\r\nConçu avec des fibres recyclées REPREVE\r\nLes fibres REPREVE sont certifiées matières recyclées par le Scientific\r\nDentelle: 47 % nylon, 40 % Recycled nylon, 13 % spandex; Gousset: 100 % coton\r\nLavage à froid et à la main, ne pas essorer, ne pas utiliser de sèche-linge, séchage sur fil\r\nImporté(e)', 'https://cdn.savagex.com/media/images/products/UD2457629-6036/RUFFLE-LUV-CHEEKY-PANTY-UD2457629-6036-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/UD2457629-6036/RUFFLE-LUV-CHEEKY-PANTY-UD2457629-6036-LAYDOWN-1200x1600.jpg', 'CC910', 'Rouge', 'L', 'A', 47, 20, 2),
(12, 'Culotte', 'Couvrance minimale\r\nConçu avec des fibres recyclées REPREVE\r\nLes fibres REPREVE sont certifiées matières recyclées par le Scientific\r\nDentelle: 47 % nylon, 40 % Recycled nylon, 13 % spandex; Gousset: 100 % coton\r\nLavage à froid et à la main, ne pas essorer, ne pas utiliser de sèche-linge, séchage sur fil\r\nImporté(e)', 'https://cdn.savagex.com/media/images/products/UD2457640-8763/SAVAGE-NOT-SORRY-LACE-THONG-PANTY-UD2457640-8763-3-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/UD2457640-8763/SAVAGE-NOT-SORRY-LACE-THONG-PANTY-UD2457640-8763-LAYDOWN-1200x1600.jpg', 'CC910', 'Blanc', 'XL', 'A', 56, 20, 2),
(15, 'Dentelle Sensuelle', 'Bralette : 90 % nylon, 10 % élasthanne ; dentelle : 84 % nylon, 16 % élasthanne\r\nLavage à froid et à la main, ne pas essorer, ne pas utiliser de sèche-linge, séchage sur fil\r\nImporté', 'https://cdn.savagex.com/media/images/products/BB1829317-5210/DOTTED-MESH-BRALETTE-BB1829317-5210-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/BB1829317-5210/DOTTED-MESH-BRALETTE-BB1829317-5210-LAYDOWN-600x800.jpg', 'DF789', 'Mauve', 'XL', 'D', 53, 25, 1),
(16, 'Essentiel', 'Notre NOUVEAU soutien-gorge t-shirt en microfibre est fabriqué à partir d\'un tissu écoresponsable qui offre la même sensation de fraîcheur au toucher et le même aspect brillant que notre best-seller original. Ce modèle présente des bonnets légèrement rembourrés et un décolleté à bord fin pour une apparence lisse sous les vêtements.\r\n\r\nLégèrement rembourré\r\nArmature\r\nEncolure collée\r\nTissu en microfibre recyclée\r\nBretelles élastiques réglables avec logo en peluche au dos\r\nDos cagoulé\r\nAccessoires en or rose\r\nFermeture à crochets au dos\r\nCorps : 78 % nylon recyclé, 22 % élasthanne ; doublure des bonnets : 100 % polyester\r\nLaver à la main à l\'eau froide, séparément, et sécher à plat.\r\nArticle importé', 'https://cdn.savagex.com/media/images/products/BA2355593-9011/MICROFIBER-T-SHIRT-BRA-BA2355593-9011-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/BA2355593-9011/MICROFIBER-T-SHIRT-BRA-BA2355593-9011-LAYDOWN-600x800.jpg', 'DF789', 'Nude', '105', 'M', 20, 30, 1),
(17, ' Fleur de Printemps', 'Bonnets : 100 % polyester; Soutien-gorge : 80 % polyamide, 20 % élasthanne; Doublure : 74 % polyamide, 26 % élasthanne; doublure des bonnets: 100 % polyamide\r\nLavage à froid et à la main, ne pas essorer, ne pas sécher en machine\r\nImporté', 'https://cdn.savagex.com/media/images/products/BA2146078-1370/FREE-SPIRIT-FLORAL-EMBROIDERY-UNLINED-BALCONETTE-BRA-BA2146078-1370-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/BA2146078-1370/FREE-SPIRIT-FLORAL-EMBROIDERY-UNLINED-BALCONETTE-BRA-BA2146078-1370-LAYDOWN-600x800.jpg', 'DF789', 'Noir', '110', 'C', 32, 45, 1),
(18, 'Dentelle Divine', 'Dentelle : 93% Nylon, 7% Elasthanne ; Doublure : 100% Nylon.\r\nLaver à la main à l\'eau froide, séparément, sécher sur fil\r\nArticle importé', 'https://cdn.savagex.com/media/images/products/BB2148515-6909/ROMANTIC-CORDED-LACE-FRONT-CLOSURE-BRALETTE-BB2148515-6909-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/BB2148515-6909/ROMANTIC-CORDED-LACE-FRONT-CLOSURE-BRALETTE-BB2148515-6909-LAYDOWN-600x800.jpg', 'DF789', 'Vert Sapin', '120', 'G', 55, 25, 1),
(19, 'Obsession Sensuelle', 'Notre soutien-gorge sans bretelles en maille possède une technologie d\'armature intérieure cachée et des bretelles amovibles pour changer de look.\r\n\r\nSoutien-gorge sans bretelles\r\nArmature\r\nLégèrement doublé\r\nCorps en microfibre et maille haute brillance\r\nBaleines légères cachées à l\'intérieur\r\nBretelles amovibles et réglables incluses\r\nMatériel de couleur or rose\r\nFermeture arrière avec crochets et œillets\r\nCorps : 70% Polyamide, 30% Elastane ; Aile : 87% Polyamide, 13% Elastane\r\nLaver à la main à froid, ne pas essorer, ne pas sécher en machine, sécher sur une corde.', 'https://cdn.savagex.com/media/images/products/BA2253555-0687/MESH-STRAPLESS-BRA-BA2253555-0687-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/BA2253555-0687/MESH-STRAPLESS-BRA-BA2253555-0687-LAYDOWN-600x800.jpg', 'DF789', 'Noir', '95', 'I', 30, 40, 1),
(21, 'Charme Florissant', 'Ce Savage Not Sorry Unlined Lace Balconette Bra est conçu à partir d\'une dentelle sexy et facile à porter au quotidien, avec un imprimé floral coloré en édition limitée.\r\n\r\nNon doublé\r\nSilhouette balconnet\r\nArmatures\r\nDentelle stretch personnalisée à imprimé fleurs\r\nBords festonnés\r\nBreloque X couleur or rose au centre du devant\r\nBretelles réglables\r\nFermeture au dos par crochets et œillets\r\nAccessoires couleur or rose\r\nCorps : 86% Nylon, 14% Elasthanne ; Bordure : 75 % nylon, 25 % élasthanne\r\nLaver à la main à l\'eau froide, séparément, sécher à plat.\r\nArticle importé', 'https://cdn.savagex.com/media/images/products/BA2457638-8763/SAVAGE-NOT-SORRY-UNLINED-LACE-BALCONETTE-BRA-BA2457638-8763-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/BA2457637-8763/SAVAGE-NOT-SORRY-UNLINED-LACE-BALCONETTE-BRA-BA2457637-8763-LAYDOWN-600x800.jpg', 'DF789', 'Blanc', '120', 'G', 54, 45, 1),
(22, 'Dentelle Enchantée', '86% nylon, 14% élasthanne\r\nLavage à froid et à la main, ne pas essorer, ne pas utiliser de sèche-linge, séchage sur fil\r\nImporté', 'https://cdn.savagex.com/media/images/products/BA2042992-5210/SAVAGE-NOT-SORRY-UNLINED-LACE-BALCONETTE-BRA-BA2042992-5210-2-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/BA2042992-5210/SAVAGE-NOT-SORRY-UNLINED-LACE-BALCONETTE-BRA-BA2042992-5210-LAYDOWN-600x800.jpg', 'DF789', 'Mauve', '125', 'M', 19, 40, 1),
(23, 'Charme Céleste', 'Basque non rembourrée avec armatures et baleines structurées\r\nBroderie florale stretch et délicate inspirée des arcs d\'église, en mesh et satin\r\nStyle évasé à la taille et aux hanches\r\nNœuds décoratifs avec bouquets de fleurs et boutons en satin\r\nDétails ajourés\r\nEnsemble basque et string assorti avec porte-jarretelles réglables\r\nBretelles réglables à picots\r\nFermeture avec agrafes et boutons en satin\r\nMatériel gravé Lounge en or rose\r\n100 % Polyester\r\nSentez-vous parfaitement féminine dans l\'ensemble Cordelia Intimates. Les détails magnifiques et les broderies complexes de cet ensemble sont parfaits pour votre grand jour (ou même votre nuit).', 'https://cdn.shopify.com/s/files/1/0276/4777/0659/files/1WhiteCordeliaIntimatesSetAdison.jpg?crop=center&format=webp&height=483&quality=80&v=1710256451&width=345', 'https://fr.lounge.com/cdn/shop/files/2WhiteCordeliaIntimatesSetAdison.jpg?crop=center&format=webp&height=679&quality=80&v=1710256450&width=480', 'NS3456', 'Blanc', '100', 'C', 56, 80, 3),
(24, 'Soirée Enchantée', 'Soutien-gorge à armatures, sans rembourrage\r\nBroderie florale en stretch, avec fil lurex pailleté et bordure décorative\r\nBoucles d\'organza avec détail de breloque de bijou\r\nBretelles Lounge tissées et fabrication en satin\r\nEnsemble soutien-gorge et string assorti avec porte-jarretelles et bretelles réglables\r\nFermeture avec agrafes\r\nÉlément gravé Lounge en or rose\r\n54% Polyamide recyclé, 34% Polyester, 6% Elasthanne, 6% Fibre métallisée\r\nNous tamisons les lumières et augmentons l\'intimité dans notre Ensemble Celine Intimates. Doté de délicates broderies qui scintillent et brillent, il attirera tous les regards sur vous.', 'https://fr.lounge.com/cdn/shop/files/3CelineIntimatesSet-Adison.jpg?crop=center&format=webp&height=679&quality=80&v=1710254242&width=480', 'https://fr.lounge.com/cdn/shop/files/2CelineIntimatesSet-Adison.jpg?crop=center&format=webp&height=679&quality=80&v=1710254239&width=480', 'NS3456', 'Vert Sapin', '120', 'I', 54, 70, 3),
(25, 'Nuit', 'Avec des bonnets flatteurs en satin, une broderie florale féminine et des bretelles entièrement réglables, la nuisette Eden est accompagnée d\'un string assorti pour compléter l\'ensemble de vos rêves.\r\n\r\nNuisette sans armature et sans rembourrage\r\nBonnets en satin plissé\r\nStyle robe en satin avec fente latérale et dos échancré.\r\nBroderie florale dans les tons noir, rouge et rose.\r\nDétails à pois\r\nNœuds décoratifs en satin avec centre en forme de rose\r\nBretelles froncées ajustables\r\nFermeture par agrafes avec réglage dans le dos\r\nG-string en mesh à pois avec finition décorative\r\nEnsemble nuisette et string assortis\r\nMatériel gravé Lounge en or rose\r\n100% polyester', 'https://fr.lounge.com/cdn/shop/files/2.EdenSlipDress-Muriel.jpg?crop=center&format=webp&height=679&quality=80&v=1710258895&width=480', 'https://fr.lounge.com/cdn/shop/files/5.EdenSlipDress-Muriel.jpg?crop=center&format=webp&height=679&quality=80&v=1710258900&width=480', 'MP2345', 'Rose', 'M', 'L', 50, 30, 4),
(27, 'Nuit', 'Babydoll sexy dos nu, fabriqué dans un tissu léger et délicat. Ce style est conçu pour vous offrir une forme élégante et sculpter vos courbes, la lingerie ne peut pas être plus romantique que cela.\r\n\r\nSoutien-gorge avec armatures, sans rembourrage\r\nBroderie avec cœurs et détails en lurex doré\r\nMesh stretch à pois, satin et élastique à picots\r\nNœuds décoratifs en satin avec centre en forme de rose\r\nDétails ajourés\r\nEnsemble babydoll et string assorti\r\nFermeture par agrafes gaufrées avec lien en satin/li>\r\nMatériel gravé Lounge en or rose\r\n46% Polyester recyclé, 46% Polyester, 8% Fibre métallique', 'https://fr.lounge.com/cdn/shop/files/1.IsadoraBabyDoll-Fanta.jpg?crop=center&format=webp&height=679&quality=80&v=1710258793&width=480', 'https://fr.lounge.com/cdn/shop/files/5.IsadoraBabyDoll-Fanta.jpg?crop=center&format=webp&height=679&quality=80&v=1710258791&width=480', 'MP2345', 'Rouge', 'S', 'L', 44, 45, 4),
(29, 'Maillot de bain', 'Matière à rayures ton sur ton\r\nEncolure en V associée avec une jambe haute\r\nDos échancré et culotte effrontée avec bretelles réglables\r\nChaîne Lounge couleur or rose\r\nÉlément gravé Lounge couleur or rose\r\n43 % Polyester recyclé, 43 % Polyester, 14 % Élasthanne\r\nFaites-vous remarquer avec le Maillot de Bain une pièce Statement. Cette coupe en V est également échancrée dans le dos. Conçue pour vous donner une allure des plus flatteuses.', 'https://fr.lounge.com/cdn/shop/files/2BlackStatementSwimsuitAmber_06ebc847-30c1-4358-94ed-ab298e47803f.jpg?crop=center&format=webp&height=679&quality=80&v=1710256437&width=480', 'https://fr.lounge.com/cdn/shop/files/3BlackStatementSwimsuitAmber.jpg?crop=center&format=webp&height=679&quality=80&v=1710256436&width=480', 'VJ768', 'Noir', 'S', 'M', 56, 45, 5),
(30, 'Maillot de bain', 'Haut de Bikini, sans rembourrage\r\nMatière à rayures ton sur ton avec détails ajourés sur les bretelles\r\nBretelles réglables et fermeture à crochet de cygne\r\nÉlément gravé Lounge couleur or rose\r\n43 % Polyester recyclé, 43 % Polyester, 14 % Élasthanne\r\nFaites perdurer l\'été avec le Haut de Bikini Essential. Doté de bretelles réglables et d\'accessoires résistants à la chaleur, ce Haut de Bikini est parfait pour se prélasser au bord de la piscine.', 'https://fr.lounge.com/cdn/shop/files/1CreamEssentialBikiniTopAdison.jpg?crop=center&format=webp&height=679&quality=80&v=1710256813&width=480', 'https://fr.lounge.com/cdn/shop/files/2CreamEssentialBikiniTopAdison.jpg?crop=center&format=webp&height=679&quality=80&v=1710256816&width=480', 'VJ768', 'Blanc', 'S', 'M', 45, 35, 5),
(31, 'Maillot de bain', 'Savage, seamless, and super smooth, our Seamless Bodysuit Teddy was designed for all-day comfort and features a scoop neckline, high-leg bikini, and a logo accent in back. Made from a soft, seam-free material that stretches over your curves and holds you in all the right places.\r\n\r\nCami silhouette\r\nScoop neckline\r\nJacquard logo elastic straps\r\nJacquard logo at back neckline\r\nHigh-leg bikini coverage\r\nRose gold-tone hardware\r\nCotton gusset liner\r\nBody: 92% Nylon, 7% Elastane, 1% Polyester\r\nMachine wash cold water with like colors, wash inside out, lay flat to dry\r\nImported', 'https://fr.lounge.com/cdn/shop/files/4CreamStatementSwimsuitAdison.jpg?crop=center&format=webp&height=679&quality=80&v=1710256242&width=480', 'https://fr.lounge.com/cdn/shop/files/2CreamStatementSwimsuitAdison.jpg?crop=center&format=webp&height=679&quality=80&v=1710256245&width=480', 'VJ768', 'Blanc', 'M', 'L', 31, 30, 5),
(32, 'test', 'test', 'https://cdn.savagex.com/media/images/products/UD2457631-8759/LUV-LANGUAGE-TEENSY-THONG-PANTY-UD2457631-8759-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/UD2457631-8759/LUV-LANGUAGE-TEENSY-THONG-PANTY-UD2457631-8759-LAYDOWN-1200x1600.jpg', 'AV3518', 'Rouge Foncé', 'M', 'A', 20, 20, 2),
(35, 'Florence Intima', 'Notre Ensemble Florence Intima est confectionné en dentelle superbement texturée et ornée d’irrésistibles appliqués. Sublimé par une maille extensible douce à pois et des bords élastiques en picot, cet ensemble incarne la notion même de beauté parfaite avec d’audacieux détails ajourés.\r\n\r\n\r\nSoutien-gorge à armatures avec détails ajourés\r\nEmpiècements en maille et en satin avec dentelle florale et motif à pois\r\nSublimé par des détails appliqués\r\nEnsemble Soutien-Gorge et String assorti avec porte-jarretelles réglable et jarretières\r\nAgrafes en guise d’attaches\r\nBretelles réglables avec gaufrage Lounge\r\nÉléments métalliques Or rosé gravés Lounge\r\n64% Polyester, 36% Polyamide\r\n\r\n\r\n', 'https://fr.lounge.com/cdn/shop/files/1HotPinkFlorenceIntimatesSetMuriel.jpg?crop=center&format=webp&height=679&quality=80&v=1710247146&width=480', 'https://fr.lounge.com/cdn/shop/files/2HotPinkFlorenceIntimatesSetMuriel.jpg?crop=center&format=webp&height=679&quality=80&v=1710247147&width=480', 'NS3456', 'Rose Vif', 'S', 'D', 27, 70, 5),
(45, 'balconey', 'aaaaaaaaaaaaaaaaaaa', 'https://cdn.savagex.com/media/images/products/BA2356008-0589/MIDNIGHT-SWEAT-UNLINED-EMBROIDERED-BALCONETTE-BRA-BA2356008-0589-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/BA2356008-0589/MIDNIGHT-SWEAT-UNLINED-EMBROIDERED-BALCONETTE-BRA-BA2356008-0589-LAYDOWN-1200x1600.jpg', 'DF789', 'Noir', 'XXL', 'O', 40, 25, 3),
(46, 'balconey', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'https://cdn.savagex.com/media/images/products/BA2356008-0589/MIDNIGHT-SWEAT-UNLINED-EMBROIDERED-BALCONETTE-BRA-BA2356008-0589-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/BA2356008-0589/MIDNIGHT-SWEAT-UNLINED-EMBROIDERED-BALCONETTE-BRA-BA2356008-0589-LAYDOWN-1200x1600.jpg', 'DF789', 'Menthe', 'XXL', 'O', 40, 25, 1),
(55, 'Signature Script Underwire', 'Laissez notre Teddy Underwire Signature Script voler la vedette avec une coupe ultra haute sur la jambe, un tissu transparent, un motif en dentelle avec logo et une découpe en forme de trou de serrure dans le dos.\r\n\r\n\r\nLaissez notre Teddy Underwire Signature Script voler la vedette avec une coupe ultra haute sur la jambe, un tissu transparent, un motif en dentelle avec logo et une découpe en forme de trou de serrure dans le dos.\r\n\r\nArmature\r\nDentelle avec motif de logo\r\nBordure en mesh au niveau du décolleté du bonnet\r\nDécoupe en forme de trou de serrure dans le dos\r\nBretelles réglables et soutien renforcé au dos en tissu doux\r\nString ultra échancré à l&#039;arrière\r\nPlaque de logo en métal sur la hanche gauche\r\nFermeture à crochet et œillet dans le dos\r\nComposition de la dentelle : 63% Polyamide, 37% Élasthanne ; Doublure : 100% Polyamide, Bordure : 74% Polyamide, 26% Élasthanne ; Fond : 100% Coton\r\nLaver à la main à l&#039;eau froide, sécher à plat', 'https://cdn.savagex.com/media/images/products/LI2458491-0687/SIGNATURE-SCRIPT-UNDERWIRE-TEDDY-LI2458491-0687-1-1200x1600.jpg', 'https://cdn.savagex.com/media/images/products/LI2458491-0687/SIGNATURE-SCRIPT-UNDERWIRE-TEDDY-LI2458491-0687-LAYDOWN-1200x1600.jpg', 'BM789', 'Noir', 'XXL', 'A', 100, 25, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `id_produit` (`id_produit`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id_details_commande`),
  ADD KEY `id_commande` (`id_commande`,`id_produit`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_panier`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id_commande` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id_details_commande` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id_membre` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_panier` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id_membre`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`id_commande`) REFERENCES `details_commande` (`id_commande`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `commentaires_ibfk_3` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id_membre`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `details_commande_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id_membre`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
