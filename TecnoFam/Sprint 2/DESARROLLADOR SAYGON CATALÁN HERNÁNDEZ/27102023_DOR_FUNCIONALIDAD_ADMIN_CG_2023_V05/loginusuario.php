<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $telefono = $_POST["telefono"];
    
    
    $servername = "localhost";
    $username = "root";
    $password = "App-Adult-May";
    $database = "centro_gerontologico";
    
    $conn = new mysqli($servername, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Consulta SQL para verificar el número de teléfono
    $sql = "SELECT * FROM usuarios WHERE telefono = '$telefono'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        // Inicio de sesión exitoso, obtén el nombre del usuario
        $row = $result->fetch_assoc();
        $user_name = $row["nombre"];
        
        // Inicia una sesión para mantener al usuario conectado
        session_start();
        $_SESSION["user_name"] = $user_name;
        
        // Redirige al usuario a la página de perfil
        header("Location: perfil.php");
        exit();
    } else {
        // Usuario no válido, redirige al formulario de inicio de sesión con un mensaje de error
        header("Location: login.html?error=1");
        exit();
    }
    
    // Cierra la conexión a la base de datos
    $conn->close();
}
?>
