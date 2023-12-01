<?php
session_start(); 
require_once "../modelos/List_pedidos.php";

$list_pedidos=new List_pedidos();


switch ($_GET["op"]){
	
		case 'listar_pedidos_v2':
			
			$estatus=$_GET['estatus'];
			$idusuario=$_GET['idusuario'];
			$lugar=$_GET['lugar'];

			$rspta = $list_pedidos->listar_pedidos_v2($estatus,$idusuario,$lugar);
				

			while ($reg = $rspta->fetch_object())
					{
						if ($reg->estatus=='ENTREGADO') {

							$dias_totales=$reg->diferencia_total;
							$porc_avance=$reg->porc_av;
							$dias_faltantes=$reg->dias_rest;
							$color_barra=$reg->color_barra;

							if ($dias_faltantes>=0) {
								$color_barra='#33E228';
							}

						}elseif ($reg->estatus!='ENTREGADO') {
							
							$dias_totales=$reg->diferencia_total;
							$dias_transcurridos=$reg->avance;
							$dias_faltantes=$reg->faltan;

							if ($dias_totales==0) {
								$porc_avance=0;
							}elseif ($dias_totales>0) {
								$porc_avance = ($dias_transcurridos*100)/$dias_totales;
							}

							
							

							if ($porc_avance==0) {
								$color_barra='#F18904';
								
							}

							if ($porc_avance>=0 && $porc_avance<=50) {
								$color_barra='#33E228';
								
							}
							if ($porc_avance>=51 && $porc_avance<=75) {
								$color_barra='#F7E208';
								
							}
							if ($porc_avance>=76 && $porc_avance<=90) {
								$color_barra='#F18904';
								
							}
							if ($porc_avance>=91 && $porc_avance<=100) {
								$color_barra='#D60B01';
								
							}
							if ($porc_avance>100) {
								$color_barra='#9F0B03';
								
							}
						}


						if ($reg->tipo==1) {
							$tipo = "Comercial";
						}elseif ($reg->tipo==2) {
							$tipo = "Licitación";
						}elseif ($reg->tipo==3) {
							$tipo = "Muestras";
						}elseif ($reg->tipo==4) {
							$tipo = "Exisencias";
						}elseif ($reg->tipo==0) {
							$tipo = "";
						}

						$color_status=$reg->color_status;
						if ($color_status==Null) {
							$color_status='fff';
							
						}
						

						$documento=$reg->docs;

						if ($documento>0) {
							$visib_docs = "block:";
						}elseif ($documento==0) {
							$visib_docs = "none";
						}

						$obser_seg=$reg->observaciones;

						if ($obser_seg<>"") {
							$visib_obser = "block:";
						}elseif ($obser_seg=="") {
							$visib_obser = "none";
						}

						$det_forment=$reg->det_forma_entrega;

						if ($det_forment<>"") {
							$visib_forment = "block:";
						}elseif ($det_forment=="") {
							$visib_forment = "none";
						}

						echo '

								
								
								
		                          <div class="mail_list hov" onclick="buscar_pedido('.$reg->idpg_pedidos.');" style="cursor: pointer;" >
		                            
		                            <div>
		                              <b style="float: right; font-size: 12px; margin-top:5px;">'.$reg->fecha_pedido.'</b><br>
		                              <p style="margin-bottom: 2px; margin-top: 2px;"><b style="font-size: 20px;">'.$reg->no_control.'</b> - P: '.$reg->no_pedido.'
		                              	<b style="margin-left: 40%;">
		                              		<i class="fa fa-file" style="font-size: 15px; display: '.$visib_docs.';" data-toggle="tooltip" data-placement="top" title="Documentos"></i>
		                              		<i class="fa fa-comments-o" style="margin-left: 5px; font-size: 15px; display: '.$visib_obser.';" data-toggle="tooltip" data-placement="top" title="Observaciones"></i>
		                              		<i class="fa fa-truck" style="margin-left: 5px; font-size: 15px; display: '.$visib_forment.';" data-toggle="tooltip" data-placement="top" title="Detalles de forma de entrega"></i>
		                              	</b>
		                              <br><small>'.$reg->lugar.' - '.$tipo.'</small>
		                              	
		                              </p>
		                              <p style="margin-bottom: 10px;"><b>'.$reg->nom_cliente.'</b></p>
		                             
		                            </div>
		                            <div class="progress" style="height:5px; width: 80%; margin-bottom: 10px;">
		                                <div class="progress-bar" role="progressbar" style="width: '.$porc_avance.'%; background: '.$color_barra.';" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
		                                <h6 id="color_barra_s'.$reg->idpg_pedidos.'" style="visibility: hidden;">'.$color_barra.'</h6>
		                                <h6 id="dias_restantes'.$reg->idpg_pedidos.'" style="visibility: hidden;">'.$dias_faltantes.'</h6>
					                </div>
					                <div align="left" style="margin-bottom: 10px;">
		                              <b id="estatus_ped'.$reg->idpg_pedidos.'" style="color: #'.$color_status.';">'.$reg->estatus.'</b>
		                            </div>
		                            
		                          </div>
		                          
		                        	 

		                            
		                          	                            

						';

					
						
					}

		break;


		case 'listar_pedidos_v2_consul':
			
			//$estatus=$_GET['estatus'];
			$valor_consulta=$_GET['valor_consulta'];

			$nombre_cliente=$_GET['nombre_cliente'];
			$fecha1_consul=$_GET['fecha1_consul'];
			$fecha2_consul=$_GET['fecha2_consul'];
			//$idusuario=$_GET['idusuario'];
			$lugar=$_GET['lugar'];

			$rspta = $list_pedidos->listar_pedidos_v2_consul($lugar,$valor_consulta,$nombre_cliente,$fecha1_consul,$fecha2_consul);

				

			while ($reg = $rspta->fetch_object())
					{
						if ($reg->estatus=='ENTREGADO') {

							$dias_totales=$reg->diferencia_total;
							$porc_avance=$reg->porc_av;
							$dias_faltantes=$reg->dias_rest;
							$color_barra=$reg->color_barra;

							if ($dias_faltantes>=0) {
								$color_barra='#33E228';
							}

						}elseif ($reg->estatus!='ENTREGADO') {
							
							$dias_totales=$reg->diferencia_total;
							$dias_transcurridos=$reg->avance;
							$dias_faltantes=$reg->faltan;

							if ($dias_totales==0) {
								$porc_avance=0;
							}elseif ($dias_totales>0) {
								$porc_avance = ($dias_transcurridos*100)/$dias_totales;
							}

							
							

							if ($porc_avance==0) {
								$color_barra='#F18904';
								
							}

							if ($porc_avance>=0 && $porc_avance<=50) {
								$color_barra='#33E228';
								
							}
							if ($porc_avance>=51 && $porc_avance<=75) {
								$color_barra='#F7E208';
								
							}
							if ($porc_avance>=76 && $porc_avance<=90) {
								$color_barra='#F18904';
								
							}
							if ($porc_avance>=91 && $porc_avance<=100) {
								$color_barra='#D60B01';
								
							}
							if ($porc_avance>100) {
								$color_barra='#9F0B03';
								
							}
						}


						if ($reg->tipo==1) {
							$tipo = "Comercial";
						}elseif ($reg->tipo==2) {
							$tipo = "Licitación";
						}elseif ($reg->tipo==3) {
							$tipo = "Muestras";
						}elseif ($reg->tipo==4) {
							$tipo = "Exisencias";
						}elseif ($reg->tipo==0) {
							$tipo = "";
						}

						$color_status=$reg->color_status;
						if ($color_status==Null) {
							$color_status='fff';
							
						}
						

						$documento=$reg->docs;

						if ($documento>0) {
							$visib_docs = "block:";
						}elseif ($documento==0) {
							$visib_docs = "none";
						}

						$obser_seg=$reg->observaciones;

						if ($obser_seg<>"") {
							$visib_obser = "block:";
						}elseif ($obser_seg=="") {
							$visib_obser = "none";
						}

						$det_forment=$reg->det_forma_entrega;

						if ($det_forment<>"") {
							$visib_forment = "block:";
						}elseif ($det_forment=="") {
							$visib_forment = "none";
						}

						echo '

								
								
								<a href="#" onclick="buscar_pedido('.$reg->idpg_pedidos.');">
		                          <div class="mail_list hov">
		                            
		                            <div>
		                              <b style="float: right; font-size: 12px; margin-top:5px;">'.$reg->fecha_pedido.'</b><br>
		                              <p style="margin-bottom: 2px; margin-top: 2px;"><b style="font-size: 20px;">'.$reg->no_control.'</b> - P: '.$reg->no_pedido.'
		                              	<b style="margin-left: 40%;">
		                              		<i class="fa fa-file" style="font-size: 15px; display: '.$visib_docs.';" data-toggle="tooltip" data-placement="top" title="Documentos"></i>
		                              		<i class="fa fa-comments-o" style="margin-left: 5px; font-size: 15px; display: '.$visib_obser.';" data-toggle="tooltip" data-placement="top" title="Observaciones"></i>
		                              		<i class="fa fa-truck" style="margin-left: 5px; font-size: 15px; display: '.$visib_forment.';" data-toggle="tooltip" data-placement="top" title="Detalles de forma de entrega"></i>
		                              	</b>
		                              <br><small>'.$reg->lugar.' - '.$tipo.'</small>
		                              	
		                              </p>
		                              <p style="margin-bottom: 10px;"><b>'.$reg->nom_cliente.'</b></p>
		                             
		                            </div>
		                            <div class="progress" style="height:5px; width: 80%; margin-bottom: 10px;">
		                                <div class="progress-bar" role="progressbar" style="width: '.$porc_avance.'%; background: '.$color_barra.';" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
		                                <h6 id="color_barra_s'.$reg->idpg_pedidos.'" style="visibility: hidden;">'.$color_barra.'</h6>
		                                <h6 id="dias_restantes'.$reg->idpg_pedidos.'" style="visibility: hidden;">'.$dias_faltantes.'</h6>
					                </div>
					                <div align="left" style="margin-bottom: 10px;">
		                              <b id="estatus_ped'.$reg->idpg_pedidos.'" style="color: #'.$color_status.';">'.$reg->estatus.'</b>
		                            </div>
		                            
		                          </div>
		                          
		                        </a>	 

		                            
		                          	                            

						';

					
						
					}

		break;

		case 'buscar_pedido':
		
			$idpg_pedidos = $_POST['idpg_pedidos'];
			//$id_ped_temp = $_POST['id_ped_temp'];

			$rspta=$list_pedidos->buscar_pedido($idpg_pedidos);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_documentos':		
			$id=$_GET['id'];
		
			$rspta = $list_pedidos->listar_documentos($id);

			
						
			while ($reg = $rspta->fetch_object())
					{
						if ($reg->tipo=='0') {
							$tipo_text = 'Anexo';
						}
						if ($reg->tipo=='1') {
							$tipo_text = 'Factura|Recibo';
						}

						if ($reg->tipo=='2') {
							$tipo_text = 'Orden de compra';
						}
						if ($reg->tipo=='3') {
							$tipo_text = 'Contrato';
						}
						if ($reg->tipo=='4') {
							$tipo_text = 'Especificaciones';
						}
						if ($reg->tipo=='5') {
							$tipo_text = 'Anexo';
						}

						$nom =  substr($reg->nombre, 0, 20); 

						if ($reg->iddocumentos>364) {

							echo '
									<div class="col-md-6 col-sm-6" style="margin-bottom: 10px;">
										<a href="files/'.$reg->idpedido.'/'.$reg->nombre.'" download="'.$reg->nombre.'"> 
											<b style="font-size: 12px;">'.$nom.' ...</b> <b style="font-size: 11px;">('.$tipo_text.')</b>
										</a><br>
										<button id="" type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Borrar documento" onclick="borrar_documento('.$reg->iddocumentos.',\''.$reg->idpedido.'\');" style="color: #fff; font-size: 12px; font-style: bold; margin-right: -10px;"><i class="fa fa-trash" style="color: black; font-size: 15px;"></i></button>
									</div>
										

										
	                                    
							';
						}
						if ($reg->iddocumentos<=364) {
							# code...
							echo '


										<div class="col-md-6 col-sm-6" style="margin-bottom: 10px;">
											<a class="btn btn-app" href="files/'.$reg->nombre.'" download="'.$reg->nombre.'"> 
												<b style="font-size: 12px;">'.$nom.'</b> <b style="font-size: 11px;">('.$tipo_text.')</b>
											</a>
										</div>


										
	                                    
							';

						}

													
					}
						
			
		break;

		case 'listar_pedido_detalle_term':

			$id=$_GET['id'];

			$rspta = $list_pedidos->listar_pedido_detalle_term($id);



						echo '	<thead>
								  <tr>

	                              	<th style="" colspan="8">
	                              	E1 = En proceso de entrega,   E2 = Entregados,  P = Pendientes 
	                              	</th>
	                              
	                             
	                              	
	                              </tr>
	                              <tr>

	                              	<th style="width: 5%;"><small style="font-weight: bold;">ASIGNAR</small></th>
	                              	<th style="width: 5%;"><small style="font-weight: bold;">VALE</small></th>
	                              	
	                              	<th style="width: 30%;"><small style="font-weight: bold;">DESCRIPCIÓN</small></th>
	                              	<th style="width: 20%;"><small style="font-weight: bold;">OBSERVACIÓN</small></th>
	                              	<th style="width: 7%;"><small style="font-weight: bold;">TOTAL</small></th>
	                              	<th style="width: 21%;"><small style="font-weight: bold;">E1 / E2 / P</small></th>
	                              	
	                              	<th style="width: 7%;"><small style="font-weight: bold;">OP</small></th>
	                              	<th style="width: 10%;"><small style="font-weight: bold;">ESTATUS</small></th>
	                             
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

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
							$disabled = "disabled";
						}


						if ($reg->cant_fabricado>0) {
							$cant_fabricado = 'Fabricado: ('.$reg->cant_fabricado.')<br>';
						}elseif ($reg->cant_fabricado==0) {
							$cant_fabricado = '';
						}

						if ($reg->cant_surtido>0) {
							$cant_surtido = 'Surtido: ('.$reg->cant_surtido.')<br>';
						}elseif ($reg->cant_surtido==0) {
							$cant_surtido = '';
						}

						if ($reg->cant_apartado>0) {
							$cant_apartado = 'Apartado: ('.$reg->cant_apartado.')<br>';
						}elseif ($reg->cant_apartado==0) {
							$cant_apartado = '';
						}

						if ($reg->cant_existencia>0) {
							$cant_existencia = 'Existencia: ('.$reg->cant_existencia.')<br>';
						}elseif ($reg->cant_existencia==0) {
							$cant_existencia = '';
						}

						if ($reg->cant_produccion>0) {
							$cant_produccion = 'Producción: ('.$reg->cant_produccion.')<br>';
						}elseif ($reg->cant_produccion==0) {
							$cant_produccion = '';
						}

						if ($reg->cant_otro>0) {
							$cant_otro = 'Otro: ('.$reg->cant_otro.')<br>';
						}elseif ($reg->cant_otro==0) {
							$cant_otro = '';
						}

						if ($reg->cant_canc>0) {
							$cant_canc = 'Cancelado: ('.$reg->cant_canc.')<br>';
						}elseif ($reg->cant_canc==0) {
							$cant_canc = '';
						}

						echo '

								<tr>
									
													
									<td>
									<button id="" type="button" class="btn btn-sm btn-dark btn-block" data-toggle="tooltip" data-placement="top" title="Asignar estatus" onclick="mostrar_det_ped('.$reg->idpg_detalle_pedidos.');"><i class="fa fa-qrcode"></i></button>
									
									</td>


									<td>


									

						';

								$idpg_detalle_pedidos = $reg->idpg_detalle_pedidos;

								$rspta2 = $list_pedidos->listar_vales($idpg_detalle_pedidos);
								while ($reg2 = $rspta2->fetch_object()){


									echo '
										<b>'.$reg2->no_vale.', </b>
									';
								}
					

						echo '



									</td>


									<td>
									CODIGO: <b>'.$reg->codigo.'</b><br>
									<small>'.$reg->descripcion.'</small>
									<p>MEDIDAS: <b>'.$reg->medida.'</b>, COLOR: <b>'.$reg->color.'</b></p>
									</td>
									<td>'.$reg->observacion.'</td>
									<td>'.$reg->cantidad.'</td>
									<td>'.$reg->cantidad_entre.' /  / '.$reg->pendiente.'</td>
									
									
									<td>


									

						';

								$idpg_detalle_pedidos = $reg->idpg_detalle_pedidos;

								$rspta2 = $list_pedidos->listar_op($idpg_detalle_pedidos);
								while ($reg2 = $rspta2->fetch_object()){


									echo '
										<b>'.$reg2->op.', </b>
									';
								}
					

						echo '



									</td>
									

									<td>
									'.$cant_fabricado.'
									'.$cant_surtido.'
									'.$cant_apartado.'
									'.$cant_existencia.'
									'.$cant_produccion.'
									'.$cant_otro.'
									'.$cant_canc.' 
									</td>
							        	   
	                             </tr>

						';

						/*<td style="background: '.$back1.';"><small>'.$avance_he.'</small></td>
									<td style="background: '.$back2.';"><small>'.$avance_pi.'</small></td>
									<td style="background: '.$back3.';"><small>'.$avance_pl.'</small></td>
									<td style="background: '.$back6.';"><small>'.$avance_em.'</small></td>
									<td style="background: '.$back7.';"><small>'.$avance_ho.'</small></td>
									<td style="background: '.$back4.';"><small>'.$avance_ep.'</small></td>
									<td style="background: '.$back5.';"><small>'.$avance_ec.'</small></td>*/
						
					}

						echo '</tbody>
							  

						';
			
		break;


		case 'listar_pedido_detalle_term_':

			$id=$_GET['id'];

			$rspta = $list_pedidos->listar_pedido_detalle_term($id);



						echo '	<thead>
								  <tr>

	                              	<th style="" colspan="8">
	                              	E1 = En proceso de entrega,   E2 = Entregados,  P = Pendientes 
	                              	</th>
	                              
	                             
	                              	
	                              </tr>
	                              <tr>

	                              	<th style="width: 5%;"><small style="font-weight: bold;">ASIGNAR</small></th>
	                              	<th style="width: 5%;"><small style="font-weight: bold;">VALE</small></th>
	                              	
	                              	<th style="width: 30%;"><small style="font-weight: bold;">DESCRIPCIÓN</small></th>
	                              	<th style="width: 20%;"><small style="font-weight: bold;">OBSERVACIÓN</small></th>
	                              	<th style="width: 7%;"><small style="font-weight: bold;">TOTAL</small></th>
	                              	<th style="width: 21%;"><small style="font-weight: bold;">E1 / E2 / P</small></th>
	                              	
	                              	<th style="width: 7%;"><small style="font-weight: bold;">OP</small></th>
	                              	<th style="width: 10%;"><small style="font-weight: bold;">ESTATUS</small></th>
	                             
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

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
							$disabled = "disabled";
						}


						if ($reg->cant_fabricado>0) {
							$cant_fabricado = 'Fabricado: ('.$reg->cant_fabricado.')<br>';
						}elseif ($reg->cant_fabricado==0) {
							$cant_fabricado = '';
						}

						if ($reg->cant_apartado>0) {
							$cant_apartado = 'Apartado: ('.$reg->cant_apartado.')<br>';
						}elseif ($reg->cant_apartado==0) {
							$cant_apartado = '';
						}

						if ($reg->cant_existencia>0) {
							$cant_existencia = 'Existencia: ('.$reg->cant_existencia.')<br>';
						}elseif ($reg->cant_existencia==0) {
							$cant_existencia = '';
						}

						if ($reg->cant_produccion>0) {
							$cant_produccion = 'Producción: ('.$reg->cant_produccion.')<br>';
						}elseif ($reg->cant_produccion==0) {
							$cant_produccion = '';
						}

						if ($reg->cant_otro>0) {
							$cant_otro = 'Otro: ('.$reg->cant_otro.')<br>';
						}elseif ($reg->cant_otro==0) {
							$cant_otro = '';
						}

						if ($reg->cant_canc>0) {
							$cant_canc = 'Cancelado: ('.$reg->cant_canc.')<br>';
						}elseif ($reg->cant_canc==0) {
							$cant_canc = '';
						}

						echo '

								<tr>
									
													
									<td><button id="" type="button" class="btn btn-sm btn-dark btn-block" data-toggle="tooltip" data-placement="top" title="Asignar estatus" onclick="mostrar_det_ped('.$reg->idpg_detalle_pedidos.');"><i class="fa fa-qrcode"></i></button></td>


									<td>


									

						';

								$idpg_detalle_pedidos = $reg->idpg_detalle_pedidos;

								$rspta2 = $list_pedidos->listar_vales($idpg_detalle_pedidos);
								while ($reg2 = $rspta2->fetch_object()){


									echo '
										<b>'.$reg2->no_vale.', </b>
									';
								}
					

						echo '



									</td>


									<td>
									CODIGO: <b>'.$reg->codigo.'</b><br>
									<small>'.$reg->descripcion.'</small>
									<p>MEDIDAS: <b>'.$reg->medida.'</b>, COLOR: <b>'.$reg->color.'</b></p>
									</td>
									<td>'.$reg->observacion.'</td>
									<td>'.$reg->cantidad.'</td>
									<td>'.$reg->cantidad_entre.' /  / '.$reg->pendiente.'</td>
									
									
									<td>


									

						';

								$idpg_detalle_pedidos = $reg->idpg_detalle_pedidos;

								$rspta2 = $list_pedidos->listar_op($idpg_detalle_pedidos);
								while ($reg2 = $rspta2->fetch_object()){


									echo '
										<b>'.$reg2->op.', </b>
									';
								}
					

						echo '



									</td>
									

									<td>
									'.$cant_fabricado.'
									'.$cant_apartado.'
									'.$cant_existencia.'
									'.$cant_produccion.'
									'.$cant_otro.'
									'.$cant_canc.' 
									</td>
							        	   
	                             </tr>

						';

						/*<td style="background: '.$back1.';"><small>'.$avance_he.'</small></td>
									<td style="background: '.$back2.';"><small>'.$avance_pi.'</small></td>
									<td style="background: '.$back3.';"><small>'.$avance_pl.'</small></td>
									<td style="background: '.$back6.';"><small>'.$avance_em.'</small></td>
									<td style="background: '.$back7.';"><small>'.$avance_ho.'</small></td>
									<td style="background: '.$back4.';"><small>'.$avance_ep.'</small></td>
									<td style="background: '.$back5.';"><small>'.$avance_ec.'</small></td>*/
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_pedido_detalle_term2':

			$id=$_GET['id'];

			$rspta = $list_pedidos->listar_pedido_detalle_term($id);



						echo '	<thead>
								  
	                              <tr>

	                              
	                              	
	                              	<th style="width: 45%;"><small style="font-weight: bold;">DESCRIPCIÓN</small></th>
	                              	
	                              	<th style="width: 8%;"><small style="font-weight: bold;">TOTAL</small></th>
	                              	<th style="width: 8%;"><small style="font-weight: bold;">EN ENTREGA</small></th>
	                              	<th style="width: 8%;"><small style="font-weight: bold;">ENTREGADOS</small></th>
	                              	<th style="width: 8%;"><small style="font-weight: bold;">PENDIENTES</small></th>
	                              	<th style="width: 8%;"><small style="font-weight: bold;">OP</small></th>
	                              	<th style="width: 10%;"><small style="font-weight: bold;">ESTATUS</small></th>
	                             
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

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
							$disabled = "disabled";
						}


						if ($reg->cant_fabricado>0) {
							$cant_fabricado = 'Fabricado: ('.$reg->cant_fabricado.')<br>';
						}elseif ($reg->cant_fabricado==0) {
							$cant_fabricado = '';
						}

						if ($reg->cant_apartado>0) {
							$cant_apartado = 'Apartado: ('.$reg->cant_apartado.')<br>';
						}elseif ($reg->cant_apartado==0) {
							$cant_apartado = '';
						}

						if ($reg->cant_existencia>0) {
							$cant_existencia = 'Existencia: ('.$reg->cant_existencia.')<br>';
						}elseif ($reg->cant_existencia==0) {
							$cant_existencia = '';
						}

						if ($reg->cant_produccion>0) {
							$cant_produccion = 'Producción: ('.$reg->cant_produccion.')<br>';
						}elseif ($reg->cant_produccion==0) {
							$cant_produccion = '';
						}

						if ($reg->cant_otro>0) {
							$cant_otro = 'Otro: ('.$reg->cant_otro.')<br>';
						}elseif ($reg->cant_otro==0) {
							$cant_otro = '';
						}

						echo '

								<tr>
									
													
									
									<td>
									CODIGO: <b>'.$reg->codigo.'</b><br>
									<small>'.$reg->descripcion.'</small>
									<p>MEDIDAS: <b>'.$reg->medida.'</b>, COLOR: <b>'.$reg->color.'</b></p>
									</td>
									
									<td>'.$reg->cantidad.'</td>
									<td>'.$reg->cantidad_entre.'</td>
									<td></td>
									<td>'.$reg->pendiente.'</td>
									<td></td>
									

									<td>
									'.$cant_fabricado.'
									'.$cant_apartado.'
									'.$cant_existencia.'
									'.$cant_produccion.'
									'.$cant_otro.' 
									</td>
							        	   
	                             </tr>


						';

						/*<td style="background: '.$back1.';"><small>'.$avance_he.'</small></td>
									<td style="background: '.$back2.';"><small>'.$avance_pi.'</small></td>
									<td style="background: '.$back3.';"><small>'.$avance_pl.'</small></td>
									<td style="background: '.$back6.';"><small>'.$avance_em.'</small></td>
									<td style="background: '.$back7.';"><small>'.$avance_ho.'</small></td>
									<td style="background: '.$back4.';"><small>'.$avance_ep.'</small></td>
									<td style="background: '.$back5.';"><small>'.$avance_ec.'</small></td>*/
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'update_observ':
			
			$id_ped_temp = $_POST['id_ped_temp'];
			$observ = $_POST['observ'];
										
			$rspta=$list_pedidos->update_observ($id_ped_temp,$observ);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_pedido_ini':

			$lugar = $_POST['lugar'];
			$estatus = $_POST['estatus'];
													
			$rspta=$list_pedidos->buscar_pedido_ini($lugar,$estatus);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_pg_detped':
			//Recibimos el idingreso
			//$id=$_GET['id'];
			$id=$_GET['id'];
			$idusuario=$_GET['idusuario'];

			$rspta = $list_pedidos->listar_pg_detped($id);



						echo '	<thead>
	                              <tr>
	                               	
	                                <th width="5%"></th>
	                                <th width="10%">Cant.</th>
	                                <th width="20%">Observ.</th>
	                                <th width="20%">Coment.</th>
	                                <th width="10%">OP</th>
	                                <th width="25%">Estatus</th>
	                                <th width="5%">Guardar</th>
	                                <th width="5%">Borrar</th>
	                                <th></th>
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
	        //<input type="text" class="form-control" id="op_prod_seg'.$reg->idpg_detped.'" value="'.$reg->op.'" onkeyup="save_op_prod('.$reg->idpg_detped.');">
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->estatus=="Fabricado") {

							$marca="disabled";
							
						}elseif ($reg->estatus<>"Fabricado") {
							$marca="disabled";
							$visib_v = "";
						}


						if ($reg->observ_enlace<>"") {
							$observacion_prod = $reg->observ_enlace;
						}elseif ($reg->observacion<>"") {
							$observacion_prod = $reg->observacion;
						}

						if ($reg->estatus=="Produccion" OR $reg->estatus=="Fabricado") {
							$disab_v = ";";
						}elseif ($reg->estatus<>"Produccion") {
							$disab_v = "disabled";
						}

						if ($reg->guardado==0) {

							$visib_estat="hidden";
							$visib_estat2="visible";
						}elseif ($reg->guardado==1) {
							$visib_estat="visible";
							$visib_estat2="hidden";
						}

						if ($idusuario==1) {
							$display_update_c = "block";
						}else{
							$display_update_c = "none";
						}

						echo '
								
								<tr>
									<td>
										<span style="color: #900503; font-size: 20px; visibility: '.$visib_estat2.';" id="eti_estat2'.$reg->idpg_detped.'"><i class="fa fa-close"></i></span>
										<span style="color: #16BC05; font-size: 20px; visibility: '.$visib_estat.';" id="eti_estat1'.$reg->idpg_detped.'"><i class="fa fa-check"></i></span>
	                                </td>
	                              
	                                <td>
	                                	
	                                	<b id="eti_cant_prod'.$reg->idpg_detped.'" onmouseover="edit_cant('.$reg->idpg_detped.',\''.$reg->op.'\');">'.$reg->cantidad.'</b>
	                                	<textarea class="form-control" id="cant_prod_seg'.$reg->idpg_detped.'" cols="40" rows="3" style="display: '.$display_update_c.';" onmouseout="edit_cant_off('.$reg->idpg_detped.');" onkeyup="set_nosave('.$reg->idpg_detped.',\''.$reg->iddetalle_pedido.'\');">'.$reg->cantidad.'</textarea>

	                                </td>

	                                <td>
	                                	<b id="eti_obs_prod'.$reg->idpg_detped.'" onmouseover="edit_obs('.$reg->idpg_detped.',\''.$reg->op.'\');">________'.$observacion_prod.'_______</b>

	                                	<textarea class="form-control" id="obs_prod_seg'.$reg->idpg_detped.'" cols="40" rows="3" style="display: none;" onmouseout="edit_obs_off('.$reg->idpg_detped.');" onkeyup="set_nosave('.$reg->idpg_detped.',\''.$reg->iddetalle_pedido.'\');">'.$observacion_prod.'</textarea>

	                                </td>

	                                <td>'.$reg->coment.'</td>
	                                
	                                <td>'.$reg->op.'</td>
	                                <td>
	                                	<button id="btn_estatus_div'.$reg->idpg_detped.'" type="button" class="btn btn-dark" onmouseover="edit_estatus('.$reg->idpg_detped.',\''.$reg->op.'\');"><span id="estatus_detped'.$reg->idpg_detped.'">'.$reg->estatus.'</span></button>
	                                	<select  class="form-control" id="select_div'.$reg->idpg_detped.'" onchange="guardar_estatus1('.$reg->idpg_detped.',\''.$reg->iddetalle_pedido.'\',\''.$reg->idpg_pedidos.'\');" style="display: none;" onmouseout="edit_estatus_off('.$reg->idpg_detped.');">
                                                 
					                      <option value="">Seleccionar</option>
					                      <option value="Produccion">Producción</option>
					                      <option value="Apartado">Apartado</option>
					                      <option value="Cancelado">Cancelado</option>
					                      <option value="Otro">Otro</option>
					                                                
					                    </select>
					                    
	                                </td>

	                               

	                                <td>
	                                	<button type="button" class="btn btn-info" onclick="guardar_det_ped('.$reg->idpg_detped.',\''.$reg->iddetalle_pedido.'\',\''.$reg->idpg_pedidos.'\');" id="" ><i class="fa fa-save"></i></button>
	                                	
	                                </td>

	                                 <td>
	                                	<button type="button" class="btn btn-danger" onclick="borrar_det_ped('.$reg->idpg_detped.',\''.$reg->iddetalle_pedido.'\',\''.$reg->op.'\',\''.$reg->estatus.'\');" id="" ><i class="fa fa-trash"></i></button>
	                                	
	                                </td>

	                                <td>
	                                	<button type="button" class="btn" onclick="abrir_envio_a_vale('.$reg->idpg_detped.',\''.$reg->iddetalle_pedido.'\',\''.$reg->idpg_pedidos.'\');" id="" '.$disab_v.' title="Enviar a vale de almacén"><i class="fa fa-external-link-square"></i></button>
	                                	
	                                </td>
	                                
	                             </tr>


						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'set_nosave':

			$idpg_detped = $_POST['idpg_detped'];

			$rspta=$list_pedidos->set_nosave($idpg_detped);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'dividir_prod_ped':

			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			$cant_div = $_POST['cant_div'];

			$rspta=$list_pedidos->dividir_prod_ped($idpg_detalle_pedidos,$cant_div);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_datos_prod':

			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
													
			$rspta=$list_pedidos->consul_datos_prod($idpg_detalle_pedidos);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_estatus1':

			
			$idpg_detped = $_POST['idpg_detped'];
			$estatus = $_POST['estatus'];
			$fecha_hora = $_POST['fecha_hora'];
			$id_ped_temp = $_POST['id_ped_temp'];

			$rspta=$list_pedidos->guardar_estatus1($idpg_detped,$estatus,$fecha_hora,$id_ped_temp);
	 		echo json_encode($rspta);
		break;


		case 'abrir_terminados':

			$rspta = $list_pedidos->abrir_terminados();
				$consec = 1;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->num_docs==0) {

							$mensaje="En espera de documentos...";
							
						}elseif ($reg->num_docs>0) {

							$mensaje="Listo para entrega";

						}


							/*if ($reg->fecha_entrega_fab<>"" OR $reg->fecha_entrega_fab<>null) {
								$fecha_entrega = $reg->fecha_entrega_fab;
							}elseif ($reg->fecha_entrega_fab=="" OR $reg->fecha_entrega_fab==null) {
								$fecha_entrega = $reg->fecha_entrega_set;
							}*/

							$cant_pendiente = $reg->cant_pendiente - $reg->cant_entrega;

							



						echo '

													<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->idpg_pedidos.'" aria-expanded="true" aria-controls="collapseOne" onclick="listar_pedido_detalle_term('.$reg->idpg_pedidos.');">
                                                          

                                                          <table id="datatable_buttons" class="table table-hover">
							                                  <tr>
							                                 	 <td width="5%">
								                                    #:<br>
								                                    <label style="font-weight: bold; font-size: 18px;">'.$consec.'</label><br>
								                                    
							                                    </td>
							                                    <td width="10%">
								                                    Control:<br>
								                                    <label style="font-weight: bold; font-size: 18px;">'.$reg->no_control.'</label><br>
								                                    
							                                    </td>
							                                   
							                                    <td width="35%">
							                                    	Origen | Cliente:<br>
								                                    '.$reg->nom_cliente.'
							                                    	 
							                                    </td>
							                                    

							                                    <td width="30%">
							                                    	Estatus:<br>
							                                    	
							                                    	<label style="font-weight: bold; font-size: 15px;">'.$mensaje.'</label><br>
							                                    	 
							                                    </td>
							                                    
							                                    <td width="20%">
							                                    	Fecha de termino:<br>
							                                    	'.$reg->fecha_entrega.'
							                                    </td>

							                                   
							                                  </tr>
							                                  <tr>
							                                  	<td colspan="3">
								                                    Productos en entrega:
								                                    '.$reg->cant_entrega.'
								                                    
							                                    </td>
							                                    <td colspan="2">
								                                    Productos sin entregar:
								                                    '.$cant_pendiente.'
								                                    
							                                    </td>
							                                  </tr>
							                               </table>

                                                        </a>
                                                        <div id="collapseOne'.$reg->idpg_pedidos.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

                                                        			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        				<hr width="100%">
                                                        			</div>

                                                        			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">
                                                        				<a href="#" onclick="abrir_pedido_notif('.$reg->idpg_pedidos.');">
															               <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
																	    </a>

																	    <a href="#" onclick="abrir_docs('.$reg->idpg_pedidos.');">
															               <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></button>
																	    </a>

																	    

																	    
                                                        			</div>

                                                          <div class="panel-body">

                                                          	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5; overflow:scroll; width: 1000px;">

                                                          		<table class="table table-bordered" id="tbl_pedido_detalle_term'.$reg->idpg_pedidos.'" style="width: 1200px; style="border-bottom: solid;"">
                                                              
                                                            	</table>

                                                          	</div>

                                                          	
                                                          	
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>

						';
						

						

					$consec = $consec+1;

						
					}

						
		break;

		case 'abrir_doc_ped':

			$id=$_GET['id'];

			$rspta = $list_pedidos->abrir_doc_ped($id);
						echo '<thead>
                                <tr align="center">
                                  
                                  
                                  <th style="width: 70%;">Nombre</th>
                                  <th style="width: 15%;">Tipo</th>
                                  <th style="width: 15%;">Descargar</th>                                

                                </tr>
                              </thead>
                              <tbody>';
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->tipo=='0') {
							$tipo_text = 'Anexo';
						}
						if ($reg->tipo=='1') {
							$tipo_text = 'Factura|Recibo';
						}

						if ($reg->tipo=='2') {
							$tipo_text = 'Orden de compra';
						}
						if ($reg->tipo=='3') {
							$tipo_text = 'Contrato';
						}
						if ($reg->tipo=='4') {
							$tipo_text = 'Especificaciones';
						}
						if ($reg->tipo=='5') {
							$tipo_text = 'Anexo';
						}

						

							
						if ($reg->iddocumentos>364) {

							echo '
									<tr>
									  
									  <td>'.$reg->nombre.'</td>
									  <td align="center">'.$tipo_text.'</td>
									  <td>
										  <a class="btn btn-app" href="files/'.$reg->idpedido.'/'.$reg->nombre.'" download="'.$reg->nombre.'"> 
						                    <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
						                  </a>
					                  </td>
	                                  
	                                </tr>
							';
						
						}elseif ($reg->iddocumentos<=364) {

							echo '
									<tr>
									  
									  <td>'.$reg->nombre.'</td>
									  <td align="center">'.$tipo_text.'</td>
									  <td>
										  <a class="btn btn-app" href="files/'.$reg->nombre.'" download="'.$reg->nombre.'"> 
						                    <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
						                  </a>
					                  </td>
	                                  
	                                </tr>
							';      
						}

								
					}
						echo '</tbody>';
			
		break;

		case 'pedidos_vencidos':
			
			$id=$_GET['id'];

			$rspta = $list_pedidos->pedidos_vencidos($id);



						echo '	<thead>

								 

	                              <tr align="center" style="background: #034343; color: white;">
	                                
	                                <th style="width:10%">#Control</th>
	                                <th style="width:20%">DIAS: Total|Quedan</th>
	                                
	                                <th style="width:10%">Estatus</th> 

	                                <th style="width:60%">Motivo</th> 
	                                	                              
	                              </tr>

	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						/*if ($reg->estatus==1) {
							$estatus2 = 'Enlace';
						}*/
						if ($reg->estatus=='ENTREGADO') {

							$dias_totales=$reg->diferencia_total;
							$porc_avance=$reg->porc_av;
							$dias_faltantes=$reg->dias_rest;
							$color_barra=$reg->color_barra;

							if ($dias_faltantes>=0) {
								$color_barra='#33E228';
							}

						}elseif ($reg->estatus!='ENTREGADO') {
							$dias_totales=$reg->diferencia_total;
							$dias_transcurridos=$reg->avance;
							$dias_faltantes=$reg->faltan;

							$porc_avance = ($dias_transcurridos*100)/$dias_totales;
							//$porc_avance = 93;

							if ($porc_avance==0) {
								$color_barra='#F18904';
								
							}

							if ($porc_avance>=0 && $porc_avance<=50) {
								$color_barra='#33E228';
								
							}
							if ($porc_avance>=51 && $porc_avance<=75) {
								$color_barra='#F7E208';
								
							}
							if ($porc_avance>=76 && $porc_avance<=90) {
								$color_barra='#F18904';
								
							}
							if ($porc_avance>=91 && $porc_avance<=100) {
								$color_barra='#D60B01';
								
							}
							if ($porc_avance>100) {
								$color_barra='#9F0B03';
								
							}
						}

							




						$color_status=$reg->color_status;
						if ($color_status==Null) {
							$color_status='fff';
							
						}

						$dias_noti="";

						if ($dias_faltantes==2) {

							$dias_noti = 2;
							# code...
						}


						if ($reg->coment_vencim<>"") {
							# code...
							$disabled_vencim="disabled";
						}elseif ($reg->coment_vencim=="") {
							$disabled_vencim="";
						}




						echo '

								
								
									 <tr>
									
										
									
										<td align="center">'.$reg->no_control.'</td>
						            
		                                
		                                <td align="center">

		                                	  <h5><small>'.$dias_totales.'</small>|<small id="dias_restantes'.$reg->idpg_pedidos.'">'.$dias_faltantes.'</small></h5>
		                                </td>
		                               
		                               	<td align="center">
		                                	  '.$reg->estatus.'
		                                	  <h5 style="background: #'.$color_status.'; color: #'.$color_status.';">__</h5>
		                                </td>

		                                <td align="center">
		                                	
		                                	<textarea id="coment_vencim'.$reg->idpg_pedidos.'" rows="3" cols="100" onkeyup="update_coment_vencim('.$reg->idpg_pedidos.');" '.$disabled_vencim.'>'.$reg->coment_vencim.'</textarea>
		                                </td>
		                                
						                
						                
						                
	                               		
		                             </tr>

		                            
		                            

	                            

						';

					
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'contar_pedidos':

			$lugar = $_POST['lugar'];
			$estatus = $_POST['estatus'];
													
			$rspta=$list_pedidos->contar_pedidos($lugar,$estatus);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_idpg_pedidos':

			$input_buscar = $_POST['input_buscar'];
			//$estatus = $_POST['estatus'];
													
			$rspta=$list_pedidos->buscar_idpg_pedidos($input_buscar);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'listar_chat':
			
			$idpedido=$_GET['idpedido'];
			$idusuario=$_GET['idusuario'];

			$rspta = $list_pedidos->listar_chat($idpedido);

			while ($reg = $rspta->fetch_object())
					{
						if ($idusuario==$reg->idusuario) {
							$align = "right";
							
							$back = "#169F85;";
						}elseif ($idusuario<>$reg->idusuario) {
							$align = "left";
							$back = "#138496;";
						}
						
						echo '

	                            <div class="col-md-12 col-sm-12" align="'.$align.'" style="">
	                            	
						            <p style="width: 48%; border-style: ridge; border-radius: 10px 10px; padding-left: 10px; padding-right: 10px; padding-top: 10px; padding-bottom: 5px; background-color: '.$back.' color: #fff; border-color: rgb(0,0,0,0);"><b style="color: rgb(255,255,255,0.5);">'.$reg->nombre.'</b><br><br>'.$reg->mensaje.'<br><br><label style="color: rgb(255,255,255,0.5);"">'.$reg->fecha_hora.'</label></p>
						            
						        </div>

						';
						
					}

		break;

		case 'guardar_mensaje_chat':

			$idpedido = $_POST['idpedido'];
			$idusuario = $_POST['idusuario'];
			$text_chat = $_POST['text_chat'];
			$fecha_hora = $_POST['fecha_hora'];
			$lugar = $_POST['lugar'];
													
			$rspta=$list_pedidos->guardar_mensaje_chat($idpedido,$idusuario,$text_chat,$fecha_hora,$lugar);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;
		
		case 'buscar_control':

			$idpedido = $_POST['idpedido'];
			//$estatus = $_POST['estatus'];
													
			$rspta=$list_pedidos->buscar_control($idpedido);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'contar_mensajes':

			$idusuario = $_POST['idusuario'];						
			$rspta=$list_pedidos->contar_mensajes($idusuario);
			echo json_encode($rspta);

		break;

		case 'listar_controles_mensajes':
			
			//$idpedido=$_GET['idpedido'];
			$idusuario=$_GET['idusuario'];

			$rspta = $list_pedidos->listar_controles_mensajes($idusuario);

			while ($reg = $rspta->fetch_object())
					{
						
						
						echo '
							<a id="id_control'.$reg->idpg_pedidos.'" href="#" onclick="mostrar_mensajes_control_select('.$reg->idpg_pedidos.');">
								<div style="width: auto; height: 45px; background-color: #000; float: right; padding-top: 8px; border-radius: 10px 10px; margin-right: 10px;">
				                  <b style="color: #fff; font-size: 20px; margin-right: 10px; margin-left: 10px;">'.$reg->no_control.'</b>
				                </div>
							</a>
	                         

						';
						
					}

		break;

		case 'quitar_notif_control':

			$idpedido = $_POST['idpedido'];	
			$idusuario = $_POST['idusuario'];						
			$rspta=$list_pedidos->quitar_notif_control($idpedido,$idusuario);
			echo json_encode($rspta);

		break;

		case 'consul_lugar_pedido':

			$idpedido = $_POST['idpedido'];	
								
			$rspta=$list_pedidos->consul_lugar_pedido($idpedido);
			echo json_encode($rspta);

		break;


		case 'abrir_doc_salidas':

			$idpg_pedidos=$_GET['idpg_pedidos'];
			$fecha=$_GET['fecha'];

			$rspta = $list_pedidos->abrir_doc_salidas($idpg_pedidos);
						
			while ($reg = $rspta->fetch_object())
					{	
							echo '
									<div class="col-md-6 col-sm-6" style="margin-bottom: 10px;">
										<a href="reportes/valeSalidaMerc.php?id='.$reg->identrega.'&fecha='.$reg->fecha_salida.'" target="_blank"> 
											<i class="fa fa-file" style="font-size: 20px;"></i><br><b style="font-size: 11px;">'.$reg->no_entrega.'</b>
										</a>
									</div>
							';
								
					}
						
			
		break;

		case 'consul_no_vale':
								
			$rspta=$list_pedidos->consul_no_vale();
			echo json_encode($rspta);

		break;

		case 'consul_idalmacen_pt':

			$iddetalle_pedido = $_POST['iddetalle_pedido'];	
								
			$rspta=$list_pedidos->consul_idalmacen_pt($iddetalle_pedido);
			echo json_encode($rspta);

		break;

		case 'consul_idvale':
								
			$rspta=$list_pedidos->consul_idvale();
			echo json_encode($rspta);

		break;

		

		case 'guardar_prod_vale':

			$idvales_almacen = $_POST['idvales_almacen'];
			$idalmacen_pt = $_POST['idalmacen_pt'];
			$iddetalle_pedido = $_POST['iddetalle_pedido'];
			$cantidad_dividir = $_POST['cantidad_dividir'];
			$no_control = $_POST['no_control'];
			$idpg_detped = $_POST['idpg_detped'];	
								
			$rspta=$list_pedidos->guardar_prod_vale($idvales_almacen,$idalmacen_pt,$iddetalle_pedido,$cantidad_dividir,$no_control,$idpg_detped);
			echo json_encode($rspta);

		break;

		case 'listar_vale':
			
			$id=$_GET['id'];

			$rspta = $list_pedidos->listar_vale($id);



						echo '<thead>
                                <tr>
                                  
                                  <th>Producto</th>
                                  <th>Cantidad</th>
                                  <th>Control</th>
                                  <th>Estatus</th>
                               	  <th>Opciones</th>
                                  
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						if ($reg->color<>'') {
							$color = "Color: ".$reg->color.", ";
						}elseif ($reg->color=='') {
							$color = "";
						}

						if ($reg->medida<>'') {
							$medida = "Medidas: ".$reg->medida;
						}elseif ($reg->medida=='') {
							$medida = "";
						}

						if ($reg->estatus_vale==0) {
							$disab_elim = "";
						}elseif ($reg->estatus_vale==1 || $reg->estatus_vale==2) {
							$disab_elim = "disabled";
						}


						if ($reg->estatus==0) {
							
							//$disab_btn = "";
							$text_estat = "Pendiente";
							$disab_reingreso = "disabled";

						}elseif ($reg->estatus==1) {
							
							//$disab_btn = "";
							$text_estat = "Surtido";

							$disab_reingreso = "";

						}elseif ($reg->estatus==2) {
							
							//$disab_btn = "disabled";
							$text_estat = "Rechazado";
							$disab_reingreso = "disabled";

						}elseif ($reg->estatus==3) {
							// code...
							$text_estat = "Reingresado al almacén";
							$disab_reingreso = "disabled";
						}

						if ($reg->descripcion<>"") {

							$descrip = $reg->descripcion;
							$code = $reg->codigo;
							// code...
						}elseif ($reg->descripcion=="") {

							$descrip = $reg->nombre;
							$code = $reg->codigo_alm;
							// code...
						}
						

						echo '

								<tr>
                                  
                                  <td>
                                  	<b>'.$code.'</b><br>
                                  	'.$descrip.'<br>
                                  	'.$color.$medida.'

                                  </td>
                                  <td>'.$reg->cantidad.'</td>
                                  <td>'.$reg->control.'</td>
                                  <td>
                                  <b>'.$text_estat.'</b><br>
                                  '.$reg->motivo_rechazo.'
                                  </td>

                                  <td><a href="#">
                                  <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Quitar producto del vale" onclick="quitar_prod_vale('.$reg->idvale_salida.',\''.$reg->idvales_almacen.'\',\''.$reg->idpg_detped.'\')" '.$disab_elim.'><i class="fa fa-trash" style="color: red;"></i></button>

                                  <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Reingresar al almacén" onclick="reingresar_prod_vale('.$reg->idvale_salida.')" '.$disab_reingreso.'><i class="fa fa-caret-square-o-left"></i></button>
                                  </a></td>
                                 
   
                                </tr>


						';
						
					}

						echo '</tbody>';
			
		break;


		case 'listar_vale_select':
			
			$id=$_GET['id'];

			$rspta = $list_pedidos->listar_vale($id);



						echo '<thead>
                                <tr>
                               
                                  <th>Producto</th>
                                  <th>Cantidad</th>
                                  <th>Control</th>
                               	  
                                  
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						if ($reg->color<>'') {
							$color = "Color: ".$reg->color.", ";
						}elseif ($reg->color=='') {
							$color = "";
						}

						if ($reg->medida<>'') {
							$medida = "Medidas: ".$reg->medida;
						}elseif ($reg->medida=='') {
							$medida = "";
						}

						if ($reg->estatus_vale==0) {
							$disab_elim = "";
						}elseif ($reg->estatus_vale==1) {
							$disab_elim = "disabled";
						}

						
						

						echo '

								<tr>
                                 
                                  <td>
                                  	<b>'.$reg->codigo.'</b><br>
                                  	'.$reg->descripcion.'<br>
                                  	'.$color.$medida.'

                                  </td>
                                  <td>'.$reg->cantidad.'</td>
                                  <td>'.$reg->control.'</td>
   
                                </tr>


						';
						
					}

						echo '</tbody>';
			
		break;

		case 'solicitar_vale':

			$idvales_almacen = $_POST['idvales_almacen'];
			$fecha_hora = $_POST['fecha_hora'];
		
								
			$rspta=$list_pedidos->solicitar_vale($idvales_almacen,$fecha_hora);
			echo json_encode($rspta);

		break;

		case 'consul_num_prod_vale':

			$idvales_almacen = $_POST['idvales_almacen'];
		
								
			$rspta=$list_pedidos->consul_num_prod_vale($idvales_almacen);
			echo json_encode($rspta);

		break;

		case 'consul_idpg_detped_val':

			$idpg_detped_vale = $_POST['idpg_detped_vale'];
		
								
			$rspta=$list_pedidos->consul_idpg_detped_val($idpg_detped_vale);
			echo json_encode($rspta);

		break;

		case 'consul_idpg_detped_estat':

			$idpg_detped_vale = $_POST['idpg_detped_vale'];
		
								
			$rspta=$list_pedidos->consul_idpg_detped_estat($idpg_detped_vale);
			echo json_encode($rspta);

		break;

		case 'quitar_prod_vale':

			$idvale_salida = $_POST['idvale_salida'];
			$idpg_detped = $_POST['idpg_detped'];
		
								
			$rspta=$list_pedidos->quitar_prod_vale($idvale_salida,$idpg_detped);
			echo json_encode($rspta);

		break;

		case 'reingresar_prod_vale':

			$idvale_salida = $_POST['idvale_salida'];
			//$idpg_detped = $_POST['idpg_detped'];
			$fecha_hora = $_POST['fecha_hora'];
		
								
			$rspta=$list_pedidos->reingresar_prod_vale($idvale_salida,$fecha_hora);
			echo json_encode($rspta);

		break;


		case 'listar_vales_select':
			
			$estatus=$_GET['estatus'];

			$rspta = $list_pedidos->listar_vales_alm($estatus);

				echo '
					<option value="">SELECCIONAR</option>

				';
			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->estatus==0) {
							$estatus = "ABIERTO";
							
						}elseif ($reg->estatus==1) {
							$estatus = "SOLICITADO";
							
						}
					
						echo '
       
                               <option value="'.$reg->idvales_almacen.'">'.$reg->no_vale.' - '.$estatus.'</option>

						';
						
					}

			
		break;


		case 'listar_vales_alm':
			
			$estatus=$_GET['estatus'];

			$rspta = $list_pedidos->listar_vales_alm($estatus);


			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->estatus==0) {
							$estatus = "ABIERTO";
							$icono = '<i class="fa fa-send"></i>';
							$dis = "";
							$dis_v = "disabled";
							$dis_a = "disabled";
							$fondo = "#D3D5D6;";
							$concep = "";
						}elseif ($reg->estatus==1) {
							$estatus = "SOLICITADO";
							$icono = '<i class="fa fa-check"></i>';
							$dis = "disabled";
							$dis_v = "disabled";
							$dis_a = "disabled";
							$fondo = "#BBE1F8;";
							$concep = "";
						}elseif ($reg->estatus==2) {
							$estatus = "SURTIDO";
							$icono = '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>';
							$dis = "disabled";
							$dis_v = "";
							$dis_a = "";
							$fondo = "#BBF8BE;";
							$concep = "Surtido:";
						}elseif ($reg->estatus==4) {
							$estatus = "ARCHIVADO";
							$icono = '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>';
							$dis = "disabled";
							$dis_v = "";
							$dis_a = "disabled";
							$fondo = "#E3E4F0;";
							$concep = "Surtido:";
						}elseif ($reg->estatus==6) {
							$estatus = "RECHAZADO";
							$icono = '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>';
							$dis = "disabled";
							$dis_v = "";
							$dis_a = "disabled";
							$fondo = "#D3D5D6;";
							$concep = "Rechazo:";
						}

						if ($reg->prioridad==1) {
							$prioridad='Checked';
						}elseif ($reg->prioridad==0) {
							$prioridad='';
						}
					

						echo '


                               <div class="form-group col-md-12 col-sm-12" style="background: '.$fondo.' border-radius: 20px 20px; padding-top: 15px; padding-bottom: 15px; padding-left: 20px; padding-right: 10px; border-style: solid; border-color: #FFF; border-width: 2px;">
                                	<a href="#" onclick="ver_vale('.$reg->idvales_almacen.')" style="cursor: pointer;">
                                		<div>
		                                	#: <b style="font-size: 15px;">'.$reg->no_vale.' - '.$estatus.'</b><br>
		                                	
		                                </div>
                                	</a>
                                	
                                	
                                		
                               </div>

	                                


						';
						
					}

			
		break;

		/*
		
		<button type="button" class="btn" onclick="solicitar_vale('.$reg->idvales_almacen.')" '.$dis.' style="margin-left: -15px;">'.$icono.'</button>
                                		
                                		<a href="" id="enlace_vale_alm'.$reg->idvales_almacen.'" onclick="abrir_vale_alm('.$reg->idvales_almacen.');" target="_blank">
		                                  <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Imprimir vale de almacén" '.$dis_v.' style="margin-left: -10px;"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
		                                          
		                                </a>
                                		<button type="button" class="btn" onclick="borrar_vale('.$reg->idvales_almacen.');" '.$dis.'><i class="fa fa-trash" style="margin-left: -10px;"></i></button>
                                		<button type="button" class="btn" onclick="archivar_vale('.$reg->idvales_almacen.')" '.$dis_a.'><i class="fa fa-archive" style="margin-left: -10px;"></i></button>

		*/

		

		/*
							<div class="form-group col-md-4 col-sm-4>
                                <a href="#" onclick="ver_vale('.$reg->idvales_almacen.',\''.$reg->estatus.'\')">
                                	<div class="form-group col-md-12 col-sm-12>
	                                	# Vale: <b>'.$reg->no_vale.'</b><br>
	                                	Abierto: <b>'.$reg->fecha_hora_reg.'</b><br>
	                                	Solicitado: <b>'.$reg->fecha_hora_solic.'</b><br>
	                                	Estatus: <b>'.$reg->estatus.'</b><br>
	                                </div>
                                </a>
                            </div>

                            <input type="checkbox" class="js-switch" '.$prioridad.' id="check_prio'.$reg->idvales_almacen.'" onchange="estab_prior('.$reg->idvales_almacen.');" '.$dis.' style="margin-bottom: 20px;"/> <b style="color: black;">Urgente</b>

		*/
        case 'borrar_vale':

			$idvales_almacen = $_POST['idvales_almacen'];
		
								
			$rspta=$list_pedidos->borrar_vale($idvales_almacen);
			echo json_encode($rspta);

		break;

		case 'archivar_vale':

			$idvales_almacen = $_POST['idvales_almacen'];
		
								
			$rspta=$list_pedidos->archivar_vale($idvales_almacen);
			echo json_encode($rspta);

		break;

		case 'guardar_vale':

			$no_vale = $_POST['no_vale'];
			$fecha_hora = $_POST['fecha_hora'];
			$idusuario = $_POST['idusuario'];
								
			$rspta=$list_pedidos->guardar_vale($no_vale,$fecha_hora,$idusuario);
			echo json_encode($rspta);

		break;
		case 'estab_prior':

			$idvales_almacen = $_POST['idvales_almacen'];
			$prioridad = $_POST['prioridad'];

			$rspta=$list_pedidos->estab_prior($idvales_almacen,$prioridad);
			echo json_encode($rspta);

		break;


		

		case 'buscar_prod_vale':
			
			

			$idvales_almacen=$_GET['idvales_almacen'];


			$rspta = $list_pedidos->buscar_prod_vale($idvales_almacen);

			while ($reg = $rspta->fetch_object())
					{

						$idvale_salida = $reg->idvale_salida;
						$idpg_detped = $reg->idpg_detped;
						

						$servername = 'localhost';
						$username = 'u690371019_pgmanage';
						//$username = 'root';
						$password = "A=tSXZ4z";
						//$password = "";
						$dbname = "u690371019_pgmanage";

						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);



						/*$sql_pre = "SELECT estatus FROM presalida WHERE idpresalida='$idpresalida'";
						$result_pre = mysqli_query($conn, $sql_pre);
						$row = mysqli_fetch_assoc($result_pre);

						$estatus = $row['estatus'];*/

						//if ($estatus==0) {

								/*$sql="INSERT INTO almacen_pt_ed (idalmacen_pt,movimiento,cantidad,lote,fecha_hora,idsalida) VALUES('$idalmacen_pt','Salida','$cantidad','$lote','$fecha_hora','$identrega')";*/
								$sql="DELETE FROM vale_salida WHERE idvale_salida='$idvale_salida'";
								$result = $conn->query($sql);

								$sql2="UPDATE pg_detped SET estatus = '' WHERE idpg_detped='$idpg_detped'";
								$result = $conn->query($sql2);

							
						//}


								

						$conn->close();

						/*$rspta2=$almacen_pt->guardar_salida($idalmacen_pt,$cantidad,$lote,$idpedido,$fecha_hora,$identrega);
						echo json_encode($rspta2);*/

						/*$sql="INSERT INTO (idalmacen_pt,movimiento,cantidad,lote,control,fecha_hora,idsalida) SELECT '$idalmacen_pt','Salida','$cantidad','$lote',no_control,'$fecha_hora', '$identrega' FROM pg_pedidos WHERE idpg_pedidos='$idpedido'";*/
						
					}

		break;

		case 'edit_cant_total':

			$iddetalle_pedido = $_POST['iddetalle_pedido'];
			$cantidad_nueva = $_POST['cantidad_nueva'];

			$rspta=$list_pedidos->edit_cant_total($iddetalle_pedido,$cantidad_nueva);
			echo json_encode($rspta);

		break;

		case 'consul_op_detped':

			$idpg_detped = $_POST['idpg_detped'];
			//$cantidad_nueva = $_POST['cantidad_nueva'];

			$rspta=$list_pedidos->consul_op_detped($idpg_detped);
			echo json_encode($rspta);

		break;

		case 'consul_datos_vale':

			$idvales_almacen = $_POST['idvales_almacen'];
			//$cantidad_nueva = $_POST['cantidad_nueva'];

			$rspta=$list_pedidos->consul_datos_vale($idvales_almacen);
			echo json_encode($rspta);

		break;

		case 'consul_cants':

			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			//$cantidad_nueva = $_POST['cantidad_nueva'];

			$rspta=$list_pedidos->consul_cants($idpg_detalle_pedidos);
			echo json_encode($rspta);

		break;

		case 'edit_observ_total':

			$iddetalle_pedido = $_POST['iddetalle_pedido'];
			//$cantidad_nueva = $_POST['cantidad_nueva'];

			$rspta=$list_pedidos->edit_observ_total($iddetalle_pedido);
			echo json_encode($rspta);

		break;

		case 'edit_observ_total2':

			$iddetalle_pedido = $_POST['iddetalle_pedido'];
			$observacion = $_POST['observacion'];

			$rspta=$list_pedidos->edit_observ_total2($iddetalle_pedido,$observacion);
			echo json_encode($rspta);

		break;

		case 'borrar_documento':

			$iddocumentos = $_POST['iddocumentos'];
		//	$observacion = $_POST['observacion'];

			$rspta=$list_pedidos->borrar_documento($iddocumentos);
			echo json_encode($rspta);

		break;

		         
		case 'guardar_lote_reingreso':
			
			$idvale_salida=$_GET['idvale_salida'];
			$idalmacen_pt_ed=$_GET['idalmacen_pt_ed'];

			$rspta = $list_pedidos->guardar_lote_reingreso_list($idvale_salida);

			while ($reg = $rspta->fetch_object())
					{
						

						$lote_rein=$reg->lote;


						$servername = 'localhost';
						//$username = 'u690371019_pgmanage';
						$username = 'root';
						//$password = "A=tSXZ4z";
						$password = "";
						$dbname = "u690371019_pgmanage";

						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);

						$sql="UPDATE almacen_pt_ed SET lote='$lote_rein' WHERE idalmacen_pt_ed = '$idalmacen_pt_ed'";
						$result = $conn->query($sql);	

						$conn->close();
						
						
					}
			
		break;

		case 'guardar_datos_facturacion':

			$idpedido = $_POST['idpedido'];
			$razon_fac = $_POST['razon_fac'];
			$rfc_fac = $_POST['rfc_fac'];
			$calle_fac = $_POST['calle_fac'];
			$numero_fac = $_POST['numero_fac'];
			$interior_fac = $_POST['interior_fac'];
			$colonia_fac = $_POST['colonia_fac'];
			$ciudad_fac = $_POST['ciudad_fac'];
			$estado_fac = $_POST['estado_fac'];
			$cp_fac = $_POST['cp_fac'];
			$telefono_fac = $_POST['telefono_fac'];
			$email_fac = $_POST['email_fac'];

			$rspta=$list_pedidos->guardar_datos_facturacion($idpedido,$razon_fac,$rfc_fac,$calle_fac,$numero_fac,$interior_fac,$colonia_fac,$ciudad_fac,$estado_fac,$cp_fac,$telefono_fac,$email_fac);
			echo json_encode($rspta);

		break;

		case 'guardar_datos_entrega':

			$idpedido = $_POST['idpedido'];
			$contacto_ent = $_POST['contacto_ent'];
			$calle_ent = $_POST['calle_ent'];
			$numero_ent = $_POST['numero_ent'];
			$interior_ent = $_POST['interior_ent'];
			$colonia_ent = $_POST['colonia_ent'];
			$ciudad_ent = $_POST['ciudad_ent'];
			$estado_ent = $_POST['estado_ent'];
			$cp_ent = $_POST['cp_ent'];
			$telefono_ent = $_POST['telefono_ent'];
			$email_ent = $_POST['email_ent'];
			$fecha_entrega_ent = $_POST['fecha_entrega_ent'];
			$hora_entrega_r1 = $_POST['hora_entrega_r1'];
			$hora_entrega_r2 = $_POST['hora_entrega_r2'];
			$forma_entrega_ent = $_POST['forma_entrega_ent'];
			$det_forma_entrega = $_POST['det_forma_entrega'];
			$referencia_ent = $_POST['referencia_ent'];
			$empaque = $_POST['empaque'];
			

			$rspta=$list_pedidos->guardar_datos_entrega(
				$idpedido,
				$contacto_ent,
				$calle_ent,
				$numero_ent,
				$interior_ent,
				$colonia_ent,
				$ciudad_ent,
				$estado_ent,
				$cp_ent,
				$telefono_ent,
				$email_ent,
				$fecha_entrega_ent,
				$hora_entrega_r1,
				$hora_entrega_r2,
				$forma_entrega_ent,
				$det_forma_entrega,
				$referencia_ent,
				$empaque
			);
			echo json_encode($rspta);

		break;
	
}
?>