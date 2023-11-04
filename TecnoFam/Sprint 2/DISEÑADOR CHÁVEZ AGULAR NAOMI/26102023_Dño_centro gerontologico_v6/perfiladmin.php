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
    <link rel="stylesheet" href="assets/css/reporte.css">
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
                <div class="profile-name">Administrador: <?php echo $nombre; ?></div>
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
            <h1>Reportes</h1>
        </div>
    </div>

    
    <div class="container">
        <p>Fecha</p>
        <input type="date" class="date-selector">
    
        <select class="options-selector">
        <option value="option1">Talleres</option>
        <option value="option2">Servicios</option>
        </select>
    
        <button class="button">Generar reporte</button>
    </div>

    <div class="contain">
        <table>
            <tr class="encabezado">
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Servicio</th>
            <th>Asistencia</th>
            <th>Eliminar</th>
            <th>Modificar</th>
            </tr>
            <tr>
            <td>Dato 1</td>
            <td>Dato 2</td>
            <td>Dato 3</td>
            <td>Dato 4</td>
            <td class="button-container">
                <button class="button"><img src="assets/iconos/eliminar.png" alt="Botón 1"></button>
                <button class="button"><img src="assets/iconos/modificar.png" alt="Botón 2"></button>
            </td>
            </tr>
            <!-- Puedes agregar más filas según sea necesario -->
        </table>
    </div>

    <footer>
        Carretera Mexico- Laredo s/n, esq, con av. Insurgentes, instalaciones del antiguo patrimonio, Ixmiquilpan, Hgo., Ixmiquilpan, Mexico, 42300
    </footer>
</body>
</html>
