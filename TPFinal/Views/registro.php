<?php
include('header.php');
?>
<!--
<div class="registro">
    <h1>Nuevo Usuario</h1>
    <?php if ($type == 1) { ?>
        <form action="<?php //echo FRONT_ROOT."Duenio/Add"
                        ?>" method="POST">
    <?php } else { ?>
        <form action="<?php //echo FRONT_ROOT."Guardian/Add" 
                        ?>" method="POST">
    <?php } ?>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" placeholder="Nombre" required><br>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" placeholder="Apellido" required><br>
        <label for="telefono">Telefono:</label>
        <input type="text" name="telefono" placeholder="Telefono" required pattern="{0,9}"><br>
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Email" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" placeholder="Password" required><br>
        <?php if ($type == 2) { ?>
            <label for="direccion">Direccion:</label>
            <input type="text" name="direccion" placeholder="Direccion" required><br>
        <?php } ?>
        <button type="submit">Registrarse</button>
    </form>
</div>
        -->

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
                        <input type="text" name="direccion" class="form-control" id="floatingPassword" placeholder="direccion" required>
                        <label for="floatingPassword">Direccion</label>
                    </div>
                 <?php } ?>
                <div class="form-floating" imgInput">
                    <input type="file" name="rutaFoto" class="form-control form-control-sm" id="floatingInput" placeholder="Foto" accept=".png, .jpg, .jpeg" <?php if ($type == 2) {echo "required";} ?>>
                    <label for="floatingInput">Foto</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Registrarse</button><br><br>
                <a href="<?php echo  FRONT_ROOT . "Home/Index" ?>">Iniciar Sesion</a>
            </form>
    </main>
</div>

<?php
include('footer.php');
?>