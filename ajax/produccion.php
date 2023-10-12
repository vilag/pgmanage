<?php
require_once "../modelos/Produccion.php";

$produccion=new Produccion();

switch ($_GET["op"])
	{

		case 'cargar_ops':

			$idusuario=$_GET['idusuario'];

			$rspta = $produccion->cargar_ops($idusuario);

			while ($reg = $rspta->fetch_object())
					{

						if ($reg->cant_noent>0) {

							if ($reg->cant_fab<$reg->cant_tot) {



								$avance = ($reg->cant_fab/$reg->cant_tot)*100;
								$avance = round($avance,1);

								if ($avance>=0 AND $avance<=35) {
									$colorbarra="AF2305";
								}
								if ($avance>=36 AND $avance<=70) {
									$colorbarra="F5880E";
								}

								if ($avance>=71 AND $avance<=99) {
									$colorbarra="94DC03";
								}

								if ($avance>99 AND $avance<=100) {
									$colorbarra="039F26";
								}


								echo '

										<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" style="height:120px; background-color: #fff; border-style: solid; border-color: #ccc; border-width: 2px; cursor: pointer; border-radius: 15px; box-shadow: 10px 5px 5px #ccc;" onclick="ver_productos('.$reg->idop_detalle.',\''.$reg->no_op.'\',\''.$reg->idop.'\',\''.$reg->area.'\',\''.$reg->cant_tot.'\',\''.$avance.'\',\''.$reg->area_fin.'\');">
	                      					<b style="font-size: 30px;">'.$reg->no_op.'</b><br>
	                      					Total: '.$reg->cant_tot.' <br> Avance: '.$reg->cant_fab.'<br>
			                      			<div class="progress" style="height:10px; width: 60%; margin-bottom: 10px; position: absolute;">
				                                <div class="progress-bar" role="progressbar" style="width: '.$avance.'%; background: #'.$colorbarra.';" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
				                                </div>
				                                
							                </div>
							                <div style="float: right; margin-top: -10px;">
							                	<b style="font-size: 20px;">'.$avance.'%</b>
							                </div>
	                      
	                 					 </div>


								';

								
							}





							// code...
						}

							
						
					}
			
		break;

	


		

		case 'consultar_area':

			$idusuario = $_POST['idusuario'];

			$rspta=$produccion->consultar_area($idusuario);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;



		case 'ver_productos':

			$idop=$_GET['idop'];
			$area=$_GET['area'];

			$rspta = $produccion->ver_productos($idop,$area);

			$cant_areas=0;

			while ($reg = $rspta->fetch_object())
					{

								$avance = ($reg->avance/$reg->cant_tot)*100;
								$avance = round($avance,1);

								echo '

										<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4" style="height:320px; background-color: #D9E5F1; border-style: solid; border-color: #fff; border-width: 10px; padding: 30px; cursor: pointer; border-radius: 10px;" onclick="ver_productos_detalle('.$reg->idop_detalle_prod.',\''.$area.'\');">
	                      					 
	                      					<div class="form-group col-lg12 col-md12 col-sm12 col-xs12" style="background-color: #223D58; margin-left: -30px; margin-right: -30px; padding: 20px;">
	                      						<b style="font-size: 20px; color: #A7B9CA;">'.$reg->codigo.'</b><br>'.$reg->producto.'
	                      					</div>
	                      					
	                      					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                      						<hr width="100%">
	                      					</div>
	                      					

	                      					<table class="class="table table-striped table-bordered" style="width:100%">
						                      <thead>
						                        <tr align="center">
						                          
						                          <th>Total</th>
						                          <th>Disp.</th>
						                          <th>Avance</th>
						                          <th>Porc.</th>
						                        </tr>
						                      </thead>
						                      <tbody>
						                        <tr align="center">
						                         
						                          <td><b style="font-size: 15px;">'.$reg->cant_tot.'</b></td>
						                          <td><b style="font-size: 15px;"></b></td>
						                          <td><b style="font-size: 15px;">'.$reg->avance.'</b></td>
						                          <td><b style="font-size: 15px;">'.$avance.'%</b></td>
						                        </tr>
						                        
						                      </tbody>
						                    </table>

	                      					
	                      					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                      						<hr width="100%">
	                      					</div>

	                      					
		                      					
	                      					
				                      			
							                
							                <br>
							                
					                        
					                        
	                      
	                 					 </div>


								';

								$cant_areas = $cant_areas+1;
						
					}

					echo '
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                   Productos de OP: <b id="cant_areas">'.$cant_areas.'</b>
	                </div>


					';
			
		break;

		case 'consultar_idop_detalle_prod':

			$idop_detalle_prod = $_POST['idop_detalle_prod'];
			$area = $_POST['area'];

			$rspta=$produccion->consultar_idop_detalle_prod($idop_detalle_prod,$area);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_avance_prod':
		
			$idop_detalle = $_POST['idop_detalle'];
			$idop_detalle_prod = $_POST['idop_detalle_prod'];
			$avance_nuevo = $_POST['avance_nuevo'];
			$fecha_hora = $_POST['fecha_hora'];
			$idarea = $_POST['idarea'];
			$idpedido = $_POST['idpedido'];
			$iddetalle_pedido = $_POST['iddetalle_pedido'];
			$lote = $_POST['lote'];
			$coment_avance = $_POST['coment_avance'];
			$cant_ingresar_enc = $_POST['cant_ingresar_enc'];
			$cant_ingresar_enc_exc = $_POST['cant_ingresar_enc_exc'];
			$idop = $_POST['idop'];
			$estatus = $_POST['estatus'];
			$idpg_detped = $_POST['idpg_detped'];
			$marca_capt_cant = $_POST['marca_capt_cant'];

			$rspta=$produccion->guardar_avance_prod($idop_detalle,$idop_detalle_prod,$avance_nuevo,$fecha_hora,$idarea,$idpedido,$iddetalle_pedido,$lote,$coment_avance,$cant_ingresar_enc,$cant_ingresar_enc_exc,$idop,$estatus,$idpg_detped,$marca_capt_cant);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar2':
			
			$idusuario=$_GET['idusuario'];
			$no_op=$_GET['no_op'];

			$rspta = $produccion->buscar2($idusuario,$no_op);

			while ($reg = $rspta->fetch_object())
					{

						

								$avance = ($reg->cant_fab/$reg->cant_tot)*100;
								$avance = round($avance,1);

								if ($avance>=0 AND $avance<=35) {
									$colorbarra="AF2305";
								}
								if ($avance>=36 AND $avance<=70) {
									$colorbarra="F5880E";
								}

								if ($avance>=71 AND $avance<=99) {
									$colorbarra="94DC03";
								}

								if ($avance>99 AND $avance<=100) {
									$colorbarra="039F26";
								}


								echo '

										<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" style="height:120px; background-color: #fff; border-style: solid; border-color: #ccc; border-width: 2px; cursor: pointer; border-radius: 15px; box-shadow: 10px 5px 5px #ccc;" onclick="ver_productos('.$reg->idop_detalle.',\''.$reg->no_op.'\',\''.$reg->idop.'\',\''.$reg->area.'\',\''.$reg->cant_tot.'\',\''.$avance.'\');">
	                      					<b style="font-size: 30px;">'.$reg->no_op.'</b><br>
	                      					Total: '.$reg->cant_tot.' <br> Avance: '.$reg->cant_fab.'<br>
			                      			<div class="progress" style="height:10px; width: 60%; margin-bottom: 10px; position: absolute;">
				                                <div class="progress-bar" role="progressbar" style="width: '.$avance.'%; background: #'.$colorbarra.';" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
				                                </div>
				                                
							                </div>
							                <div style="float: right; margin-top: -10px;">
							                	<b style="font-size: 20px;">'.$avance.'%</b>
							                </div>
	                      
	                 					 </div>


								';
						
					}

						
			
		break;

	}


?>