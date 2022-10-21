<?php

namespace Models;

use clases\Guardian as Guardian;

class Reserva
{
    private $idReserva;
    private $fk_idGuardian;
    private $fk_idMascota;

    private $fechaInicio;
    private $fechaFin;
    private $precioTotal;

    private $estado = EstadoReserva::SOLICITADA;

    public function __construct($fk_idGuardian, $fk_idMascota, $fechaInicio, $fechaFin, $precioTotal)
    {
        $this->fk_idGuardian = $fk_idGuardian;
        $this->fk_idMascota = $fk_idMascota;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->precioTotal = $precioTotal;
    }


    /**
     * Get the value of idReserva
     */
    public function getIdReserva()
    {
        return $this->idReserva;
    }

    /**
     * Set the value of idReserva
     */
    public function setIdReserva($idReserva): self
    {
        $this->idReserva = $idReserva;

        return $this;
    }

    /**
     * Get the value of fk_idGuardian
     */
    public function getFkIdGuardian()
    {
        return $this->fk_idGuardian;
    }

    /**
     * Set the value of fk_idGuardian
     */
    public function setFkIdGuardian($fk_idGuardian): self
    {
        $this->fk_idGuardian = $fk_idGuardian;

        return $this;
    }

    /**
     * Get the value of fk_idMascota
     */
    public function getFkIdMascota()
    {
        return $this->fk_idMascota;
    }

    /**
     * Set the value of fk_idMascota
     */
    public function setFkIdMascota($fk_idMascota): self
    {
        $this->fk_idMascota = $fk_idMascota;

        return $this;
    }

    /**
     * Get the value of fechaInicio
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set the value of fechaInicio
     */
    public function setFechaInicio($fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get the value of fechaFin
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set the value of fechaFin
     */
    public function setFechaFin($fechaFin): self
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get the value of precioTotal
     */
    public function getPrecioTotal()
    {
        return $this->precioTotal;
    }

    /**
     * Set the value of precioTotal
     */
    public function setPrecioTotal($precioTotal): self
    {
        $this->precioTotal = $precioTotal;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     */
    public function setEstado($estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
