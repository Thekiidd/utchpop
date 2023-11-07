<?php
session_start();
// Asume que la autenticación fue exitosa y $usuario es un array que contiene la información del usuario
$userId = $_SESSION['id'];  // obtiene el ID del usuario de la sesión
unset($_SESSION["loggedin"]);
unset($_SESSION["user_id"]);
unset($_SESSION["role_id"]);
unset($_SESSION["username"]);  // <- Asegúrate de eliminar también el nombre de usuario
header("Location: ../vista/index.php");
exit();
?>