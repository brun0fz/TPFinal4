<?php

namespace Controllers;

use Couchbase\View;
use DAO\DuenioDAO;
use DAO\GuardianDAO;

class HomeController
{
    public $duenioDAO;
    public $guardianDAO;

    public function __construct()
    {
        $this->duenioDAO = new DuenioDAO;
        $this->guardianDAO = new GuardianDAO;
    }

    static function Index($mensaje = "")
    {

        if (isset($_SESSION["loggedUser"])) {
            if ($_SESSION["loggedUser"]->getTipo() == 1) {
                require_once(VIEWS_PATH . "duenioHome.php");
            } else {
                require_once(VIEWS_PATH . "guardianHome.php");
            }
        } else {
            require_once(VIEWS_PATH . "home.php");
        }
    }

    public function ShowRegisterView($type)
    {
        require_once(VIEWS_PATH . "registro.php");
    }


    public function Login($email, $password)
    {
        $duenio = $this->duenioDAO->Buscar($email);
        $guardian = $this->guardianDAO->Buscar($email);

        if (isset($duenio) && $duenio->getPassword() == $password) {

            $duenio->setPassword(NULL);
            $_SESSION["loggedUser"] = $duenio;

            require_once(VIEWS_PATH . "duenioHome.php");
        } else if (isset($guardian) && $guardian->getPassword() == $password) {

            $guardian->setPassword(NULL);
            $_SESSION["loggedUser"] = $guardian;

            require_once(VIEWS_PATH . "guardianHome.php");
        } else {
            $mensaje = "Usuario o contraseña incorrectas. Ingrese sus datos nuevamente";
            $this->Index($mensaje);
        }
    }

    public function Logout()
    {
        session_unset();
        session_destroy();
        $this->Index();
    }
}
