$(function() {


    const CODIGO_PROYECTO = sessionStorage.getItem('codigoProyecto');
    const NOMBRE_PROYECTO = sessionStorage.getItem('nombreProyecto');

    const IDAREA_EMPRESA = sessionStorage.getItem('idAreaEmpresa');
    const NOMBRE_AREA_EMPRESA = sessionStorage.getItem('nombreAreaEmpresa');


    $("#nombreProyecto").text(NOMBRE_PROYECTO);

    $("#nombreAreaEmpresa").text( NOMBRE_AREA_EMPRESA);

    $("#codigoproyecto").val(CODIGO_PROYECTO);

    $("#idareaempresa").val(IDAREA_EMPRESA);

    // Mostrar todas las capacitaciones

    $.post(RUTA + 'formulario/getListActaReuniones', {}, function(data, textStatus, xhr) {

        var tablaExamenes = "";

        if (data.status == 200) {


            data.contenido.forEach(function(examen) {

                tablaExamenes += `<tr> 
                    <td>` + examen.id + `</td>
                    <td class="w75p">` + examen.motivo + `</td>
                    <td>` + examen.fecha + `</td>
                    </tr>`;

            });

            $("#listaExamen").append(tablaExamenes);

        }

        editarExamen();

        duplicarExamen();

        getButton();

    }, "json");




    function editarExamen() {
        /*$(".buttonEditar").on("click", function(event) {
            event.preventDefault();
            var tr = $(this).closest('tr')

            sessionStorage.setItem("idExamenEditar", $(tr).find('td').eq(0).text());
            window.location.href = RUTA + "editar";

        });*/



        $("#listaExamen tr").on("click", function (event) {
            event.preventDefault();

            sessionStorage.setItem("idExamenEditar", $(this).find('td').eq(0).text());
            window.location.href = RUTA + "editar";

        });

    }

    function duplicarExamen() {
        $(".buttonDuplicar").on("click", function(event) {
            event.preventDefault();
            var tr = $(this).closest('tr')
            var idExamen = $(tr).find('td').eq(0).text()
            $.post(RUTA + 'formulario/duplicarFormulario', {idExamen : idExamen }, function (data, textStatus, xhr) {

                if (data.status == 200) {

                    window.location.replace(RUTA + "administrador");

                
                } else {

                }

            }, "json");

        });
    }

    $("#botonEnviar").on('click', function(event) {
        event.preventDefault();

        $("#formCrearCapacitacion").trigger('submit');

    });


    //enviar formulario
    $("#formCrearCapacitacion").on('submit', function(event) {

        var str = $(this).serialize();

        console.log(str);
        $.post(RUTA + 'formulario/crearActa', str, function(data, textStatus, xhr) {

            if (data.status == 200) {

                console.log(data.contenido);
                //Guardamos los datos devueltos por la consulta
                sessionStorage.setItem("idExamenEditar", data.contenido);
                //window.location.replace(RUTA + "formulario");

                window.location.href = RUTA + "editar";
            } else {

            }

        }, "json");

        return false;
    });




    

    function getButton() {



        $(".buttonPdf").on("click", function(event) {
            event.preventDefault();

            var tr = $(this).closest('tr')


            var idExamen = $(tr).find('td').eq(0).text();

            $.post(RUTA + "evaluaciones/generatePDFByIdExamen", { idExamen : idExamen },
                function(data, textStatus, jqXHR) {


                    console.log(data.contenido);

                    if (data.status == 200) {

                        event.preventDefault();

                        //window.location.href = data.contenido;
                        window.open(data.contenido)

                    } else {

                        console.log(data.contenido);

                    }

                },
                "json"

            )

            return false;

        });



        $(".descargarNotasExcel").on("click", function(event) {
            event.preventDefault();

            var tr = $(this).closest('tr')


            var fecha = $(tr).find('td').eq(1).text();

            $.post(RUTA + "registro/generateExcelByFecha", { fecha: fecha },
                function(data, textStatus, jqXHR) {


                    console.log(data.contenido);

                    if (data.status == 200) {


                        //   window.open(data.contenido, '_blank').focus();

                        event.preventDefault();
                        window.location.href = data.contenido;

                    } else {

                        console.log(data.contenido);

                    }

                },
                "json"

            )

            return false;

        });

    }





})