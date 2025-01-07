function init()
{
	// location.href ="https://pgmanage.host/susp.php";
	$("#color2").show();
	$("#color").hide();

	listar_re_alm();

	$("#coincidencias_reg").hide();
	$("#formulario_reg").hide();

	var idusuario=$("#idusuario").text();

	if (idusuario==1) {
		$("#nuevo_prod_pt").show();
	}else{
		$("#nuevo_prod_pt").hide();
	}

	
	
	
}

function codigos_alm_pt()
{

	var codigo = $("#text_busc").val();

	$.post("ajax/almacen_pt.php?op=codigos_alm_pt&id="+codigo,function(r){
	        $("#box_codigos").html(r);

	       // concidencias();

	        		$("#idalmacen_pt").val("0");
					$("#idalmacen_pt_resp").val("0");
					$("#tipo").val("");
					//document.getElementById('tipo').disabled = false;
					//$("#valid_cod").val("");
					$("#codigo_nuevo").val("");
					$("#codigo_alm").val("");
					$("#sub_code").val("");
					$("#nombre").val("");
					//document.getElementById('nombre').disabled = false;
					$("#medidas").val("");
					//document.getElementById('medidas').disabled = false;
					//document.getElementById('color').disabled = false;
					$("#alto").val("");
					$("#largo").val("");
					$("#ancho").val("");
					$("#extra").val("");
					$("#color").val("");
					
					$("#cantidad").val("");
					$("#lote").val("");
					$("#op").val("");

					var btn = document.getElementById('option_new');
					btn.style.backgroundColor = '#023D68';
					var btn2 = document.getElementById('option_exist');
					btn2.style.backgroundColor = '#cccccc';

					$("#edit_color").show();
					$("#idesp").show();
					$("#esp_sub").show();

					$("#coincidencias_reg").show();
					$("#formulario_reg").hide();


	});

}

function codigos_alm_pt5()
{

	var codigo = $("#codigo").val();

	$.post("ajax/almacen_pt.php?op=codigos_alm_pt5&id="+codigo,function(r){
	        $("#box_coin_prod_alm").html(r);


	});

}

function codigos_alm_pt4()
{

	var codigo = $("#nombre").val();

	$.post("ajax/almacen_pt.php?op=codigos_alm_pt5&id="+codigo,function(r){
	        $("#box_coin_prod_alm2").html(r);


	});

}

function codigos_alm_pt2()
{

					codigos_alm_pt5();

	        		$("#idalmacen_pt").val("0");
					$("#idalmacen_pt_resp").val("0");
					$("#tipo").val("");
					//document.getElementById('tipo').disabled = false;
					//$("#valid_cod").val("");
					$("#codigo_nuevo").val("");
					$("#codigo_alm").val("");
					$("#sub_code").val("");
					$("#nombre").val("");
					//document.getElementById('nombre').disabled = false;
					$("#medidas").val("");
					//document.getElementById('medidas').disabled = false;
					//document.getElementById('color').disabled = false;
					$("#alto").val("");
					$("#largo").val("");
					$("#ancho").val("");
					$("#extra").val("");
					$("#color").val("");
					
					$("#cantidad").val("");
					$("#lote").val("");
					$("#op").val("");

					var btn = document.getElementById('option_new');
					btn.style.backgroundColor = '#023D68';
					var btn2 = document.getElementById('option_exist');
					btn2.style.backgroundColor = '#cccccc';

					$("#edit_color").show();
					$("#idesp").show();
					$("#esp_sub").show();

					

}

function concidencias()
{
	var codigo = $("#codigo").val();

	if (codigo=="") {

		$("#num_coin").text("");
	}else{

		$.post("ajax/almacen_pt.php?op=concidencias",{codigo:codigo},function(data, status)
		{
			data = JSON.parse(data);

			//alert(data.num_coin);

			$("#num_coin").text("Coincidencias encontradas: "+data.num_coin);
			$("#num_coin2").text(data.num_coin);
			
		});

	}


		
}


function set_active1()
{
	$("#active1").val("1");
	$("#active2").val("0");

	var btn = document.getElementById('btn_entrada');
	btn.style.backgroundColor = '#0DFB40';
	var btn2 = document.getElementById('btn_salida');
	btn2.style.backgroundColor = '#cccccc';
}

function set_active2()
{
	$("#active1").val("0");
	$("#active2").val("1");

	var btn = document.getElementById('btn_entrada');
	btn.style.backgroundColor = '#cccccc';
	var btn2 = document.getElementById('btn_salida');
	btn2.style.backgroundColor = '#FA3847';
}

/*function set_active3()
{
	$("#active1").val("1");
	$("#active2").val("0");

	var btn = document.getElementById('btn_entrada');
	btn.style.backgroundColor = '#0DFB40';
	var btn2 = document.getElementById('btn_salida');
	btn2.style.backgroundColor = '#cccccc';
}

function set_active4()
{
	$("#active1").val("0");
	$("#active2").val("1");

	var btn = document.getElementById('btn_entrada');
	btn.style.backgroundColor = '#cccccc';
	var btn2 = document.getElementById('btn_salida');
	btn2.style.backgroundColor = '#0DFB40';
}*/



function guardar_registro()
{

	var idusuario=$("#idusuario").text();
	var idproducto_clasif = $("#idproducto_clasif").val();

	//alert(idproducto_clasif);

	if (idproducto_clasif>0) {


		if (idusuario==1 || idusuario==10 || idusuario==22) {

			var active1 = $("#active1").val();
			var active2 = $("#active2").val();


			if (active1==1 && active2==0) {
				var mov = "Entrada";
			}

			if (active1==0 && active2==1) {
				var mov = "Salida";
			}

			if (mov=="Entrada" || mov=="Salida") {

				var cantidad = $("#cantidad").val();

				if (cantidad=="") {

					
						bootbox.prompt("Cantidad", function(result){ 
						console.log(result);

						if (result!=null) {


							var cantidad = result;

								if (cantidad!="") {

									if (cantidad>=0) {


										var idalmacen_pt = $("#idalmacen_pt").val();
										var tipo = $("#tipo").val();
										var codigo = $("#codigo").val();
										var codigo_nuevo = $("#codigo_nuevo").val();
										var codigo_alm = $("#codigo_alm").val();
										//var valid_cod = $("#valid_cod").val();
										var sub_code = 0;
										var nombre = $("#nombre").val();
										var medidas = $("#medidas").val();
										var alto = $("#alto").val();
										var largo = $("#largo").val();
										var ancho = $("#ancho").val();
										var extra = $("#extra").val();

										var color = $("#color").val();
										//var color2 = $("#color2").val();


										if (color=="#000000") {
											color=$("#color2").val();
										}

										
										var lote = $("#lote").val();
										var op = $("#op").val();
										var control = $("#control").val();

										/*var fecha=moment().format('YYYY-MM-DD');
										var hora=moment().format('HH:mm:ss');
										var fecha_hora=fecha+" "+hora;*/

										var comentario = $("#comentario").val();
										var idproducto_clasif = $("#idproducto_clasif").val();

										var fecha_hora = $("#fecha_registro_alm").val();

										$.post("ajax/almacen_pt.php?op=guardar_registro",{
											idalmacen_pt:idalmacen_pt,
											tipo:tipo,
											codigo:codigo,
											codigo_alm:codigo_alm,
											codigo_nuevo:codigo_nuevo,
											sub_code:sub_code,
											nombre:nombre,
											medidas:medidas,
											alto:alto,
											largo:largo,
											ancho:ancho,
											extra:extra,
											color:color,
											cantidad:cantidad,
											mov:mov,
											lote:lote,
											op:op,
											control:control,
											fecha_hora:fecha_hora,
											comentario:comentario,
											idproducto_clasif:idproducto_clasif},function(data, status)
										{
											data = JSON.parse(data);

											//bootbox.alert("Guardado");

											bootbox.confirm("Registro guardado", function(result){ 
											  

											    if (result==true) {
											    	location.reload();
											    }else{
											    	location.reload();
											    } 
											});
											//$("#idalmacen_pt").val("0");
											$("#idalmacen_pt_resp").val("0");
											$("#tipo").val("");
											$("#codigo").val("");
											$("#codigo_nuevo").val("");
											$("#codigo_alm").val("");
											//$("#valid_cod").val("");
											$("#sub_code").val("");
											$("#nombre").val("");
											$("#medidas").val("");
											$("#alto").val("");
											$("#largo").val("");
											$("#ancho").val("");
											$("#extra").val("");
											$("#color").val("");
											$("#color2").val("");
											$("#cantidad").val("");
											$("#lote").val("");
											$("#op").val("");
											$("#control").val("");
											$("#comentario").val("");

											$("#codigo_buscar").val("");
											$("#idproducto_clasif").val("0");

											$.post("ajax/almacen_pt.php?op=select_prod",{idalmacen_pt:idalmacen_pt},function(data, status)
											{
												data = JSON.parse(data);

												$("#cantidad_ficha").text("Existencia: "+ data.cantidad);

											});

											
											
											
										});

									}else{


										bootbox.alert("Es necesario capturar una cantidad valida");
									}

								}else{

									bootbox.alert("Es necesario capturar una cantidad valida");
								}


						}else{

							bootbox.alert("Cancelado por el usuario");
						}

							


						});


				}else{



									var idalmacen_pt = $("#idalmacen_pt").val();
									var tipo = $("#tipo").val();
									var codigo = $("#codigo").val();
									var codigo_nuevo = $("#codigo_nuevo").val();
									var codigo_alm = $("#codigo_alm").val();
									//var valid_cod = $("#valid_cod").val();
									var sub_code = 0;
									var nombre = $("#nombre").val();
									var medidas = $("#medidas").val();
									var alto = $("#alto").val();
									var largo = $("#largo").val();
									var ancho = $("#ancho").val();
									var extra = $("#extra").val();

									var color = $("#color").val();
									//var color2 = $("#color2").val();


									if (color=="#000000") {
										color=$("#color2").val();
									}

									
									var lote = $("#lote").val();
									var op = $("#op").val();
									var control = $("#control").val();

									var fecha=moment().format('YYYY-MM-DD');
									var hora=moment().format('HH:mm:ss');
									//var fecha_hora=fecha+" "+hora;
									var fecha_hora = $("#fecha_registro_alm").val();

									var comentario = $("#comentario").val();
									var idproducto_clasif = $("#idproducto_clasif").val();

									$.post("ajax/almacen_pt.php?op=guardar_registro",{
										idalmacen_pt:idalmacen_pt,
										tipo:tipo,
										codigo:codigo,
										codigo_alm:codigo_alm,
										codigo_nuevo:codigo_nuevo,
										sub_code:sub_code,
										nombre:nombre,
										medidas:medidas,
										alto:alto,
										largo:largo,
										ancho:ancho,
										extra:extra,
										color:color,
										cantidad:cantidad,
										mov:mov,
										lote:lote,
										op:op,
										control:control,
										fecha_hora:fecha_hora,
										comentario:comentario,
										idproducto_clasif:idproducto_clasif},function(data, status)
									{
										data = JSON.parse(data);

										//bootbox.alert("Guardado");

											bootbox.confirm("Registro guardado", function(result){ 
											  

											    if (result==true) {
											    	location.reload();
											    }else{
											    	location.reload();
											    } 
											});
										//$("#idalmacen_pt").val("0");
										$("#idalmacen_pt_resp").val("0");
										$("#tipo").val("");
										$("#codigo").val("");
										$("#codigo_nuevo").val("");
										$("#codigo_alm").val("");
										//$("#valid_cod").val("");
										$("#sub_code").val("");
										$("#nombre").val("");
										$("#medidas").val("");
										$("#alto").val("");
										$("#largo").val("");
										$("#ancho").val("");
										$("#extra").val("");
										$("#color").val("");
										$("#color2").val("");
										$("#cantidad").val("");
										$("#lote").val("");
										$("#op").val("");
										$("#control").val("");
										$("#comentario").val("");
										$("#idproducto_clasif").val("0");

										$.post("ajax/almacen_pt.php?op=select_prod",{idalmacen_pt:idalmacen_pt},function(data, status)
										{
											data = JSON.parse(data);

											$("#cantidad_ficha").text("Existencia: "+ data.cantidad);

										});

										listar_re_alm();
										
									});


				}

		    
		
				
			}else{

				bootbox.alert("Error al seleccionar tipo de movimiento");
			}

		}else{

			bootbox.alert("No tiene permisos para realizar esta acción");
		}

	}else{
		bootbox.alert("El producto aún no ha sido indexado en la base de datos principal");
	}

		

		

		
}


function select_prod(idalmacen_pt,idproducto)
{
	//alert(idalmacen_pt);
		$("#coincidencias_reg").hide();
		$("#formulario_reg").show();
		$("#form_prod").hide();
		$("#detalle_prod").show();

		$("#idalmacen_pt").val(idalmacen_pt);
		$("#idalmacen_pt_resp").val(idalmacen_pt);
		$("#idproducto_clasif").val(idproducto);

		var btn = document.getElementById('option_new');
		btn.style.backgroundColor = '#cccccc';
		var btn2 = document.getElementById('option_exist');
		btn2.style.backgroundColor = '#023D68';

		$.post("ajax/almacen_pt.php?op=select_prod",{idalmacen_pt:idalmacen_pt},function(data, status)
		{
			data = JSON.parse(data);

			$("#codigo").val(data.codigo);
			$("#codigo_ficha").text(data.codigo);

			var idusuario=$("#idusuario").text();

			$("#codigo_nuevo").val(data.codigo_nuevo);
			$("#codigo_alm").val(data.codigo_alm);
			$("#sub_code").val(data.num_cod);
			$("#nombre").val(data.nombre);
			$("#descripcion_ficha").text(data.nombre);
			//document.getElementById('nombre').disabled = true;
			$("#medidas").val(data.medidas);
			$("#medidas_ficha").val(data.medidas);
			$("#alto").val(data.alto);
			$("#ancho").val(data.ancho);
			$("#largo").val(data.largo);
			$("#extra").val(data.extra);
			$("#color2").val(data.color);
			$("#colorficha").val(data.color);
			//$("#cantidad").val(data.cantidad);
			$("#tipo").val(data.tipo);
			$("#tipo_ficha").text(data.tipo);
			//document.getElementById('tipo').disabled = true;
			//alert(data.cant_entrada);
			//alert(data.cant_salida);
			var cantidad_real = parseInt(data.cant_entrada) - parseInt(data.cant_salida);
			//alert(cantidad_real)
			$("#cantidad_prod").text(cantidad_real);
			$("#cantidad_ficha").text("Existencia: "+ cantidad_real);
			//$("#forma_pago").selectpicker('refresh');
			/*$("#num_coin").text("Producto seleccionado");
			$("#num_coin2").text("0");*/

			$("#edit_color").hide();
			$("#idesp").hide();
			$("#esp_sub").hide();
			
			$("#text_busc").val("");

			var codigo = "";

			$.post("ajax/almacen_pt.php?op=codigos_alm_pt&id="+codigo,function(r){
			        $("#box_codigos").html(r);

			});
			
		});
}


function marcar_new_prod()
{
					var btn = document.getElementById('option_new');
					btn.style.backgroundColor = '#023D68';
					var btn2 = document.getElementById('option_exist');
					btn2.style.backgroundColor = '#cccccc';

					$("#idalmacen_pt").val("0");
			        $("#idalmacen_pt_resp").val("0");

			        //$("#num_coin").text("Será registrado un nuevo producto");

			        
			        sub_codigo();
			        codigos_alm_pt4();
}


function llenar_medidas()
{
	var alto = $("#alto").val();
	var ancho = $("#ancho").val();
	var largo = $("#largo").val();
	var extra = $("#extra").val();

	var esp0 = "Alto: ";
	var esp1 = ", Ancho: ";
	var esp2 = ", Largo: ";
	var esp3 = ", ";

	if (ancho=="") {
		esp1="";
	}
	if (largo=="") {
		esp2="";
	}
	if (extra=="") {
		esp3="";
	}

	var medidas = esp0+alto+esp1+ancho+esp2+largo+esp3+extra;

	$("#medidas").val(medidas);

	marcar_new_prod();

}

function armar_nuevo_codigo()
{
	var codigo = $("#codigo").val();
	//$("#color2").val(color);
	var color = $("#color").val();
	


	//color = color.substr(0,2);
	color = color.toUpperCase();

	var nuevo_codigo = codigo+color;



	$("#codigo_nuevo").val(nuevo_codigo);

	marcar_new_prod();
}


function armar_nuevo_codigo2()
{
	var codigo = $("#codigo").val();
	//$("#color2").val(color);
	var color = $("#color2").val();
	


	color = color.substr(0,2);
	color = color.toUpperCase();

	var nuevo_codigo = codigo+color;



	$("#codigo_nuevo").val(nuevo_codigo);

	marcar_new_prod();
}







function sub_codigo()
{
	    var codigo_nuevo = $("#codigo_nuevo").val();

		$.post("ajax/almacen_pt.php?op=sub_codigo",{codigo_nuevo:codigo_nuevo},function(data, status)
		{
			data = JSON.parse(data);

			$("#sub_code").val(parseInt(data.num_cod)+1);
			
		});

}

function mostrar_inputcolor()
{
	$("#color2").show();

	$("#color").hide();
}

function mostrar_inputcolor2()
{
	$("#color2").hide();
	
	$("#color").show();
}

function selec_color1()
{
	$("#color2").val("Amarillo");
	armar_nuevo_codigo2();
}

function selec_color2()
{
	$("#color2").val("Azul");
	armar_nuevo_codigo2();
}

function selec_color3()
{
	$("#color2").val("Naranja");
	armar_nuevo_codigo2();
}

function selec_color4()
{
	$("#color2").val("Rojo");
	armar_nuevo_codigo2();
}

function selec_color5()
{
	$("#color2").val("Verde");
	armar_nuevo_codigo2();
}


function codigo_alm()
{
	var codigo = $("#codigo").val();
	var tipo = $("#tipo").val();

	tipo = tipo.substr(0,2);

	var codigo_alma = tipo+"-"+codigo;

	$("#codigo_alm").val(codigo_alma);

	marcar_new_prod();
}

function listar_re_alm()
{
	//var idusuario=$("#idusuario").text();
	//var estatus_tabla=$("#estatus_tabla").val();

	//alert(estatus_tabla);

	var idalmacen_pt = $("#idalmacen_pt").val();

	

	$.post("ajax/almacen_pt.php?op=listar_es&id="+idalmacen_pt,function(r){
	        $("#datatable_es").html(r);        
	       
	});
}

function filtro_option0()
{
	$("#valor_filtro").val("0");
	fabricados();
}

function filtro_option1()
{
	$("#valor_filtro").val("1");
	fabricados();
}

function filtro_option2()
{
	$("#valor_filtro").val("2");
	fabricados();
}

function filtro_option3()
{
	$("#valor_filtro").val("3");
	fabricados();
}

function fabricados()
{
	$("#modal_fabricados").modal("show");

	var valor_filtro = $("#valor_filtro").val();

	$.post("ajax/almacen_pt.php?op=listar_fabricados&id="+valor_filtro,function(r){
	        $("#tbl_fabricados").html(r);	        
	       
	});
}

function detalle_producto(idpg_detped)
{
	$("#modal_fabricados").modal("hide");
	$("#modal_detalles_prod").modal("show");


		$.post("ajax/almacen_pt.php?op=detalle_producto",{idpg_detped:idpg_detped},function(data, status)
		{
		data = JSON.parse(data);


					$("#codigo_m").text(data.codigo);
					$("#detalle_m").text(data.descripcion);
					$("#observ_m").text(data.observacion);
					$("#observ_p_m").text(data.observaciones);
					$("#notae_m").text(data.observ_enlace);
					$("#control_m").text(data.no_control);
					$("#op_m").text(data.op);
					$("#fecha_m").text(data.fecha_hora2);
					$("#cantidad_m").text(data.cantidad);

					$("#idpg_detped").val(data.idpg_detped);
					$("#idop_detalle_prod").val(data.idop_detalle_prod);

					var validacion = data.validacion;

					if (validacion==1) {

						var btn_valid = document.getElementById('btn_valid');
						btn_valid.style.backgroundColor = '#ACFAC3';

						var btn_alerta = document.getElementById('btn_alerta');
						btn_alerta.style.backgroundColor = '#ffffff';
					}

					if (validacion==2) {

						var btn_valid = document.getElementById('btn_valid');
						btn_valid.style.backgroundColor = '#ffffff';

						var btn_alerta = document.getElementById('btn_alerta');
						btn_alerta.style.backgroundColor = '#FAB3A4';
					}

					if (validacion==0) {

						var btn_valid = document.getElementById('btn_valid');
						btn_valid.style.backgroundColor = '#ffffff';

						var btn_alerta = document.getElementById('btn_alerta');
						btn_alerta.style.backgroundColor = '#ffffff';
					}



					//var idop_detalle_prod = data.idop_detalle_prod;
					var op = data.op;

					

					$.post("ajax/almacen_pt.php?op=buscar_idop",{op:op},function(data, status)
					{
					data = JSON.parse(data);

					     var idop=data.idop;

					    // alert(idop);

					     $.post("ajax/almacen_pt.php?op=listar_areas2&id="+idop,function(r){
					        $("#btns_areas").html(r); 


					        	var idop_detalle_prod = 0;
					        	var area = 0;

					        	$.post("ajax/almacen_pt.php?op=listar_lotes&id="+idop_detalle_prod+"&val2="+area,function(r){
									$("#tbl_lotes").html(r);	        					       
								});


						       
						});

					});
					
			
		});


}

function listar_lotes(area)
{
	var idop_detalle_prod =  $("#idop_detalle_prod").val();

	$.post("ajax/almacen_pt.php?op=listar_lotes&id="+idop_detalle_prod+"&val2="+area,function(r){
		$("#tbl_lotes").html(r);	        					       
	});
}


function listar_areas(op,idpg_detped)
{

			$.post("ajax/almacen_pt.php?op=listar_areas&id="+op,function(r){
	        $("#box_areas"+idpg_detped).html(r);

	        });
}

function validado()
{
	var idpg_detped = $("#idpg_detped").val();

	$.post("ajax/almacen_pt.php?op=validado",{idpg_detped:idpg_detped},function(data, status)
	{
		
		$("#modal_detalles_prod").modal("hide");

		//$("#modal_avances").modal("hide");
		var dialog = bootbox.dialog({
			message: '<p><i class="fa fa-spin fa-spinner"></i> Procesando...</p>'
		});
																								            
		dialog.init(function(){
			setTimeout(function(){
				dialog.find('.bootbox-body').html('Existencia de producto validado.'); 

				$("#modal_detalles_prod").modal("show");

				var btn_valid = document.getElementById('btn_valid');
				btn_valid.style.backgroundColor = '#ACFAC3';

				var btn_alerta = document.getElementById('btn_alerta');
				btn_alerta.style.backgroundColor = '#ffffff';

				fabricados();
																								        
			}, 3000);

		});



	});
}


function alerta()
{
	var idpg_detped = $("#idpg_detped").val();

	$.post("ajax/almacen_pt.php?op=alerta",{idpg_detped:idpg_detped},function(data, status)
	{
		
		$("#modal_detalles_prod").modal("hide");

		//$("#modal_avances").modal("hide");
		var dialog = bootbox.dialog({
			message: '<p><i class="fa fa-spin fa-spinner"></i> Procesando...</p>'
		});
																								            
		dialog.init(function(){
			setTimeout(function(){
				dialog.find('.bootbox-body').html('Alerta de producto enviado.'); 

				$("#modal_detalles_prod").modal("show");

				var btn_valid = document.getElementById('btn_valid');
				btn_valid.style.backgroundColor = '#ffffff';

				var btn_alerta = document.getElementById('btn_alerta');
				btn_alerta.style.backgroundColor = '#FAB3A4';

				fabricados();
																								        
			}, 3000);

		});



	});
}

function volver_a_lista()
{
	$("#modal_fabricados").modal("show");
	$("#modal_detalles_prod").modal("hide");
}

function update_existencia(idalmacen_pt)
{
	var exist_inv = $("#exist_inv"+idalmacen_pt).val();

	$.post("ajax/almacen_pt.php?op=update_existencia",{idalmacen_pt:idalmacen_pt,exist_inv:exist_inv},function(data, status)
	{
	data = JSON.parse(data);


	});
}

function nuevo_prod_alm()
{
	var idusuario = $("#idusuario").text();

	if (idusuario==1 || idusuario==22) {

		$("#formulario_reg").show();
		$("#coincidencias_reg").hide();
		$("#form_prod").show();
		$("#detalle_prod").hide();
		limpiar();
	}
		
}


function limpiar()
{
			$("#idalmacen_pt").val("0");
			$("#idalmacen_pt_resp").val("0");
			$("#tipo").val("");
			//document.getElementById('tipo').disabled = false;
			$("#codigo").val("");
			//document.getElementById('codigo').disabled = false;
			$("#codigo_nuevo").val("");
			$("#codigo_alm").val("");
			//$("#valid_cod").val("");
			$("#sub_code").val("");
			$("#nombre").val("");
			//document.getElementById('nombre').disabled = false;
			$("#medidas").val("");
			$("#alto").val("");
			$("#largo").val("");
			$("#ancho").val("");
			$("#extra").val("");
			$("#color").val("");
			$("#color2").val("");
			$("#cantidad").val("");
			$("#lote").val("");
			$("#op").val("");
			$("#control").val("");

			$("#edit_color").show();
			$("#idesp").show();
			$("#esp_sub").show();
			
			$("#text_busc").val("");
			$("#comentario").val("");
}


function abrir_detalle_mov(idalmacen_pt_ed)
{
	$("#modal_detalle_es").modal("show");

	//alert(idalmacen_pt_ed);

	$.post("ajax/almacen_pt.php?op=abrir_detalle_mov",{idalmacen_pt_ed:idalmacen_pt_ed},function(data, status)
	{
	data = JSON.parse(data);

		//alert(data.movimiento);

		$("#mov").text(data.movimiento);
		$("#cod").text(data.codigo);
		$("#nom").text(data.nombre);
		$("#cant").text(data.cantidad);
		$("#lot").text(data.lote);
		$("#ope").text(data.op);
		$("#cont").text(data.control);
		$("#fec").text(data.fecha_hora);
		$("#com").text(data.comentario);



	});
}

function listar_terminados()
{
	//var variable = 1;

	var idusuario = $("#idusuario").text();

	if (idusuario==1 || idusuario==22) {

		$("#modal_fabricados_valid").modal("show");

		$.post("ajax/almacen_pt.php?op=abrir_terminados",function(r){
		$("#tbl_terminados_valid").html(r);

			$.post("ajax/almacen_pt.php?op=abrir_excedentes",function(r){
			$("#tbl_excedente_valid").html(r);

					        
			});

				        
		});
	}

		
}

function listar_terminados_buscar()
{
	var op_buscar = $("#op_buscar").val();

	//alert(op_buscar);

	$.post("ajax/almacen_pt.php?op=listar_terminados_buscar&op="+op_buscar,function(r){
	$("#tbl_terminados_valid").html(r);

			        
	});
}

function listar_avances(idavance_prod,area,idop_detalle_prod)
{
	/*alert(idavance_prod);
	alert(area);
	alert(idop_detalle_prod);*/


	/*$.post("ajax/almacen_pt.php?op=listar_avances&id="+idavance_prod,function(r){
	$("#tbl_avances"+idavance_prod).html(r);

			        
	});

	$.post("ajax/almacen_pt.php?op=listar_avances1&id="+idavance_prod,function(r){
	$("#tbl_avances1"+idavance_prod).html(r);

			        
	});*/


				$.post("ajax/op.php?op=cargar_historial_avances&id="+idop_detalle_prod+"&area="+area,function(r){
				$("#tbl_avances1"+idavance_prod).html(r);


				});


				$.post("ajax/op.php?op=cargar_excedentes&id="+idop_detalle_prod+"&area="+area,function(r){
				$("#tbl_avances"+idavance_prod).html(r);


				});
}

function abrir_modal_ubicacion(idavance_prod,cant_capt)
{
	//alert(idop_detalle_prod);
	//modal_fabricados_valid
	$("#modal_ubicacion").modal("show");
	$("#idavance").val(idavance_prod);
	$("#cantidad_total").val(cant_capt);
	document.getElementById('btn_guardar_entrada_alm').disabled = false;

}

function abrir_modal_ubicacion_exc(idop_detalle_exc,cantidad)
{
	//alert(idop_detalle_prod);
	//modal_fabricados_valid
	$("#modal_ubicacion_exc").modal("show");
	$("#idexc").val(idop_detalle_exc);
	$("#cantidad_total_exc").val(cantidad);
	document.getElementById('btn_guardar_entrada_alm_exc').disabled = false;

}

function guardar_entrada()
{

	document.getElementById('btn_guardar_entrada_alm').disabled = true;
	var idavance = $("#idavance").val();
	var ubicacion = $("#ubicacion").val();
	var comentario = $("#comentario_valid").val();
	var cantidad_total_exc = $("#cantidad_total").val();

	var idusuario=$("#idusuario").text();


	if (idusuario==22 || idusuario==1) {

		if (ubicacion!="") {

			var fecha=moment().format('YYYY-MM-DD');
			var hora=moment().format('HH:mm:ss');
			var fecha_hora=fecha+" "+hora;

			$.post("ajax/almacen_pt.php?op=buscar_idprod",{idavance:idavance},function(data, status)
			{
			data = JSON.parse(data);

				var idproducto = data.idproducto;
				//var cantidad = data.cantidad;
				var lote = data.lote;
				var no_control = data.no_control;
				var no_op = data.no_op;

				/*alert(idproducto);
				alert(cantidad);
				alert(lote);
				alert(no_control);
				alert(no_op);*/

				var cantidad = cantidad_total_exc;

				$.post("ajax/almacen_pt.php?op=exist_prod_alm",{idproducto:idproducto},function(data, status)
				{
				data = JSON.parse(data);

					//alert(data);
					//alert(data.num_prod);
					var exist_prod = "";

					if (data==null) {
						var exist_prod=0;
					}else{
						var exist_prod=data.idalmacen_pt;
					}
					
					if (exist_prod>=0) {

							//alert(comentario);

							$.post("ajax/almacen_pt.php?op=guardar_entrada",{
								idavance:idavance,
								idproducto:idproducto,
								cantidad:cantidad,
								lote:lote,
								no_control:no_control,
								no_op:no_op,
								fecha_hora:fecha_hora,
								comentario:comentario,
								ubicacion:ubicacion,
								exist_prod:exist_prod},function(data, status)
							{
							data = JSON.parse(data);

							bootbox.alert("Entrada registrada exitosamente");
							$("#modal_ubicacion").modal("hide");

								listar_terminados();
								document.getElementById('btn_guardar_entrada_alm').disabled = false;

							});
						

					}else{

						$.post("ajax/almacen_pt.php?op=guardar_error",{idop_detalle_prod:idop_detalle_prod,exist_prod:exist_prod},function(data, status)
						{
						data = JSON.parse(data);

							var error = data.iderror;
							bootbox.alert("No se registro la entrada, codigo de error: "+error);

						});

						
					}
					
					

				});


				

			});

		}else{

			bootbox.alert("Para continuar es necesario capturar la ubicacion actual del producto");

		}

	}else{
		bootbox.alert("El usuario no tiene permisos para realizar esta acción");
	}
	//alert(comentario);
	//var lote_modal = $("#lote_modal").val();

		
		
}


function guardar_entrada_exc()
{

	document.getElementById('btn_guardar_entrada_alm_exc').disabled = true;
	var idexc = $("#idexc").val();
	var ubicacion = $("#ubicacion_exc").val();
	var comentario = $("#comentario_valid_exc").val();
	var cantidad_total_exc = $("#cantidad_total_exc").val();

	var idusuario=$("#idusuario").text();


	if (idusuario==22 || idusuario==1) {

		if (ubicacion!="") {

			var fecha=moment().format('YYYY-MM-DD');
			var hora=moment().format('HH:mm:ss');
			var fecha_hora=fecha+" "+hora;

			$.post("ajax/almacen_pt.php?op=buscar_idprod_exc",{idexc:idexc},function(data, status)
			{
			data = JSON.parse(data);

				var idproducto = data.idproducto;
				//var cantidad = data.cantidad;
				var lote = data.lote;
				var no_control = data.no_control;
				var no_op = data.no_op;

				var cantidad = cantidad_total_exc;

				$.post("ajax/almacen_pt.php?op=exist_prod_alm",{idproducto:idproducto},function(data, status)
				{
				data = JSON.parse(data);

					//alert(data);
					//alert(data.num_prod);
					var exist_prod = "";

					if (data==null) {
						var exist_prod=0;
					}else{
						var exist_prod=data.idalmacen_pt;
					}
					
					if (exist_prod>=0) {

							//alert(comentario);

							$.post("ajax/almacen_pt.php?op=guardar_entrada_exc",{
								idexc:idexc,
								idproducto:idproducto,
								cantidad:cantidad,
								lote:lote,
								no_control:no_control,
								no_op:no_op,
								fecha_hora:fecha_hora,
								comentario:comentario,
								ubicacion:ubicacion,
								exist_prod:exist_prod},function(data, status)
							{
							data = JSON.parse(data);

							bootbox.alert("Entrada registrada exitosamente");
							$("#modal_ubicacion_exc").modal("hide");

								listar_terminados();
								document.getElementById('btn_guardar_entrada_alm_exc').disabled = false;

							});
						

					}else{

						$.post("ajax/almacen_pt.php?op=guardar_error",{idop_detalle_prod:idop_detalle_prod,exist_prod:exist_prod},function(data, status)
						{
						data = JSON.parse(data);

							var error = data.iderror;
							bootbox.alert("No se registro la entrada, codigo de error: "+error);

						});

						
					}
					
					

				});


				

			});

		}else{

			bootbox.alert("Para continuar es necesario capturar la ubicacion actual del producto");

		}

	}else{
		bootbox.alert("El usuario no tiene permisos para realizar esta acción");
	}
	//alert(comentario);
	//var lote_modal = $("#lote_modal").val();

		
		
}

function abrir_op3(idop_detalle)// para reporte
{
  	//alert(idop_detalle);
  	//alert(idop_detalle);
  	$("#enlace_op3"+idop_detalle).attr("href","reportes/exOp.php?id="+idop_detalle);
  
}

function abrir_inv()// para reporte
{
  	//alert(idop_detalle);
  	//alert(idop_detalle);
  	$("#enlace_imp").attr("href","reportes/impInv.php");
  
}


function buscar_codigo()
{
	var codigo = $("#codigo_buscar").val();

	$.post("ajax/almacen_pt.php?op=consul_exist_alm",{codigo:codigo},function(data, status)
		{
		data = JSON.parse(data);

		var cant_exist = data.cant_exist;

		if (cant_exist==0) {

					$.post("ajax/almacen_pt.php?op=buscar_codigo",{codigo:codigo},function(data, status)
					{
					data = JSON.parse(data);

						$("#codigo").val(data.codigo_match);
						$("#nombre").val(data.descripcion);
						$("#tipo").val(data.idtipo);
						$("#color2").val(data.color);
						$("#medidas").val(data.tamano);
						$("#idproducto_clasif").val(data.idproductos);

						codigos_alm_pt5();

					});
		}else{

					

				//$("#codigo").val(data.codigo_match);
						bootbox.alert("Este producto ya existe");

						//codigos_alm_pt5();

					

			

			
		}

	});				

					


	
}

function abrir_rep_valid()// para reporte
{
	
  	//alert(id_ped_temp);
  	$("#enlace").attr("href","reportes/repValid.php");
}

function descartar_avance(idavance_prod)
{
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	//alert(idavance_prod);

					bootbox.prompt("Motivo para descartar avance:", function(result){ 
						console.log(result);

						if (result!=null) {


							var comentario = result;

								if (comentario!="") {


									$.post("ajax/almacen_pt.php?op=descartar_avance",{idavance_prod:idavance_prod,comentario:comentario,fecha_hora:fecha_hora},function(data, status)
									{
									data = JSON.parse(data);

										listar_terminados();

									});

									

								}else{

									bootbox.alert("Capturar una motivo");
								}


						}else{

							bootbox.alert("Cancelado por el usuario");
						}

						});
}


function descartar_excedente(idop_detalle_exc)
{
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	//alert(idavance_prod);

					bootbox.prompt("Motivo para descartar excedente:", function(result){ 
						console.log(result);

						if (result!=null) {


							var comentario = result;

								if (comentario!="") {


									$.post("ajax/almacen_pt.php?op=descartar_excedente",{idop_detalle_exc:idop_detalle_exc,comentario:comentario,fecha_hora:fecha_hora},function(data, status)
									{
									data = JSON.parse(data);

										listar_terminados();

									});

									

								}else{

									bootbox.alert("Capturar una motivo");
								}


						}else{

							bootbox.alert("Cancelado por el usuario");
						}

						});
}


function abrir_ventana_inv()
{
	$("#modal_inventario").modal("show");

	$.post("ajax/almacen_pt.php?op=listar_re_alm",function(r){
	        $("#datatable_buttons").html(r);
	       
	});
}

function abrir_ventana_mov()
{
	$("#modal_movimientos").modal("show");

	var idalmacen_pt = $("#idalmacen_pt").val();

	

	$.post("ajax/almacen_pt.php?op=listar_es_todo&id="+idalmacen_pt,function(r){
	        $("#tbl_movimientos").html(r);        
	       
	});
}


function abrir_movimientos()
{
	$("#modal_nuevos_movimientos").modal("show");

	$.post("ajax/almacen_pt.php?op=abrir_movimientos",function(r){
	        $("#tbl_movimientos_nuevos").html(r); 

	        $.post("ajax/almacen_pt.php?op=lotes_codigo&idalmacen_pt="+0+"&codigo="+0,function(r){
			$("#tbl_lotes_cant").html(r);        
			       //lotes_codigo();
			});       
	       
	});
}

function abrir_detalle_mov_salida(idsalida)
{

	$("#modal_nuevos_movimientos_detalle").modal("show");
	$("#modal_nuevos_movimientos").modal("hide");
	$("#div_tbl_prod_salida").show();
	$("#div_exist_lote").hide();

	$.post("ajax/almacen_pt.php?op=abrir_detalle_mov_salida&idsalida="+idsalida,function(r){
	        $("#tbl_movimientos_nuevos_detalle").html(r);        
	       
	});

}

function regresar_embarques()
{
	$("#modal_nuevos_movimientos_detalle").modal("hide");
	$("#modal_nuevos_movimientos").modal("show");
}

function ver_exist_lotes(idproducto,cantidad,identrega,idpedido)
{

	$("#div_tbl_prod_salida").hide();
	$("#div_exist_lote").show();

	$("#iddetalle_ped").val(idproducto);
	$("#identrega").val(identrega);
	$("#idpedido").val(idpedido);

	var iddetalle_pedido = idproducto;

	$.post("ajax/almacen_pt.php?op=consul_codigo",{iddetalle_pedido:iddetalle_pedido},function(data, status)
	{
	data = JSON.parse(data);

		$("#codigo_consul_exist").text(data.codigo);
		$("#descrip_consul_exist").text(data.descripcion);
		$("#cant_consul_exist").text(cantidad);

		var idalmacen_pt = data.idalmacen_pt;



			$.post("ajax/almacen_pt.php?op=lotes_codigo&idalmacen_pt="+0+"&codigo="+0+"&idpedido="+0,function(r){
			$("#tbl_lotes_cant").html(r);



				$.post("ajax/almacen_pt.php?op=lotes_codigo_idpedido&idalmacen_pt="+0+"&codigo="+0+"&idpedido="+0,function(r){
				$("#tbl_lotes_cant_pedido").html(r);  

					


					$.post("ajax/almacen_pt.php?op=listar_op&iddetalle_pedido="+0,function(r){
					$("#list_op").html(r);    


									$.post("ajax/almacen_pt.php?op=listar_prelista&idalmacen_pt="+0+"&identrega="+0,function(r){
									$("#tbl_presalida").html(r);
									lotes_codigo(); 

										$.post("ajax/almacen_pt.php?op=listar_op&iddetalle_pedido="+iddetalle_pedido,function(r){
										$("#list_op").html(r);    


														$.post("ajax/almacen_pt.php?op=listar_prelista&idalmacen_pt="+idalmacen_pt+"&identrega="+identrega,function(r){
														$("#tbl_presalida").html(r);   

															   listar_comp_prod();
														       
														});    
										       
										});
									       
									});    
					       
					});
				       
				});
			       
			});

	});
}

function regresar_prod_emb()
{
	$("#div_tbl_prod_salida").show();
	$("#div_exist_lote").hide();


			$.post("ajax/almacen_pt.php?op=lotes_codigo&idalmacen_pt="+0+"&codigo="+0,function(r){
			$("#tbl_lotes_cant").html(r);        
			       //lotes_codigo();
			});


}


function lotes_codigo()
{
	var codigo_consul_exist = $("#codigo_consul_exist").text();
	var idpedido = $("#idpedido").val();

	$.post("ajax/almacen_pt.php?op=consul_idalmacen_pt",{codigo_consul_exist:codigo_consul_exist},function(data, status)
	{
	data = JSON.parse(data);

		var idalmacen_pt = data.idalmacen_pt;

		if (idalmacen_pt>0) {

			$.post("ajax/almacen_pt.php?op=lotes_codigo&idalmacen_pt="+idalmacen_pt+"&codigo="+codigo_consul_exist+"&idpedido="+idpedido,function(r){
			$("#tbl_lotes_cant").html(r);



				$.post("ajax/almacen_pt.php?op=lotes_codigo_idpedido&idalmacen_pt="+idalmacen_pt+"&codigo="+codigo_consul_exist+"&idpedido="+idpedido,function(r){
				$("#tbl_lotes_cant_pedido").html(r);        
				       
				});



			       
			});
		}

		//alert(idalmacen_pt);

	});

	
}

function enviar_a_salida(cant_lote_disp,lote,op)
{
	//alert(exist_lote);
	var exist_lote=cant_lote_disp;

	var cant_consul_exist = $("#cant_consul_exist").text();

	var iddetalle_ped = $("#iddetalle_ped").val();
	var identrega = $("#identrega").val();

	//alert(iddetalle_ped);
	//alert(identrega);




	bootbox.prompt({
	    title: "Cantidad", 
	    centerVertical: true,
	    callback: function(result){ 

	    	if (result>0) {
	    		if (result<=exist_lote) {

	    			

	    			$.post("ajax/almacen_pt.php?op=consul_cant_presalida",{iddetalle_ped:iddetalle_ped,identrega:identrega},function(data, status)
					{
					data = JSON.parse(data);

					var cant_presalida_c = data.cant_presalida_c;
					var cant_consul_exist = $("#cant_consul_exist").text();

					//alert(cant_presalida_c);
					//alert(cant_consul_exist);
					
					var cant_consul_exist = parseInt(cant_consul_exist)-parseInt(cant_presalida_c);
					//

						if (result<=cant_consul_exist) {

							//alert(lote);
							if (lote=="") {

								bootbox.prompt({
								    title: "Lote", 
								    centerVertical: true,
								    callback: function(result2){ 

								    	//alert(result2);
								    	if (result2!="") {



								    		var codigo_consul_exist = $("#codigo_consul_exist").text();
								    		var lote = result2;

							    			$.post("ajax/almacen_pt.php?op=consul_idalmacen_pt",{codigo_consul_exist:codigo_consul_exist},function(data, status)
											{
											data = JSON.parse(data);

												var idalmacen_pt = data.idalmacen_pt;


												$.post("ajax/almacen_pt.php?op=consul_exist_lote",{idalmacen_pt:idalmacen_pt,lote:lote},function(data, status)
												{
												data = JSON.parse(data);

												 	 var num_lote = data.num_lote;
												 	 //alert(num_lote);

												 	 if (num_lote==0) {


												 	 	var iddetalle_pedido = $("#iddetalle_ped").val();
														var identrega = $("#identrega").val();
														var idpedido = $("#idpedido").val();
														var cantidad = result;
														var sin_lote = 1;

														$.post("ajax/almacen_pt.php?op=guardar_presalida",{
															idalmacen_pt:idalmacen_pt,
															iddetalle_pedido:iddetalle_pedido,
															identrega:identrega,
															lote:lote,
															cantidad:cantidad,
															idpedido:idpedido,
															sin_lote:sin_lote,
															op,op
														},function(data, status)
														{
														data = JSON.parse(data);


															$.post("ajax/almacen_pt.php?op=listar_prelista&idalmacen_pt="+idalmacen_pt+"&identrega="+identrega,function(r){
															$("#tbl_presalida").html(r);

																lotes_codigo();   
															       
															});


														});

												 	 }else{
												 	 	bootbox.alert("Este lote ya existe");
												 	 }

												});

											});

								    	}else{

								    		bootbox.alert("No se ha capturado el lote");
								    	}

								        
								    }
								});

							}

							if (lote!="") {


												var codigo_consul_exist = $("#codigo_consul_exist").text();

								    			$.post("ajax/almacen_pt.php?op=consul_idalmacen_pt",{codigo_consul_exist:codigo_consul_exist},function(data, status)
												{
												data = JSON.parse(data);

													var idalmacen_pt = data.idalmacen_pt;
													var iddetalle_pedido = $("#iddetalle_ped").val();
													var identrega = $("#identrega").val();
													var idpedido = $("#idpedido").val();
													var cantidad = result;
													var sin_lote = 0;

													$.post("ajax/almacen_pt.php?op=guardar_presalida",{
														idalmacen_pt:idalmacen_pt,
														iddetalle_pedido:iddetalle_pedido,
														identrega:identrega,
														lote:lote,
														cantidad:cantidad,
														idpedido:idpedido,
														sin_lote:sin_lote,
														op,op
													},function(data, status)
													{
													data = JSON.parse(data);


														$.post("ajax/almacen_pt.php?op=listar_prelista&idalmacen_pt="+idalmacen_pt+"&identrega="+identrega,function(r){
														$("#tbl_presalida").html(r);

															lotes_codigo();   
														       
														});


													});


												});

							}
			    				

		    			}else{
		    				bootbox.alert("La cantidad es mayor a la requerida");
		    			}

					});



	    		}else{

	    			if (result>exist_lote) {
		    			bootbox.alert("La cantidad es mayor a la existencia de este lote");
		    		}
	    		}
	    		
	    	}
 
	    }
	});
}


function enviar_a_presalida(existencia,lote,op)
{
	//alert("entra");
	var exist_lote=existencia;

	var cant_consul_exist = $("#cant_consul_exist_vale").text();

	var iddetalle_ped = $("#iddetalle_ped_vale").val();
	var identrega = $("#identrega_vale").val();

	bootbox.prompt({
	    title: "Cantidad", 
	    centerVertical: true,
	    callback: function(result){ 

	    	if (result>0) {
	    		if (result<=exist_lote) {

	    			//alert(iddetalle_ped);
	    			//alert(identrega);

	    			$.post("ajax/almacen_pt.php?op=consul_cant_presalida_vale",{iddetalle_ped:iddetalle_ped,identrega:identrega},function(data, status)
					{
					data = JSON.parse(data);

					var cant_presalida_c = data.cant_presalida_c;
					var cant_consul_exist = $("#cant_consul_exist_vale").text();

					//alert(cant_presalida_c);
					//alert(cant_consul_exist);
					
					var cant_consul_exist = parseInt(cant_consul_exist)-parseInt(cant_presalida_c);
					//

						if (result<=cant_consul_exist) {

							//alert(lote);
							if (lote=="") {

								bootbox.prompt({
								    title: "Lote", 
								    centerVertical: true,
								    callback: function(result2){ 

								    	//alert(result2);
								    	if (result2!="") {



								    		var codigo_consul_exist = $("#codigo_consul_exist_vale").text();
								    		var lote = result2;

							    			$.post("ajax/almacen_pt.php?op=consul_idalmacen_pt",{codigo_consul_exist:codigo_consul_exist},function(data, status)
											{
											data = JSON.parse(data);

												var idalmacen_pt = data.idalmacen_pt;


												$.post("ajax/almacen_pt.php?op=consul_exist_lote",{idalmacen_pt:idalmacen_pt,lote:lote},function(data, status)
												{
												data = JSON.parse(data);

												 	 var num_lote = data.num_lote;
												 	 //alert(num_lote);

												 	/* if (num_lote==0) {*/


												 	 	var iddetalle_pedido = $("#iddetalle_ped_vale").val();
														var identrega = $("#identrega_vale").val();
														var idpedido = $("#idpedido_vale").val();
														var cantidad = result;
														var sin_lote = 1;

														$.post("ajax/almacen_pt.php?op=guardar_presalida_vale",{
															idalmacen_pt:idalmacen_pt,
															iddetalle_pedido:iddetalle_pedido,
															identrega:identrega,
															lote:lote,
															cantidad:cantidad,
															idpedido:idpedido,
															sin_lote:sin_lote,
															op,op
														},function(data, status)
														{
														data = JSON.parse(data);


														/*alert(idalmacen_pt);
													alert(codigo_consul_exist);
													alert(idpedido);
													alert(identrega);*/

															/*$.post("ajax/almacen_pt.php?op=lotes_codigo_idpedido_vale&idalmacen_pt="+0+"&codigo="+0+"&idpedido="+0,function(r){
															$("#tbl_lotes_cant_pedido2").html(r);*/

																/*$.post("ajax/almacen_pt.php?op=lotes_codigo_idpedido_vale&idalmacen_pt="+idalmacen_pt+"&codigo="+codigo_consul_exist+"&idpedido="+idpedido,function(r){
																$("#tbl_lotes_cant_pedido2").html(r);*/

																	$.post("ajax/almacen_pt.php?op=lotes_codigo_vale&idalmacen_pt="+0+"&codigo="+0+"&idpedido="+0,function(r){
																	$("#tbl_lotes_cant2").html(r); 

																		$.post("ajax/almacen_pt.php?op=lotes_codigo_vale&idalmacen_pt="+idalmacen_pt+"&codigo="+codigo_consul_exist+"&idpedido="+idpedido,function(r){
																		$("#tbl_lotes_cant2").html(r);




																				$.post("ajax/almacen_pt.php?op=listar_prelista_vale&idalmacen_pt="+0+"&identrega="+0,function(r){
																				$("#tbl_presalida2").html(r); 


																					$.post("ajax/almacen_pt.php?op=listar_prelista_vale&idalmacen_pt="+idalmacen_pt+"&identrega="+identrega,function(r){
																					$("#tbl_presalida2").html(r);   

																								
																										       
																					}); 
																	       
																				});





																		});

																	});    
																       
																//});        
															       
															//});


														


														});

												 	/* }else{
												 	 	bootbox.alert("Este lote ya existe");
												 	 }*/

												});

											});

								    	}else{

								    		bootbox.alert("No se ha capturado el lote");
								    	}

								        
								    }
								});

							}

							if (lote!="") {


												var codigo_consul_exist = $("#codigo_consul_exist_vale").text();

								    			$.post("ajax/almacen_pt.php?op=consul_idalmacen_pt",{codigo_consul_exist:codigo_consul_exist},function(data, status)
												{
												data = JSON.parse(data);

													var idalmacen_pt = data.idalmacen_pt;
													var iddetalle_pedido = $("#iddetalle_ped_vale").val();
													var identrega = $("#identrega_vale").val();
													var idpedido = $("#idpedido_vale").val();
													var cantidad = result;
													var sin_lote = 0;

													$.post("ajax/almacen_pt.php?op=guardar_presalida_vale",{
														idalmacen_pt:idalmacen_pt,
														iddetalle_pedido:iddetalle_pedido,
														identrega:identrega,
														lote:lote,
														cantidad:cantidad,
														idpedido:idpedido,
														sin_lote:sin_lote,
														op,op
													},function(data, status)
													{
													data = JSON.parse(data);





															/*$.post("ajax/almacen_pt.php?op=lotes_codigo_idpedido_vale&idalmacen_pt="+0+"&codigo="+0+"&idpedido="+0,function(r){
															$("#tbl_lotes_cant_pedido2").html(r);*/

																/*$.post("ajax/almacen_pt.php?op=lotes_codigo_idpedido_vale&idalmacen_pt="+idalmacen_pt+"&codigo="+codigo_consul_exist+"&idpedido="+idpedido,function(r){
																$("#tbl_lotes_cant_pedido2").html(r);*/

																	$.post("ajax/almacen_pt.php?op=lotes_codigo_vale&idalmacen_pt="+0+"&codigo="+0+"&idpedido="+0,function(r){
																	$("#tbl_lotes_cant2").html(r); 

																		$.post("ajax/almacen_pt.php?op=lotes_codigo_vale&idalmacen_pt="+idalmacen_pt+"&codigo="+codigo_consul_exist+"&idpedido="+idpedido,function(r){
																		$("#tbl_lotes_cant2").html(r);




																				$.post("ajax/almacen_pt.php?op=listar_prelista_vale&idalmacen_pt="+0+"&identrega="+0,function(r){
																				$("#tbl_presalida2").html(r); 


																					$.post("ajax/almacen_pt.php?op=listar_prelista_vale&idalmacen_pt="+idalmacen_pt+"&identrega="+identrega,function(r){
																					$("#tbl_presalida2").html(r);   

																								
																										       
																					}); 
																	       
																				});





																		});

																	});    
																       
																//});        
															       
															//});


													});


												});

							}
			    				

		    			}else{
		    				bootbox.alert("La cantidad es mayor a la requerida");
		    			}

					});



	    		}else{

	    			if (result>exist_lote) {
		    			bootbox.alert("La cantidad es mayor a la existencia de este lote");
		    		}
	    		}
	    		
	    	}
 
	    }
	});
}


function borrar_presalida(idpresalida)
{
	var identrega = $("#identrega_vale").val();
	var idpedido = $("#idpedido_vale").val();
	var idvale_salida = $("#identrega_vale").val();

	$.post("ajax/almacen_pt.php?op=borrar_presalida",{idpresalida:idpresalida},function(data, status)
	{
	data = JSON.parse(data);

				var codigo_consul_exist = $("#codigo_consul_exist_vale").text();

							$.post("ajax/almacen_pt.php?op=consul_idalmacen_pt",{codigo_consul_exist:codigo_consul_exist},function(data, status)
							{
							data = JSON.parse(data);

								var idalmacen_pt = data.idalmacen_pt;




									/*$.post("ajax/almacen_pt.php?op=lotes_codigo_idpedido_vale&idalmacen_pt="+0+"&codigo="+0+"&idpedido="+0,function(r){
									$("#tbl_lotes_cant_pedido2").html(r);*/

										/*$.post("ajax/almacen_pt.php?op=lotes_codigo_idpedido_vale&idalmacen_pt="+idalmacen_pt+"&codigo="+codigo_consul_exist+"&idpedido="+idpedido,function(r){
										$("#tbl_lotes_cant_pedido2").html(r);*/

											$.post("ajax/almacen_pt.php?op=lotes_codigo_vale&idalmacen_pt="+0+"&codigo="+0+"&idpedido="+0,function(r){
											$("#tbl_lotes_cant2").html(r); 

												$.post("ajax/almacen_pt.php?op=lotes_codigo_vale&idalmacen_pt="+idalmacen_pt+"&codigo="+codigo_consul_exist+"&idpedido="+idpedido,function(r){
												$("#tbl_lotes_cant2").html(r);




														$.post("ajax/almacen_pt.php?op=listar_prelista_vale&idalmacen_pt="+0+"&identrega="+0,function(r){
														$("#tbl_presalida2").html(r); 


															$.post("ajax/almacen_pt.php?op=listar_prelista_vale&idalmacen_pt="+idalmacen_pt+"&identrega="+idvale_salida,function(r){
															$("#tbl_presalida2").html(r);   

																													
																															       
															}); 
																						       
														});





												});

											});    
										       
										//});        
									       
									//});


									/*$.post("ajax/almacen_pt.php?op=listar_prelista&idalmacen_pt="+idalmacen_pt+"&identrega="+identrega,function(r){
									$("#tbl_presalida2").html(r);

										//lotes_codigo();   
									       
									});*/

							});

	});
}


function guardar_salida()
{
							var codigo_consul_exist = $("#codigo_consul_exist_vale").text();

							var identrega = $("#identrega_vale").val();
							var idpedido = $("#idpedido_vale").val();
							

							$.post("ajax/almacen_pt.php?op=consul_idalmacen_pt",{codigo_consul_exist:codigo_consul_exist},function(data, status)
							{
							data = JSON.parse(data);

								var idalmacen_pt = data.idalmacen_pt;
								//alert(idalmacen_pt);
								//var mov = "Salida";
								var identrega = $("#identrega_vale").val();
								var idpedido = $("#idpedido_vale").val();

								var fecha=moment().format('YYYY-MM-DD');
								var hora=moment().format('HH:mm:ss');
								var fecha_hora=fecha+" "+hora;

								var cant_consul_exist_vale = $("#cant_consul_exist_vale").text();


								$.post("ajax/almacen_pt.php?op=sum_prelista",{idalmacen_pt:idalmacen_pt,identrega:identrega,idpedido:idpedido},function(data, status)
								{
								data = JSON.parse(data);

									/*alert(data);
									alert(data.sum_cant);*/

									if (data==null) {
										var cant_presalida = 0;
									}else{
										var cant_presalida = data.sum_cant;
									}

									/*alert(cant_presalida);
									alert(cant_consul_exist_vale);*/

									if (cant_presalida==cant_consul_exist_vale) {

										

										 	$.post("ajax/almacen_pt.php?op=guardar_salida&idalmacen_pt="+idalmacen_pt+"&identrega="+identrega+"&idpedido="+idpedido+"&fecha_hora="+fecha_hora,function(r){
											$("#tbl_presalida_save2").html(r);

												//lotes_codigo();  

												/*$.post("ajax/almacen_pt.php?op=lotes_codigo_idpedido_vale&idalmacen_pt="+0+"&codigo="+0+"&idpedido="+0,function(r){
												$("#tbl_lotes_cant_pedido2").html(r);*/

													/*$.post("ajax/almacen_pt.php?op=lotes_codigo_idpedido_vale&idalmacen_pt="+idalmacen_pt+"&codigo="+codigo_consul_exist+"&idpedido="+idpedido,function(r){
													$("#tbl_lotes_cant_pedido2").html(r);*/

														$.post("ajax/almacen_pt.php?op=lotes_codigo_vale&idalmacen_pt="+0+"&codigo="+0+"&idpedido="+0,function(r){
														$("#tbl_lotes_cant2").html(r); 

															$.post("ajax/almacen_pt.php?op=lotes_codigo_vale&idalmacen_pt="+idalmacen_pt+"&codigo="+codigo_consul_exist+"&idpedido="+idpedido,function(r){
															$("#tbl_lotes_cant2").html(r);




																	$.post("ajax/almacen_pt.php?op=listar_prelista_vale&idalmacen_pt="+0+"&identrega="+0,function(r){
																	$("#tbl_presalida2").html(r); 


																		$.post("ajax/almacen_pt.php?op=listar_prelista_vale&idalmacen_pt="+idalmacen_pt+"&identrega="+identrega,function(r){
																		$("#tbl_presalida2").html(r);   

																																
																																		       
																		}); 
																									       
																	});





															});

														});    
													       
													//});        
												       
												//});
											       
											});

										

											

									}else{
										bootbox.alert("La cantidad de productos no es la solicitada");
									}



								});
							

									/**/

									

							});
}



function listar_comp_prod()
{
	var iddetalle_ped = $("#iddetalle_ped").val();	

	$.post("ajax/almacen_pt.php?op=listar_comp_prod&iddetalle_ped="+iddetalle_ped,function(r){
	$("#tbl_comportamiento").html(r);

											 
										       
	}); 
}


function abrir_vales_salida()
{
	var idusuario = $("#idusuario").text();

	if (idusuario==1 || idusuario==22) {
		$("#idvales_almacen").val("");
		$("#enc_todo").hide();
		$("#enc_filtro").show();
		$("#num_vale").hide();
		$("#modal_vales_salida").modal("show");
		var estatus_vale_alm = $("#estatus_vale_alm").val();
		$.post("ajax/almacen_pt.php?op=listar_vales_alm&estatus="+estatus_vale_alm,function(r){
		$("#tbl_vales_salida").html(r);


		});
	}
		

}

function listar_vales_estatus()
{
	var estatus_vale_alm = $("#estatus_vale_alm").val();
	$.post("ajax/almacen_pt.php?op=listar_vales_alm&estatus="+estatus_vale_alm,function(r){
	$("#tbl_vales_salida").html(r);


	});
}

function ver_vale(idvales_almacen, no_vale)
{
		$("#idvales_almacen").val(idvales_almacen);
		$("#no_vale_valid").text(no_vale);
		$("#num_vale").show();
		//$("#subtitulo_vale").text("VALE ACTUAL");
		$("#enc_todo").show();
		$("#enc_filtro").hide();
		$.post("ajax/almacen_pt.php?op=listar_vale&id="+idvales_almacen,function(r){
		$("#tbl_vales_salida").html(r);

			
		});
}

function validar_producto(idvale_salida,idalmacen_pt)
{
	//alert(idalmacen_pt);


	if (idalmacen_pt>0) {

		$("#modal_vales_salida").modal("hide");
		$("#modal_validar_prod_vale").modal("show");


		$.post("ajax/almacen_pt.php?op=consul_prod_vale",{idvale_salida:idvale_salida},function(data, status)
		{
		data = JSON.parse(data);

			if (data.medida=="" || data.medida==null) {				
				var medida = "";
			}else{
				var medida = ", Medida: "+data.medida;
			}

			//alert(data.color);

			if (data.color=="" || data.color==null) {
				
				var color = "";
			}else{
				var color = ", Color: "+data.color;
			}

			
			$("#control_prod_alm").text(data.control);
			$("#codigo_consul_exist_vale").text(data.codigo);
			$("#descrip_consul_exist_vale").text(data.descripcion+medida+color);
			$("#cant_consul_exist_vale").text(data.cantidad);
			$("#observ_consul_exist_vale").text(data.observ);
			$("#empaque_consul_exist_vale").text(data.empaque);

			var iddetalle_ped = data.iddetalle_pedido;
			
			var idalmacen_pt = data.idalmacen_pt;
			var codigo_consul_exist = data.codigo;
			var idpedido = data.idpedido;
			$("#iddetalle_ped_vale").val(iddetalle_ped);
			$("#identrega_vale").val(idvale_salida);
			$("#idpedido_vale").val(idpedido);

			/*alert(idalmacen_pt);
			alert(codigo_consul_exist);
			alert(idpedido);*/
			//var via_consul=1;

			$.post("ajax/almacen_pt.php?op=listar_comp_prod&iddetalle_ped="+0,function(r){
			$("#tbl_comportamiento2").html(r);

				$.post("ajax/almacen_pt.php?op=listar_comp_prod&iddetalle_ped="+iddetalle_ped,function(r){
				$("#tbl_comportamiento2").html(r);

					/*$.post("ajax/almacen_pt.php?op=lotes_codigo_idpedido_vale&idalmacen_pt="+0+"&codigo="+0+"&idpedido="+0,function(r){
					$("#tbl_lotes_cant_pedido2").html(r);*/

						/*$.post("ajax/almacen_pt.php?op=lotes_codigo_idpedido_vale&idalmacen_pt="+idalmacen_pt+"&codigo="+codigo_consul_exist+"&idpedido="+idpedido,function(r){
						$("#tbl_lotes_cant_pedido2").html(r);*/

							$.post("ajax/almacen_pt.php?op=lotes_codigo_vale&idalmacen_pt="+0+"&codigo="+0+"&idpedido="+0,function(r){
							$("#tbl_lotes_cant2").html(r); 

								console.log("idalmacen_pt");
								console.log(idalmacen_pt);

								$.post("ajax/almacen_pt.php?op=lotes_codigo_vale&idalmacen_pt="+idalmacen_pt+"&codigo="+codigo_consul_exist+"&idpedido="+idpedido,function(r){
								$("#tbl_lotes_cant2").html(r);




										$.post("ajax/almacen_pt.php?op=listar_prelista_vale&idalmacen_pt="+0+"&identrega="+0,function(r){
										$("#tbl_presalida2").html(r); 


											$.post("ajax/almacen_pt.php?op=listar_prelista_vale&idalmacen_pt="+idalmacen_pt+"&identrega="+idvale_salida,function(r){
											$("#tbl_presalida2").html(r);   

																									
																											       
											}); 
																		       
										});





								});

							});    
						       
						//});        
					       
					//});

														 
													       
				}); 

			});

		});



	}else{
		bootbox.alert("El producto aún no existe en el almacén");
	}
}

function regresaravales()
{
		$("#modal_vales_salida").modal("show");
		$("#modal_validar_prod_vale").modal("hide");
}

function notif_surtido()
{
	var idvales_almacen = $("#idvales_almacen").val();

	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	//alert(idvales_almacen);

	$.post("ajax/almacen_pt.php?op=consul_surtido_tot",{idvales_almacen:idvales_almacen},function(data, status)
	{
	data = JSON.parse(data);

		var num_estat = data.num_estat;

		//alert(num_estat);

		if (num_estat==0) {

			$.post("ajax/almacen_pt.php?op=notif_surtido",{idvales_almacen:idvales_almacen,fecha_hora:fecha_hora},function(data, status)
			{
			data = JSON.parse(data);

				var estatus_vale_alm = $("#estatus_vale_alm").val();
				$.post("ajax/almacen_pt.php?op=listar_vales_alm&estatus="+estatus_vale_alm,function(r){
				$("#tbl_vales_salida").html(r);

					bootbox.alert("Vale surtido exitosamente");
					abrir_vales_salida();
				});

			});
		}else{
			bootbox.alert("El vale aún no ha sido surtido completamente");
		}

	});


			
}

function rechazar_vale()
{
	var idvales_almacen = $("#idvales_almacen").val();

	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	bootbox.confirm({
	    message: "¿Esta seguro que desea rechazar el vale completo?",
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

	        if (result==true) {


	        	bootbox.prompt("Captura el motivo por favor.", function(result){ 
				   

	        		if (result!="" && result!=null ) {

	        			var motivo = result;

	        			var fecha=moment().format('YYYY-MM-DD');
						var hora=moment().format('HH:mm:ss');
						var fecha_hora=fecha+" "+hora;


	        			$.post("ajax/almacen_pt.php?op=notif_rechazo",{idvales_almacen:idvales_almacen,fecha_hora:fecha_hora,motivo:motivo},function(data, status)
						{
						data = JSON.parse(data);

							var estatus_vale_alm = $("#estatus_vale_alm").val();
							$.post("ajax/almacen_pt.php?op=listar_vales_alm&estatus="+estatus_vale_alm,function(r){
							$("#tbl_vales_salida").html(r);

								bootbox.alert("Motivo enviado exitosamente");
								abrir_vales_salida();
							});

						});

	        		}

				});


	        }
	    }
	});


}

function rechazar_producto(idvale_salida,idvales_almacen,idpg_detped)
{
						


				bootbox.prompt("Captura el motivo por favor.", function(result){ 
				   

	        		if (result!="" && result!=null ) {

	        			var motivo = result;

	        			/*alert(idvale_salida);
	        			alert(idvales_almacen);
	        			alert(idpg_detped);*/


						$.post("ajax/almacen_pt.php?op=rechazar_producto",{idvale_salida:idvale_salida,motivo:motivo,idpg_detped:idpg_detped},function(data, status)
						{
						data = JSON.parse(data);

								


								$.post("ajax/almacen_pt.php?op=listar_vale&id="+idvales_almacen,function(r){
								$("#tbl_vales_salida").html(r);

									bootbox.alert("Producto rechazado exitosamente");
								});

						});

	        		}

				});
}


function borrar_registro(idalmacen_pt_ed)
{
	//alert(idalmacen_pt_ed);


	bootbox.confirm({
	    message: "Desea eliminar el registro",
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
	        	//alert("ejecuta");


	        			$.post("ajax/almacen_pt.php?op=borrar_registro",{idalmacen_pt_ed:idalmacen_pt_ed},function(data, status)
						{
						data = JSON.parse(data);


							bootbox.alert("Registo borrado exitosamente");

							listar_re_alm();
						});


	        }
	    }
	});


}


init();