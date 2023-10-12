function init()
{
	$("#btn_tbl_prod").hide();
	$("#btn_abrir_mod_prod").hide();
	$("#btn_pedidos").hide();

	$("#form_entregas").hide();
	$("#tbl_entregas").show();
	listar_entregas()
}

function listar_entregas()
{
	$.post("ajax/entregas.php?op=listar_entregas",function(r){
	        $("#datatable_entregas").html(r);
	       
	});
}

function listar_prod_entregas(identregas)
{

	$.post("ajax/entregas.php?op=listar_prod_entregas&id="+identregas,function(r){
	        $("#datatable_prod_entregas").html(r);	       
	});
}

function reg_entrega()
{	
	var fecha=moment().format('YYYY-MM-DD');

	//alert(fecha);

	$.post("ajax/entregas.php?op=reg_entrega",{fecha:fecha},function(data, status)
	{
	data = JSON.parse(data);

		listar_entregas();
		$("#form_entregas").show();
		$("#tbl_entregas").hide();
		$("#identregas").val(data.identregas);

	});
}

function add_prod()
{
	$("#modal_reg_productos").modal("show");
}



function save_prod()
{
	var identregas = $("#identregas").val();
	var lote = $("#lote").val();
	var cantidad = $("#cantidad").val();
	var codigo = $("#codigo").val();
	var descripcion = $("#descripcion").val();


	$.post("ajax/entregas.php?op=save_prod",{identregas:identregas,lote:lote,cantidad:cantidad,codigo:codigo,descripcion:descripcion},function(data, status)
	{
	data = JSON.parse(data);

		$.post("ajax/entregas.php?op=listar_prod_entregas&id="+identregas,function(r){
	        $("#datatable_prod_entregas").html(r);	       
		});

	});
}

function save_entrega()
{
	var identregas = $("#identregas").val();

	var fecha_sal = $("#fecha_sal").val();
	var no_salida_sal = $("#no_salida_sal").val();
	var no_control_sal = $("#no_control_sal").val();
	var no_pedido_sal = $("#no_pedido_sal").val();
	var nombre_sal = $("#nombre_sal").val();
	var entregado_a_sal = $("#entregado_a_sal").val();
	var domicilio_sal = $("#domicilio_sal").val();
	var colonia_sal = $("#colonia_sal").val();
	var municipio_sal = $("#municipio_sal").val();
	var estado_sal = $("#estado_sal").val();
	var cp_sal = $("#cp_sal").val();
	var contacto_sal = $("#contacto_sal").val();
	var telefono_sal = $("#telefono_sal").val();
	var horario_sal = $("#horario_sal").val();
	var condiciones_sal = $("#condiciones_sal").val();
	var medio_sal = $("#medio_sal").val();

	$.post("ajax/entregas.php?op=save_entrega",{
		identregas:identregas,
		fecha_sal:fecha_sal,
		no_salida_sal:no_salida_sal,
		no_control_sal:no_control_sal,
		no_pedido_sal:no_pedido_sal,
		nombre_sal:nombre_sal,
		entregado_a_sal:entregado_a_sal,
		domicilio_sal:domicilio_sal,
		colonia_sal:colonia_sal,
		municipio_sal:municipio_sal,
		estado_sal:estado_sal,
		cp_sal:cp_sal,
		contacto_sal:contacto_sal,
		telefono_sal:telefono_sal,
		horario_sal:horario_sal,
		condiciones_sal:condiciones_sal,
		medio_sal:medio_sal},function(data, status)
	{
	data = JSON.parse(data);

		$("#form_entregas").hide();
		$("#tbl_entregas").show();
		listar_entregas();

	});
}



init();