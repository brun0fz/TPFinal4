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
                    <thead>
                    <tr>
                        <th style="width: 15%;">Nombre</th>
                        <th style="width: 15%;">Reputacion</th>
                        <th style="width: 15%;">Precio por dia</th>
                        <th style="width: 15%;">Direccion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($listaGuardianes as $guardian) { ?>
                        <tr>
                            <td><?php echo $guardian->getNombre() . " " . $guardian->getApellido(); ?></td>
                            <td><?php echo $guardian->getReputacion() . "/5"; ?></td>
                            <td><?php echo "$" . $guardian->getPrecioXDia(); ?></td>
                            <td><?php echo $guardian->getDireccion(); ?></td>
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
