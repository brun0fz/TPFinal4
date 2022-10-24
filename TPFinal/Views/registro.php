<?php
include('header.php');
?>

<div class="login container-fluid">
    <main class="form-signin w-100 m-auto text-center">
        <?php if ($type == 1) { ?>
            <form class="form-center" action="<?php echo FRONT_ROOT."Duenio/Add"?>" method="Post" enctype="multipart/form-data">
        <?php } else { ?>
            <form class="form-center" action="<?php echo FRONT_ROOT."Guardian/Add" ?>" method="Post" enctype="multipart/form-data">
        <?php } ?>
                <img class="mb-4" src=<?php echo IMG_PATH . "logo.png" ?> alt="Pet Hero" width="150" height="150">
                <h3>Nuevo Usuario</h3><br>
                <div class="form-floating">
                    <input type="text" name="nombre" class="form-control" id="floatingInput" placeholder="nombre" required>
                    <label for="floatingInput">Nombre</label>
                </div>
                <div class="form-floating">
                    <input type="text" name="apellido" class="form-control" id="floatingInput" placeholder="apellido" required>
                    <label for="floatingInput">Apellido</label>
                </div>
                <div class="form-floating">
                    <input type="text" name="telefono" class="form-control" id="floatingInput" placeholder="telefono" required pattern="{0,9}">
                    <label for="floatingInput">Telefono</label>
                </div>
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="nombre@example.com" required>
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="contraseña" required>
                    <label for="floatingPassword">Contraseña</label>
                </div>
                <?php if ($type == 2) { ?>
                    <div class="form-floating">
                        <input type="text" name="calle" class="form-control" id="floatingInput" placeholder="calle" required>
                        <label for="floatingPassword">Calle</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" name="numero" class="form-control" id="floatingInput" placeholder="numero" required>
                        <label for="floatingPassword">Numero</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" name="piso" class="form-control" id="floatingInput" placeholder="piso">
                        <label for="floatingPassword">Piso</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" name="departamento" class="form-control" id="floatingInput" placeholder="departamento">
                        <label for="floatingPassword">Departamento</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" name="codigoPostal" class="form-control" id="floatingInput" placeholder="codigo postal" required>
                        <label for="floatingPassword">Codigo Postal</label>
                    </div>
                 <?php } ?>
                <div class="form-floating">
                    <input type="file" name="rutaFoto" class="form-control form-control-sm" id="floatingInput" placeholder="Foto" accept=".png, .jpg, .jpeg" <?php if ($type == 2) {echo "required";} ?>>
                    <label for="floatingInput">Foto</label>
                </div><br>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Registrarse</button><br><br>
                <?php if ($type == 1) { ?>
                    <a href="<?php echo  FRONT_ROOT."Home/ShowRegisterView/2"?>">Registrarse como Guardian</a>
                <?php }else{ ?>
                    <a href="<?php echo  FRONT_ROOT."Home/ShowRegisterView/1"?>">Registrarse como Dueño</a>
                <?php }?><br>
                <a href="<?php echo  FRONT_ROOT . "Home/Index" ?>">Iniciar Sesion</a>
            </form>
    </main>
</div>

<?php
include('footer.php');
?>