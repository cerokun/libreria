<div class="container text-center" id="contenedor">

    <h3> Productos en el carrito de compra </h3>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th> Imagen </th>
                <th> Producto </th>
                <th> Cantidad </th>
                <th> Precio </th>
                <th> Total </th>
                <th> Eliminar </th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($libros as $key => $value) : ?>
                <tr>
                    <td> <img src="<?= base_url()  . "assets/img/libros/" .  $value[0]["imagen"] ?>" width="50px"> </td>
                    <td> <?= $value[0]["nombre"] ?> </td>
                    <td> <?= $value[0]["cantidad"] ?> </td>
                    <td> <?= $value[0]["precio"] ?> </td>
                    <td> <?= $value[0]["nombre"] ?> </td>
                    <td id="<?= $value[0]["idProducto"] ?>"> <i class="fas fa-trash-alt" style="color:red"></i> </td>
                <tr>

                <?php endforeach; ?>
        </tbody>
    </table>

</div>