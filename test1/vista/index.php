<?php
include '../Modelo/config.php';
session_start();
var_dump($_SESSION);
?>


<!DOCTYPE html>
<html lang="en">






<!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias UTCH</title>
    <link rel="stylesheet" href="./estilos/maindiseño.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>



<!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->





<!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

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

    <!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
    <div class="navbar">
        <div class="left-section">
            <div class="logo">
                <img src="./img/img4.png" alt="Logo-Utch">
            </div>
        </div>
        <div class="right-section auth-links">
            <nav>
                <a href="#" data-tooltip="Inicio"><i class="fas fa-home"></i> Inicio</a>
                <a href="#">Noticias UTCH</a>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle">Categorias</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">NotiComunidad</a>
                        <a class="dropdown-item" href="#">Cursos</a>
                        <a class="dropdown-item" href="#">Actividades</a>
                    </div>
                </div>
                <!-- Enlaces de autenticación -->
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                    <a href="#">Hola, <?= htmlspecialchars($_SESSION['username']) ?></a>
                    <?php if ($_SESSION['role_id'] == 2) : ?>
                        <!-- Enlace solo para administradores -->
                        <a href="admin.php">Panel de Administrador</a>
                    <?php else : ?>
                        <!-- Enlace solo para usuarios normales -->
                        <a href="perfilusuario.php">Panel de Usuario</a>
                    <?php endif; ?>
                    <a href="../Controlador/logout.php">Cerrar Sesión</a>
                <?php else : ?>
                    <a href="#" class="icon-button" onclick="openModal()">
                        <i class="fas fa-user"></i>
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </div>

    <!-- Modal inicio,registro y administrador -->
    <div class="modal fade" id="modaliniciodesesion" tabindex="-1" role="dialog" aria-labelledby="modaliniciodesesionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaliniciodesesionLabel">Acceso a Usuarios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Pestañas para Iniciar Sesión y Registro -->
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Registro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="admin-info-tab" data-toggle="tab" href="#adminlogin" role="tab" aria-controls="adminlogin" aria-selected="false">Administrador?</a>
                        </li>
                    </ul>

                    <!-- Contenido de las pestañas -->
                    <div class="tab-content" id="myTabContent">
                        <!-- Contenido de la pestaña Iniciar Sesión -->
                        <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                            <!-- Formulario de Inicio de Sesión -->
                            <form action="iniciosesion.php" method="post" class="mt-3">
                                <input type="hidden" name="login" value="1">
                                <div class="form-group">
                                    <label for="loginusername">username</label>
                                    <input type="text" class="form-control" id="loginusername" name="username" placeholder="Username" autocomplete="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="loginEmail">Correo
                                        Electrónico</label>
                                    <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Correo Electrónico" autocomplete="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="loginPassword">Contraseña</label>
                                    <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Contraseña" autocomplete="current-password" required>
                                </div>
                                <div class="form-group">
                                    <a href="#">¿Olvidaste tu contraseña?</a>
                                </div>
                                <a href="#"><button type="submit" class="btn btn-primary">Iniciar
                                        Sesión</button></a>
                            </form>
                        </div>
                        <!-- Contenido de la pestaña Registro -->
                        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                            <!-- Formulario de Registro -->
                            <form action="../Modelo/registro.php" method="POST" onsubmit="return onSubmit();" class="mt-3">
                                <div class="form-group">
                                    <label for="registerusername">Nombre
                                        Completo</label>
                                    <input type="text" class="form-control" id="registerusername" name="username" placeholder="Nombre Completo" autocomplete="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="registeremail">Correo
                                        Electrónico</label>
                                    <input type="email" class="form-control" id="registeremail" name="email" placeholder="Correo Electrónico" autocomplete="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="registerpassword">Contraseña</label>
                                    <input type="password" class="form-control" id="registerpassword" name="password" placeholder="Contraseña" autocomplete="new-password" required>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" required>
                                    <label class="form-check-label" for="terms">Acepto los <a href="#">Términos
                                            y Condiciones</a> y la <a href="#">Política de Privacidad</a></label>
                                </div>
                                <button type="submit" class="btn btn-primary">Registrarse</button>
                            </form>
                        </div>
                        <!-- Contenido de la Pestaña de Administrador -->
                        <div class="tab-pane fade" id="adminlogin" role="tabpanel" aria-labelledby="admin-login-tab">
                            <!-- Información para ser Administrador -->
                            <div class="info-admin mt-3">
                                <h3>¿Cómo convertirse en Administrador?</h3>
                                <p>Para administrar el sitio, debes cumplir con ciertos requisitos...</p>
                                <!-- Más información aquí -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->


    <div class="video-banner">
        <video autoplay muted loop id="videoBackground">
            <source src="./img/manejodenoche.mp4" type="video/mp4">
        </video>
        <div class="video-content">
            <h1>Innovando en Educación Tecnológica</h1>
            <p>CON SENTIDO HUMANO</p>
            <a href="https://www.utch.edu.mx/index.php/utch360/" class="video-button">
                Recorrido virtual 360°
            </a>
        </div>
    </div>

    <!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->


    <!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

    <main class="contenedor-principal">
        <section class="news-section row">
            <!-- Main News -->
            <div class="main-news col-lg-8">
                <div class="container mt-4 contenedor-noticias">
                    <h2>Noticias de la comunidad</h2>
                    <div class="row">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM noticias WHERE tipo = 'admin' LIMIT 3"); // Ajusta la consulta según sea necesario
                        while ($noticia = mysqli_fetch_assoc($result)) {
                            echo "<div class='col-md-4 mb-3'>";
                            echo "<div class='card'>";
                            echo "<img class='card-img-top' src='" . htmlspecialchars($noticia['columna_imagen'] ?? '../vista/img/img.png') . "' alt='Imagen'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>" . htmlspecialchars($noticia['titulo']) . "</h5>";
                            echo "<p class='card-text'>" . substr(htmlspecialchars($noticia['contenido']), 0, 100) . "...</p>";
                            echo "<a href='#' class='btn btn-primary'>Leer más</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>

            </div>
            <!-- Secondary News -->
            <div class="secondary-news col-lg col-12">
                <h2>Noticias de la comunidad</h2>
                <div class="row">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM noticias WHERE tipo = 'admin' LIMIT 2"); // Ajusta la consulta según sea necesario
                    while ($noticia = mysqli_fetch_assoc($result)) {
                        echo "<div class='col-md-4 mb-3'>";
                        echo "<div class='card'>";
                        echo "<img class='card-img-top' src='" . htmlspecialchars($noticia['columna_imagen'] ?? '../vista/img/img.png') . "' alt='Imagen'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . htmlspecialchars($noticia['titulo']) . "</h5>";
                        echo "<p class='card-text'>" . substr(htmlspecialchars($noticia['contenido']), 0, 100) . "...</p>";
                        echo "<a href='#' class='btn btn-primary'>Leer más</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
    <!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

    <main class="contenedor-principal">
        <section class="courses-section row">
            <div id="miCarrusel" class="carousel slide" data-ride="carousel">
                <!-- Indicadores -->
                <ol class="carousel-indicators">
                    <li data-target="#miCarrusel" data-slide-to="0" class="active"></li>
                    <li data-target="#miCarrusel" data-slide-to="1" class="active"></li>
                    <li data-target="#miCarrusel" data-slide-to="2" class="active"></li>
                </ol>
                <!-- Contenido del carrusel -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./img/img.png" alt="Descripción 1" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Título 1</h5>
                            <p>Descripción breve 1</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="./img/img.png" alt="Descripción 2" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Título 2</h5>
                            <p>Descripción breve 2</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="./img/img.png" alt="Descripción 3" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Título 3</h5>
                            <p>Descripción breve 3</p>
                        </div>
                    </div>
                </div>
                <!-- Controles -->
                <a class="carousel-control-prev" href="#miCarrusel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#miCarrusel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </section>
    </main>

    <!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->


    <main class="contenedor-principal">
        <section class="community-section row">
            <div class="container mt-4 contenedor-noticias">
                <h2>Noticias de la comunidad</h2>
                <div class="row">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM noticias WHERE tipo = 'usuario' LIMIT 10"); // Ajusta la consulta según sea necesario
                    while ($noticia = mysqli_fetch_assoc($result)) {
                        echo "<div class='col-md-4 mb-3'>";
                        echo "<div class='card'>";
                        echo "<img class='card-img-top' src='" . htmlspecialchars($noticia['columna_imagen'] ?? '../vista/img/img.png') . "' alt='Imagen'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . htmlspecialchars($noticia['titulo']) . "</h5>";
                        echo "<p class='card-text'>" . substr(htmlspecialchars($noticia['contenido']), 0, 100) . "...</p>";
                        echo "<a href='#' class='btn btn-primary'>Leer más</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>

            </div>
        </section>
    </main>

    <!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

    <footer>
        <div class="footer-container">
            <div class="copyright-section">
                <p>© 2023 Noticias UTCH. Todos los derechos reservados.</p>
            </div>

            <div class="complaint-section">
                <h3>Envía tus quejas o sugerencias</h3>
                <form id="complaintForm">
                    <label for="complaintText">Descripción:</label><br>
                    <textarea id="complaintText" name="complaintText" rows="4" cols="50" required></textarea><br>
                    <input type="submit" value="Enviar">
                </form>
                <div id="complaintResults" style="display: none;">
                    Gracias por compartir tu opinión. Tu feedback es valioso para nosotros.
                </div>
            </div>

            <div class="map-section">
                <h3>Encuéntranos</h3>
                <!-- Reemplaza la siguiente línea con tu propia incrustación de mapa de Google Maps -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.485692359213!2d3.3796823142668!3d6.524379995289991!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8b2ae68280c1%3A0xdc9e87a367c3d9cb!2sLagos!5e0!3m2!1sen!2sng!4v1509026222086" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </footer>
    <!-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->


    <!--antes del cierre de la etiqueta </body> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function openModal() {
            $('#modaliniciodesesion').modal('show');
        }
    </script>


</body>

</html>
<?php
mysqli_close($conn);
?>