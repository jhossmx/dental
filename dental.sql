
-- Dumping structure for table dental.c_configuracion
CREATE TABLE IF NOT EXISTS `c_configuracion` (
  `cn_id` int unsigned NOT NULL AUTO_INCREMENT,
  `da_titlo` varchar(150) DEFAULT NULL,
  `da_nombre` varchar(150) DEFAULT NULL,
  `da_correo` varchar(250) DEFAULT NULL,
  `da_telefono` varchar(15) DEFAULT NULL,
  `da_celular` varchar(15) DEFAULT NULL,
  `da_calle` varchar(80) DEFAULT NULL,
  `da_numero` varchar(20) DEFAULT NULL,
  `da_colonia` varchar(20) DEFAULT NULL,
  `da_cuidad` varchar(80) DEFAULT NULL,
  `da_pais` varchar(80) DEFAULT NULL,
  `da_zona_hora` varchar(20) DEFAULT NULL,
  `da_imagen` varchar(255) DEFAULT NULL,
  `da_icono` varchar(80) DEFAULT NULL,
  `da_status` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`cn_id`)
) ENGINE=InnoDB;

-- Dumping data for table dental.c_configuracion: ~0 rows (approximately)

-- Dumping structure for table dental.c_slider
CREATE TABLE IF NOT EXISTS `c_slider` (
  `cn_id` int unsigned NOT NULL AUTO_INCREMENT,
  `da_imagen` varchar(255) DEFAULT NULL,
  `da_title` varchar(150) DEFAULT NULL,
  `da_subtitle` varchar(150) DEFAULT NULL,
  `da_status` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`cn_id`)
) ENGINE=InnoDB;

-- Dumping data for table dental.c_slider: ~2 rows (approximately)
INSERT INTO `c_slider` (`cn_id`, `da_imagen`, `da_title`, `da_subtitle`, `da_status`) VALUES
	(1, 'http://localhost/mora/publicsite/img/carousel-1.jpg', 'Hacemos el Mejor Tratamiento Dental', 'Manten tu Sonrisa Saludable.', 'A'),
	(2, 'http://localhost/mora/publicsite/img/carousel-2.jpg', 'Hacemos el Mejor Tratamiento Dental', 'Manten tu Sonrisa Saludable.', 'A');

-- Dumping structure for table dental.c_tipo_usuario
CREATE TABLE IF NOT EXISTS `c_tipo_usuario` (
  `cn_id` int unsigned NOT NULL AUTO_INCREMENT,
  `da_nombre` varchar(60) DEFAULT NULL,
  `da_status` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`cn_id`)
) ENGINE=InnoDB;

-- Dumping data for table dental.c_tipo_usuario: ~4 rows (approximately)
INSERT INTO `c_tipo_usuario` (`cn_id`, `da_nombre`, `da_status`) VALUES
	(1, 'ADMINISTRADOR', 'A'),
	(2, 'SECRETARIA', 'A'),
	(3, 'DENTISTA', 'A'),
	(4, 'PACIENTE', 'A');

-- Dumping structure for table dental.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Dumping data for table dental.migrations: ~4 rows (approximately)
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2022-02-11-213717', 'App\\Database\\Migrations\\TIPOUSUARIO', 'default', 'App', 1645208472, 1),
	(2, '2022-02-11-214005', 'App\\Database\\Migrations\\SUSUARIOS', 'default', 'App', 1645208473, 1),
	(3, '2022-02-17-230033', 'App\\Database\\Migrations\\Slider', 'default', 'App', 1645208473, 1),
	(4, '2022-02-18-004659', 'App\\Database\\Migrations\\Configuracion', 'default', 'App', 1645208473, 1);

-- Dumping structure for table dental.s_usuarios
CREATE TABLE IF NOT EXISTS `s_usuarios` (
  `cn_id` int unsigned NOT NULL AUTO_INCREMENT,
  `da_usaurio` varchar(50) DEFAULT NULL,
  `da_correo` varchar(100) DEFAULT NULL,
  `da_clave` varchar(80) DEFAULT NULL,
  `da_apell1` varchar(60) DEFAULT NULL,
  `da_apell2` varchar(60) DEFAULT NULL,
  `da_nombre` varchar(60) DEFAULT NULL,
  `fn_tipousuario` int unsigned NOT NULL,
  `da_status` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`cn_id`),
  KEY `S_USUARIOS_fn_tipousuario_foreign` (`fn_tipousuario`),
  CONSTRAINT `S_USUARIOS_fn_tipousuario_foreign` FOREIGN KEY (`fn_tipousuario`) REFERENCES `c_tipo_usuario` (`cn_id`)
) ENGINE=InnoDB;

-- Dumping data for table dental.s_usuarios: ~0 rows (approximately)
INSERT INTO `s_usuarios` (`cn_id`, `da_usaurio`, `da_correo`, `da_clave`, `da_apell1`, `da_apell2`, `da_nombre`, `fn_tipousuario`, `da_status`) VALUES
	(1, 'ADMIN', 'jhossmx@gmail.com', '$2y$10$OyfaBsetDqR828yyJfzGa.TEvT9CTihYbeorbQenrv8YJShzlZaBG', 'RODRIGUEZ', 'VILLALOBOS', 'JOSE LUIS', 1, 'A');