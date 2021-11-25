<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image/png" href="<?php echo constant('URL') ?>public/img/logo.png" />
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/size.css?<?php echo constant('VERSION'); ?>">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/popup.css?<?php echo constant('VERSION') ?>">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/formulario.css?<?php echo constant('VERSION') ?>">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/grideditar.css?<?php echo constant('VERSION') ?>">

    <title>Capacitación</title>
</head>

<body>

    <div class="contenedor">

        <div class="respuesta">

            <div class="tableroDescarga">
                <!-- <h4 class="titulo-descargable">Descargables</h4> -->

                <div>
                    <button class="descargarDocumento buttonPdf"> <img class="icon-download" src="public/img/download.png"> Registro de Acta de Reunión</button>
                    <!--<button class="descargarDocumento descargarNotasExcel"> <img class="icon-download" src="public/img/download.png"> Notas</button>
                    <button class="descargarDocumento buttonDuplicar"> <img class="icon-download" src="public/img/duplicate.png"> Duplicar</button>-->
                    <button class="button-eliminar buttonEliminar"> <img class="icon-download" src="public/img/delete.png"> </button>
                </div>
            </div>
        </div>

        <header class="header">
        </header>


        <div id="listaPreguntas">

        </div>

        <div id="listaTemaPropuesto">

        </div>


        <div class="load">

            <div id="buttonAgregarPregunta" class="button-style">
                <!-- <img class="reload" src="public/img/plus.png">-->
               Agregar general
            </div>

            <div id="buttonAgregarPropuesta" class="button-style">
                <!-- <img class="reload" src="public/img/plus.png">-->
                Agregar propuesta
            </div>

            <div id="buttonInicio" class="button-style">
                <img class="reload" src="public/img/home.png">

            </div>

        </div>

        <br>




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
    <script src="<?php echo constant('URL'); ?>public/js/funciones.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/firma.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/firmaMovil.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/editar.js?<?php echo constant('VERSION'); ?>"></script>
    <!-- <script src="<?php echo constant('URL'); ?>public/js/autocomplete.js?<?php echo constant('VERSION'); ?>"></script>-->


</body>

</html>