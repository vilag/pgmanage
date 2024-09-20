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

        <script type="text/javascript">
          

      

        </script>

        <!-- page content -->
        <div class="right_col" role="main">
          <div style="width: 100%; display: flex; align-items: center; justify-content: center; padding: 5px 50px;">
            <img src="images/img_grupo/logo2.png" alt="" style="width: 80%;"> 
          </div>
          <div style="width: 50%; display: flex; align-items: center; justify-content: center; padding: 5px 50px; float: left;">
            <img src="images/img_grupo/icono.png" alt="" style="width: 30%;"> 
          </div>   
          <div style="width: 50%; display: flex; align-items: center; justify-content: center; padding: 5px 50px; float: left;">
            <img src="images/img_grupo/logo_sin_fondo.png" alt="" style="width: 30%;"> 
          </div>                 
            <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/BCm_p8wTEH0?si=kJEUIsjI0BuJzg6h" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> -->
            <!-- <img style="width: 80vw;" src="https://res.cloudinary.com/ddcszcshl/image/upload/v1725046537/imagen_bienvenida_pg_xrbbk7.jpg" alt=""> -->
          
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
    <!-- bootstrap-wysiwyg -->
    <script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="vendors/google-code-prettify/src/prettify.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    <script type="text/javascript" src="scripts/list_pedidos.js?v=<?php echo(rand()); ?>"></script>
    <script src="public/js/bootbox.min.js"></script>

  </body>
</html>



<?php
}
ob_end_flush();
?>