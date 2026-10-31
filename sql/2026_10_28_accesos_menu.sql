-- Accesos al menú por usuario (menú nuevo, header_nuevo.php)
-- No modifica las tablas existentes (usuario, permiso, usuario_permiso).
-- Se puede ejecutar más de una vez sin duplicar registros.

CREATE TABLE IF NOT EXISTS `acceso_vista` (
  `idacceso_vista` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `grupo` varchar(50) NOT NULL,
  `url` varchar(150) DEFAULT NULL,
  `orden` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idacceso_vista`),
  UNIQUE KEY `uk_acceso_vista_clave` (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `usuario_acceso_vista` (
  `idusuario` int(11) NOT NULL,
  `idacceso_vista` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`, `idacceso_vista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- menu_nuevo: 0 = header.php (menú actual), 1 = header_nuevo.php
CREATE TABLE IF NOT EXISTS `usuario_menu_pref` (
  `idusuario` int(11) NOT NULL,
  `menu_nuevo` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Catálogo de vistas (replica el menú de header.php)
INSERT IGNORE INTO `acceso_vista` (`clave`, `nombre`, `grupo`, `url`, `orden`) VALUES
('pedidos_nuevo',       'Nuevo',                          'Pedidos',        'sale_product.php',  10),
('pedidos_todos',       'Todos',                          'Pedidos',        'list_pedidos.php',  11),
('pedidos_reportes',    'Reportes',                       'Pedidos',        'reportes.php',      12),
('salidas',             'Salidas',                        'Salidas',        'entregas_prod.php', 20),
('alm_pt',              'Fábrica - Producto terminado',   'Almacenes',      'almacen_pt.php',    30),
('alm_mp',              'Fábrica - Materia prima',        'Almacenes',      'alm_mat_prima.php', 31),
('alm_tienda',          'Tiendas - Tienda (Zuno)',        'Almacenes',      '#',                 32),
('consultar_productos', 'Productos',                      'Consultar',      'productos.php',     40),
('consultar_clientes',  'Clientes',                       'Consultar',      '#',                 41),
('prod_op',             'OP',                             'Producción',     'op.php',            50),
('prod_seguimiento',    'Seguimiento',                    'Producción',     'seguim_op.php',     51),
('prod_tabulador',      'Tabulador',                      'Producción',     'tabulador.php',     52),
('prod_materia_prima',  'Materia Prima',                  'Producción',     'materia_prima.php', 53),
('prod_correcciones',   'Correcciones',                   'Producción',     'correcciones.php',  54),
('reportes',            'Reportes',                       'Reportes',       'reportes.php',      60),
('notificaciones',      'Campana de notificaciones',      'Barra superior', NULL,                70),
('admin_accesos',       'Accesos de usuarios',            'Administración', 'accesos.php',       80);

-- Carga inicial: mismos accesos que hoy otorga header.php por idusuario.
-- Se arma en una tabla temporal y solo se copia a usuarios que aún no tienen ningún acceso,
-- para que volver a ejecutar el script no restaure accesos quitados desde accesos.php.
CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_acceso_inicial` (
  `idusuario` int(11) NOT NULL,
  `idacceso_vista` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`, `idacceso_vista`)
);
INSERT IGNORE INTO `tmp_acceso_inicial` (`idusuario`, `idacceso_vista`)
SELECT u.idusuario, a.idacceso_vista FROM usuario u JOIN acceso_vista a
  ON a.clave IN ('pedidos_nuevo', 'pedidos_todos', 'pedidos_reportes')
WHERE u.idusuario BETWEEN 1 AND 14 OR u.idusuario IN (22, 23, 24, 25, 26, 28, 29, 30);

INSERT IGNORE INTO `tmp_acceso_inicial` (`idusuario`, `idacceso_vista`)
SELECT u.idusuario, a.idacceso_vista FROM usuario u JOIN acceso_vista a
  ON a.clave = 'salidas'
WHERE u.idusuario IN (1, 4, 5, 7, 8, 9, 10, 11, 14, 22, 23, 24, 26, 28);

INSERT IGNORE INTO `tmp_acceso_inicial` (`idusuario`, `idacceso_vista`)
SELECT u.idusuario, a.idacceso_vista FROM usuario u JOIN acceso_vista a
  ON a.clave IN ('alm_pt', 'alm_mp', 'alm_tienda')
WHERE u.idusuario IN (1, 4, 5, 10, 11, 22, 23, 24, 27, 28);

INSERT IGNORE INTO `tmp_acceso_inicial` (`idusuario`, `idacceso_vista`)
SELECT u.idusuario, a.idacceso_vista FROM usuario u JOIN acceso_vista a
  ON a.clave = 'consultar_productos'
WHERE u.idusuario BETWEEN 1 AND 12 OR u.idusuario IN (14, 22, 24, 25, 26, 28, 29, 30);

INSERT IGNORE INTO `tmp_acceso_inicial` (`idusuario`, `idacceso_vista`)
SELECT u.idusuario, a.idacceso_vista FROM usuario u JOIN acceso_vista a
  ON a.clave = 'consultar_clientes'
WHERE u.idusuario IN (1, 2, 3, 4, 5, 7, 8, 9, 11, 12, 14, 26, 28);

INSERT IGNORE INTO `tmp_acceso_inicial` (`idusuario`, `idacceso_vista`)
SELECT u.idusuario, a.idacceso_vista FROM usuario u JOIN acceso_vista a
  ON a.clave = 'prod_op'
WHERE u.idusuario IN (1, 4, 5, 24, 25, 28) OR u.idusuario BETWEEN 7 AND 12 OR u.idusuario BETWEEN 14 AND 22;

INSERT IGNORE INTO `tmp_acceso_inicial` (`idusuario`, `idacceso_vista`)
SELECT u.idusuario, a.idacceso_vista FROM usuario u JOIN acceso_vista a
  ON a.clave = 'prod_seguimiento'
WHERE u.idusuario IN (1, 4, 5, 7, 8, 9, 11, 12, 14, 24, 28);

INSERT IGNORE INTO `tmp_acceso_inicial` (`idusuario`, `idacceso_vista`)
SELECT u.idusuario, a.idacceso_vista FROM usuario u JOIN acceso_vista a
  ON a.clave IN ('prod_tabulador', 'prod_materia_prima', 'notificaciones')
WHERE u.idusuario IN (1, 4, 5, 7, 8, 9, 11, 12, 14, 28);

INSERT IGNORE INTO `tmp_acceso_inicial` (`idusuario`, `idacceso_vista`)
SELECT u.idusuario, a.idacceso_vista FROM usuario u JOIN acceso_vista a
  ON a.clave IN ('prod_correcciones', 'reportes', 'admin_accesos')
WHERE u.idusuario IN (1, 28);

INSERT INTO `usuario_acceso_vista` (`idusuario`, `idacceso_vista`)
SELECT t.idusuario, t.idacceso_vista FROM `tmp_acceso_inicial` t
WHERE NOT EXISTS (SELECT 1 FROM `usuario_acceso_vista` x WHERE x.idusuario = t.idusuario);

DROP TEMPORARY TABLE IF EXISTS `tmp_acceso_inicial`;
