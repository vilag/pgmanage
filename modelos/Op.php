<?php

//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Opr
{
	public function __construct()
	{

	}

	/*public function consul_prod($id_detped)
	{

		$sql="SELECT * FROM pg_detped WHERE idpg_detped='$id_detped'";
		return ejecutarConsultaSimpleFila($sql);			
	}*/

	
	public function consul_prod($id_detped)
	{
		$sql="SELECT pd.idpg_detped,p.no_control,pdp.codigo,pdp.descripcion,pd.cantidad,pd.op,pd.estatus,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,p.empaque,pd.fecha_hora,pdp.color,pdp.observacion,p.idpg_pedidos,p.observaciones,pd.iddetalle_pedido,pdp.medida,pd.op FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos WHERE pd.estatus='Produccion' AND pd.idpg_detped='$id_detped' ORDER BY p.no_control DESC";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function consul_op_detalle($id)
	{
		

		$sql="SELECT o.no_control,o.prioridad,od.area,od.lote,o.no_op,o.codigo,o.producto,o.empaque,o.cant_color,od.maquina,od.ciclo,od.hora_inicio,DATE(o.fecha_inicio) as fecha_inicio,od.hora_term,DATE(o.fecha_term) as fecha_term,o.observ,(SELECT sum(cant_tot) FROM op_detalle_prod WHERE idop=o.idop) as cant_tot,DATE(o.fecha_inicio) as fecha_inicio,DATE(o.fecha_term) as fecha_term,od.fecha_inicio as fecha_inicio_real,od.fecha_term as fecha_term_real,od.merma,od.desperdicio,od.reproceso,od.piezas_fabricadas,od.prod_aprob,od.productividad,od.cumplimiento,od.observ as obs FROM op_detalle od INNER JOIN op o ON od.idop=o.idop WHERE od.idop_detalle='$id'";

		return ejecutarConsulta($sql);
	}


	public function guardar_op($id_detped,$ultimo_op,$prioridad,$no_control,$codigo,$producto,$empaque,$cant_tot,$fecha_inicio,$fecha_term,$observ)
	{
		$sql="INSERT INTO op (idpg_detped,no_op,prioridad,no_control,codigo,producto,empaque,cant_tot,fecha_inicio,fecha_term,observ) VALUES('$id_detped','$ultimo_op','$prioridad','$no_control','$codigo','$producto','$empaque','$cant_tot','$fecha_inicio','$fecha_term','$observ')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM op WHERE idop='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);
	}


	public function ult_op()
	{
		$sql="DELETE FROM op WHERE estatus='0'";
		ejecutarConsulta($sql);

		$sql2="DELETE FROM op_detalle_prod WHERE estatus='0'";
		ejecutarConsulta($sql2);

		$sql3="SELECT no_op FROM op ORDER BY no_op DESC LIMIT 1";
		return ejecutarConsultaSimpleFila($sql3);

	}


	public function update_op($idop,$prioridad,$observ,$fecha1,$fecha2,$cant_color)
	{
		$sql="UPDATE op SET prioridad='$prioridad',observ='$observ',fecha_inicio='$fecha1',fecha_term='$fecha2',cant_color='$cant_color' WHERE idop='$idop'";
		return ejecutarConsulta($sql);
	}

	public function listar_ops()
	{
		$sql="SELECT o.idop,o.no_op, 
		(SELECT fecha_inicio FROM op_detalle WHERE idop=o.idop ORDER BY fecha_inicio ASC LIMIT 1) as f_ini, 
		(SELECT fecha_term FROM op_detalle WHERE idop=o.idop ORDER BY fecha_term DESC LIMIT 1) as f_fin FROM op o ORDER BY o.no_op DESC";
		return ejecutarConsulta($sql);
	}

	public function listar_ops_buscar($valor,$fecha)
	{
		if ($valor<>"" AND $fecha=="") {
			$sql="SELECT * FROM op WHERE no_op = '$valor'";
			return ejecutarConsulta($sql);
		}elseif ($valor=="" AND $fecha<>"") {
			$sql2="SELECT * FROM op WHERE DATE(fecha_inicio) = '$fecha'";
			return ejecutarConsulta($sql2);
		}elseif ($valor<>"" AND $fecha<>"") {
			$sql3="SELECT * FROM op WHERE DATE(fecha_inicio) = '$fecha' AND no_op='$valor'";
			return ejecutarConsulta($sql3);
		}elseif ($valor=="" AND $fecha=="") {
			$sql4="SELECT * FROM op";
			return ejecutarConsulta($sql4);
		}
		
	}

	public function listar_ops_area($valor,$fecha)
	{
		/*$sql="SELECT idop_detalle,area,idop, DATE(fecha_inicio) as fecha_inicio, DATE(fecha_term) as fecha_term FROM op_detalle";
		ejecutarConsulta($sql);*/

		if ($valor<>"" AND $fecha=="") {

			$sql="SELECT od.idop_detalle,od.area,od.idop,(SELECT no_op FROM op WHERE idop=od.idop) as no_op, DATE(od.fecha_inicio) as fecha_inicio, DATE(od.fecha_term) as fecha_term FROM op_detalle od WHERE od.idop=(SELECT idop FROM op WHERE no_op='$valor')";
			return ejecutarConsulta($sql);

			//$sql="SELECT * FROM op WHERE no_op = '$valor'";
			//return ejecutarConsulta($sql);
		}
		if ($valor=="" AND $fecha<>"") {

			$sql="SELECT od.idop_detalle,od.area,od.idop,(SELECT no_op FROM op WHERE idop=od.idop) as no_op, DATE(od.fecha_inicio) as fecha_inicio, DATE(od.fecha_term) as fecha_term FROM op_detalle od WHERE DATE(od.fecha_inicio)='$fecha'";
			return ejecutarConsulta($sql);

			//$sql2="SELECT * FROM op WHERE DATE(fecha_inicio) = '$fecha'";
			//return ejecutarConsulta($sql2);
		}
		if ($valor<>"" AND $fecha<>"") {

			$sql="SELECT od.idop_detalle,od.area,od.idop,(SELECT no_op FROM op WHERE idop=od.idop) as no_op, DATE(od.fecha_inicio) as fecha_inicio, DATE(od.fecha_term) as fecha_term FROM op_detalle od WHERE od.idop=(SELECT idop FROM op WHERE no_op='$valor') AND DATE(od.fecha_inicio)='$fecha'";
			return ejecutarConsulta($sql);

			//$sql3="SELECT * FROM op WHERE DATE(fecha_inicio) = '$fecha' AND no_op='$valor'";
			//return ejecutarConsulta($sql3);
		}
		if ($valor=="" AND $fecha=="") {

			$sql="SELECT od.idop_detalle,od.area,od.idop,(SELECT no_op FROM op WHERE idop=od.idop) as no_op, DATE(od.fecha_inicio) as fecha_inicio, DATE(od.fecha_term) as fecha_term FROM op_detalle od";
			return ejecutarConsulta($sql);

			//$sql4="SELECT * FROM op";
			//return ejecutarConsulta($sql4);
		}
	}
	
	public function consul_opexist($id_detped)
	{
		$sql="SELECT count(idop) as num_reg FROM op WHERE idpg_detped='$id_detped'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function set_op($id_detped,$num_op)
	{
		$sql="UPDATE pg_detped SET op='$num_op' WHERE idpg_detped='$id_detped'";
		return ejecutarConsulta($sql);
	}

	public function consul_op_all($idop_consul)
	{
		$sql="SELECT idop,idpg_detped,no_op,prioridad,no_control,codigo,producto,empaque,cant_tot,DATE(fecha_inicio) as fecha_inicio, DATE(fecha_term) as fecha_term,observ FROM op WHERE idop='$idop_consul'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function consul_idop($id_detped)
	{
		$sql="SELECT idop FROM op WHERE idpg_detped='$id_detped'";
		return ejecutarConsultaSimpleFila($sql);
	}



	public function insert_check($idop,$area,$fecha_hora)
	{
		//$sql="INSERT INTO op_detalle (idop,area,fecha_registro,prioridad) VALUES('$idop','$area','$fecha_hora')";
		$sql="INSERT INTO op_detalle (idop,area,fecha_registro,prioridad) SELECT '$idop','$area','$fecha_hora',num_proc FROM area WHERE idarea='$area'";
		return ejecutarConsulta($sql);
	}



	public function listar_ops_detalles($id)
	{
		$sql="SELECT od.idop_detalle,od.area,od.prioridad FROM op_detalle od WHERE idop='$id' ORDER BY od.prioridad ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_ops_detalles_opt($id)
	{
		$sql="SELECT od.idop_detalle,od.area,od.prioridad FROM op_detalle od WHERE idop='$id' ORDER BY od.prioridad ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_ops_detalles2($id)
	{
		$sql="SELECT * FROM op_detalle WHERE idop='$id'";
		return ejecutarConsulta($sql);
	}

	

	public function consul_area($idop)
	{
		$sql="SELECT count(area) as area1 FROM op_detalle WHERE idop='$idop' AND area='1'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function consul_area2($idop)
	{
		$sql="SELECT count(area) as area2 FROM op_detalle WHERE idop='$idop' AND area='2'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function consul_area3($idop)
	{
		$sql="SELECT count(area) as area3 FROM op_detalle WHERE idop='$idop' AND area='3'";
		return ejecutarConsultaSimpleFila($sql);
	}

	

	public function consul_area5($idop)
	{
		$sql="SELECT count(area) as area5 FROM op_detalle WHERE idop='$idop' AND area='5'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function consul_area6($idop)
	{
		$sql="SELECT count(area) as area6 FROM op_detalle WHERE idop='$idop' AND area='6'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function consul_area7($idop)
	{
		$sql="SELECT count(area) as area7 FROM op_detalle WHERE idop='$idop' AND area='7'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function consul_area8($idop)
	{
		$sql="SELECT count(area) as area8 FROM op_detalle WHERE idop='$idop' AND area='8'";
		return ejecutarConsultaSimpleFila($sql);
	}

	

	public function guadar_op_det($idop,$id_detped,$no_control,$codigo,$producto,$empaque,$cantidad,$fecha_inicio,$fecha_term,$observaciones,$medida,$color,$iddetalle_pedido)
	{


		$sql_valid="INSERT INTO acciones_valid (mensaje,fecha_hora) SELECT CONCAT('Producto borrado con Codigo:',codigo,' idop: ',idop,' al marcar y desmarcar color en borrar_op_det'),NOW() FROM op_detalle_prod WHERE idpg_detped='$id_detped'";
		ejecutarConsulta($sql_valid);


		$sql="DELETE FROM op_detalle_prod WHERE idpg_detped='$id_detped'";
		ejecutarConsulta($sql);



		$sql2="UPDATE pg_detped SET no_op_temp='$idop' WHERE idpg_detped='$id_detped'";
        ejecutarConsulta($sql2);

		$sql="INSERT INTO op_detalle_prod (idop,idpg_detped,no_control,codigo,producto,empaque,cant_tot,fecha_inicio,fecha_term,observ,medida,color,iddetalle_pedido) VALUES ('$idop','$id_detped','$no_control','$codigo','$producto','$empaque','$cantidad','$fecha_inicio','$fecha_term','$observaciones','$medida','$color','$iddetalle_pedido')";
		$idingresonew=ejecutarConsulta_retornarID($sql);


		$sql_id="SELECT * FROM op_detalle_prod WHERE idop_detalle_prod='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);
	}

	public function listar_ops2($id)
	{
		$sql="SELECT idop_detalle_prod,idop,idpg_detped,no_control,codigo,producto,empaque,cant_tot,DATE(fecha_inicio) as fecha_inicio, DATE(fecha_term) as fecha_term, observ,medida,color FROM op_detalle_prod WHERE idop='$id'";
		return ejecutarConsulta($sql);
	}

	public function quitar_prod_op($idop_detalle_prod,$idpg_detped)
	{		

		$sql="DELETE FROM op_detalle_prod WHERE idop_detalle_prod='$idop_detalle_prod'";
		ejecutarConsulta($sql);

		$sql="UPDATE pg_detped SET estatus = 'Produccion', op = '', guardado=0, select_op=0 WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsulta($sql);
	}

	public function listar_prod_avance($id)
	{
		$sql="SELECT o.idop_detalle_prod,o.idop,o.idpg_detped,o.no_control,o.codigo,o.producto,o.empaque,o.cant_tot,DATE(o.fecha_inicio) as fecha_inicio, DATE(o.fecha_term) as fecha_term, o.observ,o.medida,o.color,p.estatus FROM op_detalle_prod o INNER JOIN pg_detped p ON o.idpg_detped=p.idpg_detped WHERE o.idop='$id'";
		return ejecutarConsulta($sql);
	}

	public function cargar_campos_avance($id,$area)
	{
		/*$sql="SELECT idop_detalle_prod,no_control,codigo,producto,cant_tot,(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod='$id' AND area='$area' ORDER BY idavance_prod DESC LIMIT 1) as avance FROM op_detalle_prod WHERE idop_detalle_prod='$id'";*/
		$sql="SELECT odp.idop,
		odp.idop_detalle_prod,
		odp.no_control,
		odp.codigo,
		odp.producto,
		odp.cant_tot,
		(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod='$id' AND area='$area' ORDER BY idavance_prod DESC LIMIT 1) as avance,
		odp.idpg_detped,
		pdp.idpg_detalle_pedidos,
		pdp.idpg_pedidos,
		odp.estatus,
		a.estatus as estatus_op,
		(SELECT IFNULL(count(idop_detalle),0) FROM op_detalle WHERE idop = odp.idop) as areas_avance
		FROM op_detalle_prod odp 
		INNER JOIN pg_detalle_pedidos pdp ON odp.iddetalle_pedido=pdp.idpg_detalle_pedidos 
		INNER JOIN op a ON odp.idop = a.idop
		WHERE odp.idop_detalle_prod='$id'";

		// $sql="SELECT odp.idop,
		// odp.idop_detalle_prod,
		// odp.no_control,
		// odp.codigo,
		// odp.producto,
		// odp.cant_tot,
		// (SELECT avance FROM op_avance_prod WHERE idop_detalle_prod='$id' AND area='$area' ORDER BY idavance_prod DESC LIMIT 1) as avance,
		// pd.idpg_detped,
		// pdp.idpg_detalle_pedidos,
		// pdp.idpg_pedidos,
		// odp.estatus 
		// FROM op_detalle_prod odp INNER JOIN 
		// pg_detped pd ON odp.idpg_detped=pd.idpg_detped INNER JOIN 
		// pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos 
		// WHERE odp.idop_detalle_prod='$id'";
		return ejecutarConsulta($sql);
	}

	// public function cargar_campos_avance2($area)
	// {
	// 	$sql="SELECT o.idop_detalle_prod,o.no_control,o.codigo,o.producto,o.cant_tot,(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=o.idop_detalle_prod AND area='$area' ORDER BY idavance_prod DESC LIMIT 1) as avance FROM op_detalle_prod o";
	// 	return ejecutarConsulta($sql);
	// }
	
	public function listar_prod_rep($id)
	{
		$sql="SELECT no_control,codigo,producto,empaque,cant_tot,DATE(fecha_inicio) as fecha_inicio,DATE(fecha_term) as fecha_term,observ,medida,color FROM op_detalle_prod WHERE idop=(SELECT idop FROM op_detalle WHERE idop_detalle='$id' LIMIT 1)";
		return ejecutarConsulta($sql);
	}

	public function select_fechas($id)
	{
		$sql="SELECT (SELECT DATE(fecha_inicio) FROM op WHERE idop=(SELECT idop FROM op_detalle WHERE idop_detalle='$id' LIMIT 1)) as fecha1, (SELECT DATE(fecha_term) FROM op WHERE idop=(SELECT idop FROM op_detalle WHERE idop_detalle='$id' LIMIT 1)) as fecha2 FROM op_detalle_prod WHERE idop=(SELECT idop FROM op_detalle WHERE idop_detalle='$id' LIMIT 1)";
		return ejecutarConsulta($sql);
	}

	public function buscar_op($idop_detalle)
	{
		$sql="SELECT idop,no_op,prioridad,DATE(fecha_inicio) as fecha_inicio,DATE(fecha_term) as fecha_term,observ,(SELECT area FROM op_detalle WHERE idop_detalle='$idop_detalle') as area,cant_color FROM op WHERE idop=(SELECT idop FROM op_detalle WHERE idop_detalle='$idop_detalle' LIMIT 1)";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function update_op_area($idop_detalle,$lote_r,$cant_r,$maquina_r,$ciclo_r,$productividad_r,$cumplimiento_r,$diferencia_r,$entregas_r,$reproceso_r,$desperdicio_r,$merma_r,$observ_area_r,$real_fecha1,$real_hora1,$real_fecha2,$real_hora2,$prod_aprob_r)
	{
		$sql="UPDATE op_detalle SET lote='$lote_r',piezas_fabricadas='$cant_r',maquina='$maquina_r',ciclo='$ciclo_r',hora_inicio='$real_hora1',hora_term='$real_hora2',productividad='$productividad_r',cumplimiento='$cumplimiento_r',diferencia='$diferencia_r',entregas='$entregas_r',reproceso='$reproceso_r',desperdicio='$desperdicio_r',merma='$merma_r',observ='$observ_area_r',fecha_inicio='$real_fecha1',fecha_term='$real_fecha2',prod_aprob='$prod_aprob_r' WHERE idop_detalle='$idop_detalle' ";
		return ejecutarConsulta($sql);
	}

	public function buscar_op_detalle($idop_detalle)
	{
		$sql="SELECT * FROM op_detalle WHERE idop_detalle='$idop_detalle'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function consulta_op($idop)
	{
		$sql="SELECT 
		no_op, 
		(SELECT DATE(fecha_inicio) FROM op_detalle_prod WHERE idop='$idop' ORDER BY DATE(fecha_inicio) ASC LIMIT 1) as fecha1, 
		(SELECT DATE(fecha_term) FROM op_detalle_prod WHERE idop='$idop' ORDER BY DATE(fecha_term) ASC LIMIT 1) as fecha2,
		prioridad,
		observ,
		cant_color,
		estatus 
		FROM op WHERE idop='$idop'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function guardar_avance_prod($idop_detalle_prod,$avance,$fecha_hora,$area_num,$pedido,$idpg_detalle_pedidos,$lote,$coment_avance,$cantidad_indep_avance,$idop)
	{
		if ($area_num==1) {
			$sql="UPDATE pg_detalle_pedidos SET avance_he='$avance' WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
			ejecutarConsulta($sql);
		}
		if ($area_num==2) {
			$sql="UPDATE pg_detalle_pedidos SET avance_pi='$avance' WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
			ejecutarConsulta($sql);
		}
		if ($area_num==3) {
			$sql="UPDATE pg_detalle_pedidos SET avance_pl='$avance' WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
			ejecutarConsulta($sql);
		}
		if ($area_num==5) {
			$sql="UPDATE pg_detalle_pedidos SET avance_ep='$avance' WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
			ejecutarConsulta($sql);
		}
		if ($area_num==6) {
			$sql="UPDATE pg_detalle_pedidos SET avance_ec='$avance' WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
			ejecutarConsulta($sql);
		}
		if ($area_num==7) {
			$sql="UPDATE pg_detalle_pedidos SET avance_em='$avance' WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
			ejecutarConsulta($sql);
		}
		if ($area_num==8) {
			$sql="UPDATE pg_detalle_pedidos SET avance_ho='$avance' WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
			ejecutarConsulta($sql);
		}

		

		$sql="INSERT INTO op_avance_prod (idop_detalle_prod,avance,cant_capt,fecha_hora,area,idpedido,lote,comentario,idop,iddetalle_pedido) VALUES ('$idop_detalle_prod','$avance','$cantidad_indep_avance','$fecha_hora','$area_num','$pedido','$lote','$coment_avance','$idop','$idpg_detalle_pedidos')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM op_avance_prod WHERE idavance_prod='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);
	}

	public function cargar_historial_avances($id,$area)
	{
		$sql="SELECT oa.idavance_prod,oa.fecha_hora, oa.avance, od.cant_tot,oa.lote,oa.comentario,oa.cant_capt,od.cant_tot
		 FROM op_avance_prod oa INNER JOIN op_detalle_prod od ON oa.idop_detalle_prod = od.idop_detalle_prod WHERE oa.idop_detalle_prod='$id' AND area='$area' ORDER BY oa.fecha_hora DESC";
		return ejecutarConsulta($sql);
	}

	public function cargar_excedentes($id,$area)
	{
		$sql="SELECT * FROM op_detalle_exc WHERE idop_detalle_prod='$id' AND area='$area' ORDER BY fecha_hora DESC";
		return ejecutarConsulta($sql);
	}

	public function consul_area_avance($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function consultar_iddetped($idop_detalle_prod)
	{
		$sql="SELECT * FROM op_detalle_prod WHERE idop_detalle_prod='$idop_detalle_prod'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function cantidades($pedido)
	{
		$sql="SELECT a.idpg_pedidos,
		(SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=a.idpg_pedidos) as num_prod,
		(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE (idpedido=a.idpg_pedidos AND estatus='Apartado') OR (idpedido=a.idpg_pedidos AND estatus='Fabricado') OR (idpedido=a.idpg_pedidos AND estatus='EXISTENCIA')) as sum_cumplido, 
		(SELECT count(idpedido) FROM notif WHERE idpedido = a.idpg_pedidos)  as num_pedido 
		FROM pg_pedidos a WHERE a.idpg_pedidos='$pedido'";
		return ejecutarConsultaSimpleFila($sql);

		

		// $sql="SELECT idpg_pedidos,
		// (SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos='$pedido') as num_prod, 
		// (SELECT sum(pd.cantidad) FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos WHERE pdp.idpg_pedidos='$pedido' AND pd.estatus='Apartado')  as num_prod_apart, 
		// (SELECT sum(pd.cantidad) FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos WHERE pdp.idpg_pedidos='$pedido' AND pd.estatus='Fabricado')  as num_prod_fab,
		// (SELECT sum(pd.cantidad) FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos WHERE pdp.idpg_pedidos='$pedido' AND pd.estatus='EXISTENCIA') as num_prod_exis, 
		// (SELECT count(idpedido) FROM notif WHERE idpedido = '$pedido')  as num_pedido 
		// FROM pg_pedidos WHERE idpg_pedidos='$pedido'";
		// return ejecutarConsultaSimpleFila($sql);
	}


	public function buscar_cant_areas($idop_detalle_prod)
	{

		$sql="SELECT * FROM op_detalle WHERE ";

		$sql="SELECT 
		(SELECT COUNT(area) FROM op_detalle WHERE idop=odp.idop AND area=1) as area1, 
		(SELECT COUNT(area) FROM op_detalle WHERE idop=odp.idop AND area=2) as area2, 
		(SELECT COUNT(area) FROM op_detalle WHERE idop=odp.idop AND area=3) as area3, 
		(SELECT COUNT(area) FROM op_detalle WHERE idop=odp.idop AND area=5) as area5,
		(SELECT COUNT(area) FROM op_detalle WHERE idop=odp.idop AND area=6) as area6, 
		(SELECT COUNT(area) FROM op_detalle WHERE idop=odp.idop AND area=7) as area7, 
		(SELECT COUNT(area) FROM op_detalle WHERE idop=odp.idop AND area=8) as area8 
		FROM op_detalle_prod odp WHERE odp.idop_detalle_prod='$idop_detalle_prod'";
		return ejecutarConsultaSimpleFila($sql);
		
	}

	public function contar_avance_tot($idop_detalle_prod)
	{
		$sql="SELECT 
		IFNULL((SELECT avance FROM op_avance_prod WHERE idop_detalle_prod='$idop_detalle_prod' AND area=1 ORDER BY avance DESC LIMIT 1),0) as sum_area1, 
		IFNULL((SELECT avance FROM op_avance_prod WHERE idop_detalle_prod='$idop_detalle_prod' AND area=2 ORDER BY avance DESC LIMIT 1),0) as sum_area2, 
		IFNULL((SELECT avance FROM op_avance_prod WHERE idop_detalle_prod='$idop_detalle_prod' AND area=3 ORDER BY avance DESC LIMIT 1),0) as sum_area3, 
		IFNULL((SELECT avance FROM op_avance_prod WHERE idop_detalle_prod='$idop_detalle_prod' AND area=5 ORDER BY avance DESC LIMIT 1),0) as sum_area5, 
		IFNULL((SELECT avance FROM op_avance_prod WHERE idop_detalle_prod='$idop_detalle_prod' AND area=6 ORDER BY avance DESC LIMIT 1),0) as sum_area6, 
		IFNULL((SELECT avance FROM op_avance_prod WHERE idop_detalle_prod='$idop_detalle_prod' AND area=7 ORDER BY avance DESC LIMIT 1),0) as sum_area7, 
		IFNULL((SELECT avance FROM op_avance_prod WHERE idop_detalle_prod='$idop_detalle_prod' AND area=8 ORDER BY avance DESC LIMIT 1),0) as sum_area8 
		FROM op_detalle_prod odp WHERE idop_detalle_prod='$idop_detalle_prod'";
		return ejecutarConsultaSimpleFila($sql);
		
	}


	public function consul_avance_calc($idop_detalle_prod,$area_num)
	{

		$sql="SELECT avance FROM op_avance_prod WHERE idop_detalle_prod='$idop_detalle_prod' AND area='$area_num' ORDER BY idavance_prod DESC LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar_productos_op($id)
	{
		if ($id==0) {
			
			$sql="SELECT odp.idop_detalle_prod,o.no_op,odp.codigo,odp.producto,odp.cant_tot,pgd.idpg_detped,pdp.idpg_detalle_pedidos,pdp.observacion,pdp.medida,p.idpg_pedidos,odp.no_control,p.fecha_entrega,c.nombre as cliente,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=1) as sum_capt_Herreria,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=1 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Herreria,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=2) as sum_capt_Pintura,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=2 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Pintura,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=3) as sum_capt_Plasticos,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=3 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Plasticos,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=5) as sum_capt_Ensamble_P,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=5 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Ensamble_P,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=6) as sum_capt_Ensamble_C,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=6 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Ensamble_C,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=7) as sum_capt_Ensamble_M,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=7 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Ensamble_M,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=8) as sum_capt_Horno,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=8 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Horno,
 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=1) as Herreria_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=2) as Pintura_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=3) as Plasticos_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=5) as Ensamble_P_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=6) as Ensamble_C_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=7) as Ensamble_M_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=8) as Horno_exist
			FROM op_detalle_prod odp INNER JOIN op o ON odp.idop=o.idop INNER JOIN pg_detped pgd ON odp.idpg_detped=pgd.idpg_detped INNER JOIN pg_detalle_pedidos pdp ON pgd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos INNER JOIN clientes c ON p.idcliente=c.idcliente WHERE p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' ORDER BY p.fecha_entrega ASC";

			/*$sql="SELECT odp.idop_detalle_prod,o.no_op,odp.codigo,odp.producto,odp.cant_tot,pgd.idpg_detped,pdp.idpg_detalle_pedidos,pdp.observacion,pdp.medida,p.idpg_pedidos,odp.no_control,p.fecha_entrega,c.nombre as cliente,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=1) as sum_capt_Herreria,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=1 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Herreria,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=2 ORDER BY avance DESC LIMIT 1) as Pintura,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=3 ORDER BY avance DESC LIMIT 1) as Plasticos,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=5 ORDER BY avance DESC LIMIT 1) as Ensamble_P,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=6 ORDER BY avance DESC LIMIT 1) as Ensamble_C,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=7 ORDER BY avance DESC LIMIT 1) as Ensamble_M,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=8 ORDER BY avance DESC LIMIT 1) as Horno, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=1) as Herreria_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=2) as Pintura_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=3) as Plasticos_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=5) as Ensamble_P_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=6) as Ensamble_C_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=7) as Ensamble_M_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=8) as Horno_exist
			FROM op_detalle_prod odp INNER JOIN op o ON odp.idop=o.idop INNER JOIN pg_detped pgd ON odp.idpg_detped=pgd.idpg_detped INNER JOIN pg_detalle_pedidos pdp ON pgd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos INNER JOIN clientes c ON p.idcliente=c.idcliente WHERE p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' ORDER BY p.fecha_entrega ASC";*/
			return ejecutarConsulta($sql);

		}elseif ($id>0) {
			
		


					$sql="SELECT odp.idop_detalle_prod,o.no_op,odp.codigo,odp.producto,odp.cant_tot,pgd.idpg_detped,pdp.idpg_detalle_pedidos,p.idpg_pedidos,odp.no_control,p.fecha_entrega,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=1) as sum_capt_Herreria,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=1 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Herreria,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=2) as sum_capt_Pintura,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=2 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Pintura,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=3) as sum_capt_Plasticos,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=3 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Plasticos,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=5) as sum_capt_Ensamble_P,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=5 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Ensamble_P,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=6) as sum_capt_Ensamble_C,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=6 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Ensamble_C,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=7) as sum_capt_Ensamble_M,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=7 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Ensamble_M,
			(SELECT sum(cant_capt) as sum_capt FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=8) as sum_capt_Horno,
			(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=8 ORDER BY fecha_hora DESC LIMIT 1) as av_capt_Horno,

			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=1) as Herreria_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=2) as Pintura_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=3) as Plasticos_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=5) as Ensamble_P_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=6) as Ensamble_C_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=7) as Ensamble_M_exist, 
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area=8) as Horno_exist
			FROM op_detalle_prod odp INNER JOIN op o ON odp.idop=o.idop INNER JOIN pg_detped pgd ON odp.idpg_detped=pgd.idpg_detped INNER JOIN pg_detalle_pedidos pdp ON pgd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos INNER JOIN op_detalle od ON odp.idop=od.idop WHERE p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' AND od.area='$id' ORDER BY p.fecha_entrega ASC";
				return ejecutarConsulta($sql);
				# code...
			
		}
		
			
	} 

	public function eliminar_area_op($idop_detalle)
	{

		$sql="DELETE FROM op_detalle WHERE idop_detalle='$idop_detalle'";
		return ejecutarConsulta($sql);
	}

	

	public function guardar_estatus_empaque($idop_detalle_prod,$option_empaque,$fecha_hora)
	{

		$sql="UPDATE op_detalle_prod SET empacado='$option_empaque',fecha_empaque='$fecha_hora' WHERE idop_detalle_prod='$idop_detalle_prod'";
		return ejecutarConsulta($sql);
	}

	public function guardar_extra($idop_detalle_prod,$idavance_prod,$cantidad_exc,$area_num,$fecha_hora,$lote_exc,$coment_exc)
	{

		$sql="INSERT INTO op_detalle_exc (idop_detalle_prod,idavance_prod,cantidad,area,fecha_hora,lote,coment) VALUES('$idop_detalle_prod','$idavance_prod','$cantidad_exc','$area_num','$fecha_hora','$lote_exc','$coment_exc')";
		return ejecutarConsulta($sql);
	}

	public function ult_idavance($idop_detalle_prod,$area_num)
	{

		$sql="SELECT idavance_prod FROM op_avance_prod WHERE idop_detalle_prod='$idop_detalle_prod' AND area='$area_num' ORDER BY fecha_hora DESC LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);
	}














	


	public function indicador_produccón_area()
	{

		

		$sql="SELECT odp.idop_detalle_prod,odp.idpg_detped,DATE(odp.fecha_term) as fecha_term_papel,
		(SELECT no_op FROM op WHERE idop=odp.idop) as no_op,
		(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as no_control,
		(SELECT DATE(fecha_hora) FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod ORDER BY idavance_prod DESC LIMIT 1) as fecha_fab,
		(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as estatus_pedido,
		(SELECT fecha_pedido FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as fecha_pedido,
		(SELECT fecha_entrega FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as fecha_entrega
		 FROM op_detalle_prod odp INNER JOIN pg_detped pd ON odp.idpg_detped=pd.idpg_detped WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'CANCELADO'";


		return ejecutarConsulta($sql);

	}





	public function calcular_tiempos()
	{
		$sql="SELECT o.idop,o.no_op,
		(SELECT fecha_registro FROM op_detalle WHERE idop=o.idop AND area = 1 LIMIT 1) as fecha_registro,
		(SELECT oap.fecha_hora FROM op_avance_prod oap WHERE (SELECT idop FROM op_detalle_prod WHERE idop_detalle_prod=oap.idop_detalle_prod LIMIT 1)=o.idop AND oap.area=1 ORDER BY oap.fecha_hora ASC LIMIT 1) as fecha_avance1,
		(SELECT oap.fecha_hora FROM op_avance_prod oap WHERE (SELECT idop FROM op_detalle_prod WHERE idop_detalle_prod=oap.idop_detalle_prod LIMIT 1)=o.idop AND oap.area=1 ORDER BY oap.fecha_hora DESC LIMIT 1) as fecha_avance2
		FROM op o WHERE (SELECT area FROM op_detalle WHERE idop=o.idop AND area = 1 LIMIT 1) = 1";
		return ejecutarConsulta($sql);
	}

	public function buscar_idop($no_op_buscar)
	{

		$sql="SELECT idop, estatus FROM op WHERE no_op='$no_op_buscar'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function mostrar_op($idop)
	{

		$sql="SELECT od.idop_detalle,od.idop,od.area, (SELECT count(area) FROM op_detalle WHERE idop='$idop') as num_areas, (SELECT nombre FROM area WHERE idarea=od.area) as nom_area,
		(SELECT color FROM area WHERE idarea=od.area) as color_area, 
		(SELECT SUM(cant_tot) FROM op_detalle_prod WHERE idop = '$idop') as cant_req,
		(SELECT SUM(cant_capt) FROM op_avance_prod WHERE idop = '$idop' AND area=od.area) as avance_op,
		(SELECT estatus FROM op WHERE idop='$idop') as estatus_op

		FROM op_detalle od WHERE od.idop='$idop' ORDER BY (SELECT num_proc FROM area WHERE idarea=od.area) ASC";
		return ejecutarConsulta($sql);
	}

	public function consul_depend($idop,$area_num)
	{

		$sql="SELECT SUM(cant_capt) FROM op_avance_prod WHERE idop = '$idop' AND (SELECT num_proc FROM area WHERE )) as avance_op";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function contar_errores_op()
	{

		$sql="SELECT p.no_control,(SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as codigo FROM pg_detped pd INNER JOIN pg_pedidos p ON pd.idpedido=p.idpg_pedidos WHERE pd.cantidad = (SELECT sum(cant_tot) FROM op_detalle_prod WHERE idpg_detped=pd.idpg_detped) AND pd.estatus = 'Produccion' AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' AND estatus2=1";
		return ejecutarConsulta($sql);
	}


	public function consul_estatus_op($idop)
	{

		$sql="SELECT * FROM op WHERE idop='$idop'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function consul_estatus_op2($idop_detalle_prod)
	{

		$sql="SELECT * FROM op WHERE idop=(SELECT idop FROM op_detalle_prod WHERE idop_detalle_prod='$idop_detalle_prod' LIMIT 1)";
		return ejecutarConsultaSimpleFila($sql);
	}





	public function reordenar($idop_detalle,$select_prioridad,$prioridad,$idop)
	{

		$sql="UPDATE op_detalle SET prioridad = '$prioridad' WHERE prioridad='$select_prioridad' AND idop='$idop'";
		ejecutarConsulta($sql);


		$sql2="UPDATE op_detalle SET prioridad = '$select_prioridad' WHERE idop_detalle='$idop_detalle'";
		return ejecutarConsulta($sql2);
	}


	public function consul_area_entrega($idop)
	{

		$sql="SELECT area FROM op_detalle WHERE idop='$idop' ORDER BY prioridad DESC";
		return ejecutarConsultaSimpleFila($sql);
	}


	public function update_estat_prod()
	{

		$sql="SELECT estatus FROM pg_detped WHERE estatus='Produccion'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function select_op($idpg_detped,$val_select)
	{

		$sql="UPDATE pg_detped SET select_op='$val_select' WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsulta($sql);
	}


	public function listar_prod_confirm_op()
	{

		$sql="SELECT pd.select_op, pd.idpg_detped,p.no_control,pdp.codigo,pdp.descripcion,pd.cantidad,pd.op,pd.estatus,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,p.empaque,pd.fecha_hora,pdp.color,pdp.observacion,p.idpg_pedidos,p.observaciones,pd.iddetalle_pedido,pdp.medida,pd.observ_enlace,pd.no_op_temp, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND tipo > 1) as documentos_ped 
				FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos  WHERE pd.select_op=1";
		return ejecutarConsulta($sql);
	}

	public function quitar_prod_confirm($idpg_detped)
	{

		$sql="UPDATE pg_detped SET select_op=0 WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsulta($sql);
	}

	public function contar_ops()
	{

		$sql="SELECT MAX(no_op) as ult_op FROM op";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function registrar_op($nueva_op,$fecha_hora)
	{

		$sql="INSERT INTO op (no_op,estatus,fecha_registro) VALUES('$nueva_op','1','$fecha_hora')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT idop FROM op WHERE idop='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);
	}


	public function crear_op_confirm()
	{

		$sql="SELECT idpg_detped FROM pg_detped  WHERE select_op=1";
		return ejecutarConsulta($sql);
	}

	public function consul_select_op($idpg_detped)
	{

		$sql="SELECT select_op FROM pg_detped WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function consul_seleccion()
	{

		$sql="SELECT count(idpg_detped) as cant_select FROM pg_detped WHERE select_op=1";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function validar_creacion_op($idop)
	{

		$sql="SELECT count(idpg_detped) as cant_op FROM pg_detped WHERE op=(SELECT no_op FROM op WHERE idop='$idop')";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function validar_creacion_op2($idop)
	{

		$sql="SELECT count(idop_detalle_prod) as cant_idop FROM op_detalle_prod WHERE idop='idop'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function borrar_op($idop)
	{

		$sql="UPDATE op SET estatus='2' where idop='$idop'";
		return ejecutarConsulta($sql);


		// $sql="DELETE FROM op_detalle_prod WHERE idop='$idop'";
		// ejecutarConsulta($sql);

		// $sql_4="DELETE FROM op_detalle WHERE idop='$idop'";
		// ejecutarConsulta($sql_4);

		// $sql_3="UPDATE pg_detped SET estatus='', op='',select_op=0 WHERE op=(SELECT no_op FROM op WHERE idop='$idop')";
		// ejecutarConsulta($sql_3);

		// $sql_2="DELETE FROM op WHERE idop='$idop'";
		// return ejecutarConsulta($sql_2);


	}

	public function activar_op($idop)
	{

		$sql="UPDATE op SET estatus='1' where idop='$idop'";
		return ejecutarConsulta($sql);


	}


	public function rastaurar_op($idop)
	{

		$sql="SELECT idpg_detped FROM pg_detped WHERE op=(SELECT no_op FROM op WHERE idop='$idop')";
		return ejecutarConsulta($sql);
	}

	public function cancelar_prod($idop_prod)
	{

		$sql="UPDATE op_detalle_prod SET estatus=2 WHERE idop_detalle_prod='$idop_prod'";
		return ejecutarConsulta($sql);
	}

	public function borrar_avance($idavance_prod)
	{
		$sql="DELETE FROM op_avance_prod WHERE idavance_prod='$idavance_prod'";
		return ejecutarConsulta($sql);
	}

	public function borrar_excedente($idop_detalle_exc)
	{
		$sql="DELETE FROM op_detalle_exc WHERE idop_detalle_exc='$idop_detalle_exc'";
		return ejecutarConsulta($sql);
	}

	public function upd_cant_avance_prod($idavance_prod,$cantidad)
	{
		$sql="UPDATE op_avance_prod SET cant_capt='$cantidad' WHERE idavance_prod='$idavance_prod'";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_produccion($select_area_prod,$estatus,$offset,$estatus_pedido)
	{
		$area=$select_area_prod;
		if ($area==1) {
			$sQuery = "a.area1 = (SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE area='1' AND idop_detalle_prod=a.idop_detalle_prod) WHERE b.estatus<>'CANCELADO' AND b.estatus<>'ENTREGADO' AND b.estatus<>'0'";
			$sQueryC = "odp.area1";
		}
		if ($area==2) {
			$sQuery = "a.area2 = (SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE area='2' AND idop_detalle_prod=a.idop_detalle_prod) WHERE b.estatus<>'CANCELADO' AND b.estatus<>'ENTREGADO' AND b.estatus<>'0'";
			$sQueryC = "odp.area2";
		}
		if ($area==3) {
			$sQuery = "a.area3 = (SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE area='3' AND idop_detalle_prod=a.idop_detalle_prod) WHERE b.estatus<>'CANCELADO' AND b.estatus<>'ENTREGADO' AND b.estatus<>'0'";
			$sQueryC = "odp.area3";
		}
		if ($area==8) {
			$sQuery = "a.area8 = (SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE area='8' AND idop_detalle_prod=a.idop_detalle_prod) WHERE b.estatus<>'CANCELADO' AND b.estatus<>'ENTREGADO' AND b.estatus<>'0'";
			$sQueryC = "odp.area8";
		}
		if ($area==5) {
			$sQuery = "a.area5 = (SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE area='5' AND idop_detalle_prod=a.idop_detalle_prod) WHERE b.estatus<>'CANCELADO' AND b.estatus<>'ENTREGADO' AND b.estatus<>'0'";
			$sQueryC = "odp.area5";
		}
		if ($area==6) {
			$sQuery = "a.area6 = (SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE area='6' AND idop_detalle_prod=a.idop_detalle_prod) WHERE b.estatus<>'CANCELADO' AND b.estatus<>'ENTREGADO' AND b.estatus<>'0'";
			$sQueryC = "odp.area6";
		}
		if ($area==7) {
			$sQuery = "a.area7 = (SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE area='7' AND idop_detalle_prod=a.idop_detalle_prod) WHERE b.estatus<>'CANCELADO' AND b.estatus<>'ENTREGADO' AND b.estatus<>'0'";
			$sQueryC = "odp.area7";
		}

		if ($estatus_pedido==1) {
			$estatus_ped = " b.estatus='ENTREGADO'";
		}else{
			$estatus_ped = " b.estatus<>'ENTREGADO' AND b.estatus<>'CANCELADO' AND b.estatus<>'0'";
		}
		

		$sql_2="UPDATE op_detalle_prod a INNER JOIN pg_pedidos b ON a.no_control=b.no_control SET $sQuery";
		ejecutarConsulta($sql_2);
		//Query lenta identificada

		if ($estatus==1) {

			$sql="SELECT 
			odp.idop_detalle_prod,
			odp.no_control,
			odp.cant_tot,
			odp.observ,
			a.codigo,
			a.descripcion,
			a.medida,
			a.color,
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area='$area') as area,
			c.no_op as op,
			b.fecha_entrega,
			(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area='$area') as sum_capt,
			(SELECT IFNULL(avance,0) FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area='$area' ORDER BY fecha_hora DESC LIMIT 1) as av_capt,
			b.estatus
			FROM op_detalle_prod odp 
			INNER JOIN pg_detalle_pedidos a ON odp.iddetalle_pedido=a.idpg_detalle_pedidos
			INNER JOIN pg_pedidos b ON odp.no_control = b.no_control
			INNER JOIN op c ON odp.idop = c.idop
			WHERE 
			$sQueryC>=odp.cant_tot
			AND (SELECT count(area) FROM op_detalle WHERE area='$area' AND idop=odp.idop)>0 
			AND $estatus_ped
			ORDER BY b.fecha_entrega ASC";
			return ejecutarConsulta($sql);
		}else{

			$sql="SELECT 
			odp.idop_detalle_prod,
			odp.no_control,
			odp.cant_tot,
			odp.observ,
			a.codigo,
			a.descripcion,
			a.medida,
			a.color,
			(SELECT area FROM op_detalle WHERE idop=odp.idop AND area='$area') as area,
			c.no_op as op,
			b.fecha_entrega,
			(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area='$area') as sum_capt,
			(SELECT IFNULL(avance,0) FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area='$area' ORDER BY fecha_hora DESC LIMIT 1) as av_capt,
			b.estatus
			FROM op_detalle_prod odp 
			INNER JOIN pg_detalle_pedidos a ON odp.iddetalle_pedido=a.idpg_detalle_pedidos
			INNER JOIN pg_pedidos b ON odp.no_control = b.no_control
			INNER JOIN op c ON odp.idop = c.idop
			WHERE 
			$sQueryC<odp.cant_tot
			AND (SELECT count(area) FROM op_detalle WHERE area='$area' AND idop=odp.idop)>0 
			AND $estatus_ped
			ORDER BY b.fecha_entrega ASC";
			return ejecutarConsulta($sql);
		}
		


		// $sql="UPDATE op_detalle_prod a SET area1 = (SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE area='1' AND idop_detalle_prod=a.idop_detalle_prod)";


		
		// "SELECT 
		// 	odp.idop_detalle_prod,
		// 	odp.no_control,
		// 	odp.cant_tot,
		// 	odp.observ,
		// 	a.codigo,
		// 	a.descripcion,
		// 	a.medida,
		// 	a.color,
		// 	(SELECT area FROM op_detalle WHERE idop=odp.idop AND area='$area') as area,
		// 	c.no_op as op,
		// 	b.fecha_entrega,
		// 	(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area='$area') as sum_capt,
		// 	(SELECT IFNULL(avance,0) FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area='$area' ORDER BY fecha_hora DESC LIMIT 1) as av_capt,
		// 	b.estatus
		// 	FROM op_detalle_prod odp 
		// 	INNER JOIN pg_detalle_pedidos a ON odp.iddetalle_pedido=a.idpg_detalle_pedidos
		// 	INNER JOIN pg_pedidos b ON odp.no_control = b.no_control
		// 	INNER JOIN op c ON odp.idop = c.idop
		// 	WHERE 
		// 	odp.area1>=odp.cant_tot
		// 	AND (SELECT count(area) FROM op_detalle WHERE area='$area' AND idop=odp.idop)>0 
		// 	AND b.estatus<>'ENTREGADO' AND b.estatus<>'CANCELADO' AND b.estatus<>'0'
		// 	ORDER BY b.fecha_entrega ASC"
		
		
		// $sql="SELECT odp.idop_detalle_prod,odp.no_control,odp.cant_tot,odp.observ,
		// (SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido) as codigo,
		// (SELECT descripcion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido) as descripcion,
		// (SELECT medida FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido) as medida,
		// (SELECT color FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido) as color,

		// (SELECT area FROM op_detalle WHERE idop=odp.idop AND area='$area') as area,
		// (SELECT no_op FROM op WHERE idop=odp.idop) as op,
		// (SELECT fecha_entrega FROM pg_pedidos WHERE no_control=odp.no_control) as fecha_entrega,

		// (SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area='$area') as sum_capt,
		// (SELECT IFNULL(avance,0) FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area='$area' ORDER BY fecha_hora DESC LIMIT 1) as av_capt
				
		// FROM op_detalle_prod odp 
		// WHERE (SELECT count(area) FROM op_detalle WHERE area='$area' AND idop=odp.idop)>0 AND 
		// 	  (SELECT estatus FROM pg_pedidos WHERE no_control=odp.no_control)<>'ENTREGADO' AND
		// 	  (SELECT estatus FROM pg_pedidos WHERE no_control=odp.no_control)<>'CANCELADO'
		// ORDER BY (SELECT fecha_entrega FROM pg_pedidos WHERE no_control=odp.no_control) ASC LIMIT 10 offset $offset";
		// return ejecutarConsulta($sql);
	}

	public function addProdOp()
	{
		$sql="SELECT pd.idpg_detped, pd.select_op,p.no_control,pdp.codigo,pdp.descripcion,pd.cantidad,pd.op,pd.estatus,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,p.empaque,pd.fecha_hora,pdp.color,pdp.observacion,p.idpg_pedidos,p.observaciones,pd.iddetalle_pedido,pdp.medida,pd.observ_enlace,pd.no_op_temp, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND tipo > 1) as documentos_ped,
				(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as estatus_pedido,
				(SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as tipo_pedido  
				FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos  WHERE pd.estatus='Produccion' AND pd.op='' AND p.estatus<>'CANCELADO' ORDER BY p.no_control DESC";
				return ejecutarConsulta($sql);
	}

	public function addProd_op($idop,$idpg_detped,$no_control,$codigo,$descripcion,$empaque,$cantidad,$fecha_pedido,$fecha_entrega,$observaciones,$estatus,$medida,$color,$iddetalle_pedido)
	{
		$sql="INSERT INTO op_detalle_prod (idop,idpg_detped,no_control,codigo,producto,empaque,cant_tot,fecha_inicio,fecha_term,observ,medida,color,iddetalle_pedido) VALUES('$idop','$idpg_detped','$no_control','$codigo','$descripcion','$empaque','$cantidad','$fecha_pedido','$fecha_entrega','$observaciones','$medida','$color','$iddetalle_pedido')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql="UPDATE pg_detped SET op=(SELECT no_op FROM op WHERE idop='$idop') WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsulta($sql);
	}

	public function listar_op_estatus($area,$estatus)
	{
		if ($estatus==1) {
			$condition = "(SELECT sum(cant_capt) FROM op_avance_prod WHERE idop = a.idop AND area='$area')>=(SELECT sum(cant_tot) FROM op_detalle_prod WHERE idop = a.idop)";
		}
		if ($estatus==2) {
			$condition = "(SELECT sum(cant_capt) FROM op_avance_prod WHERE idop = a.idop AND area='$area')<(SELECT sum(cant_tot) FROM op_detalle_prod WHERE idop = a.idop)";
		}

		$sql_2="SELECT 
		a.no_op, 
		a.fecha_registro,
		(SELECT count(idop_detalle) FROM op_detalle WHERE idop = a.idop) as cant_areas,	
		(SELECT sum(cant_tot) FROM op_detalle_prod WHERE idop = a.idop) as total_producto,
		(SELECT sum(cant_capt) FROM op_avance_prod WHERE idop = a.idop AND area='$area') as avance_area,
		(SELECT sum(cant_capt) FROM op_avance_prod WHERE idop = a.idop) as avance_total		
		FROM op a WHERE (SELECT count(idop_detalle) FROM op_detalle WHERE idop = a.idop AND area='$area')>0 
		AND
		$condition
		ORDER BY a.no_op DESC";
		return ejecutarConsulta($sql_2);
	
	}

	public function listar_op_estatus_()
	{

		$sql_2="SELECT 
		(SELECT count(idop_detalle) FROM op_detalle WHERE idop = a.idop) as areas,
		a.no_op, a.fecha_registro,
		(SELECT sum(cant_tot) FROM op_detalle_prod WHERE idop = a.idop) as Total_Area,
		((SELECT count(idop_detalle) FROM op_detalle WHERE idop = a.idop)*(SELECT sum(cant_tot) FROM op_detalle_prod WHERE idop = a.idop)) as Total_OP,		

		(SELECT count(idop_detalle) FROM op_detalle WHERE idop = a.idop AND area=1) as Herreria,
		(SELECT sum(cant_capt) FROM op_avance_prod WHERE idop = a.idop AND area=1) as Avance_Herreria,

		(SELECT count(idop_detalle) FROM op_detalle WHERE idop = a.idop AND area=2) as Pintura,
		(SELECT sum(cant_capt) FROM op_avance_prod WHERE idop = a.idop AND area=2) as Avance_Pintura,

		(SELECT count(idop_detalle) FROM op_detalle WHERE idop = a.idop AND area=3) as Plásticos,
		(SELECT sum(cant_capt) FROM op_avance_prod WHERE idop = a.idop AND area=3) as Avance_Plasticos,

		(SELECT count(idop_detalle) FROM op_detalle WHERE idop = a.idop AND area=5) as Ens_Porc,
		(SELECT sum(cant_capt) FROM op_avance_prod WHERE idop = a.idop AND area=5) as Avance_Ens_Porc,

		(SELECT count(idop_detalle) FROM op_detalle WHERE idop = a.idop AND area=6) as Ens_Com,
		(SELECT sum(cant_capt) FROM op_avance_prod WHERE idop = a.idop AND area=6) as Avance_Ens_Com,

		(SELECT count(idop_detalle) FROM op_detalle WHERE idop = a.idop AND area=7) as Ens_Mue,
		(SELECT sum(cant_capt) FROM op_avance_prod WHERE idop = a.idop AND area=7) as Avance_Ens_Mue,

		(SELECT count(idop_detalle) FROM op_detalle WHERE idop = a.idop AND area=8) as Horno,
		(SELECT sum(cant_capt) FROM op_avance_prod WHERE idop = a.idop AND area=8) as Avance_Horno,

		(SELECT sum(cant_capt) FROM op_avance_prod WHERE idop = a.idop) as Avance_Total
		
		FROM op a LIMIT 10";
		return ejecutarConsulta($sql_2);
	
	}
	

}
?>