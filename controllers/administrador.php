<?php

require_once 'status/repuestas.php';

class Administrador extends Controller{
        function __construct()
        {
            parent::__construct();
        }

        function render(){
            $this->view->render('administrador/index');
        }
    }
?>