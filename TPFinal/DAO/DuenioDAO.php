<?php

namespace DAO;

use Models\Duenio;
use Models\Mascota;

class DuenioDAO implements IDuenioDAO
{
    private $duenioList = array();
    private $fileName;


    public function __construct()
    {
        $this->fileName = ROOT . "Data/duenios.json";
    }

    public function Add(Duenio $duenio)
    {
        $this->RetrieveData();

        $duenio->setId($this->GetNextId());

        array_push($this->duenioList, $duenio);

        $this->SaveData();
    }

    public function AddMascota(Duenio $duenio)
    {
        $duenioAux = $this->Buscar($duenio->getEmail());

        $listaMascotas = $duenioAux->getListaMascotas();

        $newMascota = new Mascota("pepita","Golden","Grande","Dorado");

        array_push($listaMascotas, $newMascota);

        $duenioAux->setListaMascotas($listaMascotas);

        $this->SaveData();
    }

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->duenioList;
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->duenioList as $duenio) {

            $valuesArray["id"] = $duenio->getId();
            $valuesArray["nombre"] = $duenio->getNombre();
            $valuesArray["apellido"] = $duenio->getApellido();
            $valuesArray["telefono"] = $duenio->getTelefono();
            $valuesArray["email"] = $duenio->getEmail();
            $valuesArray["password"] = $duenio->getPassword();

            $valuesArray["alta"] = $duenio->getAlta();


            $arrayMascotas = array();


            foreach ($duenio->getListaMascotas() as $mascota) {
                $valuesArrayMascota["id"] = $mascota->getId();
                $valuesArrayMascota["nombre"] = $mascota->getNombre();
                $valuesArrayMascota["raza"] = $mascota->getRaza();
                $valuesArrayMascota["obervaciones"] = $mascota->getObservaciones();
                $valuesArrayMascota["rutaFoto"] = $mascota->getRutaFoto();
                $valuesArrayMascota["rutaVideo"] = $mascota->getRutaVideo();
                $valuesArrayMascota["rutaPlanVacunas"] = $mascota->getRutaPlanVacunas();
                $valuesArrayMascota["alta"] = $mascota->getAlta();

                array_push($arrayMascotas, $valuesArrayMascota);
            }

            $valuesArray["listaMascotas"] = $arrayMascotas;

            $valuesArray["listaReservas"] = array();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $jsonContent);
    }

    private function RetrieveData()
    {
        $this->duenioList = array();

        if (file_exists($this->fileName)) {

            $jsonContent = file_get_contents($this->fileName);

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valuesArray) {

                $duenio = new duenio(NULL, NULL, NULL, NULL, NULL);

                $duenio->setId($valuesArray["id"]);
                $duenio->setNombre($valuesArray["nombre"]);
                $duenio->setApellido($valuesArray["apellido"]);
                $duenio->setTelefono($valuesArray["telefono"]);
                $duenio->setEmail($valuesArray["email"]);
                $duenio->setPassword($valuesArray["password"]);
                $duenio->setAlta($valuesArray["alta"]);

                $ArrayMascotas = $valuesArray["listaMascotas"];

                $listaMascotas = array();

                foreach ($ArrayMascotas as $valuesArrayMascota) {

                    $mascota = new Mascota(NULL, NULL, NULL, NULL);

                    $mascota->setId($valuesArrayMascota["id"]);
                    $mascota->setNombre($valuesArrayMascota["nombre"]);
                    $mascota->setRaza($valuesArrayMascota["raza"]);
                    $mascota->setObservaciones($valuesArrayMascota["obervaciones"]);
                    $mascota->setRutaFoto($valuesArrayMascota["rutaFoto"]);
                    $mascota->setRutaVideo($valuesArrayMascota["rutaVideo"]);
                    $mascota->setRutaPlanVacunas($valuesArrayMascota["rutaPlanVacunas"]);
                    $mascota->setAlta($valuesArrayMascota["alta"]);

                    array_push($listaMascotas, $mascota);
                }

                $duenio->setListaMascotas($listaMascotas);

                array_push($this->duenioList, $duenio);
            }
        }
    }

    public function Buscar($email)
    {
        $this->RetrieveData();

        foreach ($this->duenioList as $duenio) {
            if ($duenio->getEmail() == $email) {
                return $duenio;
            }
        }
        return NULL;
    }

    /*
    public function Remove($id)
    {
        $this->RetrieveData();

        echo "DAO ID=" . $id;

        foreach ($this->duenioList as $index => $duenio) {
            echo "ID CELL=" . $duenio->getId();
            if ($duenio->getId() == $id) {
                unset($this->duenioList[$index]);
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

        foreach ($this->duenioList as $duenio) {
            if ($duenio->getId() == $id) {

                $duenio->setCode($code);
                $duenio->setBrand($brand);
                $duenio->setModel($model);
                $duenio->setPrice($price);
            }
        }

        $this->SaveData();
    }*/


    private function GetNextId()
    {
        $id = 0;

        foreach ($this->duenioList as $duenio) {
            $id = ($duenio->getId() > $id) ? $duenio->getId() : $id;
        }

        return $id + 1;
    }
}
