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
                                                    <h5>Productos en mas de una OP</h5>
                                                  </div>

                                                  

                                                </div>
                                              
                                               

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">


                                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" style="border:0px solid #e5e5e5; overflow:scroll;height:600px;">
                                                    <table id="tbl_prod_op" class="table table-hover table-fixed">
                                            
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
    <script type="text/javascript" src="scripts/correcciones.js?v=<?php echo(rand()); ?>"></script>
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