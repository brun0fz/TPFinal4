<?php
use DAO\DuenioDAO;
use DAO\GuardianDAO;
use DAO\MascotaDAO;
use DAO\ReservaDAO;

include('header.php');
include('nav-bar.php');
?>

<div class="container">

    <!-- Profile Header ----------------------------------------------------------------------------->
    <div class="row pt-4">
        <div class="col-md-12 col-lg-3 d-flex justify-content-center">
            <div class="rounded-circle overflow-hidden profile-picture position-relative border border-5 border-primary shadow-sm">
                <img src="<?php echo IMG_PATH . $_SESSION["loggedUser"]->getRutaFoto() ?>" alt="profilePic" width="auto" height="250" class="profile-picture-img position-absolute top-50 start-50 translate-middle">
            </div>
        </div>
        <div class="col-9 my-auto">
            <h1 class="text-primary profile-nombre"><?php echo $_SESSION["loggedUser"]->getNombre() . " " . $_SESSION["loggedUser"]->getApellido()?></h1>
            <h4 class="mb-3 ms-1"><small><?php echo $_SESSION["loggedUser"]->getTipoDescripcion() ?></small></h4>
            <?php if($_SESSION["loggedUser"]->getTipo() == 2) {
            $guardian = $_SESSION["loggedUser"];?>
            <br>
            <h4 class="mb-3 ms-1"><small>Precio por día: <?php echo "$" . $guardian->getPrecioXDia(); ?></small></h4>
            <?php 
            $n = 0;
            for ($i = 1; $i <= (int)$guardian->getReputacion(); $i++) {?>
                <img src="<?php echo IMG_PATH . "pawFull.png"; ?>" class="p-1" width="30" height="30" alt=""><?php
                $n = $i;
            }
            if (($guardian->getReputacion() - (int)$guardian->getReputacion()) >= 0.5) {?>
                <img src="<?php echo IMG_PATH . "pawHalf.png"; ?>" class="p-1" width="30" height="30" alt=""><?php
                $n++;
            }
            if ($i <= 5) {
                for ($i = $n + 1; $i <= 5; $i++) {?>
                <img src="<?php echo IMG_PATH . "pawEmpty.png"; ?>" class="p-1" width="30" height="30" alt="">
                <?php } 
            } } ?>
        </div>
    </div>
    <!---------------------------------------------------------------------------------------------->

    <hr class="my-5" />

    <!-- Mascotas (solo dueños)-------------------------------------------------------------------->
    <?php if($_SESSION["loggedUser"]->getTipo() == 1) { ?>
        <div class="row">
            <h2 class="text">Mascotas</Var></h1>
            <div class="d-flex justify-content-left">
                <?php foreach($mascotaList as $mascota) { ?>
                    <a href="<?php echo FRONT_ROOT . "Mascota/ShowMascotaProfile/" . $mascota->getId() ?>">
                    <div class="col m-3">
                        <div class="rounded-circle overflow-hidden profile-picture-small position-relative shadow-sm">
                            <img src="<?php echo IMG_PATH . $mascota->getRutaFoto() ?>" alt="profilePic" width="auto" height="150" class="profile-picture-img position-absolute top-50 start-50 translate-middle">
                        </div>
                        <h5 class="d-flex justify-content-center my-1"><?php echo $mascota->getNombre() ?></h5>
                    </div>
                    </a>
                <?php } ?>
            </div>
        </div>
        <hr class="my-5" />
    <?php } ?>
    <!---------------------------------------------------------------------------------------------->


    <!-- Historial de Reservas (finalizadas)-------------------------------------------------------->
    <div>
        <h2 class="mb-4">Historial de Reservas</h2>
        <?php if(empty($listaReservas)) { ?>
            <p class="alert alert-danger m-4" style="width: fit-content">Todavía no existen reservas finalizadas para mostrar.</p>
        <?php } else { ?>
        <div>
        <?php foreach ($listaReservas as $reserva) {
            $guardianDAO = new GuardianDAO();
            $duenioDAO = new DuenioDAO();
            $mascotaDAO = new MascotaDAO();
            $reservaDAO = new ReservaDAO();

            $guardian = $guardianDAO->BuscarId($reserva->getFkIdGuardian());
            $duenio = $duenioDAO->BuscarId($reserva->getFkIdDuenio());
            $mascota = $mascotaDAO->GetMascotaById($reserva->getFkIdMascota());
            $review = $reservaDAO->GetReviewByIdReserva($reserva->getIdReserva());
        ?>

            <div class="card mb-3 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-4 card-img-reserva position-relative">
                        <img src="<?php echo IMG_PATH . $mascota->getRutaFoto() ?>" class="rounded-start img-reserva img-unselect position-absolute top-50 start-50 translate-middle">
                    </div>
                    <div class="col-md-8 p-1 position-relative">
                        <div class="card-body">
                            <h3 class="card-title"><b><?php echo "Reserva para " . $mascota->getNombre(); ?></b></h3>
                            <h5><small class="card-text">desde el <b><?php echo $reserva->getFechaInicio() ?></b> hasta el <b><?php echo $reserva->getFechaFin(); ?></b></small></h5>
                            <hr class="my-3" />
                            <?php if ($_SESSION["loggedUser"]->getTipo() == 1) { ?>
                                <p class="card-text">Guardian: <b><?php echo $guardian->getNombre() . " " . $guardian->getApellido(); ?></b></p>
                                <p class="card-text">Dirección: <b><?php echo $guardian->getCalle() . " " . $guardian->getNumero() . " " . $guardian->getPiso() . " " . $guardian->getDepartamento() ?></b></p>
                            <?php } else { ?>
                                <p class="card-text">Dueño: <b><?php echo $duenio->getNombre() . " " . $duenio->getApellido(); ?></b></p>
                                <p class="card-text"><span>Animal: <b><?php echo $mascota->getAnimal() ?></b></span><span class="ms-3">Raza: <b><?php echo $mascota->getRaza() ?></b></span></p>
                            <?php } ?>
                            <p class="card-text">Precio Total: <b>$<?php echo $reserva->getPrecioTotal(); ?></b></p>
                            <?php if ($review) { ?>
                                <div class="alert alert-dark" style="width: fit-content;">
                                    <span class="card-text">Review: <b><i><?php echo $review->getComentario(); ?></i></b></span>
                                    <b class="ms-1"><?php echo "- " . $review->getPuntaje(); ?></b>
                                    <img src="<?php echo IMG_PATH . "pawFull.png"; ?>" class="my-auto mb-1 py-1 pe-1" width="26" height="26" alt="">
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php } } ?>
        </div>
    </div>
    <!---------------------------------------------------------------------------------------------->

</div>


<?php
include('footer.php');
?>