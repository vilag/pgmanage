<?php 
require_once "../modelos/Contactos.php";

$contactos=new Contactos();

switch ($_GET["op"]){
	

	case 'listar':

		$rspta=$contactos->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="abrir_modal('.$reg->idcontactos.')"><i class="fa fa-pencil"></i></button>',
 				//"1"=>$reg->customer_id,
 				"1"=>$reg->idcontactos,
 				"2"=>$reg->nombre,
 				
 				"3"=>$reg->fecha_hora,
 				
 				
 				"4"=>($reg->estatus)?'<span class="label bg-green">Leído</span>':
 				'<span class="label bg-red">Sin leer</span>'
 				/*"5"=>$reg->pedido,
 				"6"=>($reg->venta)?'<span class="label bg-green">Venta</span>':
 				'<span class="label bg-red"></span>'*/
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'cargar_contacto':

		$idcontactos = $_POST['idcontactos'];
		$idusuario = $_POST['idusuario'];

		$rspta=$contactos->cargar_contacto($idcontactos,$idusuario);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'guardar_cliente':

		$nombre_cliente = $_POST['nombre_cliente'];
		$num_cliente = $_POST['num_cliente'];
		$email = $_POST['email'];
		$telefono = $_POST['telefono'];
		$fecha_hora = $_POST['fecha_hora'];

		$rspta=$contactos->guardar_cliente($nombre_cliente,$num_cliente,$email,$telefono,$fecha_hora);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'guardar_venta':

		$idcliente = $_POST['idcliente'];
		$descr_venta = $_POST['descr_venta'];
		$total_pago = $_POST['total_pago'];
		$forma_pago = $_POST['forma_pago'];
		$banco = $_POST['banco'];
		$referencia = $_POST['referencia'];
		$comentario_venta = $_POST['comentario_venta'];
		$fecha_hora = $_POST['fecha_hora'];

		$rspta=$contactos->guardar_venta($idcliente,$descr_venta,$total_pago,$forma_pago,$banco,$referencia,$comentario_venta,$fecha_hora);
		echo json_encode($rspta);

	break;

	case 'guardar_comentario2':

		$idcontacto = $_POST['idcontacto'];
		$descr_venta = $_POST['descr_venta'];
		$fecha_hora = $_POST['fecha_hora'];
		

		$rspta=$contactos->guardar_comentario2($idcontacto,$descr_venta,$fecha_hora);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'listar_seguimiento':


		$idcontacto=$_REQUEST["idcontacto"];

		$rspta=$contactos->listar_seguimiento($idcontacto);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->iddetalle_contactos,
 				"1"=>$reg->comentario,				
 				"2"=>$reg->fecha_hora,				
 				"3"=>$reg->archivo,
 				
 				//"4"=>'<button class="btn btn-warning" ><a href="http://localhost/pizarronesguadalajara/files/seguimiento/'.$reg->archivo.'" download='.$reg->archivo.'>descargar</a></button>',
 				"4"=>'<iframe  src="http://docs.google.com/gview?url=http://www.pizarronesguadalajara.com/files/seguimiento/'.$reg->archivo.'&embedded=true" style="width:100px; height:100px;" frameborder="0"></iframe>'
 				
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'valid_nombre_cliente':

		$nombre_cliente = $_POST['nombre_cliente'];

		$rspta=$contactos->valid_nombre_cliente($nombre_cliente);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'valid_email':

		$email = $_POST['email'];

		$rspta=$contactos->valid_email($email);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'buscar_num_cli':

		$num_cliente = $_POST['num_cliente'];

		$rspta=$contactos->buscar_num_cli($num_cliente);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'buscar_num_ped':

		$num_pedido = $_POST['num_pedido'];

		$rspta=$contactos->buscar_num_ped($num_pedido);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'update_contacto':

		$idcontacto = $_POST['idcontacto'];
		$idpedidos = $_POST['idpedidos'];

		$rspta=$contactos->update_contacto($idcontacto,$idpedidos);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'buscar_pedido':

		$idpedido = $_POST['idpedido'];

		$rspta=$contactos->buscar_pedido($idpedido);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'list_coin_cli':
		//Recibimos el idingreso
		$nombre_cliente=$_POST['nombre_cliente'];
		$email=$_POST['email'];

		$rspta = $contactos->list_coin_cli($nombre_cliente,$email);
		//$total=0;
		echo '<thead style="background-color:#000000">
                                    <th style="color:#FFFFFF">Seleccionar</th>
                                    <th style="color:#FFFFFF">No. Cliente</th>
                                    <th style="color:#FFFFFF">Nombre</th>
                                    <th style="color:#FFFFFF">Email</th>                                   
                                    <th style="color:#FFFFFF">Telefono</th>
                                    
                                    
                                </thead>';



		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td><button class="btn btn-warning" onclick="abrir_cli_pedido('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button></td><td>'.$reg->no_cliente.'</td><td>'.$reg->nombre.'</td><td>'.$reg->email.'</td><td>'.$reg->telefono.'</td></tr>';
					//$total=$reg->total;
				}
		echo '<tfoot>
                                    
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    
                                </tfoot>';
	break;

	case 'abrir_cli_pedido':

		$idcliente = $_POST['idcliente'];

		$rspta=$contactos->abrir_cli_pedido($idcliente);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'subir_pedido':

			$ar_pedido = $_FILES["ar_pedido"];			
			$nom=$_FILES['ar_pedido']['name'];
			$ruta_anterior=$_FILES['ar_pedido']['tmp_name'];
			$ruta="../files/pedidos/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);

			$rspta=$contactos->subir_pedido($nom);
	 		echo json_encode($rspta);

	break;

	case 'update_file':

		$idfiles = $_POST['idfiles'];
		$idpedidos = $_POST['idpedidos'];

		$rspta=$contactos->update_file($idfiles,$idpedidos);
		echo json_encode($rspta);
 		//echo $rspta ? "Anulada" : "No se puede anular";
	break;

	case 'guardar_comentario':

			$ar_coment = $_FILES["ar_coment"];			
			$nom=$_FILES['ar_coment']['name'];
			$ruta_anterior=$_FILES['ar_coment']['tmp_name'];
			$ruta="../files/seguimiento/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);

			$idcontacto3 = $_POST['idcontacto3'];
			$descr_venta = $_POST['descr_venta'];
			$fecha_hora_coment = $_POST['fecha_hora_coment'];

			$rspta=$contactos->guardar_comentario($idcontacto3,$descr_venta,$nom,$fecha_hora_coment);
	 		echo json_encode($rspta);
	break;

	case 'valid_exist_archivo':

			//$ar_coment = $_FILES["ar_coment"];			
			$nom=$_FILES['ar_coment']['name'];
			//$ruta_anterior=$_FILES['ar_coment']['tmp_name'];
			//$ruta="../files/seguimiento/".$nom;
			//move_uploaded_file($ruta_anterior, $ruta);


			$rspta=$contactos->valid_exist_archivo($nom);
	 		echo json_encode($rspta);
	break;


	
}
?>