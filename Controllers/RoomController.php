<?php
    namespace Controllers;

    use \Exception as Exception;
    use \PDOException as PDOException;
    use Models\Cinema as Cinema;
    use DAO\CinemaDAO as CinemaDAO;
    use Models\Room as Room;
    use DAO\RoomDAO as RoomDAO;
    
    
    use Controllers\HomeController as HomeController;


    class RoomController
    {
        private $roomDAO;
        private $cinemaDAO;
        private $homeController;

        public function __construct()
        {
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->homeController = new HomeController();
        }

        public function GetAll(){

            try{

                $roomsArray = $this->roomDAO->GetAll();
                return $roomsArray;

            }
            catch(\PDOException $e){
           
                $message = $e->getMessage();
                $this->homeController->RoomsView($message);
                return null;
            }
        }
        
        public function GetById($id){
            
            return $this->roomDAO->GetById($id);
        }

        public function Add( $id_cinema, $room_name, $capacity, $price)
        {
            try{

                $cinema = new Cinema();
                $room = new Room();

                $room->setName($room_name);
                $room->setCapacity($capacity);
                $room->setPrice($price);
                $room->setState(true);

                $cinema->setId($id_cinema);
                $cinema->setRoom($room);

                $this->roomDAO->Add($cinema);

                $this->homeController->RoomsView();

            }    
            catch(\PDOException $e){
           
                $message = $e->getMessage();
                $this->homeController->RoomsView($message);
            }
        }

        public function Middleware($id_cinema, $room_name, $capacity, $price, $id)
        {
            if(empty($id)){
                $this->Add($id_cinema, $room_name, $capacity, $price);
            } else {
                $this->Update($id, $id_cinema, $room_name, $capacity, $price);
            }
        }

        
        public function Remove($id)
        {
            try{

                $this->roomDAO->Remove($id);
                $this->homeController->RoomsView();

            }
            catch(\PDOException $e){

                $message = $e->getMessage();
                $this->homeController->RoomsView($message);
            }
        }

        public function Update($id, $id_cinema, $room_name, $capacity, $price)
        {
            
            try{

                $cinema = new Cinema();
                $room = new Room();

                $room->setId($id);
                $room->setName($room_name);
                $room->setCapacity($capacity);
                $room->setPrice($price);
                $room->setState(true);

                $cinema->setId($id_cinema);
                $cinema->setRoom($room);
                
                $this->roomDAO->Update($cinema);
            
                $this->homeController->RoomsView();
            }
            catch(\PDOException $e){

                $message = $e->getMessage();
                $this->homeController->RoomsView($message);
            }
        }

    }
?>