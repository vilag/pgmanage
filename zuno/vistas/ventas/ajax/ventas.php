<?php 
require_once "../modelos/Ventas.php";

$ventas=new Ventas();

switch ($_GET["op"]){
	

	case 'listar':

		$rspta=$ventas->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$url='../../reportes/exTicket.php?id=';
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar_detalle_venta('.$reg->idventa.')"><i class="fa fa-pencil"></i></button>'.'<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>',
 				//
 				"1"=>$reg->folio,
 				//"2"=>$reg->no_cliente,
 				"2"=>$reg->nom_cliente,
 				
 				
 				//"3"=>$reg->folio,
 				"3"=>$reg->descripcion,
 				"4"=>$reg->total_pago,
 				
 				"5"=>$reg->fecha_hora,
 				"6"=>($reg->estatus)?'<span class="label bg-green">Aprobado</span>':
 				'<span class="label bg-red">Cancelado</span>'
 				
 				/*"5"=>($reg->estatus)?'<span class="label bg-green">Entregado</span>':
 				'<span class="label bg-red">Pendiente</span>'*/
 				
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'listarProd':
		require_once "../modelos/Ventas.php";
		$ventas=new Ventas();

		$rspta=$ventas->listarProd();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idinventario_zuno.',\''.$reg->codigo_producto.'\',\''.$reg->descripcion.'\',\''.$reg->imagen.'\',\''.$reg->precio.'\',\''.$reg->existencia.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->codigo_producto,
 				"2"=>$reg->descripcion,
 				"3"=>$reg->existencia,
 				"4"=>'<img src="../../images/productos/'.$reg->imagen.'" width="150" height="150" onclick="detalle_prod('.$reg->idinventario_zuno.')">'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;


	

	case 'select_cliente':
		require_once "../modelos/Ventas.php";
		$ventas=new Ventas();

		$rspta = $ventas->select_cliente();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idcliente . '>' . $reg->no_cliente ." - ". $reg->nombre . '</option>';
				}
	break;

	case 'select_cliente_id':
		//require_once "../modelos/Ventas.php";
		//$ventas=new Ventas();

		$idcliente = $_POST['idcliente'];

		$rspta = $ventas->select_cliente($idcliente);

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idcliente . '>' . $reg->no_cliente ." - ". $reg->nombre . '</option>';
				}
	break;

	case 'guardar_venta':

		$idcliente = $_POST['idcliente'];
		$idusuario = $_POST['idusuario'];
		$v_descripcion = $_POST['v_descripcion'];
		$v_total_pago = $_POST['v_total_pago'];
		$v_forma_pago = $_POST['v_forma_pago'];
		$v_banco = $_POST['v_banco'];
		$v_ref = $_POST['v_ref'];
		$v_comp = $_POST['v_comp'];
		$v_coment = $_POST['v_coment'];
		$v_estatus = $_POST['v_estatus'];
		$v_fecha_hora = $_POST['v_fecha_hora'];

		
		$rspta=$ventas->guardar_venta($idcliente,$idusuario,$v_descripcion,$v_total_pago,$v_forma_pago,$v_banco,$v_ref,$v_comp,$v_coment,$v_estatus,$v_fecha_hora);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);

	break;

	case 'save_detalle_venta':

		$idventa = $_POST['idventa'];
		$idinv = $_POST['idinv'];
		$codigo_p = $_POST['codigo_p'];
		//$descrip_p = $_POST['descrip_p'];
		$precio_p = $_POST['precio_p'];
		$cant_p = $_POST['cant_p'];
		$subt_p = $_POST['subt_p'];
		$v_fecha_hora = $_POST['v_fecha_hora'];

		$marca_pedido = $_POST['marca_pedido'];
			
		$rspta=$ventas->save_detalle_venta($idventa,$idinv,$codigo_p,$precio_p,$cant_p,$subt_p,$v_fecha_hora,$marca_pedido);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);

	break;


	case 'guardar_comprobante':

			$ar_coment = $_FILES["ar_comprob"];			
			$nom=$_FILES['ar_comprob']['name'];
			$ruta_anterior=$_FILES['ar_comprob']['tmp_name'];
			$ruta="../files/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);

			$rspta=$ventas->guardar_comprobante($nom);
	 		echo json_encode($rspta);
	break;

	case 'mostrar_detalle_venta':
			$idventa = $_POST['idventa'];
			$rspta=$ventas->mostrar_detalle_venta($idventa);
	 		echo json_encode($rspta);
	break;

	case 'mostrar_compr_venta':

			$idventa = $_POST['idventa'];
			$idcomprob = $_POST['idcomprob'];

			$rspta=$ventas->mostrar_compr_venta($idventa,$idcomprob);
	 		echo json_encode($rspta);
	break;

	case 'update_coment':

			$c_comentario = $_POST['c_comentario'];
			$c_folio = $_POST['c_folio'];

			$rspta=$ventas->update_coment($c_comentario, $c_folio);
	 		echo json_encode($rspta);
	break;

	case 'ventas_enero':

			$rspta=$ventas->ventas_enero();
	 		echo json_encode($rspta);
	break;

	case 'ventas_febrero':

			$rspta=$ventas->ventas_febrero();
	 		echo json_encode($rspta);
	break;

	case 'ventas_marzo':

			$rspta=$ventas->ventas_marzo();
	 		echo json_encode($rspta);
	break;
	case 'ventas_abril':

			$rspta=$ventas->ventas_abril();
	 		echo json_encode($rspta);
	break;
	case 'ventas_mayo':

			$rspta=$ventas->ventas_mayo();
	 		echo json_encode($rspta);
	break;
	case 'ventas_junio':

			$rspta=$ventas->ventas_junio();
	 		echo json_encode($rspta);
	break;
	case 'ventas_julio':

			$rspta=$ventas->ventas_julio();
	 		echo json_encode($rspta);
	break;
	case 'ventas_agosto':

			$rspta=$ventas->ventas_agosto();
	 		echo json_encode($rspta);
	break;
	case 'ventas_septiembre':

			$rspta=$ventas->ventas_septiembre();
	 		echo json_encode($rspta);
	break;
	case 'ventas_octubre':

			$rspta=$ventas->ventas_octubre();
	 		echo json_encode($rspta);
	break;
	case 'ventas_noviembre':

			$rspta=$ventas->ventas_noviembre();
	 		echo json_encode($rspta);
	break;
	case 'ventas_diciembre':

		$anio_grafica = $_POST['anio_grafica'];

			$rspta=$ventas->ventas_diciembre($anio_grafica);
	 		echo json_encode($rspta);
	break;

	case 'select_color':
		require_once "../modelos/Ventas.php";
		$ventas=new Ventas();

		$idinventario_zuno = $_POST['idinventario_zuno'];

		$rspta = $ventas->select_color($idinventario_zuno);

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->iddetalle_inventario_zuno . '>' . $reg->color . '</option>';
				}
	break;
	
}
?>