<?php
require_once "../modelos/Correcciones.php";

$correcciones=new Correcciones();

switch ($_GET["op"])
	{

		

		case 'listar_prod':
			

			$rspta = $correcciones->listar_prod();



						echo '<thead>
                                <tr>
                                  <th>ID</th>
                                  <th>No. Control</th>
                                  <th>Codigo</th>
                                  <th>OP</th>
                                
                                  
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						

							echo '

									<tr>
									  <td>'.$reg->idpg_detped.'</td>
	                                  <td>'.$reg->no_control.'</td>
	                                  <td>'.$reg->codigo.'</td>
	                                  <td>
									  
							';	

							$idpg_deped = $reg->idpg_detped;
							
							
							$rspta2 = $correcciones->listar_op($idpg_deped);
							while ($reg2 = $rspta2->fetch_object())
							{
	
								echo '
									<b id="lbl_op'.$reg2->idop_detalle_prod.'">'.$reg2->no_op.': '.$reg2->herreria.', '.$reg2->pintura.', '.$reg2->plasticos.', '.$reg2->Ens_porc.', '.$reg2->Ens_com.', '.$reg2->Ens_mue.', '.$reg2->horno.'</b>&nbsp;&nbsp;<button class="btn btn-secondary" type="button" onclick="quitar('.$reg2->idop_detalle_prod.');">Quitar</button><br>
								';
							}



					}

						echo '

										</td>
										

									</tr>

						</tbody>';
			
		break;

		case 'quitar':

			$idop_detalle_prod = $_POST['idop_detalle_prod'];

			$rspta=$correcciones->quitar($idop_detalle_prod);
	 		echo json_encode($rspta);
	 		
		break;

		case 'exist_avance':

			$idop_detalle_prod = $_POST['idop_detalle_prod'];

			$rspta=$correcciones->exist_avance($idop_detalle_prod);
	 		echo json_encode($rspta);
	 		
		break;
	

	}


?>