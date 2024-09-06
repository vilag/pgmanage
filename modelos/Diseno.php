<?php

//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Diseno
{
	public function __construct()
	{

	}

	public function listar_prod_produccion()
	{

		$sql="SELECT

		adp.idpg_detped,
		adp.iddetalle_pedido,
		adp.cantidad,
		adp.estatus,
		DATE(adp.fecha_hora) as fecha_hora,
		adp.fecha_hora2,
		adp.observ_enlace,
		adp.idpedido,
		(SELECT no_control FROM a_tbl_pedidos WHERE idpg_pedidos=adp.idpedido) as no_control,
		(SELECT DATE(fecha_pedido) FROM a_tbl_pedidos WHERE idpg_pedidos=adp.idpedido) as fecha_pedido,
		(SELECT DATE(fecha_entrega_ent) FROM a_tbl_entregas_esp WHERE idpedido=adp.idpedido) as fecha_entrega,
		(SELECT codigo FROM a_tbl_detalle_pedidos WHERE idpg_detalle_pedidos=adp.iddetalle_pedido) as codigo,
		(SELECT descripcion FROM a_tbl_detalle_pedidos WHERE idpg_detalle_pedidos=adp.iddetalle_pedido) as nombre

		FROM a_tbl_detped adp WHERE adp.estatus=1";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function llenar_modelos()
	{

		$sql="SELECT * FROM muebles_fam";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function select_modelos($id)
	{

		$sql="SELECT * FROM modelo WHERE idmuebles_fam = '$id'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function select_tamano($id)
	{
		//$idt=$id;
		$sql="SELECT * FROM tamano WHERE idmodelo = '$id'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}


	public function select_paletas()
	{

		$sql="SELECT * FROM paletas";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function select_parrillas()
	{

		$sql="SELECT * FROM parrillas";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function select_colores()
	{

		$sql="SELECT * FROM colores";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function select_estruc_resp()
	{

		$sql="SELECT * FROM estruc_respaldos";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function select_estruc_pal()
	{

		$sql="SELECT * FROM estruc_paleta";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}


	public function guardar_pedido_temp($fecha_hora,$tipo_ped)
	{

		$sql="INSERT INTO pg_pedidos (fecha_activacion,fecha_pedido,estatus,estatus2,tipo) VALUES('$fecha_hora','0000-00-00 00:00:00','0','0','$tipo_ped')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_insert="INSERT INTO clientes_detalle (idpedido) VALUES('$idingresonew')";
        ejecutarConsulta($sql_insert);

		$sql_id="SELECT * FROM pg_pedidos WHERE idpg_pedidos='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);		
	}

	public function consul_idprod($codigo)
	{

		$sql="SELECT * FROM productos WHERE codigo='$codigo'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function consul_exist($idproducto,$id_ped_temp)
	{

		$sql="SELECT count(*) as num_prod FROM pg_detalle_pedidos WHERE idproducto='$idproducto' AND idpg_pedidos='$id_ped_temp'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function save_prod_ped($idproducto,$id_ped_temp,$precio,$tipo_add,$fecha_hora,$idusuario)
	{
		$fecha = $fecha_hora;
		$iduser = $idusuario;
		$pre = $precio;

		if ($tipo_add==1) {
			
			$sql3="INSERT INTO historial_mov (movimiento,idusuario,idpedido,fecha_hora,notif) SELECT CONCAT('Producto agregado: ',codigo), '$iduser', '$id_ped_temp', '$fecha', '1' FROM productos WHERE idproducto='$idproducto'";
			ejecutarConsulta($sql3);
		}

		$sql="INSERT INTO pg_detalle_pedidos (idpg_pedidos,idproducto,cantidad,unidad,codigo,medida,descripcion,precio,descuento,importe,entregados,entregados2,estatus) SELECT '$id_ped_temp',idproducto,'1','Pza.',codigo,medida,nombre,precio_total,'0',precio_total,'0','0','' FROM productos WHERE idproducto='$idproducto' ";
		return ejecutarConsulta($sql);			
	}


	public function rango_iddetalle($idpg_detalle_pedidos)
	{

		$sql="SELECT
		(SELECT idpg_detped FROM pg_detped WHERE iddetalle_pedido='$idpg_detalle_pedidos' ORDER BY idpg_detped ASC LIMIT 1) as idpg_detped1,
		(SELECT idpg_detped FROM pg_detped WHERE iddetalle_pedido='$idpg_detalle_pedidos' ORDER BY idpg_detped DESC LIMIT 1) as idpg_detped2	
		 FROM pg_detped WHERE iddetalle_pedido='$idpg_detalle_pedidos' LIMIT 1";

		return ejecutarConsultaSimpleFila($sql);			
	}

	public function buscar_avances($idpg_detped1,$idpg_detped2)
	{

			while ($idpg_detped1 <= $idpg_detped2) {
				
				$sql3="SELECT idavance_prod FROM op_avance_prod WHERE idop_detalle_prod=(SELECT idop_detalle_prod FROM op_detalle_prod WHERE idpg_detped='$idpg_detped1')";
				$resultado = ejecutarConsultaSimpleFila($sql3);

				if ($resultado>0) {

					$sql4="SELECT idavance_prod FROM op_avance_prod WHERE idop_detalle_prod=(SELECT idop_detalle_prod FROM op_detalle_prod WHERE idpg_detped='$idpg_detped1')";
					return ejecutarConsultaSimpleFila($sql4);
				}

				$idpg_detped1 = $idpg_detped1+1;

				if ($idpg_detped1>$idpg_detped2) {

					$idpg_detped1 = $idpg_detped1-1;
					
					$sql4="SELECT idavance_prod FROM op_avance_prod WHERE idop_detalle_prod=(SELECT idop_detalle_prod FROM op_detalle_prod WHERE idpg_detped='$idpg_detped1')";
					return ejecutarConsultaSimpleFila($sql4);

				}
			}
					
	}


	public function change_prod_ped($idproducto,$id_ped_temp,$precio,$fecha_hora,$idusuario,$idpg_detalle_pedidos,$idpg_detped1,$idpg_detped2)
	{
		$fecha = $fecha_hora;
		$iduser = $idusuario;
		$pre = $precio;
		
		$sql3="INSERT INTO historial_mov (movimiento,idusuario,idpedido,fecha_hora,notif) SELECT CONCAT('Cambio de producto: ',codigo), '$iduser', '$id_ped_temp', '$fecha', '1' FROM productos WHERE idproducto='$idproducto'";
		ejecutarConsulta($sql3);
		

		/*$sql="INSERT INTO pg_detalle_pedidos (idpg_pedidos,idproducto,cantidad,unidad,codigo,medida,descripcion,precio,descuento,importe,entregados,entregados2,estatus) SELECT '$id_ped_temp',idproducto,'1','Pza.',codigo,medida,nombre,precio_total,'0',precio_total,'0','0','' FROM productos WHERE idproducto='$idproducto' ";
		return ejecutarConsulta($sql);*/

		if ($idpg_detped1>0 AND $idpg_detped2>0) {


			while ($idpg_detped1 <= $idpg_detped2) {
				
				$sql1="SELECT idpg_detped FROM pg_detped WHERE idpg_detped='$idpg_detped1' AND iddetalle_pedido='$idpg_detalle_pedidos'";
				$resultado = ejecutarConsultaSimpleFila($sql1);

				if ($resultado>0) {

					$sql3="UPDATE pg_detalle_pedidos SET idproducto='$idproducto', 
					codigo=(SELECT codigo FROM productos WHERE idproducto='$idproducto'), 
					medida=(SELECT medida FROM productos WHERE idproducto='$idproducto'),
					descripcion=(SELECT nombre FROM productos WHERE idproducto='$idproducto'),
					precio=(SELECT precio_total FROM productos WHERE idproducto='$idproducto'),
					importe=cantidad*(SELECT precio_total FROM productos WHERE idproducto='$idproducto'),
					color=(SELECT color FROM productos WHERE idproducto='$idproducto')
					WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
				    ejecutarConsulta($sql3);	

					$sql2="UPDATE pg_detped SET idproducto='$idproducto' WHERE idpg_detped='$idpg_detped1'";
				    ejecutarConsulta($sql2);

					$sql="UPDATE op_detalle_prod SET codigo = (SELECT codigo FROM productos WHERE idproducto='$idproducto'),producto=(SELECT nombre FROM productos WHERE idproducto='$idproducto'), medida=(SELECT medida FROM productos WHERE idproducto='$idproducto') WHERE idpg_detped='$idpg_detped1'";
						ejecutarConsulta($sql);
					# code...
				}

				$idpg_detped1 = $idpg_detped1+1;

				if ($idpg_detped1>$idpg_detped2) {
					return;
				}
			}

			
		}elseif ($idpg_detped1==0 AND $idpg_detped2==0) {
			
					$sql4="UPDATE pg_detalle_pedidos SET idproducto='$idproducto', 
					codigo=(SELECT codigo FROM productos WHERE idproducto='$idproducto'), 
					medida=(SELECT medida FROM productos WHERE idproducto='$idproducto'),
					descripcion=(SELECT nombre FROM productos WHERE idproducto='$idproducto'),
					precio=(SELECT precio_total FROM productos WHERE idproducto='$idproducto'),
					importe=cantidad*(SELECT precio_total FROM productos WHERE idproducto='$idproducto'),
					color=(SELECT color FROM productos WHERE idproducto='$idproducto')
					WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
				    return ejecutarConsulta($sql4);
		}

			

				
	}

	


	public function quitar_prod_ped($idproducto,$id_ped_temp,$precio,$fecha_hora,$idusuario,$idpg_detalle_pedidos,$idpg_detped1,$idpg_detped2)
	{
		$fecha = $fecha_hora;
		$iduser = $idusuario;
		$pre = $precio;
		
		$sql="INSERT INTO historial_mov (movimiento,idusuario,idpedido,fecha_hora,notif) SELECT CONCAT('Producto eliminado: ',codigo), '$iduser', '$id_ped_temp', '$fecha', '1' FROM productos WHERE idproducto='$idproducto'";
		ejecutarConsulta($sql);
		

		if ($idpg_detped1>0 AND $idpg_detped2>0) {


			while ($idpg_detped1 <= $idpg_detped2) {
				
				$sql2="SELECT idpg_detped FROM pg_detped WHERE idpg_detped='$idpg_detped1' AND iddetalle_pedido='$idpg_detalle_pedidos'";
				$resultado = ejecutarConsultaSimpleFila($sql2);

				if ($resultado>0) {

					$sql_valid="INSERT INTO acciones_valid (mensaje,fecha_hora) SELECT CONCAT('Producto borrado con Codigo:',codigo,' idop: ',idop, ' al quitar producto de pedido'),NOW() FROM op_detalle_prod WHERE idpg_detped='$idpg_detped1'";
					ejecutarConsulta($sql_valid);

					$sq13="DELETE FROM op_detalle_prod WHERE idpg_detped='$idpg_detped1'";
					ejecutarConsulta($sq13);

					$sql4="DELETE FROM pg_detped WHERE idpg_detped='$idpg_detped1'";
					ejecutarConsulta($sql4);

				}

				$idpg_detped1 = $idpg_detped1+1;

				if ($idpg_detped1>$idpg_detped2) {
					$sql5="DELETE FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
					return ejecutarConsulta($sql5);
				}
			}

			
		}elseif ($idpg_detped1==0 AND $idpg_detped2==0) {
			
					$sql6="DELETE FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
					return ejecutarConsulta($sql6);
		}

			

				
	}

	public function consul_notif()
	{

		/*$sql="SELECT dp.idproducto,p.imagen,p.nombre,p.codigo FROM pg_detalle_pedidos dp INNER JOIN productos p ON dp.idproducto=p.idproducto  WHERE dp.idpg_pedidos='$id' LIMIT 5";
		return ejecutarConsulta($sql);	*/


		$sql="SELECT h.idhistorial_mov,h.movimiento,u.nombre,u.apellido_p,h.idpedido,h.fecha_hora,h.notif as notificacion, p.no_control FROM historial_mov h INNER JOIN usuario u ON h.idusuario=u.idusuario INNER JOIN pg_pedidos p ON h.idpedido=p.idpg_pedidos WHERE (h.notif='1' OR h.notif='2') AND h.movimiento<>'Descuento solicitado' ORDER BY h.notif ASC ,h.idhistorial_mov DESC LIMIT 5";
		return ejecutarConsulta($sql);
			
	}



	public function listar_mensajes($idusuario)
		{

			if ($idusuario==1) {
				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.orel_rev as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.orel='$idusuario' ORDER BY c.fecha_hora DESC LIMIT 10";
				return ejecutarConsulta($sql);
			}
			if ($idusuario==2) {
				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.ana_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.ana='$idusuario' ORDER BY c.fecha_hora DESC LIMIT 10";
				return ejecutarConsulta($sql);
				
			}
			if ($idusuario==3) {
				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.adriana_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.adriana='$idusuario' ORDER BY c.fecha_hora DESC LIMIT 10";
				return ejecutarConsulta($sql);
				
			}
			if ($idusuario==4) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.claudia_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.claudia='$idusuario' ORDER BY c.fecha_hora DESC LIMIT 10";
				return ejecutarConsulta($sql);

			}
			if ($idusuario==5) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.angelina_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.angelina='$idusuario' ORDER BY c.fecha_hora DESC LIMIT 10";
				return ejecutarConsulta($sql);

			}
			if ($idusuario==6) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.ajm_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.ajm='$idusuario' ORDER BY c.fecha_hora DESC LIMIT 10";
				return ejecutarConsulta($sql);

			}
			if ($idusuario==7) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.direccion_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.direccion='$idusuario' ORDER BY c.fecha_hora DESC LIMIT 10";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==8) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.arturo_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.arturo='$idusuario' ORDER BY c.fecha_hora DESC LIMIT 10";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==9) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.juancarlos_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.juancarlos='$idusuario' ORDER BY c.fecha_hora DESC LIMIT 10";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==10) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.gladys_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.gladys='$idusuario' ORDER BY c.fecha_hora DESC LIMIT 10";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==11) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.leonardo_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.leonardo='$idusuario' ORDER BY c.fecha_hora DESC LIMIT 10";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==12) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.fernando_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.fernando='$idusuario' ORDER BY c.fecha_hora DESC LIMIT 10";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==14) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.martha_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.martha='$idusuario' ORDER BY c.fecha_hora DESC LIMIT 10";
				return ejecutarConsulta($sql);

				
			}




				
		}

	public function consul_notif2()
	{

		/*$sql="SELECT dp.idproducto,p.imagen,p.nombre,p.codigo FROM pg_detalle_pedidos dp INNER JOIN productos p ON dp.idproducto=p.idproducto  WHERE dp.idpg_pedidos='$id' LIMIT 5";
		return ejecutarConsulta($sql);	*/


		$sql="SELECT h.idhistorial_mov,h.movimiento,u.nombre,u.apellido_p,h.idpedido,h.fecha_hora,h.notif as notificacion, p.no_control FROM historial_mov h INNER JOIN usuario u ON h.idusuario=u.idusuario INNER JOIN pg_pedidos p ON h.idpedido=p.idpg_pedidos WHERE (h.notif='1' OR h.notif='2') AND h.movimiento<>'Descuento solicitado' ORDER BY h.notif ASC ,h.idhistorial_mov DESC";
		return ejecutarConsulta($sql);
			
	}


	public function consul_todo_mensajes($idusuario)
	{

			if ($idusuario==1) {
				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.orel_rev as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.orel='$idusuario' ORDER BY c.fecha_hora DESC";
				return ejecutarConsulta($sql);
			}
			if ($idusuario==2) {
				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.ana_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.ana='$idusuario' ORDER BY c.fecha_hora DESC";
				return ejecutarConsulta($sql);
				
			}
			if ($idusuario==3) {
				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.adriana_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.adriana='$idusuario' ORDER BY c.fecha_hora DESC";
				return ejecutarConsulta($sql);
				
			}
			if ($idusuario==4) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.claudia_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.claudia='$idusuario' ORDER BY c.fecha_hora DESC";
				return ejecutarConsulta($sql);

			}
			if ($idusuario==5) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.angelina_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.angelina='$idusuario' ORDER BY c.fecha_hora DESC";
				return ejecutarConsulta($sql);

			}
			if ($idusuario==6) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.ajm_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.ajm='$idusuario' ORDER BY c.fecha_hora DESC";
				return ejecutarConsulta($sql);

			}
			if ($idusuario==7) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.direccion_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.direccion='$idusuario' ORDER BY c.fecha_hora DESC";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==8) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.arturo_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.arturo='$idusuario' ORDER BY c.fecha_hora DESC";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==9) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.juancarlos_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.juancarlos='$idusuario' ORDER BY c.fecha_hora DESC";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==10) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.gladys_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.gladys='$idusuario' ORDER BY c.fecha_hora DESC";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==11) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.leonardo_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.leonardo='$idusuario' ORDER BY c.fecha_hora DESC";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==12) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.fernando_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.fernando='$idusuario' ORDER BY c.fecha_hora DESC";
				return ejecutarConsulta($sql);

				
			}
			if ($idusuario==14) {

				$sql="SELECT DISTINCT p.no_control, p.idpg_pedidos,c.mensaje,c.fecha_hora, c.martha_rev  as rev_notif, (SELECT nombre FROM usuario WHERE idusuario=c.idusuario) as nom_usuario FROM chat c INNER JOIN pg_pedidos p ON c.idpedido=p.idpg_pedidos WHERE c.martha='$idusuario' ORDER BY c.fecha_hora DESC";
				return ejecutarConsulta($sql);

				
			}
			
	}

	

	public function num_observ_notif()
	{

		$sql="SELECT count(*) as num_notif_head FROM historial_mov WHERE notif='1' AND movimiento<>'Descuento solicitado'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function tbl_prod_ped($id)
	{

		$sql="SELECT dp.idproducto,p.imagen,p.nombre,p.codigo,dp.cantidad,dp.observacion, p.color FROM pg_detalle_pedidos dp INNER JOIN productos p ON dp.idproducto=p.idproducto  WHERE dp.idpg_pedidos='$id'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function buscar_reg_prod($id_ped_temp,$idproducto)
	{

		$sql="SELECT * FROM pg_detalle_pedidos WHERE idpg_pedidos='$id_ped_temp' AND idproducto='$idproducto' ";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function update_cant($id_ped_temp,$idproducto,$cantidad,$importe)
	{

		$sql="UPDATE pg_detalle_pedidos SET cantidad='$cantidad',importe='$importe' WHERE idpg_pedidos='$id_ped_temp' AND idproducto='$idproducto'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function update_observa($id_ped_temp,$idproducto,$input_obser_prod)
	{

		$sql="UPDATE pg_detalle_pedidos SET observacion='$input_obser_prod' WHERE idpg_pedidos='$id_ped_temp' AND idproducto='$idproducto'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function update_descrip($id_ped_temp,$idproducto,$input_nom_prod)
	{

		$sql="UPDATE pg_detalle_pedidos SET descripcion='$input_nom_prod' WHERE idpg_pedidos='$id_ped_temp' AND idproducto='$idproducto'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}
	public function borrar_prod($id_ped_temp,$idproducto)
	{

		$sql="DELETE FROM pg_detalle_pedidos WHERE idpg_pedidos='$id_ped_temp' AND idproducto='$idproducto'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function tbl_clientes($id)
	{
		if ($id=="Fabrica" OR  $id=="Zuno") {

			$sql="SELECT * FROM clientes WHERE (lugar='Fabrica' OR lugar='Zuno') AND nombre<>'' ORDER BY nombre asc LIMIT 5";
			//$sql="SELECT * FROM clientes WHERE lugar='$id' ORDER BY nombre asc LIMIT 5";
			return ejecutarConsulta($sql);	
		}elseif ($id<>"Fabrica" AND  $id<>"Zuno") {
			
			$sql2="SELECT * FROM clientes WHERE lugar='$id' AND nombre<>'' ORDER BY nombre";
			return ejecutarConsulta($sql2);

		}

		//$sql="SELECT * FROM clientes WHERE lugar='$id' ORDER BY nombre asc LIMIT 5";
						
	}


 	public function buscar_texto_tbl($id,$lugar_user)
	{

		$sql="SELECT * FROM clientes WHERE nombre LIKE '%".$id."%' OR no_cliente LIKE '%".$id."%' ORDER BY nombre asc";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function buscar_cliente($idcliente,$id_ped_temp)
	{
		$sql2="UPDATE clientes_detalle set idcliente='$idcliente' WHERE idpedido='$id_ped_temp'";
		ejecutarConsulta($sql2);

		$sql="SELECT * FROM clientes WHERE idcliente='$idcliente'";
		return ejecutarConsultaSimpleFila($sql);			
	}


	public function consul_ped_max($idcliente)
	{

		$sql="SELECT num_ped_cli FROM clientes_detalle WHERE idcliente='$idcliente' ORDER BY num_ped_cli DESC LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function buscar_datos_fac($idcliente)
	{
		$sql="SELECT * FROM dir_facturacion WHERE idcliente_fac='$idcliente'";
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function buscar_datos_ent($idcliente)
	{
		$sql="SELECT * FROM dir_entregas WHERE idcliente_ent='$idcliente' AND estatus='1' LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);			
	}




	




	public function update_dir_fac($idcliente,$razon_edit,$rfc_edit,$calle_edit,$numero_edit,$interior_edit,$colonia_edit,$municipio_edit,$estado_edit,$cp_edit,$tel_edit,$email_edit)
	{

		$sql="UPDATE dir_facturacion SET razon_fac='$razon_edit',rfc_fac='$rfc_edit',calle_fac='$calle_edit',numero_fac='$numero_edit',interior_fac='$interior_edit',colonia_fac='$colonia_edit',ciudad_fac='$municipio_edit',estado_fac='$estado_edit',cp_fac='$cp_edit',telefono_fac='$tel_edit',email_fac='$email_edit'  WHERE idcliente_fac='$idcliente' ";
		return ejecutarConsulta($sql);
		
	}

	public function insert_dir_fac($idcliente,$razon_edit,$rfc_edit,$calle_edit,$numero_edit,$interior_edit,$colonia_edit,$municipio_edit,$estado_edit,$cp_edit,$tel_edit,$email_edit)
	{

		$sql="INSERT INTO dir_facturacion (idcliente_fac,razon_fac,rfc_fac,calle_fac,numero_fac,interior_fac,colonia_fac,ciudad_fac,estado_fac,cp_fac,telefono_fac,email_fac) VALUES ('$idcliente','$razon_edit','$rfc_edit','$calle_edit','$numero_edit','$interior_edit','$colonia_edit','$municipio_edit','$estado_edit','$cp_edit','$tel_edit','$email_edit') ";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM dir_facturacion WHERE iddir_facturacion='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);
		
	}


	public function listar_direcciones($id)
	{
		$sql="SELECT * FROM dir_entregas WHERE idcliente_ent='$id'";
		return ejecutarConsulta($sql);		
	}


	public function save_dir_ent($id_cliente,$contacto_upd,$calle_upd,$numero_upd,$int_upd,$colonia_upd,$ciudad_upd,$estado_upd,$cp_upd,$telefono_upd,$email_upd,$fecha_entrega_upd,$hora_entrega_upd,$hora_entrega_upd_r2,$forma_entrega_upd,$det_forma_entrega_upd,$referencia_upd)
	{

		

		$sql1="UPDATE dir_entregas SET estatus = 0 WHERE idcliente_ent='$id_cliente'";
		ejecutarConsulta($sql1);

		$sql="INSERT INTO dir_entregas (idcliente_ent,contacto_ent,calle_ent,numero_ent,interior_ent,colonia_ent,ciudad_ent,estado_ent,cp_ent,telefono_ent,email_ent,fecha_entrega_ent,hora_entrega_r1,hora_entrega_r2,forma_entrega_ent,det_forma_entrega,referencia_ent,estatus) VALUES ('$id_cliente','$contacto_upd','$calle_upd','$numero_upd','$int_upd','$colonia_upd','$ciudad_upd','$estado_upd','$cp_upd','$telefono_upd','$email_upd','$fecha_entrega_upd','$hora_entrega_upd','$hora_entrega_upd_r2','$forma_entrega_upd','$det_forma_entrega_upd','$referencia_upd','1') ";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM dir_entregas WHERE identregas='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);
		
	}


	public function guardar_dir_entrega($id_ped_temp,$identregas)
	{
		$sql="INSERT INTO dir_entregas_esp (idpedido,identrega_referencia,contacto_ent,calle_ent,numero_ent,interior_ent,colonia_ent,ciudad_ent,estado_ent,cp_ent,telefono_ent,email_ent,fecha_entrega_ent,hora_entrega_r1,hora_entrega_r2,forma_entrega_ent,det_forma_entrega,referencia_ent) SELECT '$id_ped_temp',identregas,contacto_ent,calle_ent,numero_ent,interior_ent,colonia_ent,ciudad_ent,estado_ent,cp_ent,telefono_ent,email_ent,fecha_entrega_ent,hora_entrega_r1,hora_entrega_r2,forma_entrega_ent,det_forma_entrega,referencia_ent FROM dir_entregas WHERE identregas='$identregas'";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM dir_entregas_esp WHERE identregas='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);
	}

	public function guardar_dir_fact($id_ped_temp,$idfacturacion)
	{
		$sql="INSERT INTO dir_facturacion_esp (idpedido,idfacturacion_referencia,razon_fac,rfc_fac,calle_fac,numero_fac,interior_fac,colonia_fac,ciudad_fac,estado_fac,cp_fac,telefono_fac,email_fac) SELECT '$id_ped_temp',iddir_facturacion,razon_fac,rfc_fac,calle_fac,numero_fac,interior_fac,colonia_fac,ciudad_fac,estado_fac,cp_fac,telefono_fac,email_fac FROM dir_facturacion WHERE iddir_facturacion='$idfacturacion'";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM dir_facturacion_esp WHERE iddir_facturacion_esp='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);		
	}

	public function guardar_pedido($id_ped_temp,$fecha_pedido,$id_cliente,$no_pedido_lugar,$condiciones,$ultimo_control,$asesor,$persona_pedido,$cliente_nuevo,$medio,$lab,$autorizacion,$id_retorno_ent,$fecha_entrega,$hora_entrega,$hora_entrega2,$forma_entrega,$det_forma_ent,$id_retorno_fac,$reglamentos,$empaque,$metodo_pago,$forma_pago,$uso_cfdi,$fecha_envio_enlace,$salida,$factura,$otros,$idusuario,$max_ped_cli,$cant_prod_ped_new)
	{

		$sql2="UPDATE clientes_detalle SET num_ped_cli='$max_ped_cli'+1 WHERE idpedido='$id_ped_temp'";
		ejecutarConsulta($sql2);

		$sql="UPDATE pg_pedidos SET fecha_pedido='$fecha_pedido',estatus='Control PG',idcliente='$id_cliente',no_pedido='$no_pedido_lugar',condiciones='$condiciones',no_control='$ultimo_control',asesor='$asesor',levanto_pedido='$persona_pedido',cliente_nuevo='$cliente_nuevo',medio='$medio',lab='$lab',autorizacion='$autorizacion',id_entrega='$id_retorno_ent',fecha_entrega='$fecha_entrega',hora_entrega='$hora_entrega',hora_entrega2='$hora_entrega2',forma_entrega='$forma_entrega',det_forma_ent='$det_forma_ent',idfacturacion='$id_retorno_fac',reglamentos='$reglamentos',empaque='$empaque',metodo_pago='$metodo_pago',forma_pago='$forma_pago',uso_cfdi='$uso_cfdi',fecha_envio_enlace='$fecha_envio_enlace',salida='$salida',factura='$factura',otros='$otros',firma_cliente='',firma_prod='',reviso='',observaciones='',idusuario='$idusuario',aplicar_iva='Si',estatus2='1', cant_prod_pedido='$cant_prod_ped_new' WHERE idpg_pedidos='$id_ped_temp' ";
		return ejecutarConsulta($sql);
		
	}

	public function enviar_pedido($id_ped_temp)
	{
		$sql="UPDATE pg_pedidos SET estatus2='1' WHERE idpg_pedidos='$id_ped_temp'";
		return ejecutarConsulta($sql);		
	}

	public function select_dir_ent($identregas)
	{
		$sql="SELECT * FROM dir_entregas WHERE identregas='$identregas'";
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function update_dir_ent($identrega_upd,$idcliente_upd,$contacto_upd,$calle_upd,$numero_upd,$int_upd,$colonia_upd,$ciudad_upd,$estado_upd,$cp_upd,$telefono_upd,$email_upd,$fecha_entrega_upd,$hora_entrega_upd,$hora_entrega_upd_r2,$forma_entrega_upd,$det_forma_entrega_upd,$referencia_upd,$doc_ped_sal,$id_ped_temp2)
	{

		if ($doc_ped_sal==2) {
			$sql_id2="INSERT INTO documentos (idpedido,nombre,tipo) VALUES('$id_ped_temp2','Autorización de entrega sin factura o recibo','1')";
        	ejecutarConsulta($sql_id2);
		}

		$sql1="UPDATE dir_entregas SET estatus='0' WHERE idcliente_ent='$idcliente_upd' ";
	    ejecutarConsulta($sql1);

		$sql="UPDATE dir_entregas SET contacto_ent='$contacto_upd',calle_ent='$calle_upd',numero_ent='$numero_upd',interior_ent='$int_upd',colonia_ent='$colonia_upd',ciudad_ent='$ciudad_upd',estado_ent='$ciudad_upd',estado_ent='$estado_upd',cp_ent='$cp_upd',telefono_ent='$telefono_upd',email_ent='$email_upd',fecha_entrega_ent='$fecha_entrega_upd',hora_entrega_r1='$hora_entrega_upd',hora_entrega_r2='$hora_entrega_upd_r2',forma_entrega_ent='$forma_entrega_upd',det_forma_entrega='$det_forma_entrega_upd',referencia_ent='$referencia_upd',estatus='1' WHERE identregas='$identrega_upd' ";
		return ejecutarConsulta($sql);		
	}


	public function save_cliente($lugar_user,$num_cli,$nom_cli,$rfc_cli,$calle_cli,$numero_cli,$int_cli,$colonia_cli,$ciudad_cli,$estado_cli,$cp_cli,$telefono_cli,$email_cli)
	{

		$sql="INSERT INTO clientes (no_cliente,nombre,rfc,telefono,calle,numero,interior,colonia,municipio,estado,cp,email,estatus,lugar) VALUES ('$num_cli','$nom_cli','$rfc_cli','$telefono_cli','$calle_cli','$numero_cli','$int_cli','$colonia_cli','$ciudad_cli','$estado_cli','$cp_cli','$email_cli','1','$lugar_user') ";
		return ejecutarConsulta($sql);
		
	}


	public function buscar_cliente2($id)
	{

		$sql="SELECT * FROM clientes WHERE nombre LIKE '%".$id."%' ORDER BY nombre asc";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}


	public function tbl_rep_pedido_consul($id)
	{

		$sql="SELECT pg.cantidad,pg.unidad,pg.codigo,pg.descripcion,pg.precio,pg.medida,p.idproducto,pg.descuento,pg.descuento_cant,pg.importe,pg.color,ped.idusuario, pg.observacion, (SELECT estatus FROM pg_detped WHERE iddetalle_pedido=pg.idpg_detalle_pedidos LIMIT 1) as estatus FROM pg_detalle_pedidos pg INNER JOIN productos p ON pg.idproducto = p.idproducto INNER JOIN muebles_fam m ON p.idmuebles_fam=m.idmuebles_fam INNER JOIN pg_pedidos ped ON pg.idpg_pedidos=ped.idpg_pedidos WHERE pg.idpg_pedidos='$id'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function pie_reporte($id_ped_temp)
	{

		$sql="SELECT SUM(pg.importe) as suma_importe, (SUM(pg.importe)*0.16) as iva_ped,(SELECT aplicar_iva FROM pg_pedidos WHERE idpg_pedidos='$id_ped_temp') as aplicar_iva  FROM pg_detalle_pedidos pg INNER JOIN productos p ON pg.idproducto = p.idproducto WHERE idpg_pedidos='$id_ped_temp'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function consul_datos_control($id_ped_temp)
	{

		$sql="SELECT p.fecha_pedido,c.no_cliente,p.no_pedido,p.condiciones,p.no_control,p.asesor,p.levanto_pedido,p.cliente_nuevo,p.medio,p.lab,p.autorizacion,p.id_entrega,p.fecha_entrega,p.hora_entrega,p.forma_entrega,p.idfacturacion,p.reglamentos,p.empaque,p.metodo_pago,p.forma_pago,p.uso_cfdi,p.fecha_envio_enlace,p.salida,p.factura,p.otros,p.firma_cliente,p.firma_prod,p.reviso,p.observaciones,c.nombre as nombre_cliente_gen, p.tipo FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente=c.idcliente WHERE p.idpg_pedidos='$id_ped_temp' ";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function consul_datos_facturacion($id_ped_temp)
	{

		$sql="SELECT df.razon_fac,df.rfc_fac,df.calle_fac,df.numero_fac,df.interior_fac,df.colonia_fac,df.ciudad_fac,df.estado_fac,df.telefono_fac,df.email_fac,df.cp_fac FROM pg_pedidos p INNER JOIN dir_facturacion_esp df ON p.idpg_pedidos=df.idpedido WHERE p.idpg_pedidos='$id_ped_temp' ";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function consul_datos_entrega($id_ped_temp)
	{

		$sql="SELECT de.contacto_ent,de.calle_ent,de.numero_ent,de.interior_ent,de.colonia_ent,de.ciudad_ent,de.estado_ent,de.cp_ent,de.telefono_ent,de.email_ent,DATE(p.fecha_entrega) as fecha_entrega_ent,de.hora_entrega_r1,de.hora_entrega_r2,de.forma_entrega_ent,de.det_forma_entrega,de.referencia_ent,p.no_control,p.no_pedido FROM pg_pedidos p INNER JOIN dir_entregas_esp de ON p.idpg_pedidos=de.idpedido WHERE p.idpg_pedidos='$id_ped_temp'";
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function update_observ($id_ped_temp,$observ,$nom_fir_cli_rep,$nom_fir_prod_rep,$reviso_rep)
	{

		$sql="UPDATE pg_pedidos SET observaciones='$observ',firma_cliente='$nom_fir_cli_rep',firma_prod='$nom_fir_prod_rep',reviso='$reviso_rep' WHERE idpg_pedidos='$id_ped_temp'  ";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function update_prod_rep($id_ped_temp,$idproducto_rep,$cantidad_rep,$unidad_rep,$codigo_rep,$medida_rep,$descripcion_rep,$color_rep,$precio_rep,$descuento_rep,$descuento_rep2,$importe_rep)
	{

		$sql="UPDATE pg_detalle_pedidos SET cantidad='$cantidad_rep',unidad='$unidad_rep',codigo='$codigo_rep',medida='$medida_rep',descripcion='$descripcion_rep',precio='$precio_rep',descuento='$descuento_rep',descuento_cant='$descuento_rep2',importe='$importe_rep',color='$color_rep' WHERE idpg_pedidos='$id_ped_temp' AND idproducto='$idproducto_rep'  ";
		return ejecutarConsulta($sql);

		/*$sql1="UPDATE productos SET medida='$medida_rep',nombre='$descripcion_rep',precio_total='$precio_rep' WHERE idproducto='$idproducto_rep' ";
		return ejecutarConsulta($sql1);	*/			
	}



	public function buscar_prod_rep($id_ped_temp,$idproducto)
	{

		$sql="SELECT pg.cantidad,pg.unidad,p.codigo,p.nombre as descripcion,pg.precio,p.medida,p.idproducto,pg.descuento,pg.importe FROM pg_detalle_pedidos pg INNER JOIN productos p ON pg.idproducto = p.idproducto WHERE pg.idpg_pedidos='$id_ped_temp' AND pg.idproducto='$idproducto' ";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function listar_pedidos_v2()
	{

		$sql="SELECT p.coment_vencim,p.tipo, p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs,p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2='1' ORDER BY p.fecha_pedido desc LIMIT 30";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function listar_pedidos($id,$num,$marca,$lugar)
	{
			

		if ($lugar<>"Fabrica") {
			
			if ($marca==1) {

				if ($num==1) {
					
					$sql="SELECT p.coment_vencim,p.tipo, p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs,p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);

				}

				if ($num==2) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='ENTREGADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==3) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus!='ENTREGADO' AND p.estatus!='CANCELADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==4) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='APARTADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==5) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='FABRICADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==6) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='EXISTENCIA' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==7) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='CANCELADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==8) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='PENDIENTE' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==9) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='LISTO PARA ENTREGA' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}
				# code...
			}


			if ($marca==2) {

				if ($num==1) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);

				}

				if ($num==2) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='ENTREGADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==3) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus!='ENTREGADO' AND p.estatus!='CANCELADO' AND p.estatus='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==4) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='APARTADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==5) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='FABRICADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==6) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='EXISTENCIA' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==7) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='CANCELADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==8) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='PENDIENTE' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==9) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='LISTO PARA ENTREGA' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}
				# code...
			}
		}elseif ($lugar=="Fabrica") {
			
			if ($marca==1) {

				if ($num==1) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);

				}

				if ($num==2) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='ENTREGADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==3) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus!='ENTREGADO' AND p.estatus!='CANCELADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==4) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='APARTADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==5) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='FABRICADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==6) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='EXISTENCIA' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==7) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='CANCELADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==8) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='PENDIENTE' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==9) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='LISTO PARA ENTREGA' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}
				# code...
			}


			if ($marca==2) {

				if ($num==1) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);

				}

				if ($num==2) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='ENTREGADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==3) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus!='ENTREGADO' AND p.estatus!='CANCELADO' AND p.estatus='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==4) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='APARTADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==5) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='FABRICADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==6) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='EXISTENCIA' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==7) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='CANCELADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==8) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='PENDIENTE' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==9) {
					
					$sql="SELECT p.coment_vencim,p.tipo,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='LISTO PARA ENTREGA' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}
				# code...
			}
		}
			

			

						
	}



	public function listar_pedidos3($id,$lugar,$no_control_buscar)
	{
			

		if ($lugar<>"Fabrica") {
			

					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.no_control='$no_control_buscar'";
					return ejecutarConsulta($sql);

				

				
			
		}elseif ($lugar=="Fabrica") {
			
				
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.no_control='$no_control_buscar'";
					return ejecutarConsulta($sql);
			
		}
			
						
	}



	public function listar_pedidos3_2($id,$lugar,$cliente_buscar)
	{
			

		if ($lugar<>"Fabrica") {
			

					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.idcliente='$cliente_buscar'";
					return ejecutarConsulta($sql);

				

				
			
		}elseif ($lugar=="Fabrica") {
			
				
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega,(SELECT count(idavance_prod) FROM op_avance_prod WHERE idpedido=p.idpg_pedidos AND comentario<>'') as num_obs_prod FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.idcliente='$cliente_buscar'";
					return ejecutarConsulta($sql);
			
		}
			
						
	}



	

	public function ultimo_control()
	{

		$sql="SELECT COUNT(idpg_pedidos) as no_control FROM pg_pedidos WHERE estatus2=1";
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function ultimo_pedido_lugar($lugar)
	{

		$sql="SELECT COUNT(p.no_pedido) as no_pedido_lugar FROM pg_pedidos p INNER JOIN usuario u ON p.idusuario=u.idusuario WHERE p.no_pedido>0 AND u.lugar='$lugar'";
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function tbl_productos()
	{

		$sql="SELECT * FROM productos ORDER BY codigo asc LIMIT 5";
		return ejecutarConsulta($sql);			
	}

	public function buscar_texto_tbl_prod($id)
	{

		$sql="SELECT * FROM productos WHERE nombre LIKE '%".$id."%' OR codigo LIKE '%".$id."%' ORDER BY nombre asc";
		return ejecutarConsulta($sql);			
	}


	public function buscar_prod_exist($id)
	{

		$sql="SELECT * FROM productos WHERE codigo LIKE '%".$id."%' ORDER BY codigo asc";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function consul_exist_prod($codigo_new_prod)
	{

		$sql="SELECT count(codigo) as num_productos FROM productos WHERE codigo='$codigo_new_prod'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);			
	}



	public function save_prod($tipo_prod,$codigo_new_prod,$nombre_new_prod,$color_new_prod,$medida_new_prod,$precio_new_prod)
	{

		$sql="INSERT INTO productos(idmuebles_fam,codigo,nombre,color,medida,precio_total) VALUES('$tipo_prod','$codigo_new_prod','$nombre_new_prod','$color_new_prod','$medida_new_prod','$precio_new_prod')";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function num_entregas($id_ped_temp)
	{

		$sql="SELECT count(identregas) as num_entregas FROM entregas WHERE idpedido='$id_ped_temp'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function listar_productos_pedido($id)
	{

		$sql="SELECT p.codigo,p.nombre,dp.cantidad,dp.entregados,dp.entregados2 FROM pg_detalle_pedidos dp INNER JOIN productos p ON dp.idproducto=p.idproducto WHERE dp.idpg_pedidos = '$id'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function listar_entregas($id)
	{

		$sql="SELECT * FROM entregas WHERE idpedido = '$id' AND estatus=1 ORDER BY identregas desc";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function consul_idcliente($id_ped_temp)
	{

		$sql="SELECT * FROM pg_pedidos WHERE idpg_pedidos='$id_ped_temp'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function consul_dir_ent($iddir_entrega)
	{

		$sql="SELECT * FROM dir_entregas WHERE identregas='$iddir_entrega'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function consul_cliente($idcliente)
	{

		$sql="SELECT nombre as nom_cliente FROM clientes WHERE idcliente='$idcliente'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);			
	}


	public function reg_entrega($id_ped_temp)
	{

		$sql="INSERT INTO entregas(idpedido,estatus) VALUES('$id_ped_temp','0')";
		//return ejecutarConsultaSimpleFila($sql);
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM entregas WHERE identregas='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);			
	}

	public function listar_prod_entregas($id)
	{

		$sql="SELECT dp.idpg_detalle_pedidos,p.codigo,p.nombre,p.medida,dp.cantidad,dp.precio,dp.entregados FROM pg_detalle_pedidos dp INNER JOIN productos p ON dp.idproducto=p.idproducto WHERE dp.idpg_pedidos='$id'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}

	public function consul_det_ped($idpg_detalle_pedidos)
	{

		$sql="SELECT dp.cantidad,p.codigo,p.nombre FROM pg_detalle_pedidos dp INNER JOIN productos p ON dp.idproducto=p.idproducto WHERE dp.idpg_detalle_pedidos='$idpg_detalle_pedidos'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function consul_exist_ent_p($identregas,$idpg_detalle_pedidos)
	{

		$sql="SELECT COUNT(*) as num_prod FROM entregas_detalle WHERE identregas='$identregas' AND iddetalle_pedido='$idpg_detalle_pedidos'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);		
	}


	public function pasar_prod($identregas,$idpg_detalle_pedidos,$cantidad,$codigo,$nombre)
	{

		$sql="INSERT INTO entregas_detalle (identregas,iddetalle_pedido,cantidad,codigo,nombre) VALUES('$identregas','$idpg_detalle_pedidos','$cantidad','$codigo','$nombre')";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}

	public function listar_prod_entr($id)
	{

		$sql="SELECT * FROM entregas_detalle WHERE identregas='$id'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}

	public function upd_cant_prod_ent($identregas_detalle,$cantidad)
	{

		

		$sql="UPDATE entregas_detalle SET cantidad='$cantidad' WHERE identregas_detalle='$identregas_detalle'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}

	public function upd_lote_prod_ent($identregas_detalle,$lote)
	{

		$sql="UPDATE entregas_detalle SET lote='$lote' WHERE identregas_detalle='$identregas_detalle'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}

	public function save_entrega($identregas,$fecha_sal,$no_salida_sal,$no_control_sal,$no_pedido_sal,$nombre_sal,$entregado_a_sal,$domicilio_sal,$colonia_sal,$municipio_sal,$estado_sal,$cp_sal,$contacto_sal,$telefono_sal,$horario_sal,$condiciones_sal,$medio_sal)
	{
		

		$sql="UPDATE entregas SET fecha='$fecha_sal',no_salida='$no_salida_sal', no_control='$no_control_sal',no_pedido='$no_pedido_sal',nombre='$nombre_sal',entregado_a='$entregado_a_sal',dom='$domicilio_sal',col='$colonia_sal',mun='$municipio_sal',est='$estado_sal',cp='$cp_sal',contacto='$contacto_sal',tel='$telefono_sal',horario='$horario_sal',condiciones='$condiciones_sal',medio_transporte='$medio_sal' WHERE identregas='$identregas'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function update_estatus_entrega($identregas)
	{

		$sql="UPDATE entregas SET estatus='1' WHERE identregas='$identregas'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}

	public function ini_id_ent($identregas)
	{

		$sql="SELECT identregas_detalle as identregas_detalle_ini,iddetalle_pedido as det_ped_ini FROM entregas_detalle WHERE identregas='$identregas' ORDER BY identregas_detalle asc LIMIT 1";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function fin_id_ent($identregas)
	{

		$sql="SELECT identregas_detalle as identregas_detalle_fin,iddetalle_pedido as det_ped_fin FROM entregas_detalle WHERE identregas='$identregas' ORDER BY identregas_detalle desc LIMIT 1";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);		
	}


	public function upd_ped_temp_ent1($identregas,$det_ped_ini,$det_ped_fin)
	{
		while ($det_ped_ini <= $det_ped_fin) {

			$sql2="UPDATE entregas_detalle SET estatus = 1 WHERE identregas='$identregas' AND iddetalle_pedido='$det_ped_ini'";
			//return ejecutarConsultaSimpleFila($sql);
			 ejecutarConsulta($sql2);


			$sql="UPDATE pg_detalle_pedidos SET entregados = entregados + (SELECT cantidad FROM entregas_detalle WHERE iddetalle_pedido='$det_ped_ini' AND identregas='$identregas') WHERE idpg_detalle_pedidos='$det_ped_ini'";
			//return ejecutarConsultaSimpleFila($sql);
			 ejecutarConsulta($sql);

		$det_ped_ini = $det_ped_ini + 1;

			 if ($det_ped_ini>$det_ped_fin) {
				return;
			 }
		}

				
	}

	public function detalle_entrega_ped($identregas)
	{

		$sql="SELECT DATE(fecha) as fecha,no_salida,no_control,no_pedido,nombre,entregado_a,dom,col,mun,est,cp,contacto,tel,horario,condiciones,medio_transporte FROM entregas WHERE identregas='$identregas'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function listar_det_entrega($id)
	{

		$sql="SELECT codigo,nombre,cantidad,lote FROM entregas_detalle  WHERE identregas='$id'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}


	public function resp_ped_temp_ent($identregas,$det_ped_ini,$det_ped_fin)
	{
		while ($det_ped_ini <= $det_ped_fin) {
			$sql="UPDATE entregas_detalle SET cantidad_enterior = cantidad WHERE iddetalle_pedido='$det_ped_ini' AND identregas='$identregas'";
			//return ejecutarConsultaSimpleFila($sql);
			 ejecutarConsulta($sql);

		$det_ped_ini = $det_ped_ini + 1;

			 if ($det_ped_ini>$det_ped_fin) {
				return;
			 }
		}

				
	}

	public function rest_ped_temp_ent($identregas,$det_ped_ini,$det_ped_fin)
	{
		while ($det_ped_ini <= $det_ped_fin) {
			$sql="UPDATE pg_detalle_pedidos SET entregados = entregados - (SELECT cantidad_enterior FROM entregas_detalle WHERE iddetalle_pedido='$det_ped_ini' AND identregas='$identregas') WHERE idpg_detalle_pedidos='$det_ped_ini'";
			//return ejecutarConsultaSimpleFila($sql);
			 ejecutarConsulta($sql);

		$det_ped_ini = $det_ped_ini + 1;

			 if ($det_ped_ini>$det_ped_fin) {
				return;
			 }
		}

				
	}

	public function upd_ped_temp_ent2($identregas,$det_ped_ini,$det_ped_fin)
	{
		while ($det_ped_ini <= $det_ped_fin) {
			$sql="UPDATE pg_detalle_pedidos SET entregados = entregados + (SELECT cantidad FROM entregas_detalle WHERE iddetalle_pedido='$det_ped_ini' AND identregas='$identregas') WHERE idpg_detalle_pedidos='$det_ped_ini'";
			//return ejecutarConsultaSimpleFila($sql);
			 ejecutarConsulta($sql);

		$det_ped_ini = $det_ped_ini + 1;

			 if ($det_ped_ini>$det_ped_fin) {
				return;
			 }
		}

				
	}



	public function upd_entrega($identregas,$fecha_sal,$no_salida_sal,$no_control_sal,$no_pedido_sal,$nombre_sal,$entregado_a_sal,$domicilio_sal,$colonia_sal,$municipio_sal,$estado_sal,$cp_sal,$contacto_sal,$telefono_sal,$horario_sal,$condiciones_sal,$medio_sal)
	{
		

		$sql="UPDATE entregas SET fecha='$fecha_sal',no_salida='$no_salida_sal',no_control='$no_control_sal',no_pedido='$no_pedido_sal',nombre='$nombre_sal',entregado_a='$entregado_a_sal',dom='$domicilio_sal',col='$colonia_sal',mun='$municipio_sal',est='$estado_sal',cp='$cp_sal',contacto='$contacto_sal',tel='$telefono_sal',horario='$horario_sal',condiciones='$condiciones_sal',medio_transporte='$medio_sal' WHERE identregas='$identregas'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}


	public function borrar_entrega($identregas)
	{

		$sql="UPDATE entregas SET estatus=3 WHERE identregas='$identregas'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}


	public function restar_cant_ped($identregas,$det_ped_ini,$det_ped_fin)
	{
		while ($det_ped_ini <= $det_ped_fin) {
			$sql="UPDATE pg_detalle_pedidos SET entregados = entregados - (SELECT cantidad FROM entregas_detalle WHERE iddetalle_pedido='$det_ped_ini' AND identregas='$identregas') WHERE idpg_detalle_pedidos='$det_ped_ini'";
			//return ejecutarConsultaSimpleFila($sql);
			 ejecutarConsulta($sql);

		$det_ped_ini = $det_ped_ini + 1;

			 if ($det_ped_ini>$det_ped_fin) {
				return;
			 }
		}

				
	}


	


	public function borrar_detalle_ent($identregas_detalle)
	{

		$sql="DELETE FROM entregas_detalle WHERE identregas_detalle='$identregas_detalle'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}

	public function restar_cantidad_ped_det($identregas_detalle,$iddetalle_pedido)
	{

		$sql="UPDATE pg_detalle_pedidos SET entregados=entregados-(SELECT cantidad FROM entregas_detalle WHERE identregas_detalle='$identregas_detalle') WHERE idpg_detalle_pedidos='$iddetalle_pedido'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}

	public function abrir_seg_ped($id)
	{

		$sql="SELECT idpedido,comentario,color,fecha FROM estatus_pedido_fab WHERE idpedido='$id' ORDER BY idestatus_pedido_fab DESC";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}

	public function guardar_coment_ped($coment,$color,$idpedido,$fecha,$estatus,$color_barra_s,$porc_av_p,$dias_restantes,$idusuario,$num_pedido)
	{

		if ($num_pedido==0) {

			$sql_5="INSERT INTO notif (idpedido,idusuario,mensaje,fecha_hora,estatus,estatus2) VALUES ('$idpedido','$idusuario','Pedido completado','$fecha','1','1')";
			ejecutarConsulta($sql_5);

			$sql="INSERT INTO estatus_pedido_fab (idpedido,comentario,color,fecha) VALUES('$idpedido','$coment','$color','$fecha')";
			ejecutarConsulta($sql);

			$sql2="UPDATE pg_pedidos SET color_status='$color',estatus='$estatus',color_barra='$color_barra_s',porc_av='$porc_av_p',dias_rest='$dias_restantes' WHERE idpg_pedidos='$idpedido'";
			return ejecutarConsulta($sql2);

		}elseif ($num_pedido>0) {


			$sql="INSERT INTO estatus_pedido_fab (idpedido,comentario,color,fecha) VALUES('$idpedido','$coment','$color','$fecha')";
			ejecutarConsulta($sql);

			$sql2="UPDATE pg_pedidos SET color_status='$color',estatus='$estatus',color_barra='$color_barra_s',porc_av='$porc_av_p',dias_rest='$dias_restantes' WHERE idpg_pedidos='$idpedido'";
			return ejecutarConsulta($sql2);

		}


			
	}


	public function abrir_doc_ped($id)
	{

		$sql="SELECT iddocumentos,idpedido,nombre,tipo FROM documentos WHERE idpedido='$id' AND nombre<>'' AND nombre<>'Sin doc' ORDER BY iddocumentos DESC";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}

	public function guardar_comprobante($nom,$idpedido_doc)
	{
			
			$sql="UPDATE notif SET estatus2='2' WHERE idpedido='$idpedido_doc'";
			ejecutarConsulta($sql);
			
			$sql="INSERT INTO documentos (idpedido,nombre) VALUES('$idpedido_doc','$nom')";
			$idingresonew=ejecutarConsulta_retornarID($sql);

			$sql_id="SELECT * FROM documentos WHERE iddocumentos='$idingresonew'";
        	return ejecutarConsultaSimpleFila($sql_id);

			
	
	}

	public function set_fecha_hora_entr($id_ped_temp,$fecha_entrega_upd2,$hora_entrega_upd2,$hora_entrega_upd2_2,$fecha_hora,$idusuario)
	{
		$sql="INSERT INTO historial_mov (movimiento,idusuario,idpedido,fecha_hora) VALUES ('Asignación de fecha de entrega','$idusuario','$id_ped_temp','$fecha_hora')";
		ejecutarConsulta($sql);

		$sql2="UPDATE pg_pedidos SET fecha_entrega='$fecha_entrega_upd2',hora_entrega='$hora_entrega_upd2',hora_entrega2='$hora_entrega_upd2_2'
		WHERE idpg_pedidos='$id_ped_temp' ";
		ejecutarConsulta($sql2);

		$sql3="UPDATE pg_pedidos p SET p.fecha_ent_cliente=IF(CONCAT(ELT(WEEKDAY(p.fecha_entrega) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'))='Viernes',
					(DATE_ADD(p.fecha_entrega,INTERVAL 3 DAY)),
					(DATE_ADD(p.fecha_entrega,INTERVAL 1 DAY))
					) WHERE p.idpg_pedidos='$id_ped_temp' ";
		ejecutarConsulta($sql3);

		$sql4="UPDATE dir_entregas_esp SET fecha_entrega_ent='$fecha_entrega_upd2',hora_entrega_r1='$hora_entrega_upd2',hora_entrega_r2='$hora_entrega_upd2_2' WHERE idpedido='$id_ped_temp' ";
		return ejecutarConsulta($sql4);
	
	}


	public function upd_salida_ped($id_ped_temp,$no_salida_sal)
	{
		$sql="UPDATE pg_pedidos SET salida=concat(salida,',  ','$no_salida_sal') WHERE idpg_pedidos='$id_ped_temp' ";
		return ejecutarConsulta($sql);
	
	}

	public function cargar_modelo($id)
	{
		$sql="SELECT * FROM productos WHERE codigo='$id'";
		return ejecutarConsulta($sql);
	
	}

	public function consul_lugar($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	
	}

	public function consulta_pedido($id)
	{
		$sql="SELECT p.fecha_pedido,c.no_cliente,p.no_pedido,p.condiciones,p.no_control,p.asesor,p.levanto_pedido,p.cliente_nuevo,p.medio,p.lab,p.autorizacion,df.razon_fac,df.rfc_fac,concat(df.calle_fac,' #',df.numero_fac,' Int.:',df.interior_fac) as domicilio_fac,df.colonia_fac,df.ciudad_fac,df.estado_fac,df.cp_fac,df.telefono_fac,df.email_fac,p.empaque,p.reglamentos,p.metodo_pago,p.forma_pago,p.uso_cfdi,p.fecha_envio_enlace,p.salida,p.factura,p.otros,p.reviso,p.firma_cliente,p.firma_prod,p.subtotal,p.iva,p.total,de.contacto_ent,concat(de.calle_ent,' #',de.numero_ent,' Int.:',de.interior_ent) as domicilio_ent,de.colonia_ent,de.ciudad_ent,de.estado_ent,de.cp_ent,de.telefono_ent,de.email_ent,de.fecha_entrega_ent,concat(de.hora_entrega_r1,' - ',de.hora_entrega_r2) as horario_ent,de.forma_entrega_ent,de.det_forma_entrega,de.referencia_ent,p.observaciones,p.idusuario, c.nombre as cliente_nom FROM pg_pedidos p INNER JOIN dir_entregas_esp de ON p.id_entrega=de.identregas INNER JOIN dir_facturacion_esp df ON p.idfacturacion=df.iddir_facturacion_esp INNER JOIN clientes c ON p.idcliente=c.idcliente WHERE idpg_pedidos='$id'";
		return ejecutarConsulta($sql);
	}

	public function detalle_pedido($id)
	{
		$sql="SELECT * FROM pg_detalle_pedidos WHERE idpg_pedidos='$id' AND estatus<>'Cancelado'";
		return ejecutarConsulta($sql);
	}

	public function upd_importes($id_ped_temp,$subtotal,$iva_fixed,$total_fixed,$aplic_iva)
	{
		$sql="UPDATE pg_pedidos SET subtotal='$subtotal',iva='$iva_fixed',total='$total_fixed', aplicar_iva='$aplic_iva' WHERE idpg_pedidos='$id_ped_temp'";
		return ejecutarConsulta($sql);
	}

	public function guardar_op($idpg_pedidos,$num_op)
	{
		$sql="UPDATE pg_pedidos SET op='$num_op' WHERE idpg_pedidos='$idpg_pedidos'";
		return ejecutarConsulta($sql);
	}

	public function listar_pedidos2($id,$num,$marca,$lugar)
	{
			

		if ($lugar<>"Fabrica") {
			
			if ($marca==1) {

				if ($num==1) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);

				}

				if ($num==2) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='ENTREGADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==3) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus!='ENTREGADO' AND p.estatus!='CANCELADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==4) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='APARTADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==5) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='FABRICADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==6) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='EXISTENCIA' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==7) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='CANCELADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==8) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='PENDIENTE' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==9) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='LISTO PARA ENTREGA' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}
				# code...
			}


			if ($marca==2) {

				if ($num==1) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);

				}

				if ($num==2) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='ENTREGADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==3) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus!='ENTREGADO' AND p.estatus!='CANCELADO' AND p.estatus='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==4) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='APARTADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==5) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='FABRICADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==6) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='EXISTENCIA' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==7) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='CANCELADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==8) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='PENDIENTE' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==9) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.estatus='LISTO PARA ENTREGA' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}
				# code...
			}
		}elseif ($lugar=="Fabrica") {
			
			if ($marca==1) {

				if ($num==1) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);

				}

				if ($num==2) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='ENTREGADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==3) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus!='ENTREGADO' AND p.estatus!='CANCELADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==4) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='APARTADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==5) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='FABRICADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==6) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='EXISTENCIA' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==7) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='CANCELADO' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==8) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='PENDIENTE' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==9) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='LISTO PARA ENTREGA' AND p.estatus2='1' ORDER BY p.fecha_pedido desc";
					return ejecutarConsulta($sql);
					
				}
				# code...
			}


			if ($marca==2) {

				if ($num==1) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);

				}

				if ($num==2) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='ENTREGADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==3) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus!='ENTREGADO' AND p.estatus!='CANCELADO' AND p.estatus='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==4) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='APARTADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==5) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='FABRICADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==6) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='EXISTENCIA' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==7) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='CANCELADO' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==8) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='PENDIENTE' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}

				if ($num==9) {
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.estatus='LISTO PARA ENTREGA' AND p.estatus2='1' ORDER BY p.no_control desc";
					return ejecutarConsulta($sql);
					
				}
				# code...
			}
		}
			

			

						
	}



	public function listar_pedidos4($id,$lugar,$no_control_buscar)
	{
			

		if ($lugar<>"Fabrica") {
			
		
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.no_control='$no_control_buscar'";
					return ejecutarConsulta($sql);

				
			
			
		}elseif ($lugar=="Fabrica") {
			
			
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.no_control='$no_control_buscar'";
					return ejecutarConsulta($sql);

				
		}
			

			

						
	}

	public function listar_pedidos4_2($id,$lugar,$cliente_buscar)
	{
			

		if ($lugar<>"Fabrica") {
			
		
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE (SELECT lugar FROM usuario WHERE idusuario=p.idusuario) = '$lugar' AND p.idcliente='$cliente_buscar'";
					return ejecutarConsulta($sql);

				
			
			
		}elseif ($lugar=="Fabrica") {
			
			
					
					$sql="SELECT p.coment_vencim,p.idpg_pedidos,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,c.nombre as nom_cliente,p.estatus, DATEDIFF(DATE(p.fecha_entrega),DATE(p.fecha_pedido)) as diferencia_total,DATEDIFF(NOW(),DATE(p.fecha_pedido)) as avance, DATEDIFF(DATE(p.fecha_entrega),NOW()) as faltan,p.no_pedido,p.color_status,u.lugar,p.no_control,p.color_barra,p.porc_av,p.dias_rest,p.op, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos) as docs, p.observaciones,(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido=p.idpg_pedidos) as det_forma_entrega FROM pg_pedidos p INNER JOIN clientes c ON p.idcliente = c.idcliente INNER JOIN usuario u ON p.idusuario=u.idusuario  WHERE p.idcliente='$cliente_buscar'";
					return ejecutarConsulta($sql);

				
		}
			

			

						
	}

	public function llenar_box_prod($id)
	{
		$sql="SELECT dp.idpg_detalle_pedidos,dp.codigo,dp.descripcion as nombre,dp.cantidad,dp.estatus,dp.op,dp.observacion FROM pg_detalle_pedidos dp INNER JOIN productos p ON dp.idproducto=p.idproducto WHERE dp.idpg_pedidos='$id'";
		return ejecutarConsulta($sql);
	}

	
	

	public function listar_seguim_prod($id,$id2)
	{

		if ($id2==1) {

			if ($id==1) {
				$sql="SELECT pd.select_op, pd.idpg_detped,p.no_control,pdp.codigo,pdp.descripcion,pd.cantidad,pd.op,pd.estatus,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,p.empaque,pd.fecha_hora,pdp.color,pdp.observacion,p.idpg_pedidos,p.observaciones,pd.iddetalle_pedido,pdp.medida,pd.observ_enlace,pd.no_op_temp, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND tipo > 1) as documentos_ped,
				(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as estatus_pedido,
				(SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as tipo_pedido 
				FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos  WHERE pd.estatus='Produccion' AND p.estatus<>'CANCELADO' ORDER BY p.no_control DESC";
				return ejecutarConsulta($sql);
			}

			if ($id==2) {
				$sql="SELECT pd.select_op, pd.idpg_detped,p.no_control,pdp.codigo,pdp.descripcion,pd.cantidad,pd.op,pd.estatus,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,p.empaque,pd.fecha_hora,pdp.color,pdp.observacion,p.idpg_pedidos,p.observaciones,pd.iddetalle_pedido,pdp.medida,pd.observ_enlace,pd.no_op_temp, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND tipo > 1) as documentos_ped,
				(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as estatus_pedido,
				(SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as tipo_pedido  
				FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos  WHERE pd.estatus='Produccion' AND pd.op>0 AND p.estatus<>'CANCELADO' ORDER BY p.no_control DESC";
				return ejecutarConsulta($sql);
			}

			if ($id==3) {
				$sql="SELECT pd.select_op, pd.idpg_detped,p.no_control,pdp.codigo,pdp.descripcion,pd.cantidad,pd.op,pd.estatus,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,p.empaque,pd.fecha_hora,pdp.color,pdp.observacion,p.idpg_pedidos,p.observaciones,pd.iddetalle_pedido,pdp.medida,pd.observ_enlace,pd.no_op_temp, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND tipo > 1) as documentos_ped,
				(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as estatus_pedido,
				(SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as tipo_pedido  
				FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos  WHERE pd.estatus='Produccion' AND pd.op='' AND p.estatus<>'CANCELADO' ORDER BY p.no_control DESC";
				return ejecutarConsulta($sql);
			}

		}

		if ($id2==2) {
			
			if ($id==1) {
				$sql="SELECT pd.select_op, pd.idpg_detped,p.no_control,pdp.codigo,pdp.descripcion,pd.cantidad,pd.op,pd.estatus,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,p.empaque,pd.fecha_hora,pdp.color,pdp.observacion,p.idpg_pedidos,p.observaciones,pd.iddetalle_pedido,pdp.medida,pd.observ_enlace,pd.no_op_temp, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND tipo > 1) as documentos_ped, 
				(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as estatus_pedido,
				(SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as tipo_pedido 
				FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos  WHERE pd.estatus='Produccion' AND p.estatus<>'CANCELADO' ORDER BY pdp.codigo ASC";
				return ejecutarConsulta($sql);
			}

			if ($id==2) {
				$sql="SELECT pd.select_op, pd.idpg_detped,p.no_control,pdp.codigo,pdp.descripcion,pd.cantidad,pd.op,pd.estatus,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,p.empaque,pd.fecha_hora,pdp.color,pdp.observacion,p.idpg_pedidos,p.observaciones,pd.iddetalle_pedido,pdp.medida,pd.observ_enlace,pd.no_op_temp, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND tipo > 1) as documentos_ped,
				(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as estatus_pedido,
				(SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as tipo_pedido 
				 FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos  WHERE pd.estatus='Produccion' AND pd.op>0 AND p.estatus<>'CANCELADO' ORDER BY pdp.codigo ASC";
				return ejecutarConsulta($sql);
			}

			if ($id==3) {
				$sql="SELECT pd.select_op, pd.idpg_detped,p.no_control,pdp.codigo,pdp.descripcion,pd.cantidad,pd.op,pd.estatus,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,p.empaque,pd.fecha_hora,pdp.color,pdp.observacion,p.idpg_pedidos,p.observaciones,pd.iddetalle_pedido,pdp.medida,pd.observ_enlace,pd.no_op_temp, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND tipo > 1) as documentos_ped,
				(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as estatus_pedido,
				(SELECT tipo FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as tipo_pedido 
				 FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos  WHERE pd.estatus='Produccion' AND pd.op='' AND p.estatus<>'CANCELADO' ORDER BY pdp.codigo ASC";
				return ejecutarConsulta($sql);
			}

		}

			

			
	}


	public function listar_prod_fab()
	{




				$sql="SELECT pd.idpg_detped,p.no_control,pdp.codigo,pdp.descripcion,pd.cantidad,pd.op,pd.estatus,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,p.empaque,pd.fecha_hora,pdp.color,pdp.observacion,p.idpg_pedidos,p.observaciones,pd.iddetalle_pedido,pdp.medida,pd.observ_enlace,pd.no_op_temp FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos  WHERE pd.estatus='Produccion' AND pd.op>0 ORDER BY p.no_control DESC";
				return ejecutarConsulta($sql);


			

			
	}


	public function listar_seguim_buscar($id)
	{

				$sql="SELECT pd.idpg_detped,p.no_control,pdp.codigo,pdp.descripcion,pd.cantidad,pd.op,pd.estatus,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,p.empaque,pd.fecha_hora,pdp.color,pdp.observacion,p.idpg_pedidos,p.observaciones,pd.iddetalle_pedido,pdp.medida,pd.observ_enlace,pd.no_op_temp FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos  WHERE pd.estatus='Produccion' AND pd.op='$id' ORDER BY p.no_control DESC";
				return ejecutarConsulta($sql);

			
	}

	public function listar_prod_fab_buscar($id)
	{

				$sql="SELECT pd.idpg_detped,p.no_control,pdp.codigo,pdp.descripcion,pd.cantidad,pd.op,pd.estatus,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,p.empaque,pd.fecha_hora,pdp.color,pdp.observacion,p.idpg_pedidos,p.observaciones,pd.iddetalle_pedido,pdp.medida,pd.observ_enlace,pd.no_op_temp FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos  WHERE pd.estatus='Produccion' AND pd.op='$id' ORDER BY p.no_control DESC";
				return ejecutarConsulta($sql);

			
	}

	public function listar_seguim_prod2()
	{
		$sql="SELECT pd.idpg_detped,p.no_control,pdp.codigo,pdp.descripcion,pd.cantidad,pd.op,pd.estatus,DATE(p.fecha_pedido) as fecha_pedido,DATE(p.fecha_entrega) as fecha_entrega,p.empaque,pd.fecha_hora2,pdp.color,pdp.observacion,p.idpg_pedidos,p.observaciones,pdp.medida, pd.observ_enlace FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos INNER JOIN pg_pedidos p ON pdp.idpg_pedidos=p.idpg_pedidos  WHERE pd.estatus='Fabricado' AND p.estatus<>'ENTREGADO' ORDER BY p.no_control DESC";
		return ejecutarConsulta($sql);
	}

	public function dividir_prod_ped($idpg_detalle_pedidos)
	{
		$sql="INSERT INTO pg_detped (iddetalle_pedido,idproducto,cantidad,op) SELECT '$idpg_detalle_pedidos',idproducto,cantidad,'' FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
		return ejecutarConsulta($sql);
	}

	public function listar_pg_detped($id)
	{
		$sql="SELECT pd.idpg_detped,pp.codigo,pd.cantidad,pd.op,pd.estatus,pp.observacion,pd.observ_enlace,pd.iddetalle_pedido, pp.idpg_pedidos FROM pg_detped pd INNER JOIN pg_detalle_pedidos pp ON pd.iddetalle_pedido=pp.idpg_detalle_pedidos WHERE pd.iddetalle_pedido='$id'";
		return ejecutarConsulta($sql);
	}

	public function guardar_det_ped($idpg_detped,$cant,$obs_enl,$estatus,$fecha_hora,$id_ped_temp,$result,$iddetalle_pedido)
	{
		// $sql2="UPDATE pg_detalle_pedidos pdp SET pdp.estatus='$estatus', 
		// pdp.cantidad=IF(pdp.cantidad > (SELECT sum(cantidad) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos),
		// pdp.cantidad,(SELECT sum(cantidad) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos))
		
		// WHERE pdp.idpg_detalle_pedidos=(SELECT iddetalle_pedido FROM pg_detped WHERE idpg_detped='$idpg_detped')";
		// ejecutarConsulta($sql2);

		
		$sql1="UPDATE pg_detped SET cantidad='$cant',observ_enlace='$obs_enl',estatus='$estatus',fecha_hora='$fecha_hora',idpedido='$id_ped_temp',fecha_hora2='0000-00-00 00:00:00', guardado=1, coment='$result' WHERE idpg_detped='$idpg_detped'";
		ejecutarConsulta($sql1);

		$sql2="UPDATE pg_detalle_pedidos a SET cant_procesada = (SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=a.idpg_detalle_pedidos) WHERE a.idpg_detalle_pedidos='$iddetalle_pedido'";
		ejecutarConsulta($sql2);

		$sql3="UPDATE op_detalle_prod SET cant_tot='$cant' WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsulta($sql3);
	}


	public function guardar_estatus1($idpg_detped,$estatus,$fecha_hora,$id_ped_temp)
	{
		$sql2="UPDATE pg_detalle_pedidos SET estatus='$estatus' WHERE idpg_detalle_pedidos=(SELECT iddetalle_pedido FROM pg_detped WHERE idpg_detped='$idpg_detped')";
		ejecutarConsulta($sql2);

		$sql="UPDATE pg_detped SET estatus='$estatus',fecha_hora='$fecha_hora',idpedido='$id_ped_temp' WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsulta($sql);
	}



    public function guardar_cant_prod($idpg_detped,$cant)
	{
		$sql="UPDATE pg_detped SET cantidad='$cant' WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsulta($sql);
	}

	public function guardar_observ_prod_enl($idpg_detped,$obs_enl)
	{
		$sql="UPDATE pg_detped SET observ_enlace='$obs_enl' WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsulta($sql);
	}

	public function save_op_prod($idpg_detped,$op)
	{
		$sql="UPDATE pg_detped SET op='$op' WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsulta($sql);
	}

	public function borrar_det_ped($idpg_detped,$iddetalle_pedido)
	{
		$sql="DELETE FROM pg_detped WHERE idpg_detped='$idpg_detped'";
		ejecutarConsulta($sql);

		$sql2="UPDATE pg_detalle_pedidos a SET cant_procesada = (SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=a.idpg_detalle_pedidos) WHERE a.idpg_detalle_pedidos='$iddetalle_pedido'";
		return ejecutarConsulta($sql2);

		
	}

	public function guardar_estatus_prod($idpg_detped,$estatus,$fecha_hora)
	{
		$sql="UPDATE pg_detped SET estatus='$estatus',fecha_hora='$fecha_hora' WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsulta($sql);
	}

	public function guardar_estatus_prod2($idpg_detped,$estatus,$fecha_hora,$lote)
	{
		$sql="UPDATE pg_detped SET estatus='$estatus',fecha_hora2='$fecha_hora',lote='$lote' WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsulta($sql);
	}

	public function guardar_op_seguim($idpg_detped,$op)
	{
		$sql="UPDATE pg_detped SET op='$op' WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsulta($sql);
	}

	public function ver_observ_prod($id)
	{
		$sql="SELECT * FROM pg_detalle_pedidos WHERE idpg_pedidos='$id'";
		return ejecutarConsulta($sql);
	}

	public function update_observ_prod($idpg_detalle_pedidos,$obser_prod_det)
	{
		$sql="UPDATE pg_detalle_pedidos SET observacion='$obser_prod_det' WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
		return ejecutarConsulta($sql);
	}

	public function ver_observ_gen($idpg_pedidos)
	{
		$sql="SELECT p.no_control, p.observaciones, e.det_forma_entrega FROM pg_pedidos p INNER JOIN dir_entregas_esp e ON p.idpg_pedidos=e.idpedido WHERE idpg_pedidos='$idpg_pedidos'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function cont_observ_det($idpg_pedidos)
	{
		$sql="SELECT count(idpg_detalle_pedidos) as num_observ FROM pg_detalle_pedidos WHERE idpg_pedidos='$idpg_pedidos' AND observacion<>''";
		return ejecutarConsultaSimpleFila($sql);
	}

	
	public function save_hist($id_ped_temp,$idusuario,$fecha_hora,$text_set)
	{
		$sql="INSERT INTO historial_mov (movimiento,idusuario,idpedido,fecha_hora,notif) VALUES ('$text_set','$idusuario','$id_ped_temp','$fecha_hora','1')";
		ejecutarConsulta($sql);
 
		$sql2="UPDATE pg_pedidos SET fecha_envio_enlace='$fecha_hora' WHERE idpg_pedidos='$id_ped_temp'";
		return ejecutarConsulta($sql2);
	
	}

	public function save_hist_iva($id_ped_temp,$aplic_iva)
	{

		$sql="UPDATE pg_pedidos SET aplicar_iva='$aplic_iva' WHERE idpg_pedidos='$id_ped_temp'";
		return ejecutarConsulta($sql);
	
	}

	public function listar_historial($id)
	{
		$sql="SELECT h.idhistorial_mov,h.movimiento,u.nombre,h.idpedido,h.fecha_hora FROM historial_mov h INNER JOIN usuario u ON h.idusuario=u.idusuario WHERE h.idpedido='$id' AND h.movimiento<>'Descuento solicitado' ORDER BY h.idhistorial_mov DESC";
		return ejecutarConsulta($sql);
	}

	public function guardar_op_fab($ultimo_op)
	{

		/*$sql="UPDATE pg_detped SET no_op_temp='' WHERE op=''";
		ejecutarConsulta($sql);*/

		$sql="INSERT INTO op (no_op) VALUES ('$ultimo_op')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM op WHERE idop='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);
	}

	public function borrar_op_det($idpg_detped,$iddet_ped_op)
	{
		$sql2="UPDATE pg_detped SET no_op_temp='' WHERE idpg_detped='$idpg_detped'";
        ejecutarConsulta($sql2);

        $sql_valid="INSERT INTO acciones_valid (mensaje,fecha_hora) VALUES (CONCAT('Producto borrado con idop_detalle_prod:','$iddet_ped_op', ' al seleccion de prod para op en borrar_op_det'),NOW())";
					ejecutarConsulta($sql_valid);

		$sql="DELETE FROM op_detalle_prod WHERE idop_detalle_prod='$iddet_ped_op'";
		return ejecutarConsulta($sql);

	}

	public function set_one_op($idop)
	{
		$sql="UPDATE op SET estatus='1' WHERE idop='$idop' ";
		ejecutarConsulta($sql);

		$sql2="UPDATE op_detalle_prod SET estatus='1' WHERE idop='$idop' ";
		ejecutarConsulta($sql2);

		$sql3="SELECT no_op, 
		(SELECT DATE(fecha_inicio) FROM op_detalle_prod WHERE idop='$idop' ORDER BY DATE(fecha_inicio) ASC LIMIT 1) as fecha1, 
		(SELECT DATE(fecha_term) FROM op_detalle_prod WHERE idop='$idop' ORDER BY DATE(fecha_term) ASC LIMIT 1) as fecha2,prioridad,observ,cant_color 
		FROM op WHERE idop='$idop'";
		return ejecutarConsultaSimpleFila($sql3);
	}

	public function set_op2($idop)
	{

		$sql="UPDATE pg_detped SET op=(SELECT no_op FROM op WHERE idop='$idop') WHERE no_op_temp = '$idop'";
		return ejecutarConsulta($sql);

	}

	public function consul_op($idpg_detped)
	{

		$sql="SELECT op FROM pg_detped WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function consul_op_detalle_prod($idop)
	{

		$sql="SELECT count(idop_detalle_prod) as num_exist FROM op_detalle_prod WHERE idop='$idop'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function obtener_idpedido($idpg_detped)
	{

		$sql="SELECT * FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=(SELECT iddetalle_pedido FROM pg_detped WHERE idpg_detped='$idpg_detped')";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function contar_prod_ped($idop)
	{

		$sql="SELECT sum(cantidad) as num_prod FROM pg_detalle_pedidos WHERE idpg_pedidos='$idop'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function contar_prod_apar($idop)
	{

		$sql="SELECT sum(pd.cantidad) as num_prod_apart FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos WHERE pdp.idpg_pedidos='$idop' AND pd.estatus='Apartado'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function contar_prod_prod($idop)
	{

		$sql="SELECT sum(pd.cantidad) as num_prod_fab FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos WHERE pdp.idpg_pedidos='$idop' AND pd.estatus='Fabricado'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function contar_prod_exist($idop)
	{

		$sql="SELECT sum(pd.cantidad) as num_prod_exis FROM pg_detped pd INNER JOIN pg_detalle_pedidos pdp ON pd.iddetalle_pedido=pdp.idpg_detalle_pedidos WHERE pdp.idpg_pedidos='$idop' AND pd.estatus='EXISTENCIA'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function save_notif($idpedido,$idusuario,$fecha_hora,$estatus_pedido,$idavance_prod,$completados,$requeridos)
	{

		$sql="INSERT INTO notif (idpedido,idusuario,mensaje,fecha_hora,estatus,estatus2,idavance_prod,requeridos,completados) VALUES ('$idpedido','$idusuario','Pedido completado','$fecha_hora','1','1','$idavance_prod','$requeridos'.'$completados')";
		ejecutarConsulta($sql);

		if ($estatus_pedido<>'ENTREGADO') {
			$sql="UPDATE pg_pedidos SET estatus='LISTO PARA ENTREGA', color_status='09A004' WHERE idpg_pedidos='$idpedido'";
			return ejecutarConsulta($sql);
			# code...
		}elseif ($estatus_pedido=='ENTREGADO') {

			$sql="UPDATE pg_pedidos SET estatus='ENTREGADO', color_status='0BF6BF' WHERE idpg_pedidos='$idpedido'";
			return ejecutarConsulta($sql);
		}

	}

	public function abrir_terminados()
	{

		/*$sql="SELECT n.idnotif,p.idpg_pedidos,p.no_control,n.fecha_hora as fecha_notif,DATE(n.fecha_hora) as fecha, TIME(n.fecha_hora) as hora,n.estatus, (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'' AND tipo='1') as num_docs, (SELECT nombre FROM clientes WHERE idcliente=p.idcliente) as nom_cliente, (SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as prod_total, IFNULL((SELECT sum(cantidad) FROM entregas_detalle WHERE idpedido=p.idpg_pedidos),0) as prod_entregados FROM notif n INNER JOIN pg_pedidos p ON n.idpedido=p.idpg_pedidos WHERE p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO'  ORDER BY n.idnotif DESC";
		return ejecutarConsulta($sql);*/

		//Query lenta identificada
		$sql="SELECT p.no_control,p.idpg_pedidos,
		(SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'' AND tipo='1') as num_docs,
		(SELECT nombre FROM clientes WHERE idcliente=p.idcliente) as nom_cliente,
		(SELECT pdp.fecha_hora2 FROM pg_detped pdp WHERE (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pdp.iddetalle_pedido LIMIT 1) = p.idpg_pedidos ORDER BY pdp.fecha_hora2 DESC LIMIT 1) as fecha_entrega_fab,
		(SELECT pdp.fecha_hora FROM pg_detped pdp WHERE (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pdp.iddetalle_pedido LIMIT 1) = p.idpg_pedidos ORDER BY pdp.fecha_hora DESC LIMIT 1) as fecha_entrega_set,
		(SELECT IFNULL(sum(cantidad),0) FROM salidas_entregas_detalles WHERE idpedido=p.idpg_pedidos) as cant_entrega,
		(SELECT IFNULL(sum(cantidad),0) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as cant_pendiente
		FROM pg_pedidos p WHERE p.cant_est >= (SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' ORDER BY p.estatus_docs DESC";
		return ejecutarConsulta($sql);

	}

	public function listar_listos($id)
	{
			$sql="UPDATE pg_pedidos a 
			SET cant_prod_pedido=(SELECT IFNULL(sum(cantidad),0) FROM pg_detalle_pedidos WHERE idpg_pedidos=a.idpg_pedidos), 
			productos_terminados = (SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE (idpedido=a.idpg_pedidos AND estatus='Surtido') OR (idpedido=a.idpg_pedidos AND estatus='Fabricado') OR (idpedido=a.idpg_pedidos AND estatus='Existencia') OR (idpedido=a.idpg_pedidos AND estatus='Cancelado')) 
			WHERE (a.estatus<>'ENTREGADO' AND a.estatus<>'CANCELADO' AND a.estatus<>'0') OR (a.estatus<>'ENTREGADO' AND a.estatus<>'CANCELADO' AND a.estatus<>'0')";
			ejecutarConsulta($sql);

			$sql_2="SELECT p.idpg_pedidos, p.no_control, p.fecha_valid_term as fecha_entrega,
			(SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'' AND tipo='1') as num_docs,
			(SELECT IFNULL(sum(cantidad),0) FROM salidas_entregas_detalles WHERE idpedido=p.idpg_pedidos) as cant_entrega,
 			(SELECT IFNULL(sum(cantidad),0) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as cant_pendiente,
			(SELECT nombre FROM clientes WHERE idcliente=p.idcliente) as nom_cliente,
			(SELECT razon_fac FROM dir_facturacion_esp WHERE idpedido=p.idpg_pedidos) as razon_fac,
			(SELECT pdp.fecha_hora2 FROM pg_detped pdp WHERE (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pdp.iddetalle_pedido LIMIT 1) = p.idpg_pedidos ORDER BY pdp.fecha_hora2 DESC LIMIT 1) as fecha_entrega_fab,
			(SELECT pdp.fecha_hora FROM pg_detped pdp WHERE (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pdp.iddetalle_pedido LIMIT 1) = p.idpg_pedidos ORDER BY pdp.fecha_hora DESC LIMIT 1) as fecha_entrega_set
			FROM pg_pedidos p 
			INNER JOIN usuario u 
			ON p.idusuario=u.idusuario 
			WHERE p.cant_prod_pedido=p.productos_terminados AND p.cant_prod_pedido>0 AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' AND p.estatus<>'0' AND u.lugar='$id'";
			return ejecutarConsulta($sql_2);






		//Query lenta identificada
		// $sql="SELECT p.no_control,p.idpg_pedidos,
		// (SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'' AND tipo='1') as num_docs,
		// (SELECT nombre FROM clientes WHERE idcliente=p.idcliente) as nom_cliente,
		// (SELECT razon_fac FROM dir_facturacion_esp WHERE idpedido=p.idpg_pedidos) as razon_fac,
		// (SELECT pdp.fecha_hora2 FROM pg_detped pdp WHERE (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pdp.iddetalle_pedido LIMIT 1) = p.idpg_pedidos ORDER BY pdp.fecha_hora2 DESC LIMIT 1) as fecha_entrega_fab,
		// (SELECT pdp.fecha_hora FROM pg_detped pdp WHERE (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pdp.iddetalle_pedido LIMIT 1) = p.idpg_pedidos ORDER BY pdp.fecha_hora DESC LIMIT 1) as fecha_entrega_set,
		// (SELECT IFNULL(sum(cantidad),0) FROM salidas_entregas_detalles WHERE idpedido=p.idpg_pedidos) as cant_entrega,
		// (SELECT IFNULL(sum(cantidad),0) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as cant_pendiente
		// FROM pg_pedidos p INNER JOIN usuario u ON p.idusuario=u.idusuario WHERE p.cant_est >= (SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' AND u.lugar='$id' ORDER BY p.estatus_docs DESC";
		// return ejecutarConsulta($sql);


		/*$sql="SELECT p.no_control,p.idpg_pedidos,
		(SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'' AND tipo='1') as num_docs,
		(SELECT nombre FROM clientes WHERE idcliente=p.idcliente) as nom_cliente 
		FROM pg_pedidos p INNER JOIN usuario u ON p.idusuario=u.idusuario WHERE p.cant_est >= (SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' AND u.lugar='$id' ORDER BY p.estatus_docs ASC";
		return ejecutarConsulta($sql);*/

	}

	public function abrir_pedido_notif($idpg_pedidos)
	{

		$sql="UPDATE notif SET estatus='2' WHERE idpedido='$idpg_pedidos'";
		return ejecutarConsulta($sql);


	}




	public function abrir_pedido_notif2($idpg_pedidos)
	{

		$sql="UPDATE notif SET estatus2='2' WHERE idpedido='$idpg_pedidos'";
		return ejecutarConsulta($sql);


	}

	public function cargar_notif()
	{

		/*$sql="SELECT count(n.idnotif) as num_notif FROM notif n INNER JOIN pg_pedidos p ON n.idpedido=p.idpg_pedidos WHERE n.estatus='1' AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO'";
		return ejecutarConsultaSimpleFila($sql);*/

		// $sql="SELECT num_term FROM result_notif WHERE idresult_notif=1";
		// return ejecutarConsultaSimpleFila($sql);

		$sql="SELECT count(idpg_pedidos) as num_term FROM pg_pedidos WHERE cant_prod_pedido=productos_terminados AND cant_prod_pedido>0 AND estatus<>'ENTREGADO' AND estatus<>'CANCELADO' AND estatus<>'0'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function cargar_notif_part($lugar_user)
	{

		/*$sql="SELECT count(n.idnotif) as num_notif FROM notif n INNER JOIN pg_pedidos p ON n.idpedido=p.idpg_pedidos INNER JOIN usuario u ON p.idusuario=u.idusuario WHERE n.estatus2='1' AND u.lugar='$lugar_user' AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO'";
		return ejecutarConsultaSimpleFila($sql);*/

		//Query lenta identificada
		$sql="SELECT count(p.idpg_pedidos) as num_term 
		FROM pg_pedidos p 
		INNER JOIN usuario u 
		ON p.idusuario=u.idusuario 
		WHERE p.cant_prod_pedido=p.productos_terminados AND p.cant_prod_pedido>0 AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' AND p.estatus<>'0' AND u.lugar='$lugar_user'";
		return ejecutarConsultaSimpleFila($sql);

		// $sql="SELECT count(p.idpg_pedidos) as num_notif FROM pg_pedidos p INNER JOIN usuario u ON p.idusuario=u.idusuario WHERE p.cant_est >= (SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' AND u.lugar='$lugar_user'";
		// return ejecutarConsultaSimpleFila($sql);
	}


	public function marcar_sindocs($idpg_pedidos)
	{
		$sql="INSERT INTO documentos (idpedido,nombre) VALUES('$idpg_pedidos','Sin doc')";
		ejecutarConsulta($sql);

		$sql="UPDATE notif SET estatus2='2' WHERE idpedido='$idpedido_doc'";
		return ejecutarConsulta($sql);
	
	}


	public function consul_idusuario($id_ped_temp)
	{
		$sql="SELECT idusuario FROM pg_pedidos WHERE idpg_pedidos='$id_ped_temp'";
		return ejecutarConsultaSimpleFila($sql);
	
	}

	
	public function buscar_cliente_tbl($id)
	{

		$sql="SELECT * FROM clientes WHERE nombre LIKE '%".$id."%' OR no_cliente LIKE '%".$id."%' ORDER BY nombre asc";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}


	public function abrir_observ_notif($idhistorial_mov)
	{

		$sql="UPDATE historial_mov SET notif='2' WHERE idhistorial_mov='$idhistorial_mov'";
		return ejecutarConsulta($sql);


	}


	public function listar_sin_estatus()
	{

		/*$sql="SELECT p.no_control, p.fecha_pedido,dp.codigo,dp.descripcion,p.estatus, 
		(dp.cantidad - (SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=dp.idpg_detalle_pedidos)) as  cant_sin
		FROM pg_detalle_pedidos dp INNER JOIN pg_pedidos p ON dp.idpg_pedidos=p.idpg_pedidos WHERE
		(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=dp.idpg_detalle_pedidos)<dp.cantidad AND p.estatus2=1 AND p.estatus<>'CANCELADO' AND p.estatus<>'ENTREGADO' ORDER BY p.fecha_pedido DESC";*/

		// $sql="SELECT r.cant_sinp as cant_sin,
		// (SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos) as no_control,
		// (SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=r.iddetalle_pedidos) as codigo,
		// (SELECT descripcion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=r.iddetalle_pedidos) as descripcion
		// FROM result_tbl_sinp r INNER JOIN pg_detalle_pedidos pdp ON r.iddetalle_pedidos = pdp.idpg_detalle_pedidos ORDER BY (SELECT fecha_pedido FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos) DESC";

		$sql="SELECT b.no_control, a.codigo, a.descripcion, (a.cantidad-a.cant_procesada) as cant_sin FROM pg_detalle_pedidos a INNER JOIN pg_pedidos b ON a.idpg_pedidos = b.idpg_pedidos
		WHERE a.cant_procesada<a.cantidad AND b.estatus2=1 AND b.estatus<>'ENTREGADO' AND b.estatus<>'CANCELADO';";


		return ejecutarConsulta($sql);


	}


	public function contar_prod_sinrev()
	{
		$sql="SELECT count(b.no_control) as num_sinrev FROM pg_detalle_pedidos a INNER JOIN pg_pedidos b ON a.idpg_pedidos = b.idpg_pedidos
		WHERE a.cant_procesada<a.cantidad AND b.estatus2=1 AND b.estatus<>'ENTREGADO' AND b.estatus<>'CANCELADO';";
		// $sql="SELECT num_sinrev FROM result_notif WHERE idresult_notif=1";
		return ejecutarConsultaSimpleFila($sql);


	}

	public function consul_exist_notif($idpedido)
	{

		$sql="SELECT count(idpedido) as num_pedido FROM notif WHERE idpedido = '$idpedido'";
		return ejecutarConsultaSimpleFila($sql);


	}


	public function buscar_idopdetalleprod($idpg_detped)
	{

		$sql="SELECT * FROM op_detalle_prod WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsultaSimpleFila($sql);


	}

	public function buscar_area($idusuario)
	{

		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);


	}

	public function contar_productos($pedido)
	{

		$sql="SELECT sum(cantidad) as cantidad_product FROM pg_detalle_pedidos WHERE idpg_pedidos='$pedido'";
		return ejecutarConsultaSimpleFila($sql);


	}

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


	public function update_coment_vencim($idpg_pedidos,$coment_vencim)
	{

		$sql="UPDATE pg_pedidos SET coment_vencim='$coment_vencim' WHERE idpg_pedidos='$idpg_pedidos'";
		return ejecutarConsulta($sql);


	}

	public function cont_num_vencidos()
	{

		$sql="SELECT num_vencidos FROM result_notif WHERE idresult_notif=1";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function contar_sin_coment_venc()
	{

		$sql="SELECT count(idpg_pedidos) as num_vencidos_sincoment FROM pg_pedidos WHERE estatus<>'ENTREGADO' AND estatus<>'CANCELADO' AND estatus2='1' AND DATEDIFF(DATE(fecha_entrega),NOW())<0 AND coment_vencim=''";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function marcar_tipo($iddocumentos,$tipo_doc)
	{

		$sql="UPDATE documentos SET tipo='$tipo_doc' WHERE iddocumentos='$iddocumentos'";
		return ejecutarConsulta($sql);
	}

	public function listar_tipos()
	{

		$sql="SELECT * FROM prod_tipo ORDER BY nombre ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_subtipo($id)
	{

		$sql="SELECT DISTINCT pt2.nombre FROM productos_clasif pc INNER JOIN prod_tipo2 pt2 ON pc.idtipo2=pt2.idprod_tipo2 WHERE pc.idtipo='$id' ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_subtipo_new()
	{

		$sql="SELECT * FROM prod_tipo2 ORDER BY idprod_tipo2 ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_modelo($id)
	{

		$sql="SELECT DISTINCT pm.nombre FROM productos_clasif pc INNER JOIN prod_modelo pm ON pc.idmodelo=pm.idprod_modelo WHERE pc.idtipo='$id' ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_modelo_new()
	{

		$sql="SELECT * FROM prod_modelo WHERE nombre<>'PENDIENTE' ORDER BY idprod_modelo ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_modelo2($id,$id2)
	{

		$sql="SELECT DISTINCT pm.nombre FROM productos_clasif pc INNER JOIN prod_modelo pm ON pc.idmodelo=pm.idprod_modelo WHERE pc.idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id2') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_submodelo($id,$id2)
	{

		$sql="SELECT DISTINCT pm2.nombre FROM productos_clasif pc INNER JOIN prod_modelo2 pm2 ON pc.idmodelo2=pm2.idprod_modelo2 WHERE pc.idtipo='$id' AND pc.idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_submodelo2($id,$id2,$id3)
	{

		$sql="SELECT DISTINCT pm2.nombre FROM productos_clasif pc INNER JOIN prod_modelo2 pm2 ON pc.idmodelo2=pm2.idprod_modelo2 WHERE pc.idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id3') AND pc.idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_tamano($id,$id2)
	{

		$sql="SELECT DISTINCT pt.nombre FROM productos_clasif pc INNER JOIN prod_tamano pt ON pc.idtamano=pt.idprod_tamano WHERE pc.idtipo='$id' AND  pc.idmodelo = (SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_tamano2($id,$id2,$id3)
	{

		$sql="SELECT DISTINCT pt.nombre FROM productos_clasif pc INNER JOIN prod_tamano pt ON pc.idtamano=pt.idprod_tamano WHERE pc.idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id3') AND  pc.idmodelo = (SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_tamano3($id,$id2,$id3)
	{

		$sql="SELECT DISTINCT pt.nombre FROM productos_clasif pc INNER JOIN prod_tamano pt ON pc.idtamano=pt.idprod_tamano WHERE pc.idtipo='$id' AND  pc.idmodelo = (SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND pc.idmodelo2=(SELECT idprod_modelo2 FROM prod_modelo2 WHERE nombre='$id3') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_tamano4($id,$id2,$id3,$id4)
	{

		$sql="SELECT DISTINCT pt.nombre FROM productos_clasif pc INNER JOIN prod_tamano pt ON pc.idtamano=pt.idprod_tamano WHERE pc.idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id3') AND  pc.idmodelo = (SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND pc.idmodelo2=(SELECT idprod_modelo2 FROM prod_modelo2 WHERE nombre='$id4') ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos($id)
	{
		$sql="SELECT * FROM productos WHERE idmuebles_fam='$id' ORDER BY codigo ASC";
		return ejecutarConsulta($sql);
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

	public function update_observ_lic($idpedido,$observ_lic)
	{
		$sql="UPDATE pg_pedidos SET observaciones='$observ_lic' WHERE idpg_pedidos='$idpedido'";
		return ejecutarConsulta($sql);
	}

	public function consul_detped_id($idpg_detped)
	{
		$sql="SELECT count(idop_detalle_prod) as exist FROM op_detalle_prod WHERE idpg_detped='$idpg_detped'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar_productos_resul_tipo($id)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE pc.idtipo='$id' AND pc.estatus=1 ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_tipo_sub($id,$id2)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE pc.idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id2') AND pc.estatus=1 ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_modelo($id,$id2)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE pc.idtipo='$id' AND pc.idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND pc.estatus=1 ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_modelo2($id,$id2,$id3)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE pc.idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id3') AND pc.idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND pc.estatus=1 ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_submodelo($id,$id2,$id3)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE pc.idtipo='$id' AND pc.idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND pc.idmodelo2=(SELECT idprod_modelo2 FROM prod_modelo2 WHERE nombre='$id3') AND pc.estatus=1 ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul_submodelo2($id,$id2,$id3,$id4)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE pc.idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id4') AND pc.idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND pc.idmodelo2=(SELECT idprod_modelo2 FROM prod_modelo2 WHERE nombre='$id3') AND pc.estatus=1 ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}


	public function listar_productos_resul($id,$id2,$id3)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE idtipo='$id' AND idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND idtamano=(SELECT idprod_tamano FROM prod_tamano WHERE nombre='$id3') AND pc.estatus=1 ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul2($id,$id2,$id3,$id4)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE idtipo='$id' AND idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND pc.idmodelo2=(SELECT idprod_modelo2 FROM prod_modelo2 WHERE nombre='$id4') AND idtamano=(SELECT idprod_tamano FROM prod_tamano WHERE nombre='$id3') AND pc.estatus=1 ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul3($id,$id2,$id3,$id4)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id4') AND idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND idtamano=(SELECT idprod_tamano FROM prod_tamano WHERE nombre='$id3') AND pc.estatus=1 ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_resul4($id,$id2,$id3,$id4,$id5)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_modelo WHERE idprod_modelo=pc.idmodelo) as nom_modelo, (SELECT nombre FROM prod_modelo2 WHERE idprod_modelo2=pc.idmodelo2) as nom_modelo2, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE idtipo='$id' AND pc.idtipo2=(SELECT idprod_tipo2 FROM prod_tipo2 WHERE nombre='$id4') AND idmodelo=(SELECT idprod_modelo FROM prod_modelo WHERE nombre='$id2') AND pc.idmodelo2=(SELECT idprod_modelo2 FROM prod_modelo2 WHERE nombre='$id5') AND idtamano=(SELECT idprod_tamano FROM prod_tamano WHERE nombre='$id3') AND pc.estatus=1 ORDER BY pc.idproductos_clasif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_busqueda($id)
	{
		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE (pc.descripcion LIKE '%".$id."%' OR pc.codigo_match LIKE '%".$id."%') AND pc.estatus=1 ORDER BY pc.descripcion asc";
		return ejecutarConsulta($sql);
	}

	public function insert_prod($idproductos_clasif)
	{

		$sql="INSERT INTO productos (idmuebles_fam,codigo,nombre,color,medida,precio_total) SELECT idtipo,codigo_match,descripcion,idcolor,idtamano,'0' FROM productos_clasif WHERE idproductos_clasif='$idproductos_clasif'";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_update1="SELECT * FROM productos WHERE idproducto='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_update1);


	}

	public function buscar_idprod_clasif($idproductos_clasif,$idproducto)
	{

		$sql="UPDATE productos_clasif SET idproductos='$idproducto' WHERE idproductos_clasif='$idproductos_clasif'";
		ejecutarConsulta($sql);

		$sql2="SELECT pc.idtipo,pc.codigo_match,pc.descripcion, (SELECT nombre FROM prod_color WHERE idprod_color=pc.idcolor) as nom_color, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE idproductos_clasif='$idproductos_clasif'";
		return ejecutarConsultaSimpleFila($sql2);

	}

	public function update_producto_tbl1($idmuebles_fam,$codigo,$nombre,$idproducto,$nom_color,$nom_tamano)
	{

		$sql="UPDATE productos SET idmuebles_fam='$idmuebles_fam',codigo='$codigo',nombre='$nombre', color='$nom_color',medida='$nom_tamano' WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);

	}

	public function listar_documentos($id)
	{

		$sql="SELECT * FROM documentos WHERE idpedido='$id' ORDER BY nombre ASC";
		return ejecutarConsulta($sql);

	}

	public function contar_productos_ped($idpedido)
	{

		$sql="SELECT count(idpg_detalle_pedidos) as num_prod FROM pg_detalle_pedidos WHERE idpg_pedidos='$idpedido'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function consul_nom_arch($idpedido,$ar_comprob)
	{

		$sql="SELECT count(iddocumentos) as num_doc FROM documentos WHERE idpedido='$idpedido' AND nombre='$ar_comprob'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function buscar_iddocs($idpedido)
	{

		$sql="SELECT (SELECT count(iddocumentos) FROM documentos  WHERE idpedido='$idpedido' AND tipo=2) as idorden_compra,
		(SELECT count(iddocumentos) FROM documentos  WHERE idpedido='$idpedido' AND tipo=3) as idcontrato,
		(SELECT count(iddocumentos) FROM documentos  WHERE idpedido='$idpedido' AND tipo=4) as idespecif,
		(SELECT count(iddocumentos) FROM documentos  WHERE idpedido='$idpedido' AND tipo=5) as idanexo
		FROM documentos WHERE idpedido='$idpedido' LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function borrar_documento_lic($iddocumentos)
	{

		$sql="DELETE FROM documentos WHERE iddocumentos='$iddocumentos'";
		return ejecutarConsulta($sql);

	}

	public function listar_productos_list($id)
	{

		$sql="SELECT pc.idproductos_clasif, pc.idproductos as idproducto,(SELECT precio_total FROM productos WHERE idproducto=pc.idproductos) as precio_total, pc.codigo_match, pc.descripcion, (SELECT nombre FROM prod_tamano WHERE idprod_tamano=pc.idtamano) as nom_tamano FROM productos_clasif pc WHERE pc.codigo_match='$id'";
		return ejecutarConsulta($sql);
	

	}

	public function listar_productos_pedido_exist($id)
	{

		$sql="SELECT * FROM pg_detalle_pedidos WHERE idpg_pedidos='$id'";
		return ejecutarConsulta($sql);

	}

	public function buscar_prod_detped($idpg_detalle_pedidos)
	{

		$sql="SELECT count(idpg_detped) as num_prod FROM pg_detped WHERE iddetalle_pedido='$idpg_detalle_pedidos'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function buscar_prod_op($idpg_detalle_pedidos)
	{

		$sql="SELECT op FROM pg_detped WHERE iddetalle_pedido='$idpg_detalle_pedidos' AND op>0 LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);

	}


	public function quitar_prod_ped_list($idpg_detalle_pedidos,$idpedido,$idusuario,$fecha_hora)
	{
		//$sql3="INSERT INTO historial_mov (movimiento,idusuario,idpedido,fecha_hora,notif) VALUES ('Producto eliminado','$idusuario','$idpedido','$fecha_hora','1')";
		$sql3="INSERT INTO historial_mov (movimiento,idusuario,idpedido,fecha_hora,notif) SELECT CONCAT('Producto eliminado: ',codigo), '$idusuario', '$idpedido', '$fecha_hora', '1' FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
		ejecutarConsulta($sql3);

		$sql="DELETE FROM pg_detped WHERE iddetalle_pedido='$idpg_detalle_pedidos'";
		ejecutarConsulta($sql);

		$sql2="DELETE FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
		return ejecutarConsulta($sql2);

		

	}

	public function listar_submodelo_new()
	{

		$sql="SELECT * FROM prod_modelo2 WHERE nombre<>'PENDIENTE' ORDER BY idprod_modelo2 ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_tamano_new()
	{

		$sql="SELECT * FROM prod_tamano WHERE nombre<>'PENDIENTE' ORDER BY idprod_tamano ASC";
		return ejecutarConsulta($sql);
	}
	public function listar_color_new()
	{

		$sql="SELECT * FROM prod_color ORDER BY idprod_color ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_paleta_new()
	{

		$sql="SELECT * FROM prod_paleta ORDER BY idprod_paleta ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_especif_new()
	{

		$sql="SELECT * FROM prod_especif ORDER BY idprod_especif ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_especif2_new()
	{

		$sql="SELECT * FROM prod_especif2 WHERE nombre<>'PENDIENTE' ORDER BY idprod_especif2 ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_especif3_new()
	{

		$sql="SELECT * FROM prod_especif3 ORDER BY idprod_especif3 ASC";
		return ejecutarConsulta($sql);
	}

	public function consul_idpgpedidos()
	{

		$sql="SELECT (SELECT idpg_pedidos FROM pg_pedidos WHERE estatus2=1 AND estatus<>'ESTATUS' AND estatus<>'CANCELADO' ORDER BY idpg_pedidos ASC LIMIT 1) as idmin, (SELECT idpg_pedidos FROM pg_pedidos WHERE estatus2=1 AND estatus<>'ESTATUS' AND estatus<>'CANCELADO' ORDER BY idpg_pedidos DESC LIMIT 1) as idmax FROM pg_pedidos LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function det_term($id,$id2,$fecha_hora)
	{
		//$contador = 0;
		$id_1=$id;
		$id_2=$id2;
		$fecha_h=$fecha_hora;


					$sql="UPDATE pg_pedidos p SET 
					p.cant_est=
					IF(p.cant_est<(SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),
					(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE idpedido=p.idpg_pedidos AND estatus='Apartado')+
					(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE idpedido=p.idpg_pedidos AND estatus='Fabricado')+
					(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE idpedido=p.idpg_pedidos AND estatus='Existencia'),
					p.cant_est),
					p.estatus_docs = (SELECT IFNULL(count(iddocumentos),0) FROM documentos WHERE tipo=1 AND nombre<>'' AND idpedido=p.idpg_pedidos)
					WHERE p.estatus2=1 AND p.estatus<>'CANCELADO'
					";
					ejecutarConsulta($sql);

					$sql2="UPDATE pg_pedidos p SET 
					p.fecha_valid_term=
					IF(p.cant_est>=(SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),
					IF((SELECT fecha_hora FROM pg_detped WHERE idpedido=p.idpg_pedidos ORDER BY fecha_hora DESC LIMIT 1)>
					(SELECT fecha_hora2 FROM pg_detped WHERE idpedido=p.idpg_pedidos ORDER BY fecha_hora2 DESC LIMIT 1),
					(SELECT fecha_hora FROM pg_detped WHERE idpedido=p.idpg_pedidos ORDER BY fecha_hora DESC LIMIT 1),
					(SELECT fecha_hora2 FROM pg_detped WHERE idpedido=p.idpg_pedidos ORDER BY fecha_hora2 DESC LIMIT 1)),'0000-00-00 00:00:00')
					WHERE p.estatus2=1 AND p.estatus<>'CANCELADO'
					";
					ejecutarConsulta($sql2);

					$sql3="UPDATE pg_pedidos p SET p.estatus_vencim=IF(p.fecha_valid_term<=p.fecha_entrega AND p.cant_est >= (SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),1,0) WHERE 
					(p.estatus2=1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4)";
					ejecutarConsulta($sql3);

					$sql4="UPDATE pg_pedidos p SET 
					p.fecha_entr_mas1=IF(CONCAT(ELT(WEEKDAY(p.fecha_valid_term) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'))='Viernes',
					(DATE_ADD(p.fecha_valid_term,INTERVAL 3 DAY)),
					(DATE_ADD(p.fecha_valid_term,INTERVAL 1 DAY))
					) WHERE 
					(p.estatus2=1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4)";
					ejecutarConsulta($sql4);

					$sql5="UPDATE pg_pedidos p SET p.ent_tiempo=IF(DATEDIFF((SELECT fecha FROM estatus_pedido_fab WHERE idpedido=p.idpg_pedidos AND color='0BF6BF' OR color='7E0CA8' ORDER BY fecha DESC LIMIT 1),DATE(p.fecha_entr_mas1))<=1,1,0) WHERE 
					(p.estatus2=1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4)";
					return ejecutarConsulta($sql5);




		/*while ($id <= $id2) {

			$sql1="SELECT idpg_pedidos FROM pg_pedidos WHERE idpg_pedidos='$id' AND estatus<>'ENTREGADO' AND estatus<>'CANCELADO' AND estatus2=1";
			$result = ejecutarConsultaSimpleFila($sql1);

			if ($result > 0) {*/

				//$contador = $contador+1;
					
					/*$sql="UPDATE pg_pedidos SET 
					cant_est=(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE idpedido='$id' AND estatus='Apartado')+
					(SELECT IFNULL(sum(cantidad),0) FROM pg_detped pd WHERE idpedido='$id' AND estatus='Fabricado')+
					(SELECT IFNULL(sum(cantidad),0) FROM pg_detped pd WHERE idpedido='$id' AND estatus='Existencia'), 
					estatus_docs = (SELECT IFNULL(count(iddocumentos),0) FROM documentos WHERE tipo=1 AND nombre<>'' AND idpedido='$id'), 
					fecha_valid_term=(IF((SELECT fecha_hora FROM pg_detped WHERE idpedido='$id' ORDER BY fecha_hora DESC LIMIT 1)>(SELECT fecha_hora2 FROM pg_detped WHERE idpedido='$id' ORDER BY fecha_hora2 DESC LIMIT 1),(SELECT fecha_hora FROM pg_detped WHERE idpedido='$id' ORDER BY fecha_hora DESC LIMIT 1),(SELECT fecha_hora2 FROM pg_detped WHERE idpedido='$id' ORDER BY fecha_hora2 DESC LIMIT 1))) 
					WHERE idpg_pedidos='$id'";
					ejecutarConsulta($sql);*/ 


					
				/*}						

			$id = $id + 1;

			if ($id>$id2) {
				return;
			}

		}*/
		
			
	}

	public function set_idpedido($id1,$id2)
	{
		while ($id1 <= $id2) {
			
			$sql="UPDATE pg_detped SET idpedido=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$id1') WHERE iddetalle_pedido='$id1'";
			ejecutarConsulta($sql);

			$id1 = $id1+1;

			if ($id1 > $id2) {
			   return;
			}
		}

		
				
	}


	public function listar_pedido_detalle_term($id)
	{			
		 /*$sql="SELECT pdp.idpg_detalle_pedidos,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pd.cantidad,(pdp.cantidad-pdp.cant_entregada) as pendiente,pdp.avance_he,pdp.avance_pi,pdp.avance_pl,pdp.avance_em,pdp.avance_ho,pdp.avance_ep,pdp.avance_ec,pd.estatus,pd.lote,pd.op, pdp.check_entrega,
		 	(SELECT count(idop_detalle) FROM op_detalle o WHERE o.idop=(SELECT idop FROM op WHERE no_op=pd.op) AND area=1) as Herreria_exist, 
			(SELECT count(idop_detalle) FROM op_detalle o WHERE o.idop=(SELECT idop FROM op WHERE no_op=pd.op) AND area=2) as Pintura_exist, 
			(SELECT count(idop_detalle) FROM op_detalle o WHERE o.idop=(SELECT idop FROM op WHERE no_op=pd.op) AND area=3) as Plasticos_exist, 
			(SELECT count(idop_detalle) FROM op_detalle o WHERE o.idop=(SELECT idop FROM op WHERE no_op=pd.op) AND area=5) as Ensamble_P_exist, 
			(SELECT count(idop_detalle) FROM op_detalle o WHERE o.idop=(SELECT idop FROM op WHERE no_op=pd.op) AND area=6) as Ensamble_C_exist, 
			(SELECT count(idop_detalle) FROM op_detalle o WHERE o.idop=(SELECT idop FROM op WHERE no_op=pd.op) AND area=7) as Ensamble_M_exist, 
			(SELECT count(idop_detalle) FROM op_detalle o WHERE o.idop=(SELECT idop FROM op WHERE no_op=pd.op) AND area=8) as Horno_exist,
			(SELECT SUM(cantidad) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos) as cantidad_entre
		  FROM pg_detalle_pedidos pdp INNER JOIN pg_detped pd ON pdp.idpg_detalle_pedidos=pd.iddetalle_pedido WHERE pdp.idpg_pedidos='$id'";*/

		  $sql="SELECT pdp.idpg_detalle_pedidos,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.cantidad,(pdp.cantidad-(SELECT IFNULL(SUM(cantidad),0) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos)) as pendiente, pdp.check_entrega,
		 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Fabricado') as cant_fabricado,
		 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Apartado') as cant_apartado,
		 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Existencia') as cant_existencia,
		 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Produccion') as cant_produccion,
		 	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=pdp.idpg_detalle_pedidos AND estatus='Otro') as cant_otro,
			(SELECT IFNULL(SUM(cantidad),0) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos) as cantidad_entre
		  FROM pg_detalle_pedidos pdp  WHERE pdp.idpg_pedidos='$id'";
        return ejecutarConsulta($sql); 			
	}

	public function check_prod_entrega($idpg_detalle_pedidos,$val_check)
	{

		$sql="UPDATE pg_detalle_pedidos SET check_entrega = '$val_check' WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
		return ejecutarConsulta($sql);
	}

	public function quitar_prod_entrega($idpg_detalle_pedidos)
	{

		$sql="UPDATE pg_detalle_pedidos SET check_entrega = '0' WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
		return ejecutarConsulta($sql);
	}

	public function buscar_check_prod($idpg_pedidos)
	{

		$sql="SELECT count(idpg_detalle_pedidos) as num_check FROM pg_detalle_pedidos WHERE idpg_pedidos='$idpg_pedidos' AND check_entrega=1";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function contar_salida()
	{

		$sql="SELECT count(idsalida) as num_salida FROM salidas WHERE estatus=0";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function consultar_direccion($idpg_pedidos)
	{

		$sql="SELECT * FROM dir_entregas_esp WHERE idpedido='$idpg_pedidos'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar_salidas()
	{

		$sql="SELECT s.idsalida,s.no_salida,DATE(s.fecha_salida) as fecha, TIME(s.fecha_salida) as hora,s.seleccionado,s.estatus,sr.nombre as repartidor,sv.nombre as vehiculo,s.idvehiculo FROM salidas s INNER JOIN salidas_repartidores sr ON s.idusuario=sr.idrepartidor INNER JOIN salidas_vehiculos sv ON s.idvehiculo=sv.idvehiculo WHERE s.estatus=0 ORDER BY s.fecha_salida ASC";
		return ejecutarConsulta($sql);
	}

	public function listar_entregas_new($id)
	{

		$sql="SELECT * FROM salidas_entregas WHERE idsalida='$id'";
		return ejecutarConsulta($sql);
	}

	public function guardar_entrega($idsalida,$cliente_new_e,$contacto_new_e,$dir_entrega_new_e,$num_entregas,$telefono_new_e,$horario_new_e,$condic_new_e,$medio_new_e,$idpedido)
	{
		/*$sql2="UPDATE salidas SET nom='$cliente_new_e',dom='$dir_entrega_new_e',contacto='$contacto_new_e',tel='$telefono_new_e',horario='$horario_new_e',cond='$condic_new_e', medio='$medio_new_e' WHERE idsalida='$idsalida'";
        return ejecutarConsulta($sql2);*/

		$sql="INSERT INTO salidas_entregas (idsalida,no_entrega,direccion,contacto,idpedido,nom_cliente,tel,horario,condiciones,medio) VALUES('$idsalida','$num_entregas','$dir_entrega_new_e','$contacto_new_e','$idpedido','$cliente_new_e','$telefono_new_e','$horario_new_e','$condic_new_e','$medio_new_e')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM salidas_entregas WHERE identrega='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);

	}

	public function listar_productos_new($id)
	{

		$sql="SELECT sed.idproducto,sed.identrega_detalle,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.observacion,sed.cantidad,sed.lote, sed.idproducto,sed.idpedido,sed.observaciones,
		(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=sed.idpedido) as no_control,
		(SELECT no_pedido FROM pg_pedidos WHERE idpg_pedidos=sed.idpedido) as no_pedido,
		(SELECT no_salida FROM salidas WHERE idsalida=sed.idsalida) as no_salida,
		(SELECT no_entrega FROM salidas_entregas WHERE identrega=sed.identrega) as no_salida_ent,
		(SELECT nombre FROM clientes WHERE idcliente=(SELECT idcliente FROM pg_pedidos WHERE idpg_pedidos=sed.idpedido)) as cliente,
		(SELECT direccion FROM salidas_entregas WHERE identrega=sed.identrega) as domicilio,
		(SELECT contacto FROM salidas_entregas WHERE identrega=sed.identrega) as contacto,
		(SELECT telefono_ent FROM dir_entregas_esp WHERE idpedido=sed.idpedido) as telefono,
		(SELECT hora_entrega_r1 FROM dir_entregas_esp WHERE idpedido=sed.idpedido) as hora1,
		(SELECT hora_entrega_r2 FROM dir_entregas_esp WHERE idpedido=sed.idpedido) as hora2,
		(SELECT IFNULL(sum(cantidad),0) FROM vale_salida WHERE iddetalle_pedido=sed.idproducto AND estatus=1) as cont_lote
		FROM salidas_entregas_detalles sed INNER JOIN pg_detalle_pedidos pdp ON sed.idproducto=pdp.idpg_detalle_pedidos WHERE sed.identrega='$id'";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_new_add($id)
	{

		$sql="SELECT sed.identrega_detalle,p.codigo,p.nombre as descripcion, p.medida, p.color, sed.cantidad,sed.lote, sed.idproducto,sed.idpedido, sed.observaciones,
		(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=sed.idpedido) as no_control,
		(SELECT no_entrega FROM salidas_entregas WHERE identrega=sed.identrega) as no_salida_ent
		FROM salidas_entregas_detalles sed INNER JOIN productos p ON sed.idprod_add=p.idproducto WHERE sed.identrega='$id'";
		return ejecutarConsulta($sql);
	}


	public function llenar_vale_salida($id)
	{

		$sql="SELECT se.no_entrega, se.nom_cliente,se.contacto,se.direccion,se.tel,se.horario,se.condiciones,se.medio,se.observaciones,
		(SELECT DATE(fecha_salida) FROM salidas WHERE idsalida=se.idsalida) as fecha_salida
		FROM salidas_entregas se WHERE identrega='$id'";
		return ejecutarConsulta($sql);
	}


	public function listar_productos_new_todos($idsalida,$nom_cliente_salida,$domicilio_cliente_salida,$contacto_cliente_salida,$telefono_cliente_salida,$horario_cliente_salida,$condiciones_cliente_salida,$medio_cliente_salida)
	{

		$sql="UPDATE salidas SET nom='$nom_cliente_salida',dom='$domicilio_cliente_salida',contacto='$contacto_cliente_salida',tel='$telefono_cliente_salida',horario='$horario_cliente_salida',cond='$condiciones_cliente_salida', medio='$medio_cliente_salida' WHERE idsalida='$idsalida'";
		ejecutarConsulta($sql);

		$sql2="SELECT * FROM salidas WHERE idsalida='$idsalida'";
		return ejecutarConsulta($sql2);
	}

	public function listar_productos_new_salidas($id)
	{

		$sql="SELECT sed.identrega,sed.idproducto,sed.identrega_detalle,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.observacion,sed.cantidad, 
		(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=sed.idpedido) as no_control,
		(SELECT no_entrega FROM salidas_entregas WHERE identrega=sed.identrega) as no_entrega
		FROM salidas_entregas_detalles sed INNER JOIN pg_detalle_pedidos pdp ON sed.idproducto=pdp.idpg_detalle_pedidos WHERE sed.idsalida='$id'";
		return ejecutarConsulta($sql);
	}

	public function listar_prod_selec($id)
	{

		$sql2="UPDATE pg_detalle_pedidos SET prod_entregar = 0 WHERE idpg_pedidos='$id'";
		ejecutarConsulta($sql2);

		$sql="SELECT pdp.idpg_detalle_pedidos,pdp.cantidad,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.observacion,pdp.cantidad,
		(SELECT IFNULL(SUM(cantidad),0) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos) as entregado,
		(pdp.cantidad-(SELECT IFNULL(SUM(cantidad),0) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos)) as pendiente 
		FROM pg_detalle_pedidos pdp WHERE pdp.idpg_pedidos='$id' AND pdp.check_entrega=1 AND (SELECT IFNULL(SUM(cantidad),0) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos)<pdp.cantidad";
		return ejecutarConsulta($sql);
	}

	public function contar_ceros($idpedido)
	{
		$sql="SELECT count(pdp.idpg_detalle_pedidos) as num_ceros FROM pg_detalle_pedidos pdp WHERE pdp.idpg_pedidos='$idpedido' AND pdp.check_entrega=1 AND pdp.prod_entregar=0 AND (SELECT IFNULL(SUM(cantidad),0) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos)<pdp.cantidad";
		return ejecutarConsultaSimpleFila($sql);

	}

	

	public function guardar_prod_ent($idpedido,$identrega)
	{
		$sql="SELECT pdp.idpg_detalle_pedidos,
		(SELECT identrega_detalle FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos AND identrega='$identrega') as identrega_detalle_s
		FROM pg_detalle_pedidos pdp WHERE pdp.idpg_pedidos='$idpedido' AND pdp.check_entrega=1 AND (SELECT IFNULL(SUM(cantidad),0) FROM salidas_entregas_detalles WHERE idproducto=pdp.idpg_detalle_pedidos)<pdp.cantidad";
		return ejecutarConsulta($sql);

	}

	



	public function act_cant_entregar($idpg_detalle_pedidos,$cantidad)
	{

		$sql="UPDATE pg_detalle_pedidos SET prod_entregar='$cantidad' WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
		return ejecutarConsulta($sql);

	}

	public function consul_pend_ent($idpg_detalle_pedidos)
	{

		$sql="SELECT * FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function buscar_pedido_datos($idpg_pedidos)
	{

		$sql="SELECT p.no_control,c.nombre,d.contacto_ent,d.calle_ent,d.numero_ent,d.interior_ent,d.colonia_ent,d.ciudad_ent,d.estado_ent,d.cp_ent FROM pg_pedidos p INNER JOIN dir_entregas_esp d ON p.idpg_pedidos=d.idpedido INNER JOIN clientes c ON p.idcliente=c.idcliente WHERE idpg_pedidos='$idpg_pedidos'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function consul_entrega($identrega)
	{

		$sql="SELECT * FROM salidas_entregas WHERE identrega='$identrega'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function seleccionar_salida($idsalida)
	{
		$sql2="UPDATE salidas SET seleccionado=0";
		ejecutarConsulta($sql2);

		$sql3="UPDATE salidas_entregas SET seleccionado=0";
		ejecutarConsulta($sql3);

		$sql="UPDATE salidas SET seleccionado=1 WHERE idsalida='$idsalida'";
		return ejecutarConsulta($sql);

	}

	public function seleccionar_entrega($identrega)
	{
		$sql2="UPDATE salidas_entregas SET seleccionado=0";
		ejecutarConsulta($sql2);

		$sql="UPDATE salidas_entregas SET seleccionado=1 WHERE identrega='$identrega'";
		return ejecutarConsulta($sql);

	}

	public function guardar_salida($no_salida,$fecha_hora,$idrepartidor,$idvehiculo)
	{

		$sql="INSERT INTO salidas (no_salida,fecha_creacion,fecha_salida,idusuario,idvehiculo) VALUES('$no_salida','$fecha_hora','$fecha_hora','$idrepartidor','$idvehiculo')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT s.idsalida,s.no_salida,s.fecha_salida,sr.nombre as nom_repartidor, sv.nombre as nom_vehiculo FROM salidas s INNER JOIN salidas_repartidores sr ON s.idusuario=sr.idrepartidor INNER JOIN salidas_vehiculos sv ON s.idvehiculo=sv.idvehiculo WHERE s.idsalida='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);

	}

	public function upd_salida($idsalida,$fecha_hora,$idrepartidor,$idvehiculo)
	{

		$sql="UPDATE salidas SET fecha_salida='$fecha_hora', idusuario = '$idrepartidor', idvehiculo='$idvehiculo' WHERE idsalida='$idsalida'";
		return ejecutarConsulta($sql);

	}

	public function ult_salida()
	{

		$sql="SELECT MAX(no_salida) as no_salida FROM salidas";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function listar_choferes()
	{

		$sql="SELECT * FROM salidas_repartidores ORDER BY nombre ASC";
		return ejecutarConsulta($sql);

	}

	public function listar_vehiculos()
	{

		$sql="SELECT * FROM salidas_vehiculos ORDER BY nombre ASC";
		return ejecutarConsulta($sql);

	}

	public function deselect_salida()
	{
		$sql="UPDATE salidas_entregas SET seleccionado=0";
		ejecutarConsulta($sql);

		$sql2="UPDATE salidas SET seleccionado=0";
		return ejecutarConsulta($sql2);

	}

	public function Borrar_salida($idsalida)
	{
		$sql="DELETE FROM salidas_entregas WHERE idsalida='$idsalida'";
		ejecutarConsulta($sql);

		$sql2="DELETE FROM salidas_entregas_detalles WHERE idsalida='$idsalida'";
		ejecutarConsulta($sql2);

		$sql3="DELETE FROM salidas WHERE idsalida='$idsalida'";
		return ejecutarConsulta($sql3);

	}

	public function consulta_entrega($id)
	{

		$sql="SELECT s.fecha_salida,s.no_salida,
		(SELECT nombre FROM clientes WHERE idcliente=(SELECT idcliente FROM pg_pedidos WHERE idpg_pedidos=se.idpedido)) as nom_cliente
		 FROM salidas_entregas se INNER JOIN salidas s ON se.idsalida=s.idsalida WHERE se.identrega='$id'";
		return ejecutarConsulta($sql);

	}

	public function consulta_salida($id,$idusuario)
	{

		$sql="SELECT s.fecha_solicitud,s.no_salida, (SELECT CONCAT(nombre,' ',apellido_p,' ',apellido_m) FROM usuario WHERE idusuario='$idusuario') as nombre_completo, (SELECT area FROM usuario WHERE idusuario='$idusuario') as area  FROM salidas s WHERE s.idsalida='$id'";
		return ejecutarConsulta($sql);

	}


	public function consulta_vale_alm($id)
	{

		$sql="SELECT v.fecha_hora_solic, v.no_vale, (SELECT CONCAT(nombre,' ',apellido_p,' ',apellido_m) FROM usuario WHERE idusuario=v.idusuario) as nombre_completo, (SELECT nombre FROM area WHERE idarea = (SELECT area FROM usuario WHERE idusuario=v.idusuario)) as area FROM vales_almacen v WHERE v.idvales_almacen='$id'";
		return ejecutarConsulta($sql);

	}



	public function buscar_datos_usuario($idusuario)
	{

		$sql="SELECT CONCAT(nombre,' ',apellido_p,' ',apellido_m) as nombre_completo FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);

	}


	public function listar_productos_solic_alm($id)
	{

		$sql="SELECT sed.identrega,sed.idproducto,sed.identrega_detalle,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.observacion,sed.cantidad, (SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=sed.idpedido) as no_control FROM salidas_entregas_detalles sed INNER JOIN pg_detalle_pedidos pdp ON sed.idproducto=pdp.idpg_detalle_pedidos WHERE sed.idsalida='$id'";
		return ejecutarConsulta($sql);
	}

	public function listar_productos_vale($id)
	{

		$sql="SELECT vs.idvale_salida,vs.cantidad,vs.lote,vs.control,vs.op,
		(SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=vs.iddetalle_pedido) as codigo,
		(SELECT color FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=vs.iddetalle_pedido) as color,
		(SELECT medida FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=vs.iddetalle_pedido) as medida,
		(SELECT descripcion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=vs.iddetalle_pedido) as descripcion
		FROM vale_salida vs WHERE vs.idvales_almacen='$id' AND vs.estatus<2";
		return ejecutarConsulta($sql);
	}


	public function listar_productos_solic_alm_2($id)
	{

		$sql="SELECT sed.identrega,sed.idproducto,sed.identrega_detalle,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.observacion,sed.cantidad,sed.lote,sed.observaciones,sed.exc, sed.idprod_add,
		(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=sed.idpedido) as no_control

		FROM salidas_entregas_detalles sed INNER JOIN pg_detalle_pedidos pdp ON sed.idproducto=pdp.idpg_detalle_pedidos WHERE sed.identrega='$id'";
		return ejecutarConsulta($sql);


		
	}

	public function listar_productos_solic_alm_2_add($id)
	{

		/*$sql="SELECT sed.identrega,sed.idproducto,sed.identrega_detalle,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.observacion,sed.cantidad,sed.lote,sed.observaciones, 
		(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=sed.idpedido) as no_control

		FROM salidas_entregas_detalles sed INNER JOIN pg_detalle_pedidos pdp ON sed.idproducto=pdp.idpg_detalle_pedidos WHERE sed.identrega='$id'";
		return ejecutarConsulta($sql);*/


		$sql="SELECT sed.identrega_detalle,p.codigo,p.nombre as descripcion, p.medida, p.color, sed.cantidad,sed.lote,sed.observaciones,sed.exc, sed.idprod_add,
		(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=sed.idpedido) as no_control,
		(SELECT observacion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto) as observacion
		FROM salidas_entregas_detalles sed INNER JOIN productos p ON sed.idprod_add=p.idproducto WHERE sed.identrega='$id'";
		return ejecutarConsulta($sql);
	}

	/*,
		(SELECT lote FROM op_avance_prod WHERE idop_detalle_prod=(SELECT idop_detalle_prod FROM op_detalle_prod odp WHERE (SELECT iddetalle_pedido FROM pg_detped WHERE idpg_detped=odp.idpg_detped LIMIT 1)=sed.idproducto) ORDER BY LENGTH(lote) DESC LIMIT 1) as lote,
		(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=(SELECT idop_detalle_prod FROM op_detalle_prod odp WHERE (SELECT iddetalle_pedido FROM pg_detped WHERE idpg_detped=odp.idpg_detped LIMIT 1)=sed.idproducto) ORDER BY LENGTH(lote) DESC LIMIT 1) as avance*/

	public function listar_lotes_cant($iddetalle_pedido)
	{

		$sql2="SELECT pdp.idpg_detped,
		IF(pdp.estatus='Produccion' OR pdp.estatus='Fabricado',CONCAT((SELECT lote FROM op_avance_prod oap WHERE oap.idop_detalle_prod=(SELECT idop_detalle_prod FROM op_detalle_prod odp WHERE odp.idpg_detped=pdp.idpg_detped) ORDER BY (SELECT num_proc FROM area WHERE idarea=oap.area) DESC LIMIT 1)),'') as lote2

		FROM pg_detped pdp WHERE pdp.iddetalle_pedido='$iddetalle_pedido'";
		return ejecutarConsulta($sql2);
	}


	/*IF(pdp.estatus='Produccion' OR pdp.estatus='Fabricado',CONCAT((SELECT lote FROM op_avance_prod oap WHERE oap.idop_detalle_prod=(SELECT idop_detalle_prod FROM op_detalle_prod odp WHERE odp.idpg_detped=pdp.idpg_detped) ORDER BY (SELECT num_proc FROM area WHERE idarea=oap.area) DESC LIMIT 1),' (',(SELECT avance FROM op_avance_prod WHERE idop_detalle_prod=(SELECT idop_detalle_prod FROM op_detalle_prod odp WHERE odp.idpg_detped=pdp.idpg_detped) ORDER BY LENGTH(lote) DESC LIMIT 1),') '),'') as lote2*/

	public function listar_productos_solic_alm_2_tot($idsalida)
	{

		$sql="SELECT sed.identrega,sed.idproducto,sed.identrega_detalle,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.observacion,sed.cantidad, (SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=sed.idpedido) as no_control FROM salidas_entregas_detalles sed INNER JOIN pg_detalle_pedidos pdp ON sed.idproducto=pdp.idpg_detalle_pedidos WHERE sed.idsalida='$idsalida'";
		return ejecutarConsulta($sql);
	}


	public function contar_entregas_dia($idsalida)
	{			
				$sql="SELECT max(no_entrega) as num_entregas FROM salidas_entregas";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsultaSimpleFila($sql);						
	}

	public function guardar_chofer($nom_chofer)
	{			
				$sql="INSERT INTO salidas_repartidores (nombre) VALUES('$nom_chofer')";
				//return ejecutarConsultaSimpleFila($sql);
				$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM salidas_repartidores WHERE idrepartidor='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);						
	}

	public function guardar_vehiculo($nom_vehiculo)
	{			
				$sql="INSERT INTO salidas_vehiculos (nombre) VALUES('$nom_vehiculo')";
				//return ejecutarConsultaSimpleFila($sql);
				$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM salidas_vehiculos WHERE idvehiculo='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);						
	}

















































	public function agregar_producto_entrega($fecha)
	{

		$sql="SELECT count(idsalida) as cant_salidas FROM salidas WHERE DATE(fecha_salida) = '$fecha'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function crear_salida($fecha_hora)
	{

		$sql="INSERT INTO salidas (fecha_creacion,fecha_salida,idusuario,idvehiculo) VALUES('$fecha_hora','$fecha_hora','0','0')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		//$fecha=DATE($fecha_hora);

		$sql_id="SELECT * FROM salidas WHERE idsalida = '$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);
	}

	

	public function crear_entrega($idsalida,$idpg_detalle_pedidos)
	{

		$sql="INSERT INTO salidas_entregas (idsalida) VALUES('$idsalida')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql2="INSERT INTO salidas_entregas_detalles (identrega,idproducto,cantidad) SELECT '$idingresonew','$idpg_detalle_pedidos',cantidad FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
		return ejecutarConsulta($sql2);
	}

	public function consultar_salida($idsalida)
	{

		$sql="SELECT idsalida, DATE(fecha_salida) as fecha FROM salidas WHERE idsalida='$idsalida'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar_salidas_entregas($id)
	{

		$sql="SELECT se.identrega, 
		(SELECT contacto_ent FROM dir_entregas_esp WHERE idpedido = (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto)) as contacto,
		(SELECT calle_ent FROM dir_entregas_esp WHERE idpedido = (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto)) as calle,
		(SELECT numero_ent FROM dir_entregas_esp WHERE idpedido = (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto)) as numero, 
		(SELECT interior_ent FROM dir_entregas_esp WHERE idpedido = (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto)) as interior,
		(SELECT colonia_ent FROM dir_entregas_esp WHERE idpedido = (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto)) as colonia,
		(SELECT ciudad_ent FROM dir_entregas_esp WHERE idpedido = (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto)) as ciudad,
		(SELECT estado_ent FROM dir_entregas_esp WHERE idpedido = (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto)) as estado,
		(SELECT cp_ent FROM dir_entregas_esp WHERE idpedido = (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto)) as cp,
		(SELECT telefono_ent FROM dir_entregas_esp WHERE idpedido = (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto)) as telefono,
		(SELECT email_ent FROM dir_entregas_esp WHERE idpedido = (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto)) as email,
		(SELECT det_forma_entrega FROM dir_entregas_esp WHERE idpedido = (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=sed.idproducto)) as detalle_de_entrega
		FROM salidas_entregas se INNER JOIN salidas_entregas_detalles sed ON se.identrega=sed.identrega WHERE se.idsalida='$id'";
		return ejecutarConsulta($sql);
	}

	public function consultar_entrega($idsalida)
	{

		$sql="SELECT 
		 (SELECT identregas FROM dir_entregas_esp WHERE idpedido = (SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=s.idproducto)) as iddir_entrega,
		 (SELECT identrega FROM salidas_entregas WHERE identrega=s.identrega) as identrega
		 FROM salidas_entregas_detalles s WHERE (SELECT idsalida FROM salidas_entregas WHERE identrega=s.identrega)='$idsalida' ORDER BY s.identrega_detalle ASC LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);
	}

	

	public function listar_entregas_detalles($id,$direccion)
	{
		$sql2="UPDATE salidas_entregas SET direccion = '$direccion' WHERE identrega='$id'";
		ejecutarConsulta($sql2);

		$sql="SELECT sed.identrega_detalle,pdp.codigo,pdp.descripcion,pdp.medida,pdp.color,pdp.observacion,pdp.cantidad FROM salidas_entregas_detalles sed INNER JOIN pg_detalle_pedidos pdp ON sed.idproducto=pdp.idpg_detalle_pedidos WHERE sed.identrega='$id'";
		return ejecutarConsulta($sql);
	}

	public function buscar_salida($idsalida)
	{

		$sql="SELECT DATE(fecha_salida) as fecha, TIME(fecha_salida) as hora, idusuario, idvehiculo FROM salidas WHERE idsalida='$idsalida'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function guardar_producto($identrega,$idproducto)
	{

		$sql2="INSERT INTO salidas_entregas_detalles (identrega,idproducto,cantidad) SELECT '$identrega','$idproducto',cantidad FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$idproducto'";
		return ejecutarConsulta($sql2);
	}

	public function listar_salidas_set($id)
	{

		$sql="SELECT idsalida,DATE(fecha_salida) as fecha, TIME(fecha_salida) as hora FROM salidas WHERE DATE(fecha_salida)='$id' ORDER BY fecha_salida ASC";
		return ejecutarConsulta($sql);
	}

	public function set_idproducto($id1,$id2)
	{
		while ($id1 <= $id2) {
			
			$sql="UPDATE pg_detped SET idproducto=(SELECT idproducto FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$id1') WHERE iddetalle_pedido='$id1'";
			ejecutarConsulta($sql);

			$id1 = $id1+1;

			if ($id1 > $id2) {
			   return;
			}
		}

		
				
	}

	public function revisar_sinfecha()
	{

		$sql="SELECT count(idpg_pedidos) as num_sinfecha FROM pg_pedidos WHERE (fecha_entrega='' AND estatus2=1 AND estatus<>'ENTREGADO') AND (fecha_entrega='' AND estatus2=1 AND estatus<>'CANCELADO')";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function listar_entregas_prog()
	{

		$sql="SELECT s.idsalida,s.fecha_salida,s.idusuario,s.idvehiculo,se.contacto,se.direccion,se.estatus FROM salidas_entregas se INNER JOIN salidas s WHERE se.idsalida=s.idsalida";
		return ejecutarConsulta($sql);

	}

	public function listar_coment_prod($id)
	{

		$sql="SELECT
		(SELECT no_op FROM op WHERE idop=(SELECT idop FROM op_detalle_prod WHERE idop_detalle_prod=oap.idop_detalle_prod)) as no_op, 
		(SELECT nombre FROM area WHERE idarea = oap.area) as nom_area,
		(SELECT codigo FROM op_detalle_prod WHERE idop_detalle_prod = oap.idop_detalle_prod) as codigo,
		(SELECT producto FROM op_detalle_prod WHERE idop_detalle_prod = oap.idop_detalle_prod) as descrip,oap.comentario
		FROM op_avance_prod oap WHERE oap.comentario<>'' AND oap.idpedido='$id'";
		return ejecutarConsulta($sql);

	}


	public function listar_etiquetas()
	{

		$sql="SELECT * FROM talento ORDER BY nombre ASC";
		return ejecutarConsulta($sql);

	}

	public function listar_op_control($id)
	{

		$sql="SELECT DISTINCT p.no_control, p.no_pedido FROM salidas_entregas_detalles sed INNER JOIN pg_pedidos p ON sed.idpedido=p.idpg_pedidos WHERE sed.identrega='$id'";
		return ejecutarConsulta($sql);

	}

	public function listar_op_control_tot($idsalida)
	{

		$sql="SELECT DISTINCT p.no_control, p.no_pedido FROM salidas_entregas_detalles sed INNER JOIN pg_pedidos p ON sed.idpedido=p.idpg_pedidos WHERE sed.idsalida='$idsalida'";
		return ejecutarConsulta($sql);

	}
	

	public function consul_estatus_pedido($idpedido)
	{

		$sql="SELECT estatus as estatus_pedido FROM pg_pedidos WHERE idpg_pedidos='$idpedido'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function listar_lotes_vale_alm($idvale_salida)
	{

		$sql="SELECT lote, op, cantidad FROM presalida WHERE identrega = '$idvale_salida' AND via_consul=1 AND (SELECT estatus FROM vales_almacen WHERE idvales_almacen=(SELECT idvales_almacen FROM vale_salida WHERE idvale_salida='$idvale_salida'))=2";
		return ejecutarConsulta($sql);

	}

	public function listar_lotes_vale_alm2($iddetalle_pedido)
	{

		$sql="SELECT lote, op, cantidad FROM presalida WHERE iddetalle_pedido = '$iddetalle_pedido' AND via_consul=1 AND (SELECT estatus FROM vales_almacen WHERE idvales_almacen=(SELECT idvales_almacen FROM vale_salida WHERE iddetalle_pedido='$iddetalle_pedido'))=2";
		return ejecutarConsulta($sql);

	}

	public function contar_estatus_ped($idpedido)
	{

		$sql="SELECT 

		(SELECT IFNULL(sum(cantidad),0) FROM pg_detalle_pedidos WHERE idpg_pedidos='$idpedido') as cant_tot,
		(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE idpedido='$idpedido')  as cant_estatus

		FROM pg_detalle_pedidos WHERE idpg_pedidos='$idpedido'";
		return ejecutarConsultaSimpleFila($sql);


	}

	public function guardar_producto_nuevo($codigo,$nombre,$tipo,$modelo,$tamano,$estatus,$tipo_fab)
	{

		$sql="INSERT INTO productos_clasif (codigo_match,descripcion,idtipo,idmodelo,idtamano,estatus,marca_f,esp) VALUES('$codigo','$nombre','$tipo','$modelo','$tamano','$estatus','1','$tipo_fab')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_insert="SELECT * FROM productos_clasif WHERE idproductos_clasif='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_insert);


	}


	public function reporte_prod_estatus()
	{

		$sql="SELECT p.no_control,p.estatus,
		(SELECT lugar FROM usuario WHERE idusuario=p.idusuario) as lugar,
		(SELECT nombre FROM clientes WHERE idcliente=p.idcliente) as cliente,
		(SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as codigo,
		(SELECT medida FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as medida,
		(SELECT color FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as color,
		(SELECT descripcion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as descripcion,
		(SELECT observacion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as observacion,
		pd.cantidad,pd.estatus,pd.op,pd.observ_enlace
		FROM pg_detped pd INNER JOIN pg_pedidos p ON pd.idpedido=p.idpg_pedidos WHERE p.estatus<>'CANCELADO' AND p.estatus<>'ENTREGADO' ORDER BY p.no_control ASC";
		return ejecutarConsulta($sql);

	}

	public function upd_fecha_salida($idsalida,$fecha_hora_salida_input)
	{

		$sql="UPDATE salidas SET fecha_salida='$fecha_hora_salida_input' WHERE idsalida='$idsalida'";
		return ejecutarConsulta($sql);
	}

	public function borrar_entrega2($identrega)
	{

		$sql="UPDATE salidas_entregas SET estatus=1 WHERE identrega='$identrega'";
		ejecutarConsulta($sql);

		$sql_2="DELETE FROM salidas_entregas_detalles WHERE identrega = '$identrega'";
		return ejecutarConsulta($sql_2);

	}

	public function consul_prod_capt($id_ped_temp)
	{

		$sql_2="SELECT IFNULL(SUM(cantidad),0) cant_prod FROM pg_detalle_pedidos WHERE idpg_pedidos='$id_ped_temp'";
		return ejecutarConsulta($sql_2);

	}


}
?>

