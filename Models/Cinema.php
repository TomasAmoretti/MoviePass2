<?php 
namespace Models;

use Models\Room as Room;

class Cinema{

    private $id;
    private $name; //string
    private $adress; //string

    private $room;
    private $opening_time;
    private $closing_time;

    private $state; //boolean;

    //Getters
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getAdress(){
        return $this->adress;
    }
    public function getRoom(){
        return $this->room;
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
    public function setAdress($adress){
        $this->adress = $adress;
    }
    public function setRoom(Room $room){
        $this->room = $room;
    }

    public function setState($state){
        $this->state = $state;
    }
}

?>