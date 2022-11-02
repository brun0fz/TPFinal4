<?php
    namespace DAO;

    use Models\Duenio as Duenio;
    use DAO\Connection as Connection;

    interface IDuenioDAO
    {
        function Add(Duenio $duenio);
        function GetAll();
        function Buscar($email);
        function BuscarId($idDuenio);
    }
