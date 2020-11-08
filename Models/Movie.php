<?php
namespace Models;

use Models\Genre as Genre;

class Movie{

    private $id;
    private $id_api;
    private $title;    //string
    private $image;    //byte
    private $original_language;  //string
    private $duration;
    private $score;
    private $overview;

    private $genres; // gender array()


    public function __construct($id, $title, $image, $original_language, $duration, $overview, $score,$genres){
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
        $this->original_language = $original_language;
        $this->duration = $duration;
        $this->overview = $overview;
        $this->score = $score;
        $this->genres = $genres;
    }

    //Getters
    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getImage(){
        return $this->image;
    }
    public function getOriginalLanguage(){
        return $this->original_language;
    }
    public function getDuration(){
        return $this->duration;
    }
    public function getOverview(){
        return $this->overview;
    }
    public function getScore(){
        return $this->score;
    }
    public function getGenres(){
        return $this->genres;
    }

    //Setters
    public function setId($id){
        $this->id = $id;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    public function setImage($image){
        $this->image = $image;
    }
    public function setLenguage($original_language){
        $this->original_lenguage = $original_language;
    }
    public function setDuration($duration){
        $this->duration = $duration;
    }
    public function setOverview($overview){
        $this->overview = $overview;
    }
    public function setScore($score){
        $this->score = $score;
    }
    public function setGenres($genres){
        $this->genres = $genres;
    }    
}

?>