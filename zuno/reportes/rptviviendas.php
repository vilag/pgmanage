<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1) 
  session_start();

if (!isset($_SESSION["nombre"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
}
else
{
if ($_SESSION['administrador']==1)
{

//Inlcuímos a la clase PDF_MC_Table
require('PDF_MC_Table.php');
 
//Instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table();
 
//Agregamos la primera página al documento pdf
$pdf->AddPage();
 
//Seteamos el inicio del margen superior en 25 pixeles 
$y_axis_initial = 25;
 
//Seteamos el tipo de letra y creamos el título de la página. No es un encabezado no se repetirá
$pdf->SetFont('Arial','B',12);

$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTA DE VIVIENDAS',1,0,'C'); 
$pdf->Ln(10);
 
//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232); 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,6,utf8_decode('Coto'),1,0,'C',1); 
$pdf->Cell(20,6,'Lote',1,0,'C',1);
$pdf->Cell(20,6,'Numero',1,0,'C',1);
$pdf->Cell(60,6,'Domicilio',1,0,'C',1);
$pdf->Cell(60,6,'Comentario',1,0,'C',1);
 
$pdf->Ln(10);
//Comenzamos a crear las filas de los registros según la consulta mysql
require_once "../modelos/Vivienda.php";
$vivienda = new Vivienda();

$rspta = $vivienda->listar();

//Table with 20 rows and 4 columns
$pdf->SetWidths(array(30,20,20,60,60));

while($reg= $rspta->fetch_object())
{  
    $coto = $reg->coto;
    $numero = $reg->numero;
    $numero2 = $reg->numero2;
    $domicilio = $reg->domicilio;
    $comentario =$reg->comentario;
 	
 	$pdf->SetFont('Arial','',10);
    $pdf->Row(array(utf8_decode($coto),$numero,$numero2,utf8_decode($domicilio),utf8_decode($comentario)));
}
 
//Mostramos el documento pdf
$pdf->Output();

?>
<?php
}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>