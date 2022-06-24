-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour gestion_collaborateurs
CREATE DATABASE IF NOT EXISTS `gestion_collaborateurs` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `gestion_collaborateurs`;

-- Listage de la structure de la table gestion_collaborateurs. collaborateurs
CREATE TABLE IF NOT EXISTS `collaborateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `taches` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table gestion_collaborateurs.collaborateurs : ~1 rows (environ)
/*!40000 ALTER TABLE `collaborateurs` DISABLE KEYS */;
INSERT INTO `collaborateurs` (`id`, `nom`, `prenom`, `numero`, `adresse`, `taches`, `date`) VALUES
	(1, 'duppont', 'jean', '93041051', '2 lion', 'programmeur', '2022-06-21'),
	(3, 'durant', 'moyo', '+22893041051', 'AGOE 2 LIONS', 'professeurs', '2001-02-14');
/*!40000 ALTER TABLE `collaborateurs` ENABLE KEYS */;

-- Listage de la structure de la table gestion_collaborateurs. effectuer
CREATE TABLE IF NOT EXISTS `effectuer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtaches` int(11) DEFAULT NULL,
  `idcollaborateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__taches` (`idtaches`),
  KEY `FK__collaborateurs` (`idcollaborateur`),
  CONSTRAINT `FK__collaborateurs` FOREIGN KEY (`idcollaborateur`) REFERENCES `collaborateurs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK__taches` FOREIGN KEY (`idtaches`) REFERENCES `taches` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table gestion_collaborateurs.effectuer : ~1 rows (environ)
/*!40000 ALTER TABLE `effectuer` DISABLE KEYS */;
INSERT INTO `effectuer` (`id`, `idtaches`, `idcollaborateur`) VALUES
	(1, 2, 1),
	(2, 6, 1),
	(5, 10, 1),
	(7, 1, 1),
	(8, 5, 3),
	(9, 5, 1);
/*!40000 ALTER TABLE `effectuer` ENABLE KEYS */;

-- Listage de la structure de la table gestion_collaborateurs. projets
CREATE TABLE IF NOT EXISTS `projets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table gestion_collaborateurs.projets : ~8 rows (environ)
/*!40000 ALTER TABLE `projets` DISABLE KEYS */;
INSERT INTO `projets` (`id`, `nom`, `description`, `status`) VALUES
	(2, 'application qui fait reve', 'faire une application qui fait revee', NULL),
	(3, 'alcatraz', 'voici la description du projet alcatraz', NULL),
	(4, 'moiwoe', 'wefwewr', NULL),
	(5, 'moiwoeerer', 'wefwewr', NULL),
	(6, 'ssss', 'ewwe', NULL),
	(7, 'ssssrrer', 'ewwe', NULL),
	(8, 'ssssrrerer', 'ewwe', NULL),
	(9, 'ssssrrererdf', 'ewwe', NULL);
/*!40000 ALTER TABLE `projets` ENABLE KEYS */;

-- Listage de la structure de la table gestion_collaborateurs. taches
CREATE TABLE IF NOT EXISTS `taches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `idprojet` int(11) DEFAULT NULL,
  `datefin` date DEFAULT NULL,
  `situation` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__projets` (`idprojet`),
  CONSTRAINT `FK__projets` FOREIGN KEY (`idprojet`) REFERENCES `projets` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table gestion_collaborateurs.taches : ~11 rows (environ)
/*!40000 ALTER TABLE `taches` DISABLE KEYS */;
INSERT INTO `taches` (`id`, `libelle`, `description`, `idprojet`, `datefin`, `situation`) VALUES
	(1, 'front', NULL, 2, NULL, 0),
	(2, 'back', NULL, 2, NULL, 1),
	(3, 'ww', 'wgregte', NULL, '2022-06-25', 0),
	(5, 'erer', 'sdd', 6, '2022-07-10', 0),
	(6, 'erer', 'sdd', 7, '2022-07-10', 0),
	(7, 'erer', 'sdd', 8, '2022-07-10', 0),
	(8, 'erer', 'sdd', 9, '2022-06-10', 1),
	(10, 'rt454', '45rtrytret', 9, '2022-06-24', 0);
/*!40000 ALTER TABLE `taches` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
