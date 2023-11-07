<?php
include '../Modelo/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Verificar la conexión a la base de datos
    if ($conn->connect_error) {
        error_log('Fallo en la conexión a la base de datos: ' . $conn->connect_error);
    } else {
        error_log('Conexión a la base de datos exitosa');
    }

    // Uso de sentencias preparadas para mejorar la seguridad
    $stmt = $conn->prepare("SELECT username, password, role_id FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        // Verificar que la contraseña obtenida de la base de datos es la esperada
        error_log('Contraseña obtenida de la base de datos: ' . $row['password']);
        error_log('Contraseña proporcionada por el usuario: ' . $password);
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role_id'] = $row['role_id']; 

            // Redireccionar basado en el rol
            if ($_SESSION['role_id'] == 2) {  // Asegúrate de que se compara como número, no como cadena
                header("Location: ../vista/admin.php");
                exit;
            } else {
                header("Location: ../vista/perfilusuario.php");
                exit;
            }
        } else {
            // Manejar error de autenticación
            $_SESSION['error'] = 'La contraseña no es correcta.';
            header("Location: ../vista/index.php");
            exit;
        }
    } else {
        // Manejar error si el usuario no existe
        $_SESSION['error'] = 'El usuario no existe.';
        header("Location: ../vista/index.php");
        exit;
    }
}
?>