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
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1)
{
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../public/css/ticket.css" rel="stylesheet" type="text/css">
</head>
<body onload="">
<?php

//Incluímos la clase Venta
require_once "ventas/Ventas.php";
//Instanaciamos a la clase con el objeto venta
$ventas=new Ventas();
//En el objeto $rspta Obtenemos los valores devueltos del método ventacabecera del modelo
$rspta = $ventas->mostrar_detalle_venta($_GET["id"]);
//Recorremos todos los valores obtenidos
$reg = $rspta->fetch_object();

//Establecemos los datos de la empresa
$numReg = "RFC:";
$nombreE = "PIZARRONES GUADALAJARA S.A. DE C.V.";
//$documento = "00000000000";
$direccion = "Calle Jose Guadalupe Zuno Hernández 1800";
$direccion2 = "Col. Americana, CP 44160 Guadalajara, Jalisco";
$telefono = "Tel: 500 01450";
$email = "ventas@pizarronesguadalajara.com";

?>
<div class="zona_impresion">
<!-- codigo imprimir -->
<br>
<table border="0" align="center" width="300px">
    <tr>
        <td align="center">
        <img src="logo_pg.jpg" width="200" height="36"><br><br>
        <!-- Mostramos los datos de la empresa en el documento HTML -->
        .::<strong> <?php echo $nombreE; ?></strong>::.<br>
        <?php echo $numReg; ?><br>
        <?php echo $direccion; ?><br>
        <?php echo $direccion2 ?><br>
        <br>
        <br>
        </td>
    </tr>
    <tr>
        <td>Fecha de pago: <?php echo $reg->fecha_hora; ?></td>
    </tr>
    <tr>
      <td align="center"></td>
    </tr>
    <tr>
        <td>Folio: <?php echo $reg->idventa; ?></td>
    </tr><br><br>
     <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td>No. Cliente: <?php echo $reg->no_cliente; ?></td>
    </tr>
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td>Nombre: <?php echo $reg->nom_cliente; ?></td>
    </tr>
     
    
    
    
</table>
<br>
<!-- Mostramos los detalles de la venta en el documento HTML -->
<table border="0" align="center" width="100px">
    <tr>
        <td>CANT.</td>
        <td>DESCRIPCIÓN</td>
        <td align="right">IMPORTE</td>
    </tr>
    <tr>
      <td colspan="3">==========================================</td>
    </tr>
    <?php
    $rsptad = $ventas->mostrar_list_venta($_GET["id"]);
    $cantidad=0;
    $subtotal=0;

    $descrip_tick="";
    $meses_tick="";
    $descrip_gen="";

    while ($regd = $rsptad->fetch_object()) {
        echo "<tr>";
        echo "<td>".$regd->cantidad."</td>";
        //echo "<td colspan='1'>".$regd->pago."-".$regd->esp."-".$regd->mes1."-".$regd->mes2."</td>";
        echo "<td colspan='1'>".$regd->descripcion."</td>";
        echo "<td align='right'>$ ".$regd->subtotal."</td>";
        echo "</tr>";

        $cantidad+=$regd->cantidad;
        $subtotal+=$regd->subtotal;
    }
    ?>
    <!-- Mostramos los totales de la venta en el documento HTML -->

    <tr>
    <td>&nbsp;</td>
    <td align="right"><b>TOTAL:</b></td>
    <td align="right"><b>$ <?php echo $subtotal;  ?></b></td>
    </tr>

    <tr>
      <td colspan="3">Nº de articulos: <?php echo $cantidad; ?></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>      
    <tr>
      <td colspan="3" align="center">¡Gracias por su preferencia!<br>
        <?php echo $telefono ?><br>
        <?php echo $email ?><br>
      </td>
    </tr>
    <!--<tr>
      <td colspan="3" align="center">En caso de incremento en el monto de la cuota de mantenimiento, se generará automaticamente un cargo por la diferencia en los pagos adelantados a partir de la fecha de aplicación</td>
    </tr>-->
    <tr>
      <td colspan="3" align="center"></td>
    </tr>
    
</table>

<div align="center">
    
    <a href="#" onclick="window.print();">Imprimir</a>
</div>


<br>
</div>
<p>&nbsp;</p>

</body>
</html>
<?php 
}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>