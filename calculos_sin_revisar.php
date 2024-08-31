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

// echo date('l jS \of F Y h:i:s A');

$sql_limp_det = "DELETE FROM result_tbl_sinp";
$result_limp_det = $conn->query($sql_limp_det);

$sql_pdp1 = "
SELECT a.idpg_detalle_pedidos as idpdp_1
FROM pg_detalle_pedidos a INNER JOIN pg_pedidos b ON a.idpg_pedidos = b.idpg_pedidos
WHERE b.estatus <> 'ENTREGADO' AND b.estatus <> 'CANCELADO' AND b.estatus2 = 1
ORDER BY b.fecha_pedido ASC LIMIT 1";

// $sql_pdp1 = "
// SELECT pdp.idpg_detalle_pedidos as idpdp_1
// FROM pg_detalle_pedidos pdp 
// WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)<>'ENTREGADO' 
// AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)<>'CANCELADO'
// AND (SELECT estatus2 FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)=1
// ORDER BY (SELECT fecha_pedido FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos) ASC LIMIT 1
// ";
$result_pdp1 = mysqli_query($conn, $sql_pdp1);
$row = mysqli_fetch_assoc($result_pdp1);
$iddet_ini = $row['idpdp_1']-1;

$sql_pdp2 = "
SELECT a.idpg_detalle_pedidos as idpdp_2
FROM pg_detalle_pedidos a INNER JOIN pg_pedidos b ON a.idpg_pedidos = b.idpg_pedidos
WHERE b.estatus <> 'ENTREGADO' AND b.estatus <> 'CANCELADO' AND b.estatus2 = 1
ORDER BY b.fecha_pedido DESC LIMIT 1";

// $sql_pdp2 = "
// SELECT pdp.idpg_detalle_pedidos as idpdp_2
// FROM pg_detalle_pedidos pdp 
// WHERE (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)<>'ENTREGADO' 
// AND (SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)<>'CANCELADO'
// AND (SELECT estatus2 FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos)=1
// ORDER BY (SELECT fecha_pedido FROM pg_pedidos WHERE idpg_pedidos=pdp.idpg_pedidos) DESC LIMIT 1
// ";
$result_pdp2 = mysqli_query($conn, $sql_pdp2);
$row = mysqli_fetch_assoc($result_pdp2);
$iddet_fin = $row['idpdp_2']+1;


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

		}

	$iddet_ini = $iddet_ini+1;
	// code...
}

$sql6 = "INSERT INTO calculos (tipo, fecha) VALUES ('Calculos_sin_rev', NOW())";
$result = $conn->query($sql6);


echo "Terminado".'<br>';
// echo date('l jS \of F Y h:i:s A');

$conn->close();
?>