<?php
namespace Models;

use Models\Cinema as Cinema;

class Room{

    private $id;
    private $name;    //string
    private $capacity;    //byte
    private $price;  //string
    private $state; //boolean;


    //Getters
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getCapacity(){
        return $this->capacity;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getState(){
        return $this->state;
    }

    //Setters
    public function setId($id){
        $this->id = $id;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setCapacity($capacity){
        $this->capacity = $capacity;
    }
    public function setPrice($price){
        $this->price = $price;
    }
    public function setState($state){
        $this->state = $state;
    }
       
}

?>