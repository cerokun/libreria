<div class="container text-center" id="contenedor">
    <!-- Compruebo si hay libros en el carrito -->
    <?php if ($lineaDePedido) : ?>

        <h3> Linea de pedido </h3>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th> IdProducto </th>
                    <th> Producto </th>
                    <th> Cantidad </th>
                    <th> Total </th>
                </tr>
            </thead>
            <tbody>
                <!-- Recorro los libros almacenados en el carrito -->
                <?php foreach ($lineaDePedido as $value) : ?>
                    <tr>

                        <td> <?= $value["idProducto"] ?> </td>
                        <td> <?= $value["nombre"] ?> </td>
                        <td> <?= $value["cantidad"] ?> </td>
                        <td> <?= $value["precio"]   ?> € </td>

                    <tr>

                    <?php endforeach; ?>
            </tbody>
        </table>

        <a class="btn btn-outline-secondary" href="<?= site_url("Pedidos_C/listar") ?>"> <i class="fas fa-undo"></i> Regresar a listar pedidos </a>


    <?php else : ?>
        <!-- Final if principal, comprueba si hay algo -->
        <div class="alert alert-danger text-center">
            <p class="text-center"> <strong> <i class="fas fa-exclamation-triangle"></i> ¡Atenciòn! </strong> este pedido no tiene productos en su interior. </p>
        </div>

    <?php endif; ?>


</div>