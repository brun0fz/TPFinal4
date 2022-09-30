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

   

    /**
     * Get the value of listaMascotas
     */
    public function getListaMascotas()
    {
        return $this->listaMascotas;
    }

    /**
     * Set the value of listaMascotas
     */
    public function setListaMascotas($listaMascotas): self
    {
        $this->listaMascotas = $listaMascotas;

        return $this;
    }

    /**
     * Get the value of listaReservas
     */
    public function getListaReservas()
    {
        return $this->listaReservas;
    }

    /**
     * Set the value of listaReservas
     */
    public function setListaReservas($listaReservas): self
    {
        $this->listaReservas = $listaReservas;

        return $this;
    }
}
