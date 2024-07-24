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
		(SELECT sum(cantidad) FROM 10_salida_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as salidas
		
		FROM 10_prod_alm_mat a ORDER BY a.consec DESC";
		return ejecutarConsulta($sql);
	}

	public function guardar_producto($nombre,$descripcion,$cantidad,$tipo,$next_consec,$ubicacion,$folio_prov,$observaciones)
	{

		$sql="INSERT INTO 10_prod_alm_mat (nombre, descripcion, cantidad, idtipo, consec, observaciones, ubicacion, folio_prov) VALUES('$nombre','$descripcion','$cantidad','$tipo','$next_consec','$observaciones','$ubicacion','$folio_prov')";
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
		(SELECT sum(cantidad) FROM 10_entrada_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as entradas,
		(SELECT sum(cantidad) FROM 10_salida_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as salidas
		
		FROM 10_prod_alm_mat a WHERE a.nombre LIKE '%".$texto."%' ORDER BY a.consec DESC";
		return ejecutarConsulta($sql);
	}

	public function guardar_entrada($id_select_prod,$cantidad_entrada,$proveedor_entrada,$lote_entrada)
	{
		$sql="INSERT INTO 10_entrada_alm_mat (id_prod_alm_mat, cantidad, proveedor, lote) VALUES('$id_select_prod','$cantidad_entrada','$proveedor_entrada','$lote_entrada')";
		return ejecutarConsulta($sql);
	}

	public function guardar_salida($id_select_prod,$cantidad_salida,$proveedor_salida,$lote_salida,$no_control_salida,$op_salida)
	{
		$sql="INSERT INTO 10_salida_alm_mat (id_prod_alm_mat, cantidad, proveedor, lote, no_control, op) VALUES('$id_select_prod','$cantidad_salida','$proveedor_salida','$lote_salida','$no_control_salida','$op_salida')";
		return ejecutarConsulta($sql);
	}

	public function listar_movimientos_entradas_gen()
	{
		
		$sql="SELECT  
		
		a.identrada,
		(SELECT nombre FROM 10_prod_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as nombre,
		a.cantidad,
		a.proveedor,
		a.lote
		
		FROM 10_entrada_alm_mat a ORDER BY a.identrada ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_movimientos_entradas($idprod)
	{

		$sql="SELECT  
		
		a.identrada,
		(SELECT nombre FROM 10_prod_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as nombre,
		a.cantidad,
		a.proveedor,
		a.lote
		
		FROM 10_entrada_alm_mat a WHERE a.id_prod_alm_mat='$idprod' ORDER BY a.identrada ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_movimientos_entradas_prod($idprod)
	{
		$sql="SELECT  
		
		a.identrada,
		(SELECT nombre FROM 10_prod_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as nombre,
		a.cantidad,
		a.proveedor,
		a.lote
		
		FROM 10_entrada_alm_mat a WHERE a.id_prod_alm_mat='$idprod' ORDER BY a.identrada ASC";
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
		a.op
		
		FROM 10_salida_alm_mat a ORDER BY a.idsalida ASC";
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
		a.op
		
		FROM 10_salida_alm_mat a WHERE a.id_prod_alm_mat='$idprod' ORDER BY a.idsalida ASC";
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
		a.op
		
		FROM 10_salida_alm_mat a WHERE a.id_prod_alm_mat='$idprod' ORDER BY a.idsalida ASC";
		return ejecutarConsulta($sql);
	}

	public function contar_existencia($id_prod_alm_mat)
	{
		$sql="SELECT 
		
		(SELECT sum(cantidad) FROM 10_entrada_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as entradas,
		(SELECT sum(cantidad) FROM 10_salida_alm_mat WHERE id_prod_alm_mat=a.id_prod_alm_mat) as salidas
		
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

}

?>