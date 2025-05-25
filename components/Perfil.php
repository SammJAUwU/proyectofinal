<?php
// Esto es para que cargue las rutas del nav antes de abrir la página
$ruta = '../';

session_start();
require "conexion.php";
$conexion = conexion();
require "buscarProducto.php";

if (!isset($_SESSION['usuario'])) {
  header("Location: crearCuenta.php"); // Redirigir a la página de inicio de sesión si no está autenticado
  exit();
}
$uname = $_SESSION['usuario'];

$queryPerfil = "SELECT * FROM usuarios WHERE usuario='$uname'";
$queryPerfilsi = mysqli_query($conexion, $queryPerfil);

$datosPerfil = mysqli_fetch_assoc($queryPerfilsi);
$_SESSION['direccion'] = $datosPerfil['direccion'];
$_SESSION['telefono'] = $datosPerfil['telefono'];
$_SESSION['email'] = $datosPerfil['email'];

$direccion = $_SESSION['direccion'];
$telefono = $_SESSION['telefono'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil de Usuario</title>
  <link rel="icon" href="<?php echo $ruta . 'assets/Logos/icono1.png'; ?>" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&display=swap">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
  <?php require($ruta . 'layouts/nav.php'); ?>
  <section class="vh-100" style="background-color: black;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-7 mb-4 mb-lg-0">
          <div class="card mb-3" style="border-radius: .5rem; border-color:rgb(51, 255, 0)">
            <div class="row g-0">
              <div class="col-md-4 gradient-custom text-center" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem; color:rgb(51, 255, 0); background-color: black;">
                <img src="../assets/Logos/YAFINAL.png" alt="Avatar" class="img-fluid my-4" style="width: 150px;" />
                <h1><?php echo $uname; ?></h1>
              </div>
              <div class="col-md-8">
                <div class="card-body p-4" style="background-color: #171717; color:rgb(51, 255, 0);">
                  <h6>Información</h6>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>Email</h6>
                      <p style="color:white"><?php echo $email; ?></p>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>Teléfono</h6>
                      <p style="color:white"><?php echo $telefono; ?></p>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>Dirección</h6>
                      <p style="color:white"><?php echo $direccion; ?></p>
                    </div>
                  </div>
                  <div class="d-flex justify-content-start">
                    <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                    <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                    <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  require($ruta . 'layouts/footer.php');
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script src="../js/buscarProducto.js"></script>

</body>

</html>