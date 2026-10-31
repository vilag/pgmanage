-- Bloqueos de la vista accesos.php
-- Requiere 2026_10_28_accesos_menu.sql y 2026_10_28_categorias_usuario.sql.
-- Solo modifica las tablas creadas por esos scripts. Se puede ejecutar más de una vez.

-- Clave fija por categoría: el código identifica al administrador del sistema y a las
-- categorías que pueden cambiar de menú por esta clave, no por el nombre visible
ALTER TABLE `categoria_usuario` ADD COLUMN IF NOT EXISTS `clave` varchar(30) DEFAULT NULL AFTER `idcategoria_usuario`;
ALTER TABLE `categoria_usuario` ADD UNIQUE KEY IF NOT EXISTS `uk_categoria_usuario_clave` (`clave`);

UPDATE `categoria_usuario` SET `clave` = 'admin_sistema'  WHERE `nombre` = 'Administración del sistema' AND `clave` IS NULL;
UPDATE `categoria_usuario` SET `clave` = 'direccion'      WHERE `nombre` = 'Dirección'                  AND `clave` IS NULL;
UPDATE `categoria_usuario` SET `clave` = 'administrativo' WHERE `nombre` = 'Administrativo'             AND `clave` IS NULL;
UPDATE `categoria_usuario` SET `clave` = 'ventas'         WHERE `nombre` = 'Ventas'                     AND `clave` IS NULL;
UPDATE `categoria_usuario` SET `clave` = 'distribuidores' WHERE `nombre` = 'Distribuidores'             AND `clave` IS NULL;
UPDATE `categoria_usuario` SET `clave` = 'calidad'        WHERE `nombre` = 'Calidad'                    AND `clave` IS NULL;
UPDATE `categoria_usuario` SET `clave` = 'almacen'        WHERE `nombre` = 'Almacén y logística'        AND `clave` IS NULL;
UPDATE `categoria_usuario` SET `clave` = 'produccion'     WHERE `nombre` = 'Producción'                 AND `clave` IS NULL;

-- Permiso para ver el botón de cambio de menú (solo Dirección o Administrativo, o el administrador del sistema)
INSERT IGNORE INTO `acceso_vista` (`clave`, `nombre`, `grupo`, `url`, `orden`) VALUES
('cambiar_menu', 'Cambiar entre menú anterior y nuevo (solo para sí mismo)', 'Administración', NULL, 81);

-- El administrador del sistema tiene todas las vistas
INSERT IGNORE INTO `usuario_acceso_vista` (`idusuario`, `idacceso_vista`)
SELECT uc.idusuario, a.idacceso_vista
FROM `usuario_categoria` uc
JOIN `categoria_usuario` c ON c.idcategoria_usuario = uc.idcategoria_usuario AND c.clave = 'admin_sistema'
CROSS JOIN `acceso_vista` a;
