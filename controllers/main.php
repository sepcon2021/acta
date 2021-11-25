<?php

require_once 'public/email/email.php';

class Main extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {

        $this->view->render('main/index');
    }

    public function getTrabajadorByDni()
    {

        $respuesta=array();

        $dniTrabajador = $_POST['dniTrabajador'];

        $usuarioTrabajador = $this->model->getTrabajadorByDni($dniTrabajador);

        if ($usuarioTrabajador != null) {

            $salidajson = array(
                "dni" => $usuarioTrabajador['dni'],
                "apellidos" => $usuarioTrabajador['apellidos'],
                "nombres" => $usuarioTrabajador['nombres'],
                "ccargo" => $usuarioTrabajador['ccargo'],
                "dcargo" => $usuarioTrabajador['dcargo'],
                "ccostos" => $usuarioTrabajador['ccostos'],
                "dcostos" => $usuarioTrabajador['dcostos'],

            );

            $respuesta=array(
                "status" => 200,
                "respuesta"=> $salidajson 
            );

        }else{

            $email = new Email;
            $email->enviarExistenciaTrabajador($dniTrabajador);
            
            $respuesta=array(
                "status" => 404,
                "respuesta"=> ""
            );
        }

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);


    }


}
