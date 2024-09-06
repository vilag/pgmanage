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


// $sql7 = "SELECT count(dp.idpg_detalle_pedidos) as num_sinrev FROM pg_detalle_pedidos dp INNER JOIN pg_pedidos p ON dp.idpg_pedidos=p.idpg_pedidos WHERE (SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE iddetalle_pedido=dp.idpg_detalle_pedidos)<dp.cantidad AND p.estatus2=1 AND p.estatus<>'CANCELADO' AND p.estatus<>'ENTREGADO'";
// $result7 = mysqli_query($conn, $sql7);
// $row = mysqli_fetch_assoc($result7);
// $num_sinrev = $row['num_sinrev'];


// $sql9 = "SELECT count(p.idpg_pedidos) as num_term FROM pg_pedidos p WHERE p.cant_est >= (SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) AND p.estatus<>'ENTREGADO' AND p.estatus<>'CANCELADO' AND p.estatus<>'0'";
// $result9 = mysqli_query($conn, $sql9);
// $row = mysqli_fetch_assoc($result9);
// $num_term = $row['num_term'];




// $sql10 = "SELECT count(idpg_pedidos) as num_vencidos FROM pg_pedidos WHERE estatus<>'ENTREGADO' AND estatus<>'CANCELADO'AND estatus<>'0' AND estatus2='1' AND DATEDIFF(DATE(fecha_entrega),NOW())<0";
// $result10 = mysqli_query($conn, $sql10);
// $row = mysqli_fetch_assoc($result10);
// $num_vencidos = $row['num_vencidos'];



// $sql_notif = "UPDATE result_notif SET num_term='$num_term', num_vencidos='$num_vencidos',
// fecha_hora=CURDATE(), hora=CURTIME()";
// $result_notif = $conn->query($sql_notif);

$sql6 = "INSERT INTO calculos (tipo, fecha) VALUES ('Calculos_base2', NOW())";
$result = $conn->query($sql6);


echo "Terminado";



$conn->close();
?>