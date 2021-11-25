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
                <h1 class="titulo">Examen</h1>
            </div>
            <div>
                <h3 class="titulo">proyecto</h3>
                <select name="codigo" id="codigo"></select>
            </div>

            <div>
                <h3 class="titulo">área</h3>
                <select name="area_empresa" id="area_empresa">
                    <option value="-1">seleccionar área</option>
                    <option value="1">Seguridad</option>
                    <option value="2">SGI</option>
                </select>
            </div>
            <div>
                <button type="submit" class="botonIngresar">Ingresar</button>
            </div>

        </header>
    </div>




    <script src="<?php echo constant('URL'); ?>public/js/jquery.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/funciones.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/inicio.js?<?php echo constant('VERSION'); ?>"></script>

</body>

</html>