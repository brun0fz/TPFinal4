<?php

use DAO\DuenioDAO;
use DAO\GuardianDAO;
use DAO\MascotaDAO;
use DAO\ReservaDAO;
use Models\Reserva;
use Models\Guardian;
use Models\Mascota;
use Models\EstadoReserva;

include("header.php");
include("navBar.php");
?>

<div class="container">
    <div class="list-reservas position-relative">
        <h2 id="list-title">Mis Reservas</h2><br>

        <?php if ($alert != "") { ?>
            <div class="alert alert-success" role="alert" style="width: fit-content">
                <?php echo $alert ?>
            </div>
        <?php } ?>

        <?php if (empty($listaReservas)) { ?>
            <div class="alert alert-primary" role="alert" style="width: fit-content">
                <?php echo "Todavia no tiene reservas." ?>
            </div>
        <?php } ?>

        <?php if ($_SESSION["loggedUser"]->getTipo() == 1) { ?>
        <a href="<?php echo FRONT_ROOT . "Duenio/ShowFiltrarGuardianesView" ?>"><button class="btn btn-primary position-absolute top-0 end-0 mt-3">Nueva Reserva</button></a><br>
        <?php } ?>

        <?php foreach ($listaReservas as $reserva) {
            $guardianDAO = new GuardianDAO();
            $duenioDAO = new DuenioDAO();
            $mascotaDAO = new MascotaDAO();
            $reservaDAO = new ReservaDAO();

            $guardian = $guardianDAO->BuscarId($reserva->getFkIdGuardian());
            $duenio = $duenioDAO->BuscarId($reserva->getFkIdDuenio());
            $mascota = $mascotaDAO->GetMascotaById($reserva->getFkIdMascota());
            $review = $reservaDAO->GetReviewByIdReserva($reserva->getIdReserva());
        ?>

            <div class="card mb-3 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-4 card-img-reserva position-relative">
                        <img src="<?php echo IMG_PATH . $mascota->getRutaFoto() ?>" class="rounded-start img-reserva img-unselect position-absolute top-50 start-50 translate-middle">
                    </div>
                    <div class="col-md-8 p-1 position-relative">
                        <div class="card-body">
                            <h3 class="card-title"><b><?php echo "Reserva para " . $mascota->getNombre(); ?></b><span class="<?php echo ($reserva->getEstado() == "En curso") ? "text-primary" : "" ?>"> (<?php echo $reserva->getEstado(); ?>)</span></h3>
                            <h5><small class="card-text">desde el <b><?php echo $reserva->getFechaInicio() ?></b> hasta el <b><?php echo $reserva->getFechaFin(); ?></b></small></h5>
                            <hr class="my-3" />
                            <?php if ($_SESSION["loggedUser"]->getTipo() == 1) { ?>
                                <p class="card-text">Guardian: <b><?php echo $guardian->getNombre() . " " . $guardian->getApellido(); ?></b></p>
                                <p class="card-text">Dirección: <b><?php echo $guardian->getCalle() . " " . $guardian->getNumero() . " " . $guardian->getPiso() . " " . $guardian->getDepartamento() ?></b></p>
                            <?php } else { ?>
                                <p class="card-text">Dueño: <b><?php echo $duenio->getNombre() . " " . $duenio->getApellido(); ?></b></p>
                                <p class="card-text"><span>Animal: <b><?php echo $mascota->getAnimal() ?></b></span><span class="ms-3">Raza: <b><?php echo $mascota->getRaza() ?></b></span></p>
                            <?php } ?>
                            <p class="card-text">Precio Total: <b>$<?php echo $reserva->getPrecioTotal(); ?></b></p>
                            <?php if ($review) { ?>
                                <p class="card-text">Comentario: <b><?php echo $review->getComentario(); ?></b></p>
                                <p class="card-text">Puntaje: <b><?php echo $review->getPuntaje() . "/5"; ?></b></p>
                            <?php } ?>
                            <div class="text-end">
                                <?php if ($_SESSION["loggedUser"]->getTipo() == 2 && $reserva->getEstado() == "Solicitada") { ?>
                                    <form action="<?php echo FRONT_ROOT ?>Reserva/confirmarReserva" method="Post">
                                        <input type="hidden" name="idReserva" value="<?php echo $reserva->getIdReserva(); ?>">
                                        <button type="submit" class="btn btn-lg btn-outline-success rounded-pill position-absolute bottom-0 m-2 btn-confirmar">Confirmar</button>
                                    </form>
                                <?php } ?>
                                <?php if (($_SESSION["loggedUser"]->getTipo() == 1 && ($reserva->getEstado() == "Solicitada" || $reserva->getEstado() == "En espera de pago" || $reserva->getEstado() == "Confirmada")) || ($_SESSION["loggedUser"]->getTipo() == 2 && $reserva->getEstado() == "Solicitada")) { ?>
                                    <form action="<?php echo FRONT_ROOT ?>Reserva/cambiarEstado" method="Post">
                                        <input type="hidden" name="idReserva" value="<?php echo $reserva->getIdReserva(); ?>">
                                        <input type="hidden" name="estado" value="<?php echo "Cancelada" ?>">
                                        <button type="submit" class="btn btn-lg btn-outline-danger rounded-pill position-absolute bottom-0 end-0 m-2">Cancelar</button>
                                    </form>
                                <?php } ?>
                                <?php if ($_SESSION["loggedUser"]->getTipo() == 1 && ($reserva->getEstado() == "En espera de pago")) { ?>
                                    <form action="<?php echo FRONT_ROOT ?>Reserva/ShowCuponView" method="Post">
                                        <input type="hidden" name="idReserva" value="<?php echo $reserva->getIdReserva(); ?>">
                                        <button type="submit" class="btn btn-lg btn-outline-success rounded-pill position-absolute bottom-0 m-2 btn-confirmar">Pagar</button>
                                    </form>
                                <?php } ?>
                                <?php if ($_SESSION["loggedUser"]->getTipo() == 1 && !$review && ($reserva->getEstado() == "Finalizada")) { ?>
                                    <form action="<?php echo FRONT_ROOT ?>Reserva/ShowReviewView" method="Post">
                                        <input type="hidden" name="idReserva" value="<?php echo $reserva->getIdReserva(); ?>">
                                        <button type="submit" class="btn btn-lg btn-outline-primary rounded-pill position-absolute bottom-0 end-0 m-2">Calificar</button>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>
 
<?php
include("footer.php");
?>