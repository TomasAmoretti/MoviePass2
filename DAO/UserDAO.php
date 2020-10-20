<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;

    class UserDAO implements IUserDAO
    {
        private $usersList = array();
        private $fileName = ROOT."Data/Users.json";


        public function Add(User $userAgregar)
        {
            $this->RetrieveData();

            /*foreach($this->usersList as $user2){
                if($user2->getEmail() == $userAgregar->getEmail()){
                    $booleano = false;
                }
            }
            if($booleano){*/
                array_push($this->usersList, $userAgregar);
                $this->SaveData();
            /*}else{
                echo "<script> alert('Datos de ingreso de usuario incorrectos!!'); </script>";
            }*/

        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->usersList;
        }

        
        public function getByEmail($email){
            $this->RetrieveData();

            foreach ($this->usersList as $key => $user) {
                if($user->getEmail() == $email) {
                    return $user;
                }
            }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->usersList as $user)
            {
                $valuesArray = array();
                $valuesArray["nombre"] = $user->getNombre();
                $valuesArray["apellido"] = $user->getApellido();
                $valuesArray["dni"] = $user->getDNI();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["rol"] = $user->getRol();

                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function RetrieveData()
        {
             $this->usersList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                    $user = new User();
                    $user->setNombre($content["nombre"]);
                    $user->setApellido($content["apellido"]);
                    $user->setDNI($content["dni"]);
                
                    $user->setEmail($content["email"]);
                    $user->setPassword($content["password"]);
                    $user->setRol($content["rol"]);

                    array_push($this->usersList, $user);
                 }
             }
        }  
    }
?>