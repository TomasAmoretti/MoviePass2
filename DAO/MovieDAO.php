<?php
namespace DAO;

use Models\Movie as Movie;
use Models\Genre as Genre;

class MovieDAO {
    
    private $moviesList = array();
    private $genresList = array();
    
    //Trae todas las peliculas
    public function getMovies(){
        
        $this->retrieveMovies();

        return $this->moviesList;
    }
    
    //Trae todos los generos de las peliculas
    public function getGenres(){
        $this->retrieveGenres();
        return $this->genresList;
    }

    //Obtiene las peliculas a partir del "id" de un genero de la pelicula
    public function getMoviesByGenre($id_genre){
        $this->retrieveMovies();
        $newMoviesList = [];
        foreach ($this->moviesList as $movie){
            foreach($movie->getGenres() as $genre){
                if($id_genre == $genre){
                    array_push($newMoviesList, $movie);
                }
            }
        }
        $returnedValue = count($newMoviesList) ? $newMoviesList : $this->moviesList;
        return $returnedValue;
    }

    //Obtiene la duracion de una pelicula a travez de la API
    public function retrieveDurationOneMovieFromApi($id) {
        $json = file_get_contents("https://api.themoviedb.org/3/movie/" . $id . "?api_key=499b6c2316b484f72da9054c9957ca97");//Se obtiene el Json de la API
        $APIDataArray = json_decode($json, true);
        $runtime = $APIDataArray["runtime"];
        if($runtime == null) {
            $runtime = 120;
        }
        return $runtime;
    }

    //Obtiene las peliculas a traves de la API
    private function retrieveMovies(){

        $json = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?page=1&language=en&api_key=499b6c2316b484f72da9054c9957ca97");//Se obtiene el Json de la API
        
        $arrayToDecode = ($json) ? json_decode($json, true) : array();
        $arrayMovies = array_shift($arrayToDecode);

        foreach($arrayMovies as $valuesArray)
        {
            $duration = $this->retrieveDurationOneMovieFromApi($valuesArray['id']) ;
            $movie = new Movie($valuesArray['id'], $valuesArray['title'], $valuesArray['poster_path'], $valuesArray["original_language"],$duration, $valuesArray['overview'], $valuesArray['vote_average'], $valuesArray["genre_ids"]);

            array_push($this->moviesList, $movie);
        }
        
    }

    //Obtiene los generos de las peliculas a traves de la API
    public function retrieveGenres(){
                
        $json = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=499b6c2316b484f72da9054c9957ca97");//Se obtiene el Json de la API
        $arrayToDecode = ($json) ? json_decode($json, true) : array();
        $arrayGeneros = array_shift($arrayToDecode);

        foreach($arrayGeneros as $valuesArray)
            {
                $genre = new Genre();

                $genre->setId($valuesArray["id"]);
                $genre->setName($valuesArray["name"]);

                array_push($this->genresList, $genre);
            }
    }

    //Obtiene un genero a partir de una "id"
    public function getGenreForId($id_buscado){
        for($i=0; $i < count($this->genresList) ; $i++)
        {
            $id = $this->genresList[$i]->getId();
            if($id == $id_buscado)
            {
                $generoARetornar = $this->genresList[$i];
            }
        }
        return $generoARetornar;
    }

    private function remplaceIdGenre(){
        foreach($this->moviesList as $movie){
            $genres = array_values(array_filter($this->genresList, function ($genre) use ($movie) {
                return array_reduce($movie->getGenreIds(), function ($equal, $id) use ($genre) {
                    return $equal || $id === $genre->getId();
                });
            }, ARRAY_FILTER_USE_BOTH));
            $movie-> setGenreIds($genres);
        }
    }
    
}
?>
