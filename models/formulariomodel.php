<?php

require_once 'models/examenDetalle.php';
require_once 'models/pregunta.php';
require_once 'models/alternativa.php';
require_once 'models/examen.php';
require_once 'models/firmaFacilitador.php';
require_once 'models/acta.php';
require_once 'models/temaGeneral.php';
require_once 'models/temaPropuesto.php';

class FormularioModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertActa($examen)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('INSERT INTO  acta_reunion 
            (motivo,
            numero_reunion,
            tiempo_programado,
            nombre_proyecto,
            lugar,
            tiempo_real_duracion,
            cliente,
            fecha,
            observaciones)
            VALUES 
            (:motivo,:numero_reunion,:tiempo_programado,:nombre_proyecto,:lugar,:tiempo_real_duracion,:cliente,:fecha,:observaciones)');



            $query->execute([
                'motivo' => $examen['motivo'],
                'numero_reunion' => $examen['numero_reunion'],
                'tiempo_programado' => $examen['tiempo_programado'],
                'nombre_proyecto' => $examen['nombre_proyecto'],
                'lugar' => $examen['lugar'],
                'tiempo_real_duracion' => $examen['tiempo_real_duracion'],
                'cliente' => $examen['cliente'],
                'fecha' => $examen['fecha'],
                'observaciones' => $examen['observaciones']

            ]);

            //EXTRAEMOS EL ID DEL INSERT QUE REALZIAMOS
            // comentario 69 https://www.php.net/manual/en/pdo.lastinsertid.php

            $last_insert_id = $conexion_bbdd->lastInsertId();

            return $last_insert_id;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateActaMotivo($acta)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE acta_reunion SET motivo = :motivo
                                                        WHERE id = :id');

            $query->execute([
                'id' => $acta['id'],
                'motivo' => $acta['motivo']
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function updateActaNumeroReunion($acta)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE acta_reunion SET numero_reunion =:numero_reunion
                                                        WHERE id = :id');

            $query->execute([
                'id' => $acta['id'],
                'numero_reunion' => $acta['numero_reunion']
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function updateActaTiempoProgramado($acta)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE acta_reunion SET tiempo_programado =:tiempo_programado
                                                        WHERE id = :id');

            $query->execute([
                'id' => $acta['id'],
                'tiempo_programado' => $acta['tiempo_programado']
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateActaNombreProyecto($acta)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE acta_reunion SET nombre_proyecto =:nombre_proyecto
                                                        WHERE id = :id');

            $query->execute([
                'id' => $acta['id'],
                'nombre_proyecto' => $acta['nombre_proyecto']
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateActaLugar($acta)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE acta_reunion SET lugar =:lugar
                                                        WHERE id = :id');

            $query->execute([
                'id' => $acta['id'],
                'lugar' => $acta['lugar']
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateActaTiempoRealDuracion($acta)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE acta_reunion SET tiempo_real_duracion =:tiempo_real_duracion
                                                        WHERE id = :id');

            $query->execute([
                'id' => $acta['id'],
                'tiempo_real_duracion' => $acta['tiempo_real_duracion']
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateActaCliente($acta)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE acta_reunion SET cliente =:cliente
                                                        WHERE id = :id');

            $query->execute([
                'id' => $acta['id'],
                'cliente' => $acta['cliente']
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    
    public function updateActaFecha($acta)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE acta_reunion SET fecha =:fecha
                                                        WHERE id = :id');

            $query->execute([
                'id' => $acta['id'],
                'fecha' => $acta['fecha']
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function updateActaObservaciones($acta)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE acta_reunion SET observaciones =:observaciones
                                                        WHERE id = :id');

            $query->execute([
                'id' => $acta['id'],
                'observaciones' => $acta['observaciones']
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function findByIdActa($idActa)
    {
        try {
            $acta = new Acta();


            $query = $this->db->connect()->query("SELECT 
            id,
            motivo,
            numero_reunion,
            tiempo_programado,
            nombre_proyecto,
            lugar,
            tiempo_real_duracion,
            cliente,
            fecha,
            observaciones
            FROM 
            acta_reunion  WHERE id = '$idActa' ");

            while($row = $query->fetch()){
                $acta->id=$row['id'];
                $acta->motivo = $row['motivo'];
                $acta->numeroReunion = $row['numero_reunion'];
                $acta->tiempoProgramado = $row['tiempo_programado'];
                $acta->nombreProyecto = $row['nombre_proyecto'];
                $acta->lugar = $row['lugar'];
                $acta->tiempoRealDuracion = $row['tiempo_real_duracion'];
                $acta->cliente = $row['cliente'];
                $acta->fecha = $row['fecha'];
                $acta->observaciones = $row['observaciones'];
                $acta->listaTemaGeneral = $this->getListTemaGeneral($row['id']);
                $acta->listaTemaPropuesto = $this->getListTemaPropuesto($row['id']);
            }

            return $acta;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }



    public function insertTemaGeneral($temaGeneral)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('INSERT INTO tema_general (
                id_acta_reunion,
                tema_agenda,
                duracion,
                responsable,
                tratado,
                no_tratado,
                comentario
                )
            VALUES (
                :id_acta_reunion,
                :tema_agenda,
                :duracion,
                :responsable,
                :tratado,
                :no_tratado,
                :comentario
            )');

            $query->execute([
                'id_acta_reunion' => $temaGeneral['id_acta_reunion'],
                'tema_agenda' => $temaGeneral['tema_agenda'],
                'duracion' => $temaGeneral['duracion'],
                'responsable' => $temaGeneral['responsable'],
                'tratado' => $temaGeneral['tratado'],
                'no_tratado' => $temaGeneral['no_tratado'],
                'comentario' => $temaGeneral['comentario']

            ]);

            //EXTRAEMOS EL ID DEL INSERT QUE REALZIAMOS
            // comentario 69 https://www.php.net/manual/en/pdo.lastinsertid.php

            $last_insert_id = $conexion_bbdd->lastInsertId();

            return $last_insert_id;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function  updateTemaGeneralTemaAgenda($temaGeneral){

        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE tema_general SET tema_agenda = :tema_agenda
                                                                WHERE id = :id');

            $query->execute([
                'tema_agenda' => $temaGeneral['temaAgenda'],
                'id' => $temaGeneral['idTemaAgenda']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function  updateTemaGeneralDuracion($temaGeneral){

        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE tema_general SET duracion =:duracion
                                                                WHERE id = :id');

            $query->execute([
                'duracion' => $temaGeneral['duracion'],
                'id' => $temaGeneral['idTemaAgenda']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function  updateTemaGeneralResponsable($temaGeneral){

        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE tema_general SET responsable =:responsable
                                                                WHERE id = :id');

            $query->execute([
                'responsable' => $temaGeneral['responsable'],
                'id' => $temaGeneral['idTemaAgenda']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function  updateTemaGeneralTratado($temaGeneral){

        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE tema_general SET tratado =:tratado
                                                                WHERE id = :id');

            $query->execute([
                'tratado' => $temaGeneral['tratado'],
                'id' => $temaGeneral['idTemaAgenda']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function  updateTemaGeneralNoTratado($temaGeneral){

        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE tema_general SET no_tratado =:no_tratado
                                                                WHERE id = :id');

            $query->execute([
                'no_tratado' => $temaGeneral['noTratado'],
                'id' => $temaGeneral['idTemaAgenda']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }



    

    public function  updateTemaGeneralComentario($temaGeneral){

        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE tema_general SET comentario =:comentario
                                                                WHERE id = :id');

            $query->execute([
                'comentario' => $temaGeneral['comentario'],
                'id' => $temaGeneral['idTemaAgenda']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }



    public function deletePregunta($pregunta)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('DELETE FROM  tema_general WHERE id = :id');

            $query->execute([
                'id' => $pregunta['idPregunta']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function getListTemaGeneral($idActa)
    {
        
        $listTemaGeneral = array();

        try {

            $query = $this->db->connect()->prepare("SELECT 
            id,
            id_acta_reunion,
            tema_agenda,
            duracion,
            responsable,
            tratado,
            no_tratado,
            comentario
            FROM tema_general WHERE id_acta_reunion = $idActa");

            $query->execute();
            
            while($row = $query->fetch()){
                $temaGeneral = new TemaGeneral;

                $temaGeneral->id = $row['id'];
                $temaGeneral->idActaReunion = $row['id_acta_reunion'];
                $temaGeneral->temaAgenda = $row['tema_agenda'];
                $temaGeneral->duracion = $row['duracion'];
                $temaGeneral->responsable = $row['responsable'];
                $temaGeneral->tratado = $row['tratado'];
                $temaGeneral->noTratado = $row['no_tratado'];
                $temaGeneral->comentario = $row['comentario'];
 
                array_push($listTemaGeneral ,$temaGeneral);
            }


            return $listTemaGeneral;

        } catch (PDOexception $e) {
            echo $e->getMessage();
            return false;
        }
    }




    public function insertTemaPropuesto($temaPropuesto)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('INSERT INTO tema_propuesto
            (
                id_acta_reunion,
                acuerdo,
                responsable,
                fecha_compromiso,
                fecha_cumplimiento,
                comentario
            )
            VALUES (
                :id_acta_reunion,
                :acuerdo,
                :responsable,
                :fecha_compromiso,
                :fecha_cumplimiento,
                :comentario

            )');

            $query->execute([
                'id_acta_reunion' => $temaPropuesto['idActaReunion'],
                'acuerdo' => $temaPropuesto['acuerdo'],
                'responsable' => $temaPropuesto['responsable'],
                'fecha_cumplimiento' => $temaPropuesto['fechaCumplimiento'],
                'fecha_compromiso' => $temaPropuesto['fechaCompromiso'],
                'comentario' => $temaPropuesto['comentario']

            ]);



            $last_insert_id = $conexion_bbdd->lastInsertId();

            return $last_insert_id;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateTemaPropuestoAcuerdo($temaPropuesto)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE tema_propuesto SET acuerdo =:acuerdo
                                                                WHERE id = :id');

            $query->execute([
                'acuerdo' => $temaPropuesto['acuerdo'],
                'id' => $temaPropuesto['idTemaPropuesto']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateTemaPropuestoResponsable($temaPropuesto)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE tema_propuesto SET responsable =:responsable
                                                                WHERE id = :id');

            $query->execute([
                'responsable' => $temaPropuesto['responsable'],
                'id' => $temaPropuesto['idTemaPropuesto']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function updateTemaPropuestoFechaCompromiso($temaPropuesto)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE tema_propuesto SET fecha_compromiso =:fecha_compromiso
                                                                WHERE id = :id');

            $query->execute([
                'fecha_compromiso' => $temaPropuesto['fechaCompromiso'],
                'id' => $temaPropuesto['idTemaPropuesto']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateTemaPropuestoFechaCumplimiento($temaPropuesto)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE tema_propuesto SET fecha_cumplimiento =:fecha_cumplimiento
                                                                WHERE id = :id');

            $query->execute([
                'fecha_cumplimiento' => $temaPropuesto['fechaCumplimiento'],
                'id' => $temaPropuesto['idTemaPropuesto']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateTemaPropuestoComentario($temaPropuesto)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE tema_propuesto SET comentario =:comentario
                                                                WHERE id = :id');

            $query->execute([
                'comentario' => $temaPropuesto['comentario'],
                'id' => $temaPropuesto['idTemaPropuesto']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function getListTemaPropuesto($idActa)
    {
        
        $listTemaPropuesto = array();

        try {

            $query = $this->db->connect()->prepare("SELECT
            id,
            id_acta_reunion,
            acuerdo,
            responsable,
            fecha_compromiso,
            fecha_cumplimiento,
            comentario
            FROM tema_propuesto WHERE id_acta_reunion = $idActa");

            $query->execute();
            
            while($row = $query->fetch()){
                $temaPropuesto = new TemaPropuesto;

                $temaPropuesto->id = $row['id'];
                $temaPropuesto->idActaReunion = $row['id_acta_reunion'];
                $temaPropuesto->acuerdo = $row['acuerdo'];
                $temaPropuesto->responsable = $row['responsable'];
                $temaPropuesto->fechaCompromiso = $row['fecha_compromiso'];
                $temaPropuesto->fechaCumplimiento = $row['fecha_cumplimiento'];
                $temaPropuesto->comentario = $row['comentario'];
 
                array_push($listTemaPropuesto,$temaPropuesto);
            }


            return $listTemaPropuesto;

        } catch (PDOexception $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function deleteTemaPropuesto($idTemapropuesto)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('DELETE FROM  tema_propuesto WHERE id = :id');

            $query->execute([
                'id' => $idTemapropuesto
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    
    public function updateAlternativaRespuesta($idPregunta,$idAlternativa)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE alternativa SET respuesta = 0 WHERE idPregunta = :idPregunta');
            $query->execute(['idPregunta' => $idPregunta]);

            $query = $conexion_bbdd->prepare('UPDATE alternativa SET respuesta = 1
                                                                WHERE id = :id');

            $query->execute([
                'id' => $idAlternativa
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function deleteAlternativa($alternativa)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('DELETE FROM  alternativa WHERE id = :id');

            $query->execute([
                'id' => $alternativa['idAlternativa']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function listaExamen($codigo,$idAreaEmpresa)
    {
        try {
            $listaExamenDetalle=array();

            $query = $this->db->connect()->query("SELECT 
            DISTINCT(tipo) AS tipo, 
            id,
            tema,
            fecha
            
            FROM 
            examenAdministrador WHERE estado = 1 AND idproyecto = '$codigo' AND idareaempresa = '$idAreaEmpresa' ORDER BY registro DESC");
 
            while($row = $query->fetch()){
                $modelExamenDetalle=new ExamenDetalle;
                $modelExamenDetalle->id=$row['id'];
                $modelExamenDetalle->tema=$row['tema'];
                $modelExamenDetalle->fecha=$row['fecha'];
                $modelExamenDetalle->tipo=$row['tipo'];
                array_push($listaExamenDetalle,$modelExamenDetalle);
                
            }

            return $listaExamenDetalle;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function listaExamenAscendiente()
    {
        try {
            $listaExamenDetalle=array();


            $query = $this->db->connect()->query('SELECT 
            id,
            tema,
            fecha,
            tipo
            
            FROM 
            examenDetalle WHERE estado = 1 AND  CAST(now() as DATE) = CAST(fecha AS DATE) ORDER BY registro ASC');

            while($row = $query->fetch()){
                $modelExamenDetalle=new ExamenDetalle;
                $modelExamenDetalle->id=$row['id'];
                $modelExamenDetalle->tema=$row['tema'];
                $modelExamenDetalle->fecha=$row['fecha'];
                $modelExamenDetalle->tipo=$row['tipo'];
                array_push($listaExamenDetalle,$modelExamenDetalle);
                
            }

            return $listaExamenDetalle;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function listaPreguntas($idExamen)
    {
        try {
            $listaPreguntas=array();

            $query = $this->db->connect()->prepare("SELECT id,nombre,respuesta,puntaje,idtipopregunta
            FROM pregunta
            WHERE IDEXAMEN = :idexamen ");

            $query->execute(['idexamen'  => $idExamen]);

            while($row = $query->fetch()){
                $pregunta = new Pregunta;
                $pregunta->id=$row['id'];
                $pregunta->nombre = $row['nombre'];
                $pregunta->respuesta   = $row['respuesta'];
                $pregunta->puntaje    = $row['puntaje'];
                $pregunta->idtipopregunta = $row['idtipopregunta'];
                $pregunta->alternativa = $this->listaAlternativas($row['id']);

                array_push($listaPreguntas,$pregunta);

            }
            return $listaPreguntas;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function listaPreguntasLimit($idExamen,$aleatorio,$cantidadPregunta)
    {
        try {
            $listaPreguntas=array();


            if($aleatorio == 1){

                $query = $this->db->connect()->prepare("SELECT id,nombre,respuesta,puntaje,idtipopregunta
                FROM pregunta
                WHERE IDEXAMEN = :idexamen ORDER BY RAND() LIMIT $cantidadPregunta ");
            }else{

                $query = $this->db->connect()->prepare("SELECT id,nombre,respuesta,puntaje,idtipopregunta
                FROM pregunta
                WHERE IDEXAMEN = :idexamen LIMIT $cantidadPregunta  ");
            }





            $query->execute(['idexamen'  => $idExamen]);

            while($row = $query->fetch()){
                $pregunta = new Pregunta;
                $pregunta->id=$row['id'];
                $pregunta->nombre = $row['nombre'];
                $pregunta->respuesta   = $row['respuesta'];
                $pregunta->puntaje    = $row['puntaje'];
                $pregunta->idtipopregunta = $row['idtipopregunta'];
                $pregunta->alternativa = $this->listaAlternativas($row['id']);

                array_push($listaPreguntas,$pregunta);

            }
            return $listaPreguntas;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function listaAlternativas($idPregunta)
    {
        try {
            $listaAlternativa=array();

            $query = $this->db->connect()->prepare('SELECT id,nombre,respuesta
            FROM alternativa
            WHERE IDPREGUNTA = :idpregunta');


            $query->execute(['idpregunta'  => $idPregunta]);

            while($row = $query->fetch()){
                $alternativa = new Alternativa;
                $alternativa->id=$row['id'];
                $alternativa->nombre = $row['nombre'];
                $alternativa->respuesta = $row['respuesta'];
                array_push($listaAlternativa,$alternativa);

            }
            return $listaAlternativa;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    /**
     * 
     * 
     */

    public function listaPreguntasPrueba($idExamen)
    {
        try {
            $listaPreguntas=array();

            $query = $this->db->connect()->prepare('SELECT pregunta.id ,pregunta.nombre 
            FROM examen INNER JOIN pregunta ON examen.id = pregunta.idExamen						
            WHERE examen.id = :idExamenIn ');


            $query->execute(['idExamenIn'  => $idExamen]);

            while($row = $query->fetch()){
                $pregunta = new Pregunta;
                $pregunta->id=$row['id'];
                $pregunta->nombre = $row['nombre'];

                array_push($listaPreguntas,$pregunta);

            }
            return  $listaPreguntas;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function listaAlternativasPrueba($idExamen)
    {
        try {
            $listaAlternativa=array();

            $query = $this->db->connect()->prepare('SELECT alternativa.id,alternativa.nombre 
            FROM examen INNER JOIN pregunta ON examen.id = pregunta.idExamen
                        INNER JOIN alternativa ON pregunta.id = alternativa.idPregunta                    
            WHERE examen.id = :idExamenIn ');


            $query->execute(['idExamenIn'  => $idExamen]);

            while($row = $query->fetch()){
                $alternativa = new Alternativa;
                $alternativa->id=$row['id'];
                $alternativa->nombre = $row['nombre'];
                array_push($listaAlternativa,$alternativa);

            }
            return $listaAlternativa;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }



     /***
      * 

      */

    public function deleteExamen($idExamen)
    {
        try {

            $query = $this->db->connect()->prepare("UPDATE examen SET estado = 0  WHERE id =:idExamen");
            $query->execute(['idExamen'  => $idExamen]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }



    public function getListaFirmaFacilitador()
    {

        $listaFirmaFacilitador = array();

        try {

            $query = $this->db->connect()->prepare("SELECT id,nombre,urlImagen FROM firmaFacilitador");
            $query->execute();
            
            while($row = $query->fetch()){
                $firmaFacilitador = new FirmaFacilitador;
                $firmaFacilitador->id= $row['id'];
                $firmaFacilitador->nombre= $row['nombre'];
                $firmaFacilitador->urlImagen= $row['urlImagen'];

                array_push($listaFirmaFacilitador,$firmaFacilitador);
            }


            return $listaFirmaFacilitador;

        } catch (PDOexception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function insertFirmaFacilitador($data)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('INSERT INTO firmaFacilitador (nombre,urlImagen)
                                                        VALUE (:nombre,:urlImagen)');

            $query->execute([
                'nombre' => $data['nombreFacilitador'],
                'urlImagen' => $data['urlImagen']
            ]);

            $last_insert_id = $conexion_bbdd->lastInsertId();

            return $last_insert_id;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }


    public function insertAlternativaBulk($idPregunta,$listaAlternativas)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('INSERT INTO alternativa (nombre,idPregunta,respuesta)
            VALUES (:nombre,:idPregunta,:respuesta)');


            foreach($listaAlternativas as $alternativa) {

                $query->bindParam(':nombre', $alternativa->nombre, PDO::PARAM_STR);
                $query->bindParam(':idPregunta',$idPregunta, PDO::PARAM_INT);
                $query->bindParam(':respuesta',$alternativa->respuesta, PDO::PARAM_INT);
                $query->execute();
            
            }


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function insertSubPregunta($subPregunta)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('INSERT INTO subpregunta (nombre,idPregunta,puntaje)
                                                        VALUES (:nombre,:idPregunta,:puntaje)');

            $query->execute([
                'nombre' => $subPregunta['nombre'],
                'idPregunta' => $subPregunta['idPregunta'],
                'puntaje' => $subPregunta['puntaje']

            ]);

            //EXTRAEMOS EL ID DEL INSERT QUE REALZIAMOS
            // comentario 69 https://www.php.net/manual/en/pdo.lastinsertid.php

            $last_insert_id = $conexion_bbdd->lastInsertId();

            return $last_insert_id;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function insertSubAlternativa($subAlternativa)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('INSERT INTO subpregunta_alternativa (nombre,idSubPregunta,respuesta)
                                                        VALUES (:nombre,:idSubPregunta,:respuesta)');

            $query->execute([
                'nombre' => $subAlternativa['nombre'],
                'idSubPregunta' => $subAlternativa['idSubPregunta'],
                'respuesta' => $subAlternativa['respuesta']

            ]);

            //EXTRAEMOS EL ID DEL INSERT QUE REALZIAMOS
            // comentario 69 https://www.php.net/manual/en/pdo.lastinsertid.php

            $last_insert_id = $conexion_bbdd->lastInsertId();

            return $last_insert_id;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function updateSubPreguntaNombre($subPregunta)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE subpregunta SET nombre = :nombre
                                                        WHERE id = :id');

            $query->execute([
                'id' => $subPregunta['id'],
                'nombre' => $subPregunta['nombre']
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateSubAlternativaPreguntaNombre($subAlternativaPregunta)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('UPDATE subpregunta_alternativa SET nombre = :nombre
                                                        WHERE id = :id');

            $query->execute([
                'id' => $subAlternativaPregunta['id'],
                'nombre' => $subAlternativaPregunta['nombre']
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    
    public function insertExamenPuesto($datos)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('INSERT INTO examen_puesto_trabajo (id_examen,id_puesto_trabajo)
                                                        VALUES (:id_examen,:id_puesto_trabajo)');

            $query->execute([
                'id_examen' => $datos['id_examen'],
                'id_puesto_trabajo' => $datos['id_puesto_trabajo']
            ]);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getListExamenPuesto($idExamen)
    {

        $listExamenPuestoTrabajo = array();

        try {

            $query = $this->db->connect()->prepare("SELECT 
            puesto_trabajo.id AS id_puesto_trabajo,puesto_trabajo.nombre 
            FROM examen_puesto_trabajo INNER JOIN puesto_trabajo ON  examen_puesto_trabajo.id_puesto_trabajo = puesto_trabajo.id
            WHERE examen_puesto_trabajo.id_examen = $idExamen
            ");

            $query->execute();
            
            while($row = $query->fetch()){

                $examenPuestoTrabajo = array(
                    "id_puesto_trabajo" => $row['id_puesto_trabajo'],
                    "nombre" => $row['nombre']
                );

                array_push($listExamenPuestoTrabajo,$examenPuestoTrabajo);
            }


            return $listExamenPuestoTrabajo;

        } catch (PDOexception $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function getListPuesto()
    {

        $listExamenPuestoTrabajo = array();

        try {

            $query = $this->db->connect()->prepare("SELECT id,nombre FROM puesto_trabajo 
            ");

            $query->execute();
            
            while($row = $query->fetch()){

                $examenPuestoTrabajo = array(
                    "id" => $row['id'],
                    "nombre" => $row['nombre']
                );

                array_push($listExamenPuestoTrabajo,$examenPuestoTrabajo);
            }


            return $listExamenPuestoTrabajo;

        } catch (PDOexception $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function deleteExamenPuesto($datos)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('DELETE FROM  form.examen_puesto_trabajo 
            WHERE id_examen = :id_examen AND id_puesto_trabajo = :id_puesto_trabajo');

            $query->execute([
                'id_examen' => $datos['id_examen'],
                'id_puesto_trabajo' => $datos['id_puesto_trabajo']
            ]);


            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    // Lista de Actas de reuniones

    public function getListActaReuniones()
    {
        

        $listActa = array();

        try {

            $query = $this->db->connect()->prepare("SELECT 
            id,motivo,
            numero_reunion,
            tiempo_programado,
            nombre_proyecto,
            lugar,
            tiempo_real_duracion,
            cliente,
            fecha,
            observaciones
            FROM acta_reunion ORDER BY registro DESC");

            $query->execute();
            
            while($row = $query->fetch()){
                $acta = new Acta;

                $acta->id=$row['id'];
                $acta->motivo = $row['motivo'];
                $acta->numeroReunion = $row['numero_reunion'];
                $acta->tiempoProgramado = $row['tiempo_programado'];
                $acta->nombreProyecto = $row['nombre_proyecto'];
                $acta->lugar = $row['lugar'];
                $acta->tiempoRealDuracion = $row['tiempo_real_duracion'];
                $acta->cliente = $row['cliente'];
                $acta->fecha = $row['fecha'];
                $acta->observaciones = $row['observaciones'];

                array_push($listActa,$acta);
            }


            return $listActa;

        } catch (PDOexception $e) {
            echo $e->getMessage();
            return false;
        }
    }

}
