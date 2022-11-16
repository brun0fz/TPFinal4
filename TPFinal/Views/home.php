<?php
include('header.php');
?>

<div class="container">
  <div class="row login">

    <!-- Logo y Descripcion -->
    <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-center">
      <a href="<?php echo FRONT_ROOT . "Home/Index"; ?>">
        <div class="d-flex justify-content-center">
          <img class="pt-3 pb-2 px-5 img-unselect" src=<?php echo ASSETS_PATH . "logo3.png" ?> alt="Pet Hero" width="80%" height="auto">
        </div>
      </a>
      <div>
        <h3 class="pt-2 pb-3 px-5 text-center">Pet Hero te ayuda a buscar a la persona correcta para cuidar de tu mascota.</h3>
      </div>
    </div>

    <!-- Login Form -->
    <div class="col-md-12 col-lg-4 d-flex flex-column justify-content-center">
      <div class="mx-3 p-3 rounded card shadow login-form">
        <form class="form-center" action="<?php echo FRONT_ROOT . "Home/Login" ?>" method="POST">
          <?php if ($alert != "") { ?>
            <div class="alert alert-danger" role="alert" style= "font-size: 14px;">
              <?php echo $alert ?>
            </div>
          <?php } ?>
          <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="nombre@example.com" required>
            <label for="floatingInput">Email</label>
          </div>
          <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="contrase&ntilde;a" required>
            <label for="floatingPassword">Contrase&ntilde;a</label>
          </div>
          <br>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Iniciar Sesi&oacute;n</button>
          </form>
          <div class="d-flex flex-column justify-content-center my-2">
            <a href="<?php echo  FRONT_ROOT . "Home/ShowRecuperarContraseniaView" ?>" class="d-flex justify-content-center mt-1">Olvid&eacute; mi contraseña</a>
            <hr class="my-3 mx-4"/>
            <a href="<?php echo  FRONT_ROOT . "Home/ShowRegisterView/1" ?>" class="d-flex justify-content-center">Registrarse como Due&ntilde;o</a>
            <a href="<?php echo  FRONT_ROOT . "Home/ShowRegisterView/2" ?>" class="d-flex justify-content-center">Registrarse como Guardi&aacute;n</a>
          </div>       
      </div> 
    </div>

  </div>
</div>

<?php
include('footer.php');
?>