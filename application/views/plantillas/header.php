  <?php


   // Set the super object to a local variable for use later
    $CI = &get_instance();
    // Load the Sessions class
    $CI->load->helper('geolocalizacion');

    if (extension_loaded('soap')) {
        $soapDisponible = true;
        $respuesta = dameCiudadDesdeLaQueMeConecto();
        $ip = $respuesta["ipAddress"];
    } else {
        $soapDisponible = false;
    }
    ?>
 


  <!DOCTYPE html>
  <html lang="en">

  <head>

      <title> Libreria </title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Boostrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

      <!-- Mis estilos -->
      <link rel="stylesheet" href="<?= base_url() . 'assets/css/header.css' ?>" />
      <link rel="stylesheet" href="<?= base_url() . 'assets/css/nav.css' ?>" />
      <link rel="stylesheet" href="<?= base_url() . 'assets/css/general.css' ?>" />
      <link rel="stylesheet" href="<?= base_url() . 'assets/css/footer.css' ?>" />


      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

      <!-- Popper JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

      <!-- Boostrap js -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>



      <!--  Mi base y site url -->
      <script>
          // Obtengo la url en la que nos encontramos.
          var site_url = '<?= base_url() ?>' + "index.php/";
          var base_url = '<?= base_url() ?>';
      </script>

      <!-- Mis ficheros javascript -->
      <script src="<?= base_url() . 'assets/js/main.js' ?>"></script>

  </head>

  <body>

      <header>
          <!-- Imagen cabecera -->
          <img id="cabecera" src="<?= base_url() . 'assets/img/pagina/cabecera.jpg' ?>">

          <?php if ($this->session->has_userdata('usuario')) :
                $usuario = $this->session->userdata("usuario");
                ?>
              <h4 id="nombre"> ¡Bienvenido <?= $usuario["nombre"] ?>! </h4>

              <!-- Tipo de usuario -->
              <h3 id="tipo"> Tipo de usuario: <?= ucfirst($usuario["tipo"]) ?> </h3>
              <!-- Compruebo si esta disponible el servicio SOAP -->
              <?php if ( $soapDisponible) : ?>
                  <img id="estoyAquiSoap" src="<?= base_url() . 'assets/img/pagina/ustedestaaqui.png' ?>" width="5%">
                  <h3 id="localizacionSoap"> <?= $respuesta["ciudad"];  ?> </h3>
              <?php else : ?>
                  <img id="advertenciaSoap" src="<?= base_url() . 'assets/img/pagina/advertencia.png' ?>" width="50px">
                  <h4 id="mensajeSoap"> Servicio deshabilitado</h4>
                  <!-- Ciudad desde donde se conecta, servicio Soap -->
                  <img id="logoSoap" src="<?= base_url() . 'assets/img/pagina/soap.png' ?>">
              <?php endif; ?>

              <!-- Boton para cerrar la sesion -->
              <a href="<?= site_url('Principal/cerrarSesion') ?>"> <img src="<?= base_url() . 'assets/img/pagina/cerrarSesion.png' ?>" id="cerrarSesion"> </a>
          <?php else : ?>
              <!-- Boton para identificarse como usuario -->
              <a href="<?= site_url('ComprobarLogin/mostrarFormulario') ?>"> <img src="<?= base_url() . 'assets/img/pagina/identificate.png' ?>" id="identificate"> </a>
          <?php endif; ?>

          <div class="input-group col-md-5 mx-auto" id="buscador">
              <!-- Las categorias -->
              <select class="btn btn-primary" id="categorias">
                  <option disabled selected> Categorias </option>

                  <?php foreach ($categorias as $fila) : ?>
                      <option value="<?= $fila["idCategoria"] ?>"> <?= $fila["nombre"] ?> </option>
                  <?php endforeach ?>

              </select>
              <!-- Buscador -->
              <input class="form-control py-2" type="search" placeholder="Busca por nombre, ISBN, categoría…" id="buscar">
              <span class="input-group-append">
                  <button type="button" class="btn btn-success"> Buscar </button>
              </span>
          </div>
      </header>