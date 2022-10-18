<?php

namespace Models;

class Duenio extends Usuario{

    public function __construct($nombre, $apellido, $telefono, $email, $password)
    {
        parent::__construct($nombre, $apellido, $telefono, $email, $password);
        $this->tipo = 1;
    }
}
