<?php
// Inicia o reanuda la sesión
session_start();

// Si el usuario no está autenticado, redirige al formulario de inicio de sesión
if (!isset($_SESSION["usuario_autenticado"])) {
    header("Location: login.html");
    exit();
}

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "centro_gerontologico";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Obtén el nombre del administrador desde la base de datos
if (isset($_SESSION['matricula'])) {
    $matricula = $_SESSION['matricula'];

    $query = "SELECT nombre FROM administrador WHERE matricula = '$matricula'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/perfil.css">
    <link rel="stylesheet" href="assets/css/especialista.css">
    <link rel="shortcut icon" href="assets/iconos/icono.png">
    <title>Centro Gerontológico Integral</title>
</head>
<body>
    <nav>
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="logo">
            <img src="assets/logo/logo.png">
            <div>
                <h1 class="logo-text">Centro gerontológico integral</h1>
                <p>Horarios de 10:00 am a 03:00 pm</p>
            </div>
        </div>
        <ul class="menu">
            <div class="profile">
                <div class="profile-name">Especialista: <?php echo $nombre; ?></div>
                <div class="floating-menu">
                    <ul class="profile-options">
                        <li><a href="cerrarsesion.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </ul>
    </nav>

    <div class="content">
        <div class="galeri">
            <h1>Asistencias</h1>
        </div>
    </div>

    <div class="conta">
        <div class="row">
            <input type="text" id="nombre" name="nombre" required placeholder="Nombre(s)">
        </div>
        <div class="row">
            <input type="text" id="apellido" name="apellido" placeholder="Apellidos">
        </div>
        
            <button class="button">Buscar</button>
    </div>

    <div class="contain">
        <h1>Nombre del paciente</h1>
        <div class="con">
            <div class="container1">
                    <h2>Talleres</h2>
                    <label for="selector1">Taller:</label>
                    <select id="selector1">
                        <option value="opcion1">Si</option>
                        <option value="opcion2">No</option>
                    </select>
            </div>


            <div class="container2">
                    <h2>Servicios</h2>
                    <label for="selector2">Actividad física:</label>
                    <select id="selector2">
                        <option value="opcion1">Si</option>
                        <option value="opcion2">No</option>
                    </select>
                    <a href="#">Registrarlo en atención medica</a>
                    <a href="#">Registrarlo en atención psicológica</a>
            </div>
        </div>
    </div>


    <footer>
        Carretera Mexico- Laredo s/n, esq, con av. Insurgentes, instalaciones del antiguo patrimonio, Ixmiquilpan, Hgo., Ixmiquilpan, Mexico, 42300
    </footer>
</body>
</html>
