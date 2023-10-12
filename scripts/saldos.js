function init()
{
	listar_saldos();
}

function listar_saldos()
{
	

		$.post("ajax/saldos.php?op=listar_saldos",function(r){
		        $("#box_pedidos").html(r);      
		});
	
		
}


function nuevo_pedido()
{
	
	limpiar_campos();
	limpiar_campos2();
	$("#modal_nuevo_pedido").modal("show");
	$("#marca_consulta").val("0");
	$("#btn_save").show();
	$("#row_productos").show();
	$("#row_entrega").hide();
	$("#row_facturacion").hide();
	$("#options_buscar").hide();
	$("#btn_prod").show();
	$("#enlace_saldos").hide();
	$("#titulo").text("NUEVO PEDIDO");

	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	$.post("ajax/saldos.php?op=nuevo_pedido",{fecha_hora:fecha_hora},function(data, status)
	{
	data = JSON.parse(data);

		var idsaldo = data.idsaldos;

		$("#idsaldos").val(data.idsaldos);

		//alert(idsaldo);
		listar_saldos_detalle_new();

	});
}


function nuevo_detalle_saldo()
{
	var idsaldos =  $("#idsaldos").val();
	//alert(idsaldos);
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	$.post("ajax/saldos.php?op=nuevo_detalle_saldo",{idsaldos:idsaldos,fecha_hora:fecha_hora},function(data, status)
	{
	data = JSON.parse(data);

			listar_saldos_detalle_new();
			listar_saldos();
	});
}

function listar_saldos_detalles(idsaldos)
{
		//var idsaldos =  $("#idsaldos").val();

		$.post("ajax/saldos.php?op=listar_saldos_detalles&id="+idsaldos,function(r){
		        $("#tbl_saldos_detalle"+idsaldos).html(r);      
		});
}


function listar_saldos_detalle_new()
{
		var idsaldos =  $("#idsaldos").val();

		$.post("ajax/saldos.php?op=listar_saldos_detalles2&id="+idsaldos,function(r){
		        $("#tbl_saldos_detalle_new").html(r);      
		});
}






function update_detalle_saldo(idsaldos_detalle)
{
	var detalle =  $("#detalle"+idsaldos_detalle).val();
	var cantidad =  $("#cantidad"+idsaldos_detalle).val();
	var precio =  $("#precio"+idsaldos_detalle).val();
	//var fecha_pedido =  $("#fecha_pedido"+idsaldos_detalle).val();

	$.post("ajax/saldos.php?op=update_detalle_saldo",{idsaldos_detalle:idsaldos_detalle,detalle:detalle,cantidad:cantidad,precio:precio},function(data, status)
	{
	data = JSON.parse(data);

		$("#label_detalle"+idsaldos_detalle).text(detalle);
		$("#label_cantidad"+idsaldos_detalle).text(cantidad);
		$("#label_precio"+idsaldos_detalle).text(precio);
		//$("#label_fecha_pedido"+idsaldos_detalle).text(fecha_pedido);
	});
}

function mostrar_input_detalle(idsaldos_detalle)
{
	document.getElementById("detalle"+idsaldos_detalle).style.display = "block";
	document.getElementById("label_detalle"+idsaldos_detalle).style.display = "none";
}

function ocultar_input_detalle(idsaldos_detalle)
{
	document.getElementById("detalle"+idsaldos_detalle).style.display = "none";
	document.getElementById("label_detalle"+idsaldos_detalle).style.display = "block";
}





function mostrar_input_cantidad(idsaldos_detalle)
{
	document.getElementById("cantidad"+idsaldos_detalle).style.display = "block";
	document.getElementById("label_cantidad"+idsaldos_detalle).style.display = "none";
}

function ocultar_input_cantidad(idsaldos_detalle)
{
	document.getElementById("cantidad"+idsaldos_detalle).style.display = "none";
	document.getElementById("label_cantidad"+idsaldos_detalle).style.display = "block";
}






function mostrar_input_precio(idsaldos_detalle)
{
	document.getElementById("precio"+idsaldos_detalle).style.display = "block";
	document.getElementById("label_precio"+idsaldos_detalle).style.display = "none";
}

function ocultar_input_precio(idsaldos_detalle)
{
	document.getElementById("precio"+idsaldos_detalle).style.display = "none";
	document.getElementById("label_precio"+idsaldos_detalle).style.display = "block";
}


function guardar_pedido()
{
	var idsaldos =  $("#idsaldos").val();
	var idpedido =  $("#idpedido").val();

	$.post("ajax/saldos.php?op=next_nopedido",function(data, status)
	{
	data = JSON.parse(data);

		var no_pedido_save = parseInt(data.num_ped)+1;


			$.post("ajax/saldos.php?op=guardar_pedido",{idsaldos:idsaldos,idpedido:idpedido,no_pedido_save:no_pedido_save},function(data, status)
			{
			data = JSON.parse(data);


					guardar_entrega();
					guardar_fact();
					listar_saldos();
					$("#modal_nuevo_pedido").modal("hide");


			});


	});



			
}

function abrir_mod_facturacion()
{

	$("#row_productos").hide();
	$("#row_entrega").hide();
	$("#row_facturacion").show();
	

	var marca_consulta = $("#marca_consulta").val();

	if (marca_consulta==1) {

		$("#buscar_dir_sal").hide();
		$("#buscar_dir_nocontrol").hide();
		$("#options_buscar").hide();


	}else{

		$("#buscar_dir_sal").show();
		$("#buscar_dir_nocontrol").show();
		$("#options_buscar").show();
		$("#buscar_dir_nocontrol").hide();
		$("#buscar_dir_sal").hide();
	}

	


}

function abrir_mod_entrega()
{

	$("#row_productos").hide();
	$("#row_entrega").show();
	$("#row_facturacion").hide();
	$("#result_dir").hide();
	$("#options_buscar").hide();

	
}

function ver_carga_prod()
{
	$("#row_productos").show();
	$("#row_entrega").hide();
	$("#row_facturacion").hide();
	$("#options_buscar").hide();

	
}


function capturar_nuevo()
{
		//$("#texto_buscar2").val("");

		$("#razon_f").val("");
		document.getElementById('razon_f').disabled = false;
		$("#idsaldo_fact").val("");

		$("#idpedido").val("");

		$("#rfc_f").val("");
		document.getElementById('rfc_f').disabled = false;
		$("#calle_f").val("");
		document.getElementById('calle_f').disabled = false;
		$("#numero_f").val("");
		document.getElementById('numero_f').disabled = false;
		$("#interior_f").val("");
		document.getElementById('interior_f').disabled = false;
		$("#colonia_f").val("");
		document.getElementById('colonia_f').disabled = false;
		$("#ciudad_f").val("");
		document.getElementById('ciudad_f').disabled = false;
		$("#estado_f").val("");
		document.getElementById('estado_f').disabled = false;
		$("#cp_f").val("");
		document.getElementById('cp_f').disabled = false;
		$("#email_f").val("");
		document.getElementById('email_f').disabled = false;
		$("#telefono_f").val("");
		document.getElementById('telefono_f').disabled = false;

		$("#contacto_s").val("");
		document.getElementById('contacto_s').disabled = false;
		$("#marcador").val("0");
		
		$("#idsaldo_entregas").val("");		
		$("#calle_s").val("");
		document.getElementById('calle_s').disabled = false;
		$("#numero_s").val("");
		document.getElementById('numero_s').disabled = false;
		$("#interior_s").val("");
		document.getElementById('interior_s').disabled = false;
		$("#colonia_s").val("");
		document.getElementById('colonia_s').disabled = false;
		$("#ciudad_s").val("");
		document.getElementById('ciudad_s').disabled = false;
		$("#estado_s").val("");
		document.getElementById('estado_s').disabled = false;
		$("#cp_s").val("");
		document.getElementById('cp_s').disabled = false;
		$("#email_s").val("");
		document.getElementById('email_s').disabled = false;
		$("#telefono_s").val("");
		document.getElementById('telefono_s').disabled = false;
		$("#fecha_entrega_s").val("");
		document.getElementById('fecha_entrega_s').disabled = false;
		$("#horario_entrega_s").val("");
		document.getElementById('horario_entrega_s').disabled = false;
		$("#horario_entrega_s2").val("");
		document.getElementById('horario_entrega_s2').disabled = false;
		$("#forma_entrega_s").val("");
		document.getElementById('forma_entrega_s').disabled = false;
		$("#det_form_entrega_s").val("");
		document.getElementById('det_form_entrega_s').disabled = false;
		$("#comentario_s").val("");
		document.getElementById('comentario_s').disabled = false;

		$("#buscar_dir_nocontrol").hide();
		$("#texto_buscar_nocontrol").hide();
		$("#result_dir3").hide();

		$("#buscar_dir_sal").hide();
		$("#texto_buscar2").hide();
		$("#result_dir2").hide();

		$("#etiqueta").text("");


}

function vincular_ped()
{

	$("#buscar_dir_nocontrol").show();
	$("#texto_buscar_nocontrol").show();
	$("#result_dir3").hide();

	$("#buscar_dir_sal").hide();
	$("#texto_buscar2").hide();
	$("#result_dir2").hide();
	
	

}

function buscar_razon()
{
	
	$("#buscar_dir_nocontrol").hide();
	$("#texto_buscar_nocontrol").hide();
	$("#result_dir3").hide();

	$("#buscar_dir_sal").show();
	$("#texto_buscar2").show();
	$("#result_dir2").hide();

}




function guardar_entrega()
{
	var marcador = $("#marcador").val();
	var idpedido =  $("#idpedido").val();

	//if (marcador==0) {

		/*$.post("ajax/saldos.php?op=consul_idpedido",{idpedido:idpedido},function(data, status)
		{
		data = JSON.parse(data);
			
			var num_ped = data.num_ped;*/

			


				var idsaldos =  $("#idsaldos").val();
				
				
				var contacto_s =  $("#contacto_s").val();
				var calle_s =  $("#calle_s").val();
				var numero_s =  $("#numero_s").val();
				var interior_s =  $("#interior_s").val();
				var colonia_s =  $("#colonia_s").val();
				var ciudad_s =  $("#ciudad_s").val();
				var estado_s =  $("#estado_s").val();
				var cp_s =  $("#cp_s").val();
				var email_s =  $("#email_s").val();
				var telefono_s =  $("#telefono_s").val();
				var fecha_entrega_s =  $("#fecha_entrega_s").val();
				var horario_entrega_s =  $("#horario_entrega_s").val(); 	
				var horario_entrega_s2 =  $("#horario_entrega_s2").val();
				var forma_entrega_s =  $("#forma_entrega_s").val();
				var det_form_entrega_s =  $("#det_form_entrega_s").val();
				var comentario_s =  $("#comentario_s").val();



				$.post("ajax/saldos.php?op=guardar_entrega",{
					idsaldos:idsaldos,
					idpedido:idpedido,
					contacto_s:contacto_s,
					calle_s:calle_s,
					numero_s:numero_s,
					interior_s:interior_s,
					colonia_s:colonia_s,
					ciudad_s:ciudad_s,
					estado_s:estado_s,
					cp_s:cp_s,
					email_s:email_s,
					telefono_s:telefono_s,
					fecha_entrega_s:fecha_entrega_s,
					horario_entrega_s:horario_entrega_s,
					horario_entrega_s2:horario_entrega_s2,
					forma_entrega_s:forma_entrega_s,
					det_form_entrega_s:det_form_entrega_s,
					comentario_s:comentario_s},function(data, status)
				{
				data = JSON.parse(data);

					bootbox.alert("Pedido guardado exitosamente");

				

					limpiar_campos();
						
					

				});



	
}

function guardar_fact()
{
	
	var marcador = $("#marcador").val();

		var idpedido =  $("#idpedido").val();
		var idsaldos =  $("#idsaldos").val();
		var razon_f =  $("#razon_f").val();
		var rfc_f =  $("#rfc_f").val();
		var calle_f =  $("#calle_f").val();
		var numero_f =  $("#numero_f").val();
		var interior_f =  $("#interior_f").val();
		var colonia_f =  $("#colonia_f").val();
		var ciudad_f =  $("#ciudad_f").val();
		var estado_f =  $("#estado_f").val();
		var cp_f =  $("#cp_f").val();
		var email_f =  $("#email_f").val();
		var telefono_f =  $("#telefono_f").val();
		
		$.post("ajax/saldos.php?op=guardar_fact",{
			idpedido:idpedido,
			idsaldos:idsaldos,
			razon_f:razon_f,
			rfc_f:rfc_f,
			calle_f:calle_f,
			numero_f:numero_f,
			interior_f:interior_f,
			colonia_f:colonia_f,
			ciudad_f:ciudad_f,
			estado_f:estado_f,
			cp_f:cp_f,
			email_f:email_f,
			telefono_f:telefono_f,
			marcador:marcador},function(data, status)
		{
		data = JSON.parse(data);

			limpiar_campos2();
			
		});


		
}



function mostrar_direcciones()
{
	$("#result_dir").show();

	var texto_buscar = $("#texto_buscar").val();

			$.post("ajax/saldos.php?op=mostrar_direcciones&id="+texto_buscar,function(r){
			$("#box_select_dir").html(r);

				//ver_id();
			});
}

function mostrar_facturacion()
{
	$("#result_dir2").show();

	var texto_buscar = $("#texto_buscar2").val();

			$.post("ajax/saldos.php?op=mostrar_facturacion&id="+texto_buscar,function(r){
			$("#box_select_dir2").html(r);

				//ver_id();
			});
}

function mostrar_control()
{
	$("#result_dir3").show();

	var texto_buscar = $("#texto_buscar_nocontrol").val();

			$.post("ajax/saldos.php?op=mostrar_control&id="+texto_buscar,function(r){
			$("#box_select_control").html(r);

				
			});
}


function select_direccion(idsaldo_entregas)
{
	limpiar_campos();
	//$("#marcador").val("1");
	var iddireccion =  idsaldo_entregas;

	$.post("ajax/saldos.php?op=select_dir_sal",{iddireccion:iddireccion},function(data, status)
	{
	data = JSON.parse(data);
		
		$("#contacto_s").val(data.contacto);
		$("#calle_s").val(data.calle);
		$("#numero_s").val(data.numero);
		$("#interior_s").val(data.interior);
		$("#colonia_s").val(data.colonia);
		$("#ciudad_s").val(data.ciudad);
		$("#estado_s").val(data.estado);
		$("#cp_s").val(data.cp);
		$("#email_s").val(data.email);
		$("#telefono_s").val(data.telefono);

	});
}

function select_facturacion(idsaldo_fact)
{
	limpiar_campos();
	limpiar_campos2();
	$("#marcador").val("1");
	var idsaldo_fact =  idsaldo_fact;

	$.post("ajax/saldos.php?op=select_dir_fact",{idsaldo_fact:idsaldo_fact},function(data, status)
	{
	data = JSON.parse(data);
		
		$("#idsaldo_fact").val(data.idsaldo_fact);

		$("#razon_f").val(data.razon);
		document.getElementById('razon_f').disabled = true;
		$("#rfc_f").val(data.rfc);
		document.getElementById('rfc_f').disabled = true;
		$("#calle_f").val(data.calle);
		document.getElementById('calle_f').disabled = true;
		$("#numero_f").val(data.numero);
		document.getElementById('numero_f').disabled = true;
		$("#interior_f").val(data.interior);
		document.getElementById('interior_f').disabled = true;
		$("#colonia_f").val(data.colonia);
		document.getElementById('colonia_f').disabled = true;
		$("#ciudad_f").val(data.ciudad);
		document.getElementById('ciudad_f').disabled = true;
		$("#estado_f").val(data.estado);
		document.getElementById('estado_f').disabled = true;
		$("#cp_f").val(data.cp);
		document.getElementById('cp_f').disabled = true;
		$("#email_f").val(data.email);
		document.getElementById('email_f').disabled = true;
		$("#telefono_f").val(data.telefono);
		document.getElementById('telefono_f').disabled = true;

		$("#idsaldo_entregas").val(data.idsaldo_entregas);
		$("#contacto_s").val(data.contacto_s);
		document.getElementById('contacto_s').disabled = true;
		$("#calle_s").val(data.calle_s);
		document.getElementById('calle_s').disabled = true;
		$("#numero_s").val(data.numero_s);
		document.getElementById('numero_s').disabled = true;
		$("#interior_s").val(data.interior_s);
		document.getElementById('interior_s').disabled = true;
		$("#colonia_s").val(data.colonia_s);
		document.getElementById('colonia_s').disabled = true;
		$("#ciudad_s").val(data.ciudad_s);
		document.getElementById('ciudad_s').disabled = true;
		$("#estado_s").val(data.estado_s);
		document.getElementById('estado_s').disabled = true;
		$("#cp_s").val(data.cp_s);
		document.getElementById('cp_s').disabled = true;
		$("#email_s").val(data.email_s);
		document.getElementById('email_s').disabled = false;
		$("#telefono_s").val(data.telefono_s);
		document.getElementById('telefono_s').disabled = false;
	

		$("#result_dir2").hide();
		$("#texto_buscar2").val(data.razon);

		$("#etiqueta").val("");

	});
}

function select_nocontrol(no_control)
{
	limpiar_campos();
	limpiar_campos2();
	$("#marcador").val("0");
	var no_control =  no_control;
	//$("#no_control").val(no_control);
	

	$.post("ajax/saldos.php?op=select_nocontrol",{no_control:no_control},function(data, status)
	{
	data = JSON.parse(data);
		
		$("#idpedido").val(data.idpg_pedidos);
		$("#idsaldo_fact").val("");
		$("#razon_f").val(data.razon_fac);
		document.getElementById('razon_f').disabled = true;
		$("#rfc_f").val(data.rfc_fac);
		document.getElementById('rfc_f').disabled = true;
		$("#calle_f").val(data.calle_fac);
		document.getElementById('calle_f').disabled = true;
		$("#numero_f").val(data.numero_fac);
		document.getElementById('numero_f').disabled = true;
		$("#interior_f").val(data.interior_fac);
		document.getElementById('interior_f').disabled = true;
		$("#colonia_f").val(data.colonia_fac);
		document.getElementById('colonia_f').disabled = true;
		$("#ciudad_f").val(data.ciudad_fac);
		document.getElementById('ciudad_f').disabled = true;
		$("#estado_f").val(data.estado_fac);
		document.getElementById('estado_f').disabled = true;
		$("#cp_f").val(data.cp_fac);
		document.getElementById('cp_f').disabled = true;
		$("#email_f").val(data.email_fac);
		document.getElementById('email_f').disabled = true;
		$("#telefono_f").val(data.telefono_fac);
		document.getElementById('telefono_f').disabled = true;

		$("#idsaldo_entregas").val("");
		$("#contacto_s").val(data.contacto_ent);
		document.getElementById('contacto_s').disabled = true;
		$("#calle_s").val(data.calle_ent);
		document.getElementById('calle_s').disabled = true;
		$("#numero_s").val(data.numero_ent);
		document.getElementById('numero_s').disabled = true;
		$("#interior_s").val(data.interior_ent);
		document.getElementById('interior_s').disabled = true;
		$("#colonia_s").val(data.colonia_ent);
		document.getElementById('colonia_s').disabled = true;
		$("#ciudad_s").val(data.ciudad_ent);
		document.getElementById('ciudad_s').disabled = true;
		$("#estado_s").val(data.estado_ent);
		document.getElementById('estado_s').disabled = true;
		$("#cp_s").val(data.cp_ent);
		document.getElementById('cp_s').disabled = true;
		$("#email_s").val(data.email_ent);
		document.getElementById('email_s').disabled = true;
		$("#telefono_s").val(data.telefono_ent);
		document.getElementById('telefono_s').disabled = true;

		$("#result_dir3").hide();
		$("#texto_buscar_nocontrol").val(no_control);
		$("#etiqueta").text("Vinculado con No. Control: "+no_control);

	});
}

	

function abrir_detalles(idsaldos)
{
	
	$("#idsaldos").val(idsaldos);
	$("#modal_nuevo_pedido").modal("show");
	$("#marca_consulta").val("1");
	$("#btn_save").hide();
	$("#enlace_saldos").show();
	limpiar_campos();
	limpiar_campos2();

	$("#titulo_modal").show();
	$("#row_productos").hide();
	$("#row_entrega").hide();
	$("#row_facturacion").show();
	$("#options_buscar").hide();
	//$("#btn_save").hide();
	$("#no_pedido").show();
	$("#titulo").text("DETALLE DE PEDIDO");
	

	$("#btn_prod").hide();
	$("#btn_dir_fac").show();
	$("#btn_dir_ent").show();

	//alert(idsaldos);

	$.post("ajax/saldos.php?op=consul_det_pedsal",{idsaldos:idsaldos},function(data, status)
	{
	data = JSON.parse(data);
		
		

		$("#idsaldo_fact").val(data.idsaldo_fact);

		$("#razon_f").val(data.razon);
		document.getElementById('razon_f').disabled = true;
		$("#rfc_f").val(data.rfc);
		document.getElementById('rfc_f').disabled = true;
		$("#calle_f").val(data.calle);
		document.getElementById('calle_f').disabled = true;
		$("#numero_f").val(data.numero);
		document.getElementById('numero_f').disabled = true;
		$("#interior_f").val(data.interior);
		document.getElementById('interior_f').disabled = true;
		$("#colonia_f").val(data.colonia);
		document.getElementById('colonia_f').disabled = true;
		$("#ciudad_f").val(data.ciudad);
		document.getElementById('ciudad_f').disabled = true;
		$("#estado_f").val(data.estado);
		document.getElementById('estado_f').disabled = true;
		$("#cp_f").val(data.cp);
		document.getElementById('cp_f').disabled = true;
		$("#email_f").val(data.email);
		document.getElementById('email_f').disabled = true;
		$("#telefono_f").val(data.telefono);
		document.getElementById('telefono_f').disabled = true;

		$("#idsaldo_entregas").val(data.idsaldo_entregas);
		$("#contacto_s").val(data.contacto_s);
		document.getElementById('contacto_s').disabled = true;
		$("#calle_s").val(data.calle_s);
		document.getElementById('calle_s').disabled = true;
		$("#numero_s").val(data.numero_s);
		document.getElementById('numero_s').disabled = true;
		$("#interior_s").val(data.interior_s);
		document.getElementById('interior_s').disabled = true;
		$("#colonia_s").val(data.colonia_s);
		document.getElementById('colonia_s').disabled = true;
		$("#ciudad_s").val(data.ciudad_s);
		document.getElementById('ciudad_s').disabled = true;
		$("#estado_s").val(data.estado_s);
		document.getElementById('estado_s').disabled = true;
		$("#cp_s").val(data.cp_s);
		document.getElementById('cp_s').disabled = true;
		$("#email_s").val(data.email_s);
		document.getElementById('email_s').disabled = true;
		$("#telefono_s").val(data.telefono_s);
		document.getElementById('telefono_s').disabled = true;

		$("#fecha_entrega_s").val(data.fecha_entrega);
		document.getElementById('fecha_entrega_s').disabled = true;
		$("#horario_entrega_s").val(data.hora_entrega1);
		document.getElementById('horario_entrega_s').disabled = true;
		$("#horario_entrega_s2").val(data.hora_entrega2);
		document.getElementById('horario_entrega_s2').disabled = true;
		$("#forma_entrega_s").val(data.forma_entrega);
		document.getElementById('forma_entrega_s').disabled = true;
		$("#det_form_entrega_s").val(data.detalle_forma);
		document.getElementById('det_form_entrega_s').disabled = true;
		$("#comentario_s").val(data.comentario_entrega);
		document.getElementById('comentario_s').disabled = true;
	
		var no_control = data.no_control;

		if (no_control>0) {

			$("#etiqueta").text("Vinculado con No. Control: "+no_control);
		}else{
			$("#etiqueta").text("");
		}

		$("#no_pedido").text("No. Pedido: "+data.no_pedido);
		/*$("#result_dir2").hide();
		$("#texto_buscar2").val(data.razon);

		$("#etiqueta").val("");*/




	});

}



function limpiar_campos()
{
		$("#idsaldo_entregas").val("");
		$("#contacto_s").val("");
		$("#calle_s").val("");
		$("#numero_s").val("");
		$("#interior_s").val("");
		$("#colonia_s").val("");
		$("#ciudad_s").val("");
		$("#estado_s").val("");
		$("#cp_s").val("");
		$("#email_s").val("");
		$("#telefono_s").val("");

		$("#fecha_entrega_s").val("");
		$("#horario_entrega_s").val("");
		$("#horario_entrega_s2").val("");
		$("#forma_entrega_s").val("");
		$("#det_form_entrega_s").val("");
		$("#comentario_s").val("");
}

function limpiar_campos2()
{
		$("#idsaldo_fact").val("");
		$("#idpedido").val("");
		$("#razon_f").val("");
		$("#rfc_f").val("");
		$("#calle_f").val("");
		$("#numero_f").val("");
		$("#interior_f").val("");
		$("#colonia_f").val("");
		$("#ciudad_f").val("");
		$("#estado_f").val("");
		$("#cp_f").val("");
		$("#email_f").val("");
		$("#telefono_f").val("");

		$("#texto_buscar_nocontrol").val("");
		//$("#no_control").val("");
		$("#texto_buscar2").val("");
		$("#etiqueta").text("");

}


function imprimir_pedsal()// para reporte
{
	
  	var idsaldos = $("#idsaldos").val();
  	//alert(id_ped_temp);
  	$("#enlace_saldos").attr("href","reportes/docSaldos.php?id="+idsaldos);
}

init();