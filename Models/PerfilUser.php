<?php
namespace Models;

abstract class PerfilUser{

    private $nombre;   //string
    private $apellido; //string
    private $dni;      //int

    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getDNI(){
        return $this->dni;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }
    public function setDNI($dni){
        $this->dni = $dni;
    }

}

    
?>