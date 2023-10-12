<?php 
require_once "../modelos/Hist_invv.php";

$hist_invv=new Hist_invv();

switch ($_GET["op"]){
	

	case 'listar':

		$rspta=$hist_invv->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//"0"=>'<button class="btn btn-warning" onclick="abrir_modal('.$reg->idventa.')"><i class="fa fa-pencil"></i></button>',
 				//"1"=>$reg->customer_id,
 				"0"=>$reg->fecha_hora,
 				"1"=>$reg->codigo_prod,
 				
 				"2"=>$reg->exist_base,
 				"3"=>$reg->tipo,
 				"4"=>$reg->exist_actual,
 				"5"=>$reg->movimiento,
 				"6"=>$reg->idventa,
 				"7"=>'<button class="btn btn-warning" onclick="ver_venta('.$reg->idventa.')"><i class="fa fa-pencil">Detalles de venta</i></button>'
 				
 			
 				
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

	
	
	
}
?>