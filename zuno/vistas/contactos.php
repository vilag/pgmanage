<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['administrador']==1 || $_SESSION['agente_ventas1']==1 || $_SESSION['Administrativo']==1)
{
?>
<!--Contenido-->

    <script>
      
      Push.create("Contacto desde nuestra web", {
          body: "NOMBRE DEL CLIENTE",
          icon: '../notificaciones/logo_sinfondo_2.png',
          timeout: 60000,
          onClick: function () {
              //window.focus();
              this.close();
          }
      });

    </script>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                        
                         <input type="hidden" class="form-control" name="f_actual" id="f_actual">
                          <h1 class="box-title">CONTACTOS</h1>
                        <div class="box-tools pull-right">
                          <button id="" type="button" class="btn btn-primary" onclick=""><a href="ventas/inventario_z.php" style="color: #ffffff">Inventarios</a></button>
                        </div>
                        
                        
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">

                          <thead>
                            <th>Opciones</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            
                            <th>Fecha</th>
                           
                            <th>Estatus</th>
                            
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            
                            <th>Fecha</th>
                           
                            <th>Estatus</th>
                          
                          </tfoot>
                        </table>
                    </div>

                    
                    
                   
                    
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  
 <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:100%;width:100%;">
    <div class="modal-dialog" style="width: 70% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">

          <div class="form-group col-md-12 col-sm-12">
              
              <h3>Solicitudes desde la web</h3>
                        
          </div>
          <div class="form-group col-md-12 col-sm-12">
              
              <button id="btn_pedido" type="button" class="btn btn-primary" onclick="ver_pedido();">Ver resumen de pedido</button>
              
              <input type="hidden" class="form-control" name="idpedido" id="idpedido">
                        
          </div>
          <div style="visibility: hidden;" class="form-group col-md-12 col-sm-12">
              <label>ID contacto:</label>
              <input type="text" class="form-control" name="idcontacto" id="idcontacto" disabled>              
          </div>
          <div class="form-group col-md-12 col-sm-12">
              <label>Nombre:</label>
              <input type="text" class="form-control" name="nombre_pros" id="nombre_pros" disabled>              
          </div>
          <div class="form-group col-md-4 col-sm-12">
              <label>Email:</label>
              <input type="text" class="form-control" name="email" id="email">              
          </div>
          <div class="form-group col-md-4 col-sm-12">
              <label>Telefono:</label>
              <input type="text" class="form-control" name="telefono" id="telefono">              
          </div>
          <div class="form-group col-md-4 col-sm-12">
              <label>Fecha y Hora de solicitud:</label>
              <input type="text" class="form-control" name="fecha_hora" id="fecha_hora" disabled>              
          </div>
          <div class="form-group col-md-12 col-sm-12">
              <label>Mensaje:</label>
              <textarea  cols="25" rows="5" class="form-control" name="mensaje" id="mensaje" disabled></textarea>
          </div>
          <!--<div class="form-group col-md-4 col-sm-12">
              <label>Newsletter:</label>
              <input type="text" class="form-control" name="boletin" id="boletin" disabled>              
          </div>-->
          
          
          <!--<div class="form-group col-md-12 col-sm-12">
              <button id="" type="button" class="btn btn-primary" onclick="abrir_ventas();">Registrar venta</button>
              <button id="" type="button" class="btn btn-primary" onclick="abrir_pedido();">Hacer pedido</button>                                   
          </div>-->
          <br>
          <br>

          <div class="form-group col-md-12 col-sm-12" id="divseg">
              <label>SEGUIMIENTO</label>
              

              <div class="form-group col-md-12 col-sm-12" style="background-color: #DBF0E0;">
              
                <form name="formulario-envia_comentario" id="formulario-envia_comentario" enctype="multipart/form-data" method="post">
                    <br>
                    <div class="form-group col-md-12 col-sm-12">
                        <label>Comentario:</label>
                        <input type="hidden" class="form-control" name="fecha_hora_coment" id="fecha_hora_coment">
                        <input type="hidden" class="form-control" name="idcontacto3" id="idcontacto3">
                        <textarea cols="25" rows="5" class="form-control" name="descr_venta" id="descr_venta"></textarea>
                    </div>


                    <div class="form-group col-md-10 col-sm-12">

                      <label>Subir archivo:</label>
                      <input type="file" name="ar_coment" id="ar_coment" onchange="valid_archivo();">
                      <input type="hidden" class="form-control" name="valor_si" id="valor_si">

                                                           
                    </div>
                    <br>                                
                                                            
                    <!--<div id="subir2" class="form-group col-md-6 col-sm-12">
                      <a href="http://localhost/pizarronesguadalajara/files/pedidos/tabla importar proyecto.xlsx" download="tabla importar proyecto.xlsx">descargar</a>             
                    </div>-->

                    <div class="form-group col-md-2 col-sm-12">
                        <button id="btn_comment" type="button" class="btn btn-primary" onclick="guardar_comentario();">Guardar comentario</button>             
                    </div>
                                                              
                </form>

                                                   
              </div>

             

          

            <!-- <iframe  src="http://docs.google.com/gview?url=http://www.pizarronesguadalajara.com/files/seguimiento/No. 261 Oct 22 PPLL BSG.doc&embedded=true" style="width:600px; height:500px;" frameborder="0"></iframe>-->

            <hr width="100px">
            <hr width="100px">
             
              <div class="form-group col-md-12 col-sm-12">
                
              <button id="" type="button" class="btn btn-primary" onclick="listar_seguimiento();">Recargar tabla de seguimiento</button>          
              
                            <table id="tbllistado_seg" class="table table-striped table-bordered table-condensed table-hover">

                              <thead>
                                
                                <th>No.</th>
                                <th>Comentario</th>
                                                               
                                <th>Fecha</th>
                                <th>Archivo</th> 
                                
                               
                                <th>Vista previa</th>
                              </thead>
                              <tbody>                            
                              </tbody>
                              <tfoot>
                                <th>No.</th>
                                <th>Comentario</th>
                                                               
                                <th>Fecha</th>
                                <th>Archivo</th> 
                                
                                <th>Vista previa</th>
                              </tfoot>
                            </table>             
              </div>
          </div>          

          

          

        </div>
        <div class="modal-footer">
          
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->


  <!-- Modal -->
  <div class="modal fade" id="myModal_venta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:100%;width:100%;">
    <div class="modal-dialog" style="width: 90% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          
          <div class="form-group col-md-12 col-sm-12">             
              <button id="" type="button" class="btn btn-primary" onclick="back_solic();">Regresar a la solicitud</button>                       
          </div>
          <div class="form-group col-md-12 col-sm-12">             
              <h3>REGISTRAR VENTA</h3>                        
          </div>
          <div class="form-group col-md-12 col-sm-12">
              <label>Nombre de cliente:</label>
              <input type="hidden" class="form-control" name="idcontacto2" id="idcontacto2" disabled>  
              <input type="text" class="form-control" name="nombre_cliente" id="nombre_cliente" disabled>             
          </div>
          <div class="form-group col-md-12 col-sm-12">
              <label>Detalle de venta(*):</label>
              <textarea cols="25" rows="5" class="form-control" name="descr_venta2" id="descr_venta2"></textarea>
          </div>
          <div class="form-group col-md-3 col-sm-12">
              <label>Total pago(*):</label>
              <input type="number" class="form-control" name="total_pago" id="total_pago">              
          </div>
          
          <div class="form-group col-md-3 col-sm-12">
              <label>Forma de pago(*):</label>
              <select name="forma_pago" id="forma_pago" class="form-control selectpicker" onchange="">
                               <option value="">Seleccionar</option>
                               <option value="Cheque">Cheque</option>
                               <option value="Deposito">Deposito</option>
                               <option value="Efectivo">Efectivo</option>
                               <option value="Transferencia">Transferencia</option>  
              </select>           
          </div>

          <div class="form-group col-md-3 col-sm-12">
              <label>Banco:</label>
              <input type="text" class="form-control" name="banco" id="banco">              
          </div>
          <div class="form-group col-md-3 col-sm-12">
              <label>Referencia:</label>
              <input type="text" class="form-control" name="referencia" id="referencia">              
          </div>
          <div class="form-group col-md-12 col-sm-12">
              <label>Comentario:</label>
              <textarea cols="25" rows="5" class="form-control" name="comentario_venta" id="comentario_venta"></textarea>
          </div>

          <div class="form-group col-md-12 col-sm-12">
              <label>Documentos:</label>
                          
          </div>
          <div class="form-group col-md-12 col-sm-12">
                        
          </div>

          <div class="form-group col-md-12 col-sm-12">
              <button id="btn_comment" type="button" class="btn btn-primary" onclick="guardar_venta();">Guardar venta</button>             
          </div>

          <!--<div class="form-group col-md-12 col-sm-12" id="divseg">
              <label>HISTORICO DE VENTAS</label>
              
              <div class="form-group col-md-12 col-sm-12">
                            <table id="tbllistado_seg" class="table table-striped table-bordered table-condensed table-hover">

                              <thead>
                                
                                <th>ID</th>
                                <th>Comentario</th>                               
                                <th>Fecha</th>
                              </thead>
                              <tbody>                            
                              </tbody>
                              <tfoot>
                                <th>ID</th>
                                <th>Comentario</th>                               
                                <th>Fecha</th>
                              </tfoot>
                            </table>             
              </div>
          </div>-->          
          

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->

   <!-- Modal -->
  <div class="modal fade" id="myModal_valid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:100%;width:100%;">
    <div class="modal-dialog" style="width: 70% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">

            
          <div class="form-group col-md-12 col-sm-12">
              <h3>CONTACTO NUEVO</h3>
              <h5 id="nombre_txt"></h5>
              <h5 id="email_txt"></h5>
              <h5 id="telefono_txt"></h5>
                        
          </div>

          <div class="form-group col-md-12 col-sm-12">
              <button id="" type="button" class="btn btn-primary" onclick="omitir_coin();">Omitir y crear nuevo cliente</button>
                                               
          </div>

          <div class="form-group col-md-12 col-sm-12">
              
              <h3>CLIENTES REGISTRADOS</h3>
              <h4>Coincidencias encontradas</h4>
                        
          </div>

          <div class="form-group col-md-12 col-sm-12">
              <table id="tbllistado_coin_clien" class="table table-striped table-bordered table-condensed table-hover">

                  <thead>
                                


                  </thead>
                  <tbody>                            
                  </tbody>
                  <tfoot>

                      

                  </tfoot>
              </table>             
          </div>




          <!--<div class="form-group col-md-2 col-sm-12">
              <label>No. Cliente:</label>
              <input type="hidden" class="form-control" name="idcliente_c" id="idcliente_c">   
              <input type="text" class="form-control" name="no_cliente_c" id="no_cliente_c" disabled>              
          </div>
          <div class="form-group col-md-4 col-sm-12">
              <label>Nombre Cliente:</label>
              <input type="text" class="form-control" name="nombre_cliente_c" id="nombre_cliente_c" disabled> 
          </div>
          <div class="form-group col-md-3 col-sm-12">
              <label>Email:</label>
              <input type="text" class="form-control" name="email_c" id="email_c" disabled>              
          </div>
          <div class="form-group col-md-3 col-sm-12">
              <label>Telefono:</label>
              <input type="text" class="form-control" name="telefono_c" id="telefono_c" disabled>              
          </div>
         
          <div class="form-group col-md-12 col-sm-12">
              <button id="" type="button" class="btn btn-primary" onclick="enviar_cliente1();">Seleccionar</button>
                                               
          </div>


          <div class="form-group col-md-2 col-sm-12">
              <label>No. Cliente:</label>
              <input type="hidden" class="form-control" name="idcliente_c2" id="idcliente_c2">   
              <input type="text" class="form-control" name="no_cliente_c2" id="no_cliente_c2" disabled>              
          </div>
          <div class="form-group col-md-4 col-sm-12">
              <label>Nombre Cliente:</label>
              <input type="text" class="form-control" name="nombre_cliente_c2" id="nombre_cliente_c2" disabled> 
          </div>
          <div class="form-group col-md-3 col-sm-12">
              <label>Email:</label>
              <input type="text" class="form-control" name="email_c2" id="email_c2" disabled>              
          </div>
          <div class="form-group col-md-3 col-sm-12">
              <label>Telefono:</label>
              <input type="text" class="form-control" name="telefono_c2" id="telefono_c2" disabled>              
          </div>
         
          <div class="form-group col-md-12 col-sm-12">
              <button id="" type="button" class="btn btn-primary" onclick="enviar_cliente2();">Seleccionar</button>
                                               
          </div>-->

          

        </div>
        <div class="modal-footer">
          
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->



  <!-- Modal -->
  <div class="modal fade" id="myModal_pedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;height:100%;width:100%;">
    <div class="modal-dialog" style="width: 70% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group col-md-12 col-sm-12">             
              <button id="" type="button" class="btn btn-primary" onclick="back_solic2();">Regresar a la solicitud</button>                       
          </div>
          <div class="form-group col-md-12 col-sm-12">
              
              <h3>Nuevo pedido</h3>
              <input type="text" class="form-control" name="marca_new_cli" id="marca_new_cli">        
          </div>
          <div class="form-group col-md-2 col-sm-12">
              <label>No. Cliente:</label>
              <input type="text" class="form-control" name="no_cliente_p" id="no_cliente_p">              
          </div>
          <div class="form-group col-md-10 col-sm-12">
              <label>Nombre:</label>
              <input type="text" class="form-control" name="nombre_cliente_p" id="nombre_cliente_p">   
              <input type="hidden" class="form-control" name="email_cliente_p" id="email_cliente_p">  
              <input type="hidden" class="form-control" name="telefono_cliente_p" id="telefono_cliente_p">         
          </div>
          <div class="form-group col-md-2 col-sm-12">
              <label>No. Pedido:</label>
              <input type="text" class="form-control" name="num_pedido" id="num_pedido">              
          </div>
          <div class="form-group col-md-10 col-sm-12">
              <label>Resumen de concepto:</label>
              <input type="text" class="form-control" name="concepto_pedido" id="concepto_pedido">              
          </div>
         

         

          <div class="form-group col-md-12 col-sm-12">
              
            <form name="formulario-envia_proyecto" id="formulario-envia_pedido" enctype="multipart/form-data" method="post">

                <div class="form-group col-md-6 col-sm-12">

                  <label>Subir formato de pedido:</label>
                  <input type="file" name="ar_pedido" id="ar_pedido" onchange="">
                  <input type="hidden" class="form-control" name="valor_si2" id="valor_si2">

                                                       
                </div>
                <br>                                
                                                        
                <div id="subir2" class="form-group col-md-6 col-sm-12">
                  <a href="http://localhost/pizarronesguadalajara/files/pedidos/tabla importar proyecto.xlsx" download="tabla importar proyecto.xlsx">descargar</a>             
                </div>
                                                          
            </form>

                                               
          </div>

          <div class="form-group col-md-6 col-sm-12">
              <button id="" type="button" class="btn btn-primary" onclick="guardar_pedido();">Solicitar pedido</button>
                                               
          </div>   

          

        </div>
        <div class="modal-footer">
          
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
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/moment.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="../scripts/contactos.js"></script>
<?php 
}
ob_end_flush();
?>