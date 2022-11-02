<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use Models\Reserva;

    interface IReservaDAO
    {
        function Add(Reserva $reserva);
        function GetAll();
        function ListaReservasGuardian($idGuardian);
        function ListaReservasDuenio($idDuenio);
        function GetReservaById($idReserva);
        function GetListaReservasByEstado($idGuardian, $estado);
        function ListaReservasMascota($idMascota);
        function UpdateEstado($idReserva, $estado);
        function GetReservaGuardianxDia($idGuardian, $dia);
        function AddCupon($cupon);
        function GetCuponByIdReserva($idReserva);
        function AddReview($review);
        function GetReviewByIdReserva($idReserva);
        function getGuardianByReserva($idReserva);
    }
