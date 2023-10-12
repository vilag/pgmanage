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



//$sql = "SELECT * FROM pg_pedidos WHERE idpg_pedidos=94";
$sql = "UPDATE pg_pedidos p SET 
					p.cant_est=
					IF(p.cant_est<(SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),
					(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE idpedido=p.idpg_pedidos AND estatus='Apartado')+
					(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE idpedido=p.idpg_pedidos AND estatus='Fabricado')+
					(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE idpedido=p.idpg_pedidos AND estatus='Existencia')+
					(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE idpedido=p.idpg_pedidos AND estatus='Cancelado'),
					p.cant_est),
					p.estatus_docs = (SELECT IFNULL(count(iddocumentos),0) FROM documentos WHERE tipo=1 AND nombre<>'' AND idpedido=p.idpg_pedidos),
					p.op=p.op+1,p.calculos_base=NOW()
					WHERE p.estatus2=1 AND p.estatus<>'CANCELADO'";
$result = $conn->query($sql);


$sql2 = "UPDATE pg_pedidos p SET 
					p.fecha_valid_term=
					IF(p.cant_est>=(SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),
					IF((SELECT fecha_hora FROM pg_detped WHERE idpedido=p.idpg_pedidos ORDER BY fecha_hora DESC LIMIT 1)>
					(SELECT fecha_hora2 FROM pg_detped WHERE idpedido=p.idpg_pedidos ORDER BY fecha_hora2 DESC LIMIT 1),
					(SELECT fecha_hora FROM pg_detped WHERE idpedido=p.idpg_pedidos ORDER BY fecha_hora DESC LIMIT 1),
					(SELECT fecha_hora2 FROM pg_detped WHERE idpedido=p.idpg_pedidos ORDER BY fecha_hora2 DESC LIMIT 1)),'0000-00-00 00:00:00'),
					p.op=p.op+1,p.calculos_base=NOW()
					WHERE p.estatus2=1 AND p.estatus<>'CANCELADO'";
$result = $conn->query($sql2);

$sql3 = "UPDATE pg_pedidos p SET p.estatus_vencim=IF(DATE(p.fecha_valid_term)<=p.fecha_entrega AND p.cant_est >= (SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos),1,0), p.op=p.op+1,p.calculos_base=NOW()
					WHERE (p.estatus2=1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4)";
$result = $conn->query($sql3);

$sql4 = "UPDATE pg_pedidos p SET 
					p.fecha_entr_mas1=IF(CONCAT(ELT(WEEKDAY(p.fecha_valid_term) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'))='Viernes',
					(DATE_ADD(p.fecha_valid_term,INTERVAL 3 DAY)),
					(DATE_ADD(p.fecha_valid_term,INTERVAL 1 DAY))
					),
					p.op=p.op+1,p.calculos_base=NOW()
					WHERE (p.estatus2=1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4)";
$result = $conn->query($sql4);

$sql5 = "UPDATE pg_pedidos p SET p.ent_tiempo=IF(DATEDIFF((SELECT DATE(fecha) FROM estatus_pedido_fab WHERE (idpedido=p.idpg_pedidos AND color='0BF6BF') OR (idpedido=p.idpg_pedidos AND color='7E0CA8') ORDER BY DATE(fecha) DESC LIMIT 1),DATE(p.fecha_entr_mas1))<=1,1,0), 
					p.op=p.op+1,p.calculos_base=NOW()
					WHERE (p.estatus2=1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4)";
$result = $conn->query($sql5);


$sql6 = "INSERT INTO calculos (tipo, fecha) VALUES ('Calculos_base', NOW())";
$result = $conn->query($sql6);


















$sql7 = "SELECT count(dp.idpg_detalle_pedidos) as num_sinrev FROM pg_detalle_pedidos dp INNER JOIN pg_pedidos p ON dp.idpg_pedidos=p.idpg_pedidos WHERE (SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=dp.idpg_detalle_pedidos)<dp.cantidad AND p.estatus2=1 AND p.estatus<>'CANCELADO' AND p.estatus<>'ENTREGADO'";
$result7 = mysqli_query($conn, $sql7);
$row = mysqli_fetch_assoc($result7);
$num_sinrev = $row['num_sinrev'];





$sql9 = "SELECT count(p.idpg_pedidos) as num_term FROM pg_pedidos p WHERE p.cant_est >= (SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO'";
$result9 = mysqli_query($conn, $sql9);
$row = mysqli_fetch_assoc($result9);
$num_term = $row['num_term'];




$sql10 = "SELECT count(idpg_pedidos) as num_vencidos FROM pg_pedidos WHERE estatus<>'ENTREGADO' AND estatus<>'CANCELADO' AND estatus2='1' AND DATEDIFF(DATE(fecha_entrega),NOW())<0";
$result10 = mysqli_query($conn, $sql10);
$row = mysqli_fetch_assoc($result10);
$num_vencidos = $row['num_vencidos'];



$sql_notif = "UPDATE result_notif SET num_sinrev='$num_sinrev', num_term='$num_term', num_vencidos='$num_vencidos',
fecha_hora=CURDATE(), hora=CURTIME()";
$result_notif = $conn->query($sql_notif);


$sql_limp = "DELETE FROM result_tbl_term";
$result_limp = $conn->query($sql_limp);





$sql11 = "SELECT idpg_pedidos as id_ini FROM pg_pedidos WHERE estatus2=1 AND estatus<>'ENTREGADO' AND estatus<>'CANCELADO' ORDER BY fecha_pedido ASC LIMIT 1";
$result11 = mysqli_query($conn, $sql11);
$row = mysqli_fetch_assoc($result11);
$id_ini = $row['id_ini'];

$sql12 = "SELECT idpg_pedidos as id_fin FROM pg_pedidos WHERE estatus2=1 AND estatus<>'ENTREGADO' AND estatus<>'CANCELADO' ORDER BY fecha_pedido DESC LIMIT 1";
$result12 = mysqli_query($conn, $sql12);
$row = mysqli_fetch_assoc($result12);
$id_fin = $row['id_fin'];

//$id_ini_base = $row['id_ini'];
echo $id_ini."<br>";
echo $id_fin."<br>";


while ($id_ini<=$id_fin) {
	
		$sql13 = "SELECT p.cant_est, p.estatus, p.no_control, p.estatus2,
		(SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as cant_detalle
		FROM pg_pedidos p WHERE p.idpg_pedidos='$id_ini'";
		$result13 = mysqli_query($conn, $sql13);
		$row = mysqli_fetch_assoc($result13);
		$cant_est = $row['cant_est'];//
		$cant_detalle = $row['cant_detalle'];//
		//$idpg_pedidos = $row['idpg_pedidos'];
		$estatus = $row['estatus'];
		$estatus2 = $row['estatus2'];
		$no_control = $row['no_control'];
		//$fecha_entrega = $row['fecha_entrega'];

		if ($cant_est>=$cant_detalle AND $estatus<>'ENTREGADO' AND $estatus<>'CANCELADO' AND $estatus2==1 AND $no_control<>1646) {

			//echo $idpg_pedidos.'<br>';

			$sql14 = "SELECT p.idpg_pedidos, p.no_control, p.fecha_valid_term as fecha_entrega, p.estatus_docs,
			(SELECT count(iddocumentos) FROM documentos WHERE idpedido=p.idpg_pedidos AND nombre<>'' AND tipo='1') as num_docs,
			(SELECT nombre FROM clientes WHERE idcliente=p.idcliente) as nom_cliente,
			(SELECT IFNULL(sum(cantidad),0) FROM salidas_entregas_detalles WHERE idpedido=p.idpg_pedidos) as cant_entrega,
			(SELECT IFNULL(sum(cantidad),0) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) as cant_pendiente
			FROM pg_pedidos p WHERE p.idpg_pedidos='$id_ini'";
			$result14 = mysqli_query($conn, $sql14);
			$row = mysqli_fetch_assoc($result14);
			$idpg_pedidos = $row['idpg_pedidos'];
			$no_control = $row['no_control'];
			$fecha_entrega = $row['fecha_entrega'];
			$num_docs = $row['num_docs'];
			$nom_cliente = $row['nom_cliente'];
			$cant_entrega = $row['cant_entrega'];
			$cant_pendiente = $row['cant_pendiente'];
			$estatus_docs = $row['estatus_docs'];

			$sql_notif_tbl = "INSERT INTO result_tbl_term (idpg_pedidos,no_control,fecha_entrega,num_docs,nom_cliente,cant_entrega,cant_pendiente,estatus_docs) VALUES('$idpg_pedidos','$no_control','$fecha_entrega','$num_docs','$nom_cliente','$cant_entrega','$cant_pendiente','$estatus_docs')";
			$result_notif_tbl = $conn->query($sql_notif_tbl);
			// code...
		}

	$id_ini = $id_ini+1;
}




/*$sql_op = "UPDATE op_detalle od SET cant_tot = (SELECT SUM(cant_tot) FROM op_detalle_prod WHERE idop=od.idop),
cant_fab_1 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 1),
cant_fab_2 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 2),
cant_fab_3 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 3),
cant_fab_5 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 5),
cant_fab_6 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 6),
cant_fab_7 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 7),
cant_fab_8 = (SELECT IFNULL(SUM(cant_capt),0) FROM op_avance_prod WHERE idop=od.idop AND area = 8),
cant_noent = (SELECT count(odp.idop_detalle_prod) 
FROM op_detalle_prod odp WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'ENTREGADO' AND odp.idop=od.idop AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=(SELECT idpg_pedidos FROM pg_detalle_pedidos WHERE idpg_detalle_pedidos=odp.iddetalle_pedido))<>'CANCELADO')

";
$result = $conn->query($sql_op);*/



		

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