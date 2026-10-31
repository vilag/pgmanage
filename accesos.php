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
require 'header_selector.php';
?>

        <!-- page content -->
        <div class="right_col" role="main">

          <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">

<?php
if (tiene_acceso('admin_accesos'))
{
?>
                  <div class="x_title">
                    <h2><i class="fa fa-key"></i> Accesos de usuarios</h2>
                    <?php if (accesos_menu()->es_admin_sistema($_SESSION['idusuario'])) { ?>
                      <button type="button" class="btn btn-secondary btn-sm pull-right" onclick="ver_bitacora();" id="btn_bitacora"><i class="fa fa-history"></i> Bitácora de cambios</button>
                    <?php } ?>
                    <div class="clearfix"></div>
                  </div>

                  <!-- data-hj-suppress: Hotjar no graba los datos de usuarios y permisos de esta vista -->
                  <div class="x_content" data-hj-suppress>
                    <?php $info_menu=accesos_menu()->info_menu_global(); ?>
                    <div class="alert" style="background-color: #F2F5F7; border: 1px solid #e5e5e5; color: #2A3F54;">
                      <i class="fa fa-users"></i> Menú del sistema para todos los usuarios:
                      <b><?php echo $info_menu && $info_menu['valor']==1 ? 'Nuevo' : 'Anterior'; ?></b>
                      <?php if ($info_menu && $info_menu['fecha']) { ?>
                        <small style="color: #73879C;">(cambiado por <?php echo htmlspecialchars(trim((string)$info_menu['quien'])); ?> el <?php echo htmlspecialchars($info_menu['fecha']); ?>)</small>
                      <?php } ?>
                    </div>
                    <p style="color: #73879C;">
                      Los accesos marcados aquí controlan el <b>menú nuevo</b>. El menú anterior (header.php) funciona por ID de usuario.
                      El administrador del sistema cambia el menú de todos con el botón inferior derecho; quien tenga el permiso
                      "Cambiar menú" (Dirección o Administrativo) puede probar el otro menú solo para sí mismo.
                    </p>

                    <style type="text/css">
                      .nivel_acceso { color: #fff; font-size: 11px; }
                      .nivel_acceso[data-nivel="Total"]      { background-color: #6A1B9A; }
                      .nivel_acceso[data-nivel="Alto"]       { background-color: #1565C0; }
                      .nivel_acceso[data-nivel="Medio"]      { background-color: #2E7D32; }
                      .nivel_acceso[data-nivel="Básico"]     { background-color: #EF6C00; }
                      .nivel_acceso[data-nivel="Limitado"]   { background-color: #757575; }
                      .nivel_acceso[data-nivel="Sin acceso"] { background-color: #C62828; }
                      .tarjeta_categoria { cursor: pointer; border: 1px solid #e5e5e5; border-radius: 4px; padding: 8px 12px; margin: 0 8px 8px 0; display: inline-block; background-color: #fff; }
                      .tarjeta_categoria:hover, .tarjeta_categoria.activa { border-color: #2A3F54; background-color: #F2F5F7; }
                      .tarjeta_categoria b { font-size: 18px; display: block; }
                    </style>

                    <div id="resumen_categorias" style="margin-bottom: 10px;">
                    </div>

                    <div class="row" style="margin-bottom: 10px;">
                      <div class="col-md-4 col-sm-12">
                        <label>Categoría</label>
                        <select class="form-control" id="filtro_categoria" onchange="filtrar_usuarios();">
                          <option value="">Todas</option>
                          <?php
                          //Las categorías se cargan una vez con la página y sirven para este filtro y para la
                          //ventana de accesos (categorias_accesos en JS): así esa ventana no las vuelve a pedir
                          $editor_es_admin=accesos_menu()->es_admin_sistema($_SESSION['idusuario']);
                          $editor_es_developer=accesos_menu()->es_developer($_SESSION['idusuario']);
                          $categorias_js=array();
                          $rspta_categorias=accesos_menu()->listar_categorias();
                          while ($categoria = $rspta_categorias->fetch_object()) {
                            echo '<option value="'.(int)$categoria->idcategoria_usuario.'">'.htmlspecialchars($categoria->nombre).'</option>';
                            $categorias_js[]=array(
                              'id'=>(int)$categoria->idcategoria_usuario,
                              'clave'=>$categoria->clave,
                              'nombre'=>$categoria->nombre,
                              'descripcion'=>$categoria->descripcion,
                              //Developer solo lo asigna un developer; administrador del sistema, quien tenga nivel de administrador
                              'permitida'=>$categoria->clave==Accesos::CATEGORIA_DEVELOPER ? $editor_es_developer
                                : ($editor_es_admin || $categoria->clave!=Accesos::CATEGORIA_ADMIN)
                            );
                          }
                          ?>
                          <option value="0">Sin clasificar</option>
                        </select>
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <label>Nivel de acceso</label>
                        <select class="form-control" id="filtro_nivel" onchange="filtrar_usuarios();">
                          <option value="">Todos</option>
                          <option>Total</option>
                          <option>Alto</option>
                          <option>Medio</option>
                          <option>Básico</option>
                          <option>Limitado</option>
                          <option>Sin acceso</option>
                        </select>
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <label>Buscar</label>
                        <input type="text" class="form-control" id="filtro_texto" placeholder="Nombre, puesto o usuario" onkeyup="filtrar_usuarios();">
                      </div>
                    </div>

                    <p style="color: #73879C; font-size: 12px;">
                      El nivel se calcula con las vistas de operación marcadas (no cuentan "Accesos de usuarios" ni "Cambiar menú"):
                      <span class="badge nivel_acceso" data-nivel="Total">Total</span> todas, incluidas las de administración ·
                      <span class="badge nivel_acceso" data-nivel="Alto">Alto</span> 55% o más ·
                      <span class="badge nivel_acceso" data-nivel="Medio">Medio</span> 28% o más ·
                      <span class="badge nivel_acceso" data-nivel="Básico">Básico</span> 2 o más ·
                      <span class="badge nivel_acceso" data-nivel="Limitado">Limitado</span> 1 o solo permisos de administración ·
                      <span class="badge nivel_acceso" data-nivel="Sin acceso">Sin acceso</span> ninguna
                    </p>

                    <div style="overflow-x: auto;">
                      <table id="tbl_usuarios_accesos" class="table table-hover">
                      </table>
                    </div>
                  </div>
<?php
}
else
{
?>
                  <div class="x_content">
                    <h4>No tiene acceso a esta vista.</h4>
                  </div>
<?php
}
?>

                </div>
              </div>
            </div>

          </div>

        </div>
        <!-- /page content -->

      </div>
    </div>


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_bitacora">
      <div class="modal-dialog modal-lg" style="max-width: 1200px;">
        <div class="modal-content" data-hj-suppress>

          <div class="modal-header">
            <h4 class="modal-title"><i class="fa fa-history"></i> Bitácora de cambios de accesos</h4>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          </div>

          <div class="modal-body" style="overflow: auto; max-height: 550px;">
            <p style="color: #73879C; font-size: 12px;">Últimos 300 cambios. Los registros no se pueden editar ni borrar desde el sistema.</p>
            <table class="table table-sm" id="tbl_bitacora" style="font-size: 12px;">
            </table>
          </div>

        </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_accesos">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" data-hj-suppress>

          <div class="modal-header">
            <h4 class="modal-title" id="titulo_accesos"></h4>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          </div>

          <div class="modal-body" style="overflow-y: auto; max-height: 500px;">
            <input type="hidden" id="idusuario_accesos">
            <input type="hidden" id="total_vistas_accesos">
            <input type="hidden" id="total_operativas_accesos">

            <div class="alert alert-warning" id="aviso_accesos" style="display: none; color: #8a6d3b; background-color: #fcf8e3; border-color: #faebcc;"></div>

            <div class="row" style="margin-bottom: 15px;">
              <div class="col-md-6 col-sm-12">
                <label>Categoría</label>
                <select class="form-control" id="categoria_accesos">
                </select>
              </div>
              <div class="col-md-6 col-sm-12">
                <label>Nivel de acceso</label>
                <div style="padding-top: 6px;">
                  <span class="badge nivel_acceso" id="nivel_accesos_modal"></span>
                  <small style="color: #999;" id="conteo_accesos_modal"></small>
                </div>
              </div>
            </div>

            <div class="row" id="box_accesos">
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn_editar_accesos" onclick="marcar_todos(true);">Marcar todos</button>
            <button type="button" class="btn btn-secondary btn_editar_accesos" onclick="marcar_todos(false);">Desmarcar todos</button>
            <button type="button" class="btn btn-dark btn_editar_accesos" onclick="guardar_accesos();" id="btn_guardar_accesos">Guardar</button>
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

    <script type="text/javascript">
      var categorias_accesos = <?php echo json_encode(isset($categorias_js) ? $categorias_js : array(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
    </script>
    <!-- Custom Theme Scripts -->
    <script type="text/javascript" src="scripts/accesos.js?v=<?php echo(rand()); ?>"></script>
    <script src="build/js/custom.min.js"></script>
    <script src="public/js/bootbox.min.js"></script>

  </body>
</html>

<?php
}
ob_end_flush();
?>
