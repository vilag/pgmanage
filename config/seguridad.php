<?php
//Encabezados de seguridad comunes. Se envían desde PHP y no desde .htaccess porque no todos los
//servidores tienen mod_headers activo (el contenedor de Docker no lo tiene).
if (!function_exists('enviar_encabezados_seguridad'))
{
	function enviar_encabezados_seguridad()
	{
		if (headers_sent()) {
			return;
		}
		//El navegador no debe adivinar el tipo de un archivo distinto al que indica el servidor
		header('X-Content-Type-Options: nosniff');
		//Solo este mismo sitio puede mostrar sus páginas dentro de un iframe (evita clickjacking)
		header('X-Frame-Options: SAMEORIGIN');
		//No anunciar la versión de PHP
		header_remove('X-Powered-By');
	}
}

enviar_encabezados_seguridad();
?>
