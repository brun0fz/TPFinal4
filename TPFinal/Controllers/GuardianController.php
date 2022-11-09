<?php

namespace Controllers;

use DAO\DuenioDAO;
use DAO\GuardianDAO;
use DAO\ReservaDAO;
use Models\Guardian;
use Exception;

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
        $this->validateSession() && require_once(VIEWS_PATH . "home-guardian.php");
    }

    public function ShowConfiguracionView($alert = "")
    {
        if ($this->validateSession()) {
            $disponibilidad = $_SESSION["loggedUser"]->getDisponibilidad();
            $tamanioArray = $_SESSION["loggedUser"]->getTamanioMascotaCuidar();
            require_once(VIEWS_PATH . "set-configuracion.php");
        }
    }

    public function ShowProfileView(){
        if ($this->validateSession()) {
            $reservaDAO = new ReservaDAO();
            $listaReservas = $reservaDAO->GetListaReservasGuardianEstado($_SESSION["loggedUser"]->getId(), "Finalizada");
            require_once(VIEWS_PATH . "profile-usuario.php");
        }
    }

    public function Add($nombre, $apellido, $telefono, $email, $password, $calle, $numero, $piso = "", $departamento = "", $codigoPostal = "", $rutaFoto = "")
    {

        try {
            $duenioDAO = new DuenioDAO();

            if (($duenioDAO->Buscar($email) == null) && ($this->guardianDAO->Buscar($email) == null)) {

                $guardian = new Guardian($nombre, $apellido, $telefono, $email, $password, $calle, $numero, $piso, $departamento, $codigoPostal);

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

                $guardian = $this->guardianDAO->Buscar($guardian->getEmail());

                $guardian->setPassword(null);
                $_SESSION["loggedUser"] = $guardian;

                $this->ShowGuardianHome();
            } else {
                $alert = "El email ingresado ya existe.";
                $type = 2;
                $homeController = new HomeController();
                $homeController->ShowRegisterView($type, $alert);
            }
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    public function setConfig($dias = array(), $tamanios = array(), $precio = "")
    {
        if ($this->validateSession()) {
            try {
                $_SESSION["loggedUser"]->setTamanioMascotaCuidar($tamanios);
                $this->guardianDAO->UpdateTamanios($_SESSION["loggedUser"]->getId(), $tamanios);

                $_SESSION["loggedUser"]->setPrecioXDia($precio);
                $this->guardianDAO->UpdatePrecio($_SESSION["loggedUser"]->getId(), $precio);

                $_SESSION["loggedUser"]->setDisponibilidad($dias);
                $this->guardianDAO->UpdateDisponibilidad($_SESSION["loggedUser"]->getId(), $dias);

                $alert = "Configuracion guardada con exito &check;";
            } catch (Exception $ex) {

                $alert = "No se pudo guardar la configuracion";
            } finally {
                $this->ShowConfiguracionView($alert);
            }
        }
    }
}
