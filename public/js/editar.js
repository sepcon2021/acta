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


    var lista_puestos = [];


    var IDEXAMENEDITAR = sessionStorage.getItem('idExamenEditar');
    const IDAREA_EMPRESA = sessionStorage.getItem('idAreaEmpresa');

    //idAreaEmpresa
    const NOMBRE_PROYECTO = sessionStorage.getItem('nombreProyecto');
    const CODIGO_PROYECTO = sessionStorage.getItem("codigoProyecto");




    function listenContenidoCabecera() {

        $('#motivoActa').donetyping(function () {

            var motivo = $('#motivoActa').val();


            $.post(RUTA + 'formulario/updateActaMotivo', { motivo : motivo, id: IDEXAMENEDITAR }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

        $('#numeroReunionActa').donetyping(function () {

            var numeroReunion = $('#numeroReunionActa').val();


            $.post(RUTA + 'formulario/updateActaNumeroReunion', { numero_reunion : numeroReunion, id: IDEXAMENEDITAR }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });


        $('#tiempoProgramadoActa').donetyping(function () {

            var tiempoProgramado = $('#tiempoProgramadoActa').val();


            $.post(RUTA + 'formulario/updateActaTiempoProgramado', { tiempo_programado : tiempoProgramado, id: IDEXAMENEDITAR }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

        $('#nombreProyectoActa').donetyping(function () {

            var nombreProyecto = $('#nombreProyectoActa').val();


            $.post(RUTA + 'formulario/updateActaNombreProyecto', { nombre_proyecto : nombreProyecto, id: IDEXAMENEDITAR }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

        $('#lugarActa').donetyping(function () {

            var lugar = $('#lugarActa').val();


            $.post(RUTA + 'formulario/updateActalugar', { lugar : lugar, id: IDEXAMENEDITAR }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

        $('#tiempoRealDuracionActa').donetyping(function () {

            var tiempoRealDuracion = $('#tiempoRealDuracionActa').val();


            $.post(RUTA + 'formulario/updateActaTiempoRealDuracion', { tiempo_real_duracion : tiempoRealDuracion, id: IDEXAMENEDITAR }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

        $('#clienteActa').donetyping(function () {

            var cliente = $('#clienteActa').val();


            $.post(RUTA + 'formulario/updateActaCliente', { cliente : cliente, id: IDEXAMENEDITAR }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });


        $('#fechaActa').change(function () {

            var fecha = $('#fechaActa').val();


            $.post(RUTA + 'formulario/updateActaFecha', { fecha : fecha, id: IDEXAMENEDITAR }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

        $('#observacionesActa').donetyping(function () {

            var observaciones = $('#observacionesActa').val();


            $.post(RUTA + 'formulario/updateActaObservaciones', { observaciones : observaciones, id: IDEXAMENEDITAR }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

    }


    // Sección para traer contenido del examen


    var contenidoHtml = "<h3>Temas general</h3>";
    var htmlTemaPropuesto = "<h3>Temas Propuesto</h3>";

    $.post(RUTA + 'formulario/listaPreguntaByIdActa', { idActa: IDEXAMENEDITAR }, function (data, textStatus, xhr) {

        if (data.status == 200) {


            $(".header").append(contenidoCabecera(data.contenido));
            listenContenidoCabecera();


            contenidoHtml += crearHtmlPregunta(data.contenido);
            $("#listaPreguntas").append(contenidoHtml);

            escucharCambiosPregunta();
            eliminarPregunta();


            htmlTemaPropuesto += crearHtmlTemaPropuesto(data.contenido);
            $("#listaTemaPropuesto").append(htmlTemaPropuesto);
            escucharCambiosTemaPropuesto();
            eliminarTemaPropuesto();

            




        
        }


    }, "json");



    function iterarListaPreguntasEventos(examen) {


        examen.listaPreguntas.forEach(pregunta => {

            escucharCambiosAlternativa(pregunta.id);

            agregarHtmlAlternativa(pregunta.id);

        });
    }


    function crearHtmlPregunta(data) {

        var htmlPregunta = "";

        console.log(data.listaTemaGeneral);

        data.listaTemaGeneral.forEach(pregunta => {

            htmlPregunta += contenidoPregunta(pregunta);



        });



        return htmlPregunta;
    }


    
    function crearHtmlTemaPropuesto(data) {

        var htmlPregunta = "";

        console.log(data.listaTemaPropuesto);

        data.listaTemaPropuesto.forEach(pregunta => {

            htmlPregunta += contenidoTemaPropuesto(pregunta);



        });



        return htmlPregunta;
    }


    function contenidoCabecera(acta) {

        return `

        <div class="campo">
        <label >Motivo</label>
        <input type="text" name="motivoActa" id="motivoActa" value="${acta.motivo}">
        </div>

        <div class="campo">
        <label >Número de reunión</label>
        <input type="text" name="numeroReunionActa" id="numeroReunionActa" value="${acta.numeroReunion}">
        </div>

        <div class="campo">
        <label >Tiempo programado</label>
        <input type="text" name="tiempoProgramadoActa" id="tiempoProgramadoActa" value="${acta.tiempoProgramado}">
        </div>

        <div class="campo">
        <label >Nombre proyecto</label>
        <input type="text" name="nombreProyectoActa" id="nombreProyectoActa" value="${acta.nombreProyecto}">
        </div>

        <div class="campo">
        <label >Lugar</label>
        <input type="text" name="lugarActa" id="lugarActa" value="${acta.lugar}">
        </div>

    
        <div class="campo">
        <label >Cliente</label>
        <input type="text" name="clienteActa" id="clienteActa" value="${acta.cliente}">
        </div>

        
        <div class="campo">
        <label >Fecha</label>
        <input type="date" name="fechaActa" id="fechaActa" value="${acta.fecha}">
        </div>

        
        <div class="campo">
        <label >Observaciones</label>
        <input type="text" name="observacionesActa" id="observacionesActa" value="${acta.observaciones}">
        </div>

    </div>
        `;


    }

    function htmlListaPuestoTrabajo(contenido){

        contenido.examenPuestoTrabajo.forEach((puestoTrabajo) => {
            var htmlLista = `
            <div class="puestoTrabajoGeneral" id="${IDEXAMENEDITAR}${puestoTrabajo.id_puesto_trabajo}">
                <div class="puestoTrabajo">
                    <p> ${puestoTrabajo.id_puesto_trabajo} - ${puestoTrabajo.nombre}</p>
                    <img class="iconoEliminarPuestoTrabajo" src="public/img/cancel.png">
                </div>
            </div>
            `;
            document.getElementById("listaPuestoTrabajo").insertAdjacentHTML('afterend',htmlLista); 
            deletePuestoTrabajo(puestoTrabajo.id_puesto_trabajo);
        });
    }

    function deletePuestoTrabajo(idPuestoTrabajo){

        
        $(`#${IDEXAMENEDITAR}${idPuestoTrabajo}`).on('click', function (event) {

            $.post(RUTA + 'formulario/deleteExamenPuesto', { id_examen : IDEXAMENEDITAR , id_puesto_trabajo :idPuestoTrabajo}, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    document.getElementById(`${IDEXAMENEDITAR}${idPuestoTrabajo}`).innerHTML = '';
                }
    
            }, "json");
        });


    }


    function cantidadPreguntaSelect(cantidadPregunta){

        var valueHtml = ``;

        var listaCantidadPregunta = [ 
            {"key":1 , "value" : "1"},
            {"key":2 , "value" : "2"},
            {"key":3 , "value" : "3"},
            {"key":4 , "value" : "4"},
            {"key":5 , "value" : "5"},
            {"key":6 , "value" : "6"},
            {"key":7 , "value" : "7"},
            {"key":8 , "value" : "8"},
            {"key":9 , "value" : "9"},
            {"key":10 , "value" : "10"},
            {"key":11 , "value" : "11"},
            {"key":12, "value" : "12"},
            {"key":13 , "value" : "13"},
            {"key":14 , "value" : "14"},
            {"key":15, "value" : "15"},
            {"key":1000, "value" : "Todas las preguntas"}];

        listaCantidadPregunta.forEach((cantidad) => {
            
            if(cantidad.key == cantidadPregunta ){
                
                valueHtml += `<option value="${cantidad.key}" selected >${cantidad.value}</option>`;

            }else{

                valueHtml += `<option value="${cantidad.key}">${cantidad.value}</option>`;

            }
        });

        return valueHtml;
    }

    function contenidoPregunta(temaGeneral) {


        return`<div class="contenido">
        <div class="bordes">
            <div class="pregunta" idpregunta="${temaGeneral.id}" id="${temaGeneral.id}">
                <div class="contenidoFinish"> <button class="eliminar" idpregunta="${temaGeneral.id}" id="buttonEliminar${temaGeneral.id}"> <img class="iconoEliminar" src="public/img/cancel.png" > </button> </div>

                <label>Temas en agenda</label>
                <input 
                    type="text" 
                    class="temaAgenda" 
                    idpregunta="${temaGeneral.id}" 
                    name="temaAgenda"
                    id="temaAgenda${temaGeneral.id}"
                    value ="${temaGeneral.temaAgenda}"
                >
                <br>

                <label>Duración</label>
                <input 
                type="text" 
                class="duracion" 
                idpregunta="${temaGeneral.id}" 
                name="duracion"
                id="duracion${temaGeneral.id}"
                value ="${temaGeneral.duracion}"
                >
                <br>


                <label>Responsable</label>
                <input 
                type="text" 
                class="responsable" 
                idpregunta="${temaGeneral.id}" 
                name="responsable"
                id="responsable${temaGeneral.id}"
                value ="${temaGeneral.responsable}"
                >
                <br>

                
                <label>Tratados</label>
                <input 
                type="text" 
                class="tratado" 
                idpregunta="${temaGeneral.id}" 
                name="tratado"
                id="tratado${temaGeneral.id}"
                value ="${temaGeneral.tratado}"
                >
                <br>

                                        
                <label>No Tratados</label>
                <input 
                type="text" 
                class="noTratado" 
                idpregunta="${temaGeneral.id}" 
                name="noTratado"
                id="noTratado${temaGeneral.id}"
                value ="${temaGeneral.noTratado}"
                >
                <br>

                                                                
                <label>Comentarios</label>
                <input 
                type="text" 
                class="comentario" 
                idpregunta="${temaGeneral.id}" 
                name="comentario"
                id="comentario${temaGeneral.id}"
                value ="${temaGeneral.comentario}"
                >
                <br>

            </div>
        </div>
    </div>`;
    }



    function contenidoTemaPropuesto(temaPropuesto) {


        return`<div class="contenido">
        <div class="bordes">
            <div class="pregunta" idpregunta="${temaPropuesto.id}" id="${temaPropuesto.id}">
                <div class="contenidoFinish"> <button class="eliminar" idpregunta="${temaPropuesto.id}" id="buttonEliminar${temaPropuesto.id}"> <img class="iconoEliminar" src="public/img/cancel.png" > </button> </div>

                <label>Acuerdo</label>
                <input 
                    type="text" 
                    class="temaAcuerdo" 
                    idpregunta="${temaPropuesto.id}" 
                    name="temaAcuerdo"
                    id="temaAcuerdo${temaPropuesto.id}"
                    value="${temaPropuesto.acuerdo}" 
                >
                <br>

                <label>Responsable</label>
                <input 
                    type="text" 
                    class="temaResponsable" 
                    idpregunta="${temaPropuesto.id}" 
                    name="temaResponsable"
                    id="temaResponsable${temaPropuesto.id}"
                    value="${temaPropuesto.responsable}" 
                >
                <br>

                
                <label>Fecha de compromiso</label>
                <input 
                    type="date" 
                    class="temaFechaCompromiso" 
                    idpregunta="${temaPropuesto.id}" 
                    name="temaFechaCompromiso"
                    id="temaFechaCompromiso${temaPropuesto.id}"
                    value="${temaPropuesto.fechaCompromiso}" 
                >
                <br>

                                        
                <label>Fecha de cumplimiento</label>
                <input 
                    type="date" 
                    class="temaFechaCumplimiento" 
                    idpregunta="${temaPropuesto.id}" 
                    name="temaFechaCumplimiento"
                    id="temaFechaCumplimiento${temaPropuesto.id}"
                    value="${temaPropuesto.fechaCumplimiento}" 
                >
                <br>

                <label>Comentario</label>
                <input 
                    type="text" 
                    class="temaComentario" 
                    idpregunta="${temaPropuesto.id}" 
                    name="temaComentario"
                    id="temaComentario${temaPropuesto.id}"
                    value="${temaPropuesto.comentario}" 
                >
                <br>

            </div>
        </div>
    </div>`;
    }

    
    function tipoAlternativaHtml(pregunta) {

        var ALTERNATIVA = 1;
        var RESPUESTA = 2;

        var htmlAlternativa = ``;

        if(pregunta.idtipopregunta == ALTERNATIVA){

            htmlAlternativa = `

            <div> 
             <button class="agregarAlternativa" id="buttonAgregarAlternativa${pregunta.id}"> Alternativa</button> 
            </div>
            <br><br> 
            <div id="listaAlternativa${pregunta.id}"> 
            ${crearHtmlAlternativa(pregunta)}
            </div> 
 
            <br><br> 

            <label for="puntaje">puntaje</label> 
            <input type="number" class="puntaje" idpregunta="${pregunta.id}" name="puntaje" id="puntaje${pregunta.id}" value="${pregunta.puntaje}"> 
            <br>   
            <div> 


            </div> `;

        }
        if(pregunta.idtipopregunta ==  RESPUESTA){
            htmlAlternativa =  `
            <div> <textarea class="comentario" placeholder="Comentarios" readonly></textarea> </div>`;
        }
        return htmlAlternativa;
    }

    function crearHtmlAlternativa(pregunta) {
        var htmlAlternativa = "";


        pregunta.alternativa.forEach(alternativa => {


            htmlAlternativa += contenidoAlternativa(alternativa, pregunta);

        });


        return htmlAlternativa;
    }

    function contenidoAlternativa(alternativa, pregunta) {

        return ' <div class="boxAlternativa" id="boxAlternativa' + alternativa.id + '"> ' +

            '<input class="radioRespuesta" type="radio" name="radio' + pregunta.id + '" id="radio' + alternativa.id + '"  idalternativa="' + alternativa.id + '" value="' + alternativa.id + '"  ' + contenidoCheckAvalaible(alternativa.respuesta) + ' > ' +

            '<input placeholder="contenido alternativa" name="alternativa" idpregunta="' + pregunta.id + '" class="alternativa" type="text" idalternativa="' + alternativa.id + '"  id="alternativa' + alternativa.id + '"  value="' + alternativa.nombre + '"  > ' +
            '<button  class="buttonEliminarAlternativa" idalternativa="' + alternativa.id + '" id="buttonEliminar' + alternativa.id + '"> <img class="iconoEliminarAlternativa" src="public/img/cancel.png" > </button> </div>';

    }

    function contenidoCheckAvalaible(respuesta) {

        var contenido = '';

        if (respuesta == 1) {
            contenido = 'checked';
        }

        return contenido;
    }






    // Sección de preguntas 



    $("#buttonAgregarPregunta").on('click', function (event) {
        event.preventDefault();

        $.post(RUTA + 'formulario/insertTemaGeneral', { idActa : IDEXAMENEDITAR}, function (data, textStatus, xhr) {

            if (data.status == 200) {

                var contenido =
                `<div class="contenido">
                <div class="bordes">
                    <div class="pregunta" idpregunta="${data.contenido}" id="${data.contenido}">
                        <div class="contenidoFinish"> <button class="eliminar" idpregunta="${data.contenido}" id="buttonEliminar${data.contenido}"> <img class="iconoEliminar" src="public/img/cancel.png" > </button> </div>

                        <label>Temas en agenda</label>
                        <input 
                            type="text" 
                            class="temaAgenda" 
                            idpregunta="${data.contenido}" 
                            name="temaAgenda"
                            id="temaAgenda${data.contenido}"
                        >
                        <br>

                        <label>Duración</label>
                        <input 
                        type="text" 
                        class="duracion" 
                        idpregunta="${data.contenido}" 
                        name="duracion"
                        id="duracion${data.contenido}"
                        >
                        <br>


                        <label>Responsable</label>
                        <input 
                        type="text" 
                        class="responsable" 
                        idpregunta="${data.contenido}" 
                        name="responsable"
                        id="responsable${data.contenido}"
                        >
                        <br>

                        
                        <label>Tratados</label>
                        <input 
                        type="text" 
                        class="tratado" 
                        idpregunta="${data.contenido}" 
                        name="tratado"
                        id="tratado${data.contenido}"
                        >
                        <br>

                                                
                        <label>No Tratados</label>
                        <input 
                        type="text" 
                        class="noTratado" 
                        idpregunta="${data.contenido}" 
                        name="noTratado"
                        id="noTratado${data.contenido}"
                        >
                        <br>

                                                                        
                        <label>Comentarios</label>
                        <input 
                        type="text" 
                        class="comentario" 
                        idpregunta="${data.contenido}" 
                        name="comentario"
                        id="comentario${data.contenido}"
                        >
                        <br>

                    </div>
                </div>
            </div>`;


            document.getElementById("listaPreguntas").insertAdjacentHTML('beforeend', contenido);


            }
            escucharCambiosTemaPropuesto();

            //eliminarPregunta();


        }, "json");



        return false;



    });

    function cambiarTipoPregunta(dataPregunta) {

        var ALTERNATIVA = 1;
        var RESPUESTA = 2;
        var MULTI_ALTERNATIVA_GRID = 3;

        $('#tipopregunta'+dataPregunta.contenido).on('change', function (event) {
            event.preventDefault();
            var htmlBody = ``;
            var codigoPregunta = $(this).val();
            console.log(codigoPregunta);

            if(codigoPregunta == ALTERNATIVA){


                $.post(RUTA + 'formulario/updatePreguntaTipo', { idtipopregunta: ALTERNATIVA, idPregunta: dataPregunta.contenido }, function (data, textStatus, xhr) {

                    if (data.status == 200) {
                        htmlBody = htmlAlternativaBody(dataPregunta);
                        document.getElementById("tipoContenidoHtml" + dataPregunta.contenido).innerHTML = htmlBody;
                        agregarHtmlAlternativa(dataPregunta.contenido);
                        eliminarPregunta();

                    }

                }, "json");


            }
            if(codigoPregunta ==  RESPUESTA){

                $.post(RUTA + 'formulario/updatePreguntaTipo', { idtipopregunta: RESPUESTA, idPregunta: dataPregunta.contenido }, function (data, textStatus, xhr) {

                    if (data.status == 200) {
                        htmlBody =  htmlTextoBody(dataPregunta);
                        document.getElementById("tipoContenidoHtml"+dataPregunta.contenido).innerHTML = htmlBody;
                        eliminarPregunta();
        
                    }

                }, "json");


            }

            if(codigoPregunta == MULTI_ALTERNATIVA_GRID){


                $.post(RUTA + 'formulario/updatePreguntaTipo', { idtipopregunta:  MULTI_ALTERNATIVA_GRID, idPregunta: dataPregunta.contenido }, function (data, textStatus, xhr) {

                    if (data.status == 200) {
                        htmlBody = htmlMultiAlternativaBody(dataPregunta);
                        document.getElementById("tipoContenidoHtml" + dataPregunta.contenido).innerHTML = htmlBody;
                        agregarHtmlMultiAlternativaGrid(dataPregunta.contenido);
                    }

                }, "json");


            }


        });
    }

    function htmlAlternativaBody(data){

        return `
        <br> 
        <br> 
        <div> 
        <div> 
         <button class="agregarAlternativa" id="buttonAgregarAlternativa${data.contenido}">alternativa</button> 
        </div> 
        <br><br> 

        <div id="listaAlternativa${data.contenido}"> 
        </div> 
        <br> 
        <br> 
        <label for="puntaje">puntaje</label> 
        <input type="number" class="puntaje" idpregunta="${data.contenido}" name="puntaje" id="puntaje${data.contenido}"> 
        <br> 

        </div> `;
    }
    function htmlTextoBody(data){
        return `
        <textarea class="comentario" placeholder="Comentarios" readonly></textarea> `;
    }

    function htmlMultiAlternativaBody(data){

        

        return `
        <br> 
        <br> 
        <div> 
        <div> 
         <button class="agregarAlternativa" id="buttonAgregarMultiAlternativaFila${data.contenido}">Fila</button> 
         <input id="filaMulti${data.contenido}" type="hidden" value="">
        </div> 
        <br><br> 

        <div id="listaMultiAlternativaFila${data.contenido}"> 

        </div> 
        <br> 
        <br>
        <div> 
        <button class="agregarAlternativa" id="buttonAgregarMultiAlternativaColumna${data.contenido}">Columna</button> 
        <input id="columnaMulti${data.contenido}" type="hidden" value="">

       </div> 
        
       <br><br> 

       <div id="listaMultiAlternativaColumna${data.contenido}"> 
       </div>

        <br> 
        <br>

        </div> `;
    }


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
        
        $("#listaPreguntas div.pregunta input.temaAgenda").on('click', function (event) {
            event.preventDefault();
            enviarUpdateTemaAgenda($(this).attr('idpregunta'));
            return false;
        });


        $("#listaPreguntas div.pregunta input.duracion").on('click', function (event) {
            event.preventDefault();
            enviarUpdateDuracion($(this).attr('idpregunta'));
            return false;
        });


        $("#listaPreguntas div.pregunta input.responsable").on('click', function (event) {
            event.preventDefault();
            enviarUpdateResponsable($(this).attr('idpregunta'));
            return false;
        });


        $("#listaPreguntas div.pregunta input.tratado").on('click', function (event) {
            event.preventDefault();
            enviarUpdateTratado($(this).attr('idpregunta'));
            return false;
        });

        $("#listaPreguntas div.pregunta input.noTratado").on('click', function (event) {
            event.preventDefault();
            enviarUpdateNoTratado($(this).attr('idpregunta'));
            return false;
        });

        $("#listaPreguntas div.pregunta input.comentario").on('click', function (event) {
            event.preventDefault();
            enviarUpdateComentario($(this).attr('idpregunta'));
            return false;
        });

    }


    function enviarUpdateTemaAgenda(idPregunta) {

        $('#temaAgenda' + idPregunta).donetyping(function () {

            var temaAgenda = $('#temaAgenda' + idPregunta).val();

            $.post(RUTA + 'formulario/updateTemaGeneralTemaAgenda', { temaAgenda : temaAgenda,  idTemaAgenda: idPregunta }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

    }



    function enviarUpdateDuracion(idPregunta) {

        $('#duracion' + idPregunta).donetyping(function () {

            var duracion = $('#duracion' + idPregunta).val();

            $.post(RUTA + 'formulario/updateTemaGeneralDuracion', { duracion :duracion, idTemaAgenda: idPregunta }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

    }

    
    function enviarUpdateResponsable(idPregunta) {

        $('#responsable' + idPregunta).donetyping(function () {

            var responsable = $('#responsable' + idPregunta).val();

            $.post(RUTA + 'formulario/updateTemaGeneralResponsable', { responsable :responsable, idTemaAgenda: idPregunta  }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

    }

    function enviarUpdateTratado(idPregunta) {

        $('#tratado' + idPregunta).donetyping(function () {

            var tratado = $('#tratado' + idPregunta).val();

            $.post(RUTA + 'formulario/updateTemaGeneralTratado', 
            { tratado :tratado, idTemaAgenda: idPregunta }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

    }

    function enviarUpdateNoTratado(idPregunta) {

        $('#noTratado' + idPregunta).donetyping(function () {

            var noTratado = $('#noTratado' + idPregunta).val();

            $.post(RUTA + 'formulario/updateTemaGeneralNoTratado', 
            { noTratado :noTratado, idTemaAgenda: idPregunta  }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

    }

    function enviarUpdateComentario(idPregunta) {

        $('#comentario' + idPregunta).donetyping(function () {

            var comentario = $('#comentario' + idPregunta).val();

            $.post(RUTA + 'formulario/updateTemaGeneralComentario', 
            { comentario :comentario, idTemaAgenda: idPregunta  }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

    }


    $("#buttonAgregarPropuesta").on('click', function (event) {
        event.preventDefault();

        $.post(RUTA + 'formulario/insertTemaPropuesto', { idActa : IDEXAMENEDITAR}, function (data, textStatus, xhr) {

            if (data.status == 200) {

                var contenido =
                `<div class="contenido">
                <div class="bordes">
                    <div class="pregunta" idpregunta="${data.contenido}" id="${data.contenido}">
                        <div class="contenidoFinish"> <button class="eliminar" idpregunta="${data.contenido}" id="buttonEliminar${data.contenido}"> <img class="iconoEliminar" src="public/img/cancel.png" > </button> </div>

                        <label>Acuerdo</label>
                        <input 
                            type="text" 
                            class="temaAcuerdo" 
                            idpregunta="${data.contenido}" 
                            name="temaAcuerdo"
                            id="temaAcuerdo${data.contenido}"
                        >
                        <br>

                        <label>Responsable</label>
                        <input 
                            type="text" 
                            class="temaResponsable" 
                            idpregunta="${data.contenido}" 
                            name="temaResponsable"
                            id="temaResponsable${data.contenido}"
                        >
                        <br>

                        
                        <label>Fecha de compromiso</label>
                        <input 
                            type="date" 
                            class="temaFechaCompromiso" 
                            idpregunta="${data.contenido}" 
                            name="temaFechaCompromiso"
                            id="temaFechaCompromiso${data.contenido}"
                        >
                        <br>

                                                
                        <label>Fecha de cumplimiento</label>
                        <input 
                            type="date" 
                            class="temaFechaCumplimiento" 
                            idpregunta="${data.contenido}" 
                            name="temaFechaCumplimiento"
                            id="temaFechaCumplimiento${data.contenido}"
                        >
                        <br>

                        <label>Comentario</label>
                        <input 
                            type="text" 
                            class="temaComentario" 
                            idpregunta="${data.contenido}" 
                            name="temaComentario"
                            id="temaComentario${data.contenido}"
                        >
                        <br>

                    </div>
                </div>
            </div>`;


            document.getElementById("listaTemaPropuesto").insertAdjacentHTML('beforeend', contenido);


            }
            escucharCambiosTemaPropuesto();

            eliminarTemaPropuesto();


        }, "json");



        return false;



    });


    function escucharCambiosTemaPropuesto() {
        
        $("#listaTemaPropuesto div.pregunta input.temaAcuerdo").on('click', function (event) {
            event.preventDefault();
            enviarUpdateTemaAcuerdo($(this).attr('idpregunta'));
            return false;
        });

        $("#listaTemaPropuesto div.pregunta input.temaResponsable").on('click', function (event) {
            event.preventDefault();
            enviarUpdateTemaResponsable($(this).attr('idpregunta'));
            return false;
        });

        $("#listaTemaPropuesto div.pregunta input.temaFechaCompromiso").on('change', function (event) {
            event.preventDefault();
            console.log('nothing')
            enviarUpdateTemaFechaCompromiso($(this).attr('idpregunta'));
            return false;
        });

        
        $("#listaTemaPropuesto div.pregunta input.temaFechaCumplimiento").on('change', function (event) {
            event.preventDefault();
            console.log('nothing')
            enviarUpdateTemaFechaCumplimiento($(this).attr('idpregunta'));
            return false;
        });

        $("#listaTemaPropuesto div.pregunta input.temaComentario").on('click', function (event) {
            event.preventDefault();
            enviarUpdateTemaComentario($(this).attr('idpregunta'));
            return false;
        });

    }



    function enviarUpdateTemaAcuerdo(idPregunta) {

        $('#temaAcuerdo' + idPregunta).donetyping(function () {

            var temaAcuerdo = $('#temaAcuerdo' + idPregunta).val();

            $.post(RUTA + 'formulario/updateTemaPropuestoAcuerdo', { acuerdo : temaAcuerdo,  idTemaPropuesto: idPregunta }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

    }

    function enviarUpdateTemaResponsable(idPregunta) {

        $('#temaResponsable' + idPregunta).donetyping(function () {

            var temaResponsable = $('#temaResponsable' + idPregunta).val();

            $.post(RUTA + 'formulario/updateTemaPropuestoResponsable', { responsable : temaResponsable,  idTemaPropuesto:  idPregunta }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

    }


    function enviarUpdateTemaFechaCompromiso(idPregunta) {

        /*$('#temaFechaCompromiso' + idPregunta).change(function () {


        });*/
        var temaFechaCompromiso = $('#temaFechaCompromiso' + idPregunta).val();

        $.post(RUTA + 'formulario/updateTemaPropuestoFechaCompromiso', { fechaCompromiso : temaFechaCompromiso,  idTemaPropuesto:  idPregunta }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    }


    
    function enviarUpdateTemaFechaCumplimiento(idPregunta) {

        /*$('#temaFechaCumplimiento' + idPregunta).change(function () {

 
        });*/

        var temaFechaCumplimiento = $('#temaFechaCumplimiento' + idPregunta).val();

        $.post(RUTA + 'formulario/updateTemaPropuestoFechaCumplimiento', { fechaCumplimiento : temaFechaCumplimiento,  idTemaPropuesto:  idPregunta }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    }

        
    function enviarUpdateTemaComentario(idPregunta) {



        $('#temaComentario' + idPregunta).donetyping(function () {

            var temaComentario = $('#temaComentario' + idPregunta).val();

            $.post(RUTA + 'formulario/updateTemaPropuestoComentario', { comentario : temaComentario,  idTemaPropuesto: idPregunta }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });
    }
    

    function eliminarTemaPropuesto() {

        $("#listaTemaPropuesto div.pregunta button.eliminar").on('click', function (event) {
            event.preventDefault();


            var idTemapropuesto = $(this).attr('idpregunta');

            $.post(RUTA + 'formulario/eliminarTemaPropuesto', { idTemapropuesto : idTemapropuesto }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    document.getElementById(idTemapropuesto).innerHTML = "";
                }

            }, "json");

            return false;


        });
    }



    function agregarHtmlAlternativa(idPregunta) {

        $("#buttonAgregarAlternativa" + idPregunta).on('click', function (event) {
            event.preventDefault();


            $.post(RUTA + 'formulario/insertAlternativa', { idPregunta: idPregunta, index: 1 }, function (data, textStatus, xhr) {

                if (data.status == 200) {

                    var contenido =  `
                        <div id="boxAlternativa${data.contenido}">
                            <input class="radioRespuesta" type="radio" name="radio${idPregunta}" id="radio${data.contenido}"  idalternativa="${data.contenido}" value="${data.contenido}"  > 
                            <input name="alternativa" idpregunta="${idPregunta}" class="alternativa" type="text" idalternativa="${data.contenido}"  id="alternativa${data.contenido}" > 
                            <button class="buttonEliminarAlternativa" idalternativa="${data.contenido}" id="buttonEliminar${data.contenido}"> X </button> 
                        </div> `;

                    document.getElementById("listaAlternativa" + idPregunta).insertAdjacentHTML('beforeend', contenido);

                }

                escucharCambiosAlternativa(idPregunta);


            }, "json");


            return false;
        });
    }

    function agregarHtmlMultiAlternativaGrid(idPregunta) {

        $.post(RUTA + 'formulario/insertSubPregunta', { idPregunta: idPregunta }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);

                var contenidoFila = `
                <div id="boxAlternativa${data.contenido.fila}">
                    <input id="fila${data.contenido.fila}" name="alternativa" class="alternativa" type="text" value="Fila 1" > 
                    <button class="buttonEliminarAlternativa"> X </button> 
                </div> `;

                var contenidoColumna = `
                <div id="boxAlternativa${data.contenido.columna.uno}">
                    <input id="columna${data.contenido.columna.uno}" name="alternativa" class="alternativa columna${idPregunta}" fila="unico" type="text" value="Columna 1" > 
                    <button class="buttonEliminarAlternativa"> X </button> 
                </div> 
                
                <div id="boxAlternativa${data.contenido.columna.dos}">
                    <input id="columna${data.contenido.columna.dos}" name="alternativa" class="alternativa columna${idPregunta}" fila="unico1" type="text" value="Columna 2" > 
                    <button class="buttonEliminarAlternativa"> X </button> 
                </div>
                `;

                $("#filaMuti" + idPregunta).val(data.contenido.fila);
                $("#columnaMulti" + idPregunta).val(data.contenido.columna.uno+","+data.contenido.columna.dos);


                document.getElementById("listaMultiAlternativaFila" + idPregunta).insertAdjacentHTML('beforeend', contenidoFila);
                document.getElementById("listaMultiAlternativaColumna" + idPregunta).insertAdjacentHTML('beforeend', contenidoColumna);

                actualizarTituloSubPreguntaFila(data.contenido.fila);
                actualizarTituloSubPreguntaColumna(data.contenido.columna.uno);
                actualizarTituloSubPreguntaColumna(data.contenido.columna.dos);

            }

        }, "json");




        $("#buttonAgregarMultiAlternativaFila" + idPregunta).on('click', function (event) {
            event.preventDefault();

            console.log($("#columnaMulti" + idPregunta).val());
            var oldValue = $("#columnaMulti" + idPregunta).val().split(",");
            var listaColumna = [];
            oldValue.forEach(valor => {
                console.log(valor)
                listaColumna.push(valor);
            });



            $.post(RUTA + 'formulario/insertSubPreguntaFila', { idPregunta: idPregunta, listaAlternativa: listaColumna }, function (data, textStatus, xhr) {

                console.log(data);

                var contenidoFila = `
                <div id="boxAlternativa${data.contenido}">
                    <input id="fila${data.contenido}" name="alternativa" class="alternativa" type="text" value="Fila 1" > 
                    <button class="buttonEliminarAlternativa"> X </button> 
                </div> `;

                document.getElementById("listaMultiAlternativaFila" + idPregunta).insertAdjacentHTML('beforeend', contenidoFila);

                $("#columnaMulti"+idPregunta).val($("#columnaMulti" + idPregunta).val()+","+data.contenido);

            }, "json");

            return false;
        });



        $("#buttonAgregarMultiAlternativaColumna" + idPregunta).on('click', function (event) {
            event.preventDefault();

            console.log($("#filaMulti" + idPregunta).val());
            var oldValue = $("#filaMulti" + idPregunta).val().split(",");
            var listaFila = [];
            oldValue.forEach(valor => {
                console.log(valor)
                listaFila.push(valor);
            });



            $.post(RUTA + 'formulario/insertSubPreguntaColumna', { idPregunta: idPregunta, listaAlternativa: listaFila }, function (data, textStatus, xhr) {

                console.log(data);

                var contenidoFila = `
                <div id="boxAlternativa${data.contenido}">
                    <input id="fila${data.contenido}" name="alternativa" class="alternativa" type="text" value="Fila 1" > 
                    <button class="buttonEliminarAlternativa"> X </button> 
                </div> `;

                document.getElementById("listaMultiAlternativaColumn" + idPregunta).insertAdjacentHTML('beforeend', contenidoFila);

                $("#filaMulti"+idPregunta).val($("#filaMulti" + idPregunta).val()+","+data.contenido);

            }, "json");

            return false;
        });


    }


    function actualizarTituloSubPreguntaFila(idSubPregunta){

        $('#fila' + idSubPregunta).donetyping(function () {

            var nombre = $('#fila' + idSubPregunta).val();

            $.post(RUTA + 'formulario/updateSubPreguntaNombre', { id: idSubPregunta, nombre: nombre }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");

        });

    }

    function actualizarTituloSubPreguntaColumna(idSubPreguntaAlternativa){

        $('#columna' + idSubPreguntaAlternativa).donetyping(function () {

            var nombre = $('#columna' + idSubPreguntaAlternativa).val();

            $.post(RUTA + 'formulario/updateSubAlternativaPreguntaNombre', { id: idSubPreguntaAlternativa , nombre: nombre }, function (data, textStatus, xhr) {

                if (data.status == 200) {
                    console.log(data.contenido);
                }

            }, "json");
        });

    }




    function escucharCambiosAlternativa(idPregunta) {

        var etiqueta = "#listaAlternativa" + idPregunta + " input.alternativa";


        $(etiqueta).on('click', function (event) {
            event.preventDefault();

            console.log('id alternativa');
            
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


        
        $.post(RUTA + 'formulario/updateAlternativaRespuesta', { idAlternativa: idAlternativa , idPregunta: idPregunta }, function (data, textStatus, xhr) {

            if (data.status == 200) {
                console.log(data.contenido);
            }

        }, "json");
    }



    function isSelectValue(valueProyecto, selectValue) {

        var resultado = "";

        if (valueProyecto == selectValue) {
            resultado = "selected";
        }

        return resultado;

    }

    function isFinalizado(value, idExamenFinalizado) {

    }



    $("#buttonVistaPrevia").on("click", function (event) {
        event.preventDefault();
        sessionStorage.setItem("idExamen", IDEXAMENEDITAR);
        window.open(RUTA + "vistaprevia")

    });

    $("#buttonInicio").on("click", function (event) {
        event.preventDefault();
        sessionStorage.setItem("idExamen", IDEXAMENEDITAR);
        sessionStorage.removeItem('idExamen');
        window.location.href = RUTA + "administrador";

    });








    $(".buttonPdf").on("click", function (event) {
        event.preventDefault();

        $.post(RUTA + "formulario/generatePDFByIdActa", { idActa : IDEXAMENEDITAR },
            function (data, textStatus, jqXHR) {


                console.log(data.contenido);

                if (data.status == 200) {

                    event.preventDefault();
                    window.open(data.contenido)

                }

            },
            "json"

        )

        return false;

    });

    

    $(".descargarNotasExcel").on("click", function (event) {
        event.preventDefault();

        $.post(RUTA + "evaluaciones/listaNotas", { idExamen: IDEXAMENEDITAR ,codigoProyecto : CODIGO_PROYECTO , idareaempresa : IDAREA_EMPRESA},
            function (data, textStatus, jqXHR) {


                console.log(data.contenido);

                if (data.status == 200) {

                    event.preventDefault();
                    window.open(data.contenido)

                }

            },
            "json"

        )

        return false;

    });



    $(".buttonEliminar").on("click", function (event) {
        event.preventDefault();

        $.post(RUTA + "formulario/eliminarExamen", { idExamen: IDEXAMENEDITAR },
            function (data, textStatus, jqXHR) {

                console.log(data.contenido);

                if (data.status == 200) {

                    event.preventDefault();
                    window.location.href = RUTA + "administrador";

                }

            },
            "json"

        )

        return false;

    });


    function listaFirmaFacilitador(examen) {

        var contenidoFirmaFacilitador = ` `;

        $.post(RUTA + 'formulario/getListaFirmaFacilitador', {}, function (data, textStatus, xhr) {

            console.log(data);

            if (data.status == 200) {

                data.contenido.forEach(firma => {

                    contenidoFirmaFacilitador += `<option value="` + firma.id + `"  ` + isChecked(firma.id, examen.idFirmaFacilitador) + `>` + firma.nombre + `</option> `;

                });

                $('#idFirmaFacilitador').append(contenidoFirmaFacilitador);

            } else {
                contenidoFirmaFacilitador = `<option value="10000"> No contamos con firmas disponibles</option> `;
                $('#idFirmaFacilitador').append(contenidoFirmaFacilitador);

            }
        }, "json");

    }


    function isChecked(idFirma, idFirmaFacilitador) {

        var value = '';

        if (idFirma == idFirmaFacilitador) {
            value = 'selected="selected"';
        }

        return value;
    }


    function popUp() {



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


    }


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


    $(".buttonDuplicar").on("click", function(event) {
        event.preventDefault();
       
        $.post(RUTA + 'formulario/duplicarFormulario', {idExamen : IDEXAMENEDITAR ,idAreaEmpresa :IDAREA_EMPRESA}, function (data, textStatus, xhr) {

            if (data.status == 200) {

                window.location.replace(RUTA + "administrador");

            
            } else {

            }

        }, "json");

    });

    
function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false; }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 2; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i][1].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i][0] + " - "+ arr[i][1].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i][1].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + (arr[i][0]+ " - "+arr[i][1]) + "'  idcargo='" + arr[i][0] + "'>";


                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                    /*insert the value for the autocomplete text field:*/
                    var nombrePuestoTrabajo = this.getElementsByTagName("input")[0].value;
                    var idPuestoTrabajo = this.getElementsByTagName("input")[0].getAttribute("idcargo");

                    var htmlPuestoTrabajo = `
                    <div class="puestoTrabajoGeneral" id="${IDEXAMENEDITAR}${idPuestoTrabajo}">
                        <div class="puestoTrabajo">
                            <p> ${nombrePuestoTrabajo}</p>
                            <img class="iconoEliminarPuestoTrabajo" src="public/img/cancel.png">
                        </div>
                    </div>
                    `;

                    $.post(RUTA + 'formulario/insertExamenPuesto', { id_examen : IDEXAMENEDITAR , id_puesto_trabajo :idPuestoTrabajo}, function (data, textStatus, xhr) {

                        if (data.status == 200) {
                            console.log(data.contenido);
                            document.getElementById("listaPuestoTrabajo").insertAdjacentHTML('afterend',htmlPuestoTrabajo);                    
                            document.getElementById("observado_puesto").value = '';
                            deletePuestoTrabajo(idPuestoTrabajo);
                        }

                    }, "json");

                    /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });

    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function(e) {
        closeAllLists(e.target);
    });
}

/*
var countries = [
    [1,'Oficial Fierrero'],
    [2,'Operario Fierrero'],
    [3,'Obras Civiles '],
    [4,'Supervisor Electricista'],
    [5,'Chofer de Equipo Liviano - Camioneta'],
    [6,'Peón'],
    [7,'Asistente de Gerencia'],
    [8,'Operario de Limpieza'],
    [9,'Capataz de Montaje Mecánico'],
    [10,'Rigger'],
    [11,'Coordinador de QA/QC'],
    [12,'Dirección y Operación de Obra'],
    [13,'Oficial Tubero'],
    [14,'Operador de Equipo Pesado (Excavadora)'],
    [15,'Supervisor de SSMA'],
    [16,'Jefe de QA/QC'],
    [17,'Soldador de Estructuras'],
    [18,'Operador de Equipo Semi Pesado - Mixer'],
    [19,'Asistente de Tecnología e Informática'],
    [20,'Operario Tubero'],
    [21,'Asistente Administrativo - Importaciones'],
    [22,'SSMA - Seguridad'],
    [23,'Mecánico de Equipo Pesado'],
    [24,'Asistente Administrativo'],
    [25,'Capataz de Obras Civiles'],
    [26,'Supervisor de Pre-comisionado y Comisionado'],
    [27,'SSMA - Vigías '],
    [28,'Oficial Albañil'],
    [29,'Logistica - Operadores y Rigger'],
    [30,'Operador de Equipo Semi Pesado - Camión Grúa'],
    [31,'Asistente de SSMA'],
    [32,'Coordinador de Sistemas'],
    [33,'Oficial Tareador'],
    [34,'Operador de Equipo Pesado (Grúa)'],
    [35,'Supervisor QA/QC'],
    [36,'Auxiliar Contable'],
    [37,'Operario Montajista - Alineador'],
    [38,'Operario Pintor'],
    [39,'Operador de Equipo Pesado - Manlift'],
    [40,'Operario Montajista'],
    [41,'Montaje de Andamios '],
    [42,'Operario Albañil'],
    [43,'Coordinador de Control de Proyectos'],
    [44,'Asistente de Control de Costos'],
    [45,'Inspector de Precom y Comisionado'],
    [46,'Técnico de Aire Acondicionado'],
    [47,'Oficial Instrumentista'],
    [48,'Ingeniero de Oficina Técnica'],
    [49,'Jefe de RR.HH. - Obra'],
    [50,'Oficial Pintor'],
    [51,'Supervisor de Repuestos y Materiales'],
    [52,'Asistente de Compras'],
    [53,'Soldador Calificado'],
    [54,'Inspector de QA/QC'],
    [55,'Asistente de RR.HH. '],
    [56,'Operador de Equipo Semi Pesado - Carmix'],
    [57,'Médico'],
    [58,'Oficial Amolador'],
    [59,'Practicante de Control de Proyectos'],
    [60,'Operario Gasfitero'],
    [61,'Jefe Corporativo de RR.HH.'],
    [62,'Ayudante Calificado / Tramitador'],
    [63,'Mecánico de Equipo Liviano'],
    [64,'Campamentos '],
    [65,'Almacenero'],
    [66,'SSMA - Medio Ambiente'],
    [67,'Enfermero'],
    [68,'Operario Electricista'],
    [69,'Control de Calidad'],
    [70,'Asistente de Precom y Comisionado'],
    [71,'Operador de Equipo Pesado - Excavadora'],
    [72,'Obras Mecánicas (Piping - Soldadura - Montaje)'],
    [73,'Oficial Montajista'],
    [74,'Capataz de Obras Mecánicas'],
    [75,'Asistente Administrativo-Trámites'],
    [76,'Operador de Equipo Pesado - Rodillo'],
    [77,'Operario Técnico de Laboratorio'],
    [78,'Oficial Carpintero'],
    [79,'Capataz Electricista'],
    [80,'Electricista B'],
    [81,'Carpintero A'],
    [82,'Asistenta Social'],
    [83,'Inspector de SSMA'],
    [84,'Mantenimiento Mécanico '],
    [85,'Inspector de soldadura'],
    [86,'Operario Carpintero'],
    [87,'Coordinador Eléctrico'],
    [88,'Jefe de Oficina Técnica'],
    [89,'Capataz Tubero'],
    [90,'Asistente de QA/QC'],
    [91,'Asistente de Almacén'],
    [92,'Operador de Equipo Pesado - Telehandler'],
    [93,'Capataz  Armado de Campamento'],
    [94,'Jefe Corporativo de Administración'],
    [95,'Gerente SSMA'],
    [96,'Jefe de SSMA'],
    [97,'Encargado de Fase (Pruebas Hidrostáticas)'],
    [98,'Gerente de Contratos y RR.HH'],
    [99,'Operario de Almacén'],
    [100,'Jefe Corporativo de Mantenimiento Mecánico'],
    [101,'Jefe de Planificación'],
    [102,'Superintendente de Obra'],
    [103,'Jefe de Control de Proyectos'],
    [104,'Planchador / Pintor'],
    [105,'Control de Proyectos'],
    [106,'Jefe Corporativo de Presupuestos'],
    [107,'Contador General'],
    [108,'Coordinador de Mantenimiento Mecánico'],
    [109,'Precomisionado y Comisionado '],
    [110,'Capataz Instrumentista'],
    [111,'Asistente de Contabilidad'],
    [112,'Operador de Equipo Semi Pesado - Volquete'],
    [113,'Supervisor de Mantenimiento Mecánico'],
    [114,'Oficial Mecánico de Equipos'],
    [115,'Gerente de Administración y Logística'],
    [116,'Electricista de Mantenimiento de Equipo'],
    [117,'Operador de Equipo Pesado - Grúa'],
    [118,'Operador de Equipo Pesado - Cargador Frontal'],
    [119,'Operario Pintor de Mantenimiento Mecánico'],
    [120,'Asistente de Control de Documento (DCA)'],
    [121,'Capataz Andamiero'],
    [122,'Operador de Equipo Semi Pesado - Montacarga'],
    [123,'Operario de Planta de Concreto '],
    [124,'Ayudante Calificado'],
    [125,'Administrador de Contratos'],
    [126,'Almacenes '],
    [127,'Encargado de Fase'],
    [128,'Asistente de Transporte'],
    [129,'Electricidad e Instrumentación '],
    [130,'Jefe Corporativo de SSMA'],
    [131,'Operario Mecánico de Equipo Pesado - B'],
    [132,'Cadista'],
    [133,'Jefe de Ingeniería'],
    [134,'Abogado'],
    [135,'Director Ejecutivo'],
    [136,'Gerente de Asuntos Institucionales'],
    [137,'Coordinador de Bienestar Social'],
    [138,'Supervisor de Obras Civiles'],
    [139,'Responsable de Sede'],
    [140,'Líder de Precom / Comisionado'],
    [141,'Coordinador de Obras Mecánicas'],
    [142,'Gerente de Operaciones'],
    [143,'Pit de Combustible'],
    [144,'Operador de Equipo Semi Pesado - Cama Baja'],
    [145,'Jefe de Logística'],
    [146,'Jefe Corporativo de Almacenes'],
    [147,'Coordinador de Logística'],
    [148,'Operador de Equipo Semi Pesado - Cisterna'],
    [149,'Jefe de SGI'],
    [150,'Asistente de Logística'],
    [151,'Responsable de Selección y Desarrollo Organizacional'],
    [152,'Oficial Electricista'],
    [153,'Gerente de Proyecto'],
    [154,'Asistente Recepcionista'],
    [155,'Operario Instrumentista'],
    [156,'Topógrafo'],
    [157,'Analista de SGI'],
    [158,'Supervisor Instrumentista'],
    [159,'Asistente de Control de Proyectos'],
    [160,'Capataz de Obras Mecánicas - Pintura'],
    [161,'Inspector de Medio Ambiente'],
    [162,'Oficial de Almacén'],
    [163,'Operador de Equipo Semi Pesado - Cama Baja (carga ancha)'],
    [164,'Operario Tornero'],
    [165,'Oficial de Topografía'],
    [166,'Topografía'],
    [167,'Supervisor de Montaje'],
    [168,'Traductor'],
    [169,'Jefe de Almacén'],
    [170,'Jefe de Procura'],
    [171,'Campamentero'],
    [172,'Gerente General'],
    [173,'Coordinador de Tecnología e Informática'],
    [174,'Supervisor de Campamento'],
    [175,'Coordinador de Repuestos y Materiales'],
    [176,'Comprador'],
    [177,'Responsable de Compensaciones'],
    [178,'Ingeniero de Presupuestos'],
    [179,'Tareador'],
    [180,'Oficial Vigía'],
    [181,'Operario Electricista de Mantenimiento Mecánico - A'],
    [182,'Jefe Corporativo de Salud Ocupacional'],
    [183,'Operador de Equipo Pesado - Motoniveladora'],
    [184,'Ayudante Mecánico'],
    [185,'Gerente Financiero'],
    [186,'Especialista en Ingeniería'],
    [187,'Operario Instrumentista - Conexionista'],
    [188,'Ayudante Local'],
    [189,'Ayudante Calificado  C'],
    [190,'Ingeniero Electrónico'],
    [191,'Operador de Grúa'],
    [192,'Ayudante Calificado B'],
    [193,'Oficial de Pit de Combustible - Lubricantes'],
    [194,'Operario Mecánico de Equipo Liviano - B'],
    [195,'Operario Electricista de Mantenimiento Mecánico - B'],
    [196,'Operario Soldador HDPE'],
    [197,'Oficial de Repuestos y Materiales'],
    [198,'Asistente Bilingüe'],
    [199,'SSMA - Salud'],
    [200,'Carpintero B'],
    [201,'Recursos Humanos'],
    [202,'Supervisor Eléctrico e Instrumentista'],
    [203,'Oficial Andamiero'],
    [204,'Asistente de Catering'],
    [205,'Inspector de Soldadura II'],
    [206,'Amolador'],
    [207,'Jefe de Mantenimiento Mecánico'],
    [208,'Operario Mecánico de Equipo Liviano'],
    [209,'DCA'],
    [210,'Superintendente de Construcción'],
    [211,'Chofer de Microbus'],
    [212,'Operario Rigger'],
    [213,'Practicante de Tecnología e Informática'],
    [214,'Operario Topógrafo'],
    [215,'Operador de Equipo Pesado: Plataforma Elevadora (Man Lift)'],
    [216,'Supervisor de Control de Erosión'],
    [217,'Operador de Equipo Pesado - Tractor'],
    [218,'Operador de Equipo Semi Pesado - Bus'],
    [219,'Operador de Equipo Pesado - Tractor Oruga'],
    [220,'Operador de Equipo Semipesado: Minicargador (Bob CAT)'],
    [221,'Supervisor de Línea'],
    [222,'Técnico de Curvado'],
    [223,'Operador de Equipo Semi Pesado - Cisterna de Agua'],
    [224,'Capataz de Movimiento de Suelos'],
    [225,'Operario Manteador'],
    [226,'Operador de Equipo Pesado - Sideboom'],
    [227,'Capataz de Control de Erosión'],
    [228,'Operario Acoplador'],
    [229,'Operador de Equipo Semi Pesado - Cisterna de Combustible'],
    [230,'Operario Mecánico de Equipo Pesado - A'],
    [231,'Supervisor de Medio Ambiente'],
    [232,'Operario Soldador 4G'],
    [233,'Operario Electricista de Mantenimiento de Equipo - B'],
    [234,'Ingeniería y Topografía'],
];
*/
});

