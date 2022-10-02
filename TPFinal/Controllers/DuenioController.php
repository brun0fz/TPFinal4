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

    public function ShowDuenioHome(){

        require_once(VIEWS_PATH . "duenioHome.php");
    }

    public function ShowMascotaView(){

        $mascotaList = $_SESSION["loggedUser"]->getListaMascotas();

        print_r($mascotaList);
    }

    public function Add($nombre, $apellido, $telefono, $email, $password){

        $duenio = new Duenio($nombre, $apellido, $telefono, $email, $password);

        $this->duenioDAO->Add($duenio);

        $this->ShowDuenioHome();
    }

    public function AddMascota(){

        $this->duenioDAO->AddMascota( $_SESSION["loggedUser"]);
    }

}
