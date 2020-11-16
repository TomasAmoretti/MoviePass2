<?php
    namespace Controllers;

    use \PDOException as PDOException;
    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;
    use Controllers\HomeController as HomeController;
    use Models\Show as Show;
    use DAO\ShowDAO as ShowDAO;
    use Models\Room as Room;
    use DAO\RoomDAO as RoomDAO;

    class CinemaController
    {
        private $cinemaDAO;
        private $homeController;
        private $showDAO;
        private $roomDAO;
        
        //Método constructor.
        public function __construct()
        {
            $this->cinemaDAO = new CinemaDAO();
            $this->homeController = new HomeController();
            $this->showDAO = new ShowDAO();
            $this->roomDAO = new RoomDAO();
        }
        
        //Método para recibir todos los cines en un array.
        public function GetAll(){

            try{
                
                $cinemasArray = $this->cinemaDAO->GetAll();
                $newcinemasArray = array();
                foreach($cinemasArray as $cinemas){
                    if($cinemas->getState()){
                        array_push($newcinemasArray, $cinemas);
                    }
                }
                return $newcinemasArray;
            }
            catch(\PDOException $e){
            
                $message = $e->getMessage();
                $this->homeController->CinemasView($message);
                return null;
            }

            
        }

        // Setea valores del cine a agregar, lo marca como "disponible" y lo agrega.
        public function Add($name, $adress)
        {
            try{
                $this->validateCinema($name, $adress);

                $cinema = new Cinema();
                $cinema->setName($name);
                $cinema->setAdress($adress);
                $cinema->setState(true);
    
                $this->cinemaDAO->Add($cinema);
                $this->homeController->CinemasView();

            }
            catch(\PDOException $e){

                $message = $e->getMessage();
                $this->homeController->CinemasView($message);
            }
        }

        //
        public function Middleware($name, $adress, $id)
        {
            if(empty($id)){
                $this->Add($name, $adress);
            } else {
                $this->Update($id, $name, $adress);
            }

        }

        //Remueve un cine a través de la ID.
        public function Remove($id)
        {
            try{

                $this->validateRoomShow($id);
                $this->cinemaDAO->Remove($id);
                $this->homeController->CinemasView();
            }     
            catch(\PDOException $e){
          
                $message = $e->getMessage();
                $this->homeController->CinemasView($message);
            }
        }

        //Actualiza los datos de un cine.
        public function Update($id, $name, $adress )
        {
            try{
                $cinema = new Cinema();
                $cinema->setId($id);
                $cinema->setName($name);
                $cinema->setAdress($adress);
                $cinema->setState(true);

                $this->cinemaDAO->Update($cinema);

                $this->homeController->CinemasView();
            }     
            catch(\PDOException $e){
          
                $message = $e->getMessage();
                $this->homeController->CinemasView($message);
            }
        }
        
        //Valida el cine acorde a si el nombre o la direccion ya existe
        private function validateCinema($name, $adress){

            $cinemaList = $this->cinemaDAO->GetAll();
            $cinemaName = str_replace(' ', '', $name);
            $cinemaAdress = str_replace(' ', '', $adress);
            foreach($cinemaList as $cinema){

                $cinemaNameBDD = str_replace(' ', '', $cinema->getName());
                $cinemaAdressBDD = str_replace(' ', '', $cinema->getAdress());
                if((strcasecmp($cinemaName, $cinemaNameBDD) == 0) || (strcasecmp($cinemaAdress, $cinemaAdressBDD) == 0)){
                    if($cinema->getState()){
                        throw new PDOException("El nombre del cine ya existe o la direccion ya se encuentra cargada en algun cine");
                    }else{ //Si el nombre o la direccion ya existe, pero el cine esta desactivado. Lo volvemos a activar con los datos nuevos que paso el usuario
                        $this->Middleware($name, $adress, $cinema->getId());
                    }
                }
            }
        }


        private function validateRoomShow($idCinema){

            try{

                $cinema = $this->cinemaDAO->GetById($idCinema);
                $cinemaName = $cinema->getName();
                $validation = false;
                $roomList = $this->roomDAO->GetAll();
                $showList = $this->showDAO->GetTable();
                foreach($roomList as $room){
 
                    if($room['cinema_name'] == $cinemaName){
                        if($showList){
                            foreach($showList as $show){
                                if($show["room_name"] == $room['room_name'] && $show['state'] == true){
                                    $validation = true;
                                    throw new PDOException("No se puede borrar un cine que contiene funciones activas");
                                }
                            }
                            if($validation){
                                $this->roomDAO->Remove($room['id_room']);
                            }
                        }
                    }
                }
            }
            catch(PDOException $ex){
                throw $ex;
            }
        
        }

        
    }
