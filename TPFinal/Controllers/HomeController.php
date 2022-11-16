<?php

namespace Controllers;

use Couchbase\View;
use DAO\DuenioDAO;
use DAO\GuardianDAO;
use Exception;
use Models\Duenio;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;
use PHPMailer\PHPMailer\SMTP;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

class HomeController
{
    public $duenioDAO;
    public $guardianDAO;

    public function __construct()
    {
        $this->duenioDAO = new DuenioDAO;
        $this->guardianDAO = new GuardianDAO;
    }

    static function Index($alert = "")
    {
        if (isset($_SESSION["loggedUser"])) {
            if ($_SESSION["loggedUser"]->getTipo() == 1) {
                $duenioController = new DuenioController();
                $duenioController->ShowDuenioHome();
            } else {
                require_once(VIEWS_PATH . "home-guardian.php");
            }
        } else {
            require_once(VIEWS_PATH . "home.php");
        }
    }

    public function ShowRegisterView($type, $alert = "")
    {
        require_once(VIEWS_PATH . "registro.php");
    }

    public function ShowRecuperarContraseniaView($alert = "")
    {
        require_once(VIEWS_PATH . "recuperar-contrasenia.php");
    }

    static function ShowErrorView(){

    }


    public function Login($email, $password)
    {
        try {

            $duenio = $this->duenioDAO->GetDuenioByEmail($email);
            $guardian = $this->guardianDAO->GetGuardianByEmail($email);

            if (isset($duenio) && $duenio->getPassword() == $password) {

                $duenio->setPassword(NULL);
                $_SESSION["loggedUser"] = $duenio;

                $duenioController = new DuenioController();
                $duenioController->ShowDuenioHome();
            } else if (isset($guardian) && $guardian->getPassword() == $password) {

                $guardian->setPassword(NULL);
                $_SESSION["loggedUser"] = $guardian;

                require_once(VIEWS_PATH . "home-guardian.php");
            } else {
                $alert = "Usuario o contrase&ntilde;a incorrectos. Ingrese sus datos nuevamente.";
                $this->Index($alert);
            }
        } catch (Exception $ex) {
            echo "Se produjo un error. Intente mas tarde.";
            $this->Index();
        }
    }

    public function Logout()
    {
        session_unset();
        session_destroy();
        $this->Index();
    }

    public function RecuperarContrasenia($email)
    {
        try {

            $duenio = $this->duenioDAO->GetDuenioByEmail($email);
            $guardian = $this->guardianDAO->GetGuardianByEmail($email);

            if (isset($duenio)) {
                $this->EnviarContrasenia($duenio->getEmail(), "PET-HERO: Recuperacion de contrase&ntilde;", "Su contraseña es: " . "'" . $duenio->getPassword() . "'", "");
            } else if (isset($guardian)) {
                $this->EnviarContrasenia($guardian->getEmail(), "PET-HERO: Recuperacion de contrase&ntilde;", "Su contraseña es: " . "'" . $guardian->getPassword() . "'", "");
            }

            $this->ShowRecuperarContraseniaView("Si la direccion ingresada es valida, recibira su contrase&ntilde;a en su correo electronico.");
        } catch (Exception $ex) {
            echo "Se produjo un error. Intente mas tarde.";
            $this->Index();
        }
    }



    private function EnviarContrasenia($email, $subject, $msgHTML, $altBody)
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
            echo "Se produjo un error. Intente mas tarde.";
            $this->Index();
        }
    }
}
