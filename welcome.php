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
            
            <div class="page-title" style="margin-bottom: 35px;">
              <h3>Indicadores</h3>
              
              
            </div>
                          
           
            <div class="clearfix"></div>

            <div class="row" id="area_inicial">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <div class="col-md-4 col-sm-4">

                                <label>Año:</label>
                                <!--<select  class="form-control" id="aplic_iva" onchange="pie_reporte();save_hist_iva();">-->
                                <select  class="form-control" id="anio_asign" onchange="select_anio();">
                                 
                               
                                                            
                                </select>

                            </div>

                            <div class="col-md-4 col-sm-4">

                                <label>Mes:</label>
                                <!--<select  class="form-control" id="aplic_iva" onchange="pie_reporte();save_hist_iva();">-->
                                <select  class="form-control" id="mes_asign" onchange="select_mes();">
                                
                                                            
                                </select>
                                
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4" align="right" style="padding-top: 25px;">
                                <b style="font-size: 30px; color: #ccc;" id="eti_fecha_ind"></b>
                            </div>

                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                          <div class="animated flipInY col-lg-12 col-md-12 col-sm-12  ">
                            <div class="tile-stats">
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                <p style="font-size: 30px;"><span>Pedidos</span><b id="eti_anio"></b></p>
                              </div>
                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3" align="center">
                                <p>Total de pedidos:<br> <b id="num_pedidos" style="font-size: 30px;"></b></p>
                              </div>
                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3" align="center">
                                <p>Pedidos terminados:<br> <b id="pedidos_terminados" style="font-size: 30px;"></b></p>
                              </div>
                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3" align="center">
                                <p>Entregados:<br> <b id="pedidos_entregados" style="font-size: 30px;"></b></p>
                              </div>
                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3" align="center">
                                <p>Cancelados:<br> <b id="pedidos_cancelados" style="font-size: 30px;"></b></p>
                              </div>
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                                <hr width="100%">
                              </div>
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                
                                <input type="hidden" id="consec_anio" value="1">
                                <div id="chart_pedidos">
                                </div>
                                <input type="hidden" id="anio_grafica_ped">
                              </div>

                            </div>
                          </div>

                              
                        </div>

                        

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          

                          <div class="animated flipInY col-lg-6 col-md-6 col-sm-6  ">
                            <div class="tile-stats">
                              
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               
                                <p style="font-size: 30px;"><span>Producción</span></p>

                              </div>
                             
                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <p>Programados para <span id="mes_selec_prod" style="color: black;"></span>: <b id="num_asign"></b></p>
                                <p>Fabricados en tiempo: <b id="num_entiempo"></b></p>
                                <p>Vencidos y Pendientes: <b id="num_vencidos"></b></p>
                                
                                
                              </div>
                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-top: -30px;">
                                <b style="font-size: 70px;" id="porc_ind"></b>
                              </div>
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff; text-align: left; height: 40px; padding-top: 10px;">
                                <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Ver tabla de resultados" onclick="abrir_tabla_ind_prod();"><i class="fa fa-table"></i></button>
                              </div>

                            </div>
                            
                          </div>
                          <div class="animated flipInY col-lg-6 col-md-6 col-sm-6  ">
                            <div class="tile-stats">
                              
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               
                                <p style="font-size: 30px;"><span>Embarques</span></p>

                              </div>
                             
                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <p>Terminados en <span id="mes_selec_emb" style="color: black;"></span>: <b id="num_entregar"></b></p>
                                <p>Entregado al siguiente dia: <b id="num_entiempo_emb"></b></p>
                                <p>Con retraso o pendientes: <b id="num_fuera_tiempo"></b></p>
                                <p>Con detalle externo: <b id="num_det_ent"></b></p>
                                
                                
                              </div>
                              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-top: -30px;">
                                <b style="font-size: 70px;" id="porc_ind_emb"></b>
                              </div>
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #fff; text-align: left; height: 40px; padding-top: 10px;">
                                <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Ver tabla de resultados" onclick="abrir_tabla_ind_emb();"><i class="fa fa-table"></i></button>
                              </div>

                            </div>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="chart_prod_emb">
                          </div>
                          <div class="animated flipInY col-lg-6 col-md-6 col-sm-6  ">
                            <div class="tile-stats">
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <br>
                                <label>Productos más vendidos en pedidos comerciales</label>
                              </div>
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 420px; width: 100%;">
                                <table id="tbl_cant_prod_com" class="table table-hover table-fixed" style="width: 100%;">

                                </table>
                              </div>
                            </div>
                          </div>

                          <div class="animated flipInY col-lg-6 col-md-6 col-sm-6  ">
                            <div class="tile-stats">
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <br>
                                <label>Productos más vendidos en pedidos por licitación</label>
                              </div>
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 420px; width: 100%;">
                                <table id="tbl_cant_prod_lic" class="table table-hover table-fixed" style="width: 100%;">

                                </table>
                              </div>
                            </div>
                          </div>
                         
                        </div>

                          

                        <!-- <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                          <div class="btn-group" id="buscador_control">
                                
                                <input type="text" class="form-control" id="no_control" placeholder="Buscar control">
                               
                                <button type="button" class="btn btn-dark" onclick="buscar_control();" id=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                <button type="button" class="btn btn-dark" onclick="set_idproducto();" id="">Set idproducto</button>

                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" id="box_avance">
                            
                          </div>

                        </div>-->

                          

                          

                    <div class="clearfix"></div>
                    <div class="x_content">

                        

                    </div>      
                  </div>
                                
                </div>
              </div>
            </div>


            


          </div>

        </div>
        <!-- /page content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_result_ind_prod">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Tabla de resultados</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">

                                        
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                      <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <select  class="form-control" id="estat_anios" onchange="listar_pedidos_ind_prod();">
                                          <option value="0">Pedidos vencidos o pendientes</option>
                                          <option value="1">Pedidos fabricados en tiempo</option>
                                        </select>
                                      </div>
                                      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <b style="font-size: 30px; color: #ccc;" id="eti_fecha_tbl_prod"></b>
                                      </div> 

                                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 420px;" id="div_tbl1">
                                        <table id="tbl_pedidos_ind_prod" class="table table-hover table-fixed" style="width: 100%;">
                                        </table>
                                        
                                      </div>
                                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 420px;" id="div_tbl2">
                                        <table id="tbl_pedidos_ind_prod_det" class="table table-hover table-fixed" style="width: 100%;">
                                        </table>
                                      </div>
                                      
                                        

                                      <div id="box_ops_det">
                                                            
                                      </div>
                                    </div>
                                     


                            </div>
                            <div class="modal-footer">
                              
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                              
                            </div>

                          </div>
          </div>
        </div>

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_result_ind_emb">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Tabla de resultados</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">

                                   
                                   <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 420px; width: 100%;">
                                        
                                      <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <select  class="form-control" id="estat_anios2" onchange="listar_pedidos_ind_emb();">
                                          <option value="0">Pedidos con restraso o pendientes</option>
                                          <option value="1">Pedidos entregados al dia siguiente</option>
                                        </select>
                                      </div>
                                      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                          <b style="font-size: 30px; color: #ccc;" id="eti_fecha_tbl_emb"></b>
                                      </div>
                                      
                                      <table id="tbl_pedidos_ind_emb" class="table table-hover table-fixed" style="width: 2000px;">
                                      </table>

                                      <div id="">
                                                              
                                      </div>
                                  </div>   
                                   

                            </div>
                            <div class="modal-footer">
                              
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                              
                            </div>

                          </div>
          </div>
        </div>


        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_detalle_pedido_ind">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Detalle de pedido</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">

                                   
                                   <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        No. Control: <b id="no_control_coment_vencim"></b>
                                        <input type="hidden" name="" id="idpedido">
                                      </div>
                                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Detalle de vencimiento</label>
                                        
                                        <textarea class="form-control" id="det_vencim" cols="40" rows="5"></textarea>
                                      </div>
                                     
                                  </div>   
                                   

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" onclick="guardar_coment_vencim();">Guardar</button>
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
    <script type="text/javascript" src="scripts/welcome.js?v=<?php echo(rand()); ?>"></script>
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