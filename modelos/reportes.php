<?php

//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Reportes
{
	public function __construct()
	{

	}

	public function listar_pedidos_entregados($fecha_ini,$fecha_fin)
	{

		$sql="SELECT a.fecha_pedido, a.tipo, b.lugar, a.no_control, c.nombre as nombre_cli, a.estatus,

		(SELECT fecha FROM estatus_pedido_fab WHERE idpedido=a.idpg_pedidos AND comentario LIKE '%ENTREGADO%' ORDER BY fecha DESC LIMIT 1) AS fecha_ent_cli  

		FROM pg_pedidos a INNER JOIN usuario b ON a.idusuario=b.idusuario INNER JOIN clientes c ON a.idcliente=c.idcliente

		WHERE DATE(a.fecha_pedido) >= '$fecha_ini' AND DATE(a.fecha_pedido) <= '$fecha_fin' AND a.estatus='ENTREGADO' ";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function listar_pedidos_pendientes()
	{

		$sql="SELECT * FROM pg_pedidos a WHERE estatus<>'ENTREGADO' AND estatus<>'CANCELADO' AND estatus<>'0'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	


}
?>

