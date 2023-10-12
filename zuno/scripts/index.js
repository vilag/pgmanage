function init()
{
	//cargar_imagen_encabezado();
}

function save_contact_form()
{
	
	

	var nombre_completo = $("#nombre_completo").val();
	var email = $("#email").val();
	var telefono = $("#telefono").val();
	var mensaje = $("#mensaje").val();
	var plataforma = "formulario_lp";

	var fecha = moment().format('YYYY-MM-DD');
    var hora = moment().format('HH:mm:ss');
    var noticias = document.getElementById("check_p").checked;
    if (noticias==true) {var check_noti=1;}else{var check_noti=0;}
    //alert(check_noti);
    var fecha_hora = fecha+" "+hora;

   /* alert(nombre_completo);
    alert(email);
    alert(telefono);
    alert(mensaje);
    alert(fecha_hora);
    alert(check_noti);*/


    if (email != "" && nombre_completo != ""  && mensaje != "") {

    	//document.getElementById("btn_contacto_save").disabled = true;

    	$.post("ajax/index.php?op=save_contact_form",{
			nombre_completo : nombre_completo,
			email : email,
			telefono : telefono,
			mensaje : mensaje,
			plataforma : plataforma,
			check_noti : check_noti,
			fecha_hora : fecha_hora
			}, function(data, status)
		{
			data = JSON.parse(data);
			
			//bootbox.alert("Registro exitoso, uno de nuestros agentes se comunicará con usted para solucionar todas sus dudas.");
			$(location).attr("href","confirm.php");

	 	})


    }else{
    	bootbox.alert("Para poder ofrecerte un mejor servicio te recomendamos llenar todos los campos");
    }
		

}


init();