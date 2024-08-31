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

        <script type="text/javascript">
          var intevalo4 = setInterval('contar_prod_sinrev()',50000);
          var intevalo = setInterval('cargar_notif()',50000);
          var intevalo3 = setInterval('notif_observ()',50000);
        </script>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="page-title">


              <div class="title_right">
                <div class="col-md-12 col-sm-12   form-group pull-right top_search">
                  <!--<div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Buscar</button>

                    </span>
                  </div>-->
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">


                        <div style="padding-top: 10px;">
                          <ul class="nav panel_toolbox" style="float: left;">
                            <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: #73879C; margin-right: 30px; margin-top: -7px"><label id="text_estatus" style="font-size: 12px;">Filtrar:</label></a><br>


                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="#" onclick="filtro_option6();">Todo</a>
                                  <a class="dropdown-item" href="#" onclick="filtro_option1();">Sin entregar</a>
                                  <a class="dropdown-item" href="#" onclick="filtro_option2();">Listos para entrega</a>
                                  <a class="dropdown-item" href="#" onclick="filtro_option3();">Entregados</a>
                                  <hr width="100%">
                                  <a class="dropdown-item" href="#" onclick="filtro_option4();">Pendiente</a>
                                  <a class="dropdown-item" href="#" onclick="filtro_option5();">Cancelado</a>
                              </div>
                            </li>
                             <li style="">
                               <label>Buscar por:</label>
                             </li>
                             <li>

                                  <select  class="form-control" id="selec_busqueda" onchange="selec_tipo_busqueda();" style="border-style: none; width: 150px; font-size: 12px; margin-top: -5px;">
                                      <option value="1">No. Control</option>
                                      <option value="2">Nombre de cliente</option>
                                      <option value="3">Fechas</option>
                                  </select>
                              </li>



                              <li style=" padding-left: 10px;" id="li_buscar_control">
                                <input id="input_buscar" type="number" style="border-style: none; border-bottom: groove;" placeholder="No. Control" onkeypress="if (event.keyCode==13) {event.returnValue=false;buscar_control();}">

                              </li>

                              <li id="li_buscar_btns2">
                                <button  type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Buscar control"  onclick="buscar_control();"><span class="glyphicon glyphicon-search" aria-hidden="true" style="color: black;"></span></button>
                                <button  type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Limpiar" onclick="init();" style="margin-left: -5px;"><i class="fa fa-refresh"></i></button>
                              </li>

                              <li style=" padding-left: 10px;" id="li_buscar_fecha">
                                <input type="date" class="" id="fecha1_consul" style="border-style: none; border-bottom: groove;" onchange="valid_datos_fecha();">
                                <label> - </label>
                                <input type="date" class="" id="fecha2_consul" style="border-style: none; border-bottom: groove; margin-right: 20px;" onchange="valid_datos_fecha();">
                              </li>
                              <li style=" padding-left: 10px;" id="li_buscar_nombre">
                                <input type="text" id="nombre_cliente" placeholder="Nombre de cliente" style="border-style: none; border-bottom: groove;" onkeyup="valid_nom_cli();">
                                <input type="hidden" id="valor_consulta">

                              </li>
                              <li style=" padding-left: 10px;" id="li_buscar_btns">
                                <button  type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Buscar" onclick="buscar_valores();"><span class="glyphicon glyphicon-search" aria-hidden="true" style="color: black;"></span></button>
                                <button  type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Limpiar" onclick="init();" style="margin-left: -5px;"><i class="fa fa-refresh"></i></button>
                              </li>
                           </ul>
                           <ul class="nav navbar-right panel_toolbox">
                            <!--<li style="margin-right: 50px;">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: #73879C; font-size: 20px; margin-left: 30px;"><label id="text_estatus">Sin entregar</label></a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="#" onclick="filtro_option6();">Todo</a>
                                  <a class="dropdown-item" href="#" onclick="filtro_option1();">Sin entregar</a>
                                  <a class="dropdown-item" href="#" onclick="filtro_option2();">Listos para entrega</a>
                                  <a class="dropdown-item" href="#" onclick="filtro_option3();">Entregados</a>
                                  <hr width="100%">
                                  <a class="dropdown-item" href="#" onclick="filtro_option4();">Pendiente</a>
                                  <a class="dropdown-item" href="#" onclick="filtro_option5();">Cancelado</a>
                              </div>
                            </li>-->
                            <li>
                              <button  type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Vales de salida de almacén" onclick="abrir_vale();" style="margin-right: 5px;"><i class="fa fa-file-text-o"></i></button>
                            </li>
                            <li>
                              <button onclick="abrir_terminados();" id="btn_terminados" class="btn" type="button" style="color: #fff; font-size: 15px; padding-top: 3px; margin-right: 5px;" data-toggle="tooltip" data-placement="top" title="Terminados">
                                <i class="fa fa-check-circle" style="font-size: 20px; color: #037739;"></i>
                              </button>
                              <span style="background: #313E46; border-width: 5px; border-style: solid; border-color: #313E46;  color: #fff; font-size: 12px; position: absolute; margin-left: -22px; margin-top: -12px; border-radius: 30px 30px; font-weight: 400;" id="num_notif"></span>
                            </li>
                             <li  id="btn_sin_revisar">
                              <button onclick="pedidos_atencion();" class="btn" type="button" style="color: #fff; font-size: 15px; padding-top: 3px; margin-right: 5px;" data-toggle="tooltip" data-placement="top" title="Sin revisar">
                                <i class="fa fa-spinner" style="font-size: 20px; color: #283C50;"></i>

                              </button>
                              <span style="background: #313E46; border-width: 5px; border-style: solid; border-color: #313E46;  color: #fff; font-size: 12px; position: absolute; margin-left: -22px; margin-top: -12px; border-radius: 30px 30px; font-weight: 400;" id="num_notif_ped_sr"></span>
                            </li>
                             <li  id="btn_vencidos">

                              <button onclick="pedidos_vencidos();" class="btn" type="button" style="color: #fff; font-size: 15px; padding-top: 3px;" data-toggle="tooltip" data-placement="top" title="Pedidos vencidos">
                                <i class="fa fa-clock-o" style="font-size: 20px; color: red;"></i>
                                <i class="fa fa-warning" style="margin-top: 10px; margin-left: -8px; position: absolute; font-size: 12px; color: red;"></i></button>
                              <span style="background: #313E46; border-width: 5px; border-style: solid; border-color: #313E46;  color: #fff; font-size: 12px; position: absolute; margin-left: -25px; margin-top: -12px; border-radius: 30px 30px; font-weight: 400;" id="num_vencidos"></span>

                            </li>




                          </ul>
                        </div>



                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">

                      <div class="col-sm-3">
                          <div class="col-sm-12" style="text-align: center;" id="btn_paginado">
                            <button class="btn btn-sm btn-primary" type="button" onclick="anterior_bloque();" style="font-size: 10px;" id="btn_ant_paginado">Anterior</button>
                            <button class="btn btn-sm btn-secondary" type="button" id="num_pagina" style="font-size: 10px;">1</button>
                            <button class="btn btn-sm btn-primary" type="button" onclick="siguiente_bloque();" style="font-size: 10px;" id="btn_sig_paginado">Siguiente</button>
                          </div>
                          <div class="col-sm-12 mail_list_column" id="div_lista_pedidos" style="overflow:scroll;height:1400px; width:100%;">

                          </div>
                          <div class="col-sm-12" style="text-align: center;" id="btn_paginado2">
                            <button class="btn btn-sm btn-primary" type="button" onclick="anterior_bloque();" style="font-size: 10px;" id="btn_ant_paginado2">Anterior</button>
                            <button class="btn btn-sm btn-secondary" type="button" id="num_pagina2" style="font-size: 10px;">1</button>
                            <button class="btn btn-sm btn-primary" type="button" onclick="siguiente_bloque();" style="font-size: 10px;" id="btn_sig_paginado2">Siguiente</button>
                          </div>
                      </div>

                      <style type="text/css">
                        .hov:hover{
                            background-color: #E8F5E3;
                        }
                      </style>
                      <!-- /MAIL LIST -->

                      <!-- CONTENT MAIL -->
                      <div class="col-sm-9 mail_view ">
                        <div class="inbox-body">
                          <div class="mail_heading row">

                            <!--<div class="col-md-8">
                              <div class="btn-group">
                                <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
                                <button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                              </div>
                            </div>-->

                            <!--<div class="col-md-12 text-right">
                              <p class="date"> 8:02 PM 12 FEB 2014</p>
                            </div>-->
                            <div class="col-md-12">



                              <div class="col-md-11">

                                <div class="col-md-12" style="background: #E2E2E2; border-radius: 15px 15px;">

                                  <div class="col-md-5" style="  padding-top: 20px; padding-bottom: 20px; padding-left: 20px; padding-right: 20px; height: 200px;">
                                    <button id="btn_estatus_ped" type="button" class="btn btn-sm btn-dark btn-block" data-toggle="tooltip" data-placement="top" title="Cambiar estatus de pedido" onclick="abrir_seg_ped();" style="color: #fff; font-size: 12px; font-style: bold; margin-right: -10px;"></button><br>
                                    <b id="tipo_pedido" style="font-size: 15px; color: #315364;"></b><br>
                                    Origen: <b id="lugar" style="color: #313A4D;"></b><br>
                                    CONTROL | PEDIDO | CLIENTE
                                    <p style="font-size: 20px; margin-bottom: 1px; color: #313A4D;"><b id="no_control"></b> | <b id="no_pedido" style="font-size: 15px;"></b> | <b id="cliente" style="font-size: 12px; text-decoration-line: underline; color: #313A4D;"></b></p>


                                  </div>

                                  <div class="col-md-7" style="padding-top: 20px; padding-bottom: 20px; padding-left: 20px; padding-right: 20px; height: 200px;">
                                    <label>Documentos:</label>
                                    <div class="col-md-12" id="box_documentos" style="overflow: auto; height:130px;width:100%;">

                                    </div>
                                  </div>
                                  <style type="text/css">
                                    #box_documentos::-webkit-scrollbar{
                                      width: 7px;
                                    }

                                    #box_documentos::-webkit-scrollbar-thumb{
                                      background: #283C50;
                                      border-radius: 5px 5px;
                                    }

                                    #div_lista_pedidos::-webkit-scrollbar{
                                      width: 7px;
                                    }

                                    #div_lista_pedidos::-webkit-scrollbar-thumb{
                                      background: #283C50;
                                      border-radius: 5px 5px;
                                    }

                                    body::-webkit-scrollbar{
                                      width: 7px;
                                    }

                                    body::-webkit-scrollbar-thumb{

                                      border-radius: 5px 5px;
                                    }


                                  </style>
                                  <div class="col-md-12">
                                    <div class="col-md-12">

                                        <p style="color: #313A4D;"><i class="fa fa-comments-o" style="font-size: 12px;" data-toggle="tooltip" data-placement="top" title="Observaciones generales"></i><b id="observ_ini" style="margin-left: 10px; font-size: 10px;"></b><a href="#" onclick="abrir_edit_observ();" style="margin-left: 10px;">(Editar observaciones)</a></p><br>
                                        <p style="margin-top: -20px; color: #313A4D;"><i class="fa fa-truck" style="font-size: 12px;" data-toggle="tooltip" data-placement="top" title="Detalles de forma de entrega"></i><b id="detalles_form_entre_ini" style="margin-left: 10px;"></b></p>
                                    </div>

                                  </div>

                                </div>



                                <div class="col-md-12">
                                      <hr width="100%">
                                </div>


                                <div class="col-md-12">
                                  <div id="wizard" class="form_wizard wizard_horizontal">
                                    <ul class="wizard_steps">
                                      <li>
                                        <a href="#step-1">
                                          <span class="step_no">|</span>
                                          <span class="step_descr">

                                                            Fecha de pedido:<br />
                                                            <small><b id="fecha"></b></small>
                                                        </span>
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#step-2" onclick="abrir_modal_fecha_modif();">
                                          <span class="step_no"><span class="glyphicon glyphicon-edit" aria-hidden="true" style="color:#FFF;"></span> </span>
                                          <span class="step_descr">

                                                            Entrega producción:<br/>
                                                            <small><b id="fecha_entrega"></b></small>

                                                        </span>
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#step-3">
                                          <span class="step_no">|</span>
                                          <span class="step_descr">

                                                            Fecha cliente:<br />
                                                            <small><b id="fecha_ent_cliente"></b></small>
                                                        </span>
                                        </a>
                                      </li>

                                    </ul>
                                  </div>


                                </div>


                              </div>
                              <div class="col-md-1" style="background: #283C50; border-radius: 15px 15px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">
                                <button id="compose" type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Iniciar chat del pedido" onclick="abrir_chat();" style="font-size: 20px; padding-right: -10px;"><i class="fa fa-wechat" style="color: #fff;"></i></button>
                                <a href="" id="enlace_pedido2" onclick="abrir_rep_ped2();" target="_blank">
                                    <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Imprimir pedido" style="font-size: 20px; padding-right: -10px;"><i class="fa fa-print" style="color: #fff;"></i></button>

                                </a>
                                <button id="" type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Descargar salidas" onclick="abrir_modal_doc_salidas();" style="font-size: 20px; padding-right: -10px;"><i class="fa fa-truck" style="font-size: 15px; color: #fff;"></i></button>
                                <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Historial de movimientos"onclick="listar_historial();" style="font-size: 20px; padding-right: -10px;"><i class="fa fa-history" style="color: #fff;"></i></button>
                                <button id="btn_edit_prod" type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Editar productos" onclick="abrir_edit_prod_list();" style="font-size: 20px; padding-right: -10px;"><span class="glyphicon glyphicon-edit" aria-hidden="true" style="color: #fff;"></span></button>
                                <button id="" type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Agregar documentos" onclick="abrir_documentos();"><i class="fa fa-file" style="font-size: 20px; padding-right: -10px; color: #fff;"></i></button>

                              </div>
                              <input type="hidden" id="estatus_pedido">
                              <input class="form-control" type="hidden"  id="idpedido">

                            </div>





                            <div class="col-md-12">
                                  <hr width="100%">
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                  <label>PRODUCTOS</label>
                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 " id="div_prod_list_ped" style="border:0px solid #e5e5e5; overflow:auto;height:auto; max-height: 400px; width: auto; max-width: 100%; margin-bottom: 20px;">
                                      <table id="tbl_detalle_productos" class="table table-hover table-fixed" style="width: 1000px;">

                                      </table>

                            </div>

                            <style type="text/css">
                                    #div_prod_list_ped::-webkit-scrollbar{
                                      height: 10px;
                                      width: 10px;
                                    }

                                    #div_prod_list_ped::-webkit-scrollbar-thumb{
                                      background: #283C50;
                                      border-radius: 5px 5px;
                                    }
                            </style>

                            <div class="col-md-12" style="background-color: #F2F9FC; padding: 30px;">
                              <div class="col-md-12" style="margin-bottom: 20px;">
                                <div class="col-md-12">
                                  <p>DATOS  DE FACTURACIÓN</p>
                                  <input type="checkbox" id="check_update_fact" onchange="habilitar_upd_fac();"> Actualizar
                                </div>

                              </div>
                              <div class="col-md-12" style="margin-bottom: 20px;">
                                <div class="col-md-6">
                                  <label>Razón Social:</label>
                                  <input type="text" class="form-control" id="razon_fac_rep">
                                </div>
                                <div class="col-md-6">
                                  <label>R.F.C.:</label>
                                  <input type="text" class="form-control" id="rfc_fac_rep">
                                </div>
                                <!-- <div class="col-md-12">
                                  <label>Domicilio:</label>
                                  <input type="text" class="form-control" id="dom_fac_rep">
                                </div> -->

                                <div class="col-md-6">
                                  <label>Calle:</label>
                                  <input type="text" class="form-control" id="calledev_fac_rep">
                                </div>
                                <div class="col-md-6">
                                  <label>Número:</label>
                                  <input type="text" class="form-control" id="numerodev_fac_rep">
                                </div>
                                <div class="col-md-6">
                                  <label>Int.:</label>
                                  <input type="text" class="form-control" id="intdev_fac_rep">
                                </div>
                                <div class="col-md-6">
                                  <label>Colonia:</label>
                                  <input type="text" class="form-control" id="coloniadev_fac_rep">
                                </div>
                                <div class="col-md-6">
                                  <label>Ciudad:</label>
                                  <input type="text" class="form-control" id="ciudaddev_fac_rep">
                                </div>
                                <div class="col-md-6">
                                  <label>Estado:</label>
                                  <input type="text" class="form-control" id="estadodev_fac_rep">
                                </div>
                                <div class="col-md-6">
                                  <label>CP:</label>
                                  <input type="text" class="form-control" id="cpdev_fac_rep">
                                </div>




                                <div class="col-md-6">
                                  <label>Teléfono:</label>
                                  <input type="text" class="form-control" id="telefono_rep">
                                </div>
                                <div class="col-md-6">
                                  <label>Correo electronico:</label>
                                  <input type="text" class="form-control" id="correo_rep">
                                </div>
                                <div class="col-md-12" style="margin-top: 20px;">
                                  <button id="btn_update_fact" type="button" class="btn btn-dark"  onclick="guardar_datos_facturacion();">Guardar datos de facturación</button>
                              
                                </div>
                              </div>

                            </div>

                            




                            <!-- <div class="col-md-12" style="margin-bottom: 20px;">
                              <div class="col-md-12">
                                Razón Social: <label id="razon_fac_rep"></label><br>
                                R.F.C.: <label id="rfc_fac_rep"></label><br>
                                Domicilio.: <label id="dom_fac_rep"></label><br>
                                Teléfono.: <label id="telefono_rep"></label><br>
                                Correo electronico.: <label id="correo_rep"></label>
                              </div>

                            </div> -->

                            <div class="col-md-12" style="background-color: #F2FCF6; padding: 30px;">

                              <div class="col-md-12" style="margin-bottom: 20px;">
                                <div class="col-md-12">
                                  <p>DATOS  DE ENTREGA</p>
                                  <input type="checkbox" id="check_update_ent" onchange="habilitar_upd_ent();"> Actualizar
                                </div>

                              </div>
                              <div class="col-md-12">
                                <div class="col-md-12">
                                  <label>Contacto:</label>
                                  <input type="text" class="form-control" id="contacto_rep">
                                </div>
                                <!-- <div class="col-md-12">
                                  <label>Domicilio:</label>
                                  <input type="text" class="form-control" id="dom_ent">
                                </div> -->


                                <div class="col-md-6">
                                  <label>Calle:</label>
                                  <input type="text" class="form-control" id="calledev_fac_rep2">
                                </div>
                                <div class="col-md-6">
                                  <label>Número:</label>
                                  <input type="text" class="form-control" id="numerodev_fac_rep2">
                                </div>
                                <div class="col-md-6">
                                  <label>Int.:</label>
                                  <input type="text" class="form-control" id="intdev_fac_rep2">
                                </div>
                                <div class="col-md-6">
                                  <label>Colonia:</label>
                                  <input type="text" class="form-control" id="coloniadev_fac_rep2">
                                </div>
                                <div class="col-md-6">
                                  <label>Ciudad:</label>
                                  <input type="text" class="form-control" id="ciudaddev_fac_rep2">
                                </div>
                                <div class="col-md-6">
                                  <label>Estado:</label>
                                  <input type="text" class="form-control" id="estadodev_fac_rep2">
                                </div>
                                <div class="col-md-6">
                                  <label>CP:</label>
                                  <input type="text" class="form-control" id="cpdev_fac_rep2">
                                </div>







                                <div class="col-md-6">
                                  <label>Teléfono:</label>
                                  <input type="text" class="form-control" id="telefono_ent">
                                </div>
                                <div class="col-md-6">
                                  <label>Correo electronico:</label>
                                  <input type="text" class="form-control" id="correo_ent">
                                </div>
                                <div class="col-md-6">
                                  <label>Fecha de entrega:</label>
                                  <input type="text" class="form-control" id="fecha_ent">
                                </div>
                                
                                <div class="col-md-6">
                                  <label>Horario 1:</label>
                                  <input type="text" class="form-control" id="horario_ent1">
                                </div>
                                <div class="col-md-6">
                                  <label>Horario 2:</label>
                                  <input type="text" class="form-control" id="horario_ent2">
                                </div>
                                <div class="col-md-6">
                                  <label>Forma de entrega:</label>
                                  <input type="text" class="form-control" id="forma_ent">
                                </div>
                                <div class="col-md-6">
                                  <label>Detalles:</label>
                                  <input type="text" class="form-control" id="detalles_ent">
                                </div>
                                <div class="col-md-6">
                                  <label>Referencia:</label>
                                  <input type="text" class="form-control" id="referencia_ent">
                                </div>
                                <div class="col-md-6">
                                  <label>Empaque:</label>
                                  <input type="text" class="form-control" id="empaque_ent">
                                </div>
                                <div class="col-md-12" style="margin-top: 20px;">
                                  <button id="btn_update_ent" type="button" class="btn btn-dark"  onclick="guardar_datos_entrega();">Guardar datos de entrega</button>
                              
                                </div>
                                <div class="col-md-12">


                                  <!-- Domicilio: <label id="dom_ent"></label><br> -->
                                  <!-- Teléfono: <label id="telefono_ent"></label><br> -->
                                  <!-- Correo electronico: <label id="correo_ent"></label><br> -->
                                  <!-- Fecha de entrega: <label id="fecha_ent"></label><br> -->
                                  <!-- Horario: <label id="horario_ent"></label><br> -->
                                  <!-- Forma de entrega: <label id="forma_ent"></label><br> -->
                                  <!-- Detalles: <label id="detalles_ent"></label><br> -->
                                  <!-- Referencia: <label id="referencia_ent"></label><br> -->
                                  <!-- Empaque: <label id="empaque_ent"></label><br> -->
                                </div>

                              </div>
                              
                            </div>

                            
                            
                            <div class="col-md-12" style="margin-top: 20px;">
                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <p>DATOS  DE PEDIDO</p>
                                </div>
                                <div class="col-md-12">
                                  <div class="col-md-12">
                                    Asesor: <b id="asesor"></b><br>
                                    Levantó pedido: <b id="levanto"></b><br>
                                    Autorización: <b id="autorizacion"></b><br>
                                    LAB: <b id="lab"></b><br>
                                    Medio: <b id="medio"></b><br>
                                  </div>

                                </div>

                              </div>
                              

                              <div class="col-md-6">
                                <div class="col-md-12">
                                  <p>DATOS  DE PAGO</p>
                                </div>
                                <div class="col-md-12">
                                  <div class="col-md-12">
                                    Requisitos legales y reglamentarios: <b id="requisitos_pago"></b><br>
                                    Metodo de pago: <b id="met_pago"></b><br>
                                    Uso de CFDI: <b id="uso_cfdi"></b><br>
                                    Salida: <b id="salida"></b><br>
                                    Factura: <b id="factura"></b><br>
                                    Otros: <b id="otros"></b><br>
                                  </div>
                                  <label id="idpedido2" style="visibility: hidden;"><?php $pedido=($_GET['pedido']);echo "$pedido";?></label>
                                </div>

                              </div>
                            </div>  
                            
                            


                          </div>
                          <!--<div class="sender-info">
                            <div class="row">
                              <div class="col-md-12">
                                <strong>Jon Doe</strong>
                                <span>(jon.doe@gmail.com)</span> to
                                <strong>me</strong>
                                <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                              </div>
                            </div>
                          </div>-->
                          <!--<div class="view-mail">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                            <p>Riusmod tempor incididunt ut labor erem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                              nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                              mollit anim id est laborum.</p>
                            <p>Modesed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                          </div>-->
                          <!--<div class="attachment">
                            <p>
                              <span><i class="fa fa-paperclip"></i> 3 attachments — </span>
                              <a href="#">Download all attachments</a> |
                              <a href="#">View all images</a>
                            </p>
                            <ul>
                              <li>
                                <a href="#" class="atch-thumb">
                                  <img src="images/inbox.png" alt="img" />
                                </a>

                                <div class="file-name">
                                  image-name.jpg
                                </div>
                                <span>12KB</span>


                                <div class="links">
                                  <a href="#">View</a> -
                                  <a href="#">Download</a>
                                </div>
                              </li>

                              <li>
                                <a href="#" class="atch-thumb">
                                  <img src="images/inbox.png" alt="img" />
                                </a>

                                <div class="file-name">
                                  img_name.jpg
                                </div>
                                <span>40KB</span>

                                <div class="links">
                                  <a href="#">View</a> -
                                  <a href="#">Download</a>
                                </div>
                              </li>
                              <li>
                                <a href="#" class="atch-thumb">
                                  <img src="images/inbox.png" alt="img" />
                                </a>

                                <div class="file-name">
                                  img_name.jpg
                                </div>
                                <span>30KB</span>

                                <div class="links">
                                  <a href="#">View</a> -
                                  <a href="#">Download</a>
                                </div>
                              </li>

                            </ul>
                          </div>-->
                          <!--<div class="btn-group">
                            <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
                            <button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                          </div>-->
                        </div>

                      </div>
                      <!-- /CONTENT MAIL -->
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

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_asign_estatus">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Estatus de producto</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">

                                    <div class="col-md-12 col-sm-12">
                                      <p style="font-size: 20px;">CONTROL: <b id="no_control_dividir"></b></p>
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                      CODIGO: <b id="codigo_dividir"></b><br>
                                      DESCRIPCIÓN: <b id="descrip_dividir"></b><br>
                                      MEDIDAS: <b id="medidas_dividir"></b><br>
                                      COLOR: <b id="color_dividir"></b><br>
                                      CANTIDAD: <b id="cantidad_dividir"></b><i class="fa fa-edit" style="margin-left: 10px;" onclick="edit_cant_total();"></i><br>
                                      OBSERVACIONES: <b id="observ_dividir_general"></b><i class="fa fa-edit" style="margin-left: 10px;" onclick="edit_observ_total();"></i>
                                      <hr width="100%">
                                      <input type="hidden" class="form-control" id="iddetalle_pedido" value="">
                                    </div>
                                    <div class="col-md-2">

                                      <button id="" type="button" class="btn btn-sm btn-success btn-block" data-toggle="tooltip" data-placement="top" title="Agregar nuevo estatus" onclick="dividir_prod_ped();">+</button>
                                    </div>


                                    <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">


                                          <table id="tbl_detalle_prod_tbl" class="table table-hover">

                                          </table>
                                    </div>



                        </div>
                        <div class="modal-footer">

                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


                        </div>

                      </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_terminados">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">

                          <h5>Pedidos Terminados - Listos para entrega</h5>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 600px;">

                                <div class="card-box table-responsive" id="box_terminados">

                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" id="tbl_terminados" >

                                  </div>

                                </div>



                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>




                        </div>


                      </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_doc_ped">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">DOCUMENTOS DEL PEDIDO</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">


                                    <div class="col-md-12 col-sm-12">

                                    </div>
                                    <div class="col-md-12 col-sm-12" id="new_doc">
                                        <div class="col-md-12 col-sm-12">

                                          <h6>* El nombre del archivo no debe contener caracteres especiales, ejemplo: (#,%*..)</h6>
                                          <label>__</label>
                                        </div>
                                        <br>
                                        <div class="col-md-12 col-sm-12">


                                          <label>Adjuntar</label>
                                          <form name="formulario-envia_comprobante" id="formulario-envia_comprobante" enctype="multipart/form-data" method="post">


                                            <div class="form-group col-md-6 col-sm-6">
                                              <input type="file" name="ar_comprob" id="ar_comprob" onchange="" >
                                              <input type="hidden" name="idpedido_doc" id="idpedido_doc" onchange="" >
                                            </div>
                                            <div class="form-group col-md-4 col-sm-4" align="right">

                                              <select id="tipo_doc" class="form-control selectpicker">
                                                 <option value="">Tipo</option>
                                                 <option value="0">Anexo</option>
                                                 <option value="1">Factura|Recibo</option>

                                              </select>
                                            </div>
                                            <div class="form-group col-md-2 col-sm-2" align="right">
                                              <button id="btn_comprob" type="button" class="btn btn-primary" onclick="cargar_doc();">Cargar</button>
                                              <!--<button id="btn_comprob" type="button" class="btn btn-dark" onclick="marcar_sindocs();">Sin Docs.</button>-->
                                            </div>


                                          </form>

                                        </div>


                                    </div>

                                    <div align="center">
                                          <label>_</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <h5>Documentos</h5>
                                    </div>

                                    <div class="col-md-12 col-sm-12">

                                          <table id="tbl_doc_ped" class="table table-hover">

                                          </table>


                                    </div>






                        </div>
                        <div class="modal-footer">

                          <button type="button" class="btn btn-success" id="regresar_listos" onclick="abrir_listos();">Regresar</button>
                          <button type="button" class="btn btn-success" id="regresar_total" onclick="abrir_terminados();">Regresar</button>


                        </div>

                      </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_listos">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Pedidos Terminados</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>



                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">


                               <!-- <table id="tbl_listos" class="table table-hover">

                                </table>-->

                                <div class="card-box table-responsive" id="">

                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" id="tbl_listos" >

                                  </div>

                                </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>


                      </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_pedidos_atencion">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Productos de pedido sin revisar</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>



                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">


                                <table id="tbl_pedidos_pendientes" class="table table-hover">

                                </table>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>


                      </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_vencidos">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Pedidos Vencidos</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>




                        </div>
                        <div class="modal-body">

                                    <div class="form-group col-md-2 col-sm-2" align="right">

                                      <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                          aria-haspopup="true" aria-expanded="false">
                                          Filtrar por:
                                        </button>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item" href="#" onclick="pedidos_vencidos2();">Sin entregar</a>
                                          <a class="dropdown-item" href="#" onclick="pedidos_vencidos3();">Entregados</a>
                                        </div>
                                      </div>

                                    </div>

                                    <div class="col-md-12 col-sm-12" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 300px;">


                                          <table id="tbl_vencidos" class="table table-hover">

                                          </table>
                                    </div>



                        </div>
                        <div class="modal-footer">

                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


                        </div>

                      </div>
      </div>
    </div>


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_seguim_ped">
      <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">SEGUIMIENTO INTERNO DE PEDIDO</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">


                                    <div class="col-md-12 col-sm-12">
                                      <h5>Registrar comentario</h5>
                                    </div>
                                    <div class="col-md-12 col-sm-12" id="new_coment">




                                            <div class="col-md-2 col-sm-3" id="btn_entregado">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #0BF6BF; color: black; border-radius: 10px;">
                                                    <i class="fa fa-inbox" onclick="pasar_texto1();"></i>Entregado
                                                  </a>

                                                </li>
                                              </ul>
                                            </div>

                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #7E0CA8; color: white; border-radius: 10px;">
                                                    <i class="fa fa-inbox" onclick="pasar_texto5();"></i>Entregado*
                                                  </a>

                                                </li>
                                              </ul>
                                            </div>

                                            <!--<div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #EE3676; color: white; border-radius: 10px;">
                                                    <i class="fa fa-inbox" onclick="pasar_texto2();"></i>Apartado
                                                  </a>

                                                </li>
                                              </ul>
                                            </div>

                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #EF83A9; color: white; border-radius: 10px;">
                                                    <i class="fa fa-inbox" onclick="pasar_texto8();"></i>Apartado P.
                                                  </a>

                                                </li>
                                              </ul>
                                            </div>

                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #FCE347; color: black; border-radius: 10px;">
                                                    <i class="fa fa-inbox" onclick="pasar_texto3();"></i>Fabricado
                                                  </a>

                                                </li>
                                              </ul>
                                            </div>


                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #F56630; color: black; border-radius: 10px;">
                                                    <i class="fa fa-inbox" onclick="pasar_texto4();"></i>Existencia
                                                  </a>

                                                </li>
                                              </ul>
                                            </div>-->


                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #09A004; color: white; border-radius: 10px;">
                                                    <i class="" onclick="pasar_texto9();">Listo para entrega</i>
                                                  </a>

                                                </li>
                                              </ul>
                                            </div>





                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #BF0E13; color: white; border-radius: 10px;">
                                                    <i class="fa fa-inbox" onclick="pasar_texto6();"></i>Cancelado
                                                  </a>

                                                </li>
                                              </ul>
                                            </div>

                                            <div class="col-md-2 col-sm-3">
                                              <ul class="nav navbar-right panel_toolbox">
                                                <li>
                                                  <a class="btn btn-app" style="background: #FFFFFF; color: black; border-radius: 10px;">
                                                    <i class="fa fa-inbox" onclick="pasar_texto7();"></i>Otro
                                                  </a>

                                                </li>
                                              </ul>
                                            </div>


                                        <!--<div class="col-md-12 col-sm-12">

                                            <label>Color:</label>
                                            <select  class="form-control" id="color" onchange="pasar_texto();">

                                              <option value="">Select</option>
                                              <option style="background: #0BF6BF;" value="0BF6BF">ENTREGADOS EN TIEMPO</option>
                                              <option style="background: #EE3676;" value="EE3676">PARA APARTADO EN PRODUCTO TERMINADO</option>
                                              <option style="background: #FCE347;" value="FCE347">ENTREGADO DE PRODUCCION</option>
                                              <option style="background: #FF670B;" value="FF670B">EXISTENCIA DE ALMACEN</option>
                                              <option style="background: #7E0CA8;" value="7E0CA8">PEDIDO ENTREGADO CON RETRASO</option>
                                              <option style="background: #BF0E13;" value="BF0E13">PEDIDO CANCELADO</option>
                                              <option style="background: #FFFFFF;" value="FFFFFF">OTRO</option>

                                            </select>
                                        </div>-->
                                        <div class="col-md-12 col-sm-12">
                                          <label style="color: white;">_</label>
                                        </div>

                                        <div class="col-md-12 col-sm-12">
                                            <div class="col-md-10 col-sm-10">
                                                  <label>Comentario</label>
                                                  <input type="text" class="form-control" id="coment_ped" disabled="">
                                                  <input type="hidden" class="form-control" id="coment_ped_motivo" disabled="">
                                                  <input type="hidden" class="form-control" id="estatus">
                                                  <input type="hidden" class="form-control" id="color">
                                                  <!--<input type="hidden" class="form-control" id="idpedido">-->
                                                  <input type="hidden" class="form-control" id="porc_av_p">

                                                </div>
                                                <div class="col-md-2 col-sm-2">
                                                  <label>Color</label>


                                                  <h2 id="color2">.</h2>

                                            </div>

                                        </div>


                                        <div align="center">
                                          <label>_</label>
                                        </div>

                                        <div class="col-md-12 col-sm-12" align="center">
                                          <button type="button" class="btn btn-primary" onclick="guardar_coment_ped();" id="">Guardar</button>
                                        </div>

                                    </div>

                                    <div align="center">
                                          <label>_</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <h5>Seguimiento</h5>
                                    </div>

                                    <div class="col-md-12 col-sm-12">

                                          <table id="tbl_seguim_ped" class="table table-hover">

                                          </table>
                                    </div>





                        </div>
                        <div class="modal-footer">

                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


                        </div>

                      </div>
      </div>
    </div>

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_observ">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="div_nueva_entrega">

                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Editar observaciones generales:</label>
                                <textarea class="form-control" id="observ" cols="40" rows="8" onkeyup=""></textarea>
                              </div>

                            </div>

                        </div>
                        <div class="modal-footer">

                          <button type="button" class="btn btn-primary" onclick="update_observ();">Guardar</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
    </div>

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_salidas_pedidos">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">

                              <div class="form-group col-md-12 col-sm-12" align="">
                                <label>Salidas del pedido</label>

                              </div>
                              <div class="form-group col-md-12 col-sm-12" align="">
                                <table id="tbl_salidas_pedido" class="table table-hover">

                                </table>
                              </div>

                            </div>

                        </div>
                        <div class="modal-footer">


                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
    </div>

    <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="modal_select_vale">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">

                        <div class="modal-header">
                          <label id="titulo_vale">SELECCIONAR VALE</label>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                              <div class="form-group col-md-12 col-sm-12" id="datos_prod_add">
                                  <p>Producto a agregar:</p>
                                  Codigo: <b id="codigo_select_vale"></b><br>
                                  <b id="descrip_select_vale"></b><br>
                                  Cantidad: <b id="cantidad_select_vale"></b><br>
                                  <input type="hidden" id="iddetalle_pedido_select_vale">
                                  <input type="hidden" id="idpg_detped_select_vale">
                                  <input type="hidden" id="idpedido_select_vale" value="0">
                              </div>

                              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">
                                <label>Vales abiertos</label>
                              </div>
                              <div class="form-group col-md-12 col-sm-12">
                                <div class="form-group col-md-8 col-sm-8">
                                  <select  class="form-control" id="select_vales" onchange="listar_prod_select_vale();">

                                  </select>
                                </div>
                                <div class="form-group col-md-2 col-sm-2">
                                  <button type="button" class="btn btn-dark" onclick="pasar_prod_vale();">Agregar</button>
                                </div>
                              </div>

                              <div class="form-group col-md-12 col-sm-12" align="">
                                <table id="tbl_productos_select_vale" class="table table-hover">
                                </table>
                              </div>

                            </div>

                        </div>
                        <div class="modal-footer">



                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
    </div>

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_fecha_prod">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <label id="titulo_vale">Fecha de termino de producción:</label>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">

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

                        </div>
                        <div class="modal-footer">



                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_vale_alm">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <label id="titulo_vale">VALES DE ALMACÉN</label>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 500px;">

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="">

                              <div class="form-group col-md-12 col-sm-12" align="">
                                <div class="form-group col-md-10 col-sm-10" align="">

                                                  <select  class="form-control" id="estatus_vale_alm" onchange="listar_vales_estatus();">
                                                    <option value="3">En proceso</option>
                                                    <option value="0">Abiertos</option>
                                                    <option value="1">Solicitados</option>
                                                    <option value="2">Surtidos</option>
                                                    <option value="4">Archivados</option>
                                                    <option value="6">Rechazado</option>
                                                    <option value="5">Todos</option>
                                                  </select>

                                </div>
                                <div class="form-group col-md-2 col-sm-2" align="right">
                                  <button type="button" class="btn" title="Nuevo vale" onclick="nuevo_vale();"><i class="fa fa-plus"></i></button>
                                </div>
                              </div>
                              <div class="form-group col-md-12 col-sm-12" align="">

                                <div class="form-group col-md-12 col-sm-12">
                                  <div class="form-group col-md-3 col-sm-3" id="box_vales_salida" style="border:0px solid #e5e5e5; overflow:scroll;height: 420px;">

                                  </div>
                                  <div class="form-group col-md-9 col-sm-9" id="">
                                    <div class="form-group col-md-6 col-sm-6" id="datos_enc_vale">
                                      <input type="hidden" id="idvales_almacen">
                                      No.: <span id="num_vale_c"></span><br>
                                      Estatus: <b id="estatus_vale_c"></b><br>
                                      Registro: <b id="fecha_reg_c"></b><br>
                                      Solicitud: <b id="fecha_solic_c"></b><br>
                                      Surtido: <b id="fecha_surt_c"></b>

                                    </div>
                                    <div class="form-group col-md-6 col-sm-6" id="btns_vale">
                                      <button type="button" class="btn" onclick="solicitar_vale()" style="margin-left: -15px;" id="btn_solic_vale"><i class="fa fa-check"></i></button>

                                      <a href="" id="enlace_vale_alm" onclick="abrir_vale_alm();" target="_blank">
                                        <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Imprimir vale de almacén"  style="margin-left: -10px;"  id="btn_abrir_imp_vale"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>

                                      </a>
                                      <button type="button" class="btn" onclick="borrar_vale();" id="btn_borrar_vale"><i class="fa fa-trash" style="margin-left: -10px;"></i></button>
                                      <button type="button" class="btn" onclick="archivar_vale()" id="btn_archivar_vale"><i class="fa fa-archive" style="margin-left: -10px;"></i></button><br>

                                      <input type="checkbox"  id="check_prio" onchange="estab_prior();" style="margin-bottom: 20px;"/> <b style="color: black;">Urgente</b>

                                    </div>
                                    <div class="form-group col-md-12 col-sm-12" id="">
                                      <table id="tbl_productos_vale" class="table table-hover">

                                      </table>
                                    </div>

                                  </div>

                                </div>


                                <table id="resum_acciones" class="table table-hover">

                                </table>


                              </div>

                            </div>

                        </div>
                        <div class="modal-footer">



                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
    </div>

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_observ_iddetalle_ped">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <label id="titulo_vale">Fecha de termino de producción:</label>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body" style="border:0px solid #e5e5e5; overflow:scroll;height:auto; max-height: 400px;">

                                                                <div class="form-group col-md-12 col-sm-12">
                                                                    <label>Observaciones actuales:</label>

                                                                    <textarea class="form-control" id="observ_modal_edit"></textarea>
                                                                </div>


                        </div>
                        <div class="modal-footer">

                          <button type="button" class="btn btn-primary" onclick="edit_observ_total2();">Guardar</button>

                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
    </div>



    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="vendors/google-code-prettify/src/prettify.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    <script type="text/javascript" src="scripts/list_pedidos.js?v=<?php echo(rand()); ?>"></script>
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