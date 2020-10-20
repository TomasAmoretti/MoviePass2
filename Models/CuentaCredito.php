<?php 
namespace Models;

class CuentaCredito{

    private $empresa; //string

    public function getEmpresa(){
        return $this->empresa;
    }
    
    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }
}

?>