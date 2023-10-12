<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: ../login.html");
}
else
{
require 'header.php';
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1)
{
?>
<!--Contenido-->

    

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                        
                         <input type="hidden" class="form-control" name="f_actual" id="f_actual">
                          <h1 class="box-title">VENTAS</h1>
                        <div class="box-tools pull-right">
                          <h3 id="v_fecha_hora"></h3>
                          
                        </div>
                        
                        
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="form-group col-md-12 col-sm-12">
                      <button id="btn_reg" type="button" class="btn btn-primary" onclick="verform_reg();">Registrar venta</button>
                      <button id="btn_atras" type="button" class="btn btn-primary" onclick="vertabla();">Regresar</button>
                    </div>
                    
                    


                    <div class="panel-body table-responsive" id="listadoregistros">
                      <div class="form-group col-md-12 col-sm-12">
                                <label>Año:</label>
                                <select id="anio_grafica" class="form-control selectpicker" onchange="grafico();">
                                   <option value="2021">2021</option>
                                   <option value="2020">2020</option>

                                     
                                </select>
                                             
                      </div>
                      <div class="form-group col-md-12 col-sm-12">
                        <canvas id="line-chart" width="800" height="450"></canvas>
                      </div>
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">

                          <thead>
                            <th>Opciones</th>
                            <th>Folio</th>
                            
                            <th>Cliente</th>
                           
                            
                            <th>Descripción</th>
                            <th>Monto Total</th>
                            <th>Fecha/Hora</th>
                            <th>Estatus</th>
                            
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                            <th>Opciones</th>
                            <th>Folio</th>
                           
                            <th>Cliente</th>
                         
                            
                            <th>Descripción</th>
                            <th>Monto Total</th>
                            <th>Fecha/Hora</th>
                            <th>Estatus</th>
                          
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body table-responsive" id="nuevoregistro">

                        <div class="form-group col-md-12 col-sm-12">
                            
                            <h1 id="folio"></h1>
                                         
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                          <div class="form-group col-md-12 col-sm-12">
                            <label>Cliente:<a href="#" onclick="abrirmodal_newcli();"> Registrar nuevo</a></label>
                            <select id="idcliente" name="idcliente" class="form-control selectpicker" data-live-search="true" onchange="limpiar();"></select>
                          </div>
                          <div class="form-group col-md-12 col-sm-12">
                                <label>Fecha de venta:</label>
                                <input type="date" class="form-control" name="fecha_venta" id="fecha_venta" required>              
                            </div>
                        </div>

                        <!--<div class="form-group col-md-10 col-sm-12">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" name="email" id="email">              
                        </div>-->

                        
                        <div class="form-group col-md-6 col-sm-12">
                            <div class="form-group col-md-12 col-sm-12">
                                <label>Forma de pago:</label>
                                <select name="v_forma_pago" id="v_forma_pago" class="form-control selectpicker"  required>
                                   <option value="">Seleccionar</option>
                                   <option value="Efectivo">Efectivo</option>
                                   <option value="Debito">Tarjeta de debito</option>
                                   <option value="Credito">Tarjeta de credito</option>
                                   <option value="Cheque">Cheque</option>
                                   <option value="Deposito">Deposito</option> 
                                   <option value="Transferencia">Transferencia</option>  
                                </select>
                                             
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label>Banco:</label>
                                <!--<input type="text" class="form-control" name="v_banco" id="v_banco">-->
                                <select name="v_banco" id="v_banco" class="form-control selectpicker"  required>
                                   <option value="">Seleccionar</option>
                                   <option value="BBVA Bancomer">BBVA Bancomer</option>
                                   <option value="Santander">Santander</option>
                                   <option value="CitiBanamex">CitiBanamex</option>
                                   <option value="HSBC">HSBC</option>
                                   <option value="Scotiabank">Scotiabank</option> 
                                   <option value="Inbursa">Inbursa</option> 
                                   <option value="Banco del Bajío">Banco del Bajío</option> 
                                   <option value="Banco Azteca">Banco Azteca</option> 
                                   <option value="JP Morgan">JP Morgan</option>
                                   <option value="Otro">Otro</option> 
                                </select>           
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label>Numero de referencia:</label>
                                <input type="text" class="form-control" name="v_ref" id="v_ref" required>              
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label>Comprobante (PDF):</label>
                                <div class="form-group col-md-12 col-sm-12" style="border-style: solid; border-width: 1px; border-color: #cccccc">
                                    <br>
                                    <input type="hidden" class="form-control" name="v_comp" id="v_comp" required>  

                                        <form name="formulario-envia_comprobante" id="formulario-envia_comprobante" enctype="multipart/form-data" method="post">
                                            <div class="form-group col-md-10 col-sm-12">
                                              <input type="file" name="ar_comprob" id="ar_comprob" onchange="" >
                                              
                                            </div>
                                            <div class="form-group col-md-2 col-sm-12">
                                              <button id="btn_comprob" type="button" class="btn btn-primary" onclick="subir_comprobante();">Cargar</button>
                                               <button id="btn_comprob2" type="button" class="btn btn-primary" onclick="mostrar_comprobante();">Ver</button>
                                            </div> 
                                              
                                                                                                        
                                        </form>

                                </div>

                            </div>
                                

                            
                                









                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="form-group col-md-12 col-sm-12">
                                <!--<label>Descripcion:</label>
                                <input type="text" class="form-control" name="v_descripcion" id="v_descripcion">-->
                                <label>Descripcion:</label>
                                <textarea  cols="25" rows="5" class="form-control" name="v_descripcion" id="v_descripcion" disabled></textarea>           
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label>Comentario:</label>
                                <textarea  cols="25" rows="6" class="form-control" name="v_coment" id="v_coment"></textarea>               
                            </div>
                           
                        </div>

                        
                        
                        <!--<div class="form-group col-md-6 col-sm-12">
                            <label>Total pago:</label>
                            <input type="text" step="any" class="form-control" name="v_total_pago" id="v_total_pago">              
                        </div>-->
                            
                        
                        
                        <!--<div class="form-group col-md-6 col-sm-12">
                            <label>Estatus:</label>
                            <input type="number" class="form-control" name="v_estatus" id="v_estatus">              
                        </div>-->
                       

                       

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    
                            <a data-toggle="modal" href="#myModal_prod">           
                              <button id="" type="button" class="btn btn-success" onclick="listarProd();"> <span class="fa fa-plus"></span>Agregar producto</button>
                            </a>                   
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="tbllistado_prod" class="table table-striped table-bordered table-condensed table-hover">

                                          <thead style="background-color:#042B66">

                                            <!--<th style="color:#000000"></th>-->
                                              <th colspan="2" style="color:#FFFFFF">Opciones</th>
                                              
                                              <th style="color:#FFFFFF">Imagen</th>
                                              <th style="color:#FFFFFF">Codigo</th>
                                              <th style="color:#FFFFFF">Nombre</th>
                                              <th style="color:#FFFFFF">Precio Unitario</th>
                                              <!--<th style="color:#FFFFFF">Color</th>-->
                                              <th style="color:#FFFFFF">Cantidad</th>
                                              <th style="color:#FFFFFF">Subtotal</th>
                                             
                                          </thead>
           
                                          <tbody>
                                              <tfoot>
                                              <td align="right" colspan="6"><button type="button" onclick="calcularsub();" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>
                                              <th class="text-right"><h4>TOTAL: $</h4></th>
                                              <th><h4 id="total">0.00</h4></th> 
                                              
                                          </tfoot>
                                          </tbody>
                                      </table>
                                 
                            </table>
                        </div>

                        <div class="form-group col-md-12 col-sm-12">
                            <h5 id="num_prod"></h5>
                            <h5 id="cont_prod" style="visibility: hidden;"></h5>
                        </div>
                        
                            
                        <div class="form-group col-md-12 col-sm-12" align="right">
                        
                              
                         <!-- <button id="btn_reg" type="button" class="btn btn-primary" onclick="pruebasave();">Registrar venta</button>-->
                          <button id="btn_reg" type="button" class="btn btn-primary" onclick="valid_banco();">Registrar venta</button>
                        </div>

                        


                    </div>

                    
                    
                   
                    
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  
  <!-- Modal -->
  <div class="modal fade" id="myModal_prod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width: 50% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Lista de productos</h4>
        </div>
        
        <div  style="height: 300px;" id="listaproductos">

            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="overflow:scroll;height:600px;width:100%;">
              <table id="tbl_prod" class="table table-striped table-bordered table-condensed table-hover">
                  <thead>
                      <th>Agregar</th>
                      <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Existencia</th>
                      <th>Imagen</th>
                  </thead>
                  <tbody>
                                          
                  </tbody>
                  <tfoot>
                      <th>Agregar</th>
                      <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Existencia</th>
                      <th>Imagen</th>
                  </tfoot>
              </table>
            </div>
              
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->



  <!-- Modal -->
  <div class="modal fade" id="myModal_new_cli" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width: 80% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">NUEVO CLIENTE</h4>
        </div>
        
                  <div class="form-group col-md-12 col-sm-12">
                      
                        <div class="form-group col-md-2 col-sm-2">
                            <label>No. Cliente(*):</label>
                            <input type="text" class="form-control" name="num_cliente_new" id="num_cliente_new">              
                        </div>
                        <div class="form-group col-md-10 col-sm-10">
                            <label>Nombre(*):</label>
                            <input type="text" class="form-control" name="nombre_new" id="nombre_new">              
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                            <label>Email:</label>
                            <input type="text" class="form-control" name="email_new" id="email_new">              
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                            <label>Telefono:</label>
                            <input type="text" class="form-control" name="telefono_new" id="telefono_new">              
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                            <label>RFC:</label>
                            <input type="text" class="form-control" name="rfc_new" id="rfc_new">              
                        </div>
                        <div class="form-group col-md-12 col-sm-4">
                            <h3>Dirección:</h3>            
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                            <label>Calle:</label>
                            <input type="text" class="form-control" name="calle_new" id="calle_new">              
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                            <label>Numero:</label>
                            <input type="number" class="form-control" name="numero_new" id="numero_new">              
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                            <label>Interior:</label>
                            <input type="text" class="form-control" name="interior_new" id="interior_new">              
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                            <label>Colonia:</label>
                            <input type="text" class="form-control" name="colonia_new" id="colonia_new">              
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                            <label>Municipio:</label>
                            <input type="text" class="form-control" name="municipio_new" id="municipio_new">              
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                            <label>Estado:</label>
                            <input type="text" class="form-control" name="estado_new" id="estado_new">              
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <label>Referencia:</label>
                            <input type="text" class="form-control" name="referencia_new" id="referencia_new">              
                        </div>
                       

                        <div class="form-group col-md-12 col-sm-12">
                            <button id="" type="button" class="btn btn-primary" onclick="guardar_cliente();">Guardar</button>
                                                             
                        </div>
                                
                  </div>
                        

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  <script type="text/javascript">
    function abrirmodal_newcli()
    {
      $("#myModal_new_cli").modal("show");
    }
  </script>
  <!-- Fin modal -->


   <!-- Modal -->
  <div class="modal fade" id="myModal_vista_comp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width: 80% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          
        </div>
        
        <div class="form-group col-md-12 col-sm-12" align="center">
          <embed src="" type="application/pdf" width="1000" height="500" id="docview">
        </div>
        

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->

  <!-- Modal -->
  <div class="modal fade" id="myModal_vista_venta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:auto;width:auto;">
    <div class="modal-dialog" style="width: 80% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <div class="form-group col-md-12 col-sm-12">
            <h2>DETALLE DE VENTA</h2>
          </div>


                      <div class="form-group col-md-3 col-sm-12">
                            
                            <div class="form-group col-md-12 col-sm-12">

                              <div class="form-group col-md-12 col-sm-12">
                                <label>FOLIO</label>
                                <h5 id="c_folio"></h5>
                                <label>NO.</label>
                                <h5 id="c_no_cliente"></h5>
                                <label>NOMBRE</label>
                                <h5 id="c_cliente"></h5>
                                
                              </div>
                            </div>

                            
                      </div>

                      <div class="form-group col-md-3 col-sm-12">
                              <div class="form-group col-md-12 col-sm-12">
                                    <label>FORMA DE PAGO</label>
                                    <h5 id="c_forma_pago"></h5>
                                    <label>BANCO</label>
                                    <h5 id="c_banco"></h5>
                                    <label>NUMERO DE REFERENCIA</label>
                                    <h5 id="c_referencia"></h5>               
                              </div>
                      </div>

                      <div class="form-group col-md-6 col-sm-12">
                            

                            <div class="form-group col-md-12 col-sm-12">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label>DESCRIPCIÓN GENERAL</label>
                                    <h5 id="c_descripcion"></h5>               
                                </div>
                                    
                                             
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label>COMENTARIO</label>
                                    <!--<h5 id="c_comentario"></h5>-->
                                   
                                    <textarea  cols="25" rows="4" class="form-control" name="c_comentario" id="c_comentario"></textarea>               
                                </div>
                           
                            </div>
                           

                      </div>    
                            
                      <div class="form-group col-md-12 col-sm-12" align="center">
                                <button id="" type="button" class="btn btn-primary" onclick="update_coment();">Actualizar</button>                                  
                      </div>
                      <div class="form-group col-md-12 col-sm-12" align="left">
                            <div class="form-group col-md-12 col-sm-12">
                              <label>COMPROBANTE</label>
                              <embed src="" type="application/pdf" width="100%" height="300px" id="docview2">
                            </div>
                      </div>

                      

        </div>          

        

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->
  

  

  

<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="../../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../../public/js/moment.min.js"></script>
<script type="text/javascript" src="../../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/ventas.js?v=<?php echo(rand()); ?>"></script>

<?php 
}
ob_end_flush();
?>