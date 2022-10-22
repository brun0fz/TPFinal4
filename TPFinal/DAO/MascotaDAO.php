<?php

namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use Models\Mascota;

class MascotaDAO implements IMascotaDAO
{
    private $connection;
    private $tableName = "Mascotas";

    public function Add(Mascota $mascota)
    {
        try {

            $parameters = array();

            $query = "INSERT INTO Animales (animal, raza) VALUES (:animal, :raza);";

            $parameters["animal"] = $mascota->getAnimal();
            $parameters["raza"] = $mascota->getRaza();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            $parameters = array();

            $query = "INSERT INTO " . $this->tableName . " (nombre, tamanio, observaciones, rutaFoto, rutaPlanVacunas, fk_idDuenio, fk_idAnimal, alta) VALUES (:nombre, :tamanio, :observaciones, :rutaFoto, :rutaPlanVacunas, :fk_idDuenio, LAST_INSERT_ID(), :alta);";

            $parameters["nombre"] = $mascota->getNombre();
            $parameters["tamanio"] = $mascota->getTamanio();
            $parameters["observaciones"] = $mascota->getObservaciones();
            $parameters["rutaFoto"] = $mascota->getRutaFoto();
            $parameters["rutaPlanVacunas"] = $mascota->getRutaPlanVacunas();
            $parameters["fk_idDuenio"] = $mascota->getIdDuenio();
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
            $mascotasList = array();

            $query = "SELECT * FROM " . $this->tableName . " INNER JOIN Animales ON Mascotas.fk_idAnimal = Animales.idAnimal";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $mascota = new Mascota(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                $mascota->setId($row["idMascota"]);
                $mascota->setAnimal($row["animal"]);
                $mascota->setRaza($row["raza"]);
                $mascota->setNombre($row["nombre"]);
                $mascota->setTamanio($row["tamanio"]);
                $mascota->setObservaciones($row["observaciones"]);
                $mascota->setRutaFoto($row["rutaFoto"]);
                $mascota->setRutaPlanVacunas($row["rutaPlanVacunas"]);
                $mascota->setIdDuenio($row["fk_idDuenio"]);
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

            $query = "SELECT * FROM " . $this->tableName . " INNER JOIN Animales ON Mascotas.fk_idAnimal = Animales.idAnimal WHERE fk_idDuenio = :fk_idDuenio";

            $parameters["fk_idDuenio"] = $idDuenio;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $mascota = new Mascota(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                    $mascota->setId($row["idMascota"]);
                    $mascota->setAnimal($row["animal"]);
                    $mascota->setRaza($row["raza"]);
                    $mascota->setNombre($row["nombre"]);
                    $mascota->setTamanio($row["tamanio"]);
                    $mascota->setObservaciones($row["observaciones"]);
                    $mascota->setRutaFoto($row["rutaFoto"]);
                    $mascota->setRutaPlanVacunas($row["rutaPlanVacunas"]);
                    $mascota->setIdDuenio($row["fk_idDuenio"]);
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
