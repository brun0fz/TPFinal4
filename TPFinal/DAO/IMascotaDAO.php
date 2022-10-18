<?php
    namespace DAO;

    use DAO\Connection as Connection;
    use Models\Mascota;

    interface IMascotaDAO
    {
        function Add(Mascota $mascota);
        function GetAll();
    }
?>