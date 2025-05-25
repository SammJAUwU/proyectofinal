<?php
// Esto es para que cargue las rutas del nav antes de abrir la pagina
$ruta = '../';
session_start();
require "conexion.php";
$conexion = conexion();
require "buscarProducto.php";

// Obtener el ID del usuario
$user = $_SESSION["usuario"];
$queryCarrito = "SELECT id FROM usuarios WHERE usuario = '$user'";
$sqlCarrito = mysqli_query($conexion, $queryCarrito);
$idUsuario = mysqli_fetch_assoc($sqlCarrito)["id"];

$sqLin = "SELECT * FROM carrito WHERE id_usuario = '$idUsuario'";
$sqLito = mysqli_query($conexion, $sqLin);

if (isset($_GET["pedido"])) {
    $_SESSION["pedido"] = $_GET["pedido"];
    $idPedido = $_SESSION["pedido"];
} else {
    header("Location: Perfil.php");
    exit();
}

$traerCompras = "SELECT * FROM factura JOIN pedidos ON factura.id_pedido = pedidos.id_pedido join productos ON pedidos.id_producto = productos.id_producto WHERE factura.id_pedido = '$idPedido';";
$ejectCompras = mysqli_query($conexion, $traerCompras);
$ejectDatos = mysqli_query($conexion, $traerCompras);

if (isset($_SESSION["usuario"]) || !isset($_SESSION["pedido"])) {

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
        ?>

        <section class="h-100 gradient-custom">
            <div class="container py-5">
                <div class="row d-flex justify-content-center my-4">
                    <div class="col-md-12">
                        <div class="card mb-4" style="background-color: #171717; color: rgb(51, 255, 0); border-radius: .5rem; border-color:rgb(51, 255, 0)">
                            <div class="card-header py-3">
                                <h3 class="mb-0">Resumen del pedido</h3>
                                <?php
                                $datos = mysqli_fetch_assoc($ejectDatos);
                                $domicilio = $datos["domiclio"];
                                $numPedido = $datos["id_pedido"];
                                $fechaPedido = $datos["fecha"];
                                $nombrePedido = $datos["nombre_cliente"];
                                $iva = $datos["iva"];
                                $totalPedido = $datos["total"];
                                $rutaPedido = $datos["ruta_factura"];
                                ?>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <p class="fw-bold" style="color: rgb(51, 255, 0); font-size: 22px;">Numero pedido: <span class="fw-normal text-white"><?php echo $numPedido; ?></span></p>
                                        <p class="fw-bold" style="color: rgb(51, 255, 0); font-size: 22px;">Nombre Cliente: <span class="fw-normal text-white"><?php echo $nombrePedido; ?></span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="fw-bold" style="color: rgb(51, 255, 0); font-size: 22px;">Domiclio: <span class="fw-normal text-white"><?php echo $domicilio; ?></span></p>
                                        <p class="fw-bold" style="color: rgb(51, 255, 0); font-size: 22px;">Fecha: <span class="fw-normal text-white"><?php echo $fechaPedido; ?></span></p>
                                    </div>
                                </div>
                                <hr style="color: rgb(51, 255, 0); margin: 0;">
                            </div>
                            <div class="row p-3">
                                <?php
                                if (mysqli_num_rows($ejectCompras) > 0) {
                                    while ($fetchCompra = mysqli_fetch_assoc($ejectCompras)) {
                                        $nombreProducto = $fetchCompra["nombre_producto"];
                                        $precioProducto = $fetchCompra["precio"];
                                        $cantidadProducto = $fetchCompra["cantidad"];
                                        $totalProducto = $fetchCompra["total_producto"];
                                        $imagenProducto = $fetchCompra["imagen"];
                                ?>
                                        <div class="col-sm-12 col-xl-6">
                                            <div class="row mt-4">
                                                <div class="col-sm col-md-6">
                                                    <form action="mostrarProducto.php" method="get">
                                                        <input type="hidden" name="searchP" value="<?php echo $nombreProducto; ?>">
                                                        <button type="submit" style="background-color: transparent; border: none;">
                                                            <img class="img-fluid" src="<?php echo $ruta . $imagenProducto; ?>" alt="a" style="background-color: white; border-radius: 20px;">
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-sm col-md-6" style="font-size: 22px;">
                                                    <p class="fw-bold" style="color: rgb(51, 255, 0);">Producto: <span class="fw-normal text-white"><?php echo $nombreProducto; ?></span></p>
                                                    <p class="fw-bold" style="color: rgb(51, 255, 0);">Precio: <br><span class="fw-normal text-white">$<?php echo $precioProducto; ?></span></p>
                                                    <p class="fw-bold" style="color: rgb(51, 255, 0);">Cantidad: <span class="fw-normal text-white"><?php echo $cantidadProducto; ?></span></p>
                                                    <p class="fw-bold" style="color: rgb(51, 255, 0);">Total: <span class="fw-normal text-white">$<?php echo $totalProducto; ?></span></p>
                                                </div>
                                            </div>
                                        </div><!-- Pedido -->
                                    <?php
                                    }
                                    ?>
                                    <hr style="color: rgb(51, 255, 0); margin: 0;">
                                    <div class="d-flex mt-3 gap-5 align-items-center">
                                        <p class="fw-bold m-0" style="color: rgb(51, 255, 0); font-size: 22px;">IVA: <span class="fw-normal text-white">$<?php echo $iva; ?></span></p>
                                        <p class="fw-bold m-0" style="color: rgb(51, 255, 0); font-size: 22px;">Total: <span class="fw-normal text-white">$<?php echo $totalPedido; ?></span></p>
                                        <a class="btn" style="background-color: rgb(51, 255, 0); color: #000; font-weight: bold; font-size: 20px;" href="<?php echo $ruta . $rutaPedido; ?>" target="_blank">Ver factura</a>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="card-body">
                                        <h4 style="color: white;">Pedido no disponivle</h4>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <?php
        require($ruta . 'layouts/footer.php');
        ?>

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="../js/buscarProducto.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location: Perfil.php");
    exit();
}
?>