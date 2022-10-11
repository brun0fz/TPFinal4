<?php
include("header.php");
include("navBar.php");
?>


<div class="container-fluid">
    <main class="add-mascota w-100 m-auto text-center">
            <form class="form-center" action="<?php echo FRONT_ROOT."Duenio/AddMascota" ?>" method="Post" enctype="multipart/form-data">
                <h3>Nueva Mascota</h3><br>
                <div class="form-floating">
                    <input type="text" name="nombre" class="form-control" id="floatingInput" placeholder="nombre" required>
                    <label for="floatingInput">Nombre</label>
                </div>
                <div class="form-floating">
                    <input type="text" name="raza" class="form-control" id="floatingInput" placeholder="raza" required>
                    <label for="floatingInput">Raza</label>
                </div>
                <div class="form-floating">
                    <input type="text" name="tamanio" class="form-control" id="floatingInput" placeholder="tamanio" required pattern="{0,9}">
                    <label for="floatingInput">Tamaño</label>
                </div>
                <div class="form-floating">
                    <input type="textarea" name="observaciones" class="form-control" id="floatingInput" placeholder="observaciones" required>
                    <label for="floatingInput">Observaciones</label>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label"></label>
                    <input class="form-control" type="file" id="formFile" name="rutaFoto">
                </div><!--
                <div class="form-floating imgInput">
                    <input type="file" name="rutaFoto" class="form-control" id="floatingInput" placeholder="Foto" accept=".png, .jpg, .jpeg" required>
                    <label for="floatingInput">Foto</label>
                </div>-->
                <br>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Añadir</button>
            </form>
    </main>
</div>


<?php
include("footer.php");
?>


