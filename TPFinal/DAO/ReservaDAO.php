<?php

namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\IReservaDAO as IReservaDAO;
use Models\Cupon;
use Models\EstadoReserva;
use Models\Reserva;
use Models\Review;

class ReservaDAO implements IReservaDAO
{
    private $connection;
    private $tableName = "Reservas";

    public function __construct()
    {
        $this->ControlReservas();
    }

    private function ControlReservas()
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

    public function AddReview($review)
    {
        try {
            $query = "INSERT INTO Reviews (comentario, puntaje, fk_idReserva) VALUES (:comentario, :puntaje, :fk_idReserva);";

            $parameters["comentario"] = $review->getComentario();
            $parameters["puntaje"] = $review->getPuntaje();
            $parameters["fk_idReserva"] = $review->getFkIdReserva();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function AddCupon($cupon)
    {
        try {
            $query = "INSERT INTO Cupones (total, fk_idReserva) VALUES (:total, :fk_idReserva);";

            $parameters["total"] = $cupon->getTotal();
            $parameters["fk_idReserva"] = $cupon->getFkIdReserva();

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

    public function GetCuponByIdReserva($idReserva)
    {
        try {
            $cupon = null;

            $query = "SELECT * FROM Cupones WHERE (fk_idReserva = :fk_idReserva)";

            $parameters["fk_idReserva"] = $idReserva;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $cupon = new Cupon(NULL, NULL, NULL);

                    $cupon->setIdCupon($row["idCupon"]);
                    $cupon->setTotal($row["total"]);
                    $cupon->setFkIdReserva($row["fk_idReserva"]);
                }
            }

            return $cupon;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetReviewByIdReserva($idReserva)
    {
        try {
            $review = null;

            $query = "SELECT * FROM Reviews WHERE (fk_idReserva = :fk_idReserva)";

            $parameters["fk_idReserva"] = $idReserva;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $review = new Review(NULL, NULL, NULL);

                    $review->setIdReview($row["idReview"]);
                    $review->setComentario($row["comentario"]);
                    $review->setPuntaje($row["puntaje"]);
                    $review->setFkIdReserva($row["fk_idReserva"]);
                }
            }

            return $review;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetReservaGuardianByDia($idGuardian, $dia)
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

    public function GetListaReservasByDuenio($idDuenio)
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


    public function GetListaReservasByGuardian($idGuardian)
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
    

    public function GetListaReservasDuenioByEstado($idDuenio, $estado)
    {
        try {
            $reservasList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE (fk_idDuenio = :fk_idDuenio AND estado = :estado) ORDER BY fechaInicio desc;";

            $parameters["fk_idDuenio"] = $idDuenio;
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

                return $reservasList;
            } else {

                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function GetListaReservasGuardianByEstado($idGuardian, $estado)
    {
        try {
            $reservasList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE (fk_idGuardian = :fk_idGuardian AND estado = :estado) ORDER BY fechaInicio desc;";

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

                return $reservasList;
            } else {

                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetListaReservasMascotaByEstado($idMascota, $estado)
    {
        try {
            $reservasList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE (fk_idMascota = :fk_idMascota AND estado = :estado) ORDER BY fechaInicio desc;";

            $parameters["fk_idMascota"] = $idMascota;
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
