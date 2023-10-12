<?php
require_once "../modelos/Nuevo_pedido.php";

$nuevo_pedido=new Nuevo_pedido();

switch ($_GET["op"])
	{



		case 'listar_tipos':
			
			$rspta = $nuevo_pedido->listar_tipos();

						echo '<option value="">Tipo</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

							<option value="'.$reg->id_tipo.'">'.$reg->nombre.'</option>	

						';
	
					}			
			
		break;

		case 'listar_modelo':

			$id=$_GET['id'];
			//$id2=$_GET['id2'];
			
			$rspta = $nuevo_pedido->listar_modelo($id);

						echo '<option value="">Modelo</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->id_modelo.'">'.$reg->nombre.'</option>	

						';
	
					}			
			
		break;

		case 'listar_grados':

			$id=$_GET['id'];
			$idmodelo=$_GET['idmodelo'];
			
			$rspta = $nuevo_pedido->listar_grados($id,$idmodelo);

						echo '<option value="">Tamaños</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

								<option value="'.$reg->id_tamanio.'">'.$reg->nombre.'</option>	

						';
	
					}			
			
		break;













		case 'listar_tamano':

			$codigo_group=$_GET['codigo_group'];
			
			$rspta = $nuevo_pedido->listar_tamano($codigo_group);

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						//if ($reg->id_tipo==1) {
							$medida1 = $reg->medida1;
							$medida2 = $reg->medida2;
							$medida3 = $reg->medida3;
							$medida4 = "";
							$unidad = $reg->unidad;

							echo '

									<option value="'.$reg->idtbl_prod.'">'.$medida1.' '.$unidad.' x '.$medida2.' '.$unidad.'</option>	

							';
						//}

							
	
					}			
			
		break;

		case 'listar_colores':

			$idtbl_prod=$_GET['idtbl_prod'];
			
			
			$rspta = $nuevo_pedido->listar_colores($idtbl_prod);

						

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: auto !important;">
									<div style="cursor: pointer;" onclick="set_color_codigo('.$reg->idtblprod_colores.');">
												
											
											<p style="background-color: '.$reg->codigo_hex.'; padding: 10px; border-radius: 10px; border-style: ridge !important; border-color: #DFE2E5;">
												<small><b>'.$reg->codigo.'</b></small><br>
												<b>'.$reg->nombre.'</b><br>
												<b>'.$reg->detalle.'</b>
											</p>
									</div>
								</div>

						';
	
					}			
			
		break;

		case 'listar_colores_esp':

			$idtbl_prod=$_GET['idtbl_prod'];
			
			
			$rspta = $nuevo_pedido->listar_colores_esp($idtbl_prod);

						

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '


							
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: auto !important;">
									<div style="cursor: pointer;" onclick="set_color_codigo('.$reg->idtblprod_colores.');">
												
											
											<p style="background-color: '.$reg->codigo_hex.'; padding: 10px; border-radius: 10px; border-style: ridge !important; border-color: #DFE2E5;">
												<small><b>'.$reg->codigo.'</b></small><br>
												<b>'.$reg->nombre.'</b><br>
												<b>'.$reg->detalle.'</b>
											</p>
									</div>
								</div>
								
								

								

						';
	
					}			
			
		break;

		case 'listar_colores_prod':
			
			$idtbl_prod=$_GET['idtbl_prod'];
			//$id2=$_GET['id2'];
			
			$rspta = $nuevo_pedido->listar_colores_prod($idtbl_prod);



						echo '	<thead>
								  
	                              <tr>
	                              	<th width="20%">No.</th>
	                              	
	                              	<th width="80%" colspan="3">Color</th>
	                              	
	                              	
	                             	
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

	                          
	                            $consec = 1;
			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

				

						echo '

								<tr>
									<td>'.$consec.'</td>
									<td>'.$reg->nombre.'</td>
									<td style="background-color: '.$reg->codigo.'; width: 30px;"></td>
									<td><span class="glyphicon glyphicon-trash" aria-hidden="true" style="cursor: pointer;" onclick="borrar_color_prod('.$reg->idtblprod_colores.');"></span></td>
	                             </tr>	

						';

						$consec = $consec+1;
						
					}

						
			
		break;

		case 'listar_productos_resul_tipo_buscado':
			
			$codigo_buscar=$_GET['codigo_buscar'];
			
			$rspta = $nuevo_pedido->listar_productos_resul_tipo_buscado($codigo_buscar);


	                         $consec=1;

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '


	                             <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4" style="height: 500px;">
	                             	
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_img_prod_var'.$reg->idtbl_prod.'">
	                             		<img src="'.$reg->codigo_s.'" width="80%">
	                             	</div>
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 barra_tbl_variantes" id="div_inv_variante'.$reg->idtbl_prod.'" style="display:none; height: 200px; overflow:scroll;">
	                             		
	                             	</div>

	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		<hr width="100%">	
	                             	</div>
	                             		
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		'.$consec.' - <b>'.$reg->codigo_group.'<br></b>_'.$reg->nombre_group.'<br>
		                             	
	                             	</div>
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		
		                             	<p style="font-size: 20px;">Exist.: <b>256</b> | Variaciones: 5</p>
	                             	</div>
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		<button type="button" class="btn btn-success btn-xs" style="" onclick="mostrar_detalle_prod('.$reg->idtbl_prod.');">Seleccionar</button>
	                             		<button type="button" class="btn btn-success btn-xs" style=""><span class="glyphicon glyphicon-list-alt" aria-hidden="true" onclick="ver_lista_variante_prod('.$reg->idtbl_prod.');"></span></button>
	                             		<button type="button" class="btn btn-success btn-xs" style="" onclick="ver_imagen_prod('.$reg->idtbl_prod.');"><i class="fa fa-cube"></i></button>
	                             	</div>
		                             	
                                 </div>

						';

						$consec = $consec+1;
						
					}

					//<img src="http://drive.google.com/uc?export=view&id='.$reg->codigo_s.'" width="80%"><br>

						$consec = $consec-1;

						echo '
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             	<p style="color: white;"><b id="encontrados">'.$consec.'</b> Productos encontrados</p>
                                 </div>				

						';
			
		break;

		case 'listar_productos_resul_tipo':
			
			$id=$_GET['id'];
			
			$rspta = $nuevo_pedido->listar_productos_resul_tipo($id);


	                         $consec=1;

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '


	                             <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4" style="height: 500px;">
	                             	
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_img_prod_var'.$reg->idtbl_prod.'">
	                             		<img src="'.$reg->codigo_s.'" width="80%">
	                             	</div>
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 barra_tbl_variantes" id="div_inv_variante'.$reg->idtbl_prod.'" style="display:none; height: 200px; overflow:scroll;">
	                             		
	                             	</div>

	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		<hr width="100%">	
	                             	</div>
	                             		
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		'.$consec.' - <b>'.$reg->codigo_group.'<br></b>_'.$reg->nombre_group.'<br>
		                             	
	                             	</div>
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		
		                             	<p style="font-size: 20px;">Exist.: <b>256</b> | Variaciones: 5</p>
	                             	</div>
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		<button type="button" class="btn btn-success btn-xs" style="" onclick="mostrar_detalle_prod('.$reg->idtbl_prod.');">Seleccionar</button>
	                             		<button type="button" class="btn btn-success btn-xs" style=""><span class="glyphicon glyphicon-list-alt" aria-hidden="true" onclick="ver_lista_variante_prod('.$reg->idtbl_prod.');"></span></button>
	                             		<button type="button" class="btn btn-success btn-xs" style="" onclick="ver_imagen_prod('.$reg->idtbl_prod.');"><i class="fa fa-cube"></i></button>
	                             	</div>
		                             	
                                 </div>

						';

						$consec = $consec+1;
						
					}

					//<img src="http://drive.google.com/uc?export=view&id='.$reg->codigo_s.'" width="80%"><br>

						$consec = $consec-1;

						echo '
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             	<p style="color: white;"><b id="encontrados">'.$consec.'</b> Productos encontrados</p>
                                 </div>				

						';
			
		break;

		case 'listar_productos_resul_tipo_modelo':
			
			$id=$_GET['id'];
			$idmodelo=$_GET['idmodelo'];
			
			$rspta = $nuevo_pedido->listar_productos_resul_tipo_modelo($id,$idmodelo);


	                         $consec=1;

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '


	                             <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4" style="height: 500px;">
	                             	
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_img_prod_var'.$reg->idtbl_prod.'">
	                             		<img src="'.$reg->codigo_s.'" width="80%">
	                             	</div>
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 barra_tbl_variantes" id="div_inv_variante'.$reg->idtbl_prod.'" style="display:none; height: 200px; overflow:scroll;">
	                             		
	                             	</div>

	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		<hr width="100%">	
	                             	</div>
	                             		
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		'.$consec.' - <b>'.$reg->codigo_group.'<br></b>_'.$reg->nombre_group.'<br>
		                             	
	                             	</div>
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		
		                             	<p style="font-size: 20px;">Exist.: <b>256</b> | Variaciones: 5</p>
	                             	</div>
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		<button type="button" class="btn btn-success btn-xs" style="" onclick="mostrar_detalle_prod('.$reg->idtbl_prod.');">Seleccionar</button>
	                             		<button type="button" class="btn btn-success btn-xs" style=""><span class="glyphicon glyphicon-list-alt" aria-hidden="true" onclick="ver_lista_variante_prod('.$reg->idtbl_prod.');"></span></button>
	                             		<button type="button" class="btn btn-success btn-xs" style="" onclick="ver_imagen_prod('.$reg->idtbl_prod.');"><i class="fa fa-cube"></i></button>
	                             	</div>
		                             	
                                 </div>

						';

						$consec = $consec+1;
						
					}

						$consec = $consec-1;

						echo '
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             	<p style="color: white;"><b id="encontrados">'.$consec.'</b> Productos encontrados</p>
                                 </div>				

						';
			
		break;

		case 'listar_productos_resul_tipo_modelo_tam':
			
			$id=$_GET['id'];
			$idmodelo=$_GET['idmodelo'];
			$idtam=$_GET['idtam'];
			
			$rspta = $nuevo_pedido->listar_productos_resul_tipo_modelo_tam($id,$idmodelo,$idtam);


	                         $consec=1;

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '


	                             <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4" style="height: 500px;">
	                             	
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_img_prod_var'.$reg->idtbl_prod.'">
	                             		<img src="'.$reg->codigo_s.'" width="80%">
	                             	</div>
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 barra_tbl_variantes" id="div_inv_variante'.$reg->idtbl_prod.'" style="display:none; height: 200px; overflow:scroll;">
	                             		
	                             	</div>

	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		<hr width="100%">	
	                             	</div>
	                             		
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		'.$consec.' - <b>'.$reg->codigo_group.'<br></b>_'.$reg->nombre_group.'<br>
		                             	
	                             	</div>
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		
		                             	<p style="font-size: 20px;">Exist.: <b>256</b> | Variaciones: 5</p>
	                             	</div>
	                             	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             		<button type="button" class="btn btn-success btn-xs" style="" onclick="mostrar_detalle_prod('.$reg->idtbl_prod.');">Seleccionar</button>
	                             		<button type="button" class="btn btn-success btn-xs" style="" onclick="ver_lista_variante_prod('.$reg->idtbl_prod.');"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></button>
	                             		<button type="button" class="btn btn-success btn-xs" style="" onclick="ver_imagen_prod('.$reg->idtbl_prod.');"><i class="fa fa-cube"></i></button>
	                             	</div>
		                             	
                                 </div>

						';

						$consec = $consec+1;
						
					}

						$consec = $consec-1;

						echo '
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                             	<p style="color: white;"><b id="encontrados">'.$consec.'</b> Productos encontrados</p>
                                 </div>				

						';
			
		break;







		case 'listar_productos_resul_modelo':
			
			$id=$_GET['id'];
			$id2=$_GET['id2'];
			
			$rspta = $nuevo_pedido->listar_productos_resul_modelo($id,$id2);



						echo '	<thead>
								  
	                              <tr>
	                              	<th>#</th>
	                              	<th>Codigo</th>	
	                              	<th>Nombre</th>
	                              	
	                              	<th>Tamaño/Medidas</th>
	                             
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

	                            $consec=1;

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

				

						echo '

								<tr>
									<td>'.$consec.'</td>
									<td>'.$reg->codigo_match.'</td>
									<td>'.$reg->descripcion.'</td>
									
	                                <td>'.$reg->nom_tamano.'</td>
									
									
	                                
	                             </tr>	

						';

						$consec = $consec+1;


						
					}

						$consec = $consec-1;

						echo '

								<tr>
									<td colspan="4"><b id="encontrados">'.$consec.'</b> Productos encontrados</td>
	                            </tr>
						</tbody>
							  

						';
			
		break;

		case 'buscar_codigo_group':
		
			$select_busqueda_tipo = $_POST['select_busqueda_tipo'];

			$rspta=$nuevo_pedido->buscar_codigo_group($select_busqueda_tipo);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_medidas_indep':
		
			$select_busqueda_tamano = $_POST['select_busqueda_tamano'];

			$rspta=$nuevo_pedido->buscar_medidas_indep($select_busqueda_tamano);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_color':
		
			$idtbl_prod = $_POST['idtbl_prod'];
			$codigo = $_POST['codigo'];
			$nombre = $_POST['nombre'];

			$rspta=$nuevo_pedido->guardar_color($idtbl_prod,$codigo,$nombre);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'borrar_color_prod':
		
			$idtblprod_colores = $_POST['idtblprod_colores'];
		

			$rspta=$nuevo_pedido->borrar_color_prod($idtblprod_colores);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_datos_prod':
		
			$idtbl_prod = $_POST['idtbl_prod'];
		

			$rspta=$nuevo_pedido->buscar_datos_prod($idtbl_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_nom_tamano':
		
			$id_tamanio = $_POST['id_tamanio'];
	
			$rspta=$nuevo_pedido->buscar_nom_tamano($id_tamanio);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		/*case 'guardar_pedido':
		
			$cant_2 = $_POST['cant_2'];
			//$idtbl_prod = $_POST['idtbl_prod'];

	 		$rspta=$nuevo_pedido->guardar_pedido($cant_2);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;*/



		

		case 'listar_clientes':

		$idusuario=$_GET['idusuario'];
			
			$rspta = $nuevo_pedido->listar_clientes($idusuario);



						echo '	<thead>								  
	                              <tr>
	                              	<th width="70%">Nombre</th>
	                              	<th width="20%" align="center">Seleccionar</th>
	                              	<th width="10%">Tienda</th>
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '
								<tr>
									<td>'.$reg->nombre.'</td>
									<td align="center">

										<button type="button" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Editar datos de facturación" onclick="pasar_datos_cliente('.$reg->idcliente.');"><i class="fa fa-chevron-right" style="cursor: pointer;" onclick=""></i></button>

									</td>
									<td>'.$reg->lugar.'</td>	
	                            </tr>	
						';
						
					}

						
			
		break;

		case 'listar_clientes_buscar':

			$nombre_buscar=$_GET['nombre_buscar'];
			$idusuario=$_GET['idusuario'];
			
			$rspta = $nuevo_pedido->listar_clientes_buscar($nombre_buscar,$idusuario);



						echo '	<thead>								  
	                              <tr>
	                              	<th width="70%">Nombre</th>
	                              	<th width="20%" align="center">Seleccionar</th>
	                              	<th width="10%">Tienda</th>
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '
								<tr>
									<td>'.$reg->nombre.'</td>
									<td align="center"><i class="fa fa-chevron-right" style="cursor: pointer;" onclick="pasar_datos_cliente('.$reg->idcliente.');"></i></td>
									<td>'.$reg->lugar.'</td>	
	                            </tr>	
						';
						
					}

						
			
		break;

		case 'buscar_datos_cliente':
		
			$idcliente = $_POST['idcliente'];
			//$idtbl_prod = $_POST['idtbl_prod'];

	 		$rspta=$nuevo_pedido->buscar_datos_cliente($idcliente);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

		
		case 'consul_max_idprecarga_docs':
		
			$idprecarga = $_POST['idprecarga'];
			//$idtbl_prod = $_POST['idtbl_prod'];

	 		$rspta=$nuevo_pedido->consul_max_idprecarga_docs($idprecarga);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

		case 'guardar_cliente_nuevo':
		
			$nombre_cliente_new = $_POST['nombre_cliente_new'];
			$telefono_cliente_new = $_POST['telefono_cliente_new'];
			$email_cliente_new = $_POST['email_cliente_new'];
			$razon_cliente_new = $_POST['razon_cliente_new'];
			$rfc_cliente_new = $_POST['rfc_cliente_new'];

			$calle_cliente_new = $_POST['calle_cliente_new'];
			$numero_cliente_new = $_POST['numero_cliente_new'];
			$interior_cliente_new = $_POST['interior_cliente_new'];
			$colonia_cliente_new = $_POST['colonia_cliente_new'];
			$ciudad_cliente_new = $_POST['ciudad_cliente_new'];
			$estado_cliente_new = $_POST['estado_cliente_new'];
			$cp_cliente_new = $_POST['cp_cliente_new'];

			$contacto_cliente_new = $_POST['contacto_cliente_new'];
			$calle_cliente_ent_new = $_POST['calle_cliente_ent_new'];
			$numero_cliente_ent_new = $_POST['numero_cliente_ent_new'];
			$interior_cliente_ent_new = $_POST['interior_cliente_ent_new'];
			$colonia_cliente_ent_new = $_POST['colonia_cliente_ent_new'];
			$ciudad_cliente_ent_new = $_POST['ciudad_cliente_ent_new'];
			$estado_cliente_ent_new = $_POST['estado_cliente_ent_new'];
			$cp_cliente_ent_new = $_POST['cp_cliente_ent_new'];

			$referencia_cliente_new = $_POST['referencia_cliente_new'];
			$fecha_hora = $_POST['fecha_hora'];
			$lugar = $_POST['lugar'];
			//$idtbl_prod = $_POST['idtbl_prod'];

	 		$rspta=$nuevo_pedido->guardar_cliente_nuevo(
	 			$nombre_cliente_new,
	 			$telefono_cliente_new,
	 			$email_cliente_new,
	 			$razon_cliente_new,
	 			$rfc_cliente_new,
	 			$calle_cliente_new,
	 			$numero_cliente_new,
	 			$interior_cliente_new,
	 			$colonia_cliente_new,
	 			$ciudad_cliente_new,
	 			$estado_cliente_new,
	 			$cp_cliente_new,
	 			$contacto_cliente_new,
	 			$calle_cliente_ent_new,
	 			$numero_cliente_ent_new,
	 			$interior_cliente_ent_new,
	 			$colonia_cliente_ent_new,
	 			$ciudad_cliente_ent_new,
	 			$estado_cliente_ent_new,
	 			$cp_cliente_ent_new,
	 			$referencia_cliente_new,
	 			$fecha_hora,
	 			$lugar
	 		);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

		case 'buscar_medidas_limit':
		
			$idtbl_prod = $_POST['idtbl_prod'];
			$codigo_group = $_POST['codigo_group'];
			$area = $_POST['area'];

	 		$rspta=$nuevo_pedido->buscar_medidas_limit($idtbl_prod,$codigo_group,$area);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

		case 'listar_grupos':
			
			$rspta = $nuevo_pedido->listar_grupos();

						echo '<option value="">Seleccionar</option>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

							<option value="'.$reg->codigo_group.'">'.$reg->codigo_group.' - '.$reg->nombre_group.'</option>	

						';
	
					}			
			
		break;

		case 'guardar_comprobante_lic0':

			$idprecarga = $_POST['idprecarga'];
			$idpedido = 0;

			$ar_coment = $_FILES["ar_comprob_lic0"];			
			$nom='0_'.$_FILES['ar_comprob_lic0']['name'];
			$ruta_anterior=$_FILES['ar_comprob_lic0']['tmp_name'];
			$ruta_idop="../files/".$idprecarga;
			if (!file_exists($ruta_idop)) {
			    mkdir($ruta_idop, 0755, true);
			}
			$ruta="../files/".$idprecarga."/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);

			$tipo_doc_lic = "0";

			$rspta=$nuevo_pedido->guardar_comprobante_lic0($nom,$idpedido,$tipo_doc_lic,$idprecarga);
	 		echo json_encode($rspta);
		break;
		

		case 'guardar_comprobante_lic1':

			$idprecarga = $_POST['idprecarga'];
			$idpedido = 0;

			$ar_coment = $_FILES["ar_comprob_lic1"];			
			$nom='1_'.$_FILES['ar_comprob_lic1']['name'];
			$ruta_anterior=$_FILES['ar_comprob_lic1']['tmp_name'];
			$ruta_idop="../files/".$idprecarga;
			if (!file_exists($ruta_idop)) {
			    mkdir($ruta_idop, 0755, true);
			}
			$ruta="../files/".$idprecarga."/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);

			$tipo_doc_lic = "2";

			$rspta=$nuevo_pedido->guardar_comprobante_lic0($nom,$idpedido,$tipo_doc_lic,$idprecarga);
	 		echo json_encode($rspta);
		break;

		case 'guardar_comprobante_lic2':

			$idprecarga = $_POST['idprecarga'];
			$idpedido = 0;

			$ar_coment = $_FILES["ar_comprob_lic2"];			
			$nom='2_'.$_FILES['ar_comprob_lic2']['name'];
			$ruta_anterior=$_FILES['ar_comprob_lic2']['tmp_name'];
			$ruta_idop="../files/".$idprecarga;
			if (!file_exists($ruta_idop)) {
			    mkdir($ruta_idop, 0755, true);
			}
			$ruta="../files/".$idprecarga."/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);

			$tipo_doc_lic = "3";

			$rspta=$nuevo_pedido->guardar_comprobante_lic0($nom,$idpedido,$tipo_doc_lic,$idprecarga);
	 		echo json_encode($rspta);
		break;

		case 'guardar_comprobante_lic3':

			$idprecarga = $_POST['idprecarga'];
			$idpedido = 0;

			$ar_coment = $_FILES["ar_comprob_lic3"];			
			$nom='3_'.$_FILES['ar_comprob_lic3']['name'];
			$ruta_anterior=$_FILES['ar_comprob_lic3']['tmp_name'];
			$ruta_idop="../files/".$idprecarga;
			if (!file_exists($ruta_idop)) {
			    mkdir($ruta_idop, 0755, true);
			}
			$ruta="../files/".$idprecarga."/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);

			$tipo_doc_lic = "4";

			$rspta=$nuevo_pedido->guardar_comprobante_lic0($nom,$idpedido,$tipo_doc_lic,$idprecarga);
	 		echo json_encode($rspta);
		break;

		case 'guardar_comprobante_lic4':

			$idprecarga = $_POST['idprecarga'];
			$idpedido = 0;

			$ar_coment = $_FILES["ar_comprob_lic4"];			
			$nom='4_'.$_FILES['ar_comprob_lic4']['name'];
			$ruta_anterior=$_FILES['ar_comprob_lic4']['tmp_name'];
			$ruta_idop="../files/".$idprecarga;
			if (!file_exists($ruta_idop)) {
			    mkdir($ruta_idop, 0755, true);
			}
			$ruta="../files/".$idprecarga."/".$nom;
			move_uploaded_file($ruta_anterior, $ruta);

			$tipo_doc_lic = "5";

			$rspta=$nuevo_pedido->guardar_comprobante_lic0($nom,$idpedido,$tipo_doc_lic,$idprecarga);
	 		echo json_encode($rspta);
		break;

		case 'listar_especif':

			$idtbl_prod=$_GET['idtbl_prod'];
			
			$rspta = $nuevo_pedido->listar_especif($idtbl_prod);

						

			while ($reg = $rspta->fetch_object())
					{

						echo '

						

							<p id="id_p'.$reg->idespecif_det.'" style="padding: 10px; background-color: #2A3F54; color: white; cursor: pointer; border-radius: 5px;" onclick="select_especif('.$reg->idespecif_det.',\''.$reg->nombre.'\',\''.$reg->idespecif.'\');">'.$reg->nombre.'</p>


						';
	
					}


			
		break;

		case 'consul_codigo_especif':
		
			$select_especif = $_POST['select_especif'];

	 		$rspta=$nuevo_pedido->consul_codigo_especif($select_especif);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

		case 'consul_codigo_color':
		
			$idtblprod_colores = $_POST['idtblprod_colores'];

	 		$rspta=$nuevo_pedido->consul_codigo_color($idtblprod_colores);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

		case 'listar_variaciones':

			$idtbl_prod = $_GET['idtbl_prod'];
			
			$rspta = $nuevo_pedido->listar_variaciones($idtbl_prod);

						

			while ($reg = $rspta->fetch_object())
					{

						$medida1 = $reg->medida1;
						$medida2 = $reg->medida2;
						$medida3 = $reg->medida3;
						$medida4 = $reg->medida4;

						if ($reg->medida1>0) {

							$medida1 = $reg->medida1;
							// code...
						}else{
							$medida1 = "";
						}

						if ($reg->medida2>0) {

							$medida2 = "x".$reg->medida2;
							// code...
						}else{
							$medida2 = "";
						}

						if ($reg->medida3>0) {

							$medida3 = "x".$reg->medida3;
							// code...
						}else{
							$medida3 = "";
						}

						if ($reg->medida4>0) {

							$medida4 = "x".$reg->medida4;
							// code...
						}else{
							$medida4 = "";
						}

						echo '
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-style: none; border-left: groove;">
								   <b>'.$reg->codigo.'</b><br>	
	                               <small><b>'.$reg->nombre.' '.$medida1.$medida2.$medida3.$medida4.' '.$reg->unidad.'</b></small><br><br>
	                               <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
	                               		<b style="font-size: 30px;">456</b>	
	                               </div>
	                               	                              
	                            </div>
	                            
                                                              
                            </div>
							

						';
	
					}			
			
		break;


		case 'ver_lista_mejoras':

			$idusuario = $_GET['idusuario'];
			
			$rspta = $nuevo_pedido->ver_lista_mejoras();



						echo '	<thead>								  
	                              <tr>
	                              	<th style="width: 5%;">#</th>
	                              	<th style="width: 15%;">Fecha de registro</th>
	                              	<th style="width: 30%;">Concepto</th>
	                              	<th style="width: 15%;">Área</th>
	                              	<th style="width: 5%;">Prioridad</th>
	                              	<th style="width: 15%;">Estatus</th>
	                              	<th style="width: 15%;">Fecha de termino</th>
	                              </tr>
	                            </thead>
	                            <tbody>';

	                            $consec = 1;

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->estatus==0) {
							$estatus='Pendiente';
							$back='#AF0505';
							$color='#FFF';
						}elseif ($reg->estatus==1) {
							$estatus='En proceso';
							$back='#DDE803';
							$color='#000';
						}elseif ($reg->estatus==2) {
							$estatus='Terminado';
							$back='#0AB102';
							$color='#FFF';
						}else{
							$estatus='';
							$back='';
						}

						if ($idusuario==1) {
							$display = 'display: block;';
							$display2 = 'display: none;';
						}else{
							$display = 'display: none;';
							$display2 = 'display: block;';
						}

						echo '
								<tr>
									<td>'.$consec.'</td>									
									<td>'.$reg->fecha_registro.'</td>
									<td>'.$reg->concepto.'</td>
									<td>'.$reg->area.'</td>
									<td>'.$reg->prioridad.'</td>
									<td>
										<label style="background-color: '.$back.'; color: '.$color.'; padding: 10px; '.$display2.'">'.$estatus.'</label>
										<select class="form-control selectpicker" style="background-color: '.$back.'; color: '.$color.'; padding: 10px; '.$display.'" onchange="cambiar_estatus('.$reg->idtbl_mejoras.');" id="select_upd_estat'.$reg->idtbl_mejoras.'"> 
                                            <option value="'.$estatus.'">'.$estatus.'</option>
                                            <option value="0">Pendiente</option>
                                            <option value="1">En proceso</option>
                                            <option value="2">Terminado</option> 
                                                             
                                        </select>

									</td>
									<td>'.$reg->fecha_termino.'</td>	
	                            </tr>	
						';

						$consec=$consec+1;
						
					}

						
			
		break;

		case 'guardar_mejora':
		
			$concepto_mejora = $_POST['concepto_mejora'];
			$select_mejora = $_POST['select_mejora'];
			$fecha_hora = $_POST['fecha_hora'];
			$area_mejora = $_POST['area_mejora'];

	 		$rspta=$nuevo_pedido->guardar_mejora($concepto_mejora,$select_mejora,$fecha_hora,$area_mejora);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

		case 'actualizar_estatus_mejora':
		
			$idtbl_mejoras = $_POST['idtbl_mejoras'];
			$estatus = $_POST['estatus'];
			
	 		$rspta=$nuevo_pedido->actualizar_estatus_mejora($idtbl_mejoras,$estatus);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

	}


?>