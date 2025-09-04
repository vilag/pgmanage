<?php

//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Reportes
{
	public function __construct()
	{

	}

	public function llenar_anios()
    {
        $sql="SELECT DISTINCT YEAR(fecha_hora) as anios FROM pg_detped ORDER BY YEAR(fecha_hora) DESC";
        return ejecutarConsulta($sql); 
    }
	public function llenar_meses($anio_actual)
    {
        $sql="SELECT DISTINCT MONTH(fecha_hora) as meses FROM pg_detped WHERE YEAR(fecha_hora)='$anio_actual' ORDER BY MONTH(fecha_hora) DESC";
        return ejecutarConsulta($sql); 
    }

	public function listar_pedidos($mes_actual,$anio_actual,$tipo)
    {
		if ($tipo==1) {
			$sql="SELECT a.no_control, a.fecha_pedido, c.nombre as nombre_tipo, b.lugar, a.estatus 
			FROM pg_pedidos a 
			INNER JOIN usuario b ON a.idusuario=b.idusuario
			INNER JOIN pg_tipo_pedido c ON a.tipo=c.idtipo
			WHERE YEAR(a.fecha_pedido)='$anio_actual' AND MONTH(a.fecha_pedido)='$mes_actual' AND a.estatus2=1 AND a.estatus<>'CANCELADO' ORDER BY a.fecha_pedido desc";
			return ejecutarConsulta($sql);
		}

		if ($tipo==2) {
			$sql="SELECT a.no_control, a.fecha_pedido, c.nombre as nombre_tipo, b.lugar, a.estatus 
			FROM pg_pedidos a 
			INNER JOIN usuario b ON a.idusuario=b.idusuario
			INNER JOIN pg_tipo_pedido c ON a.tipo=c.idtipo
			WHERE YEAR(a.fecha_pedido)='$anio_actual' AND MONTH(a.fecha_pedido)='$mes_actual' AND a.estatus2=1 AND a.estatus<>'CANCELADO' AND a.estatus='ENTREGADO' ORDER BY a.fecha_pedido desc";
			return ejecutarConsulta($sql);
		}

		if ($tipo==3) {
			$sql="SELECT a.no_control, a.fecha_pedido, c.nombre as nombre_tipo, b.lugar, a.estatus 
			FROM pg_pedidos a 
			INNER JOIN usuario b ON a.idusuario=b.idusuario
			INNER JOIN pg_tipo_pedido c ON a.tipo=c.idtipo
			WHERE YEAR(a.fecha_pedido)='$anio_actual' AND MONTH(a.fecha_pedido)='$mes_actual' AND a.estatus2=1 AND a.estatus<>'CANCELADO' AND a.estatus<>'ENTREGADO' ORDER BY a.fecha_pedido desc";
			return ejecutarConsulta($sql);
		}

		if ($tipo==4) {
			$sql="SELECT a.no_control, a.fecha_pedido, c.nombre as nombre_tipo, b.lugar, a.estatus 
			FROM pg_pedidos a 
			INNER JOIN usuario b ON a.idusuario=b.idusuario
			INNER JOIN pg_tipo_pedido c ON a.tipo=c.idtipo
			WHERE YEAR(a.fecha_pedido)='$anio_actual' AND MONTH(a.fecha_pedido)='$mes_actual' AND a.estatus2=1 AND a.estatus='CANCELADO' ORDER BY a.fecha_pedido desc";
			return ejecutarConsulta($sql);
		}
			 
    }













	public function buscar_pedidos_fabricados($fecha_ini,$fecha_fin){
		$sql="SELECT * FROM pg pedidos a WHERE estatus";
		return ejecutarConsulta($sql);
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

