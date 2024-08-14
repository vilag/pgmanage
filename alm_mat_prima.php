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
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1 || $_SESSION['Produccion']==1 || $_SESSION['consulta1']==1)
{
?>


        <!-- page content -->
        <div class="right_col" role="main" id="page_pedido">

          <div class="">
            
                       
           
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="form-group col-md-12 col-sm-12" id="div_reg_prod_mat">
                            <div class="form-group col-md-12 col-sm-12">     
                                <b>ALMACÉN DE MATERIA PRIMA</b>
                            </div>
                            <div class="form-group col-md-12 col-sm-12" style="padding-top: 10px;">  
                                <div class="form-group col-md-6 col-sm-6">     
                                    <button onclick="ver_form_prod();" class="btn" style="background-color: #063A5D; color: #fff;">Productos</button>
                                    <button onclick="ver_form_tipos();" class="btn" style="background-color: #063A5D; color: #fff;">Tipos</button>
                                </div>   
                            </div>
                            <div id="div_form_prod" class="form-group col-md-4 col-sm-4">  
                                <div class="form-group col-md-12 col-sm-12">     
                                    <b style="font-size: 18px;">Productos</b>
                                    <hr>
                                    <b style="font-size: 15px;">Registrar nuevo producto</b><br>
                                    <label for="">(*) Datos obligatorios.</label>
                                </div>   
                                <div class="form-group col-md-12 col-sm-12">     
                                    <label for="">Nombre*</label>
                                    <input type="text" class="form-control" id="nombre">
                                </div>
                                <!-- <div class="form-group col-md-12 col-sm-12">     
                                    <label for="">Descripción</label>
                                    <textarea id="descripcion" class="form-control"></textarea>
                                </div> -->
                                <!-- <div class="form-group col-md-6 col-sm-6">     
                                    <label for="">Cantidad*</label>
                                    <input type="text" class="form-control" id="cantidad">
                                </div> -->
                                <div class="form-group col-md-6 col-sm-6">     
                                    <label for="">Tipo*</label>
                                    <select id="tipo" class="form-control">
                                        
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">     
                                    <label for="">Unidad de medida*</label>
                                    <input type="text" class="form-control" id="unidad">
                                </div>
                                <div class="form-group col-md-6 col-sm-6">     
                                    <label for="">Ubicación*</label>
                                    <input type="text" class="form-control" id="ubicacion">
                                </div>
                                <div class="form-group col-md-6 col-sm-6">     
                                    <label for="">Proveedor</label>
                                    <input type="text" class="form-control" id="folio_prov">
                                </div>
                                <div class="form-group col-md-12 col-sm-12">     
                                    <label for="">Observaciones</label>
                                    <textarea id="observaciones" class="form-control"></textarea>
                                </div>
                                <div class="form-group col-md-12 col-sm-12" style="display: flex; justify-content: center; padding-top: 25px;">     
                                    <button class="btn btn-block" style="background-color: #063A5D; color: #fff;" onclick="validar();">Guardar</button>
                                </div>
                            </div>
                            <div id="div_form_tipo" class="form-group col-md-4 col-sm-4" style="display: none;">  
                                <div class="form-group col-md-12 col-sm-12">     
                                    <b style="font-size: 18px;">Tipos</b>
                                    <hr>
                                    <label for="">(*) Datos obligatorios.</label>
                                </div>

                                <div class="form-group col-md-12 col-sm-12">     
                                    <label for="">Nombre*</label>
                                    <input type="text" class="form-control" id="nombre_tipo">
                                </div>
                                <div class="form-group col-md-12 col-sm-12">     
                                    <label for="">Descripción</label>
                                    <textarea id="descripcion_tipo" class="form-control"></textarea>
                                </div>
                                
                                <div class="form-group col-md-12 col-sm-12" style="display: flex; justify-content: center; padding-top: 25px;">     
                                    <button class="btn btn-block" style="background-color: #063A5D; color: #fff;" onclick="guardar_tipo();">Guardar</button>
                                    
                                </div>
                            </div>
                            <div class="form-group col-md-8 col-sm-8" id="cont_tbl_prod">
                                <div class="form-group col-md-12 col-sm-12" style="text-align: right; margin-bottom: 15px;">
                                    <div class="btn-group">
                                        <input type="text" class="form-control" id="input_buscar_prod_alm_mat" placeholder="Buscar producto">
                                        <button onclick="buscar_prod_mat();" type="button" class="btn btn-dark" id="btn_buscar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button> 
                                        <button onclick="listar_productos_mat();" type="button" class="btn btn-dark" id="btn_buscar"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>                       
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12" id="content_tbl_prod"  style="overflow-y: scroll; height: 600px; padding-top: 15px;">
                                </div>
                            </div>
                            
                            <div class="form-group col-md-8 col-sm-8" id="content_tbl_tipo"  style="overflow-y: scroll; display: none;">
                                <table class="table table-hover table-fixed" style="width: 100%;">
                                    <thead>	
                                        <tr>
                                            <th><small><b>NOMBRE</b></small></th>
                                            <th><small><b>DESCRIPCION</b></small></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_tipos_met_prim">
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <div class="form-group col-md-12 col-sm-12">
                                            <label for="">Entradas y salidas</label>
                                </div>
                                <div class="form-group col-md-5 col-sm-5" style="overflow-y: scroll; height: 500px;">
                                        <div class="form-group col-md-12 col-sm-12">
                                                <label for="">ENTRADAS</label>
                                        </div>
                                        <table class="table table-hover table-fixed" style="width: 700px;">
                                            <thead>	
                                                <tr>
                                                    <th><small><b>ID</b></small></th>
                                                    <th><small><b>TIPO MOV.</b></small></th>
                                                    <th><small><b>NOMBRE</b></small></th>
                                                    <th><small><b>CANTIDAD</b></small></th>
                                                    <th><small><b>PROVEEDOR</b></small></th>
                                                    <th><small><b>LOTE</b></small></th>
                                                    <th><small><b>FECHA</b></small></th>
                                                    <th><small><b>OBSERVACIÓN</b></small></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_entradas_gen">
                                            </tbody>
                                        </table>
                                </div>
                                <div class="form-group col-md-7 col-sm-7" style="border-left: #ccc 1px solid; overflow-y: scroll; height: 500px;">
                                        <div class="form-group col-md-12 col-sm-12">
                                                <label for="">SALIDAS</label>
                                        </div>
                                        <table class="table table-hover table-fixed" style="width: 700px;">
                                            <thead>	
                                                <tr>
                                                    <th><small><b>ID</b></small></th>
                                                    <th><small><b>TIPO MOV.</b></small></th>
                                                    <th><small><b>NOMBRE</b></small></th>
                                                    <th><small><b>CANTIDAD</b></small></th>
                                                    <th><small><b>PROVEEDOR</b></small></th>
                                                    <th><small><b>LOTE</b></small></th>
                                                    <th><small><b>NO. CONTROL</b></small></th>
                                                    <th><small><b>OP</b></small></th>
                                                    <th><small><b>FECHA</b></small></th>
                                                    <th><small><b>OBSERVACIÓN</b></small></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_salidas_gen">
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group col-md-12 col-sm-12" id="div_ent_sal_prod_mat" style="display: none;">
                                <div class="form-group col-md-12 col-sm-12">
                                    <b>REGISTRAR ENTRADA/SALIDA</b>
                                </div>
                                <div class="form-group col-md-12 col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
                                    <div class="form-group col-md-8 col-sm-8">
                                        <button class="btn" style="background-color: #063A5D; color: #fff;" onclick="habilitar_edicion();">Ver/Editar</button>
                                        <button class="btn" style="background-color: #063A5D; color: #fff;" onclick="registrar_entrada();">Entrada</button>
                                        <button class="btn" style="background-color: #063A5D; color: #fff;" onclick="registrar_salida();">Salida</button>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                        <button class="btn" style="background-color: #038a5b; color: #fff;" onclick="back_list();">Ver lista</button>
                                    </div>
                                </div>
                                <div class="form-group col-md-9 col-sm-9" id="div_producto_alm_mat">
                                    <div class="form-group col-md-8 col-sm-8">
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control" id="nombre_select_prod" disabled>
                                        <input type="hidden" class="form-control" id="id_select_prod">
                                        <input type="hidden" class="form-control" id="unidad_medida">
                                    </div>
                                    <!-- <div class="form-group col-md-8 col-sm-8">
                                        <label for="">Descripción</label>
                                        <input type="text" class="form-control" id="descripcion_select_prod" disabled>
                                    </div> -->
                                    <div class="form-group col-md-4 col-sm-4">
                                        <label for="">Tipo</label>
                                        <!-- <input type="text" class="form-control" id="tipo_select_prod"> -->
                                        <select id="tipo_select_prod" class="form-control" disabled>
                                        
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                        <label for="">Ubicación</label>
                                        <input type="text" class="form-control" id="ubicacion_select_prod" disabled>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                        <label for="">ID</label>
                                        <input type="text" class="form-control" id="lote_select_prod" disabled>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                        <label for="">Folio (Proveedor):</label>
                                        <input type="text" class="form-control" id="folio_select_prod" disabled>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="">Observación</label>
                                        <input type="text" class="form-control" id="observacion_select_prod" disabled>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12" style="text-align: right;">
                                        <button id="btn_save_update_prod_almp" class="btn btn-primary" disabled onclick="update_producto();">Guardar</button>
                                    </div>
                                </div>

                                <div class="form-group col-md-9 col-sm-9" id="div_producto_alm_mat_ent">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <b>REGISTRAR ENTRADA</b>
                                    </div>
                                    <div class="form-group col-md-8 col-sm-8">
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control" id="nombre_entrada" disabled>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                        <label for="">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad_entrada">
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                        <label for="">Proveedor</label>
                                        <input type="text" class="form-control" id="proveedor_entrada">
                                    </div>
                                    <!-- <div class="form-group col-md-6 col-sm-6">
                                        <label for="">Lote (Proveedor/Interno)</label>
                                        <input type="text" class="form-control" id="lote_entrada">
                                    </div> -->
                                    <div class="form-group col-md-8 col-sm-8">
                                        <label for="">Observación (200 caracteres)</label>
                                        <input type="text" class="form-control" id="observ_entrada">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <button class="btn" style="background-color: #063A5D; color: #fff;" onclick="guardar_entrada();">Guardar Entrada</button>
                                    </div>
                                </div>
                                <div class="form-group col-md-9 col-sm-9" id="div_producto_alm_mat_sal">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <b>REGISTRAR SALIDA</b>
                                    </div>
                                    <div class="form-group col-md-8 col-sm-8">
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control" disabled id="nombre_salida">
                                    </div>
                                    <div class="form-group col-md-4 col-sm-4">
                                        <label for="">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad_salida">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label for="">Proveedor</label>
                                        <input type="text" class="form-control" id="proveedor_salida">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label for="">Lote (Proveedor/Interno)</label>
                                        <input type="text" class="form-control" id="lote_salida">
                                    </div>
                                    
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label for="">No. Control</label>
                                        <input type="number" class="form-control" id="no_control_salida">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label for="">No. OP</label>
                                        <input type="number" class="form-control" id="op_salida">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="">Observación (200 caracteres)</label>
                                        <input type="text" class="form-control" id="observ_salida">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <button class="btn" style="background-color: #063A5D; color: #fff;" onclick="guardar_salida();">Guardar Salida</button>
                                    </div>
                                </div>
                               
                                
                                <div class="form-group col-md-3 col-sm-3" style="text-align: center;">
                                    <p>Existencia</p>
                                    <p id="cantidad_select_prod" style="font-size: 50px;"></p>
                                </div>

                                <div class="form-group col-md-12 col-sm-12" id="div_registros">
                                    <div class="form-group col-md-12 col-sm-12">
                                            <label for="">Entradas y alidas de producto</label>
                                    </div>
                                    <div class="form-group col-md-5 col-sm-5" style="overflow-y: scroll; height: 500px;">
                                        <div class="form-group col-md-12 col-sm-12">
                                                <label for="">ENTRADAS</label>
                                        </div>
                                        <table class="table table-hover table-fixed" style="width: 700px;">
                                            <thead>	
                                                <tr>
                                                    <th><small><b>ID</b></small></th>
                                                    <th><small><b>TIPO MOV.</b></small></th>
                                                    <th><small><b>NOMBRE</b></small></th>
                                                    <th><small><b>CANTIDAD</b></small></th>
                                                    <th><small><b>PROVEEDOR</b></small></th>
                                                    <th><small><b>LOTE</b></small></th>
                                                    <th><small><b>FECHA</b></small></th>
                                                    <th><small><b>OBSERVACIÓN</b></small></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_entradas">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group col-md-7 col-sm-7" style="border-left: #ccc 1px solid; overflow-y: scroll; height: 500px;">
                                        <div class="form-group col-md-12 col-sm-12">
                                                <label for="">SALIDAS</label>
                                        </div>
                                        <table class="table table-hover table-fixed" style="width: 700px;">
                                            <thead>	
                                                <tr>
                                                    <th><small><b>ID</b></small></th>
                                                    <th><small><b>TIPO MOV.</b></small></th>
                                                    <th><small><b>NOMBRE</b></small></th>
                                                    <th><small><b>CANTIDAD</b></small></th>
                                                    <th><small><b>PROVEEDOR</b></small></th>
                                                    <th><small><b>LOTE</b></small></th>
                                                    <th><small><b>NO. CONTROL</b></small></th>
                                                    <th><small><b>OP</b></small></th>
                                                    <th><small><b>FECHA</b></small></th>
                                                    <th><small><b>OBSERVACIÓN</b></small></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_salidas">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12" id="div_reg_entradas">
                                   
                                    <div class="form-group col-md-12 col-sm-12" style="overflow-y: scroll; height: 500px;">
                                        <div class="form-group col-md-12 col-sm-12">
                                                <label for="">ENTRADAS</label>
                                        </div>
                                        <table class="table table-hover table-fixed">
                                            <thead>	
                                                <tr>
                                                    <th><small><b>ID</b></small></th>
                                                    <th><small><b>TIPO MOV.</b></small></th>
                                                    <th><small><b>NOMBRE</b></small></th>
                                                    <th><small><b>CANTIDAD</b></small></th>
                                                    <th><small><b>PROVEEDOR</b></small></th>
                                                    <th><small><b>LOTE</b></small></th>
                                                    <th><small><b>FECHA</b></small></th>
                                                    <th><small><b>OBSERVACIÓN</b></small></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_entradas_prod">
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                                <div class="form-group col-md-12 col-sm-12" id="div_reg_salidas">
                                   
                                    <div class="form-group col-md-12 col-sm-12" style="overflow-y: scroll; height: 500px;">
                                        <div class="form-group col-md-12 col-sm-12">
                                                <label for="">SALIDAS</label>
                                        </div>
                                        <table class="table table-hover table-fixed">
                                            <thead>	
                                                <tr>
                                                    <th><small><b>ID</b></small></th>
                                                    <th><small><b>TIPO MOV.</b></small></th>
                                                    <th><small><b>NOMBRE</b></small></th>
                                                    <th><small><b>CANTIDAD</b></small></th>
                                                    <th><small><b>PROVEEDOR</b></small></th>
                                                    <th><small><b>LOTE</b></small></th>
                                                    <th><small><b>NO. CONTROL</b></small></th>
                                                    <th><small><b>OP</b></small></th>
                                                    <th><small><b>FECHA</b></small></th>
                                                    <th><small><b>OBSERVACIÓN</b></small></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_salidas_prod">
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                        </div>
                    </div>
                </div>
            
    
            </div>


          </div>
        </div>
        <!-- /page content -->

        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_coin">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Coincidencias encontradas</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-md-12 col-sm-12" style="height: 200px; overflow-y: scroll;">
                            <table class="table table-hover table-fixed">
                                <thead>	
                                    <tr>
                                        <th><small><b>NOMBRE</b></small></th>
                                                   
                                    </tr>
                                </thead>
                                <tbody id="tbl_coin_prod_alm_mp">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Corregir</button> 
                        <button type="button" class="btn btn-primary" onclick="guardar_producto();">Guardar producto</button>  
                    </div>

                </div>
            </div>
        </div> 


      </div>
    </div> 

    <style>
        .estilo_prod_mat{
            box-shadow: 5px 5px 10px rgba(0,0,0,0.2); 
            padding: 10px; 
            margin-top: 15px;
            background-color: #fff;
            cursor: pointer;
            transition: all 0.2s;
        }

        .estilo_prod_mat:hover{
            box-shadow: 5px 5px 10px rgba(0,0,0,0.2); 
            padding: 10px; 
            margin-top: 10px;
            background-color: #F1F3F5;
            cursor: pointer;
            transition: all 0.2s;
        }
    </style>
    


               
                  

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
    <script type="text/javascript" src="scripts/alm_mat_prima.js?v=<?php echo(rand()); ?>"></script>
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