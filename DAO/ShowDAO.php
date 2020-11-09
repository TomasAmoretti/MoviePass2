<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Models\Show as Show;
    use Models\Room as Room;

    class ShowDAO
    {
        private $connection;
        private $tableName = "Shows";


        public function Add($show)
        {
            try
            {
                $query = "CALL Shows_Add(?, ?, ?, ?, ?)";
                
                $parameters["id_room"] =  $show->getRoom()->getId();
                $parameters["id_movie"] = $show->getIdMovie();
                $parameters["day"] = $show->getDay();
                $parameters["hour"] = $show->getHour();  
                $parameters["state"] = $show->getState();  

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
                $showList = array();

                $query = "CALL Shows_GetAll()";
    
                $this->connection = Connection::GetInstance();
    
                $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

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

                $query = "CALL Shows_GetTable()";
    
                $this->connection = Connection::GetInstance();
    
                $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

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

        public function GetByDate($day)
        {
            try
            {
                $showList = array();

                $query = "CALL Shows_GetByDate(?)";

                $parameters["day"] =  $day;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

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

        public function GetById($id)
        {
            try
            {
               
                $query = "CALL Shows_GetById(?)";

                $parameters["id"] =  $id;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

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


        public function Remove($id)
        {
            try
            {
                $query = "CALL Shows_Remove(?)";

                $parameters["id_show"] =  $id;

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
           