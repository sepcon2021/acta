//
// $('#element').donetyping(callback[, timeout=1000])
// Fires callback when a user has finished typing. This is determined by the time elapsed
// since the last keystroke and timeout parameter or the blur event--whichever comes first.
//   @callback: function to be called when even triggers
//   @timeout:  (default=1000) timeout, in ms, to to wait before triggering event if not
//              caused by blur.
// Requires jQuery 1.7+
//
;
(function ($) {
    $.fn.extend({
        donetyping: function (callback, timeout) {
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function (el) {
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function (i, el) {
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                // thank you @palerdot
                $el.is(':input') && $el.on('keyup keypress paste', function (e) {
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too preemptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type == 'keyup' && e.keyCode != 8) return;

                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function () {
                        // if we made it here, our timeout has elapsed. Fire the
                        // callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur', function () {
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);


$(function () {



    var IDEXAMEN = sessionStorage.getItem('idExamen');
    const NOMBRE_PROYECTO = sessionStorage.getItem('nombreProyecto');


    $("#nombreproyecto").text(NOMBRE_PROYECTO);

    $.post(RUTA + 'formulario/getListaFirmaFacilitador', {}, function (data, textStatus, xhr) {

        var contenidoFirmaFacilitador = ` `;

        if (data.status == 200) {

            data.contenido.forEach(firma => {

                contenidoFirmaFacilitador += `<option value=" ` + firma.id + `">` + firma.nombre + `</option> `;
            });

        } else {
            contenidoFirmaFacilitador = `<option value="10000"> No contamos con firmas disponibles</option> `;
        }

        $('#idFirmaFacilitador').append(contenidoFirmaFacilitador);

    }, "json");



    /*$('#idProyecto').change(function () {

        var idProyecto = $('#idProyecto').val();


        $.post(RUTA + 'formulario/updateExamenProyecto', { idProyecto: idProyecto, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });*/


    $('#faseExamen').donetyping(function () {

        var fase = $('#faseExamen').val();


        $.post(RUTA + 'formulario/updateExamenFase', { fase: fase, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    });


    $('#facilitadorExamen').donetyping(function () {

        var facilitador = $('#facilitadorExamen').val();


        $.post(RUTA + 'formulario/updateExamenFacilitador', { facilitador: facilitador, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    });



    $('#clienteExamen').donetyping(function () {

        var cliente = $('#clienteExamen').val();


        $.post(RUTA + 'formulario/updateExamenCliente', { cliente: cliente, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    });


    $('#fechaExamen').change(function () {

        var fecha = $('#fechaExamen').val();
        $.post(RUTA + 'formulario/updateExamenFecha', { fecha: fecha, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });


    $('#duracionExamen').change(function () {

        var duracion = $('#duracionExamen').val();

        $.post(RUTA + 'formulario/updateExamenDuracion', { duracion: duracion, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });


    $('#temaExamen').donetyping(function () {

        var tema = $('#temaExamen').val();

        $.post(RUTA + 'formulario/updateExamenTema', { tema: tema, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    });




    $('#horaInicioExamen').change(function () {

        var horaInicio = $('#horaInicioExamen').val();

        $.post(RUTA + 'formulario/updateExamenHoraInicio', { horaInicio: horaInicio, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    });



    $('#horaFinExamen').change(function () {

        var horaFin = $('#horaFinExamen').val();

        $.post(RUTA + 'formulario/updateExamenHoraFin', { horaFin: horaFin, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });


    $('#duracionProgramadaExamen').change(function () {

        var duracionProgramada = $('#duracionProgramadaExamen').val();

        $.post(RUTA + 'formulario/updateExamenDuracionProgramada', { duracionProgramada: duracionProgramada, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });



    $('#duracionEfectivaExamen').change(function () {

        var duracionEfectiva = $('#duracionEfectivaExamen').val();

        $.post(RUTA + 'formulario/updateExamenDuracionEfectiva', { duracionEfectiva: duracionEfectiva, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });


    $('#detalleExamen').donetyping(function () {

        var detalle = $('#detalleExamen').val();

        console.log(detalle);

        $.post(RUTA + 'formulario/updateExamenDetalle', { detalle: detalle, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    });


    $('#idCurso').change(function () {

        var idCurso = $('#idCurso').val();


        $.post(RUTA + 'formulario/updateExamenIdCurso', { idCurso: idCurso, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });

    $('#idAreaCapacitacion').change(function () {

        var idAreaCapacitacion = $('#idAreaCapacitacion').val();


        $.post(RUTA + 'formulario/updateExamenIdAreaCapacitacion', { idAreaCapacitacion: idAreaCapacitacion, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });



    $('#notaExamen').change(function () {

        var nota = $('#notaExamen').val();

        $.post(RUTA + 'formulario/updateExamenNota', { nota: nota, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });


    $('#temarioA').donetyping(function () {

        var temarioA = $('#temarioA').val();

        $.post(RUTA + 'formulario/updateExamenTemarioA', { temarioA: temarioA, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    });

    $('#temarioB').donetyping(function () {

        var temarioB = $('#temarioB').val();

        $.post(RUTA + 'formulario/updateExamenTemarioB', { temarioB: temarioB, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    });

    $('#temarioB').donetyping(function () {

        var temarioB = $('#temarioB').val();

        $.post(RUTA + 'formulario/updateExamenTemarioB', { temarioB: temarioB, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    });


    $('#observacion').donetyping(function () {

        var observacion = $('#observacion').val();

        $.post(RUTA + 'formulario/updateExamenObservacion', { observacion: observacion, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    });


    $('#finalizo').change(function () {

        var finalizo = $('#finalizo').val();


        $.post(RUTA + 'formulario/updateExamenFinalizo', { finalizo: finalizo, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });

    $('#continuara').change(function () {

        var continuara = $('#continuara').val();


        $.post(RUTA + 'formulario/updateExamenContinuara', { continuara: continuara, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });




    $('#fechaContinuacion').change(function () {

        var fechaContinuacion = $('#fechaContinuacion').val();
        $.post(RUTA + 'formulario/updateExamenFechaContinuacion', { fechaContinuacion: fechaContinuacion, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });



    $('#idFirmaFacilitador').change(function () {

        var idFirmaFacilitador = $('#idFirmaFacilitador').val();

        $.post(RUTA + 'formulario/updateExamenFirmaFacilitador', { idFirmaFacilitador: idFirmaFacilitador, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json")

    });

    $('#enviarCorreo').change(function () {

        var enviarCorreo = $('#enviarCorreo').val();


        $.post(RUTA + 'formulario/updateEnviarCorreo', { enviarCorreo: enviarCorreo, id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });

    $('#cantidadPregunta').change(function () {

        var cantidadPregunta = $('#cantidadPregunta').val();

        $.post(RUTA + 'formulario/updateExamenCantidadPregunta', { cantidadPregunta : cantidadPregunta , id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });

    $('#aleatorio').change(function () {

        var aleatorio = $('#aleatorio').val();


        $.post(RUTA + 'formulario/updateExamenAleatorio', { aleatorio : aleatorio , id: IDEXAMEN }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");

    });

    $("#buttonAgregarPregunta").on('click', function (event) {
        event.preventDefault();

        var ary = [];

        ary.push({
            nombre: 'Titulo prueba 1',
            respuesta: 1,
            puntaje: 20,
            idExamen: IDEXAMEN
        });

        INFO = new FormData();
        aInfo = JSON.stringify(ary);

        $.post(RUTA + 'formulario/insertPregunta', { data: aInfo }, function (data, textStatus, xhr) {

            if (data.status == 200) {


                var contenido = `<div class="contenido"> <div class="bordes"> <div class="pregunta" idpregunta="` + data.contenido + `" id="` + data.contenido + `"> 

                <label for="titulo">Nombre</label> <br>
                <input type="text" class="titulos w80p" idpregunta="`+ data.contenido + `" name="titulo" id="titulo` + data.contenido + `"> 
                <br> 
                <label for="puntaje">Puntaje</label> <br>
                <input type="number" class="puntaje w10p" idpregunta="`+ data.contenido + `" name="puntaje" id="puntaje` + data.contenido + `"> 
                <br>  
                <div> 
                <br><br> 
                <div id="listaAlternativa`+ data.contenido + `"> 
                </div> 
                <div> 
                 <button id="buttonAgregarAlternativa`+ data.contenido + `">alternativa</button> 
                </div></div>
                <br>
                <div > 
                <button class="eliminar" idpregunta="`+ data.contenido + `" id="buttonEliminar` + data.contenido + `">Eliminar</button> 
                </div>
                </div></div></div>`;

                document.getElementById("listaPreguntas").insertAdjacentHTML('beforeend', contenido);


            }
            escucharCambiosPregunta();

            eliminarPregunta();

            agregarHtmlAlternativa(data.contenido);


        }, "json");



        return false;



    });



    function eliminarPregunta() {
        $("#listaPreguntas div.pregunta button.eliminar").on('click', function (event) {
            event.preventDefault();


            var idPregunta = $(this).attr('idpregunta');

            $.post(RUTA + 'formulario/eliminarPregunta', { idPregunta: idPregunta }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                    document.getElementById(idPregunta).innerHTML = "";
                }

            }, "json");

            return false;


        });
    }


    function escucharCambiosPregunta() {
        $("#listaPreguntas div.pregunta input.titulos").on('click', function (event) {
            event.preventDefault();


            enviarUpdateTitulo($(this).attr('idpregunta'));

            return false;


        });


        $("#listaPreguntas div.pregunta input.puntaje").on('click', function (event) {
            event.preventDefault();

            enviarUpdatePuntaje($(this).attr('idpregunta'));

            return false;


        });




    }


    function enviarUpdateTitulo(idPregunta) {

        $('#titulo' + idPregunta).donetyping(function () {

            var nombre = $('#titulo' + idPregunta).val();

            $.post(RUTA + 'formulario/updatePreguntaNombre', { nombre: nombre, idPregunta: idPregunta }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

    }


    function enviarUpdatePuntaje(idPregunta) {

        $('#puntaje' + idPregunta).donetyping(function () {

            var puntaje = $('#puntaje' + idPregunta).val();

            $.post(RUTA + 'formulario/updatePreguntaPuntaje', { puntaje: puntaje, idPregunta: idPregunta }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

    }


    // Sección alternativa


    function agregarHtmlAlternativa(idPregunta) {

        $("#buttonAgregarAlternativa" + idPregunta).on('click', function (event) {
            event.preventDefault();


            $.post(RUTA + 'formulario/insertAlternativa', { idPregunta: idPregunta, index: 1 }, function (data, textStatus, xhr) {

                if (data.status == 200) {

                    var contenido = ' <div id="boxAlternativa' + data.contenido + '"> ' +

                        '<input class="radioRespuesta" type="radio" name="radio' + idPregunta + '" id="radio' + data.contenido + '"  idalternativa="' + data.contenido + '" value="' + data.contenido + '"  > ' +

                        '<input name="alternativa" idpregunta="' + idPregunta + '" class="alternativa w80p" type="text" idalternativa="' + data.contenido + '"  id="alternativa' + data.contenido + '" > ' +
                        '<button class="buttonEliminarAlternativa" idalternativa="' + data.contenido + '" id="buttonEliminar' + data.contenido + '"> X </button> </div>';

                    document.getElementById("listaAlternativa" + idPregunta).insertAdjacentHTML('beforeend', contenido);
                }


                escucharCambiosAlternativa(idPregunta)

            }, "json");


            return false;
        });
    }




    function escucharCambiosAlternativa(idPregunta) {

        var etiqueta = "#listaAlternativa" + idPregunta + " input.alternativa";


        $(etiqueta).on('click', function (event) {
            event.preventDefault();

            enviarUpdateAlternativa($(this).attr('idalternativa'));

            return false;


        });


        var etiquetaButton = "#listaAlternativa" + idPregunta + " button.buttonEliminarAlternativa";

        $(etiquetaButton).on('click', function (event) {
            event.preventDefault();

            eliminarAlternativa($(this).attr('idalternativa'));

            return false;


        });


        var etiquetaRadio = 'input[type=radio][name=radio' + idPregunta + ']';

        $(etiquetaRadio).change(function () {
            console.log(idPregunta);

            var idAlternativa = this.value;

            updateRepuestaCorrecta(idAlternativa, idPregunta)

        });


    }

    function enviarUpdateAlternativa(idAlternativa) {

        $('#alternativa' + idAlternativa).donetyping(function () {


            var nombre = $('#alternativa' + idAlternativa).val();

            $.post(RUTA + 'formulario/updateAlternativaNombre', { idAlternativa: idAlternativa, nombre: nombre }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");

        });
    }



    function eliminarAlternativa(idAlternativa) {

        $.post(RUTA + 'formulario/eliminarAlternativa', { idAlternativa: idAlternativa }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
                document.getElementById("boxAlternativa" + idAlternativa).innerHTML = "";
            }

        }, "json");


    }


    function updateRepuestaCorrecta(idAlternativa, idPregunta) {

        /*$.post(RUTA + 'formulario/updatePreguntaRespuesta', { respuesta: idAlternativa, idPregunta: idPregunta }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");*/

        

        $.post(RUTA + 'formulario/updateAlternativaRespuesta', { idAlternativa: idAlternativa }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    }



    $("#buttonVistaPrevia").on("click", function (event) {
        event.preventDefault();
        sessionStorage.setItem("idExamen", IDEXAMEN);
        window.open(RUTA + "vistaprevia")

    });

    $("#buttonInicio").on("click", function (event) {
        event.preventDefault();
        sessionStorage.setItem("idExamen", IDEXAMEN);
        window.location.href = RUTA + "administrador";

    });



    //Abrimos el pop up
    $('#addRowObs').on('click', function (event) {
        event.preventDefault();
        $("#popup-1").addClass("active");
        $(".loader").hide();

        return false;

    })



    //Cerramos el popup
    $(".clickPopup-close").click(function (event) {
        event.preventDefault();

        $("#popup-1").removeClass("active");
        $("#examen").trigger("reset");

    });

    //Cerramos el popup
    $(".overlay").click(function (event) {
        event.preventDefault();

        $("#popup-1").removeClass("active");
        $("#examen").trigger("reset");

    });

    //Guardamos la firma en el servidor
    $("#btnRegisterFirma").click(function (event) {

        event.preventDefault();

        $("#examen").hide();
        $("#boxLoad").append('<div class="loader"></div>')

        var firmaTrabajador = document.getElementById("firma");

        $.post('public/inc/upload-sing.inc.php', { img: firmaTrabajador.toDataURL() }, function (data) {

            $('#urlImagen').val(data);

            $("#examen").trigger('submit');


        });

    });

    //enviar formulario
    $("#examen").on('submit', function (event) {
        event.preventDefault();

        var formulario = $(this).serialize();

        $.post(RUTA + 'formulario/insertFirmaFacilitador', formulario, function (data) {

            var htmlOpcion = 0;
            $("#boxLoad").hide();


            if (data.status == 200) {


                $("#respuesta").append('<div> <h2>La firma fue subido con éxito</h2> <br>  <button class="buttonFirmar button-upload"> Volver a firmar </button>  <button class="buttonDeletePopup clickPopup-close" type="submit" id="btnUpdateDocumento">Cerrar</button>  </div>');

                htmlOpcion = `<option value=" ` + data.contenido.id + `">` + data.contenido.nombreFacilitador + `</option> `;

            } else {

                $("#respuesta").append('<div> <h2>Volver a intentarlo</h2> <br> <button class="buttonFirmar button-upload"> Volver a firmar </button>  <button class="buttonDeletePopup clickPopup-close" type="submit" id="btnUpdateDocumento">Cerrar</button> </div>');

            }

            $('#idFirmaFacilitador').append(htmlOpcion);
            buttonFirmar();

        });


        return false;
    });


    function buttonFirmar() {
        //Guardamos la firma en el servidor
        $(".buttonFirmar").click(function (event) {

            event.preventDefault();
            $("#examen").trigger("reset");

            document.getElementById("respuesta").innerHTML = "";
            document.getElementById("boxLoad").innerHTML = "";

            $("#examen").show();
            $("#boxLoad").hide();
            $("#boxRespuesta").hide();

        });

        //Cerramos el popup
        $(".clickPopup-close").click(function (event) {
            event.preventDefault();

            $("#popup-1").removeClass("active");
            $("#examen").trigger("reset");

            document.getElementById("respuesta").innerHTML = "";
            document.getElementById("boxLoad").innerHTML = "";

            $("#examen").show();
            $("#boxLoad").hide();
            $("#boxRespuesta").hide();

        });
    }


});