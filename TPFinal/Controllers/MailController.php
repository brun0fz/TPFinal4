<?php

namespace Controllers;

use Models\Duenio;
use Models\Guardian;
use Models\Mascota;
use Models\Reserva;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;
use PHPMailer\PHPMailer\SMTP;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

class MailController
{

    static function EnviarMail($email, $subject, $msgHTML, $altBody)
    {
        try {
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;

            $mail->Username = USERNAMEMAIL;
            $mail->Password = PASSWORDMAIL;

            $mail->setFrom(USERNAMEMAIL);
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
            echo "No se pudo enviar el Email";
        }
    }

    static function MailCupon($duenio, $reserva, $mascota, $guardian)
    {

        $body = '
        <div>
            <h1>Cupón de Pago - Reserva # ' . $reserva->getIdReserva() .  '</h1>
            <ul>
                <li>Reserva #' . $reserva->getIdReserva() . '</li>
                <li>Mascota: ' . $mascota->getNombre() . '</li>
                <li>Guardián: ' . $guardian->getNombre() . '</li>
                <li>Fecha de Entrada: ' . $reserva->getFechaInicio() . '</li>
                <li>Fecha de Salida: ' . $reserva->getFechaFin() . '</li>
                <li>Precio total de la Reserva: $' . $reserva->getPrecioTotal() . '</li>
                <li>Total Cupón de Pago: $' . ($reserva->getPrecioTotal() * 0.5) . '</li>
            </ul>
        </div>
        ';

        SELF::EnviarMail($duenio->getEmail(), 'PET-HERO: Cupon de pago - Reserva ' . $reserva->getIdReserva(), $body, "Cupon de pago");
    }

    static function MailCancelarReserva($duenio, $reserva)
    {
        $body = "Lo sentimos " . $duenio->getNombre() . ", su reserva #" . $reserva->getIdReserva() . " ha sido cancelada";

        SELF::EnviarMail($duenio->getEmail(), "PET-HERO: Reserva cancelada", $body, "Reserva cancelada");
    }

    static function MailRecuperarContrasenia($usuario)
    {
        $body = "Su contraseña es: " . "'" . $usuario->getPassword() . "'";

        SELF::EnviarMail($usuario->getEmail(), "PET-HERO: Recuperacion de contrasena", $body, "");
    }
}
