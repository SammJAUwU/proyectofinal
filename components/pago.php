<?php
// Esto es para que cargue las rutas del nav antes de abrir la pagina
$ruta = '../';
session_start();
require "conexion.php";
$conexion = conexion();
require "buscarProducto.php";

// Obtener el ID del usuario
$user = $_SESSION["usuario"];
$queryCarrito = "SELECT * FROM usuarios WHERE usuario = '$user'";
$sqlCarrito = mysqli_query($conexion, $queryCarrito);
$fetchCarrito = mysqli_fetch_assoc($sqlCarrito);
$idUsuario = $fetchCarrito["id"];
$domicilioUsuario = $fetchCarrito["direccion"];

$sqLin = "SELECT * FROM carrito WHERE id_usuario = '$idUsuario'";
$sqLito = mysqli_query($conexion, $sqLin);

$total = 0;
$totalProductos = 0;

?>

<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="<?php echo $ruta . 'css/formularioPago.css'; ?>">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    <?php
    require($ruta . 'layouts/nav.php');

    if (isset($_SESSION["usuario"]) && mysqli_num_rows($sqLito) > 0) {
    ?>
        <form method="post" action="factura.php">
            <section class="h-100 gradient-custom">
                <div class="container py-5">
                    <div class="row d-flex justify-content-center my-4">
                        <div class="col-md-8">
                            <div class="card mb-4" style="background-color: #171717; color: rgb(51, 255, 0); border-radius: .5rem; border-color:rgb(51, 255, 0)">
                                <div class="card-header py-3">
                                    <h3 class="mb-0">Formulario de pago</h3>
                                </div>
                                <div class="mx-4 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold" style="background-color: rgb(51, 255, 0);">Domicilio</span>
                                        <input type="text" aria-label="domicilio" class="form-control" value="<?php echo $domicilioUsuario; ?>" name="domicilio" required>
                                    </div>
                                </div>
                                <div class="mx-4 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold" style="background-color: rgb(51, 255, 0);">Nombre</span>
                                        <input type="text" aria-label="nombreCliente" class="form-control" name="nombreCliente" placeholder="Nombre completo del cliente" required>
                                    </div>
                                </div>
                                <div class="card mx-4">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                            <div class="card-header p-0" id="headingTwo">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-light btn-block text-left collapsed p-3 rounded-0 border-bottom-custom w-100" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span>Paypal</span>
                                                            <img src="https://i.imgur.com/7kQEsHU.png" width="30">
                                                        </div>
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <input type="text" class="form-control" placeholder="Paypal email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header p-0">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-light btn-block text-left p-3 rounded-0 w-100" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span>Tarjeta de credito / debito</span>
                                                            <div class="icons">
                                                                <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                                                <img src="https://i.imgur.com/W1vtnOV.png" width="30">
                                                                <img src="https://i.imgur.com/35tC99g.png" width="30">
                                                                <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                                            </div>
                                                        </div>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body payment-card-body">
                                                    <span class="font-weight-normal card-text">Número de tarjeta</span>
                                                    <div class="input">
                                                        <i class="fa fa-credit-card"></i>
                                                        <input type="text" class="form-control" placeholder="0000 0000 0000 0000" inputmode="numeric" onchange="formatCreditCardNumber(this)">
                                                    </div>
                                                    <div class="row mt-3 mb-3">
                                                        <div class="col-md-6">
                                                            <span class="font-weight-normal card-text">Fecha de vencimiento</span>
                                                            <div class="input">
                                                                <i class="fa fa-calendar"></i>
                                                                <input type="text" class="form-control" placeholder="MM/AA">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span class="font-weight-normal card-text">CVC/CVV</span>
                                                            <div class="input">
                                                                <i class="fa fa-lock"></i>
                                                                <input type="text" class="form-control" placeholder="000">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="text-muted certificate-text"><i class="fa fa-lock"></i> Tu pago es seguro con nuestro certificado SSL</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <?php
                                    if (mysqli_num_rows($sqLito) > 0) {
                                        while ($sqlfetch = mysqli_fetch_assoc($sqLito)) {
                                            $idProducto = $sqlfetch["id_producto"];
                                            $precioTotal = $sqlfetch["total_producto"];
                                            $cantidad = $sqlfetch["cantidad"];

                                            $total += $precioTotal;
                                            $totalProductos += $cantidad;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="card mb-4" style="border-color:rgb(51, 255, 0)">
                                <div class="card-body" style="background-color: #171717; color: rgb(51, 255, 0);">
                                    <p class="text-center" style="font-size: 30px;"><strong>Aceptamos</strong></p>
                                    <div class="d-flex justify-content-evenly mb-3">
                                        <img class="me-2" width="75px" src="../assets/pago/visa.svg" alt="Visa" />
                                        <img class="me-2" width="75px" src="../assets/pago/amex.svg" alt="American Express" />
                                        <img class="me-2" width="75px" src="../assets/pago/mastercard.svg" alt="Mastercard" />
                                        <img class="me-2" width="75px" src="../assets/pago/paypal.jpg" alt="PayPal acceptance mark" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4" style="background-color: #171717; color: rgb(51, 255, 0); border-radius: .5rem; border-color:rgb(51, 255, 0)">
                                <div class="card-header py-3">
                                    <h5 class="mb-0">Resumen del pedido</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group ">
                                        <li class=" d-flex justify-content-between align-items-center border-0 px-0 pb-2">
                                            Productos
                                            <span><?php echo $totalProductos; ?></span>
                                        </li>
                                        <li class=" d-flex justify-content-between align-items-center px-0 pb-2">
                                            Envio
                                            <span>Gratis</span>
                                        </li>
                                        <li class=" d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                            <div>
                                                <strong>IVA</strong>
                                            </div>
                                            <?php
                                            $iva = round($total * .16, 2);
                                            ?>
                                            <span><strong>$<?php echo $iva; ?></strong></span>
                                            <input type="hidden" name="iva" value="<?php echo $iva; ?>">
                                        </li>
                                        <li class=" d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                            <div>
                                                <strong>Total</strong>
                                            </div>
                                            <span><strong>$<?php echo $total; ?></strong></span>
                                            <input type="hidden" name="total" value="<?php echo $total; ?>">
                                        </li>
                                    </ul>

                                    <?php
                                    if (mysqli_num_rows($sqLito) > 0) {
                                    ?>
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Pagar ahora
                                        </button>
                                    <?php
                                    } else {
                                    ?>
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" disabled>
                                            Pagar ahora
                                        </button>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    <?php
    } else {
        header("Location: ../index.php");
        exit();
    }
    ?>
    <?php
    require($ruta . 'layouts/footer.php');
    ?>
    <script>
        function formatCreditCardNumber(input) {
            let value = input.value.replace(/\D/g, '');
            let formattedValue = '';
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedValue += ' ';
                }
                formattedValue += value.charAt(i);
            }
            input.value = formattedValue;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="../js/buscarProducto.js"></script>

</body>

</html>