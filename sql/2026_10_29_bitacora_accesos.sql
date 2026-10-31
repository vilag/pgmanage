-- Bitácora de cambios de accesos hechos desde accesos.php
-- No modifica tablas existentes. Se puede ejecutar más de una vez.
-- La aplicación solo inserta y consulta; no hay forma de editar ni borrar registros desde ella.

CREATE TABLE IF NOT EXISTS `bitacora_accesos` (
  `idbitacora_accesos` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `idusuario_editor` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `categoria_antes` varchar(60) DEFAULT NULL,
  `categoria_despues` varchar(60) DEFAULT NULL,
  `agregados` text DEFAULT NULL,
  `quitados` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idbitacora_accesos`),
  KEY `idx_bitacora_accesos_usuario` (`idusuario`),
  KEY `idx_bitacora_accesos_fecha` (`fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
