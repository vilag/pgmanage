function init()
{
	listar_objetivos();
}

function abrir_nuevo_objetivo()
{
	$("#modal_objetivo").modal("show");
}

function guardar_objetivo()
{
	var descrip_obj = $("#descrip_obj").val();
	var fecha_ini_obj = $("#fecha_ini_obj").val();
	var fecha_fin_obj = $("#fecha_fin_obj").val();

		$.post("ajax/projects.php?op=guardar_objetivo",{descrip_obj:descrip_obj,fecha_ini_obj:fecha_ini_obj,fecha_fin_obj:fecha_fin_obj},function(data, status)
		{
		data = JSON.parse(data);

			listar_objetivos();

		});
}

function listar_objetivos()
{
		$.post("ajax/projects.php?op=listar_objetivos",function(r){
	    $("#tbl_objetivos").html(r);

	    });
}



init();