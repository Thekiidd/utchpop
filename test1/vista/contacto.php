<?php
include 'header.php';
include '../Modelo/config.php';
// Inicializar la sesión
session_start();


// Definir variables para mantener los datos ingresados y los mensajes de error
$nameErr = $emailErr = $messageErr = "";
$name = $email = $message = $successMsg = "";

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar el nombre
    if (empty($_POST["name"])) {
        $nameErr = "El nombre es requerido.";
    } else {
        $name = test_input($_POST["name"]);
        // Verificar si el nombre contiene solo letras y espacios
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Solo se permiten letras y espacios en blanco.";
        }
    }

    // Validar el email
    if (empty($_POST["email"])) {
        $emailErr = "El email es requerido.";
    } else {
        $email = test_input($_POST["email"]);
        // Verificar si la dirección de email es válida
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato de email inválido.";
        }
    }

    // Validar el mensaje
    if (empty($_POST["message"])) {
        $messageErr = "El mensaje no puede estar vacío.";
    } else {
        $message = test_input($_POST["message"]);
    }

    // Si no hay errores, enviar el email
    if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
        $to = "admin@example.com"; // Cambia esto por el email del administrador
        $subject = "Nuevo mensaje de contacto de $name";
        $headers = "De: $email";
        $body = "Nombre: $name\nEmail: $email\nMensaje:\n$message";

        if (mail($to, $subject, $body, $headers)) {
            $successMsg = "¡Mensaje enviado con éxito!";
            // Restablecer los campos después del envío exitoso
            $name = $email = $message = "";
        } else {
            $successMsg = "El mensaje no pudo ser enviado.";
        }
    }
}

// Función para limpiar la entrada de datos
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="../vista/estilos/maindiseño.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Formulario de Contacto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de Contacto -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    Nombre: <input type="text" name="name" value="<?php echo $name;?>">
                    <span class="error">* <?php echo $nameErr;?></span>
                    <br><br>
                    Email: <input type="text" name="email" value="<?php echo $email;?>">
                    <span class="error">* <?php echo $emailErr;?></span>
                    <br><br>
                    Mensaje:
                    <textarea name="message" rows="5" cols="40"><?php echo $message;?></textarea>
                    <span class="error"><?php echo $messageErr;?></span>
                    <br><br>
                    <input type="submit" name="submit" value="Enviar" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap y jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    // Mostrar el modal automáticamente
    $('#contactModal').modal('show');
});
</script>

</body>
</html>
<?php include 'footer.php'; ?>