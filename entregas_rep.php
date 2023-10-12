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





            <div class="row" id="area_inicial">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">      

                    <div class="clearfix"></div>
                    <div class="x_content">

                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="button" class="btn btn-primary" onclick="">Guardar</button>
                            
                          </div>

                         
                          
                          
                         

                    </div>      
                  </div>
                                
                </div>
              </div>
            </div>


            


          </div>

        </div>
        <!-- /page content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_entregas">
          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Entregas</h4>
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                            </div>

                            

                            <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">


                              

                                <div class="card-box table-responsive" id="">

                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" id="box_entregas5" >
                          
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
    <script type="text/javascript" src="scripts/entregas_rep.js?v=<?php echo(rand()); ?>"></script>
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