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
    require_once "../modelos/Diseno.php";
    $diseno= new Diseno();


    $id2=$_GET['id2'];
    //En el objeto $rspta Obtenemos los valores devueltos del método ventacabecera del modelo
    $rspta = $diseno->consulta_pedido($_GET["id"]);
    //Recorremos todos los valores obtenidos
    $reg = $rspta->fetch_object();

    //Establecemos los datos de la empresa
   // $numReg = "RFC:";
    $nombreE = "PEDIDO";
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
        <td class="margenes fondo">No. Cliente</td>
        <td class="margenes fondo">No. Pedido</td>
        <td class="margenes fondo">Condiciones</td>
        <td class="margenes fondo">No. Control</td>
    </tr>
    <tr>
        <td class="margenes"><?php echo $reg->fecha_pedido; ?></td>
        <td class="margenes"><?php echo $reg->no_cliente; ?></td>
        <td class="margenes"><?php echo $reg->no_pedido; ?></td>
        <td class="margenes"><?php echo $reg->condiciones; ?></td>
        <td class="margenes"><?php echo $reg->no_control; ?></td>
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
        <td class="margenes"><?php echo $reg->asesor; ?></td>
        <td class="margenes"><?php echo $reg->levanto_pedido; ?></td>
        <td class="margenes"><?php echo $reg->cliente_nuevo; ?></td>
        <td class="margenes"><?php echo $reg->medio; ?></td>
        <td class="margenes"><?php echo $reg->lab; ?></td>
        <td class="margenes"><?php echo $reg->autorizacion; ?></td>
    </tr>
    
</table>

<table border="1" align="center" width="750px" id="tabla2" style="border-color: white;">
    
    <tr>
        <td class="margenes fondo">Nombre del cliente</td>        
             
    </tr>
    <tr>
        <td class="margenes"><?php echo $reg->cliente_nom; ?></td>
        
    </tr>
    
</table>

<table border="1" align="center" width="750px" id="tabla2" style="border-color: white;">
    <tr align="center">
        <td colspan="10" class="margenes fondo">DATOS DE FACTURACIÓN</td>
    </tr>
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td width="10%" class="margenes fondo">Nombre:</td>
        <td width="60%" class="margenes" colspan="6"><?php echo $reg->razon_fac; ?></td>
        <td width="10%" class="margenes fondo">RFC: </td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->rfc_fac; ?></td>

    </tr>
    <tr>
        <td width="10%" class="margenes fondo">Domicilio</td>
        <td width="60%" class="margenes" colspan="6"><?php echo $reg->domicilio_fac; ?></td>
        <td width="10%" class="margenes fondo">Colonia</td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->colonia_fac; ?></td>
        
    </tr>
    <tr>
        <td width="10%" class="margenes fondo">Ciudad</td>
        <td width="20%" class="margenes" colspan="3"><?php echo $reg->ciudad_fac; ?></td>
        <td width="10%" class="margenes fondo">Estado</td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->estado_fac; ?></td>
        <td width="10%" class="margenes fondo">C.P.: </td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->cp_fac; ?></td>
    </tr>
    <tr>
        
        <td class="margenes fondo">Teléfono</td>
        <td class="margenes" colspan="4"><?php echo $reg->telefono_fac; ?></td>
        <td class="margenes fondo">E-mail:</td>
        <td class="margenes" colspan="4"><?php echo $reg->email_fac; ?></td>

    </tr>
    <tr align="center">
        <td class="margenes fondo" colspan="10">DATOS DE ENTREGA</td> 
    </tr>
    <tr>
        <td width="10%" class="margenes fondo">Contacto:</td>
        <td width="60%" class="margenes" colspan="6"><?php echo $reg->contacto_ent; ?></td>
        <td width="10%" class="margenes fondo">Teléfono: </td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->telefono_ent; ?></td>
    </tr>
    <tr>
        <td width="10%" class="margenes fondo">Domicilio</td>
        <td width="60%" class="margenes" colspan="6"><?php echo $reg->domicilio_ent; ?></td>
        <td width="10%" class="margenes fondo">Colonia</td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->colonia_ent; ?></td>
    </tr>
    <tr>
        <td width="10%" class="margenes fondo">Ciudad</td>
        <td width="20%" class="margenes" colspan="3"><?php echo $reg->ciudad_ent; ?></td>
        <td width="10%" class="margenes fondo">Estado</td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->estado_ent; ?></td>
        <td width="10%" class="margenes fondo">C.P.: </td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->cp_ent; ?></td>
    </tr>
    <tr>
        
        <td width="10%" class="margenes fondo">Fecha de entrega</td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->fecha_entrega_ent; ?></td>
        <td width="10%" class="margenes fondo">Horario de entrega:</td>
        <td width="20%" class="margenes" colspan="2"><?php echo $reg->horario_ent; ?></td>
        <td width="10%" class="margenes fondo">Forma de entrega:</td>
        <td width="30%" class="margenes" colspan="3"><?php echo $reg->forma_entrega_ent; ?></td>
        

    </tr>
    <tr>
        <td width="10%" class="margenes fondo">Detalles de entrega:</td>
        <td width="40%" class="margenes" colspan="3"><?php echo $reg->det_forma_entrega; ?></td>
        <td width="10%" class="margenes fondo">Empaque:</td>
        <td width="40%" class="margenes" colspan="6"><?php echo $reg->empaque; ?></td>
    </tr>
    
</table>

<?php 
    // $id2==4 OR $id2==5 OR $id2==8 OR $id2==10
    if ($id2==0) {
        
        echo '

            <table border="1" align="center" width="750px" style="border-color: white;" id="tbl_productos">

                <tr align="center">
                    <td colspan="10" class="margenes fondo">PRODUCTOS</td>
                </tr>
                <tr align="center">
                    <td class="margenes fondo" width="7%">Cant.</td>
                    <td class="margenes fondo" width="8%">Unidad</td>
                    <td class="margenes fondo" width="10%">Código</td>
                    <td class="margenes fondo" width="10%">Medida</td>
                    <td class="margenes fondo" width="15%" colspan="2">Descripción</td>
                    <td class="margenes fondo" width="10%" colspan="2">Observación</td>
                    <td class="margenes fondo" width="10%">Color</td>
                    
                </tr>

            


        ';
    }else{

        echo '

            <table border="1" align="center" width="750px" style="border-color: white;" id="tbl_productos">

                <tr align="center">
                    <td colspan="10" class="margenes fondo">PRODUCTOS</td>
                </tr>
                <tr align="center">
                    <td class="margenes fondo" width="7%">Cant.</td>
                    <td class="margenes fondo" width="8%">Unidad</td>
                    <td class="margenes fondo" width="10%">Código</td>
                    <td class="margenes fondo" width="10%">Medida</td>
                    <td class="margenes fondo" width="15%" colspan="2">Descripción</td>
                    <td class="margenes fondo" width="10%" colspan="2">Observación</td>
                    <td class="margenes fondo" width="10%">Color</td>
                    <td class="margenes fondo" width="10%">Precio</td>
                    <td class="margenes fondo" width="10%">Desc.</td>
                    <td class="margenes fondo" width="10%">Importe</td>
                </tr>

            


        ';
    }



 ?>  


<!--<table border="1" align="center" width="750px" style="border-color: white;" id="tbl_productos">
    <tr align="center">
        <td colspan="10" class="margenes fondo">PRODUCTOS</td>
    </tr>
    <tr align="center">
        <td class="margenes fondo" width="7%">Cant.</td>
        <td class="margenes fondo" width="8%">Unidad</td>
        <td class="margenes fondo" width="10%">Código</td>
        <td class="margenes fondo" width="10%">Medida</td>
        <td class="margenes fondo" width="15%" colspan="2">Descripción</td>
        <td class="margenes fondo" width="10%" colspan="2">Observación</td>
        <td class="margenes fondo" width="10%">Color</td>
        <td class="margenes fondo" width="10%">Precio</td>
        <td class="margenes fondo" width="10%">Desc.</td>
        <td class="margenes fondo" width="10%">Importe</td>
    </tr>-->
    
    <?php

    $id2=$_GET['id2'];



    $rsptad = $diseno->detalle_pedido($_GET["id"]);
    $cantidad=0;
    $subtotal=0;

    // $id2==4 OR $id2==5 OR $id2==8 OR $id2==10
    if ($id2==0) {
        
        while ($regd = $rsptad->fetch_object()) {
            echo "<tr>";
            echo "<td class='margenes'>".$regd->cantidad."</td>";
            echo "<td class='margenes'>".$regd->unidad."</td>";
            echo "<td class='margenes'>".$regd->codigo."</td>";
            echo "<td class='margenes'>".$regd->medida."</td>";
            //echo "<td colspan='1'>".$regd->pago."-".$regd->esp."-".$regd->mes1."-".$regd->mes2."</td>";
            echo "<td class='margenes' colspan='2'><small>".$regd->descripcion."</small></td>";
            echo "<td class='margenes' colspan='2'>".$regd->observacion."</td>";
            echo "<td class='margenes'>".$regd->color."</td>";
            
            echo "</tr>";

            
        }
        
    }else{


        while ($regd = $rsptad->fetch_object()) {
            echo "<tr>";
            echo "<td class='margenes'>".$regd->cantidad."</td>";
            echo "<td class='margenes'>".$regd->unidad."</td>";
            echo "<td class='margenes'>".$regd->codigo."</td>";
            echo "<td class='margenes'>".$regd->medida."</td>";
            //echo "<td colspan='1'>".$regd->pago."-".$regd->esp."-".$regd->mes1."-".$regd->mes2."</td>";
            echo "<td class='margenes' colspan='2'><small>".$regd->descripcion."</small></td>";
            echo "<td class='margenes' colspan='2'>".$regd->observacion."</td>";
            echo "<td class='margenes'>".$regd->color."</td>";
            echo "<td class='margenes' align='right'>$ ".$regd->precio."</td>";
            echo "<td class='margenes' align='right'>$ ".$regd->descuento_cant."</td>";
            echo "<td class='margenes' align='right'>$ ".$regd->importe."</td>";
            echo "</tr>";

            
        }

    }

        
    ?>
</table>
<!-- Mostramos los detalles de la venta en el documento HTML -->


<?php
    // $id2==4 OR $id2==5 OR $id2==8 OR $id2==10
    if ($id2==0)

    {

        echo '

            <table border="1" align="center" width="750px" style="border-color: white;" id="tbl_observ">
    
                <!-- Mostramos los totales de la venta en el documento HTML -->
                
                <tr>
                    <td width="70%" class="margenes fondo" colspan="10">CAMBIOS DE ESPECIFICACIÓN TÉCNICA SOLICITADOS/OBSERVACIONES</td>
                    
                </tr>
                <tr height="50px;">
                    <td width="70%" class="margenes" colspan="10" rowspan="2">'.$reg->observaciones.'</td>        
                    
                </tr>

        ';

    }else{


        echo '


            <table border="1" align="center" width="750px" style="border-color: white;" id="tbl_observ">
    
                <!-- Mostramos los totales de la venta en el documento HTML -->
                
                <tr>
                    <td width="70%" class="margenes fondo" colspan="8">CAMBIOS DE ESPECIFICACIÓN TÉCNICA SOLICITADOS/OBSERVACIONES</td>
                    <td width="15%" class="margenes fondo">Subtotal</td>
                    <td width="15%" class="margenes" align="right">$ '.$reg->subtotal.'</td>
                </tr>
                <tr>
                    <td width="70%" class="margenes" colspan="8" rowspan="2">'.$reg->observaciones.'</td>        
                    <td width="15%" class="margenes fondo">IVA 16%</td>
                    <td width="15%" class="margenes" align="right">$ '.$reg->iva.'</td>
                </tr>
                <tr>
                    
                    <td class="margenes fondo">Total </td>
                    <td class="margenes" align="right">$ '.$reg->total.'</td>
                </tr>


        ';

    }

?>


<!--<table border="1" align="center" width="750px" style="border-color: white;" id="tbl_observ">
    
     Mostramos los totales de la venta en el documento HTML -->
    
    <!--<tr>
        <td width="70%" class="margenes fondo" colspan="8">CAMBIOS DE ESPECIFICACIÓN TÉCNICA SOLICITADOS/OBSERVACIONES</td>
        <td width="15%" class="margenes fondo">Subtotal</td>
        <td width="15%" class="margenes" align="right">$ <?php //echo $reg->subtotal;  ?></td>
    </tr>
    <tr>
        <td width="70%" class="margenes" colspan="8" rowspan="2"><?php //echo $reg->observaciones;  ?></td>        
        <td width="15%" class="margenes fondo">IVA 16%</td>
        <td width="15%" class="margenes" align="right">$ <?php //echo $reg->iva;  ?></td>
    </tr>
    <tr>
        
        <td class="margenes fondo">Total </td>
        <td class="margenes" align="right">$ <?php //echo $reg->total;  ?></td>
    </tr>-->

    <?php

    //Convertimos el total en letras
    require_once "Letras.php";
    $V=new EnLetras(); 
    $con_letra=strtoupper($V->ValorEnLetras($reg->total,"PESOS"));
    //$pdf->addCadreTVAs("---".$con_letra);
    ?>

    <?php
        // $id2==4 OR $id2==5 OR $id2==8 OR $id2==10
        if ($id2==0) {
            # code...
        }else{


            echo '

                <tr>
                    <td width="20%" class="margenes fondo" colspan="2">IMPORTE CON LETRA</td>
                    <td width="80%" class="margenes" colspan="8">('.$con_letra.')</td>
                    
                </tr>


            ';
        }


    ?>

     
    
</table>

    <?php

    //Incluímos la clase Venta
    require_once "../modelos/Diseno.php";
    $diseno= new Diseno();
    //En el objeto $rspta Obtenemos los valores devueltos del método ventacabecera del modelo
    $rspta = $diseno->consulta_pedido($_GET["id"]);
    //Recorremos todos los valores obtenidos
    $reg = $rspta->fetch_object();

    ?>

<table border="1" align="center" width="750px" style="border-color: white;">
    <tr>
        <td class="margenes fondo" colspan="5">Requisitos legales y reglamentarios aplicables</td>
        <td class="margenes" colspan="5"><?php echo $reg->reglamentos; ?></td>
    </tr>
    
    <tr>
        <td class="margenes fondo" colspan="2" width="20%">Metodo:</td>
        <td class="margenes" colspan="2" width="20%"><?php echo $reg->metodo_pago; ?></td>
        <td class="margenes fondo" colspan="2" width="20%">Forma de pago:</td>
        <td class="margenes" colspan="3" width="30%"><?php echo $reg->forma_pago; ?></td>
    </tr>
    <tr>
        <td class="margenes fondo" colspan="2">Uso de CFDI:</td>
        <td class="margenes" colspan="8"><?php echo $reg->uso_cfdi; ?></td>
    </tr>
    <tr align="center">
        <td class="margenes fondo" colspan="3">Enviado a Enlace</td>
        <td class="margenes fondo" colspan="2">Salida</td>
        <td class="margenes fondo" colspan="2">Factura</td>
        <td class="margenes fondo" colspan="2">Otros</td>
    </tr>
    <tr>
      <td class="margenes" colspan="3"><?php echo $reg->fecha_envio_enlace; ?></td>
      <td class="margenes" colspan="2"><?php echo $reg->salida; ?></td>
      <td class="margenes" colspan="2"><?php echo $reg->factura; ?></td>
      <td class="margenes" colspan="2"><?php echo $reg->otros; ?></td>
    </tr>      
    
    <tr>
        <td width="10%" class="margenes fondo">Revisó:</td>
        <td width="30%" class="margenes fondo" colspan="3">Nombre y firma del cliente</td>
        <td width="30%" class="margenes fondo" colspan="3">Nombre y firma de producción</td>
        <td width="30%" class="margenes" colspan="3" rowspan="2">Se entrega en planta baja, a pie de calle, sin responsabilidad para la empresa</td>
        
    </tr>
    <tr>
        <td class="margenes"><?php echo $reg->reviso; ?></td>
        <td class="margenes" colspan="3"><?php echo $reg->firma_cliente; ?></td>
        <td class="margenes" colspan="3"><?php echo $reg->firma_prod; ?></td>
        
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