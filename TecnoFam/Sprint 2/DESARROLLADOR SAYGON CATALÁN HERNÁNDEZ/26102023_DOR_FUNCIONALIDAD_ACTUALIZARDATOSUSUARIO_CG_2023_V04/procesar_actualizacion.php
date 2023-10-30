<?php
session_start();

if (!isset($_SESSION["user_name"])) {
    // Si el usuario no está conectado, redirige al formulario de inicio de sesión
    header("Location: login.html");
    exit();
}

// Obtén el nombre de usuario del usuario actual
$user_name = $_SESSION["user_name"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopila los datos enviados a través del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $nombre_tutor = $_POST["nombre_tutor"];
    $telefono_tutor = $_POST["telefono_tutor"];
    $address = $_POST["address"];
    
    // Verifica si se han marcado los checkboxes de preferencias
    $danza = isset($_POST["danza"]) ? 1 : 0;
    $pintura = isset($_POST["pintura"]) ? 1 : 0;
    $cocina = isset($_POST["cocina"]) ? 1 : 0;
    $ninguno = isset($_POST["ninguno"]) ? 1 : 0;

    // Realiza la conexión a la base de datos
    $mysqli = new mysqli("localhost", "root", "App-Adult-May", "centro_gerontologico");

    if ($mysqli->connect_error) {
        die("La conexión a la base de datos ha fallado: " . $mysqli->connect_error);
    }

    // Actualiza los datos del usuario en la base de datos
    $query = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', email = '$email', nombre_tutor = '$nombre_tutor', telefono_tutor = '$telefono_tutor', address = '$address', danza = $danza, pintura = $pintura, cocina = $cocina, ninguno = $ninguno WHERE nombre = '$user_name'";

    if ($mysqli->query($query) === TRUE) {
        // Redirige al perfil del usuario con éxito
        header("Location: perfil.php");
        exit();
    } else {
        // Si hay un error en la actualización, redirige al perfil con un indicador de error
        header("Location: perfil.php?success=0");
        exit();
    }

    $mysqli->close();
} else {
    // Si se intenta acceder a este script de forma incorrecta, redirige al perfil de usuario
    header("Location: perfil.php");
    exit();
}
?>
