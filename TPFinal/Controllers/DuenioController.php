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

    private function validateSession()
    {
        if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getTipo() == 1) {
            return true;
        } else {
            HomeController::Index();
        }

    }

    public function ShowDuenioHome()
    {
        $this->validateSession() && require_once(VIEWS_PATH . "duenioHome.php");

    }

    public function ShowMascotaView()
    {
        if ($this->validateSession()) {
            $mascotasList = $_SESSION["loggedUser"]->getListaMascotas(); //////No funciona porque no muestra la lista actualizada

            require_once(VIEWS_PATH . "list-mascotas.php");
        }
    }

    public function ShowAddMascotaView()
    {
        if ($this->validateSession()) {
            require_once(VIEWS_PATH . "addMascota.php");
        }
    }

    public function ShowListaGuardianesView()
    {
        if ($this->validateSession()) {
            $guardianDAO = new GuardianDAO();
            $listaGuardianes = $guardianDAO->GetAll();

            require_once(VIEWS_PATH . "list-guardianes.php");
        }
    }

    public function Add($nombre, $apellido, $telefono, $email, $password)
    {
        if ($this->validateSession()) {
            $duenio = new Duenio($nombre, $apellido, $telefono, $email, $password);
            $duenio->setTipo(1);

            $this->duenioDAO->Add($duenio);

            $this->ShowDuenioHome();
        }
    }

    public function AddMascota($nombre, $raza, $tamanio, $observaciones)
    {
        if ($this->validateSession()) {
            $this->duenioDAO->AddMascota($_SESSION["loggedUser"], $nombre, $raza, $tamanio, $observaciones);

            $this->ShowDuenioHome();
        }

    }


}
