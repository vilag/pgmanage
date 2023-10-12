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
if ($_SESSION['administrador']==1 || $_SESSION['Produccion']==1 || $_SESSION['Administrativo']==1 || $_SESSION['consulta1']==1)
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
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                          ORDENES DE PRODUCCIÓN / <b id="nom_area"></b> <b id="id_area"></b>
                        </div>
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                          <div class="btn-group">
                            <input type="number" class="form-control" id="op_buscar_area" placeholder="Buscar OP" style="border-style: none; border-bottom: groove;">
                              <button type="button" class="btn" id="" onclick="buscar2();"><span class="glyphicon glyphicon-search" aria-hidden="true" style="color: black;"></span></button>
                              <button type="button" class="btn" id="" onclick="cargar_ops();"><i class="fa fa-refresh"></i></button>
                          </div>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2" align="right"> 
                          <a href="#" onclick="regresar_a_prod()"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar</a>
                          <hr width="100%">
                          <input type="hidden" class="form-control" id="num_vista"> 
                        </div>
                        

                          
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_detalle_op">
                           <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <p>OP: <b id="no_op_enc"></b>, Cantidad Total: <b id="cant_tot_enc"></b>, Avance: <b id="avance_tot_enc"></b></p>
                            <input type="hidden" class="form-control" id="idop_detalle"> 
                            <input type="hidden" class="form-control" id="idop"> 
                            <input type="hidden" class="form-control" id="area_fin">  
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4" align="right">
                              <button type="button" class="btn btn-primary" onclick="">Avances</button>
                              <button type="button" class="btn btn-primary" onclick="">Excedentes</button>
                          </div>
                          <br>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr width="100%">
                          </div>
                          
                        </div>
                       
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_detalle_prod">
                          <p><b id="codigo_enc" style="font-size: 20px;"></b><br> <label id="descrip_enc"></label></p>
                          <p style="margin-top: -10px;">Requeridos: <b id="cant_enc"></b>, Avance: <b id="avance_enc"></b></p>
                          Control: <b id="no_control_enc"></b>
                          <hr width="100%">
                          <input type="hidden" class="form-control" id="idop_detalle_prod">
                          <input type="hidden" class="form-control" id="idpedido">
                          <input type="hidden" class="form-control" id="iddetalle_pedido">
                          <input type="hidden" class="form-control" id="idpg_detped_av">
                        </div>
                        
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_detalle_prod_av">

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="cant_ingresar_div">
                            <label>Cantidad a ingresar</label>
                            <input type="number" class="form-control" id="cant_ingresar_enc" onchange="calcular_avance();">
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="exc_ingresar_div">
                            <label>Excedente a ingresar</label>
                            <input type="number" class="form-control" id="cant_ingresar_enc_exc">

                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Lote</label>
                            <input type="number" class="form-control" id="lote">
                            <input type="hidden" class="form-control" id="marca_capt_cant">
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="">
                            <label>Comentario</label>
                            <input type="text" class="form-control" id="coment_avance">
                          </div>
                          <!--<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Empacado</label>
                            <select  id="option_empaque" class="form-control selectpicker" >  
                                <option value="">Seleccionar</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>                                          
                            </select> 
                          </div>-->
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="button" class="btn btn-primary" onclick="guardar_avance();" id="btn_guardar_avance">Guardar</button>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Tabla de avances</label>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Tabla de excedentes</label>
                          </div>
                        </div>
                          
                          
                          
                      <div class="clearfix"></div>
                      <div class="x_content">

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr width="100%">
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="box_ops" style="overflow-y: scroll; height: auto; max-height: 100vh;">
                            
                          </div>

                         

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="box_ops_detalle" style="overflow-y: scroll; height: auto; max-height: 100vh;">
                            
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
                          
                          <button type="button" class="btn btn-primary" onclick="guardar_salida();">Guardar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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
    <script type="text/javascript" src="scripts/produccion.js?v=<?php echo(rand()); ?>"></script>
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