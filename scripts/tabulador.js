function init()
{
		
}

function listar_material_prod()
{
	var buscar_prod = $("#buscar_prod").val();

	//alert(buscar_prod);

	$.post("ajax/tabulador.php?op=consul_categ",{buscar_prod:buscar_prod},function(data, status)
	{
	data = JSON.parse(data);

	//alert(data.idproductos_clasif);
		$("#idproducto").val(data.idproductos_clasif);
		$("#idgroup").val(data.idgroup);
		$("#codigo").text(data.codigo_match);
		$("#nombre").text(data.descripcion);
		$("#tipo").text(data.tipo);
		$("#subtipo").text(data.tipo2);
		$("#modelo").text(data.modelo);
		$("#submodelo").text(data.modelo2);
		$("#tamano").text(data.tamano);

		var idgroup = data.idgroup;
		//alert(idproducto);

		$.post("ajax/tabulador.php?op=listar_material_prod&id="+idgroup,function(r){
			$("#tbl_material_prod").html(r);
		});

		$.post("ajax/tabulador.php?op=listar_material_prod_calc&id="+idgroup,function(r){
			$("#tbl_material_prod_calc").html(r);
		});

	});

			
}

function calcular_cantidad_prod()
{
	var idgroup = $("#idgroup").val();
	var cantidad_prod = $("#cantidad_prod").val();

	$.post("ajax/tabulador.php?op=calcular_cantidad_prod&id="+idgroup+"&cant="+cantidad_prod,function(r){
			$("#tbl_material_prod_calc_num").html(r);
	});

}

function listar_materiales()
{
	$("#modal_mat").modal("show");

		$.post("ajax/tabulador.php?op=listar_materiales",function(r){
			$("#tbl_material").html(r);
		});
}

function agregar_a_producto(idmateria_prima)
{
	//alert(idmateria_prima);

	var idgroup = $("#idgroup").val();

	$.post("ajax/tabulador.php?op=agregar_a_producto",{idmateria_prima:idmateria_prima,idgroup:idgroup},function(data, status)
	{
	data = JSON.parse(data);

		listar_material_prod();

	});
}

function calcular_cortes(idmateria_prima_prod,tipo)
{
	//alert(tipo);
	var medidas_req = $("#medidas_req"+idmateria_prima_prod).val();
	var medidas2_req = $("#medidas2_req"+idmateria_prima_prod).val();
	var valor_tramo = $("#valor_tramo"+idmateria_prima_prod).val();
	var valor2_tramo = $("#valor2_tramo"+idmateria_prima_prod).val();

	if (tipo==1) {

		if (medidas_req>0 && valor_tramo>0) {

			$.post("ajax/tabulador.php?op=calcular_cortes",{idmateria_prima_prod:idmateria_prima_prod,medidas_req:medidas_req,valor_tramo:valor_tramo},function(data, status)
			{
			data = JSON.parse(data);
				listar_material_prod();
			});

		}

	}

	if (tipo==2) {

		if (medidas_req>0 && valor_tramo>0 && medidas2_req>0 && valor2_tramo>0) {

			/*alert(medidas_req)
			alert(valor_tramo)
			alert(medidas2_req)
			alert(valor2_tramo)*/

			$.post("ajax/tabulador.php?op=calcular_cortes2",{idmateria_prima_prod:idmateria_prima_prod,medidas_req:medidas_req,medidas2_req:medidas2_req,valor_tramo:valor_tramo,valor2_tramo:valor2_tramo},function(data, status)
			{
			data = JSON.parse(data);
				listar_material_prod();
			});

		}

	}

			
}


function actualizar_mat_prod(idmateria_prima_prod)
{
	var cantidad = $("#cantidad"+idmateria_prima_prod).val();
	/*var medidas_req = $("#medidas_req"+idmateria_prima_prod).val();
	var valor_tramo = $("#valor_tramo"+idmateria_prima_prod).val();
	var cortes = $("#cortes"+idmateria_prima_prod).val();
	var remanente = $("#remanente"+idmateria_prima_prod).val();*/

	$.post("ajax/tabulador.php?op=actualizar_mat_prod",{
		idmateria_prima_prod:idmateria_prima_prod,
		cantidad:cantidad},function(data, status)
	{
	data = JSON.parse(data);

	});
}


init();