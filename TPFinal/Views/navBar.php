
<nav class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="<?php echo FRONT_ROOT . "Duenio/ShowDuenioHome"; ?>" class="nav-link px-2 link-secondary"><img src=<?php echo IMG_PATH . "logo2.png" ?> width="36" height="36"></a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="<?php echo FRONT_ROOT . "Home/Index"; ?>" class="nav-link px-2 link-secondary">Home</a></li>
                <li><a href="<?php echo FRONT_ROOT . "Reserva/ShowListReservasView"; ?>" class="nav-link px-2 link-dark">Reservas</a></li>
                <?php if ($_SESSION["loggedUser"]->getTipo() == 1) { ?>
                    <li><a href="<?php echo FRONT_ROOT . "Duenio/ShowSelectFechasReserva"; ?>" class="nav-link px-2 link-dark">Guardianes</a></li>
                    <li><a href="<?php echo FRONT_ROOT . "Mascota/ShowMascotaView"; ?>" class="nav-link px-2 link-dark">Mascotas</a></li>
                <?php } else { ?>
                    <li><a href="<?php echo FRONT_ROOT . "Guardian/ShowConfiguracionView"; ?>" class="nav-link px-2 link-dark">Configuración</a></li>
                <?php } ?>
            </ul>

            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <img src="<?php echo IMG_PATH . $_SESSION["loggedUser"]->getRutaFoto() ?>" alt="profilePic" width="36" height="36" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small">
                    <?php if ($_SESSION["loggedUser"]->getTipo() == 1) { ?>
                            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT . "Duenio/ShowDuenioHome"; //arreglar ?>">Perfil</a></li>
                    <?php } else { ?>
                            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT . "Guardian/ShowGuardianHome"; //arreglar ?>">Perfil</a></li>
                    <?php } ?>
                    <li><hr class="dropdown-divider"></li>

                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT . "Home/Logout"; ?>">Cerrar Sesion</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav> 