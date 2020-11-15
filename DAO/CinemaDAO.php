<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Interfaces\IDao as IDao;
    use Models\Cinema as Cinema;
    use \Exception as Exception;

    class CinemaDAO implements IDao
    {
        private $connection;
        private $tableName = "Cinemas";

        //Agrega un cine a la Base de Datos 
        public function Add($cinema)
        {
            try
            {
                $query = "CALL Cinemas_Add(?, ?, ?)";//Se guarda la accion que se hara en la BDD

                $parameters["cinema_name"] =  $cinema->getName();
                $parameters["adress"] = $cinema->getAdress();
                $parameters["state"] = $cinema->getState();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion en la BDD
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //Trae a todos los cines que esten cargados en la BDD
        public function GetAll()
        {
            try
            {
                $cinemaList = array();

                $query = "CALL Cinemas_GetAll()";//Se guarda la accion que se hara en la BDD

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

                foreach($result as $row)
                {
                    $cinema = new Cinema();
                    $cinema->setId($row["id_cinema"]);
                    $cinema->setName($row["cinema_name"]);
                    $cinema->setAdress($row["adress"]);
                    $cinema->setState($row["state"]);

                    array_push($cinemaList, $cinema);
                }
                return $cinemaList;
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //Trae al cine que tenga la misma "id" que se le pasa por parametro
        public function GetById($id)
        {
            try
            {

                $query = "CALL Cinemas_GetById(?)";//Se guarda la accion que se hara en la BDD

                $parameters["id_cinema"] =  $id;

                $this->connection = Connection::GetInstance();
 
                $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD
                
                $cinema = new Cinema();
                $cinema->setId($result[0]["id_cinema"]);
                $cinema->setName($result[0]["cinema_name"]);
                $cinema->setAdress($result[0]["adress"]);
                $cinema->setState(true);
                
                return $cinema;

            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //Elimina a un cine de la BDD
        public function Remove($id)
        {
            try
            {
                $query = "CALL Cinemas_Remove(?)";//Se guarda la accion que se hara en la BDD

                $parameters["id_cinema"] = $id;

                $this->connection = Connection::GetInstance();

                echo $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion en la BDD
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //Actualiza los datos de los cines
        public function Update($cinema)
        {
            try
            {
                $query = "CALL Cinemas_Update(?, ?, ?)";//Se guarda la accion que se hara en la BDD

                $parameters["id_cinema"] =  $cinema->getId();
                $parameters["cinema_name"] =  $cinema->getName();
                $parameters["adress"] = $cinema->getAdress();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


    }
?>