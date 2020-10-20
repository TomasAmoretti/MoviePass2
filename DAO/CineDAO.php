<?php
    namespace DAO;

    use DAO\ICineDAO as ICineDAO;
    use Models\Cine as Cine;

    class CineDAO implements ICineDAO
    {
        private $cinesList = array();
        private $fileName = ROOT."Data/Cines.json";


        public function Add(Cine $cine)
        {
            $this->RetrieveData();
            
            array_push($this->cinesList, $cine);

            $this->SaveData();
        }

        public function GetAll()
        {
            return $this->cinesList;
        }

        public function Remove($contadorId)
        {
            $this->RetrieveData();
            
            unset($this->cinesList[$contadorId]);

            $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cinesList as $cine)
            {
                $valuesArray = array();
                $valuesArray["nombre"] = $cine->getNombre();
                $valuesArray["direccion"] = $cine->getDireccion();
                $valuesArray["capacidad"] = $cine->getCapacidad();
                $valuesArray["valor-entrada"] = $cine->getValorEntrada();

                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function RetrieveData()
        {
             $this->userList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                     $cine = new Cine();
                     $cine->setNombre($content["nombre"]);
                     $cine->setDireccion($content["direccion"]);
                     $cine->setCapacidad($content["capacidad"]);
                     $cine->setValorEntrada($content["valor-entrada"]);
            
                     array_push($this->cinesList, $cine);
                 }
             }
        }  
    }
?>