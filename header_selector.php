<?php
//Decide qué menú mostrar: header.php (actual, por idusuario) o header_nuevo.php (ligado a la vista de accesos).
//El administrador del sistema elige el menú de TODOS los usuarios. Quien él autorice de Dirección o
//Administrativo puede probar el otro menú solo para sí mismo (ver Accesos::menu_efectivo).
//Si algo falla con el menú nuevo, abrir cualquier página con ?menu=anterior regresa al menú anterior.
//
//El menú de cada usuario se guarda MENU_CACHE_SEGUNDOS en su sesión: mientras tanto las páginas no abren
//conexión a la base (antes del nuevo menú el header no la usaba, y el hosting limita las conexiones por hora).
//Un cambio de permisos hecho por otro usuario tarda como máximo ese tiempo en verse.
require_once __DIR__."/config/seguridad.php";

if (!defined('MENU_CACHE_SEGUNDOS')) {
  define('MENU_CACHE_SEGUNDOS', 60);
}
if (!defined('MENU_CACHE_VERSION')) {
  //Subir este número si cambia lo que devuelve Accesos::contexto_menu: invalida los menús ya guardados
  define('MENU_CACHE_VERSION', 1);
}

//Modelo de accesos bajo demanda: incluirlo abre la conexión a la base (config/Conexion.php)
if (!function_exists('accesos_menu'))
{
  function accesos_menu()
  {
    //config/Conexion.php crea $conexion al incluirse; dentro de esta función quedaría local y las consultas
    //(que usan la global) fallarían. Declararla global antes de incluir hace que se cree como global.
    global $conexion;
    static $accesos=null;
    if ($accesos===null) {
      require_once __DIR__."/modelos/Accesos.php";
      $accesos=new Accesos();
    }
    return $accesos;
  }
}

$ctx_menu=null;
$menu_desde_cache=false;
$cache_menu=isset($_SESSION['ctx_menu']) ? $_SESSION['ctx_menu'] : null;
if (!isset($_GET['menu']) && is_array($cache_menu) && isset($cache_menu['version']) && $cache_menu['version']==MENU_CACHE_VERSION
    && $cache_menu['idusuario']==$_SESSION['idusuario'] && $cache_menu['hasta']>time()) {
  $ctx_menu=$cache_menu['ctx'];
  $menu_desde_cache=true;
} else {
  //Una sola consulta (ver Accesos::contexto_menu)
  $ctx_menu=accesos_menu()->contexto_menu($_SESSION['idusuario']);
}
$es_admin_menu=$ctx_menu['es_admin'];
$puede_cambiar_menu=$ctx_menu['puede_cambiar'];

//Salida de emergencia por dirección (?menu=anterior), para todos los usuarios.
//?menu=nuevo solo para quien puede probar el menú nuevo para sí mismo. El administrador del sistema
//solo puede usar ?menu=anterior (regresa a todos); activar el nuevo para todos requiere el botón con
//confirmación, para que un enlace externo no pueda cambiar el menú de toda la empresa.
if (isset($_GET['menu'])) {
  if ($es_admin_menu) {
    if ($_GET['menu']=='anterior' && $ctx_menu['global']!=0) {
      accesos_menu()->cambiar_menu_global($_SESSION['idusuario'], 0);
      $ctx_menu=accesos_menu()->contexto_menu($_SESSION['idusuario'], true);
    }
  } elseif ($_GET['menu']=='anterior' || ($_GET['menu']=='nuevo' && $puede_cambiar_menu)) {
    accesos_menu()->cambiar_menu($_SESSION['idusuario'], $_GET['menu']=='nuevo' ? 1 : 0);
    $ctx_menu=accesos_menu()->contexto_menu($_SESSION['idusuario'], true);
  }
}

//Se guarda cada lectura nueva de la base, solo si fue correcta (si la base falló, la siguiente página reintenta)
if (!$menu_desde_cache && $ctx_menu['existe']) {
  $_SESSION['ctx_menu']=array('version'=>MENU_CACHE_VERSION, 'idusuario'=>$_SESSION['idusuario'], 'hasta'=>time()+MENU_CACHE_SEGUNDOS, 'ctx'=>$ctx_menu);
}

$claves_acceso=$ctx_menu['claves'];
$usar_menu_nuevo=$ctx_menu['usar_nuevo'];

if (!function_exists('tiene_acceso'))
{
  function tiene_acceso($clave)
  {
    global $claves_acceso;
    return in_array($clave, $claves_acceso);
  }
}

if ($usar_menu_nuevo) {
  require 'header_nuevo.php';
} else {
  require 'header.php';
}
?>

<?php if ($puede_cambiar_menu || (!$usar_menu_nuevo && tiene_acceso('admin_accesos'))) { ?>
<div id="switch_menu" style="position: fixed; bottom: 15px; right: 15px; z-index: 9998; background-color: #fff; box-shadow: 0px 0px 20px rgb(0,0,0,0.3); border-radius: 20px; padding: 6px 14px; font-size: 12px;">
  <?php if ($es_admin_menu) { ?>
    <?php if ($usar_menu_nuevo) { ?>
      <i class="fa fa-users"></i> Menú nuevo para todos
      &nbsp;|&nbsp; <a href="#" onclick="cambiar_menu(0); return false;">Volver al menú anterior para todos</a>
    <?php } else { ?>
      <a href="#" onclick="cambiar_menu(1); return false;"><i class="fa fa-users"></i> Activar menú nuevo para todos</a>
      &nbsp;|&nbsp; <a href="accesos.php"><i class="fa fa-key"></i> Accesos</a>
      <?php if ($ctx_menu['es_developer']) { ?>
        &nbsp;|&nbsp; <a href="qa_refresco.php"><i class="fa fa-database"></i> Refrescar QA</a>
      <?php } ?>
    <?php } ?>
  <?php } elseif ($usar_menu_nuevo) { ?>
    <i class="fa fa-flask"></i> Menú nuevo
    <?php if ($puede_cambiar_menu) { ?>
      &nbsp;|&nbsp; <a href="#" onclick="cambiar_menu(0); return false;">Volver al menú anterior (solo para mí)</a>
    <?php } ?>
  <?php } else { ?>
    <?php if ($puede_cambiar_menu) { ?>
      <a href="#" onclick="cambiar_menu(1); return false;"><i class="fa fa-flask"></i> Probar menú nuevo (solo para mí)</a>
    <?php } ?>
    <?php if ($puede_cambiar_menu && tiene_acceso('admin_accesos')) { ?>
      &nbsp;|&nbsp;
    <?php } ?>
    <?php if (tiene_acceso('admin_accesos')) { ?>
      <a href="accesos.php"><i class="fa fa-key"></i> Accesos</a>
    <?php } ?>
  <?php } ?>
</div>

<script type="text/javascript">
  var cambio_menu_global = <?php echo $es_admin_menu ? 'true' : 'false'; ?>;

  function cambiar_menu(menu_nuevo) {
    //El administrador cambia el menú de todos los usuarios: se confirma antes
    if (cambio_menu_global && !confirm(menu_nuevo == 1
        ? "Se activará el MENÚ NUEVO para TODOS los usuarios.\nLos demás lo verán al abrir su siguiente página (en máximo 1 minuto).\n\n¿Desea continuar?"
        : "Se regresará al MENÚ ANTERIOR a TODOS los usuarios.\nLos demás lo verán al abrir su siguiente página (en máximo 1 minuto).\n\n¿Desea continuar?")) {
      return;
    }

    $.post("ajax/accesos.php?op=cambiar_menu", { menu_nuevo: menu_nuevo }, function (data, status) {
      data = JSON.parse(data);

      if (data.ok) {
        //Quitamos ?menu= y el #ancla de la URL; con solo el ancla distinta el navegador no recarga
        var actual = location.href.split("#")[0];
        var url = actual.replace(/([?&])menu=(anterior|nuevo)&?/, "$1").replace(/[?&]$/, "");

        if (url == actual) {
          location.reload();
        } else {
          location.href = url;
        }
      } else {
        alert(data.message ? data.message : "No se pudo cambiar el menú. Verifique que se hayan ejecutado los scripts de la carpeta sql/");
      }
    });
  }
</script>
<?php } ?>
