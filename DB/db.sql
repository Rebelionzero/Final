CREATE DATABASE arte;
USE arte;

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT unique primary key,
  `nombreDeUsuario` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(15) not null
);

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT unique primary key,
  `nombre` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `descripcion` varchar(255)
);

DROP TABLE IF EXISTS `autores`;
CREATE TABLE IF NOT EXISTS `autores` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT unique primary key,
  `nombre` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `seudonimo` varchar(30) COLLATE latin1_general_ci,
  `mail` varchar(30) COLLATE latin1_general_ci
);


DROP TABLE IF EXISTS `museos`;
CREATE TABLE IF NOT EXISTS `museos` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT unique primary key,
  `nombre` varchar(30) NOT NULL,
  `direccion` varchar(50) NOT NULL,  
  `mail` varchar(30) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL
);

DROP TABLE IF EXISTS `obras`;
CREATE TABLE IF NOT EXISTS `obras` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT unique primary key,
  `nombre` varchar(30) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `descripcion` varchar(255),
  `categoria` tinyint(3) unsigned NOT NULL,
  `autor` tinyint(3) unsigned NOT NULL,  
  `museo` tinyint(3) unsigned NOT NULL,
  `seudonimo` bool,

  FOREIGN KEY (`categoria`)
  REFERENCES `categorias` (`id`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,

  FOREIGN KEY (`autor`)
  REFERENCES `autores` (`id`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,

  FOREIGN KEY (`museo`)
  REFERENCES `museos` (`id`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
);

INSERT INTO usuarios VALUES(null,'Admin','@dm1n1str@d0r');