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
//Incluímos el archivo Factura.php
require('Factura.php');

//Establecemos los datos de la empresa
$logo = "logocr.jpg";
$ext_logo = "jpg";
$empresa = "ASOCIACIÓN DE COLONOS DEL DESARROLLO RESIDENCIAL CAMPO REAL, A.C.";
$documento = "20477157772";
$direccion = "Av. Campo Marquez #419";
$direccion2 = "Fracc. Campo Real CP 45200 Zapopan, Jalisco.";
$telefono = "Tel: 36-85-17-53";
$email = "administracion@colonoscamporeal.com.mx";

//Obtenemos los datos de la cabecera de la venta actual
require_once "../modelos/Ingreso.php";
$ingreso= new Ingreso();
$rsptav = $ingreso->pagocabecera($_GET["id"]);
//Recorremos todos los valores obtenidos
$regv = $rsptav->fetch_object();

//Establecemos la configuración de la factura
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();

//Enviamos los datos de la empresa al método addSociete de la clase Factura
$pdf->addSociete(utf8_decode($empresa),
                  $documento."\n" .
                  utf8_decode("Dirección: ").utf8_decode($direccion)."\n".
                 // utf8_decode("Dirección").utf8_decode($direccion2)."\n".
                  utf8_decode("Teléfono: ").$telefono."\n" .
                  "Email : ".$email,$logo,$ext_logo);
$pdf->fact_dev( "$regv->tipo_comprobante ", "$regv->folio" );
$pdf->temporaire( "" );
$pdf->addDate( $regv->fecha);
  
//Enviamos los datos del cliente al método addClientAdresse de la clase Factura
$pdf->addClientAdresse(utf8_decode($regv->coto),"Lote: ".$regv->lote,"Numero: ".$regv->numero,"Domicilio: ".utf8_decode($regv->domicilio),$regv->tipo_comprobante.": ".$regv->folio,"Email: ".$regv->email,"Telefono: ".$regv->telefono);

//Establecemos las columnas que va a tener la sección donde mostramos los detalles de la venta
$cols=array( "CODIGO"=>23,
             "DESCRIPCION"=>78,
             "CANTIDAD"=>22,
             "P.U."=>25,
             "DSCTO"=>20,
             "SUBTOTAL"=>22);
$pdf->addCols( $cols);
$cols=array( "CODIGO"=>"L",
             "DESCRIPCION"=>"L",
             "CANTIDAD"=>"C",
             "P.U."=>"R",
             "DSCTO" =>"R",
             "SUBTOTAL"=>"C");
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
//Actualizamos el valor de la coordenada "y", que será la ubicación desde donde empezaremos a mostrar los datos
$y= 89;

//Obtenemos todos los detalles de la venta actual
$rsptad = $ingreso->pagodetalle($_GET["id"]);

while ($regd = $rsptad->fetch_object()) {
  $line = array( "CODIGO"=> "$regd->pago",
                "DESCRIPCION"=> utf8_decode("$regd->esp"),
                "CANTIDAD"=> "$regd->cantidad",
                "P.U."=> "$regd->total_pagodi_tot",
                "DSCTO" => "$regd->descuento",
                "SUBTOTAL"=> "$regd->subtotal");
            $size = $pdf->addLine( $y, $line );
            $y   += $size + 2;
}

//Convertimos el total en letras
require_once "Letras.php";
$V=new EnLetras(); 
$con_letra=strtoupper($V->ValorEnLetras($regv->total_pago,"PESOS"));
$pdf->addCadreTVAs("---".$con_letra);

//Mostramos el impuesto
$pdf->addTVAs( $regv->impuesto, $regv->total_pago,"S/ ");
$pdf->addCadreEurosFrancs("IGV"." $regv->impuesto %");
$pdf->Output('Reporte de Venta','I');


}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>