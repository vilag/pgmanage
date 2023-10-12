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


        <!-- page content -->
        <div class="right_col" role="main" id="page_pedido">

          <div class="">
            
            <div class="clearfix"></div>

          
            <div class="row" id="select_product_area">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
               

                                <div class="x_content">

                                          <div class="row" id="">
                                            <div class="col-md-12 col-sm-12">
                                                  
                                                  
                                                  <div class="col-md-12 col-sm-12" id="consuta_productos">
                                                    
                                                    <div class="col-md-12 col-sm-12">
                                                      <div class="col-md-8 col-sm-8">
                                                        <div class="form-group col-lg-3 col-md-2 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
                                                                    
                                                                    <select id="select_busqueda_tipo" class="form-control selectpicker" onchange="listar_modelos();" style="border-style: none; border-bottom: ridge; font-size: 12px;">    
                                                                    </select>  
                                                        </div>
                                                        <div class="form-group col-lg-3 col-md-2 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
                                                                  
                                                                  <select id="select_busqueda_modelo" class="form-control selectpicker" onchange="listar_tamanios();" style="border-style: none; border-bottom: ridge; font-size: 12px;">    
                                                                  </select>  
                                                        </div>
                                                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            
                                                                    <input type="text" id="buscar_prod_fil" placeholder="Codigo" style="border-style: none; border-bottom: groove;">
                                                                    <button  type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Buscar" onclick="listar_productos_busqueda();"><span class="glyphicon glyphicon-search" aria-hidden="true" style="color: black;"></span></button>
                                                            
                                                        </div>
                                                      
                                                      </div>  
                                                      <div class="col-md-4 col-sm-4">
                                                          
                                                      </div>
                                                
                                                        
                                                    </div>
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                          
                                                          
                                                          <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height: 400px; width: 100%;">
                                                            <label id="cant_encontrados"></label>
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="tbl_result_prod_consul" style="width: 100%;">
                                                            </div>
                                                            
                                                          </div>
                                                        </div>
                                                        <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                          <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
                                                                   
                                                                    <select id="select_busqueda_tamano" class="form-control selectpicker" onchange="listar_colores();" style="border-style: none; border-bottom: ridge; font-size: 12px;">    
                                                                    </select>  
                                                          </div>

                                                          <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
                                                                   
                                                                    <select id="select_busqueda_color" class="form-control selectpicker" onchange="" style="border-style: none; border-bottom: ridge; font-size: 12px;">    
                                                                    </select>  
                                                          </div>
                                                          
                                                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background: grey; height: 350px;">
                                                          </div>
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12">
                                                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                                            <textarea class="form-control"  id="" rows="2" placeholder="Nombre del producto"></textarea>
                                                          </div>
                                                    </div>
                                                    
                                                  </div>

                                                
                                                  
                                            </div>
                                            

                                          </div>          




                                      

                    
                             


                </div>
              </div>
            </div>

 


          </div>


          



        </div>
        <!-- /page content -->    

      </div>
    </div> 

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_detalle_productos">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Detalle de productos</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">

                            

                            <!--<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Tipo:</label>
                                <select  class="form-control" id="tipo_prod">
                                  <option value="">Seleccionar</option>
                                  <option value="5">Accesorio</option>
                                  <option value="3">Mesa</option>
                                  <option value="1">Pizarrón</option>
                                  <option value="7">Plásticos</option>
                                  <option value="2">Silla</option>
                                  <option value="4">Vitrina</option>
                                  <option value="6">Otro</option>
                                </select>
                                
                            </div>-->
                           
                            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>TIPO:</label>
                                <input type="text" class="form-control" id="tipo_prod" disabled="">
                                <input type="hidden" class="form-control" id="idproducto" disabled="">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>CODIGO:</label>
                                <input type="text" class="form-control" id="codigo" disabled="">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>NOMBRE:</label>
                                <input type="text" class="form-control" id="nombre">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>COLOR:</label>
                                <input type="text" class="form-control" id="color">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>MEDIDA:</label>
                                <input type="text" class="form-control" id="medidas">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" id="caja_precio">
                                <label>PRECIO (SIN IVA):</label>
                                <input type="text" class="form-control" id="precio" disabled="">
                            </div>
                            

                          


                        </div>
                        <div class="modal-footer">
                         <!-- <button id="btn_save_prod" type="button" class="btn btn-primary" onclick="actualizar_producto();">GUARDAR</button>-->
                          

                          
                        </div>

                      </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_nuevo_producto">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Nuevo producto</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                           
                          <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 300px;">
                            <div class="col-md-12 col-sm-12">
                                <label>Tipo</label>
                                <select id="select_busqueda_tipo_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>SubTipo</label>
                                <select id="select_busqueda_subtipo_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>Modelo</label>
                                <select id="select_busqueda_modelo_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>SubModelo</label>
                                <select id="select_busqueda_submodelo_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>Tamaño</label>
                                <select id="select_busqueda_tamano_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>Color</label>
                                <select id="select_busqueda_color_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            
                            <div class="col-md-12 col-sm-12">
                                <label>Paleta</label>
                                <select id="select_busqueda_paleta_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>Especificaciones</label>
                                <select id="select_busqueda_especif_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>Especificaciones 2</label>
                                <select id="select_busqueda_especif2_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>Especificaciones 3</label>
                                <select id="select_busqueda_especif3_nuevo" class="form-control selectpicker" onchange="">    
                                </select>  
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12">
                            <div class="col-md-12 col-sm-12">
                                <input type="number" class="form-control" id="idprod_tipo" value="0">
                                <input type="number" class="form-control" id="idprod_tipo2" value="0">
                                <input type="number" class="form-control" id="idprod_modelo" value="0">
                                <input type="number" class="form-control" id="idprod_modelo2" value="0">
                                <input type="number" class="form-control" id="idprod_tamano" value="0"> 
                                <input type="number" class="form-control" id="idprod_color" value="0">
                                <input type="number" class="form-control" id="idprod_paleta" value="0">
                                <input type="number" class="form-control" id="idprod_especif" value="0">
                                <input type="number" class="form-control" id="idprod_especif2" value="0">
                                <input type="number" class="form-control" id="idprod_especif3" value="0"> 
                            </div>
                          </div> 
                            
                        </div>
                        <div class="modal-footer">
                         <!-- <button id="btn_save_prod" type="button" class="btn btn-primary" onclick="actualizar_producto();">GUARDAR</button>-->
                          

                          
                        </div>

                      </div>
      </div>
    </div>


    
              

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
    <script type="text/javascript" src="scripts/nuevo_pedido.js?v=<?php echo(rand()); ?>"></script>
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