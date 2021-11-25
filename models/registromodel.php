<?php

require_once 'models/curso.php';

class RegistroModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

 
    public function insertResgistro($registro)
    {
        try {

            $conexion_bbdd = $this->db->connect();

            $query = $conexion_bbdd->prepare('INSERT INTO  
            participante (id_acta_reunion,asistente,sigla,cargo,dni,firma)
            VALUES  (:id_acta_reunion,:asistente,:sigla,:cargo,:dni,:firma)');

            $query->execute([
                'id_acta_reunion' => $registro['idActaReunion'],
                'dni' => $registro['dni'],
                'asistente' => $registro['nombreApellido'],
                'sigla' => $registro['sigla'],
                'cargo' => $registro['cargo'],
                'firma' => $registro['firma']
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




    
}
