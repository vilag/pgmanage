<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Ventas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	


	public function mostrar_detalle_venta($idventa)
	{
		$sql="SELECT v.idventa, c.no_cliente, c.nombre as nom_cliente, u.nombre as nom_usuario,v.forma_pago,v.banco,v.num_ref,v.comprobante,v.comentario, v.folio, v.descripcion, v.estatus, v.fecha_hora FROM ventas v INNER JOIN clientes c ON v.idcliente=c.idcliente INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";


		/*$sql="SELECT * FROM ventas v INNER JOIN clientes c ON idcliente=c.idcliente INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE idventa='$idventa'";*/
		return ejecutarConsulta($sql);		
	}

	public function mostrar_list_venta($idventa)
	{
		$sql="SELECT dv.iddetalle_ventas, dv.idventa, dv.idprod, dv.precio, dv.cantidad, dv.subtotal, (SELECT descripcion FROM inventario_zuno WHERE idinventario_zuno = dv.idprod) as descripcion FROM detalle_ventas dv WHERE idventa = '$idventa'";
		return ejecutarConsulta($sql);		
	}


}

?>