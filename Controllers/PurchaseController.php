<?php
    namespace Controllers;

    use DAO\PurchaseDAO as PurchaseDAO;
    use Models\Purchase as Purchase;
    use DAO\ShowDAO as ShowDAO;
    use Models\Show as Show;
    use DAO\RoomDAO as RoomDAO;
    use Models\Room as Room;

    use Controllers\HomeController as HomeController;

    class PurchaseController
    {
        private $purchaseDAO;
        private $showDAO;
        private $roomDAO;
        private $homeController;
        
        // Método constructor.
        public function __construct()
        {
            $this->purchaseDAO = new PurchaseDAO();
            $this->showDAO = new ShowDAO();
            $this->roomDAO = new RoomDAO();
            $this->homeController = new HomeController;
        }

        // Función de compra entrada, genera el ticket con los datos y el precio (pueden ser uno o más tickets).
        public function Add($count_tickets, $id_user, $id_show){
           
            try{

                $purchase = new Purchase();
                //Retorna la función de cine a través del ID.
                $show = $this->showDAO->getById($id_show);
                $room = $this->roomDAO->getById($show->getRoom());

                $date = date('Y-m-d', time());
                $total = $count_tickets * $room->getPrice();

                $purchase->setShow($show);
                $purchase->setCountTicket($count_tickets);
                $purchase->setIdUser($id_user);
                $purchase->setDate($date);
                $purchase->setTotal($total);
                

                $this->purchaseDAO->Add($purchase);

                $this->homeController->ShowsViewClient();

            }    
            catch(\PDOException $e){
        
                $message = $e->getMessage();
                $this->homeController->ShowsViewClient($message);
            }
        }


        //Obtiene el historial de compras.
        public function GetAll(){

            try{

                return $purchaseArray = $this->purchaseDAO->GetAll();

            }
            catch(\PDOException $e){
           
                $message = $e->getMessage();
                $this->homeController->InfoViewAdmin($message);
                return null;
            }
        }
    }
?>