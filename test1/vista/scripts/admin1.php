<?php
include '../Modelo/config.php';
session_start();
if ($_SESSION['role_id'] != '2') {
    // Redirigir a otra página o mostrar error
    header("Location: ../Controlador/no_access.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard - Administrador</title>
    <link href="./estilos/dashboard.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

    <body>
        <!-- Modal para Mensajes -->
        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messageModalLabel">Mensaje</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($_SESSION['message']) || isset($_SESSION['error'])) : ?>
                            <script type="text/javascript">
                                document.addEventListener('DOMContentLoaded', function() {
                                    var message = <?php echo json_encode($_SESSION['message'] ?? $_SESSION['error']); ?>;
                                    var modalBody = document.querySelector('#messageModal .modal-body');
                                    modalBody.innerHTML = message; // Establece el mensaje en el modal

                                    $('#messageModal').modal('show'); // Muestra el modal

                                    <?php
                                    unset($_SESSION['message']);
                                    unset($_SESSION['error']);
                                    ?>
                                });
                            </script>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-container">
            <!-- Barra lateral -->
            <aside class="sidebar">
                <div class="user-profile">
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                        </li><a href="#">Hola, <?= $_SESSION['username'] ?></a></li>
                        </li><a href="../Controlador/logout.php">Cerrar Sesión</a></li>
                    <?php else : ?>
                        <a href="#" class="icon-button">
                            <i class="fas fa-user"></i>
                        </a>
                    <?php endif; ?>
                </div>
                <nav>
                    <ul>
                        <li><a href="#" data-section="gestionUsuarios" id="showgestionUsuarios"><span class="icon">👥</span> Gestión de Usuarios</a></li>
                        <li><a href="#" data-section="aprobacionNoticias" id="showaprobarNoticia"><span class="icon">📰</span> Aprobación de Noticias</a></li>
                        <li><a href="#" data-section="moderacionComentarios" id="showmoderacionComentarios"><span class="icon">💬</span> Moderación de Comentarios</a></li>
                        <!-- ... Otras opciones ... -->
                    </ul>
                </nav>
            </aside>
            <!-- Contenido principal -->
            <main class="main-content">



                <!-- Sección de Gestión de Usuarios -->
                <section class="hidden" class="showgestionUsuarios" id="gestionUsuarios">
                    <?php
                    // Verifica si el usuario está logueado y es administrador
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['role_id'] == 2) {
                        // Aquí va la lógica para gestionar usuarios

                        // Consulta para obtener todos los usuarios
                        $sql = "SELECT id, username, email FROM usuarios";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Mostrar resultados en una tabla
                            echo "<table>";
                            echo "<tr><th>ID</th><th>Nombre de Usuario</th><th>Email</th><th>Acciones</th></tr>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                                echo "<td>";
                                // Asegúrate de implementar la lógica para editar y eliminar usuarios de forma segura
                                echo "<a href='editar_usuario.php?id=" . $row["id"] . "'>Editar</a> ";
                                echo "<a href='eliminar_usuario.php?id=" . $row["id"] . "'>Eliminar</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No hay usuarios para mostrar.";
                        }
                    } else {
                        echo "Acceso denegado: no tienes permisos para acceder a esta página.";
                        exit;
                    }
                    ?>
                </section>


                <section class="hidden";class="showaprobacionNoticias" id="aprobacionNoticias">

                    <?php

                    // Verifica si el usuario es un administrador
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                        // Mostrar el panel de administración
                    } else {
                        echo "Acceso denegado: no tienes permisos para acceder a esta página.";
                        exit;
                    }

                    $sql = "SELECT id, titulo, contenido FROM noticias WHERE estado = 'pendiente'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Mostrar resultados en una tabla
                        echo "<table>";
                        echo "<tr><th>ID</th><th>Título</th><th>Contenido</th><th>Acción</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["titulo"] . "</td>";
                            echo "<td>" . $row["contenido"] . "</td>";
                            echo "<td>";
                            echo "<a href='aprobar_noticia.php?id=" . $row["id"] . "&estado=aprobada'>Aprobar</a> ";
                            echo "<a href='aprobar_noticia.php?id=" . $row["id"] . "&estado=rechazada'>Rechazar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No hay noticias pendientes.";
                    }
                    ?>

                </section>

                <section class="hidden" class="showmoderacionComentarios" id="moderacionComentarios">
                    <?php
                    // Verifica si el usuario está logueado y es administrador
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['role_id'] == 2) {
                        // Aquí va la lógica para moderar comentarios

                        // Consulta para obtener todos los comentarios pendientes de moderación
                        $sql = "SELECT id, contenido FROM comentarios";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Mostrar resultados en una tabla
                            echo "<table>";
                            echo "<tr><th>ID</th><th>Comentario</th><th>Acción</th></tr>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["contenido"]) . "</td>";
                                echo "<td>";
                                // Asegúrate de implementar la lógica para aprobar y rechazar comentarios de forma segura
                                echo "<a href='aprobar_comentario.php?id=" . $row["id"] . "'>Aprobar</a> ";
                                echo "<a href='rechazar_comentario.php?id=" . $row["id"] . "'>Rechazar</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No hay comentarios pendientes.";
                        }
                    } else {
                        echo "Acceso denegado: no tienes permisos para acceder a esta página.";
                        exit;
                    }
                    ?>
                </section>



            </main>
        </div>

        <!--antes del cierre de la etiqueta </body> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script src="./ocultsecciones.js"></script>
    </body>

</html>
<?php
mysqli_close($conn);
?>