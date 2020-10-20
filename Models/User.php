<?php
namespace Models;

include("PerfilUser.php");

class User extends PerfilUser{

    private $email;       //string
    private $password;   //string
    private $rol;    

    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getRol(){
        return $this->rol;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setRol($rol){
        $this->rol = $rol;
    }
}



?>