<div class="navbar">
    <div class="left-section">
        <div class="logo">
            <a href="index.php"><img src="../publico/img/img4.png" alt="Logo-UTCH"></a>
        </div>
    </div>
    <div class="right-section auth-links">
        <nav>
            <a href="../publico/index.php" data-tooltip="Inicio"><i class="fas fa-home"></i> Inicio</a>
            <a href="../publico/inoticias.php">Noticias UTCH</a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">Categorías</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="noticomunidad.php">NotiComunidad</a>
                    <a class="dropdown-item" href="cursos.php">Cursos</a>
                    <a class="dropdown-item" href="actividades.php">Actividades</a>
                </div>
            </div>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                <a href="perfilusuario.php">Hola, <?= htmlspecialchars($_SESSION['username']) ?></a>
                <a href="../componentes/logout.php">Cerrar Sesión</a>
            <?php else : ?>
                <a href="#" class="icon-button" data-toggle="modal" data-target="#modaliniciodesesion">
                    <i class="fas fa-user"></i>
                </a>
            <?php endif; ?>
        </nav>
    </div>
</div>
