<?php

namespace DAO;

use \Exception as Exception;
use DAO\IDuenioDAO as IDuenioDAO;
use Models\Duenio as Duenio;
use DAO\Connection as Connection;

class DuenioDAO implements IDuenioDAO
{
    private $connection;
    private $tableName = "Duenios";
    

    //----Adds--------------------------------------------------------------------------------------------------------
    public function Add(Duenio $duenio)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (nombre, apellido, telefono,email, password, tipo, rutaFoto, alta) VALUES (:nombre, :apellido, :telefono, :email, aes_encrypt(:password, :encryptpass), :tipo, :rutaFoto, :alta);";

            $parameters = $this->DuenioToArray($duenio);
            $parameters["encryptpass"] = ENCRYPTPASS;

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
            $duenioList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $row["password"] = null;

                array_push($dueniosList, $this->ArrayToDuenio($row));
            }

            return $dueniosList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetDuenioByEmail($email)
    {
        try {
            $duenio = NULL;

            $query = "SELECT *, aes_decrypt(password, :encryptpass) as password FROM " . $this->tableName . " WHERE (email = :email)";

            $parameters["email"] = $email;
            $parameters["encryptpass"] = ENCRYPTPASS;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $duenio = $this->ArrayToDuenio($row);
                }

                return $duenio;
            } else {

                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetDuenioById($idDuenio)
    {
        try {
            $duenio = NULL;

            $query = "SELECT * FROM " . $this->tableName . " WHERE (idDuenio = :idDuenio)";

            $parameters["idDuenio"] = $idDuenio;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $row["password"] = null;
                    $duenio = $this->ArrayToDuenio($row);
                }

                return $duenio;
            } else {

                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    //----------------------------------------------------------------------------------------------------------------


    //----Array-Object------------------------------------------------------------------------------------------------
    private function DuenioToArray($duenio)
    {
        $array["nombre"] = $duenio->getNombre();
        $array["apellido"] = $duenio->getApellido();
        $array["telefono"] = $duenio->getTelefono();
        $array["email"] = $duenio->getEmail();
        $array["password"] = $duenio->getPassword();
        $array["tipo"] = $duenio->getTipo();
        $array["rutaFoto"] = $duenio->getRutaFoto();
        $array["alta"] = $duenio->getAlta();

        return $array;
    }

    private function ArrayToDuenio($array)
    {
        $duenio = new Duenio(NULL, NULL, NULL, NULL, NULL);

        $duenio->setId($array["idDuenio"]);
        $duenio->setNombre($array["nombre"]);
        $duenio->setApellido($array["apellido"]);
        $duenio->setTelefono($array["telefono"]);
        $duenio->setEmail($array["email"]);
        $duenio->setPassword($array["password"]);
        $duenio->setTipo($array["tipo"]);
        $duenio->setRutaFoto($array["rutaFoto"]);
        $duenio->setAlta($array["alta"]);

        return $duenio;
    }
    //----------------------------------------------------------------------------------------------------------------
}
