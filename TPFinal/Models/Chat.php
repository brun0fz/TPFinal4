<?php

namespace Models;

class Chat
{

    private $idChat;
    private $idEmisor;
    private $idReceptor;
    private $mensaje;
    private $fecha;

    public function __construct()
    {
    }

    /**
     * Get the value of idChat
     */
    public function getIdChat()
    {
        return $this->idChat;
    }

    /**
     * Set the value of idChat
     */
    public function setIdChat($idChat): self
    {
        $this->idChat = $idChat;

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
