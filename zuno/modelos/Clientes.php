<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Clientes
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	
	//Implementar un método para listar los registros
	public function listar()
	{

		$sql="SELECT * FROM clientes ORDER BY idcliente DESC";
		return ejecutarConsulta($sql);		
	}

	public function guardar_cliente($num_cliente_new,$nombre_new,$email_new,$telefono_new,$rfc_new,$calle_new,$numero_new,$interior_new,$colonia_new,$municipio_new,$estado_new,$referencia_new,$fecha_hora)
	{

		$sql="INSERT INTO clientes (no_cliente,nombre,email,telefono,rfc,calle,numero,interior,colonia,municipio,estado,referencia,estatus,fecha_reg) VALUES('$num_cliente_new','$nombre_new','$email_new','$telefono_new','$rfc_new','$calle_new','$numero_new','$interior_new','$colonia_new','$municipio_new','$estado_new','$referencia_new','0','$fecha_hora')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM clientes WHERE idcliente='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);		
	}

	public function buscar_nom_cli($nombre_new)
	{

		$sql="SELECT * FROM clientes WHERE nombre='$nombre_new'";
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function consul_cliente($idcliente)
	{

		$sql="SELECT * FROM clientes WHERE idcliente='$idcliente'";
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function listar_historico_pedidos($no_cliente)
	{

		$sql="SELECT * FROM pedidos WHERE num_cliente='$no_cliente'";
		return ejecutarConsulta($sql);		
	}

	public function listar_historico_ventas($no_cliente)
	{

		$sql="SELECT v.folio,v.descripcion,v.total_pago,v.estatus, v.fecha_hora FROM ventas v INNER JOIN clientes c ON v.idcliente=c.idcliente WHERE c.no_cliente='$no_cliente'";
		return ejecutarConsulta($sql);		
	}

	

}

?>