<?php
include("header.php");
include("navBar.php");
?>

<div class="wrapper row4">
    <main class="hoc container clear">
        <!-- main body -->
        <div class="content">
            <div class="scrollable">
                <table style="text-align:center;">
                    <tbody>
                    <?php foreach ($listaGuardianes as $guardian) { ?>
                        <tr>
                        <div class="card p-3">
                            <p class="card-text">Nombre: <b><?php echo $guardian->getNombre() . " " . $guardian->getApellido(); ?></b></p>
                            <p class="card-text">Reputacion: <b><?php echo $guardian->getReputacion() . "/5"; ?></b></p>
                            <p class="card-text">Precio por Dia: <b><?php echo "$" . $guardian->getPrecioXDia(); ?></b></p>
                            <p class="card-text">Direccion: <b><?php echo $guardian->getDireccion(); ?></b></p>
                    </div>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- / main body -->
        <div class="clear"></div>
    </main>
</div>

<?php
include("footer.php");
?>
