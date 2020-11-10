<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Models\Show as Show;
    use Models\Room as Room;
    use \Exception as Exception;

    class ShowDAO
    {
        private $connection;
        private $tableName = "Shows";

        //Agrega una funcion a la cartelera
        public function Add($show)
        {
            try
            {
                $query = "CALL Shows_Add(?, ?, ?, ?, ?)";//Se guarda la accion que se hara en la BDD
                
                $parameters["id_room"] =  $show->getRoom()->getId();
                $parameters["id_movie"] = $show->getIdMovie();
                $parameters["day"] = $show->getDay();
                $parameters["hour"] = $show->getHour();  
                $parameters["state"] = $show->getState();  

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion en la BDD

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        //Obtiene todas las funciones que esten en la Base de Datos
        public function GetAll()
        {
            try
            {
                $showList = array();

                $query = "CALL Shows_GetAll()";//Se guarda la accion que se hara en la BDD
    
                $this->connection = Connection::GetInstance();
    
                $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

                foreach($result as $row)
                {
                    $show = new Show();
                    $room = new Room();

                    $show->setId($row["id_show"]);
                    $show->setRoom($room->setId($row["id_room"]));
                    $show->setIdMovie($row["id_movie"]);
                    $show->setDay($row["day"]);
                    $show->setHour($row["hour"]);
                
                    array_push($showList, $show);
                }
                return $showList;

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        
        public function GetTable()
        {
            try
            {
                $showList = array();

                $query = "CALL Shows_GetTable()";//Se guarda la accion que se hara en la BDD
    
                $this->connection = Connection::GetInstance();
    
                $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

                foreach($result as $row)
                {
                    $show = new Show();
                    $room = new Room();

                    $show->setId($row["id_show"]);
                    $show->setRoom($room->setId($row["id_room"]));
                    $show->setIdMovie($row["id_movie"]);
                    $show->setDay($row["day"]);
                    $show->setHour($row["hour"]);
                
                    array_push($showList, $show);
                }
                return $result;

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //Obtiene las funciones a traves de una fecha en particular
        public function GetByDate($day)
        {
            try
            {
                $showList = array();

                $query = "CALL Shows_GetByDate(?)";//Se guarda la accion que se hara en la BDD

                $parameters["day"] =  $day;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

                foreach($result as $row)
                {
                    $show = new Show();
                    $room = new Room();

                    $show->setId($row["id_show"]);
                    $show->setRoom($room->setId($row["id_room"]));
                    $show->setIdMovie($row["id_movie"]);
                    $show->setDay($row["day"]);
                    $show->setHour($row["hour"]);
                
                    array_push($showList, $show);
                }
                return $showList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //Obtiene las funciones a traves de la "id"
        public function GetById($id)
        {
            try
            {
               
                $query = "CALL Shows_GetById(?)";//Se guarda la accion que se hara en la BDD

                $parameters["id"] =  $id;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

                foreach($result as $row)
                {
                    $show = new Show();
                    $room = new Room();

                    $show->setId($row["id_show"]);
                    $show->setRoom($row["id_room"]);
                    $show->setIdMovie($row["id_movie"]);
                    $show->setDay($row["day"]);
                    $show->setHour($row["hour"]);
                    
                }
                return $show;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //Elimina una funcion de la Base de Datos
        public function Remove($id)
        {
            try
            {
                $query = "CALL Shows_Remove(?)";//Se guarda la accion que se hara en la BDD

                $parameters["id_show"] =  $id;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion en la BDD
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
       


    }

?>
           