<?php

require_once 'models/iniciomodel.php';
require_once 'public/generate-pdf/generatepdf.php';

class Formulario extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->view->render('formulario/index');
    }


    public function crearActa()
    {

        $return["status"] = 404;
        $return["contenido"] = "Problemas en nuestros servicios";


        // EXTRAEMOS LA CABECERA DEL FORMULARIO
        $idExamen = $this->insertActa();        

        if ($idExamen != null) {

            $return["status"] = 200;
            $return["contenido"] = $idExamen;
        }

        header('Content-Type: application/json');
        echo json_encode($return);
    }

    //INSERTAMOS LA CABECERA DEL EXAMEN
    //Vamos a crear con campos por defecto el examen solo para retornar el ID que se genera
    public function insertActa()
    {

        $currentDate = new DateTime();

        $motivo = '';
        $numero_reunion= '';
        $tiempo_programado= '';
        $nombre_proyecto= '';
        $lugar= '';
        $tiempo_real_duracion= '';
        $cliente= '';
        $fecha= $currentDate->format('Y-m-d');
        $observaciones= '';


        $datos = compact(
            'motivo',
            'numero_reunion',
            'tiempo_programado',
            'nombre_proyecto',
            'lugar',
            'tiempo_real_duracion',
            'cliente',
            'fecha',
            'observaciones'
        );

        $respuesta = $this->model->insertActa($datos);

        return $respuesta;
    }


    public function updateActaMotivo()
    {

        $id = $_POST['id'];
        $motivo = $_POST['motivo'];

        $datos = compact("id", "motivo");

        $respuesta = $this->model->updateActaMotivo($datos);

        echo $this->responseMessage($respuesta);
    }

    
    public function updateActaNumeroReunion()
    {

        $id = $_POST['id'];
        $numero_reunion = $_POST['numero_reunion'];

        $datos = compact("id", "numero_reunion");

        $respuesta = $this->model->updateActaNumeroReunion($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateActaTiempoProgramado()
    {

        $id = $_POST['id'];
        $tiempo_programado = $_POST['tiempo_programado'];

        $datos = compact("id", "tiempo_programado");

        $respuesta = $this->model->updateActaTiempoProgramado($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateActaNombreProyecto()
    {

        $id = $_POST['id'];
        $nombre_proyecto = $_POST['nombre_proyecto'];

        $datos = compact("id", "nombre_proyecto");

        $respuesta = $this->model->updateActaNombreProyecto($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateActaLugar()
    {

        $id = $_POST['id'];
        $lugar = $_POST['lugar'];

        $datos = compact("id", "lugar");

        $respuesta = $this->model->updateActaLugar($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateActaTiempoRealDuracion()
    {

        $id = $_POST['id'];
        $tiempo_real_duracion = $_POST['tiempo_real_duracion'];

        $datos = compact("id", "tiempo_real_duracion");

        $respuesta = $this->model->updateActaTiempoRealDuracion($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateActaCliente()
    {

        $id = $_POST['id'];
        $cliente = $_POST['cliente'];

        $datos = compact("id", "cliente");

        $respuesta = $this->model->updateActaCliente($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateActaFecha()
    {

        $id = $_POST['id'];
        $fecha = $_POST['fecha'];

        $datos = compact("id", "fecha");

        $respuesta = $this->model->updateActaFecha($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateActaObservaciones()
    {

        $id = $_POST['id'];
        $observaciones = $_POST['observaciones'];

        $datos = compact("id", "observaciones");

        $respuesta = $this->model->updateActaObservaciones($datos);

        echo $this->responseMessage($respuesta);
    }



    //Detalle del acta
    public function actaDetalle()
    {

        $idActa = $_POST['idActa'];

        $detalleActa = $this->model->findByIdActa($idActa);

        echo $this->responseMessageContenido($detalleActa);
    }

    //Detalle del acta
    public function getListActaReuniones()
    {

        $detalleActa = $this->model->getListActaReuniones();

        echo $this->responseMessageContenido($detalleActa);
    }


    public function insertTemaGeneral()
    {


        $id_acta_reunion = $_POST['idActa'];
        $tema_agenda = '';
        $duracion = '';
        $responsable = '';
        $tratado = '';
        $no_tratado = '';
        $comentario = '';

        $datos = compact("id_acta_reunion", "tema_agenda", "duracion", "responsable","tratado","no_tratado","comentario");

        $idPregunta = $this->model->insertTemaGeneral($datos);

        echo $this->responseMessageContenido($idPregunta);
    }


    //UPDATE PREGUNTA nombre
    public function updateTemaGeneralTemaAgenda()
    {

        $temaAgenda = $_POST['temaAgenda'];
        $idTemaAgenda = $_POST['idTemaAgenda'];

        $datos = compact("temaAgenda", "idTemaAgenda");

        $respuesta = $this->model->updateTemaGeneralTemaAgenda($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateTemaGeneralDuracion()
    {

        $duracion = $_POST['duracion'];
        $idTemaAgenda = $_POST['idTemaAgenda'];

        $datos = compact("duracion", "idTemaAgenda");

        $respuesta = $this->model->updateTemaGeneralDuracion($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateTemaGeneralResponsable()
    {

        $responsable = $_POST['responsable'];
        $idTemaAgenda = $_POST['idTemaAgenda'];

        $datos = compact("responsable", "idTemaAgenda");

        $respuesta = $this->model->updateTemaGeneralResponsable($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateTemaGeneralTratado()
    {

        $tratado = $_POST['tratado'];
        $idTemaAgenda = $_POST['idTemaAgenda'];

        $datos = compact("tratado", "idTemaAgenda");

        $respuesta = $this->model->updateTemaGeneralTratado($datos);

        echo $this->responseMessage($respuesta);
    }


    public function updateTemaGeneralNoTratado()
    {

        $noTratado = $_POST['noTratado'];
        $idTemaAgenda = $_POST['idTemaAgenda'];

        $datos = compact("noTratado", "idTemaAgenda");

        $respuesta = $this->model->updateTemaGeneralNoTratado($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateTemaGeneralComentario()
    {

        $comentario = $_POST['comentario'];
        $idTemaAgenda = $_POST['idTemaAgenda'];

        $datos = compact("comentario", "idTemaAgenda");

        $respuesta = $this->model->updateTemaGeneralComentario($datos);

        echo $this->responseMessage($respuesta);
    }


    //UPDATE PREGUNTA RESPUESTA
    public function updatePreguntaRespuesta()
    {

        $respuesta = $_POST['respuesta'];
        $idPregunta = $_POST['idPregunta'];

        $datos = compact("respuesta", "idPregunta");

        $respuesta = $this->model->updatePreguntaRespuesta($datos);

        echo $this->responseMessage($respuesta);
    }

    //UPDATE PREGUNTA PUNTAJE
    public function updatePreguntaPuntaje()
    {

        $puntaje = $_POST['puntaje'];
        $idPregunta = $_POST['idPregunta'];

        $datos = compact("puntaje", "idPregunta");

        $respuesta = $this->model->updatePreguntaPuntaje($datos);

        echo $this->responseMessage($respuesta);
    }

    
    //UPDATE PREGUNTA TIPO
    public function updatePreguntaTipo()
    {

        $idtipopregunta = $_POST['idtipopregunta'];
        $idPregunta = $_POST['idPregunta'];

        $datos = compact("idtipopregunta", "idPregunta");

        $respuesta = $this->model->updatePreguntaTipo($datos);

        echo $this->responseMessage($respuesta);
    }

    //ELIMINAR PREGUNTA
    public function eliminarPregunta()
    {

        $idPregunta = $_POST['idPregunta'];

        $datos = compact("idPregunta");

        $respuesta = $this->model->deletePregunta($datos);

        echo $this->responseMessage($respuesta);
    }

    //INSERTAMOS LA ALTERNATIVA
    public function insertTemaPropuesto()
    {

        
        $currentDate = new DateTime();

        $idActaReunion = $_POST['idActa'];
        $acuerdo = '';
        $responsable = '';
        $fechaCumplimiento = $currentDate->format('Y-m-d');
        $fechaCompromiso = $currentDate->format('Y-m-d');
        $comentario = '';

        $datos = compact("idActaReunion", "acuerdo",
         "responsable","fechaCumplimiento","fechaCompromiso","comentario");

        $idAlternativa = $this->model->insertTemaPropuesto($datos);

        echo $this->responseMessageContenido($idAlternativa);
    }

    public function updateTemaPropuestoAcuerdo()
    {

        $acuerdo = $_POST['acuerdo'];
        $idTemaPropuesto = $_POST['idTemaPropuesto'];

        $datos = compact("acuerdo", "idTemaPropuesto");

        $respuesta = $this->model->updateTemaPropuestoAcuerdo($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateTemaPropuestoResponsable()
    {

        $responsable = $_POST['responsable'];
        $idTemaPropuesto = $_POST['idTemaPropuesto'];

        $datos = compact("responsable", "idTemaPropuesto");

        $respuesta = $this->model->updateTemaPropuestoResponsable($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateTemaPropuestoFechaCompromiso()
    {

        $fechaCompromiso = $_POST['fechaCompromiso'];
        $idTemaPropuesto = $_POST['idTemaPropuesto'];

        $datos = compact("fechaCompromiso", "idTemaPropuesto");

        $respuesta = $this->model->updateTemaPropuestoFechaCompromiso($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateTemaPropuestoFechaCumplimiento()
    {

        $fechaCumplimiento = $_POST['fechaCumplimiento'];
        $idTemaPropuesto = $_POST['idTemaPropuesto'];

        $datos = compact("fechaCumplimiento", "idTemaPropuesto");

        $respuesta = $this->model->updateTemaPropuestoFechaCumplimiento($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateTemaPropuestoComentario()
    {

        $comentario = $_POST['comentario'];
        $idTemaPropuesto = $_POST['idTemaPropuesto'];

        $datos = compact("comentario", "idTemaPropuesto");

        $respuesta = $this->model->updateTemaPropuestoComentario($datos);

        echo $this->responseMessage($respuesta);
    }


    
    //ELIMINAR PREGUNTA
    public function eliminarTemaPropuesto()
    {

        $idTemapropuesto = $_POST['idTemapropuesto'];

        $respuesta = $this->model->deleteTemaPropuesto($idTemapropuesto);

        echo $this->responseMessage($respuesta);
    }



    //UPDATE ALTERNATIVA respuesta
    public function updateAlternativaRespuesta()
    {

        $idPregunta = $_POST['idPregunta'];

        $idAlternativa = $_POST['idAlternativa'];

        $respuesta = $this->model->updateAlternativaRespuesta($idPregunta,$idAlternativa);

        echo $this->responseMessage($respuesta);
    }

    

    //ELIMINAR ALTERNATIVA
    public function eliminarAlternativa()
    {

        $idAlternativa = $_POST['idAlternativa'];

        $datos = compact("idAlternativa");

        $respuesta = $this->model->deleteAlternativa($datos);

        echo $this->responseMessage($respuesta);
    }



    //LISTA EXAMEN DETALLE
    public function listaExamenDetalle()
    {
        $codigoproyecto = $_POST['codigoproyecto'];
        $idAreaEmpresa = $_POST['idAreaEmpresa'];
        
        $respuesta = $this->model->listaExamen($codigoproyecto,$idAreaEmpresa);

        echo $this->responseMessageContenido($respuesta);
    }



    //LISTA PREGUNTAS DETALLE
    public function listaPreguntaByIdActa()
    {

        $idActa = $_POST['idActa'];
        $acta = $this->model->findByIdActa($idActa);

        echo $this->responseMessageContenido($acta);
    }

    //LISTA PREGUNTAS DETALLE
    public function listaPreguntaByIdExamenRegistro()
    {

        $idExamen = $_POST['idExamen'];

        $examen = $this->model->findByIdExamen($idExamen);

        $resultado = array(
            "examen" => $examen,
            "listaArea" => ''
        );


        echo $this->responseMessageContenido($resultado);
    }

        //LISTA PREGUNTAS DETALLE
        public function listaPreguntaByIdExamenRegistroLimit()
        {
    
            $idExamen = $_POST['idExamen'];
            $examen = $this->model->findByIdExamenLimit($idExamen);

            $resultado = array(
                "examen" => $examen,
                "listaArea" => ''
            );
    
    
            echo $this->responseMessageContenido($resultado);
        }


    //ELIMINAR PREGUNTA
    public function eliminarExamen()
    {

        $idExamen = $_POST['idExamen'];

        $respuesta = $this->model->deleteExamen($idExamen);

        echo $this->responseMessage($respuesta);
    }


    //LISTA DE FIRMA FACILITADOR
    public function getListaFirmaFacilitador()
    {

        $respuesta = $this->model->getListaFirmaFacilitador();

        echo $this->responseMessageContenido($respuesta);
    }

    //UPDATE PREGUNTA RESPUESTA
    public function insertFirmaFacilitador()
    {

        $nombreFacilitador = $_POST['nombreFacilitador'];
        $urlImagen = $_POST['urlImagen'];

        $datos = compact("nombreFacilitador", "urlImagen");

        $respuesta = $this->model->insertFirmaFacilitador($datos);

        if($respuesta!=null){

            $dataFirmaFacilitador = array(
                'id' => $respuesta,
                'nombreFacilitador' => $nombreFacilitador
            );

        }

        echo $this->responseMessageContenido($dataFirmaFacilitador);
    }


    //Duplicar formulario
    public function duplicarFormulario()
    {

        $idExamen = $_POST['idExamen'];

        //Traemos todo el examen y sus preguntas
        $respuesta = $this->model->findByIdExamen($idExamen);


        //Insertamos el examen 
        $respuestaExamen = $this->insertExamenDuplicado($respuesta);

        if( $respuestaExamen != 0){
            
            $this->insertPreguntaDuplicada($respuestaExamen,$respuesta);

        }

        echo $this->responseMessageContenido($respuestaExamen);
    }


    public function insertExamenDuplicado($examen){

        $currentDate = new DateTime();

           
        $idProyecto = $examen->idProyecto;
        $fase = $examen->fase;
        $facilitador = $examen->facilitador;
        $cliente = $examen->cliente;
        $fecha =  $currentDate->format('Y-m-d');
        $duracion = $examen->duracion;
        $idTipo = $examen->idTipo;
        $tema = $examen->tema.'- Copia('.$currentDate->getTimestamp().')';
        $horaInicio = $examen->horaInicio;
        $horaFin =  $examen->horaFin;
        $duracionProgramada = $examen->duracionProgramada;
        $duracionEfectiva = $examen->duracionEfectiva;
        $idCurso = $examen->idCurso;
        $idAreaCapacitacion = $examen->idAreaCapacitacion;
        $detalle = $examen->detalle;
        $nota = $examen->nota;
        $estado = $examen->estado;
        $idFirmaFacilitador = $examen->idFirmaFacilitador;
        $observacion = $examen->observacion;
        $finalizo = $examen->finalizo;
        $continuara = $examen->continuara;
        $fechaContinuacion = $examen->fechaContinuacion;
        $temarioA = $examen->temarioA;
        $temarioB = $examen->temarioB;
        $idareaempresa = $examen->idareaempresa;

        // INSERT EXAMEN
        $datos = compact(
            "idProyecto",
            "fase",
            "facilitador",
            "cliente",
            "fecha",
            "duracion",
            "idTipo",
            "tema",
            "horaInicio",
            "horaFin",
            "duracionProgramada",
            "duracionEfectiva",
            "idCurso",
            "idAreaCapacitacion",
            "detalle",
            "nota",
            "estado",
            "idFirmaFacilitador",
            "observacion",
            "finalizo",
            "continuara",
            "fechaContinuacion",
            "temarioA",
            "temarioB",
            "idareaempresa"
        );

        return $this->model->insertExamen($datos);

    }


    public function insertPreguntaDuplicada($idExamenDuplicado,$examen)
    {

        foreach($examen->listaPreguntas as $pregunta) {

            $nombre = $pregunta->nombre;
            $respuesta = $pregunta->respuesta;
            $puntaje = $pregunta->puntaje;
            $idExamen = $idExamenDuplicado;
            $idtipopregunta = $pregunta->idtipopregunta;
            //By default es 1 : obligatorio
            $obligatorio = 1;

            $datos = compact("nombre", "respuesta", "puntaje", "idExamen", "idtipopregunta", "obligatorio");

            $idPregunta = $this->model->insertPregunta($datos);

            $this->model->insertAlternativaBulk($idPregunta, $pregunta->alternativa);
        }
    } 

    public function insertSubPregunta(){

        

        $nombre = 'Fila';
        $idPregunta = $_POST['idPregunta'];
        $puntaje = 0;

        $datos = compact("nombre", "idPregunta", "puntaje");

        $idSubPregunta = $this->model->insertSubPregunta($datos);


        $nombre = 'Columna';
        $respuesta = 0;
    
        $datos1 = compact("nombre", "idSubPregunta", "respuesta");
        $datos2 = compact("nombre", "idSubPregunta", "respuesta");


        $idSubAlternativa1 = $this->model->insertSubAlternativa($datos1);
        $idSubAlternativa2 = $this->model->insertSubAlternativa($datos2);

        $respuestaJson = array(
                                "fila" => $idSubPregunta ,
                                "columna" => array("uno" => $idSubAlternativa1 ,"dos" =>$idSubAlternativa2)
        );

        echo $this->responseMessageContenido($respuestaJson);

    }

    public function updateSubPreguntaNombre()
    {

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $datos = compact("id", "nombre");
        $respuesta = $this->model->updateSubPreguntaNombre($datos);

        echo $this->responseMessage($respuesta);
    }

    public function updateSubAlternativaPreguntaNombre()
    {

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $datos = compact("id", "nombre");
        $respuesta = $this->model->updateSubAlternativaPreguntaNombre($datos);

        echo $this->responseMessage($respuesta);
    }

    public function insertSubPreguntaFila(){

        $nombre = 'Fila';
        $idPregunta = $_POST['idPregunta'];
        $puntaje = 0;

        $datos = compact("nombre", "idPregunta", "puntaje");
        $idSubPregunta = $this->model->insertSubPregunta($datos);

        
        foreach ($_POST['listaAlternativa'] as $valor){
    
            $nombre = 'Columna';
            $respuesta = 0;
            $dato = compact("nombre", "idSubPregunta", "respuesta");
            $this->model->insertSubAlternativa($dato);
    
        }

        echo $this->responseMessageContenido($idSubPregunta);


    }


    public function insertSubPreguntaColumna(){

        
        foreach ($_POST['listaAlternativa'] as $valor){
    
            $idSubPregunta = $valor;
            $nombre = 'Columna';
            $respuesta = 0;
            $dato = compact("nombre", "idSubPregunta", "respuesta");
            $this->model->insertSubAlternativa($dato);
    
        }

        echo $this->responseMessageContenido($idSubPregunta);


    }

    
    public function insertExamenPuesto(){

        $id_examen = $_POST['id_examen'];
        $id_puesto_trabajo = $_POST['id_puesto_trabajo'];

        $datos = compact("id_examen", "id_puesto_trabajo");

        $resultado = $this->model->insertExamenPuesto($datos);
        echo $this->responseMessage($resultado);


    }

    
    public function getListExamenPuesto(){

        $id_examen = $_POST['id_examen'];

        $resultado = $this->model->getListExamenPuesto($id_examen);
        echo $this->responseMessageContenido($resultado);


    }


    public function getListPuesto(){

        $resultado = $this->model->getListPuesto();
        echo $this->responseMessageContenido($resultado);


    }

    
    public function deleteExamenPuesto()
    {

        $id_examen = $_POST['id_examen'];
        $id_puesto_trabajo = $_POST['id_puesto_trabajo'];

        $datos = compact("id_examen", "id_puesto_trabajo");

        $respuesta = $this->model->deleteExamenPuesto($datos);

        echo $this->responseMessage($respuesta);
    }


    
    public function generatePDFByIdActa()
    {

        $idActa = $_POST['idActa'];
        
        $actaDetalle = $this->model->findByIdActa($idActa);

        $urlPDF=$this->generatePdf($actaDetalle);

        echo $this->responseMessageContenido($urlPDF);

    }

    
    public function generatePdf($evaluacion){


        $pdf=new GeneratePDF();
        $urlPDF =  $pdf->generateActaReuniondf($evaluacion);

        return $urlPDF;
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
