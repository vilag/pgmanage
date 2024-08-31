<?php
require_once "../modelos/Diseno.php";

$diseno=new Diseno();

switch ($_GET["op"])
	{


		case 'llenar_modelos':
				
				$marca = 0;

				$rspta = $diseno->llenar_modelos();
			
				while ($reg = $rspta->fetch_object())
						{
							//echo '<div style="background: #ffffff;" width="30px"></div>';

							$marca = $marca+1;

							echo '
								  <a class="btn btn-app" onclick="select_modelos('.$reg->idmuebles_fam.',\''.$reg->codigo.'\',\''.$marca.'\');" id="btn_tipos'. $marca .'">
	                                <i class=""></i> '.$reg->nombre.'
	                                <h6>'.$reg->codigo.'</h6>
	                              </a>

									';
						}

						echo '<h6 id="num_tipos" style="visibility: hidden;">'.$marca.'</h6>';
				
		break;

		case 'select_modelos':

				$marca = 0;
				//Recibimos el idingreso
				$id=$_GET['id'];

				$rspta = $diseno->select_modelos($id);
			
				while ($reg = $rspta->fetch_object())
						{
							//echo '<div style="background: #ffffff;" width="30px"></div>';

							$marca = $marca+1;

							echo '
								  <a class="btn btn-app" onclick="select_tamano('.$reg->idmodelo.',\''.$reg->codigo.'\',\''.$marca.'\');" id="btn_modelos'. $marca .'">
	                                <i class=""></i>'.$reg->nombre.'
	                                <h6>'.$reg->codigo.'</h6>
	                              </a>
									';
							
						}

						echo '<h6 id="num_modelos" style="visibility: hidden;">'.$marca.'</h6>';
				
		break;

		case 'select_tamano':
		
				$marca = 0;

				$id=$_GET['id'];

				$rspta = $diseno->select_tamano($id);
			
				while ($reg = $rspta->fetch_object())
						{
							//echo '<div style="background: #ffffff;" width="30px"></div>';

							$marca = $marca+1;

							echo '
								  <a class="btn btn-app" onclick="select_colores('.$reg->idtamano.',\''.$reg->codigo.'\',\''.$marca.'\');" id="btn_tam'. $marca .'">
	                                <i class=""></i> '.$reg->nombre.'
	                                <h6>'.$reg->codigo.'</h6>
	                              </a>
									';
							
						}

						echo '<h6 id="num_tam" style="visibility: hidden;">'.$marca.'</h6>';
				
		break;

		case 'select_colores':

				$marca = 0;

				$rspta = $diseno->select_colores();
			
				while ($reg = $rspta->fetch_object())
						{
							$marca = $marca+1;

							echo '
								  <a class="btn btn-app" onclick="create_code('.$marca.',\''.$reg->codigo.'\');" id="btn_colores'. $marca .'">
	                                <i class=""></i>
	                                <h6>'.$reg->nombre.'</h6>
	                              </a>
	                              
									';		
						}

						echo '<h6 id="num_colores" style="visibility: hidden;">'.$marca.'</h6>';
		break;


		case 'select_paletas':
				$rspta = $diseno->select_paletas();
			
				while ($reg = $rspta->fetch_object())
						{
							echo '
								  <a class="btn btn-app" onclick="montar_paletas('.$reg->idpaletas.');">
	                                <i class=""></i>
	                                <h6>'.$reg->nombre.'</h6>
	                              </a>
	                              
									';		
						}
		break;

		case 'select_parrillas':
				$rspta = $diseno->select_parrillas();
			
				while ($reg = $rspta->fetch_object())
						{
							echo '
								  <a class="btn btn-app" onclick="montar_parrillas('.$reg->idparrillas.');">
	                                <i class=""></i>
	                                <h6>'.$reg->nombre.'</h6>
	                              </a>
	                              
									';		
						}
		break;

		

		case 'select_estruc_resp':
				$rspta = $diseno->select_estruc_resp();
			
				while ($reg = $rspta->fetch_object())
						{
							echo '
								  <a class="btn btn-app" onclick="montar_colores('.$reg->idrespaldos.');">
	                                <i class=""></i>
	                                <h6>'.$reg->nombre.'</h6>
	                              </a>
	                              
									';		
						}
		break;

		case 'select_estruc_pal':
				$rspta = $diseno->select_estruc_pal();
			
				while ($reg = $rspta->fetch_object())
						{
							echo '
								  <a class="btn btn-app" onclick="montar_colores('.$reg->idestruc_paleta.');">
	                                <i class=""></i>
	                                <h6>'.$reg->nombre.'</h6>
	                              </a>
	                              
									';		
						}
		break;

		case 'guardar_pedido_temp':

			$fecha_hora = $_POST['fecha_hora'];
			$tipo_ped = $_POST['tipo_ped'];

			$rspta=$diseno->guardar_pedido_temp($fecha_hora,$tipo_ped);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_idprod':
		
			$codigo = $_POST['codigo'];

			$rspta=$diseno->consul_idprod($codigo);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_exist':
		
			$idproducto = $_POST['idproducto'];
			$id_ped_temp = $_POST['id_ped_temp'];

			$rspta=$diseno->consul_exist($idproducto,$id_ped_temp);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'save_prod_ped':
		
			$idproducto = $_POST['idproducto'];
			$id_ped_temp = $_POST['id_ped_temp'];
			$precio = $_POST['precio'];
			$tipo_add = $_POST['tipo_add'];
			$fecha_hora = $_POST['fecha_hora'];
			$idusuario = $_POST['idusuario'];

			$rspta=$diseno->save_prod_ped($idproducto,$id_ped_temp,$precio,$tipo_add,$fecha_hora,$idusuario);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'rango_iddetalle':
		
			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			

			$rspta=$diseno->rango_iddetalle($idpg_detalle_pedidos);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'upd_fecha_salida':
		
			$idsalida = $_POST['idsalida'];
			$fecha_hora_salida_input = $_POST['fecha_hora_salida_input'];
			

			$rspta=$diseno->upd_fecha_salida($idsalida,$fecha_hora_salida_input);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;




		case 'buscar_avances':
		
			$idpg_detped1 = $_POST['idpg_detped1'];
			$idpg_detped2 = $_POST['idpg_detped2'];
			

			$rspta=$diseno->buscar_avances($idpg_detped1,$idpg_detped2);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'change_prod_ped':
		
			$idproducto = $_POST['idproducto'];
			$id_ped_temp = $_POST['id_ped_temp'];
			$precio = $_POST['precio'];
			//$tipo_add = $_POST['tipo_add'];
			$fecha_hora = $_POST['fecha_hora'];
			$idusuario = $_POST['idusuario'];
			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			$idpg_detped1 = $_POST['idpg_detped1'];
			$idpg_detped2 = $_POST['idpg_detped2'];

			$rspta=$diseno->change_prod_ped($idproducto,$id_ped_temp,$precio,$fecha_hora,$idusuario,$idpg_detalle_pedidos,$idpg_detped1,$idpg_detped2);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		

		case 'quitar_prod_ped':
		
			$idproducto = $_POST['idproducto'];
			$id_ped_temp = $_POST['id_ped_temp'];
			$precio = $_POST['precio'];
			//$tipo_add = $_POST['tipo_add'];
			$fecha_hora = $_POST['fecha_hora'];
			$idusuario = $_POST['idusuario'];
			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			$idpg_detped1 = $_POST['idpg_detped1'];
			$idpg_detped2 = $_POST['idpg_detped2'];

			$rspta=$diseno->quitar_prod_ped($idproducto,$id_ped_temp,$precio,$fecha_hora,$idusuario,$idpg_detalle_pedidos,$idpg_detped1,$idpg_detped2);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_notif':
		
				//$num = 0;

				//$id=$_GET['id'];

				$rspta = $diseno->consul_notif();
			
				while ($reg = $rspta->fetch_object())
						{
							//echo '<div style="background: #ffffff;" width="30px"></div>';

							//$num = $num+1;

							if ($reg->notificacion==1) {
								$color = "#D5F2FB;";
							}elseif ($reg->notificacion<>1) {
								$color = "#ffffff;";
							}

							echo '


								<li class="nav-item" style="background: '.$color.'">
			                      <a class="dropdown-item" href="sale_product.php?pedido='.$reg->idpedido.'" onclick="abrir_observ_notif('.$reg->idhistorial_mov.');">
			                        
			                        <span>
			                          <span>Control:'. $reg->no_control .'</span>
			                          <span class="time">'. $reg->fecha_hora .'</span>
			                        </span>
			                        <span class="message">
			                        '. $reg->movimiento .'  
			                        </span>

			                      </a>
			                      
			                    </li>

									';

							
						}

						echo '

								<li class="nav-item">
			                        <div class="text-center">
			                          <a class="dropdown-item" onclick="mostrar_todo_notif();">
			                            <strong>Ver todos los alertas</strong>
			                            <i class="fa fa-angle-right"></i>
			                          </a>
			                        </div>
			                    </li>

						';

						
				
		break;

		case 'consul_notif2':
		
				//$num = 0;

				//$id=$_GET['id'];

				$rspta = $diseno->consul_notif2();

							echo '

								<ul class="list-unstyled msg_list">



							';
			
				while ($reg = $rspta->fetch_object())
						{
							//echo '<div style="background: #ffffff;" width="30px"></div>';

							//$num = $num+1;

							if ($reg->notificacion==1) {
								$color = "#D5F2FB;";
							}elseif ($reg->notificacion<>1) {
								$color = "#ffffff;";
							}

							echo '


								<li style="background: '.$color.'">
			                      <a href="sale_product.php?pedido='.$reg->idpedido.'" onclick="abrir_observ_notif('.$reg->idhistorial_mov.');">
			                        
			                        <span>
			                          <span>Control:'. $reg->no_control .'</span>
			                          <span class="time">'. $reg->fecha_hora .'</span>
			                        </span>
			                        <span class="message">
			                          '. $reg->movimiento .'
			                        </span>
			                      </a>
			                    </li>



			                    



									';

							
						}

					
						echo '

							</ul>

						';
						
				
		break;

		case 'consul_todo_mensajes':
		
				//$num = 0;

				$idusuario=$_GET['idusuario'];

				$rspta = $diseno->consul_todo_mensajes($idusuario);

							echo '

								<ul class="list-unstyled msg_list">



							';
			
				while ($reg = $rspta->fetch_object())
						{
							//echo '<div style="background: #ffffff;" width="30px"></div>';

							//$num = $num+1;

							if ($reg->rev_notif==1) {
								$color = "#D5F2FB;";
							}elseif ($reg->rev_notif<>1) {
								$color = "#ffffff;";
							}

							echo '


								


			                    <li class="nav-item" style="background: '.$color.'">
			                      <a class="dropdown-item" href="#" onclick="mostrar_mensajes_control_select('.$reg->idpg_pedidos.');">
			                        
			                        <span>
			                          <span>Control:'. $reg->no_control .'</span>
			                          <span class="time">'. $reg->fecha_hora .'</span>
			                        </span><br>
			                        
			                        <span class="message">
			                        '. $reg->nom_usuario .': <b>'. $reg->mensaje .' </b>  
			                        </span>

			                      </a>
			                      
			                    </li>


			                    



									';

							
						}

					
						echo '

							</ul>

						';
						
				
		break;
		

		case 'num_observ_notif':

			//$id_ped_temp = $_POST['id_ped_temp'];

			$rspta=$diseno->num_observ_notif();
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'tbl_prod_ped':
			//Recibimos el idingreso
			$id=$_GET['id'];

			$rspta = $diseno->tbl_prod_ped($id);


						echo '

								<table class="table" id="tbl_rep_pedido" style="1000px;">
                            		  <thead>
                            		  	
		                                <tr style="background: #2A3F54; color: #fff;">
		                                  <th>Eliminar</th>
		                                  <th>Codigo</th>
		                                  <th>Nombre</th>
		                                  <th>Color</th>
		                                  <th>Cantidad</th>
		                                  <th>Observaciones</th>
		                                  
		                                </tr>
		                              </thead>
		                              <tbody style="border-bottom: double;">

						';
			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						//<b id="eti_especial">(Especial)</b>
						echo '
 
				                        <tr>
				                          <td style="width: 10%;"><button type="button" class="btn btn-round btn-danger" onclick="borrar_prod('.$reg->idproducto.');">X</button></td>
				                          <td style="width: 10%;">
				                          <h5>'. $reg->codigo .'</h5><br>
				                          
				                          </td>
				                          <td style="width: 30%;">
				                          	
					                        <textarea class="form-control" id="input_nom_prod'.$reg->idproducto.'" cols="40" rows="3" onchange="nombre_prod('.$reg->idproducto.');" >'. $reg->nombre .'</textarea>
				                          </td>
				                          <td style="width: 15%;">
				                          
				                          <textarea class="form-control" cols="40" rows="3" id="input_color_prod'.$reg->idproducto.'" disabled>'. $reg->color .'</textarea>
				                          </td>
				                          <td style="width: 15%;">
				                          <input type="number" class="form-control" value="'. $reg->cantidad .'" disabled>
										  <button style="width: 100%; margin-top: 5px; border: none; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2); padding: 5px;" onclick="capturar_cant('.$reg->idproducto.');">Editar</button>
				                          
				                          </td>
				                          
				                          <td style="width: 20%;">
				                          
				                          <textarea class="form-control" cols="40" rows="3" onkeyup="observ_prod('.$reg->idproducto.');" id="input_obser_prod'.$reg->idproducto.'">'. $reg->observacion .'</textarea>
				                          </td>

				                        </tr>


						';
						
					}



						echo '


									</tbody>
                            
                          		</table>

						';	
			
		break;

		case 'buscar_reg_prod':
		
			$id_ped_temp = $_POST['id_ped_temp'];
			$idproducto = $_POST['idproducto'];
		

			$rspta=$diseno->buscar_reg_prod($id_ped_temp,$idproducto);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'update_cant':
		
			$id_ped_temp = $_POST['id_ped_temp'];
			$idproducto = $_POST['idproducto'];
			$cantidad = $_POST['cantidad'];
			$importe = $_POST['importe'];

			$rspta=$diseno->update_cant($id_ped_temp,$idproducto,$cantidad,$importe);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'update_observa':
		
			$id_ped_temp = $_POST['id_ped_temp'];
			$idproducto = $_POST['idproducto'];
			$input_obser_prod = $_POST['input_obser_prod'];
			

			$rspta=$diseno->update_observa($id_ped_temp,$idproducto,$input_obser_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'update_descrip':
		
			$id_ped_temp = $_POST['id_ped_temp'];
			$idproducto = $_POST['idproducto'];
			$input_nom_prod = $_POST['input_nom_prod'];
			

			$rspta=$diseno->update_descrip($id_ped_temp,$idproducto,$input_nom_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'borrar_prod':
		
			$id_ped_temp = $_POST['id_ped_temp'];
			$idproducto = $_POST['idproducto'];
	

			$rspta=$diseno->borrar_prod($id_ped_temp,$idproducto);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'tbl_clientes':
			//Recibimos el idingreso
			$id=$_GET['id'];

			$rspta = $diseno->tbl_clientes($id);



						echo '<thead>
                                <tr>
                                  <th>No. Cliente</th>
                                  <th>Nombre</th>
                                  <th>Opciones</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						echo '

								<tr>
                                  <td>'.$reg->no_cliente.'</td>
                                  <td>'.$reg->nombre.'</td>
                                  <td><button type="button" class="btn btn-round btn-danger" onclick="select_cliente2('.$reg->idcliente.',\''.$reg->no_cliente.'\',\''.$reg->nombre.'\');">Seleccionar</button></td>
                                 
                                </tr>


						';
						
					}

						echo '</tbody>';
			
		break;

		case 'buscar_texto_tbl':
			//Recibimos el idingreso
			//$id=$_GET['id'];
			$id=$_GET['id'];
			$lugar_user=$_GET['lugar_user'];

			$rspta = $diseno->buscar_texto_tbl($id,$lugar_user);



						echo '<thead>
                                <tr>
                                  <th>No. Cliente</th>
                                  <th>Nombre</th>
                                  <th>Opciones</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						echo '

								<tr>
                                  <td>'.$reg->no_cliente.'</td>
                                  <td>'.$reg->nombre.'</td>
                                  <td><button type="button" class="btn btn-round btn-danger" onclick="select_cliente2('.$reg->idcliente.');">Seleccionar</button></td>
                                 
                                </tr>


						';
						
					}

						echo '</tbody>';
			
		break;

		case 'buscar_cliente':
		
			$idcliente = $_POST['idcliente'];
			$id_ped_temp = $_POST['id_ped_temp'];
	

			$rspta=$diseno->buscar_cliente($idcliente,$id_ped_temp);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_ped_max':
		
			$idcliente = $_POST['idcliente'];

			$rspta=$diseno->consul_ped_max($idcliente);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_datos_fac':
		
			$idcliente = $_POST['idcliente'];
			$rspta=$diseno->buscar_datos_fac($idcliente);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_datos_ent':
		
			$idcliente = $_POST['idcliente'];
			$rspta=$diseno->buscar_datos_ent($idcliente);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'update_dir_fac':
		
			$idcliente = $_POST['idcliente'];
			$razon_edit = $_POST['razon_edit'];
			$rfc_edit = $_POST['rfc_edit'];
			$calle_edit = $_POST['calle_edit'];
			$numero_edit = $_POST['numero_edit'];
			$interior_edit = $_POST['interior_edit'];
			$colonia_edit = $_POST['colonia_edit'];
			$municipio_edit = $_POST['municipio_edit'];
			$estado_edit = $_POST['estado_edit'];
			$cp_edit = $_POST['cp_edit'];
			$tel_edit = $_POST['tel_edit'];
			$email_edit = $_POST['email_edit'];


			$rspta=$diseno->update_dir_fac($idcliente,$razon_edit,$rfc_edit,$calle_edit,$numero_edit,$interior_edit,$colonia_edit,$municipio_edit,$estado_edit,$cp_edit,$tel_edit,$email_edit);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'insert_dir_fac':
		
			$idcliente = $_POST['idcliente'];
			$razon_edit = $_POST['razon_edit'];
			$rfc_edit = $_POST['rfc_edit'];
			$calle_edit = $_POST['calle_edit'];
			$numero_edit = $_POST['numero_edit'];
			$interior_edit = $_POST['interior_edit'];
			$colonia_edit = $_POST['colonia_edit'];
			$municipio_edit = $_POST['municipio_edit'];
			$estado_edit = $_POST['estado_edit'];
			$cp_edit = $_POST['cp_edit'];
			$tel_edit = $_POST['tel_edit'];
			$email_edit = $_POST['email_edit'];


			$rspta=$diseno->insert_dir_fac($idcliente,$razon_edit,$rfc_edit,$calle_edit,$numero_edit,$interior_edit,$colonia_edit,$municipio_edit,$estado_edit,$cp_edit,$tel_edit,$email_edit);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;




		case 'listar_direcciones':
			//Recibimos el idingreso
			$id=$_GET['id'];

			$rspta = $diseno->listar_direcciones($id);
			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						echo '
									<div class="form-group col-md-12 col-sm-12 fondo_div" onclick="select_dir_ent('.$reg->identregas.');">

										<div class="form-group col-md-6 col-sm-12">
                                          
                                              <h5>Contacto:<small id="nombre_cliente_ent'.$reg->identregas.'">'.$reg->contacto_ent.'</small></h5>  
                                              <h5>Calle:<small id="calle_ent'.$reg->identregas.'">'.$reg->calle_ent.'</small></h5>
                                              <h5>Numero:<small id="numero_ent'.$reg->identregas.'">'.$reg->numero_ent.'</small></h5>
                                              <h5>Int.:<small id="interior_ent'.$reg->identregas.'">'.$reg->interior_ent.'</small></h5>
                                              <h5>Colonia:<small id="colonia_ent'.$reg->identregas.'">'.$reg->colonia_ent.'</small></h5>
                                              <h5>Ciudad:<small id="ciudad_ent'.$reg->identregas.'">'.$reg->ciudad_ent.'</small></h5>
                                              
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                        	  <h5>Estado:<small id="estado_ent'.$reg->identregas.'">'.$reg->estado_ent.'</small></h5>
                                              <h5>C.P.:<small id="cp_ent'.$reg->identregas.'">'.$reg->cp_ent.'</small></h5>
                                              <h5>Telefono:<small id="telefono_ent'.$reg->identregas.'">'.$reg->telefono_ent.'</small></h5>
                                              <h5>Email:<small id="email_ent'.$reg->identregas.'">'.$reg->email_ent.'</small></h5>
                                              
                                              <h5>Referencia:<small id="referencia_ent'.$reg->identregas.'">'.$reg->referencia_ent.'</small></h5>
                                              
                                              
                                              
                                        </div>
                                    </div>
                                    <br>
                                    <br>
						';
						
					}
			
		break;


		case 'save_dir_ent':
		
			$id_cliente = $_POST['id_cliente'];
			$contacto_upd = $_POST['contacto_upd'];
			$calle_upd = $_POST['calle_upd'];
			$numero_upd = $_POST['numero_upd'];
			$int_upd = $_POST['int_upd'];
			$colonia_upd = $_POST['colonia_upd'];
			$ciudad_upd = $_POST['ciudad_upd'];
			$estado_upd = $_POST['estado_upd'];
			$cp_upd = $_POST['cp_upd'];
			$telefono_upd = $_POST['telefono_upd'];
			$email_upd = $_POST['email_upd'];

			$fecha_entrega_upd = $_POST['fecha_entrega_upd'];
			$hora_entrega_upd = $_POST['hora_entrega_upd'];
			$hora_entrega_upd_r2 = $_POST['hora_entrega_upd_r2'];

			$forma_entrega_upd = $_POST['forma_entrega_upd'];
			$det_forma_entrega_upd = $_POST['det_forma_entrega_upd'];
			$referencia_upd = $_POST['referencia_upd'];
		
			
			

			$rspta=$diseno->save_dir_ent($id_cliente,$contacto_upd,$calle_upd,$numero_upd,$int_upd,$colonia_upd,$ciudad_upd,$estado_upd,$cp_upd,$telefono_upd,$email_upd,$fecha_entrega_upd,$hora_entrega_upd,$hora_entrega_upd_r2,$forma_entrega_upd,$det_forma_entrega_upd,$referencia_upd);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'select_dir_ent':
		
			$identregas = $_POST['identregas'];
			
			$rspta=$diseno->select_dir_ent($identregas);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'update_dir_ent':
		
			$identrega_upd = $_POST['identrega_upd'];
			$idcliente_upd = $_POST['idcliente_upd'];
			$contacto_upd = $_POST['contacto_upd'];
			$calle_upd = $_POST['calle_upd'];
			$numero_upd = $_POST['numero_upd'];
			$int_upd = $_POST['int_upd'];
			$colonia_upd = $_POST['colonia_upd'];
			$ciudad_upd = $_POST['ciudad_upd'];
			$estado_upd = $_POST['estado_upd'];
			$cp_upd = $_POST['cp_upd'];
			$telefono_upd = $_POST['telefono_upd'];
			$email_upd = $_POST['email_upd'];
			
			$fecha_entrega_upd = $_POST['fecha_entrega_upd'];
			$hora_entrega_upd = $_POST['hora_entrega_upd'];
			$hora_entrega_upd_r2 = $_POST['hora_entrega_upd_r2'];
			$forma_entrega_upd = $_POST['forma_entrega_upd'];
			$det_forma_entrega_upd = $_POST['det_forma_entrega_upd'];

			$referencia_upd = $_POST['referencia_upd'];
			$doc_ped_sal = $_POST['doc_ped_sal'];
			$id_ped_temp2 = $_POST['id_ped_temp2'];
			
			$rspta=$diseno->update_dir_ent($identrega_upd,$idcliente_upd,$contacto_upd,$calle_upd,$numero_upd,$int_upd,$colonia_upd,$ciudad_upd,$estado_upd,$cp_upd,$telefono_upd,$email_upd,$fecha_entrega_upd,$hora_entrega_upd,$hora_entrega_upd_r2,$forma_entrega_upd,$det_forma_entrega_upd,$referencia_upd,$doc_ped_sal,$id_ped_temp2);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_dir_entrega':

			$id_ped_temp = $_POST['id_ped_temp'];
			$identregas = $_POST['identregas'];
						
			$rspta=$diseno->guardar_dir_entrega($id_ped_temp,$identregas);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_dir_fact':

			$id_ped_temp = $_POST['id_ped_temp'];
			$idfacturacion = $_POST['idfacturacion'];
						
			$rspta=$diseno->guardar_dir_fact($id_ped_temp,$idfacturacion);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;



		case 'guardar_pedido':
		
			$id_ped_temp = $_POST['id_ped_temp'];
			$fecha_pedido = $_POST['fecha_pedido'];
			$id_cliente = $_POST['id_cliente'];	
			$no_pedido_lugar = $_POST['no_pedido_lugar'];	
			$condiciones = $_POST['condiciones'];	
			$ultimo_control = $_POST['ultimo_control'];	
			$asesor = $_POST['asesor'];	
			$persona_pedido = $_POST['persona_pedido'];	
			$cliente_nuevo = $_POST['cliente_nuevo'];	
			$medio = $_POST['medio'];	
			$lab = $_POST['lab'];	
			$autorizacion = $_POST['autorizacion'];	
			$id_retorno_ent = $_POST['id_retorno_ent'];	
			$fecha_entrega = $_POST['fecha_entrega'];
			$hora_entrega = $_POST['hora_entrega'];
			$hora_entrega2 = $_POST['hora_entrega2'];
			$forma_entrega = $_POST['forma_entrega'];
			$det_forma_ent = $_POST['det_forma_ent'];
			$id_retorno_fac = $_POST['id_retorno_fac'];

			$reglamentos = $_POST['reglamentos'];
			$empaque = $_POST['empaque'];
			$metodo_pago = $_POST['metodo_pago'];
			$forma_pago = $_POST['forma_pago'];
			$uso_cfdi = $_POST['uso_cfdi'];
			$fecha_envio_enlace = $_POST['fecha_envio_enlace'];
			$salida = $_POST['salida'];
			$factura = $_POST['factura'];
			$otros = $_POST['otros'];
			$idusuario = $_POST['idusuario'];
			$max_ped_cli = $_POST['max_ped_cli'];

			
			$rspta=$diseno->guardar_pedido($id_ped_temp,$fecha_pedido,$id_cliente,$no_pedido_lugar,$condiciones,$ultimo_control,$asesor,$persona_pedido,$cliente_nuevo,$medio,$lab,$autorizacion,$id_retorno_ent,$fecha_entrega,$hora_entrega,$hora_entrega2,$forma_entrega,$det_forma_ent,$id_retorno_fac,$reglamentos,$empaque,$metodo_pago,$forma_pago,$uso_cfdi,$fecha_envio_enlace,$salida,$factura,$otros,$idusuario,$max_ped_cli);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'save_cliente':
			
			$lugar_user = $_POST['lugar_user'];
			$num_cli = $_POST['num_cli'];
			$nom_cli = $_POST['nom_cli'];
			$rfc_cli = $_POST['rfc_cli'];
			$calle_cli = $_POST['calle_cli'];
			$numero_cli = $_POST['numero_cli'];
			$int_cli = $_POST['int_cli'];
			$colonia_cli = $_POST['colonia_cli'];
			$ciudad_cli = $_POST['ciudad_cli'];
			$estado_cli = $_POST['estado_cli'];
			$cp_cli = $_POST['cp_cli'];
			$telefono_cli = $_POST['telefono_cli'];
			$email_cli = $_POST['email_cli'];
				
			
			$rspta=$diseno->save_cliente($lugar_user,$num_cli,$nom_cli,$rfc_cli,$calle_cli,$numero_cli,$int_cli,$colonia_cli,$ciudad_cli,$estado_cli,$cp_cli,$telefono_cli,$email_cli);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'buscar_cliente2':
			//Recibimos el idingreso
			/*$num_cli = $_POST['num_cli'];
			$nom_cli = $_POST['nom_cli'];*/

			$id=$_GET['id'];
			//$id2=$_GET['id2'];

			$rspta = $diseno->buscar_cliente2($id);
			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<p>'.$reg->no_cliente.' -  '.$reg->nombre.'</p>	
						';
						
					}
			
		break;


		case 'tbl_rep_pedido_consul':
			//Recibimos el idingreso
			$id=$_GET['id'];
			$idusuario=$_GET['idusuario'];

			$rspta = $diseno->tbl_rep_pedido_consul($id);



						echo '	<thead>
	                              <tr>
	                                <th></th>
	                                <th>Cant.</th>
	                                <th>Unidad</th>
	                                <th>Codigo</th>
	                                <th>Medida</th>
	                                
	                                <th>Descripción</th>
	                                <th>Observación</th>
	                                <th>Color</th>
	                                <th>Precio</th>
	                                <th>Desc.</th>
	                                <th>Importe</th>
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($idusuario==1) {
							$visib = "visible;";
						}elseif ($idusuario<>1) {
							
							$estatus=$reg->estatus;

							if ($estatus=="Produccion" OR $estatus=="Apartado" OR $estatus=="Fabricado" OR $estatus=="Existencia") {
								$visib = "hidden;";
							}elseif ($estatus<>"Produccion" AND $estatus<>"Apartado" AND $estatus<>"Fabricado" AND $estatus<>"Existencia") {
								$visib = "visible;";
							}
							
						}

						if ($reg->descripcion=="") {
							$decrip = $reg->observacion;
							# code...
						}elseif ($reg->descripcion<>"") {
							$decrip = $reg->descripcion;
						}
							

						echo '

								<tr>
									<td>

									<a href="#" onclick="edit_prod('. $reg->idproducto .')" style="visibility: '.$visib.'" id="ida_edit'.$reg->idproducto.'"><i class="fa fa-edit"></i><span class="text-muted"></span></a>

					                </td>
	                                <td>'.$reg->cantidad.'</td>
	                                <td>'.$reg->unidad.'</td>
	                                <td>'.$reg->codigo.'</td>
	                                <td>'.$reg->medida.'</td>
	                                                               
	                                <td>'.$decrip.'</td>
	                                <td>'.$reg->observacion.'</td>
	                                <td align="right">'.$reg->color.'</td>
	                                <td align="right">'.$reg->precio.'</td>
	                                <td align="right">'.$reg->descuento_cant.'</td>
	                                <td align="right">'.$reg->importe.'</td>
	                             </tr>


						';
						
					}

						echo '</tbody>
							  

						';
			
		break;


		case 'tbl_rep_pedido_consul2':
			//Recibimos el idingreso
			//$id=$_GET['id'];
			$id=$_GET['id'];

			$rspta = $diseno->tbl_rep_pedido_consul($id);



						echo '	<thead>
	                              <tr>
	                                
	                                <th>Cant.</th>
	                                <th>Unidad</th>
	                                <th>Codigo</th>
	                                <th>Medida</th>
	                                
	                                <th>Descripción</th>
	                                <th>Observación</th>
	                                <th>Color</th>
	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->descripcion=="") {
							$decrip = $reg->observacion;
							# code...
						}elseif ($reg->descripcion<>"") {
							$decrip = $reg->descripcion;
						}

						echo '

								<tr>
									
	                                <td>'.$reg->cantidad.'</td>
	                                <td>'.$reg->unidad.'</td>
	                                <td>'.$reg->codigo.'</td>
	                                <td>'.$reg->medida.'</td>
	                                                               
	                                <td>'.$decrip.'</td>
	                                <td>'.$reg->observacion.'</td>
	                                <td align="right">'.$reg->color.'</td>
	                                
	                             </tr>


						';
						
					}

						echo '</tbody>
							  

						';
			
		break;


		


		case 'pie_reporte':
			
			$id_ped_temp = $_POST['id_ped_temp'];
										
			$rspta=$diseno->pie_reporte($id_ped_temp);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_datos_control':
			
			$id_ped_temp = $_POST['id_ped_temp'];
										
			$rspta=$diseno->consul_datos_control($id_ped_temp);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_datos_facturacion':
			
			$id_ped_temp = $_POST['id_ped_temp'];
										
			$rspta=$diseno->consul_datos_facturacion($id_ped_temp);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_datos_entrega':
			
			$id_ped_temp = $_POST['id_ped_temp'];
										
			$rspta=$diseno->consul_datos_entrega($id_ped_temp);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'update_observ':
			
			$id_ped_temp = $_POST['id_ped_temp'];
			$observ = $_POST['observ'];
			$nom_fir_cli_rep = $_POST['nom_fir_cli_rep'];
			$nom_fir_prod_rep = $_POST['nom_fir_prod_rep'];
			$reviso_rep = $_POST['reviso_rep'];
										
			$rspta=$diseno->update_observ($id_ped_temp,$observ,$nom_fir_cli_rep,$nom_fir_prod_rep,$reviso_rep);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_prod_rep':
			
			$id_ped_temp = $_POST['id_ped_temp'];
			$idproducto = $_POST['idproducto'];
			
										
			$rspta=$diseno->buscar_prod_rep($id_ped_temp,$idproducto);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'update_prod_rep':
			
			$id_ped_temp = $_POST['id_ped_temp'];
			$idproducto_rep = $_POST['idproducto_rep'];
			$cantidad_rep = $_POST['cantidad_rep'];
			$unidad_rep = $_POST['unidad_rep'];
			$codigo_rep = $_POST['codigo_rep'];
			
			$medida_rep = $_POST['medida_rep'];
			$descripcion_rep = $_POST['descripcion_rep'];
			$color_rep = $_POST['color_rep'];
			
			$precio_rep = $_POST['precio_rep'];
			$descuento_rep = $_POST['descuento_rep'];
			$descuento_rep2 = $_POST['descuento_rep2'];
			$importe_rep = $_POST['importe_rep'];
			
										
			$rspta=$diseno->update_prod_rep($id_ped_temp,$idproducto_rep,$cantidad_rep,$unidad_rep,$codigo_rep,$medida_rep,$descripcion_rep,$color_rep,$precio_rep,$descuento_rep,$descuento_rep2,$importe_rep);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'listar_pedidos':
			
			$id=$_GET['id'];
			$num=$_GET['num'];
			$marca=$_GET['marca'];
			$lugar=$_GET['lugar'];

			$rspta = $diseno->listar_pedidos($id,$num,$marca,$lugar);



						echo '	<thead>

								 

	                              <tr align="center" style="background: #034343; color: white;">
	                                <th style="width:4%">Origen</th>
	                               
	                                <th style="width:9%">Seguimiento</th>
	                                <th style="width:5%">#Control</th>
	                                <th style="width:5%">#Pedido</th>
	                                
	                                                          
	                                <th style="width:44%">Avance de tiempo <br><small>Fecha de pedido | Entrega</small></th>
	                              
	                                <th style="width:5%">DIAS: Total|Quedan</th>
	                                
	                                <th style="width:4%">Estatus</th> 
	                                <th style="width:4%"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></th>
	                                	                              
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



						$documento=$reg->docs;

						if ($documento>0) {
							$visib_docs = "visible";
						}elseif ($documento==0) {
							$visib_docs = "hidden";
						}

						$obser_seg=$reg->observaciones;

						if ($obser_seg<>"") {
							$visib_obser = "visible";
						}elseif ($obser_seg=="") {
							$visib_obser = "hidden";
						}

						$det_forment=$reg->det_forma_entrega;

						if ($det_forment<>"") {
							$visib_forment = "visible";
						}elseif ($det_forment=="") {
							$visib_forment = "hidden";
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

						if ($reg->num_obs_prod>0) {
							$visib_coment_prod = "visible";
						}elseif ($reg->num_obs_prod==0) {
							$visib_coment_prod = "hidden";
						}

						echo '

								
								
									 <tr>
									
										<td align="center">

										<a>'.$reg->lugar.'</a>
			                            <br />
			                             <small>Tipo: '.$tipo.'</small><br>
			                            <small>Cliente: '.$reg->nom_cliente.'</small>

										


										</td>
										
										<td>

											<ul class="list-inline">
				                              <li style="visibility: '.$visib_forment.';">
				                                <img src="images/iconos/detalle_transporte.png" class="avatar" alt="Avatar">
				                              </li>
				                              <li style="visibility: '.$visib_obser.';">
				                                <img src="images/iconos/comment.png" class="avatar" alt="Avatar">
				                              </li>
				                              <li style="visibility: '.$visib_docs.';">
				                                <img src="images/iconos/google-docs.png" class="avatar" alt="Avatar">
				                              </li>

				                            </ul>

										</td>
										<td align="center">'.$reg->no_control.'</td>
						                <td align="center">'.$reg->no_pedido.'</td>
		                               	
		                                
		                                
		                                
		                                <td align="">
		                                	  
		                                      <p align="left"><small>'.$reg->fecha_pedido.'</small> | <small>'.$reg->fecha_entrega.' </small><a href="#" onclick="ver_coment_prod('.$reg->idpg_pedidos.');"><i class="fa fa-comments" style="font-size: 20px; visibility: '.$visib_coment_prod.'"></i></a></p>
		                                	  <div class="progress">
		                                	  	  
				                                  
				                                  
					                              <div class="progress-bar" role="progressbar" style="width: '.$porc_avance.'%; background: '.$color_barra.';" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
					                          </div>  
					                          <b>'.$reg->coment_vencim.'</b>
					                          <h6 id="color_barra_s'.$reg->idpg_pedidos.'" style="visibility: hidden;">'.$color_barra.'</h6>
		                                </td>
		                                
		                                
		                                <td align="center">

		                                	  <h5><small>'.$dias_totales.'</small>|<small id="dias_restantes'.$reg->idpg_pedidos.'">'.$dias_faltantes.'</small></h5>
		                                </td>
		                               
		                               	<td align="center">
		                                	  <small>'.$reg->estatus.'</small>
		                                	  <h5 style="background: #'.$color_status.'; color: #'.$color_status.';">__</h5>
		                                </td>
		                                
						                
						                <td align="center">
						                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
						                	<span class="glyphicon glyphicon-th" aria-hidden="true"></span>
						                	<span class="badge" style="background: red; color: white;">'.$dias_noti.'</span>
						                	</a>
							                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							                        	<a href="sale_product.php?pedido='.$reg->idpg_pedidos.'">
							                            	<button type="button" class="btn btn-primary">
											                
											                <span class="glyphicon glyphicon-new-window" aria-hidden="true" style="color: white;"></span>
												                
												            </button>
											            </a>
							                            <button style="background: #ADF7CC;" type="button" class="btn btn-round " onclick="abrir_seg_ped('.$reg->idpg_pedidos.',\''.$porc_avance.'\',\''.$reg->coment_vencim.'\');"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
							                            </button>
							                            <button style="background: #ADE0F7;" type="button" class="btn btn-round " onclick="abrir_docs('.$reg->idpg_pedidos.');">
							                            	<span class="badge" style="background: red; color:white;">'.$dias_noti.'</span>
							                            	<span class="glyphicon glyphicon-file" aria-hidden="true"></span><span class="glyphicon-class"></span>
							                            </button>

							                            
							                            
							                         </div>

						                </td>
						                
	                               		
		                             </tr>

		                            
		                            

	                            

						';

					
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_pedidos_v2':
		

			$rspta = $diseno->listar_pedidos_v2();

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
						

						echo '

								
								
								<a href="#">
		                          <div class="mail_list">
		                            
		                            <div>
		                              
		                              <p style="margin-bottom: 2px; margin-top: 8px;"><b style="font-size: 20px;">'.$reg->no_control.'</b> - P: '.$reg->no_pedido.'<br><small>'.$reg->lugar.' - '.$tipo.'</small></p>
		                              <p style="margin-bottom: 10px;"><b>'.$reg->nom_cliente.'</b></p>
		                             
		                            </div>
		                            <div class="progress" style="height:5px; width: 80%; margin-bottom: 10px;">
		                                <div class="progress-bar" role="progressbar" style="width: '.$porc_avance.'%; background: '.$color_barra.';" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
					                </div>
					                
		                            
		                          </div>
		                          
		                        </a>	 

		                            
		                          	                            

						';

					
						
					}

		break;

		case 'listar_pedidos2':

			$id=$_GET['id'];
			$num=$_GET['num'];
			$marca=$_GET['marca'];
			$lugar=$_GET['lugar'];
			

			$rspta = $diseno->listar_pedidos2($id,$num,$marca,$lugar);

			//$total=0;
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

					
						if ($lugar=="Fabrica" || $lugar=="Zuno") {
							 
							 $visib = "";
						}elseif ($lugar<>"Fabrica" && $lugar<>"Zuno") {
							 
							 $visib = "disabled";
						}

										echo '

											
								              <div class="col-md-12 col-sm-12">
								                <div class="x_panel">
								                  <div class="x_title">

								                  		<div class="form-group col-md-6 col-sm-6">
								                  			<strong><h2>Control: '.$reg->no_control.'</h2></strong>
								                  		</div>

								                  		<div class="form-group col-md-6 col-sm-6" align="right">
								                  			<h6>Origen: '.$reg->lugar.'</h6>
								                  			<h6>Pedido: '.$reg->no_pedido.'</h6>
								                  			<h6>Cliente: '.$reg->nom_cliente.'</h6>
								                  		</div>
								                  		

								                  		
								                  		
								                  		<div class="form-group col-md-6 col-sm-12">
								                  			
								                  			  <p align="left">Pedido: '.$reg->fecha_pedido.'</p>
						                                	  <div class="progress">
						                                	  	  
								                                  
								                                  
									                              <div class="progress-bar" role="progressbar" style="width: '.$porc_avance.'%; background: '.$color_barra.';" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
									                          </div>  
									                          <p align="right">Entrega: '.$reg->fecha_entrega.'</p>
									                          <h6 id="color_barra_s'.$reg->idpg_pedidos.'" style="visibility: hidden;">'.$color_barra.'</h6>
								                  			
								                  			
								                  		</div>
								                  		<div class="form-group col-md-6 col-sm-12">
								                  			'.$reg->estatus.'
								                  			<label>_</label>
		                                	  				<h5 style="background: #'.$color_status.'; color: #'.$color_status.';">__</h5>

								                  		</div>
								                  		


								                  		<div class="form-group col-md-12 col-sm-12">
								                  			
								                  			Productos
								                  			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
										                	
										                	</a>
								                  			

								                  			<button type="button" class="btn btn-round btn-info" style="background: white;" onclick="llenar_box_prod('.$reg->idpg_pedidos.');"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></button>
								                  						<a href="sale_product.php?pedido='.$reg->idpg_pedidos.'">
											                            	<button type="button" class="btn btn-primary">
															                
															                <span class="glyphicon glyphicon-new-window" aria-hidden="true" style="color: white;"></span>
																                
																            </button>
															            </a>
											                            <button style="background: #ADF7CC;" type="button" class="btn btn-round " onclick="abrir_seg_ped('.$reg->idpg_pedidos.',\''.$porc_avance.'\');" '.$visib.'><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
											                            </button>
											                            <button style="background: #ADE0F7;" type="button" class="btn btn-round " onclick="abrir_docs('.$reg->idpg_pedidos.');">
											                            	<span class="badge" style="background: red; color:white;">'.$dias_noti.'</span>
											                            	<span class="glyphicon glyphicon-file" aria-hidden="true"></span><span class="glyphicon-class"></span>
											                            </button>
								                  			
								                  		</div>
								                  		

								                  		<div class="form-group col-md-12 col-sm-12" style="overflow:scroll;height:auto;width:1000px;">
								                  			
								                  		

                         									

                         									 <table id="tbl_prod_ped_box'.$reg->idpg_pedidos.'" class="table table-hover">
                                            
                                          					 </table>

                         									 

								                  		</div>

								                  		
								                  		

								                  		

								                  		

									                        
								                       
								                        
								                    <div class="clearfix"></div>
								                  </div>
								                  <div class="x_content" style="visibility: visible;">

								                  		
								                  </div>

								                </div>
								              </div>
								            


										';
							
										
						
					}

						
		break;

		case 'listar_pedidos3':
			
			$id=$_GET['id'];
			//$num=$_GET['num'];
			//$marca=$_GET['marca'];
			$lugar=$_GET['lugar'];
			$no_control_buscar=$_GET['no_control_buscar'];

			$rspta = $diseno->listar_pedidos3($id,$lugar,$no_control_buscar);



						echo '	<thead>

								  <tr align="center" style="background: #EDF0F0;">
								  	<th colspan="4">
									  	
		                                

								  	</th>
								  	<th></th>
									
									<th colspan="2" style="background: #034343; color: white;">DIAS</th>
									
									<th></th>
									<th></th>
									
								  </tr>

	                              <tr align="center" style="background: #034343; color: white;">
	                                <th style="width:4%">Origen</th>
	                                <th style="width:9%">#Control</th>
	                                <th style="width:4%">#Pedido</th>
	                                
	                                <th style="width:20%">Cliente</th>	                                
	                                <th style="width:45%">Avance de tiempo</th>
	                                <th style="width:5%">Total</th>
	                                <th style="width:5%">Quedan</th>
	                                <th style="width:4%">Estatus</th> 
	                                <th style="width:4%"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></th>
	                                	                              
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

						
						
						if ($lugar=="Fabrica" || $lugar=="Zuno") {
							 
							 $visib = "";
						}elseif ($lugar<>"Fabrica" && $lugar<>"Zuno") {
							 
							 $visib = "disabled";
						}

						echo '

								
								
									 <tr>
									
										<td align="center">'.$reg->lugar.'</td>
										<td align="center">'.$reg->no_control.'</td>
						                <td align="center">'.$reg->no_pedido.'</td>
		                               	
		                                
		                                <td>'.$reg->nom_cliente.'</td>
		                                
		                                <td>
		                                	  
		                                      <p align="left">Pedido: '.$reg->fecha_pedido.'</p>
		                                	  <div class="progress">
		                                	  	  
				                                  
				                                  
					                              <div class="progress-bar" role="progressbar" style="width: '.$porc_avance.'%; background: '.$color_barra.';" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
					                          </div>  
					                          <p align="right">Entrega: '.$reg->fecha_entrega.'</p>
					                          <h6 id="color_barra_s'.$reg->idpg_pedidos.'" style="visibility: hidden;">'.$color_barra.'</h6>
		                                </td>
		                                <td align="center">
		                                	  <h5>'.$dias_totales.'</h5>
		                                </td>
		                                <td align="center">
		                                	  <h5 id="dias_restantes'.$reg->idpg_pedidos.'">'.$dias_faltantes.'</h5>

		                                </td>
		                               	<td align="center">
		                                	  '.$reg->estatus.'
		                                	  <h5 style="background: #'.$color_status.'; color: #'.$color_status.';">__</h5>
		                                </td>
		                                
						                
						                <td align="center">
						                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
						                	<span class="glyphicon glyphicon-th" aria-hidden="true"></span>
						                	<span class="badge" style="background: red; color: white;">'.$dias_noti.'</span>
						                	</a>
							                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							                        	<a href="sale_product.php?pedido='.$reg->idpg_pedidos.'">
							                            	<button type="button" class="btn btn-primary">
											                
											                <span class="glyphicon glyphicon-new-window" aria-hidden="true" style="color: white;"></span>
												                
												            </button>
											            </a>
							                            <button style="background: #ADF7CC;" type="button" class="btn btn-round " onclick="abrir_seg_ped('.$reg->idpg_pedidos.',\''.$porc_avance.'\');" '.$visib.'><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
							                            </button>
							                            <button style="background: #ADE0F7;" type="button" class="btn btn-round " onclick="abrir_docs('.$reg->idpg_pedidos.');">
							                            	<span class="badge" style="background: red; color:white;">'.$dias_noti.'</span>
							                            	<span class="glyphicon glyphicon-file" aria-hidden="true"></span><span class="glyphicon-class"></span>
							                            </button>

							                            
							                            
							                         </div>

						                </td>
						                
	                               		
		                             </tr>

		                            
		                            

	                            

						';

					
						
					}

						echo '</tbody>
							  

						';
			
		break;


		case 'listar_pedidos3_2':
			
			$id=$_GET['id'];
			//$num=$_GET['num'];
			//$marca=$_GET['marca'];
			$lugar=$_GET['lugar'];
			$cliente_buscar=$_GET['cliente_buscar'];

			$rspta = $diseno->listar_pedidos3_2($id,$lugar,$cliente_buscar);



						echo '	<thead>

								  <tr align="center" style="background: #EDF0F0;">
								  	<th colspan="4">
									  	
		                                

								  	</th>
								  	<th></th>
									
									<th colspan="2" style="background: #034343; color: white;">DIAS</th>
									
									<th></th>
									<th></th>
									
								  </tr>

	                              <tr align="center" style="background: #034343; color: white;">
	                                <th style="width:4%">Origen</th>
	                                <th style="width:9%">#Control</th>
	                                <th style="width:4%">#Pedido</th>
	                                
	                                <th style="width:20%">Cliente</th>	                                
	                                <th style="width:45%">Avance de tiempo</th>
	                                <th style="width:5%">Total</th>
	                                <th style="width:5%">Quedan</th>
	                                <th style="width:4%">Estatus</th> 
	                                <th style="width:4%"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></th>
	                                	                              
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

						
						
						if ($lugar=="Fabrica" || $lugar=="Zuno") {
							 
							 $visib = "";
						}elseif ($lugar<>"Fabrica" && $lugar<>"Zuno") {
							 
							 $visib = "disabled";
						}

						echo '

								
								
									 <tr>
									
										<td align="center">'.$reg->lugar.'</td>
										<td align="center">'.$reg->no_control.'</td>
						                <td align="center">'.$reg->no_pedido.'</td>
		                               	
		                                
		                                <td>'.$reg->nom_cliente.'</td>
		                                
		                                <td>
		                                	  
		                                      <p align="left">Pedido: '.$reg->fecha_pedido.'</p>
		                                	  <div class="progress">
		                                	  	  
				                                  
				                                  
					                              <div class="progress-bar" role="progressbar" style="width: '.$porc_avance.'%; background: '.$color_barra.';" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
					                          </div>  
					                          <p align="right">Entrega: '.$reg->fecha_entrega.'</p>
					                          <h6 id="color_barra_s'.$reg->idpg_pedidos.'" style="visibility: hidden;">'.$color_barra.'</h6>
		                                </td>
		                                <td align="center">
		                                	  <h5>'.$dias_totales.'</h5>
		                                </td>
		                                <td align="center">
		                                	  <h5 id="dias_restantes'.$reg->idpg_pedidos.'">'.$dias_faltantes.'</h5>

		                                </td>
		                               	<td align="center">
		                                	  '.$reg->estatus.'
		                                	  <h5 style="background: #'.$color_status.'; color: #'.$color_status.';">__</h5>
		                                </td>
		                                
						                
						                <td align="center">
						                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
						                	<span class="glyphicon glyphicon-th" aria-hidden="true"></span>
						                	<span class="badge" style="background: red; color: white;">'.$dias_noti.'</span>
						                	</a>
							                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							                        	<a href="sale_product.php?pedido='.$reg->idpg_pedidos.'">
							                            	<button type="button" class="btn btn-primary">
											                
											                <span class="glyphicon glyphicon-new-window" aria-hidden="true" style="color: white;"></span>
												                
												            </button>
											            </a>
							                            <button style="background: #ADF7CC;" type="button" class="btn btn-round " onclick="abrir_seg_ped('.$reg->idpg_pedidos.',\''.$porc_avance.'\');" '.$visib.'><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
							                            </button>
							                            <button style="background: #ADE0F7;" type="button" class="btn btn-round " onclick="abrir_docs('.$reg->idpg_pedidos.');">
							                            	<span class="badge" style="background: red; color:white;">'.$dias_noti.'</span>
							                            	<span class="glyphicon glyphicon-file" aria-hidden="true"></span><span class="glyphicon-class"></span>
							                            </button>

							                            
							                            
							                         </div>

						                </td>
						                
	                               		
		                             </tr>

		                            
		                            

	                            

						';

					
						
					}

						echo '</tbody>
							  

						';
			
		break;


		case 'listar_pedidos4':

			$id=$_GET['id'];
			//$num=$_GET['num'];
			//$marca=$_GET['marca'];
			$lugar=$_GET['lugar'];
			$no_control_buscar=$_GET['no_control_buscar'];
			

			$rspta = $diseno->listar_pedidos4($id,$lugar,$no_control_buscar);

			//$total=0;
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

					
						if ($lugar=="Fabrica" || $lugar=="Zuno") {
							 
							 $visib = "";
						}elseif ($lugar<>"Fabrica" && $lugar<>"Zuno") {
							 
							 $visib = "disabled";
						}

										echo '

											
								              <div class="col-md-12 col-sm-12">
								                <div class="x_panel">
								                  <div class="x_title">

								                  		<div class="form-group col-md-6 col-sm-6">
								                  			<strong><h2>Control: '.$reg->no_control.'</h2></strong>
								                  		</div>

								                  		<div class="form-group col-md-6 col-sm-6" align="right">
								                  			<h6>Origen: '.$reg->lugar.'</h6>
								                  			<h6>Pedido: '.$reg->no_pedido.'</h6>
								                  			<h6>Cliente: '.$reg->nom_cliente.'</h6>
								                  		</div>
								                  		

								                  		
								                  		
								                  		<div class="form-group col-md-6 col-sm-12">
								                  			
								                  			  <p align="left">Pedido: '.$reg->fecha_pedido.'</p>
						                                	  <div class="progress">
						                                	  	  
								                                  
								                                  
									                              <div class="progress-bar" role="progressbar" style="width: '.$porc_avance.'%; background: '.$color_barra.';" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
									                          </div>  
									                          <p align="right">Entrega: '.$reg->fecha_entrega.'</p>
									                          <h6 id="color_barra_s'.$reg->idpg_pedidos.'" style="visibility: hidden;">'.$color_barra.'</h6>
								                  			
								                  			
								                  		</div>
								                  		<div class="form-group col-md-6 col-sm-12">
								                  			'.$reg->estatus.'
								                  			<label>_</label>
		                                	  				<h5 style="background: #'.$color_status.'; color: #'.$color_status.';">__</h5>

								                  		</div>
								                  		


								                  		<div class="form-group col-md-12 col-sm-12">
								                  			
								                  			Productos
								                  			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
										                	
										                	</a>
								                  			

								                  			<button type="button" class="btn btn-round btn-info" style="background: white;" onclick="llenar_box_prod('.$reg->idpg_pedidos.');"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></button>
								                  						<a href="sale_product.php?pedido='.$reg->idpg_pedidos.'">
											                            	<button type="button" class="btn btn-primary">
															                
															                <span class="glyphicon glyphicon-new-window" aria-hidden="true" style="color: white;"></span>
																                
																            </button>
															            </a>
											                            <button style="background: #ADF7CC;" type="button" class="btn btn-round " onclick="abrir_seg_ped('.$reg->idpg_pedidos.',\''.$porc_avance.'\');" '.$visib.'><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
											                            </button>
											                            <button style="background: #ADE0F7;" type="button" class="btn btn-round " onclick="abrir_docs('.$reg->idpg_pedidos.');">
											                            	<span class="badge" style="background: red; color:white;">'.$dias_noti.'</span>
											                            	<span class="glyphicon glyphicon-file" aria-hidden="true"></span><span class="glyphicon-class"></span>
											                            </button>
								                  			
								                  		</div>
								                  		

								                  		<div class="form-group col-md-12 col-sm-12">
								                  			
								                  		

                         									

                         									 <table id="tbl_prod_ped_box'.$reg->idpg_pedidos.'" class="table table-hover">
                                            
                                          					 </table>

                         									 

								                  		</div>

								                  		
								                  		

								                  		

								                  		

									                        
								                       
								                        
								                    <div class="clearfix"></div>
								                  </div>
								                  <div class="x_content" style="visibility: visible;">

								                  		
								                  </div>

								                </div>
								              </div>
								            


										';
							
										
						
					}

						
		break;


		case 'listar_pedidos4_2':

			$id=$_GET['id'];
			//$num=$_GET['num'];
			//$marca=$_GET['marca'];
			$lugar=$_GET['lugar'];
			$cliente_buscar=$_GET['cliente_buscar'];
			

			$rspta = $diseno->listar_pedidos4_2($id,$lugar,$cliente_buscar);

			//$total=0;
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

					
						if ($lugar=="Fabrica" || $lugar=="Zuno") {
							 
							 $visib = "";
						}elseif ($lugar<>"Fabrica" && $lugar<>"Zuno") {
							 
							 $visib = "disabled";
						}

										echo '

											
								              <div class="col-md-12 col-sm-12">
								                <div class="x_panel">
								                  <div class="x_title">

								                  		<div class="form-group col-md-6 col-sm-6">
								                  			<strong><h2>Control: '.$reg->no_control.'</h2></strong>
								                  		</div>

								                  		<div class="form-group col-md-6 col-sm-6" align="right">
								                  			<h6>Origen: '.$reg->lugar.'</h6>
								                  			<h6>Pedido: '.$reg->no_pedido.'</h6>
								                  			<h6>Cliente: '.$reg->nom_cliente.'</h6>
								                  		</div>
								                  		

								                  		
								                  		
								                  		<div class="form-group col-md-6 col-sm-12">
								                  			
								                  			  <p align="left">Pedido: '.$reg->fecha_pedido.'</p>
						                                	  <div class="progress">
						                                	  	  
								                                  
								                                  
									                              <div class="progress-bar" role="progressbar" style="width: '.$porc_avance.'%; background: '.$color_barra.';" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
									                          </div>  
									                          <p align="right">Entrega: '.$reg->fecha_entrega.'</p>
									                          <h6 id="color_barra_s'.$reg->idpg_pedidos.'" style="visibility: hidden;">'.$color_barra.'</h6>
								                  			
								                  			
								                  		</div>
								                  		<div class="form-group col-md-6 col-sm-12">
								                  			'.$reg->estatus.'
								                  			<label>_</label>
		                                	  				<h5 style="background: #'.$color_status.'; color: #'.$color_status.';">__</h5>

								                  		</div>
								                  		


								                  		<div class="form-group col-md-12 col-sm-12">
								                  			
								                  			Productos
								                  			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
										                	
										                	</a>
								                  			

								                  			<button type="button" class="btn btn-round btn-info" style="background: white;" onclick="llenar_box_prod('.$reg->idpg_pedidos.');"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></button>
								                  						<a href="sale_product.php?pedido='.$reg->idpg_pedidos.'">
											                            	<button type="button" class="btn btn-primary">
															                
															                <span class="glyphicon glyphicon-new-window" aria-hidden="true" style="color: white;"></span>
																                
																            </button>
															            </a>
											                            <button style="background: #ADF7CC;" type="button" class="btn btn-round " onclick="abrir_seg_ped('.$reg->idpg_pedidos.',\''.$porc_avance.'\');" '.$visib.'><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
											                            </button>
											                            <button style="background: #ADE0F7;" type="button" class="btn btn-round " onclick="abrir_docs('.$reg->idpg_pedidos.');">
											                            	<span class="badge" style="background: red; color:white;">'.$dias_noti.'</span>
											                            	<span class="glyphicon glyphicon-file" aria-hidden="true"></span><span class="glyphicon-class"></span>
											                            </button>
								                  			
								                  		</div>
								                  		

								                  		<div class="form-group col-md-12 col-sm-12">
								                  			
								                  		

                         									

                         									 <table id="tbl_prod_ped_box'.$reg->idpg_pedidos.'" class="table table-hover">
                                            
                                          					 </table>

                         									 

								                  		</div>

								                  		
								                  		

								                  		

								                  		

									                        
								                       
								                        
								                    <div class="clearfix"></div>
								                  </div>
								                  <div class="x_content" style="visibility: visible;">

								                  		
								                  </div>

								                </div>
								              </div>
								            


										';
							
										
						
					}

						
		break;


		/*case 'listar_pedidos3':

			$id=$_GET['id'];
			$num=$_GET['num'];
			$marca=$_GET['marca'];
			$lugar=$_GET['lugar'];
			

			$rspta = $diseno->listar_pedidos2($id,$num,$marca,$lugar);

			//$total=0;
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

					
						if ($lugar=="Fabrica" || $lugar=="Zuno") {
							 
							 $visib = "";
						}elseif ($lugar<>"Fabrica" && $lugar<>"Zuno") {
							 
							 $visib = "disabled";
						}

										echo '

											
								              <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
							                      <div class="panel">
							                        <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1'.$reg->idpg_pedidos.'" aria-expanded="true" aria-controls="collapseOne" onclick="llenar_productos_det('.$reg->idpg_pedidos.');">

							                        		<div class="form-group col-md-2 col-sm-2">
							                        			  <h1 class="panel-title">C: #'.$reg->no_control.'</h1>
							                        			  '.$reg->estatus.'
							                                	  <h5 style="background: #'.$color_status.'; color: #'.$color_status.';">__</h5>
							                        		</div>

							                        		

							                        		<div class="form-group col-md-3 col-sm-2">
							                        			
							                        			
							                        			<h4>Origen: '.$reg->lugar.'</h4>
							                        			<h4>Pedido: #'.$reg->no_pedido.'</h4>
							                        			<h4>Cliente: '.$reg->nom_cliente.'</h4>
							                        		</div>
							                        		
							                        		
							                        		<div class="form-group col-md-3 col-sm-2">
							                                	  <h4>Total de dias: '.$dias_totales.'</h4>
							                                	  <h4 id="dias_restantes'.$reg->idpg_pedidos.'">Días restantes:'.$dias_faltantes.'</h4>
							                                	  
							                                </div>
							                              
							                        		 
								                  		  	<h4>Pedido: '.$reg->fecha_pedido.'</h4>
								                  		  	<h4>Entrega: '.$reg->fecha_entrega.'</h4>

							                        	
									                         <h6 id="color_barra_s'.$reg->idpg_pedidos.'" style="visibility: hidden;">'.$color_barra.'</h6>
									                        <div class="progress">          
											                    <div class="progress-bar" role="progressbar" style="width: '.$porc_avance.'%; background: '.$color_barra.';" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
											                </div>
											                


							                        		

							                        </a>
							                        <div id="collapseOne1'.$reg->idpg_pedidos.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							                          <div class="panel-body">
							                            <table class="table table-striped" id="tbl_productos2'.$reg->idpg_pedidos.'">
							                              
							                            </table>
							                          </div>
							                        </div>
							                      </div>
							                      
							                      
							                    </div>
								            


										';
							
										
						
					}

						
		break;*/

		


		case 'tbl_productos':
			$rspta = $diseno->tbl_productos();
						echo '<thead>
                                <tr>
                                  <th>Codigo</th>
                                  <th>Nombre</th>
                                  <th>Medida</th>
                                  
                                  <th>Precio</th>
                                  <th>Seleccionar</th>
                                </tr>
                              </thead>
                              <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
                                  <td>'.$reg->codigo.'</td>
                                  <td>'.$reg->nombre.'</td>
                                  <td>'.$reg->medida.'</td>
                                  
                                  <td>'.$reg->precio_total.'</td>
                                  <td><button type="button" class="btn btn-round btn-dark" onclick="agregar_prod_ped('.$reg->idproducto.',\''.$reg->precio_total.'\');">Seleccionar</button></td> 
                                </tr>
						';	
					}
						echo '</tbody>';
			
		break;

		case 'tbl_productos2':
			$rspta = $diseno->tbl_productos();
						echo '<thead>
                                <tr>
                                  <th>Codigo</th>
                                  <th>Nombre</th>
                                  <th>Medida</th>
                                  
                                  
                                  <th>Seleccionar</th>
                                </tr>
                              </thead>
                              <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
                                  <td>'.$reg->codigo.'</td>
                                  <td>'.$reg->nombre.'</td>
                                  <td>'.$reg->medida.'</td>
                                  
                                  
                                  <td><button type="button" class="btn btn-round btn-dark" onclick="agregar_prod_ped('.$reg->idproducto.',\''.$reg->precio_total.'\');">Seleccionar</button></td> 
                                </tr>
						';	
					}
						echo '</tbody>';
			
		break;


		case 'buscar_texto_tbl_prod':

			$id=$_GET['id'];

			$rspta = $diseno->buscar_texto_tbl_prod($id);
						echo '<thead>
                                <tr>
                                  <th>Codigo</th>
                                  <th>Nombre</th>
                                  <th>Medida</th>
                                  
                                  <th>Precio</th>
                                  <th>Seleccionar</th>
                                </tr>
                              </thead>
                              <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
                                  <td>'.$reg->codigo.'</td>
                                  <td>'.$reg->nombre.'</td>
                                  <td>'.$reg->medida.'</td>
                                  
                                  <td>'.$reg->precio_total.'</td>
                                  <td><button type="button" class="btn btn-round btn-danger" onclick="agregar_prod_ped('.$reg->idproducto.',\''.$reg->precio_total.'\');">Seleccionar</button></td> 
                                </tr>
						';	
					}
						echo '</tbody>';
			
		break;

		case 'buscar_prod_exist':
			//Recibimos el idingreso
			/*$num_cli = $_POST['num_cli'];
			$nom_cli = $_POST['nom_cli'];*/

			$id=$_GET['id'];
			//$id2=$_GET['id2'];

			$rspta = $diseno->buscar_prod_exist($id);
			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<p>'.$reg->codigo.' -  '.$reg->nombre.'</p>	
						';
						
					}
			
		break;

		case 'consul_exist_prod':
			
			$codigo_new_prod = $_POST['codigo_new_prod'];
										
			$rspta=$diseno->consul_exist_prod($codigo_new_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'save_prod':
			
			$tipo_prod = $_POST['tipo_prod'];
			$codigo_new_prod = $_POST['codigo_new_prod'];
			$nombre_new_prod = $_POST['nombre_new_prod'];
			$color_new_prod = $_POST['color_new_prod'];
			$medida_new_prod = $_POST['medida_new_prod'];
			$precio_new_prod = $_POST['precio_new_prod'];
			
										
			$rspta=$diseno->save_prod($tipo_prod,$codigo_new_prod,$nombre_new_prod,$color_new_prod,$medida_new_prod,$precio_new_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'num_entregas':
			
			$id_ped_temp = $_POST['id_ped_temp'];
										
			$rspta=$diseno->num_entregas($id_ped_temp);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_productos_pedido':

			$id=$_GET['id'];

			$rspta = $diseno->listar_productos_pedido($id);
						echo '<thead>
                                <tr>
                                  <th>Codigo</th>
                                  <th>Nombre</th>
                                  <th>Cantidad</th>
                                  <th>En entrega</th>
                                  <th>Entregados</th>
                                 
                                  
                                </tr>
                              </thead>
                              <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
								  
                                  <td>'.$reg->codigo.'</td>
                                  <td>'.$reg->nombre.'</td>
                                  <td>'.$reg->cantidad.'</td>
                                  
                                  <td>'.$reg->entregados.'</td>
                                  <td>'.$reg->entregados2.'</td>
                                  
						';	
					}
						echo '</tbody>';
			
		break;

		case 'listar_entregas':

			$id=$_GET['id'];

			$rspta = $diseno->listar_entregas($id);
						echo '<thead>
                                <tr>
                                  <th>Opciones</th>
                                  <th>No. Pedido</th>
                                  <th>No. Salida</th>
                                  <th>Fecha de entrega</th>
                                  <th>Nombre</th>
                                  <th>Dirección de entrega</th>
                                  <th>Estatus</th>
                                  
                                </tr>
                              </thead>
                              <tbody>';
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->estatus==1) {
							$estatus2="En entrega";
						}

						echo '
								<tr>
								  <td>
								  <button type="button" class="btn btn-round btn-primary" onclick="detalle_entrega('.$reg->identregas.');">Ver</button>
								  <button type="button" class="btn btn-round btn-danger" onclick="borrar_entrega('.$reg->identregas.');">x</button>
								  </td> 
                                  <td>'.$reg->no_pedido.'</td>
                                  <td>'.$reg->no_salida.'</td>
                                  <td>'.$reg->fecha.'</td>
                                  
                                  <td>'.$reg->nombre.'</td>
                                  <td>'.$reg->dom.' '.$reg->col.', '.$reg->mun.'</td>
                                  <td>'.$estatus2.'</td>
                                  
                                </tr>
						';	
					}
						echo '</tbody>';
			
		break;

		case 'consul_idcliente':
			
			$id_ped_temp = $_POST['id_ped_temp'];
										
			$rspta=$diseno->consul_idcliente($id_ped_temp);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_dir_ent':
			
			$iddir_entrega = $_POST['iddir_entrega'];
										
			$rspta=$diseno->consul_dir_ent($iddir_entrega);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;



		
		case 'consul_cliente':
			
			$idcliente = $_POST['idcliente'];
										
			$rspta=$diseno->consul_cliente($idcliente);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'reg_entrega':

			$id_ped_temp = $_POST['id_ped_temp'];
												
			$rspta=$diseno->reg_entrega($id_ped_temp);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_prod_entregas':

			$id=$_GET['id'];

			$rspta = $diseno->listar_prod_entregas($id);
						echo '<thead>
                                <tr>
                                  
                                  <th>Codigo</th>
                                  <th>Nombre</th>
                                  
                                  <th>Cantidad</th>
                                  <th>En entrega</th>
                                  <th>Opciones</th>
                                </tr>
                              </thead>
                              <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
								  
                                  <td>'.$reg->codigo.'</td>
                                  <td>'.$reg->nombre.'</td>
                                     
                                  <td>'.$reg->cantidad.'</td>
                                  <td>'.$reg->entregados.'</td>
                                  <td><button type="button" class="btn btn-round btn-danger" onclick="guardar_prod_entrega('.$reg->idpg_detalle_pedidos.');">Seleccionar</button>


                                  </td> 
                                </tr>
						';	
					}
						echo '</tbody>';
			
		break;

		case 'consul_det_ped':

			//$identregas = $_POST['identregas'];
			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			//$cantidad = $_POST['cantidad'];
												
			$rspta=$diseno->consul_det_ped($idpg_detalle_pedidos);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_exist_ent_p':

			$identregas = $_POST['identregas'];
			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
		
												
			$rspta=$diseno->consul_exist_ent_p($identregas,$idpg_detalle_pedidos);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'pasar_prod':

			$identregas = $_POST['identregas'];
			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			$cantidad = $_POST['cantidad'];
			$codigo = $_POST['codigo'];
			$nombre = $_POST['nombre'];
												
			$rspta=$diseno->pasar_prod($identregas,$idpg_detalle_pedidos,$cantidad,$codigo,$nombre);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		
		case 'listar_prod_entr':

			$id=$_GET['id'];

			$rspta = $diseno->listar_prod_entr($id);
						echo '<thead>
                                <tr>
                                  
                                  <th>Cantidad</th>
                                  <th>Codigo</th>
                                  <th>Nombre</th>
                                  <th>Lote</th>

                                </tr>
                              </thead>
                              <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
								  <td>'.$reg->cantidad.'</td>
                                  <td>'.$reg->codigo.'</td>
                                  <td>'.$reg->nombre.'</td>
                                  <td>'.$reg->lote.'</td>
                                  
                                </tr>
						';	
					}
						echo '</tbody>';
			
		break;

		case 'listar_prod_entr2':

			$id=$_GET['id'];

			$rspta = $diseno->listar_prod_entr($id);
						echo '<thead>
                                <tr>
                                  <th>Opciones</th>
                                  <th>Cantidad</th>
                                  <th>Codigo</th>
                                  <th>Nombre</th>
                                  <th>Lote</th>

                                </tr>
                              </thead>
                              <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
								  <td>
								 
								  <button type="button" class="btn btn-round btn-danger" onclick="borrar_detalle_ent('.$reg->identregas_detalle.',\''.$reg->iddetalle_pedido.'\',\''.$reg->estatus.'\');">x</button>
								  </td>
								  <td><input type="text" class="form-control" id="cant_prod_ent'.$reg->identregas_detalle.'" value="'.$reg->cantidad.'" onkeyup="upd_cant_prod_ent('.$reg->identregas_detalle.');"></td>
                                  <td>'.$reg->codigo.'</td>
                                  <td>'.$reg->nombre.'</td>
                                  <td><input type="text" class="form-control" id="lote_prod_ent'.$reg->identregas_detalle.'" value="'.$reg->lote.'" onkeyup="upd_lote_prod_ent('.$reg->identregas_detalle.');"></td>
                                  
                                </tr>
						';	
					}
						echo '</tbody>';
			
		break;

		case 'upd_cant_prod_ent':

			$identregas_detalle = $_POST['identregas_detalle'];
			$cantidad = $_POST['cantidad'];
			
												
			$rspta=$diseno->upd_cant_prod_ent($identregas_detalle,$cantidad);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'upd_lote_prod_ent':

			$identregas_detalle = $_POST['identregas_detalle'];
			$lote = $_POST['lote'];
			
												
			$rspta=$diseno->upd_lote_prod_ent($identregas_detalle,$lote);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'save_entrega':

			$identregas = $_POST['identregas'];
			$fecha_sal = $_POST['fecha_sal'];
			$no_salida_sal = $_POST['no_salida_sal'];
			$no_control_sal = $_POST['no_control_sal'];
			$no_pedido_sal = $_POST['no_pedido_sal'];
			$nombre_sal = $_POST['nombre_sal'];
			$entregado_a_sal = $_POST['entregado_a_sal'];
			$domicilio_sal = $_POST['domicilio_sal'];
			$colonia_sal = $_POST['colonia_sal'];
			$municipio_sal = $_POST['municipio_sal'];
			$estado_sal = $_POST['estado_sal'];
			$cp_sal = $_POST['cp_sal'];
			$contacto_sal = $_POST['contacto_sal'];
			$telefono_sal = $_POST['telefono_sal'];
			$horario_sal = $_POST['horario_sal'];
			$condiciones_sal = $_POST['condiciones_sal'];
			$medio_sal = $_POST['medio_sal'];
			
												
			$rspta=$diseno->save_entrega($identregas,$fecha_sal,$no_salida_sal,$no_control_sal,$no_pedido_sal,$nombre_sal,$entregado_a_sal,$domicilio_sal,$colonia_sal,$municipio_sal,$estado_sal,$cp_sal,$contacto_sal,$telefono_sal,$horario_sal,$condiciones_sal,$medio_sal);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'update_estatus_entrega':

			$identregas = $_POST['identregas'];
			
												
			$rspta=$diseno->update_estatus_entrega($identregas);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'ini_id_ent':

			$identregas = $_POST['identregas'];
			
												
			$rspta=$diseno->ini_id_ent($identregas);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'fin_id_ent':

			$identregas = $_POST['identregas'];
			
												
			$rspta=$diseno->fin_id_ent($identregas);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'upd_ped_temp_ent1':

			//$identregas_ini = $_POST['identregas_ini'];
			//$identregas_fin = $_POST['identregas_fin'];
			$identregas = $_POST['identregas'];
			$det_ped_ini = $_POST['det_ped_ini'];
			$det_ped_fin = $_POST['det_ped_fin'];
			
												
			$rspta=$diseno->upd_ped_temp_ent1($identregas,$det_ped_ini,$det_ped_fin);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'detalle_entrega_ped':

			$identregas = $_POST['identregas'];
														
			$rspta=$diseno->detalle_entrega_ped($identregas);
			echo json_encode($rspta);

		break;


		case 'listar_det_entrega':

			$id=$_GET['id'];

			$rspta = $diseno->listar_det_entrega($id);
						echo '<thead>
                                <tr>
                                  
                                  
                                  <th>Codigo</th>
                                  <th>Nombre</th>
                                  <th>Cantidad</th>
                                  <th>Lote</th>

                                </tr>
                              </thead>
                              <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
								  <td>'.$reg->codigo.'</td>
								  <td>'.$reg->nombre.'</td>
								  <td>'.$reg->cantidad.'</td>
                                  
                                  <td>'.$reg->lote.'</td>
                                  
                                  
                                </tr>
						';	
					}
						echo '</tbody>';
			
		break;

		case 'resp_ped_temp_ent':

			//$identregas_ini = $_POST['identregas_ini'];
			//$identregas_fin = $_POST['identregas_fin'];
			$identregas = $_POST['identregas'];
			$det_ped_ini = $_POST['det_ped_ini'];
			$det_ped_fin = $_POST['det_ped_fin'];
			
												
			$rspta=$diseno->resp_ped_temp_ent($identregas,$det_ped_ini,$det_ped_fin);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'rest_ped_temp_ent':

			//$identregas_ini = $_POST['identregas_ini'];
			//$identregas_fin = $_POST['identregas_fin'];
			$identregas = $_POST['identregas'];
			$det_ped_ini = $_POST['det_ped_ini'];
			$det_ped_fin = $_POST['det_ped_fin'];
			
												
			$rspta=$diseno->rest_ped_temp_ent($identregas,$det_ped_ini,$det_ped_fin);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'upd_ped_temp_ent2':

			//$identregas_ini = $_POST['identregas_ini'];
			//$identregas_fin = $_POST['identregas_fin'];
			$identregas = $_POST['identregas'];
			$det_ped_ini = $_POST['det_ped_ini'];
			$det_ped_fin = $_POST['det_ped_fin'];
			
												
			$rspta=$diseno->upd_ped_temp_ent2($identregas,$det_ped_ini,$det_ped_fin);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'upd_entrega':

			$identregas = $_POST['identregas'];
			$fecha_sal = $_POST['fecha_sal'];
			$no_salida_sal = $_POST['no_salida_sal'];
			$no_control_sal = $_POST['no_control_sal'];
			$no_pedido_sal = $_POST['no_pedido_sal'];
			$nombre_sal = $_POST['nombre_sal'];
			$entregado_a_sal = $_POST['entregado_a_sal'];
			$domicilio_sal = $_POST['domicilio_sal'];
			$colonia_sal = $_POST['colonia_sal'];
			$municipio_sal = $_POST['municipio_sal'];
			$estado_sal = $_POST['estado_sal'];
			$cp_sal = $_POST['cp_sal'];
			$contacto_sal = $_POST['contacto_sal'];
			$telefono_sal = $_POST['telefono_sal'];
			$horario_sal = $_POST['horario_sal'];
			$condiciones_sal = $_POST['condiciones_sal'];
			$medio_sal = $_POST['medio_sal'];
			
												
			$rspta=$diseno->upd_entrega($identregas,$fecha_sal,$no_salida_sal,$no_control_sal,$no_pedido_sal,$nombre_sal,$entregado_a_sal,$domicilio_sal,$colonia_sal,$municipio_sal,$estado_sal,$cp_sal,$contacto_sal,$telefono_sal,$horario_sal,$condiciones_sal,$medio_sal);
			echo json_encode($rspta);
			
		break;


		case 'borrar_entrega':


			$identregas = $_POST['identregas'];			
												
			$rspta=$diseno->borrar_entrega($identregas);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'restar_cant_ped':

			//$identregas_ini = $_POST['identregas_ini'];
			//$identregas_fin = $_POST['identregas_fin'];
			$identregas = $_POST['identregas'];
			$det_ped_ini = $_POST['det_ped_ini'];
			$det_ped_fin = $_POST['det_ped_fin'];
			
												
			$rspta=$diseno->restar_cant_ped($identregas,$det_ped_ini,$det_ped_fin);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		

		case 'borrar_detalle_ent':


			$identregas_detalle = $_POST['identregas_detalle'];			
												
			$rspta=$diseno->borrar_detalle_ent($identregas_detalle);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'restar_cantidad_ped_det':


			$identregas_detalle = $_POST['identregas_detalle'];	
			$iddetalle_pedido = $_POST['iddetalle_pedido'];	

												
			$rspta=$diseno->restar_cantidad_ped_det($identregas_detalle,$iddetalle_pedido);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		
		case 'abrir_seg_ped':

			$id=$_GET['id'];

			$rspta = $diseno->abrir_seg_ped($id);
						echo '<thead>
                                <tr>
                                  
                                  <th style="width: 15%;">Fecha</th>
                                  <th style="width: 70%;">Comentario</th>
                                  <th style="width: 15%;">Color</th>
                                  
                                  

                                </tr>
                              </thead>
                              <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
								  <td>'.$reg->fecha.'</td>
								  <td>'.$reg->comentario.'</td>
								  <td style="background: #'.$reg->color.'"></td>
								  
                                  
                                </tr>
						';	
					}
						echo '</tbody>';
			
		break;

		case 'guardar_coment_ped':


			$coment = $_POST['coment'];	
			$color = $_POST['color'];
			$estatus = $_POST['estatus'];
			$idpedido = $_POST['idpedido'];
			$fecha = $_POST['fecha'];
			$color_barra_s = $_POST['color_barra_s'];
			$porc_av_p = $_POST['porc_av_p'];
			$dias_restantes = $_POST['dias_restantes'];
			$idusuario = $_POST['idusuario'];
			$num_pedido = $_POST['num_pedido'];

												
			$rspta=$diseno->guardar_coment_ped($coment,$color,$idpedido,$fecha,$estatus,$color_barra_s,$porc_av_p,$dias_restantes,$idusuario,$num_pedido);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'abrir_doc_ped':

			$id=$_GET['id'];

			$rspta = $diseno->abrir_doc_ped($id);
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


		case 'guardar_comprobante':

			$idpedido_doc = $_POST['idpedido_doc'];
			$ar_coment = $_FILES["ar_comprob"];			
			$nom=$_FILES['ar_comprob']['name'];
			$ruta_anterior=$_FILES['ar_comprob']['tmp_name'];
			
			$ruta_idop="../files/".$idpedido_doc;

			if (!file_exists($ruta_idop)) {
			    mkdir($ruta_idop, 0755, true);
			}

			$ruta="../files/".$idpedido_doc."/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);
			$rspta=$diseno->guardar_comprobante($nom,$idpedido_doc);
	 		echo json_encode($rspta);
		break;

		case 'set_fecha_hora_entr':


			$id_ped_temp = $_POST['id_ped_temp'];	
			$fecha_entrega_upd2 = $_POST['fecha_entrega_upd2'];
			$hora_entrega_upd2 = $_POST['hora_entrega_upd2'];
			$hora_entrega_upd2_2 = $_POST['hora_entrega_upd2_2'];
			$fecha_hora = $_POST['fecha_hora'];
			$idusuario = $_POST['idusuario'];
															
			$rspta=$diseno->set_fecha_hora_entr($id_ped_temp,$fecha_entrega_upd2,$hora_entrega_upd2,$hora_entrega_upd2_2,$fecha_hora,$idusuario);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'upd_salida_ped':


			$id_ped_temp = $_POST['id_ped_temp'];	
			$no_salida_sal = $_POST['no_salida_sal'];
			
															
			$rspta=$diseno->upd_salida_ped($id_ped_temp,$no_salida_sal);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'cargar_modelo':
			$id=$_GET['id'];

			$rspta = $diseno->cargar_modelo($id);

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						if ($id=="SSCONA") {

										echo '

											<div class="sketchfab-embed-wrapper">
                                                <iframe title="A 3D model" width="640" height="480" src="https://sketchfab.com/models/4b06f78da1bf41b6ae2e029fc1221c65/embed?autostart=1&amp;preload=1&amp;ui_controls=1&amp;ui_infos=1&amp;ui_inspector=1&amp;ui_stop=1&amp;ui_watermark=1&amp;ui_watermark_link=1" frameborder="0" allow="autoplay; fullscreen; vr" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
                                                <p style="font-size: 13px; font-weight: normal; margin: 5px; color: #4A4A4A;">
                                                    <a href="https://sketchfab.com/3d-models/silla-1-4b06f78da1bf41b6ae2e029fc1221c65?utm_medium=embed&utm_source=website&utm_campaign=share-popup" target="_blank" style="font-weight: bold; color: #1CAAD9;">silla 1</a>
                                                    by <a href="https://sketchfab.com/jesushdz64.jh?utm_medium=embed&utm_source=website&utm_campaign=share-popup" target="_blank" style="font-weight: bold; color: #1CAAD9;">jesushdz64.jh</a>
                                                    on <a href="https://sketchfab.com?utm_medium=embed&utm_source=website&utm_campaign=share-popup" target="_blank" style="font-weight: bold; color: #1CAAD9;">Sketchfab</a>
                                                </p>
                                            </div>	


										';
							
						}


						if ($id=="SMNEVE") {

										echo '

											<div class="sketchfab-embed-wrapper">
											    <iframe title="A 3D model" width="640" height="480" src="https://sketchfab.com/models/6f27d23da4704adea3419109028fda5a/embed?autostart=1&amp;preload=1&amp;ui_controls=1&amp;ui_infos=1&amp;ui_inspector=1&amp;ui_stop=1&amp;ui_watermark=1&amp;ui_watermark_link=1" frameborder="0" allow="autoplay; fullscreen; vr" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
											    <p style="font-size: 13px; font-weight: normal; margin: 5px; color: #4A4A4A;">
											        <a href="https://sketchfab.com/3d-models/silla-2-6f27d23da4704adea3419109028fda5a?utm_medium=embed&utm_source=website&utm_campaign=share-popup" target="_blank" style="font-weight: bold; color: #1CAAD9;">Silla 2</a>
											        by <a href="https://sketchfab.com/Jesus.A..Hernandez.Solis?utm_medium=embed&utm_source=website&utm_campaign=share-popup" target="_blank" style="font-weight: bold; color: #1CAAD9;">Jesus.A..Hernandez.Solis</a>
											        on <a href="https://sketchfab.com?utm_medium=embed&utm_source=website&utm_campaign=share-popup" target="_blank" style="font-weight: bold; color: #1CAAD9;">Sketchfab</a>
											    </p>
											</div>



										';
							
						}


						if ($id=="SSPGRO") {

										echo '

											<div class="sketchfab-embed-wrapper">
											    <iframe title="A 3D model" width="640" height="480" src="https://sketchfab.com/models/ef918a9f607640dcb04e3f6caccfa959/embed?autostart=1&amp;preload=1&amp;ui_controls=1&amp;ui_infos=1&amp;ui_inspector=1&amp;ui_stop=1&amp;ui_watermark=1&amp;ui_watermark_link=1" frameborder="0" allow="autoplay; fullscreen; vr" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
											    <p style="font-size: 13px; font-weight: normal; margin: 5px; color: #4A4A4A;">
											        <a href="https://sketchfab.com/3d-models/silla-3-ef918a9f607640dcb04e3f6caccfa959?utm_medium=embed&utm_source=website&utm_campaign=share-popup" target="_blank" style="font-weight: bold; color: #1CAAD9;">Silla 3</a>
											        by <a href="https://sketchfab.com/HERSO?utm_medium=embed&utm_source=website&utm_campaign=share-popup" target="_blank" style="font-weight: bold; color: #1CAAD9;">HERSO</a>
											        on <a href="https://sketchfab.com?utm_medium=embed&utm_source=website&utm_campaign=share-popup" target="_blank" style="font-weight: bold; color: #1CAAD9;">Sketchfab</a>
											    </p>
											</div>



										';
							
						}

										
						
					}

						
		break;

		case 'consul_lugar':


			$idusuario = $_POST['idusuario'];	
			
															
			$rspta=$diseno->consul_lugar($idusuario);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'upd_importes':

			$id_ped_temp = $_POST['id_ped_temp'];
			$subtotal = $_POST['subtotal_fixed'];
			$iva_fixed = $_POST['iva_fixed'];
			$total_fixed = $_POST['total_fixed'];

			$aplic_iva = $_POST['aplic_iva'];

			$rspta=$diseno->upd_importes($id_ped_temp,$subtotal,$iva_fixed,$total_fixed,$aplic_iva);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'ultimo_control':

			$rspta=$diseno->ultimo_control();
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'ultimo_pedido_lugar':

			$lugar = $_POST['lugar'];

			$rspta=$diseno->ultimo_pedido_lugar($lugar);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_op':

			$idpg_pedidos = $_POST['idpg_pedidos'];
			$num_op = $_POST['num_op'];

			$rspta=$diseno->guardar_op($idpg_pedidos,$num_op);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'llenar_box_prod':
			//Recibimos el idingreso
			//$id=$_GET['id'];
			$id=$_GET['id'];

			$rspta = $diseno->llenar_box_prod($id);



						echo '	<thead>
	                              <tr>
	                               	<th width="10%">Codigo</th>   
	                                <th width="15%">Nombre.</th>
	                                <th width="15%">Observ.</th>
	                                <th width="5%">Cant.</th>
	                                <th width="5%">Opciones</th>
	                                <th width="50%"></th>
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '

								<tr>
									<td>'.$reg->codigo.'</td>
	                                <td>'.$reg->nombre.'</td>
	                                <td>'.$reg->observacion.'</td>
	                                <td>'.$reg->cantidad.'</td>
	                                
	                                
	                                
	                                <td>
	                                	
	                                	<button type="button" class="btn btn-primary" onclick="mostrar_det_ped('.$reg->idpg_detalle_pedidos.');" id="">Ver</button>
	                                </td>
	                                <td>

	                                	<table id="tbl_detalle_prod_tbl'.$reg->idpg_detalle_pedidos.'" class="table table-hover">
                                            
                                        </table>

	                                </td>
	                                
	                             </tr>


						';
						
					}

						echo '</tbody>
							  

						';
			
		break;
		

		


		

		case 'guardar_estatus1':

			
			$idpg_detped = $_POST['idpg_detped'];
			$estatus = $_POST['estatus'];
			$fecha_hora = $_POST['fecha_hora'];
			$id_ped_temp = $_POST['id_ped_temp'];

			$rspta=$diseno->guardar_estatus1($idpg_detped,$estatus,$fecha_hora,$id_ped_temp);
	 		echo json_encode($rspta);
		break;

		
		
		

		

		case 'dividir_prod_ped':

			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];

			$rspta=$diseno->dividir_prod_ped($idpg_detalle_pedidos);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_pg_detped':
			//Recibimos el idingreso
			//$id=$_GET['id'];
			$id=$_GET['id'];

			$rspta = $diseno->listar_pg_detped($id);



						echo '	<thead>
	                              <tr>
	                               	
	                                
	                                <th>Cant.</th>
	                                <th>Observ.</th>
	                                <th>OP</th>
	                                <th>Estatus</th>
	                                <th><button type="button" class="btn btn-primary" onclick="dividir_prod_ped('.$id.');" id="">+</button></th>
	                                
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
						}


						if ($reg->observ_enlace<>"") {
							$observacion_prod = $reg->observ_enlace;
						}elseif ($reg->observacion<>"") {
							$observacion_prod = $reg->observacion;
						}

						echo '

								<tr>
									
	                              
	                                <td>

	                                		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
						                	<h6 id="">'.$reg->cantidad.'</h6>
						                	</a>
							                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">



							                        	<input type="number" class="form-control" id="cant_prod_seg'.$reg->idpg_detped.'" value="'.$reg->cantidad.'" onkeyup="guardar_cant_prod('.$reg->idpg_detped.');">
							                        	


							                            
							                         </div>


	                                </td>

	                                <td>



	                                		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
						                	<h6 id="">'.$observacion_prod.'</h6>
						                	</a>
							                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">



							                        	
							                        	
							                        	<textarea class="form-control" id="obs_prod_seg'.$reg->idpg_detped.'" cols="40" rows="5" onkeyup="guardar_observ_prod_enl('.$reg->idpg_detped.');">'.$observacion_prod.'</textarea>


							                         </div>


	                                </td>
	                                
	                                <td>'.$reg->op.'</td>
	                                
	                                
	                                <td>

	                                		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
						                	<h6 id="idestatus_prod_ped'.$reg->idpg_detped.'">'.$reg->estatus.'</h6>
						                	</a>
							                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">




							                        	<div class="col-md-2 col-sm-3">
			                                              <ul class="nav navbar-right panel_toolbox">
			                                                <li>
			                                                  <a class="btn btn-app" style="background: #F56630; color: black; border-radius: 10px;">                  
			                                                    <i class="fa fa-inbox" onclick="guardar_estatus1('.$reg->idpg_detped.',\''.$reg->iddetalle_pedido.'\',\''.$reg->idpg_pedidos.'\');"></i>Existencia
			                                                  </a>
			                                                  
			                                                </li>
			                                              </ul>
			                                            </div>

			                                            <div class="col-md-2 col-sm-3">
			                                              <ul class="nav navbar-right panel_toolbox">
			                                                <li>
			                                                  <a class="btn btn-app" style="background: #EE3676; color: white; border-radius: 10px;">                  
			                                                    <i class="fa fa-inbox" onclick="guardar_estatus2('.$reg->idpg_detped.',\''.$reg->iddetalle_pedido.'\',\''.$reg->idpg_pedidos.'\');"></i>Apartado
			                                                  </a>
			                                                  
			                                                </li>
			                                              </ul>
			                                            </div>


			                                            <div class="col-md-2 col-sm-3">
			                                              <ul class="nav navbar-right panel_toolbox">
			                                                <li>
			                                                  <a class="btn btn-app" style="background: #044A80; color: white; border-radius: 10px;">                  
			                                                    <i class="fa fa-inbox" onclick="guardar_estatus3('.$reg->idpg_detped.',\''.$reg->iddetalle_pedido.'\',\''.$reg->idpg_pedidos.'\');"></i>Producción
			                                                  </a>
			                                                  
			                                                </li>
			                                              </ul>
			                                            </div>


			                                            <div class="col-md-2 col-sm-3">
			                                              <ul class="nav navbar-right panel_toolbox">
			                                                <li>
			                                                  <a class="btn btn-app" style="background: #FFFFFF; color: black; border-radius: 10px;">                  
			                                                    <i class="fa fa-inbox" onclick="guardar_estatus5('.$reg->idpg_detped.',\''.$reg->iddetalle_pedido.'\',\''.$reg->idpg_pedidos.'\');"></i>Otro
			                                                  </a>
			                                                  
			                                                </li>
			                                              </ul>
			                                            </div>


							                            
							                         </div>

	                                </td>
	                                <td>
	                                	<button type="button" class="btn btn-danger" onclick="borrar_det_ped('.$reg->idpg_detped.',\''.$reg->iddetalle_pedido.'\');" id="" >x</button>
	                                	
	                                </td>
	                                
	                             </tr>


						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'guardar_det_ped':

			
			$idpg_detped = $_POST['idpg_detped'];
			$cant = $_POST['cant'];
			$obs_enl = $_POST['obs_enl'];

			$estatus = $_POST['estatus'];
			$fecha_hora = $_POST['fecha_hora'];
			$id_ped_temp = $_POST['id_ped_temp'];
			$result = $_POST['result'];
			$iddetalle_pedido = $_POST['iddetalle_pedido'];

			$rspta=$diseno->guardar_det_ped($idpg_detped,$cant,$obs_enl,$estatus,$fecha_hora,$id_ped_temp,$result,$iddetalle_pedido);
	 		echo json_encode($rspta);
		break;

		case 'guardar_cant_prod':

			
			$idpg_detped = $_POST['idpg_detped'];
			$cant = $_POST['cant'];

			$rspta=$diseno->guardar_cant_prod($idpg_detped,$cant);
	 		echo json_encode($rspta);
		break;

		case 'guardar_observ_prod_enl':

			
			$idpg_detped = $_POST['idpg_detped'];
			$obs_enl = $_POST['obs_enl'];

			$rspta=$diseno->guardar_observ_prod_enl($idpg_detped,$obs_enl);
	 		echo json_encode($rspta);
		break;




		case 'save_op_prod':

			
			$idpg_detped = $_POST['idpg_detped'];
			$op = $_POST['op'];

			$rspta=$diseno->save_op_prod($idpg_detped,$op);
	 		echo json_encode($rspta);
		break;

		case 'borrar_det_ped':

			
			$idpg_detped = $_POST['idpg_detped'];
			$iddetalle_pedido = $_POST['iddetalle_pedido'];

			$rspta=$diseno->borrar_det_ped($idpg_detped,$iddetalle_pedido);
	 		echo json_encode($rspta);
		break;


		case 'listar_seguim_prod':
			//Recibimos el idingreso
			//$id=$_GET['id'];
			$id=$_GET['id'];
			$id2=$_GET['id2'];

			$rspta = $diseno->listar_seguim_prod($id,$id2);



						echo '	<thead>
	                              <tr>
	                                <th width="20%">Datos de pedido</th>
	                                <th width="10%">Tipo de pedido</th>
	                                <th width="20%">Producto</th>
	                              	<th width="8%">Cant.</th>
	                              	
	                              	<th width="8%">Enviado (Control)</th>
	                              	<th width="8%">OP</th>
	                                <th width="8%">Obs.</th>
	                                <th width="10%">Obs. (Pedido)</th>
	                                <th width="8%">Docs. (Pedido)</th>
	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->observaciones=="") {
							$vis="hidden";
						}elseif ($reg->observaciones<>"") {
							$vis="visible";
						}

						if ($reg->observ_enlace<>"") {
							$observacion_prod = $reg->observ_enlace;
						}elseif ($reg->observacion<>"") {
							$observacion_prod = $reg->observacion;
						}elseif ($reg->observacion=="") {
							$observacion_prod = $reg->observacion;
						}


						if ($reg->op>0) {
							$color = "#ccc";
						}elseif ($reg->op=="") {
							$color = "";
						}


						if ($reg->no_op_temp>0 && $reg->op==null) {
							$backg = "background: rgb(162,202,223);";
						}

						if ($reg->documentos_ped>0) {

							$vis2 = "visible";
						}elseif ($reg->documentos_ped==0) {
							$vis2 = "hidden";
						}


						if ($reg->select_op == 1) {
							$back_fila = "rgb(162, 202, 223)";
						}elseif ($reg->select_op == 0) {
							$back_fila = "rgb(255, 255, 255)";
						}

						if ($reg->tipo_pedido==1) {
							$tipo = "Comercial";
						}elseif ($reg->tipo_pedido==2) {
							$tipo = "Licitación";
						}elseif ($reg->tipo_pedido==3) {
							$tipo = "Muestras";
						}elseif ($reg->tipo_pedido==4) {
							$tipo = "Exisencias";
						}elseif ($reg->tipo_pedido==0) {
							$tipo = "";
						}


						echo '

								<tr onclick="marcar_color('.$reg->idpg_detped.',\''.$reg->op.'\')" id="tr'.$reg->idpg_detped.'" style="background-color: '.$back_fila.';">
									<td>
										No Control: '.$reg->no_control.'<br>
										Fecha de pedido: '.$reg->fecha_pedido.'<br>
										Fecha de entrega: '.$reg->fecha_entrega.'<br>
										Empaque: '.$reg->empaque.'<br>
										Estatus de pedido: '.$reg->estatus_pedido.'
									</td>
									<td>'.$tipo.'</td>
									<td>
										Codigo: '.$reg->codigo.'<br>
										Descripción: '.$reg->descripcion.' <br>
										Medida: '.$reg->medida.', Color:  '.$reg->color.' <br>
									</td>
									<td>'.$reg->cantidad.'</td>
	                               
	                                <td>'.$reg->fecha_hora.'<input type="hidden" class="form-control" id="iddet_ped_op'.$reg->idpg_detped.'"></td>
									
	                                
	                                <td><input type="number" class="form-control" id="op_prod_seguim'.$reg->idpg_detped.'" value="'.$reg->op.'" onkeyup="guardar_op_seguim('.$reg->idpg_detped.');" disabled></td>
	                                <td>'.$observacion_prod.'</td>
	                                <td><button type="button" class="btn btn-dark" id="" onclick="ver_observ_gen('.$reg->idpg_pedidos.');" style="visibility: '.$vis.';">Observaciones generales</button></td>
	                                <td><button type="button" class="btn btn-dark" id="" onclick="ver_documentos_ped('.$reg->idpg_pedidos.');" style="visibility: '.$vis2.';">Documentos</button></td>
	                                
	                                
	                                
	                             </tr>


						';
						
					}

						echo '</tbody>
							  

						';
			
		break;


		/*
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
						                	
						                	<p id="'.$reg->idpg_detped.'">'.$reg->estatus.'</p>
						                	</a>
							                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">



			                                            <div class="col-md-6 col-sm-6">
			                                              <ul class="nav navbar-right panel_toolbox">
			                                                <li>
			                                                  <a class="btn btn-app" style="background: #044A80; color: white; border-radius: 10px;">                  
			                                                    <i class="fa fa-inbox" onclick="guardar_estatus_prod1('.$reg->idpg_detped.');"></i>Producción
			                                                  </a>

			                                                  
			                                                </li>
			                                              </ul>
			                                            </div>
			                                            
			                                            <div class="col-md-6 col-sm-6">
			                                              <ul class="nav navbar-right panel_toolbox">
			                                                <li>
			                                                  <a class="btn btn-app" style="background: #FCE347; color: black; border-radius: 10px;">                  
			                                                    <i class="fa fa-inbox" onclick="guardar_estatus_prod2('.$reg->idpg_detped.');"></i>Fabricado
			                                                  </a>
			                                                  
			                                                </li>
			                                              </ul>
			                                            </div>

			                                           

							                            
							                         </div>
		*/


		case 'listar_prod_fab':
			//Recibimos el idingreso
			//$id=$_GET['id'];
			
			//$id2=$_GET['id2'];

			$rspta = $diseno->listar_prod_fab();



						echo '	<thead>
	                              <tr>
	                              	<th width="10%">Estatus</th>
	                              	<th width="10%">No. OP</th>
	                              	<th width="10%">No. Control</th>
	                              	<th width="10%">Codigo</th>
	                                <th width="20%">Nombre</th>
	                                <th width="10%">Medidas</th>
	                                <th width="5%">Color</th>
	                                <th width="5%">Cantidad</th>
	                                <th width="5%">Empaque</th>
	                                <th width="15%">Observaciones</th>

	                                
	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{



						echo '

								<tr onclick="marcar_color('.$reg->idpg_detped.')" id="tr'.$reg->idpg_detped.'">
									<td>'.$reg->estatus.'
	                                		


	                                		

	                                </td>

	                                <td>'.$reg->op.'</td>
	                                <td>'.$reg->no_control.'</td>
	                                <td>'.$reg->codigo.'</td>
	                                <td>'.$reg->descripcion.'</td>
	                                <td>'.$reg->medida.'</td>
	                                <td>'.$reg->color.'</td>
	                                <td>'.$reg->cantidad.'</td>
	                                <td>'.$reg->empaque.'</td>
	                                <td>'.$observacion_prod.'</td>                          
	                                
	                             </tr>


						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		/*
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
						                	
						                	<p id="'.$reg->idpg_detped.'">'.$reg->estatus.'</p>
						                	</a>
							                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">



			                                            
			                                            
			                                            <div class="col-md-6 col-sm-6">
			                                              <ul class="nav navbar-right panel_toolbox">
			                                                <li>
			                                                  <a class="btn btn-app" style="background: #FCE347; color: black; border-radius: 10px;">                  
			                                                    <i class="fa fa-inbox" onclick="guardar_estatus_prod2('.$reg->idpg_detped.');"></i>Fabricado
			                                                  </a>
			                                                  
			                                                </li>
			                                              </ul>
			                                            </div>

			                                           

							                            
							                         </div>
	                                		
		*/


		case 'listar_seguim_buscar':

			$id=$_GET['id'];

			$rspta = $diseno->listar_seguim_buscar($id);



						echo '	<thead>
	                              <tr>
	                              	<th width="5%">Estatus</th>
	                              	
	                              	<th width="5%">Fecha de asignación (Control)</th>
	                              	<th width="5%">#Control</th>
	                              	<th width="5%">Empaque</th>
	                              	<th width="5%">Fecha de pedido</th>
	                              	<th width="5%">Fecha de entrega</th>
	                               	<th width="5%">Codigo</th>
	                                <th width="5%">Nombre</th>
	                                <th width="5%">Medidas</th>
	                                <th width="5%">Color</th>
	                                <th width="5%">Cantidad</th>
	                                <th width="5%">OP</th>
	                                <th width="5%">Observaciones</th>
	                                <th width="5%">Observaciones generales</th>
	                                
	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->observaciones=="") {
							$vis="hidden";
						}elseif ($reg->observaciones<>"") {
							$vis="visible";
						}

						if ($reg->observ_enlace<>"") {
							$observacion_prod = $reg->observ_enlace;
						}elseif ($reg->observacion<>"") {
							$observacion_prod = $reg->observacion;
						}elseif ($reg->observacion=="") {
							$observacion_prod = $reg->observacion;
						}


						if ($reg->op>0) {
							$color = "#ccc";
						}elseif ($reg->op=="") {
							$color = "";
						}


						if ($reg->no_op_temp>0 && $reg->op==null) {
							$backg = "background: rgb(162,202,223);";
						}


						echo '

								<tr onclick="marcar_color('.$reg->idpg_detped.')" id="tr'.$reg->idpg_detped.'">
									<td>'.$reg->estatus.'
  		

	                                </td>
	                                
	                                <td>'.$reg->fecha_hora.'<input type="hidden" class="form-control" id="iddet_ped_op'.$reg->idpg_detped.'"></td>
									<td>'.$reg->no_control.'</td>
									<td>'.$reg->empaque.'</td>
									<td>'.$reg->fecha_pedido.'</td>
									<td>'.$reg->fecha_entrega.'</td>
									<td>'.$reg->codigo.'</td>
	                                <td>'.$reg->descripcion.'</td>
	                                <td>'.$reg->medida.'</td>
	                                <td>'.$reg->color.'</td>
	                                <td>'.$reg->cantidad.'</td>
	                                <td><input type="number" class="form-control" id="op_prod_seguim'.$reg->idpg_detped.'" value="'.$reg->op.'" onkeyup="guardar_op_seguim('.$reg->idpg_detped.');" disabled></td>
	                                <td>'.$observacion_prod.'</td>
	                                <td><button type="button" class="btn btn-dark" id="" onclick="ver_observ_gen('.$reg->idpg_pedidos.');" style="visibility: '.$vis.';">Observaciones generales</button></td>
	                                
	                                
	                                
	                             </tr>


						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		/*
			
	                                		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
						                	
						                	<p id="'.$reg->idpg_detped.'">'.$reg->estatus.'</p>
						                	</a>
							                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">



			                                            <div class="col-md-6 col-sm-6">
			                                              <ul class="nav navbar-right panel_toolbox">
			                                                <li>
			                                                  <a class="btn btn-app" style="background: #044A80; color: white; border-radius: 10px;">                  
			                                                    <i class="fa fa-inbox" onclick="guardar_estatus_prod1('.$reg->idpg_detped.');"></i>Producción
			                                                  </a>

			                                                  
			                                                </li>
			                                              </ul>
			                                            </div>
			                                            
			                                            <div class="col-md-6 col-sm-6">
			                                              <ul class="nav navbar-right panel_toolbox">
			                                                <li>
			                                                  <a class="btn btn-app" style="background: #FCE347; color: black; border-radius: 10px;">                  
			                                                    <i class="fa fa-inbox" onclick="guardar_estatus_prod2('.$reg->idpg_detped.');"></i>Fabricado
			                                                  </a>
			                                                  
			                                                </li>
			                                              </ul>
			                                            </div>

			                                           

							                            
							                         </div>


		*/

		case 'listar_prod_fab_buscar':

			$id=$_GET['id'];

			$rspta = $diseno->listar_prod_fab_buscar($id);



						echo '	<thead>
	                              <tr>
	                              	<th width="10%">Estatus</th>
	                              	<th width="10%">No. OP</th>
	                              	<th width="10%">No. Control</th>
	                              	<th width="10%">Codigo</th>
	                                <th width="20%">Nombre</th>
	                                <th width="10%">Medidas</th>
	                                <th width="5%">Color</th>
	                                <th width="5%">Cantidad</th>
	                                <th width="5%">Empaque</th>
	                                <th width="15%">Observaciones</th>
	                                
	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						


						echo '

								<tr onclick="marcar_color('.$reg->idpg_detped.')" id="tr'.$reg->idpg_detped.'">
									<td>'.$reg->estatus.'
	                                		


	                                		

	                                </td>

	                                <td>'.$reg->op.'</td>
	                                <td>'.$reg->no_control.'</td>
	                                <td>'.$reg->codigo.'</td>
	                                <td>'.$reg->descripcion.'</td>
	                                <td>'.$reg->medida.'</td>
	                                <td>'.$reg->color.'</td>
	                                <td>'.$reg->cantidad.'</td>
	                                <td>'.$reg->empaque.'</td>
	                                <td>'.$observacion_prod.'</td>                          
	                                
	                             </tr>


						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		/*

			
	                                		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
						                	
						                	<p id="'.$reg->idpg_detped.'">'.$reg->estatus.'</p>
						                	</a>
							                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">



			                                            
			                                            
			                                            <div class="col-md-6 col-sm-6">
			                                              <ul class="nav navbar-right panel_toolbox">
			                                                <li>
			                                                  <a class="btn btn-app" style="background: #FCE347; color: black; border-radius: 10px;">                  
			                                                    <i class="fa fa-inbox" onclick="guardar_estatus_prod2('.$reg->idpg_detped.');"></i>Fabricado
			                                                  </a>
			                                                  
			                                                </li>
			                                              </ul>
			                                            </div>

			                                           

							                            
							                         </div>

		*/

		case 'listar_seguim_prod2':
			//Recibimos el idingreso
			//$id=$_GET['id'];
			//$id=$_GET['id'];

			$rspta = $diseno->listar_seguim_prod2();



						echo '	<thead>
	                              <tr>
	                              	<th>Estatus</th>
	                              	<th>Fecha de envío (Producción)</th>
	                              	<th>#Control</th>
	                              	<th>Empaque</th>
	                              	<th>Fecha de pedido</th>
	                              	<th>Fecha de entrega</th>
	                               	<th>Codigo</th>
	                                <th>Nombre</th>
	                                <th>Medidas</th>
	                                <th>Color</th>
	                                <th>Cantidad</th>
	                                <th>OP</th>
	                                <th>Observaciones</th>
	                                <th>Observaciones generales</th>
	                                
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->observaciones=="") {
							$vis="hidden";
						}

						if ($reg->observ_enlace<>"") {
							$observacion_prod = $reg->observ_enlace;
						}elseif ($reg->observacion<>"") {
							$observacion_prod = $reg->observacion;
						}elseif ($reg->observacion=="") {
							$observacion_prod = $reg->observacion;
						}

						echo '

								<tr>
									<td>'.$reg->estatus.'
	                                		


	                                		
	                                		

	                                </td>
	                                <td>'.$reg->fecha_hora2.'</td>
									<td>'.$reg->no_control.'</td>
									<td>'.$reg->empaque.'</td>
									<td>'.$reg->fecha_pedido.'</td>
									<td>'.$reg->fecha_entrega.'</td>
									<td>'.$reg->codigo.'</td>
	                                <td>'.$reg->descripcion.'</td>
	                                <td>'.$reg->medida.'</td>
	                                <td>'.$reg->color.'</td>
	                                <td>'.$reg->cantidad.'</td>
	                                <td>'.$reg->op.'</td>
	                                <td>'.$observacion_prod.'</td>
	                                <td><button type="button" class="btn btn-dark" id="" onclick="ver_observ_gen('.$reg->idpg_pedidos.');" style="visibility: '.$vis.';">Observaciones generales</button></td>
	                                
	                                

	                                	

	                                
	                                
	                             </tr>


						';
						
					}

						echo '</tbody>
							  

						';
			
		break;


		/*

			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						                	
						                	
						                	<p id="'.$reg->idpg_detped.'">'.$reg->estatus.'</p>
						                	</a>
							                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">



			                                            <div class="col-md-6 col-sm-6">
			                                              <ul class="nav navbar-right panel_toolbox">
			                                                <li>
			                                                  <a class="btn btn-app" style="background: #044A80; color: white; border-radius: 10px;">                  
			                                                    <i class="fa fa-inbox" onclick="guardar_estatus_prod1('.$reg->idpg_detped.');"></i>Producción
			                                                  </a>
			                                                  
			                                                </li>
			                                              </ul>
			                                            </div>
			                                            
			                                            <div class="col-md-6 col-sm-6">
			                                              <ul class="nav navbar-right panel_toolbox">
			                                                <li>
			                                                  <a class="btn btn-app" style="background: #FCE347; color: black; border-radius: 10px;">                  
			                                                    <i class="fa fa-inbox" onclick="guardar_estatus_prod2('.$reg->idpg_detped.');"></i>Fabricado
			                                                  </a>
			                                                  
			                                                </li>
			                                              </ul>
			                                            </div>

			                                           

							                            
							                         </div>

		*/

		case 'guardar_estatus_prod':

			
			$idpg_detped = $_POST['idpg_detped'];
			$estatus = $_POST['estatus'];
			$fecha_hora = $_POST['fecha_hora'];


			$rspta=$diseno->guardar_estatus_prod($idpg_detped,$estatus,$fecha_hora);
	 		echo json_encode($rspta);
		break;

		case 'guardar_estatus_prod2':

			
			$idpg_detped = $_POST['idpg_detped'];
			$estatus = $_POST['estatus'];
			$fecha_hora = $_POST['fecha_hora'];
			$lote = $_POST['lote'];


			$rspta=$diseno->guardar_estatus_prod2($idpg_detped,$estatus,$fecha_hora,$lote);
	 		echo json_encode($rspta);
		break;

		case 'guardar_op_seguim':
			
			$idpg_detped = $_POST['idpg_detped'];
			$op = $_POST['op'];

			$rspta=$diseno->guardar_op_seguim($idpg_detped,$op);
	 		echo json_encode($rspta);
		break;

		case 'ver_observ_prod':
			//Recibimos el idingreso
			//$id=$_GET['id'];
			$id=$_GET['id'];
			$observ_prod=0;


			$rspta = $diseno->ver_observ_prod($id);



						echo '	<thead>
	                              <tr>

	                              	<th>Codigo</th>
	                              	<th>Descripción</th>
	                              	<th>Observación</th>
	                              	
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						$observation = $reg->observacion;
						 if ($observation<>"") {
						 	$observ_prod=$observ_prod+1;
						 }

						echo '

								<tr>
									
	                                <td>'.$reg->codigo.'</td>
									<td>'.$reg->descripcion.'</td>
									<td>

										<textarea class="form-control" id="obser_prod_det'.$reg->idpg_detalle_pedidos.'" cols="40" rows="5" onkeyup="update_observ_prod('.$reg->idpg_detalle_pedidos.',\''.$reg->idpg_pedidos.'\',\''.$reg->codigo.'\');" disabled>'.$reg->observacion.'</textarea> 

									</td>

									 
	                                
	                             </tr>


						';


						
					}

						echo '</tbody>
							  <tfoot>
							    <tr>
							      <td id="num_observ">Numero de observaciones: '.$observ_prod.'</td>
							      
							    </tr>
							  </tfoot>

						';
			
		break;

		case 'update_observ_prod':
			
			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			$obser_prod_det = $_POST['obser_prod_det'];

			$rspta=$diseno->update_observ_prod($idpg_detalle_pedidos,$obser_prod_det);
	 		echo json_encode($rspta);
		break;

		case 'ver_observ_gen':
			
			$idpg_pedidos = $_POST['idpg_pedidos'];

			$rspta=$diseno->ver_observ_gen($idpg_pedidos);
	 		echo json_encode($rspta);
		break;

		case 'cont_observ_det':
			
			$idpg_pedidos = $_POST['idpg_pedidos'];

			$rspta=$diseno->cont_observ_det($idpg_pedidos);
	 		echo json_encode($rspta);
		break;

		case 'save_hist':
			
			$id_ped_temp = $_POST['id_ped_temp'];
			$idusuario = $_POST['idusuario'];
			$fecha_hora = $_POST['fecha_hora'];
			$text_set = $_POST['text_set'];

			$rspta=$diseno->save_hist($id_ped_temp,$idusuario,$fecha_hora,$text_set);
	 		echo json_encode($rspta);
		break;

		case 'save_hist_iva':
			
			$id_ped_temp = $_POST['id_ped_temp'];
			$aplic_iva = $_POST['aplic_iva'];


			$rspta=$diseno->save_hist_iva($id_ped_temp,$aplic_iva);
	 		echo json_encode($rspta);
		break;


		case 'listar_historial':
			//Recibimos el idingreso
			//$id=$_GET['id'];
			$id=$_GET['id'];
			//$observ_prod=0;


			$rspta = $diseno->listar_historial($id);



						echo '	<thead>
	                              <tr>

	                              	<th>No.</th>
	                              	<th>Movimiento</th>
	                              	<th>Usuario</th>
	                              	<th>Fecha/Hora</th>
	                              	
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '

								<tr>
									<td>'.$reg->idhistorial_mov.'</td>
	                                <td>'.$reg->movimiento.'</td>
									<td>'.$reg->nombre.'</td>
									<td>'.$reg->fecha_hora.'</td>
									
	                                
	                             </tr>


						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'guardar_op_fab':
			
			$ultimo_op = $_POST['ultimo_op'];

			$rspta=$diseno->guardar_op_fab($ultimo_op);
	 		echo json_encode($rspta);
		break;

		case 'borrar_op_det':
			
			$iddet_ped_op = $_POST['iddet_ped_op'];
			$idpg_detped = $_POST['idpg_detped'];

			$rspta=$diseno->borrar_op_det($idpg_detped,$iddet_ped_op);
	 		echo json_encode($rspta);

		break;

		case 'set_one_op':
			
			$idop = $_POST['idop'];

			$rspta=$diseno->set_one_op($idop);
	 		echo json_encode($rspta);
	 		
		break;

		case 'set_op2':
			
			$idop = $_POST['idop'];

			$rspta=$diseno->set_op2($idop);
	 		echo json_encode($rspta);
	 		
		break;

		case 'consul_op':
			
			$idpg_detped = $_POST['idpg_detped'];

			$rspta=$diseno->consul_op($idpg_detped);
	 		echo json_encode($rspta);
	 		
		break;

		case 'consul_op_detalle_prod':
			
			$idop = $_POST['idop'];

			$rspta=$diseno->consul_op_detalle_prod($idop);
	 		echo json_encode($rspta);
	 		
		break;

		case 'obtener_idpedido':
			
			$idpg_detped = $_POST['idpg_detped'];

			$rspta=$diseno->obtener_idpedido($idpg_detped);
	 		echo json_encode($rspta);
	 		
		break;

		case 'contar_prod_ped':
			
			$idpedido = $_POST['idpedido'];

			$rspta=$diseno->contar_prod_ped($idpedido);
	 		echo json_encode($rspta);
	 		
		break;

		case 'contar_prod_apar':
			
			$idpedido = $_POST['idpedido'];

			$rspta=$diseno->contar_prod_apar($idpedido);
	 		echo json_encode($rspta);
	 		
		break;

		case 'contar_prod_prod':
			
			$idpedido = $_POST['idpedido'];

			$rspta=$diseno->contar_prod_prod($idpedido);
	 		echo json_encode($rspta);
	 		
		break;

		case 'contar_prod_exist':
			
			$idpedido = $_POST['idpedido'];

			$rspta=$diseno->contar_prod_exist($idpedido);
	 		echo json_encode($rspta);
	 		
		break;

		case 'save_notif':
			
			$idpedido = $_POST['idpedido'];
			$idusuario = $_POST['idusuario'];
			$fecha_hora = $_POST['fecha_hora'];
			$estatus_pedido = $_POST['estatus_pedido'];

			$rspta=$diseno->save_notif($idpedido,$idusuario,$fecha_hora,$estatus_pedido);
	 		echo json_encode($rspta);
	 		
		break;

		case 'abrir_terminados':

			$rspta = $diseno->abrir_terminados();
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->num_docs==0) {

							$mensaje="En espera de documentos...";
							
						}elseif ($reg->num_docs>0) {

							$mensaje="Listo para entrega";

						}


							if ($reg->fecha_entrega_fab<>"" OR $reg->fecha_entrega_fab<>null) {
								$fecha_entrega = $reg->fecha_entrega_fab;
							}elseif ($reg->fecha_entrega_fab=="" OR $reg->fecha_entrega_fab==null) {
								$fecha_entrega = $reg->fecha_entrega_set;
							}

							$cant_pendiente = $reg->cant_pendiente - $reg->cant_entrega;



						echo '

													<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->idpg_pedidos.'" aria-expanded="true" aria-controls="collapseOne" onclick="listar_pedido_detalle_term('.$reg->idpg_pedidos.');">
                                                          

                                                          <table id="datatable_buttons" class="table table-hover">
							                                  <tr>
							                                    <td width="15%">
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
							                                    	'.$fecha_entrega.'
							                                    </td>

							                                   
							                                  </tr>
							                                  <tr>
							                                  	<td colspan="2">
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
                                                        				<a href="sale_product.php?pedido='.$reg->idpg_pedidos.'" onclick="abrir_pedido_notif('.$reg->idpg_pedidos.');">
															               <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
																	    </a>

																	    <a href="#" onclick="abrir_docs('.$reg->idpg_pedidos.');">
															               <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></button>
																	    </a>

																	    <a href="#" onclick="abrir_ventana_salidas('.$reg->idpg_pedidos.');">
															               <button type="button" class="btn btn-dark" disabled>Enviar a entrega</button>
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
						

						

				

						
					}

						
		break;

		case 'listar_listos':

			$id=$_GET['id'];

			$rspta = $diseno->listar_listos($id);
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->num_docs==0) {

							$mensaje="En espera de documentos...";
							
						}elseif ($reg->num_docs>0) {

							$mensaje="Listo para entrega";

						}


							if ($reg->fecha_entrega_fab<>"" OR $reg->fecha_entrega_fab<>null) {
								$fecha_entrega = $reg->fecha_entrega_fab;
							}elseif ($reg->fecha_entrega_fab=="" OR $reg->fecha_entrega_fab==null) {
								$fecha_entrega = $reg->fecha_entrega_set;
							}

							$cant_pendiente = $reg->cant_pendiente - $reg->cant_entrega;



						echo '

													<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->idpg_pedidos.'" aria-expanded="true" aria-controls="collapseOne" onclick="listar_pedido_detalle_term('.$reg->idpg_pedidos.');">
                                                          

                                                          <table id="datatable_buttons" class="table table-hover">
							                                  <tr>
							                                    <td width="15%">
								                                    Control:<br>
								                                    <label style="font-weight: bold; font-size: 18px;">'.$reg->no_control.'</label><br>
								                                    
							                                    </td>
							                                   
							                                    <td width="35%">
							                                    	
							                                    	Razón Social:<br>
								                                    '.$reg->razon_fac.'<br> 
							                                    </td>
							                                    

							                                    <td width="30%">
							                                    	Estatus:<br>
							                                    	
							                                    	<label style="font-weight: bold; font-size: 15px;">'.$mensaje.'</label><br>
							                                    	 
							                                    </td>
							                                    
							                                    <td width="20%">
							                                    	Fecha de termino:<br>
							                                    	'.$fecha_entrega.'
							                                    </td>

							                                   
							                                  </tr>
							                                  
							                               </table>

                                                        </a>
                                                        <div id="collapseOne'.$reg->idpg_pedidos.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

                                                        			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        				<hr width="100%">
                                                        			</div>

                                                        		

                                                          <div class="panel-body">

                                                          	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5; overflow:scroll; width: 1000px;">

                                                          		<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="left">
                                                        				<a href="sale_product.php?pedido='.$reg->idpg_pedidos.'" onclick="abrir_pedido_notif('.$reg->idpg_pedidos.');">
															               <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
																	    </a>

																	    <a href="#" onclick="abrir_docs('.$reg->idpg_pedidos.');">
															               <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></button>
																	    </a>
                                                        		</div>

                                                          		<table class="table table-bordered" id="tbl_pedido_detalle_term_v'.$reg->idpg_pedidos.'" style="width: 1200px; style="border-bottom: solid;"">
                                                              
                                                            	</table>

                                                          	</div>

                                                          	
                                                          	
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>

						';
						

						

				

						
					}

						
		break;

		case 'abrir_terminados3':
			
			//$id=$_GET['id'];

			$rspta = $diseno->abrir_terminados();



						echo '	<thead>
	                              <tr>

	                              	<th>No. Control<br>|Cliente</th> 
	                              	<th>Estatus</th>
	                              	<th>Fecha de termino</th>
	                              	<th>Opciones</th> 
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->num_docs==0) {

							/*if ($reg->estatus==1) {
								$color = "#D2E7E2";
							}elseif ($reg->estatus==2) {
								$color = "";
							}*/

							$mensaje="En espera de documentos...";
							
						}elseif ($reg->num_docs>0) {


							/*if ($reg->estatus==1) {
								$color = "#92F48F";
							}elseif ($reg->estatus==2) {
								$color = "";
							}*/

							$mensaje="Listo para entrega";



						}

							/*$avance_porc = ($reg->prod_entregados/$reg->prod_total)*100;

							if ($avance_porc==100) {
								$mensaje="Entrega programada";
							}*/

							if ($reg->fecha_entrega_fab<>"" OR $reg->fecha_entrega_fab<>null) {
								$fecha_entrega = $reg->fecha_entrega_fab;
							}elseif ($reg->fecha_entrega_fab=="" OR $reg->fecha_entrega_fab==null) {
								$fecha_entrega = $reg->fecha_entrega_set;
							}



						echo '

								<tr>
									<td style="width:30%">
											<a>'.$reg->no_control.'</a>
			                            	<br />
			                            	<small>'.$reg->nom_cliente.'</small>
									</td>
									<td style="width:30%">
											<div>
						                    	
						                    	<strong>'.$mensaje.'</strong>
						                    	
						                    </div>
											

									</td>
									<td style="">
											<div>
						                    	
						                    	<strong>'.$fecha_entrega.'</strong>
						                    	
						                    </div>
											

									</td>
									<td style="width:20%">

                                        <a href="sale_product.php?pedido='.$reg->idpg_pedidos.'" onclick="abrir_pedido_notif('.$reg->idpg_pedidos.');">
							               <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
									    </a>

									    <a href="#" onclick="abrir_docs('.$reg->idpg_pedidos.');">
							               <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></button>
									    </a>

											           

									</td style="width:20%">	
	                             </tr>	

						';	
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'abrir_terminados2':
			

			$rspta = $diseno->abrir_terminados();



						echo '	<thead>
	                              <tr>

	                              	<th>No. Control<br>|Cliente</th>
	                              	
	                              	<th>Fecha|Hora</th>
	                              	<th>Estatus</th>
	                              	<th>Opciones</th>
	                              	
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						/*if ($reg->estatus==1) {
							$color = "#92F48F";
						}elseif ($reg->estatus==2) {
							$color = "";
						}*/


						if ($reg->num_docs==0) {

							if ($reg->estatus==1) {
								$color = "#D2E7E2";
							}elseif ($reg->estatus==2) {
								$color = "";
							}

							$mensaje="En espera de documentos...";
							
						}elseif ($reg->num_docs>0) {


							if ($reg->estatus==1) {
								$color = "#92F48F";
							}elseif ($reg->estatus==2) {
								$color = "";
							}

							$mensaje="Listo para entrega";



						}

							$avance_porc = ($reg->prod_entregados/$reg->prod_total)*100;

							if ($avance_porc==100) {
								$mensaje="Entrega programada";
							}

						

						echo '

								<tr style="background: '.$color.'">
									<td style="width:30%">

											<a>'.$reg->no_control.'</a>
			                            	<br />
			                            	<small>'.$reg->nom_cliente.'</small>

									

									</td>

									<td>'.$reg->fecha_notif.'</td>
	                                
									
									<td style="width:30%">
											<div>
						                    	
						                    	<strong>'.$mensaje.'</strong>
						                    	
						                    </div>
											

									</td>
									<td>

                                        <a href="sale_product.php?pedido='.$reg->idpg_pedidos.'" onclick="abrir_pedido_notif('.$reg->idpg_pedidos.');">
							               <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
									    </a>

									    <a href="#" onclick="abrir_docs('.$reg->idpg_pedidos.');">
							               <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></button>
									    </a>

											           

									</td style="width:20%">
									
	                                
	                             </tr>	

						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'abrir_pedido_notif':
			
			$idpg_pedidos = $_POST['idpg_pedidos'];

			$rspta=$diseno->abrir_pedido_notif($idpg_pedidos);
	 		echo json_encode($rspta);
	 		
		break;

		case 'abrir_pedido_notif2':
			
			$idpg_pedidos = $_POST['idpg_pedidos'];

			$rspta=$diseno->abrir_pedido_notif2($idpg_pedidos);
	 		echo json_encode($rspta);
	 		
		break;

		case 'cargar_notif':

			$rspta=$diseno->cargar_notif();
	 		echo json_encode($rspta);
	 		
		break;


		/*case 'listar_listos':
			
			$id=$_GET['id'];
			
			$rspta = $diseno->listar_listos($id);



						echo '	<thead>
	                              <tr>

	                              	<th>No. Control</th>
	                              	<th>Estatus</th>
	                              	<th>Opciones</th>
	                              	
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->num_docs==0) {


							$mensaje="En espera de documentos...";
							
						}elseif ($reg->num_docs>0) {


							$mensaje="Listo para entrega";
						}

						//$color = "";

						echo '

								<tr>
									<td>'.$reg->no_control.'</td>
	                                <
									
									<td><h6>'.$mensaje.'</h6></td>
									<td>

                                        				<a href="sale_product.php?pedido='.$reg->idpg_pedidos.'" onclick="abrir_pedido_notif2('.$reg->idpg_pedidos.');">
							                            	<button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
											            </a>

											            <a href="#" onclick="abrir_docs('.$reg->idpg_pedidos.');">
							                            	<button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-file" aria-hidden="true"></span><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></button>
											            </a>

         

									</td>
									
	                                
	                             </tr>	

						';


						
					}

						echo '</tbody>
							  

						';
			
		break;*/

		
		case 'listar_listos2':
			
			$id=$_GET['id'];
			
			$rspta = $diseno->listar_listos($id);



						echo '	<thead>
	                              <tr>

	                              	<th>No. Control</th>
	                              	<th>Fecha</th>
	                              	<th>Hora</th>
	                              	
	                              	<th>Estatus</th>
	                              	<th>Opciones</th>
	                              	
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

							


						if ($reg->num_docs==0) {

							if ($reg->estatus2==1) {
								$color = "#D2E7E2";
							}elseif ($reg->estatus2==2) {
								$color = "";
							}

							$mensaje="En espera de documentos...";
							
						}elseif ($reg->num_docs>0) {


							if ($reg->estatus2==1) {
								$color = "#92F48F";
							}elseif ($reg->estatus2==2) {
								$color = "";
							}

							$mensaje="Listo para entrega";
						}

						//$color = "";

						echo '

								<tr style="background: '.$color.'">
									<td>'.$reg->no_control.'</td>
	                                <td>'.$reg->fecha.'</td>
									<td>'.$reg->hora.'</td>
									
									<td><h6>'.$mensaje.'</h6></td>
									<td>

                                        				<a href="sale_product.php?pedido='.$reg->idpg_pedidos.'" onclick="abrir_pedido_notif2('.$reg->idpg_pedidos.');">
							                            	<button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
											            </a>

											            <a href="#" onclick="abrir_docs('.$reg->idpg_pedidos.');">
							                            	<button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-file" aria-hidden="true"></span><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></button>
											            </a>

         

									</td>
									
	                                
	                             </tr>	

						';


						
					}

						echo '</tbody>
							  

						';
			
		break;





		case 'cargar_notif_part':

			$lugar_user = $_POST['lugar_user'];

			$rspta=$diseno->cargar_notif_part($lugar_user);
	 		echo json_encode($rspta);
	 		
		break;

		case 'marcar_sindocs':

			$idpg_pedidos = $_POST['idpg_pedidos'];

			$rspta=$diseno->marcar_sindocs($idpg_pedidos);
	 		echo json_encode($rspta);
	 		
		break;

		case 'consul_idusuario':

			$id_ped_temp = $_POST['id_ped_temp'];

			$rspta=$diseno->consul_idusuario($id_ped_temp);
	 		echo json_encode($rspta);
	 		
		break;


		case 'buscar_cliente_tbl':
			//Recibimos el idingreso
			//$id=$_GET['id'];
			$id=$_GET['id'];
			

			$rspta = $diseno->buscar_cliente_tbl($id);


			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						echo '

								<option id="idcliente'.$reg->idcliente.'" onclick="marcar_cliente('.$reg->idcliente.',\''.$reg->nombre.'\')">'.$reg->nombre.'</option>


						';
						
					}

			
		break;

		case 'abrir_observ_notif':
			
			$idhistorial_mov = $_POST['idhistorial_mov'];

			$rspta=$diseno->abrir_observ_notif($idhistorial_mov);
	 		echo json_encode($rspta);
	 		
		break;

		

		case 'listar_sin_estatus':
			
			//$id=$_GET['id'];
			
			$rspta = $diseno->listar_sin_estatus();



						echo '	<thead>
	                              <tr>
	                                <th>#</th>
	                              	<th>Control</th>
	                              	<th>Codigo</th>
	                              	<th>Nombre</th>
	                              	<th>Cantidad sin procesar</th>
	                              	
	                              	
	                              	
	                              	
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
	        $consec = 1;

			while ($reg = $rspta->fetch_object())
					{

				

						echo '

								<tr>
									<td>'.$consec.'</td>
									<td>'.$reg->no_control.'</td>
									<td>'.$reg->codigo.'</td>
									<td>'.$reg->descripcion.'</td>
	                                <td>'.$reg->cant_sin.'</td>
									
									
	                                
	                             </tr>	

						';

						$consec = $consec+1;
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'contar_prod_sinrev':
		

			$rspta=$diseno->contar_prod_sinrev();
	 		echo json_encode($rspta);
	 		
		break;


		case 'consul_exist_notif':
			
			$idpedido = $_POST['idpedido'];

			$rspta=$diseno->consul_exist_notif($idpedido);
	 		echo json_encode($rspta);
	 		
		break;

		case 'buscar_idopdetalleprod':
			
			$idpg_detped = $_POST['idpg_detped'];

			$rspta=$diseno->buscar_idopdetalleprod($idpg_detped);
	 		echo json_encode($rspta);
	 		
		break;

		case 'buscar_area':
			
			$idusuario = $_POST['idusuario'];

			$rspta=$diseno->buscar_area($idusuario);
	 		echo json_encode($rspta);
	 		
		break;

		case 'contar_productos':
			
			$pedido = $_POST['pedido'];

			$rspta=$diseno->contar_productos($pedido);
	 		echo json_encode($rspta);
	 		
		break;

		case 'enviar_pedido':
			
			$id_ped_temp = $_POST['id_ped_temp'];

			$rspta=$diseno->enviar_pedido($id_ped_temp);
	 		echo json_encode($rspta);
	 		
		break;


		case 'pedidos_vencidos':
			
			$id=$_GET['id'];

			$rspta = $diseno->pedidos_vencidos($id);



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

		case 'update_coment_vencim':
			
			$idpg_pedidos = $_POST['idpg_pedidos'];
			$coment_vencim = $_POST['coment_vencim'];

			$rspta=$diseno->update_coment_vencim($idpg_pedidos,$coment_vencim);
	 		echo json_encode($rspta);
	 		
		break;

		case 'cont_num_vencidos':

			$rspta=$diseno->cont_num_vencidos();
	 		echo json_encode($rspta);
	 		
		break;

		case 'contar_sin_coment_venc':

			$rspta=$diseno->contar_sin_coment_venc();
	 		echo json_encode($rspta);
	 		
		break;

		case 'marcar_tipo':

			$iddocumentos = $_POST['iddocumentos'];
			$tipo_doc = $_POST['tipo_doc'];

			$rspta=$diseno->marcar_tipo($iddocumentos,$tipo_doc);
	 		echo json_encode($rspta);
	 		
		break;

		case 'listar_tipos':
			
			$rspta = $diseno->listar_tipos();

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->idprod_tipo.'">'.$reg->idprod_tipo.' - '.$reg->nombre.'</option>	

						';
	
					}			
			
		break;

		case 'listar_subtipo':

			$id=$_GET['id'];
			
			$rspta = $diseno->listar_subtipo($id);

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->nombre.'">'.$reg->nombre.'</option>	

						';
	
					}			
			
		break;

		case 'listar_subtipo_new':

			//$id=$_GET['id'];
			
			$rspta = $diseno->listar_subtipo_new();

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->idprod_tipo2.'">'.$reg->nombre.'</option>	

						';
	
					}			
			
		break;

		case 'listar_modelo_new':

			//$id=$_GET['id'];
			
			$rspta = $diseno->listar_modelo_new();

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->idprod_modelo.'">'.$reg->idprod_modelo.' - '.$reg->nombre.'</option>	

						';
	
					}			
			
		break;

		case 'listar_modelo':

			$id=$_GET['id'];
			//$id2=$_GET['id2'];
			
			$rspta = $diseno->listar_modelo($id);

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->nombre.'">'.$reg->nombre.'</option>	

						';
	
					}			
			
		break;

		case 'listar_modelo2':

			$id=$_GET['id'];
			$id2=$_GET['id2'];
			
			$rspta = $diseno->listar_modelo2($id,$id2);

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->nombre.'">'.$reg->nombre.'</option>	

						';
	
					}			
			
		break;

		case 'listar_submodelo':

			$id=$_GET['id'];
			$id2=$_GET['id2'];
			
			$rspta = $diseno->listar_submodelo($id,$id2);

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->nombre.'">'.$reg->nombre.'</option>	

						';
	
					}			
			
		break;

		case 'listar_submodelo2':

			$id=$_GET['id'];
			$id2=$_GET['id2'];
			$id3=$_GET['id3'];
			
			$rspta = $diseno->listar_submodelo2($id,$id2,$id3);

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->nombre.'">'.$reg->nombre.'</option>	

						';
	
					}			
			
		break;

	

		case 'listar_tamano':

			$id=$_GET['id'];
			$id2=$_GET['id2'];
			//$id3=$_GET['id3'];
			//$id4=$_GET['id4'];
			
			$rspta = $diseno->listar_tamano($id,$id2);

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->nombre.'">'.$reg->nombre.'</option>	

						';
	
					}			
			
		break;

		case 'listar_tamano2':

			$id=$_GET['id'];
			$id2=$_GET['id2'];
			$id3=$_GET['id3'];
			//$id4=$_GET['id4'];
			
			$rspta = $diseno->listar_tamano2($id,$id2,$id3);

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->nombre.'">'.$reg->nombre.'</option>	

						';
	
					}			
			
		break;

		case 'listar_tamano3':

			$id=$_GET['id'];
			$id2=$_GET['id2'];
			$id3=$_GET['id3'];
			//$id4=$_GET['id4'];
			
			$rspta = $diseno->listar_tamano3($id,$id2,$id3);

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->nombre.'">'.$reg->nombre.'</option>	

						';
	
					}			
			
		break;

		case 'listar_tamano4':

			$id=$_GET['id'];
			$id2=$_GET['id2'];
			$id3=$_GET['id3'];
			$id4=$_GET['id4'];
			
			$rspta = $diseno->listar_tamano4($id,$id2,$id3,$id4);

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->nombre.'">'.$reg->nombre.'</option>	

						';
	
					}			
			
		break;






		case 'listar_productos':

			$id=$_GET['id'];
			
			$rspta = $diseno->listar_productos($id);

						
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<h2>'.$reg->codigo.' - '.$reg->nombre.' - '.$reg->color.' - '.$reg->medida.'</h2>	

						';
						
					}

						
			
		break;

		case 'guardar_comprobante_lic1':

			$idpedido = $_POST['idpedido'];

			$ar_coment = $_FILES["ar_comprob_lic1"];			
			$nom='1_'.$_FILES['ar_comprob_lic1']['name'];
			$ruta_anterior=$_FILES['ar_comprob_lic1']['tmp_name'];
			$ruta_idop="../files/".$idpedido;
			if (!file_exists($ruta_idop)) {
			    mkdir($ruta_idop, 0755, true);
			}
			$ruta="../files/".$idpedido."/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);

			$tipo_doc_lic = "2";

			$rspta=$diseno->guardar_comprobante_lic1($nom,$idpedido,$tipo_doc_lic);
	 		echo json_encode($rspta);
		break;

		case 'guardar_comprobante_lic2':

			$idpedido = $_POST['idpedido'];

			$ar_coment = $_FILES["ar_comprob_lic2"];			
			$nom='2_'.$_FILES['ar_comprob_lic2']['name'];
			$ruta_anterior=$_FILES['ar_comprob_lic2']['tmp_name'];
			$ruta_idop="../files/".$idpedido;
			if (!file_exists($ruta_idop)) {
			    mkdir($ruta_idop, 0755, true);
			}
			$ruta="../files/".$idpedido."/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);

			$tipo_doc_lic = "3";

			$rspta=$diseno->guardar_comprobante_lic2($nom,$idpedido,$tipo_doc_lic);
	 		echo json_encode($rspta);
		break;

		case 'guardar_comprobante_lic3':

			$idpedido = $_POST['idpedido'];

			$ar_coment = $_FILES["ar_comprob_lic3"];			
			$nom='3_'.$_FILES['ar_comprob_lic3']['name'];
			$ruta_anterior=$_FILES['ar_comprob_lic3']['tmp_name'];
			$ruta_idop="../files/".$idpedido;
			if (!file_exists($ruta_idop)) {
			    mkdir($ruta_idop, 0755, true);
			}
			$ruta="../files/".$idpedido."/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);

			$tipo_doc_lic = "4";

			$rspta=$diseno->guardar_comprobante_lic3($nom,$idpedido,$tipo_doc_lic);
	 		echo json_encode($rspta);
		break;

		case 'guardar_comprobante_lic4':

			$idpedido = $_POST['idpedido'];

			$ar_coment = $_FILES["ar_comprob_lic4"];			
			$nom='4_'.$_FILES['ar_comprob_lic4']['name'];
			$ruta_anterior=$_FILES['ar_comprob_lic4']['tmp_name'];
			$ruta_idop="../files/".$idpedido;
			if (!file_exists($ruta_idop)) {
			    mkdir($ruta_idop, 0755, true);
			}
			$ruta="../files/".$idpedido."/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);

			$tipo_doc_lic = "5";

			$rspta=$diseno->guardar_comprobante_lic4($nom,$idpedido,$tipo_doc_lic);
	 		echo json_encode($rspta);
		break;

		
		case 'update_observ_lic':

			$idpedido = $_POST['idpedido'];
			$observ_lic = $_POST['observ_lic'];

			$rspta=$diseno->update_observ_lic($idpedido,$observ_lic);
	 		echo json_encode($rspta);
	 		
		break;

		case 'consul_detped_id':

			$idpg_detped = $_POST['idpg_detped'];

			$rspta=$diseno->consul_detped_id($idpg_detped);
	 		echo json_encode($rspta);
	 		
		break;

		case 'listar_productos_resul_tipo':
			
			$id=$_GET['id'];
			
			$rspta = $diseno->listar_productos_resul_tipo($id);



						echo '	<thead>
								  
	                              <tr>
	                              	<th>Seleccionar</th>	
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>
	                              	
	                              	<th>Tamaño/Medidas</th>
	                             
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

				

						echo '

								<tr>
									<td><button type="button" class="btn btn-round btn-info" onclick="agregar_prod_ped('.$reg->idproductos_clasif.',\''.$reg->idproducto.'\',\''.$precio_total.'\');"><i class="fa fa-check"></i></button></td>
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>
									
	                                <td>'.$reg->nom_tamano.'</td>
									
									
	                                
	                             </tr>	

						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_productos_resul_tipo_sub':
			
			$id=$_GET['id'];
			$id2=$_GET['id2'];
			
			$rspta = $diseno->listar_productos_resul_tipo_sub($id,$id2);



						echo '	<thead>
								  
	                              <tr>
	                              	<th>Seleccionar</th>
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>
	                              	
	                              	<th>Tamaño/Medidas</th>
	                             
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

				

						echo '

								<tr>
									<td><button type="button" class="btn btn-round btn-info" onclick="agregar_prod_ped('.$reg->idproductos_clasif.',\''.$reg->idproducto.'\',\''.$precio_total.'\');"><i class="fa fa-check"></i></button></td>
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>
									
	                                <td>'.$reg->nom_tamano.'</td>
									
									
	                                
	                             </tr>	

						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_productos_resul_modelo':
			
			$id=$_GET['id'];
			$id2=$_GET['id2'];
			
			$rspta = $diseno->listar_productos_resul_modelo($id,$id2);



						echo '	<thead>
								  
	                              <tr>
	                              	<th>Seleccionar</th>
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>
	                              	
	                              	<th>Tamaño/Medidas</th>
	                             
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

				

						echo '

								<tr>
									<td><button type="button" class="btn btn-round btn-info" onclick="agregar_prod_ped('.$reg->idproductos_clasif.',\''.$reg->idproducto.'\',\''.$precio_total.'\');"><i class="fa fa-check"></i></button></td>
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>
									
	                                <td>'.$reg->nom_tamano.'</td>
									
									
	                                
	                             </tr>	

						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_productos_resul_modelo2':
			
			$id=$_GET['id'];
			$id2=$_GET['id2'];
			$id3=$_GET['id3'];
			
			$rspta = $diseno->listar_productos_resul_modelo2($id,$id2,$id3);



						echo '	<thead>
								  
	                              <tr>
	                              	<th>Seleccionar</th>
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>
	                              	
	                              	<th>Tamaño/Medidas</th>
	                             
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

				

						echo '

								<tr>
									<td><button type="button" class="btn btn-round btn-info" onclick="agregar_prod_ped('.$reg->idproductos_clasif.',\''.$reg->idproducto.'\',\''.$precio_total.'\');"><i class="fa fa-check"></i></button></td>
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>
									
	                                <td>'.$reg->nom_tamano.'</td>
									
									
	                                
	                             </tr>	

						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_productos_resul_submodelo':
			
			$id=$_GET['id'];
			$id2=$_GET['id2'];
			$id3=$_GET['id3'];
			
			$rspta = $diseno->listar_productos_resul_submodelo($id,$id2,$id3);



						echo '	<thead>
								  
	                              <tr>
	                              	<th>Seleccionar</th>
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>
	                              	
	                              	<th>Tamaño/Medidas</th>
	                             
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

				

						echo '

								<tr>
									<td><button type="button" class="btn btn-round btn-info" onclick="agregar_prod_ped('.$reg->idproductos_clasif.',\''.$reg->idproducto.'\',\''.$precio_total.'\');"><i class="fa fa-check"></i></button></td>
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>
									
	                                <td>'.$reg->nom_tamano.'</td>
									
									
	                                
	                             </tr>	

						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_productos_resul_submodelo2':
			
			$id=$_GET['id'];
			$id2=$_GET['id2'];
			$id3=$_GET['id3'];
			$id4=$_GET['id4'];
			
			$rspta = $diseno->listar_productos_resul_submodelo2($id,$id2,$id3,$id4);



						echo '	<thead>
								  
	                              <tr>
	                              	<th>Seleccionar</th>
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>
	                              	
	                              	<th>Tamaño/Medidas</th>
	                             
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

				

						echo '

								<tr>
									<td><button type="button" class="btn btn-round btn-info" onclick="agregar_prod_ped('.$reg->idproductos_clasif.',\''.$reg->idproducto.'\',\''.$precio_total.'\');"><i class="fa fa-check"></i></button></td>
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>
									
	                                <td>'.$reg->nom_tamano.'</td>
									
									
	                                
	                             </tr>	

						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_productos_resul':		
			$id=$_GET['id'];
			$id2=$_GET['id2'];
			$id3=$_GET['id3'];			
			$rspta = $diseno->listar_productos_resul($id,$id2,$id3);
						echo '	<thead>
	                              <tr>
	                              	<th>Seleccionar</th>
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>	                              	
	                              	<th>Tamaño/Medidas</th>	                              
	                              </tr>
	                            </thead>
	                            <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
									<td><button type="button" class="btn btn-round btn-info" onclick="agregar_prod_ped('.$reg->idproductos_clasif.',\''.$reg->idproducto.'\',\''.$precio_total.'\');"><i class="fa fa-check"></i></button></td>
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>									
	                                <td>'.$reg->nom_tamano.'</td>	                                
	                             </tr>	
						';						
					}
						echo '</tbody>
							  
						';
			
		break;

		case 'listar_productos_resul2':		
			$id=$_GET['id'];
			$id2=$_GET['id2'];
			$id3=$_GET['id3'];
			$id4=$_GET['id4'];			
			$rspta = $diseno->listar_productos_resul2($id,$id2,$id3,$id4);
						echo '	<thead>
	                              <tr>
	                              	<th>Seleccionar</th>
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>	                              	
	                              	<th>Tamaño/Medidas</th>	                              
	                              </tr>
	                            </thead>
	                            <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
									<td><button type="button" class="btn btn-round btn-info" onclick="agregar_prod_ped('.$reg->idproductos_clasif.',\''.$reg->idproducto.'\',\''.$precio_total.'\');"><i class="fa fa-check"></i></button></td>
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>									
	                                <td>'.$reg->nom_tamano.'</td>	                                
	                             </tr>	
						';						
					}
						echo '</tbody>
							  
						';
			
		break;

		case 'listar_productos_resul3':		
			$id=$_GET['id'];
			$id2=$_GET['id2'];
			$id3=$_GET['id3'];
			$id4=$_GET['id4'];			
			$rspta = $diseno->listar_productos_resul3($id,$id2,$id3,$id4);
						echo '	<thead>
	                              <tr>
	                              	<th>Seleccionar</th>
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>	                              	
	                              	<th>Tamaño/Medidas</th>	                              
	                              </tr>
	                            </thead>
	                            <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
									<td><button type="button" class="btn btn-round btn-info" onclick="agregar_prod_ped('.$reg->idproductos_clasif.',\''.$reg->idproducto.'\',\''.$precio_total.'\');"><i class="fa fa-check"></i></button></td>
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>									
	                                <td>'.$reg->nom_tamano.'</td>	                                
	                             </tr>	
						';						
					}
						echo '</tbody>
							  
						';
			
		break;

		case 'listar_productos_resul4':		
			$id=$_GET['id'];
			$id2=$_GET['id2'];
			$id3=$_GET['id3'];
			$id4=$_GET['id4'];
			$id5=$_GET['id5'];			
			$rspta = $diseno->listar_productos_resul4($id,$id2,$id3,$id4,$id5);
						echo '	<thead>
	                              <tr>
	                              	<th>Seleccionar</th>
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>	                              	
	                              	<th>Tamaño/Medidas</th>	                              
	                              </tr>
	                            </thead>
	                            <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
									<td><button type="button" class="btn btn-round btn-info" onclick="agregar_prod_ped('.$reg->idproductos_clasif.',\''.$reg->idproducto.'\',\''.$precio_total.'\');"><i class="fa fa-check"></i></button></td>
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>									
	                                <td>'.$reg->nom_tamano.'</td>	                                
	                             </tr>	
						';						
					}
						echo '</tbody>
							  
						';
			
		break;

		case 'listar_productos_busqueda':		
			$id=$_GET['id'];
		
			$rspta = $diseno->listar_productos_busqueda($id);
						echo '	<thead>
	                              <tr>
	                              	<th>Seleccionar</th>
	                              	
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>	                              	
	                              	<th>Tamaño/Medidas</th>	                              
	                              </tr>
	                            </thead>
	                            <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
									<td><button type="button" class="btn btn-round btn-info" onclick="agregar_prod_ped('.$reg->idproductos_clasif.',\''.$reg->idproducto.'\',\''.$precio_total.'\');"><i class="fa fa-check"></i></button></td>
									
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>									
	                                <td>'.$reg->nom_tamano.'</td>	                                
	                             </tr>	
						';						
					}
						echo '</tbody>
							  
						';
			
		break;

		case 'insert_prod':

			$idproductos_clasif = $_POST['idproductos_clasif'];

			$rspta=$diseno->insert_prod($idproductos_clasif);
	 		echo json_encode($rspta);
	 		
		break;

		case 'buscar_idprod_clasif':

			$idproductos_clasif = $_POST['idproductos_clasif'];
			$idproducto = $_POST['idproducto'];

			$rspta=$diseno->buscar_idprod_clasif($idproductos_clasif,$idproducto);
	 		echo json_encode($rspta);
	 		
		break;

		case 'update_producto_tbl1':

			$idmuebles_fam = $_POST['idmuebles_fam'];
			$codigo = $_POST['codigo'];
			$nombre = $_POST['nombre'];
			$idproducto = $_POST['idproducto'];
			$nom_color = $_POST['nom_color'];
			$nom_tamano = $_POST['nom_tamano'];

			$rspta=$diseno->update_producto_tbl1($idmuebles_fam,$codigo,$nombre,$idproducto,$nom_color,$nom_tamano);
	 		echo json_encode($rspta);
	 		
		break;

		case 'listar_documentos':		
			$id=$_GET['id'];
		
			$rspta = $diseno->listar_documentos($id);
						
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
										<div class="col-md-2 col-sm-2">
											
											<div class="col-md-12 col-sm-12">
												<a class="btn btn-app" href="files/'.$reg->idpedido.'/'.$reg->nombre.'" download="'.$reg->nombre.'"> 
								                    <img src="images/iconos/google-docs.png" width="30%">
								                    <div class="col-md-12 col-sm-12">
														<hr width="100%">
													</div>
								                </a>
											</div>
											<div class="col-md-12 col-sm-12">
												<label><strong>'.$tipo_text.'</strong></label><br>
												
											</div>
											<div class="col-md-12 col-sm-12">
												<label>'.$reg->nombre.'</label><br>
												
											</div>
	                                      
	                                    </div>
	                                    
							';
						}
						if ($reg->iddocumentos<=364) {
							# code...
							echo '
										<div class="col-md-2 col-sm-2">
											
											<div class="col-md-12 col-sm-12">
												<a class="btn btn-app" href="files/'.$reg->nombre.'" download="'.$reg->nombre.'"> 
								                    <img src="images/iconos/google-docs.png" width="30%">
								                    <div class="col-md-12 col-sm-12">
														<hr width="100%">
													</div>
								                </a>
											</div>
											<div class="col-md-12 col-sm-12">
												<label><strong>'.$tipo_text.'</strong></label><br>
												
											</div>
											<div class="col-md-12 col-sm-12">
												<label>'.$reg->nombre.'</label><br>
												
											</div>
	                                      
	                                    </div>
	                                    
							';

						}

													
					}
						
			
		break;

		case 'contar_productos_ped':

			$idpedido = $_POST['idpedido'];

			$rspta=$diseno->contar_productos_ped($idpedido);
	 		echo json_encode($rspta);
	 		
		break;

		case 'consul_nom_arch':

			$idpedido = $_POST['idpedido'];
			$ar_comprob = $_POST['ar_comprob'];

			$rspta=$diseno->consul_nom_arch($idpedido,$ar_comprob);
	 		echo json_encode($rspta);
	 		
		break;

		


		case 'listar_documentos_cargados_lic':		
			$id=$_GET['id'];
		
			$rspta = $diseno->listar_documentos($id);
						
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
										<div class="col-md-6 col-sm-6">
											
											<div class="col-md-12 col-sm-12">
												<a class="" href="files/'.$reg->idpedido.'/'.$reg->nombre.'" download="'.$reg->nombre.'">

													<div class="col-md-4 col-sm-4">	
														<img src="images/iconos/google-docs.png" width="100%">       
													</div>
													<div class="col-md-8 col-sm-8">
														<label><strong>'.$tipo_text.'</strong></label><br>
											            <label>'.$reg->nombre.'</label>
													</div>
													
												</a>
													
											</div>
											<div class="col-md-12 col-sm-12" align="right">
												<div class="btn-group">
												  <button type="button" class="btn btn-round" id="btn_elim_doc'.$reg->iddocumentos.'" onclick="borrar_documento_lic('.$reg->iddocumentos.');"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="font-size: 20px; color: black;"></span></button>
												  
												</div>
											</div>
											<div class="col-md-12 col-sm-12">
											  <hr width="100%">
											</div>	
	                                      
	                                    </div>
	                                    
							';
						}
						if ($reg->iddocumentos<=364) {
							# code...
							echo '
										<div class="col-md-2 col-sm-2">
											
											<div class="col-md-12 col-sm-12">
												<a class="btn btn-app" href="files/'.$reg->nombre.'" download="'.$reg->nombre.'"> 
								                    <img src="images/iconos/google-docs.png" width="30%">
								                    <div class="col-md-12 col-sm-12">
														<hr width="100%">
													</div>
								                </a>
											</div>
											<div class="col-md-12 col-sm-12">
												<label><strong>'.$tipo_text.'</strong></label><br>
												
											</div>
											<div class="col-md-12 col-sm-12">
												<label>'.$reg->nombre.'</label><br>
												
											</div>
	                                      
	                                    </div>
	                                    
							';

						}

													
					}
						
			
		break;

		case 'buscar_iddocs':

			$idpedido = $_POST['idpedido'];
			//$ar_comprob = $_POST['ar_comprob'];

			$rspta=$diseno->buscar_iddocs($idpedido);
	 		echo json_encode($rspta);
	 		
		break;

		case 'borrar_documento_lic':

			$iddocumentos = $_POST['iddocumentos'];

			$rspta=$diseno->borrar_documento_lic($iddocumentos);
	 		echo json_encode($rspta);
	 		
		break;

		case 'listar_productos_list':		
			$id=$_GET['id'];
		
			$rspta = $diseno->listar_productos_list($id);
						echo '	<thead>
	                              <tr>
	                              	<th>Agregar</th>
	                              	
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>	                              	
	                              	<th>Tamaño/Medidas</th>	                              
	                              </tr>
	                            </thead>
	                            <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
									<td><button type="button" class="btn btn-round btn-info" onclick="agregar_prod_ped_list('.$reg->idproductos_clasif.',\''.$reg->idproducto.'\',\''.$reg->precio_total.'\');"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></td>
									
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>									
	                                <td>'.$reg->nom_tamano.'</td>	                                
	                             </tr>	
						';						
					}
						echo '</tbody>
							  
						';
			
		break;

		case 'listar_productos_list_cambio':		
			$id=$_GET['id'];
			$idpg_detalle_pedidos=$_GET['idpg_detalle_pedidos'];
		
			$rspta = $diseno->listar_productos_list($id);
						echo '	<thead>
	                              <tr>
	                              	<th>Agregar</th>
	                              	
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>	                              	
	                              	<th>Tamaño/Medidas</th>	                              
	                              </tr>
	                            </thead>
	                            <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
									<td><button type="button" class="btn btn-round btn-info" onclick="select_prod_ped_list('.$reg->idproductos_clasif.',\''.$reg->idproducto.'\',\''.$reg->precio_total.'\',\''.$idpg_detalle_pedidos.'\');">Seleccionar</button></td>
									
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>									
	                                <td>'.$reg->nom_tamano.'</td>	                                
	                             </tr>	
						';						
					}
						echo '</tbody>
							  
						';
			
		break;

		case 'listar_productos_pedido_exist':		
			$id=$_GET['id'];
		
			$rspta = $diseno->listar_productos_pedido_exist($id);
						echo '	<thead>
	                              <tr>
	                              	<th>Agregar</th>
	                              	
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>	                              	
	                              	<th>Tamaño/Medidas</th>
	                              	<th>Cantidad</th>	                              
	                              </tr>
	                            </thead>
	                            <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
									<td><button type="button" class="btn btn-round" onclick="quitar_prod_ped_list('.$reg->idpg_detalle_pedidos.',\''.$reg->idproducto.'\',\''.$reg->precio_total.'\');" style="background: #BC0904; color: white;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td>
									
									<td>'.$reg->codigo.'</td>
									<td>'.$reg->descripcion.'</td>									
	                                <td>'.$reg->medida.'</td>	
	                                <td>'.$reg->cantidad.'</td>	                                
	                             </tr>	
						';						
					}
						echo '</tbody>
							  
						';
			
		break;

		case 'listar_productos_pedido_exist_edit':		
			$id=$_GET['id'];
		
			$rspta = $diseno->listar_productos_pedido_exist($id);
						echo '	<thead>
	                              <tr>
	                              	<th>Agregar</th>
	                              	
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>	                              	
	                              	<th>Tamaño/Medidas</th>
	                              	<th>Cantidad</th>	                              
	                              </tr>
	                            </thead>
	                            <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
									<td><button type="button" class="btn btn-round" onclick="editar_prod_ped_list('.$reg->idpg_detalle_pedidos.',\''.$reg->idproducto.'\',\''.$reg->precio_total.'\');" style="background: #074C74; color: white;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>
									
									<td>'.$reg->codigo.'</td>
									<td>'.$reg->descripcion.'</td>									
	                                <td>'.$reg->medida.'</td>	
	                                <td>'.$reg->cantidad.'</td>	                                
	                             </tr>	
						';						
					}
						echo '</tbody>
							  
						';
			
		break;

		case 'listar_productos_pedido_exist2':		
			$id=$_GET['id'];
		
			$rspta = $diseno->listar_productos_pedido_exist($id);
						
			while ($reg = $rspta->fetch_object())
					{
					


						echo '


                                	<div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                                        <div class="panel">
                                          <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1'.$reg->idpg_detalle_pedidos.'" aria-expanded="true" aria-controls="collapseOne" onclick="cambiar_prod_ped_list('.$reg->idpg_detalle_pedidos.');">
                                              <table id="" class="table table-bordered">
                                              	<tr>
													<td>CODIGO</td>
													<td>DESCRIPCIÓN</td>									
					                                <td>TAMAÑO</td>	
					                                <td>CANTIDAD</td>	                                
					                            </tr>
	                                          	<tr>
													<td>'.$reg->codigo.'</td>
													<td>'.$reg->descripcion.'</td>									
					                                <td>'.$reg->medida.'</td>	
					                                <td>'.$reg->cantidad.'</td>	                                
					                            </tr>	
	                              			  </table>
                                          </a>
                                          <div id="collapseOne1'.$reg->idpg_detalle_pedidos.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                            	<div class="form-group col-md-12 col-sm-12" id="div_seleccionar_prod_cambio'.$reg->idpg_detalle_pedidos.'">
                                            		  <div class="form-group col-md-12 col-sm-12">
						                                <label>Buscar codigo</label>
						                              </div>
						                              <div class="form-group col-md-10 col-sm-10">
						                                <input type="text" class="form-control" id="buscar_prod_list'.$reg->idpg_detalle_pedidos.'" value="">
						                                  
						                              </div>
						                              <div class="form-group col-md-2 col-sm-2">
						                                <button id="btn_buscar_prod_cambiar'.$reg->idpg_detalle_pedidos.'" type="button" class="btn btn-dark" onclick="mostrar_productos_list('.$reg->idpg_detalle_pedidos.');">Buscar</button>
						                              </div>
		                                              <table class="table table-striped" id="tbl_productos_list'.$reg->idpg_detalle_pedidos.'">
		                                                
		                                              </table>
                                            	</div>
                                            	
                                            	  
                                            </div>
                                          </div>
                                        </div>
                                        
                                        
                                    </div>

						';					
					}
						
			
		break;

		case 'buscar_prod_detped':

			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];

			$rspta=$diseno->buscar_prod_detped($idpg_detalle_pedidos);
	 		echo json_encode($rspta);
	 		
		break;

		case 'buscar_prod_op':

			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];

			$rspta=$diseno->buscar_prod_op($idpg_detalle_pedidos);
	 		echo json_encode($rspta);
	 		
		break;

		case 'quitar_prod_ped_list':

			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			$idpedido = $_POST['idpedido'];
			$idusuario = $_POST['idusuario'];
			$fecha_hora = $_POST['fecha_hora'];

			$rspta=$diseno->quitar_prod_ped_list($idpg_detalle_pedidos,$idpedido,$idusuario,$fecha_hora);
	 		echo json_encode($rspta);
	 		
		break;

		case 'listar_submodelo_new':
			$rspta = $diseno->listar_submodelo_new();
						echo '<option value="">Seleccionar</option>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<option value="'.$reg->idprod_modelo2.'">'.$reg->idprod_modelo2.' - '.$reg->nombre.'</option>	
						';	
					}						
		break;

		case 'listar_tamano_new':
			$rspta = $diseno->listar_tamano_new();
						echo '<option value="">Seleccionar</option>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<option value="'.$reg->idprod_tamano.'">'.$reg->idprod_tamano.' - '.$reg->nombre.'</option>	
						';	
					}						
		break;

		case 'listar_color_new':
			$rspta = $diseno->listar_color_new();
						echo '<option value="">Seleccionar</option>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<option value="'.$reg->idprod_color.'">'.$reg->nombre.'</option>	
						';	
					}						
		break;

		case 'listar_paleta_new':
			$rspta = $diseno->listar_paleta_new();
						echo '<option value="">Seleccionar</option>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<option value="'.$reg->idprod_paleta.'">'.$reg->nombre.'</option>	
						';	
					}						
		break;

		case 'listar_especif_new':
			$rspta = $diseno->listar_especif_new();
						echo '<option value="">Seleccionar</option>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<option value="'.$reg->idprod_especif.'">'.$reg->nombre.'</option>	
						';	
					}						
		break;

		case 'listar_especif2_new':
			$rspta = $diseno->listar_especif2_new();
						echo '<option value="">Seleccionar</option>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<option value="'.$reg->idprod_especif2.'">'.$reg->nombre.'</option>	
						';	
					}						
		break;

		case 'listar_especif3_new':
			$rspta = $diseno->listar_especif3_new();
						echo '<option value="">Seleccionar</option>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<option value="'.$reg->idprod_especif3.'">'.$reg->nombre.'</option>	
						';	
					}						
		break;

		case 'consul_idpgpedidos':

			$rspta=$diseno->consul_idpgpedidos();
	 		echo json_encode($rspta);
	 		
		break;

		case 'det_term':

			$id = $_POST['id'];
			$id2 = $_POST['id2'];
			$fecha_hora = $_POST['fecha_hora'];

			$rspta=$diseno->det_term($id,$id2,$fecha_hora);
	 		echo json_encode($rspta);
	 		
		break;

		case 'set_idpedido':

			$id1 = $_POST['id1'];
			$id2 = $_POST['id2'];

			$rspta=$diseno->set_idpedido($id1,$id2);
	 		echo json_encode($rspta);
	 		
		break;

		case 'set_idproducto':

			$id1 = $_POST['id1'];
			$id2 = $_POST['id2'];

			$rspta=$diseno->set_idproducto($id1,$id2);
	 		echo json_encode($rspta);
	 		
		break;


		case 'listar_pedido_detalle_term':

			$id=$_GET['id'];

			$rspta = $diseno->listar_pedido_detalle_term($id);



						echo '	<thead>
								  
	                              <tr>

	                              	<th><small style="font-weight: bold;">CÓDIGO</small></th>
	                              	<th><small style="font-weight: bold;">DESCRIP.</small></th>
	                              	<th><small style="font-weight: bold;">TAM.</small></th>
	                              	<th><small style="font-weight: bold;">COLOR</small></th>
	                              	<th><small style="font-weight: bold;">TOTAL</small></th>
	                              	<th><small style="font-weight: bold;">EN ENTREGA</small></th>
	                              	<th><small style="font-weight: bold;">ENTREGADOS</small></th>
	                              	<th><small style="font-weight: bold;">PENDIENTES</small></th>
	                              	<th><small style="font-weight: bold;">OP</small></th>
	                              	<th><small style="font-weight: bold;">ESTATUS</small></th>
	                              	<th><small style="font-weight: bold;">ENTREGAR</small></th>
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';


	                            /*<th><small style="font-weight: bold;">HE</small></th>
	                              	<th><small style="font-weight: bold;">PI</small></th>
	                              	<th><small style="font-weight: bold;">PL</small></th>
	                              	<th><small style="font-weight: bold;">EM</small></th>
	                              	<th><small style="font-weight: bold;">HO</small></th>
	                              	<th><small style="font-weight: bold;">EP</small></th>
	                              	<th><small style="font-weight: bold;">EC</small></th>*/

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
									'.$reg->codigo.'
									</td>
									<td><small>'.$reg->descripcion.'</small></td>
									<td>'.$reg->medida.'</td>
									<td>'.$reg->color.'</td>
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
									

							        <td>
							        		<div>
                                                 <label>
                                                    <input type="checkbox" id="check_entrega'.$reg->idpg_detalle_pedidos.'" onchange="check_prod_entrega('.$reg->idpg_detalle_pedidos.');" '.$checked.' '.$disabled.'>
                                                 </label>
                                            </div>
							        		

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


		case 'listar_pedido_detalle_term_v':

			$id=$_GET['id'];

			$rspta = $diseno->listar_pedido_detalle_term($id);



						echo '	<thead>
								  
	                              <tr>

	                              	<th><small style="font-weight: bold;">CÓDIGO</small></th>
	                              	<th><small style="font-weight: bold;">DESCRIP.</small></th>
	                              	<th><small style="font-weight: bold;">TAM.</small></th>
	                              	<th><small style="font-weight: bold;">COLOR</small></th>
	                              	<th><small style="font-weight: bold;">TOTAL</small></th>
	                              	
	                              	<th><small style="font-weight: bold;">ESTATUS</small></th>
	                              
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';


	                            /*<th><small style="font-weight: bold;">HE</small></th>
	                              	<th><small style="font-weight: bold;">PI</small></th>
	                              	<th><small style="font-weight: bold;">PL</small></th>
	                              	<th><small style="font-weight: bold;">EM</small></th>
	                              	<th><small style="font-weight: bold;">HO</small></th>
	                              	<th><small style="font-weight: bold;">EP</small></th>
	                              	<th><small style="font-weight: bold;">EC</small></th>*/

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
									'.$reg->codigo.'
									</td>
									<td><small>'.$reg->descripcion.'</small></td>
									<td>'.$reg->medida.'</td>
									<td>'.$reg->color.'</td>
									<td>'.$reg->cantidad.'</td>
									
								
									

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

		/*<td>
							            <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Enviar a entrega" onclick="agregar_producto_entrega('.$reg->idpg_detalle_pedidos.');" id=""><span class="glyphicon glyphicon-record" aria-hidden="true"></span></button>
							        </td>*/

		case 'check_prod_entrega':

			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			$val_check = $_POST['val_check'];

			$rspta=$diseno->check_prod_entrega($idpg_detalle_pedidos,$val_check);
	 		echo json_encode($rspta);
	 		
		break;

		case 'quitar_prod_entrega':

			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			//$val_check = $_POST['val_check'];

			$rspta=$diseno->quitar_prod_entrega($idpg_detalle_pedidos);
	 		echo json_encode($rspta);
	 		
		break;

		case 'buscar_check_prod':

			$idpg_pedidos = $_POST['idpg_pedidos'];

			$rspta=$diseno->buscar_check_prod($idpg_pedidos);
	 		echo json_encode($rspta);
	 		
		break;

		case 'contar_salida':

			//$idpg_pedidos = $_POST['idpg_pedidos'];

			$rspta=$diseno->contar_salida();
	 		echo json_encode($rspta);
	 		
		break;

		case 'consultar_direccion':

			$idpg_pedidos = $_POST['idpg_pedidos'];
			$rspta=$diseno->consultar_direccion($idpg_pedidos);
	 		echo json_encode($rspta);
	 		
		break;

		case 'listar_salidas':

			//$id=$_GET['id'];

			$rspta = $diseno->listar_salidas();

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->seleccionado==0) {
							$back = "";
						}elseif ($reg->seleccionado==1) {
							$back = "#C6E9F4;";
						}

						if ($reg->estatus == 0) {
							$estatus="Pendiente";
							
						}elseif ($reg->estatus == 1) {
							$estatus="Listo";
							
						}

						echo '
                          	                            
								
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<br>
	                          	 	<div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10" style="background: '.$back.' padding-top: 10px; padding-bottom: 10px;" onclick="seleccionar_salida('.$reg->idsalida.');">
	                          	 		
	                          	 		<a href="#" onclick="ver_entregas('.$reg->idsalida.');">'.$reg->no_salida.' - '.$reg->fecha.' - '.$reg->hora.' - '.$reg->repartidor.' - '.$reg->vehiculo.'</a>
	                          	 		
										
	                          	 	</div> 
	                          	 	
	                          	 	<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2" align="right" style="padding: 5px 5px 5px 5px; font-size: 20px;">
	                          	 		<a href="#" onclick="Borrar_salida('.$reg->idsalida.');"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color: #A00806;"></span></a>
	                          	 	</div> 
		                          	
	                          	</div> 
	                            
						';						
					}		
		break;

		/*case 'listar_salidas_listbox':

			//$id=$_GET['id'];

			$rspta = $diseno->listar_salidas();

				echo '

					<option value="">Seleccionar</option>
				';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '
                          	                            
								<option value="'.$reg->idsalida.'">'.$reg->no_salida.' - '.$reg->fecha.' - '.$reg->hora.' - '.$reg->repartidor.' - '.$reg->vehiculo.'</option>
							
	                            
						';						
					}		
		break;*/

		case 'listar_entregas_new':

			$id=$_GET['id'];

			$rspta = $diseno->listar_entregas_new($id);

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->estatus == 0) {
							$estatus="Sin entregar";
							$back = "#FC2F22;";
						}elseif ($reg->estatus == 1) {
							$estatus="Entregado";
							$back = "#03AF2C;";
						}

						if ($reg->seleccionado==0) {
							$back2 = "";
						}elseif ($reg->seleccionado==1) {
							$back2 = "#C6E9F4;";
						}

						echo '
                          	 <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                          	 	<br>
                          	 	<div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10" style="background: '.$back2.' padding-top: 10px; padding-bottom: 10px;" onclick="seleccionar_entrega('.$reg->identrega.');">
                          	 	
                          	 		<a href="#" onclick="ver_productos('.$reg->identrega.');">'.$reg->identrega.' - '.$reg->contacto.' - '.$reg->direccion.'</a>
									
                          	 	</div> 
                          	 	
                          	 	<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2" align="right" style="padding: 5px 5px 5px 5px; font-size: 20px;">

                          	 		<a href="#" onclick=""><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color: #A00806;"></span></a>
                          	 	</div>
	                          		
                          	 </div>                            
							
	                            
						';						
					}			
		break;

		case 'listar_entregas_listbox_':

			$id=$_GET['id'];

			$rspta = $diseno->listar_entregas_new($id);

			echo '

					<option value="">Seleccionar</option>
				';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

					

						echo '
                          	 <option value="'.$reg->identrega.'">'.$reg->no_entrega.' - '.$reg->contacto.' - '.$reg->direccion.'</option>                        						
	                            
						';						
					}			
		break;

		case 'listar_entregas_listbox_':

			$id=$_GET['id'];
			

			$rspta = $diseno->listar_entregas_new($id);



						echo '	<thead>
	                              <tr>
	                              	
	                              	<th>No. Entrega</th>
	                              	<th>Datos de entrega</th>
	                              	<th>Ver</th>
	                              	
	                              
	                             
	                              	
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '

								<tr>
									
								
									
									<td>'.$reg->no_entrega.'</td>
									<td>
									- <b>'.$reg->contacto.'</b><br>
									- <b>'.$reg->direccion.'</b>
									</td>
									<td><a href="#" onclick="ver_productos2('.$reg->identrega.');">Ver</a></td>
									
									


						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_entregas_listbox':

			$id=$_GET['id'];
			$rspta = $diseno->listar_entregas_new($id);
			while ($reg = $rspta->fetch_object())
					{
						echo '

							

								<div class="form-group col-md-12 col-sm-12" onclick="ver_productos2('.$reg->identrega.',\''.$reg->idpedido.'\');" style="background: #2D4359; cursor: pointer; padding-top: 20px; padding-left: 20px;">
									<b style="font-size: 20px; color: #fff;">'.$reg->no_entrega.'</b> - <b <b style="color: #fff;">'.$reg->nom_cliente.'</b><br>
									<span style="color; #E1E5E8;">Contacto: </span><b style="color: #fff;">'.$reg->contacto.'</b><br>
									
									<hr width="100%">
								</div>
								
								
                           
						
						';
						
					}

			
		break;

		case 'guardar_entrega':

			$idsalida = $_POST['idsalida'];
			$cliente_new_e = $_POST['cliente_new_e'];
			$contacto_new_e = $_POST['contacto_new_e'];
			$dir_entrega_new_e = $_POST['dir_entrega_new_e'];
			$num_entregas = $_POST['num_entregas'];			
			$telefono_new_e = $_POST['telefono_new_e'];
			$horario_new_e = $_POST['horario_new_e'];
			$condic_new_e = $_POST['condic_new_e'];
			$medio_new_e = $_POST['medio_new_e'];
			$idpedido = $_POST['idpedido'];

			$rspta=$diseno->guardar_entrega($idsalida,$cliente_new_e,$contacto_new_e,$dir_entrega_new_e,$num_entregas,$telefono_new_e,$horario_new_e,$condic_new_e,$medio_new_e,$idpedido);
	 		echo json_encode($rspta);
	 		
		break;

		case 'listar_productos_new':

			$id=$_GET['id'];
			

			$rspta = $diseno->listar_productos_new($id);



						echo '	<thead>
	                              <tr>
	                              	<th width="30%">PRODUCTO</th>
	                              	<th width="10%">CONTROL</th>
	                              
	                              	<th width="10%">CANT.</th>
	                              	
	                              	<th width="20%">LOTE</th>
	                              	
	                              	<th width="20%">OBSERV.</th>
	                              	
	                              	<th width="10%"></th>
	                             
	                              	
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->cont_lote>0) {
							$visib_lote = "visible;";
						}elseif ($reg->cont_lote==0) {
							$visib_lote = "hidden;";
						}

						$iddetalle_pedido = $reg->idproducto;

						echo '

								<tr>
									
								
									
									<td>
									<b>'.$reg->codigo.'</b><br>
									'.$reg->descripcion.'<br>
									MEDIDAS: <b>'.$reg->medida.'</b>, COLOR: <b>'.$reg->color.'</b><br>
									OBSERVACIÓN: <small><b>'.$reg->observacion.'</b></small>
									</td>
									<td><hr width="100%" style="margin-top: 4px;"><label style="font-size: 20px;">'.$reg->no_control.'</label></td>
									
									<td>
										<hr width="100%" style="margin-top: 4px;">
										<input type="text" class="form-control" id="input_cant'.$reg->identrega_detalle.'" onchange="guardar_cantidad('.$reg->identrega_detalle.');" value="'.$reg->cantidad.'" disabled>
									
									</td>
									
									<td>
									<i class="fa fa-info-circle" title="Lotes de produccíon" style="cursor: pointer; font-size: 20px;" onclick="ver_lotes_vale_alm('.$iddetalle_pedido.',\''.$reg->identrega_detalle.'\');"></i>
									<input type="text" class="form-control" id="input_lote'.$reg->identrega_detalle.'" onchange="guardar_lote('.$reg->identrega_detalle.');" value="'.$reg->lote.'">
									</td>
									
									<td>

									<textarea class="form-control" id="input_observ'.$reg->identrega_detalle.'" onchange="guardar_obs('.$reg->identrega_detalle.');">'.$reg->observaciones.'</textarea>
									
									</td>
									
									<td><span class="glyphicon glyphicon-trash" aria-hidden="true" style="cursor:pointer; color: red;" onclick="borrar_prod_salida('.$reg->identrega_detalle.',\''.$reg->cantidad.'\',\''.$reg->no_salida_ent.'\',\''.$reg->idproducto.'\',\''.$reg->idpedido.'\');"></span></td>
	                             </tr>


						';
						
					}

			$rspta = $diseno->listar_productos_new_add($id);

			while ($reg = $rspta->fetch_object())
					{

						echo '

								<tr>
									
								
									
									<td>
									<b>'.$reg->codigo.'</b><br>
									'.$reg->descripcion.'<br>
									
									
									</td>
									
									<td></td>
									<td>
										<hr width="100%" style="margin-top: 4px;">
										<input type="text" class="form-control" id="input_cant'.$reg->identrega_detalle.'" onchange="guardar_cantidad('.$reg->identrega_detalle.');" value="'.$reg->cantidad.'" disabled>
									</td>
									
									<td><input type="text" class="form-control" id="input_lote'.$reg->identrega_detalle.'" onchange="guardar_lote('.$reg->identrega_detalle.');" value="'.$reg->lote.'"></td>
									<td></td>
									<td>
									<textarea class="form-control" id="input_observ'.$reg->identrega_detalle.'" onchange="guardar_obs('.$reg->identrega_detalle.');">'.$reg->observaciones.'</textarea>
									</td>
									
									<td><span class="glyphicon glyphicon-trash" aria-hidden="true" style="cursor:pointer; color: red;" onclick="borrar_prod_salida('.$reg->identrega_detalle.',\''.$reg->cantidad.'\',\''.$reg->no_salida_ent.'\',\''.$reg->idproducto.'\',\''.$reg->idpedido.'\');"></span></td>  
	                             </tr>


						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_productos_new_salidas':

			$id=$_GET['id'];

			$rspta = $diseno->listar_productos_new_salidas($id);



						echo '	<thead>
	                              <tr>
	                              	<th># ENTREGA</th>
	                              	<th>CODIGO</th>
	                              	<th>DESCRIPCIÓN</th>
	                              	<th>MEDIDAS</th>
	                              	<th>COLOR</th>
	                              	<th>OBSERVACIÓN</th>
	                              	<th>CANTIDAD</th>
	                              	<th>CONTROL</th>
	                              
	                             
	                              	
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '

								<tr>
									
								
									<td align="center">'.$reg->no_entrega.'</td>
									<td align="center">'.$reg->codigo.'</td>
									<td><small>'.$reg->descripcion.'</td>
									<td align="center">'.$reg->medida.'</td>
									<td align="center">'.$reg->color.'</td>
									<td><small>'.$reg->observacion.'</td>
									
									<td align="center">'.$reg->cantidad.'</td>
									<td align="center">'.$reg->no_control.'</td>   
	                             </tr>


						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_prod_selec':

			$id=$_GET['id'];
			

			$rspta = $diseno->listar_prod_selec($id);



						echo '	<thead>
	                              <tr>
	                              	<th><small>CODIGO</small></th>
	                              	<th><small>DESCRIPCIÓN</small></th>
	                              	<th><small>MEDIDAS</small></th>
	                              	<th><small>COLOR</small></th>
	                              	<th><small>OBSERVACIÓN</small></th>
	                              	<th><small>CANT. TOT.</small></th>
	                              	<th><small>CANT.</small></th>
	                              	<th><small>PEND.</small></th>
	                              	<th><small>MODIF.</small></th>
	                             	<th><small>QUITAR</small></th>
	                              	
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						//$cant = $reg->cantidad - $reg->cant_entregada;

						echo '

								<tr>
									
								
									
									<td><small><b>'.$reg->codigo.'</b></small></td>
									<td><small><b>'.$reg->descripcion.'</b></small></td>
									<td><small><b>'.$reg->medida.'</b></small></td>
									<td><small><b>'.$reg->color.'</b></small></td>
									<td><small><b>'.$reg->observacion.'</b></small></td>
									<td><small><b>'.$reg->cantidad.'</b></small></td>
									<td><input type="number" class="form-control" id="idproducto_enviar'.$reg->idpg_detalle_pedidos.'" value="0" onchange="act_cant_entregar('.$reg->idpg_detalle_pedidos.');" disabled></td>
									<td><small><b>'.$reg->pendiente.'</b></small></td>
									<td>

											<div>
                                                 <label>
                                                    <input type="checkbox" id="check_mod_cant_ent'.$reg->idpg_detalle_pedidos.'" onchange="check_activar('.$reg->idpg_detalle_pedidos.');">
                                                 </label>
                                            </div>

									</td>
									<td><a href="#" onclick="quitar_prod_entrega('.$reg->idpg_detalle_pedidos.');" style="color: red;"><b>X</b
									></a>
									</td>
											
									   
	                             </tr>


						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'contar_ceros':

			$idpedido = $_POST['idpedido'];

			$rspta=$diseno->contar_ceros($idpedido);
	 		echo json_encode($rspta);
	 		
		break;

		

		case 'act_cant_entregar':

			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			$cantidad = $_POST['cantidad'];


			$rspta=$diseno->act_cant_entregar($idpg_detalle_pedidos,$cantidad);
	 		echo json_encode($rspta);
	 		
		break;

		case 'consul_pend_ent':

			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			//$cantidad = $_POST['cantidad'];


			$rspta=$diseno->consul_pend_ent($idpg_detalle_pedidos);
	 		echo json_encode($rspta);
	 		
		break;

		case 'buscar_pedido_datos':

			$idpg_pedidos = $_POST['idpg_pedidos'];
			//$cantidad = $_POST['cantidad'];


			$rspta=$diseno->buscar_pedido_datos($idpg_pedidos);
	 		echo json_encode($rspta);
	 		
		break;

		case 'consul_entrega':

			$identrega = $_POST['identrega'];
			$rspta=$diseno->consul_entrega($identrega);
	 		echo json_encode($rspta);
	 		
		break;

		case 'seleccionar_salida':

			$idsalida = $_POST['idsalida'];
			$rspta=$diseno->seleccionar_salida($idsalida);
	 		echo json_encode($rspta);
	 		
		break;

		case 'seleccionar_entrega':

			$identrega = $_POST['identrega'];
			$rspta=$diseno->seleccionar_entrega($identrega);
	 		echo json_encode($rspta);
	 		
		break;

		case 'guardar_salida':

			$no_salida = $_POST['no_salida'];
			$fecha_hora = $_POST['fecha_hora'];
			$idrepartidor = $_POST['idrepartidor'];
			$idvehiculo = $_POST['idvehiculo'];
			//$id2 = $_POST['id2'];

			$rspta=$diseno->guardar_salida($no_salida,$fecha_hora,$idrepartidor,$idvehiculo);
	 		echo json_encode($rspta);
	 		
		break;

		case 'upd_salida':

			$idsalida = $_POST['idsalida'];
			$fecha_hora = $_POST['fecha_hora'];
			$idrepartidor = $_POST['idrepartidor'];
			$idvehiculo = $_POST['idvehiculo'];
			//$id2 = $_POST['id2'];

			$rspta=$diseno->upd_salida($idsalida,$fecha_hora,$idrepartidor,$idvehiculo);
	 		echo json_encode($rspta);
	 		
		break;

		case 'ult_salida':

			$rspta=$diseno->ult_salida();
	 		echo json_encode($rspta);
	 		
		break;


		case 'listar_choferes':


			$rspta = $diseno->listar_choferes();

					echo '<option value="">Seleccionar</option>';

			while ($reg = $rspta->fetch_object())
					{

						//$cant = $reg->cantidad - $reg->cant_entregada;

						echo '

							<option value="'.$reg->idrepartidor.'">'.$reg->nombre.'</option>


						';


						
					}

					
		break;

		case 'listar_vehiculos':


			$rspta = $diseno->listar_vehiculos();

					echo '<option value="">Seleccionar</option>';

			while ($reg = $rspta->fetch_object())
					{

						//$cant = $reg->cantidad - $reg->cant_entregada;

						echo '

							<option value="'.$reg->idvehiculo.'">'.$reg->nombre.'</option>


						';


						
					}

					
		break;


		case 'deselect_salida':

			$rspta=$diseno->deselect_salida();
	 		echo json_encode($rspta);
	 		
		break;

		case 'Borrar_salida':

			$idsalida = $_POST['idsalida'];

			$rspta=$diseno->Borrar_salida($idsalida);
	 		echo json_encode($rspta);
	 		
		break;

		case 'buscar_datos_usuario':

			$idusuario = $_POST['idusuario'];

			$rspta=$diseno->buscar_datos_usuario($idusuario);
	 		echo json_encode($rspta);
	 		
		break;


		case 'contar_entregas_dia':

			$idsalida = $_POST['idsalida'];

			$rspta=$diseno->contar_entregas_dia($idsalida);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_chofer':

			$nom_chofer = $_POST['nom_chofer'];

			$rspta=$diseno->guardar_chofer($nom_chofer);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_vehiculo':

			$nom_vehiculo = $_POST['nom_vehiculo'];

			$rspta=$diseno->guardar_vehiculo($nom_vehiculo);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;







































		case 'agregar_producto_entrega':

			$fecha = $_POST['fecha'];
			//$id2 = $_POST['id2'];

			$rspta=$diseno->agregar_producto_entrega($fecha);
	 		echo json_encode($rspta);
	 		
		break;

		case 'crear_salida':

			$fecha_hora = $_POST['fecha_hora'];
			//$id2 = $_POST['id2'];

			$rspta=$diseno->crear_salida($fecha_hora);
	 		echo json_encode($rspta);
	 		
		break;

		

		case 'listar_salidas2':

			//$id=$_GET['id'];

			$rspta = $diseno->listar_salidas();

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '

							<div class="col-md-3 col-sm-3  tile" align="left" onclick="mostrar_salida('.$reg->idsalida.');" id="div_salida'.$reg->idsalida.'">
                            	                            
								<a href="#"><h2>'.$reg->fecha.'<br>'.$reg->repartidor.'<br>'.$reg->vehiculo.'</h2></a>
	                            
	                         </div>

						';						
					}

			
		break;

		case 'crear_entrega':

			$idsalida = $_POST['idsalida'];
			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];

			$rspta=$diseno->crear_entrega($idsalida,$idpg_detalle_pedidos);
	 		echo json_encode($rspta);
	 		
		break;

		case 'consultar_salida':

			$idsalida = $_POST['idsalida'];

			$rspta=$diseno->consultar_salida($idsalida);
	 		echo json_encode($rspta);
	 		
		break;

		case 'listar_salidas_entregas':

			$id=$_GET['id'];

			$rspta = $diseno->listar_salidas_entregas($id);

			while ($reg = $rspta->fetch_object())
					{
						 if ($reg->interior<>"" AND $reg->interior<>null) {
						 	$interior = "Int. ".$reg->interior;
						 }elseif ($reg->interior=="" OR $reg->interior==null) {
						 	$interior = "";
						 }
						

						echo '

								<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
									
                              		<a href="#" onclick="mostrar_productos('.$reg->identrega.');">Contacto: '.$reg->contacto.'<br>
									<h6>'.$reg->calle.', '.$reg->numero.' '.$interior.'<br>'.$reg->colonia.'</h6></a>
									<hr width="100%">
                          		</div>


						';


						
					}

			
		break;

		case 'consultar_entrega':

			$idsalida = $_POST['idsalida'];

			$rspta=$diseno->consultar_entrega($idsalida);
	 		echo json_encode($rspta);
	 		
		break;

		

		case 'listar_entregas_detalles':

			$id=$_GET['id'];
			$direccion=$_GET['direccion'];

			$rspta = $diseno->listar_entregas_detalles($id,$direccion);



						echo '	<thead>
	                              <tr>
	                              	<th>CODIGO</th>
	                              	<th>DESCRIPCIÓN</th>
	                              	<th>MEDIDAS</th>
	                              	<th>COLOR</th>
	                              	<th>OBSERVACIÓN</th>
	                              	<th>CANTIDAD</th>
	                              
	                             
	                              	
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '

								<tr>
									
								
									
									<td>'.$reg->codigo.'</td>
									<td>'.$reg->descripcion.'</td>
									<td>'.$reg->medida.'</td>
									<td>'.$reg->color.'</td>
									<td>'.$reg->observacion.'</td>
									<td><input type="number" class="form-control" id="" value="'.$reg->cantidad.'"></td>
									
									   
	                             </tr>


						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_salidas_select':

			//$id=$_GET['id'];

			$rspta = $diseno->listar_salidas();

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '

							<div class="col-md-12 col-sm-12  tile" align="left" onclick="mostrar_salida_select('.$reg->idsalida.');" id="div_salida'.$reg->idsalida.'">
                            	                            
								<a href="#">Fecha de entrega: '.$reg->fecha.'<br>Hora de salida: '.$reg->hora.'<br>Conductor: Don Jorge<br>Vehiculo: Nissan</a>
	                            <hr width="100%">
	                         </div>

						';						
					}

			
		break;

		case 'listar_salidas_entregas2':

			$id=$_GET['id'];

			$rspta = $diseno->listar_salidas_entregas($id);

			while ($reg = $rspta->fetch_object())
					{
						 if ($reg->interior<>"" AND $reg->interior<>null) {
						 	$interior = "Int. ".$reg->interior;
						 }elseif ($reg->interior=="" OR $reg->interior==null) {
						 	$interior = "";
						 }
						

						echo '

								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
									
                              		<a href="#" onclick="select_entrega('.$reg->identrega.');">Contacto: '.$reg->contacto.'<br>
									Dirección: '.$reg->calle.', '.$reg->numero.' '.$interior.' Col. '.$reg->colonia.'</a>
									<hr width="100%">
                          		</div>


						';


						
					}

			
		break;

		case 'buscar_salida':

			$idsalida = $_POST['idsalida'];
			$rspta=$diseno->buscar_salida($idsalida);
	 		echo json_encode($rspta);
	 		
		break;

		case 'guardar_producto':

			$identrega = $_POST['identrega'];
			$idproducto = $_POST['idproducto'];

			$rspta=$diseno->guardar_producto($identrega,$idproducto);
	 		echo json_encode($rspta);
	 		
		break;

		case 'listar_salidas_set':

			$id=$_GET['id'];

			$rspta = $diseno->listar_salidas_set($id);	

			while ($reg = $rspta->fetch_object())
					{
						

						echo '


	                        <div class="col-md-12 col-sm-12  tile" align="left" onclick="mostrar_entregas('.$reg->idsalida.');">
                            	                            
								<a href="#">'.$reg->fecha.' - '.$reg->hora.'</a>
	                            <hr width="100%">
	                        </div>

						';


						
					}

			
		break;

		

		

		case 'listar_entregas_set':

			$id=$_GET['id'];

			$rspta = $diseno->listar_entregas_set($id);	

			while ($reg = $rspta->fetch_object())
					{
						

						echo '

							<div class="col-md-12 col-sm-12  tile" align="left" onclick="mostrar_entregas('.$reg->idsalida.');">
                            	                            
								<a href="#">'.$reg->direccion.'</a>
	                            <hr width="100%">
	                        </div>

						';


						
					}

			
		break;

		case 'revisar_sinfecha':

			//$id2 = $_POST['id2'];

			$rspta=$diseno->revisar_sinfecha();
	 		echo json_encode($rspta);
	 		
		break;

		case 'listar_entregas_prog':
			

			$rspta = $diseno->listar_entregas_prog();



						echo '<thead>
                                <tr>
                                  <th>No. Salida</th>
                                  <th>Fecha de salida</th>
                                  <th>Chofer</th>
                                  <th>Vehiculo</th>
                                  <th>Contacto</th>
                                  <th>Dirección</th>
                                  <th>Estatus</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->estatus==0) {
							$estatus = "En entrega";
						}

						echo '

								<tr>
                                  <td>'.$reg->idsalida.'</td>
                                  <td>'.$reg->fecha_salida.'</td>
                                  <td>'.$reg->idusuario.'</td>
                                  <td>'.$reg->idvehiculo.'</td>
                                  <td>'.$reg->contacto.'</td>
                                  <td>'.$reg->direccion.'</td>
                                  <td>'.$estatus.'</td>
                                  
                                 
                                </tr>


						';
						
					}

						echo '</tbody>';
			
		break;

		case 'listar_coment_prod':
			
			$id=$_GET['id'];

			$rspta = $diseno->listar_coment_prod($id);



						echo '<thead>
                                <tr>
                                  <th>OP</th>
                                  <th>AREA</th>
                                  <th>CODIGO</th>
                                  <th>DESCRIPCIÓN</th>
                                  <th>OBSERVACIÓN</th>
                                  
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '

								<tr>
                                  <td>'.$reg->no_op.'</td>
                                  <td>'.$reg->nom_area.'</td>
                                  <td>'.$reg->codigo.'</td>
                                  <td>'.$reg->descrip.'</td>
                                  <td>'.$reg->comentario.'</td>
                                 
                                  
                                 
                                </tr>


						';
						
					}

						echo '</tbody>';
			
		break;

		case 'listar_etiquetas':
			

			$rspta = $diseno->listar_etiquetas();

			while ($reg = $rspta->fetch_object())
					{

						echo '

								<p></p>Nombre: <b>'.$reg->nombre.'</b></p>
								<p></p><b>'.$reg->concepto1.' </b>'.$reg->cantidad1.'</p>
								<p></p><b>'.$reg->concepto2.' </b>'.$reg->cantidad2.'</p>
						';
						
					}

		break;

		case 'listar_mensajes':
		
				//$num = 0;

				$idusuario=$_GET['idusuario'];

				$rspta = $diseno->listar_mensajes($idusuario);
			
				while ($reg = $rspta->fetch_object())
						{
							//echo '<div style="background: #ffffff;" width="30px"></div>';

							//$num = $num+1;

							if ($reg->rev_notif==1) {
								$color = "#D5F2FB;";
							}elseif ($reg->rev_notif<>1) {
								$color = "#ffffff;";
							}




							echo '


								<li class="nav-item" style="background: '.$color.'">
			                      <a class="dropdown-item" href="#" onclick="mostrar_mensajes_control_select('.$reg->idpg_pedidos.');">
			                        
			                        <span>
			                          <span>Control:'. $reg->no_control .'</span>
			                          <span class="time">'. $reg->fecha_hora .'</span>
			                        </span><br>
			                        <span class="message">
			                        '. $reg->nom_usuario .': <b>'. $reg->mensaje .' </b>  
			                        </span>
			                        

			                      </a>
			                      
			                    </li>

									';

							
						}

						echo '

								<li class="nav-item">
			                        <div class="text-center">
			                          <a class="dropdown-item" onclick="mostrar_todo_mensajes();">
			                            <strong>Ver todos los mensajes</strong>
			                            <i class="fa fa-angle-right"></i>
			                          </a>
			                        </div>
			                    </li>

						';

						
				
		break;

	
		case 'consul_estatus_pedido':

			$idpedido = $_POST['idpedido'];

			$rspta=$diseno->consul_estatus_pedido($idpedido);
	 		echo json_encode($rspta);
	 		
		break;

		case 'contar_estatus_ped':

			$idpedido = $_POST['idpedido'];

			$rspta=$diseno->contar_estatus_ped($idpedido);
	 		echo json_encode($rspta);
	 		
		break;


		case 'guardar_prod_ent':
			
			$idpedido=$_GET['idpedido'];
			$identrega=$_GET['identrega'];
			$idsalida=$_GET['idsalida'];

			$rspta = $diseno->guardar_prod_ent($idpedido,$identrega);

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo $reg->idpg_detalle_pedidos." - ".$reg->identrega_detalle_s."<br>";

						$idpg_detalle_pedidos = $reg->idpg_detalle_pedidos;


						if ($reg->identrega_detalle_s==0 OR $reg->identrega_detalle_s==null OR $reg->identrega_detalle_s=="") {



							$servername = 'localhost';
							$username = 'u690371019_pgmanage';
							//$username = 'root';
							$password = "A=tSXZ4z";
							//$password = "";
							$dbname = "u690371019_pgmanage";
							$conn = new mysqli($servername, $username, $password, $dbname);

									$sql="INSERT INTO salidas_entregas_detalles (identrega,idproducto,cantidad,idpedido,idsalida) SELECT '$identrega','$idpg_detalle_pedidos',IF(prod_entregar=0,cantidad,prod_entregar),idpg_pedidos,'$idsalida' FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
									$result = $conn->query($sql);

									$sql2="UPDATE pg_detalle_pedidos SET prod_entregar = 0 WHERE idpg_detalle_pedidos='$idpg_detalle_pedidos'";
									$result = $conn->query($sql2);

							$conn->close();
						}
						
					}
			
		break;

		case 'guardar_producto_nuevo':

			$codigo = $_POST['codigo'];
			$nombre = $_POST['nombre'];
			$tipo = $_POST['tipo'];
			$modelo = $_POST['modelo'];
			//$submodelo = $_POST['submodelo'];
			$tamano = $_POST['tamano'];
			$estatus = $_POST['estatus'];
			$tipo_fab = $_POST['tipo_fab'];

			$rspta=$diseno->guardar_producto_nuevo($codigo,$nombre,$tipo,$modelo,$tamano,$estatus,$tipo_fab);
	 		echo json_encode($rspta);
	 		
		break;

		
		case 'borrar_entrega2':

			$identrega = $_POST['identrega'];

			$rspta=$diseno->borrar_entrega2($identrega);
	 		echo json_encode($rspta);
	 		
		break;




	}


?>