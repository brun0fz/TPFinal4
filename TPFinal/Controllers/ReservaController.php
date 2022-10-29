<?php

namespace Controllers;

use DAO\GuardianDAO;
use DAO\MascotaDAO;
use DAO\ReservaDAO;
use DateTime;
use Exception;
use Models\Cupon;
use Models\EstadoReserva;
use Models\Reserva;

class ReservaController
{

    private $mascotaDAO;
    private $guardianDAO;
    private $reservaDAO;

    public function __construct()
    {
        $this->mascotaDAO = new MascotaDAO();
        $this->guardianDAO = new GuardianDAO();
        $this->reservaDAO = new ReservaDAO();
    }

    public function ShowAddReservaView($idGuardian, $fechaInicio, $fechaFin, $idMascota)
    {
        if (isset($_SESSION["loggedUser"]) && ($_SESSION["loggedUser"]->getTipo() == 1)) {
            try {
                $guardian = $this->guardianDAO->BuscarId($idGuardian);

                $precioTotal = $this->CalcularPrecioTotal($fechaInicio, $fechaFin, $guardian->getPrecioXDia());

                $mascota = $this->mascotaDAO->GetMascotaById($idMascota);
                require_once(VIEWS_PATH . "add-reserva.php");
            } catch (Exception $ex) {
                echo $ex;
            }
        } else {
            HomeController::Index();
        }
    }

    public function ShowListReservasView($alert = "")
    {
        if (isset($_SESSION["loggedUser"])) {
            try {
                if ($_SESSION["loggedUser"]->getTipo() == 1) {
                    $listaReservas = $this->reservaDAO->ListaReservasDuenio($_SESSION["loggedUser"]->getId());
                } else {
                    $listaReservas = $this->reservaDAO->ListaReservasGuardian($_SESSION["loggedUser"]->getId());
                }

                require_once(VIEWS_PATH . "list-reservas.php");
            } catch (Exception $ex) {
                echo $ex;
            }
        } else {
            HomeController::Index();
        }
    }

    public function ShowCuponView($idReserva)
    {
        if (isset($_SESSION["loggedUser"]) && ($_SESSION["loggedUser"]->getTipo() == 1)) {
            try {
                $cupon = $this->reservaDAO->GetCuponByIdReserva($idReserva);

                require_once(VIEWS_PATH . "list-cupon.php");

            } catch (Exception $ex) {
                $alert  = $ex;
            }
        } else {
            HomeController::Index();
        }
    }

    public function Add($fechaInicio, $fechaFin, $precioTotal, $idMascota, $idGuardian, $idDuenio)
    {
        if (isset($_SESSION["loggedUser"]) && ($_SESSION["loggedUser"]->getTipo() == 1)) {
            try {
                $reserva = new Reserva($fechaInicio, $fechaFin, $precioTotal, $idMascota, $idDuenio, $idGuardian);

                $this->reservaDAO->Add($reserva);

                $alert = "Reserva realizada con exito.";
            } catch (Exception $ex) {
                $alert  = $ex;
            } finally {
                $this->ShowListReservasView($alert);
            }
        } else {
            HomeController::Index();
        }
    }

    private function CalcularPrecioTotal($fechaInicio, $fechaFin, $precioXDia)
    {
        $dateInicio = new DateTime($fechaInicio);
        $dateFin = new DateTime($fechaFin);

        $difference = $dateInicio->diff($dateFin);

        $dias = 1 + (int) $difference->format("%d days ");

        return $dias * $precioXDia;
    }

    public function cambiarEstado($idReserva, $estado)
    {
        if (isset($_SESSION["loggedUser"])) {
            try {
                $this->reservaDAO->UpdateEstado($idReserva, $estado);
                $alert = "El estado de la reserva ha sido cambiado.";
            } catch (Exception $ex) {
                $alert = $ex;
            } finally {
                $this->ShowListReservasView($alert);
            }
        } else {
            HomeController::Index();
        }
    }

    public function confirmarReserva($idReserva)
    {
        if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]->getTipo() == 2) {
            try {
                $this->reservaDAO->UpdateEstado($idReserva, "En espera de pago");
                $alert = "El estado de la reserva ha sido cambiado. Se ha enviado el cupon de pago.";

                $reservaConfirmada = $this->reservaDAO->GetReservaById($idReserva);

                $mascotaConfirmada = $this->mascotaDAO->GetMascotaById($reservaConfirmada->getFkIdMascota());

                $reservasList = $this->reservaDAO->GetListaReservasByEstado($_SESSION["loggedUser"]->getId(), "Solicitada");

                foreach ($reservasList as $reserva) {

                    $mascota = $this->mascotaDAO->GetMascotaById($reserva->getFkIdMascota());

                    if ($mascota->getAnimal() != $mascotaConfirmada->getAnimal() || $mascota->getRaza() != $mascotaConfirmada->getRaza()) {
                        $this->reservaDAO->UpdateEstado($reserva->getIdReserva(), "Cancelada");
                    }
                }

                ///Cupon de pago
                $cupon = new Cupon($idReserva, $_SESSION["loggedUser"]->getAliasCBU(), $reservaConfirmada->getPrecioTotal());
                $this->reservaDAO->AddCupon($cupon);
            } catch (Exception $ex) {
                $alert = $ex;
            } finally {
                $this->ShowListReservasView($alert);
            }
        } else {
            HomeController::Index();
        }
    }
}
