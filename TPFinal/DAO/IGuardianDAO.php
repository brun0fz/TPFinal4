<?php

namespace DAO;

use Models\Guardian;

interface IGuardianDAO
{
    function Add(Guardian $guardian);
    function GetAll();
}
