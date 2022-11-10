<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\Reserva;

interface IReservaDAO
{
    function Add(Reserva $reserva);
    function AddReview($review);
    function AddCupon($cupon);

    function GetAll();
    function GetReservaById($idReserva);
    function GetCuponByIdReserva($idReserva);
    function GetReviewByIdReserva($idReserva);
    function GetReservaGuardianByDia($idGuardian, $dia);
    function GetListaReservasByDuenio($idDuenio);
    function GetListaReservasByGuardian($idGuardian);
    function GetListaReservasDuenioByEstado($idDuenio, $estado);
    function GetListaReservasMascotaByEstado($idMascota, $estado);
    function GetListaReservasGuardianByEstado($idGuardian, $estado);


    function UpdateEstado($idReserva, $estado);
}
