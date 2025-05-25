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

$traerCompras = "SELECT * FROM factura WHERE id_usuario = '$idUsuario' ORDER BY id_pedido";
$ejectCompras = mysqli_query($conexion, $traerCompras);

if (isset($_SESSION["usuario"])) {

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
                                <h3 class="mb-0">Historial de compras</h3>
                            </div>
                            <div class="row p-3">
                                <?php
                                if (mysqli_num_rows($ejectCompras) > 0) {
                                    while ($fetchCompra = mysqli_fetch_assoc($ejectCompras)) {
                                        $numPedido = $fetchCompra["id_pedido"];
                                        $fechaPedido = $fetchCompra["fecha"];
                                        $totalPedido = $fetchCompra["total"];
                                        $rutaPedido = $fetchCompra["ruta_factura"];

                                        $traerImagen = "SELECT * FROM pedidos JOIN productos ON pedidos.id_producto = productos.id_producto WHERE id_pedido = '$numPedido' AND orden_compra = (SELECT MAX(orden_compra) FROM pedidos WHERE id_pedido = '$numPedido')";
                                        $ejectImagen = mysqli_query($conexion, $traerImagen);

                                        $fetchImagen = mysqli_fetch_assoc($ejectImagen);
                                        $imagen = $fetchImagen["imagen"];
                                ?>
                                        <div class="col-sm-12 col-xl-6">
                                            <div class="row mt-4">
                                                <div class="col-sm col-md-6">
                                                    <form action="verPedido.php" method="get">
                                                        <input type="hidden" value="<?php echo $numPedido; ?>" name="pedido">
                                                        <button class="btn" style="border: none; background-color: transparent;" type="submit">
                                                            <img class="img-fluid" src="<?php echo $ruta . $imagen; ?>" alt="" style="background-color: white; border-radius: 20px;">
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-sm col-md-6" style="font-size: 22px;">
                                                    <p class="fw-bold" style="color: rgb(51, 255, 0);">Num. de pedido: <span class="fw-normal text-white"><?php echo $numPedido; ?></span></p>
                                                    <p class="fw-bold" style="color: rgb(51, 255, 0);">Fecha de compra: <br><span class="fw-normal text-white"><?php echo $fechaPedido; ?></span></p>
                                                    <p class="fw-bold" style="color: rgb(51, 255, 0);">Total: <span class="fw-normal text-white">$<?php echo $totalPedido; ?></span></p>
                                                    <form action="verPedido.php" method="get">
                                                        <input type="hidden" value="<?php echo $numPedido; ?>" name="pedido">
                                                        <button class="btn" style="background-color: rgb(51, 255, 0); color: #000; font-weight: bold; font-size: 20px;" type="submit">Ver pedido</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- Pedido -->
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="card-body">
                                        <h4 style="color: white;">Aún no tienes compras por mostrar</h4>
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