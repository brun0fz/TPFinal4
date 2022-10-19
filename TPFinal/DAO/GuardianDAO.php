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
            echo "holaa en add";

            $query = "INSERT INTO " . $this->tableName . " (nombre, apellido, telefono, email, password, tipo, rutaFoto, alta, calle, numero, precioXDia, reputacion) VALUES (:nombre, :apellido, :telefono, :email, :password, :tipo, :rutaFoto, :alta, :calle, :numero, :precioXDia, :reputacion);";

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

            /*
            $parameters["tamanioMascotaCuidar"] = $guardian->getTamanioMascotaCuidar();
            $parameters["diasOcupados"] = $guardian->getDiasOcupados();
            $parameters["disponibilidad"] = $guardian->getDisponibilidad();
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

                $guardian->setId($row["id"]);
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

                /*
                $guardian->setTamanioMascotaCuidar($row["tamanioMascotaCuidar"]);
                $guardian->setDiasOcupados($row["diasOcupados"]);
                $guardian->setDisponibilidad($row["disponibilidad"]);
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

                    $guardian->setId($row["id"]);
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

                    /*
                    $guardian->setTamanioMascotaCuidar($row["tamanioMascotaCuidar"]);
                    $guardian->setDiasOcupados($row["diasOcupados"]);
                    $guardian->setDisponibilidad($row["disponibilidad"]);
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
