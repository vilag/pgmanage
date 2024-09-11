<?php
require_once "../modelos/Op.php";

$opr=new Opr();

switch ($_GET["op"])
	{

		case 'consul_prod':
		
			$id_detped = $_POST['id_detped'];


			$rspta=$opr->consul_prod($id_detped);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_op':
		
			$id_detped = $_POST['id_detped'];
			$ultimo_op = $_POST['ultimo_op'];
			$prioridad = $_POST['prioridad'];
			$no_control = $_POST['no_control'];

			//$op = $_POST['op'];
			$codigo = $_POST['codigo'];
			$producto = $_POST['producto'];
			$empaque = $_POST['empaque'];
			$cant_tot = $_POST['cant_tot'];

			$fecha_inicio = $_POST['fecha_inicio'];	
			$fecha_term = $_POST['fecha_term'];
			$observ = $_POST['observ'];
			


			$rspta=$opr->guardar_op($id_detped,$ultimo_op,$prioridad,$no_control,$codigo,$producto,$empaque,$cant_tot,$fecha_inicio,$fecha_term,$observ);
			echo json_encode($rspta);

		break;
		
		case 'ult_op':

			$rspta=$opr->ult_op();
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'update_op':
		
			$idop = $_POST['idop'];			
			$prioridad = $_POST['prioridad'];			
			$observ = $_POST['observ'];
			$fecha1 = $_POST['fecha1'];
			$fecha2 = $_POST['fecha2'];
			$cant_color = $_POST['cant_color'];

			$rspta=$opr->update_op($idop,$prioridad,$observ,$fecha1,$fecha2,$cant_color);
			echo json_encode($rspta);

		break;


		case 'listar_ops':

			$idusuario=$_GET['idusuario'];

			$rspta = $opr->listar_ops();


			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

													<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->idop.'" aria-expanded="true" aria-controls="collapseOne" onclick="listar_ops_detalles2('.$reg->idop.');">

                                                        	<table id="datatable_buttons" class="table table-hover">
							                                  <tr>
							                                    <td width="10%">
								                                    OP:<br>
								                                    <label style="font-weight: bold; font-size: 20px;">'.$reg->no_op.'</label><br>
							                                    </td>
							                                   
							                                   
							                                  </tr>
							                                  
							                                </table>

                                                          
                                                        </a>
                                                        <div id="collapseOne'.$reg->idop.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                          <div class="panel-body">
                                                          	
                                                            


						';


						/*

								<td width="45%">
								                                    Fecha de inicio:<br>
								                                    <label style="font-weight: bold; font-size: 15px;">'.$reg->f_ini.'</label><br>
							                                    </td>
							                                    <td width="45%">
								                                    Fecha de termino:<br>
								                                    <label style="font-weight: bold; font-size: 15px;">'.$reg->f_fin.'</label><br>
							                                    </td>

						*/

						if (($idusuario==1) OR ($idusuario==7) OR ($idusuario==8) OR ($idusuario==9) OR ($idusuario>=11 AND $idusuario<=12) OR ($idusuario==14) OR ($idusuario==24)) {

							echo '
															<a href="#" onclick="abrir_modal_reg_areas('.$reg->idop.');"><h1>+</h1></a>


							';
						}

						

						echo '
															<table class="table table-bordered" id="tbl_prod_detalle'.$reg->idop.'">
                                                              
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>

						';


						
					}

						
		break;

		

		case 'listar_ops_area':

			$idusuario=$_GET['id'];
			$valor=$_GET['valor'];
			$fecha=$_GET['fecha'];

			$rspta = $opr->listar_ops_area($valor,$fecha);



						echo '	<thead>
	                              <tr>
	                              	<th width="20%"></th>
	                              	<th width="20%">OP</th>
	                              	<th width="20%">Área</th>
	                              	<th width="20%">Fecha de inicio</th>
	                              	<th width="40%">Fecha de termino</th>
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->area==1) {
							$area="Herrería";
						}elseif ($reg->area==2) {
							$area="Pintura";
						}elseif ($reg->area==3) {
							$area="Plásticos";
						}elseif ($reg->area==5) {
							$area="Ensamble (Porcelanizado)";
						}elseif ($reg->area==6) {
							$area="Ensamble (Comercial)";
						}elseif ($reg->area==7) {
							$area="Ensamble (Mueble)";
						}elseif ($reg->area==8) {
							$area="Horno";
						}elseif ($reg->area>8 || $reg->area<1 || $reg->area==4) {
							$area="";
						}

						echo '

								<tr>
									
									<td>';

						if ($idusuario<15) {


							echo '

										<button type="button" class="btn btn-dark" id="btn_ver_opdet" onclick="mostrar_opdet('. $reg->idop_detalle.')"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
										<a href="" id="enlace_op3'.$reg->idop_detalle.'" onclick="abrir_op3('.$reg->idop_detalle.');" target="_blank">
                                            <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
                                        </a>

							';
							
						}


						if (($idusuario==1) OR ($idusuario==8) OR ($idusuario==7) OR ($idusuario==9) OR ($idusuario>=11 AND $idusuario<=12) OR ($idusuario==14) OR ($idusuario>=15 AND $idusuario<=21)) {

								echo '

							<button type="button" class="btn btn-dark" id="btn_ver_opdet" onclick="registro_avance('. $reg->idop_detalle.',\''.$reg->idop.'\',\''.$reg->area.'\')"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span></button>';
							
						}
						

						


						echo '

								</td>
									<td>'.$reg->no_op.'</td>				
									<td>'.$area.'</td>
	                                
	                                <td>'.$reg->fecha_inicio .'</td>
	                                
	                                <td>'.$reg->fecha_term .'</td>
	                              
	                            </tr>

						';

									


						
										
                                        


						


						
					}

						echo '</tbody>
							  

						';
			
		break;


		case 'listar_ops_buscar':

			$idusuario=$_GET['idusuario'];
			$valor=$_GET['valor'];
			$fecha=$_GET['fecha'];

			$rspta = $opr->listar_ops_buscar($valor,$fecha);


			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '

													<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->idop.'" aria-expanded="true" aria-controls="collapseOne" onclick="listar_ops_detalles2('.$reg->idop.');">
                                                          <h4 class="panel-title" style="text-align: left;">No. OP: '.$reg->no_op.'</h4>
                                                        </a>
                                                        <div id="collapseOne'.$reg->idop.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                          <div class="panel-body">
                                                          	
                                                            


						';

						if (($idusuario==1) OR ($idusuario==7) OR ($idusuario==8) OR ($idusuario==9) OR ($idusuario>=11 AND $idusuario<=12) OR ($idusuario==14)) {

							echo '
															<a href="#" onclick="abrir_modal_reg_areas('.$reg->idop.');"><h1>+</h1></a>


							';
						}

						

						echo '
															<table class="table table-bordered" id="tbl_prod_detalle'.$reg->idop.'">
                                                              
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>

						';


						
					}

						
		break;

		case 'consul_opexist':
		
			$id_detped = $_POST['id_detped'];


			$rspta=$opr->consul_opexist($id_detped);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'set_op':
		
			$id_detped = $_POST['id_detped'];
			$num_op = $_POST['num_op'];


			$rspta=$opr->set_op($id_detped,$num_op);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_op_all':
		
			$idop_consul = $_POST['idop_consul'];


			$rspta=$opr->consul_op_all($idop_consul);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'consul_idop':
		
			$id_detped = $_POST['id_detped'];


			$rspta=$opr->consul_idop($id_detped);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'insert_check':
		
			$idop = $_POST['idop'];
			$area = $_POST['area'];
			$fecha_hora = $_POST['fecha_hora'];

			$rspta=$opr->insert_check($idop,$area,$fecha_hora);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		

		case 'listar_ops_detalles':

			$id=$_GET['id'];

			$rspta = $opr->listar_ops_detalles($id);



						echo '	<thead>
	                              
	                              <tr>
	                              	
	                              	<th width="40%">Área</th>
	                              
	                              	<th width="30%">
	                              	
	                              	 Secuencia
	                              	</th>
	                              	<th width="15%"></th>
	                              	<th width="15%"></th>
	                              </tr>
	                            </thead>
	                            <tbody>';

	                            $consec = 1;

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->area==1) {
							$area="Herrería";
						}elseif ($reg->area==2) {
							$area="Pintura";
						}elseif ($reg->area==3) {
							$area="Plásticos";
						}elseif ($reg->area==5) {
							$area="Ensamble (Porcelanizado)";
						}elseif ($reg->area==6) {
							$area="Ensamble (Comercial)";
						}elseif ($reg->area==7) {
							$area="Ensamble (Mueble)";
						}elseif ($reg->area==8) {
							$area="Horno";
						}elseif ($reg->area>8 || $reg->area<1 || $reg->area==4) {
							$area="";
						}

						

						echo '

								<tr>
									
													
									<td>'.$area.'</td>

									

									<td>
														<select  id="select_prioridad'.$reg->idop_detalle.'" class="form-control selectpicker" onchange="reordenar('.$reg->idop_detalle.',\''.$reg->prioridad.'\',\''.$id.'\');">  
                                <option value="'.$reg->prioridad.'">'.$consec.'</option>
                                                                       
						';


						$idop_detalle = $reg->idop_detalle;


						$rspta2 = $opr->listar_ops_detalles_opt($id);

						$consec2 = 1;

						while ($reg2 = $rspta2->fetch_object())
						{

							echo '
									<option value="'.$reg2->prioridad.'">'.$consec2.'</option>
							';

							$consec2 = $consec2+1;

						}


						echo '
											</select>

									</td>

									<td>
												
                     <button type="button" class="btn btn-dark" onclick="eliminar_area_op('.$reg->idop_detalle.');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                            
									</td>

									<td>

										<a href="" id="enlace_op3'.$reg->idop_detalle.'" onclick="abrir_op3('.$reg->idop_detalle.');" target="_blank">
                         <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
                      </a>

									</td>
	                                
	                             </tr>

						';


							/*$servername = 'localhost';
							//$username = 'u690371019_pgmanage';
							$username = 'root';
							//$password = "A=tSXZ4z";
							$password = "";
							$dbname = "u690371019_pgmanage";

							// Create connection
							$conn = new mysqli($servername, $username, $password, $dbname);
									$sql="UPDATE op_detalle SET orden_prod='$consec' WHERE idop_detalle='$idop_detalle' AND disabled=0";
									$result = $conn->query($sql);
							$conn->close();*/

						$consec = $consec+1;
						
					}

						echo '</tbody>
							  

						';
			
		break;


		case 'listar_ops_detalles2':

			$id=$_GET['id'];
			$idusuario=$_GET['idusuario'];

			$rspta = $opr->listar_ops_detalles2($id);



						echo '	<thead>
	                              <tr>
	                              	<th width="20%"></th>
	                              	
	                              	<th width="20%">Área</th>
	                              	<th width="20%">Fecha limite</th>
	                              	<th width="40%">Avance</th>
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->area==1) {
							$area="Herrería";
						}elseif ($reg->area==2) {
							$area="Pintura";
						}elseif ($reg->area==3) {
							$area="Plásticos";
						}elseif ($reg->area==5) {
							$area="Ensamble (Porcelanizado)";
						}elseif ($reg->area==6) {
							$area="Ensamble (Comercial)";
						}elseif ($reg->area==7) {
							$area="Ensamble (Mueble)";
						}elseif ($reg->area==8) {
							$area="Horno";
						}elseif ($reg->area>8 || $reg->area<1 || $reg->area==4) {
							$area="";
						}

						echo '

								<tr>
									
									<td>';

						if ($idusuario<15) {


							echo '

										<button type="button" class="btn btn-dark" id="btn_ver_opdet" onclick="mostrar_opdet('. $reg->idop_detalle.')"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
										<a href="" id="enlace_op3'.$reg->idop_detalle.'" onclick="abrir_op3('.$reg->idop_detalle.');" target="_blank">
                                            <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
                                        </a>

							';
							
						}


						if (($idusuario==1) OR ($idusuario==4) OR ($idusuario==8) OR ($idusuario==7) OR ($idusuario==9) OR ($idusuario>=11 AND $idusuario<=12) OR ($idusuario==14) OR ($idusuario>=15 AND $idusuario<=21) OR ($idusuario==22)) {

								echo '

							<button type="button" class="btn btn-dark" id="btn_ver_opdet" onclick="registro_avance('. $reg->idop_detalle.',\''.$reg->idop.'\',\''.$reg->area.'\')"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span></button>';
							
						}
						

						


						echo '

								</td>
													
									<td>'.$area.'</td>
	                                
	                                <td>'.$reg->hora_inicio .'</td>
	                                
	                                <td></td>
	                              
	                            </tr>

						';

									


						
										
                                        


						


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'consul_area':
		
			$idop = $_POST['idop'];
			//$area = $_POST['area'];

			$rspta=$opr->consul_area($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_area2':
		
			$idop = $_POST['idop'];
			//$area = $_POST['area'];

			$rspta=$opr->consul_area2($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_area3':
		
			$idop = $_POST['idop'];
			//$area = $_POST['area'];

			$rspta=$opr->consul_area3($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		

		case 'consul_area5':
		
			$idop = $_POST['idop'];
			//$area = $_POST['area'];

			$rspta=$opr->consul_area5($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_area6':
		
			$idop = $_POST['idop'];
			//$area = $_POST['area'];

			$rspta=$opr->consul_area6($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_area7':
		
			$idop = $_POST['idop'];
			//$area = $_POST['area'];

			$rspta=$opr->consul_area7($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_area8':
		
			$idop = $_POST['idop'];
			//$area = $_POST['area'];

			$rspta=$opr->consul_area8($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		

		case 'guadar_op_det':
		
			$idop = $_POST['idop'];
			$id_detped = $_POST['id_detped'];
			$no_control = $_POST['no_control'];
			$codigo = $_POST['codigo'];
			$producto = $_POST['producto'];
			$empaque = $_POST['empaque'];
			$cantidad = $_POST['cantidad'];
			$fecha_inicio = $_POST['fecha_inicio'];
			$fecha_term = $_POST['fecha_term'];
			$observaciones = $_POST['observaciones'];
			$medida = $_POST['medida'];
			$color = $_POST['color'];
			$iddetalle_pedido = $_POST['iddetalle_pedido'];		

			$rspta=$opr->guadar_op_det($idop,$id_detped,$no_control,$codigo,$producto,$empaque,$cantidad,$fecha_inicio,$fecha_term,$observaciones,$medida,$color,$iddetalle_pedido);
			echo json_encode($rspta);

		break;

		case 'listar_ops2':

			$id=$_GET['id'];

			$rspta = $opr->listar_ops2($id);



						echo '	<thead>
	                              <tr>
	                              	
	                              	
	                              	
	                              	<th>Cant.</th>
	                              	<th>Producto</th>
	                              	
	                              	
	                              	
	                              	<th>Fechas</th>
	                              	
	                              	<th>Observ.</th>
	                              	<th>Quitar</th>
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '

								<tr>
									
									
													
									
	                                <td>'.$reg->cant_tot.'</td>
	                                <td>
	                                	<b>'.$reg->codigo.'</b><br>
	                                	'.$reg->producto.'<br>
	                                	Medida: '.$reg->medida.', Color: '.$reg->color.' <br>
	                                	No. Control: <b>'.$reg->no_control.'</b><br>
	                                	Empaque: <b>'.$reg->empaque.'</b>
	                                </td>
	                                
	                               
	                                
	                                
	                                <td>
	                                	Fecha ini.: <br> '.$reg->fecha_inicio.' <br>
	                                	Fecha Term.: <br> '.$reg->fecha_term.'
	                                </td>
	                                
	                                <td>'.$reg->observ.'</td>
	                                <td><span class="glyphicon glyphicon-trash" aria-hidden="true" style="cursor:pointer;" onclick="quitar_prod_op('.$reg->idop_detalle_prod.',\''.$reg->idpg_detped.'\');"></span></td>
	                             </tr>


						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'quitar_prod_op':
		
			$idop_detalle_prod = $_POST['idop_detalle_prod'];
			$idpg_detped = $_POST['idpg_detped'];
			//$area = $_POST['area'];

			$rspta=$opr->quitar_prod_op($idop_detalle_prod,$idpg_detped);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		

		case 'listar_prod_avance':

			$id=$_GET['id'];

			$rspta = $opr->listar_prod_avance($id);

			while ($reg = $rspta->fetch_object())

					/*if ($reg->estatus=="Fabricado") {
						$estatus=="(Fabricado)";
					}elseif ($reg->estatus<>"Fabricado") {
						$estatus=="()";
					}*/

					{

						echo '
							<option value="'.$reg->idop_detalle_prod.'">'. $reg->no_control .' - '.$reg->codigo.' - '.$reg->producto.'    ('.$reg->estatus.')</option>
						';	
					}

			
		break;

		case 'cargar_campos_avance':

			$id=$_GET['id'];
			$area=$_GET['area'];
			$idusuario=$_GET['idusuario'];

			$rspta = $opr->cargar_campos_avance($id,$area);

			while ($reg = $rspta->fetch_object())
					{

						$requeridos = $reg->cant_tot;
						$avance = $reg->avance;

						$porcentaje = ($avance/$requeridos)*100;

						/*if ($idusuario==20 || $idusuario==1) {
							$vis = "visible";
						}elseif ($idusuario<>20 && $idusuario<>1) {
							$vis = "hidden";
						}*/

						if ($reg->avance==$reg->cant_tot) {
							$disabled_ex = "";
						}elseif ($reg->avance<$reg->cant_tot) {
							$disabled_ex = "disabled";
						}

						if ($reg->estatus==2) {
							$text_estatus = "Cancelado para esta área";
							// code...
						}elseif ($reg->estatus<2) {
							$text_estatus = "";
						}

						echo '
							


												<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
																										<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
																											<b style="font-size: 20px;">'.$text_estatus.'</b>
																										</div>

                                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                      <label>Codigo</label>
                                                      <input type="text" class="form-control" id="codigo_avance'.$reg->idop_detalle_prod.'" value="'.$reg->codigo.'" disabled="">
                                                      <input type="hidden" class="form-control" id="pedido_avance'.$reg->idop_detalle_prod.'" value="'.$reg->idpg_pedidos.'" disabled="">
                                                      <input type="hidden" class="form-control" id="detalle_ped_avance'.$reg->idop_detalle_prod.'" value="'.$reg->idpg_detalle_pedidos.'" disabled="">
                                                    </div>
                                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                      <label>Requeridos</label>
                                                      <input type="number" class="form-control" id="requeridos_avance'.$reg->idop_detalle_prod.'" value="'.$reg->cant_tot.'" disabled="">
                                                    </div>

                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                      <label>Cantidad a ingresar</label>
                                                      <input type="number" class="form-control" id="cantidad_indep_avance'.$reg->idop_detalle_prod.'" onchange="calcular_avance('.$reg->idop_detalle_prod.',\''.$reg->idop.'\');">
                                                      <input type="hidden" id="cantareas_avance'.$reg->idop_detalle_prod.'" value="'.$reg->areas_avance.'">
                                                    </div>

                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                      <label>Avance</label>
                                                      <input type="number" class="form-control" id="cantidad_avance'.$reg->idop_detalle_prod.'" value="'.$reg->avance.'" onkeyup="calcular_avance2('.$reg->idop_detalle_prod.');" disabled>
                                                      <input type="hidden" class="form-control" id="cantidad_avance_ant'.$reg->idop_detalle_prod.'" value="'.$reg->avance.'">
                                                    </div>

                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    	<label>Comentario</label>
                                                    	<input type="text" class="form-control" id="coment_avance'.$reg->idop_detalle_prod.'">
                                                    </div>

                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                                               
		                                                  	<label>Empacado</label>
		                                                    <select  id="option_empaque'.$reg->idop_detalle_prod.'" class="form-control selectpicker" onchange="guardar_estatus_empaque('.$reg->idop_detalle_prod.');" disabled>  
		                                                      <option value="">Seleccionar</option>
		                                                      <option value="1">Si</option>
		                                                      <option value="2">No</option>                                          
		                                                    </select> 
		                                               
		                                                    
		                                             </div>
                                                    
                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                      
                                                      <button type="button" class="btn btn-primary"  id="btn_save_avance'.$reg->idop_detalle_prod.'" onclick="guardar_avance_prod('.$reg->idop_detalle_prod.',\''.$reg->idop.'\',\''.$reg->estatus_op.'\',\''.$reg->idpg_detped.'\')" disabled><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>

                                                      <button type="button" class="btn btn-primary"  id="btn_extra'.$reg->idop_detalle_prod.'" onclick="abrir_extra('.$reg->idop_detalle_prod.')" '.$disabled_ex.'>Excedente</button>

                                                      <h6 id="eti_activ_btn'.$reg->idop_detalle_prod.'" style="color: red;">Se activará cuando seleccione el estatus del empaque</h6>
                                                      <script type="text/javascript">
                      									$("#eti_activ_btn'.$reg->idop_detalle_prod.'").hide();
                    								  </script>
                                                    </div>
                                                    

                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                                        <div class="progress">
                                                          <div class="progress-bar progress-bar-striped" role="progressbar" style="width: '.$porcentaje.'%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                                                        <label>'.$porcentaje.'%</label>
                                                       
                                                    </div>

                                                 </div>




						';	
					}

			
		break;


		// case 'cargar_campos_avance2':

		// 	//$id=$_GET['id'];
		// 	$area=$_GET['area'];

		// 	$rspta = $opr->cargar_campos_avance2($area);

		// 	while ($reg = $rspta->fetch_object())
		// 			{

		// 				$requeridos = $reg->cant_tot;
		// 				$avance = $reg->avance;

		// 				$porcentaje = ($avance/$requeridos)*100;

		// 				echo '
							


		// 										<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

        //                                             <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
        //                                               <label>Codigo</label>
        //                                               <input type="text" class="form-control" id="codigo_avance'.$reg->idop_detalle_prod.'" value="'.$reg->codigo.'" disabled="">
        //                                             </div>
        //                                             <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
        //                                               <label>Requeridos</label>
        //                                               <input type="number" class="form-control" id="requeridos_avance'.$reg->idop_detalle_prod.'" value="'.$reg->cant_tot.'" disabled="">
        //                                             </div>

        //                                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
        //                                               <label>Avance</label>
        //                                               <input type="number" class="form-control" id="cantidad_avance'.$reg->idop_detalle_prod.'" value="'.$reg->avance.'">
        //                                               <input type="hidden" class="form-control" id="cantidad_avance_ant'.$reg->idop_detalle_prod.'" value="'.$reg->avance.'">
        //                                             </div>
                                                    
                                                    
        //                                             <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
        //                                               <label>_</label>
        //                                               <button type="button" class="btn btn-primary"  id="btn_save_avance'.$reg->idop_detalle_prod.'" onclick="guardar_avance_prod('.$reg->idop_detalle_prod.')">Guardar</button>
        //                                             </div>
        //                                             <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
        //                                               <label>_</label>
        //                                               <button type="button" class="btn btn-primary"  id="" onclick="cargar_historial_avances('.$reg->idop_detalle_prod.')">Historial</button>
        //                                             </div>

        //                                             <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        //                                                 <div class="progress">
        //                                                   <div class="progress-bar progress-bar-striped" role="progressbar" style="width: '.$porcentaje.'%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
        //                                                 </div>
        //                                             </div>

        //                                             <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
        //                                                 <label>_</label>
                                                       
        //                                             </div>

        //                                          </div>




		// 				';	
		// 			}

			
		// break;

		case 'buscar_op':
		
			$idop_detalle = $_POST['idop_detalle'];
			//$area = $_POST['area'];

			$rspta=$opr->buscar_op($idop_detalle);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_estatus_op':
		
			$idop = $_POST['idop'];
			//$area = $_POST['area'];

			$rspta=$opr->consul_estatus_op($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_estatus_op2':
		
			$idop_detalle_prod = $_POST['idop_detalle_prod'];
			//$area = $_POST['area'];

			$rspta=$opr->consul_estatus_op2($idop_detalle_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_op_detalle':
		
			$idop_detalle = $_POST['idop_detalle'];
			//$area = $_POST['area'];

			$rspta=$opr->buscar_op_detalle($idop_detalle);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'update_op_area':
		
			$idop_detalle = $_POST['idop_detalle'];

			$lote_r = $_POST['lote_r'];
			$cant_r = $_POST['cant_r'];
			$maquina_r = $_POST['maquina_r'];
			$ciclo_r = $_POST['ciclo_r'];
			$productividad_r = $_POST['productividad_r'];
			$cumplimiento_r = $_POST['cumplimiento_r'];
			$diferencia_r = $_POST['diferencia_r'];
			$entregas_r = $_POST['entregas_r'];
			$reproceso_r = $_POST['reproceso_r'];
			$desperdicio_r = $_POST['desperdicio_r'];
			$merma_r = $_POST['merma_r'];
			//$cumpl_fecha_r = $_POST['cumpl_fecha_r'];
			$observ_area_r = $_POST['observ_area_r'];

			$real_fecha1 = $_POST['real_fecha1'];
			$real_hora1 = $_POST['real_hora1'];
			$real_fecha2 = $_POST['real_fecha2'];
			$real_hora2 = $_POST['real_hora2'];
			$prod_aprob_r = $_POST['prod_aprob_r'];
		

			$rspta=$opr->update_op_area($idop_detalle,$lote_r,$cant_r,$maquina_r,$ciclo_r,$productividad_r,$cumplimiento_r,$diferencia_r,$entregas_r,$reproceso_r,$desperdicio_r,$merma_r,$observ_area_r,$real_fecha1,$real_hora1,$real_fecha2,$real_hora2,$prod_aprob_r);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consulta_op':
		
			$idop = $_POST['idop'];
			//$area = $_POST['area'];

			$rspta=$opr->consulta_op($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_avance_prod':
		
			$idop_detalle_prod = $_POST['idop_detalle_prod'];
			$avance = $_POST['avance'];
			$fecha_hora = $_POST['fecha_hora'];
			$area_num = $_POST['area_num'];
			$pedido = $_POST['pedido'];
			$idpg_detalle_pedidos = $_POST['idpg_detalle_pedidos'];
			$lote = $_POST['lote'];

			$coment_avance = $_POST['coment_avance'];
			$cantidad_indep_avance = $_POST['cantidad_indep_avance'];
			$idop = $_POST['idop'];

			$rspta=$opr->guardar_avance_prod($idop_detalle_prod,$avance,$fecha_hora,$area_num,$pedido,$idpg_detalle_pedidos,$lote,$coment_avance,$cantidad_indep_avance,$idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'cargar_historial_avances':

			$id=$_GET['id'];
			$area=$_GET['area'];

			$rspta = $opr->cargar_historial_avances($id,$area);



						echo '	<thead>
	                              <tr>
	                              	
	                              	
	                              	<th>Fecha/hora</th>
	                              	<th>Cantidad entregada</th>
	                              	<th>Total</th>
	                              	<th>Avance</th>
	                              	<th>%</th>
	                              	<th>Lote</th>
	                              	<th>Comentario</th>
	                              	<th>Eliminar</th>
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						$requeridos = $reg->cant_tot;
						$avance = $reg->avance;

						$porcentaje = round(($avance/$requeridos)*100,1);



						/*if ($reg->cant_exc==null OR $reg->cant_exc=="") {
							$cant_exc = 0;
						}elseif ($reg->cant_exc>0) {
							$cant_exc = $reg->cant_exc;
						}

						if ($reg->ultimo_avance=='' OR $reg->ultimo_avance==null) {
							$ultimo_avance=0;
						}elseif ($reg->ultimo_avance>=0) {
							$ultimo_avance=$reg->ultimo_avance;
						}
						
						$cantidad_capt = ($reg->avance+$cant_exc)-$ultimo_avance;*/



						echo '

															<tr>
																	<td>'.$reg->fecha_hora.'</td>
	                                <td>	                                
	                                <input type="number" name="" id="cant_entregada'.$reg->idavance_prod.'" class="form-control" value="'.$reg->cant_capt.'" onchange="upd_cant_avance_prod('.$reg->idavance_prod.');" disabled>
	                                </td>
	                                <td>'.$reg->cant_tot.'</td>
	                                <td>'.$reg->avance.'</td>
	                                <td>'.$porcentaje.'%</td>
	                                <td>'.$reg->lote.'</td>
	                                <td>'.$reg->comentario.'</td>
	                                <td><button type="button" class="btn btn-dark" id="" onclick="borrar_avance('.$reg->idavance_prod.');"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: white;"></span></button></td>
	                             </tr>


						';


						
					}

						echo '</tbody>
							  

						';
			
		break;


		case 'cargar_excedentes':

			$id=$_GET['id'];
			$area=$_GET['area'];

			$rspta = $opr->cargar_excedentes($id,$area);



						echo '	<thead>
	                              <tr>
	                              	
	                              	
	                              	<th>Fecha/hora</th>
	                              	<th>Cantidad excedente</th>
	                              	<th>Lote</th>
									<th>Eliminar</th>
	                              
	                              	
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '

								<tr>
									
									
													
									<td>'.$reg->fecha_hora.'</td>
	                                
	                                <td>'.$reg->cantidad.'</td>
	                                <td>'.$reg->lote.'</td>
	                                <td><button type="button" class="btn btn-dark" id="" onclick="borrar_excedente('.$reg->idop_detalle_exc.');"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: white;"></span></button></td>
	                                
	                             </tr>


						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'consul_area_avance':
		
			$idusuario = $_POST['idusuario'];

			$rspta=$opr->consul_area_avance($idusuario);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consultar_iddetped':
		
			$idop_detalle_prod = $_POST['idop_detalle_prod'];

			$rspta=$opr->consultar_iddetped($idop_detalle_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'cantidades':
		
			$pedido = $_POST['pedido'];

			$rspta=$opr->cantidades($pedido);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_cant_areas':
		
			$idop_detalle_prod = $_POST['idop_detalle_prod'];

			$rspta=$opr->buscar_cant_areas($idop_detalle_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'contar_avance_tot':
		
			$idop_detalle_prod = $_POST['idop_detalle_prod'];

			$rspta=$opr->contar_avance_tot($idop_detalle_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_avance_calc':
		
			$idop_detalle_prod = $_POST['idop_detalle_prod'];
			$area_num = $_POST['area_num'];

			$rspta=$opr->consul_avance_calc($idop_detalle_prod,$area_num);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_productos_op':

			$id=$_GET['id'];

			$rspta = $opr->listar_productos_op($id);

						if ($id==1) {
							$backg_titulo1 = "#000000";
							$color_titulo1 = "#ffffff";$backg_titulo2 = "";$color_titulo2 = "";$backg_titulo3 = "";$color_titulo3 = "";$backg_titulo5 = "";$color_titulo5 = "";$backg_titulo6 = "";$color_titulo6 = "";$backg_titulo7 = "";$color_titulo7 = "";$backg_titulo8 = "";$color_titulo8 = "";
						}elseif ($id==0) {
							$backg_titulo1 = "";
							$color_titulo1 = "";
							$backg_titulo2 = "";
							$color_titulo2 = "";
							$backg_titulo3 = "";
							$color_titulo3 = "";
							$backg_titulo5 = "";
							$color_titulo5 = "";
							$backg_titulo6 = "";
							$color_titulo6 = "";
							$backg_titulo7 = "";
							$color_titulo7 = "";
							$backg_titulo8 = "";
							$color_titulo8 = "";
						}

						if ($id==2) {
							
							$backg_titulo1 = "";
							$color_titulo1 = "";
							$backg_titulo2 = "#000000";
							$color_titulo2 = "#ffffff";
							$backg_titulo3 = "";
							$color_titulo3 = "";
							$backg_titulo5 = "";
							$color_titulo5 = "";
							$backg_titulo6 = "";
							$color_titulo6 = "";
							$backg_titulo7 = "";
							$color_titulo7 = "";
							$backg_titulo8 = "";
							$color_titulo8 = "";
						}elseif ($id==0) {
							$backg_titulo1 = "";
							$color_titulo1 = "";
							$backg_titulo2 = "";
							$color_titulo2 = "";
							$backg_titulo3 = "";
							$color_titulo3 = "";
							$backg_titulo5 = "";
							$color_titulo5 = "";
							$backg_titulo6 = "";
							$color_titulo6 = "";
							$backg_titulo7 = "";
							$color_titulo7 = "";
							$backg_titulo8 = "";
							$color_titulo8 = "";
						}

						if ($id==3) {
							
							$backg_titulo1 = "";
							$color_titulo1 = "";
							$backg_titulo2 = "";
							$color_titulo2 = "";
							$backg_titulo3 = "#000000";
							$color_titulo3 = "#ffffff";
							$backg_titulo5 = "";
							$color_titulo5 = "";
							$backg_titulo6 = "";
							$color_titulo6 = "";
							$backg_titulo7 = "";
							$color_titulo7 = "";
							$backg_titulo8 = "";
							$color_titulo8 = "";
						}elseif ($id==0) {
							$backg_titulo1 = "";
							$color_titulo1 = "";
							$backg_titulo2 = "";
							$color_titulo2 = "";
							$backg_titulo3 = "";
							$color_titulo3 = "";
							$backg_titulo5 = "";
							$color_titulo5 = "";
							$backg_titulo6 = "";
							$color_titulo6 = "";
							$backg_titulo7 = "";
							$color_titulo7 = "";
							$backg_titulo8 = "";
							$color_titulo8 = "";
						}

						if ($id==5) {
							
							$backg_titulo1 = "";
							$color_titulo1 = "";
							$backg_titulo2 = "";
							$color_titulo2 = "";
							$backg_titulo3 = "";
							$color_titulo3 = "";
							$backg_titulo5 = "#000000";
							$color_titulo5 = "#ffffff";
							$backg_titulo6 = "";
							$color_titulo6 = "";
							$backg_titulo7 = "";
							$color_titulo7 = "";
							$backg_titulo8 = "";
							$color_titulo8 = "";
						}elseif ($id==0) {
							$backg_titulo1 = "";
							$color_titulo1 = "";
							$backg_titulo2 = "";
							$color_titulo2 = "";
							$backg_titulo3 = "";
							$color_titulo3 = "";
							$backg_titulo5 = "";
							$color_titulo5 = "";
							$backg_titulo6 = "";
							$color_titulo6 = "";
							$backg_titulo7 = "";
							$color_titulo7 = "";
							$backg_titulo8 = "";
							$color_titulo8 = "";
						}

						if ($id==6) {
							
							$backg_titulo1 = "";
							$color_titulo1 = "";
							$backg_titulo2 = "";
							$color_titulo2 = "";
							$backg_titulo3 = "";
							$color_titulo3 = "";
							$backg_titulo5 = "";
							$color_titulo5 = "";
							$backg_titulo6 = "#000000";
							$color_titulo6 = "#ffffff";
							$backg_titulo7 = "";
							$color_titulo7 = "";
							$backg_titulo8 = "";
							$color_titulo8 = "";
						}elseif ($id==0) {
							$backg_titulo1 = "";
							$color_titulo1 = "";
							$backg_titulo2 = "";
							$color_titulo2 = "";
							$backg_titulo3 = "";
							$color_titulo3 = "";
							$backg_titulo5 = "";
							$color_titulo5 = "";
							$backg_titulo6 = "";
							$color_titulo6 = "";
							$backg_titulo7 = "";
							$color_titulo7 = "";
							$backg_titulo8 = "";
							$color_titulo8 = "";
						}

						if ($id==7) {
							
							$backg_titulo1 = "";
							$color_titulo1 = "";
							$backg_titulo2 = "";
							$color_titulo2 = "";
							$backg_titulo3 = "";
							$color_titulo3 = "";
							$backg_titulo5 = "";
							$color_titulo5 = "";
							$backg_titulo6 = "";
							$color_titulo6 = "";
							$backg_titulo7 = "#000000";
							$color_titulo7 = "#ffffff";
							$backg_titulo8 = "";
							$color_titulo8 = "";
						}elseif ($id==0) {
							$backg_titulo1 = "";
							$color_titulo1 = "";
							$backg_titulo2 = "";
							$color_titulo2 = "";
							$backg_titulo3 = "";
							$color_titulo3 = "";
							$backg_titulo5 = "";
							$color_titulo5 = "";
							$backg_titulo6 = "";
							$color_titulo6 = "";
							$backg_titulo7 = "";
							$color_titulo7 = "";
							$backg_titulo8 = "";
							$color_titulo8 = "";
						}

						if ($id==8) {
							
							$backg_titulo1 = "";
							$color_titulo1 = "";
							$backg_titulo2 = "";
							$color_titulo2 = "";
							$backg_titulo3 = "";
							$color_titulo3 = "";
							$backg_titulo5 = "";
							$color_titulo5 = "";
							$backg_titulo6 = "";
							$color_titulo6 = "";
							$backg_titulo7 = "";
							$color_titulo7 = "";
							$backg_titulo8 = "#000000";
							$color_titulo8 = "#ffffff";
						}elseif ($id==0) {
							$backg_titulo1 = "";
							$color_titulo1 = "";
							$backg_titulo2 = "";
							$color_titulo2 = "";
							$backg_titulo3 = "";
							$color_titulo3 = "";
							$backg_titulo5 = "";
							$color_titulo5 = "";
							$backg_titulo6 = "";
							$color_titulo6 = "";
							$backg_titulo7 = "";
							$color_titulo7 = "";
							$backg_titulo8 = "";
							$color_titulo8 = "";
						}




						echo '	<thead>
	                              <tr>
	                              	
	                              	
	                              	<th width="11%">Codigo</th>
	                              	<th width="8%" align="center" style="background: '. $backg_titulo1 .'; color: '. $color_titulo1 .';">Herreria</th>
	                              	<th width="8%" align="center" style="background: '. $backg_titulo2 .'; color: '. $color_titulo2 .';">Pintura</th>
	                              	<th width="8%" align="center" style="background: '. $backg_titulo3 .'; color: '. $color_titulo3 .';">Plasticos</th>
	                              	<th width="8%" align="center" style="background: '. $backg_titulo8 .'; color: '. $color_titulo8 .';">Horno</th>
	                              	<th width="8%" align="center" style="background: '. $backg_titulo5 .'; color: '. $color_titulo5 .';">Ens. P.</th>
	                              	<th width="8%" align="center" style="background: '. $backg_titulo6 .'; color: '. $color_titulo6 .';">Ens. C.</th>
	                              	<th width="8%" align="center" style="background: '. $backg_titulo7 .'; color: '. $color_titulo7 .';">Ens. M.</th>
	                              	
	                              	<th width="8%" align="center">OP</th>
	                              	<th width="8%" align="center">No.<br> Control</th>
	                              	<th width="8%" align="center">Cantidad</th>
	                              	<th width="9%" align="center">Fecha <br> de entrega</th>
	                              		
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->$sum_capt_Herreria=="" OR $reg->$sum_capt_Herreria==null) {
							$sum_capt_Herreria=0;
						}elseif ($reg->$sum_capt_Herreria>0) {
							$sum_capt_Herreria=$reg->$sum_capt_Herreria;
						}

						if ($reg->$sum_capt_Pintura=="" OR $reg->$sum_capt_Pintura==null) {
							$sum_capt_Pintura=0;
						}elseif ($reg->$sum_capt_Pintura>0) {
							$sum_capt_Pintura=$reg->$sum_capt_Pintura;
						}

						if ($reg->$sum_capt_Plasticos=="" OR $reg->$sum_capt_Plasticos==null) {
							$sum_capt_Plasticos=0;
						}elseif ($reg->$sum_capt_Plasticos>0) {
							$sum_capt_Plasticos=$reg->$sum_capt_Plasticos;
						}

						if ($reg->$sum_capt_Ensamble_P=="" OR $reg->$sum_capt_Ensamble_P==null) {
							$sum_capt_Ensamble_P=0;
						}elseif ($reg->$sum_capt_Ensamble_P>0) {
							$sum_capt_Ensamble_P=$reg->$sum_capt_Ensamble_P;
						}

						if ($reg->$sum_capt_Ensamble_C=="" OR $reg->$sum_capt_Ensamble_C==null) {
							$sum_capt_Ensamble_C=0;
						}elseif ($reg->$sum_capt_Ensamble_C>0) {
							$sum_capt_Ensamble_C=$reg->$sum_capt_Ensamble_C;
						}

						if ($reg->$sum_capt_Ensamble_M=="" OR $reg->$sum_capt_Ensamble_M==null) {
							$sum_capt_Ensamble_M=0;
						}elseif ($reg->$sum_capt_Ensamble_M>0) {
							$sum_capt_Ensamble_M=$reg->$sum_capt_Ensamble_M;
						}

						if ($reg->$sum_capt_Horno=="" OR $reg->$sum_capt_Horno==null) {
							$sum_capt_Horno=0;
						}elseif ($reg->$sum_capt_Horno>0) {
							$sum_capt_Horno=$reg->$sum_capt_Horno;
						}




						if ($reg->$av_capt_Herreria=="" OR $reg->$av_capt_Herreria==null) {
							$av_capt_Herreria=0;
						}elseif ($reg->$av_capt_Herreria>0) {
							$av_capt_Herreria=$reg->$av_capt_Herreria;
						}

						if ($reg->$av_capt_Pintura=="" OR $reg->$av_capt_Pintura==null) {
							$av_capt_Pintura=0;
						}elseif ($reg->$av_capt_Pintura>0) {
							$av_capt_Pintura=$reg->$av_capt_Pintura;
						}

						if ($reg->$av_capt_Plasticos=="" OR $reg->$av_capt_Plasticos==null) {
							$av_capt_Plasticos=0;
						}elseif ($reg->$av_capt_Plasticos>0) {
							$av_capt_Plasticos=$reg->$av_capt_Plasticos;
						}

						if ($reg->$av_capt_Ensamble_P=="" OR $reg->$av_capt_Ensamble_P==null) {
							$av_capt_Ensamble_P=0;
						}elseif ($reg->$av_capt_Ensamble_P>0) {
							$av_capt_Ensamble_P=$reg->$av_capt_Ensamble_P;
						}

						if ($reg->$av_capt_Ensamble_C=="" OR $reg->$av_capt_Ensamble_C==null) {
							$av_capt_Ensamble_C=0;
						}elseif ($reg->$av_capt_Ensamble_C>0) {
							$av_capt_Ensamble_C=$reg->$av_capt_Ensamble_C;
						}

						if ($reg->$av_capt_Ensamble_M=="" OR $reg->$av_capt_Ensamble_M==null) {
							$av_capt_Ensamble_M=0;
						}elseif ($reg->$av_capt_Ensamble_M>0) {
							$av_capt_Ensamble_M=$reg->$av_capt_Ensamble_M;
						}
						
						if ($reg->$av_capt_Horno=="" OR $reg->$av_capt_Horno==null) {
							$av_capt_Horno=0;
						}elseif ($reg->$av_capt_Horno>0) {
							$av_capt_Horno=$reg->$av_capt_Horno;
						}



						$av_real_he=max($sum_capt_Herreria,$av_capt_Herreria);
						$av_real_pi=max($sum_capt_Pintura,$av_capt_Pintura);
						$av_real_pl=max($sum_capt_Plasticos,$av_capt_Plasticos);
						$av_real_ep=max($sum_capt_Ensamble_P,$av_capt_Ensamble_P);
						$av_real_ec=max($sum_capt_Ensamble_C,$av_capt_Ensamble_C);
						$av_real_em=max($sum_capt_Ensamble_M,$av_capt_Ensamble_M);
						$av_real_ho=max($sum_capt_Horno,$av_capt_Horno);






						if ($reg->av_real_he>=$reg->cant_tot) {
							$back1="#67D858";
						}elseif ($reg->av_real_he<$reg->cant_tot OR $reg->av_real_he=='') {
							$back1="#F46B67";
						}
						if ($reg->Herreria_exist>0) {
							$etiqueta1='Avance';
							$herreria_req=$reg->cant_tot.' | ';	
							$porc1=round((($reg->av_real_he/$reg->cant_tot)*100),1).'%';						
						}elseif ($reg->Herreria_exist==0 OR $reg->Herreria_exist=='') {
							$etiqueta1='';
							$herreria_req = '';
							$back1="#FFFFFF";
							$porc1="";
						}


						
						if ($reg->Pintura>=$reg->cant_tot) {
							$back2="#67D858";
						}elseif ($reg->Pintura<$reg->cant_tot OR $reg->Pintura=='') {
							$back2="#F46B67";
						}
						if ($reg->Pintura_exist>0) {
							$etiqueta2='Avance';
							$pintura_req=$reg->cant_tot.' | ';
							$porc2=round((($reg->Pintura/$reg->cant_tot)*100), 1).'%';
						}elseif ($reg->Pintura_exist==0 OR $reg->Pintura_exist=='') {
							$etiqueta2='';
							$pintura_req = '';
							$back2="#FFFFFF";
							$porc2="";
						}



						if ($reg->Plasticos>=$reg->cant_tot) {
							$back3="#67D858";
						}elseif ($reg->Plasticos<$reg->cant_tot OR $reg->Plasticos=='') {
							$back3="#F46B67";
						}
						if ($reg->Plasticos_exist>0) {
							$etiqueta3='Avance';
							$plasticos_req=$reg->cant_tot.' | ';
							$porc3=round((($reg->Plasticos/$reg->cant_tot)*100),1).'%';
						}elseif ($reg->Plasticos_exist==0 OR $reg->Plasticos_exist=='') {
							$plasticos_req = '';
							$back3="#FFFFFF";
							$etiqueta3='';
							$porc3="";
						}



						if ($reg->Ensamble_P>=$reg->cant_tot) {
							$back4="#67D858";
						}elseif ($reg->Ensamble_P<$reg->cant_tot OR $reg->Ensamble_P=='') {
							$back4="#F46B67";
						}
						if ($reg->Ensamble_P_exist>0) {
							$etiqueta4='Avance';
							$ensamble_p_req=$reg->cant_tot.' | ';
							$porc4=round((($reg->Ensamble_P/$reg->cant_tot)*100),1).'%';
						}elseif ($reg->Ensamble_P_exist==0 OR $reg->Ensamble_P_exist=='') {
							$ensamble_p_req = '';
							$back4="#FFFFFF";
							$etiqueta4='';
							$porc4="";
						}




						if ($reg->Ensamble_C>=$reg->cant_tot) {
							$back5="#67D858";
						}elseif ($reg->Ensamble_C<$reg->cant_tot OR $reg->Ensamble_C=='') {
							$back5="#F46B67";
						}
						if ($reg->Ensamble_C_exist>0) {
							$ensamble_c_req=$reg->cant_tot.' | ';
							$etiqueta5='Avance';
							$porc5=round((($reg->Ensamble_C/$reg->cant_tot)*100),1).'%';
						}elseif ($reg->Ensamble_C_exist==0 OR $reg->Ensamble_C_exist=='') {
							$ensamble_c_req = '';
							$back5="#FFFFFF";
							$etiqueta5='';
							$porc5="";
						}



						if ($reg->Ensamble_M>=$reg->cant_tot) {
							$back6="#67D858";
						}elseif ($reg->Ensamble_M<$reg->cant_tot OR $reg->Ensamble_M=='') {
							$back6="#F46B67";
						}
						if ($reg->Ensamble_M_exist>0) {
							$ensamble_m_req=$reg->cant_tot.' | ';
							$etiqueta6='Avance';
							$porc6=round((($reg->Ensamble_M/$reg->cant_tot)*100),1).'%';
						}elseif ($reg->Ensamble_M_exist==0 OR $reg->Ensamble_M_exist=='') {
							$ensamble_m_req = '';
							$back6="#FFFFFF";
							$etiqueta6='';
							$porc6="";
						}



						if ($reg->Horno>=$reg->cant_tot) {
							$back7="#67D858";
						}elseif ($reg->Horno<$reg->cant_tot OR $reg->Horno=='') {
							$back7="#F46B67";
						}
						if ($reg->Horno_exist>0) {
							$horno_req=$reg->cant_tot.' | ';
							$etiqueta7='Avance';
							$porc7=round((($reg->Horno/$reg->cant_tot)*100),1).'%';
						}elseif ($reg->Horno_exist==0 OR $reg->Horno_exist=='') {
							$horno_req = '';
							$back7="#FFFFFF";
							$etiqueta7='';
							$porc7="";
						}

						
						
						echo '

								<tr>
									
	                                <td>

	                                	<b>'.$reg->codigo.'</b><br>
	                                	<small>'.$reg->producto.'</small>

	                                </td>	                                
	                                <td align="center" style="background: '.$back1.';">                           		
	                                		'.$etiqueta1.'
			                             	<h2 style="margin-top: 0; margin-bottom: 0;"><b>'.$porc1.'</b></h2><br>
			                             	'.$herreria_req.$av_real_he.'

	                                </td>
	                                <td align="center" style="background: '.$back2.';">
	                                		'.$etiqueta2.'
			                             	<h2 style="margin-top: 0; margin-bottom: 0;"><b>'.$porc2.'</b></h2><br>
	                                		'.$pintura_req.$av_real_pi.'
	                                </td>
	                                <td align="center" style="background: '.$back3.';">
	                                		'.$etiqueta3.'
			                             	<h2 style="margin-top: 0; margin-bottom: 0;"><b>'.$porc3.'</b></h2><br>
	                                		'.$plasticos_req.$av_real_pl.'

	                                </td>
	                                <td align="center" style="background: '.$back7.';">
	                                		'.$etiqueta7.'
			                             	<h2 style="margin-top: 0; margin-bottom: 0;"><b>'.$porc7.'</b></h2><br>
	                                		'.$horno_req.$av_real_ho.'</td>
	                                <td align="center" style="background: '.$back4.';">
	                                		'.$etiqueta4.'
			                             	<h2 style="margin-top: 0; margin-bottom: 0;"><b>'.$porc4.'</b></h2><br>
	                                		'.$ensamble_p_req.$av_real_ep.'</td>
	                                <td align="center" style="background: '.$back5.';">
	                                		'.$etiqueta5.'
			                             	<h2 style="margin-top: 0; margin-bottom: 0;"><b>'.$porc5.'</b></h2><br>
	                                		'.$ensamble_c_req.$av_real_ec.'</td>
	                                <td align="center" style="background: '.$back6.';">
	                                		'.$etiqueta6.'
			                             	<h2 style="margin-top: 0; margin-bottom: 0;"><b>'.$porc6.'</b></h2><br>
	                                		'.$ensamble_m_req.$av_real_em.'</td>
	                                
	                                <td align="center">'.$reg->no_op.'</td>
	                                <td align="center">'.$reg->no_control.'</td> 
	                                <td align="center">'.$reg->cant_tot.'</td>
	                                <td align="center">'.$reg->fecha_entrega.'</td>
	                                
	                                
	                             </tr>
						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'eliminar_area_op':
		
			$idop_detalle = $_POST['idop_detalle'];

			$rspta=$opr->eliminar_area_op($idop_detalle);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_estatus_empaque':
		
			$idop_detalle_prod = $_POST['idop_detalle_prod'];
			$option_empaque = $_POST['option_empaque'];
			$fecha_hora = $_POST['fecha_hora'];

			$rspta=$opr->guardar_estatus_empaque($idop_detalle_prod,$option_empaque,$fecha_hora);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_extra':
		
			$idop_detalle_prod = $_POST['idop_detalle_prod'];
			$idavance_prod = $_POST['idavance_prod'];
			$cantidad_exc = $_POST['cantidad_exc'];
			$area_num = $_POST['area_num'];
			$fecha_hora = $_POST['fecha_hora'];
			$lote_exc = $_POST['lote_exc'];
			$coment_exc = $_POST['coment_exc'];

			$rspta=$opr->guardar_extra($idop_detalle_prod,$idavance_prod,$cantidad_exc,$area_num,$fecha_hora,$lote_exc,$coment_exc);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'ult_idavance':
		
			$idop_detalle_prod = $_POST['idop_detalle_prod'];
			
			$area_num = $_POST['area_num'];
			

			$rspta=$opr->ult_idavance($idop_detalle_prod,$area_num);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_idop':
		
			$no_op_buscar = $_POST['no_op_buscar'];

			$rspta=$opr->buscar_idop($no_op_buscar);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'mostrar_op':

			$idusuario=$_GET['idusuario'];
			$idop=$_GET['idop'];
			$no_op=$_GET['no_op'];
			$estat=$_GET['estat'];
			//$fecha_buscar=$_GET['fecha_buscar'];
			//$des_barra = 0;

			$rspta = $opr->mostrar_op($idop);

						echo '<b style="font-size: 20px;">OP: '.$no_op.'</b>&nbsp;&nbsp;<b style="font-size: 20px; color: red;">'.$estat.'</b>';
						if ($idusuario==1 OR $idusuario==8 OR $idusuario==24) {
							echo '<a href="#" onclick="abrir_modal_reg_areas('.$idop.');"><h1>+</h1></a>';
						}
						
						echo '<div><hr width="100%"></div>';

			while ($reg = $rspta->fetch_object())
					{
						
						$avance = ($reg->avance_op/$reg->cant_req)*100;
						$avance = round($avance,1);

						if ($avance>=0 AND $avance<=35) {
							$color_avance = "C02705";
						}elseif ($avance>35 AND $avance<=80) {
							$color_avance = "F1C71C";
						}elseif ($avance>80 AND $avance<=100) {
							$color_avance = "05B412";
						}

						if ($reg->estatus_op == 2) {

							$est_op = "Cancelado";
							// code...
						}elseif ($reg->estatus_op <> 2) {
							$est_op = "";
						}


						echo '

								<div style="margin-top: -10px;">
									<h1>'.$est_op.'</h1>
									<strong style="font-size: 15px;">'.$reg->nom_area.'</strong><br>
									Requeridos: <b>'.$reg->cant_req.'</b> --
									Fabricados: <b id="avance_fabricados'.$reg->idop_detalle.'">'.$reg->avance_op.'</b>
									
                                	<div class="progress" style="height:10px; width: 70%; margin-bottom: 10px; position: absolute;">
		                                <div class="progress-bar" role="progressbar" style="width: '.$avance.'%; background: #'.$color_avance.';" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
		                                </div>
		                                
					                </div>
					                <div style="float: right;">
					                	
										

						';

						if (($idusuario>=1 AND $idusuario<=14) OR ($idusuario>=22) ) {
							echo '

									<button type="button" class="btn" id="btn_ver_opdet" data-toggle="tooltip" data-placement="top" title="Mostrar OP" onclick="mostrar_opdet('. $reg->idop_detalle.')"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
										<a href="" id="enlace_op3'.$reg->idop_detalle.'" onclick="abrir_op3('.$reg->idop_detalle.');" target="_blank">
	                                            <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Imprimir"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
	                                    </a>



						'	;
						}

						


						echo '



									<button type="button" class="btn" id="btn_ver_opdet" data-toggle="tooltip" data-placement="top" title="Registrar avance" onclick="registro_avance('. $reg->idop_detalle.',\''.$reg->idop.'\',\''.$reg->area.'\')"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span></button>
					                </div>
					                <div style="float: right; margin-right: 20px; margin-top: 5px;">
					                	<b style="font-size: 20px;">'.$avance.'%</b>
					                </div>
					                
					                <div>
					                	<hr width="100%">
					                </div>
					                
					                
					            </div>

						';

						

						
						
					}

					
			
		break;

		case 'consul_depend':
		
			$idop = $_POST['idop'];
			$area_num = $_POST['area_num'];
			//$cantidad_indep_avance = $_POST['cantidad_indep_avance'];

			$rspta=$opr->consul_depend($idop,$area_num);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'contar_errores_op':
	

			$rspta=$opr->contar_errores_op();
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'reordenar':
			
			$idop_detalle = $_POST['idop_detalle'];
			$select_prioridad = $_POST['select_prioridad'];
			$prioridad = $_POST['prioridad'];
			$idop = $_POST['idop'];

			$rspta=$opr->reordenar($idop_detalle,$select_prioridad,$prioridad,$idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'consul_area_entrega':
			
			$idop = $_POST['idop'];
	
			$rspta=$opr->consul_area_entrega($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'select_op':
			
			$idpg_detped = $_POST['idpg_detped'];
			$val_select = $_POST['val_select'];
	
			$rspta=$opr->select_op($idpg_detped,$val_select);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;



		case 'listar_prod_confirm_op':


			$rspta = $opr->listar_prod_confirm_op();



						echo '	<thead>

	                              <tr align="center" >
	                                <th colspan="3"></th>
	                                <th colspan="2" style="background-color: #6E7174; color: #FFF;">Observaciones</th>
	                              	
	                                <th></th>
	                                <th></th>
	                              </tr>

	                              <tr align="center" style="background-color: #124773; color: #FFF;">
	                                <th width="20%" >DET. PEDIDO</th>
	                                <th width="20%" >PRODUCTO</th>
	                              	<th width="10%" >CANT.</th>
	                              	
	                                <th width="15%" >PROD.</th>
	                                <th width="15%" >PEDIDO</th>
	                                <th width="15%" >DOCS.</th>
	                                <th width="5%" style="padding: 10px;">QUITAR</th>
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

					


						echo '

								<tr style="border-style: none; border-bottom: groove;">
									<td style="padding: 15px;">
										No Control: '.$reg->no_control.'<br>
										Fecha de pedido: <br>'.$reg->fecha_pedido.'<br>
										Fecha de entrega: <br>'.$reg->fecha_entrega.'<br>
										Empaque: '.$reg->empaque.'
									</td>
									<td style="padding: 15px;">
										<b>'.$reg->codigo.'</b><br>
										<small>'.$reg->descripcion.'</small> <br>
										Medida: '.$reg->medida.',<br> Color:  '.$reg->color.' <br>
									</td>
									<td align="center"><b style="font-size: 20px;">'.$reg->cantidad.'</b></td>
	                               
	                                
	                                <td style="padding: 15px;"><small>'.$observacion_prod.'</small></td>
	                                <td align="center"><button type="button" class="btn btn-dark" id="" onclick="ver_observ_gen('.$reg->idpg_pedidos.');" style="visibility: '.$vis.';">Observ. Pedido</button></td>
	                                <td align="center"><button type="button" class="btn btn-dark" id="" onclick="ver_documentos_ped('.$reg->idpg_pedidos.');" style="visibility: '.$vis2.';">Docs.</button></td>

	                <td align="center"><button type="button" class="btn" id="" onclick="quitar_prod_confirm('.$reg->idpg_detped.');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
	                                
	                                
	                                
	                             </tr>


						';
						
					}

						echo '</tbody>
							  

						';
			
		break;


		case 'quitar_prod_confirm':
			
			$idpg_detped = $_POST['idpg_detped'];
			//$val_select = $_POST['val_select'];
	
			$rspta=$opr->quitar_prod_confirm($idpg_detped);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'contar_ops':
			
			//$idpg_detped = $_POST['idpg_detped'];
			//$val_select = $_POST['val_select'];
	
			$rspta=$opr->contar_ops();
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'registrar_op':
			
			$nueva_op = $_POST['nueva_op'];
			$fecha_hora = $_POST['fecha_hora'];
	
			$rspta=$opr->registrar_op($nueva_op,$fecha_hora);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;



		case 'crear_op_confirm':

			$idop=$_GET['idop'];


			$rspta = $opr->crear_op_confirm();

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '<b>'.$reg->idpg_detped.'</b><br>';

						$idpg_detped = $reg->idpg_detped;



							$servername = 'localhost';
							$username = 'u690371019_pgmanage';
							//$username = 'root';
							$password = "A=tSXZ4z";
							//$password = "";
							$dbname = "u690371019_pgmanage";
							
							$conn = new mysqli($servername, $username, $password, $dbname);


									$sql9 = "SELECT pd.cantidad,pd.iddetalle_pedido,
									(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as no_control,
									(SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as codigo,
									(SELECT descripcion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as descripcion,
									(SELECT IFNULL(empaque,'') FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as empaque,
									(SELECT fecha_pedido FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as fecha_pedido,
									(SELECT IFNULL(fecha_entrega,'0000-00-00 00:00:00') FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as fecha_entrega,
									(SELECT IFNULL(observacion,'') FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as observacion,
									(SELECT IFNULL(medida,'') FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as medida,
									(SELECT IFNULL(color,'') FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as color
									FROM pg_detped pd WHERE pd.idpg_detped='$idpg_detped'";
									$result9 = mysqli_query($conn, $sql9);
									$row = mysqli_fetch_assoc($result9);
									//$idpg_detped = $row['idpg_detped'];
									$no_control = $row['no_control'];
									$codigo = $row['codigo'];
									
									$descripcion = $row['descripcion'];
									$empaque = $row['empaque'];
									$cantidad = $row['cantidad'];
									$fecha_pedido = $row['fecha_pedido'];
									$fecha_entrega = $row['fecha_entrega'];
									$observacion = $row['observacion'];
									$medida = $row['medida'];
									$color = $row['color'];
									$iddetalle_pedido = $row['iddetalle_pedido'];

									/*echo '<b>_________</b><br>';
									echo '<b>'.$idop.'</b> idop<br>';
									echo '<b>'.$idpg_detped.'</b> idpg_detped<br>';
									echo '<b>'.$no_control.'</b> control<br>';
									echo '<b>'.$codigo.'</b> codigo<br>';
									echo '<b>'.$descripcion.'</b> descrip<br>';
									echo '<b>'.$empaque.'</b> empaque<br>';
									echo '<b>'.$cantidad.'</b> cant<br>';
									echo '<b>'.$fecha_pedido.'</b> fecha_ped<br>';
									echo '<b>'.$fecha_entrega.'</b> fecha_ent<br>';
									echo '<b>'.$observacion.'</b> observ<br>';
									echo '<b>'.$medida.'</b> medida<br>';
									echo '<b>'.$color.'</b> color<br>';
									echo '<b>'.$iddetalle_pedido.'</b> iddetalle_pedido<br>';
									echo '<b>_________</b><br>';*/


									$sql="INSERT INTO op_detalle_prod 
									(idop,idpg_detped,no_control,codigo,producto,empaque,cant_tot,fecha_inicio,fecha_term,observ,medida,color,iddetalle_pedido) VALUES ('$idop','$idpg_detped','$no_control','$codigo','$descripcion','$empaque','$cantidad','$fecha_pedido','$fecha_entrega','$observacion','$medida','$color','$iddetalle_pedido')";
									$result = $conn->query($sql);

									$sql2="UPDATE pg_detped SET op=(SELECT no_op FROM op WHERE idop='$idop'), select_op=0 WHERE idpg_detped='$idpg_detped'";
									$result2 = $conn->query($sql2);


							$conn->close();
						




						
					}

						
			
		break;

		case 'consul_select_op':
			
			$idpg_detped = $_POST['idpg_detped'];
	
			$rspta=$opr->consul_select_op($idpg_detped);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_seleccion':
			
			//$idpg_detped = $_POST['idpg_detped'];
	
			$rspta=$opr->consul_seleccion();
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'validar_creacion_op':
			
			$idop = $_POST['idop'];
	
			$rspta=$opr->validar_creacion_op($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'validar_creacion_op2':
			
			$idop = $_POST['idop'];
	
			$rspta=$opr->validar_creacion_op2($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'borrar_op':
			
			$idop = $_POST['idop'];
	
			$rspta=$opr->borrar_op($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'activar_op':
			
			$idop = $_POST['idop'];
	
			$rspta=$opr->activar_op($idop);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'rastaurar_op':

			$idop=$_GET['idop'];


			$rspta = $opr->rastaurar_op($idop);

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						echo '<b>'.$reg->idpg_detped.'</b><br>';

						$idpg_detped = $reg->idpg_detped;

							$servername = 'localhost';
							$username = 'u690371019_pgmanage';
							//$username = 'root';
							$password = "A=tSXZ4z";
							//$password = "";
							$dbname = "u690371019_pgmanage";
							$conn = new mysqli($servername, $username, $password, $dbname);


									$sql9 = "SELECT pd.cantidad,pd.iddetalle_pedido,
									(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as no_control,
									(SELECT codigo FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as codigo,
									(SELECT descripcion FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as descripcion,
									(SELECT IFNULL(empaque,'') FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as empaque,
									(SELECT fecha_pedido FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as fecha_pedido,
									(SELECT IFNULL(fecha_entrega,'0000-00-00 00:00:00') FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as fecha_entrega,
									(SELECT IFNULL(observacion,'') FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as observacion,
									(SELECT IFNULL(medida,'') FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as medida,
									(SELECT IFNULL(color,'') FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=pd.iddetalle_pedido) as color
									FROM pg_detped pd WHERE pd.idpg_detped='$idpg_detped'";
									$result9 = mysqli_query($conn, $sql9);
									$row = mysqli_fetch_assoc($result9);
								
									$no_control = $row['no_control'];
									$codigo = $row['codigo'];									
									$descripcion = $row['descripcion'];
									$empaque = $row['empaque'];
									$cantidad = $row['cantidad'];
									$fecha_pedido = $row['fecha_pedido'];
									$fecha_entrega = $row['fecha_entrega'];
									$observacion = $row['observacion'];
									$medida = $row['medida'];
									$color = $row['color'];
									$iddetalle_pedido = $row['iddetalle_pedido'];

									$sql="INSERT INTO op_detalle_prod 
									(idop,idpg_detped,no_control,codigo,producto,empaque,cant_tot,fecha_inicio,fecha_term,observ,medida,color,iddetalle_pedido) VALUES ('$idop','$idpg_detped','$no_control','$codigo','$descripcion','$empaque','$cantidad','$fecha_pedido','$fecha_entrega','$observacion','$medida','$color','$iddetalle_pedido')";
									$result = $conn->query($sql);

									


						$conn->close();
						




						
					}

						
			
		break;

		case 'cancelar_prod':
			
			$idop_prod = $_POST['idop_prod'];
	
			$rspta=$opr->cancelar_prod($idop_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'borrar_avance':
			
			$idavance_prod = $_POST['idavance_prod'];
	
			$rspta=$opr->borrar_avance($idavance_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'borrar_excedente':
			
			$idop_detalle_exc = $_POST['idop_detalle_exc'];
	
			$rspta=$opr->borrar_excedente($idop_detalle_exc);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'upd_cant_avance_prod':
			
			$idavance_prod = $_POST['idavance_prod'];
			$cantidad = $_POST['cantidad'];
	
			$rspta=$opr->upd_cant_avance_prod($idavance_prod,$cantidad);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'listar_productos_produccion':

			$select_area_prod=$_GET['select_area_prod'];
			$estatus=$_GET['estatus'];
			$offset=$_GET['offset'];
			$estatus_pedido=$_GET['estatus_pedido'];

			$rspta = $opr->listar_productos_produccion($select_area_prod,$estatus,$offset,$estatus_pedido);



						echo '	<thead>

	                    <tr>
	                    	<th>#</th>
	                      <th>PRODUCTO</th>
	                      <th>ÁREA</th>                              	
	                      <th>OP</th>
	                      <th>No. CONTROL</th>
	                      <th>CANT. REQ.</th>
	                      <th>CANT. FAB.</th>
	                      <th>% AVANCE</th>
	                      <th>FECHA DE ENTREGA</th>
						  <th>ESTATUS DE PEDIDO</th>
	                    </tr> 

	                  </thead>
	                  <tbody>';

	                  $consec=1;
			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->area==1) {
							$area = "Herrería";
						}elseif ($reg->area==2) {
							$area = "Pintura";
						}elseif ($reg->area==3) {
							$area = "Plasticos";
						}elseif ($reg->area==5) {
							$area = "Ensamble Porcelanizado";
						}elseif ($reg->area==6) {
							$area = "Ensamble Comercial";
						}elseif ($reg->area==7) {
							$area = "Ensamble Mueble";
						}elseif ($reg->area==8) {
							$area = "Horno";
						}else{
							$area = "";
						}

						if ($reg->sum_capt=="" OR $reg->sum_capt==null) {
							$sum_capt=0;
						}elseif ($reg->sum_capt>0) {
							$sum_capt=$reg->sum_capt;
						}else{
							$sum_capt="Error";
						}

						if ($reg->av_capt=="" OR $reg->av_capt==null) {
							$av_capt=0;
						}elseif ($reg->av_capt>0) {
							$av_capt=$reg->av_capt;
						}else{
							$av_capt="Error";
						}

						$av_real = max($av_capt,$av_capt);
						$porc=round((($av_real/$reg->cant_tot)*100),1);


						if ($porc>=100) {
							$back_color = '#7AF863';
						}elseif ($porc<100) {
							$back_color = '#FC847A';
						}else{
							$back_color = '#FCF47A';
						}

						echo '

								<tr>
									<td style="background-color: '.$back_color.';">'.$consec.'</td>
									<td>
									'.$reg->codigo.'<br>
									'.$reg->descripcion.'<br>
									Medidas: '.$reg->medida.', Color: '.$reg->color.'<br>
									Observaciones: '.$reg->observ.'
									</td>
									<td>'.$area.'</td>
									<td>'.$reg->op.'</td>
									<td>'.$reg->no_control.'</td>
									<td>'.$reg->cant_tot.'</td>
									<td>'.$av_real.'</td>
									<td>'.$porc.' %</td>
									<td>'.$reg->fecha_entrega.'</td>
									<td>'.$reg->estatus.'</td>                                
	             </tr>


						';

						 $consec =  $consec+1;
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'addProdOp':

			$rspta = $opr->addProdOp();

			while ($reg = $rspta->fetch_object())



					{

						echo '
							<p class="add_prod_op" onclick="addProd_op('.$reg->idpg_detped.');">No. Control: '.$reg->no_control.', Codigo: '.$reg->codigo.', Nombre: '.$reg->descripcion.', Cantidad: '.$reg->cantidad.'</p>
							<p style="display: none;">
								<b id="no_control_p'.$reg->idpg_detped.'">'.$reg->no_control.'</b>
								<b id="codigo_p'.$reg->idpg_detped.'">'.$reg->codigo.'</b>
								<b id="descripcion_p'.$reg->idpg_detped.'">'.$reg->descripcion.'</b>
								<b id="empaque_p'.$reg->idpg_detped.'">'.$reg->empaque.'</b>
								<b id="cantidad_p'.$reg->idpg_detped.'">'.$reg->cantidad.'</b>
								<b id="fecha_pedido_p'.$reg->idpg_detped.'">'.$reg->fecha_pedido.'</b>
								<b id="fecha_entrega_p'.$reg->idpg_detped.'">'.$reg->fecha_entrega.'</b>
								<b id="observaciones_p'.$reg->idpg_detped.'">'.$reg->observaciones.'</b>
								<b id="estatus_p'.$reg->idpg_detped.'">'.$reg->estatus.'</b>
								<b id="medida_p'.$reg->idpg_detped.'">'.$reg->medida.'</b>
								<b id="color_p'.$reg->idpg_detped.'">'.$reg->color.'</b>
								<b id="iddetalle_pedido_p'.$reg->idpg_detped.'">'.$reg->iddetalle_pedido.'</b>
							</p>
						';	
					}

			
		break;

		// <p style="padding: 5px; background-color: #ccc;">idpg_detped: '.$reg->idpg_detped.'</p>
		// 					<p style="padding: 5px; background-color: #ccc;">no_control: '.$reg->no_control.'</p>
		// 					<p style="padding: 5px; background-color: #ccc;">codigo: '.$reg->codigo.'</p>
		// 					<p style="padding: 5px; background-color: #ccc;">descripcion: '.$reg->descripcion.'</p>
		// 					<p style="padding: 5px; background-color: #ccc;">empaque: '.$reg->empaque.'</p>
		// 					<p style="padding: 5px; background-color: #ccc;">cantidad: '.$reg->cantidad.'</p>
		// 					<p style="padding: 5px; background-color: #ccc;">fecha_pedido: '.$reg->fecha_pedido.'</p>
		// 					<p style="padding: 5px; background-color: #ccc;">fecha_entrega: '.$reg->fecha_entrega.'</p>
		// 					<p style="padding: 5px; background-color: #ccc;">observaciones: '.$reg->observaciones.'</p>
		// 					<p style="padding: 5px; background-color: #ccc;">estatus: '.$reg->estatus.'</p>
		// 					<p style="padding: 5px; background-color: #ccc;">medida: '.$reg->medida.'</p>
		// 					<p style="padding: 5px; background-color: #ccc;">color: '.$reg->color.'</p>
		// 					<p style="padding: 5px; background-color: #ccc;">iddetalle_pedido: '.$reg->iddetalle_pedido.'</p>

		case 'addProd_op':
		
			$idop = $_POST['idop'];
			$idpg_detped = $_POST['idpg_detped'];
			$no_control = $_POST['no_control'];
			$codigo = $_POST['codigo'];
			$descripcion = $_POST['descripcion'];
			$empaque = $_POST['empaque'];
			$cantidad = $_POST['cantidad'];
			$fecha_pedido = $_POST['fecha_pedido'];
			$fecha_entrega = $_POST['fecha_entrega'];
			$observaciones = $_POST['observaciones'];
			$estatus = $_POST['estatus'];
			$medida = $_POST['medida'];
			$color = $_POST['color'];
			$iddetalle_pedido = $_POST['iddetalle_pedido'];


			$rspta=$opr->addProd_op($idop,$idpg_detped,$no_control,$codigo,$descripcion,$empaque,$cantidad,$fecha_pedido,$fecha_entrega,$observaciones,$estatus,$medida,$color,$iddetalle_pedido);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;
		

	}

?>


