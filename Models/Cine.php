<?php 
namespace Models;


class Cine{

    private $capacidad; //int
    private $direccion; //string
    private $nombre; //string
    private $valor_entrada; //int

    public function getCapacidad(){
        return $this->capacidad;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getValorEntrada(){
        return $this->valor_entrada;
    }

    public function setCapacidad($capacidad){
        $this->capacidad = $capacidad;
    }
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setValorEntrada($valor_entrada){
        $this->valor_entrada = $valor_entrada;
    }
}


?>