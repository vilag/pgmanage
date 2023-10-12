<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../../../config/Conexion.php";

Class Pedidose
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	
	//Implementar un método para listar los registros
	public function listar()
	{

		$sql="SELECT * FROM ctrl_ped_fab ORDER BY idctrl_ped_fab ASC";
		return ejecutarConsulta($sql);		
	}

	public function select_cliente()
	{
		$sql="SELECT * FROM clientes_fab ORDER BY nombre asc";
		return ejecutarConsulta($sql);		
	}

	public function guardar_documento($nom,$idpedido)
	{
		$sql="INSERT INTO files_ped_fab (nombre,idpedido) VALUES('$nom','$idpedido')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM files_ped_fab WHERE idfiles_ped_fab='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);		
	}

	public function buscar_nom_cli($nombre_new)
	{

		$sql="SELECT * FROM clientes_fab WHERE nombre='$nombre_new'";
		return ejecutarConsultaSimpleFila($sql);		
	}

	public function guardar_cliente($nombre_new,$email_new,$telefono_new,$rfc_new,$calle_new,$numero_new,$interior_new,$colonia_new,$municipio_new,$estado_new,$referencia_new,$fecha_hora)
	{

		$sql="INSERT INTO clientes_fab (nombre,email,telefono,rfc,calle,numero,interior,colonia,municipio,estado,referencia,estatus,fecha_reg) VALUES('$nombre_new','$email_new','$telefono_new','$rfc_new','$calle_new','$numero_new','$interior_new','$colonia_new','$municipio_new','$estado_new','$referencia_new','0','$fecha_hora')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM clientes_fab WHERE idclientes_fab='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);		
	}

	public function guardar_pedido($idcliente,$f_pedido,$f_est_entrega,$lugar_entrega)
	{
		$sql="INSERT INTO ctrl_ped_fab (cliente,fecha_pedido,lugar_entr,fecha_entrega,estatus) VALUES('$idcliente','$f_pedido','$lugar_entrega','$f_est_entrega','0')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM ctrl_ped_fab WHERE idctrl_ped_fab='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);	
	
	}

	public function guardar_producto($ctrl_pedid_a,$no_pedid_a,$ord_prod_a,$clave_a,$nombre_a,$cant_solic_a)
	{
		$sql="INSERT INTO pedidos_fab (idctrl_ped_fab,no_pedido,op,material,cantidad_solic,cantidad_enviada,clave_prod) VALUES ('$ctrl_pedid_a','$no_pedid_a','$ord_prod_a','$nombre_a','$cant_solic_a','0','$clave_a')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM pedidos_fab WHERE idpedido_fab='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);		
	}

	public function listarprod($id)
	{
		//$id = 20;
		$sql="SELECT * FROM pedidos_fab WHERE idctrl_ped_fab='$id'";
		return ejecutarConsulta($sql);		
	}

	public function abrir_det_ped($idpedido_fab)
	{
		$sql="SELECT * FROM pedidos_fab WHERE idpedido_fab='$idpedido_fab'";
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function listar_prod_select($ctrl_ped)
	{
		//$ctrl_ped=29;
		$sql="SELECT * FROM pedidos_fab WHERE idctrl_ped_fab='$ctrl_ped'";
		return ejecutarConsulta($sql);			
	}

	public function select_prod_add($prod_select)
	{
		
		$sql="SELECT * FROM pedidos_fab WHERE idpedido_fab='$prod_select'";
		return ejecutarConsultaSimpleFila($sql);			
	}

	public function guardar_envio($idctrl_ped_fab,$no_salida,$forma,$fecha_hora_salida,$fecha_hora_entrega,$lugar_entrega,$fecha_hora_entrega_real,$entregado_a)
	{
		
		$sql="INSERT INTO envio_fab (idctrl_ped_fab, no_salida, forma, fecha_hora_salida, fecha_hora_entrega,lugar_entrega, fecha_hora_entrega_real, entregado_a) VALUES ('$idctrl_ped_fab','$no_salida','$forma','$fecha_hora_salida','$fecha_hora_entrega','$lugar_entrega','$fecha_hora_entrega_real','$entregado_a')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM envio_fab WHERE idenvios_fab='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);			
	}

	public function guardar_det_envio($id_envio_fab,$idped_fab2,$cve_prod2,$tip_empaque2,$cant_solic2,$mont_entr_siniva2,$mont_entr_coniva2)
	{
		
		$sql="INSERT INTO detalle_envios (idenvios_fab,idpedido_fab,clave_prod,empaque,cantidad_entregada,monto_siniva,monto_coniva,estatus) VALUES ('$id_envio_fab','$idped_fab2','$cve_prod2','$tip_empaque2','$cant_solic2','$mont_entr_siniva2','$mont_entr_coniva2','1')";
		ejecutarConsulta($sql);

		$sql2="UPDATE pedidos_fab SET cantidad_enviada=cantidad_enviada+'$cant_solic2' WHERE idpedido_fab='$idped_fab2'";
		return ejecutarConsulta($sql2);		
	}

	public function listarenvios($id)
	{
		//$id=25;
		$sql="SELECT * FROM envio_fab WHERE idctrl_ped_fab='$id'";
		return ejecutarConsulta($sql);			
	}

}

?>