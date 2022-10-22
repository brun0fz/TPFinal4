<?php

namespace Controllers;

use DAO\GuardianDAO;
use DAO\MascotaDAO;
use DAO\ReservaDAO;

class ReservaController
{

    private $mascotaDAO;
    private $guardianDAO;
    private $reservaDAO;

    public function __construct()
    {
        $this->mascotaDAO = new MascotaDAO();
        $this->guardianDAO = new GuardianDAO();
        $this->reservaDAO = new ReservaDAO();
    }

    public function ShowAddReservaView($idGuardian, $fechaInicio, $fechaFin)
    {
        $guardian = $this->guardianDAO->BuscarId($idGuardian);
        $mascotaList = $this->mascotaDAO->ListaDuenio($_SESSION["loggedUser"]->getId());
        require_once(VIEWS_PATH . "add-reserva.php");
    }

    public function Add()
    {


    }
}
