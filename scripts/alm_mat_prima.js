var idusuario = $("#idusuario").text();
function init()
{
    listar_productos_mat();
    listar_tipos_select();
    listar_movimientos_gen();
}

function listar_productos_mat()
{
    $.post("ajax/alm_mat_prima.php?op=listar_productos_mat",function(r){
        $("#content_tbl_prod").html(r);        
       
    });
}

function listar_tipos_select()
{
    $.post("ajax/alm_mat_prima.php?op=listar_tipos_select",function(r){
        $("#tipo").html(r);
        $("#tipo_select_prod").html(r);        
       
    });
}

function validar()
{
    if (idusuario==27 || idusuario==1) {
        var nombre = $("#nombre").val();

        if (nombre!="") {
            $.post("ajax/alm_mat_prima.php?op=coincidencias&nombre="+nombre,function(r){
                $("#tbl_coin_prod_alm_mp").html(r);
                
                $("#modal_coin").modal("show");
            
            });
        }else{
            bootbox.alert("Por favor capture el nombre");
        }
    }
}

function guardar_producto()
{
    if (idusuario==27 || idusuario==1) {
        var nombre = $("#nombre").val();
        var descripcion = "";
        var cantidad = 0;
        var tipo = $("#tipo").val();
        //var lote = $("#lote").val();
        var ubicacion = $("#ubicacion").val();
        var folio_prov = $("#folio_prov").val();
        var observaciones = $("#observaciones").val();

        if (nombre!="" && tipo!="" && ubicacion!="") {

            $.post("ajax/alm_mat_prima.php?op=max_consec",function(data, status)
            {
                data = JSON.parse(data);

                var next_consec = parseInt(data.max)+1;

                //alert(next_consec);

                $.post("ajax/alm_mat_prima.php?op=guardar_producto",{
                    nombre:nombre,
                    descripcion:descripcion,
                    cantidad:cantidad,
                    tipo:tipo,
                    next_consec:next_consec,
                    ubicacion:ubicacion,
                    folio_prov:folio_prov,
                    observaciones:observaciones
                },function(data, status)
                {
                    data = JSON.parse(data);
                    var notificator = new Notification(document.querySelector('.notification'));
                    notificator.info('Producto guardado exitosamente.');

                    $("#modal_coin").modal("hide");
                
                    $("#nombre").val("");
                    // $("#descripcion").val("");
                    //$("#cantidad").val("");
                    $("#tipo").val("");
                    $("#ubicacion").val("");
                    $("#folio_prov").val("");
                    $("#observaciones").val("");
                    listar_productos_mat("");
                });
            });
        }else{
            bootbox.alert("Es necesario capturar los datos obligatorios");
        }
    }
    

    

    
}

function ver_form_prod()
{
   
    document.getElementById("cont_tbl_prod").style.display="block";
    document.getElementById("content_tbl_tipo").style.display="none";
    document.getElementById("div_form_prod").style.display="block";
    document.getElementById("div_form_tipo").style.display="none";
    listar_tipos_select();
}

function ver_form_tipos()
{
    var altura = screen.height;
    document.getElementById("content_tbl_tipo").style.height=(altura-370)+"px";
    document.getElementById("cont_tbl_prod").style.display="none";
    document.getElementById("content_tbl_tipo").style.display="block";
    document.getElementById("div_form_prod").style.display="none";
    document.getElementById("div_form_tipo").style.display="block";

    listar_tipos();
}

function listar_tipos()
{
    $.post("ajax/alm_mat_prima.php?op=listar_tipos",function(r){
        $("#tbl_tipos_met_prim").html(r);        
       
    });
}

function guardar_tipo()
{
    if (idusuario==27 || idusuario==1) {
        var nombre = $("#nombre_tipo").val();
        var descripcion = $("#descripcion_tipo").val();

        if (nombre!="") {
            $.post("ajax/alm_mat_prima.php?op=guardar_tipo",{
                nombre:nombre,
                descripcion:descripcion
            },function(data, status)
            {
                data = JSON.parse(data);
                var notificator = new Notification(document.querySelector('.notification'));
                notificator.info('Tipo agregado correctamente.');
                // bootbox.alert("Tipo guardado exitosamente");
                $("#nombre_tipo").val("");
                $("#descripcion_tipo").val("");
                listar_tipos();
            });
        }else{
            bootbox.alert("Es necesario capturar el nombre");
        }
    }
    
}

function back_list(){
    document.getElementById("div_reg_prod_mat").style.display="block";
    document.getElementById("div_ent_sal_prod_mat").style.display="none";
    $("#id_select_prod").val("");
    listar_movimientos();
    listar_movimientos_gen();
}

function ver_producto(id_prod_alm_mat, nombre, descripcion, cantidad, tipo, idtipo, consec, observaciones, ubicacion, folio_prov){
    document.getElementById("div_reg_prod_mat").style.display="none";
    document.getElementById("div_ent_sal_prod_mat").style.display="block";
    

    $("#nombre_select_prod").val(nombre);
    $("#nombre_entrada").val(nombre);
    $("#nombre_salida").val(nombre);
    $("#descripcion_select_prod").val(descripcion);
    $("#tipo_select_prod").val(tipo);
    $("#ubicacion_select_prod").val(ubicacion);
    $("#lote_select_prod").val(consec);
    $("#folio_select_prod").val(folio_prov);
    $("#observacion_select_prod").val(observaciones);
    // $("#cantidad_select_prod").text(cantidad);
    $("#id_select_prod").val(id_prod_alm_mat);

    document.getElementById("div_producto_alm_mat").style.display = "block";
    document.getElementById("div_producto_alm_mat_ent").style.display = "none";
    document.getElementById("div_producto_alm_mat_sal").style.display = "none";

    $.post("ajax/alm_mat_prima.php?op=listar_tipos_select",function(r){
        $("#tipo_select_prod").html(r);        
        $("#tipo_select_prod").val(idtipo);
    });

    $.post("ajax/alm_mat_prima.php?op=listar_mov_entradas",function(r){
        $("#tipo_select_prod").html(r);        
    });

    document.getElementById("div_registros").style.display="block";
    document.getElementById("div_reg_entradas").style.display="none";
    document.getElementById("div_reg_salidas").style.display="none";

    contar_existencia();
    setTimeout(() => {
        listar_movimientos();
    }, 2000);
    

}

function buscar_prod_mat(){
    var texto = $("#input_buscar_prod_alm_mat").val();
    $.post("ajax/alm_mat_prima.php?op=buscar_prod_mat&texto="+texto,function(r){
        $("#content_tbl_prod").html(r);        
        $("#input_buscar_prod_alm_mat").val("");
    });
}

function habilitar_edicion(){
    document.getElementById("nombre_select_prod").disabled = false;
    document.getElementById("descripcion_select_prod").disabled = false;
    document.getElementById("tipo_select_prod").disabled = false;
    document.getElementById("ubicacion_select_prod").disabled = false;
    document.getElementById("lote_select_prod").disabled = false;
    document.getElementById("folio_select_prod").disabled = false;
    document.getElementById("observacion_select_prod").disabled = false;
    document.getElementById("cantidad_select_prod").disabled = false;
    document.getElementById("btn_save_update_prod_almp").disabled = false;

    document.getElementById("div_producto_alm_mat").style.display = "block";
    document.getElementById("div_producto_alm_mat_ent").style.display = "none";
    document.getElementById("div_producto_alm_mat_sal").style.display = "none";

    document.getElementById("div_registros").style.display="block";
    document.getElementById("div_reg_entradas").style.display="none";
    document.getElementById("div_reg_salidas").style.display="none";

    listar_movimientos();
   
}

function registrar_entrada(){
    document.getElementById("div_producto_alm_mat").style.display = "none";
    document.getElementById("div_producto_alm_mat_ent").style.display = "block";
    document.getElementById("div_producto_alm_mat_sal").style.display = "none";

    document.getElementById("div_registros").style.display="none";
    document.getElementById("div_reg_entradas").style.display="block";
    document.getElementById("div_reg_salidas").style.display="none";

    listar_mov_entrada();
    contar_existencia();
}

function listar_mov_entrada(){
    var id_prod_alm_mat = $("#id_select_prod").val();
    $.post("ajax/alm_mat_prima.php?op=listar_movimientos_entradas_prod&idprod="+id_prod_alm_mat,function(r){
        $("#tbl_entradas_prod").html(r);        
    });
}

function registrar_salida(){
    document.getElementById("div_producto_alm_mat").style.display = "none";
    document.getElementById("div_producto_alm_mat_ent").style.display = "none";
    document.getElementById("div_producto_alm_mat_sal").style.display = "block";

    document.getElementById("div_registros").style.display="none";
    document.getElementById("div_reg_entradas").style.display="none";
    document.getElementById("div_reg_salidas").style.display="block";
    listar_mov_salida();
    contar_existencia();
}

function listar_mov_salida(){
    var id_prod_alm_mat = $("#id_select_prod").val();
    $.post("ajax/alm_mat_prima.php?op=listar_movimientos_salidas_prod&idprod="+id_prod_alm_mat,function(r){
        $("#tbl_salidas_prod").html(r);        
    });
}

function guardar_entrada(){
    if (idusuario==27 || idusuario==1) {

        var id_select_prod = $("#id_select_prod").val();
        var cantidad_entrada = $("#cantidad_entrada").val();
        var proveedor_entrada = $("#proveedor_entrada").val();
        var lote_entrada = $("#lote_entrada").val();

        $.post("ajax/alm_mat_prima.php?op=guardar_entrada",{
            id_select_prod:id_select_prod,
            cantidad_entrada:cantidad_entrada,
            proveedor_entrada:proveedor_entrada,
            lote_entrada:lote_entrada
        },function(data, status)
        {
            data = JSON.parse(data);
            var notificator = new Notification(document.querySelector('.notification'));
            notificator.info('Entrada guardada exitosamente.');

            listar_mov_entrada();
            contar_existencia();
        
        });
    }
    
}

function guardar_salida(){
    if (idusuario==27 || idusuario==1) {
        var id_select_prod = $("#id_select_prod").val();
        var cantidad_salida = $("#cantidad_salida").val();
        var proveedor_salida = $("#proveedor_salida").val();
        var lote_salida = $("#lote_salida").val();
        var no_control_salida = $("#no_control_salida").val();
        var op_salida = $("#op_salida").val();

        $.post("ajax/alm_mat_prima.php?op=guardar_salida",{
            id_select_prod:id_select_prod,
            cantidad_salida:cantidad_salida,
            proveedor_salida:proveedor_salida,
            lote_salida:lote_salida,
            no_control_salida:no_control_salida,
            op_salida:op_salida
        },function(data, status)
        {
            data = JSON.parse(data);
            var notificator = new Notification(document.querySelector('.notification'));
            notificator.info('Salida guardada exitosamente.');

            listar_mov_salida();
            contar_existencia();
        
        });
    }
    
}

function listar_movimientos(){
    var id_prod_alm_mat = $("#id_select_prod").val();
    $.post("ajax/alm_mat_prima.php?op=listar_movimientos_entradas&idprod="+id_prod_alm_mat,function(r){
        $("#tbl_entradas").html(r);        
    });

    $.post("ajax/alm_mat_prima.php?op=listar_movimientos_salidas&idprod="+id_prod_alm_mat,function(r){
        $("#tbl_salidas").html(r);        
    });

    
}

function listar_movimientos_gen(){
    //var id_prod_alm_mat = 0;
    $.post("ajax/alm_mat_prima.php?op=listar_movimientos_entradas_gen",function(r){
        $("#tbl_entradas_gen").html(r);        
    });

    $.post("ajax/alm_mat_prima.php?op=listar_movimientos_salidas_gen",function(r){
        $("#tbl_salidas_gen").html(r);        
    });

    
}

function contar_existencia()
{
    var id_prod_alm_mat = $("#id_select_prod").val();
    $.post("ajax/alm_mat_prima.php?op=contar_existencia",{id_prod_alm_mat:id_prod_alm_mat},function(data, status)
    {
        data = JSON.parse(data);

        if (data.entradas==null) {
            var entradas = 0;
        }else{
            var entradas = data.entradas;
        }

        if (data.salidas==null) {
            var salidas = 0;
        }else{
            var salidas = data.salidas;
        }

      

        $("#cantidad_select_prod").text(parseInt(entradas)-parseInt(salidas));
    
    });
}

function borrar_producto(id_prod_alm_mat)
{
    if (idusuario==27 || idusuario==1) {
        bootbox.confirm({
            message: '¿Esta seguro de eliminar este producto?, se perderan todas las entradas y salidas.',
            buttons: {
            confirm: {
            label: 'Si',
            className: 'btn-success'
            },
            cancel: {
            label: 'No',
            className: 'btn-danger'
            }
            },
            callback: function (result) {
                if (result) {

                    $.post("ajax/alm_mat_prima.php?op=borrar_producto",{id_prod_alm_mat:id_prod_alm_mat},function(data, status)
                    {
                        data = JSON.parse(data);
                        var notificator = new Notification(document.querySelector('.notification'));
                        notificator.info('Producto borrado exitosamente.');
                        listar_productos_mat();
                    });
                    
                }
            }
        });
    }
    


    
}

init();