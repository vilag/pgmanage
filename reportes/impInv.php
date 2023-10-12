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
        <td align="left" width="50%"><h2><strong>Inventario</strong></h2></td>       
        <td width="50%" align="right">Almacén de producto terminado</td>
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
                    <td class="margenes fondo" width="20%">Codigo.</td>
                    <td class="margenes fondo" width="40%">Descripción</td>
                    <td class="margenes fondo" width="20%">Medidas</td>
                    <td class="margenes fondo" width="10%">Color</td>
                  
                    <td class="margenes fondo" width="10%">Cantidad</td>
                   
                </tr>


    
                <?php

                $rsptad = $almacen_pt->listar_inventario();

               
                    
                    while ($regd = $rsptad->fetch_object()) {

                        $entradas = $regd->cant_entrada;
						$salidas = $regd->cant_salida;

						$existencia = $entradas - $salidas;


                        echo "<tr>";
                        echo "<td class='margenes'>".$regd->codigo."</td>";
                        echo "<td class='margenes'>".$regd->nombre."</td>";
                        echo "<td class='margenes'>".$regd->medidas."</td>";
                        echo "<td class='margenes'>".$regd->color."</td>";
                       
                        echo "<td class='margenes'>".$existencia."</td>";
                       
                        
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