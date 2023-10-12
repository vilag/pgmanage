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
if ($_SESSION['administrador']==1 || $_SESSION['Administrativo']==1)
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

          
            <div class="row" id="">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
               

                  <div class="x_content"></div>

                  <div class="col-md-12 col-sm-12 ">
                    <h1>Control interno</h1>
                  </div>

                  <div class="col-md-12 col-sm-12 ">
                    <button type="button" class="btn btn-secondary">Nuevo</button>
                  </div>

                  <div class="col-md-12 col-sm-12 ">
                    <table id="" class="table table-hover">


                                            
                    </table>
                  </div>

                  <div class="col-md-12 col-sm-12 " id="detalle_control">
                    <div class="col-md-12 col-sm-12 ">
                      <b id="nombre_control"></b>
                    </div>
                    <div class="col-md-12 col-sm-12 ">
                      <textarea class="form-control" id=""></textarea>
                      <p id="detalle_control_p"></p>
                    </div>
                    <div class="col-md-12 col-sm-12 ">
                      <button type="button" class="btn btn-secondary">Guardar detalle</button>
                    </div>
                    <div class="col-md-12 col-sm-12 ">
                      <div class="col-md-12 col-sm-12 ">
                        <button type="button" class="btn btn-secondary">Agregar acciones</button>
                      </div>
                      <div class="col-md-12 col-sm-12 ">
                        <table id="" class="table table-hover">                       
                        </table>
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

    


    
              
    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <script src="vendors/pnotify/dist/pnotify.js"></script>
    <script src="vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="vendors/pnotify/dist/pnotify.nonblock.js"></script>

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
    <script src="build/js/custom.min.js"></script>
    <script type="text/javascript" src="scripts/control_interno.js?v=<?php echo(rand()); ?>"></script>
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