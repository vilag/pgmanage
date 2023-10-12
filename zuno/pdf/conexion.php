<?php

	/*$mysqli = new mysqli('localhost', 'root', '', 'pizarrones_db');

	if ($mysqli->connect_error) {
		die('Error en la conexion' . $mysqli->connect_error);
	}*/


     //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	$mysqli = new mysqli("localhost","root","","pizarrones_db"); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}

	
?>