<?php 
namespace Models;

use Models\Room as Room;

class Cinema{

    private $id;
    private $name; //string
    private $adress; //string
    private $room;
    private $state; //boolean;
    private $openingHours;
    private $closingHours;

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
    public function getOpeningHours(){
        return $this->openingHours;
    }
    public function getClosingHours(){
        return $this->closingHours;
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
    public function setOpeningHours($openingHours){
        $this->openingHours = $openingHours;
    }
    public function setClosingHours($closingHours){
        $this->closingHours = $closingHours;
    }
}

?>