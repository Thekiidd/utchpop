
<?php
$noticia_id = $_GET['id'];

$sql = "DELETE FROM noticias WHERE id = '$noticia_id' AND autor_id = '".$_SESSION['user_id']."'";

if (mysqli_query($conn, $sql)) {
    echo "Noticia eliminada exitosamente!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>