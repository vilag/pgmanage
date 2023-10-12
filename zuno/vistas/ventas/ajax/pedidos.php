<?php 
require_once "../modelos/Pedidos.php";

$pedidos=new Pedidos();

switch ($_GET["op"]){
	

	case 'listar':

		$rspta=$pedidos->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="abrir_modal('.$reg->idpedidos.')"><i class="fa fa-pencil"></i></button>',
 				//"1"=>$reg->customer_id,
 				"1"=>$reg->num_cliente,
 				"2"=>$reg->num_pedido,
 				
 				"3"=>$reg->nombre,
 				"4"=>$reg->fecha_hora,

 				"5"=>$reg->estatus
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


	case 'generar':


			require '../../pdf/fpdf/fpdf.php';

			$pdf = new FPDF();

			$pdf->AddPage();
			$pdf->SetFont('Arial','B',15);

			$pdf->Cell(100,10, 'Hola Mundo', 1, 0, 'C');
			$pdf->Cell(100,10, 'Hola Mundo', 1, 0, 'C');

			$pdf->Output();



	break;

	
	
}
?>