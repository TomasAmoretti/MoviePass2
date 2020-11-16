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


    public function GetAll($validMessage = null)
    {

        try {

            $showsList = $this->showDAO->GetAll();
            $validShows = array();
            foreach($showsList as $show){
                if($show->getState()){
                    array_push($validShows, $show);
                }
            }
            $message = $validMessage;
            var_dump($showsList);

            return  $validShows;
        } catch (\PDOException $e) {

            $message = $e->getMessage();
            $this->homeController->ShowsViewAdmin($message);
            return null;
        }
    }

    public function GetById($id_show, $validMessage = null)
    {

        try {
            $show = $this->showDAO->GetById($id_show);

            $message = $validMessage;

            return  $show;
        } catch (\PDOException $e) {

            $message = $e->getMessage();
            $this->homeController->MovieDescription($message);
            return null;
        }
    }

    public function GetTable($validMessage = null)
    {

        try {

            $showsList = $this->showDAO->GetTable();
            $validShows = array();
            foreach($showsList as $show){
                if($show['state']){
                    array_push($validShows, $show);
                }
            }
            $this->validateHourAndDay($validShows);
            $message = $validMessage;

            return  $validShows;
        } catch (\PDOException $e) {

            $message = $e->getMessage();
            $this->homeController->ShowsViewAdmin($message);
            return null;
        }
    }



    public function Add($id_movie, $id_room, $day, $hour)
    {

        try {

            $this->validateHour($day, $hour, $id_movie);


            $show = new Show();

            $room = $this->roomDAO->GetById($id_room);

            $show->setRoom($room);
            $show->setIdMovie($id_movie);
            $show->setDay($day);
            $show->setHour($hour);
            $show->setState(true);

            $this->showDAO->Add($show);

            $this->homeController->ShowsViewAdmin();
        } catch (Exception $ex) {
            $message = $ex->getMessage();
            $this->homeController->ShowsViewAdmin($message);
        } catch (PDOException $e) {

            $message = $e->getMessage();
            $this->homeController->ShowsViewAdmin($message);
        }
    }

    public function Remove($id)
    {
        try {

            $this->showDAO->Remove($id);

            $this->homeController->ShowsViewAdmin();
        } catch (\PDOException $e) {

            $message = $e->getMessage();
            $this->homeController->ShowsViewAdmin($message);
        }
    }

    public function getMovieByDate($day)
    {

        try {

            return $showsList = $this->showDAO->getByDate($day);
        } catch (\PDOException $e) {

            $message = $e->getMessage();
            $this->homeController->MovieListByDate($message);
        }
    }

    public function validateHour($day, $hour, $idMovie)
    {

        $roomList = $this->roomDAO->GetAll();
        $hrs = $this->hourToDecimal($hour); //A que hora empieza la pelicula que quiero cargar
        $newMovie = $this->movieDuration($idMovie, $hrs); //A que hora termina la pelicula que quiero cargar
        $showList = $this->showDAO->GetTable();

        foreach ($showList as $show) {

            foreach ($roomList as $room) {

                if ($room['cinema_name'] == $show['cinema_name']) {

                    if (($day == $show['day']) && ($hour != $show['hour']) && ($idMovie == $show['id_movie'])) {
                        throw new PDOException("Esta pelicula ya esta cargada en este cine y en este dia!");
                    }
                    if ($room['room_name'] == $show['room_name']) {

                        if ($day == $show['day']) {

                            $showHour = $this->hourToDecimal($show['hour']); //A que hora empieza la pelicula que esta en la cartelera en el mismo dia
                            $endMovie = $this->movieDuration($show['id_movie'], $showHour); //A que hora termina la pelicula que esta en la cartelera en el mismo dia

                            if ($newMovie < $showHour) {
                                return $message = "La pelicula fue cargada con exito";
                                //throw new PDOException("La pelicula fue cargada con exito");
                            } elseif ($hrs > $endMovie) {
                                return $message = "La pelicula fue cargada con exito";
                                //throw new PDOException("La pelicula fue cargada con exito");
                            } else {
                                throw new PDOException("El horario no esta disponible!");
                            }
                        }
                    }
                }
            }
        }
    }

    //Obtiene la duracion de la pelicula, le agrega los 15 minutos que hay entre las peliculas
    // y se lo suma al horario en el que empieza la pelicula para asi saber cuando termina
    public function movieDuration($idMovie, $showHour)
    {

        $duration = $this->movieDAO->retrieveDurationOneMovieFromApi($idMovie);
        $descanso = $duration + 15;
        $total = $showHour + $descanso;
        return $total;
    }

    //Convierte la hora en decimal
    private function hourToDecimal($time)
    {
        $hms = explode(":", $time);
        return (($hms[0] * 60) + $hms[1]);
    }

    private function validateHourAndDay($showsList)
    {
        date_default_timezone_set("America/Argentina/Buenos_Aires"); //setea a la zona horaria correspondiente (por defecto viene en GMT)
        $date = getdate();
        $time = time() + (7 * 24 * 60 * 60);
        $hourLocale = (($date['hours'] * 60) + ($date['minutes']));

        foreach ($showsList as $show) {

            if ($show['day'] <= date('Y-m-d')) {

                $hourShow = $this->hourToDecimal($show['hour']);
                if ($hourShow < $hourLocale) {
                    if ($show['state']) {
                        $this->Remove($show['id_show']);
                    }
                }
            }
        }
    }
}
