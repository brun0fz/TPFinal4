<?php

namespace Controllers;

use DAO\DuenioDAO;
use DAO\GuardianDAO;
use Models\Duenio;
use Models\Mascota;

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

   

    public function ShowListaGuardianesView()
    {
        if ($this->validateSession()) {
            $guardianDAO = new GuardianDAO();
            $listaGuardianes = $guardianDAO->GetAll();

            require_once(VIEWS_PATH . "list-guardianes.php");
        }
    }

    public function Add($nombre, $apellido, $telefono, $email, $password, $rutaFoto)
    {
        $guardianDAO = new GuardianDAO();

        if (($this->duenioDAO->Buscar($email) == null) && ($guardianDAO->Buscar($email) == null)) {

            $duenio = new Duenio($nombre, $apellido, $telefono, $email, $password);

            if ($rutaFoto["tmp_name"] != "") {
                $temp = $rutaFoto["tmp_name"];
                $aux = explode("/", $rutaFoto["type"]);
                $type = $aux[1];

                $name = $email . "." . $type;

                move_uploaded_file($temp, ROOT . VIEWS_PATH . "/img/" . $name);
                chmod(ROOT . VIEWS_PATH . "/img/" . $name, 0777);

                $duenio->setRutaFoto($name);

            } else {
                $duenio->setRutaFoto("undefinedProfile.png");
            }

            $this->duenioDAO->Add($duenio);

            $duenio=$this->duenioDAO->Buscar($duenio->getEmail());

            $duenio->setPassword(null);
            $_SESSION["loggedUser"] = $duenio;

            $this->ShowDuenioHome();

        } else {
            $type = 1;
            require_once(VIEWS_PATH . "registro.php");
        }

    }

}
