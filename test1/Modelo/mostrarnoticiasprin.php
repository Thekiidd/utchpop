<?php
include 'config.php'; // Asegúrate de tener un archivo config.php para la conexión a la base de datos.
session_start();
// Asume que la autenticación fue exitosa y $usuario es un array que contiene la información del usuario
$userId = $_SESSION['id'];  // obtiene el ID del usuario de la sesión



$noticias_por_pagina = 5; // Cambia esto según cuántas noticias quieras por página.
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina > 1) ? ($pagina * $noticias_por_pagina - $noticias_por_pagina) : 0;

// Obtener noticias de la base de datos
$sql = "SELECT SQL_CALC_FOUND_ROWS id, titulo, contenido, fecha_publicacion, columna_imagen FROM noticias ORDER BY fecha_publicacion DESC LIMIT $inicio, $noticias_por_pagina";
$result = mysqli_query($conn, $sql);
$total_noticias = mysqli_query($conn, "SELECT FOUND_ROWS() as total");
$total_noticias = mysqli_fetch_assoc($total_noticias)['total'];

// Mostrar noticias
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='noticia'>";
    echo "<img src='" . htmlspecialchars($row["columna_imagen"]) . "' alt='Imagen de Noticia' style='width:100%; height:auto;'>";
    echo "<h2>" . htmlspecialchars($row["titulo"]) . "</h2>";
    echo "<p>" . substr(htmlspecialchars($row["contenido"]), 0, 200) . "...</p>"; // Muestra solo los primeros 200 caracteres
    echo "<small>Publicado el " . htmlspecialchars($row["fecha_publicacion"]) . "</small>";
    echo "</div>";
}

// Añadir enlaces de paginación
$numero_paginas = ceil($total_noticias / $noticias_por_pagina);
echo "<div class='paginacion'>";
for ($i = 1; $i <= $numero_paginas; $i++) {
    // Marca la página actual de forma diferente
    if ($pagina === $i) {
        echo "<span class='pagina-actual'>$i</span> ";
    } else {
        echo "<a href='?pagina=$i'>$i</a> ";
    }
}
echo "</div>";
