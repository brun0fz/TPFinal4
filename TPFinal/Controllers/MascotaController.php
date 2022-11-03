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
            try {
                $mascotasList = $this->mascotaDAO->ListaDuenio($_SESSION["loggedUser"]->getId());
                require_once(VIEWS_PATH . "list-mascotas.php");
            } catch (Exception $ex) {
                echo $ex;
            }
        }
    }

    public function ShowAddMascotaView()
    {
        if ($this->validateSession()) {
            try {
                $animalesList = $this->mascotaDAO->GetAnimales();
                require_once(VIEWS_PATH . "add-mascota.php");
            } catch (Exception $ex) {
                echo $ex;
            }
        }
    }

    public function ShowMascotaProfile($idMascota)
    {
        if ($this->validateSession()) {
            try {
                $mascota = $this->mascotaDAO->GetMascotaById($idMascota);
                require_once(VIEWS_PATH . "profile-mascota.php");
            } catch (Exception $ex) {
                echo $ex;
            }
        }
    }


    public function Add($nombre, $animal, $raza, $tamanio, $observaciones, $rutaFoto, $rutaPlanVacunas, $rutaVideo)
    {
        if ($this->validateSession()) {
            try {

                ///Foto -> "idDuenio-nombreMascota.type"
                $temp = $rutaFoto["tmp_name"];
                $aux = explode("/", $rutaFoto["type"]);
                $type = $aux[1];

                $name = $_SESSION["loggedUser"]->getId() . "-" . $nombre . "." . $type;

                move_uploaded_file($temp, ROOT . VIEWS_PATH . "/img/" . $name);

                chmod(ROOT . VIEWS_PATH . "/img/" . $name, 0777);


                ///Plan de vacunas -> "idDuenio-nombreMascota-Vacunas.type"
                $temp2 = $rutaPlanVacunas["tmp_name"];
                $aux2 = explode("/", $rutaPlanVacunas["type"]);
                $type2 = $aux2[1];

                $namePlanVacunas = $_SESSION["loggedUser"]->getId() . "-" . $nombre . "-" . "Vacunas" . "." . $type2;

                move_uploaded_file($temp2, ROOT . VIEWS_PATH . "/img/" . $namePlanVacunas);

                chmod(ROOT . VIEWS_PATH . "/img/" . $namePlanVacunas, 0777);

                ///Video -> "idDuenio-nombreMascota-Video.type"
                if ($rutaVideo["tmp_name"] != "") {

                    $temp3 = $rutaVideo["tmp_name"];
                    $aux3 = explode("/", $rutaVideo["type"]);
                    $type3 = $aux3[1];

                    $nameVideo = $_SESSION["loggedUser"]->getId() . "-" . $nombre . "-" . "Video" . "." . $type3;

                    move_uploaded_file($temp3, ROOT . VIEWS_PATH . "/video/" . $nameVideo);

                    chmod(ROOT . VIEWS_PATH . "/video/" . $nameVideo, 0777);
                } else {
                    $nameVideo = "undefinedVideo";
                }


                $newMascota = new Mascota($animal, $raza, $nombre, $tamanio, $observaciones, $name, $namePlanVacunas, $nameVideo, $_SESSION["loggedUser"]->getId());

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
