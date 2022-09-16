<?php namespace clases;

enum EstadoReserva : string{
    case PENDIENTE = "Pendiente";
    case CONFIRMADA = "Confirmada";
    case RECHAZADA = "Rechazada";
    case EN_CURSO = "En curso";
    case COMPLETADA = "Completada";
}