<?php

namespace Controllers;

use DAO\DuenioDAO;

class HomeController
{
    public $duenioDAO;
    //guardianDAO

    public function __construct()
    {
        $this->duenioDAO = new DuenioDAO;
    }

    public function Index($message = "")
    {

        require_once(VIEWS_PATH . "home.php");
    }

    public function ShowRegisterView($type){
        require_once(VIEWS_PATH . "registro.php");
    }

    public function ShowDuenioView()
    {
        $loggedDuenio = $_SESSION["loggedUser"];

        require_once(VIEWS_PATH . "duenioView.php");
    }

    public function Login($email, $password)
    {
        echo $email;
        echo $password;
        /*
        $duenio = $this->duenioDAO->Buscar($email);

        if (isset($duenio)) {
            if ($duenio->getPassword == $password) {

                $_SESSION["loggedDuenio"] = $duenio;
            } else {
                $this->Index();
            }

            $this->ShowDuenioView();
        } else {
            $this->Index("");
        }*/
    }


}
