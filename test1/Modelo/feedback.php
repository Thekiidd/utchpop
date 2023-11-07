<?php
include "config.php";  // Asegúrate de que este archivo contiene la información de conexión a la base de datos

// Inicia la sesión
session_start();

// Comprueba si el método de solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Comprueba si los campos necesarios están establecidos y no están vacíos
    if (isset($_POST['nombre'], $_POST['email'], $_POST['mensaje']) &&
        !empty($_POST['nombre']) &&
        !empty($_POST['email']) &&
        !empty($_POST['mensaje'])) {

        // Limpia y asigna los datos a variables
        $nombre = mysqli_real_escape_string($conn, trim($_POST['nombre']));
        $email = mysqli_real_escape_string($conn, filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL));
        $mensaje = mysqli_real_escape_string($conn, trim($_POST['mensaje']));

        // Verifica que el email es válido
        if (!$email) {
            die('Por favor ingresa una dirección de correo electrónico válida.');
        }

        // Prepara la consulta SQL para insertar los datos del feedback
        $sql = "INSERT INTO feedback (nombre, email, mensaje) VALUES (?, ?, ?)";

        // Prepara y ejecuta la sentencia
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, 'sss', $nombre, $email, $mensaje);

            // Ejecuta la sentencia preparada
            if (mysqli_stmt_execute($stmt)) {
                // Redirige al usuario a una página que confirma que el feedback ha sido recibido
                header('Location: agradecimiento.php');
                exit;
            } else {
                // Error en la ejecución
                echo 'No se pudo enviar el feedback. Por favor, inténtelo de nuevo más tarde.';
            }

            // Cierra la sentencia
            mysqli_stmt_close($stmt);
        } else {
            // Error al preparar la consulta
            echo 'Error al preparar la consulta.';
        }
    } else {
        die('Por favor complete todos los campos.');
    }
}
?>

<!-- El formulario HTML para enviar feedback -->
<form action="feedback.php" method="post">
    <label for="nombre">Tu nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="email">Tu correo electrónico:</label>
    <input type="email" id="email" name="email" required>

    <label for="mensaje">Tu mensaje:</label>
    <textarea id="mensaje" name="mensaje" required></textarea>

    <button type="submit">Enviar Comentarios</button>
</form>
