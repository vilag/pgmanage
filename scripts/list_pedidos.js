var idusuario=$("#idusuario").text();
var estatus_tabla = 1;
var lugar = $("#lugar_user").text();
var offset = 0;
function init()
{
	
	document.getElementById("btn_paginado").style.display="block";
	document.getElementById("btn_paginado2").style.display="block";
	$("#li_buscar_control").show();
	$("#li_buscar_btns2").show();	
	$("#li_buscar_btns").hide();
	$("#li_buscar_nombre").hide();
	$("#li_buscar_fecha").hide();
	

	//$("#btn_num_pedidos").hide();
	//$("#input_buscar").hide();

	//var estatus_tabla = 1;
	$("#estatus_pedido").val("1");
	//alert(estatus_tabla);
	var idusuario=$("#idusuario").text();

	//alert(idusuario);

	/*$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

		var lugar = data.lugar;*/
		var lugar = $("#lugar_user").text();
		//alert(lugar);

		if (lugar=='Fabrica') {
			$("#btn_sin_revisar").show();
			$("#btn_vencidos").show();			

		}else{
			$("#btn_sin_revisar").hide();
			$("#btn_vencidos").hide();
			
		}
		//alert(lugar);

		$.post("ajax/list_pedidos.php?op=listar_pedidos_ini&estatus="+estatus_tabla+"&idusuario="+idusuario+"&lugar="+lugar+"&offset="+offset,function(r){
			$("#div_lista_pedidos").html(r);

			var estatus = estatus_tabla;

			$.post("ajax/list_pedidos.php?op=contar_pedidos",{lugar:lugar,estatus:estatus},function(data, status)
			{
			data = JSON.parse(data);

				buscar_pedido_ini();
				//contar_prod_sinrev();
				cargar_notif();
				//cont_num_vencidos();

			});
			
			
		});
		

	//});


		
}

var conteo_pp = 1;
function siguiente_bloque(){
	document.getElementById("btn_sig_paginado").disabled = true;
	document.getElementById("btn_sig_paginado2").disabled = true;
	// var idusuario=$("#idusuario").text();
	offset = offset + 20;
	conteo_pp++;
	$("#num_pagina").text(conteo_pp);
	$("#num_pagina2").text(conteo_pp);

	$.post("ajax/list_pedidos.php?op=listar_pedidos_ini&estatus="+estatus_tabla+"&idusuario="+idusuario+"&lugar="+lugar+"&offset="+offset,function(r){
		$("#div_lista_pedidos").html(r);

		var estatus = estatus_tabla;

		$.post("ajax/list_pedidos.php?op=contar_pedidos",{lugar:lugar,estatus:estatus},function(data, status)
		{
		data = JSON.parse(data);

			

			const element = document.getElementById("div_lista_pedidos");
			element.scrollTo(0, 0);

			document.getElementById("btn_sig_paginado").disabled = false;
			document.getElementById("btn_sig_paginado2").disabled = false;

		});
		
		
	});

}

function anterior_bloque(){
	
	// var idusuario=$("#idusuario").text();
	//alert(offset);
	if (offset>0) {
		document.getElementById("btn_ant_paginado").disabled = true;
		document.getElementById("btn_ant_paginado2").disabled = true;
		offset = offset - 20;
		
		conteo_pp--;
		
		
		$("#num_pagina").text(conteo_pp);
		$("#num_pagina2").text(conteo_pp);

		$.post("ajax/list_pedidos.php?op=listar_pedidos_ini&estatus="+estatus_tabla+"&idusuario="+idusuario+"&lugar="+lugar+"&offset="+offset,function(r){
			$("#div_lista_pedidos").html(r);

			var estatus = estatus_tabla;

			$.post("ajax/list_pedidos.php?op=contar_pedidos",{lugar:lugar,estatus:estatus},function(data, status)
			{
			data = JSON.parse(data);

				

				const element = document.getElementById("div_lista_pedidos");
				element.scrollTo(0, 0);

				document.getElementById("btn_ant_paginado").disabled = false;
				document.getElementById("btn_ant_paginado2").disabled = false;

			});
			
			
		});
	}

}

function selec_tipo_busqueda()
{

	var selec_busqueda = $("#selec_busqueda").val();

	if (selec_busqueda==1) {

		document.getElementById("btn_paginado").style.display="block";
		document.getElementById("btn_paginado2").style.display="block";

		$("#li_buscar_control").show();
		$("#li_buscar_btns2").show();	
		$("#li_buscar_btns").hide();
		$("#li_buscar_nombre").hide();
		$("#li_buscar_fecha").hide();
		

	}

	if (selec_busqueda==2) {

		document.getElementById("btn_paginado").style.display="none";
		document.getElementById("btn_paginado2").style.display="none";

		$("#li_buscar_control").hide();
		$("#li_buscar_btns2").hide();	
		$("#li_buscar_btns").show();
		$("#li_buscar_nombre").show();
		$("#li_buscar_fecha").hide();
		
	}

	if (selec_busqueda==3) {

		document.getElementById("btn_paginado").style.display="none";
		document.getElementById("btn_paginado2").style.display="none";

		$("#li_buscar_control").hide();
		$("#li_buscar_btns2").hide();	
		$("#li_buscar_btns").show();
		$("#li_buscar_nombre").hide();
		$("#li_buscar_fecha").show();
		
	}
	
}

function habilitar_upd_fac()
{
	var idusuario = $("#idusuario").text();

	if (idusuario==1) {
		var check_fac = document.getElementById("check_update_fact").checked;

		if (check_fac==true) {

			document.getElementById('razon_fac_rep').disabled = false;
			document.getElementById('rfc_fac_rep').disabled = false;
			document.getElementById('calledev_fac_rep').disabled = false;
			document.getElementById('numerodev_fac_rep').disabled = false;
			document.getElementById('intdev_fac_rep').disabled = false;
			document.getElementById('coloniadev_fac_rep').disabled = false;
			document.getElementById('ciudaddev_fac_rep').disabled = false;
			document.getElementById('estadodev_fac_rep').disabled = false;
			document.getElementById('cpdev_fac_rep').disabled = false;
			document.getElementById('telefono_rep').disabled = false;
			document.getElementById('correo_rep').disabled = false;
			document.getElementById('btn_update_fact').disabled = false;

		}else{

			document.getElementById('razon_fac_rep').disabled = true;
			document.getElementById('rfc_fac_rep').disabled = true;
			document.getElementById('calledev_fac_rep').disabled = true;
			document.getElementById('numerodev_fac_rep').disabled = true;
			document.getElementById('intdev_fac_rep').disabled = true;
			document.getElementById('coloniadev_fac_rep').disabled = true;
			document.getElementById('ciudaddev_fac_rep').disabled = true;
			document.getElementById('estadodev_fac_rep').disabled = true;
			document.getElementById('cpdev_fac_rep').disabled = true;
			document.getElementById('telefono_rep').disabled = true;
			document.getElementById('correo_rep').disabled = true;
			document.getElementById('btn_update_fact').disabled = true;
		}
	}
		

	

}

function habilitar_upd_ent()
{
	var idusuario = $("#idusuario").text();

	if (idusuario==1) {

		var check_ent = document.getElementById("check_update_ent").checked;

		if (check_ent==true) {

			document.getElementById('contacto_rep').disabled = false;
			document.getElementById('calledev_fac_rep2').disabled = false;
			document.getElementById('numerodev_fac_rep2').disabled = false;
			document.getElementById('intdev_fac_rep2').disabled = false;
			document.getElementById('coloniadev_fac_rep2').disabled = false;
			document.getElementById('ciudaddev_fac_rep2').disabled = false;
			document.getElementById('estadodev_fac_rep2').disabled = false;
			document.getElementById('cpdev_fac_rep2').disabled = false;
			document.getElementById('telefono_ent').disabled = false;
			document.getElementById('correo_ent').disabled = false;

			document.getElementById('fecha_ent').disabled = false;
			document.getElementById('fecha_entrega').disabled = false;
			document.getElementById('fecha_ent_cliente').disabled = false;
			document.getElementById('horario_ent1').disabled = false;
			document.getElementById('horario_ent2').disabled = false;
			document.getElementById('forma_ent').disabled = false;
			document.getElementById('detalles_ent').disabled = false;
			document.getElementById('referencia_ent').disabled = false;
			document.getElementById('empaque_ent').disabled = false;
			document.getElementById('btn_update_ent').disabled = false;

		}else{

			document.getElementById('contacto_rep').disabled = true;
			document.getElementById('calledev_fac_rep2').disabled = true;
			document.getElementById('numerodev_fac_rep2').disabled = true;
			document.getElementById('intdev_fac_rep2').disabled = true;
			document.getElementById('coloniadev_fac_rep2').disabled = true;
			document.getElementById('ciudaddev_fac_rep2').disabled = true;
			document.getElementById('estadodev_fac_rep2').disabled = true;
			document.getElementById('cpdev_fac_rep2').disabled = true;
			document.getElementById('telefono_ent').disabled = true;
			document.getElementById('correo_ent').disabled = true;

			document.getElementById('fecha_ent').disabled = true;
			document.getElementById('fecha_entrega').disabled = true;
			document.getElementById('fecha_ent_cliente').disabled = true;
			document.getElementById('horario_ent1').disabled = true;
			document.getElementById('horario_ent2').disabled = true;
			document.getElementById('forma_ent').disabled = true;
			document.getElementById('detalles_ent').disabled = true;
			document.getElementById('referencia_ent').disabled = true;
			document.getElementById('empaque_ent').disabled = true;
			document.getElementById('btn_update_ent').disabled = true;

		}
	}

		
}

function refresh_campos()
{

	document.getElementById('razon_fac_rep').disabled = true;
	document.getElementById('rfc_fac_rep').disabled = true;
	document.getElementById('calledev_fac_rep').disabled = true;
	document.getElementById('numerodev_fac_rep').disabled = true;
	document.getElementById('intdev_fac_rep').disabled = true;
	document.getElementById('coloniadev_fac_rep').disabled = true;
	document.getElementById('ciudaddev_fac_rep').disabled = true;
	document.getElementById('estadodev_fac_rep').disabled = true;
	document.getElementById('cpdev_fac_rep').disabled = true;
	document.getElementById('telefono_rep').disabled = true;
	document.getElementById('correo_rep').disabled = true;

	document.getElementById('contacto_rep').disabled = true;
	document.getElementById('calledev_fac_rep2').disabled = true;
	document.getElementById('numerodev_fac_rep2').disabled = true;
	document.getElementById('intdev_fac_rep2').disabled = true;
	document.getElementById('coloniadev_fac_rep2').disabled = true;
	document.getElementById('ciudaddev_fac_rep2').disabled = true;
	document.getElementById('estadodev_fac_rep2').disabled = true;
	document.getElementById('cpdev_fac_rep2').disabled = true;
	document.getElementById('telefono_ent').disabled = true;
	document.getElementById('correo_ent').disabled = true;

	document.getElementById('fecha_ent').disabled = true;
	document.getElementById('fecha_entrega').disabled = true;
	document.getElementById('fecha_ent_cliente').disabled = true;
	document.getElementById('horario_ent1').disabled = true;
	document.getElementById('horario_ent2').disabled = true;
	document.getElementById('forma_ent').disabled = true;
	document.getElementById('detalles_ent').disabled = true;
	document.getElementById('referencia_ent').disabled = true;
	document.getElementById('empaque_ent').disabled = true;

	document.getElementById('btn_update_ent').disabled = true;
	document.getElementById('btn_update_fact').disabled = true;

				$("#razon_fac_rep").val("");
				$("#rfc_fac_rep").val("");
				$("#calledev_fac_rep").val("");
				$("#numerodev_fac_rep").val("");
				$("#intdev_fac_rep").val("");
				$("#coloniadev_fac_rep").val("");
				$("#ciudaddev_fac_rep").val("");
				$("#estadodev_fac_rep").val("");
				$("#cpdev_fac_rep").val("");
				$("#telefono_rep").val("");
				$("#correo_rep").val("");

				$("#contacto_rep").val("");
				$("#calledev_fac_rep2").val("");
				$("#numerodev_fac_rep2").val("");
				$("#intdev_fac_rep2").val("");
				$("#coloniadev_fac_rep2").val("");
				$("#ciudaddev_fac_rep2").val("");
				$("#estadodev_fac_rep2").val("");
				$("#cpdev_fac_rep2").val("");
				$("#telefono_ent").val("");
				$("#correo_ent").val("");

				$("#fecha_ent").val("");
				$("#fecha_entrega").val("");
				$("#fecha_ent_cliente").val("");
				$("#horario_ent1").val("");
				$("#horario_ent2").val("");
				$("#forma_ent").val("");
				$("#detalles_ent").val("");
				$("#referencia_ent").val("");
				$("#empaque_ent").val("");

}

function actualizar_datos_facturacion()
{
	var razon_fac_rep = $("#razon_fac_rep").val();
	var rfc_fac_rep = $("#rfc_fac_rep").val();
	var calledev_fac_rep = 	$("#calledev_fac_rep").val();
	var numerodev_fac_rep = $("#numerodev_fac_rep").val();
	var intdev_fac_rep = $("#intdev_fac_rep").val();
	var coloniadev_fac_rep = $("#coloniadev_fac_rep").val();
	var ciudaddev_fac_rep = $("#ciudaddev_fac_rep").val();
	var estadodev_fac_rep =	$("#estadodev_fac_rep").val();
	var cpdev_fac_rep =	$("#cpdev_fac_rep").val();
	var telefono_rep = $("#telefono_rep").val();
	var correo_rep = $("#correo_rep").val();
}

function buscar_pedido_ini()
{
	//alert(idpg_pedidos);
	//alert("entra");
	refresh_campos();
	var idusuario=$("#idusuario").text();
	var estatus=$("#estatus_pedido").val();

	//alert(idusuario);

	$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

		var lugar = data.lugar;

		//alert(lugar);
		//alert(estatus);

		$.post("ajax/list_pedidos.php?op=buscar_pedido_ini",{lugar:lugar,estatus:estatus},function(data, status)
			{
			data = JSON.parse(data);

			var idpg_pedidos = data.idpg_pedidos;
			//alert(idpg_pedidos);

			var idpedido2 = $("#idpedido2").text();

			//alert(idpedido2);

			if (idpedido2>0) {
				//alert("opt1");
				$("#idpedido").val(idpedido2);
				$("#idpedido_header").val(idpedido2);
				var idpg_pedidos = idpedido2;
			}else{
				//alert("opt2");
				$("#idpedido").val(idpg_pedidos);
				$("#idpedido_header").val(idpg_pedidos);
			}
			//alert(idpg_pedidos);
			

			$.post("ajax/list_pedidos.php?op=buscar_pedido",{idpg_pedidos:idpg_pedidos},function(data, status)
			{
			data = JSON.parse(data);

				var nom_cliente = data.nom_cliente;
				//alert(nom_cliente);
				$("#coment_ped_motivo").val(data.coment_vencim);
				$("#porc_av_p").val(data.porc_av);
				$("#btn_estatus_ped").text(data.estatus);
				$("#cliente").text(nom_cliente);
				//alert(data.tipo);
				if (data.tipo==1) {
					var tipo = "Pedido comercial";
				}
				if (data.tipo==2) {
					var tipo = "PEDIDO DE LICITACIÓN";
				}
				if (data.tipo==3) {
					var tipo = "PEDIDO DE MUESTRA";
				}
				if (data.tipo==4) {
					var tipo = "PEDIDO PARA EXISTENCIAS";
				}
				if (data.tipo==0) {
					var tipo = "";
				}

				$("#detalles_form_entre_ini").text(data.det_forma_entrega);
				$("#observ_ini").text(data.observaciones);
				$("#observ").val(data.observaciones);
				$("#asesor").text(data.asesor);
				$("#levanto").text(data.levanto_pedido);
				$("#autorizacion").text(data.autorizacion);
				$("#lab").text(data.lab);
				$("#medio").text(data.medio);
				$("#met_pago").text(data.metodo_pago);
				$("#uso_cfdi").text(data.uso_cfdi);
				$("#requisitos_pago").text(data.reglamentos);
				$("#salida").text(data.salida);
				$("#factura").text(data.factura);
				$("#otros").text(data.otros);

				$("#tipo_pedido").text(tipo);
				$("#lugar").text(data.lugar);
				$("#no_control").text(data.no_control);
				$("#no_pedido").text(data.no_pedido);
				$("#fecha").text(data.fecha_pedido);

				$("#razon_fac_rep").val(data.razon_fac);
				$("#rfc_fac_rep").val(data.rfc_fac);
				if (data.interior_fac!="") {
					var interior_fac = data.interior_fac;
				}else{
					var interior_fac = "";
				}

				if (data.colonia_fac!="") {
					var colonia_fac = data.colonia_fac;
				}else{
					var colonia_fac = "";
				}

				if (data.cp_fac!="") {
					var cp_fac = data.cp_fac;
				}else{
					var cp_fac = "";
				}

				//$("#dom_fac_rep").val(data.calle_fac+" "+data.numero_fac+" "+interior_fac+" "+colonia_fac+", "+data.ciudad_fac+" "+data.estado_fac+" "+cp_fac);
				
				$("#calledev_fac_rep").val(data.calle_fac);
				$("#numerodev_fac_rep").val(data.numero_fac);
				$("#intdev_fac_rep").val(interior_fac);
				$("#coloniadev_fac_rep").val(colonia_fac);
				$("#ciudaddev_fac_rep").val(data.ciudad_fac);
				$("#estadodev_fac_rep").val(data.estado_fac);
				$("#cpdev_fac_rep").val(cp_fac);
				
				
				
				$("#telefono_rep").val(data.telefono_fac);
				$("#correo_rep").val(data.email_fac);
				//alert(data.contacto_ent);

				$("#contacto_rep").val(data.contacto_ent);

				if (data.interior_ent!="") {
					var interior_ent = data.interior_ent;
				}else{
					var interior_ent = "";
				}

				if (data.colonia_ent!="") {
					var colonia_ent = data.colonia_ent;
				}else{
					var colonia_ent = "";
				}

				if (data.cp_ent!="") {
					var cp_ent = data.cp_ent;
				}else{
					var cp_ent = "";
				}
				//$("#dom_ent").val(data.calle_ent+" "+data.numero_ent+" "+interior_ent+" "+colonia_ent+", "+data.ciudad_ent+" "+data.estado_ent+" "+cp_ent);
				
				$("#calledev_fac_rep2").val(data.calle_ent);
				$("#numerodev_fac_rep2").val(data.numero_ent);
				$("#intdev_fac_rep2").val(interior_ent);
				$("#coloniadev_fac_rep2").val(colonia_ent);
				$("#ciudaddev_fac_rep2").val(data.ciudad_ent);
				$("#estadodev_fac_rep2").val(data.estado_ent);
				$("#cpdev_fac_rep2").val(cp_ent);
				
				
				
				
				$("#telefono_ent").val(data.telefono_ent);
				$("#correo_ent").val(data.email_ent);
				$("#fecha_ent").val(data.fecha_entrega_ent);
				//alert(data.fecha_entrega_ent);
				
				$("#fecha_entrega").text(data.fecha_entrega_ent);
				$("#fecha_ent_cliente").text(data.fecha_ent_cliente);
				$("#horario_ent1").val(data.hora_entrega_r1);
				$("#horario_ent2").val(data.hora_entrega_r2);
				$("#forma_ent").val(data.forma_entrega_ent);
				$("#detalles_ent").val(data.det_forma_entrega);
				$("#referencia_ent").val(data.referencia_ent);
				$("#empaque_ent").val(data.empaque);

				$.post("ajax/list_pedidos.php?op=listar_documentos&id="+idpg_pedidos,function(r){
				$("#box_documentos").html(r);

					$.post("ajax/list_pedidos.php?op=listar_pedido_detalle_term&id="+idpg_pedidos,function(r){
					$("#tbl_detalle_productos").html(r);

						
							        
					});
				       
				});

			});

		});


	});		
	
}

function guardar_datos_facturacion()
{
	var idpedido=$("#idpedido").val();
	var razon_fac = $("#razon_fac_rep").val();
	var rfc_fac = $("#rfc_fac_rep").val();
	var calle_fac = $("#calledev_fac_rep").val();
	var numero_fac = $("#numerodev_fac_rep").val();
	var interior_fac = $("#intdev_fac_rep").val();
	var colonia_fac = $("#coloniadev_fac_rep").val();
	var ciudad_fac = $("#ciudaddev_fac_rep").val();
	var estado_fac = $("#estadodev_fac_rep").val();
	var cp_fac = $("#cpdev_fac_rep").val();			
	var telefono_fac = $("#telefono_rep").val();
	var email_fac = $("#correo_rep").val();

		$.post("ajax/list_pedidos.php?op=guardar_datos_facturacion",{
			idpedido:idpedido,
			razon_fac:razon_fac,
			rfc_fac:rfc_fac,
			calle_fac:calle_fac,
			numero_fac:numero_fac,
			interior_fac:interior_fac,
			colonia_fac:colonia_fac,
			ciudad_fac:ciudad_fac,
			estado_fac:estado_fac,
			cp_fac:cp_fac,
			telefono_fac:telefono_fac,
			email_fac:email_fac
		},function(data, status)
		{
		data = JSON.parse(data);

			bootbox.alert("Datos actualizados correctamente");

			document.getElementById("check_update_fact").checked = false;
			document.getElementById('razon_fac_rep').disabled = true;
			document.getElementById('rfc_fac_rep').disabled = true;
			document.getElementById('calledev_fac_rep').disabled = true;
			document.getElementById('numerodev_fac_rep').disabled = true;
			document.getElementById('intdev_fac_rep').disabled = true;
			document.getElementById('coloniadev_fac_rep').disabled = true;
			document.getElementById('ciudaddev_fac_rep').disabled = true;
			document.getElementById('estadodev_fac_rep').disabled = true;
			document.getElementById('cpdev_fac_rep').disabled = true;
			document.getElementById('telefono_rep').disabled = true;
			document.getElementById('correo_rep').disabled = true;
			document.getElementById('btn_update_fact').disabled = true;

		});	
	
				
}

function guardar_datos_entrega()
{
	var idpedido=$("#idpedido").val();
	var contacto_ent = $("#contacto_rep").val();
	var calle_ent = $("#calledev_fac_rep2").val();
	var numero_ent = $("#numerodev_fac_rep2").val();
	var interior_ent = $("#intdev_fac_rep2").val();
	var colonia_ent = $("#coloniadev_fac_rep2").val();
	var ciudad_ent = $("#ciudaddev_fac_rep2").val();
	var estado_ent = $("#estadodev_fac_rep2").val();
	var cp_ent = $("#cpdev_fac_rep2").val();
	var telefono_ent = $("#telefono_ent").val();
	var email_ent = $("#correo_ent").val();
	var fecha_entrega_ent = $("#fecha_ent").val();
	var hora_entrega_r1 = $("#horario_ent1").val();
	var hora_entrega_r2 = $("#horario_ent2").val();				
	var forma_entrega_ent = $("#forma_ent").val();
	var det_forma_entrega = $("#detalles_ent").val();
	var referencia_ent = $("#referencia_ent").val();
	var empaque = $("#empaque_ent").val();


	$.post("ajax/list_pedidos.php?op=guardar_datos_entrega",{
		idpedido:idpedido,
		contacto_ent:contacto_ent,
		calle_ent:calle_ent,
		numero_ent:numero_ent,
		interior_ent:interior_ent,
		colonia_ent:colonia_ent,
		ciudad_ent:ciudad_ent,
		estado_ent:estado_ent,
		cp_ent:cp_ent,
		telefono_ent:telefono_ent,
		email_ent:email_ent,
		fecha_entrega_ent:fecha_entrega_ent,
		hora_entrega_r1:hora_entrega_r1,
		hora_entrega_r2:hora_entrega_r2,
		forma_entrega_ent:forma_entrega_ent,
		det_forma_entrega:det_forma_entrega,
		referencia_ent:referencia_ent,
		empaque:empaque
	},function(data, status)
	{
	data = JSON.parse(data);

		bootbox.alert("Datos actualizados correctamente");
			
			document.getElementById("check_update_ent").checked = false;
			document.getElementById('contacto_rep').disabled = true;
			document.getElementById('calledev_fac_rep2').disabled = true;
			document.getElementById('numerodev_fac_rep2').disabled = true;
			document.getElementById('intdev_fac_rep2').disabled = true;
			document.getElementById('coloniadev_fac_rep2').disabled = true;
			document.getElementById('ciudaddev_fac_rep2').disabled = true;
			document.getElementById('estadodev_fac_rep2').disabled = true;
			document.getElementById('cpdev_fac_rep2').disabled = true;
			document.getElementById('telefono_ent').disabled = true;
			document.getElementById('correo_ent').disabled = true;

			document.getElementById('fecha_ent').disabled = true;
			document.getElementById('fecha_entrega').disabled = true;
			document.getElementById('fecha_ent_cliente').disabled = true;
			document.getElementById('horario_ent1').disabled = true;
			document.getElementById('horario_ent2').disabled = true;
			document.getElementById('forma_ent').disabled = true;
			document.getElementById('detalles_ent').disabled = true;
			document.getElementById('referencia_ent').disabled = true;
			document.getElementById('empaque_ent').disabled = true;
			document.getElementById('btn_update_ent').disabled = true;

	});	
				
}















function buscar_pedido(idpg_pedidos)
{
	refresh_campos();
	//alert(idpg_pedidos);
	$("#idpedido").val(idpg_pedidos);
	$("#idpedido_header").val(idpg_pedidos);
	document.getElementById("caja_chat").style.display = "none";
	$("#idped_marca").val("0");

	$.post("ajax/list_pedidos.php?op=buscar_pedido",{idpg_pedidos:idpg_pedidos},function(data, status)
		{
		data = JSON.parse(data);

			var nom_cliente = data.nom_cliente;
			//alert(nom_cliente);
			$("#coment_ped_motivo").val(data.coment_vencim);
			$("#porc_av_p").val(data.porc_av);
			$("#btn_estatus_ped").text(data.estatus);
			$("#cliente").text(nom_cliente);
			//alert(data.tipo);
			if (data.tipo==1) {
				var tipo = "Pedido comercial";
			}
			if (data.tipo==2) {
				var tipo = "PEDIDO DE LICITACIÓN";
			}
			if (data.tipo==3) {
				var tipo = "PEDIDO DE MUESTRA";
			}
			if (data.tipo==4) {
				var tipo = "PEDIDO PARA EXISTENCIAS";
			}
			if (data.tipo==0) {
				var tipo = "";
			}

			$("#detalles_form_entre_ini").text(data.det_forma_entrega);
			$("#observ_ini").text(data.observaciones);
			$("#observ").val(data.observaciones);
			$("#asesor").text(data.asesor);
			$("#levanto").text(data.levanto_pedido);
			$("#autorizacion").text(data.autorizacion);
			$("#lab").text(data.lab);
			$("#medio").text(data.medio);
			$("#met_pago").text(data.metodo_pago);
			$("#uso_cfdi").text(data.uso_cfdi);
			$("#requisitos_pago").text(data.reglamentos);
			$("#salida").text(data.salida);
			$("#factura").text(data.factura);
			$("#otros").text(data.otros);

			$("#tipo_pedido").text(tipo);
			$("#lugar").text(data.lugar);
			$("#no_control").text(data.no_control);
			$("#no_pedido").text(data.no_pedido);
			$("#fecha").text(data.fecha_pedido);
			$("#razon_fac_rep").val(data.razon_fac);
			$("#rfc_fac_rep").val(data.rfc_fac);
			if (data.interior_fac!="") {
				var interior_fac = "Int. "+data.interior_fac;
			}else{
				var interior_fac = "";
			}

			if (data.colonia_fac!="") {
				var colonia_fac = "Col. "+data.colonia_fac;
			}else{
				var colonia_fac = "";
			}

			if (data.cp_fac!="") {
				var cp_fac = "CP. "+data.cp_fac;
			}else{
				var cp_fac = "";
			}

			//$("#dom_fac_rep").val(data.calle_fac+" "+data.numero_fac+" "+interior_fac+" "+colonia_fac+", "+data.ciudad_fac+" "+data.estado_fac+" "+cp_fac);
			
				$("#calledev_fac_rep").val(data.calle_fac);
				$("#numerodev_fac_rep").val(data.numero_fac);
				$("#intdev_fac_rep").val(interior_fac);
				$("#coloniadev_fac_rep").val(colonia_fac);
				$("#ciudaddev_fac_rep").val(data.ciudad_fac);
				$("#estadodev_fac_rep").val(data.estado_fac);
				$("#cpdev_fac_rep").val(cp_fac);




			$("#telefono_rep").val(data.telefono_fac);
			$("#correo_rep").val(data.email_fac);


			$("#contacto_rep").val(data.contacto_ent);

			if (data.interior_ent!="") {
				var interior_ent = "Int. "+data.interior_ent;
			}else{
				var interior_ent = "";
			}

			if (data.colonia_ent!="") {
				var colonia_ent = "Col. "+data.colonia_ent;
			}else{
				var colonia_ent = "";
			}

			if (data.cp_ent!="") {
				var cp_ent = "CP. "+data.cp_ent;
			}else{
				var cp_ent = "";
			}
			//$("#dom_ent").val(data.calle_ent+" "+data.numero_ent+" "+interior_ent+" "+colonia_ent+", "+data.ciudad_ent+" "+data.estado_ent+" "+cp_ent);
			
				$("#calledev_fac_rep2").val(data.calle_ent);
				$("#numerodev_fac_rep2").val(data.numero_ent);
				$("#intdev_fac_rep2").val(interior_ent);
				$("#coloniadev_fac_rep2").val(colonia_ent);
				$("#ciudaddev_fac_rep2").val(data.ciudad_ent);
				$("#estadodev_fac_rep2").val(data.estado_ent);
				$("#cpdev_fac_rep2").val(cp_ent);


			$("#telefono_ent").val(data.telefono_ent);
			$("#correo_ent").val(data.email_ent);
			$("#fecha_ent").val(data.fecha_entrega_ent);
			$("#fecha_entrega").text(data.fecha_entrega_ent);
			$("#fecha_ent_cliente").text(data.fecha_ent_cliente);
			
			$("#horario_ent1").val(data.hora_entrega_r1);
			$("#horario_ent2").val(data.hora_entrega_r2);
			$("#forma_ent").val(data.forma_entrega_ent);
			$("#detalles_ent").val(data.det_forma_entrega);
			$("#referencia_ent").val(data.referencia_ent);
			$("#empaque_ent").val(data.empaque);

			//alert(idpg_pedidos);

			$.post("ajax/list_pedidos.php?op=listar_documentos&id="+idpg_pedidos,function(r){
			$("#box_documentos").html(r);

				$.post("ajax/list_pedidos.php?op=listar_pedido_detalle_term&id="+0,function(r){
				$("#tbl_detalle_productos").html(r);

					//alert(idpg_pedidos);

					$.post("ajax/list_pedidos.php?op=listar_pedido_detalle_term&id="+idpg_pedidos,function(r){
					$("#tbl_detalle_productos").html(r);

						
							        
					});

				});

				//alert(idpg_pedidos);

					
			       
			});

		});
	
}


function buscar_control()
{
	var input_buscar = $("#input_buscar").val();
	var idusuario = $("#idusuario").text();
	var lugar_user = $("#lugar_user").text();

	$.post("ajax/list_pedidos.php?op=buscar_idpg_pedidos",{input_buscar:input_buscar},function(data, status)
	{
	data = JSON.parse(data);

		//alert("Id de control:")
		var idpg_pedidos = data.idpg_pedidos;
		var lugar = data.lugar;

		if (lugar_user==lugar || lugar_user=="Fabrica" || lugar_user=="Ventas Alterno") {


			if (idusuario==1) {
				//alert(idpg_pedidos+" - id de control: "+input_buscar)
			}
			
			$("#idpedido").val(idpg_pedidos);
			$("#idpedido_header").val(idpg_pedidos);


			$.post("ajax/list_pedidos.php?op=buscar_pedido",{idpg_pedidos:idpg_pedidos},function(data, status)
			{
			data = JSON.parse(data);

				var nom_cliente = data.nom_cliente;
				//alert(nom_cliente);
				$("#coment_ped_motivo").val(data.coment_vencim);
				$("#porc_av_p").val(data.porc_av);
				$("#btn_estatus_ped").text(data.estatus);
				$("#cliente").text(nom_cliente);
				//alert(data.tipo);
				if (data.tipo==1) {
					var tipo = "Pedido comercial";
				}
				if (data.tipo==2) {
					var tipo = "PEDIDO DE LICITACIÓN";
				}
				if (data.tipo==3) {
					var tipo = "PEDIDO DE MUESTRA";
				}
				if (data.tipo==4) {
					var tipo = "PEDIDO PARA EXISTENCIAS";
				}
				if (data.tipo==0) {
					var tipo = "";
				}

				$("#detalles_form_entre_ini").text(data.det_forma_entrega);
				$("#observ_ini").text(data.observaciones);
				$("#observ").val(data.observaciones);
				$("#asesor").text(data.asesor);
				$("#levanto").text(data.levanto_pedido);
				$("#autorizacion").text(data.autorizacion);
				$("#lab").text(data.lab);
				$("#medio").text(data.medio);
				$("#met_pago").text(data.metodo_pago);
				$("#uso_cfdi").text(data.uso_cfdi);
				$("#requisitos_pago").text(data.reglamentos);
				$("#salida").text(data.salida);
				$("#factura").text(data.factura);
				$("#otros").text(data.otros);

				$("#tipo_pedido").text(tipo);
				$("#lugar").text(data.lugar);
				$("#no_control").text(data.no_control);
				$("#no_pedido").text(data.no_pedido);
				$("#fecha").text(data.fecha_pedido);
				$("#razon_fac_rep").text(data.razon_fac);
				$("#rfc_fac_rep").text(data.rfc_fac);
				if (data.interior_fac!="") {
					var interior_fac = "Int. "+data.interior_fac;
				}else{
					var interior_fac = "";
				}

				if (data.colonia_fac!="") {
					var colonia_fac = "Col. "+data.colonia_fac;
				}else{
					var colonia_fac = "";
				}

				if (data.cp_fac!="") {
					var cp_fac = "CP. "+data.cp_fac;
				}else{
					var cp_fac = "";
				}

				$("#dom_fac_rep").text(data.calle_fac+" "+data.numero_fac+" "+interior_fac+" "+colonia_fac+", "+data.ciudad_fac+" "+data.estado_fac+" "+cp_fac);
				$("#telefono_rep").text(data.telefono_fac);
				$("#correo_rep").text(data.email_fac);


				$("#contacto_rep").text(data.contacto_ent);

				if (data.interior_ent!="") {
					var interior_ent = "Int. "+data.interior_ent;
				}else{
					var interior_ent = "";
				}

				if (data.colonia_ent!="") {
					var colonia_ent = "Col. "+data.colonia_ent;
				}else{
					var colonia_ent = "";
				}

				if (data.cp_ent!="") {
					var cp_ent = "CP. "+data.cp_ent;
				}else{
					var cp_ent = "";
				}
				$("#dom_ent").text(data.calle_ent+" "+data.numero_ent+" "+interior_ent+" "+colonia_ent+", "+data.ciudad_ent+" "+data.estado_ent+" "+cp_ent);
				$("#telefono_ent").text(data.telefono_ent);
				$("#correo_ent").text(data.email_ent);
				$("#fecha_ent").text(data.fecha_entrega_ent);
				$("#fecha_entrega").text(data.fecha_entrega_ent);
				$("#fecha_ent_cliente").text(data.fecha_ent_cliente);
				$("#horario_ent1").text(data.hora_entrega_r1);
				$("#horario_ent2").text(data.hora_entrega_r2);
				$("#forma_ent").text(data.forma_entrega_ent);
				$("#detalles_ent").text(data.det_forma_entrega);
				$("#referencia_ent").text(data.referencia_ent);
				$("#empaque_ent").text(data.empaque);

				$.post("ajax/list_pedidos.php?op=listar_documentos&id="+idpg_pedidos,function(r){
				$("#box_documentos").html(r);

					$.post("ajax/list_pedidos.php?op=listar_pedido_detalle_term&id="+idpg_pedidos,function(r){
					$("#tbl_detalle_productos").html(r);

						//$("#input_buscar").hide();
						$("#input_buscar").val("");
							        
					});
				       
				});

			});



		}else{
			bootbox.alert("Este pedido no puede ser mostrado");
		}


		

	});	


		

	
}

function valid_datos_fecha()
{
	var fecha1_consul = $("#fecha1_consul").val();
	var fecha2_consul = $("#fecha2_consul").val();

	if (fecha1_consul!="" && fecha1_consul!="") {

		$("#nombre_cliente").val("");
		$("#valor_consulta").val("1");
		
	}else{
		bootbox.alert("Para esta consulta se requiere tener ambas fechas");
	}
}

function valid_nom_cli()
{
	$("#fecha1_consul").val("");
	$("#fecha2_consul").val("");
	$("#valor_consulta").val("2");
}

function buscar_valores()
{	
	var fecha1_consul = $("#fecha1_consul").val();
	var fecha2_consul = $("#fecha2_consul").val();
	var nombre_cliente = $("#nombre_cliente").val();
	var valor_consulta = $("#valor_consulta").val();
	//alert(valor_consulta);


		var estatus_tabla = 1;
		//$("#estatus_pedido").val("1");
		//alert(estatus_tabla);
		var idusuario=$("#idusuario").text();
		$("#estatus_pedido").val("1");

		$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
		{
		data = JSON.parse(data);

			var lugar = data.lugar;
			$("#lugar_user").text(lugar);

			$.post("ajax/list_pedidos.php?op=listar_pedidos_v2_consul&lugar="+lugar+"&valor_consulta="+valor_consulta+"&nombre_cliente="+nombre_cliente+"&fecha1_consul="+fecha1_consul+"&fecha2_consul="+fecha2_consul,function(r){
		    $("#div_lista_pedidos").html(r);

		    		buscar_pedido_ini();
			    				    	
		                     
		    });

		});	

	
}

function update_observ()
{
	var id_ped_temp = $("#idpedido").val();
	var observ = $("#observ").val();

	$.post("ajax/list_pedidos.php?op=update_observ",{id_ped_temp:id_ped_temp,observ:observ},function(data, status)
	{
	data = JSON.parse(data);

			
			var idusuario=$("#idusuario").text();
			var fecha=moment().format('YYYY-MM-DD');
			var hora=moment().format('HH:mm:ss');
			var fecha_hora=fecha+" "+hora;
			var observ = $("#observ").val();
			//alert(observ);
			var text_set = "Campo de observaciones generales editado. Texto: "+observ;

			$.post("ajax/diseno.php?op=save_hist",{id_ped_temp:id_ped_temp,idusuario:idusuario,fecha_hora:fecha_hora,text_set:text_set},function(data, status)
			{
			data = JSON.parse(data);

					//alert("g");

					bootbox.alert("Observaciones editadas exitoramente");
			});

	});
}


function abrir_rep_ped2()// para reporte
{
	
  	var id_ped_temp = $("#idpedido").val();
  	var idusuario=$("#idusuario").text();
  
  	$("#enlace_pedido2").attr("href","reportes/exTicket.php?id="+id_ped_temp+"&id2="+idusuario);
}

function listar_historial()
{
	var id_ped_temp = $("#idpedido").val();

	$("#modal_historial").modal("show");

	$.post("ajax/diseno.php?op=listar_historial&id="+id_ped_temp,function(r){
	$("#datatable_historial").html(r);

			        
	});

}

function abrir_edit_prod_list()
{
	var idusuario = $("#idusuario").text();

	if (idusuario==1) {
		$("#modal_edit_prod_list").modal("show");
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción");
	}
	
	
	//var id_ped_temp = $("#id_ped_temp2").text();
	

}

function tipo_edit_prod()
{
	var tipo_edit_prod = $("#tipo_edit_prod").val();

	if (tipo_edit_prod==1) {
		$("#div_agregar").show();
		$("#div_quitar").hide();
		$("#div_cambiar").hide();
		$("#div_editar").hide();
	}
	if (tipo_edit_prod==2) {
		listar_productos_pedido_exist();
		$("#div_agregar").hide();
		$("#div_quitar").show();
		$("#div_cambiar").hide();
		$("#div_editar").hide();
	}
	if (tipo_edit_prod==3) {
		listar_productos_pedido_exist2();
		$("#div_agregar").hide();
		$("#div_quitar").hide();
		$("#div_cambiar").show();
		$("#div_editar").hide();
	}
	if (tipo_edit_prod==4) {
		listar_productos_pedido_exist_edit();
		$("#div_agregar").hide();
		$("#div_quitar").hide();
		$("#div_cambiar").hide();
		$("#div_editar").show();
	}
}

function listar_productos_pedido_exist()
{
	var id_ped_temp = $("#idpedido").val();

	$.post("ajax/diseno.php?op=listar_productos_pedido_exist&id="+id_ped_temp,function(r){
	$("#tbl_productos_pedido_exist").html(r);

			        
	});
}

function listar_productos_pedido_exist2()
{
	var id_ped_temp = $("#idpedido").val();

	$.post("ajax/diseno.php?op=listar_productos_pedido_exist2&id="+id_ped_temp,function(r){
	$("#tbl_productos_pedido_exist2").html(r);

			        
	});
}

function listar_productos_pedido_exist_edit()
{
	var id_ped_temp = $("#idpedido").val();

	$.post("ajax/diseno.php?op=listar_productos_pedido_exist_edit&id="+id_ped_temp,function(r){
	$("#tbl_productos_pedido_exist_edit").html(r);

			        
	});
}

function listar_productos_list()
{
	var buscar_prod_list = $("#buscar_prod_list").val();

	$.post("ajax/diseno.php?op=listar_productos_list&id="+buscar_prod_list,function(r){
	$("#tbl_productos_list").html(r);

			        
	});
}


function agregar_prod_ped_list(idproductos_clasif,idproducto,precio_total)
{
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var idusuario=$("#idusuario").text();

	if (precio_total=="") {
		precio_total=0;
	}

	if (idproducto>0) {


					$.post("ajax/diseno.php?op=buscar_idprod_clasif",{idproductos_clasif:idproductos_clasif,idproducto,idproducto},function(data, status)
					{
						data = JSON.parse(data);

						var idmuebles_fam = data.idtipo;
						var codigo = data.codigo_match;
						var nombre = data.descripcion;
						var nom_color = data.nom_color;
						var nom_tamano = data.nom_tamano;

						if (nom_color==null) {
							nom_color="";
						}

						if (nom_tamano==null) {
							nom_tamano="";
						}


						$.post("ajax/diseno.php?op=update_producto_tbl1",{idmuebles_fam:idmuebles_fam,codigo:codigo,nombre:nombre,idproducto:idproducto,nom_color,nom_tamano},function(data, status)
						{
							data = JSON.parse(data);

							var id_ped_temp = $("#idpedido").val();
							var precio = precio_total;
							$.post("ajax/diseno.php?op=consul_exist",{idproducto:idproducto,id_ped_temp:id_ped_temp},function(data, status)
							{
							data = JSON.parse(data);
								if (data.num_prod==0) {
									var tipo_add = 1;
									$.post("ajax/diseno.php?op=save_prod_ped",{idproducto:idproducto,id_ped_temp:id_ped_temp,precio:precio,tipo_add:tipo_add,fecha_hora:fecha_hora,idusuario:idusuario},function(data, status)
									{
										data = JSON.parse(data);
										
										bootbox.alert("Producto agregado correctamente.");
										
									});

								}else{
									bootbox.alert("Este producto ya existe");
								}
							});

						});

					});
							
	}else{


				$.post("ajax/diseno.php?op=insert_prod",{idproductos_clasif:idproductos_clasif},function(data, status)
				{
					data = JSON.parse(data);

					//alert(data.idproducto);

					var idproducto=data.idproducto

					$.post("ajax/diseno.php?op=buscar_idprod_clasif",{idproductos_clasif:idproductos_clasif,idproducto,idproducto},function(data, status)
					{
						data = JSON.parse(data);

						var idmuebles_fam = data.idtipo;
						var codigo = data.codigo_match;
						var nombre = data.descripcion;
						var nom_color = data.nom_color;
						var nom_tamano = data.nom_tamano;

						if (nom_color==null) {
							nom_color="";
						}

						if (nom_tamano==null) {
							nom_tamano="";
						}


						$.post("ajax/diseno.php?op=update_producto_tbl1",{idmuebles_fam:idmuebles_fam,codigo:codigo,nombre:nombre,idproducto:idproducto,nom_color,nom_tamano},function(data, status)
						{
							data = JSON.parse(data);



							var id_ped_temp = $("#idpedido").val();
							var precio = precio_total;
							$.post("ajax/diseno.php?op=consul_exist",{idproducto:idproducto,id_ped_temp:id_ped_temp},function(data, status)
							{
							data = JSON.parse(data);
								if (data.num_prod==0) {
									var tipo_add = 1;
									$.post("ajax/diseno.php?op=save_prod_ped",{idproducto:idproducto,id_ped_temp:id_ped_temp,precio:precio,tipo_add:tipo_add,fecha_hora:fecha_hora,idusuario:idusuario},function(data, status)
									{
										data = JSON.parse(data);
										bootbox.alert("Producto agregado correctamente.");
										

										//var buscar_prod_fil = $("#buscar_prod_fil").val();

										
									});

								}else{
									bootbox.alert("Este producto ya existe");
								}
							});



						});
					});
					
				});

	}
}

function editar_prod_ped_list(idpg_detalle_pedidos,idproducto,precio_total)
{

	bootbox.alert("Esta función aún no esta disponible");
	/*var idprod = idproducto;
	var precio = precio_total;

	$("#modal_edit_prod_pedido").modal("show");

	$.post("ajax/diseno.php?op=llenar_datos_prod",{idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
	{
	data = JSON.parse(data);

		 $("#cantidad_pedido_edit").val(data.cantidad);
		 $("#unidad_pedido_edit").val(data.unidad);
		 $("#codigo_pedido_edit").val(data.codigo);
		 $("#medida_pedido_edit").val(data.medida);
		 $("#descripcion_pedido_edit").val(data.descripcion);
		 $("#color_pedido_edit").val(data.descripcion);
		 $("#precio_pedido_edit").val(data.precio);
		 $("#descuento_pedido_edit").val(data.descuento);
		 $("#descuento_rep2_pedido_edit").val(data.descuento);
		 $("#importe_pedido_edit").val(data.importe);

		 	

	});*/
}

function mostrar_productos_list(idpg_detalle_pedidos)
{
	var buscar_prod_list = $("#buscar_prod_list"+idpg_detalle_pedidos).val();

	$.post("ajax/diseno.php?op=listar_productos_list_cambio&id="+buscar_prod_list+"&idpg_detalle_pedidos="+idpg_detalle_pedidos,function(r){
	$("#tbl_productos_list"+idpg_detalle_pedidos).html(r);

			        
	});
}

function select_prod_ped_list(idproductos_clasif,idproducto,precio_total,idpg_detalle_pedidos)
{
	
	/*$("#idproductos_clasif"+idpg_detalle_pedidos).val(idproductos_clasif);
	$("#idproducto"+idpg_detalle_pedidos).val(idproducto);
	$("#precio_total"+idpg_detalle_pedidos).val(precio_total);*/

	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var idusuario=$("#idusuario").text();

	if (precio_total=="") {
		precio_total=0;
	}


										


	if (idproducto>0) {


					$.post("ajax/diseno.php?op=buscar_idprod_clasif",{idproductos_clasif:idproductos_clasif,idproducto,idproducto},function(data, status)
					{
						data = JSON.parse(data);

						var idmuebles_fam = data.idtipo;
						var codigo = data.codigo_match;
						var nombre = data.descripcion;
						var nom_color = data.nom_color;
						var nom_tamano = data.nom_tamano;

						if (nom_color==null) {
							nom_color="";
						}

						if (nom_tamano==null) {
							nom_tamano="";
						}


						$.post("ajax/diseno.php?op=update_producto_tbl1",{idmuebles_fam:idmuebles_fam,codigo:codigo,nombre:nombre,idproducto:idproducto,nom_color,nom_tamano},function(data, status)
						{
							data = JSON.parse(data);

							var id_ped_temp = $("#idpedido").val();
							var precio = precio_total;
							$.post("ajax/diseno.php?op=consul_exist",{idproducto:idproducto,id_ped_temp:id_ped_temp},function(data, status)
							{
							data = JSON.parse(data);
								if (data.num_prod==0) {
									//var tipo_add = 1;

									$.post("ajax/diseno.php?op=rango_iddetalle",{idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
									{
									data = JSON.parse(data);
										//alert(data);
										if (data==null) {
											var idpg_detped1 = 0;
											var idpg_detped2 = 0;
										}else{
											var idpg_detped1 = data.idpg_detped1;
											var idpg_detped2 = data.idpg_detped2;
										}

										/*alert(idpg_detped1);
										alert(idpg_detped2);*/


										$.post("ajax/diseno.php?op=buscar_avances",{idpg_detped1:idpg_detped1,idpg_detped2:idpg_detped2},function(data, status)
										{
											data = JSON.parse(data);

											/*alert(data);
											alert(data.idavance_prod);*/

											if (data==null) {

												$.post("ajax/diseno.php?op=change_prod_ped",{
													idproducto:idproducto,
													id_ped_temp:id_ped_temp,
													precio:precio,
													fecha_hora:fecha_hora,
													idusuario:idusuario,
													idpg_detalle_pedidos:idpg_detalle_pedidos,
													idpg_detped1:idpg_detped1,
													idpg_detped2:idpg_detped2},function(data, status)
												{
													data = JSON.parse(data);
													
													bootbox.alert("Cambio de producto realizado exitosamente");
													
													listar_productos_pedido_exist2();
												});

											}else{
												bootbox.alert("El producto tiene avances de producción por lo que no puede ser reemplazado.");
											}

										});
											

										//alert(idpg_detped1);
										//alert(idpg_detped2);

												

									});
									
									/*$.post("ajax/diseno.php?op=save_prod_ped",{idproducto:idproducto,id_ped_temp:id_ped_temp,precio:precio,tipo_add:tipo_add,fecha_hora:fecha_hora,idusuario:idusuario},function(data, status)
									{
										data = JSON.parse(data);
										
										bootbox.alert("Producto agregado correctamente.");
										tbl_rep_pedido_consul();
										pie_reporte();
									});*/

										





								}else{
									bootbox.alert("Este producto ya existe");
								}
							});

						});

					});
							
	}else{


				$.post("ajax/diseno.php?op=insert_prod",{idproductos_clasif:idproductos_clasif},function(data, status)
				{
					data = JSON.parse(data);

					//alert(data.idproducto);

					var idproducto=data.idproducto

					$.post("ajax/diseno.php?op=buscar_idprod_clasif",{idproductos_clasif:idproductos_clasif,idproducto,idproducto},function(data, status)
					{
						data = JSON.parse(data);

						var idmuebles_fam = data.idtipo;
						var codigo = data.codigo_match;
						var nombre = data.descripcion;
						var nom_color = data.nom_color;
						var nom_tamano = data.nom_tamano;

						if (nom_color==null) {
							nom_color="";
						}

						if (nom_tamano==null) {
							nom_tamano="";
						}


						$.post("ajax/diseno.php?op=update_producto_tbl1",{idmuebles_fam:idmuebles_fam,codigo:codigo,nombre:nombre,idproducto:idproducto,nom_color,nom_tamano},function(data, status)
						{
							data = JSON.parse(data);



							var id_ped_temp = $("#idpedido").val();
							var precio = precio_total;
							$.post("ajax/diseno.php?op=consul_exist",{idproducto:idproducto,id_ped_temp:id_ped_temp},function(data, status)
							{
							data = JSON.parse(data);
								if (data.num_prod==0) {
									//var tipo_add = 1;
									/*$.post("ajax/diseno.php?op=save_prod_ped",{idproducto:idproducto,id_ped_temp:id_ped_temp,precio:precio,tipo_add:tipo_add,fecha_hora:fecha_hora,idusuario:idusuario},function(data, status)
									{
										data = JSON.parse(data);
										bootbox.alert("Producto agregado correctamente.");
										tbl_rep_pedido_consul();
										pie_reporte();

										

										
									});*/


									$.post("ajax/diseno.php?op=rango_iddetalle",{idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
									{
									data = JSON.parse(data);
										//alert(data);
										

										if (data==null) {
											var idpg_detped1 = 0;
											var idpg_detped2 = 0;
										}else{
											var idpg_detped1 = data.idpg_detped1;
											var idpg_detped2 = data.idpg_detped2;
										}	

										$.post("ajax/diseno.php?op=buscar_avances",{idpg_detped1:idpg_detped1,idpg_detped2:idpg_detped2},function(data, status)
										{
											data = JSON.parse(data);

											if (data==null) {

												$.post("ajax/diseno.php?op=change_prod_ped",{
													idproducto:idproducto,
													id_ped_temp:id_ped_temp,
													precio:precio,
													fecha_hora:fecha_hora,
													idusuario:idusuario,
													idpg_detalle_pedidos:idpg_detalle_pedidos,
													idpg_detped1:idpg_detped1,
													idpg_detped2:idpg_detped2},function(data, status)
												{
													data = JSON.parse(data);
													
													bootbox.alert("Cambio de producto realizado exitosamente");
													
													listar_productos_pedido_exist2();
												});

											}else{
												bootbox.alert("El producto tiene avances de producción por lo que no puede ser reemplazado.");
											}

										});

										

									});


								}else{
									bootbox.alert("Este producto ya existe");
								}
							});



						});
					});
					
				});

	}
}

function cambiar_prod_ped_list(idpg_detalle_pedidos)
{
	var idpedido = $("#idpedido").val();
	var idusuario=$("#idusuario").text();
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	//alert(idpg_detalle_pedidos);

	$.post("ajax/diseno.php?op=cambiar_prod_ped_list",{idpg_detalle_pedidos:idpg_detalle_pedidos,idpedido:idpedido,idusuario:idusuario,fecha_hora:fecha_hora},function(data, status)
	{
		data = JSON.parse(data);

									
		bootbox.alert("Producto eliminado exitosamente");

	});
}


function quitar_prod_ped_list(idpg_detalle_pedidos,idproducto,precio_total)
{
	var idpedido = $("#idpedido").val();
	var idusuario=$("#idusuario").text();
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var precio = precio_total;

	var id_ped_temp = $("#idpedido").val();

	$.post("ajax/diseno.php?op=buscar_prod_detped",{idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
	{
		data = JSON.parse(data);

		//alert(data.num_prod);
		var num_prod = data.num_prod;

		if (num_prod>0) {

			$.post("ajax/diseno.php?op=buscar_prod_op",{idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
			{
				data = JSON.parse(data);

				//alert(data);
				//alert(data.op);

				if (data!=null) {
					if (data.op>0) {

						//alert("entra");

									$.post("ajax/diseno.php?op=rango_iddetalle",{idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
									{
									data = JSON.parse(data);
										//alert(data);
										

										if (data==null) {
											var idpg_detped1 = 0;
											var idpg_detped2 = 0;
										}else{
											var idpg_detped1 = data.idpg_detped1;
											var idpg_detped2 = data.idpg_detped2;
										}

										/*alert(idpg_detped1);
										alert(idpg_detped2);*/	

										$.post("ajax/diseno.php?op=buscar_avances",{idpg_detped1:idpg_detped1,idpg_detped2:idpg_detped2},function(data, status)
										{
											data = JSON.parse(data);

											if (data==null) {

												$.post("ajax/diseno.php?op=quitar_prod_ped",{
													idproducto:idproducto,
													id_ped_temp:id_ped_temp,
													precio:precio,
													fecha_hora:fecha_hora,
													idusuario:idusuario,
													idpg_detalle_pedidos:idpg_detalle_pedidos,
													idpg_detped1:idpg_detped1,
													idpg_detped2:idpg_detped2},function(data, status)
												{
													data = JSON.parse(data);
													
													bootbox.alert("Producto eliminado exitosamente (reimprimir OP)");
													
													listar_productos_pedido_exist2();
												});

											}else{
												bootbox.alert("El producto tiene avances de producción por lo que no puede ser eliminado.");
											}

										});

										

									});












						//bootbox.alert("El producto no se puede eliminar porque tiene orden de producción, pongase en contacto con el administrador del sistema.");
					}

				}


				if (data==null) {




					bootbox.confirm({
					    message: "¿Esta seguro de quitar este producto?, todos los estatus creados serán borrados.",
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
					        //console.log('This was logged in the callback: ' + result);

					        //alert(result);


					        if (result==true) {	
						
					        	

								//alert(fecha_hora);

								$.post("ajax/diseno.php?op=quitar_prod_ped_list",{idpg_detalle_pedidos:idpg_detalle_pedidos,idpedido:idpedido,idusuario:idusuario,fecha_hora:fecha_hora},function(data, status)
								{
									data = JSON.parse(data);

									listar_productos_pedido_exist();
									

									bootbox.alert("Producto eliminado exitosamente");

								});

							}

					    }
					});				

				}

					
			});

		}else{

					bootbox.confirm({
					    message: "¿Esta seguro de quitar este producto?, todos los estatus creados serán borrados.",
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
					        //console.log('This was logged in the callback: ' + result);

					        //alert(result);


					        if (result==true) {	
						
					        	//alert(fecha_hora);
					        	

								$.post("ajax/diseno.php?op=quitar_prod_ped_list",{idpg_detalle_pedidos:idpg_detalle_pedidos,idpedido:idpedido,idusuario:idusuario,fecha_hora:fecha_hora},function(data, status)
								{
									data = JSON.parse(data);

									listar_productos_pedido_exist();
									
									bootbox.alert("Producto eliminado exitosamente");

								});

							}

					    }
					});
			
		}
	});
}


function mostrar_det_ped(idpg_detalle_pedidos)
{
	if (idusuario!=26) {
		$("#iddetalle_pedido").val(idpg_detalle_pedidos);
		$("#modal_asign_estatus").modal("show");

		$.post("ajax/list_pedidos.php?op=consul_datos_prod",{idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
		{
		data = JSON.parse(data);

		$("#codigo_dividir").text(data.codigo);
		$("#descrip_dividir").text(data.descripcion);
		$("#medidas_dividir").text(data.medida);
		$("#color_dividir").text(data.color);
		$("#cantidad_dividir").text(data.cantidad);
		$("#no_control_dividir").text(data.no_control);

		var idusuario=$("#idusuario").text();

				$.post("ajax/list_pedidos.php?op=listar_pg_detped&id="+idpg_detalle_pedidos+"&idusuario="+idusuario,function(r){
					$("#tbl_detalle_prod_tbl").html(r);

								
				});

		});
	}

	
}


function dividir_prod_ped()
{
	var idusuario = $("#idusuario").text();
	//var idpg_detalle_pedidos = id;
	var cantidad_total = $("#cantidad_dividir").text();
	var idpg_detalle_pedidos = $("#iddetalle_pedido").val();

	$.post("ajax/list_pedidos.php?op=consul_cants",{idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
	{
	data = JSON.parse(data);

		var cant_tot = data.cantidad;
		var cant_detped = data.cant_detped;

		/*alert(cant_tot);
		alert(cant_detped);*/

		if (parseInt(cant_detped)<parseInt(cant_tot)) {

			var cant_div = parseInt(cantidad_total)-parseInt(cant_detped);

			$.post("ajax/list_pedidos.php?op=dividir_prod_ped",{idpg_detalle_pedidos:idpg_detalle_pedidos,cant_div:cant_div},function(data, status)
			{
			data = JSON.parse(data);
				//alert("agregado");


					$.post("ajax/list_pedidos.php?op=listar_pg_detped&id="+idpg_detalle_pedidos+"&idusuario="+idusuario,function(r){
						$("#tbl_detalle_prod_tbl").html(r);

							        
					});
			});

		}else{
			bootbox.alert("Todos los productos han sido procesados");
		}

	});


			
}


function borrar_det_ped(idpg_detped,iddetalle_pedido,op,estatus)
{

	var idusuario = $("#idusuario").text();

	if (idusuario==4 || idusuario==1) {

		if (op=="") {


			if (estatus=="Apartado") {

				var idpg_detped_vale = idpg_detped;
				$.post("ajax/list_pedidos.php?op=consul_idpg_detped_val",{idpg_detped_vale:idpg_detped_vale},function(data, status)
				{
				data = JSON.parse(data);

				var num_exist = data.num_exist;

					if (num_exist==0) {

						
						bootbox.confirm({
							    message: "¿Borrar division de producto?",
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
							        //console.log('This was logged in the callback: ' + result);

							        //alert(result);

							        if (result==true) {

							        	$.post("ajax/diseno.php?op=consul_detped_id",{idpg_detped:idpg_detped},function(data, status)
										{
										data = JSON.parse(data);

											//alert(data);
											var num_exist = data.exist;

											//alert(num_exist);

											if (num_exist>0) {

												bootbox.alert("Esta división no se puede eliminar ya que se encuentra en orden de producción");
											}else{
												if (num_exist==0) {


													$.post("ajax/diseno.php?op=borrar_det_ped",{idpg_detped:idpg_detped},function(data, status)
													{
													data = JSON.parse(data);

														var idpg_detalle_pedidos=iddetalle_pedido;

														$.post("ajax/list_pedidos.php?op=listar_pg_detped&id="+idpg_detalle_pedidos+"&idusuario="+idusuario,function(r){
															$("#tbl_detalle_prod_tbl").html(r);

																bootbox.alert("División borrada exitosamente");	        
														});

															
														
													});


												}
											}

										});


										        	
							        }


							    }
						});


					}else{

						bootbox.alert("Esta división no se puede eliminar ya que se encuentra en un vale de almacén");

					}

				});

			}else{
						bootbox.confirm({
							    message: "¿Borrar division de producto?",
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
							        //console.log('This was logged in the callback: ' + result);

							        //alert(result);

							        if (result==true) {

							        	$.post("ajax/diseno.php?op=consul_detped_id",{idpg_detped:idpg_detped},function(data, status)
										{
										data = JSON.parse(data);

											//alert(data);
											var num_exist = data.exist;

											//alert(num_exist);

											if (num_exist>0) {

												bootbox.alert("Esta división no se puede eliminar ya que se encuentra en orden de producción");
											}else{
												if (num_exist==0) {


													$.post("ajax/diseno.php?op=borrar_det_ped",{idpg_detped:idpg_detped},function(data, status)
													{
													data = JSON.parse(data);

														var idpg_detalle_pedidos=iddetalle_pedido;

														$.post("ajax/list_pedidos.php?op=listar_pg_detped&id="+idpg_detalle_pedidos+"&idusuario="+idusuario,function(r){
															$("#tbl_detalle_prod_tbl").html(r);

																bootbox.alert("División borrada exitosamente");	        
														});

															
														
													});


												}
											}

										});


										        	
							        }


							    }
						});
			}

						

		}else{
			bootbox.alert("No se puede eliminar porque esta división de producto ya tiene Orden de Producción");
		}

			

	}else{
		bootbox.alert("No tiene permisos para realizar esta acción");
	}

		
	
}

function guardar_estatus1(idpg_detped,iddetalle_pedido,idpg_pedidos)
{
	var estatus = $("#select_div"+idpg_detped).val();
	$("#btn_estatus_div"+idpg_detped).text(estatus);

		$.post("ajax/list_pedidos.php?op=set_nosave",{idpg_detped:idpg_detped},function(data, status)
		{
		data = JSON.parse(data);

			document.getElementById("eti_estat2"+idpg_detped).style.visibility = "visible";
			document.getElementById("eti_estat1"+idpg_detped).style.visibility = "hidden";			

		});


	//var estatus = "Existencia";
	/*var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var id_ped_temp = idpg_pedidos*/
	/*$.post("ajax/list_pedidos.php?op=guardar_estatus1",{idpg_detped:idpg_detped,estatus:estatus,fecha_hora:fecha_hora,id_ped_temp:id_ped_temp},function(data, status)
	{
	data = JSON.parse(data);

		var idpg_detalle_pedidos=iddetalle_pedido;

		$.post("ajax/list_pedidos.php?op=listar_pg_detped&id="+idpg_detalle_pedidos,function(r){
			$("#tbl_detalle_prod_tbl").html(r);

			bootbox.alert("Estatus guardado");
				        
		});

		
	});*/
}


function edit_estatus(idpg_detped,op)
{

	//var idpg_detped = $("#idpg_detped_select_vale").val();
	var estatus = $("#select_div"+idpg_detped).val();
	var estatus2 = $("#estatus_detped"+idpg_detped).text();

	if (estatus!="") {
		estatus = $("#select_div"+idpg_detped).val();
	}else{
		estatus = $("#estatus_detped"+idpg_detped).text();
	}

	if (op>0 || estatus=="Fabricado") {

		
	}else{

		if (estatus=="Apartado") {

			var idpg_detped_vale = idpg_detped;
			$.post("ajax/list_pedidos.php?op=consul_idpg_detped_val",{idpg_detped_vale:idpg_detped_vale},function(data, status)
			{
			data = JSON.parse(data);

			var num_exist = data.num_exist;


				$.post("ajax/list_pedidos.php?op=consul_idpg_detped_estat",{idpg_detped_vale:idpg_detped_vale},function(data, status)
				{
				data = JSON.parse(data);

				var estat_envale=data.estatus;

					if (num_exist==0 || estat_envale==2 || estat_envale==3) {

						$("#btn_estatus_div"+idpg_detped).hide();
						$("#select_div"+idpg_detped).show();
					}else{

					}

				});



			

					

			});

		}else{
			$("#btn_estatus_div"+idpg_detped).hide();
			$("#select_div"+idpg_detped).show();
		}

	}

	
		
	

}
function edit_estatus_off(idpg_detped)
{
	$("#btn_estatus_div"+idpg_detped).show();
	$("#select_div"+idpg_detped).hide();
	
}


function edit_cant(idpg_detped,op)
{
	//var idpg_detped = $("#idpg_detped_select_vale").val();
	var estatus = $("#select_div"+idpg_detped).val();
	var estatus2 = $("#estatus_detped"+idpg_detped).text();

	if (estatus!="") {
		estatus = $("#select_div"+idpg_detped).val();
	}else{
		estatus = $("#estatus_detped"+idpg_detped).text();
	}

	if (estatus=="Produccion" && op>0) {

		
	}else{

		if (estatus=="Apartado") {

			var idpg_detped_vale = idpg_detped;
			$.post("ajax/list_pedidos.php?op=consul_idpg_detped_val",{idpg_detped_vale:idpg_detped_vale},function(data, status)
			{
			data = JSON.parse(data);

			var num_exist = data.num_exist;

				if (num_exist==0) {

					$("#eti_cant_prod"+idpg_detped).hide();
					$("#cant_prod_seg"+idpg_detped).show();	
				}else{

				}

			});

		}else{
			$("#eti_cant_prod"+idpg_detped).hide();
			$("#cant_prod_seg"+idpg_detped).show();	
		}
		

	}

				

}

function edit_cant_off(idpg_detped)
{
	var idusuario = $("#idusuario").text();
	if (idusuario>1) {
		$("#eti_cant_prod"+idpg_detped).show();
		$("#cant_prod_seg"+idpg_detped).hide();
		var cant = $("#cant_prod_seg"+idpg_detped).val();
		$("#eti_cant_prod"+idpg_detped).text(cant);
	}
	
	
}

function abrir_envio_a_vale(idpg_detped,iddetalle_pedido,idpg_pedidos)
{
	var idusuario = $("#idusuario").text();
	if (idusuario==1 || idusuario==4) {
		var estatus = $("#select_div"+idpg_detped).val();
		
			var idpg_detped_vale = idpg_detped;
			//alert(idpg_detped_vale);
			$.post("ajax/list_pedidos.php?op=consul_idpg_detped_val",{idpg_detped_vale:idpg_detped_vale},function(data, status)
			{
			data = JSON.parse(data);

				var num_exist = data.num_exist;
				if (num_exist==0) {

					$("#codigo_select_vale").text("");
					$("#descrip_select_vale").text("");
					$("#cantidad_select_vale").text("");

					$("#iddetalle_pedido_select_vale").val("");
					$("#idpg_detped_select_vale").val("");
					$("#idvales_almacen_select_vale").val("");

					var codigo_dividir = $("#codigo_dividir").text();
					var descrip_dividir = $("#descrip_dividir").text();
					var medidas_dividir = $("#medidas_dividir").text();
					var color_dividir = $("#color_dividir").text();
					var cantidad_dividir = $("#cant_prod_seg"+idpg_detped).val();

					if (medidas_dividir!="") {
						medidas_dividir = ", Medidas: "+medidas_dividir+",";
					}else{
						medidas_dividir="";
					}
					if (color_dividir!="") {
						color_dividir = ", Color: "+color_dividir+",";
					}else{
						color_dividir="";
					}
					
					$("#codigo_select_vale").text(codigo_dividir);
					$("#descrip_select_vale").text(descrip_dividir+medidas_dividir+color_dividir);
					$("#cantidad_select_vale").text(cantidad_dividir);

					$("#iddetalle_pedido_select_vale").val(iddetalle_pedido);
					$("#idpg_detped_select_vale").val(idpg_detped);
					$("#idpedido_select_vale").val(idpg_pedidos);
					$("#modal_select_vale").modal("show");
					$("#datos_prod_add").show();

					var estatus_vale_alm = 0;

					$.post("ajax/list_pedidos.php?op=listar_vales_select&estatus="+estatus_vale_alm,function(r){
					$("#select_vales").html(r);

						$.post("ajax/list_pedidos.php?op=listar_vale_select&id="+0,function(r){
						$("#tbl_productos_select_vale").html(r);

						});

					});

				}else{
					bootbox.alert("Este producto ya fue agregado a un vale");
				}

			});
		
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción");
	}
}

function guardar_det_ped(idpg_detped,iddetalle_pedido,idpg_pedidos)
{
	var idusuario = $("#idusuario").text();
	if (idusuario==1 || idusuario==4) {
		var estatus = $("#select_div"+idpg_detped).val();
		var estatus2 = $("#estatus_detped"+idpg_detped).text();

		if (estatus!="") {
			estatus = $("#select_div"+idpg_detped).val();
		}else{
			estatus = $("#estatus_detped"+idpg_detped).text();
		}



		if (estatus=="Apartado") {
			var idpg_detped_vale = idpg_detped;
			$.post("ajax/list_pedidos.php?op=consul_idpg_detped_val",{idpg_detped_vale:idpg_detped_vale},function(data, status)
			{
			data = JSON.parse(data);

				var num_exist = data.num_exist;
				if (num_exist==0) {

					$("#codigo_select_vale").text("");
					$("#descrip_select_vale").text("");
					$("#cantidad_select_vale").text("");

					$("#iddetalle_pedido_select_vale").val("");
					$("#idpg_detped_select_vale").val("");
					$("#idvales_almacen_select_vale").val("");

					var codigo_dividir = $("#codigo_dividir").text();
					var descrip_dividir = $("#descrip_dividir").text();
					var medidas_dividir = $("#medidas_dividir").text();
					var color_dividir = $("#color_dividir").text();
					var cantidad_dividir = $("#cant_prod_seg"+idpg_detped).val();

					if (medidas_dividir!="") {
						medidas_dividir = ", Medidas: "+medidas_dividir+",";
					}else{
						medidas_dividir="";
					}
					if (color_dividir!="") {
						color_dividir = ", Color: "+color_dividir+",";
					}else{
						color_dividir="";
					}
					
					$("#codigo_select_vale").text(codigo_dividir);
					$("#descrip_select_vale").text(descrip_dividir+medidas_dividir+color_dividir);
					$("#cantidad_select_vale").text(cantidad_dividir);

					$("#iddetalle_pedido_select_vale").val(iddetalle_pedido);
					$("#idpg_detped_select_vale").val(idpg_detped);
					$("#idpedido_select_vale").val(idpg_pedidos);
					$("#modal_select_vale").modal("show");
					$("#datos_prod_add").show();

					var estatus_vale_alm = 0;

					$.post("ajax/list_pedidos.php?op=listar_vales_select&estatus="+estatus_vale_alm,function(r){
					$("#select_vales").html(r);

						$.post("ajax/list_pedidos.php?op=listar_vale_select&id="+0,function(r){
						$("#tbl_productos_select_vale").html(r);

						});

					});

				}else{
					bootbox.alert("Este producto ya fue agregado a un vale");
				}

			});
		}else{

				bootbox.prompt("Agregar comentario adicional.", function(result){ 
    				//console.log(result);


				var cant = $("#cant_prod_seg"+idpg_detped).val();
				var obs_enl = $("#obs_prod_seg"+idpg_detped).val();
				var estatus = $("#select_div"+idpg_detped).val();

				var estatus2 = $("#estatus_detped"+idpg_detped).text();

				if (estatus!="") {
					estatus = $("#select_div"+idpg_detped).val();
				}else{
					estatus = $("#estatus_detped"+idpg_detped).text();
				}
																													//var estatus = "Existencia";
				var fecha=moment().format('YYYY-MM-DD');
				var hora=moment().format('HH:mm:ss');
				var fecha_hora=fecha+" "+hora;
				var id_ped_temp = idpg_pedidos

				$.post("ajax/diseno.php?op=guardar_det_ped",{idpg_detped:idpg_detped,cant:cant,obs_enl:obs_enl,estatus:estatus,fecha_hora:fecha_hora,id_ped_temp:id_ped_temp,result:result},function(data, status)
				{
				data = JSON.parse(data);

				var idpg_detalle_pedidos=iddetalle_pedido;

				$.post("ajax/list_pedidos.php?op=listar_pg_detped&id="+idpg_detalle_pedidos+"&idusuario="+idusuario,function(r){
					$("#tbl_detalle_prod_tbl").html(r);

																														
						bootbox.alert("Estatus guardado");
																															

					});

				});
 
			});

//prueba

				

		}
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción");
	}
}


function set_nosave(idpg_detped,iddetalle_pedido)
{
		$.post("ajax/list_pedidos.php?op=set_nosave",{idpg_detped:idpg_detped},function(data, status)
		{
		data = JSON.parse(data);

			document.getElementById("eti_estat2"+idpg_detped).style.visibility = "visible";
			document.getElementById("eti_estat1"+idpg_detped).style.visibility = "hidden";			

		});
}


function listar_prod_select_vale()
{
	var select_vales = $("#select_vales").val();

	$.post("ajax/list_pedidos.php?op=listar_vale_select&id="+select_vales,function(r){
	$("#tbl_productos_select_vale").html(r);

	});
}

function pasar_prod_vale()
{
	var idpg_detped = $("#idpg_detped_select_vale").val();
	var estatus = $("#select_div"+idpg_detped).val();
	var estatus2 = $("#estatus_detped"+idpg_detped).text();

	if (estatus!="") {
		estatus = $("#select_div"+idpg_detped).val();
	}else{
		estatus = $("#estatus_detped"+idpg_detped).text();
	}
	//alert(estatus);

	if (estatus=="Produccion") {


		$.post("ajax/list_pedidos.php?op=consul_op_detped",{idpg_detped:idpg_detped},function(data, status)
		{
		data = JSON.parse(data);

			//alert(data.op);

			if (data.op > 0) {


				var iddetalle_pedido = $("#iddetalle_pedido_select_vale").val();
				var idvales_almacen = $("#select_vales").val();
				var idpg_pedidos = $("#idpedido_select_vale").val();

				if (idvales_almacen>0 && iddetalle_pedido>0 && idpg_detped>0) {

					$.post("ajax/list_pedidos.php?op=consul_idalmacen_pt",{iddetalle_pedido:iddetalle_pedido},function(data, status)
					{
					data = JSON.parse(data);

					var idalmacen_pt = data.idalmacen_pt;
					//alert(idalmacen_pt);

					if (idalmacen_pt!=null) {

						var cantidad_dividir = $("#cant_prod_seg"+idpg_detped).val();
						var no_control = data.no_control;

							$.post("ajax/list_pedidos.php?op=guardar_prod_vale",{
								idvales_almacen:idvales_almacen,
								idalmacen_pt:idalmacen_pt,
								iddetalle_pedido:iddetalle_pedido,
								cantidad_dividir:cantidad_dividir,
								no_control:no_control,
								idpg_detped:idpg_detped
							},function(data, status)
							{
							data = JSON.parse(data);

										var cant = $("#cant_prod_seg"+idpg_detped).val();
										var obs_enl = $("#obs_prod_seg"+idpg_detped).val();
										var estatus = $("#select_div"+idpg_detped).val();
										var estatus2 = $("#estatus_detped"+idpg_detped).text();

										if (estatus!="") {
											estatus = $("#select_div"+idpg_detped).val();
										}else{
											estatus = $("#estatus_detped"+idpg_detped).text();
										}
																																		//var estatus = "Existencia";
										var fecha=moment().format('YYYY-MM-DD');
										var hora=moment().format('HH:mm:ss');
										var fecha_hora=fecha+" "+hora;
										var id_ped_temp = idpg_pedidos

												$.post("ajax/diseno.php?op=guardar_det_ped",{idpg_detped:idpg_detped,cant:cant,obs_enl:obs_enl,estatus:estatus,fecha_hora:fecha_hora,id_ped_temp:id_ped_temp},function(data, status)
												{
												data = JSON.parse(data);

													var idpg_detalle_pedidos=iddetalle_pedido;

															$.post("ajax/list_pedidos.php?op=listar_pg_detped&id="+idpg_detalle_pedidos+"&idusuario="+idusuario,function(r){
																$("#tbl_detalle_prod_tbl").html(r);
																																				//$("#subtitulo_vale").text("VALE ACTUAL");
																	bootbox.alert("El producto se ha asignado al vale correctamente.");

																	$("#codigo_select_vale").text("");
																	$("#descrip_select_vale").text("");
																	$("#cantidad_select_vale").text("");

																	$("#iddetalle_pedido_select_vale").val("");
																	$("#idpg_detped_select_vale").val("");
																	$("#idpedido_select_vale").val("");

																	$("#datos_prod_add").hide();

																	listar_prod_select_vale();
																																				

															});

												});


									


							});
					}else{
						bootbox.alert("No se puede apartar el producto porque este codigo no existe en el almacén, verifique el producto y vuelva a intentar");
					}

																														//var cantidad_dividir = $("#cantidad_prod_vale").text();
						

					});


				}else{
					bootbox.alert("No se puede agregar al vale");
				}

			}else{
				bootbox.alert("No se puede agregar al vale porque el producto aún no tiene Orden de producción");
			}

		});

	}else{

		if (estatus!="") {



				var iddetalle_pedido = $("#iddetalle_pedido_select_vale").val();
				var idvales_almacen = $("#select_vales").val();
				var idpg_pedidos = $("#idpedido_select_vale").val();

				if (idvales_almacen>0 && iddetalle_pedido>0 && idpg_detped>0) {

					$.post("ajax/list_pedidos.php?op=consul_idalmacen_pt",{iddetalle_pedido:iddetalle_pedido},function(data, status)
					{
					data = JSON.parse(data);

					var idalmacen_pt = data.idalmacen_pt;
					//alert(idalmacen_pt);

					if (idalmacen_pt!=null) {

						var cantidad_dividir = $("#cant_prod_seg"+idpg_detped).val();
						var no_control = data.no_control;

							$.post("ajax/list_pedidos.php?op=guardar_prod_vale",{
								idvales_almacen:idvales_almacen,
								idalmacen_pt:idalmacen_pt,
								iddetalle_pedido:iddetalle_pedido,
								cantidad_dividir:cantidad_dividir,
								no_control:no_control,
								idpg_detped:idpg_detped
							},function(data, status)
							{
							data = JSON.parse(data);

										var cant = $("#cant_prod_seg"+idpg_detped).val();
										var obs_enl = $("#obs_prod_seg"+idpg_detped).val();
										var estatus = $("#select_div"+idpg_detped).val();
										var estatus2 = $("#estatus_detped"+idpg_detped).text();

										if (estatus!="") {
											estatus = $("#select_div"+idpg_detped).val();
										}else{
											estatus = $("#estatus_detped"+idpg_detped).text();
										}
																																		//var estatus = "Existencia";
										var fecha=moment().format('YYYY-MM-DD');
										var hora=moment().format('HH:mm:ss');
										var fecha_hora=fecha+" "+hora;
										var id_ped_temp = idpg_pedidos

												$.post("ajax/diseno.php?op=guardar_det_ped",{idpg_detped:idpg_detped,cant:cant,obs_enl:obs_enl,estatus:estatus,fecha_hora:fecha_hora,id_ped_temp:id_ped_temp},function(data, status)
												{
												data = JSON.parse(data);

													var idpg_detalle_pedidos=iddetalle_pedido;

															$.post("ajax/list_pedidos.php?op=listar_pg_detped&id="+idpg_detalle_pedidos+"&idusuario="+idusuario,function(r){
																$("#tbl_detalle_prod_tbl").html(r);
																																				//$("#subtitulo_vale").text("VALE ACTUAL");
																	bootbox.alert("El producto se ha asignado al vale correctamente.");

																	$("#codigo_select_vale").text("");
																	$("#descrip_select_vale").text("");
																	$("#cantidad_select_vale").text("");

																	$("#iddetalle_pedido_select_vale").val("");
																	$("#idpg_detped_select_vale").val("");
																	$("#idpedido_select_vale").val("");

																	$("#datos_prod_add").hide();

																	listar_prod_select_vale();
																																				

															});

												});


									


							});
					}else{
						bootbox.alert("No se puede apartar el producto porque este codigo no existe en el almacén, verifique el producto y vuelva a intentar");
					}

																														//var cantidad_dividir = $("#cantidad_prod_vale").text();
						

					});


				}else{
					bootbox.alert("No se puede agregar al vale");
				}



		}else{
			bootbox.alert("Error al seleccionar el estatus, vuelva a intentarlo.")
		}

				


	}



	//var idpg_detped_vale = $("#idpg_detped_select_vale").val();
	
				
}




function edit_obs(idpg_detped,op)
{
	


	var estatus = $("#select_div"+idpg_detped).val();
	var estatus2 = $("#estatus_detped"+idpg_detped).text();

	if (estatus!="") {
		estatus = $("#select_div"+idpg_detped).val();
	}else{
		estatus = $("#estatus_detped"+idpg_detped).text();
	}

	if (estatus=="Produccion" && op>0) {

		
	}else{

		if (estatus=="Apartado") {

			var idpg_detped_vale = idpg_detped;
			$.post("ajax/list_pedidos.php?op=consul_idpg_detped_val",{idpg_detped_vale:idpg_detped_vale},function(data, status)
			{
			data = JSON.parse(data);

			var num_exist = data.num_exist;

				if (num_exist==0) {

					$("#eti_obs_prod"+idpg_detped).hide();
					$("#obs_prod_seg"+idpg_detped).show();
				}else{

				}

			});

		}else{
			$("#eti_obs_prod"+idpg_detped).hide();
			$("#obs_prod_seg"+idpg_detped).show();
		}

	}


	

}
function edit_obs_off(idpg_detped)
{
	$("#eti_obs_prod"+idpg_detped).show();
	$("#obs_prod_seg"+idpg_detped).hide();

	var obs_enl = $("#obs_prod_seg"+idpg_detped).val();
	$("#eti_obs_prod"+idpg_detped).text(obs_enl);

	/*$.post("ajax/diseno.php?op=guardar_observ_prod_enl",{idpg_detped:idpg_detped,obs_enl:obs_enl},function(data, status)
	{
	data = JSON.parse(data);

	});*/
	
}

function abrir_terminados()
{
	if (idusuario==26) {

		bootbox.alert("No tienes permisos para realizar esta acción.");
		
	}else{
		var lugar_user = $("#lugar_user").text();
		if (lugar_user=="Fabrica") {

			listar_terminados();

		}else{
			abrir_listos();
		}
	}

	

		

	/*$.post("ajax/diseno.php?op=listar_salidas",function(r){
	$("#box_salidas").html(r);		        
	});*/
	
}


function listar_terminados()
{
	//var variable = 1;
	$("#modal_terminados").modal("show");
	$("#modal_doc_ped").modal("hide");

	$.post("ajax/list_pedidos.php?op=abrir_terminados",function(r){
	$("#tbl_terminados").html(r);

			        
	});
}


function listar_pedido_detalle_term(idpg_pedidos)
{
	//alert(idpg_pedidos);

	$.post("ajax/list_pedidos.php?op=listar_pedido_detalle_term2&id="+idpg_pedidos,function(r){
	$("#tbl_pedido_detalle_term"+idpg_pedidos).html(r);

		$.post("ajax/diseno.php?op=listar_pedido_detalle_term_v&id="+idpg_pedidos,function(r){
		$("#tbl_pedido_detalle_term_v"+idpg_pedidos).html(r);

				        
		});

			        
	});


}

function abrir_pedido_notif(idpg_pedidos)
{
	
	var idusuario=$("#idusuario").text();
	

		
}


function abrir_docs(idpg_pedidos)
{
	$("#modal_doc_ped").modal("show");
	$("#modal_listos").modal("hide");
	$("#modal_terminados").modal("hide");
	$("#regresar_total").show();
	$("#regresar_listos").hide();

	$("#idpedido_doc").val(idpg_pedidos);

		$.post("ajax/diseno.php?op=abrir_doc_ped&id="+idpg_pedidos,function(r){
		$("#tbl_doc_ped").html(r);


				

		});		  
}


function cargar_doc()
{
	var idpedido = $("#idpedido_doc").val();
	var tipo_doc = $("#tipo_doc").val();
	var ar_comprob = $("#ar_comprob").val();

	var ar_comprob = ar_comprob.substr(12);

	$.post("ajax/diseno.php?op=consul_nom_arch",{idpedido:idpedido,ar_comprob:ar_comprob},function(data, status)
	{
		data = JSON.parse(data);

		//alert(data);
		var num_doc = data.num_doc;

		if (num_doc==0) {


			if (tipo_doc!="") {

										var parametros = new FormData($("#formulario-envia_comprobante")[0]);
										$.ajax({

												data: parametros,
												url: "ajax/diseno.php?op=guardar_comprobante",
												type: "POST",
												contentType: false,
												processData: false,
												beforesend: function(){

												},
												success: function(data, status){

														data = JSON.parse(data);

														var iddocumentos = data.iddocumentos;

														var tipo_doc = $("#tipo_doc").val();
														//alert(iddocumentos);

														$.post("ajax/diseno.php?op=marcar_tipo",{iddocumentos:iddocumentos,tipo_doc:tipo_doc},function(data, status)
														{
														data = JSON.parse(data);

															bootbox.alert("Documento guardado exitosamente");
															$("#tipo_doc").val("");
															$("#ar_comprob").val("");

															var idpg_pedidos = $("#idpedido_doc").val();											

															$.post("ajax/diseno.php?op=abrir_doc_ped&id="+idpg_pedidos,function(r){
															$("#tbl_doc_ped").html(r);

																$.post("ajax/list_pedidos.php?op=listar_documentos&id="+idpg_pedidos,function(r){
																	$("#box_documentos").html(r);

																});

															});	


														});
						
																									
												}

										});

			}else{
				bootbox.alert("Es necesario seleccionar el tipo de documento");
			}

		}else{
			bootbox.alert("El archivo ya existe, verifique el nombre o seleccione un archivo diferente");
		}

	});	



			

								
}


function cargar_notif()
{
	console.log("Entra a cargar_notif en list_pedidos");

	var idusuario=$("#idusuario").text();
	var lugar_user=$("#lugar_user").text();

	//$("#text_estatus").text("Cancelados");

	/*$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

		var lugar_user = data.lugar;*/


		if (lugar_user=='Fabrica') {

			$.post("ajax/diseno.php?op=cargar_notif",function(data, status)
			{
			data = JSON.parse(data);

				var num_notif = data.num_term;

				//alert(num_notif);

				if (num_notif>0) {

					//$("#notif_term").show();
					//$("#num_notif").show();

					$("#num_notif").text(num_notif);
				}

				

			});
		}else{


			$.post("ajax/diseno.php?op=cargar_notif_part",{lugar_user:lugar_user},function(data, status)
			{
			data = JSON.parse(data);

				var num_notif = data.num_notif;

				//alert(num_notif);

				if (num_notif>0) {

					

					$("#num_notif").text(num_notif);
				}

				

			});
		}

			

	//});



		
}

function pedidos_atencion()
{
	if (idusuario==26) {
		bootbox.alert("No tienes permisos para realizar esta acción.");
	}else{
		$("#modal_pedidos_atencion").modal("show");

		$.post("ajax/diseno.php?op=listar_sin_estatus",function(r){
				$("#tbl_pedidos_pendientes").html(r);

			//contar_prod_sinrev();

		});
	}

	

}

function contar_prod_sinrev()
{
			$.post("ajax/diseno.php?op=contar_prod_sinrev",function(data, status)
			{
			data = JSON.parse(data);
			//alert(data.num_sinrev);


			if (data.num_sinrev>0) {

				$("#num_notif_ped_sr").text(data.num_sinrev);
			}else{

			}
				$("#num_notif_ped_sr").text();
					
			});
}

function pedidos_vencidos()
{
	if (idusuario==26) {

		bootbox.alert("No tienes permisos para realizar esta acción.");
		
	}else{
		$("#modal_vencidos").modal("show");

		/*var dato_filtro = $("#dato_filtro").val();

		if (dato_filtro==undefined) {
			dato_filtro=0;
		}*/

		var dato_filtro=0;

		$.post("ajax/list_pedidos.php?op=pedidos_vencidos&id="+dato_filtro,function(r){
				$("#tbl_vencidos").html(r);

			
		});
	}
	
}


function pedidos_vencidos2()
{
	

	var dato_filtro = 0;

	$.post("ajax/diseno.php?op=pedidos_vencidos&id="+dato_filtro,function(r){
	        $("#tbl_vencidos").html(r);

	       
	});
}

function pedidos_vencidos3()
{
	

	var dato_filtro = 1;

	$.post("ajax/diseno.php?op=pedidos_vencidos&id="+dato_filtro,function(r){
	        $("#tbl_vencidos").html(r);

	       
	});
}


function update_coment_vencim(idpg_pedidos)
{
	var coment_vencim = $("#coment_vencim"+idpg_pedidos).val();

			$.post("ajax/diseno.php?op=update_coment_vencim",{idpg_pedidos:idpg_pedidos,coment_vencim:coment_vencim},function(data, status)
			{
			data = JSON.parse(data);


			});
}

function cont_num_vencidos()
{
			$.post("ajax/diseno.php?op=cont_num_vencidos",function(data, status)
			{
			data = JSON.parse(data);

			//alert(data);

			//alert(data.num_vencidos);

				if (data.num_vencidos>0) {

					$("#num_vencidos").text(data.num_vencidos);
				}else{
					$("#num_vencidos").text("");
				}
				//contar_sin_coment_venc();
					
			});


}

function filtro_option1()
{
	document.getElementById("btn_paginado").style.display="none";
	document.getElementById("btn_paginado2").style.display="none";
	//$("#estatus_tabla").val("1");

	// var estatus_tabla=1;
	$("#estatus_pedido").val("1");
	var idusuario=$("#idusuario").text();

	//$("#text_estatus").text("Sin entregar");

	$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

		var lugar = data.lugar;
		//alert(lugar);

		$.post("ajax/list_pedidos.php?op=listar_pedidos_v2&estatus="+estatus_tabla+"&idusuario="+idusuario+"&lugar="+lugar,function(r){
	    $("#div_lista_pedidos").html(r);

	    	var estatus = estatus_tabla;

	    	$.post("ajax/list_pedidos.php?op=contar_pedidos",{lugar:lugar,estatus:estatus},function(data, status)
			{
			data = JSON.parse(data);



					buscar_pedido_ini();
			    	

			});
	                     
	    });

	});

}
function filtro_option2()
{
	document.getElementById("btn_paginado").style.display="none";
	document.getElementById("btn_paginado2").style.display="none";
	estatus_tabla=2;
	$("#estatus_pedido").val("2");
	var idusuario=$("#idusuario").text();

	//$("#text_estatus").text("Listos para entrega");

	$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

		var lugar = data.lugar;
		//alert(lugar);

		$.post("ajax/list_pedidos.php?op=listar_pedidos_v2&estatus="+estatus_tabla+"&idusuario="+idusuario+"&lugar="+lugar,function(r){
	    $("#div_lista_pedidos").html(r);


	    	var estatus = estatus_tabla;

	    	$.post("ajax/list_pedidos.php?op=contar_pedidos",{lugar:lugar,estatus:estatus},function(data, status)
			{
			data = JSON.parse(data);

			

					buscar_pedido_ini();
			    	

			});
	                     
	    });

	});

}
function filtro_option3()
{
	document.getElementById("btn_paginado").style.display="none";
	document.getElementById("btn_paginado2").style.display="none";
	estatus_tabla=3;
	$("#estatus_pedido").val("3");
	var idusuario=$("#idusuario").text();

	//$("#text_estatus").text("Entregados");

	$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

		var lugar = data.lugar;
		//alert(lugar);

		$.post("ajax/list_pedidos.php?op=listar_pedidos_v2&estatus="+estatus_tabla+"&idusuario="+idusuario+"&lugar="+lugar,function(r){
	    $("#div_lista_pedidos").html(r);


	    	var estatus = estatus_tabla;

	    	$.post("ajax/list_pedidos.php?op=contar_pedidos",{lugar:lugar,estatus:estatus},function(data, status)
			{
			data = JSON.parse(data);


					buscar_pedido_ini();
			    	

			});
	                     
	    });

	});

}
function filtro_option4()
{
	document.getElementById("btn_paginado").style.display="none";
	document.getElementById("btn_paginado2").style.display="none";
	estatus_tabla=4;
	$("#estatus_pedido").val("4");
	var idusuario=$("#idusuario").text();

	//$("#text_estatus").text("Pendientes");

	$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

		var lugar = data.lugar;
		//alert(lugar);

		$.post("ajax/list_pedidos.php?op=listar_pedidos_v2&estatus="+estatus_tabla+"&idusuario="+idusuario+"&lugar="+lugar,function(r){
	    $("#div_lista_pedidos").html(r);

	    	var estatus = estatus_tabla;

	    	$.post("ajax/list_pedidos.php?op=contar_pedidos",{lugar:lugar,estatus:estatus},function(data, status)
			{
			data = JSON.parse(data);


					buscar_pedido_ini();
			  
			});
	                     
	    });

	});

}
function filtro_option5()
{
	document.getElementById("btn_paginado").style.display="none";
	document.getElementById("btn_paginado2").style.display="none";
	estatus_tabla=5;
	$("#estatus_pedido").val("5");
	var idusuario=$("#idusuario").text();

	//$("#text_estatus").text("Cancelados");

	$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

		var lugar = data.lugar;
		//alert(lugar);

		$.post("ajax/list_pedidos.php?op=listar_pedidos_v2&estatus="+estatus_tabla+"&idusuario="+idusuario+"&lugar="+lugar,function(r){
	    $("#div_lista_pedidos").html(r);

	    	var estatus = estatus_tabla;

	    	$.post("ajax/list_pedidos.php?op=contar_pedidos",{lugar:lugar,estatus:estatus},function(data, status)
			{
			data = JSON.parse(data);


					buscar_pedido_ini();
			    	

			});
	                     
	    });

	});

}


function filtro_option6()
{
	document.getElementById("btn_paginado").style.display="none";
	document.getElementById("btn_paginado2").style.display="none";
	estatus_tabla=0;
	$("#estatus_pedido").val("0");
	var idusuario=$("#idusuario").text();

	//$("#text_estatus").text("Todo");

	$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

		var lugar = data.lugar;
		//alert(lugar);

		$.post("ajax/list_pedidos.php?op=listar_pedidos_v2&estatus="+estatus_tabla+"&idusuario="+idusuario+"&lugar="+lugar,function(r){
	    $("#div_lista_pedidos").html(r);

	    	var estatus = estatus_tabla;

	    	$.post("ajax/list_pedidos.php?op=contar_pedidos",{lugar:lugar,estatus:estatus},function(data, status)
			{
			data = JSON.parse(data);



					buscar_pedido_ini();
			    

			});
	                     
	    });

	});

}


function listar_paginas()
{
	var estatus_tabla=0;
	var idusuario=$("#idusuario").text();

	//$("#text_estatus").text("Cancelados");

	/*$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

		var lugar = data.lugar;


		$.post("ajax/list_pedidos.php?op=contar_pedidos",{lugar:lugar},function(data, status)
		{
		data = JSON.parse(data);


			$("#cant_pedidos").text(data.num_pedidos);

			

		});			
		
	});*/
}

function abrir_listos()
{
	$("#modal_listos").modal("show");
	$("#modal_doc_ped").modal("hide");
	listar_listos();
	
}

function listar_listos()
{
	var idusuario=$("#idusuario").text();

	//$("#text_estatus").text("Cancelados");

	$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

		var lugar_user = data.lugar;

		$.post("ajax/diseno.php?op=listar_listos&id="+lugar_user,function(r){
		$("#tbl_listos").html(r);

				        
		});


	});	


		
}


function abrir_seg_ped()
{

	if (idusuario==26) {

		bootbox.alert("No tienes permisos para realizar esta acción");
		
	}else{

		$("#modal_seguim_ped").modal("show");

		//alert(idpg_pedidos);
		//alert(porc_avance);

		//$("#idpedido").val(idpg_pedidos);
		/*$("#porc_av_p").val(porc_avance);
		$("#coment_ped_motivo").val(coment_vencim);*/

		var idpedido = $("#idpedido").val();
		var idpg_pedidos = idpedido;

		//alert(idpedido);

			$.post("ajax/diseno.php?op=abrir_seg_ped&id="+idpg_pedidos,function(r){
			$("#tbl_seguim_ped").html(r);

				/*var dias_faltantes = $("#dias_restantes"+idpg_pedidos).text();

				if (dias_faltantes<0) {

					$("#btn_entregado").show();
				}else{
					$("#btn_entregado").show();
				}*/

			});	

	}

		  
}

function pasar_texto1()
{
	var coment_ped = $("#coment_ped_motivo").val();
	$("#color").val("0BF6BF");
	$("#coment_ped").val("ENTREGADO EN TIEMPO - "+coment_ped);
	$("#estatus").val("ENTREGADO");
	document.getElementById("coment_ped").disabled = false;

	var color_mustra = document.getElementById('color2');
	color_mustra.style.backgroundColor = '#0BF6BF';

	
}

function pasar_texto5()
{
	var coment_ped = $("#coment_ped_motivo").val();
	$("#color").val("7E0CA8");
	$("#coment_ped").val("ENTREGADO CON RETRASO - "+coment_ped);
	$("#estatus").val("ENTREGADO");
	document.getElementById("coment_ped").disabled = false;

	var color_mustra = document.getElementById('color2');
	color_mustra.style.backgroundColor = '#7E0CA8';

}

function pasar_texto9()
{
	var coment_ped = $("#coment_ped_motivo").val();
	$("#color").val("09A004");
	$("#coment_ped").val("LISTO PARA ENTREGA - "+coment_ped);
	$("#estatus").val("LISTO PARA ENTREGA");
	document.getElementById("coment_ped").disabled = false;

	var color_mustra = document.getElementById('color2');
	color_mustra.style.backgroundColor = '#09A004';
}

function pasar_texto6()
{
	var coment_ped = $("#coment_ped_motivo").val();
	$("#color").val("BF0E13");
	$("#coment_ped").val("CANCELADO - "+coment_ped);
	$("#estatus").val("CANCELADO");
	document.getElementById("coment_ped").disabled = false;

	var color_mustra = document.getElementById('color2');
	color_mustra.style.backgroundColor = '#BF0E13';
}

function pasar_texto7()
{
	var coment_ped = $("#coment_ped_motivo").val();
	$("#color").val("FFFFFF");
	$("#coment_ped").val("");
	$("#estatus").val("PENDIENTE - "+coment_ped);
	document.getElementById("coment_ped").disabled = false;

	var color_mustra = document.getElementById('color2');
	color_mustra.style.backgroundColor = '#FFFFFF';

}

function guardar_coment_ped()
{
	var idpedido = $("#idpedido").val();
	var idusuario=$("#idusuario").text();
	var color_barra_s = $("#color_barra_s"+idpedido).text();
	//alert(color_barra_s);
	var porc_av_p = $("#porc_av_p").val();
	var dias_restantes = $("#dias_restantes"+idpedido).text();
	//alert(dias_restantes);
	var coment = $("#coment_ped").val();
	var color = $("#color").val();
	var estatus = $("#estatus").val();
	

	var fecha1=moment().format('YYYY-MM-DD');
	var hora_hoy=moment().format('HH:mm:ss');

	var fecha = fecha1+" "+hora_hoy;



	if (idusuario==4 || idusuario==1) {

		if (coment!="") {


			if (estatus=="ENTREGADO" || estatus=="LISTO PARA ENTREGA") {

				$.post("ajax/diseno.php?op=contar_estatus_ped",{idpedido:idpedido},function(data, status)
				{
					data = JSON.parse(data);

					//alert(data);

					if (data!=null) {

						/*alert(data.cant_tot);
						alert(data.cant_estatus);*/

						if (parseInt(data.cant_estatus)>=parseInt(data.cant_tot)) {


							$.post("ajax/diseno.php?op=consul_exist_notif",{idpedido:idpedido},function(data, status)
							{
								data = JSON.parse(data);

								var num_pedido = data.num_pedido;


								$.post("ajax/diseno.php?op=guardar_coment_ped",{coment:coment,color:color,idpedido:idpedido,fecha:fecha,estatus:estatus,color_barra_s:color_barra_s,porc_av_p:porc_av_p,dias_restantes:dias_restantes,idusuario:idusuario,num_pedido:num_pedido},function(data, status)
								{
								data = JSON.parse(data);

									$.post("ajax/diseno.php?op=abrir_seg_ped&id="+idpedido,function(r){
									$("#tbl_seguim_ped").html(r);

									//listar_pedidos();
									$("#estatus_ped"+idpedido).text(estatus);

									var estatus_ped = document.getElementById('estatus_ped'+idpedido);
									estatus_ped.style.color = "#"+color;

									$("#btn_estatus_ped").text(estatus);


									});	

								});


							});


						}else{


							bootbox.alert("No se puede marcar realizar este cambio de estatus porque el pedido tiene productos sin procesar");

						}
					}

				});

			}else{

							$.post("ajax/diseno.php?op=consul_exist_notif",{idpedido:idpedido},function(data, status)
							{
								data = JSON.parse(data);

								var num_pedido = data.num_pedido;


								$.post("ajax/diseno.php?op=guardar_coment_ped",{coment:coment,color:color,idpedido:idpedido,fecha:fecha,estatus:estatus,color_barra_s:color_barra_s,porc_av_p:porc_av_p,dias_restantes:dias_restantes,idusuario:idusuario,num_pedido:num_pedido},function(data, status)
								{
								data = JSON.parse(data);

									$.post("ajax/diseno.php?op=abrir_seg_ped&id="+idpedido,function(r){
									$("#tbl_seguim_ped").html(r);

									//listar_pedidos();
									$("#estatus_ped"+idpedido).text(estatus);

									var estatus_ped = document.getElementById('estatus_ped'+idpedido);
									estatus_ped.style.color = "#"+color;

									$("#btn_estatus_ped").text(estatus);


									});	

								});


							});

			}
		}else{
			bootbox.alert("Es neesario seleccionar un estatus");
		}


			


			


						

	}else{
		bootbox.alert("No tienes permiso para realizar esta acción");
	}
		

}


function abrir_documentos()
{
	if (idusuario!=26) {
			//$("#modal_doc_ped").modal("show");
			var idpg_pedidos = $("#idpedido").val();

			$("#modal_doc_ped").modal("show");
			$("#modal_listos").modal("hide");
			$("#modal_terminados").modal("hide");
			$("#regresar_total").show();
			$("#regresar_listos").hide();
	
			$("#idpedido_doc").val(idpg_pedidos);
	
				$.post("ajax/diseno.php?op=abrir_doc_ped&id="+idpg_pedidos,function(r){
				$("#tbl_doc_ped").html(r);
	
	
						
	
				});	
	}
	
}





function abrir_edit_observ()
{
	$("#modal_observ").modal("show");
}


function abrir_chat()
{
	$("#boton_down").hide();
	var idped_marca = $("#idped_marca").val();

	if (idped_marca==0) {
		$("#idped_marca").val("1");
		listar_chat_ini();
		
	}else{
		if (idped_marca==1) {
			$("#idped_marca").val("0");
		}
	}

	
}

function listar_chat_ini()
{
	var idusuario = $("#idusuario").text();
	var idpedido = $("#idpedido_header").val();

		$.post("ajax/list_pedidos.php?op=buscar_control",{idpedido:idpedido},function(data, status)
		{
		data = JSON.parse(data);

			$("#titulo_control_chat").text("CONTROL: "+data.no_control);

			$.post("ajax/list_pedidos.php?op=listar_chat&idpedido="+idpedido+"&idusuario="+idusuario,function(r){
			$("#box_chat").html(r);
				
				var elem = document.getElementById('box_chat');
				elem.scrollTop = elem.scrollHeight;
				$("#num_scroll").val(parseInt(elem.scrollTop));
				$("#num_scroll2").val(parseInt(elem.scrollTop));

			});
			
		});		
		
}


function set_fecha_hora_entr()
{
	var fecha_entrega_etiq = $("#fecha_entrega").text();
	var idusuario=$("#idusuario").text();

	if (fecha_entrega_etiq=="" || idusuario==1) {

		var fecha_entrega_upd2 = $("#fecha_entrega_upd2").val();
		var hora_entrega_upd2 = $("#hora_entrega_upd2").val();
		var hora_entrega_upd2_2 = $("#hora_entrega_upd2_2").val();
		var id_ped_temp = $("#idpedido").val();

		//alert(id_ped_temp);

		var fecha=moment().format('YYYY-MM-DD');
		var hora=moment().format('HH:mm:ss');
		var fecha_hora=fecha+" "+hora;
		var idusuario=$("#idusuario").text();

		/*alert(fecha_entrega_upd2);
		alert(hora_entrega_upd2);
		alert(hora_entrega_upd2_2);*/

		if (idusuario==4 || idusuario==1) {
			$.post("ajax/diseno.php?op=set_fecha_hora_entr",{id_ped_temp:id_ped_temp,fecha_entrega_upd2:fecha_entrega_upd2,hora_entrega_upd2:hora_entrega_upd2,hora_entrega_upd2_2:hora_entrega_upd2_2,fecha_hora:fecha_hora,idusuario:idusuario},function(data, status)
			{
			data = JSON.parse(data);

				/*var notificator = new Notification(document.querySelector('.notification'));
				notificator.info('Dato actualizado correctamente');*/


					bootbox.alert({
					    message: "Datos de entrega actualizados correctamente.",
					    callback: function () {
					        //location.reload();
					        $(location).attr("href","list_pedidos.php?pedido="+id_ped_temp);
					    }
					})




			});
		}else{
			bootbox.alert("No tiene permisos para realizar esta acción");
		}
	}else{
		bootbox.alert("Solicitar esta modificación con el administrador del sistema");
	}

		
	
		

}


function det_term()
{

	$.post("ajax/diseno.php?op=consul_idpgpedidos",function(data, status)
	{
		data = JSON.parse(data);

		var id = data.idmin;
		var id2 = data.idmax;

		var fecha=moment().format('YYYY-MM-DD');
		var hora=moment().format('HH:mm:ss');
		var fecha_hora=fecha+" "+hora;

		//alert(id+" "+id2);

		$.post("ajax/diseno.php?op=det_term",{id:id,id2:id2,fecha_hora:fecha_hora},function(data, status)
		{
			data = JSON.parse(data);

			//alert("ok");

		});

	});


		
}




function revisar_sinfecha()
{
	var idusuario=$("#idusuario").text();

	$.post("ajax/diseno.php?op=revisar_sinfecha",function(data, status)
	{
		data = JSON.parse(data);

		if ((data.num_sinfecha>0 && idusuario==4) || (data.num_sinfecha>0 && idusuario==1) || (data.num_sinfecha>0 && idusuario==5) || (data.num_sinfecha>0 && idusuario==7) || (data.num_sinfecha>0 && idusuario==8) || (data.num_sinfecha>0 && idusuario==9) || (data.num_sinfecha>0 && idusuario==10) || (data.num_sinfecha>0 && idusuario==11) || (data.num_sinfecha>0 && idusuario==12) || (data.num_sinfecha>0 && idusuario==14) || (data.num_sinfecha>0 && idusuario==23)) {




			/*toastrs();

			function toastrs() {
			  if (!showToastrs) {
			    toastr.error('Para un mejor seguimiento es necesario asignar fechas de entrega en todos los pedidos.',+data.num_sinfecha+' pedidos sin fecha de entrega!');
			    
			  } 
			}*/






			//bootbox.alert(data.num_sinfecha+" pedidos no tienen fecha_entrega, para un mejor seguimiento es necesario asignar fecha de entrega");
		}

	});
}



/*toastr.options = {
  "debug": false,
  "positionClass": "toast-bottom-right",
  "onclick": null,
  "fadeIn": 300,
  "fadeOut": 100,
  "timeOut": 5000,
  "extendedTimeOut": 1000
}*/

//var showToastrs = false;





function contar_sin_coment_venc()
{
			$.post("ajax/diseno.php?op=contar_sin_coment_venc",function(data, status)
			{
			data = JSON.parse(data);



				if (data.num_vencidos_sincoment>0) {

					var idusuario=$("#idusuario").text();

					if (idusuario==4 || idusuario==1 || idusuario==5 || idusuario==7 || idusuario==8 || idusuario==9 || idusuario==10 || idusuario==11 || idusuario==12 || idusuario==14 || idusuario==23) {


						/*function toastrs() {
						  if (!showToastrs) {
						    toastr.warning('Capturar motivos pendientes',+ data.num_vencidos_sincoment+' Pedidos sin motivo de retraso!');
						    //toastr.warning('La latencia del server esta aumentando.', 'Alerta!');
						  } 
						}
						toastrs();*/


						//bootbox.alert("Pedidos con retraso: Capturar motivos pendientes");
					}

					
				}
					
			});
}



function abrir_modal_doc_salidas()
{
	if (idusuario!=26) {
		$("#modal_salidas_pedidos").modal("show");

		var idpg_pedidos = $("#idpedido_header").val();
		var fecha=moment().format('YYYY-MM-DD');

		if (idpg_pedidos>0) {
			$.post("ajax/list_pedidos.php?op=abrir_doc_salidas&idpg_pedidos="+idpg_pedidos+"&fecha="+fecha,function(r){
			$("#tbl_salidas_pedido").html(r);

		
			});	
		}else{
			bootbox.alert("Error al mostrar salidas del pedido");
		}
	}

	

		
}






function abrir_vale()
{
	var idusuario = $("#idusuario").text();

	if (idusuario==26) {
		bootbox.alert("No tienes permisos para realizar esta acción.");
	}else{
		$("#datos_enc_vale").hide();
		$("#btns_vale").hide();
		$("#modal_vale_alm").modal("show");

		var estatus_vale_alm = $("#estatus_vale_alm").val();
		$.post("ajax/list_pedidos.php?op=listar_vales_alm&estatus="+estatus_vale_alm,function(r){
			$("#box_vales_salida").html(r);
			$.post("ajax/list_pedidos.php?op=listar_vale&id="+0,function(r){
			$("#tbl_productos_vale").html(r);

			});
		});
	}

	

}

function abrir_vale_alm()
{
	//var idusuario = $("#idusuario").text();

		//var idsalida = $("#idsalida").val();

	//alert(idusuario);
	//alert(idvales_almacen);
	var idvales_almacen = $("#idvales_almacen").val();

			$("#enlace_vale_alm").attr("href","reportes/valeSalidaAlm.php?id="+idvales_almacen);
		
			//bootbox.alert("Es necesario seleccionar un salida");
		
	

}


function ver_vale(idvales_almacen)
{
	$("#idvales_almacen").val(idvales_almacen);

	$.post("ajax/list_pedidos.php?op=consul_datos_vale",{idvales_almacen:idvales_almacen},function(data, status)
	{
	data = JSON.parse(data);

		$("#num_vale_c").text(data.no_vale);

		if (data.estatus==0) {
			var estatus = "Abierto";
			document.getElementById('btn_solic_vale').disabled = false;
			//document.getElementById('enlace_vale_alm').disabled = true;
			$("#enlace_vale_alm").hide();
			document.getElementById('btn_borrar_vale').disabled = false;
			document.getElementById('btn_archivar_vale').disabled = true;
			document.getElementById('check_prio').disabled = false;
		}
		if (data.estatus==1) {
			var estatus = "Solicitado";
			document.getElementById('btn_solic_vale').disabled = true;
			//document.getElementById('enlace_vale_alm').disabled = true;
			$("#enlace_vale_alm").hide();
			document.getElementById('btn_borrar_vale').disabled = true;
			document.getElementById('btn_archivar_vale').disabled = true;
			document.getElementById('check_prio').disabled = true;
		}
		if (data.estatus==2) {
			var estatus = "Surtido";
			document.getElementById('btn_solic_vale').disabled = true;
			//document.getElementById('enlace_vale_alm').disabled = false;
			$("#enlace_vale_alm").show();
			document.getElementById('btn_borrar_vale').disabled = true;
			document.getElementById('btn_archivar_vale').disabled = false;
			document.getElementById('check_prio').disabled = true;
		}
		if (data.estatus==4) {
			var estatus = "Archivado";
			document.getElementById('btn_solic_vale').disabled = true;
			//document.getElementById('enlace_vale_alm').disabled = false;
			$("#enlace_vale_alm").show();
			document.getElementById('btn_borrar_vale').disabled = true;
			document.getElementById('btn_archivar_vale').disabled = true;
			document.getElementById('check_prio').disabled = true;
		}
		if (data.estatus==6) {
			var estatus = "Rechazado";
			document.getElementById('btn_solic_vale').disabled = true;
			//document.getElementById('enlace_vale_alm').disabled = true;
			$("#enlace_vale_alm").hide();
			document.getElementById('btn_borrar_vale').disabled = true;
			document.getElementById('btn_archivar_vale').disabled = true;
			document.getElementById('check_prio').disabled = true;
		}

		$("#estatus_vale_c").text(estatus);
		$("#fecha_reg_c").text(data.fecha_hora_reg);
		$("#fecha_solic_c").text(data.fecha_hora_solic);
		$("#fecha_surt_c").text(data.fecha_hora_surt);

		if (data.prioridad==1) {
			document.getElementById('check_prio').checked = true;
		}
		if (data.prioridad==0) {
			document.getElementById('check_prio').checked = false;
		}

		$("#datos_enc_vale").show();
		$("#btns_vale").show();


		//$("#idvales_almacen").val(idvales_almacen);
		$.post("ajax/list_pedidos.php?op=listar_vale&id="+idvales_almacen,function(r){
		$("#tbl_productos_vale").html(r);
			
		});

	});
}


function solicitar_vale()
{
	var idvales_almacen = $("#idvales_almacen").val();

	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

				$.post("ajax/list_pedidos.php?op=consul_num_prod_vale",{idvales_almacen:idvales_almacen},function(data, status)
				{
				data = JSON.parse(data);

					var num_prod_vale = data.num_prod_vale;

					if (num_prod_vale>0) {


							$.post("ajax/list_pedidos.php?op=solicitar_vale",{idvales_almacen:idvales_almacen,fecha_hora:fecha_hora},function(data, status)
							{
							data = JSON.parse(data);

									var estatus_vale_alm = $("#estatus_vale_alm").val();
									$.post("ajax/list_pedidos.php?op=listar_vales_alm&estatus="+estatus_vale_alm,function(r){
										$("#box_vales_salida").html(r);

										$.post("ajax/list_pedidos.php?op=listar_vale&id="+0,function(r){
										$("#tbl_productos_vale").html(r);

											bootbox.alert("Vale solicitado exitosamente");	
											
										});


									});					
														
							});


					}else{
						bootbox.alert("No se han agregado productos al vale actual");
					}

				});

}

function borrar_vale()
{

	var idvales_almacen = $("#idvales_almacen").val();

					bootbox.confirm({
					    message: "¿Esta seguro de borrar este vale?, todos los estatus de apartado serán borrados.",
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
					        //console.log('This was logged in the callback: ' + result);

					        //alert(result);


					        if (result==true) {	
						
					        	

								$.post("ajax/list_pedidos.php?op=borrar_vale",{idvales_almacen:idvales_almacen},function(data, status)
								{
									data = JSON.parse(data);

										$.post("ajax/list_pedidos.php?op=buscar_prod_vale&idvales_almacen="+idvales_almacen,function(r){
										$("#resum_acciones").html(r);


											var estatus_vale_alm = $("#estatus_vale_alm").val();
											$.post("ajax/list_pedidos.php?op=listar_vales_alm&estatus="+estatus_vale_alm,function(r){
											$("#box_vales_salida").html(r);


												$.post("ajax/list_pedidos.php?op=listar_vale&id="+0,function(r){
												$("#tbl_productos_vale").html(r);

													bootbox.alert("Vale borrado exitosamente");

																
												});


											});

										});
											

								});

								

							}

					    }
					});




								
			
}

function archivar_vale()
{
	var idvales_almacen = $("#idvales_almacen").val();

	$.post("ajax/list_pedidos.php?op=archivar_vale",{idvales_almacen:idvales_almacen},function(data, status)
	{
		data = JSON.parse(data);

			$.post("ajax/list_pedidos.php?op=buscar_prod_vale&idvales_almacen="+idvales_almacen,function(r){
			$("#resum_acciones").html(r);


				var estatus_vale_alm = $("#estatus_vale_alm").val();
				$.post("ajax/list_pedidos.php?op=listar_vales_alm&estatus="+estatus_vale_alm,function(r){
				$("#box_vales_salida").html(r);


					$.post("ajax/list_pedidos.php?op=listar_vale&id="+0,function(r){
					$("#tbl_productos_vale").html(r);

						bootbox.alert("Vale archivado exitosamente");

									
					});


				});

			});
				

	});
			
}

function nuevo_vale()
{
	$.post("ajax/list_pedidos.php?op=consul_no_vale",function(data, status)
	{
		data = JSON.parse(data);
		var no_vale = parseInt(data.no_vale)+1;
		var fecha=moment().format('YYYY-MM-DD');
		var hora=moment().format('HH:mm:ss');
		var fecha_hora=fecha+" "+hora;

		var idusuario = $("#idusuario").text();

			$.post("ajax/list_pedidos.php?op=guardar_vale",{no_vale:no_vale,fecha_hora:fecha_hora,idusuario:idusuario},function(data, status)
			{
				data = JSON.parse(data);

				var estatus_vale_alm = $("#estatus_vale_alm").val();
				$.post("ajax/list_pedidos.php?op=listar_vales_alm&estatus="+estatus_vale_alm,function(r){
					$("#box_vales_salida").html(r);

					$.post("ajax/list_pedidos.php?op=listar_vale&id="+0,function(r){
					$("#tbl_productos_vale").html(r);
						bootbox.alert("Vale creado exitosamente");
						
					});


				});


			});


	});

																			
																			
																			
}

function quitar_prod_vale(idvale_salida,idvales_almacen,idpg_detped)
{

	bootbox.confirm({
	    message: "¿Desea quitar este producto del vale actual?",
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

	        	$.post("ajax/list_pedidos.php?op=quitar_prod_vale",{idvale_salida:idvale_salida,idpg_detped:idpg_detped},function(data, status)
				{
				data = JSON.parse(data);

					$.post("ajax/list_pedidos.php?op=listar_vale&id="+idvales_almacen,function(r){
					$("#tbl_productos_vale").html(r);

						bootbox.alert("Producto borrado del vale exitosamente");

					});

				});

	        }		       

	    }
	});
			
}


function reingresar_prod_vale(idvale_salida)
{
	var idusuario=$("#idusuario").text();

	if (idusuario==1 || idusuario==4) {


		bootbox.confirm({
		    message: "¿Desea reingresar este producto al almacén?",
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


					var fecha=moment().format('YYYY-MM-DD');
					var hora=moment().format('HH:mm:ss');
					var fecha_hora=fecha+" "+hora;

		        	$.post("ajax/list_pedidos.php?op=reingresar_prod_vale",{idvale_salida:idvale_salida,fecha_hora:fecha_hora},function(data, status)
					{
					data = JSON.parse(data);

						var idalmacen_pt_ed = data.idalmacen_pt_ed;


						//$.post("ajax/list_pedidos.php?op=guardar_lote_reingreso&idvale_salida="+idvale_salida+"&idalmacen_pt_ed="+idalmacen_pt_ed,function(r){
						//$("#tbl_productos_vale").html(r);

							$.post("ajax/list_pedidos.php?op=listar_vale&id="+idvales_almacen,function(r){
							$("#tbl_productos_vale").html(r);

								bootbox.alert("Producto reingresado exitosamente");

							});

						//});	

					});

		        }		       

		    }
		});


	}

		
			
}


function listar_vales_estatus()
{
	var estatus_vale_alm = $("#estatus_vale_alm").val();
	$.post("ajax/list_pedidos.php?op=listar_vales_alm&estatus="+estatus_vale_alm,function(r){
		$("#box_vales_salida").html(r);
		$.post("ajax/list_pedidos.php?op=listar_vale&id="+0,function(r){
		$("#tbl_productos_vale").html(r);

		});
	});
}



function estab_prior()
{
	var idvales_almacen = $("#idvales_almacen").val();
	var check = document.getElementById("check_prio").checked;

	if (check==true) {
		var prioridad = 1;
	}
	if (check==false) {
		var prioridad = 0;
	}

	$.post("ajax/list_pedidos.php?op=estab_prior",{idvales_almacen:idvales_almacen,prioridad:prioridad},function(data, status)
	{
		data = JSON.parse(data);				

	});

	
}


function edit_cant_total()
{
	var iddetalle_pedido=$("#iddetalle_pedido").val();
	var idusuario=$("#idusuario").text();

	if (idusuario==1) {

		bootbox.prompt({
		    title: "Nueva cantidad", 
		    centerVertical: true,
		    callback: function(result){

		    	if (result>0) {

		    		var cantidad_nueva = result;
		        
			        $.post("ajax/list_pedidos.php?op=edit_cant_total",{iddetalle_pedido:iddetalle_pedido,cantidad_nueva:cantidad_nueva},function(data, status)
					{
						data = JSON.parse(data);

						bootbox.alert("Cantidad actualizada correctamente");			

					});

		    	}

		    		
		    }
		});
	}

	
}

function abrir_modal_fecha_modif()
{
	if (idusuario!=26) {
		$("#modal_fecha_prod").modal("show");
	}
	
}


function edit_observ_total()
{
	var iddetalle_pedido = $("#iddetalle_pedido").val();

	$("#modal_observ_iddetalle_ped").modal("show");

					$.post("ajax/list_pedidos.php?op=edit_observ_total",{iddetalle_pedido:iddetalle_pedido},function(data, status)
					{
						data = JSON.parse(data);

							$("#observ_modal_edit").val(data.observacion);		

					});

	//alert(iddetalle_pedido);
}

function edit_observ_total2()
{
	var iddetalle_pedido=$("#iddetalle_pedido").val();
	var idusuario=$("#idusuario").text();
	var observacion = $("#observ_modal_edit").val();

	if (idusuario==1) {

	
		        
			        $.post("ajax/list_pedidos.php?op=edit_observ_total2",{iddetalle_pedido:iddetalle_pedido,observacion:observacion},function(data, status)
					{
						data = JSON.parse(data);

						bootbox.alert("Observación actualizada correctamente");			

					});

		    	
	}else{
		bootbox.alert("Necesita autorización para realizar esta acción");
	}

	
}

function borrar_documento(iddocumentos,idpedido)
{

	bootbox.confirm({
	    message: "¿Desea borrar este documento?",
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

	         	$.post("ajax/list_pedidos.php?op=borrar_documento",{iddocumentos:iddocumentos},function(data, status)
				{
					data = JSON.parse(data);

					bootbox.alert("Documento borrado correctamente");

							$.post("ajax/list_pedidos.php?op=listar_documentos&id="+idpedido,function(r){
							$("#box_documentos").html(r);

							
							       
							});

				});
	         }
	    }
	});



				
}





init();