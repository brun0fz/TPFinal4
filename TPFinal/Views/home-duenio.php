<?php
include('header.php');
include('nav-bar.php');

?>

<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Bienvenido/a <?php echo $_SESSION["loggedUser"]->getNombre() ?> :)</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 p-2">
                <img class="img-unselect" src="<?php echo IMG_PATH . "reservasIcon.png" ?>" alt="" width="40" height="40">
            </div>
            <h3 class="fs-2">Reservas</h3>
            <p>Mira el listado de tus reservas solicitadas, confirmadas, en curso o ya finalizadas. Visualiza el detalle de una reserva. </p>
            <a href="<?php echo FRONT_ROOT . "Reserva/ShowListReservasView" ?>">Ver reservas</a><br>
        </div>
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 p-2">
                <img class="img-unselect" src="<?php echo IMG_PATH . "guardianesIcon.png" ?>" alt="" width="40" height="40">
            </div>
            <h3 class="fs-2">Guardianes</h3>
            <p>Selecciona tu mascota y fechas de estad&iacute;a y visualiza el listado de guardianes disponibles para ella.</p>
            <a href="<?php echo FRONT_ROOT . "Duenio/ShowFiltrarGuardianesView" ?>">Buscar Guardianes</a>
        </div>
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 p-2">
                <img class="img-unselect" src="<?php echo IMG_PATH . "mascotasIcon.png" ?>" alt="" width="40" height="40">
            </div>
            <h3 class="fs-2">Mascotas</h3>
            <p>Ve tu listado de mascotas, a&ntilde;ade nuevas mascotas, visualiza sus perfiles y modificalos.</p>
            <a href="<?php echo FRONT_ROOT . "Mascota/ShowMascotaView" ?>">Mis Mascotas</a>
        </div>
    </div>
    <?php if ($flag) { ?>
        <div class="alert alert-danger" style="width: fit-content;">
            <span class="mx-4"><b>(!)</b> Usted tiene <?php echo $cont ?> reserva(s) pendiente de pago.</span>
        </div>
    <?php } ?>
    <img class="img-unselect background-img" src="<?php echo IMG_PATH . "background.png" ?>" alt="">
</div>

<?php
include('footer.php');
?>