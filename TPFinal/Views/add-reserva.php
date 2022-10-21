<?php
include("header.php");
include("navBar.php");
?>



<div class="container-fluid">
    <main class="add-reserva w-100 m-auto text-center">
        <form class="form-center" action="<?php echo FRONT_ROOT . "Reserva/Add" ?>" method="Post">

            <h3>Nueva Reserva</h3><br>
            <div class="form-floating">
                <input type="text" name="fechaInicio" value= "<?php echo $fechaInicio ?>" class="form-control" id="floatingInput" placeholder="Fecha de Entrada" required readonly>
                <label for="floatingInput">Fecha de Entrada</label>
            </div>
            <div class="form-floating">
                <input type="text" name="fechaFin" value="<?php echo $fechaFin ?>" class="form-control" id="floatingInput" placeholder="Fecha de Salida" required readonly>
                <label for="floatingInput">Fecha de Salida</label>
            </div>
            <div class="form-floating">
                <input type="text" name="guardianName" value="<?php echo $guardian->getName() . $guardian->getApellido() ?>" class="form-control" id="floatingInput" placeholder="Guardian" required readonly>
                <label for="floatingInput">Guardian</label>
            </div>
           
            <div class="form-floating">
                <input type="text" name="precioTotal" class="form-control" id="floatingInput" placeholder="Precio Total" required readonly>
                <label for="floatingInput">Precio Total</label>
            </div>
            <div class="form-floating">
                <input type="text" name="tamanio" value="<?php echo $guardian->getDisponibilidad() ?>"class="form-control" id="floatingInput" placeholder="Tamaño de Mascota" required readonly>
                <label for="floatingInput">Tamaño de Mascota</label>
            </div>
            <div class="form-floating">
                <select class="form-select form-select-sm" name="idMascota" required>
                    <?php foreach($mascotaList as $mascota){?>
                        <option value="<?php echo $mascota->getId() ?>"> <?php echo $mascota->getName() ?> </option>
                    <?php } ?>
                </select>
                <label for="floatingInput">Mascota</label>
            </div>
            <br>
            <input type="hidden" name="idGuardian" value=<?php echo $guardian->getId() ?>>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Reservar</button>
        </form>
    </main>
</div>


<?php
include("footer.php");
?>