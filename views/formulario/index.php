<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo constant('URL') ?>public/img/logo.png" />

    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/size.css?<?php echo constant('VERSION'); ?>">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/popup.css?<?php echo constant('VERSION'); ?>">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/formulario.css?<?php echo constant('VERSION'); ?>">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/gridformulario.css?<?php echo constant('VERSION'); ?>">


    <title>formulario</title>
</head>

<body>

    <div class="contenedor">

        <header class="header">


            <div class="campo">
                <label>Proyecto</label>
                <br>
                <h3 id="nombreproyecto"></h3>
        
                <!--
                <select name="idProyecto" id="idProyecto">
                    <option value="0"> Elegir proyecto</option>
                    <option value="1"> WHCP21-CASHIRIARI WELL HEAD COMPRESSION PROJECT</option>
                    <option value="2"> EPC-Obras Electromecánicas Varias Malvinas</option>
                </select>
            -->
            
        </div>

            <div class="campo">

                <label>Tema</label>
                <input type="text" name="tema" id="temaExamen">
            </div>

            <div class="campo">

                <label>Fase</label>
                <input type="text" name="fase" id="faseExamen">

                <label>Facilitador</label>
                <input type="text" name="facilitador" id="facilitadorExamen">

                <label>Cliente</label>
                <input type="text" name="cliente" id="clienteExamen">


            </div>



            <div class="campo">
                <label for="titulo">Fecha</label>
                <input type="date" name="fecha" value="<?php echo date("Y-m-d"); ?>" id="fechaExamen">

                <label>Duración</label>
                <input type="number" name="duracion" id="duracionExamen" class="w5p">



                <label for="titulo">Hora inicio</label>
                <input type="time" name="horaInicio" value="<?php echo date("H:i"); ?>" id="horaInicioExamen">

                <label for="titulo">Hora fin</label>
                <input type="time" name="horaFin" value="<?php echo date("H:i"); ?>" id="horaFinExamen">


            </div>

            <div class="campo">
                <label>Duración programada</label>
                <input type="number" name="duracionProgramada" id="duracionProgramadaExamen">

                <label>Duración efectiva</label>
                <input type="number" name="duracionEfectiva" id="duracionEfectivaExamen">
            </div>


            <div class="campo">
                <label>Curso</label>
                <select name="idCurso" id="idCurso">
                    <option value="1"> Escoger curso</option>
                    <option value="2"> Curso audio visual</option>
                    <option value="3"> Curso oral</option>
                    <option value="4"> Curso teórico</option>
                    <option value="5"> Curso práctico</option>
                </select>

                <label>Área de capacitación</label>
                <select name="idAreaCapacitacion" id="idAreaCapacitacion">
                    <option value="1"> Escoger area de capacitacion</option>
                    <option value="2"> Seguridad</option>
                    <option value="3"> Medio ambiente</option>
                    <option value="4"> Otros</option>
                    <option value="5"> Salud</option>
                    <option value="6"> Calidad</option>
                </select>
            </div>
            <div class="campo">
                <label>Nota aprobatoria</label>
                <input type="number" name="nota" id="notaExamen">
            </div>


            <!--    ADD NEW DATA    -->
            <div class="campo">
                <label>Temario</label>

            </div>

            <div class="campo">

                <label>a)</label>
                <input type="text" name="temarioA" id="temarioA">

            </div>

            <div class="campo">

                <label>b)</label>
                <input type="text" name="temarioB" id="temarioB">

            </div>



            <div class="campo">

                <label>Observación</label>
                <input type="text" name="observacion" id="observacion">

            </div>

            <div class="campo">
                <label> ¿Finalizo?</label>
                <select class="w5p" name="finalizo" id="finalizo">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>


                <label> ¿Continuara?</label>
                <select class="w5p" name="continuara" id="continuara">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>


                <label for="titulo">Fecha de continuación</label>
                <input type="date" name="fechaContinuacion" value="<?php echo date("Y-m-d"); ?>" id="fechaContinuacion">

            </div>


            <!--      -->



            <div class="campo">
                <div>
                    <h3>Firma del facilitador</h3>
                    <select name="idFirmaFacilitador" id="idFirmaFacilitador"></select>
                </div>


            </div>

            <div class="campo">
                <button class="buttonAdd" id="addRowObs">Agregar firma </button>

            </div>

            <div class="campo">
                <label> Enviar correo </label>
                <select class="w5p" name="enviarCorreo" id="enviarCorreo">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </div>

            <div class="campo">
                <label> Cantidad de preguntas en el examen </label>
                <select class="w5p" name="cantidadPregunta" id="cantidadPregunta">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="1000">Todas las preguntas</option>
                </select>
            </div>

            <div class="campo">
                <label> Preguntas aleatorias</label>
                <select class="w5p" name="aleatorio" id="aleatorio">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </div>

        </header>


        <div id="listaPreguntas">


        </div>

        <div class="load">

            <div id="buttonAgregarPregunta" class="button-style">
                <img class="reload" src="public/img/plus.png">
            </div>

            <div id="buttonVistaPrevia" class="button-style">
                <img class="reload" src="public/img/view.png">

            </div>

            <div id="buttonInicio" class="button-style">
                <img class="reload" src="public/img/home.png">

            </div>

        </div>

        <div class="respuesta">

        </div>

    </div>



    <!-- ESTE ES EL POPUP  -->
    <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="content">


            <form method="POST" id="examen">
                <div class="campo">
                    <h4>Firma del trabajador</h4>
                </div>
                <div class="campo">
                    <label>Nombre del facilitador</label>
                    <br>
                    <input type="text" name="nombreFacilitador" id="nombreFacilitador" class="w50p">
                </div>



                <input type="hidden" name="urlImagen" id="urlImagen">

                <div class="campo">

                    <label>Firma</label>
                    <div>
                        <canvas class="firmaBordes" id="firma" width="300" height="250"></canvas>
                        <span id="firmado" class="oculto"></span>
                    </div>
                    <p id="firmaMessage"></p>

                    <button type="button" class="button-blue" id="draw-clearBtn">Borrar firma </button>

                </div>


                <div class="campo">
                    <button type="submit" id="btnRegisterFirma" class="button-upload w15p"> Subir firma </button>
                    <button class="buttonDeletePopup clickPopup-close w15p" type="submit" id="btnUpdateDocumento">Cancelar</button>

                </div>

            </form>



            <div id="boxLoad">

            </div>

            <div id="respuesta"></div>




        </div>





    </div>



    <script src="<?php echo constant('URL'); ?>public/js/jquery.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/firma.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/firmaMovil.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/funciones.js?v1.0.12"></script>
    <script src="<?php echo constant('URL'); ?>public/js/formulario.js?<?php echo constant('VERSION'); ?>"></script>




</body>

</html>