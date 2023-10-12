<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	$query = "SELECT * FROM pedidos";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->Cell(15,20,utf8_decode('Área: '),0,0,'L').$pdf->Cell(120,20,'Ventas',0,0,'L').$pdf->Cell(20,20,utf8_decode('Código: '),0,0,'L').$pdf->Cell(40,20,'FO-PG-VT-01',0,1,'L');
	$pdf->SetFont('Arial','', 12);
	$pdf->SetFillColor(232,232,232);
	$pdf->Cell(38,6,utf8_decode('Fecha'),1,0,'C',1).$pdf->Cell(38,6,utf8_decode('No. Cliente'),1,0,'C',1).$pdf->Cell(38,6,utf8_decode('No. Pedido'),1,0,'C',1).$pdf->Cell(38,6,utf8_decode('Condiciones'),1,0,'C',1).$pdf->Cell(38,6,utf8_decode('No. Control'),1,1,'C',1);
	$pdf->Cell(38,8,utf8_decode(''),1,0,'C').$pdf->Cell(38,8,utf8_decode(''),1,0,'C').$pdf->Cell(38,8,utf8_decode(''),1,0,'C').$pdf->Cell(38,8,utf8_decode(''),1,0,'C').$pdf->Cell(38,8,utf8_decode(''),1,1,'C');
	$pdf->Cell(190,8,utf8_decode('DATOS DE FACTURACIÓN'),1,1,'C');
	$pdf->Cell(25,8,utf8_decode('Nombre'),1,0,'L').$pdf->Cell(165,8,utf8_decode(''),1,1,'L');
	$pdf->Cell(25,8,utf8_decode('R.F.C.'),1,0,'L').$pdf->Cell(50,8,utf8_decode(''),1,0,'L').$pdf->Cell(15,8,utf8_decode('C.P.'),1,0,'L').$pdf->Cell(30,8,utf8_decode(''),1,0,'C').$pdf->Cell(32,8,utf8_decode('Asesor:'),1,0,'L').$pdf->Cell(38,8,utf8_decode(''),1,1,'C');
	$pdf->Cell(25,8,utf8_decode('Domicilio:'),1,0,'L').$pdf->Cell(95,8,utf8_decode(''),1,0,'L').$pdf->Cell(32,8,utf8_decode('Levanto pedido:'),1,0,'L').$pdf->Cell(38,8,utf8_decode(''),1,1,'C');
	$pdf->Cell(25,8,utf8_decode('Colonia:'),1,0,'L').$pdf->Cell(95,8,utf8_decode(''),1,0,'L').$pdf->Cell(32,8,utf8_decode('Cliente nuevo:'),1,0,'L').$pdf->Cell(38,8,utf8_decode(''),1,1,'C');
	$pdf->Cell(25,8,utf8_decode('Ciudad:'),1,0,'L').$pdf->Cell(95,8,utf8_decode(''),1,0,'L').$pdf->Cell(32,8,utf8_decode('Medio:'),1,0,'L').$pdf->Cell(38,8,utf8_decode(''),1,1,'C');
	$pdf->Cell(25,8,utf8_decode('Teléfono:'),1,0,'L').$pdf->Cell(95,8,utf8_decode(''),1,0,'L').$pdf->Cell(32,8,utf8_decode('LAB'),1,0,'L').$pdf->Cell(38,8,utf8_decode(''),1,1,'C');
	$pdf->Cell(25,8,utf8_decode('E-mail:'),1,0,'L').$pdf->Cell(165,8,utf8_decode(''),1,1,'L').$pdf->Cell(70,8,utf8_decode('Autorización ejecutivo de ventas:'),1,0,'L').$pdf->Cell(120,8,utf8_decode(''),1,1,'C');
	$pdf->Cell(190,8,utf8_decode('DATOS DE ENTREGA'),1,1,'C',1);
	$pdf->SetFillColor(255,255,255);
	$pdf->Cell(25,16,utf8_decode('Domicilio'),1,0,'C',1).$pdf->MultiCell(165,16,utf8_decode(''),1,1,'C');
	$pdf->Cell(25,8,utf8_decode('Colonia'),1,0,'C',1).$pdf->Cell(60,8,utf8_decode(''),1,0,'C').$pdf->Cell(35,8,utf8_decode('Ciudad/Estado'),1,0,'C',1).$pdf->Cell(70,8,utf8_decode(''),1,1,'C');
	//$pdf->SetFont('Arial','', 9);
	$pdf->Cell(25,8,utf8_decode('Contacto'),1,0,'L',1).$pdf->Cell(60,8,utf8_decode(''),1,0,'L',1).$pdf->Cell(35,8,utf8_decode('Telefono'),1,0,'L',1).$pdf->Cell(70,8,utf8_decode(''),1,1,'L',1);
	$pdf->Cell(25,8,utf8_decode('Fecha'),1,0,'L',1).$pdf->Cell(60,8,utf8_decode(''),1,0,'L',1).$pdf->Cell(35,8,utf8_decode('Horario'),1,0,'L',1).$pdf->Cell(70,8,utf8_decode(''),1,1,'L',1);
	$pdf->SetFont('Arial','', 12);
	$pdf->Cell(190,8,utf8_decode('FORMA DE ENTREGA'),1,1,'C',1);
	$pdf->SetFont('Arial','', 9);
	$pdf->Cell(30,8,utf8_decode('Nosotros'),1,0,'C',1).$pdf->Cell(15,8,utf8_decode(''),1,0,'C',1).$pdf->Cell(40,8,utf8_decode('Cliente Recoge'),1,0,'C',1).$pdf->Cell(15,8,utf8_decode(''),1,0,'C',1).$pdf->Cell(30,8,utf8_decode('Transporte'),1,0,'C',1).$pdf->Cell(15,8,utf8_decode(''),1,0,'C',1).$pdf->Cell(30,8,utf8_decode('Servicio'),1,0,'C',1).$pdf->Cell(15,8,utf8_decode(''),1,1,'C',1);

	$pdf->Cell(190,3,utf8_decode(''),0,1,'C',1);
	//$pdf->SetFont('Arial','', 6);
	
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,6,'Cantidad',1,0,'C',1);
	$pdf->Cell(18,6,'Unidad',1,0,'C',1);
	$pdf->Cell(18,6,'Codigo',1,0,'C',1);
	$pdf->Cell(18,6,'Medida',1,0,'C',1);
	$pdf->Cell(76,6,utf8_decode('Descripción'),1,0,'C',1);
	$pdf->Cell(18,6,'Precio',1,0,'C',1);
	$pdf->Cell(20,6,'Importe',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(22,6,utf8_decode($row['num_cliente']),1,0,'C');
		$pdf->Cell(18,6,$row['num_pedido'],1,0,'C');
		$pdf->Cell(18,6,utf8_decode($row['nombre']),1,0,'C');
		$pdf->Cell(18,6,utf8_decode($row['nombre']),1,0,'C');
		$pdf->Cell(76,6,utf8_decode($row['nombre']),1,0,'C');
		$pdf->Cell(18,6,utf8_decode($row['nombre']),1,0,'C');
		$pdf->Cell(20,6,utf8_decode($row['nombre']),1,1,'C');
	}
	$pdf->Output();
?>