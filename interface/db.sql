-- Adminer 4.8.1 MySQL 8.0.36 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `abo_femme`;
CREATE TABLE `abo_femme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `duree` int NOT NULL,
  `formule` varchar(50) NOT NULL,
  `langue` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `abo_femme` (`id`, `duree`, `formule`, `langue`) VALUES
(1,	1,	'9.90',	'fr'),
(2,	3,	'24.90',	'fr'),
(3,	6,	'39.90',	'fr'),
(4,	12,	'69.90',	'fr');

DROP TABLE IF EXISTS `abo_homme`;
CREATE TABLE `abo_homme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `duree` int NOT NULL,
  `formule` varchar(50) NOT NULL,
  `langue` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `abo_homme` (`id`, `duree`, `formule`, `langue`) VALUES
(1,	1,	'14.90',	'fr'),
(2,	3,	'39',	'fr'),
(3,	6,	'69',	'fr'),
(4,	12,	'119',	'fr');

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) NOT NULL,
  `passe` varchar(200) NOT NULL,
  `passe_non_crypte` varchar(50) NOT NULL,
  `date_last_visite` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `admin` (`id`, `pseudo`, `passe`, `passe_non_crypte`, `date_last_visite`) VALUES
(1,	'mayline',	'b9d6c3d65e9dfeca21fee35c98f6eae4',	'poupoune',	1264383074);

DROP TABLE IF EXISTS `affichage`;
CREATE TABLE `affichage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  `lien` varchar(60) NOT NULL,
  `texte` varchar(220) NOT NULL,
  `anchor` int NOT NULL,
  `formule` int NOT NULL,
  `date_creation` int NOT NULL,
  `compteur` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `album_photo`;
CREATE TABLE `album_photo` (
  `identifiant` int NOT NULL,
  `img1` varchar(10) NOT NULL,
  `img2` varchar(10) NOT NULL,
  `img3` varchar(10) NOT NULL,
  `img4` varchar(10) NOT NULL,
  `controle` int NOT NULL,
  PRIMARY KEY (`identifiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `animaux_en`;
CREATE TABLE `animaux_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `animaux_en` (`id`, `element`) VALUES
(1,	'yes'),
(2,	'no');

DROP TABLE IF EXISTS `animaux_es`;
CREATE TABLE `animaux_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `animaux_es` (`id`, `element`) VALUES
(1,	'si'),
(2,	'no');

DROP TABLE IF EXISTS `animaux_fr`;
CREATE TABLE `animaux_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `animaux_fr` (`id`, `element`) VALUES
(1,	'oui'),
(2,	'non');

DROP TABLE IF EXISTS `archive_flv`;
CREATE TABLE `archive_flv` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(250) NOT NULL,
  `date_creation` int NOT NULL,
  `repertoire` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `audio`;
CREATE TABLE `audio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(80) NOT NULL,
  `fichier` varchar(255) NOT NULL,
  `controle` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `barbecue_en`;
CREATE TABLE `barbecue_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `barbecue_en` (`id`, `element`) VALUES
(1,	'yes'),
(2,	'no');

DROP TABLE IF EXISTS `barbecue_es`;
CREATE TABLE `barbecue_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `barbecue_es` (`id`, `element`) VALUES
(1,	'si'),
(2,	'no');

DROP TABLE IF EXISTS `barbecue_fr`;
CREATE TABLE `barbecue_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `barbecue_fr` (`id`, `element`) VALUES
(1,	'oui'),
(2,	'non');

DROP TABLE IF EXISTS `bibliotheque`;
CREATE TABLE `bibliotheque` (
  `id` int NOT NULL AUTO_INCREMENT,
  `extension` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `blacklist`;
CREATE TABLE `blacklist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pseudo` int NOT NULL,
  `id_pseudo_blacklister` int NOT NULL,
  `date_blacklist` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `blog_categories_en`;
CREATE TABLE `blog_categories_en` (
  `id_cat` mediumint NOT NULL AUTO_INCREMENT,
  `cat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `blog_categories_es`;
CREATE TABLE `blog_categories_es` (
  `id_cat` mediumint NOT NULL AUTO_INCREMENT,
  `cat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `blog_categories_fr`;
CREATE TABLE `blog_categories_fr` (
  `id_cat` mediumint NOT NULL AUTO_INCREMENT,
  `cat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `blog_en`;
CREATE TABLE `blog_en` (
  `id_article` mediumint NOT NULL AUTO_INCREMENT,
  `titre_article` varchar(100) NOT NULL,
  `texte_article` text NOT NULL,
  `id_cat` varchar(255) NOT NULL,
  `date_creation` int NOT NULL,
  `confirmation` varchar(5) NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `blog_es`;
CREATE TABLE `blog_es` (
  `id_article` mediumint NOT NULL AUTO_INCREMENT,
  `titre_article` varchar(100) NOT NULL,
  `texte_article` text NOT NULL,
  `id_cat` varchar(255) NOT NULL,
  `date_creation` int NOT NULL,
  `confirmation` varchar(5) NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `blog_fr`;
CREATE TABLE `blog_fr` (
  `id_article` mediumint NOT NULL AUTO_INCREMENT,
  `titre_article` varchar(100) NOT NULL,
  `texte_article` text NOT NULL,
  `id_cat` varchar(255) NOT NULL,
  `date_creation` int NOT NULL,
  `confirmation` varchar(5) NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `canape_lit_en`;
CREATE TABLE `canape_lit_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `canape_lit_en` (`id`, `element`) VALUES
(1,	'yes'),
(2,	'no');

DROP TABLE IF EXISTS `canape_lit_es`;
CREATE TABLE `canape_lit_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `canape_lit_es` (`id`, `element`) VALUES
(1,	'si'),
(2,	'no');

DROP TABLE IF EXISTS `canape_lit_fr`;
CREATE TABLE `canape_lit_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `canape_lit_fr` (`id`, `element`) VALUES
(1,	'oui'),
(2,	'non');

DROP TABLE IF EXISTS `capacite_accueil_en`;
CREATE TABLE `capacite_accueil_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `capacite_accueil_en` (`id`, `element`) VALUES
(1,	'1'),
(2,	'2'),
(3,	'3'),
(4,	'4'),
(5,	'5'),
(6,	'6'),
(7,	'7'),
(8,	'8 or more');

DROP TABLE IF EXISTS `capacite_accueil_es`;
CREATE TABLE `capacite_accueil_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `capacite_accueil_es` (`id`, `element`) VALUES
(1,	'1'),
(2,	'2'),
(3,	'3'),
(4,	'4'),
(5,	'5'),
(6,	'6'),
(7,	'7'),
(8,	'8 o m');

DROP TABLE IF EXISTS `capacite_accueil_fr`;
CREATE TABLE `capacite_accueil_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `capacite_accueil_fr` (`id`, `element`) VALUES
(1,	'1'),
(2,	'2'),
(3,	'3'),
(4,	'4'),
(5,	'5'),
(6,	'6'),
(7,	'7'),
(8,	'8 ou plus');

DROP TABLE IF EXISTS `carnet_de_voyage`;
CREATE TABLE `carnet_de_voyage` (
  `identifiant` int NOT NULL,
  `intitule` varchar(80) NOT NULL,
  `commentaire` text NOT NULL,
  `controle` varchar(10) NOT NULL,
  PRIMARY KEY (`identifiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `chambre_adulte_en`;
CREATE TABLE `chambre_adulte_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `chambre_adulte_en` (`id`, `element`) VALUES
(1,	'no'),
(2,	'1 room 1 bed'),
(3,	'1 room 2 beds'),
(4,	'2 rooms 1 bed'),
(5,	'2 rooms 2 beds'),
(6,	'3 rooms 1 bed'),
(7,	'3 rooms 2 beds or more');

DROP TABLE IF EXISTS `chambre_adulte_es`;
CREATE TABLE `chambre_adulte_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `chambre_adulte_es` (`id`, `element`) VALUES
(1,	'no'),
(2,	'1 habitaci?n 1 cama'),
(3,	'1 habitaci?n 2 camas'),
(4,	'2 habitaciones 1 cama'),
(5,	'2 habitaciones 2 camas'),
(6,	'3 habitaciones 1 cama'),
(7,	'3 habitaciones 2 camas o m');

DROP TABLE IF EXISTS `chambre_adulte_fr`;
CREATE TABLE `chambre_adulte_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `chambre_adulte_fr` (`id`, `element`) VALUES
(1,	'non'),
(2,	'1 chambre 1 lit'),
(3,	'1 chambre 2 lits'),
(4,	'2 chambres 1 lit'),
(5,	'2 chambres 2 lits'),
(6,	'3 chambres 1 lit'),
(7,	'3 chambres 2 lits ou plus');

DROP TABLE IF EXISTS `chambre_enfant_en`;
CREATE TABLE `chambre_enfant_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `chambre_enfant_en` (`id`, `element`) VALUES
(1,	'no'),
(2,	'1 room 1 bed'),
(3,	'1 room 2 beds'),
(4,	'2 rooms 1 bed'),
(5,	'2 rooms 2 beds'),
(6,	'3 rooms 1 bed'),
(7,	'3 rooms 2 beds or more');

DROP TABLE IF EXISTS `chambre_enfant_es`;
CREATE TABLE `chambre_enfant_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `chambre_enfant_es` (`id`, `element`) VALUES
(1,	'no'),
(2,	'1 habitaci?n 1 cama'),
(3,	'1 habitaci?n 2 camas'),
(4,	'2 habitaciones 1 cama'),
(5,	'2 habitaciones 2 camas'),
(6,	'3 habitaciones 1 cama'),
(7,	'3 habitaciones 2 camas o m');

DROP TABLE IF EXISTS `chambre_enfant_fr`;
CREATE TABLE `chambre_enfant_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `chambre_enfant_fr` (`id`, `element`) VALUES
(1,	'non'),
(2,	'1 chambre 1 lit'),
(3,	'1 chambre 2 lits'),
(4,	'2 chambres 1 lit'),
(5,	'2 chambres 2 lits'),
(6,	'3 chambres 1 lit'),
(7,	'3 chambres 2 lits ou plus');

DROP TABLE IF EXISTS `compteur_profil`;
CREATE TABLE `compteur_profil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_profil` int NOT NULL,
  `id_visiteur` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `condition`;
CREATE TABLE `condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `except` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `condition` (`id`, `except`) VALUES
(1,	5),
(2,	1),
(3,	6),
(4,	4),
(5,	2),
(6,	3),
(7,	7),
(8,	8);

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `configuration`;
CREATE TABLE `configuration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `valeur` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `configuration` (`id`, `valeur`) VALUES
(1,	'/homepages/10/d4299005927/htdocs/maison'),
(2,	'echangesamaison.com'),
(3,	'db5017827985.hosting-data.io'),
(4,	'dbu885281'),
(5,	'aWcDSb9twH6>6Q-55'),
(6,	'dbs14218084'),
(7,	'dbs14218084_paiements'),
(8,	'/maison/fr/'),
(9,	'/maison/en/'),
(10,	'/intercambio-de-casa.com'),
(11,	'/home-exchange.biz'),
(12,	'utf-8'),
(13,	'text/html'),
(14,	'20'),
(15,	'3'),
(16,	'10'),
(17,	'100'),
(18,	'900'),
(19,	'1800'),
(20,	'60'),
(21,	'18'),
(22,	'60'),
(23,	'30'),
(24,	'40'),
(25,	'10'),
(26,	'150'),
(27,	'5'),
(28,	'20'),
(29,	'30'),
(30,	'600'),
(31,	'400'),
(32,	'30'),
(33,	'contact@echangesamaison.com'),
(34,	'paypal@echangesamaison.com');

DROP TABLE IF EXISTS `controleur_media`;
CREATE TABLE `controleur_media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo_membre` varchar(50) NOT NULL,
  `identifiant` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `conversation_directe`;
CREATE TABLE `conversation_directe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_exp` int NOT NULL,
  `id_dest` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `cron_mailinglist`;
CREATE TABLE `cron_mailinglist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lettre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `cuisine_en`;
CREATE TABLE `cuisine_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `cuisine_en` (`id`, `element`) VALUES
(1,	'yes'),
(2,	'no');

DROP TABLE IF EXISTS `cuisine_es`;
CREATE TABLE `cuisine_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `cuisine_es` (`id`, `element`) VALUES
(1,	'si'),
(2,	'no');

DROP TABLE IF EXISTS `cuisine_fr`;
CREATE TABLE `cuisine_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `cuisine_fr` (`id`, `element`) VALUES
(1,	'oui'),
(2,	'non');

DROP TABLE IF EXISTS `departement_fr`;
CREATE TABLE `departement_fr` (
  `numdept` char(2) NOT NULL DEFAULT '',
  `numregion` char(32) NOT NULL DEFAULT '',
  `nomdept` char(35) DEFAULT NULL,
  PRIMARY KEY (`numdept`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `departement_fr` (`numdept`, `numregion`, `nomdept`) VALUES
('01',	'22',	'Ain'),
('02',	'20',	'Aisne'),
('03',	'3',	'Allier'),
('04',	'18',	'Alpes de haute provence'),
('05',	'18',	'Hautes alpes'),
('06',	'18',	'Alpes maritimes'),
('07',	'22',	'Ard&egrave;che'),
('08',	'8',	'Ardennes'),
('09',	'16',	'Ari&egrave;ge'),
('10',	'8',	'Aube'),
('11',	'13',	'Aude'),
('12',	'16',	'Aveyron'),
('13',	'18',	'Bouches du rh&ocirc;ne'),
('14',	'4',	'Calvados'),
('15',	'3',	'Cantal'),
('16',	'21',	'Charente'),
('17',	'21',	'Charente maritime'),
('18',	'7',	'Cher'),
('19',	'14',	'Corr&egrave;ze'),
('21',	'5',	'C&ocirc;te d\'or'),
('22',	'6',	'C&ocirc;tes d\'Armor'),
('23',	'14',	'Creuse'),
('24',	'2',	'Dordogne'),
('25',	'10',	'Doubs'),
('26',	'22',	'Dr&ocirc;me'),
('27',	'11',	'Eure'),
('28',	'7',	'Eure et Loire'),
('29',	'6',	'Finist&egrave;re'),
('30',	'13',	'Gard'),
('31',	'16',	'Haute garonne'),
('32',	'16',	'Gers'),
('33',	'2',	'Gironde'),
('34',	'13',	'H&eacute;rault'),
('35',	'6',	'Ile et Vilaine'),
('36',	'7',	'Indre'),
('37',	'7',	'Indre et Loire'),
('38',	'22',	'Is&egrave;re'),
('39',	'10',	'Jura'),
('40',	'2',	'Landes'),
('41',	'7',	'Loir et Cher'),
('42',	'22',	'Loire'),
('43',	'3',	'Haute loire'),
('44',	'19',	'Loire Atlantique'),
('45',	'7',	'Loiret'),
('46',	'16',	'Lot'),
('47',	'2',	'Lot et Garonne'),
('48',	'13',	'Loz&egrave;re'),
('49',	'19',	'Maine et Loire'),
('50',	'4',	'Manche'),
('51',	'8',	'Marne'),
('52',	'8',	'Haute Marne'),
('53',	'19',	'Mayenne'),
('54',	'15',	'Meurthe et Moselle'),
('55',	'15',	'Meuse'),
('56',	'6',	'Morbihan'),
('57',	'15',	'Moselle'),
('58',	'5',	'Ni&egrave;vre'),
('59',	'17',	'Nord'),
('60',	'20',	'Oise'),
('61',	'4',	'Orne'),
('62',	'17',	'Pas de Calais'),
('63',	'3',	'Puy de D&ocirc;me'),
('64',	'2',	'Pyr&eacute;n&eacute;es Atlantiques'),
('65',	'16',	'Hautes Pyr&eacute;n&eacute;es'),
('66',	'13',	'Pyr&eacute;n&eacute;es Orientale'),
('67',	'1',	'Bas Rhin'),
('68',	'1',	'Haut Rhin'),
('69',	'22',	'Rh&ocirc;ne'),
('70',	'10',	'Haute Sa&ocirc;ne'),
('71',	'5',	'Sa&ocirc;ne et Loire'),
('72',	'19',	'Sarthe'),
('73',	'22',	'Savoie'),
('74',	'22',	'Haute Savoie'),
('75',	'12',	'Paris'),
('76',	'11',	'Seine Maritime'),
('77',	'12',	'Seine et Marne'),
('78',	'12',	'Yvelines'),
('79',	'21',	'Deux S&egrave;vres'),
('80',	'20',	'Somme'),
('81',	'16',	'Tarn'),
('82',	'16',	'Tarn et Garonne'),
('83',	'18',	'Var'),
('84',	'18',	'Vaucluse'),
('85',	'19',	'Vend&eacute;e'),
('86',	'21',	'Vienne'),
('87',	'14',	'Haute Vienne'),
('88',	'15',	'Vosge'),
('89',	'5',	'Yonne'),
('90',	'10',	'Territoire de Belfort'),
('91',	'12',	'Essonne'),
('92',	'12',	'Haut de seine'),
('93',	'12',	'Seine Saint Denis'),
('94',	'12',	'Val de Marne'),
('95',	'12',	'Val d\'Oise');

DROP TABLE IF EXISTS `discussion_tchat`;
CREATE TABLE `discussion_tchat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `identifiant` int NOT NULL,
  `id_pays` int NOT NULL,
  `commentaire` text NOT NULL,
  `heure_creation` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `duo_membres_connecter`;
CREATE TABLE `duo_membres_connecter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_membre` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `echange_voiture_en`;
CREATE TABLE `echange_voiture_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `echange_voiture_en` (`id`, `element`) VALUES
(1,	'yes'),
(2,	'no');

DROP TABLE IF EXISTS `echange_voiture_es`;
CREATE TABLE `echange_voiture_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `echange_voiture_es` (`id`, `element`) VALUES
(1,	'si'),
(2,	'no');

DROP TABLE IF EXISTS `echange_voiture_fr`;
CREATE TABLE `echange_voiture_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `echange_voiture_fr` (`id`, `element`) VALUES
(1,	'oui'),
(2,	'non');

DROP TABLE IF EXISTS `ecrire_newsletter`;
CREATE TABLE `ecrire_newsletter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contenu` text NOT NULL,
  `date_enregist` int NOT NULL,
  `valider` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `galerie_photos`;
CREATE TABLE `galerie_photos` (
  `identifiant` int NOT NULL,
  `img` text NOT NULL,
  `controle` int NOT NULL,
  PRIMARY KEY (`identifiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `garage_en`;
CREATE TABLE `garage_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `garage_en` (`id`, `element`) VALUES
(1,	'yes'),
(2,	'no');

DROP TABLE IF EXISTS `garage_es`;
CREATE TABLE `garage_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `garage_es` (`id`, `element`) VALUES
(1,	'si'),
(2,	'no');

DROP TABLE IF EXISTS `garage_fr`;
CREATE TABLE `garage_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `garage_fr` (`id`, `element`) VALUES
(1,	'oui'),
(2,	'non');

DROP TABLE IF EXISTS `grille_tarifaire`;
CREATE TABLE `grille_tarifaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `partie` varchar(3) NOT NULL,
  `jour` int NOT NULL,
  `montant` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `grille_tarifaire` (`id`, `partie`, `jour`, `montant`) VALUES
(1,	'A',	1,	'1.00'),
(2,	'A',	3,	'3.00'),
(3,	'A',	5,	'5.00'),
(4,	'A',	7,	'6.50'),
(5,	'A',	10,	'9.00'),
(6,	'A',	15,	'13.50'),
(7,	'A',	20,	'17.50'),
(8,	'A',	30,	'25.00'),
(9,	'B',	1,	'0.90'),
(10,	'B',	3,	'2.70'),
(11,	'B',	5,	'4.50'),
(12,	'B',	7,	'5.80'),
(13,	'B',	10,	'8.00'),
(14,	'B',	15,	'12.00'),
(15,	'B',	20,	'15.50'),
(16,	'B',	30,	'22.00'),
(17,	'C',	1,	'0.70'),
(18,	'C',	3,	'2.10'),
(19,	'C',	5,	'3.50'),
(20,	'C',	7,	'4.40'),
(21,	'C',	10,	'6.00'),
(22,	'C',	15,	'9.00'),
(23,	'C',	20,	'11.50'),
(24,	'C',	30,	'16.00'),
(25,	'D',	1,	'0.50'),
(26,	'D',	3,	'1.50'),
(27,	'D',	5,	'2.50'),
(28,	'D',	7,	'3.00'),
(29,	'D',	10,	'4.00'),
(30,	'D',	15,	'6.00'),
(31,	'D',	20,	'7.50'),
(32,	'D',	30,	'10.00');

DROP TABLE IF EXISTS `handicape_en`;
CREATE TABLE `handicape_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `handicape_en` (`id`, `element`) VALUES
(1,	'yes'),
(2,	'no');

DROP TABLE IF EXISTS `handicape_es`;
CREATE TABLE `handicape_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `handicape_es` (`id`, `element`) VALUES
(1,	'si'),
(2,	'no');

DROP TABLE IF EXISTS `handicape_fr`;
CREATE TABLE `handicape_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `handicape_fr` (`id`, `element`) VALUES
(1,	'oui'),
(2,	'non');

DROP TABLE IF EXISTS `historique_paiement`;
CREATE TABLE `historique_paiement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `type_abonnement` varchar(40) NOT NULL,
  `abonnement` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `identite`;
CREATE TABLE `identite` (
  `identifiant` int NOT NULL,
  `nom` varchar(80) NOT NULL,
  `prenom` varchar(80) NOT NULL,
  `adresse` varchar(80) NOT NULL,
  `code_postal` varchar(20) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `pays` int NOT NULL,
  `type_echange` int NOT NULL,
  PRIMARY KEY (`identifiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `informations_direct`;
CREATE TABLE `informations_direct` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_client` int NOT NULL,
  `pseudo_client` varchar(100) NOT NULL,
  `element` text NOT NULL,
  `langue` varchar(20) NOT NULL,
  `date_creation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `inscription`;
CREATE TABLE `inscription` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(30) NOT NULL,
  `passe` varchar(250) NOT NULL,
  `date_inscription` varchar(250) NOT NULL,
  `email` varchar(150) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `compte_actif` int NOT NULL,
  `type_annonce` varchar(30) NOT NULL,
  `id_annonce` int NOT NULL,
  `en_ligne` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `jardin_en`;
CREATE TABLE `jardin_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `jardin_en` (`id`, `element`) VALUES
(1,	'yes'),
(2,	'no');

DROP TABLE IF EXISTS `jardin_es`;
CREATE TABLE `jardin_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `jardin_es` (`id`, `element`) VALUES
(1,	'si'),
(2,	'no');

DROP TABLE IF EXISTS `jardin_fr`;
CREATE TABLE `jardin_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `jardin_fr` (`id`, `element`) VALUES
(1,	'oui'),
(2,	'non');

DROP TABLE IF EXISTS `liste_connectes_tchat`;
CREATE TABLE `liste_connectes_tchat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `identifiant` int NOT NULL,
  `id_pays` int NOT NULL,
  `heure_entree` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `listing_couchsurfing`;
CREATE TABLE `listing_couchsurfing` (
  `identifiant` int NOT NULL,
  `date1` varchar(20) NOT NULL,
  `date2` varchar(20) NOT NULL,
  `situation` int NOT NULL,
  `type_logement` int NOT NULL,
  `niveau` int NOT NULL,
  `capacite` int NOT NULL,
  `ch_adulte` int NOT NULL,
  `ch_enfant` int NOT NULL,
  `canape` int NOT NULL,
  `sdb` int NOT NULL,
  `cuisine` int NOT NULL,
  `terrasse` int NOT NULL,
  `barbecue` int NOT NULL,
  `jardin` int NOT NULL,
  `piscine` int NOT NULL,
  `velo` int NOT NULL,
  `garage` int NOT NULL,
  `animaux` int NOT NULL,
  `voiture` int NOT NULL,
  `handicape` int NOT NULL,
  `fumeur` int NOT NULL,
  `commentaire1` text NOT NULL,
  `commentaire2` text NOT NULL,
  `date3` varchar(20) NOT NULL,
  `date4` varchar(20) NOT NULL,
  `destination1` varchar(80) NOT NULL,
  `destination2` varchar(80) NOT NULL,
  `destination3` varchar(80) NOT NULL,
  `destination4` varchar(80) NOT NULL,
  `type_rech1` int NOT NULL,
  `type_rech2` int NOT NULL,
  `type_rech3` int NOT NULL,
  `type_rech4` int NOT NULL,
  `capac_rech` int NOT NULL,
  `fumeur_rech` int NOT NULL,
  `velo_rech` int NOT NULL,
  `voiture_rech` int NOT NULL,
  PRIMARY KEY (`identifiant`),
  FULLTEXT KEY `cle_fulltext` (`destination1`,`commentaire1`,`commentaire2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `listing_echange_maison`;
CREATE TABLE `listing_echange_maison` (
  `identifiant` int NOT NULL,
  `date1` varchar(20) NOT NULL,
  `date2` varchar(20) NOT NULL,
  `situation` int NOT NULL,
  `type_logement` int NOT NULL,
  `niveau` int NOT NULL,
  `capacite` int NOT NULL,
  `ch_adulte` int NOT NULL,
  `ch_enfant` int NOT NULL,
  `canape` int NOT NULL,
  `sdb` int NOT NULL,
  `cuisine` int NOT NULL,
  `terrasse` int NOT NULL,
  `barbecue` int NOT NULL,
  `jardin` int NOT NULL,
  `piscine` int NOT NULL,
  `velo` int NOT NULL,
  `garage` int NOT NULL,
  `animaux` int NOT NULL,
  `voiture` int NOT NULL,
  `handicape` int NOT NULL,
  `fumeur` int NOT NULL,
  `commentaire1` text NOT NULL,
  `commentaire2` text NOT NULL,
  `date3` varchar(20) NOT NULL,
  `date4` varchar(20) NOT NULL,
  `destination1` varchar(80) NOT NULL,
  `destination2` varchar(80) NOT NULL,
  `destination3` varchar(80) NOT NULL,
  `destination4` varchar(80) NOT NULL,
  `type_rech1` int NOT NULL,
  `type_rech2` int NOT NULL,
  `type_rech3` int NOT NULL,
  `type_rech4` int NOT NULL,
  `capac_rech` int NOT NULL,
  `fumeur_rech` int NOT NULL,
  `velo_rech` int NOT NULL,
  `voiture_rech` int NOT NULL,
  PRIMARY KEY (`identifiant`),
  FULLTEXT KEY `cle_fulltext` (`destination1`,`commentaire1`,`commentaire2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `livre_dor`;
CREATE TABLE `livre_dor` (
  `id_livre_dor` mediumint NOT NULL AUTO_INCREMENT,
  `commentaire_livre_dor` text NOT NULL,
  `pseudo_livre_dor` varchar(50) NOT NULL,
  `accepter_message` varchar(5) NOT NULL,
  `date_livre_dor` varchar(50) NOT NULL,
  PRIMARY KEY (`id_livre_dor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `logement_fumeur_en`;
CREATE TABLE `logement_fumeur_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `logement_fumeur_en` (`id`, `element`) VALUES
(1,	'yes'),
(2,	'no');

DROP TABLE IF EXISTS `logement_fumeur_es`;
CREATE TABLE `logement_fumeur_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `logement_fumeur_es` (`id`, `element`) VALUES
(1,	'si'),
(2,	'no');

DROP TABLE IF EXISTS `logement_fumeur_fr`;
CREATE TABLE `logement_fumeur_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `logement_fumeur_fr` (`id`, `element`) VALUES
(1,	'oui'),
(2,	'non');

DROP TABLE IF EXISTS `membres_connectes`;
CREATE TABLE `membres_connectes` (
  `identifiant` int NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `passe` varchar(60) NOT NULL,
  `connexion` int NOT NULL,
  `deconnexion` int NOT NULL,
  `email` varchar(150) NOT NULL,
  `type_annonce` varchar(30) NOT NULL,
  `id_annonce` int NOT NULL,
  `en_ligne` varchar(10) NOT NULL,
  PRIMARY KEY (`identifiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `messagerie`;
CREATE TABLE `messagerie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `msg_parent` int NOT NULL,
  `id_expediteur` int NOT NULL,
  `pseudo_expediteur` varchar(40) NOT NULL,
  `id_destinataire` int NOT NULL,
  `pseudo_destinataire` varchar(40) NOT NULL,
  `date_creation` int NOT NULL,
  `msg_texte` text NOT NULL,
  `msg_audio` varchar(250) NOT NULL,
  `msg_video` varchar(250) NOT NULL,
  `suppression` varchar(20) NOT NULL,
  `lu` varchar(20) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `messages_alerte`;
CREATE TABLE `messages_alerte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(255) NOT NULL,
  `langue` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `messages_alerte` (`id`, `element`, `langue`) VALUES
(1,	'Votre correspondant n\'a pas encore lu votre dernier message!',	'fr'),
(2,	'Votre correspondant est sur le tchat!',	'fr'),
(3,	'Votre correspondant est sur le salon 4 webcams, vous ne pouvez donc pas lui envoyer de messages si vous voulez le contacter rejoins-le sur le salon.',	'fr'),
(4,	'Vous ne pouvez demander qu\'une seule demande de tchat a la fois! Si vous voulez maintenir votre premi?re demande cliquez sur 1er demande. Si vous voulez confirmer votre nouvelle demande de tchat cliquer sur nouvelle demandeI',	'fr'),
(5,	'Confirmer votre annulation demande tchat',	'fr'),
(6,	'Votre demande de tchat est toujours en cours...',	'fr'),
(7,	'Vous ne pouvez pas contacter ce membre, vous avez ?t? blacklist',	'fr'),
(8,	'Vous ne pouvez pas contacter ce membre.<br />Il vient de vous contacter, contr?lez votre espace contacts instantan?s !',	'fr'),
(9,	'Attention... ce pseudo est inconnu...',	'fr'),
(10,	'Vous avez un message non lu de ce membre dans votre boite de messagerie !',	'fr'),
(11,	'Votre correspondant n\'est pas actuellement connect? !',	'fr');

DROP TABLE IF EXISTS `messenger`;
CREATE TABLE `messenger` (
  `id` int NOT NULL AUTO_INCREMENT,
  `msg_parent` int NOT NULL,
  `id_expediteur` int NOT NULL,
  `pseudo_expediteur` varchar(40) NOT NULL,
  `id_destinataire` int NOT NULL,
  `pseudo_destinataire` varchar(40) NOT NULL,
  `date_creation` int NOT NULL,
  `msg_texte` text NOT NULL,
  `msg_audio` varchar(250) NOT NULL,
  `msg_video` varchar(250) NOT NULL,
  `duo` varchar(20) NOT NULL,
  `lu` varchar(20) NOT NULL,
  `genre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `mois_en`;
CREATE TABLE `mois_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

INSERT INTO `mois_en` (`id`, `element`) VALUES
(1,	'January'),
(2,	'February'),
(3,	'March'),
(4,	'April'),
(6,	'May'),
(7,	'June'),
(8,	'July'),
(9,	'August'),
(10,	'September'),
(11,	'October'),
(12,	'November'),
(13,	'December');

DROP TABLE IF EXISTS `mois_es`;
CREATE TABLE `mois_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

INSERT INTO `mois_es` (`id`, `element`) VALUES
(1,	'Enero'),
(2,	'Febrero'),
(3,	'Marzo'),
(4,	'Abril'),
(6,	'Mayo'),
(7,	'Junio'),
(8,	'Julio'),
(9,	'Agosto'),
(10,	'Septiembre'),
(11,	'Octubre'),
(12,	'Noviembre'),
(13,	'Diciembre');

DROP TABLE IF EXISTS `mois_fr`;
CREATE TABLE `mois_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

INSERT INTO `mois_fr` (`id`, `element`) VALUES
(1,	'Janvier'),
(2,	'F?vrier'),
(3,	'Mars'),
(4,	'Avril'),
(6,	'Mai'),
(7,	'Juin'),
(8,	'Juillet'),
(9,	'Ao'),
(10,	'Septembre'),
(11,	'Octobre'),
(12,	'Novembre'),
(13,	'D?cembre');

DROP TABLE IF EXISTS `mots_cles`;
CREATE TABLE `mots_cles` (
  `id_mots` mediumint NOT NULL AUTO_INCREMENT,
  `element_mot` varchar(70) NOT NULL,
  `requete_mot` varchar(70) NOT NULL,
  `date_mot` varchar(30) NOT NULL,
  PRIMARY KEY (`id_mots`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `niveau_en`;
CREATE TABLE `niveau_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `niveau_en` (`id`, `element`) VALUES
(1,	'no level'),
(2,	'1 level'),
(3,	'2 levels'),
(4,	'3 levels'),
(5,	'more than 3 levels');

DROP TABLE IF EXISTS `niveau_es`;
CREATE TABLE `niveau_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `niveau_es` (`id`, `element`) VALUES
(1,	'No suelo'),
(2,	'1 suelo'),
(3,	'2 suelos'),
(4,	'3 suelos'),
(5,	'm?s de 3 suelos');

DROP TABLE IF EXISTS `niveau_fr`;
CREATE TABLE `niveau_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `niveau_fr` (`id`, `element`) VALUES
(1,	'Plein pied'),
(2,	'1 ?tage'),
(3,	'2 ?tages'),
(4,	'3 ?tages'),
(5,	'plus de 3 ?tages');

DROP TABLE IF EXISTS `nouveaux_inscrits`;
CREATE TABLE `nouveaux_inscrits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `identifiant` int NOT NULL,
  `date_creation` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int NOT NULL AUTO_INCREMENT,
  `genre` varchar(100) NOT NULL,
  `langue` varchar(20) NOT NULL,
  `nature` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `options` (`id`, `genre`, `langue`, `nature`) VALUES
(1,	'homme',	'fr',	1),
(2,	'femme',	'fr',	2),
(3,	'man',	'en',	1),
(4,	'woman',	'en',	2),
(5,	'mann',	'de',	1),
(8,	'frau',	'de',	2);

DROP TABLE IF EXISTS `paiement_attente_confirmation`;
CREATE TABLE `paiement_attente_confirmation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  `lien` varchar(80) NOT NULL,
  `texte` varchar(220) NOT NULL,
  `anchor` varchar(60) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `formule` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `pays_en`;
CREATE TABLE `pays_en` (
  `id` mediumint NOT NULL AUTO_INCREMENT,
  `pays` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `pays_en` (`id`, `pays`) VALUES
(1,	'Australia'),
(2,	'Canada'),
(3,	'Denmark'),
(4,	'England'),
(5,	'France'),
(6,	'Germany'),
(7,	'Ireland'),
(8,	'Italia'),
(9,	'Mexico'),
(10,	'Netherlands'),
(11,	'New Zealand'),
(12,	'Scotland'),
(13,	'South Africa'),
(14,	'Spain'),
(15,	'Sweden'),
(16,	'Switzerland'),
(17,	'United states'),
(18,	'Alaska'),
(19,	'Afghanistan'),
(20,	'Albania'),
(21,	'Algeria'),
(22,	'Samoa Islands (USA)'),
(23,	'Andorra'),
(24,	'Angola'),
(25,	'Anguilla'),
(26,	'Antigua and Barbuda'),
(27,	'Argentina'),
(28,	'Armenia'),
(29,	'Aruba'),
(30,	'Austria'),
(31,	'Azerbaidjan'),
(32,	'Bahamas'),
(33,	'Bahrain'),
(34,	'Bangladesh'),
(35,	'Barbados'),
(36,	'Belarus'),
(37,	'Belgium'),
(38,	'Belize'),
(39,	'Benin'),
(40,	'Bermude'),
(41,	'Bhutan'),
(42,	'Bolivia'),
(43,	'Bosnia-Herzegovie'),
(44,	'Botswana'),
(45,	'Bouvet Islands'),
(46,	'Brazil'),
(47,	'Indian terr. (UK)'),
(48,	'Brunei Darussalam'),
(49,	'Bulgaria'),
(50,	'Burkina Faso'),
(51,	'Burundi'),
(52,	'Cambodia'),
(53,	'Cameroon'),
(54,	'Cap Verde'),
(55,	'Cayman Islands'),
(56,	'Central African'),
(57,	'Chad'),
(58,	'Chile'),
(59,	'China'),
(60,	'Christmas Islands'),
(61,	'Cocos Islands'),
(62,	'Colombia'),
(63,	'Comores Islands'),
(64,	'Congo'),
(65,	'Cook Islands'),
(66,	'Costa Rica'),
(67,	'Croatia'),
(68,	'Cuba'),
(69,	'Cyprus'),
(70,	'Canary Islands'),
(71,	'Czechoslovakia'),
(72,	'Djibouti'),
(73,	'Dominica'),
(74,	'Dominican Republic'),
(75,	'Timor East'),
(76,	'Ecuador'),
(77,	'Egypt'),
(78,	'Salvador'),
(79,	'Equatorial Guinea'),
(80,	'Eritrea'),
(81,	'Estonia'),
(82,	'Ethiopia'),
(83,	'Falkland Islands'),
(84,	'Faroe Islands'),
(85,	'Fiji Islands'),
(86,	'Finland'),
(87,	'St Barthelemy'),
(88,	'Gabon'),
(89,	'Gambia'),
(90,	'Georgia'),
(91,	'Ghana'),
(92,	'Gibraltar'),
(93,	'Greece'),
(94,	'Greenland'),
(95,	'Grenada'),
(96,	'Guadeloupe Islands'),
(97,	'Guam (USA)'),
(98,	'Guatemala'),
(99,	'Guin'),
(100,	'Guinea Bissau'),
(101,	'Guyana'),
(102,	'Guyane (Fr.)'),
(103,	'Haiti'),
(104,	'Heard and McDonald'),
(105,	'Holland'),
(106,	'Honduras'),
(107,	'Hong Kong'),
(108,	'Hungary'),
(109,	'Iceland'),
(110,	'India'),
(111,	'Indonesia'),
(112,	'Iran'),
(113,	'Iraq'),
(114,	'Israel'),
(115,	'Ivory cost'),
(116,	'Jamaica'),
(117,	'Japan'),
(118,	'Jordania'),
(119,	'Kazachstan'),
(120,	'Kenya'),
(121,	'Kiribati'),
(122,	'North Korea'),
(123,	'South Korea'),
(124,	'Koweit'),
(125,	'Kyrgyz republic'),
(126,	'Laos'),
(127,	'Lettonia'),
(128,	'Lebanon'),
(129,	'Lesotho'),
(130,	'Liberia'),
(131,	'Libya'),
(132,	'Liechtenstein'),
(133,	'Lithuania'),
(134,	'Luxembourg'),
(135,	'Macau'),
(136,	'Macedonia'),
(137,	'Madagascar'),
(138,	'Malawie'),
(139,	'Malaysia'),
(140,	'Maldives Islands'),
(141,	'Mali'),
(142,	'Malta'),
(143,	'Marshall Islands'),
(144,	'Martinique Islands'),
(145,	'Mauritania'),
(146,	'Maurice Islands'),
(147,	'Mayotte Islands'),
(148,	'Micronesia'),
(149,	'Moldovia'),
(150,	'Monaco'),
(151,	'Mongolia'),
(152,	'Montserrat'),
(153,	'Morocco'),
(154,	'Mozambique'),
(155,	'Myanmar'),
(156,	'Namibia'),
(157,	'Nauru'),
(158,	'Nepal'),
(159,	'Antilles (Netherlands)'),
(160,	'New Caledonia'),
(161,	'Nicaragua'),
(162,	'Niger'),
(163,	'Nigeria'),
(164,	'Niue'),
(165,	'Norfolk Islands'),
(166,	'North Irland (UK)'),
(167,	'North Mariana Islands'),
(168,	'Norway'),
(169,	'Oman'),
(170,	'Pakistan'),
(171,	'Palau'),
(172,	'Panama'),
(173,	'New Guinea'),
(174,	'Paraguay'),
(175,	'Peru'),
(176,	'Philippines'),
(177,	'Pitcairn'),
(178,	'Poland'),
(179,	'Polynesia'),
(180,	'Portugal'),
(181,	'Mariannes Islands'),
(182,	'Puerto Rico (US)'),
(183,	'Qatar'),
(184,	'Man Islands'),
(185,	'Reunion Islands'),
(186,	'Roumania'),
(187,	'Russia'),
(188,	'Rwanda'),
(189,	'Sainte Lucie'),
(190,	'Samoa Islands'),
(191,	'San Marino Islands'),
(192,	'Saudi arabia'),
(193,	'Senegal'),
(194,	'Seychelles Islands'),
(195,	'Sierra Leone'),
(196,	'Singapore'),
(197,	'Slovakia'),
(198,	'Slovenia'),
(199,	'Salomon Islands'),
(200,	'Somalia'),
(201,	'South Georgia'),
(202,	'Sri Lanka'),
(203,	'St. Helena'),
(204,	'Kitts Nevis Anguilla'),
(205,	'St. Martin Islands'),
(206,	'St. Pierre and Miquelon'),
(207,	'Tome and Principe'),
(208,	'Vincent and Grenadines'),
(209,	'Sudan'),
(210,	'Suriname'),
(211,	'Svalbard and Jan Mayen'),
(212,	'Swaziland'),
(213,	'Syria'),
(214,	'Tadjikistan'),
(215,	'Taiwan'),
(216,	'Tanzania'),
(217,	'Thailand'),
(218,	'Togo'),
(219,	'Tokelau'),
(220,	'Tonga'),
(221,	'Trinidad and Tobago'),
(222,	'Tunisia'),
(223,	'Turkey'),
(224,	'Turkmenistan'),
(225,	'Turks and Caicos'),
(226,	'Tuvalu'),
(227,	'Ouganda'),
(228,	'Ukraine'),
(229,	'Arab emirates'),
(230,	'Uruguay'),
(231,	'US Minor outlying'),
(232,	'Uzbekistan'),
(233,	'Vanuatu Islands'),
(234,	'Vatican City State'),
(235,	'Venezuela'),
(236,	'Vietnam'),
(237,	'Virgin Islands (UK)'),
(238,	'Virgin Islands  (US)'),
(239,	'Wales Islands  (UK)'),
(240,	'Wallis and Futuna'),
(241,	'Western Sahara'),
(242,	'Yemen'),
(243,	'Yougoslavia'),
(244,	'Zaire'),
(245,	'Zambia'),
(246,	'Zimbabwe'),
(247,	'Madeira');

DROP TABLE IF EXISTS `pays_es`;
CREATE TABLE `pays_es` (
  `id` mediumint NOT NULL AUTO_INCREMENT,
  `pays` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `pays_es` (`id`, `pays`) VALUES
(1,	'Australia'),
(2,	'Canada'),
(3,	'Dinamarca'),
(4,	'Inglaterra'),
(5,	'Francia'),
(6,	'Alemania'),
(7,	'Irelande'),
(8,	'Italia'),
(9,	'M?xico'),
(10,	'Pa?ses Bajos'),
(11,	'Nueva Zelandia'),
(12,	'Escocia'),
(13,	'Sud?frica'),
(14,	'Espa'),
(15,	'Suecia'),
(16,	'Suiza'),
(17,	'Estados Unidos'),
(18,	'Alaska'),
(19,	'Afganist'),
(20,	'Albania'),
(21,	'Argelia'),
(22,	'Islas Samoa (US)'),
(23,	'Andorre'),
(24,	'Angola'),
(25,	'Anguila'),
(26,	'Antigua y Barbuda'),
(27,	'Argentina'),
(28,	'Armenia'),
(29,	'Aruba'),
(30,	'Austria'),
(31,	'Azerbaiy'),
(32,	'Bahamas'),
(33,	'Bahrein'),
(34,	'Bangladesh'),
(35,	'Barbados'),
(36,	'Bielorrusia'),
(37,	'B?lgica'),
(38,	'Belice'),
(39,	'Benin'),
(40,	'Bermude'),
(41,	'Bhutan'),
(42,	'Bolivia'),
(43,	'Bosnia y Herzegovina'),
(44,	'Botswana'),
(45,	'Bouvet Islas'),
(46,	'Brasil'),
(47,	'Terr. Indian (UK)'),
(48,	'Brunei Darussalam'),
(49,	'Bulgaria'),
(50,	'Burkina Faso'),
(51,	'Burundi'),
(52,	'Camboya'),
(53,	'Camer'),
(54,	'Cabo Verde'),
(55,	'Islas Caim'),
(56,	'Africa Central'),
(57,	'Chad'),
(58,	'Chile'),
(59,	'China'),
(60,	'Navidad Islas'),
(61,	'Islas Cocos'),
(62,	'Colombia'),
(63,	'Islas Comores'),
(64,	'Congo'),
(65,	'Islas Cook'),
(66,	'Costa Rica'),
(67,	'Croacia'),
(68,	'Cuba'),
(69,	'Chipre'),
(70,	'Islas Canarias'),
(71,	'Checoslovaquia'),
(72,	'Djibouti'),
(73,	'Dominica'),
(74,	'Rep?blica Dominicana'),
(75,	'Timor Oriental'),
(76,	'Ecuador'),
(77,	'Egipto'),
(78,	'El Salvador'),
(79,	'Guinea Ecuatorial'),
(80,	'Eritrea'),
(81,	'Estonia'),
(82,	'Etiop'),
(83,	'Islas Falkland'),
(84,	'Islas Faroe'),
(85,	'Islas Fiji'),
(86,	'Finlandia'),
(87,	'San Bartolom'),
(88,	'Gab'),
(89,	'Gambia'),
(90,	'Georgia'),
(91,	'Ghana'),
(92,	'Gibraltar'),
(93,	'Grecia'),
(94,	'Groenlandia'),
(95,	'Grenada'),
(96,	'Guadalupe Islas'),
(97,	'Guam (USA)'),
(98,	'Guatemala'),
(99,	'Guinea'),
(100,	'Guinea Bissau'),
(101,	'Guyana'),
(102,	'Guyana (Fr.)'),
(103,	'Haiti'),
(104,	'Heard y McDonald'),
(105,	'Holanda'),
(106,	'Honduras'),
(107,	'Hong Kong'),
(108,	'Hungr'),
(109,	'Islandia'),
(110,	'India'),
(111,	'Indonesia'),
(112,	'Ir'),
(113,	'Iraq'),
(114,	'Israel'),
(115,	'Costo de Marfil'),
(116,	'Jamaica'),
(117,	'Jap'),
(118,	'Jordania'),
(119,	'Kazajst'),
(120,	'Kenya'),
(121,	'Kiribati'),
(122,	'Corea del Norte'),
(123,	'Corea del Sur'),
(124,	'Koweit'),
(125,	'Rep?blica Kirguisa'),
(126,	'Laos'),
(127,	'Lettonia'),
(128,	'L?bano'),
(129,	'Lesotho'),
(130,	'Liberia'),
(131,	'Libia'),
(132,	'Liechtenstein'),
(133,	'Lithuania'),
(134,	'Luxemburgo'),
(135,	'Macao'),
(136,	'Macedonia'),
(137,	'Madagascar'),
(138,	'Malawie'),
(139,	'Malaysia'),
(140,	'Islas Maldivas'),
(141,	'Mali'),
(142,	'Malte'),
(143,	'Islas Marshall'),
(144,	'Islas Martinica'),
(145,	'Mauritania'),
(146,	'Islas Maurice'),
(147,	'Islas Mayotte'),
(148,	'Micronesia'),
(149,	'Moldovia'),
(150,	'Monaco'),
(151,	'Mongolia'),
(152,	'Montserrat'),
(153,	'Marruecos'),
(154,	'Mozambique'),
(155,	'Myanmar'),
(156,	'Namibia'),
(157,	'Nauru'),
(158,	'Nepal'),
(159,	'Antillas (Pa?ses Bajos)'),
(160,	'Nueva Caledonia'),
(161,	'Nicaragua'),
(162,	'Niger'),
(163,	'Nigeria'),
(164,	'Niue'),
(165,	'Islas Norfolk'),
(166,	'Irlanda del Norte (UK)'),
(167,	'Islas Marianas del Norte'),
(168,	'Noruega'),
(169,	'Om'),
(170,	'Pakist'),
(171,	'Palau'),
(172,	'Panam'),
(173,	'Nueva Guinea'),
(174,	'Paraguay'),
(175,	'Per'),
(176,	'Filipinas'),
(177,	'Pitcairn'),
(178,	'Polonia'),
(179,	'Polinesia'),
(180,	'Portugal'),
(181,	'Islas Mariannes'),
(182,	'Puerto Rico (US)'),
(183,	'Qatar'),
(184,	'Islas Man'),
(185,	'Islas Reuni'),
(186,	'Rumania'),
(187,	'Rusia'),
(188,	'Rwanda'),
(189,	'San Lucie'),
(190,	'Islas Samoa'),
(191,	'Islas San Marino'),
(192,	'Arabia Saudita'),
(193,	'Senegal'),
(194,	'Islas Seychelles'),
(195,	'Sierra Leona'),
(196,	'Singapur'),
(197,	'Eslovaquia'),
(198,	'Eslovenia'),
(199,	'Islas Salomon'),
(200,	'Somalia'),
(201,	'Georgia del Sur'),
(202,	'Sri Lanka'),
(203,	'Santa Elena'),
(204,	'Kitts Nevis Anguila'),
(205,	'Islas de San Mart'),
(206,	'San Pedro y Miquel'),
(207,	'Tome y Principe'),
(208,	'Vicente y Granadinas'),
(209,	'Sud'),
(210,	'Surinam'),
(211,	'Svalbard y Jan Mayen'),
(212,	'Swazilandia'),
(213,	'Siria'),
(214,	'Tayikist'),
(215,	'Taiwan'),
(216,	'Tanzania'),
(217,	'Tailandia'),
(218,	'Togo'),
(219,	'Tokelau'),
(220,	'Tonga'),
(221,	'Trinidad y Tobago'),
(222,	'T?nez'),
(223,	'Turqu'),
(224,	'Turkmenist'),
(225,	'Turcas y Caicos'),
(226,	'Tuvalu'),
(227,	'Ouganda'),
(228,	'Ucrania'),
(229,	'Emiratos ?rabes'),
(230,	'Uruguay'),
(231,	'Menores de la periferia US'),
(232,	'Uzbekist'),
(233,	'Islas Vanuatu'),
(234,	'Ciudad del Vaticano'),
(235,	'Venezuela'),
(236,	'Vietnam'),
(237,	'Islas V?rgenes (UK)'),
(238,	'Islas V?rgenes (US)'),
(239,	'Gales Islas (UK)'),
(240,	'Wallis y Futuna'),
(241,	'S?hara Occidental'),
(242,	'Yemen'),
(243,	'Yougoslavia'),
(244,	'Zaire'),
(245,	'Zambia'),
(246,	'Zimbabwe'),
(247,	'Madeira');

DROP TABLE IF EXISTS `pays_fr`;
CREATE TABLE `pays_fr` (
  `id` mediumint NOT NULL AUTO_INCREMENT,
  `pays` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `pays_fr` (`id`, `pays`) VALUES
(1,	'Australie'),
(2,	'Canada'),
(3,	'Danemark'),
(4,	'Angleterre'),
(5,	'France'),
(6,	'Allemagne'),
(7,	'Irelande'),
(8,	'Italie'),
(9,	'Mexique'),
(10,	'Pays-Bas'),
(11,	'Nouvelle-Z?lande'),
(12,	'Ecosse'),
(13,	'Afrique du Sud'),
(14,	'Espagne'),
(15,	'Su?de'),
(16,	'Suisse'),
(17,	'Etats-unis'),
(18,	'Alaska'),
(19,	'Afghanistan'),
(20,	'Albanie'),
(21,	'Alg?rie'),
(22,	'Iles Samoa (USA)'),
(23,	'Andorre'),
(24,	'Angola'),
(25,	'Anguilla'),
(26,	'Antigua et Barbuda'),
(27,	'Argentine'),
(28,	'Arm?nie'),
(29,	'Aruba'),
(30,	'Autriche'),
(31,	'Azerbaidjan'),
(32,	'Bahamas'),
(33,	'Bahrain'),
(34,	'Bangladesh'),
(35,	'Barbados'),
(36,	'Belarus'),
(37,	'Belgique'),
(38,	'Belize'),
(39,	'Benin'),
(40,	'Bermude'),
(41,	'Bhutan'),
(42,	'Bolivie'),
(43,	'Bosnie-Herz?govie'),
(44,	'Botswana'),
(45,	'Ile de Bouvet'),
(46,	'Br?sil'),
(47,	'Terr. Indien (UK)'),
(48,	'Brunei Darussalam'),
(49,	'Bulgarie'),
(50,	'Burkina Faso'),
(51,	'Burundi'),
(52,	'Cambodge'),
(53,	'Cameroon'),
(54,	'Cap Vert'),
(55,	'Iles Cayman'),
(56,	'Centrafricaine '),
(57,	'Chad'),
(58,	'Chili'),
(59,	'Chine'),
(60,	'Iles Christmas'),
(61,	'Iles Cocos'),
(62,	'Colombie'),
(63,	'Comores'),
(64,	'Congo'),
(65,	'Iles Cook'),
(66,	'Costa Rica'),
(67,	'Croatie'),
(68,	'Cuba'),
(69,	'Chypre'),
(70,	'Iles Canaries'),
(71,	'Tch?coslovaquie'),
(72,	'Djibouti'),
(73,	'Dominica'),
(74,	'R?p. Dominicaine'),
(75,	'Timor Est'),
(76,	'Equateur'),
(77,	'Egypte'),
(78,	'Le Salvador'),
(79,	'Guin?e ?quatoriale'),
(80,	'Eritrea'),
(81,	'Estonie'),
(82,	'Ethiopie'),
(83,	'Iles Falkland'),
(84,	'Iles Faroe'),
(85,	'Iles Fiji'),
(86,	'Finlande'),
(87,	'St Barth?l?my'),
(88,	'Gabon'),
(89,	'Gambie'),
(90,	'Georgie'),
(91,	'Ghana'),
(92,	'Gibraltar'),
(93,	'Gr?ce'),
(94,	'Groenland'),
(95,	'Grenada'),
(96,	'Ile Guadeloupe'),
(97,	'Guam (USA)'),
(98,	'Guatemala'),
(99,	'Guin'),
(100,	'Guin?e Bissau'),
(101,	'Guyana'),
(102,	'Guyane (Fr.)'),
(103,	'Haiti'),
(104,	'Heard et McDonald'),
(105,	'Hollande'),
(106,	'Honduras'),
(107,	'Hong Kong'),
(108,	'Hongrie'),
(109,	'Islande'),
(110,	'Inde'),
(111,	'Indon?sie'),
(112,	'Iran'),
(113,	'Iraq'),
(114,	'Israel'),
(115,	'C?te d\'Ivoire'),
(116,	'Jamaique'),
(117,	'Japon'),
(118,	'Jordanie'),
(119,	'Kazachstan'),
(120,	'Kenya'),
(121,	'Kiribati'),
(122,	'Kor?e (Nord)'),
(123,	'Kor?e (Sud)'),
(124,	'Koweit'),
(125,	'R?pub.Kyrgyz'),
(126,	'Laos'),
(127,	'Lettonie'),
(128,	'Liban'),
(129,	'Lesotho'),
(130,	'Lib?ria'),
(131,	'Libye'),
(132,	'Liechtenstein'),
(133,	'Lithuanie'),
(134,	'Luxembourg'),
(135,	'Macau'),
(136,	'Mac?doine'),
(137,	'Madagascar'),
(138,	'Malawie'),
(139,	'Malaysie'),
(140,	'Maldives'),
(141,	'Mali'),
(142,	'Malte'),
(143,	'Iles Marshall'),
(144,	'Ile Martinique'),
(145,	'Mauritanie'),
(146,	'Ile Maurice'),
(147,	'Ile Mayotte'),
(148,	'Micron?sie'),
(149,	'Moldovie'),
(150,	'Monaco'),
(151,	'Mongolie'),
(152,	'Montserrat'),
(153,	'Maroc'),
(154,	'Mozambique'),
(155,	'Myanmar'),
(156,	'Namibie'),
(157,	'Nauru'),
(158,	'N?pal'),
(159,	'Antilles (Pays-Bas)'),
(160,	'Nouvelle-Cal?donie'),
(161,	'Nicaragua'),
(162,	'Niger'),
(163,	'Nig?ria'),
(164,	'Niue'),
(165,	'Ile Norfolk'),
(166,	'Nord Irelande (UK)'),
(167,	'Nord Ile Mariana'),
(168,	'Norv?ge'),
(169,	'Oman'),
(170,	'Pakistan'),
(171,	'Palau'),
(172,	'Panama'),
(173,	'Nouvelle-Guin'),
(174,	'Paraguay'),
(175,	'P?rou'),
(176,	'Philippines'),
(177,	'Pitcairn'),
(178,	'Pologne'),
(179,	'Polyn?sie'),
(180,	'Portugal'),
(181,	'Iles Mariannes'),
(182,	'Puerto Rico (US)'),
(183,	'Qatar'),
(184,	'Ile de Man'),
(185,	'Ile R?union'),
(186,	'Roumanie'),
(187,	'Russie'),
(188,	'Rwanda'),
(189,	'Sainte Lucie'),
(190,	'Ile Samoa'),
(191,	'Ile San Marino'),
(192,	'Arabie Saoudite'),
(193,	'S?n?gal'),
(194,	'Iles Seychelles'),
(195,	'Sierra Leone'),
(196,	'Singapour'),
(197,	'Slovaquie'),
(198,	'Slov?nie'),
(199,	'Iles Salomon'),
(200,	'Somalie'),
(201,	'Georgie du sud'),
(202,	'Sri Lanka'),
(203,	'St. H?l?ne'),
(204,	'Kitts Nevis Anguilla'),
(205,	'St. Martin'),
(206,	'St. Pierre et Miquelon'),
(207,	'Tome et Principe'),
(208,	'Vincent et Grenadines'),
(209,	'Soudan'),
(210,	'Suriname'),
(211,	'Svalbard et Jan Mayen'),
(212,	'Swaziland'),
(213,	'Syrie'),
(214,	'Tadjikistan'),
(215,	'Taiwan'),
(216,	'Tanzanie'),
(217,	'Thailande'),
(218,	'Togo'),
(219,	'Tokelau'),
(220,	'Tonga'),
(221,	'Trinidad et Tobago'),
(222,	'Tunisie'),
(223,	'Turquie'),
(224,	'Turkmenistan'),
(225,	'Turks and Caicos'),
(226,	'Tuvalu'),
(227,	'Ouganda'),
(228,	'Ukraine'),
(229,	'Emirats Arabes'),
(230,	'Uruguay'),
(231,	'US Minor outlying'),
(232,	'Uzbekistan'),
(233,	'Iles Vanuatu'),
(234,	'Vatican City State'),
(235,	'V?n?zuela'),
(236,	'Vietnam'),
(237,	'Iles Virgin (UK)'),
(238,	'Iles Virgin (US)'),
(239,	'Iles Wales (UK)'),
(240,	'Wallis et Futuna'),
(241,	'Ouest Sahara'),
(242,	'Yemen'),
(243,	'Yougoslavie'),
(244,	'Zaire'),
(245,	'Zambie'),
(246,	'Zimbabwe'),
(247,	'Mad?re');

DROP TABLE IF EXISTS `piscine_en`;
CREATE TABLE `piscine_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `piscine_en` (`id`, `element`) VALUES
(1,	'yes'),
(2,	'no');

DROP TABLE IF EXISTS `piscine_es`;
CREATE TABLE `piscine_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `piscine_es` (`id`, `element`) VALUES
(1,	'si'),
(2,	'no');

DROP TABLE IF EXISTS `piscine_fr`;
CREATE TABLE `piscine_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `piscine_fr` (`id`, `element`) VALUES
(1,	'oui'),
(2,	'non');

DROP TABLE IF EXISTS `pret_velo_en`;
CREATE TABLE `pret_velo_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `pret_velo_en` (`id`, `element`) VALUES
(1,	'yes'),
(2,	'no');

DROP TABLE IF EXISTS `pret_velo_es`;
CREATE TABLE `pret_velo_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `pret_velo_es` (`id`, `element`) VALUES
(1,	'si'),
(2,	'no');

DROP TABLE IF EXISTS `pret_velo_fr`;
CREATE TABLE `pret_velo_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `pret_velo_fr` (`id`, `element`) VALUES
(1,	'oui'),
(2,	'non');

DROP TABLE IF EXISTS `relation`;
CREATE TABLE `relation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `je_suis` int NOT NULL,
  `je_recherche` int NOT NULL,
  `correspondance_je_suis` int NOT NULL,
  `correspondance_je_recherche` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `relation` (`id`, `je_suis`, `je_recherche`, `correspondance_je_suis`, `correspondance_je_recherche`) VALUES
(1,	1,	2,	2,	1),
(2,	1,	1,	1,	1),
(3,	2,	1,	1,	2),
(4,	2,	2,	2,	2);

DROP TABLE IF EXISTS `rubriques_en`;
CREATE TABLE `rubriques_en` (
  `id` mediumint NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `rubriques_en` (`id`, `element`) VALUES
(1,	'Castle exchanges'),
(2,	'Mansion exchanges'),
(3,	'Villa exchanges'),
(4,	'Home exchanges'),
(5,	'Apartment exchanges'),
(6,	'Room exchanges'),
(7,	'Guest at home'),
(8,	'Search a place');

DROP TABLE IF EXISTS `rubriques_es`;
CREATE TABLE `rubriques_es` (
  `id` mediumint NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `rubriques_es` (`id`, `element`) VALUES
(1,	'intercambio de castillo'),
(2,	'intercambio de pazo'),
(3,	'intercambio de villa'),
(4,	'intercambio de casa'),
(5,	'intercambio apartemento'),
(6,	'intercambio de piso'),
(7,	'invitar a domicilio'),
(8,	'buscar un lugar');

DROP TABLE IF EXISTS `rubriques_fr`;
CREATE TABLE `rubriques_fr` (
  `id` mediumint NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `rubriques_fr` (`id`, `element`) VALUES
(1,	'echange de ch&acirc;teau'),
(2,	'echange de manoir'),
(3,	'echange de villa'),
(4,	'echange de maison'),
(5,	'echange d&#039;appartement'),
(6,	'echange de chambre'),
(7,	'recevoir &agrave; domicile'),
(8,	'recherche h&eacute;bergement');

DROP TABLE IF EXISTS `salle_bain_en`;
CREATE TABLE `salle_bain_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `salle_bain_en` (`id`, `element`) VALUES
(1,	'1'),
(2,	'2 or more');

DROP TABLE IF EXISTS `salle_bain_es`;
CREATE TABLE `salle_bain_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `salle_bain_es` (`id`, `element`) VALUES
(1,	'1'),
(2,	'2 o m');

DROP TABLE IF EXISTS `salle_bain_fr`;
CREATE TABLE `salle_bain_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `salle_bain_fr` (`id`, `element`) VALUES
(1,	'1'),
(2,	'2 ou plus');

DROP TABLE IF EXISTS `situation_en`;
CREATE TABLE `situation_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `situation_en` (`id`, `element`) VALUES
(1,	'In city'),
(2,	'In suburbs'),
(3,	'IN countryside'),
(4,	'By seaside'),
(5,	'By mountains');

DROP TABLE IF EXISTS `situation_es`;
CREATE TABLE `situation_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `situation_es` (`id`, `element`) VALUES
(1,	'En ciudad'),
(2,	'En los suburbios'),
(3,	'En el campo'),
(4,	'En el mar'),
(5,	'En las monta');

DROP TABLE IF EXISTS `situation_fr`;
CREATE TABLE `situation_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `situation_fr` (`id`, `element`) VALUES
(1,	'En ville'),
(2,	'En banlieue'),
(3,	'A la campagne'),
(4,	'A la mer'),
(5,	'En montagne');

DROP TABLE IF EXISTS `terrasse_exterieure_en`;
CREATE TABLE `terrasse_exterieure_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `terrasse_exterieure_en` (`id`, `element`) VALUES
(1,	'yes'),
(2,	'no');

DROP TABLE IF EXISTS `terrasse_exterieure_es`;
CREATE TABLE `terrasse_exterieure_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `terrasse_exterieure_es` (`id`, `element`) VALUES
(1,	'si'),
(2,	'no');

DROP TABLE IF EXISTS `terrasse_exterieure_fr`;
CREATE TABLE `terrasse_exterieure_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `terrasse_exterieure_fr` (`id`, `element`) VALUES
(1,	'oui'),
(2,	'non');

DROP TABLE IF EXISTS `thematique`;
CREATE TABLE `thematique` (
  `id` int NOT NULL,
  `theme` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `thematique` (`id`, `theme`) VALUES
(1,	1);

DROP TABLE IF EXISTS `type_logement_en`;
CREATE TABLE `type_logement_en` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `type_logement_en` (`id`, `element`) VALUES
(1,	'Apartment'),
(2,	'House'),
(3,	'Villa'),
(4,	'Castle'),
(5,	'Mansion'),
(6,	'Caravan'),
(7,	'Motorhome');

DROP TABLE IF EXISTS `type_logement_es`;
CREATE TABLE `type_logement_es` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `type_logement_es` (`id`, `element`) VALUES
(1,	'Apartamento'),
(2,	'Casa'),
(3,	'Villa'),
(4,	'Castillo'),
(5,	'Manoir'),
(6,	'Caravana'),
(7,	'Autocaravana');

DROP TABLE IF EXISTS `type_logement_fr`;
CREATE TABLE `type_logement_fr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `type_logement_fr` (`id`, `element`) VALUES
(1,	'Appartement'),
(2,	'Maison'),
(3,	'Villa'),
(4,	'Ch?teau'),
(5,	'Manoir'),
(6,	'Caravane'),
(7,	'Camping car');

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `gratuit` int NOT NULL,
  `online` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(80) NOT NULL,
  `fichier` varchar(255) NOT NULL,
  `controle` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `webcam_duo`;
CREATE TABLE `webcam_duo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_demande` int NOT NULL,
  `pseudo_demande` varchar(50) NOT NULL,
  `id_client_accepter` int NOT NULL,
  `pseudo_client_accepter` varchar(50) NOT NULL,
  `commentaire` text NOT NULL,
  `date_debut` int NOT NULL,
  `date_cloture` int NOT NULL,
  `date_creation_message` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


-- 2025-05-16 16:04:53