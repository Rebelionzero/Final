CREATE DATABASE shop;
USE shop;

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT unique primary key,
  `nombreDeUsuario` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `tipoUsuario` varchar(15) not null,
  `password` varchar(15) not null
);


DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
);

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
);

--
-- Dumping data for table `marcas`
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
);

--
-- Dumping data for table `productos`
--

INSERT INTO usuarios VALUES(null,'Admin','administrador','@dm1nsm@rt');