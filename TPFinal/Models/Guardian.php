<?php namespace Models;

class Guardian extends Usuario{

    private $calle;
    private $numero;
    private $tamanioMascotaCuidar = array();
    private $reputacion = NULL;
    private $diasOcupados = array();
    private $disponibilidad = array();
    private $precioXDia;

    public function __construct($nombre, $apellido, $telefono, $email, $password, $calle, $numero)
    {
        parent::__construct($nombre, $apellido, $telefono, $email, $password);
        $this->calle = $calle;
        $this->numero = $numero;
        $this->tipo = 2;
    }

    public function getTamanioDescripcion(){
        $tamanioDescripcion = '';
        switch ($this->tamanio) {
            case "S":
                $tamanioDescripcion = 'Pequeño';
                break;
            case "M":
                $tamanioDescripcion = 'Mediano';
                break;
            case "L":
                $tamanioDescripcion = 'Grande';
                break;
        }
        return $tamanioDescripcion;
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
     * @return array
     */
    public function getDisponibilidad()
    {
        return $this->disponibilidad;
    }

    /**
     * @param array $disponibilidad
     */
    public function setDisponibilidad($disponibilidad)
    {
        $this->disponibilidad = $disponibilidad;
    }



    /**
     * Get the value of numero
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     */
    public function setNumero($numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of calle
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set the value of calle
     */
    public function setCalle($calle): self
    {
        $this->calle = $calle;

        return $this;
    }
}