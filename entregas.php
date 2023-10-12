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

        <!-- page content -->
        <div class="right_col" role="main" id="page_pedido">

          <div class="">
            
            <div class="page-title">

              
              <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                  <div class="input-group">
                    
                  </div>
                </div>
              </div>
            </div>
                          
           
            <div class="clearfix"></div>
               
            <div class="row" id="select_product_area">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
               

                  <div class="x_content">

                    

                    <div class="col-md-12 col-sm-12" id="form_entregas">
                            <div class="x_panel">
                              <div class="x_title">
                                <h5>Detalle de entregas</h5>
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
                              <div class="x_content" style="overflow:scroll;height:100%;width:100%;">
                                  <div class="row col-md-12 col-sm-12">
                                    <div class="col-md-3 col-sm-3">
                                      <label>FECHA:</label>
                                      <input type="date" class="form-control" name="fecha_sal" id="fecha_sal">
                                      <input type="hidden" class="form-control" id="identregas">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>No. SALIDA:</label>
                                      <input type="text" class="form-control" name="no_salida_sal" id="no_salida_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>No. CONTROL:</label>
                                      <input type="text" class="form-control" name="no_control_sal" id="no_control_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>No. PEDIDO:</label>
                                      <input type="text" class="form-control" name="no_pedido_sal" id="no_pedido_sal">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>NOMBRE:</label>
                                      <input type="text" class="form-control" name="nombre_sal" id="nombre_sal">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>ENTREGADO A:</label>
                                      <input type="text" class="form-control" name="entregado_a_sal" id="entregado_a_sal">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>DOMICILIO:</label>
                                      <input type="text" class="form-control" name="domicilio_sal" id="domicilio_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>COLONIA:</label>
                                      <input type="text" class="form-control" name="colonia_sal" id="colonia_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>MUNICIPIO:</label>
                                      <input type="text" class="form-control" name="municipio_sal" id="municipio_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>ESTADO:</label>
                                      <input type="text" class="form-control" name="estado_sal" id="estado_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>C.P.:</label>
                                      <input type="text" class="form-control" name="cp_sal" id="cp_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>CONTACTO:</label>
                                      <input type="text" class="form-control" name="contacto_sal" id="contacto_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>TELEFONO:</label>
                                      <input type="text" class="form-control" name="telefono_sal" id="telefono_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>HORARIO:</label>
                                      <input type="text" class="form-control" name="horario_sal" id="horario_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>CONDICIONES:</label>
                                      <input type="text" class="form-control" name="condiciones_sal" id="condiciones_sal">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>MEDIO DE TRANSPORTE:</label>
                                      <input type="text" class="form-control" name="medio_sal" id="medio_sal">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>_</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      
                                      <button type="button" class="btn btn-round btn-info"  onclick="add_prod();">+</button>
                                    </div>

                                  </div>
                                  <div class="row col-md-12 col-sm-12">
                                      <div class="col-sm-12">
                                        
                                        <div class="card-box table-responsive">
                                          <label>Productos</label>
                                          <table id="datatable_prod_entregas" class="table table-hover">
                                            
                                          </table>
                                        </div>
                                      </div>
                                  </div>
                        </div>
                        <button type="button" class="btn btn-round btn-info"  onclick="save_entrega();">Guardar</button>
                            </div>
                    </div>

                    <div class="col-md-12 col-sm-12" id="tbl_entregas">
                            <div class="x_panel">
                              <div class="x_title">
                                <h5>Entregas</h5>
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
                              <div class="x_content" style="overflow:scroll;height:100%;width:100%;">
                                  
                                  <div class="row">
                                    <!--<button type="button" class="btn btn-round btn-info"  onclick="reg_entrega();">Nueva entrega</button>-->
                                      <div class="col-sm-12">
                                        <div class="card-box table-responsive">
                                
                                          <table id="datatable_entregas" class="table table-hover">
                                            
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
        <!-- /page content -->
   

      </div>
    </div> 




    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_reg_productos">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Agregar producto</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">


                            <div class="col-md-4 col-sm-4">
                                <label>LOTE:</label>
                                <input type="text" class="form-control" id="lote">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label>CANTIDAD:</label>
                                <input type="text" class="form-control" id="cantidad">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label>CODIGO:</label>
                                <input type="text" class="form-control" id="codigo">
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>DESCRIPCIÓN:</label>
                                <input type="text" class="form-control" id="descripcion">
                            </div>
                            

                          


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" onclick="save_prod();">Agregar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
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
    <script type="text/javascript" src="scripts/entregas.js?v=<?php echo(rand()); ?>"></script>
    <script src="build/js/custom.min.js"></script>
    
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