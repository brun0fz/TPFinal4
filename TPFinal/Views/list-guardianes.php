<?php
include("header.php");
include("nav-bar.php");
?>

<div class="container">
    <div class="list-guardianes">
        <h2 id="list-title">Guardianes</h2><br>
        <?php foreach ($listaGuardianes as $guardian) {
            if ($guardian->getDisponibilidad() && $guardian->getPrecioXDia() != 0) { ?>
                <!--Solo muestra guardianes con Disponibilidad y PrecioxDia seteados-->
                <div class="card mb-3 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-4 card-img-guardian">
                            <img src="<?php echo IMG_PATH . $guardian->getRutaFoto() ?>" class="img-fluid rounded-start img-guardian img-unselect">
                        </div>
                        <div class="col-md-8 p-1">
                            <div class="card-body">
                                <h3 class="card-title"><b><?php echo $guardian->getNombre() . " " . $guardian->getApellido(); ?></b></h3>
                                <?php
                                $n = 0;
                                for ($i = 1; $i <= (int)$guardian->getReputacion(); $i++) {
                                ?><img src="<?php echo IMG_PATH . "pawFull.png"; ?>" class="img-unselect p-1" width="30" height="30" alt=""><?php
                                                                                                                                $n = $i;
                                                                                                                            }
                                                                                                                            if (($guardian->getReputacion() - (int)$guardian->getReputacion()) >= 0.5) {
                                                                                                                                ?><img src="<?php echo IMG_PATH . "pawHalf.png"; ?>" class="img-unselect p-1" width="30" height="30" alt=""><?php
                                                                                                                                                                                                                                $n++;
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            if ($i <= 5) {
                                                                                                                                                                                                                                for ($i = $n + 1; $i <= 5; $i++) {
                                                                                                                                                                                                                                ?><img src="<?php echo IMG_PATH . "pawEmpty.png"; ?>" class="img-unselect p-1" width="30" height="30" alt=""><?php
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                ?>
                                <br><br>
                                <p class="card-text">Precio por d&iacute;a: <b><?php echo "$" . $guardian->getPrecioXDia(); ?></b></p>
                                <p class="card-text">Direcci&oacute;n: <b><?php echo $guardian->getCalle() . " " . $guardian->getNumero() . " " . $guardian->getPiso() . " " . $guardian->getDepartamento() ?></b></p>
                                <p class="card-text">Disponibilidad: <b><?php if ($guardian->getDisponibilidad()) {
                                                                            echo implode(", ", $guardian->getDisponibilidad());
                                                                        } else {
                                                                            echo "Sin definir.";
                                                                        } ?></b></p>
                                <p class="card-text">Tama&ntilde;o de Mascota: <b><?php if ($guardian->getTamanioMascotaCuidar()) {
                                                                                        echo implode(", ", $guardian->getTamanioDescripcion());
                                                                                    } else {
                                                                                        echo "Sin definir.";
                                                                                    } ?></b></p>
                                <div class="text-end">
                                    <form action="<?php echo FRONT_ROOT ?>Reserva/ShowAddReservaView" method="Post">
                                        <input type="hidden" name="idGuardian" value="<?php echo $guardian->getId(); ?>">
                                        <input type="hidden" name="fechaInicio" value="<?php echo $fechaInicio; ?>">
                                        <input type="hidden" name="fechaFin" value="<?php echo $fechaFin; ?>">
                                        <input type="hidden" name="idMascota" value="<?php echo $idMascota; ?>">
                                        <button type="submit" class="btn btn-lg btn-outline-primary rounded-pill position-absolute bottom-0 end-0 m-3">Reservar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
</div>

<?php
include("footer.php");
?>