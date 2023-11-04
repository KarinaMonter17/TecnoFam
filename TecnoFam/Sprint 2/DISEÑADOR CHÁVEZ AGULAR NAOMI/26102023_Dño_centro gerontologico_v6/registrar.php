<?php
// ... Código de conexión a la base de datos ...
$servername = "localhost";
$username = "root";
$password = "";
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
    $preferencia1 = isset($_POST["preferencia1"]) ? 1 : 0;
    $preferencia2 = isset($_POST["preferencia2"]) ? 1 : 0;
    $preferencia3 = isset($_POST["preferencia3"]) ? 1 : 0;
    $preferencia4 = isset($_POST["preferencia4"]) ? 1 : 0;

    // Prepara la consulta SQL para insertar los datos
    $sql = "INSERT INTO usuarios (nombre, apellido, telefono, email, nombre_tutor, telefono_tutor, address, preferencia1, preferencia2, preferencia3, preferencia4)
    VALUES ('$nombre', '$apellido', '$telefono', '$email', '$nombre_tutor', '$telefono_tutor', '$address', $preferencia1, $preferencia2, $preferencia3, $preferencia4)";

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
