<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: ../login.html");
}
else
{
//require 'header.php';
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1)
{
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PG | Tracing</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" type="text/css" href="../../public/css/progress.css">
    
    <script type="text/javascript" src="../../public/js/pace.min.js"></script>
    <!--<link rel="stylesheet" type="text/css" href="../public/css/loader.css">
    <script type="text/javascript" src="../public/js/jquery.min.js"></script>-->


    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../../public/img/favicon.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../../public/datatables/jquery.dataTables.min.css">    
    <link href="../../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../../public/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/loader.css" media="all">

    <script type="text/javascript" src="../../public/js/jquery.min.js"></script>
    <script type="text/javascript">
        if (window.history.forward(1) != null) {window.history.forward(1);}
    </script>

    <script type="text/javascript" src="http://h1.ripway.com/inacho/highslide-with-gallery.js"></script>
    <link rel="stylesheet" type="text/css" href="http://h1.ripway.com/inacho/highslide.css" />
    


  </head>

  <body  class="hold-transition skin-red sidebar-mini">
    <!--<div class="loader"></div>-->
    

    <div >

     
      <!-- Left side column. contains the logo and sidebar -->
     

<!--Contenido-->

      <!-- Content Wrapper. Contains page content -->
      <div >        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  
                   <br>
                    

                   
                    
                    <!-- /.box-header -->
                    <!-- centro -->
                    
                    <div  class="form-group col-md-12 col-sm-12">
                        
                        <button id="btn_pedido" type="button" class="btn btn-primary" onclick=""><a href="../contactos.php" style="color: #ffffff">Regresar al panel</a></button>
                        <button id="btn_pedido" type="button" class="btn btn-primary" onclick="verlista();">Tabla principal</button>
                        <button id="btn_pedido" type="button" class="btn btn-primary" onclick="verapartados();">Productos apartados</button>
                        <button id="btn_pedido" type="button" class="btn btn-primary" onclick="nuevoreg();">Nuevo producto</button>
                                     
                    </div>

                    <div class="form-group col-md-12 col-sm-12">
                      
                                <div class="panel-body table-responsive" id="listadoregistros">
                                    <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">

                                      <thead>
                                        <th>VER</th>
                                        
                                        <th>CODIGO</th>
                                        <th>NOMBRE</th>
                                        <th>EXISTENCIA</th>
                                      </thead>
                                      <tbody>                            
                                      </tbody>
                                      <tfoot>
                                        <th>VER</th>
                                        
                                        <th>CODIGO</th>
                                        <th>NOMBRE</th>
                                        <th>EXISTENCIA</th>
                                      </tfoot>
                                    </table>
                                </div>

                                <div class="panel-body table-responsive" id="listado_apartados">
                                  <label>Productos apartados</label>
                                  <table id="tbl_prod_apartado1" class="table table-striped table-bordered table-condensed table-hover">

                                                
                                  </table>
                                </div>

                                <div class="panel-body table-responsive" id="formulario">

                                    <div class="form-group col-md-12 col-sm-12">
                                        
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label>NUEVO PRODUCTO</label>           
                                                </div>
                                                <div class="form-group col-md-2 col-sm-12">
                                                    <label>Codigo:</label>
                                                    <input type="text" class="form-control" name="codigo_nuevo" id="codigo_nuevo">              
                                                </div>
                                                <!--<div class="form-group col-md-12 col-sm-12">
                                                    <label>Nombre:</label>
                                                    <input type="text" class="form-control" name="nombre_nuevo" id="nombre_nuevo">              
                                                </div>-->
                                                <div class="form-group col-md-8 col-sm-12">
                                                    <label>Descripción:</label>
                                                    <input type="text" class="form-control" name="descr_nuevo" id="descr_nuevo">              
                                                </div>
                                                <div class="form-group col-md-2 col-sm-12">
                                                    <label>Existencia:</label>
                                                    <input type="number" class="form-control" name="existencia_nuevo" id="existencia_nuevo">              
                                                </div>
                                                <br>
                                                <br>

                                                <div  class="form-group col-md-12 col-sm-12" align="right">
                        
                                                    <button id="" type="button" class="btn btn-primary" onclick="guardar_prod();">Guardar producto</button>
                                                                 
                                                </div>
                                    </div>


                                </div>

                             

                    </div>
                    

                    
                    
                   
                    
                    <!--Fin centro -->
                 
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
 
  <!-- Modal -->
  <div class="modal fade" id="myModal_detalle_prod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:100%;width:100%;">
    <div class="modal-dialog" style="width: 80% !important;">
      <div class="modal-content">
        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        
        
          <br><br>
          
          <div class="form-group col-md-12 col-sm-12">
                  <div class="form-group col-md-12 col-sm-12">
                    <button id="" type="button" class="btn btn-primary" onclick="informe();">INFORME</button>
                    <button id="" type="button" class="btn btn-primary" onclick="editar();">EDITAR</button>
                  </div>
            
                
                  
                  <br>
                  <div class="form-group col-md-12 col-sm-12">
                  
                    <h2 id="letrero">INFORME</h2>
                  </div>

                      <div class="form-group col-md-12 col-sm-12">
                        
                                  <h6 style="visibility: hidden;" id="exist"></h6>
                                  <h6 style="visibility: hidden;" id="exist_ant"></h6>
                                  <h3 id="existencia"></h3>
                                       
                      </div> 

                <div class="form-group col-md-12 col-sm-12" id="informe">

                      <div class="form-group col-md-4 col-sm-12">                      
                          <label>NOMBRE:</label>
                          <input type="hidden" class="form-control" name="id_inv" id="id_inv">
                          <h4 id="nombre"></h4>
                      </div>

                      <div class="form-group col-md-4 col-sm-12">
                          <label>CODIGO:</label>
                          <h4 id="codigo"></h4>
                          <!--<input type="text" class="form-control" name="codigo" id="codigo">-->          
                      </div>
                    
                      <div class="form-group col-md-4 col-sm-12">
                          <label>DESCRIPCIÓN:</label>
                          <h4 id="descripcion"></h4>
                          <!--<textarea  cols="25" rows="5" class="form-control" name="descripcion" id="descripcion"></textarea>-->           
                      </div>

                      <div class="form-group col-md-12 col-sm-12">
                          <label>COMENTARIO:</label>
                          <!--<h4 id="comentario"></h4>-->
                          <textarea  cols="25" rows="3" class="form-control" name="comentario" id="comentario"></textarea>         
                      </div>

                      <div class="form-group col-md-12 col-sm-12">
                          <label>COLORES:</label>
                      </div>

                      <div class="form-group col-md-12 col-sm-12">
                         
                          
                                    <div class="form-group col-md-4 col-sm-12">
                                      <label>Nombre:</label>
                                      <input type="text" class="form-control" name="nombre_color" id="nombre_color">
                                    </div>
                                    <div class="form-group col-md-4 col-sm-12">
                                      <label>Cantidad:</label>
                                      <input type="text" class="form-control" name="cantidad_color" id="cantidad_color">
                                    </div>
                                    <br>

                                    <div class="form-group col-md-4 col-sm-12">
                                      <button id="" type="button" class="btn btn-primary" onclick="addcolor();">Agregar</button>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                      <div class="panel-body table-responsive" id="listadoregistros">
                                          <table id="tblcolores" class="table table-striped table-bordered table-condensed table-hover">

                                           
                                          </table>
                                      </div>
                                    </div>
                                      
                      </div>

                      
                      <div class="form-group col-md-12 col-sm-12">
                                  <h3 id="apartados"></h3>
                      </div>

                      <div class="form-group col-md-12 col-sm-12" style="overflow:scroll;width:100%;">
                          <label>Detalle de productos apartados</label>
                          <table id="tbl_prod_apartado" class="table table-striped table-bordered table-condensed table-hover">

                                        
                          </table>

                      </div>
              
                </div> 

                

                <div class="form-group col-md-12 col-sm-12" id="edicion">
                  
              
                  

                  <div class="form-group col-md-12 col-sm-12">
                    <div class="form-group col-md-12 col-sm-12">
                     <label>Registrar entrada/salida</label> 
                    </div>
                   
                        <div class="form-group col-md-6 col-sm-12"> 
                                <div class="form-group col-md-3 col-sm-12">
                                  <button id="" type="button" class="btn btn-primary" onclick="sumarprod();">Entrada ( + )</button>
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                  <input type="text" class="form-control" name="cant_capt" id="cant_capt" value="0">
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                  <button id="" type="button" class="btn btn-primary" onclick="restarprod();">Salida ( - )</button>
                                </div>
                                <div class="form-group col-md-3 col-sm-12" align="center">
                   
                                       <button id="" type="button" class="btn btn-success" onclick="guardar();">GUARDAR</button>
                                </div>
                        </div>

                        
                        <div class="form-group col-md-12 col-sm-12">
                          <label>COLORES:</label>
                        </div> 
                        <div class="form-group col-md-12 col-sm-12">
                          
                                    <div class="form-group col-md-4 col-sm-12">
                                      <label>Nombre:</label>
                                      <input type="text" class="form-control" name="nombre_color2" id="nombre_color2">
                                    </div>
                                    <div class="form-group col-md-4 col-sm-12">
                                      <label>Cantidad:</label>
                                      <input type="text" class="form-control" name="cantidad_color2" id="cantidad_color2">
                                    </div>
                                    <br>
                                    
                                    <div class="form-group col-md-4 col-sm-12">
                                      <button id="" type="button" class="btn btn-primary" onclick="addcolor2();">Agregar</button>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12">
                                          <div class="panel-body table-responsive" id="listadoregistros">
                                              <table id="tblcolores2" class="table table-striped table-bordered table-condensed table-hover">

                                               
                                              </table>
                                          </div>
                                    </div>

                                   
                        </div>        
                          
                          <div class="form-group col-md-12 col-sm-12">
                              <img id="imagen" src="" width="100%" height="100%">            
                          </div>

                  </div>

                </div>

                  
                  
          </div>

       
        <div class="modal-footer">
          
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->



  <!-- Modal -->
  <div class="modal fade" id="myModal_registrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:100%;width:100%;">
    <div class="modal-dialog" style="width: 70% !important;">
      <div class="modal-content">
        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        
        <div class="modal-body">

         

                  
          



        </div>
        <div class="modal-footer">
          
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->

<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="../../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../../public/js/moment.min.js"></script>
<script type="text/javascript" src="../../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/inventario_z.js"></script>
<?php 
}
ob_end_flush();
?>