<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['term'])) {

    $searchTerm = $_POST['term'];

    $sql = "SELECT nombre_producto FROM productos WHERE nombre_producto LIKE '%$searchTerm%' LIMIT 10";

    $result = mysqli_query($conexion, $sql);

    $suggestions = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $suggestions[] = $row['nombre_producto'];
        }
    } else {
        $suggestions[] = "No se encontraron resultados";
    }

    echo json_encode($suggestions);

    $conexion->close();
    exit;
}
?>