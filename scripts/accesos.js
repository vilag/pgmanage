function listar_usuarios()
{
	$.post("ajax/accesos.php?op=listar_usuarios",function(r){
		$("#tbl_usuarios_accesos").html(r);
		armar_resumen();
		filtrar_usuarios();
	});
}

//Tarjetas con el número de usuarios por categoría, tomadas de la tabla ya cargada
function armar_resumen()
{
	var categorias = [];
	var conteo = {};

	$("#tbl_usuarios_accesos .fila_usuario").each(function(){
		var id = String($(this).data("categoria"));
		if (!(id in conteo)) {
			conteo[id] = 0;
			categorias.push({ id: id, nombre: $(this).find(".col_categoria").text() });
		}
		conteo[id]++;
	});

	var html = '';
	for (var i = 0; i < categorias.length; i++) {
		html += '<div class="tarjeta_categoria" data-categoria="'+categorias[i].id+'" onclick="filtrar_categoria(\''+categorias[i].id+'\');">'
			+'<b>'+conteo[categorias[i].id]+'</b>'+$("<div>").text(categorias[i].nombre).html()+'</div>';
	}
	$("#resumen_categorias").html(html);
}

function filtrar_categoria(idcategoria)
{
	//Un segundo clic en la misma tarjeta quita el filtro
	if ($("#filtro_categoria").val() == idcategoria) {
		idcategoria = "";
	}
	$("#filtro_categoria").val(idcategoria);
	filtrar_usuarios();
}

function filtrar_usuarios()
{
	var categoria = $("#filtro_categoria").val();
	var nivel = $("#filtro_nivel").val();
	var texto = $("#filtro_texto").val().toLowerCase();

	$("#tbl_usuarios_accesos .fila_usuario").each(function(){
		var visible = (categoria === "" || categoria === null || String($(this).data("categoria")) == categoria)
			&& (nivel === "" || $(this).data("nivel") == nivel)
			&& (texto === "" || $(this).text().toLowerCase().indexOf(texto) >= 0);
		$(this).toggle(visible);
	});

	$(".tarjeta_categoria").removeClass("activa");
	if (categoria !== "" && categoria !== null) {
		$(".tarjeta_categoria[data-categoria='"+categoria+"']").addClass("activa");
	}
}

//Debe coincidir con Accesos::nivel_accesos() de modelos/Accesos.php
function nivel_accesos(num, total, num_todas, total_todas)
{
	if (total_todas > 0 && num_todas >= total_todas) return "Total";
	//Solo con permisos de administración cae en Limitado, no en Sin acceso
	if (num_todas <= 0 || total <= 0) return "Sin acceso";
	if (num >= Math.ceil(total * 0.55)) return "Alto";
	if (num >= Math.ceil(total * 0.28)) return "Medio";
	if (num >= 2) return "Básico";
	return "Limitado";
}

function actualizar_nivel_modal()
{
	var total_todas = parseInt($("#total_vistas_accesos").val());
	var total = parseInt($("#total_operativas_accesos").val());
	var num_todas = $("#box_accesos .chk_acceso:checked").length;
	var num = $("#box_accesos .chk_acceso:checked:not(.chk_admin)").length;
	var nivel = nivel_accesos(num, total, num_todas, total_todas);

	$("#nivel_accesos_modal").text(nivel).attr("data-nivel", nivel);
	$("#conteo_accesos_modal").text(num+" de "+total+" vistas de operación");
}

//Clave de cada categoría del modal (id => clave) y categorías que pueden tener el botón de cambio de menú
var categorias_modal = {};
var categorias_cambiar_menu = [];

function abrir_accesos(idusuario)
{
	$("#box_accesos").html("");
	$("#idusuario_accesos").val(idusuario);

	$.post("ajax/accesos.php?op=accesos_usuario&idusuario="+idusuario,function(data, status)
	{
		data = JSON.parse(data);

		$("#titulo_accesos").text("Accesos de: "+data.nombre);
		$("#total_vistas_accesos").val(data.total_vistas);
		$("#total_operativas_accesos").val(data.total_operativas);

		categorias_modal = {};
		categorias_cambiar_menu = data.categorias_cambiar_menu;

		var select = $("#categoria_accesos").empty();
		select.append($("<option>").val("0").text("Sin clasificar"));
		//categorias_accesos viene en la página (accesos.php)
		for (var i = 0; i < categorias_accesos.length; i++) {
			var cat = categorias_accesos[i];
			categorias_modal[cat.id] = cat.clave;
			select.append($("<option>").val(cat.id).text(cat.nombre).attr("title", cat.descripcion || "").prop("disabled", !cat.permitida));
		}
		select.val(data.idcategoria_usuario).prop("disabled", data.solo_lectura);

		$("#aviso_accesos").text(data.aviso).toggle(data.aviso != "");
		$(".btn_editar_accesos").toggle(!data.solo_lectura);

		$("#box_accesos").html(data.html);
		aplicar_reglas_categoria();

		$("#modal_accesos").modal("show");
	});
}

//Reglas que dependen de la categoría elegida (mismas que Accesos::preparar_guardado).
//Un check "forzado" guarda su valor previo para recuperarlo si se elige otra categoría.
function aplicar_reglas_categoria()
{
	var clave = categorias_modal[$("#categoria_accesos").val()] || "";
	//Nivel de administrador: administrador del sistema o developer (ver Accesos::CATEGORIAS_NIVEL_ADMIN)
	var nivel_admin = clave == "admin_sistema" || clave == "developer";
	var menu_permitido = nivel_admin || categorias_cambiar_menu.indexOf(clave) >= 0;

	$("#box_accesos .chk_acceso").each(function(){
		var chk = $(this);
		var bloqueo = chk.data("bloqueo") == 1;

		if (chk.data("forzado") == 1) {
			chk.prop("checked", chk.data("previo") == 1).data("forzado", 0);
		}

		//El administrador del sistema siempre queda con todas las vistas
		if (!bloqueo && nivel_admin) {
			chk.data("previo", chk.prop("checked") ? 1 : 0).data("forzado", 1);
			chk.prop("checked", true);
		}

		//El botón de cambio de menú solo es para Dirección o Administrativo
		if (chk.hasClass("chk_cambiar_menu") && !menu_permitido) {
			chk.data("previo", chk.prop("checked") ? 1 : 0).data("forzado", 1);
			chk.prop("checked", false);
		}

		chk.prop("disabled", bloqueo || chk.data("forzado") == 1);
	});

	actualizar_grupos();
	actualizar_nivel_modal();
}

//Marca o desmarca todas las vistas de un grupo
function marcar_grupo(chk)
{
	var grupo = $(chk).data("grupo");
	$("."+grupo+":not(:disabled)").prop("checked", chk.checked);
	actualizar_grupos();
	actualizar_nivel_modal();
}

function marcar_todos(valor)
{
	$("#box_accesos .chk_acceso:not(:disabled)").prop("checked", valor);
	actualizar_grupos();
	actualizar_nivel_modal();
}

//El check del grupo queda marcado solo si todas sus vistas lo están
function actualizar_grupos()
{
	$("#box_accesos .chk_grupo").each(function(){
		var grupo = $(this).data("grupo");
		var total = $("."+grupo).length;
		var marcados = $("."+grupo+":checked").length;
		$(this).prop("checked", total > 0 && total == marcados);
		$(this).prop("disabled", $("."+grupo+":not(:disabled)").length == 0);
	});
}

function guardar_accesos()
{
	var idusuario = $("#idusuario_accesos").val();
	var idcategoria_usuario = $("#categoria_accesos").val();
	var accesos = [];

	$("#box_accesos .chk_acceso:checked").each(function(){
		accesos.push($(this).val());
	});

	$("#btn_guardar_accesos").prop("disabled", true);

	$.post("ajax/accesos.php?op=guardar_accesos",{idusuario:idusuario, accesos:accesos, idcategoria_usuario:idcategoria_usuario},function(data, status)
	{
		data = JSON.parse(data);
		$("#btn_guardar_accesos").prop("disabled", false);

		if (data.ok) {
			$("#modal_accesos").modal("hide");
			//El menú de cada usuario se guarda 1 minuto en su sesión (header_selector.php)
			bootbox.alert("Accesos guardados. El usuario verá los cambios en su menú al abrir su siguiente página (en máximo 1 minuto).");
			listar_usuarios();
		} else {
			bootbox.alert(data.message ? data.message : "No se pudieron guardar los accesos");
		}
	});
}

function ver_bitacora()
{
	$("#tbl_bitacora").html("");
	$.post("ajax/accesos.php?op=bitacora",function(r){
		$("#tbl_bitacora").html(r);
		$("#modal_bitacora").modal("show");
	});
}

$(document).on("change", "#categoria_accesos", aplicar_reglas_categoria);

$(document).on("change", "#box_accesos .chk_acceso", function(){
	actualizar_grupos();
	actualizar_nivel_modal();
});

//Las categorías del filtro ya vienen en la página (accesos.php)
listar_usuarios();
