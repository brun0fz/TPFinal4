<?php
include("header.php");
include("navBar.php");
?>

<div class="container">
    <div class="list-cupon">
        <h2 id="list-title">Cupon de pago</h2><br>
        <table border="1">
            <tr>
                <th>Codigo</th>
                <th>Total</th>
                <th>Alias</th>
            </tr>
            <tr>
                <td><?php echo $cupon->getIdCupon() ?></td>
                <td><?php echo $cupon->getTotal() ?></td>
                <td><?php echo $cupon->getAliasGuardian() ?></td>
            </tr>
        </table>

        <div class="text-end">
            <form action="<?php echo FRONT_ROOT ?>Reserva/cambiarEstado" method="Post">
                <input type="hidden" name="idReserva" value="<?php echo $cupon->getFkIdReserva(); ?>">
                <input type="hidden" name="estado" value="Confirmada">
                <input class="btn btn-lg btn-primary" type="submit" value="Pagar">
            </form>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>