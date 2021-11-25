<?php
    class MainModel extends Model {
        public function __construct()
        {
            parent::__construct();
        }



        public function getTrabajadorByDni($dni){


            $items =[];


            try{ 
                 
                 $query = $this->db->connectrrhh()->prepare(" SELECT
                                                            
                                                                dni,
                                                                apellidos,
                                                                nombres,
                                                                ccargo,
                                                                dcargo,
                                                                ccostos,
                                                                dcostos
                                                        FROM 
                                                                tabla_aquarius 
                                                        WHERE 
                                                        DNI = :dni ");
                  $query->execute(['dni'  => $dni]);

                while($row = $query->fetch()){
                    $items = $row;
                }

                return $items;
                
             }catch(PDOException $e){
                echo $e->getMessage();
                return false;
             }
        }





    }
?>