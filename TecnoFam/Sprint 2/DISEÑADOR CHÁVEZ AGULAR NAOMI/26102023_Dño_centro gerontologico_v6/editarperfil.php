<?php
session_start();

if (!isset($_SESSION["user_name"])) {
    // Si el usuario no está conectado, redirige al formulario de inicio de sesión
    header("Location: login.html");
    exit();
}

// Obtén el nombre de usuario del usuario actual
$user_name = $_SESSION["user_name"];

// Aquí debes conectar a tu base de datos y recuperar los datos del usuario
// basado en el nombre de usuario y asignarlos a las variables correspondientes
// Reemplaza con tu propio código de conexión y consulta SQL

$mysqli = new mysqli("localhost", "root", "App-Adult-May", "centro_gerontologico");

if ($mysqli->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $mysqli->connect_error);
}

$query = "SELECT nombre, apellido, telefono, email, nombre_tutor, telefono_tutor, address, preferencia1, preferencia2, preferencia3, preferencia4 FROM usuarios WHERE nombre = '$user_name'";



$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $nombre = $row["nombre"];
    $apellido = $row["apellido"];
    $telefono = $row["telefono"];
    $email = $row["email"];
    $nombre_tutor = $row["nombre_tutor"];
    $telefono_tutor = $row["telefono_tutor"];
    $address = $row["address"];
    $preferencia1_actual = $row["preferencia1"];
    $preferencia2_actual = $row["preferencia2"];
    $preferencia3_actual = $row["preferencia3"];
    $preferencia4_actual = $row["preferencia4"];
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="assets/css/registro.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="shortcut icon" href="assets/iconos/icono.png">
</head>
<body>
    
    <!-- Formulario de edición de perfil -->
    <div class="container">
        <form action="procesar_actualizacion.php" method="POST">
            <h2 class="title">Editar Perfil</h2>
            <img src="assets/iconos/icono.png" alt="Logo" class="logo1">

            <div class="column">
                <h4>Datos del adulto mayor</h4>
                <div class="nombre">
                    <div class="row">
                        <input type="text" id="nombre" name="nombre" pattern="[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s]+" required placeholder="Nombre(s)" value="<?php echo $nombre; ?>">
                    </div>
                    <div class="row">
                        <input type="text" id="apellido" name="apellido" pattern="[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s]+" required placeholder="Apellidos" value="<?php echo $apellido; ?>">
                    </div>
                </div>
                <div class="datos">
                    <div class="row">
                        <input type="tel" id="telefono" name="telefono" pattern="[0-9]{10}" placeholder="Teléfono (10 dígitos)" value="<?php echo $telefono; ?>">
                    </div>
                    <div class="row">
                        <input type="email" id="email" name="email" required placeholder="Correo electrónico" value="<?php echo $email; ?>">
                    </div>
                </div>
            </div>
            <div class="tutor">
                <div class="column">
                    <h4>Datos del tutor</h4>
                    <div class="row">
                        <input type="text" id="nombre_tutor" name="nombre_tutor" pattern="[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s]+" required placeholder="Nombre del tutor" value="<?php echo $nombre_tutor; ?>">
                    </div>
                    <div class="row">
                        <input type="tel" id="telefono_tutor" name="telefono_tutor" pattern="[0-9]{10}" placeholder="Teléfono del tutor (10 dígitos)" value="<?php echo $telefono_tutor; ?>">
                    </div>
                    <div class="row">
                        <input type="text" id="address" name="address" pattern="[A-Za-0-9-záéíóúÁÉÍÓÚüÜñÑ\s]+" required placeholder="Dirección" value="<?php echo $address; ?>">
                    </div>
                </div>
                <div class="checkbox-row">
                    <h4>¿Gusta inscribirse a un taller?</h4>
                    <br>
                    <label for="preferencia1"><input type="checkbox" id="preferencia1" name="preferencia1" <?php if ($preferencia1_actual) echo 'checked'; ?>> Danza</label><br>
                    <label for="preferencia2"><input type="checkbox" id="preferencia2" name="preferencia2" <?php if ($preferencia2_actual) echo 'checked'; ?>> Pintura</label><br>
                    <label for="preferencia3"><input type="checkbox" id="preferencia3" name="preferencia3" <?php if ($preferencia3_actual) echo 'checked'; ?>> Cocina</label><br>
                    <label for="preferencia4"><input type="checkbox" id="preferencia4" name="preferencia4" <?php if ($preferencia4_actual) echo 'checked'; ?>> Ninguna</label>
                </div>
            </div>
            <button type="submit" class="submit-button">Guardar Cambios</button>
        </form>
    </div> 
    <div id="success-message" class="message">¡Actualización exitosa!</div>
    <div id="error-message" class="message">¡Hubo un error!</div>

    <script>
    var urlParams = new URLSearchParams(location.search);
    if (urlParams.get('success') === '1') {
        var successMessage = document.getElementById('success-message');
        successMessage.style.display = 'block';
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 5000); // 5000 milisegundos = 5 segundos
    } else if (urlParams.get('success') === '0') {
        var errorMessage = document.getElementById('error-message');
        errorMessage.style.display = 'block';
        setTimeout(function() {
            errorMessage.style.display = 'none';
        }, 5000); // 5000 milisegundos = 5 segundos
    }

    function validarFormulario() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var noneCheckbox = document.getElementById('preferencia4');
        var alMenosUnCheckboxMarcado = false;

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                alMenosUnCheckboxMarcado = true;
            }
        });

        if (!alMenosUnCheckboxMarcado && !noneCheckbox.checked) {
            alert('Debes seleccionar al menos un taller o marcar "Ninguna" antes de guardar.');
            return false; // Evita que el formulario se envíe
        }

        return true; // Permite que el formulario se envíe si al menos un checkbox está marcado
    }

    // Agrega un evento para validar las selecciones de talleres antes del envío del formulario
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var noneCheckbox = document.getElementById('preferencia4');

    noneCheckbox.addEventListener('change', function() {
        if (noneCheckbox.checked) {
            // Si "Ninguna" se marca, desmarca las otras opciones
            checkboxes.forEach(function(checkbox) {
                if (checkbox !== noneCheckbox) {
                    checkbox.checked = false;
                }
            });
        }
    });

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (checkbox !== noneCheckbox && checkbox.checked) {
                // Si se marca otra opción, desmarca "Ninguna"
                noneCheckbox.checked = false;
            }
        });
    });
</script>
</body>
</html>
