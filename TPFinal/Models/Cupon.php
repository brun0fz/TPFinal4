<?php

namespace Models;

class Cupon
{

    private $idCupon;
    private $fk_idReserva;
    private $aliasGuardian;
    private $total;

    public function __construct($idCupon, $fk_idReserva, $aliasGuardian, $total)
    {
        $this->idCupon = $idCupon;
        $this->fk_idReserva = $fk_idReserva;
        $this->aliasGuardian = $aliasGuardian;
        $this->total = $total;
    }

    /**
     * Get the value of idCupon
     */
    public function getIdCupon()
    {
        return $this->idCupon;
    }

    /**
     * Set the value of idCupon
     */
    public function setIdCupon($idCupon): self
    {
        $this->idCupon = $idCupon;

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

    /**
     * Get the value of aliasGuardian
     */
    public function getAliasGuardian()
    {
        return $this->aliasGuardian;
    }

    /**
     * Set the value of aliasGuardian
     */
    public function setAliasGuardian($aliasGuardian): self
    {
        $this->aliasGuardian = $aliasGuardian;

        return $this;
    }

    /**
     * Get the value of total
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     */
    public function setTotal($total): self
    {
        $this->total = $total;

        return $this;
    }
}
