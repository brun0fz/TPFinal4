<?php
include('header.php');
?>

<div class="container">
    <!-- Registro Header -->
    <div class="col-md-12 d-flex justify-content-center">
        <div class="row d-flex justify-content-center">
            <a href="<?php echo FRONT_ROOT . "Home/Index"; ?>">
                <img class="mt-3 mb-1" src=<?php echo IMG_PATH . "logo.png" ?> alt="Pet Hero" width="150" height="150">
            </a>
        </div>
    </div>
    <div class="col-md-12 d-flex justify-content-center">
        <h1>Nuevo Usuario</h1>
    </div>

    <!-- Registro Form -->
    <div class="col-md-12">
        <?php if ($type == 1) { ?>
            <form class="" action="<?php echo FRONT_ROOT . "Duenio/Add" ?>" method="Post" enctype="multipart/form-data">
            <?php } else { ?>
                <form class="" action="<?php echo FRONT_ROOT . "Guardian/Add" ?>" method="Post" enctype="multipart/form-data">
                <?php } ?>
                <?php if ($alert != "") { ?>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="alert alert-danger" role="alert" style="width: fit-content;">
                            <?php echo $alert ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="col-md-4 m-2 form-floating">
                        <input type="text" name="nombre" class="form-control" id="floatingInput" placeholder="nombre" required>
                        <label for="floatingInput">Nombre</label>
                    </div>
                    <div class="col-md-4 m-2 form-floating">
                        <input type="text" name="apellido" class="form-control" id="floatingInput" placeholder="apellido" required>
                        <label for="floatingInput">Apellido</label>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="col-md-3 m-2 form-floating">
                        <input type="text" name="telefono" class="form-control" id="floatingInput" placeholder="telefono" required pattern="{0,9}">
                        <label for="floatingInput">Telefono</label>
                    </div>
                    <div class="col-md-5 m-2 form-floating">
                        <input type=" email" name="email" class="form-control" id="floatingInput" placeholder="nombre@example.com" required>
                        <label for="floatingInput">Email</label>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="col-md-4 m-2 form-floating">
                        <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z]).{8,}" class="form-control" id="floatingPassword" placeholder="contrase&ntilde;a" required>
                        <label for="floatingPassword">Contrase&ntilde;a</label>
                    </div>
                    <div class="col-md-4 ms-3 my-auto">
                        <small id="passwordHelpBlock" class="form-text text-muted"> Su contrase&ntilde;a debe tener al menos un n&uacute;mero, una letra y un m&iacute;nimo de 8 caracteres.</small>
                    </div>
                </div>

                <!-- Direccion (solo guardianes) -->
                <?php if ($type == 2) { ?>
                    <div class="d-flex justify-content-center">
                        <hr class="col-8 my-4">
                    </div>

                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="col-md-6 m-2 form-floating">
                            <input type="text" name="calle" class="form-control" id="floatingInput" placeholder="calle" required>
                            <label for="floatingPassword">Calle</label>
                        </div>
                        <div class="col-md-2 m-2 form-floating">
                            <input type="text" name="numero" class="form-control" id="floatingInput" placeholder="numero" required>
                            <label for="floatingPassword">Numero</label>
                        </div>
                    </div>

                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="col-md-3 my-2 ms-2 me-1 form-floating">
                            <input type="text" name="piso" class="form-control" id="floatingInput" placeholder="piso">
                            <label for="floatingPassword">Piso</label>
                        </div>
                        <div class="col-md-3 my-2 mx-1 form-floating">
                            <input type="text" name="departamento" class="form-control" id="floatingInput" placeholder="departamento">
                            <label for="floatingPassword">Departamento</label>
                        </div>
                        <div class="col-md-2 my-2 mx-1 form-floating">
                            <input type="text" name="codigoPostal" class="form-control" id="floatingInput" placeholder="codigo postal" required>
                            <label for="floatingPassword">C&oacute;digo Postal</label>
                        </div>
                    </div>

                <?php } ?>

                <div class="d-flex justify-content-center">
                    <hr class="col-8 my-4">
                </div>

                <div class="d-flex justify-content-center">
                    <div class="col-md-8 my-2 mx-auto d-flex justify-content-center form-floating">
                        <input type="file" name="rutaFoto" class="form-control form-control-sm" id="floatingInput" placeholder="Foto" accept=".png, .jpg, .jpeg" <?php if ($type == 2) {
                                                                                                                                                                        echo "required";
                                                                                                                                                                    } ?>>
                        <label for="floatingInput">Foto de Perfil</label>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <div class="col-md-8 m-2">
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Registrarse</button>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="col-md-8 d-flex justify-content-center">
                        <?php if ($type == 1) { ?>
                            <a href="<?php echo  FRONT_ROOT . "Home/ShowRegisterView/2" ?>">Registrarse como Guardian</a>
                        <?php } else { ?>
                            <a href="<?php echo  FRONT_ROOT . "Home/ShowRegisterView/1" ?>">Registrarse como Due&ntilde;o</a>
                        <?php } ?>
                        <span class="text-muted mx-1"> - </span>
                        <a href="<?php echo  FRONT_ROOT . "Home/Index" ?>">Iniciar Sesion</a>
                    </div>
                </div>

                </form>
    </div>
</div>

<?php
include('footer.php');
?>