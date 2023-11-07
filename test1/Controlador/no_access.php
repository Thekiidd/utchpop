<?php
include '../vista/header.php'; 
// Iniciar sesión
session_start();

// Redirigir al usuario si ya tiene permiso
if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == '2') {
    header('Location: ../vista/admin.php');
    exit;
} elseif (isset($_SESSION['role_id']) && $_SESSION['role_id'] != '1') {
    header('Location: ../vista/perfilusuario.php');
    exit;
}

// Si llegamos aquí, el usuario no tiene acceso
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Restringido</title>
    <link rel="stylesheet" href="../vista/estilos/maindiseño.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Acceso Restringido</h1>
        <p>Lo sentimos, no tienes permiso para acceder a esta página.</p>
        <p>Si crees que esto es un error, por favor <a href="contacto.php">contacta con el administrador</a>.</p>
        <p>O puedes <a href="../vista/index.php">volver a la página de inicio</a>.</p>
    </div>
    <!-- Otros scripts o archivos necesarios -->
</body>
</html>
<?php include '../vista/footer.php'; ?>