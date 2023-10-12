<?php
require_once "../modelos/Projects.php";

$projects=new Projects();

switch ($_GET["op"])
	{

		case 'guardar_objetivo':

			$descrip_obj = $_POST['descrip_obj'];
			$fecha_ini_obj = $_POST['fecha_ini_obj'];
			$fecha_fin_obj = $_POST['fecha_fin_obj'];

			$rspta=$projects->guardar_objetivo($descrip_obj,$fecha_ini_obj,$fecha_fin_obj);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_objetivos':
			

			$rspta = $projects->listar_objetivos();



						echo '<thead>
                                <tr>
                                  <th>Opciones</th>
                                  <th>Descripción</th>
                                 
                                  <th>Estatus</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						if ($reg->estatus==0) {
							$estatus="Pendiente";
						}

						echo '

								<tr>
								  <td><button type="button" class="btn btn-primary" onclick="ver_objetivo('.$reg->idobjetivos.');">Entrar</button></td>
                                  <td>'.$reg->nombre.'</td>
                               
                                  <td>'.$estatus.'</td>
                                  
                                 
                                </tr>


						';
						
					}

						echo '</tbody>';
			
		break;


		

		

		
	

	}


?>