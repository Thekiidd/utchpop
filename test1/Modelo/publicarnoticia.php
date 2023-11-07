<?php
include 'config.php';
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "Por favor, inicie sesión para publicar una noticia.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar y validar los datos del formulario
    $titulo = htmlspecialchars($_POST['titulo']);
    $contenido = htmlspecialchars($_POST['contenido']);

    // Validación adicional si es necesaria
    if (empty($titulo) || empty($contenido)) {
        echo "El título y el contenido son obligatorios.";
        exit;
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO noticias (titulo, contenido, autor_id, estado) VALUES (?, ?, ?, 'pendiente')";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Vincular parámetros
        mysqli_stmt_bind_param($stmt, 'ssi', $titulo, $contenido, $_SESSION['id']);

        // Ejecutar la consulta preparada
        if (mysqli_stmt_execute($stmt)) {
            echo "Noticia enviada a revisión exitosamente!";
        } else {
            echo "Error al publicar la noticia.";
        }

        // Cerrar sentencia
        mysqli_stmt_close($stmt);
    } else {
        echo "Error al preparar la consulta.";
    }
}
?>