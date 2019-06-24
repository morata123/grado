/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.6.21 : Database - forestacion_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`forestacion_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `forestacion_db`;

/*Table structure for table `arboles` */

DROP TABLE IF EXISTS `arboles`;

CREATE TABLE `arboles` (
  `idarbol` int(11) NOT NULL AUTO_INCREMENT,
  `fuente` varchar(11) DEFAULT NULL,
  `especie` varchar(20) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `numarbol` int(11) DEFAULT NULL,
  `diametro` float DEFAULT NULL,
  `altura` float DEFAULT NULL,
  `idsitio` int(11) DEFAULT NULL,
  `fechaplan` date DEFAULT NULL,
  PRIMARY KEY (`idarbol`),
  KEY `idsitio` (`idsitio`),
  CONSTRAINT `arboles_ibfk_1` FOREIGN KEY (`idsitio`) REFERENCES `sitio` (`idsitio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `arboles` */

insert  into `arboles`(`idarbol`,`fuente`,`especie`,`edad`,`numarbol`,`diametro`,`altura`,`idsitio`,`fechaplan`) values 
(1,'fcvcxv','asdas',7,2,4,2,4,'2019-06-28'),
(2,'d','d',7,12,2,2.4,3,'2019-06-11');

/*Table structure for table `contrato` */

DROP TABLE IF EXISTS `contrato`;

CREATE TABLE `contrato` (
  `idcontrato` int(11) NOT NULL AUTO_INCREMENT,
  `contrato` varchar(12) DEFAULT NULL,
  `idpredio` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcontrato`),
  KEY `idpredio` (`idpredio`),
  CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`idpredio`) REFERENCES `predios` (`idpredio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `contrato` */

insert  into `contrato`(`idcontrato`,`contrato`,`idpredio`) values 
(1,'bbbbb',1);

/*Table structure for table `inventario` */

DROP TABLE IF EXISTS `inventario`;

CREATE TABLE `inventario` (
  `idinventario` int(11) NOT NULL AUTO_INCREMENT,
  `realizo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idinventario`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

/*Data for the table `inventario` */

insert  into `inventario`(`idinventario`,`realizo`) values 
(115,'jhh');

/*Table structure for table `orden` */

DROP TABLE IF EXISTS `orden`;

CREATE TABLE `orden` (
  `idorden` int(11) NOT NULL AUTO_INCREMENT,
  `anoplanta` int(11) DEFAULT NULL,
  `superficie` int(11) DEFAULT NULL,
  `bloque` int(11) DEFAULT NULL,
  `idcontrato` int(11) DEFAULT NULL,
  PRIMARY KEY (`idorden`),
  KEY `idcontrato` (`idcontrato`),
  CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`idcontrato`) REFERENCES `contrato` (`idcontrato`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `orden` */

insert  into `orden`(`idorden`,`anoplanta`,`superficie`,`bloque`,`idcontrato`) values 
(5,44444,4,4,1),
(6,4,4,44,1);

/*Table structure for table `predios` */

DROP TABLE IF EXISTS `predios`;

CREATE TABLE `predios` (
  `idpredio` int(11) NOT NULL AUTO_INCREMENT,
  `predio` varchar(50) DEFAULT NULL,
  `zona` varchar(30) DEFAULT NULL,
  `idinventario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpredio`),
  KEY `idinventario` (`idinventario`),
  CONSTRAINT `predios_ibfk_1` FOREIGN KEY (`idinventario`) REFERENCES `inventario` (`idinventario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `predios` */

insert  into `predios`(`idpredio`,`predio`,`zona`,`idinventario`) values 
(1,'sgfgf','s',115);

/*Table structure for table `sitio` */

DROP TABLE IF EXISTS `sitio`;

CREATE TABLE `sitio` (
  `idsitio` int(11) NOT NULL AUTO_INCREMENT,
  `sitio` varchar(50) DEFAULT NULL,
  `idorden` int(11) DEFAULT NULL,
  PRIMARY KEY (`idsitio`),
  KEY `idorden` (`idorden`),
  CONSTRAINT `sitio_ibfk_1` FOREIGN KEY (`idorden`) REFERENCES `orden` (`idorden`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `sitio` */

insert  into `sitio`(`idsitio`,`sitio`,`idorden`) values 
(3,'vanecccc',5),
(4,'cochabamba',5);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidop` varchar(50) DEFAULT NULL,
  `apellidom` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  `rol` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id_usuario`,`nombre`,`apellidop`,`apellidom`,`PASSWORD`,`rol`) values 
(1,'1','1','1','1','Administrador'),
(2,'2','2','2','2','Cajero'),
(3,'3','3','3','3','Cliente');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
