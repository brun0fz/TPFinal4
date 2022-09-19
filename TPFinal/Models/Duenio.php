<?php

namespace Models;

class Duenio extends Usuario
{

    private $listaMascotas = array();
    private $listaReservas = array();

    public function __construct($nombre, $apellido, $telefono, $email, $password)
    {
        parent::__construct($nombre, $apellido, $telefono, $email, $password);
    }

    public function getListaMascotas()
    {
        return $this->listaMascotas;
    }

    public function setListaMascotas($listaMascotas): self
    {
        $this->listaMascotas = $listaMascotas;

        return $this;
    }

    public function crearMascota($nombre, $raza, $tamanio, $observaciones)
    {

        $mascota = new Mascota($nombre, $raza, $tamanio, $observaciones);

        array_push($listaMascotas, $mascota);
    }
}
