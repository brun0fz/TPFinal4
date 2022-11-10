<?php

namespace Controllers;

use Couchbase\View;
use DAO\DuenioDAO;
use DAO\GuardianDAO;
use Exception;
use Models\Duenio;

class HomeController
{
    public $duenioDAO;
    public $guardianDAO;

    public function __construct()
    {
        $this->duenioDAO = new DuenioDAO;
        $this->guardianDAO = new GuardianDAO;
    }

    static function Index($alert = "")
    {
        if (isset($_SESSION["loggedUser"])) {
            if ($_SESSION["loggedUser"]->getTipo() == 1) {
                $duenioController = new DuenioController();
                $duenioController->ShowDuenioHome();
                //require_once(VIEWS_PATH . "home-duenio.php");
            } else {
                require_once(VIEWS_PATH . "home-guardian.php");
            }
        } else {
            require_once(VIEWS_PATH . "home.php");
        }
    }

    public function ShowRegisterView($type, $alert = "")
    {
        require_once(VIEWS_PATH . "registro.php");
    }


    public function Login($email, $password)
    {
        try {

            $duenio = $this->duenioDAO->GetDuenioByEmail($email);
            $guardian = $this->guardianDAO->GetGuardianByEmail($email);

            if (isset($duenio) && $duenio->getPassword() == $password) {

                $duenio->setPassword(NULL);
                $_SESSION["loggedUser"] = $duenio;

                $duenioController = new DuenioController();
                $duenioController->ShowDuenioHome();
                //require_once(VIEWS_PATH . "home-duenio.php");
            } else if (isset($guardian) && $guardian->getPassword() == $password) {

                $guardian->setPassword(NULL);
                $_SESSION["loggedUser"] = $guardian;

                require_once(VIEWS_PATH . "home-guardian.php");
            } else {
                $alert = "Usuario o contrase&ntilde;a incorrectos. Ingrese sus datos nuevamente.";
                $this->Index($alert);
            }
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    public function Logout()
    {
        session_unset();
        session_destroy();
        $this->Index();
    }
}
