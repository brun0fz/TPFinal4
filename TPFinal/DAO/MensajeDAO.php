<?php

namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use Models\Mensaje;

class MensajeDAO implements IMensajeDAO
{
    private $connection;
    private $tableName = "Mensajes";


    public function Add(Mensaje $mensaje)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (idEmisor, idReceptor, mensaje, fecha) VALUES (:idEmisor, :idReceptor, :mensaje, :fecha);";

            $parameters["idEmisor"] = $mensaje->getIdEmisor();
            $parameters["idReceptor"] = $mensaje->getIdReceptor();
            $parameters["mensaje"] = $mensaje->getMensaje();
            $parameters["fecha"] = $mensaje->getFecha();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {

            $mensajeList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $mensaje = new Mensaje;

                $mensaje->setIdMensaje($row["idMensaje"]);
                $mensaje->setIdEmisor($row["idEmisor"]);
                $mensaje->setIdReceptor($row["idReceptor"]);
                $mensaje->setMensaje($row["mensaje"]);
                $mensaje->setFecha($row["fecha"]);

                array_push($mensajeList, $mensaje);
            }

            return $mensajeList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
