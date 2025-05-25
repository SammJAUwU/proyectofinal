<?php
// Inicia la sesión si no ha sido iniciada aún
session_start();

// Destruye todas las variables de sesión
$_SESSION = array();

// Borra la cookie de sesión si está definida
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Finalmente, destruye la sesión
session_destroy();
header("Location: ../index.php");

?>