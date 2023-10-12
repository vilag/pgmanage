<?php
$servername = 'localhost';
$username = 'u690371019_pgmanage';
//$username = 'root';
$password = "A=tSXZ4z";
//$password = "";
$dbname = "u690371019_pgmanage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



$sql_pd1 = "
SELECT pd.idpg_detped as id1,
(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as estatus_de_pedido,
(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as no_control
FROM pg_detped pd 
WHERE (pd.estatus='Produccion' AND 
			(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'ENTREGADO' AND 
			(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'CANCELADO') OR 
			(pd.estatus='Fabricado' AND 
			(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'ENTREGADO' AND 
			(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'CANCELADO') 
ORDER BY (SELECT fecha_pedido FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) ASC LIMIT 1
";
$result_pd1 = mysqli_query($conn, $sql_pd1);
$row = mysqli_fetch_assoc($result_pd1);
$id1 = $row['id1'];


$sql_pd2 = "
SELECT pd.idpg_detped as id2,
(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as estatus_de_pedido,
(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as no_control
FROM pg_detped pd 
WHERE (pd.estatus='Produccion' AND 
			(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'ENTREGADO' AND 
			(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'CANCELADO') OR 
			(pd.estatus='Fabricado' AND 
			(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'ENTREGADO' AND 
			(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'CANCELADO') 
ORDER BY (SELECT fecha_pedido FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) DESC LIMIT 1
";
$result_pd2 = mysqli_query($conn, $sql_pd2);
$row = mysqli_fetch_assoc($result_pd2);
$id2 = $row['id2'];


//$id_ini_base = $row['id_ini'];
echo $id1."<br>";
echo $id2."<br>";
$conteo_produccion=0;
$conteo_fabricado=0;

while ($id1<=$id2) {

	echo "______________<br>";


		$sql_consul = "SELECT idpg_detped,estatus FROM pg_detped WHERE idpg_detped='$id1'";
		$result_consul = mysqli_query($conn, $sql_consul);
		$row = mysqli_fetch_assoc($result_consul);
		$idpg_detped = $row['idpg_detped'];
		$estatus = $row['estatus'];

					
			echo "idpg_detped = ".$idpg_detped."<br> estatus = ".$estatus."<br>";


			if ($estatus=='Produccion' || $estatus=='Fabricado') {
				// code...

				//echo "es prod";
				$sql_consul_2 = "SELECT idop_detalle_prod as idop_dp, cant_tot, idop FROM op_detalle_prod WHERE idpg_detped='$idpg_detped'";
				$result_consul_2 = mysqli_query($conn, $sql_consul_2);
				$row = mysqli_fetch_assoc($result_consul_2);
				$idop_dp = $row['idop_dp'];
				$cant_tot = $row['cant_tot'];
				$idop = $row['idop'];

					echo "idop = ". $idop."<br>";

					$sql_consul_3 = "SELECT area FROM op_detalle WHERE idop='$idop' ORDER BY prioridad DESC LIMIT 1";
					$result_consul_3 = mysqli_query($conn, $sql_consul_3);
					$row = mysqli_fetch_assoc($result_consul_3);
					$area = $row['area'];


						echo "idop_detalle_prod = ". $idop_dp."<br>";
						echo "area = ". $area."<br>";


						$sql_consul_4 = "SELECT sum(cant_capt) as cantidades_capturadas FROM op_avance_prod WHERE idop_detalle_prod='$idop_dp' AND area='$area' ORDER BY fecha_hora DESC LIMIT 1";
						$result_consul_4 = mysqli_query($conn, $sql_consul_4);
						$row = mysqli_fetch_assoc($result_consul_4);
						$cantidades_capturadas = $row['cantidades_capturadas'];	

						echo $cantidades_capturadas.' suma de cantidades capturadas <br>';


						$sql_consul_4 = "SELECT avance,fecha_hora FROM op_avance_prod WHERE idop_detalle_prod='$idop_dp' AND area='$area' ORDER BY fecha_hora DESC LIMIT 1";
						$result_consul_4 = mysqli_query($conn, $sql_consul_4);
						$row = mysqli_fetch_assoc($result_consul_4);
						$avance = $row['avance'];
						$fecha_hora_av = $row['fecha_hora'];

						echo $avance.' Avance producción <br>';
						echo $cant_tot.' Cantidad total <br>';

						if (($avance>0 OR $cantidades_capturadas>0) AND $cant_tot>0) {

								if ($avance>=$cant_tot OR $cantidades_capturadas>=$cant_tot) {

									echo $avance."-".$cant_tot."-".$idpg_detped." si <br>";
									echo 'Estatus: Fabricado <br>';

									$sql_update_pgdetped = "UPDATE pg_detped SET estatus='Fabricado', fecha_hora2='$fecha_hora_av' WHERE idpg_detped='$idpg_detped'";
									$result_update_pgdetped = $conn->query($sql_update_pgdetped);

									$sql_consul_ped = "SELECT pd.idpedido,(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as no_control FROM pg_detped pd WHERE pd.idpg_detped='$idpg_detped'";
									$result_consul_ped = mysqli_query($conn, $sql_consul_ped);
									$row = mysqli_fetch_assoc($result_consul_ped);
									$idpedido = $row['idpedido'];
									$no_control = $row['no_control'];

									echo 'Control: '.$no_control.'<br>';

									echo "//////////////////////////////////////////////////////////////////////////////<br><br><br><br><br><br>";
									
									$conteo_fabricado=$conteo_fabricado+1;

								}
							// code...
						}else {
							// code...
						

									echo $avance."-".$cant_tot."-".$idpg_detped." no <br>";
									echo 'Estatus: Produccion <br>';

									$sql_update_pgdetped = "UPDATE pg_detped SET estatus='Produccion', fecha_hora2='0000-00-00 00:00:00' WHERE idpg_detped='$idpg_detped'";
									$result_update_pgdetped = $conn->query($sql_update_pgdetped);


									$sql_consul_ped = "SELECT pd.idpedido,(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as no_control FROM pg_detped pd WHERE pd.idpg_detped='$idpg_detped'";
									$result_consul_ped = mysqli_query($conn, $sql_consul_ped);
									$row = mysqli_fetch_assoc($result_consul_ped);
									$idpedido = $row['idpedido'];
									$no_control = $row['no_control'];

									echo 'Control: '.$no_control.'<br>';


									$sql_consul_exist_est = "SELECT count(idpedido) as idpedido_num FROM estatus_pedido_fab WHERE (idpedido='$idpedido' AND color='0BF6BF') OR (idpedido='$idpedido' AND color='7E0CA8')";
									$result_exist_est = mysqli_query($conn, $sql_consul_exist_est);
									$row = mysqli_fetch_assoc($result_exist_est);
									$idpedido_num = $row['idpedido_num'];

									if ($idpedido_num==0) {

										$sql_consul_canc = "SELECT estatus as estatus_canc, no_control as no_control_upd FROM pg_pedidos WHERE idpg_pedidos='$idpedido'";
										$result_exist_canc = mysqli_query($conn, $sql_consul_canc);
										$row = mysqli_fetch_assoc($result_exist_canc);
										$estatus_canc = $row['estatus_canc'];
										$no_control_upd = $row['no_control_upd'];

										if ($estatus_canc<>'CANCELADO') {

											echo "Estatus: ".$estatus_canc."<br>";
											echo "Se actualiza: ".$idpedido."<br>";
											echo 'Control: '.$no_control_upd.'<br>';

											$sql_update_pedido = "UPDATE pg_pedidos SET cant_est='0', estatus='Control PG' WHERE idpg_pedidos='$idpedido'";
											$result_update_pedido = $conn->query($sql_update_pedido);
											
											// code...
										}
										// code...
									}

										

									echo "____________________________________________<br><br><br><br><br><br>";

									$conteo_produccion=$conteo_produccion+1;
						}


			}

		

		
		// code...
	
	$id1 = $id1+1;
}


$sql_calculos = "INSERT INTO calculos (tipo,fecha) VALUES ('Calculo de fabricados',NOW())";
$result_calculos = $conn->query($sql_calculos);
	

echo $conteo_produccion.' producción';
echo $conteo_fabricado.' fabricados';
/*$sql6 = "INSERT INTO calculos (tipo, fecha) VALUES ('Calculos_base', NOW())";
$result = $conn->query($sql6);*/




//echo $result;

/*if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["idpg_pedidos"]. " - Control: " . $row["no_control"]. " - Pedido:" . $row["no_pedido"]. "<br>";
  }
} else {
  echo "0 results";
}*/
$conn->close();
?>