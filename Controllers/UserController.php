<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class UserController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }

        public function ClientView(){
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."billboard.php");
        }

        public function SignInUp($nombre, $apellido, $dni, $email, $password)
        {
            $user = new User($nombre, $apellido, $dni, $email, $password, 'cliente');
            $user->setNombre($nombre);
            $user->setApellido($apellido);
            $user->setDNI($dni);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setRol('client');
    
            $this->userDAO->Add($user);

            $this->ClientView();
        }

        public function Remove($id)
        {
            require_once(VIEWS_PATH."validate-session.php");
            
            $this->cineDAO->Remove($id);

            $this->ShowListView();
        }
    }
?>