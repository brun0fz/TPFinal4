<?php
include('header.php');
include('nav-bar.php');
?>

<div class="container">
    <div class="row pt-4">
        <div class="col-md-12 col-lg-3 d-flex justify-content-center">
            <div class="rounded-circle overflow-hidden profile-picture position-relative border border-5 border-primary shadow-sm">
                <img src="<?php echo IMG_PATH . $mascota->getRutaFoto() ?>" alt="profilePic" width="auto" height="250" class="profile-picture-img position-absolute top-50 start-50 translate-middle">
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
</div>


<?php
include('footer.php');
?>