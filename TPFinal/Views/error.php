<?php
include("header.php");
include("nav-bar.php");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-center">
            <h1 class="text-primary mx-auto my-5">Oops!</h1>
            <h3 class="mx-auto">Se ha producido un error.</h3>
            <h3 class="mx-auto">Intente nuevamente.</h3>
            <a href="<?php echo FRONT_ROOT . "Home/Index"; ?>" class="mx-auto my-5"><button class="btn btn-primary">Volver al Inicio</button></a>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="d-flex justify-content-center">
                <img src="<?php echo ASSETS_PATH . "error.png" ?>" alt="error" class="img-unselect" width="60%" height="auto">
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php")
?>