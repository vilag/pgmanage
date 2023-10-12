<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Materia_prima
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	

	//Función para verificar el acceso al sistema
	public function listar_materia_prima()
    {
    	$sql="SELECT * FROM materia_prima ORDER BY idmateria_prima ASC";
		return ejecutarConsulta($sql);  
    }

    //Función para verificar el acceso al sistema
	public function guardar_mat($descrip,$calibre,$pulgadas,$medidas,$unidad)
    {
    	$sql="INSERT INTO materia_prima (descripcion,calibre,pulgadas,valor_tramo,unidad_m) VALUES('$descrip','$calibre','$pulgadas','$medidas','$unidad')";
		return ejecutarConsulta($sql);  
    }

    

    
}

?>