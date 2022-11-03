<?php
include("header.php");
include("nav-bar.php");
?>

<div class="container">
    <h2 class="mt-4 mb-5">Buscar guardianes</h2>
    <?php if ($alert != "") { ?>
        <div class="alert alert-danger" role="alert" style="width: fit-content;">
            <?php echo $alert ?>
        </div>
    <?php } ?>

    <div class="col-sm-12 col-md-6">
        <hr class="my-5">

        <form action="<?php echo FRONT_ROOT ?>Duenio/FiltrarGuardianes" method="Post">

        <h4 class="text-muted mb-3"><small>Seleccione las fechas deseadas</small></h4>
        <div class="row">
            <div class="col-md-6">
                <label for="fechaInicio">Entrada:</label>
                <input class="form-control" type="date" name="fechaInicio" id="fechaInicio" min="<?php echo date('Y-m-d', strtotime("+1 day")) ?>" oninput="controlFecha()" required>
                <script>
                    function controlFecha() {
                        let fechaInicio = document.getElementById("fechaInicio").value;
                        let fechaFin = document.getElementById("fechaFin");
                        fechaFin.setAttribute("min", fechaInicio);
                        fechaFin.removeAttribute("disabled");
                    }
                </script>
            </div>
            <div class="col-md-6">
                <label for="fechaFin">Salida:</label>
                <input class="form-control" type="date" name="fechaFin" id="fechaFin" disabled required>
            </div>
        </div>

        <hr class="my-5">

        <h4 class="text-muted mb-3"><small>Seleccione la mascota a cuidar</small></h4>
        <div class="col">
            <label for="idMascota">Mascota</label>
            <select class="form-control form-select" name="idMascota" required>
                <?php foreach ($mascotaList as $mascota) { ?>
                    <option value="<?php echo $mascota->getId() ?>"> <?php echo $mascota->getNombre() ?> </option>
                <?php } ?>
            </select>
        </div>
        <hr class="my-5">
        <div class="d-flex justify-content-left">
            <input class="btn btn-lg btn-primary px-5" type="submit" value="Buscar">
        </div>

        </form>
    </div>
</div>

<?php
include("footer.php");
?>