<?php
    namespace Controllers;

    /*Alias - Models*/
    use Models\PerfilUSer as PerfilUser;
    use Models\User as User;
    use Models\Rol as Rol;

    /*Alias - DAO*/
    use DAO\UserDAO as UserDAO;

    /*Alias - Controllers*/
    use Controllers\HomeController as HomeController;

    /*Alias - Exceptions*/
    use \PDOException as PDOException;

    class UserController
    {
        private $userDAO;
        private $homeController;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
            $this->homeController = new HomeController();
        }


        public function Login($email, $password)
        {
            $perfilUser = $this->userDAO->GetByEmail($email);

            if(($perfilUser != null) && ($perfilUser->getUser()->getPassword() === $password))
            {
                if($perfilUser->getUser()->getRol()->getDescription() === "admin"){
                    $_SESSION["loggedUser"] = $perfilUser;
                    $this->homeController->CinemasView();
                }
                else if($perfilUser->getUser()->getRol()->getDescription() === "client"){
                    $_SESSION["loggedUser"] = $perfilUser;
                    $this->homeController->ShowsViewClient();
                }
            }
            else{
                $this->homeController->Index("Usuario y/o Contraseña incorrectos");
            }
        }

        public function checkSession()
        {
            if (session_status() == PHP_SESSION_NONE)
                session_start();

            if(isset($_SESSION['loggedUser'])) {

                $perfilUser = $this->userDAO->getByEmail($_SESSION['loggedUser']->getUser()->getEmail());
                if($perfilUser->getUser()->getPassword() == $_SESSION['loggedUser']->getUser()->getPassword())
                    return $perfilUser;

              }else {
                return false;
            }
        }
        
        public function Logout()
        {
            if(session_status() == PHP_SESSION_NONE)
                session_start();
                session_destroy();
            $this->homeController->Index();
        }

        public function Add($firstName, $lastName, $dni, $email, $password)
        {
            $perfilUser = new PerfilUser();
            $user = new User();
            $rol = new Rol();
            
            $rol->setDescription('client');

            $user->setEmail($email);
            $user->setPassword($password);
            $user->setRol($rol);

            $perfilUser->setFirstName($firstName);
            $perfilUser->setLastName($lastName);
            $perfilUser->setDni($dni);
            $perfilUser->setUser($user);

            $this->userDAO->Add($perfilUser);

            $this->homeController->ShowsViewClient();
        }


        /*User is saved in session*/
	    public function setSession($user) {
            if (session_status() == PHP_SESSION_NONE)
                session_start();
		
	        $_SESSION['user'] = $user;
	
        }
        
        public function UserExist($email){
            try{
                if($this->userDAO->GetByEmail($email)){
                    return true;
                }else
                {
                    return false;
                }
            }catch(\PDOException $ex){
                throw $ex;
            }
        }

        /*Methods for Facebook API*/

      
    public function loginWithFacebook($fbUserData) {
        
        try{
            if($this->UserExist($fbUserData['email']))//comprueba que exista el usuario
            {
                $user = $this->userDAO->GetByEmail($fbUserData['email']);
                
                if($user)
                {
                    
                    $_SESSION["loggedUser"] = $user;
                    $this->homeController->ShowsViewClient();
                }else{
                    $errorMje = "Error: we Can´t access to your facebook acount";
                    $this->homeController->Index();
                }
            }else{
                $errorMje = "Error: there are no records of such user in the database";
                $this->homeController->Index();
            }
        }catch(\PDOExeption $ex){
            throw $ex;
        }
    }

        private function verifyIfTheUserEmailBeUsing($accountsList, $userEmail) {
            $result=false;

            foreach($accountsList as $value)
            {
                if($value->getEmail()==$userEmail)
                {
                    $result=true;
                    break;
                }       
            }
            return $result;
        }

        private function createUserUsingFacebook($array) {
            $email = $array["email"];
            try
            {
                $idUserFacebook=$array["id"];
                $firstName = $array["firstName"];
                $lastName = $array["lastName"];
                $email = $array["email"];

                
                

                //Password hash
                $options = [
                    'cost' => 12,
                ];
                $unencryptedPassword = $array["password"];;
                $password = password_hash($unencryptedPassword, PASSWORD_BCRYPT, $options);
                //

                $userRoleDAO = new DAO_UserRole();
                $userRoleList = $userRoleDAO->retrieveAll();
                if(!empty($userRoleList)) {
                    foreach($userRoleList as $userRole) {
                        if($userRole->getDescription() == "user") {
                            $userRole = $userRole;
                            break;
                        }
                    }
                    $user = new PerfilUser();
                    $user->setEmail($email);
                    $user->setPassword($password);
                    $user->setFirstName($firstName);
                    $user->setLastName($lastName);
                    $user->setUserRole($userRole);
                    $user->setIdFacebook($idUserFacebook);
                    

                    $this->userDAO->create($user);
                    $this->prepareFBprofileImg($idUserFacebook,$user->getEmail());

                    $this->loginUser($email, $unencryptedPassword);
                    //A login is made to, with the email and password, load the user from the database and bring the ID
                }
                else {
                    $message = "There was a problem creating the user. Try again";
                    $this->homeController->signup($message, 0);
                } 
            }
            catch(PDOException $e)
            {
                $message = "A database error ocurred";
                $this->homeController->signup($message, 0);
            }            
        }

        
    }
?>