<div class="container text-center" id="contenedor">
    <!-- Compruebo si hay pedidos  -->
    <?php if ($pedidos) : ?>

        <h3> Pedidos realizados </h3>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th> IdPedido </th>
                    <th> Fecha </th>
                    <th> Estado </th>
                    <th> Acciones </th>
                </tr>
            </thead>
            <tbody>
                <!-- Recorro los pedidos almacenados en el carrito -->
                <?php foreach ($pedidos as $pedido) : ?>
                    <tr>

                        <td> <?= $pedido["idPedido"] ?> </td>
                        <td> <?= $pedido["fecha"] ?> </td>
                        <td> <?= $pedido["estado"] ?> </td>
                        <td>
                            <a href="<?= site_url("Pedidos_C/ver/" . $pedido["idPedido"]) ?>"> <img src="<?= base_url() . 'assets/img/pagina/ver.jpg' ?>" width="30px;" title="Ver"></a>
                            <a href="<?= site_url("") ?>"> <img src="<?= base_url() . 'assets/img/pagina/factura.png' ?>" width="30px;" title="Factura"></a>

                            <!-- Compruebo si el usuario se ha logeado -->
                            <?php if ($pedido["estado"]) : ?>
                                <a href="<?= site_url("") ?>"> <img src="<?= base_url() . 'assets/img/pagina/cancelar.png' ?>" width="30px;" title="Cancelar"></a>
                            <?php else : ?>
                                <img src="<?= base_url() . 'assets/img/pagina/cancelarDehabilitado.png' ?>" width="30px;" title="No se puede cancelar">
                            <?php endif; ?>

                        </td>
                    <tr>

                    <?php endforeach; ?>
            </tbody>
        </table>

    <?php else : ?>
        <!-- Final if principal, comprueba si hay algo -->
        <div class="alert alert-danger text-center">
            <p class="text-center"> <strong> <i class="fas fa-exclamation-triangle"></i> ¡Atenciòn! </strong> no has realizado ningun pedido. </p>
        </div>

    <?php endif; ?>


</div>