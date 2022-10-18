<?php

namespace Controllers;

use DAO\MascotaDAO;
use Exception;
use Models\Mascota;

class MascotaController
{

    private $mascotaDAO;

    public function __construct()
    {
        $this->mascotaDAO = new MascotaDAO();
    }


    private function validateSession()
    {
        if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getTipo() == 1) {
            return true;
        } else {
            HomeController::Index();
        }
    }

    public function ShowMascotaView($alert="")
    {
        if ($this->validateSession()) {

            $mascotasList = $this->mascotaDAO->ListaDuenio($_SESSION["loggedUser"]->getId());

            require_once(VIEWS_PATH . "list-mascotas.php");
        }
    }

    public function ShowAddMascotaView()
    {
        if ($this->validateSession()) {
            require_once(VIEWS_PATH . "addMascota.php");
        }
    }

    public function Add($nombre, $animal, $raza, $tamanio, $observaciones, $rutaFoto)
    {
        if ($this->validateSession()) {

            try {

                $temp = $rutaFoto["tmp_name"];
                $aux = explode("/", $rutaFoto["type"]);
                $type = $aux[1];

                $name = $_SESSION["loggedUser"]->getId() . "-" . $nombre . "." . $type;

                move_uploaded_file($temp, ROOT . VIEWS_PATH . "/img/" . $name);

                chmod(ROOT . VIEWS_PATH . "/img/" . $name, 0777);

                $newMascota = new Mascota($animal, $raza, $nombre, $tamanio, $observaciones, $name, $_SESSION["loggedUser"]->getId());

                $this->mascotaDAO->Add($newMascota);

                $alert = "Mascota agregada con exito";

            } catch (Exception $ex) {
                $alert = $ex->getMessage();

            } finally {
                $this->ShowMascotaView($alert);
            }
        }
    }
}
