<?php

//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Entregas
{

	public function listar_entregas()
	{

		$sql="SELECT * FROM entregas WHERE estatus=1";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function listar_prod_entregas($id)
	{

		$sql="SELECT * FROM entregas_detalle WHERE identregas='$id'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);			
	}

	public function reg_entrega($fecha)
	{

		$sql="INSERT INTO entregas(fecha) VALUES('$fecha')";
		//return ejecutarConsultaSimpleFila($sql);
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$sql_id="SELECT * FROM entregas WHERE identregas='$idingresonew'";
        return ejecutarConsultaSimpleFila($sql_id);			
	}

	public function save_prod($identregas,$lote,$cantidad,$codigo,$descripcion)
	{

		$sql="INSERT INTO entregas_detalle(identregas,cantidad,codigo,descripcion,lote) VALUES('$identregas','$cantidad','$codigo','$descripcion','$lote')";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}

	public function save_entrega($identregas,$fecha_sal,$no_salida_sal,$no_control_sal,$no_pedido_sal,$nombre_sal,$entregado_a_sal,$domicilio_sal,$colonia_sal,$municipio_sal,$estado_sal,$cp_sal,$contacto_sal,$telefono_sal,$horario_sal,$condiciones_sal,$medio_sal)
	{

		$sql="UPDATE entregas SET fecha='$fecha_sal',no_salida='$no_salida_sal',no_control='$no_control_sal',no_pedido='$no_pedido_sal',nombre='$nombre_sal',entregado_a='$entregado_a_sal',dom='$domicilio_sal',col='$colonia_sal',mun='$municipio_sal',est='$estado_sal',cp='$cp_sal',contacto='$contacto_sal',tel='$telefono_sal',horario='$horario_sal',condiciones='$condiciones_sal',medio_transporte='$medio_sal' WHERE identregas='$identregas'";
		//return ejecutarConsultaSimpleFila($sql);
		return ejecutarConsulta($sql);		
	}


	

//,,


}
?>