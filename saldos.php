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
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1)
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

                    

                                <div class="col-md-12 col-sm-12 ">
                                        <div class="x_panel">
                                        <div class="x_title">
                                
                                        <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content" style="overflow:scroll;height:500px;width:100%;">
                                          <div class="row">
                                              <!--<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                  <label>Buscar:</label>
                                                  <input type="text" class="form-control" id="text_buscar" onkeyup="buscar_texto_tbl();" autocomplete="off">
                                                             
                                              </div>-->
                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                   
                                                  <button type="button" class="btn " onclick="nuevo_pedido();" id=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                                  <button type="button" class="btn " onclick="" id=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>                 
                                              </div>
                                              <div class="col-sm-12">
                                                <div class="card-box table-responsive">

                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" id="box_pedidos">
                          
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


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_nuevo_pedido">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h5 id="titulo">NUEVO PEDIDO</h5>
                          </div>    
                           
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:500px;">

                                <div class="col-md-12 col-sm-12 ">
                                       
                                        <div class="x_title" id="titulo_modal">
                                             <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">
                                               <h3 id="no_pedido"></h3>
                                             </div>
                                             
                                             <input id="marca_consulta" type="hidden" class="form-control">
                                             <button type="button" class="btn btn-dark" onclick="ver_carga_prod();" id="btn_prod"><i class="fa fa-cube"></i></button>
                                             <!--<button type="button" class="btn btn-dark" onclick="abrir_mod_cliente();" id=""><span class="glyphicon glyphicon-user" aria-hidden="true" style="color: white;"></span></button>-->
                                             <button type="button" class="btn btn-dark" onclick="abrir_mod_facturacion();" id="btn_dir_fac"><i class="fa fa-file-text-o"></i></button> 
                                             <button type="button" class="btn btn-dark" onclick="abrir_mod_entrega();" id="btn_dir_ent"><i class="fa fa-truck"></i></button>  
                                             <a href="#" id="enlace_saldos" target="_blank" onclick="imprimir_pedsal();">
                                                              <button type="button" class="btn btn-dark"><span class="glyphicon glyphicon-print" aria-hidden="true" style="color: white;"></span></button>
                                             </a>

                                             <div class="clearfix"></div>


                                        </div>
                                        <div class="x_content">

                                          <div class="row" id="options_buscar">

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">

                                                        <button id="" type="button" class="btn btn-dark" onclick="capturar_nuevo();">Nuevo</button>
                                                        <button id="" type="button" class="btn btn-dark" onclick="vincular_ped();">Vincular</button>
                                                        <button id="" type="button" class="btn btn-dark" onclick="buscar_razon();">Buscar</button>
                                                    

                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="buscar_dir_nocontrol">
                                                    <div class="input-group">
                                                      <input id="texto_buscar_nocontrol" type="text" class="form-control" placeholder="Buscar No. Control" onkeyup="mostrar_control();">
                                                      
                                                    </div>
                                                    <div class="btn-group" id="result_dir3">
                                                        <select class="select2_multiple form-control" multiple="multiple" id="box_select_control">    
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="buscar_dir_sal">
                                                    <div class="input-group">
                                                      <input id="texto_buscar2" type="text" class="form-control" placeholder="Buscar Cliente o Razón Social" onkeyup="mostrar_facturacion();">
                                                      
                                                    </div>
                                                    <div class="btn-group" id="result_dir2">
                                                        <select class="select2_multiple form-control" multiple="multiple" id="box_select_dir2">    
                                                        </select>
                                                    </div>
                                                </div>

                                                

                                          </div>

                                          <div class="row" id="row_productos">

                                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                 <button type="button" class="btn btn-dark" onclick="nuevo_detalle_saldo();" id="btn_mas"><span class="glyphicon glyphicon-plus" aria-hidden="true" style="color: white;"></span></button>
                                                  
                                              </div>
                                            
                                              <input type="hidden" class="form-control" id="idsaldos" value="" disabled=""> 
                                              <div class="col-sm-12">
                                                <div class="card-box table-responsive">

                                                  <table id="tbl_saldos_detalle_new" class="table table-hover">
                                                    
                                                  </table>
                                        
                                                </div>
                                              </div>
   
                                          </div>


                                          <div class="row" id="">
                                            <br>
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                              <h4 id="etiqueta"></h4>
                                            </div>
                                            
                                          </div>


                                          <div class="row" id="row_entrega">
                                            
                                               

                                                <hr width="100%" style="color: white;">

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  <h4>Datos de entrega</h4>
                                                </div>
                                                
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label>Contacto:</label>
                                                    <input type="text" class="form-control" id="contacto_s" value="">
                                                    <input type="hidden" class="form-control" id="marcador" value="0">
                                                    <input type="hidden" class="form-control" id="idsaldo_entregas" value="">    
                                                </div>

                                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <label>Calle:</label>
                                                    <input type="text" class="form-control" id="calle_s" value="">
                                                </div>
                                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                    <label>Numero:</label>
                                                    <input type="text" class="form-control" id="numero_s" value="">
                                                </div>
                                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                    <label>Interior:</label>
                                                    <input type="text" class="form-control" id="interior_s" value="">
                                                </div>
                                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <label>Colonia:</label>
                                                    <input type="text" class="form-control" id="colonia_s" value="">
                                                </div>
                                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <label>Ciudad:</label>
                                                    <input type="text" class="form-control" id="ciudad_s" value="">
                                                </div>
                                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <label>Estado:</label>
                                                    <input type="text" class="form-control" id="estado_s" value="">
                                                </div>
                                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <label>CP:</label>
                                                    <input type="text" class="form-control" id="cp_s" value="">
                                                </div>
                                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <label>Email:</label>
                                                    <input type="text" class="form-control" id="email_s" value="">
                                                </div>
                                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <label>Teléfono:</label>
                                                    <input type="text" class="form-control" id="telefono_s" value="">
                                                </div>
                                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <label>Fecha de entrega:</label>
                                                    <input type="date" class="form-control" id="fecha_entrega_s" value="">
                                                </div>
                                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <label>Horario de entrega inicial:</label>
                                                    <input type="time" class="form-control" id="horario_entrega_s" value="">
                                                </div>
                                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <label>Horario de entrega final:</label>
                                                    <input type="time" class="form-control" id="horario_entrega_s2" value="">
                                                </div>
                                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <label>Forma de entrega:</label>
                                                    <input type="text" class="form-control" id="forma_entrega_s" value="">
                                                </div>
                                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <label>Detalles de forma de entrega:</label>
                                                    <input type="text" class="form-control" id="det_form_entrega_s" value="">
                                                </div>
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label>Comentario:</label>
                                                    <textarea class="form-control" id="comentario_s" cols="40" rows="3" onkeyup=""></textarea> 
                                                </div>


   
                                          </div>

                                          <div class="row" id="row_facturacion">


                                                <hr width="100%" style="color: white;">

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  <h4>Datos de facturación</h4>
                                                </div>
                                                
                                                <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <label>Razón Social (Cliente):</label>
                                                    <input type="text" class="form-control" id="razon_f" value="">
                                                    
                                                    <input type="hidden" class="form-control" id="idsaldo_fact" value="">
                                                    <input type="hidden" class="form-control" id="idpedido" value="">
                                                      
                                                </div>

                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <label>R.F.C.:</label>
                                                    <input type="text" class="form-control" id="rfc_f" value="">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <label>Calle:</label>
                                                    <input type="text" class="form-control" id="calle_f" value="">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <label>Numero:</label>
                                                    <input type="text" class="form-control" id="numero_f" value="">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <label>Interior:</label>
                                                    <input type="text" class="form-control" id="interior_f" value="">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <label>Colonia:</label>
                                                    <input type="text" class="form-control" id="colonia_f" value="">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <label>Ciudad:</label>
                                                    <input type="text" class="form-control" id="ciudad_f" value="">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <label>Estado:</label>
                                                    <input type="text" class="form-control" id="estado_f" value="">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <label>CP:</label>
                                                    <input type="text" class="form-control" id="cp_f" value="">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <label>Email:</label>
                                                    <input type="text" class="form-control" id="email_f" value="">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <label>Teléfono:</label>
                                                    <input type="text" class="form-control" id="telefono_f" value="">
                                                </div>

   
                                          </div>


                                        </div>

                                        <hr width="100%">

                                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right" id="">

                                            <button id="btn_save" type="button" class="btn btn-primary" onclick="guardar_pedido();"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="color: #fff;"></span></button>

                                          </div>

                                        
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
    <script type="text/javascript" src="scripts/saldos.js?v=<?php echo(rand()); ?>"></script>
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