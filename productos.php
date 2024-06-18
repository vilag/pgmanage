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
        <div class="right_col" role="main" id="page_pedido">

          <div class="">
            
            <div class="clearfix"></div>

          
            <div class="row" id="select_product_area">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
               

                                <div class="x_content">

                    

                             
                                       
                                          <!--<div class="row">
                                              <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                  <label>Buscar:</label>
                                                  <input type="text" class="form-control" id="text_buscar" onkeyup="buscar_texto_tbl();" autocomplete="off">
                                                             
                                              </div>
                                              <div class="col-sm-12">
                                                <div class="card-box table-responsive">



                                                  <table id="tbl_productos" class="table table-hover">
                                                    
                                                  </table>


                                        
                                                </div>
                                              </div>
                                          </div>-->


                                          <div class="row" id="">
                                            <div class="col-md-12 col-sm-12">
                                                  <!--<div class="col-md-12 col-sm-12">
                                                    <div class="btn-group" id="group_notif_term">
                                                      
                                                      <a class="btn btn-app" onclick="" id="">
                                                        <span class="badge bg-green" style="color: white;" id=""></span>
                                                        <i class="fa fa-check"></i> Terminados
                                                      </a>

                                                    </div>
                                                  </div>-->
                                                  <style>
                                                    .disabled_div{
                                                      pointer-events: none; 
                                                      opacity: 1;
                                                    }
                                                  </style>  

                                                  <div class="col-md-12 col-sm-12">
                                                    <!-- <div id="new_div_clasif" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #EDF4F9; padding-bottom: 30px; padding-top: 20px;">
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                          <b>Nueva clasificación</b>
                                                        </div>
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4" style="margin-top: 20px;">
                                                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label>Tipos:</label>
                                                          </div>
                                                          <div class="btn-group" style="margin-top: -10px;">
                                                            <select id="select_tipo_new" class="form-control selectpicker" style="width: 200px;" onclick="mostrar_modelos_new();">
                                                              
                                                            </select>
                                                            
                                                            <button type="button" class="btn btn-dark" onclick="open_nuevo_clase_dato(1,'Nuevo');">+</button>
                                                            <button style="margin-left: 2px;" type="button" class="btn btn-dark" onclick="open_editar_clase_dato('Editar');">Editar</button>
                                                            <div id="div_new_tipo" style="display: none; width: 250px; height: 150px; top: -80px; background-color: #fff; position: absolute; box-shadow: 5px 5px 10px rgba(0,0,0,0.2); padding-top: 15px; z-index: 5;">
                                                                
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <label>Nuevo tipo:</label>
                                                                  <input type="text" class="form-control" id="input_new_tipo">
                                                                </div>
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <div class="btn-group">
                                                                    <button class="form-control" onclick="close_nuevo_clase_dato(1);">Cancelar</button>  
                                                                    <button class="form-control" onclick="guardar_nuevo_valor_clasif(1);">Guardar</button>
                                                                  </div>   
                                                                </div>
                                                            </div>
                                                          </div> 
                                                        </div>
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4" style="margin-top: 20px;">
                                                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label>Modelos:</label>
                                                          </div>
                                                          <div class="btn-group" style="margin-top: -10px;">
                                                            <select id="select_modelo_new" class="form-control selectpicker" style="width: 200px;" onclick="mostrar_tamano_new();">
                                                              
                                                            </select>
                                                            <button type="button" class="btn btn-dark" onclick="open_nuevo_clase_dato(2,'Nuevo');">+</button>
                                                            <button style="margin-left: 2px;" type="button" class="btn btn-dark" onclick="open_editar_clase_dato_m('Editar');">Editar</button>
                                                            <div id="div_new_modelo" style="display: none; width: 250px; height: 150px; top: -80px; background-color: #fff; position: absolute; box-shadow: 5px 5px 10px rgba(0,0,0,0.2); padding-top: 15px; z-index: 5;">
                                                                
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <label>Nuevo modelo:</label>
                                                                  <input type="text" class="form-control" id="input_new_modelo">
                                                                </div>
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <div class="btn-group">
                                                                    <button class="form-control" onclick="close_nuevo_clase_dato(2);">Cancelar</button>  
                                                                    <button class="form-control" onclick="guardar_nuevo_valor_clasif(2);">Guardar</button>
                                                                  </div>   
                                                                </div>
                                                            </div>
                                                          </div> 
                                                        </div>

                                                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4" style="margin-top: 20px;">
                                                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label>Tamaño:</label>
                                                          </div>
                                                          <div class="btn-group" style="margin-top: -10px;">
                                                            <select id="select_tamano_new" class="form-control selectpicker" style="width: 200px;">
                                                              
                                                            </select>
                                                            <button type="button" class="btn btn-dark" onclick="open_nuevo_clase_dato(3,'Nuevo');">+</button>
                                                            <button style="margin-left: 2px;" type="button" class="btn btn-dark" onclick="open_editar_clase_dato_t('Editar');">Editar</button>
                                                            <div id="div_new_tamano" style="display: none; width: 250px; height: 150px; top: -80px; background-color: #fff; position: absolute; box-shadow: 5px 5px 10px rgba(0,0,0,0.2); padding-top: 15px; z-index: 5;">
                                                                
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <label>Nuevo tamaño:</label>
                                                                  <input type="text" class="form-control" id="input_new_tamano">
                                                                </div>
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <div class="btn-group">
                                                                    <button class="form-control" onclick="close_nuevo_clase_dato(3);">Cancelar</button>  
                                                                    <button class="form-control" onclick="guardar_nuevo_valor_clasif(3);">Guardar</button>
                                                                  </div>   
                                                                </div>
                                                            </div>
                                                          </div> 
                                                        </div>

                                                    </div> -->
                                                    <div class="col-md-12 col-sm-12">
                                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" align="left">
                                                        <h2>PRODUCTOS</h2>
                                                      </div>
                                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" align="right">
                                               
                                                        <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Agregar producto" onclick="nuevo_producto();">Nuevo</button>
                                                        <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Agregar producto" onclick="abrir_reclasif_blank();">Clasif.</button>
                                                        <!--<button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Ver productos fabricados" onclick="abrir_consultar();">Consultar</button>
                                                        <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Ver productos fabricados" onclick="listar_productos_fabricados();">Fabricados</button>
                                                        <button type="button" class="btn btn-dark" onclick="abrir_pro_vendidos();" id="">Pedidos</button>-->
                       
                                                        <!--<button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="" onclick="update_prod_clasif();" id="act_product">Actualizar</button>-->
                                                                      
                                                      </div>
                                                      
                                                    </div>
                                                  </div>

                                                  <div class="col-md-12 col-sm-12">
                                                    <hr width="100%">
                                                  </div>
                                                  
                                                  <div class="col-md-12 col-sm-12" id="consuta_productos">

                                                    <div class="col-md-12 col-sm-12">
                                                     
                                                      <div class="col-md-12 col-sm-12">
                                                        
                                                        <div class="col-md-3 col-sm-3">
                                                          <label>Buscar</label>
                                                          <div class="btn-group">
                                                            <input type="text" class="form-control" id="buscar_prod_fil" value=""> 
                                                            <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Buscar" onclick="listar_productos_busqueda();">Buscar</button>
                                                          </div>    
                                                             
                                                        </div>
                                                        <div class="col-md-3 col-sm-3">
                                                          <label>Tipo</label>
                                                          <select id="select_busqueda_tipo" class="form-control selectpicker" onchange="select_tipo();">    
                                                          </select>  
                                                        </div>
                                                        <div class="col-md-3 col-sm-3">
                                                          <label>Modelo</label>
                                                          <select id="select_busqueda_modelo" class="form-control selectpicker" onchange="select_modelo();">    
                                                          </select>  
                                                        </div>
                                                        <div class="col-md-3 col-sm-3">
                                                          <label>Tamaño</label>
                                                          <select id="select_busqueda_tamano" class="form-control selectpicker" onchange="select_tamano();">    
                                                          </select>  
                                                        </div>
                                                        
                                                      </div>
                                                      
                                                      <div class="col-md-12 col-sm-12" style="display: none;">
                                                        
                                                        <div class="col-md-3 col-sm-3" style="display: none;">
                                                                    <label>SubTipo</label>
                                                                    <select id="select_busqueda_subtipo" class="form-control selectpicker" onchange="select_subtipo();">    
                                                                    </select>  
                                                        </div>
                                                        
                                                        <div class="col-md-3 col-sm-3" style="display: none;">
                                                                    <label>SubModelo</label>
                                                                    <select id="select_busqueda_submodelo" class="form-control selectpicker" onchange="select_submodelo();">    
                                                                    </select>  
                                                        </div>
                                                        
                                                      
                                                        
                                                      </div>
                         
                                                    </div>
                                                    

                                                    
                                                    
                                                    <div class="col-md-12 col-sm-12">
                                                      <div class="col-md-12 col-sm-12">
                                                        <div class="col-md-12 col-sm-12">
                                                          <h2>Productos Encontrados</h2>
                                                        </div>
                                                      </div>
                                                        
                                                      <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:420px; width: 100%;">
                                                          <table class="table table-striped" id="tbl_result_prod_consul">
                                                          </table>
                                                      </div>
                                                     
                                                          
                                                    </div>
                                                    
                                                  </div>

                                                  <div class="col-md-12 col-sm-12" id="consulta_fabricados">
                                                    
                                                    <div class="col-md-12 col-sm-12">
                                                      <label>Productos Fabricados</label>
                                                    </div>
                                                    
                                                    <div class="col-md-6 col-sm-6">
                                                      <label>HERRERIA</label>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6" align="right">
                                                      
                                                      <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Exportar productos fabricados" onclick="exportTableToExcel('tbl_productos_fabricados', 'productos_fabricados')">Exportar</button>
                                                      <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Exportar productos fabricados" onclick="exportar_excel1();">Exportar2</button>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12" style="overflow:scroll;height:500px;width:100%;">
                                                          <table class="table table-striped" id="tbl_productos_fabricados" style="max-height: 100vh;">
                                                          </table>
                                                    </div>

                                                  </div>

                                                  <div class="col-md-12 col-sm-12" id="consulta_vendidos">

                                                    <div class="col-md-12 col-sm-12">
                                                      <label>Productos pedidos</label>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6" align="left">
                                                        <div class="btn-group">
                                                          
                                                                
                                                                <input type="date" class="form-control" id="fecha_pedido1">
                                                                <input type="date" class="form-control" id="fecha_pedido2" placeholder="Fecha 2">
                                                                <button type="button" class="btn btn-dark" onclick="listar_vendidos();" id="">buscar</button>
                                                          
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6 col-sm-6" align="right">
                                                      
                                                      <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Exportar productos pedidos" onclick="exportTableToExcel_vendidos('tbl_productos_pedidos', 'productos_vendidos')">Exportar</button>
                                                    </div>
                                                        
                                                      
                                                    
                                                    <div class="col-md-12 col-sm-12" style="overflow:scroll;height:500px;width:100%;">
                                                          <table class="table table-striped" id="tbl_productos_pedidos" style="max-height: 100vh;">
                                                          </table>
                                                    </div>

                                                  </div>

                                                    
                                                  <div class="col-md-12 col-sm-12">
                                                    <hr width="100%">
                                                  </div>

                                                  

                                                  <!--<div class="col-md-3 col-sm-3">
                                                    <div class="col-md-12 col-sm-12">
                                                                <label>Sub Tipo</label>
                                                                <select id="select_busqueda_tipo2" class="form-control selectpicker" onchange="listar_modelo();">    
                                                                </select>  
                                                    </div>
                                                    <div class="col-md-12 col-sm-12">
                                                                <label>Sub Modelo</label>
                                                                <select id="select_busqueda_modelo2" class="form-control selectpicker" onchange="listar_tamano();">    
                                                                </select>  
                                                    </div>
                                                  </div>-->
                                                  
                                            </div>
                                            

                                          </div>          




                                      

                    
                             


                </div>
              </div>
            </div>

 


          </div>


          



        </div>
        <!-- /page content -->    

      </div>
    </div> 

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_detalle_productos">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Detalle de productos</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">

                            

                            <!--<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Tipo:</label>
                                <select  class="form-control" id="tipo_prod">
                                  <option value="">Seleccionar</option>
                                  <option value="5">Accesorio</option>
                                  <option value="3">Mesa</option>
                                  <option value="1">Pizarrón</option>
                                  <option value="7">Plásticos</option>
                                  <option value="2">Silla</option>
                                  <option value="4">Vitrina</option>
                                  <option value="6">Otro</option>
                                </select>
                                
                            </div>-->
                           
                            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>TIPO:</label>
                                <input type="text" class="form-control" id="tipo_prod" disabled="">
                                <input type="hidden" class="form-control" id="idproducto" disabled="">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>CODIGO:</label>
                                <input type="text" class="form-control" id="codigo" disabled="">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>NOMBRE:</label>
                                <input type="text" class="form-control" id="nombre">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>COLOR:</label>
                                <input type="text" class="form-control" id="color">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>MEDIDA:</label>
                                <input type="text" class="form-control" id="medidas">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" id="caja_precio">
                                <label>PRECIO (SIN IVA):</label>
                                <input type="text" class="form-control" id="precio" disabled="">
                            </div>
                            

                          


                        </div>
                        <div class="modal-footer">
                         <!-- <button id="btn_save_prod" type="button" class="btn btn-primary" onclick="actualizar_producto();">GUARDAR</button>-->
                          

                          
                        </div>

                      </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_nuevo_producto">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header" style="padding-left: 40px;">
                          <h5 class="modal-title" id="myModalLabel">Nuevo producto</h5>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                           
                          <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; height:auto;">
                            <div class="col-md-4 col-sm-4" style="margin-bottom: 20px;">
                                <label>Codigo</label>
                                <input type="text" class="form-control" id="codigo_nuevo_reg">  
                            </div>
                            <div class="col-md-8 col-sm-8" style="margin-bottom: 20px;">
                                <label>Nombre</label>
                                <input type="text" class="form-control" id="nombre_nuevo_reg">  
                            </div>
                            <div class="col-md-6 col-sm-6" style="margin-bottom: 20px;">
                                <label>Tipo</label>
                                <select id="select_busqueda_tipo_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>

                             <div class="col-md-6 col-sm-6" style="margin-bottom: 20px;">
                                <label>Modelo</label>
                                <select id="select_busqueda_modelo_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            <!--<div class="col-md-6 col-sm-6">
                                <label>SubModelo</label>
                                <select id="select_busqueda_submodelo_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>-->
                            <div class="col-md-6 col-sm-6" style="margin-bottom: 20px;">
                                <label>Tamaño</label>
                                <select id="select_busqueda_tamano_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>

                            <div class="col-md-6 col-sm-6" style="margin-bottom: 20px;">
                                <label>Estatus</label>
                                <select id="estatus_nuevo_reg" class="form-control selectpicker" onchange="">
                                  <option value="1">Habilitado</option>
                                  <option value="0">Deshabilitado</option>    
                                </select>  
                            </div>
                            <div class="col-md-6 col-sm-6" style="margin-bottom: 20px;">
                                <label>Linea/Especial</label>
                                <select id="tipo_prod_esp_lin" class="form-control selectpicker" onchange="">
                                  <option value="0">Producto de linea</option>
                                  <option value="1">Producto especial</option>    
                                </select>  
                            </div>


                            <!--<div class="col-md-12 col-sm-12">
                                <label>SubTipo</label>
                                <select id="select_busqueda_subtipo_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                           
                            <div class="col-md-12 col-sm-12">
                                <label>Color</label>
                                <select id="select_busqueda_color_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            
                            <div class="col-md-12 col-sm-12">
                                <label>Paleta</label>
                                <select id="select_busqueda_paleta_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>Especificaciones</label>
                                <select id="select_busqueda_especif_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>Especificaciones 2</label>
                                <select id="select_busqueda_especif2_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>Especificaciones 3</label>
                                <select id="select_busqueda_especif3_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>-->
                          </div>
                          <!--<div class="col-md-12 col-sm-12">
                            <div class="col-md-12 col-sm-12">
                                <input type="number" class="form-control" id="idprod_tipo" value="0">
                                <input type="number" class="form-control" id="idprod_tipo2" value="0">
                                <input type="number" class="form-control" id="idprod_modelo" value="0">
                                <input type="number" class="form-control" id="idprod_modelo2" value="0">
                                <input type="number" class="form-control" id="idprod_tamano" value="0"> 
                                <input type="number" class="form-control" id="idprod_color" value="0">
                                <input type="number" class="form-control" id="idprod_paleta" value="0">
                                <input type="number" class="form-control" id="idprod_especif" value="0">
                                <input type="number" class="form-control" id="idprod_especif2" value="0">
                                <input type="number" class="form-control" id="idprod_especif3" value="0"> 
                            </div>
                          </div> -->
                            
                        </div>
                        <div class="modal-footer">
                          <button id="" type="button" class="btn btn-dark" onclick="guardar_producto_nuevo();">GUARDAR</button>
                          

                          
                        </div>

                      </div>
      </div>
    </div>
    
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_reclasif">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Nueva clasificación</h4>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
                                                      <div id="new_div_clasif" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #EDF4F9; padding-bottom: 30px; padding-top: 20px;">
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                          <b>Nueva clasificación</b>
                                                        </div>
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label>Tipos:</label>
                                                          </div>
                                                          <div class="btn-group" style="margin-top: -10px;">
                                                            <select id="select_tipo_new" class="form-control selectpicker" style="width: 300px;" onclick="mostrar_modelos_new();">
                                                              
                                                            </select>
                                                            
                                                            <button type="button" class="btn btn-dark" onclick="open_nuevo_clase_dato(1,'Nuevo');">+</button>
                                                            <button style="margin-left: 2px;" type="button" class="btn btn-dark" onclick="open_editar_clase_dato('Editar');">Editar</button>
                                                            <div id="div_new_tipo" style="display: none; width: 250px; height: 150px; top: -80px; background-color: #fff; position: absolute; box-shadow: 5px 5px 10px rgba(0,0,0,0.2); padding-top: 15px; z-index: 5;">
                                                                
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <label>Nuevo tipo:</label>
                                                                  <input type="text" class="form-control" id="input_new_tipo">
                                                                </div>
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <div class="btn-group">
                                                                    <button class="form-control" onclick="close_nuevo_clase_dato(1);">Cancelar</button>  
                                                                    <button class="form-control" onclick="guardar_nuevo_valor_clasif(1);">Guardar</button>
                                                                  </div>   
                                                                </div>
                                                            </div>
                                                          </div> 
                                                        </div>
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label>Modelos:</label>
                                                          </div>
                                                          <div class="btn-group" style="margin-top: -10px;">
                                                            <select id="select_modelo_new" class="form-control selectpicker" style="width: 300px;" onclick="mostrar_tamano_new();">
                                                              
                                                            </select>
                                                            <button type="button" class="btn btn-dark" onclick="open_nuevo_clase_dato(2,'Nuevo');">+</button>
                                                            <button style="margin-left: 2px;" type="button" class="btn btn-dark" onclick="open_editar_clase_dato_m('Editar');">Editar</button>
                                                            <div id="div_new_modelo" style="display: none; width: 250px; height: 150px; top: -80px; background-color: #fff; position: absolute; box-shadow: 5px 5px 10px rgba(0,0,0,0.2); padding-top: 15px; z-index: 5;">
                                                                
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <label>Nuevo modelo:</label>
                                                                  <input type="text" class="form-control" id="input_new_modelo">
                                                                </div>
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <div class="btn-group">
                                                                    <button class="form-control" onclick="close_nuevo_clase_dato(2);">Cancelar</button>  
                                                                    <button class="form-control" onclick="guardar_nuevo_valor_clasif(2);">Guardar</button>
                                                                  </div>   
                                                                </div>
                                                            </div>
                                                          </div> 
                                                        </div>

                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label>Tamaño:</label>
                                                          </div>
                                                          <div class="btn-group" style="margin-top: -10px;">
                                                            <select id="select_tamano_new" class="form-control selectpicker" style="width: 300px;">
                                                              
                                                            </select>
                                                            <button type="button" class="btn btn-dark" onclick="open_nuevo_clase_dato(3,'Nuevo');">+</button>
                                                            <button style="margin-left: 2px;" type="button" class="btn btn-dark" onclick="open_editar_clase_dato_t('Editar');">Editar</button>
                                                            <div id="div_new_tamano" style="display: none; width: 250px; height: 150px; top: -80px; background-color: #fff; position: absolute; box-shadow: 5px 5px 10px rgba(0,0,0,0.2); padding-top: 15px; z-index: 5;">
                                                                
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <label>Nuevo tamaño:</label>
                                                                  <input type="text" class="form-control" id="input_new_tamano">
                                                                </div>
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <div class="btn-group">
                                                                    <button class="form-control" onclick="close_nuevo_clase_dato(3);">Cancelar</button>  
                                                                    <button class="form-control" onclick="guardar_nuevo_valor_clasif(3);">Guardar</button>
                                                                  </div>   
                                                                </div>
                                                            </div>
                                                          </div> 
                                                        </div>
                                                        <div class="col-lg-12 col-md-11 col-sm-11 col-xs-11" style="margin-top: 20px; padding: 15px;">
                                                          <label for="">Producto a clasificar</label><br>
                                                          <b id="b_prod_new_clasif" style="font-size: 16px;"></b>
                                                          <input type="hidden" id="id_prod_new_c">
                                                        </div>
                                                      </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" onclick="cerrar_modal_clasif();">Cancelar</button>
            <button id="btn_save_reclasif" type="button" class="btn btn-primary" onclick="guardar_nueva_clasificacion();">Guardar</button>             
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
    <script type="text/javascript" src="scripts/productos.js?v=<?php echo(rand()); ?>"></script>
    <script src="build/js/custom.min.js"></script>
    <script src="public/js/bootbox.min.js"></script> 
    
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