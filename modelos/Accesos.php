<?php
//Ruta absoluta: este modelo también se carga desde header_selector.php (raíz del proyecto)
require_once __DIR__."/../config/Conexion.php";

Class Accesos
{
	//Clave de la categoría con acceso total que no se puede perder
	const CATEGORIA_ADMIN='admin_sistema';
	//Nivel técnico por encima del administrador: todo lo del administrador más las herramientas de desarrollo
	//(refrescar QA). Un administrador no puede editar a un developer ni asignar esta categoría.
	const CATEGORIA_DEVELOPER='developer';
	//Categorías con nivel de administrador (acceso total)
	const CATEGORIAS_NIVEL_ADMIN=array('developer','admin_sistema');
	//Categorías a las que el administrador puede dar el botón de cambio de menú
	const CATEGORIAS_CAMBIAR_MENU=array('direccion','administrativo');
	//Vistas que solo el administrador del sistema puede otorgar o quitar
	const VISTAS_SOLO_ADMIN=array('admin_accesos','cambiar_menu');

	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	public function listar_usuarios()
	{
		$solo_admin="'".implode("','", self::VISTAS_SOLO_ADMIN)."'";
		$nivel_admin="'".implode("','", self::CATEGORIAS_NIVEL_ADMIN)."'";
		$sql="SELECT u.idusuario, u.nombre, u.apellido_p, u.apellido_m, u.puesto, u.login, u.lugar, u.estatus,
				IF(c.clave IN ($nivel_admin),
					(SELECT COUNT(*) FROM acceso_vista),
					(SELECT COUNT(*) FROM usuario_acceso_vista uav INNER JOIN acceso_vista av ON av.idacceso_vista=uav.idacceso_vista
						WHERE uav.idusuario=u.idusuario)) AS num_accesos,
				IF(c.clave IN ($nivel_admin),
					(SELECT COUNT(*) FROM acceso_vista WHERE clave NOT IN ($solo_admin)),
					(SELECT COUNT(*) FROM usuario_acceso_vista uav INNER JOIN acceso_vista av ON av.idacceso_vista=uav.idacceso_vista
						WHERE uav.idusuario=u.idusuario AND av.clave NOT IN ($solo_admin))) AS num_operativas,
				/* Datos para calcular el menú que realmente ve (Accesos::menu_efectivo) */
				p.menu_nuevo AS pref_menu,
				EXISTS (SELECT 1 FROM usuario_acceso_vista x INNER JOIN acceso_vista ax ON ax.idacceso_vista=x.idacceso_vista
					WHERE x.idusuario=u.idusuario AND ax.clave='cambiar_menu') AS tiene_cambiar_menu,
				IFNULL(c.idcategoria_usuario,0) AS idcategoria_usuario,
				IFNULL(c.clave,'') AS categoria_clave,
				IFNULL(c.nombre,'Sin clasificar') AS categoria,
				/* Totales del catálogo en la misma consulta (no dependen de la fila; el servidor los calcula una vez) */
				(SELECT COUNT(*) FROM acceso_vista) AS total_vistas,
				(SELECT COUNT(*) FROM acceso_vista WHERE clave NOT IN ($solo_admin)) AS total_operativas
			FROM usuario u
			LEFT JOIN usuario_menu_pref p ON p.idusuario=u.idusuario
			LEFT JOIN usuario_categoria uc ON uc.idusuario=u.idusuario
			LEFT JOIN categoria_usuario c ON c.idcategoria_usuario=uc.idcategoria_usuario
			ORDER BY IFNULL(c.orden,9999), u.idusuario";
		return ejecutarConsulta($sql);
	}

	//Clave de la categoría del usuario ('' si no está clasificado o las tablas no existen).
	//Sale de contexto_menu: una consulta por usuario y por petición, reutilizada por las demás funciones.
	public function categoria_clave($idusuario)
	{
		$ctx=$this->contexto_menu($idusuario);
		return $ctx['categoria'];
	}

	public function categoria_clave_por_id($idcategoria_usuario)
	{
		$idcategoria_usuario=(int)$idcategoria_usuario;
		$rspta=ejecutarConsulta("SELECT clave FROM categoria_usuario WHERE idcategoria_usuario='$idcategoria_usuario'");
		if ($rspta && $reg = $rspta->fetch_object()) {
			return (string)$reg->clave;
		}
		return '';
	}

	//Nivel de administrador: administrador del sistema o developer
	public function es_admin_sistema($idusuario)
	{
		$ctx=$this->contexto_menu($idusuario);
		return $ctx['es_admin'];
	}

	public function es_developer($idusuario)
	{
		$ctx=$this->contexto_menu($idusuario);
		return $ctx['es_developer'];
	}

	public static function es_nivel_admin($clave_categoria)
	{
		return in_array($clave_categoria, self::CATEGORIAS_NIVEL_ADMIN);
	}

	//El administrador del sistema siempre puede; los demás solo con el permiso y si son de Dirección o Administrativo
	public function puede_cambiar_menu($idusuario)
	{
		$ctx=$this->contexto_menu($idusuario);
		return $ctx['puede_cambiar'];
	}

	private $catalogo=null;

	//Catálogo de vistas ordenado, cargado una sola vez por petición
	public function catalogo()
	{
		if ($this->catalogo===null) {
			$this->catalogo=array();
			$rspta=ejecutarConsulta("SELECT * FROM acceso_vista ORDER BY orden");
			if ($rspta) {
				while ($reg = $rspta->fetch_object()) {
					$this->catalogo[]=$reg;
				}
			}
		}
		return $this->catalogo;
	}

	//Después de guardar, lo leído antes ya no es válido
	private function limpiar_cache()
	{
		$this->contexto=array();
		$this->catalogo=null;
	}

	public function ids_todas_vistas()
	{
		$ids=array();
		foreach ($this->catalogo() as $vista) {
			$ids[]=(int)$vista->idacceso_vista;
		}
		return $ids;
	}

	//IDs de vista a partir de claves (para no volver a consultar lo que ya trae contexto_menu)
	public function ids_por_claves($claves)
	{
		$ids=array();
		foreach ($this->catalogo() as $vista) {
			if (in_array($vista->clave, $claves)) {
				$ids[]=(int)$vista->idacceso_vista;
			}
		}
		return $ids;
	}

	public function listar_categorias()
	{
		$sql="SELECT * FROM categoria_usuario ORDER BY orden";
		return ejecutarConsulta($sql);
	}

	public function total_vistas()
	{
		return count($this->catalogo());
	}

	//Vistas de operación: todas menos los permisos de administración (VISTAS_SOLO_ADMIN)
	public function total_operativas()
	{
		$total=0;
		foreach ($this->catalogo() as $vista) {
			if (!in_array($vista->clave, self::VISTAS_SOLO_ADMIN)) {
				$total++;
			}
		}
		return $total;
	}

	//Nivel según la proporción de vistas de operación, para que agregar permisos de administración no cambie
	//el nivel de nadie. "Total" es tener todas las vistas, incluidas las de administración.
	//Debe coincidir con nivel_accesos() de scripts/accesos.js
	public static function nivel_accesos($num, $total, $num_todas, $total_todas)
	{
		if ($total_todas>0 && $num_todas>=$total_todas) return 'Total';
		//Solo con permisos de administración cae en Limitado, no en Sin acceso
		if ($num_todas<=0 || $total<=0) return 'Sin acceso';
		if ($num>=ceil($total*0.55)) return 'Alto';
		if ($num>=ceil($total*0.28)) return 'Medio';
		if ($num>=2) return 'Básico';
		return 'Limitado';
	}

	public function id_por_clave($clave)
	{
		$ids=$this->ids_por_claves(array($clave));
		return $ids ? $ids[0] : 0;
	}

	public function ids_usuario($idusuario)
	{
		$idusuario=(int)$idusuario;
		$sql="SELECT idacceso_vista FROM usuario_acceso_vista WHERE idusuario='$idusuario'";
		$rspta=ejecutarConsulta($sql);

		$ids=array();
		if ($rspta) {
			while ($reg = $rspta->fetch_object()) {
				$ids[]=(int)$reg->idacceso_vista;
			}
		}
		return $ids;
	}

	//Claves de las vistas a las que tiene acceso el usuario (array vacío si las tablas no existen).
	//El administrador del sistema recibe todas, aunque falte alguna fila o se agreguen vistas nuevas.
	public function claves_usuario($idusuario)
	{
		$ctx=$this->contexto_menu($idusuario);
		return $ctx['claves'];
	}

	//Devuelve '' si el editor puede modificar al usuario, o el motivo por el que no
	public function motivo_no_editable($idusuario_editor, $idusuario)
	{
		if ((int)$idusuario_editor==(int)$idusuario) {
			return 'No puede modificar sus propios accesos ni su categoría.';
		}
		//Developer está por encima del administrador del sistema
		if ($this->es_developer($idusuario) && !$this->es_developer($idusuario_editor)) {
			return 'Solo un developer puede modificar a otro developer.';
		}
		if (!$this->es_admin_sistema($idusuario_editor)) {
			if ($this->es_admin_sistema($idusuario)) {
				return 'Solo otro administrador del sistema puede modificar a un administrador del sistema.';
			}
			//Evita que dos editores se pasen accesos entre sí y sumen los de ambos
			if (in_array('admin_accesos', $this->claves_usuario($idusuario))) {
				return 'Solo el administrador del sistema puede modificar a otro usuario con acceso a esta vista.';
			}
		}
		return '';
	}

	//Vistas que el editor no puede cambiar en el usuario: array(idacceso_vista => motivo)
	public function vistas_bloqueadas($idusuario_editor, $idusuario)
	{
		$editor_admin=$this->es_admin_sistema($idusuario_editor);
		$destino_admin=$this->es_admin_sistema($idusuario);
		$claves_editor=$this->claves_usuario($idusuario_editor);

		$bloqueadas=array();
		foreach ($this->catalogo() as $reg)
			{
				$motivo='';
				if ($destino_admin) {
					$motivo='Tiene nivel de administrador (administrador del sistema o developer): siempre tiene acceso total';
				} elseif (!$editor_admin && in_array($reg->clave, self::VISTAS_SOLO_ADMIN)) {
					$motivo='Solo el administrador del sistema puede asignar este acceso';
				} elseif (!$editor_admin && !in_array($reg->clave, $claves_editor)) {
					$motivo='No puede asignar un acceso que usted no tiene';
				}

				if ($motivo!='') {
					$bloqueadas[(int)$reg->idacceso_vista]=$motivo;
				}
			}
		return $bloqueadas;
	}

	//Aplica los bloqueos a lo que envió el editor. Devuelve array('error'=>'', 'ids'=>array(), 'idcategoria_usuario'=>int)
	public function preparar_guardado($idusuario_editor, $idusuario, $ids, $idcategoria_usuario)
	{
		$resultado=array('error'=>'', 'ids'=>array(), 'idcategoria_usuario'=>0);

		$motivo=$this->motivo_no_editable($idusuario_editor, $idusuario);
		if ($motivo!='') {
			$resultado['error']=$motivo;
			return $resultado;
		}

		$categoria_destino=$idcategoria_usuario>0 ? $this->categoria_clave_por_id($idcategoria_usuario) : '';
		if ($categoria_destino=='') {
			$idcategoria_usuario=0;
		}

		if ($categoria_destino==self::CATEGORIA_DEVELOPER && !$this->es_developer($idusuario_editor)) {
			$resultado['error']='Solo un developer puede asignar la categoría developer.';
			return $resultado;
		}
		if ($categoria_destino==self::CATEGORIA_ADMIN && !$this->es_admin_sistema($idusuario_editor)) {
			$resultado['error']='Solo el administrador del sistema puede asignar la categoría de administrador del sistema.';
			return $resultado;
		}

		$todas=$this->ids_todas_vistas();
		$ids=array_values(array_intersect(array_unique(array_map('intval', $ids)), $todas));

		if (self::es_nivel_admin($categoria_destino)) {
			$ids=$todas;
		} else {
			//Las vistas bloqueadas conservan el valor que ya tenía el usuario
			$bloqueadas=array_keys($this->vistas_bloqueadas($idusuario_editor, $idusuario));
			$actuales=$this->es_admin_sistema($idusuario) ? $todas : $this->ids_usuario($idusuario);
			$ids=array_merge(array_diff($ids, $bloqueadas), array_intersect($actuales, $bloqueadas));

			if (!in_array($categoria_destino, self::CATEGORIAS_CAMBIAR_MENU)) {
				$ids=array_diff($ids, array($this->id_por_clave('cambiar_menu')));
			}
		}

		$resultado['ids']=array_values(array_unique($ids));
		$resultado['idcategoria_usuario']=(int)$idcategoria_usuario;
		return $resultado;
	}

	public function guardar_accesos($idusuario, $ids, $idcategoria_usuario, $idusuario_editor)
	{
		global $conexion;
		$idusuario=(int)$idusuario;
		$idcategoria_usuario=(int)$idcategoria_usuario;
		$idusuario_editor=(int)$idusuario_editor;
		$ids=array_unique(array_filter(array_map('intval', $ids)));

		//Estado anterior para la bitácora
		$ids_antes=$this->ids_usuario($idusuario);
		$categoria_antes=$this->categoria_nombre_usuario($idusuario);

		//Todo o nada: si algo falla, el usuario conserva los accesos que tenía y no queda registro en la bitácora
		$conexion->begin_transaction();
		try {
			if (!ejecutarConsulta("DELETE FROM usuario_acceso_vista WHERE idusuario='$idusuario'")) {
				throw new Exception($conexion->error);
			}
			if (count($ids)>0) {
				$sql="INSERT INTO usuario_acceso_vista (idusuario, idacceso_vista)
					SELECT '$idusuario', idacceso_vista FROM acceso_vista WHERE idacceso_vista IN (".implode(',', $ids).")";
				if (!ejecutarConsulta($sql)) {
					throw new Exception($conexion->error);
				}
			}

			//Categoría 0 = sin clasificar
			if (!ejecutarConsulta("DELETE FROM usuario_categoria WHERE idusuario='$idusuario'")) {
				throw new Exception($conexion->error);
			}
			if ($idcategoria_usuario>0) {
				$sql="INSERT INTO usuario_categoria (idusuario, idcategoria_usuario)
					SELECT '$idusuario', idcategoria_usuario FROM categoria_usuario WHERE idcategoria_usuario='$idcategoria_usuario'";
				if (!ejecutarConsulta($sql)) {
					throw new Exception($conexion->error);
				}
			}

			$this->registrar_bitacora($idusuario_editor, $idusuario, $ids_antes, $this->ids_usuario($idusuario),
				$categoria_antes, $this->categoria_nombre_usuario($idusuario));

			$conexion->commit();
			$this->limpiar_cache();
			return true;
		} catch (Throwable $e) {
			$conexion->rollback();
			return false;
		}
	}

	public function categoria_nombre_usuario($idusuario)
	{
		$idusuario=(int)$idusuario;
		$reg=ejecutarConsultaSimpleFila("SELECT c.nombre FROM usuario_categoria uc
			INNER JOIN categoria_usuario c ON c.idcategoria_usuario=uc.idcategoria_usuario
			WHERE uc.idusuario='$idusuario'");
		return $reg ? $reg['nombre'] : 'Sin clasificar';
	}

	//Registra un cambio de accesos. Solo inserta: la aplicación no edita ni borra la bitácora.
	//Si no cambió nada, no registra. Lanza excepción si falla, para deshacer el guardado completo.
	private function registrar_bitacora($idusuario_editor, $idusuario, $ids_antes, $ids_despues, $categoria_antes, $categoria_despues)
	{
		global $conexion;

		$nombres=array();
		foreach ($this->catalogo() as $reg) {
			$nombres[(int)$reg->idacceso_vista]=$reg->grupo.' > '.$reg->nombre;
		}
		$a_texto=function($ids) use ($nombres) {
			$textos=array();
			foreach ($ids as $id) {
				$textos[]=isset($nombres[$id]) ? $nombres[$id] : 'Vista '.$id;
			}
			return implode(', ', $textos);
		};

		$agregados=$a_texto(array_diff($ids_despues, $ids_antes));
		$quitados=$a_texto(array_diff($ids_antes, $ids_despues));
		if ($agregados=='' && $quitados=='' && $categoria_antes==$categoria_despues) {
			return;
		}

		$ip=isset($_SERVER['REMOTE_ADDR']) ? substr($_SERVER['REMOTE_ADDR'], 0, 45) : '';
		$stmt=$conexion->prepare("INSERT INTO bitacora_accesos
			(fecha, idusuario_editor, idusuario, categoria_antes, categoria_despues, agregados, quitados, ip)
			VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?)");
		if (!$stmt) {
			throw new Exception($conexion->error);
		}
		$stmt->bind_param('iisssss', $idusuario_editor, $idusuario, $categoria_antes, $categoria_despues, $agregados, $quitados, $ip);
		if (!$stmt->execute()) {
			throw new Exception($stmt->error);
		}
		$stmt->close();
	}

	public function listar_bitacora()
	{
		$sql="SELECT b.*, CONCAT_WS(' ', e.nombre, e.apellido_p) AS editor, e.login AS editor_login,
				CONCAT_WS(' ', u.nombre, u.apellido_p) AS usuario, u.login AS usuario_login
			FROM bitacora_accesos b
			LEFT JOIN usuario e ON e.idusuario=b.idusuario_editor
			LEFT JOIN usuario u ON u.idusuario=b.idusuario
			ORDER BY b.idbitacora_accesos DESC
			LIMIT 300";
		return ejecutarConsulta($sql);
	}

	//Elección personal del usuario: 1 = nuevo, 0 = anterior, null = no ha elegido (o la tabla no existe)
	public function pref_menu($idusuario)
	{
		$ctx=$this->contexto_menu($idusuario);
		return $ctx['pref'];
	}

	//Menú elegido por el administrador del sistema para todos: 1 = nuevo, 0 = anterior (0 si la tabla no existe)
	public function menu_global()
	{
		try {
			$rspta=ejecutarConsulta("SELECT valor FROM configuracion_sistema WHERE clave='menu_nuevo_global'");
			if ($rspta && $reg = $rspta->fetch_object()) {
				return (int)$reg->valor==1 ? 1 : 0;
			}
		} catch (Throwable $e) {
		}
		return 0;
	}

	//Regla única de qué menú ve un usuario (la usan el header y la vista de accesos):
	// - el administrador del sistema siempre ve el menú que eligió para todos;
	// - una elección personal de "anterior" siempre se respeta (salida de emergencia ?menu=anterior);
	// - una elección personal de "nuevo" solo cuenta si conserva el permiso de cambiar menú;
	// - en cualquier otro caso, el menú que eligió el administrador para todos.
	public static function menu_efectivo($es_admin, $puede_cambiar, $pref, $global)
	{
		if ($es_admin) return $global;
		if ($pref===0) return 0;
		if ($pref===1 && $puede_cambiar) return 1;
		return $global;
	}

	public function usar_menu_nuevo($idusuario)
	{
		$ctx=$this->contexto_menu($idusuario);
		return $ctx['usar_nuevo'];
	}

	private $contexto=array();

	//Todo lo que necesita el header en UNA sola consulta: la base es remota y cada consulta suma latencia
	//a cada página. Devuelve categoría, claves de acceso, permiso de cambiar menú, preferencia y menú de todos.
	//Si falta alguna tabla (scripts de sql/ sin ejecutar) devuelve el menú anterior y sin accesos.
	public function contexto_menu($idusuario, $recargar=false)
	{
		$idusuario=(int)$idusuario;
		if (!$recargar && isset($this->contexto[$idusuario])) {
			return $this->contexto[$idusuario];
		}

		$ctx=array('categoria'=>'', 'idcategoria'=>0, 'es_admin'=>false, 'es_developer'=>false, 'claves'=>array(), 'puede_cambiar'=>false, 'pref'=>null, 'global'=>0, 'usar_nuevo'=>false,
			'existe'=>false, 'nombre'=>'', 'login'=>'');
		//GROUP_CONCAT tiene un límite de 1024 caracteres por defecto; las claves del catálogo suman unos 300
		$sql="SELECT
				(SELECT login FROM usuario WHERE idusuario='$idusuario') AS login,
				(SELECT CONCAT_WS(' ', nombre, apellido_p, apellido_m) FROM usuario WHERE idusuario='$idusuario') AS nombre,
				(SELECT idcategoria_usuario FROM usuario_categoria WHERE idusuario='$idusuario') AS idcategoria,
				(SELECT c.clave FROM usuario_categoria uc INNER JOIN categoria_usuario c ON c.idcategoria_usuario=uc.idcategoria_usuario
					WHERE uc.idusuario='$idusuario') AS categoria,
				(SELECT GROUP_CONCAT(a.clave) FROM usuario_acceso_vista uav INNER JOIN acceso_vista a ON a.idacceso_vista=uav.idacceso_vista
					WHERE uav.idusuario='$idusuario') AS claves,
				(SELECT GROUP_CONCAT(clave) FROM acceso_vista) AS todas,
				(SELECT menu_nuevo FROM usuario_menu_pref WHERE idusuario='$idusuario') AS pref,
				(SELECT valor FROM configuracion_sistema WHERE clave='menu_nuevo_global') AS global";
		try {
			$reg=ejecutarConsultaSimpleFila($sql);
		} catch (Throwable $e) {
			$reg=null;
		}

		if ($reg) {
			$ctx['existe']=$reg['login']!==null;
			$ctx['login']=(string)$reg['login'];
			$ctx['nombre']=trim((string)$reg['nombre']);
			$ctx['idcategoria']=(int)$reg['idcategoria'];
			$ctx['categoria']=(string)$reg['categoria'];
			//Nivel de administrador: administrador del sistema o developer (todas las vistas y el menú de todos)
			$ctx['es_admin']=self::es_nivel_admin($ctx['categoria']);
			$ctx['es_developer']=$ctx['categoria']==self::CATEGORIA_DEVELOPER;
			//El administrador del sistema siempre tiene todas las vistas (ver claves_usuario)
			$lista=$ctx['es_admin'] ? $reg['todas'] : $reg['claves'];
			$ctx['claves']=$lista ? explode(',', $lista) : array();
			$ctx['puede_cambiar']=$ctx['es_admin']
				|| (in_array($ctx['categoria'], self::CATEGORIAS_CAMBIAR_MENU) && in_array('cambiar_menu', $ctx['claves']));
			$ctx['pref']=$reg['pref']===null ? null : (int)$reg['pref'];
			$ctx['global']=(int)$reg['global']==1 ? 1 : 0;
			$ctx['usar_nuevo']=self::menu_efectivo($ctx['es_admin'], $ctx['puede_cambiar'], $ctx['pref'], $ctx['global'])==1;
		}

		$this->contexto[$idusuario]=$ctx;
		return $ctx;
	}

	//Cambia el menú de TODOS los usuarios (solo el administrador del sistema). Borra las elecciones
	//personales para que nadie se quede en otro menú, y lo registra en la bitácora.
	public function cambiar_menu_global($idusuario_editor, $menu_nuevo)
	{
		global $conexion;
		$idusuario_editor=(int)$idusuario_editor;
		$menu_nuevo=$menu_nuevo==1 ? 1 : 0;
		$anterior=$this->menu_global();

		$conexion->begin_transaction();
		try {
			$sql="INSERT INTO configuracion_sistema (clave, valor, fecha_modificacion, idusuario_modifico)
				VALUES ('menu_nuevo_global', '$menu_nuevo', NOW(), '$idusuario_editor')
				ON DUPLICATE KEY UPDATE valor='$menu_nuevo', fecha_modificacion=NOW(), idusuario_modifico='$idusuario_editor'";
			if (!ejecutarConsulta($sql)) {
				throw new Exception($conexion->error);
			}
			if (!ejecutarConsulta("DELETE FROM usuario_menu_pref")) {
				throw new Exception($conexion->error);
			}

			//En la bitácora, idusuario=0 significa "todos los usuarios"
			$texto='Menú del sistema para todos: '.($anterior==1 ? 'nuevo' : 'anterior').' -> '.($menu_nuevo==1 ? 'nuevo' : 'anterior');
			$ip=isset($_SERVER['REMOTE_ADDR']) ? substr($_SERVER['REMOTE_ADDR'], 0, 45) : '';
			$stmt=$conexion->prepare("INSERT INTO bitacora_accesos (fecha, idusuario_editor, idusuario, agregados, ip) VALUES (NOW(), ?, 0, ?, ?)");
			if (!$stmt) {
				throw new Exception($conexion->error);
			}
			$stmt->bind_param('iss', $idusuario_editor, $texto, $ip);
			if (!$stmt->execute()) {
				throw new Exception($stmt->error);
			}
			$stmt->close();

			$conexion->commit();
			$this->limpiar_cache();
			return true;
		} catch (Throwable $e) {
			$conexion->rollback();
			return false;
		}
	}

	//Último cambio del menú para todos: array('valor'=>0|1, 'fecha'=>..., 'quien'=>...) o null
	public function info_menu_global()
	{
		try {
			$rspta=ejecutarConsulta("SELECT c.valor, c.fecha_modificacion, CONCAT_WS(' ', u.nombre, u.apellido_p) AS quien
				FROM configuracion_sistema c LEFT JOIN usuario u ON u.idusuario=c.idusuario_modifico
				WHERE c.clave='menu_nuevo_global'");
			if ($rspta && $reg = $rspta->fetch_object()) {
				return array('valor'=>(int)$reg->valor, 'fecha'=>$reg->fecha_modificacion, 'quien'=>$reg->quien);
			}
		} catch (Throwable $e) {
		}
		return null;
	}

	//Elección personal (usuarios con permiso de cambiar menú, o ?menu=anterior de emergencia)
	public function cambiar_menu($idusuario, $menu_nuevo)
	{
		$idusuario=(int)$idusuario;
		$menu_nuevo=$menu_nuevo==1 ? 1 : 0;
		$sql="INSERT INTO usuario_menu_pref (idusuario, menu_nuevo) VALUES ('$idusuario','$menu_nuevo')
			ON DUPLICATE KEY UPDATE menu_nuevo='$menu_nuevo'";
		$this->limpiar_cache();
		try {
			return ejecutarConsulta($sql);
		} catch (Throwable $e) {
			return false;
		}
	}
}

?>
