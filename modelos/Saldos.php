<?php

//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Saldos
{
	public function __construct()
	{

	}

	public function listar_saldos()
	{

		$sql="SELECT * FROM saldos WHERE estatus=1 ORDER BY idsaldos DESC";
		return ejecutarConsulta($sql);			
	}

	public function nuevo_pedido($fecha_hora)
	{

		$sql="INSERT INTO saldos (fecha_pedido,idpedidos) VALUES ('$fecha_hora','0')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM saldos WHERE idsaldos='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);			
	}


	public function nuevo_detalle_saldo($idsaldos,$fecha_hora)
	{

		$sql="INSERT INTO saldos_detalle (idsaldos,codigo,detalle,cantidad,precio,fecha_pedido) VALUES ('$idsaldos','GENSAL','__________','0','0','$fecha_hora')";
		return ejecutarConsulta($sql);

	}

	public function listar_saldos_detalles($id)
	{

		$sql="SELECT * FROM saldos_detalle WHERE idsaldos='$id' ORDER BY idsaldos_detalle DESC";
		return ejecutarConsulta($sql);

	}

	public function update_detalle_saldo($idsaldos_detalle,$detalle,$cantidad,$precio)
	{

		$sql="UPDATE saldos_detalle SET detalle='$detalle',cantidad='$cantidad',precio='$precio' WHERE idsaldos_detalle='$idsaldos_detalle'";
		return ejecutarConsulta($sql);

	}

	public function guardar_pedido($idsaldos,$idpedido,$no_pedido_save)
	{

		$sql="UPDATE saldos SET estatus='1',idpedidos='$idpedido',no_pedido='$no_pedido_save' WHERE idsaldos='$idsaldos'";
		return ejecutarConsulta($sql);

	}

	public function listar_ped($id)
	{

		$sql="SELECT p.idpg_pedidos,p.no_control,d.contacto_ent,d.calle_ent,d.numero_ent,d.colonia_ent,d.ciudad_ent FROM pg_pedidos p INNER JOIN dir_entregas_esp d ON p.idpg_pedidos=d.idpedido WHERE p.idusuario='$id' ORDER BY p.fecha_pedido DESC";
		return ejecutarConsulta($sql);

	}

	public function select_dir_ped($idpedido)
	{

		$sql="SELECT p.idpg_pedidos,p.no_control,d.contacto_ent,d.calle_ent,d.numero_ent,d.interior_ent,d.colonia_ent,d.ciudad_ent,d.cp_ent,d.email_ent,d.telefono_ent FROM pg_pedidos p INNER JOIN dir_entregas_esp d ON p.idpg_pedidos=d.idpedido WHERE p.idpg_pedidos='$idpedido'";
		return ejecutarConsultaSimpleFila($sql);

	}



	public function listar_dir_sal()
	{

		$sql="SELECT * FROM saldo_entregas s INNER JOIN saldos a ON s.idsaldos=a.idsaldos WHERE a.estatus=1 AND s.calle<>'' AND s.colonia<>''";
		return ejecutarConsulta($sql);

	}



	public function guardar_entrega($idsaldos,$idpedido,$contacto_s,$calle_s,$numero_s,$interior_s,$colonia_s,$ciudad_s,$estado_s,$cp_s,$email_s,$telefono_s,$fecha_entrega_s,$horario_entrega_s,$horario_entrega_s2,$forma_entrega_s,$det_form_entrega_s,$comentario_s)
	{

		$sql="INSERT INTO saldo_entregas (idsaldos,idpedido,contacto,calle,numero,interior,colonia,ciudad,estado,cp,email,telefono,fecha_entrega,hora_entrega1,hora_entrega2,forma_entrega,detalle_forma,comentario_entrega) VALUES ('$idsaldos','$idpedido','$contacto_s','$calle_s','$numero_s','$interior_s','$colonia_s','$ciudad_s','$estado_s','$cp_s','$email_s','$telefono_s','$fecha_entrega_s','$horario_entrega_s','$horario_entrega_s2','$forma_entrega_s','$det_form_entrega_s','$comentario_s')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_insert="UPDATE saldos SET idsaldos_entregas='$idingresonew' WHERE idsaldos='$idsaldos'";
        return ejecutarConsulta($sql_insert);

	}

	public function guardar_fact($idsaldos,$idpedido,$razon_f,$rfc_f,$calle_f,$numero_f,$interior_f,$colonia_f,$ciudad_f,$estado_f,$cp_f,$email_f,$telefono_f,$marcador)
	{

		$sql="INSERT INTO saldo_fact (idsaldos,idpedido,razon,rfc,calle,numero,interior,colonia,ciudad,estado,cp,email,telefono,reg_rep) VALUES ('$idsaldos','$idpedido','$razon_f','$rfc_f','$calle_f','$numero_f','$interior_f','$colonia_f','$ciudad_f','$estado_f','$cp_f','$email_f','$telefono_f','$marcador')";
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_insert="UPDATE saldos SET idsaldos_fact='$idingresonew' WHERE idsaldos='$idsaldos'";
        return ejecutarConsulta($sql_insert);

	}

	public function select_dir_sal($iddireccion)
	{

		$sql="SELECT * FROM saldo_entregas WHERE idsaldo_entregas='$iddireccion'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function select_dir_fact($idsaldo_fact)
	{

		$sql="SELECT sf.idsaldo_fact,sf.razon,sf.rfc,sf.calle,sf.numero,sf.interior,sf.colonia,sf.ciudad,sf.estado,sf.cp,sf.email,sf.telefono,se.idsaldo_entregas,se.contacto as contacto_s,se.calle as calle_s,se.numero as numero_s,se.interior as interior_s,se.colonia as colonia_s,se.ciudad as ciudad_s,se.estado as estado_s,se.cp as cp_s,se.email as email_s,se.telefono as telefono_s FROM saldo_fact sf INNER JOIN saldo_entregas se ON sf.idsaldos=se.idsaldos WHERE sf.idsaldo_fact='$idsaldo_fact'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function mostrar_direcciones($id)
	{

		$sql="SELECT * FROM saldo_entregas s INNER JOIN saldos a ON s.idsaldos=a.idsaldos WHERE (a.estatus=1 AND s.calle<>'' AND s.colonia<>'') AND (s.calle LIKE '%".$id."%' OR s.colonia LIKE '%".$id."%') ORDER BY s.calle ASC";
		return ejecutarConsulta($sql);

	}

	public function buscar_dir_sal($idsaldos)
	{

		$sql="SELECT * FROM saldo_entregas WHERE idsaldos='$idsaldos'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function consulta_pedido($id)
	{

		$sql="SELECT s.idsaldos,s.no_pedido,s.fecha_pedido,s.estatus,sf.razon,sf.rfc,sf.calle,sf.numero,sf.interior,sf.colonia,sf.ciudad,sf.estado,sf.cp,sf.email,sf.telefono,se.contacto as contacto_s,se.calle as calle_s,se.numero as numero_s,se.interior as interior_s,se.colonia as colonia_s,se.ciudad as ciudad_s,se.estado as estado_s,se.cp as cp_s,se.email as email_s,se.telefono as telefono_s,se.fecha_entrega,se.hora_entrega1,se.hora_entrega2,se.forma_entrega,se.detalle_forma,se.comentario_entrega FROM saldos s INNER JOIN saldo_entregas se ON s.idsaldos=se.idsaldos INNER JOIN saldo_fact sf ON s.idsaldos=sf.idsaldos WHERE s.idsaldos='$id'";
		return ejecutarConsulta($sql);

	}

	public function detalle_pedido($id)
	{

		$sql="SELECT * FROM saldos_detalle WHERE idsaldos='$id'";
		return ejecutarConsulta($sql);

	}


	public function mostrar_facturacion($id)
	{

		$sql="SELECT f.idsaldo_fact,f.razon FROM saldo_fact f INNER JOIN saldos a ON f.idsaldos=a.idsaldos WHERE (a.estatus=1 AND a.idpedidos=0 AND f.reg_rep=0) AND (f.razon LIKE '%".$id."%') ORDER BY f.razon ASC";
		return ejecutarConsulta($sql);

	}

	public function mostrar_control($id)
	{

		$sql="SELECT p.no_control,df.razon_fac,df.rfc_fac,df.calle_fac,df.numero_fac,df.interior_fac,df.colonia_fac,df.ciudad_fac,df.estado_fac,df.cp_fac,df.telefono_fac,df.email_fac,de.contacto_ent,de.calle_ent,de.numero_ent,de.interior_ent,de.colonia_ent,de.ciudad_ent,de.estado_ent,de.cp_ent,de.telefono_ent,de.email_ent FROM pg_pedidos p INNER JOIN dir_entregas_esp de ON de.idpedido=p.idpg_pedidos INNER JOIN dir_facturacion_esp df ON df.idpedido=p.idpg_pedidos WHERE p.no_control LIKE '%".$id."%' ORDER BY p.no_control ASC";
		return ejecutarConsulta($sql);

	}

	public function select_nocontrol($no_control)
	{

		$sql="SELECT p.idpg_pedidos,p.no_control,df.razon_fac,df.rfc_fac,df.calle_fac,df.numero_fac,df.interior_fac,df.colonia_fac,df.ciudad_fac,df.estado_fac,df.cp_fac,df.telefono_fac,df.email_fac,de.contacto_ent,de.calle_ent,de.numero_ent,de.interior_ent,de.colonia_ent,de.ciudad_ent,de.estado_ent,de.cp_ent,de.telefono_ent,de.email_ent FROM pg_pedidos p INNER JOIN dir_entregas_esp de ON de.idpedido=p.idpg_pedidos INNER JOIN dir_facturacion_esp df ON df.idpedido=p.idpg_pedidos WHERE p.no_control='$no_control'";
		return ejecutarConsultaSimpleFila($sql);

	}

	public function set_ident($idsaldos,$idsaldo_entregas)
	{

		$sql="UPDATE saldos SET idsaldos_entregas='$idsaldo_entregas' WHERE idsaldos='$idsaldos'";
		return ejecutarConsulta($sql);

	}

	public function set_idfact($idsaldos,$idsaldo_fact)
	{

		$sql="UPDATE saldos SET idsaldos_fact='$idsaldo_fact' WHERE idsaldos='$idsaldos'";
		return ejecutarConsulta($sql);

	}

	public function consul_idpedido($idpedido)
	{

		$sql="SELECT count(idpedido) as num_ped FROM saldo_fact WHERE idpedido='$idpedido'";
		return ejecutarConsulta($sql);

	}

	public function consul_det_pedsal($idsaldos)
	{

		$sql="SELECT s.idsaldos,s.no_pedido,sf.idsaldo_fact,sf.razon,sf.rfc,sf.calle,sf.numero,sf.interior,sf.colonia,sf.ciudad,sf.estado,sf.cp,sf.email,sf.telefono,se.idsaldo_entregas,se.contacto as contacto_s,se.calle as calle_s,se.numero as numero_s,se.interior as interior_s,se.colonia as colonia_s,se.ciudad as ciudad_s,se.estado as estado_s,se.cp as cp_s,se.email as email_s,se.telefono as telefono_s, se.fecha_entrega,se.hora_entrega1,se.hora_entrega2,se.forma_entrega,se.detalle_forma,se.comentario_entrega, (SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=s.idpedidos) as no_control FROM saldos s INNER JOIN saldo_entregas se ON s.idsaldos=se.idsaldos INNER JOIN saldo_fact sf ON s.idsaldos=sf.idsaldos WHERE s.idsaldos='$idsaldos'";
		return ejecutarConsultaSimpleFila($sql);

	}


	public function next_nopedido()
	{

		$sql="SELECT count(idsaldos) as num_ped FROM saldos WHERE estatus=1";
		return ejecutarConsultaSimpleFila($sql);

	}

	




}
?>