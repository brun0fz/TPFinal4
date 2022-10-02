<?php namespace Models;

class Guardian extends Usuario{

    private $direccion;
    private $tamanioMascotaCuidar;
    private $reputacion = NULL;
    private $diasOcupados = array();
    private $listaReservas = array();
    private $precioXDia;

    public function __construct($nombre, $apellido, $telefono, $email, $password, $direccion)
    {
        parent::__construct($nombre, $apellido, $telefono, $email, $password);
        $this->direccion = $direccion;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     */
    public function setDireccion($direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of tamanioMascotaCuidar
     */
    public function getTamanioMascotaCuidar()
    {
        return $this->tamanioMascotaCuidar;
    }

    /**
     * Set the value of tamanioMascotaCuidar
     */
    public function setTamanioMascotaCuidar($tamanioMascotaCuidar): self
    {
        $this->tamanioMascotaCuidar = $tamanioMascotaCuidar;

        return $this;
    }

    /**
     * Get the value of reputacion
     */
    public function getReputacion()
    {
        return $this->reputacion;
    }

    /**
     * Set the value of reputacion
     */
    public function setReputacion($reputacion): self
    {
        $this->reputacion = (float)$reputacion;

        return $this;
    }

    /**
     * Get the value of diasOcupados
     */
    public function getDiasOcupados()
    {
        return $this->diasOcupados;
    }

    /**
     * Set the value of diasOcupados
     */
    public function setDiasOcupados($diasOcupados): self
    {
        $this->diasOcupados = $diasOcupados;

        return $this;
    }

    /**
     * Get the value of precioXDia
     */
    public function getPrecioXDia()
    {
        return $this->precioXDia;
    }

    /**
     * Set the value of precioXDia
     */
    public function setPrecioXDia($precioXDia): self
    {
        $this->precioXDia = (float)$precioXDia;

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