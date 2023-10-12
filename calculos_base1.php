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
					(SELECT IFNULL(sum(cantidad),0) FROM pg_detped WHERE idpedido=p.idpg_pedidos AND estatus='Surtido')+
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


$sql6 = "INSERT INTO calculos (tipo, fecha) VALUES ('Calculos_base1', NOW())";
$result = $conn->query($sql6);


echo "Terminado";



$conn->close();
?>