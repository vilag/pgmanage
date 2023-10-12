<?php
require_once "../modelos/Diseno.php";

$diseno=new Diseno();

switch ($_GET["op"])
	{

		case 'listar_entregas_new':

			$id=$_GET['id'];

			$rspta = $diseno->listar_entregas_new($id);
			while ($reg = $rspta->fetch_object())
					{

						



						echo '

													<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                                      <div class="panel">
                                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$reg->identrega.'" aria-expanded="true" aria-controls="collapseOne" onclick="listar_pedido_detalle_term('.$reg->identrega.');">
                                                          
                                                        	

                                                        	<table id="datatable_buttons" class="table table-hover">
							                                  <tr>
							                                    <td width="15%">
								                                    <p>'.$reg->identrega.' - '.$reg->contacto.' - '.$reg->direccion.'</p>
								                                    
							                                    </td>

							                                  </tr>
							                                  
							                                </table> 

                                                        </a>
                                                        <div id="collapseOne'.$reg->identrega.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

                                                        			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">
                                                        				

																	    <a href="#" onclick="abrir_docs('.$reg->identrega.');">
															               <button type="button" class="btn btn-dark">Entregado</button>
																	    </a>

																	    
                                                        			</div>

                                                          <div class="panel-body" style="border-bottom: solid;">

                                                          	<table class="table table-bordered" id="tbl_pedido_detalle_term'.$reg->identrega.'">
                                                              
                                                            </table>
                                                          	
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>

						';
						

						

				

						
					}

						
		break;

	}


?>