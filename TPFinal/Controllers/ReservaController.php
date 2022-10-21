<?php

namespace Controllers;

use DAO\GuardianDAO;
use DAO\MascotaDAO;

class ReservaController
{

    private $mascotaDAO;
    private $guardianDAO;

    public function __construct()
    {
        $this->mascotaDAO = new MascotaDAO();
        $this->guardianDAO = new GuardianDAO();
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
