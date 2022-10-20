<?php

namespace DAO;

use \Exception as Exception;
use Models\Duenio as Duenio;
use DAO\Connection as Connection;
use Models\Mascota;

class MascotaDAO implements IMascotaDAO
{
    private $connection;
    private $tableName = "Mascotas";

    public function Add(Mascota $mascota)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (animal, raza, nombre, tamanio, observaciones, rutaFoto, rutaPlanVacunas, idDuenio, alta) VALUES (:animal, :raza, :nombre, :tamanio, :observaciones, :rutaFoto, :rutaPlanVacunas, :idDuenio, :alta);";

            $parameters["animal"] = $mascota->getAnimal();
            $parameters["raza"] = $mascota->getRaza();
            $parameters["nombre"] = $mascota->getNombre();
            $parameters["tamanio"] = $mascota->getTamanio();
            $parameters["observaciones"] = $mascota->getObservaciones();
            $parameters["rutaFoto"] = $mascota->getRutaFoto();
            $parameters["rutaPlanVacunas"] = $mascota->getRutaPlanVacunas();
            $parameters["idDuenio"] = $mascota->getIdDuenio();
            $parameters["alta"] = $mascota->getAlta();


            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $duenioList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $mascota = new Mascota(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                $mascota->setId($row["id"]);
                $mascota->setAnimal($row["animal"]);
                $mascota->setRaza($row["raza"]);
                $mascota->setNombre($row["nombre"]);
                $mascota->setTamanio($row["tamanio"]);
                $mascota->setObservaciones($row["observaciones"]);
                $mascota->setRutaFoto($row["rutaFoto"]);
                $mascota->setRutaPlanVacunas($row["rutaPlanVacunas"]);
                $mascota->setIdDuenio($row["idDuenio"]);
                $mascota->setAlta($row["alta"]);

                array_push($mascotasList, $mascota);
            }

            return $mascotasList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function ListaDuenio($idDuenio)
    {
        try {
            $mascotasList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE (idDuenio = :idDuenio)";

            $parameters["idDuenio"] = $idDuenio;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $mascota = new Mascota(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                    $mascota->setId($row["id"]);
                    $mascota->setAnimal($row["animal"]);
                    $mascota->setRaza($row["raza"]);
                    $mascota->setNombre($row["nombre"]);
                    $mascota->setTamanio($row["tamanio"]);
                    $mascota->setObservaciones($row["observaciones"]);
                    $mascota->setRutaFoto($row["rutaFoto"]);
                    $mascota->setRutaPlanVacunas($row["rutaPlanVacunas"]);
                    $mascota->setIdDuenio($row["idDuenio"]);
                    $mascota->setAlta($row["alta"]);


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
}
