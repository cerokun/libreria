<div class="container text-center" id="contenedor">

    <img src="<?= base_url()  . "assets/img/pagina/excel.png" ?>" width="250px">
    <h3> Exportar a excel </h3>

    <a class="btn btn-outline-secondary" href="<?= site_url("Excel/exportarProductos") ?>"> Exportar productos </a>
    <a class="btn btn-outline-secondary" href="<?= site_url("Excel/exportarCategorias") ?>"> Exportar categorias </a>
    <a class="btn btn-outline-secondary" href="<?= site_url("Excel/exportarPedidos") ?>"> Exportar pedidos </a>

</div>