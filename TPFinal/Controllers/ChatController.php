<?php

namespace Controllers;

use DAO\chatDAO;
use DAO\DuenioDAO;
use DAO\GuardianDAO;
use Models\Chat;

class ChatController
{
    private $chatDAO;
    private $duenioDAO;
    private $guardianDAO;

    public function __construct()
    {
        $this->chatDAO = new chatDAO();
        $this->duenioDAO = new DuenioDAO();
        $this->guardianDAO = new GuardianDAO();
    }

    private function validateSession()
    {
        if (isset($_SESSION["loggedUser"])) {
            return true;
        } else {
            HomeController::Index();
        }
    }

    public function ShowChatView($idChat = -1)
    {
        if ($this->validateSession()) {

            $userList = array();

            $idList = $this->chatDAO->GetAllIds($_SESSION["loggedUser"]->getId());

            $idChat == -1 && $idChat = $idList[0];

            $chatList = $this->chatDAO->GetChatById($_SESSION["loggedUser"]->getId(), $idChat);

            if ($_SESSION["loggedUser"]->getTipo() == 1) {
                foreach ($idList as $id) {
                    $guardian = $this->guardianDAO->GetGuardianById($id);
                    array_push($userList, $guardian);

                    if ($id == $idChat) {
                        $user2 = $guardian;
                    }
                }
            } else {
                foreach ($idList as $id) {
                    $duenio = $this->duenioDAO->GetDuenioById($id);

                    array_push($userList, $duenio);

                    if ($id == $idChat) {
                        $user2 = $duenio;
                    }
                }
            }

            $user1 = $_SESSION["loggedUser"];

            require_once(VIEWS_PATH . "chat.php");
        }
    }

    public function Add($mensaje, $idEmisor, $idReceptor)
    {
        $chat = new Chat();

        $chat->setIdEmisor($idEmisor);
        $chat->setIdReceptor($idReceptor);
        $chat->setMensaje($mensaje);

        $this->chatDAO->Add($chat);

        $this->ShowChatView();
    }
}
