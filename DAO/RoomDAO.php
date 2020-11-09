<?php
namespace DAO;

use DAO\Connection as Connection;
use DAO\QueryType as QueryType;
use Interfaces\IDao as IDao;
use Models\Room as Room;


class RoomDAO implements IDao {
    
    private $connection;
    private $tableName = "Rooms";
    
    public function Add($cinema)
    {
        try
        {
            $query = "CALL Rooms_Add(?, ?, ?, ?, ?)";
            
            $parameters["id_cinema"] = $cinema->getId(); 
            $parameters["room_name"] =  $cinema->getRoom()->getName();
            $parameters["capacity"] = $cinema->getRoom()->getCapacity();
            $parameters["price"] = $cinema->getRoom()->getPrice();
            $parameters["state"] = $cinema->getRoom()->getState();     
        
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
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
            

            $query = "CALL Rooms_GetById(?)";

            $parameters["id_room"] =  $id;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
                
            foreach($result as $row){

                $room = new Room();

                $room->setId($row["id_room"]);
                $room->setName($row["room_name"]);
                $room->setCapacity($row["capacity"]);
                $room->setPrice($row["price"]);
                $room->setState($row["state"]);

            }
        
            return $room;
    
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
            $query = "CALL Rooms_Remove(?)";

            $parameters["id_room"] =  $id;

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
            $tableList = array();

            $query = "CALL Rooms_GetAll()";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

            return $result;
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
            $query = "CALL Rooms_Update(?, ?, ?, ?, ?)";

            $parameters["id_room"] =  $cinema->getRoom()->getId();
            $parameters["id_cinema"] =  $cinema->getId();

            $parameters["room_name"] =  $cinema->getRoom()->getName();
            $parameters["capacity"] = $cinema->getRoom()->getCapacity();
            $parameters["price"] = $cinema->getRoom()->getPrice();

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