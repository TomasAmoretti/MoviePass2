<?php
namespace Models;

class Pelicula{

    private $rating; //float
    private $imagen;    //byte
    private $lenguaje;  //string
    private $titulo;    //int
    private $genero;    //string
    private $genreId;

    public function __construct($titulo, $imagen, $genero, $rating, $lenguaje, $genreId){
        $this->titulo = $titulo;
        $this->imagen = $imagen;
        $this->genero = $genero;
        $this->rating = $rating;
        $this->lenguaje = $lenguaje;
        $this->genreId = $genreId;        
    }

    public function getTitulo(){
        return $this->titulo;
    }
    public function getImagen(){
        return $this->imagen;
    }
    public function getGenero(){
        return $this->genero;
    }
    public function getRating(){
        return $this->rating;
    }
    public function getLenguaje(){
        return $this->lenguaje;
    }
    public function getGenreIds(){
        return $this->genreId;
    }

    public function setTitulo(){
        $this->titulo = $titulo;
    }
    public function setImagen(){
        $this->imagen = $imagen;
    }
    public function setGenero(){
        $this->genero = $genero;
    }
    public function setRating($rating){
        $this->rating = $rating;
    }
    public function setLenguaje(){
        $this->lenguaje = $lenguaje;
    }
}


?>