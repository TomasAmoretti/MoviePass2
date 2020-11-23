<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Models\PerfilUser as PerfilUser;
    use Models\User as User;
    use Models\Rol as Rol;
    use \Exception as Exception;

    class UserDAO
    {

        private $connection;
        private $tableName = "Users"; 

        //Agrega un usuario a la Base de Datos
        public function Add(PerfilUser $user){

            try
            {
                $query = "CALL Users_Add (?, ?, ?, ?, ?, ?)";//Se guarda la accion que se hara en la BDD

                $parameters["firstName"] =  $user->getFirstName();
                $parameters["lastName"] = $user->getLastName();
                $parameters["dni"] = $user->getDni();
                $parameters["email"] = $user->getUser()->getEmail();   
                $parameters["password"] = $user->getUser()->getPassword();
                $parameters["rol"] = $user->getUser()->getRol()->getDescription();
                  
                $this->connection = Connection::GetInstance();
    
                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion en la BDD
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        //Obtiene el usuario a traves del "email"
        public function GetByEmail($email){

            try
            {
                $rol = null;
                $user = null;
                $perfilUser = null;

                $query = "CALL Users_GetByEmail(?)";//Se guarda la accion que se hara en la BDD

                $parameters["email"] = $email;

                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

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

        //Trae a todos los usuarios que esten cargados en la Base de Datos
        public function GetAll($email){

            try
            {
                $rol = null;
                $user = null;
                $perfilUser = null;
                $userList = array();


                $query = "CALL Users_GetAll()";//Se guarda la accion que se hara en la BDD

                $parameters["email"] = $email;

                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

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

        public function GetById($id){

            try
            {
                $rol = null;
                $user = null;

                $query = "CALL Users_GetAll()";//Se guarda la accion que se hara en la BDD

                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

                foreach($results as $row)
                {
                    if($row["id_user"] == $id){

                        $user = new User();
                        $rol = new Rol();

                        $rol->setDescription($row["role"]);
                    
                        $user->setEmail($row["email"]);
                        $user->setPassword($row["password"]);
                        $user->setRol($rol);

                    }
                }
                return $user;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

       

    }
