<?php
include '../Modelo/config.php';

session_start();
?>

<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard - Perfil de Usuario</title>
    <link href="./estilos/dashboard.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="dashboard-container">
        <!-- Barra lateral -->
        <aside class="sidebar">

            <nav>
                <ul>
                    <li><a href="index.php" data-section="profileSummary">Inicio</a></li>
                    <li><a href="#" id="showactualizarperfil" data-section="actualizarperfil">Actualizar Perfil</a></li>
                    <li><a href="#" id="showpublicacionnoticia" data-section="publicacionnoticia">Publicar Noticia</a></li>
                    <li><a href="#" id="showpostrecientes" data-section="postrecientes">Publicaciones Recientes</a></li>
                    <li><a href="#" id="showfeedback" data-section="feedback">Feedback</a></li>
                </ul>
            </nav>
        </aside>
        <!-- Contenido principal -->
        <main class="main-content contenedor-principal">

            <section id="profileSummary">
                <h2>Resumen del Perfil</h2>
                <p>Bienvenido al resumen de tu perfil. Aquí encontrarás un
                    vistazo rápido de tu actividad y tus detalles.</p>
            </section>











            <!-- Aquí se carga el contenido dinámico basado en la selección del usuario -->
            <section id="actualizarperfil" class="hidden">
                <h2>Actualizar Perfil</h2>
                <form action="../Controlador/actuperfil.php" method="POST">
                    <label for="username">Nombre de usuario:</label>
                    <input id="username" name="username" required type="text" />
                    <label for="password">Contraseña:</label>
                    <input id="password" name="password" required type="password" />
                    <input type="submit" value="Guardar Cambios" />
                </form>
            </section>






            <section id="publicacionnoticia" class="hidden">
                <h2>Publicar Noticia</h2>
                <form action="../Modelo/publicarnoticia.php" method="POST">
                    <label for="titulo">Título:</label>
                    <input id="titulo" name="titulo" required type="text" />
                    <label for="contenido">Contenido:</label>
                    <textarea id="contenido" name="contenido" required rows="4"></textarea>
                    <input type="submit" value="Publicar Noticia" />
                </form>
            </section>










            <!-- Publicaciones Recientes -->
            <section id="postrecientes" class="hidden">
                <article>
                    <h2>Publicaciones Recientes</h2>
                    <?php foreach ($recentPosts as $post) : ?>
                        <div class='post'>
                            <h3><?= htmlspecialchars($post['titulo']) ?></h3>
                            <p><?= htmlspecialchars($post['resumen']) ?></p>
                            <p>Publicado el: <?= htmlspecialchars($post['fecha_publicacion']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </article>
            </section>

















            <!-- Feedback o Soporte -->
            <section id="feedback" class="hidden">
                <h2>Feedback o Soporte</h2>
                <p>Si tienes comentarios, sugerencias o problemas, ¡nos encantaría escucharlos! <a href="../Modelo/feedback.php">Envíanos tus comentarios.</a></p>
            </section>











        </main>
    </div>


    <script src="./scripts/ocultsecciones.js"></script>

</body>

</html>
<?php
mysqli_close($conn);
?>