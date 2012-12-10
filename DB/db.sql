-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2012 at 09:10 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a3983931_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--
CREATE DATABASE shop;
USE shop;


DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categorias`
--

-- --------------------------------------------------------

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `marcas`
--



-- --------------------------------------------------------

--
-- Table structure for table `ordenes_de_compra`
--

DROP TABLE IF EXISTS `ordenes_de_compra`;
CREATE TABLE IF NOT EXISTS `ordenes_de_compra` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` tinyint(3) unsigned NOT NULL,
  `fecha` date DEFAULT NULL,
  `monto` int(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `usuario` (`usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ordenes_de_compra`
--


-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  id tinyint(3) unsigned unique NOT NULL AUTO_INCREMENT primary key,
  nombre varchar(30) NOT NULL,  
  precio int(3) unsigned,
  descripcion varchar(200) DEFAULT NULL,
  imagen varchar(50) NOT NULL,
  src varchar(70) NOT NULL,
  categoria tinyint(3) unsigned NOT NULL,
  marca tinyint(3) unsigned NOT NULL,

  FOREIGN KEY (categoria)
  REFERENCES categorias (id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,

  FOREIGN KEY (marca)
  REFERENCES marcas (id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `productos`
--



-- --------------------------------------------------------

--
-- Table structure for table `relacion_productos_ordenes`
--

DROP TABLE IF EXISTS `relacion_productos_ordenes`;
CREATE TABLE IF NOT EXISTS `relacion_productos_ordenes` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `id_prod` tinyint(3) unsigned NOT NULL,
  `id_orden` tinyint(3) unsigned NOT NULL,
  `cantidad` int(8) unsigned NOT NULL,
  `importe` float(5,2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_prod` (`id_prod`),
  KEY `id_orden` (`id_orden`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `relacion_productos_ordenes`
--


-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `apellido` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `mail` varchar(50) unique COLLATE latin1_general_ci NOT NULL,
  `password` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `usuarios`
--

