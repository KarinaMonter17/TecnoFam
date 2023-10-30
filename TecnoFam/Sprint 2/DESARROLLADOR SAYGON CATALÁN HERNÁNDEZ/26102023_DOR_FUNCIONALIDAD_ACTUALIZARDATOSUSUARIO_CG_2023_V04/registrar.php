<?php
// ... Código de conexión a la base de datos ...
$servername = "localhost";
$username = "root";
$password = "App-Adult-May";
$dbname = "centro_gerontologico";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $nombre_tutor = $_POST["nombre_tutor"];
    $telefono_tutor = $_POST["telefono_tutor"];
    $address = $_POST["address"];
    
    // Verifica si se seleccionó un taller
    $danza = isset($_POST["danza"]) ? 1 : 0;
    $pintura = isset($_POST["pintura"]) ? 1 : 0;
    $cocina = isset($_POST["cocina"]) ? 1 : 0;
    $ninguna = isset($_POST["ninguna"]) ? 1 : 0;

    // Prepara la consulta SQL para insertar los datos
    $sql = "INSERT INTO usuarios (nombre, apellido, telefono, email, nombre_tutor, telefono_tutor, address, danza, pintura, cocina, ninguna)
    VALUES ('$nombre', '$apellido', '$telefono', '$email', '$nombre_tutor', '$telefono_tutor', '$address', $danza, $pintura, $cocina, $ninguna)";

if ($conn->query($sql) === TRUE) {
    $message = "Registro exitoso";

    // Redirige al usuario al formulario con un parámetro GET para indicar éxito
    header("Location: Register.html?success=1");
    exit; // Asegura que el script termine después de la redirección
} else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
}

// Imprime el mensaje en JavaScript para mostrarlo como un mensaje flotante
echo "<script>
  var messageContainer = document.getElementById('message-container');
  messageContainer.innerHTML = '$message';
  messageContainer.style.display = 'block';

  setTimeout(function() {
    messageContainer.style.display = 'none';
  }, 5000); // 5000 milisegundos = 5 segundos
</script>";

}
// Cierra la conexión a la base de datos
$conn->close();

?>
