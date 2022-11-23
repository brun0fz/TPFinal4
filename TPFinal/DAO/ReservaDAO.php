<?php

namespace DAO;

use Controllers\HomeController;
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
        try {
            $this->ControlReservas();
        } catch (Exception $ex) {
        }
    }

    private function ControlReservas()
    {
        try {
            $reservas = $this->getAllByStatus(EstadoReserva::EN_CURSO->value);

            foreach ($reservas as $reserva) {
                if ($reserva->getFechaFin() < date("Y-m-d")) {
                    $this->UpdateEstado($reserva->getIdReserva(), EstadoReserva::FINALIZADA->value);
                }
            }

            $reservas = $this->getAllByStatus(EstadoReserva::CONFIRMADA->value);

            foreach ($reservas as $reserva) {
                if ($reserva->getFechaInicio() <= date("Y-m-d")) {
                    if ($reserva->getFechaFin() < date("Y-m-d")) {
                        $this->UpdateEstado($reserva->getIdReserva(), EstadoReserva::FINALIZADA->value);
                    } else {
                        $this->UpdateEstado($reserva->getIdReserva(), EstadoReserva::EN_CURSO->value);
                    }
                }
            }

            $reservas = $this->getAllByStatus(EstadoReserva::ESPERA->value);

            foreach ($reservas as $reserva) {
                if ($reserva->getFechaInicio() <= date("Y-m-d")) {
                    $this->UpdateEstado($reserva->getIdReserva(), EstadoReserva::CANCELADA->value);
                }
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    //----Adds--------------------------------------------------------------------------------------------------------
    public function Add(Reserva $reserva)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (fechaInicio, fechaFin, precioTotal, fk_idMascota, fk_idDuenio, fk_idGuardian) VALUES (:fechaInicio, :fechaFin, :precioTotal, :fk_idMascota, :fk_idDuenio, :fk_idGuardian);";

            $parameters = $this->ReservaToArray($reserva);

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

            $parameters = $this->ReviewToArray($review);

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

            $parameters = $this->CuponToArray($cupon);

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    //----------------------------------------------------------------------------------------------------------------


    //----Gets--------------------------------------------------------------------------------------------------------
    public function GetAll()
    {
        try {
            $reservasList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $reserva = $this->ArrayToReserva($row);
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

                $reserva = $this->ArrayToReserva($row);
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

                    $reserva = $this->ArrayToReserva($row);
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

                    $cupon = $this->ArrayToCupon($row);
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

                    $review = $this->ArrayToReview($row);
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

            $query = "SELECT * FROM " . $this->tableName . " WHERE (fechaInicio <= :dia AND fechaFin >= :dia) AND fk_idGuardian = :idGuardian";

            $parameters['idGuardian'] = $idGuardian;
            $parameters['dia'] = $dia;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $reserva = $this->ArrayToReserva($row);
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

                    $reserva = $this->ArrayToReserva($row);
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

                    $reserva = $this->ArrayToReserva($row);
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

            $query = "SELECT * FROM " . $this->tableName . " WHERE (fk_idDuenio = :fk_idDuenio AND estado = :estado) ORDER BY fechaInicio asc;";

            $parameters["fk_idDuenio"] = $idDuenio;
            $parameters["estado"] = $estado;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $reserva = $this->ArrayToReserva($row);
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

            $query = "SELECT * FROM " . $this->tableName . " WHERE (fk_idGuardian = :fk_idGuardian AND estado = :estado) ORDER BY fechaInicio asc;";

            $parameters["fk_idGuardian"] = $idGuardian;
            $parameters["estado"] = $estado;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $reserva = $this->ArrayToReserva($row);
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

            $query = "SELECT * FROM " . $this->tableName . " WHERE (fk_idMascota = :fk_idMascota AND estado = :estado) ORDER BY fechaInicio asc;";

            $parameters["fk_idMascota"] = $idMascota;
            $parameters["estado"] = $estado;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $reserva = $this->ArrayToReserva($row);
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
    //----------------------------------------------------------------------------------------------------------------


    //----Updates-----------------------------------------------------------------------------------------------------
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
    //----------------------------------------------------------------------------------------------------------------


    //----Array-Object------------------------------------------------------------------------------------------------
    private function ReservaToArray(Reserva $reserva)
    {
        $array["fechaInicio"] = $reserva->getFechaInicio();
        $array["fechaFin"] = $reserva->getFechaFin();
        $array["precioTotal"] = $reserva->getPrecioTotal();
        $array["fk_idMascota"] = $reserva->getFkIdMascota();
        $array["fk_idDuenio"] = $reserva->getFkIdDuenio();
        $array["fk_idGuardian"] = $reserva->getFkIdGuardian();

        return $array;
    }

    private function ArrayToReserva($array)
    {
        $reserva = new reserva(NULL, NULL, NULL, NULL, NULL, NULL);

        $reserva->setIdReserva($array["idReserva"]);
        $reserva->setFkIdGuardian($array["fk_idGuardian"]);
        $reserva->setFkIdMascota($array["fk_idMascota"]);
        $reserva->setFkIdDuenio($array["fk_idDuenio"]);
        $reserva->setFechaInicio($array["fechaInicio"]);
        $reserva->setFechaFin($array["fechaFin"]);
        $reserva->setPrecioTotal($array["precioTotal"]);
        $reserva->setEstado($array["estado"]);

        return $reserva;
    }

    private function ReviewToArray(Review $review)
    {
        $array["comentario"] = $review->getComentario();
        $array["puntaje"] = $review->getPuntaje();
        $array["fk_idReserva"] = $review->getFkIdReserva();

        return $array;
    }

    private function ArrayToReview($array)
    {
        $review = new Review(NULL, NULL, NULL);

        $review->setIdReview($array["idReview"]);
        $review->setComentario($array["comentario"]);
        $review->setPuntaje($array["puntaje"]);
        $review->setFkIdReserva($array["fk_idReserva"]);

        return $review;
    }

    private function CuponToArray(Cupon $cupon)
    {
        $array["total"] = $cupon->getTotal();
        $array["fk_idReserva"] = $cupon->getFkIdReserva();

        return $array;
    }

    private function ArrayToCupon($array)
    {
        $cupon = new Cupon(NULL, NULL, NULL);

        $cupon->setIdCupon($array["idCupon"]);
        $cupon->setTotal($array["total"]);
        $cupon->setFkIdReserva($array["fk_idReserva"]);

        return $cupon;
    }
    //----------------------------------------------------------------------------------------------------------------
}
