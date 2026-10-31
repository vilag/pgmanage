<?php 
//Incluímos inicialmente la conexión a la base de datos
require_once "../config/Conexion.php";

Class Usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	

	//Función para verificar el acceso al sistema.
	//Consulta preparada: el usuario y la contraseña nunca se insertan en el texto del SQL (evita inyección SQL).
	//Devuelve el usuario como objeto, o null si no coincide.
	public function verificar($login,$clave)
    {
    	global $conexion;

    	$stmt=$conexion->prepare("SELECT idusuario,nombre,apellido_p,apellido_m,puesto,imagen,login,lugar,area FROM usuario WHERE login=? AND clave=? AND estatus='1'");
    	if (!$stmt) {
    		return null;
    	}
    	$login=(string)$login;
    	$clave=(string)$clave;
    	$stmt->bind_param('ss', $login, $clave);
    	$stmt->execute();
    	//bind_result en lugar de get_result: no requiere la extensión mysqlnd
    	$stmt->bind_result($idusuario, $nombre, $apellido_p, $apellido_m, $puesto, $imagen, $login_bd, $lugar, $area);

    	$fila=null;
    	if ($stmt->fetch()) {
    		$valores=array('idusuario'=>$idusuario, 'nombre'=>$nombre, 'apellido_p'=>$apellido_p, 'apellido_m'=>$apellido_m,
    			'puesto'=>$puesto, 'imagen'=>$imagen, 'login'=>$login_bd, 'lugar'=>$lugar, 'area'=>$area);
    		//Mismos tipos que la consulta anterior (texto o null) para que la sesión y la respuesta JSON no cambien
    		foreach ($valores as $campo => $valor) {
    			$valores[$campo]=$valor===null ? null : (string)$valor;
    		}
    		$fila=(object)$valores;
    	}
    	$stmt->close();
    	return $fila;
    }

    public function listarmarcados($idusuario)
	{
		$idusuario=(int)$idusuario;
		$sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}
}

?>