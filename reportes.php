<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.php");
}
else
{
require 'header.php';
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1 || $_SESSION['consulta1']==1)
{
?>
                            <style>

                              input[type=number]::-webkit-outer-spin-button,

                              input[type=number]::-webkit-inner-spin-button {

                                  -webkit-appearance: none;

                                  margin: 0;

                              }

                               

                              input[type=number] {

                                  -moz-appearance:textfield;

                              }

                            </style>

        <!-- <link rel="stylesheet" href="css/style.css">
        <script src="node_modules/@mescius/spread-sheets/index.js"></script>
        <script src="node_modules/@mescius/spread-sheets-io/index.js"></script>
        <script src="node_modules/file-saver/dist/FileSaver.min.js"></script> -->
        <div class="right_col" role="main">
              <div class="row">
                  <div class="x_panel">
                    <div class="x_content">
                      <div class="row" id="">
                        <div class="col-md-12 col-sm-12">
                          <div class="col-md-12 col-sm-12">
                            <h4>Reporte de Pedidos</h4>
                          </div>
                          
                          <div class="col-md-12 col-sm-12" style="margin-top: 30px;">
                            <div class="col-md-2 col-sm-2">
                              <label for="">Estatus</label>
                                <select class="form-control" name="" id="tipos_consulta_pedidos">
                                  <option value="1">Todos</option>
                                  <option value="2">Entregados</option>
                                  <option value="3">Pendientes</option>
                                  <option value="4">Cancelados</option>
                                </select>
                                <!-- <button style="background-color: #ffffffff; color: #1f293fff; display: flex; justify-content: center; align-items: center; padding: 5px 15px; border-radius: 5px; border: none; box-shadow: 5px 5px 10px rgba(5, 83, 228, 0.2); float: left;"><img src="images/iconos/order_b4.png" alt="" style="width: 20px;">&nbsp;&nbsp;<b style="font-size: 13px;">Todos</b></button> -->
                                <!-- <button style="background-color: #ffffffff; color: #1f293fff; display: flex; justify-content: center; align-items: center; padding: 5px 15px; border-radius: 5px; border: none; box-shadow: 5px 5px 10px rgba(5, 83, 228, 0.2); float: left;"><img src="images/iconos/delivered.png" alt="" style="width: 20px;">&nbsp;&nbsp;<b style="font-size: 13px;">Entregados</b></button> -->
                                <!-- <button style="background-color: #ffffffff; color: #1f293fff; display: flex; justify-content: center; align-items: center; padding: 5px 15px; border-radius: 5px; border: none; box-shadow: 5px 5px 10px rgba(5, 83, 228, 0.2); float: left;"><img src="images/iconos/arrows.png" alt="" style="width: 20px;">&nbsp;&nbsp;<b style="font-size: 13px;">Pendientes</b></button> -->
                                <!-- <button style="background-color: #ffffffff; color: #1f293fff; display: flex; justify-content: center; align-items: center; padding: 5px 15px; border-radius: 5px; border: none; box-shadow: 5px 5px 10px rgba(5, 83, 228, 0.2); float: left;"><img src="images/iconos/cancel2.png" alt="" style="width: 20px;">&nbsp;&nbsp;<b style="font-size: 13px;">Cancelados</b></button> -->
                            </div>
                            <div class="col-md-2 col-sm-2">
                              <label for="">Mes</label>
                              <select class="form-control" name="" id="select_list_meses">
                              </select>
                            </div>
                            <div class="col-md-2 col-sm-2">
                              <label for="">Año</label>
                              <select class="form-control" name="" id="select_list_anios">
                              </select>
                            </div>
                            <div class="col-md-2 col-sm-2" style="padding-top: 30px;">
                              <button onclick="listar_pedidos_new();" style="padding: 5px 15px; background-color: #1d4e85ff; color: #ffffff; border: none !important;">Buscar</button>
                            </div>
                            <div class="col-md-4 col-sm-4" style="padding-top: 30px; display: flex; justify-content: right;">
                              <button id="sheetjsexport" style="padding: 5px 15px; background-color: #076649ff; color: #ffffff; border: none !important; box-shadow: 5px 5px 10px rgba(0,0,0,0.2);">Exportar a excel</button>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12" style="margin-top: 15px; padding-left: 20px;">
                            <b id="tipo_consulta" style="text-transform: uppercase; padding: 5px; background-color: #1d4e85ff; border-radius: 3px; color: #ffffff;"></b>&nbsp;-&nbsp;<b id="cant_pedidos_enc"></b>&nbsp;<b>Pedidos Encontrados.</b>
                          </div>
                          <div class="col-md-12 col-sm-12" style="margin-top: 15px; height: 500px; overflow: scroll;">
                            
                            <table class="table table-striped" id="TableToExport">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>No. Control</th>
                                  <th>Fecha de pedido</th>
                                  <th>Tipo</th>
                                  <th>Punto de venta</th>
                                  <th>Estatus</th>
                                </tr>
                              </thead>
                              <tbody id="tbl_pedidos">
                                
                              </tbody>
                            </table>
                          </div>
<!-- 
                          <div class="col-md-12 col-sm-12" style="margin-top: 30px;">
                            <div class="col-md-4 col-sm-4">
                              <label>Fecha inicial</label>
                              <input type="date" name="" id="fecha_ini_rep" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Fecha final</label>
                              <input type="date" name="" id="fecha_fin_rep" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-4" style="padding-top: 25px;">
                              <button type="button" class="btn btn-dark" onclick="">Buscar</button>
                              
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12" style="margin-top: 20px;">

                            <table class="table table-striped" id="tbl_pedidos_reportes">
                              
                            </table>
                          </div> -->










                          
                          <!-- <div class="col-md-12 col-sm-12">
                            <div onclick="ver_pedidos_pendientes();" class="col-md-3 col-sm-3" style="cursor: pointer; box-shadow: 5px 5px 5px rgba(0,0,0,0.2); height: 70px; background-color: #065589; margin-right: 20px; display: flex; align-items: center; justify-content: center;">
                              <label style="color: white; font-size: 20px; cursor: pointer;">Pedidos pendientes</label>
                            </div>
                            <div class="col-md-3 col-sm-3" style="cursor: pointer; box-shadow: 5px 5px 5px rgba(0,0,0,0.2); height: 70px; background-color: #04966A; margin-right: 20px; display: flex; align-items: center; justify-content: center;">
                              <label style="color: white; font-size: 20px; cursor: pointer;">Pedidos fabricados</label>
                            </div>
                            <div class="col-md-3 col-sm-3" style="cursor: pointer; box-shadow: 5px 5px 5px rgba(0,0,0,0.2); height: 70px; background-color: #C71A09; display: flex; align-items: center; justify-content: center;">
                              <label style="color: white; font-size: 20px; cursor: pointer;">Pedidos cancelados</label>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12" style="margin-top: 20px; display: block;" id="btn1">
                            <div class="col-md-4 col-sm-4">
                              <label>Fecha inicial</label>
                              <input type="date" name="" id="fecha_ini" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-4">
                              <label>Fecha final</label>
                              <input type="date" name="" id="fecha_fin" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-4" style="padding-top: 25px;">
                              <button type="button" class="btn btn-dark" onclick="buscar_reporte();">Buscar</button>
                              <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Exportar productos entregados" onclick="exportTableToExcel('tbl_pedidos_estatus', 'pedidos_entregados')">Exportar</button>
                            </div>
                            <div class="col-md-12 col-sm-12">
                              
                            </div>
                            
                          </div>
                          <div class="col-md-12 col-sm-12" style="margin-top: 20px; display: none;" id="btn2">
                            <button type="button" class="btn btn-dark" id="btnExportar">Exportar</button>
                            
                          </div>
                          <div class="col-md-12 col-sm-12" style="height: 400px; overflow-y: scroll;">
                            <table class="table table-striped" id="tbl_pedidos_estatus">
                              
                            </table>
                          </div> -->

                          <!-- <script type="text/javascript">
                            document.getElementById('btnExportar').onclick = function(){
                              var element = document.getElementById('tbl_pedidos_estatus');

                              var opt = {
                                margin:  1,
                                filename: 'pendientes.pdf',
                                image: { type: 'jpeg', quality: 0.98 },
                                html2canvas: { scale: 2 },
                                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape'}
                              };

                              html2pdf(element, opt);
                            }
                          </script> -->

                        </div>
                      </div>
                    </div>
                  </div>                
              </div>
        </div>
          
    <!-- <script src="node_modules/@mescius/spread-sheets/index.js"></script>
        <script src="node_modules/@mescius/spread-sheets-io/index.js"></script>
        <script src="node_modules/file-saver/dist/FileSaver.min.js"></script> -->
    <script src="https://cdn.sheetjs.com/xlsx-0.20.3/package/dist/xlsx.full.min.js"></script>

    <script src="js/html2pdf.bundle.min.js"></script>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script type="text/javascript" src="scripts/reportes.js?v=<?php echo(rand()); ?>"></script>
    <script src="build/js/custom.min.js"></script>
    <script src="public/js/bootbox.min.js"></script> 
    
  </body>
</html>

<?php
}
else
{
  require 'noacceso.php';
}

?>

<?php 
}
ob_end_flush();
?>