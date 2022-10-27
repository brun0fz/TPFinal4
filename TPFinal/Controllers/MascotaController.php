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

    public function ShowMascotaView($alert = "")
    {
        if ($this->validateSession()) {

            $mascotasList = $this->mascotaDAO->ListaDuenio($_SESSION["loggedUser"]->getId());

            require_once(VIEWS_PATH . "list-mascotas.php");
        }
    }

    public function ShowAddMascotaView()
    {
        if ($this->validateSession()) {
            $animalesList = $this->mascotaDAO->GetAnimales();
            require_once(VIEWS_PATH . "addMascota.php");
        }
    }

    public function Add($nombre, $animal, $raza, $tamanio, $observaciones, $rutaFoto, $rutaPlanVacunas)
    {
        if ($this->validateSession()) {

            echo $nombre . $animal .  $raza . $tamanio . $observaciones ;
            print_r($rutaFoto);
            print_r($rutaPlanVacunas);

            try {

                ///Foto
                $temp = $rutaFoto["tmp_name"];
                $aux = explode("/", $rutaFoto["type"]);
                $type = $aux[1];

                $name = $_SESSION["loggedUser"]->getId() . "-" . $nombre . "." . $type;

                move_uploaded_file($temp, ROOT . VIEWS_PATH . "/img/" . $name);

                chmod(ROOT . VIEWS_PATH . "/img/" . $name, 0777);


                ///Plan de vacunas
                $temp2 = $rutaPlanVacunas["tmp_name"];
                $aux2 = explode("/", $rutaPlanVacunas["type"]);
                $type2 = $aux2[1];

                $namePlanVacunas = $_SESSION["loggedUser"]->getId() . "-" . "Vacunas" . "." . $type2;

                move_uploaded_file($temp2, ROOT . VIEWS_PATH . "/img/" . $namePlanVacunas);

                chmod(ROOT . VIEWS_PATH . "/img/" . $namePlanVacunas, 0777);


                $newMascota = new Mascota($animal, $raza, $nombre, $tamanio, $observaciones, $name, $namePlanVacunas, $_SESSION["loggedUser"]->getId());

                $this->mascotaDAO->Add($newMascota);

                $alert = "Mascota agregada con exito";
            } catch (Exception $ex) {
                $alert = $ex;
            } finally {
                $this->ShowMascotaView($alert);
            }
        }
    }
}
