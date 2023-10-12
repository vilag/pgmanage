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
if ($_SESSION['Produccion']==1 || $_SESSION['administrador']==1 || $_SESSION['Administrativo']==1 || $_SESSION['agente_ventas1']==1)
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

    $diseno=new Diseno();

      
    
    //En el objeto $rspta Obtenemos los valores devueltos del método ventacabecera del modelo
    $rspta = $diseno->listar_productos_new_todos($_GET['idsalida'],$_GET['nom_cliente_salida'],$_GET['domicilio_cliente_salida'],$_GET['contacto_cliente_salida'],$_GET['telefono_cliente_salida'],$_GET['horario_cliente_salida'],$_GET['condiciones_cliente_salida'],$_GET['medio_cliente_salida']);
    //Recorremos todos los valores obtenidos
    $reg = $rspta->fetch_object();


    ?>

<div class="zona_impresion">
<table border="0" align="center" width="750px">
    
    
    <tr>
        <td><img src="logo_pg.jpg" width="150" height="28"></td>
        <td align="center" width="50%" style="font-size: 15px;"><strong>Salida de Mercancia</strong></td>       
        <td width="50%" align="right">ÁREA: VENTAS / CODIGO: FO-PG-VT-09</td>
    </tr>

    
   
</table>
<style type="text/css">
    
    td.margenes{
        padding: 3px 3px 3px 3px;
        border-color: grey;
    }

    td.fondo{
        background: #D5DED7;
    }

</style>


            
            <!--<table border="1" align="center" width="750px" style="border-color: grey;" id="">

               
                <tr align="center">
                    <td class="margenes fondo" width="" style="font-size: 15px;">ENTRADA</td>
                    <td class="margenes fondo" width="" style="font-size: 15px;">SALIDA</td>  
                    <td class="margenes fondo" width="" style="font-size: 15px;">MP</td>
                    <td class="margenes fondo" width="" style="font-size: 15px;">PT</td>                    
                    <td class="margenes fondo" width="" style="font-size: 15px;">FOLIO</td>
                </tr>
                <tr>

                    <td class="margenes" width="20%"></td>
                    <td class="margenes" width="20%" align="center"><img src="../images/iconos/ok.png" width="10%"></td>  
                    <td class="margenes" width="20%"></td>
                    <td class="margenes" width="20%" align="center"><img src="../images/iconos/ok.png" width="10%"></td> 
                    <td class="margenes" width="20%"></td> 
                    
                </tr>

            </table>-->

            <table border="1" align="center" width="750px" style="border-color: grey;" id="">

               
                <tr align="center">
                    <td class="margenes fondo" width="30%">Fecha</td>
                    <td class="margenes fondo" width="30%">No. de Salida</td>  
                    <td class="margenes fondo" width="40%">No. Control - No. Pedido</td>                  
                    
                </tr>
                <tr>

                    <td class="margenes" width="" align="center"><?php echo $reg->fecha_salida; ?></td>
                    <td class="margenes" width="" align="center"><?php echo $reg->no_salida; ?></td>  
                    <td class="margenes" width="" align="center">
                        
                            
                <?php

                $rsptad = $diseno->listar_op_control_tot($_GET['idsalida']);

               
                    
                    while ($regd = $rsptad->fetch_object()) {


                        echo $regd->no_control." - ".$regd->no_pedido.", ";
                      

                        
                    }
                    
                

                    
                ?>

                    </td>
                 
                    
                </tr>

            </table>

            <table border="1" align="center" width="750px" style="border-color: grey;" id="">

               
                <tr align="center">
                    <td class="margenes fondo" width="30%">DATOS DEL CLIENTE</td>
                                                    
                </tr>
               
            </table>

            <table border="1" align="center" width="750px" style="border-color: grey;" id="">

               
                <!--<tr align="center">
                    <td class="margenes fondo" width="20%" style="text-align: left; font-size: 11px;">NOMBRE:</td>
                    <td class="margenes" width="30%"></td>
                    <td class="margenes fondo" width="20%" style="text-align: left; font-size: 11px;">ENTREGADO A:</td>
                    <td class="margenes" width="30%"></td>                   
                </tr>-->
                <tr align="center">
                    <td class="margenes fondo" style="text-align: left; font-size: 11px;" width="10%">CLIENTE:</td>
                    <td class="margenes" width="92%" colspan="5" style="text-align: left;"><?php echo $reg->nom; ?></td>
               
                                      
                </tr>
                <tr align="center">
                   
                    <td class="margenes fondo" style="text-align: left; font-size: 11px;" width="10%">DOMICILIO:</td>
                    <td class="margenes" width="92%" colspan="5" style="text-align: left;"><?php echo $reg->dom; ?></td>
                                      
                </tr>
                
                
                <tr align="center">
                    <td class="margenes fondo" style="text-align: left; font-size: 11px;" width="10%">CONTACTO</td>
                    <td class="margenes" width="40%"><?php echo $reg->contacto; ?></td>
                    <td class="margenes fondo" style="text-align: left; font-size: 11px;" width="5%">TEL.</td>
                    <td class="margenes"><?php echo $reg->tel; ?></td>
                    <td class="margenes fondo" style="text-align: left; font-size: 11px;" width="10%">HORARIO</td>
                    <td class="margenes"><?php echo $reg->horario; ?></td>                 
                </tr>
               

            </table>
            <table border="1" align="center" width="750px" style="border-color: grey;" id="">
                <tr align="center">
                    <td class="margenes fondo" style="text-align: left; font-size: 11px;" width="12%">CONDICIONES</td>
                    <td class="margenes" width="45%"><?php echo $reg->cond; ?></td> 
                    <td class="margenes fondo" style="text-align: left; font-size: 11px;" width="20%">MEDIO DE TRANSPORTE:</td>
                    <td class="margenes" colspan="3"><?php echo $reg->medio; ?></td>                   
                </tr>
            </table>
            <table border="1" align="center" width="750px" style="border-color: grey;" id="">

               
                <tr align="center">
                    <td class="margenes fondo">CANTIDAD:</td>
                    <td class="margenes fondo">CODIGO</td>
                    <td class="margenes fondo">DESCRIPCIÓN:</td>
                    <td class="margenes fondo">LOTE</td>                   
                </tr>
               
                <?php

                $rsptad = $diseno->listar_productos_solic_alm_2_tot($_GET['idsalida']);

               
                    
                    while ($regd = $rsptad->fetch_object()) {


                    
                        if ($regd->color=="") {
                            $color="";
                        }elseif ($regd->color<>"") {
                            $color=", Color: ".$regd->color;
                        }

                        if ($regd->medida=="") {
                            $medida="";
                        }elseif ($regd->medida<>"") {
                            $medida=", Medidas: ".$regd->medida;
                        }


                        echo "<tr>";
                        echo "<td class='margenes' align='center'>".$regd->cantidad."</td>";
                        echo "<td class='margenes' align='center'>".$regd->codigo."</td>";
                        
                        echo "<td class='margenes'>
                        
                        ".$regd->descripcion.$medida.$color."
                        
                        </td>";
                        
                        //echo "<td colspan='1'>".$regd->pago."-".$regd->esp."-".$regd->mes1."-".$regd->mes2."</td>";
                        
                       
                        echo "<td class='margenes' align='center'></td>";
                        
                        
                        
                        echo "</tr>";

                        
                    }
                    
                

                    
                ?>

            </table>
            <br>
            <br>
            

            <table border="0" align="center" width="750px" style="border-color: white;  " id="">
    
                <tr style="align-content: center; text-align: center;">
                   <td colspan="3">Nombre y firma de embarques</td>
                   <td colspan="3">Nombre y firma de chofer</td>
                   <td colspan="3">Nombre y firma de cliente</td> 
                </tr>
                <tr style="height: 30px;">
                    <td></td>
                    <td style="border-bottom: groove; width: 25%;"></td>
                    <td></td>

                    <td></td>
                    <td style="border-bottom: groove; width: 25%;"></td>
                    <td></td>

                    <td></td>
                    <td style="border-bottom: groove; width: 25%;"></td>
                    <td></td>
                </tr>
            </table>
            <br>
            <br>
<!-- Mostramos los detalles de la venta en el documento HTML -->




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