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
$Usuario = $fetchCarrito["usuario"];
$correoUsuario = $fetchCarrito["email"];

$sqLin = "SELECT * FROM carrito WHERE id_usuario = '$idUsuario'";
$sqLito = mysqli_query($conexion, $sqLin);

$total = $_POST["total"];
$iva = $_POST["iva"];
$domicilio = $_POST["domicilio"];
$nomCliente = $_POST["nombreCliente"];
$fecha = date("Y-m-d");
$idPedido = '';
$_SESSION["ruta_pedido"] = '';

if (mysqli_num_rows($sqLito) > 0 && isset($_SESSION["usuario"]) && $_SESSION["ruta_pedido"] == '') {
    $queryPedido = "SELECT * FROM factura WHERE id_usuario = '$idUsuario'";
    $ejectPedido = mysqli_query($conexion, $queryPedido);

    if (mysqli_num_rows($ejectPedido) > 0) {
        $queryIdPedido = "SELECT MAX(id_pedido) AS max_id FROM factura";
        $ejectIdPedido = mysqli_query($conexion, $queryIdPedido);

        $filaPedido = mysqli_fetch_assoc($ejectIdPedido);
        $numPedido = $filaPedido["max_id"];

        $idPedido = $numPedido + 1;
    } else {
        $idPedido = 1;
    }

    $queryFactura = "INSERT INTO factura VALUES ('$idPedido', '$idUsuario', '$domicilio', '$iva', '$total', '$fecha', NULL, '$nomCliente')";
    mysqli_query($conexion, $queryFactura);

    $idCompra = 1;
    while ($elementoFetch = mysqli_fetch_assoc($sqLito)) {
        $idProducto = $elementoFetch["id_producto"];
        $precio = $elementoFetch["precio_producto"];
        $precioTotal = $elementoFetch["total_producto"];
        $cantidad = $elementoFetch["cantidad"];

        $insertPedido = "INSERT INTO pedidos VALUES('$idPedido', '$idUsuario', '$idProducto', '$precio', '$cantidad', '$precioTotal', '$idCompra')";
        mysqli_query($conexion, $insertPedido);
        $idCompra += 1;
    }

    $verifyPedidos = "SELECT * FROM pedidos WHERE id_usuario = '$idUsuario'";
    $sqlPedidos = mysqli_query($conexion, $verifyPedidos);

    if (mysqli_num_rows($sqlPedidos) > 0) {
        $borrarCarrito = "DELETE FROM carrito WHERE id_usuario = '$idUsuario'";
        mysqli_query($conexion, $borrarCarrito);
    }

    require '../utils/fpdf/fpdf.php';

    $pdf = new FPDF();
    $pdf->AddPage('P', 'letter');
    $pdf->SetFont('Arial', 'B', 30);
    $pdf->SetTextColor(51, 255, 0);

    // Cabecera documento
    $pdf->SetX(10);
    $pdf->Cell(70, 20, 'Techgaming', 0, 1, 'C');
    $pdf->Image('../assets/Logos/logo1-bg.png', '150', '10', '50', '0');

    $pdf->SetFont('Arial', 'B', 20);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetX(10);
    $pdf->Cell(65, 0, 'Factura de compra', 0, 1, 'C');

    $pdf->SetFont('Arial', '', 18);
    $pdf->Cell(55, 15, utf8_decode('Cuautitlán, México.'), 0, 1, 'C');

    // Datos pedido / usuario
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(43, 10, 'Num. pedido', 1, 0, 'L');

    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(32, 10, $idPedido, 1, 1, 'C');

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(43, 10, 'Fecha de compra', 1, 0, 'L');

    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(32, 10, $fecha, 1, 1, 'C');

    $pdf->MultiCell(0, 5, '');

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(25, 10, 'Domiclio', 1, 0, 'L');

    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(100, 10, utf8_decode($domicilio), 1, 'L', 0);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(25, 10, 'Cliente', 1, 0, 'L');

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(100, 10, utf8_decode($nomCliente), 1, 1, 'L');

    $pdf->MultiCell(0, 10, '');

    // Cabecera factura
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetX(80);
    $pdf->Cell(50, 10, 'Resumen del pedido', 0, 1, 'C');
    $pdf->MultiCell(0, 2, '');

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(22, 10, 'CANT.', 1, 0, 'C');
    $pdf->Cell(105, 10, utf8_decode('DESCRIPCIÓN'), 1, 0, 'C');
    $pdf->Cell(36, 10, 'PRECIO UNITARIO', 1, 0, 'C');
    $pdf->Cell(30, 10, 'IMPORTE', 1, 1, 'C');

    // Productos
    $traerPedidos = "SELECT * FROM pedidos JOIN productos ON pedidos.id_producto = productos.id_producto WHERE id_pedido = '$idPedido'";
    $queryResumen = mysqli_query($conexion, $traerPedidos);

    while ($producto = mysqli_fetch_assoc($queryResumen)) {
        $nombreProducto = $producto["nombre_producto"];
        $cantidadProduto = $producto["cantidad"];
        $precioProduto = $producto["precio_producto"];
        $totalProduto = $producto["total_producto"];

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(22, 10, $cantidadProduto, 1, 0, 'C');
        $pdf->Cell(105, 10, utf8_decode($nombreProducto), 1, 0, 'C');
        $pdf->Cell(36, 10, '$' . $precioProduto, 1, 0, 'C');
        $pdf->Cell(30, 10, '$' . $totalProduto, 1, 1, 'C');
    }

    $pdf->MultiCell(0, 10, '');

    // Resumen IVA - total
    $pdf->SetX(150);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(23, 10, 'IVA', 1, 0, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 10, '$' . $iva, 1, 1, 'C');

    $pdf->SetX(150);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(23, 10, 'Total', 1, 0, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 10, '$' . $total, 1, 1, 'C');

    $pdf->MultiCell(0, 10, '');

    // Agradecimiento
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(28, 2, 'Indicaciones', 0, 1, 'L');

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(195, 10, utf8_decode('Tu pedido será entregado en un plazo no mayor a 15 días. Cualquier problema no dude en contactarnos.'), 0, 1, 'L');

    $pdf->MultiCell(0, 10, '');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(28, 2, 'Gracias por tu compra!', 0, 1, 'L');

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(195, 10, utf8_decode('El equipo de Techgaming te agarece y te desea un buen dia.'), 0, 0, 'L');

    $pdf->SetFont('Arial', 'B', 20);
    $pdf->SetTextColor(51, 255, 0);
    $pdf->SetX(140);
    $pdf->Cell(70, 5, 'Techgaming', 0, 1, 'C');

    $_SESSION["ruta_pedido"] = 'src/pedidos/pedido_' . $idPedido . '.pdf';
    $rutaPDF = $_SESSION["ruta_pedido"];

    $guardarRuta = "UPDATE factura SET ruta_factura = '$rutaPDF' WHERE id_pedido = '$idPedido'";
    mysqli_query($conexion, $guardarRuta);

    $pdf->Output('F', '../' . $_SESSION["ruta_pedido"]);

    require '../utils/PHPMailer/email/enviarFactura.php';
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
        <link rel="stylesheet" href="<?php echo $ruta . 'css/formularioPago.css'; ?>">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    </head>

    <body>
        <?php
        require($ruta . 'layouts/nav.php');
        ?>
        <div class="container">
            <h1 class="titulo display-1 text-uppercase my-5 text-center" style="font-size: 48px;">Gracias por tu compra</h1>
            <p class="display-1 text-center text-uppercase my-auto" style="color: white; font-size: 28px;">Por favor descarga tu factura en el siguiente enlace:</p>
            <a class="d-block mx-auto mt-5 btn" style="background-color: rgb(51, 255, 0); color: #000; max-width: 200px; font-weight: bold; font-size: 20px;" href="<?php echo $ruta . $_SESSION["ruta_pedido"]; ?>" target="_blank">Descargar factura</a>
            <a class="d-block mx-auto mt-5 btn" style="background-color: rgb(51, 255, 0); color: #000; max-width: 200px; font-weight: bold; font-size: 20px;" href="<?php echo $ruta . 'components/historial.php' ?>">Ver compras</a>
            <img class="d-block mx-auto img-fluid my-5" src="../assets/Logos/logo1-bg.png" alt="Logo" style="max-width: 250px;">
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
<?php
} else {
    header("Location: carrito.php");
    exit();
}
?>