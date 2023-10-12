<?php
 	require "../config/Conexion.php";

 	Class Projects
 	{
 		public function __construct()
		{

		}

		public function guardar_objetivo($descrip_obj,$fecha_ini_obj,$fecha_fin_obj)
		{
			
				$sql="INSERT INTO objetivos (nombre,fecha_inicio,fecha_termino,estatus) VALUES ('$descrip_obj','$fecha_ini_obj','$fecha_fin_obj','0')";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);
									
		}

		public function listar_objetivos()
		{
			
				$sql="SELECT * FROM objetivos ORDER BY idobjetivos DESC";
				//return ejecutarConsultaSimpleFila($sql);
				return ejecutarConsulta($sql);
									
		}


 	}

?>