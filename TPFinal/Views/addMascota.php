<?php
include("header.php");
include("navBar.php");
?>


<div class="container-fluid">
    <main class="add-mascota w-100 m-auto text-center">
        <form class="form-center" action="<?php echo FRONT_ROOT . "Mascota/Add" ?>" method="Post" enctype="multipart/form-data">
            <h3>Nueva Mascota</h3><br>
            <div class="form-floating">
                <input type="text" name="nombre" class="form-control" id="floatingInput" placeholder="nombre" required>
                <label for="floatingInput">Nombre</label>
            </div>
            <div class="form-floating">
                <select class="form-select form-select-sm" name="animal" id="animal" required oninput="filtrarRaza()">
                    <?php $auxAnimales = array();
                    foreach ($animalesList as $animal) {
                        if (!in_array($animal["animal"], $auxAnimales)) { ?>
                            <option value="<?php echo $animal["animal"] ?>"><?php echo $animal["animal"] ?></option>
                    <?php array_push($auxAnimales, $animal["animal"]);
                        }
                    } ?>
                </select>
                <script>
                    function filtrarRaza() {
                        let animal = document.getElementById("animal").value;
                        let raza = document.getElementById("raza");
                        
                    }
                </script>
                <label for="floatingInput">Animal</label>
            </div>
            <div class="form-floating">
                <select class="form-select form-select-sm" name="raza" id="raza" required>
                    <?php foreach ($animalesList as $animal) { ?>
                        <option value="<?php echo $animal["raza"] ?>"><?php echo $animal["raza"] ?></option>
                    <?php } ?>
                </select>
                <label for="floatingInput">Raza</label>
            </div>
            <div class="form-floating">
                <select class="form-select form-select-sm" name="tamanio" required>
                    <option value="S">Pequeño</option>
                    <option value="M">Mediano</option>
                    <option value="L">Grande</option>
                </select>
                <label for="floatingInput">Tamaño</label>
            </div>
            <div class="form-floating">
                <input type="textarea" name="observaciones" class="form-control" id="floatingInput" placeholder="observaciones" required>
                <label for="floatingInput">Observaciones</label>
            </div>
            <div class="form-floating" imgInput>
                <input type="file" name="rutaFoto" class="form-control form-control-sm" id="floatingInput" placeholder="Foto" accept=".png, .jpg, .jpeg" required>
                <label for="floatingInput">Foto</label>
            </div>
            <div class="form-floating" imgInput>
                <input type="file" name="rutaPlanVacunas" class="form-control form-control-sm" id="floatingInput" placeholder="Plan de Vacunas" accept=".png, .jpg, .jpeg" required>
                <label for="floatingInput">Plan de Vacunas</label>
            </div>
            <br>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Añadir</button>
        </form>
    </main>
</div>


<?php
include("footer.php");
?>