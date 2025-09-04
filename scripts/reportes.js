
document.getElementById("sheetjsexport").addEventListener('click', function() {
  /* Create worksheet from HTML DOM TABLE */
  var wb = XLSX.utils.table_to_book(document.getElementById("TableToExport"));
  /* Export to file (start a download) */
  var tipo_consulta = $("#tipo_consulta").text();
  XLSX.writeFile(wb, tipo_consulta+".xlsx");
});

function init(){
    
    // location.href ="https://pgmanage.host/susp.php";
    listar_anios();
    //listar_meses();
}

function listar_anios(){
    $.post("ajax/reportes.php?op=llenar_anios",function(data, status)
	{
		data = JSON.parse(data);
		//console.log(data);
		//array_lecturas_dia = data;
        var element = document.getElementById("select_list_anios");
        while (element.firstChild) {
          element.removeChild(element.firstChild);
        }
        var anios_existentes = data;
        for (var index = 0; index < anios_existentes.length; index++) {
           if (anios_existentes[index].anios>0) {
            var fila='<option value="'+anios_existentes[index].anios+'" style="text-transform: uppercase;">'+anios_existentes[index].anios+'</option>';
            $('#select_list_anios').append(fila);
           } 
        }

        anios_existentes.sort((a, b) => b.anios - a.anios);
        var anio_actual = parseInt(anios_existentes[0].anios);
        listar_meses(anio_actual);
       // console.log(anios_existentes[0]);
	});
}

function listar_meses(anio_actual){
    $.post("ajax/reportes.php?op=llenar_meses",{anio_actual:anio_actual},function(data, status)
	{
		data = JSON.parse(data);
		//console.log(data);
		//array_lecturas_dia = data;
        var element = document.getElementById("select_list_meses");
        while (element.firstChild) {
          element.removeChild(element.firstChild);
        }
        var meses_existentes = data;
        for (var index = 0; index < meses_existentes.length; index++) {
            if (meses_existentes[index].meses==1) {meses_existentes[index].meses_nombre = "Enero";}
            if (meses_existentes[index].meses==2) {meses_existentes[index].meses_nombre = "Febrero";}
            if (meses_existentes[index].meses==3) {meses_existentes[index].meses_nombre = "Marzo";}
            if (meses_existentes[index].meses==4) {meses_existentes[index].meses_nombre = "Abril";}
            if (meses_existentes[index].meses==5) {meses_existentes[index].meses_nombre = "Mayo";}
            if (meses_existentes[index].meses==6) {meses_existentes[index].meses_nombre = "Junio";}
            if (meses_existentes[index].meses==7) {meses_existentes[index].meses_nombre = "Julio";}
            if (meses_existentes[index].meses==8) {meses_existentes[index].meses_nombre = "Agosto";}
            if (meses_existentes[index].meses==9) {meses_existentes[index].meses_nombre = "Septiembre";}
            if (meses_existentes[index].meses==10) {meses_existentes[index].meses_nombre = "Octubre";}
            if (meses_existentes[index].meses==11) {meses_existentes[index].meses_nombre = "Noviembre";}
            if (meses_existentes[index].meses==12) {meses_existentes[index].meses_nombre = "Diciembre";}
           if (meses_existentes[index].meses>0) {
            var fila='<option value="'+meses_existentes[index].meses+'" style="text-transform: uppercase;">'+meses_existentes[index].meses_nombre+'</option>';
            $('#select_list_meses').append(fila);
           } 
        }

        meses_existentes.sort((a, b) => b.meses - a.meses);
        var mes_actual = parseInt(meses_existentes[0].meses);
        var tipos_consulta_pedidos = $("#tipos_consulta_pedidos").val();
        listar_pedidos(mes_actual,anio_actual,tipos_consulta_pedidos);
	});
}

function listar_pedidos(mes_actual,anio_actual,tipos_consulta_pedidos){
    // console.log(mes_actual);
    // console.log(anio_actual);
    $.post("ajax/reportes.php?op=listar_pedidos",{mes_actual:mes_actual,anio_actual:anio_actual,tipos_consulta_pedidos:tipos_consulta_pedidos},function(data, status)
	{
		data = JSON.parse(data);
        //console.log(data);
        $("#cant_pedidos_enc").text(data.length);
        var element = document.getElementById("tbl_pedidos");
        while (element.firstChild) {
          element.removeChild(element.firstChild);
        }
        var pedidos = data;
        for (var index = 0; index < pedidos.length; index++) {
            var fila='<tr>'+
                '<td>'+(index+1)+'</td>'+
                '<td>'+pedidos[index].no_control+'</td>'+
                '<td>'+pedidos[index].fecha_pedido+'</td>'+
                '<td>'+pedidos[index].nombre_tipo+'</td>'+
                '<td>'+pedidos[index].lugar+'</td>'+
                '<td>'+pedidos[index].estatus+'</td>'+
                '</tr>';
            $('#tbl_pedidos').append(fila);
        }
        //console.log(pedidos);
       
	});

    if (tipos_consulta_pedidos==1) {
        $("#tipo_consulta").text("Todos los pedidos");
    }
    if (tipos_consulta_pedidos==2) {
        $("#tipo_consulta").text("Pedidos Entregados");
    }
    if (tipos_consulta_pedidos==3) {
        $("#tipo_consulta").text("Pedidos Pendientes");
    }
    if (tipos_consulta_pedidos==4) {
        $("#tipo_consulta").text("Pedidos Cancelados");
    }
    
}

function listar_pedidos_new(){
    var mes = $("#select_list_meses").val();
    var anio = $("#select_list_anios").val();
    var tipos_consulta_pedidos = $("#tipos_consulta_pedidos").val();
    //console.log(tipos_consulta_pedidos);
    //if (tipos_consulta_pedidos==1) {
        listar_pedidos(mes,anio,tipos_consulta_pedidos);
        console.log("Hace busqueda");
    // }else{
    //     if (tipos_consulta_pedidos==2) {
            
    //     }else{
    //         if (tipos_consulta_pedidos==3) {
                
    //         }else{
    //             if (tipos_consulta_pedidos==4) {
                    
    //             }
    //         }
    //     }
    // }
    
}












function buscar_pedidos_fabricados(){
    var fecha_ini = $("#fecha_ini_rep").val();
	var fecha_fin = $("#fecha_fin_rep").val();
    $.post("ajax/reportes.php?op=buscar_pedidos_fabricados&fecha_ini="+fecha_ini+"&fecha_fin="+fecha_fin,function(r){
	$("#tbl_pedidos_reportes").html(r);
			       
	});
}



























function buscar_reporte(){

	 listar_pedidos_entregados();
}

function listar_pedidos_entregados(){

	var fecha_ini = $("#fecha_ini").val();
	var fecha_fin = $("#fecha_fin").val();

	$.post("ajax/reportes.php?op=listar_pedidos_entregados&fecha_ini="+fecha_ini+"&fecha_fin="+fecha_fin,function(r){
	$("#tbl_pedidos_estatus").html(r);
			       
	});
}

function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'pedidos_entregados.xls';
    
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

function ver_pedidos_pendientes()
{
        $.post("ajax/reportes.php?op=listar_pedidos_pendientes",function(r){
        $("#tbl_pedidos_estatus").html(r);

        // document.getElementById("btn1").style.display = "none";
        document.getElementById("btn2").style.display = "block";
                       
        });
}


init();

