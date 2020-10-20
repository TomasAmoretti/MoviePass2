<?php
namespace Models;

class PagoTC{
    
    private $cod_aut; //int
    private $fecha;   //date
    private $total;   //int

    public function __construct($cod_aut, $fecha, $total){
        $this->cod_aut = $cod_aut;
        $this->fecha = $fecha;
        $this->total = $total;
    }

    public function getCodAut(){
        return $this->cod_aut;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getTolal(){
        return $this->total;
    }

    public function setCodAut($cod_aut){
        $this->cod_aut = $cod_aut;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function setTotal($total){
        $this->total = $total;
    }
}


?>