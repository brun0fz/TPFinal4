<?php
include('header.php');
?>



<div class="login container-fluid">

  <main class="form-signin w-100 m-auto text-center">
    <form class="form-center" action="<?php echo FRONT_ROOT . "Home/Login" ?>" method="POST">
      <a href="<?php echo FRONT_ROOT . "Home/Index"; ?>">
        <img class="mb-4 img-unselect" src=<?php echo IMG_PATH . "logo.png" ?> alt="Pet Hero" width="250" height="250">
      </a>
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
      <button class="w-100 btn btn-lg btn-primary" type="submit">Iniciar Sesion</button><br><br>
      <a href="<?php echo  FRONT_ROOT . "Home/ShowRegisterView/1" ?>">Registrarse como Due&ntilde;o</a><br>
      <a href="<?php echo  FRONT_ROOT . "Home/ShowRegisterView/2" ?>">Registrarse como Guardian</a>
    </form>
  </main>
  
</div>

<?php
include('footer.php');
?>