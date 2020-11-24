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
        }      

        public function User(){
            require_once(VIEWS_PATH."login.php");
        }

        public function Register(){
            require_once(VIEWS_PATH."home-register.php");
        }

        //Valida la sesión y muestra una lista de cines al Admin.
        public function CinemasView( $validMessage = null ){

            $userController = new UserController();
            $roomController = new RoomController();
            $cinemaController = new CinemaController();
            
            $user = $userController->checkSession();
            if($user){

                $cinemasList = $cinemaController->GetAll();
                $roomsList = $roomController->GetAll();
                require_once(VIEWS_PATH."admin-cinemas.php");

            }else{
                $userController->Logout();
            }
        }

        //Muestra la lista de los cines junto a sus salas.
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

        //Muestra una lista completa de las películas y las salas donde se encuentran.
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

        // Muestra al admin 
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
                
                $roomList = $roomController->GetAll();

                $showsList = $showController->GetTable();

                $purchasesList = $purchaseController->GetAll();

                require_once(VIEWS_PATH."admin-table-info.php");
            }else{
                $userController->Logout();
            }
        }


        //Muestra al cliente películas junto a sus géneros y horarios.
        public function ShowsViewClient(){

            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();

            $user = $userController->checkSession();

            $moviesList = $movieController->GetMovies();
            $genresList = $movieController->GetGenres();
            $roomsList = $roomController->GetAll();
            $showsList = $showController->GetAll();
            
            if($user){
                require_once(VIEWS_PATH."client-show-list.php");
            }else{
                require_once(VIEWS_PATH."home.php");
            }
        }

        //Muestra descripción de la película a través de una ID.
        public function MovieDescription($id_show){

            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();
            $purchaseController =new PurchaseController();

            $user = $userController->checkSession();

            $moviesList = $movieController->GetMovies();
            $genresList = $movieController->GetGenres();
            $roomsList = $roomController->GetAll();
            $show = $showController->GetById($id_show);
            $purchasesList = $purchaseController->GetAll();
            if($user){
                require_once(VIEWS_PATH."client-movie-description.php");
            }else{
                require_once(VIEWS_PATH."guest-movie-description.php");
            }
        }

        // Muestra lista de películas a través del ID del género.
        public function MovieListByGenre($id){

            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();

            $user = $userController->checkSession();

            $moviesList = $movieController->MovieListViewForGenre($id);
            $genresList = $movieController->GetGenres();
                
            $roomsList = $roomController->GetAll();
            $showsList = $showController->GetAll();  
            
            if($user){
                require_once(VIEWS_PATH."client-show-list.php");
            }else{
                require_once(VIEWS_PATH."home.php");
            }
        }

        // Muestra las películas de un determinado día.
        public function MovieListByDate($day){

            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();

            $user = $userController->checkSession();
            
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

        public function PurchaseConfirm($purchase){
            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();
            $purchaseController = new PurchaseController();

            $user = $userController->checkSession();
            
            if($user){
                $userPurchase = $purchase;
                $moviesList = $movieController->GetMovies();
                $genresList = $movieController->GetGenres();
                $roomsList = $roomController->GetAll();
                $showsList = $showController->GetAll();  
                $purchaseList = $purchaseController->GetAll();
            
                require_once(VIEWS_PATH."purchase-view.php");
            }else{
                $userController->Logout();
            }
        }

        public function PurchaseAdd(){
            $userController = new UserController();

            $user = $userController->checkSession();
            
            if($user){
                require_once(VIEWS_PATH."purchase-add.php");
            }else{
                require_once(VIEWS_PATH."home.php");
            }
        }

        public function PurchasesList(){

            $userController = new UserController();
            $movieController = new MovieController();
            $roomController = new RoomController();
            $showController = new ShowController();
            $purchaseController = new PurchaseController();

            $user = $userController->checkSession();
            
            if($user){

                $moviesList = $movieController->GetMovies();
                $genresList = $movieController->GetGenres();
                
                $roomsList = $roomController->GetAll();
                $showsList = $showController->GetAll();  
                $purchaseList = $purchaseController->GetAll();
            
                require_once(VIEWS_PATH."client-show-list.php");
            }else{
                $userController->Logout();
            }
        }
    
    }

?>