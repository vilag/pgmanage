
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
        var html = '';
        for (var index = 0; index < pedidos.length; index++) {
            html += '<tr>'+
                '<td>'+(index+1)+'</td>'+
                '<td>'+pedidos[index].no_control+'</td>'+
                '<td>'+pedidos[index].fecha_pedido+'</td>'+
                '<td>'+pedidos[index].nombre_tipo+'</td>'+
                '<td>'+pedidos[index].lugar+'</td>'+
                '<td>'+pedidos[index].estatus+'</td>'+
                '</tr>';
        }
        document.getElementById('tbl_pedidos').innerHTML = html;
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


// =====================================================
// REPORTE: PRODUCTOS POR PEDIDO
// =====================================================

document.getElementById("btn_export_prod").addEventListener('click', function() {
    var wb = XLSX.utils.table_to_book(document.getElementById("TableProdToExport"));
    var anio = $("#select_anio_prod").val();
    XLSX.writeFile(wb, "productos_pedidos_" + anio + ".xlsx");
});

function listar_anios_prod() {
    $.post("ajax/reportes.php?op=llenar_anios_prod", function(data) {
        data = JSON.parse(data);
        var element = document.getElementById("select_anio_prod");
        while (element.firstChild) element.removeChild(element.firstChild);
        data.sort(function(a, b) { return b.anios - a.anios; });
        for (var i = 0; i < data.length; i++) {
            if (data[i].anios > 0) {
                var opt = '<option value="' + data[i].anios + '">' + data[i].anios + '</option>';
                $('#select_anio_prod').append(opt);
            }
        }
        // no auto-load: el usuario debe hacer clic en Buscar
    });
}

function listar_productos_pedidos(anio) {
    document.getElementById("msg_inicio_prod").style.display = "none";
    document.getElementById("loader_prod").style.display = "block";
    document.getElementById("contenedor_tabla_prod").style.display = "none";
    document.getElementById("cant_prod_enc").innerText = "";
    document.getElementById("lbl_prod_enc").innerText = "";
    var element = document.getElementById("tbl_prod_pedidos");
    while (element.firstChild) element.removeChild(element.firstChild);

    $.post("ajax/reportes.php?op=listar_productos_pedidos", { anio: anio }, function(data) {
        document.getElementById("loader_prod").style.display = "none";
        document.getElementById("contenedor_tabla_prod").style.display = "block";
        data = JSON.parse(data);
        document.getElementById("cant_prod_enc").innerText = data.length + " productos";
        document.getElementById("lbl_prod_enc").innerText = "encontrados para el año " + anio;
        document.getElementById("controles_orden_prod").style.display = "block";
        var html = '';
        for (var i = 0; i < data.length; i++) {
            var d = data[i];
            html += '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + (d.fecha_pedido   || '') + '</td>' +
                '<td>' + (d.no_control     || '') + '</td>' +
                '<td>' + (d.no_op          || 'NA') + '</td>' +
                '<td>' + (d.areas_op       || 'NA') + '</td>' +
                '<td>' + (d.cantidad       || '') + '</td>' +
                '<td>' + (d.codigo         || '') + '</td>' +
                '<td>' + (d.descripcion    || '') + '</td>' +
                '<td>' + (d.fecha_entrega  || '') + '</td>' +
                '<td>' + (d.vendedor       || '') + '</td>' +
                '<td>' + (d.estatus        || '') + '</td>' +
                '<td>' + (d.cliente        || '') + '</td>' +
                '</tr>';
        }
        document.getElementById('tbl_prod_pedidos').innerHTML = html;
    });
}

function listar_productos_pedidos_new() {
    var anio = $("#select_anio_prod").val();
    listar_productos_pedidos(anio);
}

listar_anios_prod();

// ── Ordenamiento de tabla Productos por Pedido ──────────────────────────────
var _sortDir = 'asc';

function toggleSortDir() {
    _sortDir = _sortDir === 'asc' ? 'desc' : 'asc';
    document.getElementById('btn_toggle_dir').innerHTML = _sortDir === 'asc' ? '&#8593; Asc' : '&#8595; Desc';
}

function aplicar_orden() {
    var colIndex = parseInt(document.getElementById('select_col_orden').value);
    var dir = _sortDir;
    var tbody = document.getElementById('tbl_prod_pedidos');
    var rows  = Array.from(tbody.querySelectorAll('tr'));

    rows.sort(function(a, b) {
        var aVal = a.cells[colIndex] ? a.cells[colIndex].textContent.trim() : '';
        var bVal = b.cells[colIndex] ? b.cells[colIndex].textContent.trim() : '';

        // Numérico
        var aNum = parseFloat(aVal.replace(/,/g, ''));
        var bNum = parseFloat(bVal.replace(/,/g, ''));
        if (!isNaN(aNum) && !isNaN(bNum) && aVal !== '' && bVal !== '') {
            return dir === 'asc' ? aNum - bNum : bNum - aNum;
        }

        // Fecha (formato YYYY-MM-DD o DD/MM/YYYY)
        var aDate = new Date(aVal);
        var bDate = new Date(bVal);
        if (!isNaN(aDate) && !isNaN(bDate) && aVal.match(/\d{4}|\d{2}[\/\-]\d{2}/)) {
            return dir === 'asc' ? aDate - bDate : bDate - aDate;
        }

        // Texto
        return dir === 'asc'
            ? aVal.localeCompare(bVal, 'es', { sensitivity: 'base' })
            : bVal.localeCompare(aVal, 'es', { sensitivity: 'base' });
    });

    // Reinserta filas ordenadas y renueva columna #
    rows.forEach(function(row, i) {
        if (row.cells[0]) row.cells[0].textContent = i + 1;
        tbody.appendChild(row);
    });
}
// ────────────────────────────────────────────────────────────────────────────

function buscar_no_control(valor) {
    var filas = document.querySelectorAll('#tbl_prod_pedidos tr');
    var valor_limpio = valor.trim().toLowerCase();
    var primera_coincidencia = null;
    var total = 0;

    filas.forEach(function(fila) {
        var celda = fila.cells[2]; // columna No. Control (índice 2)
        if (!celda) return;
        var texto = celda.textContent.trim().toLowerCase();
        var coincide = valor_limpio !== '' && texto === valor_limpio;

        fila.style.backgroundColor = coincide ? '#fff3cd' : '';
        fila.style.fontWeight      = coincide ? 'bold'    : '';

        if (coincide) {
            total++;
            if (!primera_coincidencia) primera_coincidencia = fila;
        }
    });

    var lbl = document.getElementById('lbl_resultado_busqueda');
    if (valor_limpio === '') {
        lbl.textContent = '';
        return;
    }

    if (primera_coincidencia) {
        lbl.textContent = total + ' fila(s) encontrada(s)';
        lbl.style.color = '#076649';
        var contenedor = document.getElementById('contenedor_tabla_prod');
        // scroll al row dentro del contenedor
        var offsetRelativo = primera_coincidencia.offsetTop - contenedor.offsetTop;
        contenedor.scrollTop = offsetRelativo - 40;
    } else {
        lbl.textContent = 'No. Control no encontrado';
        lbl.style.color = '#c0392b';
    }
}

