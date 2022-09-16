<?php namespace clases;

use clases\Guardian as Guardian;

class Reserva{

    protected  static $idInc=0;

    private $idGuardian;
    private $idDuenio;
    private $idMascota;

    private $fechaInicial;
    private $cantidadDias;

    private $estado = EstadoReserva::PENDIENTE;

    public function __construct($idGuardian, $idDuenio, $idMascota, $fechaInicial, $cantidadDias)
    {
        $this->idGuardian = $idGuardian;
        $this->idDuenio = $idDuenio;
        $this->idMascota = $idMascota;
        $this->fechaInicial = $fechaInicial;
        $this->cantidadDias = $cantidadDias;
    }
    

    /**
     * Get the value of idGuardian
     */
    public function getIdGuardian()
    {
        return $this->idGuardian;
    }

    /**
     * Set the value of idGuardian
     */
    public function setIdGuardian($idGuardian): self
    {
        $this->idGuardian = $idGuardian;

        return $this;
    }

    /**
     * Get the value of idDuenio
     */
    public function getIdDuenio()
    {
        return $this->idDuenio;
    }

    /**
     * Set the value of idDuenio
     */
    public function setIdDuenio($idDuenio): self
    {
        $this->idDuenio = $idDuenio;

        return $this;
    }

    /**
     * Get the value of idMascota
     */
    public function getIdMascota()
    {
        return $this->idMascota;
    }

    /**
     * Set the value of idMascota
     */
    public function setIdMascota($idMascota): self
    {
        $this->idMascota = $idMascota;

        return $this;
    }

    /**
     * Get the value of fechaInicial
     */
    public function getFechaInicial()
    {
        return $this->fechaInicial;
    }

    /**
     * Set the value of fechaInicial
     */
    public function setFechaInicial($fechaInicial): self
    {
        $this->fechaInicial = $fechaInicial;

        return $this;
    }

    /**
     * Get the value of cantidadDias
     */
    public function getCantidadDias()
    {
        return $this->cantidadDias;
    }

    /**
     * Set the value of cantidadDias
     */
    public function setCantidadDias($cantidadDias): self
    {
        $this->cantidadDias = $cantidadDias;

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