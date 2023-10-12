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
    require_once "../modelos/Saldos.php";
    $saldos= new Saldos();


    //$id2=$_GET['id2'];
    //En el objeto $rspta Obtenemos los valores devueltos del método ventacabecera del modelo
    $rspta = $saldos->consulta_pedido($_GET["id"]);
    //Recorremos todos los valores obtenidos
    $reg = $rspta->fetch_object();

    //Establecemos los datos de la empresa
   // $numReg = "RFC:";
    $nombreE = "PEDIDO (SALDOS)";
    //$documento = "00000000000";
   // $direccion = "Calle Jose Guadalupe Zuno Hernández 1800";
    //$direccion2 = "Col. Americana, CP 44160 Guadalajara, Jalisco";
    //$telefono = "Tel: 500 01450";
   // $email = "ventas@pizarronesguadalajara.com";
       

    ?>

<div class="zona_impresion">
<!-- codigo imprimir -->
<br>
<img src="logo_pg.jpg" width="200" height="36"><br><br>
<table border="0" align="center" width="750px">
    
    
    <tr>
        <td align="left" width="50%"><h2><strong> <?php echo $nombreE; ?></strong></h2></td>       
        <td width="50%" align="right">Area: Ventas / Codigo: FO-PG-VT-01</td>
    </tr>

    
   
</table>
<style type="text/css">
    
    td.margenes{
        padding: 3px 3px 3px 3px;
        border-color: white;
    }

    td.fondo{
        background: #D5DED7;
    }

</style>

<table border="1" align="center" width="750px" id="tabla2" style="border-color: white;">
    
    <tr>
        <td class="margenes fondo">Fecha de pedido</td>
        <td class="margenes fondo">Cliente</td>
        <td class="margenes fondo">No. Pedido</td>
        <td class="margenes fondo">Condiciones</td>
        <td class="margenes fondo">No. Control</td>
    </tr>
    <tr>
        <td class="margenes"><?php echo $reg->fecha_pedido; ?></td>
        <td class="margenes">AJM</td>
        <td class="margenes"><?php echo $reg->no_pedido; ?></td>
        <td class="margenes"></td>
        <td class="margenes"></td>
    </tr>
    
</table>

<table border="1" align="center" width="750px" id="tabla2" style="border-color: white;">
    
    <tr>
        <td class="margenes fondo">Asesor:</td>        
        <td class="margenes fondo">Levanto Pedido</td>       
        <td class="margenes fondo">Cliente Nuevo:</td>       
        <td class="margenes fondo">Medio:</td>        
        <td class="margenes fondo">LAB:</td>       
        <td class="margenes fondo">Autorización Ejecutivo de Ventas:</td>       
    </tr>
    <tr>
        <td class="margenes">Ventas AJM</td>
        <td class="margenes">Ventas AJM</td>
        <td class="margenes"></td>
        <td class="margenes"></td>
        <td class="margenes"></td>
        <td class="margenes">Angelina Durán</td>
    </tr>
    
</table>

<table border="1" align="center" width="750px" id="tabla2" style="border-color: white;">
    <tr align="center">
        <td colspan="10" class="margenes fondo">DATOS DE FACTURACIÓN</td>
    </tr>
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td width="10%" class="margenes fondo">Nombre:</td>
        <td width="60%" class="margenes" colspan="6"><?php echo $reg->razon; ?></td>
        <td width="10%" class="margenes fondo">RFC: </td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->rfc; ?></td>

    </tr>
    <tr>
        <td width="10%" class="margenes fondo">Domicilio</td>
        <td width="60%" class="margenes" colspan="6"><?php echo $reg->calle; ?></td>
        <td width="10%" class="margenes fondo">Colonia</td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->colonia; ?></td>
        
    </tr>
    <tr>
        <td width="10%" class="margenes fondo">Ciudad</td>
        <td width="20%" class="margenes" colspan="3"><?php echo $reg->ciudad; ?></td>
        <td width="10%" class="margenes fondo">Estado</td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->estado; ?></td>
        <td width="10%" class="margenes fondo">C.P.: </td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->cp; ?></td>
    </tr>
    <tr>
        
        <td class="margenes fondo">Teléfono</td>
        <td class="margenes" colspan="4"><?php echo $reg->telefono; ?></td>
        <td class="margenes fondo">E-mail:</td>
        <td class="margenes" colspan="4"><?php echo $reg->email; ?></td>

    </tr>
    <tr align="center">
        <td class="margenes fondo" colspan="10">DATOS DE ENTREGA</td> 
    </tr>
    <tr>
        <td width="10%" class="margenes fondo">Contacto:</td>
        <td width="60%" class="margenes" colspan="6"><?php echo $reg->contacto_s; ?></td>
        <td width="10%" class="margenes fondo">Teléfono: </td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->telefono_s; ?></td>
    </tr>
    <tr>
        <td width="10%" class="margenes fondo">Domicilio</td>
        <td width="60%" class="margenes" colspan="6"><?php echo $reg->calle_s; ?></td>
        <td width="10%" class="margenes fondo">Colonia</td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->colonia_s; ?></td>
    </tr>
    <tr>
        <td width="10%" class="margenes fondo">Ciudad</td>
        <td width="20%" class="margenes" colspan="3"><?php echo $reg->ciudad_s; ?></td>
        <td width="10%" class="margenes fondo">Estado</td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->estado_s; ?></td>
        <td width="10%" class="margenes fondo">C.P.: </td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->cp_s; ?></td>
    </tr>
    <tr>
        
        <td width="10%" class="margenes fondo">Fecha de entrega</td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->fecha_entrega; ?></td>
        <td width="10%" class="margenes fondo">Horario de entrega:</td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->hora_entrega1; ?> - <?php echo $reg->hora_entrega2; ?></td>
        <td width="10%" class="margenes fondo">Forma de entrega:</td>
        <td width="30%" class="margenes" colspan="3"><?php echo $reg->forma_entrega; ?></td>
        

    </tr>
    <tr>
        <td width="10%" class="margenes fondo">Detalles de entrega:</td>
        <td width="40%" class="margenes" colspan="3"><?php echo $reg->detalle_forma; ?></td>
        <td width="10%" class="margenes fondo">Empaque:</td>
        <td width="40%" class="margenes" colspan="6"></td>
    </tr>
    
</table>




<table border="1" align="center" width="750px" style="border-color: white;" id="tbl_productos">
    <tr align="center">
        <td colspan="10" class="margenes fondo">PRODUCTOS</td>
    </tr>
    <tr align="center">
        <td class="margenes fondo" width="10%">Cant.</td>
       
        <td class="margenes fondo" width="20%">Código</td>
        
        <td class="margenes fondo" width="30%" colspan="2">Detalle</td>
       
        
        <td class="margenes fondo" width="20%">Precio</td>
       
        <td class="margenes fondo" width="20%">Importe</td>
    </tr>
    
    <?php

    //$id2=$_GET['id2'];



    $rsptad = $saldos->detalle_pedido($_GET["id"]);
    $cantidad=0;
    $subtotal=0;
    $iva=0;
    $observaciones="";
    $total=0;
    $importe=0;

        
    


        while ($regd = $rsptad->fetch_object()) {

            //$importe = $regd->precio * $regd->importe;

            echo "<tr>";
            echo "<td class='margenes'>".$regd->cantidad."</td>";
            
            echo "<td class='margenes'>".$regd->codigo."</td>";
           
            echo "<td class='margenes' colspan='2'><small>".$regd->detalle."</small></td>";
            
            echo "<td class='margenes' align='right'>$ ".$regd->precio."</td>";
         
            echo "<td class='margenes' align='right'>$ ".$importe."</td>";
            echo "</tr>";

            $subtotal = $subtotal + $regd->precio;

            $total = $subtotal + $iva;

            
        }

    
        
        
    ?>

    <tr>
        <td width="70%" class="margenes fondo" colspan="4">CAMBIOS DE ESPECIFICACIÓN TÉCNICA SOLICITADOS/OBSERVACIONES</td>
        <td width="15%" class="margenes fondo">Subtotal</td>
        <td width="15%" class="margenes" align="right">$ <?php echo $subtotal;  ?></td>
    </tr>
    <tr>
        <td width="70%" class="margenes" colspan="4" rowspan="2"><?php echo $observaciones;  ?></td>        
        <td width="15%" class="margenes fondo">IVA 16%</td>
        <td width="15%" class="margenes" align="right">$ <?php echo $iva;  ?></td>
    </tr>
    <tr>
        
        <td class="margenes fondo">Total </td>
        <td class="margenes" align="right">$ <?php echo $total;  ?></td>
    </tr>


</table>
<!-- Mostramos los detalles de la venta en el documento HTML -->




<table border="1" align="center" width="750px" style="border-color: white;" id="tbl_observ">
    


  

                <tr>
                    <td width="20%" class="margenes fondo" colspan="2">IMPORTE CON LETRA</td>
                    <td width="80%" class="margenes" colspan="8"></td>
                    
                </tr>


  

     
    
</table>

    <?php

    //Incluímos la clase Venta
    require_once "../modelos/Diseno.php";
    $diseno= new Diseno();
    //En el objeto $rspta Obtenemos los valores devueltos del método ventacabecera del modelo
    $rspta = $saldos->consulta_pedido($_GET["id"]);
    //Recorremos todos los valores obtenidos
    $reg = $rspta->fetch_object();

    ?>

<table border="1" align="center" width="750px" style="border-color: white;">
    <tr>
        <td class="margenes fondo" colspan="5">Requisitos legales y reglamentarios aplicables</td>
        <td class="margenes" colspan="5"></td>
    </tr>
    
    <tr>
        <td class="margenes fondo" colspan="2" width="20%">Metodo:</td>
        <td class="margenes" colspan="2" width="20%"></td>
        <td class="margenes fondo" colspan="2" width="20%">Forma de pago:</td>
        <td class="margenes" colspan="3" width="30%"></td>
    </tr>
    <tr>
        <td class="margenes fondo" colspan="2">Uso de CFDI:</td>
        <td class="margenes" colspan="8"></td>
    </tr>
    <tr align="center">
        <td class="margenes fondo" colspan="3">Enviado a Enlace</td>
        <td class="margenes fondo" colspan="2">Salida</td>
        <td class="margenes fondo" colspan="2">Factura</td>
        <td class="margenes fondo" colspan="2">Otros</td>
    </tr>
    <tr>
      <td class="margenes" colspan="3" height="20px"></td>
      <td class="margenes" colspan="2"></td>
      <td class="margenes" colspan="2"></td>
      <td class="margenes" colspan="2"></td>
    </tr>      
    
    <tr>
        <td width="10%" class="margenes fondo" >Revisó:</td>
        <td width="30%" class="margenes fondo" colspan="3">Nombre y firma del cliente</td>
        <td width="30%" class="margenes fondo" colspan="3">Nombre y firma de producción</td>
        <td width="30%" class="margenes" colspan="3" rowspan="2">Se entrega en planta baja, a pie de calle, sin responsabilidad para la empresa</td>
        
    </tr>
    <tr>
        <td class="margenes" height="20px"></td>
        <td class="margenes" colspan="3"></td>
        <td class="margenes" colspan="3"></td>
        
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