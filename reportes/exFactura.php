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
$logo = "logo_pg.jpg";
$ext_logo = "jpg";
$empresa = "Cliente";
$documento = "20477157772";
$direccion = "Calle y numero";
$direccion2 = "Colonia, ciudad, estado, cp";
$telefono = "Tel: 36-85-17-53";
$email = "email";

//Obtenemos los datos de la cabecera de la venta actual
require_once "../modelos/Diseno.php";
$diseno= new Diseno();
$rsptav = $diseno->consulta_pedido($_GET["id"]);
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
$pdf->fact_dev( "Nada ", "Nada" );
$pdf->temporaire( "" );
$pdf->addDate( $regv->fecha_pedido);
  
//Enviamos los datos del cliente al método addClientAdresse de la clase Factura
$pdf->addClientAdresse(utf8_decode($regv->idpg_pedidos),"Cliente: ".$regv->idcliente,"No. Pedido: ".$regv->no_pedido,"Fecha de entrega: ".utf8_decode($regv->fecha_entrega),$regv->hora_entrega." - ".$regv->hora_entrega2,"identrega: ".$regv->id_entrega,"idfacturacion: ".$regv->idfacturacion);

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
$rsptad = $diseno->detalle_pedido($_GET["id"]);

while ($regd = $rsptad->fetch_object()) {
  $line = array( "CODIGO"=> "$regd->codigo",
                "DESCRIPCION"=> utf8_decode("$regd->descripcion"),
                "CANTIDAD"=> "$regd->cantidad",
                "P.U."=> "$regd->importe",
                "DSCTO" => "$regd->importe",
                "SUBTOTAL"=> "$regd->importe");
            $size = $pdf->addLine( $y, $line );
            $y   += $size + 2;
}

//Convertimos el total en letras
require_once "Letras.php";
$V=new EnLetras(); 
$con_letra=strtoupper($V->ValorEnLetras($regv->idcliente,"PESOS"));
$pdf->addCadreTVAs("---".$con_letra);

//Mostramos el impuesto
$pdf->addTVAs( $regv->idcliente, $regv->idcliente,"S/ ");
$pdf->addCadreEurosFrancs("IGV"." $regv->idcliente %");
$pdf->Output('Reporte de Venta','I');


}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>