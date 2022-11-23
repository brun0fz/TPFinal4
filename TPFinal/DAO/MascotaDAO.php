<?php

namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use Models\Mascota;

class MascotaDAO implements IMascotaDAO
{
    private $connection;
    private $tableName = "Mascotas";


    //----Adds--------------------------------------------------------------------------------------------------------
    public function Add(Mascota $mascota)
    {
        try {
            $parameters = array();

            $query = "INSERT INTO " . $this->tableName . " (nombre, tamanio, observaciones, rutaFoto, rutaPlanVacunas, rutaVideo, fk_idDuenio, fk_idAnimal, alta) VALUES (:nombre, :tamanio, :observaciones, :rutaFoto, :rutaPlanVacunas, :rutaVideo, :fk_idDuenio, :fk_idAnimal, :alta);";

            $parameters = $this->MascotaToArray($mascota);

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    //----------------------------------------------------------------------------------------------------------------


    //----Gets--------------------------------------------------------------------------------------------------------
    private function GetIdAnimal($animal, $raza)
    {
        $query = "SELECT idAnimal FROM Animales WHERE animal = :animal and raza = :raza";

        $parameters["animal"] = $animal;
        $parameters["raza"] = $raza;

        $this->connection = Connection::GetInstance();

        $resultSet = $this->connection->Execute($query, $parameters);

        foreach ($resultSet as $row) {

            $idAnimal = $row["idAnimal"];
        }

        return $idAnimal;
    }

    public function GetAll()
    {
        try {
            $mascotasList = array();

            $query = "SELECT * FROM " . $this->tableName . " INNER JOIN Animales ON Mascotas.fk_idAnimal = Animales.idAnimal";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $mascota = $this->ArrayToMascota($row);
                array_push($mascotasList, $mascota);
            }

            return $mascotasList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAnimales()
    {
        $animalesList = array();

        $query = "SELECT * FROM Animales ORDER BY animal, raza";

        $this->connection = Connection::GetInstance();

        $resultSet = $this->connection->Execute($query);

        foreach ($resultSet as $row) {

            $values["idAnimal"] = $row["idAnimal"];
            $values["animal"] = $row["animal"];
            $values["raza"] = $row["raza"];

            array_push($animalesList, $row);
        }

        return $animalesList;
    }

    public function GetListaMascotasByDuenio($idDuenio)
    {
        try {
            $mascotasList = array();

            $query = "SELECT * FROM " . $this->tableName . " INNER JOIN Animales ON Mascotas.fk_idAnimal = Animales.idAnimal WHERE fk_idDuenio = :fk_idDuenio";

            $parameters["fk_idDuenio"] = $idDuenio;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $mascota = $this->ArrayToMascota($row);
                    array_push($mascotasList, $mascota);
                }

                return $mascotasList;
            } else {

                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetMascotaById($idMascota)
    {
        try {
            $mascota = null;

            $query = "SELECT * FROM " . $this->tableName . " INNER JOIN Animales ON Mascotas.fk_idAnimal = Animales.idAnimal WHERE idMascota = :idMascota";

            $parameters["idMascota"] = $idMascota;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {
                    
                    $mascota = $this->ArrayToMascota($row);
                }
            }
            return $mascota;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    //----------------------------------------------------------------------------------------------------------------


    //----Array-Object------------------------------------------------------------------------------------------------
    private function MascotaToArray(Mascota $mascota)
    {
        $array["nombre"] = $mascota->getNombre();
        $array["tamanio"] = $mascota->getTamanio();
        $array["observaciones"] = $mascota->getObservaciones();
        $array["rutaFoto"] = $mascota->getRutaFoto();
        $array["rutaPlanVacunas"] = $mascota->getRutaPlanVacunas();
        $array["rutaVideo"] = $mascota->getRutaVideo();
        $array["fk_idDuenio"] = $mascota->getIdDuenio();
        $array["fk_idAnimal"] = $this->GetIdAnimal($mascota->getAnimal(), $mascota->getRaza());
        $array["alta"] = $mascota->getAlta();

        return $array;
    }

    private function ArrayToMascota($array)
    {
        $mascota = new Mascota(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

        $mascota->setId($array["idMascota"]);
        $mascota->setAnimal($array["animal"]);
        $mascota->setRaza($array["raza"]);
        $mascota->setNombre($array["nombre"]);
        $mascota->setTamanio($array["tamanio"]);
        $mascota->setObservaciones($array["observaciones"]);
        $mascota->setRutaFoto($array["rutaFoto"]);
        $mascota->setRutaPlanVacunas($array["rutaPlanVacunas"]);
        $mascota->setRutaVideo($array["rutaVideo"]);
        $mascota->setIdDuenio($array["fk_idDuenio"]);
        $mascota->setAlta($array["alta"]);

        return $mascota;
    }
    //----------------------------------------------------------------------------------------------------------------
}
