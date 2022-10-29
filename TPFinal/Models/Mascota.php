<?php namespace Models;

class Mascota
{

    private $id;
    private $animal;
    private $raza;
    private $nombre;
    private $tamanio;
    private $observaciones;

    private $rutaFoto;
    private $rutaVideo;
    private $rutaPlanVacunas;

    private $idDuenio; //FK

    private $alta = true;

    public function __construct($animal, $raza, $nombre, $tamanio, $observaciones, $rutaFoto, $rutaPlanVacunas, $rutaVideo, $idDuenio)
    {
        $this->animal = $animal;
        $this->nombre = $nombre;
        $this->raza = $raza;
        $this->tamanio = $tamanio;
        $this->observaciones = $observaciones;
        $this->rutaFoto = $rutaFoto;
        $this->rutaPlanVacunas = $rutaPlanVacunas;
        $this->rutaVideo = $rutaVideo;
        $this->idDuenio = $idDuenio;
    }


    public function getAlta()
    {
        return $this->alta;
    }


    public function setAlta($alta)
    {
        $this->alta = $alta;
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
     * Get the value of animal
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * Set the value of animal
     */
    public function setAnimal($animal): self
    {
        $this->animal = $animal;

        return $this;
    }
}

