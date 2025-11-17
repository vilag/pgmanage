<?php
require_once "../modelos/Productos.php";

$productos=new Productos();

switch ($_GET["op"])
	{

		case 'listar_tabla_productos':

			$rspta = $productos->listar_tabla_productos();
			$pila = array();	
			while ($reg = $rspta->fetch_object())
			{
				array_push($pila, $reg);
			}
			echo json_encode($pila);
		break;

		case 'listar_productos':
			

			$rspta = $productos->listar_productos();



						echo '	<thead>
								  
	                              <tr style="background: #034343; color: white;">
	                              	<th></th>
	                              	<th>TIPO</th>
	                                <th>CODIGO</th>
	                                <th>NOMBRE</th>
	                                <th>COLOR</th>
	                                <th>MEDIDAS</th>
	                                <th>PRECIO</th>
	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						


						echo '

								
								
									 <tr>
									
										<td>

										
										<button type="button" class="btn btn-primary" onclick="ver_detalle_prod('.$reg->idproducto.');">VER</button>

						                </td>
						                <td>'.$reg->tipo.'</td>
		                                <td>'.$reg->codigo.'</td>
		                                <td>'.$reg->nombre.'</td>
		                                <td>'.$reg->color.'</td>
		                                <td>'.$reg->medida.'</td>
		                                <td>'.$reg->precio_total.'</td>
		                                
	                               
		                             </tr>


	                            

						';
						
					}

						echo '</tbody>
							  

						';
			
		break;


		case 'listar_productos2':
			

			$rspta = $productos->listar_productos();



						echo '	<thead>
								  
	                              <tr style="background: #034343; color: white;">

	                              	<th></th>
	                              	<th>ID</th>
	                              	<th>TIPO</th>
	                                <th>CODIGO</th>
	                                <th>NOMBRE</th>
	                                <th>COLOR</th>
	                                <th>MEDIDAS</th>
	                                
	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						


						echo '

								
								
									 <tr>
									
										<td>

										
										<button type="button" class="btn btn-primary" onclick="ver_detalle_prod('.$reg->idproducto.');">VER</button>

						                </td>
						                <td>'.$reg->idproducto.'</td>
						                <td>'.$reg->tipo.'</td>
		                                <td>'.$reg->codigo.'</td>
		                                <td>'.$reg->nombre.'</td>
		                                <td>'.$reg->color.'</td>
		                                <td>'.$reg->medida.'</td>
		                              
		                                
	                               
		                             </tr>


	                            

						';
						
					}

						echo '</tbody>
							  

						';
			
		break;


		case 'ver_detalle_prod':
		
			$idproducto = $_POST['idproducto'];

			$rspta=$productos->ver_detalle_prod($idproducto);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'buscar_texto_tbl':
			//Recibimos el idingreso
			//$id=$_GET['id'];
			$id=$_GET['id'];
			//$lugar_user=$_GET['lugar_user'];

			$rspta = $productos->buscar_texto_tbl($id);



						echo '	<thead>
								  
	                              <tr style="background: #034343; color: white;">
	                              
	                              	<th></th>
	                              	<th>ID</th>
	                              	
	                                <th>CODIGO</th>
	                                <th>NOMBRE</th>
	                               
	                                <th>MEDIDAS</th>
	                                <th>PRECIO</th>
	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						echo '

									<tr>
									
										<td>

										
										<button type="button" class="btn btn-primary" onclick="ver_detalle_prod('.$reg->idproductos_clasif.');">VER</button>

						                </td>
						                <td align="center">'.$reg->idproductos_clasif.'</td>
						               
		                                <td>'.$reg->codigo_match.'</td>
		                                <td>'.$reg->descripcion.'</td>
		                               
		                                <td>'.$reg->nom_tamano.'</td>
		                                <td>'.$reg->precio_total.'</td>
		                                
	                               
		                             </tr>


						';
						
					}

						echo '</tbody>';
			
		break;


		case 'buscar_texto_tbl2':
			//Recibimos el idingreso
			//$id=$_GET['id'];
			$id=$_GET['id'];
			//$lugar_user=$_GET['lugar_user'];

			$rspta = $productos->buscar_texto_tbl($id);



						echo '	<thead>
								  
	                              <tr style="background: #034343; color: white;">
	                              	<th></th>
	                              	
	                              
	                                <th>CODIGO</th>
	                                <th>NOMBRE</th>
	                                <th>COLOR</th>
	                                <th>MEDIDAS</th>
	                                
	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						echo '

									<tr>
									
										<td>

										
										<button type="button" class="btn btn-primary" onclick="ver_detalle_prod('.$reg->idproductos_clasif.');">VER</button>

						                </td>
						                
						               
		                                <td>'.$reg->codigo_match.'</td>
		                                <td>'.$reg->descripcion.'</td>
		                                <td>'.$reg->color.'</td>
		                                <td>'.$reg->nom_tamano.'</td>
		                            
		                                
	                               
		                             </tr>


						';
						
					}

						echo '</tbody>';
			
		break;

		/*case 'actualizar_producto':
		
			$idproducto = $_POST['idproducto'];
			$codigo = $_POST['codigo'];
			$nombre = $_POST['nombre'];
			$color = $_POST['color'];
			$medidas = $_POST['medidas'];
			$precio = $_POST['precio'];

			$rspta=$productos->actualizar_producto($idproducto,$codigo,$nombre,$color,$medidas,$precio);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;*/


		case 'listar_productos_resul_tipo':
			
			$id=$_GET['id'];
			
			$rspta = $productos->listar_productos_resul_tipo($id);



						echo '	<thead>
								  
	                              <tr>
	                              	<th style="width: 5%;">ID</th>		
	                              	<th style="width: 20%;">Codigo</th>	
	                              	<th style="width: 45%;">Nombre</th>
	                              	
	                              	<th style="width: 10%;">Tamaño/Medidas</th>
	                              	<th style="width: 10%;">Tipo Fab.</th>
	                             	<th style="width: 10%;">Opciones</th>
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->estatus==0) {
							$eti_status_prod="Desactivado";
							$back="#A21203";
							$color="#fff";
						}elseif ($reg->estatus==1) {
							$eti_status_prod="Activado";
							$back="#049630";
							$color="#fff";
						}

						if ($reg->esp==0) {

							$tipo_fab = "Linea";
							
						}elseif ($reg->esp==1) {
							
							$tipo_fab = "Especial";

						}

						if ($reg->tamano_new>0) {
							$color_clas = "#028939";
							
						}else{
							$color_clas = "#AC0D06";
						}

						echo '

								<tr>
									<td>'.$reg->idproductos_clasif.'</td>
									<td>
										<input type="checkbox" id="check_codigo'.$reg->idproductos_clasif.'" onchange="hab_codigo('.$reg->idproductos_clasif.');">
										<div style="width: 100%; display: none;" id="codigo'.$reg->idproductos_clasif.'">
											<input style="width: 100%; height: 30px;" type="" name="" value="'.$reg->codigo_match.'" id="id_input_codigo'.$reg->idproductos_clasif.'">
											<input type="button" value="Guardar" onclick="guardar_codigo('.$reg->idproductos_clasif.');">
										</div>
										
										<label id="lbl_codigo'.$reg->idproductos_clasif.'">'.$reg->codigo_match.'</label>
									</td>
									<td>
										<input type="checkbox" id="check_descrip'.$reg->idproductos_clasif.'" onchange="hab_descrip('.$reg->idproductos_clasif.');">
										<div style="width: 100%; display: none;" id="descrip'.$reg->idproductos_clasif.'">
											<textarea style="width: 100%; height: auto;" type="" name="" id="id_textarea_descrip'.$reg->idproductos_clasif.'">'.$reg->descripcion.'</textarea>
											<input type="button" value="Guardar" onclick="guardar_descrip('.$reg->idproductos_clasif.');">
										</div>
										
										<label id="lbl_descrip'.$reg->idproductos_clasif.'">'.$reg->descripcion.'</label>
									</td>
									
	                                <td>
	                                	<input type="checkbox" id="check_tam'.$reg->idproductos_clasif.'" onchange="hab_tam('.$reg->idproductos_clasif.');">
	                                	<div style="width: 100%; display: none; display: none;" id="tamano'.$reg->idproductos_clasif.'">
	                                		<input style="width: 100%; height: 30px;" type="" name="" value="'.$reg->nom_tamano.'" id="id_input_tamano'.$reg->idproductos_clasif.'">
	                                		<input type="button" value="Guardar" onclick="guardar_tamano('.$reg->idproductos_clasif.');">
	                                	</div>
	                                		
										<label id="lbl_tam'.$reg->idproductos_clasif.'">'.$reg->nom_tamano.'</label>
									</td>
									<td>
										<b style="color: '.$back.';">'.$tipo_fab.'</b>
									</td>
									<td>
										<button type="button" class="btn btn-sm btn-dark" onclick="borrar_prod_consul1('.$reg->idproductos_clasif.');" id="btn_delete_prod'.$reg->idproductos_clasif.'"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="cursor: pointer;" ></span></button>
										<button type="button" class="btn btn-sm" style="background-color: '.$back.'; color: '.$color.';" onclick="desactivar_producto1('.$reg->idproductos_clasif.',\''.$reg->estatus.'\');" id="btn_desac_prod'.$reg->idproductos_clasif.'"><b style="font-size: 10px;">'.$eti_status_prod.'</b></button>
										<button type="button" class="btn btn-sm" style="background-color: '.$color_clas.'; color: #fff; font-size: 10px;" onclick="abrir_reclasif('.$reg->idproductos_clasif.',\''.$reg->codigo_match.'\',\''.$reg->descripcion.'\');">Clasif.</button>
									</td>
	                                
	                             </tr>	

						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_productos_resul_modelo':
			
			$id=$_GET['id'];
			$id2=$_GET['id2'];
			
			$rspta = $productos->listar_productos_resul_modelo($id,$id2);



						echo '	<thead>
								  
	                              <tr>
	                              	<th style="width: 5%;">ID</th>		
	                              	<th style="width: 20%;">Codigo</th>	
	                              	<th style="width: 45%;">Nombre</th>
	                              	
	                              	<th style="width: 10%;">Tamaño/Medidas</th>
	                              	<th style="width: 10%;">Tipo Fab.</th>
	                             	<th style="width: 10%;">Opciones</th>
	                              
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

				

						if ($reg->estatus==0) {
							$eti_status_prod="Desactivado";
							$back="#A21203";
							$color="#fff";
						}elseif ($reg->estatus==1) {
							$eti_status_prod="Activado";
							$back="#049630";
							$color="#fff";
						}

						if ($reg->esp==0) {

							$tipo_fab = "Linea";
							
						}elseif ($reg->esp==1) {
							
							$tipo_fab = "Especial";

						}

						if ($reg->tamano_new>0) {
							$color_clas = "#028939";
							
						}else{
							$color_clas = "#AC0D06";
						}
				

						echo '

								<tr>
									<td>'.$reg->idproductos_clasif.'</td>
									<td>
										<input type="checkbox" id="check_codigo'.$reg->idproductos_clasif.'" onchange="hab_codigo('.$reg->idproductos_clasif.');">
										<div style="width: 100%; display: none;" id="codigo'.$reg->idproductos_clasif.'">
											<input style="width: 100%; height: 30px;" type="" name="" value="'.$reg->codigo_match.'" id="id_input_codigo'.$reg->idproductos_clasif.'">
											<input type="button" value="Guardar" onclick="guardar_codigo('.$reg->idproductos_clasif.');">
										</div>
										
										<label id="lbl_codigo'.$reg->idproductos_clasif.'">'.$reg->codigo_match.'</label>
									</td>
									<td>
										<input type="checkbox" id="check_descrip'.$reg->idproductos_clasif.'" onchange="hab_descrip('.$reg->idproductos_clasif.');">
										<div style="width: 100%; display: none;" id="descrip'.$reg->idproductos_clasif.'">
											<textarea style="width: 100%; height: auto;" type="" name="" id="id_textarea_descrip'.$reg->idproductos_clasif.'">'.$reg->descripcion.'</textarea>
											<input type="button" value="Guardar" onclick="guardar_descrip('.$reg->idproductos_clasif.');">
										</div>
										
										<label id="lbl_descrip'.$reg->idproductos_clasif.'">'.$reg->descripcion.'</label>
									</td>
									
	                                <td>
	                                	<input type="checkbox" id="check_tam'.$reg->idproductos_clasif.'" onchange="hab_tam('.$reg->idproductos_clasif.');">
	                                	<div style="width: 100%; display: none; display: none;" id="tamano'.$reg->idproductos_clasif.'">
	                                		<input style="width: 100%; height: 30px;" type="" name="" value="'.$reg->nom_tamano.'" id="id_input_tamano'.$reg->idproductos_clasif.'">
	                                		<input type="button" value="Guardar" onclick="guardar_tamano('.$reg->idproductos_clasif.');">
	                                	</div>
	                                		
										<label id="lbl_tam'.$reg->idproductos_clasif.'">'.$reg->nom_tamano.'</label>
									</td>
									<td>
										<b style="color: '.$back.';">'.$tipo_fab.'</b>
									</td>
									<td>
										<button type="button" class="btn btn-sm btn-dark" onclick="borrar_prod_consul2('.$reg->idproductos_clasif.');" id="btn_delete_prod'.$reg->idproductos_clasif.'"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="cursor: pointer;" ></span></button>
										<button type="button" class="btn btn-sm" style="background-color: '.$back.'; color: '.$color.';" onclick="desactivar_producto2('.$reg->idproductos_clasif.',\''.$reg->estatus.'\');" id="btn_desac_prod'.$reg->idproductos_clasif.'"><b>'.$eti_status_prod.'</b></button>
										<button type="button" class="btn btn-sm" style="background-color: '.$color_clas.'; color: #fff; font-size: 10px;" onclick="abrir_reclasif('.$reg->idproductos_clasif.',\''.$reg->codigo_match.'\',\''.$reg->descripcion.'\');">Clasif.</button>
									</td>
	                                
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
			$rspta = $productos->listar_productos_resul($id,$id2,$id3);
						echo '	<thead>
								  
	                              <tr>
	                              	<th style="width: 5%;">ID</th>		
	                              	<th style="width: 20%;">Codigo</th>	
	                              	<th style="width: 45%;">Nombre</th>
	                              	
	                              	<th style="width: 10%;">Tamaño/Medidas</th>
	                              	<th style="width: 10%;">Tipo Fab.</th>
	                             	<th style="width: 10%;">Opciones</th>
	                              
	                              </tr>
	                            </thead>
	                            
	                            <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						if ($reg->estatus==0) {
							$eti_status_prod="Desactivado";
							$back="#A21203";
							$color="#fff";
						}elseif ($reg->estatus==1) {
							$eti_status_prod="Activado";
							$back="#049630";
							$color="#fff";
						}

						if ($reg->esp==0) {

							$tipo_fab = "Linea";
							
						}elseif ($reg->esp==1) {
							
							$tipo_fab = "Especial";

						}

						if ($reg->tamano_new>0) {
							$color_clas = "#028939";
							
						}else{
							$color_clas = "#AC0D06";
						}

						echo '

								<tr>
									<td>'.$reg->idproductos_clasif.'</td>
									<td>
										<input type="checkbox" id="check_codigo'.$reg->idproductos_clasif.'" onchange="hab_codigo('.$reg->idproductos_clasif.');">
										<div style="width: 100%; display: none;" id="codigo'.$reg->idproductos_clasif.'">
											<input style="width: 100%; height: 30px;" type="" name="" value="'.$reg->codigo_match.'" id="id_input_codigo'.$reg->idproductos_clasif.'">
											<input type="button" value="Guardar" onclick="guardar_codigo('.$reg->idproductos_clasif.');">
										</div>
										
										<label id="lbl_codigo'.$reg->idproductos_clasif.'">'.$reg->codigo_match.'</label>
									</td>
									<td>
										<input type="checkbox" id="check_descrip'.$reg->idproductos_clasif.'" onchange="hab_descrip('.$reg->idproductos_clasif.');">
										<div style="width: 100%; display: none;" id="descrip'.$reg->idproductos_clasif.'">
											<textarea style="width: 100%; height: auto;" type="" name="" id="id_textarea_descrip'.$reg->idproductos_clasif.'">'.$reg->descripcion.'</textarea>
											<input type="button" value="Guardar" onclick="guardar_descrip('.$reg->idproductos_clasif.');">
										</div>
										
										<label id="lbl_descrip'.$reg->idproductos_clasif.'">'.$reg->descripcion.'</label>
									</td>
									
	                                <td>
	                                	<input type="checkbox" id="check_tam'.$reg->idproductos_clasif.'" onchange="hab_tam('.$reg->idproductos_clasif.');">
	                                	<div style="width: 100%; display: none; display: none;" id="tamano'.$reg->idproductos_clasif.'">
	                                		<input style="width: 100%; height: 30px;" type="" name="" value="'.$reg->nom_tamano.'" id="id_input_tamano'.$reg->idproductos_clasif.'">
	                                		<input type="button" value="Guardar" onclick="guardar_tamano('.$reg->idproductos_clasif.');">
	                                	</div>
	                                		
										<label id="lbl_tam'.$reg->idproductos_clasif.'">'.$reg->nom_tamano.'</label>
									</td>
									<td>
										<b style="color: '.$back.';">'.$tipo_fab.'</b>
									</td>
									<td>
										<button type="button" class="btn btn-sm btn-dark" onclick="borrar_prod_consul3('.$reg->idproductos_clasif.');" id="btn_delete_prod'.$reg->idproductos_clasif.'"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="cursor: pointer;" ></span></button>
										<button type="button" class="btn btn-sm" style="background-color: '.$back.'; color: '.$color.';" onclick="desactivar_producto3('.$reg->idproductos_clasif.',\''.$reg->estatus.'\');" id="btn_desac_prod'.$reg->idproductos_clasif.'"><b>'.$eti_status_prod.'</b></button>
										<button type="button" class="btn btn-sm" style="background-color: '.$color_clas.'; color: #fff; font-size: 10px;" onclick="abrir_reclasif('.$reg->idproductos_clasif.',\''.$reg->codigo_match.'\',\''.$reg->descripcion.'\');">Clasif.</button>
									</td>
	                                
	                             </tr>	

						';						
					}
						echo '</tbody>
							  
						';
			
		break;

		case 'listar_productos_resul_tipo_sub':
			
			$id=$_GET['id'];
			$id2=$_GET['id2'];
			
			$rspta = $productos->listar_productos_resul_tipo_sub($id,$id2);



						echo '	<thead>
								  
	                              <tr>
	                              	
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
			
			$rspta = $productos->listar_productos_resul_modelo2($id,$id2,$id3);



						echo '	<thead>
								  
	                              <tr>
	                              	
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
			
			$rspta = $productos->listar_productos_resul_submodelo($id,$id2,$id3);



						echo '	<thead>
								  
	                              <tr>
	                              	
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
			
			$rspta = $productos->listar_productos_resul_submodelo2($id,$id2,$id3,$id4);



						echo '	<thead>
								  
	                              <tr>
	                              	
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
			$rspta = $productos->listar_productos_resul2($id,$id2,$id3,$id4);
						echo '	<thead>
	                              <tr>
	                              	
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
			$rspta = $productos->listar_productos_resul3($id,$id2,$id3,$id4);
						echo '	<thead>
	                              <tr>
	                              	
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
			$rspta = $productos->listar_productos_resul4($id,$id2,$id3,$id4,$id5);
						echo '	<thead>
	                              <tr>
	                              	
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
		
			$rspta = $productos->listar_productos_busqueda($id);
						echo '	<thead>
	                              <tr>

	                             	<th style="width: 5%;">ID</th>		
	                              	<th style="width: 20%;">Codigo</th>	
	                              	<th style="width: 45%;">Nombre</th>    	
	                              	<th style="width: 10%;">Tamaño/Medidas</th>
	                              	<th style="width: 10%;">Tipo Fab.</th>
	                             	<th style="width: 10%;">Opciones</th>

	                              </tr>
	                            </thead>
	                            <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						if ($reg->estatus==0) {
							$eti_status_prod="Desactivado";
							$back="#A21203";
							$color="#fff";
						}elseif ($reg->estatus==1) {
							$eti_status_prod="Activado";
							$back="#049630";
							$color="#fff";
						}

						if ($reg->esp==0) {

							$tipo_fab = "Linea";
							
						}elseif ($reg->esp==1) {
							
							$tipo_fab = "Especial";

						}

						if ($reg->tamano_new>0) {
							$color_clas = "#028939";
							
						}else{
							$color_clas = "#AC0D06";
						}


						echo '

								<tr>
									<td>'.$reg->idproductos_clasif.'</td>
									<td>
										<input type="checkbox" id="check_codigo'.$reg->idproductos_clasif.'" onchange="hab_codigo('.$reg->idproductos_clasif.');">
										<div style="width: 100%; display: none;" id="codigo'.$reg->idproductos_clasif.'">
											<input style="width: 100%; height: 30px;" type="" name="" value="'.$reg->codigo_match.'" id="id_input_codigo'.$reg->idproductos_clasif.'">
											<input type="button" value="Guardar" onclick="guardar_codigo('.$reg->idproductos_clasif.');">
										</div>
										
										<label id="lbl_codigo'.$reg->idproductos_clasif.'">'.$reg->codigo_match.'</label>
									</td>
									<td>
										<input type="checkbox" id="check_descrip'.$reg->idproductos_clasif.'" onchange="hab_descrip('.$reg->idproductos_clasif.');">
										<div style="width: 100%; display: none;" id="descrip'.$reg->idproductos_clasif.'">
											<textarea style="width: 100%; height: auto;" type="" name="" id="id_textarea_descrip'.$reg->idproductos_clasif.'">'.$reg->descripcion.'</textarea>
											<input type="button" value="Guardar" onclick="guardar_descrip('.$reg->idproductos_clasif.');">
										</div>
										
										<label id="lbl_descrip'.$reg->idproductos_clasif.'">'.$reg->descripcion.'</label>
									</td>
									
	                                <td>
	                                	<input type="checkbox" id="check_tam'.$reg->idproductos_clasif.'" onchange="hab_tam('.$reg->idproductos_clasif.');">
	                                	<div style="width: 100%; display: none; display: none;" id="tamano'.$reg->idproductos_clasif.'">
	                                		<input style="width: 100%; height: 30px;" type="" name="" value="'.$reg->nom_tamano.'" id="id_input_tamano'.$reg->idproductos_clasif.'">
	                                		<input type="button" value="Guardar" onclick="guardar_tamano('.$reg->idproductos_clasif.');">
	                                	</div>
	                                		
										<label id="lbl_tam'.$reg->idproductos_clasif.'">'.$reg->nom_tamano.'</label>
									</td>
									<td>
										<b style="color: '.$back.';">'.$tipo_fab.'</b>
									</td>
	                                <td>
	                                	<button type="button" class="btn btn-sm btn-dark" onclick="borrar_prod_consul4('.$reg->idproductos_clasif.');" id="btn_delete_prod'.$reg->idproductos_clasif.'"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="cursor: pointer;" ></span></button>
	                                	<button type="button" class="btn btn-sm" style="background-color: '.$back.'; color: '.$color.';" onclick="desactivar_producto4('.$reg->idproductos_clasif.',\''.$reg->estatus.'\');" id="btn_desac_prod'.$reg->idproductos_clasif.'"><b>'.$eti_status_prod.'</b></button>
										<button type="button" class="btn btn-sm" style="background-color: '.$color_clas.'; color: #fff; font-size: 10px;" onclick="abrir_reclasif('.$reg->idproductos_clasif.',\''.$reg->codigo_match.'\',\''.$reg->descripcion.'\');">Clasif.</button>
	                                </td>

	                                
	                            </tr>
								
						';						
					}
						echo '</tbody>
							  
						';
			
		break;

	
		case 'borrar_prod_consul':

			$idproductos_clasif = $_POST['idproductos_clasif'];
			//$id2 = $_POST['id2'];

			$rspta=$productos->borrar_prod_consul($idproductos_clasif);
	 		echo json_encode($rspta);
	 		
		break;


		case 'consul_prod_update':

			$id = $_POST['id'];
			$id2 = $_POST['id2'];

			$rspta=$productos->consul_prod_update($id,$id2);
	 		echo json_encode($rspta);
	 		
		break;

		case 'listar_productos_fabricados':		
			//$id=$_GET['id'];
		
			$rspta = $productos->listar_productos_fabricados();
						echo '	<thead>
	                              <tr>
	                              	
	                              	<th>Opciones</th>	
	                              	<th>Año</th>	
	                              	<th>Mes</th>	                              	
	                              	<th>Tipo</th>
	                              	<th>SubTipo</th>
	                              	<th>Codigo</th>
	                              	<th>Descripción</th>
	                              	<th>Cantidad</th>	                              
	                              </tr>
	                            </thead>
	                            <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						echo '
								<tr>
									
									<td><button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Ver detalles" onclick="">Ver</button></td>
									<td>'.$reg->anio.'</td>
									<td>'.$reg->mes.'</td>
									<td>'.$reg->tipo.'</td>
									<td>'.$reg->tipo2.'</td>									
	                                <td>'.$reg->codigo.'</td>
	                                <td>'.$reg->descripcion.'</td>
	                                <td>'.$reg->cantidad_total.'</td>

	                             </tr>	
						';						
					}
						echo '</tbody>
							  
						';
			
		break;


		case 'listar_vendidos':		
			$fecha_pedido1=$_GET['fecha_pedido1'];
			$fecha_pedido2=$_GET['fecha_pedido2'];
		
			$rspta = $productos->listar_vendidos($fecha_pedido1,$fecha_pedido2);
						echo '	<thead>
	                              <tr>
	                              	
	                              	<th>No. Control</th>	
	                              	<th>Fecha de pedido</th>	
	                              	<th>Codigo</th>	                              	
	                              	<th>Descripción</th>
	                              	<th>Medida</th>
	                              	<th>Color</th>
	                              	<th>Cantidad</th>
	                              	<th>Precio</th>
	                              	<th>Importe total</th>	                              
	                              </tr>
	                            </thead>
	                            <tbody>';
			while ($reg = $rspta->fetch_object())
					{
						$importe = $reg->cantidad * $reg->precio;
						echo '
								<tr>
									
									
									<td>'.$reg->no_control.'</td>
									<td>'.$reg->fecha_pedido.'</td>
									<td>'.$reg->codigo.'</td>
									<td>'.$reg->descripcion.'</td>									
	                                <td>'.$reg->medida.'</td>
	                                <td>'.$reg->color.'</td>
	                                <td>'.$reg->cantidad.'</td>
	                                <td>'.$reg->precio.'</td>
	                                <td>'.$importe.'</td>

	                             </tr>	
						';						
					}
						echo '</tbody>
							  
						';
			
		break;

		case 'exportar_excel1':		
			require_once '../excelexport/Classes/PHPExcel.php';
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
			$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
			 
			 
			$objPHPExcel->getActiveSheet()->setCellValue('A1','Creando el documento excel');
			$objRichText = new PHPExcel_RichText();
			$objRichText->createText('Creando textos');
			$objPHPExcel->getActiveSheet()->getCell('A5')->setValue($objRichText);
			 
			 
			 
			//combinando celdas
			 
			$objPHPExcel->getActiveSheet()->mergeCells('A5:E10');
			 
			$objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
			 
			$objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			 
			 
			 
			//Utilizar formulas
			$objPHPExcel->getActiveSheet()->setCellValue('B11', 'Sumando datos');
			$objPHPExcel->getActiveSheet()->setCellValue('B15', 2);
			$objPHPExcel->getActiveSheet()->setCellValue('B21', 8);
			$objPHPExcel->getActiveSheet()->setCellValue('B15', 10);
			 
			//Aplicando fórmulas
			$objPHPExcel->getActiveSheet()->setCellValue('B16', '=SUM(B13:B15)');
			 
			// Nombramos la hoja
			$objPHPExcel->getActiveSheet()->setTitle('PHP to Excel');
			 
			// Elegimos en que hoja se abre el Excel
			$objPHPExcel->setActiveSheetIndex(0);
			 
			 
			// Y ahora guardamos el archivo con el nombre que quieras
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PHPExcelNombre');
			 
			$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
			
		break;

		case 'guardar_codigo':

			$id_input_codigo = $_POST['id_input_codigo'];
			$idproductos_clasif = $_POST['idproductos_clasif'];
			$rspta=$productos->guardar_codigo($id_input_codigo,$idproductos_clasif);
	 		echo json_encode($rspta);
	 		
		break;

		case 'guardar_descrip':

			$id_textarea_descrip = $_POST['id_textarea_descrip'];
			$idproductos_clasif = $_POST['idproductos_clasif'];
			$rspta=$productos->guardar_descrip($id_textarea_descrip,$idproductos_clasif);
	 		echo json_encode($rspta);
	 		
		break;

		case 'desactivar_producto':

			$estatus = $_POST['estatus'];
			$idproductos_clasif = $_POST['idproductos_clasif'];
			$rspta=$productos->desactivar_producto($idproductos_clasif,$estatus);
	 		echo json_encode($rspta);
	 		
		break;

		case 'guardar_nuevo_tipo':

			$nombre = $_POST['nombre'];
			$tipo_action = $_POST['tipo_action'];
			$idtipo = $_POST['idtipo'];
			// $idproductos_clasif = $_POST['idproductos_clasif'];
			$rspta=$productos->guardar_nuevo_tipo($nombre,$tipo_action,$idtipo);
	 		echo json_encode($rspta);
	 		
		break;


		case 'listar_tipos_new':		
		
			$rspta = $productos->listar_tipos_new();						
			while ($reg = $rspta->fetch_object())
					{
						echo '
							<option value="'.$reg->idtipo.'">'.$reg->nombre.'</option> 
						';						
					}
		break;

		case 'mostrar_modelos_new':	
			
			$idtipo = $_GET['idtipo'];
		
			$rspta = $productos->mostrar_modelos_new($idtipo);						
			while ($reg = $rspta->fetch_object())
					{
						echo '
							<option value="'.$reg->idmodelo.'">'.$reg->nombre.'</option> 
						';						
					}
		break;

		case 'mostrar_tamano_new':	
			
			$idmodelo = $_GET['idmodelo'];
		
			$rspta = $productos->mostrar_tamano_new($idmodelo);						
			while ($reg = $rspta->fetch_object())
					{
						echo '
							<option value="'.$reg->idtamano.'">'.$reg->nombre.'</option> 
						';						
					}
		break;

		case 'guardar_nuevo_modelo':

			$nombre_m = $_POST['nombre_m'];
			$tipo_action = $_POST['tipo_action'];
			$idtipo = $_POST['idtipo'];
			$idmodelo = $_POST['idmodelo'];
			$rspta=$productos->guardar_nuevo_modelo($nombre_m,$tipo_action,$idtipo,$idmodelo);
	 		echo json_encode($rspta);
	 		
		break;

		case 'guardar_nuevo_tamano':

			$nombre_t = $_POST['nombre_t'];
			$tipo_action = $_POST['tipo_action'];			
			$idmodelo = $_POST['idmodelo'];
			$idtamano = $_POST['idtamano'];
			$rspta=$productos->guardar_nuevo_tamano($nombre_t,$tipo_action,$idmodelo,$idtamano);
	 		echo json_encode($rspta);
	 		
		break;

		case 'guardar_nueva_clasificacion':

			$idprod = $_POST['idprod'];
			$idtipo = $_POST['idtipo'];			
			$idmodelo = $_POST['idmodelo'];
			$idtam = $_POST['idtam'];

			$rspta=$productos->guardar_nueva_clasificacion($idprod,$idtipo,$idmodelo,$idtam);
	 		echo json_encode($rspta);
	 		
		break;


	}

?>