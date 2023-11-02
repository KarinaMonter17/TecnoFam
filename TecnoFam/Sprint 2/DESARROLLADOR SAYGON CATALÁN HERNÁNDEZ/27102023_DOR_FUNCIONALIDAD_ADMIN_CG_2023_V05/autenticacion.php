<?php
// Inicia o reanuda la sesión
session_start();

// Verifica si el usuario ya está autenticado
if (isset($_SESSION['usuario_autenticado']) && $_SESSION['usuario_autenticado'] === true) {
    header("Location: perfiladmin.php");
    exit();
}

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "App-Adult-May";
$database = "centro_gerontologico";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
    $matricula = $_POST['username'];
    $contraseña = $_POST['password'];
    $role = $_POST['role']; // Obten el valor del menú desplegable

    if ($role === 'admin') {
        $query = "SELECT * FROM administrador WHERE matricula = '$matricula' AND contraseña = '$contraseña'";
    } elseif ($role === 'specialist') {
        $query = "SELECT * FROM administrador WHERE matricula = '$matricula' AND contraseña = '$contraseña'";
    }

    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Verifica si el rol seleccionado en el menú desplegable coincide con la base de datos
        $user = $result->fetch_assoc();
        if ($user['role'] === $role) {
            // Inicio de sesión exitoso
            $_SESSION['usuario_autenticado'] = true;
            $_SESSION['matricula'] = $matricula;

            if ($role === 'admin') {
                header("Location: perfiladmin.php");
            } elseif ($role === 'specialist') {
                header("Location: perfilespecialista.php");
            }
            exit();
        } else {
            // El usuario no tiene el rol seleccionado
            header("Location: login.html?error=2");
            exit();
        }
    } else {
        // Inicio de sesión fallido, usuario no encontrado o contraseña incorrecta
        header("Location: login.html?error=1");
        exit();
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>
