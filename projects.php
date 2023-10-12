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
                          <h6>OKR</h6>
                        </div>
                        <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10" align="right">
                          
                          <a href="#" onclick=""><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar</a>
                        </div>
                          
                          
                          
                      <div class="clearfix"></div>
                      <div class="x_content">


                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr width="100%">
                          </div>
                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_lista_salidas">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                              
                              <button id="" type="button" class="btn btn-success" onclick="abrir_nuevo_objetivo();">Nuevo objetivo</button>  
                            </div>

                           
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 500px;">
                              <table id="tbl_objetivos" class="table table-hover" style="width: 800px;">
                                                  
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
        <!-- /page content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_objetivo">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Nuevo objetivo</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Descripción:</label>
                                <textarea class="form-control" id="descrip_obj" cols="40" rows="5" onkeyup=""></textarea>
                              </div>
                              <div class="form-group col-md-6 col-sm-6" align="">
                                <label>Fecha inicial:</label>
                                <input type="date" class="form-control" id="fecha_ini_obj">
                              </div>
                              <div class="form-group col-md-6 col-sm-6" align="">
                                <label>Fecha final:</label>
                                <input type="date" class="form-control" id="fecha_fin_obj">
                              </div>
                            </div>
                            
                          

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" onclick="guardar_objetivo();">Guardar</button>
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
    <script type="text/javascript" src="scripts/projects.js?v=<?php echo(rand()); ?>"></script>
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