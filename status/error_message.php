<?php

class ErrorMessage{

    public $error_id ;
    public $error_message;

    function __construct($error_id,$error_message){
        $this->error_id=$error_id;
        $this->error_message=$error_message;
    }
}

?>
