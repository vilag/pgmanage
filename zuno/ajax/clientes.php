<?php 
require_once "../modelos/Clientes.php";

$clientes=new Clientes();

switch ($_GET["op"]){
	

	case 'listar':

		$rspta=$clientes->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="consul_cliente('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button>',
 				//"1"=>$reg->customer_id,
 				"1"=>$reg->no_cliente,
 				//"2"=>$reg->num_pedido,
 				
 				"2"=>$reg->nombre,
 				"3"=>$reg->fecha_reg

 				//"5"=>$reg->estatus
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

	
	case 'guardar_cliente':

		$num_cliente_new = $_POST['num_cliente_new'];
		$nombre_new = $_POST['nombre_new'];
		$email_new = $_POST['email_new'];
		$telefono_new = $_POST['telefono_new'];
		$rfc_new = $_POST['rfc_new'];
		$calle_new = $_POST['calle_new'];
		$numero_new = $_POST['numero_new'];
		$interior_new = $_POST['interior_new'];
		$colonia_new = $_POST['colonia_new'];
		$municipio_new = $_POST['municipio_new'];
		$estado_new = $_POST['estado_new'];
		$referencia_new = $_POST['referencia_new'];
		$fecha_hora = $_POST['fecha_hora'];
		

		$rspta=$clientes->guardar_cliente($num_cliente_new,$nombre_new,$email_new,$telefono_new,$rfc_new,$calle_new,$numero_new,$interior_new,$colonia_new,$municipio_new,$estado_new,$referencia_new,$fecha_hora);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'buscar_nom_cli':

		$nombre_new = $_POST['nombre_new'];

		$rspta=$clientes->buscar_nom_cli($nombre_new);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'consul_cliente':

		$idcliente = $_POST['idcliente'];

		$rspta=$clientes->consul_cliente($idcliente);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'listar_historico_pedidos':

		$no_cliente = $_REQUEST['no_cliente'];

		$rspta=$clientes->listar_historico_pedidos($no_cliente);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				
 				"0"=>$reg->num_pedido,
 				"1"=>$reg->fecha_hora,
 				"2"=>$reg->estatus
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'listar_historico_ventas':

		$no_cliente = $_REQUEST['no_cliente'];

		$rspta=$clientes->listar_historico_ventas($no_cliente);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				
 				"0"=>$reg->folio,
 				"1"=>$reg->descripcion,
 				"2"=>$reg->total_pago,
 				"3"=>$reg->fecha_hora
 				

 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	
}
?>