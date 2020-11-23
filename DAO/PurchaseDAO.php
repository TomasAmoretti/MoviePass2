<?php
namespace DAO;

use DAO\Connection as Connection;
use DAO\QueryType as QueryType;
use Models\Purchase as Purchase;
use Models\Show as Show;
use Models\User as User;
use \Exception as Exception;



class PurchaseDAO {
    
    private $connection;
    private $tableName = "Purchases";
    
    //Agrega una compra a la Base de Datos
    public function Add(Purchase $purchase){

        try
        {
            $query = "CALL Purchases_Add (?, ?, ?, ?, ?)";//Se guarda la accion que se hara en la BDD

            $parameters["count_tickets"] =  $purchase->getCountTicket();
            $parameters["id_user"] = $purchase->getIdUser();
            
            $parameters["id_show"] = $purchase->getShow()->getId();
            $parameters["date_purchase"] = $purchase->getDate();
            $parameters["total"] = $purchase->getTotal();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion en la BDD
        }   
        catch(Exception $ex)
        {
            throw $ex;
        }

    }

    public function AddTicket($id_purchase, $id_show, $qr){

        try
        {
            $query = "CALL Ticket_Add (?, ?, ?)";//Se guarda la accion que se hara en la BDD

            $parameters["id_purchase"] =  $id_purchase;
            $parameters["id_show"] = $id_show;
            $parameters["qr"] = $qr;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion en la BDD
        }   
        catch(Exception $ex)
        {
            throw $ex;
        }

    }
    
    //Devuelve todas las compras que se realizaron
    public function GetAll()
    {
        try
        {
            $purchaseList = array();

            $query = "CALL Purchases_GetAll()";//Se guarda la accion que se hara en la BDD

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

            
            return $result;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetPurchaseById($id_purchase){
        try
        {
            
            $query = "CALL Purchases_GetById(?)";//Se guarda la accion que se hara en la BDD

            $parameters["id_purchase"] =  $id_purchase;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

            foreach($result as $row){

                $purchase = new Purchase();
                $showList = new ShowDAO();
                $showObject = new Show();
                $showList->GetAll();
                foreach($showList as $show){
                    if($show->getId() == $row["id_show"]){
                        $showObject = $show;
                    }
                }
                $purchase->setId($row["id_purchase"]);
                $purchase->setIdUser($row["id_user"]);
                $purchase->setShow($showObject);
                $purchase->setCountTicket($row["count_tickets"]);
                $purchase->setDiscount($row["discount"]);
                $purchase->setDate($row["date_purchase"]);
                $purchase->setTotal($row["total"]);

            }
        
            return $purchase;
    
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function SendEmail($purchase, $qr){
        $userId = $purchase->getIdUser();
        $userDAO = new UserDAO();
        $user = $userDAO->GetById($userId);
        $moviesList = new MovieDAO();
        $movieTitle = "";
        $cinemaName = "";
        $roomName = "";
        $moviesList->getMovies();
        foreach ($moviesList as $movie) {
            if ($movie->getId() == $purchase->GetShow()->getIdMovie()) {
                $movieTitle = $movie->getTitle();
            }
        }
        $roomsList = new RoomDAO();
        $roomsList->GetAll();
        foreach ($roomsList as $room) {
            if ($room["id_room"] == $purchase->GetShow()->getRoom()) {
                $cinemaName = $room["cinema_name"];
            }
        }
        foreach ($roomsList as $room) {
            if ($room["id_room"] == $purchase->GetShow()->getRoom()) {
                $roomName = $room["room_name"];
            }
        }

        $email_to = $user->getEmail();
        $email_subject = "MoviePass Purchase";

        $email_message = "Your purchase Info:\n\n";
        $email_message .= "Movie: " . $movieTitle . "\n";
        $email_message .= "Cinema: " . $cinemaName . "\n";
        $email_message .= "Room: " . $roomName . "\n";
        $email_message .= "Day: " . $purchase->GetShow()->getDay() . "\n";
        $email_message .= "Hour: " . $purchase->GetShow()->getHour() . "\n";
        $email_message .= "Price: " . $purchase->GetTotal() . "\n";
        $email_message .= "Quantity: " . $purchase->GetCountTicket() . "\n\n";
        $email_message .= "Qr: <img class='qr-ticket' src='data:image/png;base64,". $qr ."/>"."\n\n";

        $headers = 'From: MoviePass'."\r\n".
        'Reply-To: MoviePass'."\r\n" .
        'X-Mailer: PHP/' . phpversion();
        $ok = mail($email_to, $email_subject, $email_message, $headers);
        if( $ok == true ){
            echo '<script>Email enviado con exito!</script>';
        }else{
            echo '<script>Email no enviado =(</script>';
        }
    }
    
}
?>