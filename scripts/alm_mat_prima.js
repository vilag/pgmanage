var idusuario = $("#idusuario").text();
function init()
{
    location.href ="https://pgmanage.host/susp.php";
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

function update_producto()
{
    if (idusuario==1) {
        var nombre = $("#nombre_select_prod").val();
        var descripcion = "";
        var cantidad = 0;
        var tipo = $("#tipo_select_prod").val();
        //var lote = $("#lote").val();
        var ubicacion = $("#ubicacion_select_prod").val();
        var folio_prov = $("#folio_select_prod").val();
        var observaciones = $("#observacion_select_prod").val();

        var id_prod_alm_mat = $("#id_select_prod").val();

        if (nombre!="" && tipo!="" && ubicacion!="") {


                $.post("ajax/alm_mat_prima.php?op=update_producto",{
                    nombre:nombre,
                    descripcion:descripcion,
                    cantidad:cantidad,
                    tipo:tipo,
                    ubicacion:ubicacion,
                    folio_prov:folio_prov,
                    observaciones:observaciones,
                    id_prod_alm_mat:id_prod_alm_mat
                },function(data, status)
                {
                    data = JSON.parse(data);
                    var notificator = new Notification(document.querySelector('.notification'));
                    notificator.info('Producto actualizado exitosamente.');
                    listar_productos_mat();
                });
           
        }else{
            bootbox.alert("Es necesario capturar los datos obligatorios");
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
        var unidad = $("#unidad").val();

        if (nombre!="" && tipo!="" && ubicacion!="" && unidad!="") {

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
                    observaciones:observaciones,
                    unidad:unidad
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
                    listar_productos_mat();
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

function ver_producto(id_prod_alm_mat){
    document.getElementById("div_reg_prod_mat").style.display="none";
    document.getElementById("div_ent_sal_prod_mat").style.display="block";

    var nombre = $("#nombre_pmp"+id_prod_alm_mat).text();
    var descripcion = $("#descripcion_pmp"+id_prod_alm_mat).text();
    var cantidad = $("#cantidad_pmp"+id_prod_alm_mat).text();
    var tipo = $("#tipo_pmp"+id_prod_alm_mat).text();
    var idtipo = $("#idtipo_pmp"+id_prod_alm_mat).text();
    var consec = $("#consec_pmp"+id_prod_alm_mat).text();
    var observaciones = $("#observaciones_pmp"+id_prod_alm_mat).text();
    var ubicacion = $("#ubicacion_pmp"+id_prod_alm_mat).text();
    var folio_prov = $("#folio_prov_pmp"+id_prod_alm_mat).text();
    var unidad = $("#unidad_pmp"+id_prod_alm_mat).text();
    

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
    $("#unidad_medida").val(unidad);

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
    if (idusuario==1) {
        document.getElementById("nombre_select_prod").disabled = false;
        // document.getElementById("descripcion_select_prod").disabled = false;
        document.getElementById("tipo_select_prod").disabled = false;
        
        // document.getElementById("lote_select_prod").disabled = false;
        document.getElementById("folio_select_prod").disabled = false;
        
        // document.getElementById("cantidad_select_prod").disabled = false;
        document.getElementById("btn_save_update_prod_almp").disabled = false;

        document.getElementById("div_producto_alm_mat").style.display = "block";
        document.getElementById("div_producto_alm_mat_ent").style.display = "none";
        document.getElementById("div_producto_alm_mat_sal").style.display = "none";

        document.getElementById("div_registros").style.display="block";
        document.getElementById("div_reg_entradas").style.display="none";
        document.getElementById("div_reg_salidas").style.display="none";

        
    }

    listar_movimientos();
    document.getElementById("ubicacion_select_prod").disabled = false;
    document.getElementById("observacion_select_prod").disabled = false;
    
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

    
    // var element = document.getElementById("tbl_salidas");
    // while (element.firstChild) {
    //     element.removeChild(element.firstChild);
    // }
}

function listar_mov_salida(){
    var id_prod_alm_mat = $("#id_select_prod").val();
    $.post("ajax/alm_mat_prima.php?op=listar_movimientos_salidas_prod&idprod="+id_prod_alm_mat,function(r){
        $("#tbl_salidas_prod").html(r);        
    });
}
let dialog_li;
var idnew;
function guardar_entrada(){
    if (idusuario==27 || idusuario==1) {

        var id_select_prod = $("#id_select_prod").val();
        var cantidad_entrada = $("#cantidad_entrada").val();
        var proveedor_entrada = $("#proveedor_entrada").val();
        var lote_entrada = "";
        var observacion = $("#observ_entrada").val();

        var fecha=moment().format('YYYY-MM-DD');
        var hora=moment().format('HH:mm:ss');
        var fecha_hora=fecha+" "+hora;

        var mes = moment().format('MM');
        var anio = moment().format('YY');

        if (cantidad_entrada>0) {

            $.post("ajax/alm_mat_prima.php?op=guardar_entrada",{
                id_select_prod:id_select_prod,
                cantidad_entrada:cantidad_entrada,
                proveedor_entrada:proveedor_entrada,
                lote_entrada:lote_entrada,
                fecha_hora:fecha_hora,
                observacion:observacion
            },function(data, status)
            {
                data = JSON.parse(data);
                var notificator = new Notification(document.querySelector('.notification'));
                notificator.info('Entrada guardada exitosamente.');

                // bootbox.alert("Registro creado exitosamente. FOLIO: "+data.identrada);

                listar_mov_entrada();
                contar_existencia();

                idnew = data.identrada;
                dialog_li = bootbox.dialog({
                    message: '<div>'+
                                '<div>'+
                                    '<p>ID creado: '+idnew+'</p>'+
                                    '<p>¿Desea actualizar a lote interno?</p>'+
                                '</div>'+
                                '<div>'+
                                    '<label>Folio sugerido</label>'+
                                    '<input type="text" class="form-control" id="lote_interno_upd" value="MP'+idnew+mes+anio+'">'+
                                '</div>'+
                                '<div style="margin-top: 10px;">'+
                                    '<button class="btn btn-secondary" onclick="cerrar_dialog();">No Actualizar</button>'+
                                    '<button class="btn btn-primary" onclick="update_lote_int('+idnew+');">Actualizar</button>'+
                                '</div>'+
                                
                            '</div>',
                    closeButton: false
                    });

                    // do something in the background
                    

                
            
            });
        }else{
            bootbox.alert("Es necesario capturar la cantidad");
        }
        

        
    }
    
}

function update_lote_int(idnew)
{
    var newlote = $("#lote_interno_upd").val();

    if (newlote!="") {
        $.post("ajax/alm_mat_prima.php?op=update_lote_int",{idnew:idnew,newlote:newlote},function(data, status)
        {
            data = JSON.parse(data);
            var notificator = new Notification(document.querySelector('.notification'));
            notificator.info('Lote actualizado correctamente.');
            dialog_li.modal('hide');
            listar_mov_entrada();
        });
    }else{
        bootbox.alert("Por favor capture el lote.");
    }

    
    
}

function cerrar_dialog()
{
    dialog_li.modal('hide');
}

function guardar_salida(){
    if (idusuario==27 || idusuario==1) {
        var id_select_prod = $("#id_select_prod").val();
        var cantidad_salida = $("#cantidad_salida").val();
        var proveedor_salida = $("#proveedor_salida").val();
        var lote_salida = $("#lote_salida").val();
        var no_control_salida = $("#no_control_salida").val();
        var op_salida = $("#op_salida").val();
        var observacion = $("#observ_salida").val();

        var fecha=moment().format('YYYY-MM-DD');
        var hora=moment().format('HH:mm:ss');
        var fecha_hora=fecha+" "+hora;

        $.post("ajax/alm_mat_prima.php?op=guardar_salida",{
            id_select_prod:id_select_prod,
            cantidad_salida:cantidad_salida,
            proveedor_salida:proveedor_salida,
            lote_salida:lote_salida,
            no_control_salida:no_control_salida,
            op_salida:op_salida,
            fecha_hora:fecha_hora,
            observacion:observacion
        },function(data, status)
        {
            data = JSON.parse(data);
            var notificator = new Notification(document.querySelector('.notification'));
            notificator.info('Salida guardada exitosamente.');

            listar_mov_salida();
            contar_existencia();
            listar_movimientos();
        
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
    var unidad_medida = $("#unidad_medida").val();
    $("#cantidad_select_prod").text("");
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

       // alert((parseFloat(entradas)-parseFloat(salidas))+" "+unidad_medida);

        $("#cantidad_select_prod").text((parseFloat(entradas)-parseFloat(salidas))+" "+unidad_medida);
    
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

var dialog_edit_salida;
function editar_salida(idsalida){

    if (idusuario==1) {

        var cantidad = $("#tbl_sal_cant"+idsalida).text();
        var proveedor = $("#tbl_sal_prov"+idsalida).text();
        var lote = $("#tbl_sal_lote"+idsalida).text();
        var no_control = $("#tbl_sal_cont"+idsalida).text();
        var op = $("#tbl_sal_op"+idsalida).text();
        var obs = $("#tbl_sal_obs"+idsalida).text();

        dialog_edit_salida = bootbox.dialog({
            message: '<div>'+
                        '<div class="form-group col-md-12 col-sm-12">'+
                            '<p style="margin: 0px;">Actualizar registro de salida.</p>'+
                            '<p style="margin: 0px;">ID: '+idsalida+'</p>'+
                        '</div>'+
                        '<div class="form-group col-md-6 col-sm-6">'+
                            '<label>Cantidad</label>'+
                            '<input type="text" class="form-control" value="'+cantidad+'" id="input_upd_salida_cant'+idsalida+'">'+
                        '</div>'+
                        '<div class="form-group col-md-6 col-sm-6">'+
                            '<label>Proveedor</label>'+
                            '<input type="text" class="form-control" value="'+proveedor+'" id="input_upd_salida_prov'+idsalida+'">'+
                        '</div>'+
                        '<div class="form-group col-md-6 col-sm-6">'+
                            '<label>Lote</label>'+
                            '<input type="text" class="form-control" value="'+lote+'" id="input_upd_salida_lote'+idsalida+'">'+
                        '</div>'+
                        '<div class="form-group col-md-6 col-sm-6">'+
                            '<label>No. Control</label>'+
                            '<input type="text" class="form-control" value="'+no_control+'" id="input_upd_salida_control'+idsalida+'">'+
                        '</div>'+
                        '<div class="form-group col-md-6 col-sm-6">'+
                            '<label>OP</label>'+
                            '<input type="text" class="form-control" value="'+op+'" id="input_upd_salida_op'+idsalida+'">'+
                        '</div>'+
                        '<div class="form-group col-md-6 col-sm-6">'+
                            '<label>Observación</label>'+
                            '<input type="text" class="form-control" value="'+obs+'" id="input_upd_salida_obs'+idsalida+'">'+
                        '</div>'+
                        '<div class="form-group col-md-12 col-sm-12" style="padding: 20px; text-align: center;">'+
                            '<button class="btn btn-secondary" onclick="cancelupdateSalidaAmp();">No Actualizar</button>'+
                            '<button class="btn btn-primary" onclick="updateSalidaAmp('+idsalida+');">Actualizar</button>'+
                        '</div>'+
                        
                    '</div>',
            closeButton: false
        });

    }else{
        bootbox.alert("Por el momento no tienes permisos para realizar esta acción, solicta los permisos con el administrador del sistema.");
    }

}

function updateSalidaAmp(idsalida){
    //alert(idsalida);
    var cantidad = $("#input_upd_salida_cant"+idsalida).val();
    var proveedor = $("#input_upd_salida_prov"+idsalida).val();
    var lote = $("#input_upd_salida_lote"+idsalida).val();
    var control = $("#input_upd_salida_control"+idsalida).val();
    var op = $("#input_upd_salida_op"+idsalida).val();
    var obs = $("#input_upd_salida_obs"+idsalida).val();

    $.post("ajax/alm_mat_prima.php?op=updateSalidaAmp",{
        idsalida:idsalida,
        cantidad:cantidad,
        proveedor:proveedor,
        lote:lote,
        control:control,
        op:op,
        obs:obs
    },function(data, status)
    {
        data = JSON.parse(data);
        
        // var notificator = new Notification(document.querySelector('.notification'));
        // notificator.info('Salida actualizada exitosamente.');
        bootbox.alert("Salida actualizada exitosamente.");
        dialog_edit_salida.modal('hide');
        listar_movimientos();
        listar_mov_salida();
                       
    });
}

function cancelupdateSalidaAmp(){
    dialog_edit_salida.modal('hide');
}

function borrar_salida(idsalida){

    if (idusuario==1) {
        bootbox.confirm({
            message: '¿Desea eliminar este registro de salida?',
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

                    $.post("ajax/alm_mat_prima.php?op=borrar_salida",{idsalida:idsalida},function(data, status)
                    {
                        data = JSON.parse(data);

                        listar_movimientos();
                        listar_mov_salida();
                        bootbox.alert("Salida borrada exitosamente.");
                                    
                    });
                    
                }
            }
        });
    }else{
        bootbox.alert("Por el momento no tienes permisos para realizar esta acción, solicta los permisos con el administrador del sistema.");
    }

    



    
}


init();