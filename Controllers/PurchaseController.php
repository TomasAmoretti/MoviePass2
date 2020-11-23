<?php
    namespace Controllers;

    use DAO\PurchaseDAO as PurchaseDAO;
    use Models\Purchase as Purchase;
    use DAO\ShowDAO as ShowDAO;
    use Models\Show as Show;
    use DAO\RoomDAO as RoomDAO;
    use Models\Room as Room;
    use Models\Cinema as Cinema;
    use DAO\CinemaDAO as CinemaDAO;

    use Controllers\HomeController as HomeController;
use PDOException;

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
                $userController = new UserController();
                $user = $userController->checkSession();

                if($user){
                    $purchase = new Purchase();

                    //Retorna la función de cine a través del ID.
                    $show = $this->showDAO->GetById($id_show);
                    $room = $this->roomDAO->GetById($show->getRoom());

                    $date = date('Y-m-d', time());

                    $total = $this->discount($count_tickets, $id_show);

                    $purchase->setShow($show);
                    $purchase->setCountTicket($count_tickets);
                    $purchase->setIdUser($id_user);
                    $purchase->setDate($date);
                    $purchase->setTotal($total);

                    $this->purchaseDAO->Add($purchase);
                    $this->homeController->PurchaseConfirm($purchase);
                }else{
                    require_once(VIEWS_PATH."login.php");
                }

            }    
            catch(\PDOException $e){
        
                $message = $e->getMessage();
                $this->homeController->ShowsViewClient($message);
            }
        }

        public function Confirm($id_purchase, $id_show, $qr){
            
            try{
                $userController = new UserController();
                $user = $userController->checkSession();
                if($user){
                    $this->purchaseDAO->AddTicket($id_purchase, $id_show, $qr);
                    $purchase2 = $this->purchaseDAO->GetPurchaseById($id_purchase);
                    $this->purchaseDAO->SendEmail($purchase2, $qr);
                    $this->homeController->PurchaseAdd();
                }else{
                    require_once(VIEWS_PATH."login.php");
                }

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

    private function discount($count_tickets, $id_show)
    {
        $purchaseList = $this->purchaseDAO->GetAll();
        $show = $this->showDAO->GetById($id_show);
        $roomShow = $show->getRoom();
        $room = $this->roomDAO->GetById($roomShow);

        $dayShow = $show->getDay();
        $day = $this->knowDay($dayShow);

        if ((strcasecmp($day, 'Martes') == 0) || (strcasecmp($day, 'Miercoles') == 0)) {

            if ($count_tickets >= 2) {
                $discount = $room->getPrice() - ($room->getPrice() * 0.25);
                return $totalDiscount = ($discount * $count_tickets);
            } else {

                return $total = ($count_tickets * $room->getPrice());
            }
        } else {

            return $total = ($count_tickets * $room->getPrice());
        }
    }

        private function knowDay($day) {
            if($day != null){    
                $dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
                $fecha = $dias[date('N', strtotime($day))];
                return $fecha;
            }
            else{
                throw new PDOException("El dia a buscar ingresado no es valido");
            }
        }
    }
?>