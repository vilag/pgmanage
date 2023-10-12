function listar_prod()
{	  
	  $.post("ajax/correcciones.php?op=listar_prod",function(r){
	        $("#tbl_prod_op").html(r);

	  });	  
}

function quitar(idop_detalle_prod)
{

	$.post("ajax/correcciones.php?op=exist_avance",{idop_detalle_prod:idop_detalle_prod},function(data, status)
	{
	data = JSON.parse(data);

		var avance = data.avance;

		if (avance==0) {

			$.post("ajax/correcciones.php?op=quitar",{idop_detalle_prod:idop_detalle_prod},function(data, status)
			{
			data = JSON.parse(data);

			document.getElementById("lbl_op"+idop_detalle_prod).style.display = "none";

			});
		}else{
			bootbox.alert("No se puede eliminar porque esta OP ya tiene avance de produccion");
		}



	});


	
}

listar_prod();