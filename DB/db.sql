CREATE DATABASE arte;
USE arte;

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT unique primary key,
  `nombreDeUsuario` varchar(30) NOT NULL,
  `password` varchar(15) not null
) CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT unique primary key,
  `nombre` varchar(30) NOT NULL,
  `value` varchar(30) NOT NULL,
  `descripcion` varchar(255)
) CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS `autores`;
CREATE TABLE IF NOT EXISTS `autores` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT unique primary key,
  `nombre` varchar(30) NOT NULL,
  `value` varchar(30) NOT NULL,
  `seudonimo` varchar(30) DEFAULT '-No tiene-',
  `mail` varchar(30) NOT NULL unique
) CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `museos`;
CREATE TABLE IF NOT EXISTS `museos` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT unique primary key,
  `nombre` varchar(30) NOT NULL,
  `value` varchar(30) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `mail` varchar(30) NOT NULL unique,
  `imagen` varchar(50) DEFAULT NULL
) CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS `obras`;
CREATE TABLE IF NOT EXISTS `obras` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT unique primary key,
  `nombre` varchar(30) NOT NULL,
  `value` varchar(30) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `src` varchar(70) NOT NULL,
  `descripcion` varchar(255),
  `año` year,
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
) CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO usuarios VALUES(null,'Admin','@dm1n1str@d0r');

INSERT INTO categorias VALUES(null,'esculturas','esculturas','esculturas de grasa');
INSERT INTO categorias VALUES(null,'pinturas','pinturas','al oleo');

INSERT INTO autores VALUES(null,'blanca narfa','blanca_narfa','frita', 'friasm@mail.com');
INSERT INTO autores VALUES(null,'edmure tally','edmure_tally','frasco', 'tully@mail.com');
INSERT INTO autores VALUES(null,'autor','autor',DEFAULT, 'autor@mail.com');
INSERT INTO autores VALUES(null,'gran autor','gran_autor',DEFAULT, 'gran_autor@mail.com');

INSERT INTO museos VALUES(null,'pequeño museo','pequeño_museo','direccion 456', 'peque@mail.com','otro.jpg');
INSERT INTO museos VALUES(null,'gran museo de hyrule','gran_museo_de_hyrule','direccion 123', 'triforce@mail.com','imagen.jpg');