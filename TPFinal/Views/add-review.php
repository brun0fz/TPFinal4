<?php
include("header.php");
include("navBar.php");
?>
<div class="container">
    <div class="list-reservas">
        <h2 id="list-title">Calificar Reserva</h2><br>
        <div class="card mb-3 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4 card-img-reserva">
                    <img src="<?php echo IMG_PATH . $mascota->getRutaFoto() ?>" class="img-fluid rounded-start img-reserva img-unselect">
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
                        <p class="card-text">Precio Total: <b><?php echo "$" . $reserva->getPrecioTotal(); ?></b></p>
                    </div>
                </div>
            </div>
        </div>
        <form action="<?php echo FRONT_ROOT ?>Reserva/AddReview" method="Post">
            <div class="form-floating">
                <input type="text" name="comentario" class="form-control" id="floatingInput" placeholder="Comentario">
                <label for="floatingInput">Comentario</label>
            </div>
            <br>
            <div class="form-floating">
                <input type="number" name="puntaje" class="form-control" id="floatingInput" min=0 max=5 placeholder="Puntaje" required>
                <label for="floatingInput">Puntaje</label>
            </div>
            <br>
            <input type="hidden" name="idReserva" value="<?php echo $reserva->getIdReserva() ?>">
            <input class="btn btn-lg btn-primary" type="submit" value="Calificar">
        </form>
    </div>
</div>



<?php
include("footer.php");
?>