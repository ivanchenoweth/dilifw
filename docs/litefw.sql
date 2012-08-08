-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2011 at 11:07 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `litefw`
--

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cveprod` varchar(25) NOT NULL COMMENT 'Clave del producto (acceso directo)',
  `descripcion` varchar(50) NOT NULL COMMENT 'Descripción completa',
  `precio` double NOT NULL COMMENT 'Precio de venta',
  `timelog` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'FechaHora de afectación',
  `usuario_id` int(11) NOT NULL COMMENT 'id de usuarios (usuario que afecta)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Catálogo de productos' AUTO_INCREMENT=17 ;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` VALUES(2, 'CH', 'Chiltepineros', 10, '2011-12-27 10:24:20', 4);
INSERT INTO `productos` VALUES(4, 'CU', 'Cuaderno', 123, '2011-12-27 10:24:48', 4);
INSERT INTO `productos` VALUES(5, 'LIB', 'Libros', 23456, '2011-12-27 14:11:17', 4);
INSERT INTO `productos` VALUES(16, 'Ms', 'Mouse Oferta', 80, '2011-12-27 17:39:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `rol` set('Administrador','Vendedor') NOT NULL,
  `email` varchar(50) NOT NULL,
  `timelog` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` set('Bloqueado','Suspendido') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Usuarios del sistema' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(4, 'dany', '321', 'Daniel', 'Vendedor', 'dany@gmail.com', '2011-11-01 15:53:26', '');
INSERT INTO `users` VALUES(3, 'ivan', '123', 'Ivan R. Chenoweth', 'Administrador', 'ivanchenoweth@gmaiil.com', '2011-11-11 14:32:22', '');
INSERT INTO `users` VALUES(5, 'chuy', '789', 'Jesus', 'Vendedor', 'jesus@adsf.com', '2011-12-27 22:52:36', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
