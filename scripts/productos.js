document.getElementById("sheetjsexport").addEventListener('click', function() {
  /* Create worksheet from HTML DOM TABLE */
  var wb = XLSX.utils.table_to_book(document.getElementById("TableToExport"));
  /* Export to file (start a download) */
  //var tipo_consulta = $("#tipo_consulta").text();
  XLSX.writeFile(wb, "Reporte_de_productos.xlsx");
});

var tipo_action = "";
function init()
{
	mostrar_contents_iniciales();
	// location.href ="https://pgmanage.host/susp.php";
	//listar_productos();
	listar_tipos();
	disabled_enabled();
	

	var idusuario=$("#idusuario").text();
	$("#btn_save_prod").hide();

	if (idusuario==1) {

		document.getElementById('precio').disabled = false;
		document.getElementById('codigo').disabled = false;

		$("#btn_save_prod").show();
		$("#act_product").show();

	}else{
		$("#act_product").hide();
	}

	$("#consuta_productos").show();
	$("#consulta_fabricados").hide();
	$("#consulta_vendidos").hide();

	mostrar_tipos_new();
	setTimeout(() => {
		mostrar_modelos_new();
		setTimeout(() => {
			mostrar_tamano_new();
		}, 500);
	}, 500);

}

function mostrar_contents_iniciales(){
	document.getElementById("content_reporte_productos").style.display="none";
	document.getElementById("content_consulta_productos").style.display="block";
}

function abrir_content_reporte_prod(){
	document.getElementById("content_reporte_productos").style.display="block";
	document.getElementById("content_consulta_productos").style.display="none";
	listar_tabla_productos();
}

function listar_tabla_productos(){
	$.post("ajax/productos.php?op=listar_tabla_productos",function(data, status)
	{
		data = JSON.parse(data);
        //console.log(data);
        //return;
		$("#total_productos_reporte").text(data.length);
        var element = document.getElementById("tbl_productos_reporte");
        while (element.firstChild) {
          element.removeChild(element.firstChild);
        }
        var productos_reporte = data;
        for (var index = 0; index < productos_reporte.length; index++) {
			if (productos_reporte[index].estatus==1) {
				var estatus_tbl = "Activo";
			}
            var fila='<tr>'+
                '<td>'+(index+1)+'</td>'+
                '<td>'+productos_reporte[index].codigo_match+'</td>'+
                '<td>'+productos_reporte[index].descripcion+'</td>'+
                '<td>'+estatus_tbl+'</td>'+
                '</tr>';
            $('#tbl_productos_reporte').append(fila);
        }
        //console.log(pedidos);
       
	});
}

function listar_productos()
{
	var idusuario=$("#idusuario").text();

	if (idusuario==4 || idusuario==5 || idusuario==8 || idusuario==10) {

		$.post("ajax/productos.php?op=listar_productos2",function(r){
		        $("#tbl_productos").html(r);      
		});

	}else{

		$.post("ajax/productos.php?op=listar_productos",function(r){
		        $("#tbl_productos").html(r);      
		});
	}

		
}

function ver_detalle_prod(idproductos_clasif)
{

	$("#modal_detalle_productos").modal("show");
	
	//alert(idproducto);

	var idproducto = idproductos_clasif;

	$.post("ajax/productos.php?op=ver_detalle_prod",{idproducto:idproducto},function(data, status)
	{
		data = JSON.parse(data);

	
		//alert(codigo);
			$("#idproducto").val(data.idproductos_clasif);
			$("#tipo_prod").val(data.tipo);
			$("#codigo").val(data.codigo_match);
			$("#nombre").val(data.nombre);
			$("#color").val(data.color);
			$("#medidas").val(data.nom_tamano);

			var idusuario=$("#idusuario").text();

			if (idusuario==4 || idusuario==5 || idusuario==8 || idusuario==10) {

				$("#caja_precio").hide();
				
			}else{
				$("#caja_precio").show();
				$("#precio").val(data.precio_total);
			}

			

	});
}

function buscar_texto_tbl()
{
	var text_buscar = $("#text_buscar").val();
	alert(text_buscar);

	var idusuario=$("#idusuario").text();

	if (idusuario==4 || idusuario==5 || idusuario==8 || idusuario==10) {

		$.post("ajax/productos.php?op=buscar_texto_tbl2&id="+text_buscar,function(r){
		        $("#tbl_productos").html(r);

		       
		});

	}else{

		$.post("ajax/productos.php?op=buscar_texto_tbl&id="+text_buscar,function(r){
		        $("#tbl_productos").html(r);

		       
		});	

	}
	//var lugar_user = $("#lugar_user").text();

		
}

/*{

	var idproducto = $("#idproducto").val();
	var codigo = $("#codigo").val();
	var nombre = $("#nombre").val();
	var color = $("#color").val();
	var medidas = $("#medidas").val();
	var precio = $("#precio").val();

	$.post("ajax/productos.php?op=actualizar_producto",{idproducto:idproducto,codigo:codigo,nombre:nombre,color:color,medidas:medidas,precio:precio},function(data, status)
	{
		data = JSON.parse(data);

			bootbox.alert("Producto actualizado correctamente");
	
			$("#tipo_prod").val("");
			$("#codigo").val("");
			$("#nombre").val("");
			$("#color").val("");
			$("#medidas").val("");
			$("#precio").val("");

			listar_productos();

			$("#modal_detalle_productos").modal("hide");

	});
}*/

function listar_productos_resul_tipo()
{
	var select_busqueda_tipo = $("#select_busqueda_tipo").val();

	$.post("ajax/productos.php?op=listar_productos_resul_tipo&id="+select_busqueda_tipo,function(r){
	$("#tbl_result_prod_consul").html(r);
	       
	});
}

function hab_codigo(idproductos_clasif){
	//alert(idproductos_clasif);
	var idusuario = $("#idusuario").text();

	if (idusuario==1) {
		var check_codigo = document.getElementById("check_codigo"+idproductos_clasif).checked;
		if (check_codigo==true) {
			document.getElementById("codigo"+idproductos_clasif).style.display = "block";
			document.getElementById("lbl_codigo"+idproductos_clasif).style.display = "none";
		}else{
			document.getElementById("codigo"+idproductos_clasif).style.display = "none";
			document.getElementById("lbl_codigo"+idproductos_clasif).style.display = "block";
		}
	}

		
}

function hab_descrip(idproductos_clasif){
	//alert(idproductos_clasif);
	var idusuario = $("#idusuario").text();

	if (idusuario==1) {

		var check = document.getElementById("check_descrip"+idproductos_clasif).checked;
		if (check==true) {
			document.getElementById("descrip"+idproductos_clasif).style.display = "block";
			document.getElementById("lbl_descrip"+idproductos_clasif).style.display = "none";
		}else{
			document.getElementById("descrip"+idproductos_clasif).style.display = "none";
			document.getElementById("lbl_descrip"+idproductos_clasif).style.display = "block";
		}
	}

		
}

function hab_tam(idproductos_clasif){
	//alert(idproductos_clasif);
	/*var check = document.getElementById("check_tam"+idproductos_clasif).checked;
	if (check==true) {
		document.getElementById("tamano"+idproductos_clasif).style.display = "block";
		document.getElementById("lbl_tam"+idproductos_clasif).style.display = "none";
	}else{
		document.getElementById("tamano"+idproductos_clasif).style.display = "none";
		document.getElementById("lbl_tam"+idproductos_clasif).style.display = "block";
	}*/
}


function guardar_codigo(idproductos_clasif){
	var id_input_codigo = $("#id_input_codigo"+idproductos_clasif).val();
	//alert(id_input_codigo);

	$.post("ajax/productos.php?op=guardar_codigo",{id_input_codigo:id_input_codigo,idproductos_clasif:idproductos_clasif},function(data, status)
	{
		data = JSON.parse(data);
		document.getElementById("codigo"+idproductos_clasif).style.display = "none";
		document.getElementById("lbl_codigo"+idproductos_clasif).style.display = "block";
		$("#lbl_codigo"+idproductos_clasif).text(id_input_codigo);
		//bootbox.alert("Codigo actualizado correctamente.")
		document.getElementById("check_codigo"+idproductos_clasif).checked = false;

	});
}

function guardar_descrip(idproductos_clasif){
	var id_textarea_descrip = $("#id_textarea_descrip"+idproductos_clasif).val();
	//alert(id_textarea_descrip);

	$.post("ajax/productos.php?op=guardar_descrip",{id_textarea_descrip:id_textarea_descrip,idproductos_clasif:idproductos_clasif},function(data, status)
	{
		data = JSON.parse(data);
		document.getElementById("descrip"+idproductos_clasif).style.display = "none";
		document.getElementById("lbl_descrip"+idproductos_clasif).style.display = "block";
		$("#lbl_descrip"+idproductos_clasif).text(id_textarea_descrip);
		//bootbox.alert("Codigo actualizado correctamente.")
		document.getElementById("check_descrip"+idproductos_clasif).checked = false;

	});
}

function guardar_tamano(idproductos_clasif){
	var id_input_tamano = $("#id_input_tamano"+idproductos_clasif).val();
	//alert(id_input_tamano);

	$.post("ajax/productos.php?op=guardar_descrip",{id_input_tamano:id_input_tamano,idproductos_clasif:idproductos_clasif},function(data, status)
	{
		data = JSON.parse(data);
		document.getElementById("tamano"+idproductos_clasif).style.display = "none";
		document.getElementById("lbl_tam"+idproductos_clasif).style.display = "block";
		$("#lbl_tam"+idproductos_clasif).text(id_input_tamano);
		//bootbox.alert("Codigo actualizado correctamente.")
		document.getElementById("check_tam"+idproductos_clasif).checked = false;

	});
}





function listar_productos_resul_tipo_sub()
{
	var select_busqueda_tipo = $("#select_busqueda_tipo").val();
	var select_busqueda_subtipo = $("#select_busqueda_subtipo").val();

	/*alert(select_busqueda_tipo);
	alert(select_busqueda_subtipo);*/

	$.post("ajax/productos.php?op=listar_productos_resul_tipo_sub&id="+select_busqueda_tipo+"&id2="+select_busqueda_subtipo,function(r){
	$("#tbl_result_prod_consul").html(r);

		
	       
	});
}

function listar_productos_resul_modelo()
{
	var select_busqueda_tipo = $("#select_busqueda_tipo").val();
	var select_busqueda_subtipo = $("#select_busqueda_subtipo").val();
	var select_busqueda_modelo = $("#select_busqueda_modelo").val();

	//alert(select_busqueda_subtipo);

	if (select_busqueda_subtipo==null || select_busqueda_subtipo=="") {

		$.post("ajax/productos.php?op=listar_productos_resul_modelo&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo,function(r){
		$("#tbl_result_prod_consul").html(r);
		       
		});

	}else{

		$.post("ajax/productos.php?op=listar_productos_resul_modelo2&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_subtipo,function(r){
		$("#tbl_result_prod_consul").html(r);
		       
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


		$.post("ajax/productos.php?op=listar_productos_resul_submodelo&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_submodelo,function(r){
		$("#tbl_result_prod_consul").html(r);
		       
		});

	}else{
		$.post("ajax/productos.php?op=listar_productos_resul_submodelo2&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_submodelo+"&id4="+select_busqueda_subtipo,function(r){
		$("#tbl_result_prod_consul").html(r);
		       
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

			$.post("ajax/productos.php?op=listar_productos_resul&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_tamano,function(r){
			$("#tbl_result_prod_consul").html(r);
			       
			});

		}else{

			$.post("ajax/productos.php?op=listar_productos_resul2&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_tamano+"&id4="+select_busqueda_submodelo,function(r){
			$("#tbl_result_prod_consul").html(r);
			       
			});
		}
			
	}else{

		if (select_busqueda_submodelo==null || select_busqueda_submodelo=="") {

			$.post("ajax/productos.php?op=listar_productos_resul3&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_tamano+"&id4="+select_busqueda_subtipo,function(r){
			$("#tbl_result_prod_consul").html(r);
			       
			});

		}else{

			$.post("ajax/productos.php?op=listar_productos_resul4&id="+select_busqueda_tipo+"&id2="+select_busqueda_modelo+"&id3="+select_busqueda_tamano+"&id4="+select_busqueda_subtipo+"&id5="+select_busqueda_submodelo,function(r){
			$("#tbl_result_prod_consul").html(r);
			       
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

			$.post("ajax/productos.php?op=listar_productos_busqueda&id="+buscar_prod_fil,function(r){
			$("#tbl_result_prod_consul").html(r);
			       
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

function listar_tipos()
{


	$.post("ajax/diseno.php?op=listar_tipos",function(r){
	$("#select_busqueda_tipo").html(r);


	       
	});
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

function listar_tipos_new()
{
	$.post("ajax/diseno.php?op=listar_tipos",function(r){
	$("#select_busqueda_tipo_nuevo").html(r);
	       
	});
}

function listar_modelo_new()
{
	$.post("ajax/diseno.php?op=listar_modelo_new",function(r){
	$("#select_busqueda_modelo_nuevo").html(r);
			       
	});
}

function listar_submodelo_new()
{
	$.post("ajax/diseno.php?op=listar_submodelo_new",function(r){
	$("#select_busqueda_submodelo_nuevo").html(r);
			       
	});
}

function listar_tamano_new()
{
	$.post("ajax/diseno.php?op=listar_tamano_new",function(r){
	$("#select_busqueda_tamano_nuevo").html(r);
			       
	});
}










function listar_subtipo_new()
{

	$.post("ajax/diseno.php?op=listar_subtipo_new",function(r){
	$("#select_busqueda_subtipo_nuevo").html(r);
		
	       
	});
}



function listar_tamano_new()
{
	$.post("ajax/diseno.php?op=listar_tamano_new",function(r){
	$("#select_busqueda_tamano_nuevo").html(r);
			       
	});
}

function listar_color_new()
{
	$.post("ajax/diseno.php?op=listar_color_new",function(r){
	$("#select_busqueda_color_nuevo").html(r);
			       
	});
}

function listar_paleta_new()
{
	$.post("ajax/diseno.php?op=listar_paleta_new",function(r){
	$("#select_busqueda_paleta_nuevo").html(r);
			       
	});
}

function listar_especif_new()
{
	$.post("ajax/diseno.php?op=listar_especif_new",function(r){
	$("#select_busqueda_especif_nuevo").html(r);
			       
	});
}

function listar_especif2_new()
{
	$.post("ajax/diseno.php?op=listar_especif2_new",function(r){
	$("#select_busqueda_especif2_nuevo").html(r);
			       
	});
}

function listar_especif3_new()
{
	$.post("ajax/diseno.php?op=listar_especif3_new",function(r){
	$("#select_busqueda_especif3_nuevo").html(r);
			       
	});
}

function nuevo_producto()
{
	var idusuario = $("#idusuario").text();

	if (idusuario==1) {
		$("#modal_nuevo_producto").modal("show");
		listar_tipos_new();
		//listar_subtipo_new();
		listar_modelo_new();
		listar_submodelo_new();
		listar_tamano_new();
		/*listar_color_new();
		listar_paleta_new();
		listar_especif_new();
		listar_especif2_new();
		listar_especif3_new();*/
	}
		
}


function update_prod_clasif()
{
	var id = 100;
	var id2 = 1230;



		$.post("ajax/productos.php?op=consul_prod_update",{id:id,id2:id2},function(data, status)
		{
			data = JSON.parse(data);

			alert("actualizado");


		});



	/*$.post("ajax/productos.php?op=update_prod_clasif"{},function(data, status)
	{
		data = JSON.parse(data);

		alert("productos actualizados");

	});*/
}

function listar_productos_fabricados()
{
	$("#consuta_productos").hide();
	$("#consulta_fabricados").show();
	$.post("ajax/productos.php?op=listar_productos_fabricados",function(r){
	$("#tbl_productos_fabricados").html(r);
			       
	});
}

function abrir_consultar()
{
	$("#consuta_productos").show();
	$("#consulta_fabricados").hide();
	$("#consulta_vendidos").hide();
}


function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'productos_fabricados.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

function abrir_pro_vendidos()
{
	$("#consuta_productos").hide();
	$("#consulta_fabricados").hide();
	$("#consulta_vendidos").show();
}


function listar_vendidos()
{
	

	var fecha_pedido1 = $("#fecha_pedido1").val();
	var fecha_pedido2 = $("#fecha_pedido2").val();

	/*alert(fecha_pedido1);
	alert(fecha_pedido2);*/

	$.post("ajax/productos.php?op=listar_vendidos&fecha_pedido1="+fecha_pedido1+"&fecha_pedido2="+fecha_pedido2,function(r){
	$("#tbl_productos_pedidos").html(r);
			       
	});
}


function exportTableToExcel_vendidos(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'productos_vendidos.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

function exportar_excel1()
{
		$.post("ajax/productos.php?op=exportar_excel1",function(data, status)
		{
			data = JSON.parse(data);
		});
}






function desactivar_producto1(idproductos_clasif,estatus)
{
	var idusuario = $("#idusuario").text();
	if (idusuario==1) {
		if (estatus==0) {
			var mensaje = "¿Desea confirmar la activación de este producto?";
		}else{
			var mensaje = "¿Desea confirmar la desactivación de este producto?";
		}
		bootbox.confirm({
		    message: mensaje,
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
		    		$.post("ajax/productos.php?op=desactivar_producto",{idproductos_clasif:idproductos_clasif,estatus:estatus},function(data, status)
					{
						data = JSON.parse(data);
							if (estatus==0) {
								bootbox.alert("Producto activado exitosamente");
							}else{
								bootbox.alert("Producto desactivado exitosamente");
							}
							listar_productos_resul_tipo();				
					});
		    	}
		    }
		});					
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción.");
	}		
}

function desactivar_producto2(idproductos_clasif,estatus)
{
	var idusuario = $("#idusuario").text();
	if (idusuario==1) {
		if (estatus==0) {
			var mensaje = "¿Desea confirmar la activación de este producto?";
		}else{
			var mensaje = "¿Desea confirmar la desactivación de este producto?";
		}
		bootbox.confirm({
		    message: mensaje,
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
		    		$.post("ajax/productos.php?op=desactivar_producto",{idproductos_clasif:idproductos_clasif,estatus:estatus},function(data, status)
					{
						data = JSON.parse(data);
							if (estatus==0) {
								bootbox.alert("Producto activado exitosamente");
							}else{
								bootbox.alert("Producto desactivado exitosamente");
							}
							listar_productos_resul_modelo();				
					});
		    	}
		    }
		});					
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción.");
	}		
}


function desactivar_producto3(idproductos_clasif,estatus)
{
	var idusuario = $("#idusuario").text();
	if (idusuario==1) {
		if (estatus==0) {
			var mensaje = "¿Desea confirmar la activación de este producto?";
		}else{
			var mensaje = "¿Desea confirmar la desactivación de este producto?";
		}
		bootbox.confirm({
		    message: mensaje,
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
		    		$.post("ajax/productos.php?op=desactivar_producto",{idproductos_clasif:idproductos_clasif,estatus:estatus},function(data, status)
					{
						data = JSON.parse(data);
							if (estatus==0) {
								bootbox.alert("Producto activado exitosamente");
							}else{
								bootbox.alert("Producto desactivado exitosamente");
							}
							listar_productos_resul();				
					});
		    	}
		    }
		});					
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción.");
	}		
}


function desactivar_producto4(idproductos_clasif,estatus)
{
	var idusuario = $("#idusuario").text();
	if (idusuario==1) {
		if (estatus==0) {
			var mensaje = "¿Desea confirmar la activación de este producto?";
		}else{
			var mensaje = "¿Desea confirmar la desactivación de este producto?";
		}
		bootbox.confirm({
		    message: mensaje,
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
		    		$.post("ajax/productos.php?op=desactivar_producto",{idproductos_clasif:idproductos_clasif,estatus:estatus},function(data, status)
					{
						data = JSON.parse(data);
							if (estatus==0) {
								bootbox.alert("Producto activado exitosamente");
							}else{
								bootbox.alert("Producto desactivado exitosamente");
							}
							listar_productos_busqueda();				
					});
		    	}
		    }
		});					
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción.");
	}		
}



function borrar_prod_consul1(idproductos_clasif)
{
	var idusuario = $("#idusuario").text();
	if (idusuario==1) {
		bootbox.confirm({
		    message: "¿Desea eliminar este producto?",
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
					$.post("ajax/productos.php?op=borrar_prod_consul",{idproductos_clasif:idproductos_clasif},function(data, status)
					{
						data = JSON.parse(data);
						bootbox.alert("Producto borrado exitosamente.");

						listar_productos_resul_tipo();	
					});
		    	}
		    }
		});		
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción.");
	}		
}


function borrar_prod_consul2(idproductos_clasif)
{
	var idusuario = $("#idusuario").text();
	if (idusuario==1) {
		bootbox.confirm({
		    message: "¿Desea eliminar este producto?",
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
					$.post("ajax/productos.php?op=borrar_prod_consul",{idproductos_clasif:idproductos_clasif},function(data, status)
					{
						data = JSON.parse(data);
						bootbox.alert("Producto borrado exitosamente.");
						listar_productos_resul_modelo();
					});
		    	}
		    }
		});		
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción.");
	}		
}

function borrar_prod_consul3(idproductos_clasif)
{
	var idusuario = $("#idusuario").text();
	if (idusuario==1) {
		bootbox.confirm({
		    message: "¿Desea eliminar este producto?",
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
					$.post("ajax/productos.php?op=borrar_prod_consul",{idproductos_clasif:idproductos_clasif},function(data, status)
					{
						data = JSON.parse(data);
						bootbox.alert("Producto borrado exitosamente.");
						listar_productos_resul();
					});
		    	}
		    }
		});		
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción.");
	}		
}

function borrar_prod_consul4(idproductos_clasif)
{
	var idusuario = $("#idusuario").text();
	if (idusuario==1) {
		bootbox.confirm({
		    message: "¿Desea eliminar este producto?",
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
					$.post("ajax/productos.php?op=borrar_prod_consul",{idproductos_clasif:idproductos_clasif},function(data, status)
					{
						data = JSON.parse(data);
						bootbox.alert("Producto borrado exitosamente.");
						listar_productos_busqueda();
					});
		    	}
		    }
		});		
	}else{
		bootbox.alert("No tiene permisos para realizar esta acción.");
	}		
}

function guardar_producto_nuevo()
{
	var codigo = $("#codigo_nuevo_reg").val();
	var nombre = $("#nombre_nuevo_reg").val();
	var tipo = $("#select_busqueda_tipo_nuevo").val();
	var modelo = $("#select_busqueda_modelo_nuevo").val();
	//var submodelo = $("#select_busqueda_submodelo_nuevo").val();
	var tamano = $("#select_busqueda_tamano_nuevo").val();
	var estatus = $("#estatus_nuevo_reg").val();
	var tipo_fab = $("#tipo_prod_esp_lin").val();


	var idusuario = $("#idusuario").text();

	if (idusuario==1) {

		if (codigo!="" && nombre!="" && tipo!="" && modelo!="" && tamano!="" && estatus!="" && tipo_fab!="") {

			$.post("ajax/diseno.php?op=guardar_producto_nuevo",{
				codigo:codigo,
				nombre:nombre,
				tipo:tipo,
				modelo:modelo,
				tamano:tamano,
				estatus:estatus,
				tipo_fab:tipo_fab
			},function(data, status)
			{
				data = JSON.parse(data);

				bootbox.alert("Producto guardado, idproductos_clasif: "+data.idproductos_clasif);

				// $("#modal_nuevo_producto").modal("hide");

				// $("#codigo_nuevo_reg").val("");
				// $("#nombre_nuevo_reg").val("");
				// $("#select_busqueda_tipo_nuevo").val("");
				// $("#select_busqueda_modelo_nuevo").val("");
				// $("#select_busqueda_tamano_nuevo").val("");
				// $("#estatus_nuevo_reg").val("");
				// $("#tipo_prod_esp_lin").val("");


			});

		}else{
			bootbox.alert("Es necesario capturar todos los datos");
		}			

	}

		

}

function open_nuevo_clase_dato(dato, action)
{
	tipo_action = action;
	if (dato==1) {

		document.getElementById("div_new_tipo").style.display="block";
		document.getElementById("div_new_modelo").style.display="none";
		document.getElementById("div_new_tamano").style.display="none";

	}
	if (dato==2) {

		var idtip = $("#select_tipo_new").val();

		if (idtip>0) {
			document.getElementById("div_new_tipo").style.display="none";
			document.getElementById("div_new_modelo").style.display="block";
			document.getElementById("div_new_tamano").style.display="none";
		}else{
			bootbox.alert("No se ha seleccionado el tipo");
		}

		
				
	}
	if (dato==3) {

		var idmod = $("#select_modelo_new").val();

		if (idmod>0) {
			document.getElementById("div_new_tipo").style.display="none";
			document.getElementById("div_new_modelo").style.display="none";
			document.getElementById("div_new_tamano").style.display="block";
		}else{
			bootbox.alert("No se ha seleccionado el modelo");
		}
		
		
		
	}
}

function close_nuevo_clase_dato(dato)
{
	if (dato==1) {
		document.getElementById("div_new_tipo").style.display="none";
		$("#input_new_tipo").val("");
	}
	if (dato==2) {
		document.getElementById("div_new_modelo").style.display="none";
		$("#input_new_modelo").val("");
	}
	if (dato==3) {
		document.getElementById("div_new_tamano").style.display="none";
		$("#input_new_tamano").val("");
	}
	
}

function guardar_nuevo_valor_clasif(dato)
{
	if (dato==1) {
		var idtipo = $("#select_tipo_new").val();
		var nombre = $("#input_new_tipo").val();

		if (nombre!="") {
			$.post("ajax/productos.php?op=guardar_nuevo_tipo",{nombre:nombre,tipo_action:tipo_action,idtipo:idtipo},function(data, status)
			{
				data = JSON.parse(data);
				$("#input_new_tipo").val("");
				if (tipo_action=="Nuevo") {
					bootbox.alert("Tipo guardado exitosamente");
				}
				if (tipo_action=="Editar") {
					bootbox.alert("Tipo actualizado exitosamente");
				}
				
				document.getElementById("div_new_tipo").style.display="none";
				

				mostrar_tipos_new();
				disabled_enabled();
				setTimeout(() => {
					mostrar_modelos_new();
					setTimeout(() => {
						mostrar_tamano_new();
					}, 500);
				}, 500);
								
			});
		}else{
			bootbox.alert("Por favor escriba el nombre del nuevo registro");
		}

		
	}

	if (dato==2) {
		var idtipo = $("#select_tipo_new").val();
		var idmodelo = $("#select_modelo_new").val();
		var nombre_m = $("#input_new_modelo").val();

		if (nombre_m!="") {
			$.post("ajax/productos.php?op=guardar_nuevo_modelo",{nombre_m:nombre_m,tipo_action:tipo_action,idtipo:idtipo,idmodelo:idmodelo},function(data, status)
			{
				data = JSON.parse(data);
				$("#input_new_modelo").val("");
				if (tipo_action=="Nuevo") {
					bootbox.alert("Modelo guardado exitosamente");
				}
				if (tipo_action=="Editar") {
					bootbox.alert("Modelo actualizado exitosamente");
				}
				
				document.getElementById("div_new_modelo").style.display="none";
				disabled_enabled();
				setTimeout(() => {
					mostrar_modelos_new();
					setTimeout(() => {
						mostrar_tamano_new();
					}, 500);
				}, 500);
								
			});
		}else{
			bootbox.alert("Por favor escriba el nombre del nuevo registro");
		}
		
		
	}

	if (dato==3) {
		var idmodelo = $("#select_modelo_new").val();
		var idtamano = $("#select_tamano_new").val();
		var nombre_t = $("#input_new_tamano").val();

		if (nombre_t!="") {
			$.post("ajax/productos.php?op=guardar_nuevo_tamano",{nombre_t:nombre_t,tipo_action:tipo_action,idmodelo:idmodelo,idtamano:idtamano},function(data, status)
			{
				data = JSON.parse(data);
				$("#input_new_tamano").val("");
				if (tipo_action=="Nuevo") {
					bootbox.alert("Tamaño guardado exitosamente");
				}
				if (tipo_action=="Editar") {
					bootbox.alert("Tamaño actualizado exitosamente");
				}
				
				document.getElementById("div_new_tamano").style.display="none";
				disabled_enabled();
				mostrar_tamano_new();
								
			});
		}else{
			bootbox.alert("Por favor escriba el nombre del nuevo registro");
		}

		
	}
	
}


function open_editar_clase_dato(action)
{
	tipo_action = action;
	var nombre = $("#select_tipo_new").find('option:selected').text();
	// var nombre = document.getElementById("select_tipo_new");
	document.getElementById("div_new_tipo").style.display="block";
	$("#input_new_tipo").val(nombre);
	
}

function open_editar_clase_dato_m(action)
{
	tipo_action = action;
	var nombre = $("#select_modelo_new").find('option:selected').text();
	// var nombre = document.getElementById("select_tipo_new");
	document.getElementById("div_new_modelo").style.display="block";
	$("#input_new_modelo").val(nombre);
	
}

function open_editar_clase_dato_t(action)
{
	tipo_action = action;
	var nombre = $("#select_tamano_new").find('option:selected').text();
	// var nombre = document.getElementById("select_tipo_new");
	document.getElementById("div_new_tamano").style.display="block";
	$("#input_new_tamano").val(nombre);
	
}

function mostrar_tipos_new()
{
	$.post("ajax/productos.php?op=listar_tipos_new",function(r){
	$("#select_tipo_new").html(r);

		disabled_enabled();
		setTimeout(() => {
			mostrar_modelos_new();
			setTimeout(() => {
				mostrar_tamano_new();
			}, 500);
		}, 500);
					   
	});
}

function mostrar_modelos_new()
{
	var idtipo = $("#select_tipo_new").val();
	$.post("ajax/productos.php?op=mostrar_modelos_new&idtipo="+idtipo,function(r){
	$("#select_modelo_new").html(r);
		
		disabled_enabled();
		setTimeout(() => {
			mostrar_tamano_new();
		}, 500);		
						   
	});
}

function mostrar_tamano_new()
{
	var idmodelo = $("#select_modelo_new").val();
	$.post("ajax/productos.php?op=mostrar_tamano_new&idmodelo="+idmodelo,function(r){
	$("#select_tamano_new").html(r);
		disabled_enabled();				   
	});
}

function disabled_enabled()
{
	$("#new_div_clasif").addClass("disabled_div");
	setTimeout(() => {
		$("#new_div_clasif").removeClass("disabled_div");
	}, 1500);
}

function abrir_reclasif(idproductos_clasif,codigo_match,descripcion)
{
	var idusuario=$("#idusuario").text();
	if (idusuario==1) {
		$("#modal_reclasif").modal("show");
		$("#b_prod_new_clasif").text(codigo_match+" - "+descripcion);
		$("#id_prod_new_c").val(idproductos_clasif);
		document.getElementById("btn_save_reclasif").style.display="block";
	}
	
}

function abrir_reclasif_blank()
{
	var idusuario=$("#idusuario").text();
	if (idusuario==1) {
		$("#modal_reclasif").modal("show");
		document.getElementById("btn_save_reclasif").style.display="none";
	}
}

function cerrar_modal_clasif()
{
	$("#modal_reclasif").modal("hide");
}

function guardar_nueva_clasificacion()
{
	var idprod = $("#id_prod_new_c").val();
	var idtipo = $("#select_tipo_new").val();
	var idmodelo = $("#select_modelo_new").val();
	var idtam = $("#select_tamano_new").val();

			$.post("ajax/productos.php?op=guardar_nueva_clasificacion",{
				idprod:idprod,
				idtipo:idtipo,
				idmodelo:idmodelo,
				idtam:idtam
			},function(data, status)
			{
				data = JSON.parse(data);
				
			});
}


init();