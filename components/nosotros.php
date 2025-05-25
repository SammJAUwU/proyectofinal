<?php
// Esto es para que cargue las rutas del nav antes de abrir la pagina
$ruta = '../';
session_start();
require "conexion.php";
$conexion = conexion();
require "buscarProducto.php";

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TechGaming</title>
  <link rel="icon" href="<?php echo $ruta . 'assets/Logos/icono1.png'; ?>" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&display=swap">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $ruta . 'css/style.css'; ?>">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
  <?php
  require($ruta . 'layouts/nav.php');
  ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm">
        <img class="img-fluid" src="../assets/Poster/Poster1.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        &nbsp;
      </div>
    </div>
    <div class="row text-center mx-3 mt-5 mb-5">
      <div class="col-sm">
        <h2 class="display-1 text-uppercase my-auto" style="color: white; font-size: 28px;">Somos una marca que ofrece perifericos gamer de un alto desempeño, diseño original y sobre todo la mas alta calidad para que puedas sacar tu maximo potencial en cada partida</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <img class="img-fluid" src="../assets/Poster/Poster2.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        &nbsp;
      </div>
    </div>
    <div class="row mx-3 mt-5 mb-5 d-flex align-items-center">
      <div class="col-sm col-md-6 mb-4">
        <h2 class="display-1 text-uppercase my-auto" style="color: white; font-size: 28px;">En Tech Gaming nos preocupamos por cada detalle, así que mires por donde mires nuestros productos, siempre contarán con los mejores acabados</h2>
      </div>
      <div class="col-sm col-md-6 d-flex justify-content-center">
        <img class="img-fluid" src="../assets/Mouse/M8.png" width="600" alt="">
      </div>
    </div>
    <div class="row mx-3 mt-5 mb-5 d-flex align-items-center">
      <div class="col-sm col-md-6 mb-4 d-flex justify-content-center">
        <img class="img-fluid" src="../assets/Teclados/Switch.png" width="600" alt="">
      </div>
      <div class="col-sm col-md-6 mb-4">
        <h2 class="display-1 text-uppercase my-auto" style="color: white; font-size: 28px;">Pero sabemos que no solo importa lo de afuera y por eso cada uno de nuestros productos cuenta con con los mejores componentes </h2>
      </div>
    </div>

    <div class="row">
      <div class="col-sm text-center">
        <h2 class="titulo display-1 text-uppercase my-auto mt-4 mb-4">ES TÚ MEJOR OPCIÓN</h2>
      </div>
    </div>
  </div>

  <?php
  require($ruta . 'layouts/footer.php');
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script src="../js/buscarProducto.js"></script>
</body>

</html>