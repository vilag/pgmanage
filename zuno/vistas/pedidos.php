<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['administrador']==1)
{
?>
<!--Contenido-->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                        
                         <input type="hidden" class="form-control" name="f_actual" id="f_actual">
                          <h1 class="box-title">PEDIDOS</h1>
                        <div class="box-tools pull-right">
                        </div>
                        
                        
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="form-group col-md-12 col-sm-12">
                        <button id="" type="button" class="btn btn-primary" onclick="abrir_ventana_pedido();">Nuevo pedido</button>             
                    </div>

                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">

                          <thead>
                            <th>Opciones</th>
                            <th>No. Cliente</th>
                            <th>No. Pedido</th>
                            
                            <th>Nombre</th>                           
                            <th>Fecha de pedido</th>
                            <th>Estatus</th>
                            
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>No. Cliente</th>
                            <th>No. Pedido</th>
                            
                            <th>Nombre</th>                           
                            <th>Fecha de pedido</th>
                            <th>Estatus</th>
                        </table>
                    </div>

                    
                    
                   
                    
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
 

  <!-- Modal -->
  <div class="modal fade" id="myModal_pedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:100%;width:100%;">
    <div class="modal-dialog" style="width: 70% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
         
          <div class="form-group col-md-12 col-sm-12">
              
              <h3>Nuevo pedido</h3>
                   
          </div>
          <div class="form-group col-md-2 col-sm-12">
              <label>No. Cliente:</label>
              <input type="text" class="form-control" name="no_cliente_p" id="no_cliente_p">              
          </div>
          <div class="form-group col-md-10 col-sm-12">
              <label>Nombre:</label>
              <input type="text" class="form-control" name="nombre_cliente_p" id="nombre_cliente_p">   
              <input type="hidden" class="form-control" name="email_cliente_p" id="email_cliente_p">  
              <input type="hidden" class="form-control" name="telefono_cliente_p" id="telefono_cliente_p">         
          </div>
          <div class="form-group col-md-2 col-sm-12">
              <label>No. Pedido:</label>
              <input type="text" class="form-control" name="num_pedido" id="num_pedido">              
          </div>
          <div class="form-group col-md-10 col-sm-12">
              <label>Resumen de concepto:</label>
              <input type="text" class="form-control" name="concepto_pedido" id="concepto_pedido">              
          </div>
         

         

          <div class="form-group col-md-12 col-sm-12">
              
            <form name="formulario-envia_proyecto" id="formulario-envia_pedido" enctype="multipart/form-data" method="post">

                <div class="form-group col-md-6 col-sm-12">

                  <label>Subir formato de pedido:</label>
                  <input type="file" name="ar_pedido" id="ar_pedido" onchange="">
                  <input type="hidden" class="form-control" name="valor_si2" id="valor_si2">

                                                       
                </div>
                <br>                                
                                                        
                <div id="subir2" class="form-group col-md-6 col-sm-12">
                  <a href="http://localhost/pizarronesguadalajara/files/pedidos/tabla importar proyecto.xlsx" download="tabla importar proyecto.xlsx">descargar</a>             
                </div>
                                                          
            </form>

                                               
          </div>

          <div class="form-group col-md-6 col-sm-12">
              <button id="" type="button" class="btn btn-primary" onclick="guardar_pedido();">Solicitar pedido</button>
                                               
          </div>   

          

        </div>
        <div class="modal-footer">
          
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->


  <!-- Modal -->
  <div class="modal fade" id="myModal_pedido_vista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:100%;width:100%;">
    <div class="modal-dialog" style="width: 90% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
                  

                  <div class="form-group col-md-12 col-sm-12">
              
                      <h3>DETALLE DE PEDIDO</h3>
                           
                  </div>
                  <div class="form-group col-md-2 col-sm-12">
                      <label>No. Cliente:</label>
                      <input type="text" class="form-control" name="no_cliente_p" id="no_cliente_p">              
                  </div>
                  <div class="form-group col-md-10 col-sm-12">
                      <label>Nombre:</label>
                      <input type="text" class="form-control" name="nombre_cliente_p" id="nombre_cliente_p">   
                      <input type="hidden" class="form-control" name="email_cliente_p" id="email_cliente_p">  
                      <input type="hidden" class="form-control" name="telefono_cliente_p" id="telefono_cliente_p">         
                  </div>
                  <div class="form-group col-md-2 col-sm-12">
                      <label>No. Pedido:</label>
                      <input type="text" class="form-control" name="num_pedido" id="num_pedido">              
                  </div>
                  <div class="form-group col-md-10 col-sm-12">
                      <label>Resumen de concepto:</label>
                      <input type="text" class="form-control" name="concepto_pedido" id="concepto_pedido">              
                  </div>
                 

                 

                  <div class="form-group col-md-12 col-sm-12">
                      
                    <form name="formulario-envia_proyecto" id="formulario-envia_pedido" enctype="multipart/form-data" method="post">

                        <div class="form-group col-md-6 col-sm-12">

                          <label>Subir formato de pedido:</label>
                          <input type="file" name="ar_pedido" id="ar_pedido" onchange="">
                          <input type="hidden" class="form-control" name="valor_si2" id="valor_si2">

                                                               
                        </div>
                        <br>                                
                                                                
                        <div id="subir2" class="form-group col-md-6 col-sm-12">
                          <a href="http://localhost/pizarronesguadalajara/files/pedidos/tabla importar proyecto.xlsx" download="tabla importar proyecto.xlsx">descargar</a>             
                        </div>
                                                                  
                    </form>

                                                       
                  </div>

                  <div class="form-group col-md-6 col-sm-12">
                      <button id="" type="button" class="btn btn-primary" onclick="guardar_pedido();">Solicitar pedido</button>
                                                       
                  </div>
          

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/moment.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="../scripts/pedidos.js"></script>
<?php 
}
ob_end_flush();
?>