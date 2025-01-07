<?php 

require "../config/Conexion.php";

Class Alm_mat_prima
{

	public function __construct()
	{

	}

	public function listar_productos_mat()
	{
		$sql="SELECT
		a.id_prod_alm_mat,
		a.nombre,
		a.descripcion,
		a.cantidad,
		(SELECT nombre FROM 10_tipo_alm_mat WHERE idtipo_alm_mat = a.idtipo) as tipo,
		a.idtipo,
		a.consec,
		a.observaciones,
		a.ubicacion,
		a.folio_prov,
		(SELECT sum(cantidad) FROM 10_entrada_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as entradas,
		(SELECT sum(cantidad) FROM 10_salida_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat AND estatus=1) as salidas,
		a.unidad
		
		FROM 10_prod_alm_mat a ORDER BY a.consec DESC";
		return ejecutarConsulta($sql);
	}

	public function guardar_producto($nombre,$descripcion,$cantidad,$tipo,$next_consec,$ubicacion,$folio_prov,$observaciones,$unidad)
	{

		$sql="INSERT INTO 10_prod_alm_mat (nombre, descripcion, cantidad, idtipo, consec, observaciones, ubicacion, folio_prov, unidad) VALUES('$nombre','$descripcion','$cantidad','$tipo','$next_consec','$observaciones','$ubicacion','$folio_prov','$unidad')";
		return ejecutarConsulta($sql);
	}

	public function update_producto($nombre,$descripcion,$cantidad,$tipo,$ubicacion,$folio_prov,$observaciones,$id_prod_alm_mat)
	{

		$sql="UPDATE 10_prod_alm_mat SET nombre='$nombre', idtipo='$tipo', ubicacion='$ubicacion', folio_prov='$folio_prov', observaciones='$observaciones' WHERE id_prod_alm_mat = '$id_prod_alm_mat'";
		return ejecutarConsulta($sql);
	}

	public function listar_tipos()
	{
		$sql="SELECT
		a.idtipo_alm_mat,
		a.nombre,
		a.descripcion
		
		
		FROM 10_tipo_alm_mat a ORDER BY nombre ASC";
		return ejecutarConsulta($sql);
	}

	public function guardar_tipo($nombre,$descripcion)
	{
		$sql="INSERT INTO 10_tipo_alm_mat (nombre, descripcion) VALUES('$nombre','$descripcion')";
		return ejecutarConsulta($sql);
	}

	public function max_consec()
	{
		$sql="SELECT count(id_prod_alm_mat ) as max FROM 10_prod_alm_mat";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function buscar_prod_mat($texto)
	{
		$sql="SELECT
		a.id_prod_alm_mat,
		a.nombre,
		a.descripcion,
		a.cantidad,
		(SELECT nombre FROM 10_tipo_alm_mat WHERE idtipo_alm_mat = a.idtipo) as tipo,
		a.idtipo,
		a.consec,
		a.observaciones,
		a.ubicacion,
		a.folio_prov,
		a.unidad,
		(SELECT sum(cantidad) FROM 10_entrada_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as entradas,
		(SELECT sum(cantidad) FROM 10_salida_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat AND estatus=1) as salidas
		
		FROM 10_prod_alm_mat a WHERE a.nombre LIKE '%".$texto."%' ORDER BY a.consec DESC";
		return ejecutarConsulta($sql);
	}

	public function guardar_entrada($id_select_prod,$cantidad_entrada,$proveedor_entrada,$lote_entrada,$fecha_hora,$observacion)
	{
		$sql="INSERT INTO 10_entrada_alm_mat (id_prod_alm_mat, cantidad, proveedor, lote, fecha, observacion) VALUES('$id_select_prod','$cantidad_entrada','$proveedor_entrada','$lote_entrada','$fecha_hora','$observacion')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM 10_entrada_alm_mat WHERE identrada='$idingresonew'";
	    return ejecutarConsultaSimpleFila($sql_id);
	}

	public function guardar_salida($id_select_prod,$cantidad_salida,$proveedor_salida,$lote_salida,$no_control_salida,$op_salida,$fecha_hora,$observacion)
	{
		$sql="INSERT INTO 10_salida_alm_mat (id_prod_alm_mat, cantidad, proveedor, lote, no_control, op, fecha, observacion) VALUES('$id_select_prod','$cantidad_salida','$proveedor_salida','$lote_salida','$no_control_salida','$op_salida','$fecha_hora', '$observacion')";
		return ejecutarConsulta($sql);
	}

	public function listar_movimientos_entradas_gen()
	{
		
		$sql="SELECT  
		
		a.identrada,
		(SELECT nombre FROM 10_prod_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as nombre,
		a.cantidad,
		a.proveedor,
		a.lote,
		a.fecha,
		a.observacion
		
		FROM 10_entrada_alm_mat a ORDER BY a.identrada DESC";
		return ejecutarConsulta($sql);
	}

	public function listar_movimientos_entradas($idprod)
	{

		$sql="SELECT  
		
		a.identrada,
		(SELECT nombre FROM 10_prod_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as nombre,
		a.cantidad,
		a.proveedor,
		a.lote,
		a.fecha,
		a.observacion
		
		FROM 10_entrada_alm_mat a WHERE a.id_prod_alm_mat='$idprod' ORDER BY a.identrada DESC";
		return ejecutarConsulta($sql);
	}

	public function listar_movimientos_entradas_prod($idprod)
	{
		$sql="SELECT  
		
		a.identrada,
		(SELECT nombre FROM 10_prod_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as nombre,
		a.cantidad,
		a.proveedor,
		a.lote,
		a.fecha,
		a.observacion
		
		FROM 10_entrada_alm_mat a WHERE a.id_prod_alm_mat='$idprod' ORDER BY a.identrada DESC";
		return ejecutarConsulta($sql);
	}

	public function listar_movimientos_salidas_gen()
	{
		$sql="SELECT  
		
		a.idsalida,
		(SELECT nombre FROM 10_prod_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as nombre,
		a.cantidad,
		a.proveedor,
		a.lote,
		a.no_control,
		a.op,
		a.fecha,
		a.observacion
		
		FROM 10_salida_alm_mat a WHERE a.estatus=1 ORDER BY a.idsalida DESC";
		return ejecutarConsulta($sql);
	}

	public function listar_movimientos_salidas($idprod)
	{
		$sql="SELECT  
		
		a.idsalida,
		(SELECT nombre FROM 10_prod_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as nombre,
		a.cantidad,
		a.proveedor,
		a.lote,
		a.no_control,
		a.op,
		a.fecha,
		a.observacion
		
		FROM 10_salida_alm_mat a WHERE a.id_prod_alm_mat='$idprod' AND a.estatus=1 ORDER BY a.idsalida DESC";
		return ejecutarConsulta($sql);
	}

	public function listar_movimientos_salidas_prod($idprod)
	{
		$sql="SELECT  
		
		a.idsalida,
		(SELECT nombre FROM 10_prod_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as nombre,
		a.cantidad,
		a.proveedor,
		a.lote,
		a.no_control,
		a.op,
		a.fecha,
		a.observacion
		
		FROM 10_salida_alm_mat a WHERE a.id_prod_alm_mat='$idprod' AND a.estatus=1 ORDER BY a.idsalida DESC";
		return ejecutarConsulta($sql);
	}

	public function contar_existencia($id_prod_alm_mat)
	{
		$sql="SELECT 
		
		(SELECT sum(cantidad) FROM 10_entrada_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as entradas,
		(SELECT sum(cantidad) FROM 10_salida_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat AND estatus=1) as salidas
		
		FROM 10_entrada_alm_mat a WHERE a.id_prod_alm_mat='$id_prod_alm_mat'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function coincidencias($nombre)
	{
		$sql="SELECT * FROM 10_prod_alm_mat WHERE nombre LIKE '%".$nombre."%'";
		return ejecutarConsulta($sql);
	}

	public function borrar_producto($id_prod_alm_mat)
	{
		$sql="DELETE FROM 10_prod_alm_mat WHERE id_prod_alm_mat='$id_prod_alm_mat'";
		return ejecutarConsulta($sql);
	}

	public function update_lote_int($idnew,$newlote)
	{
		$sql="UPDATE 10_entrada_alm_mat SET lote = '$newlote' WHERE identrada='$idnew'";
		return ejecutarConsulta($sql);
	}

	public function updateSalidaAmp($idsalida,$cantidad,$proveedor,$lote,$control,$op,$obs)
	{
		$sql="UPDATE 10_salida_alm_mat SET cantidad = '$cantidad', proveedor = '$proveedor', lote = '$lote', no_control = '$control', op='$op', observacion='$obs' WHERE idsalida='$idsalida'";
		return ejecutarConsulta($sql);
	}

	public function updateEntradaAmp($identrada,$cantidad,$proveedor,$lote,$obs)
	{
		$sql="UPDATE 10_entrada_alm_mat SET cantidad = '$cantidad', proveedor = '$proveedor', lote = '$lote', observacion='$obs' WHERE identrada='$identrada'";
		return ejecutarConsulta($sql);
	}

	public function borrar_salida($idsalida)
	{
		$sql="UPDATE 10_salida_alm_mat SET estatus = 0 WHERE idsalida='$idsalida'";
		return ejecutarConsulta($sql);
	}

	public function borrar_entrada($identrada)
	{
		$sql="DELETE FROM 10_entrada_alm_mat WHERE identrada='$identrada'";
		// $sql="UPDATE 10_entrada_alm_mat SET estatus = 0 WHERE identrada='$identrada'";
		return ejecutarConsulta($sql);
	}

}

?>