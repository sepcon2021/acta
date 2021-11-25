<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image/png" href="<?php echo constant('URL') ?>public/img/logo.png" />
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/gridregistro.css?<?php echo constant('VERSION'); ?>">

    <title>Capacitación</title>
</head>

<body>


    <div class="contenedor">

        <header class="header">
        </header>

        <form method="POST" id="examen">

            <input type="hidden" name="nombreFirmaTrabajador" id="nombreFirmaTrabajador">


            <div id="contenido-pregunta">
            </div>


            <div class="contenido">
                <div class="bordes">
                    <h4>Firma del trabajador</h4>
                    <br>
                    <br>
                    <div>
                        <canvas class="firmaBordes" id="firma" width="240" height="300"></canvas>
                        <span id="firmado" class="oculto"></span>
                    </div>
                    <p id="firmaMessage"></p>
                    <br>
                    <br>
                    <button type="button" class="button-blue" id="draw-clearBtn">Borrar firma </button>
                </div>
            </div>



        </form>

        <div class="load">
        </div>

        <div class="respuesta">
            
        </div>

        <div class="floatingActionButton">
            <img class="reload" src="public/img/refresh.png">
        </div>

    </div>




    <script src="<?php echo constant('URL'); ?>public/js/jquery.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/firma.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/firmaMovil.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/funciones.js?<?php echo constant('VERSION'); ?>"></script>
    <script src="<?php echo constant('URL'); ?>public/js/vistaprevia.js?<?php echo constant('VERSION'); ?>"></script>

</body>

</html>