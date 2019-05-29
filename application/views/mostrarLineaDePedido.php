<div class="container text-center" id="contenedor">
    <!-- Compruebo si hay libros en el carrito -->
    <?php if ($lineaDePedido) : ?>

        <h3> Linea de pedido </h3>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th> IdProducto </th>
                    <th> Cantidad </th>
                    <th> Precio </th>
                    <th> Total </th>
                </tr>
            </thead>
            <tbody>
                <!-- Recorro los libros almacenados en el carrito -->
                <?php foreach ($lineaDePedido as $value) : ?>
                    <tr>

                        <td> <?= $value["idProducto"] ?> </td>
                        <td> <?= $value["cantidad"] ?> </td>
                        <td> <?= $value["precio"] ?> </td>
                        <td> <?= $value["precio"] * $value["cantidad"]  ?> € </td>

                    <tr>

                    <?php endforeach; ?>
            </tbody>
        </table>


    <?php endif; ?>


</div>