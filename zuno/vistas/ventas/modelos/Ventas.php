<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../../../config/Conexion.php";

Class Ventas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	
	//Implementar un método para listar los registros
	public function listar()
	{

		$sql="SELECT v.idventa, c.no_cliente, c.nombre as nom_cliente,v.forma_pago,v.banco,v.num_ref,v.comprobante,v.comentario, v.folio, v.descripcion, v.estatus, v.fecha_hora, v.total_pago FROM ventas v INNER JOIN clientes c ON v.idcliente=c.idcliente  ORDER BY v.idventa desc";
		return ejecutarConsulta($sql);		
	}

	public function listarProd()
	{
		$sql="SELECT * FROM inventario_zuno ORDER BY idinventario_zuno asc";
		return ejecutarConsulta($sql);		
	}

	public function select_cliente()
	{
		$sql="SELECT * FROM clientes ORDER BY no_cliente asc";
		return ejecutarConsulta($sql);		
	}


	public function select_cliente_id($idcliente)
	{
		$sql="SELECT * FROM clientes WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);		
	}

	public function guardar_venta($idcliente,$idusuario,$v_descripcion,$v_total_pago,$v_forma_pago,$v_banco,$v_ref,$v_comp,$v_coment,$v_estatus,$v_fecha_hora)
	{
		$sql="INSERT INTO ventas(idcliente,idusuario,folio,descripcion,total_pago,forma_pago,num_ref,banco,comprobante,comentario,estatus,fecha_hora) VALUES('$idcliente','$idusuario','1','$v_descripcion','$v_total_pago','$v_forma_pago','$v_ref','$v_banco','$v_comp','$v_coment','$v_estatus','$v_fecha_hora')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_upd="UPDATE ventas SET folio='$idingresonew' WHERE idventa='$idingresonew'";
		ejecutarConsulta($sql_upd);

		$sql_id="SELECT * FROM ventas WHERE idventa='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);		
	}

	public function save_detalle_venta($idventa,$idinv,$codigo_p,$precio_p,$cant_p,$subt_p,$v_fecha_hora,$marca_pedido)
	{
		$sql="INSERT INTO detalle_ventas (idventa, idprod, precio, cantidad, subtotal) VALUES ('$idventa','$idinv','$precio_p','$cant_p','$subt_p')";
	    ejecutarConsulta($sql);

	    $sql2="UPDATE inventario_zuno SET existencia=existencia-'$cant_p' WHERE idinventario_zuno='$idinv'";
	    ejecutarConsulta($sql2);



	    

	    if ($marca_pedido==1) {
	    	
	    	$sql_a="INSERT INTO invetario_zuno_apartado (idventa,idinventario_zuno,cantidad,fecha_hora) VALUES ('$idventa','$idinv','$cant_p','$v_fecha_hora')";
	    	ejecutarConsulta($sql_a);

	    	$sql3="INSERT INTO historial_inv_zuno (fecha_hora,codigo_prod,exist_base,exist_actual,tipo,movimiento,idventa) SELECT '$v_fecha_hora','$codigo_p',existencia+'$cant_p',existencia,'salida','venta (apartado)','$idventa' FROM inventario_zuno WHERE idinventario_zuno='$idinv'";
	        ejecutarConsulta($sql3);
	    }

	    if ($marca_pedido==0) {

	        $sql3="INSERT INTO historial_inv_zuno (fecha_hora,codigo_prod,exist_base,exist_actual,tipo,movimiento,idventa) SELECT '$v_fecha_hora','$codigo_p',existencia+'$cant_p',existencia,'salida','venta','$idventa' FROM inventario_zuno WHERE idinventario_zuno='$idinv'";
	        ejecutarConsulta($sql3);
	    }
	}

	public function guardar_comprobante($nom)
	{
		$sql="INSERT INTO arch_temp (nombre) VALUES('$nom')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM arch_temp WHERE idarch_temp='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);		
	}

	public function mostrar_detalle_venta($idventa)
	{
		$sql="SELECT v.idventa, c.no_cliente, c.nombre as nom_cliente,v.forma_pago,v.banco,v.num_ref,v.comprobante,v.comentario, v.folio, v.descripcion, v.estatus, v.fecha_hora FROM ventas v INNER JOIN clientes c ON v.idcliente=c.idcliente WHERE v.idventa='$idventa'";


		/*$sql="SELECT * FROM ventas v INNER JOIN clientes c ON idcliente=c.idcliente INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE idventa='$idventa'";*/
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function mostrar_compr_venta($idventa,$idcomprob)
	{
		$sql="SELECT * FROM arch_temp WHERE idarch_temp='$idcomprob'";
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function update_coment($c_comentario,$c_folio)
	{
		$sql="UPDATE ventas SET comentario='$c_comentario' WHERE folio='$c_folio' ";
		ejecutarConsulta($sql);

		$sql2="SELECT * FROM ventas WHERE folio='$c_folio'";
		return ejecutarConsultaSimpleFila($sql2);		
	}

	public function ventas_enero()
	{
		$sql="SELECT ifnull(SUM(total_pago),0) as enero FROM ventas WHERE MONTH(fecha_hora)=1 AND YEAR(fecha_hora)=2020";
		return ejecutarConsultaSimpleFila($sql);		
	}
	public function ventas_febrero()
	{
		$sql="SELECT ifnull(SUM(total_pago),0) as febrero FROM ventas WHERE MONTH(fecha_hora)=2 AND YEAR(fecha_hora)=2020";
		return ejecutarConsultaSimpleFila($sql);		
	}
	public function ventas_marzo()
	{
		$sql="SELECT ifnull(SUM(total_pago),0) as marzo FROM ventas WHERE MONTH(fecha_hora)=3 AND YEAR(fecha_hora)=2020";
		return ejecutarConsultaSimpleFila($sql);		
	}
	public function ventas_abril()
	{
		$sql="SELECT ifnull(SUM(total_pago),0) as abril FROM ventas WHERE MONTH(fecha_hora)=4 AND YEAR(fecha_hora)=2020";
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function ventas_mayo()
	{
		$sql="SELECT ifnull(SUM(total_pago),0) as mayo FROM ventas WHERE MONTH(fecha_hora)=5 AND YEAR(fecha_hora)=2020";
		return ejecutarConsultaSimpleFila($sql);		
	}
	public function ventas_junio()
	{
		$sql="SELECT ifnull(SUM(total_pago),0) as junio FROM ventas WHERE MONTH(fecha_hora)=6 AND YEAR(fecha_hora)=2020";
		return ejecutarConsultaSimpleFila($sql);		
	}
	public function ventas_julio()
	{
		$sql="SELECT ifnull(SUM(total_pago),0) as julio FROM ventas WHERE MONTH(fecha_hora)=7 AND YEAR(fecha_hora)=2020";
		return ejecutarConsultaSimpleFila($sql);		
	}
	public function ventas_agosto()
	{
		$sql="SELECT ifnull(SUM(total_pago),0) as agosto FROM ventas WHERE MONTH(fecha_hora)=8 AND YEAR(fecha_hora)=2020";
		return ejecutarConsultaSimpleFila($sql);		
	}
	public function ventas_septiembre()
	{
		$sql="SELECT ifnull(SUM(total_pago),0) as septiembre FROM ventas WHERE MONTH(fecha_hora)=9 AND YEAR(fecha_hora)=2020";
		return ejecutarConsultaSimpleFila($sql);		
	}
	public function ventas_octubre()
	{
		$sql="SELECT ifnull(SUM(total_pago),0) as octubre FROM ventas WHERE MONTH(fecha_hora)=10 AND YEAR(fecha_hora)=2020";
		return ejecutarConsultaSimpleFila($sql);		
	}
	public function ventas_noviembre()
	{
		$sql="SELECT ifnull(SUM(total_pago),0) as noviembre FROM ventas WHERE MONTH(fecha_hora)=11 AND YEAR(fecha_hora)=2020";
		return ejecutarConsultaSimpleFila($sql);		
	}
	public function ventas_diciembre($anio_grafica)
	{
		$sql="SELECT (SELECT SUM(total_pago) FROM ventas WHERE month(fecha_hora)=1 and year(fecha_hora)='$anio_grafica') as enero,
				(SELECT SUM(total_pago) FROM ventas WHERE month(fecha_hora)=2 and year(fecha_hora)='$anio_grafica') as febrero,
				(SELECT SUM(total_pago) FROM ventas WHERE month(fecha_hora)=3 and year(fecha_hora)='$anio_grafica') as marzo,
				(SELECT SUM(total_pago) FROM ventas WHERE month(fecha_hora)=4 and year(fecha_hora)='$anio_grafica') as abril,
				(SELECT SUM(total_pago) FROM ventas WHERE month(fecha_hora)=5 and year(fecha_hora)='$anio_grafica') as mayo,
				(SELECT SUM(total_pago) FROM ventas WHERE month(fecha_hora)=6 and year(fecha_hora)='$anio_grafica') as junio,
				(SELECT SUM(total_pago) FROM ventas WHERE month(fecha_hora)=7 and year(fecha_hora)='$anio_grafica') as julio,
				(SELECT SUM(total_pago) FROM ventas WHERE month(fecha_hora)=8 and year(fecha_hora)='$anio_grafica') as agosto,
				(SELECT SUM(total_pago) FROM ventas WHERE month(fecha_hora)=9 and year(fecha_hora)='$anio_grafica') as septiembre,
				(SELECT SUM(total_pago) FROM ventas WHERE month(fecha_hora)=10 and year(fecha_hora)='$anio_grafica') as octubre,
				(SELECT SUM(total_pago) FROM ventas WHERE month(fecha_hora)=11 and year(fecha_hora)='$anio_grafica') as noviembre,
				(SELECT SUM(total_pago) FROM ventas WHERE month(fecha_hora)=12 and year(fecha_hora)='$anio_grafica') as diciembre
				FROM ventas LIMIT 1

";
		return ejecutarConsultaSimpleFila($sql);

		/*$sql="SELECT ifnull(SUM(total_pago),0) as diciembre FROM ventas WHERE MONTH(fecha_hora)=12 AND YEAR(fecha_hora)=2020";
		return ejecutarConsultaSimpleFila($sql);*/		
	}



	public function select_color($idinventario_zuno)
	{
		$sql="SELECT * FROM detalle_inv_zuno WHERE idinventario_zuno='$idinventario_zuno' AND cantidad>0";
		return ejecutarConsulta($sql);		
	}



	

}

?>