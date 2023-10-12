<?php
require_once "../modelos/Reportes.php";

$reportes=new Reportes();

switch ($_GET["op"])
	{


		case 'listar_pedidos_entregados':

		$fecha_ini = $_GET['fecha_ini'];
		$fecha_fin = $_GET['fecha_fin'];

		echo $fecha_ini;
		echo $fecha_fin;
			

			$rspta = $reportes->listar_pedidos_entregados($fecha_ini,$fecha_fin);



						echo '	<thead>
								  
	                              <tr style="background: #034343; color: white;">
	                              	<th>FECHA DE PEDIDO</th>
	                              	<th>FECHA DE ENTREGA AL CLIENTE</th>
	                                <th>TIPO DE PEDIDO</th>
	                                <th>ORIGEN</th>
	                                <th>CONTROL</th>
	                                <th>CLIENTE</th>
	                                <th>ESTATUS</th>
	                                
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						


						echo '

								
								
									 <tr>
									
										
						                <td>'.$reg->fecha_pedido.'</td>
		                                <td>'.$reg->fecha_ent_cli.'</td>
		                                <td>'.$reg->tipo.'</td>
		                                <td>'.$reg->lugar.'</td>
		                                <td>'.$reg->no_control.'</td>
		                                <td>'.$reg->nombre_cli.'</td>
		                                <td>'.$reg->estatus.'</td>
		                                
	                               
		                             </tr>


	                            

						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_pedidos_pendientes':
				
	
				$rspta = $reportes->listar_pedidos_pendientes();
	
	
	
							echo '	<thead>
									  
									  <tr style="background: #034343; color: white;">
										<th>FECHA DE PEDIDO</th>
										<th>ESTATUS</th>
										<th>ORIGEN</th>
										<th>No. CONTROL</th>
										<th>No. PEDIDO</th>
										<th>TIPO</th>
										<th>FECHA DE ENTREGA</th>
										<th>FORMA DE ENTREGA</th>
										<th>OBSERVACIONES</th>
										<th>COMENTARIO VENCIMIENTO</th>
										
									  </tr>
									</thead>
									<tbody>';
	
				//$total=0;
				while ($reg = $rspta->fetch_object())
						{
							
	
	
							echo '
	
									
									
										 <tr>
										
											
											<td>'.$reg->fecha_pedido.'</td>
											<td>'.$reg->estatus.'</td>
											<td>'.$reg->no_control.'</td>
											<td>'.$reg->no_pedido.'</td>
											<td>'.$reg->no_control.'</td>
											<td>'.$reg->tipo.'</td>
											<td>'.$reg->fecha_entrega.'</td>
											<td>'.$reg->forma_entrega.'</td>
											<td>'.$reg->observaciones.'</td>
											<td>'.$reg->coment_vencim.'</td>
									   
										 </tr>
	
	
									
	
							';
							
						}
	
							echo '</tbody>
								  
	
							';
				
			break;

	}

?>