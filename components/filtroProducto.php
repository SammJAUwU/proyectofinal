<?php
// Esto es para que cargue las rutas del nav antes de abrir la página
$ruta = '../';
session_start();
require "conexion.php";
$conexion = conexion();
require "buscarProducto.php";

$queryProductos = "SELECT * FROM productos";
$sqlProductos = mysqli_query($conexion, $queryProductos);


if (isset($_POST["enviarCant"])) {
    $user = $_SESSION["usuario"];
    $cantidad = intval($_POST["cant"]); // Convertir la cantidad a un entero
    $idProducto = intval($_POST["idProducto"]); // Convertir el ID del producto a un entero
    $precioProducto = floatval($_POST["precioProducto"]); // Convertir el precio del producto a un flotante

    // Validar que la cantidad sea un número entero positivo
    if ($cantidad > 0) {

        // Obtener el ID del usuario
        $queryCarrito = "SELECT id FROM usuarios WHERE usuario = '$user'";
        $sqlCarrito = mysqli_query($conexion, $queryCarrito);
        $idUsuario = mysqli_fetch_assoc($sqlCarrito)["id"];

        $sqLin = "SELECT * FROM carrito WHERE id_usuario = '$idUsuario' AND id_producto = '$idProducto'";
        $sqLito = mysqli_query($conexion, $sqLin);

        if (mysqli_num_rows($sqLito) > 0) {
            $totalProducto = $cantidad * $precioProducto;
            $updateCarrito = "UPDATE carrito SET cantidad = '$cantidad', total_producto = '$totalProducto' WHERE id_usuario = '$idUsuario' AND id_producto = '$idProducto'";
            $sqlUPDATE = mysqli_query($conexion, $updateCarrito);
        } else {
            if ($sqlCarrito && mysqli_num_rows($sqlCarrito) > 0) {

                // Calcular el total del producto
                $totalProducto = $cantidad * $precioProducto;

                // Construir la consulta SQL para insertar en la tabla carrito
                $queryCarritoInsert = "INSERT INTO carrito (id_compra, id_usuario, id_producto, precio_producto, cantidad, total_producto) VALUES (NULL, $idUsuario, $idProducto, $precioProducto, $cantidad, $totalProducto)";

                // Ejecutar la consulta SQL para insertar en la tabla carrito
                $sqlCarritoInsert = mysqli_query($conexion, $queryCarritoInsert);
            }
        }
    }
}

if (isset($_POST["filtro"])) {
    $_SESSION["opFiltro"] = $_POST["valores"];
    header("Location: filtroProducto.php");
    exit();
}

if (isset($_SESSION["opFiltro"])) {
    $opcionFiltro;
    switch ($_SESSION["opFiltro"]) {
        case '1':
            $opcionFiltro = 'Audifonos';
            break;
        case '2':
            $opcionFiltro = 'Gabinetes';
            break;
        case '3':
            $opcionFiltro = 'control';
            break;
        case '4':
            $opcionFiltro = 'teclado';
            break;
        case '5':
            $opcionFiltro = 'mouse';
            break;
        default:
            unset($_SESSION['opFiltro']);
            header("Location: productos.php");
            exit();
            break;
    }
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
                    <img src="../assets/Poster/GG1.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <?php
            if (mysqli_num_rows($sqlProductos) > 0) {
            ?>
                <h2 class="titulo display-1 text-uppercase my-5 text-center" style="font-size: 40px;">Nuestros productos</h2>
                <form method="post">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Filtrar</label>
                        <select class="form-select" id="inputGroupSelect01" name="valores">
                            <option disabled selected>Escoger alguna categoria...</option>
                            <option value="1">Audifonos</option>
                            <option value="2">Gabinetes</option>
                            <option value="3">Controles</option>
                            <option value="4">Teclados</option>
                            <option value="5">Mouse</option>
                            <option value="6">Todos los productos</option>
                        </select>
                        <input type="submit" name="filtro" class="btn" style="background-color: rgb(51, 255, 0); color: #000;" value="Aplicar">
                    </div>
                </form>
            <?php
            } else {
                echo '<h2 class="titulo display-1 text-uppercase my-5 text-center" style="font-size: 40px;">No hay productos</h2>';
            }
            ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                while ($traerProductos = mysqli_fetch_assoc($sqlProductos)) {
                    $idProducto = $traerProductos['id_producto'];
                    $catProducto = $traerProductos['categoria'];
                    $nombreProducto = $traerProductos['nombre_producto'];
                    $descripcionProducto = $traerProductos['descripcion'];
                    $imagenProducto = $traerProductos['imagen'];
                    $precioProducto = $traerProductos['precio'];

                    if ($catProducto == $opcionFiltro) {
                ?>
                        <div class="col">
                            <div class="card h-100">
                                <form action="mostrarProducto.php" method="get">
                                    <input type="hidden" name="searchP" value="<?php echo $nombreProducto; ?>">
                                    <button type="submit" style="background-color: transparent; border: none;">
                                        <img class="img-fluid" src="<?php echo $ruta . $imagenProducto; ?>" alt="a" style="background-color: white; border-radius: 20px;">
                                    </button>
                                </form>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $nombreProducto; ?></h5>
                                    <p class="card-text"><?php echo $descripcionProducto; ?></p>
                                    <form method="post">
                                        <div class="mb-3">
                                            <?php
                                            if (isset($_SESSION["usuario"])) {
                                                $user = $_SESSION["usuario"];
                                                $queryCarrito = "SELECT id FROM usuarios WHERE usuario = '$user'";
                                                $sqlCarrito = mysqli_query($conexion, $queryCarrito);
                                                $idUsuario = mysqli_fetch_assoc($sqlCarrito)["id"];

                                                $sqLin = "SELECT * FROM carrito WHERE id_usuario = '$idUsuario' AND id_producto = '$idProducto'";
                                                $sqLito = mysqli_query($conexion, $sqLin);
                                            ?>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon3">Cantidad</span>
                                                    <?php
                                                    if (mysqli_num_rows($sqLito) > 0) {
                                                        $fetchProductos = mysqli_fetch_assoc($sqLito);
                                                        $cantidadProducto = $fetchProductos["cantidad"];
                                                    ?>
                                                        <input name="cant" type="number" min="1" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4" required value="<?php echo $cantidadProducto; ?>">
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input name="cant" type="number" min="1" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4" required placeholder="Ingresar una cantidad">
                                                    <?php
                                                    }
                                                    ?>
                                                    <!-- Campos ocultos para almacenar el ID del producto y su precio -->
                                                    <input type="hidden" name="idProducto" value="<?php echo $idProducto; ?>">
                                                    <input type="hidden" name="precioProducto" value="<?php echo $precioProducto; ?>">
                                                    <input type="submit" name="enviarCant" class="btn" style="background-color: rgb(51, 255, 0); color: #000;" value="Añadir">
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <small class="text-body-secondary"><b>Precio: </b><?php echo '$' . $precioProducto; ?></small>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        <?php
        require($ruta . 'layouts/footer.php');
        ?>

        <!-- Modal -->
        <div class="modal fade" id="customAlertModal" tabindex="-1" aria-labelledby="customAlertModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="customAlertModalLabel">Información del producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="customAlertMessage">Este es un mensaje de alerta personalizado.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            <?php if ($sqlUPDATE) : ?>
                document.getElementById("customAlertMessage").innerText = "Modificación exitosa";
                document.addEventListener('DOMContentLoaded', function() {
                    var customAlertModal = new bootstrap.Modal(document.getElementById('customAlertModal'));
                    customAlertModal.show();
                });
            <?php else : ?>
                document.getElementById("customAlertMessage").innerText = "No se pudo realizar la modificación";
                document.addEventListener('DOMContentLoaded', function() {
                    var customAlertModal = new bootstrap.Modal(document.getElementById('customAlertModal'));
                    customAlertModal.show();
                });
            <?php endif; ?>
        </script>

        <script>
            <?php if ($sqlCarritoInsert) : ?>
                document.getElementById("customAlertMessage").innerText = "Producto añadido al carrito";
                document.addEventListener('DOMContentLoaded', function() {
                    var customAlertModal = new bootstrap.Modal(document.getElementById('customAlertModal'));
                    customAlertModal.show();
                });
            <?php else : ?>
                document.getElementById("customAlertMessage").innerText = "Error al añadir al producto al carrito";
                document.addEventListener('DOMContentLoaded', function() {
                    var customAlertModal = new bootstrap.Modal(document.getElementById('customAlertModal'));
                    customAlertModal.show();
                });
            <?php endif; ?>
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="../js/buscarProducto.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: productos.php");
}
?>