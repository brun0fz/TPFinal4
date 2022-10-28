<?php

namespace Models;

enum EstadoReserva: string
{
    case SOLICITADA = "Solicitada";
    case CONFIRMADA = "Confirmada";
    case ACEPTADA = "Aceptada";
    case CANCELADA = "Cancelada";
    case EN_CURSO = "En curso";
    case COMPLETADA = "Completada";
}
