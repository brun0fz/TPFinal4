<?php
include('header.php');
?>

<div class="registro">
    <p>Registrarse</p>
    <form action="<?php echo FRONT_ROOT ?>Duenio/Add" method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Apellido" required>
        <input type="text" name="telefono" placeholder="Telefono" required pattern="{0,9}">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Registrarse</button>
    </form>
</div>

<?php
include('footer.php');
?>