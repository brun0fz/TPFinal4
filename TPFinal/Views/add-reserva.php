<?php
include("header.php");
include("navBar.php");

?>



<div class="container-fluid">
    <main class="add-reserva w-100 m-auto text-center">
        <form class="form-center" action="<?php echo FRONT_ROOT . "Reserva/Add" ?>" method="Post">

            <h3>Nueva Reserva</h3><br>
            <div class="form-floating">
                <input type="date" name="fechaInicio" value="<?php echo $fechaInicio ?>" class="form-control" id="floatingInput" placeholder="Fecha de Entrada" required readonly>
                <label for="floatingInput">Fecha de Entrada</label>
            </div>
            <div class="form-floating">
                <input type="date" name="fechaFin" value="<?php echo $fechaFin ?>" class="form-control" id="floatingInput" placeholder="Fecha de Salida" required readonly>
                <label for="floatingInput">Fecha de Salida</label>
            </div>
            <div class="form-floating">
                <input type="text" value="<?php echo $guardian->getNombre() . " " . $guardian->getApellido() ?>" class="form-control" id="floatingInput" placeholder="Guardian" required readonly>
                <label for="floatingInput">Guardian</label>
            </div>

            <div class="form-floating">
                <input type="text" name="precioTotal" value="<?php echo $precioTotal ?>" class="form-control" id="floatingInput" placeholder="Precio Total" required readonly>
                <label for="floatingInput">Precio Total</label>
            </div>
            <div class="form-floating">
                <input type="text" value="<?php echo implode(" ", $guardian->getTamanioMascotaCuidar()) ?>" class="form-control" id="floatingInput" placeholder="Tamaños Aceptados" required readonly>
                <label for="floatingInput">Tamaños Aceptados</label>
            </div>
            <div class="form-floating">
                <select class="form-select form-select-sm" name="idMascota" required>
                    <?php foreach ($mascotaList as $mascota) { ?>
                        <option value="<?php echo $mascota->getId() ?>" <?php if (!(in_array($mascota->getTamanioDescripcion(), $guardian->getTamanioMascotaCuidar()))){echo "disabled";}  ?>> <?php echo $mascota->getNombre() ?> </option>
                    <?php } ?>
                </select>
                <label for="floatingInput">Mascota</label>
            </div>
            <br>
            <input type="hidden" name="idGuardian" value=<?php echo $guardian->getId() ?>>
            <input type="hidden" name="idDuenio" value=<?php echo $_SESSION["loggedUser"]->getId() ?>>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Reservar</button>
        </form>
    </main>
</div>


<?php
include("footer.php");
?>