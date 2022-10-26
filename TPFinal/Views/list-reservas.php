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
                            <h3 class="card-title"><b><?php echo "Reserva para" . $mascota->getNombre(); ?></b></h3>
                            <p class="card-text">Entrada: <b><?php echo $reserva->getFechaInicio() . " Salida: " . $reserva->getFechaFin(); ?></b></p>
                            <p class="card-text">Guardian: <b><?php echo $guardian->getNombre() . " " . $guardian->getApellido(); ?></b></p>
                            <?php
                            $n = 0;
                            for ($i = 1; $i <= (int)$guardian->getReputacion(); $i++) {
                            ?><img src="<?php echo IMG_PATH . "pawFull.png"; ?>" class="p-1" width="30" height="30" alt=""><?php
                                                                                                                                $n = $i;
                                                                                                                            }
                                                                                                                            if (($guardian->getReputacion() - (int)$guardian->getReputacion()) >= 0.5) {
                                                                                                                                ?><img src="<?php echo IMG_PATH . "pawHalf.png"; ?>" class="p-1" width="30" height="30" alt=""><?php
                                                                                                                                                                                                                                $n++;
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            if ($i <= 5) {
                                                                                                                                                                                                                                for ($i = $n + 1; $i <= 5; $i++) {
                                                                                                                                                                                                                                ?><img src="<?php echo IMG_PATH . "pawEmpty.png"; ?>" class="p-1" width="30" height="30" alt=""><?php
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                ?>
                            <br><br>
                            <p class="card-text">Dirección: <b><?php echo $guardian->getCalle() . " " . $guardian->getNumero() . " " . $guardian->getPiso() . " " . $guardian->getDepartamento() ?></b></p>
                            <p class="card-text">Precio Total: <b><?php echo "$" . $reserva->getPrecioTotal(); ?></b></p>
                            <p class="card-text">Estado: <b><?php echo $reserva->getEstado(); ?></b></p>
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