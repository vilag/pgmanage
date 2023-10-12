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

$sql_pd1_vale = "
SELECT pd.idpg_detped as id1,
(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as estatus_de_pedido,
(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as no_control
FROM pg_detped pd 
WHERE (pd.estatus='Apartado' AND 
			(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'ENTREGADO' AND 
			(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'CANCELADO') 
ORDER BY pd.fecha_hora ASC LIMIT 1
";
$result_pd1_vale = mysqli_query($conn, $sql_pd1_vale);
$row = mysqli_fetch_assoc($result_pd1_vale);
$id1_apartado = $row['id1'];



$sql_pd2_vale = "
SELECT pd.idpg_detped as id2,
(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as estatus_de_pedido,
(SELECT no_control FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido) as no_control
FROM pg_detped pd 
WHERE (pd.estatus='Apartado' AND 
			(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'ENTREGADO' AND 
			(SELECT estatus FROM pg_pedidos WHERE idpg_pedidos=pd.idpedido)<>'CANCELADO') 
ORDER BY pd.fecha_hora DESC LIMIT 1
";
$result_pd2_vale = mysqli_query($conn, $sql_pd2_vale);
$row = mysqli_fetch_assoc($result_pd2_vale);
$id2_apartado = $row['id2'];



//$id_ini_base = $row['id_ini'];
echo $id1_apartado." id1_apartado <br>";
echo $id2_apartado." id2_apartado <br>";

while ($id1_apartado<=$id2_apartado) {

	$sql_consul_vale = "SELECT estatus,idpg_detped as idpg_detped_vale FROM vale_salida WHERE idpg_detped='$id1_apartado'";
	$result_consul_vale = mysqli_query($conn, $sql_consul_vale);
	$row = mysqli_fetch_assoc($result_consul_vale);
	$estatus = $row['estatus'];
	$idpg_detped_vale = $row['idpg_detped_vale'];

	if ($estatus==1) {

		$sql_upd_surtidos = "UPDATE pg_detped SET estatus = 'Surtido' WHERE idpg_detped='$idpg_detped_vale'";
		$result_surtidos = $conn->query($sql_upd_surtidos);

	}


	$id1_apartado = $id1_apartado+1;
}

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