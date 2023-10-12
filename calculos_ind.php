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

$sql = "SELECT 

(SELECT YEAR(p.fecha_pedido) FROM pg_pedidos p WHERE YEAR(p.fecha_pedido)>0 ORDER BY YEAR(p.fecha_pedido) ASC LIMIT 1) as anio1,
(SELECT YEAR(p.fecha_pedido) FROM pg_pedidos p WHERE YEAR(p.fecha_pedido)>0 ORDER BY YEAR(p.fecha_pedido) DESC LIMIT 1) as anio2,
(SELECT idlugar FROM lugares ORDER BY idlugar ASC LIMIT 1) as idlugar1,
(SELECT idlugar FROM lugares ORDER BY idlugar DESC LIMIT 1) as idlugar2

FROM pg_pedidos p LIMIT 1";
//$result = $conn->query($sql);


$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$anio1 = $row['anio1'];
$anio2 = $row['anio2'];
$idlugar1 = $row['idlugar1'];
$idlugar2 = $row['idlugar2'];
/*echo "Año1: ".$anio1."<br>";
echo "Año2: ".$anio2."<br>";
echo "Lugar1: ".$idlugar1."<br>";
echo "Lugar2: ".$idlugar2."<br>";*/

while ($anio1 <= $anio2) {

	$sql2 = "SELECT count(anio) as anio FROM indicadores WHERE anio = '$anio1'";
	$result2 = mysqli_query($conn, $sql2);
	$row = mysqli_fetch_assoc($result2);

	$anio = $row['anio'];
	$lugar_b = $idlugar1;
	//echo "año: " . $row["anio"]. "<br>";

	if ($anio==0) {

		$sql3 = "INSERT INTO indicadores (anio) VALUES ('$anio1')";
		$result3 = $conn->query($sql3);

		while ($lugar_b <= $idlugar2) {
			# code...
			$sql5 = "INSERT INTO ped_lugar_anio (idlugar,anio) VALUES ('$lugar_b','$anio1')";
			$result5 = $conn->query($sql5);

			$lugar_b=$lugar_b+1;
		}

		$lugar_b = $idlugar1;

			
	}elseif ($anio>0) {

		$sql4 = "UPDATE indicadores SET 
		num_pedidos=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND YEAR(p.fecha_pedido) = '$anio1' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4),



		pedidos_terminados=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND p.cant_est=(SELECT sum(cantidad) FROM pg_detalle_pedidos WHERE idpg_pedidos=p.idpg_pedidos) AND YEAR(p.fecha_pedido) = '$anio1' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4),




		pedidos_entregados=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND p.estatus='ENTREGADO' AND YEAR(p.fecha_pedido) = '$anio1' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4),


		pedidos_cancelados = (SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND p.estatus='CANCELADO' AND YEAR(p.fecha_pedido) = '$anio1' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4) 

		WHERE anio='$anio1'";
		$result4 = $conn->query($sql4);

		$lugar_b = $idlugar1;

		while ($lugar_b <= $idlugar2) {
			# code...
			if ($lugar_b==1) {
				$condicion='';
			}elseif ($lugar_b>1) {
				$condicion="AND (SELECT lugar FROM usuario WHERE idusuario=p.idusuario)=(SELECT nombre FROM lugares WHERE idlugar='$lugar_b')";
			}

			$sql6 = "UPDATE ped_lugar_anio SET 
			ene=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND YEAR(p.fecha_pedido)='$anio1' AND MONTH(p.fecha_pedido) = 1 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 $condicion),
			feb=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND YEAR(p.fecha_pedido)='$anio1' AND MONTH(p.fecha_pedido) = 2 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 $condicion),
			mar=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND YEAR(p.fecha_pedido)='$anio1' AND MONTH(p.fecha_pedido) = 3 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 $condicion),
			abr=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND YEAR(p.fecha_pedido)='$anio1' AND MONTH(p.fecha_pedido) = 4 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 $condicion),
			may=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND YEAR(p.fecha_pedido)='$anio1' AND MONTH(p.fecha_pedido) = 5 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 $condicion),
			jun=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND YEAR(p.fecha_pedido)='$anio1' AND MONTH(p.fecha_pedido) = 6 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 $condicion),
			jul=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND YEAR(p.fecha_pedido)='$anio1' AND MONTH(p.fecha_pedido) = 7 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 $condicion),
			ago=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND YEAR(p.fecha_pedido)='$anio1' AND MONTH(p.fecha_pedido) = 8 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 $condicion),
			sep=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND YEAR(p.fecha_pedido)='$anio1' AND MONTH(p.fecha_pedido) = 9 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 $condicion),
			oct=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND YEAR(p.fecha_pedido)='$anio1' AND MONTH(p.fecha_pedido) = 10 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 $condicion),
			nov=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND YEAR(p.fecha_pedido)='$anio1' AND MONTH(p.fecha_pedido) = 11 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 $condicion),
			dic=(SELECT count(p.idpg_pedidos) FROM pg_pedidos p WHERE p.estatus2=1 AND YEAR(p.fecha_pedido)='$anio1' AND MONTH(p.fecha_pedido) = 12 AND p.estatus<>'CANCELADO' AND p.idcliente<>2509 AND p.idcliente<>2511 AND p.idcliente<>2512 AND p.tipo<>4 $condicion)

			WHERE idlugar='$lugar_b' AND anio='$anio1'
			";
			$result5 = $conn->query($sql6);

			$lugar_b=$lugar_b+1;
		}

		$lugar_b = $idlugar1;

		
	}
		

	$anio1 = $anio1+1;

	
}

$sql7 = "INSERT INTO calculos (tipo, fecha) VALUES ('Calculos_ind', NOW())";
$result = $conn->query($sql7);

//if ($result->num_rows > 0){

	
//}





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