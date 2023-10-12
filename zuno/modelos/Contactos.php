<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Contactos
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	
	//Implementar un método para listar los registros
	public function listar()
	{

		$sql="SELECT c.idcontactos,c.nombre,c.email,c.telefono,c.mensaje,c.plataforma,c.noticias,c.fecha_hora,c.estatus,(SELECT estatus FROM pedidos WHERE idpedidos=c.pedido) as pedido,c.venta FROM contactos c WHERE mensaje<>'prueba' ORDER BY idcontactos DESC";
		return ejecutarConsulta($sql);		
	}

	public function cargar_contacto($idcontactos,$idusuario)
	{
		if ($idusuario>1) {
			$sql2="UPDATE contactos SET estatus=1 WHERE idcontactos='$idcontactos'";
			ejecutarConsulta($sql2);
		}
		

		$sql="SELECT * FROM contactos WHERE idcontactos='$idcontactos' ORDER BY idcontactos DESC";
		return ejecutarConsultaSimpleFila($sql);	

			
	}

	public function guardar_cliente($nombre_cliente,$num_cliente,$email,$telefono,$fecha_hora)
	{

		$sql="INSERT INTO clientes (nombre,no_cliente,email,telefono, estatus, fecha_reg) VALUES('$nombre_cliente','$num_cliente','$email','$telefono','0','$fecha_hora')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT idcliente,no_cliente,nombre FROM clientes WHERE idcliente='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);		
	}

	public function guardar_venta($idcliente,$descr_venta,$total_pago,$forma_pago,$banco,$referencia,$comentario_venta,$fecha_hora)
	{
		$sql="INSERT INTO ventas (idcliente,idusuario,folio,descripcion,total_pago,forma_pago,num_ref,banco,comentario,estatus,fecha_hora) VALUES('$idcliente','0','0','$descr_venta','$total_pago','$forma_pago','$referencia','$banco','$comentario_venta','0','$fecha_hora')";
		return ejecutarConsulta($sql);
				
	}

	public function guardar_comentario2($idcontacto,$descr_venta,$fecha_hora)
	{
		$sql="INSERT INTO detalle_contactos (idcontactos,comentario,fecha_hora) VALUES('$idcontacto','$descr_venta','$fecha_hora')";
		return ejecutarConsulta($sql);
				
	}

	public function listar_seguimiento($idcontacto)
	{

		$sql="SELECT * FROM detalle_contactos WHERE idcontactos='$idcontacto' ORDER BY fecha_hora desc";
		return ejecutarConsulta($sql);		
	}

	public function valid_nombre_cliente($nombre_cliente)
	{

		$sql="SELECT idcliente as idcliente2, no_cliente as no_cliente2, nombre as nombre2, email as email2, telefono as telefono2 FROM clientes WHERE nombre='$nombre_cliente' ORDER BY nombre DESC LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);	
	}

	public function valid_email($email)
	{

		$sql="SELECT * FROM clientes WHERE email='$email' ORDER BY email DESC LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function buscar_num_cli($num_cliente)
	{

		$sql="SELECT * FROM clientes WHERE no_cliente='$num_cliente'";
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function buscar_num_ped($num_pedido)
	{

		$sql="SELECT * FROM pedidos WHERE num_pedido='$num_pedido'";
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function update_contacto($idcontacto,$idpedidos)
	{

		$sql="UPDATE contactos SET pedido='$idpedidos' WHERE idcontactos='$idcontacto'";
		return ejecutarConsulta($sql);		
	}

	public function buscar_pedido($idpedido)
	{

		$sql="SELECT * FROM pedidos WHERE idpedidos='$idpedido'";
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function list_coin_cli($nombre_cliente,$email)
	{

		$sql="SELECT * FROM clientes WHERE nombre='$nombre_cliente'
				UNION
				SELECT * FROM clientes WHERE email='$email'";
		return ejecutarConsulta($sql);			
	}

	public function abrir_cli_pedido($idcliente)
	{

		$sql="SELECT * FROM clientes WHERE idcliente='$idcliente'";
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function subir_pedido($nom)
	{

		$sql="INSERT INTO files (archivo) VALUES ('$nom')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT idfiles FROM files WHERE idfiles='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);			
	}

	public function update_file($idfiles,$idpedidos)
	{

		$sql="UPDATE files SET idpedido='$idpedidos' WHERE idfiles='$idfiles'";
		return ejecutarConsulta($sql);		
	}

	public function guardar_comentario($idcontacto3,$descr_venta,$nom,$fecha_hora_coment)
	{

		$sql="INSERT INTO detalle_contactos (idcontactos,comentario,archivo,fecha_hora) VALUES ('$idcontacto3','$descr_venta','$nom','$fecha_hora_coment')";
		return ejecutarConsulta($sql);		
	}

	public function valid_exist_archivo($nom)
	{

		$sql="SELECT * FROM detalle_contactos WHERE archivo='$nom'";
		return ejecutarConsultaSimpleFila($sql);			
	}

}

?>