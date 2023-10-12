<?php 
require_once "../modelos/Consulta.php";

$consulta=new Consulta();

switch ($_GET["op"]){
	

	case 'listar':

		$rspta=$consulta->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nombre,
 				//"1"=>$reg->customer_id,
 				"1"=>$reg->email
 				//"2"=>$reg->num_pedido,

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