<?php
namespace Models;

class Compra{

    private $cant_entradas; //int
    private $descuento; //int
    private $fecha; //date
    private $total; //int

    public function __construct($cant_entradas, $descuento, $fecha, $total){
        $this->cant_entradas = $cant_entradas;
        $this->descuento = $descuento;
        $this->fecha = $fecha;
        $this->total = $total;
    }

    public function getCantEntradas(){
        return $this->cant_entradas;
    }
    public function getDescuento(){
        return $this->descuento;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getTotal(){
        return $this->total;
    }

    public function setCantEntradas($cant_entradas){
        $this->cant_entradas = $cant_entradas,
    }
    public function setDescuento($descuento){
        $this->descuento = $descuento;
    }
    public function setfecha($fecha){
        $this->fecha = $fecha;
    }
    public function setTotal($total){
        $this->total = $total;
    }
}

?>