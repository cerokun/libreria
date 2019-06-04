<?php

$subtotal = 0;
$descuentos = 0;
$impuestos = 0;

?>

<div class="container-fluid text-center" id="contenedor">

    <div class="row">
        <div class="col-4">
            <p class="font-weight-bold"> Direccion de facturación </p>
            <hr style="width: 100%; background-color: blue; height: 3px; border-color : transparent;">
            <?php
            extract($usuario);
            ?>

            <p> <i class="far fa-user"></i> <?= $apellidos ?>,<?= $nombre ?> </p>
            <p> <i class="fas fa-at"></i> <?= $correo ?> </p>
            <p> <i class="fas fa-map-marked-alt"></i> <?= $direccion ?></p>
            <p> <i class="fas fa-city"></i> Huelva <?= $codigoPostal ?>, España </p>
            <br>
            <?php ?>
        </div>
        <div class="col-4">
            <p class="font-weight-bold"> Metodo de pago Bancaria/Paypal</p>
            <hr style="width: 100%; background-color: orange; height: 3px; border-color : transparent;">
            <img src="<?= base_url()  . "assets/img/pagina/modalidadPago.png" ?>" width="100%">
        </div>
        <div class="col-4">
            <p class="font-weight-bold"> Dirección de envio</p>
            <hr style="width: 100%; background-color: green; height: 3px; border-color : transparent;">

        </div>
    </div>

    <div class="row">
        <div class="col-9">

            <p class="font-weight-bold"> Lista de productos</p>
            <hr>
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th> Imagen </th>
                        <th> Producto </th>
                        <th> Precio </th>
                        <th> Cantidad </th>
                        <th> Iva </th>
                        <th> Importe iva </th>
                        <th> Descuento </th>
                        <th> Total </th>
                        <th> Eliminar </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Recorro los libros almacenados en el carrito -->
                    <?php foreach ($libros as $key => $value) : ?>

                        <?php
                        $subtotal +=  $value[0]["cantidad"] * $value[0]["precio"];
                        $importeIva = ($value[0]["precio"] * $value[0]["iva"]) / 100;
                        $impuestos += $importeIva;
                        $descuentos += $value[0]["descuento"];

                        ?>
                        <tr>
                            <td> <img src="<?= base_url()  . "assets/img/libros/" .  $value[0]["imagen"] ?>" width="50px"> </td>
                            <td> <?= $value[0]["nombre"] ?> </td>
                            <td> <?= $value[0]["precio"] ?> € </td>
                            <td> <?= $value[0]["cantidad"] ?> </td>
                            <td> <?= $value[0]["iva"]  ?> % </td>
                            <td> <?= $importeIva  ?> € </td>
                            <td> <?= $value[0]["descuento"] ?> % </td>
                            <td> <?= $value[0]["cantidad"] * $value[0]["precio"] ?> € </td>
                            <td class="eliminaEsteProductoDelCarrito" id="<?= $value[0]["idProducto"] ?>"> <i class="fas fa-trash-alt" style="color:red"></i> </td>
                        <tr>

                            <?php
                            $importeIva = 0;
                            ?>

                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-3">
            <p class="font-weight-bold"> Resumen del pedido </p>
            <hr style="width: 100%; background-color: red; height: 3px; border-color : transparent;">

            <p> Subtotal de productos: <?= $subtotal ?> € </p>
            <p> Total antes de impuestos: <?= $subtotal ?> € </p>
            <p> Impuestos: <?= $impuestos ?> € </p>
            <p> total más iva: <?= $subtotal + $impuestos ?> </p>
            <p> Decuentos: <?= $descuentos ?> € </p>
            <p> Todal antes de descuentos <?= $subtotal + $impuestos ?> </p>
            <p> Total menos decuentos: <?= ($subtotal + $impuestos) - $descuentos ?> € </p>
            <br><br><br><br><br><br><br><br><br><br><br><br><br>
            <h3 style="color:darkgray" class="font-weight-bold"> Total a pagar </h3>
            <hr style="width: 100%; background-color: violet; height: 3px; border-color : transparent;">
            <hr style="width: 100%; background-color: violet; height: 3px; border-color : transparent;">

            <h2 style="color:deeppink" class="font-weight-bold"> <?= ($subtotal + $impuestos) - $descuentos ?> € </h2>

            <a href="<?= site_url("Pedidos_C/nuevo") ?>"> <img src="<?= base_url() . 'assets/img/pagina/paypal.png' ?>" width="60%"> </a>

        </div>

    </div>


</div>