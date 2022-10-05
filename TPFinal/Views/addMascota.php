<?php
include("validateSession.php");
include("header.php");
include("navBar.php");
?>


<div class="add-mascota">
    <form action="<?php echo FRONT_ROOT . "Duenio/AddMascota" ?>" method="post">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id=""><br>
        <label for="raza">Raza</label>
        <input type="text" name="raza" id=""><br>
        <label for="tamanio">Tamaño</label>
        <input type="text" name="tamanio" id=""><br>
        <label for="observaciones">Observaciones</label>
        <input type="textarea" name="observaciones" id=""><br>
        <button type="submit">Agregar</button>
    </form>
</div>

<?php
include("footer.php");
?>


