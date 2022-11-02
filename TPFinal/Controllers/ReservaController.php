<?php

namespace Controllers;

use DAO\DuenioDAO;
use DAO\GuardianDAO;
use DAO\MascotaDAO;
use DAO\ReservaDAO;
use DateTime;
use Exception;
use Models\Cupon;
use Models\EstadoReserva;
use Models\Reserva;
use Models\Review;

class ReservaController
{

    private $mascotaDAO;
    private $guardianDAO;
    private $reservaDAO;
    private $duenioDAO;

    public function __construct()
    {
        $this->mascotaDAO = new MascotaDAO();
        $this->guardianDAO = new GuardianDAO();
        $this->reservaDAO = new ReservaDAO();
        $this->duenioDAO = new DuenioDAO();
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
                $reserva = $this->reservaDAO->GetReservaById($cupon->getFkIdReserva());
                require_once(VIEWS_PATH . "list-cupon.php");
            } catch (Exception $ex) {
                $alert  = $ex;
            }
        } else {
            HomeController::Index();
        }
    }

    public function ShowReviewView($idReserva)
    {

        if (isset($_SESSION["loggedUser"]) && ($_SESSION["loggedUser"]->getTipo() == 1)) {
            try {
                $reserva = $this->reservaDAO->GetReservaById($idReserva);
                $guardian = $this->guardianDAO->BuscarId($reserva->getFkIdGuardian());
                $duenio = $this->duenioDAO->BuscarId($reserva->getFkIdDuenio());
                $mascota = $this->mascotaDAO->GetMascotaById($reserva->getFkIdMascota());

                require_once(VIEWS_PATH . "list-review.php");
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

                switch ($estado) {
                    case "Cancelada":
                        $alert = "La reserva ha sido cancelada.";
                        break;
                    case "Confirmada":
                        $alert = "Su pago ha sido realizado con exito.";
                        break;
                    case "Solicitada":
                        $alert = "Su reserva ha sido solicitada. Espere confimarcion del Guardian.";
                        break;
                }
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
                $alert = "Se ha enviado el cupon de pago.";

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
                $precioParcial = ($reservaConfirmada->getPrecioTotal() * 0.5);

                $cupon = new Cupon($idReserva, $_SESSION["loggedUser"]->getAliasCBU(), $precioParcial);
                $this->reservaDAO->AddCupon($cupon);

                ///EMAIL
                $duenio = $this->duenioDAO->BuscarId($reservaConfirmada->getFkIdDuenio());

                mail($duenio->getEmail(), "PET-HERO: Cupon de Pago", "",);
            } catch (Exception $ex) {
                $alert = $ex;
            } finally {
                $this->ShowListReservasView($alert);
            }
        } else {
            HomeController::Index();
        }
    }

    public function AddReview($comentario, $puntaje, $idReserva)
    {
        try {
            $review = new Review($comentario, $puntaje, $idReserva);
            $this->reservaDAO->AddReview($review);

            $this->guardianDAO->UpdateReputacion($idReserva);

            $alert = "Su calificacion ha sido enviada.";
        } catch (Exception $ex) {
            echo $ex;
        } finally {
            $this->ShowListReservasView($alert);
        }
    }
}
