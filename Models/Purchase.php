<?php

namespace Models;

use Models\Payment as Payment;


class Purchase{

    private $id;
    private $id_user;
    private $show;
    private $number_ticket; //int
    private $discount; //int
    private $date; //date 
    private $total; // int



    //Getters
    public function getId(){
        return $this->id;
    }
    public function getIdUser(){
        return $this->id_user;
    }
    public function getShow(){
        return $this->show;
    }
    public function getCountTicket(){
        return $this->number_ticket;
    }
    public function getDiscount(){
        return $this->discount;
    }
    public function getDate(){
        return $this->date;
    }
    public function getTotal(){
        return $this->total;
    }

 
    //Setters
    public function setId($id){
        $this->id = $id;
    }
    public function setIdUser($id_user){
        $this->id_user = $id_user;
    }
    public function setShow($show){
        $this->show = $show;
    }
    public function setCountTicket($number_ticket){
        $this->number_ticket = $number_ticket;
    }
    public function setDiscount($discount){
        $this->discount = $discount;
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setTotal($total){
        $this->total = $total;
    }
   
}

?>