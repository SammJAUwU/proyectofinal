<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../utils/PHPMailer/src/Exception.php';
require '../utils/PHPMailer/src/PHPMailer.php';
require '../utils/PHPMailer/src/SMTP.php';


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;

$mail->Username = 'aliyati3001@gmail.com';
$mail->Password = 'xpuoqxkcsyitpiwd';

$fechaActual = date('Y-m-d');

$mail->From = 'aliyati3001@gmail.com';
$mail->FromName = "Techgaming";
$mail->Subject = "Gracias por su compra " . $Usuario;
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';

$mail->AddAddress($correoUsuario);
$mail->Body = '
    <img src="cid:imagen" style="max-width: 100%; height: auto;">
    <center>
    <h1>Gracias por comprar en <span style="color: rgb(51, 255, 0);">Techgaming</span></h1>
    </center>
    <p style="text-align: justify; font-size: 18px;">Su compra se ha realizado de manera exitosa y por este medio le hacemos llegar la factura. Recuerde que su pedido será entregado en un plazo no mayor a 15 días dependiendo la demanda.</p>
    <p style="text-align: justify; font-size: 18px;">De igual manera la factura la puede consultar desde el sitio de techgaming en el historial de compras.</p>
    <p style="text-align: justify; font-size: 18px;">Cualquier duda o sugerencia sobre la compra con nosotros, no dude en contactarnos a través del correo <b>techgaming.techgg@gmail.com</b></p>
    <p style="text-align: justify; font-size: 18px;">Recuerde que siempre estamos para servirle.</p><br>
    <p style="text-align: center; font-size: 18px;">El equipo de Techgaming le desea un buen día.</p>
    <h2 style="color: rgb(51, 255, 0); text-align: center; font-size: 20px;">Techgaming</h2>
    <p style="text-align: center; font-size: 18px;">' . $fechaActual . '</p> <br><br>
    <p style="text-align: justify; font-size: 18px;">Si no reconoce la compra, favor de reportarlo cuanto antes. Gracias.</p>
    ';

$mail->AddEmbeddedImage('../assets/Poster/Poster1.jpg', 'imagen');
$mail->addAttachment('../' . $rutaPDF);

$mail->Send();
