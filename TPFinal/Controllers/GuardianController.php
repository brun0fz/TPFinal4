<?php

namespace Controllers;

use DAO\DuenioDAO;
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

    public function ShowConfiguracionView()
    {
        if($this->validateSession()){
            $disponibilidad = $_SESSION["loggedUser"]->getDisponibilidad();
            $tamanioArray = $_SESSION["loggedUser"]->getTamanioMascotaCuidar();
            require_once(VIEWS_PATH . "set-configuracion.php");
        }
    }

    public function Add($nombre, $apellido, $telefono, $email, $password, $direccion, $rutaFoto)
    {
        $duenioDAO = new DuenioDAO();

        if (($duenioDAO->Buscar($email) == null) && ($this->guardianDAO->Buscar($email) == null)) {

            $guardian = new Guardian($nombre, $apellido, $telefono, $email, $password, $direccion);

            if ($rutaFoto["tmp_name"] != "") {
                $temp = $rutaFoto["tmp_name"];
                $aux = explode("/", $rutaFoto["type"]);
                $type = $aux[1];

                $name = $email . "." . $type;

                move_uploaded_file($temp, ROOT . VIEWS_PATH . "/img/" . $name);
                chmod(ROOT . VIEWS_PATH . "/img/" . $name, 0777);

                $guardian->setRutaFoto($name);
            } else {
                $guardian->setRutaFoto("undefinedProfile.png");
            }

            $this->guardianDAO->Add($guardian);

            $guardian->setPassword(null);
            $_SESSION["loggedUser"] = $guardian;

            $this->ShowGuardianHome();

        } else {
            $type = 2;
            require_once(VIEWS_PATH . "registro.php");
        }

    }

    public function setDisponibilidad($dias = array())
    {
        if ($this->validateSession()) {
            $_SESSION["loggedUser"]->setDisponibilidad($dias);
            $this->guardianDAO->UpdateDisponibilidad($dias, $_SESSION["loggedUser"]);
            $this->ShowConfiguracionView();
        }
    }

    public function setTamanios($tamanios = array())
    {
        if ($this->validateSession()) {
            $_SESSION["loggedUser"]->setTamanioMascotaCuidar($tamanios);
            $this->guardianDAO->UpdateTamanios($tamanios, $_SESSION["loggedUser"]);
            $this->ShowConfiguracionView();
        }
    }

    public function setPrecio($precio = null)
    {
        if ($this->validateSession()) {
            $_SESSION["loggedUser"]->setPrecioXDia($precio);
            $this->guardianDAO->UpdatePrecio($precio, $_SESSION["loggedUser"]);
            $this->ShowConfiguracionView();
        }
    }

}
