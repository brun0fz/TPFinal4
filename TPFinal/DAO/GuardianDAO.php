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
            $query = "INSERT INTO " . $this->tableName . " (nombre, apellido, telefono,email, password, tipo, rutaFoto, alta) VALUES (:nombre, :apellido, :telefono, :email, :password, :tipo, :rutaFoto, :alta);";

            $parameters["nombre"] = $guardian->getNombre();
            $parameters["apellido"] = $guardian->getApellido();
            $parameters["telefono"] = $guardian->getTelefono();
            $parameters["email"] = $guardian->getEmail();
            $parameters["password"] = $guardian->getPassword();
            $parameters["tipo"] = $guardian->getTipo();
            $parameters["rutaFoto"] = $guardian->getRutaFoto();
            $parameters["direccion"] = $guardian->getDireccion();
            $parameters["alta"] = $guardian->getAlta();
            $parameters["tamanioMascotaCuidar"] = $guardian->getTamanioMascotaCuidar();
            $parameters["reputacion"] = $guardian->getReputacion();
            $parameters["diasOcupados"] = $guardian->getDiasOcupados();
            $parameters["precioXDia"] = $guardian->getPrecioXDia();
            $parameters["disponibilidad"] = $guardian->getDisponibilidad();

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

                $guardian = new Guardian(NULL, NULL, NULL, NULL, NULL, NULL);

                $guardian->setId($row["id"]);
                $guardian->setNombre($row["nombre"]);
                $guardian->setApellido($row["apellido"]);
                $guardian->setTelefono($row["telefono"]);
                $guardian->setEmail($row["email"]);
                $guardian->setPassword($row["password"]);
                $guardian->setDireccion($row["direccion"]);
                $guardian->setAlta($row["alta"]);
                $guardian->setTipo($row["tipo"]);
                $guardian->setRutaFoto($row["rutaFoto"]);
                $guardian->setTamanioMascotaCuidar($row["tamanioMascotaCuidar"]);
                $guardian->setReputacion($row["reputacion"]);
                $guardian->setDiasOcupados($row["diasOcupados"]);
                $guardian->setDisponibilidad($row["disponibilidad"]);
                $guardian->setPrecioXDia($row["precioXDia"]);

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
            $duenio = NULL;

            $query = "SELECT * FROM " . $this->tableName . " WHERE (email = :email)";

            $parameters["email"] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $guardian = new Guardian(NULL, NULL, NULL, NULL, NULL, NULL);

                    $guardian->setId($row["id"]);
                    $guardian->setNombre($row["nombre"]);
                    $guardian->setApellido($row["apellido"]);
                    $guardian->setTelefono($row["telefono"]);
                    $guardian->setEmail($row["email"]);
                    $guardian->setPassword($row["password"]);
                    $guardian->setDireccion($row["direccion"]);
                    $guardian->setAlta($row["alta"]);
                    $guardian->setTipo($row["tipo"]);
                    $guardian->setRutaFoto($row["rutaFoto"]);
                    $guardian->setTamanioMascotaCuidar($row["tamanioMascotaCuidar"]);
                    $guardian->setReputacion($row["reputacion"]);
                    $guardian->setDiasOcupados($row["diasOcupados"]);
                    $guardian->setDisponibilidad($row["disponibilidad"]);
                    $guardian->setPrecioXDia($row["precioXDia"]);
                }

                return $guardian;
            } else {

                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    /*PASAR A MYSQL*/
    /*
    
     public function UpdateDisponibilidad($dias, $guardian)
    {
        $guardian = $this->Buscar($guardian->getEmail());

        $guardian->setDisponibilidad($dias);

        $this->SaveData();
    }

    public function UpdateTamanios($tamanios, $guardian)
    {
        $guardian = $this->Buscar($guardian->getEmail());

        $guardian->setTamanioMascotaCuidar($tamanios);

        $this->SaveData();
    }

    public function UpdatePrecio($precio, $guardian)
    {
        $guardian = $this->Buscar($guardian->getEmail());

        $guardian->setPrecioXDia($precio);

        $this->SaveData();
    }
    
    
    */
}
