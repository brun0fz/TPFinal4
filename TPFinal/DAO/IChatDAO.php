<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\Chat;

interface IChatDAO
{
    function Add(Chat $chat);
    function GetChatById($idDuenio, $idGuardian);
    function GetAllIds($idUsuario);
}
