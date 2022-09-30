<?php

namespace DAO;

use Models\Duenio;

interface IDuenioDAO
{
    function Add(Duenio $usuario);
    function GetAll();
}
