<div class="container text-center" id="contenedor">

    <img src="<?= base_url()  . "assets/img/pagina/xml.png" ?>" width="130px">
    <h3> Importar productos o categorias en xml</h3>

    <?= form_open_multipart('Xml/upload'); ?>

    <input type="file" name="myFile" />
    <button type="submit" class="btn btn-success"> Subir </button>

    <?= form_close() ?>

</div>