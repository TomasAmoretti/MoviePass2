<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;
    use DAO\CineDAO as CineDAO;

    class HomeController
    {
        private $userDAO;
        private $cineDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
            $this->cineDAO = new CineDAO();
        }
 
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }      


        public function DashboardAdminView(){
            require_once(VIEWS_PATH."validate-session.php");
            $cinesList = $this->cineDAO->GetAll();
            require_once(VIEWS_PATH."admin-cines.php");
        }


        public function ClientView(){

            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."cartelera-cliente.php");
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
                else if($user->getRol() == "cliente"){
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