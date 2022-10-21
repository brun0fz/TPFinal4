<?php

namespace DAO;

use \Exception as Exception;
use DAO\IGuardianDAO as IGuardianDAO;
use Models\Guardian as Guardian;
use DAO\Connection as Connection;

class GuardianDAO implements IGuardianDAO
{
    private $connection;
    private $tableName = "Guardianes";

    public function Add(Guardian $guardian)
    {
        try {

            $query = "INSERT INTO " . $this->tableName . " (nombre, apellido, telefono, email, password, tipo, rutaFoto, alta, calle, numero, precioXDia, reputacion, tamanioMascota, disponibilidad) VALUES (:nombre, :apellido, :telefono, :email, :password, :tipo, :rutaFoto, :alta, :calle, :numero, :precioXDia, :reputacion, :tamanioMascota, :disponibilidad);";

            $parameters["nombre"] = $guardian->getNombre();
            $parameters["apellido"] = $guardian->getApellido();
            $parameters["telefono"] = $guardian->getTelefono();
            $parameters["email"] = $guardian->getEmail();
            $parameters["password"] = $guardian->getPassword();
            $parameters["tipo"] = $guardian->getTipo();
            $parameters["rutaFoto"] = $guardian->getRutaFoto();

            $parameters["alta"] = $guardian->getAlta();

            $parameters["calle"] = $guardian->getCalle();
            $parameters["numero"] = $guardian->getNumero();
            $parameters["precioXDia"] = $guardian->getPrecioXDia();
            $parameters["reputacion"] = $guardian->getReputacion();

            $parameters["tamanioMascota"] = implode(",", $guardian->getTamanioMascotaCuidar());
            $parameters["disponibilidad"] = implode(",", $guardian->getDisponibilidad());

            /*
            $parameters["diasOcupados"] = $guardian->getDiasOcupados();
            */

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $guardianesList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $guardian = new Guardian(NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                $guardian->setId($row["idGuardian"]);
                $guardian->setNombre($row["nombre"]);
                $guardian->setApellido($row["apellido"]);
                $guardian->setTelefono($row["telefono"]);
                $guardian->setEmail($row["email"]);
                $guardian->setPassword($row["password"]);

                $guardian->setAlta($row["alta"]);
                $guardian->setTipo($row["tipo"]);
                $guardian->setRutaFoto($row["rutaFoto"]);

                $guardian->setCalle($row["calle"]);
                $guardian->setNumero($row["numero"]);
                $guardian->setPrecioXDia($row["precioXDia"]);
                $guardian->setReputacion($row["reputacion"]);

                $guardian->setTamanioMascotaCuidar(explode(",", $row["tamanioMascota"]));
                $guardian->setDisponibilidad(explode(",", $row["disponibilidad"]));

                /*
                $guardian->setDiasOcupados($row["diasOcupados"]);
                */

                array_push($guardianesList, $guardian);
            }

            return $guardianesList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function Buscar($email)
    {
        try {
            $guardian = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE (email = :email)";

            $parameters["email"] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $guardian = new Guardian(NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                    $guardian->setId($row["idGuardian"]);
                    $guardian->setNombre($row["nombre"]);
                    $guardian->setApellido($row["apellido"]);
                    $guardian->setTelefono($row["telefono"]);
                    $guardian->setEmail($row["email"]);
                    $guardian->setPassword($row["password"]);
                    $guardian->setAlta($row["alta"]);
                    $guardian->setTipo($row["tipo"]);
                    $guardian->setRutaFoto($row["rutaFoto"]);


                    $guardian->setCalle($row["calle"]);
                    $guardian->setNumero($row["numero"]);
                    $guardian->setPrecioXDia($row["precioXDia"]);
                    $guardian->setReputacion($row["reputacion"]);

                    $guardian->setTamanioMascotaCuidar(explode(",", $row["tamanioMascota"]));
                    $guardian->setDisponibilidad(explode(",", $row["disponibilidad"]));

                    /*
                    $guardian->setDiasOcupados($row["diasOcupados"]);
                    
                    */
                }

                return $guardian;
            } else {

                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function UpdateTamanios($tamanioMascota, $idGuardian)
    {
        try {
            $query = "UPDATE " . $this->tableName . " SET tamanioMascota = :tamanioMascota WHERE idGuardian = :idGuardian;";

            $parameters["tamanioMascota"] = implode(",", $tamanioMascota);
            $parameters["idGuardian"] = $idGuardian;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function UpdatePrecio($precioXDia, $idGuardian)
    {
        try {
            $query = "UPDATE " . $this->tableName . " SET precioXDia = :precioXDia WHERE idGuardian = :idGuardian;";

            $parameters["precioXDia"] = $precioXDia;
            $parameters["idGuardian"] = $idGuardian;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function UpdateDisponibilidad($disponibilidad, $idGuardian)
    {
        try {
            $query = "UPDATE " . $this->tableName . " SET disponibilidad = :disponibilidad WHERE idGuardian = :idGuardian;";

            $parameters["disponibilidad"] = implode(",", $disponibilidad);
            $parameters["idGuardian"] = $idGuardian;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
