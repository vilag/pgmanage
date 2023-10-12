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
					url: '../ajax/clientes.php?op=listar',
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

function abrir_cliente_nuevo()
{
	$("#myModal").modal('show');
}

function guardar_cliente()
{
		
		var num_cliente_new = $("#num_cliente_new").val();
		var nombre_new = $("#nombre_new").val();
		var email_new = $("#email_new").val();
		var telefono_new = $("#telefono_new").val();
		var rfc_new = $("#rfc_new").val();
		var calle_new = $("#calle_new").val();
		var numero_new = $("#numero_new").val();
		var interior_new = $("#interior_new").val();
		var colonia_new = $("#colonia_new").val();
		var municipio_new = $("#municipio_new").val();
		var estado_new = $("#estado_new").val();
		var referencia_new = $("#referencia_new").val();
		var fecha=moment().format('YYYY-MM-DD');
	    var hora=moment().format('HH:mm:ss');
	    var fecha_hora=fecha+" "+hora;

	    /*alert("num_cliente_new: "+num_cliente_new);
	    alert("nombre_new: "+nombre_new);
	    alert("email_new: "+email_new);
	    alert("telefono_new: "+telefono_new);
	    alert("rfc_new: "+rfc_new);
	    alert("calle_new: "+calle_new);
	    alert("numero_new: "+numero_new);
	    alert("interior_new: "+interior_new);
	    alert("colonia_new: "+colonia_new);
	    alert("municipio_new: "+municipio_new);
	    alert("estado_new: "+estado_new);
	    alert("referencia_new: "+referencia_new);
	    alert("fecha_hora: "+fecha_hora);*/

	    $.post("../ajax/clientes.php?op=buscar_nom_cli",{nombre_new:nombre_new},function(data, status)
		{
			data = JSON.parse(data);

		
																										
			if (data==null) {

						var num_cliente = $("#num_cliente_new").val();

						$.post("../ajax/contactos.php?op=buscar_num_cli",{num_cliente:num_cliente},function(data, status)
						{
							data = JSON.parse(data);

							
																														
							if (data==null) {


									$.post("../ajax/clientes.php?op=guardar_cliente",{
										num_cliente_new:num_cliente_new,
										nombre_new:nombre_new,
										email_new:email_new,
										telefono_new:telefono_new,
										rfc_new:rfc_new,
										calle_new:calle_new,
										numero_new:numero_new,
										interior_new:interior_new,
										colonia_new:colonia_new,
										municipio_new:municipio_new,
										estado_new:estado_new,
										referencia_new:referencia_new,
										fecha_hora:fecha_hora

									},function(data, status)
									{
										data = JSON.parse(data);
										
										bootbox.alert("cliente registrado exitosamente");
										//$("#idcliente").val(data.idcliente);
										listar();
										$("#myModal").modal('hide');
										$("#num_cliente_new").val("");
										$("#nombre_new").val("");
										$("#email_new").val("");
										$("#telefono_new").val("");
										$("#rfc_new").val("");
										$("#calle_new").val("");
										$("#numero_new").val("");
										$("#interior_new").val("");
										$("#colonia_new").val("");
										$("#municipio_new").val("");
										$("#estado_new").val("");
										$("#referencia_new").val("");
									
									});



							}else{
								bootbox.alert("El numero de cliente ya existe");
							}																								
																																
						});

			}else{
				bootbox.alert("El nombre del cliente ya existe");
			}																									
																												
		});
																							


							
}

function consul_cliente(idcliente)
{
	

		$.post("../ajax/clientes.php?op=consul_cliente",{idcliente : idcliente},function(data, status)
		{
			data = JSON.parse(data);

			$("#num_cliente_consul").val(data.no_cliente);
			$("#nombre_consul").val(data.nombre);
			$("#email_consul").val(data.email);
			$("#telefono_consul").val(data.telefono);
			$("#rfc_consul").val(data.rfc);
			$("#calle_consul").val(data.calle);
			$("#numero_consul").val(data.numero);
			$("#interior_consul").val(data.interior);
			$("#colonia_consul").val(data.colonia);
			$("#municipio_consul").val(data.municipio);
			$("#estado_consul").val(data.estado);
			$("#referencia_consul").val(data.referencia);
			$("#reg_consul").val(data.fecha_reg);

				  var no_cliente = data.no_cliente;
				  //alert(no_cliente);

				  tabla=$('#tbllistado_seg_pedidos').dataTable(
				  {
				    "aProcessing": true,//Activamos el procesamiento del datatables
				      "aServerSide": true,//Paginación y filtrado realizados por el servidor
				      dom: 'Bfrtip',//Definimos los elementos del control de tabla
				      buttons: [              
				                'copyHtml5',
				                'excelHtml5',
				                'csvHtml5',
				                'pdf'
				            ],
				    "ajax":
				        {
				          url: '../ajax/clientes.php?op=listar_historico_pedidos',
				          data:{no_cliente: no_cliente},
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




				  tabla=$('#tbllistado_seg_ventas').dataTable(
				  {
				    "aProcessing": true,//Activamos el procesamiento del datatables
				      "aServerSide": true,//Paginación y filtrado realizados por el servidor
				      dom: 'Bfrtip',//Definimos los elementos del control de tabla
				      buttons: [              
				                'copyHtml5',
				                'excelHtml5',
				                'csvHtml5',
				                'pdf'
				            ],
				    "ajax":
				        {
				          url: '../ajax/clientes.php?op=listar_historico_ventas',
				          data:{no_cliente: no_cliente},
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


				  $("#myModal_cliente").modal("show");
		});
}




init();