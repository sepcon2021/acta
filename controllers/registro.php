<?php

require_once 'public/email/email.php';
require_once 'public/generate-pdf/generatepdf.php';

class Registro extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->view->render('registro/index');
    }


    public function insertExamen()
    {

        $idActaReunion = $_POST['idActaReunion'];
        $dni = $_POST['dni'];
        $firma = str_replace(" ","",$_POST['nombreFirmaTrabajador']);
        $nombreApellido = $_POST['nombreApellido'];
        $sigla = $_POST['sigla'];
        $cargo = $_POST['cargo'];


        $datos = compact("idActaReunion","dni","firma", "nombreApellido", "sigla", "cargo");

        $respuesta = $this->model->insertResgistro($datos);

        echo $this->responseMessage($respuesta);

    }

   

    public function responseMessage($value)
    {
        if ($value) {
            $return["status"] = 200;
            $return["contenido"] = "ok";

        } else {

            $return["status"] = 404;
            $return["contenido"] = "Problemas en nuestros servicios";

        }

        header('Content-Type: application/json');
        return json_encode($return);
    }

    public function responseMessageContenido($value)
    {
        if ($value ==  0) {
            $return["status"] = 200;
            $return["contenido"] = $value;

        } else {

            $return["status"] = 404;
            $return["contenido"] = "Problemas en nuestros servicios";

        }

        header('Content-Type: application/json');
        return json_encode($return);
    }



}
