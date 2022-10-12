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

    private function validateSession()
    {
        if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getTipo() == 2) {
            return true;
        } else {
            HomeController::Index();
        }

    }

    public function ShowGuardianHome()
    {
        $this->validateSession() && require_once(VIEWS_PATH . "guardianHome.php");
    }

    public function ShowDisponibilidadView()
    {
        $this->validateSession() && require_once(VIEWS_PATH . "set-disponibilidad.php");
    }

    public function Add($nombre, $apellido, $telefono, $email, $password, $direccion, $rutaFoto)
    {
        $guardian = new Guardian($nombre, $apellido, $telefono, $email, $password, $direccion);

        if ($rutaFoto["tmp_name"] != "") {
            $temp = $rutaFoto["tmp_name"];
            $aux = explode("/", $rutaFoto["type"]);
            $type = $aux[1];

            $name = $nombre . "-" . $apellido . "." . $type;

            move_uploaded_file($temp, ROOT . VIEWS_PATH . "/img/" . $name);
            chmod(ROOT . VIEWS_PATH . "/img/" . $name, 0777);

            $guardian->setRutaFoto($name);
        }
        else{
            $guardian->setRutaFoto("undefinedProfile.png");
        }

        $this->guardianDAO->Add($guardian);

        $guardian->setPassword(null);
        $_SESSION["loggedUser"] = $guardian;

        $this->ShowGuardianHome();
    }

    public function setDisponibilidad($dias)
    {
        if ($this->validateSession()) {
            $_SESSION["loggedUser"]->setDisponibilidad($dias);
            $this->guardianDAO->UpdateDisponibilidad($dias, $_SESSION["loggedUser"]);
            $this->ShowDisponibilidadView();
        }
    }

}
