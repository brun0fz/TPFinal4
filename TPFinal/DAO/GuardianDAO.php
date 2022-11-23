<?php

namespace DAO;

use \Exception as Exception;
use DAO\IGuardianDAO as IGuardianDAO;
use Models\Guardian as Guardian;
use DAO\Connection as Connection;
use Models\EstadoReserva;

class GuardianDAO implements IGuardianDAO
{
    private $connection;
    private $tableName = "Guardianes";


    //----Adds--------------------------------------------------------------------------------------------------------
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

            $query = "INSERT INTO " . $this->tableName . " (nombre, apellido, telefono, email, password, tipo, rutaFoto, alta, fk_idDireccion) VALUES (:nombre, :apellido, :telefono, :email, aes_encrypt(:password, :encryptpass), :tipo, :rutaFoto, :alta, LAST_INSERT_ID());";

            $parameters["encryptpass"] = ENCRYPTPASS;
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
    //----------------------------------------------------------------------------------------------------------------


    //----Gets--------------------------------------------------------------------------------------------------------
    public function GetAll()
    {
        try {
            $guardianesList = array();

            $query = "SELECT * FROM " . $this->tableName . " INNER JOIN Direcciones ON Guardianes.fk_idDireccion = Direcciones.idDireccion INNER JOIN TamaniosMascota ON Guardianes.fk_idTamanioMascota = TamaniosMascota.idTamanioMascota INNER JOIN Disponibilidades ON Guardianes.fk_idDisponibilidad = Disponibilidades.idDisponibilidad;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $row["password"] = null;
                $guardian = $this->ArrayToGuardian($row);

                array_push($guardianesList, $guardian);
            }

            return $guardianesList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetGuardianByEmail($email)
    {
        try {
            $guardian = null;

            $query = "SELECT *, aes_decrypt(password, :encryptpass) as password FROM " . $this->tableName . " INNER JOIN Direcciones ON Guardianes.fk_idDireccion = Direcciones.idDireccion INNER JOIN TamaniosMascota ON Guardianes.fk_idTamanioMascota = TamaniosMascota.idTamanioMascota INNER JOIN Disponibilidades ON Guardianes.fk_idDisponibilidad = Disponibilidades.idDisponibilidad WHERE (email = :email);";

            $parameters["email"] = $email;
            $parameters["encryptpass"] = ENCRYPTPASS;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $guardian = $this->ArrayToGuardian($row);
                }

                return $guardian;
            } else {

                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetGuardianById($idGuardian)
    {
        try {
            $guardian = null;

            $query = "SELECT * FROM " . $this->tableName . " INNER JOIN Direcciones ON Guardianes.fk_idDireccion = Direcciones.idDireccion INNER JOIN TamaniosMascota ON Guardianes.fk_idTamanioMascota = TamaniosMascota.idTamanioMascota INNER JOIN Disponibilidades ON Guardianes.fk_idDisponibilidad = Disponibilidades.idDisponibilidad WHERE (idGuardian = :idGuardian)";

            $parameters["idGuardian"] = $idGuardian;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            if (isset($resultSet)) {

                foreach ($resultSet as $row) {

                    $row["password"] = null;
                    $guardian = $this->ArrayToGuardian($row);
                }

                return $guardian;
            } else {

                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    //----------------------------------------------------------------------------------------------------------------


    //----Updates-----------------------------------------------------------------------------------------------------
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

    public function UpdateReputacion($idReserva)
    {
        try {

            $cant = 0;
            $suma = 0;

            $reservaDAO = new ReservaDAO();

            $reserva = $reservaDAO->GetReservaById($idReserva);

            $listaReservas = $reservaDAO->GetListaReservasByGuardian($reserva->getFkIdGuardian());

            foreach ($listaReservas as $reserva) {

                if ($reserva->getEstado() == EstadoReserva::FINALIZADA->value) {
                    $review = $reservaDAO->GetReviewByIdReserva($reserva->getIdReserva());

                    if ($review) {
                        $suma += $review->getPuntaje();
                        $cant++;
                    }
                }
            }

            if ($cant != 0) {
                $reputacion = ($suma / $cant);
            }

            $query = "UPDATE " . $this->tableName . " SET reputacion = :reputacion WHERE idGuardian = :idGuardian;";

            $parameters["reputacion"] = $reputacion;
            $parameters["idGuardian"] = $reserva->getFkIdGuardian();


            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    //----------------------------------------------------------------------------------------------------------------


    //----Array-Object------------------------------------------------------------------------------------------------
    private function ArrayToGuardian($array)
    {
        $guardian = new Guardian(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

        $guardian->setId($array["idGuardian"]);
        $guardian->setNombre($array["nombre"]);
        $guardian->setApellido($array["apellido"]);
        $guardian->setTelefono($array["telefono"]);
        $guardian->setEmail($array["email"]);
        $guardian->setPassword($array["password"]); //only login
        $guardian->setAlta($array["alta"]);
        $guardian->setTipo($array["tipo"]);
        $guardian->setRutaFoto($array["rutaFoto"]);
        $guardian->setPrecioXDia($array["precioXDia"]);
        $guardian->setReputacion($array["reputacion"]);

        $guardian->setCalle($array["calle"]);
        $guardian->setNumero($array["numero"]);
        $guardian->setPiso($array["piso"]);
        $guardian->setDepartamento($array["departamento"]);
        $guardian->setCodigoPostal($array["codigoPostal"]);

        $TamanioMascota = array();

        if ($array["pequenia"]) $TamanioMascota[] = "Pequeño";
        if ($array["mediana"]) $TamanioMascota[] = "Mediano";
        if ($array["grande"]) $TamanioMascota[] = "Grande";

        $guardian->setTamanioMascotaCuidar($TamanioMascota);

        $disponibilidad = array();

        if ($array["lunes"]) $disponibilidad[] = "Lunes";
        if ($array["martes"]) $disponibilidad[] = "Martes";
        if ($array["miercoles"]) $disponibilidad[] = "Miercoles";
        if ($array["jueves"]) $disponibilidad[] = "Jueves";
        if ($array["viernes"]) $disponibilidad[] = "Viernes";
        if ($array["sabado"]) $disponibilidad[] = "Sabado";
        if ($array["domingo"]) $disponibilidad[] = "Domingo";

        $guardian->setDisponibilidad($disponibilidad);

        return $guardian;
    }
    //----------------------------------------------------------------------------------------------------------------
}
