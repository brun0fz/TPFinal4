<?php
include("header.php");
include("navBar.php");
?>


<div class="container-fluid">
    <main class="add-mascota w-100 m-auto text-center">
        <form class="form-center" name="f1" action="<?php echo FRONT_ROOT . "Mascota/Add" ?>" method="Post" enctype="multipart/form-data">
            <h3>Nueva Mascota</h3><br>
            <div class="form-floating">
                <input type="text" name="nombre" class="form-control" id="floatingInput" placeholder="nombre" required>
                <label for="floatingInput">Nombre</label>
            </div>
            <div class="form-floating">
                <select class="form-select form-select-sm" name="animal" id="animal" required oninput="cambiaRaza()">
                    <option disabled selected value>-Seleccione un animal-</option>
                    <?php $auxAnimales = array();
                    foreach ($animalesList as $animal) {
                        if (!in_array($animal["animal"], $auxAnimales)) { ?>
                            <option value="<?php echo $animal["animal"] ?>"><?php echo $animal["animal"] ?></option>
                    <?php array_push($auxAnimales, $animal["animal"]);
                        }
                    } ?>
                </select>
                <label for="floatingInput">Animal</label>
            </div>
            <div class="form-floating">
                <select class="form-select form-select-sm" name="raza" id="raza" required disabled>
                    <option value=""></option>
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

<script>
    <?php
    $perros = array();
    $gatos = array();
    foreach ($animalesList as $animal) {
        if ($animal["animal"] == "Perro") {
            $perros[] = $animal["raza"];
        } else {
            $gatos[] = $animal["raza"];
        }
    }
    ?>

    let perros = <?php echo json_encode($perros) ?>;
    let gatos = <?php echo json_encode($gatos) ?>;

    function cambiaRaza() {

        let animal = document.getElementById('animal').value;
        document.f1.raza.removeAttribute("disabled");

        if (animal == "Perro") {

            let numPerros = perros.length;
            document.f1.raza.length = numPerros;

            for (i = 0; i < numPerros; i++) {
                document.f1.raza.options[i].value = perros[i];
                document.f1.raza.options[i].text = perros[i];
            }

        } else {

            let numGatos = gatos.length;
            document.f1.raza.length = numGatos;

            for (i = 0; i < numGatos; i++) {
                document.f1.raza.options[i].value = gatos[i];
                document.f1.raza.options[i].text = gatos[i];
            }
        }
    }
</script>


<?php
include("footer.php");
?>