<?php
$host = 'localhost';      // El host donde se encuentra tu base de datos (comúnmente 'localhost')
$username = 'root'; // El nombre de usuario para acceder a la base de datos
$password = ''; // La contraseña para acceder a la base de datos
$db_name = 'new_db_utch';     // El nombre de tu base de datos

// Crear conexión
$conn = mysqli_connect($host, $username, $password, $db_name);

// Verificar conexión
if (!$conn) {
    error_log("[" . date("Y-m-d H:i:s") . "] Conexión fallida: " . mysqli_connect_error() . "\n", 3, "../vista/error_log.txt");
    die("Error de conexión. Por favor, inténtelo más tarde.");
}
?>