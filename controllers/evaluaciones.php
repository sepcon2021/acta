<?php

require_once 'public/generate-pdf/generatepdf.php';

require_once 'models/formulariomodel.php';

require_once 'public/generarExcel/reporteNotas.php';

require_once 'models/formulariomodel.php';


class Evaluaciones extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->view->render('evaluacion/index');
    }



    public function generatePDFByIdExamen()
    {

        $respuestaJson=array();


        $idExamen = $_POST['idExamen'];

        $evaluacion = $this->model->getExamenDetalleById($idExamen);

        if($evaluacion!= null){

            // Generamos PDF
            
            $urlPDF=$this->generatePdf($evaluacion);


            $respuestaJson = array(
                "status" =>200,
                "contenido" => $urlPDF,
            );

        }else{

            $respuestaJson = array(
                "status" =>404,
                "contenido" => "No encontramos registros del mes",
            );
        }

        echo json_encode($respuestaJson, JSON_UNESCAPED_UNICODE);


    }

    
    public function generatePdf($evaluacion){
        $SEGURIDAD = 1;
        $SGI = 2;

        $urlPDF = '';

        $pdf=new GeneratePDF();

        if($evaluacion->areaempresa ==  $SEGURIDAD ){

            $urlPDF =  $pdf->generateAsistenciaPdf($evaluacion);

        }
        if($evaluacion->areaempresa ==  $SGI ){
           
            $urlPDF =  $pdf->generateAsistenciaEstandarPdf($evaluacion);

        }

        return $urlPDF;
    }




    public function generateExcel()
    {

        $respuestaJson=array();


        $idExamen = $_POST['idExamen'];



        $pregunta = $this->model->getExamenPreguntasDetalleById($idExamen);

        $evaluacion = $this->model->getListaRegistroByIdExamen($idExamen);

        



        if($pregunta != null){

            $respuestaJson = array(
                "status" =>200,
                "contenido" => $pregunta,
            );

        }else{

            $respuestaJson = array(
                "status" =>404,
                "contenido" => "No encontramos registros del mes",
            );
        }

        echo json_encode($respuestaJson, JSON_UNESCAPED_UNICODE);


    }

    public function listaNotas(){

        $SEGURIDAD = 1;
        $SGI = 2;

        $idExamen = $_POST['idExamen'];
        $codigoProyecto = $_POST['codigoProyecto'];
        $idareaempresa = $_POST['idareaempresa'];

        $formulario = new FormularioModel;
        $listaPreguntas = $formulario->listaPreguntasPrueba($idExamen);
        $listaAlternativas = $formulario->listaAlternativasPrueba($idExamen);


        $excel =  new ReporteNotasExcel;


        if($idareaempresa == $SEGURIDAD){

            $listaExamenesNotas = $this->model->listaNotas($idExamen,$this->convertCodigoProyecto($codigoProyecto));
            $ruta =  $excel->generateReporteNotas($listaExamenesNotas);

        }

        if($idareaempresa == $SGI){

            $listaExamenesNotas = $this->model->listaNotasSGI($idExamen);
            $ruta =  $excel->generateReporteNotasSGI($listaExamenesNotas,$listaPreguntas,$listaAlternativas);

        }

        //$listaExamenesNotas = $this->model->listaNotas($idExamen,$this->convertCodigoProyecto($codigoProyecto));
        //$excel =  new ReporteNotasExcel;
        //$ruta =  $excel->generateReporteNotas($listaExamenesNotas);

        if(count($listaExamenesNotas)>0){

            $respuestaJson = array(
                "status" =>200,
                "contenido" => $ruta,
            );

        }else{

            $respuestaJson = array(
                "status" =>404,
                "contenido" => "No encontramos registros del mes",
            );
        }

        echo json_encode($respuestaJson, JSON_UNESCAPED_UNICODE);

    }

    public function prueba(){

        $idExamen = $_POST['idExamen'];

        
        $listaExamenesNotas = $this->model->listaNotasSGI($idExamen);

        echo json_encode($listaExamenesNotas, JSON_UNESCAPED_UNICODE);

    }


    public function convertCodigoProyecto($codigo){
        $codigoProyecto = '';

        if($codigo == 1){
            $codigoProyecto = '280000';
        }else if($codigo == 2){
            $codigoProyecto = '283000';
        }else if($codigo == 3){
            $codigoProyecto = '300000';
        }
        return $codigoProyecto;
    }

 
 


}
