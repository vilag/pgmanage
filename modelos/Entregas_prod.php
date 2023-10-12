<?php
 	require "../config/Conexion.php";

 	Class Entregas_prod
 	{
 		public function __construct()
		{

		}

		public function listar_salidas()
		{
			
				$sql="SELECT s.idsalida,s.no_salida,s.fecha_salida,sr.nombre as nom_repartidor, sv.nombre as nom_vehiculo,s.estatus FROM salidas s INNER JOIN salidas_repartidores sr ON s.idusuario = sr.idrepartidor INNER JOIN salidas_vehiculos sv ON s.idvehiculo=sv.idvehiculo ORDER BY s.no_salida DESC";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);
			
						
		}

		public function listar_salidas_control($valor1,$valor2,$marcador)
		{
			if ($marcador==1) {

				$sql="SELECT s.idsalida,s.no_salida,s.fecha_salida,sr.nombre as nom_repartidor, sv.nombre as nom_vehiculo,s.estatus FROM salidas s INNER JOIN salidas_repartidores sr ON s.idusuario = sr.idrepartidor INNER JOIN salidas_vehiculos sv ON s.idvehiculo=sv.idvehiculo WHERE DATE(s.fecha_salida)>='$valor1' AND DATE(s.fecha_salida)<='$valor2' ORDER BY s.no_salida DESC";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);
				// code...
			}elseif ($marcador==2) {

				$sql="SELECT s.idsalida,s.no_salida,s.fecha_salida,sr.nombre as nom_repartidor, sv.nombre as nom_vehiculo,s.estatus FROM salidas s INNER JOIN salidas_repartidores sr ON s.idusuario = sr.idrepartidor INNER JOIN salidas_vehiculos sv ON s.idvehiculo=sv.idvehiculo WHERE (SELECT no_entrega FROM salidas_entregas WHERE idsalida=s.idsalida LIMIT 1) = '$valor1' ORDER BY s.no_salida DESC";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);
				// code...
			}elseif ($marcador==3) {
				$sql="SELECT s.idsalida,s.no_salida,s.fecha_salida,sr.nombre as nom_repartidor, sv.nombre as nom_vehiculo,s.estatus FROM salidas s INNER JOIN salidas_repartidores sr ON s.idusuario = sr.idrepartidor INNER JOIN salidas_vehiculos sv ON s.idvehiculo=sv.idvehiculo WHERE (SELECT idpedido FROM salidas_entregas WHERE idsalida=s.idsalida LIMIT 1) = (SELECT idpg_pedidos FROM pg_pedidos WHERE no_control = '$valor1') ORDER BY s.no_salida DESC";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);
				// code...
			}
			
				
			
						
		}

		public function listar_salidas_det($idsalida)
		{
			$sql="SELECT se.no_entrega, se.nom_cliente, (SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=se.idpedido) as no_control, se.estatus FROM salidas_entregas se WHERE se.idsalida='$idsalida'";
			return ejecutarConsulta($sql);
		}

		public function listar_controles()
		{
			
				$sql="SELECT * FROM pg_pedidos WHERE estatus2 = 1 AND estatus<>'ENTREGADO' AND estatus<>'CANCELADO'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);
			
						
		}

		public function listar_prod_selec($id)
		{

			$sql2="UPDATE pg_detalle_pedidos SET prod_entregar = 0, check_entrega = 1 WHERE idpg_pedidos='$id'";
			ejecutarConsulta($sql2);

			$sql="SELECT pdp.idpg_detalle_pedidos,pdp.cantidad,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.observacion,pdp.cantidad, pdp.check_entrega,
			(pdp.cantidad-(SELECT IFNULL(SUM(cantidad),0) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos AND exc=0)) as pendiente,			
			(SELECT IFNULL(SUM(cantidad),0) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos AND exc=0) as cantidad_entre,
			(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Apartado') cant_apartado,
			(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND area = (SELECT oap.area FROM op_avance_prod oap WHERE oap.iddetalle_pedido=pdp.idpg_detalle_pedidos ORDER BY (SELECT num_proc FROM area WHERE idarea=oap.area) DESC LIMIT 1)) as cant_avance
			
			FROM pg_detalle_pedidos pdp WHERE pdp.idpg_pedidos='$id'";
			return ejecutarConsulta($sql);
		}

		

		public function buscar_idpg_pedidos($no_control)
		{
			
				$sql="SELECT (SELECT nombre FROM clientes WHERE idcliente=p.idcliente) as nom_cliente,p.idpg_pedidos,d.contacto_ent,d.calle_ent,d.numero_ent,d.interior_ent,d.colonia_ent,d.ciudad_ent,d.estado_ent,d.cp_ent,d.telefono_ent,d.hora_entrega_r1,d.hora_entrega_r2, p.condiciones, p.forma_entrega FROM pg_pedidos p INNER JOIN dir_entregas_esp d ON p.idpg_pedidos=d.idpedido  WHERE p.no_control='$no_control'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsultaSimpleFila($sql);
			
						
		}

		public function ver_salida($idsalida)
		{
				$sql="SELECT * FROM salidas WHERE idsalida='$idsalida'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsultaSimpleFila($sql);				
		}


		public function consultar_datos_salida($idsalida)
		{
		$sql_id="SELECT s.idsalida,s.no_salida,s.fecha_salida,sr.nombre as nom_repartidor, sv.nombre as nom_vehiculo, s.nom, s.dom, s.contacto, s.tel, s.horario,s.cond,s.medio FROM salidas s INNER JOIN salidas_repartidores sr ON s.idusuario=sr.idrepartidor INNER JOIN salidas_vehiculos sv ON s.idvehiculo=sv.idvehiculo WHERE s.idsalida='$idsalida'";
        return ejecutarConsultaSimpleFila($sql_id);

		}

		public function guardar_lote($identrega_detalle,$input_lote)
		{
				$sql="UPDATE salidas_entregas_detalles SET lote='$input_lote' WHERE identrega_detalle='$identrega_detalle'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);				
		}

		public function guardar_cantidad($identrega_detalle,$input_cant)
		{
				$sql="UPDATE salidas_entregas_detalles SET cantidad='$input_cant' WHERE identrega_detalle='$identrega_detalle'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);				
		}

		public function guardar_obs($identrega_detalle,$input_observ)
		{
				$sql="UPDATE salidas_entregas_detalles SET observaciones='$input_observ' WHERE identrega_detalle='$identrega_detalle'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);				
		}


		public function update_observ_salida($identrega,$observ_salida)
		{
				$sql="UPDATE salidas_entregas SET observaciones='$observ_salida' WHERE identrega='$identrega'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);				
		}

		public function listar_prod_control_exc($idpedido)
		{
				$sql="SELECT * FROM pg_detalle_pedidos WHERE idpg_pedidos='$idpedido'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);				
		}

		public function agregar_prod_salida($iddetalle_pedido,$cantidad,$observ,$identrega,$idsalida,$idpedido,$tipo_idprod,$prod_ped_tipo)
		{
			if ($tipo_idprod==1) {

				if ($prod_ped_tipo==1) {
					
					$sql_1="INSERT INTO salidas_entregas_detalles (identrega,idproducto,cantidad,idpedido,idsalida,lote,observaciones,exc) VALUES('$identrega','$iddetalle_pedido','$cantidad','$idpedido','$idsalida','','$observ','1')";
					//return ejecutarConsultaSimpleFila($sql);
					return ejecutarConsulta($sql_1);
				}elseif ($prod_ped_tipo==2) {
					
					$sql_2="INSERT INTO salidas_entregas_detalles (identrega,idproducto,cantidad,idpedido,idsalida,lote,observaciones,exc) VALUES('$identrega','$iddetalle_pedido','$cantidad','$idpedido','$idsalida','','$observ','0')";
					//return ejecutarConsultaSimpleFila($sql);
					return ejecutarConsulta($sql_2);
				}

					

				
			}elseif ($tipo_idprod==2) {
				$sql_3="INSERT INTO salidas_entregas_detalles (identrega,idproducto,cantidad,idpedido,idsalida,lote,observaciones,exc,idprod_add) VALUES('$identrega','0','$cantidad','$idpedido','$idsalida','','$observ','1','$iddetalle_pedido')";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql_3);
			}
								
		}

		public function ver_lotes_vale_alm($iddetalle_pedido)
		{
				$sql="SELECT ps.idpresalida,ps.cantidad, ps.lote, ps.cant_salida,ps.iddetalle_pedido,
				(SELECT no_vale FROM vales_almacen WHERE idvales_almacen = (SELECT idvales_almacen FROM vale_salida WHERE idvale_salida=ps.identrega LIMIT 1)) as no_vale

				FROM presalida ps WHERE ps.iddetalle_pedido='$iddetalle_pedido' AND ps.via_consul=1";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);				
		}

		public function ver_lotes_vale_prod($iddetalle_pedido,$area)
		{
				$sql="SELECT oap.lote,(SELECT no_op FROM op WHERE idop=oap.idop) as no_op,oap.cant_capt FROM op_avance_prod oap WHERE oap.iddetalle_pedido='$iddetalle_pedido' AND oap.area='$area' ORDER BY fecha_hora DESC";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);				
		}

		public function enviar_lotes($identrega_detalle,$idpresalida,$lote,$cantidad_enviar)
		{

				$sql2="UPDATE presalida SET identrega_detalle='$identrega_detalle',cant_salida = cant_salida+'$cantidad_enviar' WHERE idpresalida='$idpresalida'";
				//return ejecutarConsultaSimpleFila($sql);
				ejecutarConsulta($sql2);	

				$sql="UPDATE salidas_entregas_detalles SET lote = CONCAT(lote,' ','$lote',' (','$cantidad_enviar','),') WHERE identrega_detalle = '$identrega_detalle'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);				
		}

		public function buscar_producto_exced_salida($codigo)
		{
				$sql="SELECT idproducto, nombre FROM productos WHERE codigo='$codigo'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsultaSimpleFila($sql);				
		}

		public function borrar_prod_salida($identrega_detalle,$cantidad,$idusuario,$no_salida,$idproducto,$idpedido)
		{

			if ($idproducto>0) {

				$sql_2="INSERT INTO historial_mov (movimiento,idusuario,idpedido,fecha_hora,notif) SELECT CONCAT('Se elimino producto de salida: ', codigo,' - ',descripcion,', Cant:', '$cantidad',', Salida: ','$no_salida'), '$idusuario',idpg_pedidos,NOW(),'0' FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos = (SELECT idproducto FROM salidas_entregas_detalles WHERE identrega_detalle='$identrega_detalle')";
				//return ejecutarConsultaSimpleFila($sql);
				ejecutarConsulta($sql_2);


				$sql="DELETE FROM salidas_entregas_detalles WHERE identrega_detalle='$identrega_detalle'";
				//return ejecutarConsultaSimpleFila($sql);
				return  ejecutarConsulta($sql);	
				// code...
			}elseif ($idproducto==0) {


				$sql_2="INSERT INTO historial_mov (movimiento,idusuario,idpedido,fecha_hora,notif) SELECT CONCAT('Se elimino producto de salida: ', codigo,' - ',nombre,', Cant:', '$cantidad',', Salida: ','$no_salida'), '$idusuario','$idpedido',NOW(),'0' FROM productos WHERE idproducto = (SELECT idprod_add FROM salidas_entregas_detalles WHERE identrega_detalle='$identrega_detalle')";
				//return ejecutarConsultaSimpleFila($sql);
				ejecutarConsulta($sql_2);


				$sql="DELETE FROM salidas_entregas_detalles WHERE identrega_detalle='$identrega_detalle'";
				//return ejecutarConsultaSimpleFila($sql);
				return  ejecutarConsulta($sql);	
				// code...
			}


								
		}

		public function contar_op($iddetalle_pedido)
		{
				$sql="SELECT count(idop) as num_ops FROM op_detalle_prod WHERE iddetalle_pedido='$iddetalle_pedido'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsultaSimpleFila($sql);				
		}


		public function buscar_area_ent($iddetalle_pedido)
		{
				$sql="SELECT area FROM op_detalle WHERE idop=(SELECT idop FROM op_detalle_prod WHERE iddetalle_pedido='$iddetalle_pedido') ORDER BY prioridad DESC LIMIT 1";


				//$sql="SELECT idop FROM op_detalle_prod WHERE iddetalle_pedido='$iddetalle_pedido'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsultaSimpleFila($sql);				
		}

		public function consul_salida($idsalida)
		{
				$sql="SELECT idsalida ,DATE(fecha_salida) as fecha_salida, TIME(fecha_salida) as hora_salida, idvehiculo, idusuario FROM salidas WHERE idsalida='$idsalida'";
				return ejecutarConsultaSimpleFila($sql);				
		}


		



 	}

?>