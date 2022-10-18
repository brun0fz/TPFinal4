<?php

namespace DAO;

use Models\Guardian;

interface IGuardianDAO
{
    function Add(Guardian $usuario);
    function GetAll();
}
