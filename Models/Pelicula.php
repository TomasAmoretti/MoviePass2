<?php
namespace Models;

class Pelicula{

    private $duracion; //int
    private $imagen;    //byte
    private $lenguaje;  //string
    private $titulo;    //int

    public function __construct($duracion, $imagen, $lenguaje, $titulo){
        $this->duracion = $duracion;
        $this->imagen = $imagen;
        $this->lenguaje = $lenguaje;
        $this->titulo = $titulo;
    }

    public function getDuracion(){
        return $this->duracion = $duracion;
    }
    public function getImagen(){
        return $this->imagen = $imagen;
    }
    public function getLenguaje(){
        return $this->lenguaje = $lenguaje;
    }
    public function getTitulo(){
        return $this->titulo = $titulo;
    }

    public function setDuracion($duracion){
        $this->duracion = $duracion;
    }
    public function setImagen(){
        $this->imagen = $imagen;
    }
    public function setLenguaje(){
        $this->lenguaje = $lenguaje;
    }
    public function setTitulo(){
        $this->titulo = $titulo;
    }
}


?>