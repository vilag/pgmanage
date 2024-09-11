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

        


        
        <div id="signup-notification" class="" >
            
            <div class="col-md-12 col-sm-12">
              <hr width="100%">
            </div>
            <div class="col-md-1 col-sm-1" align="center" id="pestaña_prod_select">
              
                <div class="col-md-12 col-sm-12" style="writing-mode: vertical-lr; transform: rotate(180deg); width: 50px; height: 410px; padding: 10px 50px 10px 10px; border-radius: 0 0 10px 0; cursor: pointer;" onclick="abrir_div_pro_select();" id="eti_prod_select1" align="center">
                  
                    
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><br>
                    <b>PRODUCTOS SELECCIONADOS</b><br>
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                 
                </div>
              

              
                <div class="col-md-12 col-sm-12" style="writing-mode: vertical-lr; transform: rotate(180deg); width: 50px; height: 410px; padding: 10px 50px 10px 10px; border-radius: 0 0 10px 0; cursor: pointer;" onclick="ocultar_div_pro_select();" id="eti_prod_select2" align="center">
                  
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><br>
                    <b>PRODUCTOS SELECCIONADOS</b><br>
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                 
                </div>
               
            </div>
             
              
              
            <div class="col-md-11 col-sm-11" style="border:0px solid #e5e5e5; overflow:scroll;height: 85%; width: 82%;">

                
                <div class="btn-group" id="">
                              
                  <div class="col-md-12 col-sm-12">
                    <button id="" type="button" class="btn btn-dark" onclick="capturar_pedido();">Capturar pedido</button>
                    <button id="" type="button" class="btn btn-info" onclick="view_section_selectprod();">Agregar producto</button>

                    
                  </div>
                        

                </div>

                <div class="col-md-12 col-sm-12">
                  <hr width="100%">
                </div>

                <div class="col-md-12 col-sm-12" id="div_aplicar_iva">

                    <label>Aplicar IVA:</label>
                    <!--<select  class="form-control" id="aplic_iva" onchange="pie_reporte();save_hist_iva();">-->
                    <select  class="form-control" id="aplic_iva" onchange="save_hist_iva();">
                                                 
                      <option value="select">SELECCIONAR</option>
                      <option value="Si">SI</option>
                      <option value="No">NO</option>
                                                
                    </select>

                </div>

                <div class="col-md-12 col-sm-12">
                  <hr width="100%">
                </div>
                                                

                               
                <div class="col-md-12 col-sm-12" id="tbl_product_select">
                                      
                </div> 

            </div>
            
        </div>

        <style type="text/css">
          
          #signup-notification.openbefore{

             left: 95%;
              top: 30%;
              width: 80%;
              height: 500px;
              -webkit-box-shadow: 0 14px 28px rgba(0,0,0,.25), 0 10px 10px rgba(0,0,0,.22);
              box-shadow: 0 14px 28px rgba(0,0,0,.25), 0 10px 10px rgba(0,0,0,.22);
              background: #fff;
              position: fixed;
              z-index: 1041;
              color: #000;
              transition: 1s;

          }

          #signup-notification.open {
              left: 25%;
              top: 30%;
              width: 80%;
              height: 500px;
              -webkit-box-shadow: 0 14px 28px rgba(0,0,0,.25), 0 10px 10px rgba(0,0,0,.22);
              box-shadow: 0 14px 28px rgba(0,0,0,.25), 0 10px 10px rgba(0,0,0,.22);
              background: #fff;
              position: fixed;
              z-index: 1041;
              color: #000;
              transition: 1s;
          }

         


         /*#signup-notification:hover {
                 
                 height: 400px;
                 width: 80%;
                 left: 30%;
          }*/



        </style>

        <!-- page content -->
        <div class="right_col" role="main" id="page_pedido">

          <div class="">
            
            <div class="page-title">

              <label id="id_ped_temp2" style="visibility: hidden;"><?php $pedido=($_GET['pedido']);echo "$pedido";?></label>
  
            </div>
                          
           
            <div class="clearfix"></div>
                    <!--<div class="">
                        <div class="product_price">
                          <h1 class="price">$ 80.00</h1>
                          
                          <br>
                        </div>
                    </div>-->
            
            <div class="row" id="area_inicial">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    
                   
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content" id="tbl_prod_pedidos">

                    <div class="row" id="div_select_tipo_ped">
                      <div class="col-md-12 col-sm-12">
                            
                            <div class="col-md-12 col-sm-12">
                              <div class="col-md-12 col-sm-12">
                                
                                <select id="select_tipo_pedido" class="form-control selectpicker" onchange="view_section_selectprod();" onclick="cargar_options_tipo_ped();"> 
                                  <option value="">Tipo de pedido</option> 
                                  <option value="1">Comercial</option> 
                                  <option value="2">Licitación</option>
                                  <option value="3">Muestras</option> 
                                  <option id="opt_exist" value="4">Existencias</option>   
                                </select>

                                <h2 id="etiqueta_tipo_ped"></h2>

                              </div>
                             
                          </div>
                      </div>
                      

                    </div>

                    <div class="row">
                      <hr width="100%">
                    </div>

                    <div class="row" id="select_productos_button">
                      <ul class="nav navbar-right panel_toolbox">

                        <div class="col-md-12 col-sm-12">
                          <div class="col-md-12 col-sm-12">
                            <li>
                              <a class="btn btn-app" style="background: #374C6F; color: white; border-radius: 10px;">
                                
                                <i class="fa fa-inbox" onclick="abrir_modal_prod()" ></i><strong>Productos</strong>
                                
                              </a>
                            </li>
                          </div>
                            
                        </div>

                          

                          <!--<li>
                            <a class="btn btn-app" style="background: #374C6F; color: white; border-radius: 10px;">
                              
                              <i class="fa fa-inbox" onclick="abrir_modal_select_prod()" ></i><strong>Catalogo</strong>
                              
                            </a>
                          </li>-->
     
                      </ul>
                    </div>

                    

                    <div class="row" id="div_filtro_prod">
                      <div class="col-md-12 col-sm-12">
                            <!--<div class="col-md-12 col-sm-12">
                              <div class="btn-group" id="group_notif_term">
                                
                                <a class="btn btn-app" onclick="" id="">
                                  <span class="badge bg-green" style="color: white;" id=""></span>
                                  <i class="fa fa-check"></i> Terminados
                                </a>

                              </div>
                            </div>-->
                            

                            <div class="col-md-12 col-sm-12">
                              <hr width="100%">
                            </div>
                            
                            
                            <div class="col-md-3 col-sm-3">
                              <div class="col-md-12 col-sm-12">
                                <div class="col-md-12 col-sm-12">
                                  <h2>Seleccionar Producto</h2>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                  
                                
                                          <label>Buscar</label>
                                          <input type="text" class="form-control" id="buscar_prod_fil" value="" onkeyup="listar_productos_busqueda();">  

                                  
                                </div>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                <hr width="100%">
                              </div>
                              <div class="col-md-12 col-sm-12">
                                <div class="col-md-12 col-sm-12">
                                            <label>Tipo</label>
                                            <select id="select_busqueda_tipo" class="form-control selectpicker" onchange="select_tipo();">    
                                            </select>  
                                </div>
                                <div class="col-md-12 col-sm-12">
                                            <label>SubTipo</label>
                                            <select id="select_busqueda_subtipo" class="form-control selectpicker" onchange="select_subtipo();">    
                                            </select>  
                                </div>
                                <div class="col-md-12 col-sm-12">
                                          <label>Modelo</label>
                                          <select id="select_busqueda_modelo" class="form-control selectpicker" onchange="select_modelo();">    
                                          </select>  
                                </div>
                                <div class="col-md-12 col-sm-12">
                                            <label>SubModelo</label>
                                            <select id="select_busqueda_submodelo" class="form-control selectpicker" onchange="select_submodelo();">    
                                            </select>  
                                </div>
                                <div class="col-md-12 col-sm-12">
                                          <label>Tamaño</label>
                                          <select id="select_busqueda_tamano" class="form-control selectpicker" onchange="select_tamano();">    
                                          </select>  
                                </div>
                                <!--<div class="col-md-6 col-sm-6">
                                            <label>Especif</label>
                                            <select id="" class="form-control selectpicker" onchange="">    
                                            </select>  
                                </div>-->
                                
                              </div>
 
                            </div>
                            

                            
                            
                            <div class="col-md-9 col-sm-9">
                              <div class="col-md-12 col-sm-12">
                                <div class="col-md-12 col-sm-12">
                                  <h2>Productos Encontrados</h2>
                                </div>
                              </div>
                                
                              <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 420px; width: auto; max-width: 95%">
                                  <table class="table table-striped" id="tbl_result_prod" style="width: auto; max-width: 100%;">
                                  </table>
                              </div>
                             
                                  
                            </div>
                            <div class="col-md-12 col-sm-12">
                              <hr width="100%">
                            </div>

                            

                            <!--<div class="col-md-3 col-sm-3">
                              <div class="col-md-12 col-sm-12">
                                          <label>Sub Tipo</label>
                                          <select id="select_busqueda_tipo2" class="form-control selectpicker" onchange="listar_modelo();">    
                                          </select>  
                              </div>
                              <div class="col-md-12 col-sm-12">
                                          <label>Sub Modelo</label>
                                          <select id="select_busqueda_modelo2" class="form-control selectpicker" onchange="listar_tamano();">    
                                          </select>  
                              </div>
                            </div>-->
                            
                      </div>
                      

                    </div>

                    <div class="row" id="adj_docs_lic">
                      <ul class="nav navbar-right panel_toolbox">

                        <div class="col-md-12 col-sm-12">
                          <div class="col-md-12 col-sm-12">
                            <!--<div class="col-md-12 col-sm-12" id="doc_req_lic">
                              <div class="col-md-12 col-sm-12">
                                <h2>Documentos Requeridos</h2>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                <label>- Orden de Compra</label><br>
                                <label>- Contrato</label><br>
                                <label>- Especificaciones</label><br>
                               
                              </div>
                                
                            </div>
                            <div class="col-md-12 col-sm-12" id="doc_rec_mue">
                              <div class="col-md-12 col-sm-12">
                                <h2>Documentos Requeridos</h2>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                <label>- Especificaciones</label><br>
                               
                              </div>
                                
                            </div>-->
                            <div class="col-md-12 col-sm-12" id="">
                              <div class="col-md-12 col-sm-12">
                                <h2>Documentos Requeridos</h2>
                              </div>
                              
                                
                            </div>
                            <div class="col-md-12 col-sm-12" align="center">
                              <label>_</label>
                            </div>

                            <div class="col-md-12 col-sm-12">

                                          <form name="formulario-envia_comprobante_lic" id="formulario-envia_comprobante_lic" enctype="multipart/form-data" method="post">
                                            <input type="hidden" name="idpedido" id="idpedido" onchange="" >

                                            <div class="form-group col-md-12 col-sm-12">
                                              <div class="form-group col-md-5 col-sm-5">

                                                <div class="form-group col-md-12 col-sm-12" id="div_doc_orden_compra">
                                                  
                                                  <div class="form-group col-md-12 col-sm-12">
                                                    <label>ORDEN DE COMPRA</label><br>
                                                    <input type="file" name="ar_comprob_lic1" id="ar_comprob_lic1" onchange="">
                                                    <input type="hidden" id="iddocumentos1" onchange="" value="0">
                                                  </div>
                                                  
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12" id="div_doc_contrato">
                                                  
                                                  
                                                  <div class="form-group col-md-12 col-sm-12">
                                                    <label>CONTRATO</label><br>
                                                    <input type="file" name="ar_comprob_lic2" id="ar_comprob_lic2" onchange="" >
                                                    <input type="hidden" id="iddocumentos2" onchange="" value="0">
                                                  </div>
                                                </div>

                                                <div class="form-group col-md-12 col-sm-12" id="div_doc_especif">
                                                  
                                                
                                                  <div class="form-group col-md-12 col-sm-12">
                                                    <label>ESPECIFICACIONES</label><br>
                                                    <input type="file" name="ar_comprob_lic3" id="ar_comprob_lic3" onchange="" >
                                                    <input type="hidden" id="iddocumentos3" onchange="" value="0">
                                                  </div>
                                                </div>

                                                <div class="form-group col-md-12 col-sm-12">
                                                  
                                                
                                                  <div class="form-group col-md-12 col-sm-12">
                                                    <label>ANEXO</label><br>
                                                    <input type="file" name="ar_comprob_lic4" id="ar_comprob_lic4" onchange="" >
                                                    <input type="hidden" id="iddocumentos4" onchange="" value="0">
                                                  </div>

                                                </div>
                                                <div class="form-group col-md-12 col-sm-12">
                                                  <hr width="100%">
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12" align="center">
                                                  <button type="button" class="btn btn-dark"  onclick="cargar_doc_lic();" id="" style="border-radius: 10px;">Cargar archivos</button>
                                                </div>

                                              </div>
                                             
                                              <div class="form-group col-md-7 col-sm-7" id="box_documentos_cargados_lic">

                                              </div>

                                                

                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">

                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label>Observaciones Adicionales:</label>
                                                    <textarea class="form-control" name="observ_lic" id="observ_lic" cols="40" rows="9" onkeyup="update_observ_lic();"></textarea>
                                                </div>
                                                
                                                 
                                                 

                                            </div> 

                                           
                                                                                                        
                                          </form>

                            </div>



                                          

                          </div>
                            
                        </div>

              
     
                      </ul>
                    </div>

                    <div class="row" id="div_pedido">

                        <div class="col-md-12 col-sm-12 " style="border:0px solid #e5e5e5; overflow:scroll;height:auto;">
                       

                          <style type="text/css">
                            .fondo_div{
                              background: #F5F6F7;
                              border-radius: 15px;
                            }
                           
                          </style> 

                         
                            

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



                        

                          <div class="form-group col-md-12 col-sm-12">
                            
                            
                                <div class="form-group col-md-12 col-sm-12" id="dat_control">
                                    <br>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <h3>Datos de control</h3>
                                      </div>
                                    <div class="form-group col-md-3 col-sm-12">
                                        <label>Fecha:</label>
                                        <input type="date" class="form-control" name="fecha_pedido" id="fecha_pedido" disabled="">

                                    </div> 
                                    <div class="form-group col-md-3 col-sm-12">
                                        <label>No. Pedido:</label>
                                        <input type="number" class="form-control" name="no_pedido" id="no_pedido" disabled="">              
                                    </div>
                                    <div class="form-group col-md-3 col-sm-12">
                                        <label>Condiciones:</label>
                                        <input type="text" class="form-control" name="condiciones" id="condiciones" value="">              
                                    </div>
                                    <div class="form-group col-md-3 col-sm-12">
                                        <label>No. Control:</label>
                                        <input type="text" class="form-control" name="no_control" id="no_control" disabled="">              
                                    </div>
                                    <div class="form-group col-md-2 col-sm-12" onclick="select_cliente();">
                                        <label>No. Cliente:</label>
                                        <input type="text" class="form-control" name="no_cliente" id="no_cliente" placeholder="Seleccionar">
                                        <input type="hidden" class="form-control" name="id_cliente" id="id_cliente">
                                        <input type="hidden" class="form-control" name="max_ped_cli" id="max_ped_cli">                
                                    </div>
                                    <div class="form-group col-md-10 col-sm-12">
                                            <label>Nombre:</label>
                                            <input type="text" class="form-control" name="nombre_cliente" id="nombre_cliente" disabled="">              
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                            <label>Teléfono:</label>
                                            <input type="text" class="form-control" name="telefono" id="telefono" disabled="">              
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                            <label>Email:</label>
                                            <input type="text" class="form-control" name="email" id="email" disabled="">              
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                          <label style="color: #F5F6F7;">_____________</label>
                                    </div>
                                </div>
                            
                                <div class="form-group col-md-12 col-sm-12 fondo_div" id="dat_fac">
                                  
                                  
                                  <div class="form-group col-md-12 col-sm-12" align="right">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"><a href="#" onclick="abrir_modal_fact();">  Editar</a></span>
                                  </div>
                                      <div class="form-group col-md-12 col-sm-12">
                                        <h3>Datos de facturación</h3>
                                      </div>
                                  
                                  <br>
                                      <div class="form-group col-md-6 col-sm-12"> 
                                            <input type="hidden" class="form-control" name="idfacturacion" id="idfacturacion">
                                            <h4><strong>Razón Social:</strong><small id="nombre_cliente_fac"></small></h4>
                                            <h4><strong>RFC:</strong><small id="rfc_fac"></small></h4>
                                            <h4><strong>Calle:</strong><small id="calle_fac"></small></h4>
                                            <h4><strong>Numero:</strong><small id="numero_fac"></small></h4>
                                            <h4><strong>Int.:</strong><small id="interior_fac"></small></h4>
                                            <h4><strong>Colonia:</strong><small id="colonia_fac"></small></h4>
                                            
                                            <h4><small id="" style="color: white;">_</small></h4>
                                            
                                      </div>

                                      <div class="form-group col-md-6 col-sm-12">
                                            <h4><strong>Ciudad:</strong><small id="ciudad_fac"></small></h4>
                                            <h4><strong>Estado:</strong><small id="estado_fac"></small></h4>
                                            <h4><strong>C.P.:</strong><small id="cp_fac"></small></h4>
                                            <h4><strong>Telefono:</strong><small id="tel_fac"></small></h4>
                                            <h4><strong>Email:</strong><small id="email_fac"></small></h4>
                                            
                                            
                                            <h4><small id="" style="color: white;">_</small></h4>
                                      </div>
                                      
                                      
                                      
                                </div>

                                   

                                <div class="form-group col-md-12 col-sm-12 fondo_div" id="dat_ent">
                                
                                  
                                  <div class="form-group col-md-12 col-sm-12" align="right">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"><a href="#" onclick="abrir_modal_ent();">  Cambiar</a></span>
                                  </div>
                                  
                                      <div class="form-group col-md-12 col-sm-12">
                                        <h3>Datos de entrega</h3>
                                      </div>
                                  
                                      <div class="form-group col-md-6 col-sm-12">
                                            <input type="hidden" class="form-control" name="identregas" id="identregas">
                                            <h4><strong>Contacto:</strong><small id="nombre_cliente_ent"></small></h4>
                                            <h4><strong>Calle:</strong><small id="calle_ent"></small></h4>
                                            <h4><strong>Numero:</strong><small id="numero_ent"></small></h4>
                                            <h4><strong>Int:</strong><small id="interior_ent"></small></h4>
                                            <h4><strong>Colonia:</strong><small id="colonia_ent"></small></h4>
                                            <h4><strong>Ciudad:</strong><small id="ciudad_ent"></small></h4>
                                            <h4><strong>Estado:</strong><small id="estado_ent"></small></h4>
                                            <h4><strong>C.P:</strong><small id="cp_ent"></small></h4>
                                             
                                           
                                            
                                                
                                          
                                      </div>
                                      <div class="form-group col-md-6 col-sm-12">

                                            
                                            <h4><strong>Telefono:</strong><small id="telefono_ent"></small></h4>
                                            <h4><strong>Email:</strong><small id="email_ent"></small></h4>
                                            <h4><strong>Fecha de entrega:</strong><small id="fecha_ent"></small></h4>
                                            <h4><strong>Hora de entrega inicial:</strong><small id="hora_ent"></small></h4>
                                            <h4><strong>Hora de entrega final:</strong><small id="hora_ent2"></small></h4>
                                            <h4><strong>Forma de entrega:</strong><small id="forma_ent"></small></h4>
                                            <h4><strong>Detalles de entrega:</strong><small id="det_forma_ent"></small></h4>
                                            <h4><strong>Referencia:</strong><small id="referencia_ent"></small></h4>
                                            
                                        

                                      </div>
                                      <div class="form-group col-md-12 col-sm-12">
                                          <label style="color: #F5F6F7;">_____________</label>
                                      </div>
                                      
                                      
                                </div>

                                <!--<div class="form-group col-md-12 col-sm-12 fondo_div">
                                  <br>
                                 
                                      <div class="form-group col-md-12 col-sm-12">
                                        <h4>FORMA DE ENTREGA</h4> 
                                      </div>

                                  

                                      <div class="form-group col-md-12 col-sm-12">
                                         
                                            <div class="form-group col-md-3 col-sm-12">
                                                <span>Nosotros:</span>
                                                <input type="checkbox" class="form-control"  id="nosotros_entrega">              
                                            </div>
                                            <div class="form-group col-md-3 col-sm-12">
                                                <label>Cliente Recoge:</label>
                                                <input type="checkbox" class="form-control"  id="cliente_recoge_entrega">              
                                            </div>
                                            <div class="form-group col-md-3 col-sm-12">
                                                <label>Transporte:</label>
                                                <input type="checkbox" class="form-control"  id="transporte_entrega">              
                                            </div>
                                            <div class="form-group col-md-3 col-sm-12">
                                                <label>Servicio:</label>
                                                <input type="checkbox" class="form-control"  id="servicio_entrega">  

                                            </div>
                                      </div>
                                </div>-->
                                <div class="form-group col-md-12 col-sm-12 fondo_div" id="det_ped">
                                 
                                      
                                      <div class="form-group col-md-12 col-sm-12">
                                        <h3>Detalle de pedido</h3>
                                      </div>
                                      

                                      <div class="form-group col-md-2 col-sm-12">
                                          <label>Asesor:</label>
                                          <input type="text" class="form-control" name="asesor" id="asesor">              
                                      </div>
                                      
                                      <div class="form-group col-md-2 col-sm-12">
                                          <label>Levantó Pedido:</label>
                                          <input type="text" class="form-control" name="persona_pedido" id="persona_pedido">              
                                      </div>

                                      <!--<div class="form-group col-md-4 col-sm-12">
                                          <label>Cliente Nuevo:</label>
                                          <input type="checkbox" class="form-control" name="cliente_nuevo" id="cliente_nuevo">              
                                      </div>-->
                                      
                                      <div class="form-group col-md-2 col-sm-12">
                                          <label>Medio:</label>
                                          <input type="text" class="form-control" name="medio" id="medio">              
                                      </div>

                                      <div class="form-group col-md-2 col-sm-12">
                                          <label>LAB:</label>
                                          <input type="text" class="form-control" name="lab" id="lab">              
                                      </div>
                                      
                                      <div class="form-group col-md-4 col-sm-12">
                                          <label>Autorización Ejecutivo de Ventas:</label>
                                          <input type="text" class="form-control" name="autorizacion" id="autorizacion">              
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12">
                                          <label style="color: #F5F6F7;">_____________</label>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12">
                                          <label>Reglamentos legales y reglamentos aplicables:</label>
                                          <input type="text" class="form-control" name="reglamentos" id="reglamentos" value="No aplicables">             
                                      </div>
                                      
                                      <div class="form-group col-md-12 col-sm-12">
                                          <label style="color: #F5F6F7;">_____________</label>
                                      </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 fondo_div" id="det_pago">
                               
                                     
                                      <div class="form-group col-md-12 col-sm-12">
                                        <h6><strong>Detalle de pago</strong></h6>
                                      </div>
                                      
                                      <div class="form-group col-md-2 col-sm-12">
                                          <label>Metodo:</label>
                                            <select name="metodo_pago" id="metodo_pago" class="form-control selectpicker">
                                               <option value="">Select</option>
                                               <option value="PUE">PUE</option>
                                               <option value="PPD">PPD</option>
                                               
                                            </select>             
                                      </div>
                                      <div class="form-group col-md-3 col-sm-12">
                                          <label>Forma:</label>
                                            <select name="forma_pago" id="forma_pago" class="form-control selectpicker">
                                               <option value="">Select</option>
                                               <option>01 - Efectivo</option>
                                               <option>02 - Cheque normativo</option>
                                               <option>03 - Transferencia electrónica</option>
                                               <option>04 - Tarjeta de credito</option>
                                               <option>28 - Tarjeta de debito</option>
                                               <option>99 - Por definir</option> 

                                            </select>             
                                      </div>
                                      <div class="form-group col-md-7 col-sm-12">
                                          <label>Uso de CFDI</label>
                                            <select name="uso_cfdi" id="uso_cfdi" class="form-control selectpicker">
                                               <option value="">Seleccionar</option>
                                               <option>G01 - Adquisición de Mercancías</option>
                                               <option>G02 - Devoluciones, Descuentos o Bonificaciones</option>
                                               <option>G03 -  Gastos en General</option>
                                               <option>I02 -  Mobiliario y Equipo de Oficina por Inversiones</option>
                                               <option>I04 -  Equipo de Cómputo y Accesorios</option>
                                               <option>I08 -  Otra Maquinaria y Equipo</option>
                                               <option>D01 -  Honorarios Médicos, Dentales y Gastos Hospitalarios</option>
                                               <option>D02 -  Gastos Médicos por Incapacidad o Discapacidad</option>
                                               <option>D07 -  Primas por Seguros de Gastos Médicos</option>
                                               <option>D08 -  Gastos de Transportación Escolar Obligatoria</option>
                                               <option>P01 -  Por Definir</option>
                                            </select>               
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12">
                                        <h6><strong>Envío a enlace</strong></h6>
                                      </div>
                                      <div class="form-group col-md-3 col-sm-12">
                                          <label>Fecha:</label>
                                          <input type="text" class="form-control" name="fecha_envio_enlace" id="fecha_envio_enlace" value="">              
                                      </div>
                                      <div class="form-group col-md-3 col-sm-12">
                                          <label>Salida:</label>
                                          <input type="text" class="form-control" name="salida" id="salida" value="" disabled="">              
                                      </div>
                                      <div class="form-group col-md-3 col-sm-12">
                                          <label>Factura:</label>
                                          <input type="text" class="form-control" name="factura" id="factura" value="">              
                                      </div>
                                      <div class="form-group col-md-3 col-sm-12">
                                          <label>Otros:</label>
                                          <input type="text" class="form-control" name="otros" id="otros" value="">              
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12">
                                          <label style="color: #F5F6F7;">_____________</label>
                                      </div>
                                      
                                      
                                     
                                </div>

                                <div class="form-group col-md-12 col-sm-12" align="center">
                                  <button type="button" class="btn btn-round btn-info" id="btn_anterior"  onclick="regresar_paginas();">Anterior</button>
                                  <button type="button" class="btn btn-round btn-info" id="btn_siguiente"  onclick="pasar_paginas();">Siguiente</button>
                                  <input type="hidden" class="form-control" name="contador_paginas" id="contador_paginas" value="1"> 
                                </div>
                                  
                          </div>

                          <div class="form-group col-md-12 col-sm-12" align="center">
                            <h6 style="color: white;">_</h6>
                            <button type="button" class="btn btn-dark btn-lg"  onclick="guardar_pedido();" id="btn_save_pedido" style="border-radius: 10px;">Guardar pedido</button>
                            
                          </div>
                    
   
                          
                          
                          
                      </div>

                    </div>
                   
                  </div>
                  
                </div>
              </div>
            </div>


            <div class="row" id="pedido_area">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title" id="titulo_gallery">
                    <h2 id="titulo_ped">PRODUCTOS SELECCIONADOS</h2>
                    <span class="price-tax" id="span_codigo"></span>
                    <h5 id="contador" style="visibility: hidden;">0</h5>
                    <ul class="nav navbar-right panel_toolbox">

                      <li><a class="collapse-link"><button type="button" class="btn btn-dark btn-lg" id="btn_form_ped" onclick="cambiar_texto();">Crear pedido</button> </a>
                      </li>
                      
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  

                  <div class="x_content" id="tbl_prod_pedidos">
                        
                      

                        <div class="row">
                          
                          <ul class="list-unstyled msg_list" id="gallery_products">

                          </ul>

                        </div>

                  </div>
                  <div class="x_content" id="form_pedido">

                    <!--<div class="col-md-4 col-sm-4 ">
                      <div class="product-image" id="">
                        <img src="" alt="..." id="imagen_prod2"/>
                      </div>
  
                    </div>-->

                   

                     
                     <br>
                     <br>
                        

                  </div>
                </div>
              </div>
            </div>
            
            


          </div>
        </div>
        <!-- /page content -->




        <div class="right_col" role="main" id="page_reporte">
          <div class="">
            

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" align="left">
                      
                      
                      <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Historial de movimientos" onclick="listar_historial();"><i class="fa fa-history"></i></button>

                      <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Editar productos" onclick="abrir_edit_prod_list();" id="btn_edit_producto_pedido"><span class="glyphicon glyphicon-edit" aria-hidden="true" style="color: white;"></span></button>
                      <!--<button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Editar productos" onclick="revisar_sinfecha();" id="btn_edit_producto_pedido"><span class="glyphicon glyphicon-edit" aria-hidden="true" style="color: white;"></span></button>-->
                      <!--<button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="" onclick="set_idproducto();"><i class="fa fa-history" id="btn_setid_detped"></i></button>-->
                      
                                    
                    </div>

                    
                    
                    <!--<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" align="right">
                      <button type="button" class="btn btn-dark" id="" onclick="abrir_modal_entregas();"><i class="fa fa-truck"></i>  Entregas</button> 
                    </div>-->
                    
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row" align="">
                        <div class="col-md-12 col-sm-12 ">
                          <div class="x_panel tile fixed_height_320" style="height: auto">
                                <div class="x_title">
                                  
                                    
                                  <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="col-md-2 col-sm-2 ">
                                        <div class="col-md-12 col-sm-12 ">
                                          <strong style="font-size: 12px;" id="tipo_pedido"></strong><br>
                                          
                                        </div>
                                        <div class="col-md-12 col-sm-12 ">
                                          <hr width="100%">
                                        </div>
                                        <div class="col-md-12 col-sm-12 ">
                                         
                                          <strong id="nombre_cli_gen" style="font-size: 15px;"></strong><br>
                                        </div>
                                        <div class="col-md-12 col-sm-12 ">
                                          <hr width="100%">
                                        </div>
                                        <div class="col-md-12 col-sm-12 " >
                                          
                                          <b>No. Control</b><br>
                                          <strong><h1 id="no_control_rep"></h1></strong>
                                          
                                        </div>
                                        <div class="col-md-12 col-sm-12 " >
                                          <b>No. Pedido</b><br>
                                          <strong><h2 id="no_pedido_rep" style="font-size: 20px;"></h2></strong>
                                        </div>
                                        
                                        
                                        <div class="col-md-12 col-sm-12 ">
                                          <hr width="100%"> 
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-9 " style="border-left: ridge;">
                                        <div class="col-md-12 col-sm-12 ">
                                          <div class="col-md-6 col-sm-6 ">
                                            <b>DATOS DE ENTREGA</b>
                                          </div>
                                          <div class="col-md-6 col-sm-6 " align="right">
                                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" id="edit_fecha">
                                                  <span class="glyphicon glyphicon-edit" aria-hidden="true" style="color:#0C5FD4;"></span>  
                                                  </a>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                      
                                                      <div class="form-group col-md-12 col-sm-12">
                                                          <label>Fecha de entrega:</label>
                                                          <input type="date" class="form-control" id="fecha_entrega_upd2">              
                                                      </div>
                                                      <div class="form-group col-md-12 col-sm-12">
                                                          <label>Horario de entrega:</label>
                                                          
                                                          <input class="form-control" class='time' type="time"  id="hora_entrega_upd2">
                                                      </div>
                                                      <div class="form-group col-md-12 col-sm-12">
                                                          <input class="form-control" class='time' type="time"  id="hora_entrega_upd2_2">
                                                      </div>
                                                      <div class="form-group col-md-12 col-sm-12">
                                                          <button type="button" class="btn btn-primary" onclick="set_fecha_hora_entr();">Guardar</button>
                                                      </div>
                                                    
                                                      
                                                   </div><br>
                                          </div>
                                          
                                        </div>
                                        <div class="col-md-12 col-sm-12 ">
                                          <hr width="100%">
                                        </div>
                                        <div class="col-md-12 col-sm-12 ">
                                          <div class="col-md-4 col-sm-4 ">
                                                  
                                                  Contacto: <label id="contacto_ent_rep"></label><br>
                                                  Domicilio.: <label id="dom_ent_rep"></label><br>
                                                  Col.: <label id="col_ent_rep"></label><label id="cuidad_est_ent_rep"></label><br>
                                                  C.P.: <label id="cp_ent_rep"></label><br> 
                                          </div>
                                          <div class="col-md-4 col-sm-4 ">
                                                  Telefono: <label id="tel_ent_rep"></label><br>
                                                  Email: <label id="email_ent_rep"></label><br>
                                                  Fecha de entrega: <label id="fecha_hora_ent_rep"></label><br>
                                                    
                                                  Horario: <label id="hora1_ent_rep"></label><br>
                                          </div>
                                          <div class="col-md-4 col-sm-4 ">
                                                    
                                                    Forma de entrega: <label id="forma_ent_rep"></label><br>
                                                    Detalles de forma de entrega: <label id="forma_ent_rep"></label><br>
                                                    Comentario: <label id="ref_ent_rep"></label><br>
                                          </div>
                                        </div>
                                          
                                        <div class="col-md-12 col-sm-12 ">
                                          <hr width="100%">
                                        </div>
                                        <div class="col-md-12 col-sm-12 ">
                                          <div class="col-md-12 col-sm-12 ">
                                            <b>DATOS DE FACTURACIÓN</b>
                                          </div>
                                            
                                        </div>
                                        <div class="col-md-12 col-sm-12 ">
                                          <hr width="100%">
                                        </div>
                                        <div class="col-md-12 col-sm-12 ">
                                          <div class="col-md-4 col-sm-4 ">
                                                Razón Social: <label id="razon_fac_rep"></label><br>
                                                R.F.C.: <label id="rfc_fac_rep"></label><br> 
                                                Domicilio.: <label id="dom_fac_rep"></label>
                                          </div>
                                          <div class="col-md-4 col-sm-4 ">
                                                Col.: <label id="col_fac_rep"></label><label id="cuidad_fac_rep"></label><label id="estado_fac_rep"></label><br>
                                                C.P.: <label id="cp_fac_rep"></label><br>
                                          </div>
                                          <div class="col-md-4 col-sm-4 ">

                                                Telefono: <label id="tel_fac_rep"></label><br>
                       
                                                Email: <label id="email_fac_rep"></label><br>
                                          </div>
                                        </div>
                                          
                                                
                                    </div>


                                </div>
                          </div>
                        </div>
                                    
                          
                      </div>

                      <div class="row">
                        
                        
                        <div class="col-md-12 col-sm-12 ">
                           
                            <div class="x_panel tile fixed_height_320" style="height: auto">
                              <div class="x_title">
                               
                                    <div class="col-md-12 col-sm-12 ">
                                      <h2>Productos</h2>
                                    </div>
                                
                                  
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                                <div class="col-md-12 col-sm-12">
                                  <div class="table">
                                    <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 420px; width: auto; max-width: 100%">
                                        <table class="table table-striped" id="tbl_rep_pedido" style="width: auto; max-width: 100%;">
                                        </table>

                                        <div class="col-md-12" id="calculo_importes">
                                          <!--<p class="lead">Amount Due 2/22/2014</p>-->
                                          <div class="table-responsive">
                                            <table class="table">
                                              <tbody>
                                                <tr>
                                                  
                                                </tr>
                                                <tr>
                                                  
                                                  
                                                  
                                                  <td rowspan="2" style="width:60%"></td>
                                                  
                                                  <th>Subtotal</th>
                                                  <td><h5 id="subtotal_rep" align="right"></h5></td>
                                                </tr>
                                                <tr>
                                                                                         
                                                 
                                                  <th>IVA (16%)</th>
                                                  <td><h5 id="iva_rep" align="right"></h5></td>
                                                </tr>
                                                <tr> 
                                                  <td style="width:60%"><h6 id="total_rep_letra"></h6></td>  
                                                  
                                                  <th>Total:</th>
                                                  <td><h5 id="total_rep" align="right"></h5></td>
                                                </tr>
                                                <tr>
                                                  
                                                  
                                                </tr>
                                               

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

                          <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel tile fixed_height_320" style="height: auto;">
                              <div class="x_title">
                                
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                              
                                
                                  <div class="dashboard-widget-content">

                                    <div class="col-md-12 col-sm-12 ">
                                      <div class="col-md-12 col-sm-12 ">
                                        <b>DETALLE DE PRODUCTOS</b>
                                      </div>
                                      
                                    </div>
                                    <div class="col-md-12 col-sm-12 " style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 420px; width: auto; max-width: 100%;">
                                      <table id="tbl_detalle_productos" class="table table-hover table-fixed" style="width: 1000px;">
                                            
                                      </table>
                                      
                                    </div>
                                    
                                    
                                    
                                    
                                  </div>
                                    
                                  
                                
                              </div>
                            </div>
                          </div> 

                          <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel tile fixed_height_320" style="height: auto;">
                              <div class="x_title">
                                
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                              
                                
                                  <div class="dashboard-widget-content">

                                    <div class="col-md-12 col-sm-12 ">
                                      <div class="col-md-12 col-sm-12 ">
                                        <b>DOCUMENTOS</b>
                                      </div>
                                      
                                    </div>
                                    <div class="col-md-12 col-sm-12 ">
                                      <hr width="100%">
                                    </div>
                                    <div class="col-md-12 col-sm-12 " id="box_documentos" align="center">

                                    </div>
                                    
                                    
                                    
                                  </div>
                                    
                                  
                                
                              </div>
                            </div>
                          </div>           

                        
                          <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel tile fixed_height_320" style="height: auto;">
                              <div class="x_title">
                                
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                              
                                
                                  <div class="dashboard-widget-content">

                                    <div class="col-md-12 col-sm-12 ">
                                          <div class="col-md-12">
                                            
                                            <label>Observaciones Generales:</label>
                                            <textarea class="form-control" name="observ" id="observ" cols="40" rows="5" onkeyup="update_observ();" onchange="new PNotify({
                                                title: 'Actualizado',
                                                text: 'Campo: Observaciones',
                                                type: 'success',
                                                styling: 'bootstrap3'
                                            }); save_hist_observg();"></textarea>


                                          </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 ">
                                      <hr width="100%">
                                    </div>
                                      
                                    <div class="col-md-12 col-sm-12 ">
                                      <div class="col-md-12 col-sm-12 ">
                                        <b>DETALLE DE PEDIDO</b>
                                      </div>
                                      <div class="col-md-12 col-sm-12 ">
                                        <hr width="100%">
                                      </div>
                                      <div class="col-md-4 col-sm-4 ">

                                        Asesor: <label id="asesor_reporte"></label><br>
                                        Levantó Pedido: <label id="lev_cliente_rep"></label><br>

                                      </div>
                                      <div class="col-md-4 col-sm-4 ">
                                        Cliente Nuevo.: <label id="cli_new_pedido_rep"></label><br>
                                        Medio.: <label id="medio_rep"></label>
                                      </div>
                                      <div class="col-md-4 col-sm-4 ">
                                        LAB.: <br>
                                        <label id="lab_rep"></label>

                                        AUTORIZACIÓN EJECUTIVO DE VENTAS.: <label id="autori_rep"></label>
                                      </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 ">
                                      <hr width="100%">
                                    </div>
                                    <div class="col-md-12 col-sm-12 ">
                                      <div class="col-md-12 col-sm-12 ">
                                        <b>DETALLE DE PAGO</b>
                                      </div>
                                      <div class="col-md-12 col-sm-12 ">
                                        <hr width="100%">
                                      </div>
                                      <div class="col-md-4 col-sm-4 ">
                                        Requisitos legales y reglamentarios aplicables: <label id="requisitos_leg_rep"></label><br>
                                        Empaque: <label id="empaque_rep"></label><br>
                                        Metodo y forma de pago: <label id="metodo_pago_rep"></label><br>
                                        

                                      </div>
                                      <div class="col-md-4 col-sm-4 ">
                                        Uso de CFDI: <label id="uso_cfdi_rep"></label><br>
                                        Enviado a enlace: <label id="enviado_enlace_rep"></label><br>
                                        Salida: <label id="salida_rep"></label><br>
                                      </div>
                                      <div class="col-md-4 col-sm-4 ">
                                        Factura: <label id="factura_rep"></label><br>
                                        Otros: <label id="otroe_rep"></label><br>
                                      </div>

                                    </div>
                                    <div class="col-md-12 col-sm-12 ">
                                      <hr width="100%">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12" align="center">
                                      <a href="" id="enlace_pedido2" onclick="abrir_rep_ped2();" target="_blank">
                                        <button type="button" class="btn btn-primary">Imprimir</button>
                                        
                                      </a>
                                    </div>
                                      
                                    
                                  </div>
                                    
                                  
                                
                              </div>
                            </div>
                          </div>

                         


                        
                    

                        
                          
                        
                      

                        
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      
                      <!-- /.row -->

                      <!-- Table row -->
                      
                      <!-- /.row -->

                      <div class="row" id="pie_rep" style="visibility: hidden;">
                          
                              
                              <div class="col-md-12">
                                  <label style="color: white;">__</label>
                              </div>

                              <div class="col-md-12">
                                
                                <div class="col-md-12">
                                  <label>_</label>
                                </div>
                                <!--<div class="col-md-12">
                                  <button type="button" class="btn btn-dark btn-lg" id="btn_form_ped" onclick="ver_observ_prod();">Observaciones por producto</button>  
                                </div>-->
                                

                                <div class="col-md-12">
                                  <input class="form-control" type="hidden"  id="contador_obser" value="0">
                                  <div class="table" style="overflow:scroll;height:300px;width:100%;">
                                    <table class="table table-striped" id="tbl_obser_prod" >
                                      
                                      
                                    </table>
                                  </div>
                                </div>
                                    
                              </div>
                              <div class="col-md-12">
                                  <label style="color: white;">__</label>
                              </div>
                              <div class="col-md-12">
                                  <label style="color: white;">__</label>
                              </div>
                              <div class="col-md-12">
                                <div class="col-md-4">
                                  <label>Nombre y firma del cliente:</label>
                                  <input type="text" class="form-control" id="nom_fir_cli_rep" onkeyup="update_observ();" onchange="new PNotify({
                                  title: 'Actualizado',
                                  text: 'Campo: Nombre y firma del cliente',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });">
                                </div>
                                
                                <div class="col-md-4">
                                  <label>Nombre y firma de producción:</label>
                                  <input type="text" class="form-control" id="nom_fir_prod_rep" onkeyup="update_observ();" onchange="new PNotify({
                                  title: 'Actualizado',
                                  text: 'Campo: Nombre y firma de producción',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });"> 
                                </div>

                                <div class="col-md-4">
                                  <label>Revisó:</label>
                                  <input type="text" class="form-control" id="reviso_rep" onkeyup="update_observ();" onchange="new PNotify({
                                  title: 'Actualizado',
                                  text: 'Campo: Revisó',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });"> 
                                </div>
                                
                                  

                                <div class="col-md-12">
                                  <label><strong>Se entrega en planta baja, a pie de calle, sin responabilibdad para la empresa.</strong></label>
                                </div>
                                  <div class="col-md-12">
                                    <label style="color: white;">__</label>
                                  </div>
                                  <div class="col-md-12">
                                    <label style="color: white;">__</label>
                                  </div>
                                  <div class="form-group col-md-12 col-sm-12" align="center">
                                    <!--<button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                    
                                    <a href="" id="enlace_pedido" onclick="abrir_rep_ped();" target="_blank">
                                      <button type="button" class="btn btn-primary">Imprimir</button>
                                      
                                    </a>-->

                                    

                                    <!--<button type="button" class="btn btn-primary" onclick="enviar_pedido();">Guardar y enviar</button>-->
                                    
                                  </div>
                              </div>


                              

                        <!-- /.col -->
                      </div>

                     
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <!--<div class="row no-print">
                        <div class=" ">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                      </div>-->
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

       



        <!-- footer content -->
       <!-- <footer>
          <div class="pull-right">
            Pizarrones Guadalajara <a href="http://www.pizarronesguadalajara.com"></a>
          </div>
          <div class="clearfix"></div>
        </footer>-->
        <!-- /footer content -->
      


                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_cliente">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Seleccionar cliente</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:400px;">
                            <div class="form-group col-md-6 col-sm-12" id="buscar_cli">
                                <label>Buscar:</label>
                                <input type="text" class="form-control" name="text_buscar" id="text_buscar" onkeyup="buscar_texto_tbl();" autocomplete="off">
                                           
                            </div>
                            <br>
                            <div class="form-group col-md-6 col-sm-12">
                                <button type="button" class="btn btn-dark btn-lg" id="btn_form_ped" onclick="abrir_modal_new_cli();">Registrar nuevo</button>  
                            </div>

                            <table id="datatable" class="table table-striped table-bordered">  
                            </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         
                        </div>

                      </div>
                    </div>
                  </div>


                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_data_new_cli">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Registrar nuevo cliente</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">

                          

                          <div>
                                
                            <h4 id="tipo_direccion"></h4>

                            
                            <div class="form-group col-md-9 col-sm-12">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" id="nom_cli" onkeyup="buscar_cliente2();">              
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Numero de cliente:</label>
                                <input type="text" class="form-control" id="num_cli" >              
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label>Coincidencias encontradas:</label>
                                <h3 id="num_coin_cli"></h3>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 fondo" id="clientes_exist" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 300px;">
                                
                                       
                            </div>
                            <style type="text/css">
                              .fondo{
                                background: #FED8D4;
                              }
                            </style>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>RFC:</label>
                                <input type="text" class="form-control" id="rfc_cli">              
                            </div>
                            
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Calle:</label>
                                <input type="text" class="form-control" id="calle_cli">              
                            </div>
                            <div class="form-group col-md-2 col-sm-12">
                                <label>Numero:</label>
                                <input type="text" class="form-control" id="numero_cli">              
                            </div>
                            <div class="form-group col-md-2 col-sm-12">
                                <label>Int.:</label>
                                <input type="text" class="form-control" id="int_cli">              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Colonia:</label>
                                <input type="text" class="form-control" id="colonia_cli">            
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Ciudad:</label>
                                <input type="text" class="form-control" id="ciudad_cli">              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Estado:</label>
                                <input type="text" class="form-control" id="estado_cli">              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>C.P.:</label>
                                <input type="text" class="form-control" id="cp_cli">              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Teléfono:</label>
                                <input type="text" class="form-control" id="telefono_cli">              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Email:</label>
                                <input type="text" class="form-control" id="email_cli">              
                            </div>


                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-primary" onclick="save_cliente();">Guardar</button>
                          <button type="button" class="btn btn-secondary" onclick="abrir_modal_select_cli();">Cancelar</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>






                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_data_fact">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Editar datos de facturación</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">

                          

                          <div>
                                
                            <h4 id="tipo_direccion"></h4>

                            
                            <div class="form-group col-md-12 col-sm-12">
                                <label>Razón Social:</label>
                                <input type="text" class="form-control" id="razon_edit">
                                <input type="hidden" class="form-control" id="idfacturacion_edit">                
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label>RFC:</label>
                                <input type="text" class="form-control" id="rfc_edit">              
                            </div>
                            
                            <div class="form-group col-md-8 col-sm-12">
                                <label>Calle:</label>
                                <input type="text" class="form-control" id="calle_edit">              
                            </div>
                            <div class="form-group col-md-2 col-sm-12">
                                <label>Numero:</label>
                                <input type="text" class="form-control" id="numero_edit">              
                            </div>
                            <div class="form-group col-md-2 col-sm-12">
                                <label>Int.:</label>
                                <input type="text" class="form-control" id="int_edit">              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Colonia:</label>
                                <input type="text" class="form-control" id="colonia_edit">            
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Ciudad:</label>
                                <input type="text" class="form-control" id="ciudad_edit">              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Estado:</label>
                                <input type="text" class="form-control" id="estado_edit">              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>C.P.:</label>
                                <input type="text" class="form-control" id="cp_edit">              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Teléfono:</label>
                                <input type="text" class="form-control" id="telefono_edit">              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Email:</label>
                                <input type="text" class="form-control" id="email_edit">              
                            </div>

                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-primary" onclick="update_dir_fac();">Guardar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>






                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_data_ent">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Direcciones de entrega</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">

                          
                                
                          <button type="button" id="btn_newdir" class="btn btn-link" onclick="reg_new_dir_ent();">Nueva dirección</button>            
                         

                          <div id="direcciones" class="form-group col-md-12 col-sm-12">

                                    

                                    <div id="box_direcciones" class="form-group col-md-12 col-sm-12">
                                        
                                    </div>
                                    
                            <!--<div class="form-group col-md-12 col-sm-12" align="center">
                              <button type="button" class="btn btn-dark btn-lg" id="btn_" onclick="">Aceptar</button>
                            </div>-->
                                    

                          </div>

                          <div id="formulario_direccion">
                                
                            <h4 id="tipo_direccion"></h4>

                            
                            <div class="form-group col-md-12 col-sm-12">
                                <label>Contacto:</label>
                                <input type="text" class="form-control" id="contacto_upd">
                                <input type="hidden" class="form-control" id="identrega_upd">
                                <input type="hidden" class="form-control" id="idcliente_upd">               
                            </div>
                            
                            <div class="form-group col-md-8 col-sm-12">
                                <label>Calle:</label>
                                <input type="text" class="form-control" id="calle_upd">              
                            </div>
                            <div class="form-group col-md-2 col-sm-12">
                                <label>Numero:</label>
                                <input type="text" class="form-control" id="numero_upd">              
                            </div>
                            <div class="form-group col-md-2 col-sm-12">
                                <label>Int.:</label>
                                <input type="text" class="form-control" id="int_upd">              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Colonia:</label>
                                <input type="text" class="form-control" id="colonia_upd">            
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Ciudad:</label>
                                <input type="text" class="form-control" id="ciudad_upd">              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Estado:</label>
                                <input type="text" class="form-control" id="estado_upd">              
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>C.P.:</label>
                                <input type="text" class="form-control" id="cp_upd">              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Teléfono:</label>
                                <input type="text" class="form-control" id="telefono_upd">              
                            </div>
                            <div class="form-group col-md-5 col-sm-12">
                                <label>Email:</label>
                                <input type="text" class="form-control" id="email_upd">              
                            </div>

                            

                            <div class="form-group col-md-4 col-sm-12">
                                <label>Fecha de entrega:</label>
                                <input type="date" class="form-control" id="fecha_entrega_upd" disabled>              
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>Horario de entrega:</label> 
                                <input class="form-control" class='time' type="time" name="time" id="hora_entrega_upd">
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label>_</label> 
                                <input class="form-control" class='time' type="time" name="" id="hora_entrega_upd_r2">
                            </div>
                            
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Forma de entrega:</label>
                                <select  class="form-control" id="forma_entrega_upd">
                                  <option value="">Seleccionar..</option>
                                  <option value="nosotros">Nosotros</option>
                                  <option value="cliente">Cliente recoge</option>
                                  <option value="transporte">Transporte</option>
                                  <option value="servicio">Servicio</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                        <label>Empaque:</label>
                                          <select  id="empaque" class="form-control selectpicker">
                                            <option value="">Seleccionar</option>
                                            <option value="Local">Local</option>
                                            <option value="Paqueteria">Paqueteria</option>
                                            <option value="Camión">Camión</option>
                                            
                                          </select>             
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label>Detalles de forma de entrega:</label> 
                                <input type="text" class="form-control" id="det_forma_entrega_upd"> 
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <label>Referencia:</label>
                                <input type="text" class="form-control" id="referencia_upd">              
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <h6>¿Para la entrega de este pedido, se va adjuntar una factura o recibo?</h6>             
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                          <select  id="doc_ped_sal" class="form-control selectpicker">
                                            <option value="">Seleccionar</option>
                                            <option value="1">Si</option>
                                            <option value="2">No</option> 
                                          </select>       

                            </div>
                            <div class="form-group col-md-12 col-sm-12" align="center">
                              <button type="button" class="btn btn-dark btn-lg" id="btn_guardar_dir_ent" onclick="save_dir_ent();">Guardar</button>
                              <button type="button" class="btn btn-dark btn-lg" id="btn_update_dir_ent" onclick="update_dir_ent();">Aceptar</button> 
                            </div>
                                   
                        </div>
                            
                            
                            

                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_edit_prod_rep">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Editar producto (pedido)</h4>
                          
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Cantidad:</label>
                                <input type="number" class="form-control" id="cantidad_rep" onkeyup="calcular_importe_modal();">
                                <input type="hidden" class="form-control" id="idproducto_rep">                
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Unidad:</label>
                                <input type="text" class="form-control" id="unidad_rep">                
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Codigo:</label>
                                <input type="text" class="form-control" id="codigo_rep" disabled="">                
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Medida:</label>
                                <input type="text" class="form-control" id="medida_rep">                
                            </div>
                            <div class="form-group col-md-10 col-sm-10">
                                <label>Descripción:</label>
                                <input type="text" class="form-control" id="descripcion_rep">                
                            </div>
                            <div class="form-group col-md-2 col-sm-2">
                                <label>Color:</label>
                                <input type="text" class="form-control" id="color_rep">              
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Precio (Sin IVA):</label>
                                <input type="number" class="form-control" id="precio_rep" onkeyup="calcular_importe_modal();" disabled="">                
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Descuento (%):</label>
                                <input type="number" class="form-control" id="descuento_rep" onkeyup="calcular_importe_modal();">                
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Descuento ($):</label>
                                <input type="number" class="form-control" id="descuento_rep2" disabled="">                
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Importe:</label>
                                <input type="number" class="form-control" id="importe_rep" disabled="">                
                            </div>
                            <br>


                            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" onclick="update_prod_rep();">Guardar</button>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_edit_prod_pedido">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Editar producto (pedido)</h4>
                          
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Cantidad:</label>
                                <input type="number" class="form-control" id="cantidad_pedido_edit" onkeyup="calcular_importe_modal_edit_prod();">
                                <input type="hidden" class="form-control" id="idproducto_pedido_edit">                
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Unidad:</label>
                                <input type="text" class="form-control" id="unidad_pedido_edit">                
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Codigo:</label>
                                <input type="text" class="form-control" id="codigo_pedido_edit" disabled="">                
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Medida:</label>
                                <input type="text" class="form-control" id="medida_pedido_edit">                
                            </div>
                            <div class="form-group col-md-10 col-sm-10">
                                <label>Descripción:</label>
                                <input type="text" class="form-control" id="descripcion_pedido_edit">                
                            </div>
                            <div class="form-group col-md-2 col-sm-2">
                                <label>Color:</label>
                                <input type="text" class="form-control" id="color_pedido_edit">              
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Precio (Sin IVA):</label>
                                <input type="number" class="form-control" id="precio_pedido_edit" onkeyup="calcular_importe_modal();" disabled="">                
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Descuento (%):</label>
                                <input type="number" class="form-control" id="descuento_pedido_edit" onkeyup="calcular_importe_modal();">                
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Descuento ($):</label>
                                <input type="number" class="form-control" id="descuento_rep2_pedido_edit" disabled="">                
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label>Importe:</label>
                                <input type="number" class="form-control" id="importe_pedido_edit" disabled="">                
                            </div>
                            <br>


                            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" onclick="update_prod_rep();">Guardar</button>
                        </div>

                      </div>
                    </div>
                  </div>


                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_productos">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Seleccionar Producto</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:400px;">
                            <div class="form-group col-md-6 col-sm-12">
                                <label>Buscar:</label>
                                <input type="text" class="form-control" name="text_buscar_prod" id="text_buscar_prod" onkeyup="buscar_texto_tbl_prod();" autocomplete="off">
                                           
                            </div>
                            <br>
                            <div class="form-group col-md-6 col-sm-12">
                                <button type="button" class="btn btn-primary btn-lg" id="btn_new_prod" onclick="abrir_modal_new_prod();">Registrar nuevo</button>  
                            </div>

                            <table id="datatable_prod" class="table table-striped table-bordered">  
                            </table>


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         
                        </div>

                      </div>
                    </div>
                  </div>





                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_productos_visual">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Seleccionar Producto</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            




                                <div class="row" id="select_product_area">
                                  <div class="col-md-12 col-sm-12 ">
                                    <div class="x_panel">
                                      <button class="btn btn-dark source" onclick="new PNotify({
                                                      title: 'Producto agregado',
                                                      text: 'Puedo consultar los productos agregados en el panel de notificaciones',
                                                      type: 'success',
                                                      styling: 'bootstrap3'
                                                  });guardar_prod_ped();">Agregar a pedido</button> 

                                      <button class="btn btn-dark source" onclick="ver_imagen();">Regresar</button> 
                                      <button class="btn btn-dark source" onclick="ver_modelo_3d();">Ver modelo 3D</button>


                                      <div class="x_content" id="vista_select">
                                        <div class="col-md-7 col-sm-7">
                                          <div class="product-image" id="">
                                           
                                            <img src="" alt="..." id="imagen_prod" />

                                            <input type="hidden" class="form-control" name="id_ped_temp" id="id_ped_temp">
                                          </div> 
                                        </div>
                                        <style type="text/css">
                                          .posicion{
                                            position: relative;
                                          }

                                          .boton{
                                            font-size:30px;
                                            font-family:Verdana,Helvetica;
                                            
                                            color:white;
                                            background:#076731;
                                            border:0px;
                                            width:100%;
                                            height:80px;
                                            border-radius: 15px;
                                          }
                                            .boton:hover {
                                            background-color: #062C59;
                                          }

                                            .boton:active {
                                            background-color: #000000;
                                            
                                          }
                                        </style>
                                        <div class="col-md-5 col-sm-5 " style="border:0px solid #e5e5e5; overflow:scroll;height:400px;" id="pagina1">
                                          <label id="lbl_tipo" style="visibility: hidden;"></label>
                                          <label id="lbl_tamano" style="visibility: hidden;"></label>
                                          <label id="lbl_modelo" style="visibility: hidden;"></label>
                                          <label id="lbl_color" style="visibility: hidden;"></label>
                                          <h6>Tipos</h6>
                                          <br>
                                          <div class="" id="box_tipos">
   
                                          </div>
                                          <br>
                                          <h6>Modelos</h6>
                                          <br>
                                          <div class="" id="box_modelos">
  
                                          </div>
                                          <br>
                                          <h6>Tamaños</h6> 
                                          <br>
                                          <label id="idtamano" style="visibility: hidden;"></label>
                                          <label id="codigo2" style="visibility: hidden;"></label>
                                          <label id="marca2" style="visibility: hidden;"></label>
                                          <div class="" id="box_tamanos">

                                          </div>
                                          <h6>Colores</h6>
                                          <br>
                                          <label id="codigo3" style="visibility: hidden;"></label>
                                          <label id="marca3" style="visibility: hidden;"></label>
                                          <div class="" id="box_colores">
                                                   
                                          </div>

                                          <br>

                                        </div>
                                        
                                      </div>


                                      <div class="x_content" id="vista_3d">

                                       

                                            

                                          

                                      </div>

                                    </div>
                                  </div>

                                </div>




                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="abrir_pagina_pedido();">Aceptar</button>
                         
                        </div>

                      </div>
                    </div>
                  </div>
                

      </div>
    </div>



    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_reg_productos">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Agregar producto</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:300px;">


                            <div class="form-group col-md-6 col-sm-6">
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
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>CODIGO:</label>
                                <input type="text" class="form-control" id="codigo_new_prod" onkeyup="buscar_prod_exist();">
                            </div>
                            
                            <div class="col-md-12 col-sm-12">
                                <label>NOMBRE:</label>
                                <input type="text" class="form-control" id="nombre_new_prod">
                            </div>
                            <div class="form-group col-md-12 col-sm-12 fondo" id="prod_exist" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 300px;">
                                
                                       
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label>COLOR:</label>
                                
                                
                                

                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-adjust" aria-hidden="true" style="color:#0C5FD4;"><strong> Select</strong></span></a>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          
                                          
                                          <button style="background: #F8E209;" type="button" class="btn btn-round " onclick="selec_color1();">   
                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="color: #F8E209;"></span>
                                          </button>

                                          <button style="background: #0A72C1;" type="button" class="btn btn-round " onclick="selec_color2();">   
                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="color: #0A72C1;"></span>
                                          </button>

                                          <button style="background: #E67341;" type="button" class="btn btn-round " onclick="selec_color3();">   
                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="color: #E67341;"></span>
                                          </button>

                                          <button style="background: #D73D47;" type="button" class="btn btn-round " onclick="selec_color4();">   
                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="color: #D73D47;"></span>
                                          </button>

                                          <button style="background: #12844D;" type="button" class="btn btn-round " onclick="selec_color5();">   
                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="color: #12844D;"></span>
                                          </button>

                                          <button style="background: #ffffff; border-color: #9B9C9C;" type="button" class="btn btn-round " onclick="selec_color6();">   
                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="color: #000000;">Otro</span>
                                          </button>
                                          
                                       </div>

                                <input type="text" class="form-control" id="color_new_prod" disabled="">

                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label>MEDIDA:</label>
                                <input type="text" class="form-control" id="medida_new_prod">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label>PRECIO (SIN IVA):</label>
                                <input type="text" class="form-control" id="precio_new_prod">
                            </div>
                            
                            

                          


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" onclick="save_prod();">Guardar</button>
                          <button type="button" class="btn btn-secondary" onclick="cerrar_new_prod();">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_entregas">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6" align="left">
                            <h2 id="titulo_entrega">ENTREGAS</h2>
                          </div>
                          
                          
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="encabezado_prod_ped" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h6>Productos del pedido</h6>
                              </div>
                              <table id="tbl_productos_pedido" class="table table-striped table-bordered">  
                              </table>

                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="tbl_entregas" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">
                              <div class="col-md-12 col-sm-12" align="center">
                                <h1 id="num_entregas"></h1>

                              </div>
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                                <button type="button" class="btn btn-round btn-info" id="" onclick="registrar_entrega();">+</button> 
                              </div>
                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h6>Entregas</h6>
                              </div>
                              <table id="datatable_entregas" class="table table-striped table-bordered">  
                              </table>
                          </div>



                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="form_entregas" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">



                                    <div class="col-md-4 col-sm-4">
                                      <label>FECHA:</label>
                                      <input type="date" class="form-control" name="fecha_sal" id="fecha_sal">
                                      <input type="hidden" class="form-control" id="identregas_reg">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>No. SALIDA:</label>
                                      <input type="text" class="form-control" name="no_salida_sal" id="no_salida_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>No. CONTROL:</label>
                                      <input type="text" class="form-control" name="no_control_sal" id="no_control_sal" disabled="">
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                      <label>No. PEDIDO:</label>
                                      <input type="text" class="form-control" name="no_pedido_sal" id="no_pedido_sal" disabled="">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>NOMBRE:</label>
                                      <input type="text" class="form-control" name="nombre_sal" id="nombre_sal">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>ENTREGADO A:</label>
                                      <input type="text" class="form-control" name="entregado_a_sal" id="entregado_a_sal">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>DOMICILIO:</label>
                                      <input type="text" class="form-control" name="domicilio_sal" id="domicilio_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>COLONIA:</label>
                                      <input type="text" class="form-control" name="colonia_sal" id="colonia_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>MUNICIPIO:</label>
                                      <input type="text" class="form-control" name="municipio_sal" id="municipio_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>ESTADO:</label>
                                      <input type="text" class="form-control" name="estado_sal" id="estado_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>C.P.:</label>
                                      <input type="text" class="form-control" name="cp_sal" id="cp_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>CONTACTO:</label>
                                      <input type="text" class="form-control" name="contacto_sal" id="contacto_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>TELEFONO:</label>
                                      <input type="text" class="form-control" name="telefono_sal" id="telefono_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>HORARIO:</label>
                                      <input type="text" class="form-control" name="horario_sal" id="horario_sal">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>CONDICIONES:</label>
                                      <input type="text" class="form-control" name="condiciones_sal" id="condiciones_sal">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>MEDIO DE TRANSPORTE:</label>
                                      <input type="text" class="form-control" name="medio_sal" id="medio_sal">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>_</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12" align="center">
                                      
                                      <button type="button" class="btn btn-round btn-info"  onclick="add_prod();">Seleccionar productos</button>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                          <h6>PRODUCTOS A ENTREGAR</h6>
                                          <table id="datatable_prod_entregas" class="table table-hover">   
                                          </table>
                                    </div>

                                         

                          </div>

                          <div class="col-md-12 col-sm-12">
                              <button type="button" class="btn btn-primary" onclick="regresar_a_entregas();" id="btn_regresar_a_entregas">Regresar</button>
                          </div>


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" onclick="save_entrega();" id="btn_guardar_entrega">Guardar</button>
                          <button type="button" class="btn btn-primary" onclick="actualizar_entrega();" id="btn_actualizar_entrega">Actualizar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div>


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_reg_productos_ped">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Agregar producto</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">

                                    <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 300px;">
                                          
                                          <h5>PRODUCTOS DEL PEDIDO</h5>
                                          <table id="datatable_prod_pedido" class="table table-hover">
                                            
                                          </table>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>_</label>
                                    </div>

                                    <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 300px;">
                                          
                                          <h5>AGREGADOS A LA ENTREGA ACTUAL</h5>
                                          <table id="datatable_prod_pedido_agregados" class="table table-hover">
                                            
                                          </table>
                                    </div>


                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div>


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_entregas_ped">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">DATOS DE ENTREGA</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">

                                    <div class="col-md-4 col-sm-4">
                                      <label>FECHA:</label>
                                      <input type="date" class="form-control" name="fecha_d_entr" id="fecha_d_entr" disabled="">
                                      
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>No. SALIDA:</label>
                                      <input type="text" class="form-control" name="no_salida_d_entr" id="no_salida_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>No. CONTROL:</label>
                                      <input type="text" class="form-control" name="no_control_d_entr" id="no_control_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                      <label>No. PEDIDO:</label>
                                      <input type="text" class="form-control" name="no_pedido_d_entr" id="no_pedido_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>NOMBRE:</label>
                                      <input type="text" class="form-control" name="nombre_d_entr" id="nombre_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>ENTREGADO A:</label>
                                      <input type="text" class="form-control" name="entregado_a_d_entr" id="entregado_a_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>DOMICILIO:</label>
                                      <input type="text" class="form-control" name="domicilio_d_entr" id="domicilio_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>COLONIA:</label>
                                      <input type="text" class="form-control" name="colonia_d_entr" id="colonia_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>MUNICIPIO:</label>
                                      <input type="text" class="form-control" name="municipio_d_entr" id="municipio_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>ESTADO:</label>
                                      <input type="text" class="form-control" name="estado_d_entr" id="estado_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>C.P.:</label>
                                      <input type="text" class="form-control" name="cp_d_entr" id="cp_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>CONTACTO:</label>
                                      <input type="text" class="form-control" name="contacto_d_entr" id="contacto_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>TELEFONO:</label>
                                      <input type="text" class="form-control" name="telefono_d_entr" id="telefono_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>HORARIO:</label>
                                      <input type="text" class="form-control" name="horario_d_entr" id="horario_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                      <label>CONDICIONES:</label>
                                      <input type="text" class="form-control" name="condiciones_d_entr" id="condiciones_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>MEDIO DE TRANSPORTE:</label>
                                      <input type="text" class="form-control" name="medio_d_entr" id="medio_d_entr" disabled="">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>_</label>
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12">
                                          <h6>PRODUCTOS EN ENTREGA</h6>
                                          <table id="datatable_dp_entrega" class="table table-hover">
                                            
                                          </table>
                                    </div>     


                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div>


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_historial">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Historial de movimientos</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">

                                    <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 300px;">
                                          
                                          
                                          <table id="datatable_historial" class="table table-hover">
                                            
                                          </table>
                                    </div>
                                   


                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_edit_prod_list">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content" style="border:0px solid #e5e5e5; overflow:scroll;height:100vh;">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Editar productos</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">

                          <div class="col-md-12 col-sm-12">
                            <div class="col-md-12 col-sm-12">
                              <label>¿Que desea hacer?</label>
                              <select  class="form-control" id="tipo_edit_prod" onchange="tipo_edit_prod();">                                                 
                                <option value="select">SELECCIONAR</option>
                                <option value="1">Agregar</option>
                                <option value="2">Quitar</option>
                                <option value="3">Cambiar</option>
                                <option value="4">Editar</option>                                                     
                              </select>
                            </div>
                            <div class="col-md-12 col-sm-12">
                              <hr width="100%">
                            </div>
                            <div class="col-md-12 col-sm-12" id="div_agregar">
                              
                              <div class="form-group col-md-12 col-sm-12">
                                <label>Buscar codigo</label>
                              </div>
                              <div class="form-group col-md-10 col-sm-10">
                                <input type="text" class="form-control" id="buscar_prod_list" value="">  
                              </div>
                              <div class="form-group col-md-2 col-sm-2">
                                <button id="" type="button" class="btn btn-dark" onclick="listar_productos_list();">Buscar</button>
                              </div>
                              
                              <div class="col-md-12 col-sm-12">
                                <hr width="100%">
                              </div>
                              <table id="tbl_productos_list" class="table table-hover">
                              </table>
                            </div>
                            <div class="col-md-12 col-sm-12" id="div_quitar" style="border:0px solid #e5e5e5; overflow:scroll;max-height: 400px;">
                              <table id="tbl_productos_pedido_exist" class="table table-hover">
                              </table>
                            </div>
                            <div class="col-md-12 col-sm-12" id="div_cambiar" style="border:0px solid #e5e5e5; overflow:scroll;max-height: 400px;">
                             <!-- <table id="tbl_productos_pedido_exist2" class="table table-hover">

                              </table>-->
                              <div class="col-md-12 col-sm-12">
                                <label>Selecciona el producto a cambiar</label>
                              </div>

                              <div class="col-md-12 col-sm-12  ">
                                <div class="x_panel">
                                  
                                  <div class="x_content" id="tbl_productos_pedido_exist2">

                                    <!-- start accordion -->
                                    
                                      
                                    
                                    <!-- end of accordion -->


                                  </div>
                                </div>
                              </div>

                            </div>
                            <div class="col-md-12 col-sm-12" id="div_editar" style="border:0px solid #e5e5e5; overflow:scroll;max-height: 400px;">
                              <table id="tbl_productos_pedido_exist_edit" class="table table-hover">
                              </table>
                            </div>              
                                          
                          </div>
                                   


                        </div>
                        <div class="modal-footer">
                          
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          
                        </div>

                      </div>
      </div>
    </div>





    <div class="notification">
          <span class="icon">
              <i class=""></i>
          </span>
          <span class="text"></span>
          <span class="close"><i class="fa fa-close"></i></span>
    </div>

    <!--<section class="buttons">
         <button id="info">Info</button>
         <button id="warn">Warning</button>
         <button id="error">Fatal</button>
    </section>-->


    

            
                  

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <script src="vendors/pnotify/dist/pnotify.js"></script>
    <script src="vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="vendors/pnotify/dist/pnotify.nonblock.js"></script>

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
    <script src="build/js/custom.min.js"></script>
    <script type="text/javascript" src="scripts/diseno.js?v=<?php echo(rand()); ?>"></script>
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