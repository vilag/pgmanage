<?php 
require_once "../modelos/Inventario_z.php";

$inventario_z=new Inventario_z();

switch ($_GET["op"]){
	

	case 'listar':

		$rspta=$inventario_z->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="detalle_prod('.$reg->idinventario_zuno.')"><i class="fa fa-pencil"></i></button>',
 				//"1"=>'<img src="../../images/productos/'.$reg->imagen.'" width="150" height="150" onclick="detalle_prod('.$reg->idinventario_zuno.');">',
 				//"1"=>$reg->customer_id,
 				"1"=>$reg->codigo_producto,
 				"2"=>$reg->descripcion,
 				"3"=>$reg->existencia
 				/*"3"=>$reg->descripcion,
 				

 				"5"=>$reg->comentario
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

	case 'mostrardetalle':

		$idinventario_zuno = $_POST['idinventario_zuno'];
		
		$rspta=$inventario_z->mostrardetalle($idinventario_zuno);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);

	break;

	/*case 'selectProd':
		require_once "../modelos/Inventario_z.php";
		$inventario_z=new Inventario_z();
		$rspta = $inventario_z->selectProd();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idinventario_zuno . '>' . $reg->codigo_producto . " - ". $reg->nombre .'</option>';
				}
	break;*/


	case 'guardar':

		$idinventario_zuno = $_POST['idinventario_zuno'];
		$cant_actual = $_POST['cant_actual'];
		$cant_base = $_POST['cant_base'];
		$fecha_hora = $_POST['fecha_hora'];
		$codigo = $_POST['codigo'];
		
		$rspta=$inventario_z->guardar($idinventario_zuno,$cant_actual,$cant_base,$fecha_hora,$codigo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);

	break;

	case 'consul_prod':

		$codigo_nuevo = $_POST['codigo_nuevo'];

		$rspta=$inventario_z->consul_prod($codigo_nuevo);
 		echo json_encode($rspta);

	break;

	case 'guardar_prod':

		$codigo_nuevo = $_POST['codigo_nuevo'];
		$descr_nuevo = $_POST['descr_nuevo'];
		$existencia_nuevo = $_POST['existencia_nuevo'];

		$rspta=$inventario_z->guardar_prod($codigo_nuevo,$descr_nuevo,$existencia_nuevo);
 		echo json_encode($rspta);

	break;

	/*case 'listar_apartados':


		$idinventario_zuno=$_REQUEST["idinventario_zuno"];

		$rspta=$inventario_z->listar_apartados($idinventario_zuno);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idventa,
 				"1"=>$reg->idinventario_zuno,				
 				"2"=>$reg->cantidad,				
 				"3"=>$reg->fecha_hora

 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;*/


	case 'listar_apartados':
		//Recibimos el idingreso
		$id=$_GET['id'];

		$rspta = $inventario_z->listar_apartados($id);
		//$total=0;
		echo '<thead style="background-color:#ffffff">
                                   	<th>Folio venta</th>
                                   	<th>Cliente</th>
                                    <th>Producto</th>
                                        
                                    <th>Cantidad</th>
                                    <th>fecha de venta</th>
                                    <th>Entregar</th>

                                 
                                </thead>';



		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td>'.$reg->folio.'</td><td>'.$reg->cliente.'</td><td>'.$reg->producto.'</td><td>'.$reg->cantidad.'</td><td>'.$reg->fecha_hora.'</td><td><button class="btn btn-primary" onclick="entregar_apartado('.$reg->idinvetario_zuno_apartado.',\''.$reg->idventa.'\')"><i class="">Entregar productos</i></button></td></tr>';
					
				}
		echo '<tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                   
                                </tfoot>';
	break;

	case 'contar_apartados':

		$idinventario_zuno = $_POST['idinventario_zuno'];
		$rspta=$inventario_z->contar_apartados($idinventario_zuno);
 		echo json_encode($rspta);

	break;



	case 'entregar_apartado':

		$idinvetario_zuno_apartado = $_POST['idinvetario_zuno_apartado'];
		$idventa = $_POST['idventa'];
		$fecha_hora = $_POST['fecha_hora'];
		$codigo = $_POST['codigo'];
		

		$rspta=$inventario_z->entregar_apartado($idinvetario_zuno_apartado,$idventa,$fecha_hora,$codigo);
 		echo json_encode($rspta);

	break;

	case 'listar_apartados1':
	

		$rspta = $inventario_z->listar_apartados1();
		//$total=0;
		echo '<thead style="background-color:#ffffff">
                                   	<th>Folio venta</th>
                                   	<th>Cliente</th>
                                    <th>Producto</th>
                                        
                                    <th>Cantidad</th>
                                    <th>fecha de venta</th>
                                    <th>Entregar</th>

                                 
                                </thead>';



		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td>'.$reg->folio.'</td><td>'.$reg->cliente.'</td><td>'.$reg->producto.'</td><td>'.$reg->cantidad.'</td><td>'.$reg->fecha_hora.'</td><td><button class="btn btn-primary" onclick="entregar_apartado2('.$reg->idinvetario_zuno_apartado.',\''.$reg->idventa.'\')"><i class="">Entregar productos</i></button></td></tr>';
					
				}
		echo '<tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                   
                                </tfoot>';
	break;


	case 'listar_tbl_colores':
		//Recibimos el idingreso
		$id=$_GET['id'];

		$rspta = $inventario_z->listar_tbl_colores($id);
		//$total=0;
		echo '<thead style="background-color:#F0F8FF">
                                   	<th>Color</th>
                                   	<th>Cantidad</th>
                                    <th></th>
                                    <th></th>

                                 
                                </thead>';



		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td>'.$reg->color.'</td><td><input type="number" class="form-control" id="cant_color'.$reg->iddetalle_inventario_zuno.'" value="'.$reg->cantidad.'" onkeyup="actualizar_letrero('.$reg->iddetalle_inventario_zuno.')"></td><td><button class="btn btn-primary" onclick="editar_color('.$reg->iddetalle_inventario_zuno.')"><i class="">Guardar</i></button></td><td>'.$reg->estatus.'</td></tr>';
					
				}
		echo '<tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                   
                                </tfoot>';
	break;

	case 'editar_color':

		$iddetalle_inventario_zuno = $_POST['iddetalle_inventario_zuno'];
		$idcant_color = $_POST['idcant_color'];
		

		$rspta=$inventario_z->editar_color($iddetalle_inventario_zuno,$idcant_color);
 		echo json_encode($rspta);

	break;

	case 'actualizar_letrero':

		$iddetalle_inventario_zuno = $_POST['iddetalle_inventario_zuno'];
		//$idcant_color = $_POST['idcant_color'];
		

		$rspta=$inventario_z->actualizar_letrero($iddetalle_inventario_zuno);
 		echo json_encode($rspta);

	break;

	case 'addcolor':

		$idinventario_zuno = $_POST['idinventario_zuno'];
		$nombre_color = $_POST['nombre_color'];
		$cantidad_color = $_POST['cantidad_color'];

		$rspta=$inventario_z->addcolor($idinventario_zuno,$nombre_color,$cantidad_color);
 		echo json_encode($rspta);

	break;
	
}
?>