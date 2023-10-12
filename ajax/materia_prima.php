<?php
session_start(); 
require_once "../modelos/Materia_prima.php";

$materia_prima=new Materia_prima();


switch ($_GET["op"]){
	
		case 'listar_materia_prima':

			$rspta = $materia_prima->listar_materia_prima();



						echo '	<thead>
	                              <tr>
	                              	<th>ID</th>
	                              	<th>Descripción</th>
	                              	<th>Calibre</th>
	                              	<th>Pulgadas</th> 
	                              	<th>Medidas (Pieza Completa)</th> 
	                              	<th>Unidad de medida</th> 	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '

								<tr>
									
													
									<td>'.$reg->idmateria_prima.'</td>
									<td>'.$reg->descripcion.'</td>
									<td>'.$reg->calibre.'</td>
									<td>'.$reg->pulgadas.'</td>
									<td>'.$reg->valor_tramo.'</td>
									<td>'.$reg->unidad_m.'</td>
    
	                             </tr>


						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'guardar_mat':

			$descrip = $_POST['descrip'];
			$calibre = $_POST['calibre'];
			$pulgadas = $_POST['pulgadas'];
			$medidas = $_POST['medidas'];
			$unidad = $_POST['unidad'];

			$rspta=$materia_prima->guardar_mat($descrip,$calibre,$pulgadas,$medidas,$unidad);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

	
}
?>