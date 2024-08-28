<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.php");
}
else
{
require 'header.php';
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1 || $_SESSION['consulta1']==1)
{
?>


                            <style>

                              input[type=number]::-webkit-outer-spin-button,

                              input[type=number]::-webkit-inner-spin-button {

                                  -webkit-appearance: none;

                                  margin: 0;

                              }

                               

                              input[type=number] {

                                  -moz-appearance:textfield;

                              }

                            </style>

        <!-- page content -->
        <div class="right_col" role="main" id="">

          <div class="">

            <div class="clearfix"></div>

              <div class="row" id="area_inicial">
                <div class="col-md-12 col-sm-12">
                  <div class="x_panel">
                    <div class="x_title">
                        <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
                          <h6>EMBARQUES</h6>
                        </div>
                        <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10" align="right">
                          
                          <a href="#" onclick="regresar_a_lista();"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar</a>
                        </div>
                          
                          
                          
                      <div class="clearfix"></div>
                      <div class="x_content">


                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr width="100%">
                          </div>
                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_lista_salidas">
                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2" id="" align="">
                              
                              


                              <button  type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Nuevo Embarque" onclick="nueva_salida();"><span class="glyphicon glyphicon-plus" aria-hidden="true" style="color: #fff;"></span></button>
                                
                            </div>
                            <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10" id="" align="right">

                                 <input type="date" id="fecha_1_buscar" style="border-style: none; border-bottom: groove;" onchange="limpiar_campos_busqueda1();"> -
                                 <input type="date" id="fecha_2_buscar" style="border-style: none; border-bottom: groove;">
                                 <input type="number" id="no_salida_buscar" placeholder="No. Salida" style="border-style: none; border-bottom: groove;" onkeyup="limpiar_campos_busqueda2();">
                                 <input type="number" id="no_control_buscar" placeholder="No. Control" style="border-style: none; border-bottom: groove;" onkeyup="limpiar_campos_busqueda3();">
                                 <input type="hidden" id="marcador_busqueda">
                        
                                <button  type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Buscar" onclick="buscar_control_salida();" style="margin-left: 20px;"><span class="glyphicon glyphicon-search" aria-hidden="true" style="color: white;"></span></button> 
                                <button  type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Limpiar" onclick="init();" style="margin-left: -5px;"><i class="fa fa-refresh"></i></button>
                            </div>
                            
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <hr>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                              <button style="font-size: 10px;" class="btn btn-primary" id="btn_anterior_salida" onclick="back_pagina_salida();">Anterior</button>
                              <button style="font-size: 10px;" class="btn btn-secondary" id="num_pag_salida">1</button>
                              <button style="font-size: 10px;" class="btn btn-primary" id="btn_siguiente_salida" onclick="next_pagina_salida();">Siguiente</button>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 500px;">

                              <table id="tbl_salidas" class="table table-hover" style="width: 100%;">
                                                  
                              </table>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                              <button style="font-size: 10px;" class="btn btn-primary" id="btn_anterior_salida2" onclick="back_pagina_salida();">Anterior</button>
                              <button style="font-size: 10px;" class="btn btn-secondary" id="num_pag_salida2">1</button>
                              <button style="font-size: 10px;" class="btn btn-primary" id="btn_siguiente_salida2" onclick="next_pagina_salida();">Siguiente</button>
                            </div>
                              
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_nueva_entrega_window">

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              
                              <!--<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right" id="text_nueva_salida">
                                
                                <a href="#" onclick="nueva_salida();">Nueva salida</a>
                              </div>-->
                              
                                
                              <div class="form-group col-md-12 col-sm-12" align="" style="">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background: #E1E2E3; padding-top: 20px;">
                                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xs-3" align="center">
                                      EMBARQUE:<br> <b id="no_salida_text" style="font-size: 20px;"></b>
                                    </div>
                                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xs-3" align="center">
                                      FECHA DE SALIDA: <br> <b id="fecha_hora_salida_text"></b>
                                      <input type="text" name="" id="fecha_hora_salida_input" onchange="upd_fecha_salida();">
                                    </div>
                                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xs-3" align="center">
                                      CHOFER: <br> <b id="chofer_salida_text"></b>
                                    </div>
                                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xs-3" align="center">
                                      VEHICULO: <br> <b id="vehiculo_salida_text"></b>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-3 col-xs-3" align="right">
                                      <button id="" type="button" class="btn btn-dark" onclick="nueva_entrega();">Agregar salida</button> 
                                    </div>
                                  </div>
                                    
                                </div>
                                  
                               
                              </div>
                              <div class="form-group col-md-12 col-sm-12" align="">
                               
                                
                                <div class="form-group col-md-3 col-sm-3" id="">
                                  
                                  <div class="form-group col-md-12 col-sm-12" id="">
                                    <label><b>SALIDAS</b></label>
                                  </div>
                                  <div class="form-group col-md-12 col-sm-12" id="tbl_entregas_list">
                                  </div>
                                </div>
                                
                                  <div class="form-group col-lg-9 col-md-9 col-sm-9 col-xs-9" id="productos_entrega">
                                    
                                    <div class="form-group col-md-12 col-sm-12">
                                      <label><b>DETALLE</b></label>
                                    </div>
                                    <!--<div class="form-group col-md-6 col-sm-6" align="right" style="margin-top: 30px;">
                                      <button id="btn_agregar_productos" type="button" class="btn btn-dark" onclick="agregar_productos();">Agregar productos</button>
                                      
                                    </div>-->
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="hidden" class="form-control" id="identrega">
                                      <input type="hidden" class="form-control" id="idpedido_det_ent">
                                        <b id="numero_entrega"></b><br>
                                        <b id="cliente_ent"></b><br>
                                        <b id="contacto_ent2"></b><br>
                                        <b id="direccion_ent2"></b>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      <button type="button" class="btn btn-dark" id="" onclick="borrar_entrega2();"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true" style="color: white;"></span></button>

                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      <label>Observaciones de salida</label>
                                      <textarea class="form-control" name="observ_salida" id="observ_salida" rows="2" onkeyup="update_observ_salida();"></textarea>
                                     
                                      
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      <button id="" type="button" class="btn btn-success" onclick="div_reg_exced_salida();">Agregar productos</button>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_excedente_salida">
                                      
                                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Tipo de ingreso</label>
                                        <select  id="select_tipo_ingreso" class="form-control selectpicker" onchange="mostrar_div_tipoingreso();">
                                            <option value="">Seleccionar</option>
                                            <option value="1">Excedentes</option>
                                            <option value="2">Piezas</option>
                                            <option value="3">Productos del pedido</option>                                           
                                        </select>
                                        <input type="hidden" class="form-control" id="prod_ped_tipo">
                                      </div>
                                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_prod_ped">
                                        <label>Seleccionar</label>
                                        <select  class="form-control" id="prod_exced_salida_control" onchange="selec_prod_exced_salida();">                                                 
                                                                                              
                                        </select>
                                      </div>
                                       
                                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #eee; padding: 10px;" id="div_piezas_salida">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          <label>Buscar piezas del producto</label>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          
                                          <input type="text" class="form-control" id="buscar_prod_exced_salida" style="float: left; width: 20%;" placeholder="Codigo">
                                          <button id="buscar_prod_exced_salida_desp" type="button" class="btn btn-success" onclick="buscar_producto_exced_salida();" style="float: left;">Buscar</button>
                                          <input type="text" class="form-control" id="nombre_exced_salida_control" style="float: left; width: 60%;">
                                          <input type="hidden" class="form-control" id="idproducto_exced_salida_control">

                                          
                                        </div>
                                          
                                      </div>
                                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_observ_cant">
                                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                          <label>Observaciones</label><b style="color: red;"> (*Campo obligatorio)</b>
                                          
                                          <textarea class="form-control" id="observ_exced_salida_control"></textarea>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                          <label>Cantidad</label><b style="color: red;"> (*Campo obligatorio)</b>
                                          <input type="number" class="form-control" id="cant_exced_salida_control">
                                        </div>
                                      </div>
                                        
                                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 22px;" id="btn_agregar_prod">
                                        <button id="" type="button" class="btn btn-success" onclick="agregar_prod_salida();">Agregar</button>
                                      </div>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:0px solid #F7F4F4; overflow:scroll;height:250px;">
                                      <table id="box_productos5" class="table table-hover" style="width:1000px;">
                                                      
                                      </table>
                                      <table id="box_productos5_desp" class="table table-hover">
                                                      
                                      </table>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_impr_salida">
                                            <a class="dropdown-item" href=""  id="enlace_vale" onclick="abrir_vale();" target="_blank">
                                            
                                              <button type="button" class="btn btn-dark" id="btn_salida_mercancia">Imprimir salida</button>
                                            </a>
                                    </div>

                                  </div>
                               
                                
                                  
                                  
                              </div>
                              <div class="form-group col-md-12 col-sm-12" align="">
                                  <hr width="100%">
                              </div>
                            </div>
                            
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="">
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               
                                <input type="hidden" class="form-control" id="idsalida">
                              </div>
                              <!--<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right" id="div_eti_entrega">
                                
                                <a href="#" onclick="nueva_entrega();">Nueva entrega</a>
                              </div>-->
                              
                              
                             <!-- <div class="form-group col-md-9 col-sm-9" align="">
                                  
                                  <select  id="select_entrega" class="form-control selectpicker" onchange="">
                                                                                 
                                  </select>
                                  
                              </div>
                              <div class="form-group col-md-3 col-sm-3" align="">
                                <button id="div_eti_entrega" type="button" class="btn btn-dark" onclick="">Nueva entrega</button>
                              </div>-->
                             
                            </div>
                            

                            
                           

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="btn_opciones_vales" style="margin-bottom: 30px;" align="right">
                                    


                                    <!--<div class="btn-group">
                                      <a href="" id="enlace_vale" onclick="abrir_vale();" target="_blank">
                                        <button type="button" class="btn btn-primary" id="btn_salida_mercancia">Salida de mercancia</button>
                                        
                                      </a>
                                    </div>-->

                                   <!-- <div class="btn-group" role="group">
                                      <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="valid_entrega();">
                                        Salida de mercancia
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        
                                        <a class="dropdown-item" href="#">
                                          <button type="button" class="btn" id="" onclick="abrir_modal_salida();">Total de productos</button>
                                        </a>
                                        
                                      </div>
                                    </div>-->

                            </div>
                              
                           
                          </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

          </div>

        </div>
        <!-- /page content -->


        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_nueva_salida">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Nueva Salida</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_nueva_salida">
                              
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Fecha de salida:</label>
                                <input type="date" class="form-control" id="fecha_salida_new_s">
                                <input type="hidden" class="form-control" id="idsalida_upd">
                              </div>
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Hora de salida:</label>
                                <input type="time" class="form-control" id="hora_salida_new_s">
                              </div>
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Chofer:</label><label style="color: white;">__</label><a href="#" onclick="abrir_nuevo_chofer();">Nuevo chofer</a>
                                <select  id="select_chofer" class="form-control selectpicker">
                                                                               
                                </select>
                                
                              </div>
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Vehículo:</label><label style="color: white;">__</label><a href="#" onclick="abrir_nuevo_vehiculo();">Nuevo vehiculo</a>
                                <select  id="select_vehiculo" class="form-control selectpicker">
                                                                               
                                </select>
                                
                              </div>
                              
                             
                              
                            </div>
                          

                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-primary" onclick="guardar_salida();" id="btn_save_embarque">Guardar</button>
                          <button type="button" class="btn btn-primary" onclick="upd_salida();" id="btn_upd_embarque">Actualizar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>

                      </div>
                    </div>
        </div>

       
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_select_entrega">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Agregar salida</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #F7F4F4; overflow:scroll;height:400px; max-width: 100vw">
                          
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_nueva_entrega">

                                
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <div class="btn-group">
                                    <input type="number" class="form-control" id="no_control_add" placeholder="Control">
                                    <button type="button" class="btn btn-dark" id="btn_buscar_control" onclick="buscar_control_add();"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>                                 
                                </div>
                              </div>
                              <div class="form-group col-md-6 col-sm-6" align="">
                                <label>Cliente:</label>
                                <input type="text" class="form-control" id="cliente_new_e">
                              </div>
                              <div class="form-group col-md-6 col-sm-6" align="">
                                <label>Contacto:</label>
                                <input type="text" class="form-control" id="contacto_new_e">
                              </div>
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Dirección de entrega:</label>
                                <textarea class="form-control" id="dir_entrega_new_e" cols="40" rows="2" onkeyup=""></textarea>
                              </div>
                              <div class="form-group col-md-4 col-sm-4" align="">
                                <label>Teléfono:</label>
                                <input type="text" class="form-control" id="telefono_new_e">
                              </div>
                              <div class="form-group col-md-4 col-sm-4" align="">
                                <label>Horario:</label>
                                <input type="text" class="form-control" id="horario_new_e">
                              </div>

                              <div class="form-group col-md-4 col-sm-4" align="">
                                <label>Condiciones:</label>
                                <input type="text" class="form-control" id="condic_new_e">
                              </div>
                              <div class="form-group col-md-6 col-sm-6" align="">
                                <label>Medio de transporte:</label>
                                <input type="text" class="form-control" id="medio_new_e">
                              </div>
                              <div class="form-group col-md-6 col-sm-6" align="">
                                <label>Tipo de registro:</label>
                                <select  id="is_exced" class="form-control selectpicker">
                                      <option value="1">Pedido</option>
                                      <option value="2">Excedente</option>                                          
                                </select>
                              </div>
                              <div class="form-group col-md-12 col-sm-12">
                                <label>PRODUCTOS</label><br>
                                <b>DISPONIBLE: </b>La suma de los productos apartados y fabricados. <br>
                                <b>PEND. DISP.: </b>Cantidad de productos que se pueden enviar a la salida.
                                <hr width="100%">
                              </div>
                              <div class="form-group col-md-12 col-sm-12" align="" style="border:0px solid #F7F4F4; overflow:scroll;height:300px; max-width: 100vw">
                                <table  class="table table-hover" style="width: 100%;">

                                </table>
                                 <table id="prueba_tbl" class="table table-hover" style="width: 100%;">

                                </table>

                                <div class="form-group col-md-12 col-sm-12" align="" id="box_prod_pasar_add">
                                </div>
                              </div>
                               
                            </div>
                          
                            

                        </div>
                        <div class="modal-footer">
                          <div>
                               
                              <!-- <div id="loader">
                                 <img src="images/ajax-loader.gif">
                               </div>-->
                              



                          </div>
                          <button type="button" class="btn btn-primary" onclick="guardar_entrega();" id="btn_guardar_entrega">Guardar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
        </div>

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_add_producto">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Agregar productos</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="prod_pedido">
                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>BUSCAR CONTROL</label>
                                    <input type="hidden" class="form-control" id="idpedido_salida">
                                  </div>

                                  <div class="form-group col-md-12 col-sm-12" align="">
                                    <div class="btn-group">

                                      <input type="number" class="form-control" id="no_control" placeholder="Buscar control">
                                      <button type="button" class="btn btn-dark" id="btn_buscar_control" onclick="buscar_control();"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                      
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12" align="">
                                      <hr width="100%">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12" align="" style="border:0px solid #F7F4F4; overflow:scroll;height:250px; max-width: 100vw">
                                      <table id="box_prod_pasar2" class="table table-hover" style="width: 100%;">

                                      </table>

                                      <div class="form-group col-md-12 col-sm-12" id="box_prod_pasar">
                                        
                                      </div>


                                    </div>
                                   
                                      
                                  </div>
                                 
                                </div>
                              
                               
                            </div>

                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-primary" onclick="pasar_productos();">Guardar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
        </div>

        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_nuevo_chofer">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Registrar chofer</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_nueva_entrega">
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Nombre completo:</label>
                                <input type="text" class="form-control" id="nom_chofer">
                              </div>
                              
                            
                               
                            </div>

                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-primary" onclick="guardar_chofer();">Guardar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
        </div>

        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_nuevo_vehiculo">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Registrar vehiculo</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_nueva_entrega">
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Nombre del vehiculo:</label>
                                <input type="text" class="form-control" id="nom_vehiculo">
                              </div>
                              
                            
                               
                            </div>

                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-primary" onclick="guardar_vehiculo();">Guardar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
        </div>

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_salida">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Datos del cliente</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Cliente:</label>
                                <input type="text" class="form-control" id="nom_cliente_salida">
                              </div>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Domicilio:</label>
                                <input type="text" class="form-control" id="domicilio_cliente_salida">
                              </div>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Contacto:</label>
                                <input type="text" class="form-control" id="contacto_cliente_salida">
                              </div>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                              <div class="form-group col-md-4 col-sm-4" align="">
                                <label>Telefono:</label>
                                <input type="text" class="form-control" id="telefono_cliente_salida">
                              </div>
                              <div class="form-group col-md-4 col-sm-4" align="">
                                <label>Hora 1:</label>
                                <input type="time" class="form-control" id="horario_cliente_salida1">
                              </div>
                              <div class="form-group col-md-4 col-sm-4" align="">
                                <label>Hora 2:</label>
                                <input type="time" class="form-control" id="horario_cliente_salida2">
                              </div>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                              <div class="form-group col-md-6 col-sm-6" align="">
                                <label>Condiciones:</label>
                                <input type="text" class="form-control" id="condiciones_cliente_salida">
                              </div>
                              <div class="form-group col-md-6 col-sm-6" align="">
                                <label>Medio de transporte:</label>
                                <input type="text" class="form-control" id="medio_cliente_salida">
                              </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                          <a class="dropdown-item" href=""  id="enlace_salida_tot" onclick="generar_salida_total();" target="_blank">
                                        
                                        
                              <button type="button" class="btn btn-primary">Ver salida</button>
                          </a>
                      
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
        </div>

        <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="modal_lista_lotes">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Lotes disponibles</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <table id="tbl_lotes_disp" class="table table-hover" style="width: 100%;">

                                </table>
                                <input type="hidden" id="identrega_detalle">
                              </div>
                              
                            
                               
                            </div>

                        </div>
                        <div class="modal-footer">
                          
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
        </div>
            

      </div>
    </div> 

   
                  

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>


    <!-- Custom Theme Scripts -->
    <script type="text/javascript" src="scripts/entregas_prod.js?v=<?php echo(rand()); ?>"></script>
    <script src="build/js/custom.min.js"></script>
    <script src="public/js/bootbox.min.js"></script> 

    <script src="vendors/jquery-knob/dist/jquery.knob.min.js"></script>
    

  </body>
</html>

<?php
}
else
{
  require 'noacceso.php';
}

?>

<?php 
}
ob_end_flush();
?>