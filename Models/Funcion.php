<?php
namespace Models;

class Funcion{

    private $dia; //date
    private $hora; //string

    public function __construct($dia, $hora){
        $this->dia = $dia,
        $this->hora = $hora;
    }

    public function getDia(){
        return $this->dia;
    }
    public function getHora(){
        return $this->hora;
    }

    public function setDia($dia){
        $this->dia = $dia;
    }
    public function setHora($hora){
        $this->hora = $hora;
    }
}

?>