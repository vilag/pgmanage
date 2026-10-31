-- Categorías de usuario para la vista accesos.php
-- Requiere 2026_10_28_accesos_menu.sql. No modifica tablas existentes.
-- Se puede ejecutar más de una vez: no cambia la categoría de usuarios ya clasificados.

CREATE TABLE IF NOT EXISTS `categoria_usuario` (
  `idcategoria_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `orden` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idcategoria_usuario`),
  UNIQUE KEY `uk_categoria_usuario_nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `usuario_categoria` (
  `idusuario` int(11) NOT NULL,
  `idcategoria_usuario` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT IGNORE INTO `categoria_usuario` (`nombre`, `descripcion`, `orden`) VALUES
('Administración del sistema', 'Control total, incluida la asignación de accesos', 10),
('Dirección',                  'Dirección y accionistas', 20),
('Administrativo',             'Recepción, enlace y cuentas administrativas', 30),
('Ventas',                     'Ejecutivos de ventas', 40),
('Distribuidores',             'Distribuidores externos', 50),
('Calidad',                    'Calidad y aseguramiento de calidad', 60),
('Almacén y logística',        'Embarques y almacenes de producto terminado y materia prima', 70),
('Producción',                 'Supervisión y estaciones de piso de producción', 80);

-- Clasificación inicial según los usuarios de producción (revisada el 2026-10-29)
INSERT IGNORE INTO `usuario_categoria` (`idusuario`, `idcategoria_usuario`)
SELECT u.idusuario, c.idcategoria_usuario FROM usuario u JOIN categoria_usuario c ON c.nombre = 'Administración del sistema'
WHERE u.idusuario IN (1);

INSERT IGNORE INTO `usuario_categoria` (`idusuario`, `idcategoria_usuario`)
SELECT u.idusuario, c.idcategoria_usuario FROM usuario u JOIN categoria_usuario c ON c.nombre = 'Dirección'
WHERE u.idusuario IN (7, 9, 14, 28);

INSERT IGNORE INTO `usuario_categoria` (`idusuario`, `idcategoria_usuario`)
SELECT u.idusuario, c.idcategoria_usuario FROM usuario u JOIN categoria_usuario c ON c.nombre = 'Administrativo'
WHERE u.idusuario IN (10, 11, 12);

INSERT IGNORE INTO `usuario_categoria` (`idusuario`, `idcategoria_usuario`)
SELECT u.idusuario, c.idcategoria_usuario FROM usuario u JOIN categoria_usuario c ON c.nombre = 'Ventas'
WHERE u.idusuario IN (2, 3, 23, 26, 29, 30);

INSERT IGNORE INTO `usuario_categoria` (`idusuario`, `idcategoria_usuario`)
SELECT u.idusuario, c.idcategoria_usuario FROM usuario u JOIN categoria_usuario c ON c.nombre = 'Distribuidores'
WHERE u.idusuario IN (6, 25);

INSERT IGNORE INTO `usuario_categoria` (`idusuario`, `idcategoria_usuario`)
SELECT u.idusuario, c.idcategoria_usuario FROM usuario u JOIN categoria_usuario c ON c.nombre = 'Calidad'
WHERE u.idusuario IN (5, 24);

INSERT IGNORE INTO `usuario_categoria` (`idusuario`, `idcategoria_usuario`)
SELECT u.idusuario, c.idcategoria_usuario FROM usuario u JOIN categoria_usuario c ON c.nombre = 'Almacén y logística'
WHERE u.idusuario IN (4, 22, 27);

INSERT IGNORE INTO `usuario_categoria` (`idusuario`, `idcategoria_usuario`)
SELECT u.idusuario, c.idcategoria_usuario FROM usuario u JOIN categoria_usuario c ON c.nombre = 'Producción'
WHERE u.idusuario IN (8, 13) OR u.idusuario BETWEEN 15 AND 21;
