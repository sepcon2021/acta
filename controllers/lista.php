<?php

class Lista extends Controller{
        function __construct()
        {
            parent::__construct();
        }

        function render(){
            $this->view->render('lista/index');
        }
    }
?>