/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.38-MariaDB : Database - sibadu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `finance` */

CREATE TABLE `finance` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tahun` char(4) DEFAULT NULL,
  `bulan` char(2) DEFAULT NULL,
  `no_anggota` varchar(20) DEFAULT NULL,
  `nama_anggota` varchar(100) DEFAULT NULL,
  `infaq` enum('Y','T') DEFAULT NULL,
  `zakat` enum('Y','T') DEFAULT NULL,
  `external` enum('Y','T') DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `ip_address` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `finance` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
