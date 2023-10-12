<?php 

			//require 'fpdf/fpdf.php';
			include 'plantilla.php';
			require 'conexion.php';


			$query = "SELECT * FROM pedidos";
			$resultado = $mysqli->query($query);



			//$pdf = new FPDF('P', 'mm', 'legal');
			$pdf = new PDF();
			$pdf->AliasPages();
			$pdf->AddPage();

			$pdf->SetFillColor(232,232,232);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(70,6, 'NUM_CLIENTE',1,0,'C',1);
			$pdf->Cell(20,6, 'NUM_PEDIDO',1,0,'C',1);
			$pdf->Cell(70,6, 'NOMBRE',1,1,'C',1);

			$pdf->Output();



?>