<?php
// Conexión a la base de datos
include 'config.php';

// Preparar los datos para la vista
$recentPosts = [];

// Consulta SQL
$sql = "SELECT titulo, resumen, fecha_publicacion FROM noticias WHERE estado = 'publicado' ORDER BY fecha_publicacion DESC LIMIT 5";

// Ejecutar la consulta
if ($result = mysqli_query($conn, $sql)) {
    // Iterar sobre los resultados y almacenarlos en el array
    while ($row = mysqli_fetch_assoc($result)) {
        $recentPosts[] = $row;
    }
    // Liberar el resultado
    mysqli_free_result($result);
}


// Incluir la vista (HTML)
include '../vista/perfilusuario.php';
?>