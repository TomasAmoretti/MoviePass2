<?php
namespace Models;

use Models\Room as Room;
use Models\Movie as Movie;

class Show{

    private $id;
    private $day;
    private $hour;
    private $room;
    private $state;
    private $id_movie;


    //Getters
    public function getId(){
        return $this->id;
    }
    public function getDay(){
        return $this->day;
    }
    public function getHour(){
        return $this->hour;
    }
    public function getRoom(){
        return $this->room;
    }
    public function getIdMovie(){
        return $this->id_movie;
    }
    public function getState(){
        return $this->state;
    }

    //Setters
    public function setId($id){
        $this->id = $id;
    }
    public function setDay($day){
        $this->day = $day;
    }
    public function setHour($hour){
        $this->hour = $hour;
    }
    public function setRoom($room){
        $this->room = $room;
    }
    public function setIdMovie($id_movie){
        $this->id_movie = $id_movie;
    }
    public function setState($state){
        $this->state = $state;
    }
}

?>