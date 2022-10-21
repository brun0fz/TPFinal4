<?php namespace Models;

enum EstadoReserva : string{
    case SOLICITADA = "Solicitada";
    case CONFIRMADA = "Confirmada";
    case RECHAZADA = "Rechazada";
    case EN_CURSO = "En curso";
    case COMPLETADA = "Completada";
}