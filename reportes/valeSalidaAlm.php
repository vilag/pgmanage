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
if ($_SESSION['Produccion']==1 || $_SESSION['administrador']==1 || $_SESSION['Administrativo']==1)
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
    $rspta = $diseno->consulta_vale_alm($_GET['id'],$_GET['idusuario']);
    //Recorremos todos los valores obtenidos
    $reg = $rspta->fetch_object();


    ?>

<div class="zona_impresion">
<table border="0" align="center" width="750px">
    
    
    <tr>
        <td><img src="logo_pg.jpg" width="150" height="28"></td>
        <td align="center" width="50%" style="font-size: 15px;"><strong>Entradas y Salidas de Almacén</strong></td>       
        <td width="50%" align="right">ÁREA: ALMACÉN / CODIGO: FO-PG-AL-01</td>
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


            
            <table border="1" align="center" width="750px" style="border-color: grey;" id="">

               
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
                    <td class="margenes" width="20%" align="center">E<?php echo $reg->no_vale; ?></td> 
                    
                </tr>

            </table>

            <table border="1" align="center" width="750px" style="border-color: grey;" id="">

               
                <tr align="center">
                    <td class="margenes fondo" width="30%">Fecha de Solicitud</td>
                    <td class="margenes fondo" width="30%">Nombre</td>  
                    <td class="margenes fondo" width="40%">Área</td>                  
                    
                </tr>
                <tr>

                    <td class="margenes" width="" align="center"><?php echo $reg->fecha_hora_solic; ?></td>
                    <td class="margenes" width="" align="center"><?php echo $reg->nombre_completo; ?></td>  
                    <td class="margenes" width="" align="center"><?php echo $reg->area; ?></td>
                 
                    
                </tr>

            </table>

            

            <table border="1" align="center" width="750px" style="border-color: grey;" id="">

               
                <tr align="center">
                 
                    <td class="margenes fondo" width="10%">Cant.</td>
                    
                    <td class="margenes fondo" width="30%">Descripción</td>
                    
                    <td class="margenes fondo" width="10%">Control</td>
                    <td class="margenes fondo" width="10%">Lote - OP</td>
                    
                    <td class="margenes fondo" width="5%">Surtido</td>
                    <td class="margenes fondo" width="5%">Registrado</td>
                                    
                    
                </tr>
                <?php

                $rsptad = $diseno->listar_productos_vale($_GET['id']);

               
                    
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


                        $idvale_salida = $regd->idvale_salida;


                        echo "<tr>";
                       
                        echo "<td class='margenes' align='center'>".$regd->cantidad."</td>";
                       
                        echo "<td class='margenes'>
                        
                        CODIGO: ".$regd->codigo."<br>".$regd->descripcion.$medida.$color."
                        
                        </td>";
                        echo "<td class='margenes' align='center'>".$regd->control."</td>";

                        echo "
                            <td class='margenes' align='center'>
                        ";

                            $rsptad2 = $diseno->listar_lotes_vale_alm($idvale_salida);
                            while ($regd2 = $rsptad2->fetch_object()) {

                                echo "
                                    ".$regd2->lote."(".$regd2->cantidad.") - ".$regd2->op." <br>
                                ";    

                            }

                        echo "
                            </td>
                        ";
                        //echo "<td colspan='1'>".$regd->pago."-".$regd->esp."-".$regd->mes1."-".$regd->mes2."</td>";
                        
                        
                        echo "<td class='margenes' align='center'></td>";
                        echo "<td class='margenes' align='center'></td>";
                        
                        
                        echo "</tr>";

                        
                    }
                    
                

                    
                ?>

            </table>
            <br>
            <br>
            

            <table border="0" align="center" width="750px" style="border-color: white;  " id="">
    
                <tr style="align-content: center; text-align: center;">
                   <td colspan="3">Quién autoriza</td>
                   <td colspan="3">Quién recibe</td>
                   <td colspan="3">Quién entrega</td> 
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