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

            $query = "UPDATE Guardianes SET fk_idTamanioMascota = LAST_INSERT_ID() WHERE email = :email";

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

            $query = "SELECT * FROM " . $this->tableName . " INNER JOIN Direcciones ON Guardianes.fk_idDireccion = Direcciones.idDireccion INNER JOIN TamaniosMascota ON Guardianes.fk_idTamanioMascota = TamaniosMascota.idTamanioMascota INNER JOIN Disponibilidades ON Guardianes.fk_idDisponibilidad = Disponibilidades.idDisponibilidad;";

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

                $TamanioMascota = array();

                $TamanioMascota[] = $row["pequenia"] ? "Pequeño" : null;
                $TamanioMascota[] = $row["mediana"] ? "Mediano" : null;
                $TamanioMascota[] = $row["grande"] ? "Grande" : null;

                $guardian->setTamanioMascotaCuidar($TamanioMascota);


                $disponibilidad = array();

                $disponibilidad[] = $row["lunes"] ? "Lunes" : null;
                $disponibilidad[] = $row["martes"] ? "Martes" : null;
                $disponibilidad[] = $row["miercoles"] ? "Miercoles" : null;
                $disponibilidad[] = $row["jueves"] ? "Jueves" : null;
                $disponibilidad[] = $row["viernes"] ? "Viernes" : null;
                $disponibilidad[] = $row["sabado"] ? "Sabado" : null;
                $disponibilidad[] = $row["domingo"] ? "Domingo" : null;


                $guardian->setDisponibilidad($disponibilidad);

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

            $query = "SELECT * FROM " . $this->tableName . " INNER JOIN Direcciones ON Guardianes.fk_idDireccion = Direcciones.idDireccion INNER JOIN TamaniosMascota ON Guardianes.fk_idTamanioMascota = TamaniosMascota.idTamanioMascota INNER JOIN Disponibilidades ON Guardianes.fk_idDisponibilidad = Disponibilidades.idDisponibilidad WHERE (email = :email);";

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

                    $TamanioMascota = array();

                    $TamanioMascota[] = $row["pequenia"] ? "Pequeño" : null;
                    $TamanioMascota[] = $row["mediana"] ? "Mediano" : null;
                    $TamanioMascota[] = $row["grande"] ? "Grande" : null;

                    $guardian->setTamanioMascotaCuidar($TamanioMascota);

                    $disponibilidad = array();

                    $disponibilidad[] = $row["lunes"] ? "Lunes" : null;
                    $disponibilidad[] = $row["martes"] ? "Martes" : null;
                    $disponibilidad[] = $row["miercoles"] ? "Miercoles" : null;
                    $disponibilidad[] = $row["jueves"] ? "Jueves" : null;
                    $disponibilidad[] = $row["viernes"] ? "Viernes" : null;
                    $disponibilidad[] = $row["sabado"] ? "Sabado" : null;
                    $disponibilidad[] = $row["domingo"] ? "Domingo" : null;


                    $guardian->setDisponibilidad($disponibilidad);


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

            $query = "SELECT * FROM " . $this->tableName . " INNER JOIN Direcciones ON Guardianes.fk_idDireccion = Direcciones.idDireccion INNER JOIN TamaniosMascota ON Guardianes.fk_idTamanioMascota = TamaniosMascota.idTamanioMascota INNER JOIN Disponibilidades ON Guardianes.fk_idDisponibilidad = Disponibilidades.idDisponibilidad WHERE (idGuardian = :idGuardian)";

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

                    $TamanioMascota = array();

                    $TamanioMascota[] = $row["pequenia"] ? "Pequeño" : null;
                    $TamanioMascota[] = $row["mediana"] ? "Mediano" : null;
                    $TamanioMascota[] = $row["grande"] ? "Grande" : null;

                    $guardian->setTamanioMascotaCuidar($TamanioMascota);

                    $disponibilidad = array();

                    $disponibilidad[] = $row["lunes"] ? "Lunes" : null;
                    $disponibilidad[] = $row["martes"] ? "Martes" : null;
                    $disponibilidad[] = $row["miercoles"] ? "Miercoles" : null;
                    $disponibilidad[] = $row["jueves"] ? "Jueves" : null;
                    $disponibilidad[] = $row["viernes"] ? "Viernes" : null;
                    $disponibilidad[] = $row["sabado"] ? "Sabado" : null;
                    $disponibilidad[] = $row["domingo"] ? "Domingo" : null;

                    $guardian->setDisponibilidad($disponibilidad);

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

    public function UpdateDisponibilidad($idGuardian, $disponibilidad)
    {
        try {
            $query = "UPDATE Disponibilidades INNER JOIN Guardianes ON Disponibilidades.idDisponibilidad = Guardianes.fk_idDisponibilidad SET lunes = :lunes, martes = :martes, miercoles = :miercoles, jueves = :jueves, viernes = :viernes, sabado = :sabado, domingo = :domingo WHERE idGuardian = :idGuardian;";

            $parameters["lunes"] = in_array("Lunes", $disponibilidad) ? 1 : 0;
            $parameters["martes"] = in_array("Martes", $disponibilidad) ? 1 : 0;
            $parameters["miercoles"] = in_array("Miercoles", $disponibilidad) ? 1 : 0;
            $parameters["jueves"] = in_array("Jueves", $disponibilidad) ? 1 : 0;
            $parameters["viernes"] = in_array("Viernes", $disponibilidad) ? 1 : 0;
            $parameters["sabado"] = in_array("Sabado", $disponibilidad) ? 1 : 0;
            $parameters["domingo"] = in_array("Domingo", $disponibilidad) ? 1 : 0;

            $parameters["idGuardian"] = $idGuardian;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function UpdateTamanios($idGuardian, $tamanios)
    {
        try {
            $query = "UPDATE TamaniosMascota INNER JOIN Guardianes ON TamaniosMascota.idTamanioMascota = Guardianes.fk_idTamanioMascota SET pequenia = :pequenia, mediana = :mediana, grande = :grande WHERE idGuardian = :idGuardian;";

            $parameters["pequenia"] = in_array("Pequeño", $tamanios) ? 1 : 0;
            $parameters["mediana"] = in_array("Mediano", $tamanios) ? 1 : 0;
            $parameters["grande"] = in_array("Grande", $tamanios) ? 1 : 0;

            $parameters["idGuardian"] = $idGuardian;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function UpdatePrecio($idGuardian, $precioXDia)
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
}
