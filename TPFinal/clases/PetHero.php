<?php namespace clases;

class PetHero{

private $listaGuardianes = array();
private $listaDuenios = array();

public function __construct()
{
    
}

/**
 * Get the value of listaGuardianes
 */
public function getListaGuardianes()
{
return $this->listaGuardianes;
}

/**
 * Set the value of listaGuardianes
 */
public function setListaGuardianes($listaGuardianes): self
{
$this->listaGuardianes = $listaGuardianes;

return $this;
}

/**
 * Get the value of listaDuenios
 */
public function getListaDuenios()
{
return $this->listaDuenios;
}

/**
 * Set the value of listaDuenios
 */
public function setListaDuenios($listaDuenios): self
{
$this->listaDuenios = $listaDuenios;

return $this;
}
}
