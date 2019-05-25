<div class="container text-center" id="contenedor">

    <?php


    $totalLibros = count($libros);
    $mostrarPorFila = 4;
    $mostraPorColumna = 6;
    $contador = 0;



    ?>

    <?php if ($libros) : ?>

        <?php for ($filas = 0; $filas < $mostrarPorFila; $filas++) : ?>

            <div class="row equal">

                <?php for ($columnas = 0; $columnas < $mostraPorColumna; $columnas++) : ?>

                    <?php if ($contador < $totalLibros) : ?>

                        <div class="col-sm-2 d-flex pb-2">
                            <div class="card card-block">
                                <?php
                                $url = "assets/img/libros/";
                                $imagen = $libros[$contador]["imagen"];
                                $compuesto = $url . $imagen;

                                ?>
                                <img class="card-img-top" src="<?= base_url() . $compuesto ?>">
                                <div class="card-body">
                                    <h5 class="card-title"> <?= $libros[$contador]["nombre"] ?> </h5>
                                    <p class="card-text"> <?= substr($libros[$contador]["descripcion"], 0, 55) ?>... </p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"> <?= $libros[$contador]["precio"] ?> €</li>

                                </ul>
                                <div class="card-body">
                                    <a href="#" class="btn btn-primary"> <i class="fas fa-cart-plus"></i> Añadir </a>
                                </div>
                            </div>
                        </div>

                        <?php $contador++; ?>
                        <!-- Incremento el contador -->

                        <!-- Comprueba si el producto es visible -->
                    <?php endif ?>
                    <!-- Final if que comprueba si se ha alcanzado el numero total de productos en tienda. -->


                <?php endfor; ?>
                <!-- Final bucle que recorre las columnas -->

            </div> <!-- Final clase='row' -->

        <?php endfor; ?>
        <!-- Final bucle que recorre las filas -->


    <?php else : ?>

        <div class="alert alert-danger text-center">
            <p class="text-center"> <strong> <i class="fas fa-exclamation-triangle"></i> ¡Atenciòn! </strong> no hay productos que mostrar. </p>
        </div>

    <?php endif; ?>

   <?=  $this->pagination->create_links() ?>;

</div> <!-- Final del contenedor- bdoy -->