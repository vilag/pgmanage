<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Index
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	
	//Implementar un método para listar los registros
	public function save_contact_form($nombre,$email,$telefono,$mensaje,$plataforma,$check_noti,$fecha_hora)
	{

		$sql="INSERT INTO contactos(nombre,email,telefono,mensaje,plataforma,noticias,fecha_hora,estatus,venta) VALUES ('$nombre','$email','$telefono','$mensaje','$plataforma','$check_noti','$fecha_hora','0','0')";
		return ejecutarConsulta($sql);		
	}

}

?>