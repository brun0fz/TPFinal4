<?php
include('header.php');
?>



<div class="login container-fluid">

    <main class="form-signin w-100 m-auto text-center">
        <form class="form-center" action="<?php echo FRONT_ROOT . "Home/RecuperarContrasenia" ?>" method="POST">
            <a href="<?php echo FRONT_ROOT . "Home/Index"; ?>">
                <img class="mb-4 img-unselect" src=<?php echo ASSETS_PATH . "logo.png" ?> alt="Pet Hero" width="250" height="250">
            </a>
            <?php if ($alert != "") { ?>
                <div class="alert alert-warning" role="alert" style="font-size: 14px;">
                    <?php echo $alert ?>
                </div>
            <?php } ?>
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="nombre@example.com" required>
                <label for="floatingInput">Email</label>
            </div>
            <br>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Recuperar Contrase&ntilde;a</button><br><br>
            <a href="<?php echo  FRONT_ROOT . "Home/Index" ?>">Iniciar Sesi&oacute;n</a>
        </form>
    </main>
</div>

<?php
include('footer.php');
?>