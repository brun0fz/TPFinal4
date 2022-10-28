<?php
include('header.php');
?>



<div class="login container-fluid">

  <main class="form-signin w-100 m-auto text-center">
    <form class="form-center" action="<?php echo FRONT_ROOT . "Home/Login" ?>" method="POST">
      <img class="mb-4" src=<?php echo IMG_PATH . "logo.png" ?> alt="Pet Hero" width="250" height="250">
      <?php if ($mensaje != "") { ?>
        <div class="alert alert-danger" role="alert" style= "font-size: 14px;">
          <?php echo $mensaje ?>
        </div>
      <?php } ?>
      <div class="form-floating">
        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="nombre@example.com" required>
        <label for="floatingInput">Email</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="contraseña" required>
        <label for="floatingPassword">Contraseña</label>
      </div>
      <br>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Iniciar Sesion</button><br><br>
      <a href="<?php echo  FRONT_ROOT . "Home/ShowRegisterView/1" ?>">Registrarse como Dueño</a><br>
      <a href="<?php echo  FRONT_ROOT . "Home/ShowRegisterView/2" ?>">Registrarse como Guardian</a>
    </form>
  </main>
</div>

<?php
include('footer.php');
?>