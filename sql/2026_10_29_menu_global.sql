-- Menú del sistema para todos los usuarios, controlado por el administrador del sistema.
-- No modifica tablas existentes. Se puede ejecutar más de una vez (no cambia el valor si ya existe).

CREATE TABLE IF NOT EXISTS `configuracion_sistema` (
  `clave` varchar(50) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `idusuario_modifico` int(11) DEFAULT NULL,
  PRIMARY KEY (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 0 = menú anterior (header.php) para todos, 1 = menú nuevo (header_nuevo.php) para todos
INSERT IGNORE INTO `configuracion_sistema` (`clave`, `valor`) VALUES ('menu_nuevo_global', '0');

-- El permiso "Cambiar menú" ahora solo cambia el menú de quien lo tiene
UPDATE `acceso_vista` SET `nombre` = 'Cambiar entre menú anterior y nuevo (solo para sí mismo)' WHERE `clave` = 'cambiar_menu';
