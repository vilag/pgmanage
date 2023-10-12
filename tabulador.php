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
                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <h5>Estimacion de materia prima</h5>
                                                  </div>

                                                  

                                                </div>
                                                <!--<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Ordenes de producción" onclick="mostrar_op();" id=""><span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span></button>
                                                    <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Productos" onclick="listar_productos_op();" id=""><span class="glyphicon glyphicon-record" aria-hidden="true"></span></button>
                                                  </div>
                                                </div>-->


                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_op">
                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="left">

                                                        <div class="btn-group">
                                                          <input type="text" class="form-control" id="buscar_prod" placeholder="Buscar Código">
                                                          <button type="button" class="btn btn-dark" id="btn_buscar_op" onclick="listar_material_prod();"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                                          
                                                        </div>

                                                        <div class="btn-group">
                                                          
                                                          <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Agregar materia prima" onclick="listar_materiales();" id=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                                          
                                                        </div>

                                                        
                                                        

                                                  </div>
                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <hr width="100%">
                                                  </div>

                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-4 col-sm-4 ">
                                                      
                                                  
                                                             
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 ">
                                                      <div class="col-md-12 col-sm-12 ">
                                                        <input type="hidden" class="form-control" id="idproducto">
                                                        <input type="hidden" class="form-control" id="idgroup">
                                                        Codigo: <br><label id="codigo"></label><br>
                                                        Descripción: <br><label id="nombre"></label><br>
                                                      </div>
                                                      <div class="col-md-12 col-sm-12 ">
                                                      </div>
                                                  
                                                             
                                                    </div>
                                                    
                                                    <div class="col-md-4 col-sm-4 ">

                                                      Tipo: <label id="tipo"></label><br>
                                                      Subtipo.: <label id="subtipo"></label><br>
                                                      Modelo.: <label id="modelo"></label><br>
                                                      Submodelo: <label id="submodelo"></label><br>
                                                      Tamaño: <label id="tamano"></label><br>

                                                    </div>
                                                    <div class="col-md-12 col-sm-12 ">
                                                      <hr width="100%">
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 ">
                                                      <h3>Lista de materiales</h3>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 ">
                                                      <table class="table table-striped" id="tbl_material_prod" style="width: auto; width: 100%;">
                                                      </table>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 ">
                                                      <h3>Calculo por tramo</h3>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 ">
                                                      <table class="table table-striped" id="tbl_material_prod_calc" style="width: auto; width: 100%;">
                                                      </table>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 ">
                                                      <h3>Calculo por cantidad de producto</h3>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 ">
                                                      <div class="btn-group">
                                                          <input type="number" class="form-control" id="cantidad_prod" placeholder="Cantidad">
                                                          <button type="button" class="btn btn-dark" id="btn_buscar_op" onclick="calcular_cantidad_prod();"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                                          
                                                      </div>
                                                    </div>

                                                    <div class="col-md-12 col-sm-12 ">
                                                      <table class="table table-striped" id="tbl_material_prod_calc_num" style="width: auto; width: 100%;">
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
        <!-- /page content -->   

      </div>
    </div> 


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_mat">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 600px;">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Lista de materiales</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">

                          <div class="col-md-12 col-sm-12">

                            <table class="table table-striped" id="tbl_material" style="width: auto; width: 100%;">
                            </table>
                                              
                          </div>
                                   


                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div>

     
              
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
    <script type="text/javascript" src="scripts/tabulador.js?v=<?php echo(rand()); ?>"></script>
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