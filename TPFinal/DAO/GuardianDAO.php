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

            $parameters = array();

            $query = "INSERT INTO Direcciones (calle, numero, piso, departamento, codigoPostal) VALUES (:calle, :numero, :piso, :departamento, :codigoPostal);";

            $parameters["calle"] = $guardian->getCalle();
            $parameters["numero"] = $guardian->getNumero();
            $parameters["piso"] = $guardian->getPiso();
            $parameters["departamento"] = $guardian->getDepartamento();
            $parameters["codigoPostal"] = $guardian->getCodigoPostal();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            $parameters = array();

            $query = "INSERT INTO " . $this->tableName . " (nombre, apellido, telefono, email, password, tipo, rutaFoto, alta, fk_idDireccion) VALUES (:nombre, :apellido, :telefono, :email, :password, :tipo, :rutaFoto, :alta, LAST_INSERT_ID());";

            $parameters["nombre"] = $guardian->getNombre();
            $parameters["apellido"] = $guardian->getApellido();
            $parameters["telefono"] = $guardian->getTelefono();
            $parameters["email"] = $guardian->getEmail();
            $parameters["password"] = $guardian->getPassword();
            $parameters["tipo"] = $guardian->getTipo();
            $parameters["rutaFoto"] = $guardian->getRutaFoto();
            $parameters["alta"] = $guardian->getAlta();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            $parameters = array();

            $query = "INSERT INTO TamaniosMascota (pequenia) values (:pequenia);";

            $parameters["pequenia"] = 0;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            $parameters = array();

            $query = "UPDATE Guardianes SET fk_tamanioMascota = LAST_INSERT_ID() WHERE email = :email";

            $parameters["email"] = $guardian->getEmail();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);


            $parameters = array();

            $query = "INSERT INTO Disponibilidades (lunes) values (:lunes);";

            $parameters["lunes"] = 0;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);

            $parameters = array();

            $query = "UPDATE Guardianes SET fk_idDisponibilidad = LAST_INSERT_ID() WHERE email = :email";

            $parameters["email"] = $guardian->getEmail();

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

            $query = "SELECT * FROM " . $this->tableName . " INNER JOIN Direcciones ON Guardianes.fk_idDireccion = Direcciones.idDireccion";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $guardian = new Guardian(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                $guardian->setId($row["idGuardian"]);
                $guardian->setNombre($row["nombre"]);
                $guardian->setApellido($row["apellido"]);
                $guardian->setTelefono($row["telefono"]);
                $guardian->setEmail($row["email"]);
                $guardian->setPassword($row["password"]);
                $guardian->setPrecioXDia($row["precioXDia"]);
                $guardian->setReputacion($row["reputacion"]);
                $guardian->setAlta($row["alta"]);
                $guardian->setTipo($row["tipo"]);
                $guardian->setRutaFoto($row["rutaFoto"]);

                $guardian->setCalle($row["calle"]);
                $guardian->setNumero($row["numero"]);
                $guardian->setPiso($row["piso"]);
                $guardian->setDepartamento($row["departamento"]);
                $guardian->setCodigoPostal($row["codigoPostal"]);



                /*$guardian->setTamanioMascotaCuidar(explode(",", $row["tamanioMascota"]));
                $guardian->setDisponibilidad(explode(",", $row["disponibilidad"]));*/

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

            $query = "SELECT * FROM " . $this->tableName . " INNER JOIN Direcciones ON Guardianes.fk_idDireccion = Direcciones.idDireccion WHERE (email = :email)";

            $parameters["email"] = $email;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $guardian = new Guardian(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                    $guardian->setId($row["idGuardian"]);
                    $guardian->setNombre($row["nombre"]);
                    $guardian->setApellido($row["apellido"]);
                    $guardian->setTelefono($row["telefono"]);
                    $guardian->setEmail($row["email"]);
                    $guardian->setPassword($row["password"]);
                    $guardian->setAlta($row["alta"]);
                    $guardian->setTipo($row["tipo"]);
                    $guardian->setRutaFoto($row["rutaFoto"]);
                    $guardian->setPrecioXDia($row["precioXDia"]);
                    $guardian->setReputacion($row["reputacion"]);

                    $guardian->setCalle($row["calle"]);
                    $guardian->setNumero($row["numero"]);
                    $guardian->setPiso($row["piso"]);
                    $guardian->setDepartamento($row["departamento"]);
                    $guardian->setCodigoPostal($row["codigoPostal"]);

                    //$guardian->setTamanioMascotaCuidar(explode(",", $row["tamanioMascota"]));
                    // $guardian->setDisponibilidad(explode(",", $row["disponibilidad"]));

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

    public function BuscarId($idGuardian)
    {
        try {
            $guardian = null;

            $query = "SELECT * FROM " . $this->tableName . " INNER JOIN Direcciones ON Guardianes.fk_idDireccion = Direcciones.idDireccion WHERE (idGuardian = :idGuardian)";

            $parameters["idGuardian"] = $idGuardian;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $guardian = new Guardian(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                    $guardian->setId($row["idGuardian"]);
                    $guardian->setNombre($row["nombre"]);
                    $guardian->setApellido($row["apellido"]);
                    $guardian->setTelefono($row["telefono"]);
                    $guardian->setEmail($row["email"]);
                    $guardian->setPassword($row["password"]);
                    $guardian->setAlta($row["alta"]);
                    $guardian->setTipo($row["tipo"]);
                    $guardian->setRutaFoto($row["rutaFoto"]);
                    $guardian->setPrecioXDia($row["precioXDia"]);
                    $guardian->setReputacion($row["reputacion"]);

                    $guardian->setCalle($row["calle"]);
                    $guardian->setNumero($row["numero"]);
                    $guardian->setPiso($row["piso"]);
                    $guardian->setDepartamento($row["departamento"]);
                    $guardian->setCodigoPostal($row["codigoPostal"]);

                    //$guardian->setTamanioMascotaCuidar(explode(",", $row["tamanioMascota"]));
                    //$guardian->setDisponibilidad(explode(",", $row["disponibilidad"]));

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
