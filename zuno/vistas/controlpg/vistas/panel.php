
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
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['agente_ventas2']==1)
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

    <link rel="stylesheet" type="text/css" href="../../../public/css/progress.css">
    
    <script type="text/javascript" src="../../../public/js/pace.min.js"></script>
    <!--<link rel="stylesheet" type="text/css" href="../public/css/loader.css">
    <script type="text/javascript" src="../public/js/jquery.min.js"></script>-->


    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../../../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../../../public/img/favicon.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../../../public/datatables/jquery.dataTables.min.css">    
    <link href="../../../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../../../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../../../public/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="../../../public/css/loader.css" media="all">

    <script type="text/javascript" src="../../../public/js/jquery.min.js"></script>
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
                        
                        <button id="btn_pedido" type="button" class="btn btn-primary" onclick=""><a href="../index.php" style="color: #ffffff">Pedidos</a></button>
                        <button id="btn_pedido" type="button" class="btn btn-primary" onclick="verlista();">Catalogo</button>
                        <button id="btn_pedido" type="button" class="btn btn-primary" onclick="verapartados();">Ordenes de producción</button>
                        <button id="btn_pedido" type="button" class="btn btn-primary" onclick="nuevoreg();">Clientes</button>
                        <button id="btn_pedido" type="button" class="btn btn-primary" onclick="nuevoreg();">Inventarios</button>
                                     
                    </div>

                    
                    

                    
                    
                   
                    
                    <!--Fin centro -->
                 
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

?>
<script type="text/javascript" src="../../../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../../../public/js/moment.min.js"></script>
<script type="text/javascript" src="../../../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/inventario_z.js"></script>
<?php 
}
ob_end_flush();
?>