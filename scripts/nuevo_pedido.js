function init()
{
	listar_tipos();

	//$("#div_lista_productos").show();

	$("#div_select_iniciales").show();
	$("#div_prod_seleccionado").hide();
	

	/*$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	
	});*/
	//document.getElementById('btn_guardar_pedido').disabled = true;

	jQuery(document).on('submit','#formulario', function(event){


		event.preventDefault();
		jQuery.ajax({
			url: 'ajax/prueba.php',
			type: 'POST',
			dataType: 'json',
			data: $(this).serialize(),
		})

		.done(function(respuesta){
			console.log(respuesta);

			if (!respuesta.error) {
				//bootbox.alert('Los datos se guardaron con exito');



				bootbox.confirm({
				    message: "Pedido guardado con exito, ¿Desea ver la lista de pedidos?",
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
				        	//$(location).attr("href","list_pedidos.php");
				        }else{
				        	//$(location).attr("href","nuevo_pedido.php");
				        }
				    }
				});



				

			}else{
				bootbox.alert('Los datos No se han ingresado');
			}
		})

		.fail(function(resp){
			console.log(resp.responseText);
		})

		.always(function(){
			console.log("complete");
		})



	});
}

function valid_list_partidas()
{
		var select_tipo_pedido = $("#select_tipo_pedido").val();
		var prod_seleccionados = $("#prod_seleccionados").text();

    	if (select_tipo_pedido==2 || select_tipo_pedido==3) {

    		var cant = document.getElementsByName("cant[]");
    		var partidas = 0;
    		for (var i = 0; i <cant.length; i++) {    			
    			partidas += parseInt(document.getElementsByName("partida_num[]")[i].value);
		  		//}
    		}

    		/*alert(partidas);
    		alert(prod_seleccionados);*/

    		if (partidas==prod_seleccionados) {

    			//alert("guardar");

    			$("#btn_guardar_pedido").show();
				$("#btn_validar").hide();
				calcular_totales();
    		}else{
    			bootbox.alert("Porfavor capture el numero de partida");
    		}

    	}else{

    			$("#btn_guardar_pedido").show();
				$("#btn_validar").hide();
				calcular_totales();
    	}
}

function listar_prod_buscado()
{
	var codigo_buscar = $("#buscar_prod_fil").val();


		$.post("ajax/nuevo_pedido.php?op=listar_productos_resul_tipo_buscado&codigo_buscar="+codigo_buscar,function(r){
		$("#tbl_result_prod_consul").html(r);

			var encontrados = $("#encontrados").text();
			$("#cant_encontrados").text(encontrados+" Productos encontrados.");
			
		       
		});	
}

function listar_tipos()
{
	$("#buscar_prod_fil").val("");
	$.post("ajax/nuevo_pedido.php?op=listar_tipos",function(r){
	$("#select_busqueda_tipo").html(r);

		$.post("ajax/nuevo_pedido.php?op=listar_productos_resul_tipo&id="+1,function(r){
		$("#tbl_result_prod_consul").html(r);

			var encontrados = $("#encontrados").text();
			$("#cant_encontrados").text(encontrados+" Productos encontrados.");
			
		       
		});	

   
	});
}


function listar_modelos()
{
	var select_busqueda_tipo = $("#select_busqueda_tipo").val();

	$.post("ajax/nuevo_pedido.php?op=listar_modelo&id="+select_busqueda_tipo,function(r){
	$("#select_busqueda_modelo").html(r);

	//alert(select_busqueda_tipo);

		//var select_busqueda_tipo = $("#select_busqueda_tipo").val();

		$.post("ajax/nuevo_pedido.php?op=listar_productos_resul_tipo&id="+select_busqueda_tipo,function(r){
		$("#tbl_result_prod_consul").html(r);

			var encontrados = $("#encontrados").text();
			$("#cant_encontrados").text(encontrados+" Productos encontrados.");
			
		       
		});	
	        
	});
}

function select_modelo()
{

		var select_busqueda_tipo = $("#select_busqueda_tipo").val();
		var select_busqueda_modelo = $("#select_busqueda_modelo").val();

		//alert(select_busqueda_modelo);

		$.post("ajax/nuevo_pedido.php?op=listar_grados&id="+select_busqueda_tipo+"&idmodelo="+select_busqueda_modelo,function(r){
		$("#select_busqueda_grad").html(r);

			$.post("ajax/nuevo_pedido.php?op=listar_productos_resul_tipo_modelo&id="+select_busqueda_tipo+"&idmodelo="+select_busqueda_modelo,function(r){
			$("#tbl_result_prod_consul").html(r);

				var encontrados = $("#encontrados").text();
				$("#cant_encontrados").text(encontrados+" Productos encontrados.");
				
			       
			});
			
		       
		});	

				
}

function select_grado()
{
		var select_busqueda_tipo = $("#select_busqueda_tipo").val();
		var select_busqueda_modelo = $("#select_busqueda_modelo").val();
		var select_busqueda_grad = $("#select_busqueda_grad").val();


		$.post("ajax/nuevo_pedido.php?op=listar_productos_resul_tipo_modelo_tam&id="+select_busqueda_tipo+"&idmodelo="+select_busqueda_modelo+"&idtam="+select_busqueda_grad,function(r){
		$("#tbl_result_prod_consul").html(r);

				var encontrados = $("#encontrados").text();
				$("#cant_encontrados").text(encontrados+" Productos encontrados");				
			       
		});
			
		
}

function recargar_especif()
{
	var idtbl_prod = $("#idtbl_prod").val();

	//alert(idtbl_prod);

		$.post("ajax/nuevo_pedido.php?op=listar_especif&idtbl_prod="+idtbl_prod,function(r){
			$("#div_select_especif").html(r);
		});
}

function modal_medidas_modif()
{


	cargar_cajas_modal();		

	var idtbl_prod = $("#idtbl_prod").val();
	var set_medidas_edit = $("#set_medidas_edit").val();

	if (set_medidas_edit==1) {

		//$("#modal_medidas_modif").modal("show");

		$.post("ajax/nuevo_pedido.php?op=buscar_datos_prod",{idtbl_prod:idtbl_prod},function(data, status)
		{
			data = JSON.parse(data);

			var medida1 = data.medida1;
			var medida2 = data.medida2;
			var medida3 = data.medida3;
			var medida4 = data.medida4;

			var concepto1 = data.concepto1;
			var concepto2 = data.concepto2;
			var concepto3 = data.concepto3;
			var concepto4 = data.concepto4;

			var codigo_group = data.codigo_group;
			var area = data.area;
			var set_c_rango = data.set_c_rango;
			var unidad = data.unidad;

			var cm_min = data.cm_min;
			var cm_max = data.cm_max;
			var cm_min2 = data.cm_min2;
			var cm_max2 = data.cm_max2;
			var cm_min3 = data.cm_min3;
			var cm_max3 = data.cm_max3;
			var cm_min4 = data.cm_min4;
			var cm_max4 = data.cm_max4;

			var cm_inp1 = parseInt(cm_min)+parseInt(cm_max);
			var cm_inp2 = parseInt(cm_min2)+parseInt(cm_max2);
			var cm_inp3 = parseInt(cm_min3)+parseInt(cm_max3);
			var cm_inp4 = parseInt(cm_min4)+parseInt(cm_max4);

			//alert(concepto1);

			$("#lbl_medida1").text(concepto1+" ("+unidad+")");
			$("#lbl_medida2").text(concepto2+" ("+unidad+")");
			$("#lbl_medida3").text(concepto3+" ("+unidad+")");
			$("#lbl_medida4").text(concepto4+" ("+unidad+")");

			$("#medida1").val(medida1);
			$("#medida2").val(medida2);
			$("#medida3").val(medida3);
			$("#medida4").val(medida4);

			$("#medidabase1").val(medida1);
		    $("#medidabase2").val(medida2);
		    $("#medidabase3").val(medida3);
		    $("#medidabase4").val(medida4);

			
			//var id_tipo = $("#id_tipo").val();

			if (set_c_rango==1) {

				$("#div_areas").show();

				if (medida1==0) {
					document.getElementById('medida1').disabled = true;
					$("#div_medida1").hide();
					
				}else{
					document.getElementById('medida1').disabled = false;
					$("#div_medida1").show();
					
				}

				if (medida2==0) {
					document.getElementById('medida2').disabled = true;
					$("#div_medida2").hide();
					
				}else{
					document.getElementById('medida2').disabled = false;
					$("#div_medida2").show();
					
				}

				if (medida3==0) {
					document.getElementById('medida3').disabled = true;
					$("#div_medida3").hide();
					
				}else{
					document.getElementById('medida3').disabled = false;
					$("#div_medida3").show();
					
				}

				if (medida4==0) {
					document.getElementById('medida4').disabled = true;
					$("#div_medida4").hide();
					
				}else{
					document.getElementById('medida4').disabled = false;
					$("#div_medida4").show();
					
				}




				var area_base = parseFloat(medida1)*parseFloat(medida2);


				$.post("ajax/nuevo_pedido.php?op=buscar_medidas_limit",{idtbl_prod:idtbl_prod,codigo_group:codigo_group,area:area},function(data, status)
				{
					data = JSON.parse(data);

					if (data==null) {

						var idtbl_prod_limit = 0;
						var medida1_limit = 0;
						var medida2_limit = 0;
						var unidad = "";
						

					}else{

						var idtbl_prod_limit = data.idtbl_prod;
						var medida1_limit = data.medida1;
						var medida2_limit = data.medida2;
						var unidad = data.unidad;

					}

					var area_min = parseFloat(medida1_limit)*parseFloat(medida2_limit);

					$("#area_max").val(area_base);
					$("#area_min").val(area_min);

					
					//alert(unidad);

					$("#lbl_area_min").text("Área Minima: ");
					$("#b_area_min").text(" "+area_min+" "+unidad);

					$("#lbl_area_max").text("Área Maxima: ");
					$("#b_area_max").text(" "+area_base+" "+unidad);

					$("#lbl_area_actual").text("Área Actual: ");
					$("#b_area_actual").text(" "+area_base+" "+unidad);
					

				});


			}

			if (set_c_rango==2) {

				$("#div_areas").hide();

				if (cm_inp1==0) {
					document.getElementById('medida1').disabled = true;
					$("#div_medida1").hide();
					
				}else{
					document.getElementById('medida1').disabled = false;
					$("#div_medida1").show();
					
				}
				if (cm_inp2==0) {
					document.getElementById('medida2').disabled = true;
					$("#div_medida2").hide();
					
				}else{
					document.getElementById('medida2').disabled = false;
					$("#div_medida2").show();
					
				}
				if (cm_inp3==0) {
					document.getElementById('medida3').disabled = true;
					$("#div_medida3").hide();
					
				}else{
					document.getElementById('medida3').disabled = false;
					$("#div_medida3").show();
					
				}
				if (cm_inp4==0) {
					document.getElementById('medida4').disabled = true;
					$("#div_medida4").hide();
					
				}else{
					document.getElementById('medida4').disabled = false;
					$("#div_medida4").show();
					
				}

					$("#area_max").val(cm_max);
					$("#area_min").val(cm_min);
					$("#area_max2").val(cm_max2);
					$("#area_min2").val(cm_min2);
					$("#area_max3").val(cm_max3);
					$("#area_min3").val(cm_min3);
					$("#area_max4").val(cm_max4);
					$("#area_min4").val(cm_min4);

					$("#lbl_limit_m1").text("con rango para modificación: +"+cm_max+" "+unidad+" | -"+cm_min+" "+unidad);
					$("#lbl_limit_m2").text("con rango para modificación: +"+cm_max2+" "+unidad+" | -"+cm_min2+" "+unidad);
					$("#lbl_limit_m3").text("con rango para modificación: +"+cm_max3+" "+unidad+" | -"+cm_min3+" "+unidad);
					$("#lbl_limit_m4").text("con rango para modificación: +"+cm_max4+" "+unidad+" | -"+cm_min4+" "+unidad);
			}

		});

	}else{
		bootbox.alert("No se pueden editar las medidas de este producto");
	}

	
}

function ver_div_btn_img()
{
	//$('#div_img_previs').addClass("ver_imagen");
	$('#div_img_previs').removeClass("ocultar_imagen").addClass("ver_imagen");
	$("#btn_ver_imagen").show();
}

function ocultar_div_btn_img()
{
	$('#div_img_previs').removeClass("ver_imagen").addClass("ocultar_imagen");
	$("#btn_ver_imagen").hide();
}

function calc_precio()
{
	var idtbl_prod = $("#idtbl_prod").val();

	$.post("ajax/nuevo_pedido.php?op=buscar_datos_prod",{idtbl_prod:idtbl_prod},function(data, status)
	{		
	data = JSON.parse(data);

		var porc_esp = data.porc_esp;

			var marca_aumento = $("#marca_aumento").val();
			//var porc_esp = $("#porc_esp").val();
			var porc_calc = parseInt(porc_esp)/100;

			if (marca_aumento==0) {

				var precio_back = $("#precio_back").val();
				var cantidad = $("#cantidad").val();
				var precio_total = precio_back*cantidad;
				var precio_total_fixed = precio_total.toFixed(2);
				
				$("#precio_select").text(precio_total_fixed);
				$("#precio_select_desc").text("");
				$("#etiqueta_aumento").text("");

			}else{
				if (marca_aumento==1) {

					var precio_back = $("#precio_back").val();
					var cantidad = $("#cantidad").val();
					var precio_total = precio_back*cantidad;
					var precio_total_fixed = precio_total.toFixed(2);
					var precio_aumento = precio_total*porc_calc;
					var precio_aumento_final = precio_total+precio_aumento;
					var precio_aumento_final_fixed = precio_aumento_final.toFixed(2);

					$("#precio_select").text(precio_aumento_final_fixed);
					$("#precio_select_desc").text("$ "+precio_total_fixed);
					$("#etiqueta_aumento").text("* Se aplica un incremento del "+porc_esp+"% por ser medida especial");


				}
			}
	});


				
}

function valid_medida1()
{
	var idtbl_prod = $("#idtbl_prod").val();

	$.post("ajax/nuevo_pedido.php?op=buscar_datos_prod",{idtbl_prod:idtbl_prod},function(data, status)
	{
		
		data = JSON.parse(data);

		var idtbl_prod = data.idtbl_prod;
		
		
		var set_c_rango = data.set_c_rango;
		var medida1 = data.medida1;
		var medida2 = data.medida2;
		var medida3 = data.medida3;
		var medida4 = data.medida4;
		var unidad = data.unidad;

		var cm_min = data.cm_min;
		var cm_max = data.cm_max;
		var cm_min2 = data.cm_min2;
		var cm_max2 = data.cm_max2;
		var cm_min3 = data.cm_min3;
		var cm_max3 = data.cm_max3;
		var cm_min4 = data.cm_min4;
		var cm_max4 = data.cm_max4;


		if (set_c_rango==1) {
			
			var medidabase1 = $("#medidabase1").val();
			var area_max = $("#area_max").val();
			var area_min = $("#area_min").val();

			var med_inp = $("#medida1").val();
			var med_float = parseFloat(med_inp);		
			var medida1 = med_float.toFixed(1);

			var med2_inp = $("#medida2").val();
			var med2_float = parseFloat(med2_inp);		
			var medida2 = med2_float.toFixed(1);

			var area_consul = parseFloat(medida1)*parseFloat(medida2);

			if (area_consul>area_min && area_consul<=area_max) {


				var x = medida1;
				int_part = Math.trunc(x); // returns 3
				float_part = Number((x-int_part).toFixed(2)); // return 0.2
				//alert(float_part);

				if (float_part==0) {
					$("#medida1").val(int_part);
					$("#b_area_actual").text(" "+parseFloat(med2_inp)*parseFloat(int_part)+" "+unidad);
				}else{
					$("#medida1").val(medida1);
					$("#b_area_actual").text(" "+parseFloat(med2_inp)*parseFloat(medida1)+" "+unidad);
				}



			}else{
				$("#medida1").val(medidabase1);
				bootbox.alert("Ésta medida esta fuera de rango, verifique la seleccion del producto de linea.");
				$("#b_area_actual").text(" "+parseFloat(med2_inp)*parseFloat(medidabase1)+" "+unidad);
			}

		}

		if (set_c_rango==2) {
			var valor_comp = 0
			var med_inp = $("#medida1").val();//Recibe valor capturado
			var med_float = parseFloat(med_inp);//Convierte el valor a float		
			var medida1 = med_float.toFixed(1);//redonde decimales a una cifra
			var x = medida1;
			int_part = Math.trunc(x); // separa el valor entero
			float_part = Number((x-int_part).toFixed(2)); // separa el valor decimal
			if (float_part==0) {
				
					$("#medida1").val(int_part);//si el valor decimal es 0 entonces escribe en campo el valor entero sin decimales
					var valor_comp = int_part

			}else{
					$("#medida1").val(medida1);// si el valor decimal es mayor a cero entonces escribe el valor completo
					var valor_comp = medida1
			}

			var area_max = $("#area_max").val();
			var area_min = $("#area_min").val();
			var medidabase1 = $("#medidabase1").val();

			var valor_minimo = parseFloat(medidabase1)-parseFloat(area_min);
			var valor_maximo = parseFloat(medidabase1)+parseFloat(area_max);

			if (valor_comp>=valor_minimo && valor_comp<=valor_maximo) {
				$("#medida1").val(valor_comp);
			}else{
				bootbox.alert("Ésta medida esta fuera de rango, verifique la seleccion del producto de linea.");
				$("#medida1").val(medidabase1);
				
			}

		}

		update_med_1();


	});
	//var select_busqueda_tipo = $("#select_busqueda_tipo").val();

	
	//alert(id_tipo);
		
		
}


function valid_medida2()
{

	var idtbl_prod = $("#idtbl_prod").val();

	$.post("ajax/nuevo_pedido.php?op=buscar_datos_prod",{idtbl_prod:idtbl_prod},function(data, status)
	{
		
		data = JSON.parse(data);

		var idtbl_prod = data.idtbl_prod;
		var set_c_rango = data.set_c_rango;
		var medida1 = data.medida1;
		var medida2 = data.medida2;
		var medida3 = data.medida3;
		var medida4 = data.medida4;
		var unidad = data.unidad;

		var cm_min = data.cm_min;
		var cm_max = data.cm_max;
		var cm_min2 = data.cm_min2;
		var cm_max2 = data.cm_max2;
		var cm_min3 = data.cm_min3;
		var cm_max3 = data.cm_max3;
		var cm_min4 = data.cm_min4;
		var cm_max4 = data.cm_max4;


		if (set_c_rango==1) {

			var medidabase2 = $("#medidabase2").val();

			var area_max = $("#area_max").val();
			var area_min = $("#area_min").val();

			var med_inp = $("#medida1").val();
			var med_float = parseFloat(med_inp);		
			var medida1 = med_float.toFixed(1);

			var med2_inp = $("#medida2").val();
			var med2_float = parseFloat(med2_inp);		
			var medida2 = med2_float.toFixed(1);

			var area_consul = parseFloat(medida1)*parseFloat(medida2);

			if (area_consul>area_min && area_consul<=area_max) {


				var x = medida2;
				int_part = Math.trunc(x); // returns 3
				float_part = Number((x-int_part).toFixed(2)); // return 0.2
				//alert(float_part);

				if (float_part==0) {
					$("#medida2").val(int_part);
					$("#b_area_actual").text(" "+parseFloat(med_inp)*parseFloat(int_part)+" "+unidad);
				}else{
					$("#medida2").val(medida2);
					$("#b_area_actual").text(" "+parseFloat(med_inp)*parseFloat(medida2)+" "+unidad);
				}

			}else{
				$("#medida2").val(medidabase2);
				bootbox.alert("Ésta medida esta fuera de rango, verifique la seleccion del producto de linea.");
				$("#b_area_actual").text(" "+parseFloat(med_inp)*parseFloat(medidabase2)+" "+unidad);
			}

		}

		if (set_c_rango==2) {
			var valor_comp = 0
			var med_inp = $("#medida2").val();//Recibe valor capturado
			var med_float = parseFloat(med_inp);//Convierte el valor a float		
			var medida2 = med_float.toFixed(1);//redonde decimales a una cifra
			var x = medida2;
			int_part = Math.trunc(x); // separa el valor entero
			float_part = Number((x-int_part).toFixed(2)); // separa el valor decimal
			if (float_part==0) {
				
					$("#medida2").val(int_part);//si el valor decimal es 0 entonces escribe en campo el valor entero sin decimales
					var valor_comp = int_part;
			}else{
					$("#medida2").val(medida2);// si el valor decimal es mayor a cero entonces escribe el valor completo
					var valor_comp = medida2;
			}

			var area_min2 = $("#area_min2").val();
			var area_max2 = $("#area_max2").val();
			var medidabase2 = $("#medidabase2").val();

			var valor_minimo = parseFloat(medidabase2)-parseFloat(area_min2);
			var valor_maximo = parseFloat(medidabase2)+parseFloat(area_max2);

			if (valor_comp>=valor_minimo && valor_comp<=valor_maximo) {
				$("#medida2").val(valor_comp);
			}else{
				bootbox.alert("Ésta medida esta fuera de rango, verifique la seleccion del producto de linea.");
				$("#medida2").val(medidabase2);
			}

		}

		update_med_1();


    });	
		
}



function valid_medida3()
{

	var idtbl_prod = $("#idtbl_prod").val();

	$.post("ajax/nuevo_pedido.php?op=buscar_datos_prod",{idtbl_prod:idtbl_prod},function(data, status)
	{
		
		data = JSON.parse(data);

		var idtbl_prod = data.idtbl_prod;
		var set_c_rango = data.set_c_rango;
		var medida1 = data.medida1;
		var medida2 = data.medida2;
		var medida3 = data.medida3;
		var medida4 = data.medida4;
		var unidad = data.unidad;

		

		if (set_c_rango==2) {
			var valor_comp = 0
			var med_inp = $("#medida3").val();//Recibe valor capturado
			var med_float = parseFloat(med_inp);//Convierte el valor a float		
			var medida3 = med_float.toFixed(1);//redonde decimales a una cifra
			var x = medida3;
			int_part = Math.trunc(x); // separa el valor entero
			float_part = Number((x-int_part).toFixed(2)); // separa el valor decimal
			if (float_part==0) {
				
					$("#medida3").val(int_part);//si el valor decimal es 0 entonces escribe en campo el valor entero sin decimales
					var valor_comp = int_part;
			}else{
					$("#medida3").val(medida3);// si el valor decimal es mayor a cero entonces escribe el valor completo
					var valor_comp = medida3;
			}

			var area_min3 = $("#area_min3").val();
			var area_max3 = $("#area_max3").val();
			var medidabase3 = $("#medidabase3").val();

			var valor_minimo = parseFloat(medidabase3)-parseFloat(area_min3);
			var valor_maximo = parseFloat(medidabase3)+parseFloat(area_max3);

			if (valor_comp>=valor_minimo && valor_comp<=valor_maximo) {
				$("#medida3").val(valor_comp);
			}else{
				bootbox.alert("Ésta medida esta fuera de rango, verifique la seleccion del producto de linea.");
				$("#medida3").val(medidabase3);
			}

		}

		update_med_1();	

	});

	

		
		
}


function valid_medida4()
{

	var idtbl_prod = $("#idtbl_prod").val();

	$.post("ajax/nuevo_pedido.php?op=buscar_datos_prod",{idtbl_prod:idtbl_prod},function(data, status)
	{
		
		data = JSON.parse(data);

		var idtbl_prod = data.idtbl_prod;
		var set_c_rango = data.set_c_rango;
		var medida1 = data.medida1;
		var medida2 = data.medida2;
		var medida3 = data.medida3;
		var medida4 = data.medida4;
		var unidad = data.unidad;

		if (set_c_rango==2) {
			var valor_comp = 0
			var med_inp = $("#medida4").val();//Recibe valor capturado
			var med_float = parseFloat(med_inp);//Convierte el valor a float		
			var medida4 = med_float.toFixed(1);//redonde decimales a una cifra
			var x = medida4;
			int_part = Math.trunc(x); // separa el valor entero
			float_part = Number((x-int_part).toFixed(2)); // separa el valor decimal
			if (float_part==0) {
				
					$("#medida4").val(int_part);//si el valor decimal es 0 entonces escribe en campo el valor entero sin decimales
					var valor_comp = int_part;
			}else{
					$("#medida4").val(medida4);// si el valor decimal es mayor a cero entonces escribe el valor completo
					var valor_comp = medida4;
			}

			var area_min4 = $("#area_min4").val();
			var area_max4 = $("#area_max4").val();
			var medidabase4 = $("#medidabase4").val();

			var valor_minimo = parseFloat(medidabase4)-parseFloat(area_min4);
			var valor_maximo = parseFloat(medidabase4)+parseFloat(area_max4);

			if (valor_comp>=valor_minimo && valor_comp<=valor_maximo) {
				$("#medida4").val(valor_comp);
			}else{
				bootbox.alert("Ésta medida esta fuera de rango, verifique la seleccion del producto de linea.");
				$("#medida4").val(medidabase4);
			}

		}

		update_med_1();	

	});
	
		
}

function set_codigo()
{
	$('#btn_materiales').removeClass("disableddiv");
	$('#btn_colores').removeClass("disableddiv");
	$('#btn_especificaciones').removeClass("disableddiv");
	$('#btn_variaciones').removeClass("disableddiv");
	//limpiar();
	cargar_cajas_modal();

	var select_busqueda_tamano = $("#select_busqueda_tamano").val();
	var idtbl_prod = select_busqueda_tamano;

	$.post("ajax/nuevo_pedido.php?op=buscar_datos_prod",{idtbl_prod:idtbl_prod},function(data, status)
	{
		data = JSON.parse(data);

		
		var idtbl_prod = data.idtbl_prod;
		$("#idtbl_prod").val(idtbl_prod);
		var codigo_group = data.codigo_group;
		var set_c_rango = data.set_c_rango;
		var medida1 = data.medida1;
		var medida2 = data.medida2;
		var medida3 = data.medida3;
		var medida4 = data.medida4;
		var concepto1 = data.concepto1;
		var concepto2 = data.concepto2;
		var concepto3 = data.concepto3;
		var concepto4 = data.concepto4;
		var area = data.area;
		var codigo = data.codigo;
		var nombre_group = data.nombre_group;
		var precio = data.precio;
		var unidad = data.unidad;

		var cm_min = data.cm_min;
		var cm_max = data.cm_max;
		var cm_min2 = data.cm_min2;
		var cm_max2 = data.cm_max2;
		var cm_min3 = data.cm_min3;
		var cm_max3 = data.cm_max3;
		var cm_min4 = data.cm_min4;
		var cm_max4 = data.cm_max4;

		var set_color = data.set_color;
		var set_material = data.set_material;
		var set_medidas = data.set_medidas;
		var set_medidas_edit = data.set_medidas_edit;

		var cm_inp1 = parseInt(cm_min)+parseInt(cm_max);
		var cm_inp2 = parseInt(cm_min2)+parseInt(cm_max2);
		var cm_inp3 = parseInt(cm_min3)+parseInt(cm_max3);
		var cm_inp4 = parseInt(cm_min4)+parseInt(cm_max4);

		$("#lbl_medida1").text(concepto1+" ("+unidad+")");
		$("#lbl_medida2").text(concepto2+" ("+unidad+")");
		$("#lbl_medida3").text(concepto3+" ("+unidad+")");
		$("#lbl_medida4").text(concepto4+" ("+unidad+")");

		$("#medida1").val(medida1);
		$("#medida2").val(medida2);
		$("#medida3").val(medida3);
		$("#medida4").val(medida4);

		$("#medidabase1").val(medida1);
		$("#medidabase2").val(medida2);
		$("#medidabase3").val(medida3);
		$("#medidabase4").val(medida4);


		$("#codigo_prod").text(codigo);
		$("#descrip_prod").text(nombre_group);				
		$("#precio_select").text(precio);
		$("#precio_back").val(precio);

		if (medida1>0) {
			var med1 = ", "+concepto1+": "+medida1+" "+unidad;
			document.getElementById('medida1').disabled = false;
		}else{
			var med1 = "";
			document.getElementById('medida1').disabled = true;
		}
		
		if (medida2>0) {
			var med2 = ", "+concepto2+": "+medida2+" "+unidad;
			document.getElementById('medida2').disabled = false;
		}else{
			var med2 = "";
			document.getElementById('medida2').disabled = true;
		}

		if (medida3>0) {
			var med3 = ", "+concepto3+": "+medida3+" "+unidad;
			document.getElementById('medida3').disabled = false;
		}else{
			var med3 = "";
			document.getElementById('medida3').disabled = true;
		}

		if (medida4>0) {
			var med4 = ", "+concepto4+": "+medida4+" "+unidad;
			document.getElementById('medida4').disabled = false;
		}else{
			var med4 = "";
			document.getElementById('medida4').disabled = true;
		}

		//$("#medidas_prod").text(medida1+"x"+medida2+med3+med4+" CM");
		$("#medidas_prod").text(med1+med2+med3+med4);
		$("#cantidad").val("1");
		$("#prod_esp").val("0");

		if (set_c_rango==1) {

			$("#div_areas").show();
			$("#div_eti_new_med").show();

			var area_base = parseFloat(medida1)*parseFloat(medida2);

			$.post("ajax/nuevo_pedido.php?op=buscar_medidas_limit",{idtbl_prod:idtbl_prod,codigo_group:codigo_group,area:area},function(data, status)
			{
						data = JSON.parse(data);

						if (data==null) {

							var idtbl_prod_limit = 0;
							var medida1_limit = 0;
							var medida2_limit = 0;
							var unidad = "";
							

						}else{

							var idtbl_prod_limit = data.idtbl_prod;
							var medida1_limit = data.medida1;
							var medida2_limit = data.medida2;
							var unidad = data.unidad;

						}

						var area_min = parseFloat(medida1_limit)*parseFloat(medida2_limit);

						$("#area_max").val(area_base);
						$("#area_min").val(area_min);

						$("#lbl_area_min").text("Área Minima: ");
						$("#b_area_min").text(" "+area_min+" "+unidad);

						$("#lbl_area_max").text("Área Maxima: ");
						$("#b_area_max").text(" "+area_base+" "+unidad);

						$("#lbl_area_actual").text("Área Actual: ");
						$("#b_area_actual").text(" "+area_base+" "+unidad);

						if (set_color==1) {
							$("#btn_colores").show();
						}else{
							$("#btn_colores").hide();
						}

						if (set_material==1) {
							$("#btn_materiales").show();
						}else{
							$("#btn_materiales").hide();
						}


						$.post("ajax/nuevo_pedido.php?op=listar_colores&idtbl_prod="+idtbl_prod,function(r){
						$("#select_busqueda_color_base").html(r);

							$.post("ajax/nuevo_pedido.php?op=listar_colores_esp&idtbl_prod="+idtbl_prod,function(r){
							$("#select_busqueda_color_var").html(r);

								$.post("ajax/nuevo_pedido.php?op=listar_especif&idtbl_prod="+idtbl_prod,function(r){
									$("#div_select_especif").html(r);
								});

																	       
							});
															       
						});	

			});


		}

	});
	
}


function mostrar_detalle_prod(idtbl_prod)
{
	limpiar();
	$('#btn_materiales').addClass("disableddiv");
	$('#btn_colores').addClass("disableddiv");
	$('#btn_especificaciones').addClass("disableddiv");
	$('#btn_variaciones').addClass("disableddiv");

	$('#div_img_previs').removeClass("ver_imagen").addClass("ocultar_imagen");
	$("#btn_ver_imagen").hide();
	//%("#btn_verimagen").hide();
	
	$("#div_configuracion").show();
	$("#div_edit_medidas").show();
	$("#div_imagen").hide();
	$("#div_edit_materiales").hide();
	$("#div_select_color").hide();
	$("#div_especif_prod").hide();
	$("#div_inv_variaciones").hide();

	$("#div_select_iniciales").hide();//Ocultar xelects de filtros iniciales
	$("#div_prod_seleccionado").show();// mostrar divs para el producto seleccionado

	$("#div_producto").show();// mostrar div para configurar producto
	$("#div_pedido").hide(); //mostrar div para seleccionar el tipo de pedido
	$("#div_facturacion").hide(); //div para datos de facturación	
	$("#div_confirmacion").hide();
	$("#div_list_prod_selec").hide();
	$("#div_btn_guardar_pedido").hide();
	$("#div_documentos").hide();
	//$("#div_subir_archivos").hide();

	$.post("ajax/nuevo_pedido.php?op=buscar_datos_prod",{idtbl_prod:idtbl_prod},function(data, status)
	{
		data = JSON.parse(data);

		var idtbl_prod = data.idtbl_prod;
		$("#idtbl_prod").val(idtbl_prod);
		var codigo_s = data.codigo_s;
		var set_medidas = data.set_medidas;
		var codigo_group = data.codigo_group;
		var set_material = data.set_material;
		var set_color = data.set_color;
		var medida1 = data.medida1;
		var medida2 = data.medida2;
		var medida3 = data.medida3;
		var medida4 = data.medida4;
		var concepto1 = data.concepto1;
		var concepto2 = data.concepto2;
		var concepto3 = data.concepto3;
		var concepto4 = data.concepto4;
		var unidad = data.unidad;
		var set_c_rango = data.set_c_rango;
		var set_medidas_edit = data.set_medidas_edit;
		var nombre_group = data.nombre_group;
		var precio = data.precio;

				var cm_min = data.cm_min;
				var cm_max = data.cm_max;
				var cm_min2 = data.cm_min2;
				var cm_max2 = data.cm_max2;
				var cm_min3 = data.cm_min3;
				var cm_max3 = data.cm_max3;
				var cm_min4 = data.cm_min4;
				var cm_max4 = data.cm_max4;

				var cm_inp1 = parseInt(cm_min)+parseInt(cm_max);
				var cm_inp2 = parseInt(cm_min2)+parseInt(cm_max2);
				var cm_inp3 = parseInt(cm_min3)+parseInt(cm_max3);
				var cm_inp4 = parseInt(cm_min4)+parseInt(cm_max4);
		
		document.getElementById("imagen_prod_select2").src = "images/pizarron_mel_6mm_2.png";
		//document.getElementById("imagen_prod_select").src = codigo_s;

		if (set_medidas==1) {
			$("#div_select_medidas").show();
			$.post("ajax/nuevo_pedido.php?op=listar_tamano&codigo_group="+codigo_group,function(r){
			$("#select_busqueda_tamano").html(r);
	
				//$('#btn_materiales').removeClass("disableddiv");
			});
		}else{
			$("#div_select_medidas").hide();
			$('#btn_materiales').removeClass("disableddiv");
			$('#btn_colores').removeClass("disableddiv");
			$('#btn_especificaciones').removeClass("disableddiv");
			$('#btn_variaciones').removeClass("disableddiv");					
		}

		//alert(set_medidas_edit);

		if (set_medidas_edit==1) {

				if (set_c_rango==1) {

					document.getElementById('medida1').disabled = true;
					document.getElementById('medida2').disabled = true;
					document.getElementById('medida3').disabled = true;
					document.getElementById('medida4').disabled = true;
					if (medida1==0) {			
						$("#div_medida1").hide();									
					}else{
						$("#div_medida1").show();									
					}
					if (medida2==0) {			
						$("#div_medida2").hide();									
					}else{
						$("#div_medida2").show();									
					}
					if (medida3==0) {			
						$("#div_medida3").hide();									
					}else{
						$("#div_medida3").show();									
					}
					if (medida4==0) {			
						$("#div_medida4").hide();									
					}else{
						$("#div_medida4").show();									
					}

					$("#div_areas").hide();
					$("#div_eti_new_med").hide();

					$("#lbl_medida1").text(concepto1+" ("+unidad+")");
					$("#lbl_medida2").text(concepto2+" ("+unidad+")");
					$("#lbl_medida3").text(concepto3+" ("+unidad+")");
					$("#lbl_medida4").text(concepto4+" ("+unidad+")");

				}

				if (set_c_rango==2) {

					$("#medida1").val(medida1);
					$("#medida2").val(medida2);
					$("#medida3").val(medida3);
					$("#medida4").val(medida4);

					$("#medidabase1").val(medida1);
				    $("#medidabase2").val(medida2);
				    $("#medidabase3").val(medida3);
				    $("#medidabase4").val(medida4);

					$("#div_areas").hide();
					$("#div_eti_new_med").hide();

					if (cm_inp1==0) {
						document.getElementById('medida1').disabled = true;
						$("#div_medida1").hide();
						
					}else{
						document.getElementById('medida1').disabled = false;
						$("#div_medida1").show();
						
					}
					if (cm_inp2==0) {
						document.getElementById('medida2').disabled = true;
						$("#div_medida2").hide();
						
					}else{
						document.getElementById('medida2').disabled = false;
						$("#div_medida2").show();
						
					}
					if (cm_inp3==0) {
						document.getElementById('medida3').disabled = true;
						$("#div_medida3").hide();
						
					}else{
						document.getElementById('medida3').disabled = false;
						$("#div_medida3").show();
						
					}
					if (cm_inp4==0) {
						document.getElementById('medida4').disabled = true;
						$("#div_medida4").hide();
						
					}else{
						document.getElementById('medida4').disabled = false;
						$("#div_medida4").show();
						
					}

						$("#area_max").val(cm_max);
						$("#area_min").val(cm_min);
						$("#area_max2").val(cm_max2);
						$("#area_min2").val(cm_min2);
						$("#area_max3").val(cm_max3);
						$("#area_min3").val(cm_min3);
						$("#area_max4").val(cm_max4);
						$("#area_min4").val(cm_min4);

						$("#lbl_medida1").text(concepto1);
						$("#lbl_medida2").text(concepto2);
						$("#lbl_medida3").text(concepto3);
						$("#lbl_medida4").text(concepto4);

						$("#lbl_limit_m1").text("con rango para modificación: +"+cm_max+" "+unidad+" | -"+cm_min+" "+unidad);
						$("#lbl_limit_m2").text("con rango para modificación: +"+cm_max2+" "+unidad+" | -"+cm_min2+" "+unidad);
						$("#lbl_limit_m3").text("con rango para modificación: +"+cm_max3+" "+unidad+" | -"+cm_min3+" "+unidad);
						$("#lbl_limit_m4").text("con rango para modificación: +"+cm_max4+" "+unidad+" | -"+cm_min4+" "+unidad);



						$("#precio_select").text(precio);
						$("#precio_back").val(precio);

						$("#codigo_prod").text(codigo_group);
						$("#descrip_prod").text(nombre_group);

						if (medida1>0) {
							var med1 = ", "+concepto1+": "+medida1+" "+unidad;
						}else{
							var med1 = "";
						}

						if (medida2>0) {
							var med2 = ", "+concepto2+": "+medida2+" "+unidad;
						}else{
							var med2 = "";
						}

						if (medida3>0) {
							var med3 = ", "+concepto3+": "+medida3+" "+unidad;
						}else{
							var med3 = "";
						}

						if (medida4>0) {
							var med4 = ", "+concepto4+": "+medida4+" "+unidad;
						}else{
							var med4 = "";
						}

						//$("#medidas_prod").text(medida1+"x"+medida2+med3+med4+" CM");
						$("#medidas_prod").text(med1+med2+med3+med4
							);

						$("#cantidad").val("1");


						
					

				}
		}else{

					document.getElementById('medida1').disabled = true;
					document.getElementById('medida2').disabled = true;
					document.getElementById('medida3').disabled = true;
					document.getElementById('medida4').disabled = true;

					$("#medida1").val(medida1);
					$("#medida2").val(medida2);
					$("#medida3").val(medida3);
					$("#medida4").val(medida4);

					if (medida1==0) {			
						$("#div_medida1").hide();									
					}else{
						$("#div_medida1").show();									
					}
					if (medida2==0) {			
						$("#div_medida2").hide();									
					}else{
						$("#div_medida2").show();									
					}
					if (medida3==0) {			
						$("#div_medida3").hide();									
					}else{
						$("#div_medida3").show();									
					}
					if (medida4==0) {			
						$("#div_medida4").hide();									
					}else{
						$("#div_medida4").show();									
					}

					$("#div_areas").hide();
					$("#div_eti_new_med").hide();

					$("#lbl_medida1").text(concepto1+" ("+unidad+")");
					$("#lbl_medida2").text(concepto2+" ("+unidad+")");
					$("#lbl_medida3").text(concepto3+" ("+unidad+")");
					$("#lbl_medida4").text(concepto4+" ("+unidad+")");


						$("#precio_select").text(precio);
						$("#precio_back").val(precio);

						$("#codigo_prod").text(codigo_group);
						$("#descrip_prod").text(nombre_group);

						if (medida1>0) {
							var med1 = ", "+concepto1+": "+medida1+" "+unidad;
						}else{
							var med1 = "";
						}

						if (medida2>0) {
							var med2 = ", "+concepto2+": "+medida2+" "+unidad;
						}else{
							var med2 = "";
						}

						if (medida3>0) {
							var med3 = ", "+concepto3+": "+medida3+" "+unidad;
						}else{
							var med3 = "";
						}

						if (medida4>0) {
							var med4 = ", "+concepto4+": "+medida4+" "+unidad;
						}else{
							var med4 = "";
						}

						//$("#medidas_prod").text(medida1+"x"+medida2+med3+med4+" CM");
						$("#medidas_prod").text(med1+med2+med3+med4
							);

						$("#cantidad").val("1");

		}



		if (set_material==1) {
							$("#btn_materiales").show();
							//$('#btn_materiales').removeClass("disableddiv");
		}else{
							$("#btn_materiales").hide();
		}

		if (set_color==1) {
							$("#btn_colores").show();
							//$('#btn_colores').removeClass("disableddiv");							
		}else{
							$("#btn_colores").hide();
		}



		$.post("ajax/nuevo_pedido.php?op=listar_colores&idtbl_prod="+idtbl_prod,function(r){
		$("#select_busqueda_color_base").html(r);

			$.post("ajax/nuevo_pedido.php?op=listar_colores_esp&idtbl_prod="+idtbl_prod,function(r){
			$("#select_busqueda_color_var").html(r);

				$.post("ajax/nuevo_pedido.php?op=listar_especif&idtbl_prod="+idtbl_prod,function(r){
					$("#div_select_especif").html(r);
				});

													       
			});
											       
		});				

				

	});
	
	
}

function cerrar_div_imagen()
{
	$("#div_imagen").hide();
	$("#div_edit_medidas").show();
}

function ver_imagen_completa()
{	
	var idtbl_prod = $("#idtbl_prod").val();

	//alert(idtbl_prod);

	$.post("ajax/nuevo_pedido.php?op=buscar_datos_prod",{idtbl_prod:idtbl_prod},function(data, status)
	{
		data = JSON.parse(data);

		var codigo_s = data.codigo_s;

		$("#div_imagen").show();
		$("#div_edit_medidas").hide();
		$("#div_edit_materiales").hide();
		$("#div_select_color").hide();
		$("#div_especif_prod").hide();
		$("#div_inv_variaciones").hide();
		document.getElementById("imagen_prod_select").src = codigo_s;

	});

		
}


function select_medidas()
{
	//$("#div_imagen").hide();
	$("#div_configuracion").show();

	$("#div_edit_medidas").show();
	$("#div_edit_materiales").hide();
	$("#div_select_color").hide();
	$("#div_especif_prod").hide();
	$("#div_inv_variaciones").hide();
}





function select_materiales()
{
	//$("#div_imagen").hide();
	$("#div_configuracion").show();

	$("#div_edit_medidas").hide();
	$("#div_edit_materiales").show();
	$("#div_select_color").hide();
	$("#div_especif_prod").hide();
	$("#div_inv_variaciones").hide();
}

function select_color()
{
	//$("#div_imagen").hide();
	$("#div_configuracion").show();

	$("#div_edit_medidas").hide();
	$("#div_edit_materiales").hide();
	$("#div_select_color").show();
	$("#div_colores_otros").hide();
	$("#div_colores_base").show();
	$("#div_especif_prod").hide();
	$("#div_inv_variaciones").hide();
}

function mostrar_otros_colores()
{
	$("#div_colores_otros").show();
	$("#div_colores_base").hide();
}

function mostrar_base_colores()
{
	$("#div_colores_otros").hide();
	$("#div_colores_base").show();
}

function select_especificaciones()
{
	//$("#div_imagen").hide();
	$("#div_configuracion").show();

	$("#div_edit_medidas").hide();
	$("#div_edit_materiales").hide();
	$("#div_select_color").hide();
	
	$("#div_especif_prod").show();
	$("#div_inv_variaciones").hide();
}

function listar_div_variaciones()
{
	//$("#div_imagen").hide();
	$("#div_configuracion").show();

	$("#div_edit_medidas").hide();
	$("#div_edit_materiales").hide();
	$("#div_select_color").hide();
	
	$("#div_especif_prod").hide();
	$("#div_inv_variaciones").show();

	var idtbl_prod = $("#idtbl_prod").val();

	$.post("ajax/nuevo_pedido.php?op=listar_variaciones&idtbl_prod="+idtbl_prod,function(r){
	$("#div_inv_variaciones").html(r);
						       
	});	
	
}



function ver_tabla_productos()
{
	//$("#div_lista_productos").show();
	$("#div_prod_seleccionado").hide();
	$("#div_select_iniciales").show();
	document.getElementById("imagen_prod_select").src = "";

	$("#idtbl_prod").val("");
	$("#idproductos_clasif").val("");
	$("#precio_select").text("");
	$("#precio_back").val("");
	$("#descrip_prod").text("");
	$("#codigo_prod").text("");
	$("#set_color").val("");
	//$("#set_material").val("");
	$("#set_medidas").val("");	

	$("#cantidad").val("1");
	$("#id_tipo").val("");
	$("#id_modelo").val("");
	$("#tamano_mueble").val("");	
	$("#set_c_rango").val("");
	$("#unidad_prod").val("");
	$("#porc_esp").val("");
	$("#nom_color").val("");

	$("#descrip_prod_especif").text("");
	$("#descrip_prod_color").text("");

			$.post("ajax/nuevo_pedido.php?op=listar_tamano&codigo_group="+0,function(r){
			$("#select_busqueda_tamano").html(r);

				$.post("ajax/nuevo_pedido.php?op=listar_colores&idtbl_prod="+0,function(r){
				$("#select_busqueda_color_base").html(r);

					$.post("ajax/nuevo_pedido.php?op=listar_colores_esp&idtbl_prod="+0,function(r){
					$("#select_busqueda_color_var").html(r);
									       
					});

					$("#select_material_ar").val("");			
							       
				});

			});

				
}


function modal_nuevo_color()
{
	var idtbl_prod = $("#idtbl_prod").val();

	$("#modal_color_modif").modal("show");
	$("#div_nuevo_color").show();
	$("#div_select_nuevo_color").hide();

	$.post("ajax/nuevo_pedido.php?op=listar_colores_prod&idtbl_prod="+idtbl_prod,function(r){
	$("#tbl_colores").html(r);
						       
	});
}

function select_nuevo_color()
{
	$("#div_nuevo_color").hide();
	$("#div_select_nuevo_color").show();


}

function guardar_color()
{
	var codigo = $("#select_nuevo_color_opt").val();
	var idtbl_prod = $("#idtbl_prod").val();
	var nombre = $("#nombre_nuevo_color_opt").val();
	/*alert(codigo);
	alert(idtbl_prod);*/

	$.post("ajax/nuevo_pedido.php?op=guardar_color",{idtbl_prod:idtbl_prod,codigo:codigo,nombre,nombre},function(data, status)
	{
		data = JSON.parse(data);

		$.post("ajax/nuevo_pedido.php?op=listar_colores_prod&idtbl_prod="+idtbl_prod,function(r){
		$("#tbl_colores").html(r);

				$.post("ajax/nuevo_pedido.php?op=listar_colores&idtbl_prod="+idtbl_prod,function(r){
				$("#select_busqueda_color_base").html(r);

					$.post("ajax/nuevo_pedido.php?op=listar_colores_esp&idtbl_prod="+idtbl_prod,function(r){
					$("#select_busqueda_color_var").html(r);
									       
					});

					$("#div_nuevo_color").show();
					$("#div_select_nuevo_color").hide();
						       
				});

					
							       
		});

	});
}

function borrar_color_prod(idtblprod_colores)
{
	var idtbl_prod = $("#idtbl_prod").val();

	$.post("ajax/nuevo_pedido.php?op=borrar_color_prod",{idtblprod_colores:idtblprod_colores},function(data, status)
	{
		data = JSON.parse(data);

		$.post("ajax/nuevo_pedido.php?op=listar_colores_prod&idtbl_prod="+idtbl_prod,function(r){
		$("#tbl_colores").html(r);

				$.post("ajax/nuevo_pedido.php?op=listar_colores&idtbl_prod="+idtbl_prod,function(r){
				$("#select_busqueda_color_base").html(r);

					$.post("ajax/nuevo_pedido.php?op=listar_colores_esp&idtbl_prod="+idtbl_prod,function(r){
					$("#select_busqueda_color_var").html(r);
									       
					});
						       
				});

					
							       
		});

	});
}






function limpiar()
{
		limpir_select_esp()
		$("#atention_codigo").hide();
		document.getElementById("imagen_prod_select2").src = "";
		document.getElementById("imagen_prod_select").src = "";
		$("#select_busqueda_tamano").val("");

		$("#idtbl_prod").val("");

		$("#lbl_medida1").text("");
		$("#lbl_limit_m1").text("");
		$("#medida1").val("");
		$("#medidabase1").val("");
		$("#area_max").val("");
		$("#area_min").val("");

		$("#lbl_medida2").text("");
		$("#lbl_limit_m2").text("");
		$("#medida2").val("");
		$("#medidabase2").val("");
		$("#area_max2").val("");
		$("#area_min2").val("");

		$("#lbl_medida3").text("");
		$("#lbl_limit_m3").text("");
		$("#medida3").val("");
		$("#area_max3").val("");
		$("#area_min3").val("");

		$("#lbl_medida4").text("");
		$("#lbl_limit_m4").text("");
		$("#medida4").val("");
		$("#area_max4").val("");
		$("#area_min4").val("");

		$("#lbl_area_min").text("");
		$("#lbl_area_max").text("");
		$("#lbl_area_actual").text("");

		$("#b_area_min").text("");
		$("#b_area_max").text("");
		$("#b_area_actual").text("");

		//cont_esp=0;

		$("#codigo_prod").text("");
		$("#material_codigo").text("");
		$("#color_codigo").text("");
		$("#especif_codigo").text("");

		$("#descrip_prod").text("");
		$("#descrip_prod_material").text("");
		$("#descrip_prod_especif").text("");
		$("#descrip_prod_color").text("");

		$("#medidas_prod").text("");
		$("#cantidad").val("1");
		$("#precio_select_desc").text("");
		$("#precio_select").text("");
		$("#marca_aumento").val("0");
		$("#precio_back").val("");
		$("#etiqueta_aumento").text("");
		$("#prod_esp").val("0");
	


		$.post("ajax/nuevo_pedido.php?op=listar_colores&idtbl_prod="+0,function(r){
		$("#select_busqueda_color_base").html(r);

			$.post("ajax/nuevo_pedido.php?op=listar_colores_esp&idtbl_prod="+0,function(r){
			$("#select_busqueda_color_var").html(r);

				$.post("ajax/nuevo_pedido.php?op=listar_especif&idtbl_prod="+0,function(r){
				$("#div_select_especif").html(r);

					$.post("ajax/nuevo_pedido.php?op=listar_variaciones&idtbl_prod="+0,function(r){
					$("#div_inv_variaciones").html(r);
										       
					});	


				});

													       
			});
											       
		});	




}

function limpir_select_esp()
{
	var tot = cont_esp;
	//alert(tot);
	//var cont_esp_ini = 0;

	if (tot>0) {
		while(tot>=0){
			//alert(tot);
			$("#lab_esp" + tot).remove();
			tot=parseInt(tot)-1;

			if (tot<0) {

				//alert("Selecciones limpiadas");
				cont_esp=0;
			}

		}
	}

		
}



function cargar_cajas_modal()
{
	//alert(cont_esp);
	limpir_select_esp();
		$("#atention_codigo").hide();
		$("#idtbl_prod").val("");

		$("#lbl_medida1").text("");
		$("#lbl_limit_m1").text("");
		$("#medida1").val("");
		$("#medidabase1").val("");
		$("#area_max").val("");
		$("#area_min").val("");

		$("#lbl_medida2").text("");
		$("#lbl_limit_m2").text("");
		$("#medida2").val("");
		$("#medidabase2").val("");
		$("#area_max2").val("");
		$("#area_min2").val("");

		$("#lbl_medida3").text("");
		$("#lbl_limit_m3").text("");
		$("#medida3").val("");
		$("#area_max3").val("");
		$("#area_min3").val("");

		$("#lbl_medida4").text("");
		$("#lbl_limit_m4").text("");
		$("#medida4").val("");
		$("#area_max4").val("");
		$("#area_min4").val("");

		$("#lbl_area_min").text("");
		$("#lbl_area_max").text("");
		$("#lbl_area_actual").text("");

		$("#b_area_min").text("");
		$("#b_area_max").text("");
		$("#b_area_actual").text("");

		//cont_esp=0;

		$("#codigo_prod").text("");
		$("#material_codigo").text("");
		$("#color_codigo").text("");
		$("#especif_codigo").text("");

		$("#descrip_prod").text("");
		$("#descrip_prod_material").text("");
		$("#descrip_prod_especif").text("");
		$("#descrip_prod_color").text("");

		$("#medidas_prod").text("");
		$("#cantidad").val("1");
		$("#precio_select_desc").text("");
		$("#precio_select").text("");
		$("#marca_aumento").val("0");
		$("#precio_back").val("");
		$("#etiqueta_aumento").text("");
		$("#prod_esp").val("0");
	


		$.post("ajax/nuevo_pedido.php?op=listar_colores&idtbl_prod="+0,function(r){
		$("#select_busqueda_color_base").html(r);

			$.post("ajax/nuevo_pedido.php?op=listar_colores_esp&idtbl_prod="+0,function(r){
			$("#select_busqueda_color_var").html(r);

				$.post("ajax/nuevo_pedido.php?op=listar_especif&idtbl_prod="+0,function(r){
				$("#div_select_especif").html(r);

					$.post("ajax/nuevo_pedido.php?op=listar_variaciones&idtbl_prod="+0,function(r){
					$("#div_inv_variaciones").html(r);
										       
					});	


				});

													       
			});
											       
		});	


/*






			$("#lbl_medida1").text("");
			$("#lbl_medida2").text("");
			$("#lbl_medida3").text("");
			$("#lbl_medida4").text("");

			$("#medida1").val("");
			$("#medida2").val("");
			$("#medida3").val("");
			$("#medida4").val("");

			//$("#idtbl_prod_limit").val("");
			$("#medidabase1").val("");
			$("#medidabase2").val("");
			$("#medidabase3").val("");
			$("#medidabase4").val("");
			$("#area_max").val("");
			$("#area_min").val("");
			$("#area_max2").val("");
			$("#area_min2").val("");
			$("#area_max3").val("");
			$("#area_min3").val("");
			$("#area_max4").val("");
			$("#area_min4").val("");

			

			//$("#tbl_eti_med1").val("");
			$("#lbl_area_min").text("");
			$("#b_area_min").text("");

			$("#lbl_area_max").text("");
			$("#b_area_max").text("");

			

			$("#lbl_area_actual").text("");
			$("#b_area_actual").text("");
			
			$("#div_areas").hide();
			

			document.getElementById('medida1').disabled = false;
			document.getElementById('medida2').disabled = false;
			document.getElementById('medida3').disabled = false;
			document.getElementById('medida4').disabled = false;

			$("#lbl_limit_m1").text("");
			$("#lbl_limit_m2").text("");
			$("#lbl_limit_m3").text("");
			$("#lbl_limit_m4").text("");*/
}



function update_med_1()
{
	//ver_div_datos_producto();
	var idtbl_prod = $("#idtbl_prod").val();

	$.post("ajax/nuevo_pedido.php?op=buscar_datos_prod",{idtbl_prod:idtbl_prod},function(data, status)
	{
		data = JSON.parse(data);


		var idtbl_prod = data.idtbl_prod;
		var idproductos_clasif = data.idproductos_clasif;
		var medida1_base = data.medida1;
		var medida2_base = data.medida2;
		var medida3_base = data.medida3;
		var medida4_base = data.medida4;
		var codigo_group = data.codigo_group;
		var nombre_group = data.nombre_group;
		var id_tipo = data.id_tipo;
		var id_modelo = data.id_modelo;
		var codigo = data.codigo;
		var precio = data.precio;
		var set_color = data.set_color;
		var set_material = data.set_material;
		var set_medidas = data.set_medidas;
		var set_medidas_edit = data.set_medidas_edit;
		var nombre_group_esp = data.nombre_group_esp;

		var concepto1 = data.concepto1;
		var concepto2 = data.concepto2;
		var concepto3 = data.concepto3;
		var concepto4 = data.concepto4;
		var unidad = data.unidad;
		var porc_esp = data.porc_esp;

		var medida1 = $("#medida1").val();
		var medida2 = $("#medida2").val();
		var medida3 = $("#medida3").val();
		var medida4 = $("#medida4").val();

		
		
		

		if (medida1==medida1_base && medida2==medida2_base && medida3==medida3_base && medida4==medida4_base) {


			$("#descrip_prod").text(nombre_group);		
			$("#codigo_prod").text(codigo);
			$("#prod_esp").val("0");

			$("#marca_aumento").val("0");

			var precio_back = $("#precio_back").val();
			var cantidad = $("#cantidad").val();



			var precio_total = precio_back*cantidad;
			var precio_total_fixed = precio_total.toFixed(2);
			

			$("#precio_select").text(precio_total_fixed);
			$("#precio_select_desc").text("");
			$("#etiqueta_aumento").text("");

			
		}else{
			$("#descrip_prod").text(nombre_group_esp);				

			if (medida1>0) {
				var med1 = medida1;
			}else{
				var med1 = "";
			}

			if (medida2>0) {
				var med2 = medida2;
			}else{
				var med2 = "";
			}

			if (medida3>0) {
				var med3 = medida3;
			}else{
				var med3 = "";
			}

			if (medida4>0) {
				var med4 = medida4;
			}else{
				var med4 = "";
			}

			//var sum_med = parseFloat(medida1)+parseFloat(medida2)+parseFloat(medida3)+parseFloat(medida4);*/

			//$("#codigo_prod").text("(E) "+codigo+post_code);
			var med1 = med1.replace(/\./g, '');
			var med2 = med2.replace(/\./g, '');
			var med3 = med3.replace(/\./g, '');
			var med4 = med4.replace(/\./g, '');

			$("#codigo_prod").text(codigo+med1+med2+med3+med4);
			$("#prod_esp").val("1");
			$("#marca_aumento").val("1");

			var precio_back = $("#precio_back").val();
			var cantidad = $("#cantidad").val();
			//var porc_esp = $("#porc_esp").val();
			var porc_calc = parseInt(porc_esp)/100;

			var precio_total = precio_back*cantidad;
			var precio_total_fixed = precio_total.toFixed(2);
			var precio_aumento = precio_total*porc_calc;
			var precio_aumento_final = precio_total+precio_aumento;
			var precio_aumento_final_fixed = precio_aumento_final.toFixed(2);

			$("#precio_select").text(precio_aumento_final_fixed);
			$("#precio_select_desc").text("$ "+precio_total_fixed);
			$("#etiqueta_aumento").text("* Se aplica un incremento del "+porc_esp+"% por ser medida especial");

		}
		
		if (medida1>0) {
			var med1 = ", "+concepto1+": "+medida1+" "+unidad;
		}else{
			var med1 = "";
		}

		if (medida2>0) {
			var med2 = ", "+concepto2+": "+medida2+" "+unidad;
		}else{
			var med2 = "";
		}

		if (medida3>0) {
			var med3 = ", "+concepto3+": "+medida3+" "+unidad;
		}else{
			var med3 = "";
		}

		if (medida4>0) {
			var med4 = ", "+concepto4+": "+medida4+" "+unidad;
		}else{
			var med4 = "";
		}

		//$("#medidas_prod").text(medida1+"x"+medida2+med3+med4+" CM");
		$("#medidas_prod").text(med1+med2+med3+med4);

		$("#modal_medidas_modif").modal("hide");

	});






	
}




function list_prod_select()
{


				var idtbl_prod = $("#idtbl_prod").val();
				
				var cantidad = $("#cantidad").val();

				
				var codigo_completo = $("#codigo_completo").text();
				var codigo_prod = codigo_completo.replace(/\s+/g, '');


				var medidas_prod = $("#medidas_prod").text();
				
				var descrip_prod = $("#descrip_prod_completo").text();
				var precio_select = $("#precio_select").text();
				var precio_back = $("#precio_back").val();

				var select_tamano = $("#select_busqueda_tamano").val();
				var select_material = $("#select_material_ar").val();
				var select_color = $("#nom_color").val();
				var tamano_mueble = $("#tamano_mueble").val();



				if (select_tamano==null) {
					select_tamano="";
				}
				if (select_color==null) {
					select_color="";
				}

				$.post("ajax/nuevo_pedido.php?op=buscar_datos_prod",{idtbl_prod:idtbl_prod},function(data, status)
				{
					data = JSON.parse(data);

					var set_color = data.set_color;
					var set_material = data.set_material;
					var set_medidas = data.set_medidas;
					//var id_tamanio = data.id_tamanio;

					//var back_color = "FCCECB";

					/*alert(set_color+" "+select_color);
					alert(set_material+" "+select_material);
					alert(set_medidas+" "+select_tamano);*/
					var color_codigo = $("#color_codigo").text();
					var val_color = 0;
					var val_material = 0;
					var val_medidas = 0;

					//alert(color_codigo);

					if (color_codigo!="") {
						var val_color = 1;
					}else{
						if (set_color==0 && select_color=="") {
							var val_color = 1;
						}else{
							var val_color = 0;
						}						
					}



					if (set_material==1 && select_material!="") {		
						var val_material = 1;
					}else{
						if (set_material==0 && select_material=="") {
							var val_material = 1;
						}else{
							var val_material = 0;
						}
					}



					if (set_medidas==1 && select_tamano>0) {
						var val_medidas = 1;
					}else{
						if (set_medidas==0 && select_tamano==0) {
							var val_medidas = 1;
						}else{
							var val_medidas = 0;
						}
					}


					var val_valid = parseInt(val_color)+parseInt(val_material)+parseInt(val_medidas);

					//alert(val_valid);
					$("#num_valid").val(val_valid);
					$("#conf_codigo").text(codigo_prod);
					$("#conf_nombre").text(descrip_prod);
					$("#conf_tamano").text(tamano_mueble);
					$("#conf_medidas").text(medidas_prod);
					$("#conf_color").text(select_color);
					$("#conf_cantidad").text(cantidad);
					$("#conf_precio").text(precio_back);
					$("#conf_precio_tot").text(precio_select);
					
					
					$("#modal_confirm_prod_select").modal("show");


				});
		

	
    	

}




var cont=0;
function confirmar_producto()
{
	var num_valid = $("#num_valid").val();
	//var nombre_tam = $("#nom_tamanio").val();
	var cantidad = $("#conf_cantidad").text();
	var idtbl_prod = $("#idtbl_prod").val();
	var idproductos_clasif = $("#idproductos_clasif").val();
	var codigo_prod = $("#conf_codigo").text();
	var descrip_prod = $("#conf_nombre").text();
	var tamano_mueble = $("#conf_tamano").text();
	var medidas_prod = $("#conf_medidas").text();
	var select_color = $("#conf_color").text();
	var precio_select = $("#conf_precio_tot").text();

	var etiqueta_aumento = $("#etiqueta_aumento").text();
	var prod_esp = $("#prod_esp").val();

	if (prod_esp==1) {
		var eti_prod_esp = "Producto especial";
	}else{
		var eti_prod_esp = "";
	}

	if (num_valid==3) {


								var fila='<tr class="filas" id="fila'+cont+'">'+						    	
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><b name="cantidad[]" style="font-size: 15px;">'+cantidad+'</b><input type="hidden" name="cant[]" value="'+cantidad+'"><input type="hidden" name="idtbl_prod[]" value="'+idtbl_prod+'"><input type="hidden" id="idproductos_clasif[]" value="'+idproductos_clasif+'"></td>'+
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><b id="esp_prod[]" style="20px;">'+eti_prod_esp+'</b><input type="hidden" nameesp_prod[]" value="'+eti_prod_esp+'"></td>'+
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><b id="codigo_prod[]" style="20px;">'+codigo_prod+'</b><input type="hidden" name="code_prod[]" value="'+codigo_prod+'"></td>'+
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><label id="descrip_prod[]">'+descrip_prod+'</label><input type="hidden" name="descripcion_prod[]" value="'+descrip_prod+'"></td>'+
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><b id="observ_prod[]" style="20px;">'+etiqueta_aumento+'</b><input type="hidden" name="observ_prod[]" value="'+etiqueta_aumento+'"></td>'+						    	
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><b id="tamano_prod[]">'+tamano_mueble+'</b> / <label id="medidas_prod[]">'+medidas_prod+'</label><input type="hidden" name="tam_prod[]" value="'+tamano_mueble+'"><input type="hidden" name="med_prod[]" value="'+medidas_prod+'"></td>'+						    	
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><b id="color[]">'+select_color+'</b><input type="hidden" name="color_in[]" value="'+select_color+'"></td>'+						    	
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><label style="font-size: 15px;">$</label> <b id="precio_select[]">'+precio_select+'</b><input type="hidden" name="prec_select_input[]" value="'+precio_select+'"></td>'+
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><input name="partida[]" type="number" class="form-control" disabled onchange="aprob_partida();"><input name="partida_num[]" type="hidden" class="form-control" value="0"></td>'+						    	
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')"><i class="fa fa-trash-o"></i></button></td>'+
						    	'</tr>';

						    	var fila_prev='<tr class="filas" id="fila_prev'+cont+'">'+						    	
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><b name="cantidad[]" style="font-size: 15px;">'+cantidad+'</b><input type="hidden" name="cant[]" value="'+cantidad+'"><input type="hidden" name="idtbl_prod[]" value="'+idtbl_prod+'"><input type="hidden" id="idproductos_clasif[]" value="'+idproductos_clasif+'"></td>'+
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><b id="esp_prod[]" style="20px;">'+eti_prod_esp+'</b><input type="hidden" nameesp_prod[]" value="'+eti_prod_esp+'"></td>'+
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><b id="codigo_prod[]" style="20px;">'+codigo_prod+'</b><input type="hidden" name="code_prod[]" value="'+codigo_prod+'"><br><label id="descrip_prod[]">'+descrip_prod+'</label><input type="hidden" name="descripcion_prod[]" value="'+descrip_prod+'"></td>'+
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><b id="observ_prod[]" style="20px;">'+etiqueta_aumento+'</b><input type="hidden" name="observ_prod[]" value="'+etiqueta_aumento+'"></td>'+						    	
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><b id="tamano_prod[]">'+tamano_mueble+'</b> / <label id="medidas_prod[]">'+medidas_prod+'</label><input type="hidden" name="tam_prod[]" value="'+tamano_mueble+'"><input type="hidden" name="med_prod[]" value="'+medidas_prod+'"></td>'+						    	
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><b id="color[]">'+select_color+'</b><input type="hidden" name="color_in[]" value="'+select_color+'"></td>'+						    	
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><label style="font-size: 15px;">$</label> <b id="precio_select[]">'+precio_select+'</b><input type="hidden" name="prec_select_input[]" value="'+precio_select+'"></td>'+						    							    	
						    	'<td style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;"><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')"><i class="fa fa-trash-o"></i></button></td>'+
						    	'</tr>';

						    	cont++;						    	
						    	$('#detalles').append(fila);
						    	$('#detalles_prev').append(fila_prev);
						    	$("#modal_confirm_prod_select").modal("hide");	
						    	$("#prod_seleccionados").text(cont);



						    	

	}else{
		bootbox.alert("Es necesario seleccionar todas las caracteristicas del producto");
	}
}


function eliminarDetalle(indice){
  	$("#fila" + indice).remove();
  	$("#fila_prev" + indice).remove();
  	//var indice = parseInt(indice)-1;
  	$("#prod_seleccionados").text(indice);

  	$("#btn_guardar_pedido").hide();
	$("#btn_validar").show();
}


function aprob_partida()
{
	var cant = document.getElementsByName("cantidad[]");
	var partida_num = document.getElementsByName("partida_num[]");
	var partida = document.getElementsByName("partida[]");

	for (var i = 0; i <cant.length; i++) {

		var part=partida[i];

		if (part.value!="") {
			document.getElementsByName("partida_num[]")[i].value = 1;
		}
		if (part.value>0) {
			document.getElementsByName("partida_num[]")[i].value = 1;
		}

		if (part.value=="") {
			document.getElementsByName("partida_num[]")[i].value = 0;
		}
		if (part.value==0) {
			document.getElementsByName("partida_num[]")[i].value = 0;
		}		
	}
}


/*function guardar_pedido()
{
	var cant = document.getElementsByName("cantidad[]");
}*/


/*function guardar_pedido()
{

	var idtbl_prod = document.getElementsByName("idtbl_prod[]");
	var cant = document.getElementsByName("cant[]");

	//alert(cantidad);

	for (var i = 0; i <idtbl_prod.length; i++){


		var cant_1=cant[i];
		var cant_2=cant_1.value;

				$.post("ajax/nuevo_pedido.php?op=guardar_pedido",{cant_2:cant_2},function(data, status)
				{
					data = JSON.parse(data);

				});

	}
	
	
}*/




function capt_prod()
{
	$("#div_producto").show();
	$("#div_pedido").hide();
	$("#div_facturacion").hide();
	$("#div_confirmacion").hide();
	$("#div_list_prod_selec").hide();
	$("#div_btn_guardar_pedido").hide();
	$("#div_documentos").hide();
	//$("#div_subir_archivos").hide();

		$('#menu1').removeClass("estilo_botones_menu").addClass("estilo_botones_menu_focus");
		$('#menu2').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
		$('#menu3').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
		$('#menu3_5').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
		$('#menu4').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
	
}

function capt_pedido()
{
	$('.fondo1_requeridos').removeClass("fondo1_requeridos").addClass("fondo2_requeridos");
	var seleccionados = $("#prod_seleccionados").text();
	var seleccionados = parseInt(seleccionados);

	//var tipo_ped=$("#select_tipo_pedido").val();

	if (seleccionados>0) {

		$("#div_producto").hide();
		$("#div_pedido").show();
		$("#div_facturacion").hide();	
		$("#div_confirmacion").hide();
		$("#div_list_prod_selec").hide();
		$("#div_btn_guardar_pedido").hide();
		$("#div_documentos").hide();
		//$("#div_subir_archivos").hide();

		var usuario = $("#usuario").text();
		$("#asesor_ped").val(usuario);
		//$("#medio_ped").val("");
		$("#reglam_ped").val("No aplicables");
		$("#condic_ped").val("Contado");

			$('#menu2').removeClass("estilo_botones_menu").addClass("estilo_botones_menu_focus");
			$('#menu1').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
			$('#menu3').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
			$('#menu3_5').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
			$('#menu4').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");

	}else{
		bootbox.alert("Para capturar pedido es necesario seleccionar al menos un producto");
	}


		
}

function capt_fact()
{
	$('.fondo1_requeridos').removeClass("fondo1_requeridos").addClass("fondo2_requeridos");
	var seleccionados = $("#prod_seleccionados").text();
	var seleccionados = parseInt(seleccionados);

	if (seleccionados>0) {

		var select_tipo_pedido = $("#select_tipo_pedido").val();
		var asesor_ped = $("#asesor_ped").val();
		var medio_ped = $("#medio_ped").val();
		var autoriz_ped = $("#autoriz_ped").val();
		var condic_ped = $("#condic_ped").val();
		var metodo_pago_ped = $("#metodo_pago_ped").val();
		var forma_pago_ped = $("#forma_pago_ped").val();

		if (select_tipo_pedido!="" && asesor_ped!="" && medio_ped!="" && autoriz_ped!="") {

			$("#div_producto").hide();
			$("#div_pedido").hide();
			$("#div_facturacion").show();
			$("#div_list_prod_selec").hide();
			$("#div_btn_guardar_pedido").hide();
			//$("#div_subir_archivos").hide();	
			$("#div_confirmacion").hide();
			$("#div_documentos").hide();
			
			$('#menu3').removeClass("estilo_botones_menu").addClass("estilo_botones_menu_focus");
			$('#menu2').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
			$('#menu1').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
			$('#menu3_5').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
			$('#menu4').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");

		}else{
			bootbox.alert("Los campos marcados en azul son obligatorios");

			$('.fondo1_requeridos').removeClass("fondo1_requeridos").addClass("fondo2_requeridos");
		}
	}else{
		bootbox.alert("Para capturar pedido es necesario seleccionar al menos un producto");
	}

		
}


function capt_docs()
{
	$('.fondo1_requeridos').removeClass("fondo1_requeridos").addClass("fondo2_requeridos");
	var seleccionados = $("#prod_seleccionados").text();
	var seleccionados = parseInt(seleccionados);

	if (seleccionados>0) {


		if (select_tipo_pedido!="" && asesor_ped!="" && medio_ped!="" && autoriz_ped!="") {

			$("#div_producto").hide();
			$("#div_pedido").hide();
			$("#div_facturacion").hide();
			$("#div_list_prod_selec").hide();
			$("#div_btn_guardar_pedido").hide();
			//$("#div_subir_archivos").hide();	
			$("#div_confirmacion").hide();
			$("#div_documentos").show();
			
			$('#menu3_5').removeClass("estilo_botones_menu").addClass("estilo_botones_menu_focus");
			$('#menu3').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
			$('#menu2').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
			$('#menu1').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");

			$('#menu4').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");

		}else{
			bootbox.alert("Los campos marcados en azul son obligatorios");

			$('.fondo1_requeridos').removeClass("fondo1_requeridos").addClass("fondo2_requeridos");
		}
	}else{
		bootbox.alert("Para capturar pedido es necesario seleccionar al menos un producto");
	}

		
}




function capt_confirm()
{
	$("#btn_guardar_pedido").hide();
	$("#btn_validar").show();
	$('.fondo1_requeridos').removeClass("fondo1_requeridos").addClass("fondo2_requeridos");

	var idusuario = $("#idusuario").text();	
	var seleccionados = $("#prod_seleccionados").text();
	var seleccionados = parseInt(seleccionados);
	var num_req_docs = $("#num_req_docs").val();

	if (seleccionados>0) {

		if (num_req_docs==0) {

			var fecha=moment().format('YYYY-MM-DD');
			var hora=moment().format('HH:mm:ss');
			var fecha_hora=fecha+" "+hora;

			$("#fecha_hora_input").val(fecha_hora);
				
			var select_tipo_pedido = $("#select_tipo_pedido").val();
			var asesor_ped = $("#asesor_ped").val();
			var medio_ped = $("#medio_ped").val();
			var autoriz_ped = $("#autoriz_ped").val();
			var condic_ped = $("#condic_ped").val();
			var metodo_pago_ped = $("#metodo_pago_ped").val();
			var forma_pago_ped = $("#forma_pago_ped").val();

			var nombre_cliente_ped = $("#nombre_cliente_ped").val();
			var idcliente_ped = $("#idcliente_ped").val();
			var telefono_cliente_ped = $("#telefono_cliente_ped").val();
			var email_cliente_ped = $("#email_cliente_ped").val();
			var razon_cliente_ped = $("#razon_cliente_ped").val();
			var rfc_cliente_ped = $("#rfc_cliente_ped").val();
			var direccion_cliente_ped = $("#direccion_cliente_ped").val();
			var contacto_cliente_ped = $("#contacto_cliente_ped").val();
			var direccion_cliente_ent_ped = $("#direccion_cliente_ent_ped").val();
			var coordenadas_cliente_ped = $("#coordenadas_cliente_ped").val();
			var empaque_ped = $("#empaque_ped").val();
			var forma_entrega_ped = $("#forma_entrega_ped").val();
			var hora_entrega_ped = $("#hora_entrega_ped").val();
			var hora_entrega_ped2 = $("#hora_entrega_ped2").val();
			var doc_ped_sal_ped = $("#doc_ped_sal_ped").val();





			if (
				select_tipo_pedido!="" && 
				asesor_ped!="" && 
				medio_ped!="" && 
				autoriz_ped!="" && 
				nombre_cliente_ped!="" &&
				telefono_cliente_ped!="" &&
				email_cliente_ped!="" &&
				razon_cliente_ped!="" &&
				rfc_cliente_ped!="" &&
				direccion_cliente_ped!="" &&
				contacto_cliente_ped!="" &&
				direccion_cliente_ent_ped!="" &&
				empaque_ped!="" &&
				forma_entrega_ped!="" &&
				doc_ped_sal_ped!=""
				) {

				
				//$("#div_subir_archivos").show();
				var fecha=moment().format('YYYY-MM-DD');
				var hora=moment().format('HH:mm:ss');
				var fecha_hora=fecha+" "+hora;

				//alert(hora);
				var dia_sep=moment().format('DD');
				var mes_sep=moment().format('MM');
				var anio_sep=moment().format('YYYY');

				var hora_sep=moment().format('HH');
				var min_sep=moment().format('mm');
				var seg_sep=moment().format('ss');

				var idprecarga = idusuario+hora_sep+min_sep+seg_sep+dia_sep+mes_sep+anio_sep;


				$.post("ajax/nuevo_pedido.php?op=consul_max_idprecarga_docs",{idprecarga:idprecarga},function(data, status)
				{
					data = JSON.parse(data);

					var result_precarga = data.cant_idprecarga;
					//alert(idprecarga);
					if (result_precarga==0) {

						$("#idprecarga").val(idprecarga);
						

					}else{
						var idprecarga_mas = parseInt(idprecarga)+1;
						$("#idprecarga").val(idprecarga_mas);
						
					}


					bootbox.confirm({
					    message: "Si el tipo de pedido es de Muestras o Licitación será necesario agregar el numero de partida en la lista de productos",
					    buttons: {
					        confirm: {
					            label: 'Aceptar',
					            className: 'btn-success'
					        },
					        cancel: {
					            label: 'Cancelar',
					            className: 'btn-danger'
					        }
					    },
					    callback: function (result) {
					        
					    	if (result==true) {

					    		cargar_doc_lic();
					    		$("#div_producto").hide();
								$("#div_pedido").hide();
								$("#div_facturacion").hide();
								$("#div_list_prod_selec").show();
								$("#div_btn_guardar_pedido").show();	
								$("#div_confirmacion").show();
								$("#div_documentos").hide();

					    		$('#menu4').removeClass("estilo_botones_menu").addClass("estilo_botones_menu_focus");
								$('#menu2').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
								$('#menu3').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
								$('#menu3_5').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");
								$('#menu1').removeClass("estilo_botones_menu_focus").addClass("estilo_botones_menu");

								pasarMontoConv();

					    	}

					    }
					});


				});



							

			}else{
				bootbox.alert("Los campos marcados en azul son obligatorios");

				
			}
		}else{
			bootbox.alert("Es necesario cargar todos los documentos requeridos");
		}

			

	}else{
		bootbox.alert("Para capturar pedido es necesario seleccionar al menos un producto");
	}



	var idusuario = $("#idusuario").text();	
	$("#idusuario_input").val(idusuario);

	var select_tipo_pedido = $("#select_tipo_pedido").val();
	$("#tipo_ped_confirm_input").val(select_tipo_pedido);

	if (select_tipo_pedido==1) {
		$("#tipo_ped_confirm").text("Comercial");
		$("#div_factura").show();
		$("#div_ordendecompra").hide();
		$("#div_contrato").hide();
		$("#div_especif").hide();
		$("#div_anexo").show();

	}
	if (select_tipo_pedido==2) {
		$("#tipo_ped_confirm").text("Licitación");

		$("#div_factura").hide();
		$("#div_ordendecompra").show();
		$("#div_contrato").show();
		$("#div_especif").show();
		$("#div_anexo").show();
	}
	if (select_tipo_pedido==3) {
		$("#tipo_ped_confirm").text("Muestras");

		$("#div_factura").hide();
		$("#div_ordendecompra").hide();
		$("#div_contrato").hide();
		$("#div_especif").show();
		$("#div_anexo").show();
	}
	if (select_tipo_pedido==4) {
		$("#tipo_ped_confirm").text("Existencias");

		$("#div_factura").hide();
		$("#div_ordendecompra").hide();
		$("#div_contrato").hide();
		$("#div_especif").hide();
		$("#div_anexo").hide();
	}

	var asesor_ped = $("#asesor_ped").val();
	$("#asesor_confirm").text(asesor_ped);
	$("#asesor_confirm_input").val(asesor_ped);

	var medio_ped = $("#medio_ped").val();
	$("#medio_confirm").text(medio_ped);
	$("#medio_confirm_input").val(medio_ped);

	var lab_ped = $("#lab_ped").val();
	$("#lab_confirm").text(lab_ped);
	$("#lab_confirm_input").val(lab_ped);

	var autoriz_ped = $("#autoriz_ped").val();
	$("#autorizacion_confirm").text(autoriz_ped);
	$("#autorizacion_confirm_input").val(autoriz_ped);

	var reglam_ped = $("#reglam_ped").val();
	$("#reglam_confirm").text(reglam_ped);
	$("#reglam_confirm_input").val(reglam_ped);

	var condic_ped = $("#condic_ped").val();
	$("#condiciones_confirm").text(condic_ped);
	$("#condiciones_confirm_input").val(condic_ped);

	var metodo_pago_ped = $("#metodo_pago_ped").val();
	$("#metodo_confirm").text(metodo_pago_ped);
	$("#metodo_confirm_input").val(metodo_pago_ped);

	var forma_pago_ped = $("#forma_pago_ped").val();
	$("#forma_confirm").text(forma_pago_ped);
	$("#forma_confirm_input").val(forma_pago_ped);

	var factura_ped = $("#factura_ped").val();
	$("#factura_confirm").text(factura_ped);
	$("#factura_confirm_input").val(factura_ped);

	var uso_cfdi_ped = $("#uso_cfdi_ped").val();
	$("#cfdi_confirm").text(uso_cfdi_ped);
	$("#cfdi_confirm_input").val(uso_cfdi_ped);	

	var nombre_cliente_ped = $("#nombre_cliente_ped").val();
	$("#nomcli_confirm").text(nombre_cliente_ped);
	$("#nomcli_confirm_input").val(nombre_cliente_ped);

	var idcliente_ped = $("#idcliente_ped").val();
	$("#idcliente_input").val(idcliente_ped);

	var telefono_cliente_ped = $("#telefono_cliente_ped").val();
	$("#tel_confirm").text(telefono_cliente_ped);
	$("#tel_confirm_input").val(telefono_cliente_ped);

	var email_cliente_ped = $("#email_cliente_ped").val();
	$("#email_confirm").text(email_cliente_ped);
	$("#email_confirm_input").val(email_cliente_ped);

	var razon_cliente_ped = $("#razon_cliente_ped").val();
	$("#razon_confirm").text(razon_cliente_ped);
	$("#razon_confirm_input").val(razon_cliente_ped);

	var rfc_cliente_ped = $("#rfc_cliente_ped").val();
	$("#rfc_confirm").text(rfc_cliente_ped);
	$("#rfc_confirm_input").val(rfc_cliente_ped);

	var direccion_cliente_ped = $("#direccion_cliente_ped").val();
	$("#direccion_confirm").text(direccion_cliente_ped);
	$("#direccion_confirm_input").val(direccion_cliente_ped);

	var contacto_cliente_ped = $("#contacto_cliente_ped").val();
	$("#contacto_confirm").text(contacto_cliente_ped);
	$("#contacto_confirm_input").val(contacto_cliente_ped);

	var direccion_cliente_ent_ped = $("#direccion_cliente_ent_ped").val();
	$("#direc_ent_confirm").text(direccion_cliente_ent_ped);
	$("#direc_ent_confirm_input").val(direccion_cliente_ent_ped);

	var referencia_cliente_ped = $("#referencia_cliente_ped").val();
	$("#referencia_confirm").text(referencia_cliente_ped);
	$("#referencia_confirm_input").val(referencia_cliente_ped);

	var coordenadas_cliente_ped = $("#coordenadas_cliente_ped").val();
	$("#coordenadas_confirm").text(coordenadas_cliente_ped);
	$("#coordenadas_confirm_input").val(coordenadas_cliente_ped);
	a = document.getElementById("coordenadas_confirm");
	a.setAttribute("href", coordenadas_cliente_ped);

	var empaque_ped = $("#empaque_ped").val();
	$("#empaque_confirm").text(empaque_ped);
	$("#empaque_confirm_input").val(empaque_ped);

	var forma_entrega_ped = $("#forma_entrega_ped").val();
	$("#form_ent_confirm").text(forma_entrega_ped);
	$("#form_ent_confirm_input").val(forma_entrega_ped);

	var hora_entrega_ped = $("#hora_entrega_ped").val();
	var hora_entrega_ped2 = $("#hora_entrega_ped2").val();
	$("#horario_confirm").text(hora_entrega_ped+" - "+hora_entrega_ped2);
	$("#horario_confirm_input1").val(hora_entrega_ped);
	$("#horario_confirm_input2").val(hora_entrega_ped2);

	var detalle_form_ent_cliente_ped = $("#detalle_form_ent_cliente_ped").val();
	$("#det_form_ent_confirm").text(detalle_form_ent_cliente_ped);
	$("#det_form_ent_confirm_input").val(detalle_form_ent_cliente_ped);

	var doc_ped_sal_ped = $("#doc_ped_sal_ped").val();
	$("#fac_rec_confirm").text(doc_ped_sal_ped);
	$("#fac_rec_confirm_input").val(doc_ped_sal_ped);

	var observ_ped = $("#observ_ped").val();
	$("#observ_confirm").text(observ_ped);
	$("#observ_confirm_input").val(observ_ped);

	var nom_arch_fac = $("#text_btn0").text();
	$("#nom_archivo_fac").text(nom_arch_fac);

	var nom_arch_orden = $("#text_btn1").text();
	$("#nom_archivo_orden").text(nom_arch_orden);

	var nom_arch_cont = $("#text_btn2").text();
	$("#nom_archivo_contrato").text(nom_arch_cont);

	var nom_arch_esp = $("#text_btn3").text();
	$("#nom_archivo_esp").text(nom_arch_esp);

	var nom_arch_anexo = $("#text_btn4").text();
	$("#nom_archivo_anexo").text(nom_arch_anexo);

}

function select_clientes()
{
	$("#list_clientes").show();
	$("#form_nuevo_cliente").hide();
	$("#div_botones").show();

	$("#modal_clientes").modal("show");
	var idusuario = $("#idusuario").text();

	$.post("ajax/nuevo_pedido.php?op=listar_clientes&idusuario="+idusuario,function(r){
	$("#tbl_clientes").html(r);
						       
	});
}

function buscar_cliente_lugar()
{
	var nombre_buscar = $("#nom_cliente_buscar").val();
	var idusuario = $("#idusuario").text();

	$.post("ajax/nuevo_pedido.php?op=listar_clientes_buscar&nombre_buscar="+nombre_buscar+"&idusuario="+idusuario,function(r){
	$("#tbl_clientes").html(r);
						       
	});
}

function pasar_datos_cliente(idcliente)
{
	//alert(idcliente);
	$("#modal_clientes").modal("hide");
	$.post("ajax/nuevo_pedido.php?op=buscar_datos_cliente",{idcliente:idcliente},function(data, status)
	{
		data = JSON.parse(data);

		var nombre = data.nombre;
		var telefono = data.telefono;
		var email = data.email;

		var razon = data.razon;
		if (razon==null) {razon="";}
		var rfc = data.rfc;
		if (rfc==null) {rfc="";}
		var calle_fac = data.calle;
		if (calle_fac==null) {calle_fac="";}
		var numero_fac = data.numero;
		if (numero_fac==null) {numero_fac="";}
		var interior_fac = data.interior;
		if (interior_fac==null) {interior_fac="";}
		var colonia_fac = data.colonia;
		if (colonia_fac==null) {colonia_fac="";}
		var ciudad_fac = data.ciudad;
		if (ciudad_fac==null) {ciudad_fac="";}
		var estado_fac = data.estado;
		if (estado_fac==null) {estado_fac="";}
		var cp_fac = data.cp;
		if (cp_fac==null) {cp_fac="";}
		
		var contacto_ent = data.contacto_ent;
		if (contacto_ent==null) {contacto_ent="";}
		var calle_ent = data.calle_ent;
		if (calle_ent==null) {calle_ent="";}
		var numero_ent = data.numero_ent;
		if (numero_ent==null) {numero_ent="";}
		var interior_ent = data.interior_ent;
		if (interior_ent==null) {interior_ent="";}
		var colonia_ent = data.colonia_ent;
		if (colonia_ent==null) {colonia_ent="";}
		var ciudad_ent = data.ciudad_ent;
		if (ciudad_ent==null) {ciudad_ent="";}
		var estado_ent = data.estado_ent;
		if (estado_ent==null) {estado_ent="";}
		var cp_ent = data.cp_ent;
		if (cp_ent==null) {cp_ent="";}
		var ref_ent = data.ref_ent;
		if (ref_ent==null) {ref_ent="";}
		var coordenadas = data.coordenadas;
		if (coordenadas==null) {coordenadas="";}

		if (interior_fac!="") {
			var int_fac = "Int. "+interior_fac+", ";
		}else{
			var int_fac = "";
		}

		if (interior_ent!="") {
			var int_ent = "Int. "+interior_ent+", ";
		}else{
			var int_ent = "";
		}


		if (colonia_fac!="") {
			var col_fac = "Col. "+colonia_fac+", ";
		}else{
			var col_fac = "";
		}

		if (colonia_ent!="") {
			var col_ent = "Int. "+colonia_ent+", ";
		}else{
			var col_ent = "";
		}



		if (cp_fac!="") {
			var cp_fac2 = "Col. "+cp_fac+", ";
		}else{
			var cp_fac2 = "";
		}

		if (cp_ent!="") {
			var cp_ent2 = "Int. "+cp_ent+", ";
		}else{
			var cp_ent2 = "";
		}

		//alert(contacto_ent);

		var direccion_facturacion = calle_fac+" "+numero_fac+" "+int_fac+" "+col_fac+" "+ciudad_fac+" "+estado_fac+" "+cp_fac2;
		var direccion_entrega = calle_ent+" "+numero_ent+" "+int_ent+" "+col_ent+" "+ciudad_ent+" "+estado_ent+" "+cp_ent2;


		$("#nombre_cliente_ped").val(nombre);
		$("#idcliente_ped").val(idcliente);
		$("#telefono_cliente_ped").val(telefono);
		$("#email_cliente_ped").val(email);
		$("#razon_cliente_ped").val(razon);
		$("#rfc_cliente_ped").val(rfc);
		$("#direccion_cliente_ped").val(direccion_facturacion);

		$("#contacto_cliente_ped").val(contacto_ent);
		$("#direccion_cliente_ent_ped").val(direccion_entrega);
		$("#referencia_cliente_ped").val(ref_ent);
		$("#coordenadas_cliente_ped").val(coordenadas);


	});
}



function view_section_selectprod()
{

	var tipo_ped=$("#select_tipo_pedido").val();
		$("#text_btn0").text("");
		$("#text_btn1").text("");
		$("#text_btn2").text("");
		$("#text_btn3").text("");
		$("#text_btn4").text("");

	if (tipo_ped==1) {

		$("#div_doc_factura").show();
		$("#div_doc_orden_compra").hide();
		$("#div_doc_contrato").hide();
		$("#div_doc_especif").hide();
		$("#div_doc_anexo").show();

		$("#num_req_docs").val("0");

	}

	if (tipo_ped==2) {

		$("#div_doc_factura").hide();
		$("#div_doc_orden_compra").show();
		$("#div_doc_contrato").show();
		$("#div_doc_especif").show();
		$("#div_doc_anexo").show();

		$("#num_req_docs").val("3");
	}

	if (tipo_ped==3) {

		$("#div_doc_factura").hide();
		$("#div_doc_orden_compra").hide();
		$("#div_doc_contrato").hide();
		$("#div_doc_especif").show();
		$("#div_doc_anexo").show();

		$("#num_req_docs").val("1");
	}

	if (tipo_ped==4) {

		$("#div_doc_factura").hide();
		$("#div_doc_orden_compra").hide();
		$("#div_doc_contrato").hide();
		$("#div_doc_especif").hide();
		$("#div_doc_anexo").hide();

		$("#num_req_docs").val("0");
	}
		
}

function cargar_doc_lic()
{
	//alert("alert");

	var ar_comprob_lic0 = $("#ar_comprob_lic0").val();
	var ar_comprob_lic1 = $("#ar_comprob_lic1").val();
	var ar_comprob_lic2 = $("#ar_comprob_lic2").val();
	var ar_comprob_lic3 = $("#ar_comprob_lic3").val();
	var ar_comprob_lic4 = $("#ar_comprob_lic4").val();


						
	//alert(ar_comprob_lic0);
							
							if (ar_comprob_lic0!="") {

									var parametros = new FormData($("#formulario")[0]);
									$.ajax({

											data: parametros,
											url: "ajax/nuevo_pedido.php?op=guardar_comprobante_lic0",
											type: "POST",
											contentType: false,
											processData: false,
											beforesend: function(){

											},
											success: function(data, status){

													data = JSON.parse(data);

																										
											}
									});
							}


							if (ar_comprob_lic1!="") {

									var parametros = new FormData($("#formulario")[0]);
									$.ajax({

											data: parametros,
											url: "ajax/nuevo_pedido.php?op=guardar_comprobante_lic1",
											type: "POST",
											contentType: false,
											processData: false,
											beforesend: function(){

											},
											success: function(data, status){

													data = JSON.parse(data);

																										
											}
									});
							}
						

						
						

							if (ar_comprob_lic2!="") {



									var parametros = new FormData($("#formulario")[0]);
									$.ajax({

											data: parametros,
											url: "ajax/nuevo_pedido.php?op=guardar_comprobante_lic2",
											type: "POST",
											contentType: false,
											processData: false,
											beforesend: function(){

											},
											success: function(data, status){

													data = JSON.parse(data);

																								
											}

									});


							}
							



						

							if (ar_comprob_lic3!="") {



									var parametros = new FormData($("#formulario")[0]);
									$.ajax({

											data: parametros,
											url: "ajax/nuevo_pedido.php?op=guardar_comprobante_lic3",
											type: "POST",
											contentType: false,
											processData: false,
											beforesend: function(){

											},
											success: function(data, status){

													data = JSON.parse(data);

													
																								
											}

									});


							}
						

						

							if (ar_comprob_lic4!="") {



									var parametros = new FormData($("#formulario")[0]);
									$.ajax({

											data: parametros,
											url: "ajax/nuevo_pedido.php?op=guardar_comprobante_lic4",
											type: "POST",
											contentType: false,
											processData: false,
											beforesend: function(){

											},
											success: function(data, status){

													data = JSON.parse(data);

													
																								
											}

									});


							}

						

							

							
									
}


function pasarMontoConv()
{

    	var select_tipo_pedido = $("#select_tipo_pedido").val();

    	if (select_tipo_pedido==2 || select_tipo_pedido==3) {

    		var cant = document.getElementsByName("cant[]");
    		for (var i = 0; i <cant.length; i++) {    			
    			document.getElementsByName("partida[]")[i].disabled = false;
    		}

    	}else{

    		var cant = document.getElementsByName("cant[]");
    		for (var i = 0; i <cant.length; i++) {   			
    			document.getElementsByName("partida[]")[i].disabled = true;
    		}
    	}
    	
  		
}

function calcular_totales()
{
	var cant = document.getElementsByName("cant[]");
	var subtotal = 0;
    for (var i = 0; i <cant.length; i++) {    			
    	subtotal += parseFloat(document.getElementsByName("prec_select_input[]")[i].value);
    }

	int_part = Math.trunc(subtotal);
	float_part = Number((subtotal-int_part).toFixed(2));
	var subtotal_fixed = parseFloat(int_part+float_part);
	$("#subtotal_prod").text("  $ "+subtotal_fixed);

	var iva = subtotal_fixed*0.16;

	int_part = Math.trunc(iva);
	float_part = Number((iva-int_part).toFixed(2));
	var iva_fixed = parseFloat(int_part+float_part);
	$("#iva_prod").text("  $ "+iva_fixed);

	var total = parseFloat(subtotal_fixed)+parseFloat(iva_fixed);

	int_part = Math.trunc(total);
	float_part = Number((total-int_part).toFixed(2));
	var total_fixed = parseFloat(int_part+float_part);
	$("#total_prod").text("  $ "+total_fixed);
}

function nuevo_cliente()
{
	$("#list_clientes").hide();
	$("#form_nuevo_cliente").show();
	$("#div_botones").hide();
}

function ver_lista()
{
	$("#list_clientes").show();
	$("#form_nuevo_cliente").hide();
	$("#div_botones").show();
}

function guardar_cliente_nuevo()
{
	var nombre_cliente_new = $("#nombre_cliente_new").val();
	var telefono_cliente_new = $("#telefono_cliente_new").val();
	var email_cliente_new = $("#email_cliente_new").val();

	var razon_cliente_new = $("#razon_cliente_new").val();
	var rfc_cliente_new = $("#rfc_cliente_new").val();
	var calle_cliente_new = $("#calle_cliente_new").val();
	var numero_cliente_new = $("#numero_cliente_new").val();
	var interior_cliente_new = $("#interior_cliente_new").val();
	var colonia_cliente_new = $("#colonia_cliente_new").val();
	var ciudad_cliente_new = $("#ciudad_cliente_new").val();
	var estado_cliente_new = $("#estado_cliente_new").val();
	var cp_cliente_new = $("#cp_cliente_new").val();
	
	var contacto_cliente_new = $("#contacto_cliente_new").val();
	var calle_cliente_ent_new = $("#calle_cliente_ent_new").val();
	var numero_cliente_ent_new = $("#numero_cliente_ent_new").val();
	var interior_cliente_ent_new = $("#interior_cliente_ent_new").val();
	var colonia_cliente_ent_new = $("#colonia_cliente_ent_new").val();
	var ciudad_cliente_ent_new = $("#ciudad_cliente_ent_new").val();
	var estado_cliente_ent_new = $("#estado_cliente_ent_new").val();
	var cp_cliente_ent_new = $("#cp_cliente_ent_new").val();
	var referencia_cliente_new = $("#referencia_cliente_new").val();

	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	var lugar = $("#lugar_user").text();

	//alert(lugar);

		$.post("ajax/nuevo_pedido.php?op=guardar_cliente_nuevo",{
			nombre_cliente_new:nombre_cliente_new,
			telefono_cliente_new:telefono_cliente_new,
			email_cliente_new:email_cliente_new,
			razon_cliente_new:razon_cliente_new,
			rfc_cliente_new:rfc_cliente_new,
			calle_cliente_new:calle_cliente_new,
			numero_cliente_new:numero_cliente_new,
			interior_cliente_new:interior_cliente_new,
			colonia_cliente_new:colonia_cliente_new,
			ciudad_cliente_new:ciudad_cliente_new,
			estado_cliente_new:estado_cliente_new,
			cp_cliente_new:cp_cliente_new,			
			contacto_cliente_new:contacto_cliente_new,
			calle_cliente_ent_new:calle_cliente_ent_new,
			numero_cliente_ent_new:numero_cliente_ent_new,
			interior_cliente_ent_new:interior_cliente_ent_new,
			colonia_cliente_ent_new:colonia_cliente_ent_new,
			ciudad_cliente_ent_new:ciudad_cliente_ent_new,
			estado_cliente_ent_new:estado_cliente_ent_new,
			cp_cliente_ent_new:cp_cliente_ent_new,
			referencia_cliente_new:referencia_cliente_new,
			fecha_hora:fecha_hora,
			lugar:lugar
		},function(data, status)
		{
			data = JSON.parse(data);

			//alert("Guardado");

			var idcliente = data.idcliente;

			//alert(idcliente);

			bootbox.confirm({
			    message: "¿Cliente guardado correctamente, desea enviar los datos a la captura de pedido?",
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

			        	//alert(idcliente);


			        	$.post("ajax/nuevo_pedido.php?op=buscar_datos_cliente",{idcliente:idcliente},function(data, status)
						{
							data = JSON.parse(data);

							$("#modal_clientes").modal("hide");

							var nombre = data.nombre;
							var telefono = data.telefono;
							var email = data.email;

							var razon = data.razon;
							if (razon==null) {razon="";}
							var rfc = data.rfc;
							if (rfc==null) {rfc="";}
							var calle_fac = data.calle;
							if (calle_fac==null) {calle_fac="";}
							var numero_fac = data.numero;
							if (numero_fac==null) {numero_fac="";}
							var interior_fac = data.interior;
							if (interior_fac==null) {interior_fac="";}
							var colonia_fac = data.colonia;
							if (colonia_fac==null) {colonia_fac="";}
							var ciudad_fac = data.ciudad;
							if (ciudad_fac==null) {ciudad_fac="";}
							var estado_fac = data.estado;
							if (estado_fac==null) {estado_fac="";}
							var cp_fac = data.cp;
							if (cp_fac==null) {cp_fac="";}
							
							var contacto_ent = data.contacto_ent;
							if (contacto_ent==null) {contacto_ent="";}
							var calle_ent = data.calle_ent;
							if (calle_ent==null) {calle_ent="";}
							var numero_ent = data.numero_ent;
							if (numero_ent==null) {numero_ent="";}
							var interior_ent = data.interior_ent;
							if (interior_ent==null) {interior_ent="";}
							var colonia_ent = data.colonia_ent;
							if (colonia_ent==null) {colonia_ent="";}
							var ciudad_ent = data.ciudad_ent;
							if (ciudad_ent==null) {ciudad_ent="";}
							var estado_ent = data.estado_ent;
							if (estado_ent==null) {estado_ent="";}
							var cp_ent = data.cp_ent;
							if (cp_ent==null) {cp_ent="";}
							var ref_ent = data.ref_ent;
							if (ref_ent==null) {ref_ent="";}
							var coordenadas = data.coordenadas;
							if (coordenadas==null) {coordenadas="";}

							if (interior_fac!="") {
								var int_fac = "Int. "+interior_fac+", ";
							}else{
								var int_fac = "";
							}

							if (interior_ent!="") {
								var int_ent = "Int. "+interior_ent+", ";
							}else{
								var int_ent = "";
							}


							if (colonia_fac!="") {
								var col_fac = "Col. "+colonia_fac+", ";
							}else{
								var col_fac = "";
							}

							if (colonia_ent!="") {
								var col_ent = "Int. "+colonia_ent+", ";
							}else{
								var col_ent = "";
							}



							if (cp_fac!="") {
								var cp_fac2 = "Col. "+cp_fac+", ";
							}else{
								var cp_fac2 = "";
							}

							if (cp_ent!="") {
								var cp_ent2 = "Int. "+cp_ent+", ";
							}else{
								var cp_ent2 = "";
							}

							//alert(contacto_ent);

							var direccion_facturacion = calle_fac+" "+numero_fac+" "+int_fac+" "+col_fac+" "+ciudad_fac+" "+estado_fac+" "+cp_fac2;
							var direccion_entrega = calle_ent+" "+numero_ent+" "+int_ent+" "+col_ent+" "+ciudad_ent+" "+estado_ent+" "+cp_ent2;


							$("#nombre_cliente_ped").val(nombre);
							$("#idcliente_ped").val(idcliente);
							$("#telefono_cliente_ped").val(telefono);
							$("#email_cliente_ped").val(email);
							$("#razon_cliente_ped").val(razon);
							$("#rfc_cliente_ped").val(rfc);
							$("#direccion_cliente_ped").val(direccion_facturacion);

							$("#contacto_cliente_ped").val(contacto_ent);
							$("#direccion_cliente_ent_ped").val(direccion_entrega);
							$("#referencia_cliente_ped").val(ref_ent);
							$("#coordenadas_cliente_ped").val(coordenadas);


						});

			        }else{

			        	ver_lista();
			        }
			    }
			});
		});

}



function registrar_nuevo_prod()
{
	$("#modal_nuevo_producto_2").modal("show");

	$.post("ajax/diseno.php?op=listar_tipos",function(r){
	$("#tipo_prod_select_new").html(r);

		$.post("ajax/diseno.php?op=listar_modelo_new",function(r){
		$("#modelo_prod_select_new").html(r);

			$.post("ajax/diseno.php?op=listar_tamano_new",function(r){
			$("#tam_prod_select_new").html(r);

				$.post("ajax/nuevo_pedido.php?op=listar_grupos",function(r){
				$("#group_select_new").html(r);
						       
				});			
					       
			});
				       
		});
	       
	});
}




var cont_esp=0;
//var cont_esp2=0;
function select_especif(idespecif_det,nombre,idespecif)
{
	/*alert(idespecif_det);
	alert(nombre);*/
	//var select_especif = nombre;

	if (idespecif_det>0) {


		/*$.post("ajax/nuevo_pedido.php?op=consul_codigo_especif",{idespecif_det:idespecif_det},function(data, status)
		{
			data = JSON.parse(data);*/

			var esp_label = '<label class="font_data" id="lab_esp'+cont_esp+'" style="padding: 5px; background-color: #2A3F54; border-radius: 5px; margin: 2px; color: white;">'+nombre+' <span class="glyphicon glyphicon-remove" aria-hidden="true" style="cursor: pointer;" onclick="eliminarespecif('+cont_esp+');"></span></label>';
			//cont_esp++;
			$('#div_especif_selec').append(esp_label);

			var b_descrip = '<b class="font_data" id="b_descrip_esp'+cont_esp+'" style="color: #fff;">, '+nombre+'</b>';
			//cont_esp++;
			$('#descrip_prod_especif').append(b_descrip);

			var idespecif = "E"+idespecif;

			var b_label = '<b class="font_data" id="b_esp'+cont_esp+'" style="color: #fff;">'+idespecif+'</b>';
			cont_esp++;
			$('#especif_codigo').append(b_label);

			$(function(){
	          var mylist = $('#especif_codigo');
	          var listitems = mylist.children('b').get();
	          listitems.sort(function(a, b) {
	             var compA = $(a).text().toUpperCase();
	             var compB = $(b).text().toUpperCase();
	             return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
	          })
	           $.each(listitems, function(idx, itm) { mylist.append(itm); });

	           $("#select_especif").val("");
	           $("#prod_esp").val("1");

	        });

		//});


																
			
	}
		
}


function eliminarespecif(cont_esp){

	

  	$("#lab_esp" + cont_esp).remove();
  	$("#b_esp" + cont_esp).remove();
  	$("#b_descrip_esp" + cont_esp).remove();

  	
  	var especif_codigo = $("#especif_codigo").text();

  	if (especif_codigo=="") {

  		 $("#prod_esp").val("0");

  	}
  	//alert(especif_codigo);
}

function abrir_modal_config_prod()
{
	$("#modal_config_prod").modal("show");
}

function set_color_codigo(idtblprod_colores)
{
	$.post("ajax/nuevo_pedido.php?op=consul_codigo_color",{idtblprod_colores:idtblprod_colores},function(data, status)
	{
		data = JSON.parse(data);

		var codigo = data.codigo;
		var nombre = data.nombre;
		$("#color_codigo").text(codigo);
		$("#descrip_prod_color").text(", "+nombre);
		$("#nom_color").val(nombre);
	});

}

function set_material_codigo1()
{
	var select_material_ar = "PP";
	$("#material_codigo").text(select_material_ar);
	$("#descrip_prod_material").text("PP");
}

function set_material_codigo2()
{
	var select_material_ar = "FOR"
	$("#material_codigo").text(select_material_ar);
	$("#descrip_prod_material").text("FOR");
}

/*function mostrar_botones_div(idtbl_prod)
{
	//$("#div_btn_opt"+idtbl_prod).
	document.getElementById("div_btn_opt"+idtbl_prod).style.display = "block";
}

function ocultar_botones_div(idtbl_prod)
{
	document.getElementById("div_btn_opt"+idtbl_prod).style.display = "none";
}*/

/*function mostrar_div_especif()
{
	$("#div_especif_config").show();
	$("#div_inv_variaciones").hide();
}*/



function ver_lista_variante_prod(idtbl_prod)
{
	document.getElementById("div_inv_variante"+idtbl_prod).style.display = "block";
	document.getElementById("div_img_prod_var"+idtbl_prod).style.display = "none";

	$.post("ajax/nuevo_pedido.php?op=listar_variaciones&idtbl_prod="+idtbl_prod,function(r){
	$("#div_inv_variante"+idtbl_prod).html(r);
						       
	});	
}

function ver_imagen_prod(idtbl_prod)
{
	document.getElementById("div_inv_variante"+idtbl_prod).style.display = "none";
	document.getElementById("div_img_prod_var"+idtbl_prod).style.display = "block";
}

function solic_medidas_esp()
{
	$("#modal_solicitar_med").modal("show");
	$("#modal_medidas_modif").modal("hide");
}

function regresar_edit_med()
{
	$("#modal_solicitar_med").modal("hide");
	$("#modal_medidas_modif").modal("show");
}

function guardar_solicitud_med()
{
	var idtbl_prod = $("#idtbl_prod").val();
	alert(idtbl_prod);
}

init();