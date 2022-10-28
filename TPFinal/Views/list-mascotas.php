<?php
include("header.php");
include("navBar.php");
?>

<div class="container list-mascotas">
    <h2 id="list-title">Mis Mascotas</h2>
    <?php if ($alert != "") { ?>
        <div class="alert alert-primary" role="alert" style= " width: 300px;  color:black; background-color:rgba(152,251,152, 0.2); border-color:rgba(152,251,152, 0.2)">
          <?php echo $alert ?>
          </div>
          <?php } ?>
    <a href="<?php echo FRONT_ROOT . "Mascota/ShowAddMascotaView" ?>"><button class="btn btn-primary btn-mascota">Añadir Mascota</button></a><br>
    <div class="row row-cols-sm-1 row-cols-md-3">
        <?php foreach ($mascotasList as $mascota) { ?>
            <div class="card g-3 m-3 shadow-sm" style="width: 400px">
                <div class="img-container">
                    <img src="<?php echo IMG_PATH . $mascota->getRutaFoto() ?>" class="card-img-top img-mascota" alt="<?php echo $mascota->getNombre() ?>">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><b><?php echo $mascota->getNombre() ?></b></h5>
                    <p class="card-text">Raza: <b><?php echo $mascota->getRaza() ?></b></p>
                    <p class="card-text">Tamaño: <b><?php echo $mascota->getTamanioDescripcion() ?></b></p>
                    <p class="card-text">Observaciones: <b><?php echo $mascota->getObservaciones() ?></b></p>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-primary">Ver</button>
                    <button type="button" class="btn btn-sm btn-outline-primary">Editar</button>
                    </div>
                    <br><br>
              </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include("footer.php");
?>