function init()
{
	cargar_ops();
	
	$("#div_detalle_op").hide();
	$("#div_detalle_prod").hide();
	$("#div_detalle_prod_av").hide();
}

function cargar_ops()
{
	//alert("entra");
	$("#op_buscar_area").val("");
	$("#num_vista").val("0");
	var idusuario = $("#idusuario").text();
	//alert(idusuario);

	$.post("ajax/produccion.php?op=consultar_area",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

		$("#nom_area").text(data.nombre);
		$("#id_area").text(data.idarea);

		$.post("ajax/produccion.php?op=cargar_ops&idusuario="+idusuario,function(r){
		$("#box_ops").html(r);

		});

	});

		
}

/*function buscar_op_area()
{
	var idusuario = $("#idusuario").text();
	var op_buscar_area = $("#op_buscar_area").val();

	

		$.post("ajax/produccion.php?op=cargar_ops_buscar&idusuario="+idusuario+"&op="+op_buscar_area,function(r){
		$("#box_ops").html(r);

		});


}*/


function buscar2()
{
	var idusuario = $("#idusuario").text();
	var op_buscar_area = $("#op_buscar_area").val();

		$.post("ajax/produccion.php?op=buscar2&idusuario="+idusuario+"&no_op="+op_buscar_area,function(r){
		$("#box_ops").html(r);

		});

}




function ver_productos(idop_detalle,no_op,idop,area,cant_tot,avance,area_fin)
{
	$("#num_vista").val("1");
	$("#box_ops").hide();
	$("#box_ops_detalle").show();
	$("#div_detalle_op").show();
	$("#div_detalle_prod").hide();
	$("#div_detalle_prod_av").hide();

	$("#no_op_enc").text(no_op);
	$("#cant_tot_enc").text(cant_tot);
	$("#avance_tot_enc").text(avance);
	$("#idop_detalle").val(idop_detalle);
	$("#idop").val(idop);
	$("#area_fin").val(area_fin);

		$.post("ajax/produccion.php?op=ver_productos&idop="+idop+"&area="+area,function(r){
		$("#box_ops_detalle").html(r);

		});
}

function regresar_a_prod()
{

	var num_vista = $("#num_vista").val();

	if (num_vista==2) {

		$("#num_vista").val("1");
		$("#box_ops_detalle").show();
		$("#div_detalle_op").show();
		$("#div_detalle_prod").hide();
		$("#div_detalle_prod_av").hide();
		$("#idop_detalle_prod").val("");

			$("#codigo_enc").text("");
			$("#descrip_enc").text("");
			
			$("#cant_enc").text("");
			$("#avance_enc").text("");
			$("#no_control_enc").text("");

			$("#idpedido").val("");
			$("#iddetalle_pedido").val("");

			//alert(idpg_detped);
			$("#idpg_detped_av").val("");

			$("#cant_ingresar_enc").val("");
			$("#cant_ingresar_enc_exc").val("");
			$("#lote").val("");
			$("#marca_capt_cant").val("");
			$("#coment_avance").val("");
			$("#btn_guardar_avance").hide();

	}

	if (num_vista==1) {

		$("#num_vista").val("0");
		$("#box_ops").show();
		$("#box_ops_detalle").hide();
		$("#div_detalle_op").hide();
		$("#div_detalle_prod").hide();
		$("#div_detalle_prod_av").hide();
		$("#no_op_enc").text("");
		$("#cant_tot_enc").text("");
		$("#avance_tot_enc").text("");
		$("#idop_detalle").val("");
		$("#idop").val("");
		$("#area_fin").val("");

	}

		
		
}

function ver_productos_detalle(idop_detalle_prod,area,area_fin)
{
	$("#num_vista").val("2");
	$("#box_ops_detalle").hide();
	$("#div_detalle_op").show();
	$("#div_detalle_prod").show();
	$("#div_detalle_prod_av").show();
	$("#idop_detalle_prod").val(idop_detalle_prod);
	
	$("#btn_guardar_avance").hide();


	

	$.post("ajax/produccion.php?op=consultar_idop_detalle_prod",{idop_detalle_prod:idop_detalle_prod,area:area},function(data, status)
	{
	data = JSON.parse(data);

		$("#codigo_enc").text(data.codigo);
		$("#descrip_enc").text(data.producto);
		
		$("#cant_enc").text(data.cant_tot);
		$("#avance_enc").text(data.avance);
		$("#no_control_enc").text(data.no_control);
		$("#idpedido").val(data.idpedido);
		$("#iddetalle_pedido").val(data.iddetalle_pedido);

		//alert(idpg_detped);
		$("#idpg_detped_av").val(data.idpg_detped);

		var cant_tot = data.cant_tot;
		var avance =data.avance;

		if (cant_tot==avance) {
			$("#cant_ingresar_div").hide();
			$("#exc_ingresar_div").show();
			$("#marca_capt_cant").val("2");
			$("#btn_guardar_avance").show();
		}else{
			$("#cant_ingresar_div").show();
			$("#exc_ingresar_div").hide();
			$("#marca_capt_cant").val("1");
		}

	});

		
}

function calcular_avance()
{
	var cant_ingresar_enc = $("#cant_ingresar_enc").val();
	var avance = $("#avance_enc").text();
	var cant_total = $("#cant_enc").text();

	var avance_nuevo = parseInt(cant_ingresar_enc)+parseInt(avance);

	if (cant_ingresar_enc>0) {

		if (avance_nuevo<=cant_total) {
			//alert("Se guardara");
			$("#btn_guardar_avance").show();
			document.getElementById("btn_guardar_avance").disabled = false;
			
		}else{
			alert("Cantidad invalida");
			$("#cant_ingresar_enc").val("0");

		}

	}else{
		alert("Cantidad invalida");
		$("#cant_ingresar_enc").val("0");
	}
		

}


function guardar_avance()
{
	
	document.getElementById("btn_guardar_avance").disabled = true;
	var idop_detalle = $("#idop_detalle").val();
	var idop_detalle_prod = $("#idop_detalle_prod").val();
	var cant_ingresar_enc = $("#cant_ingresar_enc").val();
	var cant_ingresar_enc_exc = $("#cant_ingresar_enc_exc").val();
	var avance = $("#avance_enc").text();
	/*if (avance>0 && cant_ingresar_enc>0) {
		var avance_nuevo = parseInt(cant_ingresar_enc)+parseInt(avance);

	}else{

		var avance = 0;
		var cant_ingresar_enc=0;
		var avance_nuevo = parseInt(cant_ingresar_enc)+parseInt(avance);
	}*/

	var avance_nuevo = parseInt(cant_ingresar_enc)+parseInt(avance);
	
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var idarea = $("#id_area").text();
	var idpedido = $("#idpedido").val();
	var iddetalle_pedido = $("#iddetalle_pedido").val();
	var lote = $("#lote").val();
	var coment_avance = $("#coment_avance").val();	
	var idop = $("#idop").val();
	var cant_areas = $("#cant_areas").text();
	var cant_total = $("#cant_enc").text();
	var area_fin = $("#area_fin").val();

	//alert(area_fin);
	//alert(avance_nuevo);

	if (area_fin==idarea) {

		if (avance_nuevo>0) {

			if (avance_nuevo==cant_total) {
				var estatus = "Fabricado";
			}

			if (avance_nuevo<cant_total) {
				var estatus = "Produccion";
			}

		}else{
			var estatus = "Produccion";
		}

		
			
	}else{
		var estatus = "Produccion";
	}

	//alert(estatus);

		
	var idpg_detped = $("#idpg_detped_av").val();
	var marca_capt_cant = $("#marca_capt_cant").val();


	/*alert(idop_detalle_prod);
	alert(cant_ingresar_enc_exc);
	alert(avance_nuevo);
	alert(fecha_hora);
	alert(idarea);
	alert(idpedido);
	alert(iddetalle_pedido);
	alert(lote);
	alert(coment_avance);
	alert(idop);
	alert(cant_areas);
	alert(cant_total);
	alert(estatus);
	alert(idpg_detped);
	alert(marca_capt_cant);
	alert(area_fin);*/
	//alert(area_fin);
	
	

		if (lote!="") {

			if (marca_capt_cant>0) {

				//alert("entra a guardar");

				$.post("ajax/produccion.php?op=guardar_avance_prod",{
					idop_detalle:idop_detalle,
					idop_detalle_prod:idop_detalle_prod,
					avance_nuevo:avance_nuevo,
					fecha_hora:fecha_hora,
					idarea:idarea,
					idpedido:idpedido,
					iddetalle_pedido:iddetalle_pedido,
					lote:lote,
					coment_avance:coment_avance,
					cant_ingresar_enc:cant_ingresar_enc,
					cant_ingresar_enc_exc:cant_ingresar_enc_exc,
					idop:idop,
					estatus:estatus,
					idpg_detped:idpg_detped,
					marca_capt_cant:marca_capt_cant
				},function(data, status)
				{
				data = JSON.parse(data);


					//var idavance_prod = data.idavance_prod;

					//alert(idavance_prod);
					

					var area = idarea;

					$.post("ajax/produccion.php?op=ver_productos&idop="+idop+"&area="+area,function(r){
					$("#box_ops_detalle").html(r);

					var idusuario = $("#idusuario").text();

					$.post("ajax/produccion.php?op=cargar_ops&idusuario="+idusuario,function(r){
					$("#box_ops").html(r);

						regresar_a_prod();
						bootbox.alert("Registro guardado exitosamente");
						document.getElementById("btn_guardar_avance").disabled = false;

					});


					});

					


				});

			}else{
				bootbox.alert("No se pudo guardar, por favor vuelva a intentar");
				document.getElementById("btn_guardar_avance").disabled = false;
			}



		}else{
			bootbox.alert("Es necesario capturar el numero de lote");
			document.getElementById("btn_guardar_avance").disabled = false;
		}
	

		


		
}




init();