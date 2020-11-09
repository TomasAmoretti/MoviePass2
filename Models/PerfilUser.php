<?php

namespace Models;

use Models\User as User;

class PerfilUser {

    private $id;
    private $firstName;
    private $lastName;
    private $dni;  

    private $user;


    //Getters
    public function getId(){
        return $this->id;
    }
    public function getFirstName(){
        return $this->firstName;
    }
    public function getLastName(){
        return $this->lastName;
    }
    public function getDni(){
        return $this->dni;
    }
    public function getUser(){
        return $this->user;
    }

    //Setters
    public function setId($id){
        $this->id = $id;
    }
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }
    public function setLastName($lastName){
        $this->lastName = $lastName;
    }
    public function setDni($dni){
        $this->dni = $dni;
    }
    public function setUser($user){
        $this->user = $user;
    }

}
?>