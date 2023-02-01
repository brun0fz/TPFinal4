<?php

namespace DAO;

use \Exception as Exception;
use DAO\IChatDAO as IChatDAO;
use Models\Chat as Chat;
use DAO\Connection as Connection;

class chatDAO implements IChatDAO
{
    private $connection;
    private $tableName = "Chats";

    //----Adds--------------------------------------------------------------------------------------------------------
    public function Add(Chat $chat)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (idEmisor, idReceptor, mensaje) VALUES (:idEmisor, :idReceptor, :mensaje);";

            $parameters = $this->ChatToArray($chat);

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    //----------------------------------------------------------------------------------------------------------------

    //----Gets--------------------------------------------------------------------------------------------------------
    public function GetChatById($id1, $id2)
    {
        try {
            $chatList = array();

            $query = "SELECT * FROM " . $this->tableName . " WHERE (idEmisor = :id1 AND idReceptor = :id2) OR (idReceptor = :id1 AND idEmisor = :id2)";

            $parameters["id1"] = $id1;
            $parameters["id2"] = $id2;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {

                array_push($chatList, $this->ArrayToChat($row));
            }

            return $chatList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAllIds($idUsuario)
    {
        try {
            $idList = array();

            $query = "SELECT idEmisor, idReceptor FROM " . $this->tableName . " WHERE (idEmisor = :idUsuario) OR (idReceptor = :idUsuario) ORDER BY fecha desc";

            $parameters["idUsuario"] = $idUsuario;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {

                if ($row["idEmisor"] == $idUsuario) {
                    !in_array($row["idReceptor"], $idList) && array_push($idList, $row["idReceptor"]);
                } else {
                    !in_array($row["idEmisor"], $idList) && array_push($idList, $row["idEmisor"]);
                }
            }

            return $idList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    //----------------------------------------------------------------------------------------------------------------


    //----Array-Object------------------------------------------------------------------------------------------------
    private function ChatToArray(Chat $chat)
    {
        $array["idEmisor"] = $chat->getIdEmisor();
        $array["idReceptor"] = $chat->getIdReceptor();
        $array["mensaje"] = $chat->getMensaje();

        return $array;
    }

    private function ArrayToChat($array)
    {
        $chat = new Chat();

        $chat->setIdChat($array["idChat"]);
        $chat->setIdEmisor($array["idEmisor"]);
        $chat->setIdReceptor($array["idReceptor"]);
        $chat->setMensaje($array["mensaje"]);
        $chat->setFecha($array["fecha"]);

        return $chat;
    }
    //----------------------------------------------------------------------------------------------------------------
}
