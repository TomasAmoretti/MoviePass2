<?php
namespace DAO;

use DAO\Connection as Connection;
use DAO\QueryType as QueryType;
use Models\Purchase as Purchase;
use Models\Show as Show;



class PurchaseDAO {
    
    private $connection;
    private $tableName = "Purchases";
    
    public function Add(Purchase $purchase){

        try
        {
            $query = "CALL Purchases_Add (?, ?, ?, ?, ?)";

            $parameters["count_tickets"] =  $purchase->getCountTicket();
            $parameters["id_user"] = $purchase->getIdUser();
            
            $parameters["id_show"] = $purchase->getShow()->getId();
            $parameters["date_purchase"] = $purchase->getDate();
            $parameters["total"] = $purchase->getTotal();

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
            $purchaseList = array();

            $query = "CALL Purchases_GetAll()";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

            //var_dump($result);

            
            return $result;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }



    public function GetByIdUser($code){

        try
        {
            $purchase = null;
            $payment = null;
            $credit_account = null;

            $query = "CALL Purchases_GetByCode(?)";

            $parameters["code"] = $code;

            $this->connection = Connection::GetInstance();

            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            foreach($results as $row)
            {
                $purchase = new Purchase();
                $payment = new Payment();
                $credit_account = new CreditAccount();

                $credit_account->setCompany($row["company"]);
                
                $payment->setCode($row["code"]);
                $payment->setDate($row["date"]);
                $payment->setTotal($row["total"]);
                $payment->setCredit_account($credit_account);

                $purchase->setNumber_of_tickets($row["number_of_tickets"]);
                $purchase->setDiscount($row["discount"]);
                $purchase->setDate($row["date"]);
                $purchase->setTotal($row["total"]);
                $purchase->setPayment($payment);
            }
            return $purchase;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }


    
}
?>