<?php

$subtotal = 0;
$descuentos = 0;
$impuestos = 0;

?>

<style>
    body {
        background-image: url("<?= base_url()  . "assets/img/pagina/cabeceraPago.png" ?>");
        background-repeat: no-repeat;
    }
</style>

<div class="container-fluid text-center" id="contenedor">

    <div class="row">

        <div class="col-4" id="direccionFacturacion">
            <p class="titulo"> Direccion de facturación </p>
            <hr>
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
        <div class="col-4" id="modoDePago">
            <p class="titulo"> Metodo de pago </p>
            <hr>
            <img src="<?= base_url()  . "assets/img/pagina/modalidadPago.png" ?>">
        </div>
        <div class="col-4" id="direccionEnvio">
            <p class="titulo"> Dirección de envio</p>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-9" id="listaProductos">

            <p class="titulo"> Lista de productos</p>
            <hr>
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th> Imagen </th>
                        <th> Producto </th>
                        <th> Precio unitario </th>
                        <th> Cantidad </th>
                        <th> Descuento % </th>
                        <th> Iva </th>
                        <th> Importe iva </th>
                        <th> Total </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Recorro los libros almacenados en el carrito -->
                    <?php foreach ($libros as $key => $value) : ?>

                        <?php
                        $importeIva = (($value[0]["precio"] * $value[0]["cantidad"]) * $value[0]["iva"]) / 100;
                        $subtotal +=  $value[0]["cantidad"] * $value[0]["precio"];
                        $descuentoLinea = (($value[0]["cantidad"] * $value[0]["precio"]) *  $value[0]["descuento"])  / 100;
                        $descuentos += $descuentoLinea;
                        $impuestos += $importeIva;

                        ?>
                        <tr>
                            <td> <img src="<?= base_url()  . "assets/img/libros/" .  $value[0]["imagen"] ?>" width="50px"> </td>
                            <td> <?= $value[0]["nombre"] ?> </td>
                            <td> <?= $value[0]["precio"] ?> € </td>
                            <td> <?= $value[0]["cantidad"] ?> </td>
                            <td> <?= $value[0]["descuento"] ?> % </td>
                            <td> <?= $value[0]["iva"]  ?> % </td>
                            <td id="importeIva"> <?= $importeIva  ?> € </td>
                            <td> <?= $value[0]["cantidad"] * $value[0]["precio"] ?> € </td>
                        <tr>

                            <?php $importeIva = 0; ?>

                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-3" id="resumenPedido">
            <p class="titulo"> Resumen del pedido </p>
            <hr>

            <p style="color:seagreen"> <strong> Subtotal: <?= $subtotal - $impuestos ?> € </strong> </p> 
            <p style="color:red"> <strong> Importe IVA: +<?= $impuestos ?> € </strong> </p>
            <br><br><br><br><br><br><br><br><br><br><br><br><br>
            <h3 id="totalAPagar"> Total a pagar </h3>
            <hr>
            <hr>

            <h2 style="color:deeppink" class="font-weight-bold"> <?= $subtotal   ?> € </h2>

            <a href="<?= site_url("Pedidos_C/nuevo") ?>"> <img src="<?= base_url() . 'assets/img/pagina/paypal.png' ?>" width="60%"> </a>

        </div>

    </div>


</div>