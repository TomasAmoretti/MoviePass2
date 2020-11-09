<?php
    namespace Controllers;

    use \Exception as Exception;
    use \PDOException as PDOException;
    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;
    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;
    use DAO\RoomDAO as RoomDAO;
    use Models\Room as Room;
    use DAO\ShowDAO as ShowDAO;
    use Models\Show as Show;

    use Controllers\HomeController as HomeController;


    class ShowController
    {
        private $cinemaDAO;
        private $roomDAO;
        private $movieDAO;
        private $showDAO;
        private $homeControlles;

        public function __construct()
        {
            $this->cinemaDAO = new CinemaDAO();
            $this->movieDAO = new MovieDAO();
            $this->showDAO = new ShowDAO();
            $this->roomDAO = new RoomDAO();
            $this->homeController = new HomeController();
        }

        
        public function GetAll($validMessage = null){

            try{

                $showsList = $this->showDAO->GetAll();
                $message = $validMessage;
                
                return  $showsList;

            }
            catch(\PDOException $e){
           
                $message = $e->getMessage();
                $this->homeController->ShowsViewAdmin($message);
                return null;
            }
        }

        public function GetById($id_show, $validMessage = null){

            try{
                $show = $this->showDAO->GetById($id_show);

                $message = $validMessage;
                
                return  $show;
            }
            catch(\PDOException $e){
           
                $message = $e->getMessage();
                $this->homeController->MovieDescription($message);
                return null;
            }
        }
        
        public function GetTable($validMessage = null){

            try{

                $showsList = $this->showDAO->GetTable();
                $message = $validMessage;
                
                return  $showsList;

            }
            catch(\PDOException $e){
           
                $message = $e->getMessage();
                $this->homeController->ShowsViewAdmin($message);
                return null;
            }
        }



        public function Add($id_movie, $id_room, $day, $hour){

            try{

                $show = new Show();  

                $room = $this->roomDAO->GetById($id_room);
         
                $show->setRoom($room);
                $show->setIdMovie($id_movie);
                $show->setDay($day);
                $show->setHour($hour);
                $show->setState(true);

                $this->showDAO->Add($show);

                $this->homeController->ShowsViewAdmin();

            }
            catch(Exception $ex){
                $message = $ex->getMessage();
                $this->homeController->ShowsViewAdmin($message);
            }
            catch(\PDOException $e) {

                $message = "ERROR!! Solo se permite agregar una Pelicula por Sala por Dia";
                $this->homeController->ShowsViewAdmin($message);
            }
        }

        public function Remove($id)
        {
            try{

                $this->showDAO->Remove($id);

            }
            catch(\PDOException $e){

                $message = $e->getMessage();
                $this->homeController->ShowsViewAdmin($message);
            }
        }

        public function getMovieByDate($day){
            
            try{

                return $showsList = $this->showDAO->getByDate($day);
    
            }
            catch(\PDOException $e){

                $message = $e->getMessage();
                $this->homeController->MovieListByDate($message);
            }
        }


        public function validateHour($day,$hour){

            $cinemaList = $this->cinemaDAO->GetAll();
           /*showlist get all*/ 
            $hrs = $this->hourToDecimal($hour);

            foreach($scheduleList as $schedule){
                foreach($cinemaList as $cinema){

                    if($cinema->getId() === $schedule->getIdCinema()){

                        if($day === $schedule->getDay()){

                            $scheduleHour = $this->hourToDecimal($schedule->getHour());
        
                            if($hrs == $scheduleHour ||  $hrs >  ($scheduleHour+2.25)|| $hrs <  ($scheduleHour+2.25) ){
        
                                throw new Exception("El horario no esta disponible!");
                            }
                        }
                    }
                }
           }
        }

        private function hourToDecimal($time)
        {
            $hms = explode(":", $time);
            return ($hms[0] + ($hms[1]/60) );
        }


        


    }
?>