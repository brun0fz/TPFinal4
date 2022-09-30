<?php

namespace Controllers;

use DAO\DuenioDAO;
use Models\Duenio;

class DuenioController
{
    private $duenioDAO;

    public function __construct()
    {
        $this->duenioDAO = new DuenioDAO();
    }

    public function Add($nombre, $apellido, $telefono, $email, $password){

        $duenio = new Duenio($nombre, $apellido, $telefono, $email, $password);

        $this->duenioDAO->Add($duenio);
    }

}
