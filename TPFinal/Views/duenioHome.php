<?php
include('header.php');
include('navBar.php');

?>

<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Bienvenido/a <?php echo $_SESSION["loggedUser"]->getNombre() ?> :)</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#collection"></use>
                </svg>
            </div>
            <h3 class="fs-2">Reservas</h3>
            <p>Mira el listado de tus reservas confirmadas o en curso, visualiza el detalle de una reserva. </p>
            <a href="<?php echo FRONT_ROOT . "Duenio/ShowDuenioHome" ?>">Ver reservas (Coming soon...)</a><br>
        </div>
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#people-circle"></use>
                </svg>
            </div>
            <h3 class="fs-2">Guardianes</h3>
            <p>Visualiza el listado de guardianes, filtralos por ubicacion, reputacion y disponibilidad, busca un guardian para realizar una reserva.</p>
            <a href="<?php echo FRONT_ROOT . "Duenio/ShowListaGuardianesView" ?>">Ver listado de Guardianes</a>
        </div>
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#toggles2"></use>
                </svg>
            </div>
            <h3 class="fs-2">Mascotas</h3>
            <p>Ve tu listado de mascotas, añade nuevas mascotas, visualiza sus perfiles y modificalos.</p>
            <a href="<?php echo FRONT_ROOT . "Duenio/ShowMascotaView" ?>">Mis Mascotas</a>
        </div>
    </div>
    <img class="background-img" src="<?php echo IMG_PATH . "background.png" ?>" alt="">
</div>

<?php
include('footer.php');
?>