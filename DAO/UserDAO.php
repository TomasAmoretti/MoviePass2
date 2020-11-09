<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Models\PerfilUser as PerfilUser;
    use Models\User as User;
    use Models\Rol as Rol;

    class UserDAO
    {

        private $connection;
        private $tableName = "Users"; 

        public function Add(PerfilUser $user){

            try
            {
                $query = "CALL Users_Add (?, ?, ?, ?, ?, ?)";

                $parameters["firstName"] =  $user->getFirstName();
                $parameters["lastName"] = $user->getLastName();
                $parameters["dni"] = $user->getDni();
                $parameters["email"] = $user->getUser()->getEmail();   
                $parameters["password"] = $user->getUser()->getPassword();
                $parameters["rol"] = $user->getUser()->getRol()->getDescription();
                  
                $this->connection = Connection::GetInstance();
    
                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        
        public function GetByEmail($email){

            try
            {
                $rol = null;
                $user = null;
                $perfilUser = null;

                $query = "CALL Users_GetByEmail(?)";

                $parameters["email"] = $email;

                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

                foreach($results as $row)
                {
                    $perfilUser = new PerfilUser();
                    $user = new User();
                    $rol = new Rol();

                    $rol->setDescription($row["role"]);
                    
                    $user->setEmail($row["email"]);
                    $user->setPassword($row["password"]);
                    $user->setRol($rol);

                    $perfilUser->setId($row["id_user"]);
                    $perfilUser->setFirstName($row["firstName"]);
                    $perfilUser->setLastName($row["lastName"]);
                    $perfilUser->setDni($row["dni"]);
                    $perfilUser->setUser($user);
                }
                return $perfilUser;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll($email){

            try
            {
                $rol = null;
                $user = null;
                $perfilUser = null;
                $userList = array();


                $query = "CALL Users_GetAll()";

                $parameters["email"] = $email;

                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

                foreach($results as $row)
                {
                    $perfilUser = new PerfilUser();
                    $user = new User();
                    $rol = new Rol();

                    $rol->setDescription($row["role"]);
                    
                    $user->setEmail($row["email"]);
                    $user->setPassword($row["password"]);
                    $user->setRol($rol);

                    $perfilUser->setId($row["id_user"]);
                    $perfilUser->setFirstName($row["firstName"]);
                    $perfilUser->setLastName($row["lastName"]);
                    $perfilUser->setDni($row["dni"]);
                    $perfilUser->setUser($user);

                    array_push($userList, $perfilUser);
                }
                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

       

    }
?>