<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Pedidos
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	
	//Implementar un método para listar los registros
	public function listar()
	{

		$sql="SELECT * FROM pedidos ORDER BY idpedidos DESC";
		return ejecutarConsulta($sql);		
	}

	public function guardar_pedido($num_cliente,$num_pedido,$nombre,$fecha_hora)
	{

		$sql="INSERT INTO pedidos (num_cliente,num_pedido,nombre,fecha_hora,estatus) VALUES('$num_cliente','$num_pedido','$nombre','$fecha_hora','Solicitud enviada')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT idpedidos FROM pedidos WHERE idpedidos='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);		
	}



	

}

?>