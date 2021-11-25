<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image/png" href="<?php echo constant('URL') ?>public/img/logo.png" />
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/size.css?<?php echo constant('VERSION'); ?>">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/grid.css?<?php echo constant('VERSION'); ?>">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/tabla.css?<?php echo constant('VERSION'); ?>">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/administrador.css?<?php echo constant('VERSION'); ?>">

    <title>Capacitación</title>
</head>

<body>

    <div class="contenedor">

        <header class="header">
            <div>
                <h3 class="titulo" id="nombreAreaEmpresa"></h3>
                <h3 class="titulo" id="nombreProyecto"></h3>
                <!-- <h3 class="titulo">Formulario</h3>-->
                <form method="POST" id="formCrearCapacitacion">
                    <input type="hidden" name="codigoproyecto" id="codigoproyecto">
                    <input type="hidden" name="idareaempresa" id="idareaempresa">
                    <button type="submit" id="botonEnviar">Crear acta de reunión</button>
                </form>
            </div>

        </header>



        <table class="styled-table">

            <thead>
                <tr>
                    <td>N°</td>
                    <td>Nombre</td>
                    <td>Fecha</td>

                </tr>
            </thead>
            <tbody id="listaExamen">

            </tbody>
        </table>
    </div>




    <script src="<?php echo constant('URL'); ?>public/js/jquery.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/funciones.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/administrador.js?<?php echo constant('VERSION'); ?>"></script>

</body>

</html>