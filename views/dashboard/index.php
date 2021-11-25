<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image/png" href="<?php echo constant('URL') ?>public/img/logo.png" />
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/grid.css?<?php echo constant('VERSION'); ?>">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/tabla.css?<?php echo constant('VERSION'); ?>">

    <title>Capacitación</title>
</head>

<body>




    <div class="contenedor">
        <header class="header" id="header">
        </header>

        <table class="styled-table">

            <thead>
                <tr>
                    <td>Codigo</td>
                    <td>Motivo</td>
                    <td>Fecha</td>
                   <!-- <td>Estado</td>-->
                </tr>
            </thead>
            <tbody id="listaExamen">

            </tbody>
        </table>
    </div>





    <script src="<?php echo constant('URL'); ?>public/js/jquery.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/funciones.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/dashboard.js?<?php echo constant('VERSION'); ?>"></script>

</body>

</html>