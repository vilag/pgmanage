function init()
{
	// location.href ="https://pgmanage.host/susp.php";
	$("#select_productos_button").hide();
	$("#adj_docs_lic").hide();
	listar_filtros();
	div_inicial_cap_ped();


	var id_ped_temp2 = $("#id_ped_temp2").text();

	if (id_ped_temp2>0) {


		$("#signup-notification").hide();

		//alert("mayor a cero");
		consultas_llenado();

		//abrir_pedido_notif();
		
	}else{
		$("#select_productos_button").hide();
		$("#adj_docs_lic").hide();
		$("#div_filtro_prod").hide();

		$("#signup-notification").show();
		//alert("error");
		llenar_modelos();
		$("#pedido_area").hide();
		
		$("#imagen_prod").attr("src","images/productos/productos/sombra_silla.png");
		//$("#btn_prod").hide();
		//guardar_pedido_temp();
		$("#btn_form_ped").text("Crear pedido");
		$("#page_reporte").hide();

		

		//listar_pedidos();
		

	}



	$("#vista_select").show();
	$("#vista_3d").hide();

	$("#select_product_area").show();
	$("#select_product_area2").hide();
	$("#result_cli").hide();

	cambiar_buscar();
	listar_seguim_prod();

	$("#notif_term_ped").hide();
	//cargar_notif();
	//cargar_notif_part();

	var idusuario=$("#idusuario").text();

	if (idusuario==4 || idusuario==1) {
		//$("#btn_terminados").show();
		$("#group_notif_term").show();
		$("#vistas_seguim").show();
		$("#btn_sinrevisar").show();
		$("#btn_term_pv").hide();
		$("#btn_vencidos").show();
		$("#btn_vales").show();

		if (idusuario==1) {
			$("#btn_new_prod").show();
			$("#div_aplicar_iva").show();
			$("#btn_edit_producto_pedido").show();
			//$("#btn_setid_detped").show();
		}else{
			$("#btn_new_prod").hide();
			$("#div_aplicar_iva").hide();
			$("#btn_edit_producto_pedido").hide();
			//$("#btn_setid_detped").hide();
		}

	}else{
		//$("#btn_terminados").hide();
		$("#group_notif_term").hide();
		$("#vistas_seguim").hide();
		$("#btn_sinrevisar").hide();
		$("#btn_vencidos").hide();
		$("#btn_vales").hide();
		$("#btn_new_prod").hide();
		$("#div_aplicar_iva").hide();
		$("#btn_edit_producto_pedido").hide();
		//$("#btn_setid_detped").hide();

		if (idusuario==2 || idusuario==3 || idusuario==6) {

			$("#btn_term_pv").show();
			$("#notif_term_ped").show();
		}else{
			$("#btn_term_pv").hide();
			$("#notif_term_ped").hide();
		}


	}


	/*contar_prod_sinrev();
	cont_num_vencidos();*/
	cargar_div_pro_select();


}


function abrir_pedido_notif(idpg_pedidos)
{
	
	var idusuario=$("#idusuario").text();
	if (idusuario==4) {

		$.post("ajax/diseno.php?op=abrir_pedido_notif",{idpg_pedidos:idpg_pedidos},function(data, status)
		{
		data = JSON.parse(data);

		});
	}else{

	}

		
}

function abrir_pedido_notif2(idpg_pedidos)
{

	$.post("ajax/diseno.php?op=abrir_pedido_notif2",{idpg_pedidos:idpg_pedidos},function(data, status)
	{
	data = JSON.parse(data);

	});
}





function llenar_modelos()
{	  
	  $.post("ajax/diseno.php?op=llenar_modelos",function(r){
	        $("#box_tipos").html(r);

	  });	  
}

function select_modelos(idmuebles_fam,codigo,marca)
{
	var num = $("#num_tipos").text();
	var contador = 0;

	while(contador<=num){

		if (contador==marca) {
			var intro = document.getElementById('btn_tipos'+contador);
			intro.style.backgroundColor = '#ACFAC3';

			$.post("ajax/diseno.php?op=select_modelos&id="+idmuebles_fam,function(r){
			        $("#box_modelos").html(r);

					limpiar_opciones();
					select_tamano();

					$("#imagen_prod").attr("src","images/productos/productos/sombra_silla.png");
			        
			});

		}

		contador=contador+1;

		var intro = document.getElementById('btn_tipos'+contador);
		intro.style.backgroundColor = '#ffffff';		
	}
	  
}


function marcar_modelos()
{
	var num = $("#num_tipos").text();
	var contador = 0;

	while(contador<=num){

		if (contador==marca) {
			var intro = document.getElementById('btn_tipos'+contador);
			intro.style.backgroundColor = '#ACFAC3';
		}

		contador=contador+1;

		var intro = document.getElementById('btn_tipos'+contador);
		intro.style.backgroundColor = '#ffffff';		
	}
}


function select_tamano(idmodelo,codigo,marca)
{


		var num = marca;
		var contador = 0;

		while(contador<=num){

			if (contador==marca) {
				var intro = document.getElementById('btn_modelos'+contador);
				intro.style.backgroundColor = '#ACFAC3';

				
				$("#lbl_modelo").text(codigo);
				  $.post("ajax/diseno.php?op=select_tamano&id="+idmodelo,function(r){
				        $("#box_tamanos").html(r);

				        create_code2(); 
				         pintar_tamanos();
				         $("#imagen_prod").attr("src","images/productos/productos/sombra_silla.png");   
				        
				});


			}

			contador=contador+1;

			var intro = document.getElementById('btn_modelos'+contador);
			intro.style.backgroundColor = '#ffffff';		
		}

	  
}



function select_colores(idtamano,codigo,marca)
{
	$("#idtamano").text(idtamano);
	$("#codigo2").text(codigo);
	$("#marca2").text(marca);

			$.post("ajax/diseno.php?op=select_colores",function(r){
			        $("#box_colores").html(r);

			        create_code2();
			        pintar_tamanos();
					
			});
			
}

function pintar_tamanos()
{

	var idtamano = $("#idtamano").text();
	var codigo = $("#codigo2").text();
	var marca = $("#marca2").text();


	var num = $("#num_tam").text();
	var contador = 0;

	while(contador<=num){

		if (contador==marca) {
			var intro = document.getElementById('btn_tam'+contador);
			intro.style.backgroundColor = '#ACFAC3';

			
			$("#lbl_tamano").text(codigo);

		}

		contador=contador+1;

		var intro = document.getElementById('btn_tam'+contador);
		intro.style.backgroundColor = '#ffffff';		
	}
}




function create_code(marca,codigo)
{
	$("#codigo3").text(codigo);
	$("#marca3").text(marca);
	//alert(codigo);
	$("#lbl_color").text(codigo);
	var num = $("#num_colores").text();
	var contador = 0;

	while(contador<=num){

		if (contador==marca) {
			var intro = document.getElementById('btn_colores'+contador);
			intro.style.backgroundColor = '#ACFAC3';

			create_code2();

		}

		contador=contador+1;

		var intro = document.getElementById('btn_colores'+contador);
		intro.style.backgroundColor = '#ffffff';		
	}		
	
}




function create_code2()
{
			var lbl_tipo = $("#lbl_tipo").text();
			var lbl_tamano = $("#lbl_tamano").text();
			var lbl_modelo = $("#lbl_modelo").text();
			var lbl_color = $("#lbl_color").text();
			

			$("#span_codigo").text(lbl_tipo+lbl_tamano+lbl_modelo+lbl_color);
			$("#span_codigo").show();

			var codigo = lbl_tipo+lbl_tamano+lbl_modelo+lbl_color;

			//alert(codigo);

			$("#imagen_prod").attr("src","images/productos/productos/"+codigo+".png");
			$("#imagen_prod2").attr("src","images/productos/productos/"+codigo+".png");

			
}


function limpiar_opciones()
{
	var id = 0;

	$.post("ajax/diseno.php?op=select_tamano&id="+id,function(r){
	    $("#box_tamanos").html(r);


		    $.post("ajax/diseno.php?op=select_colores",function(r){
				$("#box_colores").html(r);




				        
				});
			        
	});

}


function limpiar_opciones2()
{
	

		    $.post("ajax/diseno.php?op=select_colores",function(r){
				$("#box_colores").html(r);

				        
			});
			        


}

function select_paletas()
{
	$.post("ajax/diseno.php?op=select_paletas",function(r){
	        $("#box_paletas").html(r);
	});
}

function select_parrillas()
{
	$.post("ajax/diseno.php?op=select_parrillas",function(r){
	        $("#box_parrillas").html(r);
	});
}




function select_estruc_resp()
{
	$.post("ajax/diseno.php?op=select_estruc_resp",function(r){
	        $("#box_estruc_resp").html(r);
	});
}

function select_estruc_pal()
{
	$.post("ajax/diseno.php?op=select_estruc_pal",function(r){
	        $("#box_estruc_pal").html(r);
	});
}





function montar_paletas(idpaletas)
{
	alert(idpaletas);
}

function pagina2()
{
	$("#pagina1").hide();
	$("#pagina2").show();
}
function pagina1()
{
	$("#pagina2").hide();
	$("#pagina1").show();
}

function listar_productos_seleccionados()
{

	/*$("#pedido_area").show();
	$("#titulo_ped").text("PRODUCTOS SELECCIONADOS");
	$("#btn_form_ped").text("Crear pedido");

	$("#form_pedido").hide();
	$("#tbl_prod_pedidos").show();*/

	tbl_prod_ped();

	var fecha=moment().format('YYYY-MM-DD');
	

	$("#fecha_pedido").val(fecha);
	$("#fecha_envio_enlace").val(fecha);


}



/*function guardar_pedido_temp()
{
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	//alert(fecha_hora);

	$.post("ajax/diseno.php?op=guardar_pedido_temp",{fecha_hora:fecha_hora},function(data, status)
	{
		data = JSON.parse(data);

		$("#id_ped_temp").val(data.idpg_pedidos);
		$("#idpedido").val(data.idpg_pedidos);

		
	});
}*/

function guardar_prod_ped()
{
	var codigo = $("#span_codigo").text();
	var id_ped_temp = $("#id_ped_temp").val();

	//alert(codigo);

	$.post("ajax/diseno.php?op=consul_idprod",{codigo:codigo},function(data, status)
	{
		data = JSON.parse(data);

		//alert(data.idproducto);
		var idproducto = data.idproducto;
		var precio = data.precio_total;


		$.post("ajax/diseno.php?op=consul_exist",{idproducto:idproducto,id_ped_temp:id_ped_temp},function(data, status)
		{
		data = JSON.parse(data);

			//alert(data.num_prod);

			if (data.num_prod==0) {

				$.post("ajax/diseno.php?op=save_prod_ped",{idproducto:idproducto,id_ped_temp:id_ped_temp,precio:precio},function(data, status)
				{
					data = JSON.parse(data);

					//alert("producto agregado");


					//consul_prod_ped();
					listar_productos_seleccionados();


				});

			}else{
				bootbox.alert("Este producto ya fue agregado");
			}

		});


			

	});	
}


/*function consul_prod_ped()
{
	var id_ped_temp = $("#id_ped_temp").val();

	$.post("ajax/diseno.php?op=consul_prod_ped&id="+id_ped_temp,function(r){
	$("#ul_prod_ped").html(r);

			$.post("ajax/diseno.php?op=num_prod_ped",{id_ped_temp:id_ped_temp},function(data, status)
			{
			data = JSON.parse(data);

				//alert(data.num_pro_tot);
				$("#num_produ_ped").text(data.num_pro_tot);

			});

	});
}*/



function cambiar_texto()
{
	var texto = $("#btn_form_ped").text();

	if (texto=="Crear pedido") {
		$("#btn_form_ped").text("Mostrar productos");
		
		//ultimo_control();
		$("#dat_control").show();
		$("#dat_fac").hide();
		$("#dat_ent").hide();
		$("#det_ped").hide();
		$("#det_pago").hide();
		$("#titulo_ped").text("CAPTURAR PEDIDO");
		$("#btn_save_pedido").hide();
		//$("#div_filtro_prod").hide();



	}
	if (texto=="Mostrar productos") {
		$("#btn_form_ped").text("Crear pedido");
		$("#titulo_ped").text("PRODUCTOS SELECCIONADOS");
		//$("#div_filtro_prod").show();
	}
}

function div_inicial_cap_ped()
{
	$("#div_filtro_prod").show();
	$("#div_pedido").hide();

	$("#dat_control").hide();
		$("#dat_fac").hide();
		$("#dat_ent").hide();
		$("#det_ped").hide();
		$("#det_pago").hide();
		//$("#titulo_ped").text("CAPTURAR PEDIDO");
		$("#btn_save_pedido").hide();
}

function capturar_pedido()
{
	var idpedido = $("#id_ped_temp").val();

	$.post("ajax/diseno.php?op=contar_productos_ped",{idpedido:idpedido},function(data, status)
			{
			data = JSON.parse(data);

				//alert(data.num_pro_tot);
				var num_prod = data.num_prod;

				if (num_prod>0) {

					//$("#div_select_tipo_ped").hide();
					var select_tipo_pedido =  $("#select_tipo_pedido").val();
					/*var ar_comprob_lic1 =  $("#ar_comprob_lic1").val();
					var ar_comprob_lic2 =  $("#ar_comprob_lic2").val();
					var ar_comprob_lic3 =  $("#ar_comprob_lic3").val();
					var ar_comprob_lic4 =  $("#ar_comprob_lic4").val();*/

					var iddocumentos1 =  $("#iddocumentos1").val();
					var iddocumentos2 =  $("#iddocumentos2").val();
					var iddocumentos3 =  $("#iddocumentos3").val();
					//var iddocumentos1 =  $("#iddocumentos1").val();

					//alert(ar_comprob_lic1);

					if (select_tipo_pedido==1) {

						$("#div_filtro_prod").hide();
						$("#div_pedido").show();

						$("#dat_control").show();
						$("#dat_fac").hide();
						$("#dat_ent").hide();
						$("#det_ped").hide();
						$("#det_pago").hide();
						$("#btn_save_pedido").hide();
						$("#adj_docs_lic").hide();
					}else{

						if (select_tipo_pedido==2) {

							if (iddocumentos1==1 && iddocumentos2 == 1 && iddocumentos3 == 1) {

							

									$("#div_filtro_prod").hide();
									$("#div_pedido").show();

									$("#dat_control").show();
									$("#dat_fac").hide();
									$("#dat_ent").hide();
									$("#det_ped").hide();
									$("#det_pago").hide();
									$("#btn_save_pedido").hide();
									$("#adj_docs_lic").hide();


									
							}else{
								bootbox.alert("No se han detectado todos los documentos requeridos");
							}

						}else{
							if (select_tipo_pedido==3) {


								if (iddocumentos3 == 1) {

									//cargar_doc_lic();	

									$("#div_filtro_prod").hide();
									$("#div_pedido").show();

									$("#dat_control").show();
									$("#dat_fac").hide();
									$("#dat_ent").hide();
									$("#det_ped").hide();
									$("#det_pago").hide();
									$("#btn_save_pedido").hide();
									$("#adj_docs_lic").hide();
								}else{
									bootbox.alert("No se han detectado todos los documentos requeridos");
								}

							}else{

								if (select_tipo_pedido==4) {

									$("#div_filtro_prod").hide();
									$("#div_pedido").show();

									$("#btn_save_pedido").hide();
									$("#adj_docs_lic").hide();



									$("#dat_control").hide();
									$("#dat_fac").hide();
									$("#dat_ent").hide();
									$("#det_ped").hide();
									$("#det_pago").hide();

									
									
									$("#id_cliente").val("2509");

								
									$("#btn_save_pedido").show();
									

									$("#btn_siguiente").hide();
									$("#btn_anterior").hide();
									$("#identregas").val("10");
									$("#idfacturacion").val("10");



								}else{

									bootbox.alert("No se ha seleccionado el tipo de pedido");
								}

								
							}

							
						}

					}

				}else{
					bootbox.alert("El pedido aún no tiene productos");
				}
				

			});

		
}

function pasar_paginas()
{
	
	var contador_paginas = $("#contador_paginas").val();

	if (contador_paginas<5) {

		contador_paginas=parseInt(contador_paginas)+1;
		$("#contador_paginas").val(contador_paginas);

		if (contador_paginas==1) {
			$("#dat_control").show();
			$("#dat_fac").hide();
			$("#dat_ent").hide();
			$("#det_ped").hide();
			$("#det_pago").hide();
			$("#btn_save_pedido").hide();
			$("#btn_siguiente").show();
		}
		if (contador_paginas==2) {
			$("#dat_control").hide();
			$("#dat_fac").show();
			$("#dat_ent").hide();
			$("#det_ped").hide();
			$("#det_pago").hide();
			$("#btn_save_pedido").hide();
			$("#btn_siguiente").hide();
		}
		if (contador_paginas==3) {


			$("#dat_control").hide();
			$("#dat_fac").hide();
			$("#dat_ent").show();
			$("#det_ped").hide();
			$("#det_pago").hide();
			$("#btn_save_pedido").hide();
			$("#btn_siguiente").show();
		}
		if (contador_paginas==4) {

			var empaque = $("#empaque").val();

			if (empaque!="") {


				var fecha_ent = $("#fecha_ent").text();


				if (fecha_ent=="") {


						bootbox.confirm({
						    message: "No se ha capturado la fecha de entrega, ¿Desea continuar?",
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

						    		bootbox.alert("Usted tendrá una oportunidad para capturar la fecha de entrega en las proximas 48 horas.");
						    		$("#dat_control").hide();
									$("#dat_fac").hide();
									$("#dat_ent").hide();
									$("#det_ped").show();
									$("#det_pago").hide();
									$("#btn_save_pedido").hide();
									$("#btn_siguiente").show();

						    	}else{

						    		contador_paginas=parseInt(contador_paginas)-1;
									$("#contador_paginas").val(contador_paginas);

						    	}

						    }
						});



				}else{
					$("#dat_control").hide();
					$("#dat_fac").hide();
					$("#dat_ent").hide();
					$("#det_ped").show();
					$("#det_pago").hide();
					$("#btn_save_pedido").hide();
					$("#btn_siguiente").show();
				}

			}else{
				bootbox.alert("Es necesario seleccionar el tipo de empaque");
			}
			
			

					


			    



			/*var fecha_ent = $("#fecha_ent").text();
			

			if (fecha_ent=="") {
				bootbox.alert("Por favor captura la fecha de entrega");
				contador_paginas=parseInt(contador_paginas)-1;
				$("#contador_paginas").val(contador_paginas);
			}else{
				$("#dat_control").hide();
				$("#dat_fac").hide();
				$("#dat_ent").hide();
				$("#det_ped").show();
				$("#det_pago").hide();
				$("#btn_save_pedido").hide();
			}*/

			
		}
		if (contador_paginas==5) {
			$("#dat_control").hide();
			$("#dat_fac").hide();
			$("#dat_ent").hide();
			$("#det_ped").hide();
			$("#det_pago").show();

			var id_ent = $("#identregas").val();
			var id_fac = $("#idfacturacion").val();

			//alert(id_ent);
			//alert(id_fac);

			if (id_ent>0 && id_fac>0) {
				$("#btn_save_pedido").show();
			}

			$("#btn_siguiente").hide();
		}

	}

		

}

function regresar_paginas()
{
	
	var contador_paginas = $("#contador_paginas").val();

	if (contador_paginas>1) {

		contador_paginas=parseInt(contador_paginas)-1;
		$("#contador_paginas").val(contador_paginas);

		if (contador_paginas==1) {
			$("#dat_control").show();
			$("#dat_fac").hide();
			$("#dat_ent").hide();
			$("#det_ped").hide();
			$("#det_pago").hide();
			$("#btn_save_pedido").hide();
			$("#btn_siguiente").show();
		}
		if (contador_paginas==2) {
			$("#dat_control").hide();
			$("#dat_fac").show();
			$("#dat_ent").hide();
			$("#det_ped").hide();
			$("#det_pago").hide();
			$("#btn_save_pedido").hide();
			$("#btn_siguiente").show();
		}
		if (contador_paginas==3) {
			$("#dat_control").hide();
			$("#dat_fac").hide();
			$("#dat_ent").show();
			$("#det_ped").hide();
			$("#det_pago").hide();
			$("#btn_save_pedido").hide();
			$("#btn_siguiente").show();
		}
		if (contador_paginas==4) {
			$("#dat_control").hide();
			$("#dat_fac").hide();
			$("#dat_ent").hide();
			$("#det_ped").show();
			$("#det_pago").hide();
			$("#btn_save_pedido").hide();
			$("#btn_siguiente").show();
		}
		if (contador_paginas==5) {
			$("#dat_control").hide();
			$("#dat_fac").hide();
			$("#dat_ent").hide();
			$("#det_ped").hide();
			$("#det_pago").show();
			$("#btn_save_pedido").show();
			$("#btn_siguiente").show();
		}
	}

		

}




/*function ultimo_control()
{

			$.post("ajax/diseno.php?op=ultimo_control",function(data, status)
			{
			data = JSON.parse(data);


						var ultimo_control = parseInt(data.no_control)+1;				
						$("#no_control").val(ultimo_control);

		

			});
}*/

function tbl_prod_ped()
{
	var id_ped_temp = $("#id_ped_temp").val();

	$.post("ajax/diseno.php?op=tbl_prod_ped&id="+id_ped_temp,function(r){
	       // $("#gallery_products").html(r);
	        $("#tbl_product_select").html(r);

	       
	});
}

function cantidad_prod(idproducto)
{
	


		var input_cant_prod = $("#input_cant_prod"+idproducto).val();

		var id_ped_temp = $("#id_ped_temp").val();
		//alert(id_ped_temp);
	    var cantidad = input_cant_prod;
	   // alert(cantidad);

	    $.post("ajax/diseno.php?op=buscar_reg_prod",{id_ped_temp:id_ped_temp,idproducto:idproducto},function(data, status)
		{
		data = JSON.parse(data);

			var precio = data.precio;
			var importe = parseFloat(precio)*parseInt(cantidad);


				$.post("ajax/diseno.php?op=update_cant",{id_ped_temp:id_ped_temp,idproducto:idproducto,cantidad:cantidad,importe:importe},function(data, status)
				{
				data = JSON.parse(data);


					var notificator = new Notification(document.querySelector('.notification'));
					notificator.info('Cantidad actualizada');


				});


		});





}

function observ_prod(idproducto)
{
	


		var input_obser_prod = $("#input_obser_prod"+idproducto).val();

		var id_ped_temp = $("#id_ped_temp").val();
	    //var cantidad = input_cant_prod;
				$.post("ajax/diseno.php?op=update_observa",{id_ped_temp:id_ped_temp,idproducto:idproducto,input_obser_prod:input_obser_prod},function(data, status)
				{
				data = JSON.parse(data);

					var notificator = new Notification(document.querySelector('.notification'));
					notificator.info('Observación actualizada');


				});

}

function nombre_prod(idproducto)
{
	


		var input_nom_prod = $("#input_nom_prod"+idproducto).val();

		var id_ped_temp = $("#id_ped_temp").val();
	    //var cantidad = input_cant_prod;
				$.post("ajax/diseno.php?op=update_descrip",{id_ped_temp:id_ped_temp,idproducto:idproducto,input_nom_prod:input_nom_prod},function(data, status)
				{
				data = JSON.parse(data);

					var notificator = new Notification(document.querySelector('.notification'));
					notificator.info('Descripción actualizada');
				});

}



function borrar_prod(idproducto)
{
	var id_ped_temp = $("#id_ped_temp").val();


	bootbox.confirm({
	    message: "¿Esta seguro de eliminar este producto de la selección?",
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
	        console.log('This was logged in the callback: ' + result);

	        //alert(result);


	        if (result==true) {

	        	$.post("ajax/diseno.php?op=borrar_prod",{id_ped_temp:id_ped_temp,idproducto:idproducto},function(data, status)
				{
				data = JSON.parse(data);

					//consul_prod_ped();
					tbl_prod_ped();

				});

	        }

	    }
	});


}

function select_cliente()
{
	
	$("#modal_cliente").modal("show");

	var lugar_user=$("#lugar_user").text();

	$.post("ajax/diseno.php?op=tbl_clientes&id="+lugar_user,function(r){
	        $("#datatable").html(r);

	       
	});
}

function buscar_texto_tbl()
{
	
	var text_buscar = $("#text_buscar").val();
	var lugar_user = $("#lugar_user").text();

	$.post("ajax/diseno.php?op=buscar_texto_tbl&id="+text_buscar+"&lugar_user="+lugar_user,function(r){
	        $("#datatable").html(r);

	       
	});
}



function select_cliente2(idcliente)
{
	limpir_dirent();
	limpir_text_ent();
	limpiar_text_fac();
	limpir_dir_fac();
	/*alert(idcliente);
	alert(no_cliente);
	alert(nombre);*/
	$("#id_cliente").val(idcliente);
	var idusuario=$("#idusuario").text();

	var id_ped_temp = $("#id_ped_temp").val();

	$.post("ajax/diseno.php?op=buscar_cliente",{idcliente:idcliente,id_ped_temp:id_ped_temp},function(data, status)
	{
	data = JSON.parse(data);

		$("#no_cliente").val(data.no_cliente);
		$("#nombre_cliente").val(data.nombre);
		$("#telefono").val(data.telefono);
		$("#email").val(data.email);

		var usuario = $("#usuario").text();

		$("#asesor").val(usuario);
		$("#persona_pedido").val(usuario);
		$("#autorizacion").val("");

		var nombre_de_cliente = data.nombre;
		var rfc_ini = data.rfc;
		var calle_ini = data.calle;
		var numero_ini = data.numero;
		var interior_ini = data.interior;
		var domicilio_ini = data.calle+" "+data.numero+" "+data.interior;
		var colonia_ini = data.colonia;
		var municipio_ini = data.municipio;
		var estado_ini = data.estado;
		var ciudad_ini = data.municipio+", "+data.estado;
		var cp_ini = data.cp;
		var tel_ini = data.telefono;
		var email_ini = data.email;



		$.post("ajax/diseno.php?op=consul_ped_max",{idcliente:idcliente},function(data, status)
		{
		data = JSON.parse(data);


			$("#max_ped_cli").val(data.num_ped_cli);

			$.post("ajax/diseno.php?op=buscar_datos_fac",{idcliente:idcliente},function(data, status)
			{
			data = JSON.parse(data);

				//alert(data);

				if (data==null) {
					
					/*$("#nombre_cliente_fac").text(nombre_de_cliente);
					$("#rfc_fac").text(rfc_ini);
					$("#calle_fac").text(calle_ini);
					$("#numero_fac").text(numero_ini);
					$("#interior_fac").text(interior_ini);
					$("#colonia_fac").text(colonia_ini);
					$("#ciudad_fac").text(ciudad_ini);
					$("#estado_fac").text(estado_ini);
					$("#cp_fac").text(cp_ini);
					$("#tel_fac").text(tel_ini);
					$("#email_fac").text(email_ini);*/
					

					$("#razon_edit").val(nombre_de_cliente);
					$("#rfc_edit").val(rfc_ini);				
					$("#calle_edit").val(calle_ini);
					$("#numero_edit").val(numero_ini);
					$("#int_edit").val(interior_ini);
					$("#colonia_edit").val(colonia_ini);
					$("#ciudad_edit").val(municipio_ini);
					$("#estado_edit").val(estado_ini);
					$("#cp_edit").val(cp_ini);
					$("#telefono_edit").val(tel_ini);
					$("#email_edit").val(email_ini);


				}else{

					

					$("#idfacturacion").val(data.iddir_facturacion);

					if (data.iddir_facturacion>0) {
						$("#btn_siguiente").show();
					}	
						
					$("#nombre_cliente_fac").text(data.razon_fac);
					$("#rfc_fac").text(data.rfc_fac);
					$("#calle_fac").text(data.calle_fac);
					$("#numero_fac").text(data.numero_fac);
					$("#interior_fac").text(data.interior_fac);
					$("#colonia_fac").text(data.colonia_fac);
					$("#ciudad_fac").text(data.ciudad_fac);
					$("#estado_fac").text(data.estado_fac);
					$("#cp_fac").text(data.cp_fac);
					$("#tel_fac").text(data.telefono_fac);
					$("#email_fac").text(data.email_fac);

					$("#idfacturacion_edit").val(data.iddir_facturacion);
					$("#razon_edit").val(data.razon_fac);
					$("#rfc_edit").val(data.rfc_fac);				
					$("#calle_edit").val(data.calle_fac);
					$("#numero_edit").val(data.numero_fac);
					$("#int_edit").val(data.interior_fac);
					$("#colonia_edit").val(data.colonia_fac);
					$("#ciudad_edit").val(data.ciudad_fac);
					$("#estado_edit").val(data.estado_fac);
					$("#cp_edit").val(data.cp_fac);
					$("#telefono_edit").val(data.telefono_fac);
					$("#email_edit").val(data.email_fac);
				}


					$.post("ajax/diseno.php?op=buscar_datos_ent",{idcliente:idcliente},function(data, status)
					{
					data = JSON.parse(data);


							if (data==null) {

								

								$("#direcciones").hide();
								$("#formulario_direccion").show();
								//alert("null");
								/*$("#nombre_cliente_ent").text();						
								$("#calle_ent").text(calle_ini);
								$("#numero_ent").text(numero_ini);
								$("#interior_ent").text(interior_ini);
								$("#colonia_ent").text(colonia_ini);
								$("#ciudad_ent").text(ciudad_ini);
								$("#estado_ent").text(estado_ini);
								$("#cp_ent").text(cp_ini);
								$("#telefono_ent").text(tel_ini);
								$("#email_ent").text(email_ini);
								$("#fecha_ent").text();
								$("#hora_ent").text();
								$("#referencia_ent").text();*/

								$("#contacto_upd").val();				
								$("#calle_upd").val(calle_ini);
								$("#numero_upd").val(numero_ini);
								$("#int_upd").val(interior_ini);
								$("#colonia_upd").val(colonia_ini);
								$("#ciudad_upd").val(municipio_ini);
								$("#estado_upd").val(estado_ini);
								$("#cp_upd").val(cp_ini);
								$("#telefono_upd").val(tel_ini);
								$("#email_upd").val(email_ini);
								$("#fecha_entrega_upd").val();
								$("#hora_entrega_upd").val();
								$("#referencia_upd").val();

								$("#btn_guardar_dir_ent").show();
								$("#btn_update_dir_ent").hide();
								$("#btn_newdir").hide();

								$("#modal_cliente").modal("hide");

							}else{

								//alert("entra");
								
								
								$("#identregas").val(data.identregas);
								$("#nombre_cliente_ent").text(data.cantacto_ent);	
								$("#calle_ent").text(data.calle_ent);
								$("#numero_ent").text(data.numero_ent);
								$("#interior_ent").text(data.interior_ent);
								$("#colonia_ent").text(data.colonia_ent);
								$("#ciudad_ent").text(data.ciudad_ent);
								$("#estado_ent").text(data.estado_ent);
								$("#cp_ent").text(data.cp_ent);
								$("#telefono_ent").text(data.telefono_ent);
								$("#email_ent").text(data.email_ent);
								$("#fecha_ent").text();
								$("#hora_ent").text();
								$("#forma_ent").text(data.forma_entrega_ent);
								$("#referencia_ent").text(data.referencia_ent);

								$("#direcciones").show();
								$("#formulario_direccion").hide();
								
								$("#modal_cliente").modal("hide");

								listar_direcciones();

							}


					});

			});

		});

	});	
	
}

function limpir_dirent()
{
							
							$("#contacto_upd").val("");				
							$("#calle_upd").val("");
							$("#numero_upd").val("");
							$("#int_upd").val("");
							$("#colonia_upd").val("");
							$("#ciudad_upd").val("");
							$("#estado_upd").val("");
							$("#cp_upd").val("");
							$("#telefono_upd").val("");
							$("#email_upd").val("");
							$("#fecha_entrega_upd").val("");
							$("#hora_entrega_upd").val("");
							$("#referencia_upd").val("");
}

function limpir_text_ent()
{
							
							$("#identregas").val("");
							$("#nombre_cliente_ent").text("");	
							$("#calle_ent").text("");
							$("#numero_ent").text("");
							$("#interior_ent").text("");
							$("#colonia_ent").text("");
							$("#ciudad_ent").text("");
							$("#estado_ent").text("");
							$("#cp_ent").text("");
							$("#telefono_ent").text("");
							$("#email_ent").text("");
							$("#fecha_ent").text("");
							$("#hora_ent").text("");
							$("#forma_ent").text("");
							$("#referencia_ent").text("");
}


function limpir_dir_fac()
{
							$("#razon_edit").val("");
							$("#rfc_edit").val("");				
							$("#calle_edit").val("");
							$("#numero_edit").val("");
							$("#int_edit").val("");
							$("#colonia_edit").val("");
							$("#ciudad_edit").val("");
							$("#estado_edit").val("");
							$("#cp_edit").val("");
							$("#telefono_edit").val("");
							$("#email_edit").val("");			
							
}

function limpiar_text_fac()
{
				$("#idfacturacion").val("");
				$("#nombre_cliente_fac").text("");
				$("#rfc_fac").text("");
				$("#calle_fac").text("");
				$("#numero_fac").text("");
				$("#interior_fac").text("");
				$("#colonia_fac").text("");
				$("#ciudad_fac").text("");
				$("#estado_fac").text("");
				$("#cp_fac").text("");
				$("#tel_fac").text("");
				$("#email_fac").text("");
}


function abrir_modal_fact()
{
	$("#modal_data_fact").modal("show");
}

function abrir_modal_ent()
{
	$("#modal_data_ent").modal("show");
}

function update_dir_fac()
{
			var idcliente = $("#id_cliente").val();
			var idfacturacion_edit = $("#idfacturacion_edit").val();
			var razon_edit =	$("#razon_edit").val();
			var rfc_edit = $("#rfc_edit").val();				
			var calle_edit =	$("#calle_edit").val();
			var numero_edit = $("#numero_edit").val();
			var interior_edit =	$("#int_edit").val();
			var colonia_edit = $("#colonia_edit").val();
			var municipio_edit = $("#ciudad_edit").val();
			var estado_edit = $("#estado_edit").val();
			var cp_edit = $("#cp_edit").val();
			var tel_edit = $("#telefono_edit").val();
			var email_edit =	$("#email_edit").val();


	$.post("ajax/diseno.php?op=buscar_datos_fac",{idcliente:idcliente},function(data, status)
	{
	data = JSON.parse(data);

		if (data==null)
		{

			$.post("ajax/diseno.php?op=insert_dir_fac",{
			idcliente:idcliente,
			razon_edit:razon_edit,
			rfc_edit:rfc_edit,
			calle_edit:calle_edit,
			numero_edit:numero_edit,
			interior_edit:interior_edit,
			colonia_edit:colonia_edit,
			municipio_edit:municipio_edit,
			estado_edit:estado_edit,
			cp_edit:cp_edit,
			tel_edit:tel_edit,
			email_edit:email_edit
			},function(data, status)
			{
			data = JSON.parse(data);

			//alert(data.iddir_facturacion);

			limpiar_text_fac();
			

				$("#idfacturacion").val(data.iddir_facturacion);
					if (data.iddir_facturacion>0) {
						$("#btn_siguiente").show();
					}	
					
				$("#nombre_cliente_fac").text(razon_edit);
				$("#rfc_fac").text(rfc_edit);
				$("#calle_fac").text(calle_edit);
				$("#numero_fac").text(numero_edit);
				$("#interior_fac").text(interior_edit);
				$("#colonia_fac").text(colonia_edit);
				$("#ciudad_fac").text(municipio_edit);
				$("#estado_fac").text(estado_edit);
				$("#cp_fac").text(cp_edit);
				$("#tel_fac").text(tel_edit);
				$("#email_fac").text(email_edit);

			

				bootbox.alert("Datos guardados correctamente.");
				$("#modal_data_fact").modal("hide");


			});


		}else{

			

			$.post("ajax/diseno.php?op=update_dir_fac",{
			idcliente:idcliente,
			razon_edit:razon_edit,
			rfc_edit:rfc_edit,
			calle_edit:calle_edit,
			numero_edit:numero_edit,
			interior_edit:interior_edit,
			colonia_edit:colonia_edit,
			municipio_edit:municipio_edit,
			estado_edit:estado_edit,
			cp_edit:cp_edit,
			tel_edit:tel_edit,
			email_edit:email_edit
			},function(data, status)
			{
			data = JSON.parse(data);
				limpiar_text_fac();

				$("#idfacturacion").val(idfacturacion_edit);
					if (idfacturacion_edit>0) {
						$("#btn_siguiente").show();
					}
				$("#nombre_cliente_fac").text(razon_edit);
				$("#rfc_fac").text(rfc_edit);
				$("#calle_fac").text(calle_edit);
				$("#numero_fac").text(numero_edit);
				$("#interior_fac").text(interior_edit);
				$("#colonia_fac").text(colonia_edit);
				$("#ciudad_fac").text(municipio_edit);
				$("#estado_fac").text(estado_edit);
				$("#cp_fac").text(cp_edit);
				$("#tel_fac").text(tel_edit);
				$("#email_fac").text(email_edit);

				limpir_dir_fac();

				bootbox.alert("Datos guardados correctamente.");
				$("#modal_data_fact").modal("hide");


			});

		}


	});

			

}


function listar_direcciones()
{
	
	var id_cliente = $("#id_cliente").val();

	$.post("ajax/diseno.php?op=listar_direcciones&id="+id_cliente,function(r){
	        $("#box_direcciones").html(r);

	       
	});
}


function save_dir_ent()
{
	var empaque = $("#empaque").val();

	if (empaque!="") {

		


					var id_cliente = $("#id_cliente").val();
					var contacto_upd = $("#contacto_upd").val();
					var calle_upd = $("#calle_upd").val();
					var numero_upd = $("#numero_upd").val();
					var int_upd = $("#int_upd").val();
					var colonia_upd = $("#colonia_upd").val();
					var ciudad_upd = $("#ciudad_upd").val();
					var estado_upd = $("#estado_upd").val();
					var cp_upd = $("#cp_upd").val();
					var telefono_upd = $("#telefono_upd").val();
					var email_upd = $("#email_upd").val();
				    var fecha_entrega_upd = $("#fecha_entrega_upd").val();

					var hora_entrega_upd = $("#hora_entrega_upd").val();
					var hora_entrega_upd_r2 = $("#hora_entrega_upd_r2").val();
					//var fecha_hora_upd = fecha_entrega_upd+" "+hora_entrega_upd+":00";

					var forma_entrega_upd = $("#forma_entrega_upd").val();
					var det_forma_entrega_upd = $("#det_forma_entrega_upd").val();

					var referencia_upd = $("#referencia_upd").val();


					$.post("ajax/diseno.php?op=save_dir_ent",{
						id_cliente:id_cliente,
						contacto_upd:contacto_upd,
						calle_upd:calle_upd,
						numero_upd:numero_upd,
						int_upd:int_upd,
						colonia_upd:colonia_upd,
						ciudad_upd:ciudad_upd,
						estado_upd:estado_upd,
						cp_upd:cp_upd,
						telefono_upd:telefono_upd,
						email_upd:email_upd,
						fecha_entrega_upd:fecha_entrega_upd,
						hora_entrega_upd:hora_entrega_upd,
						hora_entrega_upd_r2:hora_entrega_upd_r2,
						forma_entrega_upd:forma_entrega_upd,
						det_forma_entrega_upd:det_forma_entrega_upd,
						referencia_upd:referencia_upd},function(data, status)
					{
					data = JSON.parse(data);

						bootbox.alert("Dirección de entrega guardada");
						$("#modal_data_ent").modal("hide");

							limpir_text_ent();
							
							//alert(data.identregas);
							$("#identregas").val(data.identregas);
						    $("#nombre_cliente_ent").text(contacto_upd);						
							$("#calle_ent").text(calle_upd);
							$("#numero_ent").text(numero_upd);
							$("#interior_ent").text(int_upd);
							$("#colonia_ent").text(colonia_upd);
							$("#ciudad_ent").text(ciudad_upd);
							$("#estado_ent").text(estado_upd);
							$("#cp_ent").text(cp_upd);
							$("#telefono_ent").text(telefono_upd);
							$("#email_ent").text(email_upd);
							$("#fecha_ent").text(fecha_entrega_upd);
							$("#hora_ent").text(hora_entrega_upd);
							$("#hora_ent2").text(hora_entrega_upd_r2);
							$("#forma_ent").text(forma_entrega_upd);
							$("#det_forma_ent").text(det_forma_entrega_upd);
							$("#referencia_ent").text(referencia_upd);
							$("#direcciones").show();
							$("#formulario_direccion").hide();

							limpir_dirent();

							listar_direcciones();

					});


		

					
	}else{
		bootbox.alert("Para continuar seleccione el tipo de empaque.");
	}



					


}


function reg_new_dir_ent()
{
	limpir_dirent();
	$("#btn_newdir").show();
	var texto = $("#btn_newdir").text();

	if (texto=="Nueva dirección") {
		$("#btn_newdir").text("Ver direcciones");
		$("#direcciones").hide();
		$("#formulario_direccion").show();
		$("#btn_update_dir_ent").hide();
		$("#btn_guardar_dir_ent").show();
	}
	if (texto=="Ver direcciones") {
		$("#btn_newdir").text("Nueva dirección");
		$("#direcciones").show();
		$("#formulario_direccion").hide();
		$("#btn_update_dir_ent").hide();
		$("#btn_guardar_dir_ent").hide();
	}
}

function select_dir_ent(identregas)
{
		$("#btn_newdir").text("Ver direcciones");
		$("#direcciones").hide();
		$("#formulario_direccion").show();

		$("#btn_guardar_dir_ent").hide();
		$("#btn_update_dir_ent").show();
		$("#btn_newdir").show();

		$.post("ajax/diseno.php?op=select_dir_ent",{identregas:identregas},function(data, status)
		{
		data = JSON.parse(data);


							
							$("#identrega_upd").val(data.identregas);
							$("#idcliente_upd").val(data.idcliente_ent);
							$("#contacto_upd").val(data.contacto_ent);				
							$("#calle_upd").val(data.calle_ent);
							$("#numero_upd").val(data.numero_ent);
							$("#int_upd").val(data.interior_ent);
							$("#colonia_upd").val(data.colonia_ent);
							$("#ciudad_upd").val(data.ciudad_ent);
							$("#estado_upd").val(data.estado_ent);
							$("#cp_upd").val(data.cp_ent);
							$("#telefono_upd").val(data.telefono_ent);
							$("#email_upd").val(data.email_ent);
							$("#fecha_entrega_upd").val();
							$("#hora_entrega_upd").val();
							$("#referencia_upd").val(data.referencia_ent);


		});


							
}

function update_dir_ent()
{

	var empaque = $("#empaque").val();

	var doc_ped_sal = $("#doc_ped_sal").val();
	var id_ped_temp2 = $("#id_ped_temp").val();

	//alert(id_ped_temp2);

	if (empaque!="") {

		if (doc_ped_sal>0) {

				var identrega_upd = $("#identrega_upd").val();
				var idcliente_upd = $("#idcliente_upd").val();
				var contacto_upd = $("#contacto_upd").val();				
				var calle_upd = $("#calle_upd").val();
				var numero_upd = $("#numero_upd").val();
				var int_upd = $("#int_upd").val();
				var colonia_upd = $("#colonia_upd").val();
				var ciudad_upd = $("#ciudad_upd").val();
				var estado_upd = $("#estado_upd").val();
				var cp_upd = $("#cp_upd").val();
				var telefono_upd = $("#telefono_upd").val();
				var email_upd = $("#email_upd").val();
				
				var fecha_entrega_upd = $("#fecha_entrega_upd").val();
				var hora_entrega_upd = $("#hora_entrega_upd").val();
				var hora_entrega_upd_r2 = $("#hora_entrega_upd_r2").val();
				var forma_entrega_upd = $("#forma_entrega_upd").val();
				var det_forma_entrega_upd = $("#det_forma_entrega_upd").val();

				var referencia_upd = $("#referencia_upd").val();

				$.post("ajax/diseno.php?op=update_dir_ent",{
					identrega_upd:identrega_upd,
					idcliente_upd:idcliente_upd,
					contacto_upd:contacto_upd,
					calle_upd:calle_upd,
					numero_upd:numero_upd,
					int_upd:int_upd,
					colonia_upd:colonia_upd,
					ciudad_upd:ciudad_upd,
					estado_upd:estado_upd,
					cp_upd:cp_upd,
					telefono_upd:telefono_upd,
					email_upd:email_upd,
					fecha_entrega_upd:fecha_entrega_upd,
					hora_entrega_upd:hora_entrega_upd,
					hora_entrega_upd_r2:hora_entrega_upd_r2,
					forma_entrega_upd:forma_entrega_upd,
					det_forma_entrega_upd:det_forma_entrega_upd,
					referencia_upd:referencia_upd,
					doc_ped_sal:doc_ped_sal,
					id_ped_temp2:id_ped_temp2},function(data, status)
				{
				data = JSON.parse(data);

					limpir_text_ent();
					
					$("#identregas").val(identrega_upd);
					$("#nombre_cliente_ent").text(contacto_upd);	
					$("#calle_ent").text(calle_upd);
					$("#numero_ent").text(numero_upd);
					$("#interior_ent").text(int_upd);
					$("#colonia_ent").text(colonia_upd);
					$("#ciudad_ent").text(ciudad_upd);
					$("#estado_ent").text(estado_upd);
					$("#cp_ent").text(cp_upd);
					$("#telefono_ent").text(telefono_upd);
					$("#email_ent").text(email_upd);
					$("#fecha_ent").text(fecha_entrega_upd);
					$("#hora_ent").text(hora_entrega_upd);
					$("#hora_ent2").text(hora_entrega_upd_r2);
					$("#forma_ent").text(forma_entrega_upd);
					$("#det_forma_ent").text(det_forma_entrega_upd);
					$("#referencia_ent").text(referencia_upd);

					limpir_dirent();

					$("#modal_data_ent").modal("hide");

					$("#direcciones").show();
					$("#formulario_direccion").hide();
					listar_direcciones();


				});

		}else{

			bootbox.alert("Para continuar seleccione una opción en la pregunta final.")
		}

				

	}else{
		bootbox.alert("Para continuar seleccione el tipo de empaque.")
	}

	
}

function enviar_pedido()
{
	var id_ped_temp = $("#id_ped_temp").val();

	alert(id_ped_temp);

		$.post("ajax/diseno.php?op=enviar_pedido",{id_ped_temp:id_ped_temp},function(data, status)
		{
		data = JSON.parse(data);

		});

}

function guardar_pedido_tipo()
{
	var select_tipo_pedido =  $("#select_tipo_pedido").val();
	var ar_comprob_lic1 =  $("#ar_comprob_lic1").val();
	var ar_comprob_lic2 =  $("#ar_comprob_lic2").val();
	var ar_comprob_lic3 =  $("#ar_comprob_lic3").val();
	var ar_comprob_lic4 =  $("#ar_comprob_lic4").val();

	if (select_tipo_pedido==1) {

		guardar_pedido();

	}else{

		if (select_tipo_pedido==2) {

			if (ar_comprob_lic1!="" && ar_comprob_lic2 != "" && ar_comprob_lic3 != "") {
				guardar_pedido();
			}else{
				bootbox.alert("No se han detectado todos los documentos requeridos");
			}

		}else{

			bootbox.alert("No se ha seleccionado el tipo de pedido");
		}

	}
}


function guardar_pedido()
{
	var empaquep =  $("#empaque").val();
	var tipoPedido= $("select_tipo_pedido").val();

	if (empaquep!="" || tipoPedido==4) {
		document.getElementById('btn_save_pedido').disabled = true;

		var id_ped_temp = $("#id_ped_temp").val();
		var identregas = $("#identregas").val();
		var idfacturacion = $("#idfacturacion").val();

		$.post("ajax/diseno.php?op=consul_prod_capt",{id_ped_temp:id_ped_temp},function(data, status)
		{
			data = JSON.parse(data);

			var cant_prod_ped_new = data.cant_prod;

			if (identregas!="") {

				$.post("ajax/diseno.php?op=guardar_dir_entrega",{id_ped_temp:id_ped_temp,identregas:identregas},function(data, status)
				{
				data = JSON.parse(data);

					var id_retorno_ent = data.identregas;

					//alert(id_retorno_ent);

					if (id_retorno_ent>0) {

						if (idfacturacion!="") {

							$.post("ajax/diseno.php?op=guardar_dir_fact",{id_ped_temp:id_ped_temp,idfacturacion:idfacturacion},function(data, status)
							{
							data = JSON.parse(data);


									var id_retorno_fac = data.iddir_facturacion_esp;

									//alert(id_retorno_fac);

									if (id_retorno_fac>0) {


									$.post("ajax/diseno.php?op=ultimo_control",function(data, status)
									{
									data = JSON.parse(data);

										var ultimo_control = parseInt(data.no_control)+1;

										//alert(ultimo_control);

										var lugar = $("#lugar_user").text();

										//alert(lugar);

										$.post("ajax/diseno.php?op=ultimo_pedido_lugar",{lugar:lugar},function(data, status)
										{
										data = JSON.parse(data);



											if (lugar=="AJM") {

												var no_pedido_lugar = parseInt(data.no_pedido_lugar)+3;
											}else{

												var no_pedido_lugar = parseInt(data.no_pedido_lugar)+1;
											}		
													

											var fecha_ped = $("#fecha_pedido").val();
											var hora=moment().format('HH:mm:ss');

											var fecha_pedido=fecha_ped+" "+hora;
											var id_cliente = $("#id_cliente").val();
											//var no_pedido = $("#no_pedido").val();
											var condiciones = $("#condiciones").val();
											//var no_control = $("#no_control").val();
											var asesor = $("#asesor").val();
											var persona_pedido = $("#persona_pedido").val();

											var cliente_nuevo=0;

											var medio = $("#medio").val();
											var lab = $("#lab").val();
											var autorizacion = $("#autorizacion").val();
											
											var fecha_entrega = $("#fecha_ent").text();
											var hora_entrega = $("#hora_ent").text();
											var hora_entrega2 = $("#hora_ent2").text();
											var forma_entrega = $("#forma_ent").text();
											var det_forma_ent = $("#det_forma_ent").text();
											//var idfacturacion = $("#idfacturacion").val();



											

												var reglamentos = $("#reglamentos").val();
												var empaque = $("#empaque").val();
												var metodo_pago = $("#metodo_pago").val();
												var forma_pago = $("#forma_pago").val();
												var uso_cfdi = $("#uso_cfdi").val();
												var fecha_envio_enlace = $("#fecha_envio_enlace").val();
												var fecha_envio_enlace = fecha_envio_enlace + " " + hora;
												var salida = $("#salida").val();
												var factura = $("#factura").val();
												var otros = $("#otros").val();
												var idusuario=$("#idusuario").text();
												var max_ped_cli=$("#max_ped_cli").val();

												$.post("ajax/diseno.php?op=guardar_pedido",{
													id_ped_temp:id_ped_temp,
													fecha_pedido:fecha_pedido,
													id_cliente:id_cliente,
													no_pedido_lugar:no_pedido_lugar,
													condiciones:condiciones,
													ultimo_control:ultimo_control,
													asesor:asesor,
													persona_pedido:persona_pedido,
													cliente_nuevo:cliente_nuevo,
													medio:medio,
													lab:lab,
													autorizacion:autorizacion,
													id_retorno_ent:id_retorno_ent,
													fecha_entrega:fecha_entrega,
													hora_entrega:hora_entrega,
													hora_entrega2:hora_entrega2,
													forma_entrega:forma_entrega,
													det_forma_ent:det_forma_ent,
													id_retorno_fac:id_retorno_fac,
													reglamentos:reglamentos,
													empaque:empaque,
													metodo_pago:metodo_pago,
													forma_pago:forma_pago,
													uso_cfdi:uso_cfdi,
													fecha_envio_enlace:fecha_envio_enlace,
													salida:salida,
													factura:factura,
													otros:otros,
													idusuario:idusuario,
													max_ped_cli:max_ped_cli,
													cant_prod_ped_new:cant_prod_ped_new
												},function(data, status)
												{
												data = JSON.parse(data);

																limpiar_form_pedido();
																document.getElementById('btn_save_pedido').disabled = false;
																var id_ped_temp = $("#id_ped_temp").val();
																bootbox.alert("Pedido guardado exitosamente", function(){ 
																	//$(location).attr("href","sale_product.php?pedido="+id_ped_temp);
																	$(location).attr("href","list_pedidos.php?pedido="+id_ped_temp);
																});

														
											


												});

										});	


											

									});		


									}else{
										bootbox.alert("Verificar dirección de facturación");
									}
							});

						}else{
							bootbox.alert("Por favor capture una dirección de facturación");
						}


					}else{


						bootbox.alert("Verificar dirección de entrega");

					}

				});

			}else{
				bootbox.alert("Por favor capture una dirección de entrega");
			}
		
		});
	}else{
		bootbox.alert("Por favor capture el empaque");
	}
		

}

function limpiar_form_pedido()
{
	$("#fecha_pedido").val("");
	$("#no_pedido").val("");
	$("#condiciones").val("");
	$("#no_control").val("");
	$("#no_cliente").val("");
	$("#id_cliente").val("");
	$("#max_ped_cli").val("");
	$("#nombre_cliente").val("");
	$("#telefono").val("");
	$("#email").val("");

	$("#idfacturacion").val("");
	$("#nombre_cliente_fac").val("");
	$("#rfc_fac").val("");
	$("#calle_fac").val("");
	$("#numero_fac").val("");
	$("#interior_fac").val("");
	$("#colonia_fac").val("");

	$("#ciudad_fac").val("");
	$("#estado_fac").val("");
	$("#cp_fac").val("");
	$("#tel_fac").val("");
	$("#email_fac").val("");

	$("#identregas").val("");
	$("#nombre_cliente_ent").val("");
	$("#calle_ent").val("");
	$("#numero_ent").val("");
	$("#interior_ent").val("");
	$("#colonia_ent").val("");
	$("#ciudad_ent").val("");
	$("#estado_ent").val("");

	$("#cp_ent").val("");
	$("#telefono_ent").val("");
	$("#email_ent").val("");
	$("#fecha_ent").val("");
	$("#hora_ent").val("");
	$("#forma_ent").val("");
	$("#referencia_ent").val("");

	$("#asesor").val("");
	$("#persona_pedido").val("");
	$("#medio").val("");
	$("#lab").val("");
	$("#autorizacion").val("");
	$("#reglamentos").val("");
	$("#empaque").val("");
	$("#metodo_pago").val("");
	$("#forma_pago").val("");
	$("#uso_cfdi").val("");
	$("#fecha_envio_enlace").val("");
	$("#salida").val("");
	$("#factura").val("");
	$("#otros").val("");

	document.getElementById('btn_save_pedido').disabled = false;

}

function consultas_llenado()
{
					abrir_reporte();
		        	tbl_rep_pedido_consul();
		        	pie_reporte();
		        	consul_datos_control();
		        	consul_datos_facturacion();
		        	consul_datos_entrega();
		        	ver_observ_prod();
		        	listar_historial();
		        	listar_documentos();
		        	listar_detalle_prod();
}

function abrir_modal_new_cli()
{
	$("#modal_cliente").modal("hide");
	$("#modal_data_new_cli").modal("show");
}

function abrir_modal_select_cli()
{
	$("#modal_cliente").modal("show");
	$("#modal_data_new_cli").modal("hide");
}

function buscar_cliente2()
{
	//var num_cli = $("#num_cli").val();
	var nom_cli = $("#nom_cli").val();

	//$.post("ajax/diseno.php?op=buscar_cliente2",{num_cli:num_cli,nom_cli:nom_cli},function(r){
	$.post("ajax/diseno.php?op=buscar_cliente2&id="+nom_cli,function(r){
	        $("#clientes_exist").html(r);

	       
	});

			
}

function limpiar_new_cli()
{
	$("#num_cli").val("");
	$("#nom_cli").val("");
	$("#rfc_cli").val("");
	$("#calle_cli").val("");
	$("#numero_cli").val("");
	$("#int_cli").val("");
	$("#colonia_cli").val("");
	$("#ciudad_cli").val("");
	$("#estado_cli").val("");
	$("#cp_cli").val("");
	$("#telefono_cli").val("");
	$("#email_cli").val("");
}

function save_cliente()
{
	
	//var num_coin_cli = $("#num_coin_cli").text();
	var lugar_user=$("#lugar_user").text();
	//alert(lugar_user);

	var num_cli = $("#num_cli").val();
	var nom_cli = $("#nom_cli").val();
	var rfc_cli = $("#rfc_cli").val();
	var calle_cli = $("#calle_cli").val();
	var numero_cli = $("#numero_cli").val();
	var int_cli = $("#int_cli").val();
	var colonia_cli = $("#colonia_cli").val();
	var ciudad_cli = $("#ciudad_cli").val();
	var estado_cli = $("#estado_cli").val();
	var cp_cli = $("#cp_cli").val();
	var telefono_cli = $("#telefono_cli").val();
	var email_cli = $("#email_cli").val();

	

			$.post("ajax/diseno.php?op=save_cliente",{
				lugar_user:lugar_user,
				num_cli:num_cli,
				nom_cli:nom_cli,
				rfc_cli:rfc_cli,
				calle_cli:calle_cli,
				numero_cli:numero_cli,
				int_cli:int_cli,
				colonia_cli:colonia_cli,
				ciudad_cli:ciudad_cli,
				estado_cli:estado_cli,
				cp_cli:cp_cli,
				telefono_cli:telefono_cli,
				email_cli:email_cli},function(data, status)
			{
			data = JSON.parse(data);

				bootbox.alert("Cliente guardado exitosamente");

				limpiar_new_cli();

				$("#modal_cliente").modal("show");
				$("#modal_data_new_cli").modal("hide");

				$("#num_cli").val("");
				$("#nom_cli").val("");
				$("#rfc_cli").val("");
				$("#calle_cli").val("");
				$("#numero_cli").val("");
				$("#int_cli").val("");
				$("#colonia_cli").val("");
				$("#ciudad_cli").val("");
				$("#estado_cli").val("");
				$("#cp_cli").val("");
				$("#telefono_cli").val("");
				$("#email_cli").val("");


				var lugar_user=$("#lugar_user").text();

				$.post("ajax/diseno.php?op=tbl_clientes&id="+lugar_user,function(r){
				        $("#datatable").html(r);

				       
				});
				

			});

	

}

function abrir_reporte()
{
	
	$("#page_reporte").show();
	$("#page_pedido").hide();
}


function tbl_rep_pedido_consul()
{
	
	var id_ped_temp = $("#id_ped_temp2").text();


	/*$.post("ajax/diseno.php?op=consul_idusuario",{id_ped_temp:id_ped_temp},function(data, status)
	{
	data = JSON.parse(data);*/


	//var idusuario = data.idusuario;

	var idusuario=$("#idusuario").text();



	//alert(idusuario);

	if (idusuario==4 || idusuario==5 || idusuario==8 || idusuario==10) {


		$.post("ajax/diseno.php?op=tbl_rep_pedido_consul2&id="+id_ped_temp+"&idusuario="+idusuario,function(r){
		        $("#tbl_rep_pedido").html(r);

		       
		});



	}else{

		

		$.post("ajax/diseno.php?op=tbl_rep_pedido_consul&id="+id_ped_temp+"&idusuario="+idusuario,function(r){
		        $("#tbl_rep_pedido").html(r);

		       
		});
	}

		

	//});

		
}

function pie_reporte()
{
	var idusuario=$("#idusuario").text();

	if (idusuario==4 || idusuario==5 || idusuario==8 || idusuario==10) {

		$("#calculo_importes").hide();
		

	}else{

		$("#calculo_importes").show();
		var id_ped_temp = $("#id_ped_temp2").text();
		var aplic_iva_select = $("#aplic_iva").val();

		//alert(aplic_iva);
		//alert(id_ped_temp);

		$.post("ajax/diseno.php?op=pie_reporte",{id_ped_temp:id_ped_temp},function(data, status)
		{
		data = JSON.parse(data);

			if (aplic_iva_select=="select") {
				var aplic_iva = data.aplicar_iva;
			}else{
				var aplic_iva = aplic_iva_select;
			}

			if (aplic_iva=="Si") {
				var subtotal = data.suma_importe;
				var iva = data.iva_ped;
				var total = parseFloat(subtotal)+parseFloat(iva);

				

			}
			if (aplic_iva=="No") {
				var subtotal = data.suma_importe;
				var iva = 0;
				var total = parseFloat(subtotal);

				

			}


			int_part = Math.trunc(subtotal);
			float_part = Number((subtotal-int_part).toFixed(2));
			var subtotal_fixed = parseFloat(int_part+float_part);
		    $("#subtotal_rep").text(subtotal_fixed);

		    int_part = Math.trunc(iva);
			float_part = Number((iva-int_part).toFixed(2));
			var iva_fixed = parseFloat(int_part+float_part);
		    $("#iva_rep").text(iva_fixed);

		    int_part = Math.trunc(total);
			float_part = Number((total-int_part).toFixed(2));
			var total_fixed = parseFloat(int_part+float_part);
		    $("#total_rep").text(total_fixed);

		    $.post("ajax/diseno.php?op=upd_importes",{id_ped_temp:id_ped_temp,subtotal_fixed:subtotal_fixed,iva_fixed:iva_fixed,total_fixed:total_fixed,aplic_iva:aplic_iva},function(data, status)
			{
			data = JSON.parse(data);





			});


		});

	}
	
		
}

function consul_datos_control()
{
	
	var id_ped_temp = $("#id_ped_temp2").text();
	//alert(id_ped_temp);
	//alert(id_ped_temp);

	$.post("ajax/diseno.php?op=consul_datos_control",{id_ped_temp:id_ped_temp},function(data, status)
	{
	data = JSON.parse(data);

	//alert(data.fecha_pedido);

		$("#fecha_reporte").text(data.fecha_pedido);
		//$("#no_cliente_rep").text(data.no_cliente);
		$("#no_pedido_rep").text(data.no_pedido);
		$("#condiciones_rep").text(data.condiciones);
		$("#no_control_rep").text(data.no_control);
		$("#asesor_reporte").text(data.asesor);
		$("#lev_cliente_rep").text(data.levanto_pedido);

		if (data.cliente_nuevo==1) {
			var cliente_nuevo_rep = "Si";
		}
		if (data.cliente_nuevo==0) {
			var cliente_nuevo_rep = "No";
		}

		$("#cli_new_pedido_rep").text(cliente_nuevo_rep);
		$("#medio_rep").text(data.medio);
		$("#lab_rep").text(data.lab);
		$("#autori_rep").text(data.autorizacion);

		if (data.tipo==1) {
			var tipo = "PEDIDO COMERCIAL";
		}
		if (data.tipo==2) {
			var tipo = "PEDIDO DE LICITACIÓN";
		}
		if (data.tipo==3) {
			var tipo = "PEDIDO DE MUESTRA";
		}
		if (data.tipo==0) {
			var tipo = "";
		}

		$("#tipo_pedido").text(tipo);
		$("#nombre_cli_gen").text(data.nombre_cliente_gen);

		$("#nom_fir_cli_rep").val(data.firma_cliente);
		$("#nom_fir_prod_rep").val(data.firma_prod);
		$("#reviso_rep").val(data.reviso);
		$("#requisitos_leg_rep").text(data.reglamentos);
		$("#empaque_rep").text(data.empaque);
		$("#metodo_pago_rep").text(data.metodo_pago+", "+data.forma_pago);
		$("#uso_cfdi_rep").text(data.uso_cfdi);

		$("#enviado_enlace_rep").text(data.fecha_envio_enlace);
		$("#salida_rep").text(data.salida);
		$("#factura_rep").text(data.factura);
		$("#otroe_rep").text(data.otros);
		$("#observ").val(data.observaciones);

	});
}


function consul_datos_facturacion()
{
	var id_ped_temp = $("#id_ped_temp2").text();
	//alert(id_ped_temp);

	$.post("ajax/diseno.php?op=consul_datos_facturacion",{id_ped_temp:id_ped_temp},function(data, status)
	{
	data = JSON.parse(data);

		$("#razon_fac_rep").text(data.razon_fac);
		$("#rfc_fac_rep").text(data.rfc_fac);
		$("#dom_fac_rep").text(data.calle_fac+' '+data.numero_fac+' Int.'+data.interior_fac);
		$("#col_fac_rep").text(data.colonia_fac);
		$("#cuidad_fac_rep").text(", "+data.ciudad_fac);
		$("#estado_fac_rep").text(" "+data.estado_fac);
		$("#tel_fac_rep").text(data.telefono_fac);
		$("#email_fac_rep").text(data.email_fac);
		$("#cp_fac_rep").text(data.cp_fac);


	});
}

function consul_datos_entrega()
{
	var id_ped_temp = $("#id_ped_temp2").text();

	
	//alert(id_ped_temp);

	$.post("ajax/diseno.php?op=consul_datos_entrega",{id_ped_temp:id_ped_temp},function(data, status)
	{
	data = JSON.parse(data);

		$("#contacto_ent_rep").text(data.contacto_ent);
		$("#dom_ent_rep").text(data.calle_ent+' '+data.numero_ent+' '+data.interior_ent);
		$("#col_ent_rep").text(data.colonia_ent);
		$("#cuidad_est_ent_rep").text(", "+data.ciudad_ent+', '+data.estado_ent);
		$("#cp_ent_rep").text(data.cp_ent);
		$("#tel_ent_rep").text(data.telefono_ent);
		$("#email_ent_rep").text(data.email_ent);
		$("#fecha_hora_ent_rep").text(data.fecha_entrega_ent);

		$("#hora1_ent_rep").text(data.hora_entrega_r1+"  -  "+data.hora_entrega_r2);
		//$("#hora2_ent_rep").text(data.hora_entrega_r2);
		

		//alert(data.fecha_entrega_ent);

		if (data.fecha_entrega_ent!=null) {
			document.getElementById("edit_fecha").style.visibility = "hidden";			
		}

		$("#forma_ent_rep").text(data.forma_entrega_ent);
		$("#det_forma_ent_rep").text(data.det_forma_entrega);
		$("#ref_ent_rep").text(data.referencia_ent);

	});
}


function update_observ()
{
	var id_ped_temp = $("#id_ped_temp2").text();
	var observ = $("#observ").val();
	var nom_fir_cli_rep = $("#nom_fir_cli_rep").val();
	var nom_fir_prod_rep = $("#nom_fir_prod_rep").val();
	var reviso_rep = $("#reviso_rep").val();

	$.post("ajax/diseno.php?op=update_observ",{id_ped_temp:id_ped_temp,observ:observ,nom_fir_cli_rep:nom_fir_cli_rep,nom_fir_prod_rep:nom_fir_prod_rep,reviso_rep:reviso_rep},function(data, status)
	{
	data = JSON.parse(data);



			


	});
}

function edit_prod(idproducto)
{
	var idusuario=$("#idusuario").text();

	//alert(idusuario);

	if (idusuario==1) {

		document.getElementById('precio_rep').disabled = false;

	}


	$("#modal_edit_prod_rep").modal("show");
	$("#idproducto_rep").val(idproducto);

	var id_ped_temp = $("#id_ped_temp2").text();

	$.post("ajax/diseno.php?op=buscar_prod_rep",{id_ped_temp:id_ped_temp,idproducto:idproducto},function(data, status)
	{
	data = JSON.parse(data);

		 if (idusuario==1) {

		 	
		 	document.getElementById('cantidad_rep').disabled = false;
		 	document.getElementById('unidad_rep').disabled = false;
		 	document.getElementById('codigo_rep').disabled = false;
		 	document.getElementById('medida_rep').disabled = false;
		 	document.getElementById('descripcion_rep').disabled = false;
		 	document.getElementById('color_rep').disabled = false;
		 	document.getElementById('precio_rep').disabled = false;
			

		 }else{
		 	

		 	document.getElementById('cantidad_rep').disabled = true;
		 	document.getElementById('unidad_rep').disabled = true;
		 	document.getElementById('codigo_rep').disabled = true;
		 	document.getElementById('medida_rep').disabled = true;
		 	document.getElementById('descripcion_rep').disabled = true;
		 	document.getElementById('color_rep').disabled = true;
		 	document.getElementById('precio_rep').disabled = true;
		 }

		 $("#cantidad_rep").val(data.cantidad);
		 $("#unidad_rep").val(data.unidad);
		 $("#codigo_rep").val(data.codigo);
		 $("#medida_rep").val(data.medida);
		 $("#descripcion_rep").val(data.descripcion);
		 $("#precio_rep").val(data.precio);
		 $("#descuento_rep").val(data.descuento);
		 $("#importe_rep").val(data.importe);

		 	

	});
	
}

function update_prod_rep()
{
	var id_ped_temp = $("#id_ped_temp2").text();
	var idproducto_rep = $("#idproducto_rep").val();

	var cantidad_rep = $("#cantidad_rep").val();
	var unidad_rep = $("#unidad_rep").val();
	var codigo_rep = $("#codigo_rep").val();
	var medida_rep = $("#medida_rep").val();
	var descripcion_rep = $("#descripcion_rep").val();
	var color_rep = $("#color_rep").val();

	var precio_rep = $("#precio_rep").val();


	

	var descuento_rep = $("#descuento_rep").val();
	var descuento_rep2 = $("#descuento_rep2").val();

	var importe_rep = $("#importe_rep").val();

	$.post("ajax/diseno.php?op=update_prod_rep",{
		id_ped_temp:id_ped_temp,
		idproducto_rep:idproducto_rep,
		cantidad_rep:cantidad_rep,
		unidad_rep:unidad_rep,
		codigo_rep:codigo_rep,
		medida_rep:medida_rep,
		descripcion_rep:descripcion_rep,
		color_rep:color_rep,
		precio_rep:precio_rep,
		descuento_rep:descuento_rep,
		descuento_rep2:descuento_rep2,
		importe_rep:importe_rep},function(data, status)
	{
	data = JSON.parse(data);
		tbl_rep_pedido_consul();
		pie_reporte();



			var idusuario=$("#idusuario").text();
			var fecha=moment().format('YYYY-MM-DD');
			var hora=moment().format('HH:mm:ss');
			var fecha_hora=fecha+" "+hora;
			//var text_set = "Producto editado, codigo: "+codigo_rep;
			var text_set = "Descuento solicitado";

			$.post("ajax/diseno.php?op=save_hist",{id_ped_temp:id_ped_temp,idusuario:idusuario,fecha_hora:fecha_hora,text_set:text_set},function(data, status)
			{
			data = JSON.parse(data);

				$("#modal_edit_prod_rep").modal("hide");
				location.reload();
			});




		
	});

}


function calcular_importe_modal()
{
	var cantidad_rep = $("#cantidad_rep").val();

	var precio_rep1 = $("#precio_rep").val();
	var precio_rep=cantidad_rep*precio_rep1;

	var descuento_rep = $("#descuento_rep").val();

	var porc_desc = descuento_rep/100;

	if (porc_desc==0) {


	    int_part = Math.trunc(precio_rep);
		float_part = Number((precio_rep-int_part).toFixed(2));
		var precio_rep_fixed = int_part+float_part;
		$("#importe_rep").val(precio_rep_fixed);

	}else{		


		var importe_rep_new = precio_rep-(precio_rep*porc_desc);
		var cant_desc = precio_rep-importe_rep_new;

		int_part = Math.trunc(importe_rep_new);
		float_part = Number((importe_rep_new-int_part).toFixed(2));
		var num_fixed = int_part+float_part;
		$("#importe_rep").val(num_fixed);

		float_part2 = Number((cant_desc).toFixed(2));
		$("#descuento_rep2").val(float_part2);
		
	}

	
}

function calcular_importe_modal_edit_prod()
{
	var cantidad_rep = $("#cantidad_pedido_edit").val();

	var precio_rep1 = $("#precio_pedido_edit").val();
	var precio_rep=cantidad_rep*precio_rep1;

	var descuento_rep = $("#descuento_pedido_edit").val();

	var porc_desc = descuento_rep/100;

	if (porc_desc==0) {


	    int_part = Math.trunc(precio_rep);
		float_part = Number((precio_rep-int_part).toFixed(2));
		var precio_rep_fixed = int_part+float_part;
		$("#importe_pedido_edit").val(precio_rep_fixed);

	}else{		


		var importe_rep_new = precio_rep-(precio_rep*porc_desc);
		var cant_desc = precio_rep-importe_rep_new;

		int_part = Math.trunc(importe_rep_new);
		float_part = Number((importe_rep_new-int_part).toFixed(2));
		var num_fixed = int_part+float_part;
		$("#importe_pedido_edit").val(num_fixed);

		float_part2 = Number((cant_desc).toFixed(2));
		$("#descuento_rep2_pedido_edit").val(float_part2);
		
	}

	
}


function listar_pedidos()
{
	$("#no_control_buscar").val("");
	$("#cliente_buscar").val("");
	//var marca = $("#marca_list_ped").val();
	//if (marca=="") {
		marca=1;
	//}
	//alert(marca);
	var idusuario=$("#idusuario").text();

	$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

			var lugar = data.lugar;
			$("#lugar_user").text(lugar);

			//alert(lugar);


				  //alert(lugar);

			      if (lugar=="Fabrica") {

				      	$("#buscar_cli").show();

				      	if (idusuario==4 || idusuario==1) {

				      		$("#btn_vista1").show();
							$("#btn_vista2").hide();
							
				      	}else{

				      		$("#btn_vista1").hide();
							$("#btn_vista2").hide();
							
				      	}


				      	
						
						$("#regresar_total").show();
						$("#regresar_listos").hide();
						//$("#btn_seguim").show();

						
						

				      	
			      }else{
			      	if (lugar!="Fabrica" && lugar!="Zuno") {
			      		$("#buscar_cli").hide();
			      		$("#btn_vista1").hide();
						$("#btn_vista2").hide();
						
						$("#btn_seguim").hide();
						//$("#btn_seguim2").hide();
						$("#rgresar_listos").show();
						$("#regresar_total").hide();

						
			      	}
			      }

			     

				if (lugar=="Zuno") {

					$("#buscar_cli").show();

					$("#btn_vista1").hide();
					$("#btn_vista2").hide();
					
					$("#rgresar_listos").show();
					$("#regresar_total").hide();
					//$("#btn_seguim2").hide();
					

				}

					
					



			var estatus_tabla=$("#estatus_tabla").val();

			$.post("ajax/diseno.php?op=listar_pedidos&id="+idusuario+"&num="+estatus_tabla+"&marca="+marca+"&lugar="+lugar,function(r){
			        $("#datatable_buttons").html(r);

			       
			       
			});

			$.post("ajax/diseno.php?op=listar_pedidos2&id="+idusuario+"&num="+estatus_tabla+"&marca="+marca+"&lugar="+lugar,function(r){
			        $("#box_pedidos").html(r);
       
			});



			/*$.post("ajax/diseno.php?op=listar_pedidos3&id="+idusuario+"&num="+estatus_tabla+"&marca="+marca+"&lugar="+lugar,function(r){
			        $("#box_pedidos2").html(r);
       
			});*/

	});

			
}


function listar_pedidos_buscar()
{
	var no_control_buscar = $("#no_control_buscar").val();

	//alert(no_control_buscar);
	//if (marca=="") {
		//marca=1;
	//}
	//alert(marca);
	var idusuario=$("#idusuario").text();

	$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

			var lugar = data.lugar;
			$("#lugar_user").text(lugar);

			//alert(lugar);


				  //alert(lugar);

			      if (lugar=="Fabrica" || lugar=="Zuno") {

				      	$("#buscar_cli").show();

				      	if (idusuario==4 || idusuario==1) {

				      		$("#btn_vista1").show();
							$("#btn_vista2").hide();
				      	}else{

				      		$("#btn_vista1").hide();
							$("#btn_vista2").hide();
				      	}


				      	
						$("#btn_seguim").show();
						//$("#btn_seguim2").show();
				      	
			      }else{
			      	if (lugar!="Fabrica" && lugar!="Zuno") {
			      		$("#buscar_cli").hide();
			      		$("#btn_vista1").hide();
						$("#btn_vista2").hide();
						$("#btn_seguim").hide();
						//$("#btn_seguim2").hide();
			      	}
			      }



			//var estatus_tabla=$("#estatus_tabla").val();

			$.post("ajax/diseno.php?op=listar_pedidos3&id="+idusuario+"&lugar="+lugar+"&no_control_buscar="+no_control_buscar,function(r){
			        $("#datatable_buttons").html(r);


			       
			});

			$.post("ajax/diseno.php?op=listar_pedidos4&id="+idusuario+"&lugar="+lugar+"&no_control_buscar="+no_control_buscar,function(r){
			        $("#box_pedidos").html(r);


			       
			});

			

			/*$.post("ajax/diseno.php?op=listar_pedidos3&id="+idusuario+"&num="+estatus_tabla+"&marca="+marca+"&lugar="+lugar,function(r){
			        $("#box_pedidos2").html(r);
       
			});*/

	});

			
}



function listar_pedidos_buscar_cli()
{
	var cliente_buscar = $("#idcliente_buscar").val();

	var idusuario=$("#idusuario").text();

	$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

			var lugar = data.lugar;
			$("#lugar_user").text(lugar);

			//alert(lugar);


				  //alert(lugar);

			      if (lugar=="Fabrica" || lugar=="Zuno") {

				      	$("#buscar_cli").show();

				      	if (idusuario==4 || idusuario==1) {

				      		$("#btn_vista1").show();
							$("#btn_vista2").hide();
				      	}else{

				      		$("#btn_vista1").hide();
							$("#btn_vista2").hide();
				      	}


				      	
						$("#btn_seguim").show();
						//$("#btn_seguim2").show();
				      	
			      }else{
			      	if (lugar!="Fabrica" && lugar!="Zuno") {
			      		$("#buscar_cli").hide();
			      		$("#btn_vista1").hide();
						$("#btn_vista2").hide();
						$("#btn_seguim").hide();
						//$("#btn_seguim2").hide();
			      	}
			      }


			//var estatus_tabla=$("#estatus_tabla").val();

			$.post("ajax/diseno.php?op=listar_pedidos3_2&id="+idusuario+"&lugar="+lugar+"&cliente_buscar="+cliente_buscar,function(r){
			        $("#datatable_buttons").html(r);


			       
			});

			$.post("ajax/diseno.php?op=listar_pedidos4_2&id="+idusuario+"&lugar="+lugar+"&cliente_buscar="+cliente_buscar,function(r){
			        $("#box_pedidos").html(r);


			       
			});

			

			/*$.post("ajax/diseno.php?op=listar_pedidos3&id="+idusuario+"&num="+estatus_tabla+"&marca="+marca+"&lugar="+lugar,function(r){
			        $("#box_pedidos2").html(r);
       
			});*/

	});

			
}



function abrir_modal_prod()
{
	var idusuario=$("#idusuario").text();

	$("#modal_productos").modal("show");

	if (idusuario==4 || idusuario==5 || idusuario==8 || idusuario==10) {

		$.post("ajax/diseno.php?op=tbl_productos2",function(r){
		        $("#datatable_prod").html(r);       
		});


	}else{

		$.post("ajax/diseno.php?op=tbl_productos",function(r){
		        $("#datatable_prod").html(r);       
		});
	}

		
}


function buscar_texto_tbl_prod()
{
	
	var text_buscar_prod = $("#text_buscar_prod").val();

	$.post("ajax/diseno.php?op=buscar_texto_tbl_prod&id="+text_buscar_prod,function(r){
	        $("#datatable_prod").html(r);

	       
	});
}


function abrir_modal_new_prod()
{

	$("#modal_reg_productos").modal("show");
	$("#modal_productos").modal("hide");
}


function buscar_prod_exist()
{
	//
	var codigo_new = $("#codigo_new_prod").val();

	//alert(codigo_new);

	//$.post("ajax/diseno.php?op=buscar_cliente2",{num_cli:num_cli,nom_cli:nom_cli},function(r){
	$.post("ajax/diseno.php?op=buscar_prod_exist&id="+codigo_new,function(r){
	        $("#prod_exist").html(r);

	       
	});

			
}

function save_prod()
{
	var tipo_prod = $("#tipo_prod").val();

	var codigo_new_prod = $("#codigo_new_prod").val();
	var nombre_new_prod = $("#nombre_new_prod").val();
	var color_new_prod = $("#color_new_prod").val();
	var medida_new_prod = $("#medida_new_prod").val();
	var precio_new_prod = $("#precio_new_prod").val();

	if (tipo_prod<1) {

		bootbox.alert("Es necesario seleccionar el tipo de producto");
	}else{

			$.post("ajax/diseno.php?op=consul_exist_prod",{codigo_new_prod:codigo_new_prod},function(data, status)
			{
			data = JSON.parse(data);

				data.num_productos

				if (data.num_productos==0) {


						$.post("ajax/diseno.php?op=save_prod",{
						tipo_prod:tipo_prod,
						codigo_new_prod:codigo_new_prod,
						nombre_new_prod:nombre_new_prod,
						color_new_prod:color_new_prod,
						medida_new_prod:medida_new_prod,
						precio_new_prod:precio_new_prod},function(data, status)
						{
						data = JSON.parse(data);

								bootbox.alert("Producto guardado");
								
								buscar_prod_exist();
								//$("#modal_cliente").modal("show");
								//$("#modal_data_new_cli").modal("hide");
								$("#modal_reg_productos").modal("hide");
								$("#modal_productos").modal("show");

								$("#codigo_new_prod").val("");
								$("#nombre_new_prod").val("");
								$("#color_new_prod").val("");
								$("#medida_new_prod").val("");
								$("#precio_new_prod").val("");

						});

				}else{
					bootbox.alert("El producto ya existe");
				}

			});

	}


			


			

}

function cerrar_new_prod()
{
	$("#modal_reg_productos").modal("hide");
	$("#modal_productos").modal("show");
}


/*function agregar_prod_ped(idproducto,precio_total)
{
	var id_ped_temp = $("#id_ped_temp").val();

		var precio = precio_total;


		$.post("ajax/diseno.php?op=consul_exist",{idproducto:idproducto,id_ped_temp:id_ped_temp},function(data, status)
		{
		data = JSON.parse(data);

			if (data.num_prod==0) {

				$.post("ajax/diseno.php?op=save_prod_ped",{idproducto:idproducto,id_ped_temp:id_ped_temp,precio:precio},function(data, status)
				{
					data = JSON.parse(data);

					//alert("producto agregado");


					//consul_prod_ped();
					abrir_pagina_pedido();

					var notificator = new Notification(document.querySelector('.notification'));
					notificator.info('Producto agregado correctamente.');


				});

			}else{
				bootbox.alert("Este producto ya fue agregado");
			}

		});


}*/

function agregar_prod_ped(idproductos_clasif,idproducto,precio_total)
{
	
	//alert(idproducto);
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var idusuario=$("#idusuario").text();

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

							var id_ped_temp = $("#id_ped_temp").val();
							var precio = precio_total;
							$.post("ajax/diseno.php?op=consul_exist",{idproducto:idproducto,id_ped_temp:id_ped_temp},function(data, status)
							{
							data = JSON.parse(data);
								if (data.num_prod==0) {
									var tipo_add = 0;
									$.post("ajax/diseno.php?op=save_prod_ped",{idproducto:idproducto,id_ped_temp:id_ped_temp,precio:precio,tipo_add:tipo_add,fecha_hora:fecha_hora,idusuario:idusuario},function(data, status)
									{
										data = JSON.parse(data);
										listar_productos_seleccionados();
										var notificator = new Notification(document.querySelector('.notification'));
										notificator.info('Producto agregado correctamente.');
									});

								}else{
									bootbox.alert("Este producto ya fue agregado");
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



							var id_ped_temp = $("#id_ped_temp").val();
							var precio = precio_total;
							$.post("ajax/diseno.php?op=consul_exist",{idproducto:idproducto,id_ped_temp:id_ped_temp},function(data, status)
							{
							data = JSON.parse(data);
								if (data.num_prod==0) {
									var tipo_add = 0;
									$.post("ajax/diseno.php?op=save_prod_ped",{idproducto:idproducto,id_ped_temp:id_ped_temp,precio:precio,tipo_add:tipo_add,fecha_hora:fecha_hora,idusuario:idusuario},function(data, status)
									{
										data = JSON.parse(data);
										listar_productos_seleccionados();
										var notificator = new Notification(document.querySelector('.notification'));
										notificator.info('Producto agregado correctamente.');

										var buscar_prod_fil = $("#buscar_prod_fil").val();

										$.post("ajax/diseno.php?op=listar_productos_busqueda&id="+buscar_prod_fil,function(r){
										$("#tbl_result_prod").html(r);
										       
										});
									});

								}else{
									bootbox.alert("Este producto ya fue agregado");
								}
							});



						});
					});
					
				});

	}

}


function abrir_modal_entregas()
{
	$("#modal_entregas").modal("show");

	$("#tbl_entregas").show();
	$("#encabezado_prod_ped").show();
	$("#form_entregas").hide();
	$("#btn_guardar_entrega").hide();
	$("#btn_actualizar_entrega").hide();
	$("#btn_regresar_a_entregas").hide();

	var id_ped_temp = $("#id_ped_temp2").text();

	$.post("ajax/diseno.php?op=num_entregas",{id_ped_temp:id_ped_temp},function(data, status)
	{
		data = JSON.parse(data);

		if (data.num_entregas==0) {
			$("#num_entregas").text("Aún no has realizado entregas.");
		}else{


			$.post("ajax/diseno.php?op=listar_productos_pedido&id="+id_ped_temp,function(r){
			        $("#tbl_productos_pedido").html(r);
			       	

			       	$.post("ajax/diseno.php?op=listar_entregas&id="+id_ped_temp,function(r){
					        $("#datatable_entregas").html(r);

					       $("#num_entregas").text("");

					});
			       
			});

					
		}

		


	});

}



function reg_entrega()
{	
	limpiar_datos_entrega();
	//var fecha=moment().format('YYYY-MM-DD');
	var id_ped_temp = $("#id_ped_temp2").text();
	$("#identregas_reg").val("");

	$.post("ajax/diseno.php?op=reg_entrega",{id_ped_temp:id_ped_temp},function(data, status)
	{
	data = JSON.parse(data);

		
		
		$("#identregas_reg").val(data.identregas);
		

	});
}

function limpiar_datos_entrega()
{
	$("#identregas_reg").val("");
	$("#fecha_sal").val("");
	$("#no_salida_sal").val("");

	$("#no_control_sal").val("");
	$("#no_pedido_sal").val("");
	$("#domicilio_sal").val("");
	$("#colonia_sal").val("");
	$("#municipio_sal").val("");
	$("#estado_sal").val("");
	$("#cp_sal").val("");
	$("#contacto_sal").val("");
	$("#telefono_sal").val("");
	$("#horario_sal").val("");
	$("#condiciones_sal").val("");
	$("#medio_sal").val("");
	$("#nombre_sal").val("");
}


function registrar_entrega()
{
	reg_entrega();
	$("#tbl_entregas").hide();
	$("#encabezado_prod_ped").hide();
	$("#form_entregas").show();
	$("#btn_guardar_entrega").show();
	$("#btn_actualizar_entrega").hide();
	$("#btn_regresar_a_entregas").show();

	var id_ped_temp = $("#id_ped_temp2").text();

	$.post("ajax/diseno.php?op=consul_idcliente",{id_ped_temp:id_ped_temp},function(data, status)
	{
	data = JSON.parse(data);

			var idcliente = data.idcliente;
			var iddir_entrega = data.id_entrega;

			$("#no_control_sal").val(data.no_control);
			$("#no_pedido_sal").val(data.no_pedido);


			$.post("ajax/diseno.php?op=consul_dir_ent",{iddir_entrega:iddir_entrega},function(data, status)
			{
			data = JSON.parse(data);

				$("#domicilio_sal").val(data.calle_ent+" "+data.numero_ent);
				$("#colonia_sal").val(data.colonia_ent);
				$("#municipio_sal").val(data.ciudad_ent);
				$("#estado_sal").val(data.estado_ent);
				$("#cp_sal").val(data.cp_ent);
				$("#contacto_sal").val(data.contacto_ent);
				$("#telefono_sal").val(data.telefono_ent);
				$("#horario_sal").val();
				$("#condiciones_sal").val();
				$("#medio_sal").val(data.forma_entrega_ent);


				$.post("ajax/diseno.php?op=consul_cliente",{idcliente:idcliente},function(data, status)
				{
				data = JSON.parse(data);


					$("#nombre_sal").val(data.nom_cliente);
					listar_prod_entr();

					


				});



			});

	});

			

}


function add_prod(){
	$("#modal_reg_productos_ped").modal("show");

			var id_ped_temp = $("#id_ped_temp2").text();

			//alert(id_ped_temp);

			$.post("ajax/diseno.php?op=listar_prod_entregas&id="+id_ped_temp,function(r){
			        $("#datatable_prod_pedido").html(r);

			       
			});
}

function guardar_prod_entrega(idpg_detalle_pedidos)
{
	var identregas = $("#identregas_reg").val();

	/*alert(identregas);
	alert(idpg_detalle_pedidos);*/

		$.post("ajax/diseno.php?op=consul_det_ped",{idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
		{
		data = JSON.parse(data);

			var cantidad = data.cantidad;
			var codigo = data.codigo;
			var nombre = data.nombre;

			$.post("ajax/diseno.php?op=consul_exist_ent_p",{identregas:identregas,idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
			{
			data = JSON.parse(data);


				if (data.num_prod==0) {

					$.post("ajax/diseno.php?op=pasar_prod",{identregas:identregas,idpg_detalle_pedidos:idpg_detalle_pedidos,cantidad:cantidad,codigo:codigo,nombre:nombre},function(data, status)
					{
					data = JSON.parse(data);

						listar_prod_entr();
						

					});
				}else{
					bootbox.alert("Este producto ya fue agregado");
				}



			});

				

		});

			
}

function listar_prod_entr()
{
	var identregas = $("#identregas_reg").val();


	

	$.post("ajax/diseno.php?op=listar_prod_entr&id="+identregas,function(r){			       
	$("#datatable_prod_pedido_agregados").html(r);


			        $.post("ajax/diseno.php?op=listar_prod_entr2&id="+identregas,function(r){
			        $("#datatable_prod_entregas").html(r);
			        
			       
					});
			       
	});


	


	
}


function upd_cant_prod_ent(identregas_detalle)
{
	var cantidad = $("#cant_prod_ent"+identregas_detalle).val();
	

	$.post("ajax/diseno.php?op=upd_cant_prod_ent",{identregas_detalle:identregas_detalle,cantidad:cantidad},function(data, status)
	{
	data = JSON.parse(data);

		
		//listar_prod_entr();				

	});

}

function upd_lote_prod_ent(identregas_detalle)
{
	var lote = $("#lote_prod_ent"+identregas_detalle).val();

	$.post("ajax/diseno.php?op=upd_lote_prod_ent",{identregas_detalle:identregas_detalle,lote:lote},function(data, status)
	{
	data = JSON.parse(data);
		
		//listar_prod_entr();				

	});
}


function save_entrega()
{
	var identregas = $("#identregas_reg").val();

	var fecha_sal = $("#fecha_sal").val();
	var no_salida_sal = $("#no_salida_sal").val();
	var no_control_sal = $("#no_control_sal").val();
	var no_pedido_sal = $("#no_pedido_sal").val();
	var nombre_sal = $("#nombre_sal").val();
	var entregado_a_sal = $("#entregado_a_sal").val();
	var domicilio_sal = $("#domicilio_sal").val();
	var colonia_sal = $("#colonia_sal").val();
	var municipio_sal = $("#municipio_sal").val();
	var estado_sal = $("#estado_sal").val();
	var cp_sal = $("#cp_sal").val();
	var contacto_sal = $("#contacto_sal").val();
	var telefono_sal = $("#telefono_sal").val();
	var horario_sal = $("#horario_sal").val();
	var condiciones_sal = $("#condiciones_sal").val();
	var medio_sal = $("#medio_sal").val();

	$.post("ajax/entregas.php?op=save_entrega",{
		identregas:identregas,
		fecha_sal:fecha_sal,
		no_salida_sal:no_salida_sal,
		no_control_sal:no_control_sal,
		no_pedido_sal:no_pedido_sal,
		nombre_sal:nombre_sal,
		entregado_a_sal:entregado_a_sal,
		domicilio_sal:domicilio_sal,
		colonia_sal:colonia_sal,
		municipio_sal:municipio_sal,
		estado_sal:estado_sal,
		cp_sal:cp_sal,
		contacto_sal:contacto_sal,
		telefono_sal:telefono_sal,
		horario_sal:horario_sal,
		condiciones_sal:condiciones_sal,
		medio_sal:medio_sal},function(data, status)
	{
	data = JSON.parse(data);

		
		$("#form_entregas").hide();
		$("#tbl_entregas").show();
		$("#encabezado_prod_ped").show();

		


		$.post("ajax/diseno.php?op=update_estatus_entrega",{identregas:identregas},function(data, status)
		{
		data = JSON.parse(data);




			$.post("ajax/diseno.php?op=ini_id_ent",{identregas:identregas},function(data, status)
			{
			data = JSON.parse(data);

				var identregas_ini = data.identregas_detalle_ini;
				var det_ped_ini = data.det_ped_ini;

						$.post("ajax/diseno.php?op=fin_id_ent",{identregas:identregas},function(data, status)
						{
						data = JSON.parse(data);

							var identregas_fin = data.identregas_detalle_fin;
							var det_ped_fin = data.det_ped_fin;


								$.post("ajax/diseno.php?op=upd_ped_temp_ent1",{identregas:identregas,det_ped_ini:det_ped_ini,det_ped_fin:det_ped_fin},function(data, status)
								{
								data = JSON.parse(data);

										var id_ped_temp = $("#id_ped_temp2").text();
										var no_salida_sal = $("#no_salida_sal").val();

										/*$.post("ajax/diseno.php?op=listar_entregas&id="+id_ped_temp,function(r){
										        $("#datatable_entregas").html(r);

										       $("#btn_guardar_entrega").hide();
										       bootbox.alert("Entrega guardada exitosamente");

										});*/

										$.post("ajax/diseno.php?op=upd_salida_ped",{id_ped_temp:id_ped_temp,no_salida_sal:no_salida_sal},function(data, status)
										{
										data = JSON.parse(data);

												$.post("ajax/diseno.php?op=listar_productos_pedido&id="+id_ped_temp,function(r){
												        $("#tbl_productos_pedido").html(r);
												       	

												       	$.post("ajax/diseno.php?op=listar_entregas&id="+id_ped_temp,function(r){
														        $("#datatable_entregas").html(r);

														        $("#btn_guardar_entrega").hide();
														        $("#btn_actualizar_entrega").hide();
												       			bootbox.alert("Entrega guardada exitosamente");
												       			$("#num_entregas").text("");

												       			/*var no_salida_sal = $("#no_salida_sal").val();
												       			var salida_rep = $("#salida_rep").val();
												       			$("#salida_rep").val(salida_rep+" - "+no_salida_sal);*/

														});
												       
												});

										});


												


								});




						});


			});






					
			
			//listar_prod_entr();				

		});


		//listar_entregas();

					



	});
}


function detalle_entrega2(identregas)
{
	$("#modal_entregas_ped").modal("show");
	$("#modal_entregas").modal("hide");

	$.post("ajax/diseno.php?op=detalle_entrega_ped",{identregas:identregas},function(data, status)
	{
	data = JSON.parse(data);

		$("#fecha_d_entr").val(data.fecha);
		$("#no_salida_d_entr").val(data.no_salida);
		$("#no_control_d_entr").val(data.no_control);
		$("#no_pedido_d_entr").val(data.no_pedido);
		$("#nombre_d_entr").val(data.nombre);
		$("#entregado_a_d_entr").val(data.entregado_a);
		$("#domicilio_d_entr").val(data.dom);
		$("#colonia_d_entr").val(data.col);
		$("#municipio_d_entr").val(data.mun);
		$("#estado_d_entr").val(data.est);
		$("#cp_d_entr").val(data.cp);
		$("#contacto_d_entr").val(data.contacto);
		$("#telefono_d_entr").val(data.tel);
		$("#horario_d_entr").val(data.horario);
		$("#condiciones_d_entr").val(data.condiciones);
		$("#medio_d_entr").val(data.medio_transporte);


		$.post("ajax/diseno.php?op=listar_det_entrega&id="+identregas,function(r){
		$("#datatable_dp_entrega").html(r);

			

		});


	});
	
}



function detalle_entrega(identregas)
{
	//reg_entrega();
	limpiar_datos_entrega();
	$("#identregas_reg").val(identregas);
	$("#tbl_entregas").hide();
	$("#encabezado_prod_ped").hide();
	$("#form_entregas").show();
	$("#btn_guardar_entrega").hide();
	$("#btn_actualizar_entrega").show();
	$("#btn_regresar_a_entregas").show();
	$("#titulo_entrega").text("DETALLE DE ENTREGA");

	$.post("ajax/diseno.php?op=detalle_entrega_ped",{identregas:identregas},function(data, status)
	{
	data = JSON.parse(data);

		$("#fecha_sal").val(data.fecha);
		document.getElementById('fecha_sal').disabled = true;
		$("#no_salida_sal").val(data.no_salida);
		document.getElementById('no_salida_sal').disabled = true;
		$("#no_control_sal").val(data.no_control);
		$("#no_pedido_sal").val(data.no_pedido);
		$("#nombre_sal").val(data.nombre);
		document.getElementById('nombre_sal').disabled = true;
		$("#entregado_a_sal").val(data.entregado_a);
		document.getElementById('entregado_a_sal').disabled = true;
		$("#domicilio_sal").val(data.dom);
		document.getElementById('domicilio_sal').disabled = true;
		$("#colonia_sal").val(data.col);
		document.getElementById('colonia_sal').disabled = true;
		$("#municipio_sal").val(data.mun);
		document.getElementById('municipio_sal').disabled = true;
		$("#estado_sal").val(data.est);
		document.getElementById('estado_sal').disabled = true;
		$("#cp_sal").val(data.cp);
		document.getElementById('cp_sal').disabled = true;
		$("#contacto_sal").val(data.contacto);
		document.getElementById('contacto_sal').disabled = true;
		$("#telefono_sal").val(data.tel);
		document.getElementById('telefono_sal').disabled = true;
		$("#horario_sal").val(data.horario);
		document.getElementById('horario_sal').disabled = true;
		$("#condiciones_sal").val(data.condiciones);
		document.getElementById('condiciones_sal').disabled = true;
		$("#medio_sal").val(data.medio_transporte);
		document.getElementById('medio_sal').disabled = true;

		$.post("ajax/diseno.php?op=listar_det_entrega&id="+identregas,function(r){
		$("#datatable_dp_entrega").html(r);

			listar_prod_entr();

			
				//alert(identregas);

				$.post("ajax/diseno.php?op=ini_id_ent",{identregas:identregas},function(data, status)
				{
				data = JSON.parse(data);

				//var identregas_ini = data.identregas_detalle_ini;
				var det_ped_ini = data.det_ped_ini;


				//alert(det_ped_ini);

									$.post("ajax/diseno.php?op=fin_id_ent",{identregas:identregas},function(data, status)
									{
									data = JSON.parse(data);

									//var identregas_fin = data.identregas_detalle_fin;
									var det_ped_fin = data.det_ped_fin;
									//alert(det_ped_fin);


										$.post("ajax/diseno.php?op=resp_ped_temp_ent",{identregas:identregas,det_ped_ini:det_ped_ini,det_ped_fin:det_ped_fin},function(data, status)
										{
										data = JSON.parse(data);


										});



									});

				});


		});


	});















	/*var id_ped_temp = $("#id_ped_temp2").text();

	$.post("ajax/diseno.php?op=consul_idcliente",{id_ped_temp:id_ped_temp},function(data, status)
	{
	data = JSON.parse(data);

			var idcliente = data.idcliente;
			var iddir_entrega = data.id_entrega;

			$("#no_control_sal").val(data.no_control);
			$("#no_pedido_sal").val(data.no_pedido);


			$.post("ajax/diseno.php?op=consul_dir_ent",{iddir_entrega:iddir_entrega},function(data, status)
			{
			data = JSON.parse(data);

				$("#domicilio_sal").val(data.calle_ent+" "+data.numero_ent);
				$("#colonia_sal").val(data.colonia_ent);
				$("#municipio_sal").val(data.ciudad_ent);
				$("#estado_sal").val(data.estado_ent);
				$("#cp_sal").val(data.cp_ent);
				$("#contacto_sal").val(data.contacto_ent);
				$("#telefono_sal").val(data.telefono_ent);
				$("#horario_sal").val();
				$("#condiciones_sal").val();
				$("#medio_sal").val(data.forma_entrega_ent);


				$.post("ajax/diseno.php?op=consul_cliente",{idcliente:idcliente},function(data, status)
				{
				data = JSON.parse(data);


					$("#nombre_sal").val(data.nom_cliente);
					listar_prod_entr();

					


				});



			});

	});*/

			

}


function actualizar_entrega()
{	
	guardar_detalle_entrega();
	//upd_entrega();
	
}

 

function upd_entrega()
{
	var identregas = $("#identregas_reg").val();

	//alert(identregas);

	var fecha_sal = $("#fecha_sal").val();
	var no_salida_sal = $("#no_salida_sal").val();
	var no_control_sal = $("#no_control_sal").val();
	var no_pedido_sal = $("#no_pedido_sal").val();
	var nombre_sal = $("#nombre_sal").val();
	var entregado_a_sal = $("#entregado_a_sal").val();
	var domicilio_sal = $("#domicilio_sal").val();
	var colonia_sal = $("#colonia_sal").val();
	var municipio_sal = $("#municipio_sal").val();
	var estado_sal = $("#estado_sal").val();
	var cp_sal = $("#cp_sal").val();
	var contacto_sal = $("#contacto_sal").val();
	var telefono_sal = $("#telefono_sal").val();
	var horario_sal = $("#horario_sal").val();
	var condiciones_sal = $("#condiciones_sal").val();
	var medio_sal = $("#medio_sal").val();

	$.post("ajax/entregas.php?op=upd_entrega",{
		identregas:identregas,
		fecha_sal:fecha_sal,
		no_salida_sal:no_salida_sal,
		no_control_sal:no_control_sal,
		no_pedido_sal:no_pedido_sal,
		nombre_sal:nombre_sal,
		entregado_a_sal:entregado_a_sal,
		domicilio_sal:domicilio_sal,
		colonia_sal:colonia_sal,
		municipio_sal:municipio_sal,
		estado_sal:estado_sal,
		cp_sal:cp_sal,
		contacto_sal:contacto_sal,
		telefono_sal:telefono_sal,
		horario_sal:horario_sal,
		condiciones_sal:condiciones_sal,
		medio_sal:medio_sal},function(data, status)
	{
	data = JSON.parse(data);

		
		

		
	});
}


function guardar_detalle_entrega()
{
	var identregas = $("#identregas_reg").val();

			$.post("ajax/diseno.php?op=ini_id_ent",{identregas:identregas},function(data, status)
			{
			data = JSON.parse(data);

				var identregas_ini = data.identregas_detalle_ini;
				var det_ped_ini = data.det_ped_ini;

						$.post("ajax/diseno.php?op=fin_id_ent",{identregas:identregas},function(data, status)
						{
						data = JSON.parse(data);

							var identregas_fin = data.identregas_detalle_fin;
							var det_ped_fin = data.det_ped_fin;


							$.post("ajax/diseno.php?op=rest_ped_temp_ent",{identregas:identregas,det_ped_ini:det_ped_ini,det_ped_fin:det_ped_fin},function(data, status)
							{
							data = JSON.parse(data);

								$.post("ajax/diseno.php?op=upd_ped_temp_ent2",{identregas:identregas,det_ped_ini:det_ped_ini,det_ped_fin:det_ped_fin},function(data, status)
								{
								data = JSON.parse(data);

										var id_ped_temp = $("#id_ped_temp2").text();

										/*$.post("ajax/diseno.php?op=listar_entregas&id="+id_ped_temp,function(r){
										        $("#datatable_entregas").html(r);

										       $("#btn_guardar_entrega").hide();
										       bootbox.alert("Entrega guardada exitosamente");

										});*/


										$.post("ajax/diseno.php?op=listar_productos_pedido&id="+id_ped_temp,function(r){
										        $("#tbl_productos_pedido").html(r);
										       	

										       	$.post("ajax/diseno.php?op=listar_entregas&id="+id_ped_temp,function(r){
												        $("#datatable_entregas").html(r);

												        $("#btn_guardar_entrega").hide();
												        $("#btn_actualizar_entrega").hide();

												        $("#form_entregas").hide();
														$("#tbl_entregas").show();
														$("#encabezado_prod_ped").show();

										       			bootbox.alert("Entrega actualizada exitosamente");

												});
										       
										});

								});


							});

								

							



								
						});
			});
}

function borrar_entrega(identregas)
{
	//var identregas = $("#identregas").val();


	bootbox.confirm({
	    message: "¿Esta seguro de eliminar esta entrega de la selección?",
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
	        console.log('This was logged in the callback: ' + result);

	        //alert(result);


	        if (result==true) {


	        


				        $.post("ajax/diseno.php?op=ini_id_ent",{identregas:identregas},function(data, status)
						{
						data = JSON.parse(data);

							//var identregas_ini = data.identregas_detalle_ini;
							var det_ped_ini = data.det_ped_ini;

									$.post("ajax/diseno.php?op=fin_id_ent",{identregas:identregas},function(data, status)
									{
									data = JSON.parse(data);

										//var identregas_fin = data.identregas_detalle_fin;
										var det_ped_fin = data.det_ped_fin;



										$.post("ajax/diseno.php?op=restar_cant_ped",{identregas:identregas,det_ped_ini:det_ped_ini,det_ped_fin:det_ped_fin},function(data, status)
										{
										data = JSON.parse(data);


											$.post("ajax/diseno.php?op=borrar_entrega",{identregas:identregas},function(data, status)
											{
											data = JSON.parse(data);


													var id_ped_temp = $("#id_ped_temp2").text();

													$.post("ajax/diseno.php?op=listar_productos_pedido&id="+id_ped_temp,function(r){
													        $("#tbl_productos_pedido").html(r);
													       	

													       	$.post("ajax/diseno.php?op=listar_entregas&id="+id_ped_temp,function(r){
															        $("#datatable_entregas").html(r);

															       

													       			bootbox.alert("Entrega borrada exitosamente");

															});
													       
													});

												

											});


										});



											
									});
						});
	        	

	        }

	    }
	});


}


function borrar_detalle_ent(identregas_detalle,iddetalle_pedido,estatus)
{

	
	bootbox.confirm({
	    message: "¿Esta seguro de eliminar esta producto de la entrega?",
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
	        console.log('This was logged in the callback: ' + result);

	        //alert(result);


	        if (result==true) {	
		

					if (estatus==1) {


						$.post("ajax/diseno.php?op=restar_cantidad_ped_det",{identregas_detalle:identregas_detalle,iddetalle_pedido:iddetalle_pedido},function(data, status)
						{
						data = JSON.parse(data);



									$.post("ajax/diseno.php?op=borrar_detalle_ent",{identregas_detalle:identregas_detalle},function(data, status)
									{
									data = JSON.parse(data);

										var identregas = $("#identregas_reg").val();

											$.post("ajax/diseno.php?op=listar_prod_entr2&id="+identregas,function(r){
											$("#datatable_prod_entregas").html(r);
															        
															       
										});
															

									});



						});


					}else{

									$.post("ajax/diseno.php?op=borrar_detalle_ent",{identregas_detalle:identregas_detalle},function(data, status)
									{
									data = JSON.parse(data);

										var identregas = $("#identregas_reg").val();

											$.post("ajax/diseno.php?op=listar_prod_entr2&id="+identregas,function(r){
											$("#datatable_prod_entregas").html(r);
															        
															       
										});
															

									});

					}

			}

	    }
	});

										
		
}

function regresar_a_entregas()
{
	$("#tbl_entregas").show();
	$("#encabezado_prod_ped").show();
	$("#form_entregas").hide();

	$("#identregas_reg").val("");
	$("#btn_regresar_a_entregas").hide();
}

function abrir_seg_ped(idpg_pedidos,porc_avance,coment_vencim)
{
	$("#modal_seguim_ped").modal("show");

	//alert(idpg_pedidos);
	//alert(porc_avance);

	$("#idpedido").val(idpg_pedidos);
	$("#porc_av_p").val(porc_avance);
	$("#coment_ped_motivo").val(coment_vencim);

		$.post("ajax/diseno.php?op=abrir_seg_ped&id="+idpg_pedidos,function(r){
		$("#tbl_seguim_ped").html(r);

			var dias_faltantes = $("#dias_restantes"+idpg_pedidos).text();

			if (dias_faltantes<0) {

				$("#btn_entregado").show();
			}else{
				$("#btn_entregado").show();
			}

		});		  
}




function abrir_docs(idpg_pedidos)
{
	$("#modal_doc_ped").modal("show");
	$("#modal_listos").modal("hide");
	$("#modal_terminados").modal("hide");

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


function marcar_sindocs()
{
	var idpg_pedidos = $("#idpedido_doc").val();

	$.post("ajax/diseno.php?op=marcar_sindocs",{idpg_pedidos:idpg_pedidos},function(data, status)
	{
	data = JSON.parse(data);

		

	});
}


function send_reporte()
{
  /*var idproyecto = $("#idtitulo").text();
  var nom_proyecto = $("#nombre_proy").text();*/

  //$("#enlace_rep_int").attr("href","rep_intersec.php?variable1="+idproyecto+"&variable2="+nom_proyecto);
  $("#enlace_rep_int").attr("href","../reportes/exFactura.php");

}





function Notification(htmlElement) {
    
    this.htmlElement = htmlElement;
    this.icon = htmlElement.querySelector('.icon > i');
    this.text = htmlElement.querySelector('.text');
    this.close = htmlElement.querySelector('.close');
    this.isRunning = false;
    this.timeout;
    
    this.bindEvents();
};

Notification.prototype.bindEvents = function() {
	var self = this;
    this.close.addEventListener('click', function() {
        window.clearTimeout(self.timeout);
        self.reset();
    });
}

Notification.prototype.info = function(message) {
    if(this.isRunning) return false;
    
    this.text.innerHTML = message;
	this.htmlElement.className = 'notification info';
    this.icon.className = 'fa fa-2x fa-info-circle';
    
    this.show();
}

Notification.prototype.warning = function(message) {
    if(this.isRunning) return false;
    
    this.text.innerHTML = message;
	this.htmlElement.className = 'notification warning';
    this.icon.className = 'fa fa-2x fa-exclamation-triangle';
    
    this.show();
}

Notification.prototype.error = function(message) {
    if(this.isRunning) return false;
    
    this.text.innerHTML = message;
	 this.htmlElement.className = 'notification error';
     this.icon.className = 'fa fa-2x fa-exclamation-circle';
     
     this.show();
}

Notification.prototype.show = function() {
    if(!this.htmlElement.classList.contains('visible'))
        this.htmlElement.classList.add('visible');
    
    this.isRunning = true;
    this.autoReset();
};
    
Notification.prototype.autoReset = function() {
	var self = this;
    this.timeout = window.setTimeout(function() {
        self.reset();
    }, 5000);
}

Notification.prototype.reset = function() {
	this.htmlElement.className = "notification";
    this.icon.className = "";
    this.isRunning = false;
};

//document.addEventListener('DOMContentLoaded', init);

/*function init() {
	var info = document.getElementById('info');
    var warn = document.getElementById('warn');
    var error = document.getElementById('error');
    
    var notificator = new Notification(document.querySelector('.notification'));
    
    info.onclick = function() {
     	notificator.info('Esta es una información');   
    }
    
    warn.onclick = function() {
        notificator.warning('Te te te advieeeerto!');
    }
    
    error.onclick = function() {
        notificator.error('Le causaste derrame al sistema');
    }
}*/
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


function pasar_texto2()
{
	var coment_ped = $("#coment_ped_motivo").val();
	$("#color").val("EE3676");
	$("#coment_ped").val("APARTADO EN PRODUCTO TERMINADO - "+coment_ped);
	$("#estatus").val("APARTADO");
	document.getElementById("coment_ped").disabled = false;

	var color_mustra = document.getElementById('color2');
	color_mustra.style.backgroundColor = '#EE3676';
}


function pasar_texto3()
{
	var coment_ped = $("#coment_ped_motivo").val();
	$("#color").val("FCE347");
	$("#coment_ped").val("FABRICADO - "+coment_ped);
	$("#estatus").val("FABRICADO");

	document.getElementById("coment_ped").disabled = false;

	var color_mustra = document.getElementById('color2');
	color_mustra.style.backgroundColor = '#FCE347';
}


function pasar_texto4()
{
	var coment_ped = $("#coment_ped_motivo").val();
	$("#color").val("F56630");
	$("#coment_ped").val("EN EXISTENCIA - "+coment_ped);
	$("#estatus").val("EXISTENCIA");
	document.getElementById("coment_ped").disabled = false;

	var color_mustra = document.getElementById('color2');
	color_mustra.style.backgroundColor = '#F56630';
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

function pasar_texto8()
{
	var coment_ped = $("#coment_ped_motivo").val();
	$("#color").val("EF83A9");
	$("#coment_ped").val("APARTADO PARCIAL - "+coment_ped);
	$("#estatus").val("APARTADO PARCIAL");
	document.getElementById("coment_ped").disabled = false;

	var color_mustra = document.getElementById('color2');
	color_mustra.style.backgroundColor = '#EF83A9';
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


function selec_color1()
{
	$("#color_new_prod").val("Amarillo");
	document.getElementById("color_new_prod").disabled = true;
	
}

function selec_color2()
{
	$("#color_new_prod").val("Azul");
	document.getElementById("color_new_prod").disabled = true;
	
}

function selec_color3()
{
	$("#color_new_prod").val("Naranja");
	document.getElementById("color_new_prod").disabled = true;
	
}

function selec_color4()
{
	$("#color_new_prod").val("Rojo");
	document.getElementById("color_new_prod").disabled = true;
	
}

function selec_color5()
{
	$("#color_new_prod").val("Verde");
	document.getElementById("color_new_prod").disabled = true;
	
}

function selec_color6()
{
	$("#color_new_prod").val("");
	document.getElementById("color_new_prod").disabled = false;

}


function set_fecha_hora_entr()
{
	var fecha_entrega_upd2 = $("#fecha_entrega_upd2").val();
	var hora_entrega_upd2 = $("#hora_entrega_upd2").val();
	var hora_entrega_upd2_2 = $("#hora_entrega_upd2_2").val();
	var id_ped_temp = $("#id_ped_temp2").text();

	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var idusuario=$("#idusuario").text();

	/*alert(fecha_entrega_upd2);
	alert(hora_entrega_upd2);
	alert(hora_entrega_upd2_2);*/
	
	$.post("ajax/diseno.php?op=set_fecha_hora_entr",{id_ped_temp:id_ped_temp,fecha_entrega_upd2:fecha_entrega_upd2,hora_entrega_upd2:hora_entrega_upd2,hora_entrega_upd2_2:hora_entrega_upd2_2,fecha_hora:fecha_hora,idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

		/*var notificator = new Notification(document.querySelector('.notification'));
		notificator.info('Dato actualizado correctamente');*/


			bootbox.alert({
			    message: "Datos de entrega actualizados correctamente.",
			    callback: function () {
			        location.reload();
			    }
			})




	});

}


function filtro_option1()
{
	$("#estatus_tabla").val("1");

	listar_pedidos();	

}

function filtro_option2()
{


	$("#estatus_tabla").val("2");

	listar_pedidos();

}

function filtro_option3()
{

	$("#estatus_tabla").val("3");

	listar_pedidos();

}

function filtro_option4()
{
	

	$("#estatus_tabla").val("4");

	listar_pedidos();

}

function filtro_option5()
{
	

	$("#estatus_tabla").val("5");

	listar_pedidos();

}

function filtro_option6()
{
	

	$("#estatus_tabla").val("6");

	listar_pedidos();

}

function filtro_option7()
{
	

	$("#estatus_tabla").val("7");

	listar_pedidos();

}

function filtro_option8()
{
	

	$("#estatus_tabla").val("8");

	listar_pedidos();

}

function filtro_option9()
{
	

	$("#estatus_tabla").val("9");

	listar_pedidos();

}


/*function cambiar_filtro_select()
{
	var option_estatus = $("#option_estatus").val();
	$("#estatus_tabla").val(option_estatus);
	listar_pedidos();
}*/

function abrir_modal_select_prod()
{
	$("#modal_productos_visual").modal("show");

	
}

function ver_modelo_3d()
{
	$("#vista_select").hide();
	$("#vista_3d").show();

	cargar_modelo();
}

function cargar_modelo()
{
	//var contador = $("#contador").text();
	var codigo =  $("#span_codigo").text();

	//alert(codigo);

	$.post("ajax/diseno.php?op=cargar_modelo&id="+codigo,function(r){
		$("#vista_3d").html(r);

			        
	});


}

function ver_imagen()
{
	$("#vista_select").show();
	$("#vista_3d").hide();
}

function abrir_rep_ped()// para generar factura
{
	
  	var id_ped_temp = $("#id_ped_temp2").text();

  	//alert(id_ped_temp);

  	//$("#enlace_pedido").attr("href","reportes/exFactura.php?variable1="+idproyecto+"&variable2="+nom_proyecto+"&variable3="+id_s_correl_1);
  	$("#enlace_pedido").attr("href","reportes/exFactura.php?id="+id_ped_temp);
}

function abrir_rep_ped2()// para reporte
{
	
  	var id_ped_temp = $("#id_ped_temp2").text();
  	var idusuario=$("#idusuario").text();
  
  	$("#enlace_pedido2").attr("href","reportes/exTicket.php?id="+id_ped_temp+"&id2="+idusuario);
}

function guardar_op(idpg_pedidos)
{
	var num_op = $("#num_op"+idpg_pedidos).val();

	//alert(num_op);

	$.post("ajax/diseno.php?op=guardar_op",{idpg_pedidos:idpg_pedidos,num_op:num_op},function(data, status)
	{
	data = JSON.parse(data);



	});
}

function llenar_box_prod(idpg_pedidos)
{
	//alert(idpg_pedidos);
	//var idpg_pedidos = id;

	$.post("ajax/diseno.php?op=llenar_box_prod&id="+idpg_pedidos,function(r){
		$("#tbl_prod_ped_box"+idpg_pedidos).html(r);


			        
	});


}

function guardar_estatus1(idpg_detped,iddetalle_pedido,idpg_pedidos)
{
	var estatus = "Existencia";
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var id_ped_temp = idpg_pedidos
	//alert(estatus);
	$.post("ajax/diseno.php?op=guardar_estatus1",{idpg_detped:idpg_detped,estatus:estatus,fecha_hora:fecha_hora,id_ped_temp:id_ped_temp},function(data, status)
	{
	data = JSON.parse(data);

		var idpg_detalle_pedidos=iddetalle_pedido;

		$.post("ajax/diseno.php?op=listar_pg_detped&id="+idpg_detalle_pedidos,function(r){
			$("#tbl_detalle_prod_tbl"+idpg_detalle_pedidos).html(r);

			bootbox.alert("Estatus guardado");
			mostrar_det_ped();	        
		});

		
	});
}

function guardar_estatus2(idpg_detped,iddetalle_pedido,idpg_pedidos)
{
	var estatus = "Apartado";
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var id_ped_temp = idpg_pedidos
	//alert(estatus);
	$.post("ajax/diseno.php?op=guardar_estatus1",{idpg_detped:idpg_detped,estatus:estatus,fecha_hora:fecha_hora,id_ped_temp:id_ped_temp},function(data, status)
	{
	data = JSON.parse(data);
		

		var idpg_detalle_pedidos=iddetalle_pedido;

		$.post("ajax/diseno.php?op=listar_pg_detped&id="+idpg_detalle_pedidos,function(r){
			$("#tbl_detalle_prod_tbl"+idpg_detalle_pedidos).html(r);

			bootbox.alert("Estatus guardado");
			mostrar_det_ped();	        
		});

	});
}

function guardar_estatus3(idpg_detped,iddetalle_pedido,idpg_pedidos)
{
	var estatus = "Produccion";
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var id_ped_temp = idpg_pedidos

	$.post("ajax/diseno.php?op=guardar_estatus1",{idpg_detped:idpg_detped,estatus:estatus,fecha_hora:fecha_hora,id_ped_temp:id_ped_temp},function(data, status)
	{
	data = JSON.parse(data);
		

		var idpg_detalle_pedidos=iddetalle_pedido;

		$.post("ajax/diseno.php?op=listar_pg_detped&id="+idpg_detalle_pedidos,function(r){
			$("#tbl_detalle_prod_tbl"+idpg_detalle_pedidos).html(r);

			bootbox.alert("Estatus guardado");
			mostrar_det_ped();	        
		});


	});
}

/*function guardar_estatus4(idpg_detped)
{
	var estatus = "Fabricado";
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	$.post("ajax/diseno.php?op=guardar_estatus1",{idpg_detped:idpg_detped,estatus:estatus,fecha_hora:fecha_hora},function(data, status)
	{
	data = JSON.parse(data);
		bootbox.alert("Estatus guardado");
		mostrar_det_ped();
	});
}*/

function guardar_estatus5(idpg_detped,iddetalle_pedido,idpg_pedidos)
{
	var estatus = "Otro";
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	var id_ped_temp = idpg_pedidos

	$.post("ajax/diseno.php?op=guardar_estatus1",{idpg_detped:idpg_detped,estatus:estatus,fecha_hora:fecha_hora,id_ped_temp:id_ped_temp},function(data, status)
	{
	data = JSON.parse(data);
		

		var idpg_detalle_pedidos=iddetalle_pedido;

		$.post("ajax/diseno.php?op=listar_pg_detped&id="+idpg_detalle_pedidos,function(r){
			$("#tbl_detalle_prod_tbl"+idpg_detalle_pedidos).html(r);

			bootbox.alert("Estatus guardado");
			mostrar_det_ped();	        
		});

		
	});
}

function guardar_op_prod(idpg_detalle_pedidos)
{
	var op = $("#op_prod_ped"+idpg_detalle_pedidos).val();

	$.post("ajax/diseno.php?op=guardar_op_prod",{idpg_detalle_pedidos:idpg_detalle_pedidos,op:op},function(data, status)
	{
	data = JSON.parse(data);
		//bootbox.alert("Numero de OP guardado");
	});
}

function cambiar_vista()
{
	$("#select_product_area").hide();
	$("#select_product_area2").show();
	$("#btn_vista1").hide();
	$("#btn_vista2").show();
}

function cambiar_vista2()
{
	$("#select_product_area").show();
	$("#select_product_area2").hide();
	$("#btn_vista1").show();
	$("#btn_vista2").hide();
}


function ver_seguimiento_prod()
{
	//$("#ver_seguimiento_prod").modal("show");
	$("#modal_seguimiento_prod").modal("show");
	listar_seguim_prod();
}

function ver_seguimiento_prod2()
{
	//$("#ver_seguimiento_prod").modal("show");
	$("#modal_seguimiento_prod2").modal("show");
	listar_seguim_prod2();
}

/*function listar_seguim_prod()
{
	var valor_filtro=1;
	$.post("ajax/diseno.php?op=listar_seguim_prod&id="+valor_filtro,function(r){
		$("#tbl_seguim_prod").html(r);

		$("#num_filtro").val("1");

		$("#enlace_op").hide();				        
	});
}*/

function filtro_seg1()
{
	

		$("#num_filtro").val("1");
		listar_seguim_prod();
		
}

function filtro_seg2()
{
	

		$("#num_filtro").val("2");
		listar_seguim_prod();
}

function filtro_seg3()
{
	

		$("#num_filtro").val("3");
		listar_seguim_prod();
		
}



function ordenar_seg1()
{
	$("#num_orden").val("1");
	listar_seguim_prod();
}

function ordenar_seg2()
{
	$("#num_orden").val("2");
	listar_seguim_prod();
}



function listar_seguim_prod()
{
	

	//alert(num_orden);
	//alert("entra");

	$.post("ajax/diseno.php?op=listar_prod_fab",function(r){
		$("#tbl_prod_fab").html(r);	

	});

	var num_orden = $("#num_orden").val();
	var valor_filtro = 3;
	
	$.post("ajax/diseno.php?op=listar_seguim_prod&id="+valor_filtro+"&id2="+num_orden,function(r){
		$("#tbl_seguim_prod").html(r);

		//$("#num_filtro").val("1");

		
		$("#label_crear_op").show();	

	});


	
}


function listar_seguim_buscar()
{	
	var no_op_buscar = $("#no_op_buscar").val();
	
	$.post("ajax/diseno.php?op=listar_seguim_buscar&id="+no_op_buscar,function(r){
		$("#tbl_seguim_prod").html(r);

		//$("#num_filtro").val("1");

			
		$("#label_crear_op").hide();				        
	});

	$.post("ajax/diseno.php?op=listar_prod_fab_buscar&id="+no_op_buscar,function(r){
		$("#tbl_prod_fab").html(r);
				        
	});

}




function listar_seguim_prod2()
{

	$.post("ajax/diseno.php?op=listar_seguim_prod2",function(r){
		$("#tbl_seguim_prod2").html(r);

			        
	});


}






function dividir_prod_ped(id)
{
	var idpg_detalle_pedidos = id;
	$.post("ajax/diseno.php?op=dividir_prod_ped",{idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
	{
	data = JSON.parse(data);
		//alert("agregado");


			$.post("ajax/diseno.php?op=listar_pg_detped&id="+idpg_detalle_pedidos,function(r){
				$("#tbl_detalle_prod_tbl"+idpg_detalle_pedidos).html(r);

					        
			});
	});
}

function mostrar_det_ped(idpg_detalle_pedidos)
{
			$.post("ajax/diseno.php?op=listar_pg_detped&id="+idpg_detalle_pedidos,function(r){
				$("#tbl_detalle_prod_tbl"+idpg_detalle_pedidos).html(r);

					        
			});
}


function guardar_cant_prod(idpg_detped)
{
	//alert(idpg_detped);
	var cant = $("#cant_prod_seg"+idpg_detped).val();

	$.post("ajax/diseno.php?op=guardar_cant_prod",{idpg_detped:idpg_detped,cant:cant},function(data, status)
	{
	data = JSON.parse(data);
		//bootbox.alert("Numero de OP guardado");
		//alert("guardado");
	});
}


function guardar_observ_prod_enl(idpg_detped)
{
	//alert(idpg_detped);
	var obs_enl = $("#obs_prod_seg"+idpg_detped).val();

	$.post("ajax/diseno.php?op=guardar_observ_prod_enl",{idpg_detped:idpg_detped,obs_enl:obs_enl},function(data, status)
	{
	data = JSON.parse(data);
		//bootbox.alert("Numero de OP guardado");
		//alert("guardado");
	});
}


function save_op_prod(idpg_detped)
{
	var op = $("#op_prod_seg"+idpg_detped).val();

	$.post("ajax/diseno.php?op=save_op_prod",{idpg_detped:idpg_detped,op:op},function(data, status)
	{
	data = JSON.parse(data);
		//bootbox.alert("Numero de OP guardado");
		//alert("guardado");
	});
}

function borrar_det_ped(idpg_detped,iddetalle_pedido)
{

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

									$.post("ajax/diseno.php?op=listar_pg_detped&id="+idpg_detalle_pedidos,function(r){
										$("#tbl_detalle_prod_tbl"+idpg_detalle_pedidos).html(r);

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


function guardar_estatus_prod1(idpg_detped)
{
	var idusuario=$("#idusuario").text();

	if (idusuario==8 || idusuario==1) {

		var estatus = "Producción";

		var fecha=moment().format('YYYY-MM-DD');
		var hora=moment().format('HH:mm:ss');
		var fecha_hora=fecha+" "+hora;

		$.post("ajax/diseno.php?op=guardar_estatus_prod",{idpg_detped:idpg_detped,estatus:estatus,fecha_hora:fecha_hora},function(data, status)
		{
		data = JSON.parse(data);
			bootbox.alert("Estatus actualizado");
			//listar_seguim_prod();
			//alert("guardado");
		});

	}else{
		bootbox.alert("Lo sentimos, no tiene permisos para realizar esta acción");
	}

		


}

function guardar_estatus_prod2(idpg_detped)
{

	$("#modal_lote").modal("show");
	$("#idpg_detped").val(idpg_detped);

		
}


function guardar_estatus_prod()
{

	var lote=$("#lote").val();

	if (lote!="") {

		var idusuario=$("#idusuario").text();
		var idpg_detped=$("#idpg_detped").val();
		

		if (idusuario==8 || idusuario==1 || (idusuario>=15 && idusuario<=17)) {

			var estatus = "Fabricado";

			var fecha=moment().format('YYYY-MM-DD');
			var hora=moment().format('HH:mm:ss');
			var fecha_hora=fecha+" "+hora;

			$.post("ajax/diseno.php?op=guardar_estatus_prod2",{idpg_detped:idpg_detped,estatus:estatus,fecha_hora:fecha_hora,lote:lote},function(data, status)
			{
			data = JSON.parse(data);
				

					$.post("ajax/diseno.php?op=obtener_idpedido",{idpg_detped:idpg_detped},function(data, status)
					{
					data = JSON.parse(data);

					 var idpedido = data.idpg_pedidos;
					 var iddetalle_pedido_avance = data.idpg_detalle_pedidos;

					 //$("#iddetalle_pedido").val(iddetalle_pedido);
					 
					 		$.post("ajax/diseno.php?op=contar_prod_ped",{idpedido:idpedido},function(data, status)
							{
							data = JSON.parse(data);

								//alert(data.num_prod);

								var num_prod = data.num_prod;

									$.post("ajax/diseno.php?op=contar_prod_apar",{idpedido:idpedido},function(data, status)
									{
									data = JSON.parse(data);

										var num_prod_apart = data.num_prod_apart;

										if (num_prod_apart==null) {
											num_prod_apart=0;
										}
										//alert(num_prod_apart+' apartado');

											$.post("ajax/diseno.php?op=contar_prod_prod",{idpedido:idpedido},function(data, status)
											{
											data = JSON.parse(data);

												var num_prod_fab = data.num_prod_fab;

												if (num_prod_fab==null) {
													num_prod_fab=0;
												}
												




														$.post("ajax/diseno.php?op=contar_prod_exist",{idpedido:idpedido},function(data, status)
														{
														data = JSON.parse(data);

															var num_prod_exis = data.num_prod_exis;

															if (num_prod_exis==null) {
																num_prod_exis=0;
															}




																var tot_detped = parseInt(num_prod_apart)+parseInt(num_prod_fab)+parseInt(num_prod_exis);
															
																if (tot_detped>=num_prod) {

																		var idusuario=$("#idusuario").text();
																		var fecha=moment().format('YYYY-MM-DD');
																		var hora=moment().format('HH:mm:ss');
																		var fecha_hora=fecha+" "+hora;

																		

																		//var pedido_actual = idpedido;

																		//alert(pedido_actual);

																		$.post("ajax/diseno.php?op=consul_exist_notif",{idpedido:idpedido},function(data, status)
																		{
																		data = JSON.parse(data);

																			var num_pedido = data.num_pedido;

																			if (num_pedido==0) {


																					/*alert(idpedido);
																					alert(idusuario);
																					alert(fecha_hora);*/
																				$.post("ajax/diseno.php?op=consul_estatus_pedido",{idpedido:idpedido},function(data, status)
																				{
																				data = JSON.parse(data);

																					var estatus_pedido = data.estatus_pedido;

																					alert(estatus_pedido);

																					$.post("ajax/diseno.php?op=save_notif",{idpedido:idpedido,idusuario:idusuario,fecha_hora:fecha_hora,estatus_pedido:estatus_pedido},function(data, status)
																					{
																					data = JSON.parse(data);

																									




																						var idpg_detped=$("#idpg_detped").val();

																						$.post("ajax/diseno.php?op=buscar_idopdetalleprod",{idpg_detped:idpg_detped},function(data, status)
																						{
																						data = JSON.parse(data);

																							var idop_detalle_prod_avance = data.idop_detalle_prod;
																							var idpedido_avnace=idpedido;

																							$.post("ajax/diseno.php?op=buscar_area",{idusuario:idusuario},function(data, status)
																							{
																							data = JSON.parse(data);

																									//var area_avance = data.area;
																									//var idpedido_avnace=idpedido;
																									var area_num = data.area;
																									var pedido= idpedido;

																									$.post("ajax/diseno.php?op=contar_productos",{pedido:pedido},function(data, status)
																									{
																									data = JSON.parse(data);

																										var avance = data.cantidad_product;


																										var idop_detalle_prod=idop_detalle_prod_avance;
																										//var avance = num_prod_exis;
																										//var pedido= idpedido;
																										
																										var idpg_detalle_pedidos = iddetalle_pedido_avance;

																										/*alert(idop_detalle_prod);
																										alert(avance);
																										alert(pedido);
																										alert(area_num);
																										alert(idpg_detalle_pedidos);*/

																										$.post("ajax/op.php?op=guardar_avance_prod",{idop_detalle_prod:idop_detalle_prod,avance:avance,fecha_hora:fecha_hora,area_num:area_num,pedido:pedido,idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
																										{
																										data = JSON.parse(data);

																											bootbox.alert("pedido completado");
																											bootbox.alert("Estatus actualizado");
																											$("#lote").val("");
																											$("#idpg_detped").val("");
																											$("#modal_lote").modal("hide");
																											listar_seguim_prod();



																										});


																									});


																										



																							});




																						});


																									



																					});


																				});


																					

																				
																			}else{

																					
																											bootbox.alert("pedido completado");
																											bootbox.alert("Estatus actualizado");
																											$("#lote").val("");
																											$("#idpg_detped").val("");
																											$("#modal_lote").modal("hide");
																											listar_seguim_prod();
																			}

																		});



																			

																	
																}else{
																			bootbox.alert("Estatus actualizado");
																			$("#lote").val("");
																			$("#idpg_detped").val("");
																			$("#modal_lote").modal("hide");
																			listar_seguim_prod();
																}
																//listar_seguim_prod();




														});


																
											});

									});

							});

					});

			});

		}else{
			bootbox.alert("Lo sentimos, no tiene permisos para realizar esta acción");
		}

	}else{
		bootbox.alert("Es necesario capturar el numero de lote");
	}


		

}


function guardar_op_seguim(idpg_detped)
{
	var op = $("#op_prod_seguim"+idpg_detped).val();

	$.post("ajax/diseno.php?op=guardar_op_seguim",{idpg_detped:idpg_detped,op:op},function(data, status)
	{
	data = JSON.parse(data);
		//bootbox.alert("Estatus actualizado");
		//alert("guardado");
	});
}


function llenar_productos_det(idpg_pedidos)
{
	$.post("ajax/diseno.php?op=llenar_box_prod&id="+idpg_pedidos,function(r){
	$("#tbl_productos2"+idpg_pedidos).html(r);

			        
	});

}

function ver_observ_prod()
{
	var id_ped_temp2 = $("#id_ped_temp2").text();

	$.post("ajax/diseno.php?op=ver_observ_prod&id="+id_ped_temp2,function(r){
	$("#tbl_obser_prod").html(r);


	});

}

function update_observ_prod(idpg_detalle_pedidos,idpg_pedidos,codigo)
{
	var obser_prod_det = $("#obser_prod_det"+idpg_detalle_pedidos).val();
	var observ = $("#observ").val();
	var contador_obser = $("#contador_obser").val();

	contador_obser=parseInt(contador_obser)+1;
	$("#contador_obser").val(contador_obser);	

	$.post("ajax/diseno.php?op=update_observ_prod",{idpg_detalle_pedidos:idpg_detalle_pedidos,obser_prod_det:obser_prod_det},function(data, status)
	{
	data = JSON.parse(data);

		$.post("ajax/diseno.php?op=cont_observ_det",{idpg_pedidos:idpg_pedidos},function(data, status)
		{
		data = JSON.parse(data);

				$("#num_observ").text(data.num_observ);
				var contador_obser = $("#contador_obser").val();

				if (data.num_observ>0 && contador_obser==1) {

					if (obser_prod_det!="") {
						$("#observ").val(observ+" "+"_");





								var id_ped_temp = $("#id_ped_temp2").text();
								var idusuario=$("#idusuario").text();
								var fecha=moment().format('YYYY-MM-DD');
								var hora=moment().format('HH:mm:ss');
								var fecha_hora=fecha+" "+hora;
								//var observ = $("#observ").val();
								//alert(observ);
								//alert(codigo);
								
								var text_set = "Observación de producto editado. Código: "+codigo+" Observación: "+obser_prod_det;

								$.post("ajax/diseno.php?op=save_hist",{id_ped_temp:id_ped_temp,idusuario:idusuario,fecha_hora:fecha_hora,text_set:text_set},function(data, status)
								{
								data = JSON.parse(data);

										//alert("g");
								});



						update_observ();
					}
				}
				

					
		});
		
	});
}


function ver_observ_gen(idpg_pedidos)
{
	//alert(idpg_pedidos);
	$.post("ajax/diseno.php?op=ver_observ_gen",{idpg_pedidos:idpg_pedidos},function(data, status)
	{
	data = JSON.parse(data);

		//bootbox.alert(data.observaciones);

		$("#modal_observ_ped").modal("show");
		$("#control_pedid_boot").text("CONTROL: "+data.no_control);
		$("#observ_pedid_boot").text(data.observaciones);
		$("#detform_pedid_boot").text(data.det_forma_entrega);
		
	});




}

function ver_documentos_ped(idpg_pedidos)
{

		$("#modal_doc_ped").modal("show");

		$.post("ajax/diseno.php?op=abrir_doc_ped&id="+idpg_pedidos,function(r){
		$("#tbl_doc_ped").html(r);


				

		});
}



function save_hist_observg()
{
			var id_ped_temp = $("#id_ped_temp2").text();
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
			});
}


function save_hist_iva()
{
			var id_ped_temp = $("#id_ped_temp").val();
			var idusuario=$("#idusuario").text();
			var fecha=moment().format('YYYY-MM-DD');
			var hora=moment().format('HH:mm:ss');
			var fecha_hora=fecha+" "+hora;
			var aplic_iva = $("#aplic_iva").val();
			var text_set = "Ajuste en el cálculo de IVA, valor: "+aplic_iva;


			$.post("ajax/diseno.php?op=save_hist",{id_ped_temp:id_ped_temp,idusuario:idusuario,fecha_hora:fecha_hora,text_set:text_set},function(data, status)
			{
			data = JSON.parse(data);

					//alert("g");
			});

			/*alert(aplic_iva);
			alert(id_ped_temp);*/

			$.post("ajax/diseno.php?op=save_hist_iva",{id_ped_temp:id_ped_temp,aplic_iva:aplic_iva},function(data, status)
			{
			data = JSON.parse(data);

					//alert("g");
			});
}


function listar_historial()
{
	var id_ped_temp = $("#id_ped_temp2").text();

	$("#modal_historial").modal("show");

	$.post("ajax/diseno.php?op=listar_historial&id="+id_ped_temp,function(r){
	$("#datatable_historial").html(r);

			        
	});

}


function marcar_color(idpg_detped,op)
{

	//alert(op);

	if (op=="") {

		var back = document.getElementById('tr'+idpg_detped);
		var color = back.style.backgroundColor;

		//alert(color);

		if (color=="" || color=="rgb(255, 255, 255)") {
			back.style.backgroundColor = "rgb(162, 202, 223)";
			var val_select = 1;
		}
		if (color=="rgb(162, 202, 223)") {
			back.style.backgroundColor = "rgb(255, 255, 255)";
			var val_select = 0;
		}

		$.post("ajax/op.php?op=select_op",{idpg_detped:idpg_detped,val_select:val_select},function(data, status)
		{
			data = JSON.parse(data);

		});
	}

		
	


				/*if (color=="") {
				back.style.backgroundColor = "rgb(162,202,223)";

						var iddet_ped_op = $("#iddet_ped_op"+idpg_detped).val();

						if (iddet_ped_op=="") 
						{

											$.post("ajax/op.php?op=consul_prod",{id_detped:id_detped},function(data, status)
											{
												data = JSON.parse(data);

												var no_control = data.no_control;
												//alert(no_control);
												var codigo = data.codigo;
												var producto = data.descripcion;
												var empaque = data.empaque;
												var cantidad = data.cantidad;
												var fecha_inicio = data.fecha_pedido;
												var fecha_term = data.fecha_entrega;
												var observaciones = data.observacion;

												var medida = data.medida;
												var color = data.color;
												var iddetalle_pedido = data.iddetalle_pedido;

												$.post("ajax/op.php?op=guadar_op_det",{
													idop:idop,
													id_detped:id_detped,
													no_control:no_control,
													codigo:codigo,
													producto:producto,
													empaque:empaque,
													cantidad:cantidad,
													fecha_inicio:fecha_inicio,
													fecha_term:fecha_term,
													observaciones:observaciones,
													medida:medida,
													color:color,
													iddetalle_pedido:iddetalle_pedido
												},function(data, status)
												{
													data = JSON.parse(data);

													$("#iddet_ped_op"+idpg_detped).val(data.idop_detalle_prod);
													consul_op_detalle_prod();

												});


											});


						}

				}else{
					back.style.backgroundColor = "";

					var iddet_ped_op = $("#iddet_ped_op"+idpg_detped).val();
				alert(iddet_ped_op);

					$.post("ajax/diseno.php?op=borrar_op_det",{idpg_detped:idpg_detped,iddet_ped_op:iddet_ped_op},function(data, status)
					{
					data = JSON.parse(data);

						$("#iddet_ped_op"+idpg_detped).val("");
						consul_op_detalle_prod();

					});


				}*/




}

function abrir_ventana_confirm_op()
{
	

	$("#enlace_op").hide();
	$("#idcrear_op").show();
	$("#idop_confirm").val("");

	$.post("ajax/op.php?op=listar_prod_confirm_op",function(r){
	$("#box_prod_op_confirm").html(r);


		$.post("ajax/op.php?op=consul_seleccion",function(data, status)
		{
		data = JSON.parse(data);

			var cant_select = data.cant_select;
			//alert(cant_select);

			if (cant_select>0) {

				$("#modal_confirm_prod_op").modal("show");
			}


		});

			        
	});


}

function quitar_prod_confirm(idpg_detped)
{

	$.post("ajax/op.php?op=consul_select_op",{idpg_detped:idpg_detped},function(data, status)
	{
	data = JSON.parse(data);

	 var select_op = data.select_op;

	 //alert(select_op);

	 if (select_op>0) {


	 	$.post("ajax/op.php?op=quitar_prod_confirm",{idpg_detped:idpg_detped},function(data, status)
		{
			data = JSON.parse(data);


			$.post("ajax/op.php?op=listar_prod_confirm_op",function(r){
			$("#box_prod_op_confirm").html(r);

				listar_seguim_prod();


				$.post("ajax/op.php?op=consul_seleccion",function(data, status)
				{
				data = JSON.parse(data);

					var cant_select = data.cant_select;
					//alert(cant_select);

					if (cant_select==0) {

						$("#idcrear_op").hide();
					}


				});

					        
			});

		});

	 }else{
	 	bootbox.alert("No se puede quitar porque la op ya está creada");
	 }


	});
	

		
	
		
}


function crear_op_confirm()
{
//alert("entra");
	$.post("ajax/op.php?op=contar_ops",function(data, status)
	{
		data = JSON.parse(data);

		//alert(data.ult_op);

			var ult_op = data.ult_op;
			var nueva_op = parseInt(ult_op)+1;

			//alert(nueva_op);


			var fecha=moment().format('YYYY-MM-DD');
			var hora=moment().format('HH:mm:ss');
			var fecha_hora=fecha+" "+hora;



			$.post("ajax/op.php?op=registrar_op",{nueva_op:nueva_op,fecha_hora:fecha_hora},function(data, status)
			{
			data = JSON.parse(data);

				//alert(data.idop);

				var idop= data.idop;

				$("#idop_confirm").val(idop);

				if (idop>0) {

					$.post("ajax/op.php?op=crear_op_confirm&idop="+idop,function(r){
					$("#proccess1").html(r);

						$.post("ajax/op.php?op=validar_creacion_op",{idop:idop},function(data, status)
						{
						data = JSON.parse(data);

							var cant_op = data.cant_op;


							$.post("ajax/op.php?op=validar_creacion_op2",{idop:idop},function(data, status)
							{
							data = JSON.parse(data);

								var cant_idop = data.cant_idop;

								//alert(cant_op);
								//alert(cant_idop);

								//if (cant_op>0 && cant_idop>0) {


									//if (cant_op == cant_idop) {

										bootbox.alert("Orden de Producción creada correctamente");

										$("#enlace_op").show();
										$("#idcrear_op").hide();
										


										listar_seguim_prod();

									/*}else{
										bootbox.alert("No se pudo crear OP, por favor vuelva a intentarlo");

										$.post("ajax/op.php?op=borrar_op",{idop:idop},function(data, status)
										{
										data = JSON.parse(data);

											listar_seguim_prod();

										});
									}*/
								/*}else{


										bootbox.alert("No se pudo crear OP, por favor vuelva a intentarlo");

										$.post("ajax/op.php?op=borrar_op",{idop:idop},function(data, status)
										{
										data = JSON.parse(data);

											listar_seguim_prod();

										});

								}*/


									


							});


						});


								
								        
						

							       
					});
				}else{
					bootbox.alert("Error al registrar OP");
				}

					

			});
		

			






			



	});


		
}




function marcar_color2(idpg_detped)
{
	var check_op = document.getElementById("check_op").checked;
	var idop = $("#idop").val();
	var id_detped = idpg_detped;

	$.post("ajax/diseno.php?op=consul_op",{idpg_detped:idpg_detped},function(data, status)
	{
		data = JSON.parse(data);

		var id_op_seg = data.op;

		alert(id_op_seg);

		if (id_op_seg>0) {

		}else{

			if (check_op==true) {
				var back = document.getElementById('tr'+idpg_detped);
				var color = back.style.backgroundColor;

				if (color=="") {
				back.style.backgroundColor = "rgb(162,202,223)";

						var iddet_ped_op = $("#iddet_ped_op"+idpg_detped).val();

						if (iddet_ped_op=="") 
						{

											$.post("ajax/op.php?op=consul_prod",{id_detped:id_detped},function(data, status)
											{
												data = JSON.parse(data);

												var no_control = data.no_control;
												//alert(no_control);
												var codigo = data.codigo;
												var producto = data.descripcion;
												var empaque = data.empaque;
												var cantidad = data.cantidad;
												var fecha_inicio = data.fecha_pedido;
												var fecha_term = data.fecha_entrega;
												var observaciones = data.observacion;

												var medida = data.medida;
												var color = data.color;
												var iddetalle_pedido = data.iddetalle_pedido;

												$.post("ajax/op.php?op=guadar_op_det",{
													idop:idop,
													id_detped:id_detped,
													no_control:no_control,
													codigo:codigo,
													producto:producto,
													empaque:empaque,
													cantidad:cantidad,
													fecha_inicio:fecha_inicio,
													fecha_term:fecha_term,
													observaciones:observaciones,
													medida:medida,
													color:color,
													iddetalle_pedido:iddetalle_pedido
												},function(data, status)
												{
													data = JSON.parse(data);

													$("#iddet_ped_op"+idpg_detped).val(data.idop_detalle_prod);
													consul_op_detalle_prod();

												});


											});


						}

				}else{
					back.style.backgroundColor = "";

					var iddet_ped_op = $("#iddet_ped_op"+idpg_detped).val();
				alert(iddet_ped_op);

					$.post("ajax/diseno.php?op=borrar_op_det",{idpg_detped:idpg_detped,iddet_ped_op:iddet_ped_op},function(data, status)
					{
					data = JSON.parse(data);

						$("#iddet_ped_op"+idpg_detped).val("");
						consul_op_detalle_prod();

					});


				}
			}
			
		}



	});

		
			
}

function crear_op()
{
	var idusuario=$("#idusuario").text();

	if (idusuario==8 || idusuario==1) {

		var check_op = document.getElementById("check_op").checked;
		//alert(check_op);

		if (check_op==true) {


			$.post("ajax/op.php?op=ult_op",function(data, status)
			{
				data = JSON.parse(data);


						if (data!=null) {
					
							var ultimo_op = data.no_op;

						}else{
							var ultimo_op = 0;
						}

						var ultimo_op = parseInt(ultimo_op)+1;

						//alert(ultimo_op);

						$.post("ajax/diseno.php?op=guardar_op_fab",{ultimo_op:ultimo_op},function(data, status)
						{
						data = JSON.parse(data);

							$("#idop").val(data.idop);

							consul_op_detalle_prod();

							//		
						});


			});


		}else{
			//$("#enlace_op").hide();
		}

	}else{
		bootbox.alert("Lo sentimos, no tiene permisos para realizar esta acción");
		document.getElementById("check_op").checked=false;
	}
	
		
}


function consul_op_detalle_prod()
{
	var idop = $("#idop").val();

	$.post("ajax/diseno.php?op=consul_op_detalle_prod",{idop:idop},function(data, status)
	{
	data = JSON.parse(data);

		var num_exist = data.num_exist;

		if (num_exist>0) {
			//$("#enlace_op").show();
		}else{
			//$("#enlace_op").hide();
		}

	});

}

function abrir_op()
{
	var idop = $("#idop").val();
	$("#enlace_op").attr("href","op.php?detpedido="+idop); 
}

function abrir_op_confirm()
{
	var idop = $("#idop_confirm").val();
	$("#enlace_op").attr("href","op.php?detpedido="+idop); 
}


function abrir_terminados()
{
	$("#modal_terminados").modal("show");
	$("#modal_doc_ped").modal("hide");

	listar_terminados();

	/*$.post("ajax/diseno.php?op=listar_salidas",function(r){
	$("#box_salidas").html(r);		        
	});*/
	
}

function listar_terminados()
{
	//var variable = 1;

	$.post("ajax/diseno.php?op=abrir_terminados",function(r){
	$("#tbl_terminados").html(r);

			        
	});
}


function cargar_notif()
{
	console.log("Entra a cargar_notif en diseno");
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
}


function abrir_listos()
{
	$("#modal_listos").modal("show");
	$("#modal_doc_ped").modal("hide");
	listar_listos();
	
}

function listar_listos()
{
	var lugar_user = $("#lugar_user").text();

	$.post("ajax/diseno.php?op=listar_listos&id="+lugar_user,function(r){
	$("#tbl_listos").html(r);

			        
	});
}


function cargar_notif_part()
{
	console.log("Entra a cargar_notif_part en diseno");
	var idusuario=$("#idusuario").text();

	$.post("ajax/diseno.php?op=consul_lugar",{idusuario:idusuario},function(data, status)
	{
	data = JSON.parse(data);

			//var lugar = data.lugar;
			

			var lugar_user=data.lugar;
			$("#lugar_user").text(lugar_user);
			//alert(lugar_user);

			$.post("ajax/diseno.php?op=cargar_notif_part",{lugar_user:lugar_user},function(data, status)
			{
			data = JSON.parse(data);

				var num_notif = data.num_notif;

				//alert(num_notif);

				if (num_notif>0) {

					

					$("#num_notif_ped").text(num_notif);
				}

				

			});

	});




			
}


function mostrar_result_cli()
{
	$("#result_cli").show();

	var cliente_buscar = $("#cliente_buscar").val();
	//var lugar_user = $("#lugar_user").text();

	/*$.post("ajax/diseno.php?op=buscar_texto_tbl&id="+text_buscar+"&lugar_user="+lugar_user,function(r){
	        $("#datatable").html(r);*/

	$.post("ajax/diseno.php?op=buscar_cliente_tbl&id="+cliente_buscar,function(r){
	        $("#box_select_cliente").html(r);

	       
	});
}

function marcar_cliente(idcliente,nombre)
{
	$("#cliente_buscar").val(nombre);
	$("#idcliente_buscar").val(idcliente);
	$("#result_cli").hide();
}


function cambiar_buscar()
{
	var contador = $("#contador_vista_buscar").val();

	if (contador==1) {

		$("#contador_vista_buscar").val("2");
		$("#cliente_buscar").show();
		$("#idcliente_buscar").show();
		$("#btn_buscar_cli").show();

		$("#no_control_buscar").hide();
		$("#btn_buscar_control").hide();
	}

	if (contador==2) {

		$("#contador_vista_buscar").val("1");
		$("#cliente_buscar").hide();
		$("#idcliente_buscar").hide();
		$("#btn_buscar_cli").hide();

		$("#no_control_buscar").show();
		$("#btn_buscar_control").show();
	}
}


function pedidos_atencion()
{

	$("#modal_pedidos_atencion").modal("show");

	$.post("ajax/diseno.php?op=listar_sin_estatus",function(r){
	        $("#tbl_pedidos_pendientes").html(r);

	       contar_prod_sinrev();

	});

}


function contar_prod_sinrev()
{
			$.post("ajax/diseno.php?op=contar_prod_sinrev",function(data, status)
			{
			data = JSON.parse(data);

			if (data.num_sinrev>0) {

				$("#num_notif_ped_sr").text(data.num_sinrev);
			}else{

			}
				$("#num_notif_ped_sr").text();
					
			});
}


function pedidos_vencidos()
{
	$("#modal_vencidos").modal("show");

	var dato_filtro = $("#dato_filtro").val();

	//alert(dato_filtro);
	if (dato_filtro==undefined) {
		dato_filtro=0;
	}

	$.post("ajax/diseno.php?op=pedidos_vencidos&id="+dato_filtro,function(r){
	        $("#tbl_vencidos").html(r);

	       
	});
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

				if (data.num_vencidos>0) {

					$("#num_vencidos").text(data.num_vencidos);
				}else{
					$("#num_vencidos").text("");
				}
				//contar_sin_coment_venc();
					
			});


}


function contar_sin_coment_venc()
{
			$.post("ajax/diseno.php?op=contar_sin_coment_venc",function(data, status)
			{
			data = JSON.parse(data);



				if (data.num_vencidos_sincoment>0) {

					var idusuario=$("#idusuario").text();

					if (idusuario==4 || idusuario==1) {


						function toastrs() {
						  if (!showToastrs) {
						    toastr.warning('Capturar motivos pendientes',+ data.num_vencidos_sincoment+' Pedidos sin motivo de retraso!');
						    //toastr.warning('La latencia del server esta aumentando.', 'Alerta!');
						  } 
						}
						toastrs();


						//bootbox.alert("Pedidos con retraso: Capturar motivos pendientes");
					}

					
				}
					
			});
}

function listar_filtros()
{
	listar_tipos();
	//listar_tipo2();
}

function listar_tipos()
{


	$.post("ajax/diseno.php?op=listar_tipos",function(r){
	$("#select_busqueda_tipo").html(r);


	       
	});
}

function select_tipo()
{
	$("#select_busqueda_subtipo").val("");
	$("#select_busqueda_modelo").val("");
	$("#select_busqueda_submodelo").val("");
	$("#select_busqueda_tamano").val("");
	$("#buscar_prod_fil").val("");

	listar_modelo();
	listar_subtipo();
	listar_productos_resul_tipo();


}

function select_subtipo()
{
	//$("#select_busqueda_subtipo").val("");
	$("#select_busqueda_modelo").val("");
	$("#select_busqueda_submodelo").val("");
	$("#select_busqueda_tamano").val("");
	$("#buscar_prod_fil").val("");

	listar_modelo();
	listar_productos_resul_tipo_sub();
}

function select_modelo()
{
	//$("#select_busqueda_subtipo").val("");
	//$("#select_busqueda_modelo").val("");
	$("#select_busqueda_submodelo").val("");
	$("#select_busqueda_tamano").val("");
	$("#buscar_prod_fil").val("");

	listar_tamano();
	listar_submodelo();
	listar_productos_resul_modelo();
}

function select_submodelo()
{
	//$("#select_busqueda_subtipo").val("");
	//$("#select_busqueda_modelo").val("");
	//$("#select_busqueda_submodelo").val("");
	$("#select_busqueda_tamano").val("");
	$("#buscar_prod_fil").val("");

	listar_tamano();
	listar_productos_resul_submodelo();
}

function select_tamano()
{
	listar_productos_resul();
}

function listar_subtipo()
{
	var select_busqueda_tipo = $("#select_busqueda_tipo").val();

	$.post("ajax/diseno.php?op=listar_subtipo&id="+select_busqueda_tipo,function(r){
	$("#select_busqueda_subtipo").html(r);
		
	       
	});
}

function listar_modelo()
{
	var select_busqueda_tipo = $("#select_busqueda_tipo").val();
	var select_busqueda_subtipo = $("#select_busqueda_subtipo").val();

	//alert(select_busqueda_subtipo);

	if (select_busqueda_subtipo==null || select_busqueda_subtipo=="") {

		$.post("ajax/diseno.php?op=listar_modelo&id="+select_busqueda_tipo,function(r){
		$("#select_busqueda_modelo").html(r);	
	        
		});
	}else{
		$.post("ajax/diseno.php?op=listar_modelo2&id="+select_busqueda_tipo+"&id2="+select_busqueda_subtipo,function(r){
		$("#select_busqueda_modelo").html(r);
				       
		});
	}
		
}

function listar_submodelo()
{
	var select_busqueda_tipo = $("#select_busqueda_tipo").val();
	var select_busqueda_subtipo = $("#select_busqueda_subtipo").val();
	var select_busqueda_modelo = $("#select_busqueda_modelo").val();

	if (select_busqueda_subtipo==null || select_busqueda_subtipo=="") {

		$.post("ajax/diseno.php?op=listar_submodelo&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo,function(r){
		$("#select_busqueda_submodelo").html(r);
			
		       
		});
	}else{

		$.post("ajax/diseno.php?op=listar_submodelo2&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_subtipo,function(r){
		$("#select_busqueda_submodelo").html(r);
			
		       
		});
	}

		
}





function listar_tamano()
{
	var select_busqueda_tipo = $("#select_busqueda_tipo").val();
	var select_busqueda_subtipo = $("#select_busqueda_subtipo").val();
	var select_busqueda_modelo = $("#select_busqueda_modelo").val();
	var select_busqueda_submodelo = $("#select_busqueda_submodelo").val();

	if (select_busqueda_subtipo==null || select_busqueda_subtipo=="") {


		if (select_busqueda_submodelo==null || select_busqueda_submodelo=="") {

			$.post("ajax/diseno.php?op=listar_tamano&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo,function(r){
			$("#select_busqueda_tamano").html(r);
			       
			});
		}else{

			$.post("ajax/diseno.php?op=listar_tamano3&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_submodelo,function(r){
			$("#select_busqueda_tamano").html(r);
			       
			});
		}




			
	}else{


		if (select_busqueda_submodelo==null || select_busqueda_submodelo=="") {

			$.post("ajax/diseno.php?op=listar_tamano2&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_subtipo,function(r){
			$("#select_busqueda_tamano").html(r);
			       
			});

		}else{

			$.post("ajax/diseno.php?op=listar_tamano4&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_subtipo+"&id4="+select_busqueda_submodelo,function(r){
			$("#select_busqueda_tamano").html(r);
			       
			});
		}



			

	}

		
}

function listar_productos_resul_tipo()
{
	var select_busqueda_tipo = $("#select_busqueda_tipo").val();

	$.post("ajax/diseno.php?op=listar_productos_resul_tipo&id="+select_busqueda_tipo,function(r){
	$("#tbl_result_prod").html(r);
	       
	});
}

function listar_productos_resul_tipo_sub()
{
	var select_busqueda_tipo = $("#select_busqueda_tipo").val();
	var select_busqueda_subtipo = $("#select_busqueda_subtipo").val();

	/*alert(select_busqueda_tipo);
	alert(select_busqueda_subtipo);*/

	$.post("ajax/diseno.php?op=listar_productos_resul_tipo_sub&id="+select_busqueda_tipo+"&id2="+select_busqueda_subtipo,function(r){
	$("#tbl_result_prod").html(r);

		
	       
	});
}

function listar_productos_resul_modelo()
{
	var select_busqueda_tipo = $("#select_busqueda_tipo").val();
	var select_busqueda_subtipo = $("#select_busqueda_subtipo").val();
	var select_busqueda_modelo = $("#select_busqueda_modelo").val();

	//alert(select_busqueda_subtipo);

	if (select_busqueda_subtipo==null || select_busqueda_subtipo=="") {

		$.post("ajax/diseno.php?op=listar_productos_resul_modelo&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo,function(r){
		$("#tbl_result_prod").html(r);
		       
		});

	}else{

		$.post("ajax/diseno.php?op=listar_productos_resul_modelo2&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_subtipo,function(r){
		$("#tbl_result_prod").html(r);
		       
		});

	}

		
}

function listar_productos_resul_submodelo()
{
	var select_busqueda_tipo = $("#select_busqueda_tipo").val();
	var select_busqueda_subtipo = $("#select_busqueda_subtipo").val();
	var select_busqueda_modelo = $("#select_busqueda_modelo").val();
	var select_busqueda_submodelo = $("#select_busqueda_submodelo").val();


	if (select_busqueda_subtipo==null || select_busqueda_subtipo=="") {


		$.post("ajax/diseno.php?op=listar_productos_resul_submodelo&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_submodelo,function(r){
		$("#tbl_result_prod").html(r);
		       
		});

	}else{
		$.post("ajax/diseno.php?op=listar_productos_resul_submodelo2&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_submodelo+"&id4="+select_busqueda_subtipo,function(r){
		$("#tbl_result_prod").html(r);
		       
		});
	}
}


function listar_productos_resul()
{
	var select_busqueda_tipo = $("#select_busqueda_tipo").val();
	var select_busqueda_subtipo = $("#select_busqueda_subtipo").val();
	var select_busqueda_modelo = $("#select_busqueda_modelo").val();
	var select_busqueda_submodelo = $("#select_busqueda_submodelo").val();
	var select_busqueda_tamano = $("#select_busqueda_tamano").val();

	/*alert(select_busqueda_tipo);
	alert(select_busqueda_modelo);
	alert(select_busqueda_tamano);*/

	if (select_busqueda_subtipo==null || select_busqueda_subtipo=="") {}

			

	if (select_busqueda_subtipo==null || select_busqueda_subtipo=="") {
		if (select_busqueda_submodelo==null || select_busqueda_submodelo=="") {

			$.post("ajax/diseno.php?op=listar_productos_resul&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_tamano,function(r){
			$("#tbl_result_prod").html(r);
			       
			});

		}else{

			$.post("ajax/diseno.php?op=listar_productos_resul2&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_tamano+"&id4="+select_busqueda_submodelo,function(r){
			$("#tbl_result_prod").html(r);
			       
			});
		}
			
	}else{

		if (select_busqueda_submodelo==null || select_busqueda_submodelo=="") {

			$.post("ajax/diseno.php?op=listar_productos_resul3&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_tamano+"&id4="+select_busqueda_subtipo,function(r){
			$("#tbl_result_prod").html(r);
			       
			});

		}else{

			$.post("ajax/diseno.php?op=listar_productos_resul4&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_tamano+"&id4="+select_busqueda_subtipo+"&id5="+select_busqueda_submodelo,function(r){
			$("#tbl_result_prod").html(r);
			       
			});
		}



			

	}


}


function listar_productos_busqueda()
{
	$("#select_busqueda_tipo").val("");
	$("#select_busqueda_subtipo").val("");
	$("#select_busqueda_modelo").val("");
	$("#select_busqueda_submodelo").val("");
	$("#select_busqueda_tamano").val("");
	//$("#buscar_prod_fil").val("");

	var buscar_prod_fil = $("#buscar_prod_fil").val();

			$.post("ajax/diseno.php?op=listar_productos_busqueda&id="+buscar_prod_fil,function(r){
			$("#tbl_result_prod").html(r);
			       
			});
}

function cargar_options_tipo_ped()
{
	var lugar_user=$("#lugar_user").text();

	if (lugar_user=="Fabrica") {
		$("#opt_exist").show();
	}else{
		$("#opt_exist").hide();
	}

}




function view_section_selectprod()
{
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var tipo_ped=$("#select_tipo_pedido").val();

	var id = $("#id_ped_temp").val();

	if (id>0) {
		//alert("entra1");

		if (tipo_ped==1) {

			$("#select_productos_button").hide();
			$("#adj_docs_lic").hide();
			$("#div_filtro_prod").show();
			$("#div_pedido").hide();

			$("#etiqueta_tipo_ped").text("Pedido Comercial");
			$("#select_tipo_pedido").hide();
			//$("#doc_req_lic").hide();
			//$("#doc_rec_mue").hide();
			
		}else{
			if (tipo_ped==2) {

				$("#select_productos_button").hide();
				$("#adj_docs_lic").show();
				$("#div_filtro_prod").show();
				$("#div_pedido").hide();

				$("#etiqueta_tipo_ped").text("Pedido de Licitación");
				$("#select_tipo_pedido").hide();
				//$("#doc_req_lic").show();
				//$("#doc_rec_mue").hide();

				$("#div_doc_orden_compra").show();
				$("#div_doc_contrato").show();
				$("#div_doc_especif").show();
			}else{
				if (tipo_ped==3) {
					$("#select_productos_button").hide();
					$("#adj_docs_lic").show();
					$("#div_filtro_prod").show();
					$("#div_pedido").hide();

					$("#etiqueta_tipo_ped").text("Pedido de Muestras");
					$("#select_tipo_pedido").hide();
					//$("#doc_req_lic").hide();
					//$("#doc_rec_mue").show();

					$("#div_doc_orden_compra").hide();
					$("#div_doc_contrato").hide();
					$("#div_doc_especif").show();

				}else{
					if (tipo_ped==4) {

						$("#select_productos_button").hide();
						$("#adj_docs_lic").hide();
						$("#div_filtro_prod").show();
						$("#div_pedido").hide();

						$("#etiqueta_tipo_ped").text("Pedido para existencias");
						$("#select_tipo_pedido").hide();
						//$("#doc_req_lic").hide();

					}


				}
			}
		}

	}else{
		//alert("entra2");
		$.post("ajax/diseno.php?op=guardar_pedido_temp",{fecha_hora:fecha_hora,tipo_ped:tipo_ped},function(data, status)
		{
			data = JSON.parse(data);

			$("#id_ped_temp").val(data.idpg_pedidos);
			$("#idpedido").val(data.idpg_pedidos);

			if (tipo_ped==1) {

				$("#select_productos_button").hide();
				$("#adj_docs_lic").hide();
				$("#div_filtro_prod").show();
				$("#div_pedido").hide();

				$("#etiqueta_tipo_ped").text("Pedido Comercial");
				$("#select_tipo_pedido").hide();
				//$("#doc_req_lic").hide();
				//$("#doc_rec_mue").hide();
				
			}else{
				if (tipo_ped==2) {

					$("#select_productos_button").hide();
					$("#adj_docs_lic").show();
					$("#div_filtro_prod").show();
					$("#div_pedido").hide();

					$("#etiqueta_tipo_ped").text("Pedido de Licitación");
					$("#select_tipo_pedido").hide();
					//$("#doc_req_lic").show();
					//$("#doc_rec_mue").hide();

					$("#div_doc_orden_compra").show();
					$("#div_doc_contrato").show();
					$("#div_doc_especif").show();
				}else{
					if (tipo_ped==3) {
						$("#select_productos_button").hide();
						$("#adj_docs_lic").show();
						$("#div_filtro_prod").show();
						$("#div_pedido").hide();

						$("#etiqueta_tipo_ped").text("Pedido de Licitación");
						$("#select_tipo_pedido").hide();
						//$("#doc_req_lic").hide();
						//$("#doc_rec_mue").show();

						$("#div_doc_orden_compra").hide();
						$("#div_doc_contrato").hide();
						$("#div_doc_especif").show();

					}else{
						if (tipo_ped==4) {

							$("#select_productos_button").hide();
							$("#adj_docs_lic").hide();
							$("#div_filtro_prod").show();
							$("#div_pedido").hide();

							$("#etiqueta_tipo_ped").text("Pedido para existencias");
							$("#select_tipo_pedido").hide();
							//$("#doc_req_lic").hide();
							
						}
					}
				}
			}
		});
	}

		
		
}


function cargar_doc_lic()
{

	var ar_comprob_lic1 = $("#ar_comprob_lic1").val();
	var ar_comprob_lic2 = $("#ar_comprob_lic2").val();
	var ar_comprob_lic3 = $("#ar_comprob_lic3").val();
	var ar_comprob_lic4 = $("#ar_comprob_lic4").val();

	var iddocumentos1 = $("#iddocumentos1").val();
	var iddocumentos2 = $("#iddocumentos2").val();
	var iddocumentos3 = $("#iddocumentos3").val();
	var iddocumentos4 = $("#iddocumentos4").val();

						if (iddocumentos1 == 0) {

							if (ar_comprob_lic1!="") {

									var parametros = new FormData($("#formulario-envia_comprobante_lic")[0]);
									$.ajax({

											data: parametros,
											url: "ajax/diseno.php?op=guardar_comprobante_lic1",
											type: "POST",
											contentType: false,
											processData: false,
											beforesend: function(){

											},
											success: function(data, status){

													data = JSON.parse(data);

													//alert(data.iddoc1);
													
													/*$("#iddocumentos1").val(data.iddoc1);
													document.getElementById('ar_comprob_lic1').disabled = true;*/
													listar_documentos_cargados_lic();													
											}
									});
							}
						}

						
						if (iddocumentos2 == 0) {

							if (ar_comprob_lic2!="") {



									var parametros = new FormData($("#formulario-envia_comprobante_lic")[0]);
									$.ajax({

											data: parametros,
											url: "ajax/diseno.php?op=guardar_comprobante_lic2",
											type: "POST",
											contentType: false,
											processData: false,
											beforesend: function(){

											},
											success: function(data, status){

													data = JSON.parse(data);

													//alert(data.iddoc2);
													
													/*$("#iddocumentos2").val(data.iddoc2);
													document.getElementById('ar_comprob_lic2').disabled = true;*/
													listar_documentos_cargados_lic();											
											}

									});


							}
						}	



						if (iddocumentos3 == 0) {

							if (ar_comprob_lic3!="") {



									var parametros = new FormData($("#formulario-envia_comprobante_lic")[0]);
									$.ajax({

											data: parametros,
											url: "ajax/diseno.php?op=guardar_comprobante_lic3",
											type: "POST",
											contentType: false,
											processData: false,
											beforesend: function(){

											},
											success: function(data, status){

													data = JSON.parse(data);

													//alert(data.iddoc3);
													
													/*$("#iddocumentos3").val(data.iddoc3);
													document.getElementById('ar_comprob_lic3').disabled = true;*/
													listar_documentos_cargados_lic();
																								
											}

									});


							}
						}

						if (iddocumentos4 == 0) {

							if (ar_comprob_lic4!="") {



									var parametros = new FormData($("#formulario-envia_comprobante_lic")[0]);
									$.ajax({

											data: parametros,
											url: "ajax/diseno.php?op=guardar_comprobante_lic4",
											type: "POST",
											contentType: false,
											processData: false,
											beforesend: function(){

											},
											success: function(data, status){

													data = JSON.parse(data);

													//alert(data.iddoc4);
													
													/*$("#iddocumentos4").val(data.iddoc4);
													document.getElementById('ar_comprob_lic4').disabled = true;*/
													listar_documentos_cargados_lic();
																								
											}

									});


							}

						}

							

							
									
}



function update_observ_lic()
{
	var idpedido = $("#id_ped_temp").val();
	var observ_lic = $("#observ_lic").val();

			$.post("ajax/diseno.php?op=update_observ_lic",{idpedido:idpedido,observ_lic:observ_lic},function(data, status)
			{
			data = JSON.parse(data);


			});
}

function listar_documentos()
{
	var idpedido = $("#id_ped_temp2").text();

			$.post("ajax/diseno.php?op=listar_documentos&id="+idpedido,function(r){
			$("#box_documentos").html(r);
			   
			});
}

function cargar_div_pro_select()
{
	//$("#signup-notification").addClass("openbefore");
	

	var div_prod = document.getElementById('signup-notification');
	div_prod.className = 'openbefore';

	$("#eti_prod_select1").show();
	$("#eti_prod_select2").hide();
}

function abrir_div_pro_select()
{
	var div_prod = document.getElementById('signup-notification');
	div_prod.className = 'open';

	//$("#signup-notification").addClass("open");
	$("#eti_prod_select1").hide();
	$("#eti_prod_select2").show();
}


function ocultar_div_pro_select()
{
	var div_prod = document.getElementById('signup-notification');
	div_prod.className = 'openbefore';

	//$("#signup-notification").addClass("openafter");

	$("#eti_prod_select1").show();
	$("#eti_prod_select2").hide();
}



/*function parpadeo1()
{
	var div_prod = document.getElementById('pestaña_prod_select');
	div_prod.className = 'parpadeo';
}*/

function listar_documentos_cargados_lic()
{
	var idpedido = $("#id_ped_temp").val();

	//alert(idpedido);

	$.post("ajax/diseno.php?op=listar_documentos_cargados_lic&id="+idpedido,function(r){
	$("#box_documentos_cargados_lic").html(r);

			$.post("ajax/diseno.php?op=buscar_iddocs",{idpedido:idpedido},function(data, status)
			{
			data = JSON.parse(data);

				//alert(data);

				if (data==null) {

					document.getElementById('ar_comprob_lic1').disabled = false;
					$("#iddocumentos1").val("0");
					$("#ar_comprob_lic1").val("");
					document.getElementById('ar_comprob_lic2').disabled = false;
					$("#iddocumentos2").val("0");
					$("#ar_comprob_lic2").val("");
					document.getElementById('ar_comprob_lic3').disabled = false;
					$("#iddocumentos3").val("0");
					$("#ar_comprob_lic3").val("");
					document.getElementById('ar_comprob_lic4').disabled = false;
					$("#iddocumentos4").val("0");
					$("#ar_comprob_lic4").val("");
				}else{

					if (data.idorden_compra>0) {
						document.getElementById('ar_comprob_lic1').disabled = true;
						$("#iddocumentos1").val(data.idorden_compra);
						$("#ar_comprob_lic1").val("");
					}else{
						document.getElementById('ar_comprob_lic1').disabled = false;
						$("#iddocumentos1").val("0");
						$("#ar_comprob_lic1").val("");
					}

					if (data.idcontrato>0) {
						document.getElementById('ar_comprob_lic2').disabled = true;
						$("#iddocumentos2").val(data.idcontrato);
						$("#ar_comprob_lic2").val("");
					}else{
						document.getElementById('ar_comprob_lic2').disabled = false;
						$("#iddocumentos2").val("0");
						$("#ar_comprob_lic2").val("");
					}

					if (data.idespecif>0) {
						document.getElementById('ar_comprob_lic3').disabled = true;
						$("#iddocumentos3").val(data.idespecif);
						$("#ar_comprob_lic3").val("");
					}else{
						document.getElementById('ar_comprob_lic3').disabled = false;
						$("#iddocumentos3").val("0");
						$("#ar_comprob_lic3").val("");
					}

					if (data.idanexo>0) {
						document.getElementById('ar_comprob_lic4').disabled = true;
						$("#iddocumentos4").val(data.idanexo);
						$("#ar_comprob_lic4").val("");
					}else{
						document.getElementById('ar_comprob_lic4').disabled = false;
						$("#iddocumentos4").val("0");
						$("#ar_comprob_lic4").val("");
					}

				}

					

				
			});
			       
	});
}

function borrar_documento_lic(iddocumentos)
{
	//alert(iddocumentos);

	bootbox.confirm({
	    message: "¿Esta seguro de eliminar este documento?",
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
	        console.log('This was logged in the callback: ' + result);

	        //alert(result);


	        if (result==true) {	
		

					$.post("ajax/diseno.php?op=borrar_documento_lic",{iddocumentos:iddocumentos},function(data, status)
					{
					data = JSON.parse(data);

							listar_documentos_cargados_lic();

							//bootbox.alert("Documento borrado corr")
					});

			}

	    }
	});
}

function abrir_edit_prod_list()
{
	
	$("#modal_edit_prod_list").modal("show");
	//var id_ped_temp = $("#id_ped_temp2").text();
	

}

function listar_productos_list()
{
	var buscar_prod_list = $("#buscar_prod_list").val();

	$.post("ajax/diseno.php?op=listar_productos_list&id="+buscar_prod_list,function(r){
	$("#tbl_productos_list").html(r);

			        
	});
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

							var id_ped_temp = $("#id_ped_temp2").text();
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
													tbl_rep_pedido_consul();
													pie_reporte();
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



							var id_ped_temp = $("#id_ped_temp2").text();
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
													tbl_rep_pedido_consul();
													pie_reporte();
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

							var id_ped_temp = $("#id_ped_temp2").text();
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
										tbl_rep_pedido_consul();
										pie_reporte();
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



							var id_ped_temp = $("#id_ped_temp2").text();
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
										tbl_rep_pedido_consul();
										pie_reporte();

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


function listar_productos_pedido_exist()
{
	var id_ped_temp = $("#id_ped_temp2").text();

	$.post("ajax/diseno.php?op=listar_productos_pedido_exist&id="+id_ped_temp,function(r){
	$("#tbl_productos_pedido_exist").html(r);

			        
	});
}

function listar_productos_pedido_exist_edit()
{
	var id_ped_temp = $("#id_ped_temp2").text();

	$.post("ajax/diseno.php?op=listar_productos_pedido_exist_edit&id="+id_ped_temp,function(r){
	$("#tbl_productos_pedido_exist_edit").html(r);

			        
	});
}

function listar_productos_pedido_exist2()
{
	var id_ped_temp = $("#id_ped_temp2").text();

	$.post("ajax/diseno.php?op=listar_productos_pedido_exist2&id="+id_ped_temp,function(r){
	$("#tbl_productos_pedido_exist2").html(r);

			        
	});
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

function quitar_prod_ped_list(idpg_detalle_pedidos,idproducto,precio_total)
{
	var idpedido = $("#id_ped_temp2").text();
	var idusuario=$("#idusuario").text();
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var precio = precio_total;

	var id_ped_temp = $("#id_ped_temp2").text();

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
													tbl_rep_pedido_consul();
													pie_reporte();
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
									tbl_rep_pedido_consul();
									pie_reporte();

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
									tbl_rep_pedido_consul();
									pie_reporte();

									bootbox.alert("Producto eliminado exitosamente");

								});

							}

					    }
					});
			
		}
	});
}

function cambiar_prod_ped_list(idpg_detalle_pedidos)
{
	var idpedido = $("#id_ped_temp2").text();
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



function set_idpedido()
{
	id1=1;
	id2=4000;

	$.post("ajax/diseno.php?op=set_idpedido",{id1:id1,id2:id2},function(data, status)
	{
		data = JSON.parse(data);

		//alert("set_ok");

	});
}





function listar_pedido_detalle_term(idpg_pedidos)
{
	//alert(idpg_pedidos);

	$.post("ajax/diseno.php?op=listar_pedido_detalle_term&id="+idpg_pedidos,function(r){
	$("#tbl_pedido_detalle_term"+idpg_pedidos).html(r);

		$.post("ajax/diseno.php?op=listar_pedido_detalle_term_v&id="+idpg_pedidos,function(r){
		$("#tbl_pedido_detalle_term_v"+idpg_pedidos).html(r);

				        
		});

			        
	});


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

function quitar_prod_entrega(idpg_detalle_pedidos)
{

	//var check_entrega = document.getElementById("check_entrega"+idpg_detalle_pedidos).checked;
	
	//alert(idpg_pedidos);

	$.post("ajax/diseno.php?op=quitar_prod_entrega",{idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
	{
		data = JSON.parse(data);

		var idpg_pedidos = $("#idpedido_salida").val();
		//alert(idpg_pedidos);

		$.post("ajax/diseno.php?op=listar_prod_selec&id="+idpg_pedidos,function(r){
		$("#box_prod_pasar").html(r);
										

		});


	});
}


function abrir_ventana_salidas(idpg_pedidos)
{
	//$("#div_eti_salida").show();
	//$("#div_nueva_salida").hide();
	//$("#div_eti_entrega").show();
	//$("#div_nueva_entrega").hide();
	$("#idpedido_salida").val(idpg_pedidos);
	var idsalida = $("#idsalida").val();

	$.post("ajax/diseno.php?op=buscar_check_prod",{idpg_pedidos:idpg_pedidos},function(data, status)
	{
		data = JSON.parse(data);

		var num_check = data.num_check;

		//alert(num_check);

		if (num_check>0) {
			$("#modal_ventana_salidas").modal("show");
			$("#btn_opciones_vales").hide();

			//alert(idsalida);
			$.post("ajax/diseno.php?op=deselect_salida",function(data, status)
			{
				data = JSON.parse(data);


					$.post("ajax/diseno.php?op=buscar_pedido_datos",{idpg_pedidos:idpg_pedidos},function(data, status)
					{
						data = JSON.parse(data);

						$("#no_control_ent").text("No. Control: "+data.no_control);
						$("#cliente_ent").text("Cliente: "+data.nombre);



												if (data.interior_ent!="" || data.interior_ent!=null) {
													var interior = data.interior_ent;
												}else{
													var interior = "";
												}

												if (data.cp_ent!="" || data.cp_ent!=null) {
													var cp = data.cp_ent;
												}else{
													var cp = "";
												}

												var direccion = data.calle_ent+" "+data.numero_ent+" "+interior+" Col. "+data.colonia_ent+" "+data.ciudad_ent+" "+data.estado_ent+cp;




						$("#direccion_ent").text("Dirección: "+direccion);

						$.post("ajax/diseno.php?op=listar_prod_selec&id="+idpg_pedidos,function(r){
						$("#box_prod_pasar").html(r);	

							 $.post("ajax/diseno.php?op=contar_salida",function(data, status)
							{
								data = JSON.parse(data);
								var num_salida = data.num_salida;

								if (num_salida>0) {

									

										/*$.post("ajax/diseno.php?op=listar_salidas",function(r){
											$("#box_salidas5").html(r);	*/

											/*$.post("ajax/diseno.php?op=listar_entregas_new&id="+idsalida,function(r){
												$("#box_entregas5").html(r);*/

												$.post("ajax/diseno.php?op=listar_salidas_listbox",function(r){
												$("#select_salida").html(r);

													$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+idsalida,function(r){
													$("#select_entrega").html(r);

													});


												});

											//});

											//$("#div_eti_salida").show();
											//$("#div_nueva_salida").hide();
											        
										//});

									
									
								}

							});

						});

					});

			});

					


		}else{
			alert("Ningún producto seleccionado");
		}

	});


}

function act_cant_entregar(idpg_detalle_pedidos)
{
	var cantidad = $("#idproducto_enviar"+idpg_detalle_pedidos).val();
	var idpedido = $("#idpedido_salida").val();
	var idpg_pedidos = idpedido;

	

	$.post("ajax/diseno.php?op=consul_pend_ent",{idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
	{
		data = JSON.parse(data);

		var cant_req = data.cantidad;
		var cant_pend = data.cant_entregada;

		var cant_max = cant_req - cant_pend;


		if (cantidad>0 && cantidad<=cant_max) {

			$.post("ajax/diseno.php?op=act_cant_entregar",{idpg_detalle_pedidos:idpg_detalle_pedidos,cantidad:cantidad},function(data, status)
			{
				data = JSON.parse(data);

				

			});
		}else{
			bootbox.alert("La cantidad no es valida");
			$("#idproducto_enviar"+idpg_detalle_pedidos).val("0");
		}

	});

			
}

function nueva_salida()
{

			

				$("#modal_nueva_salida").modal("show");
				var idusuario=$("#idusuario").text();
				var fecha=moment().format('YYYY-MM-DD');
				var hora=moment().format('HH:mm:ss');
				var fecha_hora=fecha+" "+hora;

				$("#fecha_salida_new_s").val(fecha);
				$("#hora_salida_new_s").val("09:00:00");

				listar_choferes();
				listar_vehiculos();

			

	
}

function mostrar_eti()
{
	//$("#div_eti_salida").show();
	//$("#div_nueva_salida").hide();
}


function guardar_salida()
{
	var fecha = $("#fecha_salida_new_s").val();
	var hora = $("#hora_salida_new_s").val();
	var idrepartidor = $("#select_chofer").val();
	var idvehiculo = $("#select_vehiculo").val();

	var fecha_hora=fecha+" "+hora;


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

			/*$.post("ajax/diseno.php?op=listar_salidas",function(r){
				$("#box_salidas5").html(r);	*/

												$.post("ajax/diseno.php?op=listar_salidas_listbox",function(r){
												$("#select_salida").html(r);

													/*$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+idsalida,function(r){
													$("#select_entrega").html(r);

													});*/
													$("#modal_nueva_salida").modal("hide"); 


												});

				       
			//});

		});

	});
		
}

function ver_entregas(idsalida)
{
	//$("#div_eti_entrega").show();
	//$("#div_nueva_entrega").hide();
	//$("#productos_entrega").hide();

	$("#idsalida").val(idsalida);

		/*$.post("ajax/diseno.php?op=listar_entregas_new&id="+idsalida,function(r){
			$("#box_entregas5").html(r);*/

			$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+idsalida,function(r){
			$("#select_entrega").html(r);

			});
		//});
}

function ver_entregas2()
{
	//$("#div_eti_entrega").show();
	//$("#div_nueva_entrega").hide();
	//$("#productos_entrega").hide();

	var idsalida = $("#select_salida").val();
	$("#idsalida").val(idsalida);

	//alert(idsalida);

		/*$.post("ajax/diseno.php?op=listar_entregas_new&id="+idsalida,function(r){
			$("#box_entregas5").html(r);*/

			$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+idsalida,function(r){
			$("#select_entrega").html(r);
				$.post("ajax/diseno.php?op=listar_productos_new_salidas&id="+idsalida,function(r){
				$("#box_productos5").html(r);

					$("#btn_opciones_vales").show();

				});

			});
		//});
}

function nueva_entrega()
{
	var idsalida = $("#idsalida").val();
	

	if (idsalida>0) {
		$("#modal_select_entrega").modal("show");
		//$("#div_eti_entrega").hide();
		//$("#div_nueva_entrega").show();
		var idpg_pedidos = $("#idpedido_salida").val();

									$.post("ajax/diseno.php?op=consultar_direccion",{idpg_pedidos:idpg_pedidos},function(data, status)
									{
										data = JSON.parse(data);

										if (data.interior_ent!="" || data.interior_ent!=null) {
											var interior = data.interior_ent;
										}else{
											var interior = "";
										}

										if (data.cp_ent!="" || data.cp_ent!=null) {
											var cp = data.cp_ent;
										}else{
											var cp = "";
										}

										var direccion = data.calle_ent+" "+data.numero_ent+" "+interior+" Col. "+data.colonia_ent+" "+data.ciudad_ent+" "+data.estado_ent+cp;

										$("#dir_entrega_new_e").val(direccion);

										

										/*$.post("ajax/diseno.php?op=listar_entregas_detalles&id="+identrega+"&direccion="+direccion,function(r){
										$("#tbl_salidas_entregas").html(r);

										});*/



									});

	}else{
		bootbox.alert("Es necesario seleccionar una salida");
	}

	
}



function guardar_entrega()
{
	var idpedido = $("#idpedido_salida").val();
	var idsalida = $("#idsalida").val();
	var dir_entrega_new_e = $("#dir_entrega_new_e").val();
	var contacto_new_e = $("#contacto_new_e").val();

	$.post("ajax/diseno.php?op=contar_entregas_dia",{idsalida:idsalida},function(data, status)
	{
		data = JSON.parse(data);

		var num_entregas = data.num_entregas+1;

		$.post("ajax/diseno.php?op=guardar_entrega",{idsalida:idsalida,num_entregas:num_entregas,dir_entrega_new_e:dir_entrega_new_e,contacto_new_e:contacto_new_e,idpedido:idpedido},function(data, status)
		{
			data = JSON.parse(data);

			/*$.post("ajax/diseno.php?op=listar_entregas_new&id="+idsalida,function(r){
				$("#box_entregas5").html(r);*/

					$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+idsalida,function(r){
					$("#select_entrega").html(r);

						$("#modal_select_entrega").modal("hide");

					});

						
			//});

		});

	});	
	//alert(idsalida);

		
}

function ver_productos(identrega)
{

	$("#identrega").val(identrega);

	$.post("ajax/diseno.php?op=consul_entrega",{identrega:identrega},function(data, status)
	{
		data = JSON.parse(data);

		$("#direccion_ent2").text("Dirección de entrega: "+data.direccion);
		$("#contacto_ent2").text("Contacto: "+data.contacto);

		$.post("ajax/diseno.php?op=listar_productos_new&id="+identrega,function(r){
		$("#box_productos5").html(r);

		});

	});
}

function ver_productos2()
{
	//$("#enlace_vale").show();
	var identrega = $("#select_entrega").val();

	$("#identrega").val(identrega);

	//alert(identrega);

	$.post("ajax/diseno.php?op=consul_entrega",{identrega:identrega},function(data, status)
	{
		data = JSON.parse(data);

		$("#numero_entrega").text("No. entrega: "+data.no_entrega);
		$("#direccion_ent2").text("Dirección de entrega: "+data.direccion);
		$("#contacto_ent2").text("Contacto: "+data.contacto);

		$.post("ajax/diseno.php?op=listar_productos_new&id="+identrega,function(r){
		$("#box_productos5").html(r);

		});

	});
}


function pasar_productos()
{
	//$("#productos_entrega").show();
	var idsalida = $("#idsalida").val();
	var identrega = $("#identrega").val();
	var idpedido = $("#idpedido_salida").val();

	if (idsalida != "" && identrega != "" && idpedido != "") {

		$.post("ajax/diseno.php?op=contar_ceros",{idpedido:idpedido},function(data, status)
		{
			data = JSON.parse(data);

			//alert(data.num_ceros);

			if (data.num_ceros==0) {



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

								$.post("ajax/diseno.php?op=listar_pedido_detalle_term&id="+idpg_pedidos,function(r){
								$("#tbl_pedido_detalle_term"+idpg_pedidos).html(r);


									$.post("ajax/diseno.php?op=listar_prod_selec&id="+idpg_pedidos,function(r){
										$("#box_prod_pasar").html(r);

										

									});

										        
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

function seleccionar_salida(idsalida)
{
	$.post("ajax/diseno.php?op=seleccionar_salida",{idsalida:idsalida},function(data, status)
	{
		data = JSON.parse(data);

		$.post("ajax/diseno.php?op=listar_salidas",function(r){
			$("#box_salidas5").html(r);	

			        
		});

	});
}

function seleccionar_entrega(identrega)
{
	var idsalida = $("#idsalida").val();

	$.post("ajax/diseno.php?op=seleccionar_entrega",{identrega:identrega},function(data, status)
	{
		data = JSON.parse(data);

		$.post("ajax/diseno.php?op=listar_entregas_new&id="+idsalida,function(r){
			$("#box_entregas5").html(r);
		});

	});
}



function revisar_sinfecha()
{
	var idusuario=$("#idusuario").text();

	$.post("ajax/diseno.php?op=revisar_sinfecha",function(data, status)
	{
		data = JSON.parse(data);

		if ((data.num_sinfecha>0 && idusuario==4) || (data.num_sinfecha>0 && idusuario==1) ) {




			toastrs();

			function toastrs() {
			  if (!showToastrs) {
			    toastr.error('Para un mejor seguimiento es necesario asignar fechas de entrega en todos los pedidos.',+data.num_sinfecha+' pedidos sin fecha de entrega!');
			    
			  } 
			}






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
}

var showToastrs = false;

function toastrs() {
  if (!showToastrs) {
    toastr.error('Para un mejor seguimiento es necesario asignar fechas de entrega en todos los pedidos.', 'Pedidos sin fecha de entrega!');
    
  } 
}*/

/*function toastrs() {
  if (!showToastrs) {
    toastr.error('Estamos bajo ataque DDoS', 'Error Critico!');
    toastr.success('Se guardaron los cambios satisfactoriamente', 'Todo en orden');
    toastr.warning('La latencia del server esta aumentando.', 'Alerta!');
  } else {
    toastr.error('no se puede!\'t.', 'Otro error crítico');
  }
}*/

// Definimos los callback cuando el TOAST le da un fade in/out:
/*toastr.options.onFadeIn = function() {
  showToastrs = true;
};
toastr.options.onFadeOut = function() {
  showToastrs = false;
};*/

/*$(function() {
  $("#clear").on("click", function() {
    // Clears the current list of toasts
    toastr.clear();
  });
  $("#rewind").on("click", function() {
    // show toastrs :)
    toastrs();
  });
});*/


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

function Borrar_salida(idsalida)
{

							bootbox.confirm({
						    message: "¿Desea eliminar esta entrega?",
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

						    		$.post("ajax/diseno.php?op=Borrar_salida",{idsalida:idsalida},function(data, status)
									{
										data = JSON.parse(data);

										bootbox.alert("Salida eliminada exitosamente");

										/*$.post("ajax/diseno.php?op=listar_salidas",function(r){
											$("#box_salidas5").html(r);	*/

											/*$.post("ajax/diseno.php?op=listar_entregas_new&id="+idsalida,function(r){
												$("#box_entregas5").html(r);*/

												$.post("ajax/diseno.php?op=listar_salidas_listbox",function(r){
												$("#select_salida").html(r);

													$.post("ajax/diseno.php?op=listar_entregas_listbox&id="+idsalida,function(r){
													$("#select_entrega").html(r);

													});


												});


											//});

											       
										//});



									});

						    	}

						    }
						});

									
}

function abrir_vale()
{
	var identrega = $("#identrega").val();
	$("#enlace_vale").attr("href","reportes/valeEnt.php?id="+identrega);
	//$("#enlace_vale").attr("href","reportes/repValid.php");
}
function abrir_vale_alm()
{
	var idusuario = $("#idusuario").text();

	/*$.post("ajax/diseno.php?op=buscar_datos_usuario",{idusuario:idusuario},function(data, status)
	{
		data = JSON.parse(data);

		var nombre_completo = data.nombre_completo;*/

		//alert(nombre_completo);

		var idsalida = $("#idsalida").val();
		$("#enlace_vale_alm").attr("href","reportes/valeSalidaAlm.php?id="+idsalida+"&idusuario="+idusuario);


	//});


		
	//$("#enlace_vale").attr("href","reportes/repValid.php");
}

function ver_coment_prod(idpg_pedidos)
{
	//alert(idpg_pedidos);

	$("#modal_coment_prod").modal("show");

	$.post("ajax/diseno.php?op=listar_coment_prod&id="+idpg_pedidos,function(r){
	$("#tbl_coment_prod").html(r);

		/*$.post("ajax/diseno.php?op=listar_coment_op&id="+idpg_pedidos,function(r){
		$("#tbl_coment_op").html(r);

		});*/

	});
}

function set_idproducto()
{
	var id1=1
	var id2=4650

	$.post("ajax/diseno.php?op=set_idproducto",{id1:id1,id2:id2},function(data, status)
	{
		alert("idprod actualizado correctamente");
	});
}


function listar_detalle_prod()
{
	var id_ped_temp = $("#id_ped_temp2").text();

	var idpg_pedidos=id_ped_temp;

	$.post("ajax/diseno.php?op=listar_pedido_detalle_term&id="+idpg_pedidos,function(r){
	$("#tbl_detalle_productos").html(r);

		
			        
	});
}

function listar_etiquetas()
{

	$.post("ajax/diseno.php?op=listar_etiquetas",function(r){
	$("#tbl_etiquetas").html(r);

		
			        
	});
}





init();









































/*function agregar_producto_entrega(idpg_detalle_pedidos)
{
	//alert(idpg_detalle_pedidos);

	var idusuario=$("#idusuario").text();
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	//alert(fecha);

	$.post("ajax/diseno.php?op=agregar_producto_entrega",{fecha:fecha},function(data, status)
	{
		data = JSON.parse(data);

		//alert(data.cant_salidas);

		var cant_salidas = data.cant_salidas;

		if (cant_salidas==0) {


			$.post("ajax/diseno.php?op=crear_salida",{fecha_hora:fecha_hora},function(data, status)
			{
				data = JSON.parse(data);

				//alert(data.idsalida);
				var idsalida = data.idsalida;

				$.post("ajax/diseno.php?op=crear_entrega",{idsalida:idsalida,idpg_detalle_pedidos:idpg_detalle_pedidos},function(data, status)
				{
					data = JSON.parse(data);

						$.post("ajax/diseno.php?op=listar_salidas",function(r){
						$("#box_salidas").html(r);
						        
						});

						

				});						

			});

		}else{

			$("#idproducto").val(idpg_detalle_pedidos);
			$("#modal_select_salida").modal("show");

			$.post("ajax/diseno.php?op=listar_salidas_select",function(r){
			$("#box_salidas_select").html(r);
						        
			});
		}

	});


}*/

/*function mostrar_salida(idsalida)
{

	$("#modal_terminados").modal("hide");
	$("#modal_salidas").modal("show");

	//alert(idsalida);

	$.post("ajax/diseno.php?op=listar_salidas2",function(r){					
	$("#box_salidas2").html(r);

		var div_now = document.getElementById('div_salida'+idsalida);
		div_now.style.backgroundColor = '#ACFAC3';

				$.post("ajax/diseno.php?op=consultar_salida",{idsalida:idsalida},function(data, status)
				{
					data = JSON.parse(data);

					$("#fecha_salida").val(data.fecha);
					$("#idsalida").val(data.idsalida);

					var idsalida = data.idsalida;

						$.post("ajax/diseno.php?op=listar_salidas_entregas&id="+idsalida,function(r){
						$("#box_entregas").html(r);

								$.post("ajax/diseno.php?op=consultar_entrega",{idsalida:idsalida},function(data, status)
								{
									data = JSON.parse(data);

									var identrega = data.identrega;
									var iddir_entrega = data.iddir_entrega;

									

									

								});
	        
						});

				});	

	});


}*/

/*function mostrar_salida_select(idsalida)
{

	
	$("#modal_select_salida").modal("hide");
	$("#modal_select_entrega").modal("show");

	$.post("ajax/diseno.php?op=buscar_salida",{idsalida:idsalida},function(data, status)
	{
		data = JSON.parse(data);

		$("#fecha_salida").text("FECHA DE SALIDA: "+data.fecha);
		$("#hora_salida").text("HORA DE SALIDA: "+data.hora);

	});


	$.post("ajax/diseno.php?op=listar_salidas_entregas2&id="+idsalida,function(r){
	$("#box_entregas_select").html(r);

	});


	
}*/


/*function select_entrega(identrega)
{
	var idproducto = $("#idproducto").val();

	$.post("ajax/diseno.php?op=guardar_producto",{identrega:identrega,idproducto:idproducto},function(data, status)
	{
		data = JSON.parse(data);

		alert("producto agregado correctamente");


	});
}*/

/*function abrir_add_prod(idpg_detalle_pedidos)
{
	//alert(idpg_detalle_pedidos);

	var fecha=moment().format('YYYY-MM-DD');

	$("#fecha_salida_emerg").val(fecha);

	$.post("ajax/diseno.php?op=listar_salidas_set&id="+fecha,function(r){
	$("#lista_salidas"+idpg_detalle_pedidos).html(r);

	});


}*/


/*function mostrar_salidas(idpg_detalle_pedidos)
{

	var fecha = $("#fecha_salida_emerg").val();

	//alert(fecha);

	$.post("ajax/diseno.php?op=listar_salidas_set&id="+fecha,function(r){
	$("#lista_salidas"+idpg_detalle_pedidos).html(r);

	});
}*/







/*function mostrar_entregas(idsalida)
{
	$("#modal_select_entrega").modal("show");

	$.post("ajax/diseno.php?op=listar_entregas_set&id="+idsalida,function(r){
	$("#lista_entregas"+idpg_detalle_pedidos).html(r);

	});
}*/

function capturar_cant(idproducto)
{
	bootbox.prompt('Capturar cantidad',
	function(result) {

		if (result=="") {
			return;
		}else{
			var input_cant_prod = result;
			var id_ped_temp = $("#id_ped_temp").val();
			//alert(id_ped_temp);
			var cantidad = input_cant_prod;
		

			$.post("ajax/diseno.php?op=buscar_reg_prod",{id_ped_temp:id_ped_temp,idproducto:idproducto},function(data, status)
			{
			data = JSON.parse(data);

				var precio = data.precio;
				var importe = parseFloat(precio)*parseInt(cantidad);


					$.post("ajax/diseno.php?op=update_cant",{id_ped_temp:id_ped_temp,idproducto:idproducto,cantidad:cantidad,importe:importe},function(data, status)
					{
					data = JSON.parse(data);


						var notificator = new Notification(document.querySelector('.notification'));
						notificator.info('Cantidad actualizada');
						tbl_prod_ped();

					});


			});
		}

		
	});
		
}









