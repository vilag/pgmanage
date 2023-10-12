<?php
 	require "../config/Conexion.php";

 	Class Almacen_pt
 	{
 		public function __construct()
		{

		}

		public function codigos_alm_pt($id)
		{
			
				$sql="SELECT ap.idalmacen_pt,ap.idproducto,ap.codigo,ap.nombre,ap.cantidad,
				(SELECT IFNULL(sum(cantidad),0) FROM almacen_pt_ed WHERE idalmacen_pt=ap.idalmacen_pt AND movimiento='Entrada') as cant_entrada, 
				(SELECT IFNULL(sum(cantidad),0) FROM almacen_pt_ed WHERE idalmacen_pt=ap.idalmacen_pt AND movimiento='Salida') as cant_salida
				FROM almacen_pt ap WHERE ap.codigo LIKE '%".$id."%' OR ap.nombre LIKE '%".$id."%' ORDER BY ap.codigo asc";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);
			

						
		}

		public function concidencias($codigo)
		{				
				
				$sql="SELECT count(codigo) as num_coin FROM almacen_pt WHERE codigo LIKE '%".$codigo."%'";
				return ejecutarConsultaSimpleFila($sql);
	
		}



		public function guardar_registro($idalmacen_pt,$tipo,$codigo,$codigo_alm,$codigo_nuevo,$sub_code,$nombre,$medidas,$alto,$largo,$ancho,$extra,$color,$cantidad,$mov,$lote,$op,$control,$fecha_hora,$comentario,$idproducto_clasif)
		{

			if ($idalmacen_pt==0) {

				$sql="INSERT INTO almacen_pt (idproducto,tipo,codigo,codigo_alm,codigo_nuevo,num_cod,nombre,medidas,alto,largo,ancho,extra,color,cantidad) VALUES ('$idproducto_clasif','$tipo','$codigo','$codigo_alm','$codigo_nuevo','$sub_code','$nombre','$medidas','$alto','$largo','$ancho','$extra','$color','$cantidad')";
				$idingresonew=ejecutarConsulta_retornarID($sql);

				$sql_id="INSERT INTO almacen_pt_ed (idalmacen_pt,movimiento,cantidad,lote,op,control,fecha_hora,comentario) VALUES ('$idingresonew','$mov','$cantidad','$lote','$op','$control','$fecha_hora','$comentario')";
		        return ejecutarConsulta($sql_id);
				
			}elseif ($idalmacen_pt>0) {

				if ($mov=="Entrada") {

					$sql_id1="UPDATE almacen_pt SET cantidad = cantidad+'$cantidad' WHERE idalmacen_pt='$idalmacen_pt'";
		        	ejecutarConsulta($sql_id1);

				}elseif ($mov=="Salida") {

					$sql_id2="UPDATE almacen_pt SET cantidad = cantidad-'$cantidad' WHERE idalmacen_pt='$idalmacen_pt'";
		        	ejecutarConsulta($sql_id2);

				}
				
				$sql_id3="INSERT INTO almacen_pt_ed (idalmacen_pt,movimiento,cantidad,lote,op,control,fecha_hora,comentario) VALUES ('$idalmacen_pt','$mov','$cantidad','$lote','$op','$control','$fecha_hora','$comentario')";
		        return ejecutarConsulta($sql_id3);
			}

					
		}

		public function select_prod($idalmacen_pt)
		{

			$sql="SELECT ap.idalmacen_pt,ap.idproducto,ap.tipo,ap.codigo,ap.codigo_alm,ap.nombre,ap.medidas,ap.alto,ap.largo,ap.ancho,ap.color,ap.cantidad,ap.stat, 
			(SELECT IFNULL(sum(cantidad),0) FROM almacen_pt_ed WHERE idalmacen_pt=ap.idalmacen_pt AND movimiento='Entrada') as cant_entrada, 
			(SELECT IFNULL(sum(cantidad),0) FROM almacen_pt_ed WHERE idalmacen_pt=ap.idalmacen_pt AND movimiento='Salida') as cant_salida
			FROM almacen_pt ap WHERE ap.idalmacen_pt='$idalmacen_pt'";
			return ejecutarConsultaSimpleFila($sql);			
		}

		public function sub_codigo($codigo_nuevo)
		{

			$sql="SELECT num_cod FROM almacen_pt WHERE codigo_nuevo='$codigo_nuevo' ORDER BY num_cod desc LIMIT 1";
			return ejecutarConsultaSimpleFila($sql);			
		}

		
		public function listar_re_alm()
		{

			$sql="SELECT ap.idalmacen_pt,ap.idproducto,ap.tipo,ap.codigo,ap.codigo_alm,ap.nombre,ap.medidas,ap.alto,ap.largo,ap.ancho,ap.color,ap.cantidad,ap.stat, 
			(SELECT IFNULL(sum(cantidad),0) FROM almacen_pt_ed WHERE idalmacen_pt=ap.idalmacen_pt AND movimiento='Entrada') as cant_entrada, 
			(SELECT IFNULL(sum(cantidad),0) FROM almacen_pt_ed WHERE idalmacen_pt=ap.idalmacen_pt AND movimiento='Salida') as cant_salida FROM almacen_pt ap ORDER BY ap.codigo DESC";
			return ejecutarConsulta($sql);			
		}

		public function listar_es($id)
		{

			if ($id>0) {
				
				$sql="SELECT ae.idalmacen_pt_ed,ap.codigo,ap.nombre,ae.movimiento,ae.cantidad,ae.lote,ae.op,ae.control,ae.fecha_hora,ae.comentario,ae.lote FROM almacen_pt_ed ae INNER JOIN almacen_pt ap ON ae.idalmacen_pt=ap.idalmacen_pt WHERE ap.idalmacen_pt='$id' ORDER BY ae.idalmacen_pt_ed DESC LIMIT 5";
				return ejecutarConsulta($sql);
				
			}elseif ($id==0) {
				
				$sql="SELECT ae.idalmacen_pt_ed,ap.codigo,ap.nombre,ae.movimiento,ae.cantidad,ae.lote,ae.op,ae.control,ae.fecha_hora,ae.comentario,ae.lote FROM almacen_pt_ed ae INNER JOIN almacen_pt ap ON ae.idalmacen_pt=ap.idalmacen_pt ORDER BY ae.idalmacen_pt_ed DESC LIMIT 5";
				return ejecutarConsulta($sql);	
			}

						
		}

		public function listar_es_todo($id)
		{

			if ($id>0) {
				
				$sql="SELECT ae.idalmacen_pt_ed,ap.codigo,ap.nombre,ae.movimiento,ae.cantidad,ae.lote,ae.op,ae.control,ae.fecha_hora,ae.comentario,ae.lote FROM almacen_pt_ed ae INNER JOIN almacen_pt ap ON ae.idalmacen_pt=ap.idalmacen_pt WHERE ap.idalmacen_pt='$id' ORDER BY ae.idalmacen_pt_ed DESC";
				return ejecutarConsulta($sql);
				
			}elseif ($id==0) {
				
				$sql="SELECT ae.idalmacen_pt_ed,ap.codigo,ap.nombre,ae.movimiento,ae.cantidad,ae.lote,ae.op,ae.control,ae.fecha_hora,ae.comentario,ae.lote FROM almacen_pt_ed ae INNER JOIN almacen_pt ap ON ae.idalmacen_pt=ap.idalmacen_pt ORDER BY ae.idalmacen_pt_ed DESC";
				return ejecutarConsulta($sql);	
			}

						
		}

		public function listar_fabricados($id)
		{
			if ($id==0) {

				$sql="SELECT pd.idpg_detped,pd.fecha_hora2,pdp.codigo,pdp.descripcion,pd.validacion FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos WHERE pd.estatus='Fabricado' AND p.estatus2=1 AND p.estatus<>'ENTREGADO' AND p.estatus<>'LISTO PARA ENTREGA' AND pd.validacion=0 ORDER BY pd.fecha_hora2 DESC";
				return ejecutarConsulta($sql);
			}

			if ($id==1) {

				$sql="SELECT pd.idpg_detped,pd.fecha_hora2,pdp.codigo,pdp.descripcion,pd.validacion FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos WHERE pd.estatus='Fabricado' AND p.estatus2=1 AND p.estatus<>'ENTREGADO' AND p.estatus<>'LISTO PARA ENTREGA' AND pd.validacion=1 ORDER BY pd.fecha_hora2 DESC";
				return ejecutarConsulta($sql);
			}

			if ($id==2) {

				$sql="SELECT pd.idpg_detped,pd.fecha_hora2,pdp.codigo,pdp.descripcion,pd.validacion FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos WHERE pd.estatus='Fabricado' AND p.estatus2=1 AND p.estatus<>'ENTREGADO' AND p.estatus<>'LISTO PARA ENTREGA' AND pd.validacion=2 ORDER BY pd.fecha_hora2 DESC";
				return ejecutarConsulta($sql);
			}

			if ($id==3) {

				$sql="SELECT pd.idpg_detped,pd.fecha_hora2,pdp.codigo,pdp.descripcion,pd.validacion FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos WHERE pd.estatus='Fabricado' AND p.estatus2=1 AND p.estatus<>'ENTREGADO' AND p.estatus<>'LISTO PARA ENTREGA' ORDER BY pd.fecha_hora2 DESC";
				return ejecutarConsulta($sql);
			}

							
		}

		public function detalle_producto($idpg_detped)
		{

			$sql="SELECT pd.idpg_detped,pdp.codigo,pdp.descripcion,p.no_control,pd.op,pd.fecha_hora2,pd.iddetalle_pedido,pdp.cantidad,pd.lote,pd.validacion,pdp.observacion,pd.observ_enlace,p.observaciones,(SELECT idop_detalle_prod FROM op_detalle_prod WHERE idpg_detped='$idpg_detped') as idop_detalle_prod,

			(SELECT lote FROM op_avance_prod WHERE idop_detalle_prod = (SELECT idop_detalle_prod FROM op_detalle_prod WHERE idpg_detped='$idpg_detped') AND area=1 ORDER BY fecha_hora DESC LIMIT 1) as lote1,
			(SELECT lote FROM op_avance_prod WHERE idop_detalle_prod = (SELECT idop_detalle_prod FROM op_detalle_prod WHERE idpg_detped='$idpg_detped') AND area=2 ORDER BY fecha_hora DESC LIMIT 1) as lote2,
			(SELECT lote FROM op_avance_prod WHERE idop_detalle_prod = (SELECT idop_detalle_prod FROM op_detalle_prod WHERE idpg_detped='$idpg_detped') AND area=3 ORDER BY fecha_hora DESC LIMIT 1) as lote3,
			(SELECT lote FROM op_avance_prod WHERE idop_detalle_prod = (SELECT idop_detalle_prod FROM op_detalle_prod WHERE idpg_detped='$idpg_detped') AND area=5 ORDER BY fecha_hora DESC LIMIT 1) as lote5,
			(SELECT lote FROM op_avance_prod WHERE idop_detalle_prod = (SELECT idop_detalle_prod FROM op_detalle_prod WHERE idpg_detped='$idpg_detped') AND area=6 ORDER BY fecha_hora DESC LIMIT 1) as lote6,
			(SELECT lote FROM op_avance_prod WHERE idop_detalle_prod = (SELECT idop_detalle_prod FROM op_detalle_prod WHERE idpg_detped='$idpg_detped') AND area=7 ORDER BY fecha_hora DESC LIMIT 1) as lote7,
			(SELECT lote FROM op_avance_prod WHERE idop_detalle_prod = (SELECT idop_detalle_prod FROM op_detalle_prod WHERE idpg_detped='$idpg_detped') AND area=8 ORDER BY fecha_hora DESC LIMIT 1) as lote8  

			FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos WHERE idpg_detped='$idpg_detped'";
			return ejecutarConsultaSimpleFila($sql);			
		}

		public function cargar_estatus($id)
		{

			$sql="SELECT * FROM pg_detped pd WHERE iddetalle_pedido='$id'";
			return ejecutarConsulta($sql);			
		}

		public function listar_areas($id)
		{

			$sql="SELECT * FROM op_detalle WHERE idop='$id'";
			return ejecutarConsulta($sql);			
		}

		public function validado($idpg_detped)
		{

			$sql="UPDATE pg_detped SET validacion = 1 WHERE idpg_detped='$idpg_detped'";
			return ejecutarConsulta($sql);			
		}

		public function alerta($idpg_detped)
		{

			$sql="UPDATE pg_detped SET validacion = 2 WHERE idpg_detped='$idpg_detped'";
			return ejecutarConsulta($sql);	

					
		}

		public function listar_lotes($id,$val2)
		{
			$sql="SELECT fecha_hora, avance, lote, comentario FROM op_avance_prod WHERE idop_detalle_prod='$id' AND area='$val2' ORDER BY idavance_prod DESC";
			return ejecutarConsulta($sql);
		}

		public function buscar_idop($op)
		{

			$sql="SELECT idop FROM op WHERE no_op = '$op'";
			return ejecutarConsultaSimpleFila($sql);			
		}

		public function listar_areas2($id)
		{
			$sql="SELECT DISTINCT area FROM op_detalle od WHERE idop='$id' AND area<>''";
			return ejecutarConsulta($sql);
		}

		public function update_existencia($idalmacen_pt,$exist_inv)
		{
			$sql="UPDATE almacen_pt SET cantidad='$exist_inv' WHERE idalmacen_pt='$idalmacen_pt'";
			 ejecutarConsulta($sql);
		}

		public function abrir_detalle_mov($idalmacen_pt_ed)
		{

		
				
				$sql="SELECT ae.idalmacen_pt_ed,ap.codigo,ap.nombre,ae.movimiento,ae.cantidad,ae.lote,ae.op,ae.control,ae.fecha_hora,ae.comentario FROM almacen_pt_ed ae INNER JOIN almacen_pt ap ON ae.idalmacen_pt=ap.idalmacen_pt WHERE ae.idalmacen_pt_ed='$idalmacen_pt_ed'";
				return ejecutarConsultaSimpleFila($sql);
				
			

						
		}


		public function abrir_terminados2()
		{

			/*$sql="SELECT n.idnotif,p.idpg_pedidos,p.no_control,n.fecha_hora as fecha_notif,DATE(n.fecha_hora) as fecha, TIME(n.fecha_hora) as hora,n.estatus, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'' AND tipo='1') as num_docs, (SELECT nombre FROM clientes WHERE idcliente=p.idcliente) as nom_cliente, (SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as prod_total, IFNULL((SELECT sum(cantidad) FROM entregas_detalle WHERE idpedido=p.idpg_pedidos),0) as prod_entregados FROM notif n INNER JOIN pg_pedidos p ON n.idpedido=p.idpg_pedidos WHERE p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO'  ORDER BY n.idnotif DESC";
			return ejecutarConsulta($sql);*/


			$sql="SELECT p.no_control,p.idpg_pedidos,
			(SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'' AND tipo='1') as num_docs,
			(SELECT nombre FROM clientes WHERE idcliente=p.idcliente) as nom_cliente,
			(SELECT pdp.fecha_hora2 FROM pg_detped pdp WHERE (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pdp.iddetalle_pedido LIMIT 1) = p.idpg_pedidos ORDER BY pdp.fecha_hora2 DESC LIMIT 1) as fecha_entrega_fab,
			(SELECT pdp.fecha_hora FROM pg_detped pdp WHERE (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pdp.iddetalle_pedido LIMIT 1) = p.idpg_pedidos ORDER BY pdp.fecha_hora DESC LIMIT 1) as fecha_entrega_set,
			(SELECT sum(cantidad) FROM salidas_entregas_detalles WHERE idpedido=p.idpg_pedidos) as cant_entrega,
			(SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as cant_pendiente
			FROM pg_pedidos p WHERE p.cant_est >= (SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' ORDER BY p.estatus_docs DESC";
			return ejecutarConsulta($sql);

		}

		public function abrir_terminados()
		{



			/*$sql="SELECT oap.idavance_prod,oap.area,(SELECT nombre FROM area WHERE idarea = oap.area) as nom_area,odp.idop_detalle_prod,p.no_control,(SELECT no_op FROM op WHERE idop=odp.idop) as no_op,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,odp.cant_tot,oap.fecha_hora,p.idpg_pedidos,(SELECT idop_detalle FROM op_detalle WHERE idop=odp.idop AND area = oap.area) as idop_detalle,
			(SELECT sum(cantidad) FROM op_detalle_exc WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=oap.area) as cant_exc,oap.lote 
			FROM op_avance_prod oap INNER JOIN op_detalle_prod odp ON oap.idop_detalle_prod=odp.idop_detalle_prod INNER JOIN pg_detped pd ON odp.idpg_detped=pd.idpg_detped INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos 
			WHERE (oap.avance=odp.cant_tot AND oap.validado=0 AND oap.area = 3) OR 
			(oap.avance=odp.cant_tot AND oap.validado=0 AND oap.area = 5) OR
			(oap.avance=odp.cant_tot AND oap.validado=0 AND oap.area = 6) OR
			(oap.avance=odp.cant_tot AND oap.validado=0 AND oap.area = 7) 
			ORDER BY oap.idavance_prod DESC";
			return ejecutarConsulta($sql);*/

			$sql="SELECT oap.idavance_prod,oap.area,(SELECT nombre FROM area WHERE idarea = oap.area) as nom_area,odp.idop_detalle_prod,p.no_control,(SELECT no_op FROM op WHERE idop=odp.idop) as no_op,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,odp.cant_tot,oap.fecha_hora,p.idpg_pedidos,(SELECT idop_detalle FROM op_detalle WHERE idop=odp.idop AND area = oap.area) as idop_detalle,oap.avance,oap.cant_capt,
			(SELECT avance FROM op_avance_prod WHERE area=oap.area AND idop_detalle_prod=odp.idop_detalle_prod AND idavance_prod<oap.idavance_prod ORDER BY fecha_hora DESC LIMIT 1) as ultimo_avance,
			(SELECT sum(cantidad) FROM op_detalle_exc WHERE idavance_prod=oap.idavance_prod) as cant_exc,oap.lote,oap.comentario 
			FROM op_avance_prod oap INNER JOIN op_detalle_prod odp ON oap.idop_detalle_prod=odp.idop_detalle_prod INNER JOIN pg_detped pd ON odp.idpg_detped=pd.idpg_detped INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos 
			WHERE (oap.validado=0 AND oap.area = 3) OR 
			(oap.validado=0 AND oap.area = 5) OR
			(oap.validado=0 AND oap.area = 6) OR
			(oap.validado=0 AND oap.area = 7) 
			ORDER BY oap.area,odp.idop,p.no_control,oap.avance ASC";
			return ejecutarConsulta($sql);

		}


		public function abrir_excedentes()
		{

			$sql="SELECT ode.idop_detalle_exc,ode.area,(SELECT nombre FROM area WHERE idarea = ode.area) as nom_area,odp.idop_detalle_prod,p.no_control,(SELECT no_op FROM op WHERE idop=odp.idop) as no_op,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,odp.cant_tot,ode.fecha_hora,p.idpg_pedidos,(SELECT idop_detalle FROM op_detalle WHERE idop=odp.idop AND area = ode.area) as idop_detalle,ode.cantidad,ode.lote,ode.comentario
			FROM op_detalle_exc ode INNER JOIN op_detalle_prod odp ON ode.idop_detalle_prod=odp.idop_detalle_prod INNER JOIN pg_detped pd ON odp.idpg_detped=pd.idpg_detped INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos 
			WHERE (ode.validado=0 AND ode.area = 3) OR 
			(ode.validado=0 AND ode.area = 5) OR
			(ode.validado=0 AND ode.area = 6) OR
			(ode.validado=0 AND ode.area = 7) 
			ORDER BY ode.area,odp.idop,p.no_control,ode.cantidad ASC";
			return ejecutarConsulta($sql);

		}

		public function listar_terminados_buscar($op)
		{


			$sql="SELECT oap.idavance_prod,oap.area,(SELECT nombre FROM area WHERE idarea = oap.area) as nom_area,odp.idop_detalle_prod,p.no_control,(SELECT no_op FROM op WHERE idop=odp.idop) as no_op,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,odp.cant_tot,oap.fecha_hora,p.idpg_pedidos,(SELECT idop_detalle FROM op_detalle WHERE idop=odp.idop AND area = oap.area) as idop_detalle,
			(SELECT sum(cantidad) FROM op_detalle_exc WHERE idop_detalle_prod=odp.idop_detalle_prod AND area=oap.area) as cant_exc 
			FROM op_avance_prod oap INNER JOIN op_detalle_prod odp ON oap.idop_detalle_prod=odp.idop_detalle_prod INNER JOIN pg_detped pd ON odp.idpg_detped=pd.idpg_detped INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos 
			WHERE 
			oap.avance=odp.cant_tot AND oap.validado=0 AND (SELECT no_op FROM op WHERE idop=odp.idop) = '$op' 
			ORDER BY 
			oap.idavance_prod DESC";

			return ejecutarConsulta($sql);

		}

		public function listar_avances($id)
		{


			$sql="SELECT * FROM op_detalle_exc WHERE idavance_prod='$id' ORDER BY fecha_hora ASC";
			return ejecutarConsulta($sql);

		}

		public function listar_avances1($id)
		{


			$sql="SELECT * FROM op_avance_prod WHERE idavance_prod='$id' ORDER BY fecha_hora ASC";
			return ejecutarConsulta($sql);

		}

		public function buscar_idprod($idavance)
		{

			/*$sql="SELECT idproducto,
			(SELECT cant_tot FROM op_detalle_prod WHERE idop_detalle_prod='$idop_detalle_prod') as cantidad,
			(SELECT lote FROM op_avance_prod WHERE idop_detalle_prod = '$idop_detalle_prod' ORDER BY idavance_prod DESC LIMIT 1) as lote,
			(SELECT no_control FROM op_detalle_prod WHERE idop_detalle_prod = '$idop_detalle_prod') as no_control,
			(SELECT no_op FROM op WHERE idop=(SELECT idop FROM op_detalle_prod WHERE idop_detalle_prod='$idop_detalle_prod')) as no_op
			FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=(SELECT iddetalle_pedido FROM pg_detped WHERE idpg_detped=(SELECT idpg_detped FROM op_detalle_prod WHERE idop_detalle_prod='$idop_detalle_prod'))";
			return ejecutarConsultaSimpleFila($sql);*/

			$sql="SELECT oap.idavance_prod,pdp.idproducto,oap.avance as cantidad,oap.lote,p.no_control,(SELECT no_op FROM op WHERE idop=odp.idop) as no_op FROM op_avance_prod oap INNER JOIN op_detalle_prod odp ON oap.idop_detalle_prod=odp.idop_detalle_prod INNER JOIN pg_detped pd ON odp.idpg_detped=pd.idpg_detped INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos 
			WHERE oap.idavance_prod='$idavance'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function buscar_idprod_exc($idexc)
		{

			$sql="SELECT ode.idop_detalle_exc,pdp.idproducto,ode.cantidad,ode.lote,p.no_control,(SELECT no_op FROM op WHERE idop=odp.idop) as no_op 
			FROM op_detalle_exc ode INNER JOIN op_detalle_prod odp ON ode.idop_detalle_prod=odp.idop_detalle_prod INNER JOIN pg_detped pd ON odp.idpg_detped=pd.idpg_detped INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos 
			WHERE ode.idop_detalle_exc='$idexc'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function guardar_entrada($idavance,$idproducto,$cantidad,$lote,$no_control,$no_op,$fecha_hora,$comentario,$ubicacion,$exist_prod)
		{

			if ($exist_prod==0) {
				
				$sql="INSERT INTO almacen_pt (idproducto,codigo,nombre,medidas,color,cantidad) SELECT idproducto,codigo,nombre,medida,color,'$cantidad' FROM productos WHERE idproducto='$idproducto'";
				$idingresonew=ejecutarConsulta_retornarID($sql);

				$sql2="INSERT INTO almacen_pt_ed (idalmacen_pt,movimiento,cantidad,lote,op,control,fecha_hora,comentario,ubicacion,idavance,estatus) VALUES('$idingresonew','Entrada','$cantidad','$lote','$no_op','$no_control','$fecha_hora','$comentario','$ubicacion','$idavance','1')";
				ejecutarConsulta($sql2);

				$sql4="UPDATE op_avance_prod SET validado = 1, fecha_hora_valid='$fecha_hora' WHERE idavance_prod='$idavance'";
				return ejecutarConsulta($sql4);

			}elseif ($exist_prod>0) {
				$sql3="INSERT INTO almacen_pt_ed (idalmacen_pt,movimiento,cantidad,lote,op,control,fecha_hora,comentario,ubicacion,idavance,estatus) VALUES('$exist_prod','Entrada','$cantidad','$lote','$no_op','$no_control','$fecha_hora','$comentario','$ubicacion','$idavance','1')";
				ejecutarConsulta($sql3);

				$sql5="UPDATE almacen_pt SET cantidad = cantidad + '$cantidad' WHERE idalmacen_pt='$exist_prod'";
				ejecutarConsulta($sql5);

				$sql6="UPDATE op_avance_prod SET validado = 1, fecha_hora_valid='$fecha_hora' WHERE idavance_prod='$idavance'";
				return ejecutarConsulta($sql6);
			}
			

		}

		public function guardar_entrada_exc($idexc,$idproducto,$cantidad,$lote,$no_control,$no_op,$fecha_hora,$comentario,$ubicacion,$exist_prod)
		{

			if ($exist_prod==0) {
				
				$sql="INSERT INTO almacen_pt (idproducto,codigo,nombre,medidas,color,cantidad) SELECT idproducto,codigo,nombre,medida,color,'$cantidad' FROM productos WHERE idproducto='$idproducto'";
				$idingresonew=ejecutarConsulta_retornarID($sql);

				$sql2="INSERT INTO almacen_pt_ed (idalmacen_pt,movimiento,cantidad,lote,op,control,fecha_hora,comentario,ubicacion,idavance,estatus,coment2) VALUES('$idingresonew','Entrada','$cantidad','$lote','$no_op','$no_control','$fecha_hora','$comentario','$ubicacion','$idexc','1','Excedente')";
				ejecutarConsulta($sql2);

				$sql4="UPDATE op_detalle_exc SET validado = 1, fecha_valid='$fecha_hora' WHERE idop_detalle_exc='$idexc'";
				return ejecutarConsulta($sql4);

			}elseif ($exist_prod>0) {
				$sql3="INSERT INTO almacen_pt_ed (idalmacen_pt,movimiento,cantidad,lote,op,control,fecha_hora,comentario,ubicacion,idavance,estatus,coment2) VALUES('$exist_prod','Entrada','$cantidad','$lote','$no_op','$no_control','$fecha_hora','$comentario','$ubicacion','$idexc','1','Excedente')";
				ejecutarConsulta($sql3);

				$sql5="UPDATE almacen_pt SET cantidad = cantidad + '$cantidad' WHERE idalmacen_pt='$exist_prod'";
				ejecutarConsulta($sql5);

				$sql6="UPDATE op_detalle_exc SET validado = 1, fecha_valid='$fecha_hora' WHERE idop_detalle_exc='$idexc'";
				return ejecutarConsulta($sql6);
			}
			

		}

		public function exist_prod_alm($idproducto)
		{


			$sql="SELECT idalmacen_pt FROM almacen_pt WHERE idproducto='$idproducto'";
			return ejecutarConsultaSimpleFila($sql);

		}

		public function guardar_error($idop_detalle_prod,$exist_prod)
		{
			$sql="INSERT INTO almacen_errores (idop_detalle_prod,exist_prod) VALUES('$idop_detalle_prod','$exist_prod')";
			$idingresonew=ejecutarConsulta_retornarID($sql);

			$sql2="SELECT iderror FROM almacen_errores WHERE iderror='$idingresonew'";
			return ejecutarConsultaSimpleFila($sql2);
		}


		

		

		public function buscar_codigo($codigo)
		{
			$sql="SELECT pc.codigo_match,pc.descripcion,pc.idtipo,pc.idcolor,pc.idtamano,pc.idproductos, (SELECT nombre FROM prod_color WHERE idprod_color=pc.idcolor) as color,(SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as tamano FROM productos_clasif pc WHERE pc.codigo_match='$codigo'";
			return ejecutarConsultaSimpleFila($sql);

		}

		public function consul_exist_alm($codigo)
		{
			$sql="SELECT count(idalmacen_pt) as cant_exist FROM almacen_pt WHERE codigo='$codigo'";
			return ejecutarConsultaSimpleFila($sql);

		}

		public function listar_inventario()
		{
			$sql="SELECT ap.idalmacen_pt,ap.idproducto,ap.tipo,ap.codigo,ap.codigo_alm,ap.nombre,ap.medidas,ap.alto,ap.largo,ap.ancho,ap.color,ap.cantidad,ap.stat, 
			(SELECT IFNULL(sum(cantidad),0) FROM almacen_pt_ed WHERE idalmacen_pt=ap.idalmacen_pt AND movimiento='Entrada') as cant_entrada, 
			(SELECT IFNULL(sum(cantidad),0) FROM almacen_pt_ed WHERE idalmacen_pt=ap.idalmacen_pt AND movimiento='Salida') as cant_salida FROM almacen_pt ap ORDER BY ap.codigo ASC";

			
			return ejecutarConsulta($sql);

		}

		public function descartar_avance($idavance_prod,$comentario,$fecha_hora)
		{
			$sql="UPDATE op_avance_prod SET validado = 1, coment_desc='$comentario',fecha_hora_valid='$fecha_hora' WHERE idavance_prod='$idavance_prod'";
			return ejecutarConsulta($sql);

		}

		public function descartar_excedente($idop_detalle_exc,$comentario,$fecha_hora)
		{
			$sql="UPDATE op_detalle_exc SET validado = 1, comentario='$comentario',fecha_valid='$fecha_hora' WHERE idop_detalle_exc='$idop_detalle_exc'";
			return ejecutarConsulta($sql);

		}

		public function ingresos_almacen_ensamble()
		{

			$sql="SELECT ap.codigo,ap.nombre,ape.movimiento,ape.cantidad,ape.lote,ape.op,ape.control,ape.fecha_hora,ape.comentario,ape.ubicacion FROM almacen_pt_ed ape INNER JOIN almacen_pt ap ON ape.idalmacen_pt=ap.idalmacen_pt WHERE (SELECT area FROM op_avance_prod WHERE idavance_prod=ape.idavance) = 7";
			return ejecutarConsulta($sql);

		}



















		


		public function consultar_produccion_producto()
		{
			
			$sql="SELECT pdp.idproducto,SUM(pd.cantidad) as cant,DAY(pd.fecha_hora2) as dia,MONTH(pd.fecha_hora2) as mes, YEAR(pd.fecha_hora2) AS anio,
			(SELECT idmuebles_fam FROM productos WHERE idproducto=pdp.idproducto) as familia, 
			(SELECT codigo FROM productos WHERE idproducto=pdp.idproducto) as codigo,
			(SELECT nombre FROM productos WHERE idproducto=pdp.idproducto) as nombre,
			(SELECT medida FROM productos WHERE idproducto=pdp.idproducto) as medida 
			FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos WHERE pd.estatus='Fabricado' GROUP BY pdp.idproducto, DAY(pd.fecha_hora2)";

			return ejecutarConsulta($sql);

		}

		public function consultar_produccion()
		{
			$sql="SELECT pd.idpg_detped,pd.cantidad,pdp.idpg_detalle_pedidos,pdp.codigo,pdp.descripcion,pdp.observacion,pdp.medida,pdp.color,pd.estatus,pdp.idproducto,p.idpg_pedidos,p.no_control,p.idusuario, (SELECT fecha_hora2 FROM pg_detped WHERE idpg_detped=pd.idpg_detped) as fecha FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos WHERE pd.estatus='Fabricado'";
			return ejecutarConsulta($sql);

		}

		public function abrir_movimientos()
		{
			
				/*$sql="SELECT s.idsalida,s.no_salida,s.fecha_salida,sr.nombre as nom_repartidor, sv.nombre as nom_vehiculo,s.estatus FROM salidas s INNER JOIN salidas_repartidores sr ON s.idusuario = sr.idrepartidor INNER JOIN salidas_vehiculos sv ON s.idvehiculo=sv.idvehiculo ORDER BY s.fecha_creacion DESC";*/

				$sql="SELECT idsalida,no_salida, fecha_salida FROM salidas WHERE estatus=0 ORDER BY fecha_salida DESC";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);
			
						
		}

		public function abrir_detalle_mov_salida($idsalida)
		{
			
				$sql="SELECT sed.identrega,sed.idproducto, sed.cantidad, sed.idpedido, sed.idsalida,
				(SELECT no_entrega FROM salidas_entregas WHERE identrega=sed.identrega LIMIT 1) as no_salida,
				(SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto) as codigo,
				(SELECT descripcion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto) as descripcion,
				(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=sed.idpedido) as control,

				(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=sed.idproducto AND estatus='Fabricado') as cant_fabricado,
			 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=sed.idproducto AND estatus='Apartado') as cant_apartado,
			 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=sed.idproducto AND estatus='Existencia') as cant_existencia,
			 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=sed.idproducto AND estatus='Produccion') as cant_produccion,
			 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=sed.idproducto AND estatus='Otro') as cant_otro
				 FROM salidas_entregas_detalles sed WHERE sed.idsalida='$idsalida'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);
			
						
		}

		public function listar_lotes_emb($idproducto)
		{

			$sql2="SELECT pdp.idpg_detped,pdp.op
			


			FROM pg_detped pdp WHERE pdp.iddetalle_pedido='$idproducto'";
			return ejecutarConsulta($sql2);
		}
/*IF(pdp.estatus='Produccion' OR pdp.estatus='Fabricado',CONCAT((SELECT lote FROM op_avance_prod WHERE idop_detalle_prod=(SELECT idop_detalle_prod FROM op_detalle_prod odp WHERE odp.idpg_detped=pdp.idpg_detped) ORDER BY LENGTH(lote) DESC LIMIT 1),' (',(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=(SELECT idop_detalle_prod FROM op_detalle_prod odp WHERE odp.idpg_detped=pdp.idpg_detped) ORDER BY LENGTH(lote) DESC LIMIT 1),') '),'') as lote2*/
		public function consul_codigo($iddetalle_pedido)
		{

			$sql="SELECT pdp.codigo, (SELECT idalmacen_pt FROM almacen_pt WHERE idproducto=pdp.idproducto) as idalmacen_pt,pdp.descripcion FROM pg_detalle_pedidos pdp WHERE pdp.idpg_detalle_pedidos='$iddetalle_pedido'";
			return ejecutarConsultaSimpleFila($sql);
		}


		public function lotes_codigo($idalmacen_pt,$idpedido)
		{		

			/*$sql="SELECT DISTINCT ape.lote,ape.op,
			(IF((SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Entrada')>0,
			(SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Entrada'),0)-
			IF((SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Salida')>0,
			(SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Salida'),0)
			) as exist_lote,
			(SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Salida') as cant_lote,
			(SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Entrada') as cant_lote_e,

			(SELECT IFNULL(sum(cantidad),0) FROM presalida WHERE (idalmacen_pt='$idalmacen_pt' AND lote=ape.lote AND estatus=0 AND via_consul=1) OR (idalmacen_pt='$idalmacen_pt' AND lote=ape.lote AND estatus=1 AND via_consul=1)) as cant_presalida,
			(SELECT IFNULL(sum(cantidad),0) FROM presalida WHERE (idalmacen_pt='$idalmacen_pt' AND estatus=0 AND sin_lote=1 AND via_consul=1) OR (idalmacen_pt='$idalmacen_pt' AND estatus=1 AND sin_lote=1 AND via_consul=1)) as cant_presalida_nolote

			FROM almacen_pt_ed ape WHERE ape.idalmacen_pt='$idalmacen_pt' AND ape.movimiento='Entrada' AND ape.control <> (SELECT no_control FROM pg_pedidos WHERE idpg_pedidos='$idpedido') ORDER BY 
			(IF((SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Entrada')>0,
			(SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Entrada'),0)-
			IF((SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Salida')>0,
			(SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Salida'),0)
			) DESC";*/


			$sql="SELECT ap.idalmacen_pt,ap.idproducto,ap.codigo,ap.nombre,ap.cantidad,
				(SELECT IFNULL(sum(cantidad),0) FROM almacen_pt_ed WHERE idalmacen_pt=ap.idalmacen_pt AND movimiento='Entrada') as cant_entrada, 
				(SELECT IFNULL(sum(cantidad),0) FROM almacen_pt_ed WHERE idalmacen_pt=ap.idalmacen_pt AND movimiento='Salida') as cant_salida,
				(SELECT IFNULL(sum(cantidad),0) FROM presalida WHERE (idalmacen_pt='$idalmacen_pt' AND estatus=0 AND via_consul=1)) as cant_presalida
				FROM almacen_pt ap WHERE ap.idalmacen_pt='$idalmacen_pt'";

			return ejecutarConsulta($sql);
		}

		public function lotes_codigo_idpedido($idalmacen_pt,$idpedido)
		{		

			$sql="SELECT DISTINCT ape.lote,ape.op,
			(IF((SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Entrada')>0,
			(SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Entrada'),0)-
			IF((SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Salida')>0,
			(SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Salida'),0)
			) as exist_lote,
			(SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Salida') as cant_lote,
			(SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Entrada') as cant_lote_e,

			(SELECT IFNULL(sum(cantidad),0) FROM presalida WHERE (idalmacen_pt='$idalmacen_pt' AND lote=ape.lote AND estatus=0 AND via_consul=1) OR (idalmacen_pt='$idalmacen_pt' AND lote=ape.lote AND estatus=1 AND via_consul=1)) as cant_presalida,
			(SELECT IFNULL(sum(cantidad),0) FROM presalida WHERE (idalmacen_pt='$idalmacen_pt' AND estatus=0 AND sin_lote=1 AND via_consul=1) OR (idalmacen_pt='$idalmacen_pt' AND estatus=1 AND sin_lote=1 AND via_consul=1)) as cant_presalida_nolote

			FROM almacen_pt_ed ape WHERE ape.idalmacen_pt='$idalmacen_pt' AND ape.movimiento='Entrada' AND ape.control = (SELECT no_control FROM pg_pedidos WHERE idpg_pedidos='$idpedido') 
			ORDER BY (IF((SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Entrada')>0,
			(SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Entrada'),0)-
			IF((SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Salida')>0,
			(SELECT sum(cantidad) FROM almacen_pt_ed WHERE lote=ape.lote AND idalmacen_pt='$idalmacen_pt' AND movimiento='Salida'),0)
			) DESC";

			return ejecutarConsulta($sql);
		}



		public function consul_cant_presalida($iddetalle_ped,$identrega)
		{

			$sql="SELECT IFNULL(SUM(cantidad),0) as cant_presalida_c FROM presalida WHERE iddetalle_pedido='$iddetalle_ped' AND identrega='$identrega' AND via_consul=1";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function consul_cant_presalida_vale($iddetalle_ped,$identrega)
		{

			$sql="SELECT IFNULL(SUM(cantidad),0) as cant_presalida_c FROM presalida WHERE iddetalle_pedido='$iddetalle_ped' AND identrega='$identrega' AND via_consul=1";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function consul_idalmacen_pt($codigo_consul_exist)
		{

			$sql="SELECT idalmacen_pt FROM almacen_pt WHERE codigo='$codigo_consul_exist'";
			return ejecutarConsultaSimpleFila($sql);
		}


		public function guardar_presalida($idalmacen_pt,$iddetalle_pedido,$identrega,$lote,$cantidad,$idpedido,$sin_lote,$op)
		{

			$sql="INSERT INTO presalida (idalmacen_pt,iddetalle_pedido,identrega,cantidad,lote,idpedido,sin_lote,op) VALUES ('$idalmacen_pt','$iddetalle_pedido','$identrega','$cantidad','$lote','$idpedido','$sin_lote','$op')";
			return ejecutarConsulta($sql);
		}

		public function guardar_presalida_vale($idalmacen_pt,$iddetalle_pedido,$identrega,$lote,$cantidad,$idpedido,$sin_lote,$op)
		{

			$sql="INSERT INTO presalida (idalmacen_pt,iddetalle_pedido,identrega,cantidad,lote,idpedido,sin_lote,op,via_consul) VALUES ('$idalmacen_pt','$iddetalle_pedido','$identrega','$cantidad','$lote','$idpedido','$sin_lote','$op','1')";
			return ejecutarConsulta($sql);
		}

		public function listar_prelista($idalmacen_pt,$identrega)
		{

			$sql="SELECT * FROM presalida WHERE identrega='$identrega' AND idalmacen_pt='$idalmacen_pt'";
			return ejecutarConsulta($sql);
		}

		public function listar_prelista_vale($idalmacen_pt,$identrega)
		{

			$sql="SELECT * FROM presalida WHERE identrega='$identrega' AND idalmacen_pt='$idalmacen_pt' AND via_consul=1";
			return ejecutarConsulta($sql);
		}

		public function borrar_presalida($idpresalida)
		{

			$sql="DELETE FROM presalida WHERE idpresalida='$idpresalida' AND estatus=0";
			return ejecutarConsulta($sql);
		}

		public function consul_exist_lote($idalmacen_pt,$lote)
		{

			$sql="SELECT count(lote) as num_lote FROM almacen_pt_ed WHERE idalmacen_pt='$idalmacen_pt' AND lote='$lote'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function consul_presalida($idalmacen_pt,$identrega,$idpedido)
		{

			$sql="SELECT idpresalida,idalmacen_pt,iddetalle_pedido,identrega,cantidad,lote,idpedido,estatus,sin_lote,op,via_consul, (SELECT nombre FROM almacen_pt WHERE idalmacen_pt='$idalmacen_pt') as nom_prod FROM presalida WHERE idalmacen_pt='$idalmacen_pt' AND identrega='$identrega' AND idpedido='$idpedido' AND via_consul=1";
			return ejecutarConsulta($sql);
		}

		

		public function listar_op($iddetalle_pedido)
		{

			$sql="SELECT op FROM pg_detped WHERE iddetalle_pedido='$iddetalle_pedido' AND op<>''";
			return ejecutarConsulta($sql);
		}


		public function listar_comp_prod($iddetalle_ped)
		{

			$sql="SELECT (SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$iddetalle_ped') as codigo, cantidad, op, estatus FROM pg_detped WHERE iddetalle_pedido='$iddetalle_ped'";
			return ejecutarConsulta($sql);
		}

		public function listar_vales_alm($estatus)
		{
			

			if ($estatus==5) {
				
				$sql="SELECT idvales_almacen,no_vale, fecha_hora_reg, fecha_hora_solic, estatus,prioridad,motivo,fecha_hora_rech FROM vales_almacen WHERE estatus >0 AND estatus <= '$estatus'+1 ORDER BY fecha_hora_solic DESC";
				return ejecutarConsulta($sql);
			}elseif ($estatus<>5) {
				$sql="SELECT idvales_almacen,no_vale, fecha_hora_reg, fecha_hora_solic, estatus,prioridad,motivo,fecha_hora_rech FROM vales_almacen WHERE estatus = '$estatus' ORDER BY fecha_hora_solic DESC";
				return ejecutarConsulta($sql);
			}
		}

		public function listar_vale($id)
		{
			$sql="SELECT v.cantidad,v.control,v.idvale_salida,v.idvales_almacen,v.op,v.lote,v.ubicacion,v.idalmacen_pt,v.estatus,v.motivo_rechazo,v.idpg_detped,
			(SELECT no_vale FROM vales_almacen WHERE idvales_almacen=v.idvales_almacen) as no_vale,
			(SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as codigo,
			(SELECT descripcion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as descripcion,
			(SELECT nombre FROM almacen_pt WHERE idalmacen_pt=v.idalmacen_pt) as nombre,
			(SELECT codigo FROM almacen_pt WHERE idalmacen_pt=v.idalmacen_pt) as codigo_alm,
			(SELECT color FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as color,
			(SELECT medida FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as medida
			 FROM vale_salida v WHERE v.idvales_almacen='$id'";
			return ejecutarConsulta($sql);
		}

		public function consul_prod_vale($idvale_salida)
		{
			$sql="SELECT v.cantidad,v.iddetalle_pedido,v.idalmacen_pt,v.control,
			(SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as codigo,
			(SELECT descripcion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as descripcion,
			(SELECT medida FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as medida,
			(SELECT color FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as color,
			(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as idpedido,
			(SELECT observacion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as observ,
			(SELECT empaque FROM pg_pedidos WHERE no_control = v.control) as empaque
			FROM vale_salida v WHERE v.idvale_salida='$idvale_salida'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function listar_lotes_alm($idvale_salida)
		{
			$sql="SELECT lote,cantidad,op FROM presalida WHERE identrega='$idvale_salida' AND via_consul=1";
			return ejecutarConsulta($sql);
		}

		public function sum_prelista($idalmacen_pt,$identrega,$idpedido)
		{
			$sql="SELECT sum(cantidad) as sum_cant FROM presalida WHERE idalmacen_pt='$idalmacen_pt' AND via_consul=1 AND identrega='$identrega' AND idpedido='$idpedido'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function notif_surtido($idvales_almacen,$fecha_hora)
		{
			$sql="UPDATE vales_almacen SET estatus=2,fecha_hora_surt='$fecha_hora' WHERE idvales_almacen='$idvales_almacen'";
			return ejecutarConsulta($sql);
		}

		public function consul_surtido_tot($idvales_almacen)
		{
			$sql = "SELECT count(idvale_salida) as num_estat FROM vale_salida WHERE idvales_almacen='$idvales_almacen' AND estatus=0";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function notif_rechazo($idvales_almacen,$fecha_hora,$motivo)
		{
			$sql = "UPDATE vales_almacen SET estatus=6,fecha_hora_rech='$fecha_hora',motivo='$motivo' WHERE idvales_almacen='$idvales_almacen'";
			return ejecutarConsulta($sql);
		}

		public function rechazar_producto($idvale_salida,$motivo,$idpg_detped)
		{
			$sql = "UPDATE pg_detped SET estatus='' WHERE idpg_detped='$idpg_detped'";
			ejecutarConsulta($sql);

			$sql_2 = "UPDATE vale_salida SET estatus=2,motivo_rechazo='$motivo' WHERE idvale_salida='$idvale_salida'";
			return ejecutarConsulta($sql_2);
		}

		public function borrar_registro($idalmacen_pt_ed)
		{
			$sql = "DELETE FROM almacen_pt_ed WHERE idalmacen_pt_ed='$idalmacen_pt_ed'";
			return ejecutarConsulta($sql);
		}


 	}

?>