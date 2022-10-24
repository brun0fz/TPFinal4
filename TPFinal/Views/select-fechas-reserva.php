<div class="container">
    <form action="<?php echo FRONT_ROOT ?>Duenio/FiltrarGuardianes" method="Post">
        <input type="date" name="fechaInicio" id="" min="<?php echo date("Y-m-d") ?>">
        <input type="date" name="fechaFin" id="" min="<?php echo date("Y-m-d") ?>">
        <input type="submit" value="Enviar">
    </form>
</div>