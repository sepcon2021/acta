$(function() {


    //Iniciamos todas las animaciones
    init();



    //Realizamos la busqueda del trabajador a traves del DNI 
    //Enviamos todos los datos que retorna hacia la siguiente pagina de formulario

    $("#btnBuscarDni").on('click', function(event) {
        event.preventDefault();

        var dniTrabajador = $('#dniTrabajador').val().trim();


        if (dniTrabajador != "") {


            $("#message_trabajador").hide();
            $("#divDni").hide(0);
            $(".loader").show();

            $.post(RUTA + "main/getTrabajadorByDni", { 'dniTrabajador': dniTrabajador },
                function(data, textStatus, jqXHR) {
                    $(".loader").hide();

                    if (data.status == 200) {

                        //Guardamos los datos devueltos por la consulta
                        sessionStorage.setItem("dniTrabajador", data.respuesta.dni);
                        sessionStorage.setItem("nombresApellidosTrabajador", data.respuesta.nombres + " " + data.respuesta.apellidos);
                        sessionStorage.setItem("codigoTrabajador", data.respuesta.ccargo);
                        sessionStorage.setItem("cargoTrabajador", data.respuesta.dcargo);


                        window.location.replace(RUTA + "dashboard");

                    } else {

                        $("#divDni").show();
                        document.getElementById("message_trabajador").innerHTML = "DNI incorrecto";
                        $("#message_trabajador").show("slow");
                        $("#wrap").hide(0);
                        $("#dniTrabajador").val("");
                    }
                },
                "json"
            );
        } else {

            $("#divDni").show();
            document.getElementById("message_trabajador").innerHTML = "Ingresar todos los datos";
            $("#message_trabajador").show("slow");
            $("#wrap").hide(0);
            $("#dniTrabajador").val("");

        }



        return false

    });

    $("#btnCancelar").on('click', function(event) {
        event.preventDefault();
        $("#divDni").show("slow");
        $("#wrap").hide(0);

    });

    //Nos protegemos del doble click que se realiza en el btnBuscarDni
    var divdbl = $("#btnBuscarDni").first();
    divdbl.dblclick(function() {
        $("#wrap").hide(0);
    });




    //Iniciamos el anexo5/main ocultando los elementos del formulario y los mensaje de error/exitoso


    function init() {

        $("#wrap").hide(0);
        $("#message_trabajador").hide(0);
        $(".loader").hide();
        $(".envio_exitoso").hide(0);
        $(".envio_fallo").hide(0);
    }


})