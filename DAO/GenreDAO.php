<?php
    namespace DAO;

    use Models\Pelicula as Movie;
    use Models\Genre as Genre;

    class GenreDAO
    {
        private $genre_list = array();

        public function __construct()
        {
            $genreArray = json_decode(file_get_contents('http://api.themoviedb.org/3/genre/movie/list?api_key=af168fc809d4fb1ad12f6b57122de08c'), true);
            if($genreArray && $genreArray['genres'] && count($genreArray['genres']) != 0)
            {
                foreach($genreArray['genres'] as $genre)
                {
                    $new_genre = new Genre();
                    $new_genre->setId($genre['id']);
                    $new_genre->setName($genre['name']);
                    array_push($this->genre_list, $new_genre);
                }
            }
        }

        public function getAllGenres()
        {
            return $this->genre_list;
        }

        public function getGenreById($id)
        {
            foreach($this->genre_list as $genre)
            {
                if($genre->getId() == $id)
                {
                    return $genre->getName();
                }
            }
        }
    }
?>