<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo_letras.png">

    <title>PG Management </title>

    <!-- Bootstrap -->
     
    


    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <link href="vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
   
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <script type="text/javascript" src="public/js/moment.min.js"></script>

    <script type="text/javascript">
        if (window.history.forward(1) != null) {window.history.forward(1);}
    </script>

   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   
    <!--<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>-->
    <script src="graficas/apexcharts.js"></script>
   
  
    <!--<script src="http://codeseven.github.com/toastr/toastr.js"></script>
    <link href="http://codeseven.github.com/toastr/toastr.css" rel="stylesheet"/>
    <link href="http://codeseven.github.com/toastr/toastr-responsive.css" rel="stylesheet"/>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@100;300&family=Montserrat:wght@500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,100&family=Oswald:wght@300&display=swap" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src="js/excel/xlsx.full.min.js"></script>
    <script src="js/excel/FileSaver.min.js"></script>
    <script src="js/excel/tableexport.min.js"></script>

  

    <!-- Hotjar Tracking Code for PGMANAGE -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:3386001,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    
    
  </head>

  <script type="text/javascript">
    //var intevalo8 = setInterval('listar_chat()',60000);
    //var intevalo9 = setInterval('contar_mensajes()',60000);
  </script>

  <body class="nav-md">
    <div class="loader"></div>
    <style type="text/css">
      .loader {
          position: fixed;
          left: 0px;
          top: 0px;
          width: 100%;
          height: 100%;
          z-index: 9999;
          background: url('images/pageLoader.gif') 50% 50% no-repeat rgb(249,249,249);
          opacity: .8;
      }
    </style>
    <script type="text/javascript">
      $(window).load(function() {
          $(".loader").fadeOut("slow");
      });
    </script>
    <div class="container body">
      
      <div class="main_container" >
        <div class="col-md-3 left_col">
          
          <div class="left_col scroll-view">
           

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/Logo.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenid@</span>
                <h2 id="usuario"><?php echo $_SESSION['nombre'];?></h2>
                <h2 id="idusuario" style="display: none;"><?php echo $_SESSION['idusuario']; ?></h2>
                <h2 id="lugar_user" style="display: none;"><?php echo $_SESSION['lugar']; ?></h2>
                <h2 id="idarea" style="display: none;"><?php echo $_SESSION['idarea']; ?></h2>
               
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            
            <div style="position: fixed; margin-top: 30%; margin-left: 90%;" id="globo_mensajes_notif">
              <a href="# " onclick="listar_controles_mensajes();" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" id="edit_fecha">
                <div style=" width: 50px; height: 50px; background-color: #fff;  box-shadow: 0px 0px 80px rgb(0,0,0,0.7); border-radius: 50% 50%; padding-left: 10px; padding-top: 8px;">
                  <i class="fa fa-comments-o" style="font-size: 30px; color: #000;"></i>
                </div>
              </a>

              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="box_controles_mensajes">
                                                                                                                                                            
              </div>


            </div>
              
            <div id="globo_notif" style="position: fixed; width: 30px; height: 30px; background-color: #000; margin-top: 29%; margin-left: 92%; box-shadow: 0px 0px 80px rgb(0,0,0,0.7); border-radius: 50% 50%; padding-left: 12px; padding-top: 5px;">
                <b id="num_mensajes" style="color: #fff; font-size: 15px;"></b>
            </div>
              <!--<a href="# " onclick="listar_controles_mensajes();">
                <div style="position: fixed; width: 50px; height: 50px; background-color: #fff; margin-top: 30%; margin-left: 90%; box-shadow: 0px 0px 80px rgb(0,0,0,0.7); border-radius: 50% 50%; padding-left: 10px; padding-top: 8px;">
                  <i class="fa fa-comments-o" style="font-size: 30px; color: #000;"></i>
                </div>
              </a>-->
                                                  
                                                  
              
              <!--<div  style="position: fixed; width: 500px; height: 50px; background-color: rgb(0,0,0,1); margin-top: 30%; margin-left: 50%; text-align: right; padding-top: 10px;" align="right">
                
              </div>-->

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <input type="hidden" id="idpedido_header" value="0">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <!--<li><a href="../../vistas/contactos.php"><i class="fa fa-home"></i> Regresar a panel <span></span></a>
                   
                  </li>-->
                  
                  
                  <li><a href="welcome.php"><i class="fa fa-plus-square-o"></i> Tablero</a></li>
                  
                  <!--<li><a href="entregas_rep.php"><i class="fa fa-home"></i> Repartidor</a>
                    
                  </li>-->

                  



                  <?php 

                      //if (($_SESSION['idusuario']==1)) {
                         // echo '    
                                
                              
                              //<li><a href="produccion.php"><img src="images/iconos/speedometer_b.png" width="10%" style="margin-right: 9px;"> Producción</a></li>

                         // ';  
                    //  }

                     // if (($_SESSION['idusuario']==1)) {
                         // echo '    
                                
                              /*<li><a href="objectives.php"><img src="images/iconos/speedometer_b.png" width="10%" style="margin-right: 9px;"> Proyectos</a></li>
                              <li><a href="nuevo_pedido.php"><img src="images/iconos/silla.png" width="15%" style="margin-left: -5px; margin-right: 3px;"> Productos</a></li>
                              <li><a href="panel_pedidos.php"><i class="fa fa-tasks"></i> Pedidos</a></li>
                              <li><a href="prod_produccion.php"><i class="fa fa-tasks"></i> Producción</a></li>
                              <li><a href="alm_pt.php"><i class="fa fa-tasks"></i> Almacen PT</a></li>
                              <li><a href="ajustes.php"><i class="fa fa-cogs"></i> Ajustes</a></li>*/

                         // ';  
                     // }

                      if (($_SESSION['idusuario']>=1 AND $_SESSION['idusuario']<=6) OR ($_SESSION['idusuario']>=7 AND $_SESSION['idusuario']<=14) OR ( $_SESSION['idusuario']==22) OR ( $_SESSION['idusuario']==23) OR ( $_SESSION['idusuario']==24) OR ( $_SESSION['idusuario']==25) OR ( $_SESSION['idusuario']==26)) {
                          echo '    
                                
                              <li><a><i class="fa fa-tasks"></i> Pedidos <span class="fa fa-chevron-down"></span></a>
                                  <ul class="nav child_menu">
                                    <li><a href="sale_product.php">Nuevo</a>
                                    <li><a href="list_pedidos.php">Todos</a>                                                                        
                                    <li><a href="reportes.php">Reportes</a> 
                          ';  
                      }

                                
                      
                      if (($_SESSION['idusuario']>=1 AND $_SESSION['idusuario']<=6) OR ($_SESSION['idusuario']>=7 AND $_SESSION['idusuario']<=14) OR ( $_SESSION['idusuario']==22) OR ( $_SESSION['idusuario']==23) OR ( $_SESSION['idusuario']==24) OR ( $_SESSION['idusuario']==25) OR ( $_SESSION['idusuario']==26)) {
                          echo '     
                                  

                                 </ul>
                              </li>

                          ';                       
                      }
                  ?>

                  <?php

                      if (($_SESSION['idusuario']==1) OR ($_SESSION['idusuario']>=4 AND $_SESSION['idusuario']<=5) OR ($_SESSION['idusuario']>=7 AND $_SESSION['idusuario']<=11) OR ($_SESSION['idusuario']==14) OR ($_SESSION['idusuario']==22) OR ($_SESSION['idusuario']==23) OR ($_SESSION['idusuario']==24)  OR ($_SESSION['idusuario']==26)) {
                          echo '     
                                  

                                <li><a href="entregas_prod.php"><i class="fa fa-truck"></i> Salidas</a></li>

                          ';                       
                      } 


                   ?>

                  
                  
                  <?php 
                      if (($_SESSION['idusuario']==1) OR ($_SESSION['idusuario']==10) OR ($_SESSION['idusuario']==22) OR ($_SESSION['idusuario']==5) OR ($_SESSION['idusuario']==4) OR ($_SESSION['idusuario']==23) OR ($_SESSION['idusuario']==24)) {

                          echo '
                              
                                <li><a><i class="fa fa-cubes"></i> Almacenes <span class="fa fa-chevron-down"></span></a>
                                  <ul class="nav child_menu">
                                      
                                      <li><a>Fabrica<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                          <li class="sub_menu"><a href="almacen_pt.php">Producto terminado</a>
                                          </li>
                                          <li><a href="#">Materia prima</a>
                                          </li>
                                          
                                        </ul>
                                      </li>
                                      <li><a>Tiendas<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                          
                                          <li><a href="#">Tienda (Zuno)</a>
                                          </li>
                                        </ul>
                                      </li>
                                      
                                  </ul>
                                </li>

                          ';
                        

                      }
                    
                  ?>

                  
                  

                  <?php 

                         

                      if (($_SESSION['idusuario']>=1 AND $_SESSION['idusuario']<=6) OR ($_SESSION['idusuario']>=7 AND $_SESSION['idusuario']<=12) OR ($_SESSION['idusuario']==14) OR ($_SESSION['idusuario']==22) OR ($_SESSION['idusuario']==24) OR ( $_SESSION['idusuario']==25) OR ( $_SESSION['idusuario']==26)) {
                          echo '    
                                <li><a><i class="fa fa-search"></i> Consultar <span class="fa fa-chevron-down"></span></a>
                                  <ul class="nav child_menu">
                                      <li><a href="productos.php">Productos</a></li>
                          ';  
                      }                   
                      if (($_SESSION['idusuario']>=1 AND $_SESSION['idusuario']<=5) OR ($_SESSION['idusuario']>=7 AND $_SESSION['idusuario']<=9) OR ($_SESSION['idusuario']>=11 AND $_SESSION['idusuario']<=12) OR ($_SESSION['idusuario']==14) OR ( $_SESSION['idusuario']==26) ) {
                          echo '
                                     <li><a href="#">Clientes</a></li>
                          ';                        
                      }

                        


                      if (($_SESSION['idusuario']>=1 AND $_SESSION['idusuario']<=5) OR ($_SESSION['idusuario']>=7 AND $_SESSION['idusuario']<=12) OR ($_SESSION['idusuario']==14) OR ($_SESSION['idusuario']==22) OR ($_SESSION['idusuario']==24) OR ($_SESSION['idusuario']==25) OR ( $_SESSION['idusuario']==26)) {
                          echo '     
                                  
                              </ul>
                                </li>

                          ';                       
                      }
                  ?>

                 

                  <?php
                      

                      if (($_SESSION['idusuario']==1) OR ($_SESSION['idusuario']>=4 AND $_SESSION['idusuario']<=5) OR ($_SESSION['idusuario']>=7 AND $_SESSION['idusuario']<=12) OR ($_SESSION['idusuario']==14) OR ($_SESSION['idusuario']==22) OR ($_SESSION['idusuario']>=14 AND $_SESSION['idusuario']<=21) OR ($_SESSION['idusuario']==24)  OR ($_SESSION['idusuario']==25)) {
                          echo '    
                                <li><a><i class="fa fa-plus-square-o"></i> Producción <span class="fa fa-chevron-down"></span></a>
                                  <ul class="nav child_menu">
                                     <li><a href="op.php">OP</a> 
                          ';  
                      }                    
                      if (($_SESSION['idusuario']==1) OR ($_SESSION['idusuario']>=4 AND $_SESSION['idusuario']<=5) OR ($_SESSION['idusuario']>=7 AND $_SESSION['idusuario']<=9) OR ($_SESSION['idusuario']>=11 AND $_SESSION['idusuario']<=12) OR ($_SESSION['idusuario']==14) OR ($_SESSION['idusuario']==24) ) {
                          echo '
                                     <li><a href="seguim_op.php">Seguimiento</a>
                          ';                        
                      }

                      if (($_SESSION['idusuario']==1) OR ($_SESSION['idusuario']>=4 AND $_SESSION['idusuario']<=5) OR ($_SESSION['idusuario']>=7 AND $_SESSION['idusuario']<=9) OR ($_SESSION['idusuario']>=11 AND $_SESSION['idusuario']<=12) OR ($_SESSION['idusuario']==14) ) {
                          echo '
                                     <li><a href="tabulador.php">Tabulador</a>
                          ';                        
                      }

                      if (($_SESSION['idusuario']==1) OR ($_SESSION['idusuario']>=4 AND $_SESSION['idusuario']<=5) OR ($_SESSION['idusuario']>=7 AND $_SESSION['idusuario']<=9) OR ($_SESSION['idusuario']>=11 AND $_SESSION['idusuario']<=12) OR ($_SESSION['idusuario']==14) ) {
                          echo '
                                     <li><a href="materia_prima.php">Materia Prima</a>
                          ';                        
                      }

                      if (($_SESSION['idusuario']==1)) {
                        echo '
                                   <li><a href="correcciones.php">Correcciones</a>
                        ';                        
                    }

                      if (($_SESSION['idusuario']==1) OR ($_SESSION['idusuario']>=4 AND $_SESSION['idusuario']<=5) OR ($_SESSION['idusuario']>=7 AND $_SESSION['idusuario']<=12) OR ($_SESSION['idusuario']==14) OR ($_SESSION['idusuario']==18) OR ($_SESSION['idusuario']>=22) OR ($_SESSION['idusuario']==24) OR ($_SESSION['idusuario']==25)) {
                          echo '     
                                  </ul>
                                </li>
                          ';                       
                      }
                  ?>

                   <?php 
                      if ($_SESSION['idusuario']==1 ) {
                          echo '    
                                <li><a href="reportes.php"><i class="fa fa-plus-square-o"></i> Reportes</a></li>
                          ';  
                      }                    
                
                  ?>



                  <?php 
                      if (($_SESSION['idusuario']==1) OR ($_SESSION['idusuario']==2) OR ($_SESSION['idusuario']==3) OR ($_SESSION['idusuario']==14) OR ($_SESSION['idusuario']==9) OR ($_SESSION['idusuario']==7) OR ($_SESSION['idusuario']==23)) {

                          echo '
                              
                                <li><a href="zuno/vistas/ventas/ventas.php"> PG|TRACING</a></li>
                                  

                          ';
                        

                      }
                    
                  ?>



                  
                  
                  
                </ul>
              </div>
              
                
              <div class="menu_section">
               <!-- <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>               
                  
                </ul>--> 
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <!--<a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>-->
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="ajax/usuario.php?op=salir">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>

              
              
            </div>


            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="images/usuario_blank.png" alt=""><?php echo $_SESSION['nombre']; ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="javascript:;"> Perfil</a>
                        <a class="dropdown-item"  href="javascript:;">
                          <span class="badge bg-red pull-right"></span>
                          <span>Configuración</span>
                        </a>
                    <!--<a class="dropdown-item"  href="javascript:;">Ayuda</a>-->
                      <a class="dropdown-item"  href="ajax/usuario.php?op=salir"><i class="fa fa-sign-out pull-right"></i> Cerrar sesión</a>
                    </div>
                  </li>
  
                  <!--<li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-envelope-o"></i>
                      <span class="badge bg-green">6</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1" id="ul_notif">
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                          <span>
                            <span>Cliente 1</span>
                            <span class="time">Hace 3 min</span>
                          </span>
                          <span class="message">
                            Detalle de solicitud
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                          <span>
                            <span>Cliente</span>
                            <span class="time">Hace 10 min</span>
                          </span>
                          <span class="message">
                            Detalle de solicitud
                          </span>
                        </a>
                      </li>
                      
                      <li class="nav-item">
                        <div class="text-center">
                          <a class="dropdown-item">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </li>-->

                  <style type="text/css">
                    .estilo_lista_mensajes{
                      position: absolute;
                      transform: translate3d(-169px, 17px, 0px);
                      top: 0px;
                      left: 0px;
                      will-change: transform;
                    }
                  </style>



                  


                  <?php 
                    if (($_SESSION['idusuario']==1) OR ($_SESSION['idusuario']>=4 AND $_SESSION['idusuario']<=5) OR ($_SESSION['idusuario']>=7 AND $_SESSION['idusuario']<=9) OR ($_SESSION['idusuario']>=11 AND $_SESSION['idusuario']<=12) OR ($_SESSION['idusuario']==14))
                    {
                      echo '
                          
                          <li role="presentation" class="nav-item dropdown open">
                            <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false" onclick="notif_observ();">
                              <i class="fa fa-bell-o"></i>
                              <span class="badge bg-green" id="num_observ_header"></span>
                            </a>
                            <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1" id="ul_notif"> 
                            </ul>  
                          </li>

                      ';
                    }
                    ?>

                  <li role="presentation" class="nav-item dropdown open" id="li_notif" style="margin-right: 20px;">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown2_" data-toggle="dropdown" aria-expanded="false" onclick="listar_mensajes();">
                      <i class="fa fa-comments-o"></i>
                      <span class="badge bg-green" id="num_mensajes_chat"></span>

                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown2_" id="ul_mensajes"> 
                    </ul>    
                  </li>
                  
                  <li role="presentation" class="nav-item dropdown open" id="" style="margin-right: 100px; " >
                    <a href="#"  id="" data-toggle="dropdown" aria-expanded="false" onclick="ver_lista_mejoras();">
                      
                        <img src="images/iconos/web-maintenance.png" style="position: relative; width: 25px;" data-toggle="tooltip" data-placement="top" title="Ver mejoras en proceso">
                      
                      
                    </a>
                        
                  </li>

                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->


        <style type="text/css">
      

        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600);

        html {
            box-sizing: border-box;
        }
        *, *:before, *:after {
            box-sizing: inherit;
            margin: 0;
            padding: 0;
        }
        /*body {
            align-items: flex-end;
            display: flex;
            height: 100vh;
            justify-content: center;
        }*/
        .notification {
          box-shadow: 0px 0px 5px 0px rgba(0,0,0,.1);
            border-radius: 5px;
            display: flex;
            height: 100px;
            justify-content: space-between;
            opacity: 0;
            padding-right: 15px;
            position: absolute;
            right: 30px;
            top: 150px;
            visibility: hidden;
            transition: all .5s ease;
            width: 270px;
        }
        .notification.visible {
            opacity: .8;
            top: 20px;
            visibility: visible;
        }
        .notification.info {
            background-color: #2980b9;
        }
        .notification.error {
            background-color: #e74c3c;
        }
        .notification.warning {
            background-color: #f39c12;
        }
        .notification > .icon {
            align-items: center;
            display: flex;
            height: 100%;
            justify-content: center;
            width: 50px;
        }
        .notification > .icon > i {
            color: white;
            cursor: default;
        }
        .notification > .text {
            align-items: center;
            color: white;
            cursor: default;
            display: flex;
            font-family: 'Open Sans';
            font-weight: 400;
            font-size: 15px;
            width: calc(95% - 50px);
            word-wrap: normal;
        }
        .notification > .close {
            color: rgba(255, 255, 255, .8);
            cursor: pointer;
            position: absolute;
            right: 8px;
            top: 5px;
            transition: color .3s ease;
        }
        .notification > .close:hover {
            color: #fff;
        }

       


    </style>


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_notif_header">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel"></h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>

                        

                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">


                                

                                <!--<div class="col-md-12 col-sm-12" id="box_notif_header">
                                </div>-->
                                <div class="x_content" id="box_notif_header">

                                </div>
                                
                                    
                        </div>

                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          
                        </div>
                        

                      </div>
      </div>
    </div> 


    <script type="text/javascript">

        $("#globo_notif").hide();
        $("#globo_mensajes_notif").hide();

        function ver_lista_mejoras()
        {
            $("#modal_mejoras").modal("show");

            var idusuario = $("#idusuario").text();

            if (idusuario==1) {
              $("#div_nuevo_concepto").show();
            }else{
              $("#div_nuevo_concepto").hide();
            }

            

            $.post("ajax/nuevo_pedido.php?op=ver_lista_mejoras&idusuario="+idusuario,function(r){
            $("#tabla_mejoras_sistema").html(r);

            });

        }

        function cambiar_estatus(idtbl_mejoras)
        {
          

          var estatus = $("#select_upd_estat"+idtbl_mejoras).val();

          if (estatus=="Pendiente") {
            var estatus = '0';
          }
          if (estatus=="En proceso") {
            var estatus = '1';
          }
          if (estatus=="Terminado") {
            var estatus = '2';
          }

         // alert(estatus);


              $.post("ajax/nuevo_pedido.php?op=actualizar_estatus_mejora",{idtbl_mejoras:idtbl_mejoras,estatus:estatus},function(data, status)
              {
                data = JSON.parse(data);

                var idusuario = $("#idusuario").text();

                $.post("ajax/nuevo_pedido.php?op=ver_lista_mejoras&idusuario="+idusuario,function(r){
                $("#tabla_mejoras_sistema").html(r);

                });


              });


        }

        var idusuario = $("#idusuario").text();

        if (idusuario>=15 && idusuario<=22) {

          $("#globo_notif").hide();
          $("#globo_mensajes_notif").hide();
        }

        function listar_mensajes()
        {
          var idusuario = $("#idusuario").text();
           $.post("ajax/diseno.php?op=listar_mensajes&idusuario="+idusuario,function(r){
            $("#ul_mensajes").html(r);

            });
        }
      
        function notif_observ()
        {
          //var idusuario=$("#idusuario").text();
          $("#num_observ_header").hide();

          $.post("ajax/diseno.php?op=consul_notif",function(r){
          $("#ul_notif").html(r);


              $.post("ajax/diseno.php?op=num_observ_notif",function(data, status)
              {
              data = JSON.parse(data);

                if (data.num_notif_head>0) {
                  $("#num_observ_header").text(data.num_notif_head);
                  $("#num_observ_header").show();
                }

                //alert(data.num_pro_tot);
                
                //Location.reload();

                
                
              });

          });
        }

        function mostrar_todo_notif()
        {
          //var idusuario=$("#idusuario").text();
          $("#modal_notif_header").modal("show");

          $.post("ajax/diseno.php?op=consul_notif2",function(r){
          
          $("#box_notif_header").html(r);

            $("#myModalLabel").text("Notificaciones");

          });
        }

        function mostrar_todo_mensajes()
        {
          var idusuario=$("#idusuario").text();
          $("#modal_notif_header").modal("show");

          $.post("ajax/diseno.php?op=consul_todo_mensajes&idusuario="+idusuario,function(r){
          
          $("#box_notif_header").html(r);

            $("#myModalLabel").text("Mensajes");

          });
        }




        function abrir_observ_notif(idhistorial_mov)
        {
          var idusuario=$("#idusuario").text();

          if (idusuario==4) {

            $.post("ajax/diseno.php?op=abrir_observ_notif",{idhistorial_mov},function(data, status)
            {
            data = JSON.parse(data);

            });

          }

            
        }


        function contar_mensajes()
        {
          

          var idusuario = $("#idusuario").text();

          if (idusuario>=1 && idusuario<=14) {

            $.post("ajax/list_pedidos.php?op=contar_mensajes",{idusuario:idusuario},function(data, status)
            {
            data = JSON.parse(data);

              $("#num_mensajes").text(data.num_mensajes);
              $("#num_mensajes_chat").text(data.num_mensajes);

              if (data.num_mensajes>0) {
                $("#globo_notif").show();
                $("#num_mensajes_chat").show();
              }
              if (data.num_mensajes==0) {
                $("#globo_notif").hide();
                $("#num_mensajes_chat").hide();
              }

            });


          }

          //alert(idusuario);

            
        }


        function listar_controles_mensajes()
        {
          var idusuario = $("#idusuario").text();

          if (idusuario!=22) {

            $.post("ajax/list_pedidos.php?op=contar_mensajes",{idusuario:idusuario},function(data, status)
            {
            data = JSON.parse(data);

                if (data.num_mensajes>0) {
                  $.post("ajax/list_pedidos.php?op=listar_controles_mensajes&idusuario="+idusuario,function(r){
                  $("#box_controles_mensajes").html(r);

                  });
                }
                if (data.num_mensajes==0) {

                  /*var div_prod = document.getElementById('li_notif');
                  div_prod.className = 'nav-item dropdown open show';
                  var div_prod2 = document.getElementById('ul_mensajes');
                  div_prod2.className = 'dropdown-menu list-unstyled msg_list show estilo_lista_mensajes';

                  let el = document.getElementById('navbarDropdown2');
                  el.ariaExpanded = "true";
                 
                  document.getElementById("ul_mensajes").style.display = "block";
                  listar_mensajes();*/
                }               
    
            });
          }
   
          
        }

        function mostrar_mensajes_control_select(idpg_pedidos)
        {


          $("#idpedido_header").val(idpg_pedidos);
          $("#boton_down").show();

            $("#idped_marca").val("1");
            //alert(idped_marca);

            var idusuario = $("#idusuario").text();
            var idpedido = idpg_pedidos;

              $.post("ajax/list_pedidos.php?op=buscar_control",{idpedido:idpedido},function(data, status)
              {
              data = JSON.parse(data);

                $("#titulo_control_chat").text("CONTROL: "+data.no_control);

                $.post("ajax/list_pedidos.php?op=listar_chat&idpedido="+idpedido+"&idusuario="+idusuario,function(r){
                $("#box_chat").html(r);
                  
                  var elem = document.getElementById('box_chat');
                  elem.scrollTop = elem.scrollHeight;
                  $("#num_scroll").val(parseInt(elem.scrollTop));
                  $("#num_scroll2").val(parseInt(elem.scrollTop));

                  document.getElementById("caja_chat").style.display = "block";

                 /* alert(idpedido);
                  alert(idusuario);*/

                    $.post("ajax/list_pedidos.php?op=quitar_notif_control",{idpedido:idpedido,idusuario:idusuario},function(data, status)
                    {
                    data = JSON.parse(data);

                      listar_controles_mensajes();
                      contar_mensajes();

                    });


                });
                
              }); 
            
          
        }


function listar_chat()
{
  //alert("entra");
  var idusuario = $("#idusuario").text();
  var idpedido = $("#idpedido_header").val();


  var idped_marca = $("#idped_marca").val();

  if (idped_marca==1) {
    //alert("entra");

    $.post("ajax/list_pedidos.php?op=buscar_control",{idpedido:idpedido},function(data, status)
    {
    data = JSON.parse(data);

      $("#titulo_control_chat").text("CONTROL: "+data.no_control);

      $.post("ajax/list_pedidos.php?op=listar_chat&idpedido="+idpedido+"&idusuario="+idusuario,function(r){
      $("#box_chat").html(r);
        
        var elem = document.getElementById('box_chat');
        //elem.scrollHeight - elem.scrollTop === elem.clientHeight
        //$("#num_scroll2").val(elem.scrollTop);
        //alert(elem.scrollHeight);

        var scroll1 = $("#num_scroll").val();
        var scroll2 = $("#num_scroll2").val();

        if (scroll1==scroll2) {
          elem.scrollTop = elem.scrollHeight;
          $("#num_scroll").val(parseInt(elem.scrollTop));
          $("#num_scroll2").val(parseInt(elem.scrollTop));
        }else{
          //$("#boton_down").show();
          $("#num_scroll").val(parseInt(elem.scrollHeight) - parseInt(elem.clientHeight));
        }

      });
      
    });
    
  }   
    
}


function mover_scroll()
{
  var elem = document.getElementById('box_chat');
  $("#num_scroll2").val(parseInt(elem.scrollTop));

        var scroll1 = $("#num_scroll").val();
        var scroll2 = $("#num_scroll2").val();

        if (scroll1==scroll2) {
          $("#boton_down").hide();
        }else{
          $("#boton_down").show();
        }
}

function bajar_scroll()
{
  var elem = document.getElementById('box_chat');
  elem.scrollTop = elem.scrollHeight;
  $("#num_scroll").val(parseInt(elem.scrollTop));
  $("#num_scroll2").val(parseInt(elem.scrollTop));
}


function guardar_mensaje_chat()
{
  var idusuario = $("#idusuario").text();
  var idpedido = $("#idpedido_header").val();
  //alert(idpedido+"head");
  var text_chat = $("#text_chat").val();

  if (text_chat!="") {

    var fecha=moment().format('YYYY-MM-DD');
    var hora=moment().format('HH:mm:ss');
    var fecha_hora=fecha+" "+hora;

    if (idpedido>0 && idusuario>0) {

      $.post("ajax/list_pedidos.php?op=consul_lugar_pedido",{idpedido:idpedido},function(data, status)
      {
      data = JSON.parse(data);

          var lugar = data.lugar;

          //var lugar = "Fabrica";


          $.post("ajax/list_pedidos.php?op=guardar_mensaje_chat",{idpedido:idpedido,idusuario:idusuario,text_chat:text_chat,fecha_hora:fecha_hora,lugar:lugar},function(data, status)
          {
          data = JSON.parse(data);
            listar_chat();
            $("#text_chat").val("");
            var elem = document.getElementById('box_chat');

                var scroll1 = $("#num_scroll").val();
                var scroll2 = $("#num_scroll2").val();

                /*if (scroll1==scroll2) {
                  elem.scrollTop = elem.scrollHeight;
                  $("#num_scroll").val(elem.scrollTop);
                  $("#num_scroll2").val(elem.scrollTop);
                }else{*/
                  $("#boton_down").hide();
                  elem.scrollTop = elem.scrollHeight;
                  $("#num_scroll").val(parseInt(elem.scrollTop));
                  $("#num_scroll2").val(parseInt(elem.scrollTop));
                //}             
          });


      });
          

    }else{
      bootbox.alert("No se pudo enviar el mensaje, cierre y vuelva a abrir la ventana de la conversación");
    }
  }
    
}

function cerrar_chat()
{
  $("#idped_marca").val("0");
}


    function guardar_mejora()
    {

      var concepto_mejora = $("#concepto_mejora").val();
      var select_mejora = $("#select_mejora").val();
      var area_mejora = $("#area_mejora").val();

      var fecha=moment().format('YYYY-MM-DD');
      var hora=moment().format('HH:mm:ss');
      var fecha_hora=fecha+" "+hora;

      $.post("ajax/nuevo_pedido.php?op=guardar_mejora",{concepto_mejora:concepto_mejora,select_mejora:select_mejora,fecha_hora:fecha_hora,area_mejora:area_mejora},function(data, status)
      {
        data = JSON.parse(data);

            $.post("ajax/nuevo_pedido.php?op=ver_lista_mejoras",function(r){
            $("#tabla_mejoras_sistema").html(r);

            });

      });
    }


    function limpiar_campos()
    {
      $("#concepto_mejora").val("");
      $("#select_mejora").val("1");
      $("#area_mejora").val("");
    }


    </script>


    <!-- compose -->

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_mejoras">
                    <div class="modal-dialog modal-lg" style="max-width: 1200px;">
                      <div class="modal-content">

                        <div class="modal-header">
                          <label id="titulo_vale">MEJORAS DEL SISTEMA</label>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>

                        <div class="modal-body" >
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_nuevo_concepto">
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Registrar concepto</label>
                              </div>
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                  <label>Concepto</label>
                                  <input type="text" name="" id="concepto_mejora" class="form-control">
                                </div>
                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                  <label>Prioridad</label>
                                
                                  <select class="form-control selectpicker" id="select_mejora" onchange=""> 

                                      <option value="1">1</option>  
                                      <option value="2">2</option>
                                      <option value="3">3</option> 
                                        
                                  </select>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <label>Área</label>
                                  <input type="text" name="" id="area_mejora" class="form-control">
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">
                                  <button type="button" class="btn btn-dark" onclick="guardar_mejora();">Guardar</button>
                                  <button type="button" class="btn btn-dark" onclick="limpiar_campos();">Limpiar</button>
                                </div>


                              </div>
                            </div>
                              
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Tabla de conceptos</label>
                              </div>
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table class="table" id="tabla_mejoras_sistema">
                                  
                                </table> 
                              </div>
                            </div>
                              
                                                                  

                        </div>
                        <div class="modal-footer">
                                     
                                    
                          
                        </div>

                      </div>
                    </div>
    </div>

    <style type="text/css">
      .tamano{
        height: 500px; width: 400px; margin-right: 530px; box-shadow: 10px -10px 40px rgb(0,0,0,0.1), -10px -10px 40px rgb(0,0,0,0.1);
      }
    </style>
    <div id="caja_chat" class="compose tamano col-md-6">
      <div class="compose-header" style="background-color: #fff; color: #394D5F;">
        <div class="col-md-10 col-sm-10">
          <b id="titulo_control_chat" style="font-size: 15px;"></b>
        </div>
        <div class="col-md-2 col-sm-2">
          <button type="button" class="close compose-close" onclick="cerrar_chat();">
            <span>×</span>
          </button>
        </div>       
        
      </div>

      
        <div class="col-md-12 col-sm-12" style="height:350px; width: 500px; position: relative; word-wrap: break-word; overflow: scroll;" id="box_chat" onscroll="mover_scroll();">
                  
        </div>
        

      <div class="compose-footer" style="margin-top: 70%;">
        <div class="col-md-10 col-sm-10">
          <input type="hidden" id="idped_marca" value="0">
          <input type="hidden" id="num_scroll">
          <input type="hidden" id="num_scroll2">
          <a href="#" id="boton_down" onclick="bajar_scroll();">
            <div style="width: 35px; height: 35px; background-color: #4B5F71; position: absolute; margin-top: -70px; margin-left: 310px; border-radius: 50% 50%;">
                <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" style="color: #fff; margin-left: 10px; margin-top: 10px;"></span>
            </div>
          </a>
            

          <textarea class="form-control" id="text_chat" cols="40" rows="3" onkeyup=""></textarea>

        </div>
        <div class="col-md-2" style="height: 85px; border-radius: 10px 10px; padding-top: 25px; padding-right: 10px;">                               
          <a href="#" style="color: #fff; font-size: 20px;" onclick="guardar_mensaje_chat();"><img src="images/iconos/send.png" width="100%"></a>
        </div>
       
        
      </div>
    </div>



    



    <!-- /compose -->