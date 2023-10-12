<?php 
require_once "../modelos/Pedidose.php";

$pedidose=new Pedidose();

switch ($_GET["op"]){
	

	case 'listar':

		$rspta=$pedidose->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="detalle_prod('.$reg->idctrl_ped_fab.')"><i class="fa fa-pencil"></i></button>',
 				//"1"=>'<img src="../../images/productos/'.$reg->imagen.'" width="150" height="150" onclick="detalle_prod('.$reg->idinventario_zuno.');">',
 				//"1"=>$reg->customer_id,
 				"1"=>$reg->num_control,
 				
 				"2"=>$reg->cliente,
 				"3"=>$reg->fecha_pedido,
 				

 				"4"=>$reg->fecha_entrega,
 				"5"=>($reg->estatus)?'<span class="label bg-green">Entregado</span>':
 				'<span class="label bg-red">Pendiente</span>'
 				
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
		/*require_once "../modelos/Pedidose.php";
		$ventas=new Ventas();*/

		$rspta = $pedidose->select_cliente();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idclientes_fab . '>' . $reg->nombre . '</option>';
				}
	break;

	case 'guardar_documento':

			$idpedido = $_POST["idpedido"];
			$ar_coment = $_FILES["ar_comprob"];			
			$nom=$_FILES['ar_comprob']['name'];
			$ruta_anterior=$_FILES['ar_comprob']['tmp_name'];
			$ruta="../files/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);

			$rspta=$pedidose->guardar_documento($nom,$idpedido);
	 		echo json_encode($rspta);
	break;

	case 'buscar_nom_cli':

		$nombre_new = $_POST['nombre_new'];

		$rspta=$pedidose->buscar_nom_cli($nombre_new);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'guardar_cliente':

		//$num_cliente_new = $_POST['num_cliente_new'];
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
		

		$rspta=$pedidose->guardar_cliente($nombre_new,$email_new,$telefono_new,$rfc_new,$calle_new,$numero_new,$interior_new,$colonia_new,$municipio_new,$estado_new,$referencia_new,$fecha_hora);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'guardar_pedido':

		$idcliente = $_POST['idcliente'];
		$f_pedido = $_POST['f_pedido'];
		$f_est_entrega = $_POST['f_est_entrega'];
		$lugar_entrega = $_POST['lugar_entrega'];

		$rspta=$pedidose->guardar_pedido($idcliente,$f_pedido,$f_est_entrega,$lugar_entrega);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'guardar_producto':

		$ctrl_pedid_a = $_POST['ctrl_pedid_a'];
		$no_pedid_a = $_POST['no_pedid_a'];
		$ord_prod_a = $_POST['ord_prod_a'];
		$clave_a = $_POST['clave_a'];
		$nombre_a = $_POST['nombre_a'];
		$cant_solic_a = $_POST['cant_solic_a'];

		$rspta=$pedidose->guardar_producto($ctrl_pedid_a,$no_pedid_a,$ord_prod_a,$clave_a,$nombre_a,$cant_solic_a);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;


	case 'listarprod':
	
		$id=$_GET['id'];

		$rspta = $pedidose->listarprod($id);
		//$total=0;
		echo '<thead style="background-color:#ffffff">
                                   	<th>Opciones</th>
                                   	<th>Control de pedidos</th>
                                    <th>No. Pedido</th>
                                        
                                    <th>OP</th>
                                    <th>Clave de prod.</th>
                                    <th>Producto</th>
                                    <th>Cantidad Solicitada</th>
                                    <th>Cantidad en envío</th>
                                    <th>Estatus</th>
                                 
                                </thead>';



		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td><button class="btn btn-primary" onclick="abrir_det_ped('.$reg->idpedido_fab.')"><i class="">Detalle</i></button></td><td>'.$reg->idctrl_ped_fab.'</td><td>'.$reg->no_pedido.'</td><td>'.$reg->op.'</td><td>'.$reg->clave_prod.'</td><td>'.$reg->material.'</td><td>'.$reg->cantidad_solic.'</td><td>'.$reg->cantidad_enviada.'</td><td>'.$reg->estatus.'</td></tr>';
					
				}
		echo '<tfoot>
                                   
                                   
                                </tfoot>';
	break;

	case 'abrir_det_ped':

		$idpedido_fab = $_POST['idpedido_fab'];
		
		$rspta=$pedidose->abrir_det_ped($idpedido_fab);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case "listar_prod_select":

    			$ctrl_ped = $_POST['ctrl_ped'];

				$rspta = $pedidose->listar_prod_select($ctrl_ped);
				while ($reg = $rspta->fetch_object())
				{
		            echo '<option value=' . $reg->idpedido_fab . '>' . $reg->clave_prod .' - '.$reg->material.'</option>';
		        }		
	break;

	case 'select_prod_add':

		$prod_select = $_POST['prod_select'];
		
		$rspta=$pedidose->select_prod_add($prod_select);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'guardar_envio':

		$idctrl_ped_fab = $_POST['idctrl_ped_fab'];
		$no_salida = $_POST['no_salida'];
		$forma = $_POST['forma'];
		$fecha_hora_salida = $_POST['fecha_hora_salida'];
		$fecha_hora_entrega = $_POST['fecha_hora_entrega'];
		$lugar_entrega = $_POST['lugar_entrega'];
		$fecha_hora_entrega_real = $_POST['fecha_hora_entrega_real'];
		$entregado_a = $_POST['entregado_a'];
		
		$rspta=$pedidose->guardar_envio($idctrl_ped_fab,$no_salida,$forma,$fecha_hora_salida,$fecha_hora_entrega,$lugar_entrega,$fecha_hora_entrega_real,$entregado_a);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'guardar_det_envio':

		$id_envio_fab = $_POST['id_envio_fab'];
		$idped_fab2 = $_POST['idped_fab2'];
		$cve_prod2 = $_POST['cve_prod2'];
		//$mat2 = $_POST['mat2'];
		$tip_empaque2 = $_POST['tip_empaque2'];
		$cant_solic2 = $_POST['cant_solic2'];
		$mont_entr_siniva2 = $_POST['mont_entr_siniva2'];
		$mont_entr_coniva2 = $_POST['mont_entr_coniva2'];
		
		$rspta=$pedidose->guardar_det_envio($id_envio_fab,$idped_fab2,$cve_prod2,$tip_empaque2,$cant_solic2,$mont_entr_siniva2,$mont_entr_coniva2);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;


	case 'listarenvios':
	
		$id=$_GET['id'];

		$rspta = $pedidose->listarenvios($id);
		//$total=0;
		echo '<thead style="background-color:#ffffff">
                                   	<th>Opciones</th>
                                   	<th>No. Salida</th>
                                    <th>Forma de envío</th>
                                        
                                    <th>Fecha/hora de salida</th>
                                    <th>Estatus</th>
                                    
                                 
                                </thead>';



		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td><button class="btn btn-primary" onclick="abrir_det_ped('.$reg->idpedido_fab.')"><i class="">Detalle</i></button></td><td>'.$reg->no_salida.'</td><td>'.$reg->forma.'</td><td>'.$reg->fecha_hora_salida.'</td><td>'.$reg->estatus.'</td></tr>';
					
				}
		echo '<tfoot>
                                    
                                   
                                </tfoot>';
	break;

}
?>