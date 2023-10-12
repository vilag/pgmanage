function init(){
	$("#nuevoregistro").hide();
	listar();
	select_cliente();
	$("#ver_arch").hide();

	var fecha=moment().format('YYYY-MM-DD');
	//var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha;
	$("#f_pedido").val(fecha_hora);
	//listarenvios()
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
					url: 'ajax/pedidose.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();

	//$("#avancesp").val("");
}

function abrir_newpedido()
{
	$("#nuevoregistro").show();
	$("#listadoregistros").hide();

	

	

}

function abrir_listado()
{
	$("#nuevoregistro").hide();
	$("#listadoregistros").show();
}

function select_cliente()
{

	$.post("ajax/pedidose.php?op=select_cliente", function(r){
	            $("#idcliente").html(r);
	            $('#idcliente').selectpicker('refresh');
	})
}


function subir_documento()
{

		var nom_arch = $("#ar_comprob").val();
	
		
		//alert(nom_arch);

		if (nom_arch!="") {

			
								var parametros = new FormData($("#formulario-envia_documento")[0]);
								$.ajax({

										data: parametros,
										url: "ajax/pedidose.php?op=guardar_documento",
										type: "POST",
										contentType: false,
										processData: false,
										beforesend: function(){

										},
										success: function(data, status){

												data = JSON.parse(data);
												
												//alert(data.idarch_temp);
												$("#v_comp").val(data.idfiles_ped_fab);
												$("#ver_arch").show();
												$("#btn_comprob").hide();
												$("#confirm_arch").text("Archivo cargado exitosamente");
										}

								});
			

								

		}else{
			bootbox.alert("No se cargado ningun archivo");
			
		}
								
}

function nuevo_cliente()
{
	$("#myModal_reg_cliente").modal("show");
}

function guardar_cliente()
{
		
		
		var nombre_new = $("#nombre_new").val();
		var rfc_new = $("#rfc_new").val();
		var telefono_new = $("#telefono_new").val();
		var calle_new = $("#calle_new").val();
		var numero_new = $("#numero_new").val();
		var interior_new = $("#interior_new").val();
		var colonia_new = $("#colonia_new").val();
		var municipio_new = $("#municipio_new").val();
		var estado_new = $("#estado_new").val();

		var email_new = $("#email_new").val();
		var referencia_new = $("#referencia_new").val();
		var fecha=moment().format('YYYY-MM-DD');
	    var hora=moment().format('HH:mm:ss');
	    var fecha_hora=fecha+" "+hora;

	    if (nombre_new!="") {

	    		$.post("ajax/pedidose.php?op=buscar_nom_cli",{nombre_new:nombre_new},function(data, status)
				{
					data = JSON.parse(data);

					//alert(data);
				
																												
					if (data==null) {

								
																																
									


											$.post("ajax/pedidose.php?op=guardar_cliente",{
												
												nombre_new:nombre_new,
												rfc_new:rfc_new,
												telefono_new:telefono_new,
												calle_new:calle_new,
												numero_new:numero_new,
												interior_new:interior_new,
												colonia_new:colonia_new,
												municipio_new:municipio_new,
												estado_new:estado_new,
												email_new:email_new,
												referencia_new:referencia_new,
												fecha_hora:fecha_hora

											},function(data, status)
											{
												data = JSON.parse(data);
												
												bootbox.alert("Cliente registrado exitosamente");
												//var idcliente = data.idclientes_fab;
												select_cliente();
												$("#myModal_reg_cliente").modal('hide');
												//$("#num_cliente_new").val("");
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
						bootbox.alert("El nombre del cliente ya existe");
					}																									
																														
				});

	    }else{
	    	bootbox.alert("El nombre del cliente es obligatorio");
	    }
							
}

function guardar_pedido()
{
	var idcliente = $("#idcliente").val();
	var f_pedido = $("#f_pedido").val();
	var f_est_entrega = $("#f_est_entrega").val();
	var lugar_entrega = $("#lugar_entrega").val();

	//alert(f_pedido);
	//alert(f_est_entrega);

				$.post("ajax/pedidose.php?op=guardar_pedido",{idcliente:idcliente,f_pedido:f_pedido,f_est_entrega:f_est_entrega,lugar_entrega:lugar_entrega},function(data, status)
				{
					data = JSON.parse(data);

					var idpedido = data.idctrl_ped_fab;
					$("#ctrl_ped").val(idpedido);
					$("#idpedido").val(idpedido);
					$("#ctrl_pedid_a").val(idpedido);
					$("#idctrl_p").text(idpedido);
					

					//var lugar_entrega = $("#lugar_entrega").val();
					$("#lugar_c").val(lugar_entrega);
					$("#fecha_c").val(f_est_entrega);


					
					bootbox.alert("Pedido aperturado, ahora puede agregar productos");
					
																													
				});
}


function guardar_producto()
{
	var ctrl_pedid_a = $("#ctrl_pedid_a").val();
	var no_pedid_a = $("#no_pedid_a").val();
	var ord_prod_a = $("#ord_prod_a").val();
	var clave_a = $("#clave_a").val();
	var nombre_a = $("#nombre_a").val();
	var cant_solic_a = $("#cant_solic_a").val();

	$.post("ajax/pedidose.php?op=guardar_producto",{ctrl_pedid_a:ctrl_pedid_a,no_pedid_a:no_pedid_a,ord_prod_a:ord_prod_a,clave_a:clave_a,nombre_a:nombre_a,cant_solic_a:cant_solic_a},function(data, status)
	{
		data = JSON.parse(data);
		listarprod();
		//alert("Producto agregado");
																													
	});
}

function listarprod()
{
	var ctrl_ped = $("#ctrl_ped").val();

	//alert(ctrl_ped);

	$.post("ajax/pedidose.php?op=listarprod&id="+ctrl_ped,function(r){
	        $("#tbllistado_prod").html(r);

	        
	});
}

function abrir_det_ped(idpedido_fab)
{
	$("#myModal_detped").modal("show");
	//alert(idpedido_fab);

	$.post("ajax/pedidose.php?op=abrir_det_ped",{idpedido_fab:idpedido_fab},function(data, status)
	{
		data = JSON.parse(data);
		
		//alert("Producto agregado");
		$("#control_ped").text(data.idctrl_ped_fab);
		$("#no_ped").val(data.no_pedido);
		$("#or_prod").val(data.op);
		$("#cve_prod").val(data.clave_prod);
		$("#produ").val(data.material);
		$("#cant_sol").val(data.cantidad_solic);
																													
	});

}

function listar_prod_select()
{
	  var ctrl_ped = $("#idctrl_p").text();

	 // alert(ctrl_ped);

	  $.post("ajax/pedidose.php?op=listar_prod_select",{ctrl_ped: ctrl_ped}, function(r){
	  $("#prod_reg").html(r);
	  $('#prod_reg').selectpicker('refresh');

	  });

	  
}

var cont=0;
var detalles=0;

function select_prod_add()
{
	var prod_select = $("#prod_reg").val();
	
	//alert(prod_select);

	$.post("ajax/pedidose.php?op=select_prod_add",{prod_select:prod_select},function(data, status)
	{
		data = JSON.parse(data);

		var idpedido_fab = data.idpedido_fab;
		var clave_prod = data.clave_prod;
		var material = data.material;
		var tipo_empaque = data.tipo_empaque;
		var cantidad_solic = data.cantidad_solic;
		var monto_entr_siniva = 0;
		var monto_entr_coniva = 0;
		var estatus = data.estatus;


		

		var fila='<tr class="filas" id="fila'+cont+'">'+
		'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+		    	
		'<td><input type="hidden" name="idpedido_fab[]" value="'+idpedido_fab+'"></td>'+
		'<td><input type="text" name="clave_prod[]" value="'+clave_prod+'"></td>'+
		'<td><input type="text" name="material[]" value="'+material+'"></td>'+
		'<td><input type="text" name="tipo_empaque[]" value="'+tipo_empaque+'"></td>'+
		'<td><input type="number" name="cantidad_solic[]" value="'+cantidad_solic+'"></td>'+
		'<td><input type="text" name="monto_entr_siniva[]" value="'+monto_entr_siniva+'"></td>'+
		'<td><input type="text" name="monto_entr_coniva[]" value="'+monto_entr_coniva+'"></td>'+
		
		
		'</tr>';
		cont++;
		detalles=detalles+1;
		$('#tbllistado_prod_select').append(fila);

		$("#num_prod").text("Tipos de producto: "+detalles);
		

	});
}

function guardar_envio()
{
	//"Me quede en guardar envio en tabla envio_fab y guardar los productos de envio en tabla detalle_envio y mostrarlos en la tabla de envios";

	var idctrl_ped_fab = $("#idctrl_p").text();
	//var idctrl_ped_fab = 10;
	var no_salida = $("#no_salid_env").val();
	var forma = $("#modo_env").val();
	var fecha_hora_salida = $("#fec_hr_env").val();
	var fecha_hora_entrega = $("#fec_hr_entr").val();
	var lugar_entrega = $("#lugar_entr_env").val();
	var fecha_hora_entrega_real = $("#lugar_entr_env_real").val();
	var entregado_a = $("#persona_recibe").val();


	$.post("ajax/pedidose.php?op=guardar_envio",{
		idctrl_ped_fab:idctrl_ped_fab,
		no_salida:no_salida,
		forma:forma,
		fecha_hora_salida:fecha_hora_salida,
		fecha_hora_entrega:fecha_hora_entrega,
		lugar_entrega:lugar_entrega,
		fecha_hora_entrega_real:fecha_hora_entrega_real,
		entregado_a:entregado_a
	},function(data, status)
	{
		data = JSON.parse(data);
		
		
			var id_envio_fab = data.idenvios_fab;



			var clave_prod = document.getElementsByName("clave_prod[]");
			//var id_envio_fab = 5;
			var idpedido_fab = document.getElementsByName("idpedido_fab[]");
			var clave_prod2 = document.getElementsByName("clave_prod[]");
			//var material = document.getElementsByName("material[]");
			var tipo_empaque = document.getElementsByName("tipo_empaque[]");
			var cantidad_solic = document.getElementsByName("cantidad_solic[]");
			var monto_entr_siniva = document.getElementsByName("monto_entr_siniva[]");
			var monto_entr_coniva = document.getElementsByName("monto_entr_coniva[]");
			var contador = 0;

		  	for (var i = 0; i <clave_prod.length; i++) {

		  		
		  		var idped_fab=idpedido_fab[i];
		  		var cve_prod=clave_prod2[i];
		  		//var mat=material[i];
		  		var tip_empaque=tipo_empaque[i];
		  		var cant_solic=cantidad_solic[i];
		  		var mont_entr_siniva=monto_entr_siniva[i];
		  		var mont_entr_coniva=monto_entr_coniva[i];

		  		//alert(idped_fab.value+","+cve_prod.value+","+mat.value+","+tip_empaque.value+","+cant_solic.value+","+mont_entr_siniva.value+","+mont_entr_coniva.value);
		  		var idped_fab2=idped_fab.value;
		  		var cve_prod2=cve_prod.value;
		  		//var mat2=mat.value;
		  		var tip_empaque2=tip_empaque.value;
		  		var cant_solic2=cant_solic.value;
		  		var mont_entr_siniva2=mont_entr_siniva.value;
		  		var mont_entr_coniva2=mont_entr_coniva.value;

		  		//alert(cant_solic2);

		  		$.post("ajax/pedidose.php?op=guardar_det_envio",{
					id_envio_fab:id_envio_fab,
					idped_fab2:idped_fab2,
					cve_prod2:cve_prod2,
					tip_empaque2:tip_empaque2,
					cant_solic2:cant_solic2,
					mont_entr_siniva2:mont_entr_siniva2,
					mont_entr_coniva2:mont_entr_coniva2
					
				},function(data, status)
				{
					data = JSON.parse(data);
					contador=contador+1;
					//alert(contador);

					if (contador==clave_prod.length) {
						$("#myModal_detenv").modal("hide");
						listarenvios();
						listarprod();
						bootbox.alert("Envío registrado exitosamente");
						

					}
																																
				});

			}																										
	});
}


function listarenvios()
{
	var ctrl_ped = $("#ctrl_ped").val();

	$.post("ajax/pedidose.php?op=listarenvios&id="+ctrl_ped,function(r){
	        $("#tbllistado_entregas").html(r);

	        
	});

}

function eliminarDetalle(cont)
{
	//alert(cont);
	$("#fila" + cont).remove();
  	//calcularTotales();
  	detalles=detalles-1;
}


init();