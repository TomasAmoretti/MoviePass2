<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAO;
    use Models\Cine as Cine;

    class CineController
    {
        private $cineDAO;

        public function __construct()
        {
            $this->cineDAO = new CineDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $cinesList = $this->cineDAO->GetAll();
            require_once(VIEWS_PATH."admin-cines.php");
        }

        public function ShowListView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $cinesList = $this->cineDAO->GetAll();
            require_once(VIEWS_PATH."admin-cines.php");
        }

        public function Add($nombre, $direccion, $capacidad, $valorEntrada)
        {
            require_once(VIEWS_PATH."validate-session.php");

            $cine = new Cine();
            $cine->setNombre($nombre);
            $cine->setDireccion($direccion);
            $cine->setCapacidad($capacidad);
            $cine->setValorEntrada($valorEntrada);

            $this->cineDAO->Add($cine);

            $this->ShowAddView();
        }

        
        public function Remove($id)
        {
            require_once(VIEWS_PATH."validate-session.php");
            
            $this->cineDAO->Remove($id);

            $this->ShowListView();
        }

    }
?>