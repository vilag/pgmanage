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
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1 || $_SESSION['Produccion']==1 || $_SESSION['consulta1']==1)
{
?>

        <script type="text/javascript">
          //var intevalo = setInterval('listar_re_alm()',5000);
          

        </script>

        <!-- page content -->
        <div class="right_col" role="main" id="page_pedido">

          <div class="">
            
                       
           
            <div class="clearfix"></div>

            <div class="row" id="area_inicial">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    
                    
                    <!--<div class="form-group col-md-12 col-sm-12" align="right">
                      <button type="button" class="btn btn-round btn-success" onclick="fabricados();">Fabricados</button>
                    </div>-->
                    
                                  <div class="form-group col-md-12 col-sm-12">
                                   
                                    <b>ALMACÉN DE PRODUCTO TERMINADO</b>
                                  </div>
                                  <div class="form-group col-md-12 col-sm-12">
                                   
                                    <hr width="100%">
                                  </div>

                                  <div class="form-group col-md-6 col-sm-6">
                                        

                                                <div class="btn-group">
                                                  
                                                  <input type="text" class="form-control" name="text_busc" id="text_busc" placeholder="Buscar">
                                                  
                                                    
                                                  <input type="hidden" class="form-control" id="idalmacen_pt" value="0">
                                                  <input type="hidden" class="form-control" id="idalmacen_pt_resp" value="0">

                                                  <input type="hidden" class="form-control" id="codigo_alm" disabled="">
                                                  <input type="hidden" class="form-control" id="codigo_nuevo" disabled="">
                                                  <input type="hidden" class="form-control" id="sub_code" onkeyup="marcar_new_prod()" disabled="">
                                                </div>
                                                  
                                                <div class="btn-group">
                                                  <button type="button" class="btn btn-dark" id="" onclick="codigos_alm_pt();"><span class="glyphicon glyphicon-search" aria-hidden="true" style="color: white;"></span></span></button>
                                                  <button type="button" class="btn btn-dark" id="nuevo_prod_pt" onclick="nuevo_prod_alm();"><span class="glyphicon glyphicon-plus" aria-hidden="true" style="color: white;"></span></button>
                                                </div>
                                           
                                      
                                  </div>

                                  <div class="form-group col-md-6 col-sm-6" align="right">
                                    
                                    <a href="" id="enlace_imp" onclick="abrir_inv();" target="_blank">
                                        
                                        <button  type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Imprimir inventario" style="margin-left: 10px;"><i class="fa fa-print"></i></button>
                                    </a>
                                   
                                    <button  type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Inventario" onclick="abrir_ventana_inv();" style="margin-left: 10px;"><span class="glyphicon glyphicon-th-list" aria-hidden="true" style="color: black;"></span></button>
                                    <button  type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Fabricados" onclick="listar_terminados();" style="margin-left: 10px;"><i class="fa fa-cogs"></i></button>
                                    <button  type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Vales de salida de almacén" onclick="abrir_vales_salida();" style="margin-left: 10px;"><i class="fa fa-file-text-o"></i></button>
                                  </div>

                                  <div class="form-group col-md-12 col-sm-12" style="max-height: 400px;" id="coincidencias_reg">

                                        <div class="form-group col-md-12 col-sm-12">
                                          <h5 id="num_coin"></h5>
                                          <h5 id="num_coin2" style="visibility: hidden;"></h5>
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12">

                                          <div class="form-group col-md-12 col-sm-12" id="box_codigos" style="overflow:scroll; max-height: 300px; width:100%;" style="width: 20px;">

                                          </div>

                                        </div>

                                  </div>

                            

                                  <div class="form-group col-md-12 col-sm-12" id="formulario_reg">

                                    <div class="form-group col-md-12 col-sm-12" align="right">

                                            
                                            <div class="btn-group form-check" data-toggle="buttons">
                                              <label class="btn btn-secondary" style="background: #023D68;" id="option_new">
                                                <input type="radio" class="join-btn" id="option1" disabled=""> Nuevo
                                              </label>
                                              <label class="btn btn-secondary" style="background: #cccccc;" id="option_exist">
                                                <input type="radio" class="join-btn" id="option2" disabled=""> Existente
                                              </label>
                                             
                                            </div>

                                    </div>

                                    <div class="form-group col-md-12 col-sm-12" align="left">
                                                    
                                                      
                                                          <a class="btn btn-app" style="background: #cccccc; color: black; border-radius: 10px;" id="btn_entrada" onclick="set_active1();">                  
                                                            <i class="fa fa-inbox"></i>Entrada
                                                            <input type="hidden" class="form-control" id="active1">
                                                          </a>
                                                          <a class="btn btn-app" style="background: #cccccc; color: black; border-radius: 10px;" id="btn_salida" onclick="set_active2();">                  
                                                            <i class="fa fa-inbox"></i>Salida
                                                            <input type="hidden" class="form-control" id="active2">
                                                          </a>

                                                          


                                         
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12" style="overflow:scroll; max-height: 700px; width:100%;" id="form_prod">

                                        <div class="form-group col-md-12 col-sm-12">
                                          <label style="color: white;">_</label>
                                        </div> 

                                        <div class="form-group col-md-12 col-sm-12">

                                                
                                               

                                                  <div class="btn-group">
                                                   
                                                    <input type="text" class="form-control" id="codigo_buscar" placeholder="Buscar codigo">
                                                    
                                                  </div>
                                                    
                                                  <div class="btn-group">
                                                    <button type="button" class="btn btn-dark" id="" onclick="buscar_codigo();">Buscar</button>
                                                  </div> 
                                                
                                           
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12">

                                                <label>Codigo</label>
                                                <input type="text" class="form-control" name="codigo" id="codigo" onkeyup="codigos_alm_pt2();" disabled="">
                                                <input type="hidden" class="form-control" id="idproducto_clasif" value="0">
                                                <input type="hidden" class="form-control" id="idalmacen_pt" value="0">
                                                <input type="hidden" class="form-control" id="idalmacen_pt_resp" value="0">

                                                <input type="hidden" class="form-control" id="codigo_alm" disabled="">
                                                <input type="hidden" class="form-control" id="codigo_nuevo" disabled="">
                                                <input type="hidden" class="form-control" id="sub_code" onkeyup="marcar_new_prod()" disabled="">
                                           
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12" id="box_coin_prod_alm">

                                        </div>
                                       
                                        <div class="form-group col-md-12 col-sm-12">
                                            <label>Descripción:</label>
                                            <!--<input type="text" class="form-control" id="nombre" onkeyup="marcar_new_prod()">-->
                                            <textarea class="form-control" id="nombre" cols="40" rows="3" onkeyup="marcar_new_prod();" disabled=""></textarea>              
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12" id="box_coin_prod_alm2">

                                        </div>
                                        
                                        <div class="form-group col-md-4 col-sm-12">
                                            
                                                <label>Tipo:</label>
                                                <select  class="form-control" id="tipo" onchange="codigo_alm();" disabled="">
                                                  <option value="">Seleccionar</option>
                                                  <option value="5">Accesorio</option>
                                                  <option value="3">Mesa</option>
                                                  <option value="1">Pizarrón</option>
                                                  <option value="7">Plásticos</option>
                                                  <option value="2">Silla</option>
                                                  <option value="4">Vitrina</option>
                                                  <option value="6">Otro</option>
                                                </select>
                                          
            
                                        </div>

                                        

                                        <div class="form-group col-md-4 col-sm-12">

                                              
                                              <label>Color:</label>
                                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" id="edit_color">
                                                <input type="radio" id="idbase" value="base" onclick="mostrar_inputcolor();">
                                                <label>Base</label>

                                              </a>
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="edit_color2">
                                                  
                                                    <button style="background: #F8E209;" type="button" class="btn btn-round " onclick="selec_color1();">   
                                                      <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="color: #F8E209;"></span>
                                                    </button>

                                                    <button style="background: #0A72C1;" type="button" class="btn btn-round " onclick="selec_color2();">   
                                                      <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="color: #0A72C1;"></span>
                                                    </button>

                                                    <button style="background: #E67341;" type="button" class="btn btn-round " onclick="selec_color3();">   
                                                      <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="color: #E67341;"></span>
                                                    </button>

                                                    <button style="background: #D73D47;" type="button" class="btn btn-round " onclick="selec_color4();">   
                                                      <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="color: #D73D47;"></span>
                                                    </button>

                                                    <button style="background: #12844D;" type="button" class="btn btn-round " onclick="selec_color5();">   
                                                      <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="color: #12844D;"></span>
                                                    </button>

                                                    
                                                  
                                               </div> 
                                              
                                              <input type="radio" id="idesp" value="esp" onclick="mostrar_inputcolor2();">
                                              <label id="esp_sub">Especial</label>
                                              <input type="text" class="form-control" id="color2" disabled="">
                                              <input type="color" class="form-control" id="color" onchange="armar_nuevo_codigo();">

                                              
                                                 
                                        </div> 

                                        <div class="form-group col-md-4 col-sm-12">
                                            <label>Medidas (cm):</label>
                                            
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" id="edit_fecha">
                                            
                                              <input type="text" class="form-control" id="medidas" disabled=""> 
                                             
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label>Alto:</label>
                                                    <input type="number" class="form-control" id="alto" onkeyup="llenar_medidas();">              
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label>Ancho:</label>
                                                    <input type="number" class="form-control" id="ancho" onkeyup="llenar_medidas();">              
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label>Largo:</label>
                                                    <input type="number" class="form-control" id="largo" onkeyup="llenar_medidas();">              
                                                </div>
                                                
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label>Extra:</label>
                                                    <input type="text" class="form-control" id="extra" onkeyup="llenar_medidas();">              
                                                </div>
                                              
                                                
                                             </div>             
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12" align="center">
                                            <button type="button" class="btn btn-dark btn-lg" id="btn_form_ped" onclick="guardar_registro();">Guardar</button>
                                        </div>

                                        

                                    </div>

                                    <div class="form-group col-md-12 col-sm-12" id="detalle_prod">



                                        <div class="form-group col-md-6 col-sm-6">

                                              <h1 id="codigo_ficha"></h1>
                                              <h3 class="name_title" id="cantidad_ficha"></h3>
                                              <p>
                                                <label>Descripción: <strong id="descripcion_ficha"></strong></label><br>
                                                <label>Tipo: <strong id="tipo_ficha"></strong></label><br>
                                                <label>Color: <strong id="color_ficha"></strong></label><br>
                                                <label>Medidas: <strong id="medidas_ficha"></strong></label><br>
                                              </p>
                                          
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6" align="center">
                                                  <div class="x_title">
                                                        
                                                        <div class="clearfix"></div>
                                                  </div>
                                                  <img src="images/marca/logo.png" alt="..." width="60%">
                                                  
                                        </div>

                                        

                                       

                                        

                                         <div class="form-group col-md-4 col-sm-12">
                                            <label>Lote:</label>
                                            <input type="text" class="form-control" id="lote">              
                                        </div>

                                        <div class="form-group col-md-4 col-sm-12">
                                            <label>Orden de producción:</label>
                                            <input type="text" class="form-control" id="op">              
                                        </div>

                                        <div class="form-group col-md-4 col-sm-12">
                                            <label>No. Control:</label>
                                            <input type="text" class="form-control" id="control">              
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12">
                                            <label>Cantidad:</label>
                                            <input type="number" class="form-control" id="cantidad">              
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12">
                                            <label>Comentario:</label>
                                            <input type="text" class="form-control" id="comentario">              
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12">
                                            <label>Fecha:</label>
                                            <input type="date" class="form-control" id="fecha_registro_alm">              
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12">
                                          <label>_</label>
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12" align="center">
                                            <button type="button" class="btn btn-dark btn-lg" id="btn_form_ped" onclick="guardar_registro();">Guardar</button>
                                        </div>
    

                                    </div>


                                  </div>

                                  

                    <div class="clearfix"></div>
                  </div>
                  
                </div>
              </div>
            </div>


            <!--<div class="row" id="">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
               

                  <div class="x_content">

                    

                    <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                              <div class="x_title">
                                <h6>Pendientes de validación</h6>
                                <ul class="nav navbar-right panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                  </li>
                                  <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Settings 1</a>
                                        <a class="dropdown-item" href="#">Settings 2</a>
                                      </div>
                                  </li>
                                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                                  </li>
                                </ul>
                                <div class="clearfix"></div>
                              </div>
                              

                              <div class="x_content" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 500px;">
                                  <div class="row">
                                      <div class="col-sm-12">
                                        <div class="card-box table-responsive">

                                <div class="form-group col-md-12 col-sm-12">
                                    <div class="card-box table-responsive" id="">

                                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" id="tbl_terminados_valid" >
                              
                                      </div>
                                            
                                    </div>
                                </div>


                                    


                                

                                    </div>
                                  </div>
                                </div>
                              </div>


                            </div>
                    </div> 


                    
                  </div>

                </div>
              </div>
            </div>-->
            

            <div class="row" id="">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
               

                  <div class="x_content">

                    

                    <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                              <div class="x_title">
                                <h6>Ultimos movimientos</h6>
                                <button type="button" class="btn btn-dark" id="" onclick="abrir_ventana_mov();">Ver todo</button>
                                <button type="button" class="btn btn-dark" id="" onclick="listar_re_alm();">Actualizar</button>
                                <div class="clearfix"></div>
                              </div>
                              

                              <div class="x_content" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 500px;">
                                  <div class="row">
                                      <div class="col-sm-12">
                                        <div class="card-box table-responsive">
                                <input type="hidden" class="form-control" id="estatus_tabla" value="3">


                                <div class="form-group col-md-12 col-sm-12">
                                    <table id="datatable_es" class="table table-hover">
                                      
                                    </table>
                                </div>


                                    


                                

                                    </div>
                                  </div>
                                </div>
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


        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_fabricados">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Productos fabricados</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>

                            <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">

                              <div class="form-group col-md-2 col-sm-2">
                          
                                <div class="btn-group">
                                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Filtrar por:
                                  </button>
                                  <div class="dropdown-menu">
                                    
                                    <a class="dropdown-item" href="#" onclick="filtro_option0();">Sin validar</a>  
                                    <a class="dropdown-item" href="#" onclick="filtro_option1();">Validados</a>
                                    <a class="dropdown-item" href="#" onclick="filtro_option2();">En alerta</a>
                                    <a class="dropdown-item" href="#" onclick="filtro_option3();">Todos</a>
                                   
                                  </div>
                                  <input type="hidden" class="form-control" id="valor_filtro" value="0">
                                </div> 

                              </div>


                              <table id="tbl_fabricados" class="table table-hover">
                                      
                              </table>
                                        
                            </div>

                            <div class="modal-footer">
                              
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              
                            </div>
                            

                          </div>
          </div>
        </div>



        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_detalles_prod">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Detalles de producto</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>

                            

                            <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 300px;">

                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h6>CODIGO: <small id="codigo_m"></small></h5>
                                <h6>NOMBRE: <small id="detalle_m"></small></h5>

                                <h6>OBSERVACIÓN DE PRODUCTO: <small id="observ_m"></small></h5>
                                <h6>OBSERVACIÓN DE PEDIDO: <small id="observ_p_m"></small></h5>
                                <h6>NOTA DE ENLACE: <small id="notae_m"></small></h5>

                                <h6>NO. CONTROL: <small id="control_m"></small></h5>
                                <h6>OP: <small id="op_m"></small></h5>
                                <h6>FECHA DE FABRICACIÓN: <small id="fecha_m"></small></h5>
                                <h6>CANTIDAD: <small id="cantidad_m"></small></h5>
                                
                              </div>

                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="btn-group" id="btns_areas">
                                  
                                </div>

                              </div>
                                

                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="tbl_lotes" class="table table-hover">
                                      
                                </table>
                              </div>


                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <a class="btn btn-app" onclick="validado();" id="btn_valid">
                                  <i class="fa fa-check"></i> Validado
                                </a>

                                <a class="btn btn-app" onclick="alerta();" id="btn_alerta">
                                  <i class="fa fa-exclamation-circle"></i> Alerta
                                </a>

                              </div>

                              <input type="hidden" class="form-control" id="idpg_detped">
                              <input type="hidden" class="form-control" id="idop_detalle_prod">
                              
                             <!-- <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                  
                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Estatus</label>
                                  </div>
                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="box_estatus">

                                  </div>
                              </div>

                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                  <label>Avances</label>
                                  <table id="tbl_estatus" class="table table-hover">
                                      
                                  </table>
                              </div>-->

                              


                                    
                                        
                            </div>

                            <div class="modal-footer">
                              
                                <button type="button" class="btn btn-secondary" onclick="volver_a_lista();">Regresar</button>
                              
                            </div>
                            

                          </div>
          </div>
        </div> 



       

        

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_fabricados_valid">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Pendientes de validación</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 500px;">



                                                  

                                  <div class="x_content" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 500px;">
                                      <div class="row">
                                          <div class="col-sm-12">
                                            <div class="card-box table-responsive">


                                              <div class="form-group col-md-12 col-sm-12">
                                                <div class="form-group col-md-12 col-sm-12">
                                                  <div class="btn-group">
                                                    
                                                    <input type="number" class="form-control" id="op_buscar" placeholder="Buscar">
                                                    
                                                  </div>
                                                    
                                                  <div class="btn-group">
                                                    <button type="button" class="btn btn-dark" id="" onclick="listar_terminados_buscar();">Buscar</button>
                                                  </div> 
                                                  <div class="btn-group">
                                                    <a href="" id="enlace" onclick="abrir_rep_valid();" target="_blank">

                                                      <button type="button" class="btn btn-primary">Imprimir</button>
                                                      
                                                    </a>
                                                    
                                                  </div> 
                                                </div>
                                                  
                                              </div>

                                              <div class="form-group col-md-12 col-sm-12">
                                                  <div class="card-box table-responsive" id="">

                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" id="tbl_terminados_valid" >
                                            
                                                    </div>
                                                          
                                                  </div>
                                              </div>
                                              <div class="form-group col-md-12 col-sm-12">
                                                <div class="form-group col-md-12 col-sm-12">
                                                  <h3>Excedentes</h3>
                                                </div>
                                                
                                              </div>

                                              <div class="form-group col-md-12 col-sm-12">
                                                  <div class="card-box table-responsive" id="">

                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" id="tbl_excedente_valid" >
                                            
                                                    </div>
                                                          
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

        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_ubicacion">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          
                          <h6>VALIDAR Y REGISTRAR ENTRADA</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                          
                          <div class="form-group col-md-12 col-sm-12">
                            <label>Ubicación:</label>
                            <textarea class="form-control" id="ubicacion" cols="20" rows="5"></textarea>
                            <input type="hidden" id="idavance">
                            <input type="hidden" id="cantidad_total">
                          </div>

                          <div class="form-group col-md-12 col-sm-12">
                            <label>Comentario:</label>
                            <textarea class="form-control" id="comentario_valid" cols="20" rows="5"></textarea>
                          </div>

                        </div>
                        <div class="modal-footer">
                          
                          <button id="btn_guardar_entrada_alm" type="button" class="btn btn-primary" onclick="guardar_entrada();">Guardar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>

                      </div>
                    </div>
        </div>


        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_ubicacion_exc">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          
                          <h6>VALIDAR Y REGISTRAR ENTRADA DE EXCEDENTE</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                          
                          <div class="form-group col-md-12 col-sm-12">
                            <label>Ubicación:</label>
                            <textarea class="form-control" id="ubicacion_exc" cols="20" rows="5"></textarea>
                            <input type="hidden" id="idexc">
                            <input type="hidden" id="cantidad_total_exc">
                          </div>

                          <div class="form-group col-md-12 col-sm-12">
                            <label>Comentario:</label>
                            <textarea class="form-control" id="comentario_valid_exc" cols="20" rows="5"></textarea>
                          </div>

                        </div>
                        <div class="modal-footer">
                          
                          <button id="btn_guardar_entrada_alm_exc" type="button" class="btn btn-primary" onclick="guardar_entrada_exc();">Guardar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>

                      </div>
                    </div>
        </div>


        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_inventario">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Inventario</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">



                                                  

                                  <div class="x_content" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 500px;">
                                      <div class="row">
                                          <div class="col-sm-12">
                                            <div class="card-box table-responsive">


                                              <input type="hidden" class="form-control" id="estatus_tabla" value="3">


                                              <div class="form-group col-md-12 col-sm-12">
                                                  <table id="datatable_buttons" class="table table-hover">
                                                    
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


         <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_movimientos">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Movimientos</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 500px;">



                                                  

                                  <div class="x_content">
                                      <div class="row">
                                          <div class="col-sm-12">
                                            <div class="card-box table-responsive">


                                              <input type="hidden" class="form-control" id="estatus_tabla" value="3">


                                              <div class="form-group col-md-12 col-sm-12">
                                                  <table id="tbl_movimientos" class="table table-hover">
                                                    
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


         <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_detalle_es">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">DETALLE DE REGISTRO</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">

                                        <div class="col-md-12 col-sm-12">
                                          
                                          <p><h5>MOVIMIENTO: <small id="mov"></small></h5></p>
                                          <p><h5>CODIGO: <small id="cod"></small></h5></p>
                                          <p><h5>NOMBRE: <small id="nom"></small></h5></p>
                                          <p><h5>CANTIDAD: <small id="cant"></small></h5></p>
                                          <p><h5>LOTE: <small id="lot"></small></h5></p>
                                          <p><h5>OP: <small id="ope"></small></h5></p>
                                          <p><h5>No. CONTROL: <small id="cont"></small></h5></p>
                                          <p><h5>FECHA: <small id="fec"></small></h5></p>
                                          <p><h5>COMENTARIO: <small id="com"></small></h5></p>

                                          
                                        
                                        </div>
                                           


                            </div>
                            <div class="modal-footer">
                              
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                              
                            </div>

                          </div>
          </div>
        </div>

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_nuevos_movimientos_detalle">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Productos en embarque</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 500px;">

                                        

                                        <div class="col-md-12 col-sm-12" id="div_tbl_prod_salida">
                                          <div class="col-md-12 col-sm-12" align="right">
                                                <a href="#" onclick="regresar_embarques();">Regresar</a>
                                          </div>
                                          <div class="col-md-12 col-sm-12">
                                            <hr width="100%">
                                          </div>
                                          <div class="col-md-12 col-sm-12">
                                            <table id="tbl_movimientos_nuevos_detalle" class="table table-hover">
                                                    
                                            </table>
                                          </div>
                                            
  
                                        </div>

                                        <div class="col-md-12 col-sm-12" id="div_exist_lote">
                                            
                                          <div class="col-md-12 col-sm-12">
                                            <div class="col-md-12 col-sm-12" align="right">
                                                <a href="#" onclick="regresar_prod_emb();">Regresar</a>
                                            </div>
                                            <div class="col-md-12 col-sm-12" align="right">
                                                <hr width="100%">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                              <label>CODIGO: <b id="codigo_consul_exist"></b></label><br>
                                              <label>DESCRIP.: <b id="descrip_consul_exist"></b></label><br>
                                              <label>CANTIDAD REQUERIDA: <b id="cant_consul_exist"></b></label><br>
                                              <input type="hidden" id="iddetalle_ped">
                                              <input type="hidden" id="identrega">
                                              <input type="hidden" id="idpedido">
                                              <label>OP's</label>
                                              <div id="list_op">
                                                
                                              </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">

                                              <table id="tbl_comportamiento" class="table table-hover">
                                                    
                                              </table>

                                            </div>
                                            
                                          </div>
                                          <div class="col-md-12 col-sm-12">
                                            <hr width="100%">
                                          </div>
                                          <div class="col-md-12 col-sm-12">
                                            <div class="col-md-12 col-sm-12">
                                                  <label>Lotes del pedido</label>
                                            </div>
                                            <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:200px; width: 100%;">
                                              <table id="tbl_lotes_cant_pedido" class="table table-hover">
                                                    
                                              </table>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                              <hr width="100%">
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                  <label>Otros lotes del producto</label>
                                            </div>
                                            <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:200px; width: 100%;">
                                              <table id="tbl_lotes_cant" class="table table-hover">
                                                    
                                              </table>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                              <hr width="100%">
                                            </div>
                                            <div class="col-md-12 col-sm-12">

                                              <div class="col-md-12 col-sm-12">
                                                  <label>Salida</label>
                                              </div>
                                              
                                              <table id="tbl_presalida" class="table table-hover">
                                                    
                                              </table>
                                              <div class="col-md-12 col-sm-12" id="tbl_presalida_save">
                                              </div>
                                              
                                            </div>
                                            <div class="col-md-12 col-sm-12" align="right">
                                              <button type="button" class="btn btn-primary" onclick="guardar_salida();">Guardar salida</button>
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

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_validar_prod_vale">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Existencia</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">

                                        

                                        <div class="col-md-12 col-sm-12" id="div_exist_lote">
                                            
                                          <div class="col-md-12 col-sm-12">
                                            <div class="col-md-6 col-sm-6" align="left">
                                                <label>PRODUCTO</label>
                                            </div>
                                            <div class="col-md-6 col-sm-6" align="right">
                                                
                                                <button  type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Ver lista de productos" onclick="regresaravales();" style=""><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></button>
                                            </div>
                                            <div class="col-md-12 col-sm-12" align="right">
                                                <hr width="100%">
                                            </div>
                                            <div class="col-md-6 col-sm-6">

                                              CONTROL: <b id="control_prod_alm"></b><br>
                                              <label><b id="codigo_consul_exist_vale" style="font-size: 25px;"></b> <br> <b id="descrip_consul_exist_vale"></b></label><br>
                                              <label>CANTIDAD REQUERIDA: <b id="cant_consul_exist_vale" style="font-size: 25px;"></b></label><br>
                                              <label>OBSERVACIONES: <b id="observ_consul_exist_vale" style="font-size: 12px;"></b></label><br>
                                              <label>EMPAQUE: <b id="empaque_consul_exist_vale" style="font-size: 15px;"></b></label><br>
                                              <input type="hidden" id="iddetalle_ped_vale">
                                              <input type="hidden" id="identrega_vale">
                                              <input type="hidden" id="idpedido_vale">
                                              
                                            </div>
                                            <div class="col-md-6 col-sm-6">

                                              <table id="tbl_comportamiento2" class="table table-hover">
                                                    
                                              </table>

                                            </div>
                                            
                                          </div>
                                          <div class="col-md-12 col-sm-12">
                                            <hr width="100%">
                                          </div>
                                          <div class="col-md-12 col-sm-12">
                                           <!--- <div class="col-md-12 col-sm-12">
                                                  <label>Lotes del pedido</label>
                                            </div>
                                            <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:200px; width: 100%;">
                                              <table id="tbl_lotes_cant_pedido2" class="table table-hover">
                                                    
                                              </table>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                              <hr width="100%">
                                            </div>-->
                                            <div class="col-md-12 col-sm-12">
                                                  <label>Existencia de producto</label>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                              <table id="tbl_lotes_cant2" class="table table-hover">
                                                    
                                              </table>

                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                              <hr width="100%">
                                            </div>
                                            <div class="col-md-12 col-sm-12">

                                              <div class="col-md-12 col-sm-12">
                                                  <label>Productos seleccionados</label>
                                              </div>
                                              
                                              <table id="tbl_presalida2" class="table table-hover">
                                                    
                                              </table>
                                              <div class="col-md-12 col-sm-12" id="tbl_presalida_save2">
                                              </div>
                                              
                                            </div>
                                            <div class="col-md-12 col-sm-12" align="right">
                                              <button type="button" class="btn btn-primary" onclick="guardar_salida();">Guardar</button>
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

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_nuevos_movimientos">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Movimientos pendientes</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">
                                       
                                        <div class="col-md-12 col-sm-12">
                                          
                                            <table id="tbl_movimientos_nuevos" class="table table-hover">
                                                    
                                            </table>
  
                                        </div>
                                           


                            </div>
                            <div class="modal-footer">
                              
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                              
                            </div>

                          </div>
          </div>
        </div>
   
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_vales_salida">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Vales de salida</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">
                                        <div class="form-group col-md-6 col-sm-6" align="" id="num_vale">
                                          <input type="hidden" id="idvales_almacen">
                                          <button type="button" class="btn btn-info" onclick="notif_surtido()">Notificar surtido</button><br>
                                          <!--<button type="button" class="btn btn-info" onclick="rechazar_vale()">Rechazar vale completo</button>-->
                                          <b style="font-size: 20px;">No. Vale: </b><b id="no_vale_valid" style="font-size: 25px;"></b>
                                        </div>
                                        <div class="col-md-6 col-sm-6" id="enc_todo" align="right">
                                          
                                          <button  type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Ver vales" onclick="abrir_vales_salida();" style=""><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></button>
                                        </div>
                                        
                                      
                                        <div class="form-group col-md-12 col-sm-12" align="" id="enc_filtro">

                                                  <select  class="form-control" id="estatus_vale_alm" onchange="listar_vales_estatus();">
                                                    <option value="1">Solicitados</option>
                                                    <option value="2">Surtidos</option>
                                                    <option value="6">Rechazados</option>
                                                    
                                                   
                                                    <option value="5">Todos</option>
                                                  </select>

                                        </div>

                                        
                                        
                                        <div class="col-md-12 col-sm-12">
                                          
                                            <table id="tbl_vales_salida" class="table table-hover" style="width: 100%; max-width: 150%;">
                                                    
                                            </table>
  
                                        </div>
                                           


                            </div>
                            <div class="modal-footer">
                              
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                              
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
    <script type="text/javascript" src="scripts/almacen_pt.js?v=<?php echo(rand()); ?>"></script>
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