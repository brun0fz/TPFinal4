<?php
    namespace DAO;

use Models\Mensaje;

    interface IMensajeDAO
    {
        function Add(Mensaje $mensaje);
        function GetAll();
  
    }
