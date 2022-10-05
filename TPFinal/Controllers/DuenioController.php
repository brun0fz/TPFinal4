<?php

namespace Controllers;

use DAO\DuenioDAO;
use DAO\GuardianDAO;
use Models\Duenio;

class DuenioController
{
    private $duenioDAO;

    public function __construct()
    {
        $this->duenioDAO = new DuenioDAO();
    }

    public function ShowDuenioHome()
    {
        require_once(VIEWS_PATH . "duenioHome.php");
    }

    public function ShowMascotaView()
    {
        $mascotasList = $_SESSION["loggedUser"]->getListaMascotas(); //////No funciona porque no muestra la lista actualizada

        require_once(VIEWS_PATH . "list-mascotas.php");
    }

    public function ShowAddMascotaView()
    {
        require_once(VIEWS_PATH . "addMascota.php");
    }

    public function ShowListaGuardianesView()
    {
        $guardianDAO = new GuardianDAO();
        $listaGuardianes = $guardianDAO->GetAll();

        require_once(VIEWS_PATH . "list-guardianes.php");
    }

    public function Add($nombre, $apellido, $telefono, $email, $password)
    {
        $duenio = new Duenio($nombre, $apellido, $telefono, $email, $password);

        $this->duenioDAO->Add($duenio);

        $this->ShowDuenioHome();
    }

    public function AddMascota($nombre, $raza, $tamanio, $observaciones)
    {
        $this->duenioDAO->AddMascota($_SESSION["loggedUser"], $nombre, $raza, $tamanio, $observaciones);

        $this->ShowDuenioHome();

    }


}
