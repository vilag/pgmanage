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
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1)
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
                          <h1 class="box-title">CLIENTES</h1>
                        <div class="box-tools pull-right">
                        </div>
                        
                        
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="form-group col-md-12 col-sm-12">
                        <button id="" type="button" class="btn btn-primary" onclick="abrir_cliente_nuevo();">Nuevo cliente</button>             
                    </div>

                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">

                          <thead>
                            <th>Opciones</th>
                            <th>No. Cliente</th>
                            <th>Nombre</th>
                            <th>Fecha de registro</th>                           
                            
                            
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>No. Cliente</th>
                            <th>Nombre</th>
                            <th>Fecha de registro</th>                           
                            
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
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:100%;width:100%;">
    <div class="modal-dialog" style="width: 70% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">

          <div class="form-group col-md-12 col-sm-12">
              
              <h3>NUEVO CLIENTE</h3>
                        
          </div>
          <div class="form-group col-md-2 col-sm-2">
              <label>No. Cliente(*):</label>
              <input type="text" class="form-control" name="num_cliente_new" id="num_cliente_new">              
          </div>
          <div class="form-group col-md-10 col-sm-10">
              <label>Nombre(*):</label>
              <input type="text" class="form-control" name="nombre_new" id="nombre_new">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Email:</label>
              <input type="text" class="form-control" name="email_new" id="email_new">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Telefono:</label>
              <input type="text" class="form-control" name="telefono_new" id="telefono_new">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>RFC:</label>
              <input type="text" class="form-control" name="rfc_new" id="rfc_new">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Calle:</label>
              <input type="text" class="form-control" name="calle_new" id="calle_new">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Numero:</label>
              <input type="number" class="form-control" name="numero_new" id="numero_new">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Interior:</label>
              <input type="text" class="form-control" name="interior_new" id="interior_new">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Colonia:</label>
              <input type="text" class="form-control" name="colonia_new" id="colonia_new">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Municipio:</label>
              <input type="text" class="form-control" name="municipio_new" id="municipio_new">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Estado:</label>
              <input type="text" class="form-control" name="estado_new" id="estado_new">              
          </div>
          <div class="form-group col-md-12 col-sm-12">
              <label>Referencia:</label>
              <input type="text" class="form-control" name="referencia_new" id="referencia_new">              
          </div>
         

          <div class="form-group col-md-12 col-sm-12">
              <button id="" type="button" class="btn btn-primary" onclick="guardar_cliente();">Guardar</button>
                                               
          </div>

          

        </div>
        <div class="modal-footer">
          
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->


  <!-- Modal -->
  <div class="modal fade" id="myModal_cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:100%;width:100%;">
    <div class="modal-dialog" style="width: 90% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          
          <div class="form-group col-md-12 col-sm-12">
              
              <h3>DETALLE DE CLIENTE</h3>
              <!--<input type="text" class="form-control" name="idcliente" id="idcliente">-->             
          </div>
          <div class="form-group col-md-2 col-sm-2">
              <label>No. Cliente(*):</label>
              <input type="text" class="form-control" name="num_cliente_consul" id="num_cliente_consul">              
          </div>
          <div class="form-group col-md-10 col-sm-10">
              <label>Nombre(*):</label>
              <input type="text" class="form-control" name="nombre_consul" id="nombre_consul">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Email:</label>
              <input type="text" class="form-control" name="email_consul" id="email_consul">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Telefono:</label>
              <input type="text" class="form-control" name="telefono_consul" id="telefono_consul">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>RFC:</label>
              <input type="text" class="form-control" name="rfc_consul" id="rfc_consul">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Calle:</label>
              <input type="text" class="form-control" name="calle_consul" id="calle_consul">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Numero:</label>
              <input type="number" class="form-control" name="numero_consul" id="numero_consul">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Interior:</label>
              <input type="text" class="form-control" name="interior_consul" id="interior_consul">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Colonia:</label>
              <input type="text" class="form-control" name="colonia_consul" id="colonia_consul">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Municipio:</label>
              <input type="text" class="form-control" name="municipio_consul" id="municipio_consul">              
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label>Estado:</label>
              <input type="text" class="form-control" name="estado_consul" id="estado_consul">              
          </div>
          <div class="form-group col-md-8 col-sm-12">
              <label>Referencia:</label>
              <input type="text" class="form-control" name="referencia_consul" id="referencia_consul">              
          </div>
          <div class="form-group col-md-4 col-sm-12">
              <label>Fecha de registro:</label>
              <input type="text" class="form-control" name="reg_consul" id="reg_consul" disabled>              
          </div>
         

          <div class="form-group col-md-12 col-sm-12">
              <button id="" type="button" class="btn btn-primary" onclick="actualizar_cliente();">Actualizar</button>
                                               
          </div>

          <div class="form-group col-md-12 col-sm-12" id="divseg">
              
              
              <div class="form-group col-md-6 col-sm-12">
                <label>HISTORICO DE PEDIDOS</label>
                            <table id="tbllistado_seg_pedidos" class="table table-striped table-bordered table-condensed table-hover">

                              <thead>
                                
                                
                                <th>Numero de pedido</th>                               
                               
                                <th>Fecha de pedido</th>
                                <th>Estatus</th>
                              </thead>
                              <tbody>                            
                              </tbody>
                              <tfoot>
                              
                                <th>Numero de pedido</th>                               
                               
                                <th>Fecha de pedido</th>
                                <th>Estatus</th>
                              </tfoot>
                            </table>             
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label>HISTORICO DE VENTAS</label>
                            <table id="tbllistado_seg_ventas" class="table table-striped table-bordered table-condensed table-hover">

                              <thead>
                                
                                <th>Folio</th>
                                <th>Descripción</th>                               
                               
                                <th>Total pago</th>
                                <th>Fecha</th>
                                
                              </thead>
                              <tbody>                            
                              </tbody>
                              <tfoot>
                                <th>Folio</th>
                                <th>Descripción</th>                               
                               
                                <th>Total pago</th>
                                <th>Fecha</th>
                              </tfoot>
                            </table>             
              </div>
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
<script type="text/javascript" src="../scripts/clientes.js"></script>
<?php 
}
ob_end_flush();
?>