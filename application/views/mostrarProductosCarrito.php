
<?php
echo "<pre>";
print_r( $this->session->userdata("carrito") );
echo "</pre>";
?>

<div class="container text-center" id="contenedor">
    <!-- Compruebo si hay libros en el carrito -->
    <?php if ($libros) : ?>

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
                <!-- Recorro los libros almacenados en el carrito -->
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

        <button id="vaciarCarrito" type="button" class="btn btn-danger"> <i class="fas fa-trash"></i> Quiero Vaciar carrito </button>

        <!-- Compruebo si el usuario se ha logeado -->
        <?php if ($this->session->has_userdata('usuario')) : ?>
            <a class="btn btn-success" href="<?= site_url("Resumen/pedido") ?>"> <i class="fas fa-cart-arrow-down"></i> Tramitar pedido </a>
        <?php else : ?>
            <a class="btn btn-success" href="<?= site_url("ComprobarLogin/mostrarFormulario") ?>"> <i class="fas fa-shopping-cart"></i> Tramitar pedido </a>
        <?php endif; ?>

    <?php else : ?>
        <!-- Final if principal, comprueba si hay algo en el carrito -->

        <div class="alert alert-danger text-center">
            <p class="text-center"> <strong> <i class="fas fa-exclamation-triangle"></i> ¡Atenciòn! </strong> el carrito esta vacio. </p>
        </div>

    <?php endif; ?>


</div>