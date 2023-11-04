<?php
session_start();

if (!isset($_SESSION["user_name"])) {
    // Si el usuario no está conectado, redirige al formulario de inicio de sesión
    header("Location: login.html");
    exit();
}

$user_name = $_SESSION["user_name"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metadatos -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlaces a archivos CSS y favicon -->
    <link rel="stylesheet" href="inicio/perfil.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="shortcut icon" href="assets/iconos/icono.png">
    <!-- Título de la página -->
    <title>Centro Gerontológico integral</title>
</head>
<body>
    <!-- Barra de navegación -->
    <nav>
        <!-- Menú desplegable para dispositivos móviles -->
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <!-- Logo y texto del centro gerontológico -->
        <div class="logo">
            <img src="assets/logo/logo.png">
            <div>
                <h1 class="logo-text">Centro gerontológico integral</h1>
                <p>Horarios de 10:00 am a 03:00 pm</p>
            </div>
        </div>
        <!-- Menú de navegación -->
        <ul class="menu">
            <li><a href="#">Talleres y servicios</a></li>
            <!-- Sección de perfil del usuario -->
            <div class="profile">
                <div class="profile-name">Usuario: <?php echo $user_name; ?></div>
                <!-- Menú desplegable con opciones del perfil -->
                <div class="floating-menu">
                    <ul class="profile-options">
                        <li><a href="editarperfil.php">Actualizar datos</a></li>
                        <li><a href="cerrarsesion.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </ul>
    </nav>
    <!-- Resto del contenido de la página -->
    <!-- ... -->
</body>
</html>
