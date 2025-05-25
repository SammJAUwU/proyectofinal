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
                <h2 class="titulo text-center display-1 text-uppercase my-auto mt-4 mb-4">Aviso de privacidad</h2>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm text-light">
                    <p class="fs-5">Fecha de última actualización: 18/05/2025</p>

                    <p class="fs-5">TechGaming, con domicilio en Cuautitlán Izcalli, Estado de México, México, es responsable del tratamiento de sus datos personales, y pone a su disposición el presente Aviso de Privacidad, con el objetivo de informar sobre cómo se recaba, utiliza, almacena y protege su información personal.</p>

                    <p class="fs-5 fw-bold">1. Datos personales que recabamos</p>
                    <p class="fs-5">Los datos que podemos recopilar de usted incluyen:</p>
                    <ul class="fs-5">
                        <li>Nombre completo</li>
                        <li>Correo electrónico</li>
                        <li>Número de teléfono</li>
                        <li>Dirección de envío y facturación</li>
                        <li>Información de pago (procesada de forma segura por pasarelas como PayPal, Stripe, etc.)</li>
                        <li>Historial de compras</li>
                    </ul>

                    <p class="fs-5 fw-bold">2. Finalidades del tratamiento</p>
                    <p class="fs-5">Sus datos personales se utilizarán para:</p>
                    <ul class="fs-5">
                        <li>Procesar y enviar sus pedidos</li>
                        <li>Facturación y cobro</li>
                        <li>Brindarle atención al cliente</li>
                        <li>Informarle sobre promociones, descuentos, nuevos productos y actualizaciones relacionadas con TechGaming (solo si usted acepta recibir comunicaciones)</li>
                        <li>Cumplir con obligaciones legales y fiscales</li>
                    </ul>

                    <p class="fs-5 fw-bold">3. Transferencia de datos</p>
                    <p class="fs-5">Sus datos personales no serán compartidos con terceros, salvo en los siguientes casos:</p>
                    <ul class="fs-5">
                        <li>Proveedores de servicios para el cumplimiento de las finalidades mencionadas (por ejemplo, plataformas de pago, servicios de paquetería)</li>
                        <li>Autoridades competentes, en los casos legalmente previstos</li>
                    </ul>

                    <p class="fs-5 fw-bold">4. Derechos ARCO (Acceso, Rectificación, Cancelación y Oposición)</p>
                    <p class="fs-5">Usted tiene derecho a:</p>
                    <ul class="fs-5">
                        <li>Acceder a sus datos personales</li>
                        <li>Rectificarlos en caso de que estén incompletos o sean inexactos</li>
                        <li>Cancelarlos si considera que no se requieren para las finalidades indicadas</li>
                        <li>Oponerse al uso de los mismos para fines específicos</li>
                    </ul>
                    <p class="fs-5">Puede ejercer estos derechos enviando una solicitud al correo: <strong>privacidad@techgaming.com</strong></p>

                    <p class="fs-5 fw-bold">5. Uso de cookies y tecnologías similares</p>
                    <p class="fs-5">Nuestro sitio web utiliza cookies para mejorar la experiencia del usuario y fines analíticos. Puede deshabilitarlas desde su navegador. Para más detalles, consulte nuestra <strong>Política de Cookies</strong>.</p>

                    <p class="fs-5 fw-bold">6. Cambios al aviso de privacidad</p>
                    <p class="fs-5">TechGaming se reserva el derecho de modificar este Aviso de Privacidad en cualquier momento. Cualquier cambio será publicado en el sitio web <a href="https://www.techgaming.com" target="_blank">https://www.techgaming.com</a> y, si es necesario, se notificará por correo electrónico.</p>

                    <p class="fs-5 fw-bold">7. Contacto</p>
                    <p class="fs-5">Para cualquier duda relacionada con este aviso, puede comunicarse con nosotros a través de:</p>
                    <ul class="fs-5">
                        <li>Correo electrónico: <strong>privacidad@techgaming.com</strong></li>
                        <li>Sitio web: <a href="https://www.techgaming.com" target="_blank">https://www.techgaming.com</a></li>
                    </ul>

                </div>
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