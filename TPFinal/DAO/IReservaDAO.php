<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use Models\Reserva;

    interface IReservaDAO
    {
        function Add(Reserva $reserva);
        function GetAll();
    }
