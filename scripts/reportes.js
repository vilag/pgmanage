function init(){
    location.href ="https://pgmanage.host/susp.php";
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

        document.getElementById("btn1").style.display = "none";
        document.getElementById("btn2").style.display = "block";
                       
        });
}


init();

