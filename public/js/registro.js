$(function () {

    var IDEXAMEN = sessionStorage.getItem('idExamen');
    const DNI_TRABAJADOR = sessionStorage.getItem('dniTrabajador');
    const NOMBRE_EXAMEN = sessionStorage.getItem('nombreExamen');
    const FECHA_EXAMEN = sessionStorage.getItem('fechaExamen');


    contenidoCabecera();

    //$(".header").html(contenidoCabecera());
    ;

    function contenidoCabecera() {

        document.getElementsByClassName('header')[0].innerHTML =  `
        <div class="bordes">
        <h2> ${NOMBRE_EXAMEN}</h2>
        <br>
        <br>
        <h5>fecha</h5>
        <p> ${FECHA_EXAMEN}</p>
        <br>
    </div>`;

    }
    
    $("#btnRegister").on('click', function (event) {

        $("#btnRegister").prop("disabled", false);


        event.preventDefault();


        console.log(validateFormulario());

        if (validateFormulario()) {

            //Iniciamos con el load de carga
            document.getElementsByClassName('load')[0].innerHTML = '<div class="loader"></div>';

            $("form").hide(0);

            var firmaTrabajador = document.getElementById("firma");

            $.post('public/inc/upload-sing.inc.php', { img: firmaTrabajador.toDataURL() }, function (data) {

                $('#nombreFirmaTrabajador').val(data);

                $("#examen").trigger('submit');


            });
        }






        return false;

    });


    //enviar formulario
    $("#examen").on('submit', function (event) {
        event.preventDefault();

        var formulario = $(this).serialize()+`&idActaReunion=${IDEXAMEN.trim()}&dni=${DNI_TRABAJADOR}`;

        $.post(RUTA + 'registro/insertExamen',  formulario, function (data, textStatus, xhr) {

            //Desactivamos el load de carga
            document.getElementsByClassName("load")[0].innerHTML = '';


            if (data.status == 200) {
                $(".respuesta").append(`
                <div class="contenido">  
                    <div class="succesMessage"> 
                        <h3>El formulario fue enviado con éxito</h3> <br> 
                        <button type="submit" class="buttonInicio" id="btnInicio"> Inicio </button> 
                    </div>
                </div>`);
                regresarInicio();
            } else {
                console.log('FAIL');

                $(".respuesta").append(`
                <div class="contenido">  
                    <div class="succesMessage"> 
                        <h3>Volver a enviar el formulario</h3> <br> 
                        <button type="submit" class="buttonInicio" id="btnInicio"> Inicio </button> 
                    </div>
                </div>`);
                regresarInicio();

            }

        }, "json");

        return false;
    });

    function enviarFormulario(jsonFormulario, arrayRespuesta) {


        $.post(RUTA + 'registro/verificarRegistro', { dniTrabajador: arrayRespuesta[0].dni, idExamen : IDEXAMEN}, function (data, textStatus, xhr) {


            console.log('DATA');
            console.log(data);

            if (data.status == 200) {

                $.post(RUTA + 'registro/insertExamen', { data: jsonFormulario }, function (data, textStatus, xhr) {

                    //Desactivamos el load de carga
                    document.getElementsByClassName("load")[0].innerHTML = '';


                    if (data.status == 200) {
                        $(".respuesta").append(`<div class="contenido">  <div class="succesMessage"> <h3>El formulario fue enviado con éxito</h3> <br> <h3>Nota</h3> <br> <h1> ` + arrayRespuesta[0].nota + ` </h1>  <br> <button type="submit" class="buttonInicio" id="btnInicio"> Volver a rendir examen </button> </div> </div>`)
                        regresarInicio();
                    } else {

                        $(".respuesta").append(` <div class="contenido">  <div class="succesMessage"> <h3` + data.contenido + ` </h3> <br> <button type="submit"  class="buttonInicio" id="btnInicio"> Volver a rendir examen </button> </div> </div> `);
                        regresarInicio()

                    }

                }, "json");


            } else {

                $.post(RUTA + 'registro/updateExamen', { data: jsonFormulario }, function (data, textStatus, xhr) {

                    //Desactivamos el load de carga
                    document.getElementsByClassName("load")[0].innerHTML = '';


                    if (data.status == 200) {




                        if (arrayRespuesta[0].nota > notaAprobatoria) {

                            $(".respuesta").append(`<div class="contenido">  <div class="succesMessage"> <h3>El formulario fue enviado con éxito</h3> <br> <h3>Nota</h3> <br> <h1> ` + arrayRespuesta[0].nota + ` </h1> </div> </div>`)

                        } else {
                            $(".respuesta").append(`<div class="contenido">  <div class="succesMessage"> <h3>El formulario fue enviado con éxito</h3> <br> <h3>Nota</h3> <br> <h1> ` + arrayRespuesta[0].nota + ` </h1>  <br> <button type="submit" class="buttonInicio" id="btnInicio"> Volver a rendir examen </button> </div> </div>`)
                            regresarInicio()
                        }
                    } else {

                        $(".respuesta").append(` <div class="contenido">  <div class="succesMessage"> <h3` + data.contenido + ` </h3> <br> <button type="submit"  class="buttonInicio" id="btnInicio"> Volver a rendir examen </button> </div> </div> `);
                        regresarInicio()

                    }

                }, "json");
            }

        }, "json");

    }



    function regresarInicio() {


        $("#btnInicio").on('click', function (event) {

            event.preventDefault();

            //window.location.href = RUTA;
            window.location.replace(RUTA + 'dashboard');

            return false;

        });
    }


    function calcularNota(listaRespuestas) {
        //Desde aca empieza el array con las respuestas acerca del examen
        var INICIO_PREGUNTA = 4;
        var nota = 0;

        const RESPUESTA_CORRECTA = 1;

        listaPreguntas.forEach(pregunta => {

            if(pregunta.idtipopregunta == ALTERNATIVA ){

                pregunta.alternativa.forEach(data =>{
                
                    if(data.respuesta == RESPUESTA_CORRECTA & data.id == listaRespuestas[INICIO_PREGUNTA]["value"] ){
                        
                        nota += pregunta.puntaje;
    
                    }
                });
    
            }

            INICIO_PREGUNTA++;

        })

        return nota;
    }


    function convertRespuestaToArray(listaRespuestas) {
        //Desde aca empieza el array con las respuestas acerca del examen
        var index = 4;
        var listaRespuestaArray = [];

        listaPreguntas.forEach(pregunta => {

            listaRespuestaArray.push({
                idPregunta: pregunta.id, respuesta: listaRespuestas[index]["value"]
            });

            index++;

        })


        return listaRespuestaArray;
    }

  


    /**************************************************************************** */
    /************* FUNCIONES PARA VALIDAR CHECKS   ****************************** */
    /**************************************************************************** */
    /**************************************************************************** */

    function validateFormulario() {

        var listaEtiquetasValidacion = ["nombreApellido","sigla","cargo"];

        var validarFormulario = true;

        listaEtiquetasValidacion.forEach((value) => {

            if (!validateCampo(value)) {
    
                validarFormulario = false;
            }
        });

        if (isCanvasBlank()) {

            validarFormulario = false;
        }






        return validarFormulario;
    }


    function isCanvasBlank() {

        var canvas = document.getElementById("firma");

        const context = canvas.getContext('2d');

        const pixelBuffer = new Uint32Array(
            context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
        );

        var resultado = !pixelBuffer.some(color => color !== 0);

        if (resultado) {

            document.getElementById("firmaMessage").innerHTML = "Ingresar firma";

        }


        return resultado;
    }


    function validateCampo(etiqueta){

        var resultForm = true;


        const campo = document.getElementById(etiqueta);
        const campoValue = campo.value.trim();
    
        if (campoValue === '') {
            resultForm = false;
            setErrorForCheck(etiqueta);
        }
        return resultForm;
    }


    function validateCheck(idEtiqueta) {

        var resultForm = false;


        const etiqueta = document.getElementsByName(idEtiqueta);

        etiqueta.forEach((value) => {
            if (value.checked) {
                resultForm = true;
            }
        });

        if (!resultForm) {

            setErrorForCheck(idEtiqueta)

        }

        return resultForm;
    }


    function setErrorForCheck(etiqueta) {

        const message = document.getElementById(etiqueta + '_message');
        message.style.visibility = 'visible';
        message.scrollIntoView();

    }

    function setChangeErrorCheck(etiqueta) {
        const message = document.getElementById(etiqueta + '_message');
        message.style.visibility = 'hidden';
    }




    function getMonth() {
        var arrayMonths = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Dicimebre'];
        var day = new Date();

        return arrayMonths[day.getMonth()]
    }



});





