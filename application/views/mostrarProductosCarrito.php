<div class="container text-center" id="contenedor">

    <?php if ( $libros) : ?>

        <h3> Artículos en el carrito </h3>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th> Imagen </th>
                    <th> Producto </th>
                    <th> Precio </th>
                    <th> Cantidad </th>
                    <th> Total </th>
                    <th> Eliminar </th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($libros as $key => $value) : ?>
                    <tr>
                        <td> <img src="<?= base_url()  . "assets/img/libros/" .  $value[0]["imagen"] ?>" width="50px"> </td>
                        <td> <?= $value[0]["nombre"] ?> </td>
                        <td> <?= $value[0]["precio"] ?> </td>
                        <td> <?= $value[0]["cantidad"] ?> </td>
                        <td> <?= $value[0]["cantidad"] * $value[0]["precio"] ?> € </td>
                        <td class="eliminaEsteProductoDelCarrito" id="<?= $value[0]["idProducto"] ?>"> <i class="fas fa-trash-alt" style="color:red"></i> </td>
                    <tr>

                    <?php endforeach; ?>
            </tbody>
        </table>

        <button id="vaciarCarrito" class="btn btn-outline-danger"> Quiero vaciar el carrito </button>

    <?php else : ?>

        <div class="alert alert-danger text-center">
            <p class="text-center"> <strong> <i class="fas fa-exclamation-triangle"></i> ¡Atenciòn! </strong> el carrito esta vacio. </p>
        </div>

    <?php endif; ?>
 

</div>