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

    public function ShowGuardianHome(){

    }

    public function Add($nombre, $apellido, $telefono, $email, $password, $direccion){

        $guardian = new Guardian($nombre, $apellido, $telefono, $email, $password, $direccion);

        $this->guardianDAO->Add($guardian);

        $this->ShowGuardianHome();
    }

}
