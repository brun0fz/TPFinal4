<?php
include("header.php");
include("navBar.php");
?>

<?php 
$disponibilidad = $_SESSION["loggedUser"]->getDisponibilidad();
?>
    <form class="formcheck" action="<?php echo FRONT_ROOT ?>Guardian/setDisponibilidad" method="Post">
        <label class="formcheck label" for="checkbox"><h1>Dias disponibles</h1></label><br><br>
        <div class="formcheck items">
            <input class="form-check-input" type="checkbox" name="dias[]" value="Lunes" <?php if(in_array("Lunes", $disponibilidad)){echo 'checked="checked"';} ?>> Lunes<br>
            <input class="form-check-input" type="checkbox" name="dias[]" value="Martes" <?php if(in_array("Martes", $disponibilidad)){echo 'checked="checked"';} ?>> Martes<br>
            <input class="form-check-input" type="checkbox" name="dias[]" value="Miercoles" <?php if(in_array("Miercoles", $disponibilidad)){echo 'checked="checked"';} ?>> Miercoles<br>
            <input class="form-check-input" type="checkbox" name="dias[]" value="Jueves" <?php if(in_array("Jueves", $disponibilidad)){echo 'checked="checked"';} ?>> Jueves<br>
            <input class="form-check-input" type="checkbox" name="dias[]" value="Viernes" <?php if(in_array("Viernes", $disponibilidad)){echo 'checked="checked"';} ?>> Viernes<br>
            <input class="form-check-input" type="checkbox" name="dias[]" value="Sabado" <?php if(in_array("Sabado", $disponibilidad)){echo 'checked="checked"';} ?>> Sabado<br>
            <input class="form-check-input" type="checkbox" name="dias[]" value="Domingo" <?php if(in_array("Domingo", $disponibilidad)){echo 'checked="checked"';} ?>> Domingo<br><br>

            <input class="w-100 btn btn-lg btn-primary" type="submit" value="Actualizar">
        </div>
    </form>

<?php
include("footer.php")
?>