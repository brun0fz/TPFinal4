<?php
include("header.php");
include("navBar.php");
?>

<div class="container">
    <h2 class="py-3">Seleccione las fechas deseadas y la mascota a cuidar</h2><br>

    <?php if ($alert != "") { ?>
        <div class="alert alert-danger" role="alert" style=" width: 300px;">
            <?php echo $alert ?>
        </div>
    <?php } ?>

    <div class="col-sm-12 col-md-7">
        <form action="<?php echo FRONT_ROOT ?>Duenio/FiltrarGuardianes" method="Post">
            <label for="fechaInicio">Entrada:</label>
            <input type="date" name="fechaInicio" id="fechaInicio" min="<?php echo date('Y-m-d', strtotime("+1 day")) ?>" oninput="controlFecha()" required>
            <script>
                function controlFecha() {
                    let fechaInicio = document.getElementById("fechaInicio").value;
                    let fechaFin = document.getElementById("fechaFin");
                    fechaFin.setAttribute("min", fechaInicio);
                    fechaFin.removeAttribute("disabled");
                }
            </script>
            <label for="fechaFin">Salida:</label>
            <input type="date" name="fechaFin" id="fechaFin" disabled required>
            <br>
            <div class="form-floating">
                <select class="form-select form-select-sm" name="idMascota" required>
                    <?php foreach ($mascotaList as $mascota) { ?>
                        <option value="<?php echo $mascota->getId() ?>"> <?php echo $mascota->getNombre() ?> </option>
                    <?php } ?>
                </select>
                <label for="floatingInput">Mascota</label>
            </div>
            <br>
            <input class="btn btn-lg btn-primary" type="submit" value="Buscar guardianes">
        </form>
    </div>
</div>

<?php
include("footer.php");
?>