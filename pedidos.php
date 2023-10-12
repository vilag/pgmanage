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
if ($_SESSION['administrador']==1)
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

        <script type="text/javascript">
          /*var intevalo = setInterval('cargar_notif()',5000);
          var intevalo2 = setInterval('cargar_notif_part()',5000);
          var intevalo3 = setInterval('notif_observ()',5000);
          var intevalo4 = setInterval('contar_prod_sinrev()',5000);
          var intevalo5 = setInterval('det_term()',60000);
          var intevalo6 = setInterval('revisar_sinfecha()',20000);
          var intevalo7 = setInterval('contar_sin_coment_venc()',30000);*/

        </script>
        <!-- page content -->
        <div class="right_col" role="main" id="page_pedido">

          <div class="">
            
            
                          
           
            <div class="clearfix"></div>

            



            <div class="row" id="area_inicial">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <!--<input id="clear" type="submit" value="Limpiar notificaciones">
<input id="rewind" type="submit" value="Mostrar notificaciones">-->
                        <h6>PEDIDOS</h6>
                        
                        
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <br>
                        
                        <div class="form-group col-md-6 col-sm-6">

                           
                            <div class="btn-group" id="vistas_seguim">
                              
                              <a class="btn btn-app" onclick="cambiar_vista();" id="btn_vista1">
                                <i class="fa fa-sitemap"></i> Asignar
                              </a>
                              <a class="btn btn-app" onclick="cambiar_vista2();" id="btn_vista2">
                                <i class="fa fa-sitemap"></i> Asignar
                              </a>

                            </div>
                            
                            <div class="btn-group" id="group_notif_term">
                              
                              <a class="btn btn-app" onclick="abrir_terminados();" id="btn_terminados">
                                <span class="badge bg-green" style="color: white;" id="num_notif"></span>
                                <i class="fa fa-check"></i> Terminados
                              </a>

                            </div>


                            <!--Terminados para ventas-->
                            <div class="btn-group" id="btn_term_pv">
                              
                              <a class="btn btn-app" onclick="abrir_listos();" id="notif_term_ped">
                                <span class="badge bg-green" style="color: white;" id="num_notif_ped"></span>
                                <i class="fa fa-check"></i> Terminados
                              </a>

                            </div>

                           

                            <div class="btn-group" id="btn_sinrevisar">
                              
                              <a class="btn btn-app" onclick="pedidos_atencion();">
                                <span class="badge bg-orange" style="color: white;" id="num_notif_ped_sr"></span>
                                <i class="fa fa-exclamation-triangle"></i> Sin revisar
                              </a>

                            </div>


                            <!--pedidos terminados para ventas-->
                            <!--<div class="btn-group" id="btn_term_pv">
                              
                              <button type="button" class="btn btn-dark" id=""  onclick="abrir_listos();"><span class="glyphicon glyphicon-file" aria-hidden="true" style="color: white;"></span><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: white;"></span></button><span class="badge bg-orange" style="color: #fff; border-radius: 0 5px 5px 0;" id="notif_term_ped"><h4 style="font-size: 20px;" id="num_notif_ped"><strong></strong></h4></span>

                            </div>-->

                            <div class="btn-group" id="btn_vencidos">
                              
                              <a class="btn btn-app" onclick="pedidos_vencidos();">
                                <span class="badge bg-red" style="color: white;" id="num_vencidos"></span>
                                <i class="fa fa-clock-o"></i> Vencidos
                              </a>

                            </div>

                        
                            

                        </div>
                        
                       
                        
                        <div class="form-group col-md-6 col-sm-6" align="right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-success" id="btn_vista_buscar"  onclick="cambiar_buscar();"><span class="glyphicon glyphicon-retweet" aria-hidden="true" style="color: white;"></span></button>
                              <input type="hidden" class="form-control" id="contador_vista_buscar" value="1">
                              <input type="text" class="form-control" id="cliente_buscar" placeholder="Buscar cliente" onkeyup="mostrar_result_cli();">
                              <input type="hidden" class="form-control" id="idcliente_buscar">
                              <button type="button" class="btn btn-dark" onclick="listar_pedidos_buscar_cli();" id="btn_buscar_cli"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>


                              
                              <input type="number" class="form-control" id="no_control_buscar" placeholder="Buscar control">
                              <button type="button" class="btn btn-dark" id="btn_buscar_control" onclick="listar_pedidos_buscar();"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                              <button type="button" class="btn btn-dark" id="" onclick="listar_pedidos();"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button> 
                            </div>
                              

                            <div class="btn-group">
                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Filtrar por:
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="filtro_option1();">Todo</a>
                                <a class="dropdown-item" href="#" onclick="filtro_option2();">Entregado</a>
                                <a class="dropdown-item" href="#" onclick="filtro_option3();">Sin Entregar</a>
                                <a class="dropdown-item" href="#" onclick="filtro_option4();">Apartado</a>
                                <a class="dropdown-item" href="#" onclick="filtro_option5();">Fabricado</a>
                                <a class="dropdown-item" href="#" onclick="filtro_option6();">Existencia</a>
                                <a class="dropdown-item" href="#" onclick="filtro_option7();">Cancelado</a>
                                <a class="dropdown-item" href="#" onclick="filtro_option8();">Pendiente</a>
                                <a class="dropdown-item" href="#" onclick="filtro_option9();">Listo para entrega</a>
                              </div>
                            </div> 


                            
                        </div>

                        <div class="form-group col-md-12 col-sm-12" align="right">
                              <div class="btn-group" id="result_cli">
                                
                                  <select class="select2_multiple form-control" multiple="multiple" id="box_select_cliente">
                                    
                                  </select>
                               
                              </div>
                        </div>
                       
                        

                    </div>

                          
                  </div>
                                
                </div>
              </div>
            </div>

          


              <!--<div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-align-left"></i> Collapsible / Accordion <small>Sessions</small></h2>
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
                  <div class="x_content" style="overflow:scroll;height:500px;width:100%;">

                   
                    <div id="box_pedidos2" class="col-md-12 col-sm-12">
                          
                    </div>
                    


                  </div>
                </div>
              </div>-->



            <div class="row" id="select_product_area2">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
               

                  <div class="x_content" style="overflow:scroll;height:500px;width:100%;">


                    <div id="box_pedidos" class="col-md-12 col-sm-12">
                          
                    </div>

                  </div>
               </div>
             </div>
           </div>

          



            <div class="row" id="select_product_area">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
               

                  <div class="x_content">

                    

                    <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                              <div class="x_title">
                                
                                
                                
                                    <!--<div class="form-group col-md-6 col-sm-12">
                                      <label>Ordenar por:</label>
                                      <select  class="form-control" id="marca_list_ped" onchange="listar_pedidos();">
                                        <option value="1">Fecha de pedido: Primero el más reciente</option>
                                        <option value="2">Numero de control: De mayor a menor</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                      <label>Filtrar por:</label>
                                      <select  id="option_estatus" class="form-control selectpicker" onclick="cambiar_filtro_select();">
                                        <option value="3">Sin Entregar</option>
                                        <option value="2">Entregado</option>
                                        <option value="4">Apartado</option>
                                        <option value="5">Fabricado</option>
                                        <option value="6">Existencia</option>
                                        <option value="7">Cancelado</option>
                                        <option value="8">Pendiente</option>
                                        <option value="1">Todos</option>                                         
                                      </select>             
                                    </div>-->
                                
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content" style="overflow:scroll;height:500px;width:100%;">
                                  <div class="row">
                                      <div class="col-sm-12">
                                        <div class="card-box table-responsive">
                                          <input type="hidden" class="form-control" id="estatus_tabla" value="3"> 
                                          <table id="datatable_buttons" class="table table-hover table-fixed">
                                            
                                          </table>
                                      </div>
                                    </div>
                                    
                                    
                                  </div>

                                  <style type="text/css">
                                   

                                  </style>
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
            

      </div>
    </div> 


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_seguim_ped">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">SEGUIMIENTO INTERNO DE PEDIDO</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">

                                    
                                    <div class="col-md-12 col-sm-12">
                                      <h5>Registrar comentario</h5>
                                    </div>
                                    <div class="col-md-12 col-sm-12" id="new_coment">
                                        

                                             

                                            <div class="col-md-2 col-sm-3" id="btn_entregado">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #0BF6BF; color: black; border-radius: 10px;">                  
                                                    <i class="fa fa-inbox" onclick="pasar_texto1();"></i>Entregado
                                                  </a>
                                                  
                                                </li>
                                              </ul>
                                            </div>

                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #7E0CA8; color: white; border-radius: 10px;">                  
                                                    <i class="fa fa-inbox" onclick="pasar_texto5();"></i>Entregado*
                                                  </a>
                                                  
                                                </li>
                                              </ul>
                                            </div>

                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #EE3676; color: white; border-radius: 10px;">                  
                                                    <i class="fa fa-inbox" onclick="pasar_texto2();"></i>Apartado
                                                  </a>
                                                  
                                                </li>
                                              </ul>
                                            </div>

                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #EF83A9; color: white; border-radius: 10px;">                  
                                                    <i class="fa fa-inbox" onclick="pasar_texto8();"></i>Apartado P.
                                                  </a>
                                                  
                                                </li>
                                              </ul>
                                            </div>

                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #FCE347; color: black; border-radius: 10px;">                  
                                                    <i class="fa fa-inbox" onclick="pasar_texto3();"></i>Fabricado
                                                  </a>
                                                  
                                                </li>
                                              </ul>
                                            </div>


                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #F56630; color: black; border-radius: 10px;">                  
                                                    <i class="fa fa-inbox" onclick="pasar_texto4();"></i>Existencia
                                                  </a>
                                                  
                                                </li>
                                              </ul>
                                            </div>


                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #09A004; color: white; border-radius: 10px;">                  
                                                    <i class="" onclick="pasar_texto9();">Listo para entrega</i>
                                                  </a>
                                                  
                                                </li>
                                              </ul>
                                            </div>

                                            

                                            

                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #BF0E13; color: white; border-radius: 10px;">                  
                                                    <i class="fa fa-inbox" onclick="pasar_texto6();"></i>Cancelado
                                                  </a>
                                                  
                                                </li>
                                              </ul>
                                            </div>

                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #FFFFFF; color: black; border-radius: 10px;">                  
                                                    <i class="fa fa-inbox" onclick="pasar_texto7();"></i>Otro
                                                  </a>
                                                  
                                                </li>
                                              </ul>
                                            </div>


                                        <!--<div class="col-md-12 col-sm-12">

                                            <label>Color:</label>
                                            <select  class="form-control" id="color" onchange="pasar_texto();">

                                              <option value="">Select</option>
                                              <option style="background: #0BF6BF;" value="0BF6BF">ENTREGADOS EN TIEMPO</option>
                                              <option style="background: #EE3676;" value="EE3676">PARA APARTADO EN PRODUCTO TERMINADO</option>
                                              <option style="background: #FCE347;" value="FCE347">ENTREGADO DE PRODUCCION</option>
                                              <option style="background: #FF670B;" value="FF670B">EXISTENCIA DE ALMACEN</option>
                                              <option style="background: #7E0CA8;" value="7E0CA8">PEDIDO ENTREGADO CON RETRASO</option>
                                              <option style="background: #BF0E13;" value="BF0E13">PEDIDO CANCELADO</option>
                                              <option style="background: #FFFFFF;" value="FFFFFF">OTRO</option>
                                              
                                            </select>
                                        </div>-->
                                        <div class="col-md-12 col-sm-12">
                                          <label style="color: white;">_</label>
                                        </div>

                                        <div class="col-md-12 col-sm-12">
                                            <div class="col-md-10 col-sm-10">
                                                  <label>Comentario</label>
                                                  <input type="text" class="form-control" id="coment_ped" disabled="">
                                                  <input type="hidden" class="form-control" id="coment_ped_motivo" disabled="">
                                                  <input type="hidden" class="form-control" id="estatus">
                                                  <input type="hidden" class="form-control" id="color">
                                                  <input type="hidden" class="form-control" id="idpedido">
                                                  <input type="hidden" class="form-control" id="porc_av_p">
                                                  
                                                </div>
                                                <div class="col-md-2 col-sm-2">
                                                  <label>Color</label>
                                                  
                                                  
                                                  <h2 id="color2">.</h2>
 
                                            </div>
                                            
                                        </div>

                                        
                                        <div align="center">
                                          <label>_</label>
                                        </div>
                                        
                                        <div class="col-md-12 col-sm-12" align="center">
                                          <button type="button" class="btn btn-primary" onclick="guardar_coment_ped();" id="">Guardar</button>
                                        </div>

                                    </div>

                                    <div align="center">
                                          <label>_</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <h5>Seguimiento</h5>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                          
                                          <table id="tbl_seguim_ped" class="table table-hover">
                                            
                                          </table>
                                    </div> 
                                        
                                    
                                        


                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div>


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_doc_ped">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">DOCUMENTOS DEL PEDIDO</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">

                                    
                                    <div class="col-md-12 col-sm-12">
                                     
                                    </div>
                                    <div class="col-md-12 col-sm-12" id="new_doc">
                                        <div class="col-md-12 col-sm-12">
                                          
                                          <h6>* El nombre del archivo no debe contener caracteres especiales, ejemplo: (#,%*..)</h6>
                                          <label>__</label>
                                        </div>
                                        <br>
                                        <div class="col-md-12 col-sm-12">
                                          
                                          
                                          <label>Adjuntar</label>
                                          <form name="formulario-envia_comprobante" id="formulario-envia_comprobante" enctype="multipart/form-data" method="post">

                                            
                                            <div class="form-group col-md-6 col-sm-6">
                                              <input type="file" name="ar_comprob" id="ar_comprob" onchange="" >
                                              <input type="hidden" name="idpedido_doc" id="idpedido_doc" onchange="" >
                                            </div>
                                            <div class="form-group col-md-4 col-sm-4" align="right">
                                              
                                              <select id="tipo_doc" class="form-control selectpicker">
                                                 <option value="">Tipo</option>
                                                 <option value="0">Anexo</option>
                                                 <option value="1">Factura|Recibo</option>
                                                 
                                              </select>
                                            </div>
                                            <div class="form-group col-md-2 col-sm-2" align="right">
                                              <button id="btn_comprob" type="button" class="btn btn-primary" onclick="cargar_doc();">Cargar</button>
                                              <!--<button id="btn_comprob" type="button" class="btn btn-dark" onclick="marcar_sindocs();">Sin Docs.</button>-->
                                            </div> 
                                              
                                                                                                        
                                          </form>
                                          
                                        </div>
                                       

                                    </div>

                                    <div align="center">
                                          <label>_</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <h5>Documentos</h5>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                          
                                          <table id="tbl_doc_ped" class="table table-hover">
                                            
                                          </table>

                                          
                                    </div>
                                    
                                        
                                    
                                        


                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-success" id="regresar_listos" onclick="abrir_listos();">Regresar</button>
                          <button type="button" class="btn btn-success" id="regresar_total" onclick="abrir_terminados();">Regresar</button>

                          
                        </div>

                      </div>
      </div>
    </div> 



    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_seguimiento_prod">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">PRODUCTOS EN PRODUCCIÓN</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">

                                    
                                  

                                    <div class="col-md-12 col-sm-12">
                                          
                                          <table id="tbl_seguim_prod" class="table table-hover" style="width: 2500px;">
                                            
                                          </table>

                                          

                                    </div>
                                    
                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          
                        </div>

                      </div>
      </div>
    </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_seguimiento_prod2">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">PRODUCTOS FABRICADOS</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">

                                    
                                  

                                    <div class="col-md-12 col-sm-12">
                                          
                                          <table id="tbl_seguim_prod2" class="table table-hover" style="width: 3000px;">
                                            
                                          </table>

                                          

                                    </div>
                                    
                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div>

     <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_observ_ped">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Observaciones</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">

                                    <div class="col-md-12 col-sm-12">
                                        
                                        <h4 id="control_pedid_boot"></h4>  

                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        
                                        <h3 id="observ_pedid_boot"></h3>  

                                    </div>
                                     <div class="col-md-12 col-sm-12">
                                        
                                        <h3 id="detform_pedid_boot"></h3>  

                                    </div>

                                    
                        </div>

                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>
                        

                      </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_terminados">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          
                          <h5>Pedidos Terminados - Listos para entrega</h5>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 600px;">

                                <div class="card-box table-responsive" id="box_terminados">

                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" id="tbl_terminados" >
                          
                                  </div>
                                        
                                </div>

                                
                                    
                        </div>

                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          
                          

                          
                        </div>
                        

                      </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_salidas">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Salidas</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>

                    
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="" id="" >
                          <hr width="100%">
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="" id="" >
                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="left" id="box_salidas2" >                        
                            
                          </div>

                         

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="" id="" >
                              <label>ENTREGAS</label>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="" id="box_entregas" >
                              
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="" id="" >
                              <label>DETALLE DE ENTREGA</label>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="" id="" >
                              <textarea class="form-control" id="dir_entrega" cols="40" rows="2" onkeyup=""></textarea>
                          </div>
                                              

                        </div>

                          

                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 600px;">

                                
                                <div class="card-box table-responsive">
                                  <table id="tbl_salidas_entregas" class="table table-hover">             
                                  </table>
                                </div>

                                  
                                    
                        </div>

                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          
                          

                          
                        </div>
                        

                      </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_listos">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Pedidos Terminados</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>

                        

                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">


                               <!-- <table id="tbl_listos" class="table table-hover">
                                  
                                </table>-->

                                <div class="card-box table-responsive" id="">

                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" id="tbl_listos" >
                          
                                  </div>
                                        
                                </div>
                                    
                        </div>

                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          
                        </div>
                        

                      </div>
      </div>
    </div>


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_pedidos_atencion">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Productos de pedido sin revisar</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>

                        

                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">


                                <table id="tbl_pedidos_pendientes" class="table table-hover">
                                  
                                </table>
                                    
                        </div>

                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          
                        </div>
                        

                      </div>
      </div>
    </div>

     <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_vencidos">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Pedidos Vencidos</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>

                          


                        </div>
                        <div class="modal-body">

                                    <div class="form-group col-md-2 col-sm-2" align="right">
                          
                                      <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                          aria-haspopup="true" aria-expanded="false">
                                          Filtrar por:
                                        </button>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item" href="#" onclick="pedidos_vencidos2();">Sin entregar</a>
                                          <a class="dropdown-item" href="#" onclick="pedidos_vencidos3();">Entregados</a>
                                        </div>
                                      </div> 

                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 300px;">
                                          
                                          
                                          <table id="tbl_vencidos" class="table table-hover">
                                            
                                          </table>
                                    </div>
                                   


                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div> 

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_select_salida">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Seleccionar salida</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                          <div class="form-group col-md-12 col-sm-12" align="">
                            <div class="form-group col-md-12 col-sm-12" id="box_salidas_select">

                            </div>
                          </div>

                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-primary">Regresar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
    </div>


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_ventana_salidas">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel"></h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 600px;">
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>PRODUCTOS SELECCIONADOS</label>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <b id="no_control_ent"></b><br>
                                <b id="cliente_ent"></b><br>
                                <b id="direccion_ent"></b>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5; overflow:scroll;height:150px; max-height: 300px;">
                            <table id="box_prod_pasar" class="table table-hover" style="width: 1000px;">

                            </table>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr width="100%">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <label>SELECCIONAR SALIDA</label>
                              <input type="hidden" class="form-control" id="idpedido_salida">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right" id="div_eti_salida">
                              
                              <a href="#" onclick="nueva_salida();">Nueva salida</a>
                            </div>
                            
                           <!-- <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="left" id="box_salidas5" style="border:0px solid #e5e5e5; overflow:scroll;width: 0px; height:200px; visibility: hidden;">
                            
                            </div>-->
                            <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Seleccionar salida:</label>
                                <select  id="select_salida" class="form-control selectpicker" onchange="ver_entregas2();">
                                                                               
                                </select>
                                
                            </div>
                            <div class="form-group col-md-12 col-sm-12" align="">
                                <hr width="100%">
                            </div>
                          </div>
                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" style="">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <label>SELECCIONAR ENTREGA</label>
                              <input type="hidden" class="form-control" id="idsalida">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right" id="div_eti_entrega">
                              
                              <a href="#" onclick="nueva_entrega();">Nueva entrega</a>
                            </div>
                            
                            <!--<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="left" id="box_entregas5" style="border:0px solid #e5e5e5; overflow:scroll; width: 0px; height:200px; visibility: hidden;">
                            
                            </div>-->
                            <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Seleccionar entrega:</label>
                                <select  id="select_entrega" class="form-control selectpicker" onchange="ver_productos2();">
                                                                               
                                </select>
                                
                            </div>
                            <div class="form-group col-md-12 col-sm-12" align="">
                                <hr width="100%">
                            </div>
                          </div>
                         
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">

                            
                            <div class="form-group col-md-12 col-sm-12" align="">
                                <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Agregar productos a entrega" onclick="pasar_productos();">Agregar productos</button>
                            </div>
                            <div class="form-group col-md-12 col-sm-12" align="">
                                <hr width="100%">
                            </div>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="productos_entrega">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <label>DETALLE DE ENTREGA</label>
                              <input type="hidden" class="form-control" id="identrega">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             
                                <b id="numero_entrega"></b><br>
                                <b id="contacto_ent2"></b><br>
                                <b id="direccion_ent2"></b>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5; overflow:scroll;height:250px;">
                              <table id="box_productos5" class="table table-hover">
                                              
                              </table>
                            </div>
                            
                                <div class="btn-group" id="btn_opciones_vales">
                                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Opciones
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Solicitar a almacén</a>
                                    <a class="dropdown-item" href="#" id="enlace_vale_alm" onclick="abrir_vale_alm();" target="_blank">Salida a almacén</a>
                                    <a class="dropdown-item" href="#" id="enlace_vale" onclick="abrir_vale();" target="_blank">Salida de mercancia</a>
                                    
                                  </div>
                                </div>
                                
                                
                           
                          </div>
                            
                                    
                        </div>

                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                          
                        </div>
                        

                      </div>
      </div>
    </div>

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
                              </div>
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Hora de salida:</label>
                                <input type="time" class="form-control" id="hora_salida_new_s">
                              </div>
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Chofer:</label>
                                <select  id="select_chofer" class="form-control selectpicker">
                                                                               
                                </select>
                                
                              </div>
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Vehículo:</label>
                                <select  id="select_vehiculo" class="form-control selectpicker">
                                                                               
                                </select>
                                
                              </div>
                              
                             
                              
                            </div>
                          

                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-primary" onclick="guardar_salida();">Guardar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>

                      </div>
                    </div>
    </div> 


    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_select_entrega">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Seleccionar entrega</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_nueva_entrega">
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Contacto:</label>
                                <input type="text" class="form-control" id="contacto_new_e">
                              </div>
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Dirección de entrega:</label>
                                <textarea class="form-control" id="dir_entrega_new_e" cols="40" rows="8" onkeyup=""></textarea>
                              </div>
                               
                            </div>

                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-primary" onclick="guardar_entrega();">Guardar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_coment_prod">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Observaciones de producción</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>

                          


                        </div>
                        <div class="modal-body">

                                  
                                    
                                    <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 300px;">
                                          <label>Observaciones producción</label>
                                          <table id="tbl_coment_prod" class="table table-hover">
                                            
                                          </table>
                                          <label>Observaciones de OP</label>
                                          <table id="tbl_coment_op" class="table table-hover">
                                            
                                          </table>
                                    </div>
                                   


                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div>   
                
    <script src="../vendors/jquery-knob/dist/jquery.knob.min.js"></script>
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
    <script type="text/javascript" src="scripts/diseno.js?v=<?php echo(rand()); ?>"></script>
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