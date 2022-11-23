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

    public function ShowRecuperarContraseniaView($alert = "")
    {
        require_once(VIEWS_PATH . "recuperar-contrasenia.php");
    }

    static function ShowErrorView()
    {
        require_once(VIEWS_PATH . "error.php");
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
            } else if (isset($guardian) && $guardian->getPassword() == $password) {

                $guardian->setPassword(NULL);
                $_SESSION["loggedUser"] = $guardian;

                require_once(VIEWS_PATH . "home-guardian.php");
            } else {
                $alert = "Usuario o contrase&ntilde;a incorrectos. Ingrese sus datos nuevamente.";
                $this->Index($alert);
            }
        } catch (Exception $ex) {
            HomeController::ShowErrorView();
        }
    }

    public function Logout()
    {
        session_unset();
        session_destroy();
        $this->Index();
    }

    public function RecuperarContrasenia($email)
    {
        try {

            $duenio = $this->duenioDAO->GetDuenioByEmail($email);
            $guardian = $this->guardianDAO->GetGuardianByEmail($email);

            if (isset($duenio)) {
                MAILCONTROLLER::MailRecuperarContrasenia($duenio);
            } else if (isset($guardian)) {
                MAILCONTROLLER::MailRecuperarContrasenia($guardian);
            }

            $this->ShowRecuperarContraseniaView("Si la direccion ingresada es valida, recibira su contrase&ntilde;a en su correo electronico.");
        } catch (Exception $ex) {
            HomeController::ShowErrorView();
        }
    }
}
