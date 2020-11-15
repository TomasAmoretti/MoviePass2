<?php
namespace DAO;

use DAO\Connection as Connection;
use DAO\QueryType as QueryType;
use Interfaces\IDao as IDao;
use Models\Room as Room;
use \Exception as Exception;


class RoomDAO implements IDao {
    
    private $connection;
    private $tableName = "Rooms";
    
    //Agrega una sala a un cine en especifico
    public function Add($cinema)
    {
        try
        {
            $query = "CALL Rooms_Add(?, ?, ?, ?, ?)";//Se guarda la accion que se hara en la BDD
            
            $parameters["id_cinema"] = $cinema->getId(); 
            $parameters["room_name"] =  $cinema->getRoom()->getName();
            $parameters["capacity"] = $cinema->getRoom()->getCapacity();
            $parameters["price"] = $cinema->getRoom()->getPrice();
            $parameters["state"] = true;     

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion en la BDD
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    //Obtiene una sala a traves de la "id" de la sala
    public function GetById($id)
    {
        try
        {
            

            $query = "CALL Rooms_GetById(?)";//Se guarda la accion que se hara en la BDD

            $parameters["id_room"] =  $id;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD
                
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

    //Se elimina una sala de la Base de Datos
    public function Remove($id)
    {
        try
        {
            $query = "CALL Rooms_Remove(?)";//Se guarda la accion que se hara en la BDD

            $parameters["id_room"] =  $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion en la BDD
        }   
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    //Trae a todas las salas que esten guardadas en la Base de Datos
    public function GetAll()
    {
        try
        {
            $tableList = array();

            $query = "CALL Rooms_GetAll()";//Se guarda la accion que se hara en la BDD

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

            return $result;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    //Actualiza los datos de las salas 
    public function Update($cinema)
    {
        try
        {
            $query = "CALL Rooms_Update(?, ?, ?, ?, ?)";//Se guarda la accion que se hara en la BDD

            $parameters["id_room"] =  $cinema->getRoom()->getId();
            $parameters["id_cinema"] =  $cinema->getId();

            $parameters["room_name"] =  $cinema->getRoom()->getName();
            $parameters["capacity"] = $cinema->getRoom()->getCapacity();
            $parameters["price"] = $cinema->getRoom()->getPrice();

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