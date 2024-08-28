<?php
require_once "../modelos/Entregas_prod.php";

$entregas_prod=new Entregas_prod();

switch ($_GET["op"])
	{

		

		case 'listar_salidas':
			
			$offset = $_GET['offset'];

			$rspta = $entregas_prod->listar_salidas($offset);



						echo '<thead>
                                <tr>
                                  <th width="15%">Opciones</th>
                                  <th width="10%">No. Embarque</th>
                                  <th width="20%">Fecha de salida</th>
                                  <th width="20%">Chofer</th>
                                  <th width="20%">Vehiculo</th>
                                  
                                  <th width="15%">Estatus</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						if ($reg->estatus==0) {
							$estatus="Programada";
						}

						$idsalida = $reg->idsalida;

							echo '

									<tr>
									  <td>
									  <button type="button" class="btn btn-dark" onclick="ver_salida('.$reg->idsalida.');"><span class="glyphicon glyphicon-list" aria-hidden="true" style="color: white;"></span></button>
									  <button type="button" class="btn btn-dark" onclick="editar_salida('.$reg->idsalida.');"><span class="glyphicon glyphicon-edit" aria-hidden="true" style="color: white;"></span></button>

									  </td>
	                                  <td><b style="font-size: 20px; color: #169F85;">'.$reg->no_salida.'</b></td>
	                                  <td>'.$reg->fecha_salida.'</td>
	                                  <td>'.$reg->nom_repartidor.'</td>
	                                  <td>'.$reg->nom_vehiculo.'</td>
	                                 
	                                  <td>'.$estatus.'</td>
	                                  
	                                 
	                                </tr>


							';

						$rspta2 = $entregas_prod->listar_salidas_det($idsalida);
						while ($reg2 = $rspta2->fetch_object())
						{

							if ($reg2->estatus==1) {
								$estatus2 = "Cancelado";
								$back_estat = "FECDC9";
							}
							if ($reg2->estatus==0) {
								$estatus2 = "Enviado";
								$back_estat = "EDEDED";
							}

							echo '

									<tr style="background: #'.$back_estat.';">
									  <td></td>
									  <td><i class="fa fa-level-up" style="font-size: 25px; transform: rotate(90deg); color: #169F85;"></i></td>
	                                  <td colspan="">No. Salida: '.$reg2->no_entrega.'</td>
	                                  <td>Cliente: '.$reg2->nom_cliente.'</td>
	                                  <td>No. Control: '.$reg2->no_control.'</td>
	                                  <td>Estatus: '.$estatus2.'</td>	 	                                 
	                                </tr>


							';
						}
						
					}

						echo '</tbody>';
			
		break;

		case 'consul_salida':

			$idsalida = $_POST['idsalida'];

			$rspta=$entregas_prod->consul_salida($idsalida);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'listar_prod_selec':

			$id=$_GET['id'];
			

			$rspta = $entregas_prod->listar_prod_selec($id);


			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->check_entrega==1) {
							$checked="checked";
							
						}elseif ($reg->check_entrega==0) {
							$checked="";
							
						}

						if ($reg->cantidad==$reg->cantidad_entre) {
							$disabled = "disabled";
						}elseif ($reg->cantidad>$reg->cantidad_entre) {
							$disabled = "";
						}

						//$cant = $reg->cantidad - $reg->cant_entregada;

						$disponible = $reg->cant_apartado+$reg->cant_avance;
						$pend_disp = $disponible - $reg->cantidad_entre;
						$cant_tot = $reg->cantidad;

						echo '
								
								<div class="form-group col-md-12 col-sm-12">
									
										
										<table id="" class="table table-hover">
																<thead>
																	<tr>                              	
		                              	<th width="" colspan="3">

		                              		<b>'.$reg->codigo.'</b> - <small><b>'.$reg->descripcion.'</b></small><br>
																			COLOR: <small>'.$reg->color.', </small>MEDIDAS: <small>'.$reg->medida.'</small><br>
																			OBSERVACIÓN: <small><b>'.$reg->observacion.'</b></small>

		                              	</th>
		                              	<th width="" colspan="2">
		                              		<small>TOTAL:</small> '.$reg->cantidad.'<br>
		                              		<small>ENTREGADO:</small> '.$reg->cantidad_entre.'<br>
		                              		<small>PENDIENTE:</small> '.$reg->pendiente.'<br>
		                              	</th>
		                              	
		                              </tr>
		                              <tr>                              	
		                              
		                              	<th width=""><small>DISPONIBLE</small></th>
		                              	
		                              	
		                              	<th width=""><small>PEND. DISP.</small></th>
		                              	<th width=""><small>ENTREGAR</small></th>	                              	
		                              	<th width=""><small>MODIF.</small></th>
		                             		<th width=""><small>ENTREGAR</small></th>
		                              	
		                              	
		                              </tr>
		                            </thead>
		                            <tbody>
		                            	
		                            		<td><b style="width: 30px;">'.$disponible.'</b></td>
		                            	
		                            		
		                            		<td><b style="width: 30px;">'.$pend_disp.'</b></td>
		                            		<td><input type="number" class="form-control" id="idproducto_enviar'.$reg->idpg_detalle_pedidos.'" value="" onchange="act_cant_entregar('.$reg->idpg_detalle_pedidos.',\''.$disponible.'\',\''.$reg->cantidad_entre.'\',\''.$cant_tot.'\');" disabled></td>
		                            		<td><input type="checkbox" id="check_mod_cant_ent'.$reg->idpg_detalle_pedidos.'" onchange="check_activar('.$reg->idpg_detalle_pedidos.');" '.$disabled.'></td>
		                            		<td><input type="checkbox" id="check_entrega'.$reg->idpg_detalle_pedidos.'" onchange="check_prod_entrega('.$reg->idpg_detalle_pedidos.');" '.$checked.' '.$disabled.'></td>
		                            </tbody>
	                  </table>
									
										<hr width="100%">
                                        
                </div>

							

									

									


						';


						
					}

					
			
		break;

		case 'buscar_idpg_pedidos':

			$no_control = $_POST['no_control'];

			$rspta=$entregas_prod->buscar_idpg_pedidos($no_control);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'ver_salida':

			$idsalida = $_POST['idsalida'];

			$rspta=$entregas_prod->ver_salida($idsalida);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consultar_datos_salida':

			$idsalida = $_POST['idsalida'];

			$rspta=$entregas_prod->consultar_datos_salida($idsalida);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_lote':

			$identrega_detalle = $_POST['identrega_detalle'];
			$input_lote = $_POST['input_lote'];

			$rspta=$entregas_prod->guardar_lote($identrega_detalle,$input_lote);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_cantidad':

			$identrega_detalle = $_POST['identrega_detalle'];
			$input_cant = $_POST['input_cant'];

			$rspta=$entregas_prod->guardar_cantidad($identrega_detalle,$input_cant);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_obs':

			$identrega_detalle = $_POST['identrega_detalle'];
			$input_observ = $_POST['input_observ'];

			$rspta=$entregas_prod->guardar_obs($identrega_detalle,$input_observ);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'update_observ_salida':

			$identrega = $_POST['identrega'];
			$observ_salida = $_POST['observ_salida'];

			$rspta=$entregas_prod->update_observ_salida($identrega,$observ_salida);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_prod_control_exc':

			$idpedido=$_GET['idpedido'];
			

			$rspta = $entregas_prod->listar_prod_control_exc($idpedido);


						echo '

								
							<option value="select">SELECCIONAR</option>

						';
			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								
							<option value="'.$reg->idpg_detalle_pedidos.'">'.$reg->codigo.' - '.$reg->descripcion.'</option>

						';


						
					}


			
		break;


		case 'agregar_prod_salida':

			$iddetalle_pedido = $_POST['iddetalle_pedido'];
			$cantidad = $_POST['cantidad'];
			$observ = $_POST['observ'];
			$identrega = $_POST['identrega'];
			$idsalida = $_POST['idsalida'];
			$idpedido = $_POST['idpedido'];
			$tipo_idprod = $_POST['tipo_idprod'];
			$prod_ped_tipo = $_POST['prod_ped_tipo'];

			$rspta=$entregas_prod->agregar_prod_salida($iddetalle_pedido,$cantidad,$observ,$identrega,$idsalida,$idpedido,$tipo_idprod,$prod_ped_tipo);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_salidas_control':
			
			$valor1=$_GET['valor1'];
			$valor2=$_GET['valor2'];
			$marcador=$_GET['marcador'];

			$rspta = $entregas_prod->listar_salidas_control($valor1,$valor2,$marcador);



						echo '<thead>
                                <tr>
                                  <th>Opciones</th>
                                  <th>No. Embarque</th>
                                  <th>Fecha de salida</th>
                                  <th>Chofer</th>
                                  <th>Vehiculo</th>
                                  
                                  <th>Estatus</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						if ($reg->estatus==0) {
							$estatus="Programada";
						}

						$idsalida = $reg->idsalida;

							echo '

									<tr>
									  <td><button type="button" class="btn btn-dark" onclick="ver_salida('.$reg->idsalida.');">Detalles</button></td>
	                                  <td><b style="font-size: 20px; color: #169F85;">'.$reg->no_salida.'</b></td>
	                                  <td>'.$reg->fecha_salida.'</td>
	                                  <td>'.$reg->nom_repartidor.'</td>
	                                  <td>'.$reg->nom_vehiculo.'</td>
	                                 
	                                  <td>'.$estatus.'</td>
	                                  
	                                 
	                                </tr>


							';

						$rspta2 = $entregas_prod->listar_salidas_det($idsalida);
						while ($reg2 = $rspta2->fetch_object())
						{

							if ($reg2->estatus==1) {
								$estatus2 = "Cancelado";
								$back_estat = "FECDC9";
							}
							if ($reg2->estatus==0) {
								$estatus2 = "Enviado";
								$back_estat = "EDEDED";
							}

							echo '

									<tr style="background: #'.$back_estat.';">
									  <td></td>
									  <td><i class="fa fa-level-up" style="font-size: 25px; transform: rotate(90deg); color: #169F85;"></i></td>
	                                  <td colspan="">No. Salida: '.$reg2->no_entrega.'</td>
	                                  <td>Cliente: '.$reg2->nom_cliente.'</td>
	                                  <td>No. Control: '.$reg2->no_control.'</td>
	                                  td>Estatus: '.$estatus2.'</td>		                                 
	                                </tr>


							';
						}
						
					}

						echo '</tbody>';
			
		break;


		case 'ver_lotes_vale_alm':

			$iddetalle_pedido=$_GET['iddetalle_pedido'];
			$area=$_GET['area'];

			$rspta = $entregas_prod->ver_lotes_vale_alm($iddetalle_pedido);



						echo '	<thead>
								  							<tr>

	                              	<th colspan="5">LOTES DE ALMACÉN</th>
	                              	
	                              	
	                              	
	                              </tr>
	                              <tr>

	                              	<th width="15%"><small style="font-weight: bold;">VALE</small></th>
	                              	<th width="20%"><small style="font-weight: bold;">LOTE</small></th>
	                              	<th width="30%"><small style="font-weight: bold;">CANT. | DISP.</small></th>
	                              	<th width="30%"><small style="font-weight: bold;">SELEC.</small></th>
	                              	
	                              	<th width="5%"><small style="font-weight: bold;"></small></th>
	                              	
	                              	
	                              </tr>
	                              
	                            </thead>
	                            <tbody>';


			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

					$disp = $reg->cantidad - $reg->cant_salida;

						echo '

									

								<tr>
									
													
									<td style="padding-top: 20px;">
									'.$reg->no_vale.'
									</td>
									<td style="padding-top: 20px;">'.$reg->lote.'</td>
									<td>'.$reg->cantidad.' <label style="font-size: 20px;">|</label> '.$disp.'</td>
									<td style="padding-top: 20px;"><input type="number" value="'.$disp.'" style="width:100px; border-style: none; border-bottom: groove;" id="cant_lote_enviar'.$reg->idpresalida.'"></td>
							
									<td style="padding-top: 20px;">
										<button type="button" class="btn" onclick="enviar_lotes('.$reg->idpresalida.',\''.$reg->lote.'\',\''.$reg->iddetalle_pedido.'\',\''.$reg->cantidad.'\');"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>
									</td>

	              </tr>


						';

					}

					echo 

							'
																<tr>

	                              	<th colspan="5">LOTES DE PRODUCCIÓN</th>
	                              	
	                              	
	                              	
	                              </tr>
	                              <tr>

	                              	<th width="15%"><small style="font-weight: bold;">OP</small></th>
	                              	<th width="20%"><small style="font-weight: bold;">LOTE</small></th>
	                              	<th width="30%"><small style="font-weight: bold;">CANT.</small></th>
	                              
	                              	
	                              	
	                              </tr>
							'


					;

					$rspta = $entregas_prod->ver_lotes_vale_prod($iddetalle_pedido,$area);
					while ($reg = $rspta->fetch_object())
					{

				//	$disp = $reg->cantidad - $reg->cant_salida;

						echo '

									

								<tr>
									
													
									<td style="padding-top: 20px;">
									'.$reg->no_op.'
									</td>
									<td style="padding-top: 20px;">'.$reg->lote.'</td>
									<td>'.$reg->cant_capt.'</td>
									
							
									

	              </tr>


						';

					}

						echo '</tbody>
							  

						';
			
		break;

		case 'contar_op':

			$iddetalle_pedido = $_POST['iddetalle_pedido'];
			//$observ_salida = $_POST['observ_salida'];

			$rspta=$entregas_prod->contar_op($iddetalle_pedido);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_area_ent':

			$iddetalle_pedido = $_POST['iddetalle_pedido'];
			//$observ_salida = $_POST['observ_salida'];

			$rspta=$entregas_prod->buscar_area_ent($iddetalle_pedido);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'enviar_lotes':

			$identrega_detalle = $_POST['identrega_detalle'];
			$idpresalida = $_POST['idpresalida'];
			$lote = $_POST['lote'];
			$cantidad_enviar = $_POST['cantidad_enviar'];

			$rspta=$entregas_prod->enviar_lotes($identrega_detalle,$idpresalida,$lote,$cantidad_enviar);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_producto_exced_salida':

			$codigo = $_POST['codigo'];

			$rspta=$entregas_prod->buscar_producto_exced_salida($codigo);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'borrar_prod_salida':

			$identrega_detalle = $_POST['identrega_detalle'];
			$cantidad = $_POST['cantidad'];
			$idusuario = $_POST['idusuario'];
			$no_salida = $_POST['no_salida'];
			$idproducto = $_POST['idproducto'];
			$idpedido = $_POST['idpedido'];

			$rspta=$entregas_prod->borrar_prod_salida($identrega_detalle,$cantidad,$idusuario,$no_salida,$idproducto,$idpedido);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		
	

	}


?>