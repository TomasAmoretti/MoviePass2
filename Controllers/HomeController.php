<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;
    use DAO\CineDAO as CineDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\GenreDAO as GenreDAO;

    class HomeController
    {
        private $userDAO;
        private $cineDAO;
        private $movieDAO;
        private $genreDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
            $this->cineDAO = new CineDAO();
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();

        }
 
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }      

        public function DashboardAdminView(){
            require_once(VIEWS_PATH."validate-session.php");
            $cinesList = $this->cineDAO->RetrieveData();
            $cinesList = $this->cineDAO->GetAll();
            require_once(VIEWS_PATH."admin-cines.php");
        }

        public function ClientView(){
            $movie_list = $this->movieDAO->GetAll();
            $genre_list = $this->genreDAO->getAllGenres();
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."billboard.php");
        }

        public function Login($email, $password)
        {
            $user = $this->userDAO->GetByEmail($email);

            if(($user != null) && ($user->getPassword() === $password))
            {
                if($user->getRol() == "admin"){
                    
                    $_SESSION["loggedUser"] = $user;
                    $this->DashboardAdminView();
                }
                else if($user->getRol() == "client"){
                    $_SESSION["loggedUser"] = $user;
                    $this->ClientView();
                }
            }
            else
                $this->Index("Usuario y/o Contraseña incorrectos");
        }
        
        public function Logout()
        {
            session_destroy();

            $this->Index();
        }
    
    }

?>