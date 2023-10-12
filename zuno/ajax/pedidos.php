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

	
	case 'guardar_pedido':

		$num_cliente = $_POST['num_cliente'];
		$num_pedido = $_POST['num_pedido'];
		$nombre = $_POST['nombre'];
		$fecha_hora = $_POST['fecha_hora'];
		

		$rspta=$pedidos->guardar_pedido($num_cliente,$num_pedido,$nombre,$fecha_hora);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;


	case 'generar_pedido':

		
		require '../excel/Classes/PHPExcel.php';
		require '../excel/conexion.php';
		
		//Consulta
		$sql = "SELECT idcliente, nombre, email, telefono FROM clientes";
		$resultado = $mysqli->query($sql);
		$fila = 7; //Establecemos en que fila inciara a imprimir los datos
		
		$gdImage = imagecreatefrompng('../excel/images/logo.png');//Logotipo
		
		//Objeto de PHPExcel
		$objPHPExcel  = new PHPExcel();
		
		//Propiedades de Documento
		$objPHPExcel->getProperties()->setCreator("Marko robles")->setDescription("Reporte de Productos");
		
		//Establecemos la pestaña activa y nombre a la pestaña
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle("Productos");
		
		$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		$objDrawing->setName('Logotipo');
		$objDrawing->setDescription('Logotipo');
		$objDrawing->setImageResource($gdImage);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setHeight(100);
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		
		$estiloTituloReporte = array(
	    'font' => array(
		'name'      => 'Arial',
		'bold'      => true,
		'italic'    => false,
		'strike'    => false,
		'size' =>13
	    ),
	    'fill' => array(
		'type'  => PHPExcel_Style_Fill::FILL_SOLID
		),
	    'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_NONE
		)
	    ),
	    'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
	    )
		);
		
		$estiloTituloColumnas = array(
	    'font' => array(
		'name'  => 'Arial',
		'bold'  => true,
		'size' =>10,
		'color' => array(
		'rgb' => 'FFFFFF'
		)
	    ),
	    'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => '538DD5')
	    ),
	    'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	    ),
	    'alignment' =>  array(
		'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
	    )
		);
		
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray( array(
	    'font' => array(
		'name'  => 'Arial',
		'color' => array(
		'rgb' => '000000'
		)
	    ),
	    'fill' => array(
		'type'  => PHPExcel_Style_Fill::FILL_SOLID
		),
	    'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	    ),
		'alignment' =>  array(
		'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
	    )
		));
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:E4')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A6:E6')->applyFromArray($estiloTituloColumnas);
		
		$objPHPExcel->getActiveSheet()->setCellValue('B3', 'REPORTE DE PRODUCTOS');
		$objPHPExcel->getActiveSheet()->mergeCells('B3:D3');
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('A6', 'ID');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$objPHPExcel->getActiveSheet()->setCellValue('B6', 'NOMBRE');
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('C6', 'PRECIO');
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('D6', 'EXISTENCIA');
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->setCellValue('E6', 'TOTAL');
		
		//Recorremos los resultados de la consulta y los imprimimos
		while($rows = $resultado->fetch_assoc()){
			
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rows['idcliente']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rows['nombre']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['email']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['telefono']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, '=C'.$fila.'*D'.$fila);
			
			$fila++; //Sumamos 1 para pasar a la siguiente fila
		}
		
		$fila = $fila-1;
		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A7:E".$fila);
		
		$filaGrafica = $fila+2;
		
		// definir origen de los valores
		$values = new PHPExcel_Chart_DataSeriesValues('Number', 'Productos!$D$7:$D$'.$fila);
		
		// definir origen de los rotulos
		$categories = new PHPExcel_Chart_DataSeriesValues('String', 'Productos!$B$7:$B$'.$fila);
		
		// definir  gráfico
		$series = new PHPExcel_Chart_DataSeries(
		PHPExcel_Chart_DataSeries::TYPE_BARCHART, // tipo de gráfico
		PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,
		array(0),
		array(),
		array($categories), // rótulos das columnas
		array($values) // valores
		);
		$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);
		
		// inicializar gráfico
		$layout = new PHPExcel_Chart_Layout();
		$plotarea = new PHPExcel_Chart_PlotArea($layout, array($series));
		
		// inicializar o gráfico
		$chart = new PHPExcel_Chart('exemplo', null, null, $plotarea);
		
		// definir título do gráfico
		$title = new PHPExcel_Chart_Title(null, $layout);
		$title->setCaption('Gráfico PHPExcel Chart Class');
		
		// definir posiciondo gráfico y título
		$chart->setTopLeftPosition('B'.$filaGrafica);
		$filaFinal = $filaGrafica + 10;
		$chart->setBottomRightPosition('E'.$filaFinal);
		$chart->setTitle($title);
		
		// adicionar o gráfico à folha
		$objPHPExcel->getActiveSheet()->addChart($chart);
		
		$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		
		// incluir gráfico
		$writer->setIncludeCharts(TRUE);
		
		
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header('Content-Disposition: attachment;filename="Productos.xlsx"');
		header('Cache-Control: max-age=0');
		
		$writer->save('php://output');


	
	break;
	
}
?>