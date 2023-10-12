<?php 

require "../config/Conexion.php";

Class Nuevo_pedido
{

	public function __construct()
	{

	}

	

	public function listar_tipos()
	{

		//$sql="SELECT * FROM prod_tipo ORDER BY nombre ASC";
		$sql="SELECT DISTINCT tp.id_tipo,t.nombre FROM tbl_prod tp INNER JOIN prod_tipo t ON tp.id_tipo=t.idprod_tipo ORDER BY tp.id_tipo ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_modelo($id)
	{

		$sql="SELECT DISTINCT tp.id_modelo,pm.nombre FROM tbl_prod tp INNER JOIN prod_modelo pm ON tp.id_modelo=pm.idprod_modelo WHERE tp.id_tipo = '$id' ORDER BY tp.id_modelo ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_grados($id,$idmodelo)
	{

		$sql="SELECT DISTINCT tp.id_tamanio,pm.nombre FROM tbl_prod tp INNER JOIN prod_tamano pm ON tp.id_tamanio=pm.idprod_tamano WHERE tp.id_tipo = '$id' AND tp.id_modelo='$idmodelo' ORDER BY tp.id_tamanio ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_grupos()
	{
		$sql="SELECT DISTINCT tp.codigo_group,tp.nombre_group FROM tbl_prod tp ORDER BY tp.codigo_group ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_tamano($codigo_group)
	{

		$sql="SELECT ptd.idtbl_prod,ptd.id_tipo,ptd.medida1,ptd.medida2,ptd.medida3,ptd.medida4,ptd.unidad FROM tbl_prod ptd WHERE ptd.codigo_group='$codigo_group' ORDER BY ptd.idtbl_prod ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_colores($idtbl_prod)
	{

		$sql="SELECT tpc.idtblprod_colores,tpc.nombre,tpc.codigo_hex,tpc.codigo,
		(SELECT detalle FROM tbl_colores_det WHERE codigo=tpc.codigo) as detalle

		FROM tbl_prod_colores tpc  WHERE tpc.idtbl_prod='$idtbl_prod' AND base=1 ORDER BY tpc.codigo_hex ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_colores_esp($idtbl_prod)
	{

		$sql="SELECT tpc.idtblprod_colores,tpc.nombre,tpc.codigo_hex,tpc.codigo,
		(SELECT detalle FROM tbl_colores_det WHERE codigo=tpc.codigo) as detalle

		FROM tbl_prod_colores tpc  WHERE tpc.idtbl_prod='$idtbl_prod' AND base=0 ORDER BY tpc.codigo_hex ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_colores_prod($idtbl_prod)
	{

		$sql="SELECT t.idtblprod_colores,t.idtbl_prod,t.nombre,t.codigo
		FROM tbl_prod_colores t WHERE t.idtbl_prod='$idtbl_prod'";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_tipo_buscado($codigo_buscar)
	{

		$sql="SELECT ptd.idtbl_prod,ptd.codigo_group, ptd.nombre_group,ptd.idproductos_clasif,ptd.precio,ptd.set_color,ptd.id_tipo,ptd.codigo,ptd.id_modelo,ptd.set_material,ptd.codigo_s FROM tbl_prod ptd WHERE ptd.codigo_group LIKE '%".$codigo_buscar."%' OR ptd.nombre_group LIKE '%".$codigo_buscar."%' GROUP BY ptd.codigo_group";

		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_tipo($id)
	{

		$sql="SELECT ptd.idtbl_prod,ptd.codigo_group, ptd.nombre_group,ptd.idproductos_clasif,ptd.precio,ptd.set_color,ptd.id_tipo,ptd.codigo,ptd.id_modelo,ptd.set_material,ptd.codigo_s FROM tbl_prod ptd WHERE ptd.id_tipo='$id' GROUP BY ptd.codigo_group";

		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_tipo_modelo($id,$idmodelo)
	{

		$sql="SELECT ptd.idtbl_prod,ptd.codigo_group, ptd.nombre_group,ptd.idproductos_clasif,ptd.precio,ptd.set_color,ptd.id_tipo,ptd.codigo,ptd.id_modelo,ptd.set_material,ptd.codigo_s FROM tbl_prod ptd WHERE ptd.id_tipo='$id' AND ptd.id_modelo='$idmodelo' GROUP BY ptd.codigo_group";

		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_tipo_modelo_tam($id,$idmodelo,$idtam)
	{

		$sql="SELECT ptd.idtbl_prod,ptd.codigo_group, ptd.nombre_group,ptd.idproductos_clasif,ptd.precio,ptd.set_color,ptd.id_tipo,ptd.codigo,ptd.id_modelo,ptd.set_material,ptd.codigo_s FROM tbl_prod ptd WHERE ptd.id_tipo='$id' AND ptd.id_modelo='$idmodelo' AND ptd.id_tamanio='$idtam' GROUP BY ptd.codigo_group";

		return ejecutarConsulta($sql);
	}




	public function listar_productos_resul_modelo($id,$id2)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtbl_prod) as nom_tamano FROM productos_clasif pc WHERE pc.idtipo='$id' AND pc.idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function buscar_codigo_group($select_busqueda_tipo)
	{

		$sql="SELECT ptd.codigo_group,ptd.nombre_group FROM productos_clasif pc INNER JOIN tbl_prod ptd ON pc.idproductos_clasif=ptd.idproductos_clasif WHERE ptd.id_tipo='$select_busqueda_tipo' LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function buscar_medidas_indep($select_busqueda_tamano)
	{

		$sql="SELECT ptd.idproductos_clasif,ptd.medida1,ptd.medida2,ptd.unidad,ptd.nombre_group,ptd.codigo_group, ptd.codigo
		FROM tbl_prod ptd WHERE ptd.idtbl_prod='$select_busqueda_tamano'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function guardar_color($idtbl_prod,$codigo,$nombre)
	{

		$sql="INSERT INTO tbl_prod_colores (idtbl_prod,nombre,codigo) VALUES('$idtbl_prod','$nombre','$codigo')";
		return ejecutarConsulta($sql);
	}

	public function borrar_color_prod($idtblprod_colores)
	{

		$sql="DELETE FROM tbl_prod_colores WHERE idtblprod_colores='$idtblprod_colores'";
		return ejecutarConsulta($sql);
	}

	public function buscar_datos_prod($idtbl_prod)
	{

		$sql="SELECT tp.idtbl_prod ,tp.idproductos_clasif, tp.concepto1, tp.medida1, tp.concepto2, tp.medida2, tp.concepto3, tp.medida3, tp.concepto4, tp.medida4, tp.unidad, tp.codigo_group, tp.codigo_s, tp.nombre_group, tp.nombre_group_esp, tp.id_tipo, tp.id_modelo, tp.id_modelo2, tp.id_tamanio, tp.codigo, tp.precio, tp.set_color, tp.set_material, tp.set_medidas, tp.set_medidas_edit, tp.codigo_s,tp.area, tp.set_c_rango,tp.porc_esp,tp.cm_min,tp.cm_max,tp.cm_min2,tp.cm_max2,tp.cm_min3,tp.cm_max3,tp.cm_min4,tp.cm_max4,
		(SELECT nombre FROM prod_tamano WHERE idprod_tamano=tp.id_tamanio) as tamano_mueble
		FROM tbl_prod tp WHERE tp.idtbl_prod='$idtbl_prod'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function buscar_nom_tamano($id_tamanio)
	{

		$sql="SELECT nombre FROM prod_tamano WHERE idprod_tamano='$id_tamanio'";
		return ejecutarConsultaSimpleFila($sql);
	}

	/*public function guardar_pedido($cant_2)
	{
		//$num_elementos=0;

		//while ($num_elementos < count($idtbl_prod)) {

			$sql="INSERT INTO prueba (cantidad) VALUES ('$cant_2')";
			return ejecutarConsulta($sql);

			//$num_elementos=$num_elementos + 1;
		 	// code...
		// } 


		 

		
	}*/



	public function listar_clientes($idusuario)
	{

		$sql="SELECT c.idcliente, c.nombre, c.lugar FROM clientes c WHERE c.nombre<>'' AND c.lugar = (SELECT lugar FROM usuario WHERE idusuario='$idusuario') ORDER BY nombre ASC LIMIT 10";
		return ejecutarConsulta($sql);
	}

	public function listar_clientes_buscar($nombre_buscar,$idusuario)
	{

		$sql="SELECT c.idcliente, c.nombre, c.lugar FROM clientes c WHERE c.nombre LIKE '%".$nombre_buscar."%' AND c.lugar = (SELECT lugar FROM usuario WHERE idusuario='$idusuario')  ORDER BY nombre ASC";
		return ejecutarConsulta($sql);
	}

	public function buscar_datos_cliente($idcliente)
	{
		$sql="SELECT c.idcliente, c.nombre, c.telefono, c.email,
		(SELECT razon_fac FROM dir_facturacion WHERE idcliente_fac=c.idcliente limit 1) as razon,
		(SELECT rfc_fac FROM dir_facturacion WHERE idcliente_fac=c.idcliente limit 1) as rfc,
		(SELECT calle_fac FROM dir_facturacion WHERE idcliente_fac=c.idcliente limit 1) as calle,
		(SELECT numero_fac FROM dir_facturacion WHERE idcliente_fac=c.idcliente limit 1) as numero,
		(SELECT interior_fac FROM dir_facturacion WHERE idcliente_fac=c.idcliente limit 1) as interior,
		(SELECT colonia_fac FROM dir_facturacion WHERE idcliente_fac=c.idcliente limit 1) as colonia,
		(SELECT ciudad_fac FROM dir_facturacion WHERE idcliente_fac=c.idcliente limit 1) as ciudad,
		(SELECT estado_fac FROM dir_facturacion WHERE idcliente_fac=c.idcliente limit 1) as estado,
		(SELECT cp_fac FROM dir_facturacion WHERE idcliente_fac=c.idcliente limit 1) as cp,
		

		(SELECT contacto_ent FROM dir_entregas WHERE idcliente_ent=c.idcliente limit 1) as contacto_ent,
		(SELECT calle_ent FROM dir_entregas WHERE idcliente_ent=c.idcliente limit 1) as calle_ent,
		(SELECT numero_ent FROM dir_entregas WHERE idcliente_ent=c.idcliente limit 1) as numero_ent,
		(SELECT interior_ent FROM dir_entregas WHERE idcliente_ent=c.idcliente limit 1) as interior_ent,
		(SELECT colonia_ent FROM dir_entregas WHERE idcliente_ent=c.idcliente limit 1) as colonia_ent,
		(SELECT ciudad_ent FROM dir_entregas WHERE idcliente_ent=c.idcliente limit 1) as ciudad_ent,
		(SELECT estado_ent FROM dir_entregas WHERE idcliente_ent=c.idcliente limit 1) as estado_ent,
		(SELECT cp_ent FROM dir_entregas WHERE idcliente_ent=c.idcliente limit 1) as cp_ent,
		(SELECT referencia_ent FROM dir_entregas WHERE idcliente_ent=c.idcliente limit 1) as ref_ent,
		(SELECT coordenadas FROM dir_entregas WHERE idcliente_ent=c.idcliente limit 1) as coordenadas


		FROM clientes c WHERE c.idcliente = '$idcliente'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function consul_max_idprecarga_docs($idprecarga)
	{

		$sql="SELECT count(idprecarga) as cant_idprecarga FROM documentos WHERE idprecarga='$idprecarga'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function guardar_cliente_nuevo(
				$nombre_cliente_new,
	 			$telefono_cliente_new,
	 			$email_cliente_new,
	 			$razon_cliente_new,
	 			$rfc_cliente_new,
	 			$calle_cliente_new,
	 			$numero_cliente_new,
	 			$interior_cliente_new,
	 			$colonia_cliente_new,
	 			$ciudad_cliente_new,
	 			$estado_cliente_new,
	 			$cp_cliente_new,
	 			$contacto_cliente_new,
	 			$calle_cliente_ent_new,
	 			$numero_cliente_ent_new,
	 			$interior_cliente_ent_new,
	 			$colonia_cliente_ent_new,
	 			$ciudad_cliente_ent_new,
	 			$estado_cliente_ent_new,
	 			$cp_cliente_ent_new,
	 			$referencia_cliente_new,
	 			$fecha_hora,
	 			$lugar
	 		)
	{

		$sql="INSERT INTO clientes (nombre,rfc,telefono,email,referencia,estatus,fecha_reg,lugar) VALUES ('$nombre_cliente_new','$rfc_cliente_new','$telefono_cliente_new','$email_cliente_new','$referencia_cliente_new','1','$fecha_hora','$lugar')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_2="INSERT INTO dir_facturacion (idcliente_fac,razon_fac,rfc_fac,calle_fac,numero_fac,interior_fac,colonia_fac,ciudad_fac,estado_fac,cp_fac,telefono_fac,email_fac) VALUES('$idingresonew','$razon_cliente_new','$rfc_cliente_new','$calle_cliente_new','$numero_cliente_new','$interior_cliente_new','$colonia_cliente_new','$ciudad_cliente_new','$estado_cliente_new','$cp_cliente_new','$telefono_cliente_new','$email_cliente_new')";
		ejecutarConsulta($sql_2);

		$sql_3="INSERT INTO dir_entregas (idcliente_ent,contacto_ent,calle_ent,numero_ent,interior_ent,colonia_ent,ciudad_ent,estado_ent,cp_ent,telefono_ent,email_ent,referencia_ent) VALUES('$idingresonew','$contacto_cliente_new','$calle_cliente_ent_new','$numero_cliente_ent_new','$interior_cliente_ent_new','$colonia_cliente_ent_new','$ciudad_cliente_ent_new','$estado_cliente_ent_new','$cp_cliente_ent_new','$telefono_cliente_new','$email_cliente_new','$referencia_cliente_new')";
		ejecutarConsulta($sql_3);

		$sql_4="SELECT idcliente FROM clientes WHERE idcliente='$idingresonew'";
		return ejecutarConsultaSimpleFila($sql_4);
	}

	
	public function buscar_medidas_limit($idtbl_prod,$codigo_group,$area)
	{

		$id_tbl = $idtbl_prod;

		$sql="SELECT * FROM tbl_prod WHERE codigo_group='$codigo_group' AND area<'$area' ORDER BY area DESC LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function guardar_comprobante_lic0($nom,$idpedido,$tipo_doc_lic,$idprecarga)
	{
					
			$sql="INSERT INTO documentos (idpedido,nombre,tipo,idprecarga) VALUES('$idpedido','$nom','$tipo_doc_lic','$idprecarga')";
			return ejecutarConsulta($sql);
			/*$idingresonew=ejecutarConsulta_retornarID($sql);

			$sql1="SELECT iddocumentos as iddoc1 FROM documentos WHERE iddocumentos='$idingresonew'";
        	return ejecutarConsultaSimpleFila($sql1);*/	
	
	}

	public function guardar_comprobante_lic1($nom,$idpedido,$tipo_doc_lic)
	{
					
			$sql="INSERT INTO documentos (idpedido,nombre,tipo) VALUES('$idpedido','$nom','$tipo_doc_lic')";
			return ejecutarConsulta($sql);
			/*$idingresonew=ejecutarConsulta_retornarID($sql);

			$sql1="SELECT iddocumentos as iddoc1 FROM documentos WHERE iddocumentos='$idingresonew'";
        	return ejecutarConsultaSimpleFila($sql1);*/	
	
	}
	public function guardar_comprobante_lic2($nom,$idpedido,$tipo_doc_lic)
	{
					
			$sql="INSERT INTO documentos (idpedido,nombre,tipo) VALUES('$idpedido','$nom','$tipo_doc_lic')";
			return ejecutarConsulta($sql);
			/*$idingresonew=ejecutarConsulta_retornarID($sql);

			$sql1="SELECT iddocumentos as iddoc2 FROM documentos WHERE iddocumentos='$idingresonew'";
        	return ejecutarConsultaSimpleFila($sql1);*/	
	
	}
	public function guardar_comprobante_lic3($nom,$idpedido,$tipo_doc_lic)
	{
					
			$sql="INSERT INTO documentos (idpedido,nombre,tipo) VALUES('$idpedido','$nom','$tipo_doc_lic')";
			return ejecutarConsulta($sql);
			/*$idingresonew=ejecutarConsulta_retornarID($sql);

			$sql1="SELECT iddocumentos as iddoc3 FROM documentos WHERE iddocumentos='$idingresonew'";
        	return ejecutarConsultaSimpleFila($sql1);*/			
	}

	public function guardar_comprobante_lic4($nom,$idpedido,$tipo_doc_lic)
	{					
			$sql="INSERT INTO documentos (idpedido,nombre,tipo) VALUES('$idpedido','$nom','$tipo_doc_lic')";
			return ejecutarConsulta($sql);
			/*$idingresonew=ejecutarConsulta_retornarID($sql);

			$sql1="SELECT iddocumentos as iddoc4 FROM documentos WHERE iddocumentos='$idingresonew'";
        	return ejecutarConsultaSimpleFila($sql1);*/			
	}

	public function listar_especif($idtbl_prod)
	{					
			$sql="SELECT t.idespecif_det,t.idtbl_prod,t.idespecif,
			(SELECT nombre FROM tbl_prod_esp WHERE idespecif=t.idespecif) as nombre 
			FROM tbl_prod_esp_det t WHERE t.idtbl_prod='$idtbl_prod'";
			return ejecutarConsulta($sql);
					
	}

	public function consul_codigo_especif($select_especif)
	{					
			$sql="SELECT idespecif FROM tbl_prod_esp WHERE nombre='$select_especif'";
			return ejecutarConsultaSimpleFila($sql);	
	}

	public function consul_codigo_color($idtblprod_colores)
	{					
			$sql="SELECT codigo,nombre FROM tbl_prod_colores WHERE idtblprod_colores='$idtblprod_colores'";
			return ejecutarConsultaSimpleFila($sql);	
	}

	public function listar_variaciones($idtbl_prod)
	{

		//$sql="SELECT * FROM prod_tipo ORDER BY nombre ASC";
		$sql="SELECT codigo,nombre,medida1,medida2,medida3,medida4, unidad FROM tbl_prod_det WHERE idtbl_prod='$idtbl_prod' ORDER BY nombre ASC";
		return ejecutarConsulta($sql);
	}

	public function ver_lista_mejoras()
	{

		//$sql="SELECT * FROM prod_tipo ORDER BY nombre ASC";
		$sql="SELECT * FROM tbl_mejoras ORDER BY fecha_registro DESC";
		return ejecutarConsulta($sql);
	}

	public function guardar_mejora($concepto_mejora,$select_mejora,$fecha_hora,$area_mejora)
	{

		$sql="INSERT INTO tbl_mejoras (fecha_registro,concepto,prioridad,fecha_termino,area) VALUES('$fecha_hora','$concepto_mejora','$select_mejora','0000-00-00 00:00:00','$area_mejora')";
		return ejecutarConsulta($sql);
	}

	public function actualizar_estatus_mejora($idtbl_mejoras,$estatus)
	{

		$sql="UPDATE tbl_mejoras SET estatus='$estatus' WHERE idtbl_mejoras='$idtbl_mejoras'";
		return ejecutarConsulta($sql);
	}



}

?>