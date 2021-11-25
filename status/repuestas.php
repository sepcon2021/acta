<?php 

require_once 'status/error_message.php';

class respuestas{

    public  $response = [
        'status' => "ok",
        "result" => array()
    ];


    public function error_405(){
        $this->response['status'] = "error";
        $error_message = new ErrorMessage("405","Metodo no permitido");
        $this->response['result'] = array($error_message);
        return $this->response;
    }

    public function error_200($valor = "Datos incorrectos"){
        $this->response['status'] = "error";
        $error_message = new ErrorMessage("200",$valor);
        $this->response['result'] = array($error_message);
        return $this->response;
    }


    public function error_400(){
        $this->response['status'] = "error";
        $error_message = new ErrorMessage("400","Datos enviados incompletos o con formato incorrecto");
        $this->response['result'] = array($error_message );
        return $this->response;
    }


    public function error_500($valor = "Error interno del servidor"){
        $this->response['status'] = "error";
        $error_message = new ErrorMessage("500",$valor);

        $this->response['result'] = array($error_message);
        return $this->response;
    }


    public function error_401($valor = "No autorizado"){
        $this->response['status'] = "error";
        $error_message = new ErrorMessage("401",$valor);
        $this->response['result'] = array($error_message);
        return $this->response;
    }
    
    public function error_404(){
        $this->response['status'] = "error";
        $error_message = new ErrorMessage("404","Recurso no disponible");
        $this->response['result'] = array($error_message);
        return $this->response;
    }

}

?>