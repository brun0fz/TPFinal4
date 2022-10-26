<?php

use DAO\GuardianDAO;
use DAO\MascotaDAO;
use Models\Reserva;
use Models\Guardian;
use Models\Mascota;

include("header.php");
include("navBar.php");
?>

<div class="container">
    <div class="list-reservas">
        <h2 id="list-title">Reservas</h2><br>
        <?php foreach ($listaReservas as $reserva) { 
            $guardianDAO = new GuardianDAO();
            $mascotaDAO = new MascotaDAO();

            $guardian = $guardianDAO->BuscarId($reserva->getFkIdGuardian());
            $mascota = $mascotaDAO->GetMascotaById($reserva->getFkIdMascota());
            ?>

            <div class="card mb-3 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-4 card-img-guardian">
                        <img src="<?php echo IMG_PATH . $mascota->getRutaFoto() ?>" class="img-fluid rounded-start img-guardian">
                    </div>
                    <div class="col-md-8 p-1">
                        <div class="card-body">
                            <h3 class="card-title"><b><?php echo "Reserva para " . $mascota->getNombre(); ?></b> (<?php echo $reserva->getEstado(); ?>)</h3>
                            <p class="card-text">Entrada: <b><?php echo $reserva->getFechaInicio() ?></b> Salida: <b><?php echo $reserva->getFechaFin(); ?></b></p><br>
                            <p class="card-text">Guardian: <b><?php echo $guardian->getNombre() . " " . $guardian->getApellido(); ?></b></p>
                            <p class="card-text">Dirección: <b><?php echo $guardian->getCalle() . " " . $guardian->getNumero() . " " . $guardian->getPiso() . " " . $guardian->getDepartamento() ?></b></p>
                            <p class="card-text">Precio Total: <b><?php echo "$" . $reserva->getPrecioTotal(); ?></b></p>
                            <div class="text-end">
                                <form action="<?php echo FRONT_ROOT ?>Reserva/CancelReserva" method="Post">
                                    <input type="hidden" name="idReserva" value="<?php echo $reserva->getId(); ?>">
                                    <button type="submit" class="btn btn-lg btn-outline-primary position-absolute bottom-0 end-0 m-3">Cancelar</button>
                                </form>
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