<?php
function conexion()
{
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $bd = "gg";
    $conexion = mysqli_connect($servidor, $usuario, $password, $bd);
    return $conexion;
}
