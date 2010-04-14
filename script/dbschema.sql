# Sequel Pro dump
# Version 1630
# http://code.google.com/p/sequel-pro
#
# Host: localhost (MySQL 5.1.38)
# Database: impersonal
# Generation Time: 2010-04-14 04:06:36 -0400
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table interpolation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `interpolation`;

CREATE TABLE `interpolation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vector` varchar(100) NOT NULL,
  `normalizedVector` varchar(100) NOT NULL,
  `length` int(11) NOT NULL DEFAULT '0',
  `orientation` double NOT NULL DEFAULT '0',
  `deviation` double NOT NULL DEFAULT '0',
  `steps` int(11) NOT NULL DEFAULT '0',
  `trail` text NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=241 DEFAULT CHARSET=utf8;



# Dump of table pattern
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pattern`;

CREATE TABLE `pattern` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `structure_id` int(11) DEFAULT NULL,
  `offset` varchar(100) NOT NULL,
  `width` float NOT NULL DEFAULT '0',
  `height` float NOT NULL DEFAULT '0',
  `density` float NOT NULL DEFAULT '0',
  `strokeCount` int(11) NOT NULL DEFAULT '-1',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;



# Dump of table stroke
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stroke`;

CREATE TABLE `stroke` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pattern_id` int(11) DEFAULT NULL,
  `trail` text,
  `brushSize` float NOT NULL DEFAULT '3',
  `brushColor` int(11) NOT NULL DEFAULT '0',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=266 DEFAULT CHARSET=utf8;



# Dump of table structure
# ------------------------------------------------------------

DROP TABLE IF EXISTS `structure`;

CREATE TABLE `structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `width` float NOT NULL DEFAULT '0',
  `height` float NOT NULL DEFAULT '0',
  `density` float NOT NULL DEFAULT '0',
  `patternCount` int(11) NOT NULL DEFAULT '0',
  `dimension` varchar(100) NOT NULL DEFAULT '{"x":0, "y":0,"z":0}',
  `offset` varchar(100) NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updateTime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;






/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
