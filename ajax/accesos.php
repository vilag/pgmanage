<?php
session_start();
require_once "../modelos/Accesos.php";
require_once "../config/seguridad.php";

$accesos=new Accesos();

if (!isset($_SESSION['idusuario']))
{
	http_response_code(401);
	echo json_encode(array('error'=>true,'message'=>'Sesión no iniciada'));
	exit();
}

$idusuario_sesion=$_SESSION['idusuario'];
$es_admin_accesos=in_array('admin_accesos', $accesos->claves_usuario($idusuario_sesion));

switch ($_GET["op"])
	{

		//El administrador del sistema cambia el menú de todos; los usuarios con permiso, solo el suyo.
		//Volver al menú anterior siempre se permite (salida de emergencia).
		case 'cambiar_menu':
			$menu_nuevo=isset($_POST['menu_nuevo']) && $_POST['menu_nuevo']==1 ? 1 : 0;
			//Quien cambia el menú lo ve al recargar, sin esperar a que caduque su menú guardado (header_selector.php)
			unset($_SESSION['ctx_menu']);

			if ($accesos->es_admin_sistema($idusuario_sesion)) {
				$rspta=$accesos->cambiar_menu_global($idusuario_sesion, $menu_nuevo);
				echo json_encode(array('ok'=>$rspta ? true : false, 'menu_nuevo'=>$menu_nuevo, 'global'=>true));
				exit();
			}

			if ($menu_nuevo==1 && !$accesos->puede_cambiar_menu($idusuario_sesion)) {
				echo json_encode(array('ok'=>false, 'message'=>'No tiene permiso para usar el menú nuevo'));
				exit();
			}
			$rspta=$accesos->cambiar_menu($idusuario_sesion, $menu_nuevo);
			echo json_encode(array('ok'=>$rspta ? true : false, 'menu_nuevo'=>$menu_nuevo, 'global'=>false));
		break;

		case 'listar_usuarios':
			if (!$es_admin_accesos) { http_response_code(403); exit(); }

			//Una consulta: los totales vienen en cada fila y el menú de todos en el contexto del editor (ya cargado)
			$rspta=$accesos->listar_usuarios();
			$ctx_editor=$accesos->contexto_menu($idusuario_sesion);
			$menu_global=$ctx_editor['global'];

			echo '<thead>
					<tr>
					  <th>ID</th>
					  <th>Nombre</th>
					  <th>Puesto</th>
					  <th>Usuario</th>
					  <th>Lugar</th>
					  <th>Estatus</th>
					  <th>Categoría</th>
					  <th>Nivel de acceso</th>
					  <th>Menú en uso</th>
					  <th></th>
					</tr>
				  </thead>
				  <tbody>';

			while ($reg = $rspta->fetch_object())
				{
					$total_vistas=(int)$reg->total_vistas;
					$total_operativas=(int)$reg->total_operativas;
					$nombre=trim($reg->nombre.' '.$reg->apellido_p.' '.$reg->apellido_m);
					$estatus=$reg->estatus==1 ? '<span class="badge bg-green">Activo</span>' : '<span class="badge bg-red">Inactivo</span>';
					$es_admin=Accesos::es_nivel_admin($reg->categoria_clave);
					$puede=$es_admin || (in_array($reg->categoria_clave, Accesos::CATEGORIAS_CAMBIAR_MENU) && $reg->tiene_cambiar_menu==1);
					$pref=$reg->pref_menu===null ? null : (int)$reg->pref_menu;
					$efectivo=Accesos::menu_efectivo($es_admin, $puede, $pref, $menu_global);
					//"(propio)" cuando ve un menú distinto al de todos por una elección personal
					$menu=($efectivo==1 ? 'Nuevo' : 'Anterior').($efectivo!=$menu_global ? ' <small style="color: #999;">(propio)</small>' : '');
					$nivel=Accesos::nivel_accesos($reg->num_operativas, $total_operativas, $reg->num_accesos, $total_vistas);

					echo '<tr class="fila_usuario" data-categoria="'.$reg->idcategoria_usuario.'" data-nivel="'.htmlspecialchars($nivel).'">
							<td>'.$reg->idusuario.'</td>
							<td>'.htmlspecialchars($nombre).'</td>
							<td>'.htmlspecialchars((string)$reg->puesto).'</td>
							<td>'.htmlspecialchars((string)$reg->login).'</td>
							<td>'.htmlspecialchars((string)$reg->lugar).'</td>
							<td>'.$estatus.'</td>
							<td class="col_categoria">'.htmlspecialchars($reg->categoria).(Accesos::es_nivel_admin($reg->categoria_clave) ? ' <i class="fa fa-lock" title="Acceso total protegido"></i>' : '').'</td>
							<td><span class="badge nivel_acceso" data-nivel="'.htmlspecialchars($nivel).'">'.htmlspecialchars($nivel).'</span> <small style="color: #999;" title="Vistas de operación">'.$reg->num_operativas.'/'.$total_operativas.'</small></td>
							<td>'.$menu.'</td>
							<td><button type="button" class="btn btn-dark btn-sm" onclick="abrir_accesos('.$reg->idusuario.');"><i class="fa fa-key"></i> Accesos</button></td>
						  </tr>';
				}

			echo '</tbody>';
		break;

		case 'accesos_usuario':
			if (!$es_admin_accesos) { http_response_code(403); exit(); }

			//3 consultas en total: contexto del editor (ya cargado arriba), contexto del usuario y catálogo.
			//Las categorías vienen en la página (accesos.php), no se vuelven a pedir aquí.
			$idusuario=(int)$_GET['idusuario'];
			$ctx_usuario=$accesos->contexto_menu($idusuario);
			$destino_admin=$ctx_usuario['es_admin'];
			$motivo_no_editable=$accesos->motivo_no_editable($idusuario_sesion, $idusuario);
			$bloqueadas=$accesos->vistas_bloqueadas($idusuario_sesion, $idusuario);
			//Las claves del usuario ya están cargadas (contexto_menu); para el administrador del sistema son todas
			$marcados=$accesos->ids_por_claves($accesos->claves_usuario($idusuario));

			//Agrupamos el catálogo respetando el orden del menú
			$grupos=array();
			foreach ($accesos->catalogo() as $reg)
				{
					$grupos[$reg->grupo][]=$reg;
				}

			$html='';
			foreach ($grupos as $grupo => $vistas)
				{
					$id_grupo='grp_'.md5($grupo);
					$html.='<div class="col-md-6 col-sm-12" style="margin-bottom: 15px;">
								<label style="font-weight: bold; border-bottom: 1px solid #e5e5e5; display: block; padding-bottom: 4px;">
									<input type="checkbox" class="chk_grupo" data-grupo="'.$id_grupo.'" onchange="marcar_grupo(this);"> '.htmlspecialchars($grupo).'
								</label>';

					foreach ($vistas as $vista)
						{
							$id=(int)$vista->idacceso_vista;
							$sw=in_array($id, $marcados) ? 'checked' : '';

							//Bloqueo fijo (no cambia al elegir otra categoría en el modal)
							$motivo=$motivo_no_editable!='' ? $motivo_no_editable : (isset($bloqueadas[$id]) ? $bloqueadas[$id] : '');
							if ($motivo!='') {
								$sw.=' disabled data-bloqueo="1" title="'.htmlspecialchars($motivo).'"';
							}

							$clase=$vista->clave=='cambiar_menu' ? ' chk_cambiar_menu' : '';
							//Los permisos de administración no cuentan para el nivel (ver Accesos::nivel_accesos)
							$clase.=in_array($vista->clave, Accesos::VISTAS_SOLO_ADMIN) ? ' chk_admin' : '';
							$url=$vista->url ? ' <small style="color: #999;">('.htmlspecialchars($vista->url).')</small>' : '';
							$nota=$vista->clave=='cambiar_menu' ? ' <small style="color: #999;">(solo Dirección o Administrativo)</small>' : '';
							$candado=$motivo!='' ? ' <i class="fa fa-lock" style="color: #999;" title="'.htmlspecialchars($motivo).'"></i>' : '';
							$html.='<div style="padding-left: 20px;">
										<label style="font-weight: normal;">
											<input type="checkbox" name="acceso[]" class="chk_acceso '.$id_grupo.$clase.'" value="'.$id.'" '.$sw.'> '.htmlspecialchars($vista->nombre).$url.$nota.$candado.'
										</label>
									</div>';
						}

					$html.='</div>';
				}

			if ($motivo_no_editable!='') {
				$aviso=$motivo_no_editable;
			} elseif ($destino_admin) {
				$aviso='Este usuario tiene nivel de administrador y siempre tiene acceso total. Para limitarlo, primero cambie su categoría y guarde.';
			} else {
				$aviso='';
			}

			echo json_encode(array(
				'idusuario'=>$idusuario,
				'nombre'=>$ctx_usuario['existe'] ? $ctx_usuario['nombre'].' ('.$ctx_usuario['login'].')' : '',
				'idcategoria_usuario'=>$ctx_usuario['idcategoria'],
				'solo_lectura'=>$motivo_no_editable!='',
				'aviso'=>$aviso,
				'categorias_cambiar_menu'=>Accesos::CATEGORIAS_CAMBIAR_MENU,
				'total_vistas'=>$accesos->total_vistas(),
				'total_operativas'=>$accesos->total_operativas(),
				'html'=>$html
			));
		break;

		case 'guardar_accesos':
			if (!$es_admin_accesos) { http_response_code(403); exit(); }

			$idusuario=(int)$_POST['idusuario'];
			$ctx_usuario=$accesos->contexto_menu($idusuario);
			if (!$ctx_usuario['existe']) {
				echo json_encode(array('ok'=>false));
				exit();
			}
			$ids=isset($_POST['accesos']) && is_array($_POST['accesos']) ? $_POST['accesos'] : array();
			$idcategoria_usuario=isset($_POST['idcategoria_usuario']) ? (int)$_POST['idcategoria_usuario'] : 0;

			//Los bloqueos se aplican aquí aunque el navegador envíe otra cosa
			$datos=$accesos->preparar_guardado($idusuario_sesion, $idusuario, $ids, $idcategoria_usuario);
			if ($datos['error']!='') {
				echo json_encode(array('ok'=>false, 'message'=>$datos['error']));
				exit();
			}

			$rspta=$accesos->guardar_accesos($idusuario, $datos['ids'], $datos['idcategoria_usuario'], $idusuario_sesion);
			echo json_encode(array('ok'=>$rspta ? true : false));
		break;

		//Solo lectura; únicamente para el administrador del sistema
		case 'bitacora':
			if (!$accesos->es_admin_sistema($idusuario_sesion)) { http_response_code(403); exit(); }

			$rspta=$accesos->listar_bitacora();

			echo '<thead>
					<tr>
					  <th>Fecha</th>
					  <th>Modificó</th>
					  <th>Usuario</th>
					  <th>Categoría</th>
					  <th>Agregados</th>
					  <th>Quitados</th>
					  <th>IP</th>
					</tr>
				  </thead>
				  <tbody>';

			$filas=0;
			while ($reg = $rspta->fetch_object())
				{
					$filas++;
					$categoria=$reg->categoria_antes==$reg->categoria_despues
						? htmlspecialchars((string)$reg->categoria_despues)
						: htmlspecialchars((string)$reg->categoria_antes).' &rarr; <b>'.htmlspecialchars((string)$reg->categoria_despues).'</b>';

					echo '<tr>
							<td style="white-space: nowrap;">'.htmlspecialchars($reg->fecha).'</td>
							<td>'.htmlspecialchars(trim((string)$reg->editor)).' <small style="color: #999;">('.htmlspecialchars((string)$reg->editor_login).')</small></td>
							<td>'.((int)$reg->idusuario==0 ? '<b>Todos los usuarios</b>' : htmlspecialchars(trim((string)$reg->usuario)).' <small style="color: #999;">(ID '.(int)$reg->idusuario.')</small>').'</td>
							<td>'.$categoria.'</td>
							<td style="color: #2E7D32;">'.htmlspecialchars((string)$reg->agregados).'</td>
							<td style="color: #C62828;">'.htmlspecialchars((string)$reg->quitados).'</td>
							<td>'.htmlspecialchars((string)$reg->ip).'</td>
						  </tr>';
				}

			if ($filas==0) {
				echo '<tr><td colspan="7" style="text-align: center; color: #999;">Sin cambios registrados</td></tr>';
			}
			echo '</tbody>';
		break;
	}
?>
