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
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1 )
{
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../public/css/ticket.css" rel="stylesheet" type="text/css">
</head>
<body onload="ocultar_hoja();">

           
    <?php

    //Incluímos la clase Venta
    require_once "../modelos/Op.php";
    $opr = new Opr();


    //En el objeto $rspta Obtenemos los valores devueltos del método ventacabecera del modelo
    $rspta = $opr->consul_op_detalle($_GET['id']);
    //Recorremos todos los valores obtenidos
    $reg = $rspta->fetch_object();

    //Establecemos los datos de la empresa
   // $numReg = "RFC:";
    $nombreE = "ORDEN DE PRODUCCIÓN";


                         if ($reg->area==1) {
                            $area="Herrería";
                        }elseif ($reg->area==2) {
                            $area="Pintura";
                        }elseif ($reg->area==3) {
                            $area="Plásticos";
                        }elseif ($reg->area==5) {
                            $area="Ensamble (Porcelanizado)";
                        }elseif ($reg->area==6) {
                            $area="Ensamble (Comercial)";
                        }elseif ($reg->area==7) {
                            $area="Ensamble (Mueble)";
                        }elseif ($reg->area==8) {
                            $area="Horno";
                        }elseif ($reg->area>7 || $reg->area<1 || $reg->area==4) {
                            $area="";
                        }

    //$documento = "00000000000";
   // $direccion = "Calle Jose Guadalupe Zuno Hernández 1800";
    //$direccion2 = "Col. Americana, CP 44160 Guadalajara, Jalisco";
    //$telefono = "Tel: 500 01450";
   // $email = "ventas@pizarronesguadalajara.com";

    ?>

<div class="zona_impresion_op">
<!-- <div style="height: 897px; max-height: 897px;" > -->
<div style="border:0px solid #e5e5e5; overflow:scroll;height:750px;" >    

    <br>
    <img src="logo_pg.jpg" width="200" height="36"><br><br>
    <table border="0" align="center" width="1150px">
        
        
        <tr>
            <td align="left" width="50%"><h3><strong> <?php echo $nombreE; ?></strong></h3></td>       
            <td width="50%" align="right">Area: Producción / Codigo: FO-PG-PD-20</td>
        </tr>

        
       
    </table>
    <style type="text/css">
        
        td.margenes{
            padding: 3px 3px 3px 3px;
            border-color: #ccc;

        }

        td.fondo{
            background: #D5DED7;
            text-align: center;
        }

    </style>

    <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
        
        <tr>
            
            <td class="margenes fondo" width="20%">Prioridad</td>
            <td class="margenes fondo" width="20%">Área</td>
            <td class="margenes fondo">Lote</td>
            <td class="margenes fondo" width="20%">No. OP</td>
        </tr>
        <tr>
            
            <td class="margenes" style="text-align: center"><?php echo $reg->prioridad; ?></td>
            <td class="margenes" style="text-align: center"><?php echo $area; ?></td>
            <td class="margenes" style="text-align: center"><?php echo $reg->lote; ?></td>
            <td class="margenes" style="text-align: center; font-size: 20px;"><?php echo $reg->no_op; ?></td>
        </tr>
        
    </table>

    <table border="1" align="center" width="1150px" style="border-color: white;">
        <tr align="center">
            <td colspan="10" class="margenes fondo">PRODUCTOS</td>
        </tr>
        <tr align="center">
            <td class="margenes fondo" width="10%">No. Control</td>
            <td class="margenes fondo" width="10%">Codigo</td>
            <td class="margenes fondo" width="15%">Producto</td>
            <td class="margenes fondo" width="10%">Medidas</td>
            <td class="margenes fondo" width="10%">Color</td>
            <td class="margenes fondo" width="10%">Empaque</td>
            <td class="margenes fondo" width="5%">Cant.</td>
            <td class="margenes fondo" width="10%">Fecha Ini</td>
            
            <td class="margenes fondo" width="10%">Fecha Term</td>
            
            <td class="margenes fondo" width="10%">Observaciones</td>
            
        </tr>
        
        <?php
        $rsptad = $opr->listar_prod_rep($_GET["id"]);
      

        while ($regd = $rsptad->fetch_object()) {
            echo "<tr align='center'>";
            echo "<td class='margenes' style='font-size: 20px;'>".$regd->no_control."</td>";
            echo "<td class='margenes'>".$regd->codigo."</td>";
            echo "<td class='margenes'><small>".$regd->producto."</small></td>";
            echo "<td class='margenes'>".$regd->medida."</td>";
            echo "<td class='margenes'>".$regd->color."</td>";
            echo "<td class='margenes'>".$regd->empaque."</td>";
            //echo "<td colspan='1'>".$regd->pago."-".$regd->esp."-".$regd->mes1."-".$regd->mes2."</td>";
            echo "<td class='margenes'><small>".$regd->cant_tot."</small></td>";
            echo "<td class='margenes'>".$regd->fecha_inicio."</td>";
            
            echo "<td class='margenes'>".$regd->fecha_term."</td>";
            
            echo "<td class='margenes' align='left'>".$regd->observ."</td>";
            
            echo "</tr>";

            
        }
        ?>
    </table>

    

    <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
        
        <tr>

            <td class="margenes fondo" width="20%">Cantidad total</td>        
            <td class="margenes fondo" width="20%">Cantidad por color</td>       
            <td class="margenes fondo">Maquina</td>
            <td class="margenes fondo">Ciclo</td>     
                  
        </tr>
        <tr>
            <td class="margenes" height="25px" style="text-align: center"><?php echo $reg->cant_tot; ?></td>
            <td class="margenes" style="text-align: center"><?php echo $reg->cant_color; ?></td>
            <td class="margenes" style="text-align: center"><?php echo $reg->maquina; ?></td>
            <td class="margenes" style="text-align: center"><?php echo $reg->ciclo; ?></td>
           
        </tr>
        
    </table>

     <table border="1" align="center" width="1150px" style="border-color: white;">
        
        <tr align="center">
            <td class="margenes fondo" ></td>
           
            <td class="margenes fondo" >Fecha Inicio</td>
            <td class="margenes fondo" >Hora Inicio</td>
            <td class="margenes fondo" >Fecha Termino</td>
            <td class="margenes fondo" >Hora Termino</td>
            <td class="margenes fondo" >Piezas <br> Fabricadas</td>
            <td class="margenes fondo" >Merma</td>
            <td class="margenes fondo" >Desperdicio</td>
            <td class="margenes fondo" >Reproceso</td>
            <td class="margenes fondo" >Producto <br> aprobado</td>
            <td class="margenes fondo" >Productividad</td>
            <td class="margenes fondo" >% de <br> Cumplimiento</td>
            
        </tr>

        <tr>
            <td class='margenes'><small>PLAN</small></td>
            <td class='margenes' height='20px;'><?php echo $reg->fecha_inicio; ?></td>
            <td class='margenes'></td>
            <td class='margenes'><?php echo $reg->fecha_term; ?></td>
            <td class='margenes'></td>
            <td class='margenes'></td>
            <td class='margenes'></td>
            <td class='margenes'></td>
            <td class='margenes'></td>
            <td class='margenes'></td>
            <td class='margenes'></td>
            <td class='margenes'></td>
        </tr>

        

        <tr>
            <td class='margenes'><small>REAL</small></td>
            <td class='margenes' height='20px;'><?php echo $reg->fecha_inicio_real; ?></td>
            <td class='margenes'><?php echo $reg->hora_inicio; ?></td>
            <td class='margenes'><?php echo $reg->fecha_term_real; ?></td>
            <td class='margenes'><?php echo $reg->hora_term; ?></td>
            <td class='margenes'><?php echo $reg->piezas_fabricadas; ?></td><!--Aqui es la cantidad fabricada-->
            <td class='margenes'><?php echo $reg->merma; ?></td>
            <td class='margenes'><?php echo $reg->desperdicio; ?></td>
            <td class='margenes'><?php echo $reg->reproceso; ?></td>
            <td class='margenes'><?php echo $reg->prod_aprob; ?></td>
            <td class='margenes'><?php echo $reg->productividad; ?></td>
            <td class='margenes'><?php echo $reg->cumplimiento; ?></td>
        </tr>
        
        
        
    </table>

  

    <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
        
        <tr>
            <td class="margenes fondo">OBSERVACIONES ADICIONALES</td>            
        </tr>
        <tr>
            <td class="margenes" height="40px"><?php echo $reg->observ; ?></td>
        </tr>
        
        
    </table>
    <br>
    <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
        
        <tr >
            <td class="margenes fondo" width="60%" colspan="4">ENTREGAS <br>Parcialidades</td>
            <td width="2%"></td>
            <td class="margenes fondo" width="10%">No. Personas</td>
            <td class="margenes fondo" width="15%">NOMBRES</td>
            <td class="margenes fondo" width="15%">Producción <br>Elaborada</td>          
        </tr>
        <tr>
            <td class="margenes" height="20px" align="center" width="10%">CANTIDAD</td>
            <td class="margenes" height="20px" align="center">FECHA</td>
            
            <td class="margenes" align="center">RECIBE</td>
            <td class="margenes" align="center">LOTE</td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
        </tr>
        <tr>
            <td class="margenes" height="20px"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
        </tr>
        <tr>
            <td class="margenes" height="20px"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
        </tr>
        <tr>
            <td class="margenes" height="20px"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
        </tr>
        <tr>
            <td class="margenes" height="20px"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
        </tr>
        <tr>
            <td class="margenes" height="20px"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
        </tr>
        <tr>
            <td class="margenes" height="20px"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
        </tr>
        <tr>
            <td class="margenes" height="20px"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
        </tr>
        <tr>
            <td class="margenes" height="20px"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
        </tr>
        <tr>
            <td class="margenes" height="20px"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
        </tr>
        <tr>
            <td class="margenes" height="20px"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
            <td class="margenes"></td>
        </tr>




        
    </table>

    

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


    


</div>

    <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
        
        
        <tr>
            <td class="margenes"></td>            
        </tr>
        <tr>
            <td class="margenes"></td>            
        </tr>
        <tr>
            <td class="margenes"></td>            
        </tr>
        <tr>
            <td class="margenes" height="25px" style="text-align: center">________________________</td>
            <td class="margenes" height="25px" style="text-align: center">________________________</td>
        </tr>
        <tr>
            <td class="margenes" height="25px" style="text-align: center">Supervisor de Producción</td>
            <td class="margenes" height="25px" style="text-align: center">Jefe de Producción</td>
        </tr>
        
        
    </table>
    <br>
    <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
        
        
        <tr>
            <td class="margenes" height="25px" style="text-align: center">ANEXAR VALE DE MATERIA PRIMA</td>
        </tr>   
        
    </table>
    <button type="button" class="btn btn-primary" onclick="mostrar_hoja();" id="btn_mostrar">+</button>
    <button type="button" class="btn btn-primary" onclick="ocultar_hoja();" id="btn_ocultar">-</button>
    <script type="text/javascript">
        
        function mostrar_hoja()
        {
            $("#hoja_extra").show();
            $("#btn_ocultar").show();
            $("#btn_mostrar").hide();
        }

        function ocultar_hoja()
        {
            $("#hoja_extra").hide();
            $("#btn_ocultar").hide();
            $("#btn_mostrar").show();
        }

    </script>
</div>

<div class="zona_impresion_op" id="hoja_extra">
<!-- <div style="height: 897px; max-height: 897px;" > -->
            <div style="height:900px;" >    

                <br>
                <img src="logo_pg.jpg" width="200" height="36"><br><br>
                
                <style type="text/css">
                    
                    td.margenes{
                        padding: 3px 3px 3px 3px;
                        border-color: #ccc;

                    }

                    td.fondo{
                        background: #D5DED7;
                        text-align: center;
                    }

                </style>

               

                
                <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                    
                    <tr >
                        <td class="margenes fondo" width="60%" colspan="4">ENTREGAS <br>Parcialidades</td>
                        <td width="2%"></td>
                        <td class="margenes fondo" width="10%">No. Personas</td>
                        <td class="margenes fondo" width="15%">NOMBRES</td>
                        <td class="margenes fondo" width="15%">Producción <br>Elaborada</td>          
                    </tr>
                    <tr>
                        <td class="margenes" height="20px" align="center" width="10%">CANTIDAD</td>
                        <td class="margenes" height="20px" align="center">FECHA</td>
                        
                        <td class="margenes" align="center">RECIBE</td>
                        <td class="margenes" align="center">LOTE</td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    <tr>
                        <td class="margenes" height="20px"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                        <td class="margenes"></td>
                    </tr>
                    



                    
                </table>


            </div>

</div>
<br>
<div class="zona_impresion_op">
<div style=" height: 883px;">

    

    <?php 

   //echo $reg->cant_tot; 

    if ($reg->area==1) {
        
        echo '

            <img src="logo_pg.jpg" width="200" height="36"><br><br><br>
            <table border="0" align="center" width="1150px">
                   
                <tr>
                    <td align="left" width="40%"><h3><strong>DESPEJE DE LINEA Y PRODUCTO EN PROCESO/HERRERIA</strong></h3></td>       
                    <td width="60%" align="right">Area: PRODUCCIÓN | <br> Codigo: FO-PG-PD-09</td>
                </tr>
              
            </table>


            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                <tr align="center">
                    <td class="margenes" width="12%"></td> 
                    
                    <td class="margenes" colspan="10" width="12%"><small>CORTE</small></td>
                    
                    <td class="margenes" colspan="10" width="12%"><small>LAVADO</small></td>
                    
                    <td class="margenes" colspan="10" width="12%"><small>DESPUNTE</small></td>
                     
                    <td class="margenes" colspan="10" width="12%"><small>TROQUEL</small></td>
                     
                    <td class="margenes" colspan="10" width="12%"><small>DOBLADO</small></td>
                     
                    <td class="margenes" colspan="10" width="12%"><small>SOLDADURA</small></td>
                     
                    <td class="margenes" colspan="10" width="12%"><small>NIVELAR</small></td>
                   
                                
                </tr>

              
                <tr>
                    <td class="margenes" height="60px" align="center"><small>FECHA</small></td> 
                    
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                     
                  
                    
                                 
                </tr>

                

                <tr>
                   
                    <td class="margenes" height="60px" align="center"><small>HORA</small></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
              
                </tr>
                

                
            </table>

            

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="20%">PARAMETROS</td>
                    <td class="margenes" align="center">SI</td>
                    <td class="margenes" align="left"><img src="../images/iconos/correct.png" width="10%"></td>
                    <td class="margenes" align="center">NO</td>
                    <td class="margenes" align="left"><img src="../images/iconos/close.png" width="10%"></td>
                    <td class="margenes" align="left" colspan="26" width="50%"></td>
                    
                </tr>

                
            </table>
            


            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">ÁREA</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>

            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">

                <tr align="center">
                    <td class="margenes fondo" width="12%"></td> 
                    
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                    
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                    
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                     
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                     
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                     
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                     
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                   
                                
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="12%"><small>Área limpia y ordenada</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                                
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Personal con uniforme de trabajo y equipo de seguridad</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>             
                </tr>

                <tr>
                    <td class="margenes" height="20px" width="150px"><small>Materia prima e insumos correspondientes a la orden de producción liberados listos para trabajar</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>              
                </tr>

                
                    
                    

            </table> 

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                        <td class="margenes" width="20%">PRODUCTO</td>
                        <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>      
               
            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">

                <tr align="center">
                    <td class="margenes fondo" width="12%"></td> 
                    
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                    
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                    
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                     
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                     
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                     
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                     
                    <td class="margenes fondo" colspan="10" width="12%"><small></small></td>
                   
                                
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="12%" style="font-size: 11px;"><small>Rebabas</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>             
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="12%" style="font-size: 11px;"><small>Medidas</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>            
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="12%" style="font-size: 11px;"></small>Limpias</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>            
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="150px" style="font-size: 11px;"><small>Tina limpia</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>            
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="150px" style="font-size: 11px;"><small>Calibres</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>            
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="150px" style="font-size: 11px;"><small>Doblez en las medidas correctas</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>            
                </tr>    

                <tr>
                    <td class="margenes" height="20px" width="150px" style="font-size: 11px;"><small>Buena aplicación de la soldadura</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>            
                </tr>

                <tr>
                    <td class="margenes" height="20px" width="150px" style="font-size: 11px;"><small>Estabilidad</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td>            
                </tr>

  
            </table>



        ';
    }


    if ($reg->area==2) {
        
        echo '

            <img src="logo_pg.jpg" width="200" height="36"><br><br><br>
            <table border="0" align="center" width="1150px">
                   
                <tr>
                    <td align="left" width="40%"><h3><strong>DESPEJE DE LINEA/INSPECCIÓN VISUAL</strong></h3></td>       
                    <td width="60%" align="right">Area: PRODUCCIÓN | PINTURA <br> Codigo: FO-PG-PD-14</td>
                </tr>
              
            </table>


            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                <tr align="center">
                    <td class="margenes" width="18%">ÁREA</td> 
                    <td class="margenes" width="1%"></td>
                    <td class="margenes" colspan="15" width="40%"><small>ABASTO</small></td>
                    <td class="margenes" width="1%"></td>
                    <td class="margenes" colspan="15" width="40%"><small>REGATON</small></td>
                   
                                
                </tr>

              
                <tr>
                    <td class="margenes" height="60px" align="center"><small>FECHA</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes" colspan="3"></td> 
                    
                    <td class="margenes" colspan="3"></td> 
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes" colspan="3"></td> 
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td> 
                     
                    
                    
                                 
                </tr>

                

                <tr>
                   
                    <td class="margenes" height="60px" align="center"><small>HORA</small></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                </tr>
                

                
            </table>

            

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="20%">PARAMETROS</td>
                    <td class="margenes" align="center">SI</td>
                    <td class="margenes" align="left"><img src="../images/iconos/correct.png" width="10%"></td>
                    <td class="margenes" align="center">NO</td>
                    <td class="margenes" align="left"><img src="../images/iconos/close.png" width="10%"></td>
                    <td class="margenes" align="left" colspan="26" width="50%"></td>
                    
                </tr>

                
            </table>
            


            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">ÁREA</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>

            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">

              
                <tr>
                    <td class="margenes" height="20px" width="18%"><small>Área limpia y ordenada</small></td> 
                    <td class="margenes" width="1%"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes" width="1%"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                     
               
                                
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Personal con uniforme de trabajo y equipo de seguridad</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                   
                    
                            
                </tr>

                <tr>
                    <td class="margenes" height="20px" width="150px"><small>Materia prima e insumos correspondientes a la orden de producción liberados listos para trabajar</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>              
                </tr>

                
                    
                    

            </table> 

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                        <td class="margenes" width="20%">ABASTO</td>
                        <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>      
               
            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">

                <tr>
                    <td class="margenes" height="20px" width="18%" style="font-size: 11px;"><small>Pintura bien cocida</small></td> 
                    <td class="margenes" width="1%"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes" width="1%"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>            
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="12%" style="font-size: 11px;"><small>Tonalidad uniforme</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>            
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="12%" style="font-size: 11px;"><small>Textura uniforme</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>            
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="150px" style="font-size: 11px;"><small>Etiqueta</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>           
                </tr>
                

  
            </table>

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                        <td class="margenes" width="20%">REGATON</td>
                        <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>

            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">

                <tr>
                    <td class="margenes" height="20px" width="18%" style="font-size: 11px;"><small>Rebabas</small> </td> 
                    <td class="margenes" width="1%"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes" width="1%"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>            
                </tr>
  
            </table>

        ';
    }



    if ($reg->area==3) {
        
        echo '

            <img src="logo_pg.jpg" width="200" height="36"><br><br><br>
            <table border="0" align="center" width="1150px">
                   
                <tr>
                    <td align="left" width="40%"><h3><strong>DESPEJE DE LINEA/INSPECCIÓN VISUAL</strong></h3></td>       
                    <td width="60%" align="right">Area: PRODUCCIÓN <br> Codigo: FO-PG-PD-10</td>
                </tr>
              
            </table>


            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                <tr align="center">
                    <td class="margenes" width="12%">DÍA</td> 
                    <td class="margenes" colspan="3" width="15%">LUNES</td>
                    <td class="margenes" colspan="3" width="15%">MARTES</td>
                    <td class="margenes" colspan="3" width="15%">MIERCOLES</td>
                    <td class="margenes" colspan="3" width="15%">JUEVES</td>
                    <td class="margenes" colspan="3" width="14%">VIERNES</td>
                    <td class="margenes" colspan="3" width="14%">SABADO</td>            
                </tr>

              
                <tr>
                    <td class="margenes" height="20px" align="center"><small>FECHA</small></td> 
                    
                    <td class="margenes" colspan="3"></td> 
                    
                    <td class="margenes" colspan="3"></td> 
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td> 
                     
                    <td class="margenes" colspan="3"></td> 
                  
                     
                    
                    
                                 
                </tr>

                

                <tr>
                   
                    <td class="margenes" height="20px" align="center"><small>HORA</small></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                         
                </tr>

                <tr>
                   
                    <td class="margenes" height="20px" align="center"><small>COLOR</small></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                         
                </tr>

                <tr>
                   
                    <td class="margenes" height="20px" align="center"><small>OPERADOR</small></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                         
                </tr>

                
                

                
            </table>

            

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="20%">PUNTOS A REVISAR</td>
                    <td class="margenes" align="center">PRESENTA</td>
                    <td class="margenes" align="left"><img src="../images/iconos/correct.png" width="10%"></td>
                    <td class="margenes" align="center">NO PRESENTA</td>
                    <td class="margenes" align="left"><img src="../images/iconos/close.png" width="10%"></td>
                    <td class="margenes" align="left" width="40%"></td>
                    
                </tr>

                
            </table>
        

            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">

                <tr>
                    <td class="margenes fondo"></td>
                    <td class="margenes fondo" colspan="3" width="15%"></td> 
                    <td class="margenes fondo" colspan="3" width="15%"></td> 
                    <td class="margenes fondo" colspan="3" width="15%"></td>
                    <td class="margenes fondo" colspan="3" width="15%"></td>
                    <td class="margenes fondo" colspan="3" width="14%"></td> 
                    <td class="margenes fondo" colspan="3" width="14%"></td> 
                  
                    
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="12%"><small>Área de trabajo <br> limpio y ordenado</small></td> 
                    
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    
                     
               
                                
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Betas de pigmento</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                   
                    
                            
                </tr>
                <tr>
                    <td class="margenes" height="20px"><small>Puntos negros</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                   
                    
                            
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Marca de botadores</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                   
                    
                            
                </tr>
                <tr>
                    <td class="margenes" height="20px"><small>Rechupe</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>          
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Humedad (Flash)</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>          
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Tonalidad diferente</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>          
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Molde con desfase</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>          
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Incompletas</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>          
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Verificar dimensiones (Regatones/Respaldos)</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>          
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Logo despegado/quebrado</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>          
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Area de quemado sin tonalidad blanca</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>          
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Peso por pieza/juego</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>          
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Cantidad por empaque</small></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>          
                </tr>

                
            </table>     
                
                    
                    

           

        ';
    }


    if ($reg->area==5) {
        
        echo '

            <img src="logo_pg.jpg" width="200" height="36"><br><br><br>
            <table border="0" align="center" width="1150px">
                   
                <tr>
                    <td align="left" width="40%"><h3><strong>DESPEJE DE LINEA/INSPECCIÓN VISUAL</strong></h3></td>       
                    <td width="60%" align="right">Area: PRODUCCIÓN / ENSAMBLE <br> Codigo: FO-PG-PD-08</td>
                </tr>
              
            </table>


            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                <tr align="center">
                    <td class="margenes" width="16%">ÁREA</td> 
                    <td class="margenes" colspan="15" width="28%"></td>
                    <td class="margenes" colspan="15" width="28%"></td>
                    <td class="margenes" colspan="15" width="28%"></td>
                               
                </tr>

              
                <tr>
                    <td class="margenes" height="20px" align="center"><small>FECHA</small></td>                    
                    <td class="margenes" colspan="3"></td>                    
                    <td class="margenes" colspan="3"></td> 
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>

                    <td class="margenes" colspan="3"></td>                    
                    <td class="margenes" colspan="3"></td> 
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td> 

                    <td class="margenes" colspan="3"></td>                    
                    <td class="margenes" colspan="3"></td> 
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td> 
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="50px" align="center"><small>HORA</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                    
                    
                      
                                 
                </tr>

                
                
            </table>

            

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="20%">PARAMETROS</td>
                    <td class="margenes" align="center">SI</td>
                    <td class="margenes" align="left"><img src="../images/iconos/correct.png" width="5%"></td>
                    <td class="margenes" align="center">NO</td>
                    <td class="margenes" align="left"><img src="../images/iconos/close.png" width="5%"></td>
                    <td class="margenes" align="left" width="40%"></td>
                    
                </tr>

                
            </table>

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">ÁREA</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>
        

            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                <tr align="center">
                    <td class="margenes fondo" width="16%"></td> 
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                               
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="16%"><small>Área limpia y ordenada</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Personal con uniforme de trabajo y equipo de seguridad</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Materia prima e insumos  correspondientes a la orden de producción liberados listos para trabajar</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>


                
            </table>

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">ENSAMBLE</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>

             <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                <tr align="center">
                    <td class="margenes fondo" width="16%"></td> 
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                               
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="16%"><small>Filos en esquinas</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Barrenos centrados y a la medida</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Aluminio bien anodizado</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Medidas correctas</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Remaches botados</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Remaches con clavo</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>




                
            </table>


            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">EMPAQUE</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>

             <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                <tr align="center">
                    <td class="margenes fondo" width="16%"></td> 
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                               
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="16%"><small>Filos en esquinas</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Etiqueta</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Empaques sin daños</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                
            </table>   
                
                    
                    
            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">CORTE</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>

             <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                <tr align="center">
                    <td class="margenes fondo" width="16%"></td> 
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                               
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="16%"><small>Medidas correctas</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Escuadras correctas</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Material sin daño aparente</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                
            </table>
           

        ';




    }


     if ($reg->area==6) {
        
        echo '

            <img src="logo_pg.jpg" width="200" height="36"><br><br><br>
            <table border="0" align="center" width="1150px">
                   
                <tr>
                    <td align="left" width="40%"><h3><strong>DESPEJE DE LINEA/INSPECCIÓN VISUAL</strong></h3></td>       
                    <td width="60%" align="right">Area: PRODUCCIÓN / ENSAMBLE DE COMERCIAL <br> Codigo: FO-PG-PD-01</td>
                </tr>
              
            </table>


            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                <tr align="center">
                    <td class="margenes" width="20%">FECHA</td> 
                    <td class="margenes" colspan="3" width="8%"></td>
                    <td class="margenes" colspan="3" width="8%"></td>
                    <td class="margenes" colspan="3" width="8%"></td>
                    <td class="margenes" colspan="3" width="8%"></td>
                    <td class="margenes" colspan="3" width="8%"></td>
                    <td class="margenes" colspan="3" width="8%"></td>
                    <td class="margenes" colspan="3" width="8%"></td>
                    <td class="margenes" colspan="3" width="8%"></td>
                    <td class="margenes" colspan="3" width="8%"></td>
                    <td class="margenes" colspan="3" width="8%"></td>
                               
                </tr>

                <tr align="center">
                    <td class="margenes" width="10%" height="60px">HORA</td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

              
               

                
                
            </table>

            

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="20%">PARAMETROS</td>
                    <td class="margenes" align="center">SI</td>
                    <td class="margenes" align="left"><img src="../images/iconos/correct.png" width="5%"></td>
                    <td class="margenes" align="center">NO</td>
                    <td class="margenes" align="left"><img src="../images/iconos/close.png" width="5%"></td>
                    <td class="margenes" align="left" width="40%"></td>
                    
                </tr>

                
            </table>

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">ÁREA</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>
        

            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                <tr>
                    <td class="margenes fondo" width="20%"></td> 
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                               
                </tr>
                
                <tr>
                    <td class="margenes" width="10%"><small>Área limpia y ordenada</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                <tr>
                    <td class="margenes" width="10%"><small>Personal con uniforme de trabajo y equipo de seguridad</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                <tr>
                    <td class="margenes" width="10%"><small>Materia prima e insumos correspondientes a la orden de producción liberados listos para trabajar</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                
            </table>

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">ENSAMBLE</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>
        

            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                <tr>
                    <td class="margenes fondo" width="20%"></td> 
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                               
                </tr>
                
                <tr>
                    <td class="margenes" width="10%"><small>Medidas correctas</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                <tr>
                    <td class="margenes" width="10%"><small>Barrenos centrados y a la medida</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                <tr>
                    <td class="margenes" width="10%"><small>Aluminio bien anonizado</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                <tr>
                    <td class="margenes" width="10%"><small>Pizarrón sin defectos</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                <tr>
                    <td class="margenes" width="10%"><small>Ensamble bien escuadrado</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                
            </table>

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">EMPAQUE</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>
        

            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                <tr>
                    <td class="margenes fondo" width="20%"></td> 
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                    <td class="margenes fondo" colspan="3" width="8%"></td>
                               
                </tr>
                
                <tr>
                    <td class="margenes" width="10%"><small>Paquetes mal estibados</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                <tr>
                    <td class="margenes" width="10%"><small>Etiqueta</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                <tr>
                    <td class="margenes" width="10%"><small>Empaque sin daños</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                <tr>
                    <td class="margenes" width="10%"><small>Material correspondiente</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                <tr>
                    <td class="margenes" width="10%"><small>Material a la medida</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                <tr>
                    <td class="margenes" width="10%"><small>Sin descuadres</small></td> 
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                    <td class="margenes"></td>
                               
                </tr>

                
            </table>
           

        ';



        
    }


    if ($reg->area==7) {
        
        echo '

            <img src="logo_pg.jpg" width="200" height="36"><br><br><br>
            <table border="0" align="center" width="1150px">
                   
                <tr>
                    <td align="left" width="40%"><h3><strong>DESPEJE DE LINEA/INSPECCIÓN VISUAL</strong></h3></td>       
                    <td width="60%" align="right">Area: PRODUCCIÓN / ENSAMBLE DE MUEBLES <br> Codigo: FO-PG-PD-12</td>
                </tr>
              
            </table>


            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                <tr align="center">
                    <td class="margenes" width="16%">ÁREA</td> 
                    <td class="margenes" colspan="15" width="28%"></td>
                    <td class="margenes" colspan="15" width="28%"></td>
                    <td class="margenes" colspan="15" width="28%"></td>
                               
                </tr>

              
                <tr>
                    <td class="margenes" height="20px" align="center"><small>FECHA</small></td>                    
                    <td class="margenes" colspan="3"></td>                    
                    <td class="margenes" colspan="3"></td> 
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>

                    <td class="margenes" colspan="3"></td>                    
                    <td class="margenes" colspan="3"></td> 
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td> 

                    <td class="margenes" colspan="3"></td>                    
                    <td class="margenes" colspan="3"></td> 
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td> 
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="50px" align="center"><small>HORA</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                    
                    
                      
                                 
                </tr>

                
                
            </table>

            

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="20%">PARAMETROS</td>
                    <td class="margenes" align="center">SI</td>
                    <td class="margenes" align="left"><img src="../images/iconos/correct.png" width="5%"></td>
                    <td class="margenes" align="center">NO</td>
                    <td class="margenes" align="left"><img src="../images/iconos/close.png" width="5%"></td>
                    <td class="margenes" align="left" width="40%"></td>
                    
                </tr>

                
            </table>

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">ÁREA</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>
        

            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                <tr align="center">
                    <td class="margenes fondo" width="16%"></td> 
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                               
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="16%"><small>Área limpia y ordenada</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Personal con uniforme de trabajo y equipo de seguridad</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Materia prima e insumos  correspondientes a la orden de producción liberados listos para trabajar</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>


                
            </table>

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">ENSAMBLE</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>

             <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                <tr align="center">
                    <td class="margenes fondo" width="16%"></td> 
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                               
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="16%"><small>Estructuras correspondientes</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Resipados o Asientos mal ensamblados</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Plasticos a la medida</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Estructuras desniveladas</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Remaches botados</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Remaches con clavo</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>




                
            </table>


            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">EMPAQUE</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>

             <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                <tr align="center">
                    <td class="margenes fondo" width="16%"></td> 
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                               
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="16%"><small>Paquetes mal estibados</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Etiqueta</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Empaques sin daños</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Estructuras retocadas</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                
            </table>   
                
                    
                    
            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">TRASLADO DE ESTRUCTURA</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>

             <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                <tr align="center">
                    <td class="margenes fondo" width="16%"></td> 
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                    <td class="margenes fondo" colspan="15" width="28%"></td>
                               
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="16%"><small>Estructuras talladas</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Medidas correctas</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Entrega a tiempo</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>                     
                     
                      
                                 
                </tr>

                
            </table>
           

        ';




    }



    if ($reg->area==8) {
        
        echo '

            <img src="logo_pg.jpg" width="200" height="36"><br><br><br>
            <table border="0" align="center" width="1150px">
                   
                <tr>
                    <td align="left" width="40%"><h3><strong>DESPEJE DE LINEA/INSPECCIÓN VISUAL</strong></h3></td>       
                    <td width="60%" align="right">Area: PRODUCCIÓN / ENSAMBLE DE MUEBLES <br> Codigo: FO-PG-PD-12</td>
                </tr>
              
            </table>


            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                <tr align="center">
                    <td class="margenes" width="16%">ÁREA</td> 
                    <td class="margenes" colspan="15" width="42%">PEGADO</td>
                    <td class="margenes" colspan="15" width="42%">HORNO</td>
                    
                               
                </tr>

              
                <tr>
                    <td class="margenes" height="20px" align="center"><small>FECHA</small></td>                    
                    <td class="margenes" colspan="3"></td>                    
                    <td class="margenes" colspan="3"></td> 
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>

                    <td class="margenes" colspan="3"></td>                    
                    <td class="margenes" colspan="3"></td> 
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>
                    <td class="margenes" colspan="3"></td>  
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="50px" align="center"><small>HORA</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                    
                      
                                 
                </tr>

                
                
            </table>

            

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="20%">PARAMETROS</td>
                    <td class="margenes" align="center">SI</td>
                    <td class="margenes" align="left"><img src="../images/iconos/correct.png" width="5%"></td>
                    <td class="margenes" align="center">NO</td>
                    <td class="margenes" align="left"><img src="../images/iconos/close.png" width="5%"></td>
                    <td class="margenes" align="left" width="40%"></td>
                    
                </tr>

                
            </table>

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">ÁREA</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>
        

            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                <tr align="center">
                    <td class="margenes fondo" width="16%"></td> 
                    <td class="margenes fondo" colspan="15" width="42%"></td>
                    <td class="margenes fondo" colspan="15" width="42%"></td>
                               
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="16%"><small>Área limpia y ordenada</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Personal con uniforme de trabajo y equipo de seguridad</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                   
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Materia prima e insumos  correspondientes a la orden de producción liberados listos para trabajar</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                   
                     
                      
                                 
                </tr>


                
            </table>

            <table border="0" align="center" width="1150px" id="tabla2" style="border-color: white;">
                
                
                <tr>
                    <td class="margenes" width="30%">PROCESO COMPLETO</td>
                    <td class="margenes" colspan="30"></td> 
                </tr>

                
            </table>
        

            <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
                <tr align="center">
                    <td class="margenes fondo" width="16%"></td> 
                    <td class="margenes fondo" colspan="15" width="42%"></td>
                    <td class="margenes fondo" colspan="15" width="42%"></td>
                               
                </tr>
                <tr>
                    <td class="margenes" height="20px" width="16%"><small>Pintura bien cocida</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>
                     
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Tonalidad uniforme</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                   
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Textura uniforme</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                   
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Etiqueta</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                   
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Lámina Abombada</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                   
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Grumos</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                   
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Puntos negros</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                   
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Tiras mal pegadas</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                   
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Borrar bien</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                   
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Descuadres</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                   
                     
                      
                                 
                </tr>

                <tr>
                    <td class="margenes" height="20px"><small>Pegamento aplicado en toda la superficie</small></td>                    
                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                    <td class="margenes"></td>
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td> 
                    <td class="margenes"></td>

                   
                     
                      
                                 
                </tr>


                
            </table>

            
           

        ';




    }

    ?>
        
    
    
            

    <table border="1" align="center" width="1150px" id="tabla2" style="border-color: white;">
        
        <tr>
            <td class="imagenes fondo">OBSERVACIONES</td>
        </tr>
        <tr>
            <td class="margenes" rowspan="2" height="50px;"><?php echo $reg->obs; ?></td>            
        </tr>
        
        
        
        
    </table>
    <br>

    <div align="center">    
        <a href="#" onclick="window.print();">Imprimir</a>
    </div>




    <br>

</div>


    
</div>
<p>&nbsp;</p>

</body>
<script src="../vendors/jquery/dist/jquery.min.js"></script>
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