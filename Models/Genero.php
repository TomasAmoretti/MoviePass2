<?php 
namespace Models;

class Genero{

    private $descripcion; //string

    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
}

?>