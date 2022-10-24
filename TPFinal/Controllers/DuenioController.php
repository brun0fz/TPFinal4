<?php

namespace Controllers;

use DAO\DuenioDAO;
use DAO\GuardianDAO;
use DAO\MascotaDAO;
use DAO\ReservaDAO;
use Models\Duenio;
use Models\Mascota;

class DuenioController
{
    private $duenioDAO;
    private $mascotaDAO;

    public function __construct()
    {
        $this->duenioDAO = new DuenioDAO();
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

    public function ShowDuenioHome()
    {
        $this->validateSession() && require_once(VIEWS_PATH . "duenioHome.php");
    }



    public function ShowListaGuardianesView($fechaInicio, $fechaFin, $listaGuardianes = null)
    {
        if ($this->validateSession()) {

            if (!isset($listaGuardianes)) {
                $guardianDAO = new GuardianDAO();
                $listaGuardianes = $guardianDAO->GetAll();
            }

            require_once(VIEWS_PATH . "list-guardianes.php");
        }
    }

    public function ShowSelectFechasReserva()
    {
        if ($this->validateSession()) {
            $mascotaList = $this->mascotaDAO->ListaDuenio($_SESSION["loggedUser"]->getId());
            require_once(VIEWS_PATH . "select-fechas-reserva.php");
        }
    }

    public function Add($nombre, $apellido, $telefono, $email, $password, $rutaFoto)
    {
        $guardianDAO = new GuardianDAO();

        if (($this->duenioDAO->Buscar($email) == null) && ($guardianDAO->Buscar($email) == null)) {

            $duenio = new Duenio($nombre, $apellido, $telefono, $email, $password);

            if ($rutaFoto["tmp_name"] != "") {
                $temp = $rutaFoto["tmp_name"];
                $aux = explode("/", $rutaFoto["type"]);
                $type = $aux[1];

                $name = $email . "." . $type;

                move_uploaded_file($temp, ROOT . VIEWS_PATH . "/img/" . $name);
                chmod(ROOT . VIEWS_PATH . "/img/" . $name, 0777);

                $duenio->setRutaFoto($name);
            } else {
                $duenio->setRutaFoto("undefinedProfile.png");
            }

            $this->duenioDAO->Add($duenio);

            $duenio = $this->duenioDAO->Buscar($duenio->getEmail());

            $duenio->setPassword(null);
            $_SESSION["loggedUser"] = $duenio;

            $this->ShowDuenioHome();
        } else {
            $type = 1;
            require_once(VIEWS_PATH . "registro.php");
        }
    }


    public function FiltrarGuardianes($fechaInicio, $fechaFin, $idMascota)
    {
        $guardianDAO = new GuardianDAO();
        $listaGuardianes = $guardianDAO->GetAll();

        $listaGuardianes = $this->FiltrarGuardianesPorFecha($listaGuardianes, $fechaInicio, $fechaFin);

        $mascota = $this->mascotaDAO->GetMascotaById($idMascota);
        $listaGuardianes = $this->FiltrarGuardianesPorTamanio($listaGuardianes, $mascota->getTamanioDescripcion());

        $listaGuardianes = $this->FiltrarGuardianesPorRaza($listaGuardianes, $mascota->getRaza(), $fechaInicio, $fechaFin);

        $this->ShowListaGuardianesView($fechaInicio, $fechaFin, $listaGuardianes);
    }


    private function FiltrarGuardianesPorFecha($listaGuardianes, $fechaInicio, $fechaFin){
        $timeInicio = strtotime($fechaInicio);

        while ($timeInicio <= strtotime($fechaFin)) {

            $dias[] = $this->traducirDias(date("l", $timeInicio));

            $timeInicio += 86400;
        }

        $listaGuardianesDisponibles = array();

        foreach ($listaGuardianes as $guardian) {

            $disponibilidad = $guardian->getDisponibilidad();

            $flag = 1;

            foreach ($dias as $dia) {
                if (!in_array($dia, $disponibilidad)) {
                    $flag = 0;
                }
            }

            if ($flag) {
                array_push($listaGuardianesDisponibles, $guardian);
            }
        }

        return $listaGuardianesDisponibles;
    }

    private function FiltrarGuardianesPorTamanio($listaGuardianes, $tamanio){

        $listaFiltrada = array();

        foreach($listaGuardianes as $guardian){
            if(in_array($guardian->getTamanioMascotaCuidar(), $tamanio)){
                array_push($listaFiltrada, $guardian);
            }
        }

        return $listaFiltrada;
    }

    private function FiltrarGuardianesPorRaza($listaGuardianes, $raza, $fechaInicio, $fechaFin){
        $reservaDAO = new ReservaDAO();

        $timeInicio = strtotime($fechaInicio);
        $timeFin = strtotime($fechaInicio);

        while ($timeInicio <= $timeFin) {

            $dias[] = date("Y-m-d", $timeInicio);

            $timeInicio += 86400;
        }

        foreach($listaGuardianes as $guardian){
            foreach($dias as $dia){
                $reserva = $reservaDAO->GetReservaGuardianxDia($guardian->getId(), $dia);
                print_r($reserva);

                if($reserva){
                    //completar
                }
            }
        }
    }

    private function traducirDias($diaSemana)
    {

        switch ($diaSemana) {
            case "Monday":
                $diaSemana = "Lunes";
                break;
            case "Tuesday":
                $diaSemana = "Martes";
                break;
            case "Wednesday":
                $diaSemana = "Miercoles";
                break;
            case "Thursday":
                $diaSemana = "Jueves";
                break;
            case "Friday":
                $diaSemana = "Viernes";
                break;
            case "Saturday":
                $diaSemana = "Sabado";
                break;
            case "Sunday":
                $diaSemana = "Domingo";
                break;
        }

        return $diaSemana;
    }
}
