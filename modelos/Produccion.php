<?php
 	require "../config/Conexion.php";

 	Class Produccion
 	{
 		public function __construct()
		{

		}

		public function cargar_ops($idusuario)
		{
				
						if ($idusuario==15) {


							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_5 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op ,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

							
						}
						if ($idusuario==16) {
							
							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_6 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin 
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

						}
						if ($idusuario==17) {
							
							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_7 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin 
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

						}
						if ($idusuario==18) {

							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_8 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin 
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

						}
						if ($idusuario==19) {
							
							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_1 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin 
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

						}
						if ($idusuario==20) {
							
							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_3 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin 
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

						}
						if ($idusuario==21) {
							
							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_2 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin 
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

						}



				/*$sql="SELECT od.cant_tot,od.cant_fab_1,od.cant_fab_2,od.cant_fab_3,od.cant_fab_5,od.cant_fab_6,od.cant_fab_7,od.cant_fab_8,od.cant_noent,
				 (SELECT no_op FROM op WHERE idop=od.idop) as no_op, 
				 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);*/



			

				/*$sql="SELECT
				 (SELECT no_op FROM op WHERE idop=od.idop) as no_op, 
				 (SELECT SUM(cant_tot) FROM op_detalle_prod WHERE idop=od.idop) as cant_tot,



				 (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = (SELECT area FROM usuario WHERE idusuario='$idusuario')) as cant_fab,

				 (SELECT count(odp.idop_detalle_prod) FROM op_detalle_prod odp WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'ENTREGADO' AND odp.idop=od.idop AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'CANCELADO') as cant_noent

				

				 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);*/
			
						
		}

		public function buscar2($idusuario,$no_op)
		{
				//$op_=$op;


						/*$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_7 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin 
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') AND od.idop=(SELECT idop FROM op WHERE no_op = '$no_op')";				
							return ejecutarConsulta($sql);*/
					
						if ($idusuario==15) {


							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_5 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op ,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') AND od.idop=(SELECT idop FROM op WHERE no_op = '$no_op') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

							
						}
						if ($idusuario==16) {
							
							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_6 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin 
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') AND od.idop=(SELECT idop FROM op WHERE no_op = '$no_op') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

						}
						if ($idusuario==17) {
							
							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_7 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin 
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') AND od.idop=(SELECT idop FROM op WHERE no_op = '$no_op') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

						}
						if ($idusuario==18) {

							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_8 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin 
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') AND od.idop=(SELECT idop FROM op WHERE no_op = '$no_op') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

						}
						if ($idusuario==19) {
							
							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_1 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin 
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') AND od.idop=(SELECT idop FROM op WHERE no_op = '$no_op') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

						}
						if ($idusuario==20) {
							
							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_3 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin 
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') AND od.idop=(SELECT idop FROM op WHERE no_op = '$no_op') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

						}
						if ($idusuario==21) {
							
							$sql="SELECT od.idop_detalle,od.idop,od.cant_tot,od.cant_fab_2 as cant_fab,od.cant_noent,od.area,
				 			(SELECT no_op FROM op WHERE idop=od.idop) as no_op,
				 			(SELECT area FROM op_detalle WHERE idop=od.idop ORDER BY prioridad DESC LIMIT 1) as area_fin 
							 FROM op_detalle od WHERE od.area = (SELECT area FROM usuario WHERE idusuario='$idusuario') AND od.idop=(SELECT idop FROM op WHERE no_op = '$no_op') ORDER BY (SELECT no_op FROM op WHERE idop=od.idop) DESC";				
							return ejecutarConsulta($sql);

						}
			
						
		}

		

		public function consultar_area($idusuario)
		{
			
				$sql="SELECT idarea,nombre FROM area WHERE idarea=(SELECT area FROM usuario WHERE idusuario='$idusuario')";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsultaSimpleFila($sql);
			
						
		}


		public function pendiente_prod()
		{
			
				$sql="SELECT pd.idpg_detped,
				(SELECT lugar FROM usuario WHERE idusuario=(SELECT idusuario FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)) as origen,
				(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as no_control,
				pd.op,
				(SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as codigo,
				(SELECT descripcion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as descrip,
				(SELECT observacion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as observ,
				pd.cantidad,
				

				(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE iddetalle_pedido=pd.iddetalle_pedido AND area = 1) as Herreria,
				(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE iddetalle_pedido=pd.iddetalle_pedido AND area = 2) as Pintura,
				(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE iddetalle_pedido=pd.iddetalle_pedido AND area = 3) as Plasticos,
				(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE iddetalle_pedido=pd.iddetalle_pedido AND area = 5) as Ensamble_Porc,
				(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE iddetalle_pedido=pd.iddetalle_pedido AND area = 6) as Ensamble_Com,
				(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE iddetalle_pedido=pd.iddetalle_pedido AND area = 7) as Ensamble_Mue,
				(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE iddetalle_pedido=pd.iddetalle_pedido AND area = 8) as Horno,


				(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE iddetalle_pedido=pd.iddetalle_pedido AND area = (SELECT oap.area FROM op_avance_prod oap WHERE oap.iddetalle_pedido=pd.iddetalle_pedido ORDER BY (SELECT num_proc FROM area WHERE idarea=oap.area) DESC LIMIT 1)) as avance

				FROM pg_detped pd WHERE pd.estatus='Produccion' AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'ENTREGADO' AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'CANCELADO'";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsultaSimpleFila($sql);
			
						
		}

		
		public function ver_productos($idop,$area)
		{
			/*$sql="SELECT o.idop_detalle_prod,o.idop,o.idpg_detped,o.no_control,o.codigo,o.producto,o.empaque,o.cant_tot,DATE(o.fecha_inicio) as fecha_inicio, DATE(o.fecha_term) as fecha_term, o.observ,o.medida,o.color,p.estatus,
			(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE idop_detalle_prod=o.idop_detalle_prod AND area='$area') as avance 
			FROM op_detalle_prod o INNER JOIN pg_detped p ON o.idpg_detped=p.idpg_detped WHERE o.idop='$idop'";*/



			$sql="SELECT odp.idop_detalle_prod,odp.codigo,odp.producto,odp.cant_tot, 
			(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area='$area') as avance

			
			FROM op_detalle_prod odp WHERE odp.idop='$idop'";
			return ejecutarConsulta($sql);
		}


		public function consultar_idop_detalle_prod($idop_detalle_prod,$area)
		{

			$sql="SELECT odp.idop_detalle_prod,odp.codigo,odp.producto,odp.cant_tot, odp.iddetalle_pedido, odp.idpg_detped,
			(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido)) as no_control,
			(SELECT idpg_pedidos FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido)) as idpedido,
			(SELECT IFNULL(sum(cant_capt),0) FROM op_avance_prod WHERE idop_detalle_prod=odp.idop_detalle_prod AND area='$area') as avance 
			FROM op_detalle_prod odp WHERE odp.idop_detalle_prod='$idop_detalle_prod'";
			return ejecutarConsultaSimpleFila($sql);
		}


		public function guardar_avance_prod($idop_detalle,$idop_detalle_prod,$avance_nuevo,$fecha_hora,$idarea,$idpedido,$iddetalle_pedido,$lote,$coment_avance,$cant_ingresar_enc,$cant_ingresar_enc_exc,$idop,$estatus,$idpg_detped,$marca_capt_cant)
		{


			if ($marca_capt_cant == 1) {


				$sql_id2="UPDATE pg_detped SET estatus = '$estatus' WHERE idpg_detped='$idpg_detped'";
		        ejecutarConsulta($sql_id2);
				

				$sql="INSERT INTO op_avance_prod (idop_detalle_prod,avance,cant_capt,fecha_hora,area,idpedido,lote,comentario,idop,iddetalle_pedido) VALUES ('$idop_detalle_prod','$avance_nuevo','$cant_ingresar_enc','$fecha_hora','$idarea','$idpedido','$lote','$coment_avance','$idop','$iddetalle_pedido')";
				ejecutarConsulta($sql);


				if ($idarea==1) {
					$sql="UPDATE pg_detalle_pedidos SET avance_he='$avance_nuevo' WHERE idpg_detalle_pedidos='$iddetalle_pedido'";
					ejecutarConsulta($sql);


					$sql_op = "UPDATE op_detalle od SET cant_tot = (SELECT SUM(cant_tot) FROM op_detalle_prod WHERE idop=od.idop),
					cant_fab_1 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 1),
					cant_noent = (SELECT count(odp.idop_detalle_prod) FROM op_detalle_prod odp WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'ENTREGADO' AND odp.idop=od.idop AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'CANCELADO') 
					WHERE od.idop_detalle='$idop_detalle'";
					ejecutarConsulta($sql_op);


				}
				if ($idarea==2) {
					$sql="UPDATE pg_detalle_pedidos SET avance_pi='$avance_nuevo' WHERE idpg_detalle_pedidos='$iddetalle_pedido'";
					ejecutarConsulta($sql);

					$sql_op = "UPDATE op_detalle od SET cant_tot = (SELECT SUM(cant_tot) FROM op_detalle_prod WHERE idop=od.idop),
					cant_fab_2 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 2),
					cant_noent = (SELECT count(odp.idop_detalle_prod) FROM op_detalle_prod odp WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'ENTREGADO' AND odp.idop=od.idop AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'CANCELADO') 
					WHERE od.idop_detalle='$idop_detalle'";
					ejecutarConsulta($sql_op);
				}
				if ($idarea==3) {
					$sql="UPDATE pg_detalle_pedidos SET avance_pl='$avance_nuevo' WHERE idpg_detalle_pedidos='$iddetalle_pedido'";
					ejecutarConsulta($sql);

					$sql_op = "UPDATE op_detalle od SET cant_tot = (SELECT SUM(cant_tot) FROM op_detalle_prod WHERE idop=od.idop),
					cant_fab_3 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 3),
					cant_noent = (SELECT count(odp.idop_detalle_prod) FROM op_detalle_prod odp WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'ENTREGADO' AND odp.idop=od.idop AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'CANCELADO') 
					WHERE od.idop_detalle='$idop_detalle'";
					ejecutarConsulta($sql_op);
				}
				if ($idarea==5) {
					$sql="UPDATE pg_detalle_pedidos SET avance_ep='$avance_nuevo' WHERE idpg_detalle_pedidos='$iddetalle_pedido'";
					ejecutarConsulta($sql);

					$sql_op = "UPDATE op_detalle od SET cant_tot = (SELECT SUM(cant_tot) FROM op_detalle_prod WHERE idop=od.idop),
					cant_fab_5 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 5),
					cant_noent = (SELECT count(odp.idop_detalle_prod) FROM op_detalle_prod odp WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'ENTREGADO' AND odp.idop=od.idop AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'CANCELADO') 
					WHERE od.idop_detalle='$idop_detalle'";
					ejecutarConsulta($sql_op);
				}
				if ($idarea==6) {
					$sql="UPDATE pg_detalle_pedidos SET avance_ec='$avance_nuevo' WHERE idpg_detalle_pedidos='$iddetalle_pedido'";
					ejecutarConsulta($sql);

					$sql_op = "UPDATE op_detalle od SET cant_tot = (SELECT SUM(cant_tot) FROM op_detalle_prod WHERE idop=od.idop),
					cant_fab_6 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 6),
					cant_noent = (SELECT count(odp.idop_detalle_prod) FROM op_detalle_prod odp WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'ENTREGADO' AND odp.idop=od.idop AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'CANCELADO') 
					WHERE od.idop_detalle='$idop_detalle'";
					ejecutarConsulta($sql_op);
				}
				if ($idarea==7) {
					$sql="UPDATE pg_detalle_pedidos SET avance_em='$avance_nuevo' WHERE idpg_detalle_pedidos='$iddetalle_pedido'";
					ejecutarConsulta($sql);

					$sql_op = "UPDATE op_detalle od SET cant_tot = (SELECT SUM(cant_tot) FROM op_detalle_prod WHERE idop=od.idop),
					cant_fab_7 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 7),
					cant_noent = (SELECT count(odp.idop_detalle_prod) FROM op_detalle_prod odp WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'ENTREGADO' AND odp.idop=od.idop AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'CANCELADO') 
					WHERE od.idop_detalle='$idop_detalle'";
					ejecutarConsulta($sql_op);
				}
				if ($idarea==8) {
					$sql="UPDATE pg_detalle_pedidos SET avance_ho='$avance_nuevo' WHERE idpg_detalle_pedidos='$iddetalle_pedido'";
					ejecutarConsulta($sql);

					$sql_op = "UPDATE op_detalle od SET cant_tot = (SELECT SUM(cant_tot) FROM op_detalle_prod WHERE idop=od.idop),
					cant_fab_8 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 8),
					cant_noent = (SELECT count(odp.idop_detalle_prod) FROM op_detalle_prod odp WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'ENTREGADO' AND odp.idop=od.idop AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'CANCELADO') 
					WHERE od.idop_detalle='$idop_detalle'";
					ejecutarConsulta($sql_op);
				}

				

				return;

			}elseif ($marca_capt_cant == 2) {




				$sql="INSERT INTO op_detalle_exc (idop_detalle_prod,idavance_prod,cantidad,area,fecha_hora,lote,coment) VALUES('$idop_detalle_prod','0','$cant_ingresar_enc_exc','$idarea','$fecha_hora','$lote','$coment_avance')";
				return ejecutarConsulta($sql);
				// code...
			}

				
		}

 	}

?>