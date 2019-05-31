<div class="container text-center" id="contenedor">
    <!-- Compruebo si hay pedidos  -->
    <?php if ($pedidos) : ?>

        <!-- Si el usuario ha conseguido logearse, muestro el mensaje al usuario. -->

        <div class="alert alert-success text-center" style="display:none" id="mensajePedidoActualizado">
            <p class="text-center"> <strong><i class="fas fa-edit"></i> Acabas de actualizar el estado del pedido seleccionado. </strong> </p>
        </div>

        <div class="alert alert-danger text-center" style="display:none" id="mensajePedidoNoActualizado">
            <p class="text-center"> <strong> <i class="fas fa-exclamation-triangle"></i> Lo sentimos, pero el pedido, no ha podido ser actualizado. </strong> </p>
        </div>

        <h3> Cambiar estado pedidos </h3>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th> IdPedido </th>
                    <th> Fecha </th>
                    <th> Estado actual </th>
                </tr>
            </thead>
            <tbody>
                <!-- Recorro los pedidos almacenados en el carrito -->
                <?php foreach ($pedidos as $pedido) : ?>
                    <tr>
                        <td> <?= $pedido["idPedido"] ?> </td>
                        <td> <?= $pedido["fecha"] ?> </td>

                        <td>

                            <?= crearSelect($pedido["idPedido"], $opciones, $pedido["estado"]) ?>
                        </td>
                    <tr>

                    <?php endforeach; ?>
            </tbody>
        </table>

    <?php else : ?>
        <!-- Final if principal, comprueba si hay algo -->
        <div class="alert alert-danger text-center">
            <p class="text-center"> <strong> <i class="fas fa-exclamation-triangle"></i> ¡Atenciòn! </strong> no hay pedidos </p>
        </div>

    <?php endif; ?>

</div>