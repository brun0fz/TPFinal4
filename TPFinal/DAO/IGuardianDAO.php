<?php

namespace DAO;

use Models\Guardian;

interface IGuardianDAO
{
    function Add(Guardian $guardian);
    
    function GetAll();
    function GetGuardianByEmail($email);
    function GetGuardianById($idGuardian);

    function UpdateDisponibilidad($idGuardian, $disponibilidad);
    function UpdateTamanios($idGuardian, $tamanios);
    function UpdatePrecio($idGuardian, $precioXDia);
    function UpdateReputacion($idReserva);
}
