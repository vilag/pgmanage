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
					url: '../ajax/pedidos.php?op=listar',
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

function abrir_ventana_pedido()
{
	$("#myModal_pedido").modal('show');
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
											var email = "";
											var telefono = "";

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

			
				


		
		

			

	}else{
		bootbox.alert("Es necesario capturar todos los datos");
	}

			


						
}







init();