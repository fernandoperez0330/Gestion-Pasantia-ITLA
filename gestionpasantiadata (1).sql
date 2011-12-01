-- phpMyAdmin SQL Dump
-- version 3.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2011 at 09:05 AM
-- Server version: 5.2.3
-- PHP Version: 5.2.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gestionpasantiadata`
--

-- --------------------------------------------------------

--
-- Table structure for table `carreras`
--

CREATE TABLE IF NOT EXISTS `carreras` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(60) NOT NULL,
  `DESCRIPCION` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `carreras`
--

INSERT INTO `carreras` (`ID`, `NOMBRE`, `DESCRIPCION`) VALUES
(6, 'software', 'descripcion de la carrera de software'),
(7, 'redes', 'descripcion de la carrera de redes'),
(8, 'mecatronica', 'carrera de mecatronica');

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(60) NOT NULL,
  `APELLIDO` varchar(60) NOT NULL,
  `CORREO` varchar(70) NOT NULL,
  `TELEFONO` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`ID`, `NOMBRE`, `APELLIDO`, `CORREO`, `TELEFONO`) VALUES
(1, 'Administrador 1', 'Apellido Adminsitrador 1', 'administrador1@gestionpasantia.com', '(809) 000-0000'),
(2, 'empleado 2', 'apellido empleado 2', 'empleado@gestionpasantia.com', '809-000-0000'),
(3, 'empleado 3', 'apellido empleado 3', 'empleado3@gestionpasantia.com', '809-000-0000'),
(4, 'empleado 4', 'apellido empleado 3', 'empleado4@correo.com', '809-000-0000'),
(5, 'empleado 5', 'apellido empleado 2', 'empleado5@correo.com', '809-000-0000'),
(6, 'empleado 6', 'apellido empleado 3', 'empleado6@gestion.com', '809-000-0000'),
(7, 'empleado 7', 'apellido empleado 3', 'empleado7@correo.com', '809-000-0000'),
(8, 'empleadi 8', 'apellido empleado 8', 'empleado8@correo.com', '809-000-0000'),
(9, 'empleado 9', 'apellido empleado 3', 'empleado9@corrreo.com', '809-000-0000'),
(10, 'empleado 10', 'apellido empleado 3', 'empleado10@correo.com', '809-000-0000'),
(11, 'fernando manuel ', 'perz ramos ', 'fernando_0330@hotmail.com', '809-000-0000');

-- --------------------------------------------------------

--
-- Table structure for table `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(60) NOT NULL,
  `DESCRIPCION` longtext,
  `DIRECCION` longtext NOT NULL,
  `TELEFONO1` varchar(14) DEFAULT NULL,
  `TELEFONO2` varchar(14) DEFAULT NULL,
  `CORREO` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UNIQUE` (`ID`,`NOMBRE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `empresas`
--

INSERT INTO `empresas` (`ID`, `NOMBRE`, `DESCRIPCION`, `DIRECCION`, `TELEFONO1`, `TELEFONO2`, `CORREO`) VALUES
(4, 'empresa 2', 'descripcion de la empresa 2', 'direccion de la empresa 2', '(809) 000-0000', '(809) 000-0000', 'empresa2@correo.com');

-- --------------------------------------------------------

--
-- Table structure for table `estudiantes`
--

CREATE TABLE IF NOT EXISTS `estudiantes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(60) NOT NULL,
  `CORREO` varchar(70) NOT NULL,
  `TELEFONO` varchar(14) DEFAULT NULL,
  `TELEFONO2` varchar(14) DEFAULT NULL,
  `CELULAR` varchar(14) DEFAULT NULL,
  `CARRERA_ID` int(11) NOT NULL,
  `FOTO` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_ESTUDIANTES_CARRERA` (`CARRERA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `estudiantes`
--

INSERT INTO `estudiantes` (`ID`, `NOMBRE`, `CORREO`, `TELEFONO`, `TELEFONO2`, `CELULAR`, `CARRERA_ID`, `FOTO`) VALUES
(1, 'estudiante 2', 'estudiant2@geasf.com', '809-000-0000', '809-000-0000', '809-000-0000', 6, NULL),
(2, 'estudiante 3', 'estudiante3@gestionpasantia.com', '809-000-0000', '809-000-0000', '809-000-0000', 6, NULL),
(3, 'estudiante4', 'estudiante4@correo.com', '809-000-0000', '809-000-0000', '809-000-0000', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pasantias`
--

CREATE TABLE IF NOT EXISTS `pasantias` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(60) NOT NULL,
  `EMPRESA_ID` int(11) NOT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Pasantias_empresaid` (`EMPRESA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `pasantias`
--

INSERT INTO `pasantias` (`ID`, `NOMBRE`, `EMPRESA_ID`, `FECHA_CREACION`) VALUES
(5, 'pasantia 1', 4, '2011-11-29 22:12:57'),
(7, 'pasantia 2', 4, '2011-11-29 23:03:16'),
(8, 'pasantia 3', 4, '2011-11-29 23:03:52'),
(9, 'Se requiere analista de sistema', 4, '2011-12-01 01:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `pasantias_carreras`
--

CREATE TABLE IF NOT EXISTS `pasantias_carreras` (
  `PASANTIA_ID` int(11) DEFAULT NULL,
  `CARRERA_ID` int(11) DEFAULT NULL,
  KEY `FK_Pasantiascarreras_pasantiaid` (`PASANTIA_ID`),
  KEY `FJ_Pasantiascarreras_carreraid` (`CARRERA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasantias_carreras`
--

INSERT INTO `pasantias_carreras` (`PASANTIA_ID`, `CARRERA_ID`) VALUES
(5, 6),
(5, 7),
(8, 8),
(7, 6),
(7, 7),
(7, 8),
(9, 6);

-- --------------------------------------------------------

--
-- Table structure for table `solicitudes`
--

CREATE TABLE IF NOT EXISTS `solicitudes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ESTUDIANTE_ID` int(11) NOT NULL,
  `PASANTIA_ID` int(11) NOT NULL,
  `ESTATUS` enum('P','A','E') DEFAULT 'P',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UNQUE_estudiante` (`ESTUDIANTE_ID`),
  KEY `FK_SOLICITUDES_pasantidaid` (`PASANTIA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `solicitudes`
--

INSERT INTO `solicitudes` (`ID`, `ESTUDIANTE_ID`, `PASANTIA_ID`, `ESTATUS`) VALUES
(1, 2, 5, 'P'),
(2, 1, 7, 'P');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USUARIO` varchar(60) NOT NULL,
  `CLAVE` varchar(61) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`ID`, `USUARIO`, `CLAVE`) VALUES
(1, 'fernando', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'jansel', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'estudiant2@geasf.com', '45ff60494987561b94482264bc4c23eb'),
(4, 'estudiante3@gestionpasantia.com', '25d55ad283aa400af464c76d713c07ad'),
(5, 'empleado8@correo.com', 'd41d8cd98f00b204e9800998ecf8427e'),
(6, 'empleado9@corrreo.com', 'd41d8cd98f00b204e9800998ecf8427e'),
(7, 'empleado10@correo.com', 'd41d8cd98f00b204e9800998ecf8427e'),
(8, 'fernando_0330@hotmail.com', '25d55ad283aa400af464c76d713c07ad'),
(9, 'estudiante4@correo.com', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_tipos`
--

CREATE TABLE IF NOT EXISTS `usuarios_tipos` (
  `USUARIO_ID` int(11) NOT NULL,
  `TIPO` int(11) NOT NULL,
  `TIPO_ID` int(11) NOT NULL,
  PRIMARY KEY (`USUARIO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios_tipos`
--

INSERT INTO `usuarios_tipos` (`USUARIO_ID`, `TIPO`, `TIPO_ID`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 2, 2),
(5, 1, 8),
(6, 1, 9),
(7, 1, 10),
(8, 1, 11),
(9, 2, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pasantias`
--
ALTER TABLE `pasantias`
  ADD CONSTRAINT `FK_Pasantias_empresaid` FOREIGN KEY (`EMPRESA_ID`) REFERENCES `empresas` (`ID`);

--
-- Constraints for table `pasantias_carreras`
--
ALTER TABLE `pasantias_carreras`
  ADD CONSTRAINT `FJ_Pasantiascarreras_carreraid` FOREIGN KEY (`CARRERA_ID`) REFERENCES `carreras` (`ID`),
  ADD CONSTRAINT `FK_Pasantiascarreras_pasantiaid` FOREIGN KEY (`PASANTIA_ID`) REFERENCES `pasantias` (`ID`);

--
-- Constraints for table `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `FK_SOLICITUDES_estudianteid` FOREIGN KEY (`ESTUDIANTE_ID`) REFERENCES `estudiantes` (`ID`),
  ADD CONSTRAINT `FK_SOLICITUDES_pasantidaid` FOREIGN KEY (`PASANTIA_ID`) REFERENCES `pasantias` (`ID`);

--
-- Constraints for table `usuarios_tipos`
--
ALTER TABLE `usuarios_tipos`
  ADD CONSTRAINT `fkusuarios_tipo` FOREIGN KEY (`USUARIO_ID`) REFERENCES `usuarios` (`ID`);
