<?php

//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Correcciones
{
	public function __construct()
	{

	}

	public function listar_prod()
	{

		$sql="SELECT a.idpg_detped,b.no_control,
		(SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=a.iddetalle_pedido) as codigo 
		
		FROM pg_detped a INNER JOIN pg_pedidos b ON a.idpedido=b.idpg_pedidos WHERE (b.estatus<>'CANCELADO' OR b.estatus<>'ENTREGADO') AND (SELECT count(idpg_detped) FROM op_detalle_prod WHERE idpg_detped=a.idpg_detped)>1";
		return ejecutarConsulta($sql);			
	}

	public function listar_op($idpg_deped)
	{

		$sql="SELECT a.idop_detalle_prod, b.no_op,

		(SELECT nombre FROM area WHERE idarea = (SELECT area FROM op_detalle WHERE idop=a.idop AND area=1 LIMIT 1)) as herreria,
		(SELECT nombre FROM area WHERE idarea = (SELECT area FROM op_detalle WHERE idop=a.idop AND area=2 LIMIT 1)) as pintura,
		(SELECT nombre FROM area WHERE idarea = (SELECT area FROM op_detalle WHERE idop=a.idop AND area=3 LIMIT 1)) as plasticos,
		(SELECT nombre FROM area WHERE idarea = (SELECT area FROM op_detalle WHERE idop=a.idop AND area=5 LIMIT 1)) as Ens_porc,
		(SELECT nombre FROM area WHERE idarea = (SELECT area FROM op_detalle WHERE idop=a.idop AND area=6 LIMIT 1)) as Ens_com,
		(SELECT nombre FROM area WHERE idarea = (SELECT area FROM op_detalle WHERE idop=a.idop AND area=7 LIMIT 1)) as Ens_mue,
		(SELECT nombre FROM area WHERE idarea = (SELECT area FROM op_detalle WHERE idop=a.idop AND area=8 LIMIT 1)) as horno
	

		FROM op_detalle_prod a INNER JOIN op b ON a.idop=b.idop WHERE a.idpg_detped='$idpg_deped'";
		return ejecutarConsulta($sql);			
	}

	public function quitar($idop_detalle_prod)
	{

		$sql="DELETE FROM op_detalle_prod WHERE idop_detalle_prod='$idop_detalle_prod'";
		return ejecutarConsulta($sql);			
	}

	public function exist_avance($idop_detalle_prod)
	{

		$sql="SELECT count(idop_detalle_prod) as avance FROM op_avance_prod WHERE idop_detalle_prod='$idop_detalle_prod'";
		return ejecutarConsultaSimpleFila($sql);			
	}



}
?>