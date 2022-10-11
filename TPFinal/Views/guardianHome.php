<?php
include("header.php");
include("navBar.php");
?>

<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Bienvenido/a <?php echo $_SESSION["loggedUser"]->getNombre() ?> :)</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 p-2">
                <img src="<?php echo IMG_PATH . "reservasIcon.png" ?>" alt="" width="40" height="40">
            </div>
            <h3 class="fs-2">Reservas</h3>
            <p>Mira el listado de tus reservas confirmadas o en curso, visualiza el detalle de una reserva. </p>
            <a href="<?php echo FRONT_ROOT . "Guardian/ShowGuardianHome" ?>">Ver reservas (Coming soon...)</a><br>
        </div>
        <div class="feature col">
            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 p-2">
                <img src="<?php echo IMG_PATH . "disponibilidadIcon.png" ?>" alt="" width="40" height="40">
            </div>
            <h3 class="fs-2">Disponibilidad</h3>
            <p>Selecciona los dias en que estas disponible para cuidar una mascota.</p>
            <a href="<?php echo FRONT_ROOT . "Guardian/ShowDisponibilidadView" ?>">Indicar disponibilidad</a>
        </div>
    </div>
    <img class="background-img" src="<?php echo IMG_PATH . "background.png" ?>" alt="">
</div>

<?php
include("footer.php");
?>