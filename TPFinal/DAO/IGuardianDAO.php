<?php

namespace DAO;

use Models\Guardian;

interface IGuardianDAO
{
    function Add(Guardian $guardian);
    function GetAll();
    function Buscar($email);
    function BuscarId($idGuardian);
    function UpdateDisponibilidad($idGuardian, $disponibilidad);
    function UpdateTamanios($idGuardian, $tamanios);
    function UpdatePrecio($idGuardian, $precioXDia);
    function UpdateAliasCBU($idGuardian, $aliasCBU);
    function UpdateReputacion($idReserva);
}
