$(function () {

    var IDEXAMEN = sessionStorage.getItem('idExamen');
    const CODIGO_PROYECTO = sessionStorage.getItem("codigoProyecto");


    // Sección para traer contenido del examen


    var contenidoHtml = "";

    $.post(RUTA + 'formulario/listaPreguntaByIdExamenRegistroLimit', { idExamen: IDEXAMEN,idProyecto : CODIGO_PROYECTO}, function (data, textStatus, xhr) {

        if (data.status == 200) {

            $(".header").append(contenidoCabecera(data.contenido));


            contenidoHtml = crearHtmlPregunta(data.contenido);
            $("#contenido-pregunta").append(contenidoHtml);



        }

    }, "json");





    function crearHtmlPregunta(contenido) {

        var htmlPregunta = "";
        var index = 1;

        notaAprobatoria = contenido.examen.nota;
        htmlPregunta += contenidoEstatico(contenido);
        listaPreguntas = contenido.examen.listaPreguntas;

        contenido.examen.listaPreguntas.forEach(pregunta => {

            //htmlPregunta += contenidoPregunta(pregunta, index);
            htmlPregunta += tipoAlternativaHtml(pregunta,index);
            index++;
        });


        return htmlPregunta;
    }


    function contenidoCabecera(contenido) {

        return `
        <div class="bordes">
        <h2> `+ contenido.examen.tema + `</h2>
        <br>
        <br>
        <h5>Mes</h5>
        <p> `+ getMonth() + `</p>
        <br>
        <h5>Proyecto</h5>
        <p> `+ contenido.examen.nombreProyecto + `</p>
        <br>
        <h5>Cliente</h5>
        <p>`+ contenido.examen.cliente + `</p>
        <br>
        <h5>Facilitador</h5>
        <p> `+ contenido.examen.facilitador + `</p>
    </div>`;



    }

    function tipoAlternativaHtml(pregunta,index) {

        var ALTERNATIVA = 1;
        var RESPUESTA = 2;

        var htmlAlternativa = ``;

        if(pregunta.idtipopregunta == ALTERNATIVA){

            htmlAlternativa = contenidoPregunta(pregunta, index);

        }
        if(pregunta.idtipopregunta ==  RESPUESTA){
            htmlAlternativa =  contenidoRespuestaHtml(pregunta,index);
        }
        return htmlAlternativa;
    }

    function contenidoRespuestaHtml(pregunta,index){
        return `<div class="contenido" > 
        <div class="bordes">
        <h4>${index}. ${pregunta.nombre} </h4> 
        <textarea class="comentario" placeholder="Comentarios" readonly></textarea> 
        </div> 
        </div>`
    }

    function contenidoPregunta(pregunta, index) {

        return `<div class="contenido" > 
        <div class="bordes">
        <h4>  `+ index + `.` + pregunta.nombre + ` </h4> 
        <div> 
        <br> 
        <div id="listaAlternativa`+ pregunta.id + ` "> 
        `+ crearHtmlAlternativa(pregunta) + `
        </div> 
        </div>

        <div class="error_message" id="pregunta`+ pregunta.id + `_message">
        <p>Marca una alternativa</p>
        </div>

        <div> <br> <p>puntaje : `+pregunta.puntaje+` </p> </div>

        </div> 
        </div>`;


    }

    function crearHtmlAlternativa(pregunta) {
        var htmlAlternativa = "";


        pregunta.alternativa.forEach(alternativa => {


            htmlAlternativa += contenidoAlternativa(alternativa, pregunta);

        });


        return htmlAlternativa;
    }

    function contenidoAlternativa(alternativa, pregunta) {

        return ' <div class="' + contenidoCheckAvalaible(alternativa.respuesta) + '"> ' +

            '<input class="radioRespuesta" type="radio" name="pregunta' + pregunta.id + '" id="radio' + alternativa.id + '"  idalternativa="' + alternativa.id + '" value="' + alternativa.id + '" > ' +
            '<label >' + alternativa.nombre + '</label> ' +
            '</div>'
            ;
    }

    function contenidoCheckAvalaible(respuesta) {

        var contenido = '';

        if (respuesta == 1) {
            contenido = 'avaible';
        }

        return contenido;
    }






    function contenidoEstatico(contenido) {
        return `
        <div class="contenido">
            <div class="bordes">
                    <h4>Área</h4>
                    <input type="radio" name="area" id="area1" value="1"> 
                    <label for="area1">Obras Civiles</label> 
                    <br> 
                    <input type="radio" name="area" id="area2" value="2"> 
                    <label for="area2">Piping</label> 
                    <br> 
                    <input type="radio" name="area" id="area3" value="3"> 
                    <label for="area3">Precom/com</label> 
                    <br> 
                    <input type="radio" name="area" id="area4" value="4"> 
                    <label for="area4">Contratista</label> 
                    <br> 
                    <input type="radio" name="area" id="area5" value="5"> 
                    <label for="area5">Mantenimiento de Equipos Mecánicos</label> 
                    <br> 
                    <input type="radio" name="area" id="area6" value="6"> 
                    <label for="area6">Logistica - Operadores, Rigger y Andamieros</label> 
                    <br> 
                    <input type="radio" name="area" id="area7" value="7"> 
                    <label for="area7">Mantenimiento y Habilitación de Campamento</label> 
                    <br> 
                    <input type="radio" name="area" id="area8" value="8"> 
                    <label for="area8">Oficina</label> 
                    <br> 
                    <input type="radio" name="area" id="area9" value="9"> 
                    <label for="area9">SSMA - Seguridad y Salud</label> 
                     <br> 
                    <input type="radio" name="area" id="area10" value="10"> 
                    <label for="area10">Calidad</label> 
                    <br> 
                    <input type="radio" name="area" id="area11" value="11"> 
                    <label for="area11">Electricidad e Instrumentación</label> 
                    <br>
                    <br><br>
            </div>
        </div>
       `;



    }

    function listaArea(contenido) {
        var htmlSelect =  ` `;
        contenido.listaArea.forEach(area => {
            htmlSelect += `<br> 
            <input type="radio" name="area" id="area`+area.id+`" value="`+area.id+`"> 
            <label for="area`+area.id+`"> `+area.nombre+`</label> `;
        });
        return htmlSelect;
    }


    $(".floatingActionButton").on("click", function (event) {

        event.preventDefault();

        window.location.replace(RUTA + "vistaprevia");

    });



    function getMonth() {
        var arrayMonths = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Dicimebre'];
        var day = new Date();

        return arrayMonths[day.getMonth()]
    }





});





