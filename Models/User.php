<?php
namespace Models;

use Models\Rol as Rol;

class User{

    private $email;    
    private $password;   
    private $exist;

    private $rol;   


    //Getters
    public function getId(){
        return $this->id;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getExist(){
        return $this->exist;
    }

    public function getRol(){
        return $this->rol;
    }

    //Setters
    public function setId($id){
        $this->id = $id;
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