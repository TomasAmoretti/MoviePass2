<?php
namespace Models;

class Genre{

    private $id ;
    private $id_api;
    private $name;

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    public function setName($name){
        $this->name = $name;
    }
    
}

?>