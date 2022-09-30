<?php

namespace Controllers;

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

    public function Index($message = "")
    {

        require_once(VIEWS_PATH . "home.php");
    }

    public function ShowRegisterView($type)
    {
        require_once(VIEWS_PATH . "registro.php");
    }

    public function ShowDuenioView()
    {
        $loggedDuenio = $_SESSION["loggedUser"];

        require_once(VIEWS_PATH . "duenioHome.php");
    }

    public function ShowGuardianView()
    {
        $loggedGuardian = $_SESSION["loggedUser"];

        require_once(VIEWS_PATH . "guardianHome.php");
    }

    public function Login($email, $password)
    {
        $duenio = $this->duenioDAO->Buscar($email);
        $guardian = $this->guardianDAO->Buscar($email);

        var_dump($guardian);

        if (isset($duenio)) {
            if ($duenio->getPassword() == $password) {

                $_SESSION["loggedUser"] = $duenio;

                $this->ShowDuenioView();
            } else {
                $this->Index();
            }

            $this->ShowDuenioView();
        }else if(isset($guardian)){
            if ($guardian->getPassword() == $password) {

                $_SESSION["loggedUser"] = $guardian;

                $this->ShowGuardianView();
            } else {
                $this->Index();
            }
        }else{
            $this->Index();
        }
    }
}
