<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../../../config/Conexion.php";

Class Inventario_z
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	
	//Implementar un método para listar los registros
	public function listar()
	{

		$sql="SELECT * FROM inventario_zuno ORDER BY idinventario_zuno ASC";
		return ejecutarConsulta($sql);		
	}

	public function mostrardetalle($idinventario_zuno)
	{

		$sql="SELECT * FROM inventario_zuno WHERE idinventario_zuno='$idinventario_zuno'";
		return ejecutarConsultaSimpleFila($sql);	
	}

	/*public function selectProd()
	{
		$sql="SELECT * FROM inventario_zuno ORDER BY idinventario_zuno ASC";
		return ejecutarConsulta($sql);		
	}*/

	public function guardar($idinventario_zuno,$cant_actual,$cant_base,$fecha_hora,$codigo)
	{
		if ($cant_actual>$cant_base) {

			$tipo = "entrada";
			
		}elseif ($cant_actual<$cant_base) {
			$tipo = "salida";
		}


		$sql="INSERT INTO historial_inv_zuno (fecha_hora,codigo_prod,exist_base,exist_actual,tipo,movimiento) VALUES ('$fecha_hora', '$codigo', '$cant_base', '$cant_actual','$tipo','manual')";
		ejecutarConsulta($sql);

		$sql2="UPDATE inventario_zuno SET existencia='$cant_actual' WHERE idinventario_zuno='$idinventario_zuno'";
		return ejecutarConsulta($sql2);	
	}



	public function consul_prod($codigo_nuevo)
	{
		$sql = "SELECT * FROM inventario_zuno WHERE codigo_producto='$codigo_nuevo'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function guardar_prod($codigo_nuevo,$descr_nuevo,$existencia_nuevo)
	{
		$sql = "INSERT INTO inventario_zuno (codigo_producto,descripcion,existencia) VALUES ('$codigo_nuevo','$descr_nuevo','$existencia_nuevo')";
		return ejecutarConsulta($sql);
	}

	public function listar_apartados($id)
	{

		$sql="SELECT inva.idinvetario_zuno_apartado, inva.idinventario_zuno, v.folio, (Select nombre from clientes where idcliente = v.idcliente) as cliente, inv.descripcion as producto, inva.cantidad, inva.fecha_hora,inva.idventa  FROM invetario_zuno_apartado inva INNER JOIN ventas v ON inva.idventa=v.idventa INNER JOIN inventario_zuno inv on inva.idinventario_zuno=inv.idinventario_zuno  WHERE inva.idinventario_zuno='$id' ORDER BY inva.idinventario_zuno ASC";
		return ejecutarConsulta($sql);		
	}

	public function contar_apartados($idinventario_zuno)
	{
		$sql = "SELECT count(*) as num_apart FROM invetario_zuno_apartado WHERE idinventario_zuno='$idinventario_zuno'";
		return ejecutarConsultaSimpleFila($sql);
	}

	

	public function entregar_apartado($idinvetario_zuno_apartado,$idventa,$fecha_hora,$codigo)
	{
		$sql3="INSERT INTO historial_inv_zuno (fecha_hora,codigo_prod,tipo,movimiento,idventa) VALUES ('$fecha_hora','$codigo','','Entrega(apartado)','$idventa')";
	    ejecutarConsulta($sql3);

		$sql="DELETE FROM invetario_zuno_apartado WHERE idinvetario_zuno_apartado='$idinvetario_zuno_apartado'";
		return ejecutarConsulta($sql);

	}

	public function listar_apartados1()
	{

		$sql="SELECT inva.idinvetario_zuno_apartado, inva.idinventario_zuno, v.folio, (Select nombre from clientes where idcliente = v.idcliente) as cliente, inv.descripcion as producto, inva.cantidad, inva.fecha_hora,inva.idventa  FROM invetario_zuno_apartado inva INNER JOIN ventas v ON inva.idventa=v.idventa INNER JOIN inventario_zuno inv on inva.idinventario_zuno=inv.idinventario_zuno  ORDER BY inva.idinventario_zuno ASC";
		return ejecutarConsulta($sql);		
	}


	public function listar_tbl_colores($id)
	{

		$sql="SELECT *  FROM detalle_inv_zuno WHERE idinventario_zuno='$id' ORDER BY iddetalle_inventario_zuno ASC";
		return ejecutarConsulta($sql);		
	}

	public function editar_color($iddetalle_inventario_zuno,$idcant_color)
	{
		$sql2="UPDATE detalle_inv_zuno SET cantidad='$idcant_color', estatus='Guardado' WHERE iddetalle_inventario_zuno='$iddetalle_inventario_zuno'";
		return ejecutarConsulta($sql2);
	}

	public function actualizar_letrero($iddetalle_inventario_zuno)
	{
		$sql2="UPDATE detalle_inv_zuno SET estatus='Sin guardar' WHERE iddetalle_inventario_zuno='$iddetalle_inventario_zuno'";
		return ejecutarConsulta($sql2);
	}

	public function addcolor($idinventario_zuno,$nombre_color,$cantidad_color)
	{
		$sql2="INSERT INTO detalle_inv_zuno (idinventario_zuno,color,cantidad,estatus) VALUES('$idinventario_zuno','$nombre_color','$cantidad_color','Guardado')";
		return ejecutarConsulta($sql2);
	}



}

?>