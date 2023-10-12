<?php
require_once "../modelos/Saldos.php";

$saldos=new Saldos();

switch ($_GET["op"])
	{


		case 'listar_saldos':
			

			$rspta = $saldos->listar_saldos();


			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						


						echo '

					

		                             				<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->idsaldos.'" aria-expanded="true" aria-controls="collapseOne" onclick="listar_saldos_detalles('.$reg->idsaldos.');">
                                                          

                                                          <table id="datatable_buttons" class="table table-hover">
							                                  <tr>
							                                    <td width="20%">No. Pedido:<br>'.$reg->no_pedido.'</td>
							                                    
							                                    <td width="40%">Fecha de pedido:<br>'.$reg->fecha_pedido.'</td>
							                                    <td width="40%" align="right">
							                                    	
		                                                          	<button type="button" class="btn btn-dark" onclick="abrir_detalles('.$reg->idsaldos.');" id=""><i class="fa fa-list-alt"></i></button>
		                                                          	
							                                    </td>
							                                  </tr>
							                               </table>

                                                        </a>
                                                        <div id="collapseOne'.$reg->idsaldos.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                        	
     																
                                                          <div class="panel-body">

                                                          	<table class="table table-bordered" id="tbl_saldos_detalle'.$reg->idsaldos.'">
                                                              
                                                            </table>
                                                          	
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>


	                            

						';
						
					}

						
			
		break;

		case 'nuevo_pedido':

			$fecha_hora = $_POST['fecha_hora'];

			$rspta=$saldos->nuevo_pedido($fecha_hora);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'nuevo_detalle_saldo':

			$idsaldos = $_POST['idsaldos'];
			$fecha_hora = $_POST['fecha_hora'];

			$rspta=$saldos->nuevo_detalle_saldo($idsaldos,$fecha_hora);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'listar_saldos_detalles':
			
			$id=$_GET['id'];

			$rspta = $saldos->listar_saldos_detalles($id);



						echo '	<thead>
								  
	                              <tr style="background: #fff;">
	                              	
	                              	<th>CODIGO</th>
	                                <th><i class="fa fa-edit">  DETALLE</th>
	                                <th><i class="fa fa-edit">  CANTIDAD</th>
	                                <th><i class="fa fa-edit">  PRECIO</th>
	                                <th>FECHA DE PEDIDO</th>
	                                
	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						


						echo '

								
								
									 <tr>
									
									
						                <td>'.$reg->codigo.'</td>
		                                <td>

		                                	<input type="text" class="form-control" id="detalle'.$reg->idsaldos_detalle.'" onkeyup="update_detalle_saldo('.$reg->idsaldos_detalle.');" onblur="ocultar_input_detalle('.$reg->idsaldos_detalle.');" style="display: none;" value="'.$reg->detalle.'">
		                                	<label onclick="" id="label_detalle'.$reg->idsaldos_detalle.'">'.$reg->detalle.'</label>

		                                </td>
		                                <td>

		                                	<input type="text" class="form-control" id="cantidad'.$reg->idsaldos_detalle.'" onkeyup="update_detalle_saldo('.$reg->idsaldos_detalle.');" onblur="ocultar_input_cantidad('.$reg->idsaldos_detalle.');" style="display: none;" value="'.$reg->cantidad.'">
		                                	<label onclick="" id="label_cantidad'.$reg->idsaldos_detalle.'">'.$reg->cantidad.'</label>

		                                </td>
		                                <td>

		                                	<input type="text" class="form-control" id="precio'.$reg->idsaldos_detalle.'" onkeyup="update_detalle_saldo('.$reg->idsaldos_detalle.');" onblur="ocultar_input_precio('.$reg->idsaldos_detalle.');" style="display: none;" value="'.$reg->precio.'">
		                                	<label onclick="" id="label_precio'.$reg->idsaldos_detalle.'">'.$reg->precio.'</label>


		                                </td>

		                                <td>'.$reg->fecha_pedido.'</td>
	                               
		                             </tr>
    

						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_saldos_detalles2':
			
			$id=$_GET['id'];

			$rspta = $saldos->listar_saldos_detalles($id);



						echo '	<thead>
								  
	                              <tr style="background: #fff;">
	                              	
	                              	<th>CODIGO</th>
	                                <th><i class="fa fa-edit">  DETALLE</th>
	                                <th><i class="fa fa-edit">  CANTIDAD</th>
	                                <th><i class="fa fa-edit">  PRECIO</th>
	                                <th>FECHA DE PEDIDO</th>
	                                
	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						


						echo '

								
								
									 <tr>
									
									
						                <td>'.$reg->codigo.'</td>
		                                <td>

		                                	<input type="text" class="form-control" id="detalle'.$reg->idsaldos_detalle.'" onkeyup="update_detalle_saldo('.$reg->idsaldos_detalle.');" onblur="ocultar_input_detalle('.$reg->idsaldos_detalle.');" style="display: none;" value="'.$reg->detalle.'">
		                                	<label onclick="mostrar_input_detalle('.$reg->idsaldos_detalle.');" id="label_detalle'.$reg->idsaldos_detalle.'">'.$reg->detalle.'</label>

		                                </td>
		                                <td>

		                                	<input type="text" class="form-control" id="cantidad'.$reg->idsaldos_detalle.'" onkeyup="update_detalle_saldo('.$reg->idsaldos_detalle.');" onblur="ocultar_input_cantidad('.$reg->idsaldos_detalle.');" style="display: none;" value="'.$reg->cantidad.'">
		                                	<label onclick="mostrar_input_cantidad('.$reg->idsaldos_detalle.');" id="label_cantidad'.$reg->idsaldos_detalle.'">'.$reg->cantidad.'</label>

		                                </td>
		                                <td>

		                                	<input type="text" class="form-control" id="precio'.$reg->idsaldos_detalle.'" onkeyup="update_detalle_saldo('.$reg->idsaldos_detalle.');" onblur="ocultar_input_precio('.$reg->idsaldos_detalle.');" style="display: none;" value="'.$reg->precio.'">
		                                	<label onclick="mostrar_input_precio('.$reg->idsaldos_detalle.');" id="label_precio'.$reg->idsaldos_detalle.'">'.$reg->precio.'</label>


		                                </td>

		                                <td>'.$reg->fecha_pedido.'</td>
	                               
		                             </tr>
    

						';
						
					}

						echo '</tbody>
							  

						';
			
		break;
		
		case 'update_detalle_saldo':

			$idsaldos_detalle = $_POST['idsaldos_detalle'];
			$detalle = $_POST['detalle'];
			$cantidad = $_POST['cantidad'];
			$precio = $_POST['precio'];
			

			$rspta=$saldos->update_detalle_saldo($idsaldos_detalle,$detalle,$cantidad,$precio);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_pedido':

			$idsaldos = $_POST['idsaldos'];
			$idpedido = $_POST['idpedido'];
			$no_pedido_save = $_POST['no_pedido_save'];

			$rspta=$saldos->guardar_pedido($idsaldos,$idpedido,$no_pedido_save);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_ped':

			$id=$_GET['id'];

			$rspta = $saldos->listar_ped($id);

			while ($reg = $rspta->fetch_object())
					{

						echo '
							<option value="'.$reg->idpg_pedidos.'">'.$reg->no_control.' - '.$reg->calle_ent.' '.$reg->numero_ent.' Col.'.$reg->colonia_ent.', '. $reg->ciudad_ent .'</option>
						';	
					}

			
		break;

		case 'listar_dir_sal':

			//$id=$_GET['id'];

			$rspta = $saldos->listar_dir_sal();

			while ($reg = $rspta->fetch_object())
					{

						echo '
							<option value="'.$reg->idsaldo_entregas.'">'.$reg->calle.'  '.$reg->numero.' Int.'.$reg->interior.' Col. '.$reg->colonia.'  '.$reg->ciudad.', '. $reg->estado .'</option>
						';	
					}

			
		break;

		case 'guardar_entrega':

			$idsaldos = $_POST['idsaldos'];
			$idpedido = $_POST['idpedido'];
			$contacto_s = $_POST['contacto_s'];
			$calle_s = $_POST['calle_s'];
			$numero_s = $_POST['numero_s'];
			$interior_s = $_POST['interior_s'];
			$colonia_s = $_POST['colonia_s'];
			$ciudad_s = $_POST['ciudad_s'];
			$estado_s = $_POST['estado_s'];
			$cp_s = $_POST['cp_s'];
			$email_s = $_POST['email_s'];
			$telefono_s = $_POST['telefono_s'];
			$fecha_entrega_s = $_POST['fecha_entrega_s'];
			$horario_entrega_s = $_POST['horario_entrega_s'];
			$horario_entrega_s2 = $_POST['horario_entrega_s2'];
			$forma_entrega_s = $_POST['forma_entrega_s'];
			$det_form_entrega_s = $_POST['det_form_entrega_s'];
			$comentario_s = $_POST['comentario_s'];


			$rspta=$saldos->guardar_entrega($idsaldos,$idpedido,$contacto_s,$calle_s,$numero_s,$interior_s,$colonia_s,$ciudad_s,$estado_s,$cp_s,$email_s,$telefono_s,$fecha_entrega_s,$horario_entrega_s,$horario_entrega_s2,$forma_entrega_s,$det_form_entrega_s,$comentario_s);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_fact':

			
			$idsaldos = $_POST['idsaldos'];
			$idpedido = $_POST['idpedido'];
			$razon_f = $_POST['razon_f'];
			$rfc_f = $_POST['rfc_f'];
			$calle_f = $_POST['calle_f'];
			$numero_f = $_POST['numero_f'];
			$interior_f = $_POST['interior_f'];
			$colonia_f = $_POST['colonia_f'];
			$ciudad_f = $_POST['ciudad_f'];
			$estado_f = $_POST['estado_f'];
			$cp_f = $_POST['cp_f'];
			$email_f = $_POST['email_f'];
			$telefono_f = $_POST['telefono_f'];
			$marcador = $_POST['marcador'];
			


			$rspta=$saldos->guardar_fact($idsaldos,$idpedido,$razon_f,$rfc_f,$calle_f,$numero_f,$interior_f,$colonia_f,$ciudad_f,$estado_f,$cp_f,$email_f,$telefono_f,$marcador);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'select_dir_ped':

			$idpedido = $_POST['idpedido'];

			$rspta=$saldos->select_dir_ped($idpedido);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'select_dir_sal':

			$iddireccion = $_POST['iddireccion'];

			$rspta=$saldos->select_dir_sal($iddireccion);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'select_dir_fact':

			$idsaldo_fact = $_POST['idsaldo_fact'];

			$rspta=$saldos->select_dir_fact($idsaldo_fact);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'select_nocontrol':

			$no_control = $_POST['no_control'];

			$rspta=$saldos->select_nocontrol($no_control);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;



		case 'mostrar_direcciones':

			$id=$_GET['id'];

			$rspta = $saldos->mostrar_direcciones($id);

			while ($reg = $rspta->fetch_object())
					{

						echo '
							<option value="'.$reg->idsaldo_entregas.'" onclick="select_direccion('.$reg->idsaldo_entregas.');">'.$reg->calle.'  '.$reg->numero.' Int.'.$reg->interior.' Col. '.$reg->colonia.'  '.$reg->ciudad.', '. $reg->estado .'</option>
						';	
					}

			
		break;

		case 'mostrar_facturacion':

			$id=$_GET['id'];

			$rspta = $saldos->mostrar_facturacion($id);

			while ($reg = $rspta->fetch_object())
					{

						echo '
							<option value="'.$reg->idsaldo_fact.'" onclick="select_facturacion('.$reg->idsaldo_fact.');">'.$reg->razon.'</option>
						';	
					}

			
		break;

		case 'mostrar_control':

			$id=$_GET['id'];

			$rspta = $saldos->mostrar_control($id);

			while ($reg = $rspta->fetch_object())
					{

						echo '
							<option value="'.$reg->idpg_pedidos.'" onclick="select_nocontrol('.$reg->no_control.');">'.$reg->no_control.'</option>
						';	
					}

			
		break;

		case 'consul_det_pedsal':

			$idsaldos = $_POST['idsaldos'];

			$rspta=$saldos->consul_det_pedsal($idsaldos);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'set_ident':

			$idsaldos = $_POST['idsaldos'];
			$idsaldo_entregas = $_POST['idsaldo_entregas'];

			$rspta=$saldos->set_ident($idsaldos,$idsaldo_entregas);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'set_idfact':

			$idsaldos = $_POST['idsaldos'];
			$idsaldo_fact = $_POST['idsaldo_fact'];

			$rspta=$saldos->set_idfact($idsaldos,$idsaldo_fact);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_idpedido':

			$idpedido = $_POST['idpedido'];

			$rspta=$saldos->consul_idpedido($idpedido);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'next_nopedido':

			//$idpedido = $_POST['idpedido'];

			$rspta=$saldos->next_nopedido();
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;



	}

?>