function init()
{

  //alert("entra");
//   location.href ="https://pgmanage.host/susp.php";
}


function login()
{
    //alert("entra");

    var logina = $("#logina").val();
    var clavea = $("#clavea").val();

    //alert(logina);
    //alert(clavea);

         $.post("ajax/usuario.php?op=verificar",
            {"logina":logina,"clavea":clavea},
            function(data)
        {
            try {
                data = JSON.parse(data);
            } catch (e) {
                bootbox.alert("No se pudo conectar con el servidor. Intenta de nuevo en unos minutos.");
                return;
            }

            if (data && data.error)
            {
                bootbox.alert("No se pudo conectar con el servidor. Intenta de nuevo en unos minutos.");
                return;
            }

           // alert(data);
           var idusuario = data.idusuario;
           //alert(idusuario);


            if (data!=null)
            {
                $(location).attr("href","welcomeUser.php");

                // if (idusuario>=15 && idusuario<=21) {

                //     $(location).attr("href","op.php");
                // }else{
                //     if (idusuario==22) {
                //         $(location).attr("href","almacen_pt.php");
                //     }else{
                //         $(location).attr("href","list_pedidos.php");
                //     }
                     
                // }
                
               
                                
            }
            else
            {
                if (data==null) {

                    bootbox.alert("Usuario y/o Password incorrectos");
                    
                }
                
            }
        });
}



init();

    /*$("#frmAcceso").on('submit',function(e)
    {
        e.preventDefault();
        var logina=$("#logina").val();
        var clavea=$("#clavea").val();

        alert(logina);

        $.post("ajax/usuario.php?op=verificar",
            {"logina":logina,"clavea":clavea},
            function(data)
        {
            if (data!="null")
            {
                $(location).attr("href","../sale_product.php");            
            }
            else
            {
                bootbox.alert("Usuario y/o Password incorrectos");
            }
        });
    })*/