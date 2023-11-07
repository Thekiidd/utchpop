<?php
include 'config.php';
session_start();
// Asume que la autenticación fue exitosa y $usuario es un array que contiene la información del usuario
$userId = $_SESSION['usuario_id'];  // obtiene el ID del usuario de la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $contenido = mysqli_real_escape_string($conn, $_POST['contenido']);
    $noticia_id = $_POST['id'];

    $sql = "UPDATE noticias SET titulo = '$titulo', contenido = '$contenido' WHERE id = '$noticia_id' AND autor_id = '".$_SESSION['user_id']."'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Noticia actualizada exitosamente!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

