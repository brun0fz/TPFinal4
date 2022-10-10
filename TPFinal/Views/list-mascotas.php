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
                        <th style="width: 15%;">Raza</th>
                        <th style="width: 15%;">Tamaño</th>
                        <th style="width: 15%;">Observaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($mascotasList as $mascota) { ?>
                        <tr>
                            <td><?php echo $mascota->getNombre(); ?></td>
                            <td><?php echo $mascota->getRaza(); ?></td>
                            <td><?php echo $mascota->getTamanio(); ?></td>
                            <td><?php echo $mascota->getObservaciones(); ?></td>
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
