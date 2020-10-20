<?php
    namespace DAO;

    use Models\Cine as Cine;

    interface ICineDAO
    {
        function Add(Cine $cine);
        function GetAll();

    }
?>