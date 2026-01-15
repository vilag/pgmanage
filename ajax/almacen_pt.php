<?php

	require_once "../modelos/Almacen_pt.php";

	$almacen_pt = new Almacen_pt();

	switch ($_GET["op"]) {
		
		// case 'codigos_alm_pt_new':
        //     $codigo = $_POST['codigo'];
		// 	$rspta = $almacen_pt->codigos_alm_pt_new($codigo);
		// 	$pila = array();	
		// 	while ($reg = $rspta->fetch_object())
		// 	{
		// 		array_push($pila, $reg);
		// 	}
		// 	echo json_encode($pila);
		// break;

		case 'codigos_alm_pt_count':
            $codigo = $_POST['codigo'];
			$rspta=$almacen_pt->codigos_alm_pt_count($codigo);
			echo json_encode($rspta);
		break;

		case 'codigos_alm_pt':
			$id=$_GET['id'];
			$offset=$_GET['offset'];

			$rspta = $almacen_pt->codigos_alm_pt($id,$offset);

			echo '
						<div class="form-group col-md-12 col-sm-12">

							<b id="num_coin_consul"></b> Concidencias encontradas
							<hr width="100%">
						</div>


			';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						$entradas = $reg->cant_entrada;
						$salidas = $reg->cant_salida;

						$existencia = $entradas - $salidas;

						echo '

								<a href="#" onclick="select_prod('.$reg->idalmacen_pt.',\''.$reg->idproducto.'\')">


                                                <div class="form-group col-md-3 col-sm-3" style="height: 150px;">
                                                	<b id="codigo_prod" style="font-size: 20px;">'. $reg->codigo .'</b><br>
                                                	<p id="descripcion_prod" style="margin-bottom: -2px;">'. $reg->nombre .'</p>
                                                	EXISTENCIA: <b id="existencia_prod" style="font-size: 20px;">'. $existencia .'</b>
                                                	<hr width="100%">
                                                </div>

								</a>



								


						';
						
					}

						
		break;

		case 'codigos_alm_pt5':
			$id=$_GET['id'];

			$rspta = $almacen_pt->codigos_alm_pt($id);

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						echo '

								
                                                	<p>'. $reg->codigo .' - '. $reg->nombre .'</p>
                                                	

								



						';
						
					}

						
		break;

		case 'concidencias':
			
			$codigo = $_POST['codigo'];
										
			$rspta=$almacen_pt->concidencias($codigo);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;



		case 'guardar_registro':
			
			$idalmacen_pt = $_POST['idalmacen_pt'];
			$tipo = $_POST['tipo'];
			$codigo = $_POST['codigo'];
			$codigo_alm = $_POST['codigo_alm'];
			$codigo_nuevo = $_POST['codigo_nuevo'];
			//$valid_cod = $_POST['valid_cod'];
			$sub_code = $_POST['sub_code'];
			$nombre = $_POST['nombre'];
			$medidas = $_POST['medidas'];
			$alto = $_POST['alto'];
			$largo = $_POST['largo'];
			$ancho = $_POST['ancho'];
			$extra = $_POST['extra'];
			$color = $_POST['color'];
			$cantidad = $_POST['cantidad'];
			$mov = $_POST['mov'];
			$lote = $_POST['lote'];
			$op = $_POST['op'];
			$control = $_POST['control'];
			$fecha_hora = $_POST['fecha_hora'];
			$comentario = $_POST['comentario'];
			$idproducto_clasif = $_POST['idproducto_clasif'];
										
			$rspta=$almacen_pt->guardar_registro($idalmacen_pt,$tipo,$codigo,$codigo_alm,$codigo_nuevo,$sub_code,$nombre,$medidas,$alto,$largo,$ancho,$extra,$color,$cantidad,$mov,$lote,$op,$control,$fecha_hora,$comentario,$idproducto_clasif);
			echo json_encode($rspta);


				
	 	
		break;


		case 'select_prod':
			
			$idalmacen_pt = $_POST['idalmacen_pt'];
										
			$rspta=$almacen_pt->select_prod($idalmacen_pt);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'sub_codigo':
			
			$codigo_nuevo = $_POST['codigo_nuevo'];
										
			$rspta=$almacen_pt->sub_codigo($codigo_nuevo);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		
		case 'listar_re_alm':
			
			//$id=$_GET['id'];
			//$num=$_GET['num'];

			$rspta = $almacen_pt->listar_re_alm();



						echo '	<thead>

	                              <tr align="center" style="background: #034343; color: white;">
	                                <th style="width: 10%;">Tipo</th>
	                                <th style="width: 10%;">Codigo</th>
	                                <th style="width: 40%;">Nombre</th>
	                                <th style="width: 10%;">Medidas</th>	                                
	                                <th style="width: 10%;">Color</th>
	                                <th style="width: 20%;">Cantidad</th>
	                                                                
	                              </tr>

	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						/*if ($reg->estatus==1) {
							$estatus2 = 'Enlace';
						}*/
						
						$entradas = $reg->cant_entrada;
						$salidas = $reg->cant_salida;

						$existencia = $entradas - $salidas;

						echo '

								
								
									 <tr>
									
										<td align="center">'.$reg->tipo.'</td>
										<td align="left">'.$reg->codigo.'</td>
						                <td>'.$reg->nombre.'</td>
						                <td align="center">'.$reg->medidas.'</td>
						                <td>'.$reg->color.'</td>
						                <td align="center">'.$existencia.'</td>
		                               
		          
		                                
		                                
	                               		
		                             </tr>


	                            

						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_es':
			
			$id=$_GET['id'];
			//$num=$_GET['num'];

			$rspta = $almacen_pt->listar_es($id);



						echo '	<thead>

	                              <tr align="center" style="background: #034343; color: white;">
	                                
	                                <th style="width: 5%;">ID</th>
	                                <th style="width: 30%;">Producto</th>
	                               
	                                <th style="width: 10%;" colspan="2">Entrada | Salida</th>	                                
	                                
	                                <th style="width: 10%;">Cant.</th>
	                                <th style="width: 15%;">Lote</th>
	                                <th style="width: 15%;">Fecha</th>
	                                <th style="width: 10%;">Comentario</th>
	                                <th style="width: 5%;">Eliminar</th>                                
	                              </tr>

	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						/*if ($reg->estatus==1) {
							$estatus2 = 'Enlace';
						}*/

						$mov = $reg->movimiento;
						$mov1 = "";
						$mov2 = "";

						if ($mov=="Salida") {

							$mov1="";
							$mov2="Salida";

						}elseif ($mov=="Entrada") {

							$mov1="Entrada";
							$mov2="";

						}elseif ($mov<>"Entrada" AND $mov<>"Salida") {

							$mov1="";
							$mov2="";

						}

						
						


						echo '

								
								
									 <tr>
										
										<td>'.$reg->idalmacen_pt_ed.'</td>
										<td><b>'.$reg->codigo.'</b><br>
										<small><b>'.$reg->nombre.'</b></small><br>
										Control: '.$reg->control.'<br>
										OP: '.$reg->op.'
										</td>
						                
						                <td>'.$mov1.'</td>
						                <td>'.$mov2.'</td>
						                <td align="center">'.$reg->cantidad.'</td>
						                <td align="center">'.$reg->lote.'</td>
						                <td align="center">'.$reg->fecha_hora.'</td>
		          							<td align="center">'.$reg->comentario.'</td>
		          							<td align="center"><span class="glyphicon glyphicon-trash" aria-hidden="true" onclick="borrar_registro('.$reg->idalmacen_pt_ed.');" style="cursor: pointer;"></span></td>
		                                
		                                
	                               		
		                             </tr>


	                            

						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'listar_es_todo':
			
			$id=$_GET['id'];
			//$num=$_GET['num'];

			$rspta = $almacen_pt->listar_es_todo($id);



						echo '	<thead>

	                              <tr align="center" style="background: #034343; color: white;">
	                                
	                                <th style="width: 5%;">ID</th>
	                                <th style="width: 30%;">Producto</th>
	                               
	                                <th style="width: 10%;" colspan="2">Entrada | Salida</th>	                                
	                                
	                                <th style="width: 10%;">Cant.</th>
	                                <th style="width: 15%;">Lote</th>
	                                <th style="width: 15%;">Fecha</th>
	                                <th style="width: 15%;">Comentario</th>
	                                                                
	                              </tr>

	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						/*if ($reg->estatus==1) {
							$estatus2 = 'Enlace';
						}*/

						$mov = $reg->movimiento;
						$mov1 = "";
						$mov2 = "";

						if ($mov=="Salida") {

							$mov1="";
							$mov2="Salida";

						}elseif ($mov=="Entrada") {

							$mov1="Entrada";
							$mov2="";

						}elseif ($mov<>"Entrada" AND $mov<>"Salida") {

							$mov1="";
							$mov2="";

						}

						
						


						echo '

								
								
									 <tr>
										
										<td>'.$reg->idalmacen_pt_ed.'</td>
										<td><b>'.$reg->codigo.'</b><br>
										<small><b>'.$reg->nombre.'</b></small><br>
										Control: '.$reg->control.'<br>
										OP: '.$reg->op.'
										</td>
						                
						                <td>'.$mov1.'</td>
						                <td>'.$mov2.'</td>
						                <td align="center">'.$reg->cantidad.'</td>
						                <td align="center">'.$reg->lote.'</td>
						                <td align="center">'.$reg->fecha_hora.'</td>
		          							<td align="center">'.$reg->comentario.'</td>
		                                
		                                
	                               		
		                             </tr>


	                            

						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		//<input type="number" class="form-control" id="exist_inv'.$reg->idalmacen_pt.'" onkeyup="update_existencia('.$reg->idalmacen_pt.');" value="'.$reg->cantidad.'">

		case 'listar_fabricados':
			
			$id=$_GET['id'];
			//$num=$_GET['num'];

			$rspta = $almacen_pt->listar_fabricados($id);



						echo '	<thead>

								  <tr align="center" style="background: #EDF0F0;">
								  	
									<th>Codigo</th>
									<th>Detalle</th>
									<th>Estatus</th>
									<th>Opciones</th>
									
									
									
								  </tr>

	                              

	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						/*if ($reg->estatus==1) {
							$estatus2 = 'Enlace';
						}*/
						if ($reg->validacion==1) {
							$color = '03C818';
							$estatus='Validado';
						}elseif ($reg->validacion==2) {
							$color = 'C80312';
							$estatus='Alerta';
						}elseif ($reg->validacion==0) {
							$color = 'ffffff';
							$estatus='';
						}


						echo '

								
								
									 <tr onclick="detalle_producto('.$reg->idpg_detped.');">
									
										
										<td>'.$reg->codigo.'</td>
						                <td>'.$reg->descripcion.'</td>
						                <td style="color: #'.$color.';"><strong>'.$estatus.'</strong></td>
						                <td align="center">

						                	<button type="button" class="btn btn-success" onclick="detalle_producto('.$reg->idpg_detped.');"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>

						                </td>
						               
		                             </tr>


	                            

						';
						
					}

						echo '</tbody>
							  

						';
			
		break;

		case 'detalle_producto':
			
			$idpg_detped = $_POST['idpg_detped'];
										
			$rspta=$almacen_pt->detalle_producto($idpg_detped);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'cargar_estatus':
			
			$id=$_GET['id'];
			//$num=$_GET['num'];

			$rspta = $almacen_pt->cargar_estatus($id);


			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						/*if ($reg->estatus==1) {
							$estatus2 = 'Enlace';
						}*/
						


						echo '

								
								
													<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->idpg_detped.'" aria-expanded="true" aria-controls="collapseOne" onclick="listar_areas('.$reg->op.',\''.$reg->idpg_detped.'\');">
                                                          
                                                        	 <h5>'.$reg->estatus.'</h5>
                                                          

                                                        </a>
                                                        <div id="collapseOne'.$reg->idpg_detped.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                          <div class="panel-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 1000px;">

                                                          	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="box_areas'.$reg->idpg_detped.'">

                                  							</div>


                                                          	
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>


	                            

						';
						
					}
			
		break;

		case 'listar_areas':
			
			$id=$_GET['id'];
			//$num=$_GET['num'];

			$rspta = $almacen_pt->listar_areas($id);


			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						/*if ($reg->estatus==1) {
							$estatus2 = 'Enlace';
						}*/
						


						echo '

								  <a class="btn btn-app">
				                    <i class="fa fa-edit"></i> '.$reg->idop_detalle.'
				                  </a>


						';
						
					}

			
		break;

		case 'validado':
			
			$idpg_detped = $_POST['idpg_detped'];
										
			$rspta=$almacen_pt->validado($idpg_detped);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'alerta':
			
			$idpg_detped = $_POST['idpg_detped'];
										
			$rspta=$almacen_pt->alerta($idpg_detped);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'listar_lotes':
			
			$id=$_GET['id'];
			$val2=$_GET['val2'];

			$rspta = $almacen_pt->listar_lotes($id,$val2);



						echo '	<thead>

								  <tr align="center" style="background: #EDF0F0;"> 	
									<th>Cantidad</th>
									<th>Lote</th>
									<th>Comentario</th>
									<th>Fecha</th>
								  </tr>

	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
				

						echo '
									 <tr>
										<td>'.$reg->avance.'</td>
						                <td>'.$reg->lote.'</td>
						                <td>'.$reg->comentario.'</td>
						                <td>'.$reg->fecha_hora.'</td>
		                             </tr>

						';
						
					}

						echo '</tbody>
							  
						';
			
		break;

		case 'buscar_idop':
			
			$op = $_POST['op'];
										
			$rspta=$almacen_pt->buscar_idop($op);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_areas2':
			
			$id=$_GET['id'];
			//$num=$_GET['num'];

			$rspta = $almacen_pt->listar_areas2($id);


			while ($reg = $rspta->fetch_object())
					{
				
						if ($reg->area==1) {
							$area = 'Herrería';
						}
						if ($reg->area==2) {
							$area = 'Pintura';
						}
						if ($reg->area==3) {
							$area = 'Plásticos';
						}
						if ($reg->area==5) {
							$area = 'Ensamble (Porcelanizado)';
						}
						if ($reg->area==6) {
							$area = 'Ensamble (Comercial)';
						}
						if ($reg->area==7) {
							$area = 'Ensamble (Mueble)';
						}
						if ($reg->area==8) {
							$area = 'Horno';
						}

						echo '
								<button class="btn btn-secondary" type="button" onclick="listar_lotes('.$reg->area.');">'.$area.'</button>	

						';
						
					}


		break;

		case 'update_existencia':
			
			$idalmacen_pt = $_POST['idalmacen_pt'];
			$exist_inv = $_POST['exist_inv'];
										
			$rspta=$almacen_pt->update_existencia($idalmacen_pt,$exist_inv);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'abrir_detalle_mov':
			
			$idalmacen_pt_ed = $_POST['idalmacen_pt_ed'];
										
			$rspta=$almacen_pt->abrir_detalle_mov($idalmacen_pt_ed);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'abrir_terminados':

			$rspta = $almacen_pt->abrir_terminados();
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->cant_exc==null OR $reg->cant_exc=="") {
							$cant_exc = 0;
						}elseif ($reg->cant_exc>0) {
							$cant_exc = $reg->cant_exc;
						}

						if ($reg->ultimo_avance=='' OR $reg->ultimo_avance==null) {
							$ultimo_avance=0;
						}elseif ($reg->ultimo_avance>=0) {
							$ultimo_avance=$reg->ultimo_avance;
						}
						
						$cantidad_total = ($reg->avance+$cant_exc)-$ultimo_avance;


						echo '

													<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->idavance_prod.'" aria-expanded="true" aria-controls="collapseOne" onclick="listar_avances('.$reg->idavance_prod.',\''.$reg->area.'\',\''.$reg->idop_detalle_prod.'\');">
                                                          
                                                          <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10" align="left">
                                                          	
                                                          	<b>'.$reg->nom_area.'</b><br>
                                                          	<b>'.$reg->descripcion.'</b><br>
                                                          	<small>Codigo: '.$reg->codigo.', </small><small>Medidas: '.$reg->medida.', </small><small>Color: '.$reg->color.'</small>
								                                    
                                                          </div>
                                                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2" align="left">
                                                          	
                                                          	  <div class="btn-group">
			                                                    <button type="button" class="btn btn-dark" id="" onclick="descartar_avance('.$reg->idavance_prod.');"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			                                                  </div>
			                                                  <div class="btn-group">
			                                                  	<button type="button" class="btn btn-primary" onclick="abrir_modal_ubicacion('.$reg->idavance_prod.',\''.$reg->cant_capt.'\');"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></button>
			                                                  </div>
			                                                  
								                                    
                                                          </div>

                                                          <table id="" class="table table-bordered">
                                                          	  <tr>

                                                          	  	

                                                          	  	<td width="10%" align="center">
								                                    
								                                    Control
								                                   
								                                    
							                                    </td>
							                                    <td width="10%" align="center">
								                                    
								                                    OP
								                                    
								                                    
							                                    </td>
							                                   
							                                    
							                                    

							                                    <td width="10%" align="center">
							                                    	Cant. entregada
							                                    	
							                                    	
							                                    	 
							                                    </td>
							                                    <td width="10%" align="center">
							                                    	Total 
							                                    </td>
							                                    <td width="10%" align="center">
							                                    	Avance
							                                    </td>

							                                    <td width="15%" align="center">

							                                    	Lote
							                                    	
							                                    	 
							                                    </td>

							                                    
							                                    <td width="15%" align="center">
							                                    	
							                                    	Fecha
							                                    	 
							                                    </td>

							                                    <td width="20%" align="center">
							                                    	
							                                    	Comentario
							                                    	 
							                                    </td>

                                                          	  </tr>
							                                  <tr>

							                                  	
							                                  	
							                                    <td width="" align="center">
								                                    
								                                  
								                                    <label style="font-weight: bold; font-size: 15px;">'.$reg->no_control.'</label><br>
								                                    
							                                    </td>
							                                    <td width="" align="center">
								                                    
								                                   
								                                    <label style="font-weight: bold; font-size: 15px;">'.$reg->no_op.'</label><br>
								                                    
							                                    </td>
							                                   
							                                    
							                                    

							                                    <td width="" align="center">
							                                    	
							                                    	<label style="font-weight: bold; font-size: 25px;">'.$reg->cant_capt.'</label><br>
							                                    	 
							                                    </td>

							                                    <td width="" align="center">
							                                    	
							                                    	<label style="font-weight: bold; font-size: 15px;">'.$reg->cant_tot.'</label><br>
							                                    	 
							                                    </td>

							                                    <td width="" align="center">
							                                    	
							                                    	<label style="font-weight: bold; font-size: 15px;">'.$reg->avance.'</label><br>
							                                    	 
							                                    </td>

							                                    <td width="" align="center">
							                                    
							                                    	
							                                    	<label style="font-weight: bold; font-size: 15px;">'.$reg->lote.'</label><br>
							                                    	 
							                                    </td>

							                                    
							                                    <td width="" align="center">
							                                    	<label style="font-weight: bold; font-size: 12px;">'.$reg->fecha_hora.'</label>
							                                    	
 
							                                    </td>

							                                    <td width="" align="center">
							                                    	<label style="font-weight: bold; font-size: 12px;">'.$reg->comentario.'</label>
							                                    	
 
							                                    </td>

							                                    
							                                    
							                                    

							                                   
							                                  </tr>
							                                  
							                               </table>

                                                        </a>
                                                        <div id="collapseOne'.$reg->idavance_prod.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

                                                        			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">
                                                        				<hr width="100%">
                                                        				<a href="" id="enlace_op3'.$reg->idop_detalle.'" onclick="abrir_op3('.$reg->idop_detalle.');" target="_blank">
								                                            <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
								                                        </a>

																	 

																	    
                                                        			</div>

                                                          <div class="panel-body" style="border-bottom: solid;">

                                                          	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="left">
                                                          		<h4>Avances</h4>
                                                          	</div>

                                                          	<table class="table table-bordered" id="tbl_avances1'.$reg->idavance_prod.'">
                                                              
                                                            </table>

                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="left">
                                                          		<h4>Excedente</h4>
                                                          	</div>

                                                          	<table class="table table-bordered" id="tbl_avances'.$reg->idavance_prod.'">
                                                              
                                                            </table>
                                                          	<hr width="100%">
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>

						';
						

						

				

						
					}

						
		break;

		case 'abrir_excedentes':

			$rspta = $almacen_pt->abrir_excedentes();
			while ($reg = $rspta->fetch_object())
					{


						echo '

													<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->idop_detalle_exc.'" aria-expanded="true" aria-controls="collapseOne" >
                                                          
                                                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="left">
                                                          	
                                                          	<b>'.$reg->nom_area.'</b><br>
                                                          	<b>'.$reg->descripcion.'</b><br>
                                                          	<small>Codigo: '.$reg->codigo.', </small><small>Medidas: '.$reg->medida.', </small><small>Color: '.$reg->color.'</small>
								                                    
                                                          </div>
                                                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">
                                                          	
                                                          	  <div class="btn-group">
			                                                    <button type="button" class="btn btn-dark" id="" onclick="descartar_excedente('.$reg->idop_detalle_exc.');"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			                                                    
			                                                  </div> 

			                                                  <div class="btn-group">
			                                                  	<button type="button" class="btn btn-primary" onclick="abrir_modal_ubicacion_exc('.$reg->idop_detalle_exc.',\''.$reg->cantidad.'\');"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></button>
			                                                  			
			                                                  </div> 

			                                                 
								                                    
                                                          </div>

                                                          <table id="" class="table table-bordered">
                                                          	  <tr>

                                                          	  	<td width="10%" align="center">
								                                    
								                                    ID
								                                   
								                                    
							                                    </td>

                                                          	  	<td width="14%" align="center">
								                                    
								                                    Control
								                                   
								                                    
							                                    </td>
							                                    <td width="14%" align="center">
								                                    
								                                    OP
								                                    
								                                    
							                                    </td>
							                                   
							                                    
							                                    

							                                    <td width="14%" align="center">
							                                    	Cantidad
							                                    	
							                                    	
							                                    	 
							                                    </td>

							                                    <td width="24%" align="center">

							                                    	Lote
							                                    	
							                                    	 
							                                    </td>

							                                    
							                                    <td width="24%" align="center">
							                                    	
							                                    	Fecha
							                                    	 
							                                    </td>

							                                    <td width="" align="center">
							                                    	
							                                    	Comentario
							                                    	 
							                                    </td>

                                                          	  </tr>
							                                  <tr>

							                                  	<td width="" align="center">
								                                     
								                                    <label style="font-weight: bold; font-size: 15px;">'.$reg->idop_detalle_exc.'</label><br>
								                                    
							                                    </td>
							                                  	
							                                    <td width="" align="center">
								                                    
								                                  
								                                    <label style="font-weight: bold; font-size: 15px;">'.$reg->no_control.'</label><br>
								                                    
							                                    </td>
							                                    <td width="" align="center">
								                                    
								                                   
								                                    <label style="font-weight: bold; font-size: 15px;">'.$reg->no_op.'</label><br>
								                                    
							                                    </td>
							                                   
							                                    
							                                    

							                                    <td width="" align="center">
							                                    	
							                                    	<label style="font-weight: bold; font-size: 25px;">'.$reg->cantidad.'</label><br>
							                                    	 
							                                    </td>

							                                    <td width="" align="center">
							                                    
							                                    	
							                                    	<label style="font-weight: bold; font-size: 15px;">'.$reg->lote.'</label><br>
							                                    	 
							                                    </td>

							                                    
							                                    <td width="" align="center">
							                                    	<label style="font-weight: bold; font-size: 12px;">'.$reg->fecha_hora.'</label>
							                                    	
 
							                                    </td>

							                                    <td width="" align="center">
							                                    	<label style="font-weight: bold; font-size: 12px;">'.$reg->comentario.'</label>
							                                    	
 
							                                    </td>

							                                    
							                                    
							                                    

							                                   
							                                  </tr>
							                                  
							                               </table>

                                                        </a>
                                                        
                                                      </div>
                                                    </div>

						';
						

						

				

						
					}

						
		break;

		case 'listar_terminados_buscar':

			$op=$_GET['op'];

			$rspta = $almacen_pt->listar_terminados_buscar($op);
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->cant_exc==null OR $reg->cant_exc=="") {
							$cant_exc = 0;
						}elseif ($reg->cant_exc>0) {
							$cant_exc = $reg->cant_exc;
						}
						
						$cantidad_total = $reg->cant_tot+$cant_exc;


						echo '

													<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->idavance_prod.'" aria-expanded="true" aria-controls="collapseOne" onclick="listar_avances('.$reg->idavance_prod.',\''.$reg->area.'\',\''.$reg->idop_detalle_prod.'\');">
                                                          

                                                          <table id="" class="table table-hover">
							                                  <tr>
							                                  	<td width="20%">
								                                    
								                                    <small>Área:</small><br>
								                                    <label style="font-weight: bold; font-size: 13px;">'.$reg->nom_area.'</label><br>
								                                    
							                                    </td>
							                                    <td width="10%">
								                                    
								                                    <small>Control:</small><br>
								                                    <label style="font-weight: bold; font-size: 18px;">'.$reg->no_control.'</label><br>
								                                    
							                                    </td>
							                                    <td width="10%">
								                                    
								                                    <small>OP:</small><br>
								                                    <label style="font-weight: bold; font-size: 18px;">'.$reg->no_op.'</label><br>
								                                    
							                                    </td>
							                                   
							                                    <td width="20%">
							                              
							                                    	<small>Codigo: '.$reg->codigo.'</small><br>
								                                    <label style="font-weight: bold; font-size: 12px;">'.$reg->descripcion.'</label><br>
								                                    <small>Medidas: '.$reg->medida.'</small><br>
								                                    <small>Color: '.$reg->color.'</small><br>
							                                    	 
							                                    </td>
							                                    

							                                    <td width="20%" align="center">
							                                    	Cantidad:<br>
							                                    	
							                                    	<label style="font-weight: bold; font-size: 18px;">'.$cantidad_total.'</label><br>
							                                    	 
							                                    </td>

							                                    
							                                    <td width="20%">
							                                    	Fecha de termino:<br>
							                                    	
							                                    	<label style="font-weight: bold; font-size: 15px;">'.$reg->fecha_hora.'</label><br>
							                                    	 
							                                    </td>
							                                    
							                                    

							                                   
							                                  </tr>
							                                  
							                               </table>

                                                        </a>
                                                        <div id="collapseOne'.$reg->idavance_prod.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

                                                        			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">
                                                        				<hr width="100%">
                                                        				<a href="" id="enlace_op3'.$reg->idop_detalle.'" onclick="abrir_op3('.$reg->idop_detalle.');" target="_blank">
								                                            <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
								                                        </a>

																	    <a href="#" onclick="">
															               <button type="button" class="btn btn-dark">Enviar comentario</button>
																	    </a>

																	    <a href="#">
															               <button type="button" class="btn btn-primary" onclick="abrir_modal_ubicacion('.$reg->idavance_prod.',\''.$cantidad_total.'\');">Autorizar y registrar entrada</button>
																	    </a>

																	    
                                                        			</div>

                                                          <div class="panel-body" style="border-bottom: solid;">

                                                          	<table class="table table-bordered" id="tbl_avances'.$reg->idavance_prod.'">
                                                              
                                                            </table>
                                                          	<hr width="100%">
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>

						';
						

						

				

						
					}

						
		break;

		case 'listar_avances':
			
			$id=$_GET['id'];
			//$area=$_GET['area'];

			$rspta = $almacen_pt->listar_avances($id);



						echo '	<thead>

								  <tr align="center" style="background: #EDF0F0;"> 	
									<th>Cantidad</th>
									<th>Lote</th>
									
									<th>Fecha</th>
								  </tr>

	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
				

						echo '
									 <tr>
										<td>'.$reg->cantidad.'</td>
						                <td>'.$reg->lote.'</td>
						                
						                <td>'.$reg->fecha_hora.'</td>
		                             </tr>

						';
						
					}

						echo '</tbody>
							  
						';
			
		break;

		case 'listar_avances1':
			
			$id=$_GET['id'];
			//$area=$_GET['area'];

			$rspta = $almacen_pt->listar_avances1($id);



						echo '	<thead>

								  <tr align="center" style="background: #EDF0F0;"> 	
									<th>Cantidad</th>
									<th>Lote</th>
									<th>Comentario</th>
									<th>Fecha</th>

								  </tr>

	                            </thead>
	                            <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
				

						echo '
									 <tr>
										<td>'.$reg->cantidad.'</td>
						                <td>'.$reg->lote.'</td>
						                
						                <td>'.$reg->fecha_hora.'</td>
		                             </tr>

						';
						
					}

						echo '</tbody>
							  
						';
			
		break;

		case 'buscar_idprod':
			
			$idavance = $_POST['idavance'];
										
			$rspta=$almacen_pt->buscar_idprod($idavance);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_idprod_exc':
			
			$idexc = $_POST['idexc'];
										
			$rspta=$almacen_pt->buscar_idprod_exc($idexc);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_entrada':
			
			$idavance = $_POST['idavance'];
			$idproducto = $_POST['idproducto'];
			$cantidad = $_POST['cantidad'];
			$lote = $_POST['lote'];
			$no_control = $_POST['no_control'];
			$no_op = $_POST['no_op'];
			$fecha_hora = $_POST['fecha_hora'];
			$comentario = $_POST['comentario'];
			$ubicacion = $_POST['ubicacion'];
			$exist_prod = $_POST['exist_prod'];
										
			$rspta=$almacen_pt->guardar_entrada($idavance,$idproducto,$cantidad,$lote,$no_control,$no_op,$fecha_hora,$comentario,$ubicacion,$exist_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_entrada_exc':
			
			$idexc = $_POST['idexc'];
			$idproducto = $_POST['idproducto'];
			$cantidad = $_POST['cantidad'];
			$lote = $_POST['lote'];
			$no_control = $_POST['no_control'];
			$no_op = $_POST['no_op'];
			$fecha_hora = $_POST['fecha_hora'];
			$comentario = $_POST['comentario'];
			$ubicacion = $_POST['ubicacion'];
			$exist_prod = $_POST['exist_prod'];
										
			$rspta=$almacen_pt->guardar_entrada_exc($idexc,$idproducto,$cantidad,$lote,$no_control,$no_op,$fecha_hora,$comentario,$ubicacion,$exist_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'exist_prod_alm':
			
			$idproducto = $_POST['idproducto'];
										
			$rspta=$almacen_pt->exist_prod_alm($idproducto);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_error':
			
			$idop_detalle_prod = $_POST['idop_detalle_prod'];
			$exist_prod = $_POST['exist_prod'];
										
			$rspta=$almacen_pt->guardar_error($idop_detalle_prod,$exist_prod);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'buscar_codigo':
			
			$codigo = $_POST['codigo'];
			//$exist_prod = $_POST['exist_prod'];
										
			$rspta=$almacen_pt->buscar_codigo($codigo);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_exist_alm':
			
			$codigo = $_POST['codigo'];
			//$exist_prod = $_POST['exist_prod'];
										
			$rspta=$almacen_pt->consul_exist_alm($codigo);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;
		case 'descartar_avance':
			
			$idavance_prod = $_POST['idavance_prod'];
			$comentario = $_POST['comentario'];
			$fecha_hora = $_POST['fecha_hora'];
			//$exist_prod = $_POST['exist_prod'];
										
			$rspta=$almacen_pt->descartar_avance($idavance_prod,$comentario,$fecha_hora);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'descartar_excedente':
			
			$idop_detalle_exc = $_POST['idop_detalle_exc'];
			$comentario = $_POST['comentario'];
			$fecha_hora = $_POST['fecha_hora'];
			//$exist_prod = $_POST['exist_prod'];
										
			$rspta=$almacen_pt->descartar_excedente($idop_detalle_exc,$comentario,$fecha_hora);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'abrir_movimientos':
			

			$rspta = $almacen_pt->abrir_movimientos();



						echo '<thead>
                                <tr>
                                  <th>Opciones</th>
                                  <th>No. Embarque</th>
                                  <th>Fecha de salida</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						if ($reg->estatus==0) {
							$estatus="Programada";
						}

						$idsalida = $reg->idsalida;

							echo '

									<tr>
									  <td><button type="button" class="btn btn-dark" onclick="abrir_detalle_mov_salida('.$reg->idsalida.');">Ver</button></td>
	                                  <td><b style="font-size: 20px; color: #169F85;">'.$reg->no_salida.'</b></td>
	                                  <td>'.$reg->fecha_salida.'</td>
	                               
	                                 
	                                </tr>


							';

						
						
					}

						echo '</tbody>';
			
		break;

		case 'abrir_detalle_mov_salida':
			
			$idsalida=$_GET['idsalida'];

			$rspta = $almacen_pt->abrir_detalle_mov_salida($idsalida);



						echo '<thead>
                                <tr>
                                  <th width="10%">Opciones</th>
                                  <th width="10%">No. Salida</th>
                                  
                                  <th width="25%">Descripción</th>
                                  <th width="10%">Cant.</th>
                                  <th width="10%">Asign.</th>
                                  <th width="25%">OP</th>
                                  
                                  <th width="10%">Control</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

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
									  <td><button type="button" class="btn btn-dark" onclick="ver_exist_lotes('.$reg->idproducto.',\''.$reg->cantidad.'\',\''.$reg->identrega.'\',\''.$reg->idpedido.'\');">Ver</button></td>
	                                  <td><b style="font-size: 20px; color: #169F85;">'.$reg->no_salida.'</b></td>
	                                  <td>
	                                  <b>'.$reg->codigo.'</b><br>
	                                  '.$reg->descripcion.'
	                                  </td>
	                               	 
	                               	  <td>'.$reg->cantidad.'</td>
	                               	  <td>
	                               	  	 
	                               	  </td>
	                               	  <td>

							';


								$idproducto=$reg->idproducto;

								$rspta2 = $almacen_pt->listar_lotes_emb($idproducto);
								while ($reg2 = $rspta2->fetch_object()){

									echo '

										<b>'.$reg2->op.'</b><br>

									';

								}


							echo '

									</td>
	                               	  
	                               	  <td>'.$reg->control.'</td>
	                                 
	                                </tr>


							';

						
						
					}

							

						echo '</tbody>';
			
		break;

		case 'consul_codigo':
			
			$iddetalle_pedido = $_POST['iddetalle_pedido'];
			//$exist_prod = $_POST['exist_prod'];
										
			$rspta=$almacen_pt->consul_codigo($iddetalle_pedido);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;


		case 'lotes_codigo':
			
			$idalmacen_pt=$_GET['idalmacen_pt'];
			$codigo=$_GET['codigo'];
			$idpedido=$_GET['idpedido'];

			$rspta = $almacen_pt->lotes_codigo($idalmacen_pt,$idpedido);



						echo '<thead>
                                <tr>
                                  <th>OP</th>
                                  <th>LOTE</th>
                                  <th>ENT.</th>
                                  <th>SAL.</th>
                                  <th>EXIST.</th>
                                  <th>SELEC.</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->lote=="") {
							$cant_lote_disp = $reg->exist_lote - $reg->cant_presalida_nolote;
						}elseif ($reg->lote<>"") {
							$cant_lote_disp = $reg->exist_lote - $reg->cant_presalida;
						}


						
						

							echo '

									<tr>
									  <td>'.$reg->op.'</td>
	                                  <td>'.$reg->lote.'</td>
	                                  <td>'.$reg->cant_lote_e.'</td>
	                                  <td>'.$reg->cant_lote.'</td>
	                                  <td>'.$cant_lote_disp.'</td>
	                               	  <td><a href="#" onclick="enviar_a_salida('.$cant_lote_disp.',\''.$reg->lote.'\',\''.$reg->op.'\');"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a></td>
	                                 
	                                </tr>


							';

						
						
					}

						echo '</tbody>';
			
		break;

		case 'lotes_codigo_vale_':
			
			$idalmacen_pt=$_GET['idalmacen_pt'];
			$codigo=$_GET['codigo'];
			$idpedido=$_GET['idpedido'];

			$rspta = $almacen_pt->lotes_codigo($idalmacen_pt,$idpedido);



						echo '<thead>
                                <tr>
                                  <th>OP</th>
                                  <th>LOTE</th>
                                  <th>ENT.</th>
                                  <th>SAL.</th>
                                  <th>EXIST.</th>
                                  <th>SELEC.</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->lote=="") {
							$cant_lote_disp = $reg->exist_lote - $reg->cant_presalida_nolote;
						}elseif ($reg->lote<>"") {
							$cant_lote_disp = $reg->exist_lote - $reg->cant_presalida;
						}


						
						

							echo '

									<tr>
									  <td>'.$reg->op.'</td>
	                                  <td>'.$reg->lote.'</td>
	                                  <td>'.$reg->cant_lote_e.'</td>
	                                  <td>'.$reg->cant_lote.'</td>
	                                  <td>'.$cant_lote_disp.'</td>
	                               	  <td><a href="#" onclick="enviar_a_presalida('.$cant_lote_disp.',\''.$reg->lote.'\',\''.$reg->op.'\');"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a></td>
	                                 
	                                </tr>


							';

						
						
					}

						echo '</tbody>';
			
		break;

		case 'lotes_codigo_vale':
			
			$idalmacen_pt=$_GET['idalmacen_pt'];
			$codigo=$_GET['codigo'];
			$idpedido=$_GET['idpedido'];

			$rspta = $almacen_pt->lotes_codigo($idalmacen_pt,$idpedido);



						echo '<thead>
                                <tr>
                                  <th>CODIGO</th>
                                  <th>NOMBRE</th>
                                 
                                  <th>EXISTENCIA</th>
                                  <th>SELEC.</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

							$entradas = $reg->cant_entrada;
							$salidas = $reg->cant_salida;
							$salidas = $reg->cant_salida;

							$existencia = $entradas - $salidas - $reg->cant_presalida;
							$lote="";
							$op="";

							echo '

									<tr>
									  								<td>'.$reg->codigo.'</td>
	                                  <td>'.$reg->nombre.'</td>
	                                  <td>'.$existencia.'</td>
	                                  
	                               	  <td><a href="#" onclick="enviar_a_presalida('.$existencia.',\''.$lote.'\',\''.$op.'\');"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a></td>
	                                 
	                                </tr>


							';

						
						
					}

						echo '</tbody>';
			
		break;

		case 'lotes_codigo_idpedido':
			
			$idalmacen_pt=$_GET['idalmacen_pt'];
			$codigo=$_GET['codigo'];
			$idpedido=$_GET['idpedido'];

			$rspta = $almacen_pt->lotes_codigo_idpedido($idalmacen_pt,$idpedido);



						echo '<thead>
                                <tr>
                                  <th>OP</th>
                                  <th>LOTE</th>
                                  <th>ENT.</th>
                                  <th>SAL.</th>
                                  <th>EXIST.</th>
                                  <th>SELEC.</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->lote=="") {
							$cant_lote_disp = $reg->exist_lote - $reg->cant_presalida_nolote;
						}elseif ($reg->lote<>"") {
							$cant_lote_disp = $reg->exist_lote - $reg->cant_presalida;
						}


							echo '

									<tr>
									  <td>'.$reg->op.'</td>
	                                  <td>'.$reg->lote.'</td>
	                                  <td>'.$reg->cant_lote_e.'</td>
	                                  <td>'.$reg->cant_lote.'</td>
	                                  <td>'.$cant_lote_disp.'</td>
	                               	  <td><a href="#" onclick="enviar_a_salida('.$cant_lote_disp.',\''.$reg->lote.'\',\''.$reg->op.'\');"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a></td>
	                                 
	                                </tr>


							';

						
						
					}

						echo '</tbody>';
			
		break;

		case 'lotes_codigo_idpedido_vale':
			
			$idalmacen_pt=$_GET['idalmacen_pt'];
			$codigo=$_GET['codigo'];
			$idpedido=$_GET['idpedido'];

			$rspta = $almacen_pt->lotes_codigo_idpedido($idalmacen_pt,$idpedido);



						echo '<thead>
                                <tr>
                                  <th>OP</th>
                                  <th>LOTE</th>
                                  <th>ENT.</th>
                                  <th>SAL.</th>
                                  <th>EXIST.</th>
                                  <th>SELEC.</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{

						if ($reg->lote=="") {
							$cant_lote_disp = $reg->exist_lote - $reg->cant_presalida_nolote;
						}elseif ($reg->lote<>"") {
							$cant_lote_disp = $reg->exist_lote - $reg->cant_presalida;
						}


							echo '

									<tr>
									  <td>'.$reg->op.'</td>
	                                  <td>'.$reg->lote.'</td>
	                                  <td>'.$reg->cant_lote_e.'</td>
	                                  <td>'.$reg->cant_lote.'</td>
	                                  <td>'.$cant_lote_disp.'</td>
	                               	  <td><a href="#" onclick="enviar_a_presalida('.$cant_lote_disp.',\''.$reg->lote.'\',\''.$reg->op.'\');"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a></td>
	                                 
	                                </tr>


							';

						
						
					}

						echo '</tbody>';
			
		break;

		case 'consul_idalmacen_pt':
			
			$codigo_consul_exist = $_POST['codigo_consul_exist'];
			//$exist_prod = $_POST['exist_prod'];
										
			$rspta=$almacen_pt->consul_idalmacen_pt($codigo_consul_exist);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_presalida':
			
			$idalmacen_pt = $_POST['idalmacen_pt'];
			$iddetalle_pedido = $_POST['iddetalle_pedido'];
			$identrega = $_POST['identrega'];
			$lote = $_POST['lote'];
			$cantidad = $_POST['cantidad'];
			$idpedido = $_POST['idpedido'];
			$sin_lote = $_POST['sin_lote'];
			$op = $_POST['op'];
										
			$rspta=$almacen_pt->guardar_presalida($idalmacen_pt,$iddetalle_pedido,$identrega,$lote,$cantidad,$idpedido,$sin_lote,$op);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'guardar_presalida_vale':
			
			$idalmacen_pt = $_POST['idalmacen_pt'];
			$iddetalle_pedido = $_POST['iddetalle_pedido'];
			$identrega = $_POST['identrega'];
			$lote = $_POST['lote'];
			$cantidad = $_POST['cantidad'];
			$idpedido = $_POST['idpedido'];
			$sin_lote = $_POST['sin_lote'];
			$op = $_POST['op'];
										
			$rspta=$almacen_pt->guardar_presalida_vale($idalmacen_pt,$iddetalle_pedido,$identrega,$lote,$cantidad,$idpedido,$sin_lote,$op);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_prelista':
			
			$idalmacen_pt=$_GET['idalmacen_pt'];
			$identrega=$_GET['identrega'];
			//$via_consul=$_GET['via_consul'];

			$rspta = $almacen_pt->listar_prelista($idalmacen_pt,$identrega);



						echo '<thead>
                                <tr>
                                  
                                  <th>LOTE</th>
                                  <th>CANTIDAD</th>
                                  <th>ESTATUS</th>
                                  <th>ELIMINAR</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
							$estatus = $reg->estatus;

							if ($reg->estatus==0) {
								$estatus="Sin registrar";
							}elseif ($reg->estatus==1) {
								$estatus="Registrado";
							}

							echo '

									<tr>
									 
	                                  <td>'.$reg->lote.'</td>
	                                  <td>'.$reg->cantidad.'</td>
	                                  <td>'.$estatus.'</td>
	                                  <td><button type="button" class="btn"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: red;" onclick="borrar_presalida('.$reg->idpresalida.');"></span></button></td>
	                                 
	                                 
	                                </tr>


							';

						
						
					}

						echo '</tbody>';
			
		break;

		case 'listar_prelista_vale':
			
			$idalmacen_pt=$_GET['idalmacen_pt'];
			$identrega=$_GET['identrega'];
			//$via_consul=$_GET['via_consul'];

			$rspta = $almacen_pt->listar_prelista_vale($idalmacen_pt,$identrega);



						echo '<thead>
                                <tr>
                                  
                                  <th>LOTE</th>
                                  <th>CANTIDAD</th>
                                  <th>ESTATUS</th>
                                  <th>ELIMINAR</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
							$estatus = $reg->estatus;

							if ($reg->estatus==0) {
								$estatus="Sin registrar";
							}elseif ($reg->estatus==1) {
								$estatus="Registrado";
							}

							echo '

									<tr>
									 
	                                  <td>'.$reg->lote.'</td>
	                                  <td>'.$reg->cantidad.'</td>
	                                  <td>'.$estatus.'</td>
	                                  <td><button type="button" class="btn"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: red;" onclick="borrar_presalida('.$reg->idpresalida.');"></span></button></td>
	                                 
	                                 
	                                </tr>


							';

						
						
					}

						echo '</tbody>';
			
		break;

		case 'consul_cant_presalida':
			
			$iddetalle_ped = $_POST['iddetalle_ped'];
			$identrega = $_POST['identrega'];
										
			$rspta=$almacen_pt->consul_cant_presalida($iddetalle_ped,$identrega);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_cant_presalida_vale':
			
			$iddetalle_ped = $_POST['iddetalle_ped'];
			$identrega = $_POST['identrega'];
										
			$rspta=$almacen_pt->consul_cant_presalida_vale($iddetalle_ped,$identrega);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'borrar_presalida':
			
			$idpresalida = $_POST['idpresalida'];
			//$identrega = $_POST['identrega'];
										
			$rspta=$almacen_pt->borrar_presalida($idpresalida);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_exist_lote':
			
			$idalmacen_pt = $_POST['idalmacen_pt'];
			$lote = $_POST['lote'];
			//$identrega = $_POST['identrega'];
										
			$rspta=$almacen_pt->consul_exist_lote($idalmacen_pt,$lote);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'listar_op':
			
			$iddetalle_pedido=$_GET['iddetalle_pedido'];
			//$identrega=$_GET['identrega'];

			$rspta = $almacen_pt->listar_op($iddetalle_pedido);

			while ($reg = $rspta->fetch_object())
					{
						

							echo '

									<b>'.$reg->op.'</b>,


							';

						
						
					}
			
		break;

		case 'guardar_salida':
			
			

			$idalmacen_pt=$_GET['idalmacen_pt'];
			$identrega=$_GET['identrega'];
			$idpedido=$_GET['idpedido'];
			$fecha_hora=$_GET['fecha_hora'];
			//$num_estat=$_GET['num_estat'];
			/*$rspta=$almacen_pt->guardar_salida($idalmacen_pt,$identrega,$idpedido);
			echo json_encode($rspta);*/



			$rspta = $almacen_pt->consul_presalida($idalmacen_pt,$identrega,$idpedido);

			while ($reg = $rspta->fetch_object())
					{

						$idpresalida = $reg->idpresalida;
						$cantidad = $reg->cantidad;
						$lote = $reg->lote;
						$op = $reg->op;

						echo "

							Salida registrada exitosamente: <br> <b>Producto: </b> ".$reg->nom_prod.", Lote: ".$lote.", Cantidad: ".$cantidad."<br>

						";

						$servername = 'localhost';
						$username = 'u690371019_pgmanage';
						//$username = 'root';
						$password = "A=tSXZ4z";
					//	$password = "";
						$dbname = "u690371019_pgmanage";

						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);



						$sql_pre = "SELECT estatus FROM presalida WHERE idpresalida='$idpresalida'";
						$result_pre = mysqli_query($conn, $sql_pre);
						$row = mysqli_fetch_assoc($result_pre);

						$estatus = $row['estatus'];

						if ($estatus==0) {

								/*$sql="INSERT INTO almacen_pt_ed (idalmacen_pt,movimiento,cantidad,lote,fecha_hora,idsalida) VALUES('$idalmacen_pt','Salida','$cantidad','$lote','$fecha_hora','$identrega')";*/
								$sql="INSERT INTO almacen_pt_ed (idalmacen_pt,movimiento,cantidad,lote,op,control,fecha_hora,idsalida) SELECT '$idalmacen_pt','Salida','$cantidad','$lote','$op',no_control,'$fecha_hora', '$identrega' FROM pg_pedidos WHERE idpg_pedidos='$idpedido'";
								$result = $conn->query($sql);

								$sql2="UPDATE presalida SET estatus=1 WHERE idpresalida='$idpresalida'";
								$result = $conn->query($sql2);

								$sql3="UPDATE vale_salida SET estatus=1 WHERE idvale_salida='$identrega'";
								$result = $conn->query($sql3);

								$sql_upd_detped = "SELECT idpg_detped FROM vale_salida WHERE idvale_salida='$identrega'";
								$result_upd_detped = mysqli_query($conn, $sql_upd_detped);
								$row = mysqli_fetch_assoc($result_upd_detped);

								$idpg_detped = $row['idpg_detped'];

								$sql3="UPDATE pg_detped SET estatus='Surtido', fecha_hora2='$fecha_hora' WHERE idpg_detped='$idpg_detped'";
								$result = $conn->query($sql3);

								/*$sql_pre2 = "SELECT count(idvale_salida) as num_estat FROM vale_salida WHERE idvales_almacen=(SELECT idvales_almacen FROM vale_salida WHERE idvale_salida='$identrega') AND estatus=0";
								$result_pre2 = mysqli_query($conn, $sql_pre2);
								$row = mysqli_fetch_assoc($result_pre2);

								$num_estat = $row['num_estat'];

								if ($num_estat==0) {
								
									$sql4="UPDATE vales_almacen SET estatus=2,fecha_hora_surt='$fecha_hora' WHERE idvales_almacen=(SELECT idvales_almacen FROM vale_salida WHERE idvale_salida='$identrega')";
									$result = $conn->query($sql4);

								}*/
							
						}

							
								

						$conn->close();

						/*$rspta2=$almacen_pt->guardar_salida($idalmacen_pt,$cantidad,$lote,$idpedido,$fecha_hora,$identrega);
						echo json_encode($rspta2);*/

						/*$sql="INSERT INTO (idalmacen_pt,movimiento,cantidad,lote,control,fecha_hora,idsalida) SELECT '$idalmacen_pt','Salida','$cantidad','$lote',no_control,'$fecha_hora', '$identrega' FROM pg_pedidos WHERE idpg_pedidos='$idpedido'";*/
						
					}

		break;

		case 'listar_comp_prod':
			
			$iddetalle_ped=$_GET['iddetalle_ped'];
			//$identrega=$_GET['identrega'];

			$rspta = $almacen_pt->listar_comp_prod($iddetalle_ped);



						echo '<thead>
                                <tr>
                                  
                                  <th>CODIGO</th>
                                  <th>CANTIDAD</th>
                                  <th>OP</th>
                                  <th>ESTATUS</th>
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
							

							echo '

									<tr>
									 
	                                  <td>'.$reg->codigo.'</td>
	                                  <td>'.$reg->cantidad.'</td>
	                                  <td>'.$reg->op.'</td>
	                                  <td>'.$reg->estatus.'</td>
	                           
	                                 
	                                 
	                                </tr>


							';

						
						
					}

						echo '</tbody>';
			
		break;


		case 'listar_vales_alm':
			
			$estatus=$_GET['estatus'];

			$rspta = $almacen_pt->listar_vales_alm($estatus);



						echo '<thead>
                                <tr>
                                  <th>No. Vale</th>
                                  <th>Fecha de registro</th>
                                  <th>Fecha de solicitud</th>
                                  <th>Estatus</th>
                               	  <th>Opciones</th>
                                  
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						
						if ($reg->estatus==1) {
							$estatus = "Solicitado";
						}elseif ($reg->estatus==2 || $reg->estatus==4) {
							$estatus = "Surtido";
						}elseif ($reg->estatus==6) {
							$estatus = "Rechazado";
						}



						if ($reg->prioridad==1) {
							$prioridad = "| Urgente";
							$back_fila = "#F7B0A9;";
						}
						if ($reg->prioridad==0) {
							$prioridad = "";
							$back_fila = "#fff;";
						}

						echo '

								<tr style="background: '.$back_fila.'">
                                  <td>'.$reg->no_vale.'</td>
                                  
                                  <td>'.$reg->fecha_hora_reg.'</td>
                                  <td>'.$reg->fecha_hora_solic.'</td>
                                  <td>'.$estatus.' '.$prioridad.'<br>'.$reg->fecha_hora_rech.'<br>'.$reg->motivo.'</td>

                                  <td><a href="#"><button type="button" class="btn btn-info" onclick="ver_vale('.$reg->idvales_almacen.',\''.$reg->no_vale.'\')">Abrir</button></a></td>
                                 
   
                                </tr>


						';
						
					}

						echo '</tbody>';
			
		break;

		case 'listar_vale':
			
			$id=$_GET['id'];

			$rspta = $almacen_pt->listar_vale($id);



						echo '<thead>
                                <tr>
                                 
                                  <th width="25%">Producto</th>
                                  <th width="10%">Cantidad</th>
                                  <th width="10%">Control</th>
                                  <th width="30%">Lote | OP</th>
                                
                                  <th width="20%">Estatus</th>
                                  
                               	  <th width="5%">Opciones</th>
                                  
                                </tr>
                              </thead>
                              <tbody>';

			//$total=0;
			while ($reg = $rspta->fetch_object())
					{
						if ($reg->color<>'') {
							$color = "Color: ".$reg->color.", ";
						}elseif ($reg->color=='') {
							$color = "";
						}

						if ($reg->medida<>'') {
							$medida = "Medidas: ".$reg->medida;
						}elseif ($reg->medida=='') {
							$medida = "";
						}

						


						if ($reg->estatus==0) {
							
							$disab_btn = "";
							$text_estat = "Pendiente";

						}elseif ($reg->estatus==1) {
							
							$disab_btn = "disabled";
							$text_estat = "Surtido";

						}elseif ($reg->estatus==2) {
							
							$disab_btn = "disabled";
							$text_estat = "Rechazado";

						}elseif ($reg->estatus==3) {
							// code...
							$disab_btn = "disabled";
							$text_estat = "Reingresado";
						}

						if ($reg->descripcion<>"") {

							$descrip = $reg->descripcion;
							$code = $reg->codigo;
							// code...
						}elseif ($reg->descripcion=="") {

							$descrip = $reg->nombre;
							$code = $reg->codigo_alm;
							// code...
						}

						
						echo '

																<tr>
                                 
                                  <td>
                                  	<b>'.$code.'</b><br>
                                  	'.$descrip.'<br>
                                  	'.$color.$medida.'

                                  </td>
                                  <td>'.$reg->cantidad.'</td>
                                  <td>'.$reg->control.'</td>
                                  <td>

						';


								$idvale_salida=$reg->idvale_salida;

								$rspta2 = $almacen_pt->listar_lotes_alm($idvale_salida);
								while ($reg2 = $rspta2->fetch_object()){

									echo '

										<b>'.$reg2->lote.'</b>('.$reg2->cantidad.') | '.$reg2->op.'<br>

									';

								}



						echo '
																</td>
                                 
                                 
																	<td>

																		<b>'.$text_estat .'</b><br>
																		'.$reg->motivo_rechazo.'

																	</td>
                                  <td><a href="#">
                                  <button type="button" class="btn btn-info" onclick="validar_producto('.$reg->idvale_salida.',\''.$reg->idalmacen_pt.'\')" '.$disab_btn.'>Surtir</button>
                                  <button type="button" class="btn btn-info" onclick="rechazar_producto('.$reg->idvale_salida.',\''.$reg->idvales_almacen.'\',\''.$reg->idpg_detped.'\')" '.$disab_btn.'>Rechazar</button>
                                  </a></td>
                                 
   
                                </tr>
								';
						
					}

						echo '</tbody>';
			
		break;

		case 'consul_prod_vale':
			
			$idvale_salida = $_POST['idvale_salida'];
			//$lote = $_POST['lote'];
			//$identrega = $_POST['identrega'];
										
			$rspta=$almacen_pt->consul_prod_vale($idvale_salida);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'sum_prelista':
			
			$idalmacen_pt = $_POST['idalmacen_pt'];
			$identrega = $_POST['identrega'];
			$idpedido = $_POST['idpedido'];
			//$lote = $_POST['lote'];
			//$identrega = $_POST['identrega'];
										
			$rspta=$almacen_pt->sum_prelista($idalmacen_pt,$identrega,$idpedido);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'notif_surtido':
			
			$idvales_almacen = $_POST['idvales_almacen'];
			$fecha_hora = $_POST['fecha_hora'];
										
			$rspta=$almacen_pt->notif_surtido($idvales_almacen,$fecha_hora);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'consul_surtido_tot':
			
			$idvales_almacen = $_POST['idvales_almacen'];
			//$fecha_hora = $_POST['fecha_hora'];
										
			$rspta=$almacen_pt->consul_surtido_tot($idvales_almacen);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'notif_rechazo':
			
			$idvales_almacen = $_POST['idvales_almacen'];
			$fecha_hora = $_POST['fecha_hora'];
			$motivo = $_POST['motivo'];
			//$fecha_hora = $_POST['fecha_hora'];
										
			$rspta=$almacen_pt->notif_rechazo($idvales_almacen,$fecha_hora,$motivo);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		/*case 'rechazar_producto':
			
			$idvale_salida = $_POST['idvale_salida'];
			$motivo = $_POST['motivo'];
										
			$rspta=$almacen_pt->rechazar_producto($idvale_salida,$motivo);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;*/

		case 'rechazar_producto':
			
			$idvale_salida = $_POST['idvale_salida'];
			$motivo = $_POST['motivo'];
			$idpg_detped = $_POST['idpg_detped'];
										
			$rspta=$almacen_pt->rechazar_producto($idvale_salida,$motivo,$idpg_detped);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

		case 'borrar_registro':
			
			$idalmacen_pt_ed = $_POST['idalmacen_pt_ed'];

										
			$rspta=$almacen_pt->borrar_registro($idalmacen_pt_ed);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;
		
		case 'actualizar_ubicacion_prod':
			
			$idalmacen_pt = $_POST['idalmacen_pt'];
			$ubicacion = $_POST['ubicacion'];
										
			$rspta=$almacen_pt->actualizar_ubicacion_prod($idalmacen_pt,$ubicacion);
			echo json_encode($rspta);
	 		//echo $rspta ? "Anulada" : "No se puede anular";
		break;

	}



?>