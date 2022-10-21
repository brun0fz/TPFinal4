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
            $query = "INSERT INTO " . $this->tableName . " (fk_idGuardian, fk_idMascota, fechaInicio, fechaFin, precioTotal) VALUES (:fk_idGuardian, :fk_idMascota, :fechaInicio, :fechaFin, :precioTotal);";

            $parameters["fk_idGuardian"] = $reserva->getFkIdGuardian();
            $parameters["fk_idMascota"] = $reserva->getFkIdMascota();
            $parameters["fechaInicio"] = $reserva->getFechaInicio();
            $parameters["fechaFin"] = $reserva->getFechaFin();
            $parameters["precioTotal"] = $reserva->getPrecioTotal();

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

                $reserva = new reserva(NULL, NULL, NULL, NULL, NULL);

                $reserva->setIdReserva($row["idReserva"]);
                $reserva->setFkIdGuardian($row["fk_idGuardian"]);
                $reserva->setFkIdMascota($row["fk_idMascota"]);
                $reserva->setFechaInicio($row["fechaInicio"]);
                $reserva->setFechaFin($row["fechaFin"]);
                $reserva->setPrecioTotal($row["precioTotal"]);

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

            $query = "SELECT * FROM " . $this->tableName . " WHERE (idGuardian = :idGuardian)";

            $parameters["idGuardian"] = $idGuardian;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $reserva = new reserva(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                    $reserva->setIdReserva($row["idReserva"]);
                    $reserva->setFkIdGuardian($row["fk_idGuardian"]);
                    $reserva->setFkIdMascota($row["fk_idMascota"]);
                    $reserva->setFechaInicio($row["fechaInicio"]);
                    $reserva->setFechaFin($row["fechaFin"]);
                    $reserva->setPrecioTotal($row["precioTotal"]);



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
                    $reserva->setFechaInicio($row["fechaInicio"]);
                    $reserva->setFechaFin($row["fechaFin"]);
                    $reserva->setPrecioTotal($row["precioTotal"]);



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
}
