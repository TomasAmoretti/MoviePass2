<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;
    use Controllers\HomeController as HomeController;

    class MovieController
    {
        private $movieDAO;
        private $homeController;

        public function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->homeController = new HomeController();
        }

        public function GetMovies(){
            
            try{

                return $moviesList = $this->movieDAO->getMovies();              

            } catch(\PDOException $e){
           
                $message = $e->getMessage();
                $this->homeController->RoomsView($message);
                $this->homeController->ShowsViewClient($message);
                return null;
            }
        }

        public function GetGenres(){
                       
            try{
                
                return $genresList = $this->movieDAO->getGenres();
                
            }
            catch(\PDOException $e){

                $message = $e->getMessage();
                $this->homeController->RoomsView($message);
                $this->homeController->ShowsViewClient($message);
                return null;
            }
        }

        public function MovieListViewForGenre($id){
           
            try{

                return $moviesList = $this->movieDAO->getMoviesByGenre($id);
               
            }
            catch(\PDOException $e){

                $message = $e->getMessage();
                $this->homeController->MovieListByGenre($message);
            }
        }

    }

?>