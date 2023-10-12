function init()
{
	listar_materia_prima();		
}

function listar_materia_prima()
{
			$.post("ajax/materia_prima.php?op=listar_materia_prima",function(r){
			        $("#tbl_materia_prima").html(r);
			});
}

function nuevo_mat()
{
	$("#modal_new_mat").modal("show");
}

function guardar_mat()
{
	var descrip = $("#descrip_mat").val();
	var calibre = $("#calibre_mat").val();
	var pulgadas = $("#pulgadas_mat").val();
	var medidas = $("#medidas_mat").val();
	var unidad = $("#unidad_mat").val();

	$.post("ajax/materia_prima.php?op=guardar_mat",{descrip:descrip,calibre:calibre,pulgadas:pulgadas,medidas:medidas,unidad:unidad},function(data, status)
	{
	data = JSON.parse(data);

		listar_materia_prima();
		$("#modal_new_mat").modal("hide");

	});
}

init();