<?php

namespace Controllers;

use DAO\GuardianDAO;
use Models\Guardian;

class GuardianController
{
    private $guardianDAO;

    public function __construct()
    {
        $this->guardianDAO = new GuardianDAO();
    }

    public function ShowGuardianHome()
    {
        require_once(VIEWS_PATH . "guardianHome.php");
    }

    public function Add($nombre, $apellido, $telefono, $email, $password, $direccion)
    {


        $guardian = new Guardian($nombre, $apellido, $telefono, $email, $password, $direccion);

        $guardian->setTipo(2);

        $this->guardianDAO->Add($guardian);

        $this->ShowGuardianHome();
    }


    public function ShowDisponibilidadView()
    {
        require_once(VIEWS_PATH . "set-disponibilidad.php");
    }

    public function setDisponibilidad($dias)
    {
        $this->guardianDAO->UpdateDisponibilidad($dias, $_SESSION["loggedUser"]);
        $this->ShowGuardianHome();
    }


}
