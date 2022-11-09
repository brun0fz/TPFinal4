<?php
use DAO\DuenioDAO;
use DAO\GuardianDAO;
use DAO\MascotaDAO;
use DAO\ReservaDAO;

include('header.php');
include('nav-bar.php');
?>

<div class="container">
    <div class="row pt-4">
        <div class="col-md-12 col-lg-3 d-flex justify-content-center">
            <div class="rounded-circle overflow-hidden profile-picture position-relative border border-5 border-primary shadow-sm">
                <img src="<?php echo IMG_PATH . $mascota->getRutaFoto() ?>" alt="profilePic" width="auto" height="250" class="profile-picture-img img-unselect position-absolute top-50 start-50 translate-middle">
            </div>
        </div>
        <div class="col-9 my-auto">
            <h1 class="text-primary profile-nombre"><?php echo $mascota->getNombre() ?></h1>
            <h4 class="my-3 ms-1"><small>Animal: <?php echo $mascota->getAnimal() ?></small></h4>
            <h4 class="my-3 ms-1"><small>Raza: <?php echo $mascota->getRaza() ?></small></h4>
            <h4 class="my-3 ms-1"><small>Tama&ntilde;o: <?php echo $mascota->getTamanioDescripcion() ?></small></h4>
            <h4 class="my-3 ms-1"><small>Observaciones: <?php echo $mascota->getObservaciones() ?></small></h4>
        </div>
    </div>
    <hr class="my-5" />
    <div class="row">
        <div class="col-md-12 col-lg-6 pb-2">
            <h2 class="text">Vacunas</h2>
            <div class="d-flex justify-content-center">
                <img src="<?php echo IMG_PATH . $mascota->getRutaPlanVacunas() ?>" alt="vacunas" class="mx-auto img-fluid p-3">
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <?php if($mascota->getRutaVideo() != "undefinedVideo"){ ?>
            <h2 class="text">Video</h2>
            <div class="d-flex justify-content-center">
                <video src="<?php echo VID_PATH . $mascota->getRutaVideo() ?>" alt="video" controls autoplay loop muted class="mx-auto img-fluid p-3">
            </div>
            <?php } ?>
        </div>
    </div>

    <hr class="my-5" />

    <!-- Historial de Reservas (finalizadas)-------------------------------------------------------->
    <div>
        <h2 class="mb-4">Historial de Reservas</h2>
        <?php if(empty($listaReservas)) { ?>
            <p class="alert alert-danger m-4" style="width: fit-content">Todav&iacute;a no existen reservas finalizadas para mostrar.</p>
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
                            <p class="card-text">Due&ntilde;o: <b><?php echo $duenio->getNombre() . " " . $duenio->getApellido(); ?></b></p>
                            <p class="card-text">Guardian: <b><?php echo $guardian->getNombre() . " " . $guardian->getApellido(); ?></b></p>
                            <p class="card-text">Direcci&oacute;n: <b><?php echo $guardian->getCalle() . " " . $guardian->getNumero() . " " . $guardian->getPiso() . " " . $guardian->getDepartamento() ?></b></p>
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