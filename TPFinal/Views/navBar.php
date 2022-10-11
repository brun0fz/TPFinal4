
<nav class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="<?php echo FRONT_ROOT . "Duenio/ShowDuenioHome"; ?>" class="nav-link px-2 link-secondary">Home</a>
                </li>
                <?php if ($_SESSION["loggedUser"]->getTipo() == 1) { ?>
                    <li><a href="<?php echo FRONT_ROOT . "Duenio/ShowListaGuardianesView"; ?>" class="nav-link px-2 link-dark">Guardianes</a></li>
                    <li><a href="<?php echo FRONT_ROOT . "Duenio/ShowMascotaView"; ?>" class="nav-link px-2 link-dark">Mascotas</a></li>
                <?php } else { ?>
                    <li><a href="<?php echo FRONT_ROOT . "Guardian/ShowDisponibilidadView"; ?>" class="nav-link px-2 link-dark">Disponibilidad</a></li>
                <?php } ?>
            </ul>

            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <!--Insertar IMG de usuario aca abajo-->
                    <img src="<?php echo IMG_PATH . "undefinedProfile.png" ?>" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small">
                    <?php if ($_SESSION["loggedUser"]->getTipo() == 1) { ?>
                            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT . "Controller/Method"; //arreglar ?>">Perfil</a></li>
                    <?php } else { ?>
                            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT . "Controller/Method"; //arreglar ?>">Perfil</a></li>
                    <?php } ?>
                    <li><hr class="dropdown-divider"></li>

                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT . "Home/Logout"; ?>">Cerrar Sesion</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>