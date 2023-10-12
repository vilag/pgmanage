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
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['agente_ventas2']==1)
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
                          <h1 class="box-title">PEDIDOS</h1>
                        <div class="box-tools pull-right">
                          <h3 id="v_fecha_hora"></h3>
                          
                        </div>
                        
                        
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    
                    
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <div class="form-group col-md-12 col-sm-12">
                          <button id="btn_reg" type="button" class="btn btn-primary" onclick="abrir_newpedido();">NUEVO PEDIDO</button>
                          
                        </div>
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">

                          <thead>
                            <th>Opciones</th>
                            <th>No. de Control</th>
                            <th>Cliente</th>
                            <th>Fecha de pedido</th>
                            <th>Fecha estimada de entrega</th>
                            
                            <th>Estatus</th>
                            
                            
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>

                            <th>Opciones</th>
                            <th>No. de Control</th>
                            <th>Cliente</th>
                            <th>Fecha de pedido</th>
                            <th>Fecha estimada de entrega</th>
                            
                            <th>Estatus</th>
                          
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body table-responsive" id="nuevoregistro">
                        <div class="form-group col-md-12 col-sm-12">
                          <button id="btn_reg" type="button" class="btn btn-primary" onclick="abrir_listado();">REGRESAR</button>
                          
                        </div>
                      
                        <div class="form-group col-md-12 col-sm-12">
                          <br>
                          <div class="form-group col-md-4 col-sm-12">
                                <label>No. pedido:</label>
                                <input type="text" class="form-control" name="ctrl_ped" id="ctrl_ped" disabled=""> 
                                             
                          </div>

                          <div class="form-group col-md-8 col-sm-12">
                            <label>Cliente:<a href="#" onclick="nuevo_cliente();"> Nuevo cliente</a></label>
                            <select id="idcliente" name="idcliente" class="form-control selectpicker" data-live-search="true" onchange=""></select>
                          </div>
                          <div class="form-group col-md-6 col-sm-12">
                            <label>Fecha de pedido:</label>
                            <input type="date" class="form-control" name="f_pedido" id="f_pedido"> 
                          </div>
                          <div class="form-group col-md-6 col-sm-12">
                            <label>Fecha estimada de entrega:</label>
                            <input type="date" class="form-control" name="f_est_entrega" id="f_est_entrega"> 
                          </div>
                          <div class="form-group col-md-12 col-sm-12">
                            <label>Lugar de entrega:</label>
                            <input type="text" class="form-control" name="lugar_entrega" id="lugar_entrega"> 
                          </div>
                          <div class="form-group col-md-12 col-sm-12" align="right">
                            <button id="" type="button" class="btn btn-primary" onclick="guardar_pedido();" >Guardar</button>
                          </div>
                          
                        </div>

                        <!--<div class="form-group col-md-12 col-sm-12">
                            
                           
                            <div class="form-group col-md-12 col-sm-12">
                                <label>Comprobante (PDF):</label>
                                <div class="form-group col-md-12 col-sm-12" style="border-style: solid; border-width: 1px; border-color: #cccccc">
                                    <br>
                                    <input type="hidden" class="form-control" name="v_comp" id="v_comp" required>  

                                        <form name="formulario-envia_documento" id="formulario-envia_documento" enctype="multipart/form-data" method="post">
                                            <div class="form-group col-md-6 col-sm-12">
                                              <input type="file" name="ar_comprob" id="ar_comprob" onchange="">
                                              <input type="hidden" name="idpedido" id="idpedido">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12" align="right">
                                              <button id="btn_comprob" type="button" class="btn btn-primary" onclick="subir_documento();">Subir archivo</button>
                                               
                                            </div> 
                                                            
                                        </form>

                                </div>
                                <h5 id="confirm_arch" style="color: green;"></h5><h5 id="ver_arch"><a id="" href="#" onclick=""> Ver</a></h5>
                               

                            </div>
                                

                        </div>-->

                        

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        
                          <h4>Lista de productos</h4>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">                                    
                            <a data-toggle="modal" href="#myModal_regprod">           
                              <button id="btn_new_prod" type="button" class="btn btn-success" onclick=""> <span class="fa fa-plus"></span></button>
                            </a>                   
                          </div>
                                      <table id="tbllistado_prod" class="table table-striped table-bordered table-condensed table-hover">

                                          <thead style="background-color:#042B66">

                                            <!--<th style="color:#000000"></th>-->
                                              <th colspan="2" style="color:#FFFFFF">Opciones</th>
                                              
                                              <th style="color:#FFFFFF">Control de pedidos</th>
                                              <th style="color:#FFFFFF">No. Pedido</th>
                                              <th style="color:#FFFFFF">OP</th>
                                              <th style="color:#FFFFFF">Clave de prod.</th>
                                              <th style="color:#FFFFFF">Producto</th>
                                              <th style="color:#FFFFFF">Cantidad Solicitada</th>
                                              
                                              <th style="color:#FFFFFF">Estatus</th>

                                             
                                          </thead>
           
                                          <tbody>
                                          <tfoot>
                                              
                                              
                                          </tfoot>
                                          </tbody>
                                      </table>
                                 
                           
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <h4>Lista de envíos</h4>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">                                    
                            <a data-toggle="modal" href="#myModal_detenv">           
                              <button id="" type="button" class="btn btn-success" onclick="listar_prod_select();"> <span class="fa fa-plus"></span></button>
                            </a>                   
                          </div>
                        
                          
                                      <table id="tbllistado_entregas" class="table table-striped table-bordered table-condensed table-hover">

                                          <thead style="background-color:#042B66">

                                            <!--<th style="color:#000000"></th>-->
                                              <th colspan="2" style="color:#FFFFFF">Opciones</th>
                                              
                                              <th style="color:#FFFFFF">No. de salida</th>
                                              <th style="color:#FFFFFF">Forma</th>  
                                              <th style="color:#FFFFFF">Fecha/hora-salida</th>
                                              <th colspan="4" style="color:#FFFFFF">Estatus</th>
                                            
                                              
                                              

                                             
                                          </thead>
           
                                          <tbody>
                                          <tfoot>
                                              
                                              
                                          </tfoot>
                                          </tbody>
                                      </table>
                                 
                           
                        </div>
                        
                        

    
                        <div class="form-group col-md-12 col-sm-12" align="right">
                          <button id="btn_reg" type="button" class="btn btn-primary" onclick="">Finalizar</button>
                          
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
  <div class="modal fade" id="myModal_regprod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:auto;width:auto;">
    <div class="modal-dialog" style="width: 80% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <div class="form-group col-md-12 col-sm-12">
            <h3>AGREGAR PRODUCTO</h3>
          </div>
                    
                      <div class="form-group col-md-12 col-sm-12">
                        <h4>REGISTRO</h4>
                      </div>
                      <div class="form-group col-md-4 col-sm-12">    
                            <label>No. pedido:</label>
                            <input type="text" class="form-control" name="ctrl_pedid_a" id="ctrl_pedid_a" disabled="">  
                      </div>
                      <div class="form-group col-md-4 col-sm-12">    
                            <label>No. de pedido:</label>
                            <input type="text" class="form-control" name="no_pedid_a" id="no_pedid_a">  
                      </div>
                      <div class="form-group col-md-4 col-sm-12">    
                            <label>Orden de producción</label>
                            <input type="text" class="form-control" name="ord_prod_a" id="ord_prod_a">  
                      </div>
                      
                  
                      <div class="form-group col-md-12 col-sm-12">
                        <h4>PRODUCTO</h4>
                      </div>
                      <div class="form-group col-md-2 col-sm-12">    
                            <label>Clave</label>
                            <input type="text" class="form-control" name="clave_a" id="clave_a">  
                      </div>
                      <div class="form-group col-md-10 col-sm-12">    
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="nombre_a" id="nombre_a">  
                      </div>
                      <div class="form-group col-md-2 col-sm-12">    
                            <label>Cantidad solicitada</label>
                            <input type="text" class="form-control" name="cant_solic_a" id="cant_solic_a">  
                      </div>

                      <hr width="100%">
                     

                      

                      

                      

        </div>          

        

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="guardar_producto();">Agregar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->


  <!-- Modal -->
  <div class="modal fade" id="myModal_detped" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:auto;width:auto;">
    <div class="modal-dialog" style="width: 80% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <div class="form-group col-md-12 col-sm-12">
            <h3>DETALLE DE PEDIDO</h3>
          </div>
                    
                      <div class="form-group col-md-12 col-sm-12">
                        <h4>REGISTRO</h4>
                        <h4 id="control_ped"></h4>
                      </div>
                      <div class="form-group col-md-2 col-sm-12">
                        <label>Clave de producto:</label>
                           
                        <input type="text" class="form-control" name="" id="cve_prod">    
                      </div>
                      <div class="form-group col-md-10 col-sm-12"> 
                        <label>Nombre:</label>
                       
                        <input type="text" class="form-control" name="" id="produ">    
                      </div>
                      <div class="form-group col-md-4 col-sm-12"> 
                        <label>Cantidad solicitada:</label>
                        
                        <input type="text" class="form-control" name="" id="cant_sol"> 
                      </div>
                      <div class="form-group col-md-4 col-sm-12"> 
                        <label>No. Pedido:</label>
                        
                        <input type="text" class="form-control" name="" id="no_ped">
                      </div>
                      <div class="form-group col-md-4 col-sm-12"> 
                        <label>Orden de produccón:</label>
                        
                        <input type="text" class="form-control" name="" id="or_prod"> 
                      </div>

                     
                      <!--<div class="form-group col-md-4 col-sm-12">    
                            <label>No. de pedido:</label>
                            <input type="text" class="form-control" name="no_pedid_c" id="no_pedid_c">  
                      </div>
                      <div class="form-group col-md-4 col-sm-12">    
                            <label>Orden de producción</label>
                            <input type="text" class="form-control" name="ord_prod_c" id="ord_prod_c">  
                      </div>
                      
                  
                      <div class="form-group col-md-12 col-sm-12">
                        <h4>PRODUCTO</h4>
                      </div>
                      <div class="form-group col-md-2 col-sm-12">    
                            <label>Clave</label>
                            <input type="text" class="form-control" name="clave_c" id="clave_c">  
                      </div>
                      <div class="form-group col-md-10 col-sm-12">    
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="nombre_c" id="nombre_c">  
                      </div>
                      <div class="form-group col-md-2 col-sm-12">    
                            <label>Cantidad solicitada</label>
                            <input type="text" class="form-control" name="cant_solic_c" id="cant_solic_c">  
                      </div>-->
                      <div class="form-group col-md-12 col-sm-12">    
                            <label>Tipo de empaque</label>
                            <input type="text" class="form-control" name="tipo_empa_c" id="tipo_empa_c">  
                      </div>
                      <div class="form-group col-md-12 col-sm-12">
                        <h4>DATOS DE ENTREGA Y RECEPCIÓN</h4>
                      </div>

                      <div class="form-group col-md-2 col-sm-12">    
                            <label>No. de salida</label>
                            <input type="text" class="form-control" name="no_salid_c" id="no_salid_c">  
                      </div>
                      <div class="form-group col-md-10 col-sm-12">    
                            <label>Medio de envío</label>
                            <input type="text" class="form-control" name="medio_env_c" id="medio_env_c">  
                      </div>
                      
                      <div class="form-group col-md-12 col-sm-12">    
                            <label>Lugar</label>
                            <input type="text" class="form-control" name="lugar_c" id="lugar_c">  
                      </div>
                      <div class="form-group col-md-3 col-sm-12">    
                            <label>Fecha</label>
                            <input type="text" class="form-control" name="fecha_c" id="fecha_c">  
                      </div>
                      <div class="form-group col-md-3 col-sm-12">    
                            <label>Hora</label>
                            <input type="text" class="form-control" name="hora_c" id="hora_c">  
                      </div>
                      <div class="form-group col-md-6 col-sm-12">    
                            <label>Entregado a</label>
                            <input type="text" class="form-control" name="entregado_a_c" id="entregado_a_c">  
                      </div>
                      
                      <div class="form-group col-md-4 col-sm-12">    
                            <label>Cantidad entregada</label>
                            <input type="text" class="form-control" name="cant_entr_c" id="cant_entr_c">  
                      </div>
                      <div class="form-group col-md-4 col-sm-12">    
                            <label>Monto sin IVA</label>
                            <input type="number" class="form-control" name="monto1_c" id="monto1_c">  
                      </div>
                      <div class="form-group col-md-4 col-sm-12">    
                            <label>Monto con IVA</label>
                            <input type="number" class="form-control" name="monto2_c" id="monto2_c">  
                      </div>
                      <div class="form-group col-md-12 col-sm-12">    
                            <label>Comentario</label>
                            <input type="text" class="form-control" name="coment_c" id="coment_c">  
                      </div>

                      

                      

                      

        </div>          

        

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="">Guardar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->
  

  

  <!-- Modal -->
  <div class="modal fade" id="myModal_detenv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:auto;width:auto;">
    <div class="modal-dialog" style="width: 90% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <div class="form-group col-md-12 col-sm-12">
            <h3>REGISTRAR ENVÍO</h3>
          </div>
                      <div class="form-group col-md-12 col-sm-12">
                        <label>No. de pedido</label>
                        <h4 id="idctrl_p"></h4> 
                      </div>
                      
                      <div class="form-group col-md-2 col-sm-12">
                        <label>No. de salida:</label>
                           
                        <input type="text" class="form-control" name="no_salid_env" id="no_salid_env">    
                      </div>
                      <div class="form-group col-md-4 col-sm-12"> 
                        <label>Modo de envío:</label>
                       
                        <input type="text" class="form-control" name="modo_env" id="modo_env">    
                      </div>
                      <div class="form-group col-md-3 col-sm-12"> 
                        <label>Fecha/hora de salida:</label>
                        
                        <input type="date" class="form-control" name="fec_hr_env" id="fec_hr_env"> 
                      </div>
                      <div class="form-group col-md-3 col-sm-12"> 
                        <label>Fecha de entrega estimada:</label>
                        
                        <input type="date" class="form-control" name="fec_hr_entr" id="fec_hr_entr">
                      </div>
                      <div class="form-group col-md-12 col-sm-12"> 
                        <label>Lugar de entrega:</label>
                        
                        <input type="text" class="form-control" name="lugar_entr_env" id="lugar_entr_env"> 
                      </div>
                      <div class="form-group col-md-6 col-sm-12"> 
                        <label>Fecha/hora de entrega real:</label>
                        
                        <input type="date" class="form-control" name="lugar_entr_env_real" id="lugar_entr_env_real">
                      </div>
                      <div class="form-group col-md-6 col-sm-12">
                        <label>Quien recibió:</label>
                        
                        <input type="text" class="form-control" name="persona_recibe" id="persona_recibe"> 
                      </div>

                      
                      <div class="form-group col-md-12 col-sm-12">
                        <h4>Agregar productos</h4>
                      </div>
                      <div class="form-group col-md-10 col-sm-12">
                            <select id="prod_reg" name="prod_reg" class="form-control selectpicker" data-live-search="true"></select>
                      </div>
                      <div class="form-group col-md-2 col-sm-12">
                            <button id="btn_comprob" type="button" class="btn btn-primary" onclick="select_prod_add();">Agregar</button>
                      </div>
                     
                      
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="overflow:scroll;height:250px; width:100%;">
                          

                                      <table id="tbllistado_prod_select" class="table table-striped table-bordered table-condensed table-hover">

                                          <thead style="background-color:#000000"> 
                                              <th colspan="2" style="color:#FFFFFF">Opciones</th>
                                              
                                              <th style="color:#FFFFFF">Clave</th>
                                              <th style="color:#FFFFFF">Nombre</th>  
                                              <th style="color:#FFFFFF">Empaque</th>
                                              <th style="color:#FFFFFF">Cantidad</th>
                                              <th style="color:#FFFFFF">Monto(Sin IVA)</th>
                                              <th style="color:#FFFFFF">Monto(Con IVA)</th>
                                              
                                          </thead>
           
                                          <tbody>
                                          <tfoot>
       
                                          </tfoot>
                                          </tbody>

                                      </table>
                                 
                           
                        </div>

                        <div class="form-group col-md-12 col-sm-12">
                            <h5 id="num_prod"></h5>
                        </div>
                        <div class="form-group col-md-2 col-sm-12">
                            <button id="btn_comprob" type="button" class="btn btn-primary" onclick="guardar_envio();">Guardar</button>
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
  <div class="modal fade" id="myModal_reg_cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:auto;width:auto;">
    <div class="modal-dialog" style="width: 90% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <div class="form-group col-md-12 col-sm-12">
            <h3>REGISTRAR CLIENTE</h3>
          </div>
                      <div class="form-group col-md-6 col-sm-12">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre_new" id="nombre_new">
                      </div>
                      
                      <div class="form-group col-md-6 col-sm-12">
                        <label>RFC:</label>
                           
                        <input type="text" class="form-control" name="rfc_new" id="rfc_new">    
                      </div>
                      <div class="form-group col-md-6 col-sm-12"> 
                        <label>Telefono:</label>
                       
                        <input type="text" class="form-control" name="telefono_new" id="telefono_new">    
                      </div>
                      <div class="form-group col-md-6 col-sm-12"> 
                        <label>Calle:</label>
                        
                        <input type="text" class="form-control" name="calle_new" id="calle_new"> 
                      </div>
                      <div class="form-group col-md-6 col-sm-12"> 
                        <label>Numero:</label>
                        
                        <input type="text" class="form-control" name="numero_new" id="numero_new">
                      </div>
                      <div class="form-group col-md-6 col-sm-12"> 
                        <label>Numero interior:</label>
                        
                        <input type="text" class="form-control" name="interior_new" id="interior_new"> 
                      </div>
                      <div class="form-group col-md-6 col-sm-12"> 
                        <label>Colonia:</label>
                        
                        <input type="text" class="form-control" name="colonia_new" id="colonia_new">
                      </div>
                      <div class="form-group col-md-6 col-sm-12">
                        <label>Municipio:</label>
                        
                        <input type="text" class="form-control" name="municipio_new" id="municipio_new"> 
                      </div>
                      <div class="form-group col-md-6 col-sm-12">
                        <label>Estado:</label>
                        
                        <input type="text" class="form-control" name="estado_new" id="estado_new"> 
                      </div>
                      <div class="form-group col-md-6 col-sm-12">
                        <label>Email:</label>
                        
                        <input type="text" class="form-control" name="email_new" id="email_new"> 
                      </div>
                      <div class="form-group col-md-6 col-sm-12">
                        <label>Referencia:</label>
                        
                        <input type="text" class="form-control" name="referencia_new" id="referencia_new"> 
                      </div>

                      
                      
                    
                     
                      
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="overflow:scroll;height:250px; width:100%;">
                          <label>Clientes registrados</label>

                                      <table id="tbllistado_prod_select" class="table table-striped table-bordered table-condensed table-hover">

                                          <thead style="background-color:#000000"> 
                                             
                                              
                                              
                                              <th style="color:#FFFFFF">Nombre</th>  
                                            
                                              
                                          </thead>
           
                                          <tbody>
                                          <tfoot>
       
                                          </tfoot>
                                          </tbody>

                                      </table>
                                 
                           
                        </div>

                       
                        

        </div>          

        

        <div class="modal-footer">
        
          <button id="btn_save_cli" type="button" class="btn btn-primary" onclick="guardar_cliente();">Guardar cliente</button>
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
<script type="text/javascript" src="scripts/pedidose.js"></script>
<?php 
}
ob_end_flush();
?>