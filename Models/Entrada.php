<?php
namespace Models;

class Entrada{
    
    private $nro_entrada; //int
    private $qr; //byte
    
    public function __construct($nro_entrada, $qr){
        $this->nro_entrada = $nro_entrada;
        $this->qr = $qr;
    }

    public function getNroEntrada(){
        return $this->nro_entrada;
    }
    public function getQR(){
        return $this->qr;
    }

    public function setNroEntrada($nro_entrada){
        $this->nro_entrada = $nro_entrada;
    }
    public function setQR($qr){
        $this->qr = $qr;
    }
}


?>