-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 03 Janvier 2014 à 01:19
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CD8737FAF675F31B` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `enabled`, `author_id`, `updatedAt`, `createdAt`, `image_name`) VALUES
(14, 'OM : l’étonnante rumeur Kocaman', 'Vincent Labrune l’a expliqué, pour l’heure, José Anigo reste sur le banc de touche de l’Olympique de Marseille jusqu’à nouvel ordre. Le directeur sportif assure l’intérim en attendant la venue d’un nouveau coach capable de succéder à Élie Baup. Quelques pistes ont été évoquées ces dernières semaines, de Frédéric Antonetti à Alain Boghossian en passant par Fabrizio Ravanelli ou Lucien Favre. Sans suite.\r\n\r\nAujourd’hui, le quotidien turc Vatan explique que les Phocéens seraient intéressés par les services d’Aykut Kocaman. Entraîneur de Fenerbahçe entre 2010 et 2013, il a remporté un titre de champion de Turquie (2011), deux Coupes de Turquie (2012 et 2013) et atteint les demi-finales de l’Europa League (2013). Il est aujourd’hui libre de tout contrat et, outre l’OM, la Lazio Rome serait également séduite par son profil.\r\n\r\nLa Provence annonçait ce mardi que Marseille ne voyait pas d’un mauvais œil l’arrivée d’un entraîneur étranger sur son banc. Le quotidien rappelait que la priorité était la venue d’un maître tacticien capable de faire progresser les jeunes qui composent le groupe phocéen. Aykut Kocaman sera-t-il celui-là ?', 1, 5, '2014-01-03 00:28:41', '2014-01-03 00:28:41', '52c5f629a040c.jpeg'),
(16, 'Bordeaux : la belle surprise Jussiê', 'Cet été, Jussiê aurait dû quitter Bordeaux. En tout cas, tel était le souhait émis par le Brésilien, désireux de changer d’air après avoir passé pas moins de six saisons chez les Girondins. Mis à l’écart le temps de se trouver un club, le natif de Nova Venécia n’a finalement jamais quitté l’Aquitaine, et a donc été réintégré dans le groupe professionnel, dans l’indifférence générale ou presque. Et pourtant, Francis Gillot doit aujourd’hui être soulagé de pouvoir compter sur l’ancien Lensois, tant ce dernier brille dans cet exercice. Auteur de 5 buts en 15 matches de championnat, Jussiê est le deuxième meilleur buteur bordelais cette saison en L1, juste derrière Diabaté, et devant Obraniak. Un retour qu’il savoure dans les colonnes du Parisien : « Cela fait plaisir de marquer, mais je retiens surtout que nous sommes redevenus une véritable équipe. Chacun s’est vraiment remis en question. En début de saison, ça partait dans tous les sens. Aujourd’hui, tout le monde fait les efforts et nous montrons un vrai visage. Bordeaux a une âme et un potentiel pour réaliser de bonnes choses ». À 30 ans, le Brésilien s’épanouit, et avoue être lui-même surpris : « Les gens ont pensé que je ne serais pas concerné et qu’il ne fallait pas compter sur moi. Mais je ne suis pas comme ça. À partir du moment où j’ai repris le maillot de Bordeaux, je me suis remis au travail. Personne ne m’a vu venir et je ne m’attendais pas non plus à une telle saison sur un plan personnel. Je suis la grosse surprise. Mon problème a toujours été la concentration. Sinon, j’aurais joué dans un grand club européen ». Mais Bordeaux, c’est déjà pas si mal après tout.', 1, 5, '2014-01-03 01:18:26', '2014-01-03 01:18:26', '52c601d2a3618.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `article_category`
--

CREATE TABLE `article_category` (
  `category_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`article_id`),
  KEY `IDX_53A4EDAA12469DE2` (`category_id`),
  KEY `IDX_53A4EDAA7294869C` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `article_category`
--

INSERT INTO `article_category` (`category_id`, `article_id`) VALUES
(14, 4),
(16, 4);

-- --------------------------------------------------------

--
-- Structure de la table `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `Category`
--

INSERT INTO `Category` (`id`, `name`) VALUES
(4, 'Ligue 1');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5BC96BF0F675F31B` (`author_id`),
  KEY `IDX_5BC96BF07294869C` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(4, 'segolene', 'segolene', 'segolene.tachat@wanadoo.fr', 'segolene.tachat@wanadoo.fr', 1, 'itglouakiq040owscg8w80ocwgskw40', '2ZMg5bLgL8serGGxm0kh5j3IzBeroCF7ygDQDJBmDrU6alFCKtM9av0m6P2jew82ZDIhjvyMuNfoHRRrwZBeXA==', '2014-01-03 01:08:01', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL),
(5, 'admin', 'admin', 'admin@admin.fr', 'admin@admin.fr', 1, '932sashlh6w4wssco88o8csww8g4gk4', 'qsk6mCmZ0AsAz+3MgLmsShbbXMgP0hI37S043Mf3vr69jMRCwuXmYLw6utorga6Z6kwhStRFiRnCZu31kPl8Ig==', '2014-01-03 01:17:33', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_CD8737FAF675F31B` FOREIGN KEY (`author_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `FK_53A4EDAA7294869C` FOREIGN KEY (`article_id`) REFERENCES `Category` (`id`),
  ADD CONSTRAINT `FK_53A4EDAA12469DE2` FOREIGN KEY (`category_id`) REFERENCES `Article` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_5BC96BF07294869C` FOREIGN KEY (`article_id`) REFERENCES `Article` (`id`),
  ADD CONSTRAINT `FK_5BC96BF0F675F31B` FOREIGN KEY (`author_id`) REFERENCES `fos_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
