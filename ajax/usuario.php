<?php
session_start(); 
require_once "../modelos/Usuario.php";

$usuario=new Usuario();


switch ($_GET["op"]){
	

	case 'permisos':
		//Obtenemos todos los permisos de la tabla permisos
		require_once "../modelos/Permiso.php";
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $usuario->listarmarcados($id);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}

		//Mostramos la lista de permisos en la vista y si están o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermiso,$valores)?'checked':'';
					echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
				}
	break;

	case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

	    //Hash SHA256 en la contraseña
		//$clavehash=hash("SHA256",$clavea);

		$rspta=$usuario->verificar($logina, $clavea);

		$fetch=$rspta->fetch_object();	

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['idusuario']=$fetch->idusuario;
	        $_SESSION['nombre']=$fetch->nombre;
	        $_SESSION['imagen']=$fetch->imagen;
	        $_SESSION['login']=$fetch->login;
	        $_SESSION['lugar']=$fetch->lugar;

	        //Obtenemos los permisos del usuario
	    	$marcados = $usuario->listarmarcados($fetch->idusuario);

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->idpermiso);
				}

			//Determinamos los accesos del usuario
			in_array(1,$valores)?$_SESSION['administrador']=1:$_SESSION['administrador']=0;
			in_array(2,$valores)?$_SESSION['agente_ventas1']=1:$_SESSION['agente_ventas1']=0;
			in_array(3,$valores)?$_SESSION['Administrativo']=1:$_SESSION['Administrativo']=0;
			in_array(4,$valores)?$_SESSION['consulta1']=1:$_SESSION['consulta1']=0;
			in_array(5,$valores)?$_SESSION['Produccion']=1:$_SESSION['Produccion']=0;
			

	    }
	    echo json_encode($fetch);
	break;

	case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../login.php");

	break;
}
?>