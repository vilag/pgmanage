function init()
{
	// location.href ="https://pgmanage.host/susp.php";
	//listar_pedidos();
	llenar_anios()	
	
}


function listar_pedidos()
{	
	var idusuario=$("#idusuario").text();

	$.post("ajax/welcome.php?op=listar_pedidos&id="+idusuario,function(r){
	$("#box_avance").html(r);

			        
	});
}


function listar_prod_detalles(idpg_pedidos)
{

	$.post("ajax/welcome.php?op=listar_prod_detalles&id="+idpg_pedidos,function(r){
	$("#tbl_prod_detalle"+idpg_pedidos).html(r);

			        
	});
}

function buscar_control()
{
	var idusuario=$("#idusuario").text();
	var no_control=$("#no_control").val();

	$.post("ajax/welcome.php?op=buscar_control&id="+idusuario+"&control="+no_control,function(r){
	$("#box_avance").html(r);

			        
	});
}

function set_idproducto()
{
	var id1=1;
	var id2=4300;

	/*alert(id1);
	alert(id2);*/

	$.post("ajax/diseno.php?op=set_idproducto",{id1:id1,id2:id2},function(data, status)
	{
		data = JSON.parse(data);

		alert("set_ok");

	});
}



function llenar_anios()
{
	$.post("ajax/welcome.php?op=llenar_anios",function(r){
	$("#anio_asign").html(r);

		$.post("ajax/welcome.php?op=consul_anio_actual",function(data, status)
		{
		data = JSON.parse(data);

			var ultimo_anio = data.ultimo_anio;
			$("#anio_asign").val(ultimo_anio);

			$.post("ajax/welcome.php?op=llenar_mes&anio="+ultimo_anio,function(r){
			$("#mes_asign").html(r);


				$.post("ajax/welcome.php?op=consul_mes_actual",{ultimo_anio:ultimo_anio},function(data, status)
				{
				data = JSON.parse(data);

				var ultimo_mes = data.ultimo_mes;

				if (ultimo_mes==1) {
					var text_mes = "Enero";
				}
				if (ultimo_mes==2) {
					var text_mes = "Febrero";
				}
				if (ultimo_mes==3) {
					var text_mes = "Marzo";
				}
				if (ultimo_mes==4) {
					var text_mes = "Abril";
				}
				if (ultimo_mes==5) {
					var text_mes = "Mayo";
				}
				if (ultimo_mes==6) {
					var text_mes = "Junio";
				}
				if (ultimo_mes==7) {
					var text_mes = "Julio";
				}
				if (ultimo_mes==8) {
					var text_mes = "Agosto";
				}
				if (ultimo_mes==9) {
					var text_mes = "Septiembre";
				}
				if (ultimo_mes==10) {
					var text_mes = "Octubre";
				}
				if (ultimo_mes==11) {
					var text_mes = "Noviembre";
				}
				if (ultimo_mes==12) {
					var text_mes = "Diciembre";
				}

					$("#mes_asign").val(data.ultimo_mes);

					$.post("ajax/welcome.php?op=calc_ind_prod",{ultimo_anio:ultimo_anio,ultimo_mes:ultimo_mes},function(data, status)
					{
						data = JSON.parse(data);

						var pedidos_vencim = data.pedidos_vencim;
						var en_tiempo = data.en_tiempo;
						//var num_vencim = parseInt(num_vencim_fab)+parseInt(num_vencim_prod);
						//alert(num_vencim);
						$("#num_asign").text(pedidos_vencim);
						$("#num_vencidos").text(pedidos_vencim-en_tiempo);
						//var total_vencim_mes = data.total_vencim_mes;
						//alert(total_vencim_mes);
						$("#num_entiempo").text(en_tiempo);

						var porc_ind_prod = (parseInt(en_tiempo)/parseInt(pedidos_vencim))*100;
						var porc_ind_prod = Math.round(porc_ind_prod).toFixed(1)

						$("#porc_ind").text(porc_ind_prod+"%");
						$("#eti_fecha_ind").text(text_mes+" "+ultimo_anio);
						$("#eti_fecha_tbl_prod").text(text_mes+" "+ultimo_anio);
						$("#eti_fecha_tbl_emb").text(text_mes+" "+ultimo_anio);
						$("#eti_anio").text(" "+ultimo_anio);
						$("#mes_selec_emb").text(text_mes);
						$("#mes_selec_prod").text(text_mes);
						
						//alert(ultimo_anio);
						$.post("ajax/welcome.php?op=calc_ind_emb",{ultimo_anio:ultimo_anio,ultimo_mes:ultimo_mes},function(data, status)
						{
						data = JSON.parse(data);

							var pedidos_entregar = data.pedidos_entregar;
							var pedidos_term_entiempo = data.pedidos_term_entiempo;
							var pedidos_term_fueratiempo = data.pedidos_term_fueratiempo;
							var coment_det_in = data.coment_det_in;
							
							//alert(data.pedidos_entregar);
							//alert(data.pedidos_term_entiempo);

							$("#num_entregar").text(pedidos_entregar);
							$("#num_fuera_tiempo").text(pedidos_term_fueratiempo);
							$("#num_entiempo_emb").text(pedidos_term_entiempo);
							$("#num_det_ent").text(coment_det_in);

							var porc_ind_emb = ((parseInt(pedidos_term_entiempo)+parseInt(coment_det_in))/parseInt(pedidos_entregar))*100;
							var porc_ind_emb = Math.round(porc_ind_emb).toFixed(1)

							var idusuario = $("#idusuario").text();

							//if (idusuario==1) {
								$("#porc_ind_emb").text(porc_ind_emb+"%");

								var consec_anio = $("#consec_anio").val();

								$.post("ajax/welcome.php?op=crear_box_grafica&anio="+ultimo_anio+"&consec_anio="+consec_anio,function(r){
								$("#chart_pedidos").html(r);

									$.post("ajax/welcome.php?op=crear_box_grafica_pe&anio="+ultimo_anio+"&consec_anio="+consec_anio,function(r){
									$("#chart_prod_emb").html(r);


										$("#anio_grafica_ped").val(ultimo_anio+consec_anio);

										consul_info_pedidos();
										consul_info_grafica1();
										
										grafico();


									});


										

								});


									

						});


					});

				});

			});

			
			

		});
		        
	});
}

function select_anio()
{
	var ultimo_anio = $("#anio_asign").val();

	var anio_grafica_ped = $("#anio_grafica_ped").val();
	$("#grafica_pedido"+anio_grafica_ped).hide();

	var consec_anio = $("#consec_anio").val();
	var consec_anio = parseInt(consec_anio)+1;
	$("#consec_anio").val(consec_anio);

    $.post("ajax/welcome.php?op=crear_box_grafica&anio="+ultimo_anio+"&consec_anio="+consec_anio,function(r){
	$("#chart_pedidos").html(r);

		$("#anio_grafica_ped").val(ultimo_anio+consec_anio);

		/*var consec_anio = parseInt(consec_anio)+1;
		$("#consec_anio").val(consec_anio);	*/		


			$.post("ajax/welcome.php?op=llenar_mes&anio="+ultimo_anio,function(r){
			$("#mes_asign").html(r);


				$.post("ajax/welcome.php?op=consul_mes_actual",{ultimo_anio:ultimo_anio},function(data, status)
				{
				data = JSON.parse(data);

				var ultimo_mes = data.ultimo_mes;

				if (ultimo_mes==1) {
					var text_mes = "Enero";
				}
				if (ultimo_mes==2) {
					var text_mes = "Febrero";
				}
				if (ultimo_mes==3) {
					var text_mes = "Marzo";
				}
				if (ultimo_mes==4) {
					var text_mes = "Abril";
				}
				if (ultimo_mes==5) {
					var text_mes = "Mayo";
				}
				if (ultimo_mes==6) {
					var text_mes = "Junio";
				}
				if (ultimo_mes==7) {
					var text_mes = "Julio";
				}
				if (ultimo_mes==8) {
					var text_mes = "Agosto";
				}
				if (ultimo_mes==9) {
					var text_mes = "Septiembre";
				}
				if (ultimo_mes==10) {
					var text_mes = "Octubre";
				}
				if (ultimo_mes==11) {
					var text_mes = "Noviembre";
				}
				if (ultimo_mes==12) {
					var text_mes = "Diciembre";
				}

					$("#mes_asign").val(data.ultimo_mes);

					$.post("ajax/welcome.php?op=calc_ind_prod",{ultimo_anio:ultimo_anio,ultimo_mes:ultimo_mes},function(data, status)
					{
						data = JSON.parse(data);

						var pedidos_vencim = data.pedidos_vencim;
						var en_tiempo = data.en_tiempo;
						//var num_vencim = parseInt(num_vencim_fab)+parseInt(num_vencim_prod);
						//alert(num_vencim);
						$("#num_asign").text(pedidos_vencim);
						$("#num_vencidos").text(pedidos_vencim-en_tiempo);
						//var total_vencim_mes = data.total_vencim_mes;
						//alert(total_vencim_mes);
						$("#num_entiempo").text(en_tiempo);

						var porc_ind_prod = (parseInt(en_tiempo)/parseInt(pedidos_vencim))*100;
						var porc_ind_prod = Math.round(porc_ind_prod).toFixed(1)

						$("#porc_ind").text(porc_ind_prod+"%");
						$("#eti_fecha_ind").text(text_mes+" "+ultimo_anio);
						$("#eti_fecha_tbl_prod").text(text_mes+" "+ultimo_anio);
						$("#eti_fecha_tbl_emb").text(text_mes+" "+ultimo_anio);
						$("#eti_anio").text(" "+ultimo_anio);
						$("#mes_selec_emb").text(text_mes);
						$("#mes_selec_prod").text(text_mes);
						//listar_pedidos_ind_prod();


						$.post("ajax/welcome.php?op=calc_ind_emb",{ultimo_anio:ultimo_anio,ultimo_mes:ultimo_mes},function(data, status)
						{
						data = JSON.parse(data);

							var pedidos_entregar = data.pedidos_entregar;
							var pedidos_term_entiempo = data.pedidos_term_entiempo;
							var pedidos_term_fueratiempo = data.pedidos_term_fueratiempo;
							var coment_det_in = data.coment_det_in;

							//alert(data.pedidos_entregar);
							//alert(data.pedidos_term_entiempo);

							$("#num_entregar").text(pedidos_entregar);
							$("#num_fuera_tiempo").text(pedidos_term_fueratiempo);
							$("#num_entiempo_emb").text(pedidos_term_entiempo);
							$("#num_det_ent").text(coment_det_in);

							var porc_ind_emb = ((parseInt(pedidos_term_entiempo)+parseInt(coment_det_in))/parseInt(pedidos_entregar))*100;
							var porc_ind_emb = Math.round(porc_ind_emb).toFixed(1)

							var idusuario = $("#idusuario").text();

							//if (idusuario==1) {
								$("#porc_ind_emb").text(porc_ind_emb+"%");


									$.post("ajax/welcome.php?op=crear_box_grafica_pe&anio="+ultimo_anio+"&consec_anio="+consec_anio,function(r){
									$("#chart_prod_emb").html(r);

										consul_info_pedidos();
										consul_info_grafica1();
										
										grafico();


									});

								
						});
					});

				});

			});			

	});

			


}

function select_mes()
{
	var ultimo_anio = $("#anio_asign").val();
	var ultimo_mes = $("#mes_asign").val();

				if (ultimo_mes==1) {
					var text_mes = "Enero";
				}
				if (ultimo_mes==2) {
					var text_mes = "Febrero";
				}
				if (ultimo_mes==3) {
					var text_mes = "Marzo";
				}
				if (ultimo_mes==4) {
					var text_mes = "Abril";
				}
				if (ultimo_mes==5) {
					var text_mes = "Mayo";
				}
				if (ultimo_mes==6) {
					var text_mes = "Junio";
				}
				if (ultimo_mes==7) {
					var text_mes = "Julio";
				}
				if (ultimo_mes==8) {
					var text_mes = "Agosto";
				}
				if (ultimo_mes==9) {
					var text_mes = "Septiembre";
				}
				if (ultimo_mes==10) {
					var text_mes = "Octubre";
				}
				if (ultimo_mes==11) {
					var text_mes = "Noviembre";
				}
				if (ultimo_mes==12) {
					var text_mes = "Diciembre";
				}

					$.post("ajax/welcome.php?op=calc_ind_prod",{ultimo_anio:ultimo_anio,ultimo_mes:ultimo_mes},function(data, status)
					{
						data = JSON.parse(data);

						var pedidos_vencim = data.pedidos_vencim;
						var en_tiempo = data.en_tiempo;
						//var num_vencim = parseInt(num_vencim_fab)+parseInt(num_vencim_prod);
						//alert(num_vencim);
						$("#num_asign").text(pedidos_vencim);
						$("#num_vencidos").text(pedidos_vencim-en_tiempo);
						//var total_vencim_mes = data.total_vencim_mes;
						//alert(total_vencim_mes);
						$("#num_entiempo").text(en_tiempo);

						var porc_ind_prod = (parseInt(en_tiempo)/parseInt(pedidos_vencim))*100;
						var porc_ind_prod = Math.round(porc_ind_prod).toFixed(1)

						$("#porc_ind").text(porc_ind_prod+"%");
						$("#eti_fecha_ind").text(text_mes+" "+ultimo_anio);
						$("#eti_fecha_tbl_prod").text(text_mes+" "+ultimo_anio);
						$("#eti_fecha_tbl_emb").text(text_mes+" "+ultimo_anio);
						$("#eti_anio").text(" "+ultimo_anio);
						$("#mes_selec_emb").text(text_mes);
						$("#mes_selec_prod").text(text_mes);
						//listar_pedidos_ind_prod();

						$.post("ajax/welcome.php?op=calc_ind_emb",{ultimo_anio:ultimo_anio,ultimo_mes:ultimo_mes},function(data, status)
						{
						data = JSON.parse(data);

							var pedidos_entregar = data.pedidos_entregar;
							var pedidos_term_entiempo = data.pedidos_term_entiempo;
							var pedidos_term_fueratiempo = data.pedidos_term_fueratiempo;
							var coment_det_in = data.coment_det_in;
							
							//alert(data.pedidos_entregar);
							//alert(data.pedidos_term_entiempo);

							$("#num_entregar").text(pedidos_entregar);
							$("#num_fuera_tiempo").text(pedidos_term_fueratiempo);
							$("#num_entiempo_emb").text(pedidos_term_entiempo);
							$("#num_det_ent").text(coment_det_in);

							var porc_ind_emb = ((parseInt(pedidos_term_entiempo)+parseInt(coment_det_in))/parseInt(pedidos_entregar))*100;
							var porc_ind_emb = Math.round(porc_ind_emb).toFixed(1)

							var idusuario = $("#idusuario").text();

								$("#porc_ind_emb").text(porc_ind_emb+"%");
						});
					});
}

function listar_pedidos_ind_prod()
{
	var ultimo_anio = $("#anio_asign").val();
	var ultimo_mes = $("#mes_asign").val();
	var estat_anios = $("#estat_anios").val();

	$("#div_tbl1").show();
	$("#div_tbl2").hide();

	$.post("ajax/welcome.php?op=listar_pedidos_ind_prod&anio="+ultimo_anio+"&mes="+ultimo_mes+"&estat_anios="+estat_anios,function(r){
	$("#tbl_pedidos_ind_prod").html(r);

	});


}


function listar_pedidos_ind_emb()
{
	var ultimo_anio = $("#anio_asign").val();
	var ultimo_mes = $("#mes_asign").val();
	var estat_anios = $("#estat_anios2").val();

	$.post("ajax/welcome.php?op=listar_pedidos_ind_emb&anio="+ultimo_anio+"&mes="+ultimo_mes+"&estat_anios="+estat_anios,function(r){
	$("#tbl_pedidos_ind_emb").html(r);

	});
}


function consul_info_grafica1()
{
	var anio = $("#anio_asign").val();
	var consec_anio = $("#consec_anio").val();

	$.post("ajax/welcome.php?op=consul_info_grafica1",{anio:anio},function(data, status)
	{
		data = JSON.parse(data);

		//chart_ped.updateSeries ();

		var num_pedidos_mes1 = data.ene1;
		var num_pedidos_mes2 = data.feb1;
		var num_pedidos_mes3 = data.mar1;
		var num_pedidos_mes4 = data.abr1;
		var num_pedidos_mes5 = data.may1;
		var num_pedidos_mes6 = data.jun1;
		var num_pedidos_mes7 = data.jul1;
		var num_pedidos_mes8 = data.ago1;
		var num_pedidos_mes9 = data.sep1;
		var num_pedidos_mes10 = data.oct1;
		var num_pedidos_mes11 = data.nov1;
		var num_pedidos_mes12 = data.dic1;

		//alert(num_pedidos_mes1);

		$.post("ajax/welcome.php?op=consul_info_grafica2",{anio:anio},function(data, status)
		{
			data = JSON.parse(data);


			var num_pedidos_mes_zuno1 = data.ene2;
			var num_pedidos_mes_zuno2 = data.feb2;
			var num_pedidos_mes_zuno3 = data.mar2;
			var num_pedidos_mes_zuno4 = data.abr2;
			var num_pedidos_mes_zuno5 = data.may2;
			var num_pedidos_mes_zuno6 = data.jun2;
			var num_pedidos_mes_zuno7 = data.jul2;
			var num_pedidos_mes_zuno8 = data.ago2;
			var num_pedidos_mes_zuno9 = data.sep2;
			var num_pedidos_mes_zuno10 = data.oct2;
			var num_pedidos_mes_zuno11 = data.nov2;
			var num_pedidos_mes_zuno12 = data.dic2;


			$.post("ajax/welcome.php?op=consul_info_grafica3",{anio:anio},function(data, status)
			{
				data = JSON.parse(data);


				var num_pedidos_mes_ajm1 = data.ene3;
				var num_pedidos_mes_ajm2 = data.feb3;
				var num_pedidos_mes_ajm3 = data.mar3;
				var num_pedidos_mes_ajm4 = data.abr3;
				var num_pedidos_mes_ajm5 = data.may3;
				var num_pedidos_mes_ajm6 = data.jun3;
				var num_pedidos_mes_ajm7 = data.jul3;
				var num_pedidos_mes_ajm8 = data.ago3;
				var num_pedidos_mes_ajm9 = data.sep3;
				var num_pedidos_mes_ajm10 = data.oct3;
				var num_pedidos_mes_ajm11 = data.nov3;
				var num_pedidos_mes_ajm12 = data.dic3;



				var max_graf =  Math.max(
					num_pedidos_mes_zuno1,num_pedidos_mes_zuno2,num_pedidos_mes_zuno3,num_pedidos_mes_zuno4,num_pedidos_mes_zuno5,num_pedidos_mes_zuno6,num_pedidos_mes_zuno7,num_pedidos_mes_zuno8,num_pedidos_mes_zuno9,num_pedidos_mes_zuno10,num_pedidos_mes_zuno11,num_pedidos_mes_zuno12,
					num_pedidos_mes_ajm1,num_pedidos_mes_ajm2,num_pedidos_mes_ajm3,num_pedidos_mes_ajm4,num_pedidos_mes_ajm5,num_pedidos_mes_ajm6,num_pedidos_mes_ajm7,num_pedidos_mes_ajm8,num_pedidos_mes_ajm9,num_pedidos_mes_ajm10,num_pedidos_mes_ajm11,num_pedidos_mes_ajm12,
					num_pedidos_mes1, num_pedidos_mes2, num_pedidos_mes3, num_pedidos_mes4, num_pedidos_mes5, num_pedidos_mes6, num_pedidos_mes7, num_pedidos_mes8, num_pedidos_mes9, num_pedidos_mes10, num_pedidos_mes11, num_pedidos_mes12
					);

				var mes_actual_graf=moment().format('MM');



				 var options = {
		          series: [
		          
		          {
		            name: "TOTAL DE PEDIDOS",
		            data: [num_pedidos_mes1, num_pedidos_mes2, num_pedidos_mes3, num_pedidos_mes4, num_pedidos_mes5, num_pedidos_mes6, num_pedidos_mes7, num_pedidos_mes8, num_pedidos_mes9, num_pedidos_mes10, num_pedidos_mes11, num_pedidos_mes12]
		          },
		          {
		            name: "ZUNO",
		            data: [num_pedidos_mes_zuno1,num_pedidos_mes_zuno2,num_pedidos_mes_zuno3,num_pedidos_mes_zuno4,num_pedidos_mes_zuno5,num_pedidos_mes_zuno6,num_pedidos_mes_zuno7,num_pedidos_mes_zuno8,num_pedidos_mes_zuno9,num_pedidos_mes_zuno10,num_pedidos_mes_zuno11,num_pedidos_mes_zuno12]
		          },
		          {
		            name: "AJM",
		            data: [num_pedidos_mes_ajm1,num_pedidos_mes_ajm2,num_pedidos_mes_ajm3,num_pedidos_mes_ajm4,num_pedidos_mes_ajm5,num_pedidos_mes_ajm6,num_pedidos_mes_ajm7,num_pedidos_mes_ajm8,num_pedidos_mes_ajm9,num_pedidos_mes_ajm10,num_pedidos_mes_ajm11,num_pedidos_mes_ajm12]
		          }
		        ],
		          chart: {
		          height: 350,
		          type: 'line',
		          dropShadow: {
		            enabled: true,
		            color: '#000',
		            top: 18,
		            left: 7,
		            blur: 10,
		            opacity: 0.2
		          },
		          toolbar: {
		            show: false
		          }
		        },
		        colors: ['#03912A', '#EE8609','#1282F1'],
		        dataLabels: {
		          enabled: true,
		        },
		        stroke: {
		          curve: 'smooth'
		        },
		        title: {
		          text: 'Pedidos ingresados al mes',
		          align: 'left'
		        },
		        grid: {
		          borderColor: '#e7e7e7',
		          row: {
		            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
		            opacity: 0.5
		          },
		        },
		        markers: {
		          size: 1
		        },
		        xaxis: {
		          categories: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		          title: {
		            text: anio
		          }
		        },
		        yaxis: {
		          title: {
		            text: 'Numero de pedidos'
		          },
		          min: 1,
		          max: max_graf
		        },
		        legend: {
		          position: 'top',
		          horizontalAlign: 'right',
		          floating: true,
		          offsetY: -25,
		          offsetX: -5
		        }
		        };

		      
		        var chart_ped = new ApexCharts(document.querySelector("#grafica_pedido"+anio+consec_anio), options);
		        //chart_ped.updateSeries();
		        chart_ped.render();
		        //grafico();

			});


		});





	});

}

function grafico()
{
	var anio = $("#anio_asign").val();
	var consec_anio = $("#consec_anio").val();
	//var ultimo_anio = $("#anio_asign").val();
	/*$.post("ajax/welcome.php?op=consul_anio_actual",function(data, status)
	{
		data = JSON.parse(data);

		var ultimo_anio = data.ultimo_anio;*/
		//alert(anio)

		var ultimo_anio = anio;
		var mes_actual=moment().format('MM');

					$.post("ajax/welcome.php?op=calc_ind_prod_grafica",{ultimo_anio:ultimo_anio},function(data, status)
					{
						data = JSON.parse(data);

						

						var pedidos_vencim1 = data.pedidos_vencim1;
						var en_tiempo1 = data.en_tiempo1;
						if (pedidos_vencim1==0 && en_tiempo1==0) {
							var porc_ind_prod1=0;
						}else{
							
							var mes_grafica = 1;
							if (mes_grafica<=mes_actual) {
								var porc_ind_prod1 = (parseInt(en_tiempo1)/parseInt(pedidos_vencim1))*100;
								var porc_ind_prod1 = Math.round(porc_ind_prod1).toFixed(1);
							}else{
								var porc_ind_prod1=0;
							}

						}

						var pedidos_vencim2 = data.pedidos_vencim2;
						var en_tiempo2 = data.en_tiempo2;
						if (pedidos_vencim2==0 && en_tiempo2==0) {
							var porc_ind_prod2=0;
						}else{
							var mes_grafica = 2;
							if (mes_grafica<=mes_actual) {
								var porc_ind_prod2 = (parseInt(en_tiempo2)/parseInt(pedidos_vencim2))*100;
								var porc_ind_prod2 = Math.round(porc_ind_prod2).toFixed(1);
							}else{
								var porc_ind_prod2=0;
							}
						}

						var pedidos_vencim3 = data.pedidos_vencim3;
						var en_tiempo3 = data.en_tiempo3;
						if (pedidos_vencim3==0 && en_tiempo3==0) {
							var porc_ind_prod3=0;
						}else{
							var mes_grafica = 3;
							if (mes_grafica<=mes_actual) {
								var porc_ind_prod3 = (parseInt(en_tiempo3)/parseInt(pedidos_vencim3))*100;
								var porc_ind_prod3 = Math.round(porc_ind_prod3).toFixed(1);
							}else{
								var porc_ind_prod3=0;
							}
						}

						var pedidos_vencim4 = data.pedidos_vencim4;
						var en_tiempo4 = data.en_tiempo4;
						if (pedidos_vencim4==0 && en_tiempo4==0) {
							var porc_ind_prod4=0;
						}else{
							var mes_grafica = 4;
							if (mes_grafica<=mes_actual) {
								var porc_ind_prod4 = (parseInt(en_tiempo4)/parseInt(pedidos_vencim4))*100;
								var porc_ind_prod4 = Math.round(porc_ind_prod4).toFixed(1);
							}else{
								var porc_ind_prod4=0;
							}
						}

						//alert(porc_ind_prod4);

						var pedidos_vencim5 = data.pedidos_vencim5;
						var en_tiempo5 = data.en_tiempo5;
						if (pedidos_vencim5==0 && en_tiempo5==0) {
							var porc_ind_prod5=0;
						}else{
							var mes_grafica = 5;
							if (mes_grafica<=mes_actual) {
								var porc_ind_prod5 = (parseInt(en_tiempo5)/parseInt(pedidos_vencim5))*100;
								var porc_ind_prod5 = Math.round(porc_ind_prod5).toFixed(1);
							}else{
								var porc_ind_prod5=0;
							}
						}

						var pedidos_vencim6 = data.pedidos_vencim6;
						var en_tiempo6 = data.en_tiempo6;
						if (pedidos_vencim6==0 && en_tiempo6==0) {
							var porc_ind_prod6=0;
						}else{
							var mes_grafica = 6;
							if (mes_grafica<=mes_actual) {
								var porc_ind_prod6 = (parseInt(en_tiempo6)/parseInt(pedidos_vencim6))*100;
								var porc_ind_prod6 = Math.round(porc_ind_prod6).toFixed(1);
							}else{
								var porc_ind_prod6=0;
							}
						}

						var pedidos_vencim7 = data.pedidos_vencim7;
						var en_tiempo7 = data.en_tiempo7;
						if (pedidos_vencim7==0 && en_tiempo7==0) {
							var porc_ind_prod7=0;
						}else{
							var mes_grafica = 7;
							if (mes_grafica<=mes_actual) {
								var porc_ind_prod7 = (parseInt(en_tiempo7)/parseInt(pedidos_vencim7))*100;
								var porc_ind_prod7 = Math.round(porc_ind_prod7).toFixed(1);
							}else{
								var porc_ind_prod7=0;
							}

						}

						var pedidos_vencim8 = data.pedidos_vencim8;
						var en_tiempo8 = data.en_tiempo8;
						if (pedidos_vencim8==0 && en_tiempo8==0) {
							var porc_ind_prod8=0;
						}else{
							var mes_grafica = 8;
							if (mes_grafica<=mes_actual) {
								var porc_ind_prod8 = (parseInt(en_tiempo8)/parseInt(pedidos_vencim8))*100;
								var porc_ind_prod8 = Math.round(porc_ind_prod8).toFixed(1);
							}else{
								var porc_ind_prod8=0;
							}
						}

						var pedidos_vencim9 = data.pedidos_vencim9;
						var en_tiempo9 = data.en_tiempo9;
						if (pedidos_vencim9==0 && en_tiempo9==0) {
							var porc_ind_prod9=0;
						}else{
							var mes_grafica = 9;
							if (mes_grafica<=mes_actual) {
								var porc_ind_prod9 = (parseInt(en_tiempo9)/parseInt(pedidos_vencim9))*100;
								var porc_ind_prod9 = Math.round(porc_ind_prod9).toFixed(1);
							}else{
								var porc_ind_prod9=0;
							}
						}

						var pedidos_vencim10 = data.pedidos_vencim10;
						var en_tiempo10 = data.en_tiempo10;
						if (pedidos_vencim10==0 && en_tiempo10==0) {
							var porc_ind_prod10=0;
						}else{
							var mes_grafica = 10;
							if (mes_grafica<=mes_actual) {
								var porc_ind_prod10 = (parseInt(en_tiempo10)/parseInt(pedidos_vencim10))*100;
								var porc_ind_prod10 = Math.round(porc_ind_prod10).toFixed(1);
							}else{
								var porc_ind_prod10=0;
							}
						}

						var pedidos_vencim11 = data.pedidos_vencim11;
						var en_tiempo11 = data.en_tiempo11;
						if (pedidos_vencim11==0 && en_tiempo11==0) {
							var porc_ind_prod11=0;
						}else{
							var mes_grafica = 11;
							if (mes_grafica<=mes_actual) {
								var porc_ind_prod11 = (parseInt(en_tiempo11)/parseInt(pedidos_vencim11))*100;
								var porc_ind_prod11 = Math.round(porc_ind_prod11).toFixed(1);
							}else{
								var porc_ind_prod11=0;
							}
						}

						var pedidos_vencim12 = data.pedidos_vencim12;
						var en_tiempo12 = data.en_tiempo12;
						if (pedidos_vencim12==0 && en_tiempo12==0) {
							var porc_ind_prod12=0;
							
						}else{
							var mes_grafica = 12;
							if (mes_grafica<=mes_actual) {
								var porc_ind_prod12 = (parseInt(en_tiempo12)/parseInt(pedidos_vencim12))*100;
								var porc_ind_prod12 = Math.round(porc_ind_prod12).toFixed(1);
							}else{
								var porc_ind_prod12=0;
							}
						}



						var options = {
				          series: [{
				          name: 'Fabricados en tiempo',
				          data: [porc_ind_prod1, porc_ind_prod2, porc_ind_prod3, porc_ind_prod4, porc_ind_prod5, porc_ind_prod6, porc_ind_prod7, porc_ind_prod8, porc_ind_prod9,porc_ind_prod10,porc_ind_prod11,porc_ind_prod12]
				        }],
				          chart: {
				          height: 350,
				          type: 'bar',
				        },
				        plotOptions: {
				          bar: {
				            borderRadius: 10,
				            dataLabels: {
				              position: 'top', // top, center, bottom
				            },
				          }
				        },
				        dataLabels: {
				          enabled: true,
				          formatter: function (val) {
				            return val + "%";
				          },
				          offsetY: -20,
				          style: {
				            fontSize: '12px',
				            colors: ["#304758"]
				          }
				        },
				        
				        xaxis: {
				          categories: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
				          position: 'top',
				          axisBorder: {
				            show: false
				          },
				          axisTicks: {
				            show: false
				          },
				          crosshairs: {
				            fill: {
				              type: 'gradient',
				              gradient: {
				                colorFrom: '#D8E3F0',
				                colorTo: '#BED1E6',
				                stops: [0, 100],
				                opacityFrom: 0.4,
				                opacityTo: 0.5,
				              }
				            }
				          },
				          tooltip: {
				            enabled: false,
				          }
				        },
				        yaxis: {
				          axisBorder: {
				            show: false
				          },
				          axisTicks: {
				            show: false,
				          },
				          labels: {
				            show: false,
				            formatter: function (val) {
				              return val + "%";
				            }
				          }
				        
				        },
				        title: {
				          text: 'Cumplimiento de producción en tiempo',
				          floating: true,
				          offsetY: 330,
				          align: 'center',
				          style: {
				            color: '#444'
				          }
				        }
				        };

				       /* var anio = $("#anio_asign").val();
						var consec_anio = $("#consec_anio").val();*/

				        var chart_prod = new ApexCharts(document.querySelector("#chart_prod"+anio+consec_anio), options);
				        chart_prod.render();



				        $.post("ajax/welcome.php?op=calc_ind_emb_grafica",{ultimo_anio:ultimo_anio},function(data, status)
						{
							data = JSON.parse(data);

									//alert(data.pedidos_entregar1);
									//alert(data.pedidos_term_entiempo1);
									var pedidos_entregar1 = data.pedidos_entregar1;
									var pedidos_term_entiempo1 = data.pedidos_term_entiempo1;
									if (pedidos_entregar1==0 && pedidos_term_entiempo1==0) {
										var porc_ind_emb1=0;
									}else{	
										var mes_grafica_emb1 = 1;
										if (mes_grafica_emb1<=mes_actual) {
											var porc_ind_emb1 = (parseInt(pedidos_term_entiempo1)/parseInt(pedidos_entregar1))*100;
											var porc_ind_emb1 = Math.round(porc_ind_emb1).toFixed(1);
										}else{
											var porc_ind_emb1=0;
										}
									}

									var pedidos_entregar2 = data.pedidos_entregar2;
									var pedidos_term_entiempo2 = data.pedidos_term_entiempo2;
									if (pedidos_entregar2==0 && pedidos_term_entiempo2==0) {
										var porc_ind_emb2=0;
									}else{	
										var mes_grafica_emb2 = 2;
										if (mes_grafica_emb2<=mes_actual) {
											var porc_ind_emb2 = (parseInt(pedidos_term_entiempo2)/parseInt(pedidos_entregar2))*100;
											var porc_ind_emb2 = Math.round(porc_ind_emb2).toFixed(1);
										}else{
											var porc_ind_emb2=0;
										}
									}

									var pedidos_entregar3 = data.pedidos_entregar3;
									var pedidos_term_entiempo3 = data.pedidos_term_entiempo3;
									if (pedidos_entregar3==0 && pedidos_term_entiempo3==0) {
										var porc_ind_emb3=0;
									}else{	
										var mes_grafica_emb3 = 2;
										if (mes_grafica_emb3<=mes_actual) {
											var porc_ind_emb3 = (parseInt(pedidos_term_entiempo3)/parseInt(pedidos_entregar3))*100;
											var porc_ind_emb3 = Math.round(porc_ind_emb3).toFixed(1);
										}else{
											var porc_ind_emb3=0;
										}
									}

									var pedidos_entregar4 = data.pedidos_entregar4;
									var pedidos_term_entiempo4 = data.pedidos_term_entiempo4;
									if (pedidos_entregar4==0 && pedidos_term_entiempo4==0) {
										var porc_ind_emb4=0;
									}else{	
										var mes_grafica_emb4 = 2;
										if (mes_grafica_emb4<=mes_actual) {
											var porc_ind_emb4 = (parseInt(pedidos_term_entiempo4)/parseInt(pedidos_entregar4))*100;
											var porc_ind_emb4 = Math.round(porc_ind_emb4).toFixed(1);
										}else{
											var porc_ind_emb4=0;
										}
									}

									var pedidos_entregar5 = data.pedidos_entregar5;
									var pedidos_term_entiempo5 = data.pedidos_term_entiempo5;
									if (pedidos_entregar5==0 && pedidos_term_entiempo5==0) {
										var porc_ind_emb5=0;
									}else{	
										var mes_grafica_emb5 = 2;
										if (mes_grafica_emb5<=mes_actual) {
											var porc_ind_emb5 = (parseInt(pedidos_term_entiempo5)/parseInt(pedidos_entregar5))*100;
											var porc_ind_emb5 = Math.round(porc_ind_emb5).toFixed(1);
										}else{
											var porc_ind_emb5=0;
										}
									}

									var pedidos_entregar6 = data.pedidos_entregar6;
									var pedidos_term_entiempo6 = data.pedidos_term_entiempo6;
									if (pedidos_entregar6==0 && pedidos_term_entiempo6==0) {
										var porc_ind_emb6=0;
									}else{	
										var mes_grafica_emb6 = 2;
										if (mes_grafica_emb6<=mes_actual) {
											var porc_ind_emb6 = (parseInt(pedidos_term_entiempo6)/parseInt(pedidos_entregar6))*100;
											var porc_ind_emb6 = Math.round(porc_ind_emb6).toFixed(1);
										}else{
											var porc_ind_emb6=0;
										}
									}

									var pedidos_entregar7 = data.pedidos_entregar7;
									var pedidos_term_entiempo7 = data.pedidos_term_entiempo7;
									if (pedidos_entregar7==0 && pedidos_term_entiempo7==0) {
										var porc_ind_emb7=0;
									}else{	
										var mes_grafica_emb7 = 2;
										if (mes_grafica_emb7<=mes_actual) {
											var porc_ind_emb7 = (parseInt(pedidos_term_entiempo7)/parseInt(pedidos_entregar7))*100;
											var porc_ind_emb7 = Math.round(porc_ind_emb7).toFixed(1);
										}else{
											var porc_ind_emb7=0;
										}
									}

									var pedidos_entregar8 = data.pedidos_entregar8;
									var pedidos_term_entiempo8 = data.pedidos_term_entiempo8;
									if (pedidos_entregar8==0 && pedidos_term_entiempo8==0) {
										var porc_ind_emb8=0;
									}else{	
										var mes_grafica_emb8 = 2;
										if (mes_grafica_emb8<=mes_actual) {
											var porc_ind_emb8 = (parseInt(pedidos_term_entiempo8)/parseInt(pedidos_entregar8))*100;
											var porc_ind_emb8 = Math.round(porc_ind_emb8).toFixed(1);
										}else{
											var porc_ind_emb8=0;
										}
									}

									var pedidos_entregar9 = data.pedidos_entregar9;
									var pedidos_term_entiempo9 = data.pedidos_term_entiempo9;
									if (pedidos_entregar9==0 && pedidos_term_entiempo9==0) {
										var porc_ind_emb9=0;
									}else{	
										var mes_grafica_emb9 = 2;
										if (mes_grafica_emb9<=mes_actual) {
											var porc_ind_emb9 = (parseInt(pedidos_term_entiempo9)/parseInt(pedidos_entregar9))*100;
											var porc_ind_emb9 = Math.round(porc_ind_emb9).toFixed(1);
										}else{
											var porc_ind_emb9=0;
										}
									}


									var pedidos_entregar10 = data.pedidos_entregar10;
									var pedidos_term_entiempo10 = data.pedidos_term_entiempo10;
									if (pedidos_entregar10==0 && pedidos_term_entiempo10==0) {
										var porc_ind_emb10=0;
									}else{	
										var mes_grafica_emb10 = 2;
										if (mes_grafica_emb10<=mes_actual) {
											var porc_ind_emb10 = (parseInt(pedidos_term_entiempo10)/parseInt(pedidos_entregar10))*100;
											var porc_ind_emb10 = Math.round(porc_ind_emb10).toFixed(1);
										}else{
											var porc_ind_emb10=0;
										}
									}


									var pedidos_entregar11 = data.pedidos_entregar11;
									var pedidos_term_entiempo11 = data.pedidos_term_entiempo11;
									if (pedidos_entregar11==0 && pedidos_term_entiempo11==0) {
										var porc_ind_emb11=0;
									}else{	
										var mes_grafica_emb11 = 2;
										if (mes_grafica_emb11<=mes_actual) {
											var porc_ind_emb11 = (parseInt(pedidos_term_entiempo11)/parseInt(pedidos_entregar11))*100;
											var porc_ind_emb11 = Math.round(porc_ind_emb11).toFixed(1);
										}else{
											var porc_ind_emb11=0;
										}
									}


									var pedidos_entregar12 = data.pedidos_entregar12;
									var pedidos_term_entiempo12 = data.pedidos_term_entiempo12;
									if (pedidos_entregar12==0 && pedidos_term_entiempo12==0) {
										var porc_ind_emb12=0;
									}else{	
										var mes_grafica_emb12 = 2;
										if (mes_grafica_emb12<=mes_actual) {
											var porc_ind_emb12 = (parseInt(pedidos_term_entiempo12)/parseInt(pedidos_entregar12))*100;
											var porc_ind_emb12 = Math.round(porc_ind_emb12).toFixed(1);
										}else{
											var porc_ind_emb12=0;
										}
									}



									var options = {
							          series: [{
							          name: 'Entregados en tiempo',
							          data: [porc_ind_emb1, porc_ind_emb2, porc_ind_emb3, porc_ind_emb4, porc_ind_emb5, porc_ind_emb6, porc_ind_emb7, porc_ind_emb8, porc_ind_emb9,porc_ind_emb10,porc_ind_emb11,porc_ind_emb12]
							        }],
							          chart: {
							          height: 350,
							          type: 'bar',
							        },
							        plotOptions: {
							          bar: {
							            borderRadius: 10,
							            dataLabels: {
							              position: 'top', // top, center, bottom
							            },
							          }
							        },
							        dataLabels: {
							          enabled: true,
							          formatter: function (val) {
							            return val + "%";
							          },
							          offsetY: -20,
							          style: {
							            fontSize: '12px',
							            colors: ["#304758"]
							          }
							        },
							        
							        xaxis: {
							          categories: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
							          position: 'top',
							          axisBorder: {
							            show: false
							          },
							          axisTicks: {
							            show: false
							          },
							          crosshairs: {
							            fill: {
							              type: 'gradient',
							              gradient: {
							                colorFrom: '#D8E3F0',
							                colorTo: '#BED1E6',
							                stops: [0, 100],
							                opacityFrom: 0.4,
							                opacityTo: 0.5,
							              }
							            }
							          },
							          tooltip: {
							            enabled: false,
							          }
							        },
							        yaxis: {
							          axisBorder: {
							            show: false
							          },
							          axisTicks: {
							            show: false,
							          },
							          labels: {
							            show: false,
							            formatter: function (val) {
							              return val + "%";
							            }
							          }
							        
							        },
							        title: {
							          text: 'Cumplimiento de entregas en tiempo',
							          floating: true,
							          offsetY: 330,
							          align: 'center',
							          style: {
							            color: '#444'
							          }
							        }
							        };

							        var chart_emb = new ApexCharts(document.querySelector("#chart_emb"+anio+consec_anio), options);
							        chart_emb.render();


							        //listar_cant_prod_com();
							        //listar_cant_prod_lic();

						});


					});
						
	
							
}



function abrir_tabla_ind_prod()
{
	$("#modal_result_ind_prod").modal("show");
	listar_pedidos_ind_prod();
}

function abrir_tabla_ind_emb()
{
	$("#modal_result_ind_emb").modal("show");
	listar_pedidos_ind_emb();
}


function consul_info_pedidos()
{
	var anio = $("#anio_asign").val();

	$.post("ajax/welcome.php?op=consul_info_pedidos",{anio:anio},function(data, status)
	{
		data = JSON.parse(data);

		var num_pedidos = data.num_pedidos;
		var pedidos_terminados = data.pedidos_terminados;
		var pedidos_entregados = data.pedidos_entregados;
		var pedidos_cancelados = data.pedidos_cancelados;
		$("#num_pedidos").text(num_pedidos);
		$("#pedidos_terminados").text(pedidos_terminados);
		$("#pedidos_entregados").text(pedidos_entregados);
		$("#pedidos_cancelados").text(pedidos_cancelados);

		//consul_info_grafica1();

	});
}

function listar_cant_prod_com()
{
	$.post("ajax/welcome.php?op=listar_cant_prod_com",function(r){
	$("#tbl_cant_prod_com").html(r);

	});
}

function listar_cant_prod_lic()
{
	$.post("ajax/welcome.php?op=listar_cant_prod_lic",function(r){
	$("#tbl_cant_prod_lic").html(r);

	});
}

function detalle_pedido_venci(idpg_pedidos,no_control)
{
	$("#modal_detalle_pedido_ind").modal("show");
	$("#no_control_coment_vencim").text(no_control);
	$("#idpedido").val(idpg_pedidos);
}

function guardar_coment_vencim()
{
	var det_vencim = $("#det_vencim").val();
	var idpedido = $("#idpedido").val();

	$.post("ajax/welcome.php?op=guardar_coment_vencim",{idpedido:idpedido,det_vencim:det_vencim},function(data, status)
	{
		data = JSON.parse(data);

		bootbox.alert("Detalle guardado correctamente");
		$("#modal_detalle_pedido_ind").modal("hide");
		$("#no_control_coment_vencim").text("");
		$("#idpedido").val("");
		$("#det_vencim").val("");

		listar_pedidos_ind_emb();

	});

}

function ver_detalle_pedido(idpg_pedidos,no_control)
{
	//alert(no_control);
	

	$("#div_tbl1").hide();
	$("#div_tbl2").show();

	$.post("ajax/welcome.php?op=listar_pedido_detalle_term&id="+idpg_pedidos,function(r){
	$("#tbl_pedidos_ind_prod_det").html(r);

			$("#no_control_tbl").text("Control: "+no_control);			
							        
	});
}

function ver_lista_pedidos_ind()
{
	$("#div_tbl1").show();
	$("#div_tbl2").hide();
}




init();