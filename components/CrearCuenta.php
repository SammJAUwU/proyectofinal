<?php
// Esto es para que cargue las rutas del nav antes de abrir la página
$ruta = '../';
session_start();
require "conexion.php";
$conexion = conexion();
require "buscarProducto.php";

if (isset($_SESSION["usuario"])) {
    header("Location: Perfil.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <link rel="icon" href="<?php echo $ruta . 'assets/Logos/icono1.png'; ?>" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>

    <?php require($ruta . 'layouts/nav.php'); ?>

    <div class="container mt-5">
        <div class="row d-flex justify-content-center align-items-center ">
            <aside class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <section class="gradient-custom">
                    <div class="container py-2 h-90">
                        <div class="card bg-dark border-light text-white" style="border-radius: 1rem; ">
                            <div class="card-body p-3 text-center">
                                <form action="login.php" method="post">

                                    <h2 class="fw-bold mb-4 text-uppercase" style="color:rgb(51, 255, 0);">Login</h2>
                                    <div class="form-outline form-white mb-4">
                                        <?php if (isset($_GET['error'])) { ?>
                                            <p class="error"><?php echo $_GET['error']; ?></p>
                                        <?php } ?>
                                        <input type="text" style="text-align: center;" name="uname" placeholder="Usuario" class="form-control form-control-lg" />
                                        <label class="form-label" for="usuario">Usuario</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" style="text-align: center;" name="password" placeholder="Contraseña" class="form-control form-control-lg" />
                                        <label class="form-label" for="password">Contraseña</label>
                                    </div>

                                    <!-- <p class="small mb-4 pb-lg-2"><a class="text-white-50" href="#!">Olvidaste tu contraseña?</a></p> -->

                                    <button class="btn  btn-lg px-3" type="submit" style="background-color: rgb(51, 255, 0); color: black;">Ingresar</button>
                                </form>

                                <div>
                                    <br>
                                    <p class="mb-0">No tienes cuenta?</p><br>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalRegistro">
                                        Crear cuenta
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="background-color: #202124;">
                                                <form action="registro.php" method="post" onsubmit="return verificarCaptcha();">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel" style="color:rgb(51, 255, 0);">Crear Cuenta</h5>
                                                    </div>
                                                    <div class="modal-body">

                                                        <?php if (isset($_GET['error'])) { ?>
                                                            <p class="error"><?php echo $_GET['error']; ?></p>
                                                        <?php } ?>
                                                        <?php if (isset($_GET['success'])) { ?>
                                                            <p class="success"><?php echo $_GET['success']; ?></p>
                                                        <?php } ?>
                                                        <label for="usuario">Usuario</label>
                                                        <?php if (isset($_GET['uname'])) { ?>
                                                            <input type="text" name="uname" class="form-control input-sm" style="text-align: center;" placeholder="Usuario" value="<?php echo $_GET['uname']; ?>" required><br>
                                                        <?php } else { ?>
                                                            <input type="text" name="uname" class="form-control input-sm" style="text-align: center;" placeholder="Usuario" required><br>
                                                        <?php } ?>
                                                        <label for="password">Contraseña</label>
                                                        <input type="password" name="password" placeholder="Contraseña" class="form-control input-sm" style="text-align: center;" required><br>
                                                        <label for="direccion">Dirección</label>
                                                        <input type="text" name="direccion" placeholder="Dirección" class="form-control input-sm" style="text-align: center;" required><br>
                                                        <label for="telefono">Teléfono</label>
                                                        <input type="tel" name="telefono" placeholder="Teléfono" class="form-control input-sm" style="text-align: center;" required><br>
                                                        <label for="email">Correo Electrónico</label>
                                                        <input type="email" name="email" placeholder="Correo Electrónico" class="form-control input-sm" style="text-align: center;" required><br>
                                                        <div class="d-flex justify-content-center g-recaptcha mb-3" data-sitekey="6Ld5k84pAAAAAC1_0jeBhzy7z7br3-FbpIqQ7yNp">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" data-dismiss="modal" id="crear" style="background-color: rgb(51, 255, 0); color: black;">Crear Cuenta</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="../js/buscarProducto.js"></script>
    <script>
        function verificarCaptcha() {
            var respuestaCaptcha = grecaptcha.getResponse();
            var mensajeError = document.getElementById("mensajeError");
            if (respuestaCaptcha.length == 0) {
                if (!mensajeError) {
                    mensajeError = document.createElement("p");
                    mensajeError.textContent = "Por favor, completa el captcha.";
                    mensajeError.style.color = "red";
                    mensajeError.id = "mensajeError";
                    var captchaDiv = document.querySelector(".g-recaptcha");
                    captchaDiv.parentNode.insertBefore(mensajeError, captchaDiv.nextSibling);
                }
                return false;
            } else {
                if (mensajeError) {
                    mensajeError.parentNode.removeChild(mensajeError);
                }
            }
            return true;
        }
    </script>

    <?php require($ruta .  'layouts/footer.php'); ?>

</body>

</html>