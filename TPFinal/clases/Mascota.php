<?php namespace clases;

class Mascota{

    private static $idInc=0;

    private $id;
    private $nombre;
    private $raza;
    private $tamanio;
    private $observaciones;

    private $rutaFoto;
    private $rutaVideo;
    private $rutaPlanVacunas;

    protected $alta=true;

    public function __construct($nombre, $raza, $tamanio, $observaciones)
    {
        $this->id = self::$idInc+=1;

        $this->nombre = $nombre;
        $this->raza = $raza;
        $this->tamanio = $tamanio;
        $this->observaciones = $observaciones;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of raza
     */
    public function getRaza()
    {
        return $this->raza;
    }

    /**
     * Set the value of raza
     */
    public function setRaza($raza): self
    {
        $this->raza = $raza;

        return $this;
    }

    /**
     * Get the value of tamanio
     */
    public function getTamanio()
    {
        return $this->tamanio;
    }

    /**
     * Set the value of tamanio
     */
    public function setTamanio($tamanio): self
    {
        $this->tamanio = $tamanio;

        return $this;
    }

    /**
     * Get the value of observaciones
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set the value of observaciones
     */
    public function setObservaciones($observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get the value of rutaFoto
     */
    public function getRutaFoto()
    {
        return $this->rutaFoto;
    }

    /**
     * Set the value of rutaFoto
     */
    public function setRutaFoto($rutaFoto): self
    {
        $this->rutaFoto = $rutaFoto;

        return $this;
    }

    /**
     * Get the value of rutaVideo
     */
    public function getRutaVideo()
    {
        return $this->rutaVideo;
    }

    /**
     * Set the value of rutaVideo
     */
    public function setRutaVideo($rutaVideo): self
    {
        $this->rutaVideo = $rutaVideo;

        return $this;
    }

    /**
     * Get the value of rutaPlanVacunas
     */
    public function getRutaPlanVacunas()
    {
        return $this->rutaPlanVacunas;
    }

    /**
     * Set the value of rutaPlanVacunas
     */
    public function setRutaPlanVacunas($rutaPlanVacunas): self
    {
        $this->rutaPlanVacunas = $rutaPlanVacunas;

        return $this;
    }
}

