<?php
include("header.php");
?>


<?php var_dump($_SESSION["loggedUser"])->getDisponibilidad(); ?>

    <form action="<?php echo FRONT_ROOT ?>Guardian/setDisponibilidad" method="Post">
        <label for="checkbox">Dias disponibles</label>
        <input type="checkbox" name="dias[]" value="Lunes">Lunes
        <input type="checkbox" name="dias[]" value="Martes">Martes
        <input type="checkbox" name="dias[]" value="Miercoles">Miercoles
        <input type="checkbox" name="dias[]" value="Jueves">Jueves
        <input type="checkbox" name="dias[]" value="Viernes">Viernes
        <input type="checkbox" name="dias[]" value="Sabado">Sabado
        <input type="checkbox" name="dias[]" value="Domingo">Domingo


        <input type="submit" value="OK">
    </form>


<?php
include("footer.php")
?>