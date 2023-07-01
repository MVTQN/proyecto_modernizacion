-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.25-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para leavedb
DROP DATABASE IF EXISTS `leavedb`;
CREATE DATABASE IF NOT EXISTS `leavedb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `leavedb`;

-- Volcando estructura para tabla leavedb.tblapproversmatrix
DROP TABLE IF EXISTS `tblapproversmatrix`;
CREATE TABLE IF NOT EXISTS `tblapproversmatrix` (
  `appr_id` int(11) NOT NULL AUTO_INCREMENT,
  `appr_token` varchar(50) DEFAULT NULL,
  `appr_user_id` int(11) DEFAULT NULL,
  `appr_leavetype` varchar(50) DEFAULT NULL,
  `appr_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`appr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla leavedb.tblapproversmatrix: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `tblapproversmatrix` DISABLE KEYS */;
INSERT INTO `tblapproversmatrix` (`appr_id`, `appr_token`, `appr_user_id`, `appr_leavetype`, `appr_level`) VALUES
	(31, '5680d79cf3c008edf4b6264230cb7bf1', 198465, 'Vacation', '1'),
	(32, '5680d79cf3c008edf4b6264230cb7bf1', 198465, 'Vacation', '3'),
	(33, '5680d79cf3c008edf4b6264230cb7bf1', 198465, 'Vacation', '1'),
	(34, '5680d79cf3c008edf4b6264230cb7bf1', 198465, 'Vacation', '2'),
	(35, '5680d79cf3c008edf4b6264230cb7bf1', 198465, 'Vacation', '1'),
	(36, '5680d79cf3c008edf4b6264230cb7bf1', 198465, 'Vacation', '2'),
	(37, '66d86dd2933b9bea790d16fe5ec19ef9', 456789, 'Vacation', '1'),
	(39, '0f10b896964c4d59e2f1ab8e6a344505', 169180, 'Vacation', '3'),
	(40, '5680d79cf3c008edf4b6264230cb7bf1', 198465, 'Vacation', '2'),
	(41, '0f10b896964c4d59e2f1ab8e6a344505', 169180, 'Vacation', '1'),
	(42, '3c1fafd9baa1cce8051cbf2c15b00871', 899999, 'Vacation', '2'),
	(45, '9333c335dad9341d1b19d8c44d9de26c', 111333, 'Vacation', '3'),
	(46, '6e1905ee48cf3a3f5837acd533e28478', 12345, 'Vacation', '1'),
	(47, '6e1905ee48cf3a3f5837acd533e28478', 12345, 'Vacation', '3');
/*!40000 ALTER TABLE `tblapproversmatrix` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblattendance
DROP TABLE IF EXISTS `tblattendance`;
CREATE TABLE IF NOT EXISTS `tblattendance` (
  `ATID` int(11) NOT NULL AUTO_INCREMENT,
  `ATEMPID` int(11) NOT NULL,
  `ATEMPNAME` varchar(30) NOT NULL,
  `ATDATE` date NOT NULL,
  `ATTIMEIN` time NOT NULL,
  `ATTIMEOUT` time NOT NULL,
  PRIMARY KEY (`ATID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tblattendance: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `tblattendance` DISABLE KEYS */;
INSERT INTO `tblattendance` (`ATID`, `ATEMPID`, `ATEMPNAME`, `ATDATE`, `ATTIMEIN`, `ATTIMEOUT`) VALUES
	(14, 197865, 'nombre7', '2020-06-17', '17:40:00', '16:38:00'),
	(15, 175639, 'nombre30', '2020-06-26', '17:13:00', '17:16:00'),
	(16, 175639, 'nombre30', '2020-07-07', '19:04:00', '19:05:00'),
	(18, 175639, 'nombre30', '2020-07-09', '18:35:00', '20:36:00'),
	(20, 456789, 'nombre17', '2020-10-19', '16:22:59', '16:23:00'),
	(21, 423708, 'nombre3', '2023-06-15', '23:19:00', '23:20:00'),
	(22, 1234589, 'nombre12', '2023-06-17', '12:59:00', '15:59:00'),
	(23, 1234589, 'nombre12', '2023-06-16', '10:00:00', '13:00:00');
/*!40000 ALTER TABLE `tblattendance` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblattrition
DROP TABLE IF EXISTS `tblattrition`;
CREATE TABLE IF NOT EXISTS `tblattrition` (
  `ATTRID` int(11) NOT NULL AUTO_INCREMENT,
  `ATTREMPCODE` int(11) NOT NULL,
  `ATTREMPNAME` varchar(30) NOT NULL,
  `ATTREASON` varchar(40) NOT NULL,
  `ATTRDATE` date NOT NULL,
  PRIMARY KEY (`ATTRID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tblattrition: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `tblattrition` DISABLE KEYS */;
INSERT INTO `tblattrition` (`ATTRID`, `ATTREMPCODE`, `ATTREMPNAME`, `ATTREASON`, `ATTRDATE`) VALUES
	(3, 2347, 'nombre27', 'Career growth', '2020-05-10'),
	(5, 99999, 'nombre26', 'Career growth', '2021-02-06'),
	(6, 234567, 'nombre25', 'Market competition', '2020-07-24'),
	(7, 66777, 'nombre24', 'Market competition', '2020-09-22'),
	(10, 345566, 'nombre23', 'Career growth', '2017-10-13'),
	(25, 8789034, 'nombre22', 'Market competition', '2020-05-10');
/*!40000 ALTER TABLE `tblattrition` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblattrition_r
DROP TABLE IF EXISTS `tblattrition_r`;
CREATE TABLE IF NOT EXISTS `tblattrition_r` (
  `ATTRID_R` int(11) NOT NULL AUTO_INCREMENT,
  `ATTRNAME_R` varchar(30) NOT NULL,
  `ATTRDESC` varchar(40) NOT NULL,
  PRIMARY KEY (`ATTRID_R`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tblattrition_r: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tblattrition_r` DISABLE KEYS */;
INSERT INTO `tblattrition_r` (`ATTRID_R`, `ATTRNAME_R`, `ATTRDESC`) VALUES
	(2, 'Market competition', 'Better benefits'),
	(4, 'Career growth', 'Manager role'),
	(6, 'Personal issues', 'Personal issues'),
	(10, 'Scope change', 'New role');
/*!40000 ALTER TABLE `tblattrition_r` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblaudit_trail
DROP TABLE IF EXISTS `tblaudit_trail`;
CREATE TABLE IF NOT EXISTS `tblaudit_trail` (
  `auditid` varchar(50) NOT NULL DEFAULT '0',
  `audituser` varchar(50) DEFAULT NULL,
  `audittable` varchar(50) DEFAULT NULL,
  `auditolddata` varchar(500) DEFAULT NULL,
  `auditnewdata` varchar(500) DEFAULT NULL,
  `auditdate` varchar(500) DEFAULT NULL,
  `audittype` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`auditid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla leavedb.tblaudit_trail: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `tblaudit_trail` DISABLE KEYS */;
INSERT INTO `tblaudit_trail` (`auditid`, `audituser`, `audittable`, `auditolddata`, `auditnewdata`, `auditdate`, `audittype`) VALUES
	('2023061713584649', 'nombre7', 'tblshift', '', '1*/*shift1a*/*08:00:00*/*22:00:00', '20230617', 'edit'),
	('2023061713585749', 'nombre7', 'tblshift', '', '1*/*shift1c*/*08:00:00*/*22:00:00', '20230617', 'edit'),
	('2023061714072449', 'nombre7', 'tblshift', '7*/*2*/*testing shifta*/*13:35:00*/*13:45:00', '', '20230617', 'delete'),
	('2023061714573849', 'nombre7', 'tblemployee', '', '123*/*test aplellido*/*123*/*APA DEV*/*test@test.com*/*Onboarding*/*Male*/*1995-01-17*/*manager1*/*2023-06-02*/*3107777777*/*calle 100 20-13*/*da39a3ee5e6b4b0d3255bfef95601890afd80709*/*empresa1*/*1*/*director2*/*Enterprise Users*/*EXECUTIVE*/*COLOMBIA*/*BOGOTA*/*Actimize*/*2023-08-31', '20230617', 'edit'),
	('2023061716151449', 'nombre7', 'tblpromotion', '9*/*169180*/*nombre9*/*2020-09-14', '', '20230617', 'delete'),
	('2023061716172249', 'nombre7', 'tblpromotion', '', '345645*/*nombre13*/*2023-06-13', '20230617', 'edit'),
	('2023061717114449', 'nombre7', 'tblmanager', '109*/*director2*/*director2@n.com*/*908900*/*28030', '109*/*director22*/*director2@n.com*/*908900*/*28030', '20230617', 'edit'),
	('2023061717265249', 'nombre7', 'tblpromotion', '11*/*345645*/*nombre13*/*2023-06-13', '', '20230617', 'delete');
/*!40000 ALTER TABLE `tblaudit_trail` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblcity
DROP TABLE IF EXISTS `tblcity`;
CREATE TABLE IF NOT EXISTS `tblcity` (
  `CTYID` int(11) NOT NULL AUTO_INCREMENT,
  `CITYID` int(11) NOT NULL,
  `CITYNAME` varchar(50) NOT NULL,
  `COUNTRYID` int(11) NOT NULL,
  PRIMARY KEY (`CTYID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla leavedb.tblcity: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tblcity` DISABLE KEYS */;
INSERT INTO `tblcity` (`CTYID`, `CITYID`, `CITYNAME`, `COUNTRYID`) VALUES
	(1, 1, 'BOGOTA', 1),
	(2, 2, 'BARRANQUILLA', 1);
/*!40000 ALTER TABLE `tblcity` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblcompany
DROP TABLE IF EXISTS `tblcompany`;
CREATE TABLE IF NOT EXISTS `tblcompany` (
  `COMPID` int(11) NOT NULL AUTO_INCREMENT,
  `COMCODE` int(11) NOT NULL,
  `COMPANY` varchar(50) NOT NULL DEFAULT '',
  `COUNTRY` varchar(50) DEFAULT NULL,
  `CITY` varchar(50) DEFAULT '',
  PRIMARY KEY (`COMPID`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tblcompany: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `tblcompany` DISABLE KEYS */;
INSERT INTO `tblcompany` (`COMPID`, `COMCODE`, `COMPANY`, `COUNTRY`, `CITY`) VALUES
	(27, 28070, 'GoDaddy', 'COLOMBIA', 'BOGOTA'),
	(28, 28030, 'empresa1', 'COLOMBIA', 'BOGOTA'),
	(100, 1234, 'Google', 'COLOMBIA', 'BOGOTA'),
	(101, 28067, 'McAFee', 'COLOMBIA', 'BOGOTA'),
	(102, 9076, 'empresa3', 'COLOMBIA', 'BOGOTA'),
	(103, 1200, 'empresa2', 'COLOMBIA', 'BOGOTA'),
	(111, 7845, 'VMWare', 'COLOMBIA', 'BOGOTA'),
	(112, 2345, 'Microsoft', 'COLOMBIA', 'BOGOTA'),
	(114, 28030, 'empresa1', 'COLOMBIA', 'BARRANQUILLA'),
	(116, 89900, 'Amazon', 'COLOMBIA', 'BOGOTA');
/*!40000 ALTER TABLE `tblcompany` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblcountry
DROP TABLE IF EXISTS `tblcountry`;
CREATE TABLE IF NOT EXISTS `tblcountry` (
  `CRTID` int(11) NOT NULL AUTO_INCREMENT,
  `COUNTRYID` int(11) NOT NULL DEFAULT 0,
  `COUNTRYNAME` varchar(50) NOT NULL,
  PRIMARY KEY (`CRTID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla leavedb.tblcountry: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tblcountry` DISABLE KEYS */;
INSERT INTO `tblcountry` (`CRTID`, `COUNTRYID`, `COUNTRYNAME`) VALUES
	(1, 1, 'COLOMBIA');
/*!40000 ALTER TABLE `tblcountry` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tbldepts
DROP TABLE IF EXISTS `tbldepts`;
CREATE TABLE IF NOT EXISTS `tbldepts` (
  `DEPTID` int(11) NOT NULL AUTO_INCREMENT,
  `DEPTCODE` int(11) NOT NULL,
  `DEPTNAME` varchar(30) NOT NULL,
  PRIMARY KEY (`DEPTID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tbldepts: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `tbldepts` DISABLE KEYS */;
INSERT INTO `tbldepts` (`DEPTID`, `DEPTCODE`, `DEPTNAME`) VALUES
	(1, 103, 'Facilities Department'),
	(2, 102, 'HR Department'),
	(3, 105, 'Global IT Services'),
	(6, 104, 'SD Managers'),
	(7, 100, 'Enterprise Users'),
	(9, 3020, 'Financial Department');
/*!40000 ALTER TABLE `tbldepts` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblemployee
DROP TABLE IF EXISTS `tblemployee`;
CREATE TABLE IF NOT EXISTS `tblemployee` (
  `EMPID` int(11) NOT NULL AUTO_INCREMENT,
  `EMPLOYID` varchar(30) NOT NULL,
  `EMPNAME` varchar(60) NOT NULL,
  `IDENTIFICATION` int(11) NOT NULL,
  `EMPROLE` varchar(20) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `EMPSTATUS` varchar(12) NOT NULL,
  `PASSWRD` text NOT NULL,
  `EMPSEX` varchar(10) CHARACTER SET macce COLLATE macce_bin NOT NULL DEFAULT 'MALE',
  `BIRTHDAY` date DEFAULT NULL,
  `MGNAME` varchar(30) NOT NULL,
  `STRDATE` date DEFAULT NULL,
  `EMPPHONE` varchar(15) NOT NULL DEFAULT '',
  `EMPADDRESS` varchar(40) NOT NULL,
  `COMPANY` varchar(30) NOT NULL,
  `DEPARTMENT` varchar(30) NOT NULL,
  `EMPPOSITION` varchar(30) NOT NULL,
  `EMPSHIFT` varchar(11) NOT NULL,
  `EMPMGR` varchar(30) NOT NULL,
  `COUNTRY` varchar(50) NOT NULL,
  `CITY` varchar(50) NOT NULL DEFAULT '0',
  `LOB` varchar(50) DEFAULT NULL,
  `EMPONBOARDING` date NOT NULL,
  PRIMARY KEY (`EMPID`)
) ENGINE=InnoDB AUTO_INCREMENT=403 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tblemployee: ~21 rows (aproximadamente)
/*!40000 ALTER TABLE `tblemployee` DISABLE KEYS */;
INSERT INTO `tblemployee` (`EMPID`, `EMPLOYID`, `EMPNAME`, `IDENTIFICATION`, `EMPROLE`, `USERNAME`, `EMPSTATUS`, `PASSWRD`, `EMPSEX`, `BIRTHDAY`, `MGNAME`, `STRDATE`, `EMPPHONE`, `EMPADDRESS`, `COMPANY`, `DEPARTMENT`, `EMPPOSITION`, `EMPSHIFT`, `EMPMGR`, `COUNTRY`, `CITY`, `LOB`, `EMPONBOARDING`) VALUES
	(38, '197865', 'nombre1', 11223312, 'MCR PSE', 'nombre1', 'Active', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1983-02-18', 'manager1', '2013-06-22', '304370479', 'Calle 156 # 78-40', 'empresa1', 'Facilities Department', 'EXECUTIVE', '3', 'director1', 'COLOMBIA', 'BOGOTA', 'Support T2 & T3', '2013-09-22'),
	(49, '198465', 'nombre7', 79214557, 'Team Manager', 'nombre7', 'Active', '059f0e900af06628c3b0b51ac49d83851961543a', 'Male', '1979-01-14', 'Director 1', '2014-06-14', '37888488', 'calle 89', 'empresa1', 'Enterprise Users', 'MANAGER', '3', 'director1', 'COLOMBIA', 'BOGOTA', 'test', '2014-09-14'),
	(372, '2347', 'nombre2', 112234567, 'Customer Trainer', 'nombre2', 'Attrited', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Female', '2002-12-26', 'manager1', '2019-02-02', '304039988', 'calle 23 n 156', 'empresa1', 'Enterprise Users', 'AGENT', '2', 'director2', 'COLOMBIA', 'BARRANQUILLA', 'Actimize', '2019-05-02'),
	(382, '423708', 'nombre3', 7890890, 'APA DEV', 'nombre3', 'Active', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1979-12-01', 'manager1', '2020-07-02', '34355', 'calle 23 n 156', 'empresa1', 'Global IT Services', 'AGENT', '3', 'director2', 'COLOMBIA', 'BOGOTA', 'APA', '2020-10-02'),
	(383, '99999', 'nombre4', 2345569, 'APA BA', 'nombre4', 'Attrited', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1979-02-02', 'manager1', '2019-02-20', '67899999', 'calle 178 N 10-12', 'GoDaddy', 'Facilities Department', 'ADMINISTRATOR', '3', 'director4', 'COLOMBIA', 'BOGOTA', 'Emails', '2019-05-20'),
	(384, '888888', 'nombre5', 3455667, 'APA BA', 'nombre5', 'Onboarding', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1979-01-12', 'manager1', '2020-07-02', '3456789', 'calle 7', 'Google', 'Facilities Department', 'AGENT', '2', 'director3', 'COLOMBIA', 'BOGOTA', 'Hosting', '2020-10-02'),
	(385, '899999', 'nombre6', 88888099, 'Payroll-Nomina', 'nombre6', 'Active', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1980-01-14', 'manager3', '2014-03-15', '4566788', 'calll 167', 'empresa1', 'Financial Department', 'OPERATIVE', '3', 'director4', 'COLOMBIA', 'BOGOTA', 'Payroll', '2014-06-13'),
	(386, '175639', 'nombre30', 899999, 'Payroll-Nomina', 'nombre7', 'Active', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1982-02-16', 'manager1', '2020-06-01', '7897899', 'cra 24-5678', 'empresa1', 'Financial Department', 'OPERATIVE', '1', 'director4', 'COLOMBIA', 'BOGOTA', 'Payroll', '2020-08-30'),
	(387, '354919', 'nombre8', 123321, 'Team Manager', 'nombre8', 'Active', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1979-10-23', 'manager1', '2018-02-05', '305678900', 'Calle 200 #10-12', 'empresa1', 'Enterprise Users', 'ADMINISTRATOR', '1', 'director3', 'COLOMBIA', 'BOGOTA', 'Actimize', '2018-05-06'),
	(388, '169180', 'nombre9', 46578895, 'Team Manager', 'nombre9', 'Active', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1992-09-28', 'Director 1', '2017-06-19', '1234567', 'cra 24-5678', 'empresa1', 'Enterprise Users', 'EXECUTIVE', '3', 'director1', 'COLOMBIA', 'BOGOTA', 'test', '2017-09-17'),
	(390, '345566', 'nombre10', 456778, 'MCR PSE', 'nombre10', 'Attrited', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1990-05-14', 'manager2', '2020-06-30', '301289679', 'calle 23 n 156', 'empresa1', 'Enterprise Users', 'AGENT', '2', 'director1', 'COLOMBIA', 'BOGOTA', 'Support T2 & T3', '2015-09-30'),
	(391, '234567', 'nombre11', 456789, 'MCR PSE', 'nombre11', 'Attrited', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1990-02-12', 'manager2', '2018-01-22', '345678999', 'Calle 200 #10-12', 'empresa1', 'Enterprise Users', 'AGENT', '1', 'director3', 'COLOMBIA', 'BOGOTA', 'test', '2018-04-22'),
	(392, '1234589', 'nombre12', 12112221, 'WFM PSE', 'nombre12', 'Onboarding', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1995-09-25', 'manager2', '2020-06-11', '234566789', 'CRA 54 # 126', 'empresa1', 'Enterprise Users', 'AGENT', '1', 'director1', 'COLOMBIA', 'BOGOTA', 'test', '2020-09-11'),
	(393, '345645', 'nombre13', 79234567, 'Customer Trainer', 'nombre13', 'Onboarding', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1992-06-01', 'manager3', '2020-07-06', '305678908', 'cra 200 # 10-12', 'empresa1', 'Enterprise Users', 'AGENT', '1', 'director2', 'COLOMBIA', 'BOGOTA', 'Support T2 & T3', '2020-10-04'),
	(394, '66777', 'nombre14', 980899, 'APA BA', 'nombre14', 'Attrited', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1992-05-17', 'manager1', '2018-09-17', '301234567', 'calle 23 n 156', 'empresa1', 'Enterprise Users', 'AGENT', '1', 'director2', 'COLOMBIA', 'BARRANQUILLA', 'APA', '2018-12-17'),
	(395, '8789034', 'nombre15', 3456789, 'WFM PSE', 'nombre15', 'Attrited', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1992-01-12', 'manager2', '2009-08-24', '34577999', 'cra 200 # 10-12', 'empresa1', 'Global IT Services', 'AGENT', '1', 'director3', 'COLOMBIA', 'BARRANQUILLA', 'test', '2009-11-24'),
	(396, '12345', 'nombre16', 5000, 'APA DEV', 'nombre16', 'Active', '6ae12d1c10cfb62ea0a0c5d8da008adc9eaa5bc7', 'Male', '1984-01-15', 'manager1', '2020-09-15', '34567', 'calle 100', 'empresa1', 'Global IT Services', 'AGENT', '1', 'director2', 'COLOMBIA', 'BOGOTA', 'Actimize', '2020-12-15'),
	(398, '456789', 'nombre17', 456789, 'APA DEV', 'nombre17', 'Onboarding', '059f0e900af06628c3b0b51ac49d83851961543a', 'Male', '1995-01-27', 'manager1', '2020-04-01', '56756756', 'calle 100', 'empresa1', 'Global IT Services', 'ADMINISTRATOR', '1', 'director2', 'COLOMBIA', 'BOGOTA', 'APA', '2020-07-01'),
	(400, '12345678', 'nombre18', 213212312, 'APA DEV', 'edward', 'Onboarding', '059f0e900af06628c3b0b51ac49d83851961543a', 'Male', '2020-10-20', 'manager1', '2020-05-01', '4534', 'calle 100', 'empresa1', 'Global IT Services', 'AGENT', '1', 'director2', 'COLOMBIA', 'BOGOTA', 'APA', '2020-08-01'),
	(401, '111333', 'nombre19', 1113334, 'Payroll-Nomina', 'nombre19', 'Onboarding', '059f0e900af06628c3b0b51ac49d83851961543a', 'Female', '1996-06-21', 'Director 1', '2019-10-22', '21341234', 'calle 100', 'empresa1', 'Financial Department', 'OPERATIVE', '1', 'director1', 'COLOMBIA', 'BOGOTA', 'Payroll', '2020-01-20'),
	(402, '123', 'test aplellido', 123, 'APA DEV', 'test@test.com', 'Onboarding', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Male', '1995-01-17', 'manager1', '2023-06-02', '3107777777', 'calle 100 20-13', 'empresa1', 'Enterprise Users', 'EXECUTIVE', '1', 'director2', 'COLOMBIA', 'BOGOTA', 'Actimize', '2023-08-31');
/*!40000 ALTER TABLE `tblemployee` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblholidays
DROP TABLE IF EXISTS `tblholidays`;
CREATE TABLE IF NOT EXISTS `tblholidays` (
  `HLDSID` int(11) NOT NULL AUTO_INCREMENT,
  `HLDCOUNTRYID` int(11) NOT NULL DEFAULT 0,
  `HLDDATE` date DEFAULT NULL,
  PRIMARY KEY (`HLDSID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla leavedb.tblholidays: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `tblholidays` DISABLE KEYS */;
INSERT INTO `tblholidays` (`HLDSID`, `HLDCOUNTRYID`, `HLDDATE`) VALUES
	(1, 1, '2020-01-01'),
	(2, 1, '2020-01-06'),
	(3, 1, '2020-03-23'),
	(4, 1, '2020-04-09'),
	(5, 1, '2020-04-10'),
	(6, 1, '2020-05-01'),
	(7, 1, '2020-05-25'),
	(8, 1, '2020-06-15'),
	(9, 1, '2020-06-22'),
	(10, 1, '2020-06-29'),
	(11, 1, '2020-07-20'),
	(12, 1, '2020-08-07'),
	(13, 1, '2020-08-17'),
	(14, 1, '2020-10-12'),
	(15, 1, '2020-11-02'),
	(16, 1, '2020-11-16'),
	(17, 1, '2020-12-08'),
	(18, 1, '2020-12-25');
/*!40000 ALTER TABLE `tblholidays` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblleave
DROP TABLE IF EXISTS `tblleave`;
CREATE TABLE IF NOT EXISTS `tblleave` (
  `LEAVEID` int(11) NOT NULL AUTO_INCREMENT,
  `LEMPID` int(11) NOT NULL,
  `LEMPNAME` varchar(30) NOT NULL,
  `LSTRDATE` date NOT NULL,
  `LCURDATE` date NOT NULL,
  `DATESTART` date NOT NULL,
  `DATEEND` date NOT NULL,
  `LTENURE` double NOT NULL,
  `LNOTAKEN` double NOT NULL,
  `LNODAYS` double NOT NULL,
  `TYPEOFLEAVE` varchar(30) NOT NULL,
  `REASON` text NOT NULL,
  `LEAVESTATUS` varchar(30) NOT NULL,
  `LVDS` varchar(255) DEFAULT NULL,
  `APPR_1` varchar(255) DEFAULT NULL,
  `APPR_2` varchar(255) DEFAULT NULL,
  `APPR_3` varchar(255) DEFAULT NULL,
  `APPR_4` varchar(255) DEFAULT NULL,
  `APPR_5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`LEAVEID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tblleave: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `tblleave` DISABLE KEYS */;
INSERT INTO `tblleave` (`LEAVEID`, `LEMPID`, `LEMPNAME`, `LSTRDATE`, `LCURDATE`, `DATESTART`, `DATEEND`, `LTENURE`, `LNOTAKEN`, `LNODAYS`, `TYPEOFLEAVE`, `REASON`, `LEAVESTATUS`, `LVDS`, `APPR_1`, `APPR_2`, `APPR_3`, `APPR_4`, `APPR_5`) VALUES
	(1, 198465, 'nombre7', '2014-06-14', '2020-10-21', '2020-10-21', '2020-10-31', 6.36, 8, 95, 'Vacation', '', 'APPROVED', 'YQ==', 'ccS9v8LItba+ncGfppZ0nZWioGRojVrRyJfQpqWomqud', 'ccS9v8LItba+ncGfppZ0nZWioGRhjVrRyJfQqqmrnKyd', 'ccS9v8LItba+ncGfppZ0nZWioGRhjVrRyJfQo6GjlqaX', NULL, NULL),
	(2, 423708, 'nombre3', '2020-07-02', '2020-10-21', '2020-10-21', '2020-10-23', 0.3, 3, 3, 'Vacation', '', 'PENDING', '', 'ccS9v8LItba+ncGfppZ0nZWioGRojVrRyJfQo6arlKuU', '', 'ccS9v8LItba+ncGfppZ0nZWioGRojVrRyJfQo6GjlqaX', NULL, NULL),
	(3, 345645, 'nombre13', '2020-07-06', '2020-10-21', '2020-10-22', '2020-10-23', 0.29, 2, 3, 'Vacation', '', 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 456789, 'nombre17', '2020-04-01', '2020-10-28', '2020-10-29', '2020-10-30', 0.58, 2, 7, 'Vacation', '', 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 12345678, 'nombre18', '2020-05-01', '2323-06-17', '2023-06-18', '2023-06-21', 303.33, 3, 4546, 'Vacation', 'dfasdfa', 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `tblleave` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblleavetaken
DROP TABLE IF EXISTS `tblleavetaken`;
CREATE TABLE IF NOT EXISTS `tblleavetaken` (
  `LEAVEID` int(11) NOT NULL,
  `LEMPID` int(11) NOT NULL,
  `DATESTART` date NOT NULL,
  `DATEEND` date NOT NULL,
  `LNOTAKEN` double NOT NULL,
  `TYPEOFLEAVE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tblleavetaken: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tblleavetaken` DISABLE KEYS */;
INSERT INTO `tblleavetaken` (`LEAVEID`, `LEMPID`, `DATESTART`, `DATEEND`, `LNOTAKEN`, `TYPEOFLEAVE`) VALUES
	(1, 198465, '2019-05-15', '2019-05-22', 7, 'VACATION'),
	(2, 198465, '2019-11-20', '2019-11-28', 8, 'VACATION'),
	(3, 198465, '2018-06-10', '2018-06-28', 15, 'VACACION'),
	(4, 198465, '2018-11-10', '2018-11-28', 15, 'VACATION');
/*!40000 ALTER TABLE `tblleavetaken` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblleavetype
DROP TABLE IF EXISTS `tblleavetype`;
CREATE TABLE IF NOT EXISTS `tblleavetype` (
  `LEAVTID` int(11) NOT NULL AUTO_INCREMENT,
  `LEAVECODE` int(11) NOT NULL,
  `LEAVETYPE` varchar(30) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `APPROVERS_COUNT` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`LEAVTID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tblleavetype: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `tblleavetype` DISABLE KEYS */;
INSERT INTO `tblleavetype` (`LEAVTID`, `LEAVECODE`, `LEAVETYPE`, `DESCRIPTION`, `APPROVERS_COUNT`) VALUES
	(1, 1001, 'Sick Leave', 'leave by demand', 3),
	(2, 1004, 'Mourning Leave', '5 days are allowed ', 1),
	(3, 1003, 'Unpaid Leave', 'HR should approve if this more than 3 days', 2),
	(4, 1002, 'Vacation', 'Not more than 15 days per year', 3),
	(8, 1005, 'Paternity Leave', '8 business days are allowed', 2),
	(10, 12345, 'test 1', 'test description', 4);
/*!40000 ALTER TABLE `tblleavetype` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tbllob
DROP TABLE IF EXISTS `tbllob`;
CREATE TABLE IF NOT EXISTS `tbllob` (
  `LOBID` int(11) NOT NULL AUTO_INCREMENT,
  `LOBCODE` int(11) NOT NULL,
  `LOBNAME` varchar(20) NOT NULL,
  `LOBHC` int(11) NOT NULL,
  `LDEPTNAME` varchar(40) NOT NULL,
  `COMPLOB` varchar(30) NOT NULL,
  PRIMARY KEY (`LOBID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tbllob: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `tbllob` DISABLE KEYS */;
INSERT INTO `tbllob` (`LOBID`, `LOBCODE`, `LOBNAME`, `LOBHC`, `LDEPTNAME`, `COMPLOB`) VALUES
	(3, 28030, 'Support T2 & T3', 20, 'Enterprise Users', 'empresa1'),
	(5, 7777, 'Hosting', 123, 'Global IT Services', 'Google'),
	(6, 789, 'Emails', 34, 'Global IT Services', 'GoDaddy'),
	(7, 145, 'Management', 234, 'Global IT Services', 'GoDaddy'),
	(8, 8900, 'Storage', 123, 'Global IT Services', 'empresa3'),
	(9, 9090, 'Payroll', 5, 'Financial Department', 'Amazon'),
	(10, 6545, 'Cloud', 5, 'Global IT Services', 'Suth'),
	(11, 12, 'test', 10, 'Enterprise Users', 'empresa1'),
	(12, 12, 'APA', 10, 'Global IT Services', 'empresa1'),
	(13, 28077, 'Actimize', 17, 'Enterprise Users', 'empresa1');
/*!40000 ALTER TABLE `tbllob` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblmanager
DROP TABLE IF EXISTS `tblmanager`;
CREATE TABLE IF NOT EXISTS `tblmanager` (
  `MGRID` int(11) NOT NULL AUTO_INCREMENT,
  `MGRNAME` varchar(30) NOT NULL,
  `MGRMAIL` varchar(30) NOT NULL,
  `MGRPHONE` int(11) NOT NULL,
  `MGRCOMPANY` int(11) NOT NULL,
  PRIMARY KEY (`MGRID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tblmanager: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `tblmanager` DISABLE KEYS */;
INSERT INTO `tblmanager` (`MGRID`, `MGRNAME`, `MGRMAIL`, `MGRPHONE`, `MGRCOMPANY`) VALUES
	(1, 'manager1', 'manager1|@t.com', 342342323, 1);
/*!40000 ALTER TABLE `tblmanager` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblpromotion
DROP TABLE IF EXISTS `tblpromotion`;
CREATE TABLE IF NOT EXISTS `tblpromotion` (
  `PROMID` int(11) NOT NULL AUTO_INCREMENT,
  `PEMPCODE` int(11) NOT NULL,
  `PEMPNAME` varchar(30) NOT NULL,
  `PDATE` date NOT NULL,
  PRIMARY KEY (`PROMID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tblpromotion: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tblpromotion` DISABLE KEYS */;
INSERT INTO `tblpromotion` (`PROMID`, `PEMPCODE`, `PEMPNAME`, `PDATE`) VALUES
	(7, 120111, 'nombre20', '2020-06-28'),
	(10, 198465, 'nombre7', '2020-10-19'),
	(12, 1234589, 'nombre12', '2023-06-15');
/*!40000 ALTER TABLE `tblpromotion` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblrole
DROP TABLE IF EXISTS `tblrole`;
CREATE TABLE IF NOT EXISTS `tblrole` (
  `RID` int(11) NOT NULL AUTO_INCREMENT,
  `ROLEID` varchar(30) NOT NULL,
  `ROLENAME` varchar(30) NOT NULL,
  PRIMARY KEY (`RID`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tblrole: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `tblrole` DISABLE KEYS */;
INSERT INTO `tblrole` (`RID`, `ROLEID`, `ROLENAME`) VALUES
	(67, '001', 'APA DEV'),
	(68, '002', 'MCR PSE'),
	(69, '003', 'WFM PSE'),
	(70, '0004', 'Payroll-Nomina'),
	(71, '0005', 'GTI'),
	(73, '0006', 'Customer Exp'),
	(74, '12345', 'IHD'),
	(75, '00023', 'WFM PSE'),
	(76, '0034', 'Customer Trainer'),
	(77, '00023', 'APA BA'),
	(78, '1234', 'Team Manager');
/*!40000 ALTER TABLE `tblrole` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblshift
DROP TABLE IF EXISTS `tblshift`;
CREATE TABLE IF NOT EXISTS `tblshift` (
  `SHIFTID` int(11) NOT NULL AUTO_INCREMENT,
  `SHIFTCODE` int(11) NOT NULL,
  `SHIFTNAME` varchar(30) NOT NULL,
  `SHIFTIMEIN` time NOT NULL,
  `SHIFTIMEOUT` time NOT NULL,
  PRIMARY KEY (`SHIFTID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla leavedb.tblshift: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `tblshift` DISABLE KEYS */;
INSERT INTO `tblshift` (`SHIFTID`, `SHIFTCODE`, `SHIFTNAME`, `SHIFTIMEIN`, `SHIFTIMEOUT`) VALUES
	(2, 1, 'shift1c', '08:00:00', '22:00:00'),
	(3, 3, 'Google02', '05:00:00', '07:00:00'),
	(6, 4, 'shift2', '10:00:00', '20:00:00'),
	(8, 5, 'new shift', '11:20:00', '17:20:00'),
	(9, 6, 'other shift', '07:01:00', '18:00:00'),
	(10, 10, 'shift1', '02:00:00', '08:00:00');
/*!40000 ALTER TABLE `tblshift` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tbluprivmatrix
DROP TABLE IF EXISTS `tbluprivmatrix`;
CREATE TABLE IF NOT EXISTS `tbluprivmatrix` (
  `priv_id` int(11) NOT NULL AUTO_INCREMENT,
  `priv_token` varchar(50) DEFAULT NULL,
  `priv_user_id` int(11) DEFAULT NULL,
  `priv_country` varchar(50) DEFAULT NULL,
  `priv_city` varchar(50) DEFAULT NULL,
  `priv_account` varchar(50) DEFAULT NULL,
  `priv_department` varchar(50) DEFAULT NULL,
  `priv_lob` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`priv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla leavedb.tbluprivmatrix: ~45 rows (aproximadamente)
/*!40000 ALTER TABLE `tbluprivmatrix` DISABLE KEYS */;
INSERT INTO `tbluprivmatrix` (`priv_id`, `priv_token`, `priv_user_id`, `priv_country`, `priv_city`, `priv_account`, `priv_department`, `priv_lob`) VALUES
	(1, '8902c250f513a0b90c613d1f5fcc57e2', 198465, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Enterprise Users', 'Actimize'),
	(2, '0da9c2cb108354457e5a235b02acd2e0', 198465, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Enterprise Users', 'Support T2 & T3'),
	(3, 'd057d63f83c65911c5e964c401226fbb', 198465, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Enterprise Users', 'test'),
	(4, 'd8773985da33e570c9d1adf03ef33662', 198465, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Global IT Services', 'APA'),
	(6, '09dabb9d9ebad7fc51b767e0a69c71bf', 198465, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Enterprise Users', 'Actimize'),
	(7, '82b5a7553d12bebfa1c234a14e93b2b2', 198465, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Enterprise Users', 'Support T2 & T3'),
	(8, '73e1bd3d5c9417a64103192f0bb6c9f2', 198465, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Enterprise Users', 'test'),
	(9, 'c4cd9c06927d421f5096a48f06743ccc', 198465, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Global IT Services', 'APA'),
	(11, '756d4d1c65c74631f661e8555afce6ec', 169180, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Enterprise Users', 'Actimize'),
	(12, '50833a5c8d5b901920e0d3e7f919a9d2', 169180, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Enterprise Users', 'Support T2 & T3'),
	(13, 'fa6598d850e128be10ac80bb598f4faf', 169180, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Enterprise Users', 'test'),
	(14, '931e6adfe9a09eeac9486c96ca5735fc', 169180, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Global IT Services', 'APA'),
	(15, 'f0f3f61535142e7cc7a8a76079ee0aae', 169180, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Global IT Services', 'APA'),
	(16, '70d1c0318a7bf7633583fd1217d91769', 169180, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Enterprise Users', 'test'),
	(17, '9b0036cafcff861b8de2990955c27362', 169180, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Enterprise Users', 'Support T2 & T3'),
	(18, 'b6db15a3a27230152dc4173e6d1e2d40', 169180, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Enterprise Users', 'Actimize'),
	(19, '535211ae393c71689c94a078cd64f4c3', 899999, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Enterprise Users', 'Actimize'),
	(20, 'f9f4461f71b73b27d6006a0067e04f49', 899999, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Enterprise Users', 'Support T2 & T3'),
	(21, 'c3927c275327049e2030ded9106efd93', 899999, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Enterprise Users', 'test'),
	(22, '3e90235729facc4c826b84573a016933', 899999, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Global IT Services', 'APA'),
	(23, 'c6c3fae66fe3043138764ff55b2ced52', 899999, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Enterprise Users', 'Actimize'),
	(24, 'a793daff42e99a052d170dfebd449917', 899999, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Enterprise Users', 'Support T2 & T3'),
	(25, '2b2836cf71e13461f599fe4ea4ea2e2f', 899999, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Enterprise Users', 'test'),
	(26, 'ad28f8e62f108b4ea9fb70275eb14982', 899999, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Global IT Services', 'APA'),
	(27, '521a45d98b260ab45904776012428256', 899999, 'COLOMBIA', 'BOGOTA', 'empresa2', 'Financial Department', 'Payroll'),
	(28, 'd6fa58cd1ae3babfad792e62f9604c71', 899999, 'COLOMBIA', 'BOGOTA', 'empresa2', 'Global IT Services', 'Cloud'),
	(29, 'ae71592b334bc9c1418370a4092e63c0', 899999, 'COLOMBIA', 'BOGOTA', 'GoDaddy', 'Global IT Services', 'Emails'),
	(30, '7859198605af1f67189f9127648fb9ab', 899999, 'COLOMBIA', 'BOGOTA', 'GoDaddy', 'Global IT Services', 'Management'),
	(31, '2c6f90519a485d26caa42944cbbf9d8b', 899999, 'COLOMBIA', 'BOGOTA', 'Google', 'Global IT Services', 'Hosting'),
	(32, '4a99a04dfe6bfcee09a9479b73bd4638', 899999, 'COLOMBIA', 'BOGOTA', 'empresa3', 'Global IT Services', 'Storage'),
	(33, '0d29016e618e0547abfaaec973064c2c', 111333, 'COLOMBIA', 'BOGOTA', 'GoDaddy', 'Global IT Services', 'Emails'),
	(34, '9166810b3dcf064da7232abfb0a2e95a', 111333, 'COLOMBIA', 'BOGOTA', 'GoDaddy', 'Global IT Services', 'Management'),
	(35, 'c39ac3f97a0fa591ae186725970859b0', 111333, 'COLOMBIA', 'BOGOTA', 'Google', 'Global IT Services', 'Hosting'),
	(36, 'a84463a99d95e9ba57f7802ecc818ad6', 111333, 'COLOMBIA', 'BOGOTA', 'empresa3', 'Global IT Services', 'Storage'),
	(37, '1e43655e9d75150ece4a322a1608d8d1', 111333, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Enterprise Users', 'Actimize'),
	(38, 'a936f3b527f38700293844fcb342c425', 111333, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Enterprise Users', 'Support T2 & T3'),
	(39, '27c5a63674703eceec4449d244a1d079', 111333, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Enterprise Users', 'test'),
	(40, '45808b2cc7ea0364843022ac57fe7ba0', 111333, 'COLOMBIA', 'BARRANQUILLA', 'empresa1', 'Global IT Services', 'APA'),
	(41, '24ad42ead35833cd70a4c19c9e54d12f', 111333, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Enterprise Users', 'Support T2 & T3'),
	(42, '7604a907f359853da689ad4d22a8e811', 111333, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Enterprise Users', 'Actimize'),
	(43, '5691e8b91b19f276d15072fb87d1da10', 111333, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Enterprise Users', 'test'),
	(44, 'c59117812df307324c9c59289cf960df', 111333, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Global IT Services', 'APA'),
	(45, 'f439ba71cb54a46c4569014e3963c04f', 111333, 'COLOMBIA', 'BOGOTA', 'empresa2', 'Global IT Services', 'Cloud'),
	(46, '0aeaea2d4f1b66774b9d2ae5a7625ff6', 111333, 'COLOMBIA', 'BOGOTA', 'empresa2', 'Financial Department', 'Payroll'),
	(47, 'b12e7010b5b0b2d40e4ffb8a1872722c', 12345, 'COLOMBIA', 'BOGOTA', 'empresa1', 'Enterprise Users', 'Actimize');
/*!40000 ALTER TABLE `tbluprivmatrix` ENABLE KEYS */;

-- Volcando estructura para tabla leavedb.tblusermatrix
DROP TABLE IF EXISTS `tblusermatrix`;
CREATE TABLE IF NOT EXISTS `tblusermatrix` (
  `MTXUSRID` int(11) NOT NULL AUTO_INCREMENT,
  `MTXUSRNAME` varchar(50) DEFAULT NULL,
  `MTXLEVEL` tinyint(4) DEFAULT NULL,
  `MTXS1` tinyint(4) DEFAULT NULL,
  `MTXS2` tinyint(4) DEFAULT NULL,
  `MTXS3` tinyint(4) DEFAULT NULL,
  `MTXS4` tinyint(4) DEFAULT NULL,
  `MTXS5` tinyint(4) DEFAULT NULL,
  `MTXS6` tinyint(4) DEFAULT NULL,
  `MTXS7` tinyint(4) DEFAULT NULL,
  `MTXS8` tinyint(4) DEFAULT NULL,
  `MTXS9` tinyint(4) DEFAULT NULL,
  `MTXS10` tinyint(4) DEFAULT NULL,
  `MTXS11` tinyint(4) DEFAULT NULL,
  `MTXS12` tinyint(4) DEFAULT NULL,
  `MTXS13` tinyint(4) DEFAULT NULL,
  `MTXS14` tinyint(4) DEFAULT NULL,
  `MTXS15` tinyint(4) DEFAULT NULL,
  `MTXS16` tinyint(4) DEFAULT NULL,
  `MTXS17` tinyint(4) DEFAULT NULL,
  `MTXS18` tinyint(4) DEFAULT NULL,
  `MTXS19` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`MTXUSRID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla leavedb.tblusermatrix: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `tblusermatrix` DISABLE KEYS */;
INSERT INTO `tblusermatrix` (`MTXUSRID`, `MTXUSRNAME`, `MTXLEVEL`, `MTXS1`, `MTXS2`, `MTXS3`, `MTXS4`, `MTXS5`, `MTXS6`, `MTXS7`, `MTXS8`, `MTXS9`, `MTXS10`, `MTXS11`, `MTXS12`, `MTXS13`, `MTXS14`, `MTXS15`, `MTXS16`, `MTXS17`, `MTXS18`, `MTXS19`) VALUES
	(1, 'ADMINISTRATOR', 10, 2, 2, 2, 0, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2),
	(2, 'EXECUTIVE', 9, 1, 2, 0, 0, 2, 0, 0, 0, 2, 2, 2, 0, 0, 0, 2, 0, 0, 2, 2),
	(3, 'OPERATIVE', 7, 1, 2, 0, 0, 2, 0, 0, 0, 2, 2, 2, 0, 0, 0, 2, 0, 0, 2, 2),
	(4, 'MANAGER', 5, 2, 2, 2, 0, 0, 0, 0, 0, 2, 2, 2, 0, 0, 2, 2, 0, 2, 2, 2),
	(5, 'SUPPORT', 3, 1, 2, 2, 0, 1, 1, 1, 1, 2, 2, 2, 2, 0, 0, 2, 0, 2, 2, 2),
	(7, 'AGENT', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 2);
/*!40000 ALTER TABLE `tblusermatrix` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
