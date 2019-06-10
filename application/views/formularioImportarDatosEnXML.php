<div class="container text-center" id="contenedor">
    <h3> Importar productos o categorias en xml</h3>

    <?= form_open_multipart('ImportarDatosEnXML/upload'); ?>

    <input type="file" name="myFile" />
    <button type="submit" class="btn btn-success"> Subir </button>

    <?= form_close() ?>

</div>