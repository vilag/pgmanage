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

		echo $cant_est." Cant_est <br>";
		echo $cant_detalle." Cant_detalle <br>";
		echo $no_control." No_control <br>";
		echo "_____________________________";

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


$sql6 = "INSERT INTO calculos (tipo, fecha) VALUES ('Calculos_base3', NOW())";
$result = $conn->query($sql6);


echo "Terminado";


$conn->close();
?>