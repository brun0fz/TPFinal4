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

    public function __construct()
    {
        $this->controlReservas();
    }

    private function controlReservas()
    {
        $reservas = $this->getAllByStatus("En curso");

        foreach ($reservas as $reserva) {
            if ($reserva->getFechaFin() < date("Y-m-d")) {
                $this->UpdateEstado($reserva->getIdReserva(), "Finalizada");
            }
        }

        $reservas = $this->getAllByStatus("Confirmada");

        foreach ($reservas as $reserva) {
            if ($reserva->getFechaInicio() <= date("Y-m-d")) {
                if ($reserva->getFechaFin() < date("Y-m-d")) {
                    $this->UpdateEstado($reserva->getIdReserva(), "Finalizada");
                } else {
                    $this->UpdateEstado($reserva->getIdReserva(), "En curso");
                }
            }
        }

        $reservas = $this->getAllByStatus("En espera de pago");

        foreach ($reservas as $reserva) {
            if ($reserva->getFechaInicio() <= date("Y-m-d")) {
                $this->UpdateEstado($reserva->getIdReserva(), "Cancelada");
            }
        }
    }


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

                array_push($reservasList, $reserva);
            }

            return $reservasList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    private function getAllByStatus($estado)
    {
        try {
            $reservasList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE estado = :estado;";

            $parameters["estado"] = $estado;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

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

            $query = "SELECT * FROM " . $this->tableName . " WHERE (fk_idGuardian = :fk_idGuardian) ORDER BY idReserva desc;";

            $parameters["fk_idGuardian"] = $idGuardian;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

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

            $query = "SELECT * FROM " . $this->tableName . " WHERE (fk_idDuenio = :fk_idDuenio) ORDER BY idReserva desc;";

            $parameters["fk_idDuenio"] = $idDuenio;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

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

    public function GetReservaById($idReserva)
    {
        try {
            $reserva = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE (idReserva = :idReserva)";

            $parameters["idReserva"] = $idReserva;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

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
                }

                return $reserva;
            } else {

                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetListaReservasByEstado($idGuardian, $estado)
    {
        try {
            $reservasList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE fk_idGuardian = :fk_idGuardian and estado = :estado";

            $parameters["fk_idGuardian"] = $idGuardian;
            $parameters["estado"] = $estado;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

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

                    array_push($reservasList, $reserva);
                }
            }

            return $reservasList;
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

                    $reserva = new reserva(NULL, NULL, NULL, NULL, NULL, NULL);

                    $reserva->setIdReserva($row["idReserva"]);
                    $reserva->setFkIdGuardian($row["fk_idGuardian"]);
                    $reserva->setFkIdMascota($row["fk_idMascota"]);
                    $reserva->setFkIdDuenio($row["fk_idDuenio"]);
                    $reserva->setFechaInicio($row["fechaInicio"]);
                    $reserva->setFechaFin($row["fechaFin"]);
                    $reserva->setPrecioTotal($row["precioTotal"]);
                    $reserva->setEstado($row["estado"]);

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

                    $reserva = new reserva(NULL, NULL, NULL, NULL, NULL, NULL);

                    $reserva->setIdReserva($row["idReserva"]);
                    $reserva->setFkIdGuardian($row["fk_idGuardian"]);
                    $reserva->setFkIdMascota($row["fk_idMascota"]);
                    $reserva->setFkIdDuenio($row["fk_idDuenio"]);
                    $reserva->setFechaInicio($row["fechaInicio"]);
                    $reserva->setFechaFin($row["fechaFin"]);
                    $reserva->setPrecioTotal($row["precioTotal"]);
                    $reserva->setEstado($row["estado"]);
                }
            }
            return $reserva;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
