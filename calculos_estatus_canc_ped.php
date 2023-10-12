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


$sql_consul = "SELECT min(idpg_pedidos) as id1 FROM pg_pedidos WHERE estatus2=1";
$result_consul = mysqli_query($conn, $sql_consul);
$row = mysqli_fetch_assoc($result_consul);
$id1 = $row['id1'];

$sql_consul2 = "SELECT max(idpg_pedidos) as id2 FROM pg_pedidos WHERE estatus2=1";
$result_consul2 = mysqli_query($conn, $sql_consul2);
$row = mysqli_fetch_assoc($result_consul2);
$id2 = $row['id2'];

echo $id1.'<br>';
echo $id2.'<br>';

while ($id1<=$id2) {

	$sql_consul3 = "SELECT max(idpedido) as idpedido_max FROM estatus_pedido_fab WHERE (idpedido='$id1' AND color='BF0E13')";
	$result_consul3 = mysqli_query($conn, $sql_consul3);
	$row = mysqli_fetch_assoc($result_consul3);
	$idpedido_max = $row['idpedido_max'];

	if ($idpedido_max>0) {

			echo $idpedido_max.' Se actualiza<br>';

			$sql_update_estatus = "UPDATE pg_pedidos SET estatus='CANCELADO' WHERE idpg_pedidos='$idpedido_max'";
			$result_update_estatus = $conn->query($sql_update_estatus);

			$sql_res_idped = "SELECT estatus FROM pg_pedidos WHERE idpg_pedidos='$idpedido_max'";
			$result_res_idped = mysqli_query($conn, $sql_res_idped);
			$row = mysqli_fetch_assoc($result_res_idped);
			$estatus = $row['estatus'];
			echo "Estatus: ".$estatus;
		
	}else{

			echo $idpedido_max.' No se actualiza<br>';
	}

	$id1 = $id1+1;
}


	


$conn->close();
?>