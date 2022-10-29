<?php

namespace Models;

class Review
{
    private $idReview;
    private $comentario;
    private $puntaje;
    private $fk_idReserva;

    public function __construct($idReview, $comentario, $puntaje, $fk_idReserva)
    {
        $this->idReview = $idReview;
        $this->comentario = $comentario;
        $this->puntaje = $puntaje;
        $this->fk_idReserva = $fk_idReserva;
    }

    /**
     * Get the value of idReview
     */
    public function getIdReview()
    {
        return $this->idReview;
    }

    /**
     * Set the value of idReview
     */
    public function setIdReview($idReview): self
    {
        $this->idReview = $idReview;

        return $this;
    }

    /**
     * Get the value of comentario
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set the value of comentario
     */
    public function setComentario($comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get the value of puntaje
     */
    public function getPuntaje()
    {
        return $this->puntaje;
    }

    /**
     * Set the value of puntaje
     */
    public function setPuntaje($puntaje): self
    {
        $this->puntaje = $puntaje;

        return $this;
    }

    /**
     * Get the value of fk_idReserva
     */
    public function getFkIdReserva()
    {
        return $this->fk_idReserva;
    }

    /**
     * Set the value of fk_idReserva
     */
    public function setFkIdReserva($fk_idReserva): self
    {
        $this->fk_idReserva = $fk_idReserva;

        return $this;
    }
}
