<?php
include("header.php");
include("navBar.php");
?>

<div class="container list-mascotas">
    <h2 id="mis-mascotas">Mis Mascotas</h2>
    <a href="<?php echo FRONT_ROOT . "Duenio/ShowAddMascotaView" ?>"><button class="btn btn-primary btn-mascota">Añadir Mascota</button></a><br>
    <div class="row row-cols-3">
    <?php foreach ($mascotasList as $mascota) { ?>
        <div class="card p-3">
            <img class="img-mascota" src="<?php echo IMG_PATH . $mascota->getRutaFoto() ?>" alt="<?php echo $mascota->getNombre() ?>">
            <p class="card-text">Nombre: <b><?php echo $mascota->getNombre() ?></b></p>
            <p class="card-text">Raza: <b><?php echo $mascota->getRaza() ?></b></p>
            <p class="card-text">Tamaño: <b><?php echo $mascota->getTamanio() ?></b></p>
            <p class="card-text">Observaciones: <b><?php echo $mascota->getObservaciones() ?></b></p>
        </div>
    <?php } ?>
    </div>
</div>

<?php
include("footer.php");
?>