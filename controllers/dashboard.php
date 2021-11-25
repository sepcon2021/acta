<?php

class Dashboard extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        session_start();
        $this->view->render('dashboard/index');
    }

    
    public function listaActasReuniones()
    {
        $dniTrabajador = $_POST['dniTrabajador'];
        $respuesta = $this->model->listaActasReuniones($dniTrabajador);
        echo $this->responseMessageContenido($respuesta);
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
        if ($value != null) {
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
