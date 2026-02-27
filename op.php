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
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1 || $_SESSION['consulta1']==1 || $_SESSION['Produccion']==1)
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
        <div class="right_col" role="main" id="page_pedido">
          
          <div class="">
            
            <div class="clearfix"></div>

          
            <div class="row" id="select_product_area">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
               

                  <div class="x_content">

                    
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                      <h5>Ordenes de producción</h5>

                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                                    <button type="button" class="btn btn-primary"  onclick="mostrar_op_list();" id="">Registro de avances</button>
                                                    
                                                    <button type="button" class="btn btn-primary" id="" onclick="mostrar_reportes();">Reportes</button>
                                                    <!-- <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Productos pendientes de fabricación" onclick="" id="">Pendientes</button> -->
                                                    
                                                  </div>
                                                  <!-- <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2" align="right">
                                                    <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Errores en OP" onclick="" id=""><h5 id="num_anom"></h5></button>
                                                  </div> -->
                    </div>


                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_op">
                                                  
                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">

                                                        <div class="btn-group">
                                                          <input type="number" class="form-control" id="no_op_buscar" placeholder="Buscar OP">
                                                          
                                                          
                                                        </div>
                                                        <div class="btn-group">
                                                          <input type="date" class="form-control" id="fecha_buscar">
                                                          <button type="button" class="btn btn-dark" id="btn_buscar_op" onclick="mostrar_op();"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                                          <button type="button" class="btn btn-dark" id="btn_todos" onclick="listar_ops();"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
                                                          
                                                        </div>
                                                        <div class="btn-group">
                                                          <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            Ver OP:
                                                          </button>
                                                          <div class="dropdown-menu">
                                                            
                                                            <a class="dropdown-item" href="#" onclick="listar_ops2();">General</a>
                                                            <a class="dropdown-item" href="#" onclick="listar_ops_area();">Por área</a>
                                                          
                                                          </div>
                                                        </div> 
                                                                                    

                                                  </div>

                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <hr width="100%">
                                                  </div>
                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="box_detalle_op">
                                                   
                                                  </div>
                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                                                   
                                                    <div id="box_ops_det">
                                                      
                                                    </div>
                                                    
                                                  </div>
                    </div>

                                                
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_reportes">
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button style="background-color: #04a57c; color: #fff;" type="button" class="btn btn-secundary" data-toggle="tooltip" data-placement="top" title="Reportes de productos" onclick="mostrar_prod_detalle();" id="">Productos</button>
                        <button style="background-color: #04a57c; color: #fff;" type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Reportes de OP's" onclick="mostrar_reportes_op();" id="">Ordenes de producción</button>
                      </div>
                                                
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_reportes_op">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin: 20px 0px;">
                            <h6>Generar reportes de produccion por OP's.</h6>
                        </div>
                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: right;">
                                                    <div class="btn-group">
                                                      
                                                      <select  class="form-control" id="select_area_op" style="margin-right: 10px;">

                                                        <option value="select">Seleccionar área</option>
                                                        <option value="1">Herreria</option>
                                                        <option value="2">Pintura</option>
                                                        <option value="3">Plásticos</option>
                                                        <option value="8">Horno</option>
                                                        <option value="5">Ensamble Porcelanizado</option>
                                                        <option value="6">Ensamble Comercial</option>
                                                        <option value="7">Ensamble Muebles</option>
                                                                                  
                                                      </select>
                                                      <select  class="form-control" id="select_area_estatus" style="margin-right: 10px;">

                                                        <option value="select">Seleccionar estatus</option>
                                                        <option value="1">Terminados</option>
                                                        <option value="2">En proceso</option>
                                                        
                                                                                  
                                                      </select>
                                                      <input id="fecha_ini_rep_op" type="date" class="form-control" placeholder="Desde">
                                                      <input id="fecha_fin_rep_op" type="date" class="form-control" placeholder="Hasta">
                                                      <button style="margin-right: 10px;" type="button" class="btn btn-dark" onclick="listar_op_estatus()">Buscar</button>
                                                      <button id="exportar_rep_xlsx" type="button" class="btn btn-dark">Exportar</button>
                                                      <!-- <button type="button" class="btn btn-dark" onclick="exportTableToExcel('tbl_op_estatus')">Exportar</button> -->
                                                          <!-- <button type="button" class="btn btn-dark" id="btnExportarRep_op" onclick="exportTableToExcel();">Excel</button> -->
                                                          
                                                          
                                                    </div>
                                                    
                                                   
                                                    
                                                  </div>
                                                  
                                                  <table class="table table-bordered" id="tbl_op_estatus" style="width: 100%;">
                                                  </table>
                      </div>  
                                                  
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_panel_prod" >
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 20px 0px;">
                            <h6>Generar reportes de produccion por Productos.</h6>
                        </div>
                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                          <label>Área</label>
                                                          <select  class="form-control" id="select_area_prod">

                                                            <option value="select">SELECCIONAR</option>
                                                            <option value="1">Herreria</option>
                                                            <option value="2">Pintura</option>
                                                            <option value="3">Plásticos</option>
                                                            <option value="8">Horno</option>
                                                            <option value="5">Ensamble Porcelanizado</option>
                                                            <option value="6">Ensamble Comercial</option>
                                                            <option value="7">Ensamble Muebles</option>
                                                                                      
                                                          </select>
                                                      </div>
                                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                        <label for="">Estatus de producto</label>
                                                        <select  class="form-control" id="select_estatus">

                                                            <option value="">SELECCIONAR</option>
                                                            <option value="1">Terminados</option>
                                                            <option value="0">En proceso</option>

                                                        </select>
                                                      </div>
                                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                        <label for="">Estatus de pedido</label>
                                                        <select  class="form-control" id="select_estatus_pedido" disabled>

                                                            <option value="0">Sin entregar</option>
                                                            <option value="1">Entregados</option>
                                                            

                                                        </select>
                                                      </div> 
                                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3" style="padding-top: 27px;">
                                                        <button class="btn btn-primary" onclick="listar_productos_produccion();">Buscar</button>
                                                      </div> 
                                                    </div>
                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                                                      <label>Tabla de avances</label>
                                                    </div>

                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                                                      <!-- <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;" id="btn_paginados">
                                                        <button style="font-size: 10px;" class="btn btn-primary" id="btn_anterior_salida" onclick="back_pagina_salida();">Anterior</button>
                                                        <button style="font-size: 10px;" class="btn btn-secondary" id="num_pag_salida">1</button>
                                                        <button style="font-size: 10px;" class="btn btn-primary" id="btn_siguiente_salida" onclick="next_pagina_salida();">Siguiente</button>
                                                      </div> -->
                                                        <table class="table table-bordered" id="tbl_productos_prod" style="width: 100%;">
                                                        </table>
                                                      <!-- <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;" id="btn_paginados2">
                                                        <button style="font-size: 10px;" class="btn btn-primary" id="btn_anterior_salida2" onclick="back_pagina_salida();">Anterior</button>
                                                        <button style="font-size: 10px;" class="btn btn-secondary" id="num_pag_salida2">1</button>
                                                        <button style="font-size: 10px;" class="btn btn-primary" id="btn_siguiente_salida2" onclick="next_pagina_salida();">Siguiente</button>
                                                      </div> -->
                                                    </div>

                                                        

                                                        

                                                    </div>
                      </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_prod">

                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">

                                                        <!--<div class="btn-group">
                                                          <input type="number" class="form-control" id="no_op_buscar" placeholder="Buscar producto">
                                                          <button type="button" class="btn btn-dark" id="btn_buscar_prod" onclick=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                                          
                                                        </div>-->

                                                        <div class="btn-group">
                                                          
                                                          <button type="button" class="btn btn-dark" id="" onclick="listar_productos_op_herreria();">Herrería</button>
                                                          <button type="button" class="btn btn-dark" id="" onclick="listar_productos_op_pintura();">Pintura</button>
                                                          <button type="button" class="btn btn-dark" id="" onclick="listar_productos_op_plasticos();">Plásticos</button>
                                                          <button type="button" class="btn btn-dark" id="" onclick="listar_productos_op_horno();">Horno</button>
                                                          <button type="button" class="btn btn-dark" id="" onclick="listar_productos_op_ensamble_p();">Ensamble P.</button>
                                                          <button type="button" class="btn btn-dark" id="" onclick="listar_productos_op_ensamble_c();">Ensamble C.</button>
                                                          <button type="button" class="btn btn-dark" id="" onclick="listar_productos_op_ensamble_m();">Ensamble M.</button>
                                                          
                                                          
                                                        </div>
                                                        

                                                  </div>
                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="" style="border:0px solid #e5e5e5; overflow:scroll;height:600px;">
                                                    <table class="table table-bordered" id="tbl_productos_op" style="width: 100%;">
                                                    </table>
                                                    <input type="number" class="form-control" value="0" id="input_fil_area">
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




    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_create_op">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <h5>ASIGNAR ORDEN DE PRODUCCIÓN</h5>
                                                
                                              </div>
                                              
                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                              </div>

                          
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">

                                <div class="col-md-12 col-sm-12 ">
                                        <div class="x_panel">
                                        
                                        <div class="x_content">
                                          <div class="row">
                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                              <button type="button" class="btn btn-primary" onclick="cancelar_op();" id="btn_cancelar">Cancelar</button>
                                              <button type="button" class="btn btn-primary" onclick="activar_op();" id="btn_activar">Activar</button>
                                              <button type="button" class="btn btn-primary" id="btn_addProd_op1" style="display: none;" onclick="addProdOp();">Agregar producto</button>
                                              </div>
                                                
                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  <label>No. OP:</label>
                                                  <input type="text" class="form-control" id="op" value="" disabled="">
                                                 
                                                  

                                                </div>
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  <label>Prioridad:</label>
                                                  <input type="text" class="form-control" id="prioridad" onkeyup="update_op();">
                                                  <input type="hidden" class="form-control" id="idop" value="" disabled>          
                                                </div>

                                              </div>
                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                  <label>Observaciones:</label>
                                                  
                                                  <textarea class="form-control" id="observ" cols="40" rows="4" onkeyup="update_op();"></textarea>           
                                              </div>
                                             
                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <hr width="100%">
                                              </div>

                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 300px;">

                                                   

                                                        <table id="tbl_op" class="table table-hover">
                                      
                                                        </table>


                                              </div>

                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>_</label>
                                              </div>


                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  <label>Fecha de inicio:</label>
                                                  <input type="date" class="form-control" id="fecha1" onchange="update_op();">
                                                           
                                                </div>
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  <label>Fecha de termino:</label>
                                                  <input type="date" class="form-control" id="fecha2" onchange="update_op();">
                                                           
                                                </div>

                                              </div>
                                              


                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label>Cantidad por color</label>
                                                
                                                <textarea class="form-control" id="cant_color" cols="40" rows="4" onkeyup="update_op();"></textarea> 
                                                         
                                              </div>

                                              
                                              

                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  <label>_</label>
                                                 
                                              </div>

                                              

                                               <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="seccion_select_areas">
                                                  
                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                      <label>SELECCIONAR ÁREAS</label>
                                                     
                                                  </div>

                                                  <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">

                                                      <div class="form-group row">
                                                        

                                                        <div class="col-md-9 col-sm-9 ">

                                                          <div class="checkbox">
                                                            <label>
                                                              <input type="checkbox" class="flat" id="check_porc"> Ensamble (Porcelanizado)
                                                            </label>
                                                          </div>
                                                          <div class="checkbox">
                                                            <label>
                                                              <input type="checkbox" class="flat" id="check_com"> Ensamble (Comercial)
                                                            </label>
                                                          </div>
                                                          <div class="checkbox">
                                                            <label>
                                                              <input type="checkbox" class="flat" id="check_mueb"> Ensamble (Mueble)
                                                            </label>
                                                          </div>
                                                          <div class="checkbox">
                                                            <label>
                                                              <input type="checkbox" class="flat" id="check_horno"> Horno
                                                            </label>
                                                          </div>
                                                          <div class="checkbox">
                                                            <label>
                                                              <input type="checkbox" class="flat" id="check_herreria"> Herrería
                                                            </label>
                                                          </div>
                                                          <div class="checkbox">
                                                            <label>
                                                              <input type="checkbox" class="flat" id="check_plasticos"> Plásticos
                                                            </label>
                                                          </div>
                                                          <div class="checkbox">
                                                            <label>
                                                              <input type="checkbox" class="flat" id="check_pintura"> Pintura
                                                            </label>
                                                          </div>
                                                          
                                                        </div>
                                                      </div>

                                                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="back">

                                                        <div class="form-group row">
                                                            <button type="button" class="btn btn-primary" onclick="crear_ip_areas();" id=""><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>

                                                        </div>
                                                      </div>



                                                  </div>

                                                  <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-7">

                                                   

                                                        <table id="tbl_op_det" class="table table-hover">
                                      
                                                        </table>
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="box_result_idpg_detped">

                                                        </div>


                                                  </div>
                                                   <!-- <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <button type="button" class="btn btn-dark" onclick="cancelar_op();" id="">Cancelar OP</button>
                                                    <button type="button" class="btn btn-dark" onclick="rastaurar_op();" id="">Restaurar</button>
                                                   </div> -->
                                                  <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <label id="id_detped" style="visibility: hidden;"><?php $detpedido=($_GET['detpedido']);echo "$detpedido";?></label>
                                                  </div>
                                                  
                                              </div>



                                                  

                                                

                                         
                                          </div>

                                        </div>

                                        </div>
                                </div>      


                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div>





    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_ver_op_det">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h5>VER ORDEN DE PRODUCCIÓN</h5>
                          </div>    
                           
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:500px;">

                                <div class="col-md-12 col-sm-12 ">
                                        <div class="x_panel">
                                        <div class="x_title">
                                          <label id="iddet_ped_ver" style="visibility: hidden;"></label>

                                          
                                          <h2 id="area_nom"></h2> 
                                          
                                                
                                        <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                          <div class="row">
                                             
                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label>No. OP:</label>
                                                <input type="text" class="form-control" id="op_r" value="" disabled="">
                                               
                                                

                                              </div>
                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label>Prioridad:</label>
                                                <input type="text" class="form-control" id="prioridad_r" disabled="">
                                                <input type="hidden" class="form-control" id="idop_r" value="" disabled="">          
                                              </div>
                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  <label>Observaciones:</label>
                                                  
                                                  <textarea class="form-control" id="observ_r" cols="40" rows="3" disabled=""></textarea>           
                                              </div>
                                              
                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>_</label>
                                              </div>

                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 300px;">

                                                   

                                                        <table id="tbl_op2" class="table table-hover">
                                      
                                                        </table>


                                              </div>

                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>Cantidad por color</label>
                                                
                                                <textarea class="form-control" id="cant_color_r" cols="40" rows="3" disabled=""></textarea> 
                                                         
                                              </div>

                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>PLAN</label>
                                              </div>

                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label>Fecha de inicio:</label>
                                                <input type="date" class="form-control" id="fecha1_r" disabled="">
                                                         
                                              </div>
                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label>Fecha de termino:</label>
                                                <input type="date" class="form-control" id="fecha2_r" disabled="">
                                                         
                                              </div>

                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>REAL</label>
                                              </div>

                                              <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <label>Fecha de inicio:</label>
                                                <input type="date" class="form-control" id="real_fecha1">
                                                         
                                              </div>
                                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <label>Hora de inicio:</label>
                                                <input type="time" class="form-control" id="real_hora1">
                                                         
                                              </div>

                                              <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <label>Fecha de termino:</label>
                                                <input type="date" class="form-control" id="real_fecha2">
                                                         
                                              </div>
                                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <label>Hora de termino:</label>
                                                <input type="time" class="form-control" id="real_hora2">
                                                         
                                              </div>



                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                                                  <label>_</label>
                                                 
                                                </div>

                                              
                                              <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                <label>Lote:</label>
                                                <input type="text" class="form-control" id="lote_r" value="">           
                                              </div>
                                              
                                              
                                              
                                              <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                <label>Piezas fabricadas:</label>
                                                <input type="number" class="form-control" id="cant_r" value="">           
                                              </div>
                                              <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                <label>Maquina:</label>
                                                <input type="text" class="form-control" id="maquina_r" value="">           
                                              </div>
                                              <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                <label>Ciclo:</label>
                                                <input type="text" class="form-control" id="ciclo_r" value="">           
                                              </div>
                                              

                                          </div>

                                          <div class="row" id="metricas">

                                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                <label>Productividad:</label> 
                                                <input type="text" class="form-control" id="productividad_r">            
                                              </div>
                                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                <label>% Cumplimiento:</label> 
                                                <input type="text" class="form-control" id="cumplimiento_r">            
                                              </div>
                                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                <label>Diferencia Mat. Prima:</label> 
                                                <input type="text" class="form-control" id="diferencia_r">            
                                              </div>
                                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                <label>Entregas:</label> 
                                                <input type="text" class="form-control" id="entregas_r">            
                                              </div>
                                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                <label>Reproceso:</label> 
                                                <input type="text" class="form-control" id="reproceso_r">            
                                              </div>
                                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                <label>Desperdicio:</label> 
                                                <input type="text" class="form-control" id="desperdicio_r">            
                                              </div>
                                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                <label>Merma:</label> 
                                                <input type="text" class="form-control" id="merma_r">            
                                              </div>
                                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                <label>Producto aprobado:</label> 
                                                <input type="text" class="form-control" id="prod_aprob_r">            
                                              </div>
                                              
                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  <label>Observaciones:</label>
                                                  
                                                  <textarea class="form-control" id="observ_area_r" cols="40" rows="5"></textarea>           
                                              </div>
                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                                                  <label>_</label>
                                                 
                                                </div>
                                              

                                          </div>

                                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">

                                                  <button type="button" class="btn btn-primary"  id="" onclick="update_op_area();">Guardar</button>
                                                 

                                                  <a href="" id="enlace_op" onclick="abrir_op();" target="_blank">
                                                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-print" aria-hidden="true"></button>
                                                  </a>

                                          </div>


                                        </div>

                                        </div>
                                </div>     


                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div>





    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_avances">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h5>REGISTRO DE AVANCES</h5>
                          </div>    
                           
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:500px;">

                                <div class="col-md-12 col-sm-12 ">
                                        <div class="x_panel">
                                        <div class="x_title">
                                          <label id="iddet_ped_ver" style="visibility: hidden;"></label>

                                          
                                          <h2 id="area_nom"></h2> 
                                          
                                                
                                        <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                          <div class="row">
                                             
                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label>No. OP:</label>
                                                <input type="text" class="form-control" id="op_a" value="" disabled="">
                                                <input type="hidden" id="idop_detalle_actual">
                                              </div>

                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label>Área:</label>
                                                <input type="text" class="form-control" id="area_a" value="" disabled="">
                                                <input type="hidden" class="form-control" id="area_num" value="" disabled="">
                                              </div>
                                              
                                              
                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label for="heard">Seleccionar producto:</label>
                                                    <select id="heard" class="form-control" onchange="ver_id();">
                                                      
                                                    </select>
                                                  </div>
                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <!--<button type="button" class="btn btn-dark"  id="" onclick="cancelar_prod();">Cancelar</button>-->
                                                    <hr width="100%">
                                                  </div>
                                                  <br>
                                                 <!-- <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                          
                                                          <button type="button" class="btn btn-dark"  id="" onclick="ver_id_todo();"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
                                                          <button type="button" class="btn btn-dark"  id="" onclick="ver_id();"><span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span></button>
                                                  </div>-->
                                              
                                              
                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label>PRODUCTOS</label>
                                              </div>

                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="box_productos_avance">
                                                      

                                              </div>

                                              

                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  
                                                   <hr width="100%"> 

                                              </div>
                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                  
                                                  <label>Avances</label>

                                              </div>
                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" align="right">
                                                  
                                                 <button type="button" class="btn btn-dark"  id="" onclick="actualizar_avances();">Actualizar tabla avances</button>

                                              </div>

                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  
                                                  <table id="tbl_hist_avances" class="table table-hover">

                                                  </table>

                                              </div> 

                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                  
                                                  <label>Excedente</label>

                                              </div>
                                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" align="right">
                                                  
                                                 <button type="button" class="btn btn-dark"  id="" onclick="actualizar_exc();">Actualizar tabla excedentes</button>

                                              </div>

                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  
                                                  <table id="tbl_excedente" class="table table-hover">

                                                  </table>

                                              </div>  

                                          </div>

                                        


                                        </div>

                                        </div>
                                </div>     


                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div>


    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_registro_extra">
      <div class="modal-dialog modal-sm">
          <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Registro de <br>Excedente</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                 <label>Cantidad:</label>
                                 <input type="number" class="form-control" id="cantidad_exc">
                                 <input type="hidden" class="form-control" id="idop_detalle_prod">                 
                              </div>
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                 <label>Lote:</label>
                                 <input type="number" class="form-control" id="lote_exc">
                                               
                              </div>

                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                 <label>Comentario:</label>
                                 <textarea class="form-control" id="coment_exc" cols="40" rows="3"></textarea>
                                               
                              </div>

                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-primary" onclick="guardar_extra();">Guardar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>

          </div>
      </div>
    </div>


    <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="modal_agregar_prod_op">
      <div class="modal-dialog modal-md">
          <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Agregar producto a OP</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                 <label>Productos en produccion sin OP:</label>                 
                              </div>

                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_prod_sin_op" style="height: 400px; overflow: scroll">
                                                 
                              </div>
                             

                        </div>
                        <div class="modal-footer">
                          
                          
                        </div>

          </div>
      </div>
    </div>

    <style>
      .add_prod_op{
        cursor: pointer; 
        border: 20px;
      }
      .add_prod_op:hover{
        cursor: pointer; 
        border: 20px;
        background-color: #ccc;
      }
    </style>


      </div>
    </div> 
    
     
    <script src="https://cdn.sheetjs.com/xlsx-0.20.3/package/dist/xlsx.full.min.js"></script>          
    <script src="vendors/jquery-knob/dist/jquery.knob.min.js"></script>
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
    <script type="text/javascript" src="scripts/op.js?v=<?php echo(rand()); ?>"></script>
    <script src="build/js/custom.min.js"></script>
    <script src="public/js/bootbox.min.js"></script> 
    
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>



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