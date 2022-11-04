<?php

namespace Models;

class Mensaje
{
    private $idMensaje;
    private $idEmisor;
    private $idReceptor;
    private $mensaje;
    private $fecha;


    /**
     * Get the value of idMensaje
     */
    public function getIdMensaje()
    {
        return $this->idMensaje;
    }

    /**
     * Set the value of idMensaje
     */
    public function setIdMensaje($idMensaje): self
    {
        $this->idMensaje = $idMensaje;

        return $this;
    }

    /**
     * Get the value of idEmisor
     */
    public function getIdEmisor()
    {
        return $this->idEmisor;
    }

    /**
     * Set the value of idEmisor
     */
    public function setIdEmisor($idEmisor): self
    {
        $this->idEmisor = $idEmisor;

        return $this;
    }

    /**
     * Get the value of idReceptor
     */
    public function getIdReceptor()
    {
        return $this->idReceptor;
    }

    /**
     * Set the value of idReceptor
     */
    public function setIdReceptor($idReceptor): self
    {
        $this->idReceptor = $idReceptor;

        return $this;
    }

    /**
     * Get the value of mensaje
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set the value of mensaje
     */
    public function setMensaje($mensaje): self
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     */
    public function setFecha($fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }
}
