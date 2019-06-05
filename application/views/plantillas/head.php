  <!DOCTYPE html>
  <html lang="en">

  <head>

      <title> Libreria </title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Boostrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

      <!-- Popper JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

      <!-- Boostrap js -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

      <script>
          // Obtengo la url en la que nos encontramos.
          var site_url = '<?= base_url() ?>' + "index.php/";
          var base_url = '<?= base_url() ?>';
      </script>

      <!-- Mis ficheros javascript -->
      <script src="<?= base_url() . 'assets/js/main.js' ?>"></script>

      <!-- Mis estilos -->
      <link rel="stylesheet" href="<?= base_url() . 'assets/css/header.css' ?>" />
      <link rel="stylesheet" href="<?= base_url() . 'assets/css/nav.css' ?>" />
      <link rel="stylesheet" href="<?= base_url() . 'assets/css/general.css' ?>" />
      <link rel="stylesheet" href="<?= base_url() . 'assets/css/footer.css' ?>" />
      <link rel="stylesheet" href="<?= base_url() . 'assets/css/pedidos.css' ?>" />
    
  </head>