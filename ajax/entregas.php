<?php
require_once "../modelos/Entregas.php";

$entregas=new Entregas();

switch ($_GET["op"])
	{


		case 'listar_entregas':
			

			$rspta = $entregas->listar_entregas();



						echo '	<thead>
								  
	                              <tr style="background: #034343; color: white;">
	                              	<th>Opciones</th>
	                                <th>Fecha</th>
	                                <th>No. Salida</th>
	                                <th>Nombre</th>
	                                <th>Dirección</th>
	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						


						echo '

								
								
									 <tr>
									
										<td>

										
										<button type="button" class="btn btn-primary">Detalles</button>

						                </td>
						                <td align="center">'.$reg->fecha.'</td>
		                                <td>'.$reg->no_salida.'</td>
		                                <td>'.$reg->nombre.'</td>
		                                <td>'.$reg->dom.' '.$reg->col.', '.$reg->mun.'</td>
		                                
	                               
		                             </tr>


	                            

						';
						
					}

						echo '</tbody>
							  

						';
			
		break;



		case 'listar_prod_entregas':

			$id=$_GET['id'];
			

			$rspta = $entregas->listar_prod_entregas($id);



						echo '	<thead>
								  
	                              <tr align="center" style="background: #ccc; color: black;">
	                                <th style="width:20%">Cantidad</th>
	                                <th style="width:20%">Código</th>
	                                <th style="width:40%">Descripción</th>  
	                                <th style="width:20%">Lote</th>	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						


						echo '

								
								
									 <tr>
									
										
						                <td align="center">'.$reg->cantidad.'</td>
						                <td align="center">'.$reg->codigo.'</td>
						                <td>'.$reg->descripcion.'</td>
						                
						                <td align="center">'.$reg->lote.'</td>

		                                
	                               
		                             </tr>


	                            

						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		
		case 'reg_entrega':

			$fecha = $_POST['fecha'];
												
			$rspta=$entregas->reg_entrega($fecha);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'save_prod':

			$identregas = $_POST['identregas'];
			$lote = $_POST['lote'];
			$cantidad = $_POST['cantidad'];
			$codigo = $_POST['codigo'];
			$descripcion = $_POST['descripcion'];
												
			$rspta=$entregas->save_prod($identregas,$lote,$cantidad,$codigo,$descripcion);
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
			
			$rspta=$entregas->save_entrega($identregas,$fecha_sal,$no_salida_sal,$no_control_sal,$no_pedido_sal,$nombre_sal,$entregado_a_sal,$domicilio_sal,$colonia_sal,$municipio_sal,$estado_sal,$cp_sal,$contacto_sal,$telefono_sal,$horario_sal,$condiciones_sal,$medio_sal);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;
		


	}

?>