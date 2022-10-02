<?php
include('header.php');
?>

<div class="registro">
    <h1>Nuevo Usuario</h1>
    <?php if($type==1){ ?>
        <form action="<?php echo FRONT_ROOT."Duenio/Add"?>" method="POST">
    <?php }
    else{ ?>
        <form action="<?php echo FRONT_ROOT."Guardian/Add" ?>" method="POST">
    <?php } ?>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" placeholder="Nombre" required><br>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" placeholder="Apellido" required><br>
        <label for="apellido">Telefono:</label>
        <input type="text" name="telefono" placeholder="Telefono" required pattern="{0,9}"><br>
        <label for="apellido">Email:</label>
        <input type="email" name="email" placeholder="Email" required><br>
        <label for="apellido">Contraseña:</label>
        <input type="password" name="password" placeholder="Password" required><br>
        <?php if($type==2){ ?>
            <label for="apellido">Direccion:</label>
            <input type="text" name="direccion" placeholder="Direccion" required><br>
        <?php } ?>
        <button type="submit">Registrarse</button>
    </form>
</div>

<?php
include('footer.php');
?>