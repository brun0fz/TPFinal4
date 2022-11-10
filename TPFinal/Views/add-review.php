<?php

use Models\EstadoReserva;

include("header.php");
include("nav-bar.php");
?>
<div class="container">
    <div class="list-reservas">
        <h2 id="list-title">Calificar Reserva</h2><br>
        <div class="card mb-3 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4 card-img-reserva position-relative">
                    <img src="<?php echo IMG_PATH . $mascota->getRutaFoto() ?>" class="rounded-start img-reserva img-unselect position-absolute top-50 start-50 translate-middle">
                </div>
                <div class="col-md-8 p-1 position-relative">
                    <div class="card-body">
                        <h3 class="card-title"><b><?php echo "Reserva para " . $mascota->getNombre(); ?></b><span class="<?php echo ($reserva->getEstado() == EstadoReserva::EN_CURSO->value) ? "text-primary" : "" ?>"> (<?php echo $reserva->getEstado(); ?>)</span></h3>
                        <h5><small class="card-text">desde el <b><?php echo $reserva->getFechaInicio() ?></b> hasta el <b><?php echo $reserva->getFechaFin(); ?></b></small></h5>
                        <hr class="my-3" />
                        <?php if ($_SESSION["loggedUser"]->getTipo() == 1) { ?>
                            <p class="card-text">Guardian: <b><?php echo $guardian->getNombre() . " " . $guardian->getApellido(); ?></b></p>
                            <p class="card-text">Direcci&oacute;n: <b><?php echo $guardian->getCalle() . " " . $guardian->getNumero() . " " . $guardian->getPiso() . " " . $guardian->getDepartamento() ?></b></p>
                        <?php } else { ?>
                            <p class="card-text">Due&ntilde;o: <b><?php echo $duenio->getNombre() . " " . $duenio->getApellido(); ?></b></p>
                            <p class="card-text"><span>Animal: <b><?php echo $mascota->getAnimal() ?></b></span><span class="ms-3">Raza: <b><?php echo $mascota->getRaza() ?></b></span></p>
                        <?php } ?>
                        <p class="card-text">Precio Total: <b><?php echo "$" . $reserva->getPrecioTotal(); ?></b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <form action="<?php echo FRONT_ROOT ?>Reserva/AddReview" method="Post">
        <div class="row mx-1">
                <div class="col-md-8 py-1">
                    <div class="form-floating">
                        <textarea class="form-control" name="comentario" placeholder="Comentario" id="floatingTextarea" style="height: 120px"></textarea>
                        <label for="floatingTextarea">Comentario</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12 py-1">
                        <div class="form-floating">
                            <input type="number" name="puntaje" class="form-control" id="floatingInput" min=0 max=5 placeholder="Puntaje" required>
                            <label for="floatingInput">Puntaje</label>
                        </div>
                    </div>
                    <div class="col-md-12 py-1">
                        <input type="hidden" name="idReserva" value="<?php echo $reserva->getIdReserva() ?>">
                        <input class="btn btn-lg btn-primary w-100" type="submit" value="Calificar">
                    </div>
                </div>
        </div>
    </form>

</div>



<?php
include("footer.php");
?>