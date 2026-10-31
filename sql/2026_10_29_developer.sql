-- Categoría "developer": nivel técnico por encima del administrador del sistema.
-- Tiene todo lo del administrador (acceso total, cambiar el menú de todos) y además las herramientas de
-- desarrollo, como refrescar QA con producción. Un administrador del sistema no puede editar a un developer
-- ni asignar esta categoría (ver modelos/Accesos.php).
-- Requiere 2026_10_29_bloqueos_accesos.sql. Se puede ejecutar más de una vez.

INSERT IGNORE INTO `categoria_usuario` (`clave`, `nombre`, `descripcion`, `orden`) VALUES
('developer', 'Developer', 'Nivel técnico: todo lo del administrador del sistema más herramientas de desarrollo (refrescar QA)', 5);
