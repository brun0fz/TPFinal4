<?php

namespace DAO;

use Models\Guardian;
use Models\Reserva;

class GuardianDAO implements IGuardianDAO
{
    private $guardianList = array();
    private $fileName;

    public function __construct()
    {
        $this->fileName = ROOT . "Data/guardianes.json";
    }

    public function Add(Guardian $guardian)
    {
        $this->RetrieveData();

        $guardian->setId($this->GetNextId());

        array_push($this->guardianList, $guardian);

        $this->SaveData();
    }

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->guardianList;
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->guardianList as $guardian) {

            $valuesArray["id"] = $guardian->getId();
            $valuesArray["nombre"] = $guardian->getNombre();
            $valuesArray["apellido"] = $guardian->getApellido();
            $valuesArray["telefono"] = $guardian->getTelefono();
            $valuesArray["email"] = $guardian->getEmail();
            $valuesArray["password"] = $guardian->getPassword();
            $valuesArray["direccion"] = $guardian->getDireccion();
            $valuesArray["alta"] = $guardian->getAlta();
            $valuesArray["tamanioMascotaCuidar"] = $guardian->getTamanioMascotaCuidar();
            $valuesArray["reputacion"] = $guardian->getReputacion();
            $valuesArray["diasOcupados"] = $guardian->getDiasOcupados();
            $valuesArray["precioXDia"] = $guardian->getPrecioXDia();

            $arrayReservas = array();

            foreach ($guardian->getListaReservas() as $reserva) {
                $valuesArrayReserva = array();
                array_push($arrayReservas, $valuesArrayReserva);
            }

            $valuesArray["listaReservas"] = $arrayReservas;

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $jsonContent);
    }

    private function RetrieveData()
    {
        $this->GuardianList = array();

        if (file_exists($this->fileName)) {

            $jsonContent = file_get_contents($this->fileName);

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valuesArray) {

                $guardian = new Guardian(NULL, NULL, NULL, NULL, NULL, NULL);

                $guardian->setId($valuesArray["id"]);
                $guardian->setNombre($valuesArray["nombre"]);
                $guardian->setApellido($valuesArray["apellido"]);
                $guardian->setTelefono($valuesArray["telefono"]);
                $guardian->setEmail($valuesArray["email"]);
                $guardian->setPassword($valuesArray["password"]);
                $guardian->setDireccion($valuesArray["direccion"]);
                $guardian->setAlta($valuesArray["alta"]);
                $guardian->setTamanioMascotaCuidar($valuesArray["tamanioMascotaCuidar"]);
                $guardian->setReputacion($valuesArray["reputacion"]);
                $guardian->setDiasOcupados($valuesArray["diasOcupados"]);
                $guardian->setPrecioXDia($valuesArray["precioXDia"]);

                $ArrayReservas = $valuesArray["listaReservas"];

                $listaReservas = array();

                /*
                foreach ($ArrayReservas as $valuesArrayReserva) {

                    $reserva = new Reserva(NULL, NULL, NULL, NULL, NULL);

                    $reserva->setId($valuesArrayReserva["id"]);
                    $reserva->setId($valuesArrayReserva["nombre"]);
                    $reserva->setId($valuesArrayReserva["raza"]);
                    $reserva->setId($valuesArrayReserva["obervaciones"]);
                    $reserva->setId($valuesArrayReserva["rutaFoto"]);
                    $reserva->setId($valuesArrayReserva["rutaVideo"]);
                    $reserva->setId($valuesArrayReserva["rutaPlanVacunas"]);
                    $reserva->setId($valuesArrayReserva["alta"]);

                    array_push($listaReservas, $reserva);
                }*/

                $guardian->setListaReservas($listaReservas);

                array_push($this->guardianList, $guardian);
            }
        }
    }

    public function Buscar($email)
    {
        $this->RetrieveData();

        foreach ($this->guardianList as $guardian) {
            if ($guardian->getEmail() == $email) {
                return $guardian;
            }
        }

        return NULL;
    }

    /*
    public function Remove($id)
    {
        $this->RetrieveData();

        echo "DAO ID=" . $id;

        foreach ($this->GuardianList as $index => $Guardian) {
            echo "ID CELL=" . $Guardian->getId();
            if ($Guardian->getId() == $id) {
                unset($this->GuardianList[$index]);
                break;
            }
        }

        $this->SaveData();
    }
    /*

/*
    public function Modify($code, $brand, $model, $price, $id)
    {
        $this->RetrieveData();

        foreach ($this->GuardianList as $Guardian) {
            if ($Guardian->getId() == $id) {

                $Guardian->setCode($code);
                $Guardian->setBrand($brand);
                $Guardian->setModel($model);
                $Guardian->setPrice($price);
            }
        }

        $this->SaveData();
    }*/


    private function GetNextId()
    {
        $id = 0;

        foreach ($this->GuardianList as $Guardian) {
            $id = ($Guardian->getId() > $id) ? $Guardian->getId() : $id;
        }

        return $id + 1;
    }
}
