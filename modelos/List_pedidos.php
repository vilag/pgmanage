<?php
 	require "../config/Conexion.php";

 	Class List_pedidos
 	{
 		public function __construct()
		{

		}

		public function listar_pedidos_v2($estatus,$idusuario,$lugar)
		{
			$cant_ini = 0;
			//$estatus_2 = '';

			if ($estatus==0) {
				$estatus = "";
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==1) {
				$estatus = 'AND p.estatus<>"ENTREGADO"';
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==2) {
				$estatus = 'AND p.estatus="LISTO PARA ENTREGA"';
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==3) {
				$estatus = 'AND p.estatus="ENTREGADO"';
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==4) {
				$estatus = 'AND p.estatus="PENDIENTE"';
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==5) {
				$estatus = "";
				$estatus_2 = 'AND p.estatus="CANCELADO"';
			}

			if ($lugar=='Fabrica') {
				
				$sql="SELECT p.coment_vencim,p.tipo, p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.observaciones,
				(SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'Autorizacion de entrega sin factura o recibo') as docs,
				(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod 
				FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2=1 $estatus $estatus_2 ORDER BY p.fecha_pedido desc";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);

			}elseif ($lugar<>'Fabrica') {

				$sql="SELECT p.coment_vencim,p.tipo, p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'Autorizacion de entrega sin factura o recibo') as docs,p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2=1 $estatus $estatus_2 AND u.lugar='$lugar' ORDER BY p.fecha_pedido desc";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);

				if ($lugar=='Ventas Alterno') {

					$sql="SELECT p.coment_vencim,p.tipo, p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.observaciones,
					(SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'Autorizacion de entrega sin factura o recibo') as docs,
					(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod 
					FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2=1 AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' ORDER BY p.fecha_pedido desc";
					//return ejecutarConsultaSimpleFila($sql);
					return ejecutarConsulta($sql);
					# code...
				}
				
			}

							
		}

		public function listar_pedidos_v2_consul($lugar,$valor_consulta,$nombre_cliente,$fecha1_consul,$fecha2_consul)
		{

			if ($valor_consulta==1) {
				

				if ($lugar=='Fabrica') {
					
					$sql="SELECT p.coment_vencim,p.tipo, p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'Autorizacion de entrega sin factura o recibo') as docs,p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2=1 AND DATE(p.fecha_pedido)>='$fecha1_consul' AND DATE(p.fecha_pedido)<='$fecha2_consul' ORDER BY p.fecha_pedido desc";
					//return ejecutarConsultaSimpleFila($sql);
					return ejecutarConsulta($sql);

				}elseif ($lugar<>'Fabrica') {

					$sql="SELECT p.coment_vencim,p.tipo, p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'Autorizacion de entrega sin factura o recibo') as docs,p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2=1 AND DATE(p.fecha_pedido)>='$fecha1_consul' AND DATE(p.fecha_pedido)<='$fecha2_consul' AND u.lugar='$lugar' ORDER BY p.fecha_pedido desc";
					//return ejecutarConsultaSimpleFila($sql);
					return ejecutarConsulta($sql);

					if ($lugar=='Ventas Alterno') {
						$sql="SELECT p.coment_vencim,p.tipo, p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'Autorizacion de entrega sin factura o recibo') as docs,p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2=1 AND DATE(p.fecha_pedido)>='$fecha1_consul' AND DATE(p.fecha_pedido)<='$fecha2_consul' ORDER BY p.fecha_pedido desc";
						//return ejecutarConsultaSimpleFila($sql);
						return ejecutarConsulta($sql);
						# code...
					}
					
				}


			}elseif ($valor_consulta==2) {
				

				if ($lugar=='Fabrica') {
					
					$sql="SELECT p.coment_vencim,p.tipo, p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'Autorizacion de entrega sin factura o recibo') as docs,p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2=1 AND c.nombre LIKE '%".$nombre_cliente."%'  ORDER BY p.fecha_pedido desc";
					//return ejecutarConsultaSimpleFila($sql);
					return ejecutarConsulta($sql);

				}elseif ($lugar<>'Fabrica') {

					$sql="SELECT p.coment_vencim,p.tipo, p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'Autorizacion de entrega sin factura o recibo') as docs,p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2=1 AND u.lugar='$lugar' AND c.nombre LIKE '%".$nombre_cliente."%' ORDER BY p.fecha_pedido desc";
					//return ejecutarConsultaSimpleFila($sql);
					return ejecutarConsulta($sql);
					
				}

			}
			

				

							
		}

		public function buscar_pedido($idpg_pedidos)
		{

			$sql="SELECT c.nombre as nom_cliente, p.tipo, u.lugar,p.no_control,p.no_pedido,dfe.razon_fac ,dfe.calle_fac,dfe.rfc_fac,dfe.numero_fac,dfe.interior_fac,dfe.colonia_fac,dfe.ciudad_fac,dfe.estado_fac,dfe.cp_fac,dfe.telefono_fac,dfe.email_fac,dee.contacto_ent,dee.calle_ent,dee.numero_ent,dee.interior_ent,dee.colonia_ent,dee.ciudad_ent,dee.estado_ent,dee.cp_ent,dee.telefono_ent,dee.email_ent,dee.fecha_entrega_ent,dee.hora_entrega_r1,dee.hora_entrega_r2,dee.forma_entrega_ent,dee.det_forma_entrega,dee.referencia_ent,p.asesor,p.levanto_pedido,p.empaque,p.metodo_pago,p.uso_cfdi,p.lab,p.medio,p.salida,p.factura,p.otros,p.reglamentos,p.fecha_pedido,p.estatus,p.porc_av,p.coment_vencim,p.observaciones,DATE(p.fecha_ent_cliente) as fecha_ent_cliente
			FROM pg_pedidos p 
			INNER JOIN clientes c ON p.idcliente = c.idcliente
			INNER JOIN usuario u ON p.idusuario=u.idusuario
			INNER JOIN dir_facturacion_esp dfe ON p.idpg_pedidos=dfe.idpedido
			INNER JOIN dir_entregas_esp dee ON p.idpg_pedidos=dee.idpedido
			 WHERE p.idpg_pedidos='$idpg_pedidos'";
			//return ejecutarConsultaSimpleFila($sql);
			return ejecutarConsultaSimpleFila($sql);			
		}

		public function buscar_pedido_ini($lugar,$estatus)
		{

			if ($estatus==0) {
				$estatus = "";
				$estatus_2 = 'p.estatus<>"CANCELADO"';
			}elseif ($estatus==1) {
				$estatus = 'p.estatus<>"ENTREGADO"';
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==2) {
				$estatus = 'p.estatus="LISTO PARA ENTREGA"';
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==3) {
				$estatus = 'p.estatus="ENTREGADO"';
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==4) {
				$estatus = 'p.estatus="PENDIENTE"';
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==5) {
				$estatus = "";
				$estatus_2 = 'p.estatus="CANCELADO"';
			}


			if ($lugar=="Fabrica") {
				
				$sql="SELECT p.idpg_pedidos FROM pg_pedidos p WHERE $estatus $estatus_2 ORDER BY p.fecha_pedido DESC LIMIT 1";
				return ejecutarConsultaSimpleFila($sql);
			}elseif ($lugar<>"Fabrica") {
				$sql="SELECT p.idpg_pedidos FROM pg_pedidos p INNER JOIN usuario u ON p.idusuario=u.idusuario WHERE $estatus $estatus_2 AND u.lugar='$lugar' ORDER BY p.fecha_pedido DESC LIMIT 1";
				return ejecutarConsultaSimpleFila($sql);
			}


				

		}


		public function listar_documentos($id)
		{

		$sql="SELECT * FROM documentos WHERE idpedido='$id' AND nombre<>'Autorizacion de entrega sin factura o recibo' ORDER BY nombre ASC";
		return ejecutarConsulta($sql);

		}

		public function listar_pedido_detalle_term($id)
		{			
			 

			  $sql="SELECT pdp.idpg_detalle_pedidos,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.cantidad,(pdp.cantidad-(SELECT IFNULL(SUM(cantidad),0) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos)) as pendiente, pdp.check_entrega,pdp.observacion,
			 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Fabricado') as cant_fabricado,
			 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Surtido') as cant_surtido,
			 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Apartado') as cant_apartado,
			 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Existencia') as cant_existencia,
			 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Produccion') as cant_produccion,
			 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Otro') as cant_otro,
			 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Cancelado') as cant_canc,
				(SELECT IFNULL(SUM(cantidad),0) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos) as cantidad_entre
				
			  FROM pg_detalle_pedidos pdp  WHERE pdp.idpg_pedidos='$id'";
	        return ejecutarConsulta($sql); 			
		}


		public function listar_op($idpg_detalle_pedidos)
		{

			$sql="SELECT op FROM pg_detped WHERE (iddetalle_pedido='$idpg_detalle_pedidos' AND estatus='Produccion') OR (iddetalle_pedido='$idpg_detalle_pedidos' AND estatus='Fabricado')";
			//return ejecutarConsultaSimpleFila($sql);
			return ejecutarConsulta($sql);

		}

		public function listar_vales($idpg_detalle_pedidos)
		{

			$sql="SELECT no_vale FROM vales_almacen WHERE idvales_almacen=(SELECT idvales_almacen FROM vale_salida WHERE iddetalle_pedido='$idpg_detalle_pedidos' AND estatus<2 LIMIT 1)";
			//return ejecutarConsultaSimpleFila($sql);
			return ejecutarConsulta($sql);

		}

		public function update_observ($id_ped_temp,$observ)
		{

		$sql="UPDATE pg_pedidos SET observaciones='$observ' WHERE idpg_pedidos='$id_ped_temp'  ";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
		}

		public function listar_pg_detped($id)
		{
		$sql="SELECT pd.idpg_detped,pp.codigo,pd.cantidad,pd.op,pd.estatus,pp.observacion,pd.observ_enlace,pd.iddetalle_pedido, pp.idpg_pedidos,pd.guardado,pd.coment FROM pg_detped pd INNER JOIN pg_detalle_pedidos pp ON pd.iddetalle_pedido=pp.idpg_detalle_pedidos WHERE pd.iddetalle_pedido='$id'";
		return ejecutarConsulta($sql);
		}

		public function set_nosave($idpg_detped)
		{
		$sql="UPDATE pg_detped SET guardado = 0 WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsulta($sql);
		}

		public function dividir_prod_ped($idpg_detalle_pedidos,$cant_div)
		{
		$sql="INSERT INTO pg_detped (iddetalle_pedido,idproducto,cantidad,op) SELECT '$idpg_detalle_pedidos',idproducto,'$cant_div','' FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
		return ejecutarConsulta($sql);
		}

		public function consul_datos_prod($idpg_detalle_pedidos)
		{
		$sql="SELECT pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.cantidad, (SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos) as no_control FROM pg_detalle_pedidos pdp  WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
		return ejecutarConsultaSimpleFila($sql);
		}

		public function guardar_estatus1($idpg_detped,$estatus,$fecha_hora,$id_ped_temp)
		{
			$sql2="UPDATE pg_detalle_pedidos SET estatus='$estatus' WHERE idpg_detalle_pedidos=(SELECT iddetalle_pedido FROM pg_detped WHERE idpg_detped='$idpg_detped')";
			ejecutarConsulta($sql2);

			$sql="UPDATE pg_detped SET estatus='$estatus',fecha_hora='$fecha_hora',idpedido='$id_ped_temp' WHERE idpg_detped='$idpg_detped'";
			return ejecutarConsulta($sql);
		}

		public function abrir_terminados()
		{

			/*$sql="SELECT p.no_control,p.idpg_pedidos, p.fecha_valid_term as fecha_entrega,
			(SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'' AND tipo='1') as num_docs,
			(SELECT nombre FROM clientes WHERE idcliente=p.idcliente) as nom_cliente,

			

			(SELECT IFNULL(sum(cantidad),0) FROM salidas_entregas_detalles WHERE idpedido=p.idpg_pedidos) as cant_entrega,
			(SELECT IFNULL(sum(cantidad),0) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as cant_pendiente
			FROM pg_pedidos p WHERE p.cant_est >= (SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' AND p.no_control<>1646 ORDER BY p.estatus_docs DESC";*/

			$sql="SELECT * FROM result_tbl_term ORDER BY estatus_docs DESC";
			return ejecutarConsulta($sql);

		}

/*(SELECT pdp.fecha_hora2 FROM pg_detped pdp WHERE (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pdp.iddetalle_pedido LIMIT 1) = p.idpg_pedidos ORDER BY pdp.fecha_hora2 DESC LIMIT 1) as fecha_entrega_fab,
			(SELECT pdp.fecha_hora FROM pg_detped pdp WHERE (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pdp.iddetalle_pedido LIMIT 1) = p.idpg_pedidos ORDER BY pdp.fecha_hora DESC LIMIT 1) as fecha_entrega_set,*/
		public function pedidos_vencidos($id)
		{

			if ($id==0) {

				$sql="SELECT p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs,p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,p.coment_vencim FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2='1' AND DATEDIFF(DATE(p.fecha_entrega),NOW())<0 AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' ORDER BY p.idpg_pedidos ASC, p.coment_vencim asc";
				return ejecutarConsulta($sql);
				# code...
			}elseif ($id==1) {
				$sql="SELECT p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs,p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,p.coment_vencim FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2='1' AND DATEDIFF(DATE(p.fecha_entrega),NOW())<0 AND p.estatus='ENTREGADO' AND p.estatus<>'CANCELADO' ORDER BY p.idpg_pedidos ASC, p.coment_vencim asc";
				return ejecutarConsulta($sql);
			}

						
		}

		public function contar_pedidos($lugar,$estatus)
		{

			if ($estatus==0) {
				$estatus = "";
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==1) {
				$estatus = 'AND p.estatus<>"ENTREGADO"';
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==2) {
				$estatus = 'AND p.estatus="LISTO PARA ENTREGA"';
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==3) {
				$estatus = 'AND p.estatus="ENTREGADO"';
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==4) {
				$estatus = 'AND p.estatus="PENDIENTE"';
				$estatus_2 = 'AND p.estatus<>"CANCELADO"';
			}elseif ($estatus==5) {
				$estatus = "";
				$estatus_2 = 'AND p.estatus="CANCELADO"';
			}

			if ($lugar=="Fabrica") {
				
				$sql="SELECT count(p.idpg_pedidos) as num_pedidos FROM pg_pedidos p INNER JOIN usuario u ON p.idusuario=u.idusuario WHERE p.estatus2=1 $estatus $estatus_2";
				return ejecutarConsultaSimpleFila($sql);

			}elseif ($lugar<>"Fabrica") {
				
				$sql="SELECT count(p.idpg_pedidos) as num_pedidos FROM pg_pedidos p INNER JOIN usuario u ON p.idusuario=u.idusuario WHERE p.estatus2=1 $estatus $estatus_2 AND u.lugar='$lugar'";
				return ejecutarConsultaSimpleFila($sql);

			}

				
		}


		public function buscar_idpg_pedidos($input_buscar)
		{
		$sql="SELECT idpg_pedidos,(SELECT lugar FROM usuario WHERE idusuario=p.idusuario) as lugar FROM pg_pedidos p WHERE p.no_control='$input_buscar'";
		return ejecutarConsultaSimpleFila($sql);
		}

		public function listar_chat($idpedido)
		{
		$sql="SELECT c.idpedido,c.idusuario,c.mensaje,c.fecha_hora,u.nombre FROM chat c INNER JOIN usuario u ON c.idusuario=u.idusuario WHERE idpedido='$idpedido' ORDER BY fecha_hora ASC";
		return ejecutarConsulta($sql);
		}

		public function guardar_mensaje_chat($idpedido,$idusuario,$text_chat,$fecha_hora,$lugar)
		{
			if ($lugar=='Fabrica') {
				
				$sql="INSERT INTO chat(idpedido,idusuario,mensaje,fecha_hora,
				orel,orel_rev,
				ana,ana_rev,
				adriana,adriana_rev,
				claudia,claudia_rev,
				angelina,angelina_rev,
				ajm,ajm_rev,
				direccion,direccion_rev,
				arturo,arturo_rev,
				juancarlos,juancarlos_rev,
				gladys,gladys_rev,
				leonardo,leonardo_rev,
				fernando,fernando_rev,
				martha,martha_rev) 
				VALUES('$idpedido','$idusuario','$text_chat','$fecha_hora',
				'1','1',
				'0','0',
				'0','0',
				'4','1',
				'5','1',
				'0','0',
				'7','1',
				'8','1',
				'9','1',
				'10','1',
				'11','1',
				'12','1',
				'14','1')";
				return ejecutarConsulta($sql);
			}elseif ($lugar=='Zuno') {
				
				$sql="INSERT INTO chat(idpedido,idusuario,mensaje,fecha_hora,
				orel,orel_rev,
				ana,ana_rev,
				adriana,adriana_rev,
				claudia,claudia_rev,
				angelina,angelina_rev,
				ajm,ajm_rev,
				direccion,direccion_rev,
				arturo,arturo_rev,
				juancarlos,juancarlos_rev,
				gladys,gladys_rev,
				leonardo,leonardo_rev,
				fernando,fernando_rev,
				martha,martha_rev) 
				VALUES('$idpedido','$idusuario','$text_chat','$fecha_hora',
				'1','1',
				'2','1',
				'3','1',
				'4','1',
				'5','1',
				'0','0',
				'7','1',
				'8','1',
				'9','1',
				'10','1',
				'11','1',
				'12','1',
				'14','1')";
				return ejecutarConsulta($sql);

			}elseif ($lugar=='AJM') {
				
				$sql="INSERT INTO chat(idpedido,idusuario,mensaje,fecha_hora,
				orel,orel_rev,
				ana,ana_rev,
				adriana,adriana_rev,
				claudia,claudia_rev,
				angelina,angelina_rev,
				ajm,ajm_rev,
				direccion,direccion_rev,
				arturo,arturo_rev,
				juancarlos,juancarlos_rev,
				gladys,gladys_rev,
				leonardo,leonardo_rev,
				fernando,fernando_rev,
				martha,martha_rev) 
				VALUES('$idpedido','$idusuario','$text_chat','$fecha_hora',
				'1','1',
				'0','0',
				'0','0',
				'4','1',
				'5','1',
				'6','1',
				'7','1',
				'8','1',
				'9','1',
				'10','1',
				'11','1',
				'12','1',
				'14','1')";
				return ejecutarConsulta($sql);

			}
				
		return ejecutarConsulta($sql);
		}

		public function buscar_control($idpedido)
		{
			$sql="SELECT no_control FROM pg_pedidos WHERE idpg_pedidos='$idpedido'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function contar_mensajes($idusuario)
		{

			if ($idusuario==1) {
				$sql="SELECT count(DISTINCT(idpedido)) as num_mensajes FROM chat WHERE orel='$idusuario' AND orel_rev=1";
				return ejecutarConsultaSimpleFila($sql);
			}
			if ($idusuario==2) {
				$sql="SELECT count(DISTINCT(idpedido)) as num_mensajes FROM chat WHERE ana='$idusuario' AND ana_rev=1";
				return ejecutarConsultaSimpleFila($sql);
			}
			if ($idusuario==3) {
				$sql="SELECT count(DISTINCT(idpedido)) as num_mensajes FROM chat WHERE adriana='$idusuario' AND adriana_rev=1";
				return ejecutarConsultaSimpleFila($sql);
			}
			if ($idusuario==4) {
				$sql="SELECT count(DISTINCT(idpedido)) as num_mensajes FROM chat WHERE claudia='$idusuario' AND claudia_rev=1";
				return ejecutarConsultaSimpleFila($sql);
			}
			if ($idusuario==5) {
				$sql="SELECT count(DISTINCT(idpedido)) as num_mensajes FROM chat WHERE angelina='$idusuario' AND angelina_rev=1";
				return ejecutarConsultaSimpleFila($sql);
			}
			if ($idusuario==6) {
				$sql="SELECT count(DISTINCT(idpedido)) as num_mensajes FROM chat WHERE ajm='$idusuario' AND ajm_rev=1";
				return ejecutarConsultaSimpleFila($sql);
			}
			if ($idusuario==7) {
				$sql="SELECT count(DISTINCT(idpedido)) as num_mensajes FROM chat WHERE direccion='$idusuario' AND direccion_rev=1";
				return ejecutarConsultaSimpleFila($sql);
			}
			if ($idusuario==8) {
				$sql="SELECT count(DISTINCT(idpedido)) as num_mensajes FROM chat WHERE arturo='$idusuario' AND arturo_rev=1";
				return ejecutarConsultaSimpleFila($sql);
			}
			if ($idusuario==9) {
				$sql="SELECT count(DISTINCT(idpedido)) as num_mensajes FROM chat WHERE juancarlos='$idusuario' AND juancarlos_rev=1";
				return ejecutarConsultaSimpleFila($sql);
			}
			if ($idusuario==10) {
				$sql="SELECT count(DISTINCT(idpedido)) as num_mensajes FROM chat WHERE gladys='$idusuario' AND gladys_rev=1";
				return ejecutarConsultaSimpleFila($sql);
			}
			if ($idusuario==11) {
				$sql="SELECT count(DISTINCT(idpedido)) as num_mensajes FROM chat WHERE leonardo='$idusuario' AND leonardo_rev=1";
				return ejecutarConsultaSimpleFila($sql);
			}
			if ($idusuario==12) {
				$sql="SELECT count(DISTINCT(idpedido)) as num_mensajes FROM chat WHERE fernando='$idusuario' AND fernando_rev=1";
				return ejecutarConsultaSimpleFila($sql);
			}
			if ($idusuario==14) {
				$sql="SELECT count(DISTINCT(idpedido)) as num_mensajes FROM chat WHERE martha='$idusuario' AND martha_rev=1";
				return ejecutarConsultaSimpleFila($sql);
			}




				
		}

		public function listar_controles_mensajes($idusuario)
		{

			if ($idusuario==1) {
				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.orel='$idusuario' AND c.orel_rev=1";
				return ejecutarConsulta($sql);
			}
			if ($idusuario==2) {
				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.ana='$idusuario' AND c.ana_rev=1";
				return ejecutarConsulta($sql);
				
			}
			if ($idusuario==3) {
				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.adriana='$idusuario' AND c.adriana_rev=1";
				return ejecutarConsulta($sql);
				
			}
			if ($idusuario==4) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.claudia='$idusuario' AND c.claudia_rev=1";
				return ejecutarConsulta($sql);

			}
			if ($idusuario==5) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.angelina='$idusuario' AND c.angelina_rev=1";
				return ejecutarConsulta($sql);

			}
			if ($idusuario==6) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.ajm='$idusuario' AND c.ajm_rev=1";
				return ejecutarConsulta($sql);

			}
			if ($idusuario==7) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.direccion='$idusuario' AND c.direccion_rev=1";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==8) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.arturo='$idusuario' AND c.arturo_rev=1";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==9) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.juancarlos='$idusuario' AND c.juancarlos_rev=1";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==10) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.gladys='$idusuario' AND c.gladys_rev=1";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==11) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.leonardo='$idusuario' AND c.leonardo_rev=1";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==12) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.fernando='$idusuario' AND c.fernando_rev=1";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==14) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.martha='$idusuario' AND c.martha_rev=1";
				return ejecutarConsulta($sql);

				
			}




				
		}
		
		public function quitar_notif_control($idpedido,$idusuario)
		{


			if ($idusuario==1) {
				$sql="UPDATE chat SET orel_rev=0 WHERE idpedido='$idpedido' AND orel='$idusuario'";
				return ejecutarConsulta($sql);
			}
			if ($idusuario==2) {
				$sql="UPDATE chat SET ana_rev=0 WHERE idpedido='$idpedido' AND ana='$idusuario'";
				return ejecutarConsulta($sql);
				
			}
			if ($idusuario==3) {
				$sql="UPDATE chat SET adriana_rev=0 WHERE idpedido='$idpedido' AND adriana='$idusuario'";
				return ejecutarConsulta($sql);
				
			}
			if ($idusuario==4) {

				$sql="UPDATE chat SET claudia_rev=0 WHERE idpedido='$idpedido' AND claudia='$idusuario'";
				return ejecutarConsulta($sql);

			}
			if ($idusuario==5) {

				$sql="UPDATE chat SET angelina_rev=0 WHERE idpedido='$idpedido' AND angelina='$idusuario'";
				return ejecutarConsulta($sql);

			}
			if ($idusuario==6) {

				$sql="UPDATE chat SET ajm_rev=0 WHERE idpedido='$idpedido' AND ajm='$idusuario'";
				return ejecutarConsulta($sql);

			}
			if ($idusuario==7) {

				$sql="UPDATE chat SET direccion_rev=0 WHERE idpedido='$idpedido' AND direccion='$idusuario'";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==8) {

				$sql="UPDATE chat SET arturo_rev=0 WHERE idpedido='$idpedido' AND arturo='$idusuario'";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==9) {

				$sql="UPDATE chat SET juancarlos_rev=0 WHERE idpedido='$idpedido' AND juancarlos='$idusuario'";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==10) {

				$sql="UPDATE chat SET gladys_rev=0 WHERE idpedido='$idpedido' AND gladys='$idusuario'";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==11) {

				$sql="UPDATE chat SET leonardo_rev=0 WHERE idpedido='$idpedido' AND leonardo='$idusuario'";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==12) {

				$sql="UPDATE chat SET fernando_rev=0 WHERE idpedido='$idpedido' AND fernando='$idusuario'";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==14) {

				$sql="UPDATE chat SET martha_rev=0 WHERE idpedido='$idpedido' AND martha='$idusuario'";
				return ejecutarConsulta($sql);

				
			}



				
		}


		public function consul_lugar_pedido($idpedido)
		{
		$sql="SELECT u.lugar FROM pg_pedidos p INNER JOIN usuario u ON p.idusuario=u.idusuario WHERE p.idpg_pedidos='$idpedido'";
		return ejecutarConsultaSimpleFila($sql);
		}

		public function abrir_doc_salidas($idpg_pedidos)
		{
		$sql="SELECT se.identrega,se.no_entrega,
		(SELECT DATE(fecha_salida) FROM salidas WHERE idsalida=se.idsalida) as fecha_salida,
		(SELECT no_salida FROM salidas WHERE idsalida=se.idsalida) as no_salida
		FROM salidas_entregas se WHERE se.idpedido='$idpg_pedidos'";
		return ejecutarConsulta($sql);
		}

		public function consul_no_vale()
		{
		$sql="SELECT IFNULL(max(no_vale),0) as no_vale FROM vales_almacen";
		return ejecutarConsultaSimpleFila($sql);
		}

		public function guardar_vale($no_vale,$fecha_hora,$idusuario)
		{
			$sql="INSERT INTO vales_almacen (no_vale,fecha_hora_reg,idusuario) VALUES ('$no_vale','$fecha_hora','$idusuario')";
			$idingresonew=ejecutarConsulta_retornarID($sql);

			$sql_id="SELECT * FROM vales_almacen WHERE idvales_almacen='$idingresonew'";
	        return ejecutarConsultaSimpleFila($sql_id);
		}

		public function consul_idalmacen_pt($iddetalle_pedido)
		{
		$sql="SELECT 
		(SELECT idalmacen_pt FROM almacen_pt WHERE idproducto=pdp.idproducto) as idalmacen_pt,
		(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos) as no_control
		 FROM pg_detalle_pedidos pdp WHERE pdp.idpg_detalle_pedidos='$iddetalle_pedido' ";
			return ejecutarConsultaSimpleFila($sql);
		}


		public function guardar_prod_vale($idvales_almacen,$idalmacen_pt,$iddetalle_pedido,$cantidad_dividir,$no_control,$idpg_detped)
		{
			$sql="INSERT INTO vale_salida (idvales_almacen,idalmacen_pt,iddetalle_pedido,cantidad,control,idpg_detped) VALUES('$idvales_almacen','$idalmacen_pt','$iddetalle_pedido','$cantidad_dividir','$no_control','$idpg_detped')";
			return ejecutarConsulta($sql);
		}

		public function listar_vale($id)
		{
			$sql="SELECT v.cantidad,v.control,v.idvale_salida,v.idvales_almacen,v.idpg_detped,v.estatus,v.motivo_rechazo,
			(SELECT estatus FROM vales_almacen WHERE idvales_almacen=v.idvales_almacen) as estatus_vale,
			(SELECT no_vale FROM vales_almacen WHERE idvales_almacen=v.idvales_almacen) as no_vale,
			(SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as codigo,
			(SELECT descripcion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as descripcion,
			(SELECT nombre FROM almacen_pt WHERE idalmacen_pt=v.idalmacen_pt) as nombre,
			(SELECT codigo FROM almacen_pt WHERE idalmacen_pt=v.idalmacen_pt) as codigo_alm,
			(SELECT color FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as color,
			(SELECT medida FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=v.iddetalle_pedido) as medida
			 FROM vale_salida v WHERE v.idvales_almacen='$id' ORDER BY idvale_salida DESC";
			return ejecutarConsulta($sql);
		}

		public function consul_idvale()
		{
			$sql="SELECT count(idvales_almacen) as num_vales_ab FROM vales_almacen WHERE estatus=0";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function solicitar_vale($idvales_almacen,$fecha_hora)
		{
			$sql="UPDATE vales_almacen SET estatus=1, fecha_hora_solic='$fecha_hora' WHERE idvales_almacen='$idvales_almacen'";
			return ejecutarConsulta($sql);
		}

		public function consul_num_prod_vale($idvales_almacen)
		{
			$sql="SELECT count(idvale_salida) as num_prod_vale FROM vale_salida WHERE idvales_almacen='$idvales_almacen'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function consul_idpg_detped_val($idpg_detped_vale)
		{
			$sql="SELECT count(idpg_detped) as num_exist FROM vale_salida WHERE idpg_detped='$idpg_detped_vale' AND estatus<>2 AND estatus<>3";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function consul_idpg_detped_estat($idpg_detped_vale)
		{
			$sql="SELECT estatus FROM vale_salida WHERE idpg_detped='$idpg_detped_vale'";
			return ejecutarConsultaSimpleFila($sql);
		}  

		public function quitar_prod_vale($idvale_salida,$idpg_detped)
		{
			$sql="DELETE FROM vale_salida WHERE idvale_salida='$idvale_salida'";
			ejecutarConsulta($sql);

			$sql2="UPDATE pg_detped SET estatus='' WHERE idpg_detped='$idpg_detped'";
			return ejecutarConsulta($sql2);
		}

		public function reingresar_prod_vale($idvale_salida,$fecha_hora)
		{
			
			$sql="INSERT INTO almacen_pt_ed (idalmacen_pt,movimiento,cantidad,lote,op,control,fecha_hora,comentario) SELECT idalmacen_pt,'Entrada',cantidad,lote,op,control,'$fecha_hora','Reingreso' FROM vale_salida WHERE idvale_salida='$idvale_salida'";
			$idingresonew=ejecutarConsulta_retornarID($sql);

			$sql_2="UPDATE vale_salida SET estatus=3 WHERE idvale_salida='$idvale_salida'";
			ejecutarConsulta($sql_2);

			$sql_3="UPDATE pg_detped SET estatus='' WHERE idpg_detped=(SELECT idpg_detped FROM vale_salida WHERE idvale_salida='$idvale_salida')";
			return ejecutarConsulta($sql_3);

			$sql_4="SELECT * FROM almacen_pt_ed WHERE idalmacen_pt_ed='$idingresonew'";
	        return ejecutarConsultaSimpleFila($sql_4);
		}


		public function listar_vales_alm($estatus)
		{

			
			if ($estatus==3) {
				
				$sql="SELECT idvales_almacen,no_vale, fecha_hora_reg, fecha_hora_solic, estatus, fecha_hora_surt,prioridad FROM vales_almacen WHERE estatus <= '$estatus' ORDER BY fecha_hora_reg DESC";
				return ejecutarConsulta($sql);
			}elseif ($estatus<3 OR $estatus==4 OR $estatus==6) {
				$sql="SELECT idvales_almacen,no_vale, fecha_hora_reg, fecha_hora_solic, estatus, fecha_hora_surt,prioridad FROM vales_almacen WHERE estatus = '$estatus' ORDER BY fecha_hora_reg DESC";
				return ejecutarConsulta($sql);
			}elseif ($estatus==5){
				$sql="SELECT idvales_almacen,no_vale, fecha_hora_reg, fecha_hora_solic, estatus, fecha_hora_surt,prioridad FROM vales_almacen ORDER BY fecha_hora_reg DESC";
				return ejecutarConsulta($sql);
			}

			
				
		}

		public function borrar_vale($idvales_almacen)
		{
			$sql="DELETE FROM vales_almacen WHERE idvales_almacen='$idvales_almacen'";
			return ejecutarConsulta($sql);
		}

		public function archivar_vale($idvales_almacen)
		{
			$sql="UPDATE vales_almacen SET estatus=4 WHERE idvales_almacen='$idvales_almacen' AND estatus=2";
			return ejecutarConsulta($sql);
		}

		public function buscar_prod_vale($idvales_almacen)
		{
			$sql="SELECT * FROM vale_salida WHERE idvales_almacen='$idvales_almacen'";
			return ejecutarConsulta($sql);
		}

		public function estab_prior($idvales_almacen,$prioridad)
		{
			$sql="UPDATE vales_almacen SET prioridad='$prioridad' WHERE idvales_almacen='$idvales_almacen'";
			return ejecutarConsulta($sql);
		}

		public function edit_cant_total($iddetalle_pedido,$cantidad_nueva)
		{
			$sql="UPDATE pg_detalle_pedidos SET cantidad='$cantidad_nueva' WHERE idpg_detalle_pedidos='$iddetalle_pedido'";
			return ejecutarConsulta($sql);
		}

		
		public function consul_op_detped($idpg_detped)
		{
			$sql="SELECT op FROM pg_detped WHERE idpg_detped='$idpg_detped'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function consul_datos_vale($idvales_almacen)
		{
			$sql="SELECT * FROM vales_almacen WHERE idvales_almacen='$idvales_almacen'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function consul_cants($idpg_detalle_pedidos)
		{
			$sql="SELECT pdp.cantidad,
			(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido = '$idpg_detalle_pedidos') as cant_detped
			FROM pg_detalle_pedidos pdp WHERE pdp.idpg_detalle_pedidos='$idpg_detalle_pedidos'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function edit_observ_total($iddetalle_pedido)
		{
			$sql="SELECT observacion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$iddetalle_pedido'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function edit_observ_total2($iddetalle_pedido,$observacion)
		{
			$sql="UPDATE pg_detalle_pedidos SET observacion='$observacion' WHERE idpg_detalle_pedidos='$iddetalle_pedido'";
			ejecutarConsulta($sql);

			$sql2="UPDATE pg_detped SET observ_enlace='$observacion' WHERE iddetalle_pedido='$iddetalle_pedido'";
			ejecutarConsulta($sql2);

			$sql3="UPDATE op_detalle_prod SET observ='$observacion' WHERE iddetalle_pedido='$iddetalle_pedido'";
			return ejecutarConsulta($sql3);
		}

		public function borrar_documento($iddocumentos)
		{
			$sql="DELETE FROM documentos WHERE iddocumentos='$iddocumentos'";
			return ejecutarConsulta($sql);
		}

		public function guardar_lote_reingreso_list($idvale_salida)
		{
			$sql="SELECT lote,cantidad,op FROM presalida WHERE identrega='$idvale_salida' AND via_consul=1";
			return ejecutarConsulta($sql);
		}

		public function guardar_datos_facturacion($idpedido,$razon_fac,$rfc_fac,$calle_fac,$numero_fac,$interior_fac,$colonia_fac,$ciudad_fac,$estado_fac,$cp_fac,$telefono_fac,$email_fac)
		{
			$sql="UPDATE dir_facturacion_esp 
			SET razon_fac = '$razon_fac',
			rfc_fac = '$rfc_fac',
			calle_fac = '$calle_fac',
			numero_fac = '$numero_fac',
			interior_fac = '$interior_fac',
			colonia_fac = '$colonia_fac',
			ciudad_fac = '$ciudad_fac',
			estado_fac = '$estado_fac',
			cp_fac = '$cp_fac',
			telefono_fac = '$telefono_fac',
			email_fac = '$email_fac'
			WHERE idpedido='$idpedido'";
			return ejecutarConsulta($sql);
		}

		public function guardar_datos_entrega(
		$idpedido,
		$contacto_ent,
		$calle_ent,
		$numero_ent,
		$interior_ent,
		$colonia_ent,
		$ciudad_ent,
		$estado_ent,
		$cp_ent,
		$telefono_ent,
		$email_ent,
		$fecha_entrega_ent,
		$hora_entrega_r1,
		$hora_entrega_r2,
		$forma_entrega_ent,
		$det_forma_entrega,
		$referencia_ent,
		$empaque
		)
		{
			$sql="UPDATE dir_entregas_esp 
			SET contacto_ent = '$contacto_ent',
			calle_ent = '$calle_ent',
			numero_ent = '$numero_ent',
			interior_ent = '$interior_ent',
			colonia_ent = '$colonia_ent',
			ciudad_ent = '$ciudad_ent',
			estado_ent = '$estado_ent',
			cp_ent = '$cp_ent',
			telefono_ent = '$telefono_ent',
			email_ent = '$email_ent',
			fecha_entrega_ent = '$fecha_entrega_ent',
			hora_entrega_r1 = '$hora_entrega_r1',
			hora_entrega_r2 = '$hora_entrega_r2',
			forma_entrega_ent = '$forma_entrega_ent',
			det_forma_entrega = '$det_forma_entrega',
			referencia_ent = '$referencia_ent'
			WHERE idpedido='$idpedido'";
			ejecutarConsulta($sql);

			$sql_2="UPDATE pg_pedidos SET empaque = '$empaque' WHERE idpg_pedidos='$idpedido'";
			return ejecutarConsulta($sql_2);

		}



 	}

?>