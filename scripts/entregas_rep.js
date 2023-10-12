function init()
{
	$("#modal_entregas").modal("show");

		var idsalida = 34;

		$.post("ajax/entregas_rep.php?op=listar_entregas_new&id="+idsalida,function(r){
			$("#box_entregas5").html(r);
		});

}




init();