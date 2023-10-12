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
    require_once "../modelos/Almacen_pt.php";

    $almacen_pt = new Almacen_pt();

       

    ?>

<div class="zona_impresion">
<!-- codigo imprimir -->
<br>
<img src="logo_pg.jpg" width="200" height="36"><br><br>
<table border="0" align="center" width="750px">
    
    
    <tr>
        <td align="left" width="50%"><h2><strong>Validación de avances</strong></h2></td>       
        <td width="50%" align="right">Producto terminado</td>
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

            <table border="1" align="center" width="750px" style="border-color: white;" id="tbl_productos">

               
                <tr align="center">
                    <td class="margenes fondo" width="15%">Área.</td>
                    <td class="margenes fondo" width="40%">Producto</td>
                    
                    
                    <td class="margenes fondo" width="5%">Cantidad</td>
                    <td class="margenes fondo" width="5%">Total OP</td>
                    <td class="margenes fondo" width="5%">Avance</td>
                    <td class="margenes fondo" width="5%">No. control</td>
                    <td class="margenes fondo" width="5%">No. OP</td>
                    <td class="margenes fondo" width="10%">Lote</td>
                    <td class="margenes fondo" width="10%">Fecha de registro</td>
                    
                </tr>


    
                <?php

                $rsptad = $almacen_pt->abrir_terminados();

               
                    
                    while ($regd = $rsptad->fetch_object()) {


                        /*if ($regd->cant_exc==null OR $regd->cant_exc=="") {
                            $cant_exc = 0;
                        }elseif ($regd->cant_exc>0) {
                            $cant_exc = $regd->cant_exc;
                        }

                        if ($regd->ultimo_avance=='' OR $regd->ultimo_avance==null) {
                            $ultimo_avance=0;
                        }elseif ($regd->ultimo_avance>=0) {
                            $ultimo_avance=$regd->ultimo_avance;
                        }
                        
                        $cantidad_total = ($regd->avance+$cant_exc)-$ultimo_avance;*/



                        echo "<tr>";
                        echo "<td class='margenes'>".$regd->nom_area."</td>";
                        echo "<td class='margenes'>
                        ".$regd->codigo."<br>
                        <b>".$regd->descripcion."</b><br>
                        Medidas: ".$regd->medida." Color: ".$regd->color."
                        </td>";
                        
                        //echo "<td colspan='1'>".$regd->pago."-".$regd->esp."-".$regd->mes1."-".$regd->mes2."</td>";
                        
                        echo "<td class='margenes' align='center'><b><h1>".$regd->cant_capt."</h1></b></td>";
                        echo "<td class='margenes' align='center'>".$regd->cant_tot."</td>";
                        echo "<td class='margenes' align='center'>".$regd->avance."</td>";
                        echo "<td class='margenes' align='center'>".$regd->no_control."</td>";
                        echo "<td class='margenes' align='center'>".$regd->no_op."</td>";
                        echo "<td class='margenes'>".$regd->lote."</td>";
                        echo "<td class='margenes'>".$regd->fecha_hora."</td>";
                        
                        echo "</tr>";

                        
                    }
                    
                

                    
                ?>
            </table>
<div>
    <hr width="100%">
</div>

<table border="0" align="center" width="750px">
    
    
    <tr>
        <td align="left" width="50%"><h2><strong>Validación de excedentes</strong></h2></td>       
        <td width="50%" align="right">Producto terminado</td>
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

            <table border="1" align="center" width="750px" style="border-color: white;" id="tbl_productos">

               
                <tr align="center">
                    <td class="margenes fondo" width="15%">Área.</td>
                    <td class="margenes fondo" width="40%">Producto</td>
                    
                    
                    <td class="margenes fondo" width="5%">Cantidad</td>
                    <td class="margenes fondo" width="5%">Total OP</td>
                    
                    <td class="margenes fondo" width="5%">No. control</td>
                    <td class="margenes fondo" width="5%">No. OP</td>
                    <td class="margenes fondo" width="10%">Lote</td>
                    <td class="margenes fondo" width="10%">Fecha de registro</td>
                    
                </tr>


    
                <?php

                $rsptad = $almacen_pt->abrir_excedentes();

               
                    
                    while ($regd = $rsptad->fetch_object()) {


                        /*if ($regd->cant_exc==null OR $regd->cant_exc=="") {
                            $cant_exc = 0;
                        }elseif ($regd->cant_exc>0) {
                            $cant_exc = $regd->cant_exc;
                        }

                        if ($regd->ultimo_avance=='' OR $regd->ultimo_avance==null) {
                            $ultimo_avance=0;
                        }elseif ($regd->ultimo_avance>=0) {
                            $ultimo_avance=$regd->ultimo_avance;
                        }
                        
                        $cantidad_total = ($regd->avance+$cant_exc)-$ultimo_avance;*/



                        echo "<tr>";
                        echo "<td class='margenes'>".$regd->nom_area."</td>";
                        echo "<td class='margenes'>
                        ".$regd->codigo."<br>
                        <b>".$regd->descripcion."</b><br>
                        Medidas: ".$regd->medida." Color: ".$regd->color."
                        </td>";
                        
                        //echo "<td colspan='1'>".$regd->pago."-".$regd->esp."-".$regd->mes1."-".$regd->mes2."</td>";
                        
                        echo "<td class='margenes' align='center'><b><h1>".$regd->cantidad."</h1></b></td>";
                        echo "<td class='margenes' align='center'>".$regd->cant_tot."</td>";
                        
                        echo "<td class='margenes' align='center'>".$regd->no_control."</td>";
                        echo "<td class='margenes' align='center'>".$regd->no_op."</td>";
                        echo "<td class='margenes'>".$regd->lote."</td>";
                        echo "<td class='margenes'>".$regd->fecha_hora."</td>";
                        
                        echo "</tr>";

                        
                    }
                    
                

                    
                ?>
            </table>
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