function init()
{
 listar();

}

function listar()
{
	
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            //'copyHtml5',
		            //'excelHtml5',
		            //'csvHtml5',
		            //'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/contactos.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();

	//$("#avancesp").val("");
}

function abrir_modal(idcontactos)
{
	var idusuario = $("#idusuario").text();
	

	$("#myModal").modal("show");
	$("#btn_pedido").hide();

	$("#idcontacto").val(idcontactos);
	$("#idcontacto3").val(idcontactos);

	

	    $.post("../ajax/contactos.php?op=cargar_contacto",{idcontactos : idcontactos,idusuario:idusuario},function(data, status)
		{
			data = JSON.parse(data);

			$("#nombre_pros").val(data.nombre);
			$("#email").val(data.email);
			$("#telefono").val(data.telefono);
			$("#mensaje").val(data.mensaje);
			//$("#boletin").val(data.noticias);
			$("#fecha_hora").val(data.fecha_hora);
			listar();
			listar_seguimiento();

		

			if (data.pedido!="" && data.pedido!=null) {
				$("#btn_pedido").show();
				$("#idpedido").val(data.pedido);
			}


		});
	
}



function abrir_ventas()
{
	$("#myModal").modal('hide');
	var nombre_cliente = $("#nombre_pros").val();
	var idcontacto = $("#idcontacto").val();
	$("#nombre_cliente").val(nombre_cliente);
	$("#idcontacto2").val(idcontacto);
	$("#myModal_venta").modal('show');
}


function guardar_venta()
{
		var descr_venta = $("#descr_venta2").val();
		var total_pago = $("#total_pago").val();
		var forma_pago = $("#forma_pago").val();

		if (descr_venta!="" && total_pago!="" && forma_pago!="") {

					var nombre_cliente = $("#nombre_pros").val();
					var email = $("#email").val();
					var telefono = $("#telefono").val();

					var fecha=moment().format('YYYY-MM-DD');
	                var hora=moment().format('HH:mm:ss');
	                var fecha_hora=fecha+" "+hora;


					$.post("../ajax/contactos.php?op=guardar_cliente",{nombre_cliente:nombre_cliente,email:email,telefono:telefono,fecha_hora:fecha_hora},function(data, status)
					{
						data = JSON.parse(data);

							var idcliente = data.idcliente;
							alert(idcliente);
							var descr_venta = $("#descr_venta2").val();
							var total_pago = $("#total_pago").val();
							var forma_pago = $("#forma_pago").val();
							var banco = $("#banco").val();
							var referencia = $("#referencia").val();
							var comentario_venta = $("#comentario_venta").val();


							$.post("../ajax/contactos.php?op=guardar_venta",{idcliente:idcliente,descr_venta:descr_venta,total_pago:total_pago,forma_pago:forma_pago,banco:banco,referencia:referencia,comentario_venta:comentario_venta,fecha_hora:fecha_hora},function(data, status)
							{
								data = JSON.parse(data);
								
								bootbox.alert("Venta guardada exitosamente");
								$("#myModal").modal('show');
								$("#myModal_venta").modal('hide');

							});

						
						//
					

						
					});

		}else{
			bootbox.alert("Es necesario capturar la descripcion, total de pago y forma de pago");
		}
}


function back_solic()
{
	$("#myModal").modal('show');
	$("#myModal_venta").modal('hide');
}
function back_solic2()
{
	$("#myModal").modal('show');
	$("#myModal_pedido").modal('hide');
}


function guardar_comentario2()
{
	var idcontacto = $("#idcontacto").val();
	var descr_venta = $("#descr_venta").val();

	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	$.post("../ajax/contactos.php?op=guardar_comentario",{idcontacto:idcontacto,descr_venta:descr_venta,fecha_hora:fecha_hora},function(data, status)
	{
		data = JSON.parse(data);
								
		bootbox.alert("Comentario guardado exitosamente");
		$("#descr_venta").val("");
		listar_seguimiento();

	});

}


function guardar_comentario()
{
	var fecha=moment().format('YYYY-MM-DD');
    var hora=moment().format('HH:mm:ss');
    var fecha_hora=fecha+" "+hora;
    $("#fecha_hora_coment").val(fecha_hora);

    var valor_si = $("#valor_si").val();
    var ar_coment = $("#ar_coment").val();

    	var parametros = new FormData($("#formulario-envia_comentario")[0]);
		$.ajax({

				data: parametros,
				url: "../ajax/contactos.php?op=valid_exist_archivo",
				type: "POST",
				contentType: false,
				processData: false,
				beforesend: function(){

				},
				success: function(data, status){

						data = JSON.parse(data);

						if (data==null) {

								var parametros = new FormData($("#formulario-envia_comentario")[0]);
								$.ajax({

										data: parametros,
										url: "../ajax/contactos.php?op=guardar_comentario",
										type: "POST",
										contentType: false,
										processData: false,
										beforesend: function(){

										},
										success: function(data, status){

												data = JSON.parse(data);
												//$("#descr_venta").text("");
												document.getElementById("descr_venta").value = "";
												bootbox.alert("Comentario guardado exitosamente");
												//alert("1")
												listar_seguimiento();

										}

								});


						}else{

							if (data.archivo=="") {


								var parametros = new FormData($("#formulario-envia_comentario")[0]);
								$.ajax({

										data: parametros,
										url: "../ajax/contactos.php?op=guardar_comentario",
										type: "POST",
										contentType: false,
										processData: false,
										beforesend: function(){

										},
										success: function(data, status){

												data = JSON.parse(data);
												//$("#descr_venta").text("");
												document.getElementById("descr_venta").value = "";
												bootbox.alert("Comentario guardado exitosamente");
												//alert("2")

												listar_seguimiento();

										}

								});

							}else{
								bootbox.alert("Este archivo ya ha sido cargado para este u otro contacto, cambie el nombre del archivo e intente de nuevo");
							}



							
						}

						

				}

		});

		
}


function listar_seguimiento()
{
	var idcontacto = $("#idcontacto").val();
	//alert(idcontacto);

	tabla=$('#tbllistado_seg').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            //'copyHtml5',
		            //'excelHtml5',
		            //'csvHtml5',
		            //'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/contactos.php?op=listar_seguimiento',
					data:{idcontacto: idcontacto},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();

	//$("#avancesp").val("");
}


function abrir_pedido()
{
	$("#myModal").modal('hide');

	/*$("#idcliente_c").val("");
	$("#no_cliente_c").val("");
	$("#nombre_cliente_c").val("");
	$("#email_c").val("");
	$("#telefono_c").val("");

	$("#idcliente_c2").val("");
	$("#no_cliente_c2").val("");
	$("#nombre_cliente_c2").val("");
	$("#email_c2").val("");
	$("#telefono_c2").val("");

	$("#marca_new_cli").val("");
	$("#no_cliente_p").val("");
	$("#nombre_cliente_p").val("");
	$("#email_cliente_p").val("");
	$("#telefono_cliente_p").val("");
	$("#num_pedido").val("");
	$("#concepto_pedido").val("");*/


	
		var nombre_cliente = $("#nombre_pros").val();
		var email = $("#email").val();
		var telefono = $("#telefono").val();



		$.post("../ajax/contactos.php?op=valid_nombre_cliente",{nombre_cliente:nombre_cliente},function(data, status)
		{
			data = JSON.parse(data);

			

			if (data==null) {

				var email = $("#email").val();

				$.post("../ajax/contactos.php?op=valid_email",{email:email},function(data, status)
				{
					data = JSON.parse(data);

					//alert(data);

					if (data==null) {

						var nombre_cliente = $("#nombre_pros").val();
						var email = $("#email").val();
						var telefono = $("#telefono").val();

						$("#myModal_pedido").modal('show');
						$("#nombre_cliente_p").val(nombre_cliente);
						$("#email_cliente_p").val(email);
						$("#telefono_cliente_p").val(telefono);
						$("#no_cliente_p").val("");
						$("#marca_new_cli").val("1");
						//$("#idcontacto2").val(idcontacto);
						
						

					}else{

						var nombre_cliente = $("#nombre_pros").val();
						var email = $("#email").val();
						var telefono = $("#telefono").val();

						$("#nombre_txt").text(nombre_cliente);
						$("#email_txt").text(email);
						$("#telefono_txt").text(telefono);

					
						

						$.post("../ajax/contactos.php?op=list_coin_cli",{nombre_cliente:nombre_cliente,email:email}, function(r){

						    $("#tbllistado_coin_clien").html(r);
						    $('#tbllistado_coin_clien').selectpicker('refresh');
								                

						});


						/*$("#idcliente_c").val(data.idcliente);
						$("#no_cliente_c").val(data.no_cliente);
						$("#nombre_cliente_c").val(data.nombre);
						$("#email_c").val(data.email);
						$("#telefono_c").val(data.telefono);*/

						

						$("#myModal_valid").modal('show');
						$("#marca_new_cli").val("0");

						

						//contador=parseInt(contador)+1;
						
					}
					
					//alert(contador);
				});	

			}else{
				//alert("entra");
				//contador=parseInt(contador)+1;

				var nombre_cliente = $("#nombre_pros").val();
				var email = $("#email").val();
				var telefono = $("#telefono").val();

				$("#nombre_txt").text(nombre_cliente);
				$("#email_txt").text(email);
				$("#telefono_txt").text(telefono);
						

				$.post("../ajax/contactos.php?op=list_coin_cli",{nombre_cliente:nombre_cliente,email:email}, function(r){

						  $("#tbllistado_coin_clien").html(r);
						  $('#tbllistado_coin_clien').selectpicker('refresh');								                

				});

				/*$("#idcliente_c").val(data.idcliente2);
				$("#no_cliente_c").val(data.no_cliente2);
				$("#nombre_cliente_c").val(data.nombre2);
				$("#email_c").val(data.email2);
				$("#telefono_c").val(data.telefono2);*/
				$("#marca_new_cli").val("0");
				$("#myModal_valid").modal('show');
				//

				/*$.post("../ajax/contactos.php?op=valid_email",{email:email},function(data, status)
				{
					data = JSON.parse(data);

					if (data==null) {

						//contador==0;
						

					}else{

						//contador=parseInt(contador)+1;
						$("#idcliente_c2").val(data.idcliente);
						$("#no_cliente_c2").val(data.no_cliente);
						$("#nombre_cliente_c2").val(data.nombre);
						$("#email_c2").val(data.email);
						$("#telefono_c2").val(data.telefono);
						
						
					}

					//$("#myModal_valid").modal('show');
					$("#nombre_txt").text(nombre_cliente);
					$("#email_txt").text(email);
					$("#telefono_txt").text(telefono);
					//alert(contador);
				});	*/
			}


		});	

}


/*function enviar_cliente1()
{
	$("#no_cliente_p").val("");
	$("#nombre_cliente_p").val("");
	$("#email_cliente_p").val("");
	$("#telefono_cliente_p").val("");

	var no_cliente_env1 = $("#no_cliente_c").val();
	var nombre_cliente_env1 = $("#nombre_cliente_c").val();

	$("#no_cliente_p").val(no_cliente_env1);
	$("#nombre_cliente_p").val(nombre_cliente_env1);

	$("#myModal_valid").modal('hide');
	$("#myModal_pedido").modal('show');

}*/

/*function enviar_cliente2()
{
	$("#no_cliente_p").val("");
	$("#nombre_cliente_p").val("");
	$("#email_cliente_p").val("");
	$("#telefono_cliente_p").val("");

	var no_cliente_env1 = $("#no_cliente_c2").val();
	var nombre_cliente_env1 = $("#nombre_cliente_c2").val();

	$("#no_cliente_p").val(no_cliente_env1);
	$("#nombre_cliente_p").val(nombre_cliente_env1);

	$("#myModal_valid").modal('hide');
	$("#myModal_pedido").modal('show');

}*/


function abrir_cli_pedido(idcliente)
{
	
	$("#myModal_valid").modal('hide');
	$("#myModal_pedido").modal('show');

	$("#no_cliente_p").val("");
	$("#nombre_cliente_p").val("");
	$("#email_cliente_p").val("");
	$("#telefono_cliente_p").val("");

	$.post("../ajax/contactos.php?op=abrir_cli_pedido",{idcliente:idcliente},function(data, status)
	{
		data = JSON.parse(data);
																							
		$("#no_cliente_p").val(data.no_cliente);
		$("#nombre_cliente_p").val(data.nombre);
		$("#email_cliente_p").val(data.email);
		$("#telefono_cliente_p").val(data.telefono);
																						
	});

}


function omitir_coin()
{
	$("#no_cliente_p").val("");
	$("#nombre_cliente_p").val("");
	$("#email_cliente_p").val("");
	$("#telefono_cliente_p").val("");
	var nombre_txt = $("#nombre_txt").text();
	var email_txt = $("#email_txt").text();
	var	telefono_txt = $("#telefono_txt").text();

	$("#nombre_cliente_p").val(nombre_txt);
	$("#email_cliente_p").val(email_txt);
	$("#telefono_cliente_p").val(telefono_txt);
	$("#myModal_valid").modal('hide');
	$("#myModal_pedido").modal('show');
	$("#marca_new_cli").val("1");
}

function guardar_pedido()
{
	var num_cliente = $("#no_cliente_p").val();
	var num_pedido = $("#num_pedido").val();
	var nombre = $("#concepto_pedido").val();

	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	if (num_cliente!="" && num_pedido!="" && nombre!="") {

		var marca = $("#marca_new_cli").val();
		if (marca==1) {

			

				$.post("../ajax/contactos.php?op=buscar_num_cli",{num_cliente:num_cliente},function(data, status)
				{
					data = JSON.parse(data);

					//alert(data);

					if (data==null) {

						


							$.post("../ajax/contactos.php?op=buscar_num_ped",{num_pedido:num_pedido},function(data, status)
							{
								data = JSON.parse(data);

								if (data==null) {

											var nombre_cliente = $("#nombre_cliente_p").val();
											var num_cliente = $("#no_cliente_p").val();
											var email = $("#email_cliente_p").val();
											var telefono = $("#telefono_cliente_p").val();

											var fecha=moment().format('YYYY-MM-DD');
											var hora=moment().format('HH:mm:ss');
											var fecha_hora=fecha+" "+hora;

											$.post("../ajax/contactos.php?op=guardar_cliente",{nombre_cliente:nombre_cliente,num_cliente:num_cliente,email:email,telefono:telefono,fecha_hora:fecha_hora},function(data, status)
											{
											data = JSON.parse(data);

											var idcliente = data.idcliente;
											var num_cliente = data.no_cliente;
											//alert(num_cliente);
											var num_pedido = $("#num_pedido").val();
											var nombre = $("#concepto_pedido").val();
											var fecha=moment().format('YYYY-MM-DD');
											var hora=moment().format('HH:mm:ss');
											var fecha_hora=fecha+" "+hora;
											//alert(idcliente);


														var parametros = new FormData($("#formulario-envia_pedido")[0]);
													    $.ajax({

													      data: parametros,
													      url: "../ajax/contactos.php?op=subir_pedido",
													      type: "POST",
													      contentType: false,
													      processData: false,
													      beforesend: function(){

													      },
													      success: function(data, status){

													        data = JSON.parse(data);

													        //alert(data);
													        var idfiles = data.idfiles;

													        //alert(idfiles);

													        		$.post("../ajax/pedidos.php?op=guardar_pedido",{num_cliente:num_cliente,num_pedido:num_pedido,nombre:nombre,fecha_hora:fecha_hora},function(data, status)
																	{
																		data = JSON.parse(data);

																		var idpedidos = data.idpedidos;
																		

																			var idcontacto = $("#idcontacto").val();

																						$.post("../ajax/contactos.php?op=update_contacto",{idcontacto:idcontacto,idpedidos:idpedidos},function(data, status)
																						{
																							data = JSON.parse(data);


																									$.post("../ajax/contactos.php?op=update_file",{idpedidos:idpedidos,idfiles:idfiles},function(data, status)
																									{
																										data = JSON.parse(data);
																										
																														
																										
																										listar();
																										$("#no_cliente_p").val("");
																										$("#nombre_cliente_p").val("");
																										$("#email_cliente_p").val("");
																										$("#telefono_cliente_p").val("");
																										$("#num_pedido").val("");
																										$("#concepto_pedido").val("");



																										$("#myModal_pedido").modal('hide');
																										$("#myModal").modal('show');

																										bootbox.alert("Pedido solicitado exitosamente");
																															
																									});
																							
																											
																							
																						
																												
																						});
																		
																	});




														  }


													    });

											});



								}else{

									bootbox.alert("El numero de pedido ya existe");
								}
								
							});


						

							



					}else{

						bootbox.alert("El numero de cliente ya existe para: "+data.nombre);
					}
											
					
										
				});

			
				


		}
		if (marca==0 ) {


			var num_pedido = $("#num_pedido").val();


						$.post("../ajax/contactos.php?op=buscar_num_ped",{num_pedido:num_pedido},function(data, status)
						{
							data = JSON.parse(data);

							if (data==null) {


											var num_cliente = $("#no_cliente_p").val();
											var num_pedido = $("#num_pedido").val();
											var nombre = $("#concepto_pedido").val();

											var fecha=moment().format('YYYY-MM-DD');
											var hora=moment().format('HH:mm:ss');
											var fecha_hora=fecha+" "+hora;




												var parametros = new FormData($("#formulario-envia_pedido")[0]);
											    $.ajax({

											      data: parametros,
											      url: "../ajax/contactos.php?op=subir_pedido",
											      type: "POST",
											      contentType: false,
											      processData: false,
											      beforesend: function(){

											      },
											      success: function(data, status){

											        data = JSON.parse(data);


											        		//alert(data);
													        var idfiles = data.idfiles;

													        //alert(idfiles);



											        		$.post("../ajax/pedidos.php?op=guardar_pedido",{num_cliente:num_cliente,num_pedido:num_pedido,nombre:nombre,fecha_hora:fecha_hora},function(data, status)
															{
																data = JSON.parse(data);

																var idpedidos = data.idpedidos;
																

																	var idcontacto = $("#idcontacto").val();

																				$.post("../ajax/contactos.php?op=update_contacto",{idcontacto:idcontacto,idpedidos:idpedidos},function(data, status)
																				{
																					data = JSON.parse(data);


																							$.post("../ajax/contactos.php?op=update_file",{idpedidos:idpedidos,idfiles:idfiles},function(data, status)
																							{
																								data = JSON.parse(data);
																								
																												
																								
																								listar();
																								$("#no_cliente_p").val("");
																								$("#nombre_cliente_p").val("");
																								$("#email_cliente_p").val("");
																								$("#telefono_cliente_p").val("");
																								$("#num_pedido").val("");
																								$("#concepto_pedido").val("");



																								$("#myModal_pedido").modal('hide');
																								$("#myModal").modal('show');

																								bootbox.alert("Pedido solicitado exitosamente");
																													
																							});
																					
																									
																					
																				
																										
																				});
																
															});




												  }


											    });


											
										
															
									



							}else{

								bootbox.alert("El numero de pedido ya existe");
							}
							
						});


		}

			

	}else{
		bootbox.alert("Es necesario capturar todos los datos");
	}

			


						
}

function ver_pedido()
{
	var idpedido = $("#idpedido").val();

	$.post("../ajax/contactos.php?op=buscar_pedido",{idpedido:idpedido},function(data, status)
	{
		data = JSON.parse(data);
																		
		bootbox.alert("Numero de cliente: "+data.num_cliente+",<br>Numero de pedido: "+data.num_pedido+",<br>Concepto (Resumen): "+data.nombre+",<br>Fecha de pedido: "+data.fecha_hora);
	});
}



function valid_archivo()
{
	$("#valor_si").val("1");

	
}






init();