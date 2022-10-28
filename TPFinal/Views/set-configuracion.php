<?php
include("header.php");
include("navBar.php");
?>

<div class="container">
    <br><h1>Configuración</h1><br><br>
    <div class="row justify-content-start">
    <form class="formcheck" action="<?php echo FRONT_ROOT ?>Guardian/setConfig" method="Post">
        <div class="col-12">
                <label class="formcheck label" for="checkbox"><h3>Días disponibles</h3></label><br>
                <div class="formcheck form-switch items">
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Lunes" <?php if(in_array("Lunes", $disponibilidad)){echo 'checked="checked"';} ?>> Lunes
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Martes" <?php if(in_array("Martes", $disponibilidad)){echo 'checked="checked"';} ?>> Martes
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Miercoles" <?php if(in_array("Miercoles", $disponibilidad)){echo 'checked="checked"';} ?>> Miercoles
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Jueves" <?php if(in_array("Jueves", $disponibilidad)){echo 'checked="checked"';} ?>> Jueves
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Viernes" <?php if(in_array("Viernes", $disponibilidad)){echo 'checked="checked"';} ?>> Viernes
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Sabado" <?php if(in_array("Sabado", $disponibilidad)){echo 'checked="checked"';} ?>> Sabado
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Domingo" <?php if(in_array("Domingo", $disponibilidad)){echo 'checked="checked"';} ?>> Domingo
                </div>
        </div>
        <hr class="my-5"/>
        <div class="col-12">
                <label class="formcheck label" for="checkbox"><h3>Tamaño de Mascotas</h3></label><br>
                <div class="formcheck form-switch items">
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="tamanios[]" value="Pequeño" <?php if(in_array("Pequeño", $tamanioArray)){echo 'checked="checked"';} ?>> Pequeño
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="tamanios[]" value="Mediano" <?php if(in_array("Mediano", $tamanioArray)){echo 'checked="checked"';} ?>> Mediano
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="tamanios[]" value="Grande" <?php if(in_array("Grande", $tamanioArray)){echo 'checked="checked"';} ?>> Grande

                </div>
        </div>
        <hr class="my-5"/>
        <div class="col-sm-12 col-md-6 col-lg-3">
            <h3>Precio por día</h3>
                <div class="form-floating mx-5 row">
                    <input type="text" name="precio" class="form-control" id="floatingInput" value="<?php echo $_SESSION["loggedUser"]->getPrecioXDia() ?>" placeholder="precio" required>
                    <label for="floatingInput">Precio($)</label>
                </div>
               
        </div>
     </div>
     <div class="my-5 row">
        <div class="col-sm-8 col-md-9 d-flex justify-content-center my-2">
            <?php if ($alert != "") { ?>
                <div class="alert alert-success my-auto mx-auto" role="alert" style= "width: 300px">
                <?php echo $alert ?>
                </div>
            <?php } ?>
        </div>
        <div class="col-sm-4 col-md-3 d-flex justify-content-center my-2">
            <input class="btn btn-lg btn-primary mx-auto px-5" type="submit" value="Guardar">
        </div>
    </div>
    </form> 
</div>

<?php
include("footer.php")
?>