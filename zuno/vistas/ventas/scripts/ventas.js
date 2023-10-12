function init()
{

 listar();
 $("#nuevoregistro").hide();
 $("#btn_atras").hide();

 select_cliente();
 grafico();

}

function grafico()
{

	/*$.post("ajax/ventas.php?op=ventas_enero",function(data, status)//
	{
		data = JSON.parse(data);
		var enero = data.enero;



		$.post("ajax/ventas.php?op=ventas_febrero",function(data, status)//
		{
			data = JSON.parse(data);
			var febrero = data.febrero;

		

			$.post("ajax/ventas.php?op=ventas_marzo",function(data, status)//
			{
				data = JSON.parse(data);
				var marzo = data.marzo;




				$.post("ajax/ventas.php?op=ventas_abril",function(data, status)//
				{
					data = JSON.parse(data);
					var abril = data.abril;

					$.post("ajax/ventas.php?op=ventas_mayo",function(data, status)//
					{
						data = JSON.parse(data);
						var mayo = data.mayo;

						$.post("ajax/ventas.php?op=ventas_junio",function(data, status)//
						{
							data = JSON.parse(data);
							var junio = data.junio;

							$.post("ajax/ventas.php?op=ventas_julio",function(data, status)//
							{
								data = JSON.parse(data);
								var julio = data.julio;

								$.post("ajax/ventas.php?op=ventas_agosto",function(data, status)//
								{
									data = JSON.parse(data);
									var agosto = data.agosto;

									$.post("ajax/ventas.php?op=ventas_septiembre",function(data, status)//
									{
										data = JSON.parse(data);
										var septiembre = data.septiembre;

										$.post("ajax/ventas.php?op=ventas_octubre",function(data, status)//
										{
											data = JSON.parse(data);
											var octubre = data.octubre;

											$.post("ajax/ventas.php?op=ventas_noviembre",function(data, status)//
											{
												data = JSON.parse(data);
												var noviembre = data.noviembre;*/
												var anio_grafica = $("#anio_grafica").val();

												//alert(anio_grafica);

												$.post("ajax/ventas.php?op=ventas_diciembre",{anio_grafica:anio_grafica},function(data, status)//
												{
													data = JSON.parse(data);

													var enero = data.enero;
													var febrero = data.febrero;
													var marzo = data.marzo;
													var abril = data.abril;
													var mayo = data.mayo;
													var junio = data.junio;
													var julio = data.julio;
													var agosto = data.agosto;
													var septiembre = data.septiembre;
													var octubre = data.octubre;
													var noviembre = data.noviembre;
													
													var diciembre = data.diciembre;

													/*alert(enero);
													alert(febrero);
													alert(marzo);
													alert(abril);
													alert(mayo);
													alert(junio);
													alert(julio);
													alert(agosto);
													alert(septiembre);
													alert(octubre);
													alert(noviembre);
													alert(diciembre);*/


															new Chart(document.getElementById("line-chart"), {
							                                type: 'line',
							                                data: {
							                                  labels: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
							                                  datasets: [{ 
							                                      data: [enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre],
							                                      label: anio_grafica,
							                                      borderColor: "#3e95cd",
							                                      fill: false
							                                    }/*, { 
							                                      data: [168,170,178,190,203,276,408,547,675,734],
							                                      label: "Europe",
							                                      borderColor: "#3cba9f",
							                                      fill: false
							                                    }, { 
							                                      data: [40,20,10,16,24,38,74,167,508,784],
							                                      label: "Latin America",
							                                      borderColor: "#e8c3b9",
							                                      fill: false
							                                    }, { 
							                                      data: [6,3,2,2,7,26,82,172,312,433],
							                                      label: "North America",
							                                      borderColor: "#c45850",
							                                      fill: false
							                                    }*/
							                                  ]
							                                },
							                                options: {
							                                  title: {
							                                    display: true,
							                                    text: 'Seguimiento de ventas 2021 "Zuno"'
							                                  }
							                                }
							                              });

												});

											/*});

										});

									});

								});

							});

						});

					});

				});

			});

		});


		
								
	});*/



															
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
		            'excelHtml5',
		            //'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: 'ajax/ventas.php?op=listar',
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

function verform_reg()
{
	$("#listadoregistros").hide();
	$("#nuevoregistro").show();
	$("#btn_reg").hide();
	$("#btn_atras").show();
	limpiar();

	select_cliente();
}
function vertabla()
{
	$("#listadoregistros").show();
	$("#nuevoregistro").hide();
	$("#btn_reg").show();
	$("#btn_atras").hide();
	
}

function listarProd()
{

	tabla=$('#tbl_prod').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            
		        ],
		"ajax":
				{
					url: 'ajax/ventas.php?op=listarProd',
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
}



var cont=0;
var detalles=0;

function agregarDetalle(idinventario_zuno,codigo_producto,descripcion,imagen,precio,existencia)
{
 	
	if (precio=="") {
		precio=0;
	}

	if (existencia>0) {


	
				var cantidad = 1;
				var subtotal = parseInt(precio)*parseInt(cantidad);

		    	var fila='<tr class="filas" id="fila'+cont+'">'+
		    	//'<td><input type="text" name="" value="'+cont+'"></td>'+
		    	'<td><input type="hidden" name="idinventario_zuno[]" value="'+idinventario_zuno+'"></td>'+
		    	'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
		    	
		    	'<td><img src="../../images/productos/'+imagen+'" width="80" height="80" name="imagen_prod[]"></td>'+
		    	'<td><input type="text" name="codigo_producto[]" value="'+codigo_producto+'"></td>'+
		    	'<td><input type="text" name="descripcion[]" value="'+descripcion+'"></td>'+
		    	//'<td><input type="number" step="any" name="precio[]" value="'+precio+'" onkeyup="select_color('+idinventario_zuno+',\''+cont+'\')"></td>'+
		    	'<td><input type="number" step="any" name="precio[]" value="'+precio+'"></td>'+
		    	
		    	//'<td><select id="idcolor'+idinventario_zuno+'" name="idcolor'+idinventario_zuno+'"></select></td>'+
		    	//'<td><select id="idcolor'+cont+'" name="idcolor'+cont+'"></select></td>'+
		    	
		            '<td><input type="number" step="any" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
			    	'<td><input type="number" step="any" name="subtotal[]" id="subtotal[]" value="'+subtotal+'"></td>'+
			    	
			    	'</tr>';
			    	cont++;
			    	detalles=detalles+1;
			    	$('#tbllistado_prod').append(fila);

			    	$("#num_prod").text("Tipos de producto: "+detalles);
			    	$("#cont_prod").text(cont);



			   // alert(idinventario_zuno);
			    

			    	

	}else{
		bootbox.alert("No hay existencia de este articulo");
	}
				
		    		
}



/*function select_color(idinventario_zuno,cont)
{

				$.post("ajax/ventas.php?op=select_color",{idinventario_zuno:idinventario_zuno}, function(r){
		            $("#idcolor"+cont).html(r);
		            $("#idcolor"+cont).selectpicker('refresh');	           
		    	});

		
}*/

function eliminarDetalle(cont)
{
	//alert(cont);
	$("#fila" + cont).remove();
  	//calcularTotales();
  	detalles=detalles-1;
  	
  	$("#total").text("0.00");
  	$("#num_prod").text("Tipos de producto: "+detalles);
  	$("#cont_prod").text(cont);
}

function limpiarfila()
{
	var numfilas =  $("#cont_prod").text();

	while (numfilas>=0)
	{
		$("#fila" + numfilas).remove();

	numfilas = numfilas-1;
	
	}
}


function calcularsub()
  {

  	var cant = document.getElementsByName("cantidad[]");
  	var precio = document.getElementsByName("precio[]");
  	var cantidad = document.getElementsByName("cantidad[]");
 

  	for (var i = 0; i <cant.length; i++) {

  		

  		var price=precio[i];
  		var cant2=cantidad[i];

  		var subtotal = parseFloat(price.value)*parseInt(cant2.value);
  		document.getElementsByName("subtotal[]")[i].value = subtotal;
  	
		
		
    }

    calcularTotales();

  }


function calcularTotales(){
        //alert("entra a calctotales");
  	//var sub = document.getElementsByName("subtotal");
  	//var espe = document.getElementsByName("esp[]");
  	$("#v_descripcion").val("");
  	var descr_v = $("#v_descripcion").val();

  	var total = 0.0;

  	var cant = document.getElementsByName("cantidad[]");
  	var descripcion = document.getElementsByName("descripcion[]");

   		
    var codigo_producto = document.getElementsByName("codigo_producto[]");
      		
    var cantidad = document.getElementsByName("cantidad[]");
    var concep="";
      		


  	for (var i = 0; i < cant.length; i++) {
  		//var esp=espe[i];
  		//if (esp.value=="Convenio") {

  			//total = 20;

  		//}else{
  			total += parseFloat(document.getElementsByName("subtotal[]")[i].value);

  			var descr=descripcion[i];
  			var cod_prod=codigo_producto[i];
  			var cant_prod=cantidad[i];

  			concep = concep+"\n"+"CODIGO: "+cod_prod.value+", DESCRIPCIÓN: "+descr.value+", CANTIDAD: "+cant_prod.value+"/";


  			//var descr_v = descr_v+"\n"+descr.value;
  			 $("#v_descripcion").val(concep);
  		//}
	}	
	



	$("#total").html(total);
   
    //evaluar();
    

}


function select_cliente()
{

	$.post("ajax/ventas.php?op=select_cliente", function(r){
	            $("#idcliente").html(r);
	            $('#idcliente').selectpicker('refresh');
	})
}

function valid_banco()
{
	var v_forma_pago = $("#v_forma_pago").val();
	var v_banco = $("#v_banco").val();
	var v_ref = $("#v_ref").val();
	var v_comp = $("#v_comp").val();

	/*alert(v_forma_pago);
	alert(v_banco);
	alert(v_ref);
	alert(v_comp);*/

	if (v_forma_pago=="") {
		bootbox.alert("Seleccionar forma de pago");
	}else{
		guardar_venta();
		
		/*if (v_forma_pago!="Efectivo") {

			if (v_banco!="" && v_ref!="" && v_comp!="") {

				guardar_venta();
				//alert("se guarda con datos bancarios");

			}else{

				if (v_banco=="" || v_ref=="" || v_comp=="") {
					//document.getElementsByName("v_banco")[0].required=true;
					bootbox.alert("Para un pago bancario los datos: Banco, Referencia y comprobante son obligatorios");
				}
				

			}			

		}else{
			guardar_venta();
			//alert("se guarda con efectivo");
		}*/

	}

		
}


function guardar_venta()
{


	bootbox.confirm({
	    message: "¿Los productos vendidos quedarán en apartado?",
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

	    		var marca_pedido = 1;
	    		//alert(marca_pedido);
	    	}else{

	    		var marca_pedido = 0;
	    		//alert(marca_pedido);
	    	}

	    	//alert(marca_pedido+"Dentro");

	        //console.log('This was logged in the callback: ' + result);





				        	var idcliente = $("#idcliente").val();
							var idusuario = $("#idusuario").text();
							var v_descripcion = $("#v_descripcion").val();
							var v_total_pago = $("#total").text();

							var v_forma_pago = $("#v_forma_pago").val();
							var v_banco = $("#v_banco").val();
							var v_ref = $("#v_ref").val();
							var v_comp = $("#v_comp").val();
							var v_coment = $("#v_coment").val();
							var v_estatus = 1;
							var v_fecha_hora = $("#v_fecha_hora").val();

							//var fecha=moment().format('YYYY-MM-DD');
							var fecha = $("#fecha_venta").val();
							var hora=moment().format('HH:mm:ss');
							var v_fecha_hora=fecha+" "+hora;

							//alert(v_total_pago);


				

							$.post("ajax/ventas.php?op=guardar_venta",{
							idcliente:idcliente,
							idusuario:idusuario,
							v_descripcion:v_descripcion,
							v_total_pago:v_total_pago,
							v_forma_pago:v_forma_pago,
							v_banco:v_banco,
							v_ref:v_ref,
							v_comp:v_comp,
							v_coment:v_coment,
							v_estatus:v_estatus,
							v_fecha_hora:v_fecha_hora
							},function(data, status)//
						    {
						      data = JSON.parse(data);

						      //alert(data.idventa);

						      var idventa = data.idventa;


						      			var cant = document.getElementsByName("cantidad[]");
										//var cant_2= document.getElementsByName("cantidad[]");
						      			var idinventario_zuno = document.getElementsByName("idinventario_zuno[]");
						      			//var imagen_prod = document.getElementsByName("imagen_prod[]");
						      			var codigo_producto = document.getElementsByName("codigo_producto[]");
						      			var descripcion = document.getElementsByName("descripcion[]");
						      			var precio = document.getElementsByName("precio[]");
						      			var cantidad = document.getElementsByName("cantidad[]");
						      			var subtotal = document.getElementsByName("subtotal[]");


									  	for (var i = 0; i <cant.length; i++) {


									  		var idinventario_zuno2=idinventario_zuno[i];
									  		var codigo_producto2=codigo_producto[i];
									  		var descripcion2=descripcion[i];
									  		var precio2=precio[i];
									  		var cantidad2=cantidad[i];
									  		var subtotal2=subtotal[i];

									  		var idinv = idinventario_zuno2.value;
									  		var codigo_p = codigo_producto2.value;
									  		var descrip_p = descripcion2.value;
									  		var precio_p = precio2.value;
									  		var cant_p = cantidad2.value;
									  		var subt_p = subtotal2.value;

									  		//alert(subtotal2.value);

									  		//alert(idinventario_zuno2.value+"-"+codigo_producto2.value+"-"+descripcion2.value+"-"+precio2.value+"-"+cantidad2.value+"-"+subtotal2.value);

										  		

											    if ((i+1)==cant.length) {

											    	$.post("ajax/ventas.php?op=save_detalle_venta",{idventa:idventa,idinv:idinv,codigo_p:codigo_p,precio_p:precio_p,cant_p:cant_p,subt_p:subt_p,v_fecha_hora:v_fecha_hora,marca_pedido:marca_pedido},function(data, status)//
												    {
												      data = JSON.parse(data);

												      bootbox.alert("Venta registrada correctamente");
												      limpiar();
												      
												      listar();
												      vertabla_ventas();
												      grafico();

												    });
											    		
											    }else{

											    	$.post("ajax/ventas.php?op=save_detalle_venta",{idventa:idventa,idinv:idinv,codigo_p:codigo_p,precio_p:precio_p,cant_p:cant_p,subt_p:subt_p,v_fecha_hora:v_fecha_hora,marca_pedido:marca_pedido},function(data, status)//
												    {
												      data = JSON.parse(data);

												    });

											    }

									  		
									    }

						    });








	    }
	});


	

				/**/
}

function limpiar()
{
	//$("#idcliente").val("");
	//alert("limpiar");
	detalles=0;
	cont=0;
	limpiarfila();
	$("#v_forma_pago").val("");
	$('#v_forma_pago').selectpicker('refresh');
	$("#v_banco").val("");
	$('#v_banco').selectpicker('refresh');
	$("#v_ref").val("");
	$("#v_comp").val("");
	$("#v_descripcion").val("");
	$("#v_coment").val("");
	$("#v_comp").val("");
	$("#ar_comprob").val("");
	$("#btn_comprob").show();
	$("#btn_comprob2").hide();
	$("#cont_prod").text("0");
	$("#num_prod").text("Tipos de producto: "+detalles);
	$("#total").text("0.00");

}

function vertabla_ventas()
{
	$("#listadoregistros").show();
	$("#nuevoregistro").hide();
	$("#btn_reg").show();
	$("#btn_atras").hide();

	
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

	    if (num_cliente_new!="" && nombre_new!="") {

	    		$.post("../../ajax/clientes.php?op=buscar_nom_cli",{nombre_new:nombre_new},function(data, status)
				{
					data = JSON.parse(data);

					//alert(data);
				
																												
					if (data==null) {

								var num_cliente = $("#num_cliente_new").val();

								$.post("../../ajax/contactos.php?op=buscar_num_cli",{num_cliente:num_cliente},function(data, status)
								{
									data = JSON.parse(data);

									
																																
									if (data==null) {


											$.post("../../ajax/clientes.php?op=guardar_cliente",{
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
												var idcliente = data.idcliente;
												
												$("#myModal_new_cli").modal('hide');
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

	    }else{
	    	bootbox.alert("Los campos numero y nombre del cliente son obligatorios");
	    }
							
}


function subir_comprobante()
{

		var nom_arch = $("#ar_comprob").val();
	
		var nom_arch_f = $("#v_comp").val();
		//alert(nom_arch);

		if (nom_arch!="") {

			if (nom_arch_f=="") {

								var parametros = new FormData($("#formulario-envia_comprobante")[0]);
								$.ajax({

										data: parametros,
										url: "ajax/ventas.php?op=guardar_comprobante",
										type: "POST",
										contentType: false,
										processData: false,
										beforesend: function(){

										},
										success: function(data, status){

												data = JSON.parse(data);
												
												//alert(data.idarch_temp);
												$("#v_comp").val(data.idarch_temp);
												$("#docview").attr("src","files/"+data.nombre);
												$("#myModal_vista_comp").modal("show");
												$("#btn_comprob").hide();
												$("#btn_comprob2").show();
												
										}

								});
			}else{

				$("#docview").attr("src","files/"+nom_arch_f);
				$("#myModal_vista_comp").modal("show");
			}

								

		}else{
			bootbox.alert("No se cargado ningun archivo");
			
		}
								
}

function mostrar_comprobante()
{
	var nom_arch_f = $("#v_comp").val();

	$("#docview").attr("src","files/"+nom_arch_f);
	$("#myModal_vista_comp").modal("show");
}

function mostrar_detalle_venta(idventa)
//
{
	//alert(idventa);

	$.post("ajax/ventas.php?op=mostrar_detalle_venta",{idventa:idventa},function(data, status)//
	{
			data = JSON.parse(data);

			//alert(data.idventa);
			$("#c_folio").text(data.idventa);		
			$("#c_no_cliente").text(data.no_cliente);
			$("#c_cliente").text(data.nom_cliente);
			$("#c_forma_pago").text(data.forma_pago);
			$("#c_banco").text(data.banco);
			$("#c_referencia").text(data.num_ref);
			//$("#docview2").attr("src","files/"+data.nom_comprob);
			$("#c_descripcion").text(data.descripcion);
			$("#c_comentario").val(data.comentario);
			

			var idcomprob = data.comprobante;

			if (idcomprob>0) {


					$.post("ajax/ventas.php?op=mostrar_compr_venta",{idventa:idventa,idcomprob:idcomprob},function(data, status)//
					{
							data = JSON.parse(data);
							$("#docview2").attr("src","files/"+data.nombre);
							$("#myModal_vista_venta").modal("show");
					});

			}else{
				$("#myModal_vista_venta").modal("show");
			}

	});


			
}


function update_coment()
{
	var c_comentario = $("#c_comentario").val();
	var c_folio = $("#c_folio").text();


	$.post("ajax/ventas.php?op=update_coment",{c_comentario:c_comentario, c_folio:c_folio},function(data, status)//
	{
		data = JSON.parse(data);
		$("#c_comentario").text(data.comentario);

		bootbox.alert("Comentario actualizado correctamente");
		
	});
}







init();