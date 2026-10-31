<?php
//Se incluye desde las páginas cuando el usuario no tiene el rol requerido (require 'noacceso.php').
//El header ya se imprimió, así que aquí solo va el contenido y el cierre de la página.
if (!headers_sent()) {
  http_response_code(403);
}
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel" style="text-align: center; padding: 50px 20px;">
                  <i class="fa fa-lock" style="font-size: 48px; color: #73879C;"></i>
                  <h3 style="margin-top: 20px;">No tiene acceso a esta página</h3>
                  <p style="color: #73879C;">Si necesita entrar, solicite el acceso al administrador del sistema.</p>
                  <a href="welcomeUser.php" class="btn btn-dark" style="margin-top: 15px;"><i class="fa fa-home"></i> Ir al inicio</a>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- /page content -->

      </div>
    </div>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

  </body>
</html>
