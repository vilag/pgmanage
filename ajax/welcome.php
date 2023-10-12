<?php
session_start(); 
require_once "../modelos/Welcome.php";

$welcome=new Welcome();


switch ($_GET["op"]){
	

		case 'listar_pedidos':

				$id=$_GET['id'];

				$rspta = $welcome->listar_pedidos($id);			
				while ($reg = $rspta->fetch_object())
						{


							/*$avance=$reg->avance;
							$cantidad=$reg->cantidad;
						    $sum_prod=$reg->sum_prod;

							$porc=($avance/$sum_prod)*100;*/

							$porc=0;

							echo '
								  

		                          					<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->idpg_pedidos.'" aria-expanded="true" aria-controls="collapseOne" onclick="listar_prod_detalles('.$reg->idpg_pedidos.');">
                                                          

                                                          <table id="datatable_buttons" class="table table-hover">
							                                  <tr>
							                                    <td width="20%">Control: '.$reg->no_control.'</td>
							                                    
							                                    <td width="20%">ID: '.$reg->idpg_pedidos.'</td>
							                                    
								                                <td width="60%">

								                                	<div class="progress">
			                                                          <div class="progress-bar progress-bar-striped" role="progressbar" style="width: '.$porc.'%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
			                                                        </div>

								                                </td>
							                                    
							                                  </tr>
							                               </table>

                                                        </a>
                                                        <div id="collapseOne'.$reg->idpg_pedidos.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                          <div class="panel-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 1000px;">

                                                          	<table class="table table-bordered" id="tbl_prod_detalle'.$reg->idpg_pedidos.'">
                                                              
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>



									';
							
						}

						
				
		break;

		case 'buscar_control':

				$id=$_GET['id'];
				$control=$_GET['control'];

				$rspta = $welcome->buscar_control($id,$control);			
				while ($reg = $rspta->fetch_object())
						{


							/*$avance=$reg->avance;
							$cantidad=$reg->cantidad;
						    $sum_prod=$reg->sum_prod;

							$porc=($avance/$sum_prod)*100;*/

							$porc=0;

							echo '
								  

		                          					<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->idpg_pedidos.'" aria-expanded="true" aria-controls="collapseOne" onclick="listar_prod_detalles('.$reg->idpg_pedidos.');">
                                                          

                                                          <table id="datatable_buttons" class="table table-hover">
							                                  <tr>
							                                    <td width="20%">Control: '.$reg->no_control.'</td>
							                                    
							                                    <td width="20%">ID: '.$reg->idpg_pedidos.'</td>
							                                    
								                                <td width="60%">

								                                	<div class="progress">
			                                                          <div class="progress-bar progress-bar-striped" role="progressbar" style="width: '.$porc.'%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
			                                                        </div>

								                                </td>
							                                    
							                                  </tr>
							                               </table>

                                                        </a>
                                                        <div id="collapseOne'.$reg->idpg_pedidos.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                          <div class="panel-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 1000px;">

                                                          	<table class="table table-bordered" id="tbl_prod_detalle'.$reg->idpg_pedidos.'">
                                                              
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>



									';
							
						}

						
				
		break;

		case 'listar_prod_detalles':

			$id=$_GET['id'];

			$rspta = $welcome->listar_prod_detalles($id);



						echo '	<thead>
	                              <tr>
	                              	<th>Código</th>
	                              	<th>Descripción</th>
	                              	<th>Medida</th>
	                              	<th>Color</th>
	                              	<th>Cantidad</th>
	                              	<th>HE</th>
	                              	<th>PI</th>
	                              	<th>PL</th>
	                              	<th>EM</th>
	                              	<th>HO</th>
	                              	<th>EP</th>
	                              	<th>EC</th>
	                              	<th>Estatus</th>
	                              	<th>OP</th>
	                              	
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->estatus=="Fabricado" OR $reg->estatus=="Produccion") {
							$avance_he = $reg->avance_he;
							$avance_pi = $reg->avance_pi;
							$avance_pl = $reg->avance_pl;
							$avance_em = $reg->avance_em;
							$avance_ho = $reg->avance_ho;
							$avance_ep = $reg->avance_ep;
							$avance_ec = $reg->avance_ec;
						}elseif ($reg->estatus<>"Fabricado" AND $reg->estatus<>"Produccion") {
							$avance_he = "";
							$avance_pi = "";
							$avance_pl = "";
							$avance_em = "";
							$avance_ho = "";
							$avance_ep = "";
							$avance_ec = "";
						}

						echo '

								<tr>
									
													
									<td>'.$reg->codigo.'</td>
									<td>'.$reg->descripcion.'</td>
									<td>'.$reg->medida.'</td>
									<td>'.$reg->color.'</td>
									<td>'.$reg->cantidad.'</td>

									<td>'.$avance_he.'</td>
									<td>'.$avance_pi.'</td>
									<td>'.$avance_pl.'</td>
									<td>'.$avance_em.'</td>
									<td>'.$avance_ho.'</td>
									<td>'.$avance_ep.'</td>
									<td>'.$avance_ec.'</td>

									<td>'.$reg->estatus.'</td>
									<td>'.$reg->op.'</td>
									
									
	                                
	                             </tr>


						';


						
					}

						echo '</tbody>
							  

						';
			
		break;

		

		case 'calc_ind_prod':

			$ultimo_anio = $_POST['ultimo_anio'];
			$ultimo_mes = $_POST['ultimo_mes'];

			$rspta=$welcome->calc_ind_prod($ultimo_anio,$ultimo_mes);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'llenar_anios':
			
			//$id=$_GET['id'];

			$rspta = $welcome->llenar_anios();

			while ($reg = $rspta->fetch_object())
					{

						

						echo '

							<option value="'.$reg->anios.'">'.$reg->anios.'</option>


						';
						
					}
			
		break;

		case 'consul_anio_actual':

			$rspta=$welcome->consul_anio_actual();
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'llenar_mes':
			$anio=$_GET['anio'];
			$rspta = $welcome->llenar_mes($anio);
			while ($reg = $rspta->fetch_object())

				

					{

						if ($reg->meses==1) {
							$mes = "Enero";
						}elseif ($reg->meses==2) {
							$mes = "Febrero";
						}elseif ($reg->meses==3) {
							$mes = "Marzo";
						}elseif ($reg->meses==4) {
							$mes = "Abril";
						}elseif ($reg->meses==5) {
							$mes = "Mayo";
						}elseif ($reg->meses==6) {
							$mes = "Junio";
						}elseif ($reg->meses==7) {
							$mes = "Julio";
						}elseif ($reg->meses==8) {
							$mes = "Agosto";
						}elseif ($reg->meses==9) {
							$mes = "Septiembre";
						}elseif ($reg->meses==10) {
							$mes = "Octubre";
						}elseif ($reg->meses==11) {
							$mes = "Noviembre";
						}elseif ($reg->meses==12) {
							$mes = "Diciembre";
						}

						echo '
							<option value="'.$reg->meses.'">'.$mes.'</option>
						';						
					}
		break;

		case 'consul_mes_actual':

			$ultimo_anio = $_POST['ultimo_anio'];

			$rspta=$welcome->consul_mes_actual($ultimo_anio);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		

		case 'listar_pedidos_ind_prod2':
			
			$anio=$_GET['anio'];
			$mes=$_GET['mes'];
			$estat_anios=$_GET['estat_anios'];

			$rspta = $welcome->listar_pedidos_ind_prod($anio,$mes,$estat_anios);



						

                              $consec=1;

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						echo '

													<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->idpg_pedidos.'" aria-expanded="true" aria-controls="collapseOne" onclick="listar_ops_detalles2('.$reg->idpg_pedidos.');">

                                                        	<table id="datatable_buttons" class="table table-hover">
							                                  
							                                  <tr>
							                                      <td width="10%"># '.$consec.'</td>
								                                  
								                                  
								                                  <td width="40%">

								                                  Control / Estatus:<br><b>'.$reg->no_control.' / '.$reg->estatus.'</b><br>
								                                  Cliente:<br><b>'.$reg->nombre.'</b><br>
								                                  
								                                  </td>
								                            	
								                                 
								                                  <td width="40%">
								                                  Fecha de pedido:<br> <b>'.$reg->fecha_pedido.'</b><br>
								                                  Fecha de entrega programada:<br> <b>'.$reg->fecha_entrega.'</b><br>
								                                  Fecha de entrega real:<br> <b>'.$reg->fecha_valid_term.'</b>
								                                  </td>
								                               
							                                      <td width="10%"><button  type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Ver detalles">Detalles</button></td>
							                                   
							                                  </tr>
							                                  
							                                </table>

                                                          
                                                        </a>
                                                        <div id="collapseOne'.$reg->idpg_pedidos.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                          <div class="panel-body">
                                                          	


                                                          	<table class="table table-bordered" id="tbl_prod_detalle'.$reg->idpg_pedidos.'">
                                                              
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>


						';

						$consec = $consec+1;
						
					}

						
			
		break;

		case 'listar_pedidos_ind_prod':
			
			$anio=$_GET['anio'];
			$mes=$_GET['mes'];
			$estat_anios=$_GET['estat_anios'];

			$rspta = $welcome->listar_pedidos_ind_prod($anio,$mes,$estat_anios);



						echo '<thead>
								<tr align="center">
									<th colspan="4"></th>
									<th colspan="2">PRODUCCION</th>
								</tr>
                                <tr>
                                  <th width="5%">#</th>
                                  <th width="5%">Ver</th>
                                  <th width="45%"><small><b>CONTROL</b></small></th>
                                 
                                  <th width="15%"><small><b>FECHA DE<br> PEDIDO</b></small></th>
                                  <th width="15%"><small><b>ENTREGA<br> ESTIMADA</b></small></th>
                                  <th width="15%"><small><b>ENTREGA<br> REAL</b></small></th>

                                 
                                </tr>
                              </thead>
                              <tbody>';

                              $consec=1;

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						//$fecha_valid_term = '';

						if ($reg->fecha_valid_term_2<=$reg->fecha_entrega) {
							
								$color_font='red';
								$etiqueta='Registro de avances incompleto';
								//$fecha_valid_term = $reg->fecha_valid_term;

							
								
						}elseif ($reg->fecha_valid_term_2>$reg->fecha_entrega) {

							$color_font='black';
							$etiqueta='';
							//$fecha_valid_term = $reg->fecha_valid_term;
						}

						echo '

								<tr>
                                  <td>'.$consec.'</td>
                                  <td><button  type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Ver detalles" onclick="ver_detalle_pedido('.$reg->idpg_pedidos.',\''.$reg->no_control.'\');"><i class="fa fa-list"></i></button></td>
                                  
                                  <td>
                                  <b>CONTROL: '.$reg->no_control.' - '.$reg->estatus.'</b><br>
                                  CLIENTE: <small>'.$reg->nombre.'</small><br>
                                  
                                  </td>
                            
                                 
                                  <td>'.$reg->fecha_pedido.'</td>
                                  <td>'.$reg->fecha_entrega.'</td>
                                  <td>
                                  	<b style="color: '.$color_font.';" title="'.$etiqueta.'">'.$reg->fecha_valid_term.'</b>
                                  </td>
                                  
                                </tr>


						';

						$consec = $consec+1;
						
					}

						echo '</tbody>';
			
		break;

		case 'calc_ind_prod_grafica':

			$ultimo_anio = $_POST['ultimo_anio'];
			//$ultimo_mes = $_POST['ultimo_mes'];

			$rspta=$welcome->calc_ind_prod_grafica($ultimo_anio);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'calc_ind_emb_grafica':

			$ultimo_anio = $_POST['ultimo_anio'];
			//$ultimo_mes = $_POST['ultimo_mes'];

			$rspta=$welcome->calc_ind_emb_grafica($ultimo_anio);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'calc_ind_emb':

			$ultimo_anio = $_POST['ultimo_anio'];
			$ultimo_mes = $_POST['ultimo_mes'];

			$rspta=$welcome->calc_ind_emb($ultimo_anio,$ultimo_mes);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'crear_box_grafica':
			
			$anio=$_GET['anio'];
			$consec_anio=$_GET['consec_anio'];

			$rspta = $welcome->crear_box_grafica($anio);

			while ($reg = $rspta->fetch_object())
					{
						echo '
							<div id="grafica_pedido'.$reg->anio.''.$consec_anio.'">
								
                            </div>	
						';						
					}		
		break;

		case 'crear_box_grafica_pe':
			
			$anio=$_GET['anio'];
			$consec_anio=$_GET['consec_anio'];

			$rspta = $welcome->crear_box_grafica($anio);

			while ($reg = $rspta->fetch_object())
					{
						echo '
							
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" id="chart_prod'.$reg->anio.''.$consec_anio.'">
	                        </div>
	                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" id="chart_emb'.$reg->anio.''.$consec_anio.'">
	                        </div>
	                        
						';						
					}		
		break;

		

		case 'listar_pedidos_ind_emb':
			
			$anio=$_GET['anio'];
			$mes=$_GET['mes'];
			$estat_anios=$_GET['estat_anios'];

			$rspta = $welcome->listar_pedidos_ind_emb($anio,$mes,$estat_anios);



						echo '<thead>
								
                                <tr>
                                  <th width="5%">#</th>
                                  <th width="4%">Detalles</th>
                                  <th width="9%"><small><b>CONTROL</b></small></th>
                                  <th width="14%"><small><b>CLIENTE</b></small></th>
                                  <th width="9%"><small><b>ESTATUS</b></small></th>
                                  <th width="14%"><small><b>COMENTARIO</b></small></th>
                                  <th width="7%"><small><b>FECHA DE<br> PEDIDO</b></small></th>
                                  <th width="7%"><small><b>FECHA DE<br> TERMINO</b></small></th>
                                  <th width="7%"><small><b>DIA DE<br> TERMINO</b></small></th>
                                  <th width="7%"><small><b>FECHA DE<br> ENTREGA</b></small></th>
                                  <th width="7%"><small><b>DIA DE<br> ENTREGA</b></small></th>
                                  <th width="10%" colspan="2"><small><b>COMENT.<br> VENCIM.</b></small></th>
                                 
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
                                  <td><button  type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Ver detalles" onclick="detalle_pedido_venci('.$reg->idpg_pedidos.',\''.$reg->no_control.'\');"><i title="Ver detalles" class="fa fa-info"></i></button></td>
                                  
                                  <td>'.$reg->no_control.'</td>
                            
                                  <td><small><b>'.$reg->nombre.'</b></small></td>
                                  <td><small><b>'.$reg->estatus.'</b></small></td>
                                  <td><small><b>'.$reg->comentario.'</b></small></td>
                                  <td>'.$reg->fecha_pedido.'</td>
                                  <td>'.$reg->fecha_valid_term.'</td>
                                  <td>'.$reg->dia_term.'</td>
                                  <td>'.$reg->fecha_de_entrega.'</td>
                                  <td>'.$reg->dia_entrega.'</td>
                                  <td>'.$reg->coment_vencim.'</td>
                                  <td>'.$reg->coment_entrega_ind.'</td>
                                </tr>


						';

						$consec = $consec+1;
						
					}

						echo '</tbody>';
			
		break;

		case 'consul_info_pedidos':
		
			$anio = $_POST['anio'];

			$rspta=$welcome->consul_info_pedidos($anio);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_info_grafica1':
		
			$anio = $_POST['anio'];

			$rspta=$welcome->consul_info_grafica1($anio);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_info_grafica2':
		
			$anio = $_POST['anio'];

			$rspta=$welcome->consul_info_grafica2($anio);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_info_grafica3':
		
			$anio = $_POST['anio'];

			$rspta=$welcome->consul_info_grafica3($anio);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_cant_prod_com':

			$rspta = $welcome->listar_cant_prod_com();



						echo '<thead>
								
                                <tr>
                                  <th width="10%">#</th>
                                  
                                  <th width="10%"><small><b>CODIGO</b></small></th>
                                  <th width="60%"><small><b>DESCRIPCION</b></small></th>
                                  <th width="10%"><small><b>TOTAL</b></small></th>
                                  <th width="10%"><small><b>CANTIDAD<br>PEDIDOS</b></small></th>
                                </tr>
                              </thead>
                              <tbody>';

                              $consec=1;

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						

						echo '
								<a href="#">

									<tr>
	                                  <td>'.$consec.'</td>
	                                  <
	                                  
	                                  <td><small><b>'.$reg->codigo_match.'</b></small></td>
	                            
	                                  <td>
	                                  <small><b>'.$reg->descripcion.'</b></small>
	                                  </td>
	                                  
	                                  <td>'.$reg->cantidad.'</td>
	                                  <td>'.$reg->num_pedidos.'</td>
	                                  
	                                </tr>


								</a>
									


						';

						$consec = $consec+1;
						
					}

						echo '</tbody>';
			
		break;

		case 'listar_cant_prod_lic':

			$rspta = $welcome->listar_cant_prod_lic();



						echo '<thead>
								
                                <tr>
                                  <th width="10%">#</th>
                                  
                                  <th width="10%"><small><b>CODIGO</b></small></th>
                                  <th width="60%"><small><b>DESCRIPCION</b></small></th>
                                  <th width="10%"><small><b>TOTAL</b></small></th>
                                  <th width="10%"><small><b>CANTIDAD<br>PEDIDOS</b></small></th>
                                </tr>
                              </thead>
                              <tbody>';

                              $consec=1;

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						

						echo '
								<a href="#">

									<tr>
	                                  <td>'.$consec.'</td>
	                                  <
	                                  
	                                  <td><small><b>'.$reg->codigo_match.'</b></small></td>
	                            
	                                  <td>
	                                  <small><b>'.$reg->descripcion.'</b></small>
	                                  </td>
	                                  
	                                  <td>'.$reg->cantidad.'</td>
	                                  <td>'.$reg->num_pedidos.'</td>
	                                  
	                                </tr>


								</a>
									


						';

						$consec = $consec+1;
						
					}

						echo '</tbody>';
			
		break;

		case 'guardar_coment_vencim':
		
			$idpedido = $_POST['idpedido'];
			$det_vencim = $_POST['det_vencim'];

			$rspta=$welcome->guardar_coment_vencim($idpedido,$det_vencim);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_pedido_detalle_term':

			$id=$_GET['id'];

			$rspta = $welcome->listar_pedido_detalle_term($id);



						echo '	<thead>
								  <tr>
									<th colspan="2"  align="left"><b id="no_control_tbl">_</b></th>
									<th colspan="3"  align="right"><a href="#" onclick="ver_lista_pedidos_ind();">Regresar</a></th>
								  </tr>
	                              <tr>

	                              	
	                              	<th style="width: 45%;"><small style="font-weight: bold;">DESCRIPCIÓN</small></th>
	                              	
	                              	<th style="width: 15%;"><small style="font-weight: bold;">TOTAL</small></th>
	                              	
	                              	<th style="width: 10%;"><small style="font-weight: bold;">OP</small></th>
	                              	<th style="width: 20%;"><small style="font-weight: bold;">ESTATUS</small></th>
	                             
	                              	
	                              </tr>
	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						

						


						if ($reg->check_entrega==1) {
							$checked="checked";
							
						}elseif ($reg->check_entrega==0) {
							$checked="";
							
						}

						if ($reg->cantidad==$reg->cantidad_entre) {
							$disabled = "disabled";
						}elseif ($reg->cantidad>$reg->cantidad_entre) {
							$disabled = "disabled";
						}


						if ($reg->cant_fabricado>0) {
							$cant_fabricado = 'Fabricado: ('.$reg->cant_fabricado.')<br>';
						}elseif ($reg->cant_fabricado==0) {
							$cant_fabricado = '';
						}

						if ($reg->cant_apartado>0) {
							$cant_apartado = 'Apartado: ('.$reg->cant_apartado.')<br>';
						}elseif ($reg->cant_apartado==0) {
							$cant_apartado = '';
						}

						if ($reg->cant_existencia>0) {
							$cant_existencia = 'Existencia: ('.$reg->cant_existencia.')<br>';
						}elseif ($reg->cant_existencia==0) {
							$cant_existencia = '';
						}

						if ($reg->cant_produccion>0) {
							$cant_produccion = 'Producción: ('.$reg->cant_produccion.')<br>';
						}elseif ($reg->cant_produccion==0) {
							$cant_produccion = '';
						}

						if ($reg->cant_otro>0) {
							$cant_otro = 'Otro: ('.$reg->cant_otro.')<br>';
						}elseif ($reg->cant_otro==0) {
							$cant_otro = '';
						}

						echo '

								<tr>
									
													
									
									<td>
									CODIGO: <b>'.$reg->codigo.'</b><br>
									<small>'.$reg->descripcion.'</small>
									<p>MEDIDAS: <b>'.$reg->medida.'</b>, COLOR: <b>'.$reg->color.'</b></p>
									Observación: '.$reg->observacion.'
									</td>
									
									<td>'.$reg->cantidad.'</td>
									
									<td>


									

						';

								$idpg_detalle_pedidos = $reg->idpg_detalle_pedidos;

								$rspta2 = $welcome->listar_op($idpg_detalle_pedidos);
								while ($reg2 = $rspta2->fetch_object()){


									echo '
										<b>'.$reg2->op.', </b>
									';
								}
					

						echo '



									</td>
									

									<td>
									'.$cant_fabricado.'
									'.$cant_apartado.'
									'.$cant_existencia.'
									'.$cant_produccion.'
									'.$cant_otro.' 
									</td>
							        	   
	                             </tr>

						';

						/*<td style="background: '.$back1.';"><small>'.$avance_he.'</small></td>
									<td style="background: '.$back2.';"><small>'.$avance_pi.'</small></td>
									<td style="background: '.$back3.';"><small>'.$avance_pl.'</small></td>
									<td style="background: '.$back6.';"><small>'.$avance_em.'</small></td>
									<td style="background: '.$back7.';"><small>'.$avance_ho.'</small></td>
									<td style="background: '.$back4.';"><small>'.$avance_ep.'</small></td>
									<td style="background: '.$back5.';"><small>'.$avance_ec.'</small></td>*/
						
					}

						echo '</tbody>
							  

						';
			
		break;


}
?>