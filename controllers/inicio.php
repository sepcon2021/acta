<?php

require_once 'status/repuestas.php';

class Inicio extends Controller{
        function __construct()
        {
            parent::__construct();
        }

        function render(){
            $this->view->render('inicio/index');
        }

        


    public function listaProyecto()
    {
        
        $respuesta =  $this->model->listaProyecto();

        echo $this->responseMessageContenido($respuesta);

    }


    public function listaAreaByIdProyecto()
    {
        $idProyecto = $_POST['idproyecto'];

        $respuesta =  $this->model->listaAreaByIdProyecto($idProyecto);

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
        if (count($value)>0) {
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
