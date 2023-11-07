<?php
include '../Modelo/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Suponiendo que quieres cambiar la contraseña también
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Uso de sentencias preparadas para actualizar
    $stmt = $conn->prepare("UPDATE usuarios SET username = ?, password = ?, email = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $passwordHash, $email, $userId);
    if ($stmt->execute()) {
        $_SESSION['username'] = $username; // Actualiza la sesión si es necesario
        $_SESSION['message'] = "Perfil actualizado exitosamente!";
        header("Location: ../vista/index.php");
        exit();
    } else {
        $_SESSION['error'] = "Error al actualizar el perfil: " . $stmt->error;
        header("Location: actuperfil.php");
        exit();
    }
}
?>
