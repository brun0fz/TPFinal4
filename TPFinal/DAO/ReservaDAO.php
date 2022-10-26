<?php

namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\IReservaDAO as IReservaDAO;
use Models\Reserva;

class ReservaDAO implements IReservaDAO
{
    private $connection;
    private $tableName = "Reservas";

    public function Add(Reserva $reserva)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (fechaInicio, fechaFin, precioTotal, fk_idMascota, fk_idDuenio, fk_idGuardian) VALUES (:fechaInicio, :fechaFin, :precioTotal, :fk_idMascota, :fk_idDuenio, :fk_idGuardian);";


            $parameters["fechaInicio"] = $reserva->getFechaInicio();
            $parameters["fechaFin"] = $reserva->getFechaFin();
            $parameters["precioTotal"] = $reserva->getPrecioTotal();
            $parameters["fk_idMascota"] = $reserva->getFkIdMascota();
            $parameters["fk_idDuenio"] = $reserva->getFkIdDuenio();
            $parameters["fk_idGuardian"] = $reserva->getFkIdGuardian();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $reservasList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $reserva = new reserva(NULL, NULL, NULL, NULL, NULL, NULL);

                $reserva->setIdReserva($row["idReserva"]);
                $reserva->setFkIdGuardian($row["fk_idGuardian"]);
                $reserva->setFkIdMascota($row["fk_idMascota"]);
                $reserva->setFkIdDuenio($row["fk_idDuenio"]);
                $reserva->setFechaInicio($row["fechaInicio"]);
                $reserva->setFechaFin($row["fechaFin"]);
                $reserva->setPrecioTotal($row["precioTotal"]);
                $reserva->setEstado($row["estado"]);
                $reserva->setPuntaje($row["puntaje"]);

                array_push($reservasList, $reserva);
            }

            return $reservasList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function ListaReservasGuardian($idGuardian)
    {
        try {
            $reservasList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE (fk_idGuardian = :fk_idGuardian)";

            $parameters["fk_idGuardian"] = $idGuardian;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $reserva = new reserva(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                    $reserva->setIdReserva($row["idReserva"]);
                    $reserva->setFkIdGuardian($row["fk_idGuardian"]);
                    $reserva->setFkIdMascota($row["fk_idMascota"]);
                    $reserva->setFkIdDuenio($row["fk_idDuenio"]);
                    $reserva->setFechaInicio($row["fechaInicio"]);
                    $reserva->setFechaFin($row["fechaFin"]);
                    $reserva->setPrecioTotal($row["precioTotal"]);
                    $reserva->setEstado($row["estado"]);
                    $reserva->setPuntaje($row["puntaje"]);

                    array_push($reservasList, $reserva);
                }

                return $reservasList;
            } else {

                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function ListaReservasDuenio($idDuenio)
    {
        try {
            $reservasList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE (fk_idDuenio = :fk_idDuenio)";

            $parameters["fk_idDuenio"] = $idDuenio;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $reserva = new reserva(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                    $reserva->setIdReserva($row["idReserva"]);
                    $reserva->setFkIdGuardian($row["fk_idGuardian"]);
                    $reserva->setFkIdMascota($row["fk_idMascota"]);
                    $reserva->setFkIdDuenio($row["fk_idDuenio"]);
                    $reserva->setFechaInicio($row["fechaInicio"]);
                    $reserva->setFechaFin($row["fechaFin"]);
                    $reserva->setPrecioTotal($row["precioTotal"]);
                    $reserva->setEstado($row["estado"]);
                    $reserva->setPuntaje($row["puntaje"]);

                    array_push($reservasList, $reserva);
                }

                return $reservasList;
            } else {

                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }



    public function ListaReservasMascota($idMascota)
    {
        try {
            $reservasList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE (idMascota = :idMascota)";

            $parameters["idMascota"] = $idMascota;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $reserva = new reserva(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                    $reserva->setIdReserva($row["idReserva"]);
                    $reserva->setFkIdGuardian($row["fk_idGuardian"]);
                    $reserva->setFkIdMascota($row["fk_idMascota"]);
                    $reserva->setFkIdDuenio($row["fk_idDuenio"]);
                    $reserva->setFechaInicio($row["fechaInicio"]);
                    $reserva->setFechaFin($row["fechaFin"]);
                    $reserva->setPrecioTotal($row["precioTotal"]);
                    $reserva->setEstado($row["estado"]);
                    $reserva->setPuntaje($row["puntaje"]);

                    array_push($reservasList, $reserva);
                }

                return $reservasList;
            } else {

                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function UpdateEstado($idReserva, $estado)
    {
        try {
            $query = "UPDATE " . $this->tableName . " SET estado = :estado WHERE idReserva = :idReserva;";

            $parameters["estado"] = $estado;
            $parameters["idReserva"] = $idReserva;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetReservaGuardianxDia($idGuardian, $dia)
    {
        try {
            $reserva = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE fechaInicio >= :dia AND fechaFin <= :dia AND fk_idGuardian = :idGuardian";

            $parameters['idGuardian'] = $idGuardian;
            $parameters['dia'] = $dia;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $reserva = new reserva(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                    $reserva->setIdReserva($row["idReserva"]);
                    $reserva->setFkIdGuardian($row["fk_idGuardian"]);
                    $reserva->setFkIdMascota($row["fk_idMascota"]);
                    $reserva->setFkIdDuenio($row["fk_idDuenio"]);
                    $reserva->setFechaInicio($row["fechaInicio"]);
                    $reserva->setFechaFin($row["fechaFin"]);
                    $reserva->setPrecioTotal($row["precioTotal"]);
                    $reserva->setEstado($row["estado"]);
                    $reserva->setPuntaje($row["puntaje"]);
                }
            }
            return $reserva;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
