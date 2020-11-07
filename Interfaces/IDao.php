<?php

    namespace Interfaces;

    interface IDao{

        function Add($value);
        function Remove($id);
        function GetAll();
        //function GetById($id);
        function Update($value);

    }








?>