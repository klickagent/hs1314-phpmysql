# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.8)
# Database: php_mysql_programmieren
# Generation Time: 2013-10-06 19:20:57 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table todos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `todos`;

CREATE TABLE `todos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `list_id` varchar(255) NOT NULL DEFAULT '',
  `text` varchar(500) NOT NULL DEFAULT '',
  `done` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `todos` WRITE;
/*!40000 ALTER TABLE `todos` DISABLE KEYS */;

INSERT INTO `todos` (`id`, `list_id`, `text`, `done`)
VALUES
	(20,'5251a309a4493','test',1),
	(21,'5251a309a4493','sss',1),
	(22,'5251a309a4493','aas',1),
	(23,'5251a309a4493','ttt',1),
	(24,'5251a309a4493','test',1),
	(25,'5251b7d753389','test',0),
	(26,'5251b7e31be87','asdfasd',0),
	(27,'5251b7e31be87','sdf',0);

/*!40000 ALTER TABLE `todos` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
