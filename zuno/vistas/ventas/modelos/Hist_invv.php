<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../../../config/Conexion.php";

Class Hist_invv
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	
	//Implementar un método para listar los registros
	public function listar()
	{

		$sql="SELECT fecha_hora,codigo_prod,exist_base,exist_actual,tipo,movimiento,idventa FROM historial_inv_zuno ORDER BY fecha_hora desc";
		return ejecutarConsulta($sql);		
	}

	
}

?>