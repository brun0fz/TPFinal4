<?php
include("header.php");
include("navBar.php");
?>

<div class="container">
    <br><h1>Configuración</h1><br><br>
    <div class="row justify-content-start">
        <div class="col-12">
            <form class="formcheck" action="<?php echo FRONT_ROOT ?>Guardian/setDisponibilidad" method="Post">
                <label class="formcheck label" for="checkbox"><h3>Días disponibles</h3></label><br>
                <div class="formcheck items">
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Lunes" <?php if(in_array("Lunes", $disponibilidad)){echo 'checked="checked"';} ?>> Lunes
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Martes" <?php if(in_array("Martes", $disponibilidad)){echo 'checked="checked"';} ?>> Martes
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Miercoles" <?php if(in_array("Miercoles", $disponibilidad)){echo 'checked="checked"';} ?>> Miercoles
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Jueves" <?php if(in_array("Jueves", $disponibilidad)){echo 'checked="checked"';} ?>> Jueves
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Viernes" <?php if(in_array("Viernes", $disponibilidad)){echo 'checked="checked"';} ?>> Viernes
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Sabado" <?php if(in_array("Sabado", $disponibilidad)){echo 'checked="checked"';} ?>> Sabado
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="dias[]" value="Domingo" <?php if(in_array("Domingo", $disponibilidad)){echo 'checked="checked"';} ?>> Domingo

                    <input class="btn btn-sm btn-primary ms-3" type="submit" value="Guardar">
                </div>
            </form>
        </div>
        <hr class="my-5"/>
        <div class="col-12">
            <form class="formcheck" action="<?php echo FRONT_ROOT ?>Guardian/setTamanios" method="Post">
                <label class="formcheck label" for="checkbox"><h3>Tamaño de Mascotas</h3></label><br>
                <div class="formcheck items">
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="tamanios[]" value="S" <?php if(in_array("S", $tamanioArray)){echo 'checked="checked"';} ?>> Pequeño
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="tamanios[]" value="M" <?php if(in_array("M", $tamanioArray)){echo 'checked="checked"';} ?>> Mediano
                    <input class="form-check-input align-middle ms-3" type="checkbox" name="tamanios[]" value="L" <?php if(in_array("L", $tamanioArray)){echo 'checked="checked"';} ?>> Grande

                    <input class="btn btn-sm btn-primary ms-3" type="submit" value="Guardar">
                </div>
            </form>  
        </div>
        <hr class="my-5"/>
        <div class="col-12">
            <h3>Precio por día</h3>
            <form class="row row-cols-lg-auto g-3 align-items-center" action="<?php echo FRONT_ROOT ?>Guardian/setPrecio" method="Post">
                <div class="form-floating ms-3" width="200px">
                    <input type="text" name="precio" class="form-control" id="floatingInput" value="<?php echo $_SESSION["loggedUser"]->getPrecioXDia() ?>" placeholder="precio" required>
                    <label for="floatingInput">Precio($)</label>
                </div>
                <input class="btn btn-sm btn-primary ms-3" type="submit" value="Guardar">
            </form> 
        </div>
    </div>
</div>

<?php
include("footer.php")
?>