<?php

require_once 'models/proyecto.php';
require_once 'models/area.php';

class InicioModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

 

    public function listaProyecto()
    {
        try {
            $listaProyecto=array();


            $query = $this->db->connect()->query("SELECT id,nombre,codigo FROM proyecto WHERE id <> 100");

            while($row = $query->fetch()){
                $proyecto = new Proyecto;
                $proyecto->id=$row['id'];
                $proyecto->nombre=$row['nombre'];
                $proyecto->codigo=$row['codigo'];
                array_push($listaProyecto,$proyecto);
                
            }

            return $listaProyecto;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }



    
    public function listaAreaByIdProyecto($idProyecto)
    {
        try {

            $listaArea = array();


            $query = $this->db->connect()->query("SELECT id,nombre,idproyecto FROM area WHERE idproyecto = '$idProyecto' ");

            while($row = $query->fetch()){
                
                $area = new Area;
                $area->id=$row['id'];
                $area->nombre=$row['nombre'];
                $area->idproyecto=$row['idproyecto'];
                array_push($listaArea,$area);
                
            }
            
            return $listaArea;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    
}
