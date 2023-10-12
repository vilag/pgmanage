<?php
session_start(); 
require_once "../modelos/Tabulador.php";

$tabulador=new Tabulador();


switch ($_GET["op"]){
	
		case 'listar_material_prod':

			$id=$_GET['id'];

			$rspta = $tabulador->listar_material_prod($id);



						echo '	<thead>
	                              <tr>
	                              	<th>Material</th>
	                              	<th>Cantidad</th>
	                              	<th colspan="3">Medida</th>
	                              	<th>Unidad de medida</th>
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->tipo==2) {
							$visib = "visible";
						}elseif ($reg->tipo==1) {
							$visib = "hidden";
						}

						echo '

								<tr>

									<td>
									'.$reg->descripcion.' <br>
									Calibre: '.$reg->calibre.' <br>
									Pulgadas: '.$reg->pulgadas.' <br>
									</td>
									<td><input type="text" class="form-control" id="cantidad'.$reg->idmateria_prima_prod.'" value="'.$reg->cantidad.'" onchange="actualizar_mat_prod('.$reg->idmateria_prima_prod.');"></td>
									<td><input type="text" class="form-control" id="medidas_req'.$reg->idmateria_prima_prod.'" value="'.$reg->medidas.'" onchange="calcular_cortes('.$reg->idmateria_prima_prod.',\''.$reg->tipo.'\');"></td>
									<td><label style="visibility:'.$visib.'">x</label></td>
									<td><input type="text" class="form-control" id="medidas2_req'.$reg->idmateria_prima_prod.'" value="'.$reg->medidas2.'" onchange="calcular_cortes('.$reg->idmateria_prima_prod.',\''.$reg->tipo.'\');" style="visibility:'.$visib.'"></td>
									
									<td><input type="text" class="form-control" id="" value="'.$reg->unidad.'" disabled></td>
    								
	                             </tr>


						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_material_prod_calc':

			$id=$_GET['id'];

			$rspta = $tabulador->listar_material_prod($id);



						echo '	<thead>
	                              <tr>
	                              
	                              	<th>Material</th>
	                              	<th colspan="3">Medida Tramo</th>
	                              	<th>Unidad de medida</th>
	                              	<th>Cortes</th>
	                              	<th>Remanente</th>
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{


						if ($reg->tipo==2) {
							$visib = "visible";
						}elseif ($reg->tipo==1) {
							$visib = "hidden";
						}

						echo '

								<tr>

									<td>'.$reg->descripcion.'<br>
									Calibre: '.$reg->calibre.' <br>
									Pulgadas: '.$reg->pulgadas.' <br>

									</td>
    								<td><input type="text" class="form-control" id="valor_tramo'.$reg->idmateria_prima_prod.'" value="'.$reg->valor_tramo.'" onchange=" calcular_cortes('.$reg->idmateria_prima_prod.',\''.$reg->tipo.'\');"></td>
    								<td><label style="visibility:'.$visib.'">x</label></td>
    								<td><input type="text" class="form-control" id="valor2_tramo'.$reg->idmateria_prima_prod.'" value="'.$reg->valor_tramo2.'" onchange=" calcular_cortes('.$reg->idmateria_prima_prod.',\''.$reg->tipo.'\');" style="visibility:'.$visib.'"></td>
    								<td><input type="text" class="form-control" id="" value="'.$reg->unidad_m.'" disabled></td>
    								
    								<td><input type="text" class="form-control" id="cortes'.$reg->idmateria_prima_prod.'" value="'.$reg->cortes.'" disabled></td>
    								<td><input type="text" class="form-control" id="remanente'.$reg->idmateria_prima_prod.'" value="'.$reg->remanente.'" disabled></td>
	                             </tr>


						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'consul_categ':

			$buscar_prod = $_POST['buscar_prod'];

			$rspta=$tabulador->consul_categ($buscar_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_materiales':

			$rspta = $tabulador->listar_materiales();



						echo '	<thead>
	                              <tr>
	                              	<th>Agregar</th>
	                              	<th>Descripción</th>
	                              	<th>Calibre</th>
	                              	<th>Pulgadas</th>
	                              	<th>Medidas tramo</th>
	                              	<th>Unidad de medida</th>
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->tipo==1) {
							$medidas = $reg->valor_tramo;
						}elseif ($reg->tipo==2) {
							$medidas = $reg->valor_tramo." x ".$reg->valor_tramo2;
						}

						echo '

								<tr>
									<td><button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Agregar materia prima" onclick="agregar_a_producto('.$reg->idmateria_prima.');" id="btn'.$reg->idmateria_prima.'">Agregar</button></td>
									<td>'.$reg->descripcion.'</td>
									<td>'.$reg->calibre.'</td>
    								<td>'.$reg->pulgadas.'</td>
    								<td>'.$medidas.'</td>
    								<td>'.$reg->unidad_m.'</td>
	                             </tr>


						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'agregar_a_producto':

			$idmateria_prima = $_POST['idmateria_prima'];
			$idgroup = $_POST['idgroup'];

			$rspta=$tabulador->agregar_a_producto($idmateria_prima,$idgroup);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'actualizar_mat_prod':

			$idmateria_prima_prod = $_POST['idmateria_prima_prod'];
			$cantidad = $_POST['cantidad'];
			/*$medidas_req = $_POST['medidas_req'];
			$valor_tramo = $_POST['valor_tramo'];
			$cortes = $_POST['cortes'];
			$remanente = $_POST['remanente'];*/

			$rspta=$tabulador->actualizar_mat_prod($idmateria_prima_prod,$cantidad);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'calcular_cortes':

			$idmateria_prima_prod = $_POST['idmateria_prima_prod'];
			$valor_tramo = $_POST['valor_tramo'];
			$medidas_req = $_POST['medidas_req'];

			$medidas_req2 = $medidas_req;
			$contador = 1;

			while ($medidas_req2 <= $valor_tramo) {
				$medidas_req2 = $medidas_req2+$medidas_req;
				$contador = $contador + 1;
			}

			$cortes = $contador - 1;

			$remanente = $valor_tramo - ($cortes * $medidas_req);
			

			$rspta=$tabulador->guardar_cortes($idmateria_prima_prod,$cortes,$remanente,$medidas_req,$valor_tramo);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'calcular_cortes2':

			$idmateria_prima_prod = $_POST['idmateria_prima_prod'];
			$valor_tramo = $_POST['valor_tramo'];
			$valor2_tramo = $_POST['valor2_tramo'];
			$medidas_req = $_POST['medidas_req'];			
			$medidas2_req = $_POST['medidas2_req'];

			$tamano_tramo = $valor_tramo*$valor2_tramo;
			$tamano_req = $medidas_req*$medidas2_req;

			$tamano_req2 = $tamano_req;
			$contador = 1;

			while ($tamano_req2 <= $tamano_tramo) {
				$tamano_req2 = $tamano_req2+$tamano_req;
				$contador = $contador + 1;
			}

			$cortes = $contador - 1;

			$remanente = $tamano_tramo - ($cortes * $tamano_req);
			

			$rspta=$tabulador->guardar_cortes2($idmateria_prima_prod,$cortes,$remanente,$medidas_req,$medidas2_req,$valor_tramo,$valor2_tramo);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'calcular_cantidad_prod':

			$id=$_GET['id'];
			$cant=$_GET['cant'];

			if ($cant=="") {
				$cant = 1;
			}

			$rspta = $tabulador->calcular_cantidad_prod($id);



						echo '	<thead>
	                              <tr>
	                              	<th>Material</th>
	                              	<th>Piezas</th>
	                              	<th>Medidas</th>
	                              	
	                              	<th>Medida de <br> pieza completa</th>
	                              	<th>Cortes por <br> pieza completa</th>
	                              	<th>Numero de <br> piezas completas</th>
	                              	<th>Cortes totales</th>
	                              	<th>Numero de remanentes</th>
	                              	<th>Medida por remanente</th>
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						$cant_piezas=$reg->cantidad*$cant;
						$cantidad_req = $reg->cantidad;
						$contador = 1;
						$cortes_tot = 1;
						$piezas_corte = $reg->cortes;
						

						while ($cantidad_req<$cant_piezas) {

							$cantidad_req=$cantidad_req+$reg->cantidad;

							if ($cantidad_req>$piezas_corte) {
								$cortes_tot=$cortes_tot+1;
								$piezas_corte=$piezas_corte+$reg->cortes;
							}

															
						}

						echo '

								<tr>
									
									<td>'.$reg->descripcion.'</td>
									<td>'.$cant_piezas.'</td>
    								<td>'.$reg->medidas.'</td>
    								<td>'.$reg->valor_tramo.'</td>
    								<td>'.$reg->cortes.'</td>
    								<td>'.$cortes_tot.'</td>
    								<td></td>
    								<td></td>
    								<td></td>
	                             </tr>


						';


						
					}

						echo '</tbody>
							  

						';

		break;
	
}
?>