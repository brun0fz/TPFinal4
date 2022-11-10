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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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
                    $listaReservas = array();
                    $listaReservas = array_merge($listaReservas, $this->reservaDAO->GetListaReservasDuenioEstado($_SESSION["loggedUser"]->getId(), "En curso"));
                    $listaReservas = array_merge($listaReservas, $this->reservaDAO->GetListaReservasDuenioEstado($_SESSION["loggedUser"]->getId(), "En espera de pago"));
                    $listaReservas = array_merge($listaReservas, $this->reservaDAO->GetListaReservasDuenioEstado($_SESSION["loggedUser"]->getId(), "Confirmada"));
                    $listaReservas = array_merge($listaReservas, $this->reservaDAO->GetListaReservasDuenioEstado($_SESSION["loggedUser"]->getId(), "Solicitada"));
                    $listaReservas = array_merge($listaReservas, $this->reservaDAO->GetListaReservasDuenioEstado($_SESSION["loggedUser"]->getId(), "Finalizada"));
                    $listaReservas = array_merge($listaReservas, $this->reservaDAO->GetListaReservasDuenioEstado($_SESSION["loggedUser"]->getId(), "Cancelada"));
                } else {
                    $listaReservas = array();
                    $listaReservas = array_merge($listaReservas, $this->reservaDAO->GetListaReservasGuardianEstado($_SESSION["loggedUser"]->getId(), "En curso"));
                    $listaReservas = array_merge($listaReservas, $this->reservaDAO->GetListaReservasGuardianEstado($_SESSION["loggedUser"]->getId(), "Solicitada"));
                    $listaReservas = array_merge($listaReservas, $this->reservaDAO->GetListaReservasGuardianEstado($_SESSION["loggedUser"]->getId(), "En espera de pago"));
                    $listaReservas = array_merge($listaReservas, $this->reservaDAO->GetListaReservasGuardianEstado($_SESSION["loggedUser"]->getId(), "Confirmada"));
                    $listaReservas = array_merge($listaReservas, $this->reservaDAO->GetListaReservasGuardianEstado($_SESSION["loggedUser"]->getId(), "Finalizada"));
                    $listaReservas = array_merge($listaReservas, $this->reservaDAO->GetListaReservasGuardianEstado($_SESSION["loggedUser"]->getId(), "Cancelada"));
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
                $guardian = $this->guardianDAO->BuscarId($reserva->getFkIdGuardian());
                $mascota = $this->mascotaDAO->GetMascotaById($reserva->getFkIdMascota());
                require_once(VIEWS_PATH . "show-cupon.php");
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

                require_once(VIEWS_PATH . "add-review.php");
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

                $reservasSolicitadas = $this->reservaDAO->GetListaReservasByEstado($_SESSION["loggedUser"]->getId(), "Solicitada");

                $diasReservaConfirmada = $this->GetDiasReserva($reservaConfirmada->getFechaInicio(), $reservaConfirmada->getFechaFin());

                foreach ($reservasSolicitadas as $reserva) {

                    $interseccionDias = array();

                    $mascota = $this->mascotaDAO->GetMascotaById($reserva->getFkIdMascota());

                    $diasReserva = $this->GetDiasReserva($reserva->getFechaInicio(), $reserva->getFechaFin());

                    $interseccionDias = array_intersect($diasReservaConfirmada, $diasReserva);

                    if (!empty($interseccionDias)) {
                        if ($mascota->getAnimal() != $mascotaConfirmada->getAnimal() || $mascota->getRaza() != $mascotaConfirmada->getRaza()) {
                            $this->reservaDAO->UpdateEstado($reserva->getIdReserva(), "Cancelada");
                        }
                    }
                }

                ///Cupon de pago
                $precioParcial = ($reservaConfirmada->getPrecioTotal() * 0.5);

                $cupon = new Cupon($idReserva, $precioParcial);
                $this->reservaDAO->AddCupon($cupon);

                ///EMAIL
                $duenio = $this->duenioDAO->BuscarId($reservaConfirmada->getFkIdDuenio());
                $guardian = $this->guardianDAO->BuscarId($reservaConfirmada->getFkIdGuardian());

                $this->MandarMail($duenio->getEmail(), 'PET-HERO: Cupon de pago - Reserva ' . $reservaConfirmada->getIdReserva(), $this->MailBodyCupon($reservaConfirmada, $mascotaConfirmada, $guardian), "Cupon de pago");
            } catch (Exception $ex) {
                $alert = $ex;
            } finally {
                $this->ShowListReservasView($alert);
            }
        } else {
            HomeController::Index();
        }
    }


    private function GetDiasReserva($fechaInicio, $fechaFin)
    {

        $timeInicio = strtotime($fechaInicio);
        $timeFin = strtotime($fechaFin);

        while ($timeInicio <= $timeFin) {

            $dias[] = (date("Y-m-d", $timeInicio));

            $timeInicio += 86400;
        }

        return $dias;
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

    public function PagarCupon($metodoPago, $nombre, $numero, $vencimiento, $cvv, $idReserva, $estado)
    {
        //Los datos de pago no son utilizados ya que esto es solo una simulacion de pago
        if (isset($_SESSION["loggedUser"]) && ($_SESSION["loggedUser"]->getTipo() == 1)) {
            try {
                $this->reservaDAO->UpdateEstado($idReserva, $estado);
                $alert = "Cup&oacute;n pagado con &eacute;xito. La reserva ha sido confirmada.";
            } catch (Exception $ex) {
                $alert = $ex;
            } finally {
                $this->ShowListReservasView($alert);
            }
        } else {
            HomeController::Index();
        }
    }

    private function MandarMail($email, $subject, $msgHTML, $altBody)
    {
        try {
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;

            $mail->Username = 'app.pethero@gmail.com';
            $mail->Password = 'bmplfijszyvepomr';

            $mail->setFrom('app.pethero@gmail.com');
            $mail->addAddress($email);
            $mail->Subject = $subject;
            $mail->msgHTML($msgHTML);
            $mail->AltBody = $altBody;

            if ($mail->send()) {
                return 1;
            } else {
                return 0;
            }
        } catch (PHPMailerException $ex) {
            echo $ex;
        }
    }

    private function MailBodyCupon($reserva, $mascota, $guardian)
    {

        $body = '
        <div style="border:1px solid black">
            <h1>Cupón de Pago - Reserva # ' . $reserva->getIdReserva() .  '</h1>
            <ul>
                <li>Reserva #' . $reserva->getIdReserva() . '</li>
                <li>Mascota: ' . $mascota->getNombre() . '</li>
                <li>Guardian: ' . $guardian->getNombre() . '</li>
                <li>Fecha de Entrada: ' . $reserva->getFechaInicio() . '</li>
                <li>Fecha de Salida: ' . $reserva->getFechaFin() . '</li>
                <li>Precio total de la Reserva: $' . $reserva->getPrecioTotal() . '</li>
                <li>Total Cupón de Pago: $' . ($reserva->getPrecioTotal() * 0.5) . '</li>
            </ul>
        </div>
        ';

        return $body;
    }
}
