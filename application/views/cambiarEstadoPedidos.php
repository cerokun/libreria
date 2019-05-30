<div class="container text-center" id="contenedor">
    <!-- Compruebo si hay pedidos  -->
    <?php if ($pedidos) : ?>

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
                          
                            <?= crearSelect( $pedido["idPedido"] , $opciones, $pedido["estado"]) ?>
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