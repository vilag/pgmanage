function init()
{
 $("#formulario").hide();
 $("#entrada_salida").hide();
 listar();
 listar_apartados1();
}

function listar()
{
	
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: 'ajax/inventario_z.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 100,//Paginación
	    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();

	//$("#avancesp").val("");
}

function detalle_prod(idinventario_zuno)
{
	//alert(idinventario_zuno);
	$("#myModal_detalle_prod").modal("show");

  	$.post("ajax/inventario_z.php?op=mostrardetalle",{idinventario_zuno:idinventario_zuno},function(data, status)//
    {
      data = JSON.parse(data);

      $("#id_inv").val(data.idinventario_zuno);
      $("#codigo").text(data.codigo_producto);
      $("#descripcion").text(data.descripcion);
      $("#comentario").text(data.comentario);
      $("#nombre").text(data.nombre);
      $("#imagen").attr("src",'../../images/productos/'+data.imagen);
      $("#existencia").text("Existencia: "+data.existencia);
      $("#exist").text(data.existencia);
      $("#exist_ant").text(data.existencia);

      listar_apartados();
      listar_tbl_colores();
      $("#informe").show();
	  $("#edicion").hide();

    });

	
}

function verlista()
{
    $("#listadoregistros").show();
	$("#formulario").hide();
	$("#entrada_salida").hide();
	$("#listado_apartados").hide();
}

function nuevoreg()
{
    $("#listadoregistros").hide();
	$("#formulario").show();
	$("#entrada_salida").hide();
	$("#listado_apartados").hide();
}

function verapartados()
{
	$("#listadoregistros").hide();
	$("#formulario").hide();
	$("#entrada_salida").hide();
	$("#listado_apartados").show();
}


	/*$.post("ajax/inventario_z.php?op=selectProd", function(r){
	    $("#producto_reg").html(r);
	    $('#producto_reg').selectpicker('refresh');

	  
	})*/




function sumarprod()
{
	var cant_actual = $("#exist").text();
	var cant_capt = $("#cant_capt").val();

	var nueva_cant = parseInt(cant_actual)+parseInt(cant_capt);

	$("#exist").text(nueva_cant);
	$("#existencia").text("Existencia: "+nueva_cant);

	$("#cant_capt").val("0");
}

function restarprod()
{
	var cant_actual = $("#exist").text();
	var cant_capt = $("#cant_capt").val();

	var nueva_cant = parseInt(cant_actual)-parseInt(cant_capt);

	//alert(nueva_cant);
	if (nueva_cant=="") {
		bootbox.alert("Es necesario capturar una cantidad");
	}
	if (nueva_cant<cant_actual) {
		$("#exist").text(nueva_cant);
		$("#existencia").text("Existencia: "+nueva_cant);
	}
	if (nueva_cant>cant_actual) {
		bootbox.alert("La cantidad capturada es mayor a las existencias");
	}

	


	$("#cant_capt").val("0");
}

function guardar()
{
	var idinventario_zuno = $("#id_inv").val();
	var cant_actual = $("#exist").text();
	var cant_base = $("#exist_ant").text();
	var codigo = $("#codigo").text();

	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;

	if (parseInt(cant_actual)!=parseInt(cant_base)) {

		bootbox.confirm({
		    title: "CONFIRMACIÓN DE ACTUALIZACIÓN",
		    message: "¿Esta seguro de realizar esta actualización de inventario?",
		    buttons: {
		        cancel: {
		            label: '<i class="fa fa-times"></i> Cancel'
		        },
		        confirm: {
		            label: '<i class="fa fa-check"></i> Confirm'
		        }
		    },
		    callback: function (result) {
		        console.log('This was logged in the callback: ' + result);

		       // alert(result);

		        if (result==true) {

		        		
		        		//var cant_base = $("#exist_ant").text();
		        		$.post("ajax/inventario_z.php?op=guardar",{idinventario_zuno:idinventario_zuno,cant_actual:cant_actual,cant_base:cant_base,fecha_hora:fecha_hora,codigo:codigo},function(data, status)//
					    {
					      data = JSON.parse(data);

					    	bootbox.alert("Actualización Existosa");
					    	$("#exist").text(cant_actual);
							$("#exist_ant").text(cant_actual);
					    	listar();
					    	$("#myModal_detalle_prod").modal("hide");

					    });
		        }
		        
		    }
		});


	}else{
						
				$("#myModal_detalle_prod").modal("hide");		
	}

						

}	

function guardar_prod()
{
	var codigo_nuevo = $("#codigo_nuevo").val();
	var descr_nuevo = $("#descr_nuevo").val();
	var existencia_nuevo = $("#existencia_nuevo").val();

	$.post("ajax/inventario_z.php?op=consul_prod",{codigo_nuevo:codigo_nuevo},function(data, status)//
	{
			data = JSON.parse(data);

			//alert(data);

			if (data==null) {


					$.post("ajax/inventario_z.php?op=guardar_prod",{codigo_nuevo:codigo_nuevo,descr_nuevo:descr_nuevo,existencia_nuevo:existencia_nuevo},function(data, status)//
					{
							data = JSON.parse(data);

							bootbox.alert("Producto guardado exitosamente.");
							listar();
							verlista();
					});


				//alert("null");
			}else{
				bootbox.alert("Este producto ya existe.");
			}
	});



	/**/
}


function listar_apartados()
{
	/*var idinventario_zuno = $("#id_inv").val();
	//alert(idcontacto);

	tabla=$('#tbl_prod_apartado').dataTable(
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
					url: 'ajax/inventario_z.php?op=listar_apartados',
					data:{idinventario_zuno: idinventario_zuno},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();*/

	//$$("#avancesp").val("");

	var idinventario_zuno = $("#id_inv").val();

	$.post("ajax/inventario_z.php?op=listar_apartados&id="+idinventario_zuno,function(r){
	        $("#tbl_prod_apartado").html(r);

	        contar_apartados();
	});

}


function contar_apartados()
{
	var idinventario_zuno = $("#id_inv").val();

	$.post("ajax/inventario_z.php?op=contar_apartados",{idinventario_zuno:idinventario_zuno},function(data, status)//
	{
			data = JSON.parse(data);
			//alert(data.num_apart);

			$("#apartados").text("Apartados:"+ " "+data.num_apart);
							
	});
}

	
function entregar_apartado(idinvetario_zuno_apartado,idventa)
{
	/*alert(idinvetario_zuno_apartado);
	alert(idventa);*/
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var codigo = $("#codigo").text();


			$.post("ajax/inventario_z.php?op=entregar_apartado",{idinvetario_zuno_apartado:idinvetario_zuno_apartado,idventa:idventa,fecha_hora:fecha_hora,codigo:codigo},function(data, status)//
			{
					data = JSON.parse(data);
					//alert(data.num_apart);


					listar_apartados();
									
			});

	
}

function listar_apartados1()
{
	

	$.post("ajax/inventario_z.php?op=listar_apartados1",function(r){
	        $("#tbl_prod_apartado1").html(r);

	        
	});

}

function entregar_apartado2(idinvetario_zuno_apartado,idventa)
{
	/*alert(idinvetario_zuno_apartado);
	alert(idventa);*/
	var fecha=moment().format('YYYY-MM-DD');
	var hora=moment().format('HH:mm:ss');
	var fecha_hora=fecha+" "+hora;
	var codigo = "";


			$.post("ajax/inventario_z.php?op=entregar_apartado",{idinvetario_zuno_apartado:idinvetario_zuno_apartado,idventa:idventa,fecha_hora:fecha_hora,codigo:codigo},function(data, status)//
			{
					data = JSON.parse(data);
					//alert(data.num_apart);


					listar_apartados1();
									
			});

	
}


function listar_tbl_colores()
{

	var idinventario_zuno = $("#id_inv").val();
	//alert(idinventario_zuno);

	$.post("ajax/inventario_z.php?op=listar_tbl_colores&id="+idinventario_zuno,function(r){
	        $("#tblcolores").html(r);
	        $("#tblcolores2").html(r);
	        //contar_apartados();
	});

}

function informe()
{
	$("#informe").show();
	$("#edicion").hide();
	$("#letrero").text("INFORME");
	listar_tbl_colores();
}
function editar()
{
	$("#informe").hide();
	$("#edicion").show();
	$("#letrero").text("EDITAR");
	listar_tbl_colores();
}

function editar_color(iddetalle_inventario_zuno)
{
	

	var idcant_color = $("#cant_color"+iddetalle_inventario_zuno).val();

	//alert(iddetalle_inventario_zuno);
	//alert(idcant_color);


			$.post("ajax/inventario_z.php?op=editar_color",{iddetalle_inventario_zuno:iddetalle_inventario_zuno,idcant_color:idcant_color},function(data, status)//
			{
					data = JSON.parse(data);

					listar_tbl_colores();				
			});
}

function actualizar_letrero(iddetalle_inventario_zuno)
{
	//alert(iddetalle_inventario_zuno);
			$.post("ajax/inventario_z.php?op=actualizar_letrero",{iddetalle_inventario_zuno:iddetalle_inventario_zuno},function(data, status)//
			{
					data = JSON.parse(data);

					//listar_tbl_colores();	
					//actualizar_letrero();	
					listar_tbl_colores();		
			});
}

function addcolor()
{
	var idinventario_zuno = $("#id_inv").val();
	var nombre_color = $("#nombre_color").val();
	var cantidad_color = $("#cantidad_color").val();

			$.post("ajax/inventario_z.php?op=addcolor",{idinventario_zuno:idinventario_zuno,nombre_color:nombre_color,cantidad_color:cantidad_color},function(data, status)//
			{
					data = JSON.parse(data);

					//listar_tbl_colores();	
					//actualizar_letrero();	
					listar_tbl_colores();		
			});

}

function addcolor2()
{
	var idinventario_zuno = $("#id_inv").val();
	var nombre_color = $("#nombre_color2").val();
	var cantidad_color = $("#cantidad_color2").val();

			$.post("ajax/inventario_z.php?op=addcolor",{idinventario_zuno:idinventario_zuno,nombre_color:nombre_color,cantidad_color:cantidad_color},function(data, status)//
			{
					data = JSON.parse(data);

					//listar_tbl_colores();	
					//actualizar_letrero();	
					listar_tbl_colores();		
			});

}


init();