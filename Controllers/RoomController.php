<?php
    namespace Controllers;

    use \Exception as Exception;
    use \PDOException as PDOException;
    use Models\Cinema as Cinema;
    use DAO\CinemaDAO as CinemaDAO;
    use Models\Room as Room;
    use DAO\RoomDAO as RoomDAO;
    use Models\Show as Show;
    use DAO\ShowDAO as ShowDAO;
    
    
    use Controllers\HomeController as HomeController;


    class RoomController
    {
        private $roomDAO;
        private $cinemaDAO;
        private $homeController;
        private $showDAO;

        public function __construct()
        {
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->homeController = new HomeController();
            $this->showDAO = new ShowDAO();
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

                $this->validateNameIsString($room_name);
                $this->validateNameRoom($room_name, $id_cinema);

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

                $this->validateRoomShow($id);
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

                $this->validateNameIsString($room_name);
                $this->validateChangeCinema($room_name, $id_cinema);
                $this->validateNameRoom($room_name, $id_cinema);
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

        private function validateNameIsString($name){

            if(!is_string($name)){
                throw new PDOException("El nombre ingresado no es valido");
            }
        }

        private function validateNameRoom($name, $idCinema){

            $roomList = $this->roomDAO->GetAll();
            $roomName = str_replace(' ', '', $name);
            foreach($roomList as $room){

                if($room['id_cinema'] == $idCinema){
                    $roomNameBDD = str_replace(' ', '', $room['room_name']);
                    if(strcasecmp($roomName, $roomNameBDD) == 0){
                        throw new PDOException("El nombre del cine ya existe");
                    }
                }
            }
        }

        private function validateRoomShow($idRoom){

            $showList = $this->showDAO->GetTable();
            $roomList = $this->roomDAO->GetAll();
            foreach($roomList as $room){

                foreach($showList as $show){

                    if($room['cinema_name'] == $show['cinema_name']){

                        if($show['id_room'] == $idRoom){
            
                            throw new PDOException("La sala no se puede eliminar porque tiene funciones");
                        }
                    } 
                }
            }
            
        }

        private function validateChangeCinema($roomName, $idCinema){

            $showList = $this->showDAO->GetTable();
            $cinemaList = $this->cinemaDAO->GetAll();
            $roomList = $this->roomDAO->GetAll();

            foreach($cinemaList as $cinema){

                foreach($showList as $show){

                    if($cinema->getId() == $idCinema){

                        if(($show['room_name'] == $roomName)&&($show['cinema_name'] == $cinema->getName())){

                            echo "La sala no se puede cambiar de cine porque tiene funciones";
                            throw new PDOException("La sala no se puede cambiar de cine porque tiene funciones");

                        }
                    }
                }
                foreach($roomList as $room){

                    if($cinema->getId() == $idCinema){

                        if($room['room_name'] == $roomName){

                            echo "El cine ya posee una sala con ese nombre";
                            throw new PDOException("El cine ya posee una sala con ese nombre");
                        }
                    }
                }

            }
        }

    }
?>