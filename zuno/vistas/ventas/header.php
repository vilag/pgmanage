
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


  </head>
  <body  class="hold-transition skin-red sidebar-mini">
    <!--<div class="loader"></div>-->
    

    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>PG</b>Control</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>PGControl</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <!--<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>

          </a>-->
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
                  <span id="user_sesion" class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
                  <label id="idusuario" style="visibility: hidden;"><?php echo $_SESSION['idusuario']; ?></label>

                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">
                    <p>
                      <a href="../../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar</a>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <!--<div class="pull-right">
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar</a>
                    </div>-->
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
           

            <?php 
            if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1)
            {
              echo '<li class="treeview">
              <a href="../contactos.php">
                <i class="fa fa-square"></i>
                <span>Contactos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>';
            }
            ?>

            <?php 
            if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1)
            {
              echo '<li class="treeview">
              <a href="../clientes.php">
                <i class="fa fa-square"></i>
                <span>Clientes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>';
            }
            ?>

             <?php 
            if ($_SESSION['administrador']==1)
            {
              echo '<li class="treeview">
              <a href="../../controlpg/production/sale_product.php">
                <i class="fa fa-square"></i>
                <span>Productos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>';
            }
            ?>


            <?php 
            if ($_SESSION['administrador']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-square"></i>
                <span>Pedidos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>';
            }
            ?>

             <?php 
            if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-align-justify"></i>
                <span>Inventarios</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../ventas/inventario_z.php"><i class="fa fa-circle-o"></i> Consultar</a></li>
              </ul>
              <ul class="treeview-menu">
                <li><a href="../ventas/hist_invv.php"><i class="fa fa-circle-o"></i> Historial</a></li>
              </ul>
            </li>';
            }
            ?>

            <?php 
            if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1)
            {
              echo '<li class="treeview">
              <a href="ventas.php">
                <i class="fa fa-square"></i>
                <span>Ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>';
            }
            ?>

           
            <?php 
            if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1)
            {
              echo '<li class="treeview">
              <a href="../../../welcome.php">
                <i class="fa fa-square"></i>
                <span>PGMANAGE</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>';
            }
            ?>
            

            <!--<li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>-->
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
