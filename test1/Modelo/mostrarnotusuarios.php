<?php
include 'config.php';
session_start();
// Asume que la autenticación fue exitosa y $usuario es un array que contiene la información del usuario
$userId = $_SESSION['id'];  // obtiene el ID del usuario de la sesión

$user_id = $_SESSION['user_id']; // ID del usuario logueado

$sql = "SELECT id, titulo, contenido, fecha_publicacion FROM noticias WHERE autor_id = '$user_id' ORDER BY fecha_publicacion DESC";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<h2>" . $row["titulo"] . "</h2>";
    echo "<p>" . $row["contenido"] . "</p>";
    echo "<small>Publicado el " . $row["fecha_publicacion"] . "</small><br>";
    echo "<a href='editar_noticia.php?id=" . $row["id"] . "'>Editar</a> | <a href='deletenoticia.php?id=" . $row["id"] . "'>Eliminar</a><br><br>";
}
?>