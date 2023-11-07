<?php
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Verificar si el correo electrónico ya existe
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $_SESSION['error'] = "El nombre de usuario o correo electrónico ya está en uso.";
        header("Location: ../vista/index.php");
        exit();
    }

    // Hash de la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insertar el usuario en la base de datos usando sentencias preparadas
    $stmt = $conn->prepare("INSERT INTO usuarios (username, password, email, role_id) VALUES (?, ?, ?, 1)");
    $stmt->bind_param("sss", $username, $hashed_password, $email);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registro exitoso! Por favor inicia sesión.";
        header("Location: ../vista/index.php");
        exit();
    } else {
        $_SESSION['error'] = "Hubo un error al registrar al usuario.";
        header("Location: ../vista/index.php");
        exit();
    }
   
}
?>
