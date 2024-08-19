<?php
require_once "../modelos/Alm_mat_prima.php";

$alm_mat_prima=new Alm_mat_prima();

switch ($_GET["op"])
	{
        case 'listar_productos_mat':

			$rspta = $alm_mat_prima->listar_productos_mat();
			while ($reg = $rspta->fetch_object())
					{
                        if ($reg->entradas==null) {
                            $entradas = 0;
                        }else{
                            $entradas = $reg->entradas;
                        }
                        if ($reg->salidas==null) {
                            $salidas = 0;
                        }else{
                            $salidas = $reg->salidas;
                        }
                        $existencias = $entradas-$salidas;
						echo ' 					
							<div class="form-group col-md-12 col-sm-12 estilo_prod_mat" >
                                <div class="form-group col-md-10 col-sm-10">
                                    <div class="form-group col-md-2 col-sm-2">
                                        ID: <br> <b>'.$reg->consec.'</b>  
                                    </div> 
                                    <div class="form-group col-md-8 col-sm-8" style="word-break:break-all; padding-right: 10px;">
                                        Nombre: <br> <b>'.$reg->nombre.'</b>  <br>
                                         
                                    </div>
                                    
                                    <div class="form-group col-md-2 col-sm-2">
                                        <div style="width: 100%;">
                                            Existencia:
                                        </div>
                                        <div style="width: 100%; margin-top: 5px;">
                                            <b style="padding: 5px 10px; background-color: #032780; color: #fff;">'.$existencias.'  '.$reg->unidad.'</b>
                                        </div>
                                           
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                        Tipo: <br> <b>'.$reg->tipo.'</b>  
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                        Ubicación: <br> <b>'.$reg->ubicacion.'</b>  
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                        Folio (Proveedor): <br> <b>'.$reg->folio_prov.'</b>  
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        Observaciones: <br> <b>'.$reg->observaciones.'</b>  
                                    </div>  
                                </div>

                                <div class="form-group col-md-2 col-sm-2" style="text-align: right;">
                                   <button type="button" class="btn btn-secondary" style="background-color: #ca150c;"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: #fff;" onclick="borrar_producto('.$reg->id_prod_alm_mat.');"></span></button>
                                   <button type="button" class="btn btn-primary" onclick="ver_producto('.$reg->id_prod_alm_mat.');">Ver</button>   
                                   <b style="display: none;" id="nombre_pmp'.$reg->id_prod_alm_mat.'">'.$reg->nombre.'</b> 
                                   <b style="display: none;" id="descripcion_pmp'.$reg->id_prod_alm_mat.'">'.$reg->descripcion.'</b>
                                   <b style="display: none;" id="cantidad_pmp'.$reg->id_prod_alm_mat.'">'.$reg->cantidad.'</b>
                                   <b style="display: none;" id="tipo_pmp'.$reg->id_prod_alm_mat.'">'.$reg->tipo.'</b>
                                   <b style="display: none;" id="idtipo_pmp'.$reg->id_prod_alm_mat.'">'.$reg->idtipo.'</b>
                                   <b style="display: none;" id="consec_pmp'.$reg->id_prod_alm_mat.'">'.$reg->consec.'</b>
                                   <b style="display: none;" id="observaciones_pmp'.$reg->id_prod_alm_mat.'">'.$reg->observaciones.'</b>
                                   <b style="display: none;" id="ubicacion_pmp'.$reg->id_prod_alm_mat.'">'.$reg->ubicacion.'</b>
                                   <b style="display: none;" id="folio_prov_pmp'.$reg->id_prod_alm_mat.'">'.$reg->folio_prov.'</b>
                                   <b style="display: none;" id="unidad_pmp'.$reg->id_prod_alm_mat.'">'.$reg->unidad.'</b>
                                </div>

                                
                            </div>
						';						
					}

						
			
		break;

        case 'coincidencias':

            $nombre = $_GET['nombre'];

			$rspta = $alm_mat_prima->coincidencias($nombre);
			while ($reg = $rspta->fetch_object())
					{
						echo '						
							<tr>
                                <td>'.$reg->nombre.'</td>
                                                                  
	                        </tr>
						';						
					}
		break;

        case 'listar_tipos_select':

			$rspta = $alm_mat_prima->listar_tipos();
			while ($reg = $rspta->fetch_object())
					{
						echo '						
							<option value="'.$reg->idtipo_alm_mat .'">'.$reg->nombre.'</option>
						';						
					}
		break;

        case 'guardar_producto':
		
			$nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $cantidad = $_POST['cantidad'];
            $tipo = $_POST['tipo'];
            $next_consec = $_POST['next_consec'];
            $ubicacion = $_POST['ubicacion'];
            $folio_prov = $_POST['folio_prov'];
            $observaciones = $_POST['observaciones'];
            $unidad = $_POST['unidad'];

	 		$rspta=$alm_mat_prima->guardar_producto($nombre,$descripcion,$cantidad,$tipo,$next_consec,$ubicacion,$folio_prov,$observaciones,$unidad);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";
		break;

        case 'update_producto':
		
			$nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $cantidad = $_POST['cantidad'];
            $tipo = $_POST['tipo'];
            // $next_consec = $_POST['next_consec'];
            $ubicacion = $_POST['ubicacion'];
            $folio_prov = $_POST['folio_prov'];
            $observaciones = $_POST['observaciones'];
            $id_prod_alm_mat = $_POST['id_prod_alm_mat'];

	 		$rspta=$alm_mat_prima->update_producto($nombre,$descripcion,$cantidad,$tipo,$ubicacion,$folio_prov,$observaciones,$id_prod_alm_mat);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";
		break;

        case 'listar_tipos':

			$rspta = $alm_mat_prima->listar_tipos();
			while ($reg = $rspta->fetch_object())
					{
						echo '						
							<tr>
                                <td>'.$reg->nombre.'</td>
                                <td>'.$reg->descripcion.'</td>	                                  
	                        </tr>
						';						
					}

						
			
		break;

        

        case 'guardar_tipo':
		
			$nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

	 		$rspta=$alm_mat_prima->guardar_tipo($nombre,$descripcion);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

        case 'max_consec':
		
	 		$rspta=$alm_mat_prima->max_consec();
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

		case 'buscar_prod_mat':

			$texto = $_GET['texto'];

			$rspta = $alm_mat_prima->buscar_prod_mat($texto);
			while ($reg = $rspta->fetch_object())
            {
                if ($reg->entradas==null) {
                    $entradas = 0;
                }else{
                    $entradas = $reg->entradas;
                }
                if ($reg->salidas==null) {
                    $salidas = 0;
                }else{
                    $salidas = $reg->salidas;
                }
                $existencias = $entradas-$salidas;
                echo ' 					
                    <div class="form-group col-md-12 col-sm-12 estilo_prod_mat" >
                        <div class="form-group col-md-10 col-sm-10">
                            <div class="form-group col-md-2 col-sm-2">
                                ID: <br> <b>'.$reg->consec.'</b>  
                            </div> 
                            <div class="form-group col-md-8 col-sm-8" style="word-break:break-all; padding-right: 10px;">
                                Nombre: <br> <b>'.$reg->nombre.'</b>  <br>
                                 
                            </div>
                            
                            <div class="form-group col-md-2 col-sm-2">
                                <div style="width: 100%;">
                                    Existencia:
                                </div>
                                <div style="width: 100%; margin-top: 5px;">
                                    <b style="padding: 5px 10px; background-color: #032780; color: #fff;">'.$existencias.'  '.$reg->unidad.'</b>
                                </div>
                                   
                            </div>
                            <div class="form-group col-md-4 col-sm-4">
                                Tipo: <br> <b>'.$reg->tipo.'</b>  
                            </div>
                            <div class="form-group col-md-4 col-sm-4">
                                Ubicación: <br> <b>'.$reg->ubicacion.'</b>  
                            </div>
                            <div class="form-group col-md-4 col-sm-4">
                                Folio (Proveedor): <br> <b>'.$reg->folio_prov.'</b>  
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                Observaciones: <br> <b>'.$reg->observaciones.'</b>  
                            </div>  
                        </div>

                        <div class="form-group col-md-2 col-sm-2" style="text-align: right;">
                           <button type="button" class="btn btn-secondary" style="background-color: #ca150c;"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="color: #fff;" onclick="borrar_producto('.$reg->id_prod_alm_mat.');"></span></button>
                           <button type="button" class="btn btn-primary" onclick="ver_producto('.$reg->id_prod_alm_mat.');">Ver</button>   
                           <b style="display: none;" id="nombre_pmp'.$reg->id_prod_alm_mat.'">'.$reg->nombre.'</b> 
                           <b style="display: none;" id="descripcion_pmp'.$reg->id_prod_alm_mat.'">'.$reg->descripcion.'</b>
                           <b style="display: none;" id="cantidad_pmp'.$reg->id_prod_alm_mat.'">'.$reg->cantidad.'</b>
                           <b style="display: none;" id="tipo_pmp'.$reg->id_prod_alm_mat.'">'.$reg->tipo.'</b>
                           <b style="display: none;" id="idtipo_pmp'.$reg->id_prod_alm_mat.'">'.$reg->idtipo.'</b>
                           <b style="display: none;" id="consec_pmp'.$reg->id_prod_alm_mat.'">'.$reg->consec.'</b>
                           <b style="display: none;" id="observaciones_pmp'.$reg->id_prod_alm_mat.'">'.$reg->observaciones.'</b>
                           <b style="display: none;" id="ubicacion_pmp'.$reg->id_prod_alm_mat.'">'.$reg->ubicacion.'</b>
                           <b style="display: none;" id="folio_prov_pmp'.$reg->id_prod_alm_mat.'">'.$reg->folio_prov.'</b>
                           <b style="display: none;" id="unidad_pmp'.$reg->id_prod_alm_mat.'">'.$reg->unidad.'</b>
                        </div>

                        
                    </div>
                ';						
            }

						
			
		break;

        case 'guardar_entrada':
		
			$id_select_prod = $_POST['id_select_prod'];
            $cantidad_entrada = $_POST['cantidad_entrada'];
            $proveedor_entrada = $_POST['proveedor_entrada'];
            $lote_entrada = $_POST['lote_entrada'];
            $fecha_hora = $_POST['fecha_hora'];
            $observacion = $_POST['observacion'];

	 		$rspta=$alm_mat_prima->guardar_entrada($id_select_prod,$cantidad_entrada,$proveedor_entrada,$lote_entrada,$fecha_hora,$observacion);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

        case 'guardar_salida':
		
			$id_select_prod = $_POST['id_select_prod'];
            $cantidad_salida = $_POST['cantidad_salida'];
            $proveedor_salida = $_POST['proveedor_salida'];
            $lote_salida = $_POST['lote_salida'];
            $no_control_salida = $_POST['no_control_salida'];
            $op_salida = $_POST['op_salida'];
            $fecha_hora = $_POST['fecha_hora'];
            $observacion = $_POST['observacion'];

	 		$rspta=$alm_mat_prima->guardar_salida($id_select_prod,$cantidad_salida,$proveedor_salida,$lote_salida,$no_control_salida,$op_salida,$fecha_hora,$observacion);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

        case 'listar_movimientos_entradas_gen':

            // $idprod = $_GET['idprod'];

			$rspta = $alm_mat_prima->listar_movimientos_entradas_gen();
			while ($reg = $rspta->fetch_object())
					{
						echo '						
							<tr>
                                <td>'.$reg->identrada.'</td>
                                <td>ENTRADA</td>
                                <td>'.$reg->nombre.'</td>	
                                <td>'.$reg->cantidad.'</td> 
                                <td>'.$reg->proveedor.'</td>
                                <td>'.$reg->lote.'</td>
                                <td>'.$reg->fecha.'</td>
                                <td>'.$reg->observacion.'</td>                               
	                        </tr>
						';						
					}

		break;

        case 'listar_movimientos_entradas':

            $idprod = $_GET['idprod'];

			$rspta = $alm_mat_prima->listar_movimientos_entradas($idprod);
			while ($reg = $rspta->fetch_object())
					{
						echo '						
							<tr>
                                <td>'.$reg->identrada.'</td>
                                <td>ENTRADA</td>
                                <td>'.$reg->nombre.'</td>	
                                <td>'.$reg->cantidad.'</td> 
                                <td>'.$reg->proveedor.'</td>
                                <td>'.$reg->lote.'</td>
                                <td>'.$reg->fecha.'</td>
                                <td>'.$reg->observacion.'</td>                               
	                        </tr>
						';						
					}

		break;

        case 'listar_movimientos_entradas_prod':

            $idprod = $_GET['idprod'];

			$rspta = $alm_mat_prima->listar_movimientos_entradas_prod($idprod);
			while ($reg = $rspta->fetch_object())
					{
						echo '						
							<tr>
                                <td>'.$reg->identrada.'</td>
                                <td>ENTRADA</td>
                                <td>'.$reg->nombre.'</td>	
                                <td>'.$reg->cantidad.'</td> 
                                <td>'.$reg->proveedor.'</td>
                                <td>'.$reg->lote.'</td>
                                <td>'.$reg->fecha.'</td>
                                <td>'.$reg->observacion.'</td>                               
	                        </tr>
						';						
					}

		break;

        case 'listar_movimientos_salidas_gen':

            // $idprod = $_GET['idprod'];

			$rspta = $alm_mat_prima->listar_movimientos_salidas_gen();
			while ($reg = $rspta->fetch_object())
					{
						echo '						
							<tr>
                                <td>'.$reg->idsalida.'</td>
                                <td>SALIDA</td>
                                <td>'.$reg->nombre.'</td>	
                                <td>'.$reg->cantidad.'</td> 
                                <td>'.$reg->proveedor.'</td>
                                <td>'.$reg->lote.'</td>
                                <td>'.$reg->no_control.'</td> 
                                <td>'.$reg->op.'</td> 
                                <td>'.$reg->fecha.'</td>
                                <td>'.$reg->observacion.'</td>                            
	                        </tr>
						';						
					}

		break;

        case 'listar_movimientos_salidas':

            $idprod = $_GET['idprod'];

			$rspta = $alm_mat_prima->listar_movimientos_salidas($idprod);
			while ($reg = $rspta->fetch_object())
					{
						echo '						
							<tr>
                                <td>'.$reg->idsalida.'</td>
                                <td>SALIDA</td>
                                <td>'.$reg->nombre.'</td>	
                                <td>'.$reg->cantidad.'</td> 
                                <td>'.$reg->proveedor.'</td>
                                <td>'.$reg->lote.'</td>
                                <td>'.$reg->no_control.'</td> 
                                <td>'.$reg->op.'</td>  
                                <td>'.$reg->fecha.'</td>
                                <td>'.$reg->observacion.'</td>                           
	                        </tr>
						';						
					}

		break;

        case 'listar_movimientos_salidas_prod':

            $idprod = $_GET['idprod'];

			$rspta = $alm_mat_prima->listar_movimientos_salidas_prod($idprod);
			while ($reg = $rspta->fetch_object())
					{
						echo '						
							<tr>
                                <td>'.$reg->idsalida.'</td>
                                <td>SALIDA</td>
                                <td>'.$reg->nombre.'</td>	
                                <td>'.$reg->cantidad.'</td> 
                                <td>'.$reg->proveedor.'</td>
                                <td>'.$reg->lote.'</td>
                                <td>'.$reg->no_control.'</td> 
                                <td>'.$reg->op.'</td>  
                                <td>'.$reg->fecha.'</td>
                                <td>'.$reg->observacion.'</td>                            
	                        </tr>
						';						
					}

		break;

        case 'contar_existencia':
		
			$id_prod_alm_mat = $_POST['id_prod_alm_mat'];

	 		$rspta=$alm_mat_prima->contar_existencia($id_prod_alm_mat);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

        case 'borrar_producto':
		
			$id_prod_alm_mat = $_POST['id_prod_alm_mat'];

	 		$rspta=$alm_mat_prima->borrar_producto($id_prod_alm_mat);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;

        case 'update_lote_int':
		
			$idnew = $_POST['idnew'];
            $newlote = $_POST['newlote'];

	 		$rspta=$alm_mat_prima->update_lote_int($idnew,$newlote);
			echo json_encode($rspta);
			//echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos de ingreso";


		break;
	}


?>