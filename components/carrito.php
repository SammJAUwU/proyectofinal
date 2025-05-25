<?php
// Esto es para que cargue las rutas del nav antes de abrir la pagina
$ruta = '../';
session_start();
require "conexion.php";
$conexion = conexion();
require "buscarProducto.php";
// Obtener el ID del usuario
if (!isset($_SESSION["usuario"])) {
    header("Location: Perfil.php");
    exit();
} else {
    $user = $_SESSION["usuario"];
}

$queryCarrito = "SELECT id FROM usuarios WHERE usuario = '$user'";
$sqlCarrito = mysqli_query($conexion, $queryCarrito);
$idUsuario = mysqli_fetch_assoc($sqlCarrito)["id"];

$sqLin = "SELECT * FROM carrito WHERE id_usuario = '$idUsuario'";
$sqLito = mysqli_query($conexion, $sqLin);

$total = 0;
$totalProductos = 0;

// Función para eliminar un producto del carrito
if (isset($_POST['eliminar_producto'])) {
    $idProducto = $_POST['id_producto'];
    $queryEliminar = "DELETE FROM carrito WHERE id_usuario = '$idUsuario' AND id_producto = '$idProducto'";
    $resultadoEliminar = mysqli_query($conexion, $queryEliminar);
}

if (isset($_POST["restarP"]) || isset($_POST["sumarP"])) {
    $idProducto = $_POST["id_producto"];

    if (isset($_POST["restarP"])) {
        $newCant = $_POST["cantidadP"] - 1;
    } elseif (isset($_POST["sumarP"])) {
        $newCant = $_POST["cantidadP"] + 1;
    }

    if ($newCant > 0) {
        $newPrecio = $newCant * $_POST["precioP"];
        $queryActualizar = "UPDATE carrito SET cantidad = '$newCant', total_producto = '$newPrecio' WHERE id_producto = '$idProducto' AND id_usuario = '$idUsuario'";
        $resultadoActualizar = mysqli_query($conexion, $queryActualizar);
    } else {
        $queryActualizar = "DELETE FROM carrito WHERE id_usuario = '$idUsuario' AND id_producto = '$idProducto'";
        $resultadoActualizar = mysqli_query($conexion, $queryActualizar);
    }

    if ($resultadoActualizar) {
        header("Location: carrito.php");
        exit();
    }
}

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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    <?php
    require($ruta . 'layouts/nav.php');

    if (isset($_SESSION["usuario"])) {
    ?>
        <section class="h-100 gradient-custom">
            <div class="container py-5">
                <div class="row d-flex justify-content-center my-4">
                    <div class="col-md-8">
                        <div class="card mb-4" style="background-color: #171717; color: rgb(51, 255, 0); border-radius: .5rem; border-color:rgb(51, 255, 0)">
                            <div class="card-header py-3">
                                <h3 class="mb-0">Carrito de Compras</h3>
                            </div>
                            <div class="card-body">
                                <?php
                                if (mysqli_num_rows($sqLito) > 0) {
                                    while ($sqlfetch = mysqli_fetch_assoc($sqLito)) {
                                        $idProducto = $sqlfetch["id_producto"];
                                        $precio = $sqlfetch["precio_producto"];
                                        $precioTotal = $sqlfetch["total_producto"];
                                        $cantidad = $sqlfetch["cantidad"];

                                        $total += $precioTotal;
                                        $totalProductos += $cantidad;

                                        $query_producto = "SELECT * FROM productos WHERE id_producto = '$idProducto'";
                                        $query_encuerado = mysqli_query($conexion, $query_producto);
                                        $query_enbolas = mysqli_fetch_assoc($query_encuerado);
                                        $nombreProducto = $query_enbolas["nombre_producto"];
                                        $imagenProducto = $query_enbolas["imagen"];
                                        $categoriaProducto = $query_enbolas["categoria"];

                                ?>
                                        <!-- Single item -->
                                        <div class="row">
                                            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                                <!-- Image -->
                                                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light" style="background-color: white;">
                                                    <form action="mostrarProducto.php" method="get">
                                                        <input type="hidden" value="<?php echo $nombreProducto; ?>" name="searchP">
                                                        <button type="submit" style="border: none; background-color: transparent;">
                                                            <img src="<?php echo $ruta . $imagenProducto; ?>" class="w-100" />
                                                        </button>
                                                    </form>
                                                    <a href="#!">
                                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                                    </a>
                                                </div>
                                                <!-- Image -->
                                            </div>

                                            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                                <!-- Data -->
                                                <p><strong><?php echo $nombreProducto; ?></strong></p>
                                                <p><?php echo ucfirst(strtolower($categoriaProducto)); ?></p>
                                                <p>$<?php echo $precio; ?></p>
                                                <!-- Formulario para eliminar el producto -->
                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                    <input type="hidden" name="id_producto" value="<?php echo $idProducto; ?>">
                                                    <button type="submit" name="eliminar_producto" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Eliminar producto">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                <!-- Formulario para eliminar el producto -->
                                            </div>

                                            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                                <!-- Quantity -->
                                                <div class="d-flex align-items-center mb-4" style="max-width: 300px">
                                                    <form method="post">
                                                        <input type="hidden" name="id_producto" value="<?php echo $idProducto; ?>">
                                                        <input type="hidden" name="cantidadP" value="<?php echo $cantidad; ?>">
                                                        <input type="hidden" name="precioP" value="<?php echo $precio; ?>">
                                                        <button class="btn btn-primary px-3 me-2" style="height: 100%; font-size: inherit" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" type="submit" name="restarP">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </form>
                                                    <div class="form-outline flex-grow-1">
                                                        <input id="form1" min="1" name="quantity" value="<?php echo $cantidad; ?>" type="number" class="form-control" style="height: 100%" disabled>
                                                    </div>
                                                    <form method="post">
                                                        <input type="hidden" name="id_producto" value="<?php echo $idProducto; ?>">
                                                        <input type="hidden" name="cantidadP" value="<?php echo $cantidad; ?>">
                                                        <input type="hidden" name="precioP" value="<?php echo $precio; ?>">
                                                        <button class="btn btn-primary px-3 ms-2" style="height: 100%; font-size: inherit" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" type="submit" name="sumarP">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <!-- Quantity -->


                                                <!-- Price -->
                                                <p class="fs-5 text-start text-md-center mt-5">
                                                    <strong>Total: $<?php echo $precioTotal; ?></strong>
                                                </p>
                                            </div>


                                        </div>
                                        <!-- Single item -->

                                        <hr class="my-4" />

                                    <?php
                                    }
                                } else {
                                    ?> <h4 style="color: white;">Aún no tienes productos</h4> <?php
                                                                                            }
                                                                                                ?>

                                <!-- Single item -->
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
                                        <span><strong>$<?php echo round($total * .16, 2); ?></strong></span>
                                    </li>
                                    <li class=" d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div>
                                            <strong>Total</strong>
                                        </div>
                                        <span><strong>$<?php echo $total; ?></strong></span>
                                    </li>
                                </ul>
                                <form action="pago.php">
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    } else {
        header("Location: Perfil.php");
        exit();
    }
    ?>
    <?php
    require($ruta . 'layouts/footer.php');
    ?>
    <!-- Modal -->
    <div class="modal fade" id="customAlertModal" tabindex="-1" aria-labelledby="customAlertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customAlertModalLabel">Información del producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="recargarPagina()"></button>
                </div>
                <div class="modal-body">
                    <p id="customAlertMessage">Este es un mensaje de alerta personalizado.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="recargarPagina()">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        <?php if ($resultadoEliminar) : ?>
            document.getElementById("customAlertMessage").innerText = "Se ha eliminado el producto del carrito";
            document.addEventListener('DOMContentLoaded', function() {
                var customAlertModal = new bootstrap.Modal(document.getElementById('customAlertModal'));
                customAlertModal.show();
            });
        <?php else : ?>
            document.getElementById("customAlertMessage").innerText = "Error al eliminar producto";
            document.addEventListener('DOMContentLoaded', function() {
                var customAlertModal = new bootstrap.Modal(document.getElementById('customAlertModal'));
                customAlertModal.show();
            });
        <?php endif; ?>
    </script>
    <script>
        function recargarPagina() {
            window.location.href = "carrito.php";
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="../js/buscarProducto.js"></script>
</body>

</html>