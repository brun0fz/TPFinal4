<?php
include("header.php");
include("nav-bar.php");
?>

<div class="container">
    <div class="row g-5">
        <h2 id="list-title">Cupón de Pago - Reserva #<?php echo $reserva->getIdReserva() ?></h2><br>

        <!---- Datos Reserva ----------------------------------------------------------------------------------->
        <div class="col-md-5 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Reserva</span>
            </h4>
            <ul class="list-group mb-3" id="listCheckout">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <small class="text-muted">Mascota</small>
                        <h6 class="my-0"><?php echo $mascota->getNombre() ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <small class="text-muted">Guardian</small>
                        <h6 class="my-0"><?php echo $guardian->getNombre() . " " . $guardian->getApellido() ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <small class="text-muted">Fecha de Entrada</small>
                        <h6 class="my-0"><?php echo $reserva->getFechaInicio() ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <small class="text-muted">Fecha de Salida</small>
                        <h6 class="my-0"><?php echo $reserva->getFechaFin() ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <small class="text-muted">Precio Total de la Reserva</small>
                        <h6 class="my-0">$<?php echo $reserva->getPrecioTotal() ?></h6>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <h6 class="my-2 text-primary">Total Cupón de Pago (50%)</h6>
                    <span class="my-2 text-primary">$<?php echo $cupon->getTotal() ?></span>
                </li>
            </ul>
        </div>
        <!---------------------------------------------------------------------------------------------->

        <!-- Form de Pago ------------------------------------------------------------------------------>
        <div class="col-md-7">
            <form action="<?php echo FRONT_ROOT ?>Reserva/PagarCupon" method="Post">
                <h4 class="mb-3">Forma de Pago</h4>
                <div class="my-3">
                    <div class="form-check">
                        <input id="credit" name="metodoPago" type="radio" class="form-check-input" checked required>
                        <label class="form-check-label" for="credit">Tarjeta de Crédito</label>
                    </div>
                    <div class="form-check">
                        <input id="debit" name="metodoPago" type="radio" class="form-check-input" required>
                        <label class="form-check-label" for="debit">Tarjeta de Débito</label>
                    </div>
                </div>
                <div class="row gy-3">
                    <div class="col-md-12">
                        <label for="cc-nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="cc-nombre" required>
                        <small class="text-muted">Nombre como figura en la tarjeta</small>
                    </div>
                    <div class="col-md-12">
                        <label for="cc-numero" class="form-label">Credit card number</label>
                        <input type="text" name="numero" class="form-control" id="cc-numero" pattern="[0-9]{16}" placeholder="xxxx-xxxx-xxxx-xxxx" required>
                    </div>
                    <div class="col-md-3">
                        <label for="cc-vencimiento" class="form-label">Vencimiento</label>
                        <input type="text" name="vencimiento" class="form-control" id="cc-vencimiento" pattern="[0-9]{4}" placeholder="mm/aa" required>
                    </div>
                    <div class="col-md-3">
                        <label for="cc-cvv" class="form-label">CVV</label>
                        <input type="text" name="cvv" class="form-control" id="cc-cvv" pattern="[0-9]{3}" placeholder="xxx" required>
                    </div>
                </div>

                <hr class="my-5">

                <input type="hidden" name="idReserva" value="<?php echo $cupon->getFkIdReserva(); ?>">
                <input type="hidden" name="estado" value="Confirmada">
                <button class="w-100 btn btn-primary btn-lg" type="submit">Pagar Cupón</button>
            </form>
        </div>
    </div>
    <!---------------------------------------------------------------------------------------------->

</div>

<?php
include("footer.php");
?>