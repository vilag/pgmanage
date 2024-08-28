function init(){

	//$("#btn_opciones_vales").hide();
	$("#div_lista_salidas").show();
	$("#div_nueva_entrega_window").hide();
	//$("#btn_nueva_asignacion").show();
	//$("#div_regresar_a_lista").hide();
	//$("#text_nueva_salida").hide();
	//$("#div_eti_entrega").hide();
	$("#btn_agregar_productos").hide();
	listar_salidas();

	/*$.post("ajax/diseno.php?op=listar_salidas_listbox",function(r){
	$("#select_salida").html(r);
													

	});*/
	//valid_entrega();
	$("#loader").hide();
	//$("#confirm").hide();

	$("#div_excedente_salida").hide();
	$("#no_control_buscar").val("");

	document.getElementById('fecha_2_buscar').disabled = true;

	listar_choferes();
	listar_vehiculos();

}

var offset = 0;
var conteo_ps = 1;
function listar_salidas()
{
	$("#num_pag_salida").text(conteo_ps);
	$("#num_pag_salida2").text(conteo_ps);
	$("#div_impr_salida").hide();
	$.post("ajax/entregas_prod.php?op=listar_salidas&offset="+offset,function(r){
	$("#tbl_salidas").html(r);

	});
}

function next_pagina_salida(){
	document.getElementById("btn_siguiente_salida").disabled = true;
	document.getElementById("btn_siguiente_salida2").disabled = true;
	offset = offset+5;
	conteo_ps++;
	$("#num_pag_salida").text(conteo_ps);
	$("#num_pag_salida2").text(conteo_ps);
	$.post("ajax/entregas_prod.php?op=listar_salidas&offset="+offset,function(r){
	$("#tbl_salidas").html(r);

		const element = document.getElementById("tbl_salidas");
		element.scrollTo(0, 0);
		document.getElementById("btn_siguiente_salida").disabled = false;
		document.getElementById("btn_siguiente_salida2").disabled = false;
	
	});
}

function back_pagina_salida(){
	if (offset>0) {
		document.getElementById("btn_anterior_salida").disabled = true;
		document.getElementById("btn_anterior_salida2").disabled = true;
		offset = offset-5;
		conteo_ps--;
		$("#num_pag_salida").text(conteo_ps);
		$("#num_pag_salida2").text(conteo_ps);
		$.post("ajax/entregas_prod.php?op=listar_salidas&offset="+offset,function(r){
		$("#tbl_salidas").html(r);
			
			const element = document.getElementById("tbl_salidas");
			element.scrollTo(0, 0);
			document.getElementById("btn_anterior_salida").disabled = false;
			document.getElementById("btn_anterior_salida2").disabled = false;
		
		});
	}
	
}


	/*$(document).ready(function(){
	  var $btn = $('#btn_guardar_entrega');
	 // var $data = $('.data');
	  var $loader = $('#loader');
	  //var $confirm = $('#confirm');


	  $btn.click(function(){

	    $.ajax({
	     // ejemplo url
	     
	     method: 'GET',
	     beforeSend: function() {
	      // aquí puedes poner el código paraque te muestre el gif
	     // $data.html("<img src='images/ajax-loader.gif'>");
	      $loader.show();
	      //$confirm.hide();
	     }
	    }).done(function(resp){
	      setTimeout(function(){
	       $loader.hide();
	       //$confirm.show();
	       $data.html(resp[0].about);
	      }, 5000);
	    }).fail(function(err){
	      $loader.hide();
	      
	      alert(err);
	    })
	    return;
	  });

	});*/



function regresar_a_lista()
{
	$("#div_lista_salidas").show();
	$("#div_nueva_entrega_window").hide();
	//$("#btn_nueva_asignacion").show();
	//$("#div_regresar_a_lista").hide();
	//$("#prod_pedido").hide();
	//$("#text_nueva_salida").hide();
	//$("#div_eti_entrega").hide();
	//$("#btn_agregar_productos").hide();
	//$("#select_salida").val("");
	//$("#select_entrega").val("");
	//document.getElementById('select_salida').disabled = false;

					$.post("ajax/diseno.php?op=listar_productos_new_salidas&id="+0,function(r){
					$("#box_productos5").html(r);


						$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+0,function(r){
						$("#tbl_entregas_list").html(r);

							$.post("ajax/entregas_prod.php?op=listar_prod_selec&id="+0,function(r){
							$("#box_prod_pasar").html(r);

								$.post("ajax/entregas_prod.php?op=listar_prod_selec&id="+0,function(r){
								$("#box_prod_pasar_add").html(r);

									$("#identrega").val("");
									$("#idpedido_salida").val("");
									$("#no_control").val("");
									$("#numero_entrega").val("");
									$("#cliente_ent").val("");
									$("#contacto_ent2").val("");
									$("#direccion_ent2").val("");

									listar_salidas();

								});

							});

						});

						//$("#btn_opciones_vales").hide();

					});
}



function nueva_salida()
{
	var idusuario = $("#idusuario").text();

	if (idusuario==4 || idusuario==1) {

				$("#modal_nueva_salida").modal("show");
				var idusuario=$("#idusuario").text();
				var fecha=moment().format('YYYY-MM-DD');
				var hora=moment().format('HH:mm:ss');
				var fecha_hora=fecha+" "+hora;

				$("#fecha_salida_new_s").val(fecha);
				$("#hora_salida_new_s").val(hora);

				$("#btn_save_embarque").show();
				$("#btn_upd_embarque").hide();

				

	}else{
		bootbox.alert("Disculpe las molestias, este usuario no tiene los permisos para realizar esta acción");
	}
	
}

function editar_salida(idsalida)
{
	$("#modal_nueva_salida").modal("show");

	$.post("ajax/entregas_prod.php?op=consul_salida",{idsalida:idsalida},function(data, status)
	{
		data = JSON.parse(data);
		
		$("#idsalida_upd").val(data.idsalida);
		$("#fecha_salida_new_s").val(data.fecha_salida);
		$("#hora_salida_new_s").val(data.hora_salida);
		$("#select_chofer").val(data.idusuario);
		
		$("#select_vehiculo").val(data.idvehiculo);


		$("#btn_save_embarque").hide();
		$("#btn_upd_embarque").show();

	});
}


function listar_choferes()
{
	$.post("ajax/diseno.php?op=listar_choferes",function(r){
			$("#select_chofer").html(r);
	});
}

function listar_vehiculos()
{
	$.post("ajax/diseno.php?op=listar_vehiculos",function(r){
			$("#select_vehiculo").html(r);
	});
}

function upd_fecha_salida()
{
	var idsalida = $("#idsalida").val();
	var fecha_hora_salida_input = $("#fecha_hora_salida_input").val();

	$.post("ajax/diseno.php?op=upd_fecha_salida",{idsalida:idsalida,fecha_hora_salida_input:fecha_hora_salida_input},function(data, status)
	{
		data = JSON.parse(data);

		alert("Fecha duardad");

	});
}


function guardar_salida()
{

	var idusuario = $("#idusuario").text();

				if (idusuario==1) {
					$("#fecha_hora_salida_input").show();
					//$("#fecha_hora_salida_input").val(data.fecha_salida);
				}else{
					$("#fecha_hora_salida_input").hide();
				}


	var fecha = $("#fecha_salida_new_s").val();
	var hora = $("#hora_salida_new_s").val();
	var idrepartidor = $("#select_chofer").val();
	var idvehiculo = $("#select_vehiculo").val();

	var fecha_hora=fecha+" "+hora;

	if (idrepartidor>0 && idvehiculo>0) {
		$.post("ajax/diseno.php?op=ult_salida",function(data, status)
		{
			data = JSON.parse(data);

			//alert(data);

			if (data==null) {
				var no_salida = 1;
			}else{
				var no_salida = parseInt(data.no_salida) +1;
			}


			$.post("ajax/diseno.php?op=guardar_salida",{no_salida:no_salida,fecha_hora:fecha_hora,idrepartidor:idrepartidor,idvehiculo:idvehiculo},function(data, status)
			{
				data = JSON.parse(data);

				var idsalida = data.idsalida;
				$("#idsalida").val(idsalida);
				$("#modal_nueva_salida").modal("hide");

				$("#no_salida_text").text(data.no_salida);
				$("#fecha_hora_salida_text").text(data.fecha_salida);
				
				$("#chofer_salida_text").text(data.nom_repartidor);
				$("#vehiculo_salida_text").text(data.nom_vehiculo);

				$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+idsalida,function(r){
				$("#tbl_entregas_list").html(r);

					$.post("ajax/diseno.php?op=listar_productos_new_salidas&id="+idsalida,function(r){
					$("#box_productos5").html(r);

						//document.getElementById('btn_agregar_productos').disabled = true;
						//document.getElementById('btn_salida_mercancia').disabled = true;

						$("#div_lista_salidas").hide();
						$("#div_nueva_entrega_window").show();
						//$("#btn_nueva_asignacion").hide();//*
						//$("#div_regresar_a_lista").show();
						//$("#text_nueva_salida").show();//*
						//$("#div_eti_entrega").show();
						//$("#btn_agregar_productos").show();

						//$("#idsalida").val("");
						$("#identrega").val("");
						$("#idpedido_salida").val("");
						$("#no_control").val("");

						bootbox.alert("Embarque guardado exitosamente");

						var idpg_pedidos=0;
						//Borra tabla de consulta de nuevos productos en caso de que se haya realizado esa consulta anterio de la nueva salida
						$.post("ajax/entregas_prod.php?op=listar_prod_selec&id="+idpg_pedidos,function(r){
						$("#box_prod_pasar").html(r);

							listar_salidas();
							//valid_entrega();
														

						});

					});


						


				});

				/*$.post("ajax/diseno.php?op=listar_salidas_listbox",function(r){
				$("#select_salida").html(r);*/

					//$("#select_salida").val(idsalida);
					//document.getElementById('select_salida').disabled = true;
					

				//});


			});

		});
	}else{
		bootbox.alert("Es necesario seleccionar el chofer y vehiculo designados");
	}


		
		
}


function upd_salida()
{
	var idusuario = $("#idusuario").text();

	if (idusuario==1 || idusuario == 4) {

		var idsalida = $("#idsalida_upd").val();

		var fecha = $("#fecha_salida_new_s").val();
		var hora = $("#hora_salida_new_s").val();
		var idrepartidor = $("#select_chofer").val();
		var idvehiculo = $("#select_vehiculo").val();

		var fecha_hora=fecha+" "+hora;

		if (idrepartidor>0 && idvehiculo>0) {
			

				

				$.post("ajax/diseno.php?op=upd_salida",{idsalida:idsalida,fecha_hora:fecha_hora,idrepartidor:idrepartidor,idvehiculo:idvehiculo},function(data, status)
				{
					data = JSON.parse(data);

					
					$("#modal_nueva_salida").modal("hide");				
					listar_salidas();
					bootbox.alert("Datos de salida actualizados correctamente");

				});

			
		}else{
			bootbox.alert("Es necesario seleccionar el chofer y vehiculo designados");
		}
	}else{
		bootbox.alert("Este usuario no tiene permisos para realizar esta acción");
	}

	
		
}

function nueva_entrega()
{
	document.getElementById('btn_guardar_entrega').disabled = false;
	var idsalida = $("#idsalida").val();
	var idusuario = $("#idusuario").text();

	//alert(idsalida);
	if (idusuario==4 || idusuario==1) {

		if (idsalida>0) {

			$("#modal_select_entrega").modal("show");

		}else{
			bootbox.alert("Es necesario seleccionar una salida");
		}
	}else{
		bootbox.alert("Disculpe las molestias, este usuario no tiene permisos para realizar esta acción");
	}

		
}







function check_prod_entrega(idpg_detalle_pedidos)
{

	var check_entrega = document.getElementById("check_entrega"+idpg_detalle_pedidos).checked;

	if (check_entrega==true) {
		var val_check = 1;
	}

	if (check_entrega==false) {
		var val_check = 0;
	}

	$.post("ajax/diseno.php?op=check_prod_entrega",{idpg_detalle_pedidos:idpg_detalle_pedidos,val_check:val_check},function(data, status)
	{
		data = JSON.parse(data);

	});
}

function check_activar(idpg_detalle_pedidos)
{
	var act_mod = document.getElementById("check_mod_cant_ent"+idpg_detalle_pedidos).checked;

	if (act_mod==true) {
		document.getElementById('idproducto_enviar'+idpg_detalle_pedidos).disabled = false;
		//var val_check = 1;
	}

	if (act_mod==false) {
		document.getElementById('idproducto_enviar'+idpg_detalle_pedidos).disabled = true;
		//var val_check = 0;
	}
}

function act_cant_entregar(idpg_detalle_pedidos,disponible,cantidad_entre,cant_tot)
{
	//var cant_tot = cantidad;
	var cantidad = $("#idproducto_enviar"+idpg_detalle_pedidos).val();
	var idpedido = $("#idpedido_salida").val();
	var idpg_pedidos = idpedido;

	

	/*$.post("ajax/diseno.php?op=consul_pend_ent",{idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
	{
		data = JSON.parse(data);

		var cant_req = disponible;
		var cant_pend = data.cant_entregada;*/

		//var cant_max = parseInt(disponible) - parseInt(cantidad_entre);
		var cant_max = parseInt(cant_tot) - parseInt(cantidad_entre);
		//alert(cant_max);

		if (cantidad>0 && cantidad<=cant_max) {

			$.post("ajax/diseno.php?op=act_cant_entregar",{idpg_detalle_pedidos:idpg_detalle_pedidos,cantidad:cantidad},function(data, status)
			{
				data = JSON.parse(data);

				

			});
		}else{
			bootbox.alert("La cantidad ingresada no es valida,la cantidad disponible para este producto es: "+cant_max);
			$("#idproducto_enviar"+idpg_detalle_pedidos).val("0");
		}

	//});

			
}


function buscar_control_add()
{
	var no_control = $("#no_control_add").val();

	$.post("ajax/entregas_prod.php?op=buscar_idpg_pedidos",{no_control:no_control},function(data, status)
	{
		data = JSON.parse(data);

		var idpg_pedidos= data.idpg_pedidos;
		$("#idpedido_salida").val(idpg_pedidos);
		$("#contacto_new_e").val(data.contacto_ent);
		var calle_ent = data.calle_ent;
		var numero_ent = data.numero_ent;
		var interior_ent = data.interior_ent;
		if (interior_ent!="") {
			interior_ent = "Int. "+interior_ent;
		}
		var colonia_ent = data.colonia_ent;
		var ciudad_ent = data.ciudad_ent;
		var estado_ent = data.estado_ent;
		var cp_ent = data.cp_ent;
		var telefono_ent = data.telefono_ent;
		var hora1 = data.hora_entrega_r1;
		var hora2 = data.hora_entrega_r2;
		var condiciones = data.condiciones;
		var forma_entrega = data.forma_entrega;


		$("#dir_entrega_new_e").val(calle_ent+" "+numero_ent+" "+interior_ent+" Col. "+colonia_ent+", "+ciudad_ent+" "+estado_ent+", CP: "+cp_ent);
		$("#telefono_new_e").val(telefono_ent);
		$("#horario_new_e").val(hora1+" - "+hora2);
		$("#condic_new_e").val(condiciones);
		$("#medio_new_e").val(forma_entrega);
		$("#cliente_new_e").val(data.nom_cliente);

		//alert(idpg_pedidos);

		$.post("ajax/entregas_prod.php?op=listar_prod_selec&id="+idpg_pedidos,function(r){
		$("#box_prod_pasar_add").html(r);


			$.post("ajax/entregas_prod.php?op=listar_prod_selec&id="+0,function(r){
			$("#box_prod_pasar").html(r);
											

			});
										

		});

	});


		
}

function limpiar_post_guardado()
{
		$("#idpedido_salida").val("");
		$("#contacto_new_e").val("");
		$("#dir_entrega_new_e").val("");
		$("#telefono_new_e").val("");
		$("#horario_new_e").val("");
		$("#condic_new_e").val("");
		$("#medio_new_e").val("");
		$("#cliente_new_e").val("");


		$.post("ajax/entregas_prod.php?op=listar_prod_selec&id="+0,function(r){
		$("#box_prod_pasar_add").html(r);


			$.post("ajax/entregas_prod.php?op=listar_prod_selec&id="+0,function(r){
			$("#box_prod_pasar").html(r);
											

			});
										

		});
}
	
//console.log();


function guardar_entrega()
{
	document.getElementById('btn_guardar_entrega').disabled = true;
	//medir_tiempo();
					//var idpedido = $("#idpedido_salida").val();
					var idpedido = $("#idpedido_salida").val();
					var idsalida = $("#idsalida").val();
					
					var cliente_new_e = $("#cliente_new_e").val();
					var contacto_new_e = $("#contacto_new_e").val();
					var dir_entrega_new_e = $("#dir_entrega_new_e").val();

					var telefono_new_e = $("#telefono_new_e").val();
					var horario_new_e = $("#horario_new_e").val();
					var condic_new_e = $("#condic_new_e").val();
					var medio_new_e = $("#medio_new_e").val();


		if (idpedido>0 && idsalida>0) {


			bootbox.confirm({
			    message: "¿Confirmar registro de salida?",
			    buttons: {
			        confirm: {
			            label: 'Yes',
			            className: 'btn-success'
			        },
			        cancel: {
			            label: 'No',
			            className: 'btn-danger'
			        }
			    },
			    callback: function (result) {
			        
			    	if (result==true) {


			    	var is_exced = $("#is_exced").val();

			    		if (is_exced==1) {

				    			$.post("ajax/diseno.php?op=contar_ceros",{idpedido:idpedido},function(data, status)
								{
									data = JSON.parse(data);
									//alert(data.num_ceros);
									if (data.num_ceros==0) {


											$.post("ajax/diseno.php?op=contar_entregas_dia",{idsalida:idsalida},function(data, status)
											{
												data = JSON.parse(data);
												var num_entregas = parseInt(data.num_entregas)+1;
												//alert(num_entregas);
												$.post("ajax/diseno.php?op=guardar_entrega",{
													idsalida:idsalida,
													cliente_new_e:cliente_new_e,
													contacto_new_e:contacto_new_e,
													dir_entrega_new_e:dir_entrega_new_e,
													num_entregas:num_entregas,
													telefono_new_e:telefono_new_e,
													horario_new_e:horario_new_e,
													condic_new_e:condic_new_e,
													medio_new_e:medio_new_e,						
													idpedido:idpedido
												},function(data, status)
												{
													data = JSON.parse(data);
													//$("#productos_entrega").show();
													//var idsalida = $("#idsalida").val();
													var identrega = data.identrega;
													//var identrega = data.identrega;
													$("#identrega").val(identrega);
													//var idpedido = $("#idpedido_salida").val();
													//alert(idpedido);
													if (idsalida != "" && identrega != "" && idpedido != "") {



														$.post("ajax/diseno.php?op=guardar_prod_ent&idpedido="+idpedido+"&identrega="+identrega+"&idsalida="+idsalida,function(r){
														$("#prueba_tbl").html(r);


																		$.post("ajax/diseno.php?op=listar_productos_new&id="+identrega,function(r){
																				$("#box_productos5").html(r);

																				var idpg_pedidos = idpedido;

																				


																					$.post("ajax/entregas_prod.php?op=listar_prod_selec&id="+idpg_pedidos,function(r){
																						$("#box_prod_pasar_add").html(r);

																						

																						$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+idsalida,function(r){
																						$("#tbl_entregas_list").html(r);

																							bootbox.alert("Entrega registrada exitosamente", function(){ 
																							    $("#modal_select_entrega").modal("hide");
																							    document.getElementById('btn_guardar_entrega').disabled = false;
																							    limpiar_post_guardado();
																							});
																							//loader();
																							//valid_entrega();
																						});												

																					});

																						    
																		});

														});

														

															
																/*$.post("ajax/diseno.php?op=consul_ids",{idpedido:idpedido},function(data, status)
																{
																	data = JSON.parse(data);

																	var id1 = data.id1;
																	var id2 = data.id2;

																	$.post("ajax/diseno.php?op=guardar_productos_entrega",{idsalida:idsalida,identrega:identrega,id1:id1,id2:id2,idpedido:idpedido},function(data, status)
																	{
																		data = JSON.parse(data);*/
																		
																		

																	//});


																		

																//});
								

													}else{
														bootbox.alert("Asegurese de haber seleccionado la salida y entrega correctamente");
														document.getElementById('btn_guardar_entrega').disabled = false;
													}


												});

											});



									}else{
										bootbox.alert("Es necesario capturar todas las cantidades a entregar");
										document.getElementById('btn_guardar_entrega').disabled = false;
									}

								});
			    		}else{
			    			if (is_exced==2) {


			    			
									


											$.post("ajax/diseno.php?op=contar_entregas_dia",{idsalida:idsalida},function(data, status)
											{
												data = JSON.parse(data);
												var num_entregas = parseInt(data.num_entregas)+1;
												//alert(num_entregas);
												$.post("ajax/diseno.php?op=guardar_entrega",{
													idsalida:idsalida,
													cliente_new_e:cliente_new_e,
													contacto_new_e:contacto_new_e,
													dir_entrega_new_e:dir_entrega_new_e,
													num_entregas:num_entregas,
													telefono_new_e:telefono_new_e,
													horario_new_e:horario_new_e,
													condic_new_e:condic_new_e,
													medio_new_e:medio_new_e,						
													idpedido:idpedido
												},function(data, status)
												{
													data = JSON.parse(data);
													//$("#productos_entrega").show();
													//var idsalida = $("#idsalida").val();
													var identrega = data.identrega;
													//var identrega = data.identrega;
													$("#identrega").val(identrega);
													//var idpedido = $("#idpedido_salida").val();
													//alert(idpedido);
													if (idsalida != "" && identrega != "" && idpedido != "") {

														

															
																
																		
																		$.post("ajax/diseno.php?op=listar_productos_new&id="+identrega,function(r){
																				$("#box_productos5").html(r);

																				var idpg_pedidos = idpedido;

																				


																					$.post("ajax/entregas_prod.php?op=listar_prod_selec&id="+idpg_pedidos,function(r){
																						$("#box_prod_pasar_add").html(r);

																						/*$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+idsalida,function(r){
																						$("#select_entrega").html(r);*/

																						$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+idsalida,function(r){
																						$("#tbl_entregas_list").html(r);

																							bootbox.alert("Entrega registrada exitosamente", function(){ 
																							    $("#modal_select_entrega").modal("hide");
																							    document.getElementById('btn_guardar_entrega').disabled = false;
																							    limpiar_post_guardado();
																							});
																							//loader();
																							//valid_entrega();
																						});												

																					});

																						    
																		});

																	
								

													}else{
														bootbox.alert("Asegurese de haber seleccionado la salida y entrega correctamente");
														document.getElementById('btn_guardar_entrega').disabled = false;
													}


												});

											});



									

								

			    			}else{
			    				bootbox.alert("Seleccionar tipo de registro");
			    				document.getElementById('btn_guardar_entrega').disabled = false;
			    			}
			    		}	
						

						



			    	}



			    }
			});


		}else{
			bootbox.alert("Error al cargar productos, intentelo nuevamente");
			document.getElementById('btn_guardar_entrega').disabled = false;
		}
				

		
}







function ver_productos2(identrega,idpedido)
{
	//var identrega = $("#select_entrega").val();
	$("#div_impr_salida").show();
	$("#identrega").val(identrega);
	$("#productos_entrega").show();
	$("#idpedido_det_ent").val(idpedido);
	//alert(identrega);

	$.post("ajax/diseno.php?op=consul_entrega",{identrega:identrega},function(data, status)
	{
		data = JSON.parse(data);

		$("#numero_entrega").text("No. salida: "+data.no_entrega);
		$("#cliente_ent").text("Cliente: "+data.nom_cliente);
		$("#direccion_ent2").text("Dirección de entrega: "+data.direccion);
		$("#contacto_ent2").text("Contacto: "+data.contacto);
		$("#observ_salida").val(data.observaciones);

		$.post("ajax/diseno.php?op=listar_productos_new&id="+identrega,function(r){
		$("#box_productos5").html(r);
			//valid_entrega();
			//document.getElementById('btn_agregar_productos').disabled = false;
			//document.getElementById('btn_salida_mercancia').disabled = false;
			div_reg_exced_salida();
			$("#div_excedente_salida").hide();

		});

	});
}

function borrar_entrega2()
{
	var idsalida = $("#idsalida").val();
	var identrega = $("#identrega").val();
	var idusuario = $("#idusuario").text();

	if (idusuario==1 || idusuario==4) {

		bootbox.confirm({
		    message: "¿Desea cancelar esta salida?",
		    buttons: {
		        confirm: {
		            label: 'Si',
		            className: 'btn-success'
		        },
		        cancel: {
		            label: 'No',
		            className: 'btn-danger'
		        }
		    },
		    callback: function (result) {

		    	if (result==true) {

		    		$.post("ajax/diseno.php?op=borrar_entrega2",{identrega:identrega},function(data, status)
					{
						data = JSON.parse(data);


						$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+idsalida,function(r){
						$("#tbl_entregas_list").html(r);
							bootbox.alert("Salida cancelada correctamente");
						});

					});
		    	}
		        
		    }
		});
	}else{
		bootbox.alert("No tiene permisos para realizar esta accion");
	}


		




				
}


function agregar_productos()
{
	var identrega=$("#identrega").val();

	if (identrega>0) {
		$("#modal_add_producto").modal("show");
	}else{
		bootbox.alert("Es necesario seleccionar una entrega");
	}
	
	
}

function buscar_control()
{
	var no_control = $("#no_control").val();

	$.post("ajax/entregas_prod.php?op=buscar_idpg_pedidos",{no_control:no_control},function(data, status)
	{
		data = JSON.parse(data);

		var idpg_pedidos= data.idpg_pedidos;
		$("#idpedido_salida").val(idpg_pedidos);
		//alert(idpg_pedidos);

		$.post("ajax/entregas_prod.php?op=listar_prod_selec&id="+idpg_pedidos,function(r){
		$("#box_prod_pasar").html(r);

			$.post("ajax/entregas_prod.php?op=listar_prod_selec&id="+0,function(r){
			$("#box_prod_pasar_add").html(r);
											

			});
				
										

		});

	});


		
}


function pasar_productos()
{
	//$("#productos_entrega").show();
	var idsalida = $("#idsalida").val();
	var identrega = $("#identrega").val();
	var idpedido = $("#idpedido_salida").val();
	//alert(idpedido);
	if (idsalida != "" && identrega != "" && idpedido != "") {

		$.post("ajax/diseno.php?op=contar_ceros",{idpedido:idpedido},function(data, status)
		{
			data = JSON.parse(data);

			//alert(data.num_ceros);

			if (data.num_ceros==0) {z



				$.post("ajax/diseno.php?op=consul_ids",{idpedido:idpedido},function(data, status)
				{
					data = JSON.parse(data);

					var id1 = data.id1;
					var id2 = data.id2;

					$.post("ajax/diseno.php?op=guardar_productos_entrega",{idsalida:idsalida,identrega:identrega,id1:id1,id2:id2},function(data, status)
					{
						data = JSON.parse(data);

						
						$.post("ajax/diseno.php?op=listar_productos_new&id="+identrega,function(r){
								$("#box_productos5").html(r);

								var idpg_pedidos = idpedido;

								


									$.post("ajax/entregas_prod.php?op=listar_prod_selec&id="+idpg_pedidos,function(r){
										$("#box_prod_pasar").html(r);

										bootbox.alert("Productos agregados correctamente");

									});

										        
								
						});

					});


						

				});



			}else{
				bootbox.alert("Es necesario capturar todas las cantidades a entregar");
			}

		});	

				

	}else{
		bootbox.alert("Asegurese de haber seleccionado la salida y entrega correctamente");
	}
		
}




function abrir_vale()
{
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	//var idusuario = $("#idusuario").text();
	var identrega = $("#identrega").val();

	//alert(identrega);
	
		$("#enlace_vale").attr("href","reportes/valeSalidaMerc.php?id="+identrega+"&fecha="+fecha);
	
	

	
	//$("#enlace_vale").attr("href","reportes/repValid.php");
}


function valid_entrega()
{
	var identrega = $("#identrega").val();

	if (identrega>0) {

		document.getElementById('btn_salida_mercancia').disabled = false;
	}else{
		document.getElementById('btn_salida_mercancia').disabled = true;
	}

}

function ver_salida(idsalida)
{
	$("#productos_entrega").hide();

	$("#no_salida_text").text("");
	$("#fecha_hora_salida_text").text("");
	$("#chofer_salida_text").text("");
	$("#vehiculo_salida_text").text("");

	$("#numero_entrega").text("");
	$("#cliente_ent").text("");
	$("#contacto_ent2").text("");
	$("#direccion_ent2").text("");
	//document.getElementById('btn_agregar_productos').disabled = true;
	//document.getElementById('btn_salida_mercancia').disabled = true;
	
	$("#div_lista_salidas").hide();
	$("#div_nueva_entrega_window").show();
	//$("#btn_nueva_asignacion").hide();
	//$("#div_regresar_a_lista").show();
	//$("#prod_pedido").hide();
	
	//$("#text_nueva_salida").hide();
	//$("#div_eti_entrega").show();
	//$("#btn_agregar_productos").show();
	$("#no_control").val("");

	$("#idsalida").val(idsalida);

	var idusuario = $("#idusuario").text();


	$.post("ajax/entregas_prod.php?op=consultar_datos_salida",{idsalida:idsalida},function(data, status)
	{
		data = JSON.parse(data);

				$("#no_salida_text").text(data.no_salida);
				$("#fecha_hora_salida_text").text(data.fecha_salida);
				if (idusuario==1) {
					$("#fecha_hora_salida_input").show();
					$("#fecha_hora_salida_input").val(data.fecha_salida);
				}else{
					$("#fecha_hora_salida_input").hide();
				}
				
				$("#chofer_salida_text").text(data.nom_repartidor);
				$("#vehiculo_salida_text").text(data.nom_vehiculo);


				/*$.post("ajax/diseno.php?op=listar_salidas_listbox",function(r){
				$("#select_salida").html(r);*/

						//$("#select_salida").val(idsalida);
						//document.getElementById('select_salida').disabled = true;

							//alert(idsalida);
							$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+idsalida,function(r){
							$("#tbl_entregas_list").html(r);



								$.post("ajax/diseno.php?op=listar_productos_new_salidas&id="+idsalida,function(r){
								$("#box_productos5").html(r);

									//$("#btn_opciones_vales").show();
									var idpg_pedidos=0;

									$.post("ajax/entregas_prod.php?op=listar_prod_selec&id="+idpg_pedidos,function(r){
									$("#box_prod_pasar").html(r);
																	
										//valid_entrega();
									});



								});

							});
				//});

	});


				

	//alert(idsalida);

			/*$.post("ajax/entregas_prod.php?op=ver_salida",{idsalida:idsalida},function(data, status)
			{
				data = JSON.parse(data);

				var idsalida = data.idsalida;
			});*/
}

/*function ver_entregas2()
{
	//$("#div_eti_entrega").show();
	//$("#div_nueva_entrega").hide();
	//$("#productos_entrega").hide();

	var idsalida = $("#select_salida").val();
	$("#idsalida").val(idsalida);

	//alert(idsalida);

		

			$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+idsalida,function(r){
			$("#select_entrega").html(r);
				$.post("ajax/diseno.php?op=listar_productos_new_salidas&id="+idsalida,function(r){
				$("#box_productos5").html(r);

					//$("#btn_opciones_vales").show();

				});

			});
		
}*/

function abrir_nuevo_chofer()
{
    $("#modal_nuevo_chofer").modal("show");
	$("#modal_nueva_salida").modal("hide");
}

function abrir_nuevo_vehiculo()
{
    $("#modal_nuevo_vehiculo").modal("show");
	$("#modal_nueva_salida").modal("hide");
}


function guardar_chofer()
{
	var nom_chofer = $("#nom_chofer").val();

	$.post("ajax/diseno.php?op=guardar_chofer",{nom_chofer:nom_chofer},function(data, status)
	{
		data = JSON.parse(data);

		var idrepartidor = data.idrepartidor;

		$("#modal_nuevo_chofer").modal("hide");
		$("#modal_nueva_salida").modal("show");
		listar_choferes();

		//$("#select_chofer").val(idrepartidor);

	});
}

function guardar_vehiculo()
{
	var nom_vehiculo = $("#nom_vehiculo").val();

	$.post("ajax/diseno.php?op=guardar_vehiculo",{nom_vehiculo:nom_vehiculo},function(data, status)
	{
		data = JSON.parse(data);

		var idvehiculo = data.idvehiculo;


		$("#modal_nuevo_vehiculo").modal("hide");
		$("#modal_nueva_salida").modal("show");
		listar_vehiculos();

		//$("#select_vehiculo").val(idvehiculo);
		

	});
}


function abrir_modal_salida()
{
	$("#modal_salida").modal("show");

	var idsalida = $("#idsalida").val();

	$.post("ajax/entregas_prod.php?op=consultar_datos_salida",{idsalida:idsalida},function(data, status)
	{
		data = JSON.parse(data);

		$("#nom_cliente_salida").val(data.nom);
		$("#domicilio_cliente_salida").val(data.dom);
		$("#contacto_cliente_salida").val(data.contacto);
		$("#telefono_cliente_salida").val(data.tel);
		$("#condiciones_cliente_salida").val(data.cond);
		$("#medio_cliente_salida").val(data.medio);
	});

}

function generar_salida_total()
{
	var idsalida = $("#idsalida").val();
	//alert(idsalida);
	var fecha=moment().format('YYYY-MM-DD');
	var nom_cliente_salida = $("#nom_cliente_salida").val();
	var domicilio_cliente_salida = $("#domicilio_cliente_salida").val();
	var contacto_cliente_salida = $("#contacto_cliente_salida").val();
	var telefono_cliente_salida = $("#telefono_cliente_salida").val();
	var horario_cliente_salida1 = $("#horario_cliente_salida1").val();
	var horario_cliente_salida2 = $("#horario_cliente_salida2").val();
	var horario_cliente_salida = horario_cliente_salida1+" "+horario_cliente_salida2;
	var condiciones_cliente_salida = $("#condiciones_cliente_salida").val();
	var medio_cliente_salida = $("#medio_cliente_salida").val();

	$("#enlace_salida_tot").attr("href","reportes/valeSalidaMerc_tot.php?idsalida="+idsalida
		+"&nom_cliente_salida="+nom_cliente_salida
		+"&domicilio_cliente_salida="+domicilio_cliente_salida
		+"&contacto_cliente_salida="+contacto_cliente_salida
		+"&telefono_cliente_salida="+telefono_cliente_salida
		+"&horario_cliente_salida="+horario_cliente_salida
		+"&condiciones_cliente_salida="+condiciones_cliente_salida
		+"&medio_cliente_salida="+medio_cliente_salida
		);

}

function guardar_lote(identrega_detalle)
{
	var input_lote = $("#input_lote"+identrega_detalle).val();

	$.post("ajax/entregas_prod.php?op=guardar_lote",{identrega_detalle:identrega_detalle,input_lote:input_lote},function(data, status)
	{
		data = JSON.parse(data);

	});
}

function guardar_obs(identrega_detalle)
{
	var input_observ = $("#input_observ"+identrega_detalle).val();
input_observ
	$.post("ajax/entregas_prod.php?op=guardar_obs",{identrega_detalle:identrega_detalle,input_observ:input_observ},function(data, status)
	{
		data = JSON.parse(data);

	});
}


function update_observ_salida()
{
	var identrega = $("#identrega").val();
	var observ_salida = $("#observ_salida").val();

	$.post("ajax/entregas_prod.php?op=update_observ_salida",{identrega:identrega,observ_salida:observ_salida},function(data, status)
	{
		data = JSON.parse(data);

	});
}




function selec_prod_exced_salida()
{
	$("#idproducto_exced_salida_control").val("");
	$("#buscar_prod_exced_salida").val("");
	$("#nombre_exced_salida_control").val("");
	$("#observ_exced_salida_control").val("");
	$("#cant_exced_salida_control").val("");
}

function agregar_prod_salida()
{
	var iddetalle_pedido_selec = $("#prod_exced_salida_control").val();
	var iddetalle_pedido_id = $("#idproducto_exced_salida_control").val();
	var cantidad = $("#cant_exced_salida_control").val();
	var observ = $("#observ_exced_salida_control").val();
	var identrega = $("#identrega").val();
	var idsalida = $("#idsalida").val();
	var idpedido = $("#idpedido_det_ent").val();

	//alert(iddetalle_pedido_selec);
	//alert(iddetalle_pedido_id);


	if (iddetalle_pedido_selec>0) {
		var iddetalle_pedido = iddetalle_pedido_selec;
		var tipo_idprod = 1;
	}else{
		var iddetalle_pedido = iddetalle_pedido_id;
		var tipo_idprod = 2;
	}

	//alert(iddetalle_pedido);
		

	/*alert(iddetalle_pedido);
	alert(cantidad);
	alert(identrega);
	alert(idsalida);
	alert(idpedido);*/

	if (iddetalle_pedido>0 && cantidad>0 && observ!="") {

		$.post("ajax/entregas_prod.php?op=agregar_prod_salida",{
			iddetalle_pedido:iddetalle_pedido,
			cantidad:cantidad,
			identrega:identrega,
			observ:observ,
			idsalida:idsalida,
			idpedido:idpedido,
			tipo_idprod:tipo_idprod
		},function(data, status)
		{
			data = JSON.parse(data);

			bootbox.alert("Excedente agregado correctamente");

			$.post("ajax/diseno.php?op=listar_productos_new&id="+identrega,function(r){
			$("#box_productos5").html(r);
			});
		});
	}else{
		bootbox.alert("Verificar datos");
	}

		
}


function buscar_control_salida()
{
	var valor1 = $("#fecha_1_buscar").val();
	var valor2 = $("#fecha_2_buscar").val();
	var valor3 = $("#no_salida_buscar").val();
	var valor4 = $("#no_control_buscar").val();

	var marcador_busqueda = $("#marcador_busqueda").val();

	//alert(marcador_busqueda);

	if (marcador_busqueda==1) {

		if (valor1!="" && valor2!="") {

			$.post("ajax/entregas_prod.php?op=listar_salidas_control&valor1="+valor1+"&valor2="+valor2+"&marcador="+marcador_busqueda,function(r){
			$("#tbl_salidas").html(r);

			});

		}else{
			bootbox.alert("Es necesario establecer el rango de busqueda en ambos campos de fecha, valide y vuelva a intentar");
		}

			
	}

	if (marcador_busqueda==2) {

		$.post("ajax/entregas_prod.php?op=listar_salidas_control&valor1="+valor3+"&valor2="+0+"&marcador="+marcador_busqueda,function(r){
		$("#tbl_salidas").html(r);

		});
	}

	if (marcador_busqueda==3) {

		$.post("ajax/entregas_prod.php?op=listar_salidas_control&valor1="+valor4+"&valor2="+0+"&marcador="+marcador_busqueda,function(r){
		$("#tbl_salidas").html(r);

		});
	}

		

}

function limpiar_campos_busqueda1()
{
	$("#no_salida_buscar").val("");
	$("#no_control_buscar").val("");
	document.getElementById('fecha_2_buscar').disabled = false;
	$("#marcador_busqueda").val("1");
}

function limpiar_campos_busqueda2()
{
	$("#fecha_1_buscar").val("");
	$("#fecha_2_buscar").val("");
	document.getElementById('fecha_2_buscar').disabled = true;
	$("#no_control_buscar").val("");
	$("#marcador_busqueda").val("2");
}

function limpiar_campos_busqueda3()
{
	$("#fecha_1_buscar").val("");
	$("#fecha_2_buscar").val("");
	document.getElementById('fecha_2_buscar').disabled = true;
	$("#no_salida_buscar").val("");
	$("#marcador_busqueda").val("3");
}

function ver_lotes_vale_alm(iddetalle_pedido,identrega_detalle)
{
	//alert(iddetalle_pedido);
	$("#modal_lista_lotes").modal("show");
	$("#identrega_detalle").val(identrega_detalle);


	$.post("ajax/entregas_prod.php?op=contar_op",{iddetalle_pedido:iddetalle_pedido},function(data, status)
	{
		data = JSON.parse(data);

		//alert(data.num_ops);

		var num_ops = data.num_ops;

		if (num_ops<=1) {

			$.post("ajax/entregas_prod.php?op=buscar_area_ent",{iddetalle_pedido:iddetalle_pedido},function(data, status)
			{
				data = JSON.parse(data);
				//alert(data);

				if (data==null) {
					var area=0;
				}else{

					var area=data.area;
				}

				//alert(area);


				
				$.post("ajax/entregas_prod.php?op=ver_lotes_vale_alm&iddetalle_pedido="+iddetalle_pedido+"&area="+area,function(r){
				$("#tbl_lotes_disp").html(r);

				});
				
				

			});


			//alert(num_ops);
		}else{
			bootbox.alert("No es posible mostrar los lotes");
		}

	});



			




}

function enviar_lotes(idpresalida,lote,iddetalle_pedido,cantidad)
{
	var cantidad_enviar = $("#cant_lote_enviar"+idpresalida).val();
	var identrega_detalle = $("#identrega_detalle").val();

	

	if (parseInt(cantidad_enviar)>0 && parseInt(cantidad_enviar)<=parseInt(cantidad)) {


		$.post("ajax/entregas_prod.php?op=enviar_lotes",{identrega_detalle:identrega_detalle,idpresalida:idpresalida,lote:lote,cantidad_enviar:cantidad_enviar},function(data, status)
		{
			data = JSON.parse(data);

			var identrega = $("#identrega").val();

			$.post("ajax/diseno.php?op=listar_productos_new&id="+identrega,function(r){
			$("#box_productos5").html(r);

				$.post("ajax/entregas_prod.php?op=ver_lotes_vale_alm&iddetalle_pedido="+iddetalle_pedido,function(r){
				$("#tbl_lotes_disp").html(r);

				});
				

			});

		});

	}else{
		bootbox.alert("Verifique la cantidad y vuelva a intentar");
	}

		
	
}


function buscar_producto_exced_salida()
{
	$("#prod_exced_salida_control").val("")
	$("#observ_exced_salida_control").val("");
	$("#cant_exced_salida_control").val("");




	var codigo = $("#buscar_prod_exced_salida").val()

	$.post("ajax/entregas_prod.php?op=buscar_producto_exced_salida",{codigo:codigo},function(data, status)
	{
		data = JSON.parse(data);

		$("#nombre_exced_salida_control").val(data.nombre);
		$("#idproducto_exced_salida_control").val(data.idproducto);

	});

}


function borrar_prod_salida(identrega_detalle,cantidad,no_salida_ent,idproducto,idpedido)
{
	/*alert(identrega_detalle);
	alert(cantidad);
	alert(no_salida_ent);
	alert(idproducto);*/

	var no_salida = no_salida_ent;

	var idusuario = $("#idusuario").text();

	if (idusuario==1 || idusuario==4 || idusuario==8) {


		bootbox.confirm({
		    message: "¿Esta seguro de eliminar este producto de la salida?",
		    buttons: {
		        confirm: {
		            label: 'Si',
		            className: 'btn-success'
		        },
		        cancel: {
		            label: 'No',
		            className: 'btn-danger'
		        }
		    },
		    callback: function (result) {
		        

		        if (result==true) {


		        	$.post("ajax/entregas_prod.php?op=borrar_prod_salida",{identrega_detalle:identrega_detalle,cantidad:cantidad,idusuario:idusuario,no_salida:no_salida,idproducto:idproducto,idpedido:idpedido},function(data, status)
					{
						data = JSON.parse(data);

						var identrega = $("#identrega").val();

						$.post("ajax/diseno.php?op=listar_productos_new&id="+identrega,function(r){
						$("#box_productos5").html(r);
							

						});


					});


		        }
		    }
		});





					
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción");
	}

		
}

function div_reg_exced_salida()
{
	$("#div_prod_ped").hide();
	$("#div_piezas_salida").hide();
	$("#div_observ_cant").hide();
	$("#btn_agregar_prod").hide();

	$("#idproducto_exced_salida_control").val("");
	
	$("#div_excedente_salida").show();
	var idpedido_det_ent = $("#idpedido_det_ent").val();

	$.post("ajax/entregas_prod.php?op=listar_prod_control_exc&idpedido="+idpedido_det_ent,function(r){
	$("#prod_exced_salida_control").html(r);

	});
}

function mostrar_div_tipoingreso()
{
	var tipo = $("#select_tipo_ingreso").val();

	if (tipo==1) {

		$("#div_prod_ped").show();
		$("#div_piezas_salida").hide();
		$("#div_observ_cant").show();
		$("#btn_agregar_prod").show();
		$("#prod_ped_tipo").val("1");
	}
	if (tipo==2) {
		$("#div_prod_ped").hide();
		$("#div_piezas_salida").show();
		$("#div_observ_cant").show();
		$("#btn_agregar_prod").show();
		$("#prod_ped_tipo").val("0");
	}

	if (tipo==3) {
		$("#div_prod_ped").show();
		$("#div_piezas_salida").hide();
		$("#div_observ_cant").show();
		$("#btn_agregar_prod").show();
		$("#prod_ped_tipo").val("2");

	}
}


function agregar_prod_salida()
{
	var iddetalle_pedido_selec = $("#prod_exced_salida_control").val();
	var iddetalle_pedido_id = $("#idproducto_exced_salida_control").val();
	var cantidad = $("#cant_exced_salida_control").val();
	var observ = $("#observ_exced_salida_control").val();
	var identrega = $("#identrega").val();
	var idsalida = $("#idsalida").val();
	var idpedido = $("#idpedido_det_ent").val();
	var prod_ped_tipo = $("#prod_ped_tipo").val();

	if (iddetalle_pedido_selec>0) {
		var iddetalle_pedido = iddetalle_pedido_selec;
		var tipo_idprod = 1;
	}else{
		var iddetalle_pedido = iddetalle_pedido_id;
		var tipo_idprod = 2;
	}

	//alert(tipo_idprod);


	if (iddetalle_pedido>0 && cantidad>0 && observ!="") {

		$.post("ajax/entregas_prod.php?op=agregar_prod_salida",{
			iddetalle_pedido:iddetalle_pedido,
			cantidad:cantidad,
			identrega:identrega,
			observ:observ,
			idsalida:idsalida,
			idpedido:idpedido,
			tipo_idprod:tipo_idprod,
			prod_ped_tipo:prod_ped_tipo
		},function(data, status)
		{
			data = JSON.parse(data);

			bootbox.alert("Excedente agregado correctamente");

			$.post("ajax/diseno.php?op=listar_productos_new&id="+identrega,function(r){
			$("#box_productos5").html(r);
			});
		});
	}else{
		bootbox.alert("Verificar datos");
	}

		
}

function guardar_cantidad(identrega_detalle)
{
	var input_cant = $("#input_cant"+identrega_detalle).val();

	$.post("ajax/entregas_prod.php?op=guardar_cantidad",{identrega_detalle:identrega_detalle,input_cant:input_cant},function(data, status)
	{
		data = JSON.parse(data);

	});
}




init();												