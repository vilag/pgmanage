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
                        <h1 class="box-title">HISTORIAL DE ACTUALIZACIONES</h1>
                        <div class="box-tools pull-right">
                          <button id="" type="button" class="btn btn-primary" onclick=""><a href="inventario_z.php" style="color: #ffffff">Inventarios</a></button>
                        </div>
                     
                        <h4>Entradas y salidas de inventario</h4>
                        
                    </div>
                    <!-- /.box-header -->
                    
                    
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">

                          <thead>
                            <th>Fecha/Hora</th>
                            <th>Codigo</th>
                            <th>Existencia inicial</th>
                            <th>Tipo de movimiento</th>
                            <th>Existencia final</th>
                            <th>Actividad</th>
                            <th>Folio venta</th>
                            <th>Detalles de actividad</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                            <th>Fecha/Hora</th>
                            <th>Codigo</th>
                            <th>Existencia inicial</th>
                            <th>Tipo de movimiento</th>
                            <th>Existencia final</th>
                            <th>Actividad</th>
                            <th>Folio venta</th>
                            <th>Detalles de actividad</th>
                          </tfoot>
                        </table>
                    </div>

                    

                    
                    
                   
                    
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  

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
<script type="text/javascript" src="scripts/hist_invv.js"></script>
<?php 
}
ob_end_flush();
?>