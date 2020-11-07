<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Interfaces\IDao as IDao;
    use Models\Cinema as Cinema;

    class CinemaDAO implements IDao
    {
        private $connection;
        private $tableName = "Cinemas";

        public function Add($cinema)
        {
            try
            {
                $query = "CALL Cinemas_Add(?, ?, ?)";

                $parameters["cinema_name"] =  $cinema->getName();
                $parameters["adress"] = $cinema->getAdress();
                $parameters["state"] = $cinema->getState();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            try
            {
                $cinemaList = array();

                $query = "CALL Cinemas_GetAll()";

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

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

        public function GetById($id)
        {
            try
            {

                $query = "CALL Cinemas_GetById()";

                $parameters["id_cinema"] =  $id;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

                $cinema = new Cinema();
                $cinema->setId($result["id_cinema"]);
                $cinema->setName($result["cinema_name"]);
                $cinema->setAdress($result["adress"]);
                $cinema->setState($result["state"]);
                
                return $cinema;

            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Remove($id)
        {
            try
            {
                $query = "CALL Cinemas_Remove(?)";

                $parameters["id_cinema"] =  $id;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function Update($cinema)
        {
            try
            {
                $query = "CALL Cinemas_Update(?, ?, ?)";

                $parameters["id_cinema"] =  $cinema->getId();
                $parameters["cinema_name"] =  $cinema->getName();
                $parameters["adress"] = $cinema->getAdress();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


    }
?>