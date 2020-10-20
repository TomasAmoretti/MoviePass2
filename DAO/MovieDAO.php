<?php
    namespace DAO;

    use DAO\IMovieDAO as IMovieDAO;
    use Models\Pelicula as Pelicula;

    class MovieDAO implements IMovieDAO
    {
        private $movieList = array();

        public function __construct(){
            $api = API_MAIN_LINK."movie/now_playing?api_key=".API_KEY;

            $data = file_get_contents($api);
            $decoded = json_decode($data, true);
            foreach($decoded["results"] as $value){
                $pelicula = new Pelicula($value["title"],$value["poster_path"],$value["genre_ids"],$value["vote_average"],$value["original_language"], $value["genre_ids"]);
                array_push($this->movieList, $pelicula);
            }
        }
        public function GetAll()
        {
            return $this->movieList;
        }

    }
?>