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




/*$sql11_det = "SELECT idpg_pedidos as id_ini FROM pg_pedidos WHERE estatus2=1 AND estatus<>'ENTREGADO' AND estatus<>'CANCELADO' ORDER BY fecha_pedido ASC LIMIT 1";
$result11_det = mysqli_query($conn, $sql11_det);
$row = mysqli_fetch_assoc($result11_det);
$id_ini_det = $row['id_ini'];

$sql12_det = "SELECT idpg_pedidos as id_fin FROM pg_pedidos WHERE estatus2=1 AND estatus<>'ENTREGADO' AND estatus<>'CANCELADO' ORDER BY fecha_pedido DESC LIMIT 1";
$result12_det = mysqli_query($conn, $sql12_det);
$row = mysqli_fetch_assoc($result12_det);
$id_fin_det = $row['id_fin'];

//$id_ini_base = $row['id_ini'];

echo $id_ini_det."<br>";
echo $id_fin_det."<br>";*/


$sql_limp_det = "DELETE FROM result_tbl_sinp";
$result_limp_det = $conn->query($sql_limp_det);


$sql_pdp1 = "
SELECT pdp.idpg_detalle_pedidos as idpdp_1,
(SELECT fecha_pedido FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos) as fecha_pedido,
(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos) as control
FROM pg_detalle_pedidos pdp 
WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)<>'ENTREGADO' 
AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)<>'CANCELADO'
AND (SELECT estatus2 FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)=1
ORDER BY (SELECT fecha_pedido FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos) ASC LIMIT 1
";
$result_pdp1 = mysqli_query($conn, $sql_pdp1);
$row = mysqli_fetch_assoc($result_pdp1);
$iddet_ini = $row['idpdp_1'];


$sql_pdp2 = "
SELECT pdp.idpg_detalle_pedidos as idpdp_2,
(SELECT fecha_pedido FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos) as fecha_pedido,
(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos) as control
FROM pg_detalle_pedidos pdp 
WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)<>'ENTREGADO' 
AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)<>'CANCELADO'
AND (SELECT estatus2 FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)=1
ORDER BY (SELECT fecha_pedido FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos) DESC LIMIT 1
";
$result_pdp2 = mysqli_query($conn, $sql_pdp2);
$row = mysqli_fetch_assoc($result_pdp2);
$iddet_fin = $row['idpdp_2'];




/*$sql11_fin = "SELECT pdp.idpg_detalle_pedidos as iddet_fin FROM pg_detalle_pedidos pdp WHERE pdp.idpg_pedidos='$id_fin_det' ORDER BY (SELECT fecha_pedido FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos) DESC LIMIT 1";
$result11_fin = mysqli_query($conn, $sql11_fin);
$row = mysqli_fetch_assoc($result11_fin);
$iddet_fin = $row['iddet_fin'];*/

echo $iddet_ini."<br>";
echo $iddet_fin."<br>";

while ($iddet_ini<=$iddet_fin) {

	$sql15 = "SELECT dp.idpg_detalle_pedidos,dp.cantidad,p.estatus,p.estatus2,p.no_control,
	(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=dp.idpg_detalle_pedidos) as cant_detped_det
	FROM pg_detalle_pedidos dp INNER JOIN pg_pedidos p ON dp.idpg_pedidos=p.idpg_pedidos 
	WHERE dp.idpg_detalle_pedidos='$iddet_ini'";
	$result15 = mysqli_query($conn, $sql15);
	$row = mysqli_fetch_assoc($result15);
	$cant_detped_det = $row['cant_detped_det'];
	$cantidad = $row['cantidad'];
	$estatus = $row['estatus'];
	$estatus2 = $row['estatus2'];
	$no_control = $row['no_control'];
	$idpg_detalle_pedidos = $row['idpg_detalle_pedidos'];

		if ($cant_detped_det<$cantidad AND $estatus2==1 AND $estatus<>'CANCELADO' AND $estatus<>'ENTREGADO') {

			$cant_sinp = $cantidad-$cant_detped_det;

			$sql_notif_tbl_det = "INSERT INTO result_tbl_sinp (iddetalle_pedidos,cant_sinp) VALUES('$idpg_detalle_pedidos','$cant_sinp')";
			$result_notif_tbl_det = $conn->query($sql_notif_tbl_det);

			echo 'Suma detped: '.$cant_detped_det.'<br>';
			echo 'Cantidad: '.$cantidad.'<br>';
			echo 'Control: '.$no_control.'<br><br>';

			//echo $idpg_detalle_pedidos.'<br>';
			// code...
		}

	$iddet_ini = $iddet_ini+1;
	// code...
}

$sql6 = "INSERT INTO calculos (tipo, fecha) VALUES ('Calculos_sin_rev', NOW())";
$result = $conn->query($sql6);


echo "Terminado".'<br>';


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