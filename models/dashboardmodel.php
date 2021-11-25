<?php

require_once 'models/examenDetalle.php';
require_once 'models/pregunta.php';
require_once 'models/alternativa.php';
require_once 'models/examen.php';
require_once 'models/actaDetalle.php';

class DashboardModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }




    public function listaActasReuniones($dniTrabajador)
    {
        try {
            $listaActaReuniones = array();

            $query = $this->db->connect()->query("SELECT 
            acta_reunion.id,
            acta_reunion.motivo,
            acta_reunion.fecha
            FROM 
            acta_reunion ORDER BY acta_reunion.registro DESC ");

            while($row = $query->fetch()){
                $actaDetalle =  new ActaDetalle;
                $actaDetalle->id = $row['id'];
                $actaDetalle->motivo = $row['motivo'];
                $actaDetalle->fecha = $row['fecha'];
                array_push($listaActaReuniones,$actaDetalle);
                
            }

            return $listaActaReuniones;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


}
