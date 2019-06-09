<div class="container text-center" id="contenedor">

    <img src="<?= base_url()  . "assets/img/pagina/destacado.png" ?>" width="250px">


    <?php

    $totalLibros = count($libros);
    $mostrarPorFila = 4;
    $mostraPorColumna = 6;
    $contador = 0;


    ?>

    <!-- Final if principal, comprueba si hay algo -->
    <div class="alert alert-danger text-center" style="display:none" id="ventanaAlertCarrito">
        <strong> <i class="fas fa-exclamation-triangle"></i> ¡Atenciòn! </strong>
        <p class="text-center" id="avisoDelCarrito"> </p>
    </div>



    <?php if ($libros) : ?>

        <?php for ($filas = 0; $filas < $mostrarPorFila; $filas++) : ?>

            <div class="row equal">

                <?php for ($columnas = 0; $columnas < $mostraPorColumna; $columnas++) : ?>

                    <?php if ($contador < $totalLibros) : ?>

                        <div class="col-sm-2 d-flex pb-2">
                            <div class="card card-block">


                                <img class="card-img-top" src="<?= base_url() . "assets/img/libros/" . $libros[$contador]["imagen"] ?>" title="Stock: <?= $libros[$contador]["stock"] ?>">


                                <div class="card-body">
                                    <h5 class="card-title"> <?= $libros[$contador]["nombre"] ?> </h5>
                                    <p class="card-text"> <?= substr($libros[$contador]["descripcion"], 0, 55) ?>... </p>
                                </div>
                                <ul class="list-group list-group-flush">

                                    <?php
                                    // Esto es el precio sin descuento y sin iva.
                                    $precio =  $libros[$contador]["precio"];
                                    // Descuento
                                    $descuento = ($precio * $libros[$contador]["descuento"]) / 100;
                                    // Aplico el descuento al precio sin iva.
                                    $precionConDescuento = ($precio - $descuento);
                                    // Calculo el iva.
                                    $impuesto = ($precionConDescuento * $libros[$contador]["iva"]) / 100;
                                    // Aplico el impuesto, iva
                                    $precioFinal = $precionConDescuento + $impuesto;

                                    ?>

                                    <li class="list-group-item">

                                        <?php if ($libros[$contador]["descuento"] == 0) : ?>
                                            <span style="color:blue"><strong> <?= round($precioFinal, 2) ?> € </strong> </span>
                                        <?php else : ?>
                                            <span style="text-decoration: line-through"> <?= $precio ?> € </span>
                                            <span style="color:red"> <?= $libros[$contador]["descuento"] ?> % </span>
                                            <span style="color:blue"><strong> <?= round($precioFinal, 2) ?> € </strong> </span>
                                        <?php endif; ?>

                                    </li>

                                </ul>
                                <div class="card-body">

                                    <?php if ($libros[$contador]["stock"]) : ?>
                                        <button class="btn btn-primary addCarrito" id="<?= $libros[$contador]['idProducto']  ?>"> <i class="fas fa-cart-plus"></i> Añadir </button>
                                    <?php else : ?>
                                        <button disabled class="btn btn-primary"> <i class="fas fa-cart-plus"></i> Añadir </button>
                                    <?php endif; ?>
                                </div>
                            </div>



                        </div>

                        <?php $contador++; ?>
                        <!-- Incremento el contador -->

                        <!-- Final if que comprueba si se ha alcanzado el numero total de productos en tienda. -->
                    <?php endif ?>


                <?php endfor; ?>
                <!-- Final bucle que recorre las columnas -->

            </div> <!-- Final clase='row' -->

        <?php endfor; ?>
        <!-- Final bucle que recorre las filas -->

        <?= $this->pagination->create_links() ?>

    <?php else : ?>

        <div class="alert alert-danger text-center">
            <p class="text-center"> <strong> <i class="fas fa-exclamation-triangle"></i> ¡Atenciòn! </strong> no hay productos que mostrar. </p>
        </div>

    <?php endif; ?>


</div> <!-- Final del contenedor- bdoy -->