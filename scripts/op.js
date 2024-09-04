function init()
{
	var id_detped = $("#id_detped").text();


	var idop = id_detped

	//alert(idop);

	if (id_detped>0) {

		$.post("ajax/diseno.php?op=set_op2",{idop:idop},function(data, status)
		{
		data = JSON.parse(data);

			$.post("ajax/diseno.php?op=set_one_op",{idop:idop},function(data, status)
			{
			data = JSON.parse(data);

				$("#idop").val(idop);
				$("#op").val(data.no_op);
				$("#prioridad").val(data.prioridad);
				$("#observ").val(data.observ);
				$("#fecha1").val(data.fecha1);
				$("#fecha2").val(data.fecha2);
				$("#cant_color").val(data.cant_color);

				$.post("ajax/op.php?op=listar_ops2&id="+idop,function(r){
				$("#tbl_op").html(r);

					$("#modal_create_op").modal("show");
					//listar_ops();
					listar_ops_detalles();
												        
				});
				
										
			});

		});
	}else{
		//listar_ops();

		//alert("entra sin op");
		//listar_productos_op();
	}


	$("#div_op").show();
	$("#div_prod").hide();
	$("#div_panel_prod").hide();
	
		
	window.location.hash="no-back-button";
	window.location.hash="Again-No-back-button";//esta linea es necesaria para chrome
	window.onhashchange=function(){window.location.hash="no-back-button";}

	ver_ultima_op();

	var idusuario = $("#idusuario").text();
	if (idusuario==1) {
		document.getElementById("btn_addProd_op1").style.display="block";
	}
	

}




function edit_op()
{
	var idop = $("#idop").val();

	if (idop>0) {

		//$("#enlace_op").hide();
		$("#btn_guardar").hide();
		$("#btn_update").show();

	}
		
}



function crear_ip_areas()
{
	//var check_todos = document.getElementById("check_todos").checked;
	var check_porc = document.getElementById("check_porc").checked;
	var check_com = document.getElementById("check_com").checked;
	var check_mueb = document.getElementById("check_mueb").checked;
	var check_horno = document.getElementById("check_horno").checked;
	var check_herreria = document.getElementById("check_herreria").checked;
	var check_plasticos = document.getElementById("check_plasticos").checked;
	var check_pintura = document.getElementById("check_pintura").checked;

	var idop = $("#idop").val();

	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;


	if (check_porc==true) {

		//
		$.post("ajax/op.php?op=consul_area5",{idop:idop},function(data, status)
		{
			data = JSON.parse(data);

			//alert("entra");
			if (data.area5==0) {

				var area="5";
				$.post("ajax/op.php?op=insert_check",{idop:idop,area:area,fecha_hora:fecha_hora},function(data, status)
				{
					data = JSON.parse(data);

					//document.getElementById('check_herreria').disabled = true;
					listar_ops_detalles();

				});

			}else{
				//bootbox.alert("La copia para Ensamble (Porcelanizado) ya existe");

			}

		});		
				
	}



	if (check_com==true) {

		//
		$.post("ajax/op.php?op=consul_area6",{idop:idop},function(data, status)
		{
			data = JSON.parse(data);

			//alert("entra");
			if (data.area6==0) {

				var area="6";
				$.post("ajax/op.php?op=insert_check",{idop:idop,area:area,fecha_hora:fecha_hora},function(data, status)
				{
					data = JSON.parse(data);

					//document.getElementById('check_herreria').disabled = true;
					listar_ops_detalles();

				});

			}else{
				//bootbox.alert("La copia para Ensamble (Porcelanizado) ya existe");

			}

		});	
				
	}


	if (check_mueb==true) {

		//
		$.post("ajax/op.php?op=consul_area7",{idop:idop},function(data, status)
		{
			data = JSON.parse(data);

			//alert("entra");
			if (data.area7==0) {

				var area="7";
				$.post("ajax/op.php?op=insert_check",{idop:idop,area:area,fecha_hora:fecha_hora},function(data, status)
				{
					data = JSON.parse(data);

					//document.getElementById('check_herreria').disabled = true;
					listar_ops_detalles();

				});

			}else{
				//bootbox.alert("La copia para Ensamble (Porcelanizado) ya existe");

			}

		});	
				
	}




	if (check_horno==true) {

		//
		$.post("ajax/op.php?op=consul_area8",{idop:idop},function(data, status)
		{
			data = JSON.parse(data);

			//alert("entra");
			if (data.area8==0) {

				var area="8";
				$.post("ajax/op.php?op=insert_check",{idop:idop,area:area,fecha_hora:fecha_hora},function(data, status)
				{
					data = JSON.parse(data);

					//document.getElementById('check_herreria').disabled = true;
					listar_ops_detalles();

				});

			}else{
				//bootbox.alert("La copia para Ensamble (Porcelanizado) ya existe");

			}

		});	
				
	}






	if (check_herreria==true) {

		//
		$.post("ajax/op.php?op=consul_area",{idop:idop},function(data, status)
		{
			data = JSON.parse(data);

			//alert("entra");
			if (data.area1==0) {

				var area="1";
				$.post("ajax/op.php?op=insert_check",{idop:idop,area:area,fecha_hora:fecha_hora},function(data, status)
				{
					data = JSON.parse(data);

					//document.getElementById('check_herreria').disabled = true;
					listar_ops_detalles();

				});

			}else{
				//bootbox.alert("La copia para Herrería ya existe");

			}

		});

		
				
	}

	if (check_pintura==true) {
		
		
		$.post("ajax/op.php?op=consul_area2",{idop:idop},function(data, status)
		{
			data = JSON.parse(data);
			//alert("entra");
			if (data.area2==0) {

				var area="2";
				$.post("ajax/op.php?op=insert_check",{idop:idop,area:area,fecha_hora:fecha_hora},function(data, status)
				{
					data = JSON.parse(data);

					//document.getElementById('check_pintura').disabled = true;
					listar_ops_detalles();

				});

			}else{
				//bootbox.alert("La copia para Pintura ya existe");
			}

		});
	}

	if (check_plasticos==true) {
		
		
		$.post("ajax/op.php?op=consul_area3",{idop:idop},function(data, status)
		{
			data = JSON.parse(data);
			//alert("entra");
			if (data.area3==0) {
				var area="3";
				$.post("ajax/op.php?op=insert_check",{idop:idop,area:area,fecha_hora:fecha_hora},function(data, status)
				{
					data = JSON.parse(data);

					//document.getElementById('check_plasticos').disabled = true;
					listar_ops_detalles();

				});

			}else{
				//bootbox.alert("La copia para Plásticos ya existe");
			}

		});
	}




}





function abrir_op3(idop_detalle)// para reporte
{
  	//alert(idop_detalle);
  	//alert(idop_detalle);
  	$("#enlace_op3"+idop_detalle).attr("href","reportes/exOp.php?id="+idop_detalle);
  
}

function abrir_op()// para reporte
{

  	var idop_detalle = $("#iddet_ped_ver").text();

  	$("#enlace_op").attr("href","reportes/exOp.php?id="+idop_detalle);
  
}



function update_op()
{
	var idop = $("#idop").val();

	//alert(idop);

			var cant_color = $("#cant_color").val();
			var prioridad = $("#prioridad").val();			
			var observ = $("#observ").val();
			var fecha1 = $("#fecha1").val();
			var fecha2 = $("#fecha2").val();


						$.post("ajax/op.php?op=update_op",{
							idop:idop,
							prioridad:prioridad,
							observ:observ,
							fecha1:fecha1,
							fecha2:fecha2,
							cant_color:cant_color},function(data, status)
						{
							data = JSON.parse(data);
						
							

						});
	
			
}


function listar_ops()
{
	$("#no_op_buscar").val("");
	$("#fecha_buscar").val("");
	var idusuario = $("#idusuario").text();

	$.post("ajax/op.php?op=listar_ops&idusuario="+idusuario,function(r){
	$("#box_ops_det").html(r);
				
	});
}

function listar_ops2()
{

	var idusuario = $("#idusuario").text();

	$.post("ajax/op.php?op=listar_ops&idusuario="+idusuario,function(r){
	$("#box_ops_det").html(r);
				
	});
}

function listar_ops_area()
{

	var idusuario = $("#idusuario").text();
	var no_op_buscar = $("#no_op_buscar").val();
	var fecha_buscar = $("#fecha_buscar").val();

	/*alert(idusuario);
	alert(no_op_buscar);
	alert(fecha_buscar);*/

	$.post("ajax/op.php?op=listar_ops_area&id="+idusuario+"&valor="+no_op_buscar+"&fecha="+fecha_buscar,function(r){
	$("#box_ops_det").html(r);
				
	});
}

function listar_ops_buscar()
{
	var idusuario = $("#idusuario").text();
	var no_op_buscar = $("#no_op_buscar").val();
	var fecha_buscar = $("#fecha_buscar").val();

	$.post("ajax/op.php?op=listar_ops_buscar&idusuario="+idusuario+"&valor="+no_op_buscar+"&fecha="+fecha_buscar,function(r){
	$("#box_ops_det").html(r);


				
	});
}

function listar_ops_detalles()
{
	var idop = $("#idop").val();

	$.post("ajax/op.php?op=listar_ops_detalles&id="+idop,function(r){
	$("#tbl_op_det").html(r);

			        
	});
}

function listar_ops_detalles2(idop)
{
	//var idop = $("#idop").val();

	var idusuario=$("#idusuario").text();

	$.post("ajax/op.php?op=listar_ops_detalles2&id="+idop+"&idusuario="+idusuario,function(r){
	$("#tbl_prod_detalle"+idop).html(r);

			        
	});
}


function mostrar_opdet(idop_detalle)
{
	//alert(mostrar_opdet);
	$("#modal_ver_op_det").modal("show");

	$("#iddet_ped_ver").text(idop_detalle);

	$.post("ajax/op.php?op=buscar_op",{idop_detalle:idop_detalle},function(data, status)
	{
		data = JSON.parse(data);

		$("#op_r").val(data.no_op);
		$("#prioridad_r").val(data.prioridad);	
		$("#idop_r").val(data.idop);	
		$("#observ_r").val(data.observ);	
		$("#fecha1_r").val(data.fecha_inicio);
		$("#fecha2_r").val(data.fecha_term);
		$("#cant_color_r").val(data.cant_color);


						if (data.area==1) {
							var area="Herrería";
							$("#area_nom").text(area);
						}
						if(data.area==2) {
							var area="Pintura";
							$("#area_nom").text(area);
						}

						if(data.area==3) {
							var area="Plásticos";
							$("#area_nom").text(area);
						}

						if(data.area==5) {
							var area="Ensamble (Porcelanizado)";
							$("#area_nom").text(area);
						}

						if(data.area==6) {
							var area="Ensamble (Comercial)";
							$("#area_nom").text(area);
						}

						if(data.area==7) {
							var area="Ensamble (Mueble)";
							$("#area_nom").text(area);
						}

						if(data.area==8) {
							var area="Horno";
							$("#area_nom").text(area);
						}

						if(data.area>8 || data.area<1 || data.area==4) {
							var area="";
							$("#area_nom").text(area);
						}

						//alert(area);

		

		var idop=data.idop;


		    $.post("ajax/op.php?op=listar_ops2&id="+idop,function(r){
			$("#tbl_op2").html(r);




				$.post("ajax/op.php?op=buscar_op_detalle",{idop_detalle:idop_detalle},function(data, status)
				{
					data = JSON.parse(data);

					$("#lote_r").val(data.lote);
					$("#cant_r").val(data.piezas_fabricadas);
					$("#maquina_r").val(data.maquina);
					$("#ciclo_r").val(data.ciclo);
					$("#productividad_r").val(data.productividad);
					$("#cumplimiento_r").val(data.cumplimiento);
					$("#diferencia_r").val(data.diferencia);
					$("#entregas_r").val(data.entregas);
					$("#reproceso_r").val(data.reproceso);
					$("#desperdicio_r").val(data.desperdicio);
					$("#merma_r").val(data.merma);
					
					$("#observ_area_r").val(data.observ);

					$("#real_fecha1").val(data.fecha_inicio);
					$("#real_hora1").val(data.hora_inicio);
					$("#real_fecha2").val(data.fecha_term);
					$("#real_hora2").val(data.hora_term);
					$("#prod_aprob_r").val(data.prod_aprob);

				});				
											        
			});				

	});
}


function registro_avance(idop_detalle,idop,area)
{	
	$("#modal_avances").modal("show");
	$("#idop_detalle_actual").val(idop_detalle);

						$("#area_num").val(area);


						if (area==1) {
							var area="Herrería";
							$("#area_a").val(area);
						}
						if(area==2) {
							var area="Pintura";
							$("#area_a").val(area);
						}

						if(area==3) {
							var area="Plásticos";
							$("#area_a").val(area);
						}

						if(area==5) {
							var area="Ensamble (Porcelanizado)";
							$("#area_a").val(area);
						}

						if(area==6) {
							var area="Ensamble (Comercial)";
							$("#area_a").val(area);
						}

						if(area==7) {
							var area="Ensamble (Mueble)";
							$("#area_a").val(area);
						}

						if(area==8) {
							var area="Horno";
							$("#area_a").val(area);
						}

						if(area>8 || area<1 || area==4) {
							var area="";
							$("#area_a").val(area);
						}


	$.post("ajax/op.php?op=buscar_op",{idop_detalle:idop_detalle},function(data, status)
	{
		data = JSON.parse(data);

			$("#op_a").val(data.no_op);

			/*$.post("ajax/op.php?op=listar_ops2&id="+idop,function(r){
			$("#tbl_op_avance").html(r);


			});*/


			$.post("ajax/op.php?op=listar_prod_avance&id="+idop,function(r){
			$("#heard").html(r);

				ver_id();
			});
	});	
			
}

// function ver_id_todo()
// {
// 	//var idop_detalle_prod = $("#heard").val();
// 	var area_num = $("#area_num").val();

// 	//alert(idop_detalle_prod);

// 			$.post("ajax/op.php?op=cargar_campos_avance2&id="+area_num,function(r){
// 			$("#box_productos_avance").html(r);


// 			});
// }

function ver_id()
{
	var idop_detalle_prod = $("#heard").val();
	var area_num = $("#area_num").val();
	var idusuario=$("#idusuario").text();

	// alert(idop_detalle_prod);
	// alert(area_num);

			$.post("ajax/op.php?op=cargar_campos_avance&id="+idop_detalle_prod+"&area="+area_num+"&idusuario="+idusuario,function(r){
			$("#box_productos_avance").html(r);


				$.post("ajax/op.php?op=cargar_historial_avances&id="+idop_detalle_prod+"&area="+area_num,function(r){
				$("#tbl_hist_avances").html(r);


				});


				$.post("ajax/op.php?op=cargar_excedentes&id="+idop_detalle_prod+"&area="+area_num,function(r){
				$("#tbl_excedente").html(r);


				});


			});

				
}

function update_op_area()
{

	var idusuario=$("#idusuario").text();

	if (idusuario==10) {

		var idop_detalle = $("#iddet_ped_ver").text();

		//alert(idop_detalle);

		var lote_r = $("#lote_r").val();
		var cant_r = $("#cant_r").val();
		var maquina_r = $("#maquina_r").val();
		var ciclo_r = $("#ciclo_r").val();
		var productividad_r = $("#productividad_r").val();
		var cumplimiento_r = $("#cumplimiento_r").val();
		var diferencia_r = $("#diferencia_r").val();
		var entregas_r = $("#entregas_r").val();
		var reproceso_r = $("#reproceso_r").val();
		var desperdicio_r = $("#desperdicio_r").val();
		var merma_r = $("#merma_r").val();
		
		var observ_area_r = $("#observ_area_r").val();

		var real_fecha1 = $("#real_fecha1").val();
		var real_hora1 = $("#real_hora1").val();
		var real_fecha2 = $("#real_fecha2").val();
		var real_hora2 = $("#real_hora2").val();
		var prod_aprob_r = $("#prod_aprob_r").val();

		$.post("ajax/op.php?op=update_op_area",{
			idop_detalle:idop_detalle,
			lote_r:lote_r,
			cant_r:cant_r,
			maquina_r:maquina_r,
			ciclo_r:ciclo_r,
			productividad_r:productividad_r,
			cumplimiento_r:cumplimiento_r,
			diferencia_r:diferencia_r,
			entregas_r:entregas_r,
			reproceso_r:reproceso_r,
			desperdicio_r:desperdicio_r,
			merma_r:merma_r,
			observ_area_r:observ_area_r,
			real_fecha1:real_fecha1,
			real_hora1:real_hora1,
			real_fecha2:real_fecha2,
			real_hora2:real_hora2,
			prod_aprob_r:prod_aprob_r},function(data, status)
		{
			data = JSON.parse(data);

			bootbox.alert("Orden de producción actualizado exitosamente");

		});
	}else{
		bootbox.alert("No tiene permisos para realizar esta actualización");
	}

		
}

function abrir_modal_reg_areas(idop)
{
	//$("#modal_create_op").modal("show");

	//alert(idop);

	$("#idop").val(idop);

			$.post("ajax/op.php?op=consulta_op",{idop:idop},function(data, status)
			{
			data = JSON.parse(data);

			if (data.estatus==2) {
				document.getElementById("btn_cancelar").style.display = "none";
				document.getElementById("btn_activar").style.display = "block";
			}else{
				document.getElementById("btn_cancelar").style.display = "block";
				document.getElementById("btn_activar").style.display = "none";
			}

				$("#op").val(data.no_op);
				$("#fecha1").val(data.fecha1);
				$("#fecha2").val(data.fecha2);
				$("#prioridad").val(data.prioridad);
				$("#observ").val(data.observ);
				$("#cant_color").val(data.cant_color);

				$.post("ajax/op.php?op=listar_ops2&id="+idop,function(r){
				$("#tbl_op").html(r);
					//listar_ops();
					listar_ops_detalles();

					$("#modal_create_op").modal("show");
					//listar_ops();
												        
				});

			});
				//$("#op").val(data.no_op);
				//
				//

				
}


function guardar_avance_prod(idop_detalle_prod,idop,estatus_op,idpg_detped)
{
	

	// $.post("ajax/op.php?op=consul_estatus_op",{idop:idop},function(data, status)
	// {
	// data = JSON.parse(data);

		// var estatus_op = data.estatus;
		var idpg_detped_actual = idpg_detped;
		var estatus_op = estatus_op;
		//alert(estatus_op);
		//alert(estatus_op);
		//return;
		if (estatus_op==2) {
			bootbox.alert("Esta Orden de Producción esta cancelada.");
		}else{


			document.getElementById('btn_save_avance'+idop_detalle_prod).disabled = true;
			var area_num = $("#area_num").val();
			var requeridos = $("#requeridos_avance"+idop_detalle_prod).val();
			var avance = $("#cantidad_avance"+idop_detalle_prod).val();
			var coment_avance = $("#coment_avance"+idop_detalle_prod).val();
			var avance_ant = $("#cantidad_avance_ant"+idop_detalle_prod).val();
			var pedido = $("#pedido_avance"+idop_detalle_prod).val();
			var idpg_detalle_pedidos = $("#detalle_ped_avance"+idop_detalle_prod).val();
			var cantareas_avance = $("#cantareas_avance"+idop_detalle_prod).val();
			var idop_detalle_actual = $("#idop_detalle_actual").val();
			// var avance_actual = $("#avance_fabricados"+idop_detalle_actual).text();
			var fecha=moment().format('YYYY-MM-DD');
			var hora=moment().format('HH:mm:ss');
			var fecha_hora=fecha+" "+hora;

			var idusuario=$("#idusuario").text();

			var cantidad_indep_avance = $("#cantidad_indep_avance"+idop_detalle_prod).val();

			//alert(avance_actual);

			//return;

			if (cantidad_indep_avance>0) {


				//alert(idusuario);
				// $.post("ajax/op.php?op=consul_area_avance",{idusuario:idusuario},function(data, status)
				// {
				// data = JSON.parse(data);

				// 	var area_avance = data.area;

					//alert(area_avance+" a");
					var area_p=$("#area_p").text();

					if (area_p==area_num) {


							if ((idusuario>=15 && idusuario<=21)) 
							{


								if (parseInt(avance)<=parseInt(requeridos)) {

									if (parseInt(avance)<parseInt(avance_ant)) {


										bootbox.alert("El avance ingresado es menor al avance anterior, verifique y vuelva a intentar");
										

									}else{



										bootbox.prompt("Capturar numero de lote", function(result){ 
											console.log(result); 

											if (result!=null) {

												var lote = result;

												if (lote!="") {

													


													$.post("ajax/op.php?op=guardar_avance_prod",{idop_detalle_prod:idop_detalle_prod,avance:avance,fecha_hora:fecha_hora,area_num:area_num,pedido:pedido,idpg_detalle_pedidos:idpg_detalle_pedidos,lote:lote,coment_avance:coment_avance,cantidad_indep_avance:cantidad_indep_avance,idop:idop},function(data, status)
													{
													data = JSON.parse(data);

													var idavance_prod = data.idavance_prod;
													// var nuevo_avance = parseInt(avance_actual)+

														// $.post("ajax/op.php?op=buscar_cant_areas",{idop_detalle_prod:idop_detalle_prod},function(data, status)
														// {
														// data = JSON.parse(data);

																// var num_areas = parseInt(data.area1)+parseInt(data.area2)+parseInt(data.area3)+parseInt(data.area5)+parseInt(data.area6)+parseInt(data.area7)+parseInt(data.area8);
																var num_areas = cantareas_avance;
																var total_req = parseInt(requeridos)*parseInt(num_areas);

																//alert(total_req);

																$.post("ajax/op.php?op=contar_avance_tot",{idop_detalle_prod:idop_detalle_prod},function(data, status)
																{
																data = JSON.parse(data);

																	var sum_areas = parseInt(data.sum_area1)+parseInt(data.sum_area2)+parseInt(data.sum_area3)+parseInt(data.sum_area5)+parseInt(data.sum_area6)+parseInt(data.sum_area7)+parseInt(data.sum_area8);


																	//alert(sum_areas);

																	if (sum_areas==total_req) {



																			// $.post("ajax/op.php?op=consultar_iddetped",{idop_detalle_prod:idop_detalle_prod},function(data, status)
																			// {
																			// data = JSON.parse(data);

																				// console.log(data.idpg_detped);
																				// console.log(idpg_detped_actual);
																				//return;
																				//var idpg_detped = data.idpg_detped;
																				var estatus="Fabricado";



																				/*$.post("ajax/op.php?op=consul_area_entrega",{idop:idop},function(data, status)
																				{
																				data = JSON.parse(data);

																				var area_entrega = data.area;

																				


																					if (area_avance==area_entrega) {

																						var estatus="Fabricado";
																					}

																					if (area_avance!=area_entrega) {

																						var estatus="Produccion";
																					}



																				});*/







																					$.post("ajax/diseno.php?op=guardar_estatus_prod2",{idpg_detped_actual:idpg_detped_actual,estatus:estatus,fecha_hora:fecha_hora,lote:lote},function(data, status)
																					{
																					data = JSON.parse(data);

																							$.post("ajax/op.php?op=cargar_campos_avance&id="+idop_detalle_prod+"&area="+area_num+"&idusuario="+idusuario,function(r){
																							$("#box_productos_avance").html(r);

																								$.post("ajax/op.php?op=cantidades",{pedido:pedido},function(data, status)
																								{
																								data = JSON.parse(data);

																									var num_pedido = data.num_pedido;
																									var num_prod = data.num_prod;

																									// var num_prod_apart = data.num_prod_apart;

																									// if (num_prod_apart==null) {
																									// 	num_prod_apart=0;
																									// }


																									// var num_prod_fab = data.num_prod_fab;

																									// if (num_prod_fab==null) {
																									// 	num_prod_fab=0;
																									// }


																									// var num_prod_exis = data.num_prod_exis;

																									// if (num_prod_exis==null) {
																									// 	num_prod_exis=0;
																									// }


																									// var tot_detped = parseInt(num_prod_apart)+parseInt(num_prod_fab)+parseInt(num_prod_exis);
																									var tot_detped = data.sum_cumplido;

																									//alert(tot_detped+'total prod');
																									//alert(num_prod+'total peddido');


																									if (tot_detped >= num_prod) {

																										var idusuario=$("#idusuario").text();
																										var fecha=moment().format('YYYY-MM-DD');
																										var hora=moment().format('HH:mm:ss');
																										var fecha_hora=fecha+" "+hora;

																										var idpedido = pedido;

																										//alert(idpedido);

																										// $.post("ajax/diseno.php?op=consul_exist_notif",{idpedido:idpedido},function(data, status)
																										// {
																										// data = JSON.parse(data);

																											// var num_pedido = data.num_pedido;

																											//alert(num_pedido);

																												if (num_pedido==0) {

																													//var idpedido = pedido;


																													$.post("ajax/diseno.php?op=consul_estatus_pedido",{idpedido:idpedido},function(data, status)
																													{
																													data = JSON.parse(data);

																														var estatus_pedido = data.estatus_pedido;

																														


																														$.post("ajax/diseno.php?op=save_notif",{idpedido:idpedido,idusuario:idusuario,fecha_hora:fecha_hora,estatus_pedido:estatus_pedido,idavance_prod:idavance_prod},function(data, status)
																														{
																														data = JSON.parse(data);


																								

																																			$.post("ajax/op.php?op=cargar_historial_avances&id="+idop_detalle_prod+"&area="+area_num,function(r){
																																			$("#tbl_hist_avances").html(r);


																																				$.post("ajax/op.php?op=cargar_excedentes&id="+idop_detalle_prod+"&area="+area_num,function(r){
																																				$("#tbl_excedente").html(r);

																																					bootbox.alert("Avance registrado exitosamente, codigo de validacion: "+ idavance_prod);
																																				});


																																			});

																																				
																																		


																														});


																													});



																														

																												}



																										// });



																									}else{


																													/*$("#modal_avances").modal("hide");
																													var dialog = bootbox.dialog({
																														message: '<p><i class="fa fa-spin fa-spinner"></i> Procesando...</p>'
																													});*/
																																
																												

																																$.post("ajax/op.php?op=cargar_historial_avances&id="+idop_detalle_prod+"&area="+area_num,function(r){
																																$("#tbl_hist_avances").html(r);

																																	$.post("ajax/op.php?op=cargar_excedentes&id="+idop_detalle_prod+"&area="+area_num,function(r){
																																		$("#tbl_excedente").html(r);

																																			bootbox.alert("Avance registrado exitosamente, codigo de validacion: "+ idavance_prod);
																																	});


																																});

																																	
																															
																													


																									}



																								});



																							});

																					});


																			//});



																	}else{



																			$.post("ajax/op.php?op=cargar_campos_avance&id="+idop_detalle_prod+"&area="+area_num+"&idusuario="+idusuario,function(r){
																			$("#box_productos_avance").html(r);


																					//$("#modal_avances").modal("hide");


																					/*var dialog = bootbox.dialog({
																						
																						message: '<p><i class="fa fa-spin fa-spinner"></i> Procesando...</p>'
																					});*/
																								
																					/*dialog.init(function(){
																						setTimeout(function(){
																							dialog.find('.bootbox-body').html('El avance ha sido actualizado con exito.'); 

																								$("#modal_avances").modal("show");*/


																								$.post("ajax/op.php?op=cargar_historial_avances&id="+idop_detalle_prod+"&area="+area_num,function(r){
																								$("#tbl_hist_avances").html(r);

																									$.post("ajax/op.php?op=cargar_excedentes&id="+idop_detalle_prod+"&area="+area_num,function(r){
																									$("#tbl_excedente").html(r);

																										bootbox.alert("Avance registrado exitosamente, codigo de validacion: "+ idavance_prod);
																									});


																								});




																							
																					/* }, 3000);



																					});*/



																			});



																	}



															});


														// });
						
						

													});



												}else{

													bootbox.alert("Es necesario capturar el numero de lote.");
												}


											}else{
												bootbox.alert("Cancelado por el usuario");
											}
											//alert(result);

												


												


										});

											
									}

										
								}else{

									bootbox.alert("La cantidad ingresada es mayor al requerido, verifique y vuelva a intentar");

								}


							}

								

					}else{
						bootbox.alert("Tu usuario no tiene permisos para este registro");
					}


				// });	


			}else{
				bootbox.alert("La cantidad ingresada es invalida");
			}


		}

	// });


	

			

}


function calcular_avance(idop_detalle_prod,idop)
{
	    var cantidad_indep_avance = $("#cantidad_indep_avance"+idop_detalle_prod).val();
	    var requeridos_avance = $("#requeridos_avance"+idop_detalle_prod).val();
	    
		var area_num = $("#area_num").val();

		var idop = idop;

		/*$.post("ajax/op.php?op=consul_depend",{idop:idop,area_num:area_num},function(data, status)
		{
		data = JSON.parse(data);

		});*/

		$.post("ajax/op.php?op=consul_avance_calc",{idop_detalle_prod:idop_detalle_prod,area_num:area_num},function(data, status)
		{
		data = JSON.parse(data);

			//alert(data);

			if (data==null) {
				var avance = 0;
			}else{
				var avance = data.avance;
			}

			if (avance=="") {
				avance=0;
			}

		  var avance_nuevo = parseInt(cantidad_indep_avance)+parseInt(avance);
		  $("#cantidad_avance"+idop_detalle_prod).val(avance_nuevo);


		  if (avance_nuevo>=requeridos_avance) {
		    	//alert("entra");
		    	//$("#btn_save_avance"+idop_detalle_prod).hide();
		    	document.getElementById('btn_save_avance'+idop_detalle_prod).disabled = true;
		    	document.getElementById('option_empaque'+idop_detalle_prod).disabled = false;
		    	$("#eti_activ_btn"+idop_detalle_prod).show();
		    	
		   }else{
		   		document.getElementById('btn_save_avance'+idop_detalle_prod).disabled = false;
		   		document.getElementById('option_empaque'+idop_detalle_prod).disabled = true;
		   }


		});

}

function calcular_avance2(idop_detalle_prod)
{
		var cantidad_avance = $("#cantidad_avance"+idop_detalle_prod).val();
	    var requeridos_avance = $("#requeridos_avance"+idop_detalle_prod).val();

	    if (cantidad_avance>=requeridos_avance) {
	    	//alert("entra");
	    	//$("#btn_save_avance"+idop_detalle_prod).hide();
	    	document.getElementById('btn_save_avance'+idop_detalle_prod).disabled = true;
	    	$("#eti_activ_btn"+idop_detalle_prod).show();
	    	document.getElementById('option_empaque'+idop_detalle_prod).disabled = false;
	    }else{
	    	document.getElementById('btn_save_avance'+idop_detalle_prod).disabled = false;
		   	document.getElementById('option_empaque'+idop_detalle_prod).disabled = true;
	    }
}


function listar_productos_produccion()
{
	
	var select_area_prod = $("#select_area_prod").val();

	//alert(select_area_prod);

	$.post("ajax/op.php?op=listar_productos_produccion&select_area_prod="+select_area_prod,function(r){
	$("#tbl_productos_prod").html(r);			        
	});
}

function mostrar_prod_detalle()
{
	$("#div_op").hide();
	$("#div_panel_prod").show();
}

function listar_productos_op()
{
	//alert("entra");
	$("#div_op").hide();
	$("#div_prod").show();
	var input_fil_area = $("#input_fil_area").val();

	//alert(input_fil_area);

	$.post("ajax/op.php?op=listar_productos_op&id="+input_fil_area,function(r){
	$("#tbl_productos_op").html(r);

			        
	});
}

function listar_productos_op_herreria()
{
	var input_fil_area = 1;
	$.post("ajax/op.php?op=listar_productos_op&id="+input_fil_area,function(r){
	$("#tbl_productos_op").html(r);			        
	});
}

function listar_productos_op_pintura()
{
	var input_fil_area = 2;
	$.post("ajax/op.php?op=listar_productos_op&id="+input_fil_area,function(r){
	$("#tbl_productos_op").html(r);			        
	});
}

function listar_productos_op_plasticos()
{
	var input_fil_area = 3;
	$.post("ajax/op.php?op=listar_productos_op&id="+input_fil_area,function(r){
	$("#tbl_productos_op").html(r);			        
	});
}

function listar_productos_op_ensamble_p()
{
	var input_fil_area = 5;
	$.post("ajax/op.php?op=listar_productos_op&id="+input_fil_area,function(r){
	$("#tbl_productos_op").html(r);			        
	});
}

function listar_productos_op_ensamble_c()
{
	var input_fil_area = 6;
	$.post("ajax/op.php?op=listar_productos_op&id="+input_fil_area,function(r){
	$("#tbl_productos_op").html(r);			        
	});
}

function listar_productos_op_ensamble_m()
{
	var input_fil_area = 7;
	$.post("ajax/op.php?op=listar_productos_op&id="+input_fil_area,function(r){
	$("#tbl_productos_op").html(r);			        
	});
}

function listar_productos_op_horno()
{
	var input_fil_area = 8;
	$.post("ajax/op.php?op=listar_productos_op&id="+input_fil_area,function(r){
	$("#tbl_productos_op").html(r);			        
	});
}

/*function mostrar_op()
{
	$("#div_op").show();
	$("#div_prod").hide();
}*/

function eliminar_area_op(idop_detalle)
{
	var idusuario = $("#idusuario").text();

	if (idusuario==1 || idusuario==8) {




		bootbox.confirm({
		    message: "¿Esta seguro de quitar esta área de la OP?",
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

		        	$.post("ajax/op.php?op=eliminar_area_op",{idop_detalle:idop_detalle},function(data, status)
						{
						data = JSON.parse(data);

						listar_ops_detalles();			
					});	

		        }
		    }
		});

					

	}else{
		bootbox.alert("Ponte en contacto con el administrador del sistema para realizar esta acción");
	}

		
}

function guardar_estatus_empaque(idop_detalle_prod)
{
	var option_empaque = $("#option_empaque"+idop_detalle_prod).val();
	//var cantidad_avance = $("#cantidad_avance"+idop_detalle_prod).val();

	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	//alert(option_empaque);



		$.post("ajax/op.php?op=guardar_estatus_empaque",{idop_detalle_prod:idop_detalle_prod,option_empaque:option_empaque,fecha_hora:fecha_hora},function(data, status)
			{
			data = JSON.parse(data);

			if (option_empaque==1) {

				document.getElementById('btn_save_avance'+idop_detalle_prod).disabled = false;
		
			}

			if (option_empaque==2) {

				document.getElementById('btn_save_avance'+idop_detalle_prod).disabled = true;
		
			}

		});	
}

function abrir_extra(idop_detalle_prod)
{
	$("#modal_registro_extra").modal("show");
	$("#idop_detalle_prod").val(idop_detalle_prod);
}

function guardar_extra()
{
	var idop_detalle_prod =  $("#idop_detalle_prod").val();

	//alert(idop_detalle_prod);

	$.post("ajax/op.php?op=consul_estatus_op2",{idop_detalle_prod:idop_detalle_prod},function(data, status)
	{
	data = JSON.parse(data);

		var estatus_op = data.estatus;

		if (estatus_op==2) {

			bootbox.alert("Esta Orden de Producción esta cancelada");
			
		}else{

			var cantidad_exc =  $("#cantidad_exc").val();
			var area_num = $("#area_num").val();
			var fecha=moment().format('YYYY-MM-DD');
			var hora=moment().format('HH:mm:ss');
			var fecha_hora=fecha+" "+hora;
			var lote_exc = $("#lote_exc").val();
			var coment_exc = $("#coment_exc").val();

			//alert(idop_detalle_prod);

			$.post("ajax/op.php?op=ult_idavance",{idop_detalle_prod:idop_detalle_prod,area_num:area_num},function(data, status)
			{
			data = JSON.parse(data);

			//alert(data);

				var idavance_prod = data.idavance_prod;

				if (idavance_prod>0) {

					$.post("ajax/op.php?op=guardar_extra",{idop_detalle_prod:idop_detalle_prod,idavance_prod:idavance_prod,cantidad_exc:cantidad_exc,area_num:area_num,fecha_hora:fecha_hora,lote_exc:lote_exc,coment_exc:coment_exc},function(data, status)
					{
					data = JSON.parse(data);

						bootbox.alert("Excedente registrado exitosamente");
						$("#idop_detalle_prod").val("");
						$("#modal_registro_extra").modal("hide");

					});

				}else{
					bootbox.alert("Error de registro");
				}

			});

		}


	});
			
}

function actualizar_avances()
{
	var idop_detalle_prod = $("#heard").val();
	var area_num = $("#area_num").val();
	

				$.post("ajax/op.php?op=cargar_historial_avances&id="+idop_detalle_prod+"&area="+area_num,function(r){
				$("#tbl_hist_avances").html(r);


				});

				
}

function actualizar_exc()
{
	var idop_detalle_prod = $("#heard").val();
	var area_num = $("#area_num").val();
	

				$.post("ajax/op.php?op=cargar_excedentes&id="+idop_detalle_prod+"&area="+area_num,function(r){
				$("#tbl_excedente").html(r);


				});

				
}


function mostrar_op()
{
	var idusuario=$("#idusuario").text();
	var no_op_buscar=$("#no_op_buscar").val();
	//var fecha_buscar=$("#fecha_buscar").val();


	$.post("ajax/op.php?op=buscar_idop",{no_op_buscar:no_op_buscar},function(data, status)
	{
	data = JSON.parse(data);

		var idop = data.idop;
		var estatus = data.estatus;
		var estat = "";

		$("#idop").val(idop);

		if (estatus==2) {
			var estat = "Cancelado";
		}
		
		//alert(idop);

		$.post("ajax/op.php?op=mostrar_op&idop="+idop+"&idusuario="+idusuario+"&no_op="+no_op_buscar+"&estat="+estat,function(r){
		$("#box_detalle_op").html(r);

				
	     
		});


	});



		
}


function ver_ultima_op()
{
	var idusuario=$("#idusuario").text();
	var no_op_buscar=$("#no_op_buscar").val();
	//var fecha_buscar=$("#fecha_buscar").val();


	$.post("ajax/op.php?op=contar_ops",function(data, status)
	{
		data = JSON.parse(data);

		var no_op_buscar = data.ult_op;
		var estatus = data.estatus;
		var estat = "";

		if (estatus==2) {
			var estat = "Cancelado";
		}

		//alert(no_op_buscar)


		$.post("ajax/op.php?op=buscar_idop",{no_op_buscar:no_op_buscar},function(data, status)
		{
		data = JSON.parse(data);

			var idop = data.idop;
			//alert(idop);

			$.post("ajax/op.php?op=mostrar_op&idop="+idop+"&idusuario="+idusuario+"&no_op="+no_op_buscar+"&estat="+estat,function(r){
			$("#box_detalle_op").html(r);

					
		     
			});


		});


	});






		



		
}


function contar_errores_op()
{
	$.post("ajax/op.php?op=contar_errores_op",function(data, status)
	{
	data = JSON.parse(data);

	});
}

function reordenar(idop_detalle,prioridad,id)
{
	var select_prioridad = $("#select_prioridad"+idop_detalle).val();

	/*alert(select_prioridad);
	alert(prioridad);*/


	var idop = id;

	$.post("ajax/op.php?op=reordenar",{idop_detalle:idop_detalle,select_prioridad:select_prioridad,prioridad:prioridad,idop:idop},function(data, status)
	{
	data = JSON.parse(data);

		$.post("ajax/op.php?op=listar_ops_detalles&id="+idop,function(r){
		$("#tbl_op_det").html(r);

				        
		});

	});
}



function cancelar_op()
{
	var idop = $("#idop").val();
	var idusuario = $("#idusuario").text();
	//alert(idusuario);

	if (idusuario==1) {

		bootbox.confirm({
			message: "¿Esta seguro de cancelar esta Orden de Producción?",
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

						$.post("ajax/op.php?op=borrar_op",{idop:idop},function(data, status)
						{
							data = JSON.parse(data);

							bootbox.alert("Orden de Producción cancelada exitosamente");

							$("#modal_create_op").modal("hide");

						});

			}
			}
		});
		
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción.");
	}

	
										
}

function activar_op()
{
	var idop = $("#idop").val();
	var idusuario = $("#idusuario").text();
	//alert(idusuario);

	if (idusuario==1) {

		bootbox.confirm({
			message: "¿Esta seguro de activar esta Orden de Producción?",
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

						$.post("ajax/op.php?op=activar_op",{idop:idop},function(data, status)
						{
							data = JSON.parse(data);

							bootbox.alert("Orden de Producción activada exitosamente");

							$("#modal_create_op").modal("hide");

						});

			}
			}
		});
		
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción.");
	}

	
										
}


function rastaurar_op()
{

	var idop = $("#idop").val();
	var idusuario = $("#idusuario").text();

	if (idusuario==1) {


		bootbox.confirm({
		    message: "¿Esta seguro de restaurar esta op?, los avances de producción serán borrados.",
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
		       // console.log('This was logged in the callback: ' + result);

		       if (result==true) {

		       		$.post("ajax/op.php?op=rastaurar_op&idop="+idop,function(r){
					$("#box_result_idpg_detped").html(r);

						bootbox.alert("OP restaurada exitosamente");
							        
					});

		       }
		    }
		});

	}

	//alert(idop);

		
										
}

function quitar_prod_op(idop_detalle_prod,idpg_detped)
{
	var idop = $("#idop").val();

	var idusuario = $("#idusuario").text();

	if (idusuario==1) {

		bootbox.confirm({
		    message: "¿Esta seguro de quitar este producto de la Orden de Producción?",
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

					$.post("ajax/correcciones.php?op=exist_avance",{idop_detalle_prod:idop_detalle_prod},function(data, status)
					{
					data = JSON.parse(data);

						var avance = data.avance;

						if (avance==0) {

							$.post("ajax/op.php?op=quitar_prod_op",{idop_detalle_prod:idop_detalle_prod,idpg_detped:idpg_detped},function(data, status)
							{
							data = JSON.parse(data);


										$.post("ajax/op.php?op=listar_ops2&id="+idop,function(r){
										$("#tbl_op").html(r);					
																				
										});		

							});	
							
						}else{
							bootbox.alert("No se puede eliminar porque esta OP ya tiene avance de produccion");
						}

					});



						
		        }
		    }
		});
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción");
	}

	//alert(idop);
		



				
}


function cancelar_prod()
{
	var idop_prod = $("#heard").val();
	//alert(idop_prod);

					$.post("ajax/op.php?op=cancelar_prod",{idop_prod:idop_prod},function(data, status)
					{
					data = JSON.parse(data);

						bootbox.alert("Producto cancelado exitosamente para esta área");
	

					});
}

function borrar_avance(idavance_prod)
{

	var idusuario = $("#idusuario").text();

	if (idusuario==1 || idusuario==22) {

		bootbox.confirm({
		    message: "¿Esta seguro de eliminar el registro de avance?",
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

		        		$.post("ajax/op.php?op=borrar_avance",{idavance_prod:idavance_prod},function(data, status)
						{
						data = JSON.parse(data);

							bootbox.alert("Avance borrado correctamente");
		

						});
		        }
		    }
		});

	}
					
}

function borrar_excedente(idop_detalle_exc)
{

	var idusuario = $("#idusuario").text();

	if (idusuario==1 || idusuario==22) {

		bootbox.confirm({
		    message: "¿Esta seguro de eliminar el registro de excedente?",
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

		        		$.post("ajax/op.php?op=borrar_excedente",{idop_detalle_exc:idop_detalle_exc},function(data, status)
						{
						data = JSON.parse(data);

							bootbox.alert("Excedente borrado exitosamente");
		

						});
		        }
		    }
		});

	}else{
		bootbox.alert("No tiene permisos para realizar esta acción");
	}
					
}

function upd_cant_avance_prod(idavance_prod)
{
	var cantidad = $("#cant_entregada"+idavance_prod).val();

	//alert(cantidad);

						$.post("ajax/op.php?op=upd_cant_avance_prod",{idavance_prod:idavance_prod,cantidad:cantidad},function(data, status)
						{
						data = JSON.parse(data);

							bootbox.alert("Avance editado correctamente");
		

						});
}

function addProdOp(){
	$("#modal_agregar_prod_op").modal("show");

		$.post("ajax/op.php?op=addProdOp",function(r){
		$("#div_prod_sin_op").html(r);
					
		});
}

function addProd_op(idpg_detped){
	console.log("idpg_detped");
	console.log(idpg_detped);
	
	var idop = $("#idop").val();
	var no_control = $("#no_control_p"+idpg_detped).text();
	var codigo = $("#codigo_p"+idpg_detped).text();
	var descripcion = $("#descripcion_p"+idpg_detped).text();
	var empaque = $("#empaque_p"+idpg_detped).text();
	var cantidad = $("#cantidad_p"+idpg_detped).text();
	var fecha_pedido = $("#fecha_pedido_p"+idpg_detped).text();
	var fecha_entrega = $("#fecha_entrega_p"+idpg_detped).text();
	var observaciones = $("#observaciones_p"+idpg_detped).text();
	var estatus = $("#estatus_p"+idpg_detped).text();
	var medida = $("#medida_p"+idpg_detped).text();
	var color = $("#color_p"+idpg_detped).text();
	var iddetalle_pedido = $("#iddetalle_pedido_p"+idpg_detped).text();

	//alert(idop);

	bootbox.confirm({
		message: "¿Esta seguro de agregar este producto a la OP?",
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

				
				$.post("ajax/op.php?op=addProd_op",{
					idop:idop,
					idpg_detped:idpg_detped,
					no_control:no_control,
					codigo:codigo,
					descripcion:descripcion,
					empaque:empaque,
					cantidad:cantidad,
					fecha_pedido:fecha_pedido,
					fecha_entrega:fecha_entrega,
					observaciones:observaciones,
					estatus:estatus,
					medida:medida,
					color:color,
					iddetalle_pedido:iddetalle_pedido
				},function(data, status)
				{
					data = JSON.parse(data);
					bootbox.alert("Producto agregado a OP");
				});




			}
		}
	});

	
}	

init();