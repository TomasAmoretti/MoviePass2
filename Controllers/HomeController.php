<?php
    namespace Controllers;

    /*Controllers*/

    use Controllers\UserController as UserController;
    use Controllers\CinemaController as CinemaController;
    use Controllers\RoomController as RoomController;
    use Controllers\MovieController as MovieController;
    use Controllers\GenreController as GenreController;
    use Controllers\ShowController as ShowController;
    use Controllers\PurchaseController as PurchaseController;

    class HomeController
    {

        public function __construct(){

        }
 
        public function Index($message = ""){
<<<<<<< Updated upstream
            require_once(VIEWS_PATH."home.php");
=======
            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();
            
            $moviesList = $movieController->GetMovies();
            $genresList = $movieController->GetGenres();
                
            $roomsList = $roomController->GetAll();
            $showsList = $showController->GetAll();
            $user = $userController->checkSession();
            if($user){
                $userController->Login($user->getUser()->getEmail(), $user->getUser()->getPassword());
            }else{
                require_once(VIEWS_PATH."home.php");
            }
>>>>>>> Stashed changes
        }      

        public function User(){
            require_once(VIEWS_PATH."login.php");
        }

        public function Register(){
            require_once(VIEWS_PATH."home-register.php");
        }


        public function CinemasView( $validMessage = null ){

            $userController = new UserController();
            $cinemaController = new CinemaController();
            
            $user = $userController->checkSession();
            if($user){

                $cinemasList = $cinemaController->GetAll();
                require_once(VIEWS_PATH."admin-cinemas.php");

            }else{
                $userController->Logout();
            }
        }

        public function RoomsView( $validMessage = null ){

            $userController = new UserController();
            $roomController = new RoomController();
            $cinemaController = new CinemaController();

            $user = $userController->checkSession();
            
        
            if($user){
                $roomsList = $roomController->GetAll();
                $cinemasList = $cinemaController->GetAll();
                require_once(VIEWS_PATH."admin-rooms.php");
            }else{
                $userController->Logout();
            }
        }

        public function ShowsViewAdmin( $validMessage = null ){

            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();
            $cinemaController = new CinemaController();
            

            $user = $userController->checkSession();
            
            if($user){
                $moviesList = $movieController->GetMovies();
                $genresList = $movieController->GetGenres();
                $roomsList = $roomController->GetAll();
                $showsList = $showController->GetTable();

                require_once(VIEWS_PATH."admin-shows.php");
            }else{
                $userController->Logout();
            }
        }

        public function InfoViewAdmin( $validMessage = null ){

            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();
            $cinemaController = new CinemaController();
            $purchaseController = new PurchaseController();

            $user = $userController->checkSession();
            
            if($user){

                $moviesList = $movieController->GetMovies();
                
                $showsList = $showController->GetTable();

                $purchasesList = $purchaseController->GetAll();

                require_once(VIEWS_PATH."admin-table-info.php");
            }else{
                $userController->Logout();
            }
        }



        public function ShowsViewClient(){

            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();

            $user = $userController->checkSession();
<<<<<<< Updated upstream
            
            if($user){

                $moviesList = $movieController->GetMovies();
                $genresList = $movieController->GetGenres();
                
                $roomsList = $roomController->GetAll();
                $showsList = $showController->GetAll();  
=======
>>>>>>> Stashed changes

            $moviesList = $movieController->GetMovies();
            $genresList = $movieController->GetGenres();
            $roomsList = $roomController->GetAll();
            $showsList = $showController->GetAll();
            
<<<<<<< Updated upstream
                require_once(VIEWS_PATH."client-shows-list.php");
            }else{
                $userController->Logout();
=======
            if($user){
                require_once(VIEWS_PATH."client-show-list.php");
            }else{
                require_once(VIEWS_PATH."home.php");
>>>>>>> Stashed changes
            }
        }

        public function MovieDescription($id_show){

            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();

            $user = $userController->checkSession();
<<<<<<< Updated upstream
            
            if($user){
                $moviesList = $movieController->GetMovies();
                $genresList = $movieController->GetGenres();
                
                $roomsList = $roomController->GetAll();
                $show = $showController->GetById($id_show);  
=======

            $moviesList = $movieController->GetMovies();
            $genresList = $movieController->GetGenres();
            $roomsList = $roomController->GetAll();
            $show = $showController->GetById($id_show);
>>>>>>> Stashed changes
            
            if($user){
                require_once(VIEWS_PATH."client-movie-description.php");
            }else{
<<<<<<< Updated upstream
                $userController->Logout();
=======
                require_once(VIEWS_PATH."guess-movie-description.php");
>>>>>>> Stashed changes
            }
        }


        public function MovieListByGenre($id){

            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();

            $user = $userController->checkSession();
<<<<<<< Updated upstream
            
            if($user){
=======
>>>>>>> Stashed changes

            $moviesList = $movieController->MovieListViewForGenre($id);
            $genresList = $movieController->GetGenres();
                
            $roomsList = $roomController->GetAll();
            $showsList = $showController->GetAll();  
            
<<<<<<< Updated upstream
                require_once(VIEWS_PATH."client-shows-list.php");
            }else{
                $userController->Logout();
=======
            if($user){
                require_once(VIEWS_PATH."client-show-list.php");
            }else{
                require_once(VIEWS_PATH."home.php");
>>>>>>> Stashed changes
            }
        }

        public function MovieListByDate($day){

            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();

            $user = $userController->checkSession();
            
<<<<<<< Updated upstream
            if($user){

                $moviesList = $movieController->GetMovies();
                $genresList = $movieController->GetGenres();
                
                $roomsList = $roomController->GetAll();
                $showsList = $showController->getMovieByDate($day);  
            
                require_once(VIEWS_PATH."client-shows-list.php");
            }else{
                $userController->Logout();
            }
        }

=======
            $moviesList = $movieController->GetMovies();
            $genresList = $movieController->GetGenres();
                
            $roomsList = $roomController->GetAll();
            $showsList = $showController->getMovieByDate($day);

            if($user){
                require_once(VIEWS_PATH."client-show-list.php");
            }else{
                require_once(VIEWS_PATH."home.php");
            }
        }


>>>>>>> Stashed changes
        public function PurchasesList(){

            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();

            $user = $userController->checkSession();
            
            if($user){

                $moviesList = $movieController->GetMovies();
                $genresList = $movieController->GetGenres();
                
                $roomsList = $roomController->GetAll();
                $showsList = $showController->GetAll();  
            
                require_once(VIEWS_PATH."client-shows-list.php");
            }else{
                $userController->Logout();
            }
        }
    
    }

?>