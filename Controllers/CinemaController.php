<?php
    namespace Controllers;

    use \PDOException as PDOException;
    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;
    use Controllers\HomeController as HomeController;

    class CinemaController
    {
        private $cinemaDAO;
        private $homeController;
        
        //Método constructor.
        public function __construct()
        {
            $this->cinemaDAO = new CinemaDAO();
            $this->homeController = new HomeController();
        }
        
        //Método para recibir todos los cines en un array.
        public function GetAll(){

            try{

                $cinemasArray = $this->cinemaDAO->GetAll();
                return $cinemasArray;
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

                $this->cinemaDAO->Update($cinema);

                $this->homeController->CinemasView();
            }     
            catch(\PDOException $e){
          
                $message = $e->getMessage();
                $this->homeController->CinemasView($message);
            }
        }

        
    }
?>